//! Fast, fault-tolerant PHP parser that produces a fully typed AST.
//!
//! This crate parses PHP source code (PHP 7.4–8.5, plus PHP 8.6 partial function
//! application) into a [`php_ast::Program`] tree, recovering from syntax errors
//! so that downstream tools always receive a complete AST.
//!
//! # Semantic-rejection responsibility
//!
//! The parser is fault-tolerant: it always produces an AST and reports every
//! error it can identify before recovering. Its semantic-rejection
//! responsibility is defined externally:
//!
//! > **For any input, the parser emits at least one diagnostic iff `php -l`
//! > would reject that input at the configured target PHP version.**
//!
//! Flow-sensitive checks — cross-file resolution, unused variables, dead code,
//! type-mismatched returns — are out of scope and belong in a later semantic
//! layer. Checks decidable from one declaration, one parameter list, one
//! modifier set, or one declaration loop are in scope and use
//! [`diagnostics::ParseError::Forbidden`].
//!
//! The `===php_error===` section in `tests/fixtures/**/*.phpt` records `php -l`
//! output; the fixture runner enforces the rule above by failing CI when PHP
//! rejects an input that the parser silently accepts.
//!
//! # Quick start
//!
//! ```
//! let result = php_rs_parser::parse("<?php echo 'hello';");
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
//! let result = php_rs_parser::parse_versioned(
//!     "<?php enum Status { case Active; }",
//!     php_rs_parser::PhpVersion::Php80,
//! );
//! assert!(!result.errors.is_empty()); // enums require PHP 8.1
//! ```
//!
//! # Multi-file cache
//!
//! [`parse`] returns a [`ParseResult`] with no lifetime parameters — fully
//! owned, storable in a `HashMap`, sendable across threads.
//!
//! ```
//! use std::collections::HashMap;
//! use std::path::PathBuf;
//!
//! let mut cache: HashMap<PathBuf, php_rs_parser::ParseResult> = HashMap::new();
//! cache.insert(PathBuf::from("a.php"), php_rs_parser::parse("<?php echo 1;"));
//! ```
//!
//! # Arena API (LSP / hot-path usage)
//!
//! Use [`parse_arena`] / [`ParserContext`] when you need maximum throughput
//! and can manage the arena lifetime yourself. The returned
//! [`ArenaParseResult`] borrows from both the arena and the source string —
//! no allocation copying occurs.
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
//!
//! Use [`parse_arena_raw`] instead of [`parse_arena`] when you never need
//! line/column positions — it skips building the [`source_map::SourceMap`]
//! and is slightly faster.

pub mod diagnostics;
pub(crate) mod expr;
pub mod instrument;
pub(crate) mod parser;
pub use phpdoc_parser as phpdoc;
pub(crate) mod precedence;
pub mod source_map;
pub(crate) mod stmt;
pub mod version;

use diagnostics::ParseError;
use php_ast::owned::Comment as OwnedComment;
use php_ast::{owned::to_owned_program, Comment, Program};
use source_map::SourceMap;
pub use version::PhpVersion;

/// Lifetime-free result of parsing a PHP source string.
///
/// This is the primary return type of [`parse`] and [`parse_versioned`]. The
/// AST is fully owned (`Box<str>`, `Box<[T]>`) so it can be stored in a
/// `HashMap`, sent across threads, or cached alongside other data without
/// fighting the borrow checker.
///
/// Use [`parse_arena`] or [`ParserContext`] when you need the arena-allocated
/// form for maximum throughput in tight loops or LSP re-parse scenarios.
pub struct ParseResult {
    /// The original source text, owned.
    pub source: String,
    /// The parsed AST, fully owned with no lifetime parameters.
    pub program: php_ast::owned::Program,
    /// All comments found in the source, in source order. Doc-block comments
    /// attached to a declaration are stored in the declaration node's
    /// `doc_comment` field, not here.
    pub comments: Vec<php_ast::owned::Comment>,
    /// Parse errors and diagnostics. Empty on a successful parse.
    pub errors: Vec<ParseError>,
    /// `true` when the error list was capped and further errors were dropped.
    pub errors_truncated: bool,
    /// Pre-computed line index for span-to-line/column resolution.
    pub source_map: SourceMap,
}

