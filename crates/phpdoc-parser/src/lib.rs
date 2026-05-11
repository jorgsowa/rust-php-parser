//! Structural PHPDoc comment parser.
//!
//! Parses `/** ... */` documentation blocks into a structured AST with accurate
//! spans and support for inline tags. Designed for type checkers, linters, IDEs,
//! and documentation generators.
//!
//! The crate is **agnostic** — it does not interpret tag semantics or parse type
//! expressions. Tag bodies are exposed as raw [`PhpDocText`], letting tools apply
//! their own type parsers and validation rules.
//!
//! # Quick start
//!
//! ```
//! use phpdoc_parser::parse;
//!
//! let text = "/** @param int $x The value */";
//! let doc = parse(text);
//! assert_eq!(doc.tags.len(), 1);
//! assert_eq!(doc.tags[0].name, "param");
//! ```
//!
//! # Common patterns
//!
//! ### Read a tag body
//!
//! ```
//! use phpdoc_parser::{parse, find_tags, body_text};
//!
//! let doc = parse("/** @param int $x The mapping */");
//! for param in find_tags(&doc, "param") {
//!     let body = body_text(&param.body).unwrap_or_default();
//!     // body is "int $x The mapping" — parse the type yourself
//! }
//! ```
//!
//! ### Find inline references
//!
//! ```
//! use phpdoc_parser::{parse, inline_tags};
//!
//! let doc = parse("/** See {@link User::load()} for details. */");
//! if let Some(desc) = &doc.description {
//!     for tag in inline_tags(desc) {
//!         if tag.name == "link" {
//!             // Process the reference to User::load()
//!         }
//!     }
//! }
//! ```

pub(crate) mod ast;
pub(crate) mod parser;
pub(crate) mod span;

pub use ast::{InlineTag, PhpDoc, PhpDocTag, PhpDocText, TextSegment};
pub use parser::parse;
pub use span::Span;

// =============================================================================
// Utility functions for common tasks
// =============================================================================

/// Find the first tag with the given name.
///
/// # Example
/// ```
/// use phpdoc_parser::{parse, find_tag};
/// let doc = parse("/** @param int $x @return string */");
/// assert!(find_tag(&doc, "param").is_some());
/// assert!(find_tag(&doc, "throws").is_none());
/// ```
pub fn find_tag<'d>(doc: &'d PhpDoc, name: &str) -> Option<&'d PhpDocTag> {
    doc.tags.iter().find(|t| t.name == name)
}

/// Find all tags with the given name.
///
/// # Example
/// ```
/// use phpdoc_parser::{parse, find_tags};
/// let doc = parse("/**\n * @param int $x\n * @param string $y\n */");
/// assert_eq!(find_tags(&doc, "param").len(), 2);
/// ```
pub fn find_tags<'d>(doc: &'d PhpDoc, name: &str) -> Vec<&'d PhpDocTag> {
    doc.tags.iter().filter(|t| t.name == name).collect()
}

/// Reconstruct the text content of a `PhpDocText`, including inline tags.
///
/// Inline tags are reconstructed as `{@name body}` format.
///
/// # Example
/// ```
/// use phpdoc_parser::{parse, text_content};
/// let doc = parse("/** See {@link Foo} for details. */");
/// let summary = text_content(doc.summary.as_ref().unwrap());
/// assert!(summary.contains("@link"));
/// ```
pub fn text_content(text: &PhpDocText) -> String {
    text.segments
        .iter()
        .map(|seg| match seg {
            TextSegment::Text(t) => t.clone(),
            TextSegment::InlineTag(tag) => {
                format!(
                    "{{@{}{}}}",
                    tag.name,
                    tag.body
                        .as_ref()
                        .map(|b| format!(" {}", b))
                        .unwrap_or_default()
                )
            }
        })
        .collect()
}

/// Get the text content of a tag body, if present.
///
/// # Example
/// ```
/// use phpdoc_parser::{parse, find_tag, body_text};
/// let doc = parse("/** @param int $x */");
/// let param = find_tag(&doc, "param").unwrap();
/// let text = body_text(&param.body).unwrap();
/// assert!(text.contains("$x"));
/// ```
pub fn body_text(body: &Option<PhpDocText>) -> Option<String> {
    body.as_ref().map(text_content)
}

/// Extract all inline tags from a text segment.
///
/// # Example
/// ```
/// use phpdoc_parser::{parse, inline_tags};
/// let doc = parse("/** See {@link Foo} and {@link Bar}. */");
/// let tags = inline_tags(doc.summary.as_ref().unwrap());
/// assert_eq!(tags.len(), 2);
/// ```
pub fn inline_tags(text: &PhpDocText) -> Vec<&InlineTag> {
    text.segments
        .iter()
        .filter_map(|seg| match seg {
            TextSegment::InlineTag(tag) => Some(tag),
            _ => None,
        })
        .collect()
}
