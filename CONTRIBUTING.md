# Contributing

Thank you for your interest in contributing to rust-php-parser. This guide covers everything you need to go from a fresh clone to an open PR.

---

## Prerequisites

- **Rust** — latest stable toolchain (`rustup update stable`)
- **PHP** — PHP 8.2 or newer for `php -l` fixture validation (the test suite skips syntax checks if PHP is not installed but CI runs them)
- `cargo` and standard Rust tooling (`clippy`, `rustfmt`)

---

## Getting Started

```bash
git clone https://github.com/jorgsowa/rust-php-parser
cd rust-php-parser
cargo test          # all tests should pass
```

---

## Crate Layout

| Crate | Package name | Purpose |
|-------|--------------|---------|
| `crates/php-ast` | `php-ast` | AST node types, Visitor trait, ScopeVisitor, PHPDoc tag types |
| `crates/php-lexer` | `php-lexer` | Lazy tokenizer with peeking slots (arena-allocated) |
| `crates/php-parser` | `php-rs-parser` | Recursive-descent parser, PHPDoc parser, semantic analysis helpers |
| `crates/php-printer` | `php-printer` | Pretty printer (AST → PHP source) |
| `crates/php-test-macros` | `php-test-macros` | Internal proc macros for test generation (not published) |

All workspace dependencies are declared in the root `Cargo.toml`. Each crate's `Cargo.toml` uses `{ workspace = true }` for shared deps.

---

## Build & Test

```bash
# Run all tests
cargo test

# Run tests for a single crate
cargo test -p php-rs-parser
cargo test -p php-printer

# Run specific test suites
cargo test --test integration   # all .phpt parser fixture tests (including corpus)
cargo test --test php_syntax    # validate every fixture via `php -l`
cargo test --test malformed_php # error recovery and diagnostics
cargo test --test visitor       # visitor and scope-aware traversal
cargo test -p php-printer --test printer  # printer fixtures

# Regenerate expected AST/errors in all .phpt fixtures
UPDATE_FIXTURES=1 cargo test

# Benchmarks
cargo bench

# Linting and formatting
cargo clippy --all-targets -- -D warnings
cargo fmt --check
```

**Note:** The crate is named `php-rs-parser` in Cargo (not `php-parser`). Use `-p php-rs-parser` when targeting the parser crate specifically.

---

## Architecture Overview

See [docs/architecture/ROADMAP.md](docs/architecture/ROADMAP.md) for the project roadmap and feature dependency graph.

Key design decisions:

- **Arena allocation** — AST nodes are bump-allocated via `bumpalo`. The arena lifetime `'arena` threads through the entire AST. This gives excellent allocation performance but makes in-place mutation of pointer-behind fields unsound (see Visitor section below).
- **Lazy lexer** — Tokens are produced on demand, not pre-lexed into an array. The lexer has a small set of peeking slots.
- **Pratt parser for expressions** — Operator precedence is handled via a Pratt (top-down operator precedence) approach with binding-power tables. See `crates/php-parser/src/expr.rs`.
- **Error recovery** — The parser uses panic-mode recovery to produce a complete AST even for invalid PHP. Recovery points are statement boundaries.
- **Version gating** — `PhpVersion` controls which syntax is accepted. `parse_versioned()` targets older PHP versions. Version-specific parse paths are tagged in the source.

---

## Test Fixtures

**All PHP parsing and printing tests use `.phpt` fixture files. Never write inline PHP in Rust test code.**

### Fixture format (parser)

```
===config===          (optional)
min_php=8.1           skip php -l on older PHP; sets the parse target version
max_php=8.3           skip php -l on newer PHP

===source===          (required)
<?php ...

===errors===          (optional; presence means parser errors are expected)
error message text    one ParseError display message per line

===ast===             (optional; expected JSON AST — auto-generated)
{ ... }

===php_error===       (optional; auto-generated when php -l rejects the source)
PHP message from stderr
```

### Fixture format (printer)

```
===source===
<?php ...

===print===
expected pretty-printed output
```

### Fixture directories

```
crates/php-parser/tests/fixtures/
  categories/    feature-organized tests (enums, closures, match, traits, …)
  errors/        tests where the parser is expected to emit errors
  versioned/     version-specific syntax (use min_php to set target)
  corpus/        adapted from nikic/PHP-Parser test suite
  no_hang/       regression tests for parser hang issues

crates/php-printer/tests/fixtures/
```

### Adding a new test

1. Create a `.phpt` file in the appropriate directory (see [docs/development/ERRORS.md](docs/development/ERRORS.md) for the `errors/` vs `categories/` decision table).
2. Add `===source===` with the PHP code you want to test.
3. Run `UPDATE_FIXTURES=1 cargo test` — this generates `===ast===`, `===errors===`, and `===php_error===` automatically.
4. Review the generated output. If the AST looks correct, commit the fixture.
5. For version-specific syntax, add a `===config===` section with `min_php=X.Y`.

