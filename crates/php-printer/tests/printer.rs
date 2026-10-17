use php_printer::{pretty_print_with_comments_and_config, PrinterConfig};
use rayon::prelude::*;
use std::sync::Mutex;

/// Parse a printer fixture file.
///
/// Format:
/// ```text
/// ===config===          (optional)
/// blank_lines_upper_bound=0
/// no_source=true
/// ===source===
/// <?php ...
/// ===print===
/// expected output
/// ```
struct PrinterFixture {
    /// Raw config block (without the `===config===\n` header), empty string if absent.
    raw_config: String,
    source: String,
    expected: String,
    config: PrinterConfig,
    /// When true, source is not passed to the printer (tests the no-source fallback).
    no_source: bool,
}

fn parse_printer_fixture(content: &str) -> PrinterFixture {
    let (raw_config, rest) = if let Some(after) = content.strip_prefix("===config===\n") {
        let end = after
            .find("===source===\n")
            .expect("fixture must have ===source===");
        (
            after[..end].trim_end_matches('\n').to_string(),
            &after[end..],
        )
    } else {
        (String::new(), content)
    };

    let after_source = rest
        .strip_prefix("===source===\n")
        .expect("fixture must have ===source===");

    let print_pos = after_source
        .find("===print===\n")
        .expect("fixture must have ===print===");

    let source = after_source[..print_pos]
        .strip_suffix('\n')
        .unwrap_or(&after_source[..print_pos]);
    let expected = &after_source[print_pos + "===print===\n".len()..];
    let expected = expected.strip_suffix('\n').unwrap_or(expected);

    let mut config = PrinterConfig::default();
    let mut no_source = false;
    for line in raw_config.lines() {
        if let Some(val) = line.strip_prefix("blank_lines_upper_bound=") {
            config.blank_lines_upper_bound = val.parse().expect("invalid blank_lines_upper_bound");
        } else if line == "no_source=true" {
            no_source = true;
        }
    }

    PrinterFixture {
        raw_config,
        source: source.to_string(),
        expected: expected.to_string(),
        config,
        no_source,
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

        let actual = {
            let arena = bumpalo::Bump::new();
            let result = php_rs_parser::parse_arena(&arena, &fixture.source);
            if fixture.no_source {
                php_printer::pretty_print_with_config(&result.program, &fixture.config)
            } else {
                pretty_print_with_comments_and_config(
                    &result.program,
                    result.source,
                    &result.comments,
                    &fixture.config,
                )
            }
        };

        if update {
            let config_block = if fixture.raw_config.is_empty() {
                String::new()
            } else {
                format!("===config===\n{}\n", fixture.raw_config)
            };
            let new_content = format!(
                "{}===source===\n{}\n===print===\n{}\n",
                config_block, fixture.source, actual
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
        let result1 = php_rs_parser::parse_arena(&arena1, &fixture.source);
        let first = if fixture.no_source {
            php_printer::pretty_print_with_config(&result1.program, &fixture.config)
        } else {
            pretty_print_with_comments_and_config(
                &result1.program,
                result1.source,
                &result1.comments,
                &fixture.config,
            )
        };
        let arena2 = bumpalo::Bump::new();
        let result2 = php_rs_parser::parse_arena(&arena2, &first);
        let second = if fixture.no_source {
            php_printer::pretty_print_with_config(&result2.program, &fixture.config)
        } else {
            pretty_print_with_comments_and_config(
                &result2.program,
                result2.source,
                &result2.comments,
                &fixture.config,
            )
        };
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
    let end = [
        after.find("===errors===\n"),
        after.find("===php_error===\n"),
        after.find("===ast===\n"),
    ]
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
        (8, 6) => php_rs_parser::PhpVersion::Php86,
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

        let first_print = {
            let arena = bumpalo::Bump::new();
            let result = match header.min_php {
                Some((maj, min)) => {
                    php_rs_parser::parse_arena_versioned(&arena, source, php_version(maj, min))
                }
                None => php_rs_parser::parse_arena(&arena, source),
            };
            php_printer::pretty_print(&result.program)
        };

        let second_print = {
            let arena = bumpalo::Bump::new();
            let result = php_rs_parser::parse_arena(&arena, &first_print);
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
    let result = php_rs_parser::parse_arena(&arena, "<?php echo 'hello';");
    let output = php_printer::pretty_print_file(&result.program);
    assert_eq!(output, "<?php\necho 'hello';\n");
}

// ============================================================================
// Deep and long input
// ============================================================================

fn on_stack<F: FnOnce() + Send + 'static>(bytes: usize, f: F) {
    std::thread::Builder::new()
        .stack_size(bytes)
        .spawn(f)
        .unwrap()
        .join()
        .unwrap();
}

/// Print `code` through both the arena and the owned API and check that the
/// output is complete, parses cleanly and is stable when printed again.
fn assert_round_trips(code: &str) {
    let arena = bumpalo::Bump::new();
    let parsed = php_rs_parser::parse_arena(&arena, code);
    assert!(parsed.errors.is_empty(), "{:?}", parsed.errors);
    let printed = php_printer::pretty_print(&parsed.program);
    assert!(!printed.contains("max depth"), "printer truncated the tree");

    let owned = php_rs_parser::parse(code);
    assert_eq!(php_printer::pretty_print_owned(&owned.program), printed);

    let reparsed = php_rs_parser::parse_arena(&arena, &printed);
    assert!(reparsed.errors.is_empty(), "{:?}", reparsed.errors);
    assert_eq!(php_printer::pretty_print(&reparsed.program), printed);
}

/// A 300-term concatenation used to cross the printer's 256-level limit and
/// come out as `/* max depth */`, which is not valid PHP.
#[test]
fn long_chains_print_in_full() {
    on_stack(1024 * 1024, || {
        for code in [
            format!("<?php echo $a{};", " . $a".repeat(300)),
            format!("<?php echo $a{};", " . $a".repeat(20_000)),
            format!("<?php $a{};", "->b()".repeat(20_000)),
            format!("<?php $a{};", "?->b[0]::C->d(...)".repeat(2_000)),
        ] {
            assert_round_trips(&code);
        }
        // Printed as `(($a ?: $b) ?: $b) ?: …`, which would re-parse as
        // nesting rather than a chain, so only the first print is checked.
        let code = format!("<?php $a{};", " ?: $b".repeat(5_000));
        let arena = bumpalo::Bump::new();
        let parsed = php_rs_parser::parse_arena(&arena, &code);
        let printed = php_printer::pretty_print(&parsed.program);
        assert!(printed.ends_with(") ?: $b;") && !printed.contains("max depth"));
    });
}

/// The printer's limit sits above anything the parser accepts.
#[test]
fn maximally_nested_input_prints_in_full() {
    // Unoptimised builds need far more stack per level than release builds.
    on_stack(256 * 1024 * 1024, || {
        for code in [
            format!("<?php {}{}", "if ($a) {".repeat(500), "}".repeat(500)),
            format!("<?php {}1{};", "[".repeat(500), "]".repeat(500)),
            format!(
                "<?php {}1{};",
                "function () { return ".repeat(250),
                "; }".repeat(250)
            ),
        ] {
            assert_round_trips(&code);
        }
    });
}

/// Chain links are printed iteratively, so the parentheses each link needs
/// must still open and close in the right places.
#[test]
fn chain_operands_get_parentheses_from_precedence() {
    use php_ast::ast::BinaryOp;
    use php_ast::owned::*;
    use php_ast::Span;

    let expr = |kind| Expr {
        kind,
        span: Span::DUMMY,
    };
    let var = |name: &str| expr(ExprKind::Variable(name.into()));
    let binary = |left, op, right| {
        expr(ExprKind::Binary(BinaryExpr {
            left: Box::new(left),
            op,
            right: Box::new(right),
        }))
    };
    // (($a + $b) * $c)->m() with no Parenthesized nodes: every chain link
    // binds looser than its parent and needs parentheses supplied.
    let sum = binary(var("a"), BinaryOp::Add, var("b"));
    let product = binary(sum, BinaryOp::Mul, var("c"));
    let call = expr(ExprKind::MethodCall(Box::new(MethodCallExpr {
        object: Box::new(product),
        method: Box::new(expr(ExprKind::Identifier("m".into()))),
        args: Box::new([]),
    })));
    let program = Program {
        stmts: Box::new([Stmt {
            kind: StmtKind::Expression(Box::new(call)),
            span: Span::DUMMY,
            doc_comment: None,
        }]),
        span: Span::DUMMY,
    };
    assert_eq!(
        php_printer::pretty_print_owned(&program),
        "<?php\n(($a + $b) * $c)->m();"
    );
}
