use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::{ParseError, ERROR_PLACEHOLDER};
use crate::instrument;
use crate::parser::{Parser, MAX_DEPTH};
use crate::precedence::{self, ASSIGNMENT_BP, NULL_COALESCE_LEFT_BP, TERNARY_BP};
use crate::version::PhpVersion;

mod atom;
pub(crate) mod interpolation;

// Re-exports so external callers' paths don't change
pub use atom::parse_arg_list;
pub(crate) use atom::{parse_arrow_function, parse_closure};

use atom::{parse_arg_list_or_callable, parse_atom, parse_function_call, ArgListResult};

/// Returns the "chain group" binding power for a non-associative token, if applicable.
///
/// PHP 8.0+ rejects chaining non-associative operators within the same precedence group:
/// - Equality group (bp 25): `==`, `!=`, `===`, `!==`, `<=>`
/// - Comparison group (bp 27): `<`, `>`, `<=`, `>=`
///
/// `instanceof` is intentionally excluded: PHP allows `$a instanceof Foo instanceof Bar`
/// at parse time and does not reject cross-group chains like `$a > $b == $c`.
fn nonassoc_chain_level_for_token(kind: TokenKind) -> Option<u8> {
    match kind {
        TokenKind::EqualsEquals
        | TokenKind::BangEquals
        | TokenKind::EqualsEqualsEquals
        | TokenKind::BangEqualsEquals
        | TokenKind::Spaceship => Some(25),
        TokenKind::LessThan
        | TokenKind::GreaterThan
        | TokenKind::LessThanEquals
        | TokenKind::GreaterThanEquals => Some(27),
        _ => None,
    }
}

/// Returns the "chain group" binding power for a binary op produced by a non-associative token.
///
/// Mirrors `nonassoc_chain_level_for_token` but operates on the already-parsed binary op.
/// `instanceof` returns `None` for the same reasons described above.
fn nonassoc_chain_level_for_op(op: BinaryOp) -> Option<u8> {
    match op {
        BinaryOp::Equal
        | BinaryOp::NotEqual
        | BinaryOp::Identical
        | BinaryOp::NotIdentical
        | BinaryOp::Spaceship => Some(25),
        BinaryOp::Less | BinaryOp::Greater | BinaryOp::LessOrEqual | BinaryOp::GreaterOrEqual => {
            Some(27)
        }
        _ => None,
    }
}

/// Returns true if `kind` is a valid PHP assignment target (lvalue).
///
/// Valid targets: variable, variable-variable, array access, property access,
/// static property access, array/list destructuring, and parenthesized valid targets.
/// Invalid targets emit a `ParseError::Forbidden` diagnostic at the assignment site.
fn is_valid_assignment_target(kind: &ExprKind<'_, '_>) -> bool {
    match kind {
        ExprKind::Variable(_)
        | ExprKind::VariableVariable(_)
        | ExprKind::ArrayAccess(_)
        | ExprKind::PropertyAccess(_)
        | ExprKind::NullsafePropertyAccess(_)
        | ExprKind::StaticPropertyAccess(_)
        | ExprKind::StaticPropertyAccessDynamic { .. }
        | ExprKind::Array(_)
        | ExprKind::Error => true,
        ExprKind::Parenthesized(inner) => is_valid_assignment_target(&inner.kind),
        _ => false,
    }
}

