use php_printer::pretty_print_with_comments;
use rayon::prelude::*;
use std::sync::Mutex;

fn pp(src: &str) -> String {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, src);
    pretty_print_with_comments(&result.program, result.source, &result.comments)
}

/// Parse a printer fixture file.
///
/// Format:
/// ```text
/// ===source===
/// <?php ...
/// ===print===
/// expected output
/// ```
struct PrinterFixture {
    source: String,
    expected: String,
}

fn parse_printer_fixture(content: &str) -> PrinterFixture {
    let after_source = content
        .strip_prefix("===source===\n")
        .expect("fixture must start with ===source===");

    let print_pos = after_source
        .find("===print===\n")
        .expect("fixture must have ===print=== section");

    let source = after_source[..print_pos]
        .strip_suffix('\n')
        .unwrap_or(&after_source[..print_pos]);
    let expected = &after_source[print_pos + "===print===\n".len()..];
    let expected = expected.strip_suffix('\n').unwrap_or(expected);

    PrinterFixture {
        source: source.to_string(),
        expected: expected.to_string(),
    }
}

/// Recursively collect all `.phpt` files under `dir`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
        } else if path.extension().is_some_and(|ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Run all printer fixture tests from `.phpt` files.
///
/// Set `UPDATE_FIXTURES=1` to regenerate expected output.
#[test]
fn fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let failures = Mutex::new(Vec::new());

    paths.par_iter().for_each(|path| {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let fixture = parse_printer_fixture(&content);

        let actual = pp(&fixture.source);

        if update {
            let new_content = format!(
                "===source===\n{}\n===print===\n{}\n",
                fixture.source, actual
            );
            std::fs::write(path, new_content).unwrap();
        } else {
            if actual != fixture.expected {
                failures.lock().unwrap().push(format!(
                    "output mismatch in {rel}\nsource: {}\nexpected: {}\nactual:   {actual}",
                    fixture.source, fixture.expected
                ));
                return;
            }
        }

        // Also verify round-trip stability
        let arena1 = bumpalo::Bump::new();
        let result1 = php_rs_parser::parse(&arena1, &fixture.source);
        let first = pretty_print_with_comments(&result1.program, result1.source, &result1.comments);
        let starts_with_html = matches!(
            result1.program.stmts.first().map(|s| &s.kind),
            Some(php_ast::ast::StmtKind::InlineHtml(_))
        );
        let round_trip_src = if starts_with_html {
            first.clone()
        } else {
            format!("<?php {first}")
        };
        let arena2 = bumpalo::Bump::new();
        let result = php_rs_parser::parse(&arena2, &round_trip_src);
        let second = pretty_print_with_comments(&result.program, result.source, &result.comments);
        if first != second {
            failures.lock().unwrap().push(format!(
                "round-trip mismatch in {rel}\nfirst:  {first}\nsecond: {second}"
            ));
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(
        f.is_empty(),
        "printer fixture failures:\n{}",
        f.join("\n\n")
    );
}

// =============================================================================
// Parser corpus round-trip
// =============================================================================

struct ParserFixtureHeader {
    source_start: usize,
    has_errors: bool,
    min_php: Option<(u32, u32)>,
}

fn parse_parser_fixture_header(content: &str) -> ParserFixtureHeader {
    let has_errors = content.contains("===errors===\n");

    let mut min_php = None;
    let rest = if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = val
                    .split_once('.')
                    .and_then(|(a, b)| Some((a.parse::<u32>().ok()?, b.parse::<u32>().ok()?)));
            }
        }
        rest
    } else {
        content
    };

    let source_start = content.len() - rest.len()
        + rest
            .find("===source===\n")
            .map(|p| p + "===source===\n".len())
            .unwrap_or(rest.len());

    ParserFixtureHeader {
        source_start,
        has_errors,
        min_php,
    }
}

fn extract_parser_fixture_source<'a>(content: &'a str, header: &ParserFixtureHeader) -> &'a str {
    let after = &content[header.source_start..];
    let end = [after.find("===errors===\n"), after.find("===ast===\n")]
        .into_iter()
        .flatten()
        .min();
    let raw = match end {
        Some(e) => &after[..e],
        None => after,
    };
    if end.is_some() {
        raw.strip_suffix('\n').unwrap_or(raw)
    } else {
        raw
    }
}

fn php_version(major: u32, minor: u32) -> php_rs_parser::PhpVersion {
    match (major, minor) {
        (7, 4) => php_rs_parser::PhpVersion::Php74,
        (8, 0) => php_rs_parser::PhpVersion::Php80,
        (8, 1) => php_rs_parser::PhpVersion::Php81,
        (8, 2) => php_rs_parser::PhpVersion::Php82,
        (8, 3) => php_rs_parser::PhpVersion::Php83,
        (8, 4) => php_rs_parser::PhpVersion::Php84,
        _ => php_rs_parser::PhpVersion::Php85,
    }
}

#[test]
fn parser_corpus_round_trip() {
    use std::sync::atomic::{AtomicUsize, Ordering};
    use std::sync::Arc;

    let parser_fixtures =
        std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("../php-parser/tests/fixtures");

    let mut paths = collect_phpt_files(&parser_fixtures);
    paths.sort();

    let failures = Mutex::new(Vec::new());
    let checked = Arc::new(AtomicUsize::new(0));
    let skipped = Arc::new(AtomicUsize::new(0));

    paths.par_iter().for_each(|path| {
        let content = std::fs::read_to_string(path).unwrap();
        let header = parse_parser_fixture_header(&content);

        if header.has_errors {
            skipped.fetch_add(1, Ordering::Relaxed);
            return;
        }

        let rel = path.strip_prefix(&parser_fixtures).unwrap();
        let source = extract_parser_fixture_source(&content, &header);

        let (first_print, starts_with_html) = {
            let arena = bumpalo::Bump::new();
            let result = match header.min_php {
                Some((maj, min)) => {
                    php_rs_parser::parse_versioned(&arena, source, php_version(maj, min))
                }
                None => php_rs_parser::parse(&arena, source),
            };
            let html = matches!(
                result.program.stmts.first().map(|s| &s.kind),
                Some(php_ast::ast::StmtKind::InlineHtml(_))
            );
            (php_printer::pretty_print(&result.program), html)
        };

        let second_print = {
            let arena = bumpalo::Bump::new();
            let reprinted = if starts_with_html {
                first_print.clone()
            } else {
                format!("<?php {first_print}")
            };
            let result = php_rs_parser::parse(&arena, &reprinted);
            php_printer::pretty_print(&result.program)
        };

        if first_print != second_print {
            failures.lock().unwrap().push(format!(
                "FAIL {}\n  first:  {first_print}\n  second: {second_print}",
                rel.display()
            ));
        }
        checked.fetch_add(1, Ordering::Relaxed);
    });

    let checked_val = checked.load(Ordering::Relaxed);
    let skipped_val = skipped.load(Ordering::Relaxed);
    eprintln!("parser_corpus_round_trip: {checked_val} checked, {skipped_val} skipped");
    let f = failures.into_inner().unwrap();
    assert!(
        f.is_empty(),
        "{} round-trip failure(s):\n{}",
        f.len(),
        f.join("\n\n")
    );
}

// =============================================================================
// File output
// =============================================================================

#[test]
fn pretty_print_file() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, "<?php echo 'hello';");
    let output = php_printer::pretty_print_file(&result.program);
    assert_eq!(output, "<?php\n\necho 'hello';\n");
}
