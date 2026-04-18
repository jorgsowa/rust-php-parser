//! Fast, fault-tolerant PHP parser that produces a fully typed AST.
//!
//! This crate parses PHP source code (PHP 8.0–8.5) into a [`php_ast::Program`]
//! tree, recovering from syntax errors so that downstream tools always receive
//! a complete AST.
//!
//! # Quick start
//!
//! ```
//! let arena = bumpalo::Bump::new();
//! let result = php_rs_parser::parse(&arena, "<?php echo 'hello';");
//! assert!(result.errors.is_empty());
//! ```
//!
//! # Version-aware parsing
//!
//! Use [`parse_versioned`] to target a specific PHP version. Syntax that
//! requires a higher version is still parsed into the AST, but a
//! [`diagnostics::ParseError::VersionTooLow`] diagnostic is emitted.
//!
//! ```
//! let arena = bumpalo::Bump::new();
//! let result = php_rs_parser::parse_versioned(
//!     &arena,
//!     "<?php enum Status { case Active; }",
//!     php_rs_parser::PhpVersion::Php80,
//! );
//! assert!(!result.errors.is_empty()); // enums require PHP 8.1
//! ```
//!
//! # Reusing arenas across re-parses (LSP usage)
//!
//! Use [`ParserContext`] to avoid allocator churn when the same document is
//! re-parsed on every edit. The context owns a `bumpalo::Bump` arena and resets
//! it in O(1) before each parse, reusing the backing memory once it has grown
//! to a stable size.
//!
//! ```
//! let mut ctx = php_rs_parser::ParserContext::new();
//!
//! let result = ctx.reparse("<?php echo 1;");
//! assert!(result.errors.is_empty());
//! drop(result); // must be dropped before the next reparse
//!
//! let result = ctx.reparse("<?php echo 2;");
//! assert!(result.errors.is_empty());
//! ```

pub mod diagnostics;
pub(crate) mod expr;
pub mod instrument;
pub(crate) mod interpolation;
pub(crate) mod parser;
pub mod phpdoc;
pub(crate) mod precedence;
pub mod source_map;
pub(crate) mod stmt;
pub mod version;

use diagnostics::ParseError;
use php_ast::{Comment, Program, Stmt};
use php_lexer::TokenKind;
use source_map::SourceMap;
pub use version::PhpVersion;

/// The result of parsing a PHP source string.
pub struct ParseResult<'arena, 'src> {
    /// The original source text. Useful for extracting text from spans
    /// via `&result.source[span.start as usize..span.end as usize]`.
    pub source: &'src str,
    /// The parsed AST. Always produced, even when errors are present.
    pub program: Program<'arena, 'src>,
    /// All comments found in the source, in source order.
    /// Comments are not attached to AST nodes; callers can map them by span.
    pub comments: Vec<Comment<'src>>,
    /// Parse errors and diagnostics. Empty on a successful parse.
    pub errors: Vec<ParseError>,
    /// Pre-computed line index for resolving byte offsets in [`Span`](php_ast::Span)
    /// to line/column positions. Use [`SourceMap::offset_to_line_col`] or
    /// [`SourceMap::span_to_line_col`] to convert.
    pub source_map: SourceMap,
}

/// Parse PHP `source` using the latest supported PHP version (currently 8.5).
///
/// The `arena` is used for all AST allocations, giving callers control over
/// memory lifetime. The returned [`ParseResult`] borrows from both the arena
/// and the source string.
pub fn parse<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
) -> ParseResult<'arena, 'src> {
    let mut parser = parser::Parser::new(arena, source);
    let program = parser.parse_program();
    ParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        source_map: SourceMap::new(source),
    }
}

/// Parse `source` targeting the given PHP `version`.
///
/// Syntax that requires a higher version than `version` is still parsed and
/// included in the AST, but a [`diagnostics::ParseError::VersionTooLow`] error
/// is also emitted so callers can report it to the user.
pub fn parse_versioned<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    version: PhpVersion,
) -> ParseResult<'arena, 'src> {
    let mut parser = parser::Parser::with_version(arena, source, version);
    let program = parser.parse_program();
    ParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        source_map: SourceMap::new(source),
    }
}

