pub mod diagnostics;
pub(crate) mod expr;
pub(crate) mod interpolation;
pub(crate) mod parser;
pub(crate) mod precedence;
pub(crate) mod stmt;

use diagnostics::ParseError;
use php_ast::Program;

pub struct ParseResult<'src> {
    pub program: Program<'src>,
    pub errors: Vec<ParseError>,
}

pub fn parse(source: &str) -> ParseResult<'_> {
    let mut parser = parser::Parser::new(source);
    let program = parser.parse_program();
    ParseResult {
        program,
        errors: parser.into_errors(),
    }
}
