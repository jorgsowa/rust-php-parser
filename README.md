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

// Resolve byte offsets to 0-based line/column
let pos = result.source_map.offset_to_line_col(6);
// pos.to_one_based() → (line, col) for diagnostics
// result.source_map.span_to_line_col(span) → LineColSpan { start, end }
```

`parse` returns a [`ParseResult`] with no lifetime parameters — the AST is fully owned and can be stored anywhere.

## ParseResult fields

| Field | Type | Description |
|---|---|---|
| `program` | `php_ast::owned::Program` | The parsed AST. Always present, even when errors exist. |
| `errors` | `Vec<ParseError>` | Parse errors and diagnostics. Empty on success. |
| `errors_truncated` | `bool` | `true` when the error list was capped and further errors were dropped. |
| `source` | `String` | The original source text. Slice a span: `&result.source[span.start as usize..span.end as usize]`. |
| `comments` | `Vec<php_ast::owned::Comment>` | All comments in source order, **except** `/** */` doc-block comments that are attached to a node's `doc_comment` field — see below. The two collections are disjoint. |
| `source_map` | `SourceMap` | Pre-computed line index. `offset_to_line_col(offset)` and `span_to_line_col(span)` both return 0-based `LineCol`. Call `.to_one_based()` for human-readable 1-based positions. |

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

`ParserContext` resets its backing arena in O(1) between parses instead of reallocating. Two variants are available:

- `reparse_owned()` — returns a fully-owned `ParseResult` with no lifetime parameters; previous results stay alive:

```rust
let mut ctx = php_rs_parser::ParserContext::new();
let a = ctx.reparse_owned("<?php echo 1;");
let b = ctx.reparse_owned("<?php echo 2;"); // a stays alive
```

- `reparse()` — returns an arena-allocated `ArenaParseResult` that borrows from `ctx`; the previous result **must be dropped** before calling again:

```rust
let result = ctx.reparse("<?php echo 1;");
drop(result); // required before next reparse
let result = ctx.reparse("<?php echo 2;");
```

Versioned forms `reparse_versioned` and `reparse_owned_versioned` are also available.

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

Use `OwnedScopeVisitor` + `OwnedScopeWalker` when you need to know which namespace, class, or function you are currently inside — every visit method receives an `OwnedScope` with the current namespace, class name, and function/method name. See [`docs.rs/php-ast`](https://docs.rs/php-ast) for details.

For arena-allocated ASTs from `parse_arena()`, use the `Visitor`/`ScopeVisitor` traits from `php_ast::visitor` instead. `ScopeWalker::new` requires passing the source string (`result.source`) for zero-alloc namespace tracking.

### AST transformation

`FoldOwned` rebuilds the owned AST, letting you transform specific nodes. Override only what you need; all other nodes are rebuilt identically:

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

For arena-allocated ASTs from `parse_arena()`, use the `Fold<'src>` trait from `php_ast::fold`. It reads from a source arena and writes into a destination arena, leaving the source unchanged.

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

To preserve comments, pass the source and comment list from `ParseResult`:

```rust
let output = php_printer::pretty_print_owned_with_comments(
    &result.program,
    &result.source,
    &result.comments,
);
```

Both variants accept an optional `PrinterConfig`:
- `pretty_print_owned_with_comments_and_config` — comments + custom config
- `pretty_print_with_comments` / `pretty_print_with_comments_and_config` — arena equivalents for use with `parse_arena()`

### PHPDoc parser

The `phpdoc_parser` crate (re-exported as `php_rs_parser::phpdoc`) parses `/** */` doc-block comments into a structured AST. It is tag-agnostic — tag bodies are exposed as raw text so callers can apply their own type parsers.

```rust
use php_rs_parser::phpdoc::{parse, find_tag, find_tags, body_text, text_content, inline_tags};

let doc = parse("/** @param int $x The value\n * @return bool */");

// Find the first @param tag
if let Some(param) = find_tag(&doc, "param") {
    println!("{}", body_text(&param.body).unwrap_or_default()); // "int $x The value"
}

// Iterate all @param tags
for param in find_tags(&doc, "param") {
    let body = body_text(&param.body).unwrap_or_default();
}

// Reconstruct full text of the summary (including inline tags)
if let Some(summary) = &doc.summary {
    let text = text_content(summary);
    // Inline {@link ...} and {@see ...} tags are included as {@name body}
    for tag in inline_tags(summary) {
        println!("inline tag: {}", tag.name);
    }
}
```

Doc-block comments are stored in a `doc_comment` field on the AST node they precede and are **not** present in `ParseResult::comments` — the two collections are disjoint:

| Placement | Where the `doc_comment` field lives |
|---|---|
| Before a declaration (`function`, `class`, `method`, `property`, `const`, enum `case`) | On the inner declaration node (`FunctionDecl`, `ClassDecl`, …) |
| Before a non-declaration statement (`foreach`, `if`, `while`, assignments, …) | On the `Stmt` wrapper — accessible via `stmt.doc_comment` or the unified `stmt.leading_doc_comment()` accessor |

`Stmt::leading_doc_comment()` returns the doc-block regardless of where it lives, so callers do not need to branch on statement kind.

A doc-block with no following statement before the enclosing `}` or EOF stays in `ParseResult::comments`.

Use `php_rs_parser::phpdoc::parse(comment.text)` to parse the raw text into a structured AST.

### Arena API

Use `parse_arena()` when managing arena lifetime yourself (e.g. inside an LSP hot path):

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse_arena(&arena, "<?php echo 1;");
let output = php_printer::pretty_print(&result.program);
// With comments:
let output = php_printer::pretty_print_with_comments(
    &result.program,
    result.source,
    &result.comments,
);
```

Use `parse_arena_raw()` when you only need the AST and errors and never call `source_map.offset_to_line_col` — it skips building the line index:

```rust
let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse_arena_raw(&arena, "<?php echo 1;");
// result.source_map is a no-op empty map
```

The arena-form `Visitor`, `ScopeVisitor`, and `Fold<'src>` traits operate directly on `Program<'arena, 'src>` without any conversion. See [`docs.rs/php-ast`](https://docs.rs/php-ast) for the full arena visitor and fold API.

## Architecture

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions; arena `Visitor`/`ScopeVisitor`/`Fold` traits; owned `OwnedVisitor`/`OwnedScopeVisitor`/`FoldOwned` traits |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery, source map; re-exports `phpdoc-parser` as `php_rs_parser::phpdoc` |
| **phpdoc-parser** | [![crates.io](https://img.shields.io/crates/v/phpdoc-parser)](https://crates.io/crates/phpdoc-parser) | Standalone structural PHPDoc block parser — tag-agnostic, no external dependencies |
| **php-printer** | [![crates.io](https://img.shields.io/crates/v/php-printer)](https://crates.io/crates/php-printer) | Pretty printer — converts AST back to PHP source; supports both arena and owned AST |

Source flows through `Lexer → Parser → arena-allocated AST nodes`. The lexer is lazy (tokens produced on demand); the parser is Pratt-based recursive descent with a 2-token lookahead window and panic-mode error recovery. The owned AST (`php_ast::owned`) provides lifetime-free mirrors of every node type for storage and manipulation without arena lifetime constraints.

## Performance

Optimised for full-typing PHP 7.4+ and 8.x codebases. For comparative benchmarks against other PHP parsers see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for build instructions, testing, and the contributor guide.

## Acknowledgements

Built on the shoulders of [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) — test corpus fixtures were adapted from its test suite. Thanks to the PHP community contributors.

## License

BSD 3-Clause
