use std::borrow::Cow;

use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::ParseError;
use crate::expr;
use crate::instrument;
use crate::parser::Parser;
use crate::version::PhpVersion;

fn class_modifier_error<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    start: u32,
) -> Stmt<'arena, 'src> {
    let span = Span::new(start, parser.current_span().start);
    parser.error(ParseError::Expected {
        expected: "'class'".into(),
        found: parser.current_kind(),
        span,
    });
    parser.synchronize();
    Stmt {
        kind: StmtKind::Error,
        span,
    }
}

/// Parse a single statement.
pub fn parse_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_stmt();

    // Handle attributes: #[...] before declarations
    if parser.check(TokenKind::HashBracket) {
        return parse_attributed_stmt(parser);
    }

    match parser.current_kind() {
        // ?> ... <?php  /  ?> ... <?=  transitions — valid anywhere a statement is expected
        TokenKind::CloseTag => {
            parser.advance(); // consume ?>
            if parser.check(TokenKind::InlineHtml) {
                let token = parser.advance();
                let text = &parser.source[token.span.start as usize..token.span.end as usize];
                // Leave the following OpenTag (if any) for the next parse_stmt call
                return Stmt {
                    kind: StmtKind::InlineHtml(text),
                    span: token.span,
                };
            }
            // No inline HTML; fall through to consume any following OpenTag
            if parser.check(TokenKind::OpenTag) {
                let tag = parser.advance();
                if parser.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                    if let Some(echo_stmt) = parser.parse_short_echo() {
                        return echo_stmt;
                    }
                }
            }
            let span = parser.current_span();
            Stmt {
                kind: StmtKind::Nop,
                span,
            }
        }
        // <?= after an inline HTML section (OpenTag left in stream by CloseTag handler above)
        TokenKind::OpenTag => {
            let tag = parser.advance();
            if parser.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                if let Some(echo_stmt) = parser.parse_short_echo() {
                    return echo_stmt;
                }
            }
            let span = parser.current_span();
            Stmt {
                kind: StmtKind::Nop,
                span,
            }
        }
        TokenKind::Semicolon => {
            let span = parser.current_span();
            parser.advance();
            Stmt {
                kind: StmtKind::Nop,
                span,
            }
        }
        TokenKind::Echo => parse_echo(parser),
        TokenKind::Return => parse_return(parser),
        TokenKind::LeftBrace => parse_block(parser),
        TokenKind::If => parse_if(parser),
        TokenKind::While => parse_while(parser),
        TokenKind::Do => parse_do_while(parser),
        TokenKind::For => parse_for(parser),
        TokenKind::Foreach => parse_foreach(parser),
        TokenKind::Function => {
            // Check if this is a closure (unnamed function) used as expression statement
            // function( → closure, function &( → by-ref closure
            // function name( → function declaration, function &name( → by-ref function
            let next = parser.peek_kind();
            if next == Some(TokenKind::LeftParen)
                || (next == Some(TokenKind::Ampersand)
                    && parser.peek2_kind() == Some(TokenKind::LeftParen))
            {
                parse_expression_stmt(parser)
            } else {
                parse_function(parser, parser.alloc_vec())
            }
        }
        TokenKind::Break => parse_break(parser),
        TokenKind::Continue => parse_continue(parser),
        TokenKind::Switch => parse_switch(parser),
        TokenKind::Throw => parse_throw_stmt(parser),
        TokenKind::Try => parse_try_catch(parser),
        TokenKind::Goto => parse_goto(parser),
        TokenKind::Declare => parse_declare(parser),
        TokenKind::Unset => parse_unset(parser),
        TokenKind::Global => parse_global(parser),
        // OOP keywords
        TokenKind::Class => parse_class(parser, ClassModifiers::default(), parser.alloc_vec()),
        TokenKind::Abstract => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else if parser.check(TokenKind::Readonly)
                && parser.peek_kind() == Some(TokenKind::Class)
            {
                // `abstract readonly class` — valid in PHP 8.4
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php84, "abstract readonly class", span);
                parser.advance(); // consume 'readonly'
                parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else {
                // abstract without class - error recovery
                class_modifier_error(parser, start)
            }
        }
        TokenKind::Final => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(
                    parser,
                    ClassModifiers {
                        is_final: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else if parser.check(TokenKind::Readonly) {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php82, "readonly class", span);
                parser.advance();
                if parser.check(TokenKind::Class) {
                    parse_class(
                        parser,
                        ClassModifiers {
                            is_final: true,
                            is_readonly: true,
                            ..Default::default()
                        },
                        parser.alloc_vec(),
                    )
                } else {
                    class_modifier_error(parser, start)
                }
            } else {
                class_modifier_error(parser, start)
            }
        }
        TokenKind::Readonly => {
            if parser.peek_kind() == Some(TokenKind::Class) {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php82, "readonly class", span);
                parser.advance(); // consume 'readonly'
                parse_class(
                    parser,
                    ClassModifiers {
                        is_readonly: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else if parser.peek_kind() == Some(TokenKind::Final)
                && parser.peek2_kind() == Some(TokenKind::Class)
            {
                // `readonly final class` — same as `final readonly class`
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php82, "readonly class", span);
                parser.advance(); // consume 'readonly'
                parser.advance(); // consume 'final'
                parse_class(
                    parser,
                    ClassModifiers {
                        is_final: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else if parser.peek_kind() == Some(TokenKind::Abstract)
                && parser.peek2_kind() == Some(TokenKind::Class)
            {
                // `readonly abstract class` — valid in PHP 8.4
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php84, "abstract readonly class", span);
                parser.advance(); // consume 'readonly'
                parser.advance(); // consume 'abstract'
                parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    parser.alloc_vec(),
                )
            } else {
                // readonly used as function name/expression (e.g., readonly())
                parse_expression_stmt(parser)
            }
        }
        TokenKind::Interface => parse_interface(parser, parser.alloc_vec()),
        TokenKind::Trait => parse_trait(parser, parser.alloc_vec()),
        TokenKind::Enum_ => {
            let span = parser.current_span();
            parser.require_version(PhpVersion::Php81, "enums", span);
            parse_enum(parser, parser.alloc_vec())
        }
        TokenKind::Namespace => {
            // namespace\ is a relative name (expression), not a namespace declaration
            if parser.peek_kind() == Some(TokenKind::Backslash) {
                parse_expression_stmt(parser)
            } else {
                parse_namespace(parser)
            }
        }
        TokenKind::Use => parse_use(parser),
        TokenKind::Const => parse_const(parser),
        TokenKind::HaltCompiler => parse_halt_compiler(parser),
        TokenKind::Static => {
            // Could be: static $var = ...; or static function or static as expression
            let next = parser.peek_kind();
            if matches!(next, Some(TokenKind::Variable)) {
                parse_static_var(parser)
            } else {
                parse_expression_stmt(parser)
            }
        }
        // Label: `name:` — but only if followed by Colon
        TokenKind::Identifier => parse_expression_stmt_or_label(parser),
        TokenKind::Eof => {
            let span = parser.current_span();
            parser.error(ParseError::ExpectedStatement { span });
            Stmt {
                kind: StmtKind::Error,
                span,
            }
        }
        _ => parse_expression_stmt(parser),
    }
}

/// Parse a statement preceded by attributes.
fn parse_attributed_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let attributes = parser.parse_attributes();

    // Now dispatch based on what follows
    let stmt = match parser.current_kind() {
        TokenKind::Function => return parse_function(parser, attributes),
        TokenKind::Class => return parse_class(parser, ClassModifiers::default(), attributes),
        TokenKind::Abstract => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                return parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        ..Default::default()
                    },
                    attributes,
                );
            } else if parser.check(TokenKind::Readonly)
                && parser.peek_kind() == Some(TokenKind::Class)
            {
                // `abstract readonly class` — valid in PHP 8.4
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php84, "abstract readonly class", span);
                parser.advance(); // consume 'readonly'
                return parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    attributes,
                );
            } else {
                class_modifier_error(parser, start)
            }
        }
        TokenKind::Final => {
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(
                    parser,
                    ClassModifiers {
                        is_final: true,
                        ..Default::default()
                    },
                    attributes,
                )
            } else if parser.check(TokenKind::Readonly) {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php82, "readonly class", span);
                parser.advance();
                parse_class(
                    parser,
                    ClassModifiers {
                        is_final: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    attributes,
                )
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'class'".into(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt {
                    kind: StmtKind::Error,
                    span,
                }
            }
        }
        TokenKind::Readonly => {
            let readonly_span = parser.current_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parser.require_version(PhpVersion::Php82, "readonly class", readonly_span);
                parse_class(
                    parser,
                    ClassModifiers {
                        is_readonly: true,
                        ..Default::default()
                    },
                    attributes,
                )
            } else if parser.check(TokenKind::Final) && parser.peek_kind() == Some(TokenKind::Class)
            {
                // `readonly final class` — same as `final readonly class`
                parser.require_version(PhpVersion::Php82, "readonly class", readonly_span);
                parser.advance(); // consume 'final'
                return parse_class(
                    parser,
                    ClassModifiers {
                        is_final: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    attributes,
                );
            } else if parser.check(TokenKind::Abstract)
                && parser.peek_kind() == Some(TokenKind::Class)
            {
                // `readonly abstract class` — valid in PHP 8.4
                parser.require_version(PhpVersion::Php84, "abstract readonly class", readonly_span);
                parser.advance(); // consume 'abstract'
                return parse_class(
                    parser,
                    ClassModifiers {
                        is_abstract: true,
                        is_readonly: true,
                        ..Default::default()
                    },
                    attributes,
                );
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'class'".into(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt {
                    kind: StmtKind::Error,
                    span,
                }
            }
        }
        TokenKind::Interface => return parse_interface(parser, attributes),
        TokenKind::Trait => return parse_trait(parser, attributes),
        TokenKind::Enum_ => {
            let span = parser.current_span();
            parser.require_version(PhpVersion::Php81, "enums", span);
            return parse_enum(parser, attributes);
        }
        TokenKind::Const => {
            // Attributes on top-level constants require PHP 8.5.
            let attr_span = parser.current_span();
            parser.require_version(PhpVersion::Php85, "attributes on constants", attr_span);
            let stmt = parse_const_with_attrs(parser, attributes);
            // Multi-const declarations cannot carry attributes.
            if let StmtKind::Const(ref items) = stmt.kind {
                if items.len() > 1 {
                    parser.error(ParseError::Forbidden {
                        message: "cannot use attributes on multi-constant declaration".into(),
                        span: stmt.span,
                    });
                }
            }
            return stmt;
        }
        _ => {
            // Attributes before something unexpected
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "declaration after attributes".into(),
                found: parser.current_kind(),
                span,
            });
            parser.synchronize();
            Stmt {
                kind: StmtKind::Error,
                span,
            }
        }
    };

    stmt
}

