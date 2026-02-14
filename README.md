# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full AST with source spans, recovers from syntax errors, and covers the vast majority of PHP 8.x syntax.

Inspired by and tested against the [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) test suite — the de facto reference PHP parser. The nikic fixture tests verify that this parser produces correct ASTs for the same inputs.

> **Note:** The parser targets **PHP 8.5** by default. There is currently no version selection — all supported syntax from PHP 5.x through 8.5 is accepted, with version-specific errors for removed features (e.g. `(unset)` cast).

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
- Heredoc (`<<<EOT ... EOT`) with interpolation, including binary prefix (`b<<<EOT`)
- Nowdoc (`<<<'EOT' ... EOT`)
- Shell execution (backtick syntax: `` `command $var` ``)
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
- Pipe operator: `|>` (PHP 8.4)
- Unary prefix: `++` `--` `-` `+` `!` `~` `@` `clone`
- Unary postfix: `++` `--`
- Casts: `(int)` `(float)` `(string)` `(binary)` `(bool)` `(array)` `(object)` `(void)` — `(unset)` is parsed but emits an error (removed in PHP 8.0)

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
- Asymmetric visibility (PHP 8.4): `protected private(set) $prop`
- Methods with visibility, `static`, `abstract`, `final`
- Constructor property promotion (PHP 8.0) with `final` promoted properties (PHP 8.4)
- Class constants with visibility, typed constants (PHP 8.3), and multi-item declarations
- Property hooks (PHP 8.4): `get`/`set` with expression or block bodies
- Single inheritance (`extends`) and multiple interfaces (`implements`)
- Interfaces with `extends`
- Traits and `use` declarations with conflict resolution (`insteadof`, `as` aliases with visibility)
- Enums — plain and backed (`: string`, `: int`) with cases, methods, constants — reserved names like `class` are rejected
- Anonymous classes (`new class { ... }`) with constructor args, extends, implements
- `new`, `clone`, `instanceof`
- `new` in initializers (PHP 8.1): `const C = new Foo;`, default parameter values
- Property / method access: `->`, `?->` (nullsafe)
- Static access: `::` for properties, methods, constants, dynamic (`::$var`, `::{$expr}`)
- `self`, `parent`, `static` references
- `::class` name resolution

### PHP 8 Attributes

- Single: `#[Pure]`
- Grouped: `#[A, B]`
- Stacked: `#[A] #[B]`
- With arguments: `#[Route("/api", methods: ["GET"])]`
- On classes, functions, methods, properties, parameters, enums, enum cases, top-level constants

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
- Hashbang/shebang line (`#!/usr/bin/env php`)
- `echo`, `print`, `exit` / `die`
- `isset()`, `empty()`, `eval()`, `unset()`
- `include` / `include_once` / `require` / `require_once`
- `declare(strict_types=1)`
- Qualified name expressions: `App\Models\User()`, `new App\Models\User()`
- Namespaces (simple and braced)
- `use` declarations with aliases, `use function`, `use const`, group use (`use App\{A, B}`), mixed group use (`use A\B\{C, function d, const E}`) — empty group use is rejected
- Top-level `const`
- Static variables (`static $x = 0`)
- Global declarations
- Magic constants (`__LINE__`, `__FILE__`, `__DIR__`, `__CLASS__`, `__FUNCTION__`, `__METHOD__`, `__NAMESPACE__`, `__TRAIT__`)
- Semi-reserved keywords as method/property/constant names
- All comments skipped (`//`, `#`, `/* */`)
- Variable variables: `$$var`, `$$$var`, `${expr}`
- Error suppression operator `@`
- Binary string prefix `b"..."`, `b<<<`
- `__halt_compiler()`
- Multi-property declarations: `public $a = 1, $b = 2;`

### Error Handling

- Panic-mode synchronization — recovers and continues parsing
- `StmtKind::Error` / `ExprKind::Error` sentinel nodes in the AST
- Partial AST output even with syntax errors