impl ParseResult {
    fn from_arena_result(result: ArenaParseResult<'_, '_>) -> Self {
        let program = to_owned_program(&result.program);
        let comments = result
            .comments
            .iter()
            .map(|c| OwnedComment {
                kind: c.kind,
                text: c.text.into(),
                span: c.span,
            })
            .collect();
        Self {
            source: result.source.to_owned(),
            program,
            comments,
            errors: result.errors,
            errors_truncated: result.errors_truncated,
            source_map: result.source_map,
        }
    }
}

/// Arena-allocated result of parsing a PHP source string.
///
/// Returned by [`parse_arena`], [`parse_arena_versioned`], and
/// [`ParserContext::reparse`]. Both the AST and the source text are borrowed,
/// so this type has two lifetime parameters. Use [`ParseResult`] (from
/// [`parse`]) when you need an owned, lifetime-free result.
pub struct ArenaParseResult<'arena, 'src> {
    /// The original source text. Useful for extracting text from spans
    /// via `&result.source[span.start as usize..span.end as usize]`.
    pub source: &'src str,
    /// The parsed AST. Always produced, even when errors are present.
    pub program: Program<'arena, 'src>,
    /// All comments found in the source, in source order, **except** `/** */`
    /// doc-block comments that are immediately attached to a declaration.
    ///
    /// When the parser encounters a `/** */` comment directly before a
    /// function, class, method, property, constant, or enum case, it removes
    /// that comment from this list and stores it in the declaration node's
    /// `doc_comment` field instead. The two collections are therefore
    /// **disjoint**: iterating both without deduplication will double-count
    /// nothing, but iterating only one will miss the other's entries.
    ///
    /// To process every comment in the file, iterate `result.comments` (for
    /// line, hash, block, and unattached doc comments) and also visit each
    /// declaration node's `doc_comment` field. Or use
    /// [`php_ast::visitor::walk_comments`] with a [`Visitor`] that also
    /// overrides the declaration visit methods.
    pub comments: Vec<Comment<'src>>,
    /// Parse errors and diagnostics. Empty on a successful parse.
    pub errors: Vec<ParseError>,
    /// `true` when the error list was capped at the internal limit and further
    /// errors were silently dropped. Callers that need a complete error list
    /// (e.g. linters) should treat this as an incomplete result.
    pub errors_truncated: bool,
    /// Pre-computed line index for resolving byte offsets in [`Span`](php_ast::Span)
    /// to line/column positions. Use [`SourceMap::offset_to_line_col`] or
    /// [`SourceMap::span_to_line_col`] to convert.
    pub source_map: SourceMap,
}

/// Parse PHP `source` using the latest supported PHP version (currently 8.5).
///
/// Returns a fully-owned [`ParseResult`] with no lifetime parameters. The
/// internal arena is created, used, and converted within this call.
///
/// Use [`parse_arena`] when you need the raw arena-allocated AST for maximum
/// throughput (no allocation copying).
pub fn parse(source: &str) -> ParseResult {
    let arena = bumpalo::Bump::new();
    ParseResult::from_arena_result(parse_arena(&arena, source))
}

/// Parse `source` targeting the given PHP `version`.
///
/// Syntax that requires a higher version than `version` is still parsed and
/// included in the AST, but a [`diagnostics::ParseError::VersionTooLow`] error
/// is also emitted so callers can report it to the user.
///
/// Returns a fully-owned [`ParseResult`]. Use [`parse_arena_versioned`] for the
/// arena form.
pub fn parse_versioned(source: &str, version: PhpVersion) -> ParseResult {
    let arena = bumpalo::Bump::new();
    ParseResult::from_arena_result(parse_arena_versioned(&arena, source, version))
}

