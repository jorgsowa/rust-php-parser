//! Programmatic tests that cannot be expressed as static fixture files.
//!
//! All other error-case tests live in `tests/fixtures/errors/*.phpt` and are
//! run automatically by `integration::fixtures()`.

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
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    assert!(
        !result.errors.is_empty(),
        "expected parse errors but got none for: {}...",
        &code[..code.len().min(80)]
    );
}

fn assert_depth_exceeded(code: &str) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    let msgs = format_errors(&result);
    assert!(
        msgs.contains("maximum expression nesting depth exceeded"),
        "expected depth-limit error, got:\n{msgs}"
    );
}

fn assert_no_errors(code: &str) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
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
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, &code);
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

// ============================================================================
// UNTERMINATED STRINGS ENDING WITH MULTI-BYTE UTF-8 CHARACTERS
// Slicing &str by byte index panics when the index lands inside a multi-byte
// character (non-char boundary). These tests cover each string-literal kind.
// ============================================================================

/// Original fuzzer crash: unterminated double-quoted string whose last bytes
/// are the 2-byte UTF-8 encoding of U+05C7 (ׇ, bytes 0xD7 0x87).
#[test]
fn fuzz_crash_repro_double_quoted_multibyte_end() {
    let data = b"\x3c\x3f\x3c\x3f\x70\x68\x70\x20\x63\x6c\x61\x73\x12\x24\x78\x22\x68\x65\x20\x3d\x20\x5b\x74\x70\x68\x70\x20\xd7\x87";
    if let Ok(src) = std::str::from_utf8(data) {
        let arena = bumpalo::Bump::new();
        let _ = php_rs_parser::parse(&arena, src);
    }
}

/// Unterminated double-quoted string ending mid-3-byte character (U+4E16 世).
#[test]
fn unterminated_double_quoted_ends_with_3byte_char() {
    // "世 — opening quote, then the first 2 of 3 bytes of 世 (0xE4 0xB8 0x96)
    let src = "<?php \"世\u{4E16}";
    let arena = bumpalo::Bump::new();
    let _ = php_rs_parser::parse(&arena, src);
}

/// Unterminated single-quoted string ending with a 2-byte UTF-8 character.
#[test]
fn unterminated_single_quoted_ends_with_multibyte_char() {
    let src = "<?php 'héllo"; // unterminated, ends with 'o' but has 2-byte é
    let arena = bumpalo::Bump::new();
    let _ = php_rs_parser::parse(&arena, src);
    // Variant: last char is the multi-byte one
    let src2 = "<?php 'hé"; // unterminated, last char is 2-byte é
    let arena2 = bumpalo::Bump::new();
    let _ = php_rs_parser::parse(&arena2, src2);
}

/// Unterminated backtick string ending with a 2-byte UTF-8 character.
#[test]
fn unterminated_backtick_ends_with_multibyte_char() {
    let src = "<?php `cmd é"; // unterminated backtick, last char is 2-byte
    let arena = bumpalo::Bump::new();
    let _ = php_rs_parser::parse(&arena, src);
}

/// b-prefixed double-quoted string, unterminated, ending with multi-byte char.
#[test]
fn unterminated_b_prefixed_double_quoted_ends_with_multibyte_char() {
    let src = "<?php b\"héllo"; // b-prefix, unterminated
    let arena = bumpalo::Bump::new();
    let _ = php_rs_parser::parse(&arena, src);
}

// ============================================================================
// parse_statement — single-statement API
// These tests use parse_statement/parse_statement_versioned, which start in
// PHP mode at a given byte offset and return a single Stmt.  They cannot be
// expressed as .phpt fixtures because the fixture runner always invokes the
// full parse() API.
// ============================================================================

#[test]
fn parse_statement_basic() {
    let arena = bumpalo::Bump::new();
    // Skip the "<?php " prefix (6 bytes) so we start right at the statement.
    let source = "<?php $x = 42;";
    let result = php_rs_parser::parse_statement(&arena, source, 6);
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    assert!(result.stmt.is_some(), "expected a statement");
}

#[test]
fn parse_statement_second_statement() {
    let arena = bumpalo::Bump::new();
    // Source has two statements; we skip ahead to parse only the second one.
    let source = "<?php $x = 1; $y = 2;";
    //                           ^ offset 14 — "$y = 2;"
    let result = php_rs_parser::parse_statement(&arena, source, 14);
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    assert!(result.stmt.is_some(), "expected a statement");
}

#[test]
fn parse_statement_at_eof_returns_none() {
    let arena = bumpalo::Bump::new();
    let source = "<?php $x = 1;";
    // Offset at the end of source → should return None (no statement).
    let result = php_rs_parser::parse_statement(&arena, source, source.len());
    assert!(result.stmt.is_none(), "expected None at EOF");
}

#[test]
fn parse_statement_versioned_emits_version_error() {
    let arena = bumpalo::Bump::new();
    // Enum syntax requires PHP 8.1; targeting 8.0 should emit a VersionTooLow error.
    let source = "<?php enum Status { case Active; }";
    let result = php_rs_parser::parse_statement_versioned(
        &arena,
        source,
        6,
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(result.stmt.is_some(), "statement should still be produced");
    assert!(
        !result.errors.is_empty(),
        "expected a VersionTooLow error for enum on PHP 8.0"
    );
    let msg = result.errors[0].to_string();
    assert!(msg.contains("requires PHP"), "unexpected error: {msg}");
}

#[test]
fn parse_statement_with_syntax_error() {
    let arena = bumpalo::Bump::new();
    // Missing semicolon — parser should recover and still return a stmt.
    let source = "<?php $x = 42";
    let result = php_rs_parser::parse_statement(&arena, source, 6);
    assert!(result.stmt.is_some(), "expected a (recovered) statement");
    assert!(
        !result.errors.is_empty(),
        "expected a parse error for missing semicolon"
    );
}
