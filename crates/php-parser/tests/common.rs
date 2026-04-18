/// Configuration parsed from a fixture's `===config===` section.
pub struct FixtureConfig {
    pub min_php: Option<(u32, u32)>,
    pub max_php: Option<(u32, u32)>,
}

/// Parse a fixture file and return `(config, source)`.
///
/// Config is read from an optional `===config===` section.
/// `source` is the PHP code between `===source===` and the next section marker.
///
/// All other section contents (`===errors===`, `===ast===`, `===php_error===`) are
/// left for each test binary to extract directly from the original content, since
/// different test binaries need different subsets.
pub fn parse_fixture(content: &str) -> (FixtureConfig, &str) {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };

    let mut min_php = None;
    let mut max_php = None;

    let rest = if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = parse_ver(val);
            } else if let Some(val) = line.strip_prefix("max_php=") {
                max_php = parse_ver(val);
            }
        }
        &rest[source_marker..]
    } else {
        content
    };

    let after_source = rest.strip_prefix("===source===\n").unwrap_or(rest);

    // Source ends at the earliest of ===errors=== or ===ast=== (or EOF).
    // One trailing '\n' is stripped because it is the newline before the marker,
    // not part of the PHP source itself.
    let errors_pos = after_source.find("===errors===\n");
    let ast_pos = after_source.find("===ast===\n");
    let source_raw = match (errors_pos, ast_pos) {
        (Some(e), Some(a)) => &after_source[..e.min(a)],
        (Some(e), None) => &after_source[..e],
        (None, Some(a)) => &after_source[..a],
        (None, None) => after_source,
    };
    let source = if errors_pos.is_none() && ast_pos.is_none() {
        source_raw
    } else {
        source_raw.strip_suffix('\n').unwrap_or(source_raw)
    };

    (FixtureConfig { min_php, max_php }, source)
}