All errors returned are **parse errors** — they are detected during parsing based on token structure alone. The parser does not perform semantic analysis, so it does not report compile errors (e.g. "cannot redeclare function") or runtime errors. In PHP's own error classification:

- **Parse errors** (this parser) — invalid token sequences that violate the grammar, e.g. `if (}`, missing semicolons, unclosed brackets
- **Compile errors** (not reported) — syntactically valid code that violates compile-time rules, e.g. duplicate function declarations, `break` outside a loop, abstract method in non-abstract class
- **Runtime errors** (not reported) — errors that occur during execution, e.g. calling an undefined function, type mismatches, division by zero

The parser returns a `Vec<ParseError>` with the following variants, each carrying a `Span` pointing to the exact byte offset in source:

| Error | Description | Example |
|-------|-------------|---------|
| `Expected` | Expected a specific token or construct | "expected ';'", "expected 'class'", "'class' cannot be used as an enum case name" |
| `Unexpected` | Encountered an unexpected token | "unexpected token }" |
| `ExpectedExpression` | Expected an expression but found something else | `return +;` |
| `ExpectedStatement` | Expected a statement | misplaced tokens at top level |
| `ExpectedOpenTag` | Missing `<?php` or `<?=` open tag | source doesn't start with a PHP tag |
| `UnterminatedString` | String literal was not closed | `"hello` without closing quote |
| `ExpectedAfter` | Expected a token after a specific construct | "expected ';' after expression", "expected ')' after argument list" |
| `UnclosedDelimiter` | A bracket/paren/brace was opened but never closed | "unclosed '(' opened at 1:5" — includes the span of the opening delimiter |

A few errors straddle the parse/compile boundary — the parser reports them early because they are unambiguously invalid at the grammar level: `(unset)` cast (removed in PHP 8.0), `case class` in enums (reserved for `::class` resolution), and empty group use declarations (`use A\B\{}`).

## Future Plans

See **[ROADMAP.md](ROADMAP.md)** for a comprehensive breakdown with phases, dependencies, blockers, and difficulty analysis.

- **Comment preservation** — attach comments to AST nodes for use in formatters and linters
- **Semantic analysis** — scope tracking, type checking, symbol resolution as a separate pass
- **PHP version selection** — configure target PHP version to control which syntax is accepted and which errors are emitted
- **Incremental parsing** — re-parse only changed regions for IDE integration
- **Visitor / walker API** — trait-based AST traversal for analysis and transformation passes
- **Pretty printer** — AST-to-source output for code generation and refactoring tools
- **LSP integration** — use the parser as a backend for a PHP Language Server
- **WASM target** — compile to WebAssembly for browser-based PHP tooling

## Known Limitations

- Comment preservation in the AST
- Semantic analysis (scope tracking, type checking, symbol resolution)

## Testing

The test suite uses [insta](https://insta.rs/) snapshot testing with JSON output. Run individual test files to avoid excessive memory usage:

```sh
cargo test --test integration          # 264 hand-written integration tests
cargo test --test nikic_expr_tests     # 66 expression tests (nikic/PHP-Parser fixtures)
cargo test --test nikic_stmt_tests     # 150 statement tests
cargo test --test nikic_scalar_tests   # 12 scalar/literal tests
cargo test --test nikic_misc_tests     # 10 misc tests
cargo test --test nikic_error_tests    # 30 error handling tests
```

### Test Suite Status

| Suite | Passing | Total |
|-------|---------|-------|
| integration | 264 | 264 |
| nikic_expr_tests | 66 | 66 |
| nikic_stmt_tests | 150 | 150 |
| nikic_scalar_tests | 12 | 12 |
| nikic_misc_tests | 10 | 10 |
| nikic_error_tests | 30 | 30 |

All 532 tests pass. Fixture files live in `crates/php-parser/tests/fixtures/`.

## License

MIT
