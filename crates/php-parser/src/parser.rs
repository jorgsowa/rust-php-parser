use php_ast::*;
use php_lexer::{Lexer, LexerError, LexerErrorKind, Token, TokenKind};

use crate::diagnostics::{ForbiddenRule, ParseError, Phase};
use crate::expr;
use crate::instrument;
use crate::stmt;
use crate::version::PhpVersion;
use std::borrow::Cow;

const MAX_ERRORS: usize = 100;
/// Maximum recursion depth shared by statements, expressions and the
/// sub-parsers that handle string interpolation. Each nested statement,
/// expression or variable-variable `$` consumes one unit; exceeding the budget
/// reports [`ParseError::NestingTooDeep`] instead of overflowing the stack.
///
/// Sized from measured release-build frames: the costliest nesting paths
/// (casts, arrow functions, interpolated strings) use about 2 KiB of stack per
/// level, so the full budget fits in roughly 1 MiB and stays safe on the 2 MiB
/// default stack of spawned threads.
pub(crate) const MAX_NESTING_DEPTH: u32 = 512;

/// Nesting units charged for entering the code inside a string interpolation.
/// Every nested string is re-lexed by its own sub-parser, so work grows with
/// string depth × length; charging a larger share of the budget keeps string
/// nesting under 32 levels and so bounds that factor.
pub(crate) const INTERPOLATION_NESTING_COST: u32 = MAX_NESTING_DEPTH / 32;

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
            rule: match e.kind {
                LexerErrorKind::InvalidNumericLiteral => ForbiddenRule::InvalidNumericLiteral,
                LexerErrorKind::UnterminatedComment => ForbiddenRule::UnterminatedComment,
                LexerErrorKind::UnexpectedCharacter => ForbiddenRule::UnexpectedCharacter,
                _ => ForbiddenRule::Other,
            },
            message: e.message.into(),
            span: e.span,
        }
    }
}

fn advance_lexer_skip_comments<'src>(
    lexer: &mut Lexer<'src>,
    source: &'src str,
    comments: &mut Vec<Comment<'src>>,
) -> Token {
    loop {
        let tok = lexer.next_token();
        if tok.kind.is_comment() {
            let text = &source[tok.span.start as usize..tok.span.end as usize];
            comments.push(Comment {
                kind: comment_kind(tok.kind),
                text,
                span: tok.span,
            });
        } else {
            return tok;
        }
    }
}

/// Reported for every `list(...)` and retracted when it turns out to be a destructuring target.
pub(crate) const LIST_OUTSIDE_DESTRUCTURING: &str =
    "list() can only be used as an assignment or foreach target";

pub struct Parser<'arena, 'src> {
    current: Token,
    /// End offset of the most recently consumed token.
    /// Updated on every `advance()`, used for precise span construction.
    previous_end: u32,
    /// Block nesting depth (0 = top-level scope)
    pub depth: u32,
    /// Recursion depth shared by statements and expressions (see
    /// [`MAX_NESTING_DEPTH`]); sub-parsers start from their parent's value.
    pub(crate) nesting_depth: u32,
    /// Loop/switch nesting depth — tracks valid break/continue targets.
    /// Resets to 0 when crossing a function/method/closure boundary.
    pub(crate) loop_depth: u32,
    /// `loop_depth` at the innermost enclosing `finally` block of the current function body.
    pub(crate) finally_loop_depth: Option<u32>,
    /// True once the current function body or top-level code contains a `goto` or a label.
    pub(crate) has_goto_or_label: bool,
    /// Right operands that PHP never compiles: `false && …`, `true || …`.
    pub(crate) uncompiled_spans: Vec<Span>,
    /// Function/method/closure nesting depth — tracks valid yield context.
    /// Incremented when entering a function/method/closure, decremented when exiting.
    pub(crate) function_depth: u32,
    /// True inside the body of a function, method, closure or hook that returns by reference.
    pub(crate) by_ref_function: bool,
    /// Names declared by `static` in the current function body or top-level code.
    pub(crate) static_vars: Vec<&'src str>,
    /// Whether the current function body contains `yield`, which makes it a generator.
    pub(crate) has_yield: bool,
    /// Number of statements being parsed around the current one; 1 for a top-level statement,
    /// including one directly inside a braced `namespace`.
    pub(crate) stmt_depth: u32,
    /// True once top-level code other than `declare` and empty statements has been seen.
    pub(crate) top_level_code_seen: bool,
    /// True once a top-level empty statement (`;` or a standalone `?>`) has been seen.
    pub(crate) top_level_nop_seen: bool,
    /// Start of the `?>` that ends the statement before it, which makes it no statement of its own.
    pub(crate) stmt_ending_close_tag: Option<u32>,
    /// True only when parsing the parameter list of a `__construct` method.
    /// Used to reject `readonly` parameters outside constructors.
    pub(crate) in_constructor: bool,
    lexer: Lexer<'src>,
    /// Next token (one ahead of current)
    next: Token,
    /// Two tokens ahead of current
    next2: Token,
    pub arena: &'arena bumpalo::Bump,
    pub source: &'src str,
    errors: Vec<ParseError>,
    /// Set when [`error`](Self::error) discards an error because the cap was reached.
    errors_dropped: bool,
    /// All comments found in the source, collected during lexing.
    comments: Vec<Comment<'src>>,
    /// PHP version being targeted — used for version-specific error reporting.
    pub version: PhpVersion,
    /// When true, the `{` curly-brace subscript operator is suppressed in the Pratt loop.
    /// Used when parsing property/parameter default values so that a following hook block
    /// `{ get => ...; }` is not consumed as part of the default expression.
    pub(crate) no_brace_subscript: bool,
    /// End position of the most recently consumed `{` or `}` token.
    /// Used as a floor when searching for doc comments: a comment that starts
    /// before this boundary belongs to an already-closed scope or to the
    /// outer block and must not be claimed by inner statements.
    last_scope_close: u32,
    /// End position of the most recently fully-parsed statement (at any
    /// nesting level). Used alongside `last_scope_close` as a floor when
    /// searching for doc comments: a comment that starts before this position
    /// lies inside an already-completed sibling statement (e.g. above a
    /// closure argument nested in an earlier statement's call) and must not
    /// leak forward to whatever statement is parsed next. Braces alone don't
    /// catch this — a statement can fully close without ever opening a scope
    /// (e.g. `foo(fn() => ...);` has no `{`/`}` of its own).
    last_stmt_end: u32,
    /// Number of `(void)` casts parsed so far; the void-cast misuse walk over the
    /// program only runs when there is one (a rare PHP 8.5 feature).
    pub(crate) void_cast_count: u32,
    /// Number of `$a[]` fetches parsed so far; the walk that reports reads of them only
    /// runs when there is one.
    pub(crate) empty_dim_count: u32,
    /// Set once `self`, `parent` or `static` is used as a class name or type, which turns on
    /// the walk that checks them against the enclosing class scope.
    pub(crate) has_class_keyword_ref: bool,
    /// The namespace of the code being parsed, as written in its declaration.
    pub(crate) namespace: Option<String>,
    /// Class imports (`use A\B as C`) of the current namespace, keyed by lowercase alias.
    pub(crate) class_imports: std::collections::HashMap<String, String>,
    /// The class, interface, trait or enum whose body is being parsed.
    pub(crate) class_scope: Option<ClassScope>,
}

/// Whether a token after `&` in a type starts another intersection member rather than a
/// by-reference parameter name.
fn starts_intersection_member(kind: TokenKind) -> bool {
    matches!(
        kind,
        TokenKind::Identifier
            | TokenKind::Backslash
            | TokenKind::Self_
            | TokenKind::Parent_
            | TokenKind::Static
            | TokenKind::Namespace
            | TokenKind::Enum_
            | TokenKind::Array
            | TokenKind::Null
            | TokenKind::True
            | TokenKind::False
    )
}

/// `?false` or `false|null`, which PHP before 8.2 treats as a standalone `false`.
fn is_nullable_false(type_hint: &TypeHint<'_, '_>) -> bool {
    let is = |t: &TypeHint<'_, '_>, b: BuiltinType| matches!(t.kind, TypeHintKind::Keyword(k, _) if k == b);
    match &type_hint.kind {
        TypeHintKind::Nullable(inner) => is(inner, BuiltinType::False),
        TypeHintKind::Union(types) => {
            types.iter().any(|t| is(t, BuiltinType::False))
                && types
                    .iter()
                    .all(|t| is(t, BuiltinType::False) || is(t, BuiltinType::Null))
        }
        _ => false,
    }
}

