use std::io::Write;

#[path = "common.rs"]
mod common;

fn php_version_met(min: (u32, u32)) -> bool {
    match min {
        (8, 1) => cfg!(php_min_81),
        (8, 2) => cfg!(php_min_82),
        (8, 3) => cfg!(php_min_83),
        (8, 4) => cfg!(php_min_84),
        (8, 5) => cfg!(php_min_85),
        _ => false,
    }
}

fn php_lint(code: &str) -> std::process::Output {
    let mut child = std::process::Command::new("php")
        .arg("-l")
        .stdin(std::process::Stdio::piped())
        .stderr(std::process::Stdio::piped())
        .stdout(std::process::Stdio::null())
        .spawn()
        .expect("failed to spawn php");
    child
        .stdin
        .take()
        .unwrap()
        .write_all(code.as_bytes())
        .unwrap();
    child.wait_with_output().unwrap()
}

fn assert_php_syntax_labeled(label: &str, code: &str) {
    let out = php_lint(code);
    if !out.status.success() {
        panic!(
            "php -l failed ({label}):\n{}",
            String::from_utf8_lossy(&out.stderr)
        );
    }
}

/// Recursively collect all `.phpt` files under `dir`, excluding `corpus/`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            let name = path.file_name().unwrap().to_str().unwrap();
            if !matches!(name, "corpus" | "no_hang" | "versioned") {
                paths.extend(collect_phpt_files(&path));
            }
        } else if path.extension().map_or(false, |ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Validates every `.phpt` fixture file through `php -l` (recursive, excluding corpus/).
/// Skips error-expected fixtures, version-specific fixtures, and known divergences.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    // Fixtures where the Rust parser is intentionally more lenient than PHP.
    // Each entry is documented with the reason for the divergence.
    let php_rejects = &[
        // Calling with & at call-site was deprecated in PHP 5.3 and removed in 5.4;
        // our parser still accepts it for AST completeness.
        "arg_by_ref.phpt",
        // PHP forbids using reserved keywords as function names; our parser
        // accepts them gracefully without panicking.
        "keyword_as_function_clone.phpt",
        "keyword_as_function_die.phpt",
        "keyword_as_function_exit.phpt",
        "keyword_as_function_fn.phpt",
        "keyword_as_function_match.phpt",
        "keyword_as_function_readonly.phpt",
        // PHP rejects `null` in destructuring position; our parser accepts it
        // and lets semantic analysis report the error.
        "null_in_destructuring.phpt",
        // PHP 8 made legacy octal digits (e.g. 0778) a parse error; our parser
        // still accepts them for compatibility and emits a warning-level diagnostic.
        "legacy_octal_invalid_digits.phpt",
        // PHP forbids spread after named args at the engine level; our parser
        // parses the syntax to enable better error reporting downstream.
        "named_args_mixed_with_spread.phpt",
        // PHP forbids mixing [] and list() destructuring; our parser accepts both forms.
        "nested_list_destructuring.phpt",
        // PHP 8.1 only allows `new` in specific default-value positions; our parser
        // accepts it in any initializer context.
        "new_in_complex_initializers.phpt",
        "new_in_initializers.phpt",
        // PHP does not support `self` in intersection return types; our parser
        // accepts it and lets semantic analysis report the error.
        "return_type_self_intersection.phpt",
        // `static;` is parsed by our parser (static as a statement); PHP rejects it.
        "static_semicolon_as_stmt.phpt",
        // Duplicate `default` in switch is a semantic error, not a parse error;
        // our parser accepts it and leaves this constraint to semantic analysis.
        "switch_multiple_defaults.phpt",
    ];

    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    for path in paths {
        let name = path.file_name().and_then(|n| n.to_str()).unwrap_or("");
        if name == "error_recovery.phpt" || php_rejects.contains(&name) {
            continue;
        }

        let label = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let src = std::fs::read_to_string(&path).unwrap();
        let (config, source) = common::parse_fixture(&src);

        if let Some(min_php) = config.min_php {
            if !php_version_met(min_php) {
                continue;
            }
        }
        // Skip version-specific fixtures — the installed PHP may not support the
        // syntax being tested at the specified version.
        if config.parse_version.is_some() {
            continue;
        }
        if config.expect_errors {
            continue;
        }
        assert_php_syntax_labeled(&label, source);
    }
}
