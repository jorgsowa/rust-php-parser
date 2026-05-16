use php_ast::*;
use php_lexer::{Lexer, LexerError, LexerErrorKind, Token, TokenKind};

use crate::diagnostics::ParseError;
use crate::expr;
use crate::instrument;
use crate::stmt;
use crate::version::PhpVersion;

const MAX_ERRORS: usize = 100;
pub(crate) const MAX_DEPTH: u32 = 50;

fn comment_kind(kind: TokenKind) -> CommentKind {
    match kind {
        TokenKind::LineComment => CommentKind::Line,
        TokenKind::HashComment => CommentKind::Hash,
        TokenKind::BlockComment => CommentKind::Block,
        TokenKind::DocComment => CommentKind::Doc,
        _ => unreachable!(
            "is_comment() returned true for non-comment token {:?}",
            kind
        ),
    }
}

fn lex_error_to_parse_error(e: LexerError) -> ParseError {
    if e.kind == LexerErrorKind::UnterminatedString {
        ParseError::UnterminatedString { span: e.span }
    } else {
        ParseError::Forbidden {
            message: e.message.into(),
            span: e.span,
        }
    }
}

pub struct Parser<'arena, 'src> {
    current: Token,
    /// End offset of the most recently consumed token.
    /// Updated on every `advance()`, used for precise span construction.
    previous_end: u32,
    /// Block nesting depth (0 = top-level scope)
    pub depth: u32,
    /// Expression nesting depth — guards against stack overflow on deeply nested input
    pub(crate) expr_depth: u32,
    /// Loop/switch nesting depth — tracks valid break/continue targets.
    /// Resets to 0 when crossing a function/method/closure boundary.
    pub(crate) loop_depth: u32,
    /// Function/method/closure nesting depth — tracks valid yield context.
    /// Incremented when entering a function/method/closure, decremented when exiting.
    pub(crate) function_depth: u32,
    /// True only when parsing the parameter list of a `__construct` method.
    /// Used to reject `readonly` parameters outside constructors.
    pub(crate) in_constructor: bool,
    tokens: Vec<Token>,
    /// Index of NEXT token in the tokens array (current = tokens[pos - 1])
    pos: usize,
    pub arena: &'arena bumpalo::Bump,
    pub source: &'src str,
    errors: Vec<ParseError>,
    /// All comments found in the source, collected during lexing.
    comments: Vec<Comment<'src>>,
    /// PHP version being targeted — used for version-specific error reporting.
    pub version: PhpVersion,
    /// When true, the `{` curly-brace subscript operator is suppressed in the Pratt loop.
    /// Used when parsing property/parameter default values so that a following hook block
    /// `{ get => ...; }` is not consumed as part of the default expression.
    pub(crate) no_brace_subscript: bool,
    /// Position after the most recent `}` at this or outer scope depth.
    /// Prevents doc comments inside closed scopes from leaking to outer statements.
    last_scope_close: u32,
}

impl<'arena, 'src> Parser<'arena, 'src> {
    /// Create a parser targeting the latest supported PHP version (8.5).
    pub fn new(arena: &'arena bumpalo::Bump, source: &'src str) -> Self {
        Self::with_version(arena, source, PhpVersion::default())
    }

    /// Create a parser targeting a specific PHP version.
    pub fn with_version(
        arena: &'arena bumpalo::Bump,
        source: &'src str,
        version: PhpVersion,
    ) -> Self {
        let (all_tokens, lex_errors) = php_lexer::lex_all(source);

        // Separate comment tokens from the main token stream.
        // lex_all appends two Eof sentinels; they pass through the filter unchanged.
        let mut comments: Vec<Comment<'src>> = Vec::new();
        let mut tokens: Vec<Token> = Vec::with_capacity(all_tokens.len());
        for tok in all_tokens {
            if tok.kind.is_comment() {
                let text = &source[tok.span.start as usize..tok.span.end as usize];
                comments.push(Comment {
                    kind: comment_kind(tok.kind),
                    text,
                    span: tok.span,
                });
            } else {
                tokens.push(tok);
            }
        }

        // Seed current with the first token and pos with 1
        let current = tokens.first().copied().unwrap_or_else(|| Token::eof(0));

        let mut errors: Vec<ParseError> = lex_errors
            .into_iter()
            .map(lex_error_to_parse_error)
            .collect();
        errors.truncate(MAX_ERRORS);

        Self {
            arena,
            tokens,
            pos: 1,
            current,
            previous_end: current.span.start,
            source,
            errors,
            comments,
            depth: 0,
            expr_depth: 0,
            loop_depth: 0,
            function_depth: 0,
            in_constructor: false,
            version,
            no_brace_subscript: false,
            last_scope_close: 0,
        }
    }

