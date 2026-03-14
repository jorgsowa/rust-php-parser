use std::borrow::Cow;

use php_ast::*;

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
) -> ArenaVec<'arena, StringPart<'arena, 'src>> {
    let mut parts = ArenaVec::with_capacity_in(4, arena);
    let mut literal = String::new();
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;

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
                            // Hex escape: \xNN
                            i += 2;
                            let start = i;
                            while i < len && i - start < 2 && bytes[i].is_ascii_hexdigit() {
                                i += 1;
                            }
                            if i > start {
                                if let Ok(val) = u8::from_str_radix(&inner[start..i], 16) {
                                    literal.push(val as char);
                                }
                            } else {
                                literal.push('\\');
                                literal.push('x');
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
                                literal.push(val as char);
                            }
                        }
                        _ => {
                            // Unknown escape: keep as-is
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
            b'$' => {
                // Check for {$ (complex syntax handled below) - this is simple $var
                if i + 1 < len && is_var_start(bytes[i + 1]) {
                    // Flush literal
                    if !literal.is_empty() {
                        parts.push(StringPart::Literal(Cow::Owned(std::mem::take(
                            &mut literal,
                        ))));
                    }

                    // Parse variable name
                    let var_start = i;
                    i += 1; // skip $
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                    }
                    let var_name: Cow<'src, str> = Cow::Borrowed(
                        &source[base_offset as usize + name_start..base_offset as usize + i],
                    );
                    let var_offset = base_offset + var_start as u32;

                    let mut expr = Expr {
                        kind: ExprKind::Variable(var_name),
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
                            let prop_name: Cow<'src, str> = Cow::Borrowed(
                                &source
                                    [base_offset as usize + pname_start..base_offset as usize + i],
                            );
                            let prop_span =
                                Span::new(base_offset + pname_start as u32, base_offset + i as u32);
                            let span = Span::new(var_offset, base_offset + i as u32);
                            expr = Expr {
                                kind: ExprKind::PropertyAccess(PropertyAccessExpr {
                                    object: arena.alloc(expr),
                                    property: arena.alloc(Expr {
                                        kind: ExprKind::Identifier(prop_name),
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

                            let idx_offset = base_offset + idx_start as u32;
                            let idx_end = base_offset + (i - 1) as u32;

                            // Parse index: integer or bare string key
                            let index_expr = if let Ok(num) = idx_str.parse::<i64>() {
                                Expr {
                                    kind: ExprKind::Int(num),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            } else if idx_str.starts_with('$') && idx_str.len() > 1 {
                                Expr {
                                    kind: ExprKind::Variable(Cow::Owned(idx_str[1..].to_string())),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            } else {
                                // Bare string key (e.g. $arr[key])
                                Expr {
                                    kind: ExprKind::String(Cow::Borrowed(
                                        &source[base_offset as usize + idx_start
                                            ..base_offset as usize + (i - 1)],
                                    )),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            };

                            let span = Span::new(var_offset, base_offset + i as u32);
                            let _ = bracket_start; // used implicitly
                            expr = Expr {
                                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                    array: arena.alloc(expr),
                                    index: Some(arena.alloc(index_expr)),
                                }),
                                span,
                            };
                        }
                    }

                    parts.push(StringPart::Expr(expr));
                } else {
                    literal.push('$');
                    i += 1;
                }
            }
            b'{' if i + 1 < len && bytes[i + 1] == b'$' => {
                // Complex syntax: {$expr}
                if !literal.is_empty() {
                    parts.push(StringPart::Literal(Cow::Owned(std::mem::take(
                        &mut literal,
                    ))));
                }

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
                }

                // Parse the expression using a sub-parser starting at the absolute offset
                let expr_offset = base_offset + expr_start as u32;
                let end_offset = base_offset + expr_end as u32;
                let expr = parse_complex_interpolation(arena, source, expr_offset, end_offset);
                parts.push(StringPart::Expr(expr));
            }
            _ => {
                literal.push(bytes[i] as char);
                i += 1;
            }
        }
    }

    if !literal.is_empty() {
        parts.push(StringPart::Literal(Cow::Owned(literal)));
    }

    parts
}

