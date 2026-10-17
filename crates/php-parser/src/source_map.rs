/// Maps byte offsets (as used in [`Span`]) to line/column positions.
///
/// Build once per source file, then query as many offsets as needed in O(1) each.
///
/// Lines and columns are **0-based** — the LSP convention. Call
/// [`LineCol::to_one_based`] if you need 1-based positions.
///
/// # Example
///
/// ```
/// use php_rs_parser::source_map::{SourceMap, LineCol};
///
/// let src = "<?php\necho 'hi';\n";
/// let map = SourceMap::new(src);
///
/// assert_eq!(map.offset_to_line_col(0), LineCol { line: 0, col: 0 });
/// assert_eq!(map.offset_to_line_col(6), LineCol { line: 1, col: 0 });
/// ```
use php_ast::Span;

/// A 0-based line/column position.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
pub struct LineCol {
    /// 0-based line number.
    pub line: u32,
    /// 0-based UTF-8 byte column offset within the line.
    pub col: u32,
}

impl LineCol {
    /// Convert to 1-based line and column (e.g. for human-readable diagnostics).
    pub fn to_one_based(self) -> (u32, u32) {
        (self.line + 1, self.col + 1)
    }
}

/// A line/column range corresponding to a [`Span`].
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
pub struct LineColSpan {
    /// Range start.
    pub start: LineCol,
    /// Range end.
    pub end: LineCol,
}

/// Pre-computed index of line-start byte offsets for a source string.
///
/// Construction is O(n) in the source length. Each lookup is O(log n) in the
/// number of lines (binary search), which is effectively O(1) for typical files.
#[derive(Debug, Clone, PartialEq, Eq)]
pub struct SourceMap {
    /// Byte offset of the start of each line. `line_starts[0]` is always 0.
    line_starts: Vec<u32>,
    /// Source length in bytes; `u32::MAX` for [`SourceMap::empty`].
    len: u32,
}

impl SourceMap {
    /// Build an index from the given source text.
    pub fn new(source: &str) -> Self {
        let mut line_starts = Vec::with_capacity(source.len() / 40 + 1);
        line_starts.push(0u32);
        for pos in memchr::memchr_iter(b'\n', source.as_bytes()) {
            line_starts.push((pos + 1) as u32);
        }
        Self {
            line_starts,
            len: source.len() as u32,
        }
    }

    /// A no-op map for callers that never query line/column positions.
    /// Returned by [`parse_arena_raw`](crate::parse_arena_raw).
    /// `offset_to_line_col` on an empty map returns `LineCol { line: 0, col: offset }`.
    pub fn empty() -> Self {
        Self {
            line_starts: vec![0u32],
            len: u32::MAX,
        }
    }

    /// Total number of lines in the source.
    pub fn line_count(&self) -> usize {
        self.line_starts.len()
    }

    /// Byte offset where the given 0-based line starts.
    /// Returns `None` if the line is out of range.
    pub fn line_start(&self, line: u32) -> Option<u32> {
        self.line_starts.get(line as usize).copied()
    }

    /// Convert a byte offset to a 0-based line/column.
    ///
    /// If `offset` is past the end of the source, the position is clamped to
    /// the last line.
    pub fn offset_to_line_col(&self, offset: u32) -> LineCol {
        let line = match self.line_starts.binary_search(&offset) {
            Ok(exact) => exact,
            Err(after) => after - 1,
        };
        let col = offset - self.line_starts[line];
        LineCol {
            line: line as u32,
            col,
        }
    }

    /// Convert a [`Span`] to a start/end [`LineColSpan`].
    pub fn span_to_line_col(&self, span: Span) -> LineColSpan {
        LineColSpan {
            start: self.offset_to_line_col(span.start),
            end: self.offset_to_line_col(span.end),
        }
    }

