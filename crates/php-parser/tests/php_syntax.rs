use std::io::Write;

fn assert_php_syntax(code: &str) {
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
    let out = child.wait_with_output().unwrap();
    if !out.status.success() {
        panic!("php -l failed:\n{}", String::from_utf8_lossy(&out.stderr));
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
