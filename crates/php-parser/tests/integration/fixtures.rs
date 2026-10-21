//! Fixture corpus tests for both the arena and owned parse APIs.

use crate::common::{php_version, run_fixture_corpus, DEFAULT};

#[test]
fn arena_fixtures() {
    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    run_fixture_corpus(
        |source, min_php| {
            let arena = bumpalo::Bump::new();
            let result = php_rs_parser::parse_arena_with(
                &arena,
                source,
                &php_rs_parser::ParseOptions::default()
                    .version(php_version(min_php.unwrap_or(DEFAULT))),
            );
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
            let result = php_rs_parser::parse_with(
                source,
                &php_rs_parser::ParseOptions::default()
                    .version(php_version(min_php.unwrap_or(DEFAULT))),
            );
            let errors = result.errors.iter().map(|e| e.to_string()).collect();
            let json = serde_json::to_string_pretty(&result.program).unwrap();
            (errors, json)
        },
        false,
    );
}

#[test]
fn supported_versions_match_parser() {
    use crate::common::SUPPORTED;
    for (major, minor) in SUPPORTED {
        assert_eq!(
            php_version((major, minor)).to_string(),
            format!("{major}.{minor}")
        );
    }
    let latest = php_rs_parser::PhpVersion::Php86;
    assert_eq!(
        php_version(*SUPPORTED.last().unwrap()),
        latest,
        "add PHP {latest} to SUPPORTED; every open-ended `>=` fixture range then runs on it, \
         so review the fixture failures it causes"
    );
}

#[test]
fn malformed_fixtures_are_rejected() {
    use crate::common::Fixture;
    let ast = "{}";
    let cases = [
        (
            format!("===config===\nmin_php=8.1\n===source===\n<?php\n===ast===\n{ast}\n"),
            "unknown section `===config===` before ===source===",
        ),
        (
            format!("stray\n===source===\n<?php\n===ast===\n{ast}\n"),
            "text before the first section: `stray`",
        ),
        (
            format!("===versions===\n8.1\n===source===\n<?php\n===ast===\n{ast}\n"),
            "unknown section `===versions===` before ===source===",
        ),
        (
            format!("===source===\n<?php\n===ast >=8,4===\n{ast}\n"),
            "`===ast >=8,4===`: `8,4` is not a supported PHP version",
        ),
        (
            format!("===source===\n<?php\n===ast >=8.9===\n{ast}\n"),
            "`===ast >=8.9===`: `8.9` is not a supported PHP version",
        ),
        (
            format!("===source===\n<?php\n===ast 8.3-8.1===\n{ast}\n"),
            "`===ast 8.3-8.1===`: empty version range `8.3-8.1`",
        ),
        (
            format!("===source===\n<?php\n===print===\n{ast}\n"),
            "unknown section `===print===`",
        ),
        (
            format!("===source===\n<?php\n===ast <=8.3===\n{ast}\n===ast >=8.3===\n{ast}\n"),
            "===ast <=8.3=== overlaps ===ast >=8.3===",
        ),
        (
            format!("===source===\n<?php\n===errors 8.1===\nx\n===ast >=8.4===\n{ast}\n"),
            "===errors 8.1=== covers none of the versions the ===ast=== sections name",
        ),
        (
            format!("===source===\n<?php\n===errors <=8.3===\nx\n===ast===\n{ast}\n"),
            "===errors <=8.3=== needs a version-qualified ===ast=== section",
        ),
        (
            format!(
                "===source===\n<?php\n===php_error <=8.3===\nx\n===php_error >=8.3===\ny\n\
                 ===ast===\n{ast}\n"
            ),
            "===php_error <=8.3=== overlaps ===php_error >=8.3===",
        ),
        (
            format!("===source===\n<?php\n===ast===\n{ast}\n===ast >=8.4===\n{ast}\n"),
            "===ast=== is never used next to version-qualified ones",
        ),
        (
            format!("===source===\n<?php\n===errors===\nx\n===errors===\ny\n===ast===\n{ast}\n"),
            "more than one ===errors=== section",
        ),
    ];
    for (content, expected) in cases {
        assert_eq!(Fixture::parse(&content).unwrap_err(), expected, "{content}");
    }

    let valid = format!(
        "===source===\n<?php\n===errors <=8.3===\nx\n\
         ===php_error===\ny\n===ast <=8.3===\n{ast}\n===ast >=8.4===\n{ast}\n"
    );
    let fixture = Fixture::parse(&valid).unwrap();
    assert_eq!(fixture.targets().len(), crate::common::SUPPORTED.len());
}

#[test]
fn php_error_sections_are_independent_of_parse_targets() {
    use crate::common::Fixture;
    let content = "===source===\n<?php\n===php_error <=8.0===\nx\n===ast===\n{}\n";
    let fixture = Fixture::parse(content).unwrap();
    assert_eq!(
        fixture.section("php_error", Some((8, 0))).unwrap().body,
        "x"
    );
    assert!(fixture.section("php_error", Some((8, 1))).is_none());
}

#[test]
fn set_section_for_changes_one_version() {
    use crate::common::Fixture;
    let mut fixture =
        Fixture::parse("===source===\n<?php\n===php_error <=8.3===\nold\n===ast===\n{}\n").unwrap();
    fixture.set_section_for("php_error", (8, 1), Some("new"));
    assert!(fixture.render().contains(
        "===php_error <=8.0===\nold\n===php_error 8.1===\nnew\n===php_error 8.2-8.3===\nold\n"
    ));
    fixture.set_section_for("php_error", (8, 1), Some("old"));
    assert!(fixture
        .render()
        .contains("===php_error <=8.3===\nold\n===ast"));
    fixture.set_section_for("php_error", (8, 0), None);
    assert!(fixture
        .render()
        .contains("===php_error <=7.4===\nold\n===php_error 8.1-8.3===\nold\n===ast"));
    for v in crate::common::SUPPORTED {
        fixture.set_section_for("php_error", v, Some("all"));
    }
    assert!(fixture.render().contains("===php_error===\nall\n===ast"));
}

#[test]
fn fixtures_render_unchanged() {
    use crate::common::{collect_phpt_files, Fixture};
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut changed: Vec<String> = collect_phpt_files(&dir)
        .into_iter()
        .filter(|path| {
            let content = std::fs::read_to_string(path).unwrap();
            Fixture::parse(&content).is_ok_and(|f| f.render() != content)
        })
        .map(|path| path.strip_prefix(&dir).unwrap().display().to_string())
        .collect();
    changed.sort();
    assert!(
        changed.is_empty(),
        "fixtures not in canonical form:\n{}",
        changed.join("\n")
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
        "categories/enum/enum_basic.phpt",
        "categories/heredoc/heredoc_with_complex_interpolation.phpt",
    ];

    let cache: HashMap<PathBuf, php_rs_parser::ParseResult> = fixtures
        .iter()
        .map(|rel| {
            let path = PathBuf::from(env!("CARGO_MANIFEST_DIR"))
                .join("tests/fixtures")
                .join(rel);
            let content = std::fs::read_to_string(&path).unwrap();
            let fixture = crate::common::Fixture::parse(&content).unwrap();
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
