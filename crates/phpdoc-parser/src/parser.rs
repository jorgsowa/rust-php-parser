//! Top-level PHPDoc comment parser.
//!
//! Parses `/** ... */` doc-block comments into a [`PhpDoc`] with summary,
//! description, and generic tags. All spans are comment-relative
//! (0 = start of `/**`).
//!
//! Tag bodies are exposed as raw [`PhpDocText`] — callers apply their own
//! type parsers and validation rules to the body text.

use crate::ast::{InlineTag, PhpDoc, PhpDocTag, PhpDocText, TextSegment};
use crate::Span;

// =============================================================================
// Public entry point
// =============================================================================

/// Parse a raw doc-comment string into a [`PhpDoc`].
///
/// The input may include `/**` and `*/` delimiters or be already stripped.
pub fn parse(text: &str) -> PhpDoc {
    let span = Span::new(0, text.len() as u32);
    let (inner, content_start) = strip_delimiters(text);
    let lines = clean_lines(inner, content_start);
    let (summary, description, tag_start) = extract_prose(&lines);
    let tags = if tag_start < lines.len() {
        parse_tags(&lines[tag_start..])
    } else {
        Vec::new()
    };
    PhpDoc {
        summary,
        description,
        tags,
        span,
    }
}

// =============================================================================
// Internal types
// =============================================================================

struct CleanLine {
    text: String,
    /// Byte offset of `text[0]` within the original comment string.
    base_offset: u32,
}

// =============================================================================
// Delimiter stripping
// =============================================================================

fn strip_delimiters(text: &str) -> (&str, u32) {
    let (s, start) = if let Some(rest) = text.strip_prefix("/**") {
        (rest, 3u32)
    } else if let Some(rest) = text.strip_prefix("/*") {
        (rest, 2u32)
    } else {
        (text, 0u32)
    };
    let s = s.strip_suffix("*/").unwrap_or(s);
    (s, start)
}

// =============================================================================
// Line cleaning
// =============================================================================

fn clean_lines(inner: &str, content_start: u32) -> Vec<CleanLine> {
    let mut lines = Vec::new();
    let mut offset_in_inner: u32 = 0;

    for raw_line in inner.split('\n') {
        let line_abs_start = content_start + offset_in_inner;

        // Strip trailing \r so CRLF input doesn't leak into text content.
        // Use raw_line.len() (including the \r) for offset tracking so that
        // byte positions in the original string remain accurate.
        let line = raw_line.strip_suffix('\r').unwrap_or(raw_line);
        let bytes = line.as_bytes();

        let mut stripped_bytes: u32 = 0;

        let ws_count = bytes
            .iter()
            .take_while(|&&b| b == b' ' || b == b'\t')
            .count();
        stripped_bytes += ws_count as u32;
        let after_ws = &line[ws_count..];

        let (cleaned, extra_stripped) = if let Some(rest) = after_ws.strip_prefix("* ") {
            (rest, 2u32)
        } else if let Some(rest) = after_ws.strip_prefix('*') {
            (rest, 1u32)
        } else {
            (after_ws, 0u32)
        };
        stripped_bytes += extra_stripped;

        lines.push(CleanLine {
            text: cleaned.to_owned(),
            base_offset: line_abs_start + stripped_bytes,
        });

        offset_in_inner += raw_line.len() as u32 + 1;
    }

    lines
}

// =============================================================================
// Prose extraction
// =============================================================================

fn extract_prose(lines: &[CleanLine]) -> (Option<PhpDocText>, Option<PhpDocText>, usize) {
    let tag_start = lines
        .iter()
        .position(|l| l.text.trim_start().starts_with('@'))
        .unwrap_or(lines.len());

    let prose_lines = &lines[..tag_start];

    let Some(start) = prose_lines.iter().position(|l| !l.text.trim().is_empty()) else {
        return (None, None, tag_start);
    };

    let summary = {
        let line = &prose_lines[start];
        let trimmed = line.text.trim();
        if trimmed.is_empty() {
            None
        } else {
            let leading = (line.text.len() - line.text.trim_start().len()) as u32;
            Some(text_from_str(trimmed, line.base_offset + leading))
        }
    };

    let blank_after_summary = prose_lines[start..]
        .iter()
        .position(|l| l.text.trim().is_empty())
        .map(|i| i + start);

    let description = if let Some(blank) = blank_after_summary {
        let desc_start = prose_lines[blank..]
            .iter()
            .position(|l| !l.text.trim().is_empty())
            .map(|i| i + blank);

        if let Some(ds) = desc_start {
            let desc_end = prose_lines
                .iter()
                .rposition(|l| !l.text.trim().is_empty())
                .map(|i| i + 1)
                .unwrap_or(ds);

            let slice: Vec<&CleanLine> = prose_lines[ds..desc_end].iter().collect();
            description_to_text(&slice)
        } else {
            None
        }
    } else {
        None
    };

    (summary, description, tag_start)
}

