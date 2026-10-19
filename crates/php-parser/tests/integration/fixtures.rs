//! Fixture corpus tests for both the arena and owned parse APIs.

use crate::common::{php_version, run_fixture_corpus};

#[test]
fn arena_fixtures() {
    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    run_fixture_corpus(
        |source, min_php| {
            let arena = bumpalo::Bump::new();
            let result = match min_php.map(php_version) {
                Some(v) => php_rs_parser::parse_arena_with(
                    &arena,
                    source,
                    &php_rs_parser::ParseOptions::default().version(v),
                ),
                None => php_rs_parser::parse_arena(&arena, source),
            };
            let errors = result.errors.iter().map(|e| e.to_string()).collect();
            let json = serde_json::to_string_pretty(&result.program).unwrap();
            (errors, json)
        },
        update,
    );
}

#[test]
fn owned_fixtures() {
    run_fixture_corpus(
        |source, min_php| {
            let result = match min_php.map(php_version) {
                Some(v) => php_rs_parser::parse_with(
                    source,
                    &php_rs_parser::ParseOptions::default().version(v),
                ),
                None => php_rs_parser::parse(source),
            };
            let errors = result.errors.iter().map(|e| e.to_string()).collect();
            let json = serde_json::to_string_pretty(&result.program).unwrap();
            (errors, json)
        },
        false,
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
            let fixture = crate::common::Fixture::parse(&content);
            let result = match fixture.targets()[0].map(php_version) {
                Some(v) => php_rs_parser::parse_with(
                    fixture.source(),
                    &php_rs_parser::ParseOptions::default().version(v),
                ),
                None => php_rs_parser::parse(fixture.source()),
            };
            (PathBuf::from(rel), result)
        })
        .collect();

    assert_eq!(cache.len(), fixtures.len());
}

#[test]
fn result_types_implement_debug_and_clone() {
    fn assert_debug_clone<T: std::fmt::Debug + Clone>() {}
    fn assert_debug<T: std::fmt::Debug>() {}
    assert_debug_clone::<php_rs_parser::ParseResult>();
    assert_debug_clone::<php_rs_parser::source_map::SourceMap>();
    assert_debug::<php_rs_parser::ArenaParseResult<'_, '_>>();
    assert_debug::<php_rs_parser::ParserContext>();
}
