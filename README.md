# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full typed AST with source spans, recovers from syntax errors, and covers PHP 7.4–8.5 syntax.

**[Try the interactive playground →](https://jorgsowa.github.io/rust-php-parser/)**

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

## API Reference

The three entry points you need for integration:

- **`parse()` / `parse_versioned()`** — main parser entry points in `php-rs-parser`; see [`crates/php-parser/src/lib.rs`](crates/php-parser/src/lib.rs)
- **`Visitor` / `ScopeVisitor`** — AST traversal traits in `php-ast`; see [`crates/php-ast/src/visitor.rs`](crates/php-ast/src/visitor.rs) for the distinction between the two
- **`ParseError` variants** — see [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs) and [docs/development/ERRORS.md](docs/development/ERRORS.md) for recovery behavior

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

For scope-aware traversal (`ScopeVisitor`, `ScopeWalker`) and the PHPDoc parser, see [docs/usage/VISITOR.md](docs/usage/VISITOR.md).

### Pretty printer

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse(&arena, "<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
// output == "echo 1 + 2;"
```

Use `pretty_print_file` to produce a complete file with a `<?php\n\n` prefix and trailing newline.

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

This parser is optimised for **modern PHP applications with full typing** (PHP 7.4+, 8.x). It delivers the fastest performance on Symfony, Laravel, and other typed codebases.

**The fastest full-featured PHP parser.** For detailed analysis see [docs/performance/](docs/performance/). For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for build instructions, testing, and contributor guides. Full documentation is in the [docs/](docs/) directory.

## Acknowledgements

Inspired by and indebted to [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