/// Parse an assignment operator and its RHS, treating `lhs` as the assignment target.
///
/// PHP grammar quirk: assignment operators bind tighter than prefix unary operators,
/// the `??` right operand, `@`, and casts. For example:
/// - `-$x += 1`       parses as `-(($x += 1))`,   not `(-$x) += 1`
/// - `$a ?? $b = $c`  parses as `$a ?? ($b = $c)`, not `($a ?? $b) = $c`
/// - `@$a = 1`        parses as `@($a = 1)`,       not `(@$a) = 1`
///
/// **Deliberate deviation from standard Pratt semantics**: this function is called
/// *after* `parse_expr_bp` returns, meaning it consumes the assignment regardless of
/// whatever `min_bp` the surrounding context passed to `parse_expr_bp`. This is
/// intentional: PHP's grammar allows assignment to "escape" prefix unary / `??` / `@`
/// / ternary-else context. Callers must opt-in via an explicit
/// `if parser.current_kind().is_assignment_op()` guard rather than relying on `min_bp`
/// to block it.
fn parse_assign_continuation<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    lhs: Expr<'arena, 'src>,
) -> Expr<'arena, 'src> {
    debug_assert!(parser.current_kind().is_assignment_op());
    if !is_valid_assignment_target(&lhs.kind) {
        let span = parser.current_span();
        parser.error(ParseError::Forbidden {
            message: "Cannot use expression as assignment target.".into(),
            span,
        });
    }
    let op_token = parser.advance();
    let by_ref = op_token.kind == TokenKind::Equals && parser.eat(TokenKind::Ampersand).is_some();
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
        _ => unreachable!(
            "is_assignment_op() guarantees one of the listed variants, got {:?}",
            op_token.kind
        ),
    };
    let rhs = parse_expr_bp(parser, ASSIGNMENT_BP);
    let span = lhs.span.merge(rhs.span);
    Expr {
        kind: ExprKind::Assign(AssignExpr {
            target: parser.alloc(lhs),
            op,
            value: parser.alloc(rhs),
            by_ref,
        }),
        span,
    }
}

/// Parse an expression.
pub fn parse_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    instrument::record_parse_expr();
    parse_expr_bp(parser, 0)
}

