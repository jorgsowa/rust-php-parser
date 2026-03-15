use std::borrow::Cow;

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
pub fn parse_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    parse_expr_bp(parser, 0)
}

/// Pratt expression parser. Parses expressions with binding power >= min_bp.
pub fn parse_expr_bp<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    min_bp: u8,
) -> Expr<'arena, 'src> {
    let mut lhs = parse_atom(parser);

    loop {
        let kind = parser.current_kind();

        // Check for postfix operators first (++, --)
        if let Some(left_bp) = precedence::postfix_binding_power(kind) {
            if left_bp < min_bp {
                break;
            }
            let op_token = parser.advance();
            let op = match op_token.kind {
                TokenKind::PlusPlus => UnaryPostfixOp::PostIncrement,
                TokenKind::MinusMinus => UnaryPostfixOp::PostDecrement,
                _ => unreachable!(), // postfix_binding_power only returns Some for ++ and --
            };
            let span = lhs.span.merge(op_token.span);
            lhs = Expr {
                kind: ExprKind::UnaryPostfix(UnaryPostfixExpr {
                    operand: parser.alloc(lhs),
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
                _ => unreachable!(), // is_assignment_op() guarantees one of the listed variants
            };
            // Right-associative: parse RHS with same bp
            let rhs = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = lhs.span.merge(rhs.span);
            lhs = Expr {
                kind: ExprKind::Assign(AssignExpr {
                    target: parser.alloc(lhs),
                    op,
                    value: parser.alloc(rhs),
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
                let e = parse_expr_bp(parser, 0);
                Some(parser.alloc(e))
            };

            parser.expect(TokenKind::Colon);
            // Ternary is LEFT-associative in PHP, so use TERNARY_BP + 1
            let else_expr = parse_expr_bp(parser, TERNARY_BP + 1);
            let span = lhs.span.merge(else_expr.span);
            lhs = Expr {
                kind: ExprKind::Ternary(TernaryExpr {
                    condition: parser.alloc(lhs),
                    then_expr,
                    else_expr: parser.alloc(else_expr),
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
                                object: parser.alloc(lhs),
                                method: parser.alloc(member),
                            }
                        } else {
                            CallableCreateKind::Method {
                                object: parser.alloc(lhs),
                                method: parser.alloc(member),
                            }
                        };
                        lhs = Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr {
                                kind: callable_kind,
                            }),
                            span,
                        };
                    }
                    ArgListResult::Args(args) => {
                        let span = Span::new(lhs.span.start, parser.current_span().start);
                        let call = parser.alloc(MethodCallExpr {
                            object: parser.alloc(lhs),
                            method: parser.alloc(member),
                            args,
                        });
                        let expr_kind = if is_nullsafe {
                            ExprKind::NullsafeMethodCall(call)
                        } else {
                            ExprKind::MethodCall(call)
                        };
                        lhs = Expr {
                            kind: expr_kind,
                            span,
                        };
                    }
                }
            } else {
                let span = Span::new(lhs.span.start, member.span.end);
                let expr_kind = if is_nullsafe {
                    ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                        object: parser.alloc(lhs),
                        property: parser.alloc(member),
                    })
                } else {
                    ExprKind::PropertyAccess(PropertyAccessExpr {
                        object: parser.alloc(lhs),
                        property: parser.alloc(member),
                    })
                };
                lhs = Expr {
                    kind: expr_kind,
                    span,
                };
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
                let src = parser.source;
                let member =
                    Cow::Borrowed(&src[token.span.start as usize + 1..token.span.end as usize]);
                let span = Span::new(lhs.span.start, token.span.end);
                lhs = Expr {
                    kind: ExprKind::StaticPropertyAccess(StaticAccessExpr {
                        class: parser.alloc(lhs),
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
                        class: parser.alloc(lhs),
                        member: parser.alloc(member),
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
                                        class: parser.alloc(lhs),
                                        method: Cow::Borrowed("{dynamic}"),
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let callee = Expr {
                                kind: ExprKind::ClassConstAccessDynamic {
                                    class: parser.alloc(lhs),
                                    member: parser.alloc(member),
                                },
                                span: Span::new(0, 0), // placeholder, will be wrapped
                            };
                            let span = Span::new(callee.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::FunctionCall(FunctionCallExpr {
                                    name: parser.alloc(callee),
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
                            class: parser.alloc(lhs),
                            member: parser.alloc(member),
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
                        class: parser.alloc(lhs),
                        member: Cow::Borrowed("class"),
                    }),
                    span,
                };
            } else {
                // Static method call or class constant
                let (member_name, _member_span) =
                    if let Some(result) = parser.eat_identifier_or_keyword() {
                        result
                    } else {
                        let span = parser.current_span();
                        parser.error(ParseError::Expected {
                            expected: "identifier".into(),
                            found: parser.current_kind(),
                            span,
                        });
                        ("<error>", span)
                    };

                if parser.check(TokenKind::LeftParen) {
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method: Cow::Borrowed(member_name),
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = Span::new(lhs.span.start, parser.current_span().start);
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCall(parser.alloc(
                                    StaticMethodCallExpr {
                                        class: parser.alloc(lhs),
                                        method: Cow::Borrowed(member_name),
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Class constant
                    let span = Span::new(lhs.span.start, parser.current_span().start);
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                            class: parser.alloc(lhs),
                            member: Cow::Borrowed(member_name),
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
                let e = parse_expr(parser);
                Some(parser.alloc(e))
            };
            parser.expect(TokenKind::RightBracket);
            let span = Span::new(lhs.span.start, parser.current_span().start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: parser.alloc(lhs),
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
                let e = parse_expr(parser);
                Some(parser.alloc(e))
            };
            parser.expect(TokenKind::RightBrace);
            let span = Span::new(lhs.span.start, parser.current_span().start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: parser.alloc(lhs),
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
            if let Some((left_bp, right_bp)) = precedence::infix_binding_power(kind) {
                if left_bp < min_bp {
                    break;
                }
                parser.advance();
                let rhs = parse_expr_bp(parser, right_bp);
                let span = lhs.span.merge(rhs.span);
                lhs = Expr {
                    kind: ExprKind::NullCoalesce(NullCoalesceExpr {
                        left: parser.alloc(lhs),
                        right: parser.alloc(rhs),
                    }),
                    span,
                };
                continue;
            }
        }

        // Infix binary operators
        if let Some((left_bp, right_bp)) = precedence::infix_binding_power(kind) {
            if left_bp < min_bp {
                break;
            }
            let op_token = parser.advance();
            let op = token_to_binary_op(op_token.kind);
            let rhs = parse_expr_bp(parser, right_bp);
            let span = lhs.span.merge(rhs.span);
            lhs = Expr {
                kind: ExprKind::Binary(BinaryExpr {
                    left: parser.alloc(lhs),
                    op,
                    right: parser.alloc(rhs),
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
fn parse_member_name<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    // Single match dispatch: the compiler emits a jump table so the common
    // case (plain Identifier) costs one load + one branch rather than the
    // previous three sequential check() calls.
    match parser.current_kind() {
        // Most common: plain identifier or any keyword usable as a member name.
        TokenKind::Identifier
        | TokenKind::Class
        | TokenKind::Abstract
        | TokenKind::Final
        | TokenKind::Interface
        | TokenKind::Trait
        | TokenKind::Extends
        | TokenKind::Implements
        | TokenKind::Public
        | TokenKind::Protected
        | TokenKind::Private
        | TokenKind::Static
        | TokenKind::Const
        | TokenKind::Fn_
        | TokenKind::Match_
        | TokenKind::Namespace
        | TokenKind::Use
        | TokenKind::Readonly
        | TokenKind::Enum_
        | TokenKind::From
        | TokenKind::Self_
        | TokenKind::Parent_
        | TokenKind::New
        | TokenKind::Yield_
        | TokenKind::Throw
        | TokenKind::Try
        | TokenKind::Catch
        | TokenKind::Finally
        | TokenKind::Instanceof
        | TokenKind::Array
        | TokenKind::List
        | TokenKind::Switch
        | TokenKind::Case
        | TokenKind::Default
        | TokenKind::If
        | TokenKind::Else
        | TokenKind::ElseIf
        | TokenKind::While
        | TokenKind::Do
        | TokenKind::For
        | TokenKind::Foreach
        | TokenKind::As
        | TokenKind::Function
        | TokenKind::Return
        | TokenKind::Echo
        | TokenKind::Print
        | TokenKind::Break
        | TokenKind::Continue
        | TokenKind::Goto
        | TokenKind::Declare
        | TokenKind::Unset
        | TokenKind::Global
        | TokenKind::Clone
        | TokenKind::Isset
        | TokenKind::Empty
        | TokenKind::Include
        | TokenKind::IncludeOnce
        | TokenKind::Require
        | TokenKind::RequireOnce
        | TokenKind::Eval
        | TokenKind::Exit
        | TokenKind::Die
        | TokenKind::True
        | TokenKind::False
        | TokenKind::Null
        | TokenKind::And
        | TokenKind::Or
        | TokenKind::Xor
        | TokenKind::MagicClass
        | TokenKind::MagicDir
        | TokenKind::MagicFile
        | TokenKind::MagicFunction
        | TokenKind::MagicLine
        | TokenKind::MagicMethod
        | TokenKind::MagicNamespace
        | TokenKind::MagicTrait
        | TokenKind::MagicProperty => {
            let token = parser.advance();
            let text = &parser.source[token.span.start as usize..token.span.end as usize];
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed(text)),
                span: token.span,
            }
        }
        // Dynamic: $obj->$var
        TokenKind::Variable => {
            let token = parser.advance();
            let src = parser.source;
            let name = &src[token.span.start as usize + 1..token.span.end as usize];
            Expr {
                kind: ExprKind::Variable(Cow::Borrowed(name)),
                span: token.span,
            }
        }
        // Dynamic: $obj->{expr}
        TokenKind::LeftBrace => {
            parser.advance();
            let inner = parse_expr(parser);
            parser.expect(TokenKind::RightBrace);
            inner
        }
        _ => {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "member name".into(),
                found: parser.current_kind(),
                span,
            });
            Expr {
                kind: ExprKind::Error,
                span,
            }
        }
    }
}

/// Parse an atomic expression (prefix unaries, literals, variables, etc.)
fn parse_atom<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let kind = parser.current_kind();

    // Keywords followed by backslash are namespace-qualified names (e.g., fn\use(), private\protected\...)
    // Exclude keywords that have their own parse_atom handlers and can precede `\ClassName` expressions
    if parser.is_semi_reserved_keyword()
        && !matches!(
            kind,
            TokenKind::New | TokenKind::Throw | TokenKind::Yield_ | TokenKind::Instanceof
        )
        && parser.peek_kind() == Some(TokenKind::Backslash)
    {
        let token = parser.advance();
        let src = parser.source;
        let first = &src[token.span.start as usize..token.span.end as usize];
        let mut parts: Vec<&str> = vec![first];
        while parser.eat(TokenKind::Backslash).is_some() {
            if let Some((part, _)) = parser.eat_identifier_or_keyword() {
                parts.push(part);
            }
        }
        let span = Span::new(token.span.start, parser.current_span().start);
        let ident = if parts.len() == 1 {
            Cow::Borrowed(parts[0])
        } else {
            Cow::Owned(parts.join("\\"))
        };
        return Expr {
            kind: ExprKind::Identifier(ident),
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
                expected: "'function' or 'fn'".into(),
                found: parser.current_kind(),
                span,
            });
            return Expr {
                kind: ExprKind::Error,
                span: Span::new(start, span.end),
            };
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
            expected: "'function', 'fn', or 'static'".into(),
            found: parser.current_kind(),
            span,
        });
        return Expr {
            kind: ExprKind::Error,
            span: Span::new(start, span.end),
        };
    }

    // @ error suppression (prefix, high precedence)
    if kind == TokenKind::At {
        let token = parser.advance();
        let operand = parse_expr_bp(parser, 41); // same as other prefix unary
        let span = token.span.merge(operand.span);
        return Expr {
            kind: ExprKind::ErrorSuppress(parser.alloc(operand)),
            span,
        };
    }

    // Prefix unary operators
    if let Some(right_bp) = precedence::prefix_binding_power(kind) {
        let op_token = parser.advance();
        let operand = parse_expr_bp(parser, right_bp);
        let op = match op_token.kind {
            TokenKind::Minus => UnaryPrefixOp::Negate,
            TokenKind::Plus => UnaryPrefixOp::Plus,
            TokenKind::Bang => UnaryPrefixOp::BooleanNot,
            TokenKind::Tilde => UnaryPrefixOp::BitwiseNot,
            TokenKind::PlusPlus => UnaryPrefixOp::PreIncrement,
            TokenKind::MinusMinus => UnaryPrefixOp::PreDecrement,
            _ => unreachable!(), // prefix_binding_power only returns Some for -, +, !, ~, ++, --
        };
        let span = op_token.span.merge(operand.span);
        return Expr {
            kind: ExprKind::UnaryPrefix(UnaryPrefixExpr {
                op,
                operand: parser.alloc(operand),
            }),
            span,
        };
    }

    match kind {
        // Integer literals
        TokenKind::IntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_int_no_alloc(text.as_bytes(), 10, 0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::HexIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_int_no_alloc(&text.as_bytes()[2..], 16, 0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::BinIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_int_no_alloc(&text.as_bytes()[2..], 2, 0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::OctIntLiteral => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_int_no_alloc(&text.as_bytes()[1..], 8, 0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
            }
        }
        TokenKind::OctIntLiteralNew => {
            let token = parser.advance();
            let text = &parser.source()[token.span.start as usize..token.span.end as usize];
            let value = parse_int_no_alloc(&text.as_bytes()[2..], 8, 0);
            Expr {
                kind: ExprKind::Int(value),
                span: token.span,
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
            let inner = &text[1..text.len() - 1];
            // Fast path: if no backslash, inner is a verbatim source slice
            let value: Cow<'src, str> = if !inner.contains('\\') {
                // inner is a subslice of `src` which has lifetime 'src
                let offset = inner.as_ptr() as usize - src.as_ptr() as usize;
                Cow::Borrowed(&src[offset..offset + inner.len()])
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
                        decoded.push(bytes[i] as char);
                        i += 1;
                    }
                }
                Cow::Owned(decoded)
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
            let inner = &stripped[1..stripped.len() - 1];

            if crate::interpolation::has_interpolation(inner) {
                // Offset of first char of inner content in source
                let inner_offset = token.span.end - 1 - inner.len() as u32;
                let parts = crate::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                );
                Expr {
                    kind: ExprKind::InterpolatedString(parts),
                    span: token.span,
                }
            } else if !inner.contains('\\') {
                // No interpolation and no escapes — verbatim source slice
                let offset = inner.as_ptr() as usize - src.as_ptr() as usize;
                Expr {
                    kind: ExprKind::String(Cow::Borrowed(&src[offset..offset + inner.len()])),
                    span: token.span,
                }
            } else {
                // Has escape sequences but no interpolation — decode via interpolated parts
                let inner_offset = token.span.end - 1 - inner.len() as u32;
                let parts = crate::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                );
                // Collapse single literal part into String, or use InterpolatedString
                if parts.len() == 1 {
                    if let StringPart::Literal(s) = parts.into_iter().next().unwrap() {
                        Expr {
                            kind: ExprKind::String(s),
                            span: token.span,
                        }
                    } else {
                        Expr {
                            kind: ExprKind::InterpolatedString(parser.alloc_vec()),
                            span: token.span,
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
            let inner = &text[1..text.len() - 1]; // strip backticks

            if crate::interpolation::has_interpolation(inner) {
                let inner_offset = token.span.start + 1;
                let parts = crate::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
                );
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            } else if !inner.contains('\\') {
                // No escapes — verbatim source slice
                let offset = inner.as_ptr() as usize - src.as_ptr() as usize;
                let mut parts = parser.alloc_vec_with_capacity(1);
                parts.push(StringPart::Literal(Cow::Borrowed(
                    &src[offset..offset + inner.len()],
                )));
                Expr {
                    kind: ExprKind::ShellExec(parts),
                    span: token.span,
                }
            } else {
                // Has escape sequences — decode via interpolated parts
                let inner_offset = token.span.start + 1;
                let parts = crate::interpolation::parse_interpolated_parts(
                    parser.arena,
                    src,
                    inner,
                    inner_offset,
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
            if crate::interpolation::has_interpolation(raw_body) {
                if !indent.is_empty() {
                    // Indented heredoc — raw_body is a verbatim source slice but each line
                    // is prefixed with `indent`. The indented sub-parser works directly on
                    // the source, skipping the indent at each line start, so we can use
                    // parse_complex_interpolation without wrapping.
                    let parts = crate::interpolation::parse_interpolated_parts_indented(
                        parser.arena,
                        src,
                        raw_body,
                        body_offset,
                        &indent,
                    );
                    Expr {
                        kind: ExprKind::Heredoc { label, parts },
                        span: token.span,
                    }
                } else {
                    // Non-indented — body is verbatim source, use the fast sub-parser path
                    let parts = crate::interpolation::parse_interpolated_parts(
                        parser.arena,
                        src,
                        raw_body,
                        body_offset,
                    );
                    Expr {
                        kind: ExprKind::Heredoc { label, parts },
                        span: token.span,
                    }
                }
            } else {
                // No interpolation — build the (possibly de-indented) literal body string
                let body_str = if !indent.is_empty() {
                    raw_body
                        .lines()
                        .map(|line| line.strip_prefix(&indent).unwrap_or(line))
                        .collect::<Vec<_>>()
                        .join("\n")
                } else {
                    raw_body.to_string()
                };
                let mut parts = parser.alloc_vec_with_capacity(1);
                parts.push(StringPart::Literal(Cow::Owned(body_str)));
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
            let raw_body = &text[body_start_in_text..body_end_in_text];
            let value: Cow<'src, str> = if !indent.is_empty() {
                Cow::Owned(
                    raw_body
                        .lines()
                        .map(|line| line.strip_prefix(&indent).unwrap_or(line))
                        .collect::<Vec<_>>()
                        .join("\n"),
                )
            } else {
                Cow::Borrowed(raw_body)
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
            let src = parser.source;
            // Strip the $ prefix
            let name = &src[token.span.start as usize + 1..token.span.end as usize];
            Expr {
                kind: ExprKind::Variable(Cow::Borrowed(name)),
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
                kind: ExprKind::VariableVariable(parser.alloc(inner)),
                span,
            }
        }

        // Identifiers (function names, class names, etc.)
        // Also handles qualified names: App\Models\User
        TokenKind::Identifier => {
            let token = parser.advance();
            let src = parser.source;
            let text = &src[token.span.start as usize..token.span.end as usize];

            // Check if this is a qualified name: Foo\Bar\Baz
            if parser.check(TokenKind::Backslash) {
                let mut parts: Vec<&str> = vec![text];
                while parser.eat(TokenKind::Backslash).is_some() {
                    if let Some((part, _)) = parser.eat_identifier_or_keyword() {
                        parts.push(part);
                    }
                }
                let span = Span::new(token.span.start, parser.current_span().start);
                Expr {
                    kind: ExprKind::Identifier(Cow::Owned(parts.join("\\"))),
                    span,
                }
            } else {
                Expr {
                    kind: ExprKind::Identifier(Cow::Borrowed(text)),
                    span: token.span,
                }
            }
        }

        // Backslash — fully qualified name: \Foo\Bar
        TokenKind::Backslash => {
            let start = parser.start_span();
            let name = parser.parse_name();
            Expr {
                kind: ExprKind::Identifier(name.to_string_repr()),
                span: Span::new(start, name.span().end),
            }
        }

        // self, parent, static — used as class names (e.g. self::method())
        TokenKind::Self_ => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("self")),
                span: token.span,
            }
        }
        TokenKind::Parent_ => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("parent")),
                span: token.span,
            }
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
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("static")),
                span: token.span,
            }
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

        // Match expression
        TokenKind::Match_ => parse_match_expr(parser),

        // Throw as expression (PHP 8)
        TokenKind::Throw => {
            let token = parser.advance();
            let expr = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(expr.span);
            Expr {
                kind: ExprKind::ThrowExpr(parser.alloc(expr)),
                span,
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
            let span = Span::new(start, parser.current_span().start);
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
            let close = parser.expect(TokenKind::RightParen);
            let end = close
                .map(|t| t.span.end)
                .unwrap_or(parser.current_span().start);
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
            let close = parser.expect(TokenKind::RightParen);
            let end = close
                .map(|t| t.span.end)
                .unwrap_or(parser.current_span().start);
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
            let close = parser.expect(TokenKind::RightParen);
            let end = close
                .map(|t| t.span.end)
                .unwrap_or(parser.current_span().start);
            Expr {
                kind: ExprKind::Eval(parser.alloc(inner)),
                span: Span::new(start, end),
            }
        }

        // include / include_once / require / require_once
        TokenKind::Include => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::Include, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::IncludeOnce => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::IncludeOnce, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::Require => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = token.span.merge(inner.span);
            Expr {
                kind: ExprKind::Include(IncludeKind::Require, parser.alloc(inner)),
                span,
            }
        }
        TokenKind::RequireOnce => {
            let token = parser.advance();
            let inner = parse_expr_bp(parser, ASSIGNMENT_BP);
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
            let name_text = Cow::Borrowed(&src[token.span.start as usize..token.span.end as usize]);
            if parser.check(TokenKind::LeftParen) {
                match parse_arg_list_or_callable(parser) {
                    ArgListResult::CallableMarker => {
                        // exit(...) - first class callable
                        let callee = Expr {
                            kind: ExprKind::Identifier(name_text),
                            span: token.span,
                        };
                        let span = Span::new(token.span.start, parser.current_span().start);
                        Expr {
                            kind: ExprKind::CallableCreate(CallableCreateExpr {
                                kind: CallableCreateKind::Function(parser.alloc(callee)),
                            }),
                            span,
                        }
                    }
                    ArgListResult::Args(args) => {
                        let span = Span::new(token.span.start, parser.current_span().start);
                        if args.is_empty() {
                            // exit()
                            Expr {
                                kind: ExprKind::Exit(None),
                                span,
                            }
                        } else if args.len() == 1 && args[0].name.is_none() && !args[0].unpack {
                            // exit(expr)
                            let value = args.into_iter().next().unwrap().value;
                            Expr {
                                kind: ExprKind::Exit(Some(parser.alloc(value))),
                                span,
                            }
                        } else {
                            // exit(status: 42), exit(...$args), exit($a, $b) - function call form
                            let callee = Expr {
                                kind: ExprKind::Identifier(name_text),
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

        // clone — unary prefix or function call (PHP 8.4)
        TokenKind::Clone => {
            let token = parser.advance();
            if parser.check(TokenKind::LeftParen) {
                // PHP 8.4: clone() function call syntax
                let callee = Expr {
                    kind: ExprKind::Identifier(Cow::Borrowed("clone")),
                    span: token.span,
                };
                parse_function_call(parser, callee)
            } else {
                let operand = parse_expr_bp(parser, 41);
                let span = token.span.merge(operand.span);
                Expr {
                    kind: ExprKind::Clone(parser.alloc(operand)),
                    span,
                }
            }
        }

        // Magic constants
        TokenKind::MagicClass => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Class),
                span: t.span,
            }
        }
        TokenKind::MagicDir => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Dir),
                span: t.span,
            }
        }
        TokenKind::MagicFile => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::File),
                span: t.span,
            }
        }
        TokenKind::MagicFunction => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Function),
                span: t.span,
            }
        }
        TokenKind::MagicLine => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Line),
                span: t.span,
            }
        }
        TokenKind::MagicMethod => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Method),
                span: t.span,
            }
        }
        TokenKind::MagicNamespace => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Namespace),
                span: t.span,
            }
        }
        TokenKind::MagicTrait => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Trait),
                span: t.span,
            }
        }
        TokenKind::MagicProperty => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::MagicConst(MagicConstKind::Property),
                span: t.span,
            }
        }

        // namespace\Foo\Bar — relative name in expression context
        TokenKind::Namespace => {
            if parser.peek_kind() == Some(TokenKind::Backslash) {
                let start = parser.start_span();
                let name = parser.parse_name();
                let text = Cow::Owned(format!("namespace\\{}", name.join_parts()));
                Expr {
                    kind: ExprKind::Identifier(text),
                    span: Span::new(start, name.span().end),
                }
            } else {
                let span = parser.current_span();
                parser.error(ParseError::ExpectedExpression { span });
                Expr {
                    kind: ExprKind::Error,
                    span,
                }
            }
        }

        // readonly used as identifier (function name, etc.)
        TokenKind::Readonly => {
            let token = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("readonly")),
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
    let anon_readonly =
        parser.check(TokenKind::Readonly) && parser.peek_kind() == Some(TokenKind::Class);
    if parser.check(TokenKind::Class) || anon_readonly {
        if anon_readonly {
            parser.advance(); // consume 'readonly'
        }
        parser.advance(); // consume 'class'

        // Optional constructor args (before extends/implements)
        let args = if parser.check(TokenKind::LeftParen) {
            parse_arg_list(parser)
        } else {
            parser.alloc_vec()
        };

        let extends = if parser.eat(TokenKind::Extends).is_some() {
            Some(parser.parse_name())
        } else {
            None
        };

        let implements = if parser.eat(TokenKind::Implements).is_some() {
            stmt::parse_name_list(parser)
        } else {
            parser.alloc_vec()
        };

        parser.expect(TokenKind::LeftBrace);
        let members = stmt::parse_class_members(parser);
        let close = parser.expect(TokenKind::RightBrace);
        let end = close
            .map(|t| t.span.end)
            .unwrap_or(parser.current_span().start);

        let class_decl = ClassDecl {
            name: None,
            modifiers: ClassModifiers {
                is_readonly: anon_readonly,
                ..Default::default()
            },
            extends,
            implements,
            members,
            attributes: anon_attributes,
        };

        let anon_class_expr = Expr {
            kind: ExprKind::AnonymousClass(parser.alloc(class_decl)),
            span: Span::new(start, end),
        };

        return Expr {
            kind: ExprKind::New(NewExpr {
                class: parser.alloc(anon_class_expr),
                args,
            }),
            span: Span::new(start, end),
        };
    }

    // Parse the class name — can be an identifier, self, parent, static, qualified name, or parenthesized expr
    let class = match parser.current_kind() {
        TokenKind::Self_ => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("self")),
                span: t.span,
            }
        }
        TokenKind::Parent_ => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("parent")),
                span: t.span,
            }
        }
        TokenKind::Static => {
            let t = parser.advance();
            Expr {
                kind: ExprKind::Identifier(Cow::Borrowed("static")),
                span: t.span,
            }
        }
        TokenKind::Variable => {
            // new $className()
            let t = parser.advance();
            let src = parser.source;
            Expr {
                kind: ExprKind::Variable(Cow::Borrowed(
                    &src[t.span.start as usize + 1..t.span.end as usize],
                )),
                span: t.span,
            }
        }
        TokenKind::LeftParen => {
            // new (expr)() - dynamic class name from expression (PHP 8.1+)
            let paren_start = parser.start_span();
            let open = parser.advance(); // consume (
            let inner = parse_expr(parser);
            parser.expect_closing(TokenKind::RightParen, open.span);
            let paren_span = Span::new(paren_start, parser.current_span().start);
            Expr {
                kind: ExprKind::Parenthesized(parser.alloc(inner)),
                span: paren_span,
            }
        }
        _ => {
            // Parse as a name (possibly qualified)
            let name = parser.parse_name();
            Expr {
                kind: ExprKind::Identifier(name.to_string_repr()),
                span: name.span(),
            }
        }
    };

    // Optional argument list
    let args = if parser.check(TokenKind::LeftParen) {
        parse_arg_list(parser)
    } else {
        parser.alloc_vec()
    };

    let span = Span::new(start, parser.current_span().start);
    Expr {
        kind: ExprKind::New(NewExpr {
            class: parser.alloc(class),
            args,
        }),
        span,
    }
}