/// Parse the inner content of a heredoc body into parts.
/// Unlike `parse_interpolated_parts`, `inner` may be a de-indented copy that is NOT
/// a verbatim subslice of the original source, so complex interpolations are parsed
/// via the old wrapping approach.
pub fn parse_interpolated_parts_heredoc<'arena>(
    arena: &'arena bumpalo::Bump,
    inner: &str,
    base_offset: u32,
) -> ArenaVec<'arena, StringPart<'arena, 'static>> {
    let mut parts: ArenaVec<'arena, StringPart<'arena, 'static>> =
        ArenaVec::with_capacity_in(4, arena);
    let mut literal = String::new();
    let bytes = inner.as_bytes();
    let len = bytes.len();
    let mut i = 0;

    while i < len {
        match bytes[i] {
            b'\\' => {
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
                                if let Ok(val) = u8::from_str_radix(&inner[start..i], 16) {
                                    literal.push(val as char);
                                }
                            } else {
                                literal.push('\\');
                                literal.push('x');
                            }
                        }
                        b'0'..=b'7' => {
                            let start = i + 1;
                            i += 1;
                            while i < len && i - start < 3 && bytes[i] >= b'0' && bytes[i] <= b'7' {
                                i += 1;
                            }
                            if let Ok(val) = u8::from_str_radix(&inner[start..i], 8) {
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
            b'$' => {
                if i + 1 < len && is_var_start(bytes[i + 1]) {
                    if !literal.is_empty() {
                        parts.push(StringPart::Literal(Cow::Owned(std::mem::take(
                            &mut literal,
                        ))));
                    }
                    let var_start = i;
                    i += 1;
                    let name_start = i;
                    while i < len && is_var_char(bytes[i]) {
                        i += 1;
                    }
                    let var_name = Cow::Owned(inner[name_start..i].to_string());
                    let var_offset = base_offset + var_start as u32;

                    let mut expr: Expr<'arena, 'static> = Expr {
                        kind: ExprKind::Variable(var_name),
                        span: Span::new(var_offset, base_offset + i as u32),
                    };

                    if i + 2 < len && bytes[i] == b'-' && bytes[i + 1] == b'>' {
                        let prop_start = i + 2;
                        if prop_start < len && is_var_start(bytes[prop_start]) {
                            i = prop_start;
                            let pname_start = i;
                            while i < len && is_var_char(bytes[i]) {
                                i += 1;
                            }
                            let prop_name = Cow::Owned(inner[pname_start..i].to_string());
                            let prop_span =
                                Span::new(base_offset + pname_start as u32, base_offset + i as u32);
                            let span = Span::new(var_offset, base_offset + i as u32);
                            expr = Expr {
                                kind: ExprKind::PropertyAccess(PropertyAccessExpr {
                                    object: arena.alloc(expr),
                                    property: arena.alloc(Expr {
                                        kind: ExprKind::Identifier(prop_name),
                                        span: prop_span,
                                    }),
                                }),
                                span,
                            };
                        }
                    }

                    if i < len && bytes[i] == b'[' {
                        let bracket_start = i;
                        i += 1;
                        let idx_start = i;
                        while i < len && bytes[i] != b']' {
                            i += 1;
                        }
                        if i < len && bytes[i] == b']' {
                            let idx_str = &inner[idx_start..i];
                            i += 1;
                            let idx_offset = base_offset + idx_start as u32;
                            let idx_end = base_offset + (i - 1) as u32;
                            let index_expr = if let Ok(num) = idx_str.parse::<i64>() {
                                Expr {
                                    kind: ExprKind::Int(num),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            } else if idx_str.starts_with('$') && idx_str.len() > 1 {
                                Expr {
                                    kind: ExprKind::Variable(Cow::Owned(idx_str[1..].to_string())),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            } else {
                                Expr {
                                    kind: ExprKind::String(Cow::Owned(idx_str.to_string())),
                                    span: Span::new(idx_offset, idx_end),
                                }
                            };
                            let span = Span::new(var_offset, base_offset + i as u32);
                            let _ = bracket_start;
                            expr = Expr {
                                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                                    array: arena.alloc(expr),
                                    index: Some(arena.alloc(index_expr)),
                                }),
                                span,
                            };
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
                    parts.push(StringPart::Literal(Cow::Owned(std::mem::take(
                        &mut literal,
                    ))));
                }
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
                let expr_content = &inner[expr_start..i];
                if depth == 0 {
                    i += 1;
                }
                let expr_offset = base_offset + expr_start as u32;
                let expr = parse_complex_interpolation_owned(arena, expr_content, expr_offset);
                parts.push(StringPart::Expr(expr));
            }
            _ => {
                literal.push(bytes[i] as char);
                i += 1;
            }
        }
    }

    if !literal.is_empty() {
        parts.push(StringPart::Literal(Cow::Owned(literal)));
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

/// Parse a complex interpolation expression using a sub-parser that starts directly
/// in the original source at the given offset, avoiding string allocation and span reoffset.
fn parse_complex_interpolation<'arena, 'src>(
    arena: &'arena bumpalo::Bump,
    source: &'src str,
    offset: u32,
    end: u32,
) -> Expr<'arena, 'src> {
    let mut sub = crate::parser::Parser::new_at(arena, source, offset as usize);
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

/// Parse a complex interpolation from a non-verbatim string (e.g. heredoc body that
/// may be de-indented). Uses the old wrapping approach since `content` is not a
/// slice of any single source string.
fn parse_complex_interpolation_owned<'arena>(
    arena: &'arena bumpalo::Bump,
    content: &str,
    offset: u32,
) -> Expr<'arena, 'static> {
    // Wrap in a minimal PHP context for parsing
    let wrapped = format!("<?php {};", content);
    let inner_arena = bumpalo::Bump::new();
    let result = crate::parse(&inner_arena, &wrapped);
    if let Some(stmt) = result.program.stmts.into_iter().next() {
        if let StmtKind::Expression(expr) = stmt.kind {
            // Convert to arena-allocated expr and reoffset spans simultaneously.
            // "<?php " is 6 bytes, so parser_offset=6.
            return to_arena_expr_reoffset(arena, expr, offset, 6);
        }
    }
    // Fallback: return error expression
    Expr {
        kind: ExprKind::Error,
        span: Span::new(offset, offset + content.len() as u32),
    }
}

/// Convert and simultaneously reoffset spans: subtract parser_offset, add target_offset.
fn to_arena_expr_reoffset<'arena>(
    arena: &'arena bumpalo::Bump,
    expr: &Expr<'_, '_>,
    target_offset: u32,
    parser_offset: u32,
) -> Expr<'arena, 'static> {
    macro_rules! rec {
        ($e:expr) => {
            arena.alloc(to_arena_expr_reoffset(
                arena,
                $e,
                target_offset,
                parser_offset,
            ))
        };
    }
    macro_rules! rec_args {
        ($args:expr) => {{
            let mut args = ArenaVec::with_capacity_in($args.len(), arena);
            for arg in $args.iter() {
                args.push(to_arena_arg_reoffset(
                    arena,
                    arg,
                    target_offset,
                    parser_offset,
                ));
            }
            args
        }};
    }
    let kind = match &expr.kind {
        ExprKind::Variable(s) => ExprKind::Variable(Cow::Owned(s.as_ref().to_owned())),
        ExprKind::Identifier(s) => ExprKind::Identifier(Cow::Owned(s.as_ref().to_owned())),
        ExprKind::Int(v) => ExprKind::Int(*v),
        ExprKind::Float(v) => ExprKind::Float(*v),
        ExprKind::String(s) => ExprKind::String(Cow::Owned(s.as_ref().to_owned())),
        ExprKind::Bool(v) => ExprKind::Bool(*v),
        ExprKind::Null => ExprKind::Null,
        ExprKind::Error => ExprKind::Error,
        ExprKind::MagicConst(k) => ExprKind::MagicConst(*k),
        ExprKind::ArrayAccess(aa) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: rec!(aa.array),
            index: aa.index.map(|i| {
                let r: &_ = rec!(i);
                r
            }),
        }),
        ExprKind::PropertyAccess(pa) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: rec!(pa.object),
            property: rec!(pa.property),
        }),
        ExprKind::MethodCall(mc) => ExprKind::MethodCall(MethodCallExpr {
            object: rec!(mc.object),
            method: rec!(mc.method),
            args: rec_args!(mc.args),
        }),
        ExprKind::FunctionCall(fc) => ExprKind::FunctionCall(FunctionCallExpr {
            name: rec!(fc.name),
            args: rec_args!(fc.args),
        }),
        ExprKind::NullsafePropertyAccess(pa) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: rec!(pa.object),
                property: rec!(pa.property),
            })
        }
        ExprKind::NullsafeMethodCall(mc) => ExprKind::NullsafeMethodCall(MethodCallExpr {
            object: rec!(mc.object),
            method: rec!(mc.method),
            args: rec_args!(mc.args),
        }),
        ExprKind::StaticPropertyAccess(sa) => ExprKind::StaticPropertyAccess(StaticAccessExpr {
            class: rec!(sa.class),
            member: Cow::Owned(sa.member.as_ref().to_owned()),
        }),
        ExprKind::StaticMethodCall(smc) => ExprKind::StaticMethodCall(StaticMethodCallExpr {
            class: rec!(smc.class),
            method: Cow::Owned(smc.method.as_ref().to_owned()),
            args: rec_args!(smc.args),
        }),
        ExprKind::ClassConstAccess(ca) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: rec!(ca.class),
            member: Cow::Owned(ca.member.as_ref().to_owned()),
        }),
        ExprKind::Binary(be) => ExprKind::Binary(BinaryExpr {
            left: rec!(be.left),
            op: be.op,
            right: rec!(be.right),
        }),
        ExprKind::Assign(ae) => ExprKind::Assign(AssignExpr {
            target: rec!(ae.target),
            op: ae.op,
            value: rec!(ae.value),
        }),
        ExprKind::Ternary(te) => ExprKind::Ternary(TernaryExpr {
            condition: rec!(te.condition),
            then_expr: te.then_expr.map(|t| {
                let r: &_ = rec!(t);
                r
            }),
            else_expr: rec!(te.else_expr),
        }),
        ExprKind::Parenthesized(inner) => ExprKind::Parenthesized(rec!(inner)),
        ExprKind::VariableVariable(inner) => ExprKind::VariableVariable(rec!(inner)),
        ExprKind::UnaryPrefix(ue) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: ue.op,
            operand: rec!(ue.operand),
        }),
        ExprKind::UnaryPostfix(ue) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            op: ue.op,
            operand: rec!(ue.operand),
        }),
        ExprKind::Cast(kind, e) => ExprKind::Cast(*kind, rec!(e)),
        ExprKind::NullCoalesce(nc) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: rec!(nc.left),
            right: rec!(nc.right),
        }),
        ExprKind::ErrorSuppress(inner) => ExprKind::ErrorSuppress(rec!(inner)),
        ExprKind::Print(inner) => ExprKind::Print(rec!(inner)),
        ExprKind::Clone(inner) => ExprKind::Clone(rec!(inner)),
        ExprKind::Exit(opt) => ExprKind::Exit(opt.map(|e| {
            let r: &_ = rec!(e);
            r
        })),
        ExprKind::ClassConstAccessDynamic { class, member } => ExprKind::ClassConstAccessDynamic {
            class: rec!(class),
            member: rec!(member),
        },
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: rec!(class),
                member: rec!(member),
            }
        }
        // For any other expression kinds (complex ones not commonly in interpolation), convert to error
        _ => ExprKind::Error,
    };
    Expr {
        kind,
        span: compute_reoffset_span(expr.span, target_offset, parser_offset),
    }
}

fn to_arena_arg_reoffset<'arena>(
    arena: &'arena bumpalo::Bump,
    arg: &Arg<'_, '_>,
    target_offset: u32,
    parser_offset: u32,
) -> Arg<'arena, 'static> {
    Arg {
        name: arg.name.as_ref().map(|n| Cow::Owned(n.as_ref().to_owned())),
        value: to_arena_expr_reoffset(arena, &arg.value, target_offset, parser_offset),
        unpack: arg.unpack,
        span: compute_reoffset_span(arg.span, target_offset, parser_offset),
    }
}

fn compute_reoffset_span(span: Span, target_offset: u32, parser_offset: u32) -> Span {
    if target_offset == 0 && parser_offset == 0 {
        return span;
    }
    let relative_start = span.start.saturating_sub(parser_offset);
    let relative_end = span.end.saturating_sub(parser_offset);
    Span::new(target_offset + relative_start, target_offset + relative_end)
}
