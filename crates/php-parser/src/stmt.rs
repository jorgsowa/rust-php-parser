use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::ParseError;
use crate::expr;
use crate::parser::Parser;

/// Parse a single statement.
pub fn parse_stmt(parser: &mut Parser) -> Stmt {
    // Handle attributes: #[...] before declarations
    if parser.check(TokenKind::HashBracket) {
        return parse_attributed_stmt(parser);
    }

    match parser.current_kind() {
        TokenKind::Semicolon => {
            let span = parser.current_span();
            parser.advance();
            Stmt { kind: StmtKind::Nop, span }
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
                parse_function(parser)
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
        TokenKind::Class => parse_class(parser, ClassModifiers::default()),
        TokenKind::Abstract => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(parser, ClassModifiers { is_abstract: true, ..Default::default() })
            } else {
                // abstract without class - error recovery
                let span = Span::new(start, parser.current_span().start);
                parser.error(ParseError::Expected {
                    expected: "'class'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt { kind: StmtKind::Error, span }
            }
        }
        TokenKind::Final => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(parser, ClassModifiers { is_final: true, ..Default::default() })
            } else if parser.check(TokenKind::Readonly) {
                parser.advance();
                if parser.check(TokenKind::Class) {
                    parse_class(parser, ClassModifiers { is_final: true, is_readonly: true, ..Default::default() })
                } else {
                    let span = Span::new(start, parser.current_span().start);
                    parser.error(ParseError::Expected {
                        expected: "'class'".to_string(),
                        found: parser.current_kind(),
                        span,
                    });
                    parser.synchronize();
                    Stmt { kind: StmtKind::Error, span }
                }
            } else {
                let span = Span::new(start, parser.current_span().start);
                parser.error(ParseError::Expected {
                    expected: "'class'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt { kind: StmtKind::Error, span }
            }
        }
        TokenKind::Readonly => {
            if parser.peek_kind() == Some(TokenKind::Class) {
                parser.advance(); // consume 'readonly'
                parse_class(parser, ClassModifiers { is_readonly: true, ..Default::default() })
            } else {
                // readonly used as function name/expression (e.g., readonly())
                parse_expression_stmt(parser)
            }
        }
        TokenKind::Interface => parse_interface(parser),
        TokenKind::Trait => parse_trait(parser),
        TokenKind::Enum_ => parse_enum(parser),
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
        TokenKind::Identifier => {
            parse_expression_stmt_or_label(parser)
        }
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
fn parse_attributed_stmt(parser: &mut Parser) -> Stmt {
    let attributes = parser.parse_attributes();

    // Now dispatch based on what follows
    let mut stmt = match parser.current_kind() {
        TokenKind::Function => parse_function(parser),
        TokenKind::Class => parse_class(parser, ClassModifiers::default()),
        TokenKind::Abstract => {
            let start = parser.start_span();
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(parser, ClassModifiers { is_abstract: true, ..Default::default() })
            } else {
                let span = Span::new(start, parser.current_span().start);
                parser.error(ParseError::Expected {
                    expected: "'class'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt { kind: StmtKind::Error, span }
            }
        }
        TokenKind::Final => {
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(parser, ClassModifiers { is_final: true, ..Default::default() })
            } else if parser.check(TokenKind::Readonly) {
                parser.advance();
                parse_class(parser, ClassModifiers { is_final: true, is_readonly: true, ..Default::default() })
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'class'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt { kind: StmtKind::Error, span }
            }
        }
        TokenKind::Readonly => {
            parser.advance();
            if parser.check(TokenKind::Class) {
                parse_class(parser, ClassModifiers { is_readonly: true, ..Default::default() })
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'class'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.synchronize();
                Stmt { kind: StmtKind::Error, span }
            }
        }
        TokenKind::Interface => parse_interface(parser),
        TokenKind::Trait => parse_trait(parser),
        TokenKind::Enum_ => parse_enum(parser),
        TokenKind::Const => {
            let stmt = parse_const(parser);
            // Check if multi-const declaration with attributes
            if let StmtKind::Const(ref items) = stmt.kind {
                if items.len() > 1 {
                    parser.error(ParseError::Forbidden {
                        message: "cannot use attributes on multi-constant declaration".to_string(),
                        span: stmt.span,
                    });
                }
            }
            // Attributes are noted but ConstItem has no attributes field for top-level const,
            // so we just report the error above and return the stmt as-is.
            return stmt;
        }
        _ => {
            // Attributes before something unexpected
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "declaration after attributes".to_string(),
                found: parser.current_kind(),
                span,
            });
            parser.synchronize();
            Stmt { kind: StmtKind::Error, span }
        }
    };

    // Attach attributes to the parsed statement
    match &mut stmt.kind {
        StmtKind::Function(decl) => decl.attributes = attributes,
        StmtKind::Class(decl) => decl.attributes = attributes,
        StmtKind::Interface(decl) => decl.attributes = attributes,
        StmtKind::Trait(decl) => decl.attributes = attributes,
        StmtKind::Enum(decl) => decl.attributes = attributes,
        _ => {}
    }

    stmt
}

/// Parse a block statement: `{ stmts }`
pub fn parse_block(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    let open = parser.expect(TokenKind::LeftBrace);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());

    parser.depth += 1;
    let mut stmts = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        stmts.push(parse_stmt(parser));
        if parser.current_span() == span_before { parser.advance(); }
    }
    parser.depth -= 1;

    let close = parser.expect_closing(TokenKind::RightBrace, open_span);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::Block(stmts),
        span,
    }
}

