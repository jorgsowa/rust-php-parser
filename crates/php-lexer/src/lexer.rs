use logos::Logos;
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
        if let Some(tag_pos) = self.source[self.pos..].find("<?php").or_else(|| self.source[self.pos..].find("<?=")) {
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

        // Check for heredoc/nowdoc: <<<
        if let Some(token) = self.try_lex_heredoc(remaining) {
            return token;
        }

        // Check for unclosed block comment: /* without closing */
        // Logos skip pattern only matches closed comments, so we handle this here.
        if remaining.starts_with("/*") {
            // Check if there's a closing */
            if remaining[2..].find("*/").is_none() {
                // Unclosed comment — consume rest of file as comment (matches PHP behavior)
                self.pos = self.source.len();
                return Token::eof(self.source.len() as u32);
            }
        }

        let mut inner = TokenKind::lexer(remaining);

        match inner.next() {
            Some(Ok(kind)) => {
                let logos_span = inner.span();
                let start = self.pos + logos_span.start;
                let end = self.pos + logos_span.end;

                // Check if << is actually the start of <<<HEREDOC (Logos skips comments
                // before it, so try_lex_heredoc at the top of lex_php may have missed it)
                if kind == TokenKind::ShiftLeft && self.source.as_bytes().get(end) == Some(&b'<') {
                    let heredoc_remaining = &self.source[start..];
                    self.pos = start;
                    if let Some(token) = self.try_lex_heredoc(heredoc_remaining) {
                        return token;
                    }
                }

                self.pos = end;

                // Detect invalid numeric separator: a numeric token followed by `_`
                let is_numeric = matches!(
                    kind,
                    TokenKind::IntLiteral
                        | TokenKind::HexIntLiteral
                        | TokenKind::BinIntLiteral
                        | TokenKind::OctIntLiteral
                        | TokenKind::OctIntLiteralNew
                        | TokenKind::FloatLiteral
                        | TokenKind::FloatLiteralSimple
                        | TokenKind::FloatLiteralLeadingDot
                );
                if is_numeric {
                    if let Some(invalid_token) = self.try_consume_invalid_numeric(start) {
                        return invalid_token;
                    }
                }

                // Also handle: `0` followed by `x/X/b/B/o/O` then `_` (e.g. `0x_1`)
                if kind == TokenKind::IntLiteral && (end - start) == 1 && self.source.as_bytes()[start] == b'0' {
                    let bytes = self.source.as_bytes();
                    if let Some(&next_byte) = bytes.get(end) {
                        if matches!(next_byte, b'x' | b'X' | b'b' | b'B' | b'o' | b'O') {
                            if bytes.get(end + 1) == Some(&b'_') {
                                // Consume the prefix char + invalid rest
                                self.pos = end + 1; // past the x/b/o
                                self.consume_invalid_numeric_rest();
                                let final_end = self.pos;
                                let span = Span::new(start as u32, final_end as u32);
                                self.errors.push(LexerError {
                                    message: "Invalid numeric literal".to_string(),
                                    span,
                                });
                                return Token::new(TokenKind::InvalidNumericLiteral, span);
                            }
                        }
                    }
                }

                let span = Span::new(start as u32, end as u32);

                match kind {
                    TokenKind::CloseTag => {
                        self.mode = LexerMode::InlineHtml;
                        Token::new(TokenKind::CloseTag, span)
                    }
                    TokenKind::Identifier => {
                        let text = &self.source[start..end];
                        let resolved = resolve_keyword(text).unwrap_or(TokenKind::Identifier);
                        Token::new(resolved, span)
                    }
                    _ => Token::new(kind, span),
                }
            }
            Some(Err(())) => {
                // Skip one byte and try again on unrecognized input
                self.pos += 1;
                self.read_next_token()
            }
            None => {
                Token::eof(self.source.len() as u32)
            }
        }
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

    /// Check if the current position starts an invalid numeric literal (next byte is `_` after a numeric token).
    /// If so, greedily consume the invalid literal and return the token.
    fn try_consume_invalid_numeric(&mut self, start: usize) -> Option<Token> {
        let bytes = self.source.as_bytes();
        if bytes.get(self.pos) == Some(&b'_') {
            self.consume_invalid_numeric_rest();
            let final_end = self.pos;
            let span = Span::new(start as u32, final_end as u32);
            self.errors.push(LexerError {
                message: "Invalid numeric literal".to_string(),
                span,
            });
            Some(Token::new(TokenKind::InvalidNumericLiteral, span))
        } else {
            None
        }
    }

    /// Try to lex a heredoc/nowdoc starting at the current position.
    /// `remaining` is the source from `self.pos` onward.
    /// Returns Some(Token) if a heredoc/nowdoc was found, None otherwise.
    fn try_lex_heredoc(&mut self, remaining: &str) -> Option<Token> {
        // Skip leading whitespace (and newlines) to find <<< (or b<<<)
        let trimmed = remaining.trim_start_matches(|c: char| c == ' ' || c == '\t' || c == '\n' || c == '\r' || c == '\x0C');
        let ws_len = remaining.len() - trimmed.len();

        // Handle optional binary prefix: b<<< or B<<<
        let (after_prefix, prefix_len) = if (trimmed.starts_with("b<<<") || trimmed.starts_with("B<<<")) && !trimmed[1..].starts_with("<<<>") {
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
        let after_arrows_trimmed = after_arrows.trim_start_matches(|c: char| c == ' ' || c == '\t');
        let arrows_offset = ws_len + prefix_len + 3 + (after_arrows.len() - after_arrows_trimmed.len());

        // Determine if nowdoc (quoted) or heredoc
        let (label, is_nowdoc, label_line_end);
        if after_arrows_trimmed.starts_with('\'') {
            // Nowdoc: <<<'LABEL'
            let closing = after_arrows_trimmed[1..].find('\'')?;
            label = after_arrows_trimmed[1..1 + closing].to_string();
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
            let s = if after_arrows_trimmed.starts_with('"') {
                let closing = after_arrows_trimmed[1..].find('"')?;
                label = after_arrows_trimmed[1..1 + closing].to_string();
                &after_arrows_trimmed[2 + closing..]
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
            let line_end = body[line_start..].find('\n').map(|p| line_start + p).unwrap_or(body.len());
            let line = &body[line_start..line_end];
            let trimmed_line = line.trim_start_matches(|c: char| c == ' ' || c == '\t');

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

            search_pos = if line_end < body.len() { line_end + 1 } else { body.len() };
        }

        // Position after the end marker label (not including ; or newline)
        let end_marker_line = &body[end_marker_pos..];
        let trimmed = end_marker_line.trim_start_matches(|c: char| c == ' ' || c == '\t');
        let indent_len = end_marker_line.len() - trimmed.len();
        let token_end_in_remaining = body_start_in_remaining + end_marker_pos + indent_len + label.len();
        self.pos = base_pos + token_end_in_remaining;

        let span = Span::new(start as u32, self.pos as u32);

        // Store the content in the token. The parser will extract it from the source span.
        // We encode: the source span covers <<<LABEL\ncontent\nLABEL
        // The parser needs to know the label and content, which it can reconstruct.

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
}
