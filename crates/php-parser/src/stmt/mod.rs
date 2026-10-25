use php_ast::*;
use php_lexer::TokenKind;

use crate::attributes::{AttrSite, AttrTarget};
use crate::diagnostics::{ForbiddenRule, ParseError};
use crate::expr;
use crate::instrument;
use crate::parser::Parser;
use crate::version::PhpVersion;

mod class;
mod enum_decl;
mod trait_use;

pub(crate) use class::check_abstract_hooks;
pub(crate) use class::validate_class_ref;
pub use class::{check_readonly_class_members, parse_class_members, parse_name_list};

/// Push the next statement, or the inline HTML or `<?=` echo between PHP tags; a `?>`
/// is a `Nop` unless it ends the statement before it, and a bare `<?php` is skipped.
pub(crate) fn push_stmt<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    stmts: &mut ArenaVec<'arena, Stmt<'arena, 'src>>,
) {
    match parser.current_kind() {
        TokenKind::CloseTag => {
            let ends_stmt = parser.stmt_ending_close_tag == Some(parser.current_span().start);
            let tag = parser.advance();
            if !ends_stmt {
                stmts.push(Stmt {
                    kind: StmtKind::Nop,
                    span: tag.span,
                    doc_comment: None,
                });
            }
        }
        TokenKind::InlineHtml => {
            let token = parser.advance();
            stmts.push(Stmt {
                kind: StmtKind::InlineHtml(
                    &parser.source[token.span.start as usize..token.span.end as usize],
                ),
                span: token.span,
                doc_comment: None,
            });
        }
        TokenKind::OpenTag => {
            let tag = parser.advance();
            if parser.source[tag.span.start as usize..tag.span.end as usize] == *"<?=" {
                stmts.push(parser.parse_short_echo(tag.span.start));
            }
        }
        _ => stmts.push(parse_stmt(parser)),
    }
}

/// Parse a single statement.
///
/// # Stack depth
///
/// This is a recursive-descent parser: every nested block, `if`/`while`/`for` body, and similar
/// construct recurses through `parse_stmt`. Each statement takes one unit of the nesting budget
/// shared with expressions, so pathologically deep input yields
/// [`ParseError::NestingTooDeep`] rather than a stack overflow.
pub fn parse_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    if !parser.enter_nesting() {
        return Stmt {
            kind: StmtKind::Error,
            span: parser.missing_span(),
            doc_comment: None,
        };
    }
    // Snapshot the values we need for doc-comment attachment *before* the
    // inner parse, because parsing the statement body updates them:
    //
    // • `doc_start`      – the source position of the first token of this
    //                      statement.  Only doc comments that END before this
    //                      position can belong to this statement.
    //
    // • `scope_open_at`  – the current `last_scope_close` (which tracks the
    //                      end of the most recent `{` or `}`).  Any doc comment
    //                      that STARTS before this boundary belongs to an outer
    //                      or already-closed scope and must not be claimed here.
    //
    // • `stmt_open_at`   – the current `stmt_boundary()` (end of the most
    //                      recently fully-parsed statement, at any nesting
    //                      level). Any doc comment that STARTS before this
    //                      position lies inside an already-completed sibling
    //                      statement — e.g. above a closure argument nested in
    //                      an earlier statement's call — and must not leak
    //                      forward to this one.
    //
    // We call `take_doc_comment_from` *after* the inner parse for one reason:
    // declaration parsers (function, class, …) call `take_doc_comment` for
    // themselves during the inner parse and remove the comment from the list.
    // That means when we reach the post-parse claim the comment is already gone
    // for declarations (returns None) but still present for non-declarations
    // (foreach, assignments, if, …).
    //
    // Saving `scope_open_at` and `stmt_open_at` beforehand is the key: parsing
    // the body advances `last_scope_close` (via the `{` and `}` tokens inside
    // the body) and `last_stmt_end` (via nested statements inside the body)
    // past the doc comment's position, so we cannot use their *current* values
    // as a lower bound at claim time — we use the *saved* values instead.
    let doc_start = parser.current_span().start;
    let scope_open_at = parser.scope_boundary();
    let stmt_open_at = parser.stmt_boundary();
    parser.stmt_depth += 1;
    let mut stmt = parse_stmt_inner(parser);
    parser.stmt_depth -= 1;
    stmt.doc_comment = parser
        .take_doc_comment_from(doc_start, scope_open_at.max(stmt_open_at))
        .map(|c| parser.alloc(c));
    parser.mark_stmt_end(stmt.span.end);
    parser.leave_nesting();
    stmt
}

fn parse_stmt_inner<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_stmt();

    // Handle attributes: #[...] before declarations
    if parser.check(TokenKind::HashBracket) {
        return parse_attributed_stmt(parser);
    }

    match parser.current_kind() {
        kind if is_label_name(kind, parser.version)
            && kind != TokenKind::Identifier
            && parser.peek_kind() == Some(TokenKind::Colon) =>
        {
            parse_label(parser)
        }
        // A `?>` where a statement is expected is an empty statement; the HTML after it is not.
        TokenKind::CloseTag => {
            let tag = parser.advance();
            Stmt {
                kind: StmtKind::Nop,
                span: tag.span,
                doc_comment: None,
            }
        }
        TokenKind::Semicolon => {
            let span = parser.current_span();
            parser.advance();
            Stmt {
                kind: StmtKind::Nop,
                span,
                doc_comment: None,
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
        TokenKind::Class => {
            class::parse_class(parser, ClassModifiers::default(), parser.alloc_vec())
        }
        TokenKind::Abstract | TokenKind::Final => parse_modified_class(parser, parser.alloc_vec()),
        TokenKind::Readonly
            if matches!(
                parser.peek_kind(),
                Some(
                    TokenKind::Class | TokenKind::Final | TokenKind::Abstract | TokenKind::Readonly
                )
            ) =>
        {
            parse_modified_class(parser, parser.alloc_vec())
        }
        // `readonly` as a function name, e.g. `readonly()`.
        TokenKind::Readonly => parse_expression_stmt(parser),
        TokenKind::Interface => class::parse_interface(parser, parser.alloc_vec()),
        TokenKind::Trait => class::parse_trait(parser, parser.alloc_vec()),
        TokenKind::Enum_ => {
            // `enum` introduces an enum declaration only when followed by a name
            // (the enum name). In any other position — `Enum::class`, `Enum()`,
            // `new Enum`, etc. — it's an ordinary name referring to a class/function.
            //
            // The name may itself spell `enum` (PHP lexes a second `enum` not
            // followed by a label as a plain identifier, so `enum Enum {}` is a
            // valid declaration). Fully-reserved words like `match`/`list`/`fn`
            // cannot name an enum, so they correctly fall through to expression
            // parsing here.
            if matches!(
                parser.peek_kind(),
                Some(TokenKind::Identifier | TokenKind::Enum_)
            ) {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php81, "enums", span);
                enum_decl::parse_enum(parser, parser.alloc_vec())
            } else {
                parse_expression_stmt(parser)
            }
        }
        TokenKind::Namespace => {
            // namespace\ is a relative name (expression), not a namespace declaration
            if parser.peek_kind() == Some(TokenKind::Backslash) {
                parse_expression_stmt(parser)
            } else {
                check_top_level(parser, "namespace declarations");
                parse_namespace(parser)
            }
        }
        TokenKind::Use => {
            check_top_level(parser, "'use' declarations");
            parse_use(parser)
        }
        TokenKind::Const => {
            check_top_level(parser, "'const' declarations");
            parse_const(parser)
        }
        TokenKind::HaltCompiler if parser.peek_kind() != Some(TokenKind::Backslash) => {
            parse_halt_compiler(parser)
        }
        TokenKind::Static => {
            // Could be: static $var = ...; or static function or static as expression
            let next = parser.peek_kind();
            if matches!(next, Some(TokenKind::Variable)) {
                parse_static_var(parser)
            } else if matches!(next, Some(TokenKind::Semicolon)) {
                // `static;` is not valid — PHP expects `::` after standalone `static`.
                let start = parser.start_span();
                let token = parser.advance(); // consume 'static'
                parser.forbid(
                    ForbiddenRule::StaticStandaloneExpression,
                    "Cannot use 'static' as a standalone expression",
                    token.span,
                );
                parser.expect_semicolon("expression");
                let span = parser.span_from(start);
                Stmt {
                    kind: StmtKind::Expression(parser.alloc(Expr {
                        kind: ExprKind::Name(Name::Simple {
                            value: "static",
                            span: token.span,
                        }),
                        span: token.span,
                    })),
                    span,
                    doc_comment: None,
                }
            } else {
                parse_expression_stmt(parser)
            }
        }
        // Label: `name:` — but only if followed by Colon
        TokenKind::Identifier => parse_expression_stmt_or_label(parser),
        TokenKind::Eof => {
            parser.error_expected("statement");
            Stmt {
                kind: StmtKind::Error,
                span: parser.missing_span(),
                doc_comment: None,
            }
        }
        TokenKind::LessThan if open_tag_len(parser).is_some() => parse_nested_open_tag(parser),
        _ => parse_expression_stmt(parser),
    }
}

/// Length of the `<?php`, `<?=` or `<?` that the lexer read as `<` at the current token; PHP
/// lexes no open tag inside PHP code.
fn open_tag_len(parser: &Parser<'_, '_>) -> Option<u32> {
    let rest = &parser.source()[parser.current_span().start as usize..];
    let tag = rest.as_bytes().get(..5);
    if tag.is_some_and(|t| t.eq_ignore_ascii_case(b"<?php")) {
        Some(5)
    } else if rest.starts_with("<?=") {
        Some(3)
    } else {
        rest.starts_with("<?").then_some(2)
    }
}

/// Report an open tag inside PHP code once and skip it, so the statement after it is parsed.
fn parse_nested_open_tag<'arena, 'src>(parser: &mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let end = start + open_tag_len(parser).unwrap_or(1);
    parser.error_expected("expression");
    while parser.current_span().start < end && !parser.check(TokenKind::Eof) {
        parser.advance();
    }
    Stmt {
        kind: StmtKind::Error,
        span: parser.span_from(start),
        doc_comment: None,
    }
}

/// `ClassModifiers` is `#[non_exhaustive]`, so it is built from its default.
pub(crate) fn class_modifiers(
    is_abstract: bool,
    is_final: bool,
    is_readonly: bool,
) -> ClassModifiers {
    let mut modifiers = ClassModifiers::default();
    modifiers.is_abstract = is_abstract;
    modifiers.is_final = is_final;
    modifiers.is_readonly = is_readonly;
    modifiers
}

/// Parse `abstract`, `final` and `readonly` before `class`, reporting a repeated modifier or
/// `abstract` with `final` where PHP does, at the modifier that completes it.
fn parse_modified_class<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let mut modifiers = ClassModifiers::default();
    let mut readonly_span = None;
    loop {
        let (seen, name) = match parser.current_kind() {
            TokenKind::Abstract => (&mut modifiers.is_abstract, "abstract"),
            TokenKind::Final => (&mut modifiers.is_final, "final"),
            TokenKind::Readonly => (&mut modifiers.is_readonly, "readonly"),
            _ => break,
        };
        let repeated = std::mem::replace(seen, true);
        let token = parser.advance();
        if repeated {
            parser.forbid(
                ForbiddenRule::DuplicateModifier,
                format!("Multiple {name} modifiers are not allowed"),
                token.span,
            );
        } else if name == "readonly" {
            readonly_span = Some(token.span);
        } else if modifiers.is_abstract && modifiers.is_final {
            parser.forbid(
                ForbiddenRule::AbstractFinalConflict,
                "Cannot use the final modifier on an abstract class",
                parser.span_from(start),
            );
        }
    }
    if !parser.check(TokenKind::Class) {
        return class_modifier_error(parser, start);
    }
    if let Some(span) = readonly_span {
        let feature = if modifiers.is_abstract {
            "abstract readonly class"
        } else {
            "readonly class"
        };
        parser.require_version(PhpVersion::Php82, feature, span);
    }
    class::parse_class(parser, modifiers, attributes)
}

fn class_modifier_error<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    start: u32,
) -> Stmt<'arena, 'src> {
    let span = parser.span_from(start);
    parser.error(ParseError::Expected {
        expected: "'class'".into(),
        found: parser.current_kind().description().into(),
        span,
    });
    parser.synchronize();
    Stmt {
        kind: StmtKind::Error,
        span,
        doc_comment: None,
    }
}

/// Parse a statement preceded by attributes; its span starts at the first attribute.
fn parse_attributed_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let attr_start = parser.start_span();
    let mut stmt = parse_stmt_after_attributes(parser, attr_start);
    if stmt.span.start > attr_start {
        stmt.span = Span::new(attr_start, stmt.span.end.max(attr_start));
    }
    stmt
}

fn parse_stmt_after_attributes<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attr_start: u32,
) -> Stmt<'arena, 'src> {
    let attributes = parser.parse_attributes();

    // Anonymous closure / arrow fn / static closure used as an expression
    // statement: `#[A] function() {};`, `#[A] fn() => 42;`,
    // `#[A] static function() {};`, `#[A] static fn() => ...;`.
    // A function whose next token is `(` or `&(` is a closure, not a
    // declaration.
    let is_closure_start = match parser.current_kind() {
        TokenKind::Function => match parser.peek_kind() {
            Some(TokenKind::LeftParen) => true,
            Some(TokenKind::Ampersand) => parser.peek2_kind() == Some(TokenKind::LeftParen),
            _ => false,
        },
        TokenKind::Fn_ => true,
        TokenKind::Static => matches!(
            parser.peek_kind(),
            Some(TokenKind::Function) | Some(TokenKind::Fn_)
        ),
        _ => false,
    };
    if is_closure_start {
        let is_static = parser.eat(TokenKind::Static).is_some();
        let expr = if parser.check(TokenKind::Function) {
            expr::parse_closure(parser, is_static, attr_start, attributes)
        } else {
            expr::parse_arrow_function(parser, is_static, attr_start, attributes)
        };
        parser.expect_semicolon("expression statement");
        let span = parser.span_from(attr_start);
        return Stmt {
            kind: StmtKind::Expression(parser.alloc(expr)),
            span,
            doc_comment: None,
        };
    }

    // Now dispatch based on what follows
    let stmt = match parser.current_kind() {
        TokenKind::Function => return parse_function(parser, attributes),
        TokenKind::Class => {
            return class::parse_class(parser, ClassModifiers::default(), attributes)
        }
        TokenKind::Abstract | TokenKind::Final | TokenKind::Readonly => {
            parse_modified_class(parser, attributes)
        }
        TokenKind::Interface => return class::parse_interface(parser, attributes),
        TokenKind::Trait => return class::parse_trait(parser, attributes),
        TokenKind::Enum_ => {
            let span = parser.current_span();
            parser.require_version(PhpVersion::Php81, "enums", span);
            return enum_decl::parse_enum(parser, attributes);
        }
        TokenKind::Const => {
            check_top_level(parser, "'const' declarations");
            // Attributes on top-level constants require PHP 8.5.
            let attr_span = parser.current_span();
            parser.require_version(PhpVersion::Php85, "attributes on constants", attr_span);
            let stmt = parse_const_with_attrs(parser, attributes);
            if let StmtKind::Const(ref items) = stmt.kind {
                // PHP 7.4 reads `#[` as a comment, so the attribute is only a version gate there.
                if items.len() > 1 && parser.version >= PhpVersion::Php80 {
                    parser.forbid(
                        ForbiddenRule::AttributesOnMultipleConstants,
                        "Cannot apply attributes to multiple constants at once",
                        stmt.span,
                    );
                }
                if let Some(first) = items
                    .first()
                    .filter(|_| parser.version >= PhpVersion::Php85)
                {
                    parser.check_attributes(&first.attributes, &AttrSite::new(AttrTarget::Const));
                }
            }
            return stmt;
        }
        _ => {
            // Attributes before something unexpected
            let start = parser.start_span();
            parser.error(ParseError::Expected {
                expected: "declaration after attributes".into(),
                found: parser.current_kind().description().into(),
                span: parser.current_span(),
            });
            parser.synchronize();
            Stmt {
                kind: StmtKind::Error,
                span: parser.span_from(start),
                doc_comment: None,
            }
        }
    };

    stmt
}

