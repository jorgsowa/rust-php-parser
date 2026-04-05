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

/// Render a parse result as a snapshot: source followed by program JSON.
/// Including the source makes snapshots self-documenting.
pub fn result_snapshot(source: &str, result: &php_rs_parser::ParseResult) -> String {
    format!(
        "=== source ===\n{}\n\n=== program ===\n{}\n",
        source,
        to_json(&result.program),
    )
}
