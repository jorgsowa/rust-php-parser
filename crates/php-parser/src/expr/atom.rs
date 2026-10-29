use php_ast::*;
use php_lexer::lexer::interpolation_end;
use php_lexer::TokenKind;

use crate::attributes::{AttrSite, AttrTarget, ClassKind};
use crate::diagnostics::{ForbiddenRule, ParseError};
use crate::instrument;
use crate::parser::Parser;
use crate::precedence::{self, ASSIGNMENT_BP};
use crate::stmt;
use crate::version::PhpVersion;

use super::{
    interpolation::heredoc_indent_len, parse_assign_continuation, parse_expr, parse_expr_bp,
    parse_expr_continue, parse_member_name,
};

/// Cast keyword strings and their CastKind values
pub(crate) const CAST_KEYWORDS: &[(&str, CastKind)] = &[
    ("int", CastKind::Int),
    ("integer", CastKind::Int),
    ("float", CastKind::Float),
    ("double", CastKind::Float),
    ("real", CastKind::Float),
    ("string", CastKind::String),
    ("binary", CastKind::String),
    ("bool", CastKind::Bool),
    ("boolean", CastKind::Bool),
    ("array", CastKind::Array),
    ("object", CastKind::Object),
    ("unset", CastKind::Unset),
    ("void", CastKind::Void),
];

