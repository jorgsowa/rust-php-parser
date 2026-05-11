//! PHPDoc comment parser with structured type AST and byte-offset span tracking.
//!
//! Spans are comment-relative (0-indexed from the start of `/**`). Callers who
//! need file-absolute positions add the comment's start offset to each span.
//!
//! # Quick start
//!
//! ```
//! let text = "/** @param int $x The value */";
//! let doc = php_phpdoc::parse(text);
//! assert_eq!(doc.tags.len(), 1);
//! ```

pub mod ast;
pub mod parser;
pub mod type_parser;

pub use ast::{
    ArrayShapeField, CallableParam, MethodParam, PhpDoc, PhpDocTag, PhpDocTagKind, PhpDocType,
    PhpDocTypeKind,
};
pub use parser::parse;
pub use type_parser::parse_type;
