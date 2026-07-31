# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.19.0] - 2026-07-31

### Added

- **PHP 8.6 partial function application (early support)** — `PhpVersion::Php86` added; the parser now understands the `?` and bare `...` call-argument placeholders (e.g. `foo(1, ?, 3)`, `foo(1, ...)`, `foo(s: ?)`, `stuff(1, a: 5, ...)`) from the [Partial Function Application RFC](https://wiki.php.net/rfc/partial_function_application_v2). Placeholders are rejected in `new` expressions, matching the RFC. Default parse target stays `Php85` since PHP 8.6 hasn't shipped yet (`php-rs-parser`, `php-ast`, `php-printer`).

---

## [0.18.3] - 2026-07-17

### Fixed

- Blank lines inside an indented heredoc/nowdoc in a CRLF file no longer emit a spurious "Invalid body indentation level" error. A blank line in a CRLF source still carries its `\r` after splitting on `\n`, so the indentation check saw a non-empty line without the closing marker's indent; PHP's scanner treats a line that reaches `\r`/`\n` before any non-whitespace as empty (`php-rs-parser`).

---

## [0.18.2] - 2026-07-04

### Fixed

- Multiple `@tag`s on the same physical PHPDoc line (`@param int $x @return int`, or combined psalm/phpstan annotations like `@template U @extends Foo<U>`) are now parsed as separate tags instead of one tag whose body swallows the rest. The split only applies to a line that itself starts with `@`; a tag's continuation/description lines are still treated as prose, so text like `Contact user @example for details.` is not mistaken for a new tag (`phpdoc-parser`).

---

## [0.18.1] - 2026-06-21

### Fixed

- Member access and dereference (`->`, `?->`, `[]`, `{}`, method calls) now bind tighter than `**` exponentiation, matching PHP. `10 ** $this->maxDigits` now parses as `10 ** ($this->maxDigits)` instead of `(10 ** $this)->maxDigits`; in PHP a dereference chain binds tighter than every binary operator. `MEMBER_ACCESS_BP` was raised above `**` (and stays below `::`) (`php-rs-parser`).

---

## [0.18.0] - 2026-06-14

### Fixed

- `new` with a member-access or nullsafe class reference now instantiates the named class instead of dereferencing a fresh object. `new $this->job()` is `new ($this->job)()` (not `(new $this)->job()`), and `new $a?->b()` is `new ($a?->b)()`. PHP treats `->prop`, `?->prop`, `[idx]` and `::$prop` after a variable class reference as part of the class-name reference (a `new_variable`), not a dereference of the result. The nullsafe `?->` form is gated to PHP 8.0 (`php-rs-parser`).
- A parenless `new` with a class *name* can no longer be dereferenced: `new Foo->bar`, `new Foo::class`, `new Foo[0]`, and `new self::C` are rejected by PHP but the parser accepted them (parsing as `(new Foo)->bar`). Variable-form (`new $c->p`) and static-property (`new A::$b`) class refs remain valid. The parenthesized result-dereference `new Foo()->bar` is the PHP 8.4 feature and is now version-gated (`php-rs-parser`).
- Empty array elements (`[1, , 3]`) are now rejected in value arrays, where PHP fatals with "Cannot use empty array elements in arrays". The error is retracted at destructuring sites, so `[$a, , $c] = ...` and `foreach ($x as [$a, , $c])` remain valid (`php-rs-parser`).
- Reserved keywords are now rejected as class/interface/trait/enum/global-const names (e.g. `class class {}`, `const for = 1;`), matching PHP. The contextual `enum`/`from` remain usable, and member names (methods, class constants) stay unrestricted (`php-rs-parser`).
- Parameters after a variadic parameter are now rejected (`function f(...$a, $b) {}`), which PHP fatals as "Only the last parameter can be variadic". A trailing comma after the variadic (`...$a,`) is still valid (`php-rs-parser`).
- A backed enum's type is now restricted to `int` or `string`; the parser previously accepted any name (`enum E: bool`, `enum E: Foo`) (`php-rs-parser`).
- An empty attribute group `#[]` is now rejected as a syntax error instead of being silently accepted as an empty attribute set (`php-rs-parser`).
- `new` in enum constant initializers is now rejected, matching the existing class-constant rule (PHP: "New expressions are not supported in this context") (`php-rs-parser`).
- `<?= $a, $b ?>` now parses the comma-separated expression list (shorthand for `echo $a, $b;`); previously only a single expression was accepted before erroring (`php-rs-parser`).
- `enum Enum {}` is now accepted — a second `enum` not followed by a label lexes as a plain identifier, but statement dispatch only treated `enum` as a declaration when followed by a bare identifier token, so it fell through to expression parsing. The `Enum_` token is also accepted as a name; fully-reserved words (`match`/`list`/`fn`) still fall through correctly (`php-rs-parser`).
- A statement-level `(void)` cast is now allowed as the leftmost-descending leaf under any binary operator (`(void) $x + 1`, `(void) 5 |> f(...)`); the check previously whitelisted only logical operators. A void cast on the right operand is still rejected (`php-rs-parser`).
- The cross-statement duplicate-`use` detector now resets its seen-imports set when entering a new unbraced `namespace X;` block, so the same import in sibling namespaces is no longer wrongly reported as "already in use". Braced namespaces already reset correctly (`php-rs-parser`).
- `new` is now allowed in global constant and static-variable initializers (`const C = new Foo();`, `static $x = new Cache();`), which PHP 8.1+ permits; only class/enum constants and property defaults reject it (`php-rs-parser`).
- `final` properties are now version-gated to PHP 8.4+ instead of being rejected unconditionally with "Cannot use the final modifier on a property" (`php-rs-parser`).

### Changed

- Attributes (`#[...]`) are now version-gated to PHP 8.0; below that target the parser emits a version error rather than accepting them (before 8.0, `#[` begins a comment) (`php-rs-parser`).
- The `0o`/`0O` explicit octal prefix is now version-gated to PHP 8.1. Legacy `0NNN` octals are unaffected (`php-rs-parser`).
- Non-capturing `catch (Exception)` without a variable binding is now version-gated to PHP 8.0 (`php-rs-parser`).
- Constants in traits are now version-gated to PHP 8.2; class/interface/enum constants are unaffected (`php-rs-parser`).

---

## [0.17.1] - 2026-06-14

### Fixed

- The parser no longer rejects `numeric` and `resource` as class, interface, or extends/implements names. Unlike `int`/`float`/`string`/`bool`/etc., `numeric` and `resource` are not reserved class names in PHP — `class numeric {}` and `class resource {}` are accepted by `php -l`, so flagging them was a spurious `Forbidden` parse error (`php-rs-parser`).

---

## [0.17.0] - 2026-06-09

### Added

- `parse_arena_raw` — parses without building a line/column `SourceMap`, for callers (formatters, linters) that only need spans. `SourceMap::new` scans the entire source for newlines and allocates a `Vec<u32>` of line-start offsets on every `parse_arena` call; profiling measured this at ~7.7% of total parse time on the symfony corpus. `parse_arena` is unchanged (`php-rs-parser`).
- `SourceMap::empty()` — returns a no-op map (single entry at offset 0) used internally by `parse_arena_raw` (`php-rs-parser`).

### Changed

- The parser no longer pre-lexes the whole source into a `Vec<Token>` before parsing. Because only two tokens of lookahead are needed, lexing is now lazy and streamed through a small peeking window, avoiding the wasted pre-pass and the cache pressure of holding the full token array on large files. Behavior is unchanged; lexer errors are still ordered ahead of parse errors. Benchmarks: symfony −6.9%, laravel −24.5% (`php-rs-parser`, `php-lexer`).
- The `(void)` cast misuse walk now runs only when a void cast was actually parsed, instead of walking every expression statement's subtree. Void casts are a rare PHP 8.5 feature, so the walk almost always found nothing. Behavior is unchanged. Benchmarks: laravel −4.5%, wordpress −2.2%; symfony flat (`php-rs-parser`).
- Pre-allocate the token `Vec` in `lex_all` and the `line_starts` `Vec` in `SourceMap::new` with capacity hints derived from source length, eliminating several reallocations per file (`php-lexer`, `php-rs-parser`).

### Documentation

- Document `parse_arena_raw` and `SourceMap::empty` in the crate-level Arena API section and README, with cross-links to `parse_arena`; update the Architecture note to reflect lazy streaming and the 2-token lookahead window (`php-rs-parser`).

---

## [0.16.0] - 2026-06-02

### Added

- `Stmt::doc_comment` field — standalone `/** */` doc-blocks before non-declaration statements (`foreach`, `if`, `while`, assignments, etc.) are now structurally attached to the `Stmt` node that immediately follows them. Previously these appeared only as free-floating entries in `ParseResult::comments`, requiring positional search. The field is stored as an arena pointer (`Option<&'arena Comment<'src>>`) so the `None` case that covers the vast majority of statements costs only 8 bytes instead of the 32 bytes an inline slot would require (`php-ast`, `php-rs-parser`).
- `Stmt::leading_doc_comment() -> Option<&Comment>` — unified accessor that returns the preceding `/** */` doc-block regardless of where it lives: `Stmt::doc_comment` for non-declaration statements, or the inner declaration node's own field (`FunctionDecl::doc_comment`, `ClassDecl::doc_comment`, …) for declaration statements. External tools can call this single method without branching on statement kind (`php-ast`).
- `Comment<'src>` now derives `Clone + Copy`; all three fields (`CommentKind`, `&'src str`, `Span`) were already `Copy` (`php-ast`).
- `Parser::take_doc_comment_from(before, from)` — like `take_doc_comment` but accepts an explicit lower bound instead of the current scope boundary; used internally by `parse_stmt` to reclaim the correct comment after the statement body has been fully parsed (`php-rs-parser`).

### Changed

- `Parser::advance()` now updates the internal scope-boundary tracker on both `{` and `}` tokens (previously only `}`). This ensures statements inside a block body cannot claim doc-blocks written before the opening brace (`php-rs-parser`).
- `Printer::print_doc_comment` signature tightened from `&Option<Comment>` to `Option<&Comment>` (`php-printer`).

---

## [0.15.0] - 2026-05-28

### Added

- `Block` AST node and `StmtKind::Block`; always-braced bodies (function, method, closure, try/catch/finally, braced namespace, property-hook block) now hold a `Block`, so "this body is a block" is enforced by the type rather than an out-of-band invariant (`php-ast`).
- `ClassBody`/`EnumBody`/`SwitchBody` wrappers and brace/keyword offset fields (`else_kw_start`, `finally_kw_start`, match brace, trait-use adaptations brace). Position data is `#[serde(skip)]` and `Block` is `#[serde(transparent)]`, so serialized AST is unchanged (`php-ast`).
- `visit_block`, `fold_block`, `owned_block`, and `av_block` to thread `Block` through both visitors, both folds, and the owned↔arena conversions (`php-ast`).

### Fixed

- Printer preserves a comment that sits immediately before `{`, `else`, `finally`, or the `while` of a do-while (and other braced/keyword positions) instead of dropping or misplacing it (`php-printer`).
- Multiline `@tag` bodies now join continuation lines with a newline instead of a space, so a type expression and its description stay on separate lines (e.g. `@var T` followed by an indented description) and consumers of `body_text`/`text_content` can split them on the boundary (`phpdoc-parser`).

---

## [0.14.1] - 2026-05-23

### Fixed

- Parser no longer emits false-positive "non-compound use has no effect" warning for single-part unaliased use statements inside named namespaces (`php-rs-parser`).

---

## [0.14.0] - 2026-05-21

### Added

- Owned (lifetime-free) parse API: `parse()` and `parse_versioned()` return a fully-owned `ParseResult` with no lifetime parameters; existing arena API is now `parse_arena()` / `parse_arena_versioned()` (`php-rs-parser`).
- `php_ast::owned` module — every AST type mirrored with `Box<str>` / `Box<[T]>` instead of arena references; JSON serialisation is byte-for-byte identical to arena types (`php-ast`).
- `OwnedVisitor`, `OwnedScopeVisitor`, `OwnedScopeWalker`, and `walk_owned_*` free functions for traversing owned ASTs without managing lifetimes (`php-ast`).
- `FoldOwned` trait and `fold_owned_*` free functions for transforming owned ASTs; identity defaults rebuild the tree identically (`php-ast`).
- `pretty_print_owned`, `pretty_print_owned_file`, and related helpers for printing owned ASTs directly — converts owned→arena via a short-lived bump arena internally (`php-printer`).
- `ParserContext::reparse_owned` and `reparse_owned_versioned` for lifetime-free re-parses (`php-rs-parser`).

---

## [0.13.0] - 2026-05-17

### Added

- `ParseError::ForbiddenWarning` variant and `severity()` method on `ParseError` — non-fatal diagnostics for constructs that PHP itself treats as warnings rather than hard errors (`php-rs-parser`).

### Fixed

- Parser rejects incompatible `set`-hook parameter types (`php-rs-parser`).
- Parser rejects `void` cast in value-consuming (expression) context (`php-rs-parser`).
- Parser rejects standalone parenthesized intersection types (`php-rs-parser`).
- Parser rejects `new` in constant, property, and static-variable initializers (`php-rs-parser`).
- Parser rejects curly-brace array/string offset access (`$a{'b'}`) (`php-rs-parser`).
- Parser rejects mixing `list()` and `[]` in destructuring (`php-rs-parser`).
- Parser rejects empty `list()` / `[, ,]` destructuring (`php-rs-parser`).
- Parser rejects non-writable destructure targets (`php-rs-parser`).
- Parser rejects temporary expression in write context (`php-rs-parser`).
- Parser rejects `return` value in `void`/`never` functions (`php-rs-parser`).
- Parser rejects `new ClassName(...)` first-class callable syntax (`php-rs-parser`).
- Parser rejects property hooks on static properties (`php-rs-parser`).
- Parser rejects empty property hook list and `get` with any parameters (`php-rs-parser`).
- Parser rejects non-hooked properties in interfaces (`php-rs-parser`).
- Parser enforces asymmetric visibility rules: type required, `set` visibility cannot be wider than `get` (`php-rs-parser`).
- Parser rejects `final` modifier on properties and `readonly` modifier on methods (`php-rs-parser`).
- Parser rejects duplicate property declarations (`php-rs-parser`).
- Parser rejects return type and `static` modifier on `__construct` (`php-rs-parser`).
- Parser rejects `static` modifier on `__destruct` and `__clone` (`php-rs-parser`).
- Parser rejects `static` modifier on parameters (`php-rs-parser`).
- Parser rejects promoted property modifiers outside `__construct` (`php-rs-parser`).
- Parser rejects duplicate methods and enum cases (`php-rs-parser`).
- Parser rejects reserved type names (`int`, `string`, etc.) as class names (`php-rs-parser`).
- Parser rejects standalone `null`/`false` types below PHP 8.2 and `Closure` in attribute arguments (`php-rs-parser`).
- Parser enforces program-level namespace layout rules (`php-rs-parser`).
- Parser rejects multiple `default` arms in `switch`, variadic parameters with default values, and `isset(expr)` with non-variable arguments (`php-rs-parser`).
- Operator precedence aligned with PHP 8 — three additional opt-out gaps closed (`php-rs-parser`).
- Parser warns on non-compound `use` names and detects cross-statement duplicate imports (`php-rs-parser`).
- Parser warns on `final private` methods (`php-rs-parser`).
- Playground project dropdown stays open while scrolling the list (`playground`).
- `ast-stats` tool counts files with warnings-only as parsed; only hard errors are skipped (`ast-stats`).

---

## [0.12.2] - 2026-05-16

### Added

- Project stats playground expanded from 10 to 50 open-source PHP projects with per-directory breakdown and expandable node-variant rows.
- Per-project stats pages with interactive directory tree navigation.
- AST node comparison page for side-by-side project analysis.

### Fixed

- Parser no longer consumes `[index]` after `->prop` in string interpolation (`php-rs-parser`).
- Parser now correctly handles single-keyword asymmetric visibility (`private(set)`) (`php-rs-parser`).

---

## [0.12.1] - 2026-05-15

### Added

- `visit_comment` hook in the `Visitor` trait for traversing doc comments on declarations (`php-ast`).

### Fixed

- Doc comments no longer leak across scope boundaries during parsing — scoped comments are properly isolated to their declaration context (`php-rs-parser`).

### Tests

- Comprehensive comment fixture coverage across all supported PHP versions (`php-rs-parser`).

---

## [0.12.0] - 2026-05-14

### Added

- `Fold` trait for arena-to-arena AST transformations — enables efficient rewriting of AST nodes with the bump arena as the target allocation context (`php-ast`).
- Printer now preserves blank lines from source in switch cases and enum members, maintaining semantic formatting hints from the original code (`php-printer`).

### Fixed

- Printer now correctly tracks `has_php_content` state across blank lines, preventing spurious `<?php` tags from being emitted (`php-printer`).

---

## [0.11.1] - 2026-05-12

### Changed

- Printer state management simplified with duplicate code eliminated (`php-printer`).

### Fixed

- CI validation script no longer prepends `<?php` header when validating pretty-printed output — header already included by `pretty_print()` (`php-parser`).
- PHPDoc parser package name corrected in CI and release workflows (`phpdoc-parser`).

---

## [0.11.0] - 2026-05-11

### Added

- `pretty_print` and all printer variants now emit `<?php\n` at the start of PHP-first programs, making the output valid standalone PHP (`php-printer`).
- `pretty_print_file` simplified to `pretty_print` + trailing newline — no longer duplicates the `<?php` header logic (`php-printer`).

### Fixed

- Printer correctly emits `?>` before inline HTML following alternative-syntax closing keywords (`endforeach`, `endfor`, `endwhile`, `endif`, `endswitch`, `enddeclare`) — previously the `has_php_content` flag was left `false` after the loop body, suppressing the close tag (`php-printer`).
- Printer no longer emits a spurious trailing `<?php` after the last inline HTML node in a file (`php-printer`).
- Printer suppresses `?>` for empty `<?php ?>` blocks that produce no PHP output (`php-printer`).
- Round-trip stability verified across the full parser corpus — `pretty_print(parse(pretty_print(parse(src))))` is always identical to `pretty_print(parse(src))` (`php-printer`).

### Changed

- `phpdoc-parser` crate replaced with a structural-only implementation that parses PHPDoc blocks without external dependencies (`phpdoc-parser`).
- README expanded with full API coverage; `docs/` directory removed in favour of inline documentation.

---

## [0.10.1] - 2026-05-09

### Fixed

- Correct UTF-8 variable detection in string interpolation — fixes parsing of variables with multibyte characters in interpolated strings (`php-rs-parser`).

---

## [0.10.0] - 2026-05-09

### Added

- Enhanced parser validation for constructor promotion modifiers — explicitly rejects multiple modifiers on promoted parameters in anonymous classes and refines `readonly` validation on properties (`php-rs-parser`).
- Improved error diagnostics with proper error context in recovery paths — error recovery now preserves more meaningful context for debugging (`php-rs-parser`).
- CI validation: printer output now validated against `php -l` to ensure round-trip output is syntactically valid PHP (`php-parser`).
- Comprehensive printer edge-case coverage including `new` expressions with empty arguments, property hooks, DNF types, pipe operator expressions, and clone with list arguments (`php-printer`).

### Fixed

- Parser validates parenthesized arrow functions in pipe operator (`|>`) expressions — prevents invalid syntax like `|> ($x) => $x` (`php-rs-parser`).
- Parser now rejects invalid PHP constructs during parsing rather than silently accepting them and potentially dropping AST nodes (`php-rs-parser`).
- Control characters in heredoc/nowdoc and braces in string interpolation now properly escaped in printer output (`php-printer`).
- Variadic parameter modifiers now print in correct order (`&` before `...`) to match PHP syntax (`php-printer`).
- Printer now always emits parentheses for `new` expressions, ensuring valid PHP output in all contexts (`php-printer`).
- Property hooks printer fixture updated with valid PHP syntax and edge cases (`php-printer`).

### Changed

- All `.unwrap()` calls replaced with `.expect()` with documented invariants explaining why panic is guaranteed not to occur (`php-parser`).
- Clippy warnings in example binaries resolved (`php-parser`).
- Test fixtures now include `===php_error===` sections where appropriate to validate against PHP's own syntax validation (`php-parser`).
- Fixture test runner parallelized with `rayon` for faster test execution (`php-parser`).

### Documentation

- Added inline documentation explaining dead-code suppressions in test utilities (`php-parser/tests/common.rs`).
- Parser recursion depth limits and error recovery behavior documented in source (`php-rs-parser`).

### Tests

- Comprehensive edge cases for variadic parameter modifiers (`php-rs-parser`).
- Printer fixtures expanded to cover `new` expressions, property hooks, and DNF type combinations (`php-printer`).

---

## [0.9.8] - 2026-05-07

### Added

- Support for parenthesized unions in type hints (e.g., `(A|B)`) — parser now accepts parenthesized unions in parameter types, return types, and property types for better type expression flexibility (`php-rs-parser`).
- Comprehensive test coverage for DNF (Disjunctive Normal Form) edge cases and parenthesized type combinations (`php-rs-parser`).

---

## [0.9.7] - 2026-05-06

### Added

- Context-aware anchor sets for error recovery — parser now maintains contextual error recovery anchors to improve diagnostics in various syntactic contexts (issue #276) (`php-rs-parser`).

### Fixed

- Declaration docblocks are now preserved during parsing instead of being dropped (`php-rs-parser`).
- Parse errors for invalid names now emit `ExprKind::Error` instead of `Identifier("<error>")`, improving error diagnostics (`php-rs-parser`).
- `Name::Error` variant added for synthesized error names during error recovery (`php-ast`, `php-rs-parser`).
- Enum constant validation: private enum constants now properly reject the `final` modifier (`php-rs-parser`).
- Enum constant validation: static and abstract modifiers on enum constants now properly validated (`php-rs-parser`).
- PHP version-specific error message handling aligned across all PHP 8.1–8.5 error recovery fixtures (`php-rs-parser`).

### Changed

- Internal refactoring: `ERROR_PLACEHOLDER` string literals replaced with typed `Ident` at declaration name sites (`php-rs-parser`).

### Tests

- Comprehensive enum constant parser and printer coverage (`php-rs-parser`, `php-printer`).
- Expression span edge-case fixtures from parser audit (`php-rs-parser`).
- Version-specific interface and trait error recovery fixtures for PHP 8.1–8.5 coverage (`php-rs-parser`).
- Comprehensive error recovery fixtures for various syntactic contexts (issue #276) (`php-rs-parser`).

---

## [0.9.6] - 2026-04-27

### Added

- Playground AST tree is now interactive with collapsible nodes — click any node to expand or collapse its subtree (`playground`).

### Fixed

- Workspace dependency versions in `Cargo.toml` were still pinned to `0.9.4` after the 0.9.5 release; corrected to `0.9.5` (`Cargo.toml`).
---

## [0.9.5] - 2026-04-27

### Added

- Interactive WebAssembly playground deployed to GitHub Pages — parse and format PHP in the browser, powered by the Rust parser compiled to WASM (`php-wasm`).
- New `php-wasm` crate: `wasm-bindgen` bindings exposing `parse()`, `format()`, `parser_version()`, and `build_commit()` to JavaScript.
- GitHub Actions workflow (`playground.yml`) that builds the WASM package with `wasm-pack` and deploys the playground on every push to `main` that touches parser or playground files.

### Fixed

- Playground statusbar version link pointed to `releases/tag/0.9.x` (missing `v` prefix); corrected to `releases/tag/v0.9.x` to match the actual tag format (`playground`).

### Documentation

- Added playground link to the top of `README.md`.
- `parse_stmt` stack-depth behaviour documented in source (`php-rs-parser`).

---

## [0.9.4] - 2026-04-26

### Added

- `is_final: bool` field on `ClassConstDecl` — the `final` modifier on class and enum constants (PHP 8.1+) was previously accepted by the modifier-parsing loop but dropped before reaching the AST. Now captured in both class and enum const parsers and emitted by the printer (`php-ast`, `php-rs-parser`, `php-printer`).

### Fixed

- Printer wraps intersection types nested inside union types (DNF) in parentheses, e.g. `(A&B)|null`; previously it emitted invalid PHP (`php-printer`).
- Printer placed `new class(args) extends Base { body }` constructor arguments after the body; arguments are now emitted between `class` and the `extends`/`implements` clauses (`php-printer`).
- Printer routed heredoc literal segments through the double-quoted-string escaper, which collapsed multi-line heredocs onto one line by converting real newlines to `\n`. A dedicated heredoc escaper now only escapes `\` and `$` (`php-printer`).

### Changed

- Internal: `crates/php-ast/src/ast.rs` (1,498 lines) split into an `ast/` module directory across `names`, `exprs`, `stmts`, `decls`, `misc`. No public API changes (`php-ast`, #246).
- Internal: `crates/php-printer/src/printer.rs` (1,662 lines) split into a `printer/` module directory across `stmts`, `decls`, `exprs`, `types`, `helpers`. No public API changes (`php-printer`, #247).

### Tests

- 30 new printer fixtures covering heredoc/nowdoc, shell_exec, declare, trait-use adaptations, property hooks (PHP 8.4), asymmetric visibility, DNF types, pipe operator (PHP 8.5), `clone(..., [...])` (PHP 8.5), array destructuring, anonymous classes with constructor args, typed class constants, switch fallthrough, multi-use imports, and other previously-untested AST nodes (`php-printer`).

---

## [0.9.3] - 2026-04-26

### Added

- `doc_comment: Option<Comment<'src>>` field on `ConstItem` — top-level constants now carry their preceding doc comment in the AST. In multi-constant declarations (`const A = 1, B = 2;`) the doc comment is attached to the first item only, mirroring the existing `pending_attrs` pattern (`php-ast`, `php-rs-parser`, #277).

### Fixed

- Printer emitted attributes on `const` statements after the `const` keyword (invalid PHP); both doc comments and attributes are now printed before `const` (`php-printer`, #277).

---

## [0.9.2] - 2026-04-25

### Fixed

- Leading-zero and negative-zero indices in simple string interpolation (`$arr[00]`, `$arr[07]`, `$arr[-0]`) are now correctly classified as string keys instead of `Int(0)`, matching PHP's tokenizer behaviour (`php-rs-parser`).

---

## [0.9.1] - 2026-04-24

### Fixed

- Parser stress-test corpus regressions across alternative syntax, attributes, clone/cast operands, dynamic member access, heredoc contexts, and semi-reserved end-keywords (`php-rs-parser`).
- Lexer handling of edge cases uncovered by stress testing (`php-lexer`).

### Documentation

- PHP 7.4 listed among supported versions.

---

## [0.9.0] - 2026-04-20

### Added

- Backed enum cases (`enum E: int`) now require a value; pure enum cases now reject values. Both emit `ParseError::Forbidden` pointing to the missing or unwanted `=` token (`php-rs-parser`, #269).
- `readonly` properties and constructor-promoted parameters without a type hint now emit `ParseError::Forbidden` (`php-rs-parser`, #268).
- `break` and `continue` outside a loop or `switch` now emit a parse error; numeric level arguments are validated against the current loop depth (`php-rs-parser`, #265).

### Tests

- Span coverage fixtures added for `const` statement declarations (`php-rs-parser`, #267).
- Span coverage fixtures added for first-class callable expressions (`php-rs-parser`, #266).

### Documentation

- CONTRIBUTING guide improved and ROADMAP restructured (#264).
- Acknowledgements section added for nikic/PHP-Parser and the PHP community (#254).
- README reorganized for clarity and audience separation (#253).
- `docs/INDEX.md` navigation path for tool consumers updated (#250).

---

## [0.8.1] - 2026-04-19

### Fixed

- `readonly` property with a `set` hook now emits a parse error instead of silently accepting it (`php-rs-parser`, #237).

### Changed

- Builtin type hint matching refactored from chained `eq_ignore_ascii_case` to a `match` expression (`php-rs-parser`, #238).
- Verbose ampersand-eat patterns replaced with `parser.eat()` helper (`php-rs-parser`, #235).

### Documentation

- Complete public API documentation coverage for `php-ast` and `php-lexer` crates (#241).
- Binding-power convention documented in `precedence.rs` (`php-rs-parser`, #240).

### Tests

- String interpolation edge-case fixtures added (`php-rs-parser`, #239).
- Error-recovery fixtures for property hooks added (`php-rs-parser`, #236).

---

## [0.8.0] - 2026-04-19

### Added

- `visit_name()` hook and `walk_name()` free function in the `Visitor` trait — fully backwards compatible; all existing visitors compile unchanged (`php-ast`, #226).
- `ParserContext` struct with `reparse()` / `reparse_versioned()` methods for arena reuse across re-parses. Resets the bump arena in O(1) before each parse, reducing allocator churn in LSP servers that re-parse on every keystroke (`php-rs-parser`, #221).

### Changed (breaking)

- `StaticMethodCall` / `StaticMethodCallExpr` now covers only static dispatch (`Foo::bar()`). Dynamic dispatch (`Class::$method()`) is a new `StaticDynMethodCall` / `StaticDynMethodCallExpr` variant. Match arms that previously handled dynamic dispatch via `StaticMethodCall` must be updated (`php-ast`, #225).

### Fixed

- Visitor now traverses `TraitUse` adaptations (`php-ast`, #223).
- Risky `unwrap()` in trait alias parsing replaced with proper error handling (`php-rs-parser`, #219).
- Empty index in string interpolation (`$$arr[]`) now emits a parse error instead of silently producing a malformed AST (`php-rs-parser`, #218).
- Malformed Unicode escape sequences now emit parse errors (`php-rs-parser`, #217).
- Invalid assignment targets (e.g. `1 = $x`) now emit parse errors (`php-rs-parser`, #216).
- Non-associative chain detection restricted to same-precedence operators; mixed-precedence chains no longer trigger a false error (`php-rs-parser`, #215).
- Property hook parameter counts validated; mismatched arity now emits a parse error (`php-rs-parser`, #214).
- Invalid heredoc/nowdoc body indentation now emits a parse error (`php-rs-parser`, #212).

---

## [0.7.0] - 2026-04-17

### Added

- Spans on static method/member/argument identifiers in the AST (`php-ast`, #197).
- Named argument ordering and uniqueness validation: duplicate names and non-trailing named arguments now produce diagnostics (`php-rs-parser`, #193).
- `Name::src_repr(&self, src: &'src str) -> &'src str` — zero-alloc slice into source for any name shape (`php-ast`, #169).

### Changed (breaking)

- `ScopeWalker::new` now requires the source string (`src: &'src str`) to support zero-alloc namespace resolution. Update call sites to pass `result.source` or your source buffer (#169).
- `Scope` now derives `Copy`; `Scope::namespace` changed from `Option<Cow<'src, str>>` to `Option<&'src str>` (#169).
- `ArenaVec::len` and `ArenaVec::last` explicit methods removed — both remain accessible via `Deref<Target=[T]>` and continue to work without call-site changes (#170).

### Performance

- `ScopeWalker` namespace tracking is now zero-alloc; scope saves/restores are a free word copy (#169).
- `Printer` internal strings changed from heap-allocated `String` to `&'static str` (#164).
- Lexer heredoc label now borrows from source instead of allocating a `String` (#163).

### Fixed

- Guard against silent `u32` truncation for source files larger than 4 GB in the lexer (#166).
- Eliminated panic-prone `unwrap()` calls after explicit length checks in the parser (#165).
- Replaced bare `unreachable!()` calls with descriptive messages and `Option` returns in the parser (#167).
- Removed dead `ParseError::Unexpected` variant from diagnostics (#168).
- Variable name extraction now guarded against empty-span tokens (#160).

---

## [0.6.2] - 2026-04-12

### Fixed

- `php-printer` published package excluded test fixtures (`tests/`), reducing package size from 198 files to 7.

---

## [0.6.1] - 2026-04-12

### Fixed

- Root `CHANGELOG.md` was stale at v0.3.2; synced through v0.6.0, including the v0.6.0 breaking changes and `ScopeVisitor`/`ScopeWalker` migration guidance (#146).

---

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