/// Parse a statement or block (used as body of if/while/for/etc.)
fn parse_stmt_or_block(parser: &mut Parser) -> Stmt {
    if parser.check(TokenKind::LeftBrace) {
        parse_block(parser)
    } else {
        parse_stmt(parser)
    }
}

/// Parse statements until an end keyword (for alternative syntax)
fn parse_stmts_until_end(parser: &mut Parser, ends: &[TokenKind]) -> Vec<Stmt> {
    let mut stmts = Vec::new();
    while !ends.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
        stmts.push(parse_stmt(parser));
    }
    stmts
}

// =============================================================================
// Echo statement
// =============================================================================

fn parse_echo(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'echo'

    let mut exprs = Vec::new();
    exprs.push(expr::parse_expr(parser));

    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) { break; } // trailing comma
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

fn parse_return(parser: &mut Parser) -> Stmt {
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
        kind: StmtKind::Return(expr),
        span,
    }
}

// =============================================================================
// If statement (with alternative syntax support)
// =============================================================================

fn parse_if(parser: &mut Parser) -> Stmt {
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
        let then_branch = Box::new(Stmt {
            kind: StmtKind::Block(stmts),
            span: Span::new(start, parser.current_span().start),
        });

        let mut elseif_branches = Vec::new();
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
            Some(Box::new(Stmt {
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
            kind: StmtKind::If(IfStmt {
                condition,
                then_branch,
                elseif_branches,
                else_branch,
            }),
            span,
        };
    }

    // Normal syntax
    let then_branch = Box::new(parse_stmt_or_block(parser));

    let mut elseif_branches = Vec::new();
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
        Some(Box::new(parse_stmt_or_block(parser)))
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
        kind: StmtKind::If(IfStmt {
            condition,
            then_branch,
            elseif_branches,
            else_branch,
        }),
        span,
    }
}

// =============================================================================
// While / Do-while / For / Foreach
// =============================================================================

fn parse_while(parser: &mut Parser) -> Stmt {
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
        let body = Box::new(Stmt { kind: StmtKind::Block(stmts), span });
        return Stmt { kind: StmtKind::While(WhileStmt { condition, body }), span };
    }

    let body = Box::new(parse_stmt_or_block(parser));
    let span = Span::new(start, body.span.end);
    Stmt { kind: StmtKind::While(WhileStmt { condition, body }), span }
}

fn parse_do_while(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let body = Box::new(parse_stmt_or_block(parser));
    parser.expect(TokenKind::While);
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let condition = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);
    parser.expect_semicolon("do-while statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::DoWhile(DoWhileStmt { body, condition }), span }
}

fn parse_for(parser: &mut Parser) -> Stmt {
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
        let body = Box::new(Stmt { kind: StmtKind::Block(stmts), span });
        return Stmt { kind: StmtKind::For(ForStmt { init, condition, update, body }), span };
    }

    let body = Box::new(parse_stmt_or_block(parser));
    let span = Span::new(start, body.span.end);
    Stmt { kind: StmtKind::For(ForStmt { init, condition, update, body }), span }
}

fn parse_expr_list_until(parser: &mut Parser, stop: TokenKind) -> Vec<Expr> {
    let mut exprs = Vec::new();
    if parser.check(stop) { return exprs; }
    exprs.push(expr::parse_expr(parser));
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(stop) { break; } // trailing comma
        exprs.push(expr::parse_expr(parser));
    }
    exprs
}

fn parse_foreach(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let collection = expr::parse_expr(parser);
    parser.expect(TokenKind::As);

    if parser.check(TokenKind::Ampersand) { parser.advance(); }
    let first = expr::parse_expr(parser);

    let (key, value) = if parser.eat(TokenKind::FatArrow).is_some() {
        if parser.check(TokenKind::Ampersand) { parser.advance(); }
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
        let body = Box::new(Stmt { kind: StmtKind::Block(stmts), span });
        return Stmt { kind: StmtKind::Foreach(ForeachStmt { expr: collection, key, value, body }), span };
    }

    let body = Box::new(parse_stmt_or_block(parser));
    let span = Span::new(start, body.span.end);
    Stmt { kind: StmtKind::Foreach(ForeachStmt { expr: collection, key, value, body }), span }
}

// =============================================================================
// Function declaration (enhanced with types, by-ref, return types)
// =============================================================================

fn parse_function(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'function'

    let by_ref = parser.eat(TokenKind::Ampersand).is_some();

    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "function name".to_string(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>".to_string()
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
    let mut body = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        body.push(parse_stmt(parser));
        if parser.current_span() == span_before { parser.advance(); }
    }
    let close = parser.expect_closing(TokenKind::RightBrace, open_brace_span);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::Function(FunctionDecl { name, params, body, return_type, by_ref, attributes: Vec::new() }),
        span,
    }
}

