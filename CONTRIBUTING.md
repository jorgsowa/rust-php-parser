# Contributing

From fresh clone to open PR.

---

## Prerequisites

- **Rust** — latest stable toolchain (`rustup update stable`)
- **PHP** — PHP 8.2 or newer for `php -l` fixture validation (the test suite skips syntax checks if PHP is not installed but CI runs them)
- `cargo` and standard Rust tooling (`clippy`, `rustfmt`)

---

## Getting started

```bash
git clone https://github.com/jorgsowa/rust-php-parser
cd rust-php-parser
cargo test          # all tests should pass
```

---

## Crate layout

| Crate | Package name | Purpose |
|-------|--------------|---------|
| `crates/php-ast` | `php-ast` | AST node types; arena `Visitor`/`ScopeVisitor`/`Fold` traits; owned `OwnedVisitor`/`OwnedScopeVisitor`/`FoldOwned` traits |
| `crates/php-lexer` | `php-lexer` | Lazy tokenizer with peeking slots (arena-allocated) |
| `crates/php-parser` | `php-rs-parser` | Recursive-descent parser, PHPDoc parser, source map, semantic analysis helpers |
| `crates/phpdoc-parser` | `phpdoc-parser` | Standalone structural PHPDoc block parser |
| `crates/php-printer` | `php-printer` | Pretty printer (AST → PHP source); supports both arena and owned AST |
| `crates/php-wasm` | `php-wasm` | WebAssembly bindings exposing the parser and printer to JavaScript |

The root `Cargo.toml` declares all workspace dependencies. Each crate's `Cargo.toml` uses `{ workspace = true }` for shared deps.

---

## Build & test

```bash
# Run all tests
cargo test

# Run tests for a single crate
cargo test -p php-rs-parser
cargo test -p php-printer
cargo test -p phpdoc-parser

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

## Architecture overview

- **Arena allocation** — AST nodes are bump-allocated via `bumpalo`. The arena lifetime `'arena` threads through the entire AST. This gives excellent allocation performance but makes in-place mutation of pointer-behind fields unsound (see Visitor section below).
- **Owned mirror types** — `php_ast::owned` provides lifetime-free `Box<str>`/`Box<[T]>` mirrors of every arena type. `parse()` converts to owned automatically; use `to_owned_program()` directly if you hold an arena result. Serialization is byte-for-byte identical to the arena types.
- **Lazy lexer** — Tokens are produced on demand, not pre-lexed into an array. The lexer has a small set of peeking slots.
- **Pratt parser for expressions** — Operator precedence is handled via a Pratt (top-down operator precedence) approach with binding-power tables. See `crates/php-parser/src/expr.rs`.
- **Error recovery** — The parser uses panic-mode recovery to produce a complete AST even for invalid PHP. Recovery points are statement boundaries; unrecoverable nodes become `StmtKind::Error` or `ExprKind::Error`.
- **Version gating** — `PhpVersion` controls which syntax is accepted. `parse_versioned()` targets older PHP versions. Version-specific parse paths emit `ParseError::VersionTooLow` rather than failing.

---

## Test fixtures

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

1. Create a `.phpt` file in the appropriate directory (see the decision table below).
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

## Adding a new PHP syntax feature

These files typically need changing:

1. **`crates/php-ast/src/ast/`** — add a new node variant or field to the AST types (choose the appropriate sub-module: `names.rs`, `exprs.rs`, `stmts.rs`, `decls.rs`, or `misc.rs`)
2. **`crates/php-ast/src/owned/mod.rs`** — add the owned mirror type for the new node
3. **`crates/php-lexer/src/lexer.rs`** — add new token type(s) if needed
4. **`crates/php-parser/src/stmt.rs`** or **`expr.rs`** — add the parse path
5. **`crates/php-printer/src/printer/`** — handle the new variant in the pretty printer (choose the appropriate sub-module: `stmts.rs`, `decls.rs`, `exprs.rs`, `types.rs`, or `helpers.rs`)
6. **`crates/php-ast/src/visitor.rs`** — add a `visit_` method and `walk_` free function for the new node
7. **`crates/php-ast/src/fold.rs`** — add a `fold_` method and free function for the new node (arena `Fold` trait)
8. **`crates/php-ast/src/owned/visitor.rs`** and **`owned/fold.rs`** — add corresponding owned visitor and fold hooks
9. **Fixture files** — add `.phpt` tests in the appropriate `categories/` or `versioned/` directory

If the feature is version-gated:
- Add a version check in the parse path using `self.version` (a `PhpVersion` value)
- Add a `min_php=X.Y` config in the test fixture
- Emit a `ParseError::VersionTooLow` diagnostic when the feature is used below its minimum version

For complex new syntax, read an existing feature (e.g., match expressions in `expr.rs`, enums in `stmt.rs`) to understand the pattern before writing new code.

---

## Visitor API

Two parallel visitor families depending on which AST form you hold:

