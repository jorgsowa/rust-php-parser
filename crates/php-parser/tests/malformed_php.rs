//! Tests for malformed/invalid PHP - testing error paths and recovery.
//!
//! Tests that expect syntax errors call `assert_errors_snapshot!`, which:
//!   1. asserts the parser produced at least one error
//!   2. snapshots the error messages so regressions in diagnostics are caught
//!
//! Tests that expect clean parses call `assert_parses_clean!`, which asserts
//! that the parser accepted the input without errors.
fn parse(code: &str) -> php_rs_parser::ParseResult<'_, '_> {
    let arena = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, code)
}

fn format_errors(result: &php_rs_parser::ParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

macro_rules! assert_errors_snapshot {
    ($code:expr) => {{
        let result = parse($code);
        let msgs = format_errors(&result);
        assert!(!msgs.is_empty(), "expected parse errors for:\n{}", $code);
        insta::assert_snapshot!(msgs);
    }};
}

macro_rules! assert_parses_clean {
    ($code:expr) => {{
        let result = parse($code);
        assert!(
            result.errors.is_empty(),
            "unexpected parse errors for:\n{}\nerrors: {:#?}",
            $code,
            result.errors
        );
    }};
}

// ============================================================================
// DECLARE STATEMENT ERRORS
// ============================================================================

#[test]
fn declare_incomplete_paren() {
    assert_errors_snapshot!("<?php declare(");
}

#[test]
fn declare_missing_equals() {
    assert_errors_snapshot!("<?php declare(strict_types 1);");
}

#[test]
fn declare_unclosed() {
    assert_errors_snapshot!("<?php declare(strict_types=1");
}

// ============================================================================
// TRAIT ADAPTATION ERRORS
// ============================================================================

#[test]
fn trait_missing_method_name() {
    assert_errors_snapshot!("<?php trait A {} class C { use A { insteadof; } }");
}

#[test]
fn trait_invalid_adaptation_syntax() {
    assert_errors_snapshot!(
        "<?php trait A { public function m() {} } class C { use A { m invalid; } }"
    );
}

#[test]
fn trait_unclosed_brace() {
    assert_errors_snapshot!("<?php trait A {} class C { use A { m as x; }");
}

// ============================================================================
// CLASS DEFINITION ERRORS
// ============================================================================

#[test]
fn class_missing_name() {
    assert_errors_snapshot!("<?php class { }");
}

#[test]
fn class_unclosed() {
    assert_errors_snapshot!("<?php class Test {");
}

#[test]
fn class_invalid_extends() {
    assert_errors_snapshot!("<?php class Test extends { }");
}

#[test]
fn class_invalid_implements() {
    assert_errors_snapshot!("<?php class Test implements { }");
}

// ============================================================================
// FUNCTION DEFINITION ERRORS
// ============================================================================

#[test]
fn function_unclosed_params() {
    assert_errors_snapshot!("<?php function test(int $x { }");
}

#[test]
fn function_unclosed_body() {
    assert_errors_snapshot!("<?php function test() {");
}

#[test]
fn function_invalid_return_type() {
    assert_errors_snapshot!("<?php function test(): { }");
}

// ============================================================================
// NAMESPACE ERRORS
// ============================================================================

#[test]
fn namespace_missing_name() {
    assert_errors_snapshot!("<?php namespace;");
}

#[test]
fn namespace_unclosed_braces() {
    assert_errors_snapshot!("<?php namespace App {");
}

#[test]
fn use_missing_name() {
    assert_errors_snapshot!("<?php use;");
}

// ============================================================================
// CONTROL FLOW ERRORS
// ============================================================================

#[test]
fn if_missing_condition() {
    assert_errors_snapshot!("<?php if { }");
}

#[test]
fn if_unclosed_condition() {
    assert_errors_snapshot!("<?php if ( { }");
}

#[test]
fn switch_missing_expr() {
    assert_errors_snapshot!("<?php switch { }");
}

// ============================================================================
// TRY/CATCH ERRORS
// ============================================================================

#[test]
fn try_without_catch_or_finally() {
    assert_errors_snapshot!("<?php try { }");
}

#[test]
fn catch_missing_exception() {
    assert_errors_snapshot!("<?php try { } catch { }");
}

#[test]
fn catch_unclosed_paren() {
    assert_errors_snapshot!("<?php try { } catch (Exception { }");
}

// ============================================================================
// ARRAY ERRORS
// ============================================================================

#[test]
fn array_unclosed_bracket() {
    assert_errors_snapshot!("<?php $a = [1, 2, 3;");
}

#[test]
fn array_invalid_key() {
    assert_errors_snapshot!("<?php $a = [=> 'value'];");
}

// ============================================================================
// EXPRESSION ERRORS
// ============================================================================

#[test]
fn incomplete_ternary() {
    assert_errors_snapshot!("<?php $x ? ");
}

#[test]
fn incomplete_match() {
    assert_errors_snapshot!("<?php match ($x) {");
}

// ============================================================================
// STRING/HEREDOC ERRORS
// ============================================================================

#[test]
fn unclosed_double_quote() {
    assert_errors_snapshot!("<?php \"unclosed string");
}

#[test]
fn unclosed_single_quote() {
    assert_errors_snapshot!("<?php 'unclosed string");
}

#[test]
fn unclosed_heredoc() {
    assert_errors_snapshot!("<?php <<<EOT\nContent");
}

// ============================================================================
// PROPERTY/CONSTANT ERRORS
// ============================================================================

#[test]
fn const_without_value() {
    assert_errors_snapshot!("<?php const X;");
}

// ============================================================================
// SWITCH/MATCH STATEMENT ERRORS
// ============================================================================

#[test]
fn match_missing_expression_after_arrow() {
    assert_errors_snapshot!("<?php match($x) { 1 => }");
}

#[test]
fn match_missing_comma() {
    assert_errors_snapshot!("<?php match($x) { 1 => 'a' 2 => 'b' }");
}

// ============================================================================
// VALID BUT UNUSUAL SYNTAX (parser must accept these cleanly)
// ============================================================================

#[test]
fn switch_multiple_defaults() {
    // Duplicate default is a semantic error, not a parse error
    assert_parses_clean!("<?php switch ($x) { default: break; case 1: break; default: break; }");
}

#[test]
fn array_unpack_with_string_keys() {
    assert_parses_clean!("<?php $a = ['x' => 1]; $b = [...$a];");
}

#[test]
fn array_nested_unpack_syntax() {
    assert_parses_clean!("<?php [...[...[1, 2]], 3];");
}

#[test]
fn goto_undefined_label() {
    // Undefined label is a compile-time error, not a parse error
    assert_parses_clean!("<?php goto undefined;");
}

#[test]
fn repeated_union_types() {
    // The parser tries to parse the trailing `int` as a typed parameter name,
    // then fails to find `$` — so this does produce a parse error.
    assert_errors_snapshot!("<?php function f(int|string|int): int {}");
}

#[test]
fn declare_multiple_directives_mixed() {
    assert_parses_clean!("<?php declare(encoding='UTF-8', strict_types=1, ticks=1);");
}

#[test]
fn declare_in_conditional() {
    assert_parses_clean!("<?php if (true) { declare(strict_types=1); }");
}

#[test]
fn trait_multiple_insteadof() {
    assert_parses_clean!(
        "<?php
        trait T1 { public function m() {} }
        trait T2 { public function m() {} }
        trait T3 { public function m() {} }
        class C {
            use T1, T2, T3 {
                T1::m insteadof T2, T3;
                T2::m insteadof T3;
            }
        }"
    );
}

#[test]
fn deep_namespace_nesting() {
    assert_parses_clean!("<?php namespace A\\B\\C\\D\\E\\F\\G { class X {} }");
}

#[test]
fn list_nested_destructuring() {
    assert_parses_clean!("<?php list($a, [[$b, $c]]) = [[1, [2, 3]]];");
}

#[test]
fn list_with_string_keys() {
    assert_parses_clean!("<?php list('key' => $value) = $arr;");
}

// ============================================================================
// NESTING DEPTH LIMIT
// ============================================================================

#[test]
fn deeply_nested_arrays_hit_depth_limit() {
    let nested = format!("<?php {}{};", "[".repeat(75), "]".repeat(75));
    // Debug builds use more stack per recursive call; run in a larger-stack thread.
    std::thread::Builder::new()
        .stack_size(16 * 1024 * 1024)
        .spawn(move || assert_errors_snapshot!(&nested))
        .unwrap()
        .join()
        .unwrap();
}

#[test]
fn deeply_nested_parens_hit_depth_limit() {
    let nested = format!("<?php {}{};", "(".repeat(75), ")".repeat(75));
    // Debug builds use more stack per recursive call; run in a larger-stack thread.
    std::thread::Builder::new()
        .stack_size(16 * 1024 * 1024)
        .spawn(move || assert_errors_snapshot!(&nested))
        .unwrap()
        .join()
        .unwrap();
}

// ============================================================================
// ERROR + RECOVERY INTERACTION TESTS
// ============================================================================
//
// These tests verify that parse errors in one construct do not prevent the
// parser from recovering and correctly parsing subsequent valid constructs.
// Each test has an error followed by at least one valid statement/declaration.

#[test]
fn class_missing_name_then_valid_function() {
    assert_errors_snapshot!("<?php class {} function foo(): int { return 1; }");
}

#[test]
fn function_missing_name_then_valid_class() {
    assert_errors_snapshot!("<?php function () {} class Foo {}");
}

#[test]
fn missing_semicolon_then_valid_assignment() {
    assert_errors_snapshot!("<?php $x = 1 $y = 2;");
}

#[test]
fn unclosed_string_then_valid_echo() {
    assert_errors_snapshot!("<?php $x = 'unterminated\n echo 'hello';");
}

#[test]
fn invalid_expression_then_valid_function() {
    assert_errors_snapshot!("<?php $x = ; function foo() { return 42; }");
}

#[test]
fn malformed_if_condition_then_valid_return() {
    assert_errors_snapshot!("<?php function f() { if () { return 1; } return 2; }");
}

#[test]
fn class_error_then_valid_class() {
    assert_errors_snapshot!("<?php class Foo { public function } class Bar { public int $x = 1; }");
}

#[test]
fn namespace_error_then_valid_namespace() {
    assert_errors_snapshot!("<?php namespace ; namespace Foo\\Bar;");
}

#[test]
fn try_missing_catch_then_valid_echo() {
    assert_errors_snapshot!("<?php try { $x = 1; } echo 'after';");
}

#[test]
fn interface_error_then_valid_class() {
    // Interface constant with missing value (parse error) followed by valid class
    assert_errors_snapshot!("<?php interface Foo { const X = ; } class Baz {}");
}

#[test]
fn trait_error_then_valid_class() {
    assert_errors_snapshot!("<?php trait T { public function } class C { use T; }");
}

#[test]
fn enum_error_then_valid_function() {
    // Malformed enum case (missing value after `=`) followed by a valid function
    assert_errors_snapshot!(
        "<?php enum Status { case Active = ; } function use_status() { return Status::Active; }"
    );
}

#[test]
fn for_loop_error_then_valid_while() {
    assert_errors_snapshot!("<?php for (;;; ) {} while (true) { break; }");
}

#[test]
fn match_error_then_valid_assignment() {
    assert_errors_snapshot!("<?php $x = match ($y) { 1 => }; $z = 42;");
}

#[test]
fn multiple_errors_recover_to_valid_function() {
    assert_errors_snapshot!(
        "<?php
        $a = ;
        $b = ;
        function healthy(): string { return 'ok'; }"
    );
}

#[test]
fn array_destructure_error_then_valid_echo() {
    assert_errors_snapshot!("<?php [$a, , ,] = ; echo $a;");
}

#[test]
fn class_method_error_then_valid_method() {
    assert_errors_snapshot!(
        "<?php class Foo {
            public function bad(int ) {}
            public function good(): string { return 'ok'; }
        }"
    );
}

#[test]
fn use_error_then_valid_class() {
    assert_errors_snapshot!("<?php use ; class Foo {}");
}

#[test]
fn switch_missing_expr_then_valid_if() {
    assert_errors_snapshot!("<?php switch () { case 1: break; } if (true) { echo 'ok'; }");
}

#[test]
fn abstract_property_in_class() {
    assert_errors_snapshot!("<?php class Foo { abstract public string $bar; }");
}

#[test]
fn abstract_property_no_visibility() {
    assert_errors_snapshot!("<?php class Foo { abstract string $bar; }");
}

#[test]
fn abstract_method_in_enum() {
    assert_errors_snapshot!("<?php enum Status { abstract public function label(): string; }");
}
