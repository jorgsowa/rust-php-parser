use serde::Serialize;

/// Half-open byte range into the source.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash, Serialize)]
pub struct Span {
    /// Start byte offset.
    pub start: u32,
    /// End byte offset (exclusive).
    pub end: u32,
}

impl Span {
    /// Span with both offsets zero, used for synthesised nodes.
    pub const DUMMY: Span = Span { start: 0, end: 0 };

    /// Creates a span from start and end offsets.
    pub fn new(start: u32, end: u32) -> Self {
        Self { start, end }
    }

    /// Smallest span covering both spans.
    pub fn merge(self, other: Span) -> Span {
        Span {
            start: self.start.min(other.start),
            end: self.end.max(other.end),
        }
    }

    /// Length in bytes.
    pub fn len(self) -> u32 {
        self.end - self.start
    }

    /// Whether the span covers no bytes.
    pub fn is_empty(self) -> bool {
        self.start == self.end
    }
}

impl Default for Span {
    fn default() -> Self {
        Self::DUMMY
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_span_new() {
        let span = Span::new(5, 10);
        assert_eq!(span.start, 5);
        assert_eq!(span.end, 10);
    }

    #[test]
    fn test_span_merge() {
        let a = Span::new(5, 10);
        let b = Span::new(8, 15);
        let merged = a.merge(b);
        assert_eq!(merged.start, 5);
        assert_eq!(merged.end, 15);
    }

    #[test]
    fn test_span_merge_non_overlapping() {
        let a = Span::new(0, 5);
        let b = Span::new(10, 20);
        let merged = a.merge(b);
        assert_eq!(merged.start, 0);
        assert_eq!(merged.end, 20);
    }

    #[test]
    fn test_span_len() {
        let span = Span::new(3, 10);
        assert_eq!(span.len(), 7);
    }

    #[test]
    fn test_span_is_empty() {
        assert!(Span::new(5, 5).is_empty());
        assert!(!Span::new(5, 6).is_empty());
    }

    #[test]
    fn test_span_dummy() {
        assert_eq!(Span::DUMMY, Span::new(0, 0));
        assert!(Span::DUMMY.is_empty());
    }

    #[test]
    fn test_span_default() {
        assert_eq!(Span::default(), Span::DUMMY);
    }
}