pub fn parse_param_list(parser: &mut Parser) -> Vec<Param> {
    let mut params = Vec::new();
    if parser.check(TokenKind::RightParen) { return params; }

    loop {
        if parser.check(TokenKind::RightParen) { break; }
        let param_start = parser.start_span();

        // Optional parameter attributes
        let param_attrs = parser.parse_attributes();

        // Optional visibility (constructor promotion)
        let visibility = parse_optional_visibility(parser);

        // Check for asymmetric visibility: public private(set) in promoted properties
        let set_visibility = if visibility.is_some()
            && matches!(parser.current_kind(), TokenKind::Public | TokenKind::Protected | TokenKind::Private)
            && parser.peek_kind() == Some(TokenKind::LeftParen)
        {
            let set_vis = match parser.current_kind() {
                TokenKind::Public => Visibility::Public,
                TokenKind::Protected => Visibility::Protected,
                _ => Visibility::Private,
            };
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

        // Optional final (PHP 8.4+ promoted property modifier)
        let _final = parser.eat(TokenKind::Final).is_some();

        // Optional readonly
        let _readonly = parser.eat(TokenKind::Readonly).is_some();

        // Optional type hint
        let type_hint = if parser.could_be_type_hint()
            && !parser.check(TokenKind::Variable)
            && !(parser.check(TokenKind::Ampersand) && matches!(parser.peek_kind(), Some(TokenKind::Variable)))
            && !parser.check(TokenKind::Ellipsis)
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
        let name = name_token
            .map(|t| {
                let text = &parser.source()[t.span.start as usize..t.span.end as usize];
                text[1..].to_string()
            })
            .unwrap_or_else(|| "<error>".to_string());

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
            Vec::new()
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
            visibility,
            set_visibility,
            attributes: param_attrs,
            hooks,
            span: Span::new(param_start, param_end),
        });

        if parser.eat(TokenKind::Comma).is_none() { break; }
    }

    params
}

fn parse_optional_visibility(parser: &mut Parser) -> Option<Visibility> {
    match parser.current_kind() {
        TokenKind::Public => { parser.advance(); Some(Visibility::Public) }
        TokenKind::Protected => { parser.advance(); Some(Visibility::Protected) }
        TokenKind::Private => { parser.advance(); Some(Visibility::Private) }
        _ => None,
    }
}

// =============================================================================
// Break / Continue
// =============================================================================

fn parse_break(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let expr = if !parser.check(TokenKind::Semicolon) {
        Some(expr::parse_expr(parser))
    } else { None };
    parser.expect_semicolon("break statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Break(expr), span }
}

fn parse_continue(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let expr = if !parser.check(TokenKind::Semicolon) {
        Some(expr::parse_expr(parser))
    } else { None };
    parser.expect_semicolon("continue statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Continue(expr), span }
}

// =============================================================================
// Switch statement
// =============================================================================

fn parse_switch(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());
    let switch_expr = expr::parse_expr(parser);
    parser.expect_closing(TokenKind::RightParen, open_span);

    let alt_syntax = parser.eat(TokenKind::Colon).is_some();
    if !alt_syntax { parser.expect(TokenKind::LeftBrace); }
    while parser.check(TokenKind::Semicolon) { parser.advance(); }

    let end_tokens: &[TokenKind] = if alt_syntax { &[TokenKind::EndSwitch] } else { &[TokenKind::RightBrace] };
    let mut cases = Vec::new();

    while !end_tokens.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
        let case_start = parser.start_span();
        let value = if parser.eat(TokenKind::Case).is_some() {
            let v = expr::parse_expr(parser);
            if !parser.eat(TokenKind::Colon).is_some() { parser.expect(TokenKind::Semicolon); }
            Some(v)
        } else if parser.eat(TokenKind::Default).is_some() {
            if !parser.eat(TokenKind::Colon).is_some() { parser.expect(TokenKind::Semicolon); }
            None
        } else { break; };

        let mut body = Vec::new();
        while !parser.check(TokenKind::Case) && !parser.check(TokenKind::Default)
            && !end_tokens.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
            body.push(parse_stmt(parser));
        }

        cases.push(SwitchCase { value, body, span: Span::new(case_start, parser.current_span().start) });
    }

    if alt_syntax { parser.expect(TokenKind::EndSwitch); parser.expect(TokenKind::Semicolon); }
    else { parser.expect(TokenKind::RightBrace); }

    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Switch(SwitchStmt { expr: switch_expr, cases }), span }
}

// =============================================================================
// Throw / Try-Catch
// =============================================================================

fn parse_throw_stmt(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let expr = expr::parse_expr(parser);
    parser.expect_semicolon("throw statement");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Throw(expr), span }
}

fn parse_try_catch(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftBrace);
    let mut body = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        body.push(parse_stmt(parser));
        if parser.current_span() == span_before { parser.advance(); }
    }
    parser.expect(TokenKind::RightBrace);

    let mut catches = Vec::new();
    while parser.eat(TokenKind::Catch).is_some() {
        let catch_start = parser.start_span();
        parser.expect(TokenKind::LeftParen);

        let mut types = Vec::new();
        types.push(parser.parse_name());
        while parser.eat(TokenKind::Pipe).is_some() {
            types.push(parser.parse_name());
        }

        let var = if parser.check(TokenKind::Variable) {
            let t = parser.advance();
            let text = &parser.source()[t.span.start as usize..t.span.end as usize];
            Some(text[1..].to_string())
        } else { None };

        parser.expect(TokenKind::RightParen);
        parser.expect(TokenKind::LeftBrace);
        let mut catch_body = Vec::new();
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            catch_body.push(parse_stmt(parser));
            if parser.current_span() == span_before { parser.advance(); }
        }
        parser.expect(TokenKind::RightBrace);

        catches.push(CatchClause {
            types, var, body: catch_body,
            span: Span::new(catch_start, parser.current_span().start),
        });
    }

    let finally = if parser.eat(TokenKind::Finally).is_some() {
        parser.expect(TokenKind::LeftBrace);
        let mut finally_body = Vec::new();
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            finally_body.push(parse_stmt(parser));
            if parser.current_span() == span_before { parser.advance(); }
        }
        parser.expect(TokenKind::RightBrace);
        Some(finally_body)
    } else { None };

    if catches.is_empty() && finally.is_none() {
        parser.error(ParseError::Expected {
            expected: "catch or finally clause".to_string(),
            found: parser.current_kind(),
            span: Span::new(start, parser.current_span().start),
        });
    }

    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::TryCatch(TryCatchStmt { body, catches, finally }), span }
}

