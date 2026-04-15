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

/// Recursively collect all `.phpt` files under `dir`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
        } else if path.extension().map_or(false, |ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Validates every `.phpt` fixture file through `php -l`.
///
/// - Fixtures with `===php_error===`: asserts `php -l` rejects them and that the stderr
///   matches the stored expected error. Run `UPDATE_FIXTURES=1 cargo test` to populate or
///   refresh `===php_error===` sections.
/// - All other fixtures (except those skipped by `min_php`, `parse_version`, or
///   `===errors===`): asserts `php -l` accepts them.
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

        if let Some(min_php) = config.min_php {
            if !php_version_met(min_php) {
                continue;
            }
        }
        // Skip version-specific fixtures — they test parser behavior at a particular
        // PHP version and may contain syntax that PHP itself rejects semantically.
        if config.parse_version.is_some() {
            continue;
        }
        if config.expect_errors {
            continue;
        }

        let out = php_lint(source);

        if let Some(expected) = &config.php_error {
            // Fixture is marked as intentionally rejected by PHP — assert it fails.
            if out.status.success() {
                failures.push(format!("{label}: expected php -l to fail but it passed"));
                continue;
            }
            let actual = String::from_utf8_lossy(&out.stderr).trim().to_string();
            if update {
                common::update_fixture_php_error(path.to_str().unwrap(), &actual);
            } else if actual != *expected {
                failures.push(format!(
                    "{label}:\n  expected: {expected}\n  actual:   {actual}"
                ));
            }
        } else {
            // Normal fixture — assert it passes.
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
