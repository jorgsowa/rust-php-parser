pub mod ast;
pub mod comment_map;
pub mod source_map;
pub mod span;
pub mod symbol_table;
pub mod visitor;

pub use ast::*;
pub use span::{LineIndex, Span};

// Re-export PHPDoc types at crate root for convenience
pub use ast::{PhpDoc, PhpDocTag};