// =============================================================================
// Tag parsing
// =============================================================================

fn parse_tags(lines: &[CleanLine]) -> Vec<PhpDocTag> {
    let mut tags = Vec::new();
    let mut i = 0;

    while i < lines.len() {
        let line_text = lines[i].text.trim_start();
        if !line_text.starts_with('@') {
            i += 1;
            continue;
        }

        let tag_start_offset = lines[i].base_offset;

        let mut tag_lines: Vec<&CleanLine> = vec![&lines[i]];
        i += 1;
        while i < lines.len() && !lines[i].text.trim_start().starts_with('@') {
            tag_lines.push(&lines[i]);
            i += 1;
        }

        let last = tag_lines.last().unwrap();
        let tag_end_offset = last.base_offset + last.text.len() as u32;
        let tag_span = Span::new(tag_start_offset, tag_end_offset);

        let first = tag_lines[0]
            .text
            .trim_start()
            .strip_prefix('@')
            .unwrap_or("");

        let (tag_name, body_on_first) = match first.find(|c: char| c.is_whitespace()) {
            Some(pos) => {
                let body = first[pos..].trim();
                (
                    &first[..pos],
                    if body.is_empty() { None } else { Some(body) },
                )
            }
            None => (first, None),
        };

        let body_base_offset = {
            let after_at = &tag_lines[0].text.trim_start()[1 + tag_name.len()..];
            let ws = (after_at.len() - after_at.trim_start().len()) as u32;
            tag_lines[0].base_offset + 1 + tag_name.len() as u32 + ws
        };

        let first_piece = body_on_first.map(|t| (t, body_base_offset));
        let body = tag_body_to_text(first_piece, &tag_lines[1..]);

        tags.push(PhpDocTag {
            name: tag_name.to_owned(),
            body,
            span: tag_span,
        });
    }

    tags
}

// =============================================================================
// Text builders
// =============================================================================

/// How a [`PhpDocTextBuilder`] treats blank source lines.
#[derive(Clone, Copy)]
enum BlankLinePolicy {
    /// Drop blank lines entirely — no separator, no break. Used for tag bodies,
    /// which are a single logical value with no paragraph structure.
    Drop,
    /// Keep blank lines as line boundaries, so consecutive blanks become `\n\n`
    /// paragraph breaks. Used for descriptions.
    Keep,
}

/// Accumulates trimmed source lines into a single [`PhpDocText`].
///
/// Each non-blank line is trimmed, scanned for `{@inline}` tags at its own true
/// source offset (so spans stay accurate across lines), and appended after a `\n`
/// separator. The running [`Span`] covers the first through last non-blank line.
/// Blank-line handling is governed by [`BlankLinePolicy`].
struct PhpDocTextBuilder {
    segments: Vec<TextSegment>,
    span_start: Option<u32>,
    span_end: u32,
    blank_policy: BlankLinePolicy,
    /// Whether any line has been pushed yet — controls the leading separator so
    /// the first line never gets a `\n` in front of it.
    started: bool,
}

impl PhpDocTextBuilder {
    fn new(blank_policy: BlankLinePolicy) -> Self {
        Self {
            segments: Vec::new(),
            span_start: None,
            span_end: 0,
            blank_policy,
            started: false,
        }
    }

    /// Push one source line. `text` is the raw (untrimmed) line and `base` is the
    /// source offset of its first byte.
    fn push_line(&mut self, text: &str, base: u32) {
        let trimmed = text.trim();

        if trimmed.is_empty() {
            if let BlankLinePolicy::Keep = self.blank_policy {
                if self.started {
                    push_text(&mut self.segments, "\n");
                }
                self.started = true;
            }
            return;
        }

        if self.started {
            push_text(&mut self.segments, "\n");
        }
        self.started = true;

        let leading = (text.len() - text.trim_start().len()) as u32;
        let content_offset = base + leading;
        if self.span_start.is_none() {
            self.span_start = Some(content_offset);
        }
        self.span_end = content_offset + trimmed.len() as u32;
        merge_into(
            &mut self.segments,
            text_from_str(trimmed, content_offset).segments,
        );
    }

