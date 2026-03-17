mod common;

#[test]
fn test_multiple_declare_directives() {
    let code = r#"<?php
declare(encoding='UTF-8', strict_types=1);
echo "test";
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_complex_trait_precedence() {
    let code = r#"<?php
trait A {
    public function m() {}
}
trait B {
    public function m() {}
    public function n() {}
}
class C {
    use A, B {
        A::m insteadof B;
        B::n insteadof A;
    }
}
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_readonly_class_property_promotion() {
    let code = r#"<?php
readonly class Test {
    public function __construct(
        public string $name,
        private int $age,
    ) {}
}
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_property_hooks_with_types() {
    let code = r#"<?php
class Test {
    private string $value {
        get => $this->val ?? '';
        set(string $v) { $this->val = $v; }
    }
}
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_enum_with_backing_values() {
    let code = r#"<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
}
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_match_expression() {
    let code = r#"<?php
$result = match($x) {
    1 => 'one',
    2 => 'two',
    default => 'other',
};
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}

#[test]
fn test_namespace_with_statements() {
    let code = r#"<?php
namespace MySpace;
class Test {}
function foo() {}
"#;
    let json = common::parse_code(code, false);
    assert!(!json.is_empty());
}
