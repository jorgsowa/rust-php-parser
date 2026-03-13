use php_ast::Span;

use crate::token::{resolve_keyword, TokenKind};

#[derive(Debug, Clone, PartialEq)]
pub struct LexerError {
    pub message: String,
    pub span: Span,
}

#[derive(Debug, Clone, PartialEq)]
pub struct Token {
    pub kind: TokenKind,
    pub span: Span,
}

impl Token {
    pub fn new(kind: TokenKind, span: Span) -> Self {
        Self { kind, span }
    }

    pub fn eof(offset: u32) -> Self {
        Self {
            kind: TokenKind::Eof,
            span: Span::new(offset, offset),
        }
    }
}

#[derive(Debug, Clone, Copy, PartialEq, Eq)]
enum LexerMode {
    InlineHtml,
    Php,
}

pub struct Lexer<'src> {
    source: &'src str,
    mode: LexerMode,
    pos: usize,
    peeked: Option<Token>,
    peeked2: Option<Token>,
    pub errors: Vec<LexerError>,
}

#[inline]
fn is_ident_start(b: u8) -> bool {
    b.is_ascii_alphabetic() || b == b'_' || b >= 0x80
}

#[inline]
fn is_ident_continue(b: u8) -> bool {
    b.is_ascii_alphanumeric() || b == b'_' || b >= 0x80
}

impl<'src> Lexer<'src> {
    pub fn new(source: &'src str) -> Self {
        // Skip shebang line if present (e.g., #!/usr/bin/env php)
        let pos = if source.starts_with("#!") {
            source.find('\n').map(|p| p + 1).unwrap_or(source.len())
        } else {
            0
        };

        // Determine initial mode: if remaining source starts with `<?php` or `<?=`, start in PHP mode
        let remaining = &source[pos..];
        let mode = if remaining.starts_with("<?php") || remaining.starts_with("<?=") {
            LexerMode::Php
        } else {
            LexerMode::InlineHtml
        };

        Self {
            source,
            mode,
            pos,
            peeked: None,
            peeked2: None,
            errors: Vec::new(),
        }
    }

    /// Create a lexer starting in PHP mode at a given byte offset within `source`.
    /// The caller guarantees that `source[offset..]` contains valid PHP expression
    /// content (no `<?php` tag needed — the lexer is pre-set to PHP mode).
    /// Spans produced will be correct absolute offsets into `source`.
    pub fn new_at(source: &'src str, offset: usize) -> Self {
        Self {
            source,
            mode: LexerMode::Php,
            pos: offset,
            peeked: None,
            peeked2: None,
            errors: Vec::new(),
        }
    }

