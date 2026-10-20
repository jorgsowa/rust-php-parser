# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- `walk_trait_adaptation` and `walk_owned_trait_adaptation` (`php-ast`).
- `php_ast::owned` re-exports `walk_owned_block` and `fold_owned_block` like the other walk and fold functions (`php-ast`).
- `Fold::fold_stmts` hook, called for the program, every block and every `case` body, so a fold can delete, split or insert statements; the free `fold_stmts` is public (`php-ast`).
- `php_ast::Modifiers` (`visibility`, `set_visibility`, `is_static`, `is_abstract`, `is_final`, `is_readonly`; `Modifiers::new()` and `is_empty()`), shared by methods, properties, parameters, class constants and property hooks (`php-ast`).
- `new` constructors for the structs below; each takes the fields that identify the node (and the arena when it has vector fields) and leaves the rest empty (`php-ast`).
- Owned `Name::span()`, `kind()`, `to_string_repr()` and `join_parts()`, `Expr::name_str()` and `Expr::into_kind()`, like their arena counterparts. `Expr` implements `Drop` (so long chains are freed iteratively), which is now documented; take the kind out with `into_kind()` instead of destructuring (`php-ast`).
- `OwnedFold::fold_stmts` hook, called for the program, every block and every `case` body, so a fold can delete, split or insert statements; the free `fold_owned_stmts` is public (`php-ast`).
- `php_ast::ByteStr` (arena) and `php_ast::owned::ByteString`, the value of a PHP string literal as bytes: `as_bytes()`, `to_str()` (`None` unless valid UTF-8) and `to_string_lossy()`. With `serde`, valid UTF-8 serializes as a JSON string and anything else as `{"bytes": [..]}`. `fold::fold_byte_str` moves one into a fold's output arena (`php-ast`).

### Changed

