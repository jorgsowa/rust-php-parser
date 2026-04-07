pub mod ast;
pub mod span;
pub mod visitor;

pub use ast::*;
pub use span::Span;

// Re-export PHPDoc types at crate root for convenience
pub use ast::{PhpDoc, PhpDocTag};
