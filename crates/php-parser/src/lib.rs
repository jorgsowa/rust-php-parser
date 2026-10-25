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
//! Use [`parse_with`] and [`ParseOptions`] to target a specific PHP version.
//! Syntax that requires a higher version is still parsed into the AST, but a
//! [`diagnostics::ParseError::VersionTooLow`] diagnostic is emitted.
//!
//! ```
//! use php_rs_parser::{ParseOptions, PhpVersion};
//!
//! let result = php_rs_parser::parse_with(
//!     "<?php enum Status { case Active; }",
//!     &ParseOptions::default().version(PhpVersion::Php80),
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
//! Set [`ParseOptions::source_map`] to `false` when you never need
//! line/column positions — it skips building the [`source_map::SourceMap`]
//! and is slightly faster.

#![warn(missing_docs)]

#[cfg(doctest)]
#[doc = include_str!("../../../README.md")]
struct ReadmeDoctests;

pub(crate) mod attributes;
/// Parse errors and warnings.
pub mod diagnostics;
pub(crate) mod expr;
/// Parser instrumentation counters, available with the `instrument` feature. Not covered by semver.
#[cfg(feature = "instrument")]
pub mod instrument;
#[cfg(not(feature = "instrument"))]
pub(crate) mod instrument;
pub(crate) mod parser;
/// The arena allocator used by [`parse_arena`] and [`ParserContext`],
/// re-exported so callers use the same version as the AST types.
pub use bumpalo;
pub(crate) mod precedence;
/// Byte offset to line/column mapping.
pub mod source_map;
pub(crate) mod stmt;
/// Target PHP version selection.
pub use php_ast::version;

use diagnostics::ParseError;
use php_ast::owned::Comment as OwnedComment;
use php_ast::{owned::to_owned_program, Comment, Program};
use source_map::SourceMap;
pub use version::PhpVersion;

/// Lifetime-free result of parsing a PHP source string.
///
/// This is the primary return type of [`parse`] and [`parse_with`]. The
/// AST is fully owned (`Box<str>`, `Box<[T]>`) so it can be stored in a
/// `HashMap`, sent across threads, or cached alongside other data without
/// fighting the borrow checker.
///
/// Use [`parse_arena`] or [`ParserContext`] when you need the arena-allocated
/// form for maximum throughput in tight loops or LSP re-parse scenarios.
#[derive(Debug, Clone)]
#[non_exhaustive]
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
/// Returned by [`parse_arena`], [`parse_arena_with`], and
/// [`ParserContext::reparse`]. Both the AST and the source text are borrowed,
/// so this type has two lifetime parameters. Use [`ParseResult`] (from
/// [`parse`]) when you need an owned, lifetime-free result.
#[derive(Debug)]
#[non_exhaustive]
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
    /// [`php_ast::visitor::walk_comments`] with a [`Visitor`](php_ast::visitor::Visitor) that also
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

/// Options for [`parse_with`], [`parse_arena_with`] and [`ParserContext::with_options`].
///
/// ```
/// use php_rs_parser::{ParseOptions, PhpVersion};
///
/// let options = ParseOptions::default().version(PhpVersion::Php80);
/// let result = php_rs_parser::parse_with("<?php enum Status {}", &options);
/// assert!(!result.errors.is_empty()); // enums require PHP 8.1
/// ```
#[derive(Debug, Clone, PartialEq, Eq)]
#[non_exhaustive]
pub struct ParseOptions {
    /// Target PHP version; newer syntax is parsed but reported as [`ParseError::VersionTooLow`].
    pub version: PhpVersion,
    /// Whether to build `result.source_map`; when `false` it is left empty. Defaults to `true`.
    pub source_map: bool,
}

impl Default for ParseOptions {
    fn default() -> Self {
        Self {
            version: PhpVersion::default(),
            source_map: true,
        }
    }
}

impl ParseOptions {
    /// Sets [`version`](Self::version).
    pub fn version(mut self, version: PhpVersion) -> Self {
        self.version = version;
        self
    }

    /// Sets [`source_map`](Self::source_map).
    pub fn source_map(mut self, source_map: bool) -> Self {
        self.source_map = source_map;
        self
    }
}

