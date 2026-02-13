use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::ParseError;
use crate::parser::Parser;
use crate::precedence::{self, ASSIGNMENT_BP, TERNARY_BP};
use crate::stmt;

/// Cast keyword strings and their CastKind values
const CAST_KEYWORDS: &[(&str, CastKind)] = &[
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

/// Parse an expression.
pub fn parse_expr(parser: &mut Parser) -> Expr {
    parse_expr_bp(parser, 0)
}

/// Pratt expression parser. Parses expressions with binding power >= min_bp.
pub fn parse_expr_bp(parser: &mut Parser, min_bp: u8) -> Expr {
    let mut lhs = parse_atom(parser);

    loop {
        let kind = parser.current_kind();

        // Check for postfix operators first (++, --)
        if let Some(left_bp) = precedence::postfix_binding_power(&kind) {
            if left_bp < min_bp {
                break;
            }
            let op_token = parser.advance();
            let op = match op_token.kind {
                TokenKind::PlusPlus => UnaryPostfixOp::PostIncrement,
                TokenKind::MinusMinus => UnaryPostfixOp::PostDecrement,
                _ => unreachable!(),
            };
            let span = lhs.span.merge(op_token.span);
            lhs = Expr {
                kind: ExprKind::UnaryPostfix(UnaryPostfixExpr {
                    operand: Box::new(lhs),
                    op,
                }),
                span,
            };
            continue;
        }

        // Assignment operators (right-associative, special handling)
        if kind.is_assignment_op() {
            if ASSIGNMENT_BP < min_bp {
                break;
            }
            let op_token = parser.advance();

            // Handle =& (by-ref assign): treat as regular Assign for now
            if op_token.kind == TokenKind::Equals && parser.check(TokenKind::Ampersand) {
                parser.advance(); // consume &
            }

            let op = match op_token.kind {
                TokenKind::Equals => AssignOp::Assign,
                TokenKind::PlusEquals => AssignOp::Plus,
                TokenKind::MinusEquals => AssignOp::Minus,
                TokenKind::StarEquals => AssignOp::Mul,
                TokenKind::SlashEquals => AssignOp::Div,
                TokenKind::PercentEquals => AssignOp::Mod,
                TokenKind::StarStarEquals => AssignOp::Pow,
                TokenKind::DotEquals => AssignOp::Concat,
                TokenKind::AmpersandEquals => AssignOp::BitwiseAnd,
                TokenKind::PipeEquals => AssignOp::BitwiseOr,
                TokenKind::CaretEquals => AssignOp::BitwiseXor,
                TokenKind::ShiftLeftEquals => AssignOp::ShiftLeft,
                TokenKind::ShiftRightEquals => AssignOp::ShiftRight,
                TokenKind::CoalesceEquals => AssignOp::Coalesce,
                _ => unreachable!(),
            };
            // Right-associative: parse RHS with same bp
            let rhs = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = lhs.span.merge(rhs.span);
            lhs = Expr {
                kind: ExprKind::Assign(AssignExpr {
                    target: Box::new(lhs),
                    op,
                    value: Box::new(rhs),
                }),
                span,
            };
            continue;
        }

        // Ternary operator (right-associative, special handling)
        if kind == TokenKind::Question {
            if TERNARY_BP < min_bp {
                break;
            }
            parser.advance(); // consume ?

            // Short ternary: `$x ?: $y`
            let then_expr = if parser.check(TokenKind::Colon) {
                None
            } else {
                Some(Box::new(parse_expr_bp(parser, 0)))
            };

            parser.expect(TokenKind::Colon);
            // Ternary is LEFT-associative in PHP, so use TERNARY_BP + 1
            let else_expr = parse_expr_bp(parser, TERNARY_BP + 1);
            let span = lhs.span.merge(else_expr.span);
            lhs = Expr {
                kind: ExprKind::Ternary(TernaryExpr {
                    condition: Box::new(lhs),
                    then_expr,
                    else_expr: Box::new(else_expr),
                }),
                span,
            };
            continue;
        }

        // Arrow operator: $obj->prop or $obj->method()
        if kind == TokenKind::Arrow || kind == TokenKind::NullsafeArrow {
            if 44u8 < min_bp {
                break;
            }
            let is_nullsafe = kind == TokenKind::NullsafeArrow;
            parser.advance(); // consume -> or ?->

            // Parse member name (identifier or keyword or variable for dynamic)
            let member = parse_member_name(parser);

            // Check if it's a method call
            if parser.check(TokenKind::LeftParen) {
                match parse_arg_list_or_callable(parser) {
                    ArgListResult::CallableMarker => {
                        let span = Span::new(lhs.span.start, parser.current_span().start);
                        let callable_kind = if is_nullsafe {
                            CallableCreateKind::NullsafeMethod {
                                object: Box::new(lhs),
                                method: Box::new(member),
                            }
                        } else {
                            CallableCreateKind::Method {
                                object: Box::new(lhs),
                                method: Box::new(member),
                            }
                        };
                        lhs = Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr { kind: callable_kind }),
                            span,
                        };
                    }
                    ArgListResult::Args(args) => {
                        let span = Span::new(lhs.span.start, parser.current_span().start);
                        let expr_kind = if is_nullsafe {
                            ExprKind::NullsafeMethodCall(MethodCallExpr {
                                object: Box::new(lhs),
                                method: Box::new(member),
                                args,
                            })
                        } else {
                            ExprKind::MethodCall(MethodCallExpr {
                                object: Box::new(lhs),
                                method: Box::new(member),
                                args,
                            })
                        };
                        lhs = Expr { kind: expr_kind, span };
                    }
                }
            } else {
                let span = Span::new(lhs.span.start, member.span.end);
                let expr_kind = if is_nullsafe {
                    ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                        object: Box::new(lhs),
                        property: Box::new(member),
                    })
                } else {
                    ExprKind::PropertyAccess(PropertyAccessExpr {
                        object: Box::new(lhs),
                        property: Box::new(member),
                    })
                };
                lhs = Expr { kind: expr_kind, span };
            }
            continue;
        }

        // Double colon: Class::$prop, Class::method(), Class::CONST
        if kind == TokenKind::DoubleColon {
            if 44u8 < min_bp {
                break;
            }
            parser.advance(); // consume ::

            // Check what follows ::
            if parser.check(TokenKind::Variable) {
                // Static property: Class::$prop
                let token = parser.advance();
                let text = &parser.source()[token.span.start as usize..token.span.end as usize];
                let member = text[1..].to_string();
                let span = Span::new(lhs.span.start, token.span.end);
                lhs = Expr {
                    kind: ExprKind::StaticPropertyAccess(StaticAccessExpr {
                        class: Box::new(lhs),
                        member,
                    }),
                    span,
                };
            } else if parser.check(TokenKind::Dollar) {
                // Dynamic static property: A::$$b, A::${'b'}
                let member = parse_atom(parser);
                let span = Span::new(lhs.span.start, member.span.end);
                lhs = Expr {
                    kind: ExprKind::StaticPropertyAccessDynamic {
                        class: Box::new(lhs),
                        member: Box::new(member),
                    },
                    span,
                };
            } else if parser.check(TokenKind::LeftBrace) {
                // Dynamic class constant/method: A::{'b'}(), Foo::{bar()}
                parser.advance(); // consume {
                let member = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                if parser.check(TokenKind::LeftParen) {
                    // Dynamic static method call: A::{'b'}()
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: Box::new(lhs),
                                        method: format!("{{{}}}", "dynamic"),
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let callee = Expr {
                                kind: ExprKind::ClassConstAccessDynamic {
                                    class: Box::new(lhs),
                                    member: Box::new(member),
                                },
                                span: Span::new(0, 0), // placeholder, will be wrapped
                            };
                            let span = Span::new(callee.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::FunctionCall(FunctionCallExpr {
                                    name: Box::new(callee),
                                    args,
                                }),
                                span,
                            };
                        }
                    }
                } else {
                    // Dynamic class constant: Foo::{bar()}
                    let span = Span::new(lhs.span.start, parser.current_span().start);
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccessDynamic {
                            class: Box::new(lhs),
                            member: Box::new(member),
                        },
                        span,
                    };
                }
            } else if parser.check(TokenKind::Class) {
                // Special: Class::class (class name resolution)
                let token = parser.advance();
                let span = Span::new(lhs.span.start, token.span.end);
                lhs = Expr {
                    kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                        class: Box::new(lhs),
                        member: "class".to_string(),
                    }),
                    span,
                };
            } else {
                // Static method call or class constant
                let (member_name, _member_span) = if let Some(result) = parser.eat_identifier_or_keyword() {
                    result
                } else {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "identifier".to_string(),
                        found: parser.current_kind(),
                        span,
                    });
                    ("<error>".to_string(), span)
                };

                if parser.check(TokenKind::LeftParen) {
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: Box::new(lhs),
                                        method: member_name,
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = Span::new(lhs.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCall(StaticMethodCallExpr {
                                    class: Box::new(lhs),
                                    method: member_name,
                                    args,
                                }),
                                span,
                            };
                        }
                    }
                } else {
                    // Class constant
                    let span = Span::new(lhs.span.start, parser.current_span().start);
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                            class: Box::new(lhs),
                            member: member_name,
                        }),
                        span,
                    };
                }
            }
            continue;
        }

        // Array access: $arr[index]
        if kind == TokenKind::LeftBracket {
            if 44u8 < min_bp {
                break;
            }
            parser.advance(); // consume [
            let index = if parser.check(TokenKind::RightBracket) {
                None
            } else {
                Some(Box::new(parse_expr(parser)))
            };
            parser.expect(TokenKind::RightBracket);
            let span = Span::new(lhs.span.start, parser.current_span().start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: Box::new(lhs),
                    index,
                }),
                span,
            };
            continue;
        }

        // Curly brace array/string access: $a{'b'} (deprecated PHP 7.x syntax)
        if kind == TokenKind::LeftBrace {
            if 44u8 < min_bp {
                break;
            }
            parser.advance(); // consume {
            let index = if parser.check(TokenKind::RightBrace) {
                None
            } else {
                Some(Box::new(parse_expr(parser)))
            };
            parser.expect(TokenKind::RightBrace);
            let span = Span::new(lhs.span.start, parser.current_span().start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: Box::new(lhs),
                    index,
                }),
                span,
            };
            continue;
        }

        // Function call: name(args)
        if kind == TokenKind::LeftParen {
            if 44u8 < min_bp {
                break;
            }
            lhs = parse_function_call(parser, lhs);
            continue;
        }

        // Null coalescing operator (produces NullCoalesce node, not Binary)
        if kind == TokenKind::QuestionQuestion {
            if let Some((left_bp, right_bp)) = precedence::infix_binding_power(&kind) {
                if left_bp < min_bp {
                    break;
                }
                parser.advance();
                let rhs = parse_expr_bp(parser, right_bp);
                let span = lhs.span.merge(rhs.span);
                lhs = Expr {
                    kind: ExprKind::NullCoalesce(NullCoalesceExpr {
                        left: Box::new(lhs),
                        right: Box::new(rhs),
                    }),
                    span,
                };
                continue;
            }
        }

        // Infix binary operators
        if let Some((left_bp, right_bp)) = precedence::infix_binding_power(&kind) {
            if left_bp < min_bp {
                break;
            }
            let op_token = parser.advance();
            let op = token_to_binary_op(op_token.kind);
            let rhs = parse_expr_bp(parser, right_bp);
            let span = lhs.span.merge(rhs.span);
            lhs = Expr {
                kind: ExprKind::Binary(BinaryExpr {
                    left: Box::new(lhs),
                    op,
                    right: Box::new(rhs),
                }),
                span,
            };
            continue;
        }

        // Not an operator we handle — stop
        break;
    }

    lhs
}

