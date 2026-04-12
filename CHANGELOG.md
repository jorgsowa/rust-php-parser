# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.6.0] - 2026-04-11

### Added

- **`ScopeVisitor` trait and `ScopeWalker`** (`php-ast`) — zero-allocation scope-aware AST traversal. Every visit method now receives a `&Scope<'src>` with the current namespace, class name, and function/method name. `ScopeWalker` wraps any `ScopeVisitor`, maintains scope automatically, and handles all PHP scope transitions (braced/simple namespaces, classes, interfaces, traits, enums, methods, closures, arrow functions, anonymous classes).

- **`NameStr<'arena, 'src>`** (`php-ast`) — unified binding type for `Variable` and `Identifier` expression nodes, replacing the previous `Cow<'src, str>` in `Variable`. Zero-copy for source-borrowed names; arena-owned for synthesised names.

- **`PhpVersion::Php74`** (`php-rs-parser`) — PHP 7.4 target added to `PhpVersion` enum. Deprecated casts (`(real)`, `(unset)`) are now gated on version and emit `VersionTooLow` diagnostics when targeting PHP 8.0+.

- **PHPDoc continuation lines** (`php-rs-parser`) — tag descriptions now accumulate indented continuation lines, matching PHPStan/Psalm behaviour.

### Fixed