/// Result of parsing an argument list — either regular args or a `(...)` callable marker.
pub(crate) enum ArgListResult<'arena, 'src> {
    Args(ArenaVec<'arena, Arg<'arena, 'src>>),
    /// The span of the `...`.
    CallableMarker(Span),
}

/// [`parse_atom`] for the operand of a variable-variable `$`, which recurses
/// without passing through `parse_expr_bp` and so takes its own nesting unit.
pub(super) fn parse_atom_nested<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Expr<'arena, 'src> {
    if !parser.enter_nesting() {
        return Expr {
            kind: ExprKind::Error,
            span: parser.missing_span(),
        };
    }
    let expr = parse_atom(parser);
    parser.leave_nesting();
    expr
}

/// Parse what follows the `$` of `$$a`, which PHP requires to be a variable.
pub(super) fn parse_variable_variable_name<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Expr<'arena, 'src> {
    if !matches!(
        parser.current_kind(),
        TokenKind::Variable | TokenKind::Dollar
    ) {
        parser.error(ParseError::Expected {
            expected: "variable".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
    }
    parse_atom_nested(parser)
}

/// Parse an atomic expression (prefix unaries, literals, variables, etc.)
pub(super) fn parse_atom<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    instrument::record_parse_atom();
    let kind = parser.current_kind();

    // Attributed closure/arrow function: #[Attr] function(...) { } or #[Attr] fn(...) => ...
    if kind == TokenKind::HashBracket {
        let start = parser.start_span();
        let attributes = parser.parse_attributes();
        // After attributes, expect static/function/fn
        if parser.check(TokenKind::Static) {
            parser.advance();
            if parser.check(TokenKind::Function) {
                return parse_closure(parser, true, start, attributes);
            }
            if parser.check(TokenKind::Fn_) {
                return parse_arrow_function(parser, true, start, attributes);
            }
            // Error: attributes followed by static without function/fn
            parser.error(ParseError::Expected {
                expected: "'function' or 'fn'".into(),
                found: parser.current_kind().description().into(),
                span: parser.current_span(),
            });
            return Expr {
                kind: ExprKind::Error,
                span: parser.span_from(start),
            };
        }
        if parser.check(TokenKind::Function) {
            return parse_closure(parser, false, start, attributes);
        }
        if parser.check(TokenKind::Fn_) {
            return parse_arrow_function(parser, false, start, attributes);
        }
        // Error: attributes in expression context without closure/arrow function
        parser.error(ParseError::Expected {
            expected: "'function', 'fn', or 'static'".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        return Expr {
            kind: ExprKind::Error,
            span: parser.span_from(start),
        };
    }

    // @ error suppression (prefix, high precedence)
    if kind == TokenKind::At {
        let token = parser.advance();
        let mut operand = parse_expr_bp(parser, precedence::HIGH_PREFIX_BP);
        // PHP grammar quirk: assignment binds tighter than @
        if parser.current_kind().is_assignment_op() {
            operand = parse_assign_continuation(parser, operand);
        }
        let span = token.span.merge(operand.span);
        return Expr {
            kind: ExprKind::ErrorSuppress(parser.alloc(operand)),
            span,
        };
    }

    // Prefix unary operators
    // A run of prefix operators is collected in a loop rather than by recursion,
    // so chains like `~~~~…$x` do not consume the nesting budget.
    if let Some(right_bp) = precedence::prefix_binding_power(kind) {
        let mut ops = vec![(parser.advance(), right_bp)];
        while let Some(right_bp) = precedence::prefix_binding_power(parser.current_kind()) {
            ops.push((parser.advance(), right_bp));
        }
        let mut operand = parse_expr_bp(parser, ops.last().unwrap().1);
        loop {
            let (op_token, _) = ops.pop().expect("prefix operator stack is non-empty");
            // PHP grammar quirk: assignment operators bind tighter than prefix unary.
            // e.g., -$x += 1  parses as  -(($x += 1)),  not  (-$x) += 1
            //
            // Exception: `++` and `--` require a variable (l-value) as operand — PHP enforces
            // this at parse time (`++$x += 1` is a syntax error in PHP). Skip the assignment
            // continuation for those two operators.
            if parser.current_kind().is_assignment_op()
                && !matches!(op_token.kind, TokenKind::PlusPlus | TokenKind::MinusMinus)
            {
                operand = parse_assign_continuation(parser, operand);
            }
            let op = match op_token.kind {
                TokenKind::Minus => UnaryPrefixOp::Negate,
                TokenKind::Plus => UnaryPrefixOp::Plus,
                TokenKind::Bang => UnaryPrefixOp::BooleanNot,
                TokenKind::Tilde => UnaryPrefixOp::BitwiseNot,
                TokenKind::PlusPlus => UnaryPrefixOp::PreIncrement,
                TokenKind::MinusMinus => UnaryPrefixOp::PreDecrement,
                _ => unreachable!(
                    "prefix_binding_power only returns Some for -, +, !, ~, ++, --, got {:?}",
                    op_token.kind
                ),
            };
            if matches!(
                op,
                UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
            ) {
                super::check_increment_operand(parser, &operand);
            }
            let span = op_token.span.merge(operand.span);
            let expr = Expr {
                kind: ExprKind::UnaryPrefix(UnaryPrefixExpr {
                    op,
                    operand: parser.alloc(operand),
                }),
                span,
            };
            super::check_unsupported_operands(parser, &expr);
            operand = match ops.last() {
                Some(&(_, outer_bp)) => parse_expr_continue(parser, expr, outer_bp),
                None => return expr,
            };
        }
    }

    match kind {
        // Integer literals
        TokenKind::IntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            match parse_int_no_alloc(text.as_bytes(), 10) {
                Some(value) => Expr {
                    kind: ExprKind::Int(value),
                    span: token.span,
                },
                None => Expr {
                    kind: ExprKind::Float(parse_float_no_alloc(text)),
                    span: token.span,
                },
            }
        }
        TokenKind::HexIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            match parse_int_no_alloc(&text.as_bytes()[2..], 16) {
                Some(value) => Expr {
                    kind: ExprKind::Int(value),
                    span: token.span,
                },
                None => Expr {
                    kind: ExprKind::Float(parse_int_as_float(&text.as_bytes()[2..], 16.0)),
                    span: token.span,
                },
            }
        }
        TokenKind::BinIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            match parse_int_no_alloc(&text.as_bytes()[2..], 2) {
                Some(value) => Expr {
                    kind: ExprKind::Int(value),
                    span: token.span,
                },
                None => Expr {
                    kind: ExprKind::Float(parse_int_as_float(&text.as_bytes()[2..], 2.0)),
                    span: token.span,
                },
            }
        }
        TokenKind::OctIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            if text.as_bytes()[1..].iter().any(|&b| b == b'8' || b == b'9') {
                parser.forbid(
                    ForbiddenRule::InvalidNumericLiteral,
                    "Invalid numeric literal",
                    token.span,
                );
            }
            match parse_int_no_alloc(&text.as_bytes()[1..], 8) {
                Some(value) => Expr {
                    kind: ExprKind::Int(value),
                    span: token.span,
                },
                None => Expr {
                    kind: ExprKind::Float(parse_int_as_float(&text.as_bytes()[1..], 8.0)),
                    span: token.span,
                },
            }
        }
        TokenKind::OctIntLiteralNew => {
            let token = parser.advance();
            // The explicit `0o` octal prefix was introduced in PHP 8.1.
            parser.require_version(
                crate::version::PhpVersion::Php81,
                "explicit octal literals (0o)",
                token.span,
            );
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            match parse_int_no_alloc(&text.as_bytes()[2..], 8) {
                Some(value) => Expr {
                    kind: ExprKind::Int(value),
                    span: token.span,
                },
                None => Expr {
                    kind: ExprKind::Float(parse_int_as_float(&text.as_bytes()[2..], 8.0)),
                    span: token.span,
                },
            }
        }

        // Invalid numeric literal (recovery: treat as int 0)
        TokenKind::InvalidNumericLiteral => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Int(0),
                span: token.span,
            }
        }

        // Float literals
        TokenKind::FloatLiteral
        | TokenKind::FloatLiteralSimple
        | TokenKind::FloatLiteralLeadingDot => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_float_no_alloc(text);
            Expr {
                kind: ExprKind::Float(value),
                span: token.span,
            }
        }

        // String literals
        TokenKind::SingleQuotedString => {
            let token = parser.advance();
            let src = parser.source();
            let text = &src[token.span.start as usize..token.span.end as usize];
            let text = text
                .strip_prefix('b')
                .or_else(|| text.strip_prefix('B'))
                .unwrap_or(text);
            // Use strip_prefix/strip_suffix to respect UTF-8 char boundaries.
            // An unterminated string may end with a multi-byte character whose last
            // byte coincidentally matches the closing delimiter byte; byte indexing
            // would panic in that case.
            let without_open = text.strip_prefix('\'').unwrap_or(text);
            let inner = without_open.strip_suffix('\'').unwrap_or(without_open);
            // Fast path: the lexer saw no backslash, so inner is a verbatim source slice
            let value = if parser.is_verbatim_string(token.span.start) {
                ByteStr::from_source(inner)
            } else {
                // Decode single-quote escape sequences: \' → ' and \\ → \
                let mut decoded = String::with_capacity(inner.len());
                let bytes = inner.as_bytes();
                let mut i = 0;
                while i < bytes.len() {
                    if bytes[i] == b'\\' && i + 1 < bytes.len() {
                        match bytes[i + 1] {
                            b'\'' => {
                                decoded.push('\'');
                                i += 2;
                            }
                            b'\\' => {
                                decoded.push('\\');
                                i += 2;
                            }
                            _ => {
                                decoded.push('\\');
                                i += 1;
                            }
                        }
                    } else {
                        // Decode the next UTF-8 character from the remaining slice
                        // Loop invariant: i < bytes.len(), so rest is non-empty
                        let rest = &inner[i..];
                        let ch = rest
                            .chars()
                            .next()
                            .expect("loop condition i < bytes.len() guarantees non-empty slice");
                        decoded.push(ch);
                        i += ch.len_utf8();
                    }
                }
                ByteStr::from_arena_str(parser.arena.alloc_str(&decoded))
            };
            Expr {
                kind: ExprKind::String(value),
                span: token.span,
            }
        }
        TokenKind::DoubleQuotedString => {
            let token = parser.advance();
            let src = parser.source();
            let text = &src[token.span.start as usize..token.span.end as usize];
            let stripped = text
                .strip_prefix('b')
                .or_else(|| text.strip_prefix('B'))
                .unwrap_or(text);
            // Use strip_prefix/strip_suffix to respect UTF-8 char boundaries.
            // An unterminated string may end with a multi-byte character; byte indexing
            // would panic in that case. The lexer already emitted an error for unterminated
            // strings, so it is safe to treat the missing closing quote as absent here.
            let Some(without_open) = stripped.strip_prefix('"') else {
                return Expr {
                    kind: ExprKind::String(ByteStr::from_source("")),
                    span: token.span,
                };
            };
            let inner = without_open.strip_suffix('"').unwrap_or(without_open);

            if parser.is_verbatim_string(token.span.start) {
                // The lexer saw no backslash and no `$`: a verbatim source slice.
                Expr {
                    kind: ExprKind::String(ByteStr::from_source(inner)),
                    span: token.span,
                }
            } else if super::interpolation::has_interpolation(inner) {
                note_interpolated_class_refs(parser, inner);
                // Compute the byte offset of inner within src via pointer arithmetic so
                // the result is correct regardless of the b/B prefix or termination.
                let inner_offset = (inner.as_ptr() as usize - src.as_ptr() as usize) as u32;
                let parts = super::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                    parser.version,
                    parser.nesting_depth,
                    parser.errors_mut(),
                );
                Expr {
                    kind: ExprKind::InterpolatedString(parts),
                    span: token.span,
                }
            } else if memchr::memchr(b'\\', inner.as_bytes()).is_none() {
                // No interpolation and no escapes — verbatim source slice
                Expr {
                    kind: ExprKind::String(ByteStr::from_source(inner)),
                    span: token.span,
                }
            } else {
                // Has escape sequences but no interpolation — decode via interpolated parts
                let inner_offset = token.span.end - 1 - inner.len() as u32;
                let parts = super::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                    parser.version,
                    parser.nesting_depth,
                    parser.errors_mut(),
                );
                // Collapse single literal part into String, or use InterpolatedString
                if parts.len() == 1 {
                    match parts
                        .into_iter()
                        .next()
                        .expect("parts.len() == 1 checked above")
                    {
                        StringPart::Literal(s) => Expr {
                            kind: ExprKind::String(s),
                            span: token.span,
                        },
                        part => {
                            let mut v = parser.alloc_vec_with_capacity(1);
                            v.push(part);
                            Expr {
                                kind: ExprKind::InterpolatedString(v),
                                span: token.span,
                            }
                        }
                    }
                } else {
                    Expr {
                        kind: ExprKind::InterpolatedString(parts),
                        span: token.span,
                    }
                }
            }
        }

        // Backtick string (shell execution)
        TokenKind::BacktickString => {
            let token = parser.advance();
            let src = parser.source();
            let text = &src[token.span.start as usize..token.span.end as usize];
            // Use strip_prefix/strip_suffix to respect UTF-8 char boundaries.
            let Some(without_open) = text.strip_prefix('`') else {
                return Expr {
                    kind: ExprKind::ShellExec(parser.alloc_vec_with_capacity(0)),
                    span: token.span,
                };
            };
            let inner = without_open.strip_suffix('`').unwrap_or(without_open);

            if super::interpolation::has_interpolation(inner) {
                note_interpolated_class_refs(parser, inner);
                let inner_offset = token.span.start + 1;
                let parts = super::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                    parser.version,
                    parser.nesting_depth,
                    parser.errors_mut(),
                );
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            } else if memchr::memchr(b'\\', inner.as_bytes()).is_none() {
                // No escapes — verbatim source slice
                let offset = inner.as_ptr() as usize - src.as_ptr() as usize;
                let mut parts = parser.alloc_vec_with_capacity(1);
                parts.push(StringPart::Literal(ByteStr::from_source(
                    &src[offset..offset + inner.len()],
                )));
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            } else {
                // Has escape sequences — decode via interpolated parts
                let inner_offset = token.span.start + 1;
                let parts = super::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                    parser.version,
                    parser.nesting_depth,
                    parser.errors_mut(),
                );
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            }
        }

        // Heredoc
        TokenKind::Heredoc => {
            let token = parser.advance();
            let src = parser.source();
            let text = &src[token.span.start as usize..token.span.end as usize];
            let (label, body_start_in_text, body_end_in_text, indent) = parse_heredoc_content(text);
            let body_offset = token.span.start + body_start_in_text as u32;
            let raw_body = &src[body_offset as usize..token.span.start as usize + body_end_in_text];
            let indent_end = token.span.end - label.len() as u32;
            let indent_span = Span::new(indent_end - indent.len() as u32, indent_end);
            validate_heredoc_indentation(
                raw_body,
                true,
                parser.version >= PhpVersion::Php80,
                &indent,
                indent_span,
                body_offset,
                parser.errors_mut(),
            );
            if super::interpolation::has_interpolation(raw_body) {
                note_interpolated_class_refs(parser, raw_body);
                if !indent.is_empty() {
                    // Indented heredoc — raw_body is a verbatim source slice but each line
                    // is prefixed with `indent`. The indented sub-parser works directly on
                    // the source, skipping the indent at each line start, so we can use
                    // parse_complex_interpolation without wrapping.
                    let parts = super::interpolation::parse_interpolated_parts_indented(
                        parser.arena,
                        src,
                        raw_body,
                        body_offset,
                        &indent,
                        parser.version,
                        parser.nesting_depth,
                        parser.errors_mut(),
                    );
                    Expr {
                        kind: ExprKind::Heredoc { label, parts },
                        span: token.span,
                    }
                } else {
                    // Non-indented — body is verbatim source, use the fast sub-parser path
                    let parts = super::interpolation::parse_interpolated_parts(
                        parser.arena,
                        src,
                        raw_body,
                        body_offset,
                        parser.version,
                        parser.nesting_depth,
                        parser.errors_mut(),
                    );
                    Expr {
                        kind: ExprKind::Heredoc { label, parts },
                        span: token.span,
                    }
                }
            } else {
                // No interpolation — build the (possibly de-indented) body string,
                // then process escape sequences
                let de_indented = if !indent.is_empty() {
                    strip_heredoc_indent(raw_body, indent.len())
                } else {
                    raw_body.to_string()
                };
                // Escapes never span lines, so the raw source gives exact error spans.
                super::interpolation::check_heredoc_escapes(
                    raw_body,
                    body_offset,
                    parser.errors_mut(),
                );
                let body_str = super::interpolation::process_heredoc_escapes(&de_indented);
                let mut parts = parser.alloc_vec_with_capacity(1);
                parts.push(StringPart::Literal(ByteStr::new_in(
                    parser.arena,
                    &body_str,
                )));
                Expr {
                    kind: ExprKind::Heredoc { label, parts },
                    span: token.span,
                }
            }
        }

        // Nowdoc
        TokenKind::Nowdoc => {
            let token = parser.advance();
            let src = parser.source();
            let text = &src[token.span.start as usize..token.span.end as usize];
            let (label, body_start_in_text, body_end_in_text, indent) = parse_heredoc_content(text);
            let body_offset = token.span.start + body_start_in_text as u32;
            let raw_body = &text[body_start_in_text..body_end_in_text];
            let indent_end = token.span.end - label.len() as u32;
            let indent_span = Span::new(indent_end - indent.len() as u32, indent_end);
            validate_heredoc_indentation(
                raw_body,
                false,
                parser.version >= PhpVersion::Php80,
                &indent,
                indent_span,
                body_offset,
                parser.errors_mut(),
            );
            let value: &'arena str = if !indent.is_empty() {
                parser
                    .arena
                    .alloc_str(&strip_heredoc_indent(raw_body, indent.len()))
            } else {
                parser.arena.alloc_str(raw_body)
            };
            Expr {
                kind: ExprKind::Nowdoc { label, value },
                span: token.span,
            }
        }

        // Boolean and null literals
        TokenKind::True => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Bool(true),
                span: token.span,
            }
        }
        TokenKind::False => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Bool(false),
                span: token.span,
            }
        }
        TokenKind::Null => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Null,
                span: token.span,
            }
        }

        // Variables
        TokenKind::Variable => {
            let token = parser.advance();
            let name = parser.variable_name(token);
            Expr {
                kind: ExprKind::Variable(NameStr::from_source(name)),
                span: token.span,
            }
        }

        // Variable variables: $$var, $$$var, ${expr}
        TokenKind::Dollar => {
            let token = parser.advance(); // consume $
            let inner = if parser.check(TokenKind::LeftBrace) {
                // ${expr}
                parser.advance(); // consume {
                let expr = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                expr
            } else {
                // $$var or $$$var — parse_atom handles recursion
                parse_variable_variable_name(parser)
            };
            let span = parser.span_from(token.span.start);
            Expr {
                kind: ExprKind::VariableVariable(parser.alloc(inner)),
                span,
            }
        }

        // Identifiers (function names, class names, etc.)
        // Also handles qualified names: App\Models\User
        // Fully qualified (\Foo\Bar) and relative (namespace\Foo) names are handled below.
        TokenKind::Identifier | TokenKind::Backslash => name_expr(parser.parse_name()),
        TokenKind::HaltCompiler if parser.peek_kind() == Some(TokenKind::Backslash) => {
            name_expr(parser.parse_name())
        }

        // `enum` as an identifier — valid in any expression position where a name is
        // expected (e.g. `Enum::class`, `Enum::someMethod()`, `new Enum`, `Enum()`).
        // The statement-level enum declaration is handled earlier in stmt.rs; by the
        // time we reach a primary expression, `enum` refers to a user-named symbol.
        TokenKind::Enum_ => {
            // From 8.1 PHP lexes `enum and 1` as the keyword, which no expression takes.
            if parser.enum_is_keyword() {
                parser.error_expected("expression");
            }
            let token = parser.advance();
            let src = parser.source;
            simple_name_expr(
                &src[token.span.start as usize..token.span.end as usize],
                token.span,
            )
        }

        // self, parent, static — used as class names (e.g. self::method())
        TokenKind::Self_ => {
            let token = parser.advance();
            parser.note_class_keyword(TokenKind::Self_);
            simple_name_expr("self", token.span)
        }
        TokenKind::Parent_ => {
            let token = parser.advance();
            parser.note_class_keyword(TokenKind::Parent_);
            simple_name_expr("parent", token.span)
        }
        TokenKind::Static => {
            let token = parser.advance();
            // Check if this is `static function` (static closure)
            if parser.check(TokenKind::Function) {
                return parse_closure(parser, true, token.span.start, parser.alloc_vec());
            }
            // Check if `static fn` (static arrow function)
            if parser.check(TokenKind::Fn_) {
                return parse_arrow_function(parser, true, token.span.start, parser.alloc_vec());
            }
            if !parser.check(TokenKind::DoubleColon) {
                parser.forbid(
                    ForbiddenRule::StaticStandaloneExpression,
                    "Cannot use 'static' as a standalone expression",
                    token.span,
                );
            }
            parser.note_class_keyword(TokenKind::Static);
            simple_name_expr("static", token.span)
        }

        // Print expression
        TokenKind::Print => {
            let token = parser.advance();
            let expr = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(expr.span);
            Expr {
                kind: ExprKind::Print(parser.alloc(expr)),
                span,
            }
        }

        // New expression: new ClassName(args)
        TokenKind::New => parse_new_expr(parser),

        // Function keyword — closure expression (when used as expression)
        TokenKind::Function => {
            let start = parser.start_span();
            parse_closure(parser, false, start, parser.alloc_vec())
        }

        // Fn keyword — arrow function: fn($x) => expr
        TokenKind::Fn_ => {
            let start = parser.start_span();
            parse_arrow_function(parser, false, start, parser.alloc_vec())
        }

        TokenKind::Match_ if parser.version < PhpVersion::Php80 => parse_match_before_80(parser),

        // Match expression — PHP 8.0+
        TokenKind::Match_ => {
            let span = parser.current_span();
            parser.require_version(PhpVersion::Php80, "match expressions", span);
            parse_match_expr(parser)
        }

        // Throw as expression — PHP 8.0+
        TokenKind::Throw => {
            let token = parser.advance();
            let span = token.span;
            parser.require_version(PhpVersion::Php80, "throw expressions", span);
            let expr = parse_expr(parser);
            let merged = span.merge(expr.span);
            Expr {
                kind: ExprKind::Throw(parser.alloc(expr)),
                span: merged,
            }
        }

        // Yield expression
        TokenKind::Yield_ => parse_yield_expr(parser),

        // Parenthesized expression or cast
        TokenKind::LeftParen => {
            // Check if this is a cast: (int), (string), etc.
            if let Some(cast_kind) = try_parse_cast(parser) {
                return cast_kind;
            }
            let start = parser.start_span();
            let open = parser.advance(); // consume (
            let inner = parse_expr(parser);
            parser.expect_closing(TokenKind::RightParen, open.span);
            let span = parser.span_from(start);
            Expr {
                kind: ExprKind::Parenthesized(parser.alloc(inner)),
                span,
            }
        }

        // Array literal: [elements]
        TokenKind::LeftBracket => parse_array_literal(parser),

        // array() syntax
        TokenKind::Array => parse_array_call(parser),

        // list() syntax (for destructuring)
        TokenKind::List => parse_list_expr(parser),

        // isset(expr, expr, ...)
        TokenKind::Isset => {
            let start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let mut exprs = parser.alloc_vec();
            exprs.push(parse_expr(parser));
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::RightParen) {
                    break;
                }
                exprs.push(parse_expr(parser));
            }
            parser.expect(TokenKind::RightParen);
            let end = parser.previous_end();
            for e in exprs.iter() {
                allow_curly_offsets(parser, e);
            }
            // PHP rejects non-lvalue arguments to isset with
            // "Cannot use isset() on the result of an expression
            //  (you can use \"null !== expression\" instead)".
            // Parenthesised variables are allowed (e.g. isset(($a))).
            for e in exprs.iter() {
                if !isset_target_valid(&e.kind) {
                    parser.forbid(
                        ForbiddenRule::IssetOnExpression,
                        "Cannot use isset() on the result of an expression \
                                  (you can use \"null !== expression\" instead)",
                        e.span,
                    );
                }
            }
            Expr {
                kind: ExprKind::Isset(exprs),
                span: Span::new(start, end),
            }
        }

        // empty(expr)
        TokenKind::Empty => {
            let start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let inner = parse_expr(parser);
            parser.expect(TokenKind::RightParen);
            let end = parser.previous_end();
            allow_curly_offsets(parser, &inner);
            Expr {
                kind: ExprKind::Empty(parser.alloc(inner)),
                span: Span::new(start, end),
            }
        }

        // eval('code')
        TokenKind::Eval => {
            let start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let inner = parse_expr(parser);
            parser.expect(TokenKind::RightParen);
            let end = parser.previous_end();
            Expr {
                kind: ExprKind::Eval(parser.alloc(inner)),
                span: Span::new(start, end),
            }
        }

        // include / include_once / require / require_once
        TokenKind::Include => {
            let token = parser.advance();
            let inner = parse_expr(parser);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::Include, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::IncludeOnce => {
            let token = parser.advance();
            let inner = parse_expr(parser);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::IncludeOnce, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::Require => {
            let token = parser.advance();
            let inner = parse_expr(parser);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::Require, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::RequireOnce => {
            let token = parser.advance();
            let inner = parse_expr(parser);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::RequireOnce, parser.alloc(inner)),
                span,
            }
        }

        // exit / die
        TokenKind::Exit | TokenKind::Die => {
            let token = parser.advance();
            let src = parser.source;
            let name_text = Name::Simple {
                value: &src[token.span.start as usize..token.span.end as usize],
                span: token.span,
            };
            if parser.check(TokenKind::LeftParen) {
                match parse_arg_list_or_callable(parser) {
                    ArgListResult::CallableMarker(_) => {
                        // exit(...) - first class callable
                        let span = parser.span_from(token.span.start);
                        parser.require_version(PhpVersion::Php84, "exit function call", span);
                        let callee = Expr {
                            kind: ExprKind::Name(name_text),
                            span: token.span,
                        };
                        let span = parser.span_from(token.span.start);
                        Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr {
                                kind: CallableCreateKind::Function(parser.alloc(callee)),
                            }),
                            span,
                        }
                    }
                    ArgListResult::Args(args) => {
                        let span = parser.span_from(token.span.start);
                        if args.is_empty() {
                            // exit()
                            Expr {
                                kind: ExprKind::Exit(None),
                                span,
                            }
                        } else if args.len() == 1 && is_plain_arg(&args[0]) {
                            // exit(expr)
                            let value = into_plain_value(
                                args.into_iter()
                                    .next()
                                    .expect("args.len() == 1 checked above"),
                            );
                            if has_trailing_comma(src, value.span.end, parser.previous_end()) {
                                parser.require_version(
                                    PhpVersion::Php84,
                                    "exit function call",
                                    span,
                                );
                            }
                            Expr {
                                kind: ExprKind::Exit(Some(parser.alloc(value))),
                                span,
                            }
                        } else {
                            // exit(status: 42), exit(...$args), exit($a, $b) - function call form
                            parser.require_version(PhpVersion::Php84, "exit function call", span);
                            let callee = Expr {
                                kind: ExprKind::Name(name_text),
                                span: token.span,
                            };
                            Expr {
                                kind: ExprKind::FunctionCall(FunctionCallExpr {
                                    name: parser.alloc(callee),
                                    args,
                                }),
                                span,
                            }
                        }
                    }
                }
            } else {
                // bare exit/die
                Expr {
                    kind: ExprKind::Exit(None),
                    span: token.span,
                }
            }
        }

        // clone — unary prefix, clone($obj), clone($obj, [...]) (PHP 8.5), or user function
        TokenKind::Clone => {
            let token = parser.advance();
            // Distinguish `clone (cast) $x` (unary prefix with cast operand) from
            // `clone(args)` (function-call / first-class-callable form). A `(` that
            // starts a cast is followed by a cast keyword and a `)`.
            let looks_like_cast =
                parser.check(TokenKind::LeftParen) && parser.cast_ahead().is_some();
            if !looks_like_cast && parser.check(TokenKind::LeftParen) {
                let src = parser.source;
                let name_text = Name::Simple {
                    value: &src[token.span.start as usize..token.span.end as usize],
                    span: token.span,
                };
                let open_paren_start = parser.current_span().start;
                match parse_arg_list_or_callable(parser) {
                    ArgListResult::CallableMarker(_) => {
                        // clone(...) — first-class callable (PHP 8.5)
                        parser.require_version(
                            PhpVersion::Php85,
                            "clone(...) first-class callable",
                            token.span,
                        );
                        let span = parser.span_from(token.span.start);
                        let callee = Expr {
                            kind: ExprKind::Name(name_text),
                            span: token.span,
                        };
                        Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr {
                                kind: CallableCreateKind::Function(parser.alloc(callee)),
                            }),
                            span,
                        }
                    }
                    ArgListResult::Args(args) => {
                        let span = parser.span_from(token.span.start);
                        let is_simple = args.len() == 1 && is_plain_arg(&args[0]);
                        let is_clone_with =
                            args.len() == 2 && is_plain_arg(&args[0]) && is_plain_arg(&args[1]);
                        if is_simple {
                            // clone($obj) — parenthesised single-argument form
                            let object = into_plain_value(
                                args.into_iter()
                                    .next()
                                    .expect("is_simple: args.len() == 1 checked above"),
                            );
                            // Before 8.5 `clone(...)` is `clone` of a parenthesized expression.
                            if has_trailing_comma(src, object.span.end, parser.previous_end()) {
                                parser.require_version(
                                    PhpVersion::Php85,
                                    "clone function call",
                                    span,
                                );
                            }
                            if matches!(
                                parser.current_kind(),
                                TokenKind::Arrow
                                    | TokenKind::NullsafeArrow
                                    | TokenKind::DoubleColon
                                    | TokenKind::LeftBracket
                                    | TokenKind::LeftParen
                            ) && !has_trailing_comma(src, object.span.end, parser.previous_end())
                            {
                                // `clone($a)->b` is `clone (($a)->b)`: the parentheses are only grouping
                                let grouped = Expr {
                                    kind: ExprKind::Parenthesized(parser.alloc(object)),
                                    span: parser.span_from(open_paren_start),
                                };
                                let mut operand =
                                    parse_expr_continue(parser, grouped, precedence::CLONE_BP);
                                if parser.current_kind().is_assignment_op() {
                                    operand = parse_assign_continuation(parser, operand);
                                }
                                let span = token.span.merge(operand.span);
                                return Expr {
                                    kind: ExprKind::Clone(parser.alloc(operand)),
                                    span,
                                };
                            }
                            Expr {
                                kind: ExprKind::Clone(parser.alloc(object)),
                                span,
                            }
                        } else if is_clone_with {
                            // clone($obj, [...]) — PHP 8.5 clone with property overrides
                            parser.require_version(
                                PhpVersion::Php85,
                                "clone with property overrides",
                                token.span,
                            );
                            let mut iter = args.into_iter();
                            let object = into_plain_value(
                                iter.next()
                                    .expect("is_clone_with: args.len() == 2 checked above"),
                            );
                            let overrides = into_plain_value(
                                iter.next()
                                    .expect("is_clone_with: args.len() == 2 checked above"),
                            );
                            Expr {
                                kind: ExprKind::CloneWith(
                                    parser.alloc(object),
                                    parser.alloc(overrides),
                                ),
                                span,
                            }
                        } else {
                            // 3+ args, named args, or spread — user-defined function named "clone"
                            parser.require_version(PhpVersion::Php85, "clone function call", span);
                            let callee = Expr {
                                kind: ExprKind::Name(name_text),
                                span: token.span,
                            };
                            Expr {
                                kind: ExprKind::FunctionCall(FunctionCallExpr {
                                    name: parser.alloc(callee),
                                    args,
                                }),
                                span,
                            }
                        }
                    }
                }
            } else {
                let mut operand = parse_expr_bp(parser, precedence::CLONE_BP);
                if parser.current_kind().is_assignment_op() {
                    operand = parse_assign_continuation(parser, operand);
                }
                let span = token.span.merge(operand.span);
                Expr {
                    kind: ExprKind::Clone(parser.alloc(operand)),
                    span,
                }
            }
        }

        // Magic constants
        TokenKind::MagicClass
        | TokenKind::MagicDir
        | TokenKind::MagicFile
        | TokenKind::MagicFunction
        | TokenKind::MagicLine
        | TokenKind::MagicMethod
        | TokenKind::MagicNamespace
        | TokenKind::MagicTrait
        | TokenKind::MagicProperty => {
            let t = parser.advance();
            let magic_kind = match t.kind {
                TokenKind::MagicClass => MagicConstKind::Class,
                TokenKind::MagicDir => MagicConstKind::Dir,
                TokenKind::MagicFile => MagicConstKind::File,
                TokenKind::MagicFunction => MagicConstKind::Function,
                TokenKind::MagicLine => MagicConstKind::Line,
                TokenKind::MagicMethod => MagicConstKind::Method,
                TokenKind::MagicNamespace => MagicConstKind::Namespace,
                TokenKind::MagicTrait => MagicConstKind::Trait,
                TokenKind::MagicProperty => MagicConstKind::Property,
                _ => unreachable!(),
            };
            Expr {
                kind: ExprKind::MagicConst(magic_kind),
                span: t.span,
            }
        }

        // namespace\Foo\Bar — relative name in expression context
        TokenKind::Namespace if parser.peek_kind() == Some(TokenKind::Backslash) => {
            name_expr(parser.parse_name())
        }
        TokenKind::Namespace => {
            parser.error_expected("expression");
            Expr {
                kind: ExprKind::Error,
                span: parser.missing_span(),
            }
        }

        // readonly used as identifier (function name, etc.)
        TokenKind::Readonly => {
            let token = parser.advance();
            simple_name_expr("readonly", token.span)
        }

        // Error: unexpected token
        kind => {
            parser.error_expected("expression");
            // An operator the expression goes on to consume starts its parent, so the operand sits there.
            let span = if continues_expression(kind) {
                let at = parser.start_span();
                Span::new(at, at)
            } else {
                parser.missing_span()
            };
            Expr {
                kind: ExprKind::Error,
                span,
            }
        }
    }
}

