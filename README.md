# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full typed AST with source spans, recovers from syntax errors, and covers PHP 7.4–8.5 syntax.

**[Try the interactive playground →](https://jorgsowa.github.io/rust-php-parser/)** · **[AST Node Reference →](https://jorgsowa.github.io/rust-php-parser/#docs)**

## Installation

```toml
[dependencies]
php-rs-parser = "*"
php-ast = "*"       # AST types and visitor/fold traits

# Optional
php-printer = "*"   # pretty-print AST back to PHP source
bumpalo = "*"       # only needed when using parse_arena() directly
```

## Quick Start

```rust
use php_rs_parser::parse;

let result = parse("<?php echo 'Hello, world!';");

println!("{:#?}", result.program);

for err in &result.errors {
    println!("error at {:?}: {}", err.span(), err);
}

// Resolve byte offsets to line/column
let pos = result.source_map.offset_to_line_col(6);
```

`parse` returns a [`ParseResult`] with no lifetime parameters — the AST is fully owned and can be stored anywhere.

## ParseResult fields

| Field | Type | Description |
|---|---|---|
| `program` | `php_ast::owned::Program` | The parsed AST. Always present, even when errors exist. |
| `errors` | `Vec<ParseError>` | Parse errors and diagnostics. Empty on success. |
| `errors_truncated` | `bool` | `true` when the error list was capped. |
| `source` | `String` | The original source text. Slice spans: `&result.source[span.start as usize..span.end as usize]`. |
| `comments` | `Vec<php_ast::owned::Comment>` | All comments in source order, not attached to AST nodes. |
| `source_map` | `SourceMap` | Pre-computed line index for `offset_to_line_col`. |

## Usage

### Version-aware parsing

The parser targets PHP 8.5 by default. Use `parse_versioned()` to target an earlier version:

```rust
use php_rs_parser::{parse_versioned, PhpVersion};

let result = parse_versioned(
    "<?php enum Status { case Active; }",
    PhpVersion::Php80,
);
// Enums require PHP 8.1 — a VersionTooLow diagnostic is emitted.
assert!(!result.errors.is_empty());
```

Supported versions: `Php74`, `Php80`, `Php81`, `Php82`, `Php83`, `Php84`, `Php85`.

### Error recovery

The parser never fails — it always produces a complete AST. Unrecoverable statements become `StmtKind::Error` nodes so the tree is structurally intact:

```rust
let result = php_rs_parser::parse("<?php function f() { $ }");
assert!(!result.errors.is_empty());
assert!(!result.program.stmts.is_empty());
```

### Re-parsing (LSP / editor use)

`ParserContext` reuses the backing arena in O(1) across repeated parses. `reparse_owned()` returns a fully-owned `ParseResult`:

```rust
let mut ctx = php_rs_parser::ParserContext::new();
let a = ctx.reparse_owned("<?php echo 1;");
let b = ctx.reparse_owned("<?php echo 2;"); // a stays alive
```

`reparse_versioned` and `reparse_owned_versioned` are also available.

### Visitor API

`OwnedVisitor` works directly on a `ParseResult`. Override only the node types you care about; the defaults recurse into children automatically:

```rust
use php_ast::owned::{OwnedVisitor, walk_owned_expr, Expr, ExprKind};
use std::ops::ControlFlow;

struct VarCounter { count: usize }

impl OwnedVisitor for VarCounter {
    fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
        if matches!(&expr.kind, ExprKind::Variable(_)) {
            self.count += 1;
        }
        walk_owned_expr(self, expr)
    }
}

let result = php_rs_parser::parse("<?php $x = $y + $z;");
let mut v = VarCounter { count: 0 };
v.visit_program(&result.program);
assert_eq!(v.count, 3);
```

Return `ControlFlow::Break(())` to stop early. Return `ControlFlow::Continue(())` without calling `walk_owned_*` to skip a subtree.

Use `OwnedScopeVisitor` + `OwnedScopeWalker` when you need to know which namespace, class, or function you are currently inside — every visit method receives an `OwnedScope`. See [`docs.rs/php-ast`](https://docs.rs/php-ast) for details.

### AST transformation

`FoldOwned` rebuilds the AST, letting you transform specific nodes. Override only what you need; all other nodes are rebuilt identically:

```rust
use php_ast::owned::{FoldOwned, fold_owned_expr, Expr, ExprKind};

struct NegateInts;

impl FoldOwned for NegateInts {
    fn fold_expr(&mut self, expr: &Expr) -> Expr {
        if let ExprKind::Int(n) = &expr.kind {
            return Expr { kind: ExprKind::Int(-n), span: expr.span };
        }
        fold_owned_expr(self, expr)
    }
}

let result = php_rs_parser::parse("<?php $x = 1;");
let transformed = NegateInts.fold_program(&result.program);
```

### Pretty printer

```rust
let result = php_rs_parser::parse("<?php echo 1 + 2;");
let output = php_printer::pretty_print_owned(&result.program);
// output == "<?php\necho 1 + 2;"
```

Use `pretty_print_owned_file` to append a trailing newline. Pass a `PrinterConfig` for custom indentation:

```rust
use php_printer::{PrinterConfig, Indent};

let config = PrinterConfig { indent: Indent::Spaces(2), ..Default::default() };
let output = php_printer::pretty_print_owned_with_config(&result.program, &config);
```

To preserve comments:

```rust
let output = php_printer::pretty_print_owned_with_comments(
    &result.program,
    &result.source,
    &result.comments,
);
```

### PHPDoc parser

```rust
use php_rs_parser::phpdoc::{parse, find_tags, body_text};

let doc = parse("/** @param int $x The value\n * @return bool */");
for param in find_tags(&doc, "param") {
    println!("{}", body_text(&param.body).unwrap_or_default()); // "int $x The value"
}
```

### Arena API

For maximum throughput or when you already hold an `ArenaParseResult` (e.g. inside an LSP hot path), use `parse_arena()` and the arena-form `Visitor` / `Fold` / `pretty_print` functions. See [`docs.rs/php-ast`](https://docs.rs/php-ast) for the arena visitor and fold traits.

## Architecture

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions; arena `Visitor`/`ScopeVisitor`/`Fold` traits; owned `OwnedVisitor`/`OwnedScopeVisitor`/`FoldOwned` traits |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery, PHPDoc parser, source map |
| **php-printer** | [![crates.io](https://img.shields.io/crates/v/php-printer)](https://crates.io/crates/php-printer) | Pretty printer — converts AST back to PHP source; supports both arena and owned AST |

Source flows through `Lexer → Parser → arena-allocated AST nodes`. The lexer is lazy (tokens produced on demand with peeking slots); the parser is Pratt-based recursive descent with panic-mode error recovery. The owned AST (`php_ast::owned`) provides lifetime-free mirrors of every node type for storage and manipulation without arena lifetime constraints.

## Performance

**The fastest full-featured PHP parser.** Optimised for modern PHP applications with full typing (PHP 7.4+, 8.x). For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for build instructions, testing, and contributor guides.

## Acknowledgements

Inspired by and indebted to [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
