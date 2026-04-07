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
            expect_errors,
            expected_errors,
            expected_ast,
        },
        source,
    )
}

/// Rewrite the `===ast===` section of a fixture file with `new_ast`.
/// Called when `UPDATE_FIXTURES=1` is set in the environment.
pub fn update_fixture_ast(path: &str, new_ast: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));
    let new_content = if let Some(pos) = content.find("===ast===\n") {
        let before = &content[..pos];
        format!("{before}===ast===\n{new_ast}\n")
    } else if content.ends_with('\n') {
        format!("{content}===ast===\n{new_ast}\n")
    } else {
        format!("{content}\n===ast===\n{new_ast}\n")
    };
    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}
