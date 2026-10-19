use php_ast::*;
use php_lexer::TokenKind;

use crate::attributes::{AttrSite, AttrTarget, ClassKind};
use crate::diagnostics::ParseError;
use crate::expr;
use crate::parser::Parser;
use crate::version::PhpVersion;

pub(super) fn parse_enum<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    let start = parser.start_span();
    parser.advance(); // consume 'enum'

    let name_is_reserved_kw = parser.is_reserved_keyword_as_decl_name();
    let name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        if name_is_reserved_kw {
            parser.error(ParseError::Forbidden {
                message: format!("cannot use '{}' as enum name", text).into(),
                span,
            });
        }
        Ident::new(text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "enum name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.missing_ident()
    };

    // Backed enum: enum Foo: string — the backing type must be `int` or `string`.
    let scalar_type = if parser.eat(TokenKind::Colon).is_some() {
        let ty = parser.parse_name();
        let is_int_or_string = matches!(ty, Name::Simple { value, .. }
            if value.eq_ignore_ascii_case("int") || value.eq_ignore_ascii_case("string"));
        if !is_int_or_string {
            parser.error(ParseError::Forbidden {
                message: "Enum backing type must be int or string".into(),
                span: ty.span(),
            });
        }
        Some(ty)
    } else {
        None
    };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        let names = super::class::parse_name_list(parser);
        for name in names.iter() {
            super::class::validate_class_ref(parser, name, "interface");
        }
        names
    } else {
        parser.alloc_vec()
    };

    // Capture docblock before parsing body (members must not steal it)
    let doc_comment = parser.take_doc_comment(start);

    let brace_start = parser.start_span();
    parser.expect(TokenKind::LeftBrace);
    parser.check_class_nesting(name.span);
    let scope = parser.class_scope_for(name.as_str(), None, false);
    parser.check_attributes(&attributes, &AttrSite::class(ClassKind::Enum, &scope.name));
    let outer_scope = parser.class_scope.replace(scope);

    let mut members = parser.alloc_vec_with_capacity(4);
    let mut seen_methods = std::collections::HashSet::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) {
            parser.advance();
            continue;
        }
        let member_attrs = parser.parse_attributes();
        let member_start = parser.start_span();

        // Trait use
        if parser.check(TokenKind::Use) {
            let decl = super::class::parse_trait_use_decl(parser, member_start);
            let span = Span::new(member_start, parser.previous_end());
            members.push(EnumMember {
                kind: EnumMemberKind::TraitUse(decl),
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
                    (Ident::new(text, span), span)
                } else {
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "case name".into(),
                        found: parser.current_kind().description().into(),
                        span,
                    });
                    (parser.missing_ident(), span)
                };
            let equals_token = parser.eat(TokenKind::Equals);
            let value = if equals_token.is_some() {
                let value = expr::parse_expr(parser);
                expr::check_const_expr(parser, &value, false);
                Some(value)
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
                // If value.is_some(), then equals_token must be Some since value is only set when equals_token.is_some()
                let span = equals_token
                    .expect("value.is_some() guarantees equals_token.is_some()")
                    .span;
                parser.error(ParseError::Forbidden {
                    message: format!(
                        "Case {} of pure enum {} must not have a value",
                        case_name, name
                    )
                    .into(),
                    span,
                });
            }
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.previous_end());
            parser.check_attributes(&member_attrs, &AttrSite::new(AttrTarget::ClassConst));
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
        let mut is_readonly = false;

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
                TokenKind::Readonly => {
                    parser.advance();
                    is_readonly = true;
                }
                _ => break,
            }
        }

        // Const
        if parser.check(TokenKind::Const) {
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
            if is_final && visibility == Some(Visibility::Private) {
                parser.error(ParseError::Forbidden {
                    message:
                        "Private constant cannot be final as it is not visible to other classes"
                            .into(),
                    span: parser.current_span(),
                });
            }
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

            let first_index = members.len();
            parser.check_attributes(&member_attrs, &AttrSite::new(AttrTarget::ClassConst));
            let mut attributes = Some(member_attrs);
            loop {
                let const_name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
                    Ident::new(text, span)
                } else {
                    parser.error(ParseError::Expected {
                        expected: "constant name".into(),
                        found: parser.current_kind().description().into(),
                        span: parser.current_span(),
                    });
                    parser.missing_ident()
                };
                if let (Some(ty), Some(name), true) = (
                    const_type,
                    const_name.as_str(),
                    members.len() == first_index,
                ) {
                    parser.reject_member_type(ty, "Class constant", name);
                }
                parser.expect(TokenKind::Equals);
                let value = expr::parse_expr(parser);
                expr::check_const_expr(parser, &value, false);
                // Every item of `const A = 1, B = 2;` gets its own copy of the attributes.
                let attributes = attributes.take().unwrap_or_else(|| {
                    let EnumMemberKind::ClassConst(first) = &members[first_index].kind else {
                        unreachable!()
                    };
                    super::class::copy_attributes(parser, &first.attributes)
                });
                let doc_comment = if members.len() == first_index {
                    parser.take_doc_comment(member_start)
                } else {
                    None
                };
                members.push(EnumMember {
                    kind: EnumMemberKind::ClassConst(ClassConstDecl {
                        name: const_name,
                        modifiers: super::class::const_modifiers_of(visibility, is_final),
                        type_hint: const_type,
                        value,
                        attributes,
                        doc_comment,
                    }),
                    span: Span::new(member_start, parser.previous_end()),
                });
                if parser.eat(TokenKind::Comma).is_none() {
                    break;
                }
            }
            parser.expect(TokenKind::Semicolon);
            let span = Span::new(member_start, parser.previous_end());
            for member in &mut members[first_index..] {
                member.span = span;
            }
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

            let mut mods = php_ast::Modifiers::new();
            mods.visibility = visibility;
            mods.is_static = is_static;
            mods.is_abstract = is_abstract;
            mods.is_final = is_final;
            mods.is_readonly = is_readonly;
            let member = super::class::parse_method_member(
                parser,
                member_attrs,
                member_start,
                &mods,
                false,
                false,
            );
            if let ClassMemberKind::Method(method) = member.kind {
                super::class::report_redeclared_method(
                    parser,
                    &mut seen_methods,
                    &method,
                    member.span,
                );
                members.push(EnumMember {
                    kind: EnumMemberKind::Method(method),
                    span: member.span,
                });
            }
            continue;
        }

        parser.error(ParseError::Expected {
            expected: "enum member".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.synchronize_enum_body();
    }
    let constants = members.iter().filter_map(|m| match &m.kind {
        EnumMemberKind::Case(c) => Some(&c.name),
        EnumMemberKind::ClassConst(c) => Some(&c.name),
        _ => None,
    });
    super::class::report_redefined_constants(parser, constants);
    parser.class_scope = outer_scope;

    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();
    Stmt {
        kind: StmtKind::Enum(parser.alloc(EnumDecl {
            name,
            scalar_type,
            implements,
            body: EnumBody {
                members,
                span: Span::new(brace_start, end),
            },
            attributes,
            doc_comment,
        })),
        span: Span::new(start, end),
        doc_comment: None,
    }
}