- `PhpVersion::default()` is `Php86`, and the WASM `parse` falls back to 8.6 (`php-rs-parser`, `php-wasm`).
- The printer puts trait `use` first in class, trait and enum bodies and sorts each run of top-level `use` imports (kind, then name ignoring case; a blank line in the source starts a new run). Anonymous classes open their brace on the same line (`php-printer`).
- The printer puts a blank line before a class member that starts with a comment, keeps a same-line comment after a member on that line, and indents a comment in an empty block (`php-printer`).
- **Breaking:** removed `BuiltinType::Integer`, `BuiltinType::Double` and `BuiltinType::Boolean`. In type position PHP treats `integer`, `double` and `boolean` as class names, so they now parse as `TypeHintKind::Named` (`php-ast`, `php-rs-parser`).
- **Breaking:** `PropertyDecl` has new `is_final` and `is_abstract` fields; the PHP 8.4 `final` and `abstract` property modifiers were parsed and then dropped, so the printer lost them too. Both are serialized only when `true` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** function, class and constant references in expressions (call and `new` targets, the class in `Foo::bar()`, `Foo::C` and `instanceof`, constants) are `ExprKind::Name(Name)` instead of `ExprKind::Identifier`, so `visit_name`, `fold_name` and `NameResolver` see them with their qualification. `Identifier` is kept for member names after `->`, `?->` and `::` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `Ident` (arena and owned) carries the `span` of its token; for variable names it includes the `$`. `Ident::name(s)` and `Ident::ERROR` are replaced by `Ident::new(s, span)` and `Ident::error(span)`. `CatchClause::var`, `UseItem::alias` and `ClosureUseVar::name` are `Ident` instead of strings. A real identifier serializes as `{"name": ..., "span": ...}` instead of a string; the error state is still `null` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `TraitAdaptationKind::Alias` (arena and owned) has a new `is_final` field for the PHP 8.3 `foo as final bar;` alias, which was rejected; it is serialized only when `true` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** removed `TokenKind::From`. `from` is lexed as an identifier; the parser recognizes it only after `yield` (`php-lexer`).
- **Breaking:** `ForeachStmt` (arena and owned) has a new `by_ref` field for `foreach ($a as &$v)`; the `&` was parsed and dropped, so the printer wrote a by-value loop. It is serialized only when `true` (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** removed `ParseError::ForbiddenWarning`, `Severity` and `ParseError::severity()`. Every diagnostic is an error, matching what `php -l` rejects; the parser no longer reports PHP warnings: a `use` with a non-compound name, a `final private` method, a non-public magic method and an unsupported `declare` directive (`php-rs-parser`).
- **Breaking:** the hidden `NameStr::__src` / `__arena` constructors are now the documented `NameStr::from_source` / `from_arena`, and `__into_src_str` / `__into_arena_str` are no longer public (`php-ast`).
- **Breaking:** the printer-only spans (`else_kw_span`, `finally_kw_span`, `brace_span`, `adaptations_brace_span`) are `#[doc(hidden)]` and outside semver; `Lexer::is_verbatim_string` is `#[doc(hidden)]` and the `Lexer::errors` field is the `errors()` accessor; `ArenaVec::into_iter` returns `php_ast::ast::IntoIter` instead of the bumpalo iterator; the `instrument` module is documented as outside semver (`php-ast`, `php-lexer`, `php-rs-parser`).
- **Breaking:** removed the `php_rs_parser::phpdoc` re-export. Depend on `phpdoc-parser` directly; the `serde` feature of `php-rs-parser` no longer enables `phpdoc-parser/serde` (`php-rs-parser`).
- **Breaking:** `Fold::fold_closure_use_var` takes the arena like every other fold method (`php-ast`).
- **Breaking:** `FoldOwned` is renamed `OwnedFold`, matching `OwnedVisitor` (`php-ast`).
- **Breaking:** `Arg` (arena and owned) has a `kind: ArgKind` (`Value`, `Spread`, `ByRef`, `Placeholder`, `SpreadPlaceholder`) instead of `value: Option<Expr>` + `unpack` + `by_ref`, and `ArrayElement` has a `kind: ArrayElementKind` (`Value`, `Spread`, `ByRef`) instead of `value` + `unpack` + `by_ref`, so impossible combinations cannot be built. `Arg::value()` / `value_mut()` / `is_spread()` / `is_placeholder()` and `ArrayElement::value()` / `value_mut()` / `is_spread()` / `is_by_ref()` read them; the JSON shape changes accordingly (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** `MethodDecl`, `PropertyDecl`, `Param`, `ClassConstDecl` and `PropertyHook` (arena and owned) carry a `modifiers: Modifiers` instead of separate `visibility`, `set_visibility`, `is_static`, `is_abstract`, `is_final` and `is_readonly` fields (`MethodDecl.visibility` becomes `MethodDecl.modifiers.visibility`). It is serialized as `"modifiers"`, with only the set flags, and left out when empty (`php-ast`, `php-rs-parser`, `php-printer`).
- **Breaking:** the structs that are most likely to grow fields are `#[non_exhaustive]`, so they cannot be built with a struct literal or `..base` update outside their crate: `ClassDecl`, `InterfaceDecl`, `TraitDecl`, `EnumDecl`, `EnumCase`, `FunctionDecl`, `PropertyDecl`, `PropertyHook`, `ClassConstDecl`, `TraitUseDecl`, `ClosureExpr`, `ArrowFunctionExpr`, `MatchExpr`, `Arg`, `Attribute`, `IfStmt`, `WhileStmt`, `DoWhileStmt`, `ForStmt`, `ForeachStmt`, `SwitchStmt`, `TryCatchStmt`, `CatchClause`, `DeclareStmt`, `NamespaceDecl` and `UseDecl` (arena and owned). Use `Type::new(..)` and assign the remaining public fields; `Type { field, ..other }` becomes `let mut value = other; value.field = field;` (`php-ast`).
- **Breaking:** the struct variants of `ParseError`, `LexerError` and the `phpdoc-parser` structs `InlineTag`, `PhpDocText`, `PhpDocTag` and `PhpDoc` are `#[non_exhaustive]`; match `ParseError` fields with `..` (`php-rs-parser`, `php-lexer`, `phpdoc-parser`).
- **Breaking:** `Visitor`, `ScopeVisitor`, `OwnedVisitor` and `OwnedScopeVisitor` have an associated `type Break`, and every `visit_*` and `walk_*` returns `ControlFlow<Self::Break>` / `ControlFlow<V::Break>`, so a visitor can hand a result out of the walk with `ControlFlow::Break(value)`. Existing visitors add `type Break = ();` (`php-ast`).
- **Breaking:** `OwnedFold` takes every node by value (`fn fold_expr(&mut self, expr: Expr) -> Expr`) and the free `fold_owned_*` functions move the children they keep instead of cloning them. `OwnedFold::fold_program(&program)` becomes `fold_program(program)` (`php-ast`).
- **Breaking:** `ExprKind::String` and `StringPart::Literal` (arena and owned) hold a `ByteStr` / `ByteString` instead of a `str`, because a PHP string is bytes and `"\xff"` or `"\u{D800}"` are not valid UTF-8. Use `as_bytes()`, or `to_str()` / `to_string_lossy()` when you need text. Nowdoc values are unchanged (`php-ast`, `php-rs-parser`, `php-printer`).

### Fixed

- A trailing `\` in a name (`namespace Foo\;`, `use X\;`, `foo\()`, `new Bar\`, `instanceof Bar\`, types, attributes) was silently dropped; it is only valid before a group `use` list (`php-rs-parser`).
- `return;` in a function, method or closure with a non-`void` return type, and a generator whose return type does not admit `Generator` (`function g(): int { yield 1; }`, also arrow functions), were accepted; PHP rejects both at compile time (`php-rs-parser`).
- `use A as enum` was rejected, and a special class name as a class import alias (`use A as int`, `as mixed`, `as self`) was accepted; PHP reports "Cannot use A as int because 'int' is a special class name" (`php-rs-parser`).
- `self:`, `parent:`, `enum:`, `null:`, `true:` and `false:` were rejected as goto labels, and `goto` to them; PHP lexes these words as plain names there (`php-rs-parser`).
- A parenthesized type group other than an intersection (`(A)|B`, `(A|B)|C`, `(A&B|C)`) was accepted; PHP allows only `(A&B)` and the parser reports the missing `&` (`php-rs-parser`).
- `A&B &$x` (an intersection type before a by-reference parameter) was rejected (`php-rs-parser`).
- A whitespace-only heredoc or nowdoc line shorter than the closing indentation was rejected; PHP accepts it. A body line indented with the other whitespace character reports "Invalid indentation - tabs and spaces cannot be mixed", and the stripped indentation follows PHP (`php-rs-parser`).
- `1...2` was rejected and `1..2` accepted; a number followed by `.` lexes as a float (`1.`) even before another dot, as in PHP (`php-lexer`).
- `case 1 ?>` and `default ?>` were rejected; as in PHP, `?>` ends the case label like `;` (`php-rs-parser`).
- A long run of prefix operators (`~~~…$x`, as in php-src's `stack_limit_013`) hit "maximum nesting depth exceeded"; such runs are parsed, converted to and from the owned AST, dropped and printed without recursion, like other operator chains (`php-rs-parser`, `php-ast`, `php-printer`).
- Errors PHP raises only while compiling (such as "Cannot use lexical variable $c as a parameter name") were reported in the right operand of `&&`, `||`, `and` or `or` after a constant that decides the result (`assert(false && …)`); PHP never compiles that operand, so only syntax errors are reported there (`php-rs-parser`).
- `<?php` directly followed by a character other than whitespace (``<?php`ls`;``) opened PHP code; PHP reads it as inline HTML (`php-lexer`).
- Version-specific checks follow PHP: `self` and `parent` in an intersection type are reported before 8.5, `fn(): never => …` is reported on 8.1, `namespace\static` as a type is reported from 8.6, and an untyped readonly promoted parameter (before 8.1) or attributes on several constants (before 8.0) report only the version gate (`php-rs-parser`).
- `"$a[k"` (and the heredoc and backtick forms) silently dropped the unclosed subscript; the parser now reports "unclosed '[' in string interpolation" and keeps the text (`php-rs-parser`).
- `return` with a value in a `void` closure, a `return` in a `never` closure and any `fn(): void => expr` were accepted; PHP rejects them like it does for functions and methods (`php-rs-parser`).
- `final private $x` (also static, readonly, hooked, in traits and anonymous classes) was accepted; PHP rejects it with "Property cannot be both final and private" (`php-rs-parser`).
- Dereferencing a heredoc or nowdoc (`<<<X ... X->b`, `X[0]`, `X::C`, `X()`) was accepted; PHP rejects it, and the parser now reports "Cannot dereference this expression" (`php-rs-parser`).
- Writes through `(clone $a)` and `f(...)` (`(clone $a)->b = 1`, `(clone $a)[0]++`, `unset((clone $a)->b)`, `&(clone $a)[0]`) were accepted; PHP rejects them with "Cannot use result of built-in function in write context" (`php-rs-parser`).
- A name with a `__halt_compiler` segment (`\__halt_compiler()`, `Foo\__halt_compiler`, `namespace\__halt_compiler`, in `use`, `namespace`, types and `new`) was read as the `__halt_compiler();` statement and swallowed the rest of the file (`php-rs-parser`).
- `$this?->foo(...)` was rejected with "Cannot combine nullsafe operator with Closure creation"; PHP accepts it, as it compiles `$this?->` as `$this->` (`php-rs-parser`).
- "Cannot specify default value for virtual hooked property" was reported for classes with a parent; PHP checks it at inheritance there, so only classes without `extends` get the error (`php-rs-parser`).
- `#[\DelayedTargetValidation]` still reported `#[\Attribute]`, `#[\AllowDynamicProperties]` and `#[\Deprecated]` class-kind errors and `#[\NoDiscard]` on property hooks; it now suppresses them (`php-rs-parser`).
- `?>` ending a class member (constant, property, trait `use` and its adaptations, abstract or interface method, enum case, property hook) was rejected; it ends the member like `;`, and the `<?php` that reopens the body goes with it (`php-rs-parser`).
- `?>` right after a bare `break`, `continue`, `return` or `yield` was rejected with "expected expression"; it ends the statement like `;` (`php-rs-parser`).
- Class names in a namespace named like a builtin type (`int\X`, `string\Y`, `self\Z`) were rejected in type positions (`php-rs-parser`).
- `abstract readonly class` (and `readonly abstract class`) was rejected below PHP 8.4; it is valid since PHP 8.2 (`php-rs-parser`).
- `(void) f() + 1` was parsed as `((void) f()) + 1`; `(void)` is a statement prefix in PHP, so its operand is the whole expression, `(void) (f() + 1)` (`php-rs-parser`).
- `include $a or $b` and `$x = throw $e or 1` were parsed as `(include $a) or $b` and `throw $e` followed by `or 1`; `include`, `require` and `throw` bind looser than the word operators, so the operand takes them (`php-rs-parser`).
- `yield $a or $b` (also `and`, `xor`, `yield from` and `yield $k => $v`) was parsed as `yield ($a or $b)`; PHP binds `yield` tighter than the word operators, so it is `(yield $a) or $b` (`php-rs-parser`).
- `clone($a)->b = 1` was parsed as `(clone $a)->b = 1`; PHP reads the parentheses as grouping, so it is `clone (($a)->b = 1)`, and the printer wrote code PHP rejects. The same goes for `->`, `?->`, `::`, `[` and `(` after `clone(...)` (`php-rs-parser`).
- Report methods without a body outside interfaces and abstract declarations, abstract methods in anonymous classes, and variadic promoted constructor parameters, like PHP (`php-rs-parser`).
- `new namespace\Foo` dropped the `namespace\` prefix of the class name (`php-rs-parser`).
- `declare(...) ?>` took the inline HTML after `?>` as its body instead of ending at `?>` like at `;`, so the printer wrote `declare(strict_types=1) { ?>...`, which PHP rejects (`php-rs-parser`).
- A float literal longer than 256 bytes was cut off before parsing, so `0.000…5` with hundreds of digits read as `0.0` (`php-rs-parser`).
- `clone $a ** 2` parsed as `clone ($a ** 2)`; `clone` binds tighter than `**`, so it is now `(clone $a) ** 2` (`php-rs-parser`).
- `"$a?->b"` (and the same in heredocs and backticks) parsed as `$a` followed by the text `?->b`; from PHP 8.0 it is a nullsafe property fetch (`php-rs-parser`).
- `++` and `--` on something that is not a variable (`--1`, `---$a`, `++f()`), a nullsafe fetch or a temporary are reported, as are writes to an offset of a string literal such as `"a"[0] = 1` (`php-rs-parser`).
- Writes PHP rejects are reported: through a nullsafe chain (`$a?->b = 1`, `$x = &$a?->b`, `unset($a?->b)`), to a parenthesized variable (`($a) = 1`, `&($a)`), with a spread in a destructuring list, to an unwritable `unset` argument, `foreach` target or by-reference array element (`unset(f())`, `foreach ($a as f())`, `[&f()]`), and to an unwritable element of a nested or `foreach` destructuring list (`php-rs-parser`).
- A method closure created on a nullsafe chain, such as `$a?->b(...)` or `$a?->b()->c(...)`, is reported. Nullsafe chains are followed through static property fetches and static calls, so `$a?->b::$c = 1` is reported too (`php-rs-parser`).
- Dereferencing an expression PHP cannot dereference is reported: a fetch, index, call or `::` on `match`, a closure, a number, a backtick string, `isset`, `empty`, `exit`, `eval` or `list()`, and `::` on an array literal (`php-rs-parser`).
- A `switch` may open with `?>` and `<?php` before its first `case`, as in templates, which was rejected; more than one `;` there is now reported, as PHP does (`php-rs-parser`).
- `Visitor`, `OwnedVisitor` and both scope walkers call `visit_name` for the namespace name, named-argument names and the names in trait `insteadof`/`as` adaptations, matching `Fold`. The default `visit_trait_adaptation` now walks into the adaptation (`php-ast`).
- `ScopeWalker` and `OwnedScopeWalker` start every walk from the global scope; a reused walker kept the namespace of the previous program, and the class and function names after a `Break` (`php-ast`).
- `NameResolver` resolves unqualified `true`, `false` and `null` constants to the global name inside a namespace instead of `ResolvedName::Fallback` (`php-ast`).
- The printer dropped the per-item `function` and `const` keywords of a mixed group use such as `use A\{B, function c, const D};`; it now starts a new `use` statement whenever the kind changes (`php-printer`).
- In a grouped property declaration such as `#[A] public int $a, $b;`, every property now carries the declared visibility, set visibility, type and attributes; only the first one did (`php-rs-parser`).
- The printer wrote `- -$a` as `--$a` and `+ ++$a` as `+++$a`, a decrement and a syntax error; a space now separates adjacent signs (`php-printer`).
- The printer dropped the braces of `"{$a}b"`, `"{$a}[0]"` and `"{$a}->b"`, turning them into `$ab`, an index or a property fetch, and in heredocs and backticks turned a literal `{` before a variable into `{$...}` syntax (`php-printer`).
- The printer dropped the attributes of an anonymous class such as `new #[A] class {}` (`php-printer`).
- The printer dropped the hooks of a promoted constructor property; parameter lists with hooks are now printed one parameter per line (`php-printer`).
- A comment right after `<?php` that follows inline HTML was printed before the `<?php`, so it became page output; a file holding only comments lost its `<?php` tag the same way (`php-printer`).
- Inline HTML on both sides of an empty `<?php ?>` was printed as one run, so the newline that `?>` consumed reappeared in the output (`php-printer`).
- Block and doc comments inside an expression, such as `foo(/** @var T */ $x)`, are printed where they are instead of before the next statement, where a doc comment attached to that statement or declaration. A doc comment printed on its own line no longer doubles the indentation of the line after it (`php-printer`).
- The printer re-indented doc comments with each continuation `*` under the `/` instead of one column right of it (`php-printer`).
- Floats below `1e-4` or from `1e15` up are printed in exponent notation; `1e100` and `5e-324` were spelled out to hundreds of digits (`php-printer`).
- The printer's precedence table placed `and`, `or` and `xor` above assignment, `|>` below `??`, casts above `**` and `!` above `instanceof`, so a tree without `Parenthesized` nodes could print with a different meaning. It now also parenthesizes a property fetch used as a callee (`($a->b)()`), a non-dereferencable operand of `->`, `::`, `[]` or a call, an arrow function followed by more of the expression or on the right of `|>`, a `new` class that is not a variable or name, and a `yield` used as an array or `yield` key. Parsed code that relied on the old table loses redundant parentheses, such as `$a = $b or $c` (`php-printer`).
- Comments after the last statement start on their own line instead of being appended to it, as in `}// comment` (`php-printer`).
- A `switch` case whose body ends in inline HTML printed the next `case` or `default` as HTML (`php-printer`).
- The printer wrote a dynamic method name in a first-class callable without braces, so `$a->{$n . 'b'}(...)` became `$a->($n . 'b')(...)`, a syntax error. Static method calls with an expression as the name are braced too (`php-printer`).
- Line comments inside an array or argument list that were not between two items, such as in an empty `[]` or `f()`, before the first item or after the last, were moved after the statement, and an array with a comment before its first element was printed on one line; printing such output again changed it. The list is now printed one item per line with the comments in place. Block comments between items stay inline (`php-printer`).
- A comment at the end of a line, after a statement or after an item of a multi-line array or argument list, was moved onto its own line before the next one; it now stays on that line (`php-printer`).
- Line comments between the links of a method chain were moved after the statement, or into the body of a closure passed further along the chain. The chain now breaks onto indented continuation lines at those comments (`php-printer`).
- A doc comment followed by other comments before its statement or class member, as in `$a = 1; /** @var T */ // note` followed by `$b = f();`, was printed after those comments, and the blank lines before it were counted from the statement, so printing the output again added a blank line (`php-printer`).
- Postfix `++` and `--` bound looser than the prefix operators, so `@$i++`, `(string) $i++`, `-$i++` and `clone $o++` parsed as an increment of `@$i`, `(string) $i`, … and were reported; they now apply to the variable as in PHP (`php-rs-parser`).
- `from` was a keyword, so a function, class or constant named `from` could be declared but not used: `from()`, `From::class`, `new From` and `From` as a type were rejected (`php-lexer`, `php-rs-parser`).
- `${expr}` in a string took only a bare name: `"${'a'}"` and `"${"a$b"}"` were reported as an empty variable name, a `"` inside ended the string, and in an indented heredoc `${...}` was kept as text. Any expression is now a variable variable, and the index in `${a[expr]}` is a full expression, so `${a['k']}` indexes `k` instead of `'k'` (`php-lexer`, `php-rs-parser`).
- `"\u{D800}"` through `"\u{DFFF}"` were reported as too large; PHP accepts surrogate code points and encodes them as three UTF-8 bytes, which are now stored one char per byte like `\x` escapes (`php-rs-parser`).
- `$obj->__halt_compiler` was rejected; after `->` and `?->` PHP accepts any name (`php-rs-parser`).
- A trait adaptation for a method named `namespace`, such as `namespace as bar;`, was read as the start of a `namespace\Foo` name and rejected (`php-rs-parser`).
- `yield` in a property hook body was reported as outside a function; hooks can be generators. A `break` or `continue` in a hook no longer sees loops around the class (`php-rs-parser`).
- Attributes on a grouped class constant such as `#[A] const X = 1, Y = 2;` were reported; PHP rejects them only on global constants. Every constant of the group now carries the attributes (`php-rs-parser`).
- An enum rejected a grouped constant declaration such as `const X = 1, Y = 2;` (`php-rs-parser`).
- Trailing commas PHP rejects are reported: in `use`, `const`, `echo`, `<?=`, `global` and `static` lists, `for` expression lists, `declare(...)`, `extends` and `implements` lists, trait `use` and `insteadof` lists, and grouped class constants and properties. Argument, parameter, array, closure `use`, `match`, `unset`, `isset` and group `use` lists keep accepting them (`php-rs-parser`).
- A constructor parameter with hooks but no visibility, such as `__construct($a { set => $value * 2; })`, was rejected; hooks promote it like a modifier does, and outside a constructor this is reported (`php-rs-parser`).
- `?>` ends a `goto`, `unset`, `global`, `static`, `use`, `const` or `namespace Foo` statement like `;` does; these required a `;` before it (`php-rs-parser`).
- A heredoc ended at a line inside a multi-line `{$...}` or `${...}` interpolation that looked like its closing label (`php-lexer`, `php-rs-parser`).
- `const`, `use` and `namespace` declarations inside a function, block or control structure are reported; PHP allows them only at the outermost scope. `__halt_compiler()` in a function body was not reported (`php-rs-parser`).
- `static` in a parameter or property type, such as `?static $a`, is reported; PHP allows it only in return and class constant types (`php-rs-parser`).
- Writes through a property or index fetch on something other than a variable or call are reported as temporary, as in `FOO->a = 1`, `C::X[0] = 1`, `(new A)->b = 1` and `unset(FOO->a)`; only array and string literals were (`php-rs-parser`).
- References to values PHP cannot reference are reported: `$a = &C::X`, `$a = &"s"`, `$a = &FOO->b`, and a destructuring list with a `&` element assigned from something other than a variable or call, as in `[&$a] = [1]`, or from a nullsafe chain (`php-rs-parser`).
- A `return` or `yield` of a nullsafe fetch such as `$a?->b` in a function, method, closure, arrow function or hook that returns by reference is reported (`php-rs-parser`).
- Syntax errors inside `{$...}` and `${...}` string interpolation were dropped, so `"{$a $b}"`, `"{$a->}"` and `"{$g{0}}"` parsed without errors. They are reported now, as is a `{$...}` holding something other than a variable, property, index or call, such as `"{$a + 1}"` (`php-rs-parser`).
- `$a = &$b + $c` parsed as `$a = &($b + $c)`; the right side of `= &` is a single variable, so it is `($a = &$b) + $c` as in PHP (`php-rs-parser`).
- Octal escapes above `\377`, such as `"\400"`, were dropped from the string; PHP keeps the low byte, so `"\400"` is `"\0"` (`php-rs-parser`).
- `private(set)` and the other set-visibility modifiers are matched like PHP's single case-insensitive token: `private(SET)` was rejected and `private (set)` was accepted (`php-rs-parser`).
- A `(void)` cast is reported wherever its value is used, such as in an `if`, `echo`, `return` or `for` condition; only expression statements were checked. A `(void)` statement inside a closure assigned to a variable is no longer reported (`php-rs-parser`).
- A `$` followed by something other than a variable, `$` or `{`, as in `$"abc"`, `$1` or `$a->$"b"`, is reported (`php-rs-parser`).
- A keyword directly followed by `\` and a name, such as `class\Foo` or `implements\A`, is lexed as the first part of a qualified name like PHP 8 does, so `class\Foo::x()` parses and `class B implements\A {}` is reported (`php-lexer`).
- `include \dirname(__DIR__)`, `print \f()` and `require_once \A::B` parsed as a call or fetch of a name starting with the keyword, such as `include\dirname`; a keyword followed by a space and a fully qualified name is now the keyword applied to that name (`php-rs-parser`).
- Whitespace inside a namespaced name, as in `Foo \ Bar` or `\ Foo()`, is reported; PHP 8 reads a name as a single token. A group `use Foo \ {A}` keeps accepting it (`php-rs-parser`).
- An offset in simple string interpolation that is not a name, number or variable, such as `"$a['k']"` or `"$a[ 0 ]"`, is reported (`php-rs-parser`).
- A `function` or `const` item inside a `use function` or `use const` group, such as `use const A\{B, const C}`, is reported; per-item kinds are only allowed in an untyped group (`php-rs-parser`).
- `list(...)` used as a value, as in `f(list($a))` or `$x = list($a);`, is reported; it is only valid as an assignment or `foreach` target (`php-rs-parser`).
- A namespace declared with a namespace-relative name, such as `namespace namespace\Foo;`, is reported (`php-rs-parser`).
- A heredoc or nowdoc whose closing marker is indented with both tabs and spaces is reported (`php-rs-parser`).
- `A::{$m}()` parsed as a call of the value of the dynamic class constant `A::{$m}`; it is a static method call whose name is `$m`, now `ExprKind::StaticMethodCallDynamic`. It no longer requires PHP 8.3, which applies only to the constant fetch (`php-rs-parser`).
- A `foreach` key taken by reference, as in `foreach ($a as &$k => $v)`, is reported (`php-rs-parser`).
- `$a[]` is reported wherever it is read or unset, such as `$x = $a[]`, `isset($a[])`, `foreach ($a[] as $v)`, `$x ??= $a[]` and `unset($a[])`; only an `$a[];` statement was. Writes, `foreach` and destructuring targets, by-reference sources, call arguments and the `return` or `yield` of a function that returns by reference keep accepting it (`php-rs-parser`).
- Duplicate types compare class names case-insensitively and are reported in intersections and between DNF members too, as in `Foo|FOO`, `A&A` and `(A&B)|(B&A)`; `true` or `false` next to `bool` and `array` or `Traversable` next to `iterable` are duplicates as well (`php-rs-parser`).
- A builtin type written with a namespace is reported: `\int` and `namespace\int` must be unqualified, and `Foo\int`, `\array` and `\callable` use a reserved name (`php-rs-parser`).
- A class, interface, trait or enum constant declared twice is reported, as is an enum constant named like a case. Enum cases differing only in case, such as `case A; case a;`, were reported as redefined; constant names are case-sensitive (`php-rs-parser`).
- A promoted constructor parameter with asymmetric visibility is checked like the same property declaration: a set visibility wider than its visibility, as in `private protected(set) string $a`, and a missing type are reported (`php-rs-parser`).
- Enum methods are parsed like class methods. `yield` in an enum method was reported as outside a function, and a `void` return with a value, a by-reference return of a nullsafe chain and `readonly` on the method went unreported (`php-rs-parser`).
- Every magic method PHP requires to be an instance method, such as `__get`, `__call`, `__toString` or `__invoke`, is reported when `static`, and `__callStatic` and `__set_state` are reported when not `static`; only `__construct`, `__destruct` and `__clone` were checked (`php-rs-parser`).
- An untyped property or promoted constructor parameter in a `readonly` class, named or anonymous, is reported; every property of such a class is readonly and must have a type (`php-rs-parser`).
- A readonly property with a default value, including later items of a grouped declaration, is reported, as are a readonly promoted constructor parameter with hooks and an untyped `readonly` promoted parameter without a visibility. In a `readonly` class, static and hooked properties and property defaults are reported too, and an explicitly readonly untyped property is reported once (`php-rs-parser`).
- Writes PHP rejects to `$this` and `$GLOBALS` are reported: assigning, destructuring into, iterating into, catching into or unsetting `$this`, and `$this` as a parameter or a `global`, `static` or closure `use` variable; any write to or reference of `$GLOBALS` itself, any use of `$GLOBALS[]` ("Cannot append to $GLOBALS"; it was reported as a read or, as a call argument, not at all), and an auto-global such as `$_GET` as a parameter or closure `use` variable (`php-rs-parser`).
- A parameter declared twice in one function, method, closure or arrow function is reported ("Redefinition of parameter $a"), as are a closure `use` variable listed twice or named like a parameter, and a `static` variable declared twice in one function body or in top-level code (`php-rs-parser`).
- A destructuring list mixing keyed and unkeyed entries, such as `[$a, 'k' => $b] = $x`, or with an empty entry in a keyed list, such as `['k' => $a, , 'j' => $b] = $x`, is reported, as is an empty nested list or `foreach` target (`[$a, []] = $x`, `foreach ($x as [])`). `list() = $a` reported "Cannot use empty list" twice (`php-rs-parser`).
- Jumps PHP rejects are reported: a `goto` to an undefined label (labels are per function body, so one outside a function, method, closure or hook does not count), into a loop or `switch`, or into or out of a `finally` block; a label defined twice; and a `break` or `continue` that leaves a `finally` block (`php-rs-parser`).
- `self`, `parent` and `static` are reported where PHP knows at compile time that they name no class: as a class reference or type in a function outside any class ("Cannot use "self" when no class scope is active"), and `parent` in a class, interface or enum without a parent. Closures, traits and top-level code are not checked, and in constant expressions only `X::class` is, as in PHP. Misuses of a parent property hook call such as `parent::$a::get()` are reported too: outside a hook, in a hook of another property or kind, or as `parent::$a::get(...)` (`php-rs-parser`).
- `\self`, `\parent` and `\static` as a class reference, type, `catch` type, parent or trait are reported ("'\self' is an invalid class name"), as is `self`, `parent` or `static` as a `catch` type ("Bad class name in the catch statement"), a trait in `use` or an adaptation, an interface an enum implements, or the parent or an interface of an anonymous class (`php-rs-parser`).
- `extends` and `implements` with a builtin type name such as `class A extends int` were rejected; PHP accepts them at compile time. Reserved names there are reported with PHP's message, which says "interface name" for interfaces (`php-rs-parser`).
- A parent property hook call with a literal property name, such as `parent::${'a'}::get()` or `parent::${0}::get()`, is checked like `parent::$a::get()` (`php-rs-parser`).
- `namespace\self`, `namespace\parent` and `namespace\static` types were rejected as reserved names; PHP reads them as `self`, `parent` and `static`, so they are checked against the class scope instead. A reserved type name written with a namespace is reported with its namespace-resolved name, such as `"N\Foo\array"` instead of `"Foo\array"` (`php-rs-parser`).
- Constant expressions (constant values, property and parameter defaults, enum case values and attribute arguments) are checked like PHP does at compile time: variables, calls, interpolated strings, `instanceof`, `match` and other runtime operations are reported ("Constant expression contains invalid operations"), as are dynamic class names (`$foo::BAR`, `$foo::class`, `new $x`), `static::BAR` and `static::class`, dynamic function and method names in first-class callables, non-static closures and closures with `use`, anonymous classes and argument unpacking in `new`, and `(object)` casts where `new` is not supported. Branches PHP folds away, such as `true ? 1 : $x`, are not checked. `new`, property fetches, closures, first-class callables and casts there are reported below PHP 8.1, 8.2 and 8.5. `new` in the second and later properties of a grouped declaration was not reported (`php-rs-parser`).
- Argument unpacking in an attribute, such as `#[A(...$x)]`, is reported (`php-rs-parser`).
- A literal that is not a string used as a class name, such as `(1)::A`, `new (1)` or `$a instanceof (1)`, is reported ("Illegal class name"; `Cannot use "::class" on array` for `([])::class`) (`php-rs-parser`).
- The right side of `instanceof` accepted any expression, such as `$a instanceof f()`, `"A"` or `A::B`; only a class name, a variable or a parenthesized expression is allowed (`php-rs-parser`).
- Type declarations are checked like PHP does at compile time: `void` and `never` outside a standalone return type (`?void`, `never|null`, `void $a`), `?null`, builtin types in intersections (`int&A`, `static&A`, and `self&A` in traits and closures), `void`, `never` and `callable` property and class constant types, `object` together with a class type (`object|A`), and intersections made redundant by another member (`A|(A&B)`, `(A&B)|(A&B&C)`). Messages name the types as PHP does, with class names resolved (`Property N\A::$a cannot have type X\Y|callable`) (`php-rs-parser`).
- Duplicate class types in a union or intersection are compared after name resolution, so `\Foo|Foo`, `namespace\A|A`, `\X\A|B` after `use X\A as B`, `A|self` in class `A` and `iterable|\Traversable` are reported, and `iterable|Traversable` in a namespace is no longer reported (`php-rs-parser`).
- `A&null`, `A&true` and `A&false` were syntax errors; they parse and are reported as builtin types in an intersection (`php-rs-parser`).
- `mixed`, `void` and `never` misuse, `Cannot redefine class constant` and the set hook parameter type error use PHP's wording, including the class name (`php-rs-parser`).
- Property hook rules are checked like PHP: visibility, `abstract`, `static` and `readonly` on a hook, repeated `final`, `#[\NoDiscard]` on a hook (8.5), a default value on a virtual property, and asymmetric visibility on a read-only or write-only virtual property. A property is virtual when no hook accesses `$this->name` outside a nested function or class (`php-rs-parser`).
- A named class, interface, trait or enum declared inside a class member body is reported as nested; a function declared in a method body no longer has the method's class scope (`php-rs-parser`).
- `Property with asymmetric visibility … must have type` names the property (`php-rs-parser`).
- Interface member rules are checked like PHP: non-public constants, methods and properties, `final` and `abstract` methods, and `final` or explicitly `abstract` properties. A promoted property in an abstract or interface constructor is reported, as are an `abstract private` method outside a trait, a hook without a body on a non-abstract property, a hook with a body in an interface, an abstract hook that is `final` or on a `private` property, and an abstract property without an abstract hook (`php-rs-parser`).
- `__construct` was recognized only in lowercase, so promoted parameters in `__CONSTRUCT` were rejected and its return type and `final private` checks were skipped (`php-rs-parser`).
- A return type on `__destruct` is reported (`php-rs-parser`).
- Abstract and interface method body errors and the constructor return type error use PHP's wording, including the class and method name (`php-rs-parser`).
- `declare` directives are checked like PHP: a value that is not a literal, `strict_types` or `encoding` that is not the first statement, `strict_types` in block mode or with a value other than `0` or `1`, and the warnings for unsupported directives and the ignored `encoding` (`php-rs-parser`).
- Magic method signatures are checked like PHP: argument count, by-reference arguments, parameter and return types, and the warning for a non-public magic method. Static-modifier and redeclaration messages name the class (`Method A::__get() cannot be static`, `Cannot redeclare A::f()`) (`php-rs-parser`).
- Duplicate enum methods and a promoted constructor property redeclaring a declared property are reported (`php-rs-parser`).
- Built-in attributes are checked like PHP: the declaration kind they may target (`#[Attribute]` on a function, `#[Override]` on a class, `#[SensitiveParameter]` on a method, …), repetition, `#[Attribute]`/`#[AllowDynamicProperties]`/`#[Deprecated]` on a class-like they cannot apply to, `#[NoDiscard]` on a constructor or a `void`/`never` function, and `#[DelayedTargetValidation]`. Names are resolved like class names and only attributes that exist at the target version are checked (`php-rs-parser`).
- `#[Attr] function &f() {}` was parsed as a by-reference closure; it is a function declaration (`php-rs-parser`).
- Attributes on a `const` with several items report PHP's wording, `Cannot apply attributes to multiple constants at once` (`php-rs-parser`).

---
- String escapes decode to the bytes PHP stores. `"\xff"`, `"\400"` and `"\u{D800}"` were stored one character per byte, so they could not be told apart from `"ÿ"` and the printer wrote different bytes; the printer now writes bytes that are not valid UTF-8 as `\xNN` (`php-rs-parser`, `php-printer`).

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
