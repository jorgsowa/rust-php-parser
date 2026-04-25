use php_printer::pretty_print;

fn pp(src: &str) -> String {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, src);
    pretty_print(&result.program)
}

/// Parse, print, re-parse, print again — output must be identical.
fn round_trip(src: &str) {
    let first = pp(src);
    let second = pp(&format!("<?php {first}"));
    assert_eq!(
        first, second,
        "round-trip mismatch:\nfirst:  {first}\nsecond: {second}"
    );
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

    for path in &paths {
        let rel = path.strip_prefix(&dir).unwrap().to_string_lossy();
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
            assert_eq!(
                actual, fixture.expected,
                "output mismatch in {rel}\nsource: {}\nexpected: {}\nactual:   {actual}",
                fixture.source, fixture.expected
            );
        }

        // Also verify round-trip stability
        round_trip(&fixture.source);
    }
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

/// Fixtures with known printer bugs. Skipped until the underlying issues are fixed.
///
/// Categories:
/// - dnf: DNF intersection types (`A&B|C`) need parenthesisation in printed output
/// - inline_html: inline HTML inside function/block bodies emits a spurious extra `;`
/// - phpdoc: PHPDoc re-indent drifts on each round-trip inside class bodies
/// - halt_compiler: missing newline after `__halt_compiler();` data payload
/// - dynamic: `$obj->($expr)` dynamic property/method access not yet printable
/// - misc: assorted unimplemented or partially-supported printer features
const KNOWN_FAILURES: &[&str] = &[
    // dnf
    "categories/type_hints/dnf_complex.phpt",
    "categories/type_hints/dnf_multi_groups.phpt",
    "categories/type_hints/dnf_property_type.phpt",
    "categories/type_hints/dnf_return_type.phpt",
    "categories/type_hints/dnf_triple_groups.phpt",
    "complex_dnf_type.phpt",
    "corpus/stmt/function/disjointNormalFormTypes.phpt",
    "dnf_type_union_of_intersections.phpt",
    "dnf_type_with_null.phpt",
    "dnf_types.phpt",
    "dnf_types_complex.phpt",
    "versioned/dnf_types_require_82_v82.phpt",
    // inline_html
    "inline_html_comment_in_function_body.phpt",
    "inline_html_in_function_body.phpt",
    "inline_html_multiple_segments_in_function.phpt",
    "no_hang/catch_body.phpt",
    "no_hang/closure_body.phpt",
    "no_hang/enum_method_body.phpt",
    "no_hang/finally_body.phpt",
    "no_hang/function_body.phpt",
    "no_hang/method_body.phpt",
    "no_hang/namespace_braced.phpt",
    "no_hang/namespace_global_braced.phpt",
    "no_hang/property_hook_body.phpt",
    "no_hang/try_body.phpt",
    // phpdoc
    "categories/phpdoc/assert_type_alias.phpt",
    "categories/phpdoc/phpdoc_psalm_phpstan.phpt",
    "categories/phpdoc/property_var_deprecated.phpt",
    "categories/phpdoc/psalm_phpstan_annotations.phpt",
    "categories/phpdoc/pure_immutable_readonly.phpt",
    "categories/phpdoc/template_generics.phpt",
    // halt_compiler
    "corpus/stmt/haltCompiler_1.phpt",
    "corpus/stmt/namespace/outsideStmt_1.phpt",
    "halt_compiler_close_tag.phpt",
    // dynamic
    "categories/dynamic_access/dynamic_prop_expr.phpt",
    "dynamic_method_call.phpt",
    "dynamic_property_access.phpt",
    "corpus/expr/fetchAndCall/objectAccess.phpt",
    // misc
    "categories/destructuring/list_shorthand_only_commas.phpt",
    "categories/string_interpolation/unicode_escape_in_heredoc.phpt",
    "corpus/expr/arrayDestructuring.phpt",
    "corpus/expr/newDeref.phpt",
    "corpus/expr/shellExec.phpt",
    "corpus/formattingAttributes.phpt",
    "corpus/scalar/docString.phpt",
    "corpus/scalar/encapsedString.phpt",
    "corpus/scalar/unicodeEscape_3.phpt",
    "corpus/stmt/function/variadic.phpt",
    "versioned/const_attributes_require_85_v85.phpt",
];

/// Verify that every error-free parser fixture survives a print → re-parse → re-print
/// round trip (i.e. the printer produces stable output).
///
/// Fixtures listed in `KNOWN_FAILURES` are skipped; remove entries from that list
/// as the underlying printer bugs are fixed.
#[test]
fn parser_corpus_round_trip() {
    let parser_fixtures =
        std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("../php-parser/tests/fixtures");

    let mut paths = collect_phpt_files(&parser_fixtures);
    paths.sort();

    let mut failures: Vec<String> = Vec::new();
    let mut checked = 0usize;
    let mut skipped = 0usize;

    for path in &paths {
        let content = std::fs::read_to_string(path).unwrap();
        let header = parse_parser_fixture_header(&content);

        if header.has_errors {
            skipped += 1;
            continue;
        }

        let rel = path.strip_prefix(&parser_fixtures).unwrap();
        let rel_str = rel.to_string_lossy().replace('\\', "/");
        if KNOWN_FAILURES.contains(&rel_str.as_str()) {
            skipped += 1;
            continue;
        }

        let source = extract_parser_fixture_source(&content, &header);

        let first_print = {
            let arena = bumpalo::Bump::new();
            let result = match header.min_php {
                Some((maj, min)) => {
                    php_rs_parser::parse_versioned(&arena, source, php_version(maj, min))
                }
                None => php_rs_parser::parse(&arena, source),
            };
            php_printer::pretty_print(&result.program)
        };

        let second_print = {
            let arena = bumpalo::Bump::new();
            let reprinted = format!("<?php {first_print}");
            let result = php_rs_parser::parse(&arena, &reprinted);
            php_printer::pretty_print(&result.program)
        };

        if first_print != second_print {
            failures.push(format!(
                "FAIL {}\n  first:  {first_print}\n  second: {second_print}",
                rel.display()
            ));
        }
        checked += 1;
    }

    eprintln!("parser_corpus_round_trip: {checked} checked, {skipped} skipped");
    assert!(
        failures.is_empty(),
        "{} round-trip failure(s):\n{}",
        failures.len(),
        failures.join("\n\n")
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
