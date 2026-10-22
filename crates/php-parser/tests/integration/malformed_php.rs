//! Programmatic tests that cannot be expressed as static fixture files.
//!
//! All other error-case tests live in `tests/fixtures/errors/*.phpt` and are
//! run automatically by `fixtures()`.

use crate::common::format_errors;
use php_rs_parser::diagnostics::ParseError;

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
    assert!(
        result
            .errors
            .iter()
            .any(|e| matches!(e, ParseError::NestingTooDeep { .. })),
        "expected depth-limit error, got:\n{}",
        format_errors(&result)
    );
}

fn assert_depth_exceeded_owned(code: &str) {
    let result = php_rs_parser::parse(code);
    assert!(
        result
            .errors
            .iter()
            .any(|e| matches!(e, ParseError::NestingTooDeep { .. })),
        "(owned) expected depth-limit error, got:\n{:?}",
        result.errors
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
//
// Statements, expressions and string interpolation share one budget of 512
// levels of parser recursion; a construct can take more than one per level
// (`($x + (...))` takes two: the parentheses and the right operand).
// Unoptimised builds use far more stack per level than release builds, so the
// tests that reach the limit run on a large stack.
// ============================================================================

/// Inside the nesting budget for every construct below.
const VALID_DEPTH: usize = 250;
/// Past the nesting budget.
const EXCESSIVE_DEPTH: usize = 600;

fn with_deep_stack<F: FnOnce() + Send + 'static>(f: F) {
    with_stack(256 * 1024 * 1024, f);
}

/// A named generator that nests one construct `n` levels deep.
type Nester = (&'static str, fn(usize) -> String);

const NESTED_EXPRESSIONS: &[Nester] = &[
    ("arrays", |n| {
        format!("<?php {}{};", "[".repeat(n), "]".repeat(n))
    }),
    ("parens", |n| {
        format!("<?php {}1{};", "(".repeat(n), ")".repeat(n))
    }),
    ("ternary", |n| {
        format!("<?php {}1{};", "$x ? ".repeat(n), " : 1".repeat(n))
    }),
    ("binary_ops", |n| {
        format!("<?php {}$x{};", "($x + ".repeat(n), ")".repeat(n))
    }),
    ("function_calls", |n| {
        format!("<?php {}1{};", "f(".repeat(n), ")".repeat(n))
    }),
    ("match", |n| {
        format!(
            "<?php {}1{};",
            "match(".repeat(n),
            ") { default => 1 }".repeat(n)
        )
    }),
    ("closures", |n| {
        format!(
            "<?php {}1{};",
            "function() { return ".repeat(n),
            "; }".repeat(n)
        )
    }),
    ("arrow_functions", |n| {
        format!("<?php {}1;", "fn() => ".repeat(n))
    }),
    ("casts", |n| format!("<?php {}1;", "(int) ".repeat(n))),
    ("variable_variables", |n| {
        format!("<?php {}x;", "$".repeat(n))
    }),
];

const NESTED_STATEMENTS: &[Nester] = &[
    ("blocks", |n| {
        format!("<?php {}{}", "{".repeat(n), "}".repeat(n))
    }),
    ("if_blocks", |n| {
        format!("<?php {}{}", "if (1) {".repeat(n), "}".repeat(n))
    }),
    ("braceless_if", |n| {
        format!("<?php {}echo 1;", "if (1) ".repeat(n))
    }),
    ("else_if", |n| {
        format!("<?php if (1) {{}}{}", " else if (1) {}".repeat(n))
    }),
    ("anonymous_classes", |n| {
        format!(
            "<?php {}{}",
            "new class { function f() { ".repeat(n),
            "} };".repeat(n)
        )
    }),
];

#[test]
fn nesting_within_budget_parses_without_errors() {
    with_deep_stack(|| {
        for (name, generate) in NESTED_EXPRESSIONS.iter().chain(NESTED_STATEMENTS) {
            let code = generate(VALID_DEPTH);
            let arena = bumpalo::Bump::new();
            let result = php_rs_parser::parse_arena(&arena, &code);
            assert!(
                result.errors.is_empty(),
                "{name}: unexpected errors: {}",
                format_errors(&result)
            );
        }
    });
}

#[test]
fn nesting_past_budget_reports_error() {
    with_deep_stack(|| {
        for (name, generate) in NESTED_EXPRESSIONS.iter().chain(NESTED_STATEMENTS) {
            let code = generate(EXCESSIVE_DEPTH);
            eprintln!("checking {name}");
            assert_depth_exceeded(&code);
            assert_depth_exceeded_owned(&code);
        }
    });
}

/// The 50-level expression limit used to reject plausible generated code such
/// as deeply nested config arrays.
#[test]
fn moderately_nested_arrays_are_valid() {
    let code = format!("<?php return {}1{};", "['k' => ".repeat(75), "]".repeat(75));
    with_deep_stack(move || {
        assert_no_errors(&code);
        assert_no_errors_owned(&code);
    });
}

/// Reaching the limit must not take time or memory proportional to the
/// remaining input: every level past the budget is skipped linearly.
#[test]
fn far_too_deep_nesting_is_rejected_without_crashing() {
    with_deep_stack(|| {
        for code in [
            format!("<?php {}", "{".repeat(100_000)),
            format!("<?php {}", "if (1) {".repeat(20_000)),
            format!("<?php {};", "(".repeat(100_000)),
            format!("<?php {}x;", "$".repeat(100_000)),
        ] {
            assert_depth_exceeded(&code);
            assert_depth_exceeded_owned(&code);
        }
    });
}

#[test]
fn string_interpolation_shares_the_nesting_budget() {
    with_deep_stack(|| {
        // An interpolated expression must not restart the count at zero.
        let code = format!(
            "<?php {}\"{{$a[{}1{}]}}\"{};",
            "(".repeat(500),
            "(".repeat(100),
            ")".repeat(100),
            ")".repeat(500)
        );
        assert_depth_exceeded(&code);
        assert_depth_exceeded_owned(&code);

        // A little nesting on either side of the string is fine.
        let code = format!(
            "<?php {}\"{{$a[{}1{}]}}\"{};",
            "(".repeat(100),
            "(".repeat(100),
            ")".repeat(100),
            ")".repeat(100)
        );
        assert_no_errors(&code);
    });
}

#[test]
fn deeply_nested_double_quoted_strings_are_rejected() {
    for n in [64, 50_000] {
        let code = format!("<?php {}x{};", "\"{$a[".repeat(n), "]}\"".repeat(n));
        with_deep_stack(move || {
            assert_depth_exceeded(&code);
            assert_depth_exceeded_owned(&code);
        });
    }
}

#[test]
fn a_few_nested_double_quoted_strings_are_valid() {
    let code = format!("<?php {}x{};", "\"{$a[".repeat(8), "]}\"".repeat(8));
    assert_no_errors(&code);
}

fn nested_heredocs(n: usize) -> String {
    let mut code = String::from("<?php $x = ");
    for i in 0..n {
        code.push_str(&format!("<<<A{i}\n{{$a["));
    }
    code.push('1');
    for i in (0..n).rev() {
        code.push_str(&format!("]}}\nA{i}\n"));
    }
    code.push(';');
    code
}

#[test]
fn a_few_nested_heredocs_are_valid() {
    assert_no_errors(&nested_heredocs(8));
}

/// Each nested string is re-lexed by its own sub-parser. String nesting is
/// capped well below the general budget so that the work stays a small multiple
/// of the input size instead of growing quadratically with the depth.
#[test]
fn deeply_nested_heredocs_parse_in_linear_time() {
    let small = nested_heredocs(2_000);
    let large = nested_heredocs(16_000);
    with_deep_stack(move || {
        let time = |code: &str| {
            let start = std::time::Instant::now();
            assert_depth_exceeded(code);
            start.elapsed()
        };
        time(&small); // warm-up
        let small_time = time(&small);
        let large_time = time(&large);
        // 8x the input: quadratic growth would take ~64x as long.
        assert!(
            large_time < small_time * 24,
            "2k levels took {small_time:?}, 16k levels took {large_time:?}"
        );
    });
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
    let parts: Vec<&str> = (0..20_000).map(|_| "\"a\"").collect();
    let code = format!("<?php echo {};", parts.join(" . "));
    assert_no_errors(&code);
}

/// A run of prefix operators is parsed in a loop, so it does not use up the
/// nesting budget (php-src's stack_limit_013 nests 7,676 `~`).
#[test]
fn very_long_prefix_chain() {
    assert_no_errors(&format!("<?php $test = [\n    {}1\n];", "~".repeat(7_676)));
    assert_no_errors(&format!("<?php $a = {}$b;", "~-!+".repeat(5_000)));
}

/// Long operator chains are built in a loop by the parser, so their depth is
/// unbounded; converting them to the owned AST and dropping it must not
/// recurse once per link. This runs on a small stack to prove it.
#[test]
fn very_long_chains_owned() {
    let concat = format!("<?php echo $a{};", " . $a".repeat(20_000));
    let methods = format!("<?php $a{};", "->b()".repeat(20_000));
    let mixed = format!("<?php $a{};", "?->b[0]::C->d(...)".repeat(5_000));
    let prefix = format!("<?php $a = {}$b;", "~-!+".repeat(5_000));
    let logical = format!("<?php (true{}) && $a;", " && !0".repeat(20_000));
    with_stack(256 * 1024, move || {
        for code in [concat, methods, mixed, prefix, logical] {
            let result = php_rs_parser::parse(&code);
            assert!(result.errors.is_empty(), "{:?}", result.errors);
            drop(result);
        }
    });
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

/// Spans hold `u32` offsets; a larger source is refused up front in every build
/// profile instead of being parsed with offsets that wrap.
#[test]
#[cfg(target_pointer_width = "64")]
fn source_over_4_gib_is_refused() {
    // Zeroed allocations are mapped lazily, so this does not touch 4 GiB of memory.
    let bytes = vec![0u8; u32::MAX as usize + 1];
    // SAFETY: NUL bytes are valid single-byte UTF-8.
    let source = unsafe { std::str::from_utf8_unchecked(&bytes) };
    let arena = bumpalo::Bump::new();
    for result in [
        php_rs_parser::parse_arena(&arena, source),
        php_rs_parser::parse_arena_with(
            &arena,
            source,
            &php_rs_parser::ParseOptions::default().source_map(false),
        ),
        php_rs_parser::parse_arena_with(
            &arena,
            source,
            &php_rs_parser::ParseOptions::default().version(php_rs_parser::PhpVersion::Php74),
        ),
    ] {
        assert!(result.program.stmts.is_empty());
        assert!(matches!(
            result.errors[..],
            [ParseError::SourceTooLarge { len, .. }] if len == source.len()
        ));
    }
}

/// `found` carries the token's description rather than a php-lexer type, so
/// new tokens are not a breaking change for `ParseError`.
#[test]
fn expected_error_describes_the_found_token() {
    let result = php_rs_parser::parse("<?php foo(1 2);");
    let first = result.errors.first().expect("an error");
    assert!(
        matches!(first, ParseError::Expected { expected, found, .. } if expected == "')'" && found == "integer"),
        "{first:?}"
    );
    assert_eq!(first.to_string(), "expected ')', found integer");
}

#[test]
fn errors_truncated_only_when_errors_were_dropped() {
    let with_errors =
        |n: usize| php_rs_parser::parse(&format!("<?php {}", "(unset) $a;".repeat(n)));

    let at_cap = with_errors(100);
    assert_eq!(at_cap.errors.len(), 100);
    assert!(!at_cap.errors_truncated);

    let over_cap = with_errors(101);
    assert_eq!(over_cap.errors.len(), 100);
    assert!(over_cap.errors_truncated);
}

#[test]
fn version_too_low_carries_typed_versions() {
    use php_rs_parser::PhpVersion;
    let result = php_rs_parser::parse_with(
        "<?php enum E {}",
        &php_rs_parser::ParseOptions::default().version(PhpVersion::Php80),
    );
    let first = result.errors.first().expect("an error");
    assert!(
        matches!(
            first,
            ParseError::VersionTooLow {
                required: PhpVersion::Php81,
                used: PhpVersion::Php80,
                ..
            }
        ),
        "{first:?}"
    );
    assert_eq!(first.to_string(), "'enums' requires PHP 8.1 or higher");
}
