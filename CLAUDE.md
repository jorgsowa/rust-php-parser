# rust-php-parser

A fast PHP parser written in Rust that produces a typed AST. Supports PHP 8.0–8.5.

## Crates

- **php-ast** — AST types, visitor trait, PHPDoc tag types
- **php-lexer** — Lazy lexer with peeking slots (arena-allocated)
- **php-parser** (`php-rs-parser`) — Parser producing typed AST, includes PHPDoc parser
- **php-printer** — Pretty printer for AST-to-PHP source output
- **php-test-macros** — Internal proc macros for test generation

## Build & Test

```bash
cargo test                           # run all tests
cargo test -p php-rs-parser          # parser tests only
cargo test -p php-printer            # printer tests only
UPDATE_FIXTURES=1 cargo test         # regenerate expected AST/errors in .phpt fixtures
cargo bench                          # benchmarks
```

Note: the parser crate is named `php-rs-parser` in Cargo (not `php-parser`).

`build.rs` detects the installed PHP version and sets `cfg` flags (`php_available`, `php_min_81`..`php_min_85`) used to conditionally run PHP syntax validation tests.

## Test Structure

All PHP parser and printer tests use `.phpt` fixture files — no inline PHP in Rust test code.

### Parser fixtures (`crates/php-parser/tests/fixtures/`)

Format:
```
===config===          (optional)
min_php=8.1           (skip php-lint on older PHP)
parse_version=8.4     (parse targeting a specific PHP version)
===source===          (required)
<?php ...
===errors===          (optional; presence means errors are expected)
error message text
===ast===             (optional; expected JSON AST)
{ ... }
```

Subdirectories:
- `categories/` — organized by feature (enum, closure, match, etc.)
- `errors/` — error-expected fixtures
- `versioned/` — version-specific parse tests (use `parse_version`)
- `corpus/` — adapted from nikic/PHP-Parser
- `no_hang/` — regression tests for parser hang issues

### Printer fixtures (`crates/php-printer/tests/fixtures/`)

Format:
```
===source===
<?php ...
===print===
expected pretty-printed output
```

The printer fixture runner also verifies round-trip stability (parse -> print -> reparse -> reprint).

### Test runners

- `integration.rs` — runs all `.phpt` parser fixtures (recursive, including corpus/)
- `php_syntax.rs` — validates fixture PHP source via `php -l`
- `visitor.rs` — visitor API integration tests
- `malformed_php.rs` — programmatic tests (dynamically generated input)
- `printer.rs` — runs all `.phpt` printer fixtures

### Adding a new test

1. Create a `.phpt` file in the appropriate fixtures directory
2. Add `===source===` with the PHP code
3. Run `UPDATE_FIXTURES=1 cargo test` to generate `===ast===` and `===errors===`
4. For version-specific syntax, add `===config===` with `min_php=X.Y`

## Architecture

- Arena allocation via `bumpalo` — AST nodes are bump-allocated for performance
- Lazy lexer with peeking slots (not pre-lexed array)
- Parser targets PHP 8.5 by default; `parse_versioned()` for older targets
- PHPDoc parser at `php_rs_parser::phpdoc::parse()`

## CI

- Tests run against PHP 8.2, 8.3, 8.4, 8.5
- `php -l` syntax validation against all fixture files
- Clippy, fmt, fuzz smoke test, benchmarks
