#[path = "../../php-parser/tests/integration/common.rs"]
mod parser_common;

use parser_common::{collect_phpt_files, php_version, Fixture};
use php_printer::{PrettyPrinter, PrinterConfig};
use rayon::prelude::*;
use std::sync::Mutex;

/// Parse a printer fixture file.
///
/// Format:
/// ```text
/// ===config===          (optional)
/// blank_lines_upper_bound=0
/// no_source=true
/// strip_parens=true
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
    /// When true, `Parenthesized` nodes are removed before printing, as in a
    /// hand-built tree, so the printer must supply every parenthesis itself.
    strip_parens: bool,
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
    let mut strip_parens = false;
    for line in raw_config.lines() {
        if let Some(val) = line.strip_prefix("blank_lines_upper_bound=") {
            config.blank_lines_upper_bound = val.parse().expect("invalid blank_lines_upper_bound");
        } else if line == "no_source=true" {
            no_source = true;
        } else if line == "strip_parens=true" {
            strip_parens = true;
        }
    }

    PrinterFixture {
        raw_config,
        source: source.to_string(),
        expected: expected.to_string(),
        config,
        no_source,
        strip_parens,
    }
}

/// Drops every `Parenthesized` node.
struct StripParens;

impl<'src> php_ast::fold::Fold<'src> for StripParens {
    fn fold_expr<'new>(
        &mut self,
        arena: &'new bumpalo::Bump,
        expr: &php_ast::ast::Expr<'_, 'src>,
    ) -> php_ast::ast::Expr<'new, 'src> {
        match &expr.kind {
            php_ast::ast::ExprKind::Parenthesized(inner) => self.fold_expr(arena, inner),
            _ => php_ast::fold::fold_expr(self, arena, expr),
        }
    }
}

/// Fingerprint of `program`'s shape, which already encodes precedence, so
/// redundant parentheses do not count as a change.
fn shape(program: &php_ast::ast::Program) -> u64 {
    let arena = bumpalo::Bump::new();
    let stripped = php_ast::fold::fold_program(&mut StripParens, &arena, program);
    php_ast::fingerprint::structural_fingerprint(&stripped)
}

/// Print `source` the way `fixture` asks, returning the output and the shape
/// of the parsed source.
fn print_fixture(fixture: &PrinterFixture, source: &str) -> (String, u64) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, source);
    let mut printer = PrettyPrinter::new().config(fixture.config.clone());
    if !fixture.no_source {
        printer = printer.comments(result.source, &result.comments);
    }
    let printed = if fixture.strip_parens {
        let stripped = php_ast::fold::fold_program(&mut StripParens, &arena, &result.program);
        printer.print(&stripped)
    } else {
        printer.print(&result.program)
    };
    (printed, shape(&result.program))
}

/// Run all printer fixture tests from `.phpt` files.
///
/// Every fixture must print stably. Fixtures under `edge_cases/` must also
/// re-parse without errors to the same tree, spans and parentheses aside.
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

        let (actual, source_shape) = print_fixture(&fixture, &fixture.source);

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
        } else if actual != fixture.expected {
            failures.lock().unwrap().push(format!(
                "output mismatch in {rel}\nsource: {}\nexpected: {}\nactual:   {actual}",
                fixture.source, fixture.expected
            ));
            return;
        }

        let reparsed = {
            let arena = bumpalo::Bump::new();
            let result = php_rs_parser::parse_arena(&arena, &actual);
            (!result.errors.is_empty()).then(|| format!("{:?}", result.errors))
        };
        let (second, printed_shape) = print_fixture(&fixture, &actual);
        if rel.starts_with("edge_cases") {
            if let Some(errors) = reparsed {
                failures.lock().unwrap().push(format!(
                    "output of {rel} does not parse: {errors}\n{actual}"
                ));
                return;
            }
            if printed_shape != source_shape {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("meaning changed in {rel}\n{actual}"));
            }
        }
        if actual != second {
            failures.lock().unwrap().push(format!(
                "round-trip mismatch in {rel}\nfirst:  {actual}\nsecond: {second}"
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
        let fixture = Fixture::parse(&content)
            .unwrap_or_else(|e| panic!("malformed fixture {}: {e}", path.display()));
        let targets: Vec<_> = fixture
            .targets()
            .into_iter()
            .filter(|t| fixture.section("errors", *t).is_none())
            .collect();
        if fixture.is_ignored() || targets.is_empty() {
            skipped.fetch_add(1, Ordering::Relaxed);
            return;
        }

        let rel = path.strip_prefix(&parser_fixtures).unwrap();
        for target in targets {
            let options = match target {
                Some(v) => php_rs_parser::ParseOptions::default().version(php_version(v)),
                None => php_rs_parser::ParseOptions::default(),
            };
            let print = |source: &str| {
                let arena = bumpalo::Bump::new();
                let result = php_rs_parser::parse_arena_with(&arena, source, &options);
                php_printer::pretty_print(&result.program)
            };
            let first_print = print(fixture.source());
            let second_print = print(&first_print);

            if first_print != second_print {
                failures.lock().unwrap().push(format!(
                    "FAIL {}\n  first:  {first_print}\n  second: {second_print}",
                    rel.display()
                ));
            }
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
fn trailing_newline() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, "<?php echo 'hello';");
    let output = PrettyPrinter::new()
        .trailing_newline(true)
        .print(&result.program);
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
    assert_eq!(php_printer::pretty_print(&owned.program), printed);

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
            format!("<?php $a = {}1;", "~- +".repeat(5_000)),
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
        php_printer::pretty_print(&program),
        "<?php\n(($a + $b) * $c)->m();"
    );
}

#[test]
fn crlf_newline() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, "<?php if ($a) { echo 1; }");
    let mut config = PrinterConfig::default();
    config.newline = php_printer::Newline::CrLf;
    let out = PrettyPrinter::new().config(config).print(&result.program);
    assert_eq!(out, "<?php\r\nif ($a) {\r\n    echo 1;\r\n}");
}

#[test]
fn owned_program_keeps_comments() {
    let result = php_rs_parser::parse("<?php\n// greet\necho 'hi';");
    let out = PrettyPrinter::new()
        .comments(&result.source, &result.comments)
        .print(&result.program);
    assert_eq!(out, "<?php\n// greet\necho 'hi';");
}

/// String literals are bytes: ones that are not valid UTF-8 print as `\xNN` and read back as the
/// same bytes, and valid UTF-8 spelled with escapes (`"\xc3\xbf"`) prints as the character.
#[test]
fn string_bytes_survive_printing() {
    let code = r#"<?php
$a = "\xff";
$b = "a\x80b\xc3";
$c = "\u{D800}";
$d = "\xc3\xbf";
$e = "\xffx$y\x80";
$f = <<<EOT
\xfe$y
EOT;
"#;
    assert_round_trips(code);
    let printed = php_printer::pretty_print(&php_rs_parser::parse(code).program);
    assert!(printed.contains(r#""\xff""#), "{printed}");
    assert!(printed.contains(r#""a\x80b\xc3""#), "{printed}");
    assert!(printed.contains(r#""\xed\xa0\x80""#), "{printed}");
    assert!(printed.contains("'ÿ'"), "{printed}");
}
