# phpdoc-parser

Structural PHPDoc parser. Turns `/** ... */` blocks into a summary, description and tag list with accurate spans. Tag-agnostic: tag bodies are exposed as raw text so you can apply your own type parsers.

```rust
use phpdoc_parser::{body_text, find_tags, parse};

let doc = parse("/** @param int $x The value */");
for param in find_tags(&doc, "param") {
    println!("{}", body_text(&param.body).unwrap_or_default());
}
```

Also re-exported as `php_rs_parser::phpdoc`. Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/phpdoc-parser](https://docs.rs/phpdoc-parser).

## License

BSD 3-Clause