// =============================================================================
// Goto / Declare / Unset / Global
// =============================================================================

fn parse_goto(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let name_token = parser.expect(TokenKind::Identifier);
    let name = name_token
        .map(|t| parser.source()[t.span.start as usize..t.span.end as usize].to_string())
        .unwrap_or_else(|| "<error>".to_string());
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Goto(name), span }
}

fn parse_declare(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut directives = Vec::new();
    loop {
        if parser.check(TokenKind::RightParen) { break; } // trailing comma
        if let Some(t) = parser.eat(TokenKind::Identifier) {
            let name = parser.source()[t.span.start as usize..t.span.end as usize].to_string();
            parser.expect(TokenKind::Equals);
            let value = expr::parse_expr(parser);
            directives.push((name, value));
        }
        if parser.eat(TokenKind::Comma).is_none() { break; }
    }
    parser.expect(TokenKind::RightParen);

    let body = if parser.check(TokenKind::Semicolon) {
        parser.advance(); None
    } else if parser.eat(TokenKind::Colon).is_some() {
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndDeclare]);
        parser.expect(TokenKind::EndDeclare);
        parser.expect(TokenKind::Semicolon);
        Some(Box::new(Stmt { kind: StmtKind::Block(stmts), span: Span::new(start, parser.current_span().start) }))
    } else {
        Some(Box::new(parse_stmt_or_block(parser)))
    };

    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Declare(directives, body), span }
}

fn parse_unset(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut exprs = Vec::new();
    exprs.push(expr::parse_expr(parser));
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::RightParen) { break; }
        exprs.push(expr::parse_expr(parser));
    }
    parser.expect(TokenKind::RightParen);
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Unset(exprs), span }
}

fn parse_global(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let mut exprs = Vec::new();
    let e = expr::parse_expr(parser);
    if !is_simple_variable(&e) {
        parser.error(ParseError::Expected {
            expected: "variable".to_string(),
            found: parser.current_kind(),
            span: e.span,
        });
    }
    exprs.push(e);
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) { break; } // trailing comma
        let e = expr::parse_expr(parser);
        if !is_simple_variable(&e) {
            parser.error(ParseError::Expected {
                expected: "variable".to_string(),
                found: parser.current_kind(),
                span: e.span,
            });
        }
        exprs.push(e);
    }
    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Global(exprs), span }
}

fn is_simple_variable(expr: &Expr) -> bool {
    match &expr.kind {
        ExprKind::Variable(_) => true,
        ExprKind::VariableVariable(_) => true,
        _ => false,
    }
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
fn validate_class_ref(parser: &mut Parser, name: &Name) {
    if name.parts.len() == 1 && name.kind == php_ast::NameKind::Unqualified {
        if is_reserved_class_name(&name.parts[0]) {
            parser.error(ParseError::Forbidden {
                message: format!("cannot use '{}' as class name", name.parts[0]),
                span: name.span,
            });
        }
    }
}

fn parse_class(parser: &mut Parser, modifiers: ClassModifiers) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'class'

    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "class name".to_string(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        ("<error>".to_string(), parser.current_span())
    };

    if is_reserved_class_name(&name) {
        parser.error(ParseError::Forbidden {
            message: format!("cannot use '{}' as class name", name),
            span: name_span,
        });
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let n = parser.parse_name();
        validate_class_ref(parser, &n);
        Some(n)
    } else { None };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        let names = parse_name_list(parser);
        for n in &names { validate_class_ref(parser, n); }
        names
    } else { Vec::new() };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Class(ClassDecl { name: Some(name), modifiers, extends, implements, members, attributes: Vec::new() }),
        span: Span::new(start, end),
    }
}

pub fn parse_name_list(parser: &mut Parser) -> Vec<Name> {
    let mut names = Vec::new();
    names.push(parser.parse_name());
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::LeftBrace) || parser.check(TokenKind::Semicolon) { break; } // trailing comma
        names.push(parser.parse_name());
    }
    names
}

