mod common;
use common::{assert_no_errors, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

fn parse_php_versioned(
    source: &'static str,
    version: php_rs_parser::PhpVersion,
) -> php_rs_parser::ParseResult<'static, 'static> {
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse_versioned(arena, source, version)
}

// =============================================================================
// Fixture file tests
// =============================================================================

/// Recursively collect all `.phpt` files under `dir`, excluding `corpus/`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            let name = path.file_name().unwrap().to_str().unwrap();
            if name != "corpus" {
                paths.extend(collect_phpt_files(&path));
            }
        } else if path.extension().map_or(false, |ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Parse every `.phpt` file in `tests/fixtures/` (recursive, excluding corpus/).
/// Handles both clean-parse and error-expected fixtures, as well as version-specific ones.
#[test]
fn fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    for path in paths {
        let rel = path.strip_prefix(&dir).unwrap().to_string_lossy();
        let content: &'static str =
            Box::leak(std::fs::read_to_string(&path).unwrap().into_boxed_str());
        let (config, source) = common::parse_fixture(content);
        let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));

        let result = if let Some(ver) = config.parse_version {
            php_rs_parser::parse_versioned(arena, source, common::php_version(ver))
        } else {
            php_rs_parser::parse(arena, source)
        };

        if config.expect_errors {
            assert!(
                !result.errors.is_empty(),
                "expected parse errors in {rel} but got none"
            );
        } else {
            assert!(
                result.errors.is_empty(),
                "unexpected parse errors in {rel}: {:?}",
                result.errors
            );
        }

        if let Some(expected_errors) = &config.expected_errors {
            let actual_errors = common::format_errors(&result);
            assert_eq!(
                actual_errors, *expected_errors,
                "error messages mismatch in {rel}"
            );
        }

        let actual = to_json(&result.program);
        if update {
            common::update_fixture_ast(path.to_str().unwrap(), &actual);
        } else {
            let expected = config
                .expected_ast
                .unwrap_or_else(|| panic!("missing ===ast=== section in {rel}"));
            assert_eq!(actual, expected, "AST mismatch in {rel}");
        }
    }
}

// =============================================================================
// Expression precedence tests — Bucket C (specific assertion + fixture)
// =============================================================================

#[test]
fn test_trailing_dot_float_literals() {
    let (_, source) =
        common::parse_fixture(include_str!("fixtures/trailing_dot_float_literals.phpt"));
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
}

#[test]
fn test_legacy_octal_invalid_digits() {
    let (_, source) =
        common::parse_fixture(include_str!("fixtures/legacy_octal_invalid_digits.phpt"));
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
}

// =============================================================================
// Alternative syntax — no-hang regression (Bucket C: error-expected, no snapshot)
// =============================================================================

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
// PHP version-specific feature tests — structural assertions
// =============================================================================

#[test]
fn test_version_php85_pipe_operator_error_type() {
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
}

#[test]
fn test_version_php85_clone_with_error_type() {
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
}

#[test]
fn test_version_php85_void_cast_error_type() {
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
}

#[test]
fn test_ternary_chain_without_parens_error_type() {
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
}

// =============================================================================
// AST structural correctness — tests that check specific fields
// =============================================================================

#[test]
fn test_param_is_final_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert_no_errors(&result);
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
}

#[test]
fn test_param_is_readonly_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php function foo(readonly string $x) {}",
        php_rs_parser::PhpVersion::Php81,
    );
    assert_no_errors(&result);
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
}

#[test]
fn test_arg_by_ref_preserved_in_ast() {
    let result = parse_php("<?php f(&$a);");
    assert_no_errors(&result);
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
}

#[test]
fn test_assign_by_ref_has_by_ref_true() {
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
}

#[test]
fn test_assign_by_ref_distinct_from_regular_assign_in_ast() {
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
}

#[test]
fn test_array_element_by_ref_has_by_ref_true() {
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
}

#[test]
fn test_list_element_by_ref_has_by_ref_true() {
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
}

#[test]
fn test_empty_destructuring_slot_is_omit_not_null() {
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
}

#[test]
fn test_list_empty_slot_is_omit_not_null() {
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
}

#[test]
fn test_null_literal_distinct_from_omit_in_array_destructuring() {
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
    let val = extract_string_value("<?php 'hél\\'lo';");
    assert_eq!(
        val, "hél'lo",
        "non-ASCII bytes must not be split into individual chars"
    );
}

