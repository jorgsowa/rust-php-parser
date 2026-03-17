# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full AST with source spans, recovers from syntax errors, and covers the vast majority of PHP 8.x syntax.

Inspired by and tested against the [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) test suite.

> **Note:** The parser targets **PHP 8.5** by default — all supported syntax from PHP 5.x through 8.5 is accepted.

## Architecture

Cargo workspace with three crates:

| Crate | crates.io | Purpose |
|-------|-----------|---------|
| **php-lexer** | [![crates.io](https://img.shields.io/crates/v/php-lexer)](https://crates.io/crates/php-lexer) | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | [![crates.io](https://img.shields.io/crates/v/php-ast)](https://crates.io/crates/php-ast) | AST type definitions, serializable via Serde |
| **php-rs-parser** | [![crates.io](https://img.shields.io/crates/v/php-rs-parser)](https://crates.io/crates/php-rs-parser) | Pratt-based recursive descent parser with panic-mode error recovery |

## Usage

```rust
use php_rs_parser::parse;

let result = parse("<?php echo 'Hello, world!';");

println!("{:#?}", result.program);

for err in &result.errors {
    println!("error at {:?}: {}", err.span(), err);
}
```

## Performance

This parser is optimized for **modern PHP applications with full typing** (PHP 7.4+, 8.x). It delivers fastest performance on Symfony, Laravel, and other typed codebases.

The parser prioritizes performance on contemporary PHP patterns:
- **Type hints** — Full coverage (union types, mixed, never, readonly, attributes, etc.)
- **Complex expressions** — Method chains, array access, spread operators
- **Arrays & collections** — Configuration-heavy code (Symfony/Laravel patterns)
- **Structured OOP** — Classes, traits, interfaces with complete feature support

See [PERFORMANCE_ANALYSIS.md](PERFORMANCE_ANALYSIS.md) and [SYMFONY_OPTIMIZATION_ANALYSIS.md](SYMFONY_OPTIMIZATION_ANALYSIS.md) for detailed profiling and optimization analysis.

**The fastest full-featured PHP parser.** For comparative benchmarks against other PHP parsers (nikic/PHP-Parser, alternative implementations), see [php-parser-benchmark](https://github.com/jorgsowa/php-parser-benchmark).

## Testing

```sh
cargo test --test integration               # hand-written integration tests
cargo test --test nikic_integration_tests   # nikic/PHP-Parser fixture tests
```

Fixture files live in `crates/php-parser/tests/fixtures/`.

## Roadmap

See [ROADMAP.md](ROADMAP.md).

## License

BSD 3-Clause
