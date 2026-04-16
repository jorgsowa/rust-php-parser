mod common;

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

fn format_errors(result: &php_rs_parser::ParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

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

/// Parse every `.phpt` file in `tests/fixtures/` (recursive).
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
        let (parse_version, source) = common::parse_fixture(&content);
        let arena = bumpalo::Bump::new();

        let result = if let Some(ver) = parse_version {
            php_rs_parser::parse_versioned(&arena, source, php_version(ver))
        } else {
            php_rs_parser::parse(&arena, source)
        };

        let expect_errors = content.contains("===errors===\n");
        if expect_errors {
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
            assert_eq!(actual, *expected, "error messages mismatch in {rel}");
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
            let expected =
                expected_ast.unwrap_or_else(|| panic!("missing ===ast=== section in {rel}"));
            assert_eq!(actual, expected, "AST mismatch in {rel}");
        }
    }
}
