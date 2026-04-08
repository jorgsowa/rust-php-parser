use php_printer::pretty_print;

fn pp(src: &str) -> String {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, src);
    assert!(
        result.errors.is_empty(),
        "parse errors: {:?}",
        result.errors
    );
    pretty_print(&result.program)
}

/// Parse, print, re-parse, print again — output must be identical.
fn round_trip(src: &str) {
    let first = pp(src);
    let second = pp(&format!("<?php {first}"));
    assert_eq!(
        first, second,
        "round-trip mismatch:\nfirst:  {first}\nsecond: {second}"
    );
}

// =============================================================================
// Literals
// =============================================================================

#[test]
fn int_literal() {
    assert_eq!(pp("<?php 42;"), "42;");
    assert_eq!(pp("<?php -1;"), "-1;");
    assert_eq!(pp("<?php 0;"), "0;");
}

#[test]
fn float_literal() {
    assert_eq!(pp("<?php 3.14;"), "3.14;");
    assert_eq!(pp("<?php 1e10;"), "10000000000.0;");
}

#[test]
fn bool_null_literals() {
    assert_eq!(pp("<?php true;"), "true;");
    assert_eq!(pp("<?php false;"), "false;");
    assert_eq!(pp("<?php null;"), "null;");
}

#[test]
fn single_quoted_string() {
    assert_eq!(pp("<?php 'hello';"), "'hello';");
    assert_eq!(pp("<?php 'it\\'s';"), "'it\\'s';");
}

#[test]
fn double_quoted_string_with_escapes() {
    assert_eq!(pp("<?php \"hello\\nworld\";"), "\"hello\\nworld\";");
    assert_eq!(pp("<?php \"tab\\there\";"), "\"tab\\there\";");
}

#[test]
fn string_with_backslash_uses_single_quotes() {
    // A literal backslash in a string should prefer single quotes
    assert_eq!(pp("<?php 'C:\\\\path';"), "'C:\\\\path';");
}

#[test]
fn interpolated_string() {
    let output = pp("<?php \"hello $name\";");
    assert_eq!(output, "\"hello $name\";");
}

#[test]
fn interpolated_string_complex() {
    let output = pp("<?php \"value: {$obj->prop}\";");
    assert_eq!(output, "\"value: {$obj->prop}\";");
}

#[test]
fn magic_constants() {
    assert_eq!(pp("<?php __CLASS__;"), "__CLASS__;");
    assert_eq!(pp("<?php __FILE__;"), "__FILE__;");
    assert_eq!(pp("<?php __LINE__;"), "__LINE__;");
    assert_eq!(pp("<?php __FUNCTION__;"), "__FUNCTION__;");
    assert_eq!(pp("<?php __DIR__;"), "__DIR__;");
    assert_eq!(pp("<?php __NAMESPACE__;"), "__NAMESPACE__;");
}

// =============================================================================
// Variables
// =============================================================================

#[test]
fn simple_variable() {
    assert_eq!(pp("<?php $x;"), "$x;");
}

#[test]
fn variable_variable() {
    assert_eq!(pp("<?php $$x;"), "$$x;");
}

// =============================================================================
// Operators
// =============================================================================

#[test]
fn binary_arithmetic() {
    assert_eq!(pp("<?php $a + $b;"), "$a + $b;");
    assert_eq!(pp("<?php $a - $b;"), "$a - $b;");
    assert_eq!(pp("<?php $a * $b;"), "$a * $b;");
    assert_eq!(pp("<?php $a / $b;"), "$a / $b;");
    assert_eq!(pp("<?php $a % $b;"), "$a % $b;");
    assert_eq!(pp("<?php $a ** $b;"), "$a ** $b;");
    assert_eq!(pp("<?php $a . $b;"), "$a . $b;");
}