/// Parse a member name after -> or ?->. Accepts identifiers and semi-reserved keywords.
fn parse_member_name(parser: &mut Parser) -> Expr {
    if parser.check(TokenKind::Variable) {
        // Dynamic property: $obj->{$var} or $obj->$var
        let token = parser.advance();
        let text = &parser.source()[token.span.start as usize..token.span.end as usize];
        let name = text[1..].to_string();
        return Expr {
            kind: ExprKind::Variable(name),
            span: token.span,
        };
    }
    if parser.check(TokenKind::LeftBrace) {
        // Dynamic member: $obj->{expr}
        parser.advance();
        let inner = parse_expr(parser);
        parser.expect(TokenKind::RightBrace);
        return inner;
    }
    if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        return Expr {
            kind: ExprKind::Identifier(text),
            span,
        };
    }
    // Error
    let span = parser.current_span();
    parser.error(ParseError::Expected {
        expected: "member name".to_string(),
        found: parser.current_kind(),
        span,
    });
    Expr { kind: ExprKind::Error, span }
}

/// Parse an atomic expression (prefix unaries, literals, variables, etc.)
fn parse_atom(parser: &mut Parser) -> Expr {
    let kind = parser.current_kind();

    // Keywords followed by backslash are namespace-qualified names (e.g., fn\use(), private\protected\...)
    // Exclude keywords that have their own parse_atom handlers and can precede `\ClassName` expressions
    if parser.is_semi_reserved_keyword()
        && !matches!(kind, TokenKind::New | TokenKind::Throw | TokenKind::Yield_ | TokenKind::Instanceof)
        && parser.peek_kind() == Some(TokenKind::Backslash)
    {
        let token = parser.advance();
        let text = &parser.source()[token.span.start as usize..token.span.end as usize];
        let mut parts = vec![text.to_string()];
        while parser.eat(TokenKind::Backslash).is_some() {
            if let Some((part, _)) = parser.eat_identifier_or_keyword() {
                parts.push(part);
            }
        }
        let span = Span::new(token.span.start, parser.current_span().start);
        return Expr {
            kind: ExprKind::Identifier(parts.join("\\")),
            span,
        };
    }

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
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "'function' or 'fn'".to_string(),
                found: parser.current_kind(),
                span,
            });
            return Expr { kind: ExprKind::Error, span: Span::new(start, span.end) };
        }
        if parser.check(TokenKind::Function) {
            return parse_closure(parser, false, start, attributes);
        }
        if parser.check(TokenKind::Fn_) {
            return parse_arrow_function(parser, false, start, attributes);
        }
        // Error: attributes in expression context without closure/arrow function
        let span = parser.current_span();
        parser.error(ParseError::Expected {
            expected: "'function', 'fn', or 'static'".to_string(),
            found: parser.current_kind(),
            span,
        });
        return Expr { kind: ExprKind::Error, span: Span::new(start, span.end) };
    }

    // @ error suppression (prefix, high precedence)
    if kind == TokenKind::At {
        let token = parser.advance();
        let operand = parse_expr_bp(parser, 41); // same as other prefix unary
        let span = token.span.merge(operand.span);
        return Expr {
            kind: ExprKind::ErrorSuppress(Box::new(operand)),
            span,
        };
    }

    // Prefix unary operators
    if let Some(right_bp) = precedence::prefix_binding_power(&kind) {
        let op_token = parser.advance();
        let operand = parse_expr_bp(parser, right_bp);
        let op = match op_token.kind {
            TokenKind::Minus => UnaryPrefixOp::Negate,
            TokenKind::Plus => UnaryPrefixOp::Plus,
            TokenKind::Bang => UnaryPrefixOp::BooleanNot,
            TokenKind::Tilde => UnaryPrefixOp::BitwiseNot,
            TokenKind::PlusPlus => UnaryPrefixOp::PreIncrement,
            TokenKind::MinusMinus => UnaryPrefixOp::PreDecrement,
            _ => unreachable!(),
        };
        let span = op_token.span.merge(operand.span);
        return Expr {
            kind: ExprKind::UnaryPrefix(UnaryPrefixExpr {
                op,
                operand: Box::new(operand),
            }),
            span,
        };
    }

    match kind {
        // Integer literals
        TokenKind::IntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let clean: String = text.chars().filter(|c| *c != '_').collect();
            let value = clean.parse::<i64>().unwrap_or(0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::HexIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let clean: String = text[2..].chars().filter(|c| *c != '_').collect();
            let value = i64::from_str_radix(&clean, 16).unwrap_or(0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::BinIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let clean: String = text[2..].chars().filter(|c| *c != '_').collect();
            let value = i64::from_str_radix(&clean, 2).unwrap_or(0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::OctIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = i64::from_str_radix(&text[1..], 8).unwrap_or(0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::OctIntLiteralNew => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let clean: String = text[2..].chars().filter(|c| *c != '_').collect();
            let value = i64::from_str_radix(&clean, 8).unwrap_or(0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }

        // Float literals
        TokenKind::FloatLiteral | TokenKind::FloatLiteralSimple | TokenKind::FloatLiteralLeadingDot => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let clean: String = text.chars().filter(|c| *c != '_').collect();
            let value = clean.parse::<f64>().unwrap_or(0.0);
            Expr {
                kind: ExprKind::Float(value),
                span: token.span,
            }
        }

        // String literals
        TokenKind::SingleQuotedString => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let text = text.strip_prefix('b').or_else(|| text.strip_prefix('B')).unwrap_or(text);
            let inner = &text[1..text.len() - 1];
            Expr {
                kind: ExprKind::String(inner.to_string()),
                span: token.span,
            }
        }
        TokenKind::DoubleQuotedString => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let stripped = text.strip_prefix('b').or_else(|| text.strip_prefix('B')).unwrap_or(text);
            let inner = &stripped[1..stripped.len() - 1];

            if crate::interpolation::has_interpolation(inner) {
                // Offset of first char of inner content in source
                let inner_offset = token.span.end - 1 - inner.len() as u32;
                let parts = crate::interpolation::parse_interpolated_parts(inner, inner_offset);
                Expr {
                    kind: ExprKind::InterpolatedString(parts),
                    span: token.span,
                }
            } else {
                // No interpolation — keep raw content like before
                Expr {
                    kind: ExprKind::String(inner.to_string()),
                    span: token.span,
                }
            }
        }

        // Backtick string (shell execution)
        TokenKind::BacktickString => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let inner = &text[1..text.len() - 1]; // strip backticks

            if crate::interpolation::has_interpolation(inner) {
                let inner_offset = token.span.start + 1;
                let parts = crate::interpolation::parse_interpolated_parts(inner, inner_offset);
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            } else {
                let parts = vec![StringPart::Literal(inner.to_string())];
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            }
        }

        // Heredoc
        TokenKind::Heredoc => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let (label, body) = parse_heredoc_content(text);
            if crate::interpolation::has_interpolation(&body) {
                let body_offset = find_body_offset(text, token.span.start);
                let parts = crate::interpolation::parse_interpolated_parts(&body, body_offset);
                Expr {
                    kind: ExprKind::Heredoc { label, parts },
                    span: token.span,
                }
            } else {
                let parts = vec![StringPart::Literal(body)];
                Expr {
                    kind: ExprKind::Heredoc { label, parts },
                    span: token.span,
                }
            }
        }

        // Nowdoc
        TokenKind::Nowdoc => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let (label, body) = parse_heredoc_content(text);
            Expr {
                kind: ExprKind::Nowdoc { label, value: body },
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
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            // Strip the $ prefix
            let name = text[1..].to_string();
            Expr {
                kind: ExprKind::Variable(name),
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
                parse_atom(parser)
            };
            let span = Span::new(token.span.start, inner.span.end);
            Expr {
                kind: ExprKind::VariableVariable(Box::new(inner)),
                span,
            }
        }

        // Identifiers (function names, class names, etc.)
        // Also handles qualified names: App\Models\User
        TokenKind::Identifier => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];

            // Check if this is a qualified name: Foo\Bar\Baz
            if parser.check(TokenKind::Backslash) {
                let mut parts = vec![text.to_string()];
                while parser.eat(TokenKind::Backslash).is_some() {
                    if let Some((part, _)) = parser.eat_identifier_or_keyword() {
                        parts.push(part);
                    }
                }
                let span = Span::new(token.span.start, parser.current_span().start);
                Expr {
                    kind: ExprKind::Identifier(parts.join("\\")),
                    span,
                }
            } else {
                Expr {
                    kind: ExprKind::Identifier(text.to_string()),
                    span: token.span,
                }
            }
        }

        // Backslash — fully qualified name: \Foo\Bar
        TokenKind::Backslash => {
            let start = parser.start_span();
            let name = parser.parse_name();
            let text = name.parts.join("\\");
            let prefix = if name.kind == NameKind::FullyQualified { "\\" } else { "" };
            Expr {
                kind: ExprKind::Identifier(format!("{}{}", prefix, text)),
                span: Span::new(start, name.span.end),
            }
        }

        // self, parent, static — used as class names (e.g. self::method())
        TokenKind::Self_ => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier("self".to_string()),
                span: token.span,
            }
        }
        TokenKind::Parent_ => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier("parent".to_string()),
                span: token.span,
            }
        }
        TokenKind::Static => {
            let token = parser.advance();
            // Check if this is `static function` (static closure)
            if parser.check(TokenKind::Function) {
                return parse_closure(parser, true, token.span.start, Vec::new());
            }
            // Check if `static fn` (static arrow function)
            if parser.check(TokenKind::Fn_) {
                return parse_arrow_function(parser, true, token.span.start, Vec::new());
            }
            Expr {
                kind: ExprKind::Identifier("static".to_string()),
                span: token.span,
            }
        }

        // Print expression
        TokenKind::Print => {
            let token = parser.advance();
            let expr = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(expr.span);
            Expr {
                kind: ExprKind::Print(Box::new(expr)),
                span,
            }
        }

        // New expression: new ClassName(args)
        TokenKind::New => {
            parse_new_expr(parser)
        }

        // Function keyword — closure expression (when used as expression)
        TokenKind::Function => {
            let start = parser.start_span();
            return parse_closure(parser, false, start, Vec::new());
        }

        // Fn keyword — arrow function: fn($x) => expr
        TokenKind::Fn_ => {
            let start = parser.start_span();
            parse_arrow_function(parser, false, start, Vec::new())
        }

        // Match expression
        TokenKind::Match_ => {
            parse_match_expr(parser)
        }

        // Throw as expression (PHP 8)
        TokenKind::Throw => {
            let token = parser.advance();
            let expr = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(expr.span);
            Expr {
                kind: ExprKind::ThrowExpr(Box::new(expr)),
                span,
            }
        }

        // Yield expression
        TokenKind::Yield_ => {
            parse_yield_expr(parser)
        }

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
            let span = Span::new(start, parser.current_span().start);
            Expr {
                kind: ExprKind::Parenthesized(Box::new(inner)),
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
            let mut exprs = Vec::new();
            exprs.push(parse_expr(parser));
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::RightParen) { break; }
                exprs.push(parse_expr(parser));
            }
            let close = parser.expect(TokenKind::RightParen);
            let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
            Expr { kind: ExprKind::Isset(exprs), span: Span::new(start, end) }
        }

        // empty(expr)
        TokenKind::Empty => {
            let start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let inner = parse_expr(parser);
            let close = parser.expect(TokenKind::RightParen);
            let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
            Expr { kind: ExprKind::Empty(Box::new(inner)), span: Span::new(start, end) }
        }

        // eval('code')
        TokenKind::Eval => {
            let start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let inner = parse_expr(parser);
            let close = parser.expect(TokenKind::RightParen);
            let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
            Expr { kind: ExprKind::Eval(Box::new(inner)), span: Span::new(start, end) }
        }

        // include / include_once / require / require_once
        TokenKind::Include => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr { kind: ExprKind::Include(IncludeKind::Include, Box::new(inner)), span }
        }
        TokenKind::IncludeOnce => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr { kind: ExprKind::Include(IncludeKind::IncludeOnce, Box::new(inner)), span }
        }
        TokenKind::Require => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr { kind: ExprKind::Include(IncludeKind::Require, Box::new(inner)), span }
        }
        TokenKind::RequireOnce => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr { kind: ExprKind::Include(IncludeKind::RequireOnce, Box::new(inner)), span }
        }

        // exit / die
        TokenKind::Exit | TokenKind::Die => {
            let token = parser.advance();
            let name_text = parser.source()[token.span.start as usize..token.span.end as usize].to_string();
            if parser.check(TokenKind::LeftParen) {
                match parse_arg_list_or_callable(parser) {
                    ArgListResult::CallableMarker => {
                        // exit(...) - first class callable
                        let callee = Expr { kind: ExprKind::Identifier(name_text), span: token.span };
                        let span = Span::new(token.span.start, parser.current_span().start);
                        Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr {
                                kind: CallableCreateKind::Function(Box::new(callee)),
                            }),
                            span,
                        }
                    }
                    ArgListResult::Args(args) => {
                        let span = Span::new(token.span.start, parser.current_span().start);
                        if args.is_empty() {
                            // exit()
                            Expr { kind: ExprKind::Exit(None), span }
                        } else if args.len() == 1 && args[0].name.is_none() && !args[0].unpack {
                            // exit(expr)
                            let value = args.into_iter().next().unwrap().value;
                            Expr { kind: ExprKind::Exit(Some(Box::new(value))), span }
                        } else {
                            // exit(status: 42), exit(...$args), exit($a, $b) - function call form
                            let callee = Expr { kind: ExprKind::Identifier(name_text), span: token.span };
                            Expr {
                                kind: ExprKind::FunctionCall(FunctionCallExpr {
                                    name: Box::new(callee),
                                    args,
                                }),
                                span,
                            }
                        }
                    }
                }
            } else {
                // bare exit/die
                Expr { kind: ExprKind::Exit(None), span: token.span }
            }
        }

        // clone — unary prefix or function call (PHP 8.4)
        TokenKind::Clone => {
            let token = parser.advance();
            if parser.check(TokenKind::LeftParen) {
                // PHP 8.4: clone() function call syntax
                let callee = Expr {
                    kind: ExprKind::Identifier("clone".to_string()),
                    span: token.span,
                };
                parse_function_call(parser, callee)
            } else {
                let operand = parse_expr_bp(parser, 41);
                let span = token.span.merge(operand.span);
                Expr { kind: ExprKind::Clone(Box::new(operand)), span }
            }
        }

        // Magic constants
        TokenKind::MagicClass => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Class), span: t.span } }
        TokenKind::MagicDir => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Dir), span: t.span } }
        TokenKind::MagicFile => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::File), span: t.span } }
        TokenKind::MagicFunction => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Function), span: t.span } }
        TokenKind::MagicLine => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Line), span: t.span } }
        TokenKind::MagicMethod => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Method), span: t.span } }
        TokenKind::MagicNamespace => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Namespace), span: t.span } }
        TokenKind::MagicTrait => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Trait), span: t.span } }
        TokenKind::MagicProperty => { let t = parser.advance(); Expr { kind: ExprKind::MagicConst(MagicConstKind::Property), span: t.span } }

        // namespace\Foo\Bar — relative name in expression context
        TokenKind::Namespace => {
            if parser.peek_kind() == Some(TokenKind::Backslash) {
                let start = parser.start_span();
                let name = parser.parse_name();
                let text = format!("namespace\\{}", name.parts.join("\\"));
                Expr {
                    kind: ExprKind::Identifier(text),
                    span: Span::new(start, name.span.end),
                }
            } else {
                let span = parser.current_span();
                parser.error(ParseError::ExpectedExpression { span });
                Expr { kind: ExprKind::Error, span }
            }
        }

        // readonly used as identifier (function name, etc.)
        TokenKind::Readonly => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier("readonly".to_string()),
                span: token.span,
            }
        }

        // Error: unexpected token
        _ => {
            let span = parser.current_span();
            parser.error(ParseError::ExpectedExpression { span });
            Expr {
                kind: ExprKind::Error,
                span,
            }
        }
    }
}