/// Whether `kind` continues an expression after its first operand.
fn continues_expression(kind: TokenKind) -> bool {
    precedence::infix_binding_power(kind).is_some()
        || kind.is_assignment_op()
        || matches!(
            kind,
            TokenKind::Question
                | TokenKind::QuestionQuestion
                | TokenKind::Arrow
                | TokenKind::NullsafeArrow
                | TokenKind::DoubleColon
        )
}

// =============================================================================
// New expression: new ClassName(args)
// =============================================================================

/// Consume a `new_variable` dereference tail on a `new` class reference:
/// `->prop`, `?->prop`, `[idx]`, and `::$staticProp`. In PHP's grammar these are
/// part of the *class-name reference*, not a dereference of the constructed
/// object — so `new $this->job()` instantiates the class named by `$this->job`
/// (`new ($this->job)()`), rather than calling a method on `new $this`.
fn parse_new_variable_tail<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    mut base: Expr<'arena, 'src>,
) -> Expr<'arena, 'src> {
    loop {
        match parser.current_kind() {
            TokenKind::Arrow | TokenKind::NullsafeArrow => {
                let nullsafe = parser.current_kind() == TokenKind::NullsafeArrow;
                let op_span = parser.current_span();
                parser.advance();
                if nullsafe {
                    // `?->` is PHP 8.0+ even inside a class-name reference.
                    parser.require_version(
                        crate::version::PhpVersion::Php80,
                        "nullsafe operator (?->)",
                        op_span,
                    );
                }
                let property = parse_member_name(parser);
                let span = Span::new(base.span.start, property.span.end);
                let access = PropertyAccessExpr {
                    object: parser.alloc(base),
                    property: parser.alloc(property),
                };
                base = Expr {
                    kind: if nullsafe {
                        ExprKind::NullsafePropertyAccess(access)
                    } else {
                        ExprKind::PropertyAccess(access)
                    },
                    span,
                };
            }
            TokenKind::LeftBracket => {
                parser.advance();
                let index = if parser.check(TokenKind::RightBracket) {
                    None
                } else {
                    let e = parse_expr(parser);
                    Some(parser.alloc(e))
                };
                parser.expect(TokenKind::RightBracket);
                let span = parser.span_from(base.span.start);
                base = Expr {
                    kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                        array: parser.alloc(base),
                        index,
                    }),
                    span,
                };
            }
            // `::$prop` — static property as part of the class reference. A
            // following identifier (`::CONST`) is not a `new_variable`, so stop.
            TokenKind::DoubleColon if matches!(parser.peek_kind(), Some(TokenKind::Variable)) => {
                parser.advance(); // ::
                let token = parser.advance(); // $prop
                let var_name = parser.variable_name(token);
                let member = parser.alloc(Expr {
                    kind: ExprKind::Identifier(NameStr::from_source(var_name)),
                    span: token.span,
                });
                let span = Span::new(base.span.start, token.span.end);
                base = Expr {
                    kind: ExprKind::StaticPropertyAccess(StaticAccessExpr {
                        class: parser.alloc(base),
                        member,
                    }),
                    span,
                };
            }
            _ => break,
        }
    }
    base
}