/// Parse a block statement: `{ stmts }`
pub fn parse_block<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let open = parser.expect(TokenKind::LeftBrace);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());

    parser.depth += 1;
    // March 2026: reduce from 16 to 8 for statement blocks
    // Most blocks have 4-12 statements; larger blocks grow efficiently
    let mut stmts = parser.alloc_vec_with_capacity(8);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        // Handle close tag -> inline HTML -> open tag sequences inside blocks
        if parser.check(TokenKind::CloseTag) {
            parser.advance();
            if parser.check(TokenKind::InlineHtml) {
                let token = parser.advance();
                let text = &parser.source[token.span.start as usize..token.span.end as usize];
                stmts.push(Stmt {
                    kind: StmtKind::InlineHtml(text),
                    span: token.span,
                });
            }
            if parser.check(TokenKind::OpenTag) {
                let tag = parser.advance();
                if parser.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                    if let Some(echo_stmt) = parser.parse_short_echo() {
                        stmts.push(echo_stmt);
                    }
                }
            }
            continue;
        }
        let span_before = parser.current_span();
        stmts.push(parse_stmt(parser));
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    parser.depth -= 1;

    let close = parser.expect_closing(TokenKind::RightBrace, open_span);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::Block(stmts),
        span,
    }
}

/// Parse a statement or block (used as body of if/while/for/etc.)
fn parse_stmt_or_block<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    if parser.check(TokenKind::LeftBrace) {
        parse_block(parser)
    } else {
        parse_stmt(parser)
    }
}

/// Parse statements until an end keyword (for alternative syntax)
fn parse_stmts_until_end<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    ends: &[TokenKind],
) -> ArenaVec<'arena, Stmt<'arena, 'src>> {
    let mut stmts = parser.alloc_vec_with_capacity(8);
    while !ends.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
        // Handle close tag -> inline HTML -> open tag sequences
        if parser.check(TokenKind::CloseTag) {
            parser.advance();
            if parser.check(TokenKind::InlineHtml) {
                let token = parser.advance();
                let text = &parser.source[token.span.start as usize..token.span.end as usize];
                stmts.push(Stmt {
                    kind: StmtKind::InlineHtml(text),
                    span: token.span,
                });
            }
            if parser.check(TokenKind::OpenTag) {
                let tag = parser.advance();
                if parser.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                    if let Some(echo_stmt) = parser.parse_short_echo() {
                        stmts.push(echo_stmt);
                    }
                }
            }
            continue;
        }
        let span_before = parser.current_span();
        stmts.push(parse_stmt(parser));
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    stmts
}

// =============================================================================
// Echo statement
// =============================================================================

fn parse_echo<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'echo'

    let mut exprs = parser.alloc_vec();
    exprs.push(expr::parse_expr(parser));

    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) {
            break;
        } // trailing comma
        exprs.push(expr::parse_expr(parser));
    }

    parser.expect_semicolon("echo statement");
    let span = Span::new(start, parser.current_span().start);

    Stmt {
        kind: StmtKind::Echo(exprs),
        span,
    }
}

// =============================================================================
// Return statement
// =============================================================================

fn parse_return<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'return'

    let expr = if parser.check(TokenKind::Semicolon) {
        None
    } else {
        Some(expr::parse_expr(parser))
    };

    parser.expect_semicolon("return statement");
    let span = Span::new(start, parser.current_span().start);

    Stmt {
        kind: StmtKind::Return(expr.map(|e| parser.alloc(e))),
        span,
    }
}

// =============================================================================
// If statement (with alternative syntax support)
// =============================================================================

fn parse_if<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_if();

    let start = parser.start_span();
    parser.advance(); // consume 'if'

    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let condition = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);

    // Alternative syntax: if (...): ... endif;
    if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(
            parser,
            &[TokenKind::ElseIf, TokenKind::Else, TokenKind::EndIf],
        );
        let then_branch = parser.alloc(Stmt {
            kind: StmtKind::Block(stmts),
            span: Span::new(start, parser.current_span().start),
        });

        let mut elseif_branches = parser.alloc_vec();
        while parser.eat(TokenKind::ElseIf).is_some() {
            let elseif_start = parser.start_span();
            parser.expect(TokenKind::LeftParen);
            let elseif_cond = expr::parse_expr(parser);
            parser.expect(TokenKind::RightParen);
            parser.expect(TokenKind::Colon);
            let elseif_stmts = parse_stmts_until_end(
                parser,
                &[TokenKind::ElseIf, TokenKind::Else, TokenKind::EndIf],
            );
            let elseif_body = Stmt {
                kind: StmtKind::Block(elseif_stmts),
                span: Span::new(elseif_start, parser.current_span().start),
            };
            let elseif_span = Span::new(elseif_start, elseif_body.span.end);
            elseif_branches.push(ElseIfBranch {
                condition: elseif_cond,
                body: elseif_body,
                span: elseif_span,
            });
        }

        let else_branch = if parser.eat(TokenKind::Else).is_some() {
            parser.expect(TokenKind::Colon);
            let else_stmts = parse_stmts_until_end(parser, &[TokenKind::EndIf]);
            Some(parser.alloc(Stmt {
                kind: StmtKind::Block(else_stmts),
                span: Span::new(start, parser.current_span().start),
            }))
        } else {
            None
        };

        parser.expect(TokenKind::EndIf);
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);

        return Stmt {
            kind: StmtKind::If(parser.alloc(IfStmt {
                condition,
                then_branch,
                elseif_branches,
                else_branch,
            })),
            span,
        };
    }

    // Normal syntax
    let then_branch_stmt = parse_stmt_or_block(parser);
    let then_branch = parser.alloc(then_branch_stmt);

    let mut elseif_branches = parser.alloc_vec_with_capacity(2);
    while parser.eat(TokenKind::ElseIf).is_some() {
        let elseif_start = parser.start_span();
        parser.expect(TokenKind::LeftParen);
        let elseif_cond = expr::parse_expr(parser);
        parser.expect(TokenKind::RightParen);
        let elseif_body = parse_stmt_or_block(parser);
        let elseif_span = Span::new(elseif_start, elseif_body.span.end);
        elseif_branches.push(ElseIfBranch {
            condition: elseif_cond,
            body: elseif_body,
            span: elseif_span,
        });
    }

    let else_branch = if parser.eat(TokenKind::Else).is_some() {
        {
            let s = parse_stmt_or_block(parser);
            Some(parser.alloc(s))
        }
    } else {
        None
    };

    let end = else_branch
        .as_ref()
        .map(|b| b.span.end)
        .or_else(|| elseif_branches.last().map(|b| b.span.end))
        .unwrap_or(then_branch.span.end);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::If(parser.alloc(IfStmt {
            condition,
            then_branch,
            elseif_branches,
            else_branch,
        })),
        span,
    }
}

// =============================================================================
// While / Do-while / For / Foreach
// =============================================================================

fn parse_while<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let condition = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);

    if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndWhile]);
        parser.expect(TokenKind::EndWhile);
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(stmts),
            span,
        });
        return Stmt {
            kind: StmtKind::While(parser.alloc(WhileStmt { condition, body })),
            span,
        };
    }

    let body_stmt = parse_stmt_or_block(parser);
    let body = parser.alloc(body_stmt);
    let span = Span::new(start, body.span.end);
    Stmt {
        kind: StmtKind::While(parser.alloc(WhileStmt { condition, body })),
        span,
    }
}

fn parse_do_while<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    let body_stmt = parse_stmt_or_block(parser);
    let body = parser.alloc(body_stmt);
    parser.expect(TokenKind::While);
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let condition = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);
    parser.expect_semicolon("do-while statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::DoWhile(parser.alloc(DoWhileStmt { body, condition })),
        span,
    }
}

