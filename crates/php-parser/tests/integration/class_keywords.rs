//! `self`, `parent` and `static` inside a class body are checked only when they may be
//! invalid; each source holds a single reference so no other one turns the check on.

use php_rs_parser::diagnostics::ForbiddenRule;
use php_rs_parser::{ParseOptions, PhpVersion};

fn rules(src: &str, version: PhpVersion) -> Vec<ForbiddenRule> {
    php_rs_parser::parse_with(src, &ParseOptions::default().version(version))
        .errors
        .iter()
        .filter_map(|e| e.forbidden_rule())
        .collect()
}

fn assert_rule(src: &str, version: PhpVersion, rule: ForbiddenRule) {
    assert_eq!(rules(src, version), [rule], "{src}");
}

#[test]
fn static_class_in_constant_expression_of_a_class_body() {
    for src in [
        "<?php class A { const C = static::class; }",
        "<?php class A { public $p = static::class; }",
        "<?php class A { function f($x = static::class) {} }",
        "<?php class A { #[Attr(static::class)] function f() {} }",
        "<?php enum E: string { case A = static::class; }",
    ] {
        assert_rule(
            src,
            PhpVersion::Php85,
            ForbiddenRule::StaticClassInConstantExpression,
        );
    }
}

#[test]
fn static_class_in_static_variable_initializer_before_php_83() {
    let src = "<?php class A { function f() { static $x = static::class; } }";
    assert_rule(
        src,
        PhpVersion::Php82,
        ForbiddenRule::StaticClassInConstantExpression,
    );
    assert_eq!(rules(src, PhpVersion::Php83), []);
}

#[test]
fn parent_hook_call_misuse_in_a_class_with_a_parent() {
    for src in [
        "<?php class A extends B { function f() { parent::$a::get(); } }",
        "<?php class A extends B { function f() { parent::${'a'}::get(); } }",
        "<?php class A extends B { function f() { $g = parent::$a::get(...); } }",
        "<?php class A extends B { public $a { get => parent::$b::get(); } }",
        "<?php class A extends B { public $a { set => parent::$a::get(); } }",
    ] {
        assert_rule(src, PhpVersion::Php85, ForbiddenRule::InvalidParentHookCall);
    }
}

#[test]
fn parent_without_a_parent_class() {
    for src in [
        "<?php class A { function f() { parent::g(); } }",
        "<?php class A { function f() { return new parent; } }",
        "<?php class A { function f(): parent {} }",
        "<?php interface I { function f(): parent; }",
        "<?php enum E { case A; function f() { return new parent; } }",
    ] {
        assert_rule(
            src,
            PhpVersion::Php85,
            ForbiddenRule::ParentWithoutParentClass,
        );
    }
}

#[test]
fn class_keyword_in_a_function_nested_in_a_method() {
    for src in [
        "<?php class A { function f() { function g() { return self::C; } } }",
        "<?php class A { function f() { function g(): static {} } }",
        "<?php class A extends B { function f() { function g() { parent::h(); } } }",
        "<?php class A { function f() { function g($x) { return $x instanceof static; } } }",
    ] {
        assert_rule(
            src,
            PhpVersion::Php85,
            ForbiddenRule::ClassKeywordOutsideClass,
        );
    }
}

#[test]
fn fully_qualified_class_keyword_in_a_class_body() {
    assert_rule(
        "<?php class A { function f() { return \\self::C; } }",
        PhpVersion::Php85,
        ForbiddenRule::QualifiedClassKeyword,
    );
}

#[test]
fn valid_class_keywords_in_a_class_body() {
    for src in [
        "<?php class A extends B { const C = self::class; public $p = self::X; \
         function f(): static { return new static(parent::g(), self::$x, static::h(), $x instanceof self); } }",
        "<?php class A extends B { public $a { get => parent::$a::get(); } }",
        "<?php class A { function f() { $g = function () { return parent::g(); }; } }",
        "<?php trait T { function f() { return parent::g(); } }",
        "<?php function f() { return new class extends B { function g() { return parent::h(); } }; }",
    ] {
        assert_eq!(rules(src, PhpVersion::Php85), [], "{src}");
    }
}