/// Pratt expression parser. Parses expressions with binding power >= min_bp.
pub fn parse_expr_bp<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    min_bp: u8,
) -> Expr<'arena, 'src> {
    if min_bp != 0 {
        instrument::record_parse_expr_bp_recursive();
    }
    parser.expr_depth += 1;
    if parser.expr_depth > MAX_DEPTH {
        parser.expr_depth -= 1;
        let span = parser.current_span();
        parser.error(ParseError::Forbidden {
            message: "maximum expression nesting depth exceeded".into(),
            span,
        });
        return Expr {
            kind: ExprKind::Error,
            span,
        };
    }
    let mut lhs = parse_atom(parser);

    loop {
        let kind = parser.current_kind();

        // Fast-path: Direct token kind dispatch for most-common operators.
        // Compiler converts this to jump table (O(1)) instead of sequential branches.
        // This groups direct token comparisons that were scattered across if-statements.
        let should_continue = match kind {
            // Postfix operators (++, --)
            TokenKind::PlusPlus | TokenKind::MinusMinus => {
                if let Some(left_bp) = precedence::postfix_binding_power(kind) {
                    if left_bp < min_bp {
                        break;
                    }
                    let op_token = parser.advance();
                    let op = match op_token.kind {
                        TokenKind::PlusPlus => UnaryPostfixOp::PostIncrement,
                        TokenKind::MinusMinus => UnaryPostfixOp::PostDecrement,
                        _ => unreachable!(
                            "outer arm already matched PlusPlus/MinusMinus, got {:?}",
                            op_token.kind
                        ),
                    };
                    let span = lhs.span.merge(op_token.span);
                    lhs = Expr {
                        kind: ExprKind::UnaryPostfix(UnaryPostfixExpr {
                            operand: parser.alloc(lhs),
                            op,
                        }),
                        span,
                    };
                    true
                } else {
                    false
                }
            }

            // Ternary operator (non-associative in PHP 8.0+)
            TokenKind::Question => {
                if TERNARY_BP < min_bp {
                    break;
                }
                // PHP 8.0+: unparenthesized `a ? b : c ? d : e` is a fatal parse error,
                // but chains of short ternaries (`a ?: b ?: c`) remain valid because `?:`
                // is left-associative and unambiguous.
                //
                // So: fire the error when LHS is an already-parsed ternary UNLESS both the
                // LHS ternary and the incoming ternary are short (then_expr=None and next
                // token after `?` is `:`).
                if parser.version >= PhpVersion::Php80 {
                    if let ExprKind::Ternary(lhs_tern) = &lhs.kind {
                        let lhs_is_short = lhs_tern.then_expr.is_none();
                        let incoming_is_short = parser.peek_kind() == Some(TokenKind::Colon);
                        if !(lhs_is_short && incoming_is_short) {
                            let span = parser.current_span();
                            parser.error(ParseError::Forbidden {
                                message: "Unparenthesized `a ? b : c ? d : e` is not supported. \
                                          Use parentheses to make the order explicit."
                                    .into(),
                                span,
                            });
                        }
                    }
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
                // Non-associative in PHP 8.0+; use TERNARY_BP + 1 to prevent
                // the else branch from consuming another ternary at the same level.
                // PHP grammar quirk: assignment can still appear in the else branch.
                // e.g., $a ? $b : $c = $d  →  $a ? $b : ($c = $d)
                let mut else_expr = parse_expr_bp(parser, TERNARY_BP + 1);
                if parser.current_kind().is_assignment_op() {
                    else_expr = parse_assign_continuation(parser, else_expr);
                }
                let span = lhs.span.merge(else_expr.span);
                lhs = Expr {
                    kind: ExprKind::Ternary(TernaryExpr {
                        condition: parser.alloc(lhs),
                        then_expr,
                        else_expr: parser.alloc(else_expr),
                    }),
                    span,
                };
                true
            }

            // Arrow operators (property/method access)
            TokenKind::Arrow | TokenKind::NullsafeArrow => {
                if 44u8 < min_bp {
                    break;
                }
                let is_nullsafe = kind == TokenKind::NullsafeArrow;
                if is_nullsafe {
                    let span = parser.current_span();
                    parser.require_version(PhpVersion::Php80, "nullsafe operator (?->)", span);
                }
                parser.advance(); // consume -> or ?->

                // Parse member name (identifier or keyword or variable for dynamic)
                let member = parse_member_name(parser);

                // Check if it's a method call
                if parser.check(TokenKind::LeftParen) {
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
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
                            let span = Span::new(lhs.span.start, parser.previous_end());
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
                true
            }

            _ => false,
        };

        if should_continue {
            continue;
        }

        // Assignment operators (right-associative, special handling)
        if kind.is_assignment_op() {
            if ASSIGNMENT_BP < min_bp {
                break;
            }
            // PHP rejects pre/post-increment/decrement as an assignment target at parse time.
            // e.g. `++$x = 1` and `$x++ = 1` → syntax error (same as PHP).
            if matches!(
                lhs.kind,
                ExprKind::UnaryPrefix(UnaryPrefixExpr {
                    op: UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement,
                    ..
                }) | ExprKind::UnaryPostfix(UnaryPostfixExpr {
                    op: UnaryPostfixOp::PostIncrement | UnaryPostfixOp::PostDecrement,
                    ..
                })
            ) {
                let span = parser.current_span();
                parser.error(ParseError::Forbidden {
                    message: "Cannot use increment/decrement as an assignment target.".into(),
                    span,
                });
            } else if !is_valid_assignment_target(&lhs.kind) {
                let span = parser.current_span();
                parser.error(ParseError::Forbidden {
                    message: "Cannot use expression as assignment target.".into(),
                    span,
                });
            }
            let op_token = parser.advance();

            let by_ref =
                op_token.kind == TokenKind::Equals && parser.eat(TokenKind::Ampersand).is_some();

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
                _ => unreachable!(
                    "is_assignment_op() guarantees one of the listed variants, got {:?}",
                    kind
                ),
            };
            // Right-associative: parse RHS with same bp
            let rhs = parse_expr_bp(parser, ASSIGNMENT_BP);
            let span = lhs.span.merge(rhs.span);
            lhs = Expr {
                kind: ExprKind::Assign(AssignExpr {
                    target: parser.alloc(lhs),
                    op,
                    value: parser.alloc(rhs),
                    by_ref,
                }),
                span,
            };
            continue;
        }

        // Double colon: Class::$prop, Class::method(), Class::CONST
        // bp=90: must parse through the bp=45 gate used by promoted-property defaults
        // (which only intends to block `{}` curly-brace subscript access, bp=44).
        if kind == TokenKind::DoubleColon {
            if 90u8 < min_bp {
                break;
            }
            parser.advance(); // consume ::

            // Check what follows ::
            if parser.check(TokenKind::Variable) {
                let token = parser.advance();
                let var_name = parser.variable_name(token);
                let var_span = token.span;

                if parser.check(TokenKind::LeftParen) {
                    // Dynamic static method call: Class::$method()
                    let method = parser.alloc(Expr {
                        kind: ExprKind::Variable(NameStr::Src(var_name)),
                        span: var_span,
                    });
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method,
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
                            lhs = Expr {
                                kind: ExprKind::StaticDynMethodCall(parser.alloc(
                                    StaticDynMethodCallExpr {
                                        class: parser.alloc(lhs),
                                        method,
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Static property: Class::$prop
                    let member = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::Src(var_name)),
                        span: var_span,
                    });
                    let span = Span::new(lhs.span.start, var_span.end);
                    lhs = Expr {
                        kind: ExprKind::StaticPropertyAccess(StaticAccessExpr {
                            class: parser.alloc(lhs),
                            member,
                        }),
                        span,
                    };
                }
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
                let brace_span = parser.current_span();
                parser.require_version(
                    PhpVersion::Php83,
                    "dynamic class constant fetch",
                    brace_span,
                );
                parser.advance(); // consume {
                let member = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                if parser.check(TokenKind::LeftParen) {
                    // Dynamic static method call: A::{'b'}()
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method: parser.alloc(member),
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let lhs_start = lhs.span.start;
                            let callee = Expr {
                                kind: ExprKind::ClassConstAccessDynamic {
                                    class: parser.alloc(lhs),
                                    member: parser.alloc(member),
                                },
                                span: Span::new(lhs_start, parser.previous_end()),
                            };
                            let span = Span::new(lhs_start, parser.previous_end());
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
                    let span = Span::new(lhs.span.start, parser.previous_end());
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
                        member: parser.alloc(Expr {
                            kind: ExprKind::Identifier(NameStr::Src("class")),
                            span: token.span,
                        }),
                    }),
                    span,
                };
            } else {
                // Static method call or class constant
                let (member_name, member_span) =
                    if let Some(result) = parser.eat_identifier_or_keyword() {
                        result
                    } else {
                        let span = parser.current_span();
                        parser.error(ParseError::Expected {
                            expected: "identifier".into(),
                            found: parser.current_kind(),
                            span,
                        });
                        (ERROR_PLACEHOLDER, span)
                    };

                if parser.check(TokenKind::LeftParen) {
                    let method = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::Src(member_name)),
                        span: member_span,
                    });
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method,
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = Span::new(lhs.span.start, parser.previous_end());
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCall(parser.alloc(
                                    StaticMethodCallExpr {
                                        class: parser.alloc(lhs),
                                        method,
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Class constant
                    let member = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::Src(member_name)),
                        span: member_span,
                    });
                    let span = Span::new(lhs.span.start, parser.previous_end());
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                            class: parser.alloc(lhs),
                            member,
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
            let span = Span::new(lhs.span.start, parser.previous_end());
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
            if 44u8 < min_bp || parser.no_brace_subscript {
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
            let span = Span::new(lhs.span.start, parser.previous_end());
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
            if NULL_COALESCE_LEFT_BP < min_bp {
                break;
            }
            parser.advance();
            // PHP grammar quirk: the right operand of ?? can contain assignment but not
            // unparenthesized ternary.  Use TERNARY_BP + 1 to block ternary, then
            // explicitly consume any following assignment operator.
            // e.g. `$a ?? $b = $c`  →  `$a ?? ($b = $c)`
            // e.g. `$a ?? $b ? $c : $d`  →  `($a ?? $b) ? $c : $d`
            let mut rhs = parse_expr_bp(parser, TERNARY_BP + 1);
            if parser.current_kind().is_assignment_op() {
                rhs = parse_assign_continuation(parser, rhs);
            }
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

        // Infix binary operators
        if let Some((left_bp, right_bp)) = precedence::infix_binding_power(kind) {
            if left_bp < min_bp {
                break;
            }
            // PHP 8.0+: chaining non-associative operators within the same precedence group
            // is a fatal error (e.g. `1 < 2 < 3`, `$a === $b == $c`).
            // Cross-group chains (e.g. `$a > $b == $c`) and instanceof chains are
            // allowed by PHP and must not be flagged here.
            if parser.version >= PhpVersion::Php80 {
                if let Some(current_level) = nonassoc_chain_level_for_token(kind) {
                    if matches!(&lhs.kind, ExprKind::Binary(b) if nonassoc_chain_level_for_op(b.op) == Some(current_level))
                    {
                        let span = parser.current_span();
                        parser.error(ParseError::Forbidden {
                            message:
                                "Chaining non-associative operators requires explicit parentheses."
                                    .into(),
                            span,
                        });
                    }
                }
            }
            let op_token = parser.advance();
            if op_token.kind == TokenKind::PipeArrow {
                parser.require_version(PhpVersion::Php85, "pipe operator (|>)", op_token.span);
            }
            let op = token_to_binary_op(op_token.kind).unwrap_or_else(|| {
                unreachable!(
                    "infix_binding_power returned Some for {:?} but token_to_binary_op returned None",
                    op_token.kind
                )
            });
            // PHP grammar quirk: assignment escapes rightward through every binary operator.
            // e.g. `$a && $b = $c`   →  `$a && ($b = $c)`
            //      `$a + $b + $c = 5` → `$a + $b + ($c = 5)`
            // parse_expr_bp with right_bp > ASSIGNMENT_BP won't consume the assignment,
            // so we explicitly apply it here (same pattern as the `??` branch above).
            let mut rhs = parse_expr_bp(parser, right_bp);
            if parser.current_kind().is_assignment_op() {
                rhs = parse_assign_continuation(parser, rhs);
            }
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

    parser.expr_depth -= 1;
    lhs
}

/// Parse a member name after -> or ?->. Accepts identifiers and semi-reserved keywords.
fn parse_member_name<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    // Plain identifier or any keyword PHP allows as a member name.
    if parser.check(TokenKind::Identifier) || parser.is_semi_reserved_keyword() {
        let token = parser.advance();
        let text = &parser.source[token.span.start as usize..token.span.end as usize];
        return Expr {
            kind: ExprKind::Identifier(NameStr::Src(text)),
            span: token.span,
        };
    }
    match parser.current_kind() {
        // Dynamic: $obj->$var
        TokenKind::Variable => {
            let token = parser.advance();
            let name = parser.variable_name(token);
            Expr {
                kind: ExprKind::Variable(NameStr::Src(name)),
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
        // Dynamic: $obj->${expr} — variable-variable as member name.
        // Also bare $obj->$$var chain.
        TokenKind::Dollar => {
            let start = parser.start_span();
            parser.advance(); // consume $
            let inner = if parser.eat(TokenKind::LeftBrace).is_some() {
                let e = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                e
            } else {
                parse_atom(parser)
            };
            let span = Span::new(start, parser.previous_end());
            Expr {
                kind: ExprKind::VariableVariable(parser.alloc(inner)),
                span,
            }
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

fn token_to_binary_op(kind: TokenKind) -> Option<BinaryOp> {
    match kind {
        TokenKind::Plus => Some(BinaryOp::Add),
        TokenKind::Minus => Some(BinaryOp::Sub),
        TokenKind::Star => Some(BinaryOp::Mul),
        TokenKind::Slash => Some(BinaryOp::Div),
        TokenKind::Percent => Some(BinaryOp::Mod),
        TokenKind::StarStar => Some(BinaryOp::Pow),
        TokenKind::Dot => Some(BinaryOp::Concat),
        TokenKind::EqualsEquals => Some(BinaryOp::Equal),
        TokenKind::BangEquals => Some(BinaryOp::NotEqual),
        TokenKind::EqualsEqualsEquals => Some(BinaryOp::Identical),
        TokenKind::BangEqualsEquals => Some(BinaryOp::NotIdentical),
        TokenKind::LessThan => Some(BinaryOp::Less),
        TokenKind::GreaterThan => Some(BinaryOp::Greater),
        TokenKind::LessThanEquals => Some(BinaryOp::LessOrEqual),
        TokenKind::GreaterThanEquals => Some(BinaryOp::GreaterOrEqual),
        TokenKind::Spaceship => Some(BinaryOp::Spaceship),
        TokenKind::AmpersandAmpersand => Some(BinaryOp::BooleanAnd),
        TokenKind::PipePipe => Some(BinaryOp::BooleanOr),
        TokenKind::Ampersand => Some(BinaryOp::BitwiseAnd),
        TokenKind::Pipe => Some(BinaryOp::BitwiseOr),
        TokenKind::Caret => Some(BinaryOp::BitwiseXor),
        TokenKind::ShiftLeft => Some(BinaryOp::ShiftLeft),
        TokenKind::ShiftRight => Some(BinaryOp::ShiftRight),
        TokenKind::And => Some(BinaryOp::LogicalAnd),
        TokenKind::Or => Some(BinaryOp::LogicalOr),
        TokenKind::Xor => Some(BinaryOp::LogicalXor),
        TokenKind::Instanceof => Some(BinaryOp::Instanceof),
        TokenKind::PipeArrow => Some(BinaryOp::Pipe),
        _ => None,
    }
}
