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

/// Validates every `.phpt` fixture file through `php -l` (recursive, including corpus/).
/// Skips error-expected fixtures, version-specific fixtures, and fixtures that declare
/// `php_rejects=<category>` in their `===config===` section (intentional parser leniency).
///
/// Categories used in `php_rejects`:
///   `parse-leniency` — syntax PHP rejects at parse time; we accept for AST completeness
///   `semantic`        — syntactically valid but PHP rejects at compile time (Fatal error)
///   `deprecated`      — removed syntax our parser still accepts for compatibility
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");

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

        if config.php_rejects.is_some() {
            continue;
        }
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
        if !out.status.success() {
            failures.push(format!(
                "{label}:\n  {}",
                String::from_utf8_lossy(&out.stderr).trim()
            ));
        }
    }

    if !failures.is_empty() {
        panic!(
            "php -l failed for {} fixture(s):\n\n{}",
            failures.len(),
            failures.join("\n\n")
        );
    }
}