- Panic on string slice at non-char boundary in the lexer (#139).
- Unterminated string literals now emit a proper `ParseError` instead of silently producing a malformed AST (#133).
- Missing version gates for deprecated casts and several PHP 8.x-only constructs (#131).
- Diagnostics: reject `void`/`never`/`mixed` in union positions, `static readonly`, and `abstract final` class (#130).
- Chained non-associative operators and bare ternary chains now emit errors in PHP 8 mode (#129).
- PHP version not threaded correctly through the interpolation sub-parser (#128).
- `declare(…)` in conditional position skipped in `php -l` validation to avoid false failures (#141).

### Changed (breaking)

- `ExprKind::Variable` changed from `Cow<'src, str>` to `NameStr<'arena, 'src>` (#132, #138). Code matching on `Variable(name)` should use `name.as_str()` or `name.deref()` instead of `name.as_ref()`.
- LSP utilities (`CommentMap`, `SymbolTable`) removed from `php-ast`; `SourceMap` moved to `php-rs-parser` and is now included directly in `ParseResult` (#117). Use `ScopeVisitor`/`ScopeWalker` for namespace-aware declaration enumeration.

---

## [0.5.0] - 2026-04-01

### Added

- **`SourceMap` in `ParseResult`** — `parse()` and `parse_versioned()` now return a pre-built `SourceMap` in `result.source_map`, eliminating the need for callers to construct one manually.
- **Source string in `ParseResult`** — `result.source` exposes the original source string, enabling span-to-text extraction without holding a separate reference.

### Fixed

- Unterminated block comments now emit a `ParseError` instead of silently truncating the token stream.

---

## [0.4.0] - 2026-03-28

### Added

- **`php-printer` crate** — new `php-printer` crate provides `pretty_print(&program)` and `pretty_print_file(&program)` for round-tripping AST back to PHP source. Round-trip stability is verified in the printer test suite.
- **PHPDoc parser** (`php-rs-parser`) — `php_rs_parser::phpdoc::parse()` parses structured doc comments into typed `PhpDocTag` variants (param, return, var, throws, template, property, method, deprecated, psalm/phpstan annotations). Doc comments are attached to function, class, method, property, and constant AST nodes.
- **Visitor API improvements** (`php-ast`) — `Visitor` trait upgraded to use `ControlFlow<()>` for early termination, with support for type hints, attributes, catch clauses, match arms, and closure use-vars. All walk functions are public.
- **Corpus test suite** — nikic/PHP-Parser fixtures integrated into the unified `.phpt` test runner; all fixtures validated via `php -l` in CI.
- **Fuzz target** — `cargo-fuzz` target with CI smoke test to catch panics on arbitrary input.
- **Nesting depth guard** — expression parser enforces a recursion limit to prevent stack overflow on deeply nested input.

### Fixed

- Incorrect AST for `=&` assignment, `&$var` array elements, and empty destructuring slots.
- Precedence bugs for concat, shift, and `instanceof` operators.
- Octal literals with digits 8 or 9 now parsed correctly.
- Trailing-dot float literals (`1.`) tokenised as `FloatLiteralSimple`.
- `<?php` opening tag is now matched case-insensitively.
- `abstract` modifier on properties and abstract methods in enums now rejected.

---

## [0.3.2] - 2026-04-01

### Bug Fixes

- **AST: `=&` by-reference assignment** — `$a =& $b` was previously
  indistinguishable from `$a = $b` in the AST. `AssignExpr` now carries a
  `by_ref: bool` field that is `true` for `=&`.
- **AST: `&$var` in array/list destructuring elements** — `[&$a]` and
  `list(&$a)` elements silently dropped the `&` from the AST.
  `ArrayElement` now carries a `by_ref: bool` field.
- **AST: empty destructuring slots** — `[$a, , $c]` and `list($a, , $c)`
  empty slots were emitted as `ExprKind::Null`, making them
  indistinguishable from literal `null` values. They are now emitted as
  the new `ExprKind::Omit` variant.
- **String parsing: dead code branch** — a branch in double-quoted string
  parsing would produce an empty `InterpolatedString` (dropping the
  expression) if a single-part string ended up with a non-literal part.
  The part is now preserved correctly.

### AST Changes (php-ast)

- `AssignExpr` has a new field `by_ref: bool`
  (serialized only when `true` to keep existing snapshots stable).
- `ArrayElement` has a new field `by_ref: bool`
  (serialized only when `true`).
- `ExprKind::Omit` is a new unit variant representing a skipped position
  in array or list destructuring.

---

## [0.3.1] - 2026-03-30

### Bug Fixes

- Fix `is_final`, `is_readonly` on `Param` and `by_ref` on `Arg` not
  being preserved in the AST.

---

## [0.3.0] - 2026-03-20

### Added

- **PHP version system** — `PhpVersion` enum (`Php80`–`Php85`); `parse_versioned()` API for version-targeted parsing. Syntax requiring a higher version is parsed into the AST but emits `VersionTooLow` diagnostics.
- **PHP 8.5 support** — `CloneWith` expression node, version-gated `clone()` argument forms.
- **`.phpt` fixture system** — all integration tests migrated to structured `.phpt` files (`===source===`, `===ast===`, `===errors===`, `===config===`). `UPDATE_FIXTURES=1` regenerates expected output.
- **Documentation structure** — `docs/` directory with architecture, performance, and development subdirectories.

### Fixed

- Ternary chaining rejected in PHP 8 mode.
- Overflowing integer literals promoted to float.
- Multi-byte UTF-8 characters preserved in single-quoted strings with escape sequences.
- `instanceof` operator precedence corrected.

---

## [0.2.1] - 2026-03-18

### Added

- 31 malformed PHP error recovery tests — validates parser resilience with intentionally malformed PHP code.
- 80+ new tests covering previously untested code paths.

---

## [0.2.0] - 2026-03-17

### Added

- **Lazy lexer with peeking slots** — replaced pre-lexed token array with arena-allocated lazy lexer.
- **Jump table dispatch in Pratt loop** — converted sequential if-statements to match-based routing.
- **Simple parameter fast path** — optimized common `$var` parameter pattern.

### Fixed

- Right-sized `ArenaVec` pre-allocation (5–10% memory savings).

---

## [0.1.0] - 2025-Q4

Initial release with core recursive descent PHP parser supporting PHP 8.3 syntax, arena allocation, zero-copy string borrowing, comprehensive error recovery, and nikic/PHP-Parser corpus compatibility.