#[test]
fn binary_comparison() {
    assert_eq!(pp("<?php $a == $b;"), "$a == $b;");
    assert_eq!(pp("<?php $a === $b;"), "$a === $b;");
    assert_eq!(pp("<?php $a != $b;"), "$a != $b;");
    assert_eq!(pp("<?php $a !== $b;"), "$a !== $b;");
    assert_eq!(pp("<?php $a < $b;"), "$a < $b;");
    assert_eq!(pp("<?php $a <=> $b;"), "$a <=> $b;");
}

#[test]
fn binary_logical() {
    assert_eq!(pp("<?php $a && $b;"), "$a && $b;");
    assert_eq!(pp("<?php $a || $b;"), "$a || $b;");
    assert_eq!(pp("<?php $a and $b;"), "$a and $b;");
    assert_eq!(pp("<?php $a or $b;"), "$a or $b;");
    assert_eq!(pp("<?php $a xor $b;"), "$a xor $b;");
}

#[test]
fn binary_bitwise() {
    assert_eq!(pp("<?php $a & $b;"), "$a & $b;");
    assert_eq!(pp("<?php $a | $b;"), "$a | $b;");
    assert_eq!(pp("<?php $a ^ $b;"), "$a ^ $b;");
    assert_eq!(pp("<?php $a << $b;"), "$a << $b;");
    assert_eq!(pp("<?php $a >> $b;"), "$a >> $b;");
}

#[test]
fn instanceof_op() {
    assert_eq!(pp("<?php $a instanceof Foo;"), "$a instanceof Foo;");
}

#[test]
fn assign_ops() {
    assert_eq!(pp("<?php $a = 1;"), "$a = 1;");
    assert_eq!(pp("<?php $a += 1;"), "$a += 1;");
    assert_eq!(pp("<?php $a -= 1;"), "$a -= 1;");
    assert_eq!(pp("<?php $a *= 2;"), "$a *= 2;");
    assert_eq!(pp("<?php $a /= 2;"), "$a /= 2;");
    assert_eq!(pp("<?php $a .= 'x';"), "$a .= 'x';");
    assert_eq!(pp("<?php $a ??= 1;"), "$a ??= 1;");
    assert_eq!(pp("<?php $a **= 2;"), "$a **= 2;");
}

#[test]
fn assign_by_ref() {
    assert_eq!(pp("<?php $a =& $b;"), "$a =& $b;");
}

#[test]
fn unary_prefix() {
    assert_eq!(pp("<?php -$x;"), "-$x;");
    assert_eq!(pp("<?php +$x;"), "+$x;");
    assert_eq!(pp("<?php !$x;"), "!$x;");
    assert_eq!(pp("<?php ~$x;"), "~$x;");
    assert_eq!(pp("<?php ++$x;"), "++$x;");
    assert_eq!(pp("<?php --$x;"), "--$x;");
}

#[test]
fn unary_postfix() {
    assert_eq!(pp("<?php $x++;"), "$x++;");
    assert_eq!(pp("<?php $x--;"), "$x--;");
}

#[test]
fn ternary() {
    assert_eq!(pp("<?php $a ? $b : $c;"), "$a ? $b : $c;");
    assert_eq!(pp("<?php $a ?: $b;"), "$a ?: $b;");
}

#[test]
fn null_coalesce() {
    assert_eq!(pp("<?php $a ?? $b;"), "$a ?? $b;");
}

#[test]
fn error_suppress() {
    assert_eq!(pp("<?php @foo();"), "@foo();");
}

// =============================================================================
// Precedence
// =============================================================================

#[test]
fn precedence_mul_over_add() {
    assert_eq!(pp("<?php $a + $b * $c;"), "$a + $b * $c;");
    assert_eq!(pp("<?php ($a + $b) * $c;"), "($a + $b) * $c;");
}

#[test]
fn precedence_right_associative_coalesce() {
    assert_eq!(pp("<?php $a ?? $b ?? $c;"), "$a ?? $b ?? $c;");
}

#[test]
fn precedence_right_associative_pow() {
    assert_eq!(pp("<?php $a ** $b ** $c;"), "$a ** $b ** $c;");
}

