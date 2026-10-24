use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::{ForbiddenRule, ParseError};
use crate::parser::Parser;
use crate::version::PhpVersion;

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
        let first_name = if parser.check(TokenKind::Namespace)
            && parser.peek_kind() != Some(TokenKind::Backslash)
        {
            // A method named `namespace`, not a `namespace\Foo` relative name.
            let value = parser.current_text();
            let span = parser.advance().span;
            Name::Simple { value, span }
        } else {
            parser.parse_name()
        };

        if parser.eat(TokenKind::DoubleColon).is_some() {
            super::validate_class_ref(parser, &first_name, "trait");
            // Qualified: TraitName::method
            let method = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
                Name::Simple { value: text, span }
            } else {
                parser.error(ParseError::Expected {
                    expected: "method name".into(),
                    found: parser.current_kind().description().into(),
                    span: parser.current_span(),
                });
                Name::Error {
                    span: parser.missing_span(),
                }
            };

            // Check for `insteadof` or `as`
            if parser.check(TokenKind::Identifier)
                && parser.current_text().eq_ignore_ascii_case("insteadof")
            {
                parser.advance(); // consume `insteadof`
                let mut insteadof = {
                    let mut _v = parser.alloc_vec_with_capacity(1);
                    _v.push(parser.parse_name());
                    _v
                };
                while parser.eat(TokenKind::Comma).is_some() {
                    if parser.check(TokenKind::Semicolon) {
                        parser.trailing_comma_error("trait name");
                        break;
                    }
                    insteadof.push(parser.parse_name());
                }
                for name in insteadof.iter() {
                    super::validate_class_ref(parser, name, "trait");
                }
                parser.expect_member_end();
                let span = parser.span_from(start);
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
                let (new_modifier, is_final, invalid_modifier, new_name) = parse_alias_rhs(parser);
                parser.expect_member_end();
                let span = parser.span_from(start);
                adaptations.push(TraitAdaptation {
                    kind: TraitAdaptationKind::Alias {
                        trait_name: Some(first_name),
                        method,
                        new_modifier,
                        is_final,
                        invalid_modifier,
                        new_name,
                    },
                    span,
                });
            } else {
                let span = parser.current_span();
                parser.error(ParseError::Expected {
                    expected: "'insteadof' or 'as'".into(),
                    found: parser.current_kind().description().into(),
                    span,
                });
                parser.advance();
            }
        } else if parser.eat(TokenKind::As).is_some() {
            // Unqualified alias: `method as [visibility] [newName];`
            // first_name already is the method Name — use it directly.
            let (new_modifier, is_final, invalid_modifier, new_name) = parse_alias_rhs(parser);
            parser.expect_member_end();
            let span = parser.span_from(start);
            adaptations.push(TraitAdaptation {
                kind: TraitAdaptationKind::Alias {
                    trait_name: None,
                    method: first_name,
                    new_modifier,
                    is_final,
                    invalid_modifier,
                    new_name,
                },
                span,
            });
        } else {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "'::' or 'as'".into(),
                found: parser.current_kind().description().into(),
                span,
            });
            parser.advance();
        }
    }
    parser.expect(TokenKind::RightBrace);
    adaptations
}

/// Parse the right-hand side of an `as` alias: `[visibility | final] [newName]`
fn parse_alias_rhs<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> (
    Option<Visibility>,
    bool,
    Option<Ident<'src>>,
    Option<Name<'arena, 'src>>,
) {
    let is_final = parser.check(TokenKind::Final);
    if is_final {
        let span = parser.advance().span;
        parser.require_version(PhpVersion::Php83, "final trait method alias", span);
    }
    let new_modifier = match parser.current_kind() {
        _ if is_final => None,
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
    // Other member modifiers parse here but cannot apply to an alias.
    let mut has_modifier = is_final || new_modifier.is_some();
    let mut invalid_modifier = None;
    if !has_modifier {
        let error = match parser.current_kind() {
            TokenKind::Static | TokenKind::Abstract => Some((
                ForbiddenRule::InvalidTraitAliasModifier,
                format!(
                    "Cannot use \"{}\" as method modifier in trait alias",
                    parser.current_text().to_ascii_lowercase()
                ),
            )),
            TokenKind::Readonly => Some((
                ForbiddenRule::ModifierNotAllowed,
                "Cannot use the readonly modifier on a method".into(),
            )),
            _ => None,
        };
        if let Some((rule, message)) = error {
            let text = parser.current_text();
            let span = parser.advance().span;
            parser.forbid(rule, message, span);
            invalid_modifier = Some(Ident::new(text, span));
            has_modifier = true;
        }
    }

    // New name (optional if a modifier was given)
    let new_name = parser
        .eat_identifier_or_keyword()
        .map(|(text, span)| Name::Simple { value: text, span });
    if new_name.is_none() && !has_modifier {
        parser.error_expected("identifier");
    }

    (new_modifier, is_final, invalid_modifier, new_name)
}
