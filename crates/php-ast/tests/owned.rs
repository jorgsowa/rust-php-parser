use php_ast::owned::{Expr, ExprKind, Ident, Name};
use php_ast::{NameKind, Span};

fn name(parts: &[&str], kind: NameKind) -> Name {
    Name {
        parts: parts.iter().map(|p| (*p).into()).collect(),
        kind,
        span: Span::new(2, 9),
    }
}

#[test]
fn name_helpers_match_the_arena_name() {
    let qualified = name(&["Foo", "Bar"], NameKind::Qualified);
    assert_eq!(qualified.kind(), NameKind::Qualified);
    assert_eq!(qualified.span(), Span::new(2, 9));
    assert_eq!(qualified.to_string_repr(), "Foo\\Bar");
    assert_eq!(qualified.join_parts(), "Foo\\Bar");

    let fully_qualified = name(&["Foo", "Bar"], NameKind::FullyQualified);
    assert_eq!(fully_qualified.to_string_repr(), "\\Foo\\Bar");
    assert_eq!(fully_qualified.join_parts(), "Foo\\Bar");

    let error = name(&[], NameKind::Error);
    assert_eq!(error.to_string_repr(), "");
    assert_eq!(error.join_parts(), "");
}

#[test]
fn name_str_reads_variables_and_identifiers_only() {
    let expr = |kind| Expr {
        kind,
        span: Span::DUMMY,
    };
    assert_eq!(expr(ExprKind::Variable("x".into())).name_str(), Some("x"));
    assert_eq!(expr(ExprKind::Identifier("m".into())).name_str(), Some("m"));
    assert_eq!(expr(ExprKind::Int(1)).name_str(), None);
    let _ = Ident::new("unused", Span::DUMMY);
}

#[test]
fn into_kind_moves_the_kind_out_of_a_drop_type() {
    let inner = Expr {
        kind: ExprKind::Int(7),
        span: Span::DUMMY,
    };
    let outer = Expr {
        kind: ExprKind::Parenthesized(Box::new(inner)),
        span: Span::DUMMY,
    };
    let ExprKind::Parenthesized(inner) = outer.into_kind() else {
        panic!("expected Parenthesized")
    };
    assert!(matches!(inner.into_kind(), ExprKind::Int(7)));
}
