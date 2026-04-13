mod common;
use common::to_json;

// =============================================================================
// Fixture file tests
// =============================================================================

/// Recursively collect all `.phpt` files under `dir`, excluding `corpus/`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
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
        let content = std::fs::read_to_string(&path).unwrap();
        let (config, source) = common::parse_fixture(&content);
        let arena = bumpalo::Bump::new();

        let result = if let Some(ver) = config.parse_version {
            php_rs_parser::parse_versioned(&arena, source, common::php_version(ver))
        } else {
            php_rs_parser::parse(&arena, source)
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
            let errors = common::format_errors(&result);
            common::update_fixture(path.to_str().unwrap(), &errors, &actual);
        } else {
            let expected = config
                .expected_ast
                .unwrap_or_else(|| panic!("missing ===ast=== section in {rel}"));
            assert_eq!(actual, expected, "AST mismatch in {rel}");
        }
    }
}