// =============================================================================
// Closure expression: function($x) use($y) { }
// =============================================================================

fn parse_closure<'arena, 'src>(
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
        parser.alloc_vec()
    };

    // return type
    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    // body
    parser.expect(TokenKind::LeftBrace);
    let mut body = parser.alloc_vec_with_capacity(16);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        body.push(stmt::parse_stmt(parser));
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);

    Expr {
        kind: ExprKind::Closure(parser.alloc(ClosureExpr {
            is_static,
            by_ref,
            params,
            use_vars,
            return_type,
            body,
            attributes,
        })),
        span: Span::new(start, end),
    }
}

fn parse_closure_use_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, ClosureUseVar<'src>> {
    let mut vars = parser.alloc_vec_with_capacity(2);
    loop {
        if parser.check(TokenKind::RightParen) {
            break;
        }
        let var_start = parser.start_span();
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();
        if let Some(token) = parser.eat(TokenKind::Variable) {
            let src = parser.source;
            let name = &src[token.span.start as usize + 1..token.span.end as usize];
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

fn parse_arrow_function<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    is_static: bool,
    start: u32,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Expr<'arena, 'src> {
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
        kind: ExprKind::ArrowFunction(parser.alloc(ArrowFunctionExpr {
            is_static,
            by_ref,
            params,
            return_type,
            body: parser.alloc(body),
            attributes,
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

    parser.expect(TokenKind::LeftBrace);

    let mut arms = parser.alloc_vec_with_capacity(4);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let arm_start = parser.start_span();

        let conditions = if parser.eat(TokenKind::Default).is_some() {
            // Allow trailing comma after default: `default, => ...`
            parser.eat(TokenKind::Comma);
            None
        } else {
            let mut conds = parser.alloc_vec_with_capacity(2);
            conds.push(parse_expr(parser));
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::FatArrow) {
                    break;
                }
                conds.push(parse_expr(parser));
            }
            Some(conds)
        };

        parser.expect(TokenKind::FatArrow);
        let body = parse_expr(parser);
        let arm_span = Span::new(arm_start, body.span.end);

        arms.push(MatchArm {
            conditions,
            body,
            span: arm_span,
        });

        // Match arms separated by commas
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }

    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);

    Expr {
        kind: ExprKind::Match(MatchExpr {
            subject: parser.alloc(subject),
            arms,
        }),
        span: Span::new(start, end),
    }
}

// =============================================================================
// Yield expression
// =============================================================================

fn parse_yield_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
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
                value: Some(parser.alloc(value)),
            }),
            span,
        };
    }

    // Bare yield (no value) — also bare when next token is a binary-only operator
    // e.g. `yield * -1` → `(yield) * (-1)`, but `yield +1` → `yield (+1)`
    let kind = parser.current_kind();
    let is_binary_only = precedence::infix_binding_power(kind).is_some()
        && precedence::prefix_binding_power(kind).is_none();
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
                key: Some(parser.alloc(first)),
                value: Some(parser.alloc(value)),
            }),
            span,
        };
    }

    // yield value
    let span = Span::new(start, first.span.end);
    Expr {
        kind: ExprKind::Yield(YieldExpr {
            key: None,
            value: Some(parser.alloc(first)),
        }),
        span,
    }
}