fn parse_new_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'new'

    // Anonymous class: new class(...) or new readonly class(...) or new #[Attr] class(...)
    // Collect any attributes that appear between `new` and `class`/`readonly`.
    let anon_attributes = if parser.check(TokenKind::HashBracket) {
        parser.parse_attributes()
    } else {
        parser.alloc_vec()
    };
    // From PHP 8.1 `readonly` after `new` starts an anonymous class; 8.1 lexes `readonly(` as a name.
    let anon_readonly = parser.check(TokenKind::Readonly)
        && match parser.peek_kind() {
            Some(TokenKind::Class) => true,
            Some(TokenKind::LeftParen) => parser.version >= PhpVersion::Php82,
            _ => parser.version >= PhpVersion::Php81,
        };
    if anon_readonly {
        let readonly = parser.advance();
        parser.require_version(
            PhpVersion::Php83,
            "readonly anonymous classes",
            readonly.span,
        );
        while let Some(repeated) = parser.eat(TokenKind::Readonly) {
            if parser.version >= PhpVersion::Php83 {
                parser.forbid(
                    ForbiddenRule::DuplicateModifier,
                    "Multiple readonly modifiers are not allowed",
                    repeated.span,
                );
            }
        }
        if !parser.check(TokenKind::Class) {
            parser.error_expected("'class'");
            return Expr {
                kind: ExprKind::Error,
                span: parser.span_from(start),
            };
        }
    } else if !anon_attributes.is_empty() && !parser.check(TokenKind::Class) {
        // Attributes after `new` belong to an anonymous class only.
        parser.error_expected("'class'");
    }
    if parser.check(TokenKind::Class) {
        parser.advance(); // consume 'class'

        // Optional constructor args (before extends/implements).
        // `new class(...)` rejects first-class callable syntax (PHP fatal).
        let args = if parser.check(TokenKind::LeftParen) {
            let paren_start = parser.current_span().start;
            match parse_arg_list_or_callable(parser) {
                ArgListResult::Args(args) => {
                    reject_pfa_placeholders_in_new(parser, &args);
                    args
                }
                ArgListResult::CallableMarker(ellipsis) => {
                    parser.forbid(
                        ForbiddenRule::ClosureForNew,
                        "Cannot create Closure for new expression",
                        parser.span_from(paren_start),
                    );
                    callable_marker_arg(parser, ellipsis)
                }
            }
        } else {
            parser.alloc_vec()
        };

        let extends = if parser.eat(TokenKind::Extends).is_some() {
            let name = parser.parse_class_ref_name();
            stmt::validate_class_ref(parser, &name, "class");
            Some(name)
        } else {
            None
        };

        let implements = if parser.eat(TokenKind::Implements).is_some() {
            let names = stmt::parse_name_list(parser);
            for name in names.iter() {
                stmt::validate_class_ref(parser, name, "interface");
            }
            names
        } else {
            parser.alloc_vec()
        };

        let brace_start = parser.start_span();
        let open = parser.expect(TokenKind::LeftBrace);
        let scope = parser.class_scope_for(None, extends.as_ref(), false);
        let kind = ClassKind::Class {
            is_abstract: false,
            is_readonly: anon_readonly,
        };
        parser.check_attributes(&anon_attributes, &AttrSite::class(kind, &scope.name));
        let class_name = scope.name.clone();
        let members = stmt::parse_class_members(parser, false, false, scope);
        stmt::check_abstract_members(parser, &class_name, &members, true);
        if anon_readonly {
            stmt::check_readonly_class_members(parser, &class_name, &members);
        }
        parser.expect_body_close(open);
        let end = parser.previous_end();

        let class_decl = {
            let mut built = ClassDecl::new(
                parser.arena,
                None,
                ClassBody {
                    members,
                    span: parser.span_from(brace_start),
                },
            );
            built.modifiers = crate::stmt::class_modifiers(false, false, anon_readonly);
            built.extends = extends;
            built.implements = implements;
            built.attributes = anon_attributes;
            built.doc_comment = None;
            built
        };

        let anon_class_expr = Expr {
            kind: ExprKind::AnonymousClass(parser.alloc(class_decl)),
            span: Span::new(start, end),
        };
        if new_dereference_follows(parser) {
            require_new_dereference_version(parser);
        }

        return Expr {
            kind: ExprKind::New(NewExpr {
                class: parser.alloc(anon_class_expr),
                args,
            }),
            span: Span::new(start, end),
        };
    }

    // Parse the class name — can be an identifier, self, parent, static, qualified name, or parenthesized expr.
    // A *name* form (Foo / self / parent / static) cannot be dereferenced unless
    // the `new` has parentheses; *variable* forms (`new $c->p`) can (they form a
    // `new_variable` class reference in PHP's grammar).
    let class_is_name = !matches!(
        parser.current_kind(),
        TokenKind::Variable | TokenKind::Dollar | TokenKind::LeftParen
    );
    let class_is_variable = matches!(
        parser.current_kind(),
        TokenKind::Variable | TokenKind::Dollar
    );
    let class = match parser.current_kind() {
        TokenKind::Self_ => {
            let t = parser.advance();
            parser.note_class_keyword(TokenKind::Self_);
            simple_name_expr("self", t.span)
        }
        TokenKind::Parent_ => {
            let t = parser.advance();
            parser.note_class_keyword(TokenKind::Parent_);
            simple_name_expr("parent", t.span)
        }
        TokenKind::Static => {
            let t = parser.advance();
            parser.note_class_keyword(TokenKind::Static);
            simple_name_expr("static", t.span)
        }
        TokenKind::Variable => {
            // new $className()
            let t = parser.advance();
            Expr {
                kind: ExprKind::Variable(NameStr::from_source(parser.variable_name(t))),
                span: t.span,
            }
        }
        TokenKind::Dollar => {
            // new $$varVar() or new ${expr}()
            let token = parser.advance();
            let inner = if parser.check(TokenKind::LeftBrace) {
                parser.advance();
                let expr = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                expr
            } else {
                parse_variable_variable_name(parser)
            };
            let span = parser.span_from(token.span.start);
            Expr {
                kind: ExprKind::VariableVariable(parser.alloc(inner)),
                span,
            }
        }
        TokenKind::LeftParen => {
            // new (expr)() - dynamic class name from expression (PHP 8.0+)
            let paren_start = parser.start_span();
            let open = parser.advance(); // consume (
            parser.require_version(PhpVersion::Php80, "new with an expression", open.span);
            let inner = parse_expr(parser);
            parser.expect_closing(TokenKind::RightParen, open.span);
            let paren_span = parser.span_from(paren_start);
            let class = Expr {
                kind: ExprKind::Parenthesized(parser.alloc(inner)),
                span: paren_span,
            };
            super::check_class_name_literal(parser, &class);
            class
        }
        _ => name_expr(parser.parse_class_ref_name()),
    };

    // Consume any `new_variable` dereference tail that is part of the class-name
    // reference (PHP's grammar). For a variable base this is `->prop`/`[idx]`/
    // `::$prop`; a *name* base can only begin one via `Name::$staticProp`.
    // A variable base always begins a `new_variable`; a name base only does so
    // via `Name::$staticProp`.
    let starts_new_variable = class_is_variable
        || (class_is_name
            && parser.current_kind() == TokenKind::DoubleColon
            && matches!(parser.peek_kind(), Some(TokenKind::Variable)));
    let class = if starts_new_variable {
        parse_new_variable_tail(parser, class)
    } else {
        class
    };

    // Optional argument list. `new Foo(...)` is rejected: PHP forbids first-class
    // callable syntax in `new` expressions ("Cannot create Closure for new expression").
    let had_parens = parser.check(TokenKind::LeftParen);
    let args = if parser.check(TokenKind::LeftParen) {
        let paren_start = parser.current_span().start;
        match parse_arg_list_or_callable(parser) {
            ArgListResult::Args(args) => {
                reject_pfa_placeholders_in_new(parser, &args);
                args
            }
            ArgListResult::CallableMarker(ellipsis) => {
                parser.forbid(
                    ForbiddenRule::ClosureForNew,
                    "Cannot create Closure for new expression",
                    parser.span_from(paren_start),
                );
                callable_marker_arg(parser, ellipsis)
            }
        }
    } else {
        parser.alloc_vec()
    };

    if new_dereference_follows(parser) {
        if had_parens {
            require_new_dereference_version(parser);
        } else if matches!(class.kind, ExprKind::Name(_)) {
            // The class is still a bare *name* (any `new_variable` tail such as
            // `Name::$prop` was already consumed above). A parenless `new` with a
            // class name cannot be dereferenced — `new Foo->bar`, `new Foo::class`,
            // `new Foo[0]`, `new self::C` are all rejected by PHP.
            parser.forbid(ForbiddenRule::UnparenthesizedNewDereference, "Cannot use a new expression with a class name as a dereferenceable expression without parentheses", parser.current_span());
        }
    }

    let span = parser.span_from(start);
    Expr {
        kind: ExprKind::New(NewExpr {
            class: parser.alloc(class),
            args,
        }),
        span,
    }
}