/// Parse PHP `source` using the latest supported PHP version, returning an
/// arena-allocated [`ArenaParseResult`].
///
/// The `arena` is used for all AST allocations, giving callers control over
/// memory lifetime. The returned result borrows from both the arena and the
/// source string.
///
/// Prefer [`parse`] unless you are managing the arena yourself for performance
/// reasons (e.g. LSP re-parsing with [`ParserContext`]). Use [`parse_arena_raw`]
/// when you never need line/column positions from `result.source_map`.
pub fn parse_arena<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
) -> ArenaParseResult<'arena, 'src> {
    let mut parser = parser::Parser::new(arena, source);
    let program = parser.parse_program();
    let errors_truncated = parser.errors_truncated();
    ArenaParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        errors_truncated,
        source_map: SourceMap::new(source),
    }
}

/// Like [`parse_arena`], but skips building the [`source_map::SourceMap`].
///
/// `result.source_map` is a no-op empty map. Use this when you only need the
/// AST and errors — formatters, linters, and batch processors that never call
/// `source_map.offset_to_line_col` or `source_map.span_to_line_col`.
pub fn parse_arena_raw<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
) -> ArenaParseResult<'arena, 'src> {
    let mut parser = parser::Parser::new(arena, source);
    let program = parser.parse_program();
    let errors_truncated = parser.errors_truncated();
    ArenaParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        errors_truncated,
        source_map: SourceMap::empty(),
    }
}

/// Parse `source` targeting the given PHP `version`, returning an
/// arena-allocated [`ArenaParseResult`].
///
/// See [`parse_arena`] for arena lifetime semantics and [`parse_versioned`] for
/// version-gating behaviour.
pub fn parse_arena_versioned<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    version: PhpVersion,
) -> ArenaParseResult<'arena, 'src> {
    let mut parser = parser::Parser::with_version(arena, source, version);
    let program = parser.parse_program();
    let errors_truncated = parser.errors_truncated();
    ArenaParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        errors_truncated,
        source_map: SourceMap::new(source),
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
/// The Rust lifetime system enforces safety: the returned [`ArenaParseResult`]
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
    /// The previous [`ArenaParseResult`] **must be dropped** before calling
    /// this method. The borrow checker enforces this: the returned result
    /// borrows `self` for the duration of its lifetime, so a second call while
    /// the first result is still live is a compile-time error.
    pub fn reparse<'a, 'src>(&'a mut self, source: &'src str) -> ArenaParseResult<'a, 'src> {
        self.arena.reset();
        parse_arena(&self.arena, source)
    }

    /// Reset the arena and parse `source` targeting the given PHP `version`.
    ///
    /// See [`reparse`](ParserContext::reparse) for lifetime safety notes.
    pub fn reparse_versioned<'a, 'src>(
        &'a mut self,
        source: &'src str,
        version: PhpVersion,
    ) -> ArenaParseResult<'a, 'src> {
        self.arena.reset();
        parse_arena_versioned(&self.arena, source, version)
    }

    /// Reset the arena and parse `source`, returning a fully-owned [`ParseResult`].
    ///
    /// Unlike [`reparse`](ParserContext::reparse), the returned result has no
    /// lifetime parameters and can be stored anywhere. The arena is reused for
    /// the parse but the output is immediately converted to owned types, so
    /// there is no borrow on `self` after this call returns.
    pub fn reparse_owned(&mut self, source: &str) -> ParseResult {
        self.arena.reset();
        ParseResult::from_arena_result(parse_arena(&self.arena, source))
    }

    /// Reset the arena and parse `source` targeting the given PHP `version`,
    /// returning a fully-owned [`ParseResult`].
    ///
    /// See [`reparse_owned`](ParserContext::reparse_owned) for ownership notes
    /// and [`reparse_versioned`](ParserContext::reparse_versioned) for version
    /// semantics.
    pub fn reparse_owned_versioned(&mut self, source: &str, version: PhpVersion) -> ParseResult {
        self.arena.reset();
        ParseResult::from_arena_result(parse_arena_versioned(&self.arena, source, version))
    }
}

impl Default for ParserContext {
    fn default() -> Self {
        Self::new()
    }
}
