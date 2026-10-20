use php_ast::*;

use crate::diagnostics::ParseError;
use crate::parser::{INTERPOLATION_NESTING_COST, MAX_NESTING_DEPTH};
use crate::version::PhpVersion;

/// Parse the inner content of a double-quoted or backtick string into parts.
/// `source` is the full original source string.
/// `inner` is the string content without surrounding quotes — must be a verbatim
/// subslice of `source` so that sub-parser offsets are correct absolute positions.
/// `base_offset` is the byte offset of the first character of `inner` in the source.
pub fn parse_interpolated_parts<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    inner: &'src str,
    base_offset: u32,
    version: PhpVersion,
    nesting_depth: u32,
    errors: &mut Vec<ParseError>,
) -> ArenaVec<'arena, StringPart<'arena, 'src>> {
    let mut parts = ArenaVec::with_capacity_in(8, arena);
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;

    // Start of the current literal run within `inner`.
    let mut literal_start = 0usize;
    // Accumulated owned string; present only when the run contains escape sequences.
    let mut owned: Option<Vec<u8>> = None;

    while i < len {
        match bytes[i] {
            b'\\' => {
                let buf = owned.get_or_insert_with(|| inner.as_bytes()[literal_start..i].to_vec());
                i = decode_escape_at(bytes, inner, i, buf, errors, base_offset, true);
            }
            b'$' => {
                // Deprecated ${varname} syntax (PHP < 8.2): ${ ... }
                if i + 1 < len && bytes[i + 1] == b'{' {
                    if let Some(buf) = owned.take() {
                        if !buf.is_empty() {
                            parts.push(StringPart::Literal(ByteStr::new_in(arena, &buf)));
                        }
                    } else if i > literal_start {
                        parts.push(StringPart::Literal(ByteStr::from_source(
                            &inner[literal_start..i],
                        )));
                    }
                    let (expr, next) = parse_dollar_brace(
                        arena,
                        source,
                        inner,
                        base_offset,
                        i,
                        version,
                        nesting_depth,
                        errors,
                    );
                    parts.push(StringPart::Expr(expr));
                    i = next;
                    literal_start = i;
                // Check for {$ (complex syntax handled below) - this is simple $var
                } else if i + 1 < len && is_var_start(bytes[i + 1]) {
                    // Flush literal run.
                    if let Some(buf) = owned.take() {
                        if !buf.is_empty() {
                            parts.push(StringPart::Literal(ByteStr::new_in(arena, &buf)));
                        }
                    } else if i > literal_start {
                        parts.push(StringPart::Literal(ByteStr::from_source(
                            &inner[literal_start..i],
                        )));
                    }

                    // Parse variable name
                    let var_start = i;
                    i += 1; // skip $
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                        while i < len && is_utf8_continuation(bytes[i]) {
                            i += 1;
                        }
                    }
                    let var_name: &'src str =
                        &source[base_offset as usize + name_start..base_offset as usize + i];
                    let var_offset = base_offset + var_start as u32;

                    let mut expr = Expr {
                        kind: ExprKind::Variable(NameStr::from_source(var_name)),
                        span: Span::new(var_offset, base_offset + i as u32),
                    };

                    // Check for ->identifier or ?->identifier (simple property access)
                    if let Some((arrow_len, nullsafe)) = property_arrow(bytes, i, version) {
                        i += arrow_len;
                        let pname_start = i;
                        while i < len && is_var_char(bytes[i]) {
                            i += 1;
                            while i < len && is_utf8_continuation(bytes[i]) {
                                i += 1;
                            }
                        }
                        let prop_name: &'src str =
                            &source[base_offset as usize + pname_start..base_offset as usize + i];
                        let prop_span =
                            Span::new(base_offset + pname_start as u32, base_offset + i as u32);
                        let span = Span::new(var_offset, base_offset + i as u32);
                        let access = PropertyAccessExpr {
                            object: arena.alloc(expr),
                            property: arena.alloc(Expr {
                                kind: ExprKind::Identifier(NameStr::from_source(prop_name)),
                                span: prop_span,
                            }),
                        };
                        let kind = if nullsafe {
                            ExprKind::NullsafePropertyAccess(access)
                        } else {
                            ExprKind::PropertyAccess(access)
                        };
                        expr = Expr { kind, span };
                    }
                    // Check for [index] (simple array access, only when no ->prop was consumed)
                    else if i < len && bytes[i] == b'[' {
                        let bracket_start = i;
                        i += 1; // skip [
                                // Find the matching ]
                        let idx_start = i;
                        while i < len && bytes[i] != b']' {
                            i += 1;
                        }
                        if i < len && bytes[i] == b']' {
                            let idx_str = &inner[idx_start..i];
                            i += 1; // skip ]

                            if idx_str.is_empty() {
                                errors.push(ParseError::Forbidden {
                                    message: "empty index in string interpolation".into(),
                                    span: Span::new(
                                        base_offset + bracket_start as u32,
                                        base_offset + i as u32,
                                    ),
                                });
                            } else {
                                let idx_offset = base_offset + idx_start as u32;
                                let idx_end = base_offset + (i - 1) as u32;
                                check_simple_offset(
                                    idx_str,
                                    Span::new(idx_offset, idx_end),
                                    errors,
                                );

                                let index_expr =
                                    parse_simple_index(source, idx_str, idx_offset, idx_end);

                                let span = Span::new(var_offset, base_offset + i as u32);
                                expr = Expr {
                                    kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                        array: arena.alloc(expr),
                                        index: Some(arena.alloc(index_expr)),
                                    }),
                                    span,
                                };
                            }
                        } else {
                            errors.push(ParseError::Forbidden {
                                message: "unclosed '[' in string interpolation".into(),
                                span: Span::new(
                                    base_offset + bracket_start as u32,
                                    base_offset + len as u32,
                                ),
                            });
                            i = bracket_start;
                        }
                    }

                    parts.push(StringPart::Expr(expr));
                    literal_start = i;
                } else {
                    // Plain `$` not starting a variable — keep in literal run.
                    if let Some(ref mut buf) = owned {
                        buf.push(b'$');
                    }
                    i += 1;
                }
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => {
                // Complex syntax: {$expr}
                if let Some(buf) = owned.take() {
                    if !buf.is_empty() {
                        parts.push(StringPart::Literal(ByteStr::new_in(arena, &buf)));
                    }
                } else if i > literal_start {
                    parts.push(StringPart::Literal(ByteStr::from_source(
                        &inner[literal_start..i],
                    )));
                }

                let brace_offset = base_offset + i as u32;
                i += 1; // skip {
                        // Find matching }
                let expr_start = i;
                let mut depth = 1;
                while i < len && depth > 0 {
                    match bytes[i] {
                        b'{' => depth += 1,
                        b'}' => depth -= 1,
                        b'\'' | b'"' => {
                            // Skip string literals inside complex expression
                            let quote = bytes[i];
                            i += 1;
                            while i < len && bytes[i] != quote {
                                if bytes[i] == b'\\' {
                                    i += 1; // skip backslash
                                            // Skip the escaped character, which may be multi-byte UTF-8
                                    if i < len {
                                        if bytes[i] < 0x80 {
                                            i += 1;
                                        } else {
                                            i += 1; // skip first byte of multi-byte
                                            while i < len && is_utf8_continuation(bytes[i]) {
                                                i += 1;
                                            }
                                        }
                                    }
                                } else {
                                    i += 1;
                                }
                            }
                            if i < len {
                                i += 1; // skip closing quote
                            }
                            continue;
                        }
                        _ => {}
                    }
                    if depth > 0 {
                        i += 1;
                    }
                }

                let expr_end = i; // position of } or end of string
                if depth == 0 {
                    i += 1; // skip }
                } else {
                    errors.push(ParseError::Forbidden {
                        message: "unclosed '{' in string interpolation".into(),
                        span: Span::new(brace_offset, base_offset + expr_end as u32),
                    });
                }

                // Parse the expression using a sub-parser starting at the absolute offset
                let expr_offset = base_offset + expr_start as u32;
                let end_offset = base_offset + expr_end as u32;
                let expr = parse_complex_interpolation(
                    arena,
                    source,
                    Span::new(expr_offset, end_offset),
                    version,
                    nesting_depth,
                    depth == 0,
                    errors,
                );
                if depth == 0 {
                    check_curly_interpolation(&expr, errors);
                }
                parts.push(StringPart::Expr(expr));
                literal_start = i;
            }
            _ => {
                // Regular character — push to owned buffer only if we're already materialised.
                if let Some(ref mut buf) = owned {
                    if bytes[i] < 0x80 {
                        buf.push(bytes[i]);
                        i += 1;
                    } else {
                        let seq_start = i;
                        i += 1;
                        while i < len && is_utf8_continuation(bytes[i]) {
                            i += 1;
                        }
                        buf.extend_from_slice(&inner.as_bytes()[seq_start..i]);
                    }
                } else {
                    i += 1;
                }
            }
        }
    }

    // Flush remaining literal run.
    if let Some(buf) = owned {
        if !buf.is_empty() {
            parts.push(StringPart::Literal(ByteStr::new_in(arena, &buf)));
        }
    } else if i > literal_start {
        parts.push(StringPart::Literal(ByteStr::from_source(
            &inner[literal_start..i],
        )));
    }

    parts
}

