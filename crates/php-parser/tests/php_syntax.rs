#[path = "integration/common.rs"]
mod common;

use common::{
    collect_phpt_files, installed_php, normalize_quotes, php_lint, strip_stack_trace, Fixture,
    Version, SUPPORTED,
};
use rayon::prelude::*;
use std::sync::Mutex;

/// Errors `php -l` does not report: a fixture that lists errors must record a `php -l` failure.
fn non_fatal_errors(fixture: &Fixture) -> Vec<String> {
    let mut found = Vec::new();
    for target in SUPPORTED.map(Some) {
        if fixture.section("php_error", target).is_some() {
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

fn update_fixture_php_error(path: &std::path::Path, php: Version, actual: Option<&str>) {
    let content = std::fs::read_to_string(path)
        .unwrap_or_else(|e| panic!("failed to read {}: {e}", path.display()));
    let mut fixture = Fixture::parse(&content)
        .unwrap_or_else(|e| panic!("malformed fixture {}: {e}", path.display()));
    fixture.set_section_for("php_error", php, actual);
    std::fs::write(path, fixture.render())
        .unwrap_or_else(|e| panic!("failed to write {}: {e}", path.display()));
}

#[test]
fn fixture_files_are_valid_php() {
    let Some(php) = installed_php() else {
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

        let expected = fixture
            .section("php_error", Some(php))
            .map(|s| strip_stack_trace(&s.body));
        let actual = php_lint(source);
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
