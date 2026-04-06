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

/// Config parsed from an optional `===config===` section at the top of a fixture file.
pub struct FixtureConfig {
    /// Minimum PHP version required for this fixture (e.g. `Some((8, 5))`).
    pub min_php: Option<(u32, u32)>,
}

/// Parse a fixture file that may start with an optional `===config===` section.
///
/// Format:
/// ```text
/// ===config===
/// min_php=8.5
///
/// <?php
/// ...
/// ```
///
/// Returns the parsed config and a slice of `content` containing only the PHP source.
/// If there is no config section, `content` is returned as-is.
pub fn parse_fixture(content: &str) -> (FixtureConfig, &str) {
    let Some(rest) = content.strip_prefix("===config===\n") else {
        return (FixtureConfig { min_php: None }, content);
    };

    let (config_text, source) = rest.split_once("\n\n").unwrap_or((rest, ""));

    let mut min_php = None;
    for line in config_text.lines() {
        if let Some(val) = line.strip_prefix("min_php=") {
            if let Some((maj_s, min_s)) = val.split_once('.') {
                if let (Ok(maj), Ok(min)) = (maj_s.parse::<u32>(), min_s.parse::<u32>()) {
                    min_php = Some((maj, min));
                }
            }
        }
    }

    (FixtureConfig { min_php }, source)
}