    /// Convert a 0-based line/column to a byte offset; `None` past the line's `\n` or the end of the source.
    pub fn line_col_to_offset(&self, lc: LineCol) -> Option<u32> {
        let line = lc.line as usize;
        let start = *self.line_starts.get(line)?;
        let end = match self.line_starts.get(line + 1) {
            Some(next_start) => next_start - 1,
            None => self.len,
        };
        start.checked_add(lc.col).filter(|&offset| offset <= end)
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn empty_source() {
        let map = SourceMap::new("");
        assert_eq!(map.line_count(), 1);
        assert_eq!(map.offset_to_line_col(0), LineCol { line: 0, col: 0 });
    }

    #[test]
    fn single_line_no_newline() {
        let map = SourceMap::new("<?php echo 1;");
        assert_eq!(map.line_count(), 1);
        assert_eq!(map.offset_to_line_col(0), LineCol { line: 0, col: 0 });
        assert_eq!(map.offset_to_line_col(6), LineCol { line: 0, col: 6 });
    }

    #[test]
    fn multiple_lines() {
        let src = "<?php\necho 'hi';\nreturn;\n";
        let map = SourceMap::new(src);
        assert_eq!(map.line_count(), 4); // 3 lines + trailing empty line after last \n

        // First char of line 0
        assert_eq!(map.offset_to_line_col(0), LineCol { line: 0, col: 0 });
        // First char of line 1
        assert_eq!(map.offset_to_line_col(6), LineCol { line: 1, col: 0 });
        // 'e' of echo on line 1
        assert_eq!(map.offset_to_line_col(6), LineCol { line: 1, col: 0 });
        // First char of line 2
        assert_eq!(map.offset_to_line_col(17), LineCol { line: 2, col: 0 });
    }

    #[test]
    fn span_conversion() {
        let src = "<?php\necho 'hi';\n";
        let map = SourceMap::new(src);
        let span = Span::new(6, 10); // "echo"
        let lc = map.span_to_line_col(span);
        assert_eq!(lc.start, LineCol { line: 1, col: 0 });
        assert_eq!(lc.end, LineCol { line: 1, col: 4 });
    }

    #[test]
    fn round_trip() {
        let src = "<?php\necho 'hi';\nreturn;\n";
        let map = SourceMap::new(src);
        let lc = LineCol { line: 1, col: 5 };
        let offset = map.line_col_to_offset(lc).unwrap();
        assert_eq!(map.offset_to_line_col(offset), lc);
    }

    #[test]
    fn column_past_line_end_is_rejected() {
        let map = SourceMap::new("ab\ncd");
        assert_eq!(map.line_col_to_offset(LineCol { line: 0, col: 2 }), Some(2));
        assert_eq!(map.line_col_to_offset(LineCol { line: 0, col: 3 }), None);
        assert_eq!(map.line_col_to_offset(LineCol { line: 1, col: 2 }), Some(5));
        assert_eq!(map.line_col_to_offset(LineCol { line: 1, col: 3 }), None);
        assert_eq!(
            map.line_col_to_offset(LineCol {
                line: 1,
                col: u32::MAX
            }),
            None
        );
    }

    #[test]
    fn empty_map_accepts_any_column() {
        let map = SourceMap::empty();
        assert_eq!(
            map.line_col_to_offset(LineCol { line: 0, col: 42 }),
            Some(42)
        );
        assert_eq!(map.line_col_to_offset(LineCol { line: 1, col: 0 }), None);
    }

    #[test]
    fn one_based() {
        let lc = LineCol { line: 0, col: 0 };
        assert_eq!(lc.to_one_based(), (1, 1));
        let lc = LineCol { line: 2, col: 5 };
        assert_eq!(lc.to_one_based(), (3, 6));
    }

    #[test]
    fn line_start_lookup() {
        let src = "aaa\nbbb\nccc";
        let map = SourceMap::new(src);
        assert_eq!(map.line_start(0), Some(0));
        assert_eq!(map.line_start(1), Some(4));
        assert_eq!(map.line_start(2), Some(8));
        assert_eq!(map.line_start(3), None);
    }

    #[test]
    fn crlf_treated_as_two_bytes() {
        // \r\n: \r is col 0 on line 0, \n triggers new line at offset 2
        let src = "a\r\nb";
        let map = SourceMap::new(src);
        assert_eq!(map.line_count(), 2);
        // 'b' is at offset 3, line 1 starts at offset 3
        assert_eq!(map.offset_to_line_col(3), LineCol { line: 1, col: 0 });
    }
}
