# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full typed AST with source spans, recovers from syntax errors, and covers PHP 7.4–8.5 syntax.

**[Try the interactive playground →](https://jorgsowa.github.io/rust-php-parser/)** · **[AST Node Reference →](https://jorgsowa.github.io/rust-php-parser/#docs)**

## Installation

```toml
[dependencies]
php-rs-parser = "*"
php-ast = "*"          # AST types and visitor/fold traits

# Optional
php-printer = "*"      # pretty-print AST back to PHP source
bumpalo = "*"          # only needed when using parse_arena() directly
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

## API Reference

- **`parse()` / `parse_versioned()`** — main entry points; return a fully-owned `ParseResult` with no lifetime parameters. See [`docs.rs/php-rs-parser`](https://docs.rs/php-rs-parser)
- **`parse_arena()` / `parse_arena_versioned()`** — arena-allocated variants for LSP servers and hot paths; return `ArenaParseResult<'arena, 'src>`
- **`ParserContext`** — reusable context for repeated re-parses; `reparse_owned()` returns a lifetime-free `ParseResult`, `reparse()` returns the arena form
- **`OwnedVisitor` / `OwnedScopeVisitor`** — traverse a `ParseResult` AST with no arena involved; see `php_ast::owned::visitor`
- **`FoldOwned`** — transform a `ParseResult` AST into a new owned AST; see `php_ast::owned::fold`
- **`Visitor` / `ScopeVisitor`** — arena-form traversal traits; see [`docs.rs/php-ast`](https://docs.rs/php-ast)
- **`Fold`** — arena-form transformation trait; reads one arena, writes another
- **`ParseError` variants** — see [`crates/php-parser/src/diagnostics.rs`](crates/php-parser/src/diagnostics.rs) for all variants and recovery behavior
- **AST node types** — see [`docs.rs/php-ast/ast`](https://docs.rs/php-ast/latest/php_ast/ast/index.html) for the full set of statement, expression, and declaration nodes

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

### ParseResult fields

| Field | Type | Description |
|---|---|---|
| `program` | `php_ast::owned::Program` | The parsed AST. Always present, even when errors exist. |
| `errors` | `Vec<ParseError>` | Parse errors and diagnostics. Empty on success. |
| `errors_truncated` | `bool` | `true` when the error list was capped. Treat the result as incomplete (relevant for linters). |
| `source` | `String` | The original source text. Slice spans directly: `&result.source[span.start as usize..span.end as usize]`. |
| `comments` | `Vec<php_ast::owned::Comment>` | All comments in source order. Comments are **not** attached to AST nodes — map them to adjacent nodes by comparing spans. |
| `source_map` | `SourceMap` | Pre-computed line index. Use `offset_to_line_col(offset)` to convert byte offsets to `(line, col)`. |

### Multi-file cache

`ParseResult` has no lifetime parameters — store it directly in a `HashMap`, send it across threads, or hold it in a struct:

```rust
use std::collections::HashMap;
use std::path::PathBuf;
use php_rs_parser::{parse, ParseResult};

let mut cache: HashMap<PathBuf, ParseResult> = HashMap::new();
cache.insert(PathBuf::from("a.php"), parse("<?php echo 1;"));
cache.insert(PathBuf::from("b.php"), parse("<?php echo 2;"));
```

### Error recovery

The parser never fails — it always produces a complete AST. When it cannot parse a statement, it emits a `ParseError` and inserts a `StmtKind::Error` node as a placeholder so the tree is structurally intact:

```rust
let result = php_rs_parser::parse("<?php function f() { $ }");

assert!(!result.errors.is_empty());  // parse error reported
assert!(!result.program.stmts.is_empty()); // AST still produced
// result.program.stmts contains a FunctionDecl whose body has a StmtKind::Error node
```

### Re-parsing (LSP / editor use)

Use `ParserContext` when parsing the same document repeatedly (e.g. on every keystroke). It reuses the backing arena memory in O(1), avoiding allocator churn.

`reparse_owned()` returns a fully-owned `ParseResult` — no lifetimes, no `drop` discipline required:

```rust
let mut ctx = php_rs_parser::ParserContext::new();

let a = ctx.reparse_owned("<?php echo 1;");
let b = ctx.reparse_owned("<?php echo 2;"); // a can stay alive
assert!(a.errors.is_empty());
assert!(b.errors.is_empty());
```

`reparse()` returns an `ArenaParseResult` that borrows from the context arena. The borrow checker prevents calling `reparse` again while that result is alive — drop it first:

```rust
let result = ctx.reparse("<?php echo 1;");
assert!(result.errors.is_empty());
drop(result); // must be dropped before the next reparse

let result = ctx.reparse("<?php echo 2;");
assert!(result.errors.is_empty());
```

`reparse_versioned` and `reparse_owned_versioned` are also available for targeting a specific PHP version.

### Visitor API (owned)

`OwnedVisitor` works directly on a `ParseResult` — no arena, no lifetime parameters. Override only the node types you care about:

```rust
use php_ast::owned::visitor::{OwnedVisitor, walk_owned_expr};
use php_ast::owned::{Expr, ExprKind};
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

Return `ControlFlow::Break(())` to stop traversal early. Return `ControlFlow::Continue(())` without calling `walk_owned_*` to skip a subtree.

#### Scope-aware owned traversal

Use `OwnedScopeVisitor` + `OwnedScopeWalker` when you need to know **which namespace, class, or function** you are currently inside:

```rust
use php_ast::owned::visitor::{OwnedScopeVisitor, OwnedScopeWalker, OwnedScope};
use php_ast::owned::{ClassMember, ClassMemberKind};
use std::ops::ControlFlow;

struct MethodCollector { methods: Vec<String> }

impl OwnedScopeVisitor for MethodCollector {
    fn visit_class_member(
        &mut self,
        member: &ClassMember,
        scope: &OwnedScope,
    ) -> ControlFlow<()> {
        if let ClassMemberKind::Method(m) = &member.kind {
            self.methods.push(format!(
                "{}::{}",
                scope.class_name.as_deref().unwrap_or("<anon>"),
                m.name,
            ));
        }
        ControlFlow::Continue(())
    }
}

let result = php_rs_parser::parse("<?php class Foo { function bar() {} }");
let mut walker = OwnedScopeWalker::new(MethodCollector { methods: vec![] });
walker.walk(&result.program);
// walker.into_inner().methods == ["Foo::bar"]
```

### Visitor API (arena)

Use the arena `Visitor` when you need maximum throughput and manage the arena lifetime yourself:

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

Use `ScopeVisitor` + `ScopeWalker` for scope-aware arena traversal:

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
let result = php_rs_parser::parse_arena(&arena, "<?php class Foo { function bar() {} }");
let mut walker = ScopeWalker::new(result.source, MethodCollector { methods: vec![] });
walker.walk(&result.program);
// walker.into_inner().methods == ["Foo::bar"]
```

### AST transformation — FoldOwned

`FoldOwned` transforms a `ParseResult` AST into a new owned AST. Override only the node types you want to change; all others are rebuilt identically:

```rust
use php_ast::owned::fold::{FoldOwned, fold_owned_expr};
use php_ast::owned::{Expr, ExprKind};

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
// transformed is a new owned::Program with all integers negated
```

### AST transformation — Fold (arena)

`Fold` is the arena-form transformation trait. It reads from one arena and writes into a new output arena — the correct design for arena-allocated ASTs where in-place mutation would break lifetime invariants:

```rust
use bumpalo::Bump;
use php_ast::fold::{Fold, fold_expr};
use php_ast::ast::*;

struct NegateInts;

impl<'src> Fold<'src> for NegateInts {
    fn fold_expr<'new>(&mut self, arena: &'new Bump, expr: &Expr<'_, 'src>) -> Expr<'new, 'src> {
        if let ExprKind::Int(n) = expr.kind {
            return Expr { kind: ExprKind::Int(-n), span: expr.span };
        }
        fold_expr(self, arena, expr)
    }
}

