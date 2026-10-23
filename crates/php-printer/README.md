# php-printer

Pretty printer that converts a PHP AST from [`php-rs-parser`](https://crates.io/crates/php-rs-parser) back into PHP source. Supports both the arena and owned ASTs, configurable indentation and comment re-attachment.

```rust
let result = php_rs_parser::parse("<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
assert_eq!(output, "<?php\necho 1 + 2;");
```

The output is normalized, not format-preserving: original whitespace and layout are not retained.

## Printing rules

- **Same meaning.** Re-parsing the output gives the same AST as the input, apart from redundant parentheses, empty statements and inline HTML that outputs nothing.
- **Same validity.** For the PHP version set in `PrinterConfig::php_version`, the printer never turns invalid PHP into valid PHP, or valid PHP into invalid PHP. Invalid input prints to output that PHP rejects with the same errors. Set it to the version the code was parsed for.
- **Redundant code is dropped only when that changes nothing.** Code is removed only when PHP's output and errors stay the same. Empty statements, including a `?>` that is a statement of its own, are dropped. They are kept only before a `declare(encoding=...)`, or a `declare(strict_types=...)` before PHP 8.5, since those reject them. A `?>` followed only by the newline it consumes and the next `<?php` is dropped.

Fixtures in `tests/fixtures/` enforce these rules. `edge_cases/` output must re-parse without errors to the same AST. `compile_errors/` output must keep the source's errors, and `scripts/validate-printer-output.sh` runs each output through `php -l`.

Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/php-printer](https://docs.rs/php-printer).

## License

BSD 3-Clause