/// Parse trait adaptation block: `{ A::foo insteadof B; foo as bar; ... }`
/// Called after consuming `{`.
fn parse_trait_adaptations(parser: &mut Parser) -> Vec<TraitAdaptation> {
    let mut adaptations = Vec::new();
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
                    expected: "method name".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                "<error>".to_string()
            };

            // Check for `insteadof` or `as`
            if parser.check(TokenKind::Identifier) && parser.current_text() == "insteadof" {
                parser.advance(); // consume `insteadof`
                let mut insteadof = vec![parser.parse_name()];
                while parser.eat(TokenKind::Comma).is_some() {
                    if parser.check(TokenKind::Semicolon) { break; } // trailing comma
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
                        method,
                        new_modifier,
                        new_name,
                    },
                    span,
                });
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'insteadof' or 'as'".to_string(),
                    found: parser.current_kind(),
                    span,
                });
                parser.advance();
            }
        } else if parser.eat(TokenKind::As).is_some() {
            // Unqualified alias: method as [visibility] [newName];
            let method = first_name.parts.join("\\");
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
                expected: "'::' or 'as'".to_string(),
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
fn parse_alias_rhs(parser: &mut Parser) -> (Option<Visibility>, Option<String>) {
    let new_modifier = match parser.current_kind() {
        TokenKind::Public => { parser.advance(); Some(Visibility::Public) }
        TokenKind::Protected => { parser.advance(); Some(Visibility::Protected) }
        TokenKind::Private => { parser.advance(); Some(Visibility::Private) }
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
fn parse_property_hooks(parser: &mut Parser) -> Vec<PropertyHook> {
    let open = parser.expect(TokenKind::LeftBrace);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());

    let mut hooks = Vec::new();

    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let hook_start = parser.start_span();

        // Parse optional attributes
        let hook_attrs = parser.parse_attributes();

        // Parse optional modifiers
        let mut is_final = false;
        let mut by_ref = false;

        loop {
            match parser.current_kind() {
                TokenKind::Final => { parser.advance(); is_final = true; }
                TokenKind::Ampersand => { parser.advance(); by_ref = true; break; }
                // Error: invalid modifiers on hooks
                TokenKind::Public | TokenKind::Protected | TokenKind::Private
                | TokenKind::Abstract | TokenKind::Static | TokenKind::Readonly => {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "'get' or 'set'".to_string(),
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
                        expected: "'get' or 'set'".to_string(),
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
                expected: "'get' or 'set'".to_string(),
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
            Vec::new()
        };

        // Parse body: { stmts } | => expr; | ;
        let body = if parser.check(TokenKind::LeftBrace) {
            let open_brace = parser.expect(TokenKind::LeftBrace);
            let brace_span = open_brace.map(|t| t.span).unwrap_or(parser.current_span());
            let mut stmts = Vec::new();
            while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                let span_before = parser.current_span();
                stmts.push(parse_stmt(parser));
                if parser.current_span() == span_before { parser.advance(); }
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

pub fn parse_class_members(parser: &mut Parser) -> Vec<ClassMember> {
    let mut members = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        // Skip empty statements
        if parser.check(TokenKind::Semicolon) { parser.advance(); continue; }

        let member_start = parser.start_span();

        // Parse member attributes
        let member_attrs = parser.parse_attributes();

        // Trait use: use TraitName;  or  use A, B { ... }
        if parser.check(TokenKind::Use) {
            parser.advance();
            let mut traits = Vec::new();
            traits.push(parser.parse_name());
            while parser.eat(TokenKind::Comma).is_some() {
                if parser.check(TokenKind::Semicolon) || parser.check(TokenKind::LeftBrace) { break; } // trailing comma
                traits.push(parser.parse_name());
            }
            let adaptations = if parser.check(TokenKind::LeftBrace) {
                parser.advance();
                parse_trait_adaptations(parser)
            } else {
                parser.expect(TokenKind::Semicolon);
                Vec::new()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(ClassMember { kind: ClassMemberKind::TraitUse(TraitUseDecl { traits, adaptations }), span });
            continue;
        }

        // Parse modifiers
        let mut visibility = None;
        let mut set_visibility = None;
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
                        if matches!(parser.current_kind(), TokenKind::Public | TokenKind::Protected | TokenKind::Private)
                            && parser.peek_kind() == Some(TokenKind::LeftParen)
                        {
                            let set_vis = match parser.current_kind() {
                                TokenKind::Public => Visibility::Public,
                                TokenKind::Protected => Visibility::Protected,
                                _ => Visibility::Private,
                            };
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
                            parser.advance(); // consume (
                            if parser.current_text() == "set" {
                                parser.advance(); // consume "set"
                            }
                            parser.expect(TokenKind::RightParen);
                            set_visibility = Some(vis);
                        } else {
                            // Duplicate or conflicting visibility
                            parser.error(ParseError::Forbidden {
                                message: "cannot use multiple visibility modifiers".to_string(),
                                span: Span::new(member_start, parser.current_span().start),
                            });
                        }
                    }
                }
                TokenKind::Static => {
                    if is_static {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'static'".to_string(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance(); is_static = true;
                }
                TokenKind::Abstract => {
                    if is_abstract {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'abstract'".to_string(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance(); is_abstract = true;
                }
                TokenKind::Final => {
                    if is_final {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'final'".to_string(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance(); is_final = true;
                }
                TokenKind::Readonly => {
                    if is_readonly {
                        parser.error(ParseError::Forbidden {
                            message: "duplicate modifier 'readonly'".to_string(),
                            span: Span::new(member_start, parser.current_span().start),
                        });
                    }
                    parser.advance(); is_readonly = true;
                }
                _ => break,
            }
        }

        // Validate modifier conflicts
        if is_abstract && is_final {
            parser.error(ParseError::Forbidden {
                message: "cannot use 'abstract' and 'final' together".to_string(),
                span: Span::new(member_start, parser.current_span().start),
            });
        }

        // Detect unknown modifier: bare identifier followed by $variable with no modifiers
        if visibility.is_none() && !is_static && !is_abstract && !is_final && !is_readonly
            && parser.check(TokenKind::Identifier)
            && parser.peek_kind() == Some(TokenKind::Variable)
        {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "modifier".to_string(),
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
                    message: "cannot use 'static' as constant modifier".to_string(),
                    span: parser.current_span(),
                });
            }
            if is_abstract {
                parser.error(ParseError::Forbidden {
                    message: "cannot use 'abstract' as constant modifier".to_string(),
                    span: parser.current_span(),
                });
            }
            if is_readonly {
                parser.error(ParseError::Forbidden {
                    message: "cannot use 'readonly' as constant modifier".to_string(),
                    span: parser.current_span(),
                });
            }
            parser.advance();

            // Check for typed constant: if what follows looks like a type hint
            // and is NOT immediately followed by `=`, it's a typed constant
            let const_type = if parser.could_be_type_hint()
                && !parser.check(TokenKind::Variable)
                && parser.peek_kind() != Some(TokenKind::Equals)
                && parser.peek_kind() != Some(TokenKind::Comma)
            {
                Some(parser.parse_type_hint())
            } else {
                None
            };

            let mut const_items = Vec::new();
            loop {
                let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                    text
                } else {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "constant name".to_string(),
                        found: parser.current_kind(),
                        span,
                    });
                    "<error>".to_string()
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
                    message: "cannot use attributes on multi-constant declaration".to_string(),
                    span,
                });
            }
            for (const_name, value) in const_items {
                members.push(ClassMember {
                    kind: ClassMemberKind::ClassConst(ClassConstDecl {
                        name: const_name, visibility, type_hint: const_type.clone(),
                        value, attributes: member_attrs.clone(),
                    }),
                    span,
                });
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
                    expected: "method name".to_string(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>".to_string()
            };

            parser.expect(TokenKind::LeftParen);
            let params = parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            let return_type = if parser.eat(TokenKind::Colon).is_some() {
                Some(parser.parse_type_hint())
            } else { None };

            let body = if parser.check(TokenKind::LeftBrace) {
                parser.expect(TokenKind::LeftBrace);
                let mut stmts = Vec::new();
                while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                    let span_before = parser.current_span();
                    stmts.push(parse_stmt(parser));
                    if parser.current_span() == span_before { parser.advance(); }
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
                    name: method_name, visibility, is_static, is_abstract, is_final,
                    by_ref, params, return_type, body, attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Property — may have type hint, then $variable
        let type_hint = if parser.could_be_type_hint()
            && !parser.check(TokenKind::Variable)
        {
            Some(parser.parse_type_hint())
        } else { None };

        if parser.check(TokenKind::Variable) {
            let var_token = parser.advance();
            let text = &parser.source()[var_token.span.start as usize..var_token.span.end as usize];
            let prop_name = text[1..].to_string();

            let default = if parser.eat(TokenKind::Equals).is_some() {
                Some(expr::parse_expr(parser))
            } else { None };

            // Property hooks: { get { ... } set { ... } }
            let had_hooks_block = parser.check(TokenKind::LeftBrace);
            let hooks = if had_hooks_block {
                parse_property_hooks(parser)
            } else {
                Vec::new()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(ClassMember {
                kind: ClassMemberKind::Property(PropertyDecl {
                    name: prop_name, visibility, set_visibility, is_static, is_readonly,
                    type_hint: type_hint.clone(), default, attributes: member_attrs.clone(), hooks,
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
                    let text = &parser.source()[var_token.span.start as usize..var_token.span.end as usize];
                    let pname = text[1..].to_string();

                    let pdefault = if parser.eat(TokenKind::Equals).is_some() {
                        Some(expr::parse_expr(parser))
                    } else { None };

                    // Property hooks on comma-separated properties → error
                    let phooks = if parser.check(TokenKind::LeftBrace) {
                        parser.error(ParseError::Forbidden {
                            message: "cannot have hooks on comma-separated property".to_string(),
                            span: parser.current_span(),
                        });
                        parse_property_hooks(parser)
                    } else {
                        Vec::new()
                    };
                    let pspan = Span::new(member_start, parser.current_span().start);
                    members.push(ClassMember {
                        kind: ClassMemberKind::Property(PropertyDecl {
                            name: pname, visibility: None, set_visibility: None,
                            is_static, is_readonly,
                            type_hint: type_hint.clone(), default: pdefault,
                            attributes: member_attrs.clone(), hooks: phooks,
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

fn parse_interface(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "interface name".to_string(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        ("<error>".to_string(), parser.current_span())
    };

    if is_reserved_class_name(&name) {
        parser.error(ParseError::Forbidden {
            message: format!("cannot use '{}' as interface name", name),
            span: name_span,
        });
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let names = parse_name_list(parser);
        for n in &names { validate_class_ref(parser, n); }
        names
    } else { Vec::new() };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Interface(InterfaceDecl { name, extends, members, attributes: Vec::new() }),
        span: Span::new(start, end),
    }
}

fn parse_trait(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance();
    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "trait name".to_string(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>".to_string()
    };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser);
    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);

    Stmt {
        kind: StmtKind::Trait(TraitDecl { name, members, attributes: Vec::new() }),
        span: Span::new(start, end),
    }
}

fn parse_enum(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'enum'

    let name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "enum name".to_string(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        "<error>".to_string()
    };

    // Backed enum: enum Foo: string
    let scalar_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_name())
    } else { None };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        parse_name_list(parser)
    } else { Vec::new() };

    parser.expect(TokenKind::LeftBrace);

    let mut members = Vec::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) { parser.advance(); continue; }
        let member_attrs = parser.parse_attributes();
        let member_start = parser.start_span();

        // Trait use
        if parser.check(TokenKind::Use) {
            parser.advance();
            let mut traits = Vec::new();
            traits.push(parser.parse_name());
            while parser.eat(TokenKind::Comma).is_some() {
                traits.push(parser.parse_name());
            }
            let adaptations = if parser.check(TokenKind::LeftBrace) {
                parser.advance();
                parse_trait_adaptations(parser)
            } else {
                parser.expect(TokenKind::Semicolon);
                Vec::new()
            };
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember { kind: EnumMemberKind::TraitUse(TraitUseDecl { traits, adaptations }), span });
            continue;
        }

        // Enum case
        if parser.check(TokenKind::Case) {
            parser.advance();
            if parser.check(TokenKind::Class) {
                let span = parser.current_span();
                parser.error(ParseError::Forbidden {
                    message: "'class' cannot be used as an enum case name".to_string(),
                    span,
                });
            }
            let case_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                parser.error(ParseError::Expected {
                    expected: "case name".to_string(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>".to_string()
            };
            let value = if parser.eat(TokenKind::Equals).is_some() {
                Some(expr::parse_expr(parser))
            } else { None };
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::Case(EnumCase { name: case_name, value, attributes: member_attrs }),
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
                TokenKind::Public => { parser.advance(); visibility = Some(Visibility::Public); }
                TokenKind::Protected => { parser.advance(); visibility = Some(Visibility::Protected); }
                TokenKind::Private => { parser.advance(); visibility = Some(Visibility::Private); }
                TokenKind::Static => { parser.advance(); is_static = true; }
                TokenKind::Abstract => { parser.advance(); is_abstract = true; }
                TokenKind::Final => { parser.advance(); is_final = true; }
                _ => break,
            }
        }

        // Const
        if parser.check(TokenKind::Const) {
            parser.advance();
            let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                parser.error(ParseError::Expected {
                    expected: "constant name".to_string(),
                    found: parser.current_kind(),
                    span: parser.current_span(),
                });
                "<error>".to_string()
            };
            parser.expect(TokenKind::Equals);
            let value = expr::parse_expr(parser);
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.current_span().start);
            members.push(EnumMember {
                kind: EnumMemberKind::ClassConst(ClassConstDecl { name: const_name, visibility, type_hint: None, value, attributes: member_attrs }),
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
            } else { "<error>".to_string() };

            parser.expect(TokenKind::LeftParen);
            let params = parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            let return_type = if parser.eat(TokenKind::Colon).is_some() {
                Some(parser.parse_type_hint())
            } else { None };

            let body = if parser.check(TokenKind::LeftBrace) {
                parser.expect(TokenKind::LeftBrace);
                let mut stmts = Vec::new();
                while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                    let span_before = parser.current_span();
                    stmts.push(parse_stmt(parser));
                    if parser.current_span() == span_before { parser.advance(); }
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
                    name: method_name, visibility, is_static, is_abstract, is_final,
                    by_ref, params, return_type, body, attributes: member_attrs,
                }),
                span,
            });
            continue;
        }

        // Unknown — skip
        parser.advance();
    }

    let close = parser.expect(TokenKind::RightBrace);
    let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
    Stmt {
        kind: StmtKind::Enum(EnumDecl { name, scalar_type, implements, members, attributes: Vec::new() }),
        span: Span::new(start, end),
    }
}

// =============================================================================
// Namespace / Use / Const
// =============================================================================

fn parse_namespace(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'namespace'

    // namespace { ... } (global namespace) or namespace Name { ... } or namespace Name;
    if parser.check(TokenKind::LeftBrace) {
        // Global namespace block
        parser.expect(TokenKind::LeftBrace);
        let mut stmts = Vec::new();
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            stmts.push(parse_stmt(parser));
            if parser.current_span() == span_before { parser.advance(); }
        }
        let close = parser.expect(TokenKind::RightBrace);
        let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
        return Stmt {
            kind: StmtKind::Namespace(NamespaceDecl {
                name: None,
                body: NamespaceBody::Braced(stmts),
            }),
            span: Span::new(start, end),
        };
    }

    let name = parser.parse_name();

    if parser.check(TokenKind::LeftBrace) {
        // Braced namespace: namespace Foo\Bar { ... }
        parser.expect(TokenKind::LeftBrace);
        let mut stmts = Vec::new();
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            stmts.push(parse_stmt(parser));
            if parser.current_span() == span_before { parser.advance(); }
        }
        let close = parser.expect(TokenKind::RightBrace);
        let end = close.map(|t| t.span.end).unwrap_or(parser.current_span().start);
        Stmt {
            kind: StmtKind::Namespace(NamespaceDecl {
                name: Some(name),
                body: NamespaceBody::Braced(stmts),
            }),
            span: Span::new(start, end),
        }
    } else {
        // Simple namespace: namespace Foo\Bar;
        parser.expect(TokenKind::Semicolon);
        let span = Span::new(start, parser.current_span().start);
        Stmt {
            kind: StmtKind::Namespace(NamespaceDecl {
                name: Some(name),
                body: NamespaceBody::Simple,
            }),
            span,
        }
    }
}

