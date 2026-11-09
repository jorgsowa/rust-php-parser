/// Maps byte offsets (as used in [`Span`]) to line/column positions.
///
/// Build once per source file, then query as many offsets as needed in O(log n) each.
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
        let bytes = source.as_bytes();
        let mut line_starts = Vec::with_capacity(bytes.len() / 32 + 1);
        line_starts.push(0u32);
        // Newlines are too dense for memchr to pay off; find them 64 bytes at a time.
        let (blocks, rest) = bytes.as_chunks::<64>();
        let mut base = 0u32;
        for block in blocks {
            let bits = newline_bits(block);
            if bits != 0 {
                push_line_starts(&mut line_starts, base, bits);
            }
            base += 64;
        }
        for (i, &b) in rest.iter().enumerate() {
            if b == b'\n' {
                line_starts.push(base + i as u32 + 1);
            }
        }
        Self {
            line_starts,
            len: source.len() as u32,
        }
    }

    /// A no-op map for callers that never query line/column positions.
    /// Used when [`ParseOptions::source_map`](crate::ParseOptions::source_map) is `false`.
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

/// Pushes the offset after each newline whose bit is set in `bits`, for the block at `base`.
#[inline(always)]
fn push_line_starts(line_starts: &mut Vec<u32>, base: u32, mut bits: u64) {
    let count = bits.count_ones() as usize;
    line_starts.reserve(count + 4);
    // Four slots per step without a per-newline branch; slots past `count` get scratch values.
    let slots = &mut line_starts.spare_capacity_mut()[..(count + 3) & !3];
    for group in slots.as_chunks_mut::<4>().0 {
        for slot in group {
            slot.write(base.wrapping_add(bits.trailing_zeros() + 1));
            bits &= bits.wrapping_sub(1);
        }
    }
    let len = line_starts.len();
    // SAFETY: the loop above initialized the first `count` spare slots.
    unsafe { line_starts.set_len(len + count) };
}

/// Bit `i` is set when `block[i]` is a newline.
#[cfg(target_arch = "aarch64")]
#[inline(always)]
fn newline_bits(block: &[u8; 64]) -> u64 {
    use std::arch::aarch64::*;
    const WEIGHTS: [u8; 16] = [1, 2, 4, 8, 16, 32, 64, 128, 1, 2, 4, 8, 16, 32, 64, 128];
    // SAFETY: NEON is always available on aarch64, and every load reads 16 bytes within `block`.
    unsafe {
        let newline = vdupq_n_u8(b'\n');
        let weights = vld1q_u8(WEIGHTS.as_ptr());
        let p = block.as_ptr();
        let lane = |offset: usize| vandq_u8(vceqq_u8(vld1q_u8(p.add(offset)), newline), weights);
        let pairs = vpaddq_u8(vpaddq_u8(lane(0), lane(16)), vpaddq_u8(lane(32), lane(48)));
        vgetq_lane_u64(vreinterpretq_u64_u8(vpaddq_u8(pairs, pairs)), 0)
    }
}

#[cfg(not(target_arch = "aarch64"))]
#[inline(always)]
fn newline_bits(block: &[u8; 64]) -> u64 {
    newline_bits_portable(block)
}

#[cfg_attr(target_arch = "aarch64", allow(dead_code))]
#[inline(always)]
fn newline_bits_portable(block: &[u8; 64]) -> u64 {
    const LO: u64 = 0x0101_0101_0101_0101;
    const HI: u64 = 0x8080_8080_8080_8080;
    let mut bits = 0;
    for (i, chunk) in block.as_chunks::<8>().0.iter().enumerate() {
        let x = u64::from_le_bytes(*chunk) ^ (LO * 10);
        // 0x80 in each zero byte; unlike `(x - LO) & !x & HI`, no borrow crosses bytes.
        let zero = !(((x & !HI) + !HI) | x | !HI);
        // Gather the eight 0x80 flags into the low byte.
        let byte = ((zero >> 7).wrapping_mul(0x0102_0408_1020_4080)) >> 56;
        bits |= byte << (i * 8);
    }
    bits
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn line_starts_match_every_newline() {
        let pieces = ["\n", "a", "\r\n", "é", "\u{8a}", "\u{10a0a}", "\t", "\n\n"];
        let mut source = String::new();
        for i in 0..400 {
            source.push_str(pieces[(i * 7 + i / 3) % pieces.len()]);
            let expected: Vec<u32> = std::iter::once(0)
                .chain(source.match_indices('\n').map(|(p, _)| p as u32 + 1))
                .collect();
            assert_eq!(SourceMap::new(&source).line_starts, expected, "{source:?}");
        }
    }

    #[test]
    fn newline_bits_match_portable() {
        let mut block = [0u8; 64];
        for seed in 0u64..2000 {
            let mut x = seed.wrapping_mul(0x9e37_79b9_7f4a_7c15) | 1;
            for b in &mut block {
                x ^= x << 13;
                x ^= x >> 7;
                x ^= x << 17;
                *b = [b'\n', b'a', 0x8a, 0x0a ^ 0x80, 0xff, 0, b'\r', b' '][(x % 8) as usize];
            }
            let expected = block
                .iter()
                .enumerate()
                .fold(0u64, |acc, (i, &b)| acc | (u64::from(b == b'\n') << i));
            assert_eq!(newline_bits_portable(&block), expected);
            assert_eq!(newline_bits(&block), expected);
        }
    }

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