/// Length of the indentation PHP strips from a heredoc line: up to `indent_len` spaces or tabs.
pub(crate) fn heredoc_indent_len(line: &[u8], indent_len: usize) -> usize {
    line.iter()
        .take(indent_len)
        .take_while(|b| matches!(b, b' ' | b'\t'))
        .count()
}

/// Parse the inner content of an indented heredoc body into parts.
/// `raw_body` must be a verbatim subslice of `source` (with indentation intact).
/// `body_offset` is the byte offset of `raw_body[0]` within `source`.
/// `indent` is the indentation prefix stripped from each line (e.g. `"    "`).
///
/// At the start and after every newline, up to `indent.len()` bytes are skipped so that
/// all source offsets remain accurate. Complex `{$expr}` interpolations are parsed
/// with a direct sub-parser on `source`, eliminating the wrapping/reoffset overhead
/// of the old `parse_interpolated_parts_heredoc` path.
#[allow(clippy::too_many_arguments)]
pub fn parse_interpolated_parts_indented<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    raw_body: &'src str,
    body_offset: u32,
    indent: &str,
    version: PhpVersion,
    nesting_depth: u32,
    errors: &mut Vec<ParseError>,
) -> ArenaVec<'arena, StringPart<'arena, 'src>> {
    let indent_len = indent.len();
    let mut parts: ArenaVec<'arena, StringPart<'arena, 'src>> =
        ArenaVec::with_capacity_in(4, arena);
    let mut literal: Vec<u8> = Vec::new();
    let bytes = raw_body.as_bytes();
    let len = bytes.len();

    // Skip leading indent on the first line
    let mut i = heredoc_indent_len(bytes, indent_len);

    while i < len {
        match bytes[i] {
            b'\\' => {
                i = decode_escape_at(bytes, raw_body, i, &mut literal, errors, body_offset, false);
            }
            b'\n' => {
                // Preserve the newline in the literal, then skip the indent on the next line
                literal.push(b'\n');
                i += 1;
                i += heredoc_indent_len(&bytes[i..], indent_len);
            }
            b'$' => {
                if i + 1 < len && bytes[i + 1] == b'{' {
                    if !literal.is_empty() {
                        parts.push(StringPart::Literal(ByteStr::new_in(arena, &literal)));
                        literal.clear();
                    }
                    let (expr, next) = parse_dollar_brace(
                        arena,
                        source,
                        raw_body,
                        body_offset,
                        i,
                        version,
                        nesting_depth,
                        errors,
                    );
                    parts.push(StringPart::Expr(expr));
                    i = next;
                } else if i + 1 < len && is_var_start(bytes[i + 1]) {
                    if !literal.is_empty() {
                        parts.push(StringPart::Literal(ByteStr::new_in(arena, &literal)));
                        literal.clear();
                    }
                    let var_start = i;
                    i += 1; // skip $
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                        while i < len && is_utf8_continuation(bytes[i]) {
                            i += 1;
                        }
                    }
                    // raw_body is &'src str so we can borrow directly
                    let var_name: &'src str = &raw_body[name_start..i];
                    let var_offset = body_offset + var_start as u32;

                    let mut expr = Expr {
                        kind: ExprKind::Variable(NameStr::from_source(var_name)),
                        span: Span::new(var_offset, body_offset + i as u32),
                    };

                    if let Some((arrow_len, nullsafe)) = property_arrow(bytes, i, version) {
                        i += arrow_len;
                        let pname_start = i;
                        while i < len && is_var_char(bytes[i]) {
                            i += 1;
                            while i < len && is_utf8_continuation(bytes[i]) {
                                i += 1;
                            }
                        }
                        let prop_name: &'src str = &raw_body[pname_start..i];
                        let prop_span =
                            Span::new(body_offset + pname_start as u32, body_offset + i as u32);
                        let span = Span::new(var_offset, body_offset + i as u32);
                        let access = PropertyAccessExpr {
                            object: arena.alloc(expr),
                            property: arena.alloc(Expr {
                                kind: ExprKind::Identifier(NameStr::from_source(prop_name)),
                                span: prop_span,
                            }),
                        };
                        let kind = if nullsafe {
                            ExprKind::NullsafePropertyAccess(access)
                        } else {
                            ExprKind::PropertyAccess(access)
                        };
                        expr = Expr { kind, span };
                    } else if i < len && bytes[i] == b'[' {
                        let bracket_start = i;
                        i += 1; // skip [
                        let idx_start = i;
                        while i < len && bytes[i] != b']' {
                            i += 1;
                        }
                        if i < len && bytes[i] == b']' {
                            let idx_str = &raw_body[idx_start..i];
                            i += 1; // skip ]
                            if idx_str.is_empty() {
                                errors.push(ParseError::Forbidden {
                                    message: "empty index in string interpolation".into(),
                                    span: Span::new(
                                        body_offset + bracket_start as u32,
                                        body_offset + i as u32,
                                    ),
                                });
                            } else {
                                let idx_offset = body_offset + idx_start as u32;
                                let idx_end = body_offset + (i - 1) as u32;
                                check_simple_offset(
                                    idx_str,
                                    Span::new(idx_offset, idx_end),
                                    errors,
                                );
                                let index_expr =
                                    parse_simple_index(source, idx_str, idx_offset, idx_end);
                                let span = Span::new(var_offset, body_offset + i as u32);
                                expr = Expr {
                                    kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                        array: arena.alloc(expr),
                                        index: Some(arena.alloc(index_expr)),
                                    }),
                                    span,
                                };
                            }
                        } else {
                            errors.push(ParseError::Forbidden {
                                message: "unclosed '[' in string interpolation".into(),
                                span: Span::new(
                                    body_offset + bracket_start as u32,
                                    body_offset + len as u32,
                                ),
                            });
                            i = bracket_start;
                        }
                    }
                    parts.push(StringPart::Expr(expr));
                } else {
                    literal.push(b'$');
                    i += 1;
                }
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => {
                if !literal.is_empty() {
                    parts.push(StringPart::Literal(ByteStr::new_in(arena, &literal)));
                    literal.clear();
                }
                let brace_offset = body_offset + i as u32;
                i += 1; // skip {
                let expr_start = i;
                let mut depth = 1;
                while i < len && depth > 0 {
                    match bytes[i] {
                        b'{' => depth += 1,
                        b'}' => depth -= 1,
                        b'\'' | b'"' => {
                            let quote = bytes[i];
                            i += 1;
                            while i < len && bytes[i] != quote {
                                if bytes[i] == b'\\' {
                                    i += 1;
                                }
                                i += 1;
                            }
                            if i < len {
                                i += 1;
                            }
                            continue;
                        }
                        _ => {}
                    }
                    if depth > 0 {
                        i += 1;
                    }
                }
                let expr_end = i;
                if depth == 0 {
                    i += 1; // skip }
                } else {
                    errors.push(ParseError::Forbidden {
                        message: "unclosed '{' in string interpolation".into(),
                        span: Span::new(brace_offset, body_offset + expr_end as u32),
                    });
                }
                // raw_body is a verbatim source slice, so body_offset + expr_start is the
                // correct absolute position — use the fast sub-parser path directly.
                let expr_offset = body_offset + expr_start as u32;
                let end_offset = body_offset + expr_end as u32;
                let expr = parse_complex_interpolation(
                    arena,
                    source,
                    Span::new(expr_offset, end_offset),
                    version,
                    nesting_depth,
                    depth == 0,
                    errors,
                );
                if depth == 0 {
                    check_curly_interpolation(&expr, errors);
                }
                parts.push(StringPart::Expr(expr));
            }
            _ => {
                if bytes[i] < 0x80 {
                    literal.push(bytes[i]);
                    i += 1;
                } else {
                    let seq_start = i;
                    i += 1;
                    while i < len && is_utf8_continuation(bytes[i]) {
                        i += 1;
                    }
                    literal.extend_from_slice(&raw_body.as_bytes()[seq_start..i]);
                }
            }
        }
    }

    if !literal.is_empty() {
        parts.push(StringPart::Literal(ByteStr::new_in(arena, &literal)));
    }

    parts
}
/// Decode one backslash escape at `bytes[i]` (`bytes[i]` must be `b'\\'`).
/// Returns the new position after the escape.
/// `text` is the `&str` whose bytes are `bytes`.
/// `stop_at_dquote`: when true, the malformed `\u{…}` recovery also stops at `"`.
fn decode_escape_at(
    bytes: &[u8],
    text: &str,
    i: usize,
    out: &mut Vec<u8>,
    errors: &mut Vec<ParseError>,
    span_base: u32,
    stop_at_dquote: bool,
) -> usize {
    let len = bytes.len();
    if i + 1 >= len {
        out.push(b'\\');
        return i + 1;
    }
    let next = bytes[i + 1];
    match next {
        b'$' => {
            out.push(b'$');
            i + 2
        }
        b'\\' => {
            out.push(b'\\');
            i + 2
        }
        b'n' => {
            out.push(b'\n');
            i + 2
        }
        b'r' => {
            out.push(b'\r');
            i + 2
        }
        b't' => {
            out.push(b'\t');
            i + 2
        }
        b'v' => {
            out.push(b'\x0B');
            i + 2
        }
        b'e' => {
            out.push(b'\x1B');
            i + 2
        }
        b'f' => {
            out.push(b'\x0C');
            i + 2
        }
        b'"' => {
            out.push(b'"');
            i + 2
        }
        b'x' | b'X' => {
            let mut j = i + 2;
            let start = j;
            while j < len && j - start < 2 && bytes[j].is_ascii_hexdigit() {
                j += 1;
            }
            if j > start {
                if let Ok(val) = u8::from_str_radix(&text[start..j], 16) {
                    out.push(val);
                }
            } else {
                out.push(b'\\');
                out.push(b'x');
            }
            j
        }
        b'u' => {
            let escape_start = i;
            let mut j = i + 2;
            if j < len && bytes[j] == b'{' {
                j += 1;
                let start = j;
                while j < len && bytes[j].is_ascii_hexdigit() {
                    j += 1;
                }
                if j < len && bytes[j] == b'}' {
                    let hex = &text[start..j];
                    j += 1;
                    let span = Span::new(span_base + escape_start as u32, span_base + j as u32);
                    if hex.is_empty() {
                        errors.push(ParseError::Forbidden {
                            message: "Invalid UTF-8 codepoint escape sequence: empty code point"
                                .into(),
                            span,
                        });
                    } else if let Ok(codepoint) = u32::from_str_radix(hex, 16) {
                        if let Some(c) = char::from_u32(codepoint) {
                            let mut utf8 = [0u8; 4];
                            out.extend_from_slice(c.encode_utf8(&mut utf8).as_bytes());
                        } else if (0xD800..=0xDFFF).contains(&codepoint) {
                            // PHP encodes surrogates as their three UTF-8 bytes, stored one
                            // char per byte like `\x` escapes.
                            out.push((0xE0 | (codepoint >> 12)) as u8);
                            out.push((0x80 | ((codepoint >> 6) & 0x3F)) as u8);
                            out.push((0x80 | (codepoint & 0x3F)) as u8);
                        } else {
                            errors.push(ParseError::Forbidden {
                                message:
                                    "Invalid UTF-8 codepoint escape sequence: Codepoint too large"
                                        .into(),
                                span,
                            });
                        }
                    } else {
                        // hex value overflows u32 (e.g. \u{FFFFFFFFFFFFFFFF})
                        errors.push(ParseError::Forbidden {
                            message: "Invalid UTF-8 codepoint escape sequence: Codepoint too large"
                                .into(),
                            span,
                        });
                    }
                } else {
                    while j < len
                        && bytes[j] != b'}'
                        && bytes[j] != b'\n'
                        && !(stop_at_dquote && bytes[j] == b'"')
                    {
                        j += 1;
                    }
                    if j < len && bytes[j] == b'}' {
                        j += 1;
                    }
                    errors.push(ParseError::Forbidden {
                        message: "Invalid UTF-8 codepoint escape sequence".into(),
                        span: Span::new(span_base + escape_start as u32, span_base + j as u32),
                    });
                }
            } else {
                out.push(b'\\');
                out.push(b'u');
            }
            j
        }
        b'0'..=b'7' => {
            let start = i + 1;
            let mut j = i + 1;
            while j < len && j - start < 3 && bytes[j] >= b'0' && bytes[j] <= b'7' {
                j += 1;
            }
            // PHP keeps the low byte of `\400`..`\777`.
            if let Ok(val) = u16::from_str_radix(&text[start..j], 8) {
                out.push(val as u8);
            }
            j
        }
        _ => {
            out.push(b'\\');
            // The character after the backslash might be multi-byte UTF-8
            if next < 0x80 {
                out.push(next);
                i + 2
            } else {
                // Read the entire multi-byte sequence and push it
                let mut j = i + 2;
                while j < len && is_utf8_continuation(bytes[j]) {
                    j += 1;
                }
                out.extend_from_slice(&text.as_bytes()[i + 1..j]);
                j
            }
        }
    }
}