/// PHP's message for a builtin type that must be used alone, as in `?void` or `never|null`.
fn standalone_type_message(builtin: BuiltinType) -> Option<&'static str> {
    match builtin {
        BuiltinType::Void => Some("Void can only be used as a standalone type"),
        BuiltinType::Never => Some("never can only be used as a standalone type"),
        BuiltinType::Mixed => Some("Type mixed can only be used as a standalone type"),
        _ => None,
    }
}

/// A class-like declaration as type diagnostics name it.
pub(crate) struct ClassScope {
    /// Namespace-qualified name used in messages; `class@anonymous` for anonymous classes.
    pub(crate) name: String,
    pub(crate) is_anonymous: bool,
    /// What `self` resolves to at compile time; `None` in traits and closures.
    pub(crate) self_name: Option<String>,
    /// What `parent` resolves to at compile time.
    pub(crate) parent_name: Option<String>,
}

impl<'arena, 'src> Parser<'arena, 'src> {
    /// Create a parser targeting a specific PHP version.
    pub fn with_version(
        arena: &'arena bumpalo::Bump,
        source: &'src str,
        version: PhpVersion,
    ) -> Self {
        let mut comments: Vec<Comment<'src>> = Vec::new();
        let mut lexer = Lexer::new(source).with_attributes(version >= PhpVersion::Php80);
        let current = advance_lexer_skip_comments(&mut lexer, source, &mut comments);
        let next = advance_lexer_skip_comments(&mut lexer, source, &mut comments);
        let next2 = advance_lexer_skip_comments(&mut lexer, source, &mut comments);

        let mut parser = Self {
            arena,
            lexer,
            current,
            next,
            next2,
            previous_end: current.span.start,
            source,
            errors: Vec::new(),
            errors_dropped: false,
            comments,
            depth: 0,
            nesting_depth: 0,
            loop_depth: 0,
            finally_loop_depth: None,
            has_goto_or_label: false,
            uncompiled_spans: Vec::new(),
            function_depth: 0,
            by_ref_function: false,
            static_vars: Vec::new(),
            has_yield: false,
            stmt_depth: 0,
            top_level_code_seen: false,
            top_level_nop_seen: false,
            stmt_ending_close_tag: None,
            in_constructor: false,
            version,
            no_brace_subscript: false,
            last_scope_close: 0,
            last_stmt_end: 0,
            void_cast_count: 0,
            empty_dim_count: 0,
            has_class_keyword_ref: false,
            namespace: None,
            class_imports: std::collections::HashMap::new(),
            class_scope: None,
        };
        parser.demote_initial_keywords();
        parser
    }

    /// Create a parser starting in PHP mode at `offset` within `source`.
    /// Used for parsing interpolation expressions directly in the original source.
    /// `nesting_depth` is the enclosing parser's depth, so code inside a string
    /// shares the same budget as the code around it.
    pub fn new_at(
        arena: &'arena bumpalo::Bump,
        source: &'src str,
        offset: usize,
        version: PhpVersion,
        nesting_depth: u32,
    ) -> Self {
        let mut comments: Vec<Comment<'src>> = Vec::new();
        let mut lexer = Lexer::new_at(source, offset).with_attributes(version >= PhpVersion::Php80);
        let current = advance_lexer_skip_comments(&mut lexer, source, &mut comments);
        let next = advance_lexer_skip_comments(&mut lexer, source, &mut comments);
        let next2 = advance_lexer_skip_comments(&mut lexer, source, &mut comments);

        let mut parser = Self {
            arena,
            lexer,
            current,
            next,
            next2,
            previous_end: current.span.start,
            source,
            errors: Vec::new(),
            errors_dropped: false,
            comments,
            depth: 0,
            nesting_depth,
            loop_depth: 0,
            finally_loop_depth: None,
            has_goto_or_label: false,
            uncompiled_spans: Vec::new(),
            function_depth: 0,
            by_ref_function: false,
            static_vars: Vec::new(),
            has_yield: false,
            stmt_depth: 0,
            top_level_code_seen: false,
            top_level_nop_seen: false,
            stmt_ending_close_tag: None,
            in_constructor: false,
            version,
            no_brace_subscript: false,
            last_scope_close: 0,
            last_stmt_end: 0,
            void_cast_count: 0,
            empty_dim_count: 0,
            has_class_keyword_ref: false,
            namespace: None,
            class_imports: std::collections::HashMap::new(),
            class_scope: None,
        };
        parser.demote_initial_keywords();
        parser
    }

    /// Emit a `VersionTooLow` error if the targeted PHP version is less than `min`.
    /// Parsing always continues — the error is non-fatal.
    pub fn require_version(&mut self, min: PhpVersion, feature: &'static str, span: Span) {
        if self.version < min {
            self.error(ParseError::VersionTooLow {
                feature: feature.into(),
                required: min,
                used: self.version,
                span,
            });
        }
    }