/// Parse the parenthesized condition of `if`, `while` or `switch`. Without its `(`, a `{` is
/// the body, not the start of the condition.
fn parse_paren_condition<'arena, 'src>(parser: &mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    let open = parser.expect(TokenKind::LeftParen);
    if open.is_none() && parser.check(TokenKind::LeftBrace) {
        return Expr {
            kind: ExprKind::Error,
            span: parser.missing_span(),
        };
    }
    let condition = expr::parse_expr(parser);
    parser.expect_paren_close(open);
    condition
}

/// Parse a block statement: `{ stmts }`
pub fn parse_block<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let open = parser.expect(TokenKind::LeftBrace);

    parser.depth += 1;
    // March 2026: reduce from 16 to 8 for statement blocks
    // Most blocks have 4-12 statements; larger blocks grow efficiently
    let mut stmts = parser.alloc_vec_with_capacity(8);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        push_stmt(parser, &mut stmts);
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    parser.depth -= 1;

    parser.expect_body_close(open);
    let span = parser.span_from(start);

    Stmt {
        kind: StmtKind::Block(parser.alloc(Block { stmts, span })),
        span,
        doc_comment: None,
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
        let span_before = parser.current_span();
        push_stmt(parser, &mut stmts);
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
            parser.trailing_comma_error("expression");
            break;
        }
        exprs.push(expr::parse_expr(parser));
    }

    parser.expect_semicolon("echo statement");
    let span = parser.span_from(start);

    Stmt {
        kind: StmtKind::Echo(exprs),
        span,
        doc_comment: None,
    }
}

// =============================================================================
// Return statement
// =============================================================================

fn parse_return<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'return'

    let expr = if parser.at_statement_end() {
        None
    } else {
        Some(expr::parse_expr(parser))
    };
    if let Some(value) = &expr {
        expr::check_reference_return(parser, value);
    }

    parser.expect_semicolon("return statement");
    let span = parser.span_from(start);

    Stmt {
        kind: StmtKind::Return(expr.map(|e| parser.alloc(e))),
        span,
        doc_comment: None,
    }
}

// =============================================================================
// If statement (with alternative syntax support)
// =============================================================================

fn parse_if<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_if();

    let start = parser.start_span();
    parser.advance(); // consume 'if'

    let condition = parse_paren_condition(parser);

    // Alternative syntax: if (...): ... endif;
    if parser.check(TokenKind::Colon) {
        let then_start = parser.start_span();
        parser.advance();
        let stmts = parse_stmts_until_end(
            parser,
            &[TokenKind::ElseIf, TokenKind::Else, TokenKind::EndIf],
        );
        let then_span = parser.span_from(then_start);
        let then_branch = parser.alloc(Stmt {
            kind: StmtKind::Block(parser.alloc(Block {
                stmts,
                span: then_span,
            })),
            span: then_span,
            doc_comment: None,
        });

        let mut elseif_branches = parser.alloc_vec();
        while parser.check(TokenKind::ElseIf) {
            let elseif_start = parser.start_span();
            parser.advance();
            parser.expect(TokenKind::LeftParen);
            let elseif_cond = expr::parse_expr(parser);
            parser.expect(TokenKind::RightParen);
            let body_start = parser.start_span();
            parser.expect(TokenKind::Colon);
            let elseif_stmts = parse_stmts_until_end(
                parser,
                &[TokenKind::ElseIf, TokenKind::Else, TokenKind::EndIf],
            );
            let body_span = parser.span_from(body_start);
            let elseif_body = Stmt {
                kind: StmtKind::Block(parser.alloc(Block {
                    stmts: elseif_stmts,
                    span: body_span,
                })),
                span: body_span,
                doc_comment: None,
            };
            elseif_branches.push(ElseIfBranch {
                condition: elseif_cond,
                body: elseif_body,
                span: parser.span_from(elseif_start),
            });
        }

        let else_branch = if parser.eat(TokenKind::Else).is_some() {
            let else_start = parser.start_span();
            parser.expect(TokenKind::Colon);
            let else_stmts = parse_stmts_until_end(parser, &[TokenKind::EndIf]);
            let else_span = parser.span_from(else_start);
            Some(parser.alloc(Stmt {
                kind: StmtKind::Block(parser.alloc(Block {
                    stmts: else_stmts,
                    span: else_span,
                })),
                span: else_span,
                doc_comment: None,
            }))
        } else {
            None
        };

        parser.expect(TokenKind::EndIf);
        parser.expect_semicolon(TokenKind::EndIf);
        let span = parser.span_from(start);

        return Stmt {
            kind: StmtKind::If(parser.alloc({
                let mut built = IfStmt::new(parser.arena, condition, then_branch);
                built.elseif_branches = elseif_branches;
                built.else_branch = else_branch;
                built.else_kw_span = None;
                built.uses_alternative = true;
                built
            })),
            span,
            doc_comment: None,
        };
    }

    // Normal syntax
    let then_branch_stmt = parse_stmt_or_block(parser);
    let then_branch = parser.alloc(then_branch_stmt);

    let mut elseif_branches = parser.alloc_vec_with_capacity(2);
    while parser.check(TokenKind::ElseIf) {
        let elseif_start = parser.start_span();
        parser.advance();
        parser.expect(TokenKind::LeftParen);
        let elseif_cond = expr::parse_expr(parser);
        parser.expect(TokenKind::RightParen);
        let elseif_body = parse_stmt_or_block(parser);
        let elseif_span = parser.span_to(elseif_start, elseif_body.span);
        elseif_branches.push(ElseIfBranch {
            condition: elseif_cond,
            body: elseif_body,
            span: elseif_span,
        });
    }

    let (else_branch, else_kw_span) = if parser.check(TokenKind::Else) {
        let else_kw_span = parser.current_span();
        parser.advance();
        let s = parse_stmt_or_block(parser);
        (Some(parser.alloc(s)), Some(else_kw_span))
    } else {
        (None, None)
    };

    let end = else_branch
        .as_ref()
        .map(|b| b.span.end)
        .or_else(|| elseif_branches.last().map(|b| b.span.end))
        .unwrap_or(then_branch.span.end);
    let span = Span::new(start, end);

    Stmt {
        kind: StmtKind::If(parser.alloc({
            let mut built = IfStmt::new(parser.arena, condition, then_branch);
            built.elseif_branches = elseif_branches;
            built.else_branch = else_branch;
            built.else_kw_span = else_kw_span;
            built.uses_alternative = false;
            built
        })),
        span,
        doc_comment: None,
    }
}

// =============================================================================
// While / Do-while / For / Foreach
// =============================================================================

fn parse_while<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    let condition = parse_paren_condition(parser);

    if parser.check(TokenKind::Colon) {
        let body_start = parser.start_span();
        parser.advance();
        parser.loop_depth += 1;
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndWhile]);
        parser.loop_depth -= 1;
        let body_span = parser.span_from(body_start);
        parser.expect(TokenKind::EndWhile);
        parser.expect_semicolon(TokenKind::EndWhile);
        let span = parser.span_from(start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(parser.alloc(Block {
                stmts,
                span: body_span,
            })),
            span: body_span,
            doc_comment: None,
        });
        return Stmt {
            kind: StmtKind::While(parser.alloc({
                let mut built = WhileStmt::new(condition, body);
                built.uses_alternative = true;
                built
            })),
            span,
            doc_comment: None,
        };
    }

    parser.loop_depth += 1;
    let body_stmt = parse_stmt_or_block(parser);
    parser.loop_depth -= 1;
    let body = parser.alloc(body_stmt);
    let span = parser.span_to(start, body.span);
    Stmt {
        kind: StmtKind::While(parser.alloc({
            let mut built = WhileStmt::new(condition, body);
            built.uses_alternative = false;
            built
        })),
        span,
        doc_comment: None,
    }
}

fn parse_do_while<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    parser.loop_depth += 1;
    let body_stmt = parse_stmt_or_block(parser);
    parser.loop_depth -= 1;
    let body = parser.alloc(body_stmt);
    parser.expect(TokenKind::While);
    let condition = parse_paren_condition(parser);
    parser.expect_semicolon("do-while statement");
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::DoWhile(parser.alloc(DoWhileStmt::new(body, condition))),
        span,
        doc_comment: None,
    }
}

fn parse_for<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_loop();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let init = parse_expr_list_until(parser, TokenKind::Semicolon);
    parser.expect(TokenKind::Semicolon);
    let condition = parse_expr_list_until(parser, TokenKind::Semicolon);
    parser.expect(TokenKind::Semicolon);
    let update = parse_expr_list_until(parser, TokenKind::RightParen);
    if parser.expect_paren_close(open).is_none() && open.is_some() {
        // Skip the rest of the header, as in `for (;;;)`, so the body is not read from it.
        while !matches!(
            parser.current_kind(),
            TokenKind::RightParen | TokenKind::LeftBrace | TokenKind::Colon | TokenKind::Eof
        ) {
            parser.advance();
        }
        parser.eat(TokenKind::RightParen);
    }

    if parser.check(TokenKind::Colon) {
        let body_start = parser.start_span();
        parser.advance();
        parser.loop_depth += 1;
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndFor]);
        parser.loop_depth -= 1;
        let body_span = parser.span_from(body_start);
        parser.expect(TokenKind::EndFor);
        parser.expect_semicolon(TokenKind::EndFor);
        let span = parser.span_from(start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(parser.alloc(Block {
                stmts,
                span: body_span,
            })),
            span: body_span,
            doc_comment: None,
        });
        return Stmt {
            kind: StmtKind::For(parser.alloc({
                let mut built = ForStmt::new(parser.arena, body);
                built.init = init;
                built.condition = condition;
                built.update = update;
                built.uses_alternative = true;
                built
            })),
            span,
            doc_comment: None,
        };
    }

    parser.loop_depth += 1;
    let body_stmt = parse_stmt_or_block(parser);
    parser.loop_depth -= 1;
    let body = parser.alloc(body_stmt);
    let span = parser.span_to(start, body.span);
    Stmt {
        kind: StmtKind::For(parser.alloc({
            let mut built = ForStmt::new(parser.arena, body);
            built.init = init;
            built.condition = condition;
            built.update = update;
            built.uses_alternative = false;
            built
        })),
        span,
        doc_comment: None,
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
            parser.trailing_comma_error("expression");
            break;
        }
        exprs.push(expr::parse_expr(parser));
    }
    exprs
}

fn parse_foreach<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_foreach();

    let start = parser.start_span();
    parser.advance();
    let open = parser.expect(TokenKind::LeftParen);
    let collection = expr::parse_expr(parser);
    parser.expect(TokenKind::As);

    let first_ref = parser.eat(TokenKind::Ampersand);
    let first = expr::parse_expr(parser);

    let key_by_ref = first_ref.is_some() && parser.check(TokenKind::FatArrow);
    let (key, value, by_ref_span) = if parser.eat(TokenKind::FatArrow).is_some() {
        if let Some(amp) = first_ref {
            parser.forbid(
                ForbiddenRule::ReferenceKey,
                "Key element cannot be a reference",
                amp.span.merge(first.span),
            );
        }
        let by_ref_span = parser.eat(TokenKind::Ampersand).map(|amp| amp.span);
        let value = expr::parse_expr(parser);
        (Some(first), value, by_ref_span)
    } else {
        (None, first, first_ref.map(|amp| amp.span))
    };
    expr::unfold_curly_offsets(parser, &value);
    let by_ref = by_ref_span.is_some();
    if by_ref && matches!(value.kind, ExprKind::Array(_)) {
        // `&[$a]` and `&list($a)` are not foreach targets; only a variable can be taken by reference.
        parser.error(ParseError::Expected {
            expected: "variable".into(),
            found: "array destructuring".into(),
            span: value.span,
        });
    }
    if let Some(k) = key
        .as_ref()
        .filter(|k| matches!(k.kind, ExprKind::Array(_)))
    {
        parser.forbid(
            ForbiddenRule::ListAsForeachKey,
            "Cannot use list as key element",
            k.span,
        );
    } else if let Some(k) = &key {
        expr::check_write_target(parser, k, false);
        expr::check_special_variable_write(parser, k, expr::WriteKind::Assign);
    }
    expr::check_write_target(parser, &value, true);
    expr::check_special_variable_write(parser, &value, expr::WriteKind::Assign);
    expr::check_list_entries(parser, &value);

    // The `as` target(s) are destructuring positions, so empty array slots
    // (`foreach ($x as [$a, , $c])`) are legal — retract the eager errors.
    parser.retract_destructuring_errors_within(value.span);
    if let Some(k) = &key {
        parser.retract_destructuring_errors_within(k.span);
    }

    parser.expect_paren_close(open);

    if parser.check(TokenKind::Colon) {
        let body_start = parser.start_span();
        parser.advance();
        parser.loop_depth += 1;
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndForeach]);
        parser.loop_depth -= 1;
        let body_span = parser.span_from(body_start);
        parser.expect(TokenKind::EndForeach);
        parser.expect_semicolon(TokenKind::EndForeach);
        let span = parser.span_from(start);
        let body = parser.alloc(Stmt {
            kind: StmtKind::Block(parser.alloc(Block {
                stmts,
                span: body_span,
            })),
            span: body_span,
            doc_comment: None,
        });
        return Stmt {
            kind: StmtKind::Foreach(parser.alloc({
                let mut built = ForeachStmt::new(collection, value, body);
                built.key = key;
                built.key_by_ref = key_by_ref;
                built.by_ref = by_ref;
                built.by_ref_span = by_ref_span;
                built.uses_alternative = true;
                built
            })),
            span,
            doc_comment: None,
        };
    }

    parser.loop_depth += 1;
    let body_stmt = parse_stmt_or_block(parser);
    parser.loop_depth -= 1;
    let body = parser.alloc(body_stmt);
    let span = parser.span_to(start, body.span);
    Stmt {
        kind: StmtKind::Foreach(parser.alloc({
            let mut built = ForeachStmt::new(collection, value, body);
            built.key = key;
            built.key_by_ref = key_by_ref;
            built.by_ref = by_ref;
            built.by_ref_span = by_ref_span;
            built.uses_alternative = false;
            built
        })),
        span,
        doc_comment: None,
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

    let name_token_kind = parser.current_kind();
    let name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        if !matches!(
            name_token_kind,
            TokenKind::Identifier
                | TokenKind::Null
                | TokenKind::True
                | TokenKind::False
                | TokenKind::Readonly
                | TokenKind::Enum_
                | TokenKind::Self_
                | TokenKind::Parent_
        ) && !(name_token_kind == TokenKind::Match_ && parser.version < PhpVersion::Php80)
        {
            parser.forbid(
                ForbiddenRule::KeywordAsDeclarationName,
                format!("cannot use '{}' as function name; it is reserved", text),
                span,
            );
        }
        Ident::new(text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "function name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.missing_ident()
    };

    // A function declared in a method body has no class scope.
    let saved_class_scope = parser.class_scope.take();
    let missing_param_list = !parser.check(TokenKind::LeftParen);
    let params = if let Some(open_paren) = parser.expect(TokenKind::LeftParen) {
        let params = parse_param_list(parser);
        parser.expect_closing(TokenKind::RightParen, open_paren.span);
        params
    } else {
        parser.alloc_vec()
    };

    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    let doc_comment = parser.take_doc_comment(start);

    let brace_start = parser.start_span();
    let open_brace = parser.expect(TokenKind::LeftBrace);
    // March 2026: reduce from 16 to 4 for smaller initial allocation
    // Most functions have 4-10 statements; large functions grow efficiently
    let mut body_stmts = parser.alloc_vec_with_capacity(4);
    let saved_loop_depth = parser.loop_depth;
    parser.loop_depth = 0;
    let saved_finally_loop_depth = parser.finally_loop_depth.take();
    let saved_has_goto_or_label = std::mem::take(&mut parser.has_goto_or_label);
    parser.function_depth += 1;
    let saved_by_ref = std::mem::replace(&mut parser.by_ref_function, by_ref);
    let saved_static_vars = std::mem::take(&mut parser.static_vars);
    let saved_has_yield = std::mem::take(&mut parser.has_yield);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        push_stmt(parser, &mut body_stmts);
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    parser.class_scope = saved_class_scope;
    parser.function_depth -= 1;
    parser.by_ref_function = saved_by_ref;
    parser.static_vars = saved_static_vars;
    let is_generator = std::mem::replace(&mut parser.has_yield, saved_has_yield);
    if parser.has_goto_or_label {
        check_gotos(parser, &body_stmts);
    }
    parser.has_goto_or_label = saved_has_goto_or_label;
    parser.finally_loop_depth = saved_finally_loop_depth;
    parser.loop_depth = saved_loop_depth;
    parser.expect_body_close(open_brace);
    let end = parser.previous_end();
    let span = Span::new(start, end);

    let body = parser.alloc(Block {
        stmts: body_stmts,
        span: parser.span_from(brace_start),
    });

    if let Some(rt) = &return_type {
        check_returns_against_type(parser, body, rt, is_generator, false);
    }
    parser.check_attributes(
        &attributes,
        &AttrSite::new(AttrTarget::Function).with_return_type(return_type.as_ref()),
    );

    Stmt {
        kind: StmtKind::Function(parser.alloc({
            let mut built = FunctionDecl::new(parser.arena, name, body);
            built.params = params;
            built.missing_param_list = missing_param_list;
            built.return_type = return_type;
            built.by_ref = by_ref;
            built.attributes = attributes;
            built.doc_comment = doc_comment;
            built
        })),
        span,
        doc_comment: None,
    }
}

