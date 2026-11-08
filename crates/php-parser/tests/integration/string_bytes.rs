//! String literals decode to the bytes PHP stores, which need not be valid UTF-8.

use php_ast::ast::{ExprKind, StmtKind};

#[test]
fn utf8_validity_is_reported() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, r#"<?php "ok"; "\xff";"#);
    let values: Vec<_> = result
        .program
        .stmts
        .iter()
        .map(|s| match &s.kind {
            StmtKind::Expression(e) => match &e.kind {
                ExprKind::String(s) => (
                    s.to_str().map(str::to_owned),
                    s.to_string_lossy().into_owned(),
                ),
                _ => panic!("expected a string"),
            },
            _ => panic!("expected an expression statement"),
        })
        .collect();
    assert_eq!(values[0], (Some("ok".to_string()), "ok".to_string()));
    assert_eq!(values[1], (None, "\u{FFFD}".to_string()));
}

#[test]
fn owned_strings_keep_the_bytes() {
    use php_ast::owned::{ExprKind as OwnedKind, StmtKind as OwnedStmt};
    let result = php_rs_parser::parse(r#"<?php "\xff";"#);
    let OwnedStmt::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected an expression statement")
    };
    let OwnedKind::String(s) = &expr.kind else {
        panic!("expected a string")
    };
    assert_eq!(s.as_bytes(), [0xff]);
    assert!(s.to_str().is_none());
}