#[test]
fn test_single_quoted_non_ascii_with_escaped_backslash() {
    let val = extract_string_value("<?php 'naïve\\\\path';");
    assert_eq!(
        val, "naïve\\path",
        "non-ASCII before \\\\ must decode correctly"
    );
}

// =============================================================================
// Integer overflow → float promotion (PHP semantics)
// =============================================================================

#[test]
fn test_int_overflow_decimal_promotes_to_float() {
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
}

#[test]
fn test_int_overflow_hex_promotes_to_float() {
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
}

#[test]
fn test_int_no_overflow_stays_int() {
    let result = parse_php("<?php 9223372036854775807;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        json.contains("\"Int\": 9223372036854775807"),
        "PHP_INT_MAX must stay as Int; got:\n{json}"
    );
}

// =============================================================================
// PHPDoc integration tests
// =============================================================================

/// Doc comments are attached to AST nodes. The .phpt fixtures in
/// categories/phpdoc/ test this via the ===ast=== section. This test verifies
/// the PHPDoc parser works on doc_comment text from AST nodes.
#[test]
fn phpdoc_from_ast_node() {
    let result = parse_php(
        "<?php
/**
 * Create a new user.
 *
 * @param string $name The user's name
 * @param int $age
 * @return User
 * @throws \\InvalidArgumentException
 */
function createUser(string $name, int $age): User {}
",
    );
    assert_no_errors(&result);

    // Doc comment is on the FunctionDecl node, not in result.comments
    let func = &result.program.stmts[0];
    let doc_text = match &func.kind {
        php_ast::StmtKind::Function(f) => f.doc_comment.as_ref().unwrap().text,
        _ => panic!("expected Function"),
    };
    let doc = php_rs_parser::phpdoc::parse(doc_text);
    assert_eq!(doc.summary, Some("Create a new user."));
    assert_eq!(doc.tags.len(), 4);
    assert!(matches!(
        &doc.tags[0],
        php_ast::PhpDocTag::Param {
            type_str: Some("string"),
            name: Some("$name"),
            ..
        }
    ));
    assert!(matches!(
        &doc.tags[1],
        php_ast::PhpDocTag::Param {
            type_str: Some("int"),
            name: Some("$age"),
            ..
        }
    ));
    assert!(matches!(
        &doc.tags[2],
        php_ast::PhpDocTag::Return {
            type_str: Some("User"),
            ..
        }
    ));
    assert!(matches!(
        &doc.tags[3],
        php_ast::PhpDocTag::Throws {
            type_str: Some("\\InvalidArgumentException"),
            ..
        }
    ));
}

#[test]
fn phpdoc_psalm_phpstan_from_ast_node() {
    let result = parse_php(
        "<?php
/**
 * @psalm-type UserId = positive-int
 */
class UserRepository {
    /**
     * @psalm-param non-empty-string $name
     * @phpstan-return list<User>
     * @psalm-assert-if-true User $result
     * @psalm-suppress InvalidReturnType
     */
    public function find(string $name): array {}
}
",
    );
    assert_no_errors(&result);

    // Class doc comment
    let class = match &result.program.stmts[0].kind {
        php_ast::StmtKind::Class(c) => c,
        _ => panic!("expected Class"),
    };
    let class_doc = php_rs_parser::phpdoc::parse(class.doc_comment.as_ref().unwrap().text);
    assert_eq!(class_doc.tags.len(), 1);
    assert!(matches!(
        &class_doc.tags[0],
        php_ast::PhpDocTag::TypeAlias {
            name: Some("UserId"),
            type_str: Some("positive-int")
        }
    ));

    // Method doc comment
    let method_doc_text = match &class.members[0].kind {
        php_ast::ClassMemberKind::Method(m) => m.doc_comment.as_ref().unwrap().text,
        _ => panic!("expected Method"),
    };
    let method_doc = php_rs_parser::phpdoc::parse(method_doc_text);
    assert_eq!(method_doc.tags.len(), 4);
    assert!(matches!(
        &method_doc.tags[0],
        php_ast::PhpDocTag::Param {
            type_str: Some("non-empty-string"),
            ..
        }
    ));
    assert!(matches!(
        &method_doc.tags[1],
        php_ast::PhpDocTag::Return {
            type_str: Some("list<User>"),
            ..
        }
    ));
    assert!(matches!(
        &method_doc.tags[2],
        php_ast::PhpDocTag::Assert {
            type_str: Some("User"),
            name: Some("$result")
        }
    ));
    assert!(matches!(
        &method_doc.tags[3],
        php_ast::PhpDocTag::Suppress {
            rules: "InvalidReturnType"
        }
    ));
}
