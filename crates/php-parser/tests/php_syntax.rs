#[path = "integration/common.rs"]
mod common;

use common::{collect_phpt_files, Fixture, Version, DEFAULT, SUPPORTED};
use rayon::prelude::*;
use std::io::Write;
use std::sync::Mutex;

/// Version of the `php` binary on `PATH`, or `None` when PHP is not installed.
fn php_version() -> Option<Version> {
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
    let mut found = Vec::new();
    for target in fixture.targets() {
        if fixture
            .section("php_error", Some(target.unwrap_or(DEFAULT)))
            .is_some()
        {
            continue;
        }
        let Some(errors) = fixture.section("errors", target) else {
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

/// Oldest PHP the CI matrix runs `php -l` with. Older versions are only linted for fixtures
/// that target them; for the rest they record this version's output.
const OLDEST_LINTED: Version = (8, 0);

/// Whether `php -l` on `php` is checked against `fixture`.
fn lints(fixture: &Fixture, php: Version) -> bool {
    php >= OLDEST_LINTED || fixture.targets().contains(&Some(php))
}

fn update_fixture_php_error(path: &std::path::Path, php: Version, actual: Option<&str>) {
    let content = std::fs::read_to_string(path)
        .unwrap_or_else(|e| panic!("failed to read {}: {e}", path.display()));
    let mut fixture = Fixture::parse(&content)
        .unwrap_or_else(|e| panic!("malformed fixture {}: {e}", path.display()));
    let follows = |v: Version| php == OLDEST_LINTED && v < php && !lints(&fixture, v);
    let versions: Vec<Version> = SUPPORTED
        .into_iter()
        .filter(|v| *v == php || follows(*v))
        .collect();
    for v in versions {
        fixture.set_section_for("php_error", v, actual);
    }
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
    assert!(
        SUPPORTED.contains(&php),
        "PHP {}.{} is not in SUPPORTED, so no fixture section can match it",
        php.0,
        php.1
    );
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
        let fixture = match Fixture::parse(&src) {
            Ok(fixture) => fixture,
            Err(e) => {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("malformed fixture {label}: {e}"));
                return;
            }
        };
        let source = fixture.source();

        let non_fatal = non_fatal_errors(&fixture);
        if !non_fatal.is_empty() {
            failures.lock().unwrap().push(format!(
                "{label}: parser reports errors `php -l` does not:\n  {}",
                non_fatal.join("\n  ")
            ));
        }

        if !lints(&fixture, php) {
            return;
        }
        let expected = fixture
            .section("php_error", Some(php))
            .map(|s| strip_stack_trace(&s.body));
        let out = php_lint(source);
        let actual = (!out.status.success())
            .then(|| strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim()));
        if expected.as_deref().map(normalize_quotes) == actual.as_deref().map(normalize_quotes) {
            return;
        }
        if update {
            update_fixture_php_error(path, php, actual.as_deref());
            return;
        }
        let at = format!("{label} (PHP {}.{})", php.0, php.1);
        failures.lock().unwrap().push(match (expected, actual) {
            (Some(_), None) => format!("{at}: expected php -l to fail but it passed"),
            (None, Some(a)) => format!("{at}: no ===php_error=== section matches:\n  {a}"),
            (Some(e), Some(a)) => format!("{at}:\n  expected: {e}\n  actual:   {a}"),
            (None, None) => unreachable!(),
        });
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
