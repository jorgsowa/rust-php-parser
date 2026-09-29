use crate::Span;
use serde::Serialize;

// =============================================================================
// Document-structure AST
// =============================================================================

/// An inline `{@tagname body}` tag embedded in text.
#[derive(Debug, Clone, Serialize)]
pub struct InlineTag {
    /// Tag name without braces or `@`.
    pub name: String,
    /// Text after the name, if any.
    pub body: Option<String>,
    /// Source range of the whole tag.
    pub span: Span,
}

/// A segment of prose text — either plain text or an inline tag.
#[derive(Debug, Clone, Serialize)]
pub enum TextSegment {
    /// Literal prose.
    Text(String),
    /// Embedded `{@tag}`.
    InlineTag(InlineTag),
}

/// A prose run (summary, description, or tag body) that may contain inline tags.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocText {
    /// Segments in source order.
    pub segments: Vec<TextSegment>,
    /// Source range of the text.
    pub span: Span,
}

/// A block-level `@tag` — generic, no semantic interpretation.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocTag {
    /// Raw tag name, e.g. `"param"`, `"psalm-type"`, `"return"`.
    pub name: String,
    /// Tag body, if any.
    pub body: Option<PhpDocText>,
    /// Source range of the tag.
    pub span: Span,
}

// =============================================================================
// Top-level document
// =============================================================================

/// A parsed docblock.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDoc {
    /// Leading summary text.
    pub summary: Option<PhpDocText>,
    /// Description following the summary.
    pub description: Option<PhpDocText>,
    /// Block-level tags in source order.
    pub tags: Vec<PhpDocTag>,
    /// Always `Span::new(0, text.len() as u32)`.
    pub span: Span,
}
