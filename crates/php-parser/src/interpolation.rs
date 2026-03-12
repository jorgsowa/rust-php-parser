use std::borrow::Cow;

use php_ast::*;

/// Parse the inner content of a double-quoted or backtick string into parts.
/// `source` is the full original source string.
/// `inner` is the string content without surrounding quotes — must be a verbatim
/// subslice of `source` so that sub-parser offsets are correct absolute positions.
/// `base_offset` is the byte offset of the first character of `inner` in the source.
pub fn parse_interpolated_parts<'src>(
    source: &'src str,
    inner: &'src str,
    base_offset: u32,
) -> Vec<StringPart<'src>> {
    let mut parts = Vec::with_capacity(4);
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
                                    object: Box::new(expr),
                                    property: Box::new(Expr {
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
                                    array: Box::new(expr),
                                    index: Some(Box::new(index_expr)),
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
                let expr = parse_complex_interpolation(source, expr_offset, end_offset);
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
pub fn parse_interpolated_parts_heredoc(inner: &str, base_offset: u32) -> Vec<StringPart<'static>> {
    let mut parts: Vec<StringPart<'static>> = Vec::with_capacity(4);
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

                    let mut expr: Expr<'static> = Expr {
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
                                    object: Box::new(expr),
                                    property: Box::new(Expr {
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
                                    array: Box::new(expr),
                                    index: Some(Box::new(index_expr)),
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
                let expr = parse_complex_interpolation_owned(expr_content, expr_offset);
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
fn parse_complex_interpolation<'src>(source: &'src str, offset: u32, end: u32) -> Expr<'src> {
    let mut sub = crate::parser::Parser::new_at(source, offset as usize);
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
fn parse_complex_interpolation_owned(content: &str, offset: u32) -> Expr<'static> {
    // Wrap in a minimal PHP context for parsing
    let wrapped = format!("<?php {};", content);
    let result = crate::parse(&wrapped);
    if let Some(stmt) = result.program.stmts.first() {
        if let StmtKind::Expression(expr) = stmt.kind.clone() {
            // Convert to static (owned) expr then reoffset
            let static_expr = to_static_expr(expr);
            return reoffset_expr(static_expr, offset, 6); // "<?php " is 6 bytes
        }
    }
    // Fallback: return error expression
    Expr {
        kind: ExprKind::Error,
        span: Span::new(offset, offset + content.len() as u32),
    }
}

/// Convert an Expr with any lifetime to Expr<'static> by making all string data owned.
fn to_static_expr(expr: Expr<'_>) -> Expr<'static> {
    let kind = match expr.kind {
        ExprKind::Variable(s) => ExprKind::Variable(Cow::Owned(s.into_owned())),
        ExprKind::Identifier(s) => ExprKind::Identifier(Cow::Owned(s.into_owned())),
        ExprKind::Int(v) => ExprKind::Int(v),
        ExprKind::Float(v) => ExprKind::Float(v),
        ExprKind::String(s) => ExprKind::String(Cow::Owned(s.into_owned())),
        ExprKind::Bool(v) => ExprKind::Bool(v),
        ExprKind::Null => ExprKind::Null,
        ExprKind::Error => ExprKind::Error,
        ExprKind::MagicConst(k) => ExprKind::MagicConst(k),
        ExprKind::ArrayAccess(aa) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: Box::new(to_static_expr(*aa.array)),
            index: aa.index.map(|i| Box::new(to_static_expr(*i))),
        }),
        ExprKind::PropertyAccess(pa) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: Box::new(to_static_expr(*pa.object)),
            property: Box::new(to_static_expr(*pa.property)),
        }),
        ExprKind::MethodCall(mc) => ExprKind::MethodCall(MethodCallExpr {
            object: Box::new(to_static_expr(*mc.object)),
            method: Box::new(to_static_expr(*mc.method)),
            args: mc.args.into_iter().map(to_static_arg).collect(),
        }),
        ExprKind::FunctionCall(fc) => ExprKind::FunctionCall(FunctionCallExpr {
            name: Box::new(to_static_expr(*fc.name)),
            args: fc.args.into_iter().map(to_static_arg).collect(),
        }),
        ExprKind::NullsafePropertyAccess(pa) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: Box::new(to_static_expr(*pa.object)),
                property: Box::new(to_static_expr(*pa.property)),
            })
        }
        ExprKind::NullsafeMethodCall(mc) => ExprKind::NullsafeMethodCall(MethodCallExpr {
            object: Box::new(to_static_expr(*mc.object)),
            method: Box::new(to_static_expr(*mc.method)),
            args: mc.args.into_iter().map(to_static_arg).collect(),
        }),
        ExprKind::StaticPropertyAccess(sa) => ExprKind::StaticPropertyAccess(StaticAccessExpr {
            class: Box::new(to_static_expr(*sa.class)),
            member: Cow::Owned(sa.member.into_owned()),
        }),
        ExprKind::StaticMethodCall(smc) => ExprKind::StaticMethodCall(StaticMethodCallExpr {
            class: Box::new(to_static_expr(*smc.class)),
            method: Cow::Owned(smc.method.into_owned()),
            args: smc.args.into_iter().map(to_static_arg).collect(),
        }),
        ExprKind::ClassConstAccess(ca) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: Box::new(to_static_expr(*ca.class)),
            member: Cow::Owned(ca.member.into_owned()),
        }),
        ExprKind::Binary(be) => ExprKind::Binary(BinaryExpr {
            left: Box::new(to_static_expr(*be.left)),
            op: be.op,
            right: Box::new(to_static_expr(*be.right)),
        }),
        ExprKind::Assign(ae) => ExprKind::Assign(AssignExpr {
            target: Box::new(to_static_expr(*ae.target)),
            op: ae.op,
            value: Box::new(to_static_expr(*ae.value)),
        }),
        ExprKind::Ternary(te) => ExprKind::Ternary(TernaryExpr {
            condition: Box::new(to_static_expr(*te.condition)),
            then_expr: te.then_expr.map(|t| Box::new(to_static_expr(*t))),
            else_expr: Box::new(to_static_expr(*te.else_expr)),
        }),
        ExprKind::Parenthesized(inner) => ExprKind::Parenthesized(Box::new(to_static_expr(*inner))),
        ExprKind::VariableVariable(inner) => {
            ExprKind::VariableVariable(Box::new(to_static_expr(*inner)))
        }
        ExprKind::UnaryPrefix(ue) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: ue.op,
            operand: Box::new(to_static_expr(*ue.operand)),
        }),
        ExprKind::UnaryPostfix(ue) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            op: ue.op,
            operand: Box::new(to_static_expr(*ue.operand)),
        }),
        ExprKind::Cast(kind, expr) => ExprKind::Cast(kind, Box::new(to_static_expr(*expr))),
        ExprKind::NullCoalesce(nc) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: Box::new(to_static_expr(*nc.left)),
            right: Box::new(to_static_expr(*nc.right)),
        }),
        ExprKind::ErrorSuppress(inner) => ExprKind::ErrorSuppress(Box::new(to_static_expr(*inner))),
        ExprKind::Print(inner) => ExprKind::Print(Box::new(to_static_expr(*inner))),
        ExprKind::Clone(inner) => ExprKind::Clone(Box::new(to_static_expr(*inner))),
        ExprKind::Exit(opt) => ExprKind::Exit(opt.map(|e| Box::new(to_static_expr(*e)))),
        ExprKind::ClassConstAccessDynamic { class, member } => ExprKind::ClassConstAccessDynamic {
            class: Box::new(to_static_expr(*class)),
            member: Box::new(to_static_expr(*member)),
        },
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: Box::new(to_static_expr(*class)),
                member: Box::new(to_static_expr(*member)),
            }
        }
        // For any other expression kinds (complex ones not commonly in interpolation), convert to error
        _ => ExprKind::Error,
    };
    Expr {
        kind,
        span: expr.span,
    }
}

