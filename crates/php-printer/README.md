# php-printer

Pretty printer that converts a PHP AST from [`php-rs-parser`](https://crates.io/crates/php-rs-parser) back into PHP source. Supports both the arena and owned ASTs, configurable indentation and comment re-attachment.

```rust
let result = php_rs_parser::parse("<?php echo 1 + 2;");
let output = php_printer::pretty_print(&result.program);
assert_eq!(output, "<?php\necho 1 + 2;");
```

The output is normalized, not format-preserving: original whitespace and layout are not retained.

## Printing rules

- **Same meaning.** Re-parsing the output gives the same AST as the input, apart from redundant parentheses and inline HTML that outputs nothing.
- **Same validity.** The printer never turns invalid PHP into valid PHP, or valid PHP into invalid PHP, on any supported PHP version. Invalid input prints to output that PHP rejects with the same errors.
- **Redundant code is dropped only when that changes nothing.** Code is removed only when PHP's output and errors stay the same. For example, a `?>` followed only by the newline it consumes and the next `<?php` is dropped. It is kept when the `?>` forms an empty statement that a later `declare(encoding=...)` or `declare(strict_types=...)` rejects.
- **Source-dependent decisions.** Some decisions read the original source, such as whether a `?>` follows a `;`. Pass it with `comments(source, …)`. Without it, the printer decides from the AST alone.

Fixtures in `tests/fixtures/` enforce these rules. `edge_cases/` output must re-parse without errors to the same AST. `compile_errors/` output must keep the source's errors, and `scripts/validate-printer-output.sh` runs each output through `php -l`.

Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/php-printer](https://docs.rs/php-printer).

## License

BSD 3-Clause
