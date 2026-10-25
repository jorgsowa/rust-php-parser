# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- `ForbiddenRule::UnexpectedCast`, `ForbiddenRule::DefaultValueType`, `ForbiddenRule::PrivateFinalPropertyHook`, `ForbiddenRule::SetHookParameterDefault`, `ForbiddenRule::PartialApplicationWithUnpacking`, `ForbiddenRule::EnumCaseValueType` and `ForbiddenRule::DuplicateEnumCaseValue` (`php-rs-parser`).
- `ForeachStmt::key_by_ref` for a key taken by reference, `invalid_modifier` on a trait alias for `static`, `abstract` or `readonly`, and `PropertyHook::empty_param_list` for a hook written with `()` (`php-ast`).

### Changed

- `new Foo(...)` and `#[Foo(...)]` keep the `...` as an `ArgKind::SpreadPlaceholder` argument instead of no arguments (`php-rs-parser`).

### Fixed

- From PHP 8.0, `::class` on a parenthesized expression PHP folds to a value, such as `(-1)::class`, `(!1)::class`, `(Foo::class)::class` or, before 8.2, `(1 . 2)::class`, reports `Cannot use "::class" on value of type int` (`on int` from 8.3) (`php-rs-parser`).
- On PHP 7.4, magic methods are checked as PHP 7.4 checks them: a constructor, destructor or `__clone` cannot be static or declare a return type, the property, call and conversion methods take their argument count and no references, and parameter and return types are not checked, with PHP 7.4's messages (`php-rs-parser`).
- On PHP 7.4, a control character before or after a simple string offset, as in `"$a[\x01x]"`, is skipped with a warning as PHP's lexer does, instead of making the offset invalid (`php-rs-parser`).
- On PHP 7.4, `#[` inside a `{$…}` interpolation starts a comment, as everywhere else in PHP 7.4 code, so `"{$a[1 #[x` followed by a newline and `]}"` reads `$a[1]` (`php-rs-parser`).
- On PHP 7.4, functions, imports and classes, interfaces and traits that PHP binds at compile time may come before the first `namespace` declaration (`php-rs-parser`).
- On PHP 7.4, `parent` in a class without a parent is resolved at run time, so `parent::f()`, `new parent` and a `parent` type there no longer report `Cannot use "parent" when current class scope has no parent` (`php-rs-parser`).
- On PHP 7.4, `::class` on a string literal or an unparenthesized `true`, `false` or `null`, as in `"Foo"::class` or `('Foo')::class`, is resolved at compile time and no longer reports a dynamic class name (`php-rs-parser`).
- A bare `true`, `false` or `null` before `::` is printed without parentheses, so `true::class` is not printed as the invalid `(true)::class` (`php-printer`).
- On PHP 7.4, `readonly` followed by `\` is the start of a name, so `private readonly \Closure $x;` declares a property of type `readonly\Closure` (`php-rs-parser`).
- An unqualified import named by a keyword, such as `use Class;`, `use A\{B, List};`, `use const Var;` or, from PHP 8.0, `use function match;`, reports an error (`php-rs-parser`).
- On PHP 7.4, `match` is a name, so `function match() {}`, `match($x);`, `Match::X`, `class Match {}`, `const MATCH = 1;` and the label `match:` are valid; only `match (...) {` reports that match expressions need PHP 8.0 (`php-rs-parser`).
- A trait named after a reserved type, such as `trait int {}` or, from PHP 8.0, `trait mixed {}`, reports an error (`php-rs-parser`).
- On PHP 7.4, `mixed` is a class name, so `class mixed {}`, `use A\B as mixed;` and `function f(mixed $a)` are valid and no longer report `'mixed type' requires PHP 8.0` (`php-rs-parser`).
- From PHP 8.6, a pipe is compiled as the call it makes, so its result can be written to like a call's, as in `(1 |> f(...))->p ??= 99;` and `(1 |> f(...))[0] = 1;` (`php-rs-parser`).
- Before PHP 8.3, `yield` and `from` separated by a comment are `yield` of the constant `from`, so `yield /**/ from [1];` yields `from[1]` and `yield/**/from;` is valid (`php-rs-parser`).
- A `yield` key or value that starts with the constant `from` is parenthesized, so it is not printed as `yield from` (`php-printer`).
- The right operand of `&&`, `||`, `and` or `or` no longer reports compile errors when PHP may fold the left operand away: `exit` before PHP 8.4, `empty()` of a literal and a literal `instanceof` fold exactly, and a literal condition whose value is not computed, such as `1 < 2`, `~1`, `@1`, `+print $a`, `M_PI`, `self::class` in a class, or `0 != 9 or $a`, is assumed to skip it (`php-rs-parser`).
- From PHP 8.5, `!` on a float is not folded at compile time, so `!1.5 and isset(1 + 1);` and `const A = !1.5 && $a;` report PHP's errors (`php-rs-parser`).
- On PHP 7.4, arithmetic that PHP folds at compile time on an array literal, such as `[] - 1`, `[1] + 1` or `-[]`, and `~` on `true`, `false`, `null`, a folded `!` such as `~!2`, or an array report `Unsupported operand types` (`php-rs-parser`).
- A `print` expression or literal arithmetic and concatenation on the left of `&&`, `||`, `and` or `or` folds as in PHP, so the right operand it skips no longer reports compile errors, as in `print $a or isset(1 + 1);` and `-1 || $a ? 1 : 2 ? 3 : 4;` (`php-rs-parser`).
- When printing for PHP 7.4, `.` is parenthesized at the precedence of `+` and `-`, so `1 . (2 << 1)` keeps its parentheses (`php-printer`).
- On PHP 7.4, `.` has the precedence of `+` and `-` and binds tighter than `<<` and `>>`, so `"a" . 1 + 2` parses as `("a" . 1) + 2` and `1 . 2 << 1` as `(1 . 2) << 1` (`php-rs-parser`).
- On PHP 8.0 and 8.1, yielding a nullsafe chain from a by-reference generator (`function &f() { yield $a?->b; }`) is accepted; PHP checks it from 8.2 (`php-rs-parser`).
- Before PHP 8.4, `parent::$prop::get()` is an ordinary static call on a static property, so outside a class it no longer reports `Cannot use "parent" when no class scope is active` or the property hook call errors (`php-rs-parser`).
- On PHP 8.0 to 8.3, a curly brace offset that is the base of another fetch or call, as in `$a{0}->b`, `$a{0}[1]`, `$a{0}::$c` or `$a{0}->m()`, is accepted as PHP does; PHP checks it only where it folds an array literal or a PHP 8.3 `static` initializer (`[$a{0}->b]` from PHP 8.2) (`php-rs-parser`).
- Before PHP 8.4, calling a new object without wrapping parentheses (`new Foo()()`) and dereferencing a new anonymous class (`new class {}->foo`, `new class {}()`) report `'dereferencing a new expression without parentheses' requires PHP 8.4 or higher` (`php-rs-parser`).
- `++` and `--` bind tighter than `**`, so `--$a ** 2` parses as `(--$a) ** 2` instead of reporting `Cannot increment or decrement an expression that is not a variable` (`php-rs-parser`).
- Constant expressions fold only what PHP folds: literals and their arithmetic and concatenation, magic constants, `X::class`, and outside parameter defaults the internal constants PHP substitutes (unqualified outside a namespace, or fully qualified) and earlier constants of the class being declared. So `const A = FOO ?? $x;`, `FOO ? 1 : $x`, `-0.0 || $x`, `(1-1) ? 1 : $x`, `function f($a = PHP_INT_MAX ?? $x)`, `(B)::C`, `B::C::D`, `new (B)` and `('a' ? 'b' : 'c')::class` report PHP's errors (`php-rs-parser`).
- Enum methods and constants read their modifiers like class members, so `public public function`, `public private function`, `final final function` and `public(set) const` in an enum report PHP's errors instead of passing or cascading. Abstract enum methods report PHP's message for the version (`Enum method E::f() must not be abstract` from PHP 8.5). Modifier errors use PHP's wording for the version: `Cannot use 'static' as constant modifier` before PHP 8.3, `Cannot use the static modifier on a class constant` from it, likewise for `abstract` and `readonly` constants and readonly methods, and `Cannot use the final modifier on an abstract method` or `abstract class member`. `private(set)` on a method or constant reports `Cannot use the private(set) modifier on a method` (`php-rs-parser`).
- On PHP 7.4, an abstract private method in a trait reports `Abstract function T::f() cannot be declared private`. On PHP 8.1, a literal backed enum case value of the wrong type or one that repeats an earlier case reports PHP 8.1's `Enum case type string does not match enum backing type int` or `Duplicate value in enum E for cases A and B`. A value on a case of a pure enum says `non-backed enum` with the namespaced name, as PHP does (`php-rs-parser`).
- On PHP 8.4, `#[\Deprecated]` on a class, interface, trait or enum reports PHP's `Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)`; classes and constants are targets from PHP 8.5. Attributes on a constant before PHP 8.5 report only the version error (`php-rs-parser`).
- From PHP 8.6, a placeholder with argument unpacking, as in `f(...$a, ?)`, reports PHP's `Cannot combine partial application and unpacking`, a placeholder in an attribute argument list `Cannot create Closure as attribute argument`, and a placeholder in `new A(?)` PHP's `Cannot create Closure for new expression` (`php-rs-parser`).
- A `final` hook on a private property reports PHP's `Property hook cannot be both final and private`, a `set` hook parameter with a default value `Parameter $value of set hook A::$x must not have a default value`, and from PHP 8.6 asymmetric visibility on a virtual property says `get-only` or `set-only` as PHP does (`php-rs-parser`).
- Inline HTML before the first namespace, as in `x<?php namespace A;`, or after a braced namespace reports PHP's namespace errors (`php-rs-parser`).
- A `use` whose implicit alias is a special class name, as in `use A\int;`, `use A\{self};` or, from PHP 8.5, `use A\array;`, reports PHP's `Cannot use A\int as int because 'int' is a special class name` (`php-rs-parser`).
- A literal default value that a parameter's or property's type rejects, as in `int $x = 'a'`, `array $a = 1`, `Foo $f = 1` or a property `int $p = null`, reports PHP's error for the target version, including PHP 7.4's wording and PHP 8.1's `Cannot use null as default value` for an intersection type. A typed class constant also checks array values, and messages spell `iterable` as `Traversable|array` only from PHP 8.2, as PHP does (`php-rs-parser`).
- A number offset in simple interpolation with a misplaced `_`, as in `"$a[1_]"`, `"$a[1__2]"` or `"$a[0x_1]"`, or an `0o` octal before PHP 8.1, is an error, as in PHP (`php-rs-parser`).
- A cast token where no cast can start, as in `foo(int)`, `if (int) {}` or, from PHP 8.5, `foo(void)`, reports PHP's `unexpected token "(int)"` (`php-rs-parser`).
- An intersection type without parentheses in a union, as in `A&B|C $a` or `: A&B|C`, is a syntax error, as in PHP (`php-rs-parser`).
- A reserved keyword where PHP expects a class name, as in `new fn`, `new match`, `new array`, `catch (array $e)`, `extends fn` or `use fn;` in a class body, is a syntax error, and from PHP 8.1 `readonly` after `new` starts an anonymous class, so `new readonly;` reports the missing `class` and `new readonly readonly class {}` PHP's `Multiple readonly modifiers are not allowed` (`php-rs-parser`).
- The printer keeps PHP's error instead of printing valid code for a foreach key taken by reference, a trait alias with `static`, `abstract` or `readonly`, `new Foo(...)`, `#[Foo(...)]`, a property hook with an empty `()`, a redeclared hook spelled in another case, such as `set {} SET {}`, and, when given the source, a destructuring target that mixes `list()` and `[]` (`php-printer`).

## [0.26.0] - 2026-10-24

Error messages and recovery follow PHP more closely, spans are ordered and stay inside their parent, and the printer keeps invalid code invalid.

### Added

- `ParseError::UnmatchedDelimiter` for a `}` that closes nothing, and `ForbiddenRule::CallResultWrite`, `ForbiddenRule::ListAsForeachKey` and `ForbiddenRule::UnexpectedCharacter` (`php-rs-parser`).
- `LexerErrorKind::UnexpectedCharacter` for a control character in code (`php-lexer`).
- `missing_param_list` on `FunctionDecl`, `MethodDecl`, `ClosureExpr` and `ArrowFunctionExpr`, for a parameter list missing its `(` (`php-ast`).
- `empty_hook_list` on `PropertyDecl` and `Param`, for an empty hook list `{}` (`php-ast`).
- `ForeachStmt::by_ref_span`, the `&` of a by-reference value (`php-ast`).
- `Modifiers::is_var` for a property declared with `var` (`php-ast`).
- `PrinterConfig::php_version`, the PHP version the output is for (`php-printer`).

### Changed

- `PhpVersion` lives in `php-ast`; `php-rs-parser` re-exports it at the same paths (`php-ast`, `php-rs-parser`).
- The `CloseTag` token includes the one newline after `?>` (`\n`, `\r\n` or `\r`), as PHP's `T_CLOSE_TAG` does, so the `InlineHtml` after it holds only the output (`php-lexer`, `php-rs-parser`).
- A `?>` that is a statement of its own, as after `;`, `}`, `:` or another tag, is a `Nop` spanning the `?>` and its newline; a `?>` that ends the statement before it adds nothing, and `?><?php` no longer adds a `Nop` (`php-rs-parser`).
- `<?= ?>` and `<?=` at the end of the file are an `Echo` holding an `Error`, like `<?= ;` (`php-rs-parser`).
- Error messages match PHP's for:
  - a positional or unpacked argument after a named one, an unparenthesized nested ternary and an unparenthesized arrow function after `|>`;
  - a write to a call result, as in `f() = 1`, `$a->f()++`, `unset(f())` or `[f()] = $a` (`Can't use function return value in write context`, or `method` for a method), and a list as a `foreach` key (`Cannot use list as key element`);
  - from PHP 8.4, a `void` or `never` return error in a method, or in a closure or arrow function inside a class (`A void method must not return a value`), and `return null;` from a `void` function, which adds `(did you mean "return;" instead of "return null;"?)`;
  - `break` or `continue` outside a loop or `switch` (`'break' not in the 'loop' or 'switch' context` instead of `Cannot 'break' 1 level`);
  - a repeated member or promoted-parameter modifier, such as `public public` or `public private(set) protected(set)` (`Multiple access type modifiers are not allowed`, `Multiple static modifiers are not allowed`);
  - a repeated class modifier, as in `readonly readonly class` (`Multiple readonly modifiers are not allowed` instead of a syntax error), and `abstract final class` (`Cannot use the final modifier on an abstract class`);
  - a repeated property hook (`Cannot redeclare property hook "get"`, with the hook name as written, instead of `duplicate 'get' hook`);
  - a nested `__halt_compiler()` (`__HALT_COMPILER() can only be used from the outermost scope`), which is now a statement of its own: parsing goes on after it, so it no longer reports `missing closing '}'`, and its node ends at its `;` (`php-rs-parser`).
- A `}` at the top level that closes nothing reports `unmatched '}'`, as PHP's `Unmatched '}'`, instead of `expected expression, found '}'` and `No code may exist outside of namespace {}` (`php-rs-parser`).
- An unclosed statement or declaration body reports `missing closing '}'`, and a body missing its `{` reports only that, not also its `}` (`php-rs-parser`).
- A namespaced name starting with a keyword where it is not expected, as in `class A implements\B {}`, is reported over the whole name, as PHP lexes it (`php-rs-parser`).
- Fewer recovery cascades (`php-rs-parser`):
  - a syntax error at the same token as the previous one is dropped, as in `<?php if }` or a body missing at the end of the file;
  - a `try` whose body is missing its `{` or `}` no longer also reports a missing `catch` or `finally`;
  - compile errors inside an unclosed parameter list, such as `Cannot declare promoted property outside a constructor` for `function f(int $x { }`, are dropped, since PHP stops at the syntax error;
  - an `if`, `while` or `switch` missing its `(` before the `{`, as in `if { }`, reports only the missing `(`, and `for` and `foreach` no longer report an unclosed `)` whose `(` was missing;
  - a `<?php` or `<?=` inside PHP code is one error and the statement after it parses;
  - a `match` arm missing its comma reports only that, and the rest of a broken `for` header, as in `for (;;;)`, is skipped;
  - a `class` with neither a name nor a body, as in `class\Foo::x();` before PHP 8.0, no longer reads the following statements as class members.
