//! Tests for malformed/invalid PHP - testing error paths and recovery
mod common;

// ============================================================================
// DECLARE STATEMENT ERRORS
// ============================================================================

#[test]
fn declare_incomplete_paren() {
    let code = "<?php declare(";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    // Should parse but have errors
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn declare_missing_equals() {
    let code = "<?php declare(strict_types 1);";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    // Should parse with error recovery
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn declare_unclosed() {
    let code = "<?php declare(strict_types=1";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// TRAIT ADAPTATION ERRORS
// ============================================================================

#[test]
fn trait_missing_method_name() {
    let code = "<?php trait A {} class C { use A { insteadof; } }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn trait_invalid_adaptation_syntax() {
    let code = "<?php trait A { public function m() {} } class C { use A { m invalid; } }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn trait_unclosed_brace() {
    let code = "<?php trait A {} class C { use A { m as x; }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// CLASS DEFINITION ERRORS
// ============================================================================

#[test]
fn class_missing_name() {
    let code = "<?php class { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn class_unclosed() {
    let code = "<?php class Test {";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn class_invalid_extends() {
    let code = "<?php class Test extends { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn class_invalid_implements() {
    let code = "<?php class Test implements { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// FUNCTION DEFINITION ERRORS
// ============================================================================

#[test]
fn function_missing_name() {
    let code = "<?php function ( ) { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn function_unclosed_params() {
    let code = "<?php function test(int $x { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn function_unclosed_body() {
    let code = "<?php function test() {";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn function_invalid_return_type() {
    let code = "<?php function test(): { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// NAMESPACE ERRORS
// ============================================================================

#[test]
fn namespace_missing_name() {
    let code = "<?php namespace;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn namespace_unclosed_braces() {
    let code = "<?php namespace App {";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn use_missing_name() {
    let code = "<?php use;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// CONTROL FLOW ERRORS
// ============================================================================

#[test]
fn if_missing_condition() {
    let code = "<?php if { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn if_unclosed_condition() {
    let code = "<?php if ( { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn switch_missing_expr() {
    let code = "<?php switch { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn case_without_switch() {
    let code = "<?php case 1: echo 'x';";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn default_without_switch() {
    let code = "<?php default: echo 'x';";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// TRY/CATCH ERRORS
// ============================================================================

#[test]
fn try_without_catch_or_finally() {
    let code = "<?php try { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn catch_missing_exception() {
    let code = "<?php try { } catch { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn catch_unclosed_paren() {
    let code = "<?php try { } catch (Exception { }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// ARRAY ERRORS
// ============================================================================

#[test]
fn array_unclosed_bracket() {
    let code = "<?php $a = [1, 2, 3;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn array_invalid_key() {
    let code = "<?php $a = [=> 'value'];";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// EXPRESSION ERRORS
// ============================================================================

#[test]
fn incomplete_ternary() {
    let code = "<?php $x ? ";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn incomplete_match() {
    let code = "<?php match ($x) {";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn invalid_operator() {
    let code = "<?php $x <> $y;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// STRING/HEREDOC ERRORS
// ============================================================================

#[test]
fn unclosed_double_quote() {
    let code = "<?php \"unclosed string";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn unclosed_single_quote() {
    let code = "<?php 'unclosed string";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn unclosed_heredoc() {
    let code = "<?php <<<EOT\nContent";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// PROPERTY/CONSTANT ERRORS
// ============================================================================

#[test]
fn property_missing_dollar() {
    let code = "<?php class Test { public x; }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn const_without_value() {
    let code = "<?php const X;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// GOTO/LABEL ERRORS
// ============================================================================

#[test]
fn goto_undefined_label() {
    let code = "<?php goto undefined;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn label_missing_colon() {
    let code = "<?php label echo 'x';";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// SWITCH/MATCH STATEMENT ERRORS
// ============================================================================

#[test]
fn switch_multiple_defaults() {
    let code = "<?php switch ($x) { default: break; case 1: break; default: break; }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn match_missing_expression_after_arrow() {
    let code = "<?php match($x) { 1 => }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn match_missing_comma() {
    let code = "<?php match($x) { 1 => 'a' 2 => 'b' }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// TYPE HINT ERRORS
// ============================================================================

#[test]
fn repeated_union_types() {
    // PHP allows it but it's semantically redundant - tests error recovery
    let code = "<?php function f(int|string|int): int {}";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn invalid_type_union_void() {
    let code = "<?php function f(): int|void {}";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// ARRAY UNPACKING ERRORS
// ============================================================================

#[test]
fn array_unpack_with_string_keys() {
    // String keys cannot be unpacked - tests error handling
    let code = "<?php $a = ['x' => 1]; $b = [...$a];";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn array_nested_unpack_syntax() {
    // Tests complex nested spread syntax
    let code = "<?php [...[...[1, 2]], 3];";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// DECLARE STATEMENT EDGE CASES
// ============================================================================

#[test]
fn declare_multiple_directives_mixed() {
    // Valid: multiple different directives
    let code = "<?php declare(encoding='UTF-8', strict_types=1, ticks=1);";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn declare_in_conditional() {
    // Edge case: declare inside if statement
    let code = "<?php if (true) { declare(strict_types=1); }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// TRAIT ADAPTATION COMPLEX CASES
// ============================================================================

#[test]
fn trait_multiple_insteadof() {
    // Edge case: multiple insteadof with multiple traits
    let code = "<?php
    trait T1 { public function m() {} }
    trait T2 { public function m() {} }
    trait T3 { public function m() {} }
    class C {
        use T1, T2, T3 {
            T1::m insteadof T2, T3;
            T2::m insteadof T3;
        }
    }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// NAMESPACE/USE EDGE CASES
// ============================================================================

#[test]
fn grouped_use_mixed_types_invalid() {
    // Invalid: grouped use with mixed kinds (const/function) without proper group syntax
    let code = "<?php use const A\\B, function C\\D;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    // Should parse but have errors (or recover gracefully)
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn deep_namespace_nesting() {
    // Edge case: deep namespace nesting (5+ levels)
    let code = "<?php namespace A\\B\\C\\D\\E\\F\\G { class X {} }";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

// ============================================================================
// LIST DESTRUCTURING EDGE CASES
// ============================================================================

#[test]
fn list_nested_destructuring() {
    // Edge case: nested list destructuring
    let code = "<?php list($a, [[$b, $c]]) = [[1, [2, 3]]];";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn list_with_string_keys() {
    // Edge case: list with string keys (unusual but valid)
    let code = "<?php list('key' => $value) = $arr;";
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let _ = serde_json::to_string_pretty(&result.program).unwrap();
}