/// Check if a string inner content contains interpolation (unescaped $)
pub fn has_interpolation(inner: &str) -> bool {
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;
    // Only `\`, `$` and `{` matter, so jump between them. A UTF-8 continuation
    // byte never equals one of them, so skipping just the byte after a
    // backslash is enough to step over an escaped multi-byte character.
    while let Some(offset) = memchr::memchr3(b'\\', b'$', b'{', &bytes[i..]) {
        i += offset;
        match bytes[i] {
            b'\\' => {
                i = (i + 2).min(len);
                continue;
            }
            b'$' if i + 1 < len && (is_var_start(bytes[i + 1]) || bytes[i + 1] == b'{') => {
                return true;
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => return true,
            _ => {}
        }
        i += 1;
    }
    false
}

/// Report malformed escape sequences in the raw body of a heredoc without interpolation.
pub fn check_heredoc_escapes(raw_body: &str, body_offset: u32, errors: &mut Vec<ParseError>) {
    let bytes = raw_body.as_bytes();
    let mut discarded = Vec::new();
    let mut i = 0;
    while i < bytes.len() {
        if bytes[i] == b'\\' {
            i = decode_escape_at(
                bytes,
                raw_body,
                i,
                &mut discarded,
                errors,
                body_offset,
                false,
            );
            discarded.clear();
        } else {
            i += 1;
        }
    }
}

/// Process escape sequences in a heredoc string without interpolation.
pub fn process_heredoc_escapes(inner: &str) -> Vec<u8> {
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;
    let mut out = Vec::with_capacity(len);
    let mut errors = Vec::new();

    while i < len {
        if bytes[i] == b'\\' {
            i = decode_escape_at(bytes, inner, i, &mut out, &mut errors, 0, false);
        } else if bytes[i] < 0x80 {
            out.push(bytes[i]);
            i += 1;
        } else {
            let seq_start = i;
            i += 1;
            while i < len && is_utf8_continuation(bytes[i]) {
                i += 1;
            }
            out.extend_from_slice(&inner.as_bytes()[seq_start..i]);
        }
    }
    out
}

/// The length of the `->` (or, from PHP 8.0, `?->`) at `i` in a simple
/// interpolation, and whether it is nullsafe; `None` unless a name follows.
fn property_arrow(bytes: &[u8], i: usize, version: PhpVersion) -> Option<(usize, bool)> {
    let rest = bytes.get(i..)?;
    let (arrow_len, nullsafe) = if rest.starts_with(b"->") {
        (2, false)
    } else if rest.starts_with(b"?->") && version >= PhpVersion::Php80 {
        (3, true)
    } else {
        return None;
    };
    rest.get(arrow_len)
        .is_some_and(|&b| is_var_start(b))
        .then_some((arrow_len, nullsafe))
}

fn is_var_start(b: u8) -> bool {
    b.is_ascii_alphabetic() || b == b'_' || (0xC2..=0xF4).contains(&b)
}

fn is_var_char(b: u8) -> bool {
    b.is_ascii_alphanumeric() || b == b'_' || (0xC2..=0xF4).contains(&b)
}

fn is_utf8_continuation(b: u8) -> bool {
    (b & 0xC0) == 0x80
}

/// Report an offset in `"$a[...]"` that PHP's lexer does not accept there: only a name, a
/// `$variable` or an optionally negated number, with no quotes or whitespace.
fn check_simple_offset(idx: &str, span: Span, errors: &mut Vec<ParseError>) {
    let bytes = idx.as_bytes();
    let is_name_byte = |c: &u8| c.is_ascii_alphanumeric() || *c == b'_' || *c >= 0x80;
    let is_name =
        |b: &[u8]| b.first().is_some_and(|c| !c.is_ascii_digit()) && b.iter().all(is_name_byte);
    let digits = bytes.strip_prefix(b"-").unwrap_or(bytes);
    let is_number = match digits {
        [b'0', b'x' | b'X', rest @ ..] => {
            !rest.is_empty() && rest.iter().all(|c| c.is_ascii_hexdigit() || *c == b'_')
        }
        [b'0', b'b' | b'B', rest @ ..] => {
            !rest.is_empty() && rest.iter().all(|c| matches!(c, b'0' | b'1' | b'_'))
        }
        [b'0', b'o' | b'O', rest @ ..] => {
            !rest.is_empty() && rest.iter().all(|c| matches!(c, b'0'..=b'7' | b'_'))
        }
        [first, ..] => {
            first.is_ascii_digit() && digits.iter().all(|c| c.is_ascii_digit() || *c == b'_')
        }
        [] => false,
    };
    let valid = is_number || is_name(bytes) || bytes.strip_prefix(b"$").is_some_and(is_name);
    if !valid {
        errors.push(ParseError::Forbidden {
            message: "invalid offset in simple string interpolation".into(),
            span,
        });
    }
}

/// Parse an array index from simple string interpolation: `$arr[expr]`.
/// Handles integers (including negative like `-1`), `$variable` references,
/// and bare string keys (e.g. `$arr[key]`).
///
/// PHP's integer-index rule is stricter than Rust's `parse::<i64>()`:
/// only `"0"` or `[1-9][0-9]*` are valid positive indices, and `-[1-9][0-9]*`
/// for negative. Forms like `"-0"`, `"00"`, `"07"` are string keys.
fn parse_simple_index<'arena, 'src>(
    source: &'src str,
    idx_str: &str,
    idx_offset: u32,
    idx_end: u32,
) -> Expr<'arena, 'src> {
    let span = Span::new(idx_offset, idx_end);
    // Negative integer: must be `-` followed by [1-9][0-9]* (no leading zero, no "-0")
    if let Some(digits) = idx_str.strip_prefix('-') {
        if is_php_interp_nonzero_int(digits) {
            if let Ok(num) = digits.parse::<i64>() {
                return Expr {
                    kind: ExprKind::Int(-num),
                    span,
                };
            }
        }
    // Positive integer: "0" or [1-9][0-9]*
    } else if is_php_interp_int(idx_str) {
        if let Ok(num) = idx_str.parse::<i64>() {
            return Expr {
                kind: ExprKind::Int(num),
                span,
            };
        }
    }
    // Variable index: $var
    if idx_str.starts_with('$') && idx_str.len() > 1 {
        let name_start = idx_offset as usize + 1;
        let name_end = idx_offset as usize + idx_str.len();
        return Expr {
            kind: ExprKind::Variable(NameStr::from_source(&source[name_start..name_end])),
            span,
        };
    }
    // Bare string key (e.g. $arr[key], $arr[-0], $arr[00])
    let key_start = idx_offset as usize;
    let key_end = idx_end as usize;
    Expr {
        kind: ExprKind::String(ByteStr::from_source(&source[key_start..key_end])),
        span,
    }
}

/// Returns true if `s` is a valid PHP simple-interpolation positive integer: `"0"` or `[1-9][0-9]*`.
/// Rejects leading-zero forms like `"00"` or `"07"` which PHP treats as string keys.
fn is_php_interp_int(s: &str) -> bool {
    match s.as_bytes() {
        [b'0'] => true,
        [first, rest @ ..] if *first >= b'1' && *first <= b'9' => {
            rest.iter().all(|b| b.is_ascii_digit())
        }
        _ => false,
    }
}

/// Returns true if `s` is a valid PHP simple-interpolation nonzero integer: `[1-9][0-9]*`.
/// Used for the digits after `-`; `-0` is a string key in PHP, not an integer.
fn is_php_interp_nonzero_int(s: &str) -> bool {
    match s.as_bytes() {
        [first, rest @ ..] if *first >= b'1' && *first <= b'9' => {
            rest.iter().all(|b| b.is_ascii_digit())
        }
        _ => false,
    }
}

/// Parse `${name}`, `${name[expr]}` or `${expr}` starting at the `$` in `text`, a verbatim
/// slice of `source` at `offset`. Returns the expression and the position after the `}`.
#[allow(clippy::too_many_arguments)]
fn parse_dollar_brace<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    text: &'src str,
    offset: u32,
    dollar: usize,
    version: PhpVersion,
    nesting_depth: u32,
    errors: &mut Vec<ParseError>,
) -> (Expr<'arena, 'src>, usize) {
    let bytes = text.as_bytes();
    let content_start = dollar + 2;
    let (close, closed) = find_closing_brace(bytes, content_start);
    let after = if closed { close + 1 } else { close };
    let span = Span::new(offset + dollar as u32, offset + after as u32);
    if !closed {
        errors.push(ParseError::Forbidden {
            message: "unclosed '${' in string interpolation".into(),
            span,
        });
    }
    let sub_expr = |start: usize, end: usize, report: bool, errors: &mut Vec<ParseError>| {
        parse_complex_interpolation(
            arena,
            source,
            Span::new(offset + start as u32, offset + end as u32),
            version,
            nesting_depth,
            closed && report,
            errors,
        )
    };

    // PHP reads a label directly followed by `}` or `[` as a variable name, anything else as an
    // expression whose value names the variable.
    let mut name_end = content_start;
    if name_end < close && is_var_start(bytes[name_end]) {
        while name_end < close && is_var_char(bytes[name_end]) {
            name_end += 1;
            while name_end < close && is_utf8_continuation(bytes[name_end]) {
                name_end += 1;
            }
        }
    }
    let is_name = name_end > content_start
        && (name_end == close || (bytes[name_end] == b'[' && bytes[close - 1] == b']'));
    if !is_name {
        let empty = text[content_start..close].trim().is_empty();
        if empty {
            errors.push(ParseError::Forbidden {
                message: "empty variable name in '${...}' string interpolation".into(),
                span,
            });
        }
        let inner = sub_expr(content_start, close, !empty, errors);
        let expr = Expr {
            kind: ExprKind::VariableVariable(arena.alloc(inner)),
            span,
        };
        return (expr, after);
    }

    let var = Expr {
        kind: ExprKind::Variable(NameStr::from_source(&text[content_start..name_end])),
        span: Span::new(offset + content_start as u32, offset + name_end as u32),
    };
    if name_end == close {
        return (var, after);
    }
    let empty = text[name_end + 1..close - 1].trim().is_empty();
    if empty {
        errors.push(ParseError::Forbidden {
            message: "empty index in string interpolation".into(),
            span: Span::new(offset + name_end as u32, offset + close as u32),
        });
    }
    let index = sub_expr(name_end + 1, close - 1, !empty, errors);
    let expr = Expr {
        kind: ExprKind::ArrayAccess(ArrayAccessExpr {
            array: arena.alloc(var),
            index: Some(arena.alloc(index)),
        }),
        span,
    };
    (expr, after)
}

