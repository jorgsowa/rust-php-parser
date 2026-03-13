# Rust PHP Parser

A fast, fault-tolerant PHP parser written in Rust. Produces a full AST with source spans, recovers from syntax errors, and covers the vast majority of PHP 8.x syntax.

Inspired by and tested against the [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) test suite.

> **Note:** The parser targets **PHP 8.5** by default — all supported syntax from PHP 5.x through 8.5 is accepted.

## Architecture

Cargo workspace with three crates:

| Crate | Purpose |
|-------|---------|
| **php-lexer** | Hand-written tokenizer with handling for strings, heredoc/nowdoc, and inline HTML |
| **php-ast** | AST type definitions, serializable via Serde |
| **php-parser** | Pratt-based recursive descent parser with panic-mode error recovery |

## Usage

```rust
use php_parser::parse;

let result = parse("<?php echo 'Hello, world!';");

println!("{:#?}", result.program);

for err in &result.errors {
    println!("error at {:?}: {}", err.span(), err);
}
```

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