- Spans (`php-rs-parser`):
  - a short echo's `Echo` starts at `<?=`, and a statement or enum member with attributes at its first attribute, like a class member;
  - an `elseif` branch spans from `elseif`, and an alternative-syntax then, `elseif` or `else` block from its `:` instead of from `if`;
  - an alternative-syntax `while`, `for`, `foreach`, `declare` or `switch` body spans from its `:` to its last statement, without the closing keyword, and a `catch` clause from `catch` instead of `(`;
  - each constant or property of a grouped declaration, as in `const A = 1, B = 2;` or `public $a, $b;`, spans its own item, the first one from the modifiers, and a later item keeps its own doc comment, as PHP does;
  - a dynamic property fetch spans its closing `}`, as in `$o->{'x'}`; `"${a}"` spans the whole `${a}`, like `"${a[0]}"`; and a group `use` item's name spans only the name as written, `D` in `A\{B, D}`;
  - the asymmetric-visibility version error spans the set-visibility modifier, such as `private(set)`.
- The printer drops empty statements, except where the target PHP version rejects them before a `declare`, and drops a `?>` with nothing but its newline before the next `<?php` (`php-printer`).
- The printer writes a newline after a `?>` before HTML when the source has one there, or when the HTML starts with a newline that `?>` would swallow (`php-printer`).

