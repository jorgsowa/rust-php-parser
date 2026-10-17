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
        let expanded = split_inline_tag_lines(&lines[tag_start..]);
        parse_tags(&expanded)
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

/// One comment line with its leading `*` decoration removed, borrowed from
/// the comment text.
#[derive(Clone, Copy)]
struct CleanLine<'a> {
    text: &'a str,
    /// Byte offset of `text[0]` within the original comment string.
    base_offset: u32,
    /// Length of `text`'s leading whitespace, as `str::trim_start` sees it;
    /// computed once since every pass asks for it.
    lead: u32,
}

impl<'a> CleanLine<'a> {
    fn new(text: &'a str, base_offset: u32) -> Self {
        Self {
            text,
            base_offset,
            lead: (text.len() - text.trim_start().len()) as u32,
        }
    }

    /// `text` without leading whitespace.
    fn trimmed_start(&self) -> &'a str {
        &self.text[self.lead as usize..]
    }

    /// Whether the line is empty or all whitespace.
    fn is_blank(&self) -> bool {
        self.lead as usize == self.text.len()
    }

    /// Whether the line starts a `@tag`.
    fn starts_tag(&self) -> bool {
        self.trimmed_start().starts_with('@')
    }
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

fn clean_lines(inner: &str, content_start: u32) -> Vec<CleanLine<'_>> {
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

        lines.push(CleanLine::new(cleaned, line_abs_start + stripped_bytes));

        offset_in_inner += raw_line.len() as u32 + 1;
    }

    lines
}

// =============================================================================
// Prose extraction
// =============================================================================

