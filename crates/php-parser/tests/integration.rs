mod common;
use common::{assert_no_errors, fixture, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

/// Parse every case in a category and return a multi-section string suitable
/// for snapshot testing.  Each section is `=== label ===\n<json>\n`.  This
/// makes category-based tests opinionated: they catch not just parse failures
/// but also regressions in the produced AST structure.
fn category_snapshot(cat: &'static str) -> String {
    let mut out = String::new();
    for case in category(cat) {
        let result = parse_php(case.source);
        assert!(
            result.errors.is_empty(),
            "unexpected parse errors for {:?} case {:?}: {:?}",
            cat,
            case.label,
            result.errors,
        );
        out.push_str(&format!(
            "=== {} ===\n{}\n",
            case.label,
            to_json(&result.program)
        ));
    }
    out
}

fn format_errors(result: &php_rs_parser::ParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

/// Build one multi-section snapshot for a batch of inputs: each section is
/// `--- <source> ---\n<output>\n\n` so a single snapshot file covers the batch.
fn multi_snapshot<F>(cases: &[&'static str], mut describe: F) -> String
where
    F: FnMut(&php_rs_parser::ParseResult) -> String,
{
    let mut out = String::new();
    for &src in cases {
        let result = parse_php(src);
        out.push_str(&format!("--- {src} ---\n{}\n\n", describe(&result)));
    }
    out
}

// =============================================================================
// Fixture file tests
// =============================================================================

/// Parse every `.php` file in `tests/fixtures/` (non-recursive) and snapshot it.
/// Adding a new fixture file automatically gets a test — no Rust changes needed.
/// Files with intentional parse errors are handled by separate tests below.
#[test]
fn fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths: Vec<_> = std::fs::read_dir(&dir)
        .unwrap()
        .filter_map(|e| e.ok())
        .filter(|e| {
            e.path().extension().map_or(false, |ext| ext == "php")
                && e.file_name() != "error_recovery.php"
        })
        .map(|e| e.path())
        .collect();
    paths.sort();

    for path in paths {
        let name = path.file_stem().unwrap().to_str().unwrap().to_string();
        let source: &'static str =
            Box::leak(std::fs::read_to_string(&path).unwrap().into_boxed_str());
        let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
        let result = php_rs_parser::parse(arena, source);
        assert!(
            result.errors.is_empty(),
            "unexpected parse errors in {name}: {:?}",
            result.errors
        );
        insta::assert_snapshot!(name, fixture(source, &result.program));
    }
}

/// Parse every `.php` file in `tests/fixtures/errors/` and snapshot it.
/// Each file is expected to produce at least one parse error.
// error_recovery.php is excluded from auto-discovery (handled separately).
#[test]
fn error_fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures/errors");
    let mut paths: Vec<_> = std::fs::read_dir(&dir)
        .unwrap()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().map_or(false, |ext| ext == "php"))
        .map(|e| e.path())
        .collect();
    paths.sort();

    for path in paths {
        let name = path.file_stem().unwrap().to_str().unwrap().to_string();
        let source: &'static str =
            Box::leak(std::fs::read_to_string(&path).unwrap().into_boxed_str());
        let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
        let result = php_rs_parser::parse(arena, source);
        assert!(
            !result.errors.is_empty(),
            "expected parse errors in {name} but got none"
        );
        insta::assert_snapshot!(name, fixture(source, &result.program));
    }
}

// =============================================================================
// Error recovery tests
// =============================================================================

#[test]
fn test_error_recovery_partial_parse() {
    let source = include_str!("fixtures/error_recovery.php");
    let result = parse_php(source);
    assert!(!result.errors.is_empty(), "Expected parse errors");
    assert!(
        !result.program.stmts.is_empty(),
        "Expected partial AST even with errors"
    );
    insta::assert_snapshot!(fixture(source, &result.program));
}

// =============================================================================
// Expression precedence tests — Bucket C (specific assertion + snapshot)
// =============================================================================

#[test]
fn test_trailing_dot_float_literals() {
    // PHP: DNUM = LNUM "." — trailing-dot literals must parse as Float, not Int
    let source = include_str!("fixtures/trailing_dot_float_literals.php");
    let result = parse_php(source);
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        !json.contains("\"Int\""),
        "trailing-dot literals must not produce Int nodes; got:\n{json}"
    );
    assert!(
        json.contains("\"Float\""),
        "trailing-dot literals must produce Float nodes; got:\n{json}"
    );
    insta::assert_snapshot!(fixture(source, &result.program));
}