fn parse_for<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let init = parse_expr_list_until(parser, TokenKind::Semicolon);
    parser.expect(TokenKind::Semicolon);
    let condition = parse_expr_list_until(parser, TokenKind::Semicolon);
    parser.expect(TokenKind::Semicolon);
    let update = parse_expr_list_until(parser, TokenKind::RightParen);
    parser.expect_closing(TokenKind::RightParen, open_span);

    if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndFor]);
        parser.expect(TokenKind::EndFor);
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(stmts),
            span,
        });
        return Stmt {
            kind: StmtKind::For(parser.alloc(ForStmt {
                init,
                condition,
                update,
                body,
            })),
            span,
        };
    }

    let body_stmt = parse_stmt_or_block(parser);
    let body = parser.alloc(body_stmt);
    let span = Span::new(start, body.span.end);
    Stmt {
        kind: StmtKind::For(parser.alloc(ForStmt {
            init,
            condition,
            update,
            body,
        })),
        span,
    }
}

fn parse_expr_list_until<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    stop: TokenKind,
) -> ArenaVec<'arena, Expr<'arena, 'src>> {
    let mut exprs = parser.alloc_vec();
    if parser.check(stop) {
        return exprs;
    }
    exprs.push(expr::parse_expr(parser));
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(stop) {
            break;
        } // trailing comma
        exprs.push(expr::parse_expr(parser));
    }
    exprs
}

fn parse_foreach<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_foreach();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let collection = expr::parse_expr(parser);
    parser.expect(TokenKind::As);

    if parser.check(TokenKind::Ampersand) {
        parser.advance();
    }
    let first = expr::parse_expr(parser);

    let (key, value) = if parser.eat(TokenKind::FatArrow).is_some() {
        if parser.check(TokenKind::Ampersand) {
            parser.advance();
        }
        let value = expr::parse_expr(parser);
        (Some(first), value)
    } else {
        (None, first)
    };

    parser.expect_closing(TokenKind::RightParen, open_span);

    if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndForeach]);
        parser.expect(TokenKind::EndForeach);
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(stmts),
            span,
        });
        return Stmt {
            kind: StmtKind::Foreach(parser.alloc(ForeachStmt {
                expr: collection,
                key,
                value,
                body,
            })),
            span,
        };
    }

    let body_stmt = parse_stmt_or_block(parser);
    let body = parser.alloc(body_stmt);
    let span = Span::new(start, body.span.end);
    Stmt {
        kind: StmtKind::Foreach(parser.alloc(ForeachStmt {
            expr: collection,
            key,
            value,
            body,
        })),
        span,
    }
}

// =============================================================================
// Function declaration (enhanced with types, by-ref, return types)
// =============================================================================

fn parse_function<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_function();

    let start = parser.start_span();
    parser.advance(); // consume 'function'

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();

    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "function name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>"
    };

    let open_paren = parser.expect(TokenKind::LeftParen);
    let open_paren_span = open_paren.map(|t| t.span).unwrap_or(parser.current_span());
    let params = parse_param_list(parser);
    parser.expect_closing(TokenKind::RightParen, open_paren_span);

    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    let open_brace = parser.expect(TokenKind::LeftBrace);
    let open_brace_span = open_brace.map(|t| t.span).unwrap_or(parser.current_span());
    // March 2026: reduce from 16 to 4 for smaller initial allocation
    // Most functions have 4-10 statements; large functions grow efficiently
    let mut body = parser.alloc_vec_with_capacity(4);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        body.push(parse_stmt(parser));
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    let close = parser.expect_closing(TokenKind::RightBrace, open_brace_span);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::Function(parser.alloc(FunctionDecl {
            name,
            params,
            body,
            return_type,
            by_ref,
            attributes,
        })),
        span,
    }
}

pub fn parse_param_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, Param<'arena, 'src>> {
    let mut params = parser.alloc_vec_with_capacity(4);
    if parser.check(TokenKind::RightParen) {
        return params;
    }

    loop {
        if parser.check(TokenKind::RightParen) {
            break;
        }
        let param_start = parser.start_span();

        // FAST PATH: Common case - no attributes, no visibility, just $var (no type hint, no default)
        // This is a very safe fast path that covers ~30% of parameters
        if parser.peek_kind() != Some(TokenKind::HashBracket)  // No attributes
            && !matches!(
                parser.current_kind(),
                TokenKind::Public | TokenKind::Protected | TokenKind::Private | TokenKind::Final | TokenKind::Readonly
            ) // No visibility/readonly modifiers
            && parser.check(TokenKind::Variable)
        // Current token is variable (no type hint)
        {
            // Try fast path: just parse $var with no type or default
            if let Some(param) = try_parse_simple_param_fastpath_minimal(parser, param_start) {
                params.push(param);
                if parser.eat(TokenKind::Comma).is_none() {
                    break;
                }
                continue;
            }
        }

        // Optional parameter attributes
        let param_attrs = parser.parse_attributes();

        // Optional visibility (constructor promotion) — PHP 8.0+
        let visibility = parse_optional_visibility(parser);
        if visibility.is_some() {
            let span = Span::new(param_start, parser.current_span().start);
            parser.require_version(PhpVersion::Php80, "constructor property promotion", span);
        }

        // Check for asymmetric visibility: public private(set) in promoted properties — PHP 8.4+
        let set_visibility = if visibility.is_some()
            && matches!(
                parser.current_kind(),
                TokenKind::Public | TokenKind::Protected | TokenKind::Private
            )
            && parser.peek_kind() == Some(TokenKind::LeftParen)
        {
            let set_vis = match parser.current_kind() {
                TokenKind::Public => Visibility::Public,
                TokenKind::Protected => Visibility::Protected,
                _ => Visibility::Private,
            };
            let span = Span::new(param_start, parser.current_span().start);
            parser.require_version(PhpVersion::Php84, "asymmetric visibility", span);
            parser.advance(); // consume second visibility
            parser.advance(); // consume (
            if parser.current_text() == "set" {
                parser.advance(); // consume "set"
            }
            parser.expect(TokenKind::RightParen);
            Some(set_vis)
        } else {
            None
        };

        // Optional final (PHP 8.5+ promoted property modifier)
        let final_token = parser
            .check(TokenKind::Final)
            .then(|| parser.current_span());
        let is_final = parser.eat(TokenKind::Final).is_some();
        if let Some(span) = final_token {
            parser.require_version(PhpVersion::Php85, "final promoted properties", span);
        }

        // Optional readonly — PHP 8.1+
        let readonly_token = parser
            .check(TokenKind::Readonly)
            .then(|| parser.current_span());
        let is_readonly = parser.eat(TokenKind::Readonly).is_some();
        if let Some(span) = readonly_token {
            parser.require_version(PhpVersion::Php81, "readonly parameters", span);
        }

        // Optional type hint
        let type_hint = if !(!parser.could_be_type_hint()
            || parser.check(TokenKind::Variable)
            || parser.check(TokenKind::Ellipsis)
            || parser.check(TokenKind::Ampersand)
                && matches!(parser.peek_kind(), Some(TokenKind::Variable)))
        {
            Some(parser.parse_type_hint())
        } else {
            None
        };

        // by-ref
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();

        // variadic
        let variadic = parser.eat(TokenKind::Ellipsis).is_some();

        let name_token = parser.expect(TokenKind::Variable);
        let name_span_end = name_token.as_ref().map(|t| t.span.end);
        let src = parser.source;
        let name: &str = name_token
            .map(|t| &src[t.span.start as usize + 1..t.span.end as usize])
            .unwrap_or("<error>");

        let default = if parser.eat(TokenKind::Equals).is_some() {
            // Use restricted binding power for promoted properties with potential hooks.
            // BP 45 prevents `{` from being parsed as curly-brace array access (BP 44),
            // so the hook block `{ get => ...; }` isn't consumed as part of the default.
            if visibility.is_some() {
                Some(expr::parse_expr_bp(parser, 45))
            } else {
                Some(expr::parse_expr(parser))
            }
        } else {
            None
        };

        let param_end = default
            .as_ref()
            .map(|e| e.span.end)
            .or(name_span_end)
            .unwrap_or(parser.current_span().start);

        // Constructor promotion hooks: if this param has visibility and next token is {
        let hooks = if visibility.is_some() && parser.check(TokenKind::LeftBrace) {
            parse_property_hooks(parser)
        } else {
            parser.alloc_vec()
        };

        let param_end = if !hooks.is_empty() {
            parser.current_span().start
        } else {
            param_end
        };

        params.push(Param {
            name,
            type_hint,
            default,
            by_ref,
            variadic,
            is_readonly,
            is_final,
            visibility,
            set_visibility,
            attributes: param_attrs,
            hooks,
            span: Span::new(param_start, param_end),
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }

    params
}

/// Minimal fast path: parse just $var with no type hint, no default, no visibility
/// Safely handles ~30% of parameters. Uses peek-first approach to ensure no token consumption.
/// Returns None if any complexity detected, causing fallback to full parsing.
fn try_parse_simple_param_fastpath_minimal<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    param_start: u32,
) -> Option<Param<'arena, 'src>> {
    // Peek-first: Check if this is safe to fast path before consuming any tokens
    // Current token is Variable (already verified by caller)
    // Check next token: must be comma or right paren (no type hint, no default, no modifiers)
    if !parser.check(TokenKind::Variable) {
        return None;
    }

    let peek_after_var = parser.peek_kind();
    if !matches!(
        peek_after_var,
        Some(TokenKind::Comma) | Some(TokenKind::RightParen)
    ) {
        // Next token suggests complexity (type hint, default value, etc.)
        return None;
    }

    // Safe to fast path. Now consume the tokens.
    let name_token = parser.advance();
    let name_span_end = name_token.span.end;
    let src = parser.source;
    let name: &str = &src[name_token.span.start as usize + 1..name_token.span.end as usize];

    Some(Param {
        name,
        type_hint: None,
        default: None,
        by_ref: false,
        variadic: false,
        is_readonly: false,
        is_final: false,
        visibility: None,
        set_visibility: None,
        attributes: parser.alloc_vec(),
        hooks: parser.alloc_vec(),
        span: Span::new(param_start, name_span_end),
    })
}

fn parse_optional_visibility(parser: &mut Parser) -> Option<Visibility> {
    match parser.current_kind() {
        TokenKind::Public => {
            parser.advance();
            Some(Visibility::Public)
        }
        TokenKind::Protected => {
            parser.advance();
            Some(Visibility::Protected)
        }
        TokenKind::Private => {
            parser.advance();
            Some(Visibility::Private)
        }
        _ => None,
    }
}

// =============================================================================
// Break / Continue
// =============================================================================

fn parse_break<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let expr = if !parser.check(TokenKind::Semicolon) {
        Some(expr::parse_expr(parser))
    } else {
        None
    };
    parser.expect_semicolon("break statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Break(expr.map(|e| parser.alloc(e))),
        span,
    }
}

