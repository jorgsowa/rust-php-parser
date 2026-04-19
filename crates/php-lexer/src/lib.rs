//! Hand-written PHP lexer with support for PHP 8.0–8.5 syntax.
//!
//! This crate provides:
//! - [`Lexer`] — a lazy, streaming tokenizer. Call [`Lexer::next_token`] to advance one token at
//!   a time, or use [`Lexer::peek`]/[`Lexer::peek2`] for lookahead without consuming.
//! - [`TokenKind`] — the complete set of token types produced by the lexer.
//! - [`lex_all`] — convenience function that tokenizes an entire source string at once.
//!
//! # Quick start
//!
//! ```
//! use php_lexer::{Lexer, TokenKind};
//!
//! let mut lexer = Lexer::new("<?php echo 'hello';");
//! loop {
//!     let token = lexer.next_token();
//!     if token.kind == TokenKind::Eof { break; }
//!     println!("{:?} {:?}", token.kind, token.span);
//! }
//! ```

pub mod lexer;
pub mod token;

pub use lexer::{lex_all, Lexer, LexerError, LexerErrorKind, Token};
pub use token::TokenKind;