fn parse_use(parser: &mut Parser) -> Stmt {
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

    let mut uses = Vec::new();

    // Parse first name to check for group use
    let item_start = parser.start_span();
    let first_name = parser.parse_name();

    // Group use: use App\{Models\User, Services\Auth};
    if parser.check(TokenKind::LeftBrace) {
        // Validate: prefix must have trailing \ (i.e., parse_name consumed a trailing \)
        // If the name is Unqualified with 1 part, and the char before { is not \, error
        if first_name.kind == NameKind::Unqualified {
            // Check if the source char before the current position is not '\'
            let brace_pos = parser.current_span().start as usize;
            let has_trailing_sep = brace_pos > 0 && parser.source().as_bytes()[brace_pos - 1] == b'\\';
            if !has_trailing_sep {
                parser.error(ParseError::Expected {
                    expected: "namespace separator before '{'".to_string(),
                    found: parser.current_kind(),
                    span: first_name.span,
                });
            }
        }
        parser.advance(); // consume {
        if parser.check(TokenKind::RightBrace) {
            parser.error(ParseError::Expected {
                expected: "at least one import in group use".to_string(),
                found: TokenKind::RightBrace,
                span: parser.current_span(),
            });
        }
        let prefix_parts = &first_name.parts;
        loop {
            if parser.check(TokenKind::RightBrace) { break; } // trailing comma
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
            if sub_name.kind == NameKind::FullyQualified {
                parser.error(ParseError::Expected {
                    expected: "non-fully-qualified name in group use".to_string(),
                    found: parser.current_kind(),
                    span: sub_name.span,
                });
            }

            // Combine prefix with sub-name
            let mut combined_parts = prefix_parts.clone();
            combined_parts.extend(sub_name.parts);
            let sub_span = Span::new(item_start, parser.current_span().start);
            let combined_name = Name {
                parts: combined_parts,
                kind: if first_name.kind == NameKind::FullyQualified {
                    NameKind::FullyQualified
                } else {
                    NameKind::Qualified
                },
                span: sub_span,
            };

            let alias = if parser.eat(TokenKind::As).is_some() {
                let alias_token = parser.expect(TokenKind::Identifier);
                alias_token.map(|t| parser.source()[t.span.start as usize..t.span.end as usize].to_string())
            } else {
                None
            };

            let use_span = Span::new(sub_start, parser.current_span().start);
            uses.push(UseItem { name: combined_name, alias, kind: item_kind, span: use_span });

            if parser.eat(TokenKind::Comma).is_none() { break; }
        }
        parser.expect(TokenKind::RightBrace);
    } else {
        // Regular use (possibly comma-separated)
        let alias = if parser.eat(TokenKind::As).is_some() {
            let alias_token = parser.expect(TokenKind::Identifier);
            alias_token.map(|t| parser.source()[t.span.start as usize..t.span.end as usize].to_string())
        } else { None };

        let item_span = Span::new(item_start, parser.current_span().start);
        uses.push(UseItem { name: first_name, alias, kind: None, span: item_span });

        while parser.eat(TokenKind::Comma).is_some() {
            if parser.check(TokenKind::Semicolon) { break; } // trailing comma
            let next_start = parser.start_span();
            let name = parser.parse_name();

            let alias = if parser.eat(TokenKind::As).is_some() {
                let alias_token = parser.expect(TokenKind::Identifier);
                alias_token.map(|t| parser.source()[t.span.start as usize..t.span.end as usize].to_string())
            } else { None };

            let next_span = Span::new(next_start, parser.current_span().start);
            uses.push(UseItem { name, alias, kind: None, span: next_span });
        }
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Use(UseDecl { kind, uses }), span }
}

