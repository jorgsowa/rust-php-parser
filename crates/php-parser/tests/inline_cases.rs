/// Inline PHP source strings shared between the parser integration tests
/// (`integration.rs`) and the PHP syntax validation tests (`php_syntax.rs`).
///
/// All cases live in a single `CASES` slice.  Each entry carries optional
/// `min_php` / `max_php` bounds (defaulting to `Any` via the `case!` macro).
/// `php_syntax.rs` skips entries whose bounds the installed PHP cannot satisfy.
/// `integration.rs` runs every entry regardless (the Rust parser targets 8.5).
///
/// Adding a new case:
///   • valid on any supported PHP      → `case!("cat", "label", "<?php ...")`
///   • requires PHP X.Y+               → `case!(..., min: MinPhp::PhpXY)`
///   • valid only up to PHP X.Y        → `case!(..., max: MaxPhp::PhpXY)`
///   • both bounds                     → `case!(..., min: MinPhp::PhpXY, max: MaxPhp::PhpAB)`
#[allow(dead_code)]
#[derive(Clone, Copy, PartialEq, Eq, PartialOrd, Ord)]
pub enum MinPhp {
    Any,
    Php81,
    Php82,
    Php83,
    Php84,
    Php85,
}

#[allow(dead_code)]
#[derive(Clone, Copy, PartialEq, Eq, PartialOrd, Ord)]
pub enum MaxPhp {
    Any,
    Php84,
    Php83,
    Php82,
}

#[allow(dead_code)]
pub struct Case {
    pub category: &'static str,
    pub label: &'static str,
    pub source: &'static str,
    pub min_php: MinPhp,
    pub max_php: MaxPhp,
}

macro_rules! case {
    ($cat:expr, $label:expr, $src:expr) => {
        Case {
            category: $cat,
            label: $label,
            source: $src,
            min_php: MinPhp::Any,
            max_php: MaxPhp::Any,
        }
    };
    ($cat:expr, $label:expr, $src:expr, min: $min:expr) => {
        Case {
            category: $cat,
            label: $label,
            source: $src,
            min_php: $min,
            max_php: MaxPhp::Any,
        }
    };
    ($cat:expr, $label:expr, $src:expr, max: $max:expr) => {
        Case {
            category: $cat,
            label: $label,
            source: $src,
            min_php: MinPhp::Any,
            max_php: $max,
        }
    };
    ($cat:expr, $label:expr, $src:expr, min: $min:expr, max: $max:expr) => {
        Case {
            category: $cat,
            label: $label,
            source: $src,
            min_php: $min,
            max_php: $max,
        }
    };
}

