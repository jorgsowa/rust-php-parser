use php_ast::*;

use crate::diagnostics::ParseError;
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
    errors: &mut Vec<ParseError>,
) -> ArenaVec<'arena, StringPart<'arena, 'src>> {
    let mut parts = ArenaVec::with_capacity_in(8, arena);
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;

    // Start of the current literal run within `inner`.
    let mut literal_start = 0usize;
    // Accumulated owned string; present only when the run contains escape sequences.
    let mut owned: Option<String> = None;

    while i < len {
        match bytes[i] {
            b'\\' => {
                // Materialise an owned buffer for this run if not already done.
                let buf = owned.get_or_insert_with(|| inner[literal_start..i].to_string());
                if i + 1 < len {
                    let next = bytes[i + 1];
                    match next {
                        b'$' => {
                            buf.push('$');
                            i += 2;
                        }
                        b'\\' => {
                            buf.push('\\');
                            i += 2;
                        }
                        b'n' => {
                            buf.push('\n');
                            i += 2;
                        }
                        b'r' => {
                            buf.push('\r');
                            i += 2;
                        }
                        b't' => {
                            buf.push('\t');
                            i += 2;
                        }
                        b'v' => {
                            buf.push('\x0B');
                            i += 2;
                        }
                        b'e' => {
                            buf.push('\x1B');
                            i += 2;
                        }
                        b'f' => {
                            buf.push('\x0C');
                            i += 2;
                        }
                        b'"' => {
                            buf.push('"');
                            i += 2;
                        }
                        b'x' | b'X' => {
                            // Hex escape: \xNN
                            i += 2;
                            let start = i;
                            while i < len && i - start < 2 && bytes[i].is_ascii_hexdigit() {
                                i += 1;
                            }
                            if i > start {
                                if let Ok(val) = u8::from_str_radix(&inner[start..i], 16) {
                                    buf.push(val as char);
                                }
                            } else {
                                buf.push('\\');
                                buf.push('x');
                            }
                        }
                        b'u' => {
                            // Unicode escape: \u{HHHH} — PHP 7.0+
                            let escape_start = i;
                            i += 2;
                            if i < len && bytes[i] == b'{' {
                                i += 1; // skip {
                                let start = i;
                                while i < len && bytes[i].is_ascii_hexdigit() {
                                    i += 1;
                                }
                                if i < len && bytes[i] == b'}' {
                                    let hex = &inner[start..i];
                                    i += 1; // skip }
                                    let span = Span::new(
                                        base_offset + escape_start as u32,
                                        base_offset + i as u32,
                                    );
                                    if hex.is_empty() {
                                        errors.push(ParseError::Forbidden {
                                            message: "Invalid UTF-8 codepoint escape sequence: empty code point".into(),
                                            span,
                                        });
                                    } else if let Ok(codepoint) = u32::from_str_radix(hex, 16) {
                                        if let Some(c) = char::from_u32(codepoint) {
                                            buf.push(c);
                                        } else {
                                            errors.push(ParseError::Forbidden {
                                                message: "Invalid UTF-8 codepoint escape sequence: Codepoint too large".into(),
                                                span,
                                            });
                                        }
                                    }
                                } else {
                                    // Invalid hex content (e.g. \u{ZZZZ}) — scan to closing } for recovery
                                    while i < len
                                        && bytes[i] != b'}'
                                        && bytes[i] != b'"'
                                        && bytes[i] != b'\n'
                                    {
                                        i += 1;
                                    }
                                    if i < len && bytes[i] == b'}' {
                                        i += 1; // skip }
                                    }
                                    errors.push(ParseError::Forbidden {
                                        message: "Invalid UTF-8 codepoint escape sequence".into(),
                                        span: Span::new(
                                            base_offset + escape_start as u32,
                                            base_offset + i as u32,
                                        ),
                                    });
                                }
                            } else {
                                buf.push('\\');
                                buf.push('u');
                            }
                        }
                        b'0'..=b'7' => {
                            // Octal escape: \NNN (up to 3 digits)
                            let start = i + 1;
                            i += 1;
                            while i < len && i - start < 3 && bytes[i] >= b'0' && bytes[i] <= b'7' {
                                i += 1;
                            }
                            if let Ok(val) = u8::from_str_radix(&inner[start..i], 8) {
                                buf.push(val as char);
                            }
                        }
                        _ => {
                            // Unknown escape: keep as-is
                            buf.push('\\');
                            buf.push(next as char);
                            i += 2;
                        }
                    }
                } else {
                    buf.push('\\');
                    i += 1;
                }
            }
            b'$' => {
                // Deprecated ${varname} syntax (PHP < 8.2): ${ ... }
                if i + 1 < len && bytes[i + 1] == b'{' {
                    if let Some(buf) = owned.take() {
                        if !buf.is_empty() {
                            parts.push(StringPart::Literal(arena.alloc_str(&buf)));
                        }
                    } else if i > literal_start {
                        parts.push(StringPart::Literal(
                            arena.alloc_str(&inner[literal_start..i]),
                        ));
                    }
                    i += 2; // skip ${
                    let var_offset = base_offset + (i - 2) as u32;
                    if i < len && bytes[i] == b'$' {
                        // ${$foo} — variable variable; use sub-parser from the inner $
                        let expr_start = i;
                        let mut depth = 1usize;
                        while i < len && depth > 0 {
                            match bytes[i] {
                                b'{' => depth += 1,
                                b'}' => depth -= 1,
                                _ => {}
                            }
                            if depth > 0 {
                                i += 1;
                            }
                        }
                        let inner_expr = parse_complex_interpolation(
                            arena,
                            source,
                            base_offset + expr_start as u32,
                            base_offset + i as u32,
                            version,
                        );
                        if i < len {
                            i += 1; // skip }
                        } else {
                            errors.push(ParseError::Forbidden {
                                message: "unclosed '${' in string interpolation".into(),
                                span: Span::new(var_offset, base_offset + i as u32),
                            });
                        }
                        parts.push(StringPart::Expr(Expr {
                            kind: ExprKind::VariableVariable(arena.alloc(inner_expr)),
                            span: Span::new(var_offset, base_offset + i as u32),
                        }));
                    } else {
                        // ${varname} or ${varname[index]} — identifier as variable name
                        let name_start = i;
                        while i < len && is_var_char(bytes[i]) {
                            i += 1;
                        }
                        let var_name: &'src str =
                            &source[base_offset as usize + name_start..base_offset as usize + i];
                        let mut expr = Expr {
                            kind: ExprKind::Variable(NameStr::Src(var_name)),
                            span: Span::new(
                                base_offset + name_start as u32,
                                base_offset + i as u32,
                            ),
                        };
                        // Optional [index]
                        if i < len && bytes[i] == b'[' {
                            let bracket_offset = base_offset + i as u32;
                            i += 1;
                            let idx_start = i;
                            while i < len && bytes[i] != b']' && bytes[i] != b'}' {
                                i += 1;
                            }
                            if i < len && bytes[i] == b']' {
                                let idx_str = &inner[idx_start..i];
                                i += 1;
                                if idx_str.is_empty() {
                                    errors.push(ParseError::Forbidden {
                                        message: "empty index in string interpolation".into(),
                                        span: Span::new(bracket_offset, base_offset + i as u32),
                                    });
                                } else {
                                    let idx_offset = base_offset + idx_start as u32;
                                    let idx_end = base_offset + (i - 1) as u32;
                                    let index_expr = parse_simple_index(
                                        arena, source, idx_str, idx_offset, idx_end,
                                    );
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
                                    message: "unclosed '[' in string offset interpolation".into(),
                                    span: Span::new(bracket_offset, base_offset + i as u32),
                                });
                            }
                        }
                        // Skip to closing }
                        while i < len && bytes[i] != b'}' {
                            i += 1;
                        }
                        if i < len {
                            i += 1; // skip }
                        }
                        parts.push(StringPart::Expr(expr));
                    }
                    literal_start = i;
                // Check for {$ (complex syntax handled below) - this is simple $var
                } else if i + 1 < len && is_var_start(bytes[i + 1]) {
                    // Flush literal run.
                    if let Some(buf) = owned.take() {
                        if !buf.is_empty() {
                            parts.push(StringPart::Literal(arena.alloc_str(&buf)));
                        }
                    } else if i > literal_start {
                        parts.push(StringPart::Literal(
                            arena.alloc_str(&inner[literal_start..i]),
                        ));
                    }

                    // Parse variable name
                    let var_start = i;
                    i += 1; // skip $
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                    }
                    let var_name: &'src str =
                        &source[base_offset as usize + name_start..base_offset as usize + i];
                    let var_offset = base_offset + var_start as u32;

                    let mut expr = Expr {
                        kind: ExprKind::Variable(NameStr::Src(var_name)),
                        span: Span::new(var_offset, base_offset + i as u32),
                    };

                    // Check for ->identifier (simple property access)
                    if i + 2 < len && bytes[i] == b'-' && bytes[i + 1] == b'>' {
                        let prop_start = i + 2;
                        if prop_start < len && is_var_start(bytes[prop_start]) {
                            i = prop_start;
                            let pname_start = i;
                            while i < len && is_var_char(bytes[i]) {
                                i += 1;
                            }
                            let prop_name: &'src str = &source
                                [base_offset as usize + pname_start..base_offset as usize + i];
                            let prop_span =
                                Span::new(base_offset + pname_start as u32, base_offset + i as u32);
                            let span = Span::new(var_offset, base_offset + i as u32);
                            expr = Expr {
                                kind: ExprKind::PropertyAccess(PropertyAccessExpr {
                                    object: arena.alloc(expr),
                                    property: arena.alloc(Expr {
                                        kind: ExprKind::Identifier(NameStr::Src(prop_name)),
                                        span: prop_span,
                                    }),
                                }),
                                span,
                            };
                        }
                    }

                    // Check for [index] (simple array access)
                    if i < len && bytes[i] == b'[' {
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

                                let index_expr =
                                    parse_simple_index(arena, source, idx_str, idx_offset, idx_end);

                                let span = Span::new(var_offset, base_offset + i as u32);
                                expr = Expr {
                                    kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                        array: arena.alloc(expr),
                                        index: Some(arena.alloc(index_expr)),
                                    }),
                                    span,
                                };
                            }
                        }
                    }

                    parts.push(StringPart::Expr(expr));
                    literal_start = i;
                } else {
                    // Plain `$` not starting a variable — keep in literal run.
                    if let Some(ref mut buf) = owned {
                        buf.push('$');
                    }
                    i += 1;
                }
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => {
                // Complex syntax: {$expr}
                if let Some(buf) = owned.take() {
                    if !buf.is_empty() {
                        parts.push(StringPart::Literal(arena.alloc_str(&buf)));
                    }
                } else if i > literal_start {
                    parts.push(StringPart::Literal(
                        arena.alloc_str(&inner[literal_start..i]),
                    ));
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
                                    i += 1; // skip escaped char
                                }
                                i += 1;
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
                let expr =
                    parse_complex_interpolation(arena, source, expr_offset, end_offset, version);
                if matches!(
                    expr.kind,
                    ExprKind::ClassConstAccess(_) | ExprKind::ClassConstAccessDynamic { .. }
                ) {
                    errors.push(ParseError::Forbidden {
                        message: "class constant access is not valid as a standalone interpolation expression".into(),
                        span: expr.span,
                    });
                }
                parts.push(StringPart::Expr(expr));
                literal_start = i;
            }
            _ => {
                // Regular character — push to owned buffer only if we're already materialised.
                if let Some(ref mut buf) = owned {
                    buf.push(bytes[i] as char);
                }
                i += 1;
            }
        }
    }

    // Flush remaining literal run.
    if let Some(buf) = owned {
        if !buf.is_empty() {
            parts.push(StringPart::Literal(arena.alloc_str(&buf)));
        }
    } else if i > literal_start {
        parts.push(StringPart::Literal(
            arena.alloc_str(&inner[literal_start..i]),
        ));
    }

    parts
}