**Error vs categories decision:**

| Parser emits errors? | PHP rejects source? | Directory | Sections |
|----------------------|--------------------|-----------|---------------------------------|
| Yes | Yes | `errors/` | `===errors===` + `===php_error===` |
| Yes | No | `errors/` | `===errors===` only |
| No | Yes | `categories/` | `===php_error===` only |
| No | No | `categories/` | neither |

---

## Adding a New PHP Syntax Feature

A typical feature addition touches these files:

1. **`crates/php-ast/src/ast.rs`** — add a new node variant or field to the AST types
2. **`crates/php-lexer/src/lexer.rs`** — add new token type(s) if needed
3. **`crates/php-parser/src/stmt.rs`** or **`expr.rs`** — add the parse path
4. **`crates/php-printer/src/printer.rs`** — handle the new variant in the pretty printer
5. **`crates/php-ast/src/visitor.rs`** — add a `visit_` method and `walk_` free function for the new node
6. **Fixture files** — add `.phpt` tests in the appropriate `categories/` or `versioned/` directory

If the feature is version-gated:
- Add a version check in the parse path using `self.version` (a `PhpVersion` value)
- Add a `min_php=X.Y` config in the test fixture
- Emit a `ParseError::VersionTooLow` diagnostic when the feature is used below its minimum version

For complex new syntax, read an existing feature (e.g., match expressions in `expr.rs`, enums in `stmt.rs`) to understand the pattern before writing new code.

---

## Visitor API

See [docs/usage/VISITOR.md](docs/usage/VISITOR.md) for the full Visitor API reference.

The `Visitor` trait uses `ControlFlow<()>` returns so implementations can short-circuit traversal:
- Return `Continue(())` to continue
- Return `Break(())` to stop traversal early (skip a subtree or exit entirely)

**`VisitorMut` / `Fold` is not implemented.** Arena allocation makes in-place mutation of pointer-behind fields unsound. A `Fold` that rebuilds nodes into a new arena is the correct design but has not been built yet. If you need to transform an AST, parse into a fresh arena.

---

## Error System

See [docs/development/ERRORS.md](docs/development/ERRORS.md) for the full list of `ParseError` variants and when to emit each one.

Quick rules:
- Emit `ParseError::UnexpectedToken` for tokens that cannot appear in the current parse context.
- Emit `ParseError::VersionTooLow` when a feature is used below its minimum PHP version.
- Use the `error_node!` recovery mechanism for statement-level errors — it inserts an `StmtKind::Error` node so the tree stays complete.

---

## Coding Conventions

- **No `todo!()`, `unimplemented!()`, or `panic!()` in parser/lexer hot paths.** Prefer emitting a `ParseError` and recovering.
- **No linting suppressions** (`#[allow(...)]`, `_` prefix renames, etc.) — fix the root cause or delete dead code.
- **No inline PHP in Rust tests** — all PHP source lives in `.phpt` fixture files.
- **Arena lifetimes propagate** — when adding a new AST node that holds a reference, make sure its lifetime is `'arena`.
- Run `cargo fmt` and `cargo clippy -- -D warnings` before opening a PR.
- Commit messages use conventional commits style (e.g., `feat:`, `fix:`, `docs:`, `test:`, `refactor:`).

---

## Performance

Performance-sensitive changes should be benchmarked before and after:

```bash
cargo bench
```

Read the performance docs before making optimization changes:

1. [docs/performance/PERFORMANCE_ANALYSIS.md](docs/performance/PERFORMANCE_ANALYSIS.md) — overview and methodology
2. [docs/performance/CORPUS_ANALYSIS_MARCH2026.md](docs/performance/CORPUS_ANALYSIS_MARCH2026.md) — real-world corpus metrics (Laravel, Symfony, WordPress)
3. [docs/performance/MEMORY_OPTIMIZATION_MARCH2026.md](docs/performance/MEMORY_OPTIMIZATION_MARCH2026.md) — allocation tuning details
4. [docs/performance/OPTIMIZATION_ATTEMPT_MARCH2026.md](docs/performance/OPTIMIZATION_ATTEMPT_MARCH2026.md) — lessons learned, including failed approaches

**Key lesson:** profiling showed the lazy lexer with peeking slots outperforms a pre-lexed array approach. A branch-elimination change without profiling evidence caused a 13–125% regression. Measure first.

---

## Where to Get Help

- **Roadmap and architecture:** [docs/architecture/ROADMAP.md](docs/architecture/ROADMAP.md)
- **Error types:** [docs/development/ERRORS.md](docs/development/ERRORS.md)
- **Visitor API:** [docs/usage/VISITOR.md](docs/usage/VISITOR.md)
- **Test coverage:** [docs/analysis/COVERAGE_REPORT.md](docs/analysis/COVERAGE_REPORT.md)
- **GitHub Issues** — open an issue if you're unsure where to start or want to discuss a design before writing code