/// A `new` expression followed by `->`, `?->`, `::`, `[` or `(` dereferences the new object.
fn new_dereference_follows(parser: &Parser<'_, '_>) -> bool {
    matches!(
        parser.current_kind(),
        TokenKind::Arrow
            | TokenKind::NullsafeArrow
            | TokenKind::DoubleColon
            | TokenKind::LeftBracket
            | TokenKind::LeftParen
    )
}

/// `new Foo()->bar`, `new Foo()()`, `new class {}->bar` — PHP 8.4+.
fn require_new_dereference_version(parser: &mut Parser<'_, '_>) {
    parser.require_version(
        crate::version::PhpVersion::Php84,
        "dereferencing a new expression without parentheses",
        parser.current_span(),
    );
}

// =============================================================================
// Closure expression: function($x) use($y) { }
// =============================================================================

pub(crate) fn parse_closure<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    is_static: bool,
    start: u32,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Expr<'arena, 'src> {
    if !is_static {
        parser.advance(); // consume 'function'
    } else {
        parser.advance(); // consume 'function' (static was already consumed)
    }

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();
    let saved_class_keywords = parser.unresolve_class_keywords();

    let missing_param_list = !parser.check(TokenKind::LeftParen);
    let params = if parser.expect(TokenKind::LeftParen).is_some() {
        let params = stmt::parse_param_list(parser);
        parser.expect(TokenKind::RightParen);
        params
    } else {
        parser.alloc_vec()
    };

    // use clause
    let use_vars = if parser.eat(TokenKind::Use).is_some() {
        parser.expect(TokenKind::LeftParen);
        let vars = parse_closure_use_list(parser, &params);
        parser.expect(TokenKind::RightParen);
        vars
    } else {
        parser.alloc_vec()
    };

    // return type
    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    // body
    let brace_start = parser.start_span();
    let open = parser.expect(TokenKind::LeftBrace);
    let mut body_stmts = parser.alloc_vec_with_capacity(16);
    let saved_loop_depth = parser.loop_depth;
    parser.loop_depth = 0;
    let saved_finally_loop_depth = parser.finally_loop_depth.take();
    let saved_has_goto_or_label = std::mem::take(&mut parser.has_goto_or_label);
    parser.function_depth += 1;
    let saved_by_ref = std::mem::replace(&mut parser.by_ref_function, by_ref);
    let saved_static_vars = std::mem::take(&mut parser.static_vars);
    // From 8.3 PHP stores the closure's `use` variables as its static variables.
    if parser.version >= PhpVersion::Php83 {
        parser
            .static_vars
            .extend(use_vars.iter().filter_map(|var| var.name.as_str()));
    }
    let saved_has_yield = std::mem::take(&mut parser.has_yield);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        stmt::push_stmt(parser, &mut body_stmts);
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    parser.function_depth -= 1;
    parser.by_ref_function = saved_by_ref;
    parser.static_vars = saved_static_vars;
    let is_generator = std::mem::replace(&mut parser.has_yield, saved_has_yield);
    if parser.has_goto_or_label {
        stmt::check_gotos(parser, &body_stmts);
    }
    parser.has_goto_or_label = saved_has_goto_or_label;
    parser.finally_loop_depth = saved_finally_loop_depth;
    parser.loop_depth = saved_loop_depth;
    parser.restore_class_keywords(saved_class_keywords);
    parser.expect_body_close(open);
    let end = parser.previous_end();
    let body = parser.alloc(Block {
        stmts: body_stmts,
        span: parser.span_from(brace_start),
    });
    if let Some(rt) = &return_type {
        let in_class = parser.class_scope.is_some();
        stmt::check_returns_against_type(parser, body, rt, is_generator, in_class);
    }
    parser.check_attributes(
        &attributes,
        &AttrSite::new(AttrTarget::Function).with_return_type(return_type.as_ref()),
    );

    Expr {
        kind: ExprKind::Closure(parser.alloc({
            let mut built = ClosureExpr::new(parser.arena, body);
            built.missing_param_list = missing_param_list;
            built.is_static = is_static;
            built.by_ref = by_ref;
            built.params = params;
            built.use_vars = use_vars;
            built.return_type = return_type;
            built.attributes = attributes;
            built
        })),
        span: Span::new(start, end),
    }
}

fn parse_closure_use_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    params: &[Param<'arena, 'src>],
) -> ArenaVec<'arena, ClosureUseVar<'src>> {
    let mut vars = parser.alloc_vec_with_capacity(2);
    loop {
        // Only a trailing comma may precede `)`; the list itself must not be empty.
        if parser.check(TokenKind::RightParen) && !vars.is_empty() {
            let comma = Span::new(parser.previous_end() - 1, parser.previous_end());
            parser.require_version(
                PhpVersion::Php80,
                "trailing comma in closure use list",
                comma,
            );
            break;
        }
        let var_start = parser.start_span();
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();
        if !parser.check(TokenKind::Variable) {
            parser.error_expected("variable");
        }
        if let Some(token) = parser.eat(TokenKind::Variable) {
            let name = parser.variable_ident(token);
            let span = Span::new(var_start, token.span.end);
            let error: Option<(_, std::borrow::Cow<'static, str>)> = match name.as_str() {
                Some("this") => Some((
                    ForbiddenRule::ThisAsDeclaredVariable,
                    "Cannot use $this as lexical variable".into(),
                )),
                Some(n) if super::is_superglobal(n) => Some((
                    ForbiddenRule::SuperglobalAsDeclaredVariable,
                    "Cannot use auto-global as lexical variable".into(),
                )),
                Some(n) if params.iter().any(|p| p.name.as_str() == Some(n)) => Some((
                    ForbiddenRule::ClosureUseShadowsParameter,
                    format!("Cannot use lexical variable ${n} as a parameter name").into(),
                )),
                Some(n)
                    if vars
                        .iter()
                        .any(|v: &ClosureUseVar<'_>| v.name.as_str() == Some(n)) =>
                {
                    Some((
                        ForbiddenRule::DuplicateClosureUseVariable,
                        format!("Cannot use variable ${n} twice").into(),
                    ))
                }
                _ => None,
            };
            if let Some((rule, message)) = error {
                parser.forbid(rule, message, name.span);
            }
            vars.push(ClosureUseVar { name, by_ref, span });
        }
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }
    vars
}

// =============================================================================
// Arrow function: fn($x) => expr
// =============================================================================

pub(crate) fn parse_arrow_function<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    is_static: bool,
    start: u32,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Expr<'arena, 'src> {
    parser.advance(); // consume 'fn'
    let saved_class_keywords = parser.unresolve_class_keywords();

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();

    let missing_param_list = !parser.check(TokenKind::LeftParen);
    let params = if parser.expect(TokenKind::LeftParen).is_some() {
        let params = stmt::parse_param_list(parser);
        parser.expect(TokenKind::RightParen);
        params
    } else {
        parser.alloc_vec()
    };

    // return type
    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    parser.expect(TokenKind::FatArrow);
    parser.function_depth += 1;
    let saved_by_ref = std::mem::replace(&mut parser.by_ref_function, by_ref);
    let saved_static_vars = std::mem::take(&mut parser.static_vars);
    let saved_has_yield = std::mem::take(&mut parser.has_yield);
    let body = parse_expr(parser);
    super::check_reference_return(parser, &body);
    parser.function_depth -= 1;
    parser.by_ref_function = saved_by_ref;
    parser.static_vars = saved_static_vars;
    let is_generator = std::mem::replace(&mut parser.has_yield, saved_has_yield);
    parser.restore_class_keywords(saved_class_keywords);
    let span = parser.span_to(start, body.span);
    if let (true, Some(rt)) = (is_generator, &return_type) {
        stmt::check_generator_return_type(parser, rt);
    } else if return_type.as_ref().is_some_and(stmt::is_void_type) {
        let what = stmt::function_kind_word(parser.class_scope.is_some());
        parser.forbid(
            ForbiddenRule::VoidReturnValue,
            stmt::void_return_message(what, &body),
            body.span,
        );
    }
    // PHP 8.1 treats the arrow body as a `return` even when it is a `throw`.
    if parser.version < PhpVersion::Php82 && return_type.as_ref().is_some_and(stmt::is_never_type) {
        parser.forbid(
            ForbiddenRule::NeverReturn,
            stmt::never_return_message("function"),
            body.span,
        );
    }
    parser.check_attributes(
        &attributes,
        &AttrSite::new(AttrTarget::Function).with_return_type(return_type.as_ref()),
    );

    Expr {
        kind: ExprKind::ArrowFunction(parser.alloc({
            let mut built = ArrowFunctionExpr::new(parser.arena, parser.alloc(body));
            built.missing_param_list = missing_param_list;
            built.is_static = is_static;
            built.by_ref = by_ref;
            built.params = params;
            built.return_type = return_type;
            built.attributes = attributes;
            built
        })),
        span,
    }
}

// =============================================================================
// Match expression
// =============================================================================

fn parse_match_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'match'

    parser.expect(TokenKind::LeftParen);
    let subject = parse_expr(parser);
    parser.expect(TokenKind::RightParen);
    let brace_span = parser.current_span();
    parser.expect(TokenKind::LeftBrace);
    parse_match_arms(parser, start, subject, brace_span, None)
}

/// Before PHP 8.0 `match` is a name; only `match (...) {` with arms reports the version it needs.
fn parse_match_before_80<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    let keyword_span = parser.current_span();
    let name = parser.parse_name();
    let is_simple = matches!(name, Name::Simple { .. });
    let name = name_expr(name);
    if !is_simple || !parser.check(TokenKind::LeftParen) {
        return name;
    }
    let call = parse_function_call(parser, name);
    let single_value = matches!(
        &call.kind,
        ExprKind::FunctionCall(f) if matches!(
            &f.args[..],
            [Arg { name: None, kind: ArgKind::Value(_), .. }]
        )
    );
    if !single_value || !parser.check(TokenKind::LeftBrace) {
        return call;
    }
    let brace_span = parser.current_span();
    parser.advance(); // consume {
    let first_condition = if parser.no_brace_subscript
        || parser.check(TokenKind::RightBrace)
        || parser.check(TokenKind::Default)
        || parser.check(TokenKind::Eof)
    {
        None
    } else {
        let index = parse_expr(parser);
        // `match($x){0}` is a curly offset on the call's result.
        if parser.eat(TokenKind::RightBrace).is_some() {
            let span = parser.span_from(start);
            return Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: parser.alloc(call),
                    index: Some(parser.alloc(index)),
                }),
                span,
            };
        }
        Some(index)
    };
    let ExprKind::FunctionCall(f) = call.kind else {
        unreachable!("checked above");
    };
    let Some(Arg {
        kind: ArgKind::Value(subject),
        ..
    }) = f.args.into_iter().next()
    else {
        unreachable!("checked above");
    };
    parser.require_version(PhpVersion::Php80, "match expressions", keyword_span);
    parse_match_arms(parser, start, subject, brace_span, first_condition)
}

/// The arms of a match expression after its `{`, starting with `first_condition` if it is parsed.
fn parse_match_arms<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    start: u32,
    subject: Expr<'arena, 'src>,
    brace_span: Span,
    mut first_condition: Option<Expr<'arena, 'src>>,
) -> Expr<'arena, 'src> {
    let mut arms = parser.alloc_vec_with_capacity(4);
    let mut seen_default = false;
    while first_condition.is_some()
        || (!parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof))
    {
        let arm_start = first_condition
            .as_ref()
            .map_or_else(|| parser.start_span(), |c| c.span.start);

        let conditions = if let Some(first) = first_condition.take() {
            Some(parse_match_conditions(parser, first))
        } else if let Some(tok) = parser.eat(TokenKind::Default) {
            if seen_default {
                parser.forbid(
                    ForbiddenRule::DuplicateMatchDefault,
                    "Match expressions may only contain one default arm",
                    tok.span,
                );
            }
            seen_default = true;
            // Allow trailing comma after default: `default, => ...`
            parser.eat(TokenKind::Comma);
            None
        } else {
            let first = parse_expr(parser);
            Some(parse_match_conditions(parser, first))
        };

        parser.expect(TokenKind::FatArrow);
        let body = parse_expr(parser);
        let arm_span = parser.span_to(arm_start, body.span);

        arms.push(MatchArm {
            conditions,
            body,
            span: arm_span,
        });

        // Match arms separated by commas
        if parser.eat(TokenKind::Comma).is_none() {
            // Read on after a missing comma, so the next arm is not parsed as statements.
            if parser.current_span().start > arm_start
                && !matches!(
                    parser.current_kind(),
                    TokenKind::RightBrace | TokenKind::Eof | TokenKind::Semicolon
                )
            {
                parser.error_expected("'}'");
                continue;
            }
            break;
        }
    }

    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();

    Expr {
        kind: ExprKind::Match(MatchExpr::new(parser.alloc(subject), arms, brace_span)),
        span: Span::new(start, end),
    }
}

