//! Programmatic tests that cannot be expressed as static fixture files.
//!
//! All other error-case tests live in `tests/fixtures/errors/*.phpt` and are
//! run automatically by `fixtures()`.

use crate::common::format_errors;

/// Run a test on a large thread stack to avoid stack overflow on deeply nested input.
fn with_large_stack<F: FnOnce() + Send + 'static>(f: F) {
    with_stack(16 * 1024 * 1024, f);
}

fn with_stack<F: FnOnce() + Send + 'static>(bytes: usize, f: F) {
    std::thread::Builder::new()
        .stack_size(bytes)
        .spawn(f)
        .unwrap()
        .join()
        .unwrap();
}

fn assert_has_errors(code: &str) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, code);
    assert!(
        !result.errors.is_empty(),
        "expected parse errors but got none for: {}...",
        &code[..code.len().min(80)]
    );
}

fn assert_has_errors_owned(code: &str) {
    let result = php_rs_parser::parse(code);
    assert!(
        !result.errors.is_empty(),
        "(owned) expected parse errors but got none for: {}...",
        &code[..code.len().min(80)]
    );
}

fn assert_depth_exceeded(code: &str) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, code);
    let msgs = format_errors(&result);
    assert!(
        msgs.contains("maximum expression nesting depth exceeded"),
        "expected depth-limit error, got:\n{msgs}"
    );
}

fn assert_depth_exceeded_owned(code: &str) {
    let result = php_rs_parser::parse(code);
    let msgs = result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n");
    assert!(
        msgs.contains("maximum expression nesting depth exceeded"),
        "(owned) expected depth-limit error, got:\n{msgs}"
    );
}

fn assert_no_errors(code: &str) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, code);
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {}",
        format_errors(&result)
    );
}

fn assert_no_errors_owned(code: &str) {
    let result = php_rs_parser::parse(code);
    assert!(
        result.errors.is_empty(),
        "(owned) unexpected errors: {}",
        result
            .errors
            .iter()
            .map(|e| e.to_string())
            .collect::<Vec<_>>()
            .join("\n")
    );
}

// ============================================================================
// NESTING DEPTH LIMIT
// These tests generate input programmatically and must stay inline.
// ============================================================================

