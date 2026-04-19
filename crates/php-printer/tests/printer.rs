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
// File output
// =============================================================================

#[test]
fn pretty_print_file() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, "<?php echo 'hello';");
    let output = php_printer::pretty_print_file(&result.program);
    assert_eq!(output, "<?php\n\necho 'hello';\n");
}
