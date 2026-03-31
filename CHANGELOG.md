# Changelog

## [0.3.2] - 2026-04-01

### Bug Fixes

- **AST: `=&` by-reference assignment** — `$a =& $b` was previously
  indistinguishable from `$a = $b` in the AST. `AssignExpr` now carries a
  `by_ref: bool` field that is `true` for `=&`. ([#fix])
- **AST: `&$var` in array/list destructuring elements** — `[&$a]` and
  `list(&$a)` elements silently dropped the `&` from the AST.
  `ArrayElement` now carries a `by_ref: bool` field. ([#fix])
- **AST: empty destructuring slots** — `[$a, , $c]` and `list($a, , $c)`
  empty slots were emitted as `ExprKind::Null`, making them
  indistinguishable from literal `null` values. They are now emitted as
  the new `ExprKind::Omit` variant. ([#fix])
- **String parsing: dead code branch** — a branch in double-quoted string
  parsing would produce an empty `InterpolatedString` (dropping the
  expression) if a single-part string ended up with a non-literal part.
  The part is now preserved correctly. ([#fix])

### AST Changes (php-ast)

- `AssignExpr` has a new field `by_ref: bool`
  (serialized only when `true` to keep existing snapshots stable).
- `ArrayElement` has a new field `by_ref: bool`
  (serialized only when `true`).
- `ExprKind::Omit` is a new unit variant representing a skipped position
  in array or list destructuring.

### Testing

- Added 8 regression tests covering each of the bugs above.
- Nikic fixture corpus: test both valid and invalid fixtures, fix
  duplicate test names, and version-gate PHP 8.4/8.5 fixtures.
- Expanded edge-case coverage across PHP 8.0–8.5 features.

---

## [0.3.1] - 2026-03-30

### Bug Fixes

- Fix `is_final`, `is_readonly` on `Param` and `by_ref` on `Arg` not
  being preserved in the AST.

---

## [0.3.0] - 2026-03-30

### Bug Fixes

- Fix `readonly final class` ordering and flexible heredoc closing markers.
- Fix unicode escapes, yield-from flag, negative string index, and
  `\${...}` interpolation.
- Reject `true|false` union types (PHP emits a type error).

### Testing

- Improve test suite quality and coverage.
- Expand coverage for edge cases across PHP 8.0–8.5.
- Validate nikic fixture files via `php -l`.
