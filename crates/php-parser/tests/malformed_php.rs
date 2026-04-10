//! Programmatic tests that cannot be expressed as static fixture files.
//!
//! All other error-case tests live in `tests/fixtures/errors/*.phpt` and are
//! run automatically by `integration::fixtures()`.

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

/// Run a test on a large thread stack to avoid stack overflow on deeply nested input.
fn with_large_stack<F: FnOnce() + Send + 'static>(f: F) {
    std::thread::Builder::new()
        .stack_size(16 * 1024 * 1024)
        .spawn(f)
        .unwrap()
        .join()
        .unwrap();
}

fn assert_has_errors(code: &str) {
    let result = parse(code);
    assert!(
        !result.errors.is_empty(),
        "expected parse errors but got none for: {}...",
        &code[..code.len().min(80)]
    );
}

fn assert_depth_exceeded(code: &str) {
    let result = parse(code);
    let msgs = format_errors(&result);
    assert!(
        msgs.contains("maximum expression nesting depth exceeded"),
        "expected depth-limit error, got:\n{msgs}"
    );
}

fn assert_no_errors(code: &str) {
    let result = parse(code);
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {}",
        format_errors(&result)
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
fn deeply_nested_parens_hit_depth_limit() {
    let nested = format!("<?php {}{};", "(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
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
fn deeply_nested_binary_ops_hit_depth_limit() {
    // $x + ($x + ($x + ... ))
    let nested = format!("<?php {}{};", "($x + ".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_function_calls_hit_depth_limit() {
    // f(f(f(f(...))))
    let nested = format!("<?php {}{};", "f(".repeat(75), ")".repeat(75));
    with_large_stack(move || assert_depth_exceeded(&nested));
}

#[test]
fn deeply_nested_match_hit_depth_limit() {
    // match(match(match(...) {}) {}) {}
    let open = "match(".repeat(75);
    let close = ") { default => 1 }".repeat(75);
    let nested = format!("<?php {open}1{close};");
    with_large_stack(move || assert_depth_exceeded(&nested));
}

// ============================================================================
// LARGE INPUT / REPETITIVE PATTERNS
// Ensures the parser handles high volume without panicking or hanging.
// ============================================================================

#[test]
fn many_sequential_statements() {
    let code = format!("<?php {}", "$x = 1;\n".repeat(10_000));
    let result = parse(&code);
    assert!(result.errors.is_empty());
}

#[test]
fn very_long_concatenation_chain() {
    // "a" . "b" . "c" . ... (flat, not nested — should not hit depth limit)
    let parts: Vec<&str> = (0..5_000).map(|_| "\"a\"").collect();
    let code = format!("<?php echo {};", parts.join(" . "));
    assert_no_errors(&code);
}

#[test]
fn many_function_parameters() {
    let params: Vec<String> = (0..500).map(|i| format!("$p{i}")).collect();
    let code = format!("<?php function f({}) {{}}", params.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_array_elements() {
    let elements: Vec<String> = (0..5_000).map(|i| i.to_string()).collect();
    let code = format!("<?php [{}];", elements.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_match_arms() {
    let arms: Vec<String> = (0..500).map(|i| format!("{i} => {i}")).collect();
    let code = format!("<?php match($x) {{ {} }};", arms.join(", "));
    assert_no_errors(&code);
}

#[test]
fn many_method_chains() {
    let chain = "->m()".repeat(1_000);
    let code = format!("<?php $obj{chain};");
    assert_no_errors(&code);
}

#[test]
fn many_class_members() {
    let members: Vec<String> = (0..500)
        .map(|i| format!("public int $p{i} = {i};"))
        .collect();
    let code = format!("<?php class C {{ {} }}", members.join("\n"));
    assert_no_errors(&code);
}

// ============================================================================
// NULL BYTES
// Cannot be expressed in .phpt fixture files.
// ============================================================================

#[test]
fn null_bytes_in_source() {
    assert_has_errors("<?php $x = \0;");
}