fn extract_prose(lines: &[CleanLine<'_>]) -> (Option<PhpDocText>, Option<PhpDocText>, usize) {
    let tag_start = lines
        .iter()
        .position(CleanLine::starts_tag)
        .unwrap_or(lines.len());

    let prose_lines = &lines[..tag_start];

    let Some(start) = prose_lines.iter().position(|l| !l.is_blank()) else {
        return (None, None, tag_start);
    };

    let summary = {
        let line = &prose_lines[start];
        let trimmed = line.text.trim();
        if trimmed.is_empty() {
            None
        } else {
            Some(text_from_str(trimmed, line.base_offset + line.lead))
        }
    };

    let blank_after_summary = prose_lines[start..]
        .iter()
        .position(CleanLine::is_blank)
        .map(|i| i + start);

    let description = if let Some(blank) = blank_after_summary {
        let desc_start = prose_lines[blank..]
            .iter()
            .position(|l| !l.is_blank())
            .map(|i| i + blank);

        if let Some(ds) = desc_start {
            let desc_end = prose_lines
                .iter()
                .rposition(|l| !l.is_blank())
                .map(|i| i + 1)
                .unwrap_or(ds);

            description_to_text(&prose_lines[ds..desc_end])
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

/// Split a physical line at each additional `@tag` boundary that appears
/// mid-line, so `@param int $x @return int` parses as two tags instead of
/// one tag whose body swallows the second verbatim. A boundary is a `@`
/// preceded by whitespace and followed by a letter — this excludes
/// email-like text (`user@example.com`, no preceding whitespace) and
/// `{@inline}` tags (preceded by `{`, not whitespace).
///
/// Only lines that themselves start with `@` are scanned: a tag's
/// continuation/description lines are prose, so an `@word` inside them
/// (e.g. `Contact user @example for details.`) must not be mistaken for a
/// new tag.
///
/// Known limitation: an `@word` inside a tag's own first-line body (not a
/// continuation line) is indistinguishable from a genuine second tag, since
/// this crate deliberately has no notion of which tag names are "real"
/// (see the crate-level docs). `@param string $email Contact @jsmith` still
/// splits into a bogus `jsmith` tag.
fn split_inline_tag_lines<'a>(lines: &[CleanLine<'a>]) -> Vec<CleanLine<'a>> {
    let mut out = Vec::with_capacity(lines.len());
    for &line in lines {
        if !line.starts_tag() {
            out.push(line);
            continue;
        }
        let bytes = line.text.as_bytes();
        let mut piece_start = 0;
        for i in 1..bytes.len() {
            if bytes[i] == b'@'
                && bytes[i - 1].is_ascii_whitespace()
                && bytes.get(i + 1).is_some_and(u8::is_ascii_alphabetic)
            {
                out.push(CleanLine::new(
                    &line.text[piece_start..i],
                    line.base_offset + piece_start as u32,
                ));
                piece_start = i;
            }
        }
        out.push(CleanLine::new(
            &line.text[piece_start..],
            line.base_offset + piece_start as u32,
        ));
    }
    out
}

fn parse_tags(lines: &[CleanLine<'_>]) -> Vec<PhpDocTag> {
    let mut tags = Vec::new();
    let mut i = 0;

    while i < lines.len() {
        if !lines[i].starts_tag() {
            i += 1;
            continue;
        }

        let tag_start_offset = lines[i].base_offset;

        let first_line = i;
        i += 1;
        while i < lines.len() && !lines[i].starts_tag() {
            i += 1;
        }
        let tag_lines = &lines[first_line..i];

        let last = tag_lines.last().unwrap();
        let tag_end_offset = last.base_offset + last.text.len() as u32;
        let tag_span = Span::new(tag_start_offset, tag_end_offset);

        let first = tag_lines[0].trimmed_start().strip_prefix('@').unwrap_or("");

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
            let after_at = &tag_lines[0].trimmed_start()[1 + tag_name.len()..];
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

/// What blank source lines mean to a [`PhpDocTextBuilder`].
#[derive(Clone, Copy)]
enum BlankLinePolicy {
    /// Blank lines carry no meaning — dropped entirely, no separator or break.
    /// Used for tag bodies, which are a single logical value with no paragraphs.
    Insignificant,
    /// A blank line is a paragraph separator, so consecutive blanks become `\n\n`.
    /// Used for descriptions.
    ParagraphBreak,
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
            if let BlankLinePolicy::ParagraphBreak = self.blank_policy {
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
        append_text(&mut self.segments, trimmed, content_offset);
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
    continuation: &[CleanLine<'_>],
) -> Option<PhpDocText> {
    let mut builder = PhpDocTextBuilder::new(BlankLinePolicy::Insignificant);
    if let Some((text, base)) = first_piece {
        builder.push_line(text, base);
    }
    for line in continuation {
        builder.push_line(line.text, line.base_offset);
    }
    builder.build()
}

/// Build a [`PhpDocText`] for a description (multi-line prose after the summary).
///
/// Lines are joined with `\n`; blank lines produce `\n\n` paragraph breaks.
fn description_to_text(lines: &[CleanLine<'_>]) -> Option<PhpDocText> {
    let mut builder = PhpDocTextBuilder::new(BlankLinePolicy::ParagraphBreak);
    for line in lines {
        builder.push_line(line.text, line.base_offset);
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

// =============================================================================
// Inline-tag scanning
// =============================================================================

/// Build a [`PhpDocText`] from a string, scanning for `{@tagname body}` inline tags.
fn text_from_str(s: &str, base_offset: u32) -> PhpDocText {
    let mut segments = Vec::new();
    append_text(&mut segments, s, base_offset);
    PhpDocText {
        segments,
        span: Span::new(base_offset, base_offset + s.len() as u32),
    }
}

/// Append the segments of `s` to `segments`, merging plain text into a
/// trailing `Text` segment and splitting out `{@tagname body}` inline tags.
fn append_text(segments: &mut Vec<TextSegment>, s: &str, base_offset: u32) {
    let bytes = s.as_bytes();
    let mut i = 0;
    let mut text_start = 0;

    while i < bytes.len() {
        if bytes[i] == b'{' && bytes.get(i + 1) == Some(&b'@') {
            push_text(segments, &s[text_start..i]);

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

    push_text(segments, &s[text_start..]);
}