### Fixed

- An unclosed `exit(`, `die(` or `clone(` call no longer panics (`php-rs-parser`).
- A control character in code, including form feed, is an error from PHP 8.0 instead of being skipped (`php-lexer`, `php-rs-parser`).
- `<?php` or `<?=` inside PHP code lexes as `<`, so it is a syntax error instead of being ignored (`php-lexer`).
- A class property with a fully qualified type and no modifier, such as `\Foo $a;`, is a syntax error instead of being accepted (`php-rs-parser`).
- An enum property with a fully qualified type, such as `public \Foo\Bar $a;`, reports `Enum E cannot include properties` instead of a syntax error (`php-rs-parser`).
- A promoted parameter with only `readonly`, `final` or a set-visibility modifier, such as `private(set) int $a`, reports that promotion requires PHP 8.0 (`php-rs-parser`).
- A spread in `list()`, as in `list(...$x) = $a`, or in a `foreach` destructuring target reports PHP's `Spread operator is not supported in assignments` instead of a syntax error or `Assignments can only happen to writable values`; in a nested list it is reported at the element (`php-rs-parser`).
- A `?>` where a statement is expected, as in `if ($a) ?>x<?php`, is the empty body, and the HTML after it runs unconditionally, as in PHP (`php-rs-parser`).
- `__halt_compiler() ?>` followed by `\r` leaves the `\r` out of the data, as PHP does (`php-rs-parser`).
- A function, method, closure or arrow function missing its `(`, as in `function f {}`, `function {}` or `fn => 1`, has no parameters instead of an empty placeholder, so a function or closure body is no longer read as a parameter's property hook list (`php-rs-parser`).
- Recovery from an invalid class or enum member skips over a `{ ... }` block, so the block's `}` no longer ends the class, as in `public function @return f() {}` (`php-rs-parser`).
- A syntax error at the closing `}` of a `{$...}` interpolation, as in `"{$a->}"`, reports `found '}'` at the `}` instead of `found end of file` (`php-rs-parser`).
- No span ends before it starts: the version errors for set-only visibility on a promoted parameter and for a non-capturing `catch`, and the spans of error statements, bodies missing their `{`, `use` items, parameters, attributes, short echo tags, static variables and alternative-syntax `elseif` branches after a missing token (`php-rs-parser`).
- A node recovered from a missing or unexpected token, such as the name and parameter of `public function @return f() {}`, is empty and placed right after the last consumed token, so it lies inside its parent's span and no longer covers a token it did not consume; this includes a missing static variable after a trailing comma (`php-rs-parser`).
- A missing operand before an operator, as in `* 2;`, sits at the operator, so the expression and statement no longer start at the whitespace before it (`php-rs-parser`).
- A missing item in a group `use`, as in `use A\{B, , C};`, has an `Error` name instead of the prefix with a span covering `A\{B,` (`php-rs-parser`).
- The printer keeps PHP's error instead of printing valid code for an empty hook list `{}` (it printed `;`), a function, method, closure or arrow function missing its `(` (it added `()`), and, when given the source, a nested ternary or an arrow function after `|>` written without parentheses, such as `$a ? $b : $c ? $d : $e` or `1 |> fn($x) => $x`. Without the source, the printer still adds the parentheses (`php-printer`).
- Printing keeps whether a `declare(encoding=...)` or `declare(strict_types=...)` after an empty statement is valid, instead of making a `?>` that ends a statement before one an error (`php-printer`).
- A heredoc line whose escapes decode to the closing label, as `\x45OT` in `<<<EOT`, prints with its first byte escaped instead of ending the heredoc early (`php-printer`).
- A control character in a string, backtick or heredoc literal prints as `\xNN` instead of the raw byte, so `"a\0b"` prints as `"a\x00b"` instead of a single-quoted string holding a NUL, consistent with `\e`, `\f` and `\v` (`php-printer`).
- A grouped constant or property is split into declarations that keep their own doc comments, instead of moving `/** q */` in `public $p, /** q */ $q;` to the next member (`php-printer`).
- A comment before a property hook, such as a doc comment on `set(int $value) {}` or `// c` before `get`, prints before the hook instead of between its parameter list or keyword and its body (`php-printer`).
- A property declared with `var` prints as `var` instead of `public` (`php-printer`).
- A blank line follows a function, class-like or namespace declaration as well as preceding it (`php-printer`).
- An empty alternative-syntax body, as in `foreach ($a as &$v): endforeach;` or `if ($a): endif;`, prints without a blank line (`php-printer`).

## [0.25.1] - 2026-10-22

### Added

- `Lexer::with_attributes`; when disabled, `#[` starts a `#` comment (`php-lexer`).
- `EnumMemberKind::Property` for a property declared in an enum, and `ForbiddenRule::EnumProperty` (`php-ast`, `php-rs-parser`).

### Changed

- Faster parsing: `Name::to_string_repr` builds a fully qualified name in one allocation (`php-ast`), and the `self` / `parent` / `static` check is skipped when every use is known to be valid (`php-rs-parser`).

### Fixed

- Before PHP 8.0, `#[` starts a comment instead of an attribute, so single-line attributes such as `#[\ReturnTypeWillChange]` are accepted (`php-rs-parser`).
- A property in an enum reports `Enum E cannot include properties` and stays in the AST, instead of a syntax error (`php-rs-parser`).
- A write to a property or element of `clone $a` reports `Cannot use temporary expression in write context` before PHP 8.5 (`php-rs-parser`).

## [0.25.0] - 2026-10-22

Errors are machine-readable: every `ParseError` has a stable code, and every compile-time error names the rule it breaks. Version-targeted parsing follows each PHP version from 7.4 to 8.6 much more closely.

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
- Compile-time checks no longer reject valid code (`Enum` in intersection types, foldable class names, short-circuit folding, set hook parameter types, heredoc indentation inside interpolations) and catch stray semicolons in class bodies, `var` with other modifiers, `final private` and pre-8.1 `final` constants, reserved enum names, invalid typed enum constants, by-reference `get` hooks with a `set` hook and `<?=` without an expression (`php-rs-parser`).
- A parenthesized constant named like a cast keyword, such as `(int)`, no longer prints as a cast (`php-printer`).

## [0.24.1] - 2026-10-21

### Fixed

- An unqualified `static` in a type position reports the PHP 8.5 error (`php-rs-parser`).

## [0.24.0] - 2026-10-21

### Added

- `php_ast::Modifiers` (`visibility`, `set_visibility`, `is_static`, `is_abstract`, `is_final`, `is_readonly`), shared by methods, properties, parameters, class constants and property hooks (`php-ast`).
- `php_ast::ByteStr` (arena) and `php_ast::owned::ByteString`: a PHP string literal's value as bytes, with `as_bytes()`, `to_str()` and `to_string_lossy()`. With `serde`, valid UTF-8 serializes as a string and anything else as `{"bytes": [..]}` (`php-ast`).
- `Fold::fold_stmts` and `OwnedFold::fold_stmts`, called for the program, every block and every `case` body, so a fold can delete, split or insert statements (`php-ast`).
- `walk_trait_adaptation`, `walk_owned_trait_adaptation`, and `walk_owned_block` / `fold_owned_block` re-exported from `php_ast::owned` (`php-ast`).
- `new` constructors for the node structs that are now `#[non_exhaustive]` (`php-ast`).
- Owned `Name::span()`, `kind()`, `to_string_repr()`, `join_parts()` and `Expr::name_str()`, `into_kind()`, like their arena counterparts (`php-ast`).

### Changed