#[test]
fn precedence_left_associative_add() {
    // ($a - $b) - $c should not need parens (left-assoc)
    assert_eq!(pp("<?php $a - $b - $c;"), "$a - $b - $c;");
}

#[test]
fn precedence_logical_vs_assignment() {
    // `or` has lower precedence than `=`, so parser groups as ($a = $b) or $c
    // The Parenthesized node in the AST is preserved by the printer
    assert_eq!(pp("<?php $a = $b or $c;"), "($a = $b) or $c;");
}

#[test]
fn precedence_nested_ternary_needs_parens() {
    // PHP 8 forbids unparenthesized nested ternary — parser wraps in Parenthesized
    round_trip("<?php ($a ? $b : $c) ? $d : $e;");
}

// =============================================================================
// Calls, arrays, constructs
// =============================================================================

#[test]
fn function_call() {
    assert_eq!(pp("<?php foo(1, 2, 3);"), "foo(1, 2, 3);");
}

#[test]
fn named_args() {
    assert_eq!(pp("<?php foo(a: 1, b: 2);"), "foo(a: 1, b: 2);");
}

#[test]
fn spread_arg() {
    assert_eq!(pp("<?php foo(...$args);"), "foo(...$args);");
}

#[test]
fn by_ref_arg() {
    assert_eq!(pp("<?php sort(&$arr);"), "sort(&$arr);");
}

#[test]
fn array_literal() {
    assert_eq!(pp("<?php [1, 2, 3];"), "[1, 2, 3];");
    assert_eq!(pp("<?php ['a' => 1, 'b' => 2];"), "['a' => 1, 'b' => 2];");
}

#[test]
fn array_spread() {
    assert_eq!(pp("<?php [...$a, ...$b];"), "[...$a, ...$b];");
}

#[test]
fn array_access() {
    assert_eq!(pp("<?php $arr[$key];"), "$arr[$key];");
    assert_eq!(pp("<?php $arr[];"), "$arr[];");
}

#[test]
fn casts() {
    assert_eq!(pp("<?php (int)$x;"), "(int)$x;");
    assert_eq!(pp("<?php (string)$x;"), "(string)$x;");
    assert_eq!(pp("<?php (bool)$x;"), "(bool)$x;");
    assert_eq!(pp("<?php (array)$x;"), "(array)$x;");
    assert_eq!(pp("<?php (object)$x;"), "(object)$x;");
    assert_eq!(pp("<?php (float)$x;"), "(float)$x;");
}

#[test]
fn include_require() {
    assert_eq!(pp("<?php include 'foo.php';"), "include 'foo.php';");
    assert_eq!(
        pp("<?php include_once 'foo.php';"),
        "include_once 'foo.php';"
    );
    assert_eq!(pp("<?php require 'foo.php';"), "require 'foo.php';");
    assert_eq!(
        pp("<?php require_once 'foo.php';"),
        "require_once 'foo.php';"
    );
}

#[test]
fn isset_empty_eval() {
    assert_eq!(pp("<?php isset($a, $b);"), "isset($a, $b);");
    assert_eq!(pp("<?php empty($a);"), "empty($a);");
    assert_eq!(pp("<?php eval('echo 1;');"), "eval('echo 1;');");
}

#[test]
fn exit_expr() {
    assert_eq!(pp("<?php exit;"), "exit;");
    assert_eq!(pp("<?php exit(1);"), "exit(1);");
}

#[test]
fn print_expr() {
    assert_eq!(pp("<?php print 'hello';"), "print 'hello';");
}

#[test]
fn clone_expr() {
    assert_eq!(pp("<?php clone $obj;"), "clone $obj;");
}

#[test]
fn new_expr() {
    assert_eq!(pp("<?php new Foo(1, 2);"), "new Foo(1, 2);");
    assert_eq!(pp("<?php new Foo;"), "new Foo;");
}

// =============================================================================
// Statements
// =============================================================================