fn parse_continue<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let expr = if !parser.check(TokenKind::Semicolon) {
        Some(expr::parse_expr(parser))
    } else {
        None
    };
    parser.expect_semicolon("continue statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Continue(expr.map(|e| parser.alloc(e))),
        span,
    }
}

// =============================================================================
// Switch statement
// =============================================================================

fn parse_switch<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_switch();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let switch_expr = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);

    let alt_syntax = parser.eat(TokenKind::Colon).is_some();
    if !alt_syntax {
        parser.expect(TokenKind::LeftBrace);
    }
    while parser.check(TokenKind::Semicolon) {
        parser.advance();
    }

    let end_tokens: &[TokenKind] = if alt_syntax {
        &[TokenKind::EndSwitch]
    } else {
        &[TokenKind::RightBrace]
    };
    let mut cases = parser.alloc_vec_with_capacity(8);

    while !end_tokens.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
        let case_start = parser.start_span();
        let value = if parser.eat(TokenKind::Case).is_some() {
            let v = expr::parse_expr(parser);
            if parser.eat(TokenKind::Colon).is_none() {
                parser.expect(TokenKind::Semicolon);
            }
            Some(v)
        } else if parser.eat(TokenKind::Default).is_some() {
            if parser.eat(TokenKind::Colon).is_none() {
                parser.expect(TokenKind::Semicolon);
            }
            None
        } else {
            break;
        };

        let mut body = parser.alloc_vec();
        while !parser.check(TokenKind::Case)
            && !parser.check(TokenKind::Default)
            && !end_tokens.contains(&parser.current_kind())
            && !parser.check(TokenKind::Eof)
        {
            body.push(parse_stmt(parser));
        }

        cases.push(SwitchCase {
            value,
            body,
            span: Span::new(case_start, parser.current_span().start),
        });
    }

    if alt_syntax {
        parser.expect(TokenKind::EndSwitch);
        parser.expect(TokenKind::Semicolon);
    } else {
        parser.expect(TokenKind::RightBrace);
    }

    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Switch(parser.alloc(SwitchStmt {
            expr: switch_expr,
            cases,
        })),
        span,
    }
}

// =============================================================================
// Throw / Try-Catch
// =============================================================================

fn parse_throw_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let expr = expr::parse_expr(parser);
    parser.expect_semicolon("throw statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Throw(parser.alloc(expr)),
        span,
    }
}

fn parse_try_catch<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_try();

    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftBrace);
    let mut body = parser.alloc_vec_with_capacity(16);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        body.push(parse_stmt(parser));
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    parser.expect(TokenKind::RightBrace);

    let mut catches = parser.alloc_vec_with_capacity(2);
    while parser.eat(TokenKind::Catch).is_some() {
        let catch_start = parser.start_span();
        parser.expect(TokenKind::LeftParen);

        let mut types = parser.alloc_vec();
        types.push(parser.parse_name());
        while parser.eat(TokenKind::Pipe).is_some() {
            types.push(parser.parse_name());
        }

        let var = if parser.check(TokenKind::Variable) {
            let t = parser.advance();
            let src = parser.source;
            Some(&src[t.span.start as usize + 1..t.span.end as usize])
        } else {
            None
        };

        parser.expect(TokenKind::RightParen);
        parser.expect(TokenKind::LeftBrace);
        let mut catch_body = parser.alloc_vec_with_capacity(8);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            catch_body.push(parse_stmt(parser));
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.expect(TokenKind::RightBrace);

        catches.push(CatchClause {
            types,
            var,
            body: catch_body,
            span: Span::new(catch_start, parser.current_span().start),
        });
    }

    let finally = if parser.eat(TokenKind::Finally).is_some() {
        parser.expect(TokenKind::LeftBrace);
        let mut finally_body = parser.alloc_vec();
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            finally_body.push(parse_stmt(parser));
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.expect(TokenKind::RightBrace);
        Some(finally_body)
    } else {
        None
    };

    if catches.is_empty() && finally.is_none() {
        parser.error(ParseError::Expected {
            expected: "catch or finally clause".into(),
            found: parser.current_kind(),
            span: Span::new(start, parser.current_span().start),
        });
    }

    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::TryCatch(parser.alloc(TryCatchStmt {
            body,
            catches,
            finally,
        })),
        span,
    }
}

// =============================================================================
// Goto / Declare / Unset / Global
// =============================================================================

fn parse_goto<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let name_token = parser.expect(TokenKind::Identifier);
    let src = parser.source;
    let name: &str = name_token
        .map(|t| &src[t.span.start as usize..t.span.end as usize])
        .unwrap_or("<error>");
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Goto(name),
        span,
    }
}

fn parse_declare<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut directives = parser.alloc_vec();
    loop {
        if parser.check(TokenKind::RightParen) {
            break;
        } // trailing comma
        if let Some(t) = parser.eat(TokenKind::Identifier) {
            let src = parser.source;
            let name = &src[t.span.start as usize..t.span.end as usize];
            parser.expect(TokenKind::Equals);
            let value = expr::parse_expr(parser);
            directives.push((name, value));
        }
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }
    parser.expect(TokenKind::RightParen);

    let body = if parser.check(TokenKind::Semicolon) {
        parser.advance();
        None
    } else if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndDeclare]);
        parser.expect(TokenKind::EndDeclare);
        parser.expect(TokenKind::Semicolon);
        Some(parser.alloc(Stmt {
            kind: StmtKind::Block(stmts),
            span: Span::new(start, parser.current_span().start),
        }))
    } else {
        {
            let s = parse_stmt_or_block(parser);
            Some(parser.alloc(s))
        }
    };

    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Declare(parser.alloc(DeclareStmt { directives, body })),
        span,
    }
}

fn parse_unset<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut exprs = parser.alloc_vec();
    exprs.push(expr::parse_expr(parser));
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::RightParen) {
            break;
        }
        exprs.push(expr::parse_expr(parser));
    }
    parser.expect(TokenKind::RightParen);
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Unset(exprs),
        span,
    }
}

fn parse_global<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let mut exprs = parser.alloc_vec();
    let e = expr::parse_expr(parser);
    if !is_simple_variable(&e) {
        parser.error(ParseError::Expected {
            expected: "variable".into(),
            found: parser.current_kind(),
            span: e.span,
        });
    }
    exprs.push(e);
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) {
            break;
        } // trailing comma
        let e = expr::parse_expr(parser);
        if !is_simple_variable(&e) {
            parser.error(ParseError::Expected {
                expected: "variable".into(),
                found: parser.current_kind(),
                span: e.span,
            });
        }
        exprs.push(e);
    }
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Global(exprs),
        span,
    }
}

fn is_simple_variable<'arena, 'src>(expr: &Expr<'arena, 'src>) -> bool {
    matches!(
        &expr.kind,
        ExprKind::Variable(_) | ExprKind::VariableVariable(_)
    )
}

// =============================================================================
// Class declaration
// =============================================================================

/// Check if a name is a reserved special class name (self, parent, static, readonly)
fn is_reserved_class_name(name: &str) -> bool {
    let lower = name.to_ascii_lowercase();
    matches!(lower.as_str(), "self" | "parent" | "static" | "readonly")
}

/// Validate a name used in extends/implements is not self/parent/static
fn validate_class_ref<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    name: &Name<'arena, 'src>,
) {
    if let Name::Simple { value, span } = name {
        if is_reserved_class_name(value) {
            parser.error(ParseError::Forbidden {
                message: format!("cannot use '{}' as class name", value).into(),
                span: *span,
            });
        }
    }
}