- **Breaking:** function, class and constant references in expressions are `ExprKind::Name(Name)` instead of `ExprKind::Identifier`, so `visit_name`, `fold_name` and `NameResolver` see them. `Identifier` stays for member names after `->`, `?->` and `::` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `Ident` carries the `span` of its token. `Ident::name(s)` and `Ident::ERROR` are replaced by `Ident::new(s, span)` and `Ident::error(span)`; `CatchClause::var`, `UseItem::alias` and `ClosureUseVar::name` are `Ident`. A real identifier serializes as `{"name", "span"}` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `Arg` has `kind: ArgKind` and `ArrayElement` has `kind: ArrayElementKind` instead of `value` + `unpack` + `by_ref`. Read them with `value()`, `is_spread()`, `is_by_ref()` and `is_placeholder()` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `MethodDecl`, `PropertyDecl`, `Param`, `ClassConstDecl` and `PropertyHook` carry `modifiers: Modifiers` instead of separate `visibility`, `is_static`, `is_final`, … fields (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `ExprKind::String` and `StringPart::Literal` hold a `ByteStr` / `ByteString` instead of a `str`, because a PHP string is bytes. Nowdoc values are unchanged (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** new fields for modifiers that were parsed and dropped: `PropertyDecl::is_final` / `is_abstract` (PHP 8.4), `ForeachStmt::by_ref`, and `TraitAdaptationKind::Alias::is_final`. Each is serialized only when `true` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** every diagnostic is an error, matching `php -l`; PHP warnings are not reported (`php-rs-parser`).
- **Breaking:** `Visitor`, `ScopeVisitor`, `OwnedVisitor` and `OwnedScopeVisitor` have an associated `type Break`, and `visit_*` / `walk_*` return `ControlFlow<Self::Break>`. Existing visitors add `type Break = ();` (`php-ast`).
- **Breaking:** `FoldOwned` is renamed `OwnedFold` and takes every node by value; `fold_owned_*` move the children they keep instead of cloning them. `Fold::fold_closure_use_var` takes the arena (`php-ast`).
- **Breaking:** the `serde` feature of `php-rs-parser` no longer enables `phpdoc-parser/serde` (`php-rs-parser`).
- **Breaking:** the most extensible structs (`ClassDecl`, `FunctionDecl`, `ClosureExpr`, `IfStmt`, `ForeachStmt`, `TryCatchStmt`, `UseDecl`, … in arena and owned form), the struct variants of `ParseError` and `LexerError`, and the `phpdoc-parser` structs are `#[non_exhaustive]`. Build structs with `new(..)` and match errors with `..` (`php-ast`, `php-rs-parser`, `php-lexer`, `phpdoc-parser`).
- **Breaking:** owned `Expr` implements `Drop`; take the kind out with `into_kind()` instead of destructuring (`php-ast`).
- **Breaking:** `NameStr::__src` / `__arena` are the documented `from_source` / `from_arena`; `ArenaVec::into_iter` returns `php_ast::ast::IntoIter`; `Lexer::errors` is the `errors()` accessor. Printer-only spans and `Lexer::is_verbatim_string` are `#[doc(hidden)]` and outside semver (`php-ast`, `php-lexer`, `php-rs-parser`).
- The printer puts trait `use` first in class bodies, sorts each run of top-level `use` imports, opens anonymous class braces on the same line, puts a blank line before a member that starts with a comment, and indents a comment in an empty block (`php-printer`).

### Removed

- **Breaking:** `BuiltinType::Integer`, `Double` and `Boolean`; `integer`, `double` and `boolean` are class names and parse as `TypeHintKind::Named` (`php-ast`, `php-rs-parser`).
- **Breaking:** `TokenKind::From`; `from` is an identifier that the parser recognizes only after `yield` (`php-lexer`).
- **Breaking:** `ParseError::ForbiddenWarning`, `Severity` and `ParseError::severity()` (`php-rs-parser`).
- **Breaking:** the `php_rs_parser::phpdoc` re-export; depend on `phpdoc-parser` directly (`php-rs-parser`).

### Fixed

#### Parser: invalid code PHP rejects

These constructs were accepted and are now reported with PHP's wording (`php-rs-parser`):

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

- `$this?->foo(...)`, `?>` ending a class member or a `case`, `goto`, `unset`, `global`, `static`, `use`, `const` or `namespace` statement, `break`, `continue`, `return` or `yield`, and a `switch` opening with `?>`/`<?php` (`php-rs-parser`).
- `use A as enum`, goto labels such as `self:` and `null:`, a method named `namespace` in a trait adaptation, `$obj->__halt_compiler`, `A&B &$x`, `abstract readonly class` below 8.4, `int\X` class names, `extends int`, a constructor parameter with hooks and no visibility, grouped class constants in enums and with attributes, `yield` in hooks and enum methods, `1...2`, and whitespace-only heredoc lines shorter than the closing indentation (`php-rs-parser`).
- `from` works as a function, class or constant name (`php-lexer`).
- `__CONSTRUCT` is recognized case-insensitively, and `private(SET)` is matched like PHP's single token (`php-rs-parser`).

#### Parser: wrong trees

- Precedence and binding: `(void) f() + 1`, `include $a or $b`, `throw $e or 1`, `yield $a or $b`, `clone($a)->b = 1`, `clone $a ** 2`, `$a = &$b + $c`, and postfix `++` / `--` against prefix operators (`php-rs-parser`).
- `new namespace\Foo` keeps the `namespace\` prefix; `A::{$m}()` is `ExprKind::StaticMethodCallDynamic` and no longer requires PHP 8.3; `#[Attr] function &f() {}` is a function, not a by-reference closure; `include \dirname(...)` and similar apply the keyword to the name (`php-rs-parser`).
- Strings: octal escapes above `\377`, surrogate `\u{D800}` escapes, `"$a?->b"`, `${expr}`, `"\xff"` and other non-UTF-8 escapes decode to the bytes PHP stores; a heredoc line inside `{$...}` that looks like the closing label no longer ends the heredoc; long float literals are no longer truncated; `declare(...) ?>` no longer takes the following HTML as its body (`php-rs-parser`).
- Grouped property declarations give every property the declared visibility, type and attributes (`php-rs-parser`).
- Version gates follow PHP for `fn(): never`, `self` in intersections, `namespace\static` and untyped readonly promotion (`php-rs-parser`).

#### Lexer

- `<?php` followed by a non-whitespace character is inline HTML, a heredoc label starting with a digit or followed by anything but a newline lexes `<<`, and a keyword followed by `\` and a name is a qualified name (`php-lexer`).

#### AST

- Deeply nested prefix operators (`~~~…$x`) parse, convert and drop without recursion (`php-rs-parser`, `php-ast`, `php-printer`).
- `Visitor`, `OwnedVisitor` and both scope walkers call `visit_name` for namespace names, named arguments and trait adaptation names; `ScopeWalker` starts every walk from the global scope; `NameResolver` resolves `true`, `false` and `null` in a namespace to the global name (`php-ast`).

#### Printer

- Printed code that PHP rejects or reads differently: `- -$a` and `+ ++$a`, braces in `"{$a}b"`, mixed group `use` kinds, `$a->{$n . 'b'}(...)`, attributes on anonymous classes, hooks on promoted properties, the precedence of `and`, `or`, `xor`, `|>`, casts and `!`, and inline HTML around `<?php ?>` and in `switch` cases (`php-printer`).
- Comments are kept on their own line or at the end of the line, inside arrays, argument lists and method chains, around doc comments, and after the last statement; doc comments are re-indented under `/**` (`php-printer`).
- Floats below `1e-4` or from `1e15` use exponent notation, and non-UTF-8 string bytes are written as escapes (`php-printer`).

## [0.23.0] - 2026-10-18

### Changed

- **Breaking:** `serde` is an opt-in feature instead of an unconditional dependency. `Serialize` impls for the AST and the `php_ast::fingerprint` module require `features = ["serde"]`; the `php-rs-parser` feature of the same name forwards to `php-ast` and `phpdoc-parser`. A plain parse no longer compiles `serde_derive` (`php-ast`, `phpdoc-parser`, `php-rs-parser`).
- docs.rs builds `php-ast` and `phpdoc-parser` with all features and `php-rs-parser` with the `serde` feature (`php-ast`, `phpdoc-parser`, `php-rs-parser`).

## [0.22.0] - 2026-10-18

### Added

- `php_ast::fingerprint::structural_fingerprint` hashes any AST node (arena or owned) while ignoring every `Span`, so a declaration that only moved keeps its fingerprint, for example to let an incremental analyzer skip unchanged functions (`php-ast`).
- `ParseError::NestingTooDeep` and `ParseError::SourceTooLarge`, and `LexerErrorKind::FileTooLarge` (`php-rs-parser`, `php-lexer`).
- `Param::new` and `MethodDecl::new` in the arena and owned AST, and `NameStr::new_in` to build a `NameStr` in an arena (`php-ast`).
- `TokenKind::description` (`php-lexer`).
- `Lexer::is_verbatim_string`, whether a quoted-string token contains no escape sequence (and, for a double-quoted string, no `$`) (`php-lexer`).
- `ScopeVisitor` and `OwnedScopeVisitor` gain `visit_name` and `visit_block`, and `FoldOwned` gains `fold_trait_use` and `fold_trait_adaptation` (with `fold_owned_trait_use` / `fold_owned_trait_adaptation`), all with default bodies (`php-ast`).
- `php_ast::bumpalo` and `php_rs_parser::bumpalo` re-export the arena allocator used in their APIs (`php-ast`, `php-rs-parser`).
- `ParseResult`, `SourceMap`, `PrinterConfig` and `Indent` implement `Debug` and `Clone` (`SourceMap`, `PrinterConfig` and `Indent` also `PartialEq` / `Eq`, `Indent` also `Copy`); `ArenaParseResult` and `ParserContext` implement `Debug` (`php-rs-parser`, `php-printer`).

### Changed

- **Breaking:** every public enum is `#[non_exhaustive]`: all AST enums (`ExprKind`, `StmtKind`, `BinaryOp`, `TypeHintKind`, …, arena and owned), `PhpVersion`, `ParseError`, `Severity`, `TokenKind`, `LexerErrorKind`, `Indent` and `TextSegment`. Matches outside these crates need a `_` arm. `Param`, `MethodDecl` (arena and owned), `ClassModifiers`, `ParseResult`, `ArenaParseResult` and `PrinterConfig` are `#[non_exhaustive]` too; build them with `new` or `Default::default()` and assign the public fields (all crates).
- **Breaking:** the parse entry points take a `ParseOptions` (target `version`, whether to build the `source_map`). `parse_versioned(src, v)` becomes `parse_with(src, &ParseOptions::default().version(v))`, `parse_arena_versioned` becomes `parse_arena_with`, and `parse_arena_raw` becomes `parse_arena_with` with `.source_map(false)`. `ParserContext::with_options` and `set_options` replace `reparse_versioned` and `reparse_owned_versioned` (`php-rs-parser`).
- **Breaking:** the ten `pretty_print*` functions are replaced by `pretty_print` and a `PrettyPrinter` builder; both accept the arena and the owned program. `pretty_print_owned(p)` becomes `pretty_print(p)`, and the `_with_config`, `_with_comments` and `_file` variants become `PrettyPrinter::new().config(c).comments(source, &comments).trailing_newline(true).print(p)`. The trailing newline follows `PrinterConfig::newline` (`php-printer`).
- **Breaking:** `PrinterConfig::newline` is a `Newline` enum (`Lf`, the default, or `CrLf`) instead of a `&'static str` (`php-printer`).
- **Breaking:** `ParseError::Expected::found` is a `Cow<'static, str>` description (e.g. `"';'"`, `"identifier"`) instead of a `php_lexer::TokenKind`. The message text is unchanged (`php-rs-parser`).
- **Breaking:** `ParseError::VersionTooLow::required` and `::used` are `PhpVersion` values instead of strings. The message text is unchanged (`php-rs-parser`).
- **Breaking:** exceeding the nesting limit reports `ParseError::NestingTooDeep` instead of `ParseError::Forbidden` (`php-rs-parser`).
- **Breaking:** `ExprKind::String` holds a `NameStr` instead of `&'arena str`, so literals without escape sequences borrow the source. Use `.as_str()` where a `&str` is needed (`php-ast`, `php-rs-parser`).
- **Breaking:** the printer-only offsets are `Span`s of the token they mark: `IfStmt::else_kw_start` → `else_kw_span`, `TryCatchStmt::finally_kw_start` → `finally_kw_span`, `MatchExpr::brace_start` → `brace_span`, `TraitUseDecl::adaptations_brace_start` → `adaptations_brace_span`, in the arena and owned AST (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `ResolvedName::Special` holds a `SpecialClass` enum (`Self_`, `Static`, `Parent`) instead of a `&'static str` (`php-ast`).
- **Breaking:** `ExprKind::ThrowExpr` is renamed `ExprKind::Throw`, matching `StmtKind::Throw`, in the arena and owned AST and in serialized output (`php-ast`).
- **Breaking:** `ExprKind::StaticDynMethodCall` and `StaticDynMethodCallExpr` are renamed `StaticMethodCallDynamic` and `StaticMethodCallDynamicExpr`, matching `ClassConstAccessDynamic` and `StaticPropertyAccessDynamic` (`php-ast`).
- **Breaking:** `StmtKind::Label` holds an `Ident` borrowed from the source, like `StmtKind::Goto`. Serialized output is unchanged (`php-ast`, `php-rs-parser`).
- **Breaking:** `owned::Ident` is a struct instead of an alias for `Option<Box<str>>`, with the same API as the arena `Ident`. Serialized output is unchanged (`php-ast`).
- **Breaking:** owned `Expr` implements `Drop`, so its fields can't be moved out by destructuring; use `std::mem::replace(&mut expr.kind, ExprKind::Error)` (`php-ast`).
- **Breaking:** `phpdoc_parser::Span` is a re-export of `php_ast::Span`; PHPDoc offsets are still relative to the docblock text. `phpdoc-parser` depends on `php-ast` (`phpdoc-parser`).
- **Breaking:** `phpdoc_parser::body_text` takes `Option<&PhpDocText>` instead of `&Option<PhpDocText>`, and `find_tags` and `inline_tags` return iterators instead of `Vec`s (`phpdoc-parser`).
- **Breaking:** `php_rs_parser::instrument` is public only with the `instrument` feature, and `owned::from_owned_program` is `#[doc(hidden)]` (`php-rs-parser`, `php-ast`).
- The serde/JSON shape of the AST is outside the semver guarantee and may change in any release; `Deserialize` is not implemented (`php-ast`, `phpdoc-parser`).
- The printer writes `/* unsupported … */` for a node kind it does not know, instead of dropping it (`php-printer`).
- Faster parsing: on the Laravel framework with its vendor directory, arena parsing is ~14% faster, `parse()` ~10% faster, and arena memory use ~7% lower (`php-lexer`, `php-rs-parser`).
- PHPDoc parsing is ~27% faster with identical output (`phpdoc-parser`).
- Statements, expressions and string interpolation share one nesting budget of 512 levels. Expressions nested more than 50 levels deep are no longer rejected; nested strings inside interpolation take a larger share, which keeps string nesting under 32 levels (`php-rs-parser`).
- Every published crate ships its `LICENSE` file, and `Cargo.lock` is committed.

### Removed

- The unused `miette` dependency, which pulled about 70 crates into every build (`php-rs-parser`).
- The build script of `php-rs-parser`, which ran `php -r` on every build (`php-rs-parser`).

### Fixed

- Deeply nested statements or interpolated code report `ParseError::NestingTooDeep` instead of overflowing the stack; about 10 KB of `{` or `if (1) {` was enough to crash (`php-rs-parser`).
- Nested strings inside interpolation (`"{$a["{$b[...]}"]}"`, nested heredocs) no longer take quadratic time (`php-rs-parser`).
- Deeply nested double-quoted strings no longer overflow the lexer's stack (`php-lexer`).
- `parse()` no longer overflows the stack on long left-associative or postfix chains, such as a 20,000-term concatenation or method chain (`php-ast`).
- The printer prints long chains without recursing per link, so a 300-term concatenation is no longer printed as `/* max depth */` (`php-printer`).
- Sources over 4 GiB are refused in release builds too, instead of wrapping the `u32` span offsets: the `parse_*` functions return an empty program with `ParseError::SourceTooLarge`, and the lexer yields only `Eof` with `LexerErrorKind::FileTooLarge` (`php-lexer`, `php-rs-parser`).
- The WebAssembly build reserves an 8 MiB stack instead of 1 MiB; wasm has no guard page, so an overflow would corrupt memory rather than trap (`php-wasm`).
- `errors_truncated` is `true` only when errors were dropped, not also when exactly 100 errors were reported (`php-rs-parser`).
- `ParseError::UnclosedDelimiter` reads "expected ')' to close the delimiter opened at byte 3074" instead of "unclosed '')'' opened at Span { start: 3074, end: 3075 }", and its `delimiter` field holds `')'` instead of `'')''` (`php-rs-parser`).
- `SourceMap::line_col_to_offset` returns `None` for a column past the end of its line instead of an offset on a later line, and no longer overflows on a huge column (`php-rs-parser`).

## [0.21.0] - 2026-09-29

### Added

- `NameResolver`, which resolves class, function and constant names to fully qualified names using the current namespace and `use` imports (including group uses and aliases), for the arena and owned ASTs (`php-ast`).

### Changed

- **Breaking:** `Scope` and `OwnedScope` are `#[non_exhaustive]` (`php-ast`).
- Parsing is ~13% faster on the Laravel framework source: the lexer no longer probes for a heredoc before every token (`php-lexer`).

## [0.20.0] - 2026-09-29

### Added

- `Param::doc_comment`, a `/** ... */` block immediately before a parameter or trailing it up to the comma, as in `function f(/** the id */ int $id, string $name /** display name */) {}`, per the PHP 8.6 [DocComments For Function Parameters RFC](https://wiki.php.net/rfc/parameter-doccomments). It is attached at every target version (`php-ast`, `php-rs-parser`, `php-printer`).

## [0.19.2] - 2026-08-27

### Fixed

- A doc comment inside an earlier statement's parentheses or brackets, as above a closure argument in `foo(/** @param T $x */ fn($x) => ..., $other)`, is no longer attached to the next statement (`php-rs-parser`).

## [0.19.1] - 2026-08-25

### Fixed

- A doc comment above a `use SomeTrait;` declaration belongs to the new `TraitUseDecl::doc_comment` instead of the next member, in classes and enums (`php-ast`, `php-rs-parser`, `php-printer`).

## [0.19.0] - 2026-07-31

### Added

- `PhpVersion::Php86` and early support for PHP 8.6 [partial function application](https://wiki.php.net/rfc/partial_function_application_v2): the `?` and `...` argument placeholders, as in `foo(1, ?, 3)`, `foo(1, ...)` and `foo(s: ?)`. Placeholders are rejected in `new`. The default target stays PHP 8.5 (`php-rs-parser`, `php-ast`, `php-printer`).

## [0.18.3] - 2026-07-17

### Fixed

- Blank lines inside an indented heredoc or nowdoc in a CRLF file no longer report "Invalid body indentation level" (`php-rs-parser`).

## [0.18.2] - 2026-07-04

### Fixed

- Several `@tag`s on one PHPDoc line, as in `@param int $x @return int` or `@template U @extends Foo<U>`, are separate tags. Only a line that starts with `@` is split, so `Contact user @example for details.` stays prose (`phpdoc-parser`).

## [0.18.1] - 2026-06-21

### Fixed

- Member access and dereference (`->`, `?->`, `[]`, `{}`, method calls) bind tighter than `**`, so `10 ** $this->maxDigits` parses as `10 ** ($this->maxDigits)` instead of `(10 ** $this)->maxDigits` (`php-rs-parser`).

## [0.18.0] - 2026-06-14

### Changed

- Attributes (`#[...]`) are version-gated to PHP 8.0 (`php-rs-parser`).
- The `0o` / `0O` octal prefix is version-gated to PHP 8.1 (`php-rs-parser`).
- A non-capturing `catch (Exception)` is version-gated to PHP 8.0 (`php-rs-parser`).
- Constants in traits are version-gated to PHP 8.2 (`php-rs-parser`).

### Fixed

- `new` with a member-access or nullsafe class reference instantiates the named class: `new $this->job()` is `new ($this->job)()`, not `(new $this)->job()`, and `new $a?->b()` is `new ($a?->b)()`, gated to PHP 8.0 (`php-rs-parser`).
- A parenless `new` with a class name can't be dereferenced: `new Foo->bar`, `new Foo::class`, `new Foo[0]` and `new self::C` are rejected. `new Foo()->bar` is gated to PHP 8.4 (`php-rs-parser`).
- Empty array elements (`[1, , 3]`) are rejected in value arrays and stay valid in destructuring (`php-rs-parser`).
- Reserved keywords are rejected as class-like and global constant names, as in `class class {}` or `const for = 1;`; `enum` and `from` stay usable, and member names stay unrestricted (`php-rs-parser`).
- A parameter after a variadic parameter is rejected; a trailing comma after the variadic is still valid (`php-rs-parser`).
- A backed enum's type must be `int` or `string` (`php-rs-parser`).
- An empty attribute group `#[]` is a syntax error (`php-rs-parser`).
- `new` in enum constant initializers is rejected, like in class constants (`php-rs-parser`).
- `<?= $a, $b ?>` parses the whole expression list (`php-rs-parser`).
- `enum Enum {}` is accepted (`php-rs-parser`).
- A statement-level `(void)` cast is allowed as the leftmost operand under any binary operator, as in `(void) $x + 1` (`php-rs-parser`).
- The same import in sibling unbraced namespaces is no longer reported as "already in use" (`php-rs-parser`).
- `new` is allowed in global constant and static variable initializers, as PHP 8.1 permits (`php-rs-parser`).
- `final` properties are version-gated to PHP 8.4 instead of always rejected (`php-rs-parser`).

## [0.17.1] - 2026-06-14

### Fixed

- `numeric` and `resource` are accepted as class, interface and `extends` / `implements` names, as PHP allows (`php-rs-parser`).

## [0.17.0] - 2026-06-09

### Added

- `parse_arena_raw`, which parses without building a line/column `SourceMap`, for callers that only need spans (`php-rs-parser`).
- `SourceMap::empty()` (`php-rs-parser`).

### Changed

- Faster parsing: tokens are lexed on demand through a two-token lookahead window instead of into an array up front (Symfony −6.9%, Laravel −24.5%), the `(void)` cast check runs only when a void cast was parsed, and token and line-start buffers are pre-sized (`php-rs-parser`, `php-lexer`).

## [0.16.0] - 2026-06-02

### Added

- `Stmt::doc_comment`, a `/** */` block before a non-declaration statement such as `foreach`, `if` or an assignment (`php-ast`, `php-rs-parser`).
- `Stmt::leading_doc_comment()`, which returns a statement's preceding doc comment whether it is on the `Stmt` or on its declaration (`php-ast`).
- `Comment` implements `Clone` and `Copy` (`php-ast`).

### Fixed

- A statement inside a block no longer takes a doc comment written before the block's `{` (`php-rs-parser`).

## [0.15.0] - 2026-05-28

### Added

- **Breaking:** `Block` and `StmtKind::Block`; function, method, closure, `try` / `catch` / `finally`, braced namespace and property hook bodies hold a `Block` (`php-ast`).
- **Breaking:** `ClassBody`, `EnumBody` and `SwitchBody`, and brace and keyword offsets for the printer (`else_kw_start`, `finally_kw_start`, the `match` brace and the trait-use adaptations brace). Serialized output is unchanged (`php-ast`).
- `visit_block`, `fold_block`, `owned_block` and `av_block` (`php-ast`).

### Fixed

- The printer keeps a comment just before `{`, `else`, `finally` or the `while` of a `do`-`while` in place (`php-printer`).
- Multiline `@tag` bodies join continuation lines with a newline instead of a space, so a type and its description stay on separate lines (`phpdoc-parser`).

## [0.14.1] - 2026-05-23

### Fixed

- A single-part unaliased `use` inside a named namespace no longer reports "non-compound use has no effect" (`php-rs-parser`).

## [0.14.0] - 2026-05-21

### Added

- An owned parse API: `parse()` and `parse_versioned()` return a `ParseResult` with no lifetime parameters; the arena API is `parse_arena()` and `parse_arena_versioned()` (`php-rs-parser`).
- `php_ast::owned`, every AST type with `Box<str>` / `Box<[T]>` instead of arena references; its JSON is identical to the arena types' (`php-ast`).
- `OwnedVisitor`, `OwnedScopeVisitor`, `OwnedScopeWalker` and `walk_owned_*` (`php-ast`).
- `FoldOwned` and `fold_owned_*` (`php-ast`).
- `pretty_print_owned`, `pretty_print_owned_file` and related functions (`php-printer`).
- `ParserContext::reparse_owned` and `reparse_owned_versioned` (`php-rs-parser`).

## [0.13.0] - 2026-05-17

### Added

- `ParseError::ForbiddenWarning` and `ParseError::severity()`, for constructs PHP reports as warnings (`php-rs-parser`).

### Fixed

- Invalid code PHP rejects is reported (`php-rs-parser`):
  - types: incompatible `set` hook parameter types, standalone parenthesized intersection types, reserved type names such as `int` as class names, and standalone `null` / `false` before PHP 8.2;
  - expressions: a `(void)` cast used as a value, `new` in constant, property and static variable initializers, `$a{'b'}` offsets, `new Foo(...)` first-class callables, `Closure` in attribute arguments, and `isset()` on a non-variable;
  - destructuring and writes: mixing `list()` and `[]`, empty `list()` or `[, ,]`, non-writable targets, and temporaries in write context;
  - functions: a value returned from a `void` or `never` function, a default on a variadic parameter, and `static` on a parameter;
  - classes: hooks on static properties, an empty hook list, `get` with parameters, non-hooked properties in interfaces, asymmetric visibility without a type or with `set` wider than `get`, `final` on properties, `readonly` on methods, duplicate properties, methods and enum cases, a return type or `static` on `__construct`, `static` on `__destruct` and `__clone`, and promotion outside `__construct`;
  - statements: namespace layout rules and several `default` arms in a `switch`.
- Operator precedence matches PHP 8 in three more cases (`php-rs-parser`).
- Non-compound `use` names, duplicate imports across statements and `final private` methods are reported (`php-rs-parser`).
- The playground's project dropdown stays open while scrolling (`playground`).

## [0.12.2] - 2026-05-16

### Added

- The playground's project stats cover 50 open-source PHP projects, with per-project pages, a directory tree and a side-by-side AST node comparison (`playground`).

### Fixed

- `[index]` after `->prop` in string interpolation is no longer consumed (`php-rs-parser`).
- `private(set)` without a get visibility parses (`php-rs-parser`).

## [0.12.1] - 2026-05-15

### Added

- `Visitor::visit_comment` for doc comments on declarations (`php-ast`).

### Fixed

- Doc comments no longer leak across scopes (`php-rs-parser`).

## [0.12.0] - 2026-05-14

### Added

- `Fold`, for arena-to-arena AST transformations (`php-ast`).
- The printer keeps blank lines from the source between `switch` cases and enum members (`php-printer`).

### Fixed

- The printer no longer writes a spurious `<?php` after blank lines (`php-printer`).

## [0.11.1] - 2026-05-12

No user-facing changes.

## [0.11.0] - 2026-05-11

### Changed

- `pretty_print` writes `<?php` and a newline at the start of a program that starts with PHP code, so the output is valid PHP; `pretty_print_file` is `pretty_print` plus a trailing newline (`php-printer`).
- `phpdoc-parser` parses PHPDoc blocks structurally, without external dependencies (`phpdoc-parser`).

### Fixed

- The printer writes `?>` before inline HTML after `endforeach`, `endfor`, `endwhile`, `endif`, `endswitch` and `enddeclare` (`php-printer`).
- The printer no longer writes a trailing `<?php` after the last inline HTML, nor `?>` for an empty `<?php ?>` block (`php-printer`).
- Printing a printed program again gives the same output (`php-printer`).

## [0.10.1] - 2026-05-09

### Fixed

- Variables with multibyte characters in interpolated strings parse correctly (`php-rs-parser`).

## [0.10.0] - 2026-05-09

### Fixed

- Several modifiers on a promoted parameter in an anonymous class are rejected, and `readonly` property checks are stricter (`php-rs-parser`).
- A parenthesized arrow function after `|>`, as in `|> ($x) => $x`, is rejected (`php-rs-parser`).
- Invalid constructs are reported instead of being accepted and dropping AST nodes (`php-rs-parser`).
- The printer escapes control characters in heredoc and nowdoc bodies and braces in string interpolation (`php-printer`).
- The printer writes `&` before `...` on a variadic parameter (`php-printer`).
- The printer always writes parentheses after `new` (`php-printer`).

## [0.9.8] - 2026-05-07

### Added

- Parenthesized unions in types, as in `(A|B)` (`php-rs-parser`).

## [0.9.7] - 2026-05-06

### Added

- `Name::Error` for a name synthesized during error recovery (`php-ast`, `php-rs-parser`).

### Changed

- Error recovery uses anchors that depend on the syntactic context (`php-rs-parser`).
- An invalid name is `ExprKind::Error` instead of `Identifier("<error>")` (`php-rs-parser`).

### Fixed

- Declaration doc comments are kept (`php-rs-parser`).
- `final` on a private enum constant, and `static` and `abstract` on enum constants, are rejected (`php-rs-parser`).

## [0.9.6] - 2026-04-27

### Added

- The playground's AST tree has collapsible nodes (`playground`).

### Fixed

- The workspace dependency versions were still `0.9.4` in the 0.9.5 release.

## [0.9.5] - 2026-04-27

### Added

- `php-wasm`, WebAssembly bindings exposing `parse()`, `format()`, `parser_version()` and `build_commit()` (`php-wasm`).
- An interactive playground on GitHub Pages to parse and format PHP in the browser (`playground`).

## [0.9.4] - 2026-04-26

### Added

- `ClassConstDecl::is_final`, the `final` modifier on class and enum constants (PHP 8.1) (`php-ast`, `php-rs-parser`, `php-printer`).

### Fixed

- The printer wraps an intersection type inside a union in parentheses, as in `(A&B)|null` (`php-printer`).
- The printer writes the constructor arguments of `new class(args) extends Base {}` before `extends` instead of after the body (`php-printer`).
- The printer keeps the newlines of a multi-line heredoc instead of writing them as `\n` (`php-printer`).

## [0.9.3] - 2026-04-26

### Added

- `ConstItem::doc_comment`; in `const A = 1, B = 2;` it is on the first item (`php-ast`, `php-rs-parser`).

### Fixed

- The printer writes attributes and doc comments of a `const` statement before `const` (`php-printer`).

## [0.9.2] - 2026-04-25

### Fixed

- Leading-zero and negative-zero indices in simple string interpolation (`$arr[00]`, `$arr[07]`, `$arr[-0]`) are string keys instead of `Int(0)`, as in PHP (`php-rs-parser`).

## [0.9.1] - 2026-04-24

### Fixed

- Alternative syntax, attributes, `clone` and cast operands, dynamic member access, heredoc contexts and semi-reserved end keywords parse correctly in stress-test cases (`php-rs-parser`, `php-lexer`).

## [0.9.0] - 2026-04-20

### Fixed

- A backed enum case requires a value and a pure enum case rejects one (`php-rs-parser`).
- A `readonly` property or promoted parameter without a type is rejected (`php-rs-parser`).
- `break` and `continue` outside a loop or `switch` are rejected, and their level is checked against the loop depth (`php-rs-parser`).

## [0.8.1] - 2026-04-19

### Changed

- The public API of `php-ast` and `php-lexer` is fully documented (`php-ast`, `php-lexer`).

### Fixed

- A `readonly` property with a `set` hook is rejected (`php-rs-parser`).

## [0.8.0] - 2026-04-19

### Added

- `Visitor::visit_name` and `walk_name` (`php-ast`).
- `ParserContext` with `reparse()` and `reparse_versioned()`, which reuse one arena across parses (`php-rs-parser`).

### Changed

- **Breaking:** `StaticMethodCall` covers only `Foo::bar()`; `Class::$method()` is the new `StaticDynMethodCall` (`php-ast`).

### Fixed

- `Visitor` walks trait `use` adaptations (`php-ast`).
- A malformed trait alias no longer panics (`php-rs-parser`).
- An empty index in string interpolation, a malformed Unicode escape, an invalid assignment target such as `1 = $x`, a property hook with the wrong number of parameters, and invalid heredoc or nowdoc body indentation are reported (`php-rs-parser`).
- Chained non-associative operators are reported only at the same precedence (`php-rs-parser`).

## [0.7.0] - 2026-04-17

### Added

- Spans on static method, member and argument identifiers (`php-ast`).
- Duplicate named arguments and positional arguments after named ones are reported (`php-rs-parser`).
- `Name::src_repr(src)`, a slice of the source for any name (`php-ast`).

### Changed

- **Breaking:** `ScopeWalker::new` takes the source string (`php-ast`).
- **Breaking:** `Scope` derives `Copy`, and `Scope::namespace` is an `Option<&'src str>` instead of an `Option<Cow<'src, str>>` (`php-ast`).
- Namespace tracking in `ScopeWalker`, printer strings and heredoc labels in the lexer no longer allocate (`php-ast`, `php-printer`, `php-lexer`).

### Removed

- **Breaking:** `ParseError::Unexpected`, which was never produced (`php-rs-parser`).
- `ArenaVec::len` and `ArenaVec::last`; both still work through `Deref<Target = [T]>` (`php-ast`).

### Fixed

- Source files over 4 GB are guarded against `u32` span truncation in the lexer (`php-lexer`).
- Fewer panics on malformed input (`php-rs-parser`).

## [0.6.2] - 2026-04-12

### Fixed

- The `php-printer` package no longer includes its test fixtures (`php-printer`).

## [0.6.1] - 2026-04-12

No user-facing changes.

## [0.6.0] - 2026-04-12

### Added

- `ScopeVisitor` and `ScopeWalker`: every visit method receives a `&Scope` with the current namespace, class and function or method, maintained across all PHP scope transitions (`php-ast`).
- `NameStr`, which borrows a name from the source or holds one synthesized in the arena (`php-ast`).
- `PhpVersion::Php74`; the `(real)` and `(unset)` casts report a version error from PHP 8.0 (`php-rs-parser`).
- PHPDoc tag descriptions include indented continuation lines (`php-rs-parser`).

### Changed

- **Breaking:** `ExprKind::Variable` holds a `NameStr` instead of a `Cow<'src, str>`; use `name.as_str()` (`php-ast`).
- **Breaking:** `SourceMap` moved to `php-rs-parser` and is part of `ParseResult` (`php-ast`, `php-rs-parser`).

### Removed

- **Breaking:** `CommentMap` and `SymbolTable`; use `ScopeVisitor` / `ScopeWalker` to enumerate declarations by namespace (`php-ast`).

### Fixed

- A string slice at a non-char boundary no longer panics in the lexer (`php-lexer`).
- An unterminated string literal is reported (`php-rs-parser`).
- Missing version gates for deprecated casts and several PHP 8.x constructs (`php-rs-parser`).
- `void`, `never` and `mixed` in unions, `static readonly` and `abstract final class` are rejected (`php-rs-parser`).
- Chained non-associative operators and unparenthesized ternary chains are rejected for PHP 8 (`php-rs-parser`).
- The target version applies inside string interpolation (`php-rs-parser`).

## [0.5.0] - 2026-04-10

### Added

- `ParseResult::source_map`, a pre-built `SourceMap` (`php-rs-parser`).
- `ParseResult::source`, the original source string (`php-rs-parser`).

### Fixed

- An unterminated block comment is reported instead of truncating the token stream (`php-lexer`).

## [0.4.0] - 2026-04-09

### Added

- `php-printer`, with `pretty_print` and `pretty_print_file` to print an AST back to PHP source (`php-printer`).
- `php_rs_parser::phpdoc::parse()`, which parses doc comments into typed `PhpDocTag`s (param, return, var, throws, template, property, method, deprecated and Psalm/PHPStan annotations) (`php-rs-parser`).
- Doc comments on function, class, method, property and constant nodes (`php-ast`, `php-rs-parser`).
- `SourceMap`, `CommentMap` and `SymbolTable` (`php-ast`).

### Changed

- **Breaking:** `Visitor` methods return `ControlFlow<()>` for early termination, and the visitor covers type hints, attributes, catch clauses, match arms and closure `use` variables. All walk functions are public (`php-ast`).
- Version gates cover all version-specific syntax (`php-rs-parser`).

### Fixed

- A `readonly` anonymous class requires PHP 8.3, not 8.2 (`php-rs-parser`).

## [0.3.3] - 2026-04-04

### Fixed

- Deeply nested expressions report an error instead of overflowing the stack (`php-rs-parser`).
- Unparenthesized ternary chains are rejected for PHP 8 (`php-rs-parser`).
- Overflowing integer literals are floats (`php-rs-parser`).
- Multi-byte UTF-8 characters are kept in single-quoted strings with escape sequences (`php-rs-parser`).
- The precedence of `.`, `<<`, `>>` and `instanceof` matches PHP 8 (`php-rs-parser`).
- Legacy octal literals with digits 8 or 9 lex correctly, `1.` is a float, and `<?php` matches case-insensitively (`php-lexer`).
- `abstract` on properties and abstract methods in enums are rejected (`php-rs-parser`).
- Long float literals parse, and a `ClassConstAccessDynamic` callee has the right span (`php-rs-parser`).

## [0.3.2] - 2026-04-01

### Added

- `AssignExpr::by_ref` for `$a =& $b`, `ArrayElement::by_ref` for `[&$a]` and `list(&$a)`, each serialized only when `true` (`php-ast`, `php-rs-parser`).
- `ExprKind::Omit` for a skipped slot in destructuring (`php-ast`).

### Changed

- **Breaking:** an empty destructuring slot, as in `[$a, , $c]`, is `ExprKind::Omit` instead of `ExprKind::Null` (`php-ast`, `php-rs-parser`).

### Fixed

- A double-quoted string with a single non-literal part no longer drops the expression (`php-rs-parser`).
- Unicode escapes, the `yield from` flag, negative string indices, `\${...}` in interpolation, `readonly final class` in either order and flexible heredoc closing markers parse correctly, and `true|false` is rejected (`php-rs-parser`).

## [0.3.1] - 2026-03-30

### Fixed

- `Param::is_final`, `Param::is_readonly` and `Arg::by_ref` are kept in the AST (`php-rs-parser`).

## [0.3.0] - 2026-03-30

### Added

- `PhpVersion` (`Php80` to `Php85`) and `parse_versioned()`: syntax that needs a higher version is parsed and reported as `VersionTooLow` (`php-rs-parser`).
- PHP 8.5 `clone` with arguments and the `CloneWith` node (`php-ast`, `php-rs-parser`).

## [0.2.1] - 2026-03-18

No user-facing changes.

## [0.2.0] - 2026-03-17

### Changed

- Faster parsing: tokens are lexed into an array up front, the Pratt loop dispatches on a jump table, simple `$var` parameters take a fast path, and `ArenaVec` pre-allocation is right-sized (5–10% less memory) (`php-rs-parser`, `php-lexer`).

## 0.1.0 - 2026-03-14

Initial release: a recursive descent PHP parser for PHP 8.3 syntax with arena allocation, zero-copy string borrowing, error recovery and nikic/PHP-Parser corpus compatibility.

[Unreleased]: https://github.com/jorgsowa/rust-php-parser/compare/v0.26.0...HEAD
[0.26.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.25.1...v0.26.0
[0.25.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.25.0...v0.25.1
[0.25.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.24.1...v0.25.0
[0.24.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.24.0...v0.24.1
[0.24.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.23.0...v0.24.0
[0.23.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.22.0...v0.23.0
[0.22.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.21.0...v0.22.0
[0.21.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.20.0...v0.21.0
[0.20.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.19.2...v0.20.0
[0.19.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.19.1...v0.19.2
[0.19.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.19.0...v0.19.1
[0.19.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.18.3...v0.19.0
[0.18.3]: https://github.com/jorgsowa/rust-php-parser/compare/v0.18.2...v0.18.3
[0.18.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.18.1...v0.18.2
[0.18.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.18.0...v0.18.1
[0.18.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.17.1...v0.18.0
[0.17.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.17.0...v0.17.1
[0.17.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.16.0...v0.17.0
[0.16.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.15.0...v0.16.0
[0.15.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.14.1...v0.15.0
[0.14.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.14.0...v0.14.1
[0.14.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.13.0...v0.14.0
[0.13.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.12.2...v0.13.0
[0.12.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.12.1...v0.12.2
[0.12.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.12.0...v0.12.1
[0.12.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.11.1...v0.12.0
[0.11.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.11.0...v0.11.1
[0.11.0]: https://github.com/jorgsowa/rust-php-parser/compare/15b12991...v0.11.0
[0.10.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.10.0...15b12991
[0.10.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.8...v0.10.0
[0.9.8]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.7...v0.9.8
[0.9.7]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.6...v0.9.7
[0.9.6]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.5...v0.9.6
[0.9.5]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.4...v0.9.5
[0.9.4]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.3...v0.9.4
[0.9.3]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.2...v0.9.3
[0.9.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.1...v0.9.2
[0.9.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.9.0...v0.9.1
[0.9.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.8.1...v0.9.0
[0.8.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.8.0...v0.8.1
[0.8.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.7.0...v0.8.0
[0.7.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.6.2...v0.7.0
[0.6.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.6.1...v0.6.2
[0.6.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.6.0...v0.6.1
[0.6.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.5.0...v0.6.0
[0.5.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.4.0...v0.5.0
[0.4.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.3.3...v0.4.0
[0.3.3]: https://github.com/jorgsowa/rust-php-parser/compare/v0.3.2...v0.3.3
[0.3.2]: https://github.com/jorgsowa/rust-php-parser/compare/v0.3.1...v0.3.2
[0.3.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.3.0...v0.3.1
[0.3.0]: https://github.com/jorgsowa/rust-php-parser/compare/v0.2.1...v0.3.0
[0.2.1]: https://github.com/jorgsowa/rust-php-parser/compare/v0.2.0...v0.2.1
[0.2.0]: https://github.com/jorgsowa/rust-php-parser/releases/tag/v0.2.0
