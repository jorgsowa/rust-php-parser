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
