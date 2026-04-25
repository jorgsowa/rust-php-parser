/// Parse a fixture file and return `(min_php, source)`.
///
/// `min_php` is read from an optional `===config===` section and controls both
/// the Rust parse target version and the minimum PHP version for `php -l` gating.
/// `source` is the PHP code between `===source===` and the next section marker.
///
/// All other section contents (`===errors===`, `===ast===`, `===php_error===`) are
/// left for each test binary to extract directly from the original content, since
/// different test binaries need different subsets.
#[allow(dead_code)]
pub fn parse_fixture(content: &str) -> (Option<(u32, u32)>, &str) {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };

    let mut min_php = None;

    let rest = if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = parse_ver(val);
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

    (min_php, source)
}

/// Recursively collect all `.phpt` files under `dir`.
#[allow(dead_code)]
pub fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
        } else if path.extension().is_some_and(|ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Format all parse errors as a newline-separated string.
#[allow(dead_code)]
pub fn format_errors(result: &php_rs_parser::ParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}