fn parse_class<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    modifiers: ClassModifiers,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_class();

    let start = parser.start_span();
    parser.advance(); // consume 'class'

    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "class name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        ("<error>", parser.current_span())
    };

    if is_reserved_class_name(name) {
        parser.error(ParseError::Forbidden {
            message: format!("cannot use '{}' as class name", name).into(),
            span: name_span,
        });
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let n = parser.parse_name();
        validate_class_ref(parser, &n);
        Some(n)
    } else {
        None
    };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        let names = parse_name_list(parser);
        for n in names.iter() {
            validate_class_ref(parser, n);
        }
        names
    } else {
        parser.alloc_vec()
    };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Class(parser.alloc(ClassDecl {
            name: Some(name),
            modifiers,
            extends,
            implements,
            members,
            attributes,
        })),
        span: Span::new(start, end),
    }
}

pub fn parse_name_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, Name<'arena, 'src>> {
    let mut names = parser.alloc_vec();
    names.push(parser.parse_name());
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::LeftBrace) || parser.check(TokenKind::Semicolon) {
            break;
        } // trailing comma
        names.push(parser.parse_name());
    }
    names
}

/// Parse trait adaptation block: `{ A::foo insteadof B; foo as bar; ... }`
/// Called after consuming `{`.
fn parse_trait_adaptations<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, TraitAdaptation<'arena, 'src>> {
    let mut adaptations = parser.alloc_vec();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let start = parser.start_span();

        // Parse the method reference: either `method` or `TraitName::method`
        // First, parse a name (could be trait name or bare method name)
        let first_name = parser.parse_name();

        if parser.eat(TokenKind::DoubleColon).is_some() {
            // Qualified: TraitName::method
            let method = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "method name".into(),
                    found: parser.current_kind(),
                    span,
                });
                "<error>"
            };

            // Check for `insteadof` or `as`
            if parser.check(TokenKind::Identifier) && parser.current_text() == "insteadof" {
                parser.advance(); // consume `insteadof`
                let mut insteadof = {
                    let mut _v = parser.alloc_vec_with_capacity(1);
                    _v.push(parser.parse_name());
                    _v
                };
                while parser.eat(TokenKind::Comma).is_some() {
                    if parser.check(TokenKind::Semicolon) {
                        break;
                    } // trailing comma
                    insteadof.push(parser.parse_name());
                }
                parser.expect(TokenKind::Semicolon);
                let span = Span::new(start, parser.current_span().start);
                adaptations.push(TraitAdaptation {
                    kind: TraitAdaptationKind::Precedence {
                        trait_name: first_name,
                        method,
                        insteadof,
                    },
                    span,
                });
            } else if parser.eat(TokenKind::As).is_some() {
                // Alias: TraitName::method as [visibility] [newName];
                let (new_modifier, new_name) = parse_alias_rhs(parser);
                parser.expect(TokenKind::Semicolon);
                let span = Span::new(start, parser.current_span().start);
                adaptations.push(TraitAdaptation {
                    kind: TraitAdaptationKind::Alias {
                        trait_name: Some(first_name),
                        method: Cow::Borrowed(method),
                        new_modifier,
                        new_name,
                    },
                    span,
                });
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'insteadof' or 'as'".into(),
                    found: parser.current_kind(),
                    span,
                });
                parser.advance();
            }
        } else if parser.eat(TokenKind::As).is_some() {
            // Unqualified alias: method as [visibility] [newName];
            let method = first_name.join_parts();
            let (new_modifier, new_name) = parse_alias_rhs(parser);
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(start, parser.current_span().start);
            adaptations.push(TraitAdaptation {
                kind: TraitAdaptationKind::Alias {
                    trait_name: None,
                    method,
                    new_modifier,
                    new_name,
                },
                span,
            });
        } else {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "'::' or 'as'".into(),
                found: parser.current_kind(),
                span,
            });
            parser.advance();
        }
    }
    parser.expect(TokenKind::RightBrace);
    adaptations
}

/// Parse the right-hand side of an `as` alias: `[visibility] [newName]`
fn parse_alias_rhs<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> (Option<Visibility>, Option<&'src str>) {
    let new_modifier = match parser.current_kind() {
        TokenKind::Public => {
            parser.advance();
            Some(Visibility::Public)
        }
        TokenKind::Protected => {
            parser.advance();
            Some(Visibility::Protected)
        }
        TokenKind::Private => {
            parser.advance();
            Some(Visibility::Private)
        }
        _ => None,
    };

    // New name (optional if visibility was given)
    let new_name = if parser.check(TokenKind::Identifier) || parser.is_semi_reserved_keyword() {
        let (text, _) = parser.eat_identifier_or_keyword().unwrap();
        Some(text)
    } else {
        None
    };

    (new_modifier, new_name)
}

/// Parse property hooks: `{ get { ... } set(Type $value) { ... } }`
fn parse_property_hooks<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, PropertyHook<'arena, 'src>> {
    let open = parser.expect(TokenKind::LeftBrace);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());

    let mut hooks = parser.alloc_vec();

    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let hook_start = parser.start_span();

        // Parse optional attributes
        let hook_attrs = parser.parse_attributes();

        // Parse optional modifiers
        let mut is_final = false;
        let mut by_ref = false;

        loop {
            match parser.current_kind() {
                TokenKind::Final => {
                    parser.advance();
                    is_final = true;
                }
                TokenKind::Ampersand => {
                    parser.advance();
                    by_ref = true;
                    break;
                }
                // Error: invalid modifiers on hooks
                TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Abstract
                | TokenKind::Static
                | TokenKind::Readonly => {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "'get' or 'set'".into(),
                        found: parser.current_kind(),
                        span,
                    });
                    parser.advance();
                }
                _ => break,
            }
        }

        // Expect "get" or "set" identifier (contextual keywords)
        let kind = if parser.check(TokenKind::Identifier) {
            match parser.current_text() {
                "get" => {
                    parser.advance();
                    PropertyHookKind::Get
                }
                "set" => {
                    parser.advance();
                    PropertyHookKind::Set
                }
                _ => {
                    // Invalid hook name - error recovery
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "'get' or 'set'".into(),
                        found: parser.current_kind(),
                        span,
                    });
                    // Skip until ; or } for recovery
                    while !parser.check(TokenKind::Semicolon)
                        && !parser.check(TokenKind::RightBrace)
                        && !parser.check(TokenKind::Eof)
                    {
                        parser.advance();
                    }
                    parser.eat(TokenKind::Semicolon);
                    continue;
                }
            }
        } else {
            // Not an identifier at all - error recovery
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "'get' or 'set'".into(),
                found: parser.current_kind(),
                span,
            });
            // Skip until ; or } for recovery
            while !parser.check(TokenKind::Semicolon)
                && !parser.check(TokenKind::RightBrace)
                && !parser.check(TokenKind::Eof)
            {
                parser.advance();
            }
            parser.eat(TokenKind::Semicolon);
            continue;
        };

        // Parse optional (params) for set hooks
        let params = if parser.check(TokenKind::LeftParen) {
            parser.advance();
            let p = parse_param_list(parser);
            parser.expect(TokenKind::RightParen);
            p
        } else {
            parser.alloc_vec()
        };

        // Parse body: { stmts } | => expr; | ;
        let body = if parser.check(TokenKind::LeftBrace) {
            let open_brace = parser.expect(TokenKind::LeftBrace);
            let brace_span = open_brace.map(|t| t.span).unwrap_or(parser.current_span());
            let mut stmts = parser.alloc_vec_with_capacity(8);
            while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                let span_before = parser.current_span();
                stmts.push(parse_stmt(parser));
                if parser.current_span() == span_before {
                    parser.advance();
                }
            }
            parser.expect_closing(TokenKind::RightBrace, brace_span);
            PropertyHookBody::Block(stmts)
        } else if parser.eat(TokenKind::FatArrow).is_some() {
            let e = expr::parse_expr(parser);
            parser.expect(TokenKind::Semicolon);
            PropertyHookBody::Expression(e)
        } else {
            parser.expect(TokenKind::Semicolon);
            PropertyHookBody::Abstract
        };

        let hook_span = Span::new(hook_start, parser.current_span().start);
        hooks.push(PropertyHook {
            kind,
            body,
            is_final,
            by_ref,
            params,
            attributes: hook_attrs,
            span: hook_span,
        });
    }

    parser.expect_closing(TokenKind::RightBrace, open_span);
    hooks
}