/// The result of parsing a single PHP statement.
pub struct StmtResult<'arena, 'src> {
    /// The parsed statement, or `None` if the offset points to end-of-file or
    /// only whitespace/comments remain.
    pub stmt: Option<Stmt<'arena, 'src>>,
    /// All comments found from `offset` to the end of the consumed statement.
    pub comments: Vec<Comment<'src>>,
    /// Parse errors and diagnostics. Empty on a successful parse.
    pub errors: Vec<ParseError>,
}

/// Parse a single PHP statement from `source` starting at byte `offset`.
///
/// The parser starts in **PHP mode** (not inline HTML mode), so
/// `source[offset..]` must contain a PHP statement without a `<?php` open tag.
/// Spans in the returned statement are absolute byte offsets into `source`.
///
/// Returns `None` for [`StmtResult::stmt`] if the source at `offset` is empty
/// or only contains whitespace/comments.
///
/// # Example
///
/// ```
/// let arena = bumpalo::Bump::new();
/// let source = "<?php $x = 1; $y = 2;";
/// // offset 6 skips "<?php " and lands on "$x = 1;"
/// let result = php_rs_parser::parse_statement(&arena, source, 6);
/// assert!(result.errors.is_empty());
/// assert!(result.stmt.is_some());
/// ```
pub fn parse_statement<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    offset: usize,
) -> StmtResult<'arena, 'src> {
    parse_statement_versioned(arena, source, offset, PhpVersion::default())
}

/// Parse a single PHP statement targeting the given PHP `version`.
///
/// See [`parse_statement`] for details on the `offset` parameter and return value.
pub fn parse_statement_versioned<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    offset: usize,
    version: PhpVersion,
) -> StmtResult<'arena, 'src> {
    let mut parser = parser::Parser::new_at(arena, source, offset, version);
    if parser.check(TokenKind::Eof) {
        return StmtResult {
            stmt: None,
            comments: parser.take_comments(),
            errors: parser.into_errors(),
        };
    }
    let stmt = stmt::parse_stmt(&mut parser);
    StmtResult {
        stmt: Some(stmt),
        comments: parser.take_comments(),
        errors: parser.into_errors(),
    }
}

/// A reusable parse context that keeps a `bumpalo::Bump` arena alive between
/// re-parses, resetting it (O(1)) instead of dropping and reallocating.
///
/// This is the preferred entry point for LSP servers or any tool that parses
/// the same document repeatedly. Once the arena has grown to accommodate the
/// largest document seen, subsequent parses reuse the backing memory without
/// any new allocations.
///
/// The Rust lifetime system enforces safety: the returned [`ParseResult`]
/// borrows from `self`, so the borrow checker prevents calling [`reparse`] or
/// [`reparse_versioned`] again while the previous result is still alive.
///
/// [`reparse`]: ParserContext::reparse
/// [`reparse_versioned`]: ParserContext::reparse_versioned
///
/// # Example
///
/// ```
/// let mut ctx = php_rs_parser::ParserContext::new();
///
/// let result = ctx.reparse("<?php echo 1;");
/// assert!(result.errors.is_empty());
/// drop(result); // must be dropped before the next reparse
///
/// let result = ctx.reparse("<?php echo 2;");
/// assert!(result.errors.is_empty());
/// ```
pub struct ParserContext {
    arena: bumpalo::Bump,
}

impl ParserContext {
    /// Create a new context with an empty arena.
    pub fn new() -> Self {
        Self {
            arena: bumpalo::Bump::new(),
        }
    }

    /// Reset the arena and parse `source` using PHP 8.5 (the latest version).
    ///
    /// The previous [`ParseResult`] **must be dropped** before calling this
    /// method. The borrow checker enforces this: the returned result borrows
    /// `self` for the duration of its lifetime, so a second call while the
    /// first result is still live is a compile-time error.
    pub fn reparse<'a, 'src>(&'a mut self, source: &'src str) -> ParseResult<'a, 'src> {
        self.arena.reset();
        parse(&self.arena, source)
    }

    /// Reset the arena and parse `source` targeting the given PHP `version`.
    ///
    /// See [`reparse`](ParserContext::reparse) for lifetime safety notes.
    pub fn reparse_versioned<'a, 'src>(
        &'a mut self,
        source: &'src str,
        version: PhpVersion,
    ) -> ParseResult<'a, 'src> {
        self.arena.reset();
        parse_versioned(&self.arena, source, version)
    }
}

impl Default for ParserContext {
    fn default() -> Self {
        Self::new()
    }
}