    /// Create a parser starting in PHP mode at `offset` within `source`.
    /// Used for parsing interpolation expressions directly in the original source.
    ///
    /// This path creates a lazy Lexer at the offset, then pre-lexes all tokens into
    /// a vector to match the new pre-lexed architecture, while preserving correct
    /// absolute spans relative to the original source.
    pub fn new_at(
        arena: &'arena bumpalo::Bump,
        source: &'src str,
        offset: usize,
        version: PhpVersion,
    ) -> Self {
        let mut lexer = Lexer::new_at(source, offset);

        // Lex all tokens from this position, separating comments from regular tokens
        let mut tokens = Vec::new();
        let mut comments: Vec<Comment<'src>> = Vec::new();

        loop {
            let tok = lexer.next_token();
            let is_eof = tok.kind == TokenKind::Eof;
            if tok.kind.is_comment() {
                let text = &source[tok.span.start as usize..tok.span.end as usize];
                comments.push(Comment {
                    kind: comment_kind(tok.kind),
                    text,
                    span: tok.span,
                });
            } else {
                tokens.push(tok);
            }
            if is_eof {
                break;
            }
        }

        // Add a second Eof sentinel for safe peek2
        // The Eof token from the lexer is always added to tokens before the loop exits
        let eof_span = tokens
            .last()
            .expect("tokens guaranteed to contain at least the Eof token from lexer")
            .span;
        tokens.push(Token::new(TokenKind::Eof, eof_span));

        let mut errors: Vec<ParseError> = lexer
            .errors
            .into_iter()
            .map(lex_error_to_parse_error)
            .collect();
        errors.truncate(MAX_ERRORS);

        // Seed current with the first token
        let current = tokens
            .first()
            .copied()
            .unwrap_or_else(|| Token::eof(offset as u32));

        Self {
            arena,
            tokens,
            pos: 1,
            current,
            previous_end: current.span.start,
            source,
            errors,
            comments,
            depth: 0,
            expr_depth: 0,
            loop_depth: 0,
            function_depth: 0,
            in_constructor: false,
            version,
            no_brace_subscript: false,
            last_scope_close: 0,
        }
    }

    /// Emit a `VersionTooLow` error if the targeted PHP version is less than `min`.
    /// Parsing always continues — the error is non-fatal.
    pub fn require_version(&mut self, min: PhpVersion, feature: &'static str, span: Span) {
        if self.version < min {
            self.error(ParseError::VersionTooLow {
                feature: feature.into(),
                required: min.to_string().into(),
                used: self.version.to_string().into(),
                span,
            });
        }
    }

