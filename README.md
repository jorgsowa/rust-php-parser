# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full AST with source spans, recovers from syntax errors, and covers the vast majority of PHP 8.x syntax.

> **Note:** The parser targets **PHP 8.4** by default. There is currently no version selection — all supported syntax from PHP 5.x through 8.4 is accepted without version-specific errors.

## Architecture

The project is a Cargo workspace with three crates:

| Crate | Purpose |
|-------|---------|
| **php-lexer** | Tokenizer built on [Logos](https://github.com/maciejhirsz/logos) (~100 token types) with special handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | AST type definitions — fully serializable via Serde |
| **php-parser** | Pratt-based recursive descent parser with panic-mode error recovery |

### Key design decisions

- **Pratt parsing** for expressions with a binding power table matching PHP's operator precedence
- **Keywords resolved from identifiers** at the lexer level (case-insensitive)
- **Error recovery** via synchronization — the parser produces a partial AST with `StmtKind::Error` / `ExprKind::Error` sentinel nodes and continues past syntax errors
- **Span tracking** on every AST node as `u32` byte offsets into the source

## Usage

```rust
use php_parser::parse;

let result = parse("<?php echo 'Hello, world!';");

// Full AST
println!("{:#?}", result.program);

// Any parse errors (parser continues past errors)
for err in &result.errors {
    println!("error at {:?}: {}", err.span(), err);
}
```

## Implemented Features

### Literals & Strings

- Integer literals (decimal, hex `0xFF`, binary `0b1010`, octal `077` / `0o77`) with underscore separators (`1_000_000`)
- Float literals (decimal, scientific `1e10`, leading dot `.5`) with underscore separators
- Single-quoted strings with `\'` / `\\` escapes
- Double-quoted strings with full escape sequences (`\n`, `\t`, `\x41`, `\u{1F600}`, etc.)
- String interpolation: `"Hello $name"`, `"$obj->prop"`, `"$arr[0]"`, `"{$expr}"`
- Heredoc (`<<<EOT ... EOT`) with interpolation
- Nowdoc (`<<<'EOT' ... EOT`)
- Boolean / null literals (case-insensitive)

### Operators

- Arithmetic: `+` `-` `*` `/` `%` `**`
- String concatenation: `.`
- Comparison: `==` `!=` `===` `!==` `<` `>` `<=` `>=` `<=>` `instanceof`
- Logical: `&&` `||` `!` `and` `or` `xor`
- Bitwise: `&` `|` `^` `~` `<<` `>>`
- Assignment: `=` `+=` `-=` `*=` `/=` `%=` `**=` `.=` `&=` `|=` `^=` `<<=` `>>=` `??=` `=&`
- Ternary: `? :` and short ternary `?:`
- Null coalescing: `??`
- Unary prefix: `++` `--` `-` `+` `!` `~` `@` `clone`
- Unary postfix: `++` `--`
- Casts: `(int)` `(float)` `(string)` `(bool)` `(array)` `(object)` `(unset)`

### Control Flow

- `if` / `elseif` / `else` (brace and alternative `:` / `endif` syntax)
- `while` / `do-while` (brace and alternative syntax)
- `for` / `foreach` (brace and alternative syntax)
- `switch` / `case` / `default` (brace and alternative syntax)
- `break` / `continue` with optional depth
- `goto` / labels
- `return`

### Functions

- Named function declarations
- Parameters with defaults, type hints, variadic (`...`), by-reference (`&`)
- Return type hints
- By-reference return (`function &foo()`)
- Named arguments in calls (`foo(name: $val)`)
- Argument unpacking (`foo(...$args)`)
- Anonymous functions / closures with `use()` clauses
- Static closures
- Arrow functions (`fn($x) => $x * 2`)
- Array destructuring: `[$a, $b] = $pair`, `[$x, , $z] = $arr`

### OOP

- Classes with `abstract`, `final`, `readonly` modifiers
- Properties with visibility, `static`, `readonly`, type hints, defaults
- Methods with visibility, `static`, `abstract`, `final`
- Constructor property promotion
- Class constants with visibility
- Single inheritance (`extends`) and multiple interfaces (`implements`)
- Interfaces with `extends`
- Traits and `use` declarations with conflict resolution (`insteadof`, `as` aliases with visibility)
- Enums — plain and backed (`: string`, `: int`) with cases, methods, constants
- Anonymous classes (`new class { ... }`) with constructor args, extends, implements
- `new`, `clone`, `instanceof`
- Property / method access: `->`, `?->` (nullsafe)
- Static access: `::` for properties, methods, constants
- `self`, `parent`, `static` references
- `::class` name resolution

### PHP 8 Attributes

- Single: `#[Pure]`
- Grouped: `#[A, B]`
- Stacked: `#[A] #[B]`
- With arguments: `#[Route("/api", methods: ["GET"])]`
- On classes, functions, methods, properties, parameters, enums, enum cases

### Type System

- Nullable types: `?int`
- Union types: `int|string|null`
- Intersection types: `Countable&Traversable`
- DNF types (PHP 8.2): `(A&B)|C`, `(A&B)|(C&D)`
- Built-in types: `int`, `float`, `string`, `bool`, `array`, `object`, `void`, `mixed`, `never`, `null`, `true`, `false`, `iterable`, `callable`

### Modern PHP

- Match expressions with multiple conditions and default arm
- Generators: `yield`, `yield $key => $value`, `yield from`
- Throw expressions (PHP 8)
- Null coalescing assignment `??=`
- Nullsafe operator `?->`
- First-class callable syntax: `strlen(...)`, `$obj->method(...)`, `Foo::bar(...)`

### Other

- PHP open/close tags, `<?=` short echo, `?>` as implicit semicolon
- Inline HTML
- `echo`, `print`, `exit` / `die`
- `isset()`, `empty()`, `eval()`, `unset()`
- `include` / `include_once` / `require` / `require_once`
- `declare(strict_types=1)`
- Qualified name expressions: `App\Models\User()`, `new App\Models\User()`
- Namespaces (simple and braced)
- `use` declarations with aliases, `use function`, `use const`, group use (`use App\{A, B}`)
- Top-level `const`
- Static variables (`static $x = 0`)
- Global declarations
- Magic constants (`__LINE__`, `__FILE__`, `__DIR__`, `__CLASS__`, `__FUNCTION__`, `__METHOD__`, `__NAMESPACE__`, `__TRAIT__`)
- All comments skipped (`//`, `#`, `/* */`)
- Variable variables: `$$var`, `$$$var`, `${expr}`
- Error suppression operator `@`
- Binary string prefix `b"..."`

### Error Handling

- Panic-mode synchronization — recovers and continues parsing
- `StmtKind::Error` / `ExprKind::Error` sentinel nodes in the AST
- Contextual error messages: "expected ';' after expression", "unclosed '(' opened at ..."
- Partial AST output even with syntax errors

## Not Yet Implemented

### Language Features
- Shell execution (backtick syntax: `` `command $var` ``)
- `__halt_compiler()`
- Hashbang/shebang line (`#!/usr/bin/env php`)
- `new` in initializers (PHP 8.1: `const C = new Foo;`, default parameter values)
- Property hooks (PHP 8.4: `get => 42; set { ... }`)
- Asymmetric visibility (PHP 8.4: `private(set)`)
- Pipe operator (`|>`, experimental)

### Known Limitations
- Heredoc in expression context (PHP 7.3+ flexible heredoc: concat, array, function args)
- Attributes on closure/arrow function expressions
- Fibers
- Named enum type backing validation
- Comment preservation in the AST
- Semantic analysis (scope tracking, type checking, symbol resolution)

## Testing

```sh
cargo test --workspace        # run all tests
cargo insta test              # review new snapshots
cargo clippy --workspace      # lint
```

The test suite uses [insta](https://insta.rs/) snapshot testing with YAML output. Fixture files live in `crates/php-parser/tests/fixtures/`.

## License

MIT
