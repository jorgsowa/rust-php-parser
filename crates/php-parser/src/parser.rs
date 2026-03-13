use std::borrow::Cow;

use php_ast::*;
use php_lexer::{Lexer, Token, TokenKind};

use crate::diagnostics::ParseError;
use crate::expr;
use crate::stmt;

pub struct Parser<'src> {
    lexer: Lexer<'src>,
    current: Token,
    pub source: &'src str,
    errors: Vec<ParseError>,
    /// Nesting depth (0 = top-level scope)
    pub depth: u32,
}

impl<'src> Parser<'src> {
    pub fn new(source: &'src str) -> Self {
        let mut lexer = Lexer::new(source);
        let current = lexer.next_token();
        // Drain any lexer errors produced during first token read
        let errors = lexer
            .errors
            .drain(..)
            .map(|e| ParseError::Forbidden {
                message: e.message,
                span: e.span,
            })
            .collect();
        Self {
            lexer,
            current,
            source,
            errors,
            depth: 0,
        }
    }

    /// Create a parser starting in PHP mode at `offset` within `source`.
    /// Used for parsing interpolation expressions directly in the original source.
    pub fn new_at(source: &'src str, offset: usize) -> Self {
        let mut lexer = Lexer::new_at(source, offset);
        let current = lexer.next_token();
        // collect any initial lex errors
        let errors = lexer
            .errors
            .drain(..)
            .map(|e| ParseError::Forbidden {
                message: e.message,
                span: e.span,
            })
            .collect::<Vec<_>>();
        Self {
            lexer,
            current,
            source,
            errors,
            depth: 0,
        }
    }