**Arena visitors** (`crates/php-ast/src/visitor.rs`) — operate on `Program<'arena, 'src>` from `parse_arena()`:
- `Visitor<'arena, 'src>` — read-only traversal; override only the node types you care about, defaults recurse automatically.
- `ScopeVisitor<'arena, 'src>` + `ScopeWalker` — scope-aware traversal; each visit method receives a `&Scope<'src>` with the current namespace, class, and function name. `ScopeWalker::new` requires `src: &'src str`.

**Owned visitors** (`crates/php-ast/src/owned/visitor.rs`) — operate on `owned::Program` from `parse()`:
- `OwnedVisitor` — read-only traversal with no lifetime parameters; pairs with `walk_owned_*` free functions.
- `OwnedScopeVisitor` + `OwnedScopeWalker` — scope-aware owned traversal; each visit method receives an `OwnedScope`.

All visitor traits use `ControlFlow<()>` returns:
- Return `Continue(())` to continue recursion
- Return `Break(())` to stop traversal early
- Return `Continue(())` without calling the matching `walk_*` free function to visit a node but skip its subtree

**`VisitorMut` is not implemented.** Arena allocation makes in-place mutation of pointer-behind fields unsound.

For AST transformation, use one of the two `Fold` traits:
- **`Fold<'src>`** (`crates/php-ast/src/fold.rs`) — arena-to-arena transformation; takes a source arena and a destination arena. Override only the nodes you want to transform; others are copied identically.
- **`FoldOwned`** (`crates/php-ast/src/owned/fold.rs`) — owned-to-owned transformation; no lifetimes. Use with the result of `php_rs_parser::parse()`.

---

## Error system

See [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs) for the full list of `ParseError` variants and when to emit each one.

| Variant | When to emit |
|---------|-------------|
| `Expected { expected, found, span }` | A specific token was required but a different one was found. |
| `ExpectedExpression { span }` | An expression was required but the token stream had none (e.g. empty parentheses). |
| `ExpectedStatement { span }` | A statement was expected but the token stream had none. |
| `ExpectedOpenTag { span }` | The source did not start with `<?php` or `<?`. |
| `UnterminatedString { span }` | A string literal was opened but never closed. |
| `ExpectedAfter { expected, after, span }` | A required token was absent after a named construct. |
| `UnclosedDelimiter { delimiter, opened_at, span }` | A `(`, `[`, or `{` was opened and never closed. |
| `Forbidden { message, span }` | A syntactically valid but semantically illegal construct (e.g. wrong modifiers, invalid destructuring target). Equivalent to a PHP fatal error. |
| `ForbiddenWarning { message, span }` | A construct that PHP only warns about (e.g. `final private` method). `severity()` returns `Severity::Warning`; does not prevent a successful parse result. |
| `VersionTooLow { feature, required, used, span }` | Syntax that requires a newer PHP version than the parse target. |

Quick rules:
- Prefer `Forbidden` for one-declaration, one-parameter-list, or one-modifier-set checks — anything decidable from the local parse context.
- Use `ForbiddenWarning` for constructs that PHP itself only warns about.
- Emit `VersionTooLow` when the source uses a feature below its minimum PHP version.
- Use the `error_node!` recovery mechanism for statement-level errors — it inserts a `StmtKind::Error` node so the tree stays structurally complete.

---

## Coding conventions

- **No `todo!()`, `unimplemented!()`, or `panic!()` in parser/lexer hot paths.** Prefer emitting a `ParseError` and recovering.
- **No linting suppressions** (`#[allow(...)]`, `_` prefix renames, etc.) — fix the root cause or delete dead code.
- **No inline PHP in Rust tests** — all PHP source lives in `.phpt` fixture files.
- **Arena lifetimes propagate** — when adding a new AST node that holds a reference, make sure its lifetime is `'arena`.
- Run `cargo fmt` and `cargo clippy -- -D warnings` before opening a PR.
- Commit messages use conventional commits style (e.g., `feat:`, `fix:`, `docs:`, `test:`, `refactor:`).

---

## Performance

Benchmark performance-sensitive changes before and after:

```bash
cargo bench
```

**Key lesson:** profiling showed the lazy lexer with peeking slots outperforms a pre-lexed array approach. A branch-elimination change without profiling evidence caused a 13–125% regression. Measure first.

---

## Where to get help

- **AST node types:** [`docs.rs/php-ast/ast`](https://docs.rs/php-ast/latest/php_ast/ast/index.html)
- **Full API reference:** [`docs.rs/php-rs-parser`](https://docs.rs/php-rs-parser), [`docs.rs/php-ast`](https://docs.rs/php-ast), [`docs.rs/php-lexer`](https://docs.rs/php-lexer), [`docs.rs/php-printer`](https://docs.rs/php-printer)
- **Error types:** [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs)
- **Visitor API:** [`crates/php-ast/src/visitor.rs`](crates/php-ast/src/visitor.rs)
- **GitHub Issues** — open an issue if you're unsure where to start or want to discuss a design before writing code
