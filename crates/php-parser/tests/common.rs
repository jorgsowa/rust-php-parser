pub fn assert_no_errors(result: &php_rs_parser::ParseResult) {
    if !result.errors.is_empty() {
        panic!(
            "Expected no parse errors, got {} error(s):\n{:#?}",
            result.errors.len(),
            result.errors
        );
    }
}

pub fn to_json(program: &php_ast::Program) -> String {
    serde_json::to_string_pretty(program).unwrap()
}

/// Format a fixture snapshot: PHP source followed by the program JSON.
pub fn fixture(source: &str, program: &php_ast::Program) -> String {
    format!(
        "=== source ===\n{source}\n=== snapshot ===\n{}\n",
        to_json(program)
    )
}

/// Format a fixture snapshot that includes parse errors: source, error messages, then AST.
pub fn fixture_with_errors(
    source: &str,
    errors: &[impl ToString],
    program: &php_ast::Program,
) -> String {
    let error_text = errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n");
    format!(
        "=== source ===\n{source}\n=== errors ===\n{error_text}\n=== snapshot ===\n{}\n",
        to_json(program)
    )
}

/// Config parsed from an optional `===config===` section at the top of a fixture file.
pub struct FixtureConfig {
    /// Minimum PHP version required for this fixture (e.g. `Some((8, 5))`).
    pub min_php: Option<(u32, u32)>,
    /// Whether the fixture is expected to produce at least one parse error.
    /// Set to `true` when an `===errors===` marker appears in the file.
    pub expect_errors: bool,
}

/// Parse a fixture file with optional `===config===` and mandatory `===source===` sections.
///
/// Format:
/// ```text
/// ===config===       <- optional
/// min_php=8.5
/// ===source===       <- required
/// <?php
/// ...
/// ===errors===       <- optional; presence means expect_errors = true
/// ```
///
/// Returns the parsed config and a slice of `content` containing only the PHP source
/// (everything between `===source===` and the next section marker, or end of file).
pub fn parse_fixture(content: &str) -> (FixtureConfig, &str) {
    let mut min_php = None;

    let rest = if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                if let Some((maj_s, min_s)) = val.split_once('.') {
                    if let (Ok(maj), Ok(min)) = (maj_s.parse::<u32>(), min_s.parse::<u32>()) {
                        min_php = Some((maj, min));
                    }
                }
            }
        }
        &rest[source_marker..]
    } else {
        content
    };

    let after_source_marker = rest.strip_prefix("===source===\n").unwrap_or(rest);

    // Source ends at the next section marker (===errors===) or at EOF.
    let (source, expect_errors) = if let Some(errors_pos) = after_source_marker.find("===errors===")
    {
        (&after_source_marker[..errors_pos], true)
    } else {
        (after_source_marker, false)
    };

    (
        FixtureConfig {
            min_php,
            expect_errors,
        },
        source,
    )
}
