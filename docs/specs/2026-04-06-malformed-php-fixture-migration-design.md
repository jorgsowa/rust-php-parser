# Design: Migrate malformed_php.rs to `.phpt` fixture files

**Date:** 2026-04-06  
**Status:** Approved

---

## Problem

The test suite has two parallel systems for invalid-PHP tests that each capture half the picture:

- `malformed_php.rs` — inline Rust functions with `assert_errors_snapshot!` (snapshots error messages only, not AST) and `assert_parses_clean!` (no snapshot at all)
- `tests/fixtures/errors/*.phpt` — auto-discovered fixtures (snapshots AST only, not error messages)

No single test captures both the error messages and the partial AST together. Adding a new error test requires editing Rust source. Inline PHP strings embedded in Rust are unreadable for multi-line cases.

---

## Goal

Converge error-case tests onto the same `.phpt` fixture convention used by the rest of the suite, with a combined snapshot that captures both error messages and the partial AST in one insta-managed snapshot file.

---

## `.phpt` File Format

Error fixtures live in `tests/fixtures/errors/`. An `===errors===` marker signals "assert at least one error was produced." The section body is empty — errors appear in the snapshot, not the fixture.

```
===source===
<?php declare(
===errors===
```

Version gating via `===config===` continues to work:

```
===config===
min_php=8.4
===source===
<?php ...
===errors===
```

Rules:
- `===errors===` must appear after `===source===`
- Section body is ignored (the marker is a flag, not content)
- A fixture without `===errors===` is a happy-path fixture (existing behaviour)

---

## `FixtureConfig` change

`common::parse_fixture()` adds `expect_errors: bool` to `FixtureConfig`:

```rust
pub struct FixtureConfig {
    pub min_php: Option<(u32, u32)>,
    pub expect_errors: bool,   // true when ===errors=== marker is present
}
```

Parsing: after extracting the source slice, scan the remainder for the literal string `===errors===`. If found, set `expect_errors = true`.

---

## Snapshot format

`common.rs` gains a new helper alongside the existing `fixture()`:

```rust
pub fn fixture_with_errors(
    source: &str,
    errors: &[impl ToString],
    program: &php_ast::Program,
) -> String {
    format!(
        "=== source ===\n{source}\n=== errors ===\n{}\n=== snapshot ===\n{}\n",
        errors.iter().map(|e| e.to_string()).collect::<Vec<_>>().join("\n"),
        to_json(program),
    )
}
```

The existing `fixture()` used by happy-path tests is unchanged.

---

## Test runner changes (`integration.rs`)

`error_fixtures()` currently asserts errors and snapshots only the AST. It changes to:

1. Call `common::parse_fixture()` to get `(config, source)`
2. Assert `!result.errors.is_empty()`
3. Call `fixture_with_errors(source, &result.errors, &result.program)` for the snapshot

No other changes to `integration.rs`.

---

## `malformed_php.rs` after migration

| Before | After |
|---|---|
| ~35 `assert_errors_snapshot!` tests | Deleted — replaced by `.phpt` files in `fixtures/errors/` |
| ~12 `assert_parses_clean!` tests | Moved to regular `tests/fixtures/` (happy-path, no errors) |
| 2 programmatic depth-limit tests | Kept — cannot be expressed as static fixture files |
| `assert_errors_snapshot!` macro | Deleted |
| `assert_parses_clean!` macro | Deleted |
| ~506 lines | ~30 lines |

---

## Fixture file migration

Each inline `assert_errors_snapshot!("<?php ...")` test in `malformed_php.rs` becomes a `.phpt` file:

```
# tests/fixtures/errors/declare_incomplete_paren.phpt
===source===
<?php declare(
===errors===
```

The 17 existing `fixtures/errors/*.phpt` files each gain `===errors===` appended to signal they are error fixtures. Their existing insta snapshots are regenerated (one-time `cargo insta accept` pass to update to the new combined format).

`assert_parses_clean!` cases become plain `.phpt` files in `tests/fixtures/` (no `===errors===`), picked up by the existing happy-path auto-discovery in `integration.rs`.

---

## Out of scope

- Changes to corpus tests
- Changes to `php_syntax.rs` or `inline_cases.rs`
- Changing how `cargo insta review` works