/// Classifies a return-type annotation for `void`/`never` validity checks.
/// Returns `Some(true)` for `void`, `Some(false)` for `never`; `None` otherwise.
/// Conservative on union/intersection/nullable: only matches atomic occurrences.
fn classify_void_or_never<'arena, 'src>(rt: &TypeHint<'arena, 'src>) -> Option<bool> {
    match &rt.kind {
        TypeHintKind::Keyword(BuiltinType::Void, _) => Some(true),
        TypeHintKind::Keyword(BuiltinType::Never, _) => Some(false),
        _ => None,
    }
}

pub(crate) fn is_void_type(rt: &TypeHint<'_, '_>) -> bool {
    classify_void_or_never(rt) == Some(true)
}

pub(crate) fn is_never_type(rt: &TypeHint<'_, '_>) -> bool {
    classify_void_or_never(rt) == Some(false)
}

/// Report a generator whose return type does not admit `Generator`.
pub(crate) fn check_generator_return_type(
    parser: &mut Parser<'_, '_>,
    return_type: &TypeHint<'_, '_>,
) {
    let members = match &return_type.kind {
        TypeHintKind::Union(types) | TypeHintKind::Intersection(types) => &types[..],
        TypeHintKind::Nullable(inner) => std::slice::from_ref(*inner),
        _ => std::slice::from_ref(return_type),
    };
    let admits_generator = members.iter().any(|ty| match &ty.kind {
        TypeHintKind::Keyword(
            BuiltinType::Mixed | BuiltinType::Object | BuiltinType::Iterable,
            _,
        ) => true,
        TypeHintKind::Named(name) => matches!(
            parser
                .resolve_class_name(name)
                .to_ascii_lowercase()
                .as_str(),
            "traversable" | "iterator" | "generator"
        ),
        _ => false,
    });
    if !admits_generator {
        parser.forbid(
            ForbiddenRule::GeneratorReturnType,
            format!(
                "Generator return type must be a supertype of Generator, {} given",
                parser.type_display(return_type)
            ),
            return_type.span,
        );
    }
}

fn admits_null(ty: &TypeHint<'_, '_>) -> bool {
    match &ty.kind {
        TypeHintKind::Nullable(_) => true,
        TypeHintKind::Keyword(builtin, _) => {
            matches!(builtin, BuiltinType::Null | BuiltinType::Mixed)
        }
        TypeHintKind::Union(types) => types.iter().any(admits_null),
        _ => false,
    }
}

/// How PHP names a function-like in its return errors: from 8.4, "method" for one compiled in a
/// class, including a closure in a method.
pub(crate) fn function_kind_word(parser: &Parser<'_, '_>, in_class: bool) -> &'static str {
    if in_class && parser.version >= PhpVersion::Php84 {
        "method"
    } else {
        "function"
    }
}

pub(crate) fn void_return_message(what: &str, value: &Expr<'_, '_>) -> String {
    let mut value = value;
    while let ExprKind::Parenthesized(inner) = &value.kind {
        value = inner;
    }
    let hint = if matches!(value.kind, ExprKind::Null) {
        " (did you mean \"return;\" instead of \"return null;\"?)"
    } else {
        ""
    };
    format!("A void {what} must not return a value{hint}")
}

pub(crate) fn never_return_message(what: &str) -> String {
    format!("A never-returning {what} must not return")
}

/// Check the `return` statements of a function-like `body` against its declared return type:
/// a value from `void`, any `return` from `never`, and a bare `return;` from any other type.
/// A generator is checked for a return type that admits `Generator` instead. `in_class` selects
/// PHP 8.4's "A method ..." wording. Stops at nested function-like declarations.
pub(crate) fn check_returns_against_type<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    body: &Block<'arena, 'src>,
    return_type: &TypeHint<'arena, 'src>,
    is_generator: bool,
    in_class: bool,
) {
    if is_generator {
        check_generator_return_type(parser, return_type);
        return;
    }
    let what = function_kind_word(parser, in_class);
    let bare_return_message: std::borrow::Cow<'static, str> = {
        let hint = if admits_null(return_type) {
            " (did you mean \"return null;\" instead of \"return;\"?)"
        } else {
            ""
        };
        format!("A {what} with return type must return a value{hint}").into()
    };
    let rule = match classify_void_or_never(return_type) {
        Some(true) => ReturnRule::Void(what),
        Some(false) => ReturnRule::Never(what),
        None => ReturnRule::Value(bare_return_message),
    };
    check_returns(parser, &body.stmts, &rule);
}

pub(crate) enum ReturnRule {
    Void(&'static str),
    Never(&'static str),
    Value(std::borrow::Cow<'static, str>),
}

/// Report the `return` statements in `stmts` that break `rule`, skipping nested function-likes.
pub(crate) fn check_returns<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    stmts: &[Stmt<'arena, 'src>],
    rule: &ReturnRule,
) {
    for stmt in stmts {
        match &stmt.kind {
            StmtKind::Return(value) => {
                let (rule, message) = match (rule, value) {
                    (ReturnRule::Void(what), Some(value)) => (
                        ForbiddenRule::VoidReturnValue,
                        void_return_message(what, value).into(),
                    ),
                    (ReturnRule::Never(what), _) => (
                        ForbiddenRule::NeverReturn,
                        never_return_message(what).into(),
                    ),
                    (ReturnRule::Value(message), None) => {
                        (ForbiddenRule::MissingReturnValue, message.clone())
                    }
                    _ => continue,
                };
                parser.forbid(rule, message, stmt.span);
            }
            StmtKind::Block(b) => check_returns(parser, &b.stmts, rule),
            StmtKind::If(if_) => {
                check_returns(parser, std::slice::from_ref(if_.then_branch), rule);
                for eb in if_.elseif_branches.iter() {
                    check_returns(parser, std::slice::from_ref(&eb.body), rule);
                }
                if let Some(eb) = if_.else_branch {
                    check_returns(parser, std::slice::from_ref(eb), rule);
                }
            }
            StmtKind::While(w) => check_returns(parser, std::slice::from_ref(w.body), rule),
            StmtKind::DoWhile(d) => check_returns(parser, std::slice::from_ref(d.body), rule),
            StmtKind::For(f) => check_returns(parser, std::slice::from_ref(f.body), rule),
            StmtKind::Foreach(f) => check_returns(parser, std::slice::from_ref(f.body), rule),
            StmtKind::Declare(d) => {
                if let Some(body) = d.body {
                    check_returns(parser, std::slice::from_ref(body), rule);
                }
            }
            StmtKind::Switch(s) => {
                for c in s.body.cases.iter() {
                    check_returns(parser, &c.body, rule);
                }
            }
            StmtKind::TryCatch(t) => {
                check_returns(parser, &t.body.stmts, rule);
                for c in t.catches.iter() {
                    check_returns(parser, &c.body.stmts, rule);
                }
                if let Some(fin) = t.finally {
                    check_returns(parser, &fin.stmts, rule);
                }
            }
            // Nested function-like declarations have their own returns.
            _ => {}
        }
    }
}

fn check_param_name(
    parser: &mut Parser<'_, '_>,
    name: php_ast::Ident<'_>,
    earlier: &[Param<'_, '_>],
) {
    let (rule, message): (_, std::borrow::Cow<'static, str>) = match name.as_str() {
        Some("this") => (
            ForbiddenRule::ThisAsDeclaredVariable,
            "Cannot use $this as parameter".into(),
        ),
        Some(n) if expr::is_superglobal(n) => (
            ForbiddenRule::SuperglobalAsDeclaredVariable,
            format!("Cannot re-assign auto-global variable {n}").into(),
        ),
        Some(n) if earlier.iter().any(|p| p.name.as_str() == Some(n)) => (
            ForbiddenRule::DuplicateParameter,
            format!("Redefinition of parameter ${n}").into(),
        ),
        _ => return,
    };
    parser.forbid(rule, message, name.span);
}

/// Records the first promotion modifier of a parameter; any of them makes it a promoted property.
fn note_promotion_modifier(parser: &mut Parser<'_, '_>, first: &mut Option<Span>, span: Span) {
    if first.is_none() {
        parser.require_version(PhpVersion::Php80, "constructor property promotion", span);
        *first = Some(span);
    }
}

pub fn parse_param_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, Param<'arena, 'src>> {
    let mut params = parser.alloc_vec_with_capacity(4);
    if parser.check(TokenKind::RightParen) {
        return params;
    }
    let list_start = parser.start_span();

    // Floor for parameter leading doc comments (PHP 8.6): end of the most
    // recently consumed `(` or `,`, so the first parameter can't claim the
    // enclosing function/method's own doc-block.
    let mut param_list_floor = parser.previous_end();

    loop {
        if parser.check(TokenKind::RightParen) {
            let span = Span::new(param_list_floor - 1, param_list_floor);
            parser.require_version(PhpVersion::Php80, "trailing comma in parameter list", span);
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
            if let Some(param) =
                try_parse_simple_param_fastpath_minimal(parser, param_start, param_list_floor)
            {
                check_param_name(parser, param.name, &params);
                params.push(param);
                if parser.eat(TokenKind::Comma).is_none() {
                    break;
                }
                param_list_floor = parser.previous_end();
                continue;
            }
        }

        // Doc comment directly preceding this parameter (PHP 8.6).
        let leading_doc_comment = parser.take_doc_comment_from(param_start, param_list_floor);

        // Optional parameter attributes
        let param_attrs = parser.parse_attributes();

        // Optional modifiers for promoted properties: visibility, asymmetric
        // set-visibility, `final`, and `readonly` — PHP accepts them in any
        // order (e.g. `readonly protected`, `final public`, `public readonly`).
        let mut visibility: Option<Visibility> = None;
        let mut set_visibility: Option<Visibility> = None;
        let mut is_final = false;
        let mut is_readonly = false;
        let mut first_modifier_span: Option<Span> = None;
        loop {
            let current_span = parser.current_span();
            match parser.current_kind() {
                TokenKind::Public | TokenKind::Protected | TokenKind::Private => {
                    note_promotion_modifier(parser, &mut first_modifier_span, current_span);
                    let vis = match parser.current_kind() {
                        TokenKind::Public => Visibility::Public,
                        TokenKind::Protected => Visibility::Protected,
                        _ => Visibility::Private,
                    };
                    // Asymmetric visibility: `public(set)` / `private(set)` / `protected(set)`.
                    // Disambiguate from a visibility followed by a parenthesized DNF type
                    // hint (`private (A&B)|null $x`) by requiring the literal token `set`
                    // inside the parens.
                    if parser.set_visibility_follows(parser.current_span().end) {
                        let modifiers_span = parser.span_from(param_start);
                        parser.advance(); // consume visibility keyword
                        parser.advance(); // consume (
                        parser.advance(); // consume "set"
                        parser.expect(TokenKind::RightParen);
                        let span = parser.span_from(current_span.start);
                        parser.require_version(PhpVersion::Php84, "asymmetric visibility", span);
                        if set_visibility.is_some() {
                            parser.forbid(
                                ForbiddenRule::MultipleSetVisibilityModifiers,
                                "Multiple access type modifiers are not allowed",
                                modifiers_span,
                            );
                        }
                        set_visibility = Some(vis);
                    } else {
                        if visibility.is_some() {
                            parser.forbid(
                                ForbiddenRule::MultipleVisibilityModifiers,
                                "Multiple access type modifiers are not allowed",
                                parser.span_from(param_start),
                            );
                        }
                        parser.advance();
                        visibility = Some(vis);
                    }
                }
                TokenKind::Final => {
                    note_promotion_modifier(parser, &mut first_modifier_span, current_span);
                    parser.require_version(
                        PhpVersion::Php85,
                        "final promoted properties",
                        current_span,
                    );
                    if is_final {
                        parser.forbid(
                            ForbiddenRule::DuplicateModifier,
                            "Multiple final modifiers are not allowed",
                            current_span,
                        );
                    }
                    parser.advance();
                    is_final = true;
                }
                TokenKind::Readonly => {
                    note_promotion_modifier(parser, &mut first_modifier_span, current_span);
                    parser.require_version(PhpVersion::Php81, "readonly parameters", current_span);
                    if is_readonly {
                        parser.forbid(
                            ForbiddenRule::DuplicateModifier,
                            "Multiple readonly modifiers are not allowed",
                            current_span,
                        );
                    }
                    parser.advance();
                    is_readonly = true;
                }
                // `static` is not a valid parameter modifier — PHP fatals with
                // "Cannot use the static modifier on a parameter". Consume it
                // so subsequent type-hint / variable parsing isn't derailed.
                TokenKind::Static => {
                    parser.forbid(
                        ForbiddenRule::ModifierNotAllowed,
                        "Cannot use the static modifier on a parameter",
                        current_span,
                    );
                    parser.advance();
                }
                _ => break,
            }
        }

        if let (Some(get), Some(set)) = (visibility, set_visibility) {
            if class::visibility_rank(set) > class::visibility_rank(get) {
                parser.forbid(
                    ForbiddenRule::SetVisibilityWiderThanVisibility,
                    "Visibility of property must not be weaker than set visibility",
                    parser.span_from(param_start),
                );
            }
        }

        // Any modifier above promotes the param to a property — only valid
        // inside __construct. PHP rejects this with
        // "Cannot declare promoted property outside a constructor".
        if let Some(span) = first_modifier_span {
            if !parser.in_constructor {
                parser.forbid(
                    ForbiddenRule::PromotedPropertyOutsideConstructor,
                    "Cannot declare promoted property outside a constructor",
                    span,
                );
            }
        }

        // Optional type hint
        let type_hint = if !(!parser.could_be_type_hint()
            || parser.check(TokenKind::Variable)
            || parser.check(TokenKind::Ellipsis)
            || parser.check(TokenKind::Ampersand)
                && matches!(parser.peek_kind(), Some(TokenKind::Variable)))
        {
            let type_hint = parser.parse_type_hint();
            parser.reject_static_type(&type_hint, "parameter");
            Some(type_hint)
        } else {
            None
        };

        // Before 8.1 `readonly` is reported as a version gate; PHP 8.0 reads it as a class type.
        if is_readonly && type_hint.is_none() && parser.version >= PhpVersion::Php81 {
            parser.forbid(
                ForbiddenRule::UntypedReadonlyProperty,
                "readonly promoted property must have type",
                parser.span_from(param_start),
            );
        }
        // by-ref
        let by_ref = parser.eat(TokenKind::Ampersand).is_some();

        // variadic
        let variadic = parser.eat(TokenKind::Ellipsis).is_some();

        let name_token = parser.expect(TokenKind::Variable);
        let name_span_end = name_token.as_ref().map(|t| t.span.end);
        let name = name_token
            .map(|t| parser.variable_ident(t))
            .unwrap_or(parser.missing_ident());
        check_param_name(parser, name, &params);
        if let (Some(_), None, Some(name)) = (set_visibility, &type_hint, name.as_str()) {
            let class = parser.class_member_prefix();
            parser.forbid(
                ForbiddenRule::UntypedAsymmetricProperty,
                format!("Property with asymmetric visibility {class}${name} must have type"),
                parser.span_from(param_start),
            );
        }
        if let Some(type_hint) = &type_hint {
            let reported = parser.reject_return_only_param_type(type_hint);
            if let (false, Some(_), Some(name)) = (reported, first_modifier_span, name.as_str()) {
                parser.reject_member_type(type_hint, "Property", &format!("${name}"));
            }
        }

        let default = if parser.eat(TokenKind::Equals).is_some() {
            // Suppress `{` subscript so a following hook block `{ get => ...; }`
            // is not consumed as part of the default expression.
            let default = parser.in_const_expr(|p| p.with_no_brace_subscript(expr::parse_expr));
            expr::check_param_default(parser, &default);
            if let (Some(ty), Some(name), false) = (&type_hint, name.as_str(), variadic) {
                let owner = if first_modifier_span.is_some() && parser.version >= PhpVersion::Php80
                {
                    class::DefaultOwner::PromotedParam(name)
                } else {
                    class::DefaultOwner::Param(name)
                };
                class::check_typed_default(parser, ty, &default, owner);
            }
            Some(default)
        } else {
            None
        };

        // PHP rejects variadic parameters with default values:
        // "Variadic parameter cannot have a default value".
        if variadic && default.is_some() {
            parser.forbid(
                ForbiddenRule::VariadicParameterDefault,
                "Variadic parameter cannot have a default value",
                parser.span_from(param_start),
            );
        }

        let param_end = default
            .as_ref()
            .map(|e| e.span.end)
            .or(name_span_end)
            .unwrap_or(parser.previous_end());

        // Hooks promote the parameter even without a visibility modifier; without one, a `{`
        // that does not start a hook is a function body after a missing `)`.
        let starts_hooks = parser.check(TokenKind::LeftBrace)
            && (first_modifier_span.is_some()
                || match parser.peek_kind() {
                    Some(
                        TokenKind::Ampersand
                        | TokenKind::HashBracket
                        | TokenKind::Final
                        | TokenKind::RightBrace,
                    ) => true,
                    Some(TokenKind::Identifier) => parser.peek_text().is_some_and(|t| {
                        t.eq_ignore_ascii_case("get") || t.eq_ignore_ascii_case("set")
                    }),
                    _ => false,
                });
        let hooks = if starts_hooks {
            if first_modifier_span.is_some() || parser.in_constructor {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php84, "property hooks", span);
            }
            if first_modifier_span.is_none() && !parser.in_constructor {
                parser.forbid(
                    ForbiddenRule::PromotedPropertyOutsideConstructor,
                    "Cannot declare promoted property outside a constructor",
                    parser.current_span(),
                );
            }
            let hooks = class::parse_property_hooks(parser, type_hint.as_ref(), name.as_str());
            class::check_private_final_hooks(parser, visibility, &hooks);
            hooks
        } else {
            parser.alloc_vec()
        };
        class::check_hook_bodies(parser, &hooks, false, false, false);

        if let Some(hook) = hooks.first().filter(|_| is_readonly) {
            parser.forbid(
                ForbiddenRule::ReadonlyPropertyHooks,
                "A readonly property cannot declare hooks",
                hook.span,
            );
        }
        if let Some(name) = name.as_str() {
            class::check_backed_by_ref_get(parser, name, &hooks);
        }
        if let Some(name) = name.as_str().filter(|name| {
            set_visibility.is_some()
                && !hooks.is_empty()
                && class::is_virtual_property(name, &hooks)
        }) {
            let span = parser.span_from(param_start);
            class::check_virtual_set_visibility(parser, name, &hooks, span);
        }

        let param_end = if !hooks.is_empty() {
            parser.previous_end()
        } else {
            param_end
        };

        // Doc comment trailing this parameter, up to the comma (PHP 8.6).
        // A leading doc comment takes precedence if both are somehow present.
        let doc_comment = leading_doc_comment.or_else(|| {
            let boundary = if parser.check(TokenKind::Comma) || parser.check(TokenKind::RightParen)
            {
                parser.current_span().start
            } else {
                parser.previous_end()
            };
            parser.take_doc_comment_after(param_end, boundary)
        });

        let is_promoted = visibility.is_some()
            || set_visibility.is_some()
            || is_readonly
            || is_final
            || !hooks.is_empty();
        let attr_site = if is_promoted {
            AttrSite::promoted_param()
        } else {
            AttrSite::new(AttrTarget::Parameter)
        };
        parser.check_attributes(&param_attrs, &attr_site);

        let param_span = if param_end < param_start {
            parser.missing_span()
        } else {
            Span::new(param_start, param_end)
        };
        params.push({
            let mut param = Param::new(parser.arena, name, param_span);
            param.type_hint = type_hint;
            param.default = default;
            param.by_ref = by_ref;
            param.variadic = variadic;
            param.modifiers.is_readonly = is_readonly;
            param.modifiers.is_final = is_final;
            param.modifiers.visibility = visibility;
            param.modifiers.set_visibility = set_visibility;
            param.attributes = param_attrs;
            param.empty_hook_list = starts_hooks && hooks.is_empty();
            param.hooks = hooks;
            param.doc_comment = doc_comment;
            param
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        param_list_floor = parser.previous_end();
        // A variadic parameter must be last: a trailing comma is fine, but
        // another parameter after it is an error.
        if variadic && !parser.check(TokenKind::RightParen) {
            parser.forbid(
                ForbiddenRule::VariadicParameterNotLast,
                "Only the last parameter can be variadic",
                parser.current_span(),
            );
        }
    }
    // PHP stops at an unclosed list, so it never compiles the parameters, as in `f(int $x { }`.
    if !parser.check(TokenKind::RightParen) {
        let span = parser.span_from(list_start);
        parser.uncompiled_spans.push(span);
    }

    params
}

/// Minimal fast path: parse just $var with no type hint, no default, no visibility
/// Safely handles ~30% of parameters. Uses peek-first approach to ensure no token consumption.
/// Returns None if any complexity detected, causing fallback to full parsing.
fn try_parse_simple_param_fastpath_minimal<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    param_start: u32,
    param_list_floor: u32,
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

    // Doc comment directly preceding this parameter (PHP 8.6).
    let leading_doc_comment = parser.take_doc_comment_from(param_start, param_list_floor);

    // Safe to fast path. Now consume the tokens.
    let name_token = parser.advance();
    let name_span_end = name_token.span.end;
    let name = parser.variable_ident(name_token);

    // Doc comment trailing this parameter, up to the comma (PHP 8.6).
    let doc_comment = leading_doc_comment.or_else(|| {
        let boundary = if parser.check(TokenKind::Comma) || parser.check(TokenKind::RightParen) {
            parser.current_span().start
        } else {
            parser.previous_end()
        };
        parser.take_doc_comment_after(name_span_end, boundary)
    });

    Some({
        let mut param = Param::new(parser.arena, name, Span::new(param_start, name_span_end));
        param.doc_comment = doc_comment;
        param
    })
}

// =============================================================================
// Break / Continue
// =============================================================================

fn parse_break<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let kw_span = parser.current_span();
    parser.advance();
    let expr = if !parser.at_statement_end() {
        Some(expr::parse_expr(parser))
    } else {
        None
    };
    validate_break_continue(parser, "break", parser.loop_depth, &expr, kw_span);
    parser.expect_semicolon("break statement");
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Break(expr.map(|e| parser.alloc(e))),
        span,
        doc_comment: None,
    }
}

