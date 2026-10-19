#[path = "integration/common.rs"]
mod common;

use common::{collect_phpt_files, Fixture, Version};
use rayon::prelude::*;
use std::io::Write;
use std::sync::Mutex;

/// Version of the `php` binary on `PATH`, or `None` when PHP is not installed.
fn php_version() -> Option<(u32, u32)> {
    let out = std::process::Command::new("php")
        .args(["-r", "echo PHP_MAJOR_VERSION.\".\".PHP_MINOR_VERSION;"])
        .output()
        .ok()?;
    let ver = String::from_utf8_lossy(&out.stdout);
    let (maj, min) = ver.trim().split_once('.')?;
    Some((maj.parse().ok()?, min.parse().ok()?))
}

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

/// Errors `php -l` does not report: a fixture that lists errors must record a `php -l` failure.
fn non_fatal_errors(fixture: &Fixture) -> Vec<String> {
    // CI runs php -l from 8.1; older targets have no recorded php -l output.
    let checked =
        |v: &Option<Version>| v.is_none_or(|v| fixture.versions().is_none() || v >= (8, 1));
    let mut found = Vec::new();
    for target in fixture.targets().iter().filter(|v| checked(v)) {
        if fixture.section("php_error", *target).is_some() {
            continue;
        }
        let Some(errors) = fixture.section("errors", *target) else {
            continue;
        };
        for line in errors
            .body
            .lines()
            .filter(|l| !l.is_empty() && !l.contains(" requires PHP "))
        {
            if !found.iter().any(|f| f == line) {
                found.push(line.to_string());
            }
        }
    }
    found
}

fn update_fixture_php_error(path: &std::path::Path, php: Version, actual: &str) {
    let content = std::fs::read_to_string(path)
        .unwrap_or_else(|e| panic!("failed to read {}: {e}", path.display()));
    let mut fixture = Fixture::parse(&content);
    fixture.set_section("php_error", Some(php), actual);
    std::fs::write(path, fixture.render())
        .unwrap_or_else(|e| panic!("failed to write {}: {e}", path.display()));
}

#[test]
fn fixture_files_are_valid_php() {
    let Some(php) = php_version() else {
        assert!(
            std::env::var_os("CI").is_none(),
            "`php` not found on PATH in CI"
        );
        eprintln!("skipping: `php` not found on PATH");
        return;
    };
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let update = std::env::var("UPDATE_FIXTURES").is_ok();

    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let failures = Mutex::new(Vec::new());

    paths.par_iter().for_each(|path| {
        let label = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let src = std::fs::read_to_string(path).unwrap();
        let fixture = Fixture::parse(&src);
        let source = fixture.source();

        let non_fatal = non_fatal_errors(&fixture);
        if !non_fatal.is_empty() {
            failures.lock().unwrap().push(format!(
                "{label}: parser reports errors `php -l` does not:\n  {}",
                non_fatal.join("\n  ")
            ));
        }

        let applies = fixture
            .versions()
            .is_none_or(|versions| versions.contains(&php));
        if !applies {
            return;
        }
        let target = fixture.versions().map(|_| php);
        let php_error = fixture.section("php_error", target).map(|s| s.body.clone());

        let out = php_lint(source);

        if let Some(expected) = &php_error {
            if out.status.success() {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("{label}: expected php -l to fail but it passed"));
                return;
            }
            let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
            if update {
                update_fixture_php_error(path, php, &actual);
            } else if normalize_quotes(&actual) != normalize_quotes(&strip_stack_trace(expected)) {
                failures.lock().unwrap().push(format!(
                    "{label}:\n  expected: {expected}\n  actual:   {actual}"
                ));
            }
        } else {
            if !out.status.success() {
                let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
                if update {
                    update_fixture_php_error(path, php, &actual);
                } else {
                    failures
                        .lock()
                        .unwrap()
                        .push(format!("{label}:\n  {actual}"));
                }
            }
        }
    });

    let f = failures.into_inner().unwrap();
    if !f.is_empty() {
        panic!(
            "php -l check failed for {} fixture(s):\n\n{}",
            f.len(),
            f.join("\n\n")
        );
    }
}