#[test]
fn echo_stmt() {
    assert_eq!(pp("<?php echo 'hello';"), "echo 'hello';");
    assert_eq!(pp("<?php echo $a, $b;"), "echo $a, $b;");
}

#[test]
fn return_stmt() {
    assert_eq!(pp("<?php return;"), "return;");
    assert_eq!(pp("<?php return 42;"), "return 42;");
}

#[test]
fn break_continue_with_level() {
    assert_eq!(pp("<?php break;"), "break;");
    assert_eq!(pp("<?php break 2;"), "break 2;");
    assert_eq!(pp("<?php continue;"), "continue;");
    assert_eq!(pp("<?php continue 3;"), "continue 3;");
}

#[test]
fn throw_stmt() {
    assert_eq!(
        pp("<?php throw new Exception('e');"),
        "throw new Exception('e');"
    );
}

#[test]
fn global_stmt() {
    assert_eq!(pp("<?php global $a, $b;"), "global $a, $b;");
}

#[test]
fn unset_stmt() {
    assert_eq!(pp("<?php unset($a, $b);"), "unset($a, $b);");
}

#[test]
fn static_var() {
    assert_eq!(pp("<?php static $x = 0;"), "static $x = 0;");
}

#[test]
fn declare_stmt() {
    assert_eq!(
        pp("<?php declare(strict_types=1);"),
        "declare(strict_types=1);"
    );
}

#[test]
fn const_stmt() {
    assert_eq!(pp("<?php const FOO = 42;"), "const FOO = 42;");
}

#[test]
fn goto_label() {
    let output = pp("<?php goto end; end:");
    assert!(output.contains("goto end;"), "got: {output}");
    assert!(output.contains("end:"), "got: {output}");
}

// =============================================================================
// Control flow
// =============================================================================

#[test]
fn if_simple() {
    assert_eq!(pp("<?php if ($x) { echo 1; }"), "if ($x) {\n    echo 1;\n}");
}

#[test]
fn if_else() {
    let output = pp("<?php if ($x) { echo 1; } else { echo 2; }");
    assert_eq!(output, "if ($x) {\n    echo 1;\n} else {\n    echo 2;\n}");
}

#[test]
fn if_elseif_else() {
    let output = pp("<?php if ($a) { echo 1; } elseif ($b) { echo 2; } else { echo 3; }");
    assert!(output.contains("} elseif ($b) {"), "got: {output}");
    assert!(output.contains("} else {"), "got: {output}");
}

#[test]
fn while_loop() {
    assert_eq!(
        pp("<?php while ($i < 10) { $i++; }"),
        "while ($i < 10) {\n    $i++;\n}"
    );
}

#[test]
fn for_loop() {
    let output = pp("<?php for ($i = 0; $i < 10; $i++) { echo $i; }");
    assert_eq!(output, "for ($i = 0; $i < 10; $i++) {\n    echo $i;\n}");
}

#[test]
fn foreach_loop() {
    assert_eq!(
        pp("<?php foreach ($arr as $v) { echo $v; }"),
        "foreach ($arr as $v) {\n    echo $v;\n}"
    );
}

#[test]
fn foreach_key_value() {
    assert_eq!(
        pp("<?php foreach ($arr as $k => $v) { echo $v; }"),
        "foreach ($arr as $k => $v) {\n    echo $v;\n}"
    );
}

#[test]
fn do_while() {
    assert_eq!(
        pp("<?php do { $i++; } while ($i < 10);"),
        "do {\n    $i++;\n} while ($i < 10);"
    );
}

#[test]
fn switch_stmt() {
    let output = pp("<?php switch ($x) { case 1: break; default: break; }");
    assert!(output.contains("switch ($x) {"), "got: {output}");
    assert!(output.contains("case 1:"), "got: {output}");
    assert!(output.contains("default:"), "got: {output}");
}

