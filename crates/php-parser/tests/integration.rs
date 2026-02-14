use php_parser::parse;

fn parse_php(source: &str) -> php_parser::ParseResult {
    parse(source)
}

fn assert_parses_ok(_label: &str, source: &str) {
    let result = parse_php(source);
    assert_no_errors(&result);
}

fn assert_no_errors(result: &php_parser::ParseResult) {
    if !result.errors.is_empty() {
        panic!(
            "Expected no parse errors, got {} error(s):\n{:#?}",
            result.errors.len(),
            result.errors
        );
    }
}

fn to_json(program: &php_ast::Program) -> String {
    serde_json::to_string_pretty(program).unwrap()
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
}

fixture_test!(test_basic, "basic.php");
fixture_test!(test_expressions, "expressions.php");
fixture_test!(test_control_flow, "control_flow.php");
fixture_test!(test_functions, "functions.php");
fixture_test!(test_arrays, "arrays.php");
fixture_test!(test_inline_html, "inline_html.php");
fixture_test!(test_assignment_ops, "assignment_ops.php");
fixture_test!(test_anonymous_classes, "anonymous_classes.php");

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
    let result = parse_php("<?php htmlspecialchars(string: $str, flags: ENT_QUOTES, encoding: 'UTF-8');");
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

// =============================================================================
// Phase 7: Built-in Expressions
// =============================================================================

#[test]
fn test_cast_expressions() {
    let result = parse_php("<?php (int)$x; (float)$y; (string)$z; (bool)$a; (array)$b; (object)$c;");
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
    assert_parses_ok("declare encoding", "<?php declare(encoding='UTF-8');");
    assert_parses_ok("declare ticks inline", "<?php declare(ticks=1) echo 'tick';");
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
    assert_parses_ok("void cast", "<?php (void)$x;");
    assert_parses_ok("void cast call", "<?php (void)foo();");
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
    assert_parses_ok("suppress chain", "<?php @$a->b()->c;");
    assert_parses_ok("suppress new", "<?php @(new Foo())->init();");
    assert_parses_ok("suppress include", "<?php @include 'optional.php';");
    assert_parses_ok("suppress array access", "<?php @$arr[$key];");
}

#[test]
fn test_isset_complex() {
    let result = parse_php("<?php isset($a['key'], $b->prop, $c::$static);");
    assert_no_errors(&result);
    insta::assert_snapshot!(to_json(&result.program));
}

// =============================================================================
// Phase 20: Yield Edge Cases
// =============================================================================

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
    assert!(has_unclosed, "Expected unclosed delimiter error, got: {:?}", result.errors);
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
    assert_parses_ok("all magic consts", "<?php echo __LINE__, __FILE__, __DIR__, __FUNCTION__, __CLASS__, __TRAIT__, __METHOD__, __NAMESPACE__;");
}

// =============================================================================
// Strings & Heredoc
// =============================================================================

