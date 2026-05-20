//! Integration tests for the fold API using the real parser and full fixture corpus.
//! Verifies that the identity fold rebuilds every parsed AST into an identical JSON
//! representation, covering all statement and expression variants across the fixture suite.

use bumpalo::Bump;
use php_ast::fold::Fold;

struct Identity;
impl<'src> Fold<'src> for Identity {}

fn to_json(program: &php_ast::Program) -> String {
    serde_json::to_string(program).unwrap()
}

/// Parses every `.phpt` fixture (including error fixtures — the parser always produces a tree),
/// identity-folds into a fresh arena, and asserts the JSON output is bit-for-bit identical.
///
/// This single test exercises all 53 ExprKind variants and 32 StmtKind variants present in
/// the corpus without requiring a hand-written case per variant.
#[test]
fn identity_fold_matches_original_json_across_corpus() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths = crate::common::collect_phpt_files(&dir);
    paths.sort();

    let mut failures = Vec::new();

    for path in &paths {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let (min_php, source) = crate::common::parse_fixture(&content);
        let src_arena = Bump::new();

        let result = if let Some(ver) = min_php {
            php_rs_parser::parse_arena_versioned(
                &src_arena,
                source,
                crate::common::php_version(ver),
            )
        } else {
            php_rs_parser::parse_arena(&src_arena, source)
        };

        let original_json = to_json(&result.program);

        let out_arena = Bump::new();
        let folded = Identity.fold_program(&out_arena, &result.program);
        let folded_json = to_json(&folded);

        if original_json != folded_json {
            failures.push(format!(
                "fold changed AST in {rel}\noriginal:\n{original_json}\nfolded:\n{folded_json}"
            ));
        }
    }

    if !failures.is_empty() {
        panic!(
            "{} identity-fold mismatch(es):\n{}",
            failures.len(),
            failures.join("\n---\n")
        );
    }
}