fn to_static_arg(arg: Arg<'_>) -> Arg<'static> {
    Arg {
        // Named args in interpolated expressions are rare; leak if necessary
        name: arg.name.map(|n| -> &'static str {
            let owned: Box<str> = n.into();
            Box::leak(owned)
        }),
        value: to_static_expr(arg.value),
        unpack: arg.unpack,
        span: arg.span,
    }
}

/// Adjust spans in an expression: subtract `parser_offset` and add `target_offset`
fn reoffset_expr(mut expr: Expr<'static>, target_offset: u32, parser_offset: u32) -> Expr<'static> {
    reoffset_span(&mut expr.span, target_offset, parser_offset);
    match &mut expr.kind {
        ExprKind::Variable(_)
        | ExprKind::Int(_)
        | ExprKind::Float(_)
        | ExprKind::String(_)
        | ExprKind::Bool(_)
        | ExprKind::Null
        | ExprKind::Identifier(_)
        | ExprKind::Error
        | ExprKind::MagicConst(_) => {}
        ExprKind::ArrayAccess(ref mut aa) => {
            *aa.array = reoffset_expr(*aa.array.clone(), target_offset, parser_offset);
            if let Some(ref mut idx) = aa.index {
                **idx = reoffset_expr(*idx.clone(), target_offset, parser_offset);
            }
        }
        ExprKind::PropertyAccess(ref mut pa) => {
            *pa.object = reoffset_expr(*pa.object.clone(), target_offset, parser_offset);
            *pa.property = reoffset_expr(*pa.property.clone(), target_offset, parser_offset);
        }
        ExprKind::MethodCall(ref mut mc) => {
            *mc.object = reoffset_expr(*mc.object.clone(), target_offset, parser_offset);
            *mc.method = reoffset_expr(*mc.method.clone(), target_offset, parser_offset);
            for arg in &mut mc.args {
                reoffset_span(&mut arg.span, target_offset, parser_offset);
                arg.value = reoffset_expr(arg.value.clone(), target_offset, parser_offset);
            }
        }
        ExprKind::FunctionCall(ref mut fc) => {
            *fc.name = reoffset_expr(*fc.name.clone(), target_offset, parser_offset);
            for arg in &mut fc.args {
                reoffset_span(&mut arg.span, target_offset, parser_offset);
                arg.value = reoffset_expr(arg.value.clone(), target_offset, parser_offset);
            }
        }
        ExprKind::NullsafePropertyAccess(ref mut pa) => {
            *pa.object = reoffset_expr(*pa.object.clone(), target_offset, parser_offset);
            *pa.property = reoffset_expr(*pa.property.clone(), target_offset, parser_offset);
        }
        ExprKind::NullsafeMethodCall(ref mut mc) => {
            *mc.object = reoffset_expr(*mc.object.clone(), target_offset, parser_offset);
            *mc.method = reoffset_expr(*mc.method.clone(), target_offset, parser_offset);
            for arg in &mut mc.args {
                reoffset_span(&mut arg.span, target_offset, parser_offset);
                arg.value = reoffset_expr(arg.value.clone(), target_offset, parser_offset);
            }
        }
        ExprKind::StaticPropertyAccess(ref mut sa) => {
            *sa.class = reoffset_expr(*sa.class.clone(), target_offset, parser_offset);
        }
        ExprKind::StaticMethodCall(ref mut smc) => {
            *smc.class = reoffset_expr(*smc.class.clone(), target_offset, parser_offset);
            for arg in &mut smc.args {
                reoffset_span(&mut arg.span, target_offset, parser_offset);
                arg.value = reoffset_expr(arg.value.clone(), target_offset, parser_offset);
            }
        }
        ExprKind::ClassConstAccess(ref mut ca) => {
            *ca.class = reoffset_expr(*ca.class.clone(), target_offset, parser_offset);
        }
        ExprKind::Binary(ref mut be) => {
            *be.left = reoffset_expr(*be.left.clone(), target_offset, parser_offset);
            *be.right = reoffset_expr(*be.right.clone(), target_offset, parser_offset);
        }
        ExprKind::Assign(ref mut ae) => {
            *ae.target = reoffset_expr(*ae.target.clone(), target_offset, parser_offset);
            *ae.value = reoffset_expr(*ae.value.clone(), target_offset, parser_offset);
        }
        ExprKind::Ternary(ref mut te) => {
            *te.condition = reoffset_expr(*te.condition.clone(), target_offset, parser_offset);
            if let Some(ref mut t) = te.then_expr {
                **t = reoffset_expr(*t.clone(), target_offset, parser_offset);
            }
            *te.else_expr = reoffset_expr(*te.else_expr.clone(), target_offset, parser_offset);
        }
        ExprKind::Parenthesized(ref mut inner) => {
            **inner = reoffset_expr(*inner.clone(), target_offset, parser_offset);
        }
        // For other expression kinds, just adjust the top-level span (already done above)
        _ => {}
    }
    expr
}

fn reoffset_span(span: &mut Span, target_offset: u32, parser_offset: u32) {
    let relative_start = span.start.saturating_sub(parser_offset);
    let relative_end = span.end.saturating_sub(parser_offset);
    span.start = target_offset + relative_start;
    span.end = target_offset + relative_end;
}
