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
