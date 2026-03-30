pub mod diagnostics;
pub(crate) mod expr;
pub mod instrument;
pub(crate) mod interpolation;
pub(crate) mod parser;
pub(crate) mod precedence;
pub(crate) mod stmt;
pub mod version;

use diagnostics::ParseError;
use php_ast::Program;
pub use version::PhpVersion;

pub struct ParseResult<'arena, 'src> {
    pub program: Program<'arena, 'src>,
    pub errors: Vec<ParseError>,
}

pub fn parse<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
) -> ParseResult<'arena, 'src> {
    let mut parser = parser::Parser::new(arena, source);
    let program = parser.parse_program();
    ParseResult {
        program,
        errors: parser.into_errors(),
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
        errors: parser.into_errors(),
    }
}