/// Parse the inner content of an indented heredoc body into parts.
/// `raw_body` must be a verbatim subslice of `source` (with indentation intact).
/// `body_offset` is the byte offset of `raw_body[0]` within `source`.
/// `indent` is the indentation prefix stripped from each line (e.g. `"    "`).
///
/// At the start and after every newline, `indent.len()` bytes are skipped so that
/// all source offsets remain accurate. Complex `{$expr}` interpolations are parsed
/// with a direct sub-parser on `source`, eliminating the wrapping/reoffset overhead
/// of the old `parse_interpolated_parts_heredoc` path.
pub fn parse_interpolated_parts_indented<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    raw_body: &'src str,
    body_offset: u32,
    indent: &str,
    version: PhpVersion,
    errors: &mut Vec<ParseError>,
) -> ArenaVec<'arena, StringPart<'arena, 'src>> {
    let indent_len = indent.len();
    let mut parts: ArenaVec<'arena, StringPart<'arena, 'src>> =
        ArenaVec::with_capacity_in(4, arena);
    let mut literal = String::new();
    let bytes = raw_body.as_bytes();
    let len = bytes.len();

    // Skip leading indent on the first line
    let mut i = if indent_len > 0 && len >= indent_len && raw_body[..indent_len] == *indent {
        indent_len
    } else {
        0
    };

    while i < len {
        match bytes[i] {
            b'\\' => {
                // Escape sequences
                if i + 1 < len {
                    let next = bytes[i + 1];
                    match next {
                        b'$' => {
                            literal.push('$');
                            i += 2;
                        }
                        b'\\' => {
                            literal.push('\\');
                            i += 2;
                        }
                        b'n' => {
                            literal.push('\n');
                            i += 2;
                        }
                        b'r' => {
                            literal.push('\r');
                            i += 2;
                        }
                        b't' => {
                            literal.push('\t');
                            i += 2;
                        }
                        b'v' => {
                            literal.push('\x0B');
                            i += 2;
                        }
                        b'e' => {
                            literal.push('\x1B');
                            i += 2;
                        }
                        b'f' => {
                            literal.push('\x0C');
                            i += 2;
                        }
                        b'"' => {
                            literal.push('"');
                            i += 2;
                        }
                        b'x' | b'X' => {
                            i += 2;
                            let start = i;
                            while i < len && i - start < 2 && bytes[i].is_ascii_hexdigit() {
                                i += 1;
                            }
                            if i > start {
                                if let Ok(val) = u8::from_str_radix(&raw_body[start..i], 16) {
                                    literal.push(val as char);
                                }
                            } else {
                                literal.push('\\');
                                literal.push('x');
                            }
                        }
                        b'u' => {
                            // Unicode escape: \u{HHHH} — PHP 7.0+
                            let escape_start = i;
                            i += 2;
                            if i < len && bytes[i] == b'{' {
                                i += 1; // skip {
                                let start = i;
                                while i < len && bytes[i].is_ascii_hexdigit() {
                                    i += 1;
                                }
                                if i < len && bytes[i] == b'}' {
                                    let hex = &raw_body[start..i];
                                    i += 1; // skip }
                                    let span = Span::new(
                                        body_offset + escape_start as u32,
                                        body_offset + i as u32,
                                    );
                                    if hex.is_empty() {
                                        errors.push(ParseError::Forbidden {
                                            message: "Invalid UTF-8 codepoint escape sequence: empty code point".into(),
                                            span,
                                        });
                                    } else if let Ok(codepoint) = u32::from_str_radix(hex, 16) {
                                        if let Some(c) = char::from_u32(codepoint) {
                                            literal.push(c);
                                        } else {
                                            errors.push(ParseError::Forbidden {
                                                message: "Invalid UTF-8 codepoint escape sequence: Codepoint too large".into(),
                                                span,
                                            });
                                        }
                                    }
                                } else {
                                    // Invalid hex content (e.g. \u{ZZZZ}) — scan to closing } for recovery
                                    while i < len && bytes[i] != b'}' && bytes[i] != b'\n' {
                                        i += 1;
                                    }
                                    if i < len && bytes[i] == b'}' {
                                        i += 1; // skip }
                                    }
                                    errors.push(ParseError::Forbidden {
                                        message: "Invalid UTF-8 codepoint escape sequence".into(),
                                        span: Span::new(
                                            body_offset + escape_start as u32,
                                            body_offset + i as u32,
                                        ),
                                    });
                                }
                            } else {
                                literal.push('\\');
                                literal.push('u');
                            }
                        }
                        b'0'..=b'7' => {
                            let start = i + 1;
                            i += 1;
                            while i < len && i - start < 3 && bytes[i] >= b'0' && bytes[i] <= b'7' {
                                i += 1;
                            }
                            if let Ok(val) = u8::from_str_radix(&raw_body[start..i], 8) {
                                literal.push(val as char);
                            }
                        }
                        _ => {
                            literal.push('\\');
                            literal.push(next as char);
                            i += 2;
                        }
                    }
                } else {
                    literal.push('\\');
                    i += 1;
                }
            }
            b'\n' => {
                // Preserve the newline in the literal, then skip the indent on the next line
                literal.push('\n');
                i += 1;
                if indent_len > 0 && i + indent_len <= len && raw_body[i..i + indent_len] == *indent
                {
                    i += indent_len;
                }
            }
            b'$' => {
                if i + 1 < len && is_var_start(bytes[i + 1]) {
                    if !literal.is_empty() {
                        parts.push(StringPart::Literal(arena.alloc_str(&literal)));
                        literal.clear();
                    }
                    let var_start = i;
                    i += 1; // skip $
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                    }
                    // raw_body is &'src str so we can borrow directly
                    let var_name: &'src str = &raw_body[name_start..i];
                    let var_offset = body_offset + var_start as u32;

                    let mut expr = Expr {
                        kind: ExprKind::Variable(NameStr::Src(var_name)),
                        span: Span::new(var_offset, body_offset + i as u32),
                    };

                    if i + 2 < len && bytes[i] == b'-' && bytes[i + 1] == b'>' {
                        let prop_start = i + 2;
                        if prop_start < len && is_var_start(bytes[prop_start]) {
                            i = prop_start;
                            let pname_start = i;
                            while i < len && is_var_char(bytes[i]) {
                                i += 1;
                            }
                            let prop_name: &'src str = &raw_body[pname_start..i];
                            let prop_span =
                                Span::new(body_offset + pname_start as u32, body_offset + i as u32);
                            let span = Span::new(var_offset, body_offset + i as u32);
                            expr = Expr {
                                kind: ExprKind::PropertyAccess(PropertyAccessExpr {
                                    object: arena.alloc(expr),
                                    property: arena.alloc(Expr {
                                        kind: ExprKind::Identifier(NameStr::Src(prop_name)),
                                        span: prop_span,
                                    }),
                                }),
                                span,
                            };
                        }
                    }

                    if i < len && bytes[i] == b'[' {
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
                                let index_expr =
                                    parse_simple_index(arena, source, idx_str, idx_offset, idx_end);
                                let span = Span::new(var_offset, body_offset + i as u32);
                                expr = Expr {
                                    kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                        array: arena.alloc(expr),
                                        index: Some(arena.alloc(index_expr)),
                                    }),
                                    span,
                                };
                            }
                        }
                    }
                    parts.push(StringPart::Expr(expr));
                } else {
                    literal.push('$');
                    i += 1;
                }
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => {
                if !literal.is_empty() {
                    parts.push(StringPart::Literal(arena.alloc_str(&literal)));
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
                let expr =
                    parse_complex_interpolation(arena, source, expr_offset, end_offset, version);
                if matches!(
                    expr.kind,
                    ExprKind::ClassConstAccess(_) | ExprKind::ClassConstAccessDynamic { .. }
                ) {
                    errors.push(ParseError::Forbidden {
                        message: "class constant access is not valid as a standalone interpolation expression".into(),
                        span: expr.span,
                    });
                }
                parts.push(StringPart::Expr(expr));
            }
            _ => {
                literal.push(bytes[i] as char);
                i += 1;
            }
        }
    }

    if !literal.is_empty() {
        parts.push(StringPart::Literal(arena.alloc_str(&literal)));
    }

    parts
}
/// Check if a string inner content contains interpolation (unescaped $)
pub fn has_interpolation(inner: &str) -> bool {
    let bytes = inner.as_bytes();
    let mut i = 0;
    while i < bytes.len() {
        if bytes[i] == b'\\' {
            i += 2; // skip escape
            continue;
        }
        if bytes[i] == b'$'
            && i + 1 < bytes.len()
            && (is_var_start(bytes[i + 1]) || bytes[i + 1] == b'{')
        {
            return true;
        }
        if bytes[i] == b'{' && i + 1 < bytes.len() && bytes[i + 1] == b'$' {
            return true;
        }
        i += 1;
    }
    false
}