    pub fn source(&self) -> &'src str {
        self.source
    }

    /// Whether the quoted-string token starting at `start` needs no decoding
    /// (see [`Lexer::is_verbatim_string`]).
    #[inline]
    pub(crate) fn is_verbatim_string(&mut self, start: u32) -> bool {
        self.lexer.is_verbatim_string(start)
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

    #[inline]
    /// Treats everything from `offset` on as raw data: no tokens, comments or lexer errors.
    pub(crate) fn halt_at(&mut self, offset: usize) {
        self.lexer.halt_at(offset);
        self.comments.retain(|c| (c.span.start as usize) < offset);
        let eof = Token::eof(self.source.len() as u32);
        self.current = eof;
        self.next = eof;
        self.next2 = eof;
    }

    fn next_non_comment(&mut self) -> Token {
        advance_lexer_skip_comments(&mut self.lexer, self.source, &mut self.comments)
    }

    /// Advance to the next token, returning the consumed token.
    #[inline]
    pub fn advance(&mut self) -> Token {
        let prev = self.current;
        self.previous_end = prev.span.end;
        // Track both { and } as scope boundaries.  Updating on LeftBrace ensures
        // that statements *inside* a block cannot claim doc comments that were
        // written *before* the opening brace (e.g. `/** @var */ foreach { echo; }`
        // must not attach the @var comment to `echo`).
        if prev.kind == TokenKind::RightBrace || prev.kind == TokenKind::LeftBrace {
            self.last_scope_close = prev.span.end;
        }
        self.current = self.next;
        self.next = self.next2;
        self.next2 = self.next_non_comment();
        if matches!(
            self.next.kind,
            TokenKind::Readonly | TokenKind::MagicProperty
        ) {
            self.next.kind = self.versioned_kind(self.next.kind, self.next2.kind);
        }
        if self.next2.kind == TokenKind::Backslash && self.version < PhpVersion::Php80 {
            self.next.kind = self.unqualified_kind_before_80(self.next);
        }
        prev
    }

    /// Before PHP 8.0 a name is lexed per segment, so the lexer's `keyword\` name segment is a keyword.
    fn unqualified_kind_before_80(&self, token: Token) -> TokenKind {
        if token.kind != TokenKind::Identifier {
            return token.kind;
        }
        let text = &self.source[token.span.start as usize..token.span.end as usize];
        match php_lexer::token::resolve_keyword(text) {
            Some(kind) if kind != TokenKind::Namespace && is_reserved_before_80(text) => kind,
            _ => token.kind,
        }
    }

    /// The kind of a keyword token that is a plain name in older versions.
    fn versioned_kind(&self, kind: TokenKind, follower: TokenKind) -> TokenKind {
        match kind {
            TokenKind::Readonly => self.readonly_kind(follower),
            TokenKind::MagicProperty if self.version < PhpVersion::Php84 => TokenKind::Identifier,
            _ => kind,
        }
    }

    /// Before PHP 8.1 `readonly` is a plain name. It keeps its keyword kind when a modifier's
    /// follower comes next, so that modifier use still reports the version it needs.
    fn readonly_kind(&self, follower: TokenKind) -> TokenKind {
        let modifier_follower = matches!(
            follower,
            TokenKind::Identifier
                | TokenKind::Question
                | TokenKind::LeftParen
                | TokenKind::Backslash
                | TokenKind::Namespace
                | TokenKind::Array
                | TokenKind::Static
                | TokenKind::Self_
                | TokenKind::Parent_
                | TokenKind::Null
                | TokenKind::True
                | TokenKind::False
                | TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Final
                | TokenKind::Abstract
                | TokenKind::Readonly
                | TokenKind::Class
                | TokenKind::Function
                | TokenKind::Fn_
        );
        if self.version < PhpVersion::Php81 && !modifier_follower {
            TokenKind::Identifier
        } else {
            TokenKind::Readonly
        }
    }

    fn demote_initial_keywords(&mut self) {
        self.current.kind = self.versioned_kind(self.current.kind, self.next.kind);
        self.next.kind = self.versioned_kind(self.next.kind, self.next2.kind);
        if self.version < PhpVersion::Php80 {
            if self.next.kind == TokenKind::Backslash {
                self.current.kind = self.unqualified_kind_before_80(self.current);
            }
            if self.next2.kind == TokenKind::Backslash {
                self.next.kind = self.unqualified_kind_before_80(self.next);
            }
        }
    }

    /// End offset of the most recently consumed token.
    /// Use this instead of `current_span().start` for precise span ends.
    #[inline]
    pub fn previous_end(&self) -> u32 {
        self.previous_end
    }

    /// Span from `start` to [`previous_end`](Self::previous_end), empty when nothing was consumed since `start`.
    #[inline]
    pub fn span_from(&self, start: u32) -> Span {
        Span::new(start, self.previous_end.max(start))
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
    /// inputs yield [`Ident::error`].
    #[inline]
    pub fn variable_ident(&self, token: Token) -> Ident<'src> {
        let s = self.variable_name(token);
        if s.is_empty() {
            Ident::error(token.span)
        } else {
            Ident::new(s, token.span)
        }
    }

    /// Zero-width error [`Ident`] at the current token, for a missing name.
    #[inline]
    pub fn missing_ident(&self) -> Ident<'src> {
        let at = self.current.span.start;
        Ident::error(Span::new(at, at))
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
                found: self.current_kind().description().into(),
                span: self.current_span(),
            });
            None
        }
    }

    /// Report that `expected` was expected at the current token.
    pub fn error_expected(&mut self, expected: &'static str) {
        self.error(ParseError::Expected {
            expected: expected.into(),
            found: self.current_kind().description().into(),
            span: self.current_span(),
        });
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
            self.close_tag_ends_stmt();
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

    /// Mark the current `?>` as the end of the statement before it.
    pub(crate) fn close_tag_ends_stmt(&mut self) {
        self.stmt_ending_close_tag = Some(self.current.span.start);
    }

    /// At a `;` or `?>`, either of which ends a statement.
    pub fn at_statement_end(&mut self) -> bool {
        self.check(TokenKind::Semicolon) || self.check(TokenKind::CloseTag)
    }

    /// Like `expect(TokenKind::Semicolon)` for the end of a class member, where `?>` also ends
    /// it and takes the `<?php` that reopens the body along.
    pub fn expect_member_end(&mut self) -> Option<Token> {
        if !self.check(TokenKind::CloseTag) {
            return self.expect(TokenKind::Semicolon);
        }
        let close = self.advance();
        // PHP drops one newline after `?>`; any other inline HTML is not a class member.
        if self.check(TokenKind::InlineHtml) && matches!(self.current_text(), "\n" | "\r\n") {
            self.advance();
        }
        if self.check(TokenKind::OpenTag) && self.current_text() != "<?=" {
            self.advance();
        }
        Some(close)
    }

    /// Like `expect(TokenKind::Semicolon)`, but a `?>` also ends the statement (not consumed).
    pub fn expect_statement_end(&mut self) -> Option<Token> {
        if self.check(TokenKind::CloseTag) {
            self.close_tag_ends_stmt();
            None
        } else {
            self.expect(TokenKind::Semicolon)
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
                delimiter: kind.description().into(),
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
    #[inline]
    pub fn peek_kind(&mut self) -> Option<TokenKind> {
        Some(self.next.kind)
    }

    /// Peek two tokens ahead of current.
    #[inline]
    pub fn peek2_kind(&mut self) -> Option<TokenKind> {
        Some(self.next2.kind)
    }

    /// Span of the peeked token (one token ahead of current).
    #[inline]
    pub fn peek_span(&self) -> Span {
        self.next.span
    }

    /// Span of the token two tokens ahead of current.
    #[inline]
    pub fn peek2_span(&self) -> Span {
        self.next2.span
    }

    /// Get the text of the peeked token (one token ahead of current).
    #[inline]
    pub fn peek_text(&mut self) -> Option<&'src str> {
        Some(&self.source[self.next.span.start as usize..self.next.span.end as usize])
    }

    /// Get the text of the token two tokens ahead of current.
    #[inline]
    pub fn peek2_text(&mut self) -> Option<&'src str> {
        Some(&self.source[self.next2.span.start as usize..self.next2.span.end as usize])
    }

    // =========================================================================
    // Error handling
    // =========================================================================

    pub fn error(&mut self, err: ParseError) {
        if self.errors.len() < MAX_ERRORS {
            self.errors.push(err);
        } else {
            self.errors_dropped = true;
        }
    }

    pub(crate) fn forbid(
        &mut self,
        rule: ForbiddenRule,
        message: impl Into<Cow<'static, str>>,
        span: Span,
    ) {
        self.error(ParseError::Forbidden {
            rule,
            message: message.into(),
            span,
        });
    }

    /// Enter one level of statement/expression recursion. Returns `false`, after
    /// reporting [`ParseError::NestingTooDeep`], when the shared budget is used
    /// up; the caller must then return without recursing and without calling
    /// [`leave_nesting`](Self::leave_nesting).
    #[inline]
    pub(crate) fn enter_nesting(&mut self) -> bool {
        if self.nesting_depth >= MAX_NESTING_DEPTH {
            let span = self.current_span();
            self.error(ParseError::NestingTooDeep { span });
            return false;
        }
        self.nesting_depth += 1;
        true
    }

    #[inline]
    pub(crate) fn leave_nesting(&mut self) {
        self.nesting_depth -= 1;
    }

    pub fn errors_truncated(&self) -> bool {
        self.errors_dropped || self.errors.len() + self.lexer.errors().len() > MAX_ERRORS
    }

    /// Retract "empty array element" and `list()` errors emitted within `within`.
    /// Empty elements (`[$a, , $c]`) and `list(...)` are reported eagerly because
    /// they are only valid in a list-destructuring target; this undoes them once
    /// such a target is recognized (assignment LHS / foreach).
    pub fn retract_destructuring_errors_within(&mut self, within: Span) {
        self.errors.retain(|e| {
            !matches!(e, ParseError::Forbidden { rule, span, .. }
                if matches!(rule, ForbiddenRule::EmptyArrayElement | ForbiddenRule::ListOutsideDestructuring)
                    && span.start >= within.start
                    && span.end <= within.end)
        });
    }

    /// Drop the errors in [`uncompiled_spans`](Self::uncompiled_spans) that PHP
    /// raises while compiling; only syntax errors are reported there.
    fn retract_uncompiled_errors(&mut self) {
        if self.uncompiled_spans.is_empty() {
            return;
        }
        let spans = std::mem::take(&mut self.uncompiled_spans);
        self.errors.retain(|e| match e {
            ParseError::Forbidden { rule, span, .. } if rule.phase() == Phase::Compile => !spans
                .iter()
                .any(|s| span.start >= s.start && span.end <= s.end),
            _ => true,
        });
    }

    pub fn errors_mut(&mut self) -> &mut Vec<ParseError> {
        &mut self.errors
    }

    pub fn into_errors(mut self) -> Vec<ParseError> {
        self.retract_uncompiled_errors();
        // PHP 7.4 only warns about an unterminated comment or an unexpected character.
        let warning_is_error = self.version >= PhpVersion::Php80;
        let mut errors: Vec<ParseError> = self
            .lexer
            .into_errors()
            .into_iter()
            .filter(|e| {
                warning_is_error
                    || !matches!(
                        e.kind,
                        LexerErrorKind::UnterminatedComment | LexerErrorKind::UnexpectedCharacter
                    )
            })
            .map(lex_error_to_parse_error)
            .collect();
        errors.extend(self.errors);
        errors.truncate(MAX_ERRORS);
        errors
    }

    pub fn take_comments(&mut self) -> Vec<Comment<'src>> {
        std::mem::take(&mut self.comments)
    }

    /// The end position of the most recently consumed `{` or `}` token.
    /// Used by the statement parser to snapshot the scope boundary before
    /// parsing a statement's body.
    pub fn scope_boundary(&self) -> u32 {
        self.last_scope_close
    }

    /// The end position of the most recently fully-parsed statement.
    /// Used by the statement parser to snapshot the sibling boundary before
    /// parsing the next statement's body.
    pub fn stmt_boundary(&self) -> u32 {
        self.last_stmt_end
    }

    /// Record that a statement ending at `end` has just been fully parsed.
    /// Called once per statement (see `stmt::parse_stmt`) so a later sibling's
    /// doc-comment claim can't reach back across it — see `last_stmt_end`.
    pub(crate) fn mark_stmt_end(&mut self, end: u32) {
        if end > self.last_stmt_end {
            self.last_stmt_end = end;
        }
    }

    /// Take the last doc comment (`/** ... */`) that appears before `pos`.
    /// The comment is removed from the comments list so it won't be taken again.
    /// Only returns comments that appeared after the last scope boundary (`{` or `}`)
    /// and after the last fully-parsed sibling statement, preventing doc comments
    /// inside closed scopes — or inside an already-completed earlier statement,
    /// such as above a closure argument nested in a call — from leaking forward.
    pub fn take_doc_comment(&mut self, before: u32) -> Option<Comment<'src>> {
        let floor = self.last_scope_close.max(self.last_stmt_end);
        let idx = self.comments.iter().rposition(|c| {
            c.kind == CommentKind::Doc && c.span.end <= before && c.span.start >= floor
        })?;
        Some(self.comments.remove(idx))
    }

    /// Like [`take_doc_comment`] but uses `from` as the lower bound instead of
    /// `last_scope_close`. Used by the statement parser to reclaim a doc
    /// comment for the statement that owns it even after its body has been
    /// fully parsed (which advances `last_scope_close` — and, for statements
    /// with a nested body, `last_stmt_end` too — past the comment's position).
    /// `from` must already be `.max()`-combined with a *snapshot* of
    /// `stmt_boundary()` taken before parsing this statement's body, not the
    /// live value: this call happens after inner parsing, by which point a
    /// statement with its own nested body has pushed `last_stmt_end` forward
    /// via its children, which would wrongly exclude this statement's own
    /// legitimate leading comment if read live here.
    pub fn take_doc_comment_from(&mut self, before: u32, from: u32) -> Option<Comment<'src>> {
        let idx = self.comments.iter().rposition(|c| {
            c.kind == CommentKind::Doc && c.span.end <= before && c.span.start >= from
        })?;
        Some(self.comments.remove(idx))
    }

    /// Take a doc comment (`/** ... */`) that appears strictly after `after`
    /// and ends at or before `before`. Used for a doc comment trailing a
    /// function parameter (PHP 8.6): `string $x /** ... */,`.
    pub fn take_doc_comment_after(&mut self, after: u32, before: u32) -> Option<Comment<'src>> {
        let idx = self.comments.iter().position(|c| {
            c.kind == CommentKind::Doc && c.span.start >= after && c.span.end <= before
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

    /// True if `(set)` follows the visibility keyword ending at `keyword_end` with no
    /// whitespace; PHP lexes `private(set)` as one case-insensitive token.
    pub(crate) fn set_visibility_follows(&self, keyword_end: u32) -> bool {
        self.source
            .get(keyword_end as usize..keyword_end as usize + 5)
            .is_some_and(|s| s.eq_ignore_ascii_case("(set)"))
    }

    /// Report the token after a trailing comma in a list where PHP allows none.
    pub(crate) fn trailing_comma_error(&mut self, expected: &'static str) {
        self.error(ParseError::Expected {
            expected: expected.into(),
            found: self.current_kind().description().into(),
            span: self.current_span(),
        });
    }

    /// Consume the current token as an identifier string, accepting both
    /// Identifier tokens and semi-reserved keywords.
    pub fn eat_identifier_or_keyword(&mut self) -> Option<(&'src str, Span)> {
        if self.check(TokenKind::Identifier)
            || self.is_semi_reserved_keyword()
            || self.short_echo_is_identifier()
        {
            let token = self.advance();
            let text = &self.source[token.span.start as usize..token.span.end as usize];
            Some((text, token.span))
        } else {
            None
        }
    }

    /// PHP 7.4 lexes `<?=` as `echo`, a semi-reserved keyword.
    fn short_echo_is_identifier(&self) -> bool {
        self.version < PhpVersion::Php80
            && self.check(TokenKind::OpenTag)
            && self.source.as_bytes()[self.current.span.start as usize..].starts_with(b"<?=")
    }

    /// A name segment after `\`: `__halt_compiler` is only a keyword as a whole token.
    fn eat_name_segment(&mut self, after_separator: bool) -> Option<(&'src str, Span)> {
        let halt_compiler_part = self.check(TokenKind::HaltCompiler)
            && (after_separator || self.peek_kind() == Some(TokenKind::Backslash));
        if halt_compiler_part {
            let token = self.advance();
            let text = &self.source[token.span.start as usize..token.span.end as usize];
            return Some((text, token.span));
        }
        self.eat_identifier_or_keyword()
    }

    /// True if the current token is a keyword that PHP forbids as a *declaration*
    /// name (class/interface/trait/enum/global-const). PHP rejects every reserved
    /// keyword here; only the contextual `enum` keyword remains usable as a
    /// name. (Member names — methods, class constants — are unrestricted and
    /// must not use this check.)
    pub fn is_reserved_keyword_as_decl_name(&self) -> bool {
        self.is_semi_reserved_keyword() && !self.check(TokenKind::Enum_)
    }

    // =========================================================================
    // Name parsing
    // =========================================================================

    /// Before PHP 8.0 every part of a namespaced name must be a non-reserved word.
    pub(crate) fn check_name_parts_before_80(&mut self, parts: &[&str], span: Span) {
        if self.version < PhpVersion::Php80 && parts.iter().any(|p| is_reserved_before_80(p)) {
            self.require_version(
                PhpVersion::Php80,
                "reserved keyword in namespaced name",
                span,
            );
        }
    }

    /// Parse a name: qualified, fully-qualified, relative, or unqualified.
    /// e.g., `Foo`, `Foo\Bar`, `\Foo\Bar`, `namespace\Foo\Bar`
    pub fn parse_name(&mut self) -> Name<'arena, 'src> {
        self.parse_name_with(false)
    }

    /// Parse a name; with `group_prefix`, a trailing `\` before `{` is left for a group `use`.
    pub(crate) fn parse_name_with(&mut self, group_prefix: bool) -> Name<'arena, 'src> {
        let start = self.start_span();

        // Check for fully qualified: \Foo\Bar
        let fully_qualified = self.eat(TokenKind::Backslash).is_some();

        // Check for relative: namespace\Foo
        let relative = !fully_qualified && self.check(TokenKind::Namespace);
        // PHP lexes a name as one token, so the separators must touch the parts.
        let mut separated_at = None;
        if relative {
            let keyword_end = self.advance().span.end;
            if self
                .expect(TokenKind::Backslash)
                .is_some_and(|t| t.span.start != keyword_end)
            {
                separated_at = Some(keyword_end);
            }
        }
        if (fully_qualified || relative) && self.previous_end() != self.current_span().start {
            separated_at.get_or_insert(self.previous_end());
        }

        // First part
        let (first, first_span): (&'src str, Span) =
            if let Some((text, span)) = self.eat_name_segment(fully_qualified || relative) {
                (text, span)
            } else {
                let err_span = self.current_span();
                self.error(ParseError::Expected {
                    expected: "identifier".into(),
                    found: self.current_kind().description().into(),
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
        while let Some(separator) = self.eat(TokenKind::Backslash) {
            if let Some((text, span)) = self.eat_name_segment(true) {
                if separator.span.start != last_end || span.start != separator.span.end {
                    separated_at.get_or_insert(separator.span.start);
                }
                parts.push(text);
                last_end = span.end;
            } else if !(group_prefix && self.check(TokenKind::LeftBrace)) {
                self.error_expected("identifier");
            }
        }

        let span = Span::new(start, last_end);
        self.check_name_parts_before_80(&parts, span);
        if separated_at.is_some() && self.version >= PhpVersion::Php80 {
            self.forbid(
                ForbiddenRule::WhitespaceInNamespacedName,
                "A namespaced name cannot contain whitespace",
                span,
            );
        }

        let kind = if fully_qualified {
            if parts.len() == 1 && crate::stmt::class_keyword(first).is_some() {
                self.has_class_keyword_ref = true;
            }
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

    /// Report `static` in a type outside return and class constant types, where PHP rejects it.
    pub(crate) fn reject_static_type(&mut self, type_hint: &TypeHint<'_, '_>, position: &str) {
        match &type_hint.kind {
            TypeHintKind::Keyword(BuiltinType::Static, span) => {
                self.forbid(
                    ForbiddenRule::StaticTypePosition,
                    format!("static cannot be used as a {position} type"),
                    *span,
                );
            }
            TypeHintKind::Nullable(inner) => self.reject_static_type(inner, position),
            TypeHintKind::Union(types) | TypeHintKind::Intersection(types) => {
                for t in types.iter() {
                    self.reject_static_type(t, position);
                }
            }
            _ => {}
        }
    }

    /// Parse a type hint: `?T`, `A|B`, `A&B`, `(A&B)|C` (DNF), or simple type.
    pub fn parse_type_hint(&mut self) -> TypeHint<'arena, 'src> {
        let type_hint = self.parse_type_hint_unchecked();
        if self.version < PhpVersion::Php82 && is_nullable_false(&type_hint) {
            self.require_version(
                PhpVersion::Php82,
                "false as standalone type",
                type_hint.span,
            );
        }
        self.check_type_composition(&type_hint);
        self.check_duplicate_types(&type_hint);
        self.check_qualified_type_names(&type_hint);
        type_hint
    }

    /// Report a named class-like declaration inside a class member body.
    pub(crate) fn check_class_nesting(&mut self, name_span: Span) {
        if self.class_scope.is_some() {
            self.forbid(
                ForbiddenRule::NestedClassDeclaration,
                "Class declarations may not be nested",
                name_span,
            );
        }
    }

    /// Turns on the class keyword walk for the `self`, `parent` or `static` just consumed,
    /// unless it is known to name a class: in a class, interface or enum body, outside
    /// traits and closures, and for `parent` only when the class extends one.
    /// `static::class` (constant expressions) and `parent::$x` (hook calls) still need it.
    pub(crate) fn note_class_keyword(&mut self, keyword: TokenKind) {
        if self.has_class_keyword_ref {
            return;
        }
        let known = self.class_scope.as_ref().is_some_and(|scope| {
            scope.self_name.is_some()
                && (keyword != TokenKind::Parent_ || scope.parent_name.is_some())
        });
        let checked_use = self.check(TokenKind::DoubleColon)
            && match keyword {
                TokenKind::Static => self.peek_kind() == Some(TokenKind::Class),
                TokenKind::Parent_ => matches!(
                    self.peek_kind(),
                    Some(TokenKind::Variable | TokenKind::Dollar)
                ),
                _ => false,
            };
        if !known || checked_use {
            self.has_class_keyword_ref = true;
        }
    }

    /// Scope for the body of a class-like declaration named `name` (`None` for an anonymous
    /// class) that extends `parent`.
    pub(crate) fn class_scope_for(
        &self,
        name: Option<&str>,
        parent: Option<&Name<'_, '_>>,
        is_trait: bool,
    ) -> ClassScope {
        let name_is_none = name.is_none();
        let name = match (name, &self.namespace) {
            (None, _) => "class@anonymous".to_owned(),
            (Some(name), Some(namespace)) => format!("{namespace}\\{name}"),
            (Some(name), None) => name.to_owned(),
        };
        ClassScope {
            is_anonymous: name_is_none,
            self_name: (!is_trait).then(|| name.clone()),
            parent_name: parent.map(|p| self.resolve_class_name(p)),
            name,
        }
    }

    /// `Name::` of the enclosing class-like declaration, for naming its members in messages.
    pub(crate) fn class_member_prefix(&self) -> String {
        self.class_scope
            .as_ref()
            .map(|scope| format!("{}::", scope.name))
            .unwrap_or_default()
    }

    /// Leave `self` and `parent` unresolved, as PHP does in closures, until
    /// [`restore_class_keywords`](Self::restore_class_keywords).
    pub(crate) fn unresolve_class_keywords(&mut self) -> Option<(Option<String>, Option<String>)> {
        let scope = self.class_scope.as_mut()?;
        Some((scope.self_name.take(), scope.parent_name.take()))
    }

    pub(crate) fn restore_class_keywords(
        &mut self,
        saved: Option<(Option<String>, Option<String>)>,
    ) {
        if let (Some(scope), Some((self_name, parent_name))) = (self.class_scope.as_mut(), saved) {
            scope.self_name = self_name;
            scope.parent_name = parent_name;
        }
    }

    /// The fully qualified name a class name refers to, without the leading `\`.
    pub(crate) fn resolve_class_name(&self, name: &Name<'_, '_>) -> String {
        let parts = name.parts_slice();
        let (base, rest) = match name.kind() {
            NameKind::FullyQualified => return parts.join("\\"),
            NameKind::Relative => (self.namespace.as_deref(), parts),
            _ => match parts.split_first().and_then(|(first, rest)| {
                Some((self.class_imports.get(&first.to_ascii_lowercase())?, rest))
            }) {
                Some((import, rest)) => (Some(import.as_str()), rest),
                None => (self.namespace.as_deref(), parts),
            },
        };
        let mut resolved = base.unwrap_or_default().to_owned();
        for part in rest {
            if !resolved.is_empty() {
                resolved.push('\\');
            }
            resolved.push_str(part);
        }
        resolved
    }

    /// The type as PHP spells it in messages: resolved class names first, then builtin types
    /// in a fixed order, with `iterable` expanded to `Traversable|array`.
    pub(crate) fn type_display(&self, ty: &TypeHint<'_, '_>) -> String {
        let scope = self.class_scope.as_ref();
        match &ty.kind {
            TypeHintKind::Named(name) => self.resolve_class_name(name),
            TypeHintKind::Keyword(builtin @ (BuiltinType::Self_ | BuiltinType::Parent_), span) => {
                // PHP resolves `self` and `parent` in types from 8.5 on, but not in an
                // anonymous class, whose name is generated later.
                let scope = scope.filter(|s| self.version >= PhpVersion::Php85 && !s.is_anonymous);
                let resolved = scope.and_then(|s| match builtin {
                    BuiltinType::Self_ => s.self_name.clone(),
                    _ => s.parent_name.clone(),
                });
                resolved
                    .unwrap_or_else(|| self.source[span.start as usize..span.end as usize].into())
            }
            TypeHintKind::Keyword(BuiltinType::Iterable, _) => "Traversable|array".into(),
            TypeHintKind::Keyword(builtin, _) => builtin.as_str().into(),
            TypeHintKind::Nullable(inner) => format!("?{}", self.type_display(inner)),
            TypeHintKind::Intersection(types) => types
                .iter()
                .map(|t| self.type_display(t))
                .collect::<Vec<_>>()
                .join("&"),
            TypeHintKind::Union(types) => {
                let mut parts = Vec::new();
                let mut builtins = Vec::new();
                for t in types.iter() {
                    match &t.kind {
                        TypeHintKind::Intersection(_) => {
                            parts.push(format!("({})", self.type_display(t)));
                        }
                        TypeHintKind::Keyword(BuiltinType::Iterable, _) => {
                            parts.push("Traversable".into());
                            builtins.push(BuiltinType::Array);
                        }
                        TypeHintKind::Keyword(builtin, _)
                            if !matches!(builtin, BuiltinType::Self_ | BuiltinType::Parent_) =>
                        {
                            builtins.push(*builtin)
                        }
                        _ => parts.push(self.type_display(t)),
                    }
                }
                let has = |b: BuiltinType| builtins.contains(&b);
                for builtin in [
                    BuiltinType::Static,
                    BuiltinType::Callable,
                    BuiltinType::Object,
                    BuiltinType::Array,
                    BuiltinType::String,
                    BuiltinType::Int,
                    BuiltinType::Float,
                ] {
                    if has(builtin) {
                        parts.push(builtin.as_str().into());
                    }
                }
                if has(BuiltinType::Bool) || has(BuiltinType::True) && has(BuiltinType::False) {
                    parts.push("bool".into());
                } else if has(BuiltinType::False) {
                    parts.push("false".into());
                } else if has(BuiltinType::True) {
                    parts.push("true".into());
                }
                for builtin in [BuiltinType::Void, BuiltinType::Never] {
                    if has(builtin) {
                        parts.push(builtin.as_str().into());
                    }
                }
                if has(BuiltinType::Null) {
                    if let [single] = parts.as_slice() {
                        if !single.contains(['|', '&']) {
                            return format!("?{single}");
                        }
                    }
                    parts.push("null".into());
                }
                parts.join("|")
            }
            _ => String::new(),
        }
    }

    /// Lowercase name a class type resolves to, for comparing types; `None` for other types.
    fn class_type_key(&self, ty: &TypeHint<'_, '_>) -> Option<String> {
        match &ty.kind {
            TypeHintKind::Named(_)
            | TypeHintKind::Keyword(BuiltinType::Self_ | BuiltinType::Parent_, _) => {
                Some(self.type_display(ty).to_ascii_lowercase())
            }
            _ => None,
        }
    }

    /// Report builtin types where PHP only allows them alone, builtin types in intersections,
    /// and union members that another member already covers.
    fn check_type_composition(&mut self, type_hint: &TypeHint<'arena, 'src>) {
        match &type_hint.kind {
            TypeHintKind::Nullable(inner) => {
                let TypeHintKind::Keyword(builtin, span) = &inner.kind else {
                    return;
                };
                let (rule, message) = match builtin {
                    // Before 8.0 `mixed` is a class name; its version error is enough.
                    BuiltinType::Mixed if self.version < PhpVersion::Php80 => return,
                    BuiltinType::Mixed => (
                        ForbiddenRule::InvalidNullableType,
                        "Type mixed cannot be marked as nullable since mixed already includes null",
                    ),
                    BuiltinType::Null => (
                        ForbiddenRule::InvalidNullableType,
                        "null cannot be marked as nullable",
                    ),
                    _ => match standalone_type_message(*builtin) {
                        Some(message) => (ForbiddenRule::StandaloneTypeInComposite, message),
                        None => return,
                    },
                };
                self.forbid(rule, message, *span);
            }
            TypeHintKind::Union(types) => {
                for ty in types.iter() {
                    match &ty.kind {
                        TypeHintKind::Keyword(builtin, span) => {
                            if let Some(message) = standalone_type_message(*builtin) {
                                self.forbid(
                                    ForbiddenRule::StandaloneTypeInComposite,
                                    message,
                                    *span,
                                );
                            }
                        }
                        TypeHintKind::Intersection(members) => {
                            self.check_intersection_members(members)
                        }
                        _ => {}
                    }
                }
                self.check_object_with_class_type(type_hint, types);
                self.check_redundant_intersections(types);
            }
            TypeHintKind::Intersection(members) => self.check_intersection_members(members),
            _ => {}
        }
    }

    /// Report a builtin type in an intersection; from PHP 8.5 `self` and `parent` are allowed
    /// where they resolve to a class at compile time.
    fn check_intersection_members(&mut self, members: &[TypeHint<'arena, 'src>]) {
        for ty in members {
            let TypeHintKind::Keyword(builtin, span) = &ty.kind else {
                continue;
            };
            if let BuiltinType::Self_ | BuiltinType::Parent_ = builtin {
                // Outside any class the class scope walk reports them instead.
                let unresolved = self.class_scope.as_ref().is_some_and(|scope| {
                    scope.is_anonymous
                        || scope.self_name.is_none()
                        || *builtin == BuiltinType::Parent_ && scope.parent_name.is_none()
                });
                if !unresolved && self.version >= PhpVersion::Php85 {
                    continue;
                }
            }
            let shown = match builtin {
                BuiltinType::Self_ | BuiltinType::Parent_ => {
                    self.source[span.start as usize..span.end as usize].to_string()
                }
                _ => self.type_display(ty),
            };
            let message = format!("Type {shown} cannot be part of an intersection type");
            self.forbid(ForbiddenRule::BuiltinTypeInIntersection, message, *span);
        }
    }

    /// Report `object` in a union with a class type, which `object` already covers.
    fn check_object_with_class_type(
        &mut self,
        type_hint: &TypeHint<'arena, 'src>,
        types: &[TypeHint<'arena, 'src>],
    ) {
        let has_object = types
            .iter()
            .any(|t| matches!(t.kind, TypeHintKind::Keyword(BuiltinType::Object, _)));
        let has_class = types.iter().any(|t| {
            matches!(
                t.kind,
                TypeHintKind::Named(_)
                    | TypeHintKind::Intersection(_)
                    | TypeHintKind::Keyword(
                        BuiltinType::Self_ | BuiltinType::Parent_ | BuiltinType::Static,
                        _
                    )
            )
        });
        if has_object && has_class {
            let message = format!(
                "Type {} contains both object and a class type, which is redundant",
                self.type_display(type_hint)
            );
            self.forbid(ForbiddenRule::RedundantType, message, type_hint.span);
        }
    }

    /// Report an intersection in a union that is as or more restrictive than an earlier member
    /// (`A|(A&B)`), or an earlier intersection that is more restrictive than a later member.
    fn check_redundant_intersections(&mut self, types: &[TypeHint<'arena, 'src>]) {
        let is_intersection =
            |t: &TypeHint<'_, '_>| matches!(t.kind, TypeHintKind::Intersection(_));
        if !types.iter().any(is_intersection) {
            return;
        }
        let class_sets: Vec<Option<Vec<String>>> = types
            .iter()
            .map(|t| match &t.kind {
                TypeHintKind::Intersection(members) => {
                    members.iter().map(|m| self.class_type_key(m)).collect()
                }
                _ => self.class_type_key(t).map(|key| vec![key]),
            })
            .collect();
        for (i, ty) in types.iter().enumerate() {
            let Some(current) = &class_sets[i] else {
                continue;
            };
            for (j, earlier) in types[..i].iter().enumerate() {
                let Some(previous) = &class_sets[j] else {
                    continue;
                };
                // Repeated single class types are left to the duplicate type check.
                if !is_intersection(ty) && !is_intersection(earlier) {
                    continue;
                }
                let (smaller, larger, smaller_set, larger_set) = if current.len() < previous.len() {
                    (ty, earlier, current, previous)
                } else {
                    (earlier, ty, previous, current)
                };
                if !smaller_set.iter().all(|key| larger_set.contains(key)) {
                    continue;
                }
                let message = if smaller_set.len() == larger_set.len() {
                    format!(
                        "Type {} is redundant with type {}",
                        self.type_display(ty),
                        self.type_display(earlier)
                    )
                } else {
                    format!(
                        "Type {} is redundant as it is more restrictive than type {}",
                        self.type_display(larger),
                        self.type_display(smaller)
                    )
                };
                self.forbid(ForbiddenRule::RedundantType, message, ty.span);
                break;
            }
        }
    }

    /// Report `void` or `never` as a parameter type; returns whether it reported one.
    pub(crate) fn reject_return_only_param_type(&mut self, type_hint: &TypeHint<'_, '_>) -> bool {
        let TypeHintKind::Keyword(builtin @ (BuiltinType::Void | BuiltinType::Never), span) =
            &type_hint.kind
        else {
            return false;
        };
        self.forbid(
            ForbiddenRule::InvalidParameterType,
            format!("{} cannot be used as a parameter type", builtin.as_str()),
            *span,
        );
        true
    }

    /// Report `void`, `never` or `callable` as the type of `member`, a property or class constant
    /// that `subject` (`Property`, `Class constant`) describes.
    pub(crate) fn reject_member_type(
        &mut self,
        type_hint: &TypeHint<'_, '_>,
        subject: &str,
        member: &str,
    ) {
        let is_callable = |t: &TypeHint<'_, '_>| {
            matches!(t.kind, TypeHintKind::Keyword(BuiltinType::Callable, _))
        };
        let invalid = match &type_hint.kind {
            TypeHintKind::Keyword(
                BuiltinType::Void | BuiltinType::Never | BuiltinType::Callable,
                _,
            ) => true,
            TypeHintKind::Nullable(inner) => is_callable(inner),
            TypeHintKind::Union(types) => types.iter().any(is_callable),
            _ => false,
        };
        if !invalid {
            return;
        }
        let class = self.class_member_prefix();
        let message = format!(
            "{subject} {class}{member} cannot have type {}",
            self.type_display(type_hint)
        );
        self.forbid(ForbiddenRule::InvalidMemberType, message, type_hint.span);
    }

    /// Report a builtin type or class keyword written with a namespace, as in `\int`, `\self`,
    /// `namespace\int` or `Foo\int`, which PHP reads as a class name it reserves.
    fn check_qualified_type_names(&mut self, type_hint: &TypeHint<'arena, 'src>) {
        match &type_hint.kind {
            TypeHintKind::Named(name @ Name::Complex { parts, span, .. }) => {
                let Some(last) = parts.last() else { return };
                let relative = name.kind() == NameKind::Relative;
                let fully_qualified = crate::stmt::fully_qualified_class_keyword(name);
                // From 8.5 `static` is a builtin type, so PHP rejects `\static` and `namespace\static`.
                let qualified_static = self.version >= PhpVersion::Php85
                    && (relative || fully_qualified.is_some())
                    && parts.len() == 1
                    && last.eq_ignore_ascii_case("static");
                if qualified_static {
                    self.forbid(
                        ForbiddenRule::QualifiedBuiltinType,
                        "Type declaration 'static' must be unqualified",
                        *span,
                    );
                    return;
                }
                if let Some(text) = fully_qualified {
                    self.forbid(
                        ForbiddenRule::QualifiedClassKeyword,
                        format!("'\\{text}' is an invalid class name"),
                        *span,
                    );
                    return;
                }
                if relative && parts.len() == 1 && crate::stmt::class_keyword(last).is_some() {
                    // `namespace\self` names the class scope like `self` does.
                    self.has_class_keyword_ref = true;
                    return;
                }
                let last = last.to_ascii_lowercase();
                let builtin = matches!(
                    last.as_str(),
                    "int"
                        | "float"
                        | "bool"
                        | "string"
                        | "true"
                        | "false"
                        | "null"
                        | "void"
                        | "iterable"
                        | "object"
                        | "mixed"
                ) || (last == "never" && self.version >= PhpVersion::Php81);
                // PHP lexes `array` and `callable` as keywords, which a qualified name may end
                // in before 8.5.
                let reserved = builtin
                    || matches!(last.as_str(), "self" | "parent" | "static")
                    || (matches!(last.as_str(), "array" | "callable")
                        && self.version >= PhpVersion::Php85);
                let (rule, message) = if parts.len() == 1 && builtin {
                    (
                        ForbiddenRule::QualifiedBuiltinType,
                        format!("Type declaration '{last}' must be unqualified"),
                    )
                } else if reserved {
                    let mut resolved = parts.join("\\");
                    let qualified = name.kind() != NameKind::FullyQualified;
                    if let (true, Some(namespace)) = (qualified, &self.namespace) {
                        resolved = format!("{namespace}\\{resolved}");
                    }
                    (
                        ForbiddenRule::ReservedTypeName,
                        format!("Cannot use \"{resolved}\" as a type name as it is reserved"),
                    )
                } else {
                    return;
                };
                self.forbid(rule, message, *span);
            }
            TypeHintKind::Nullable(inner) => self.check_qualified_type_names(inner),
            TypeHintKind::Union(types) | TypeHintKind::Intersection(types) => {
                for t in types.iter() {
                    self.check_qualified_type_names(t);
                }
            }
            _ => {}
        }
    }

    /// Report a type listed twice in a union or intersection, comparing resolved class names
    /// case-insensitively; `bool` covers `true` and `false`, `iterable` covers `array`.
    fn check_duplicate_types(&mut self, type_hint: &TypeHint<'arena, 'src>) {
        let (types, kind) = match &type_hint.kind {
            TypeHintKind::Union(types) => (types, "union"),
            TypeHintKind::Intersection(types) => (types, "intersection"),
            _ => return,
        };
        let keys: Vec<Option<String>> = types.iter().map(|t| self.type_hint_key(t)).collect();
        let has = |name: &str| keys.iter().any(|k| k.as_deref() == Some(name));
        let (has_bool, has_iterable) = (has("bool"), has("iterable"));
        let mut seen = std::collections::HashSet::new();
        for (ty, key) in types.iter().zip(&keys) {
            let Some(key) = key else { continue };
            let covered = has_bool && matches!(key.as_str(), "true" | "false")
                || has_iterable && matches!(key.as_str(), "array" | "\\traversable");
            if !seen.insert(key.clone()) || covered {
                let text = &self.source[ty.span.start as usize..ty.span.end as usize];
                self.forbid(
                    ForbiddenRule::DuplicateType,
                    format!("Duplicate type '{text}' in {kind} type"),
                    ty.span,
                );
            }
        }
        for ty in types.iter() {
            self.check_duplicate_types(ty);
        }
    }

    /// Comparison key for [`check_duplicate_types`](Self::check_duplicate_types): the builtin
    /// type or the lowercase resolved class name after a `\`. Intersections in a union are compared by
    /// [`check_redundant_intersections`](Self::check_redundant_intersections) instead.
    fn type_hint_key(&self, ty: &TypeHint<'arena, 'src>) -> Option<String> {
        match &ty.kind {
            TypeHintKind::Keyword(builtin, _)
                if !matches!(builtin, BuiltinType::Self_ | BuiltinType::Parent_) =>
            {
                Some(builtin.as_str().into())
            }
            _ => self.class_type_key(ty).map(|key| format!("\\{key}")),
        }
    }

    fn parse_type_hint_unchecked(&mut self) -> TypeHint<'arena, 'src> {
        let start = self.start_span();

        // Nullable: ?Type
        if self.eat(TokenKind::Question).is_some() {
            let inner = self.parse_simple_type();
            let span = Span::new(start, inner.span.end);
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
                self.forbid(
                    ForbiddenRule::RedundantType,
                    "Type contains both true and false, bool must be used instead",
                    span,
                );
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
            if self.peek_kind().is_some_and(starts_intersection_member) {
                let span = self.current_span();
                self.require_version(PhpVersion::Php81, "intersection types", span);

                // Check for invalid outer-form DNF: (A|B)&C
                if let TypeHintKind::Union(_) = &first.kind {
                    self.forbid(
                        ForbiddenRule::UnparenthesizedIntersectionInUnion,
                        "Type declarations cannot be union types, use DNF syntax (A&B)|C instead",
                        first.span,
                    );
                }

                let mut end = first.span.end;
                let mut types = self.alloc_vec_one(first);
                while self.check(TokenKind::Ampersand)
                    && self.peek_kind().is_some_and(starts_intersection_member)
                {
                    self.advance();
                    let t = self.parse_simple_type();
                    end = t.span.end;
                    types.push(t);
                }

                // Check if there's a union after this intersection (DNF: A&B|C&D)
                if self.check(TokenKind::Pipe) {
                    self.require_version(PhpVersion::Php82, "DNF types", Span::new(start, end));
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
                            if !self.peek_kind().is_some_and(starts_intersection_member) {
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
                    return TypeHint {
                        kind: TypeHintKind::Intersection(types),
                        span,
                    };
                }
            }
        }

        // Standalone `null` / `false` require PHP 8.2. (`true` is already
        // 8.2-only via parse_type_element; both union and standalone uses
        // produce the same diagnostic there.)
        if let TypeHintKind::Keyword(builtin, span) = &first.kind {
            match builtin {
                BuiltinType::Null => {
                    self.require_version(PhpVersion::Php82, "null as standalone type", *span);
                }
                BuiltinType::False => {
                    self.require_version(PhpVersion::Php82, "false as standalone type", *span);
                }
                _ => {}
            }
        }

        // A parenthesized intersection `(A&B)` is only valid as part of a DNF union
        // `(A&B)|C`. A standalone `(A&B)` without a following `|` is rejected by PHP.
        // If `first` is an Intersection here, it must have come from `parse_type_element`'s
        // parenthesized branch (parse_simple_type never produces Intersection).
        if let TypeHintKind::Intersection(_) = &first.kind {
            self.forbid(
                ForbiddenRule::ParenthesizedIntersectionOutsideUnion,
                "A parenthesized intersection type can only be used as part of a union type",
                first.span,
            );
        }

        first
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

    /// Parse the content inside parentheses in a type context: an intersection (A&B).
    /// A single type or a union is reported and kept for recovery.
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
                // PHP rejects a union inside the group: (A&B|C)
                self.error_expected("'&' or ')'");
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
                let end = self.previous_end();
                TypeHint {
                    kind: TypeHintKind::Intersection(types),
                    span: Span::new(start, end),
                }
            }
        } else if self.check(TokenKind::Pipe) {
            // PHP rejects a union in parentheses: (A|B)
            self.error_expected("'&'");
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
            // PHP rejects a single type in parentheses: (A)
            self.error_expected("'&'");
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

        // `int\X` is a class in namespace `int`, not the builtin type followed by `\X`.
        if self.peek_kind() == Some(TokenKind::Backslash) && !self.check(TokenKind::Backslash) {
            let name = self.parse_name();
            let span = Span::new(start, name.span().end);
            return TypeHint {
                kind: TypeHintKind::Named(name),
                span,
            };
        }

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
                "float" => Some(BuiltinType::Float),
                "string" => Some(BuiltinType::String),
                "bool" => Some(BuiltinType::Bool),
                "void" => Some(BuiltinType::Void),
                // Before 8.1 `never` is a class name.
                "never" if self.version >= PhpVersion::Php81 => Some(BuiltinType::Never),
                "mixed" => Some(BuiltinType::Mixed),
                "object" => Some(BuiltinType::Object),
                "iterable" => Some(BuiltinType::Iterable),
                "callable" => Some(BuiltinType::Callable),
                _ => None,
            };
            if let Some(builtin) = builtin {
                let token = self.advance();
                if builtin == BuiltinType::Mixed {
                    self.require_version(PhpVersion::Php80, "mixed type", token.span);
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
                self.note_class_keyword(TokenKind::Self_);
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Self_, token.span),
                    span: token.span,
                }
            }
            TokenKind::Parent_ => {
                let token = self.advance();
                self.note_class_keyword(TokenKind::Parent_);
                TypeHint {
                    kind: TypeHintKind::Keyword(BuiltinType::Parent_, token.span),
                    span: token.span,
                }
            }
            TokenKind::Static => {
                let token = self.advance();
                self.require_version(PhpVersion::Php80, "static type", token.span);
                self.note_class_keyword(TokenKind::Static);
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
            let group_start = self.start_span();
            self.advance(); // consume #[
            let group_len_before = attributes.len();

            // Parse comma-separated attributes within this group
            loop {
                if self.check(TokenKind::RightBracket) {
                    break;
                }

                let attr_start = self.start_span();
                let name = self.parse_name();

                let args = if self.check(TokenKind::LeftParen) {
                    let paren_start = self.current_span().start;
                    match crate::expr::parse_arg_list_or_callable(self) {
                        crate::expr::ArgListResult::Args(args) => {
                            for arg in args.iter() {
                                if arg.is_spread() {
                                    self.forbid(
                                        ForbiddenRule::AttributeArgumentUnpacking,
                                        "Cannot use unpacking in attribute argument list",
                                        arg.span,
                                    );
                                } else if let Some(value) = arg.value() {
                                    crate::expr::check_const_expr(self, value, true);
                                }
                            }
                            args
                        }
                        crate::expr::ArgListResult::CallableMarker => {
                            // PHP: "Cannot create Closure as attribute argument".
                            self.forbid(
                                ForbiddenRule::AttributeArgumentClosure,
                                "Cannot create Closure as attribute argument",
                                Span::new(paren_start, self.previous_end()),
                            );
                            self.alloc_vec()
                        }
                    }
                } else {
                    self.alloc_vec()
                };

                let span = self.span_from(attr_start);
                attributes.push({
                    let mut built = Attribute::new(self.arena, name, span);
                    built.args = args;
                    built
                });

                if self.eat(TokenKind::Comma).is_none() {
                    break;
                }
            }

            if attributes.len() == group_len_before {
                self.forbid(
                    ForbiddenRule::EmptyAttributeList,
                    "Attribute list cannot be empty",
                    Span::new(group_start, self.current_span().end),
                );
            }
            self.expect(TokenKind::RightBracket);
        }
        attributes
    }

    /// Parse `<?= expr ?>` — the short echo tag produces an implicit echo statement.
    pub(crate) fn parse_short_echo(&mut self) -> Option<Stmt<'arena, 'src>> {
        if self.check(TokenKind::Eof) || self.check(TokenKind::CloseTag) {
            self.error_expected("expression");
            return None;
        }
        let start = self.start_span();
        // `<?= a, b ?>` behaves like `echo a, b;` — a comma-separated list.
        let mut exprs = self.alloc_vec();
        exprs.push(expr::parse_expr(self));
        while self.eat(TokenKind::Comma).is_some() {
            if self.check(TokenKind::Semicolon) || self.check(TokenKind::CloseTag) {
                self.trailing_comma_error("expression");
                break;
            }
            exprs.push(expr::parse_expr(self));
        }
        self.expect_semicolon("short echo tag");
        let span = self.span_from(start);
        Some(Stmt {
            kind: StmtKind::Echo(exprs),
            span,
            doc_comment: None,
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
                doc_comment: None,
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
            self.error_expected("opening PHP tag");
        }

        self.top_level_code_seen = !stmts.is_empty();

        // Parse statements until EOF
        while !self.check(TokenKind::Eof) {
            let span_before = self.current_span();
            let at_tag = matches!(
                self.current_kind(),
                TokenKind::CloseTag | TokenKind::InlineHtml | TokenKind::OpenTag
            );
            if !at_tag
                && !matches!(
                    self.current_kind(),
                    TokenKind::Declare | TokenKind::Semicolon
                )
            {
                self.top_level_code_seen = true;
            }
            let first_new = stmts.len();
            stmt::push_stmt(self, &mut stmts);
            for stmt in &stmts[first_new..] {
                match stmt.kind {
                    StmtKind::Nop => self.top_level_nop_seen = true,
                    // PHP's `?>` swallows one newline after it.
                    StmtKind::InlineHtml("\n" | "\r" | "\r\n") => {}
                    _ if at_tag => self.top_level_code_seen = true,
                    _ => {}
                }
            }
            // Safety: if parsing made no progress, skip the token to avoid infinite loop
            if self.current_span() == span_before {
                self.advance();
            }
        }

        self.validate_namespace_layout(&stmts);
        if self.void_cast_count > 0 {
            crate::stmt::check_void_casts(self, &stmts);
        }
        if self.empty_dim_count > 0 {
            crate::stmt::check_empty_dims(self, &stmts, &[]);
        }
        if self.has_goto_or_label {
            crate::stmt::check_gotos(self, &stmts);
        }
        if self.has_class_keyword_ref {
            crate::stmt::check_class_keyword_refs(self, &stmts);
        }

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
                    _ => NsKind::Unbraced,
                };
                if let Some((prev_kind, prev_span)) = first_ns {
                    if prev_kind != kind {
                        self.forbid(ForbiddenRule::MixedNamespaceStyles, "Cannot mix bracketed namespace declarations with unbracketed namespace declarations", stmt.span);
                        let _ = prev_span;
                    }
                } else {
                    first_ns = Some((kind, stmt.span));
                    if let Some(noncode_span) = saw_non_ns_before_first_ns {
                        self.forbid(ForbiddenRule::NamespaceNotFirst, "Namespace declaration statement has to be the very first statement or after any declare call in the script", noncode_span);
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
            self.forbid(
                ForbiddenRule::CodeOutsideNamespace,
                "No code may exist outside of namespace {}",
                span,
            );
        }

        // Pass 2: nested namespace inside any braced body.
        for stmt in stmts {
            if let StmtKind::Namespace(decl) = stmt.kind {
                if let php_ast::NamespaceBody::Braced(inner) = decl.body {
                    for s in inner.stmts.iter() {
                        if matches!(s.kind, StmtKind::Namespace(_)) {
                            self.forbid(
                                ForbiddenRule::NestedNamespace,
                                "Namespace declarations cannot be nested",
                                s.span,
                            );
                        }
                    }
                }
            }
        }

        // Pass 3: duplicate `use` alias detection (per UseKind scope, per top-level / per
        // braced namespace body), within and across statements.
        self.validate_use_scope(stmts, true);
        for stmt in stmts {
            if let StmtKind::Namespace(decl) = stmt.kind {
                if let php_ast::NamespaceBody::Braced(inner) = decl.body {
                    self.validate_use_scope(&inner.stmts, false);
                }
            }
        }
    }

    fn validate_use_scope(&mut self, stmts: &[Stmt<'arena, 'src>], top_level: bool) {
        use php_ast::UseKind;
        // Class and function names are case-insensitive, constant names are not.
        let mut seen: std::collections::HashSet<(u8, String)> = std::collections::HashSet::new();

        for stmt in stmts {
            // For top-level calls, track when we enter an unbraced namespace.
            if top_level {
                if let StmtKind::Namespace(decl) = stmt.kind {
                    if matches!(decl.body, php_ast::NamespaceBody::Simple) {
                        // Each unbraced `namespace X;` opens a fresh import scope.
                        seen.clear();
                    }
                    continue;
                }
            }

            let StmtKind::Use(decl) = &stmt.kind else {
                continue;
            };
            for item in decl.uses.iter() {
                let item_kind = item.kind.unwrap_or(decl.kind);
                let parts = item.name.parts_slice();
                let alias = item
                    .alias
                    .and_then(|a| a.as_str())
                    .unwrap_or_else(|| parts.last().copied().unwrap_or(""));
                if alias.is_empty() {
                    continue;
                }
                let key = match item_kind {
                    UseKind::Const => alias.to_string(),
                    _ => alias.to_ascii_lowercase(),
                };
                if !seen.insert((item_kind as u8, key)) {
                    let prefix = match item_kind {
                        UseKind::Function => "function ",
                        UseKind::Const => "const ",
                        _ => "",
                    };
                    self.forbid(
                        ForbiddenRule::UseNameConflict,
                        format!(
                            "Cannot use {prefix}{} as {alias} because the name is already in use",
                            parts.join("\\")
                        ),
                        item.span,
                    );
                }
            }
        }
    }
}

/// Whether PHP 7.4 lexes `word` as a keyword rather than a name.
fn is_reserved_before_80(word: &str) -> bool {
    use php_lexer::token::resolve_keyword;
    match resolve_keyword(word) {
        Some(
            TokenKind::True
            | TokenKind::False
            | TokenKind::Null
            | TokenKind::Self_
            | TokenKind::Parent_
            | TokenKind::Enum_
            | TokenKind::Match_
            | TokenKind::Readonly
            | TokenKind::MagicProperty,
        ) => false,
        Some(_) => true,
        None => ["callable", "insteadof", "var"]
            .iter()
            .any(|k| word.eq_ignore_ascii_case(k)),
    }
}