    pub fn source(&self) -> &'src str {
        self.source
    }

    // =========================================================================
    // Arena helpers
    // =========================================================================

    #[inline]
    pub fn alloc<T>(&self, val: T) -> &'arena T {
        self.arena.alloc(val)
    }
    #[inline]
    pub fn alloc_vec<T>(&self) -> ArenaVec<'arena, T> {
        ArenaVec::new_in(self.arena)
    }
    #[inline]
    pub fn alloc_vec_with_capacity<T>(&self, cap: usize) -> ArenaVec<'arena, T> {
        ArenaVec::with_capacity_in(cap, self.arena)
    }
    #[inline]
    pub fn alloc_vec_one<T>(&self, val: T) -> ArenaVec<'arena, T> {
        let mut v = ArenaVec::with_capacity_in(1, self.arena);
        v.push(val);
        v
    }

    // =========================================================================
    // Token navigation
    // =========================================================================

    /// Get the current token kind without consuming it.
    #[inline]
    pub fn current_kind(&self) -> TokenKind {
        self.current.kind
    }

    /// Get the current token's span.
    #[inline]
    pub fn current_span(&self) -> Span {
        self.current.span
    }

    /// Get the text of the current token.
    #[inline]
    pub fn current_text(&self) -> &'src str {
        &self.source[self.current.span.start as usize..self.current.span.end as usize]
    }

    /// Advance to the next token, returning the consumed token.
    #[inline]
    pub fn advance(&mut self) -> Token {
        let prev = self.current;
        self.previous_end = prev.span.end;
        if prev.kind == TokenKind::RightBrace {
            self.last_scope_close = prev.span.end;
        }
        self.current = self.tokens[self.pos];
        self.pos += 1;
        prev
    }

    /// End offset of the most recently consumed token.
    /// Use this instead of `current_span().start` for precise span ends.
    #[inline]
    pub fn previous_end(&self) -> u32 {
        self.previous_end
    }

    /// Strip the `$` prefix from a Variable token and return the bare name.
    ///
    /// For all tokens produced by the lexer `span.end >= span.start + 2` is an
    /// invariant, so the guard is always eliminated by the optimiser in release
    /// builds.  It exists solely to prevent a backwards-range panic if a
    /// zero-length error-recovery token is ever introduced.
    #[inline]
    pub fn variable_name(&self, token: Token) -> &'src str {
        let start = token.span.start as usize;
        let end = token.span.end as usize;
        if start + 1 < end {
            &self.source[start + 1..end]
        } else {
            ""
        }
    }

    /// Like [`variable_name`] but returns an [`Ident`] — empty/zero-length
    /// inputs yield [`Ident::ERROR`].
    #[inline]
    pub fn variable_ident(&self, token: Token) -> Ident<'src> {
        let s = self.variable_name(token);
        if s.is_empty() {
            Ident::ERROR
        } else {
            Ident::name(s)
        }
    }

    /// Check if the current token matches the given kind.
    #[inline]
    pub fn check(&self, kind: TokenKind) -> bool {
        self.current.kind == kind
    }

    /// If the current token matches `kind`, consume and return it. Otherwise return None.
    #[inline]
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
                expected: format!("{}", kind).into(),
                found: self.current_kind(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Expect a semicolon or `?>` close tag (which acts as an implicit semicolon in PHP).
    /// Does NOT consume `?>` — it stays in the stream for the main loop to handle.
    /// `after` feeds the diagnostic label; pass a `TokenKind` when the preceding
    /// construct is a single keyword (e.g. `TokenKind::EndForeach`) or a string
    /// literal for multi-word contexts (e.g. `"echo statement"`).
    pub fn expect_semicolon(&mut self, after: impl std::fmt::Display) -> Option<Token> {
        if self.check(TokenKind::Semicolon) {
            Some(self.advance())
        } else if self.check(TokenKind::CloseTag) {
            // `?>` acts as implicit semicolon — don't consume it
            None
        } else {
            self.error(ParseError::ExpectedAfter {
                expected: "';'".into(),
                after: format!("{}", after).into(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Run `f` with `no_brace_subscript` temporarily set to `true`, then restore
    /// the previous value. Used to parse property/parameter default expressions
    /// without consuming a following `{ get => ...; }` hook block as subscript.
    pub(crate) fn with_no_brace_subscript<R>(&mut self, f: impl FnOnce(&mut Self) -> R) -> R {
        let prev = self.no_brace_subscript;
        self.no_brace_subscript = true;
        let result = f(self);
        self.no_brace_subscript = prev;
        result
    }

    /// Expect a closing delimiter, reporting where the opening was.
    pub fn expect_closing(&mut self, kind: TokenKind, opened_at: Span) -> Option<Token> {
        if self.check(kind) {
            Some(self.advance())
        } else {
            self.error(ParseError::UnclosedDelimiter {
                delimiter: format!("'{}'", kind).into(),
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

    /// Peek at the next token's kind (one token ahead of current).
    /// No branches: tokens array guaranteed to have Eof sentinels.
    #[inline]
    pub fn peek_kind(&mut self) -> Option<TokenKind> {
        Some(self.tokens[self.pos].kind)
    }

    /// Peek two tokens ahead of current.
    /// No branches: tokens array guaranteed to have dual Eof sentinels.
    #[inline]
    pub fn peek2_kind(&mut self) -> Option<TokenKind> {
        Some(self.tokens[self.pos + 1].kind)
    }

    /// Get the text of the peeked token (one token ahead of current).
    #[inline]
    pub fn peek_text(&mut self) -> Option<&'src str> {
        let token = &self.tokens[self.pos];
        Some(&self.source[token.span.start as usize..token.span.end as usize])
    }

    /// Get the text of the token two tokens ahead of current.
    #[inline]
    pub fn peek2_text(&mut self) -> Option<&'src str> {
        let token = &self.tokens[self.pos + 1];
        Some(&self.source[token.span.start as usize..token.span.end as usize])
    }

    // =========================================================================
    // Error handling
    // =========================================================================

    pub fn error(&mut self, err: ParseError) {
        if self.errors.len() < MAX_ERRORS {
            self.errors.push(err);
        }
    }

    pub fn errors_truncated(&self) -> bool {
        self.errors.len() >= MAX_ERRORS
    }

    pub fn errors_mut(&mut self) -> &mut Vec<ParseError> {
        &mut self.errors
    }

    pub fn into_errors(self) -> Vec<ParseError> {
        self.errors
    }

    pub fn take_comments(&mut self) -> Vec<Comment<'src>> {
        std::mem::take(&mut self.comments)
    }

    /// Take the last doc comment (`/** ... */`) that appears before `pos`.
    /// The comment is removed from the comments list so it won't be taken again.
    /// Only returns comments that appeared after the last scope close (closing `}`),
    /// preventing doc comments inside closed scopes from leaking to outer statements.
    pub fn take_doc_comment(&mut self, before: u32) -> Option<Comment<'src>> {
        // Search backwards for the last Doc comment before `before`
        // that also appeared AFTER the last scope close (closing `}`)
        let idx = self.comments.iter().rposition(|c| {
            c.kind == CommentKind::Doc
                && c.span.end <= before
                && c.span.start >= self.last_scope_close
        })?;
        Some(self.comments.remove(idx))
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

    /// Recover to the next class-body anchor token.
    /// Used when a class/interface/trait member fails to parse.
    pub fn synchronize_class_body(&mut self) {
        loop {
            match self.current_kind() {
                TokenKind::Eof
                | TokenKind::RightBrace
                | TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Static
                | TokenKind::Abstract
                | TokenKind::Final
                | TokenKind::Readonly
                | TokenKind::Function
                | TokenKind::Const
                | TokenKind::HashBracket => break,
                TokenKind::Semicolon => {
                    self.advance();
                    break;
                }
                _ => {
                    self.advance();
                }
            }
        }
    }

    /// Recover to the next enum-body anchor token.
    /// Used when an enum member fails to parse.
    pub fn synchronize_enum_body(&mut self) {
        loop {
            match self.current_kind() {
                TokenKind::Eof
                | TokenKind::RightBrace
                | TokenKind::Case
                | TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Static
                | TokenKind::Abstract
                | TokenKind::Final
                | TokenKind::Readonly
                | TokenKind::Function
                | TokenKind::Const
                | TokenKind::Use
                | TokenKind::HashBracket => break,
                TokenKind::Semicolon => {
                    self.advance();
                    break;
                }
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
                | TokenKind::EndDeclare
                | TokenKind::EndFor
                | TokenKind::EndForeach
                | TokenKind::EndIf
                | TokenKind::EndSwitch
                | TokenKind::EndWhile
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
    pub fn parse_name(&mut self) -> Name<'arena, 'src> {
        let start = self.start_span();

        // Check for fully qualified: \Foo\Bar
        let fully_qualified = self.eat(TokenKind::Backslash).is_some();

        // Check for relative: namespace\Foo
        let relative = !fully_qualified && self.check(TokenKind::Namespace);
        if relative {
            self.advance();
            self.expect(TokenKind::Backslash);
        }

        // First part
        let (first, first_span): (&'src str, Span) =
            if let Some((text, span)) = self.eat_identifier_or_keyword() {
                (text, span)
            } else {
                let err_span = self.current_span();
                self.error(ParseError::Expected {
                    expected: "identifier".into(),
                    found: self.current_kind(),
                    span: err_span,
                });
                let span = Span::new(start, err_span.end);
                return Name::Error { span };
            };

        // Fast path: single unqualified identifier (the common case, ~95% of names).
        // Avoids allocating an ArenaVec entirely.
        if !fully_qualified && !relative && !self.check(TokenKind::Backslash) {
            let span = Span::new(start, first_span.end);
            return Name::Simple { value: first, span };
        }

        // Slow path: qualified, fully-qualified, or relative name.
        let mut parts = self.alloc_vec_with_capacity(2);
        parts.push(first);

        // Subsequent parts: \Ident
        let mut last_end = first_span.end;
        while self.eat(TokenKind::Backslash).is_some() {
            if let Some((text, span)) = self.eat_identifier_or_keyword() {
                parts.push(text);
                last_end = span.end;
            }
        }

        let span = Span::new(start, last_end);

        let kind = if fully_qualified {
            NameKind::FullyQualified
        } else if relative {
            NameKind::Relative
        } else {
            NameKind::Qualified
        };

        Name::Complex { parts, kind, span }
    }

    // =========================================================================
    // Type hint parsing
    // =========================================================================

    /// Parse a type hint: `?T`, `A|B`, `A&B`, `(A&B)|C` (DNF), or simple type.
    pub fn parse_type_hint(&mut self) -> TypeHint<'arena, 'src> {
        let start = self.start_span();

        // Nullable: ?Type
        if self.eat(TokenKind::Question).is_some() {
            let inner = self.parse_simple_type();
            let span = Span::new(start, inner.span.end);
            // Validate that mixed is not used with nullable
            if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &inner.kind {
                self.error(ParseError::Forbidden {
                    message: "mixed cannot be used with nullable type".into(),
                    span: inner.span,
                });
            }
            return TypeHint {
                kind: TypeHintKind::Nullable(self.alloc(inner)),
                span,
            };
        }

        let first = self.parse_type_element();

        // Union: A|B|C or (A&B)|C (DNF)
        if self.check(TokenKind::Pipe) {
            self.require_version(PhpVersion::Php80, "union types", self.current_span());
            let mut end = first.span.end;
            let mut types = self.alloc_vec_one(first);
            while self.eat(TokenKind::Pipe).is_some() {
                let t = self.parse_type_element();
                end = t.span.end;
                types.push(t);
            }
            let span = Span::new(start, end);
            let has_true = types
                .iter()
                .any(|t| matches!(t.kind, TypeHintKind::Keyword(BuiltinType::True, _)));
            let has_false = types
                .iter()
                .any(|t| matches!(t.kind, TypeHintKind::Keyword(BuiltinType::False, _)));
            if has_true && has_false {
                self.error(ParseError::Forbidden {
                    message: "Type contains both true and false, bool must be used instead".into(),
                    span,
                });
            }
            // void, never, and mixed cannot appear in union types
            for ty in types.iter() {
                if let TypeHintKind::Keyword(builtin, _) = &ty.kind {
                    let msg = match builtin {
                        BuiltinType::Void => Some("void cannot be used as part of a union type"),
                        BuiltinType::Never => Some("never cannot be used as part of a union type"),
                        BuiltinType::Mixed => Some("mixed cannot be used as part of a union type"),
                        _ => None,
                    };
                    if let Some(msg) = msg {
                        self.error(ParseError::Forbidden {
                            message: msg.into(),
                            span: ty.span,
                        });
                    }
                }
            }
            // Check for duplicate types in union
            let mut seen_types: std::collections::HashSet<String> =
                std::collections::HashSet::new();
            for ty in types.iter() {
                if let Some(type_str) = self.type_hint_to_string(ty) {
                    if !seen_types.insert(type_str.clone()) {
                        self.error(ParseError::Forbidden {
                            message: format!("Duplicate type '{}' in union type", type_str).into(),
                            span: ty.span,
                        });
                    }
                }
            }
            // DNF types (parenthesized intersection in union) require PHP 8.2
            let has_dnf = types
                .iter()
                .any(|t| matches!(t.kind, TypeHintKind::Intersection(_)));
            if has_dnf {
                self.require_version(PhpVersion::Php82, "DNF types", span);
            }
            return TypeHint {
                kind: TypeHintKind::Union(types),
                span,
            };
        }

        // Intersection: A&B&C (non-parenthesized) — PHP 8.1+
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
                let span = self.current_span();
                self.require_version(PhpVersion::Php81, "intersection types", span);

                // Check for invalid outer-form DNF: (A|B)&C
                if let TypeHintKind::Union(_) = &first.kind {
                    self.error(ParseError::Forbidden {
                        message: "Type declarations cannot be union types, use DNF syntax (A&B)|C instead".into(),
                        span: first.span,
                    });
                }

                let mut end = first.span.end;
                let mut types = self.alloc_vec_one(first);
                while self.eat(TokenKind::Ampersand).is_some() {
                    let t = self.parse_simple_type();
                    end = t.span.end;
                    types.push(t);
                }

                // Check if there's a union after this intersection (DNF: A&B|C&D)
                if self.check(TokenKind::Pipe) {
                    self.require_version(PhpVersion::Php82, "DNF types", Span::new(start, end));
                    // Validate that mixed is not used in intersection types
                    for ty in types.iter() {
                        if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                            self.error(ParseError::Forbidden {
                                message: "mixed cannot be used in intersection types".into(),
                                span: ty.span,
                            });
                        }
                    }
                    let intersection_span = Span::new(start, end);
                    let intersection = TypeHint {
                        kind: TypeHintKind::Intersection(types),
                        span: intersection_span,
                    };
                    let mut union_members = self.alloc_vec_one(intersection);
                    end = intersection_span.end;

                    while self.eat(TokenKind::Pipe).is_some() {
                        // Parse the next union member (could be an intersection or simple type)
                        let member_start = self.start_span();
                        let member = self.parse_simple_type();
                        let mut member_types = self.alloc_vec_one(member);

                        // Check if this union member is an intersection
                        while self.check(TokenKind::Ampersand) {
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
                            if !looks_like_type {
                                break;
                            }
                            self.eat(TokenKind::Ampersand);
                            member_types.push(self.parse_simple_type());
                        }

                        if member_types.len() > 1 {
                            let mspan = Span::new(member_start, self.previous_end());
                            union_members.push(TypeHint {
                                kind: TypeHintKind::Intersection(member_types),
                                span: mspan,
                            });
                        } else {
                            // member_types initialized with alloc_vec_one(member), guaranteed to have exactly 1 element
                            union_members.push(
                                member_types
                                    .into_iter()
                                    .next()
                                    .expect("member_types has 1 element"),
                            );
                        }
                        end = self.previous_end();
                    }

                    return TypeHint {
                        kind: TypeHintKind::Union(union_members),
                        span: Span::new(start, end),
                    };
                } else {
                    // Just an intersection, no union
                    let span = Span::new(start, end);
                    // Validate that mixed is not used in intersection types
                    for ty in types.iter() {
                        if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                            self.error(ParseError::Forbidden {
                                message: "mixed cannot be used in intersection types".into(),
                                span: ty.span,
                            });
                        }
                    }
                    return TypeHint {
                        kind: TypeHintKind::Intersection(types),
                        span,
                    };
                }
            }
        }

        first
    }

    /// Convert a type hint to a string representation for comparison purposes.
    fn type_hint_to_string(&self, ty: &TypeHint<'arena, 'src>) -> Option<String> {
        match &ty.kind {
            TypeHintKind::Keyword(builtin, _) => {
                let name = match builtin {
                    BuiltinType::Int => "int",
                    BuiltinType::Integer => "integer",
                    BuiltinType::Float => "float",
                    BuiltinType::Double => "double",
                    BuiltinType::String => "string",
                    BuiltinType::Bool => "bool",
                    BuiltinType::Boolean => "boolean",
                    BuiltinType::Void => "void",
                    BuiltinType::Never => "never",
                    BuiltinType::Mixed => "mixed",
                    BuiltinType::Object => "object",
                    BuiltinType::Iterable => "iterable",
                    BuiltinType::Callable => "callable",
                    BuiltinType::Array => "array",
                    BuiltinType::Self_ => "self",
                    BuiltinType::Parent_ => "parent",
                    BuiltinType::Static => "static",
                    BuiltinType::Null => "null",
                    BuiltinType::True => "true",
                    BuiltinType::False => "false",
                };
                Some(name.to_string())
            }
            TypeHintKind::Named(name) => match name {
                Name::Simple { value, .. } => Some(value.to_string()),
                Name::Complex { parts, kind, .. } => {
                    let prefix = match kind {
                        NameKind::Unqualified | NameKind::Qualified => "",
                        NameKind::FullyQualified => "\\",
                        NameKind::Relative => "namespace\\",
                        NameKind::Error => return None,
                    };
                    let joined = parts.iter().copied().collect::<Vec<_>>().join("\\");
                    Some(format!("{}{}", prefix, joined))
                }
                Name::Error { .. } => None,
            },
            TypeHintKind::Nullable(_) | TypeHintKind::Union(_) | TypeHintKind::Intersection(_) => {
                None
            }
        }
    }

    /// Parse a type element: either a simple type or a parenthesized type (intersection, union, or mixed DNF).
    fn parse_type_element(&mut self) -> TypeHint<'arena, 'src> {
        if self.check(TokenKind::LeftParen) {
            let start = self.start_span();
            self.advance(); // consume (

            // Parse the content inside parentheses.
            // This can be:
            // - A simple type: (A)
            // - An intersection: (A&B)
            // - A union: (A|B) or (A&B|C) (DNF)
            let result = self.parse_parenthesized_type();

            self.expect(TokenKind::RightParen);
            let end = self.previous_end();
            let span = Span::new(start, end);

            // Return the type, adjusting span
            match result.kind {
                TypeHintKind::Intersection(types) => {
                    // For parenthesized intersections, require PHP 8.1
                    if types.len() > 1 {
                        self.require_version(PhpVersion::Php81, "intersection types", span);
                    }
                    TypeHint {
                        kind: TypeHintKind::Intersection(types),
                        span,
                    }
                }
                TypeHintKind::Union(types) => {
                    // For parenthesized unions, require PHP 8.2
                    self.require_version(PhpVersion::Php82, "parenthesized union types", span);
                    TypeHint {
                        kind: TypeHintKind::Union(types),
                        span,
                    }
                }
                _ => TypeHint {
                    kind: result.kind,
                    span,
                },
            }
        } else {
            self.parse_simple_type()
        }
    }

    /// Parse the content inside parentheses in a type context.
    /// Handles unions (A|B) and intersections (A&B) with proper precedence.
    fn parse_parenthesized_type(&mut self) -> TypeHint<'arena, 'src> {
        let start = self.start_span();

        // Parse first simple type
        let first_type = self.parse_simple_type();

        // Check what comes next: & for intersection, | for union, or ) for single type
        if self.check(TokenKind::Ampersand) {
            // Parse intersection: A&B&C
            self.advance(); // consume &
            let mut types = self.alloc_vec_one(first_type);
            types.push(self.parse_simple_type());

            while self.check(TokenKind::Ampersand) && !self.check(TokenKind::Pipe) {
                self.advance(); // consume &
                types.push(self.parse_simple_type());
            }

            // Check if there are union operators after the intersection
            if self.check(TokenKind::Pipe) {
                // This is a DNF type: (A&B|C)
                // Validate that mixed is not used in intersection types
                for ty in types.iter() {
                    if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                        self.error(ParseError::Forbidden {
                            message: "mixed cannot be used in intersection types".into(),
                            span: ty.span,
                        });
                    }
                }
                self.advance(); // consume |

                // Wrap the first intersection member
                let ispan = Span::new(start, self.previous_end());
                let mut union_members = self.alloc_vec_one(TypeHint {
                    kind: TypeHintKind::Intersection(types),
                    span: ispan,
                });

                // Parse rest of union
                loop {
                    // Parse next union member (could be an intersection or single type)
                    let member_start = self.start_span();
                    let member_type = self.parse_simple_type();

                    if self.check(TokenKind::Ampersand) {
                        // This member is an intersection
                        self.advance();
                        let mut member_types = self.alloc_vec_one(member_type);
                        member_types.push(self.parse_simple_type());

                        while self.check(TokenKind::Ampersand) && !self.check(TokenKind::Pipe) {
                            self.advance();
                            member_types.push(self.parse_simple_type());
                        }

                        // Validate that mixed is not used in intersection types
                        for ty in member_types.iter() {
                            if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                                self.error(ParseError::Forbidden {
                                    message: "mixed cannot be used in intersection types".into(),
                                    span: ty.span,
                                });
                            }
                        }
                        let mspan = Span::new(member_start, self.previous_end());
                        union_members.push(TypeHint {
                            kind: TypeHintKind::Intersection(member_types),
                            span: mspan,
                        });
                    } else {
                        // Single type
                        union_members.push(member_type);
                    }

                    if !self.check(TokenKind::Pipe) {
                        break;
                    }
                    self.advance(); // consume |
                }

                let end = self.previous_end();
                TypeHint {
                    kind: TypeHintKind::Union(union_members),
                    span: Span::new(start, end),
                }
            } else {
                // Just a parenthesized intersection
                // Validate that mixed is not used in intersection types
                for ty in types.iter() {
                    if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                        self.error(ParseError::Forbidden {
                            message: "mixed cannot be used in intersection types".into(),
                            span: ty.span,
                        });
                    }
                }
                let end = self.previous_end();
                TypeHint {
                    kind: TypeHintKind::Intersection(types),
                    span: Span::new(start, end),
                }
            }
        } else if self.check(TokenKind::Pipe) {
            // Parse union: A|B|C or (A|B|C) where A is single types
            self.advance(); // consume |
            let mut union_members = self.alloc_vec_one(first_type);

            loop {
                let member_start = self.start_span();
                let member_type = self.parse_simple_type();

                if self.check(TokenKind::Ampersand) {
                    // This member is an intersection
                    self.advance();
                    let mut member_types = self.alloc_vec_one(member_type);
                    member_types.push(self.parse_simple_type());

                    while self.check(TokenKind::Ampersand) && !self.check(TokenKind::Pipe) {
                        self.advance();
                        member_types.push(self.parse_simple_type());
                    }

                    // Validate that mixed is not used in intersection types
                    for ty in member_types.iter() {
                        if let TypeHintKind::Keyword(BuiltinType::Mixed, _) = &ty.kind {
                            self.error(ParseError::Forbidden {
                                message: "mixed cannot be used in intersection types".into(),
                                span: ty.span,
                            });
                        }
                    }
                    let mspan = Span::new(member_start, self.previous_end());
                    union_members.push(TypeHint {
                        kind: TypeHintKind::Intersection(member_types),
                        span: mspan,
                    });
                } else {
                    // Single type
                    union_members.push(member_type);
                }

                if !self.check(TokenKind::Pipe) {
                    break;
                }
                self.advance(); // consume |
            }

            let end = self.previous_end();
            TypeHint {
                kind: TypeHintKind::Union(union_members),
                span: Span::new(start, end),
            }
        } else {
            // Just a single type wrapped in parentheses
            let end = self.previous_end();
            TypeHint {
                kind: first_type.kind,
                span: Span::new(start, end),
            }
        }
    }

    /// Parse a simple (non-composite) type: named type from Name or builtin keyword.
    pub fn parse_simple_type(&mut self) -> TypeHint<'arena, 'src> {
        let start = self.start_span();

        // Handle builtin type names that are contextual keywords (identifiers).
        // Use TypeHintKind::Keyword — 1-byte enum discriminant instead of Cow<str>.
        if self.check(TokenKind::Identifier) {
            let text = self.current_text();
            let lower_owned;
            let lower = if text.bytes().all(|b| !b.is_ascii_uppercase()) {
                text
            } else {
                lower_owned = text.to_ascii_lowercase();
                lower_owned.as_str()
            };
            let builtin = match lower {
                "int" => Some(BuiltinType::Int),
                "integer" => Some(BuiltinType::Integer),
                "float" => Some(BuiltinType::Float),
                "double" => Some(BuiltinType::Double),
                "string" => Some(BuiltinType::String),
                "bool" => Some(BuiltinType::Bool),
                "boolean" => Some(BuiltinType::Boolean),
                "void" => Some(BuiltinType::Void),
                "never" => Some(BuiltinType::Never),
                "mixed" => Some(BuiltinType::Mixed),
                "object" => Some(BuiltinType::Object),
                "iterable" => Some(BuiltinType::Iterable),
                "callable" => Some(BuiltinType::Callable),
                _ => None,
            };
            if let Some(builtin) = builtin {
                let token = self.advance();
                match builtin {
                    BuiltinType::Never => {
                        self.require_version(PhpVersion::Php81, "never type", token.span);
                    }
                    BuiltinType::Mixed => {
                        self.require_version(PhpVersion::Php80, "mixed type", token.span);
                    }
                    _ => {}
                }
                return TypeHint {
                    kind: TypeHintKind::Keyword(builtin, token.span),
                    span: token.span,
                };
            }
        }

        // Handle keyword-token-based types (tokens that are never identifiers).
        match self.current_kind() {
            TokenKind::Array => {
                let token = self.advance();
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Array, token.span),
                    span: token.span,
                }
            }
            TokenKind::Self_ => {
                let token = self.advance();
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Self_, token.span),
                    span: token.span,
                }
            }
            TokenKind::Parent_ => {
                let token = self.advance();
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Parent_, token.span),
                    span: token.span,
                }
            }
            TokenKind::Static => {
                let token = self.advance();
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Static, token.span),
                    span: token.span,
                }
            }
            TokenKind::Null => {
                let token = self.advance();
                self.require_version(PhpVersion::Php80, "null type", token.span);
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Null, token.span),
                    span: token.span,
                }
            }
            TokenKind::True => {
                let token = self.advance();
                self.require_version(PhpVersion::Php82, "true type", token.span);
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::True, token.span),
                    span: token.span,
                }
            }
            TokenKind::False => {
                let token = self.advance();
                self.require_version(PhpVersion::Php80, "false type", token.span);
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::False, token.span),
                    span: token.span,
                }
            }
            _ => {
                // Named type from qualified/unqualified name
                let name = self.parse_name();
                let span = Span::new(start, name.span().end);
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
            // `enum` is a semi-reserved keyword — as a type hint it refers to a
            // user-defined class named `Enum` (common in Magento / GraphQL libs).
            TokenKind::Enum_ => true,
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
    pub fn parse_attributes(&mut self) -> ArenaVec<'arena, Attribute<'arena, 'src>> {
        let mut attributes = self.alloc_vec_with_capacity(1);
        while self.check(TokenKind::HashBracket) {
            instrument::record_parse_attribute();
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
                    self.alloc_vec()
                };

                let span = Span::new(attr_start, self.previous_end());
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
    pub(crate) fn parse_short_echo(&mut self) -> Option<Stmt<'arena, 'src>> {
        if self.check(TokenKind::Eof) || self.check(TokenKind::CloseTag) {
            return None;
        }
        let start = self.start_span();
        let expr = expr::parse_expr(self);
        self.expect_semicolon("short echo tag");
        let span = Span::new(start, self.previous_end());
        Some(Stmt {
            kind: StmtKind::Echo(self.alloc_vec_one(expr)),
            span,
        })
    }

    // =========================================================================
    // Top-level parsing
    // =========================================================================

    pub fn parse_program(&mut self) -> Program<'arena, 'src> {
        let start = self.start_span();
        let mut stmts = self.alloc_vec_with_capacity(16);

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

        self.validate_namespace_layout(&stmts);

        let span = if stmts.is_empty() {
            Span::new(start, self.current.span.end)
        } else {
            Span::new(
                start,
                stmts
                    .last()
                    .expect("stmts non-empty: checked above")
                    .span
                    .end,
            )
        };

        Program { stmts, span }
    }

    /// Enforce PHP's program-level namespace rules:
    /// 1. **Bracketed vs. unbracketed cannot mix** — once a `namespace X { … }`
    ///    appears, an unbracketed `namespace Y;` (and vice versa) is fatal.
    /// 2. **No nesting** — a braced namespace body may not contain another
    ///    namespace declaration.
    /// 3. **No code outside braced namespaces** — once braced namespaces are
    ///    in use, any non-namespace, non-declare statement at the top level
    ///    is fatal.
    /// 4. **Namespace declarations must come first** — only `declare(…);` and
    ///    inline HTML may precede the first namespace declaration in the file.
    fn validate_namespace_layout(&mut self, stmts: &[Stmt<'arena, 'src>]) {
        // Pass 1: classify each top-level statement.
        #[derive(Clone, Copy, PartialEq)]
        enum NsKind {
            Braced,
            Unbraced,
        }
        let mut first_ns: Option<(NsKind, Span)> = None;
        let mut saw_non_ns_before_first_ns: Option<Span> = None;
        let mut saw_code_after_braced: Option<Span> = None;

        for stmt in stmts {
            let is_ns = matches!(stmt.kind, StmtKind::Namespace(_));
            let is_skippable = matches!(
                stmt.kind,
                StmtKind::Declare(_)
                    | StmtKind::InlineHtml(_)
                    | StmtKind::Nop
                    | StmtKind::HaltCompiler(_)
            );

            if let StmtKind::Namespace(decl) = stmt.kind {
                let kind = match decl.body {
                    php_ast::NamespaceBody::Braced(_) => NsKind::Braced,
                    php_ast::NamespaceBody::Simple => NsKind::Unbraced,
                };
                if let Some((prev_kind, prev_span)) = first_ns {
                    if prev_kind != kind {
                        self.error(ParseError::Forbidden {
                            message: "Cannot mix bracketed namespace declarations with unbracketed namespace declarations".into(),
                            span: stmt.span,
                        });
                        let _ = prev_span;
                    }
                } else {
                    first_ns = Some((kind, stmt.span));
                    if let Some(noncode_span) = saw_non_ns_before_first_ns {
                        self.error(ParseError::Forbidden {
                            message: "Namespace declaration statement has to be the very first statement or after any declare call in the script".into(),
                            span: noncode_span,
                        });
                    }
                }
            } else if !is_skippable {
                if first_ns.is_none() {
                    saw_non_ns_before_first_ns.get_or_insert(stmt.span);
                } else if matches!(first_ns, Some((NsKind::Braced, _)))
                    && saw_code_after_braced.is_none()
                {
                    saw_code_after_braced = Some(stmt.span);
                }
            }
            let _ = is_ns;
        }

        if let Some(span) = saw_code_after_braced {
            self.error(ParseError::Forbidden {
                message: "No code may exist outside of namespace {}".into(),
                span,
            });
        }

        // Pass 2: nested namespace inside any braced body.
        for stmt in stmts {
            if let StmtKind::Namespace(decl) = stmt.kind {
                if let php_ast::NamespaceBody::Braced(inner) = &decl.body {
                    for s in inner.iter() {
                        if matches!(s.kind, StmtKind::Namespace(_)) {
                            self.error(ParseError::Forbidden {
                                message: "Namespace declarations cannot be nested".into(),
                                span: s.span,
                            });
                        }
                    }
                }
            }
        }
    }
}