#[test]
fn try_catch_finally() {
    let output = pp("<?php try { foo(); } catch (Exception $e) { bar(); } finally { baz(); }");
    assert!(output.contains("try {"), "got: {output}");
    assert!(output.contains("} catch (Exception $e) {"), "got: {output}");
    assert!(output.contains("} finally {"), "got: {output}");
}

#[test]
fn multi_catch_types() {
    let output = pp("<?php try { foo(); } catch (A|B $e) { bar(); }");
    assert!(output.contains("catch (A|B $e)"), "got: {output}");
}

#[test]
fn match_expr() {
    let output = pp("<?php match($x) { 1 => 'one', 2, 3 => 'few', default => 'many' };");
    assert!(output.contains("match ($x) {"), "got: {output}");
    assert!(output.contains("1 => 'one',"), "got: {output}");
    assert!(output.contains("2, 3 => 'few',"), "got: {output}");
    assert!(output.contains("default => 'many',"), "got: {output}");
}

// =============================================================================
// Functions, closures, arrow functions
// =============================================================================

#[test]
fn function_decl() {
    let output = pp("<?php function add(int $a, int $b): int { return $a + $b; }");
    assert!(
        output.contains("function add(int $a, int $b): int"),
        "got: {output}"
    );
    assert!(output.contains("return $a + $b;"), "got: {output}");
}

#[test]
fn function_by_ref() {
    let output = pp("<?php function &foo() { return $x; }");
    assert!(output.contains("function &foo()"), "got: {output}");
}

#[test]
fn variadic_param() {
    let output = pp("<?php function f(int ...$args) {}");
    assert!(output.contains("int ...$args"), "got: {output}");
}

#[test]
fn by_ref_param() {
    let output = pp("<?php function f(&$x) {}");
    assert!(output.contains("&$x"), "got: {output}");
}

#[test]
fn param_with_default() {
    let output = pp("<?php function f($x = 42) {}");
    assert!(output.contains("$x = 42"), "got: {output}");
}

#[test]
fn closure_expr() {
    assert_eq!(
        pp("<?php $f = function($x) use ($y) { return $x + $y; };"),
        "$f = function($x) use ($y) {\n    return $x + $y;\n};"
    );
}

#[test]
fn static_closure() {
    let output = pp("<?php $f = static function() {};");
    assert!(output.contains("static function()"), "got: {output}");
}

#[test]
fn closure_by_ref_use() {
    let output = pp("<?php $f = function() use (&$x) {};");
    assert!(output.contains("use (&$x)"), "got: {output}");
}

#[test]
fn arrow_function() {
    assert_eq!(pp("<?php $f = fn($x) => $x * 2;"), "$f = fn($x) => $x * 2;");
}

#[test]
fn arrow_function_with_return_type() {
    let output = pp("<?php $f = fn(int $x): int => $x * 2;");
    assert!(
        output.contains("fn(int $x): int => $x * 2"),
        "got: {output}"
    );
}

// =============================================================================
// OOP
// =============================================================================

#[test]
fn class_decl() {
    let output = pp("<?php class Foo extends Bar implements Baz, Qux {}");
    assert!(
        output.contains("class Foo extends Bar implements Baz, Qux"),
        "got: {output}"
    );
}

#[test]
fn abstract_final_readonly_class() {
    let output = pp("<?php abstract class Foo {}");
    assert!(output.contains("abstract class Foo"), "got: {output}");

    let output = pp("<?php final class Foo {}");
    assert!(output.contains("final class Foo"), "got: {output}");

    let output = pp("<?php readonly class Foo {}");
    assert!(output.contains("readonly class Foo"), "got: {output}");
}

#[test]
fn class_property() {
    let output = pp("<?php class Foo { public int $x = 1; }");
    assert!(output.contains("public int $x = 1;"), "got: {output}");
}

#[test]
fn static_property() {
    let output = pp("<?php class Foo { public static int $count = 0; }");
    assert!(
        output.contains("public static int $count = 0;"),
        "got: {output}"
    );
}

#[test]
fn readonly_property() {
    let output = pp("<?php class Foo { public readonly string $name; }");
    assert!(
        output.contains("public readonly string $name;"),
        "got: {output}"
    );
}