pub const CASES: &[Case] = &[
    // clone
    case!("clone", "clone parenthesised", "<?php $copy = clone($obj);"),
    case!("clone", "clone parenthesised trailing comma", "<?php $copy = clone($obj, );", min: MinPhp::Php85),
    case!("clone", "clone first-class callable", "<?php $fn = clone(...);", min: MinPhp::Php85),
    case!("clone", "clone named arg", "<?php clone(object: $x);", min: MinPhp::Php85),
    case!("clone", "clone named args two", "<?php clone(object: $x, withProperties: ['foo' => 1]);", min: MinPhp::Php85),
    case!("clone", "clone three positional args", "<?php clone($x, $y, $z);", min: MinPhp::Php85),
    case!("clone", "clone spread arg", "<?php clone(...$args);", min: MinPhp::Php85),

    // cast_void
    case!("cast_void", "void cast", "<?php (void)$x;", min: MinPhp::Php85),
    case!("cast_void", "void cast call", "<?php (void)foo();", min: MinPhp::Php85),

    // error_suppress
    case!("error_suppress", "suppress chain", "<?php @$a->b()->c;"),
    case!("error_suppress", "suppress new", "<?php @(new Foo())->init();"),
    case!("error_suppress", "suppress include", "<?php @include 'optional.php';"),
    case!("error_suppress", "suppress array access", "<?php @$arr[$key];"),

    // declare
    case!("declare", "declare encoding", "<?php declare(encoding='UTF-8');"),
    case!("declare", "declare ticks inline", "<?php declare(ticks=1) echo 'tick';"),
    case!("declare", "declare strict", "<?php declare(strict_types=1);"),
    case!("declare", "declare with block", "<?php declare(ticks=1) { foo(); bar(); }"),
    case!("declare", "declare ticks value 100", "<?php declare(ticks=100);"),
    case!("declare", "declare alternative syntax", "<?php declare(ticks=1): echo 'tick'; enddeclare;"),
    case!("declare", "declare nested", "<?php declare(ticks=1) { declare(ticks=2); }"),

    // magic_constants
    case!("magic_constants", "all magic consts", "<?php echo __LINE__, __FILE__, __DIR__, __FUNCTION__, __CLASS__, __TRAIT__, __METHOD__, __NAMESPACE__;"),
    case!("magic_constants", "line in expression", "<?php $line = __LINE__ + 1;"),
    case!("magic_constants", "file in string", r#"<?php $f = "loaded from " . __FILE__;"#),
    case!("magic_constants", "dir concat", "<?php require __DIR__ . '/config.php';"),
    case!("magic_constants", "class in method", "<?php class Foo { public function name() { return __CLASS__; } }"),

    // string_interpolation
    case!("string_interpolation", "nested curly", r#"<?php $x = "Value: {$arr['key']}"; "#),
    case!("string_interpolation", "method in string", r#"<?php $x = "Name: {$obj->getName()}"; "#),
    case!("string_interpolation", "complex curly", r#"<?php $x = "{$a[$b][$c]}"; "#),
    case!("string_interpolation", "dollar brace", r#"<?php $x = "${name}s"; "#),
    case!("string_interpolation", "adjacent vars", r#"<?php $x = "$a$b$c"; "#),
    case!("string_interpolation", "var at end", r#"<?php $x = "hello $name"; "#),
    case!("string_interpolation", "escaped dollar", r#"<?php $x = "cost is \$5"; "#),
    case!("string_interpolation", "heredoc interp", "<?php $x = <<<EOT\nHello $name\nEOT;\n"),
    case!("string_interpolation", "chained in string", r#"<?php $x = "{$obj->items[0]->name}"; "#),
    case!("string_interpolation", "dynamic prop in string", r#"<?php $x = "{$obj->$prop}"; "#),
    case!("string_interpolation", "array var in string", r#"<?php $x = "item $arr[0] here"; "#),
    case!("string_interpolation", "prop var in string", r#"<?php $x = "name $obj->name here"; "#),
    case!("string_interpolation", "negative int index", r#"<?php $x = "item $arr[-1] here"; "#),
    case!("string_interpolation", "dollar-brace simple", r#"<?php $x = "${foo}bar"; "#),
    case!("string_interpolation", "dollar-brace array", r#"<?php $x = "${arr[0]}bar"; "#),
    case!("string_interpolation", "dollar-brace var-var", r#"<?php $name = 'x'; $x = "${$name}"; "#),
    case!("string_interpolation", "unicode escape null", r#"<?php $x = "\u{0}"; "#),
    case!("string_interpolation", "unicode escape emoji", r#"<?php $x = "\u{1F602}"; "#),
    case!("string_interpolation", "unicode escape in heredoc", "<?php $x = <<<EOT\n\\u{41}\nEOT;\n"),

    // heredoc
    case!("heredoc", "nowdoc basic", "<?php $x = <<<'EOT'\nhello world\nEOT;\n"),
    case!("heredoc", "heredoc indented close", "<?php $x = <<<EOT\n    hello\n    EOT;\n"),
    case!("heredoc", "heredoc in function arg", "<?php foo(<<<EOT\nhello\nEOT\n);\n"),
    case!("heredoc", "heredoc closing marker followed by )", "<?php foo(<<<EOT\nhello\nEOT);\n"),
    case!("heredoc", "heredoc closing marker followed by ,", "<?php $a = [<<<EOT\nhello\nEOT,\n\"world\"];\n"),
    case!("heredoc", "named arg with heredoc value", "<?php foo(bar: <<<EOT\nhello\nEOT\n);\n"),
    case!("heredoc", "named arg with heredoc closing marker followed by )", "<?php foo(bar: <<<EOT\nhello\nEOT);\n"),

    // operator_precedence
    case!("operator_precedence", "nested ternary", "<?php $a ? $b : ($c ? $d : $e);"),
    case!("operator_precedence", "null coalesce chain", "<?php $a ?? $b ?? $c ?? 'default';"),
    case!("operator_precedence", "mixed bitwise logical", "<?php $a & $b && $c | $d;"),
    case!("operator_precedence", "instanceof chain", "<?php $a instanceof Foo && $b instanceof Bar;"),
    case!("operator_precedence", "chained assignment", "<?php $a = $b = $c = 1;"),
    case!("operator_precedence", "assignment in ternary", "<?php $a = $b ? $c : $d;"),
    case!("operator_precedence", "comparison chain", "<?php $a == $b && $b == $c;"),
    case!("operator_precedence", "power assoc", "<?php $a ** $b ** $c;"),
    case!("operator_precedence", "unary in binary", "<?php !$a && !$b || !$c;"),
    case!("operator_precedence", "concat precedence", "<?php 'a' . 'b' . $c . 'd';"),
    case!("operator_precedence", "postfix in expr", "<?php $arr[$i++] = $j--;"),
    case!("operator_precedence", "error suppress complex", "<?php @$obj->method();"),
    case!("operator_precedence", "cast precedence", "<?php (int)$a + (string)$b;"),
    case!("operator_precedence", "spread in array", "<?php [...$a, ...$b, 1, 2];"),

    // assignment
    case!("assignment", "null coalesce assign", "<?php $a ??= 'default';"),
    case!("assignment", "concat assign", "<?php $str .= ' world';"),
    case!("assignment", "power assign", "<?php $x **= 2;"),
    case!("assignment", "ref assign", "<?php $a = &$b;"),
    case!("assignment", "array push", "<?php $arr[] = 'new';"),
    case!("assignment", "nested array push", "<?php $arr[][] = 'deep';"),
    case!("assignment", "list with keys", "<?php ['x' => $x, 'y' => $y] = getPoint();"),

    // expression_chains
    case!("expression_chains", "call result access", "<?php foo()[0];"),
    case!("expression_chains", "call result method", "<?php foo()->bar();"),
    case!("expression_chains", "new paren method", "<?php (new Foo())->bar();"),
    case!("expression_chains", "new paren prop", "<?php (new Foo)->prop;"),
    case!("expression_chains", "chained calls", "<?php $a->b()->c()->d();"),
    case!("expression_chains", "call result array method", "<?php $a->b()[0]->c();"),
    case!("expression_chains", "clone chain", "<?php clone $obj->getPrototype();"),
    case!("expression_chains", "new with chaining", "<?php (new Foo(1, 2))->init()->run();"),
    case!("expression_chains", "static call chain", "<?php Foo::create()->setup();"),
    case!("expression_chains", "nested new", "<?php new Foo(new Bar());"),
    case!("expression_chains", "double call", "<?php $factory()();"),
    case!("expression_chains", "array on new", "<?php (new Collection([1,2,3]))[0];"),

    // dynamic_access
    case!("dynamic_access", "dynamic prop", "<?php $obj->$prop;"),
    case!("dynamic_access", "dynamic prop expr", r#"<?php $obj->{$prefix . 'Name'};"#),
    case!("dynamic_access", "dynamic static", "<?php $class::$prop;"),
    case!("dynamic_access", "dynamic method", "<?php $obj->$method();"),
    case!("dynamic_access", "dynamic static method", "<?php $class::$method();"),
    case!("dynamic_access", "variable class new", "<?php new $className();"),
    case!("dynamic_access", "variable class static", "<?php $class::CONST_NAME;"),
    case!("dynamic_access", "quadruple var-var", r#"<?php $$$$quad = 1;"#),
    case!("dynamic_access", "var-var as array key", r#"<?php $arr[$$key] = 1;"#),
    case!("dynamic_access", "obj prop as var-var expr", r#"<?php ${$obj->name} = 'x';"#),
    case!("dynamic_access", "var-var in isset", r#"<?php isset($$name);"#),
    case!("dynamic_access", "var-var in unset", r#"<?php unset($$name);"#),

    // destructuring
    case!("destructuring", "nested array destruct", "<?php [[$a, $b], [$c, $d]] = $arr;"),
    case!("destructuring", "deep nesting", "<?php [$a, [$b, [$c, [$d]]]] = $arr;"),
    case!("destructuring", "keyed destruct", "<?php ['name' => $name, 'age' => $age] = $person;"),
    case!("destructuring", "mixed keyed/positional", "<?php [0 => $first, 'key' => $val] = $arr;"),
    case!("destructuring", "list nested", "<?php list($a, list($b, $c)) = $arr;"),

    // alternative_syntax
    case!("alternative_syntax", "if endif", "<?php if ($x): echo 1; elseif ($y): echo 2; else: echo 3; endif;"),
    case!("alternative_syntax", "while endwhile", "<?php while ($x): doStuff(); endwhile;"),
    case!("alternative_syntax", "for endfor", "<?php for ($i = 0; $i < 10; $i++): echo $i; endfor;"),
    case!("alternative_syntax", "foreach endforeach", "<?php foreach ($arr as $v): echo $v; endforeach;"),
    case!("alternative_syntax", "switch endswitch", "<?php switch ($x): case 1: echo 'one'; break; default: echo 'other'; endswitch;"),

    // control_flow
    case!("control_flow", "foreach destructure", "<?php foreach ($arr as [$key, $value]) { echo $key; }"),
    case!("control_flow", "foreach keyed destruct", "<?php foreach ($arr as $k => [$a, $b]) {}"),
    case!("control_flow", "switch default middle", "<?php switch ($x) { case 1: break; default: break; case 2: break; }"),
    case!("control_flow", "empty switch", "<?php switch ($x) {}"),
    case!("control_flow", "multiple braced ns", "<?php namespace A { function foo() {} } namespace B { function bar() {} }"),
    case!("control_flow", "empty braced ns", "<?php namespace A { }"),
    case!("control_flow", "global ns block", "<?php namespace { function main() {} }"),
    case!("control_flow", "for multi condition", "<?php for ($i=0; $a, $b; $i++) {}"),
    case!("control_flow", "for three init exprs", "<?php for ($a=0, $b=1, $c=2; $a < 10; $a++) {}"),
    case!("control_flow", "for complex update", "<?php for ($i=0; $i<10; $i++, $j--, $k+=2) {}"),
    case!("control_flow", "for all empty", "<?php for (;;) { break; }"),

    // try_catch
    case!("try_catch", "multi catch types", "<?php try { foo(); } catch (TypeError | ValueError $e) { echo $e; }"),
    case!("try_catch", "catch no var", "<?php try { foo(); } catch (Exception) { echo 'error'; }"),
    case!("try_catch", "multi catch blocks", "<?php try { foo(); } catch (A $a) { } catch (B $b) { } catch (C $c) { }"),
    case!("try_catch", "try finally no catch", "<?php try { foo(); } finally { cleanup(); }"),
    case!("try_catch", "catch rethrow", "<?php try { foo(); } catch (Exception $e) { throw $e; }"),
    case!("try_catch", "multi catch no var", "<?php try { foo(); } catch (TypeError | ValueError) { log(); }"),

    // match
    case!("match", "match multi conditions", "<?php $r = match($x) { 1, 2, 3 => 'low', 4, 5 => 'high' };"),
    case!("match", "match with default", "<?php $r = match(true) { $a > 0 => 'pos', default => 'other' };"),
    case!("match", "match in assignment", "<?php $y = match($x) { 'a' => 1, 'b' => 2, default => 0 };"),
    case!("match", "match nested", "<?php $r = match($a) { 1 => match($b) { 1 => 'aa', default => 'ab' }, default => 'x' };"),
    case!("match", "match throw", "<?php $r = match($x) { 1 => 'ok', default => throw new Exception() };"),
    case!("match", "match no default", "<?php $r = match($x) { 1 => 'one', 2 => 'two' };"),

    // function
    case!("function", "variadic typed", "<?php function foo(int ...$nums) {}"),
    case!("function", "nullable return", "<?php function foo(): ?int { return null; }"),
    case!("function", "union return", "<?php function foo(): int|string { return 1; }"),
    case!("function", "intersection param", "<?php function foo(Countable&Traversable $x) {}"),
    case!("function", "by ref return", "<?php function &getRef() { global $x; return $x; }"),

    // named_args
    case!("named_args", "mixed named args", "<?php foo(1, 2, name: 'test', other: true);"),
    case!("named_args", "named with spread", "<?php foo(...$extra, name: 'test');"),
    case!("named_args", "named in new", "<?php new Foo(x: 1, y: 2);"),
    case!("named_args", "named in method", "<?php $obj->method(key: 'val');"),
    case!("named_args", "keyword name fn", "<?php foo(fn: $x);"),
    case!("named_args", "keyword name list", "<?php foo(list: $x);"),
    case!("named_args", "keyword name null", "<?php foo(null: $x);"),
    case!("named_args", "keyword name true", "<?php foo(true: $x);"),
    case!("named_args", "keyword name false", "<?php foo(false: $x);"),
    case!("named_args", "keyword name for", "<?php foo(for: $x);"),
    case!("named_args", "keyword name while", "<?php foo(while: $x);"),
    case!("named_args", "named only spread", r#"<?php foo(...['name' => $x]);"#),

    // closure
    case!("closure", "static arrow", "<?php $fn = static fn($x) => $x * 2;"),
    case!("closure", "arrow returns arrow", "<?php $fn = fn($x) => fn($y) => $x + $y;"),
    case!("closure", "closure use by ref", "<?php $fn = function() use (&$a, &$b) { return $a + $b; };"),
    case!("closure", "closure with return type", "<?php $fn = function(int $x): string { return (string)$x; };"),
    case!("closure", "arrow with array", "<?php $fn = fn($x) => [$x, $x * 2];"),
    case!("closure", "arrow typed", "<?php $fn = fn(int $x): int => $x * 2;"),
    case!("closure", "arrow in array_map", "<?php array_map(fn($x) => $x * 2, $arr);"),
    case!("closure", "arrow with null coalesce", "<?php $fn = fn($x) => $x ?? 'default';"),
    case!("closure", "closure static typed", "<?php $fn = static function(int $x): int { return $x; };"),
    case!("closure", "arrow in ternary", "<?php $fn = $flag ? fn($x) => $x + 1 : fn($x) => $x - 1;"),
    case!("closure", "arrow in call", "<?php array_filter($arr, fn($x) => $x > 0);"),
    case!("closure", "closure immediately invoked", "<?php (function() { echo 'hi'; })();"),

    // arrow_function
    case!("arrow_function", "arrow fn value", "<?php $a = ['map' => fn($x) => $x * 2, 'filter' => fn($x) => $x > 0];"),
    case!("arrow_function", "arrow captures outer", "<?php $mult = fn($x) => $x * $factor;"),
    case!("arrow_function", "arrow nested capture", "<?php $fn = fn($x) => fn($y) => $x * $y * $base;"),
    case!("arrow_function", "arrow with match", "<?php $classify = fn($n) => match(true) { $n < 0 => 'neg', $n === 0 => 'zero', default => 'pos' };"),
    case!("arrow_function", "arrow never return type", "<?php $fn = fn(): int => 42;"),
    case!("arrow_function", "arrow nullable typed", "<?php $fn = fn(?string $s): ?int => $s ? strlen($s) : null;"),

    // generator
    case!("generator", "yield value", "<?php function gen() { yield 1; yield 2; }"),
    case!("generator", "yield key value", "<?php function gen() { yield 'a' => 1; yield 'b' => 2; }"),
    case!("generator", "yield from", "<?php function gen() { yield from [1, 2, 3]; }"),
    case!("generator", "yield from call", "<?php function gen() { yield from otherGen(); }"),
    case!("generator", "yield in assign", "<?php function gen() { $val = yield 'key' => 'value'; }"),
    case!("generator", "yield null", "<?php function gen() { yield; }"),

    // generator (yield/yield-from flag variants)
    case!("generator", "yield from array flag", "<?php function g() { yield from [1]; }"),
    case!("generator", "yield value flag", "<?php function g() { yield 1; }"),
    case!("generator", "yield bare flag", "<?php function g() { yield; }"),
    case!("generator", "yield key value flag", "<?php function g() { yield $k => $v; }"),

    // class
    case!("class", "abstract with interface", "<?php abstract class Foo implements Bar, Baz { abstract public function run(): void; }"),
    case!("class", "const visibility", "<?php class Foo { public const A = 1; protected const B = 2; private const C = 3; }"),
    case!("class", "promoted with defaults", "<?php class Foo { public function __construct(public readonly int $x, private string $y = 'default') {} }"),
    case!("class", "anon class full", "<?php $obj = new class(1) extends Base implements Iface1, Iface2 { public function run() {} };"),
    case!("class", "interface extends multi", "<?php interface Foo extends Bar, Baz { public function run(): void; }"),
    case!("class", "abstract method", "<?php abstract class Foo { abstract protected function bar(int $x): string; }"),
    case!("class", "readonly class", "<?php readonly class Point { public function __construct(public int $x, public int $y) {} }", min: MinPhp::Php82),

    // readonly_class
    case!("readonly_class", "readonly final class", "<?php readonly final class Foo {}", min: MinPhp::Php82),
    case!("readonly_class", "readonly final class with body", "<?php readonly final class Point { public function __construct(public int $x, public int $y) {} }", min: MinPhp::Php82),

    // enum
    case!("enum", "enum implements", "<?php enum Color implements HasLabel { case Red; public function label(): string { return 'red'; } }"),
    case!("enum", "enum const", "<?php enum Suit: string { const TOTAL = 4; case Hearts = 'H'; }"),
    case!("enum", "enum with use", "<?php enum Suit { use SuitTrait; case Hearts; }"),
    case!("enum", "pure enum", "<?php enum Direction { case North; case South; case East; case West; }"),
    case!("enum", "backed enum int", "<?php enum Status: int { case Active = 1; case Inactive = 0; }"),
    case!("enum", "enum static method", "<?php enum Color { case Red; public static function default(): self { return self::Red; } }"),
    case!("enum", "enum interface method", "<?php enum Suit: string implements \\Stringable { case Hearts = 'H'; public function __toString(): string { return $this->value; } }"),
    case!("enum", "enum from and tryFrom", "<?php Status::from(1); Status::tryFrom(99);"),

    // typed_class_constants (PHP 8.3+)
    case!("typed_class_constants", "typed int const", "<?php class A { const int X = 1; }", min: MinPhp::Php83),
    case!("typed_class_constants", "typed string const", "<?php class A { private const string Y = 'a'; }", min: MinPhp::Php83),
    case!("typed_class_constants", "typed union const", "<?php class A { const int|string Z = 1; }", min: MinPhp::Php83),
    case!("typed_class_constants", "typed nullable const", "<?php class A { const ?string N = null; }", min: MinPhp::Php83),

    // scope_resolution
    case!("scope_resolution", "self const", "<?php class Foo { const X = 1; public function f() { return self::X; } }"),
    case!("scope_resolution", "parent method", "<?php class Foo extends Bar { public function f() { parent::f(); } }"),
    case!("scope_resolution", "static late", "<?php class Foo { public static function create() { return new static(); } }"),
    case!("scope_resolution", "class const on name", "<?php echo Foo::class;"),
    case!("scope_resolution", "static prop", "<?php class Foo { public static int $count = 0; }"),
    case!("scope_resolution", "parent const", "<?php class Foo extends Bar { public function f() { return parent::VERSION; } }"),
    case!("scope_resolution", "static const", "<?php class Foo { public function f() { return static::DEFAULT; } }"),
    case!("scope_resolution", "self static prop", "<?php class Foo { public static $x = 1; public function f() { return self::$x; } }"),

    // type_hints
    case!("type_hints", "dnf complex", "<?php function f((A&B)|C $x) {}"),
    case!("type_hints", "dnf multi groups", "<?php function f((A&B)|(C&D) $x) {}"),
    case!("type_hints", "union with null", "<?php function f(int|string|null $x) {}"),
    case!("type_hints", "self return", "<?php class Foo { public function bar(): self {} }"),
    case!("type_hints", "static return", "<?php class Foo { public function bar(): static {} }"),
    case!("type_hints", "parent type", "<?php class Foo extends Bar { public function bar(): parent {} }"),
    case!("type_hints", "mixed type", "<?php function f(mixed $x): mixed {}"),
    case!("type_hints", "never return", "<?php function abort(): never { throw new Exception(); }"),
    case!("type_hints", "void return", "<?php function f(): void {}"),
    case!("type_hints", "iterable type", "<?php function f(iterable $x): iterable {}"),
    case!("type_hints", "callable type", "<?php function f(callable $x) {}"),
    case!("type_hints", "three intersection", "<?php function f(Countable&Traversable&ArrayAccess $x): void {}"),
    case!("type_hints", "standalone true", "<?php function f(): true { return true; }", min: MinPhp::Php82),
    case!("type_hints", "standalone false", "<?php function f(): false { return false; }", min: MinPhp::Php82),
    case!("type_hints", "true null union", "<?php function f(): true|null { return null; }", min: MinPhp::Php82),
    case!("type_hints", "false null union", "<?php function f(): false|null { return null; }", min: MinPhp::Php82),

    // attributes
    case!("attributes", "attr qualified name", "<?php #[\\App\\Attr] function foo() {}"),
    case!("attributes", "attr on param", "<?php function foo(#[Validate] int $x) {}"),
    case!("attributes", "attr complex args", "<?php #[Route('/api', methods: ['GET', 'POST'])] function handler() {}"),
    case!("attributes", "attr on enum case", "<?php enum Suit { #[Description('Hearts')] case Hearts; }"),
    case!("attributes", "stacked attrs", "<?php #[A] #[B] #[C] class Foo {}"),
    case!("attributes", "grouped attrs", "<?php #[A, B, C] class Foo {}"),

    // string_interpolation edge cases
    case!("string_interpolation", "array key identifier in string", r#"<?php $x = "$arr[foo] here";"#),
    case!("string_interpolation", "empty double-quoted", r#"<?php $x = "";"#),
    case!("string_interpolation", "empty heredoc", "<?php $x = <<<EOT\nEOT;\n"),
    case!("string_interpolation", "only escape sequences", r#"<?php $x = "\n\r\t\v\e\f\\\$\"";"#),
    case!("string_interpolation", "unicode max codepoint", r#"<?php $x = "\u{10FFFF}";"#),
    case!("string_interpolation", "var with bracket index in string", r#"<?php $x = "$arr[0] end";"#),
    case!("string_interpolation", "var then text then var", r#"<?php $x = "$a-$b";"#),

    // trait_use
    case!("trait_use", "alias visibility only", "<?php class C { use T { foo as protected; } }"),
    case!("trait_use", "alias qualified method", "<?php class C { use T { T::foo as bar; } }"),
    case!("trait_use", "alias qualified with visibility", "<?php class C { use T { T::foo as protected baz; } }"),
    case!("trait_use", "multiple traits", "<?php class C { use A, B, C; }"),
    case!("trait_use", "insteadof multi", "<?php class C { use A, B { A::m insteadof B; } }"),
    case!("trait_use", "multiple adaptations", "<?php class C { use A, B { A::m insteadof B; B::n as public nAlias; } }"),

    // numeric_literals
    case!("numeric_literals", "explicit octal", "<?php $x = 0o777;", min: MinPhp::Php81),
    case!("numeric_literals", "hex with underscores", "<?php $x = 0xFFFF_FFFF;"),
    case!("numeric_literals", "leading zero float", "<?php $x = 0.001;"),
    case!("numeric_literals", "negative exponent float", "<?php $x = 1.5e-10;"),
    case!("numeric_literals", "int max", "<?php $x = 9223372036854775807;"),
    case!("numeric_literals", "binary with underscores", "<?php $x = 0b1111_0000;"),
    case!("numeric_literals", "float no leading zero", "<?php $x = .5;"),
    case!("numeric_literals", "zero literal", "<?php $x = 0;"),
    case!("numeric_literals", "positive exponent float", "<?php $x = 2.5e+3;"),
    // float literal whose cleaned form (underscores removed) exceeds 128 bytes — regression
    // for a bug where the parse buffer was too small and digits were silently truncated
    case!("numeric_literals", "float literal exceeding 128 byte parse buffer", "<?php $x = 1.000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;"),

    // builtins
    case!("builtins", "list assign", "<?php list($a, $b) = $arr;"),
    case!("builtins", "short echo", "<?= $value ?>"),
    case!("builtins", "multiple echo", "<?php echo $a, $b, $c;"),
    case!("builtins", "die with arg", "<?php die('error');"),
    case!("builtins", "exit with code", "<?php exit(1);"),
    case!("builtins", "isset multi", "<?php if (isset($a, $b, $c)) {}"),
    case!("builtins", "unset multi", "<?php unset($a, $b);"),
    case!("builtins", "global multi", "<?php global $a, $b, $c;"),
    case!("builtins", "static var multi", "<?php function f() { static $a = 1, $b = 2; }"),
    case!("builtins", "eval", "<?php eval('echo 1;');"),
    case!("builtins", "require once", "<?php require_once 'autoload.php';"),
    case!("builtins", "include expr", "<?php include $dir . '/file.php';"),
];
