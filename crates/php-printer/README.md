# php-printer

Pretty printer that converts a PHP AST from [`php-rs-parser`](https://crates.io/crates/php-rs-parser) back into PHP source. Supports both the arena and owned ASTs, configurable indentation and comment re-attachment.

```rust
let result = php_rs_parser::parse("<?php echo 1 + 2;");
let output = php_printer::pretty_print_owned(&result.program);
assert_eq!(output, "<?php\necho 1 + 2;");
```

The output is normalized, not format-preserving: original whitespace and layout are not retained.

Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/php-printer](https://docs.rs/php-printer).

## License

BSD 3-Clause
