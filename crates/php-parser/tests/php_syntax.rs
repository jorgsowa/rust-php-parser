use std::io::Write;

#[path = "inline_cases.rs"]
mod inline_cases;

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

fn assert_php_syntax(code: &str) {
    assert_php_syntax_labeled("(unlabeled)", code);
}

/// Validates every entry in `inline_cases::CASES` through `php -l`.
/// Entries whose `min_php` / `max_php` bounds the installed PHP cannot satisfy are skipped.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn inline_cases_are_valid_php() {
    const MIN_81: bool = cfg!(php_min_81);
    const MIN_82: bool = cfg!(php_min_82);
    const MIN_83: bool = cfg!(php_min_83);
    const MIN_84: bool = cfg!(php_min_84);
    const MIN_85: bool = cfg!(php_min_85);

    for case in inline_cases::CASES {
        let min_ok = match case.min_php {
            inline_cases::MinPhp::Any => true,
            inline_cases::MinPhp::Php81 => MIN_81,
            inline_cases::MinPhp::Php82 => MIN_82,
            inline_cases::MinPhp::Php83 => MIN_83,
            inline_cases::MinPhp::Php84 => MIN_84,
            inline_cases::MinPhp::Php85 => MIN_85,
        };
        let max_ok = match case.max_php {
            inline_cases::MaxPhp::Any => true,
            inline_cases::MaxPhp::Php84 => !MIN_85,
            inline_cases::MaxPhp::Php83 => !MIN_84,
            inline_cases::MaxPhp::Php82 => !MIN_83,
        };
        if min_ok && max_ok {
            assert_php_syntax_labeled(case.label, case.source);
        }
    }
}

/// Validates every `.php` fixture file through `php -l`.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut entries: Vec<_> = std::fs::read_dir(&dir)
        .unwrap()
        .filter_map(|e| e.ok())
        .filter(|e| {
            let p = e.path();
            // error_recovery.php is intentionally invalid PHP
            p.extension().and_then(|x| x.to_str()) == Some("php")
                && p.file_name().and_then(|n| n.to_str()) != Some("error_recovery.php")
        })
        .collect();
    // Sort for deterministic output
    entries.sort_by_key(|e| e.path());
    for entry in entries {
        let path = entry.path();
        let label = path.file_name().unwrap().to_str().unwrap();
        let src = std::fs::read_to_string(&path).unwrap();
        assert_php_syntax_labeled(label, &src);
    }
}

// PHP 8.3+
#[cfg_attr(not(php_min_83), ignore)]
#[test]
fn typed_class_constants() {
    assert_php_syntax("<?php class A { const int X = 1; private const string Y = 'a'; const Foo|Bar|null Z = null; }");
}

#[cfg_attr(not(php_min_83), ignore)]
#[test]
fn new_readonly_anonymous_class() {
    assert_php_syntax("<?php new readonly class {};");
}

// PHP 8.4+
#[cfg_attr(not(php_min_84), ignore)]
#[test]
fn property_hook_body() {
    assert_php_syntax("<?php class A { public string $x { get { ?> <?php } } }");
}

// PHP 8.5+
#[cfg_attr(not(php_min_85), ignore)]
#[test]
fn constructor_final_param() {
    assert_php_syntax("<?php class P { public function __construct(final $i) {} }");
}