// =============================================================================
// New expression: new ClassName(args)
// =============================================================================

fn parse_new_expr(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume 'new'

    // Anonymous class: new class(...) or new readonly class(...)
    let anon_readonly = parser.check(TokenKind::Readonly) && parser.peek_kind() == Some(TokenKind::Class);
    if parser.check(TokenKind::Class) || anon_readonly {
        if anon_readonly {
            parser.advance(); // consume 'readonly'
        }
        parser.advance(); // consume 'class'

        // Optional constructor args (before extends/implements)
        let args = if parser.check(TokenKind::LeftParen) {
            parse_arg_list(parser)
        } else {
            Vec::new()
        };

        let extends = if parser.eat(TokenKind::Extends).is_some() {
            Some(parser.parse_name())
        } else {
            None
        };

        let implements = if parser.eat(TokenKind::Implements).is_some() {
            stmt::parse_name_list(parser)
        } else {
            Vec::new()
        };

        parser.expect(TokenKind::LeftBrace);
        let members = stmt::parse_class_members(parser);
        let close = parser.expect(TokenKind::RightBrace);
        let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

        let class_decl = ClassDecl {
            name: None,
            modifiers: ClassModifiers { is_readonly: anon_readonly, ..Default::default() },
            extends,
            implements,
            members,
            attributes: Vec::new(),
        };

        let anon_class_expr = Expr {
            kind: ExprKind::AnonymousClass(class_decl),
            span: Span::new(start, end),
        };

        return Expr {
            kind: ExprKind::New(NewExpr {
                class: Box::new(anon_class_expr),
                args,
            }),
            span: Span::new(start, end),
        };
    }

    // Parse the class name — can be an identifier, self, parent, static, qualified name, or parenthesized expr
    let class = match parser.current_kind() {
        TokenKind::Self_ => {
            let t = parser.advance();
            Expr { kind: ExprKind::Identifier("self".to_string()), span: t.span }
        }
        TokenKind::Parent_ => {
            let t = parser.advance();
            Expr { kind: ExprKind::Identifier("parent".to_string()), span: t.span }
        }
        TokenKind::Static => {
            let t = parser.advance();
            Expr { kind: ExprKind::Identifier("static".to_string()), span: t.span }
        }
        TokenKind::Variable => {
            // new $className()
            let t = parser.advance();
            let text = &parser.source()[t.span.start as usize..t.span.end as usize];
            Expr { kind: ExprKind::Variable(text[1..].to_string()), span: t.span }
        }
        TokenKind::LeftParen => {
            // new (expr)() - dynamic class name from expression (PHP 8.1+)
            let paren_start = parser.start_span();
            let open = parser.advance(); // consume (
            let inner = parse_expr(parser);
            parser.expect_closing(TokenKind::RightParen, open.span);
            let paren_span = Span::new(paren_start, parser.current_span().start);
            Expr {
                kind: ExprKind::Parenthesized(Box::new(inner)),
                span: paren_span,
            }
        }
        _ => {
            // Parse as a name (possibly qualified)
            let name = parser.parse_name();
            let text = if name.kind == NameKind::FullyQualified {
                format!("\\{}", name.parts.join("\\"))
            } else {
                name.parts.join("\\")
            };
            Expr { kind: ExprKind::Identifier(text), span: name.span }
        }
    };

    // Optional argument list
    let args = if parser.check(TokenKind::LeftParen) {
        parse_arg_list(parser)
    } else {
        Vec::new()
    };

    let span = Span::new(start, parser.current_span().start);
    Expr {
        kind: ExprKind::New(NewExpr {
            class: Box::new(class),
            args,
        }),
        span,
    }
}