fn parse_const(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'const'

    let mut items = Vec::new();
    loop {
        let item_start = parser.start_span();
        let const_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
            text
        } else {
            parser.error(ParseError::Expected {
                expected: "constant name".to_string(),
                found: parser.current_kind(),
                span: parser.current_span(),
            });
            "<error>".to_string()
        };
        parser.expect(TokenKind::Equals);
        let value = expr::parse_expr(parser);
        let item_span = Span::new(item_start, value.span.end);
        items.push(ConstItem { name: const_name, value, span: item_span });

        if parser.eat(TokenKind::Comma).is_none() { break; }
        if parser.check(TokenKind::Semicolon) { break; } // trailing comma
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Const(items), span }
}

fn parse_halt_compiler(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();

    // __halt_compiler must be at the outermost scope
    if parser.depth > 0 {
        parser.error(ParseError::Forbidden {
            message: "__halt_compiler() can only be used at the outermost scope".to_string(),
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
            expected: "';' or '?>'".to_string(),
            after: "__halt_compiler()".to_string(),
            span: parser.current_span(),
        });
    }

    // Everything after __halt_compiler(); is raw data
    let current_pos = parser.current_span().start as usize;
    let remaining = parser.source()[current_pos..].to_string();

    // Advance to EOF so the parser stops
    while !parser.check(TokenKind::Eof) {
        parser.advance();
    }

    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::HaltCompiler(remaining), span }
}