/// The conditions of a match arm whose first condition is parsed.
fn parse_match_conditions<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    first: Expr<'arena, 'src>,
) -> ArenaVec<'arena, Expr<'arena, 'src>> {
    let mut conds = parser.alloc_vec_with_capacity(2);
    conds.push(first);
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::FatArrow) {
            break;
        }
        conds.push(parse_expr(parser));
    }
    conds
}

// =============================================================================
// Yield expression
// =============================================================================

/// PHP checks a value yielded by reference for a nullsafe chain from 8.2.
fn check_reference_yield(parser: &mut Parser<'_, '_>, value: &Expr<'_, '_>) {
    if parser.version >= PhpVersion::Php82 {
        super::check_reference_return(parser, value);
    }
}

fn parse_yield_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'yield'
    parser.has_yield = true;

    if parser.function_depth == 0 {
        parser.forbid(
            ForbiddenRule::YieldOutsideFunction,
            "The \"yield\" expression can only be used inside a function",
            parser.span_from(start),
        );
    }

    // `from` is an ordinary name everywhere else, so the lexer has no keyword for it.
    // Before 8.3 PHP lexes `yield from` only with whitespace between the words.
    let yield_end = parser.previous_end() as usize;
    if parser.check(TokenKind::Identifier)
        && parser.current_text().eq_ignore_ascii_case("from")
        && (parser.version >= PhpVersion::Php83
            || parser.source()[yield_end..parser.current_span().start as usize]
                .bytes()
                .all(|b| matches!(b, b' ' | b'\t' | b'\n' | b'\r')))
    {
        parser.advance();
        let value = parse_expr_bp(parser, precedence::YIELD_OPERAND_BP);
        let span = parser.span_to(start, value.span);
        if parser.by_ref_function {
            parser.forbid(
                ForbiddenRule::YieldFromInByReferenceGenerator,
                "Cannot use \"yield from\" inside a by-reference generator",
                span,
            );
        }
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: None,
                value: Some(parser.alloc(value)),
                is_from: true,
            }),
            span,
        };
    }

    // Bare yield (no value) — also bare when next token is a binary-only operator
    // e.g. `yield * -1` → `(yield) * (-1)`, but `yield +1` → `yield (+1)`
    let kind = parser.current_kind();
    let is_binary_only = precedence::infix_binding_power(kind).is_some()
        && precedence::prefix_binding_power(kind).is_none();
    if parser.at_statement_end()
        || parser.check(TokenKind::RightParen)
        || parser.check(TokenKind::RightBracket)
        || parser.check(TokenKind::RightBrace)
        || parser.check(TokenKind::Comma)
        || is_binary_only
        || matches!(
            kind,
            TokenKind::Question
                | TokenKind::QuestionQuestion
                | TokenKind::Colon
                | TokenKind::FatArrow
                | TokenKind::As
        )
    {
        let span = parser.span_from(start);
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: None,
                value: None,
                is_from: false,
            }),
            span,
        };
    }

    let first = parse_expr_bp(parser, precedence::YIELD_OPERAND_BP);

    // yield key => value
    if parser.eat(TokenKind::FatArrow).is_some() {
        let value = parse_expr_bp(parser, precedence::YIELD_OPERAND_BP);
        check_reference_yield(parser, &value);
        let span = parser.span_to(start, value.span);
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: Some(parser.alloc(first)),
                value: Some(parser.alloc(value)),
                is_from: false,
            }),
            span,
        };
    }

    // yield value
    check_reference_yield(parser, &first);
    let span = parser.span_to(start, first.span);
    Expr {
        kind: ExprKind::Yield(YieldExpr {
            key: None,
            value: Some(parser.alloc(first)),
            is_from: false,
        }),
        span,
    }
}

/// Retract the error for a `{}` offset in the fetch chain of an `isset()` or `empty()` operand,
/// which PHP 8.0 to 8.3 compile without the check; their indexes are still checked.
fn allow_curly_offsets(parser: &mut Parser<'_, '_>, operand: &Expr<'_, '_>) {
    if !(PhpVersion::Php80..PhpVersion::Php84).contains(&parser.version) {
        return;
    }
    let mut brackets = Vec::new();
    let mut expr = operand;
    loop {
        match &expr.kind {
            ExprKind::ArrayAccess(a) => {
                let end = a.index.map_or(expr.span.end, |index| index.span.start);
                brackets.push(Span::new(a.array.span.end, end));
                expr = a.array;
            }
            ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => expr = p.object,
            ExprKind::Parenthesized(inner) => expr = inner,
            _ => break,
        }
    }
    if brackets.is_empty() {
        return;
    }
    parser.errors_mut().retain(|e| match e {
        ParseError::Forbidden {
            rule: ForbiddenRule::CurlyOffsetAccess,
            span,
            ..
        } => !brackets
            .iter()
            .any(|b| span.start >= b.start && span.end <= b.end),
        _ => true,
    });
}

// =============================================================================
/// Returns true if `kind` is a valid argument to `isset()` — i.e. an lvalue
/// reference (variable, array/property access). PHP rejects expressions like
/// `isset(1 + 1)` with a fatal at parse-time. Parenthesised lvalues are
/// accepted (`isset(($a))`).
fn isset_target_valid(kind: &ExprKind<'_, '_>) -> bool {
    matches!(
        kind,
        ExprKind::Variable(_)
            | ExprKind::VariableVariable(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::StaticPropertyAccessDynamic { .. }
    ) || matches!(kind, ExprKind::Parenthesized(inner) if isset_target_valid(&inner.kind))
}

// Argument list parsing
// =============================================================================

/// Parse an argument list `(arg, arg, ...)` or detect `(...)` first-class callable syntax.
/// The `...` of a `(...)` that PHP rejects, kept as a placeholder so the error survives printing.
pub(crate) fn callable_marker_arg<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    ellipsis: Span,
) -> ArenaVec<'arena, Arg<'arena, 'src>> {
    let mut args = parser.alloc_vec_with_capacity(1);
    args.push(Arg::new(None, ArgKind::SpreadPlaceholder, ellipsis));
    args
}

pub(crate) fn parse_arg_list_or_callable<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArgListResult<'arena, 'src> {
    parser.advance(); // consume (

    // Detect first-class callable: (...)
    if parser.check(TokenKind::Ellipsis) && parser.peek_kind() == Some(TokenKind::RightParen) {
        let span = parser.current_span();
        parser.require_version(PhpVersion::Php81, "first-class callable syntax", span);
        parser.advance(); // consume ...
        parser.advance(); // consume )
        return ArgListResult::CallableMarker(span);
    }

    let mut args = parser.alloc_vec_with_capacity(4);
    let mut seen_named = false;
    let mut seen_spread = false;

    if !parser.check(TokenKind::RightParen) {
        loop {
            if parser.check(TokenKind::RightParen) {
                break; // trailing comma
            }
            let arg = parse_arg(parser);
            if let ArgKind::Value(value) = &arg.kind {
                if matches!(
                    value.kind,
                    ExprKind::ArrayAccess(_) | ExprKind::PropertyAccess(_)
                ) && super::builtin_call_base(parser, &value.kind, false)
                {
                    parser.builtin_fetch_args.push(value.span);
                }
            }
            // The PHP 8.6 rest placeholder (bare `...`) is always last and is
            // explicitly allowed after named arguments, e.g. `stuff(a: 1, ...)`.
            let is_rest_placeholder = matches!(arg.kind, ArgKind::SpreadPlaceholder);

            if arg.name.is_some() {
                seen_named = true;
                if seen_spread {
                    parser.require_version(
                        PhpVersion::Php81,
                        "named argument after argument unpacking",
                        arg.span,
                    );
                }
            } else if seen_spread && !arg.is_spread() && !arg.is_placeholder() {
                parser.forbid(
                    ForbiddenRule::PositionalAfterUnpacking,
                    "Cannot use positional argument after argument unpacking",
                    arg.span,
                );
            } else if seen_named && !is_rest_placeholder {
                let message = if !arg.is_spread() {
                    "Cannot use positional argument after named argument"
                } else {
                    "Cannot use argument unpacking after named arguments"
                };
                parser.forbid(
                    ForbiddenRule::PositionalAfterNamedArgument,
                    message,
                    arg.span,
                );
            }

            seen_spread |= arg.is_spread();
            args.push(arg);
            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
    }

    if parser.version >= PhpVersion::Php86 && args.iter().any(|arg| arg.is_spread()) {
        if let Some(placeholder) = args.iter().find(|arg| arg.is_placeholder()) {
            parser.forbid(
                ForbiddenRule::PartialApplicationWithUnpacking,
                "Cannot combine partial application and unpacking",
                placeholder.span,
            );
        }
    }

    parser.expect(TokenKind::RightParen);
    ArgListResult::Args(args)
}

/// `new` always constructs immediately, so PHP forbids partial function application there.
fn reject_pfa_placeholders_in_new(parser: &mut Parser<'_, '_>, args: &[Arg]) {
    for arg in args {
        if arg.is_placeholder() {
            parser.forbid(
                ForbiddenRule::PartialApplicationInNew,
                "Cannot create Closure for new expression",
                arg.span,
            );
        }
    }
}

fn parse_arg<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Arg<'arena, 'src> {
    let start = parser.start_span();

    // Check for named argument: name: (PHP allows any keyword as a named arg label)
    let name = if parser.peek_kind() == Some(TokenKind::Colon) {
        let kind = parser.current_kind();
        if kind == TokenKind::Identifier
            || parser.is_semi_reserved_keyword()
            || matches!(
                kind,
                TokenKind::Array
                    | TokenKind::List
                    | TokenKind::Match_
                    | TokenKind::Fn_
                    | TokenKind::Static
                    | TokenKind::Abstract
                    | TokenKind::Final
                    | TokenKind::Readonly
                    | TokenKind::Class
                    | TokenKind::Interface
                    | TokenKind::Trait
                    | TokenKind::Enum_
                    | TokenKind::Extends
                    | TokenKind::Implements
                    | TokenKind::Const
                    | TokenKind::Use
                    | TokenKind::Namespace
                    | TokenKind::New
                    | TokenKind::Try
                    | TokenKind::Catch
                    | TokenKind::Finally
                    | TokenKind::Throw
                    | TokenKind::Instanceof
                    | TokenKind::Yield_
                    | TokenKind::Switch
                    | TokenKind::Public
                    | TokenKind::Protected
                    | TokenKind::Private
            )
        {
            let name_token = parser.advance();
            let span = name_token.span;
            parser.require_version(PhpVersion::Php80, "named arguments", span);
            parser.advance(); // consume :
            let src = parser.source;
            Some(Name::Simple {
                value: &src[name_token.span.start as usize..name_token.span.end as usize],
                span: name_token.span,
            })
        } else {
            None
        }
    } else {
        None
    };

    // Check for unpack: ...expr, or a bare `...` (PHP 8.6 "rest" placeholder).
    let ellipsis_span = parser.current_span();
    let unpack = parser.eat(TokenKind::Ellipsis).is_some();
    let ends_args = parser.check(TokenKind::RightParen)
        || (parser.check(TokenKind::Comma) && parser.peek_kind() == Some(TokenKind::RightParen));
    if unpack && ends_args {
        parser.require_version(
            PhpVersion::Php86,
            "partial function application",
            ellipsis_span,
        );
        return Arg::new(name, ArgKind::SpreadPlaceholder, parser.span_from(start));
    }

    // Bare `?` (PHP 8.6 placeholder) — never starts an expression, so no lookahead is needed.
    if !unpack && parser.check(TokenKind::Question) {
        let question_span = parser.current_span();
        parser.advance();
        parser.require_version(
            PhpVersion::Php86,
            "partial function application",
            question_span,
        );
        return Arg::new(name, ArgKind::Placeholder, parser.span_from(start));
    }

    // Check for by-reference: &$var (call-time pass-by-ref, removed in PHP 7.0)
    let by_ref_span = parser.current_span();
    let by_ref = parser.eat(TokenKind::Ampersand).is_some();
    if by_ref {
        parser.forbid(
            ForbiddenRule::CallTimePassByReference,
            "call-time pass-by-reference is not allowed",
            by_ref_span,
        );
    }

    let value = parse_expr(parser);
    let span = parser.span_to(start, value.span);

    // `...&$x` is already reported above; the spread wins.
    let kind = if unpack {
        ArgKind::Spread(value)
    } else if by_ref {
        ArgKind::ByRef(value)
    } else {
        ArgKind::Value(value)
    };
    Arg::new(name, kind, span)
}

/// An unnamed, unspread argument (a by-ref one has already been reported).
/// True if a comma follows the last argument before the closing `)` that ends at `close_end`.
fn has_trailing_comma(src: &str, last_arg_end: u32, close_end: u32) -> bool {
    // An unclosed argument list leaves `close_end` at the end of the last argument.
    let Some(gap) = src
        .as_bytes()
        .get(last_arg_end as usize..(close_end as usize).saturating_sub(1))
    else {
        return false;
    };
    let mut i = 0;
    while i < gap.len() {
        match gap[i] {
            b',' => return true,
            b'#' => {
                i += gap[i..]
                    .iter()
                    .position(|&b| b == b'\n')
                    .unwrap_or(gap.len() - i)
            }
            b'/' if gap.get(i + 1) == Some(&b'/') => {
                i += gap[i..]
                    .iter()
                    .position(|&b| b == b'\n')
                    .unwrap_or(gap.len() - i)
            }
            b'/' if gap.get(i + 1) == Some(&b'*') => {
                i += gap[i + 2..]
                    .windows(2)
                    .position(|w| w == b"*/")
                    .map_or(gap.len() - i, |p| p + 4);
            }
            _ => i += 1,
        }
    }
    false
}

fn is_plain_arg(arg: &Arg) -> bool {
    arg.name.is_none() && matches!(arg.kind, ArgKind::Value(_) | ArgKind::ByRef(_))
}

fn into_plain_value<'arena, 'src>(arg: Arg<'arena, 'src>) -> Expr<'arena, 'src> {
    match arg.kind {
        ArgKind::Value(e) | ArgKind::ByRef(e) => e,
        _ => unreachable!("checked by is_plain_arg"),
    }
}

pub(super) fn parse_function_call<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    callee: Expr<'arena, 'src>,
) -> Expr<'arena, 'src> {
    let start = callee.span.start;

    match parse_arg_list_or_callable(parser) {
        ArgListResult::CallableMarker(_) => {
            let span = parser.span_from(start);
            Expr {
                kind: ExprKind::CallableCreate(CallableCreateExpr {
                    kind: CallableCreateKind::Function(parser.alloc(callee)),
                }),
                span,
            }
        }
        ArgListResult::Args(args) => {
            let span = parser.span_from(start);
            Expr {
                kind: ExprKind::FunctionCall(FunctionCallExpr {
                    name: parser.alloc(callee),
                    args,
                }),
                span,
            }
        }
    }
}

