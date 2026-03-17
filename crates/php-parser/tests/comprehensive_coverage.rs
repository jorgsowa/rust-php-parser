mod common;

// ============================================================================
// DECLARE STATEMENT VARIATIONS (test all combinations)
// ============================================================================

#[test]
fn test_declare_single_directive() {
    let code = r#"<?php
declare(strict_types=1);
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_multiple_directives() {
    let code = r#"<?php
declare(strict_types=1, encoding='UTF-8');
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_ticks_directive() {
    let code = r#"<?php
declare(ticks=1);
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_with_statement_body() {
    let code = r#"<?php
declare(strict_types=1) {
    function test() {}
    class Test {}
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_with_colon_syntax() {
    let code = r#"<?php
declare(strict_types=1):
    function test() {}
    class Test {}
enddeclare;
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_nested_in_namespace() {
    let code = r#"<?php
namespace App;
declare(strict_types=1);
class Test {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_declare_all_three_directives() {
    let code = r#"<?php
declare(strict_types=1, ticks=1, encoding='UTF-8');
"#;
    common::parse_code(code, false);
}

// ============================================================================
// TRAIT ADAPTATIONS (various combinations)
// ============================================================================

#[test]
fn test_trait_single_insteadof() {
    let code = r#"<?php
trait A { public function m() {} }
trait B { public function m() {} }
class C {
    use A, B {
        A::m insteadof B;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_multiple_insteadof() {
    let code = r#"<?php
trait A { public function m() {} }
trait B { public function m() {} }
trait D { public function m() {} }
class C {
    use A, B, D {
        A::m insteadof B, D;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_alias_with_visibility() {
    let code = r#"<?php
trait A { public function m() {} }
class C {
    use A {
        m as private aliased;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_alias_with_protected() {
    let code = r#"<?php
trait A { public function m() {} }
class C {
    use A {
        m as protected;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_qualified_alias() {
    let code = r#"<?php
trait A { public function m() {} }
trait B { public function m() {} }
class C {
    use A, B {
        A::m as private am;
        B::m as public bm;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_unqualified_alias() {
    let code = r#"<?php
trait A { public function m() {} }
class C {
    use A {
        m as private;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_mixed_adaptations() {
    let code = r#"<?php
trait A { public function m1() {} public function m2() {} }
trait B { public function m1() {} }
class C {
    use A, B {
        A::m1 insteadof B;
        A::m2 as private renamed;
        B::m1 as public b_method;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_trait_no_adaptations() {
    let code = r#"<?php
trait A {}
trait B {}
class C {
    use A, B;
}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// PROPERTY HOOKS (various combinations)
// ============================================================================

#[test]
fn test_property_hooks_simple() {
    let code = r#"<?php
class Test {
    public $value {
        get { return 42; }
        set { }
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_with_types() {
    let code = r#"<?php
class Test {
    public int $count {
        get { return $this->_count ?? 0; }
        set(int $value) { $this->_count = $value; }
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_arrow_syntax() {
    let code = r#"<?php
class Test {
    private string $name {
        get => $this->_name ?? '';
        set(string $value) => $this->_name = $value;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_get_only() {
    let code = r#"<?php
class Test {
    public $readonly {
        get => 'constant';
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_set_only() {
    let code = r#"<?php
class Test {
    public $writeonly {
        set { $this->value = $value; }
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_abstract() {
    let code = r#"<?php
abstract class Test {
    abstract public $prop {
        &get;
        set;
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_complex_property_declaration() {
    let code = r#"<?php
class Test {
    public int $prop1;
    protected string $prop2 = 'default';
    private array $prop3 = [];
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_with_attributes() {
    let code = r#"<?php
class Test {
    #[Property('name')]
    #[Length(255)]
    public string $name;

    #[Validate('required')]
    private int $age;
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_property_hooks_with_final() {
    let code = r#"<?php
class Test {
    public $prop {
        final get { return 42; }
        final set { }
    }
}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// CLASS VARIATIONS (readonly, enums, etc.)
// ============================================================================

#[test]
fn test_readonly_class_basic() {
    let code = r#"<?php
readonly class Test {
    public function __construct(
        public string $name,
    ) {}
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_readonly_class_multiple_properties() {
    let code = r#"<?php
readonly class Test {
    public function __construct(
        public string $name,
        public int $age,
        private array $data,
    ) {}
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_enum_simple() {
    let code = r#"<?php
enum Status {
    case Active;
    case Inactive;
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_enum_with_string_backing() {
    let code = r#"<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_enum_with_int_backing() {
    let code = r#"<?php
enum Priority: int {
    case Low = 1;
    case Medium = 2;
    case High = 3;
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_enum_with_methods() {
    let code = r#"<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
    
    public function label(): string {
        return match($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_enum_with_public_method() {
    let code = r#"<?php
enum Color: string {
    case Red = 'red';
    
    public function hex(): string {
        return match($this) {
            self::Red => '#FF0000',
        };
    }
}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// NAMESPACE VARIATIONS
// ============================================================================

#[test]
fn test_namespace_braced_with_multiple_statements() {
    let code = r#"<?php
namespace App {
    class A {}
    class B {}
    function test() {}
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_unbraced_with_multiple_statements() {
    let code = r#"<?php
namespace App;
class A {}
class B {}
function test() {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_nested_simple() {
    let code = r#"<?php
namespace App\Sub;
class Test {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_with_use_statements() {
    let code = r#"<?php
namespace App;
use PDO;
use function strlen;
use const PHP_VERSION;
class Test {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_group_use() {
    let code = r#"<?php
namespace App;
use Some\Namespace\{
    ClassA,
    ClassB,
    ClassC,
};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_group_use_mixed() {
    // Group use with mixed types - test simpler variant
    let code = r#"<?php
namespace App;
use Some\{ClassA, ClassB, ClassC as C};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_use_with_alias() {
    let code = r#"<?php
namespace App;
use PDO as Database;
use function strlen as stringLength;
class Test {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_namespace_multiple_unbraced_blocks() {
    let code = r#"<?php
namespace App;
class A {}
namespace App\Sub;
class B {}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// FUNCTION PARAMETER COMBINATIONS
// ============================================================================

#[test]
fn test_function_params_all_types() {
    let code = r#"<?php
function test(
    string $a,
    int $b = 0,
    array $c = [],
    ?string $d = null,
    string|int $e = '',
    $f,
    ...$rest
) {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_function_params_with_types_union() {
    let code = r#"<?php
function test(
    int|string $param1,
    array|null $param2,
    string|int|bool $param3
) {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_function_params_with_intersection_types() {
    let code = r#"<?php
function test(
    A&B $param1,
    X&Y&Z $param2
) {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_function_params_with_defaults() {
    let code = r#"<?php
function test(
    $a = [],
    $b = 'string',
    $c = 123,
    $d = null,
    $e = true,
    $f = 1.5
) {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_function_params_reference_variadic() {
    let code = r#"<?php
function test(
    &$ref,
    ...$variadic,
    &...$refVariadic = null
) {}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// CONTROL FLOW COMBINATIONS
// ============================================================================

#[test]
fn test_switch_with_multiple_cases() {
    let code = r#"<?php
switch ($x) {
    case 1:
        echo 'one';
        break;
    case 2:
        echo 'two';
        break;
    case 3:
    case 4:
        echo 'three or four';
        break;
    default:
        echo 'other';
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_switch_with_match_fallthrough() {
    let code = r#"<?php
switch ($x) {
    case 1:
    case 2:
    case 3:
        echo 'matches';
    case 4:
        echo 'four';
        break;
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_try_catch_multiple_catches() {
    let code = r#"<?php
try {
    // code
} catch (TypeError | ValueError $e) {
    // handle
} catch (Exception $e) {
    // handle
} finally {
    // cleanup
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_try_finally_no_catch() {
    let code = r#"<?php
try {
    // code
} finally {
    // cleanup
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_match_expression_complex() {
    let code = r#"<?php
$result = match ($x) {
    1, 2 => 'small',
    3, 4, 5 => 'medium',
    6, 7, 8, 9, 10 => 'large',
    default => 'unknown',
};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_match_with_conditions() {
    let code = r#"<?php
$result = match (true) {
    $x < 0 => 'negative',
    $x === 0 => 'zero',
    $x > 0 => 'positive',
};
"#;
    common::parse_code(code, false);
}

// ============================================================================
// ATTRIBUTE COMBINATIONS
// ============================================================================

#[test]
fn test_attributes_on_class() {
    let code = r#"<?php
#[Route('/path')]
#[Method('GET')]
class Controller {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_attributes_on_function() {
    let code = r#"<?php
#[Route('/path', 'GET')]
function handler() {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_attributes_on_property() {
    let code = r#"<?php
class Test {
    #[Column('name')]
    #[Length(255)]
    public string $name;
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_attributes_on_parameter() {
    let code = r#"<?php
function test(
    #[Validate('email')]
    string $email,
    #[Validate('required')]
    string $name
) {}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_attributes_with_arguments() {
    let code = r#"<?php
#[Route(path: '/api/users', methods: ['GET', 'POST'])]
class Api {}
"#;
    common::parse_code(code, false);
}

// ============================================================================
// COMPLEX NESTED STRUCTURES
// ============================================================================

#[test]
fn test_class_with_multiple_methods() {
    let code = r#"<?php
class Test {
    public function method1() {
        $nested = function() { };
    }

    private function method2() {
        $arrow = fn($x) => $x * 2;
    }

    protected static function method3() {}
}
"#;
    common::parse_code(code, false);
}

#[test]
fn test_anonymous_class_with_traits() {
    let code = r#"<?php
$obj = new class {
    use TraitA, TraitB {
        TraitA::method insteadof TraitB;
    }
    
    public function test() {}
};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_anonymous_class_readonly() {
    let code = r#"<?php
$obj = new readonly class {
    public function __construct(
        public string $name,
    ) {}
};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_closure_with_use_variables() {
    let code = r#"<?php
$x = 1;
$y = 2;
$closure = function ($a) use ($x, &$y) {
    return $a + $x + $y;
};
"#;
    common::parse_code(code, false);
}

#[test]
fn test_arrow_function_with_type_hints() {
    let code = r#"<?php
$fn = fn(int $x, string $y): string => $x . $y;
"#;
    common::parse_code(code, false);
}

// ============================================================================
// ADVANCED EXPRESSION COMBINATIONS
// ============================================================================

#[test]
fn test_nullsafe_chaining() {
    let code = r#"<?php
$result = $obj?->method()?->property()?->value;
"#;
    common::parse_code(code, false);
}

#[test]
fn test_null_coalescing_chain() {
    let code = r#"<?php
$value = $a ?? $b ?? $c ?? 'default';
"#;
    common::parse_code(code, false);
}

#[test]
fn test_spaceship_operator() {
    let code = r#"<?php
$comparison = $a <=> $b;
"#;
    common::parse_code(code, false);
}

#[test]
fn test_power_operator_associativity() {
    let code = r#"<?php
$result = 2 ** 3 ** 2;
"#;
    common::parse_code(code, false);
}

#[test]
fn test_spread_operator_in_array() {
    let code = r#"<?php
$array = [...$arr1, ...$arr2, ...$arr3];
"#;
    common::parse_code(code, false);
}

#[test]
fn test_variable_variables() {
    let code = r#"<?php
$$var = 'value';
$$$nested = 'deep';
"#;
    common::parse_code(code, false);
}

// ============================================================================
// SPECIAL STATEMENTS
// ============================================================================

#[test]
fn test_goto_statement() {
    let code = r#"<?php
goto skip;
echo 'skipped';
skip:
echo 'executed';
"#;
    common::parse_code(code, false);
}

#[test]
fn test_label_definition() {
    let code = r#"<?php
start:
echo 'hello';
goto start;
"#;
    common::parse_code(code, false);
}

#[test]
fn test_halt_compiler() {
    let code = r#"<?php
class Test {}
__halt_compiler();
This is not PHP code
"#;
    common::parse_code(code, false);
}

#[test]
fn test_inline_html_mixed() {
    let code = r#"<?php
echo 'hello';
?>
<html>
<body>
<?php
echo 'world';
?>
</body>
</html>
"#;
    common::parse_code(code, false);
}

// ============================================================================
// ERROR CASES (expect errors to be captured)
// ============================================================================

#[test]
fn test_trait_unqualified_method_as() {
    let code = r#"<?php
trait A {
    public function method() {}
}
class C {
    use A {
        method as renamed;
    }
}
"#;
    // This is valid - unqualified alias
    common::parse_code(code, false);
}

#[test]
fn test_incomplete_declare() {
    let code = r#"<?php
declare(
"#;
    // This should attempt to parse and may have errors
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, code);
    // We don't require success, just that it doesn't crash
    let _json = serde_json::to_string_pretty(&result.program).unwrap();
}

#[test]
fn test_mixed_namespace_styles() {
    let code = r#"<?php
namespace App;
class A {}
namespace App\Sub {
    class B {}
}
"#;
    common::parse_code(code, false);
}