fn parse_static_var(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    parser.advance(); // consume 'static'

    let mut vars = Vec::new();
    loop {
        let var_start = parser.start_span();
        let var_token = parser.expect(TokenKind::Variable);
        let name = var_token
            .map(|t| {
                let text = &parser.source()[t.span.start as usize..t.span.end as usize];
                text[1..].to_string()
            })
            .unwrap_or_else(|| "<error>".to_string());

        let default = if parser.eat(TokenKind::Equals).is_some() {
            Some(expr::parse_expr(parser))
        } else { None };

        let var_span = Span::new(var_start, default.as_ref().map(|e| e.span.end).unwrap_or(parser.current_span().start));
        vars.push(StaticVar { name, default, span: var_span });

        if parser.eat(TokenKind::Comma).is_none() { break; }
        if parser.check(TokenKind::Semicolon) { break; } // trailing comma
    }

    parser.expect(TokenKind::Semicolon);
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::StaticVar(vars), span }
}

// =============================================================================
// Expression statement (and label detection)
// =============================================================================

fn parse_expression_stmt_or_label(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if let ExprKind::Identifier(ref name) = expr.kind {
        if parser.eat(TokenKind::Colon).is_some() {
            let span = Span::new(start, parser.current_span().start);
            return Stmt { kind: StmtKind::Label(name.clone()), span };
        }
    }

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt { kind: StmtKind::Error, span: Span::new(start, parser.current_span().start) };
    }

    parser.expect_semicolon("expression");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Expression(expr), span }
}

fn parse_expression_stmt(parser: &mut Parser) -> Stmt {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt { kind: StmtKind::Error, span: Span::new(start, parser.current_span().start) };
    }

    parser.expect_semicolon("expression");
    let span = Span::new(start, parser.current_span().start);
    Stmt { kind: StmtKind::Expression(expr), span }
}
