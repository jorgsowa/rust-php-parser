use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::{ParseError, ERROR_PLACEHOLDER};
use crate::expr;
use crate::parser::Parser;
use crate::version::PhpVersion;

pub(super) fn parse_enum<'arena, 'src>(
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
        ERROR_PLACEHOLDER
    };

    // Backed enum: enum Foo: string
    let scalar_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_name())
    } else {
        None
    };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        super::class::parse_name_list(parser)
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
                super::trait_use::parse_trait_adaptations(parser)
            } else {
                parser.expect(TokenKind::Semicolon);
                parser.alloc_vec()
            };
            let span = Span::new(member_start, parser.previous_end());
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
            let (case_name, case_name_span) =
                if let Some((text, span)) = parser.eat_identifier_or_keyword() {
                    (text, span)
                } else {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "case name".into(),
                        found: parser.current_kind(),
                        span,
                    });
                    (ERROR_PLACEHOLDER, span)
                };
            let equals_token = parser.eat(TokenKind::Equals);
            let value = if equals_token.is_some() {
                Some(expr::parse_expr(parser))
            } else {
                None
            };
            if scalar_type.is_some() && value.is_none() {
                parser.error(ParseError::Forbidden {
                    message: format!(
                        "Case {} of backed enum {} must have a value",
                        case_name, name
                    )
                    .into(),
                    span: case_name_span,
                });
            } else if scalar_type.is_none() && value.is_some() {
                parser.error(ParseError::Forbidden {
                    message: format!(
                        "Case {} of pure enum {} must not have a value",
                        case_name, name
                    )
                    .into(),
                    span: equals_token.unwrap().span,
                });
            }
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.previous_end());
            members.push(EnumMember {
                kind: EnumMemberKind::Case(EnumCase {
                    name: case_name,
                    value,
                    attributes: member_attrs,
                    doc_comment: parser.take_doc_comment(member_start),
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
                ERROR_PLACEHOLDER
            };
            parser.expect(TokenKind::Equals);
            let value = expr::parse_expr(parser);
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.previous_end());
            members.push(EnumMember {
                kind: EnumMemberKind::ClassConst(ClassConstDecl {
                    name: const_name,
                    visibility,
                    is_final,
                    type_hint: const_type,
                    value,
                    attributes: member_attrs,
                    doc_comment: parser.take_doc_comment(member_start),
                }),
                span,
            });
            continue;
        }

        // Method
        if parser.check(TokenKind::Function) {
            if is_abstract {
                parser.error(ParseError::Forbidden {
                    message: "enum methods cannot be abstract".into(),
                    span: Span::new(member_start, parser.previous_end()),
                });
            }

            parser.advance();
            let by_ref = parser.eat(TokenKind::Ampersand).is_some();
            let method_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
                text
            } else {
                ERROR_PLACEHOLDER
            };

            parser.expect(TokenKind::LeftParen);
            let params = super::parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            let return_type = if parser.eat(TokenKind::Colon).is_some() {
                Some(parser.parse_type_hint())
            } else {
                None
            };

            let body = if parser.check(TokenKind::LeftBrace) {
                parser.expect(TokenKind::LeftBrace);
                let mut stmts = parser.alloc_vec_with_capacity(16);
                let saved_loop_depth = parser.loop_depth;
                parser.loop_depth = 0;
                while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                    let span_before = parser.current_span();
                    stmts.push(super::parse_stmt(parser));
                    if parser.current_span() == span_before {
                        parser.advance();
                    }
                }
                parser.loop_depth = saved_loop_depth;
                parser.expect(TokenKind::RightBrace);
                Some(stmts)
            } else {
                parser.expect(TokenKind::Semicolon);
                None
            };

            let span = Span::new(member_start, parser.previous_end());
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
                    doc_comment: parser.take_doc_comment(member_start),
                }),
                span,
            });
            continue;
        }

        // Unknown — skip
        parser.advance();
    }

    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();
    let doc_comment = parser.take_doc_comment(start);
    Stmt {
        kind: StmtKind::Enum(parser.alloc(EnumDecl {
            name,
            scalar_type,
            implements,
            members,
            attributes,
            doc_comment,
        })),
        span: Span::new(start, end),
    }
}