#[test]
fn test_legacy_octal_invalid_digits() {
    // PHP silently ignores 8 and 9 in legacy octal: 0778 = int(63), 019 = int(1), 09 = int(0)
    let source = include_str!("fixtures/legacy_octal_invalid_digits.php");
    let result = parse_php(source);
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        json.contains("\"Int\": 63"),
        "0778 must parse as Int(63); got:\n{json}"
    );
    assert!(
        json.contains("\"Int\": 1"),
        "019 must parse as Int(1); got:\n{json}"
    );
    assert!(
        json.contains("\"Int\": 0"),
        "09 must parse as Int(0); got:\n{json}"
    );
    insta::assert_snapshot!(fixture(source, &result.program));
}

// =============================================================================
// Alternative syntax — no-hang regression (Bucket C: error-expected, no snapshot)
// =============================================================================

// A `}` inside alternative syntax is not in `ends` so synchronize() stops
// WITHOUT advancing, causing an infinite loop. The span-progress guard in
// parse_stmts_until_end must force-advance past such tokens.
#[test]
fn test_alt_if_unexpected_rbrace_terminates() {
    let result = parse_php(
        "<?php if (true):     insta::assert_snapshot!(to_json(&result.program));
} endif;",
    );
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

#[test]
fn test_alt_while_unexpected_rbrace_terminates() {
    let result = parse_php(
        "<?php while (true):     insta::assert_snapshot!(to_json(&result.program));
} endwhile;",
    );
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

#[test]
fn test_alt_foreach_unexpected_rbrace_terminates() {
    let result = parse_php(
        "<?php foreach ($a as $b):     insta::assert_snapshot!(to_json(&result.program));
} endforeach;",
    );
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

// =============================================================================
// OOP Declarations — category-based (Bucket D)
// =============================================================================

#[test]
fn test_clone_parenthesised() {
    insta::assert_snapshot!(category_snapshot("clone"));
}

#[test]
fn test_declare_encoding() {
    insta::assert_snapshot!(category_snapshot("declare"));
}

#[test]
fn test_cast_void() {
    insta::assert_snapshot!(category_snapshot("cast_void"));
}

#[test]
fn test_error_suppress_complex() {
    insta::assert_snapshot!(category_snapshot("error_suppress"));
}

// =============================================================================
// Error Messages — Bucket C (specific error-content assertions)
// =============================================================================

