//! Fixture corpus tests for both the arena and owned parse APIs.

use crate::common::{php_version, run_fixture_corpus};

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

#[test]
fn arena_fixtures() {
    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    run_fixture_corpus(
        |source, min_php| {
            let arena = bumpalo::Bump::new();
            let result = match min_php.map(php_version) {
                Some(v) => php_rs_parser::parse_arena_versioned(&arena, source, v),
                None => php_rs_parser::parse_arena(&arena, source),
            };
            let errors = result.errors.iter().map(|e| e.to_string()).collect();
            let json = serde_json::to_string_pretty(&result.program).unwrap();
            (errors, json)
        },
        update.then_some(update_fixture as fn(&str, &str, &str)),
    );
}

#[test]
fn owned_fixtures() {
    run_fixture_corpus(
        |source, min_php| {
            let result = match min_php.map(php_version) {
                Some(v) => php_rs_parser::parse_versioned(source, v),
                None => php_rs_parser::parse(source),
            };
            let errors = result.errors.iter().map(|e| e.to_string()).collect();
            let json = serde_json::to_string_pretty(&result.program).unwrap();
            (errors, json)
        },
        None::<fn(&str, &str, &str)>,
    );
}

// ---------------------------------------------------------------------------
// Owned-API compile-time and runtime properties
// ---------------------------------------------------------------------------

fn assert_static_send_sync<T: 'static + Send + Sync>() {}

#[test]
fn parse_result_is_static_send_sync() {
    assert_static_send_sync::<php_rs_parser::ParseResult>();
}

#[test]
fn parse_results_can_be_stored_in_hashmap() {
    use std::collections::HashMap;
    use std::path::PathBuf;

    let fixtures = [
        "categories/class/anon_class_full.phpt",
        "enum_basic.phpt",
        "heredoc_with_complex_interpolation.phpt",
    ];

    let cache: HashMap<PathBuf, php_rs_parser::ParseResult> = fixtures
        .iter()
        .map(|rel| {
            let path = PathBuf::from(env!("CARGO_MANIFEST_DIR"))
                .join("tests/fixtures")
                .join(rel);
            let content = std::fs::read_to_string(&path).unwrap();
            let (min_php, source) = crate::common::parse_fixture(&content);
            let result = match min_php.map(php_version) {
                Some(v) => php_rs_parser::parse_versioned(source, v),
                None => php_rs_parser::parse(source),
            };
            (PathBuf::from(rel), result)
        })
        .collect();

    assert_eq!(cache.len(), fixtures.len());
}