// =============================================================================
// Closure expression: function($x) use($y) { }
// =============================================================================

fn parse_closure(parser: &mut Parser, is_static: bool, start: u32, attributes: Vec<Attribute>) -> Expr {
    if !is_static {
        parser.advance(); // consume 'function'
    } else {
        parser.advance(); // consume 'function' (static was already consumed)
    }

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();

    parser.expect(TokenKind::LeftParen);
    let params = stmt::parse_param_list(parser);
    parser.expect(TokenKind::RightParen);

    // use clause
    let use_vars = if parser.eat(TokenKind::Use).is_some() {
        parser.expect(TokenKind::LeftParen);
        let vars = parse_closure_use_list(parser);
        parser.expect(TokenKind::RightParen);
        vars
    } else {
        Vec::new()
    };

    // return type
    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    // body
    parser.expect(TokenKind::LeftBrace);
    let mut body = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        body.push(stmt::parse_stmt(parser));
    }
    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

    Expr {
        kind: ExprKind::Closure(ClosureExpr {
            is_static,
            by_ref,
            params,
            use_vars,
            return_type,
            body,
            attributes,
        }),
        span: Span::new(start, end),
    }
}

fn parse_closure_use_list(parser: &mut Parser) -> Vec<ClosureUseVar> {
    let mut vars = Vec::new();
    loop {
        if parser.check(TokenKind::RightParen) {
            break;
        }
        let var_start = parser.start_span();
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();
        if let Some(token) = parser.eat(TokenKind::Variable) {
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let name = text[1..].to_string();
            let span = Span::new(var_start, token.span.end);
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

fn parse_arrow_function(parser: &mut Parser, is_static: bool, start: u32, attributes: Vec<Attribute>) -> Expr {
    parser.advance(); // consume 'fn'

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();

    parser.expect(TokenKind::LeftParen);
    let params = stmt::parse_param_list(parser);
    parser.expect(TokenKind::RightParen);

    // return type
    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    parser.expect(TokenKind::FatArrow);
    let body = parse_expr(parser);
    let span = Span::new(start, body.span.end);

    Expr {
        kind: ExprKind::ArrowFunction(ArrowFunctionExpr {
            is_static,
            by_ref,
            params,
            return_type,
            body: Box::new(body),
            attributes,
        }),
        span,
    }
}

// =============================================================================
// Match expression
// =============================================================================

fn parse_match_expr(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume 'match'

    parser.expect(TokenKind::LeftParen);
    let subject = parse_expr(parser);
    parser.expect(TokenKind::RightParen);

    parser.expect(TokenKind::LeftBrace);

    let mut arms = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let arm_start = parser.start_span();

        let conditions = if parser.eat(TokenKind::Default).is_some() {
            // Allow trailing comma after default: `default, => ...`
            parser.eat(TokenKind::Comma);
            None
        } else {
            let mut conds = Vec::new();
            conds.push(parse_expr(parser));
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::FatArrow) { break; }
                conds.push(parse_expr(parser));
            }
            Some(conds)
        };

        parser.expect(TokenKind::FatArrow);
        let body = parse_expr(parser);
        let arm_span = Span::new(arm_start, body.span.end);

        arms.push(MatchArm { conditions, body, span: arm_span });

        // Match arms separated by commas
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }

    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

    Expr {
        kind: ExprKind::Match(MatchExpr {
            subject: Box::new(subject),
            arms,
        }),
        span: Span::new(start, end),
    }
}

