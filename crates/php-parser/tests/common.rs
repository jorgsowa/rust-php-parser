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

pub fn comments_to_json(comments: &[php_ast::Comment]) -> String {
    serde_json::to_string_pretty(comments).unwrap()
}

/// Render a parse result as a combined snapshot: program JSON then comments JSON.
pub fn result_snapshot(result: &php_rs_parser::ParseResult) -> String {
    format!(
        "=== program ===\n{}\n\n=== comments ===\n{}\n",
        to_json(&result.program),
        comments_to_json(&result.comments),
    )
}