fn parse_continue<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let kw_span = parser.current_span();
    parser.advance();
    let expr = if !parser.at_statement_end() {
        Some(expr::parse_expr(parser))
    } else {
        None
    };
    validate_break_continue(parser, "continue", parser.loop_depth, &expr, kw_span);
    parser.expect_semicolon("continue statement");
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Continue(expr.map(|e| parser.alloc(e))),
        span,
        doc_comment: None,
    }
}

fn validate_break_continue<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    kw: &'static str,
    loop_depth: u32,
    expr: &Option<Expr<'arena, 'src>>,
    span: Span,
) {
    use php_ast::ExprKind;

    let levels = match expr {
        None => {
            // Implicit level 1
            if loop_depth == 0 {
                report_outside_loop(parser, kw, span);
                return;
            }
            1
        }
        Some(e) => {
            let mut e = e;
            while let ExprKind::Parenthesized(inner) = e.kind {
                e = inner;
            }
            let n = match e.kind {
                ExprKind::Int(n) => n,
                ExprKind::Float(_) | ExprKind::String(_) => 0,
                ExprKind::Error => return,
                _ => {
                    parser.forbid(
                        ForbiddenRule::InvalidBreakOperand,
                        format!("'{kw}' operator with non-integer operand is no longer supported"),
                        span,
                    );
                    return;
                }
            };
            if n <= 0 {
                parser.forbid(
                    ForbiddenRule::InvalidBreakOperand,
                    format!("'{}' operator accepts only positive integers", kw),
                    span,
                );
                return;
            }
            if loop_depth == 0 {
                report_outside_loop(parser, kw, span);
                return;
            }
            if n as u64 > loop_depth as u64 {
                let levels = if n == 1 {
                    "1 level".to_string()
                } else {
                    format!("{} levels", n)
                };
                parser.forbid(
                    ForbiddenRule::BreakOutOfLoop,
                    format!("Cannot '{}' {}", kw, levels),
                    span,
                );
                return;
            }
            n as u32
        }
    };
    if let Some(finally_loop_depth) = parser.finally_loop_depth {
        if levels > loop_depth - finally_loop_depth {
            parser.forbid(
                ForbiddenRule::JumpAcrossFinally,
                "jump out of a finally block is disallowed",
                span,
            );
        }
    }
}

fn report_outside_loop(parser: &mut Parser<'_, '_>, kw: &str, span: Span) {
    parser.forbid(
        ForbiddenRule::BreakOutOfLoop,
        format!("'{kw}' not in the 'loop' or 'switch' context"),
        span,
    );
}

// =============================================================================
// Switch statement
// =============================================================================

/// Consume `?>` followed directly by `<?php`, which together act as a `;`.
fn skip_empty_php_break(parser: &mut Parser<'_, '_>) -> bool {
    if !parser.check(TokenKind::CloseTag)
        || parser.peek_kind() != Some(TokenKind::OpenTag)
        || parser.peek_text() == Some("<?=")
    {
        return false;
    }
    parser.advance();
    parser.advance();
    true
}

/// `:` or `;` after a case label; `?>` also acts as the `;` and stays for the case body.
fn expect_case_separator(parser: &mut Parser<'_, '_>) {
    if parser.check(TokenKind::CloseTag) {
        parser.close_tag_ends_stmt();
    } else if parser.eat(TokenKind::Colon).is_none() {
        parser.expect(TokenKind::Semicolon);
    }
}

fn parse_switch<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_switch();

    let start = parser.start_span();
    parser.advance();
    let switch_expr = parse_paren_condition(parser);

    let body_brace_start = parser.start_span();
    let alt_syntax = parser.eat(TokenKind::Colon).is_some();
    let open = if alt_syntax {
        None
    } else {
        parser.expect(TokenKind::LeftBrace)
    };
    // PHP allows one `;`, or a `?>` acting as one, before the first case.
    let mut seen_separator = false;
    loop {
        let separator_span = parser.current_span();
        if parser.eat(TokenKind::Semicolon).is_none() && !skip_empty_php_break(parser) {
            break;
        }
        if seen_separator {
            parser.forbid(
                ForbiddenRule::SwitchLeadingSemicolons,
                "Only one ';' may precede the first case of a switch",
                separator_span,
            );
        }
        seen_separator = true;
    }

    let end_tokens: &[TokenKind] = if alt_syntax {
        &[TokenKind::EndSwitch]
    } else {
        &[TokenKind::RightBrace]
    };
    let mut cases = parser.alloc_vec_with_capacity(8);
    let mut seen_default_span: Option<Span> = None;

    parser.loop_depth += 1;
    while !end_tokens.contains(&parser.current_kind()) && !parser.check(TokenKind::Eof) {
        let case_start = parser.start_span();
        let value = if parser.eat(TokenKind::Case).is_some() {
            let v = expr::parse_expr(parser);
            expect_case_separator(parser);
            Some(v)
        } else if let Some(default_tok) = parser.eat(TokenKind::Default) {
            // PHP rejects "Switch statements may only contain one default clause".
            if seen_default_span.is_some() {
                parser.forbid(
                    ForbiddenRule::DuplicateSwitchDefault,
                    "Switch statements may only contain one default clause",
                    default_tok.span,
                );
            } else {
                seen_default_span = Some(default_tok.span);
            }
            expect_case_separator(parser);
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
            let span_before = parser.current_span();
            push_stmt(parser, &mut body);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }

        cases.push(SwitchCase {
            value,
            body,
            span: parser.span_from(case_start),
        });
    }

    parser.loop_depth -= 1;

    let body_span = if alt_syntax {
        let body_span = parser.span_from(body_brace_start);
        parser.expect(TokenKind::EndSwitch);
        parser.expect_semicolon(TokenKind::EndSwitch);
        body_span
    } else {
        parser.expect_body_close(open);
        parser.span_from(body_brace_start)
    };
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Switch(parser.alloc({
            let mut built = SwitchStmt::new(
                switch_expr,
                SwitchBody {
                    cases,
                    span: body_span,
                },
            );
            built.uses_alternative = alt_syntax;
            built
        })),
        span,
        doc_comment: None,
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
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Throw(parser.alloc(expr)),
        span,
        doc_comment: None,
    }
}

fn parse_try_catch<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    instrument::record_parse_try();

    let start = parser.start_span();
    parser.advance();
    let body_brace_start = parser.start_span();
    let open = parser.expect(TokenKind::LeftBrace);
    let mut body_stmts = parser.alloc_vec_with_capacity(16);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        let span_before = parser.current_span();
        push_stmt(parser, &mut body_stmts);
        if parser.current_span() == span_before {
            parser.advance();
        }
    }
    let closed = parser.expect_body_close(open);
    let body_closed = open.is_some() && closed.is_some();
    let body = parser.alloc(Block {
        stmts: body_stmts,
        span: parser.span_from(body_brace_start),
    });

    let mut catches = parser.alloc_vec_with_capacity(2);
    while let Some(catch_token) = parser.eat(TokenKind::Catch) {
        parser.expect(TokenKind::LeftParen);

        let mut types = parser.alloc_vec();
        types.push(parser.parse_class_ref_name());
        while parser.eat(TokenKind::Pipe).is_some() {
            types.push(parser.parse_class_ref_name());
        }
        for name in types.iter() {
            let (rule, message) = if let Some(text) = fully_qualified_class_keyword(name) {
                (
                    ForbiddenRule::QualifiedClassKeyword,
                    format!("'\\{text}' is an invalid class name"),
                )
            } else if matches!(name, Name::Simple { value, .. } if class_keyword(value).is_some()) {
                (
                    ForbiddenRule::ClassKeywordInCatch,
                    "Bad class name in the catch statement".to_string(),
                )
            } else {
                continue;
            };
            parser.forbid(rule, message, name.span());
        }

        let var = if parser.check(TokenKind::Variable) {
            let t = parser.advance();
            let var = parser.variable_ident(t);
            if var.as_str() == Some("this") {
                parser.forbid(
                    ForbiddenRule::ReassignThis,
                    "Cannot re-assign $this",
                    var.span,
                );
            }
            Some(var)
        } else {
            None
        };

        // Non-capturing catch — `catch (E)` without a variable — is PHP 8.0+.
        if var.is_none() {
            parser.require_version(
                PhpVersion::Php80,
                "non-capturing catch",
                parser.span_from(catch_token.span.start),
            );
        }

        parser.expect(TokenKind::RightParen);
        let catch_body_brace_start = parser.start_span();
        let open = parser.expect(TokenKind::LeftBrace);
        let mut catch_body_stmts = parser.alloc_vec_with_capacity(8);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            push_stmt(parser, &mut catch_body_stmts);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.expect_body_close(open);
        let catch_body = parser.alloc(Block {
            stmts: catch_body_stmts,
            span: parser.span_from(catch_body_brace_start),
        });

        catches.push({
            let mut built = CatchClause::new(
                parser.arena,
                catch_body,
                parser.span_from(catch_token.span.start),
            );
            built.types = types;
            built.var = var;
            built
        });
    }

    let (finally, finally_kw_span) = if parser.check(TokenKind::Finally) {
        let finally_kw_span = parser.current_span();
        parser.advance();
        let finally_brace_start = parser.start_span();
        let open = parser.expect(TokenKind::LeftBrace);
        let mut finally_stmts = parser.alloc_vec();
        let saved_finally_loop_depth = parser.finally_loop_depth.replace(parser.loop_depth);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            push_stmt(parser, &mut finally_stmts);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.finally_loop_depth = saved_finally_loop_depth;
        parser.expect_body_close(open);
        let finally_body = parser.alloc(Block {
            stmts: finally_stmts,
            span: parser.span_from(finally_brace_start),
        });
        (Some(finally_body), Some(finally_kw_span))
    } else {
        (None, None)
    };

    // A body with a syntax error is where PHP stops, so it never asks for a clause.
    if catches.is_empty() && finally.is_none() && body_closed {
        parser.error(ParseError::Expected {
            expected: "catch or finally clause".into(),
            found: parser.current_kind().description().into(),
            span: parser.span_from(start),
        });
    }

    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::TryCatch(parser.alloc({
            let mut built = TryCatchStmt::new(parser.arena, body);
            built.catches = catches;
            built.finally = finally;
            built.finally_kw_span = finally_kw_span;
            built
        })),
        span,
        doc_comment: None,
    }
}

