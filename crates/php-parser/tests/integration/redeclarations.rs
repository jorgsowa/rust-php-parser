//! Cross-declaration conflicts in one file are left to an analyzer; only same-class duplicates are errors.

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
fn redeclared_class_is_not_a_parse_error() {
    assert_eq!(
        parse_errors("<?php class A {} class A {}"),
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

#[test]
fn duplicate_method_in_one_class_is_still_an_error() {
    let errors = parse_errors("<?php class A { function f() {} function f() {} }");
    assert!(
        errors.iter().any(|e| e.contains("Cannot redeclare A::f()")),
        "expected redeclare error, got: {errors:?}"
    );
}