    pub fn source(&self) -> &'src str {
        self.source
    }

    // =========================================================================
    // Token navigation
    // =========================================================================

    /// Get the current token kind without consuming it.
    pub fn current_kind(&self) -> TokenKind {
        self.current.kind
    }

    /// Get the current token's span.
    pub fn current_span(&self) -> Span {
        self.current.span
    }

    /// Get the text of the current token.
    pub fn current_text(&self) -> &'src str {
        &self.source[self.current.span.start as usize..self.current.span.end as usize]
    }

    /// Advance to the next token, returning the consumed token.
    pub fn advance(&mut self) -> Token {
        let prev = std::mem::replace(&mut self.current, self.lexer.next_token());
        // Drain any lexer errors produced during token read
        for e in self.lexer.errors.drain(..) {
            self.errors.push(ParseError::Forbidden {
                message: e.message,
                span: e.span,
            });
        }
        prev
    }

    /// Check if the current token matches the given kind.
    pub fn check(&self, kind: TokenKind) -> bool {
        self.current.kind == kind
    }

    /// If the current token matches `kind`, consume and return it. Otherwise return None.
    pub fn eat(&mut self, kind: TokenKind) -> Option<Token> {
        if self.check(kind) {
            Some(self.advance())
        } else {
            None
        }
    }

    /// Expect the current token to be `kind`. Consume and return it if so,
    /// otherwise push an error and return None.
    pub fn expect(&mut self, kind: TokenKind) -> Option<Token> {
        if self.check(kind) {
            Some(self.advance())
        } else {
            self.error(ParseError::Expected {
                expected: format!("{}", kind),
                found: self.current_kind(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Expect a semicolon or `?>` close tag (which acts as an implicit semicolon in PHP).
    /// Does NOT consume `?>` — it stays in the stream for the main loop to handle.
    pub fn expect_semicolon(&mut self, after: &str) -> Option<Token> {
        if self.check(TokenKind::Semicolon) {
            Some(self.advance())
        } else if self.check(TokenKind::CloseTag) {
            // `?>` acts as implicit semicolon — don't consume it
            None
        } else {
            self.error(ParseError::ExpectedAfter {
                expected: "';'".to_string(),
                after: after.to_string(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Expect `kind` after a context described by `after`.
    /// Produces a more descriptive error than plain `expect`.
    pub fn expect_after(&mut self, kind: TokenKind, after: &str) -> Option<Token> {
        if self.check(kind) {
            Some(self.advance())
        } else {
            self.error(ParseError::ExpectedAfter {
                expected: format!("'{}'", kind),
                after: after.to_string(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Expect a closing delimiter, reporting where the opening was.
    pub fn expect_closing(&mut self, kind: TokenKind, opened_at: Span) -> Option<Token> {
        if self.check(kind) {
            Some(self.advance())
        } else {
            self.error(ParseError::UnclosedDelimiter {
                delimiter: format!("'{}'", kind),
                opened_at,
                span: self.current_span(),
            });
            None
        }
    }

    /// Start a span at the current token position.
    pub fn start_span(&self) -> u32 {
        self.current.span.start
    }

    /// End a span from a start position to the end of the most recently consumed token.
    pub fn end_span(&self, start: u32) -> Span {
        // The "previous token" end is approximated. We use current span start as end
        // since we've already advanced past the last consumed token.
        // A more precise approach would store last token's end, but for now this works.
        Span::new(start, self.current.span.start)
    }

    /// End a span from a start position using an explicit end position.
    pub fn end_span_at(&self, start: u32, end: u32) -> Span {
        Span::new(start, end)
    }

    /// Peek at the next token's kind (one token ahead of current).
    pub fn peek_kind(&mut self) -> Option<TokenKind> {
        Some(self.lexer.peek().kind)
    }

    /// Peek two tokens ahead of current.
    pub fn peek2_kind(&mut self) -> Option<TokenKind> {
        Some(self.lexer.peek2().kind)
    }

    /// Get the text of the peeked token (one token ahead of current).
    pub fn peek_text(&mut self) -> Option<&'src str> {
        let token = self.lexer.peek();
        Some(&self.source[token.span.start as usize..token.span.end as usize])
    }

    // =========================================================================
    // Error handling
    // =========================================================================

    pub fn error(&mut self, err: ParseError) {
        self.errors.push(err);
    }

    pub fn into_errors(self) -> Vec<ParseError> {
        self.errors
    }

    /// Panic-mode error recovery: advance until we hit a likely statement boundary.
    pub fn synchronize(&mut self) {
        loop {
            match self.current_kind() {
                TokenKind::Eof => break,
                TokenKind::Semicolon => {
                    self.advance();
                    break;
                }
                TokenKind::If
                | TokenKind::While
                | TokenKind::Do
                | TokenKind::For
                | TokenKind::Foreach
                | TokenKind::Function
                | TokenKind::Return
                | TokenKind::Echo
                | TokenKind::Break
                | TokenKind::Continue
                | TokenKind::Switch
                | TokenKind::Try
                | TokenKind::Throw
                | TokenKind::Goto
                | TokenKind::Declare
                | TokenKind::Unset
                | TokenKind::Global
                | TokenKind::Class
                | TokenKind::Abstract
                | TokenKind::Final
                | TokenKind::Interface
                | TokenKind::Trait
                | TokenKind::Enum_
                | TokenKind::Namespace
                | TokenKind::Use
                | TokenKind::HaltCompiler
                | TokenKind::HashBracket
                | TokenKind::RightBrace
                | TokenKind::CloseTag
                | TokenKind::InlineHtml
                | TokenKind::OpenTag
                | TokenKind::EndIf
                | TokenKind::EndWhile
                | TokenKind::EndFor
                | TokenKind::EndForeach
                | TokenKind::EndSwitch
                | TokenKind::EndDeclare => break,
                _ => {
                    self.advance();
                }
            }
        }
    }

    // =========================================================================
    // Top-level parsing
    // =========================================================================

    // =========================================================================
    // Helper: check if token is a keyword usable as identifier in member context
    // =========================================================================

    pub fn is_semi_reserved_keyword(&self) -> bool {
        matches!(
            self.current_kind(),
            TokenKind::Class
                | TokenKind::Abstract
                | TokenKind::Final
                | TokenKind::Interface
                | TokenKind::Trait
                | TokenKind::Extends
                | TokenKind::Implements
                | TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Static
                | TokenKind::Const
                | TokenKind::Fn_
                | TokenKind::Match_
                | TokenKind::Namespace
                | TokenKind::Use
                | TokenKind::Readonly
                | TokenKind::Enum_
                | TokenKind::From
                | TokenKind::Self_
                | TokenKind::Parent_
                | TokenKind::New
                | TokenKind::Yield_
                | TokenKind::Throw
                | TokenKind::Try
                | TokenKind::Catch
                | TokenKind::Finally
                | TokenKind::Instanceof
                | TokenKind::Array
                | TokenKind::List
                | TokenKind::Switch
                | TokenKind::Case
                | TokenKind::Default
                | TokenKind::If
                | TokenKind::Else
                | TokenKind::ElseIf
                | TokenKind::While
                | TokenKind::Do
                | TokenKind::For
                | TokenKind::Foreach
                | TokenKind::As
                | TokenKind::Function
                | TokenKind::Return
                | TokenKind::Echo
                | TokenKind::Print
                | TokenKind::Break
                | TokenKind::Continue
                | TokenKind::Goto
                | TokenKind::Declare
                | TokenKind::Unset
                | TokenKind::Global
                | TokenKind::Clone
                | TokenKind::Isset
                | TokenKind::Empty
                | TokenKind::Include
                | TokenKind::IncludeOnce
                | TokenKind::Require
                | TokenKind::RequireOnce
                | TokenKind::Eval
                | TokenKind::Exit
                | TokenKind::Die
                | TokenKind::True
                | TokenKind::False
                | TokenKind::Null
                | TokenKind::And
                | TokenKind::Or
                | TokenKind::Xor
                | TokenKind::MagicClass
                | TokenKind::MagicDir
                | TokenKind::MagicFile
                | TokenKind::MagicFunction
                | TokenKind::MagicLine
                | TokenKind::MagicMethod
                | TokenKind::MagicNamespace
                | TokenKind::MagicTrait
                | TokenKind::MagicProperty
        )
    }

    /// Get the source text slice for a given span.
    pub fn text(&self, span: Span) -> &'src str {
        &self.source[span.start as usize..span.end as usize]
    }

    /// Consume the current token as an identifier string, accepting both
    /// Identifier tokens and semi-reserved keywords.
    pub fn eat_identifier_or_keyword(&mut self) -> Option<(&'src str, Span)> {
        if self.check(TokenKind::Identifier) || self.is_semi_reserved_keyword() {
            let token = self.advance();
            let text = &self.source[token.span.start as usize..token.span.end as usize];
            Some((text, token.span))
        } else {
            None
        }
    }

    // =========================================================================
    // Name parsing
    // =========================================================================

    /// Parse a name: qualified, fully-qualified, relative, or unqualified.
    /// e.g., `Foo`, `Foo\Bar`, `\Foo\Bar`, `namespace\Foo\Bar`
    pub fn parse_name(&mut self) -> Name<'src> {
        let start = self.start_span();

        // Check for fully qualified: \Foo\Bar
        let fully_qualified = self.eat(TokenKind::Backslash).is_some();

        // Check for relative: namespace\Foo
        let relative = !fully_qualified && self.check(TokenKind::Namespace);
        if relative {
            self.advance();
            self.expect(TokenKind::Backslash);
        }

        let mut parts = Vec::with_capacity(1);

        // First part
        if let Some((text, _)) = self.eat_identifier_or_keyword() {
            parts.push(Cow::Borrowed(text));
        } else {
            self.error(ParseError::Expected {
                expected: "identifier".to_string(),
                found: self.current_kind(),
                span: self.current_span(),
            });
            parts.push(Cow::Borrowed("<error>"));
        }

        // Subsequent parts: \Ident
        while self.eat(TokenKind::Backslash).is_some() {
            if let Some((text, _)) = self.eat_identifier_or_keyword() {
                parts.push(Cow::Borrowed(text));
            }
        }

        let span = Span::new(start, self.current_span().start);

        let kind = if fully_qualified {
            NameKind::FullyQualified
        } else if relative {
            NameKind::Relative
        } else if parts.len() > 1 {
            NameKind::Qualified
        } else {
            NameKind::Unqualified
        };

        Name { parts, kind, span }
    }

    // =========================================================================
    // Type hint parsing
    // =========================================================================

    /// Parse a type hint: `?T`, `A|B`, `A&B`, `(A&B)|C` (DNF), or simple type.
    pub fn parse_type_hint(&mut self) -> TypeHint<'src> {
        let start = self.start_span();

        // Nullable: ?Type
        if self.eat(TokenKind::Question).is_some() {
            let inner = self.parse_simple_type();
            let span = Span::new(start, inner.span.end);
            return TypeHint {
                kind: TypeHintKind::Nullable(Box::new(inner)),
                span,
            };
        }

        let first = self.parse_type_element();

        // Union: A|B|C or (A&B)|C (DNF)
        if self.check(TokenKind::Pipe) {
            let mut types = vec![first];
            while self.eat(TokenKind::Pipe).is_some() {
                types.push(self.parse_type_element());
            }
            let span = Span::new(start, types.last().unwrap().span.end);
            return TypeHint {
                kind: TypeHintKind::Union(types),
                span,
            };
        }

        // Intersection: A&B&C (non-parenthesized)
        if self.check(TokenKind::Ampersand) {
            // Only parse as intersection if the next token after & looks like a type
            // (not a variable, which would be a by-ref param)
            let peek = self.peek_kind();
            let looks_like_type = matches!(
                peek,
                Some(
                    TokenKind::Identifier
                        | TokenKind::Backslash
                        | TokenKind::Self_
                        | TokenKind::Parent_
                        | TokenKind::Static
                        | TokenKind::Namespace
                        | TokenKind::Array
                )
            );
            if looks_like_type {
                let mut types = vec![first];
                while self.eat(TokenKind::Ampersand).is_some() {
                    types.push(self.parse_simple_type());
                }
                let span = Span::new(start, types.last().unwrap().span.end);
                return TypeHint {
                    kind: TypeHintKind::Intersection(types),
                    span,
                };
            }
        }

        first
    }

    /// Parse a type element: either a simple type or a parenthesized intersection `(A&B)`.
    fn parse_type_element(&mut self) -> TypeHint<'src> {
        if self.check(TokenKind::LeftParen) {
            let start = self.start_span();
            self.advance(); // consume (
            let mut types = vec![self.parse_simple_type()];
            while self.eat(TokenKind::Ampersand).is_some() {
                types.push(self.parse_simple_type());
            }
            let close = self.expect(TokenKind::RightParen);
            let end = close
                .map(|t| t.span.end)
                .unwrap_or(self.current_span().start);
            let span = Span::new(start, end);
            TypeHint {
                kind: TypeHintKind::Intersection(types),
                span,
            }
        } else {
            self.parse_simple_type()
        }
    }

    /// Parse a simple (non-composite) type: named type from Name or builtin keyword.
    pub fn parse_simple_type(&mut self) -> TypeHint<'src> {
        let start = self.start_span();

        // Handle builtin type names that are contextual keywords (identifiers)
        if self.check(TokenKind::Identifier) {
            let text = self.current_text();
            let is_builtin = text.eq_ignore_ascii_case("int")
                || text.eq_ignore_ascii_case("integer")
                || text.eq_ignore_ascii_case("float")
                || text.eq_ignore_ascii_case("double")
                || text.eq_ignore_ascii_case("string")
                || text.eq_ignore_ascii_case("bool")
                || text.eq_ignore_ascii_case("boolean")
                || text.eq_ignore_ascii_case("void")
                || text.eq_ignore_ascii_case("never")
                || text.eq_ignore_ascii_case("null")
                || text.eq_ignore_ascii_case("mixed")
                || text.eq_ignore_ascii_case("object")
                || text.eq_ignore_ascii_case("iterable")
                || text.eq_ignore_ascii_case("callable")
                || text.eq_ignore_ascii_case("true")
                || text.eq_ignore_ascii_case("false");
            if is_builtin {
                let token = self.advance();
                let name_text =
                    Cow::Borrowed(&self.source[token.span.start as usize..token.span.end as usize]);
                let name = Name {
                    parts: vec![name_text],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                return TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                };
            }
        }

        // Handle keyword-based types
        match self.current_kind() {
            TokenKind::Array => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("array")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::Self_ => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("self")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::Parent_ => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("parent")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::Static => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("static")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::Null => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("null")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::True => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("true")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            TokenKind::False => {
                let token = self.advance();
                let name = Name {
                    parts: vec![Cow::Borrowed("false")],
                    kind: NameKind::Unqualified,
                    span: token.span,
                };
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span: token.span,
                }
            }
            _ => {
                // Named type from qualified/unqualified name
                let name = self.parse_name();
                let span = Span::new(start, name.span.end);
                TypeHint {
                    kind: TypeHintKind::Named(name),
                    span,
                }
            }
        }
    }

    /// Check if the current token could start a type hint.
    pub fn could_be_type_hint(&mut self) -> bool {
        match self.current_kind() {
            TokenKind::Question
            | TokenKind::Backslash
            | TokenKind::Self_
            | TokenKind::Parent_
            | TokenKind::Static
            | TokenKind::Array
            | TokenKind::Null
            | TokenKind::True
            | TokenKind::False
            | TokenKind::LeftParen => true,
            TokenKind::Identifier => true,
            TokenKind::Namespace => {
                // namespace\Foo is a type
                matches!(self.peek_kind(), Some(TokenKind::Backslash))
            }
            _ => false,
        }
    }

    // =========================================================================
    // Attribute parsing
    // =========================================================================

    /// Parse PHP 8 attributes: `#[Attr]`, `#[Attr(args)]`, `#[A, B]`, stacked `#[A] #[B]`
    pub fn parse_attributes(&mut self) -> Vec<Attribute<'src>> {
        let mut attributes = Vec::with_capacity(1);
        while self.check(TokenKind::HashBracket) {
            self.advance(); // consume #[

            // Parse comma-separated attributes within this group
            loop {
                if self.check(TokenKind::RightBracket) {
                    break;
                }

                let attr_start = self.start_span();
                let name = self.parse_name();

                let args = if self.check(TokenKind::LeftParen) {
                    crate::expr::parse_arg_list(self)
                } else {
                    Vec::new()
                };

                let span = Span::new(attr_start, self.current_span().start);
                attributes.push(Attribute { name, args, span });

                if self.eat(TokenKind::Comma).is_none() {
                    break;
                }
            }

            self.expect(TokenKind::RightBracket);
        }
        attributes
    }

    /// Parse `<?= expr ?>` — the short echo tag produces an implicit echo statement.
    pub(crate) fn parse_short_echo(&mut self) -> Option<Stmt<'src>> {
        if self.check(TokenKind::Eof) || self.check(TokenKind::CloseTag) {
            return None;
        }
        let start = self.start_span();
        let expr = expr::parse_expr(self);
        self.expect_semicolon("short echo tag");
        let span = Span::new(start, self.current_span().start);
        Some(Stmt {
            kind: StmtKind::Echo(vec![expr]),
            span,
        })
    }

    // =========================================================================
    // Top-level parsing
    // =========================================================================

    pub fn parse_program(&mut self) -> Program<'src> {
        let start = self.start_span();
        let mut stmts = Vec::with_capacity(16);

        // Handle optional inline HTML before PHP tag
        if self.check(TokenKind::InlineHtml) {
            let token = self.advance();
            let text = &self.source[token.span.start as usize..token.span.end as usize];
            stmts.push(Stmt {
                kind: StmtKind::InlineHtml(text),
                span: token.span,
            });
        }

        // Expect and consume the open tag
        if self.check(TokenKind::OpenTag) {
            let tag = self.advance();
            // <?= produces an implicit echo
            if self.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                if let Some(echo_stmt) = self.parse_short_echo() {
                    stmts.push(echo_stmt);
                }
            }
        } else if self.current_kind() != TokenKind::Eof {
            self.error(ParseError::ExpectedOpenTag {
                span: self.current_span(),
            });
        }

        // Parse statements until EOF
        while !self.check(TokenKind::Eof) {
            // Handle close tag -> inline HTML -> open tag sequences
            if self.check(TokenKind::CloseTag) {
                self.advance();
                if self.check(TokenKind::InlineHtml) {
                    let token = self.advance();
                    let text = &self.source[token.span.start as usize..token.span.end as usize];
                    stmts.push(Stmt {
                        kind: StmtKind::InlineHtml(text),
                        span: token.span,
                    });
                }
                if self.check(TokenKind::OpenTag) {
                    let tag = self.advance();
                    // <?= produces an implicit echo
                    if self.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                        if let Some(echo_stmt) = self.parse_short_echo() {
                            stmts.push(echo_stmt);
                        }
                    }
                }
                continue;
            }

            let span_before = self.current_span();
            let stmt = stmt::parse_stmt(self);
            stmts.push(stmt);
            // Safety: if parsing made no progress, skip the token to avoid infinite loop
            if self.current_span() == span_before {
                self.advance();
            }
        }

        let span = if stmts.is_empty() {
            Span::new(start, self.current.span.end)
        } else {
            Span::new(start, stmts.last().unwrap().span.end)
        };

        Program { stmts, span }
    }
}