// =============================================================================
// Goto / Declare / Unset / Global
// =============================================================================

fn parse_goto<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let name = if is_label_name(parser.current_kind(), parser.version) {
        let text = parser.current_text();
        Ident::new(text, parser.advance().span)
    } else {
        parser.expect(TokenKind::Identifier);
        parser.missing_ident()
    };
    parser.expect_statement_end();
    parser.has_goto_or_label = true;
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Goto(name),
        span,
        doc_comment: None,
    }
}

/// Report PHP's errors for the labels and `goto`s of one function body or the top-level code.
pub(crate) fn check_gotos<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    stmts: &[Stmt<'arena, 'src>],
) {
    #[derive(Clone, Copy, PartialEq)]
    enum Frame {
        LoopOrSwitch(u32),
        /// Numbered by the position of its `try`, the order in which PHP checks finally blocks.
        Finally(u32),
    }
    struct Jump<'src> {
        name: &'src str,
        span: Span,
        frames: Vec<Frame>,
    }
    #[derive(Default)]
    struct Collector<'src> {
        frames: Vec<Frame>,
        next_id: u32,
        labels: Vec<Jump<'src>>,
        gotos: Vec<Jump<'src>>,
        duplicates: Vec<(&'src str, Span)>,
    }
    impl<'src> Collector<'src> {
        fn nested(&mut self, frame: fn(u32) -> Frame, stmts: &[Stmt<'_, 'src>]) {
            self.frames.push(frame(self.next_id));
            self.next_id += 1;
            self.walk(stmts);
            self.frames.pop();
        }

        fn walk(&mut self, stmts: &[Stmt<'_, 'src>]) {
            for stmt in stmts {
                match &stmt.kind {
                    StmtKind::Label(name) => {
                        let Some(name) = name.as_str() else { continue };
                        if self.labels.iter().any(|l| l.name == name) {
                            self.duplicates.push((name, stmt.span));
                        } else {
                            self.labels.push(Jump {
                                name,
                                span: stmt.span,
                                frames: self.frames.clone(),
                            });
                        }
                    }
                    StmtKind::Goto(name) => {
                        let Some(name) = name.as_str() else { continue };
                        self.gotos.push(Jump {
                            name,
                            span: stmt.span,
                            frames: self.frames.clone(),
                        });
                    }
                    StmtKind::Block(b) => self.walk(&b.stmts),
                    StmtKind::If(if_) => {
                        self.walk(std::slice::from_ref(if_.then_branch));
                        for eb in if_.elseif_branches.iter() {
                            self.walk(std::slice::from_ref(&eb.body));
                        }
                        if let Some(eb) = if_.else_branch {
                            self.walk(std::slice::from_ref(eb));
                        }
                    }
                    StmtKind::While(w) => {
                        self.nested(Frame::LoopOrSwitch, std::slice::from_ref(w.body))
                    }
                    StmtKind::DoWhile(d) => {
                        self.nested(Frame::LoopOrSwitch, std::slice::from_ref(d.body))
                    }
                    StmtKind::For(f) => {
                        self.nested(Frame::LoopOrSwitch, std::slice::from_ref(f.body))
                    }
                    StmtKind::Foreach(f) => {
                        self.nested(Frame::LoopOrSwitch, std::slice::from_ref(f.body))
                    }
                    StmtKind::Switch(s) => {
                        self.frames.push(Frame::LoopOrSwitch(self.next_id));
                        self.next_id += 1;
                        for c in s.body.cases.iter() {
                            self.walk(&c.body);
                        }
                        self.frames.pop();
                    }
                    StmtKind::TryCatch(t) => {
                        let id = self.next_id;
                        self.next_id += 1;
                        self.walk(&t.body.stmts);
                        for c in t.catches.iter() {
                            self.walk(&c.body.stmts);
                        }
                        if let Some(fin) = t.finally {
                            self.frames.push(Frame::Finally(id));
                            self.walk(&fin.stmts);
                            self.frames.pop();
                        }
                    }
                    StmtKind::Declare(d) => {
                        if let Some(body) = d.body {
                            self.walk(std::slice::from_ref(body));
                        }
                    }
                    StmtKind::Namespace(ns) => {
                        if let NamespaceBody::Braced(b) = &ns.body {
                            self.walk(&b.stmts);
                        }
                    }
                    // Function and class bodies have labels of their own.
                    _ => {}
                }
            }
        }
    }

    let mut collector = Collector::default();
    collector.walk(stmts);
    for (name, span) in collector.duplicates {
        parser.forbid(
            ForbiddenRule::DuplicateLabel,
            format!("Label '{name}' already defined"),
            span,
        );
    }
    for goto in &collector.gotos {
        let Some(label) = collector.labels.iter().find(|l| l.name == goto.name) else {
            parser.forbid(
                ForbiddenRule::UndefinedGotoLabel,
                format!("'goto' to undefined label '{}'", goto.name),
                goto.span,
            );
            continue;
        };
        let label_loop = label
            .frames
            .iter()
            .rev()
            .find(|f| matches!(f, Frame::LoopOrSwitch(_)));
        if label_loop.is_some_and(|f| !goto.frames.contains(f)) {
            parser.forbid(
                ForbiddenRule::GotoIntoLoop,
                "'goto' into loop or switch statement is disallowed",
                goto.span,
            );
            continue;
        }
        let crossed_finally = |from: &Jump, to: &Jump| {
            from.frames
                .iter()
                .filter_map(|f| match f {
                    Frame::Finally(id) if !to.frames.contains(f) => Some(*id),
                    _ => None,
                })
                .min()
        };
        let message = match (crossed_finally(label, goto), crossed_finally(goto, label)) {
            (Some(into), out) if out.is_none_or(|out| into < out) => {
                "jump into a finally block is disallowed"
            }
            (_, Some(_)) => "jump out of a finally block is disallowed",
            _ => continue,
        };
        parser.forbid(ForbiddenRule::JumpAcrossFinally, message, goto.span);
    }
}

fn parse_declare<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut directives = parser.alloc_vec();
    let mut directive_spans = Vec::new();
    loop {
        if parser.check(TokenKind::RightParen) {
            parser.trailing_comma_error("identifier");
            break;
        }
        let Some(t) = parser.expect(TokenKind::Identifier) else {
            break;
        };
        let src = parser.source;
        let name = &src[t.span.start as usize..t.span.end as usize];
        parser.expect(TokenKind::Equals);
        let value = expr::parse_expr(parser);
        directives.push((name, value));
        directive_spans.push(parser.span_from(t.span.start));
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
    }
    parser.expect(TokenKind::RightParen);

    let (body, uses_alternative) = if parser.check(TokenKind::Semicolon) {
        parser.advance();
        (None, false)
    } else if parser.check(TokenKind::CloseTag) {
        // `?>` ends the statement like `;`; the HTML after it is not the body.
        parser.close_tag_ends_stmt();
        (None, false)
    } else if parser.check(TokenKind::Colon) {
        let body_start = parser.start_span();
        parser.advance();
        let stmts = parse_stmts_until_end(parser, &[TokenKind::EndDeclare]);
        let body_span = parser.span_from(body_start);
        parser.expect(TokenKind::EndDeclare);
        parser.expect_semicolon(TokenKind::EndDeclare);
        let block = parser.alloc(Stmt {
            kind: StmtKind::Block(parser.alloc(Block {
                stmts,
                span: body_span,
            })),
            span: body_span,
            doc_comment: None,
        });
        (Some(block), true)
    } else {
        let s = parse_stmt_or_block(parser);
        (Some(parser.alloc(s)), false)
    };

    // Nested statements, including those of a braced namespace, never come first.
    let first_stmt = parser.stmt_depth == 1 && !parser.top_level_code_seen;
    let has_body = body.is_some_and(|b| !matches!(b.kind, StmtKind::Error));
    for ((name, value), span) in directives.iter().zip(directive_spans) {
        check_declare_directive(parser, name, value, has_body, first_stmt, span);
    }

    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Declare(parser.alloc({
            let mut built = DeclareStmt::new(directives);
            built.body = body;
            built.uses_alternative = uses_alternative;
            built
        })),
        span,
        doc_comment: None,
    }
}

/// Report what PHP rejects in one `name=value` directive of a `declare` statement.
fn check_declare_directive(
    parser: &mut Parser<'_, '_>,
    name: &str,
    value: &Expr<'_, '_>,
    has_body: bool,
    first_stmt: bool,
    span: Span,
) {
    let mut value = value;
    while let ExprKind::Parenthesized(inner) = &value.kind {
        value = inner;
    }
    let is_literal = match &value.kind {
        ExprKind::Int(_) | ExprKind::Float(_) | ExprKind::String(_) | ExprKind::Nowdoc { .. } => {
            true
        }
        ExprKind::Heredoc { parts, .. } => {
            parts.iter().all(|p| matches!(p, StringPart::Literal(_)))
        }
        _ => false,
    };
    let error = if name.eq_ignore_ascii_case("encoding") {
        // Checked while parsing, before the checks of the other directives.
        if !is_literal {
            Some((
                ForbiddenRule::NonLiteralDeclareValue,
                "Encoding must be a literal".to_string(),
            ))
        } else {
            // Unlike `strict_types`, an empty statement before it is not allowed.
            (!first_stmt || parser.top_level_nop_seen).then(|| {
                (
                    ForbiddenRule::DeclareNotFirstStatement,
                    "Encoding declaration pragma must be the very first statement in the script"
                        .to_string(),
                )
            })
        }
    } else if !is_literal {
        Some((
            ForbiddenRule::NonLiteralDeclareValue,
            format!("declare({name}) value must be a literal"),
        ))
    } else if name.eq_ignore_ascii_case("strict_types") {
        // Before 8.5 an empty statement before it is not allowed either.
        let nop_before = parser.top_level_nop_seen && parser.version < PhpVersion::Php85;
        if !first_stmt || nop_before {
            Some((
                ForbiddenRule::DeclareNotFirstStatement,
                "strict_types declaration must be the very first statement in the script".into(),
            ))
        } else if has_body {
            Some((
                ForbiddenRule::InvalidStrictTypes,
                "strict_types declaration must not use block mode".into(),
            ))
        } else if !matches!(value.kind, ExprKind::Int(0 | 1)) {
            Some((
                ForbiddenRule::InvalidStrictTypes,
                "strict_types declaration must have 0 or 1 as its value".into(),
            ))
        } else {
            None
        }
    } else {
        None
    };
    if let Some((rule, message)) = error {
        parser.forbid(rule, message, span);
    }
}

fn parse_unset<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    parser.expect(TokenKind::LeftParen);
    let mut exprs = parser.alloc_vec();
    loop {
        let target = expr::parse_expr(parser);
        expr::check_write_target(parser, &target, false);
        expr::check_special_variable_write(parser, &target, expr::WriteKind::Unset);
        exprs.push(target);
        if parser.eat(TokenKind::Comma).is_none() || parser.check(TokenKind::RightParen) {
            break;
        }
    }
    parser.expect(TokenKind::RightParen);
    parser.expect_statement_end();
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Unset(exprs),
        span,
        doc_comment: None,
    }
}

fn parse_global<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance();
    let mut exprs = parser.alloc_vec();
    let e = expr::parse_expr(parser);
    check_global_variable(parser, &e);
    exprs.push(e);
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) {
            parser.trailing_comma_error("variable");
            break;
        }
        let e = expr::parse_expr(parser);
        check_global_variable(parser, &e);
        exprs.push(e);
    }
    parser.expect_statement_end();
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Global(exprs),
        span,
        doc_comment: None,
    }
}

fn check_global_variable(parser: &mut Parser<'_, '_>, e: &Expr<'_, '_>) {
    if !is_simple_variable(e) {
        parser.error(ParseError::Expected {
            expected: "variable".into(),
            found: parser.current_kind().description().into(),
            span: e.span,
        });
    } else if matches!(&e.kind, ExprKind::Variable(n) if n.as_str() == "this") {
        parser.forbid(
            ForbiddenRule::ThisAsDeclaredVariable,
            "Cannot use $this as global variable",
            e.span,
        );
    }
}

