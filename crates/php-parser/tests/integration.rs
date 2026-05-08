mod common;

use rayon::prelude::*;
use std::sync::Mutex;

fn to_json(program: &php_ast::Program) -> String {
    serde_json::to_string_pretty(program).unwrap()
}

fn php_version(v: (u32, u32)) -> php_rs_parser::PhpVersion {
    match v {
        (7, 4) => php_rs_parser::PhpVersion::Php74,
        (8, 0) => php_rs_parser::PhpVersion::Php80,
        (8, 1) => php_rs_parser::PhpVersion::Php81,
        (8, 2) => php_rs_parser::PhpVersion::Php82,
        (8, 3) => php_rs_parser::PhpVersion::Php83,
        (8, 4) => php_rs_parser::PhpVersion::Php84,
        (8, 5) => php_rs_parser::PhpVersion::Php85,
        _ => panic!("unsupported PHP version: {}.{}", v.0, v.1),
    }
}

use common::{collect_phpt_files, format_errors};

/// Rewrite the `===errors===` and `===ast===` sections of a fixture file.
/// Preserves any existing `===php_error===` section that follows.
fn update_fixture(path: &str, errors: &str, new_ast: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));

    let php_error_section = content
        .find("===php_error===\n")
        .map(|p| content[p..].trim_end_matches('\n').to_string() + "\n");

    let source_marker = "===source===\n";
    let after_source = content
        .find(source_marker)
        .map(|p| p + source_marker.len())
        .unwrap_or(0);

    let rest = &content[after_source..];
    let source_end = rest
        .find("===errors===\n")
        .or_else(|| rest.find("===ast===\n"))
        .map(|p| after_source + p)
        .unwrap_or(content.len());

    let before_sections = &content[..source_end];
    let php_error_tail = php_error_section.as_deref().unwrap_or("");
    let new_content = if errors.is_empty() {
        format!("{before_sections}===ast===\n{new_ast}\n{php_error_tail}")
    } else {
        format!("{before_sections}===errors===\n{errors}\n===ast===\n{new_ast}\n{php_error_tail}")
    };
    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}

// =============================================================================
// Fixture file tests
// =============================================================================

/// Parse every `.phpt` file in `tests/fixtures/` (recursive).
/// Handles both clean-parse and error-expected fixtures, as well as version-specific ones.
#[test]
fn fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    let failures = Mutex::new(Vec::new());

    paths.par_iter().for_each(|path| {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let (min_php, source) = common::parse_fixture(&content);
        let arena = bumpalo::Bump::new();

        let result = if let Some(ver) = min_php {
            php_rs_parser::parse_versioned(&arena, source, php_version(ver))
        } else {
            php_rs_parser::parse(&arena, source)
        };

        let expect_errors = content.contains("===errors===\n");
        if expect_errors {
            if result.errors.is_empty() {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("expected parse errors in {rel} but got none"));
                return;
            }
        } else {
            if !result.errors.is_empty() {
                failures.lock().unwrap().push(format!(
                    "unexpected parse errors in {rel}: {:?}",
                    result.errors
                ));
                return;
            }
        }

        let expected_errors: Option<String> = content.find("===errors===\n").and_then(|e| {
            let after = &content[e + "===errors===\n".len()..];
            let end = after.find("===ast===\n").unwrap_or(after.len());
            let text = after[..end].trim_end_matches('\n').to_string();
            if text.is_empty() {
                None
            } else {
                Some(text)
            }
        });

        if let Some(expected) = &expected_errors {
            let actual = format_errors(&result);
            if actual != *expected {
                failures.lock().unwrap().push(format!(
                    "error messages mismatch in {rel}\nexpected:\n{}\nactual:\n{}",
                    expected, actual
                ));
                return;
            }
        }

        let actual = to_json(&result.program);
        if update {
            let errors = format_errors(&result);
            update_fixture(path.to_str().unwrap(), &errors, &actual);
        } else {
            let expected_ast = content.find("===ast===\n").map(|a| {
                let after = &content[a + "===ast===\n".len()..];
                let end = after.find("===php_error===\n").unwrap_or(after.len());
                after[..end].trim_end_matches('\n').to_string()
            });
            let expected = match expected_ast {
                Some(e) => e,
                None => {
                    failures
                        .lock()
                        .unwrap()
                        .push(format!("missing ===ast=== section in {rel}"));
                    return;
                }
            };
            if actual != expected {
                failures.lock().unwrap().push(format!(
                    "AST mismatch in {rel}\nexpected:\n{}\nactual:\n{}",
                    expected, actual
                ));
            }
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(f.is_empty(), "fixture test failure(s):\n{}", f.join("\n\n"));
}
