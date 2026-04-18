use std::io::Write;

#[path = "common.rs"]
mod common;

/// Returns true if the installed PHP is >= min.
fn php_version_met(min: (u32, u32)) -> bool {
    // Named constants prevent Clippy from folding cfg!() values into bool literals.
    const V81: bool = cfg!(php_min_81);
    const V82: bool = cfg!(php_min_82);
    const V83: bool = cfg!(php_min_83);
    const V84: bool = cfg!(php_min_84);
    const V85: bool = cfg!(php_min_85);
    match min {
        (8, 1) => V81,
        (8, 2) => V82,
        (8, 3) => V83,
        (8, 4) => V84,
        (8, 5) => V85,
        _ => false,
    }
}

/// Returns true if the installed PHP version is strictly greater than `max`.
fn php_version_exceeded(max: (u32, u32)) -> bool {
    // Named constants prevent Clippy from folding cfg!() values into bool literals.
    const V82: bool = cfg!(php_min_82);
    const V83: bool = cfg!(php_min_83);
    const V84: bool = cfg!(php_min_84);
    const V85: bool = cfg!(php_min_85);
    match max {
        (8, 1) => V82,
        (8, 2) => V83,
        (8, 3) => V84,
        (8, 4) => V85,
        _ => false,
    }
}

/// Strip any trailing "Stack trace:\n#N {main}" block that PHP 8.5 appends to
/// fatal-error output. Stored `===php_error===` values contain only the error
/// line itself, so trimming the actual output keeps the comparison version-agnostic.
fn strip_stack_trace(s: &str) -> String {
    let mut lines: Vec<&str> = s.lines().collect();
    while let Some(last) = lines.last() {
        if last.starts_with('#') || *last == "Stack trace:" {
            lines.pop();
        } else {
            break;
        }
    }
    lines.join("\n")
}

/// Normalize identifier quote style in PHP error messages.
/// PHP versions differ in whether they use single or double quotes around
/// identifiers (e.g. `"static"` vs `'static'`). Normalizing to double quotes
/// before comparing keeps the check version-agnostic.
fn normalize_quotes(s: &str) -> String {
    s.replace('\'', "\"")
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

/// Extract the `===php_error===` section from fixture content, if present.
fn parse_php_error(content: &str) -> Option<String> {
    content.find("===php_error===\n").map(|p| {
        let after = &content[p + "===php_error===\n".len()..];
        after.trim_end_matches('\n').to_string()
    })
}

/// Rewrite (or add) the `===php_error===` section of a fixture file.
fn update_fixture_php_error(path: &str, actual: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));

    let new_content = if let Some(p) = content.find("===php_error===\n") {
        // Replace the existing section.
        format!("{}===php_error===\n{}\n", &content[..p], actual)
    } else {
        // Append a new section.
        format!(
            "{}\n===php_error===\n{}\n",
            content.trim_end_matches('\n'),
            actual
        )
    };

    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}

/// Validates every `.phpt` fixture file through `php -l`.
///
/// - Fixtures with `===php_error===`: asserts `php -l` rejects them and that the stderr
///   matches the stored expected error. Run `UPDATE_FIXTURES=1 cargo test` to populate or
///   refresh `===php_error===` sections.
/// - All other fixtures: asserts `php -l` accepts them.
///
/// `===errors===` is about the Rust parser only and does not affect this test.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let update = std::env::var("UPDATE_FIXTURES").is_ok();

    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let mut failures: Vec<String> = Vec::new();

    for path in paths {
        let label = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let src = std::fs::read_to_string(&path).unwrap();
        let (config, source) = common::parse_fixture(&src);
        let php_error = parse_php_error(&src);

        if let Some(min) = config.min_php {
            if !php_version_met(min) {
                continue;
            }
        }
        if let Some(max) = config.max_php {
            if php_version_exceeded(max) {
                continue;
            }
        }

        let out = php_lint(source);

        if let Some(expected) = &php_error {
            // Fixture declares PHP must reject it — assert it fails and message matches.
            if out.status.success() {
                failures.push(format!("{label}: expected php -l to fail but it passed"));
                continue;
            }
            let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
            if update {
                update_fixture_php_error(path.to_str().unwrap(), &actual);
            } else if normalize_quotes(&actual) != normalize_quotes(&strip_stack_trace(expected)) {
                failures.push(format!(
                    "{label}:\n  expected: {expected}\n  actual:   {actual}"
                ));
            }
        } else {
            // No ===php_error=== — PHP must accept.
            if !out.status.success() {
                let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
                if update {
                    update_fixture_php_error(path.to_str().unwrap(), &actual);
                } else {
                    failures.push(format!("{label}:\n  {actual}"));
                }
            }
        }
    }

    if !failures.is_empty() {
        panic!(
            "php -l check failed for {} fixture(s):\n\n{}",
            failures.len(),
            failures.join("\n\n")
        );
    }
}