fn is_simple_variable<'arena, 'src>(expr: &Expr<'arena, 'src>) -> bool {
    matches!(
        &expr.kind,
        ExprKind::Variable(_) | ExprKind::VariableVariable(_)
    )
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
        let brace_start = parser.start_span();
        let open = parser.expect(TokenKind::LeftBrace);
        let mut stmts = parser.alloc_vec_with_capacity(16);
        let saved_stmt_depth = std::mem::take(&mut parser.stmt_depth);
        let saved_namespace = parser.namespace.take();
        let saved_imports = std::mem::take(&mut parser.class_imports);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            push_stmt(parser, &mut stmts);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.stmt_depth = saved_stmt_depth;
        parser.namespace = saved_namespace;
        parser.class_imports = saved_imports;
        parser.expect_body_close(open);
        let end = parser.previous_end();
        let block = parser.alloc(Block {
            stmts,
            span: parser.span_from(brace_start),
        });
        return Stmt {
            kind: StmtKind::Namespace(
                parser.alloc(NamespaceDecl::new(None, NamespaceBody::Braced(block))),
            ),
            span: Span::new(start, end),
            doc_comment: None,
        };
    }

    let name = parser.parse_name();
    if let Name::Simple { value, span } = &name {
        parser.check_name_parts_before_80(&[*value], *span);
    }
    if name.kind() == NameKind::Relative {
        parser.error(ParseError::Expected {
            expected: "namespace name".into(),
            found: "namespace-relative name".into(),
            span: name.span(),
        });
    }

    if parser.check(TokenKind::LeftBrace) {
        // Braced namespace: namespace Foo\Bar { ... }
        let brace_start = parser.start_span();
        let open = parser.expect(TokenKind::LeftBrace);
        let mut stmts = parser.alloc_vec_with_capacity(16);
        let saved_stmt_depth = std::mem::take(&mut parser.stmt_depth);
        let saved_namespace = parser.namespace.replace(name.parts_slice().join("\\"));
        let saved_imports = std::mem::take(&mut parser.class_imports);
        while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
            let span_before = parser.current_span();
            push_stmt(parser, &mut stmts);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.stmt_depth = saved_stmt_depth;
        parser.namespace = saved_namespace;
        parser.class_imports = saved_imports;
        parser.expect_body_close(open);
        let end = parser.previous_end();
        let block = parser.alloc(Block {
            stmts,
            span: parser.span_from(brace_start),
        });
        Stmt {
            kind: StmtKind::Namespace(
                parser.alloc(NamespaceDecl::new(Some(name), NamespaceBody::Braced(block))),
            ),
            span: Span::new(start, end),
            doc_comment: None,
        }
    } else {
        // Simple namespace: namespace Foo\Bar;
        parser.namespace = Some(name.parts_slice().join("\\"));
        parser.class_imports.clear();
        parser.expect_statement_end();
        let span = parser.span_from(start);
        Stmt {
            kind: StmtKind::Namespace(
                parser.alloc(NamespaceDecl::new(Some(name), NamespaceBody::Simple)),
            ),
            span,
            doc_comment: None,
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
    check_use_name_keyword(parser);
    let first_name = parser.parse_name_with(true);
    reject_relative_import(parser, &first_name);

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
                    found: parser.current_kind().description().into(),
                    span: first_name.span(),
                });
            }
        }
        parser.advance(); // consume {
        if parser.check(TokenKind::RightBrace) {
            parser.error(ParseError::Expected {
                expected: "at least one import in group use".into(),
                found: TokenKind::RightBrace.description().into(),
                span: parser.current_span(),
            });
        }
        let prefix_parts = first_name.parts_slice();
        loop {
            if parser.check(TokenKind::RightBrace) {
                break;
            } // trailing comma
            let sub_start = parser.start_span();
            if kind != UseKind::Normal
                && matches!(
                    parser.current_kind(),
                    TokenKind::Function | TokenKind::Const
                )
            {
                // `use function A\{function b}`: the kind is given once, for the whole group.
                parser.error(ParseError::Expected {
                    expected: "name".into(),
                    found: parser.current_kind().description().into(),
                    span: parser.current_span(),
                });
            }
            let item_kind = if parser.check(TokenKind::Function) {
                parser.advance();
                Some(UseKind::Function)
            } else if parser.check(TokenKind::Const) {
                parser.advance();
                Some(UseKind::Const)
            } else {
                None
            };
            check_use_name_keyword(parser);
            let sub_name = parser.parse_name();
            reject_relative_import(parser, &sub_name);

            // Validate: sub-names must not have leading backslash
            if sub_name.kind() == NameKind::FullyQualified {
                parser.error(ParseError::Expected {
                    expected: "non-fully-qualified name in group use".into(),
                    found: parser.current_kind().description().into(),
                    span: sub_name.span(),
                });
            }

            // Combine prefix with sub-name
            let sub_span = sub_name.span();
            let combined_name = if matches!(sub_name, Name::Error { .. }) {
                sub_name
            } else {
                let combined_parts = {
                    let sub_slice = sub_name.parts_slice();
                    let mut cp =
                        parser.alloc_vec_with_capacity(prefix_parts.len() + sub_slice.len());
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
                        _ => {}
                    }
                    cp
                };
                Name::Complex {
                    parts: combined_parts,
                    kind: if first_name.kind() == NameKind::FullyQualified {
                        NameKind::FullyQualified
                    } else {
                        NameKind::Qualified
                    },
                    // The name as written in the group; the prefix is shared with its siblings.
                    span: sub_span,
                }
            };

            let alias = parse_use_alias(parser);

            let use_span = parser.span_from(sub_start);
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
        let alias = parse_use_alias(parser);

        let item_span = parser.span_from(item_start);
        uses.push(UseItem {
            name: first_name,
            alias,
            kind: None,
            span: item_span,
        });

        while parser.eat(TokenKind::Comma).is_some() {
            if parser.check(TokenKind::Semicolon) {
                parser.trailing_comma_error("name");
                break;
            }
            let next_start = parser.start_span();
            check_use_name_keyword(parser);
            let name = parser.parse_name();
            reject_relative_import(parser, &name);

            let alias = parse_use_alias(parser);

            let next_span = parser.span_from(next_start);
            uses.push(UseItem {
                name,
                alias,
                kind: None,
                span: next_span,
            });
        }
    }

    for item in uses.iter() {
        if item.kind.unwrap_or(kind) != UseKind::Normal {
            continue;
        }
        let explicit_alias = item.alias.and_then(|a| a.as_str());
        // An imported `readonly`, or before PHP 8.5 `array` or `callable`, is only a keyword
        // as an explicit alias.
        let implicit_alias = item.name.parts_slice().last().copied().filter(|last| {
            let is = |word: &str| last.eq_ignore_ascii_case(word);
            !is("readonly")
                && (parser.version >= PhpVersion::Php85 || !(is("array") || is("callable")))
        });
        if let Some(alias) = explicit_alias.or(implicit_alias) {
            if class::is_reserved_class_name(alias, parser.version) {
                let name = item.name.parts_slice().join("\\");
                parser.forbid(
                    ForbiddenRule::SpecialClassNameAlias,
                    format!(
                        "Cannot use {name} as {alias} because '{alias}' is a special class name"
                    ),
                    item.span,
                );
            }
        }
        let local = match &item.alias {
            Some(alias) => alias.as_str(),
            None => item.name.parts_slice().last().copied(),
        };
        if let Some(local) = local {
            let target = item.name.parts_slice().join("\\");
            parser
                .class_imports
                .insert(local.to_ascii_lowercase(), target);
        }
    }
    parser.expect_statement_end();
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Use(parser.alloc(UseDecl::new(kind, uses))),
        span,
        doc_comment: None,
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
    // Attributes and doc comment apply to the first item only.
    let mut pending_attrs = Some(attributes);
    let mut pending_doc = parser.take_doc_comment(start);
    loop {
        let item_start = parser.start_span();
        // PHP lexes `self` and `parent` as plain names, which a constant may take.
        let name_is_reserved_kw = parser.is_reserved_keyword_as_decl_name()
            && !parser.check(TokenKind::Self_)
            && !parser.check(TokenKind::Parent_);
        let const_name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
            if name_is_reserved_kw {
                parser.forbid(
                    ForbiddenRule::KeywordAsDeclarationName,
                    format!("cannot use '{}' as constant name as it is reserved", text),
                    span,
                );
            }
            Ident::new(text, span)
        } else {
            parser.error(ParseError::Expected {
                expected: "constant name".into(),
                found: parser.current_kind().description().into(),
                span: parser.current_span(),
            });
            parser.missing_ident()
        };
        parser.expect(TokenKind::Equals);
        let value = parser.in_const_expr(expr::parse_expr);
        expr::check_const_expr(parser, &value, true);
        let item_span = parser.span_to(item_start, value.span);
        let item_attrs = pending_attrs.take().unwrap_or_else(|| parser.alloc_vec());
        let doc_comment = pending_doc.take();
        items.push(ConstItem {
            name: const_name,
            value,
            attributes: item_attrs,
            span: item_span,
            doc_comment,
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        if parser.check(TokenKind::Semicolon) {
            parser.trailing_comma_error("constant name");
            break;
        }
    }

    parser.expect_statement_end();
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::Const(items),
        span,
        doc_comment: None,
    }
}

/// Report `what` when the current statement is nested in a block or function body.
fn check_top_level(parser: &mut Parser<'_, '_>, what: &str) {
    if parser.stmt_depth > 1 {
        parser.forbid(
            ForbiddenRule::OutermostScopeOnly,
            format!("{what} can only be used at the outermost scope"),
            parser.current_span(),
        );
    }
}

fn parse_halt_compiler<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let nested = parser.stmt_depth > 1;
    if nested {
        parser.forbid(
            ForbiddenRule::OutermostScopeOnly,
            "__HALT_COMPILER() can only be used from the outermost scope",
            parser.current_span(),
        );
    }

    parser.advance(); // consume '__halt_compiler'
    parser.expect(TokenKind::LeftParen);
    parser.expect(TokenKind::RightParen);
    // PHP stops lexing only at an outermost `__halt_compiler()`; a nested one is a plain statement.
    if nested {
        if parser.check(TokenKind::CloseTag) {
            parser.close_tag_ends_stmt();
        } else if parser.eat(TokenKind::Semicolon).is_none() {
            parser.error(ParseError::ExpectedAfter {
                expected: "';' or '?>'".into(),
                after: "__halt_compiler()".into(),
                span: parser.current_span(),
            });
        }
        return Stmt {
            kind: StmtKind::HaltCompiler(""),
            span: parser.span_from(start),
            doc_comment: None,
        };
    }
    let closed_by_tag = parser.check(TokenKind::CloseTag);
    // Accept either ; or ?> as terminator
    if parser.check(TokenKind::Semicolon) {
        parser.advance();
    } else if closed_by_tag {
        parser.advance(); // consume ?> — everything after is raw data
    } else {
        parser.error(ParseError::ExpectedAfter {
            expected: "';' or '?>'".into(),
            after: "__halt_compiler()".into(),
            span: parser.current_span(),
        });
    }

    // Everything after the terminator is raw data. Use previous_end() to capture
    // the position right after the terminator, preserving any whitespace.
    let current_pos = parser.previous_end() as usize;
    let remaining = &parser.source[current_pos..];
    parser.halt_at(current_pos);

    let span = Span::new(start, parser.source.len() as u32);
    Stmt {
        kind: StmtKind::HaltCompiler(remaining),
        span,
        doc_comment: None,
    }
}

fn parse_static_var<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'static'

    let mut vars = parser.alloc_vec();
    loop {
        let var_start = parser.start_span();
        let var_token = parser.expect(TokenKind::Variable);
        let name = var_token
            .map(|t| parser.variable_ident(t))
            .unwrap_or(parser.missing_ident());
        match name.as_str() {
            Some("this") => parser.forbid(
                ForbiddenRule::ThisAsDeclaredVariable,
                "Cannot use $this as static variable",
                name.span,
            ),
            // Before 8.3 a later declaration replaces an earlier one.
            Some(n) if parser.static_vars.contains(&n) && parser.version >= PhpVersion::Php83 => {
                parser.forbid(
                    ForbiddenRule::DuplicateStaticVariable,
                    format!("Duplicate declaration of static variable ${n}"),
                    name.span,
                )
            }
            Some(n) => parser.static_vars.push(n),
            None => {}
        }

        let default = if parser.eat(TokenKind::Equals).is_some() {
            // Before 8.3 the initializer is a constant expression, which permits `new` from 8.1.
            let value = if parser.version < PhpVersion::Php83 {
                parser.in_const_expr(expr::parse_expr)
            } else {
                expr::parse_expr(parser)
            };
            if parser.version < PhpVersion::Php83 {
                expr::check_const_expr(parser, &value, true);
            } else {
                // PHP 8.3 folds the initializer at compile time.
                expr::check_folded_curly_offsets(parser, &value);
            }
            Some(value)
        } else {
            None
        };

        vars.push(StaticVar {
            name,
            default,
            span: parser.span_from(var_start),
        });

        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        if parser.check(TokenKind::Semicolon) {
            parser.trailing_comma_error("variable");
            break;
        }
    }

    parser.expect_statement_end();
    let span = parser.span_from(start);
    Stmt {
        kind: StmtKind::StaticVar(vars),
        span,
        doc_comment: None,
    }
}

// =============================================================================
// Expression statement (and label detection)
// =============================================================================

/// `use namespace\A` is a syntax error: imports are always fully qualified.
fn reject_relative_import(parser: &mut Parser<'_, '_>, name: &Name<'_, '_>) {
    if name.kind() == NameKind::Relative {
        parser.error(ParseError::Expected {
            expected: "name".into(),
            found: "namespace-relative name".into(),
            span: name.span(),
        });
    }
}

/// Report an unqualified import named by a word PHP lexes as a keyword, as in `use Class;`.
fn check_use_name_keyword(parser: &mut Parser<'_, '_>) {
    let is_word = parser
        .current_text()
        .bytes()
        .next()
        .is_some_and(|b| b.is_ascii_alphabetic() || b == b'_');
    let text = parser.current_text();
    let lexed_as_name = match parser.current_kind() {
        // Keywords in PHP that this lexer reads as names.
        TokenKind::Identifier => !["callable", "insteadof", "var"]
            .iter()
            .any(|k| text.eq_ignore_ascii_case(k)),
        TokenKind::Enum_
        | TokenKind::Self_
        | TokenKind::Parent_
        | TokenKind::Null
        | TokenKind::True
        | TokenKind::False => true,
        TokenKind::Match_ => parser.version < PhpVersion::Php80,
        TokenKind::Readonly => parser.version < PhpVersion::Php81,
        TokenKind::MagicProperty => parser.version < PhpVersion::Php84,
        _ => !is_word,
    };
    if !lexed_as_name && parser.peek_kind() != Some(TokenKind::Backslash) {
        let found = match parser.current_kind() {
            TokenKind::Identifier => format!("'{}'", text.to_ascii_lowercase()),
            kind => kind.description().into(),
        };
        parser.error(ParseError::Expected {
            expected: "identifier".into(),
            found: found.into(),
            span: parser.current_span(),
        });
    }
}

/// `as alias` after an imported name.
fn parse_use_alias<'arena, 'src>(parser: &mut Parser<'arena, 'src>) -> Option<Ident<'src>> {
    parser.eat(TokenKind::As)?;
    if !is_label_name(parser.current_kind(), parser.version) {
        parser.expect(TokenKind::Identifier);
        return None;
    }
    let text = parser.current_text();
    Some(Ident::new(text, parser.advance().span))
}

/// Tokens PHP lexes as a plain name where a goto label or a `use` alias is allowed.
fn is_label_name(kind: TokenKind, version: PhpVersion) -> bool {
    matches!(
        kind,
        TokenKind::Identifier
            | TokenKind::Null
            | TokenKind::True
            | TokenKind::False
            | TokenKind::Enum_
            | TokenKind::Self_
            | TokenKind::Parent_
    ) || (kind == TokenKind::Match_ && version < PhpVersion::Php80)
}

/// `name:` where `name` is a keyword token that PHP lexes as a plain name.
fn parse_label<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let text = parser.current_text();
    let token = parser.advance();
    parser.advance(); // consume ':'
    parser.has_goto_or_label = true;
    Stmt {
        kind: StmtKind::Label(Ident::new(text, token.span)),
        span: parser.span_from(token.span.start),
        doc_comment: None,
    }
}

fn parse_expression_stmt_or_label<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if let ExprKind::Name(Name::Simple { value, span }) = expr.kind {
        if parser.eat(TokenKind::Colon).is_some() {
            let label = Ident::new(value, span);
            parser.has_goto_or_label = true;
            let span = parser.span_from(start);
            return Stmt {
                kind: StmtKind::Label(label),
                span,
                doc_comment: None,
            };
        }
    }

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt {
            kind: StmtKind::Error,
            span: parser.span_from(start),
            doc_comment: None,
        };
    }

    parser.expect_semicolon("expression");
    // A leading recovered expression sits before `start`, at the end of the previous token.
    let span = parser.span_from(start.min(expr.span.start));
    Stmt {
        kind: StmtKind::Expression(parser.alloc(expr)),
        span,
        doc_comment: None,
    }
}

fn parse_expression_stmt<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    let expr = expr::parse_expr(parser);

    if matches!(expr.kind, ExprKind::Error) {
        parser.synchronize();
        return Stmt {
            kind: StmtKind::Error,
            span: parser.span_from(start),
            doc_comment: None,
        };
    }

    parser.expect_semicolon("expression");
    // A leading recovered expression sits before `start`, at the end of the previous token.
    let span = parser.span_from(start.min(expr.span.start));
    Stmt {
        kind: StmtKind::Expression(parser.alloc(expr)),
        span,
        doc_comment: None,
    }
}