#[test]
fn deeply_nested_arrays_hit_depth_limit() {
    let nested = format!("<?php {}{};", "[".repeat(75), "]".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_arrays_hit_depth_limit_owned() {
    let nested = format!("<?php {}{};", "[".repeat(75), "]".repeat(75));
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

#[test]
fn deeply_nested_parens_hit_depth_limit() {
    let nested = format!("<?php {}{};", "(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_parens_hit_depth_limit_owned() {
    let nested = format!("<?php {}{};", "(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

#[test]
fn deeply_nested_ternary_hit_depth_limit() {
    // $x ? $x ? $x ? ... : 1 : 1 : 1
    let nested = format!(
        "<?php {};",
        "$x ? ".repeat(75).to_string() + "1" + &" : 1".repeat(75)
    );
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_ternary_hit_depth_limit_owned() {
    let nested = format!(
        "<?php {};",
        "$x ? ".repeat(75).to_string() + "1" + &" : 1".repeat(75)
    );
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

#[test]
fn deeply_nested_binary_ops_hit_depth_limit() {
    // $x + ($x + ($x + ... ))
    let nested = format!("<?php {}{};", "($x + ".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_binary_ops_hit_depth_limit_owned() {
    let nested = format!("<?php {}{};", "($x + ".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

#[test]
fn deeply_nested_function_calls_hit_depth_limit() {
    // f(f(f(f(...))))
    let nested = format!("<?php {}{};", "f(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_function_calls_hit_depth_limit_owned() {
    let nested = format!("<?php {}{};", "f(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

#[test]
fn deeply_nested_match_hit_depth_limit() {
    // match(match(match(...) {}) {}) {}
    let open = "match(".repeat(75);
    let close = ") { default => 1 }".repeat(75);
    let nested = format!("<?php {open}1{close};");
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_match_hit_depth_limit_owned() {
    let open = "match(".repeat(75);
    let close = ") { default => 1 }".repeat(75);
    let nested = format!("<?php {open}1{close};");
    with_large_stack(move || assert_depth_exceeded_owned(&nested));
}

// ============================================================================
// LARGE INPUT / REPETITIVE PATTERNS
// Ensures the parser handles high volume without panicking or hanging.
// ============================================================================

#[test]
fn many_sequential_statements() {
    let code = format!("<?php {}", "$x = 1;\n".repeat(10_000));
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, &code);
    assert!(result.errors.is_empty());
}

#[test]
fn many_sequential_statements_owned() {
    let code = format!("<?php {}", "$x = 1;\n".repeat(10_000));
    assert_no_errors_owned(&code);
}

#[test]
fn very_long_concatenation_chain() {
    // "a" . "b" . "c" . ... (flat, not nested — should not hit depth limit)
    let parts: Vec<&str> = (0..5_000).map(|_| "\"a\"").collect();
    let code = format!("<?php echo {};", parts.join(" . "));
    assert_no_errors(&code);
}

#[test]
fn very_long_concatenation_chain_owned() {
    let parts: Vec<&str> = (0..5_000).map(|_| "\"a\"").collect();
    let code = format!("<?php echo {};", parts.join(" . "));
    // owned conversion recurses through a 5 000-deep binary-op tree; needs extra stack
    with_stack(64 * 1024 * 1024, move || assert_no_errors_owned(&code));
}

#[test]
fn many_function_parameters() {
    let params: Vec<String> = (0..500).map(|i| format!("$p{i}")).collect();
    let code = format!("<?php function f({}) {{}}", params.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_function_parameters_owned() {
    let params: Vec<String> = (0..500).map(|i| format!("$p{i}")).collect();
    let code = format!("<?php function f({}) {{}}", params.join(", "));
    assert_no_errors_owned(&code);
}

#[test]
fn many_array_elements() {
    let elements: Vec<String> = (0..5_000).map(|i| i.to_string()).collect();
    let code = format!("<?php [{}];", elements.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_array_elements_owned() {
    let elements: Vec<String> = (0..5_000).map(|i| i.to_string()).collect();
    let code = format!("<?php [{}];", elements.join(", "));
    assert_no_errors_owned(&code);
}

#[test]
fn many_match_arms() {
    let arms: Vec<String> = (0..500).map(|i| format!("{i} => {i}")).collect();
    let code = format!("<?php match($x) {{ {} }};", arms.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_match_arms_owned() {
    let arms: Vec<String> = (0..500).map(|i| format!("{i} => {i}")).collect();
    let code = format!("<?php match($x) {{ {} }};", arms.join(", "));
    assert_no_errors_owned(&code);
}

#[test]
fn many_method_chains() {
    let chain = "->m()".repeat(1_000);
    let code = format!("<?php $obj{chain};");
    assert_no_errors(&code);
}

#[test]
fn many_method_chains_owned() {
    let chain = "->m()".repeat(1_000);
    let code = format!("<?php $obj{chain};");
    with_large_stack(move || assert_no_errors_owned(&code));
}

#[test]
fn many_class_members() {
    let members: Vec<String> = (0..500)
        .map(|i| format!("public int $p{i} = {i};"))
        .collect();
    let code = format!("<?php class C {{ {} }}", members.join("\n"));
    assert_no_errors(&code);
}

#[test]
fn many_class_members_owned() {
    let members: Vec<String> = (0..500)
        .map(|i| format!("public int $p{i} = {i};"))
        .collect();
    let code = format!("<?php class C {{ {} }}", members.join("\n"));
    assert_no_errors_owned(&code);
}

// ============================================================================
// NULL BYTES
// Cannot be expressed in .phpt fixture files.
// ============================================================================

#[test]
fn null_bytes_in_source() {
    assert_has_errors("<?php $x = \0;");
}

#[test]
fn null_bytes_in_source_owned() {
    assert_has_errors_owned("<?php $x = \0;");
}

// ============================================================================
// FUZZ CRASH REPROS
// Binary byte sequences that cannot be expressed in .phpt fixture files.
// ============================================================================

/// Original fuzzer crash: unterminated double-quoted string whose last bytes
/// are the 2-byte UTF-8 encoding of U+05C7 (ׇ, bytes 0xD7 0x87).
#[test]
fn fuzz_crash_repro_double_quoted_multibyte_end() {
    let data = b"\x3c\x3f\x3c\x3f\x70\x68\x70\x20\x63\x6c\x61\x73\x12\x24\x78\x22\x68\x65\x20\x3d\x20\x5b\x74\x70\x68\x70\x20\xd7\x87";
    if let Ok(src) = std::str::from_utf8(data) {
        let arena = bumpalo::Bump::new();
        let _ = php_rs_parser::parse_arena(&arena, src);
    }
}

#[test]
fn fuzz_crash_repro_double_quoted_multibyte_end_owned() {
    let data = b"\x3c\x3f\x3c\x3f\x70\x68\x70\x20\x63\x6c\x61\x73\x12\x24\x78\x22\x68\x65\x20\x3d\x20\x5b\x74\x70\x68\x70\x20\xd7\x87";
    if let Ok(src) = std::str::from_utf8(data) {
        let _ = php_rs_parser::parse(src);
    }
}
