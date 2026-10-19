//! String literals decode to the bytes PHP stores, which need not be valid UTF-8.

use php_ast::ast::{ExprKind, StmtKind, StringPart};

fn string_value(code: &str) -> Vec<u8> {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, code);
    assert!(result.errors.is_empty(), "{:?}", result.errors);
    let StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected an expression statement")
    };
    match &expr.kind {
        ExprKind::String(s) => s.as_bytes().to_vec(),
        ExprKind::Heredoc { parts, .. } => parts
            .iter()
            .flat_map(|p| match p {
                StringPart::Literal(s) => s.as_bytes().to_vec(),
                _ => panic!("expected a literal part"),
            })
            .collect(),
        other => panic!("expected a string, got {other:?}"),
    }
}

#[test]
fn hex_and_octal_escapes_are_single_bytes() {
    assert_eq!(string_value(r#"<?php "\xff";"#), [0xff]);
    assert_eq!(string_value(r#"<?php "a\x80b";"#), [b'a', 0x80, b'b']);
    assert_eq!(string_value(r#"<?php "\377\0";"#), [0xff, 0]);
    // PHP keeps the low byte of an overflowing octal escape.
    assert_eq!(string_value(r#"<?php "\400\501";"#), [0, b'A']);
}

#[test]
fn escaped_utf8_equals_the_character() {
    assert_eq!(string_value(r#"<?php "\xc3\xbf";"#), "ÿ".as_bytes());
    assert_eq!(string_value(r#"<?php "\u{ff}";"#), "ÿ".as_bytes());
    assert_ne!(string_value(r#"<?php "\xff";"#), "ÿ".as_bytes());
}

#[test]
fn surrogate_code_points_keep_their_three_utf8_bytes() {
    assert_eq!(string_value(r#"<?php "\u{D800}";"#), [0xed, 0xa0, 0x80]);
    assert_eq!(string_value(r#"<?php "\u{DFFF}";"#), [0xed, 0xbf, 0xbf]);
}

#[test]
fn heredoc_escapes_are_bytes() {
    assert_eq!(
        string_value("<?php <<<EOT\n\\xfe\\x01\nEOT;\n"),
        [0xfe, 0x01]
    );
}

#[test]
fn utf8_text_around_escapes_is_preserved() {
    let mut expected = "é".as_bytes().to_vec();
    expected.push(0xff);
    expected.extend("é".bytes());
    assert_eq!(string_value("<?php \"é\\xffé\";"), expected);
}

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

#[cfg(feature = "serde")]
#[test]
fn invalid_utf8_serializes_as_bytes() {
    let result = php_rs_parser::parse(r#"<?php "\xff"; "ok";"#);
    let json = serde_json::to_value(&result.program).unwrap();
    let first = &json["stmts"][0]["kind"]["Expression"]["kind"]["String"];
    assert_eq!(first, &serde_json::json!({ "bytes": [255] }));
    let second = &json["stmts"][1]["kind"]["Expression"]["kind"]["String"];
    assert_eq!(second, &serde_json::json!("ok"));
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
