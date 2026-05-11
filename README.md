# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full typed AST with source spans, recovers from syntax errors, and covers PHP 7.4–8.5 syntax.

**[Try the interactive playground →](https://jorgsowa.github.io/rust-php-parser/)**

## Installation

```toml
[dependencies]
php-rs-parser = "*"
php-ast = "*"          # AST types and Visitor trait
bumpalo = "*"          # arena allocator

# Optional
php-printer = "*"      # pretty-print AST back to PHP source
```

## Quick Start

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

### Arena lifetime

Every AST node is bump-allocated into `bumpalo::Bump`. The `'arena` lifetime on `ParseResult` borrows from the arena, so **the arena must outlive any reference into the AST**. Drop the arena to free all nodes at once:

```rust
let arena = bumpalo::Bump::new();
let result = parse(&arena, "<?php $x = 1;");
// use result...
drop(result);
drop(arena); // frees all AST memory in one shot
```

## API Reference

- **`parse()` / `parse_versioned()`** — main parser entry points; see [`docs.rs/php-rs-parser`](https://docs.rs/php-rs-parser)
- **`Visitor` / `ScopeVisitor`** — AST traversal traits; see [`docs.rs/php-ast`](https://docs.rs/php-ast) for the visitor infrastructure
- **`ParseError` variants** — see [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs) for all variants and recovery behavior
- **AST node types** — see [`docs.rs/php-ast/ast`](https://docs.rs/php-ast/latest/php_ast/ast/index.html) for the full set of statement, expression, and declaration nodes

## Usage

### Version-aware parsing

The parser targets PHP 8.5 by default. Use `parse_versioned()` to target an earlier version:

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

### ParseResult fields

| Field | Type | Description |
|---|---|---|
| `program` | `Program` | The parsed AST. Always present, even when errors exist. |
| `errors` | `Vec<ParseError>` | Parse errors and diagnostics. Empty on success. |
| `errors_truncated` | `bool` | `true` when the error list was capped. Treat the result as incomplete (relevant for linters). |
| `source` | `&str` | The original source text. Slice spans directly: `&result.source[span.start as usize..span.end as usize]`. |
| `comments` | `Vec<Comment>` | All comments in source order. Comments are **not** attached to AST nodes — map them to adjacent nodes by comparing spans. |
| `source_map` | `SourceMap` | Pre-computed line index. Use `offset_to_line_col(offset)` to convert byte offsets to `(line, col)`. |

### Error recovery

The parser never fails — it always produces a complete AST. When it cannot parse a statement, it emits a `ParseError` and inserts a `StmtKind::Error` node as a placeholder so the tree is structurally intact:

```rust
let arena = bumpalo::Bump::new();
let result = parse(&arena, "<?php function f() { $ }");

assert!(!result.errors.is_empty());  // parse error reported
assert!(!result.program.stmts.is_empty()); // AST still produced
// result.program.stmts contains a FunctionDecl whose body has a StmtKind::Error node
```

### Re-parsing (LSP / editor use)

Use `ParserContext` when parsing the same document repeatedly (e.g. on every keystroke). It reuses the backing arena memory in O(1), avoiding allocator churn:

```rust
let mut ctx = php_rs_parser::ParserContext::new();

let result = ctx.reparse("<?php echo 1;");
assert!(result.errors.is_empty());
drop(result); // must be dropped before the next reparse

let result = ctx.reparse("<?php echo 2;");
assert!(result.errors.is_empty());
```

`reparse_versioned` is also available for targeting a specific PHP version.

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

Use `ScopeVisitor` + `ScopeWalker` when your visitor needs to know **which namespace, class, or function** it is currently inside. Every visit method receives a `Scope` with that context:

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
let result = parse(&arena, "<?php class Foo { function bar() {} }");
let mut walker = ScopeWalker::new(result.source, MethodCollector { methods: vec![] });
walker.walk(&result.program);
// walker.into_inner().methods == ["Foo::bar"]
```

Use plain `Visitor` when you don't need namespace/class/function context.

### PHPDoc parser

PHPDoc comments are parsed into a structured AST via `php_rs_parser::phpdoc::parse()`. Tag bodies are exposed as raw text — the parser does not interpret type expressions, letting you apply your own type parser:

```rust
use php_rs_parser::phpdoc::{parse, find_tags, body_text};

let doc = parse("/** @param int $x The value\n * @return bool */");
for param in find_tags(&doc, "param") {
    let body = body_text(&param.body).unwrap_or_default();
    println!("{}", body); // "int $x The value"
}
```

### Pretty printer

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse(&arena, "<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
// output == "echo 1 + 2;"
```

Use `pretty_print_file` to produce a complete file with a `<?php\n\n` prefix and trailing newline.

To preserve comments in the output, use `pretty_print_with_comments`:

```rust
let output = php_printer::pretty_print_with_comments(
    &result.program,
    result.source,
    &result.comments,
);
```

To customise indentation or newlines, pass a `PrinterConfig`:

```rust
use php_printer::{PrinterConfig, Indent};

let config = PrinterConfig { indent: Indent::Spaces(2), ..Default::default() };
let output = php_printer::pretty_print_with_config(&result.program, &config);
```

## Architecture

Four crates, one workspace:

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions, `Visitor` trait, `ScopeVisitor` trait |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery, PHPDoc parser, source map |
| **php-printer** | [![crates.io](https://img.shields.io/crates/v/php-printer)](https://crates.io/crates/php-printer) | Pretty printer — converts an AST back to PHP source |

Source flows through `Lexer → Parser → arena-allocated AST nodes`. The lexer is lazy (tokens produced on demand with peeking slots); the parser is Pratt-based recursive descent with panic-mode error recovery.

## Performance

**The fastest full-featured PHP parser.** Optimised for modern PHP applications with full typing (PHP 7.4+, 8.x). For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for build instructions, testing, and contributor guides.

## Acknowledgements

Inspired by and indebted to [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