#[test]
fn class_method() {
    let output = pp("<?php class Foo { public function bar(): void {} }");
    assert!(
        output.contains("public function bar(): void"),
        "got: {output}"
    );
}

#[test]
fn abstract_method() {
    let output = pp("<?php abstract class Foo { abstract public function bar(): void; }");
    assert!(
        output.contains("abstract public function bar(): void;"),
        "got: {output}"
    );
}

#[test]
fn class_const() {
    let output = pp("<?php class Foo { const BAR = 42; }");
    assert!(output.contains("const BAR = 42;"), "got: {output}");
}

#[test]
fn constructor_promotion() {
    let output = pp("<?php class Foo { public function __construct(public readonly int $x) {} }");
    assert!(output.contains("public readonly int $x"), "got: {output}");
}

#[test]
fn interface_decl() {
    let output = pp("<?php interface Foo extends Bar, Baz { public function hello(): void; }");
    assert!(
        output.contains("interface Foo extends Bar, Baz"),
        "got: {output}"
    );
}

#[test]
fn trait_decl() {
    let output = pp("<?php trait Foo { public function bar(): void {} }");
    assert!(output.contains("trait Foo"), "got: {output}");
}

#[test]
fn trait_use_simple() {
    let output = pp("<?php class Foo { use Bar, Baz; }");
    assert!(output.contains("use Bar, Baz;"), "got: {output}");
}

#[test]
fn enum_decl() {
    let output = pp("<?php enum Color: string { case Red = 'red'; case Blue = 'blue'; }");
    assert!(output.contains("enum Color: string"), "got: {output}");
    assert!(output.contains("case Red = 'red';"), "got: {output}");
    assert!(output.contains("case Blue = 'blue';"), "got: {output}");
}

#[test]
fn anonymous_class() {
    let output = pp("<?php new class extends Foo {};");
    assert!(output.contains("class extends Foo"), "got: {output}");
}

#[test]
fn attributes() {
    let output = pp("<?php #[Route('/api')] function handler(): void {}");
    assert!(output.contains("#[Route('/api')]"), "got: {output}");
}

#[test]
fn param_attribute() {
    let output = pp("<?php function f(#[FromQuery] int $page) {}");
    assert!(output.contains("#[FromQuery] int $page"), "got: {output}");
}

// =============================================================================
// OOP access
// =============================================================================

#[test]
fn property_access() {
    assert_eq!(pp("<?php $obj->prop;"), "$obj->prop;");
}

#[test]
fn nullsafe_property_access() {
    assert_eq!(pp("<?php $obj?->prop;"), "$obj?->prop;");
}

#[test]
fn method_call() {
    assert_eq!(pp("<?php $obj->method(1);"), "$obj->method(1);");
}

#[test]
fn nullsafe_method_call() {
    assert_eq!(pp("<?php $obj?->method();"), "$obj?->method();");
}

#[test]
fn static_const_access() {
    assert_eq!(pp("<?php Foo::BAR;"), "Foo::BAR;");
}

#[test]
fn static_property_access() {
    assert_eq!(pp("<?php Foo::$bar;"), "Foo::$bar;");
}

#[test]
fn static_method_call() {
    assert_eq!(pp("<?php Foo::bar(1);"), "Foo::bar(1);");
}

#[test]
fn first_class_callable() {
    assert_eq!(pp("<?php strlen(...);"), "strlen(...);");
    assert_eq!(pp("<?php $obj->method(...);"), "$obj->method(...);");
    assert_eq!(pp("<?php Foo::bar(...);"), "Foo::bar(...);");
}

// =============================================================================
// Generators
// =============================================================================

#[test]
fn yield_expr() {
    assert_eq!(pp("<?php yield;"), "yield;");
    assert_eq!(pp("<?php yield $val;"), "yield $val;");
    assert_eq!(pp("<?php yield $key => $val;"), "yield $key => $val;");
}

