use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::ParseError;
use crate::parser::Parser;

/// Parse trait adaptation block: `{ A::foo insteadof B; foo as bar; ... }`
/// Called after consuming `{`.
pub(super) fn parse_trait_adaptations<'arena, 'src>(
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
            let method = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
                Name::Simple { value: text, span }
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "method name".into(),
                    found: parser.current_kind(),
                    span,
                });
                Name::Error { span }
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
                let span = Span::new(start, parser.previous_end());
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
                let span = Span::new(start, parser.previous_end());
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
                    expected: "'insteadof' or 'as'".into(),
                    found: parser.current_kind(),
                    span,
                });
                parser.advance();
            }
        } else if parser.eat(TokenKind::As).is_some() {
            // Unqualified alias: `method as [visibility] [newName];`
            // first_name already is the method Name — use it directly.
            let (new_modifier, new_name) = parse_alias_rhs(parser);
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(start, parser.previous_end());
            adaptations.push(TraitAdaptation {
                kind: TraitAdaptationKind::Alias {
                    trait_name: None,
                    method: first_name,
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
) -> (Option<Visibility>, Option<Name<'arena, 'src>>) {
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
    let new_name = parser
        .eat_identifier_or_keyword()
        .map(|(text, span)| Name::Simple { value: text, span });

    (new_modifier, new_name)
}
