pub mod parser;
pub mod stmt;
pub mod expr;
pub mod precedence;
pub mod diagnostics;
pub mod interpolation;

use php_ast::Program;
use diagnostics::ParseError;

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