/// Parse PHP `source` with the default [`ParseOptions`].
///
/// Returns a fully-owned [`ParseResult`] with no lifetime parameters. The
/// internal arena is created, used, and converted within this call.
///
/// Use [`parse_arena`] when you need the raw arena-allocated AST for maximum
/// throughput (no allocation copying).
///
/// `source` must be UTF-8: convert legacy-encoded files first, or read them with
/// [`String::from_utf8_lossy`] and accept that spans after an invalid byte are shifted.
pub fn parse(source: &str) -> ParseResult {
    parse_with(source, &ParseOptions::default())
}

/// Parse PHP `source` with the given `options`, returning a fully-owned [`ParseResult`].
pub fn parse_with(source: &str, options: &ParseOptions) -> ParseResult {
    let arena = bumpalo::Bump::new();
    ParseResult::from_arena_result(parse_arena_with(&arena, source, options))
}

/// Parse PHP `source` with the default [`ParseOptions`], returning an
/// arena-allocated [`ArenaParseResult`].
///
/// The `arena` is used for all AST allocations, giving callers control over
/// memory lifetime. The returned result borrows from both the arena and the
/// source string.
///
/// Prefer [`parse`] unless you are managing the arena yourself for performance
/// reasons (e.g. LSP re-parsing with [`ParserContext`]).
pub fn parse_arena<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
) -> ArenaParseResult<'arena, 'src> {
    parse_arena_with(arena, source, &ParseOptions::default())
}

/// Parse PHP `source` with the given `options`, returning an arena-allocated
/// [`ArenaParseResult`].
///
/// Spans are `u32`, so a source over 4 GiB yields an empty program and [`ParseError::SourceTooLarge`].
pub fn parse_arena_with<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    options: &ParseOptions,
) -> ArenaParseResult<'arena, 'src> {
    if source.len() > u32::MAX as usize {
        return ArenaParseResult {
            source,
            program: Program {
                stmts: php_ast::ArenaVec::new_in(arena),
                span: php_ast::Span::new(0, 0),
            },
            comments: Vec::new(),
            errors: vec![ParseError::SourceTooLarge {
                len: source.len(),
                span: php_ast::Span::new(0, 0),
            }],
            errors_truncated: false,
            source_map: SourceMap::empty(),
        };
    }
    let mut parser = parser::Parser::with_version(arena, source, options.version);
    let program = parser.parse_program();
    let errors_truncated = parser.errors_truncated();
    ArenaParseResult {
        source,
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        errors_truncated,
        source_map: if options.source_map {
            SourceMap::new(source)
        } else {
            SourceMap::empty()
        },
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
/// borrows from `self`, so the borrow checker prevents calling
/// [`reparse`](ParserContext::reparse) again while the previous result is
/// still alive.
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
#[derive(Debug)]
pub struct ParserContext {
    arena: bumpalo::Bump,
    options: ParseOptions,
}

impl ParserContext {
    /// Create a new context with an empty arena and the default [`ParseOptions`].
    pub fn new() -> Self {
        Self::with_options(ParseOptions::default())
    }

    /// Create a new context with an empty arena that parses with `options`.
    pub fn with_options(options: ParseOptions) -> Self {
        Self {
            arena: bumpalo::Bump::new(),
            options,
        }
    }

    /// The options used by every reparse.
    pub fn options(&self) -> &ParseOptions {
        &self.options
    }

    /// Replace the options used by later reparses, keeping the arena.
    pub fn set_options(&mut self, options: ParseOptions) {
        self.options = options;
    }

    /// Reset the arena and parse `source`.
    ///
    /// The previous [`ArenaParseResult`] **must be dropped** before calling
    /// this method. The borrow checker enforces this: the returned result
    /// borrows `self` for the duration of its lifetime, so a second call while
    /// the first result is still live is a compile-time error.
    pub fn reparse<'a, 'src>(&'a mut self, source: &'src str) -> ArenaParseResult<'a, 'src> {
        self.arena.reset();
        parse_arena_with(&self.arena, source, &self.options)
    }

    /// Reset the arena and parse `source`, returning a fully-owned [`ParseResult`].
    ///
    /// Unlike [`reparse`](ParserContext::reparse), the returned result has no
    /// lifetime parameters and can be stored anywhere. The arena is reused for
    /// the parse but the output is immediately converted to owned types, so
    /// there is no borrow on `self` after this call returns.
    pub fn reparse_owned(&mut self, source: &str) -> ParseResult {
        self.arena.reset();
        ParseResult::from_arena_result(parse_arena_with(&self.arena, source, &self.options))
    }
}

impl Default for ParserContext {
    fn default() -> Self {
        Self::new()
    }
}