    fn build(self) -> Option<PhpDocText> {
        self.span_start.map(|start| PhpDocText {
            segments: self.segments,
            span: Span::new(start, self.span_end),
        })
    }
}

/// Build a [`PhpDocText`] for a `@tag` body.
///
/// `first_piece` is `Some((text, base_offset))` for the text on the `@tag` line
/// itself (after the tag name); continuation lines follow. Lines are joined with
/// a newline, preserving line boundaries so callers can separate a type
/// expression from its description (e.g. `@var T\nThe description`).
fn tag_body_to_text(
    first_piece: Option<(&str, u32)>,
    continuation: &[&CleanLine],
) -> Option<PhpDocText> {
    let mut builder = PhpDocTextBuilder::new(BlankLinePolicy::Drop);
    if let Some((text, base)) = first_piece {
        builder.push_line(text, base);
    }
    for line in continuation {
        builder.push_line(&line.text, line.base_offset);
    }
    builder.build()
}

/// Build a [`PhpDocText`] for a description (multi-line prose after the summary).
///
/// Lines are joined with `\n`; blank lines produce `\n\n` paragraph breaks.
fn description_to_text(lines: &[&CleanLine]) -> Option<PhpDocText> {
    let mut builder = PhpDocTextBuilder::new(BlankLinePolicy::Keep);
    for line in lines {
        builder.push_line(&line.text, line.base_offset);
    }
    builder.build()
}

/// Append `text` to the last `Text` segment, or push a new one.
fn push_text(segments: &mut Vec<TextSegment>, text: &str) {
    if text.is_empty() {
        return;
    }
    if let Some(TextSegment::Text(last)) = segments.last_mut() {
        last.push_str(text);
    } else {
        segments.push(TextSegment::Text(text.to_owned()));
    }
}

/// Extend `dest` with `src`, merging adjacent `Text` segments at the boundary.
fn merge_into(dest: &mut Vec<TextSegment>, src: Vec<TextSegment>) {
    for seg in src {
        match seg {
            TextSegment::Text(t) => push_text(dest, &t),
            other => dest.push(other),
        }
    }
}

// =============================================================================
// Inline-tag scanning
// =============================================================================

/// Build a [`PhpDocText`] from a string, scanning for `{@tagname body}` inline tags.
fn text_from_str(s: &str, base_offset: u32) -> PhpDocText {
    let mut segments = Vec::new();
    let bytes = s.as_bytes();
    let mut i = 0;
    let mut text_start = 0;

    while i < bytes.len() {
        if bytes[i] == b'{' && bytes.get(i + 1) == Some(&b'@') {
            if i > text_start {
                segments.push(TextSegment::Text(s[text_start..i].to_owned()));
            }

            let tag_abs_start = i;
            i += 2; // skip `{@`

            let name_start = i;
            while i < bytes.len() && !bytes[i].is_ascii_whitespace() && bytes[i] != b'}' {
                i += 1;
            }
            let name = s[name_start..i].to_owned();

            while i < bytes.len() && bytes[i].is_ascii_whitespace() {
                i += 1;
            }

            let body_start = i;
            let mut depth = 1i32;
            while i < bytes.len() {
                match bytes[i] {
                    b'{' => {
                        depth += 1;
                        i += 1;
                    }
                    b'}' if depth == 1 => break,
                    b'}' => {
                        depth -= 1;
                        i += 1;
                    }
                    _ => {
                        i += 1;
                    }
                }
            }

            let body_raw = s[body_start..i].trim();
            let body = if body_raw.is_empty() {
                None
            } else {
                Some(body_raw.to_owned())
            };

            if i < bytes.len() {
                i += 1; // consume `}`
            }

            segments.push(TextSegment::InlineTag(InlineTag {
                name,
                body,
                span: Span::new(base_offset + tag_abs_start as u32, base_offset + i as u32),
            }));

            text_start = i;
        } else {
            i += 1;
        }
    }

    if text_start < s.len() {
        segments.push(TextSegment::Text(s[text_start..].to_owned()));
    }

    PhpDocText {
        segments,
        span: Span::new(base_offset, base_offset + s.len() as u32),
    }
}
