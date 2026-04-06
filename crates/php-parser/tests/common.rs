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
