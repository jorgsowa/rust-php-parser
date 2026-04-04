mod common;
use common::{assert_no_errors, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

fn assert_parses_ok(_label: &str, source: &'static str) {
    let result = parse_php(source);
    assert_no_errors(&result);
}

// =============================================================================
// Fixture file tests
// =============================================================================

macro_rules! fixture_test {
    ($name:ident, $file:expr) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert_no_errors(&result);
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
    ($name:ident, $file:expr, errors) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert!(
                !result.errors.is_empty(),
                "expected parse errors but found none"
            );
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
}

fixture_test!(test_basic, "basic.php");
fixture_test!(test_expressions, "expressions.php");
fixture_test!(test_control_flow, "control_flow.php");
fixture_test!(test_functions, "functions.php");
fixture_test!(test_arrays, "arrays.php");
fixture_test!(test_inline_html, "inline_html.php");
fixture_test!(test_assignment_ops, "assignment_ops.php");
fixture_test!(test_anonymous_classes, "anonymous_classes.php");
fixture_test!(
    test_string_interpolation_fixture,
    "string_interpolation.php"
);
fixture_test!(test_attributes_fixture, "attributes.php");

// =============================================================================
// Error recovery tests
// =============================================================================

#[test]
fn test_error_recovery_partial_parse() {
    let source = include_str!("fixtures/error_recovery.php");
    let result = parse_php(source);

    // Should have at least one error
    assert!(!result.errors.is_empty(), "Expected parse errors");

    // Should still produce a program with some statements
    assert!(
        !result.program.stmts.is_empty(),
        "Expected partial AST even with errors"
    );

    // The valid statements after the error should be parsed
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Expression precedence tests
// =============================================================================

#[test]
fn test_precedence_mul_over_add() {
    let result = parse_php("<?php 1 + 2 * 3;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_precedence_pow_right_assoc() {
    let result = parse_php("<?php 2 ** 3 ** 2;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_precedence_parens() {
    let result = parse_php("<?php (1 + 2) * 3;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_ternary_expr() {
    let result = parse_php("<?php $x > 0 ? 'yes' : 'no';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_short_ternary() {
    let result = parse_php("<?php $x ?: 'default';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_null_coalesce() {
    let result = parse_php("<?php $x ?? $y ?? 'fallback';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_function_call_chain() {
    let result = parse_php("<?php foo(bar(1), 2);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_access_chain() {
    let result = parse_php("<?php $arr[0][1];");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_unary_prefix() {
    let result = parse_php("<?php -$x; !$y; ~$z; ++$a; --$b;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_unary_postfix() {
    let result = parse_php("<?php $x++; $y--;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_print_expr() {
    let result = parse_php("<?php print 'hello';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_logical_keyword_ops() {
    let result = parse_php("<?php $a and $b or $c xor $d;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Statement tests
// =============================================================================

#[test]
fn test_empty_return() {
    let result = parse_php("<?php return;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_echo_multiple() {
    let result = parse_php("<?php echo 1, 2, 3;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_for_loop() {
    let result = parse_php("<?php for ($i = 0; $i < 10; $i++) { echo $i; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_foreach_with_key() {
    let result = parse_php("<?php foreach ($items as $k => $v) { echo $k; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_if() {
    let result = parse_php("<?php if ($a) { if ($b) { echo 1; } }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_function_with_defaults() {
    let result = parse_php("<?php function foo($a, $b = 10, $c = 'x') { return $a + $b; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Literal tests
// =============================================================================

#[test]
fn test_numeric_literals() {
    let result = parse_php("<?php 42; 0xFF; 0b1010; 077; 3.14; 1e10; 2.5e-3;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trailing_dot_float_literals() {
    // PHP: DNUM = LNUM "." — trailing-dot literals must parse as Float, not Int
    let result = parse_php("<?php 0.; 1.; 42.;");
    assert_no_errors(&result);
    let json = to_json(&result.program);
    assert!(
        !json.contains("\"Int\""),
        "trailing-dot literals must not produce Int nodes; got:\n{json}"
    );
    assert!(
        json.contains("\"Float\""),
        "trailing-dot literals must produce Float nodes; got:\n{json}"
    );
}

#[test]
fn test_string_literals() {
    let result = parse_php(r#"<?php 'single'; "double";"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_bool_null_literals() {
    let result = parse_php("<?php true; false; null; TRUE; FALSE; NULL;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Complex programs
// =============================================================================

#[test]
fn test_fibonacci() {
    let source = r#"<?php
function fib($n) {
    if ($n <= 1) {
        return $n;
    }
    return fib($n - 1) + fib($n - 2);
}

$result = fib(10);
echo $result;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_operations() {
    let source = r#"<?php
$data = [1, 2, 3, 4, 5];
$sum = 0;
foreach ($data as $item) {
    $sum = $sum + $item;
}
$map = ['a' => 1, 'b' => 2];
$val = $map['a'];
echo $sum;
echo $val;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 1: Advanced Control Flow
// =============================================================================

#[test]
fn test_do_while() {
    let result = parse_php("<?php do { echo $i; $i++; } while ($i < 10);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_switch_basic() {
    let source = r#"<?php
switch ($x) {
    case 1:
        echo 'one';
        break;
    case 2:
    case 3:
        echo 'two or three';
        break;
    default:
        echo 'other';
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_break_continue_depth() {
    let source = r#"<?php
while (true) {
    while (true) {
        break 2;
        continue 2;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_try_catch_basic() {
    let source = r#"<?php
try {
    $x = riskyOperation();
} catch (Exception $e) {
    echo $e;
} finally {
    cleanup();
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_try_multi_catch() {
    let source = r#"<?php
try {
    process();
} catch (TypeError|ValueError $e) {
    handleTypeError($e);
} catch (RuntimeException) {
    handleRuntime();
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_throw_statement() {
    let result = parse_php("<?php throw new Exception('Something went wrong');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_goto_label() {
    let source = r#"<?php
goto end;
echo 'this is skipped';
end:
echo 'done';
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_alternative_syntax() {
    let source = r#"<?php
if ($x > 0):
    echo 'positive';
elseif ($x < 0):
    echo 'negative';
else:
    echo 'zero';
endif;
while ($i < 5):
    echo $i;
    $i++;
endwhile;
for ($i = 0; $i < 3; $i++):
    echo $i;
endfor;
foreach ($items as $item):
    echo $item;
endforeach;
switch ($color):
    case 'red':
        echo 'red';
        break;
    default:
        echo 'other';
endswitch;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// A `}` inside alternative syntax is not in `ends` so synchronize() stops
// WITHOUT advancing, causing an infinite loop. The span-progress guard in
// parse_stmts_until_end must force-advance past such tokens.
#[test]
fn test_alt_if_unexpected_rbrace_terminates() {
    let result = parse_php("<?php if (true): } endif;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

#[test]
fn test_alt_while_unexpected_rbrace_terminates() {
    let result = parse_php("<?php while (true): } endwhile;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

#[test]
fn test_alt_foreach_unexpected_rbrace_terminates() {
    let result = parse_php("<?php foreach ($a as $b): } endforeach;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
}

// =============================================================================
// Phase 2: OOP Declarations
// =============================================================================

#[test]
fn test_class_basic() {
    let source = r#"<?php
class User {
    public string $name;
    private int $age = 0;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_modifiers() {
    let source = r#"<?php
abstract class Base {
    abstract public function doSomething(): void;
}
final class Sealed {
    public function run(): void {}
}
readonly class Value {
    public function __construct(
        public string $name,
        public int $age,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_extends_implements() {
    let source = r#"<?php
interface Loggable {
    public function log(): void;
}
interface Serializable {
    public function serialize(): string;
}
class User extends Model implements Loggable, Serializable {
    public function log(): void {}
    public function serialize(): string {
        return '';
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_interface() {
    let source = r#"<?php
interface HasId {
    public function getId(): int;
}
interface HasName extends HasId {
    public function getName(): string;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trait() {
    let source = r#"<?php
trait Timestampable {
    public function getCreatedAt(): string {
        return $this->createdAt;
    }
}
class Post {
    use Timestampable;
    public string $title;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_static_and_const() {
    let source = r#"<?php
class Config {
    public const VERSION = '1.0';
    private const DEBUG = false;
    public static int $count = 0;
    public static function increment(): void {
        self::$count++;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_readonly_properties() {
    let source = r#"<?php
class Point {
    public readonly float $x;
    public readonly float $y;
    public function __construct(float $x, float $y) {
        $this->x = $x;
        $this->y = $y;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 3: Object Access Expressions
// =============================================================================

#[test]
fn test_property_access() {
    let result = parse_php("<?php $obj->name; $a->b->c;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_method_call() {
    let result = parse_php("<?php $obj->getName(); $builder->setName('foo')->build();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nullsafe_operator() {
    let result = parse_php("<?php $obj?->address?->city; $obj?->getAddress()?->getCity();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_static_access() {
    let source = r#"<?php
Foo::BAR;
Foo::$instance;
Foo::create();
self::$x;
parent::__construct();
static::factory();
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_new_expression() {
    let result = parse_php("<?php new Foo(); new $className(); new self();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_clone_expression() {
    let result = parse_php("<?php $copy = clone $obj;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_clone_parenthesised() {
    for case in category("clone") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_clone_callable() {
    // covered by test_clone_parenthesised via inline_cases
}

#[test]
fn test_clone_as_function_call() {
    // covered by test_clone_parenthesised via inline_cases
}

#[test]
fn test_instanceof() {
    let result = parse_php("<?php $obj instanceof Foo; $x instanceof Bar || $x instanceof Baz;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_instanceof_dynamic() {
    let source = r#"<?php
$a = $obj instanceof $className;
$b = $obj instanceof self;
$c = $obj instanceof parent;
$d = $obj instanceof static;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 4: Closures, Arrow Functions, Advanced Params
// =============================================================================

#[test]
fn test_closure_basic() {
    let result = parse_php("<?php $f = function(int $x, string $y): int { return $x; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_closure_use() {
    let result = parse_php("<?php $f = function() use ($a, &$b) { return $a + $b; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_static_closure() {
    let result = parse_php("<?php $f = static function() { return 42; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_arrow_function() {
    let result = parse_php("<?php $f = fn(int $x): int => $x * 2;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_static_arrow_function() {
    let result = parse_php("<?php $f = static fn($x) => $x + 1;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_closures_as_arguments() {
    let source = r#"<?php
$filtered = array_filter($items, fn($x) => $x > 0);
$mapped = array_map(function($x) { return $x * 2; }, $items);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_function_type_hints() {
    let source = r#"<?php
function process(?int $x, int|string $y, Countable&Traversable $z): ?string {
    return null;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_variadic_and_byref() {
    let source = r#"<?php
function variadic(int ...$args): int {
    return 0;
}
function byref(&$ref): void {
    $ref = 1;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_named_arguments() {
    let result =
        parse_php("<?php htmlspecialchars(string: $str, flags: ENT_QUOTES, encoding: 'UTF-8');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_spread_operator() {
    let source = r#"<?php
call(...$args);
$merged = [...$a, ...$b, 1, 2];
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 5: Match, Enums, Modern PHP
// =============================================================================

#[test]
fn test_match_expression() {
    let source = r#"<?php
$result = match ($x) {
    'a', 'b' => 'first',
    'c' => 'second',
    default => 'other',
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_match_no_argument() {
    let source = r#"<?php
$result = match (true) {
    $x > 0 => 'positive',
    $x < 0 => 'negative',
    default => 'zero',
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_throw_expression() {
    let source = r#"<?php
$value = $x ?? throw new InvalidArgumentException('Missing value');
$result = match ($status) {
    200 => 'ok',
    default => throw new RuntimeException('Unexpected status'),
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_enum_basic() {
    let source = r#"<?php
enum Color {
    case Red;
    case Green;
    case Blue;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_enum_backed() {
    let source = r#"<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_enum_with_methods() {
    let source = r#"<?php
enum Suit: string implements HasColor {
    case Hearts = 'H';
    case Diamonds = 'D';
    case Clubs = 'C';
    case Spades = 'S';

    const COUNT = 4;

    public function color(): string {
        return match ($this) {
            Suit::Hearts, Suit::Diamonds => 'red',
            Suit::Clubs, Suit::Spades => 'black',
        };
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 6: Namespaces and Module-Level
// =============================================================================

#[test]
fn test_namespace_simple() {
    let source = r#"<?php
namespace App\Models;
class User {}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_namespace_braced() {
    let source = r#"<?php
namespace App\Services {
    class UserService {}
}
namespace App\Models {
    class User {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_use_declarations() {
    let source = r#"<?php
use App\Models\User;
use App\Services\Auth as AuthService;
use function App\Helpers\formatDate;
use const App\Config\VERSION;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_const_declaration() {
    let result = parse_php("<?php const PI = 3.14; const APP_NAME = 'MyApp';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_declare_strict_types() {
    let result = parse_php("<?php declare(strict_types=1);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_global_and_static_var() {
    let source = r#"<?php
function counter() {
    static $count = 0;
    global $logger;
    $count++;
    return $count;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_declare_multiple_directives() {
    let source = "<?php declare(encoding='UTF-8', strict_types=1, ticks=1);";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_declare_in_conditional() {
    let source = "<?php if (true) { declare(strict_types=1); }";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_use_with_multiple_types() {
    let source = "<?php use function A\\foo; use const SOME_CONST; use B\\C;";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_deep_namespace_nesting() {
    let source = "<?php namespace A\\B\\C\\D\\E\\F\\G { class X {} }";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 7: Built-in Expressions
// =============================================================================

#[test]
fn test_cast_expressions() {
    let result =
        parse_php("<?php (int)$x; (float)$y; (string)$z; (bool)$a; (array)$b; (object)$c;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_call_not_confused_with_cast() {
    // `array() === $arr` was failing with ExpectedExpression because the parser
    // consumed `(array` as the start of an `(array)` cast, then couldn't find `)`.
    let result = parse_php("<?php $x = array() === $arr;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_call_in_condition() {
    // The exact pattern from WordPress's compat.php `array_is_list()`.
    let result = parse_php(
        "<?php\nfunction array_is_list($arr) {\n    if ((array() === $arr) || (array_values($arr) === $arr)) {\n        return true;\n    }\n    return false;\n}",
    );
    assert_no_errors(&result);
}

#[test]
fn test_array_cast_still_works() {
    // After the fix, `(array)$x` must still parse as a cast.
    let result = parse_php("<?php $y = (array) $x;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_cast_not_confused_with_array_call() {
    // Both forms in the same file.
    let result = parse_php("<?php $a = (array) $x;\n$b = array() === [];");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_isset_empty() {
    let result = parse_php("<?php isset($a, $b); empty($x);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_include_require() {
    let source = r#"<?php
include 'header.php';
include_once 'config.php';
require 'bootstrap.php';
require_once 'autoload.php';
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_eval_exit() {
    let result = parse_php("<?php eval('echo 1;'); exit; exit(1); die('fatal');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_error_suppress() {
    let result = parse_php("<?php @file_get_contents('missing.txt');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_unset() {
    let result = parse_php("<?php unset($a, $b, $c);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_magic_constants() {
    let result = parse_php("<?php __LINE__; __FILE__; __DIR__; __CLASS__; __FUNCTION__; __METHOD__; __NAMESPACE__; __TRAIT__;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 8: Generators and Composite Programs
// =============================================================================

#[test]
fn test_yield_basic() {
    let source = r#"<?php
function generate() {
    yield 1;
    yield 2;
    yield 3;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_yield_key_value() {
    let source = r#"<?php
function indexedGen() {
    yield 'a' => 1;
    yield 'b' => 2;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_yield_from() {
    let source = r#"<?php
function combined() {
    yield from [1, 2, 3];
    yield from otherGenerator();
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[path = "inline_cases.rs"]
mod inline_cases;

fn category(cat: &'static str) -> impl Iterator<Item = &'static inline_cases::Case> {
    inline_cases::CASES
        .iter()
        .filter(move |c| c.category == cat)
}

#[test]
fn test_yield_from_is_from_flag() {
    // `yield from` must set is_from:true; plain `yield` must set is_from:false
    for case in category("yield_from_flag") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_yield_bare() {
    let source = r#"<?php
function gen() {
    yield;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_yield_as_expression() {
    let source = r#"<?php
function gen() {
    $received = yield 'value';
    $received = yield $key => $value;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

fixture_test!(test_realistic_controller, "realistic_controller.php");
fixture_test!(test_realistic_enum_service, "realistic_enum_service.php");

// =============================================================================
// Phase 9: Name Resolution & Qualified Names
// =============================================================================

#[test]
fn test_fully_qualified_names() {
    let source = r#"<?php
$e = new \Exception('error');
\App\Services\Logger::log('msg');
$x = \strlen('hello');
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_qualified_names() {
    let source = r#"<?php
$user = new App\Models\User();
App\Helpers\format($data);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_name_resolution() {
    let result = parse_php("<?php Foo::class; self::class; static::class;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_relative_namespace_names() {
    let source = r#"<?php
namespace App\Services;
$obj = new namespace\MyClass();
namespace\helper_func();
echo namespace\SOME_CONST;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 10: Destructuring & List Assignment
// =============================================================================

#[test]
fn test_list_destructuring() {
    let source = r#"<?php
list($a, $b, $c) = getValues();
list($x, , $z) = $array;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_destructuring() {
    let source = r#"<?php
[$a, $b] = $pair;
[$first, , $third] = $arr;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_list_destructuring() {
    let source = r#"<?php
list($a, [[$b, $c]]) = [[1, [2, 3]]];
[$x, [$y, $z]] = $data;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_list_with_string_keys() {
    let source = r#"<?php
list('name' => $name, 'age' => $age) = $person;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 11: Array Edge Cases
// =============================================================================

#[test]
fn test_array_old_syntax() {
    let result = parse_php("<?php array(1, 2, 3); array('a' => 1, 'b' => 2);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_empty_array() {
    let result = parse_php("<?php []; array();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_arrays() {
    let result = parse_php("<?php [[1, 2], [3, 4]]; ['a' => ['x' => 1], 'b' => ['y' => 2]];");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trailing_commas() {
    let source = r#"<?php
$arr = [1, 2, 3,];
foo($a, $b, $c,);
function bar($x, $y,) {}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_push_syntax() {
    let result = parse_php("<?php $arr[] = 'new'; $matrix[][] = 1;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_array_spread_with_keys() {
    let source = r#"<?php
$numbers = [1, 2, 3];
$expanded = [...$numbers, 4, 5];
$combined = ['a' => 1, ...$other, 'b' => 2];
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_array_spread() {
    let source = r#"<?php
$arrays = [[1, 2], [3, 4]];
$flat = [...$arrays[0], ...$arrays[1], 5];
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 12: Dynamic Access & Complex Chains
// =============================================================================

#[test]
fn test_dynamic_property_access() {
    let result = parse_php("<?php $obj->$prop; $obj->{$name . 'Suffix'};");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_dynamic_method_call() {
    let result = parse_php("<?php $obj->$method(); $obj->{'get' . $field}();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_variable_variables() {
    let source = r#"<?php
$$var = 1;
echo $$name;
$$$deep = 2;
${$expr} = 3;
${$a . $b} = 4;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_first_class_callable() {
    let source = r#"<?php
$fn = strlen(...);
$fn = $obj->method(...);
$fn = Foo::bar(...);
$fn = $obj?->method(...);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_chained_method_array_access() {
    let result = parse_php("<?php $obj->getItems()[0]->name; $a->b()['key']->c();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nullsafe_chain() {
    let result = parse_php("<?php $a?->b?->c()?->d?->e;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_new_without_parens() {
    let result = parse_php("<?php $obj = new Foo; $bar = new Bar\\Baz;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 13: Control Flow Edge Cases
// =============================================================================

#[test]
fn test_for_empty_parts() {
    let result = parse_php("<?php for (;;) { break; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_for_multiple_expressions() {
    let result = parse_php("<?php for ($i = 0, $j = 10; $i < $j; $i++, $j--) { echo $i; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_foreach_by_reference() {
    let result = parse_php("<?php foreach ($items as &$item) { $item *= 2; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_try_catch() {
    let source = r#"<?php
try {
    try {
        dangerousOp();
    } catch (InnerException $e) {
        log($e);
        throw $e;
    }
} catch (OuterException $e) {
    handleOuter($e);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nop_statement() {
    let result = parse_php("<?php ;;;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_declare_block() {
    let source = r#"<?php
declare(ticks=1) {
    echo 'tick';
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_declare_encoding() {
    for case in category("declare") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_chained_elseif() {
    let source = r#"<?php
if ($x === 1) {
    echo 'one';
} elseif ($x === 2) {
    echo 'two';
} elseif ($x === 3) {
    echo 'three';
} elseif ($x === 4) {
    echo 'four';
} else {
    echo 'other';
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_blockless_statements() {
    let source = r#"<?php
if ($a) $A;
elseif ($b) $B;
else $C;
for (;;) $foo;
foreach ($a as $b) $AB;
while ($a) $A;
do $A; while ($a);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_new_in_initializers() {
    let source = r#"<?php
function foo($x = new Foo(), $y = new Bar(1, 2)) {}

class MyClass {
    public $prop = new DefaultObj();
    const C = new Config();

    public function method($p = new Param()) {}
}

function baz() {
    static $cache = new Cache();
}

#[Attr(new Foo())]
function qux() {}

$f = function ($x = new Foo()) {};
$g = fn($x = new Foo()) => $x;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 14: Expression Edge Cases
// =============================================================================

#[test]
fn test_assignment_chain() {
    let result = parse_php("<?php $a = $b = $c = 42;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_by_reference_assign() {
    let result = parse_php("<?php $a = &$b;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_compound_assign_targets() {
    let result = parse_php("<?php $arr[0] += 5; $obj->count -= 1; $data['key'] .= 'suffix';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_function_calls() {
    let result = parse_php("<?php implode(', ', array_map('strtoupper', explode(' ', $str)));");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_ternary() {
    let result = parse_php("<?php $x > 0 ? 'pos' : ($x < 0 ? 'neg' : 'zero');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_complex_precedence() {
    let result = parse_php("<?php $a + $b * $c ** $d > $e && $f || $g & $h << 2;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_negative_array_index() {
    let result = parse_php("<?php $arr[-1]; $arr[-2] = 'last';");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_print_returns_value() {
    let result = parse_php("<?php $x = print 'hello'; if (print 'check') {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_parenthesized_assign() {
    let result = parse_php("<?php ($x = getValue())->process();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 15: Function & Closure Edge Cases
// =============================================================================

#[test]
fn test_by_reference_function() {
    let source = r#"<?php
function &getRef() {
    static $val = 0;
    return $val;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_closures() {
    let source = r#"<?php
$outer = function($x) {
    $inner = function($y) use ($x) {
        return $x + $y;
    };
    return $inner;
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_closure_by_ref_return() {
    let result = parse_php("<?php $f = function &() { static $x = 0; return $x; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_immediately_invoked_closure() {
    let result = parse_php("<?php (function() { echo 'hi'; })();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_arrow_function_complex_body() {
    let result = parse_php("<?php $f = fn($x, $y) => $x > $y ? $x - $y : $y - $x;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_mixed_named_positional_args() {
    let result = parse_php("<?php foo(1, 'bar', name: $val, count: 5);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 16: OOP Edge Cases
// =============================================================================

#[test]
fn test_final_readonly_class() {
    let source = r#"<?php
final readonly class Money {
    public function __construct(
        public int $amount,
        public string $currency,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_readonly_final_class() {
    // `readonly final class` — modifier order reversed from `final readonly class`
    for case in category("readonly_class") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_abstract_and_final_methods() {
    let source = r#"<?php
abstract class Base {
    abstract protected function template(): string;
    final public function execute(): void {
        echo $this->template();
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_multiple_trait_use() {
    let source = r#"<?php
class Service {
    use Loggable, Cacheable, Serializable;
    public function run(): void {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_class_all_member_types() {
    let source = r#"<?php
class Complete {
    use SomeTrait;

    public const MAX = 100;
    protected const MIN = 0;

    public string $name;
    protected int $age = 0;
    private static array $instances = [];
    public readonly string $id;

    public function __construct(string $name, public readonly int $score) {
        $this->name = $name;
    }

    public static function create(): self {
        return new self('default');
    }

    abstract protected function validate(): bool;

    final public function getId(): string {
        return $this->id;
    }
}
"#;
    // abstract method in non-abstract class is semantically wrong but syntactically valid
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_interface_multiple_extends() {
    let source = r#"<?php
interface ReadWrite extends Readable, Writable {
    public function flush(): void;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_enum_with_trait() {
    let source = r#"<?php
enum Direction implements HasLabel {
    use LabelTrait;
    case North;
    case South;
    case East;
    case West;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_keywords_as_method_names() {
    let source = r#"<?php
class Foo {
    public function list(): array { return []; }
    public function match(): void {}
    public function class(): string { return ''; }
    public function switch(): void {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trait_multiple_insteadof() {
    let source = r#"<?php
trait T1 { public function m() {} }
trait T2 { public function m() {} }
trait T3 { public function m() {} }
class C {
    use T1, T2, T3 {
        T1::m insteadof T2, T3;
        T2::m insteadof T3;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trait_multiple_alias_and_precedence() {
    let source = r#"<?php
trait A { public function foo() {} }
trait B { public function foo() {} public function bar() {} }
class C {
    use A, B {
        B::foo insteadof A;
        A::foo as private afoo;
        B::bar as public bbar;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 17: Namespace & Module Edge Cases
// =============================================================================

#[test]
fn test_global_namespace_braced() {
    let source = r#"<?php
namespace {
    function globalFunc() {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_multiple_use_items() {
    let result = parse_php("<?php use App\\Models\\User, App\\Models\\Post, App\\Models\\Comment;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_multiple_const_items() {
    let result = parse_php("<?php const A = 1, B = 2, C = 3;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_multiple_static_vars() {
    let source = r#"<?php
function foo() {
    static $a = 0, $b = 'init', $c = [];
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_multiple_global_vars() {
    let source = r#"<?php
function foo() {
    global $db, $config, $logger;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 18: Match Edge Cases
// =============================================================================

#[test]
fn test_nested_match() {
    let source = r#"<?php
$result = match ($type) {
    'a' => match ($subtype) {
        'x' => 1,
        'y' => 2,
        default => 0,
    },
    'b' => 10,
    default => -1,
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_match_single_default() {
    let result = parse_php("<?php $x = match (true) { default => 'always' };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_match_with_function_calls() {
    let source = r#"<?php
$label = match (getStatus()) {
    isActive() => 'active',
    isPending() => 'pending',
    default => throw new LogicException('Unknown'),
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 19: Cast & Built-in Edge Cases
// =============================================================================

#[test]
fn test_cast_unset() {
    // (unset) cast was removed in PHP 8.0
    assert_has_errors("<?php (unset)$x;");
}

#[test]
fn test_cast_void() {
    for case in category("cast_void") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_magic_property_constant() {
    let result = parse_php("<?php __PROPERTY__;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_exit_variants() {
    let result = parse_php("<?php exit; exit(); exit(0); die; die(); die('error');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_error_suppress_nested() {
    let result = parse_php("<?php @$obj->riskyMethod(@$nested);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_error_suppress_complex() {
    for case in category("error_suppress") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_isset_complex() {
    let result = parse_php("<?php isset($a['key'], $b->prop, $c::$static);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 21: Type Hint Edge Cases
// =============================================================================

#[test]
fn test_void_return_type() {
    let result = parse_php("<?php function noop(): void {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_mixed_type() {
    let result = parse_php("<?php function anything(mixed $x): mixed { return $x; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nullable_types_various() {
    let source = r#"<?php
function process(?string $name, ?int $count, ?array $items): ?bool {
    return null;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_union_type_with_null() {
    let result = parse_php("<?php function foo(int|string|null $x): string|false { return ''; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_self_parent_static_types() {
    let source = r#"<?php
class Builder {
    public function setName(string $name): self { return $this; }
    public static function create(): static { return new static(); }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_dnf_types() {
    let source = r#"<?php
function foo((A&B)|C $x): (X&Y)|Z {
    return $x;
}
function bar((A&B)|(C&D) $y): (E&F)|null {
    return $y;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_complex_union_and_intersection_types() {
    let source = r#"<?php
function processData(Countable&ArrayAccess $data): array|null {
    return null;
}
class Container {
    public function __construct(
        public readonly Countable&Iterator $items,
        private string|int|float $value
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_by_reference_return_type() {
    let source = r#"<?php
function &getValue(): string {
    return $GLOBALS['value'];
}
function &getReference(array &$arr): mixed {
    return $arr[0];
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 22: Error Recovery
// =============================================================================

#[test]
fn test_error_recovery_missing_semicolon() {
    let result = parse_php("<?php $x = 1 $y = 2;");
    // Should have errors but still parse something
    assert!(!result.errors.is_empty());
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_error_recovery_missing_closing_paren() {
    let result = parse_php("<?php foo(1, 2; $x = 3;");
    assert!(!result.errors.is_empty());
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_error_recovery_invalid_expression() {
    let result = parse_php("<?php + ; $x = 1;");
    assert!(!result.errors.is_empty());
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 23: Composite Fixture Tests
// =============================================================================

fixture_test!(test_realistic_repository, "realistic_repository.php");
fixture_test!(test_realistic_middleware, "realistic_middleware.php");

// =============================================================================
// String Interpolation
// =============================================================================

fixture_test!(test_string_interpolation, "string_interpolation.php");

#[test]
fn test_simple_interpolation() {
    let result = parse_php(r#"<?php echo "Hello $name";"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_complex_interpolation() {
    let result = parse_php(r#"<?php echo "Value: {$obj->getName()}";"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_escaped_dollar_no_interpolation() {
    let result = parse_php(r#"<?php echo "Price: \$100";"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_double_quoted_escape_sequences() {
    let result = parse_php(r#"<?php echo "line1\nline2\ttab";"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Heredoc/Nowdoc
// =============================================================================

fixture_test!(test_heredoc_nowdoc, "heredoc_nowdoc.php");

#[test]
fn test_basic_heredoc() {
    let result = parse_php("<?php $x = <<<EOT\nHello World\nEOT;\n");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_heredoc_with_interpolation() {
    let result = parse_php("<?php $x = <<<EOT\nHello $name!\nEOT;\n");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nowdoc() {
    let result = parse_php("<?php $x = <<<'EOT'\nHello $name!\nEOT;\n");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// PHP 8 Attributes
// =============================================================================

fixture_test!(test_attributes, "attributes.php");

#[test]
fn test_single_attribute() {
    let result = parse_php("<?php #[Pure] function foo() {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_with_args() {
    let result = parse_php(r#"<?php #[Route("/api")] function foo() {}"#);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_grouped_attributes() {
    let result = parse_php("<?php #[A, B] class Foo {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_stacked_attributes() {
    let result = parse_php("<?php #[A] #[B] class Foo {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_on_param() {
    let result = parse_php("<?php function f(#[FromQuery] string $name) {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_hash_comment_still_works() {
    let result = parse_php("<?php # This is a comment\n$x = 1;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Error Messages
// =============================================================================

#[test]
fn test_error_missing_semicolon_after_expression() {
    let result = parse_php("<?php $x = 1\n$y = 2;");
    assert!(!result.errors.is_empty());
    let err = &result.errors[0];
    assert!(
        format!("{}", err).contains("after"),
        "Expected contextual error message with 'after', got: {}",
        err
    );
}

#[test]
fn test_error_unclosed_paren() {
    let result = parse_php("<?php ($x + $y;");
    assert!(!result.errors.is_empty());
    let err = &result.errors[0];
    assert!(
        format!("{}", err).contains("unclosed") || format!("{}", err).contains("Unclosed"),
        "Expected unclosed delimiter error, got: {}",
        err
    );
}

#[test]
fn test_error_unclosed_brace() {
    let result = parse_php("<?php function foo() { $x = 1;");
    assert!(!result.errors.is_empty());
    let has_unclosed = result.errors.iter().any(|e| {
        let msg = format!("{}", e);
        msg.contains("unclosed") || msg.contains("Unclosed")
    });
    assert!(
        has_unclosed,
        "Expected unclosed delimiter error, got: {:?}",
        result.errors
    );
}

#[test]
fn test_trait_conflict_resolution() {
    let source = r#"<?php
class MyClass {
    use A, B {
        A::foo insteadof B;
        B::foo as baz;
        foo as bar;
        foo as protected;
        A::hello as private hi;
        A::big insteadof B, C;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Literals
// =============================================================================

#[test]
fn test_numeric_underscores() {
    let source = r#"<?php
$a = 1_000_000;
$b = 0xFF_FF;
$c = 0b1010_0101;
$d = 0o77_77;
$e = 1_000.50;
$f = 1_0e1_0;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_magic_constants_in_echo() {
    for case in category("magic_constants") {
        assert_parses_ok(case.label, case.source);
    }
}

// =============================================================================
// Strings & Heredoc
// =============================================================================

#[test]
fn test_string_interpolation_patterns() {
    for case in category("string_interpolation") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_binary_string_prefix() {
    let source = r#"<?php
$a = b"binary string";
$b = b'binary single';
$c = B"case insensitive";
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_heredoc_complex_interpolation() {
    let source = "<?php\n$x = <<<EOT\nHello {$obj->getName()}\nItem: {$arr[0]['key']}\nCalc: {$a + $b}\nEOT;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nowdoc_multiline() {
    let source = "<?php\n$x = <<<'EOT'\nNo $interpolation\nJust literal text\nWith 'quotes' and \"doubles\"\nEOT;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_heredoc_nowdoc_variants() {
    for case in category("heredoc") {
        assert_parses_ok(case.label, case.source);
    }
}

// =============================================================================
// Operators & Expressions
// =============================================================================

#[test]
fn test_operator_precedence_combinations() {
    for case in category("operator_precedence") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_assignment_patterns() {
    for case in category("assignment") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_expression_chains() {
    for case in category("expression_chains") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_dynamic_access() {
    for case in category("dynamic_access") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_shell_exec() {
    let source = r#"<?php
$out = `ls -la`;
$cmd = `echo $var`;
$complex = `{$obj->getCmd()} --flag`;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_dynamic_class_constant_access() {
    let source = r#"<?php
$a = Foo::{$name};
$b = Foo::{'CONST_' . $suffix};
$c = $class::$$dynamic;
$d = $class::${'prop_' . $name};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_pipe_operator_precedence() {
    let source = r#"<?php
$x = $a |> $b |> $c;
$y = $a + $b |> $c;
$z = $a |> $b + $c;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_complex_ternary_coalesce() {
    let source = r#"<?php
$a = $x ?: $y ?? $z;
$b = $x ?? $y ?: $z;
$c = $a ? $b ? $c : $d : $e;
$d = ($a ?? $b) ? ($c ?: $d) : ($e ?? $f);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_variable_variables_complex() {
    let source = r#"<?php
$$var = 1;
$$$var = 2;
${$a . $b} = 3;
echo $$obj->prop;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_trailing_commas_everywhere() {
    let source = r#"<?php
function foo($a, $b,) {}
foo(1, 2,);
$f = function($x,) use ($y,) {};
$g = fn($x,) => $x;
[$a, $b,] = $arr;
match ($x) { 1 => 'a', 2 => 'b', };
use App\{A, B,};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Destructuring
// =============================================================================

#[test]
fn test_nested_destructuring() {
    for case in category("destructuring") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_complex_destructuring() {
    let source = r#"<?php
[, , $third] = $arr;
[[$a, $b], [$c, $d]] = $matrix;
['name' => $name, 'address' => ['city' => $city]] = $data;
[1 => $second, 0 => $first] = $arr;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Control Flow
// =============================================================================

#[test]
fn test_alternative_syntax_variants() {
    for case in category("alternative_syntax") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_control_flow_variants() {
    for case in category("control_flow") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_try_catch_variants() {
    for case in category("try_catch") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_multiple_catch_types() {
    let source = r#"<?php
try {
    foo();
} catch (TypeError | ValueError | RuntimeException $e) {
    handle($e);
} catch (LogicException $e) {
    other($e);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_match_variants() {
    for case in category("match") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_match_with_throw_expressions() {
    let source = r#"<?php
$x = match ($status) {
    200 => 'ok',
    404 => throw new NotFoundException(),
    default => throw new RuntimeException('Unexpected'),
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nested_match_expressions() {
    let source = r#"<?php
$result = match ($type) {
    'a' => match ($subtype) {
        1 => 'a1',
        2 => 'a2',
        default => 'a_other',
    },
    'b' => 'b',
    default => 'other',
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Functions & Closures
// =============================================================================

#[test]
fn test_function_variants() {
    for case in category("function") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_named_args_keywords() {
    let source = r#"<?php
array_slice(array: $arr, offset: 1, length: 2);
foo(class: 'MyClass', static: true, match: 'yes');
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_named_args_variants() {
    for case in category("named_args") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_closure_variants() {
    for case in category("closure") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_nested_arrow_functions() {
    let source = r#"<?php
$f = fn($x) => fn($y) => fn($z) => $x + $y + $z;
$g = fn($a) => $a > 0 ? fn($b) => $b * 2 : fn($b) => $b * -1;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_arrow_function_in_array() {
    for case in category("arrow_function") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_named_args_edge_cases() {
    let source = r#"<?php
foo(a: 1, b: 2, c: 3);
bar(...$args, extra: true);
baz(1, 2, name: 'test');
array_map(callback: fn($x) => $x * 2, array: $arr);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_first_class_callable_variants() {
    let source = r#"<?php
$a = strlen(...);
$b = $obj->method(...);
$c = $obj?->method(...);
$d = Foo::bar(...);
$e = $obj->$dynamic(...);
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_generator_variants() {
    for case in category("generator") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_yield_complex() {
    let source = r#"<?php
function gen() {
    $a = yield;
    $b = yield 'value';
    $c = yield 'key' => 'value';
    yield from otherGen();
    $d = (yield 'x') + 1;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// OOP
// =============================================================================

#[test]
fn test_class_variants() {
    for case in category("class") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_enum_variants() {
    for case in category("enum") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_enum_with_keyword_methods() {
    let source = r#"<?php
enum Status {
    case Active;
    case Inactive;

    public function list(): array { return []; }
    public function match(): string { return ''; }
    public function switch(): void {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_property_hooks_complex() {
    let source = r#"<?php
class Foo {
    public string $name {
        get => strtoupper($this->name);
        set(string $value) => strtolower($value);
    }
    public int $count {
        get { return $this->count; }
        set { $this->count = max(0, $value); }
    }
    public int $id {
        &get { return $this->id; }
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_property_hooks_modifiers_and_attributes() {
    let source = r#"<?php
abstract class Foo {
    abstract public int $abstract_prop {
        get;
        set;
    }
    public int $final_prop {
        final get { return 42; }
        final set(int $value) { $this->final_prop = $value; }
    }
    public int $attr_prop {
        #[Cache]
        get { return $this->compute(); }
        #[Validate]
        set(int $value) { $this->attr_prop = $value; }
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_constructor_promotion_with_hooks() {
    let source = r#"<?php
class Point {
    public function __construct(
        public readonly int $x,
        public private(set) int $y,
        protected int $z = 0,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_asymmetric_visibility() {
    let source = r#"<?php
class User {
    public protected(set) string $name;
    public private(set) int $age;
    protected private(set) string $email = '';
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_readonly_promoted_properties() {
    let source = r#"<?php
readonly class Point {
    public function __construct(
        public int $x,
        public int $y,
        public int $z = 0,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_readonly_anonymous_class_with_promotion() {
    let source = r#"<?php
$obj = new readonly class(1, 2) {
    public function __construct(
        public int $x,
        public int $y,
    ) {}
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_new_in_complex_initializers() {
    let source = r#"<?php
function foo(
    $a = new Foo(),
    $b = new Bar(1, 'test'),
    $c = new Baz(name: 'x'),
) {}
class Config {
    const DEFAULT = new Settings(debug: false);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_chained_nullsafe_with_calls() {
    let source = r#"<?php
$x = $a?->b?->c?->d;
$y = $a?->getB()?->getC(1, 2)?->value;
$z = $a?->items[0]?->name;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_static_method_callable_and_access() {
    let source = r#"<?php
$a = Foo::bar(...);
$b = Foo::$prop;
$c = Foo::CONST;
$d = static::method();
$e = parent::method();
$f = self::$prop;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_scope_resolution() {
    for case in category("scope_resolution") {
        assert_parses_ok(case.label, case.source);
    }
}

// =============================================================================
// Type Hints
// =============================================================================

#[test]
fn test_type_hint_variants() {
    for case in category("type_hints") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_dnf_types_complex() {
    let source = r#"<?php
function f((A&B)|C|null $x): (X&Y)|(P&Q)|null {
    return $x;
}
class Foo {
    public (A&B)|C $prop;
    public function bar((A&B)|(C&D) $a, E|null $b): (F&G)|null {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Attributes
// =============================================================================

#[test]
fn test_attribute_variants() {
    // Known limitation: attributes on closure expressions (#[Pure] function() {}) not yet supported
    for case in category("attributes") {
        assert_parses_ok(case.label, case.source);
    }
}

// =============================================================================
// Namespaces & Use
// =============================================================================

#[test]
fn test_group_use() {
    let source = r#"<?php
use App\{Models\User, Services\Auth};
use function App\Helpers\{format, validate};
use const App\Config\{DB_HOST, DB_PORT};
use App\{Models\User as U, Services\Auth as A};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_mixed_group_use_with_aliases() {
    let source = r#"<?php
use A\B\{C as D, function e as f, const G as H};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_empty_group_use() {
    // Empty group use is invalid PHP
    assert_has_errors("<?php use A\\B\\{};");
}

#[test]
fn test_group_use_single() {
    let result = parse_php("<?php use A\\B\\{C};");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Close Tags, Inline HTML and Comments
// =============================================================================

#[test]
fn test_close_tag_semicolon() {
    let result = parse_php("<?= $value ?>");
    assert_no_errors(&result);
    insta::assert_snapshot!("short_echo", to_json(&result.program));

    let result2 = parse_php("<?php echo 1 ?><html><?php echo 2 ?>");
    assert_no_errors(&result2);
    insta::assert_snapshot!("close_tag_terminates", to_json(&result2.program));
}

#[test]
fn test_builtin_constructs() {
    for case in category("builtins") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_string_interp_edge_cases() {
    for case in category("string_interp_edge") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_trait_use_adaptations() {
    for case in category("trait_use") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_numeric_literals_variants() {
    for case in category("numeric_literals") {
        assert_parses_ok(case.label, case.source);
    }
}

#[test]
fn test_slash_comment_terminated_by_close_tag() {
    // `// comment ?>` must produce a CloseTag so the HTML is InlineHtml, not garbage.
    let result = parse_php("<?php // comment ?>\n<div>html</div>\n<?php $x = 1;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_hash_comment_terminated_by_close_tag() {
    // `# comment ?>` must produce a CloseTag.
    let result = parse_php("<?php # comment ?>\n<span>html</span>\n<?php $x = 1;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_slash_comment_newline_termination_still_works() {
    // Ensure `//` still stops at `\n` in the normal case.
    let result = parse_php("<?php // comment\n$x = 1;");
    assert_no_errors(&result);
}

#[test]
fn test_alt_while_inline_html_terminates() {
    // synchronize() must not consume endwhile when InlineHtml/OpenTag tokens
    // appear in a `while (true):` block before the terminator.
    let result = parse_php("<?php while (true): ?> HTML <?php endwhile; ?>");
    assert!(
        result.errors.is_empty(),
        "Unexpected parse errors: {:?}",
        result.errors
    );
}

#[test]
fn test_alt_if_inline_html_terminates() {
    let result = parse_php("<?php if (true): ?> HTML <?php endif; ?>");
    assert!(
        result.errors.is_empty(),
        "Unexpected parse errors: {:?}",
        result.errors
    );
}

#[test]
fn test_alt_foreach_inline_html_terminates() {
    let result = parse_php("<?php foreach ($a as $b): ?> HTML <?php endforeach; ?>");
    assert!(
        result.errors.is_empty(),
        "Unexpected parse errors: {:?}",
        result.errors
    );
}

#[test]
fn test_inline_html_in_function_body() {
    let result = parse_php(
        "<?php\nfunction tmpl() {\n    $x = foo();\n    ?>\n<div>html</div>\n<?php\n    bar();\n}",
    );
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_inline_html_in_if_block() {
    let result = parse_php("<?php\nif ($cond) {\n    ?><p>html</p><?php\n    $x = 1;\n}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_inline_html_comment_in_function_body() {
    // The WordPress pattern: `?>` inside a `//` comment was swallowed by the
    // lexer, and the HTML that followed produced ExpectedExpression errors.
    let result = parse_php(
        "<?php\nfunction tmpl() {\n    foo();\n    ?>\n<div>\n<?php // comment ?>\n    <p>text</p>\n<?php\n    bar();\n}",
    );
    assert_no_errors(&result);
}

#[test]
fn test_inline_html_multiple_segments_in_function() {
    // Multiple inline-HTML segments inside a single function body.
    let result = parse_php(
        "<?php\nfunction page() {\n    header();\n    ?><header><?php\n    nav();\n    ?></header><?php\n    body();\n}",
    );
    assert_no_errors(&result);
}

// =============================================================================
// Keyword-as-identifier tests
// =============================================================================

#[test]
fn test_keyword_as_function_name() {
    // These test parser tolerance: PHP itself rejects most of these, but our
    // parser handles them gracefully without panicking.
    assert_parses_ok("function readonly", "<?php function readonly() {}");
    assert_parses_ok(
        "function exit",
        "<?php function exit(string|int $status = 0): never {}",
    );
    assert_parses_ok(
        "function die",
        "<?php function die(string|int $status = 0): never {}",
    );
    assert_parses_ok(
        "function clone",
        "<?php function clone(object $object): object {}",
    );
    assert_parses_ok("function match", "<?php function match() {}");
    assert_parses_ok("function fn", "<?php function fn() {}");
}

#[test]
fn test_keyword_as_enum_case() {
    // Keywords can be used as enum case names (except `class` which is reserved)
    let result = parse_php("<?php enum Suit { case for; case function; case match; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_enum_case_class_reserved() {
    // `class` cannot be used as enum case name
    assert_has_errors("<?php enum Suit { case class; }");
}

// =============================================================================
// var property modifier (PHP4 style)
// =============================================================================

#[test]
fn test_var_property_modifier() {
    let result = parse_php("<?php class A { var $foo; var $bar = 42; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Multi-property declarations
// =============================================================================

#[test]
fn test_multi_property_declaration() {
    let result = parse_php("<?php class A { public $a = 1, $b = 2, $c; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Typed class constants
// =============================================================================

#[test]
fn test_typed_class_constants() {
    let result = parse_php("<?php class A { const int X = 1; private const string Y = 'a'; const Foo|Bar|null Z = null; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_typed_class_constants_variants() {
    for case in category("typed_class_constants") {
        assert_parses_ok(case.label, case.source);
    }
}

// =============================================================================
// readonly expressions and anonymous class
// =============================================================================

#[test]
fn test_readonly_as_function_call() {
    let result = parse_php("<?php function readonly() {} readonly();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_new_readonly_anonymous_class() {
    let result = parse_php("<?php new readonly class {};");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Error validation tests
// =============================================================================

fn assert_has_errors(source: &'static str) {
    let result = parse_php(source);
    assert!(
        !result.errors.is_empty(),
        "Expected parse errors for: {source}"
    );
}

#[test]
fn test_abstract_final_conflict() {
    assert_has_errors("<?php class A { abstract final function a(); }");
}

#[test]
fn test_static_const_error() {
    assert_has_errors("<?php class A { static const X = 1; }");
}

#[test]
fn test_abstract_const_error() {
    assert_has_errors("<?php class A { abstract const X = 1; }");
}

#[test]
fn test_readonly_const_error() {
    assert_has_errors("<?php class A { readonly const X = 1; }");
}

#[test]
fn test_reserved_class_names() {
    assert_has_errors("<?php class self {}");
    assert_has_errors("<?php class parent {}");
    assert_has_errors("<?php class static {}");
    assert_has_errors("<?php class readonly {}");
}

#[test]
fn test_reserved_names_in_extends() {
    assert_has_errors("<?php class A extends self {}");
    assert_has_errors("<?php class A extends parent {}");
    assert_has_errors("<?php class A extends static {}");
}

#[test]
fn test_reserved_names_in_implements() {
    assert_has_errors("<?php class A implements self {}");
    assert_has_errors("<?php class A implements parent {}");
    assert_has_errors("<?php class A implements static {}");
}

#[test]
fn test_halt_compiler_close_tag() {
    let result = parse_php("<?php __halt_compiler() ?> raw data");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_halt_compiler_nested_error() {
    assert_has_errors("<?php if (true) { __halt_compiler(); }");
}

#[test]
fn test_duplicate_modifier_errors() {
    assert_has_errors("<?php class A { public public $x; }");
    assert_has_errors("<?php class A { public protected $x; }");
    assert_has_errors("<?php class A { static static $x; }");
    assert_has_errors("<?php class A { abstract abstract function f(); }");
    assert_has_errors("<?php class A { final final function f() {} }");
    assert_has_errors("<?php class A { readonly readonly $x; }");
    assert_has_errors("<?php class A { public public const X = 1; }");
}

// =============================================================================
// No-hang regression tests
// =============================================================================
// Ensure the parser always terminates on malformed input. Each test exercises
// the progress guard in a different parse_stmt loop.

#[test]
fn test_no_hang_constructor_final_param() {
    let _ = parse_php("<?php class P { public function __construct(final $i) {} }");
}

#[test]
fn test_no_hang_block() {
    let _ = parse_php("<?php if (true) { ?> <?php }");
}

#[test]
fn test_no_hang_function_body() {
    let _ = parse_php("<?php function f() { ?> <?php }");
}

#[test]
fn test_no_hang_method_body() {
    let _ = parse_php("<?php class A { function f() { ?> <?php } }");
}

#[test]
fn test_no_hang_try_body() {
    let _ = parse_php("<?php try { ?> <?php } catch (Exception $e) {}");
}

#[test]
fn test_no_hang_catch_body() {
    let _ = parse_php("<?php try {} catch (Exception $e) { ?> <?php }");
}

#[test]
fn test_no_hang_finally_body() {
    let _ = parse_php("<?php try {} finally { ?> <?php }");
}

#[test]
fn test_no_hang_closure_body() {
    let _ = parse_php("<?php $f = function() { ?> <?php };");
}

#[test]
fn test_no_hang_namespace_braced() {
    let _ = parse_php("<?php namespace Foo { ?> <?php }");
}

#[test]
fn test_no_hang_namespace_global_braced() {
    let _ = parse_php("<?php namespace { ?> <?php }");
}

#[test]
fn test_no_hang_enum_method_body() {
    let _ = parse_php("<?php enum E { case A; public function f() { ?> <?php } }");
}

#[test]
fn test_no_hang_property_hook_body() {
    let _ = parse_php("<?php class A { public string $x { get { ?> <?php } } }");
}

// =============================================================================
// Invalid syntax / error recovery tests
// =============================================================================

#[test]
fn test_invalid_missing_semicolons() {
    let result = parse_php("<?php\necho \"hello\"\necho \"world\";\n$x = 1 + 2");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_missing_closing_paren_if() {
    let result = parse_php("<?php\nif ($x > 1 {\n    echo \"hello\";\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_missing_closing_paren_function() {
    let result = parse_php("<?php\nfunction foo(int $a, $b {\n    return $a + $b;\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_unclosed_array() {
    let result = parse_php("<?php\n$x = [1, 2, 3;\n$y = 4;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_double_operator() {
    let result = parse_php("<?php\n$a = 1 + * 2;\n$b = 3;");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_unclosed_try() {
    let result = parse_php("<?php\ntry {\n    foo();\n\ncatch (Exception $e) {\n    bar();\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_foreach_missing_as() {
    let result = parse_php("<?php\nforeach ($items $item) {\n    echo $item;\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_eof_unclosed_class() {
    let result = parse_php("<?php\nclass Foo {\n    public function bar() {");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_eof_unclosed_array_call() {
    let result = parse_php("<?php\n$x = array(1, 2,");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_eof_unclosed_if() {
    let result = parse_php("<?php\nif ($x > 1) {\n    echo \"hello\";");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_switch_missing_colon() {
    let result = parse_php("<?php\nswitch ($x) {\n    case 1\n        echo \"one\";\n        break;\n    case 2:\n        echo \"two\";\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_missing_closing_brace_method() {
    let result = parse_php("<?php\nclass Foo {\n    public function bar()\n    {\n        return 1;\n\n    public function baz()\n    {\n        return 2;\n    }\n}");
    assert!(!result.errors.is_empty(), "Expected parse errors");
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Closures, Arrow Functions & Callables: Edge Cases
// =============================================================================

// By-reference closure with return type
#[test]
fn test_byref_closure_with_return_type() {
    let result = parse_php("<?php $f = function &(): int { return 0; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_byref_closure_with_use_and_return_type() {
    let result = parse_php("<?php $f = function &($x) use (&$ref): string { return $ref; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Arrow functions returning arrow functions (right-associative `=>`)
#[test]
fn test_chained_arrow_functions() {
    let result = parse_php("<?php $fn = fn($x) => fn($y) => $x + $y;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_chained_arrow_functions_with_type_hints() {
    let result = parse_php("<?php $fn = fn($x): Closure => fn($y): int => $x + $y;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Attributes on closure/arrow-fn expressions
#[test]
fn test_attribute_on_closure_expression() {
    let result = parse_php("<?php $x = #[Attr] function() { return 1; };");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_on_static_arrow_fn() {
    let result = parse_php("<?php $y = #[Attr] static fn($a) => $a;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// First-class callables in complex positions
#[test]
fn test_first_class_callable_invoked_immediately() {
    // (strlen(...))('hello') — callable result called in same expression
    let result = parse_php("<?php $r = (strlen(...))('hello');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_first_class_callable_as_argument() {
    let result = parse_php("<?php array_map(strlen(...), array_filter($arr, is_string(...)));");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Named arguments mixed with spread
#[test]
fn test_named_args_mixed_with_spread() {
    let result = parse_php("<?php func(a: 1, ...['b' => 2]);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_spread_then_named_arg() {
    let result = parse_php("<?php func(...$args, last: 'end');");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Static Keyword Disambiguation
// =============================================================================

#[test]
fn test_static_double_colon_as_stmt() {
    // static:: access used as a standalone statement
    let source = r#"<?php
static::$prop;
static::method();
static::class;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_static_semicolon_as_stmt() {
    // `static;` — no variable follows, falls into parse_expression_stmt;
    // parser accepts it and treats `static` as a bare name expression
    let result = parse_php("<?php static;");
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Generators: Edge Cases
// =============================================================================

#[test]
fn test_yield_in_match_arm() {
    let source = r#"<?php
function gen($x) {
    $v = match(true) {
        $x > 0 => yield $x,
        default => yield 0,
    };
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_yield_from_complex_expression() {
    let source = r#"<?php
function gen() {
    yield from array_map(fn($x) => $x * 2, [1, 2, 3]);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Destructuring: Edge Cases
// =============================================================================

#[test]
fn test_deeply_nested_array_destructuring() {
    let source = r#"<?php
[[$a, [$b, $c]], $d] = $data;
[[[$e, $f], $g], [$h, $i]] = $matrix;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_deeply_nested_list_destructuring() {
    let source = r#"<?php
list(list($a, $b), list($c, $d)) = $pairs;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Type System: DNF & Intersection Types
// =============================================================================

// Intersection with built-in type names
#[test]
fn test_intersection_type_with_object() {
    let result = parse_php("<?php function foo(object&Countable $x): void {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_return_type_self_intersection() {
    let result = parse_php("<?php function foo(): (self&Stringable) {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// DNF (disjunctive normal form) types
#[test]
fn test_dnf_type_with_null() {
    let result = parse_php("<?php function foo((Countable&Traversable)|null $x): (A&B)|null {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_dnf_type_union_of_intersections() {
    let result = parse_php(
        "<?php function foo((Countable&Traversable)|(ArrayAccess&Stringable) $x): void {}",
    );
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_complex_dnf_type() {
    let source = r#"<?php
function foo(
    (Countable&Traversable)|(ArrayAccess&Stringable)|null $x
): (A&B)|(C&D) {}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Readonly property with intersection type
#[test]
fn test_readonly_intersection_type_property() {
    let source = r#"<?php
class Foo {
    public readonly Countable&Traversable $prop;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Control Flow: Edge Cases
// =============================================================================

// Switch with multiple consecutive fall-through cases
#[test]
fn test_switch_many_fallthroughs() {
    let source = r#"<?php
switch ($x) {
    case 1:
    case 2:
    case 3:
        echo "1-3";
        break;
    case 4:
    case 5:
        echo "4-5";
        break;
    default:
        echo "other";
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Catch clauses with 3+ types in a union
#[test]
fn test_catch_three_type_union() {
    let source = r#"<?php
try {
    risky();
} catch (A|B|C $e) {
    handle($e);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_catch_four_type_union() {
    let source = r#"<?php
try {
    risky();
} catch (TypeError|ValueError|RuntimeException|LogicException $e) {
    handle($e);
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Match & Enum: Edge Cases
// =============================================================================

// Empty match body — parser must not panic (zero arms, snapshot documents behavior)
#[test]
fn test_match_empty_body() {
    let result = parse_php("<?php $x = match($y) {};");
    insta::assert_snapshot!(to_json(&result.program));
}

// Deeply nested match expressions
#[test]
fn test_deeply_nested_match() {
    let source = r#"<?php
$r = match(1) {
    1 => match(2) {
        2 => match(3) {
            3 => 'deep',
            default => 'x'
        },
        default => 'y'
    },
    default => 'z'
};
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Enum with multiple interfaces, a constant, and methods
#[test]
fn test_enum_multiple_interfaces_const_method() {
    let source = r#"<?php
enum Status: string implements Loggable, Serializable {
    case Active = 'active';
    case Inactive = 'inactive';

    const DEFAULT = self::Active;

    public function label(): string {
        return $this->value;
    }

    public function isActive(): bool {
        return $this === self::Active;
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Heredoc & Nowdoc: Edge Cases
// =============================================================================

// PHP 7.3+: closing marker may be indented; the indentation is stripped from
// each content line. A 4-space indent on `    END;` yields `"content line"`.
#[test]
fn test_heredoc_indented_closing_marker() {
    let source = "<?php\n$x = <<<END\n    content line\n    END;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nowdoc_indented_closing_marker() {
    let source = "<?php\n$y = <<<'NOW'\n    nowdoc content\n    NOW;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Empty heredoc body
#[test]
fn test_heredoc_empty() {
    let source = "<?php\n$x = <<<END\nEND;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Heredoc with complex interpolation (curly syntax + array subscript)
#[test]
fn test_heredoc_with_complex_interpolation() {
    let source = r#"<?php
$x = <<<EOT
Hello {$obj->name}!
$arr[0] items
EOT;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// OOP: Class Modifier Combos & Attributes
// =============================================================================

// readonly class with constructor promotion
#[test]
fn test_readonly_class_with_constructor_promotion() {
    let source = r#"<?php
readonly class Point {
    public function __construct(
        public float $x,
        public float $y,
        public float $z = 0.0,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_final_readonly_class_coordinate() {
    let source = r#"<?php
final readonly class Coordinate {
    public function __construct(
        public float $lat,
        public float $lng,
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// PHP 8.0: attributes on anonymous classes via `new #[Attr] class() {}`
#[test]
fn test_anonymous_class_with_attribute() {
    let result = parse_php("<?php $x = new #[Attr] class() {};");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// Multiple stacked attributes + per-parameter attributes
#[test]
fn test_attribute_explosion() {
    let source = r#"<?php
#[A] #[B] #[C]
function f(
    #[Attr1] #[Attr2] int $x,
    #[Attr3] string $y
): void {}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Invalid Class Modifier Combinations
// =============================================================================

#[test]
fn test_invalid_double_readonly_anonymous_class() {
    let result = parse_php("<?php new readonly readonly class {};");
    assert!(
        !result.errors.is_empty(),
        "Expected parse errors for double readonly"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_abstract_readonly_class() {
    // PHP 8.4: abstract readonly class is valid
    let result = parse_php("<?php abstract readonly class Foo {}");
    assert!(
        result.errors.is_empty(),
        "abstract readonly class should be valid in PHP 8.4: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_readonly_abstract_class() {
    // PHP 8.4: readonly abstract class is valid
    let result = parse_php("<?php readonly abstract class Foo {}");
    assert!(
        result.errors.is_empty(),
        "readonly abstract class should be valid in PHP 8.4: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_invalid_abstract_final_class() {
    let result = parse_php("<?php abstract final class Foo {}");
    assert!(
        !result.errors.is_empty(),
        "Expected parse errors for abstract final class"
    );
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// PHP version-specific feature tests
// =============================================================================

fn parse_php_versioned(
    source: &'static str,
    version: php_rs_parser::PhpVersion,
) -> php_rs_parser::ParseResult<'static, 'static> {
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse_versioned(arena, source, version)
}

#[test]
fn test_version_php80_match_requires_80() {
    // match is PHP 8.0 — must pass on 8.0+, fail on nothing below that
    let result = parse_php_versioned(
        "<?php $x = match($y) { 1 => 'a', default => 'b' };",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        result.errors.is_empty(),
        "match should be valid in PHP 8.0: {:?}",
        result.errors
    );
}

#[test]
fn test_version_php81_enum_requires_81() {
    let result_81 = parse_php_versioned(
        "<?php enum Status { case Active; case Inactive; }",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        result_81.errors.is_empty(),
        "enum should be valid in PHP 8.1: {:?}",
        result_81.errors
    );

    let result_80 = parse_php_versioned(
        "<?php enum Status { case Active; case Inactive; }",
        php_rs_parser::PhpVersion::Php80,
    );
    assert!(
        !result_80.errors.is_empty(),
        "enum should emit a version error when targeting PHP 8.0"
    );
    assert!(result_80.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("enum")
    )));
}

#[test]
fn test_version_php82_readonly_class_requires_82() {
    let result_82 = parse_php_versioned(
        "<?php readonly class Foo { public string $bar; }",
        php_rs_parser::PhpVersion::Php82,
    );
    assert!(
        result_82.errors.is_empty(),
        "readonly class should be valid in PHP 8.2: {:?}",
        result_82.errors
    );

    let result_81 = parse_php_versioned(
        "<?php readonly class Foo { public string $bar; }",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        !result_81.errors.is_empty(),
        "readonly class should emit a version error when targeting PHP 8.1"
    );
}

#[test]
fn test_version_php83_typed_constants_require_83() {
    let result_83 = parse_php_versioned(
        "<?php class Foo { public const string NAME = 'foo'; }",
        php_rs_parser::PhpVersion::Php83,
    );
    assert!(
        result_83.errors.is_empty(),
        "typed constants should be valid in PHP 8.3: {:?}",
        result_83.errors
    );

    let result_82 = parse_php_versioned(
        "<?php class Foo { public const string NAME = 'foo'; }",
        php_rs_parser::PhpVersion::Php82,
    );
    assert!(
        !result_82.errors.is_empty(),
        "typed constants should emit a version error when targeting PHP 8.2"
    );
}

#[test]
fn test_version_php84_abstract_readonly_class_requires_84() {
    let result_84 = parse_php_versioned(
        "<?php abstract readonly class Foo {}",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        result_84.errors.is_empty(),
        "abstract readonly class should be valid in PHP 8.4: {:?}",
        result_84.errors
    );

    let result_83 = parse_php_versioned(
        "<?php abstract readonly class Foo {}",
        php_rs_parser::PhpVersion::Php83,
    );
    assert!(
        !result_83.errors.is_empty(),
        "abstract readonly class should emit a version error when targeting PHP 8.3"
    );
}

#[test]
fn test_version_php85_pipe_operator_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php $x = $value |> trim(...) |> strtolower(...);",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "pipe operator should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php $x = $value |> trim(...) |> strtolower(...);",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "pipe operator should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("pipe")
    )));
}

#[test]
fn test_version_php85_clone_with_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php $b = clone($a, ['alpha' => 128]);",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "clone with should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php $b = clone($a, ['alpha' => 128]);",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "clone with should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("clone")
    )));
}

#[test]
fn test_version_php85_static_asymmetric_visibility_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php class Foo { public static private(set) string $bar = 'x'; }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "static asymmetric visibility should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php class Foo { public static private(set) string $bar = 'x'; }",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "static asymmetric visibility should emit a version error when targeting PHP 8.4"
    );
}

#[test]
fn test_version_php85_final_promoted_property_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "final promoted property should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "final promoted property should emit a version error when targeting PHP 8.4"
    );
}

#[test]
fn test_version_php85_void_cast_requires_85() {
    let result_85 = parse_php_versioned(
        "<?php (void) getVersion();",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "void cast should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php (void) getVersion();",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "void cast should emit a version error when targeting PHP 8.4"
    );
    assert!(result_84.errors.iter().any(|e| matches!(
        e,
        php_rs_parser::diagnostics::ParseError::VersionTooLow { feature, .. }
            if feature.contains("void")
    )));
}

#[test]
fn test_version_php85_const_attributes_require_85() {
    let result_85 = parse_php_versioned(
        "<?php #[MyAttr] const VERSION = '8.5';",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result_85.errors.is_empty(),
        "attributes on constants should be valid in PHP 8.5: {:?}",
        result_85.errors
    );

    let result_84 = parse_php_versioned(
        "<?php #[MyAttr] const VERSION = '8.5';",
        php_rs_parser::PhpVersion::Php84,
    );
    assert!(
        !result_84.errors.is_empty(),
        "attributes on constants should emit a version error when targeting PHP 8.4"
    );
}

#[test]
fn test_param_is_final_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php class Foo { public function __construct(public final string $bar) {} }",
        php_rs_parser::PhpVersion::Php85,
    );
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let class = &result.program.stmts[0];
    let php_ast::StmtKind::Class(class_decl) = &class.kind else {
        panic!("expected class")
    };
    let member = class_decl
        .members
        .iter()
        .find(|m| matches!(m.kind, php_ast::ClassMemberKind::Method(_)))
        .unwrap();
    let php_ast::ClassMemberKind::Method(method_decl) = &member.kind else {
        unreachable!()
    };
    let param = &method_decl.params[0];
    assert!(
        param.is_final,
        "is_final should be true for 'final' promoted property"
    );
    assert!(!param.is_readonly, "is_readonly should be false");
}

#[test]
fn test_param_is_readonly_preserved_in_ast() {
    let result = parse_php_versioned(
        "<?php function foo(readonly string $x) {}",
        php_rs_parser::PhpVersion::Php81,
    );
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let func = &result.program.stmts[0];
    let php_ast::StmtKind::Function(func_decl) = &func.kind else {
        panic!("expected function")
    };
    let param = &func_decl.params[0];
    assert!(
        param.is_readonly,
        "is_readonly should be true for 'readonly' parameter"
    );
    assert!(!param.is_final, "is_final should be false");
}

#[test]
fn test_arg_by_ref_preserved_in_ast() {
    let result = parse_php("<?php f(&$a);");
    assert!(
        result.errors.is_empty(),
        "unexpected errors: {:?}",
        result.errors
    );
    let expr_stmt = &result.program.stmts[0];
    let php_ast::StmtKind::Expression(expr) = &expr_stmt.kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::FunctionCall(call) = &expr.kind else {
        panic!("expected function call")
    };
    let arg = &call.args[0];
    assert!(arg.by_ref, "by_ref should be true for &$a argument");
    assert!(!arg.unpack, "unpack should be false");
}

// =============================================================================
// Shell Exec: Complex Interpolation
// =============================================================================

#[test]
fn test_shell_exec_complex_interpolation() {
    let source = r#"<?php
$a = `ls {$dirs['home']}`;
$b = `{$obj->getCommand()} --flag=$value`;
$c = `echo $arr[0]`;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_shell_exec_empty() {
    let result = parse_php("<?php $x = ``;");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Heredoc/Nowdoc: Edge Cases
// =============================================================================

#[test]
fn test_indented_heredoc_with_interpolation() {
    let source = "<?php\n$x = <<<END\n    Hello {$obj->name}!\n    $arr[0] items\n    END;\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_heredoc_in_array_value() {
    let source = "<?php\n$arr = [\n    'key' => <<<EOT\n    value\n    EOT,\n];\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_nowdoc_in_match_arm() {
    let source = "<?php\n$r = match(true) {\n    default => <<<'NOW'\n    literal\n    NOW,\n};\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_heredoc_as_default_param() {
    let source = "<?php\nfunction f($s = <<<'EOT'\nhello\nEOT\n) {}\n";
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Goto: Multiple Labels and Backward Jumps
// =============================================================================

#[test]
fn test_goto_backward_jump() {
    let source = r#"<?php
start:
if ($count++ < 3) {
    goto start;
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_goto_multiple_labels() {
    let source = r#"<?php
if ($a) goto labelA;
if ($b) goto labelB;
labelA:
echo 'A';
goto end;
labelB:
echo 'B';
end:
echo 'done';
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_goto_inside_switch() {
    let source = r#"<?php
switch ($x) {
    case 1:
        goto done;
    case 2:
        echo 'two';
}
done:
echo 'done';
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Variable Variables: Deep Nesting
// =============================================================================

#[test]
fn test_variable_variable_as_dynamic_method() {
    // curly-brace form is needed for var-var in method position
    let result = parse_php("<?php $obj->{$$method}();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Constructor Promoted Parameters with Hooks
// =============================================================================

#[test]
fn test_constructor_promoted_param_with_hooks() {
    let source = r#"<?php
class Foo {
    public function __construct(
        public string $name {
            get => strtoupper($this->name);
            set(string $value) { $this->name = trim($value); }
        },
    ) {}
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_interface_property_hooks() {
    let source = r#"<?php
interface HasName {
    public string $name { get; }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// __halt_compiler(): Data Capture Edge Cases
// =============================================================================

#[test]
fn test_halt_compiler_empty_remainder() {
    let result = parse_php("<?php __halt_compiler();");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_halt_compiler_with_statements_before() {
    let result = parse_php("<?php echo 'before'; __halt_compiler(); raw data here");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Attributes: Remaining Targets
// =============================================================================

#[test]
fn test_attribute_on_class_constant() {
    let result = parse_php("<?php class A { #[Deprecated] const FOO = 1; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_on_interface_method() {
    let result = parse_php("<?php interface I { #[Pure] public function foo(): void; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_on_trait_property() {
    let result = parse_php("<?php trait T { #[Inject] public string $dep; }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_on_enum_method() {
    let result = parse_php("<?php enum E { case A; #[Override] public function foo(): void {} }");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

#[test]
fn test_attribute_with_new_expression_arg() {
    let result = parse_php("<?php #[Attr(new Config(debug: false))] function f() {}");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// list() By-Reference Destructuring
// =============================================================================

#[test]
fn test_list_by_reference_destructuring() {
    let source = r#"<?php
[&$a, &$b] = $arr;
list(&$x, &$y) = $pair;
[&$first, $second] = $mixed;
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// __PROPERTY__ in Hook Body
// =============================================================================

#[test]
fn test_magic_property_in_hook_body() {
    let source = r#"<?php
class Foo {
    public string $name {
        get {
            echo __PROPERTY__;
            return $this->name;
        }
    }
}
"#;
    let result = parse_php(source);
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Type Validation: true|false in union
// =============================================================================

#[test]
fn test_true_false_union_is_invalid() {
    // PHP rejects true|false: "Type contains both true and false, bool must be used instead"
    assert_has_errors("<?php function f(): true|false {}");
    assert_has_errors("<?php function f(): true|false|null {}");
    assert_has_errors("<?php function f(true|false $x): void {}");
}

// =============================================================================
// Version Gate: Explicit Octal (PHP 8.1+)
// =============================================================================

#[test]
fn test_explicit_octal_valid_on_81() {
    let result = parse_php_versioned("<?php $x = 0o777;", php_rs_parser::PhpVersion::Php81);
    assert!(
        result.errors.is_empty(),
        "explicit octal should be valid on PHP 8.1: {:?}",
        result.errors
    );
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Bug fixes: invalid AST was previously generated
// =============================================================================

#[test]
fn test_assign_by_ref_has_by_ref_true() {
    // Bug fix: `$a =& $b` was previously indistinguishable from `$a = $b` in the AST.
    let result = parse_php("<?php $a =& $b;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign expr")
    };
    assert!(assign.by_ref, "=& must set by_ref=true on AssignExpr");
    assert_eq!(assign.op, php_ast::AssignOp::Assign);
}

#[test]
fn test_regular_assign_has_by_ref_false() {
    let result = parse_php("<?php $a = $b;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign expr")
    };
    assert!(!assign.by_ref, "= must set by_ref=false on AssignExpr");
}

#[test]
fn test_assign_by_ref_distinct_from_regular_assign_in_ast() {
    // `$a =& $b` and `$a = $b` must produce distinct AST nodes.
    let ref_result = parse_php("<?php $a =& $b;");
    let val_result = parse_php("<?php $a = $b;");
    assert_no_errors(&ref_result);
    assert_no_errors(&val_result);
    let ref_json = to_json(&ref_result.program);
    let val_json = to_json(&val_result.program);
    assert_ne!(
        ref_json, val_json,
        "`$a =& $b` and `$a = $b` must have distinct AST"
    );
    assert!(ref_json.contains("\"by_ref\": true"));
    assert!(!val_json.contains("\"by_ref\""));
}

#[test]
fn test_array_element_by_ref_has_by_ref_true() {
    // Bug fix: `[&$a]` element was previously indistinguishable from `[$a]`.
    let result = parse_php("<?php [&$a, $b] = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected array destructuring target")
    };
    assert!(elems[0].by_ref, "first element &$a must have by_ref=true");
    assert!(!elems[1].by_ref, "second element $b must have by_ref=false");
}

#[test]
fn test_list_element_by_ref_has_by_ref_true() {
    // Bug fix: `list(&$a, $b)` — the &$a element must record by_ref=true.
    let result = parse_php("<?php list(&$a, $b) = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected list destructuring target")
    };
    assert!(elems[0].by_ref, "first element &$a must have by_ref=true");
    assert!(!elems[1].by_ref, "second element $b must have by_ref=false");
}

#[test]
fn test_empty_destructuring_slot_is_omit_not_null() {
    // Bug fix: `[$a, , $c]` empty slot was previously `ExprKind::Null`,
    // making it indistinguishable from `[$a, null, $c]`.
    let result = parse_php("<?php [$a, , $c] = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected array destructuring target")
    };
    assert!(
        matches!(elems[1].value.kind, php_ast::ExprKind::Omit),
        "empty slot must be ExprKind::Omit, got {:?}",
        elems[1].value.kind
    );
}

#[test]
fn test_list_empty_slot_is_omit_not_null() {
    // Bug fix: `list($a, , $c)` empty slot was previously `ExprKind::Null`.
    let result = parse_php("<?php list($a, , $c) = $arr;");
    assert_no_errors(&result);
    let php_ast::StmtKind::Expression(expr) = &result.program.stmts[0].kind else {
        panic!("expected expression stmt")
    };
    let php_ast::ExprKind::Assign(assign) = &expr.kind else {
        panic!("expected assign")
    };
    let php_ast::ExprKind::Array(elems) = &assign.target.kind else {
        panic!("expected list destructuring target")
    };
    assert!(
        matches!(elems[1].value.kind, php_ast::ExprKind::Omit),
        "empty slot must be ExprKind::Omit, got {:?}",
        elems[1].value.kind
    );
}

#[test]
fn test_null_literal_distinct_from_omit_in_array_destructuring() {
    // `[$a, null, $c]` and `[$a, , $c]` must produce distinct AST nodes.
    let omit_result = parse_php("<?php [$a, , $c] = $arr;");
    let null_result = parse_php("<?php [$a, null, $c] = $arr;");
    assert_no_errors(&omit_result);
    assert_no_errors(&null_result);
    let omit_json = to_json(&omit_result.program);
    let null_json = to_json(&null_result.program);
    assert_ne!(
        omit_json, null_json,
        "`[$a, , $c]` and `[$a, null, $c]` must have distinct AST"
    );
    assert!(
        omit_json.contains("\"Omit\""),
        "empty slot must serialize as \"Omit\""
    );
    assert!(
        !omit_json.contains("\"Null\""),
        "empty slot must not serialize as \"Null\""
    );
}