let src_arena = Bump::new();
let result = php_rs_parser::parse_arena(&src_arena, "<?php $x = 1;");

let out_arena = Bump::new();
let transformed = NegateInts.fold_program(&out_arena, &result.program);
// `transformed` lives in `out_arena`; `result` and `src_arena` can be dropped independently
```

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

`pretty_print_owned` works directly on a `ParseResult` — no arena needed:

```rust
let result = php_rs_parser::parse("<?php echo 1 + 2;");
let output = php_printer::pretty_print_owned(&result.program);
// output == "<?php\necho 1 + 2;"
```

Use `pretty_print_owned_file` to append a trailing newline. Use `pretty_print_owned_with_config` for custom indentation.

When using the arena API (e.g. inside an LSP handler that already holds an `ArenaParseResult`), use the arena-form functions directly to avoid an extra conversion:

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse_arena(&arena, "<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
```

To preserve comments in the output, use `pretty_print_with_comments`:

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse_arena(&arena, "<?php // comment\necho 1;");
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
let output = php_printer::pretty_print_owned_with_config(&result.program, &config);
```

## Architecture

Four crates, one workspace:

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions; arena `Visitor`/`ScopeVisitor`/`Fold` traits; owned (lifetime-free) `OwnedVisitor`/`OwnedScopeVisitor`/`FoldOwned` traits |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery, PHPDoc parser, source map |
| **php-printer** | [![crates.io](https://img.shields.io/crates/v/php-printer)](https://crates.io/crates/php-printer) | Pretty printer — converts an AST back to PHP source; supports both arena and owned AST |

Source flows through `Lexer → Parser → arena-allocated AST nodes`. The lexer is lazy (tokens produced on demand with peeking slots); the parser is Pratt-based recursive descent with panic-mode error recovery. The owned AST (`php_ast::owned`) provides lifetime-free mirrors of every node type, enabling storage and manipulation without arena lifetime constraints.

**When to use the arena API vs. the owned API:**

| Use case | Recommended API |
|---|---|
| One-shot parsing, CLI tools, batch processing | `parse()` → `ParseResult` (owned) |
| Store results in `HashMap`, send across threads | `parse()` → `ParseResult` (owned) |
| Walk or transform a `ParseResult` | `OwnedVisitor` / `FoldOwned` |
| LSP server, repeated re-parses | `ParserContext::reparse_owned()` or `reparse()` |
| Maximum throughput, arena lifetime under your control | `parse_arena()` → arena `Visitor` / `Fold` |

## Performance

**The fastest full-featured PHP parser.** Optimised for modern PHP applications with full typing (PHP 7.4+, 8.x). For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for build instructions, testing, and contributor guides.

## Acknowledgements

Inspired by and indebted to [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
