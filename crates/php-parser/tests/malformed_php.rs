//! Programmatic tests that cannot be expressed as static fixture files.
//!
//! All other error-case tests live in `tests/fixtures/errors/*.phpt` and are
//! run automatically by `integration::error_fixtures()`.

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

// ============================================================================
// NESTING DEPTH LIMIT
// These tests generate input programmatically and must stay inline.
// ============================================================================

#[test]
fn deeply_nested_arrays_hit_depth_limit() {
    let nested = format!("<?php {}{};", "[".repeat(75), "]".repeat(75));
    // Debug builds use more stack per recursive call; run in a larger-stack thread.
    std::thread::Builder::new()
        .stack_size(16 * 1024 * 1024)
        .spawn(move || {
            let result = parse(&nested);
            let msgs = format_errors(&result);
            assert!(
                !msgs.is_empty(),
                "expected parse errors for deeply nested arrays"
            );
            insta::assert_snapshot!(msgs);
        })
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
        .spawn(move || {
            let result = parse(&nested);
            let msgs = format_errors(&result);
            assert!(
                !msgs.is_empty(),
                "expected parse errors for deeply nested parens"
            );
            insta::assert_snapshot!(msgs);
        })
        .unwrap()
        .join()
        .unwrap();
}
