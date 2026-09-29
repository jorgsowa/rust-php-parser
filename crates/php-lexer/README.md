# php-lexer

Hand-written, lazy PHP tokenizer with support for strings, heredoc/nowdoc and inline HTML.

```rust
use php_lexer::{Lexer, TokenKind};

let mut lexer = Lexer::new("<?php echo 'hello';");
loop {
    let token = lexer.next_token();
    if token.kind == TokenKind::Eof { break; }
    println!("{:?} {:?}", token.kind, token.span);
}
```

Most users want [`php-rs-parser`](https://crates.io/crates/php-rs-parser) instead. Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/php-lexer](https://docs.rs/php-lexer).

## License

BSD 3-Clause
