//! `structural_fingerprint` must ignore positions and nothing else.

use php_ast::fingerprint::structural_fingerprint;
use php_ast::owned::{ClassMemberKind, StmtKind};

/// Fingerprint of the first top-level statement, from the owned and the
/// arena AST (they must agree with themselves, not with each other).
fn first_stmt(src: &str) -> (u64, u64) {
    let owned = php_rs_parser::parse(src);
    assert!(owned.errors.is_empty(), "{:?}", owned.errors);
    let arena = bumpalo::Bump::new();
    let parsed = php_rs_parser::parse_arena(&arena, src);
    (
        structural_fingerprint(&owned.program.stmts[0]),
        structural_fingerprint(&parsed.program.stmts[0]),
    )
}

#[test]
fn moving_code_keeps_the_fingerprint() {
    let base = first_stmt("<?php function f($x) { return $x + 1; }");
    for moved in [
        "<?php\n\n\n    function f($x) {\n        return $x + 1;\n    }",
        "<?php function f( $x ) { return $x+1; } // trailing",
        "<?php /* plain comments are not part of the AST */ function f($x) { return $x + 1; }",
    ] {
        assert_eq!(first_stmt(moved), base, "{moved}");
    }
}

#[test]
fn changing_code_changes_the_fingerprint() {
    let base = first_stmt("<?php function f($x) { return $x + 1; }");
    for changed in [
        "<?php function f($x) { return $x + 2; }",
        "<?php function f($y) { return $y + 1; }",
        "<?php function g($x) { return $x + 1; }",
        "<?php function f($x) { return $x - 1; }",
        "<?php function f($x) { return $x + 1.0; }",
        "<?php function f($x = null) { return $x + 1; }",
        "<?php function f(int $x) { return $x + 1; }",
        "<?php /** @param int $x */ function f($x) { return $x + 1; }",
    ] {
        let fp = first_stmt(changed);
        assert_ne!(fp.0, base.0, "owned: {changed}");
        assert_ne!(fp.1, base.1, "arena: {changed}");
    }
}

/// The case incremental analysis cares about: editing one method leaves the
/// fingerprints of the others unchanged, though their positions moved.
#[test]
fn editing_one_method_leaves_the_others_alone() {
    let methods = |src: &str| -> Vec<u64> {
        let result = php_rs_parser::parse(src);
        let StmtKind::Class(class) = &result.program.stmts[0].kind else {
            panic!("expected a class")
        };
        class
            .body
            .members
            .iter()
            .filter(|m| matches!(m.kind, ClassMemberKind::Method(_)))
            .map(structural_fingerprint)
            .collect()
    };
    let before = methods(
        "<?php class A {
            public function a() { return 1; }
            public function b() { return 2; }
            public function c() { return 3; }
        }",
    );
    let after = methods(
        "<?php class A {
            public function a() { $extra = 'a longer body'; return 1; }
            public function b() { return 2; }
            public function c() { return 3; }
        }",
    );
    assert_ne!(before[0], after[0]);
    assert_eq!(before[1..], after[1..]);
}
