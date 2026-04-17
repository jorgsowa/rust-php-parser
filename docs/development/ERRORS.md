# Error System

The parser never fails fatally — it always produces a complete AST. Errors are accumulated in a `Vec<ParseError>` and returned alongside the AST in `ParseResult`. This document explains the error types, how they are reported, and how to test them.

---

## `ParseError` enum

Defined in `crates/php-parser/src/diagnostics.rs`. Each variant carries a [`Span`] and implements `Display` via `thiserror`. The `Display` text is what appears in `===errors===` fixture sections.

| Variant | Display message |
|---------|----------------|
| `Expected { expected, found, span }` | `expected {expected}, found {found}` |
| `ExpectedExpression { span }` | `expected expression` |
| `ExpectedStatement { span }` | `expected statement` |
| `ExpectedOpenTag { span }` | `expected opening PHP tag` |
| `UnterminatedString { span }` | `unterminated string literal` |
| `ExpectedAfter { expected, after, span }` | `expected {expected} after {after}` |
| `UnclosedDelimiter { delimiter, opened_at, span }` | `unclosed {delimiter} opened at {opened_at:?}` |
| `Forbidden { message, span }` | `{message}` |
| `VersionTooLow { feature, required, used, span }` | `'{feature}' requires PHP {required} or higher (targeting PHP {used})` |

### Emitting an error in the parser

Call `parser.error(ParseError::Variant { ... })` anywhere inside a parsing function. The `Parser::error` method appends to `self.errors` (capped at `MAX_ERRORS` to prevent runaway output).

```rust
parser.error(ParseError::Expected {
    expected: "';'".into(),
    found: parser.current_kind(),
    span: parser.current_span(),
});
```

---

## Fixture sections

`.phpt` fixture files have two independent error-related sections:

### `===errors===` — Rust parser errors

Lists one `ParseError` `Display` message per line, in emission order. Its presence asserts that the Rust parser emits at least one error; its absence asserts zero errors.

**This section has no effect on `php_syntax.rs`** — it is checked only by `integration.rs`.

Run `UPDATE_FIXTURES=1 cargo test` to auto-populate or refresh this section.

### `===php_error===` — PHP's rejection message

Present when `php -l` must reject the fixture source. The `php_syntax.rs` test asserts that `php -l` fails and that its stderr matches the stored string (modulo stack traces, which are stripped).

**Absence means `php -l` must succeed.** If a fixture has no `===php_error===` section and PHP rejects it, the PHP syntax test fails.

Run `UPDATE_FIXTURES=1 cargo test` to auto-populate this section too.

### When to use which

| Situation | `===errors===` | `===php_error===` | Directory |
|-----------|---------------|-------------------|-----------|
| Parser emits errors, PHP also rejects | yes | yes | `errors/` |
| Parser emits errors, PHP accepts (lenient parser) | yes | — | `errors/` |
| Parser is silent, PHP rejects (leniency divergence) | — | yes | `categories/` |
| Parser is silent, PHP accepts (happy path) | — | — | `categories/` |

> Fixtures in `errors/` must always have an `===errors===` section. If the parser currently does not emit errors for a case where PHP rejects, the fixture belongs in `categories/` (not `errors/`) with `===php_error===` documenting the divergence.

---

## Parse-leniency divergences

When the parser intentionally accepts PHP that `php -l` rejects, document it with:

- `===php_error===` section containing the PHP error
- A comment in the fixture or nearby doc explaining the intentional leniency

These are cases PHP considers invalid but the parser allows (e.g. unclosed interpolation braces, deprecated syntax still parsed for recovery).

---

## Example: fixture with both sections

```
===source===
<?php $x = 1 +;
===errors===
expected expression
===ast===
{ ... }
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
```

## Example: parser-silent, PHP-rejecting fixture

```
===source===
<?php $s = "text {$incomplete";
===ast===
{ ... }
===php_error===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "->" or "?->" or "[" in Standard input code on line 1
```
