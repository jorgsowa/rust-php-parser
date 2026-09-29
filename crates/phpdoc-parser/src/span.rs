use serde::Serialize;

/// Half-open byte range into the docblock text.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash, Serialize)]
pub struct Span {
    /// Start byte offset.
    pub start: u32,
    /// End byte offset (exclusive).
    pub end: u32,
}

impl Span {
    /// Creates a span from start and end offsets.
    pub fn new(start: u32, end: u32) -> Self {
        Self { start, end }
    }
}
