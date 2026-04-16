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

type VersionPair = (u32, u32);

/// Parse the `===config===` section of a fixture, returning `(min_php, max_php)`.
fn parse_config_versions(content: &str) -> (Option<VersionPair>, Option<VersionPair>) {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };

    let mut min_php = None;
    let mut max_php = None;

    if let Some(rest) = content.strip_prefix("===config===\n") {
        let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
        for line in rest[..source_marker].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = parse_ver(val);
            } else if let Some(val) = line.strip_prefix("max_php=") {
                max_php = parse_ver(val);
            }
        }
    }

    (min_php, max_php)
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
            "{}===php_error===\n{}\n",
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
        let (parse_version, source) = common::parse_fixture(&src);
        let (min_php, max_php) = parse_config_versions(&src);
        let php_error = parse_php_error(&src);

        if let Some(min) = min_php {
            if !php_version_met(min) {
                continue;
            }
        }
        if let Some(max) = max_php {
            if php_version_exceeded(max) {
                continue;
            }
        }
        // Skip version-specific fixtures — they test parser behavior at a particular
        // PHP version and may contain syntax that PHP itself rejects semantically.
        if parse_version.is_some() {
            continue;
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
            } else if actual != strip_stack_trace(expected) {
                failures.push(format!(
                    "{label}:\n  expected: {expected}\n  actual:   {actual}"
                ));
            }
        } else {
            // No ===php_error=== — PHP must accept.
            if !out.status.success() {
                failures.push(format!(
                    "{label}:\n  {}",
                    String::from_utf8_lossy(&out.stderr).trim()
                ));
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