/// Report every `$a[]` in `stmts` and the read expressions `exprs` that is read or unset; PHP
/// allows it only where it is written to: as an assignment, increment, `foreach` or
/// destructuring target, by-reference source, call argument, or the base of such a fetch, as
/// in `$a[][0] = 1`.
pub(crate) fn check_empty_dims<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    stmts: &[Stmt<'arena, 'src>],
    exprs: &[&Expr<'arena, 'src>],
) {
    use php_ast::visitor::{
        walk_class_member, walk_enum_member, walk_expr, walk_property_hook, walk_stmt, Visitor,
    };
    use std::ops::ControlFlow;

    struct EmptyDims {
        read: Vec<Span>,
        unset: Vec<Span>,
        globals_append: Vec<Span>,
        /// Whether `$GLOBALS` itself may not be written, as from PHP 8.1.
        globals_read_only: bool,
        /// Whether each enclosing function returns by reference, which makes its
        /// `return` and `yield` values writes.
        by_ref: Vec<bool>,
    }
    impl EmptyDims {
        fn is_globals(&self, expr: &Expr<'_, '_>) -> bool {
            self.globals_read_only && is_globals(expr)
        }

        fn returned(&mut self, value: &Expr<'_, '_>) {
            if self.by_ref.last() == Some(&true) {
                self.write(value);
            } else {
                let _ = self.visit_expr(value);
            }
        }

        fn write(&mut self, expr: &Expr<'_, '_>) {
            match &expr.kind {
                ExprKind::ArrayAccess(a) => {
                    if a.index.is_none() && self.is_globals(a.array) {
                        self.globals_append.push(expr.span);
                    }
                    self.write(a.array);
                    if let Some(index) = a.index {
                        let _ = self.visit_expr(index);
                    }
                }
                ExprKind::PropertyAccess(p) => {
                    self.write(p.object);
                    let _ = self.visit_expr(p.property);
                }
                ExprKind::Array(elements) => {
                    for el in elements.iter() {
                        if let Some(key) = &el.key {
                            let _ = self.visit_expr(key);
                        }
                        self.write(el.value());
                    }
                }
                ExprKind::Parenthesized(inner) => self.write(inner),
                _ => {
                    let _ = self.visit_expr(expr);
                }
            }
        }

        /// Visit an expression PHP tries to evaluate at compile time, such as an array literal
        /// element; there `$GLOBALS[]` is reported as a read before it is compiled as a fetch.
        fn const_eval(&mut self, expr: &Expr<'_, '_>) {
            match &expr.kind {
                ExprKind::ArrayAccess(a) => {
                    self.const_eval(a.array);
                    match a.index {
                        Some(index) => self.const_eval(index),
                        None => self.read.push(expr.span),
                    }
                }
                ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => {
                    self.const_eval(p.object);
                    self.const_eval(p.property);
                }
                ExprKind::ClassConstAccess(c) if !is_class_name_fetch(c) => {
                    self.const_eval(c.class);
                    self.const_eval(c.member);
                }
                ExprKind::ClassConstAccessDynamic { class, member } => {
                    self.const_eval(class);
                    self.const_eval(member);
                }
                ExprKind::Binary(b) => {
                    self.const_eval(b.left);
                    self.const_eval(b.right);
                }
                ExprKind::NullCoalesce(n) => {
                    self.const_eval(n.left);
                    self.const_eval(n.right);
                }
                ExprKind::Ternary(t) => {
                    self.const_eval(t.condition);
                    if let Some(then_expr) = t.then_expr {
                        self.const_eval(then_expr);
                    }
                    self.const_eval(t.else_expr);
                }
                ExprKind::UnaryPrefix(u)
                    if !matches!(
                        u.op,
                        UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
                    ) =>
                {
                    self.const_eval(u.operand)
                }
                ExprKind::Parenthesized(inner) => self.const_eval(inner),
                ExprKind::Array(elements) => {
                    for el in elements.iter() {
                        if let Some(key) = &el.key {
                            self.const_eval(key);
                        }
                        self.const_eval(el.value());
                    }
                }
                _ => {
                    let _ = self.visit_expr(expr);
                }
            }
        }

        /// An `isset` or `empty` operand: a direct `$a[]` is a read, even of `$GLOBALS`.
        fn isset_operand(&mut self, expr: &Expr<'_, '_>) {
            match &expr.kind {
                ExprKind::ArrayAccess(a) if a.index.is_none() => {
                    self.read.push(expr.span);
                    let _ = self.visit_expr(a.array);
                }
                _ => {
                    let _ = self.visit_expr(expr);
                }
            }
        }

        fn args(&mut self, args: &[Arg<'_, '_>]) {
            for arg in args {
                let Some(value) = arg.value() else { continue };
                match value.kind {
                    ExprKind::ArrayAccess(_) | ExprKind::PropertyAccess(_)
                        if !matches!(arg.kind, ArgKind::Spread(_)) =>
                    {
                        self.write(value)
                    }
                    _ => {
                        let _ = self.visit_expr(value);
                    }
                }
            }
        }

        fn unset(&mut self, expr: &Expr<'_, '_>, outermost: bool) {
            match &expr.kind {
                ExprKind::ArrayAccess(a) => {
                    match a.index {
                        Some(index) => {
                            let _ = self.visit_expr(index);
                        }
                        None if !outermost && self.is_globals(a.array) => {
                            self.globals_append.push(expr.span)
                        }
                        None => self.unset.push(expr.span),
                    }
                    self.unset(a.array, false);
                }
                ExprKind::PropertyAccess(p) => {
                    self.unset(p.object, false);
                    let _ = self.visit_expr(p.property);
                }
                _ => {
                    let _ = self.visit_expr(expr);
                }
            }
        }
    }
    impl<'a, 's> Visitor<'a, 's> for EmptyDims {
        type Break = ();
        fn visit_stmt(&mut self, stmt: &Stmt<'a, 's>) -> ControlFlow<()> {
            match &stmt.kind {
                StmtKind::Foreach(f) => {
                    let _ = self.visit_expr(&f.expr);
                    if let Some(key) = &f.key {
                        self.write(key);
                    }
                    self.write(&f.value);
                    let _ = self.visit_stmt(f.body);
                }
                StmtKind::Unset(exprs) => {
                    for expr in exprs.iter() {
                        self.unset(expr, true);
                    }
                }
                StmtKind::Return(Some(value)) => self.returned(value),
                StmtKind::Function(f) => {
                    self.by_ref.push(f.by_ref);
                    let _ = walk_stmt(self, stmt);
                    self.by_ref.pop();
                }
                _ => {
                    let _ = walk_stmt(self, stmt);
                }
            }
            ControlFlow::Continue(())
        }

        fn visit_class_member(&mut self, member: &ClassMember<'a, 's>) -> ControlFlow<()> {
            let by_ref = matches!(&member.kind, ClassMemberKind::Method(m) if m.by_ref);
            self.by_ref.push(by_ref);
            let _ = walk_class_member(self, member);
            self.by_ref.pop();
            ControlFlow::Continue(())
        }

        fn visit_enum_member(&mut self, member: &EnumMember<'a, 's>) -> ControlFlow<()> {
            let by_ref = matches!(&member.kind, EnumMemberKind::Method(m) if m.by_ref);
            self.by_ref.push(by_ref);
            let _ = walk_enum_member(self, member);
            self.by_ref.pop();
            ControlFlow::Continue(())
        }

        fn visit_property_hook(&mut self, hook: &PropertyHook<'a, 's>) -> ControlFlow<()> {
            self.by_ref.push(hook.by_ref);
            let _ = walk_property_hook(self, hook);
            self.by_ref.pop();
            ControlFlow::Continue(())
        }

        fn visit_expr(&mut self, expr: &Expr<'a, 's>) -> ControlFlow<()> {
            match &expr.kind {
                // Interpolations are checked as they are parsed.
                ExprKind::InterpolatedString(_)
                | ExprKind::Heredoc { .. }
                | ExprKind::ShellExec(_) => {}
                ExprKind::ArrayAccess(a) if a.index.is_none() => {
                    if self.is_globals(a.array) {
                        self.globals_append.push(expr.span);
                    } else {
                        self.read.push(expr.span);
                    }
                    let _ = self.visit_expr(a.array);
                }
                ExprKind::Array(_) => self.const_eval(expr),
                ExprKind::ClassConstAccess(c) if !is_class_name_fetch(c) => {
                    self.const_eval(c.class);
                    let _ = self.visit_expr(c.member);
                }
                ExprKind::ClassConstAccessDynamic { class, member } => {
                    self.const_eval(class);
                    let _ = self.visit_expr(member);
                }
                ExprKind::Isset(exprs) => {
                    for e in exprs.iter() {
                        self.isset_operand(e);
                    }
                }
                ExprKind::Empty(e) => self.isset_operand(e),
                ExprKind::Assign(a) => {
                    if a.op == AssignOp::Coalesce {
                        let _ = self.visit_expr(a.target);
                    } else {
                        self.write(a.target);
                    }
                    if a.by_ref {
                        self.write(a.value);
                    } else {
                        let _ = self.visit_expr(a.value);
                    }
                }
                ExprKind::UnaryPrefix(u)
                    if matches!(
                        u.op,
                        UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
                    ) =>
                {
                    self.write(u.operand)
                }
                ExprKind::UnaryPostfix(u) => self.write(u.operand),
                ExprKind::FunctionCall(c) => {
                    let _ = self.visit_expr(c.name);
                    self.args(&c.args);
                }
                ExprKind::MethodCall(c) | ExprKind::NullsafeMethodCall(c) => {
                    let _ = self.visit_expr(c.object);
                    let _ = self.visit_expr(c.method);
                    self.args(&c.args);
                }
                ExprKind::StaticMethodCall(c) => {
                    let _ = self.visit_expr(c.class);
                    let _ = self.visit_expr(c.method);
                    self.args(&c.args);
                }
                ExprKind::StaticMethodCallDynamic(c) => {
                    let _ = self.visit_expr(c.class);
                    let _ = self.visit_expr(c.method);
                    self.args(&c.args);
                }
                ExprKind::New(n) => {
                    let _ = self.visit_expr(n.class);
                    self.args(&n.args);
                }
                ExprKind::Closure(c) => {
                    self.by_ref.push(c.by_ref);
                    let _ = walk_expr(self, expr);
                    self.by_ref.pop();
                }
                ExprKind::ArrowFunction(f) if f.by_ref => self.write(f.body),
                ExprKind::Yield(y) if !y.is_from => {
                    if let Some(key) = y.key {
                        let _ = self.visit_expr(key);
                    }
                    if let Some(value) = y.value {
                        self.returned(value);
                    }
                }
                _ => {
                    let _ = walk_expr(self, expr);
                }
            }
            ControlFlow::Continue(())
        }
    }

    fn is_class_name_fetch(access: &StaticAccessExpr<'_, '_>) -> bool {
        matches!(&access.member.kind, ExprKind::Identifier(name) if name.eq_ignore_ascii_case("class"))
    }

    fn is_globals(expr: &Expr<'_, '_>) -> bool {
        match &expr.kind {
            ExprKind::Variable(name) => name.as_str() == "GLOBALS",
            ExprKind::Parenthesized(inner) => is_globals(inner),
            _ => false,
        }
    }

    let mut finder = EmptyDims {
        read: Vec::new(),
        unset: Vec::new(),
        globals_append: Vec::new(),
        globals_read_only: parser.version >= PhpVersion::Php81,
        by_ref: Vec::new(),
    };
    for stmt in stmts {
        let _ = finder.visit_stmt(stmt);
    }
    for expr in exprs {
        let _ = finder.visit_expr(expr);
    }
    for (spans, rule, message) in [
        (
            finder.read,
            ForbiddenRule::AppendOutsideWrite,
            "cannot use [] for reading",
        ),
        (
            finder.unset,
            ForbiddenRule::AppendOutsideWrite,
            "cannot use [] for unsetting",
        ),
        (
            finder.globals_append,
            ForbiddenRule::InvalidGlobalsWrite,
            "Cannot append to $GLOBALS",
        ),
    ] {
        for span in spans {
            parser.forbid(rule, message, span);
        }
    }
}

/// Report every `(void)` cast whose result is used as a value. PHP allows one only as an
/// expression statement or a `for` expression other than the last condition, including as
/// the leftmost operand of a binary chain there: `(void) $x || $y;`.
pub(crate) fn check_void_casts<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    stmts: &[Stmt<'arena, 'src>],
) {
    use php_ast::visitor::{walk_expr, walk_stmt, Visitor};
    use std::ops::ControlFlow;

    struct VoidCasts {
        misused: Vec<Span>,
    }
    impl VoidCasts {
        fn statement_expr(&mut self, expr: &Expr<'_, '_>) {
            match &expr.kind {
                ExprKind::Cast(CastKind::Void, inner) => {
                    let _ = self.visit_expr(inner);
                }
                ExprKind::Binary(b) => {
                    self.statement_expr(b.left);
                    let _ = self.visit_expr(b.right);
                }
                _ => {
                    let _ = self.visit_expr(expr);
                }
            }
        }
    }
    impl<'a, 's> Visitor<'a, 's> for VoidCasts {
        type Break = ();
        fn visit_stmt(&mut self, stmt: &Stmt<'a, 's>) -> ControlFlow<()> {
            match &stmt.kind {
                StmtKind::Expression(expr) => self.statement_expr(expr),
                StmtKind::For(f) => {
                    // Only the last condition is used as a value.
                    let (last_condition, conditions) = match f.condition.split_last() {
                        Some((last, rest)) => (Some(last), rest),
                        None => (None, &[][..]),
                    };
                    for expr in f.init.iter().chain(conditions).chain(f.update.iter()) {
                        self.statement_expr(expr);
                    }
                    if let Some(expr) = last_condition {
                        let _ = self.visit_expr(expr);
                    }
                    let _ = self.visit_stmt(f.body);
                }
                _ => {
                    let _ = walk_stmt(self, stmt);
                }
            }
            ControlFlow::Continue(())
        }

        fn visit_expr(&mut self, expr: &Expr<'a, 's>) -> ControlFlow<()> {
            if matches!(expr.kind, ExprKind::Cast(CastKind::Void, _)) {
                self.misused.push(expr.span);
            }
            walk_expr(self, expr)
        }
    }

    let mut finder = VoidCasts {
        misused: Vec::new(),
    };
    for stmt in stmts {
        let _ = finder.visit_stmt(stmt);
    }
    for span in finder.misused {
        parser.forbid(
            ForbiddenRule::VoidCastInExpression,
            "(void) cast cannot be used in an expression context",
            span,
        );
    }
}

/// The lowercase spelling of `self`, `parent` or `static` written in any case.
pub(crate) fn class_keyword(name: &str) -> Option<&'static str> {
    ["self", "parent", "static"]
        .into_iter()
        .find(|kw| name.eq_ignore_ascii_case(kw))
}

/// The property name PHP folds `${…}` to at compile time: a literal, or a concatenation of literals.
fn literal_string<'a>(expr: &'a Expr<'_, '_>) -> Option<std::borrow::Cow<'a, str>> {
    use std::borrow::Cow;
    match &expr.kind {
        ExprKind::String(value) => Some(value.to_string_lossy()),
        ExprKind::Nowdoc { value, .. } => Some(Cow::Borrowed(value)),
        ExprKind::Heredoc { parts, .. } => parts
            .iter()
            .map(|part| match part {
                StringPart::Literal(text) => Some(text.to_string_lossy()),
                _ => None,
            })
            .collect::<Option<String>>()
            .map(Cow::Owned),
        ExprKind::Int(value) => Some(Cow::Owned(value.to_string())),
        ExprKind::Float(value) => Some(Cow::Owned(php_float_to_string(*value))),
        ExprKind::Parenthesized(inner) => literal_string(inner),
        ExprKind::Binary(b) if b.op == BinaryOp::Concat => {
            let mut text = literal_string(b.left)?.into_owned();
            text.push_str(&literal_string(b.right)?);
            Some(Cow::Owned(text))
        }
        _ => None,
    }
}

/// A float converted to a string the way PHP does with the default `precision=14`.
fn php_float_to_string(value: f64) -> String {
    const PRECISION: i32 = 14;
    if value.is_nan() {
        return "NAN".to_string();
    }
    if value.is_infinite() {
        return if value < 0.0 { "-INF" } else { "INF" }.to_string();
    }
    let scientific = format!("{:.*e}", PRECISION as usize - 1, value);
    let (mantissa, exponent) = scientific.split_once('e').unwrap_or((&scientific, "0"));
    let exponent: i32 = exponent.parse().unwrap_or(0);
    if !(-4..PRECISION).contains(&exponent) {
        let mantissa = mantissa.trim_end_matches('0');
        let mantissa = match mantissa.strip_suffix('.') {
            Some(int) => format!("{int}.0"),
            None => mantissa.to_string(),
        };
        let sign = if exponent < 0 { '-' } else { '+' };
        return format!("{mantissa}E{sign}{}", exponent.abs());
    }
    let fixed = format!("{:.*}", (PRECISION - 1 - exponent) as usize, value);
    if fixed.contains('.') {
        fixed
            .trim_end_matches('0')
            .trim_end_matches('.')
            .to_string()
    } else {
        fixed
    }
}

