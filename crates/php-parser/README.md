# php-rs-parser

Fast, fault-tolerant PHP parser producing a typed AST with source spans. Covers PHP 7.4–8.5 syntax (plus PHP 8.6 partial function application) and recovers from syntax errors.

```rust
let result = php_rs_parser::parse("<?php echo 'Hello, world!';");
assert!(result.errors.is_empty());
println!("{:#?}", result.program);
```

Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. See the [main README](https://github.com/jorgsowa/rust-php-parser#readme) for the full guide, and [docs.rs/php-rs-parser](https://docs.rs/php-rs-parser) for the API reference.

## License

BSD 3-Clause
