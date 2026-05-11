use crate::Span;
use serde::Serialize;

// =============================================================================
// Document-structure AST
// =============================================================================

/// An inline `{@tagname body}` tag embedded in text.
#[derive(Debug, Clone, Serialize)]
pub struct InlineTag {
    pub name: String,
    pub body: Option<String>,
    pub span: Span,
}

/// A segment of prose text — either plain text or an inline tag.
#[derive(Debug, Clone, Serialize)]
pub enum TextSegment {
    Text(String),
    InlineTag(InlineTag),
}

/// A prose run (summary, description, or tag body) that may contain inline tags.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocText {
    pub segments: Vec<TextSegment>,
    pub span: Span,
}

/// A block-level `@tag` — generic, no semantic interpretation.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocTag {
    /// Raw tag name, e.g. `"param"`, `"psalm-type"`, `"return"`.
    pub name: String,
    pub body: Option<PhpDocText>,
    pub span: Span,
}

// =============================================================================
// Top-level document
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct PhpDoc {
    pub summary: Option<PhpDocText>,
    pub description: Option<PhpDocText>,
    pub tags: Vec<PhpDocTag>,
    /// Always `Span::new(0, text.len() as u32)`.
    pub span: Span,
}