/// Find the `}` closing an interpolation whose body starts at `i`, skipping quoted strings.
/// Returns its position and whether it was found; otherwise the position is the end of `bytes`.
fn find_closing_brace(bytes: &[u8], mut i: usize) -> (usize, bool) {
    let mut depth = 1usize;
    while i < bytes.len() {
        match bytes[i] {
            b'{' => depth += 1,
            b'}' => {
                depth -= 1;
                if depth == 0 {
                    return (i, true);
                }
            }
            quote @ (b'\'' | b'"') => {
                i += 1;
                while i < bytes.len() && bytes[i] != quote {
                    i += if bytes[i] == b'\\' { 2 } else { 1 };
                }
            }
            _ => {}
        }
        i += 1;
    }
    (bytes.len(), false)
}

/// Report a `{$...}` interpolation that is not a variable, fetch or call, which PHP rejects.
fn check_curly_interpolation(expr: &Expr<'_, '_>, errors: &mut Vec<ParseError>) {
    let message = match expr.kind {
        ExprKind::ClassConstAccess(_) | ExprKind::ClassConstAccessDynamic { .. } => {
            "class constant access is not valid as a standalone interpolation expression"
        }
        _ if crate::expr::is_variable_or_call(&expr.kind) => return,
        _ => "only a variable, property, index or call can be interpolated with '{$...}'",
    };
    errors.push(ParseError::Forbidden {
        message: message.into(),
        span: expr.span,
    });
}