// =============================================================================
// Yield expression
// =============================================================================

fn parse_yield_expr(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume 'yield'

    // yield from expr
    if parser.check(TokenKind::From) {
        parser.advance();
        let value = parse_expr(parser);
        let span = Span::new(start, value.span.end);
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: None,
                value: Some(Box::new(value)),
            }),
            span,
        };
    }

    // Bare yield (no value) — also bare when next token is a binary-only operator
    // e.g. `yield * -1` → `(yield) * (-1)`, but `yield +1` → `yield (+1)`
    let kind = parser.current_kind();
    let is_binary_only = precedence::infix_binding_power(&kind).is_some()
        && precedence::prefix_binding_power(&kind).is_none();
    if parser.check(TokenKind::Semicolon)
        || parser.check(TokenKind::RightParen)
        || parser.check(TokenKind::RightBracket)
        || parser.check(TokenKind::RightBrace)
        || parser.check(TokenKind::Comma)
        || is_binary_only
    {
        let span = Span::new(start, parser.current_span().start);
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: None,
                value: None,
            }),
            span,
        };
    }

    let first = parse_expr(parser);

    // yield key => value
    if parser.eat(TokenKind::FatArrow).is_some() {
        let value = parse_expr(parser);
        let span = Span::new(start, value.span.end);
        return Expr {
            kind: ExprKind::Yield(YieldExpr {
                key: Some(Box::new(first)),
                value: Some(Box::new(value)),
            }),
            span,
        };
    }

    // yield value
    let span = Span::new(start, first.span.end);
    Expr {
        kind: ExprKind::Yield(YieldExpr {
            key: None,
            value: Some(Box::new(first)),
        }),
        span,
    }
}