// =============================================================================
// Argument list parsing
// =============================================================================

/// Result of parsing an argument list — either regular args or a `(...)` callable marker.
enum ArgListResult<'arena, 'src> {
    Args(ArenaVec<'arena, Arg<'arena, 'src>>),
    CallableMarker,
}

/// Parse an argument list `(arg, arg, ...)` or detect `(...)` first-class callable syntax.
fn parse_arg_list_or_callable<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArgListResult<'arena, 'src> {
    parser.advance(); // consume (

    // Detect first-class callable: (...)
    if parser.check(TokenKind::Ellipsis) && parser.peek_kind() == Some(TokenKind::RightParen) {
        parser.advance(); // consume ...
        parser.advance(); // consume )
        return ArgListResult::CallableMarker;
    }

    let mut args = parser.alloc_vec_with_capacity(4);
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
pub fn parse_arg_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, Arg<'arena, 'src>> {
    match parse_arg_list_or_callable(parser) {
        ArgListResult::Args(args) => args,
        ArgListResult::CallableMarker => parser.alloc_vec(), // fallback — shouldn't reach here in normal use
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
            parser.advance(); // consume :
            let src = parser.source;
            Some(Cow::Borrowed(
                &src[name_token.span.start as usize..name_token.span.end as usize],
            ))
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

    Arg {
        name,
        value,
        unpack,
        span,
    }
}

fn parse_function_call<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    callee: Expr<'arena, 'src>,
) -> Expr<'arena, 'src> {
    let start = callee.span.start;

    match parse_arg_list_or_callable(parser) {
        ArgListResult::CallableMarker => {
            let span = Span::new(start, parser.current_span().start);
            Expr {
                kind: ExprKind::CallableCreate(CallableCreateExpr {
                    kind: CallableCreateKind::Function(parser.alloc(callee)),
                }),
                span,
            }
        }
        ArgListResult::Args(args) => {
            let span = Span::new(start, parser.current_span().start);
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
    let start = parser.start_span();
    parser.advance(); // consume [

    // Symfony optimization: arrays are often larger (configs, annotations)
    // Increased from 8 to 16 to reduce growth for typical Symfony arrays
    let mut elements = parser.alloc_vec_with_capacity(16);

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
                    value: Expr {
                        kind: ExprKind::Null,
                        span,
                    },
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
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

fn parse_array_call<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'array'
    parser.expect(TokenKind::LeftParen);

    // Symfony optimization: same as parse_array_literal
    let mut elements = parser.alloc_vec_with_capacity(16);

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
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

fn parse_array_element<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArrayElement<'arena, 'src> {
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
                // empty element — push nothing (skip)
                let span = parser.current_span();
                elements.push(ArrayElement {
                    key: None,
                    value: Expr {
                        kind: ExprKind::Null,
                        span,
                    },
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
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Expr {
        kind: ExprKind::Array(elements),
        span,
    }
}

/// Parse a single element in a list() or short list destructuring.
/// Handles: `$var`, `&$var`, `'key' => $var`, `'key' => &$var`, `list($a, $b)`, etc.
fn parse_list_element<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArrayElement<'arena, 'src> {
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
fn try_parse_cast<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Option<Expr<'arena, 'src>> {
    let peeked = parser.peek_kind();

    let cast_kind = match peeked {
        Some(TokenKind::Identifier) => {
            let peek_text = parser.peek_text()?;
            CAST_KEYWORDS
                .iter()
                .find(|(kw, _)| kw.eq_ignore_ascii_case(peek_text))
                .map(|(_, ck)| *ck)
        }
        Some(TokenKind::Array) => Some(CastKind::Array),
        Some(TokenKind::Unset) => Some(CastKind::Unset),
        _ => None,
    };

    let cast_kind = cast_kind?;

    // Verify `)` follows the cast keyword before consuming anything.
    // Without this check, `( array() ... )` would be misidentified as `(array)` cast,
    // consuming `(` and `array` and leaving the parser in a corrupted state.
    if parser.peek2_kind() != Some(TokenKind::RightParen) {
        return None;
    }

    let start = parser.start_span();
    parser.advance(); // consume (
    let kw_span = parser.current_span();
    parser.advance(); // consume the cast keyword
    parser.eat(TokenKind::RightParen)?;

    if cast_kind == CastKind::Unset {
        parser.error(ParseError::Forbidden {
            message: "the (unset) cast is no longer supported".into(),
            span: kw_span,
        });
    }

    let operand = parse_expr_bp(parser, 41);
    let span = Span::new(start, operand.span.end);
    Some(Expr {
        kind: ExprKind::Cast(cast_kind, parser.alloc(operand)),
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

    // Skip to first newline (end of label line)
    let newline_pos = rest.find('\n').unwrap_or(rest.len());
    let body_start_in_text = rest_start + newline_pos + 1;
    let body = &text[body_start_in_text..];

    // Find the end-marker line by scanning line-by-line (PHP 7.3+: marker may be indented).
    let mut line_start = 0;
    let mut end_line_start = body.len();
    let mut indent = String::new();
    loop {
        if line_start >= body.len() {
            break;
        }
        let line_end = body[line_start..]
            .find('\n')
            .map(|p| line_start + p)
            .unwrap_or(body.len());
        let line = &body[line_start..line_end];
        let trimmed = line.trim_start_matches([' ', '\t']);
        if trimmed == label
            || (trimmed.starts_with(label)
                && trimmed[label.len()..]
                    .trim_start_matches(';')
                    .trim()
                    .is_empty())
        {
            end_line_start = line_start;
            let indent_len = line.len() - trimmed.len();
            indent = line[..indent_len].to_string();
            break;
        }
        line_start = if line_end < body.len() {
            line_end + 1
        } else {
            body.len()
        };
    }

    // Content ends just before the end-marker line, with trailing \r\n stripped.
    let content = &body[..end_line_start];
    let content = content.strip_suffix('\n').unwrap_or(content);
    let content = content.strip_suffix('\r').unwrap_or(content);
    let body_end_in_text = body_start_in_text + content.len();

    (label, body_start_in_text, body_end_in_text, indent)
}

/// Parse an integer literal from raw bytes, skipping underscores, without heap allocation.
/// Returns 0 on overflow (matching the behaviour of the original `str::parse::<i64>().unwrap_or(0)`).
/// `base` is 2, 8, 10, or 16.
fn parse_int_no_alloc(bytes: &[u8], base: i64, _skip: usize) -> i64 {
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
        value = match value.checked_mul(base).and_then(|v| v.checked_add(digit)) {
            Some(v) => v,
            None => return 0,
        };
    }
    value
}

/// Parse a float literal, skipping underscores, using a fixed-size stack buffer.
fn parse_float_no_alloc(text: &str) -> f64 {
    // Float literals are bounded in length; 128 bytes is more than sufficient.
    let mut buf = [0u8; 128];
    let mut len = 0;
    for &b in text.as_bytes() {
        if b != b'_' && len < buf.len() {
            buf[len] = b;
            len += 1;
        }
    }
    std::str::from_utf8(&buf[..len])
        .ok()
        .and_then(|s| s.parse::<f64>().ok())
        .unwrap_or(0.0)
}