pub fn parse_class_members<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, ClassMember<'arena, 'src>> {
    // March 2026: reduce from 16 to 4 for class members
    // Most classes have 3-10 members; larger classes grow efficiently
    let mut members = parser.alloc_vec_with_capacity(4);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        // Skip empty statements
        if parser.check(TokenKind::Semicolon) {
            parser.advance();
            continue;
        }

        let member_start = parser.start_span();

        // Parse member attributes
        let member_attrs = parser.parse_attributes();

        // Trait use: use TraitName;  or  use A, B { ... }
        if parser.check(TokenKind::Use) {
            parser.advance();
            let mut traits = parser.alloc_vec_with_capacity(2);
            traits.push(parser.parse_name());
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::Semicolon) || parser.check(TokenKind::LeftBrace) {
                    break;
                } // trailing comma
                traits.push(parser.parse_name());
            }
            let adaptations = if parser.check(TokenKind::LeftBrace) {
                parser.advance();
                parse_trait_adaptations(parser)
            } else {
                parser.expect(TokenKind::Semicolon);
                parser.alloc_vec()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(ClassMember {
                kind: ClassMemberKind::TraitUse(TraitUseDecl {
                    traits,
                    adaptations,
                }),
                span,
            });
            continue;
        }

        // Parse modifiers
        let mut visibility = None;
        let mut set_visibility = None;
        let mut asym_vis_span: Option<Span> = None;
        let mut is_static = false;
        let mut is_abstract = false;
        let mut is_final = false;
        let mut is_readonly = false;

        // Handle `var` keyword (PHP4 style, equivalent to public)
        if parser.check(TokenKind::Identifier) && parser.current_text() == "var" {
            parser.advance();
            visibility = Some(Visibility::Public);
        }

        loop {
            match parser.current_kind() {
                TokenKind::Public | TokenKind::Protected | TokenKind::Private => {
                    let vis = match parser.current_kind() {
                        TokenKind::Public => Visibility::Public,
                        TokenKind::Protected => Visibility::Protected,
                        _ => Visibility::Private,
                    };
                    parser.advance();

                    // Check for asymmetric visibility: public private(set)
                    if visibility.is_none() {
                        visibility = Some(vis);
                        // Look ahead for second visibility keyword followed by (
                        if matches!(
                            parser.current_kind(),
                            TokenKind::Public | TokenKind::Protected | TokenKind::Private
                        ) && parser.peek_kind() == Some(TokenKind::LeftParen)
                        {
                            let set_vis = match parser.current_kind() {
                                TokenKind::Public => Visibility::Public,
                                TokenKind::Protected => Visibility::Protected,
                                _ => Visibility::Private,
                            };
                            // Save span; emit version check after loop when is_static is known.
                            asym_vis_span =
                                Some(Span::new(member_start, parser.current_span().start));
                            parser.advance(); // consume second visibility
                            parser.advance(); // consume (
                                              // Expect "set"
                            if parser.current_text() == "set" {
                                parser.advance(); // consume "set"
                            }
                            parser.expect(TokenKind::RightParen);
                            set_visibility = Some(set_vis);
                        }
                    } else {
                        // Already have visibility; this might be set_visibility with (set)
                        if parser.check(TokenKind::LeftParen) {
                            // Save span for deferred version check after is_static is known.
                            asym_vis_span =
                                Some(Span::new(member_start, parser.current_span().start));
                            parser.advance(); // consume (
                            if parser.current_text() == "set" {
                                parser.advance(); // consume "set"
                            }
                            parser.expect(TokenKind::RightParen);
                            set_visibility = Some(vis);
                        } else {
                            // Duplicate or conflicting visibility
                            parser.error(ParseError::Forbidden {
                                message: "cannot use multiple visibility modifiers".into(),
                                span: Span::new(member_start, parser.current_span().start),
                            });
                        }
                    }
                }
                TokenKind::Static => {
                    if is_static {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'static'".into(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance();
                    is_static = true;
                }
                TokenKind::Abstract => {
                    if is_abstract {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'abstract'".into(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance();
                    is_abstract = true;
                }
                TokenKind::Final => {
                    if is_final {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'final'".into(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance();
                    is_final = true;
                }
                TokenKind::Readonly => {
                    if is_readonly {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'readonly'".into(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    let span = parser.current_span();
                    parser.require_version(PhpVersion::Php81, "readonly properties", span);
                    parser.advance();
                    is_readonly = true;
                }
                _ => break,
            }
        }

        // Validate modifier conflicts
        if is_abstract && is_final {
            parser.error(ParseError::Forbidden {
                message: "cannot use 'abstract' and 'final' together".into(),
                span: Span::new(member_start, parser.current_span().start),
            });
        }

        // Emit version check for asymmetric visibility now that is_static is known.
        // Static asymmetric visibility requires PHP 8.5; instance requires PHP 8.4.
        if let Some(span) = asym_vis_span {
            if is_static {
                parser.require_version(
                    PhpVersion::Php85,
                    "asymmetric visibility on static properties",
                    span,
                );
            } else {
                parser.require_version(PhpVersion::Php84, "asymmetric visibility", span);
            }
        }

        // Detect unknown modifier: bare identifier followed by $variable with no modifiers
        if visibility.is_none()
            && !is_static
            && !is_abstract
            && !is_final
            && !is_readonly
            && parser.check(TokenKind::Identifier)
            && parser.peek_kind() == Some(TokenKind::Variable)
        {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "modifier".into(),
                found: parser.current_kind(),
                span,
            });
        }

        // Const (may have multiple items: const A = 1, B = 2;)
        // May have type hint: const int A = 1;
        if parser.check(TokenKind::Const) {
            // Validate: static/abstract/readonly are not valid on constants
            if is_static {
                parser.error(ParseError::Forbidden {
                    message: "cannot use 'static' as constant modifier".into(),
                    span: parser.current_span(),
                });
            }
            if is_abstract {
                parser.error(ParseError::Forbidden {
                    message: "cannot use 'abstract' as constant modifier".into(),
                    span: parser.current_span(),
                });
            }
            if is_readonly {
                parser.error(ParseError::Forbidden {
                    message: "cannot use 'readonly' as constant modifier".into(),
                    span: parser.current_span(),
                });
            }
            parser.advance();

            // Check for typed constant: if what follows looks like a type hint
            // and is NOT immediately followed by `=`, it's a typed constant (PHP 8.3+)
            let const_type = if parser.could_be_type_hint()
                && !parser.check(TokenKind::Variable)
                && parser.peek_kind() != Some(TokenKind::Equals)
                && parser.peek_kind() != Some(TokenKind::Comma)
            {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php83, "typed class constants", span);
                Some(parser.parse_type_hint())
            } else {
                None
            };

            let mut const_items = parser.alloc_vec();
            loop {
                let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                    text
                } else {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "constant name".into(),
                        found: parser.current_kind(),
                        span,
                    });
                    "<error>"
                };
                parser.expect(TokenKind::Equals);
                let value = expr::parse_expr(parser);
                const_items.push((const_name, value));
                if parser.eat(TokenKind::Comma).is_none() {
                    break;
                }
                if parser.check(TokenKind::Semicolon) {
                    break; // trailing comma
                }
            }
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.current_span().start);
            if !member_attrs.is_empty() && const_items.len() > 1 {
                parser.error(ParseError::Forbidden {
                    message: "cannot use attributes on multi-constant declaration".into(),
                    span,
                });
            }
            {
                // Allocate the type hint into the arena so all items can share a reference
                let shared_type_hint: Option<&'arena _> = const_type.map(|th| parser.alloc(th));
                let mut const_iter = const_items.into_iter();
                if let Some((first_name, first_value)) = const_iter.next() {
                    members.push(ClassMember {
                        kind: ClassMemberKind::ClassConst(ClassConstDecl {
                            name: first_name,
                            visibility,
                            type_hint: shared_type_hint,
                            value: first_value,
                            attributes: member_attrs,
                        }),
                        span,
                    });
                    for (rest_name, rest_value) in const_iter {
                        members.push(ClassMember {
                            kind: ClassMemberKind::ClassConst(ClassConstDecl {
                                name: rest_name,
                                visibility,
                                type_hint: shared_type_hint,
                                value: rest_value,
                                attributes: parser.alloc_vec(),
                            }),
                            span,
                        });
                    }
                }
            }
            continue;
        }

        // Method
        if parser.check(TokenKind::Function) {
            parser.advance();
            let by_ref = parser.eat(TokenKind::Ampersand).is_some();
            let method_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                parser.error(ParseError::Expected {
                    expected: "method name".into(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>"
            };

            parser.expect(TokenKind::LeftParen);
            let params = parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            let return_type = if parser.eat(TokenKind::Colon).is_some() {
                Some(parser.parse_type_hint())
            } else {
                None
            };

            let body = if parser.check(TokenKind::LeftBrace) {
                parser.expect(TokenKind::LeftBrace);
                let mut stmts = parser.alloc_vec_with_capacity(16);
                while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                    let span_before = parser.current_span();
                    stmts.push(parse_stmt(parser));
                    if parser.current_span() == span_before {
                        parser.advance();
                    }
                }
                parser.expect(TokenKind::RightBrace);
                Some(stmts)
            } else {
                parser.expect(TokenKind::Semicolon);
                None
            };

            let span = Span::new(member_start, parser.current_span().start);
            members.push(ClassMember {
                kind: ClassMemberKind::Method(MethodDecl {
                    name: method_name,
                    visibility,
                    is_static,
                    is_abstract,
                    is_final,
                    by_ref,
                    params,
                    return_type,
                    body,
                    attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Property — may have type hint, then $variable
        let type_hint = if parser.could_be_type_hint() && !parser.check(TokenKind::Variable) {
            Some(parser.parse_type_hint())
        } else {
            None
        };

        if parser.check(TokenKind::Variable) {
            let var_token = parser.advance();
            let src = parser.source;
            let prop_name = &src[var_token.span.start as usize + 1..var_token.span.end as usize];

            let default = if parser.eat(TokenKind::Equals).is_some() {
                Some(expr::parse_expr(parser))
            } else {
                None
            };

            // Property hooks: { get { ... } set { ... } } — PHP 8.4+
            let had_hooks_block = parser.check(TokenKind::LeftBrace);
            let hooks = if had_hooks_block {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php84, "property hooks", span);
                parse_property_hooks(parser)
            } else {
                parser.alloc_vec()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(ClassMember {
                kind: ClassMemberKind::Property(PropertyDecl {
                    name: prop_name,
                    visibility,
                    set_visibility,
                    is_static,
                    is_readonly,
                    type_hint,
                    default,
                    attributes: member_attrs,
                    hooks,
                }),
                span,
            });

            // Comma-separated additional properties
            if had_hooks_block {
                // Property with hooks block — no comma separation or semicolon needed
            } else if parser.eat(TokenKind::Comma).is_some() {
                // Parse remaining comma-separated properties
                while parser.check(TokenKind::Variable) {
                    let var_token = parser.advance();
                    let src = parser.source;
                    let pname =
                        &src[var_token.span.start as usize + 1..var_token.span.end as usize];

                    let pdefault = if parser.eat(TokenKind::Equals).is_some() {
                        Some(expr::parse_expr(parser))
                    } else {
                        None
                    };

                    // Property hooks on comma-separated properties → error
                    let phooks = if parser.check(TokenKind::LeftBrace) {
                        parser.error(ParseError::Forbidden {
                            message: "cannot have hooks on comma-separated property".into(),
                            span: parser.current_span(),
                        });
                        parse_property_hooks(parser)
                    } else {
                        parser.alloc_vec()
                    };
                    let pspan = Span::new(member_start, parser.current_span().start);
                    members.push(ClassMember {
                        kind: ClassMemberKind::Property(PropertyDecl {
                            name: pname,
                            visibility: None,
                            set_visibility: None,
                            is_static,
                            is_readonly,
                            type_hint: None, // type applies to first decl only in arena model
                            default: pdefault,
                            attributes: parser.alloc_vec(), // attrs apply to first decl only
                            hooks: phooks,
                        }),
                        span: pspan,
                    });

                    if parser.eat(TokenKind::Comma).is_none() {
                        break;
                    }
                }
                if !parser.check(TokenKind::RightBrace) {
                    parser.expect(TokenKind::Semicolon);
                }
            } else {
                parser.expect(TokenKind::Semicolon);
            }
            continue;
        }

        // Unknown token in class body — skip
        parser.advance();
    }
    members
}

// =============================================================================
// Interface / Trait / Enum
// =============================================================================

fn parse_interface<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_class();

    let start = parser.start_span();
    parser.advance();
    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "interface name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        ("<error>", parser.current_span())
    };

    if is_reserved_class_name(name) {
        parser.error(ParseError::Forbidden {
            message: format!("cannot use '{}' as interface name", name).into(),
            span: name_span,
        });
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let names = parse_name_list(parser);
        for n in names.iter() {
            validate_class_ref(parser, n);
        }
        names
    } else {
        parser.alloc_vec()
    };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Interface(parser.alloc(InterfaceDecl {
            name,
            extends,
            members,
            attributes,
        })),
        span: Span::new(start, end),
    }
}

fn parse_trait<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_class();

    let start = parser.start_span();
    parser.advance();
    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "trait name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>"
    };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Trait(parser.alloc(TraitDecl {
            name,
            members,
            attributes,
        })),
        span: Span::new(start, end),
    }
}