// =============================================================================
// Argument list parsing
// =============================================================================

/// Result of parsing an argument list — either regular args or a `(...)` callable marker.
enum ArgListResult {
    Args(Vec<Arg>),
    CallableMarker,
}

/// Parse an argument list `(arg, arg, ...)` or detect `(...)` first-class callable syntax.
fn parse_arg_list_or_callable(parser: &mut Parser) -> ArgListResult {
    parser.advance(); // consume (

    // Detect first-class callable: (...)
    if parser.check(TokenKind::Ellipsis) {
        if parser.peek_kind() == Some(TokenKind::RightParen) {
            parser.advance(); // consume ...
            parser.advance(); // consume )
            return ArgListResult::CallableMarker;
        }
    }

    let mut args = Vec::new();
    if !parser.check(TokenKind::RightParen) {
        loop {
            if parser.check(TokenKind::RightParen) {
                break; // trailing comma
            }
            args.push(parse_arg(parser));
            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
    }

    parser.expect(TokenKind::RightParen);
    ArgListResult::Args(args)
}

/// Parse an argument list: `(arg, arg, ...)`
pub fn parse_arg_list(parser: &mut Parser) -> Vec<Arg> {
    match parse_arg_list_or_callable(parser) {
        ArgListResult::Args(args) => args,
        ArgListResult::CallableMarker => Vec::new(), // fallback — shouldn't reach here in normal use
    }
}

fn parse_arg(parser: &mut Parser) -> Arg {
    let start = parser.start_span();

    // Check for named argument: name: (PHP allows any keyword as a named arg label)
    let name = if parser.peek_kind() == Some(TokenKind::Colon) {
        let kind = parser.current_kind();
        if kind == TokenKind::Identifier || parser.is_semi_reserved_keyword()
            || matches!(kind, TokenKind::Array | TokenKind::List
                | TokenKind::Match_ | TokenKind::Fn_ | TokenKind::Static
                | TokenKind::Abstract | TokenKind::Final | TokenKind::Readonly
                | TokenKind::Class | TokenKind::Interface | TokenKind::Trait
                | TokenKind::Enum_ | TokenKind::Extends | TokenKind::Implements
                | TokenKind::Const | TokenKind::Use | TokenKind::Namespace
                | TokenKind::New | TokenKind::Try | TokenKind::Catch | TokenKind::Finally
                | TokenKind::Throw | TokenKind::Instanceof | TokenKind::Yield_
                | TokenKind::Switch | TokenKind::Public | TokenKind::Protected | TokenKind::Private)
        {
            let name_token = parser.advance();
            parser.advance(); // consume :
            let text = &parser.source()[name_token.span.start as usize..name_token.span.end as usize];
            Some(text.to_string())
        } else {
            None
        }
    } else {
        None
    };

    // Check for unpack: ...expr
    let unpack = parser.eat(TokenKind::Ellipsis).is_some();

    // Check for by-reference: &$var (deprecated call-time pass-by-ref)
    let _by_ref = parser.eat(TokenKind::Ampersand).is_some();

    let value = parse_expr(parser);
    let span = Span::new(start, value.span.end);

    Arg { name, value, unpack, span }
}

fn parse_function_call(parser: &mut Parser, callee: Expr) -> Expr {
    let start = callee.span.start;

    match parse_arg_list_or_callable(parser) {
        ArgListResult::CallableMarker => {
            let span = Span::new(start, parser.current_span().start);
            Expr {
                kind: ExprKind::CallableCreate(CallableCreateExpr {
                    kind: CallableCreateKind::Function(Box::new(callee)),
                }),
                span,
            }
        }
        ArgListResult::Args(args) => {
            let span = Span::new(start, parser.current_span().start);
            Expr {
                kind: ExprKind::FunctionCall(FunctionCallExpr {
                    name: Box::new(callee),
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

fn parse_array_literal(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume [

    let mut elements = Vec::new();

    if !parser.check(TokenKind::RightBracket) {
        loop {
            if parser.check(TokenKind::RightBracket) {
                break; // trailing comma case
            }
            // Empty element (skipped position for destructuring): [, $b] or [$a, , $c]
            if parser.check(TokenKind::Comma) {
                let span = parser.current_span();
                elements.push(ArrayElement {
                    key: None,
                    value: Expr { kind: ExprKind::Null, span },
                    unpack: false,
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

    let close = parser.expect(TokenKind::RightBracket);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

fn parse_array_call(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume 'array'
    parser.expect(TokenKind::LeftParen);

    let mut elements = Vec::new();

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

    let close = parser.expect(TokenKind::RightParen);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

fn parse_array_element(parser: &mut Parser) -> ArrayElement {
    let elem_start = parser.start_span();

    // Handle unpack: ...$arr
    let unpack = parser.eat(TokenKind::Ellipsis).is_some();

    // Handle &$var (by-ref)
    if parser.check(TokenKind::Ampersand) {
        parser.advance();
    }
    let first_expr = parse_expr(parser);

    if !unpack && parser.eat(TokenKind::FatArrow).is_some() {
        // key => value
        if parser.check(TokenKind::Ampersand) {
            parser.advance();
        }
        let value = parse_expr(parser);
        let elem_span = Span::new(elem_start, value.span.end);
        ArrayElement {
            key: Some(first_expr),
            value,
            unpack: false,
            span: elem_span,
        }
    } else {
        // value only (or unpack)
        let elem_span = Span::new(elem_start, first_expr.span.end);
        ArrayElement {
            key: None,
            value: first_expr,
            unpack,
            span: elem_span,
        }
    }
}

fn parse_list_expr(parser: &mut Parser) -> Expr {
    let start = parser.start_span();
    parser.advance(); // consume 'list'
    parser.expect(TokenKind::LeftParen);

    let mut elements = Vec::new();

    if !parser.check(TokenKind::RightParen) {
        loop {
            if parser.check(TokenKind::RightParen) {
                break;
            }
            if parser.check(TokenKind::Comma) {
                // empty element — push nothing (skip)
                let span = parser.current_span();
                elements.push(ArrayElement {
                    key: None,
                    value: Expr { kind: ExprKind::Null, span },
                    unpack: false,
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

    let close = parser.expect(TokenKind::RightParen);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

/// Parse a single element in a list() or short list destructuring.
/// Handles: `$var`, `&$var`, `'key' => $var`, `'key' => &$var`, `list($a, $b)`, etc.
fn parse_list_element(parser: &mut Parser) -> ArrayElement {
    let elem_start = parser.start_span();

    // Handle &$var (by-reference)
    if parser.check(TokenKind::Ampersand) {
        parser.advance();
        let value = parse_expr(parser);
        let elem_span = Span::new(elem_start, value.span.end);
        return ArrayElement {
            key: None,
            value,
            unpack: false,
            span: elem_span,
        };
    }

    let first = parse_expr(parser);

    if parser.eat(TokenKind::FatArrow).is_some() {
        // key => value or key => &value
        if parser.check(TokenKind::Ampersand) {
            parser.advance();
        }
        let value = parse_expr(parser);
        let elem_span = Span::new(elem_start, value.span.end);
        ArrayElement {
            key: Some(first),
            value,
            unpack: false,
            span: elem_span,
        }
    } else {
        let elem_span = Span::new(elem_start, first.span.end);
        ArrayElement {
            key: None,
            value: first,
            unpack: false,
            span: elem_span,
        }
    }
}

/// Try to parse a cast expression like `(int)$x`. Returns Some(Expr) if successful,
/// or None if this is not a cast (just a parenthesized expression).
fn try_parse_cast(parser: &mut Parser) -> Option<Expr> {
    let peeked = parser.peek_kind();

    let cast_kind = match peeked {
        Some(TokenKind::Identifier) => {
            let peek_text = parser.peek_text()?;
            let lower = peek_text.to_ascii_lowercase();
            CAST_KEYWORDS.iter().find(|(kw, _)| *kw == lower).map(|(_, ck)| *ck)
        }
        Some(TokenKind::Array) => Some(CastKind::Array),
        Some(TokenKind::Unset) => Some(CastKind::Unset),
        _ => None,
    };

    let cast_kind = cast_kind?;

    let start = parser.start_span();
    parser.advance(); // consume (
    parser.advance(); // consume the cast keyword
    if parser.eat(TokenKind::RightParen).is_none() {
        return None;
    }
    let operand = parse_expr_bp(parser, 41);
    let span = Span::new(start, operand.span.end);
    Some(Expr {
        kind: ExprKind::Cast(cast_kind, Box::new(operand)),
        span,
    })
}

fn token_to_binary_op(kind: TokenKind) -> BinaryOp {
    match kind {
        TokenKind::Plus => BinaryOp::Add,
        TokenKind::Minus => BinaryOp::Sub,
        TokenKind::Star => BinaryOp::Mul,
        TokenKind::Slash => BinaryOp::Div,
        TokenKind::Percent => BinaryOp::Mod,
        TokenKind::StarStar => BinaryOp::Pow,
        TokenKind::Dot => BinaryOp::Concat,
        TokenKind::EqualsEquals => BinaryOp::Equal,
        TokenKind::BangEquals => BinaryOp::NotEqual,
        TokenKind::EqualsEqualsEquals => BinaryOp::Identical,
        TokenKind::BangEqualsEquals => BinaryOp::NotIdentical,
        TokenKind::LessThan => BinaryOp::Less,
        TokenKind::GreaterThan => BinaryOp::Greater,
        TokenKind::LessThanEquals => BinaryOp::LessOrEqual,
        TokenKind::GreaterThanEquals => BinaryOp::GreaterOrEqual,
        TokenKind::Spaceship => BinaryOp::Spaceship,
        TokenKind::AmpersandAmpersand => BinaryOp::BooleanAnd,
        TokenKind::PipePipe => BinaryOp::BooleanOr,
        TokenKind::Ampersand => BinaryOp::BitwiseAnd,
        TokenKind::Pipe => BinaryOp::BitwiseOr,
        TokenKind::Caret => BinaryOp::BitwiseXor,
        TokenKind::ShiftLeft => BinaryOp::ShiftLeft,
        TokenKind::ShiftRight => BinaryOp::ShiftRight,
        TokenKind::And => BinaryOp::LogicalAnd,
        TokenKind::Or => BinaryOp::LogicalOr,
        TokenKind::Xor => BinaryOp::LogicalXor,
        TokenKind::Instanceof => BinaryOp::Instanceof,
        TokenKind::PipeArrow => BinaryOp::Pipe,
        TokenKind::QuestionQuestion => unreachable!("?? handled separately"),
        _ => unreachable!("not a binary operator: {:?}", kind),
    }
}

/// Extract label and body from heredoc/nowdoc raw token text.
/// Input: `<<<LABEL\nbody\nLABEL` or `<<<'LABEL'\nbody\nLABEL`
fn parse_heredoc_content(text: &str) -> (String, String) {
    // Skip <<<
    let after = text.strip_prefix("<<<").unwrap_or(text);
    let after = after.trim_start_matches(|c: char| c == ' ' || c == '\t');

    // Extract label
    let (label, rest) = if after.starts_with('\'') {
        let end = after[1..].find('\'').unwrap_or(after.len() - 1);
        let label = after[1..1 + end].to_string();
        let rest = &after[2 + end..];
        (label, rest)
    } else if after.starts_with('"') {
        let end = after[1..].find('"').unwrap_or(after.len() - 1);
        let label = after[1..1 + end].to_string();
        let rest = &after[2 + end..];
        (label, rest)
    } else {
        let end = after
            .find(|c: char| !c.is_ascii_alphanumeric() && c != '_')
            .unwrap_or(after.len());
        let label = after[..end].to_string();
        let rest = &after[end..];
        (label, rest)
    };

    // Skip to first newline (end of label line)
    let body_start = rest.find('\n').map(|p| p + 1).unwrap_or(rest.len());
    let body = &rest[body_start..];

    // Remove end marker line
    let end_marker_pos = body.rfind(&label).unwrap_or(body.len());
    let content = &body[..end_marker_pos];
    let content = content.strip_suffix('\n').unwrap_or(content);
    let content = content.strip_suffix('\r').unwrap_or(content);

    // Handle indented end marker (PHP 7.3+)
    let end_marker_line = &body[end_marker_pos..];
    let before_label = &body[..end_marker_pos];
    // Check if end marker line starts from beginning of line
    let last_newline = before_label.rfind('\n');
    let indent = if let Some(nl_pos) = last_newline {
        let line_before_marker = &body[nl_pos + 1..end_marker_pos];
        if line_before_marker.chars().all(|c| c == ' ' || c == '\t') {
            ""
        } else {
            ""
        }
    } else {
        let indent_end = end_marker_line.len() - end_marker_line.trim_start_matches(|c: char| c == ' ' || c == '\t').len();
        if indent_end > 0 { &end_marker_line[..indent_end] } else { "" }
    };

    let final_content = if !indent.is_empty() {
        content
            .lines()
            .map(|line| line.strip_prefix(indent).unwrap_or(line))
            .collect::<Vec<_>>()
            .join("\n")
    } else {
        content.to_string()
    };

    (label, final_content)
}

/// Find the byte offset of the body content within a heredoc token.
fn find_body_offset(text: &str, token_start: u32) -> u32 {
    let first_newline = text.find('\n').unwrap_or(text.len());
    token_start + first_newline as u32 + 1
}
