use std::fmt;

use serde::Serialize;

#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash, Serialize)]
pub struct Span {
    pub start: u32,
    pub end: u32,
    /// 1-based line number of the start position.
    pub start_line: u32,
    /// 0-based column (byte offset within the line) of the start position.
    pub start_col: u16,
}

impl Span {
    pub const DUMMY: Span = Span {
        start: 0,
        end: 0,
        start_line: 0,
        start_col: 0,
    };

    pub fn new(start: u32, end: u32) -> Self {
        Self {
            start,
            end,
            start_line: 0,
            start_col: 0,
        }
    }

    pub fn with_position(start: u32, end: u32, start_line: u32, start_col: u16) -> Self {
        Self {
            start,
            end,
            start_line,
            start_col,
        }
    }

    pub fn merge(self, other: Span) -> Span {
        if self.start <= other.start {
            Span {
                start: self.start,
                end: self.end.max(other.end),
                start_line: self.start_line,
                start_col: self.start_col,
            }
        } else {
            Span {
                start: other.start,
                end: self.end.max(other.end),
                start_line: other.start_line,
                start_col: other.start_col,
            }
        }
    }

    pub fn len(self) -> u32 {
        self.end - self.start
    }

    pub fn is_empty(self) -> bool {
        self.start == self.end
    }
}

/// Precomputed line-start index for resolving byte offsets to line/column positions.
///
/// Build once per source file, then use [`resolve`](LineIndex::resolve) to convert
/// a byte offset into a `(line, col)` pair (1-based line, 0-based column).
#[derive(Debug, Clone)]
pub struct LineIndex {
    /// Byte offset of the start of each line. `line_starts[0]` is always 0.
    line_starts: Vec<u32>,
}

impl LineIndex {
    /// Build the index by scanning `source` for newline bytes.
    pub fn new(source: &str) -> Self {
        let mut line_starts = vec![0u32];
        for (i, byte) in source.bytes().enumerate() {
            if byte == b'\n' {
                line_starts.push((i + 1) as u32);
            }
        }
        Self { line_starts }
    }

    /// Resolve a byte offset to (1-based line, 0-based column).
    #[inline]
    pub fn resolve(&self, offset: u32) -> (u32, u16) {
        let idx = match self.line_starts.binary_search(&offset) {
            Ok(i) => i,
            Err(i) => i - 1,
        };
        let line = idx as u32 + 1; // 1-based
        let col = (offset - self.line_starts[idx]) as u16;
        (line, col)
    }

    /// Create a [`Span`] from byte offsets, resolving the start position to line/column.
    #[inline]
    pub fn span(&self, start: u32, end: u32) -> Span {
        let (line, col) = self.resolve(start);
        Span::with_position(start, end, line, col)
    }
}

impl Default for Span {
    fn default() -> Self {
        Self::DUMMY
    }
}

impl fmt::Display for Span {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        if self.start_line > 0 {
            write!(f, "{}:{}", self.start_line, self.start_col)
        } else {
            write!(f, "{}", self.start)
        }
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

    #[test]
    fn test_span_with_position() {
        let span = Span::with_position(10, 20, 3, 5);
        assert_eq!(span.start, 10);
        assert_eq!(span.end, 20);
        assert_eq!(span.start_line, 3);
        assert_eq!(span.start_col, 5);
    }

    #[test]
    fn test_span_merge_preserves_position() {
        let a = Span::with_position(5, 10, 1, 5);
        let b = Span::with_position(8, 15, 1, 8);
        let merged = a.merge(b);
        assert_eq!(merged.start_line, 1);
        assert_eq!(merged.start_col, 5);

        // When b starts before a, use b's position
        let merged = b.merge(a);
        assert_eq!(merged.start_line, 1);
        assert_eq!(merged.start_col, 5);
    }

    #[test]
    fn test_span_display() {
        let span = Span::with_position(10, 20, 3, 5);
        assert_eq!(format!("{span}"), "3:5");

        // Span without position info falls back to byte offset
        let span = Span::new(10, 20);
        assert_eq!(format!("{span}"), "10");
    }

    #[test]
    fn test_line_index_single_line() {
        let idx = LineIndex::new("hello world");
        assert_eq!(idx.resolve(0), (1, 0));
        assert_eq!(idx.resolve(5), (1, 5));
    }

    #[test]
    fn test_line_index_multi_line() {
        let idx = LineIndex::new("line1\nline2\nline3");
        assert_eq!(idx.resolve(0), (1, 0));
        assert_eq!(idx.resolve(5), (1, 5)); // the \n
        assert_eq!(idx.resolve(6), (2, 0)); // start of line2
        assert_eq!(idx.resolve(12), (3, 0)); // start of line3
    }

    #[test]
    fn test_line_index_span() {
        let idx = LineIndex::new("<?php\n$x = 1;");
        let span = idx.span(6, 8);
        assert_eq!(span.start, 6);
        assert_eq!(span.end, 8);
        assert_eq!(span.start_line, 2);
        assert_eq!(span.start_col, 0);
    }
}