#[test]
fn yield_from() {
    assert_eq!(pp("<?php yield from $gen;"), "yield from $gen;");
}

// =============================================================================
// Type hints
// =============================================================================

#[test]
fn nullable_type() {
    let output = pp("<?php function f(?int $x): ?string {}");
    assert!(output.contains("?int $x"), "got: {output}");
    assert!(output.contains(": ?string"), "got: {output}");
}

#[test]
fn union_type() {
    let output = pp("<?php function f(int|string $x): void {}");
    assert!(output.contains("int|string $x"), "got: {output}");
}

#[test]
fn intersection_type() {
    let output = pp("<?php function f(Countable&Iterator $x): void {}");
    assert!(output.contains("Countable&Iterator $x"), "got: {output}");
}

// =============================================================================
// Namespace and use
// =============================================================================

#[test]
fn namespace_simple() {
    assert_eq!(pp("<?php namespace App\\Models;"), "namespace App\\Models;");
}

#[test]
fn namespace_braced() {
    let output = pp("<?php namespace App { class Foo {} }");
    assert!(output.contains("namespace App {"), "got: {output}");
}

#[test]
fn use_normal() {
    assert_eq!(pp("<?php use Foo\\Bar;"), "use Foo\\Bar;");
}

#[test]
fn use_alias() {
    assert_eq!(pp("<?php use Foo\\Bar as Baz;"), "use Foo\\Bar as Baz;");
}

#[test]
fn use_function() {
    assert_eq!(pp("<?php use function Foo\\bar;"), "use function Foo\\bar;");
}

#[test]
fn use_const() {
    assert_eq!(pp("<?php use const Foo\\BAR;"), "use const Foo\\BAR;");
}

// =============================================================================
// File output
// =============================================================================

#[test]
fn pretty_print_file() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, "<?php echo 'hello';");
    let output = php_printer::pretty_print_file(&result.program);
    assert_eq!(output, "<?php\n\necho 'hello';\n");
}

// =============================================================================
// Round-trip tests
// =============================================================================

#[test]
fn round_trip_expressions() {
    round_trip("<?php $a = 1 + 2 * 3;");
    round_trip("<?php echo 'hello';");
    round_trip("<?php return $a ?? $b;");
    round_trip("<?php $a ? $b : $c;");
    round_trip("<?php $x = (int)$y;");
    round_trip("<?php isset($a, $b);");
    round_trip("<?php $a instanceof Foo;");
}

#[test]
fn round_trip_function() {
    round_trip("<?php function foo(int $a, string $b): bool { return true; }");
}

#[test]
fn round_trip_class() {
    round_trip(
        "<?php class Foo extends Bar { public int $x = 1; public function hello(): void {} }",
    );
}

#[test]
fn round_trip_control_flow() {
    round_trip("<?php if ($x) { echo 1; } else { echo 2; }");
    round_trip("<?php for ($i = 0; $i < 10; $i++) { echo $i; }");
    round_trip("<?php foreach ($arr as $key => $val) { echo $val; }");
    round_trip("<?php while ($x) { $x--; }");
    round_trip("<?php do { $x++; } while ($x < 10);");
}

#[test]
fn round_trip_closure_arrow() {
    round_trip("<?php $f = function($x) use ($y) { return $x + $y; };");
    round_trip("<?php $f = fn($x) => $x * 2;");
}

#[test]
fn round_trip_try_catch() {
    round_trip("<?php try { foo(); } catch (Exception $e) { bar(); } finally { baz(); }");
}

#[test]
fn round_trip_match() {
    round_trip("<?php match($x) { 1 => 'one', default => 'other' };");
}

#[test]
fn round_trip_enum() {
    round_trip("<?php enum Color: string { case Red = 'red'; case Blue = 'blue'; }");
}

#[test]
fn round_trip_namespace_use() {
    round_trip("<?php namespace App\\Models;");
    round_trip("<?php use Foo\\Bar as Baz;");
}
