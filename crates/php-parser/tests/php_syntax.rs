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

/// Validates that all `assert_parses_clean!` cases in `malformed_php.rs` are also
/// accepted by `php -l`. These are inputs the Rust parser intentionally accepts
/// without errors; this test confirms PHP itself also accepts them.
///
/// If any case is rejected by PHP but accepted by the Rust parser, it should be
/// documented with an explicit comment explaining the intentional divergence.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn malformed_clean_cases_are_valid_php() {
    // NOTE: Intentional divergences from PHP's parser are documented here.
    //
    // switch_multiple_defaults: PHP rejects duplicate `default` at compile level (Fatal
    // error). The Rust parser treats it as a semantic error and accepts at parse level.
    //
    // declare_in_conditional: `strict_types` inside a conditional block is a runtime
    // Fatal error in PHP ("must be the very first statement"), but the Rust parser does
    // not enforce this positional constraint at parse time.
    //
    // list_nested_destructuring: mixing `list()` and `[]` in a single destructuring
    // expression ("Cannot mix [] and list()") is a Fatal error in PHP. The Rust parser
    // accepts the syntax and leaves this constraint to a semantic analysis phase.

    let cases: &[(&str, &str)] = &[
        (
            "array_unpack_with_string_keys",
            "<?php $a = ['x' => 1]; $b = [...$a];",
        ),
        ("array_nested_unpack_syntax", "<?php [...[...[1, 2]], 3];"),
        // Undefined label is a compile-time error, not a parse error
        ("goto_undefined_label", "<?php goto undefined; undefined:"),
        (
            "declare_multiple_directives_mixed",
            "<?php declare(encoding='UTF-8', strict_types=1, ticks=1);",
        ),
        // declare_in_conditional is intentionally excluded — see note above
        (
            "trait_multiple_insteadof",
            "<?php
            trait T1 { public function m() {} }
            trait T2 { public function m() {} }
            trait T3 { public function m() {} }
            class C {
                use T1, T2, T3 {
                    T1::m insteadof T2, T3;
                    T2::m insteadof T3;
                }
            }",
        ),
        (
            "deep_namespace_nesting",
            "<?php namespace A\\B\\C\\D\\E\\F\\G { class X {} }",
        ),
        // list_nested_destructuring is intentionally excluded — see note above
        (
            "list_with_string_keys",
            "<?php list('key' => $value) = $arr;",
        ),
    ];

    for (label, code) in cases {
        assert_php_syntax_labeled(label, code);
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