// =============================================================================
// Array parsing
// =============================================================================

fn parse_array_literal<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    instrument::record_parse_array();
    let start = parser.start_span();
    parser.advance(); // consume [

    // Room for two elements up front: growing from zero reallocates (and
    // copies), since nested elements keep the vector from growing in place.
    // Most arrays hold one or two elements, so a larger start wastes arena
    // space on each one. Empty `[]` is common and stays unallocated.
    let cap = if parser.check(TokenKind::RightBracket) {
        0
    } else {
        2
    };
    let mut elements = parser.alloc_vec_with_capacity(cap);

    if !parser.check(TokenKind::RightBracket) {
        loop {
            if parser.check(TokenKind::RightBracket) {
                break; // trailing comma case
            }
            // Empty element (skipped position for destructuring): [, $b] or [$a, , $c]
            if parser.check(TokenKind::Comma) {
                let span = parser.current_span();
                // Empty elements are only valid in list-destructuring targets. In a
                // value array PHP rejects them ("Cannot use empty array elements in
                // arrays"). We emit the error eagerly here and retract it at the
                // destructuring sites (assignment LHS, `foreach as`) where it is legal.
                parser.forbid(
                    ForbiddenRule::EmptyArrayElement,
                    "Cannot use empty array elements in arrays",
                    span,
                );
                elements.push(ArrayElement {
                    key: None,
                    kind: ArrayElementKind::Value(Expr {
                        kind: ExprKind::Omit,
                        span,
                    }),
                    span,
                });
            } else {
                elements.push(parse_array_element(parser));
            }
            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
    }

    instrument::record_parse_array_element_count(elements.len());
    parser.expect(TokenKind::RightBracket);
    let end = parser.previous_end();
    let span = Span::new(start, end);

    super::check_constant_unpack(parser, &elements);
    let array = Expr {
        kind: ExprKind::Array(elements),
        span,
    };
    super::check_folded_curly_offsets(parser, &array);
    array
}

fn parse_array_call<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    instrument::record_parse_array();
    let start = parser.start_span();
    parser.advance(); // consume 'array'
    parser.expect(TokenKind::LeftParen);

    // Same sizing as parse_array_literal.
    let cap = if parser.check(TokenKind::RightParen) {
        0
    } else {
        2
    };
    let mut elements = parser.alloc_vec_with_capacity(cap);

    if !parser.check(TokenKind::RightParen) {
        loop {
            if parser.check(TokenKind::RightParen) {
                break; // trailing comma
            }
            elements.push(parse_array_element(parser));
            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
    }

    instrument::record_parse_array_element_count(elements.len());
    parser.expect(TokenKind::RightParen);
    let end = parser.previous_end();
    let span = Span::new(start, end);

    super::check_constant_unpack(parser, &elements);
    let array = Expr {
        kind: ExprKind::Array(elements),
        span,
    };
    super::check_folded_curly_offsets(parser, &array);
    array
}

fn parse_array_element<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArrayElement<'arena, 'src> {
    instrument::record_parse_array_element();
    let elem_start = parser.start_span();

    // Handle unpack: ...$arr
    let unpack = parser.eat(TokenKind::Ellipsis).is_some();

    // Handle &$var (by-ref value, not unpack)
    let by_ref_value = !unpack && parser.eat(TokenKind::Ampersand).is_some();

    instrument::record_parse_expr_array_first();
    let first_expr = parse_expr(parser);

    if !unpack && !by_ref_value && parser.eat(TokenKind::FatArrow).is_some() {
        // key => [&]value
        instrument::record_parse_array_element_with_arrow();
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();
        instrument::record_parse_expr_array_second();
        let value = parse_expr(parser);
        if by_ref {
            super::check_write_target(parser, &value, false);
            // `[&$GLOBALS[]]` is reported as a read of `[]`.
            if matches!(value.kind, ExprKind::Variable(_)) {
                super::check_special_variable_write(parser, &value, super::WriteKind::Modify);
            }
        }
        let elem_span = parser.span_to(elem_start, value.span);
        ArrayElement {
            key: Some(first_expr),
            kind: element_kind(value, false, by_ref),
            span: elem_span,
        }
    } else {
        // value only (or unpack, or by-ref value)
        instrument::record_parse_array_simple_value();
        if by_ref_value {
            super::check_write_target(parser, &first_expr, false);
            if matches!(first_expr.kind, ExprKind::Variable(_)) {
                super::check_special_variable_write(parser, &first_expr, super::WriteKind::Modify);
            }
        }
        let elem_span = parser.span_to(elem_start, first_expr.span);
        ArrayElement {
            key: None,
            kind: element_kind(first_expr, unpack, by_ref_value),
            span: elem_span,
        }
    }
}