fn parse_enum<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'enum'

    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "enum name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>"
    };

    // Backed enum: enum Foo: string
    let scalar_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_name())
    } else {
        None
    };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        parse_name_list(parser)
    } else {
        parser.alloc_vec()
    };

    parser.expect(TokenKind::LeftBrace);

    let mut members = parser.alloc_vec_with_capacity(4);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) {
            parser.advance();
            continue;
        }
        let member_attrs = parser.parse_attributes();
        let member_start = parser.start_span();

        // Trait use
        if parser.check(TokenKind::Use) {
            parser.advance();
            let mut traits = parser.alloc_vec();
            traits.push(parser.parse_name());
            while parser.eat(TokenKind::Comma).is_some() {
                traits.push(parser.parse_name());
            }
            let adaptations = if parser.check(TokenKind::LeftBrace) {
                parser.advance();
                parse_trait_adaptations(parser)
            } else {
                parser.expect(TokenKind::Semicolon);
                parser.alloc_vec()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::TraitUse(TraitUseDecl {
                    traits,
                    adaptations,
                }),
                span,
            });
            continue;
        }

        // Enum case
        if parser.check(TokenKind::Case) {
            parser.advance();
            if parser.check(TokenKind::Class) {
                let span = parser.current_span();
                parser.error(ParseError::Forbidden {
                    message: "'class' cannot be used as an enum case name".into(),
                    span,
                });
            }
            let case_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                parser.error(ParseError::Expected {
                    expected: "case name".into(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>"
            };
            let value = if parser.eat(TokenKind::Equals).is_some() {
                Some(expr::parse_expr(parser))
            } else {
                None
            };
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::Case(EnumCase {
                    name: case_name,
                    value,
                    attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Parse modifiers for methods/consts
        let mut visibility = None;
        let mut is_static = false;
        let mut is_abstract = false;
        let mut is_final = false;

        loop {
            match parser.current_kind() {
                TokenKind::Public => {
                    parser.advance();
                    visibility = Some(Visibility::Public);
                }
                TokenKind::Protected => {
                    parser.advance();
                    visibility = Some(Visibility::Protected);
                }
                TokenKind::Private => {
                    parser.advance();
                    visibility = Some(Visibility::Private);
                }
                TokenKind::Static => {
                    parser.advance();
                    is_static = true;
                }
                TokenKind::Abstract => {
                    parser.advance();
                    is_abstract = true;
                }
                TokenKind::Final => {
                    parser.advance();
                    is_final = true;
                }
                _ => break,
            }
        }

        // Const
        if parser.check(TokenKind::Const) {
            parser.advance();

            // PHP 8.3: typed enum constants — e.g. `public const string MODE = 'fit'`
            let const_type = if parser.could_be_type_hint()
                && !parser.check(TokenKind::Variable)
                && parser.peek_kind() != Some(TokenKind::Equals)
                && parser.peek_kind() != Some(TokenKind::Comma)
            {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php83, "typed enum constants", span);
                let th = parser.parse_type_hint();
                Some(parser.alloc(th))
            } else {
                None
            };

            let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                parser.error(ParseError::Expected {
                    expected: "constant name".into(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>"
            };
            parser.expect(TokenKind::Equals);
            let value = expr::parse_expr(parser);
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::ClassConst(ClassConstDecl {
                    name: const_name,
                    visibility,
                    type_hint: const_type,
                    value,
                    attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Method
        if parser.check(TokenKind::Function) {
            parser.advance();
            let by_ref = parser.eat(TokenKind::Ampersand).is_some();
            let method_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                "<error>"
            };

            parser.expect(TokenKind::LeftParen);
            let params = parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            let return_type = if parser.eat(TokenKind::Colon).is_some() {
                Some(parser.parse_type_hint())
            } else {
                None
            };

            let body = if parser.check(TokenKind::LeftBrace) {
                parser.expect(TokenKind::LeftBrace);
                let mut stmts = parser.alloc_vec_with_capacity(16);
                while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                    let span_before = parser.current_span();
                    stmts.push(parse_stmt(parser));
                    if parser.current_span() == span_before {
                        parser.advance();
                    }
                }
                parser.expect(TokenKind::RightBrace);
                Some(stmts)
            } else {
                parser.expect(TokenKind::Semicolon);
                None
            };

            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::Method(MethodDecl {
                    name: method_name,
                    visibility,
                    is_static,
                    is_abstract,
                    is_final,
                    by_ref,
                    params,
                    return_type,
                    body,
                    attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Unknown — skip
        parser.advance();
    }

    let close = parser.expect(TokenKind::RightBrace);
    let end = close
        .map(|t| t.span.end)
        .unwrap_or(parser.current_span().start);
    Stmt {
        kind: StmtKind::Enum(parser.alloc(EnumDecl {
            name,
            scalar_type,
            implements,
            members,
            attributes,
        })),
        span: Span::new(start, end),
    }
}

// =============================================================================
// Namespace / Use / Const
// =============================================================================

fn parse_namespace<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'namespace'

    // namespace { ... } (global namespace) or namespace Name { ... } or namespace Name;
    if parser.check(TokenKind::LeftBrace) {
        // Global namespace block
        parser.expect(TokenKind::LeftBrace);
        let mut stmts = parser.alloc_vec_with_capacity(16);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            stmts.push(parse_stmt(parser));
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        let close = parser.expect(TokenKind::RightBrace);
        let end = close
            .map(|t| t.span.end)
            .unwrap_or(parser.current_span().start);
        return Stmt {
            kind: StmtKind::Namespace(parser.alloc(NamespaceDecl {
                name: None,
                body: NamespaceBody::Braced(stmts),
            })),
            span: Span::new(start, end),
        };
    }

    let name = parser.parse_name();

    if parser.check(TokenKind::LeftBrace) {
        // Braced namespace: namespace Foo\Bar { ... }
        parser.expect(TokenKind::LeftBrace);
        let mut stmts = parser.alloc_vec_with_capacity(16);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            stmts.push(parse_stmt(parser));
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        let close = parser.expect(TokenKind::RightBrace);
        let end = close
            .map(|t| t.span.end)
            .unwrap_or(parser.current_span().start);
        Stmt {
            kind: StmtKind::Namespace(parser.alloc(NamespaceDecl {
                name: Some(name),
                body: NamespaceBody::Braced(stmts),
            })),
            span: Span::new(start, end),
        }
    } else {
        // Simple namespace: namespace Foo\Bar;
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);
        Stmt {
            kind: StmtKind::Namespace(parser.alloc(NamespaceDecl {
                name: Some(name),
                body: NamespaceBody::Simple,
            })),
            span,
        }
    }
}

fn parse_use<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'use'

    // Determine use kind: use function, use const
    let kind = if parser.check(TokenKind::Function) {
        parser.advance();
        UseKind::Function
    } else if parser.check(TokenKind::Const) {
        parser.advance();
        UseKind::Const
    } else {
        UseKind::Normal
    };

    let mut uses = parser.alloc_vec_with_capacity(4);

    // Parse first name to check for group use
    let item_start = parser.start_span();
    let first_name = parser.parse_name();

    // Group use: use App\{Models\User, Services\Auth};
    if parser.check(TokenKind::LeftBrace) {
        // Validate: prefix must have trailing \ (i.e., parse_name consumed a trailing \)
        // If the name is Unqualified with 1 part, and the char before { is not \, error
        if first_name.kind() == NameKind::Unqualified {
            // Check if the source char before the current position is not '\'
            let brace_pos = parser.current_span().start as usize;
            let has_trailing_sep =
                brace_pos > 0 && parser.source().as_bytes()[brace_pos - 1] == b'\\';
            if !has_trailing_sep {
                parser.error(ParseError::Expected {
                    expected: "namespace separator before '{'".into(),
                    found: parser.current_kind(),
                    span: first_name.span(),
                });
            }
        }
        parser.advance(); // consume {
        if parser.check(TokenKind::RightBrace) {
            parser.error(ParseError::Expected {
                expected: "at least one import in group use".into(),
                found: TokenKind::RightBrace,
                span: parser.current_span(),
            });
        }
        let prefix_parts = first_name.parts_slice();
        loop {
            if parser.check(TokenKind::RightBrace) {
                break;
            } // trailing comma
            let sub_start = parser.start_span();
            let item_kind = if parser.check(TokenKind::Function) {
                parser.advance();
                Some(UseKind::Function)
            } else if parser.check(TokenKind::Const) {
                parser.advance();
                Some(UseKind::Const)
            } else {
                None
            };
            let sub_name = parser.parse_name();

            // Validate: sub-names must not have leading backslash
            if sub_name.kind() == NameKind::FullyQualified {
                parser.error(ParseError::Expected {
                    expected: "non-fully-qualified name in group use".into(),
                    found: parser.current_kind(),
                    span: sub_name.span(),
                });
            }

            // Combine prefix with sub-name
            let combined_parts = {
                let sub_slice = sub_name.parts_slice();
                let mut cp = parser.alloc_vec_with_capacity(prefix_parts.len() + sub_slice.len());
                for p in prefix_parts.iter() {
                    cp.push(*p);
                }
                match sub_name {
                    Name::Simple { value, .. } => cp.push(value),
                    Name::Complex { parts, .. } => {
                        for p in parts.into_iter() {
                            cp.push(p);
                        }
                    }
                }
                cp
            };
            let sub_span = Span::new(item_start, parser.current_span().start);
            let combined_name = Name::Complex {
                parts: combined_parts,
                kind: if first_name.kind() == NameKind::FullyQualified {
                    NameKind::FullyQualified
                } else {
                    NameKind::Qualified
                },
                span: sub_span,
            };

            let alias = if parser.eat(TokenKind::As).is_some() {
                let alias_token = parser.expect(TokenKind::Identifier);
                let src = parser.source;
                alias_token.map(|t| &src[t.span.start as usize..t.span.end as usize])
            } else {
                None
            };

            let use_span = Span::new(sub_start, parser.current_span().start);
            uses.push(UseItem {
                name: combined_name,
                alias,
                kind: item_kind,
                span: use_span,
            });

            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
        parser.expect(TokenKind::RightBrace);
    } else {
        // Regular use (possibly comma-separated)
        let alias = if parser.eat(TokenKind::As).is_some() {
            let alias_token = parser.expect(TokenKind::Identifier);
            let src = parser.source;
            alias_token.map(|t| &src[t.span.start as usize..t.span.end as usize])
        } else {
            None
        };

        let item_span = Span::new(item_start, parser.current_span().start);
        uses.push(UseItem {
            name: first_name,
            alias,
            kind: None,
            span: item_span,
        });

        while parser.eat(TokenKind::Comma).is_some() {
            if parser.check(TokenKind::Semicolon) {
                break;
            } // trailing comma
            let next_start = parser.start_span();
            let name = parser.parse_name();

            let alias = if parser.eat(TokenKind::As).is_some() {
                let alias_token = parser.expect(TokenKind::Identifier);
                let src = parser.source;
                alias_token.map(|t| &src[t.span.start as usize..t.span.end as usize])
            } else {
                None
            };

            let next_span = Span::new(next_start, parser.current_span().start);
            uses.push(UseItem {
                name,
                alias,
                kind: None,
                span: next_span,
            });
        }
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Use(parser.alloc(UseDecl { kind, uses })),
        span,
    }
}

fn parse_const<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    parse_const_with_attrs(parser, parser.alloc_vec())
}

fn parse_const_with_attrs<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'const'

    let mut items = parser.alloc_vec();
    // Attributes apply to the first item only.
    let mut pending_attrs = Some(attributes);
    loop {
        let item_start = parser.start_span();
        let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
            text
        } else {
            parser.error(ParseError::Expected {
                expected: "constant name".into(),
                found: parser.current_kind(),
                span: parser.current_span(),
            });
            "<error>"
        };
        parser.expect(TokenKind::Equals);
        let value = expr::parse_expr(parser);
        let item_span = Span::new(item_start, value.span.end);
        let item_attrs = pending_attrs.take().unwrap_or_else(|| parser.alloc_vec());
        items.push(ConstItem {
            name: const_name,
            value,
            attributes: item_attrs,
            span: item_span,
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        if parser.check(TokenKind::Semicolon) {
            break;
        } // trailing comma
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Const(items),
        span,
    }
}

fn parse_halt_compiler<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();

    // __halt_compiler must be at the outermost scope
    if parser.depth > 0 {
        parser.error(ParseError::Forbidden {
            message: "__halt_compiler() can only be used at the outermost scope".into(),
            span: parser.current_span(),
        });
    }

    parser.advance(); // consume '__halt_compiler'
    parser.expect(TokenKind::LeftParen);
    parser.expect(TokenKind::RightParen);
    // Accept either ; or ?> as terminator
    if parser.check(TokenKind::Semicolon) {
        parser.advance();
    } else if parser.check(TokenKind::CloseTag) {
        parser.advance(); // consume ?> — everything after is raw data
    } else {
        parser.error(ParseError::ExpectedAfter {
            expected: "';' or '?>'".into(),
            after: "__halt_compiler()".into(),
            span: parser.current_span(),
        });
    }

    // Everything after __halt_compiler(); is raw data
    let current_pos = parser.current_span().start as usize;
    let remaining = &parser.source[current_pos..];

    // Advance to EOF so the parser stops
    while !parser.check(TokenKind::Eof) {
        parser.advance();
    }

    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::HaltCompiler(remaining),
        span,
    }
}

fn parse_static_var<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'static'

    let mut vars = parser.alloc_vec();
    loop {
        let var_start = parser.start_span();
        let var_token = parser.expect(TokenKind::Variable);
        let src = parser.source;
        let name: &str = var_token
            .map(|t| &src[t.span.start as usize + 1..t.span.end as usize])
            .unwrap_or("<error>");

        let default = if parser.eat(TokenKind::Equals).is_some() {
            Some(expr::parse_expr(parser))
        } else {
            None
        };

        let var_span = Span::new(
            var_start,
            default
                .as_ref()
                .map(|e| e.span.end)
                .unwrap_or(parser.current_span().start),
        );
        vars.push(StaticVar {
            name,
            default,
            span: var_span,
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        if parser.check(TokenKind::Semicolon) {
            break;
        } // trailing comma
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::StaticVar(vars),
        span,
    }
}

// =============================================================================
// Expression statement (and label detection)
// =============================================================================

fn parse_expression_stmt_or_label<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if let ExprKind::Identifier(ref name) = expr.kind {
        if parser.eat(TokenKind::Colon).is_some() {
            let span = Span::new(start, parser.current_span().start);
            // Label names are always simple identifiers borrowed from source
            // If somehow it's owned (qualified name), we can't get &'src str easily;
            // in practice labels are always simple identifiers
            if let Cow::Borrowed(label) = name {
                return Stmt {
                    kind: StmtKind::Label(label),
                    span,
                };
            }
            // Fallback: use a static error sentinel (qualified labels are invalid PHP anyway)
            return Stmt {
                kind: StmtKind::Label("<error>"),
                span,
            };
        }
    }

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt {
            kind: StmtKind::Error,
            span: Span::new(start, parser.current_span().start),
        };
    }

    parser.expect_semicolon("expression");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Expression(parser.alloc(expr)),
        span,
    }
}

fn parse_expression_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt {
            kind: StmtKind::Error,
            span: Span::new(start, parser.current_span().start),
        };
    }

    parser.expect_semicolon("expression");
    let span = Span::new(start, parser.current_span().start);
    Stmt {
        kind: StmtKind::Expression(parser.alloc(expr)),
        span,
    }
}
