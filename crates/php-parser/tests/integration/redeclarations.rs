//! Conflicts `php -l` rejects but the parser leaves to an analyzer, so they can't be fixtures.

fn parse_errors(code: &str) -> Vec<String> {
    let result = php_rs_parser::parse(code);
    result.errors.iter().map(|e| e.to_string()).collect()
}

#[test]
fn redeclared_function_is_not_a_parse_error() {
    assert_eq!(
        parse_errors("<?php function f() {} function f() {}"),
        Vec::<String>::new()
    );
}

#[test]
fn import_clashing_with_class_is_not_a_parse_error() {
    assert_eq!(
        parse_errors("<?php use A\\B; class B {}"),
        Vec::<String>::new()
    );
}
