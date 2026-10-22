# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- `Lexer::with_attributes`, which lexes `#[` as a `#` comment when disabled (`php-lexer`).
- `EnumMemberKind::Property`, for a property declared in an enum (`php-ast`), and `ForbiddenRule::EnumProperty` (`php-rs-parser`).

### Fixed

- Before PHP 8.0, `#[` starts a `#` comment instead of an attribute, so `#[\ReturnTypeWillChange]` and other single-line attributes are accepted (`php-rs-parser`).
- A property in an enum reports PHP's `Enum E cannot include properties` compile error and stays in the AST, instead of a syntax error (`php-rs-parser`).
- Writing to a property or element of `clone $a` reports `Cannot use temporary expression in write context` before PHP 8.5 (`php-rs-parser`).

## [0.25.0] - 2026-10-22

Errors are now machine-readable: every `ParseError` has a stable code, and every compile-time error names the rule it breaks. Version-targeted parsing follows each PHP version from 7.4 to 8.6 much more closely.

### Added

- `ForbiddenRule` on `ParseError::Forbidden` (`rule`, `forbidden_rule()`), so tools can match errors by rule instead of by message. Includes `ForbiddenRule::ALL`, `phase()` (`Phase::Parse` or `Phase::Compile`, as `php -l` reports it), `FromStr` and `Display` (`php-rs-parser`).
- `ParseError::code()`, a stable identifier for every error, and `ParseError::leaves_ast_incomplete()` (`php-rs-parser`). Errors returned by `parse` carry the `code` (`php-wasm`).
- `LexerErrorKind::UnterminatedComment` and `LexerErrorKind::InvalidNumericLiteral`, which replaces `Other` for literals such as `1_` (`php-lexer`).
- `Name::join_parts_in(src)`, which borrows a multi-part name from the source when possible (`php-ast`).

### Changed

- `ParseError::UnclosedDelimiter` reads `missing closing ')'`; the opening offset stays in `opened_at` (`php-rs-parser`).
- `Name::join_parts` and `Name::to_string_repr` borrow single-part names instead of allocating (`php-ast`).

### Removed

- **Breaking:** `ParseError::ExpectedExpression`, `ExpectedStatement` and `ExpectedOpenTag`; use `ParseError::Expected`, whose message also names the token found (`php-rs-parser`).

### Fixed

- Version gates follow PHP from 7.4 to 8.6: errors that older versions report (trailing commas in parameter lists before 8.0, `?false` before 8.2, `new readonly class` before 8.3, `exit` and `clone` argument forms, …), valid PHP 7.4 that was rejected (`mixed` as a class name, `function match()`, `#[...]` as a comment, …), keywords such as `readonly`, `never` and `__PROPERTY__` read as names before they were introduced, and PHP 8.6 features (readonly property defaults, partial function application in constant expressions, property writes through constant objects). `\static` and `namespace\static` in types are rejected from PHP 8.5 (`php-rs-parser`).
- Lexing: nothing after `__halt_compiler()` is lexed, casts need only spaces or tabs around the keyword, a lone `\r` is a line break, and interpolations are scanned correctly past comments, backticks, heredocs and nested strings (`php-lexer`, `php-rs-parser`).
- Parsing: bare `yield` before `?`, `??`, `:`, `=>` and `as`; `var`, `insteadof` and hook names match case-insensitively; `**` stays out of an `instanceof` operand; `::` works on non-constant array expressions; `self` and `parent` are valid global constant names and stay unresolved in anonymous class types (`php-rs-parser`).
- Compile-time checks no longer reject valid code (`Enum` in intersection types, foldable class names, short-circuit folding, set hook parameter types, heredoc indentation inside interpolations) and now catch stray semicolons in class bodies, `var` with other modifiers, `final private` and pre-8.1 `final` constants, reserved enum names, invalid typed enum constants, by-reference `get` hooks with a `set` hook and `<?=` without an expression (`php-rs-parser`).
- A parenthesized constant named like a cast keyword, such as `(int)`, no longer prints as a cast (`php-printer`).

## [0.24.1] - 2026-10-21

### Fixed

- An unqualified `static` in a type position reports the PHP 8.5 error (`php-rs-parser`).

## [0.24.0] - 2026-10-21

### Added

