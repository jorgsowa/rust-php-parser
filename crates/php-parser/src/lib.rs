pub mod diagnostics;
pub mod expr;
pub mod interpolation;
pub mod parser;
pub mod precedence;
pub mod stmt;

use diagnostics::ParseError;
use php_ast::Program;

pub struct ParseResult {
    pub program: Program,
    pub errors: Vec<ParseError>,
}

pub fn parse(source: &str) -> ParseResult {
    let mut parser = parser::Parser::new(source);
    let program = parser.parse_program();
    ParseResult {
        program,
        errors: parser.into_errors(),
    }
}