#[test]
fn test_string_interpolation_patterns() {
    assert_parses_ok("nested curly", r#"<?php $x = "Value: {$arr['key']}"; "#);
    assert_parses_ok("method in string", r#"<?php $x = "Name: {$obj->getName()}"; "#);
    assert_parses_ok("complex curly", r#"<?php $x = "{$a[$b][$c]}"; "#);
    assert_parses_ok("dollar brace", r#"<?php $x = "${name}s"; "#);
    assert_parses_ok("adjacent vars", r#"<?php $x = "$a$b$c"; "#);
    assert_parses_ok("var at end", r#"<?php $x = "hello $name"; "#);
    assert_parses_ok("escaped dollar", r#"<?php $x = "cost is \$5"; "#);
    assert_parses_ok("heredoc interp", "<?php $x = <<<EOT\nHello $name\nEOT;\n");
    assert_parses_ok("chained in string", r#"<?php $x = "{$obj->items[0]->name}"; "#);
    assert_parses_ok("dynamic prop in string", r#"<?php $x = "{$obj->$prop}"; "#);
    assert_parses_ok("array var in string", r#"<?php $x = "item $arr[0] here"; "#);
    assert_parses_ok("prop var in string", r#"<?php $x = "name $obj->name here"; "#);
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
    assert_parses_ok("nowdoc basic", "<?php $x = <<<'EOT'\nhello world\nEOT;\n");
    assert_parses_ok("heredoc indented close", "<?php $x = <<<EOT\n    hello\n    EOT;\n");
    // Known limitation: heredoc in expression context (concat, array, function args)
    // requires PHP 7.3+ flexible heredoc syntax which is not yet fully supported
}

// =============================================================================
// Operators & Expressions
// =============================================================================

#[test]
fn test_operator_precedence_combinations() {
    assert_parses_ok("nested ternary", "<?php $a ? $b : ($c ? $d : $e);");
    assert_parses_ok("null coalesce chain", "<?php $a ?? $b ?? $c ?? 'default';");
    assert_parses_ok("mixed bitwise logical", "<?php $a & $b && $c | $d;");
    assert_parses_ok("instanceof chain", "<?php $a instanceof Foo && $b instanceof Bar;");
    assert_parses_ok("chained assignment", "<?php $a = $b = $c = 1;");
    assert_parses_ok("assignment in ternary", "<?php $a = $b ? $c : $d;");
    assert_parses_ok("comparison chain", "<?php $a == $b && $b == $c;");
    assert_parses_ok("power assoc", "<?php $a ** $b ** $c;");
    assert_parses_ok("unary in binary", "<?php !$a && !$b || !$c;");
    assert_parses_ok("concat precedence", "<?php 'a' . 'b' . $c . 'd';");
    assert_parses_ok("postfix in expr", "<?php $arr[$i++] = $j--;");
    assert_parses_ok("error suppress complex", "<?php @$obj->method();");
    assert_parses_ok("cast precedence", "<?php (int)$a + (string)$b;");
    assert_parses_ok("spread in array", "<?php [...$a, ...$b, 1, 2];");
}

#[test]
fn test_assignment_patterns() {
    assert_parses_ok("null coalesce assign", "<?php $a ??= 'default';");
    assert_parses_ok("concat assign", "<?php $str .= ' world';");
    assert_parses_ok("power assign", "<?php $x **= 2;");
    assert_parses_ok("ref assign", "<?php $a = &$b;");
    assert_parses_ok("array push", "<?php $arr[] = 'new';");
    assert_parses_ok("nested array push", "<?php $arr[][] = 'deep';");
    assert_parses_ok("list with keys", "<?php ['x' => $x, 'y' => $y] = getPoint();");
}

#[test]
fn test_expression_chains() {
    assert_parses_ok("call result access", "<?php foo()[0];");
    assert_parses_ok("call result method", "<?php foo()->bar();");
    assert_parses_ok("new paren method", "<?php (new Foo())->bar();");
    assert_parses_ok("new paren prop", "<?php (new Foo)->prop;");
    assert_parses_ok("chained calls", "<?php $a->b()->c()->d();");
    assert_parses_ok("call result array method", "<?php $a->b()[0]->c();");
    assert_parses_ok("clone chain", "<?php clone $obj->getPrototype();");
    assert_parses_ok("new with chaining", "<?php (new Foo(1, 2))->init()->run();");
    assert_parses_ok("static call chain", "<?php Foo::create()->setup();");
    assert_parses_ok("nested new", "<?php new Foo(new Bar());");
    assert_parses_ok("double call", "<?php $factory()();");
    assert_parses_ok("array on new", "<?php (new Collection([1,2,3]))[0];");
}

#[test]
fn test_dynamic_access() {
    assert_parses_ok("dynamic prop", "<?php $obj->$prop;");
    assert_parses_ok("dynamic prop expr", "<?php $obj->{$prefix . 'Name'};");
    assert_parses_ok("dynamic static", "<?php $class::$prop;");
    assert_parses_ok("dynamic method", "<?php $obj->$method();");
    assert_parses_ok("dynamic static method", "<?php $class::$method();");
    assert_parses_ok("variable class new", "<?php new $className();");
    assert_parses_ok("variable class static", "<?php $class::CONST_NAME;");
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
    assert_parses_ok("nested array destruct", "<?php [[$a, $b], [$c, $d]] = $arr;");
    assert_parses_ok("deep nesting", "<?php [$a, [$b, [$c, [$d]]]] = $arr;");
    assert_parses_ok("keyed destruct", "<?php ['name' => $name, 'age' => $age] = $person;");
    assert_parses_ok("mixed keyed/positional", "<?php [0 => $first, 'key' => $val] = $arr;");
    assert_parses_ok("list nested", "<?php list($a, list($b, $c)) = $arr;");
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
    assert_parses_ok("if endif", "<?php if ($x): echo 1; elseif ($y): echo 2; else: echo 3; endif;");
    assert_parses_ok("while endwhile", "<?php while ($x): doStuff(); endwhile;");
    assert_parses_ok("for endfor", "<?php for ($i = 0; $i < 10; $i++): echo $i; endfor;");
    assert_parses_ok("foreach endforeach", "<?php foreach ($arr as $v): echo $v; endforeach;");
    assert_parses_ok("switch endswitch", "<?php switch ($x): case 1: echo 'one'; break; default: echo 'other'; endswitch;");
}

#[test]
fn test_control_flow_variants() {
    assert_parses_ok("foreach destructure", "<?php foreach ($arr as [$key, $value]) { echo $key; }");
    assert_parses_ok("foreach keyed destruct", "<?php foreach ($arr as $k => [$a, $b]) {}");
    assert_parses_ok("switch default middle", "<?php switch ($x) { case 1: break; default: break; case 2: break; }");
    assert_parses_ok("empty switch", "<?php switch ($x) {}");
    assert_parses_ok("multiple braced ns", "<?php namespace A { function foo() {} } namespace B { function bar() {} }");
    assert_parses_ok("empty braced ns", "<?php namespace A { }");
    assert_parses_ok("global ns block", "<?php namespace { function main() {} }");
}

#[test]
fn test_try_catch_variants() {
    assert_parses_ok("multi catch types", "<?php try { foo(); } catch (TypeError | ValueError $e) { echo $e; }");
    assert_parses_ok("catch no var", "<?php try { foo(); } catch (Exception) { echo 'error'; }");
    assert_parses_ok("multi catch blocks", "<?php try { foo(); } catch (A $a) { } catch (B $b) { } catch (C $c) { }");
    assert_parses_ok("try finally no catch", "<?php try { foo(); } finally { cleanup(); }");
    assert_parses_ok("catch rethrow", "<?php try { foo(); } catch (Exception $e) { throw $e; }");
    assert_parses_ok("multi catch no var", "<?php try { foo(); } catch (TypeError | ValueError) { log(); }");
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
    assert_parses_ok("match multi conditions", "<?php $r = match($x) { 1, 2, 3 => 'low', 4, 5 => 'high' };");
    assert_parses_ok("match with default", "<?php $r = match(true) { $a > 0 => 'pos', default => 'other' };");
    assert_parses_ok("match in assignment", "<?php $y = match($x) { 'a' => 1, 'b' => 2, default => 0 };");
    assert_parses_ok("match nested", "<?php $r = match($a) { 1 => match($b) { 1 => 'aa', default => 'ab' }, default => 'x' };");
    assert_parses_ok("match throw", "<?php $r = match($x) { 1 => 'ok', default => throw new Exception() };");
    assert_parses_ok("match no default", "<?php $r = match($x) { 1 => 'one', 2 => 'two' };");
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
    assert_parses_ok("variadic typed", "<?php function foo(int ...$nums) {}");
    assert_parses_ok("nullable return", "<?php function foo(): ?int { return null; }");
    assert_parses_ok("union return", "<?php function foo(): int|string { return 1; }");
    assert_parses_ok("intersection param", "<?php function foo(Countable&Traversable $x) {}");
    assert_parses_ok("by ref return", "<?php function &getRef() { global $x; return $x; }");
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
    assert_parses_ok("mixed named args", "<?php foo(1, 2, name: 'test', other: true);");
    assert_parses_ok("named with spread", "<?php foo(name: 'test', ...$extra);");
    assert_parses_ok("named in new", "<?php new Foo(x: 1, y: 2);");
    assert_parses_ok("named in method", "<?php $obj->method(key: 'val');");
}

#[test]
fn test_closure_variants() {
    assert_parses_ok("static arrow", "<?php $fn = static fn($x) => $x * 2;");
    assert_parses_ok("arrow returns arrow", "<?php $fn = fn($x) => fn($y) => $x + $y;");
    assert_parses_ok("closure use by ref", "<?php $fn = function() use (&$a, &$b) { return $a + $b; };");
    assert_parses_ok("closure with return type", "<?php $fn = function(int $x): string { return (string)$x; };");
    assert_parses_ok("arrow with array", "<?php $fn = fn($x) => [$x, $x * 2];");
    assert_parses_ok("arrow typed", "<?php $fn = fn(int $x): int => $x * 2;");
    assert_parses_ok("arrow in array_map", "<?php array_map(fn($x) => $x * 2, $arr);");
    assert_parses_ok("arrow with null coalesce", "<?php $fn = fn($x) => $x ?? 'default';");
    assert_parses_ok("closure static typed", "<?php $fn = static function(int $x): int { return $x; };");
    assert_parses_ok("arrow in ternary", "<?php $fn = $flag ? fn($x) => $x + 1 : fn($x) => $x - 1;");
    assert_parses_ok("arrow in call", "<?php array_filter($arr, fn($x) => $x > 0);");
    assert_parses_ok("closure immediately invoked", "<?php (function() { echo 'hi'; })();");
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
    assert_parses_ok("arrow fn value", "<?php $a = ['map' => fn($x) => $x * 2, 'filter' => fn($x) => $x > 0];");
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
    assert_parses_ok("yield value", "<?php function gen() { yield 1; yield 2; }");
    assert_parses_ok("yield key value", "<?php function gen() { yield 'a' => 1; yield 'b' => 2; }");
    assert_parses_ok("yield from", "<?php function gen() { yield from [1, 2, 3]; }");
    assert_parses_ok("yield from call", "<?php function gen() { yield from otherGen(); }");
    assert_parses_ok("yield in assign", "<?php function gen() { $val = yield 'key' => 'value'; }");
    assert_parses_ok("yield null", "<?php function gen() { yield; }");
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
    assert_parses_ok("readonly class", "<?php readonly class Point { public function __construct(public int $x, public int $y) {} }");
    assert_parses_ok("abstract with interface", "<?php abstract class Foo implements Bar, Baz { abstract public function run(): void; }");
    assert_parses_ok("const visibility", "<?php class Foo { public const A = 1; protected const B = 2; private const C = 3; }");
    assert_parses_ok("promoted with defaults", "<?php class Foo { public function __construct(public readonly int $x, private string $y = 'default') {} }");
    assert_parses_ok("anon class full", "<?php $obj = new class(1) extends Base implements Iface1, Iface2 { public function run() {} };");
    assert_parses_ok("interface extends multi", "<?php interface Foo extends Bar, Baz { public function run(): void; }");
    assert_parses_ok("abstract method", "<?php abstract class Foo { abstract protected function bar(int $x): string; }");
}

#[test]
fn test_enum_variants() {
    assert_parses_ok("enum implements", "<?php enum Color implements HasLabel { case Red; public function label(): string { return 'red'; } }");
    assert_parses_ok("enum const", "<?php enum Suit: string { const TOTAL = 4; case Hearts = 'H'; }");
    assert_parses_ok("enum with use", "<?php enum Suit { use SuitTrait; case Hearts; }");
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
    assert_parses_ok("self const", "<?php class Foo { const X = 1; public function f() { return self::X; } }");
    assert_parses_ok("parent method", "<?php class Foo extends Bar { public function f() { parent::f(); } }");
    assert_parses_ok("static late", "<?php class Foo { public static function create() { return new static(); } }");
    assert_parses_ok("class const on name", "<?php echo Foo::class;");
    assert_parses_ok("static prop", "<?php class Foo { public static int $count = 0; }");
    assert_parses_ok("parent const", "<?php class Foo extends Bar { public function f() { return parent::VERSION; } }");
    assert_parses_ok("static const", "<?php class Foo { public function f() { return static::DEFAULT; } }");
    assert_parses_ok("self static prop", "<?php class Foo { public static $x = 1; public function f() { return self::$x; } }");
}

// =============================================================================
// Type Hints
// =============================================================================

#[test]
fn test_type_hint_variants() {
    assert_parses_ok("dnf complex", "<?php function f((A&B)|C $x) {}");
    assert_parses_ok("dnf multi groups", "<?php function f((A&B)|(C&D) $x) {}");
    assert_parses_ok("union with null", "<?php function f(int|string|null $x) {}");
    assert_parses_ok("self return", "<?php class Foo { public function bar(): self {} }");
    assert_parses_ok("static return", "<?php class Foo { public function bar(): static {} }");
    assert_parses_ok("parent type", "<?php class Foo extends Bar { public function bar(): parent {} }");
    assert_parses_ok("mixed type", "<?php function f(mixed $x): mixed {}");
    assert_parses_ok("never return", "<?php function abort(): never { throw new Exception(); }");
    assert_parses_ok("void return", "<?php function f(): void {}");
    assert_parses_ok("iterable type", "<?php function f(iterable $x): iterable {}");
    assert_parses_ok("callable type", "<?php function f(callable $x) {}");
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
    assert_parses_ok("attr qualified name", "<?php #[\\App\\Attr] function foo() {}");
    assert_parses_ok("attr on param", "<?php function foo(#[Validate] int $x) {}");
    // Known limitation: attributes on closure expressions (#[Pure] function() {}) not yet supported
    assert_parses_ok("attr complex args", "<?php #[Route('/api', methods: ['GET', 'POST'])] function handler() {}");
    assert_parses_ok("attr on enum case", "<?php enum Suit { #[Description('Hearts')] case Hearts; }");
    assert_parses_ok("stacked attrs", "<?php #[A] #[B] #[C] class Foo {}");
    assert_parses_ok("grouped attrs", "<?php #[A, B, C] class Foo {}");
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
// PHP Tags & Built-in Constructs
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
    assert_parses_ok("list assign", "<?php list($a, $b) = $arr;");
    assert_parses_ok("short echo", "<?= $value ?>");
    assert_parses_ok("multiple echo", "<?php echo $a, $b, $c;");
    assert_parses_ok("die with arg", "<?php die('error');");
    assert_parses_ok("exit with code", "<?php exit(1);");
    assert_parses_ok("isset multi", "<?php if (isset($a, $b, $c)) {}");
    assert_parses_ok("unset multi", "<?php unset($a, $b);");
    assert_parses_ok("global multi", "<?php global $a, $b, $c;");
    assert_parses_ok("static var multi", "<?php function f() { static $a = 1, $b = 2; }");
    assert_parses_ok("declare strict", "<?php declare(strict_types=1);");
    assert_parses_ok("eval", "<?php eval('echo 1;');");
    assert_parses_ok("require once", "<?php require_once 'autoload.php';");
    assert_parses_ok("include expr", "<?php include $dir . '/file.php';");
}

// =============================================================================
// Keyword-as-identifier tests
// =============================================================================

#[test]
fn test_keyword_as_function_name() {
    // Keywords can be used as function names
    assert_parses_ok("function readonly", "<?php function readonly() {}");
    assert_parses_ok("function exit", "<?php function exit(string|int $status = 0): never {}");
    assert_parses_ok("function die", "<?php function die(string|int $status = 0): never {}");
    assert_parses_ok("function clone", "<?php function clone(object $object): object {}");
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

fn assert_has_errors(source: &str) {
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