#[test]
fn test_cast_unset() {
    // (unset) cast was removed in PHP 8.0
    let result = parse_php("<?php (unset)$x;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_error_missing_semicolon_after_expression() {
    let result = parse_php("<?php $x = 1\n$y = 2;");
    assert!(!result.errors.is_empty());
    let err = &result.errors[0];
    assert!(
        format!("{}", err).contains("after"),
        "Expected contextual error message with 'after', got: {}",
        err
    );
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_error_unclosed_paren() {
    let result = parse_php("<?php ($x + $y;");
    assert!(!result.errors.is_empty());
    let err = &result.errors[0];
    assert!(
        format!("{}", err).contains("unclosed") || format!("{}", err).contains("Unclosed"),
        "Expected unclosed delimiter error, got: {}",
        err
    );
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_error_unclosed_brace() {
    let result = parse_php("<?php function foo() { $x = 1;");
    assert!(!result.errors.is_empty());
    let has_unclosed = result.errors.iter().any(|e| {
        let msg = format!("{}", e);
        msg.contains("unclosed") || msg.contains("Unclosed")
    });
    assert!(
        has_unclosed,
        "Expected unclosed delimiter error, got: {:?}",
        result.errors
    );
    insta::assert_snapshot!(format_errors(&result));
}

// =============================================================================
// Literals — Bucket C (value assertions)
// =============================================================================

#[test]
fn test_magic_constants_in_echo() {
    insta::assert_snapshot!(category_snapshot("magic_constants"));
}

// =============================================================================
// Strings & Heredoc — category-based (Bucket D)
// =============================================================================

#[test]
fn test_string_interpolation_patterns() {
    insta::assert_snapshot!(category_snapshot("string_interpolation"));
}

#[test]
fn test_heredoc_nowdoc_variants() {
    insta::assert_snapshot!(category_snapshot("heredoc"));
}

// =============================================================================
// Operators & Expressions — category-based (Bucket D)
// =============================================================================

#[test]
fn test_operator_precedence_combinations() {
    insta::assert_snapshot!(category_snapshot("operator_precedence"));
}

#[test]
fn test_assignment_patterns() {
    insta::assert_snapshot!(category_snapshot("assignment"));
}

#[test]
fn test_expression_chains() {
    insta::assert_snapshot!(category_snapshot("expression_chains"));
}

#[test]
fn test_dynamic_access() {
    insta::assert_snapshot!(category_snapshot("dynamic_access"));
}

// =============================================================================
// Destructuring — category-based (Bucket D)
// =============================================================================

#[test]
fn test_nested_destructuring() {
    insta::assert_snapshot!(category_snapshot("destructuring"));
}

// =============================================================================
// Control Flow — category-based (Bucket D)
// =============================================================================

#[test]
fn test_alternative_syntax_variants() {
    insta::assert_snapshot!(category_snapshot("alternative_syntax"));
}

#[test]
fn test_control_flow_variants() {
    insta::assert_snapshot!(category_snapshot("control_flow"));
}

#[test]
fn test_try_catch_variants() {
    insta::assert_snapshot!(category_snapshot("try_catch"));
}

#[test]
fn test_match_variants() {
    insta::assert_snapshot!(category_snapshot("match"));
}

// =============================================================================
// Functions & Closures — category-based (Bucket D)
// =============================================================================

#[test]
fn test_function_variants() {
    insta::assert_snapshot!(category_snapshot("function"));
}

#[test]
fn test_named_args_variants() {
    insta::assert_snapshot!(category_snapshot("named_args"));
}

#[test]
fn test_closure_variants() {
    insta::assert_snapshot!(category_snapshot("closure"));
}

#[test]
fn test_arrow_function_in_array() {
    insta::assert_snapshot!(category_snapshot("arrow_function"));
}

#[test]
fn test_generator_variants() {
    insta::assert_snapshot!(category_snapshot("generator"));
}

// =============================================================================
// OOP — category-based (Bucket D)
// =============================================================================

#[test]
fn test_class_variants() {
    insta::assert_snapshot!(category_snapshot("class"));
}

#[test]
fn test_enum_variants() {
    insta::assert_snapshot!(category_snapshot("enum"));
}

#[test]
fn test_enum_in_match_variants() {
    insta::assert_snapshot!(category_snapshot("enum_in_match"));
}

#[test]
fn test_fiber_variants() {
    insta::assert_snapshot!(category_snapshot("fiber"));
}

#[test]
fn test_readonly_final_class() {
    insta::assert_snapshot!(category_snapshot("readonly_class"));
}

#[test]
fn test_scope_resolution() {
    insta::assert_snapshot!(category_snapshot("scope_resolution"));
}

// =============================================================================
// Type Hints — category-based (Bucket D)
// =============================================================================

#[test]
fn test_type_hint_variants() {
    insta::assert_snapshot!(category_snapshot("type_hints"));
}

// =============================================================================
// Attributes — category-based (Bucket D)
// =============================================================================

#[test]
fn test_attribute_variants() {
    insta::assert_snapshot!(category_snapshot("attributes"));
}

// =============================================================================
// Typed class constants — category-based (Bucket D)
// =============================================================================

#[test]
fn test_typed_class_constants_variants() {
    insta::assert_snapshot!(category_snapshot("typed_class_constants"));
}

// =============================================================================
// Builtins / traits — category-based (Bucket D)
// =============================================================================

#[test]
fn test_builtin_constructs() {
    insta::assert_snapshot!(category_snapshot("builtins"));
}

#[test]
fn test_trait_use_adaptations() {
    insta::assert_snapshot!(category_snapshot("trait_use"));
}

#[test]
fn test_numeric_literals_variants() {
    insta::assert_snapshot!(category_snapshot("numeric_literals"));
}

// =============================================================================
// Close tags, inline HTML — Bucket D (multi-parse, named snapshots)
// =============================================================================

#[test]
fn test_close_tag_semicolon() {
    let result = parse_php("<?= $value ?>");
    assert_no_errors(&result);
    insta::assert_snapshot!("short_echo", to_json(&result.program));

    let result2 = parse_php("<?php echo 1 ?><html><?php echo 2 ?>");
    assert_no_errors(&result2);
    insta::assert_snapshot!("close_tag_terminates", to_json(&result2.program));
}

// =============================================================================
// Keyword-as-identifier tests — Bucket D (multi-case loop)
// =============================================================================

#[test]
fn test_keyword_as_function_name() {
    // These test parser tolerance: PHP itself rejects most of these, but our
    // parser handles them gracefully without panicking.
    let cases: &[(&str, &'static str)] = &[
        ("function readonly", "<?php function readonly() {}"),
        (
            "function exit",
            "<?php function exit(string|int $status = 0): never {}",
        ),
        (
            "function die",
            "<?php function die(string|int $status = 0): never {}",
        ),
        (
            "function clone",
            "<?php function clone(object $object): object {}",
        ),
        ("function match", "<?php function match() {}"),
        ("function fn", "<?php function fn() {}"),
    ];
    let mut out = String::new();
    for (label, src) in cases {
        let result = parse_php(src);
        assert_no_errors(&result);
        out.push_str(&format!(
            "=== {} ===\n{}\n",
            label,
            to_json(&result.program)
        ));
    }
    insta::assert_snapshot!(out);
}

// =============================================================================
// Error validation tests — Bucket C (specific error checks + snapshot)
// =============================================================================

#[test]
fn test_enum_case_class_reserved() {
    // `class` cannot be used as enum case name
    let result = parse_php("<?php enum Suit { case class; }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_abstract_final_conflict() {
    let result = parse_php("<?php class A { abstract final function a(); }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_abstract_method_with_body() {
    // abstract methods must not have a body
    insta::assert_snapshot!(multi_snapshot(
        &[
            "<?php abstract class Foo { abstract function bar() { echo 'body'; } }",
            "<?php abstract class Foo { abstract public function bar(): string { return ''; } }"
        ],
        |result| {
            assert!(!result.errors.is_empty(), "Expected parse errors");
            format_errors(result)
        },
    ));
}

#[test]
fn test_static_const_error() {
    let result = parse_php("<?php class A { static const X = 1; }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_abstract_const_error() {
    let result = parse_php("<?php class A { abstract const X = 1; }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_readonly_const_error() {
    let result = parse_php("<?php class A { readonly const X = 1; }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_reserved_class_names() {
    insta::assert_snapshot!(multi_snapshot(
        &[
            "<?php class self {}",
            "<?php class parent {}",
            "<?php class static {}",
            "<?php class readonly {}"
        ],
        |result| {
            assert!(!result.errors.is_empty(), "Expected parse errors");
            format_errors(result)
        },
    ));
}

#[test]
fn test_reserved_names_in_extends() {
    insta::assert_snapshot!(multi_snapshot(
        &[
            "<?php class A extends self {}",
            "<?php class A extends parent {}",
            "<?php class A extends static {}"
        ],
        |result| {
            assert!(!result.errors.is_empty(), "Expected parse errors");
            format_errors(result)
        },
    ));
}

#[test]
fn test_reserved_names_in_implements() {
    insta::assert_snapshot!(multi_snapshot(
        &[
            "<?php class A implements self {}",
            "<?php class A implements parent {}",
            "<?php class A implements static {}"
        ],
        |result| {
            assert!(!result.errors.is_empty(), "Expected parse errors");
            format_errors(result)
        },
    ));
}

#[test]
fn test_halt_compiler_nested_error() {
    let result = parse_php("<?php if (true) { __halt_compiler(); }");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_duplicate_modifier_errors() {
    insta::assert_snapshot!(multi_snapshot(
        &[
            "<?php class A { public public $x; }",
            "<?php class A { public protected $x; }",
            "<?php class A { static static $x; }",
            "<?php class A { abstract abstract function f(); }",
            "<?php class A { final final function f() {} }",
            "<?php class A { readonly readonly $x; }",
            "<?php class A { public public const X = 1; }"
        ],
        |result| {
            assert!(!result.errors.is_empty(), "Expected parse errors");
            format_errors(result)
        },
    ));
}

#[test]
fn test_empty_group_use() {
    // Empty group use is invalid PHP
    let result = parse_php("<?php use A\\B\\{};");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

#[test]
fn test_true_false_union_is_invalid() {
    // PHP rejects true|false: "Type contains both true and false, bool must be used instead"
    let result = parse_php("<?php function f(): true|false {}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
    let result = parse_php("<?php function f(): true|false {}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
    let result = parse_php("<?php function f(): true|false {}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(format_errors(&result));
}

// =============================================================================
// No-hang regression tests
// =============================================================================
// Ensure the parser always terminates on malformed input. Each test exercises
// the progress guard in a different parse_stmt loop.

#[test]
fn test_no_hang_constructor_final_param() {
    let result = parse_php("<?php class P { public function __construct(final $i) {} }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_block() {
    let result = parse_php("<?php if (true) { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_function_body() {
    let result = parse_php("<?php function f() { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_method_body() {
    let result = parse_php("<?php class A { function f() { ?> <?php } }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_try_body() {
    let result = parse_php("<?php try { ?> <?php } catch (Exception $e) {}");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_catch_body() {
    let result = parse_php("<?php try {} catch (Exception $e) { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_finally_body() {
    let result = parse_php("<?php try {} finally { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_closure_body() {
    let result = parse_php("<?php $f = function() { ?> <?php };");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_namespace_braced() {
    let result = parse_php("<?php namespace Foo { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_namespace_global_braced() {
    let result = parse_php("<?php namespace { ?> <?php }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_enum_method_body() {
    let result = parse_php("<?php enum E { case A; public function f() { ?> <?php } }");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_no_hang_property_hook_body() {
    let result = parse_php("<?php class A { public string $x { get { ?> <?php } } }");
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// PHP version-specific feature tests
// =============================================================================

fn parse_php_versioned(
    source: &'static str,
    version: php_rs_parser::PhpVersion,
) -> php_rs_parser::ParseResult<'static, 'static> {
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse_versioned(arena, source, version)
}

#[test]
fn test_version_php80_match_requires_80() {
    // match is PHP 8.0 — must pass on 8.0+, fail on nothing below that
    let result = parse_php_versioned(
        "<?php $x = match($y) { 1 => 'a', default => 'b' };",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        result.errors.is_empty(),
        "match should be valid in PHP 8.0: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_version_php81_enum_requires_81() {
    let result_81 = parse_php_versioned(
        "<?php enum Status { case Active; case Inactive; }",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        result_81.errors.is_empty(),
        "enum should be valid in PHP 8.1: {:?}",
        result_81.errors
    );

    let result_80 = parse_php_versioned(
        "<?php enum Status { case Active; case Inactive; }",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        !result_80.errors.is_empty(),
        "enum should emit a version error when targeting PHP 8.0"
    );
    assert!(result_80.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("enum")
    )));
    insta::assert_snapshot!(
        "test_version_php81_enum_requires_81_result_81_ast",
        to_json(&result_81.program)
    );
    insta::assert_snapshot!(
        "test_version_php81_enum_requires_81_result_81_errors",
        format_errors(&result_81)
    );
    insta::assert_snapshot!(
        "test_version_php81_enum_requires_81_result_80_ast",
        to_json(&result_80.program)
    );
    insta::assert_snapshot!(
        "test_version_php81_enum_requires_81_result_80_errors",
        format_errors(&result_80)
    );
}

#[test]
fn test_version_php82_readonly_class_requires_82() {
    let result_82 = parse_php_versioned(
        "<?php readonly class Foo { public string $bar; }",
        php_rs_parser::PhpVersion::Php82,
    );
    assert!(
        result_82.errors.is_empty(),
        "readonly class should be valid in PHP 8.2: {:?}",
        result_82.errors
    );

    let result_81 = parse_php_versioned(
        "<?php readonly class Foo { public string $bar; }",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        !result_81.errors.is_empty(),
        "readonly class should emit a version error when targeting PHP 8.1"
    );
    insta::assert_snapshot!(
        "test_version_php82_readonly_class_requires_82_result_82_ast",
        to_json(&result_82.program)
    );
    insta::assert_snapshot!(
        "test_version_php82_readonly_class_requires_82_result_82_errors",
        format_errors(&result_82)
    );
    insta::assert_snapshot!(
        "test_version_php82_readonly_class_requires_82_result_81_ast",
        to_json(&result_81.program)
    );
    insta::assert_snapshot!(
        "test_version_php82_readonly_class_requires_82_result_81_errors",
        format_errors(&result_81)
    );
}

#[test]
fn test_version_php83_typed_constants_require_83() {
    let result_83 = parse_php_versioned(
        "<?php class Foo { public const string NAME = 'foo'; }",
        php_rs_parser::PhpVersion::Php83,
    );
    assert!(
        result_83.errors.is_empty(),
        "typed constants should be valid in PHP 8.3: {:?}",
        result_83.errors
    );

    let result_82 = parse_php_versioned(
        "<?php class Foo { public const string NAME = 'foo'; }",
        php_rs_parser::PhpVersion::Php82,
    );
    assert!(
        !result_82.errors.is_empty(),
        "typed constants should emit a version error when targeting PHP 8.2"
    );
    insta::assert_snapshot!(
        "test_version_php83_typed_constants_require_83_result_83_ast",
        to_json(&result_83.program)
    );
    insta::assert_snapshot!(
        "test_version_php83_typed_constants_require_83_result_83_errors",
        format_errors(&result_83)
    );
    insta::assert_snapshot!(
        "test_version_php83_typed_constants_require_83_result_82_ast",
        to_json(&result_82.program)
    );
    insta::assert_snapshot!(
        "test_version_php83_typed_constants_require_83_result_82_errors",
        format_errors(&result_82)
    );
}

#[test]
fn test_version_php84_abstract_readonly_class_requires_84() {
    let result_84 = parse_php_versioned(
        "<?php abstract readonly class Foo {}",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        result_84.errors.is_empty(),
        "abstract readonly class should be valid in PHP 8.4: {:?}",
        result_84.errors
    );

    let result_83 = parse_php_versioned(
        "<?php abstract readonly class Foo {}",
        php_rs_parser::PhpVersion::Php83,
    );
    assert!(
        !result_83.errors.is_empty(),
        "abstract readonly class should emit a version error when targeting PHP 8.3"
    );
    insta::assert_snapshot!(
        "test_version_php84_abstract_readonly_class_requires_84_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php84_abstract_readonly_class_requires_84_result_84_errors",
        format_errors(&result_84)
    );
    insta::assert_snapshot!(
        "test_version_php84_abstract_readonly_class_requires_84_result_83_ast",
        to_json(&result_83.program)
    );
    insta::assert_snapshot!(
        "test_version_php84_abstract_readonly_class_requires_84_result_83_errors",
        format_errors(&result_83)
    );
}

#[test]
fn test_version_php85_pipe_operator_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php $x = $value |> trim(...) |> strtolower(...);",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "pipe operator should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php $x = $value |> trim(...) |> strtolower(...);",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "pipe operator should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("pipe")
    )));
    insta::assert_snapshot!(
        "test_version_php85_pipe_operator_requires_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_pipe_operator_requires_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_pipe_operator_requires_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_pipe_operator_requires_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_version_php85_clone_with_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php $b = clone($a, ['alpha' => 128]);",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "clone with should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php $b = clone($a, ['alpha' => 128]);",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "clone with should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("clone")
    )));
    insta::assert_snapshot!(
        "test_version_php85_clone_with_requires_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_clone_with_requires_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_clone_with_requires_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_clone_with_requires_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_version_php85_static_asymmetric_visibility_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php class Foo { public static private(set) string $bar = 'x'; }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "static asymmetric visibility should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php class Foo { public static private(set) string $bar = 'x'; }",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "static asymmetric visibility should emit a version error when targeting PHP 8.4"
    );
    insta::assert_snapshot!(
        "test_version_php85_static_asymmetric_visibility_requires_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_static_asymmetric_visibility_requires_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_static_asymmetric_visibility_requires_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_static_asymmetric_visibility_requires_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_version_php85_final_promoted_property_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "final promoted property should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "final promoted property should emit a version error when targeting PHP 8.4"
    );
    insta::assert_snapshot!(
        "test_version_php85_final_promoted_property_requires_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_final_promoted_property_requires_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_final_promoted_property_requires_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_final_promoted_property_requires_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_version_php85_void_cast_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php (void) getVersion();",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "void cast should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php (void) getVersion();",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "void cast should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("void")
    )));
    insta::assert_snapshot!(
        "test_version_php85_void_cast_requires_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_void_cast_requires_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_void_cast_requires_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_void_cast_requires_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_version_php85_const_attributes_require_85() {
    let result_85 = parse_php_versioned(
        "<?php #[MyAttr] const VERSION = '8.5';",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "attributes on constants should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php #[MyAttr] const VERSION = '8.5';",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "attributes on constants should emit a version error when targeting PHP 8.4"
    );
    insta::assert_snapshot!(
        "test_version_php85_const_attributes_require_85_result_85_ast",
        to_json(&result_85.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_const_attributes_require_85_result_85_errors",
        format_errors(&result_85)
    );
    insta::assert_snapshot!(
        "test_version_php85_const_attributes_require_85_result_84_ast",
        to_json(&result_84.program)
    );
    insta::assert_snapshot!(
        "test_version_php85_const_attributes_require_85_result_84_errors",
        format_errors(&result_84)
    );
}

#[test]
fn test_param_is_final_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let class = &result.program.stmts[0];
    let php_ast::StmtKind::Class(class_decl) = &class.kind else {
        panic!("expected class")
    };
    let member = class_decl
        .members
        .iter()
        .find(|m| matches!(m.kind, php_ast::ClassMemberKind::Method(_)))
        .unwrap();
    let php_ast::ClassMemberKind::Method(method_decl) = &member.kind else {
        unreachable!()
    };
    let param = &method_decl.params[0];
    assert!(
        param.is_final,
        "is_final should be true for 'final' promoted property"
    );
    assert!(!param.is_readonly, "is_readonly should be false");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_param_is_readonly_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php function foo(readonly string $x) {}",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let func = &result.program.stmts[0];
    let php_ast::StmtKind::Function(func_decl) = &func.kind else {
        panic!("expected function")
    };
    let param = &func_decl.params[0];
    assert!(
        param.is_readonly,
        "is_readonly should be true for 'readonly' parameter"
    );
    assert!(!param.is_final, "is_final should be false");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_arg_by_ref_preserved_in_ast() {
    let result = parse_php("<?php f(&$a);");
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let expr_stmt = &result.program.stmts[0];
    let php_ast::StmtKind::Expression(expr) = &expr_stmt.kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::FunctionCall(call) = &expr.kind else {
        panic!("expected function call")
    };
    let arg = &call.args[0];
    assert!(arg.by_ref, "by_ref should be true for &$a argument");
    assert!(!arg.unpack, "unpack should be false");
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Version Gate: Explicit Octal (PHP 8.1+)
// =============================================================================

#[test]
fn test_explicit_octal_valid_on_81() {
    let result = parse_php_versioned("<?php $x = 0o777;", php_rs_parser::PhpVersion::Php81);
    assert!(
        result.errors.is_empty(),
        "explicit octal should be valid on PHP 8.1: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Bug fixes: invalid AST was previously generated
// =============================================================================

#[test]
fn test_assign_by_ref_has_by_ref_true() {
    // Bug fix: `$a =& $b` was previously indistinguishable from `$a = $b` in the AST.
    let result = parse_php("<?php $a =& $b;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign expr")
    };
    assert!(assign.by_ref, "=& must set by_ref=true on AssignExpr");
    assert_eq!(assign.op, php_ast::AssignOp::Assign);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_regular_assign_has_by_ref_false() {
    let result = parse_php("<?php $a = $b;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign expr")
    };
    assert!(!assign.by_ref, "= must set by_ref=false on AssignExpr");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_assign_by_ref_distinct_from_regular_assign_in_ast() {
    // `$a =& $b` and `$a = $b` must produce distinct AST nodes.
    let ref_result = parse_php("<?php $a =& $b;");
    let val_result = parse_php("<?php $a = $b;");
    assert_no_errors(&ref_result);
    assert_no_errors(&val_result);
    let ref_json = to_json(&ref_result.program);
    let val_json = to_json(&val_result.program);
    assert_ne!(
        ref_json, val_json,
        "`$a =& $b` and `$a = $b` must have distinct AST"
    );
    assert!(ref_json.contains("\"by_ref\": true"));
    assert!(!val_json.contains("\"by_ref\""));
    insta::assert_snapshot!("assign_by_ref_distinct_ref", ref_json);
    insta::assert_snapshot!("assign_by_ref_distinct_val", val_json);
}

#[test]
fn test_array_element_by_ref_has_by_ref_true() {
    // Bug fix: `[&$a]` element was previously indistinguishable from `[$a]`.
    let result = parse_php("<?php [&$a, $b] = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected array destructuring target")
    };
    assert!(elems[0].by_ref, "first element &$a must have by_ref=true");
    assert!(!elems[1].by_ref, "second element $b must have by_ref=false");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_list_element_by_ref_has_by_ref_true() {
    // Bug fix: `list(&$a, $b)` — the &$a element must record by_ref=true.
    let result = parse_php("<?php list(&$a, $b) = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected list destructuring target")
    };
    assert!(elems[0].by_ref, "first element &$a must have by_ref=true");
    assert!(!elems[1].by_ref, "second element $b must have by_ref=false");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_empty_destructuring_slot_is_omit_not_null() {
    // Bug fix: `[$a, , $c]` empty slot was previously `ExprKind::Null`,
    // making it indistinguishable from `[$a, null, $c]`.
    let result = parse_php("<?php [$a, , $c] = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected array destructuring target")
    };
    assert!(
        matches!(elems[1].value.kind, php_ast::ExprKind::Omit),
        "empty slot must be ExprKind::Omit, got {:?}",
        elems[1].value.kind
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_list_empty_slot_is_omit_not_null() {
    // Bug fix: `list($a, , $c)` empty slot was previously `ExprKind::Null`.
    let result = parse_php("<?php list($a, , $c) = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected list destructuring target")
    };
    assert!(
        matches!(elems[1].value.kind, php_ast::ExprKind::Omit),
        "empty slot must be ExprKind::Omit, got {:?}",
        elems[1].value.kind
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_null_literal_distinct_from_omit_in_array_destructuring() {
    // `[$a, null, $c]` and `[$a, , $c]` must produce distinct AST nodes.
    let omit_result = parse_php("<?php [$a, , $c] = $arr;");
    let null_result = parse_php("<?php [$a, null, $c] = $arr;");
    assert_no_errors(&omit_result);
    assert_no_errors(&null_result);
    let omit_json = to_json(&omit_result.program);
    let null_json = to_json(&null_result.program);
    assert_ne!(
        omit_json, null_json,
        "`[$a, , $c]` and `[$a, null, $c]` must have distinct AST"
    );
    assert!(
        omit_json.contains("\"Omit\""),
        "empty slot must serialize as \"Omit\""
    );
    assert!(
        !omit_json.contains("\"Null\""),
        "empty slot must not serialize as \"Null\""
    );
    insta::assert_snapshot!("null_vs_omit_omit", omit_json);
    insta::assert_snapshot!("null_vs_omit_null", null_json);
}

// =============================================================================
// Single-quoted string with non-ASCII characters — regression for issue #68
// =============================================================================

fn extract_string_value(source: &'static str) -> &'static str {
    let result = parse_php(source);
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::String(s) = &expr.kind else {
        panic!("expected String expr, got {:?}", expr.kind)
    };
    s
}

#[test]
fn test_single_quoted_non_ascii_with_escaped_quote() {
    // 'hél\'lo' → hél'lo  (0xC3 0xA9 is é in UTF-8)
    let val = extract_string_value("<?php 'hél\\'lo';");
    assert_eq!(
        val, "hél'lo",
        "non-ASCII bytes must not be split into individual chars"
    );
    let _result = parse_php("<?php 'hél\\'lo';");
    assert_no_errors(&_result);
    insta::assert_snapshot!(to_json(&_result.program));
}

#[test]
fn test_single_quoted_non_ascii_with_escaped_backslash() {
    // 'naïve\\path' → naïve\path
    let val = extract_string_value("<?php 'naïve\\\\path';");
    assert_eq!(
        val, "naïve\\path",
        "non-ASCII before \\\\ must decode correctly"
    );
    let _result = parse_php("<?php 'naïve\\\\path';");
    assert_no_errors(&_result);
    insta::assert_snapshot!(to_json(&_result.program));
}

// =============================================================================
// Integer overflow → float promotion (PHP semantics)
// =============================================================================

#[test]
fn test_int_overflow_decimal_promotes_to_float() {
    // PHP_INT_MAX + 1 → PHP promotes to float
    let result = parse_php("<?php 9223372036854775808;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        !json.contains("\"Int\""),
        "overflowing decimal literal must not produce Int node; got:\n{json}"
    );
    assert!(
        json.contains("\"Float\""),
        "overflowing decimal literal must produce Float node; got:\n{json}"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_int_overflow_large_decimal_value() {
    // 9999999999999999999 → float(1.0E+19)
    let result = parse_php("<?php 9999999999999999999;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        json.contains("\"Float\""),
        "very large decimal literal must produce Float node; got:\n{json}"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_int_overflow_hex_promotes_to_float() {
    // 0x8000000000000000 = PHP_INT_MAX + 1 in hex → float
    let result = parse_php("<?php 0x8000000000000000;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        !json.contains("\"Int\""),
        "overflowing hex literal must not produce Int node; got:\n{json}"
    );
    assert!(
        json.contains("\"Float\""),
        "overflowing hex literal must produce Float node; got:\n{json}"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_int_no_overflow_stays_int() {
    // PHP_INT_MAX exactly → stays as Int
    let result = parse_php("<?php 9223372036854775807;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        json.contains("\"Int\": 9223372036854775807"),
        "PHP_INT_MAX must stay as Int; got:\n{json}"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_ternary_chain_without_parens_forbidden_in_php8() {
    // PHP 8.0+: unparenthesized ternary chaining is a fatal parse error
    let result = parse_php_versioned(
        "<?php $x = true ? 1 : 2 ? 3 : 4;",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        !result.errors.is_empty(),
        "unparenthesized ternary chain must be rejected in PHP 8.0"
    );
    assert!(result.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::Forbidden { message, .. }
            if message.contains("Unparenthesized")
    )));
    insta::assert_snapshot!("result_ast", to_json(&result.program));
}

#[test]
fn test_ternary_chain_with_parens_allowed_in_php8() {
    // Parenthesized ternary chaining is valid in PHP 8
    let result = parse_php_versioned(
        "<?php $x = (true ? 1 : 2) ? 3 : 4;",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        result.errors.is_empty(),
        "parenthesized ternary chain must be valid in PHP 8.0: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_ternary_simple_no_chain_allowed_in_php8() {
    // Simple (non-chained) ternary is always valid
    let result = parse_php_versioned("<?php $x = true ? 1 : 2;", php_rs_parser::PhpVersion::Php80);
    assert!(
        result.errors.is_empty(),
        "simple ternary must be valid in PHP 8.0: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[path = "inline_cases.rs"]
mod inline_cases;

fn category(cat: &'static str) -> impl Iterator<Item = &'static inline_cases::Case> {
    inline_cases::CASES
        .iter()
        .filter(move |c| c.category == cat)
}