    pub fn source(&self) -> &'src str {
        self.source
    }

    pub fn peek(&mut self) -> &Token {
        if self.peeked.is_none() {
            self.peeked = Some(self.read_next_token());
        }
        self.peeked.as_ref().unwrap()
    }

    /// Peek two tokens ahead (past the next token).
    pub fn peek2(&mut self) -> &Token {
        // Ensure peeked is filled
        if self.peeked.is_none() {
            self.peeked = Some(self.read_next_token());
        }
        if self.peeked2.is_none() {
            self.peeked2 = Some(self.read_next_token());
        }
        self.peeked2.as_ref().unwrap()
    }

    pub fn next_token(&mut self) -> Token {
        if let Some(token) = self.peeked.take() {
            self.peeked = self.peeked2.take();
            return token;
        }
        self.read_next_token()
    }

    /// Get the text slice corresponding to a token
    pub fn token_text(&self, token: &Token) -> &'src str {
        &self.source[token.span.start as usize..token.span.end as usize]
    }

    fn read_next_token(&mut self) -> Token {
        if self.pos >= self.source.len() {
            return Token::eof(self.source.len() as u32);
        }

        match self.mode {
            LexerMode::InlineHtml => self.lex_inline_html(),
            LexerMode::Php => self.lex_php(),
        }
    }

    fn lex_inline_html(&mut self) -> Token {
        let start = self.pos;

        // Search for <?php or <?=
        if let Some(tag_pos) = self.source[self.pos..]
            .find("<?php")
            .or_else(|| self.source[self.pos..].find("<?="))
        {
            if tag_pos == 0 {
                // We're right at the open tag, switch to PHP mode
                self.mode = LexerMode::Php;
                return self.lex_php();
            }
            // Emit inline HTML up to the tag
            let end = self.pos + tag_pos;
            self.pos = end;
            self.mode = LexerMode::Php;
            Token::new(TokenKind::InlineHtml, Span::new(start as u32, end as u32))
        } else {
            // Rest of file is inline HTML
            let end = self.source.len();
            self.pos = end;
            Token::new(TokenKind::InlineHtml, Span::new(start as u32, end as u32))
        }
    }

    fn lex_php(&mut self) -> Token {
        let remaining = &self.source[self.pos..];

        // Try heredoc/nowdoc before skipping whitespace (heredoc does its own whitespace handling)
        if let Some(token) = self.try_lex_heredoc(remaining) {
            return token;
        }

        // Skip whitespace and comments
        self.skip_whitespace_and_comments();

        if self.pos >= self.source.len() {
            return Token::eof(self.source.len() as u32);
        }

        self.scan_token()
    }

    /// Skip whitespace, line comments (//), block comments (/* */), and hash comments (#).
    fn skip_whitespace_and_comments(&mut self) {
        let bytes = self.source.as_bytes();
        loop {
            // Skip whitespace
            while self.pos < bytes.len()
                && matches!(bytes[self.pos], b' ' | b'\t' | b'\r' | b'\n' | b'\x0C')
            {
                self.pos += 1;
            }

            if self.pos >= bytes.len() {
                break;
            }

            // Skip // line comments
            // Note: in PHP, ?> terminates a line comment just like \n does.
            if bytes[self.pos] == b'/' && self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'/'
            {
                self.pos += 2;
                while self.pos < bytes.len() && bytes[self.pos] != b'\n' {
                    if bytes[self.pos] == b'?' && self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'>' {
                        break; // leave ?> for scan_token to produce CloseTag
                    }
                    self.pos += 1;
                }
                continue;
            }

            // Skip /* */ block comments
            if bytes[self.pos] == b'/' && self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'*'
            {
                self.pos += 2;
                loop {
                    if self.pos + 1 >= bytes.len() {
                        // Unclosed comment - consume rest of file
                        self.pos = bytes.len();
                        break;
                    }
                    if bytes[self.pos] == b'*' && bytes[self.pos + 1] == b'/' {
                        self.pos += 2;
                        break;
                    }
                    self.pos += 1;
                }
                continue;
            }

            // Skip # comments (but not #[)
            // Note: in PHP, ?> terminates a hash comment just like \n does.
            if bytes[self.pos] == b'#'
                && !(self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'[')
            {
                self.pos += 1;
                while self.pos < bytes.len() && bytes[self.pos] != b'\n' {
                    if bytes[self.pos] == b'?' && self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'>' {
                        break; // leave ?> for scan_token to produce CloseTag
                    }
                    self.pos += 1;
                }
                continue;
            }

            break;
        }
    }

    /// Scan a single PHP token starting at the current position.
    fn scan_token(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();
        let b = bytes[start];

        match b {
            // --- Operators ---
            b'+' => {
                if self.check_at(1, b'+') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PlusPlus, start)
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PlusEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Plus, start)
                }
            }
            b'-' => {
                if self.check_at(1, b'-') {
                    self.pos = start + 2;
                    self.tok(TokenKind::MinusMinus, start)
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::MinusEquals, start)
                } else if self.check_at(1, b'>') {
                    self.pos = start + 2;
                    self.tok(TokenKind::Arrow, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Minus, start)
                }
            }
            b'*' => {
                if self.check_at(1, b'*') {
                    if self.check_at(2, b'=') {
                        self.pos = start + 3;
                        self.tok(TokenKind::StarStarEquals, start)
                    } else {
                        self.pos = start + 2;
                        self.tok(TokenKind::StarStar, start)
                    }
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::StarEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Star, start)
                }
            }
            b'/' => {
                // Comments already handled by skip_whitespace_and_comments
                if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::SlashEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Slash, start)
                }
            }
            b'%' => {
                if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PercentEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Percent, start)
                }
            }
            b'.' => {
                // FloatLiteralLeadingDot: .5, .5e3, etc.
                if start + 1 < bytes.len() && bytes[start + 1].is_ascii_digit() {
                    self.pos = start + 1;
                    self.scan_digits(u8::is_ascii_digit);
                    // Check for exponent
                    if self.pos < bytes.len() && matches!(bytes[self.pos], b'e' | b'E') {
                        self.try_scan_exponent();
                    }
                    // Check for trailing underscore
                    if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                        self.consume_invalid_numeric_rest();
                        return self.invalid_numeric(start);
                    }
                    return self.tok(TokenKind::FloatLiteralLeadingDot, start);
                }
                if self.check_at(1, b'.') && self.check_at(2, b'.') {
                    self.pos = start + 3;
                    self.tok(TokenKind::Ellipsis, start)
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::DotEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Dot, start)
                }
            }
            b'=' => {
                if self.check_at(1, b'=') {
                    if self.check_at(2, b'=') {
                        self.pos = start + 3;
                        self.tok(TokenKind::EqualsEqualsEquals, start)
                    } else {
                        self.pos = start + 2;
                        self.tok(TokenKind::EqualsEquals, start)
                    }
                } else if self.check_at(1, b'>') {
                    self.pos = start + 2;
                    self.tok(TokenKind::FatArrow, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Equals, start)
                }
            }
            b'!' => {
                if self.check_at(1, b'=') {
                    if self.check_at(2, b'=') {
                        self.pos = start + 3;
                        self.tok(TokenKind::BangEqualsEquals, start)
                    } else {
                        self.pos = start + 2;
                        self.tok(TokenKind::BangEquals, start)
                    }
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Bang, start)
                }
            }
            b'<' => self.scan_less_than(start),
            b'>' => {
                if self.check_at(1, b'>') {
                    if self.check_at(2, b'=') {
                        self.pos = start + 3;
                        self.tok(TokenKind::ShiftRightEquals, start)
                    } else {
                        self.pos = start + 2;
                        self.tok(TokenKind::ShiftRight, start)
                    }
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::GreaterThanEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::GreaterThan, start)
                }
            }
            b'&' => {
                if self.check_at(1, b'&') {
                    self.pos = start + 2;
                    self.tok(TokenKind::AmpersandAmpersand, start)
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::AmpersandEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Ampersand, start)
                }
            }
            b'|' => {
                if self.check_at(1, b'|') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PipePipe, start)
                } else if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PipeEquals, start)
                } else if self.check_at(1, b'>') {
                    self.pos = start + 2;
                    self.tok(TokenKind::PipeArrow, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Pipe, start)
                }
            }
            b'^' => {
                if self.check_at(1, b'=') {
                    self.pos = start + 2;
                    self.tok(TokenKind::CaretEquals, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Caret, start)
                }
            }
            b'~' => {
                self.pos = start + 1;
                self.tok(TokenKind::Tilde, start)
            }
            b'?' => {
                if self.check_at(1, b'>') {
                    self.pos = start + 2;
                    self.mode = LexerMode::InlineHtml;
                    self.tok(TokenKind::CloseTag, start)
                } else if self.check_at(1, b'?') {
                    if self.check_at(2, b'=') {
                        self.pos = start + 3;
                        self.tok(TokenKind::CoalesceEquals, start)
                    } else {
                        self.pos = start + 2;
                        self.tok(TokenKind::QuestionQuestion, start)
                    }
                } else if self.check_at(1, b'-') && self.check_at(2, b'>') {
                    self.pos = start + 3;
                    self.tok(TokenKind::NullsafeArrow, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Question, start)
                }
            }
            b':' => {
                if self.check_at(1, b':') {
                    self.pos = start + 2;
                    self.tok(TokenKind::DoubleColon, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Colon, start)
                }
            }
            b'@' => {
                self.pos = start + 1;
                self.tok(TokenKind::At, start)
            }
            b'\\' => {
                self.pos = start + 1;
                self.tok(TokenKind::Backslash, start)
            }
            b'#' => {
                // # comments are handled by skip_whitespace_and_comments.
                // If we get here with #, it must be #[
                if self.check_at(1, b'[') {
                    self.pos = start + 2;
                    self.tok(TokenKind::HashBracket, start)
                } else {
                    // Shouldn't normally happen, but skip and retry
                    self.pos = start + 1;
                    self.read_next_token()
                }
            }

            // --- Delimiters ---
            b'(' => {
                self.pos = start + 1;
                self.tok(TokenKind::LeftParen, start)
            }
            b')' => {
                self.pos = start + 1;
                self.tok(TokenKind::RightParen, start)
            }
            b'[' => {
                self.pos = start + 1;
                self.tok(TokenKind::LeftBracket, start)
            }
            b']' => {
                self.pos = start + 1;
                self.tok(TokenKind::RightBracket, start)
            }
            b'{' => {
                self.pos = start + 1;
                self.tok(TokenKind::LeftBrace, start)
            }
            b'}' => {
                self.pos = start + 1;
                self.tok(TokenKind::RightBrace, start)
            }
            b';' => {
                self.pos = start + 1;
                self.tok(TokenKind::Semicolon, start)
            }
            b',' => {
                self.pos = start + 1;
                self.tok(TokenKind::Comma, start)
            }

            // --- Strings ---
            b'\'' => self.scan_single_quoted_string(),
            b'"' => self.scan_double_quoted_string(),
            b'`' => self.scan_backtick_string(),

            // --- Variables ---
            b'$' => {
                if start + 1 < bytes.len() && is_ident_start(bytes[start + 1]) {
                    self.pos = start + 2;
                    while self.pos < bytes.len() && is_ident_continue(bytes[self.pos]) {
                        self.pos += 1;
                    }
                    self.tok(TokenKind::Variable, start)
                } else {
                    self.pos = start + 1;
                    self.tok(TokenKind::Dollar, start)
                }
            }

            // --- Numbers ---
            b'0'..=b'9' => self.scan_number(),

            // --- Identifiers and keywords ---
            _ if is_ident_start(b) => {
                // Check for binary-prefixed strings and heredocs
                if b == b'b' || b == b'B' {
                    if self.check_at(1, b'\'') {
                        return self.scan_single_quoted_string();
                    }
                    if self.check_at(1, b'"') {
                        return self.scan_double_quoted_string();
                    }
                    if self.check_at(1, b'<') && self.check_at(2, b'<') && self.check_at(3, b'<') {
                        let remaining = &self.source[self.pos..];
                        if let Some(token) = self.try_lex_heredoc(remaining) {
                            return token;
                        }
                    }
                }
                self.scan_identifier()
            }

            // Unknown byte - skip and retry
            _ => {
                self.pos = start + 1;
                self.read_next_token()
            }
        }
    }

    /// Handle the `<` family of tokens, including heredoc.
    fn scan_less_than(&mut self, start: usize) -> Token {
        if self.check_at(1, b'<') {
            if self.check_at(2, b'<') {
                // <<< - try heredoc
                let remaining = &self.source[self.pos..];
                if let Some(token) = self.try_lex_heredoc(remaining) {
                    return token;
                }
                // Not heredoc, fall through to <<
            }
            if self.check_at(2, b'=') {
                self.pos = start + 3;
                return self.tok(TokenKind::ShiftLeftEquals, start);
            }
            self.pos = start + 2;
            return self.tok(TokenKind::ShiftLeft, start);
        }
        if self.check_at(1, b'=') {
            if self.check_at(2, b'>') {
                self.pos = start + 3;
                return self.tok(TokenKind::Spaceship, start);
            }
            self.pos = start + 2;
            return self.tok(TokenKind::LessThanEquals, start);
        }
        if self.check_at(1, b'?') {
            if self.source[self.pos..].starts_with("<?php") {
                self.pos = start + 5;
                return self.tok(TokenKind::OpenTag, start);
            }
            if self.source[self.pos..].starts_with("<?=") {
                self.pos = start + 3;
                return self.tok(TokenKind::OpenTag, start);
            }
        }
        self.pos = start + 1;
        self.tok(TokenKind::LessThan, start)
    }

    // --- String scanning ---

    fn scan_single_quoted_string(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();
        let mut p = self.pos;
        // Skip optional binary prefix
        if bytes[p] == b'b' || bytes[p] == b'B' {
            p += 1;
        }
        p += 1; // skip opening '
        loop {
            if p >= bytes.len() {
                // Unclosed string — skip opening quote and retry
                self.pos = start + 1;
                return self.read_next_token();
            }
            match bytes[p] {
                b'\\' => {
                    p += 1;
                    if p < bytes.len() {
                        p += 1;
                    }
                }
                b'\'' => {
                    p += 1;
                    break;
                }
                _ => p += 1,
            }
        }
        self.pos = p;
        self.tok(TokenKind::SingleQuotedString, start)
    }

    fn scan_double_quoted_string(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();
        let mut p = self.pos;
        // Skip optional binary prefix
        if bytes[p] == b'b' || bytes[p] == b'B' {
            p += 1;
        }
        p += 1; // skip opening "
        loop {
            if p >= bytes.len() {
                // Unclosed string — skip just the opening quote and retry
                // (matches logos behavior: unclosed string callback returns false → skip byte)
                self.pos = start + 1;
                return self.read_next_token();
            }
            match bytes[p] {
                b'\\' => {
                    p += 1;
                    if p < bytes.len() {
                        p += 1;
                    }
                }
                b'"' => {
                    p += 1;
                    break;
                }
                _ => p += 1,
            }
        }
        self.pos = p;
        self.tok(TokenKind::DoubleQuotedString, start)
    }

    fn scan_backtick_string(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();
        let mut p = self.pos;
        p += 1; // skip opening `
        loop {
            if p >= bytes.len() {
                // Unclosed string — skip opening backtick and retry
                self.pos = start + 1;
                return self.read_next_token();
            }
            match bytes[p] {
                b'\\' => {
                    p += 1;
                    if p < bytes.len() {
                        p += 1;
                    }
                }
                b'`' => {
                    p += 1;
                    break;
                }
                _ => p += 1,
            }
        }
        self.pos = p;
        self.tok(TokenKind::BacktickString, start)
    }

    // --- Number scanning ---

    fn scan_number(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();

        // Check for 0x, 0b, 0o prefixes
        if bytes[start] == b'0' && start + 1 < bytes.len() {
            match bytes[start + 1] {
                b'x' | b'X' => {
                    self.pos = start + 2;
                    if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                        self.consume_invalid_numeric_rest();
                        return self.invalid_numeric(start);
                    }
                    if self.scan_digits(u8::is_ascii_hexdigit) {
                        if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                            self.consume_invalid_numeric_rest();
                            return self.invalid_numeric(start);
                        }
                        return self.tok(TokenKind::HexIntLiteral, start);
                    }
                    // No hex digits after 0x - backtrack to decimal
                    self.pos = start;
                }
                b'b' | b'B' => {
                    self.pos = start + 2;
                    if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                        self.consume_invalid_numeric_rest();
                        return self.invalid_numeric(start);
                    }
                    if self.scan_digits(|b| b == &b'0' || b == &b'1') {
                        if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                            self.consume_invalid_numeric_rest();
                            return self.invalid_numeric(start);
                        }
                        return self.tok(TokenKind::BinIntLiteral, start);
                    }
                    // No binary digits - backtrack
                    self.pos = start;
                }
                b'o' | b'O' => {
                    self.pos = start + 2;
                    if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                        self.consume_invalid_numeric_rest();
                        return self.invalid_numeric(start);
                    }
                    if self.scan_digits(|b| (b'0'..=b'7').contains(b)) {
                        if self.pos < bytes.len() && bytes[self.pos] == b'_' {
                            self.consume_invalid_numeric_rest();
                            return self.invalid_numeric(start);
                        }
                        return self.tok(TokenKind::OctIntLiteralNew, start);
                    }
                    // No octal digits - backtrack
                    self.pos = start;
                }
                _ => {}
            }
        }

        // Scan decimal integer portion: [0-9](_?[0-9])*
        self.pos = start;
        self.scan_digits(u8::is_ascii_digit);
        let integer_end = self.pos;
        let mut kind = TokenKind::IntLiteral;

        // Check for legacy octal: 0[0-7]+, no underscores
        if bytes[start] == b'0' && integer_end > start + 1 {
            let slice = &bytes[start..integer_end];
            if slice.iter().all(|&b| (b'0'..=b'7').contains(&b)) {
                kind = TokenKind::OctIntLiteral;
            }
        }

        // Check for decimal point
        if self.pos < bytes.len() && bytes[self.pos] == b'.' {
            if self.pos + 1 < bytes.len() && bytes[self.pos + 1].is_ascii_digit() {
                // Decimal point followed by digit: 1.5, 0.0, etc.
                self.pos += 1; // consume '.'
                self.scan_digits(u8::is_ascii_digit);
                kind = TokenKind::FloatLiteralSimple;
            } else if self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'_' {
                // Invalid separator after decimal: 1._0
                self.consume_invalid_numeric_rest();
                return self.invalid_numeric(start);
            } else if self.pos + 1 >= bytes.len() || bytes[self.pos + 1] != b'.' {
                // Trailing dot without digit: 0. (not followed by another dot for .. or ...)
                self.pos += 1; // consume '.'
                kind = TokenKind::IntLiteral; // match legacy behavior: "0." parses as int
            }
        }

        // Check for exponent
        if self.pos < bytes.len() && matches!(bytes[self.pos], b'e' | b'E') {
            if self.try_scan_exponent() {
                kind = TokenKind::FloatLiteral;
            } else if self.pos + 1 < bytes.len() && bytes[self.pos + 1] == b'_' {
                // Invalid separator after exponent: 1e_2
                self.consume_invalid_numeric_rest();
                return self.invalid_numeric(start);
            }
        }

        // Check for invalid trailing underscore
        if self.pos < bytes.len() && bytes[self.pos] == b'_' {
            self.consume_invalid_numeric_rest();
            return self.invalid_numeric(start);
        }

        self.tok(kind, start)
    }

    /// Scan digits with optional underscores: digit (_? digit)*
    /// Returns true if at least one digit was consumed.
    fn scan_digits(&mut self, is_valid: fn(&u8) -> bool) -> bool {
        let bytes = self.source.as_bytes();
        if self.pos >= bytes.len() || !is_valid(&bytes[self.pos]) {
            return false;
        }
        self.pos += 1;
        loop {
            if self.pos >= bytes.len() {
                break;
            }
            if is_valid(&bytes[self.pos]) {
                self.pos += 1;
            } else if bytes[self.pos] == b'_'
                && self.pos + 1 < bytes.len()
                && is_valid(&bytes[self.pos + 1])
            {
                self.pos += 2;
            } else {
                break;
            }
        }
        true
    }

    /// Try to scan an exponent part: [eE][+-]?[0-9](_?[0-9])*
    /// Returns true if successful, false (with backtrack) if not.
    fn try_scan_exponent(&mut self) -> bool {
        let bytes = self.source.as_bytes();
        let saved = self.pos;
        self.pos += 1; // consume 'e'/'E'

        // Optional sign
        if self.pos < bytes.len() && matches!(bytes[self.pos], b'+' | b'-') {
            self.pos += 1;
        }

        // Must have at least one digit
        if self.scan_digits(u8::is_ascii_digit) {
            true
        } else {
            self.pos = saved;
            false
        }
    }

    // --- Identifier scanning ---

    fn scan_identifier(&mut self) -> Token {
        let start = self.pos;
        let bytes = self.source.as_bytes();
        self.pos += 1; // consume first ident char
        while self.pos < bytes.len() && is_ident_continue(bytes[self.pos]) {
            self.pos += 1;
        }
        let text = &self.source[start..self.pos];
        let kind = resolve_keyword(text).unwrap_or(TokenKind::Identifier);
        self.tok(kind, start)
    }

    // --- Helpers ---

    #[inline]
    fn check_at(&self, offset: usize, expected: u8) -> bool {
        self.source.as_bytes().get(self.pos + offset) == Some(&expected)
    }

    #[inline]
    fn tok(&self, kind: TokenKind, start: usize) -> Token {
        Token::new(kind, Span::new(start as u32, self.pos as u32))
    }

    fn invalid_numeric(&mut self, start: usize) -> Token {
        let span = Span::new(start as u32, self.pos as u32);
        self.errors.push(LexerError {
            message: "Invalid numeric literal".to_string(),
            span,
        });
        Token::new(TokenKind::InvalidNumericLiteral, span)
    }

    /// Consume characters that form an invalid numeric literal rest (digits, underscores, dots, hex chars, exponent markers).
    fn consume_invalid_numeric_rest(&mut self) {
        let bytes = self.source.as_bytes();
        while self.pos < bytes.len() {
            let b = bytes[self.pos];
            if b.is_ascii_alphanumeric() || b == b'_' || b == b'.' || b == b'+' || b == b'-' {
                // Only consume +/- after e/E
                if (b == b'+' || b == b'-') && self.pos > 0 {
                    let prev = bytes[self.pos - 1];
                    if prev != b'e' && prev != b'E' {
                        break;
                    }
                }
                self.pos += 1;
            } else {
                break;
            }
        }
    }

    /// Try to lex a heredoc/nowdoc starting at the current position.
    /// `remaining` is the source from `self.pos` onward.
    /// Returns Some(Token) if a heredoc/nowdoc was found, None otherwise.
    fn try_lex_heredoc(&mut self, remaining: &str) -> Option<Token> {
        // Skip leading whitespace (and newlines) to find <<< (or b<<<)
        let trimmed = remaining.trim_start_matches(|c: char| {
            c == ' ' || c == '\t' || c == '\n' || c == '\r' || c == '\x0C'
        });
        let ws_len = remaining.len() - trimmed.len();

        // Handle optional binary prefix: b<<< or B<<<
        let (after_prefix, prefix_len) = if (trimmed.starts_with("b<<<")
            || trimmed.starts_with("B<<<"))
            && !trimmed[1..].starts_with("<<<>")
        {
            (&trimmed[1..], 1)
        } else {
            (trimmed, 0)
        };

        if !after_prefix.starts_with("<<<") {
            return None;
        }

        let base_pos = self.pos; // position of start of remaining
        let start = base_pos + ws_len; // position of b<<< or <<<
        let after_arrows = &after_prefix[3..];
        let after_arrows_trimmed = after_arrows.trim_start_matches([' ', '\t']);
        let arrows_offset =
            ws_len + prefix_len + 3 + (after_arrows.len() - after_arrows_trimmed.len());

        // Determine if nowdoc (quoted) or heredoc
        let (label, is_nowdoc, label_line_end);
        if let Some(after_quote) = after_arrows_trimmed.strip_prefix('\'') {
            // Nowdoc: <<<'LABEL'
            let closing = after_quote.find('\'')?;
            label = after_quote[..closing].to_string();
            is_nowdoc = true;
            let after_label = &after_arrows_trimmed[2 + closing..];
            // Find end of line
            let nl = after_label.find('\n').unwrap_or(after_label.len());
            label_line_end = arrows_offset + 2 + closing + nl;
            if label_line_end < remaining.len() {
                // +1 for the newline
            }
        } else {
            // Heredoc: <<<LABEL or <<<"LABEL"
            let s = if let Some(after_dquote) = after_arrows_trimmed.strip_prefix('"') {
                let closing = after_dquote.find('"')?;
                label = after_dquote[..closing].to_string();
                &after_dquote[1 + closing..]
            } else {
                // Bare identifier
                let end = after_arrows_trimmed
                    .find(|c: char| !c.is_ascii_alphanumeric() && c != '_')
                    .unwrap_or(after_arrows_trimmed.len());
                if end == 0 {
                    return None;
                }
                label = after_arrows_trimmed[..end].to_string();
                &after_arrows_trimmed[end..]
            };
            is_nowdoc = false;
            let nl = s.find('\n').unwrap_or(s.len());
            label_line_end = arrows_offset + (after_arrows_trimmed.len() - s.len()) + nl;
        };

        if label.is_empty() {
            return None;
        }

        // Body starts after the first newline
        let body_start_in_remaining = if label_line_end < remaining.len() {
            label_line_end + 1 // skip \n
        } else {
            return None; // no body
        };

        let body = &remaining[body_start_in_remaining..];

        // Find the end marker: label on its own line (optionally indented)
        let mut search_pos = 0;
        let end_marker_pos;
        loop {
            if search_pos >= body.len() {
                return None; // unterminated
            }
            let line_start = search_pos;
            let line_end = body[line_start..]
                .find('\n')
                .map(|p| line_start + p)
                .unwrap_or(body.len());
            let line = &body[line_start..line_end];
            let trimmed_line = line.trim_start_matches([' ', '\t']);

            // Check if this line is just the label (optionally followed by ; or whitespace)
            if trimmed_line == label
                || trimmed_line.starts_with(&label)
                    && trimmed_line[label.len()..]
                        .trim_start_matches(';')
                        .trim()
                        .is_empty()
            {
                end_marker_pos = line_start;
                break;
            }

            search_pos = if line_end < body.len() {
                line_end + 1
            } else {
                body.len()
            };
        }

        // Position after the end marker label (not including ; or newline)
        let end_marker_line = &body[end_marker_pos..];
        let trimmed = end_marker_line.trim_start_matches([' ', '\t']);
        let indent_len = end_marker_line.len() - trimmed.len();
        let token_end_in_remaining =
            body_start_in_remaining + end_marker_pos + indent_len + label.len();
        self.pos = base_pos + token_end_in_remaining;

        let span = Span::new(start as u32, self.pos as u32);

        if is_nowdoc {
            Some(Token::new(TokenKind::Nowdoc, span))
        } else {
            Some(Token::new(TokenKind::Heredoc, span))
        }
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    fn collect_tokens(source: &str) -> Vec<Token> {
        let mut lexer = Lexer::new(source);
        let mut tokens = Vec::new();
        loop {
            let token = lexer.next_token();
            if token.kind == TokenKind::Eof {
                tokens.push(token);
                break;
            }
            tokens.push(token);
        }
        tokens
    }

    fn collect_kinds(source: &str) -> Vec<TokenKind> {
        collect_tokens(source).into_iter().map(|t| t.kind).collect()
    }

    /// Collect token kinds from PHP code (auto-prefixes with <?php)
    fn php_kinds(code: &str) -> Vec<TokenKind> {
        let full = format!("<?php {}", code);
        collect_kinds(&full)
            .into_iter()
            .filter(|k| *k != TokenKind::OpenTag && *k != TokenKind::Eof)
            .collect()
    }

    /// Collect (kind, text) pairs from PHP code
    fn php_tokens(code: &str) -> Vec<(TokenKind, String)> {
        let full = format!("<?php {}", code);
        let mut lexer = Lexer::new(&full);
        let mut result = Vec::new();
        loop {
            let token = lexer.next_token();
            if token.kind == TokenKind::Eof {
                break;
            }
            if token.kind == TokenKind::OpenTag {
                continue;
            }
            let text = lexer.token_text(&token).to_string();
            result.push((token.kind, text));
        }
        result
    }

    #[test]
    fn test_php_only() {
        let tokens = collect_kinds("<?php $x = 42;");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::Variable,
                TokenKind::Equals,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_inline_html_before_php() {
        let tokens = collect_kinds("<html><?php echo 1;");
        assert_eq!(
            tokens,
            vec![
                TokenKind::InlineHtml,
                TokenKind::OpenTag,
                TokenKind::Echo,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_inline_html_after_close_tag() {
        let tokens = collect_kinds("<?php echo 1; ?><html>");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::Echo,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::CloseTag,
                TokenKind::InlineHtml,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_keyword_resolution() {
        let tokens = collect_kinds("<?php if else while for foreach function return");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::If,
                TokenKind::Else,
                TokenKind::While,
                TokenKind::For,
                TokenKind::Foreach,
                TokenKind::Function,
                TokenKind::Return,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_keyword_case_insensitive() {
        let tokens = collect_kinds("<?php IF ELSE TRUE FALSE NULL");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::If,
                TokenKind::Else,
                TokenKind::True,
                TokenKind::False,
                TokenKind::Null,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_peek_doesnt_consume() {
        let mut lexer = Lexer::new("<?php 42");
        let peeked = lexer.peek().clone();
        assert_eq!(peeked.kind, TokenKind::OpenTag);
        let next = lexer.next_token();
        assert_eq!(next.kind, TokenKind::OpenTag);
        let next = lexer.next_token();
        assert_eq!(next.kind, TokenKind::IntLiteral);
    }

    #[test]
    fn test_token_text() {
        let source = "<?php $myVar = 'hello';";
        let mut lexer = Lexer::new(source);
        lexer.next_token(); // <?php
        let var_tok = lexer.next_token();
        assert_eq!(lexer.token_text(&var_tok), "$myVar");
        lexer.next_token(); // =
        let str_tok = lexer.next_token();
        assert_eq!(lexer.token_text(&str_tok), "'hello'");
    }

    #[test]
    fn test_spans_are_correct() {
        let source = "<?php $x";
        let tokens = collect_tokens(source);
        assert_eq!(tokens[0].span, Span::new(0, 5)); // <?php
        assert_eq!(tokens[1].span, Span::new(6, 8)); // $x
    }

    #[test]
    fn test_operators() {
        let tokens = collect_kinds("<?php === !== <=> ?? ++ -- **");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::EqualsEqualsEquals,
                TokenKind::BangEqualsEquals,
                TokenKind::Spaceship,
                TokenKind::QuestionQuestion,
                TokenKind::PlusPlus,
                TokenKind::MinusMinus,
                TokenKind::StarStar,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_string_literals() {
        let tokens = collect_kinds(r#"<?php 'single' "double""#);
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_assignment_operators() {
        let tokens = collect_kinds("<?php += -= *= /= %= **= .= ??=");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::PlusEquals,
                TokenKind::MinusEquals,
                TokenKind::StarEquals,
                TokenKind::SlashEquals,
                TokenKind::PercentEquals,
                TokenKind::StarStarEquals,
                TokenKind::DotEquals,
                TokenKind::CoalesceEquals,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_logical_keywords() {
        let tokens = collect_kinds("<?php and or xor");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::And,
                TokenKind::Or,
                TokenKind::Xor,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_empty_source() {
        let tokens = collect_kinds("");
        assert_eq!(tokens, vec![TokenKind::Eof]);
    }

    #[test]
    fn test_only_inline_html() {
        let tokens = collect_kinds("<html><body>Hello</body></html>");
        assert_eq!(tokens, vec![TokenKind::InlineHtml, TokenKind::Eof]);
    }

    // --- Tests ported from logos-specific token tests ---

    #[test]
    fn test_basic_operators() {
        assert_eq!(
            php_kinds("+ - * / % ** ."),
            vec![
                TokenKind::Plus,
                TokenKind::Minus,
                TokenKind::Star,
                TokenKind::Slash,
                TokenKind::Percent,
                TokenKind::StarStar,
                TokenKind::Dot,
            ]
        );
    }

    #[test]
    fn test_integers() {
        let toks = php_tokens("42 0xFF 0b1010 077");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "42".to_string()));
        assert_eq!(toks[1], (TokenKind::HexIntLiteral, "0xFF".to_string()));
        assert_eq!(toks[2], (TokenKind::BinIntLiteral, "0b1010".to_string()));
        assert_eq!(toks[3], (TokenKind::OctIntLiteral, "077".to_string()));
    }

    #[test]
    fn test_floats() {
        let toks = php_tokens("3.14 1e10 2.5e-3");
        assert_eq!(toks[0], (TokenKind::FloatLiteralSimple, "3.14".to_string()));
        assert_eq!(toks[1], (TokenKind::FloatLiteral, "1e10".to_string()));
        assert_eq!(toks[2], (TokenKind::FloatLiteral, "2.5e-3".to_string()));
    }

    #[test]
    fn test_strings() {
        let kinds = php_kinds(r#"'hello' "world" 'it\'s' "say \"hi\"""#);
        assert_eq!(
            kinds,
            vec![
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
            ]
        );
    }

    #[test]
    fn test_variables() {
        let toks = php_tokens("$x $myVar $_foo");
        assert_eq!(toks[0], (TokenKind::Variable, "$x".to_string()));
        assert_eq!(toks[1], (TokenKind::Variable, "$myVar".to_string()));
        assert_eq!(toks[2], (TokenKind::Variable, "$_foo".to_string()));
    }

    #[test]
    fn test_comments_skipped() {
        let toks = php_tokens("42 // line comment\n43 /* block */ 44 # hash comment\n45");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "42".to_string()));
        assert_eq!(toks[1], (TokenKind::IntLiteral, "43".to_string()));
        assert_eq!(toks[2], (TokenKind::IntLiteral, "44".to_string()));
        assert_eq!(toks[3], (TokenKind::IntLiteral, "45".to_string()));
    }

    #[test]
    fn test_float_leading_dot() {
        let toks = php_tokens(".5 .123e4");
        assert_eq!(
            toks[0],
            (TokenKind::FloatLiteralLeadingDot, ".5".to_string())
        );
        assert_eq!(
            toks[1],
            (TokenKind::FloatLiteralLeadingDot, ".123e4".to_string())
        );
    }

    #[test]
    fn test_new_octal_syntax() {
        let toks = php_tokens("0o77 0O755");
        assert_eq!(toks[0], (TokenKind::OctIntLiteralNew, "0o77".to_string()));
        assert_eq!(toks[1], (TokenKind::OctIntLiteralNew, "0O755".to_string()));
    }

    #[test]
    fn test_numeric_underscores() {
        let toks = php_tokens("1_000 0xFF_FF 0b1010_0101");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "1_000".to_string()));
        assert_eq!(toks[1], (TokenKind::HexIntLiteral, "0xFF_FF".to_string()));
        assert_eq!(
            toks[2],
            (TokenKind::BinIntLiteral, "0b1010_0101".to_string())
        );
    }

    #[test]
    fn test_binary_prefix_strings() {
        let kinds = php_kinds(r#"b'hello' B"world""#);
        assert_eq!(
            kinds,
            vec![TokenKind::SingleQuotedString, TokenKind::DoubleQuotedString,]
        );
    }

    #[test]
    fn test_hash_bracket_not_comment() {
        let kinds = php_kinds("#[Attribute]");
        assert_eq!(
            kinds,
            vec![
                TokenKind::HashBracket,
                TokenKind::Identifier,
                TokenKind::RightBracket,
            ]
        );
    }

    #[test]
    fn test_nullsafe_arrow() {
        let kinds = php_kinds("$x?->y");
        assert_eq!(
            kinds,
            vec![
                TokenKind::Variable,
                TokenKind::NullsafeArrow,
                TokenKind::Identifier,
            ]
        );
    }

    #[test]
    fn test_pipe_arrow() {
        let kinds = php_kinds("$x |> foo(...)");
        assert_eq!(
            kinds,
            vec![
                TokenKind::Variable,
                TokenKind::PipeArrow,
                TokenKind::Identifier,
                TokenKind::LeftParen,
                TokenKind::Ellipsis,
                TokenKind::RightParen,
            ]
        );
    }
}