/// Parse a complex interpolation expression using a sub-parser that starts directly
/// in the original source at the given offset, avoiding string allocation and span reoffset.
fn parse_complex_interpolation<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    span: Span,
    version: PhpVersion,
    nesting_depth: u32,
    report_syntax_errors: bool,
    errors: &mut Vec<ParseError>,
) -> Expr<'arena, 'src> {
    let nesting_depth = nesting_depth + INTERPOLATION_NESTING_COST;
    let (offset, end) = (span.start, span.end);
    if nesting_depth > MAX_NESTING_DEPTH {
        errors.push(ParseError::NestingTooDeep { span });
        return Expr {
            kind: ExprKind::Error,
            span,
        };
    }
    // Bounding the source at `end` stops a stray backtick or quote from re-lexing the rest of the file.
    let bounded = source.get(..end as usize).unwrap_or(source);
    let mut sub =
        crate::parser::Parser::new_at(arena, bounded, offset as usize, version, nesting_depth);
    let expr = crate::expr::parse_expr(&mut sub);
    if sub.empty_dim_count > 0 {
        crate::stmt::check_empty_dims(&mut sub, &[], &[&expr]);
    }
    if report_syntax_errors && !sub.check(php_lexer::TokenKind::Eof) {
        sub.error(ParseError::Expected {
            expected: "'}'".into(),
            found: sub.current_kind().description().into(),
            span: sub.current_span(),
        });
    }
    // Where the enclosing interpolation already reported an error, only a blown nesting
    // budget is kept, or the cut-off subtree would pass silently.
    errors.extend(
        sub.into_errors()
            .into_iter()
            .filter(|e| report_syntax_errors || matches!(e, ParseError::NestingTooDeep { .. })),
    );
    if matches!(expr.kind, ExprKind::Error) {
        Expr {
            kind: ExprKind::Error,
            span: Span::new(offset, end),
        }
    } else {
        expr
    }
}

#[cfg(test)]
mod tests {
    #[allow(unused_imports)]
    use super::*;

    #[test]
    fn indented_heredoc_simple_var() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse_arena(&arena, "<?php\n$x = <<<END\n    Hello $name!\n    END;\n");
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_heredoc_complex_interpolation() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse_arena(
            &arena,
            "<?php\n$x = <<<END\n    Hello {$obj->name}!\n    END;\n",
        );
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_heredoc_multiline_interpolation() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse_arena(
            &arena,
            "<?php\n$x = <<<END\n    Line 1 {$a}\n    Line 2 {$b}\n    END;\n",
        );
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_nowdoc() {
        let arena = bumpalo::Bump::new();
        let result =
            crate::parse_arena(&arena, "<?php\n$x = <<<'END'\n    Hello world!\n    END;\n");
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }
}
