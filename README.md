# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full typed AST with source spans, recovers from syntax errors, and covers PHP 8.0–8.5 syntax.

Includes a corpus of test fixtures adapted from the [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) test suite.

> **Note:** The parser targets **PHP 8.5** by default. Use `parse_versioned()` to target an earlier version.

## Architecture

Cargo workspace with four crates:

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions, `Visitor` trait, `ScopeVisitor` trait |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery, PHPDoc parser, source map |
| **php-printer** | [![crates.io](https://img.shields.io/crates/v/php-printer)](https://crates.io/crates/php-printer) | Pretty printer — converts an AST back to PHP source |

## Usage

```rust
use php_rs_parser::parse;

let arena = bumpalo::Bump::new();
let result = parse(&arena, "<?php echo 'Hello, world!';");

println!("{:#?}", result.program);

for err in &result.errors {
    println!("error at {:?}: {}", err.span(), err);
}

// Resolve byte offsets to line/column
let pos = result.source_map.offset_to_line_col(6);
```

### Version-aware parsing

Target a specific PHP version to catch version-gated syntax:

```rust
use php_rs_parser::{parse_versioned, PhpVersion};

let arena = bumpalo::Bump::new();
let result = parse_versioned(
    &arena,
    "<?php enum Status { case Active; }",
    PhpVersion::Php80,
);
// Enums require PHP 8.1 — a VersionTooLow diagnostic is emitted.
assert!(!result.errors.is_empty());
```

Supported versions: `Php74`, `Php80`, `Php81`, `Php82`, `Php83`, `Php84`, `Php85`.

### Visitor API

Implement `Visitor` to walk the AST depth-first. Override only the node types you care about; the default implementations recurse into children automatically.

```rust
use php_ast::visitor::{Visitor, walk_expr};
use php_ast::ast::*;
use std::ops::ControlFlow;

struct VarCounter { count: usize }

impl<'arena, 'src> Visitor<'arena, 'src> for VarCounter {
    fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
        if matches!(&expr.kind, ExprKind::Variable(_)) {
            self.count += 1;
        }
        walk_expr(self, expr)
    }
}
```

Return `ControlFlow::Break(())` to stop traversal early. Return `ControlFlow::Continue(())` without calling `walk_*` to skip a subtree.

### Scope-aware traversal

`ScopeVisitor` and `ScopeWalker` provide zero-allocation lexical scope context — namespace, class name, and function/method name — at every node:

```rust
use php_ast::visitor::{ScopeVisitor, ScopeWalker, Scope};
use php_ast::ast::*;
use std::ops::ControlFlow;

struct MethodCollector { methods: Vec<String> }

impl<'arena, 'src> ScopeVisitor<'arena, 'src> for MethodCollector {
    fn visit_class_member(
        &mut self,
        member: &ClassMember<'arena, 'src>,
        scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        if let ClassMemberKind::Method(m) = &member.kind {
            self.methods.push(format!(
                "{}::{}",
                scope.class_name.unwrap_or("<anon>"),
                m.name
            ));
        }
        ControlFlow::Continue(())
    }
}

let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse(&arena, "<?php class Foo { public function bar() {} }");
let mut walker = ScopeWalker::new(MethodCollector { methods: vec![] });
let _ = walker.walk(&result.program);
// walker.into_inner().methods == ["Foo::bar"]
```

`Scope` fields:
- `namespace: Option<Cow<'src, str>>` — current namespace, `None` in the global namespace
- `class_name: Option<&'src str>` — enclosing class/interface/trait/enum name, `None` outside or in anonymous classes
- `function_name: Option<&'src str>` — enclosing named function/method name, `None` in closures/arrow functions

### Pretty printer

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse(&arena, "<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
// output == "echo 1 + 2;"
```

`pretty_print_file` prepends `<?php\n\n` and appends a trailing newline.

### PHPDoc parser

```rust
let tags = php_rs_parser::phpdoc::parse("/** @param int $id The user ID\n * @return User */");
```

Produces typed `PhpDocTag` variants for `@param`, `@return`, `@var`, `@throws`, `@template`, `@property`, `@method`, `@deprecated`, and Psalm/PHPStan annotations. Doc comments are attached to function, class, method, property, and constant AST nodes.

## Performance

This parser is optimised for **modern PHP applications with full typing** (PHP 7.4+, 8.x). It delivers the fastest performance on Symfony, Laravel, and other typed codebases.

**The fastest full-featured PHP parser.** For detailed analysis see [docs/performance/](docs/performance/). For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Testing

```sh
cargo test --test integration   # all .phpt fixture tests (including corpus)
cargo test --test php_syntax    # validate fixtures via php -l
cargo test --test malformed_php # error recovery and diagnostics
cargo test --test visitor       # visitor and scope-aware traversal
```

Fixture files live in `crates/php-parser/tests/fixtures/`. All fixtures are validated against `php -l` in CI across PHP 8.2–8.5. Fixtures using version-gated syntax must include `===config===` with `min_php=X.Y`.

## Documentation

### For external tool consumers (LSPs, linters, static analyzers)
1. This file — public API entry points (`parse`, `parse_versioned`, `ParserContext`)
2. `php-ast/src/visitor.rs` module doc — `Visitor` vs `ScopeVisitor` distinction
3. [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs) — `ParseError` variants
4. [docs/development/ERRORS.md](docs/development/ERRORS.md) — error recovery behavior

See [CONTRIBUTING.md](CONTRIBUTING.md) for contributor and performance researcher guides. Full documentation is in the [docs/](docs/) directory.

## Acknowledgements

Inspired by and indebted to [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