fn is_var_start(b: u8) -> bool {
    b.is_ascii_alphabetic() || b == b'_' || b >= 0x80
}

fn is_var_char(b: u8) -> bool {
    b.is_ascii_alphanumeric() || b == b'_' || b >= 0x80
}

/// Parse an array index from simple string interpolation: `$arr[expr]`.
/// Handles integers (including negative like `-1`), `$variable` references,
/// and bare string keys (e.g. `$arr[key]`).
fn parse_simple_index<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    idx_str: &str,
    idx_offset: u32,
    idx_end: u32,
) -> Expr<'arena, 'src> {
    let span = Span::new(idx_offset, idx_end);
    // Integer index, including negative (e.g. -1)
    if let Ok(num) = idx_str.parse::<i64>() {
        return Expr {
            kind: ExprKind::Int(num),
            span,
        };
    }
    // Negative integer written as `-N`
    if let Some(digits) = idx_str.strip_prefix('-') {
        if let Ok(num) = digits.parse::<i64>() {
            return Expr {
                kind: ExprKind::Int(-num),
                span,
            };
        }
    }
    // Variable index: $var
    if idx_str.starts_with('$') && idx_str.len() > 1 {
        let name_start = idx_offset as usize + 1;
        let name_end = idx_offset as usize + idx_str.len();
        return Expr {
            kind: ExprKind::Variable(NameStr::Src(&source[name_start..name_end])),
            span,
        };
    }
    // Bare string key (e.g. $arr[key])
    let key_start = idx_offset as usize;
    let key_end = idx_end as usize;
    Expr {
        kind: ExprKind::String(arena.alloc_str(&source[key_start..key_end])),
        span,
    }
}

/// Parse a complex interpolation expression using a sub-parser that starts directly
/// in the original source at the given offset, avoiding string allocation and span reoffset.
fn parse_complex_interpolation<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    offset: u32,
    end: u32,
    version: PhpVersion,
) -> Expr<'arena, 'src> {
    let mut sub = crate::parser::Parser::new_at(arena, source, offset as usize, version);
    let expr = crate::expr::parse_expr(&mut sub);
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
        let result = crate::parse(&arena, "<?php\n$x = <<<END\n    Hello $name!\n    END;\n");
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_heredoc_complex_interpolation() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse(
            &arena,
            "<?php\n$x = <<<END\n    Hello {$obj->name}!\n    END;\n",
        );
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_heredoc_multiline_interpolation() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse(
            &arena,
            "<?php\n$x = <<<END\n    Line 1 {$a}\n    Line 2 {$b}\n    END;\n",
        );
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }

    #[test]
    fn indented_nowdoc() {
        let arena = bumpalo::Bump::new();
        let result = crate::parse(&arena, "<?php\n$x = <<<'END'\n    Hello world!\n    END;\n");
        assert!(result.errors.is_empty(), "{:?}", result.errors);
    }
}
