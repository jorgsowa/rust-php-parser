pub mod diagnostics;
pub(crate) mod expr;
pub(crate) mod interpolation;
pub(crate) mod parser;
pub(crate) mod precedence;
pub(crate) mod stmt;

use diagnostics::ParseError;
use php_ast::Program;

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
