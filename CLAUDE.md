# PHP Parser - Development Guidelines

## Workspace Structure

- `crates/php-ast` — AST node definitions and types
- `crates/php-lexer` — tokenizer
- `crates/php-parser` — recursive-descent parser, tests, and snapshots

## Testing

**NEVER run `cargo test` without a filter.** The full test suite compiles 8+ test binaries and uses excessive memory.

Prefer `cargo nextest` (configured in `.config/nextest.toml` — runs each test in its own process):
```bash
cargo nextest run --test integration
cargo nextest run --test integration -- test_class_basic
```

Or with standard `cargo test`:
```bash
cargo test --test integration               # snapshot-based parser tests (includes nikic/PHP-Parser corpus)
cargo test --test php_syntax                # validates test fixtures via `php -l` (requires PHP installed)
cargo test --test integration test_class_basic  # single test by name
```

Snapshots live in `crates/php-parser/tests/snapshots/` (~817 files).
To accept new snapshots: `cargo insta accept`

## Before Submitting Changes

Run these checks — they match what CI enforces:

```bash
cargo fmt --all                              # format
cargo clippy --workspace -- -D warnings     # lint (warnings are errors)
cargo nextest run --test integration
```

## Benchmarks

Benchmark corpora (Laravel, Symfony, WordPress — ~15K PHP files) are git submodules.

```bash
cargo bench                    # run all benchmarks
critcmp main pr                # compare baselines
```

CI runs benchmarks on PRs (saves `pr` baseline) and on main (saves `main` baseline); a regression table is posted to the PR summary and HTML reports are uploaded as artifacts.