fn parse_list_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'list'
    parser.expect(TokenKind::LeftParen);

    let mut elements = parser.alloc_vec_with_capacity(4);

    if !parser.check(TokenKind::RightParen) {
        loop {
            if parser.check(TokenKind::RightParen) {
                break;
            }
            if parser.check(TokenKind::Comma) {
                // empty element — skipped destructuring position
                let span = parser.current_span();
                elements.push(ArrayElement {
                    key: None,
                    kind: ArrayElementKind::Value(Expr {
                        kind: ExprKind::Omit,
                        span,
                    }),
                    span,
                });
            } else {
                elements.push(parse_list_element(parser));
            }

            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
    }

    parser.expect(TokenKind::RightParen);
    let end = parser.previous_end();
    let span = Span::new(start, end);

    parser.forbid(
        ForbiddenRule::ListOutsideDestructuring,
        crate::parser::LIST_OUTSIDE_DESTRUCTURING,
        span,
    );

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

fn element_kind<'arena, 'src>(
    value: Expr<'arena, 'src>,
    unpack: bool,
    by_ref: bool,
) -> ArrayElementKind<'arena, 'src> {
    if unpack {
        ArrayElementKind::Spread(value)
    } else if by_ref {
        ArrayElementKind::ByRef(value)
    } else {
        ArrayElementKind::Value(value)
    }
}

/// Parse a single element in a list() or short list destructuring.
/// Handles: `$var`, `&$var`, `'key' => $var`, `'key' => &$var`, `list($a, $b)`, `...$var`, etc.
fn parse_list_element<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArrayElement<'arena, 'src> {
    let elem_start = parser.start_span();

    // PHP's grammar accepts `...$var` here and rejects it when compiling the assignment.
    if parser.eat(TokenKind::Ellipsis).is_some() {
        let value = parse_expr(parser);
        let elem_span = parser.span_to(elem_start, value.span);
        return ArrayElement {
            key: None,
            kind: element_kind(value, true, false),
            span: elem_span,
        };
    }

    // Handle &$var (by-reference)
    if parser.eat(TokenKind::Ampersand).is_some() {
        let value = parse_expr(parser);
        let elem_span = parser.span_to(elem_start, value.span);
        return ArrayElement {
            key: None,
            kind: element_kind(value, false, true),
            span: elem_span,
        };
    }

    let first = parse_expr(parser);

    if parser.eat(TokenKind::FatArrow).is_some() {
        // key => [&]value
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();
        let value = parse_expr(parser);
        let elem_span = parser.span_to(elem_start, value.span);
        ArrayElement {
            key: Some(first),
            kind: element_kind(value, false, by_ref),
            span: elem_span,
        }
    } else {
        let elem_span = parser.span_to(elem_start, first.span);
        ArrayElement {
            key: None,
            kind: element_kind(first, false, false),
            span: elem_span,
        }
    }
}

/// Whether the current token starts an operand rather than continuing an expression.
fn operand_follows(parser: &mut Parser<'_, '_>) -> bool {
    let kind = parser.current_kind();
    !(parser.at_statement_end()
        || precedence::infix_binding_power(kind).is_some()
        || kind.is_assignment_op()
        || matches!(
            kind,
            TokenKind::RightParen
                | TokenKind::RightBracket
                | TokenKind::RightBrace
                | TokenKind::Comma
                | TokenKind::Question
                | TokenKind::QuestionQuestion
                | TokenKind::Colon
                | TokenKind::FatArrow
                | TokenKind::As
                | TokenKind::LeftParen
                | TokenKind::LeftBracket
                | TokenKind::LeftBrace
                | TokenKind::Arrow
                | TokenKind::NullsafeArrow
                | TokenKind::DoubleColon
        ))
}

/// Try to parse a cast expression like `(int)$x`. Returns Some(Expr) if successful,
/// or None if this is not a cast (just a parenthesized expression).
fn try_parse_cast<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Option<Expr<'arena, 'src>> {
    let cast_kind = parser.cast_ahead()?;

    let start = parser.start_span();
    parser.reading_cast = true;
    parser.advance(); // consume (
    let kw_span = parser.current_span();
    parser.advance(); // consume the cast keyword
    parser.eat(TokenKind::RightParen)?;

    // Before 8.5 `(void)` is a parenthesized constant; it is read as a cast only when an
    // operand follows, so that the cast reports the version it needs.
    if cast_kind == CastKind::Void && parser.version < PhpVersion::Php85 && !operand_follows(parser)
    {
        let name = simple_name_expr(
            &parser.source[kw_span.start as usize..kw_span.end as usize],
            kw_span,
        );
        return Some(Expr {
            kind: ExprKind::Parenthesized(parser.alloc(name)),
            span: parser.span_from(start),
        });
    }

    if cast_kind == CastKind::Unset && parser.version >= PhpVersion::Php80 {
        parser.forbid(
            ForbiddenRule::UnsetCast,
            "The (unset) cast is no longer supported",
            kw_span,
        );
    }
    if cast_kind == CastKind::Void {
        parser.require_version(PhpVersion::Php85, "void cast", kw_span);
        // Record that a void cast exists so the expression-statement misuse
        // walk can be skipped for the (overwhelmingly common) void-cast-free case.
        parser.void_cast_count += 1;
    }
    // (real) was removed in PHP 8.0
    let kw_text = &parser.source[kw_span.start as usize..kw_span.end as usize];
    if kw_text.eq_ignore_ascii_case("real") && parser.version >= PhpVersion::Php80 {
        parser.forbid(
            ForbiddenRule::RealCast,
            "the (real) cast is no longer supported, use (float) instead",
            kw_span,
        );
    }

    // `(void)` is a statement prefix, not an operator: its operand is the whole expression.
    let operand_bp = if cast_kind == CastKind::Void {
        0
    } else {
        precedence::HIGH_PREFIX_BP
    };
    let mut operand = parse_expr_bp(parser, operand_bp);
    // PHP grammar quirk: assignment binds tighter than casts.
    if parser.current_kind().is_assignment_op() {
        operand = parse_assign_continuation(parser, operand);
    }
    let span = parser.span_to(start, operand.span);
    Some(Expr {
        kind: ExprKind::Cast(cast_kind, parser.alloc(operand)),
        span,
    })
}

/// Extract label and body from heredoc/nowdoc raw token text.
/// Input: `<<<LABEL\nbody\nLABEL` or `<<<'LABEL'\nbody\nLABEL`
/// Returns `(label, body, stripped)` where `stripped` is true if indentation was removed.
/// Returns `(label, body_start_in_text, body_end_in_text, indent)`.
/// `body_start_in_text` and `body_end_in_text` are byte offsets within `text` bounding
/// the verbatim heredoc content (with indentation intact, trailing newline stripped).
/// `indent` is empty for non-indented heredocs.
fn parse_heredoc_content(text: &str) -> (&str, usize, usize, String) {
    // Skip optional `b` binary prefix, then <<<
    let b_prefix = if text.starts_with('b') { 1 } else { 0 };
    let prefix_len = b_prefix + 3; // optional 'b' + "<<<".len()
    let after_prefix = &text[prefix_len..];
    let trim_len = after_prefix.len() - after_prefix.trim_start_matches([' ', '\t']).len();
    let after = &after_prefix[trim_len..];
    // `after` starts at offset `prefix_len + trim_len` within `text`
    let after_start = prefix_len + trim_len;

    // Extract label as a &'src str slice of `text`.
    let (label, label_consumed) = if let Some(stripped) = after.strip_prefix('\'') {
        let end = stripped.find('\'').unwrap_or(stripped.len());
        (&stripped[..end], 1 + end + 1)
    } else if let Some(stripped) = after.strip_prefix('"') {
        let end = stripped.find('"').unwrap_or(stripped.len());
        (&stripped[..end], 1 + end + 1)
    } else {
        let end = after
            .find(|c: char| !c.is_ascii_alphanumeric() && c != '_')
            .unwrap_or(after.len());
        (&after[..end], end)
    };

    let rest = &after[label_consumed..];
    let rest_start = after_start + label_consumed;

    // Skip past the newline that ends the label line
    let newline_pos = rest.find(['\n', '\r']).unwrap_or(rest.len());
    let newline_len = if rest[newline_pos..].starts_with("\r\n") {
        2
    } else {
        1
    };
    let body_start_in_text = rest_start + newline_pos + newline_len;
    let body = &text[body_start_in_text..];

    // The lexer ends the token at the closing label, so the last line is the end marker.
    let end_line_start = body.rfind(['\n', '\r']).map_or(0, |p| p + 1);
    let end_line = &body[end_line_start..];
    let indent_len = end_line.len() - end_line.trim_start_matches([' ', '\t']).len();
    let indent = end_line[..indent_len].to_string();

    // Content ends just before the end-marker line, with trailing \r\n stripped.
    let content = &body[..end_line_start];
    let content = content.strip_suffix('\n').unwrap_or(content);
    let content = content.strip_suffix('\r').unwrap_or(content);
    let body_end_in_text = body_start_in_text + content.len();

    (label, body_start_in_text, body_end_in_text, indent)
}

/// `raw_body` with up to `indent_len` spaces or tabs removed from the start of every line.
fn strip_heredoc_indent(raw_body: &str, indent_len: usize) -> String {
    let mut out = String::with_capacity(raw_body.len());
    let mut rest = raw_body;
    loop {
        rest = &rest[heredoc_indent_len(rest.as_bytes(), indent_len)..];
        let Some(p) = rest.find(['\n', '\r']) else {
            out.push_str(rest);
            return out;
        };
        let end = p + if rest[p..].starts_with("\r\n") { 2 } else { 1 };
        out.push_str(&rest[..end]);
        rest = &rest[end..];
    }
}

/// Validate that every body line of an indented heredoc (`interpolated`) or nowdoc starts with
/// `indent`, as PHP does.
/// Emits `ParseError::Forbidden` for each line that violates the indentation requirement.
#[allow(clippy::too_many_arguments)]
fn validate_heredoc_indentation(
    raw_body: &str,
    interpolated: bool,
    attributes: bool,
    indent: &str,
    indent_span: Span,
    body_offset: u32,
    errors: &mut Vec<ParseError>,
) {
    if indent.is_empty() {
        return;
    }
    if indent.contains(' ') && indent.contains('\t') {
        errors.push(ParseError::Forbidden {
            rule: ForbiddenRule::MixedHeredocIndentation,
            message: "Invalid indentation - tabs and spaces cannot be mixed".into(),
            span: indent_span,
        });
        return;
    }
    let check_line = |start: usize, end: usize, errors: &mut Vec<ParseError>| {
        let line = &raw_body[start..end];
        let span = Span::new(body_offset + start as u32, body_offset + end as u32);
        let leading = heredoc_indent_len(line.as_bytes(), indent.len());
        if line[..leading].bytes().any(|b| b != indent.as_bytes()[0]) {
            errors.push(ParseError::Forbidden {
                rule: ForbiddenRule::MixedHeredocIndentation,
                message: "Invalid indentation - tabs and spaces cannot be mixed".into(),
                span,
            });
        } else if leading < indent.len() && leading < line.len() {
            // A whitespace-only line may be shorter than the indentation.
            errors.push(ParseError::Forbidden {
                rule: ForbiddenRule::HeredocBodyIndentation,
                message: "Invalid body indentation level".into(),
                span,
            });
        }
    };
    // `\r\n` yields an extra empty line, which needs no indentation. A line break inside an
    // interpolation does not start a body line.
    let bytes = raw_body.as_bytes();
    let mut line_start = 0;
    let mut i = 0;
    while i < bytes.len() {
        i = match bytes[i] {
            b'\n' | b'\r' => {
                check_line(line_start, i, errors);
                line_start = i + 1;
                i + 1
            }
            b'\\' if interpolated && !matches!(bytes.get(i + 1), Some(b'\n' | b'\r')) => i + 2,
            b'{' if interpolated && bytes.get(i + 1) == Some(&b'$') => {
                interpolation_end(bytes, i, attributes).unwrap_or(bytes.len())
            }
            b'$' if interpolated && bytes.get(i + 1) == Some(&b'{') => {
                interpolation_end(bytes, i + 1, attributes).unwrap_or(bytes.len())
            }
            _ => i + 1,
        }
        .min(bytes.len());
    }
    check_line(line_start, bytes.len(), errors);
}

/// Parse an integer literal from raw bytes, skipping underscores, without heap allocation.
/// Returns `None` on overflow so the caller can promote the value to float (PHP semantics).
/// `base` is 2, 8, 10, or 16.
fn parse_int_no_alloc(bytes: &[u8], base: i64) -> Option<i64> {
    let mut value: i64 = 0;
    for &b in bytes {
        if b == b'_' {
            continue;
        }
        let digit = match base {
            16 => match b {
                b'0'..=b'9' => (b - b'0') as i64,
                b'a'..=b'f' => (b - b'a') as i64 + 10,
                b'A'..=b'F' => (b - b'A') as i64 + 10,
                _ => continue,
            },
            2 => match b {
                b'0'..=b'1' => (b - b'0') as i64,
                _ => continue,
            },
            8 => match b {
                b'0'..=b'7' => (b - b'0') as i64,
                _ => continue,
            },
            _ => match b {
                b'0'..=b'9' => (b - b'0') as i64,
                _ => continue,
            },
        };
        value = value.checked_mul(base).and_then(|v| v.checked_add(digit))?;
    }
    Some(value)
}

/// Evaluate an integer literal (hex/bin/oct) as `f64`, skipping underscores.
/// Used when `parse_int_no_alloc` overflows — matches PHP's float-promotion behaviour.
fn parse_int_as_float(bytes: &[u8], base: f64) -> f64 {
    let mut value: f64 = 0.0;
    for &b in bytes {
        if b == b'_' {
            continue;
        }
        let digit: f64 = match base as u32 {
            16 => match b {
                b'0'..=b'9' => (b - b'0') as f64,
                b'a'..=b'f' => (b - b'a') as f64 + 10.0,
                b'A'..=b'F' => (b - b'A') as f64 + 10.0,
                _ => continue,
            },
            2 => match b {
                b'0'..=b'1' => (b - b'0') as f64,
                _ => continue,
            },
            _ => match b {
                // base 8
                b'0'..=b'7' => (b - b'0') as f64,
                _ => continue,
            },
        };
        value = value * base + digit;
    }
    value
}

/// Parse a float literal, skipping underscores, using a fixed-size stack buffer
/// unless the literal does not fit in it.
pub(super) fn parse_float_no_alloc(text: &str) -> f64 {
    let mut buf = [0u8; 256];
    if text.len() > buf.len() {
        return text.replace('_', "").parse().unwrap_or(0.0);
    }
    let mut len = 0;
    for &b in text.as_bytes() {
        if b != b'_' {
            buf[len] = b;
            len += 1;
        }
    }
    std::str::from_utf8(&buf[..len])
        .ok()
        .and_then(|s| s.parse::<f64>().ok())
        .unwrap_or(0.0)
}

fn name_expr<'arena, 'src>(name: Name<'arena, 'src>) -> Expr<'arena, 'src> {
    let span = name.span();
    let kind = match name {
        Name::Error { .. } => ExprKind::Error,
        name => ExprKind::Name(name),
    };
    Expr { kind, span }
}

pub(super) fn simple_name_expr<'arena, 'src>(value: &'src str, span: Span) -> Expr<'arena, 'src> {
    Expr {
        kind: ExprKind::Name(Name::Simple { value, span }),
        span,
    }
}

/// Interpolated expressions are parsed by a sub-parser whose flags are dropped, so look for
/// the keywords in the string body instead.
fn note_interpolated_class_refs(parser: &mut Parser<'_, '_>, body: &str) {
    if parser.has_class_keyword_ref {
        return;
    }
    parser.has_class_keyword_ref = ["self", "parent", "static"].into_iter().any(|kw| {
        body.as_bytes()
            .windows(kw.len())
            .any(|w| w.eq_ignore_ascii_case(kw.as_bytes()))
    });
}