- `php_ast::Modifiers` (`visibility`, `set_visibility`, `is_static`, `is_abstract`, `is_final`, `is_readonly`), shared by methods, properties, parameters, class constants and property hooks (`php-ast`).
- `php_ast::ByteStr` (arena) and `php_ast::owned::ByteString`: a PHP string literal's value as bytes, with `as_bytes()`, `to_str()` and `to_string_lossy()`. With `serde`, valid UTF-8 serializes as a string and anything else as `{"bytes": [..]}` (`php-ast`).
- `Fold::fold_stmts` and `OwnedFold::fold_stmts` hooks, called for the program, every block and every `case` body, so a fold can delete, split or insert statements (`php-ast`).
- `walk_trait_adaptation`, `walk_owned_trait_adaptation`, and `walk_owned_block` / `fold_owned_block` re-exported from `php_ast::owned` (`php-ast`).
- `new` constructors for the node structs that are now `#[non_exhaustive]` (`php-ast`).
- Owned `Name::span()`, `kind()`, `to_string_repr()`, `join_parts()` and `Expr::name_str()`, `into_kind()`, like their arena counterparts. `Expr` implements `Drop`; take the kind out with `into_kind()` instead of destructuring (`php-ast`).

### Changed

- **Breaking:** function, class and constant references in expressions are `ExprKind::Name(Name)` instead of `ExprKind::Identifier`, so `visit_name`, `fold_name` and `NameResolver` see them. `Identifier` stays for member names after `->`, `?->` and `::` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `Ident` carries the `span` of its token. `Ident::name(s)` and `Ident::ERROR` are replaced by `Ident::new(s, span)` and `Ident::error(span)`; `CatchClause::var`, `UseItem::alias` and `ClosureUseVar::name` are `Ident`. A real identifier serializes as `{"name", "span"}` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `Arg` has `kind: ArgKind` and `ArrayElement` has `kind: ArrayElementKind` instead of `value` + `unpack` + `by_ref`. Read them with `value()`, `is_spread()`, `is_by_ref()` and `is_placeholder()` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `MethodDecl`, `PropertyDecl`, `Param`, `ClassConstDecl` and `PropertyHook` carry `modifiers: Modifiers` instead of separate `visibility`, `is_static`, `is_final`, … fields (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `ExprKind::String` and `StringPart::Literal` hold a `ByteStr` / `ByteString` instead of a `str`, because a PHP string is bytes. Nowdoc values are unchanged (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** new fields that were parsed and dropped before: `PropertyDecl::is_final` / `is_abstract` (PHP 8.4), `ForeachStmt::by_ref`, and `TraitAdaptationKind::Alias::is_final`. Each is serialized only when `true` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** removed `BuiltinType::Integer`, `Double` and `Boolean`; `integer`, `double` and `boolean` are class names and parse as `TypeHintKind::Named` (`php-ast`, `php-rs-parser`).
- **Breaking:** removed `TokenKind::From`; `from` is an identifier that the parser recognizes only after `yield` (`php-lexer`).
- **Breaking:** removed `ParseError::ForbiddenWarning`, `Severity` and `ParseError::severity()`. Every diagnostic is an error, matching `php -l`; PHP warnings are no longer reported (`php-rs-parser`).
- **Breaking:** `Visitor`, `ScopeVisitor`, `OwnedVisitor` and `OwnedScopeVisitor` have an associated `type Break`, and `visit_*` / `walk_*` return `ControlFlow<Self::Break>`. Existing visitors add `type Break = ();` (`php-ast`).
- **Breaking:** `FoldOwned` is renamed `OwnedFold` and takes every node by value; `fold_owned_*` move the children they keep instead of cloning them. `Fold::fold_closure_use_var` takes the arena (`php-ast`).
- **Breaking:** removed the `php_rs_parser::phpdoc` re-export; depend on `phpdoc-parser` directly. The `serde` feature of `php-rs-parser` no longer enables `phpdoc-parser/serde` (`php-rs-parser`).
- **Breaking:** the most extensible structs (`ClassDecl`, `FunctionDecl`, `ClosureExpr`, `IfStmt`, `ForeachStmt`, `TryCatchStmt`, `UseDecl`, … in arena and owned form), the struct variants of `ParseError` and `LexerError`, and the `phpdoc-parser` structs are `#[non_exhaustive]`. Build structs with `new(..)` and match errors with `..` (`php-ast`, `php-rs-parser`, `php-lexer`, `phpdoc-parser`).
- **Breaking:** `NameStr::__src` / `__arena` are the documented `from_source` / `from_arena`; `ArenaVec::into_iter` returns `php_ast::ast::IntoIter`; `Lexer::errors` is the `errors()` accessor. Printer-only spans and `Lexer::is_verbatim_string` are `#[doc(hidden)]` and outside semver (`php-ast`, `php-lexer`, `php-rs-parser`).
- The printer puts trait `use` first in class bodies, sorts each run of top-level `use` imports, opens anonymous class braces on the same line, puts a blank line before a member that starts with a comment, and indents a comment in an empty block (`php-printer`).

### Fixed

#### Parser: invalid code PHP rejects

Many constructs were accepted that PHP reports at compile time; they are now reported with PHP's wording:

- Names and imports: imports differing only in case, `use namespace\A`, a trailing `\` in a name, whitespace inside a namespaced name, `namespace namespace\Foo`, builtin or special class names as import aliases or with a namespace (`\int`, `Foo\int`, `use A as self`), `self`, `parent` and `static` where no class scope exists or written as `\self`.
- Declarations: `class callable`, a class constant named `class`, duplicate constants, parameters, properties and methods, abstract methods in non-abstract classes, methods without a body, `const`, `use` and `namespace` inside blocks, and nested named classes.
- Members and modifiers: properties without a modifier, `final private` properties, readonly rules (untyped, default values, `readonly` classes), asymmetric visibility rules, interface member rules, magic method signatures and `static`, constructor and destructor rules, and promoted parameters in abstract constructors.
- Property hooks: visibility, `abstract`, `static`, `readonly` and repeated `final` on a hook, `set` parameter checks, generator hooks, and defaults on virtual properties.
- Types: `void` / `never` misuse, `?null`, builtin types in intersections, duplicates after name resolution, parenthesized groups other than `(A&B)`, `static` in parameter and property types, and `return;` or generators with an incompatible return type (also `fn(): void => expr`).
- Attributes: built-in attribute targets and repetition, attributes after `new` before a named class, before trait `use`, on grouped global constants, and argument unpacking in attributes. `#[\DelayedTargetValidation]` suppresses them.
- Writes and references: `$this` and `$GLOBALS`, nullsafe chains, temporaries (`FOO->a = 1`, `(clone $a)->b = 1`), string literal offsets, by-reference destructuring and `foreach` keys, `++` / `--` on non-variables, `$a[]` read or unset, `list()` as a value, and `(void)` used as a value.
- Expressions: dereferencing heredocs, `match`, closures, numbers and other non-dereferenceable expressions, illegal class names, `instanceof` with arbitrary expressions, `break` / `continue` operands, `static` not followed by `::`, constant-expression checks, and a nullsafe method closure.
- Control flow: `goto` to undefined labels or into loops and `finally`, duplicate labels, `break` / `continue` outside loops, and `declare` directive checks.
- Lists and strings: trailing commas in `use`, `const`, `echo`, `global`, `static`, `declare`, `extends` and `implements` lists, destructuring lists mixing keyed and unkeyed entries, `{$b[]}`, `"$a['k']"`, unclosed `"$a[k"`, syntax errors inside `{$...}` and `${...}`, invalid `\u{…}` in heredocs, and mixed tab and space heredoc closing indentation.

#### Parser: valid code PHP accepts

- `$this?->foo(...)`, `?>` ending a class member or a `case`, `goto`, `unset`, `global`, `static`, `use`, `const` or `namespace` statement, `break`, `continue`, `return` or `yield`, and a `switch` opening with `?>`/`<?php`.
- `use A as enum`, goto labels such as `self:` and `null:`, a method named `namespace` in a trait adaptation, `$obj->__halt_compiler`, `A&B &$x`, `abstract readonly class` below 8.4, `int\X` class names, `extends int`, a constructor parameter with hooks and no visibility, grouped class constants in enums and with attributes, `yield` in hooks and enum methods, `1...2`, and whitespace-only heredoc lines shorter than the closing indentation.
- `from` works as a function, class or constant name (`php-lexer`).
- `__CONSTRUCT` is recognized case-insensitively, and `private(SET)` is matched like PHP's single token.

#### Parser: wrong trees

- Precedence and binding: `(void) f() + 1`, `include $a or $b`, `throw $e or 1`, `yield $a or $b`, `clone($a)->b = 1`, `clone $a ** 2`, `$a = &$b + $c`, and postfix `++` / `--` against prefix operators.
- `new namespace\Foo` lost the `namespace\` prefix; `A::{$m}()` is now `ExprKind::StaticMethodCallDynamic` and no longer requires PHP 8.3; `#[Attr] function &f() {}` is a function, not a by-reference closure; `include \dirname(...)` and similar apply the keyword to the name.
- Strings: octal escapes above `\377`, surrogate `\u{D800}` escapes, `"$a?->b"`, `${expr}`, `"\xff"` and other non-UTF-8 escapes now decode to the bytes PHP stores; a heredoc line inside `{$...}` that looks like the closing label; long float literals were truncated; `declare(...) ?>` took following HTML as its body.
- Grouped property declarations give every property the declared visibility, type and attributes.
- Version gates follow PHP (`fn(): never`, `self` in intersections, `namespace\static`, untyped readonly promotion).

#### Lexer

- `<?php` followed by a non-whitespace character is inline HTML, a heredoc label starting with a digit or followed by anything but a newline lexes `<<`, and a keyword followed by `\` and a name is a qualified name (`php-lexer`).

#### AST

- Deeply nested prefix operators (`~~~…$x`) parse, convert and drop without recursion (`php-rs-parser`, `php-ast`, `php-printer`).
- `Visitor`, `OwnedVisitor` and both scope walkers call `visit_name` for namespace names, named arguments and trait adaptation names; `ScopeWalker` starts every walk from the global scope; `NameResolver` resolves `true`, `false` and `null` in a namespace to the global name (`php-ast`).

#### Printer

- Printed code PHP rejects or reads differently: `- -$a` and `+ ++$a`, braces in `"{$a}b"`, mixed group `use` kinds, `$a->{$n . 'b'}(...)`, attributes on anonymous classes, hooks on promoted properties, the precedence of `and`, `or`, `xor`, `|>`, casts and `!`, and inline HTML around `<?php ?>` and in `switch` cases.
- Comments: kept on their own line or at the end of the line, inside arrays, argument lists and method chains, around doc comments, and after the last statement; doc comments are re-indented under `/**`.
- Floats below `1e-4` or from `1e15` use exponent notation, and non-UTF-8 string bytes are written as escapes (`php-printer`).

---

## [0.23.0] - 2026-10-18

### Changed

- **Breaking:** `serde` is now an opt-in feature instead of an unconditional dependency. `Serialize` impls for the AST and the `php_ast::fingerprint` module require `features = ["serde"]`; the `php-rs-parser` feature of the same name forwards to `php-ast` and `phpdoc-parser`. A plain parse no longer compiles `serde_derive` or expands `Serialize` for the ~170 AST types (`php-ast`, `phpdoc-parser`, `php-rs-parser`).
- docs.rs builds `php-ast` and `phpdoc-parser` with all features and `php-rs-parser` with the `serde` feature (`php-ast`, `phpdoc-parser`, `php-rs-parser`).

---

## [0.22.0] - 2026-10-18

### Fixed

- Removed the unused `miette` dependency, which pulled about 70 crates into every build (`php-rs-parser`).
- `php-rs-parser` no longer has a build script; it ran `php -r` on every build only to configure its own tests, which now detect PHP at run time (`php-rs-parser`).
- Every published crate now ships its `LICENSE` file, as BSD-3-Clause requires.
- `Cargo.lock` is committed, so `cargo publish --locked` and the MSRV job build against known dependency versions.
- **Deeply nested input no longer overflows the stack.** Statements, expressions and the code inside string interpolation now share one recursion budget of 512 levels, and input nested deeper reports the new `ParseError::NestingTooDeep` instead of aborting the process. Statement nesting had no limit at all and interpolated code restarted the count at zero, so about 10 KB of `{` or `if (1) {` was enough to crash. The budget is sized so that the costliest paths stay within about 1 MiB of stack in release builds (`php-rs-parser`).
- Expressions nested more than 50 levels deep are no longer rejected. Most constructs (`[`, `(`, `f(`, `match (`) take one level of the 512-level budget; some take two, e.g. `($x + (...))` (`php-rs-parser`).
- Nested strings inside interpolation (`"{$a["{$b[...]}"]}"`, nested heredocs) no longer take quadratic time. Every nested string is re-lexed by its own sub-parser, so each one now takes a larger share of the budget, which keeps string nesting under 32 levels (`php-rs-parser`).
- The lexer skips nested strings inside `{$...}` with an explicit stack instead of recursion; deeply nested double-quoted strings overflowed the stack before the parser's limit applied (`php-lexer`).
- `parse()` no longer overflows the stack on long left-associative or postfix chains such as a 20,000-term concatenation or method chain: converting the AST to its owned form and back, and dropping the owned form, walk chains iteratively (`php-ast`).
- The printer prints such chains without recursing per link, and its depth guard now sits well above anything the parser accepts, so a 300-term concatenation is no longer printed as `/* max depth */` (`php-printer`).
- Sources over 4 GiB are refused in release builds too. The size guard was a `debug_assert!`, so release builds wrapped the `u32` span offsets and could slice the wrong text or panic. The `parse_*` functions now return an empty program with the new `ParseError::SourceTooLarge`, and `Lexer::new`/`Lexer::new_at` yield only `Eof` with a `LexerErrorKind::FileTooLarge` error (`php-lexer`, `php-rs-parser`).
- The WebAssembly build reserves an 8 MiB stack instead of the 1 MiB default; wasm has no guard page, so an overflow there would corrupt memory rather than trap (`php-wasm`).
- `errors_truncated` is `true` only when errors were actually dropped; it was also set when exactly 100 errors were reported (`php-rs-parser`).
- `ParseError::UnclosedDelimiter` reads "expected ')' to close the delimiter opened at byte 3074" instead of "unclosed '')'' opened at Span { start: 3074, end: 3075 }", and its `delimiter` field holds `')'` rather than `'')''` (`php-rs-parser`).
- `SourceMap::line_col_to_offset` returns `None` for a column past the end of its line instead of an offset on a later line, and no longer overflows on a huge column (`php-rs-parser`).

### Added

- `php_ast::fingerprint::structural_fingerprint` hashes any AST node (arena or owned) while ignoring every `Span`, so a declaration that only moved keeps its fingerprint. It is meant for incremental analyzers: comparing fingerprints lets a salsa query backdate a function or method whose code did not change when the file around it was edited (`php-ast`).
- `Param::new` and `MethodDecl::new` in the arena and owned AST (`php-ast`).
- `TokenKind::description` (`php-lexer`).
- `ScopeVisitor` and `OwnedScopeVisitor` gain `visit_name` and `visit_block`, and `FoldOwned` gains `fold_trait_use` and `fold_trait_adaptation` (with `fold_owned_trait_use`/`fold_owned_trait_adaptation`), matching the plain visitors and the arena `Fold`. All have default bodies (`php-ast`).
- `NameStr::new_in` builds a `NameStr` in an arena without the hidden `__arena` constructor (`php-ast`).
- `php_ast::bumpalo` and `php_rs_parser::bumpalo` re-export the arena allocator that appears in their APIs (`php-ast`, `php-rs-parser`).
- Pull requests run `cargo-semver-checks` against their base branch (informational), and the release workflow runs it against crates.io before publishing.
- `Lexer::is_verbatim_string` reports whether a quoted-string token contains no escape sequence (and, for a double-quoted string, no `$`), as recorded while lexing it (`php-lexer`).
- `ParseResult`, `SourceMap`, `PrinterConfig` and `Indent` implement `Debug` and `Clone` (`SourceMap`, `PrinterConfig` and `Indent` also `PartialEq`/`Eq`, `Indent` also `Copy`); `ArenaParseResult` and `ParserContext` implement `Debug` (`php-rs-parser`, `php-printer`).

### Changed

- **Breaking:** every public enum is `#[non_exhaustive]` — all AST enums (`ExprKind`, `StmtKind`, `BinaryOp`, `TypeHintKind`, …, arena and owned), `PhpVersion`, `ParseError`, `Severity`, `TokenKind`, `LexerErrorKind`, `Indent` and `TextSegment` — so new PHP syntax and versions can be added without a major release. Matches on them outside these crates need a `_` arm. The structs most likely to grow fields are `#[non_exhaustive]` too: `Param`, `MethodDecl` (arena and owned), `ClassModifiers`, `ParseResult`, `ArenaParseResult` and `PrinterConfig`. Build them with `Param::new`/`MethodDecl::new` or `Default::default()` and assign the remaining public fields, e.g. `let mut config = PrinterConfig::default(); config.indent = Indent::Spaces(2);` (all crates).
- The printer writes `/* unsupported … */` for a node kind it does not know, rather than dropping it silently (`php-printer`).
- **Breaking:** `ParseError::Expected::found` is a `Cow<'static, str>` description (e.g. `"';'"`, `"identifier"`) instead of a `php_lexer::TokenKind`, so new lexer tokens are no longer a breaking change for `php-rs-parser`. The error message text is unchanged. `TokenKind::description` returns the same text as its `Display` (`php-rs-parser`, `php-lexer`).
- **Breaking:** the printer-only offsets are `Span`s of the token they mark: `IfStmt::else_kw_start` → `else_kw_span`, `TryCatchStmt::finally_kw_start` → `finally_kw_span`, `MatchExpr::brace_start` → `brace_span`, `TraitUseDecl::adaptations_brace_start` → `adaptations_brace_span`, in both the arena and owned AST. They are still not serialized (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `php_rs_parser::instrument` is public only with the `instrument` feature, and `owned::from_owned_program` is `#[doc(hidden)]`: both are internals, not stable API (`php-rs-parser`, `php-ast`).
- **Breaking:** `ExprKind::String` holds a `NameStr` instead of `&'arena str`, so literals without escape sequences borrow the source instead of being copied into the arena. `NameStr` derefs to `str`; use `.as_str()` where a `&str` is needed (`php-ast`, `php-rs-parser`).
- Faster parsing, measured on the Laravel framework with its vendor directory (95 MB), the workload of the `mir` analyzer: arena parsing is ~14% faster and `parse()` ~10% faster. String literals are no longer copied into the arena, the parser no longer rescans each quoted string for escapes or interpolation that the lexer already saw, double-quoted strings are lexed with a vectorised search instead of byte by byte, and array literals start with room for two elements instead of growing from zero. Arena memory use is ~7% lower (`php-lexer`, `php-rs-parser`).
- PHPDoc parsing is ~27% faster with identical output: lines are borrowed from the comment rather than copied, and text is appended directly instead of being built and merged (`phpdoc-parser`).
- `ParseError` has new `NestingTooDeep` and `SourceTooLarge` variants; exhaustive matches need extra arms. Exceeding the nesting limit used to produce `ParseError::Forbidden` with the message "maximum expression nesting depth exceeded" (`php-rs-parser`).
- `php_ast::owned::Expr` implements `Drop`, so its fields can no longer be moved out by destructuring; take them with `std::mem::replace(&mut expr.kind, ExprKind::Error)` instead (`php-ast`).
- **Breaking:** `ParseError::VersionTooLow::required` and `::used` are `PhpVersion` values instead of strings. The message text is unchanged (`php-rs-parser`).
- **Breaking:** `ResolvedName::Special` holds a `SpecialClass` enum (`Self_`, `Static`, `Parent`) instead of a `&'static str` (`php-ast`).
- **Breaking:** `ExprKind::ThrowExpr` is renamed to `ExprKind::Throw`, matching `StmtKind::Throw`, in the arena and owned AST and in serialized output (`php-ast`).
- **Breaking:** `ExprKind::StaticDynMethodCall` and `StaticDynMethodCallExpr` are renamed to `StaticMethodCallDynamic` and `StaticMethodCallDynamicExpr`, matching `ClassConstAccessDynamic` and `StaticPropertyAccessDynamic` (`php-ast`).
- **Breaking:** `StmtKind::Label` holds an `Ident` borrowed from the source, like `StmtKind::Goto`, instead of an arena-allocated `&str` (`Box<str>` in the owned AST). Serialized output is unchanged (`php-ast`, `php-rs-parser`).
- **Breaking:** `owned::Ident` is a struct instead of an alias for `Option<Box<str>>`, with the same API as the arena `Ident`: `Ident::name`, `Ident::ERROR`, `as_str`, `is_error`, `or_error`, `Display` and `PartialEq<&str>`. Serialized output is unchanged (`php-ast`).
- **Breaking:** `phpdoc_parser::Span` is a re-export of `php_ast::Span` instead of its own type, so PHPDoc and AST spans share one type; PHPDoc offsets are still relative to the docblock text. `phpdoc-parser` now depends on `php-ast` (`phpdoc-parser`).
- **Breaking:** `phpdoc_parser::body_text` takes `Option<&PhpDocText>` instead of `&Option<PhpDocText>` (call it with `tag.body.as_ref()`), and `find_tags` and `inline_tags` return iterators instead of `Vec`s (`phpdoc-parser`).
- **Breaking:** the parse entry points take a `ParseOptions` (target `version`, whether to build the `source_map`) instead of coming in one function per combination. `parse_versioned(src, v)` becomes `parse_with(src, &ParseOptions::default().version(v))`, `parse_arena_versioned` becomes `parse_arena_with`, and `parse_arena_raw` becomes `parse_arena_with` with `.source_map(false)`. `ParserContext::with_options` and `set_options` replace `reparse_versioned` and `reparse_owned_versioned` (`php-rs-parser`).
- **Breaking:** the ten `pretty_print*` functions are replaced by `pretty_print` and a `PrettyPrinter` builder; both accept the arena and the owned program. `pretty_print_owned(p)` becomes `pretty_print(p)`, and the `_with_config`, `_with_comments` and `_file` variants become `PrettyPrinter::new().config(c).comments(source, &comments).trailing_newline(true).print(p)`. The trailing newline follows `PrinterConfig::newline` (`php-printer`).
- The serde/JSON shape of the AST is documented as outside the semver guarantee: it may change in any release, and `Deserialize` is not implemented (`php-ast`, `phpdoc-parser`).
- **Breaking:** `PrinterConfig::newline` is a `Newline` enum (`Lf`, the default, or `CrLf`) instead of a `&'static str` (`php-printer`).
---

## [0.21.0] - 2026-09-29

### Added

- **`NameResolver`** — resolves class, function and const names to fully qualified names using the current namespace and `use` imports (including group uses and aliases), for both the arena and owned ASTs (`php-ast`).

### Changed

- `Scope` and `OwnedScope` are now `#[non_exhaustive]` (`php-ast`).
- Lexer no longer runs a heredoc probe before every token, making parsing ~13% faster on the Laravel framework source (`php-lexer`).

---

## [0.20.0] - 2026-09-29

### Added

- **PHP 8.6 doc comments on function parameters** — `Param` now has a `doc_comment` field, populated from a `/** ... */` block placed either immediately before a parameter or trailing it up to the comma (e.g. `function f(/** the id */ int $id, string $name /** display name */) {}`), per the [DocComments For Function Parameters RFC](https://wiki.php.net/rfc/parameter-doccomments). Since a bare comment is legal PHP at any version, attachment isn't gated behind `PhpVersion::Php86` (`php-ast`, `php-rs-parser`, `php-printer`).

---

## [0.19.2] - 2026-08-27

### Fixed

- A doc comment nested inside an earlier statement's own parens/brackets (e.g. above a closure argument in a call: `foo(/** @param T $x */ fn($x) => ..., $other)`) is no longer stolen by whichever unrelated statement is parsed next. `Parser` now also tracks the end of the most recently fully-parsed statement (`last_stmt_end`) and floors every doc-comment claim by it, in addition to the existing scope-brace floor — closing the gap for statements that close without ever opening a `{`/`}` of their own. Three existing fixture snapshots (`comments_in_array.phpt`, `comments_in_function_arguments.phpt`, `comments_in_method_chains.phpt`) had this exact leak baked into their expected AST and are corrected (`php-rs-parser`).

---

## [0.19.1] - 2026-08-25

### Fixed

- A doc comment above a `use SomeTrait;` declaration is no longer stolen by whichever member is parsed next (e.g. the constructor); `TraitUseDecl` now has its own `doc_comment` slot, captured before the adaptations block is parsed. The enum body's trait-use parsing, which had the same gap, now shares the class body's parser instead of duplicating it (`php-ast`, `php-rs-parser`, `php-printer`).

---

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
