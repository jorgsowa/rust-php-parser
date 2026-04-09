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

pub mod diagnostics;
pub(crate) mod expr;
pub mod instrument;
pub(crate) mod interpolation;
pub(crate) mod parser;
pub mod phpdoc;
pub(crate) mod precedence;
pub(crate) mod stmt;
pub mod version;

use diagnostics::ParseError;
use php_ast::source_map::SourceMap;
use php_ast::{Comment, Program};
pub use version::PhpVersion;

/// The result of parsing a PHP source string.
pub struct ParseResult<'arena, 'src> {
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
        program,
        comments: parser.take_comments(),
        errors: parser.into_errors(),
        source_map: SourceMap::new(source),
    }
}
