pub fn to_json(program: &php_ast::Program) -> String {
    serde_json::to_string_pretty(program).unwrap()
}

/// Config parsed from an optional `===config===` section at the top of a fixture file.
pub struct FixtureConfig {
    /// Minimum PHP version required for this fixture (e.g. `Some((8, 5))`).
    pub min_php: Option<(u32, u32)>,
    /// Specific PHP version to parse with (e.g. `Some((8, 5))` for PHP 8.5).
    /// When set, the test uses `parse_versioned()` instead of `parse()`.
    pub parse_version: Option<(u32, u32)>,
    /// Whether the fixture is expected to produce at least one parse error.
    /// Set to `true` when an `===errors===` marker appears in the file.
    pub expect_errors: bool,
    /// Expected error messages from the `===errors===` section (if any content is present).
    pub expected_errors: Option<String>,
    /// Expected AST JSON from the `===ast===` section.
    pub expected_ast: Option<String>,
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
/// error message 1    <- optional error content
/// ===ast===          <- optional; contains expected JSON AST
/// { ... }
/// ```
///
/// Returns the parsed config and a slice of `content` containing only the PHP source
/// (everything between `===source===` and the next section marker, or end of file).
pub fn parse_fixture(content: &str) -> (FixtureConfig, &str) {
    let mut min_php = None;
    let mut parse_version = None;

    let rest = if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            let parse_ver = |val: &str| -> Option<(u32, u32)> {
                val.split_once('.')
                    .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
            };
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = parse_ver(val);
            } else if let Some(val) = line.strip_prefix("parse_version=") {
                parse_version = parse_ver(val);
            }
        }
        &rest[source_marker..]
    } else {
        content
    };

    let after_source_marker = rest.strip_prefix("===source===\n").unwrap_or(rest);

    // Find section markers
    let errors_pos = after_source_marker.find("===errors===\n");
    let ast_pos = after_source_marker.find("===ast===\n");

    // Source ends at the earliest section marker or EOF.
    // Strip one trailing '\n' when ending at a marker: that newline is the line
    // separator before the marker, not part of the source.
    let source_raw = match (errors_pos, ast_pos) {
        (Some(e), Some(a)) => &after_source_marker[..e.min(a)],
        (Some(e), None) => &after_source_marker[..e],
        (None, Some(a)) => &after_source_marker[..a],
        (None, None) => after_source_marker,
    };
    let at_eof = errors_pos.is_none() && ast_pos.is_none();
    let source = if at_eof {
        source_raw
    } else {
        source_raw.strip_suffix('\n').unwrap_or(source_raw)
    };

    let expect_errors = errors_pos.is_some();

    // Extract expected errors content (between ===errors=== and ===ast=== or EOF)
    let expected_errors = errors_pos
        .map(|e| {
            let after_errors = &after_source_marker[e + "===errors===\n".len()..];
            let end = after_errors
                .find("===ast===\n")
                .unwrap_or(after_errors.len());
            let text = after_errors[..end].trim_end_matches('\n').to_string();
            if text.is_empty() {
                None
            } else {
                Some(text)
            }
        })
        .flatten();

    // Extract expected AST JSON
    let expected_ast = ast_pos.map(|a| {
        let after_ast = &after_source_marker[a + "===ast===\n".len()..];
        after_ast.trim_end_matches('\n').to_string()
    });

    (
        FixtureConfig {
            min_php,
            parse_version,
            expect_errors,
            expected_errors,
            expected_ast,
        },
        source,
    )
}

/// Convert a `(major, minor)` version tuple to a `PhpVersion` enum.
pub fn php_version(v: (u32, u32)) -> php_rs_parser::PhpVersion {
    match v {
        (7, 4) => php_rs_parser::PhpVersion::Php74,
        (8, 0) => php_rs_parser::PhpVersion::Php80,
        (8, 1) => php_rs_parser::PhpVersion::Php81,
        (8, 2) => php_rs_parser::PhpVersion::Php82,
        (8, 3) => php_rs_parser::PhpVersion::Php83,
        (8, 4) => php_rs_parser::PhpVersion::Php84,
        (8, 5) => php_rs_parser::PhpVersion::Php85,
        _ => panic!("unsupported PHP version: {}.{}", v.0, v.1),
    }
}

pub fn format_errors(result: &php_rs_parser::ParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

/// Rewrite the `===errors===` and `===ast===` sections of a fixture file.
/// Called when `UPDATE_FIXTURES=1` is set in the environment.
pub fn update_fixture(path: &str, errors: &str, new_ast: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));

    // Find the end of the ===source=== section (first marker after it)
    let source_marker = "===source===\n";
    let after_source = content
        .find(source_marker)
        .map(|p| p + source_marker.len())
        .unwrap_or(0);

    // Find where source content ends (at first section marker after source)
    let rest = &content[after_source..];
    let source_end = rest
        .find("===errors===\n")
        .or_else(|| rest.find("===ast===\n"))
        .map(|p| after_source + p)
        .unwrap_or(content.len());

    let before_sections = &content[..source_end];
    let new_content = if errors.is_empty() {
        format!("{before_sections}===ast===\n{new_ast}\n")
    } else {
        format!("{before_sections}===errors===\n{errors}\n===ast===\n{new_ast}\n")
    };
    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}