/// `\self`, `\parent` or `\static`, which PHP rejects wherever it resolves a class name.
pub(crate) fn fully_qualified_class_keyword<'src>(name: &Name<'_, 'src>) -> Option<&'src str> {
    match name {
        Name::Complex {
            parts,
            kind: NameKind::FullyQualified,
            ..
        } if parts.len() == 1 && class_keyword(parts[0]).is_some() => Some(parts[0]),
        _ => None,
    }
}

/// Report `self`, `parent` and `static` where PHP knows at compile time that they name no
/// class: in a function outside any class, or `parent` in a class without one. Closures,
/// top-level code and traits can be bound to any class, so they are never checked.
pub(crate) fn check_class_keyword_refs<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    stmts: &[Stmt<'arena, 'src>],
) {
    use php_ast::visitor::{
        walk_class_member, walk_enum_member, walk_expr, walk_property_hook, walk_stmt,
        walk_type_hint, Visitor,
    };
    use std::ops::ControlFlow;

    #[derive(Clone, Copy, PartialEq)]
    enum Code {
        File,
        Function,
        Closure,
        Method,
    }
    #[derive(Clone, Copy)]
    struct Class {
        has_parent: bool,
        is_trait: bool,
    }
    #[derive(Clone, Copy)]
    struct Scope<'src> {
        code: Code,
        class: Option<Class>,
        /// The property and kind of the hook whose body this is.
        hook: Option<(&'src str, PropertyHookKind)>,
        /// In a constant expression PHP resolves only `X::class` at compile time.
        const_expr: bool,
    }
    struct ClassRefs<'src> {
        scope: Scope<'src>,
        /// Before PHP 8.3 a static variable's initializer is a constant expression.
        static_init_is_const_expr: bool,
        /// Before PHP 8.0 `parent` in a class without a parent is resolved at runtime.
        parent_needs_parent_class: bool,
        /// Property hooks, and with them `parent::$x::get()` hook calls, exist from PHP 8.4.
        parent_hook_calls: bool,
        errors: Vec<(ForbiddenRule, String, Span)>,
    }
    impl<'src> ClassRefs<'src> {
        fn scoped(&mut self, scope: Scope<'src>, walk: impl FnOnce(&mut Self)) {
            let saved = std::mem::replace(&mut self.scope, scope);
            walk(self);
            self.scope = saved;
        }

        fn in_class(&mut self, has_parent: bool, is_trait: bool, walk: impl FnOnce(&mut Self)) {
            let scope = Scope {
                code: self.scope.code,
                class: Some(Class {
                    has_parent,
                    is_trait,
                }),
                hook: None,
                const_expr: false,
            };
            self.scoped(scope, walk);
        }

        fn in_code(&mut self, code: Code, walk: impl FnOnce(&mut Self)) {
            let class = if code == Code::Function {
                None
            } else {
                self.scope.class
            };
            let scope = Scope {
                code,
                class,
                hook: None,
                const_expr: false,
            };
            self.scoped(scope, walk);
        }

        fn hook(&mut self, property: Option<&'src str>, hook: &PropertyHook<'_, 'src>) {
            let scope = Scope {
                code: Code::Method,
                class: self.scope.class,
                hook: property.map(|p| (p, hook.kind)),
                const_expr: false,
            };
            self.scoped(scope, |v| {
                let _ = walk_property_hook(v, hook);
            });
        }

        /// `parent::$x::get()` calls the parent's hook of the property whose hook this is.
        fn parent_hook_call(
            &mut self,
            class: &Expr<'_, 'src>,
            method: &Expr<'_, 'src>,
            span: Span,
            callable: bool,
        ) -> bool {
            if !self.parent_hook_calls {
                return false;
            }
            let (prop_class, property) = match &class.kind {
                ExprKind::StaticPropertyAccess(prop) => match &prop.member.kind {
                    ExprKind::Identifier(property) => {
                        (prop.class, std::borrow::Cow::Borrowed(property.as_str()))
                    }
                    _ => return false,
                },
                // `parent::${'a'}::get()`: PHP folds a literal property name at compile time.
                ExprKind::StaticPropertyAccessDynamic { class, member } => match &member.kind {
                    ExprKind::VariableVariable(name) => match literal_string(name) {
                        Some(property) => (*class, property),
                        None => return false,
                    },
                    _ => return false,
                },
                _ => return false,
            };
            let (ExprKind::Name(parent), ExprKind::Identifier(hook)) =
                (&prop_class.kind, &method.kind)
            else {
                return false;
            };
            let hook_kind = if hook.eq_ignore_ascii_case("get") {
                PropertyHookKind::Get
            } else if hook.eq_ignore_ascii_case("set") {
                PropertyHookKind::Set
            } else {
                return false;
            };
            if !matches!(
                parent.kind(),
                NameKind::Unqualified | NameKind::FullyQualified
            ) || !matches!(parent.parts_slice(), [p] if p.eq_ignore_ascii_case("parent"))
            {
                return false;
            }
            let (property, hook) = (property.as_ref(), hook.as_str());
            let message = match self.scope.hook {
                _ if self.scope.class.is_none() => {
                    self.errors.push((
                        ForbiddenRule::ClassKeywordOutsideClass,
                        "Cannot use \"parent\" when no class scope is active".to_string(),
                        parent.span(),
                    ));
                    return true;
                }
                _ if callable => "Cannot create Closure for parent property hook call".to_string(),
                None => {
                    format!("Must not use parent::${property}::{hook}() outside a property hook")
                }
                Some((active, _)) if active != property => format!(
                    "Must not use parent::${property}::{hook}() in a different property (${active})"
                ),
                Some((_, active)) if active != hook_kind => format!(
                    "Must not use parent::${property}::{hook}() in a different property hook ({})",
                    if active == PropertyHookKind::Get {
                        "get"
                    } else {
                        "set"
                    }
                ),
                Some(_) => return true,
            };
            self.errors
                .push((ForbiddenRule::InvalidParentHookCall, message, span));
            true
        }

        fn const_expr(&mut self, expr: &Expr<'_, 'src>) {
            let scope = Scope {
                const_expr: true,
                ..self.scope
            };
            self.scoped(scope, |v| {
                let _ = v.visit_expr(expr);
            });
        }

        fn attributes(&mut self, attributes: &[Attribute<'_, 'src>]) {
            for attribute in attributes {
                let _ = self.visit_attribute(attribute);
            }
        }

        fn keyword(&mut self, keyword: &str, span: Span) {
            let scope = self.scope;
            let scope_known = match (scope.code, scope.class) {
                (Code::Closure, _) => false,
                (code, None) => code != Code::File,
                (_, Some(class)) => !class.is_trait,
            };
            if !scope_known {
                return;
            }
            let (rule, message) = match scope.class {
                None => (
                    ForbiddenRule::ClassKeywordOutsideClass,
                    format!("Cannot use \"{keyword}\" when no class scope is active"),
                ),
                Some(class)
                    if keyword == "parent"
                        && !class.has_parent
                        && self.parent_needs_parent_class =>
                {
                    (
                        ForbiddenRule::ParentWithoutParentClass,
                        "Cannot use \"parent\" when current class scope has no parent".to_string(),
                    )
                }
                Some(_) => return,
            };
            self.errors.push((rule, message, span));
        }

        fn class_ref(&mut self, class: &Expr<'_, '_>, class_name_fetch: bool) {
            let ExprKind::Name(name) = &class.kind else {
                return;
            };
            if let Some(text) = fully_qualified_class_keyword(name) {
                // `\self::class` resolves like `self::class`.
                if !class_name_fetch {
                    self.errors.push((
                        ForbiddenRule::QualifiedClassKeyword,
                        format!("'\\{text}' is an invalid class name"),
                        name.span(),
                    ));
                    return;
                }
            } else if !matches!(name, Name::Simple { .. })
                || (self.scope.const_expr && !class_name_fetch)
            {
                return;
            }
            if let Some(keyword) = name.parts_slice().first().and_then(|p| class_keyword(p)) {
                let reported = self.errors.len();
                self.keyword(keyword, name.span());
                if keyword == "static" && self.scope.const_expr && self.errors.len() == reported {
                    self.errors.push((
                        ForbiddenRule::StaticClassInConstantExpression,
                        "static::class cannot be used for compile-time class name resolution"
                            .to_string(),
                        name.span(),
                    ));
                }
            }
        }
    }
    impl<'a, 's> Visitor<'a, 's> for ClassRefs<'s> {
        type Break = ();
        fn visit_stmt(&mut self, stmt: &Stmt<'a, 's>) -> ControlFlow<()> {
            match &stmt.kind {
                StmtKind::Function(_) => self.in_code(Code::Function, |v| {
                    let _ = walk_stmt(v, stmt);
                }),
                StmtKind::Class(c) => self.in_class(c.extends.is_some(), false, |v| {
                    let _ = walk_stmt(v, stmt);
                }),
                StmtKind::Interface(_) | StmtKind::Enum(_) => self.in_class(false, false, |v| {
                    let _ = walk_stmt(v, stmt);
                }),
                StmtKind::Trait(_) => self.in_class(false, true, |v| {
                    let _ = walk_stmt(v, stmt);
                }),
                StmtKind::Const(items) => {
                    for item in items.iter() {
                        self.attributes(&item.attributes);
                        self.const_expr(&item.value);
                    }
                }
                StmtKind::StaticVar(vars) if self.static_init_is_const_expr => {
                    for default in vars.iter().filter_map(|var| var.default.as_ref()) {
                        self.const_expr(default);
                    }
                }
                _ => {
                    let _ = walk_stmt(self, stmt);
                }
            }
            ControlFlow::Continue(())
        }

        fn visit_expr(&mut self, expr: &Expr<'a, 's>) -> ControlFlow<()> {
            match &expr.kind {
                ExprKind::Closure(_) | ExprKind::ArrowFunction(_) => {
                    self.in_code(Code::Closure, |v| {
                        let _ = walk_expr(v, expr);
                    });
                    return ControlFlow::Continue(());
                }
                ExprKind::AnonymousClass(c) => {
                    self.in_class(c.extends.is_some(), false, |v| {
                        let _ = walk_expr(v, expr);
                    });
                    return ControlFlow::Continue(());
                }
                ExprKind::StaticMethodCall(call) => {
                    if self.parent_hook_call(call.class, call.method, expr.span, false) {
                        for arg in call.args.iter() {
                            let _ = self.visit_arg(arg);
                        }
                        return ControlFlow::Continue(());
                    }
                    self.class_ref(call.class, false);
                }
                ExprKind::StaticMethodCallDynamic(call) => self.class_ref(call.class, false),
                ExprKind::New(new) => self.class_ref(new.class, false),
                ExprKind::StaticPropertyAccess(access) => self.class_ref(access.class, false),
                ExprKind::ClassConstAccess(access) => {
                    let class_name_fetch = matches!(&access.member.kind, ExprKind::Identifier(name) if name.eq_ignore_ascii_case("class"));
                    self.class_ref(access.class, class_name_fetch);
                }
                ExprKind::ClassConstAccessDynamic { class, .. }
                | ExprKind::StaticPropertyAccessDynamic { class, .. } => {
                    self.class_ref(class, false)
                }
                ExprKind::Binary(b) if b.op == BinaryOp::Instanceof => {
                    self.class_ref(b.right, false)
                }
                ExprKind::CallableCreate(cc) => {
                    if let CallableCreateKind::StaticMethod { class, method } = &cc.kind {
                        if self.parent_hook_call(class, method, expr.span, true) {
                            return ControlFlow::Continue(());
                        }
                        self.class_ref(class, false);
                    }
                }
                _ => {}
            }
            walk_expr(self, expr)
        }

        fn visit_class_member(&mut self, member: &ClassMember<'a, 's>) -> ControlFlow<()> {
            match &member.kind {
                ClassMemberKind::Method(_) => self.in_code(Code::Method, |v| {
                    let _ = walk_class_member(v, member);
                }),
                ClassMemberKind::Property(prop) => {
                    self.attributes(&prop.attributes);
                    if let Some(type_hint) = &prop.type_hint {
                        let _ = self.visit_type_hint(type_hint);
                    }
                    if let Some(default) = &prop.default {
                        self.const_expr(default);
                    }
                    for hook in prop.hooks.iter() {
                        self.hook(prop.name.as_str(), hook);
                    }
                }
                ClassMemberKind::ClassConst(cc) => {
                    self.attributes(&cc.attributes);
                    if let Some(type_hint) = cc.type_hint {
                        let _ = self.visit_type_hint(type_hint);
                    }
                    self.const_expr(&cc.value);
                }
                _ => {}
            }
            ControlFlow::Continue(())
        }

        fn visit_enum_member(&mut self, member: &EnumMember<'a, 's>) -> ControlFlow<()> {
            match &member.kind {
                EnumMemberKind::Method(_) => self.in_code(Code::Method, |v| {
                    let _ = walk_enum_member(v, member);
                }),
                EnumMemberKind::Case(case) => {
                    self.attributes(&case.attributes);
                    if let Some(value) = &case.value {
                        self.const_expr(value);
                    }
                }
                EnumMemberKind::ClassConst(cc) => {
                    self.attributes(&cc.attributes);
                    if let Some(type_hint) = cc.type_hint {
                        let _ = self.visit_type_hint(type_hint);
                    }
                    self.const_expr(&cc.value);
                }
                _ => {}
            }
            ControlFlow::Continue(())
        }

        fn visit_param(&mut self, param: &Param<'a, 's>) -> ControlFlow<()> {
            self.attributes(&param.attributes);
            if let Some(type_hint) = &param.type_hint {
                let _ = self.visit_type_hint(type_hint);
            }
            if let Some(default) = &param.default {
                self.const_expr(default);
            }
            for hook in param.hooks.iter() {
                self.hook(param.name.as_str(), hook);
            }
            ControlFlow::Continue(())
        }

        fn visit_attribute(&mut self, attribute: &Attribute<'a, 's>) -> ControlFlow<()> {
            for value in attribute.args.iter().filter_map(|a| a.value()) {
                self.const_expr(value);
            }
            ControlFlow::Continue(())
        }

        fn visit_type_hint(&mut self, type_hint: &TypeHint<'a, 's>) -> ControlFlow<()> {
            match &type_hint.kind {
                TypeHintKind::Keyword(BuiltinType::Self_, span) => self.keyword("self", *span),
                TypeHintKind::Keyword(BuiltinType::Parent_, span) => self.keyword("parent", *span),
                TypeHintKind::Keyword(BuiltinType::Static, span) => self.keyword("static", *span),
                // A type drops the `namespace\` prefix before looking for a class keyword.
                TypeHintKind::Named(
                    name @ Name::Complex {
                        parts,
                        kind: NameKind::Relative,
                        ..
                    },
                ) if parts.len() == 1 => {
                    if let Some(keyword) = class_keyword(parts[0]) {
                        self.keyword(keyword, name.span());
                    }
                }
                _ => {
                    let _ = walk_type_hint(self, type_hint);
                }
            }
            ControlFlow::Continue(())
        }
    }

    let mut finder = ClassRefs {
        scope: Scope {
            code: Code::File,
            class: None,
            hook: None,
            const_expr: false,
        },
        static_init_is_const_expr: parser.version < PhpVersion::Php83,
        parent_needs_parent_class: parser.version >= PhpVersion::Php80,
        parent_hook_calls: parser.version >= PhpVersion::Php84,
        errors: Vec::new(),
    };
    for stmt in stmts {
        let _ = finder.visit_stmt(stmt);
    }
    // An anonymous class body is walked before its constructor arguments.
    finder.errors.sort_by_key(|(_, _, span)| span.start);
    for (rule, message, span) in finder.errors {
        parser.forbid(rule, message, span);
    }
}
