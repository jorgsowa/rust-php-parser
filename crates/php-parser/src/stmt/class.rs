use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::{ParseError, ERROR_PLACEHOLDER};
use crate::expr;
use crate::instrument;
use crate::parser::Parser;
use crate::version::PhpVersion;

// =============================================================================
// Class declaration
// =============================================================================

/// Check if a name is a reserved special class name (self, parent, static, readonly)
fn is_reserved_class_name(name: &str) -> bool {
    name.eq_ignore_ascii_case("self")
        || name.eq_ignore_ascii_case("parent")
        || name.eq_ignore_ascii_case("static")
        || name.eq_ignore_ascii_case("readonly")
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

pub(super) fn parse_class<'arena, 'src>(
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
        (ERROR_PLACEHOLDER, parser.current_span())
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
    let members = parse_class_members(parser, false);
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();
    let doc_comment = parser.take_doc_comment(start);

    Stmt {
        kind: StmtKind::Class(parser.alloc(ClassDecl {
            name: Some(name),
            modifiers,
            extends,
            implements,
            members,
            attributes,
            doc_comment,
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

/// Parse property hooks: `{ get { ... } set(Type $value) { ... } }`
pub(super) fn parse_property_hooks<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, PropertyHook<'arena, 'src>> {
    let open = parser.expect(TokenKind::LeftBrace);
    let open_span = open.map(|t| t.span).unwrap_or(parser.current_span());

    let mut hooks = parser.alloc_vec();
    let mut seen_get = false;
    let mut seen_set = false;

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
            let paren_span = parser.current_span();
            parser.advance();
            let p = super::parse_param_list(parser);
            parser.expect(TokenKind::RightParen);

            // Validate parameter counts against hook kind
            match kind {
                PropertyHookKind::Get => {
                    if !p.is_empty() {
                        parser.error(ParseError::Forbidden {
                            message: "get hook must not have a parameter list".into(),
                            span: paren_span,
                        });
                    }
                }
                PropertyHookKind::Set => {
                    if p.len() != 1 {
                        parser.error(ParseError::Forbidden {
                            message: "set hook must have exactly one parameter".into(),
                            span: paren_span,
                        });
                    }
                }
            }

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
                stmts.push(super::parse_stmt(parser));
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

        // Check for duplicate hook kinds
        match kind {
            PropertyHookKind::Get => {
                if seen_get {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate 'get' hook".into(),
                        span: Span::new(hook_start, parser.previous_end()),
                    });
                }
                seen_get = true;
            }
            PropertyHookKind::Set => {
                if seen_set {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate 'set' hook".into(),
                        span: Span::new(hook_start, parser.previous_end()),
                    });
                }
                seen_set = true;
            }
        }

        let hook_span = Span::new(hook_start, parser.previous_end());
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

struct ClassMemberModifiers {
    visibility: Option<Visibility>,
    set_visibility: Option<Visibility>,
    is_static: bool,
    is_abstract: bool,
    is_final: bool,
    is_readonly: bool,
}

pub fn parse_class_members<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    in_interface: bool,
) -> ArenaVec<'arena, ClassMember<'arena, 'src>> {
    // March 2026: reduce from 16 to 4 for class members
    // Most classes have 3-10 members; larger classes grow efficiently
    let mut members = parser.alloc_vec_with_capacity(4);
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) {
            parser.advance();
            continue;
        }

        let member_start = parser.start_span();
        let member_attrs = parser.parse_attributes();

        if parser.check(TokenKind::Use) {
            let _ = member_attrs;
            members.push(parse_trait_use_member(parser, member_start));
            continue;
        }

        let mods = parse_class_member_modifiers(parser, member_start);

        // Detect unknown modifier: bare identifier before $variable with no modifiers set.
        if mods.visibility.is_none()
            && !mods.is_static
            && !mods.is_abstract
            && !mods.is_final
            && !mods.is_readonly
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

        if parser.check(TokenKind::Const) {
            parse_class_const_member(parser, &mut members, member_attrs, member_start, &mods);
            continue;
        }

        if parser.check(TokenKind::Function) {
            members.push(parse_method_member(
                parser,
                member_attrs,
                member_start,
                &mods,
                in_interface,
            ));
            continue;
        }

        let type_hint = if parser.could_be_type_hint() && !parser.check(TokenKind::Variable) {
            Some(parser.parse_type_hint())
        } else {
            None
        };

        if parser.check(TokenKind::Variable) {
            parse_property_member(
                parser,
                &mut members,
                member_attrs,
                member_start,
                &mods,
                type_hint,
            );
            continue;
        }

        parser.error(ParseError::Expected {
            expected: "class member".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
        parser.synchronize_class_body();
    }
    members
}

fn parse_trait_use_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_start: u32,
) -> ClassMember<'arena, 'src> {
    parser.advance(); // consume `use`
    let mut traits = parser.alloc_vec_with_capacity(2);
    traits.push(parser.parse_name());
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) || parser.check(TokenKind::LeftBrace) {
            break; // trailing comma
        }
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
    ClassMember {
        kind: ClassMemberKind::TraitUse(TraitUseDecl {
            traits,
            adaptations,
        }),
        span,
    }
}

fn parse_class_member_modifiers<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_start: u32,
) -> ClassMemberModifiers {
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

                if visibility.is_none() {
                    visibility = Some(vis);
                    // Look ahead for second visibility keyword followed by ( (asymmetric visibility)
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
                        asym_vis_span = Some(Span::new(member_start, parser.previous_end()));
                        parser.advance(); // consume second visibility
                        parser.advance(); // consume (
                        if parser.current_text() == "set" {
                            parser.advance(); // consume "set"
                        }
                        parser.expect(TokenKind::RightParen);
                        set_visibility = Some(set_vis);
                    }
                } else if parser.check(TokenKind::LeftParen) {
                    // Already have visibility; this is set_visibility with (set)
                    // Save span for deferred version check after is_static is known.
                    asym_vis_span = Some(Span::new(member_start, parser.previous_end()));
                    parser.advance(); // consume (
                    if parser.current_text() == "set" {
                        parser.advance(); // consume "set"
                    }
                    parser.expect(TokenKind::RightParen);
                    set_visibility = Some(vis);
                } else {
                    parser.error(ParseError::Forbidden {
                        message: "cannot use multiple visibility modifiers".into(),
                        span: Span::new(member_start, parser.previous_end()),
                    });
                }
            }
            TokenKind::Static => {
                if is_static {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate modifier 'static'".into(),
                        span: Span::new(member_start, parser.previous_end()),
                    });
                }
                parser.advance();
                is_static = true;
            }
            TokenKind::Abstract => {
                if is_abstract {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate modifier 'abstract'".into(),
                        span: Span::new(member_start, parser.previous_end()),
                    });
                }
                parser.advance();
                is_abstract = true;
            }
            TokenKind::Final => {
                if is_final {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate modifier 'final'".into(),
                        span: Span::new(member_start, parser.previous_end()),
                    });
                }
                parser.advance();
                is_final = true;
            }
            TokenKind::Readonly => {
                if is_readonly {
                    parser.error(ParseError::Forbidden {
                        message: "duplicate modifier 'readonly'".into(),
                        span: Span::new(member_start, parser.previous_end()),
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

    if is_abstract && is_final {
        parser.error(ParseError::Forbidden {
            message: "cannot use 'abstract' and 'final' together".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if is_static && is_readonly {
        parser.error(ParseError::Forbidden {
            message: "static properties cannot be readonly".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }

    // Emit version check now that is_static is known.
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

    ClassMemberModifiers {
        visibility,
        set_visibility,
        is_static,
        is_abstract,
        is_final,
        is_readonly,
    }
}

fn parse_class_const_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    members: &mut ArenaVec<'arena, ClassMember<'arena, 'src>>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &ClassMemberModifiers,
) {
    if mods.is_static {
        parser.error(ParseError::Forbidden {
            message: "cannot use 'static' as constant modifier".into(),
            span: parser.current_span(),
        });
    }
    if mods.is_abstract {
        parser.error(ParseError::Forbidden {
            message: "cannot use 'abstract' as constant modifier".into(),
            span: parser.current_span(),
        });
    }
    if mods.is_readonly {
        parser.error(ParseError::Forbidden {
            message: "cannot use 'readonly' as constant modifier".into(),
            span: parser.current_span(),
        });
    }
    parser.advance(); // consume `const`

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
            ERROR_PLACEHOLDER
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
    let span = Span::new(member_start, parser.previous_end());
    if !member_attrs.is_empty() && const_items.len() > 1 {
        parser.error(ParseError::Forbidden {
            message: "cannot use attributes on multi-constant declaration".into(),
            span,
        });
    }
    // Allocate the type hint into the arena so all items can share a reference
    let shared_type_hint: Option<&'arena _> = const_type.map(|th| parser.alloc(th));
    let mut const_iter = const_items.into_iter();
    if let Some((first_name, first_value)) = const_iter.next() {
        members.push(ClassMember {
            kind: ClassMemberKind::ClassConst(ClassConstDecl {
                name: first_name,
                visibility: mods.visibility,
                is_final: mods.is_final,
                type_hint: shared_type_hint,
                value: first_value,
                attributes: member_attrs,
                doc_comment: parser.take_doc_comment(member_start),
            }),
            span,
        });
        for (rest_name, rest_value) in const_iter {
            members.push(ClassMember {
                kind: ClassMemberKind::ClassConst(ClassConstDecl {
                    name: rest_name,
                    visibility: mods.visibility,
                    is_final: mods.is_final,
                    type_hint: shared_type_hint,
                    value: rest_value,
                    attributes: parser.alloc_vec(),
                    doc_comment: None,
                }),
                span,
            });
        }
    }
}

fn parse_method_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &ClassMemberModifiers,
    in_interface: bool,
) -> ClassMember<'arena, 'src> {
    parser.advance(); // consume `function`
    let by_ref = parser.eat(TokenKind::Ampersand).is_some();
    let method_name = if let Some((text, _)) = parser.eat_identifier_or_keyword() {
        text
    } else {
        parser.error(ParseError::Expected {
            expected: "method name".into(),
            found: parser.current_kind(),
            span: parser.current_span(),
        });
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

    if mods.is_abstract && body.is_some() {
        parser.error(ParseError::Forbidden {
            message: "abstract method cannot contain a body".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if in_interface && body.is_some() {
        parser.error(ParseError::Forbidden {
            message: "interface method cannot contain a body".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }

    let span = Span::new(member_start, parser.previous_end());
    ClassMember {
        kind: ClassMemberKind::Method(MethodDecl {
            name: method_name,
            visibility: mods.visibility,
            is_static: mods.is_static,
            is_abstract: mods.is_abstract,
            is_final: mods.is_final,
            by_ref,
            params,
            return_type,
            body,
            attributes: member_attrs,
            doc_comment: parser.take_doc_comment(member_start),
        }),
        span,
    }
}

fn parse_property_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    members: &mut ArenaVec<'arena, ClassMember<'arena, 'src>>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &ClassMemberModifiers,
    type_hint: Option<TypeHint<'arena, 'src>>,
) {
    let var_token = parser.advance();
    let prop_name = parser.variable_name(var_token);

    let default = if parser.eat(TokenKind::Equals).is_some() {
        // Suppress `{` subscript so a following hook block `{ get => ...; }`
        // is not consumed as part of the default expression.
        Some(parser.with_no_brace_subscript(expr::parse_expr))
    } else {
        None
    };

    // Property hooks: { get { ... } set { ... } } — PHP 8.4+
    let had_hooks_block = parser.check(TokenKind::LeftBrace);
    // abstract is only valid on properties with hooks (abstract property hooks, PHP 8.4+)
    if mods.is_abstract && !had_hooks_block {
        parser.error(ParseError::Forbidden {
            message: "properties cannot be abstract".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    let hooks = if had_hooks_block {
        let span = parser.current_span();
        parser.require_version(PhpVersion::Php84, "property hooks", span);
        parse_property_hooks(parser)
    } else {
        parser.alloc_vec()
    };
    if mods.is_readonly {
        if type_hint.is_none() {
            parser.error(ParseError::Forbidden {
                message: "readonly property must have type".into(),
                span: Span::new(member_start, parser.previous_end()),
            });
        }
        if let Some(hook) = hooks.first() {
            parser.error(ParseError::Forbidden {
                message: "A readonly property cannot declare hooks".into(),
                span: hook.span,
            });
        }
    }
    let span = Span::new(member_start, parser.previous_end());
    members.push(ClassMember {
        kind: ClassMemberKind::Property(PropertyDecl {
            name: prop_name,
            visibility: mods.visibility,
            set_visibility: mods.set_visibility,
            is_static: mods.is_static,
            is_readonly: mods.is_readonly,
            type_hint,
            default,
            attributes: member_attrs,
            hooks,
            doc_comment: parser.take_doc_comment(member_start),
        }),
        span,
    });

    if had_hooks_block {
        // Property with hooks block — no comma separation or semicolon needed
    } else if parser.eat(TokenKind::Comma).is_some() {
        while parser.check(TokenKind::Variable) {
            let var_token = parser.advance();
            let pname = parser.variable_name(var_token);

            let pdefault = if parser.eat(TokenKind::Equals).is_some() {
                Some(expr::parse_expr(parser))
            } else {
                None
            };

            let phooks = if parser.check(TokenKind::LeftBrace) {
                parser.error(ParseError::Forbidden {
                    message: "cannot have hooks on comma-separated property".into(),
                    span: parser.current_span(),
                });
                parse_property_hooks(parser)
            } else {
                parser.alloc_vec()
            };
            let pspan = Span::new(member_start, parser.previous_end());
            members.push(ClassMember {
                kind: ClassMemberKind::Property(PropertyDecl {
                    name: pname,
                    visibility: None,
                    set_visibility: None,
                    is_static: mods.is_static,
                    is_readonly: mods.is_readonly,
                    type_hint: None,
                    default: pdefault,
                    attributes: parser.alloc_vec(),
                    hooks: phooks,
                    doc_comment: None,
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
}

// =============================================================================
// Interface / Trait
// =============================================================================

pub(super) fn parse_interface<'arena, 'src>(
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
        (ERROR_PLACEHOLDER, parser.current_span())
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
    let members = parse_class_members(parser, true);
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();
    let doc_comment = parser.take_doc_comment(start);

    Stmt {
        kind: StmtKind::Interface(parser.alloc(InterfaceDecl {
            name,
            extends,
            members,
            attributes,
            doc_comment,
        })),
        span: Span::new(start, end),
    }
}

pub(super) fn parse_trait<'arena, 'src>(
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
        ERROR_PLACEHOLDER
    };

    parser.expect(TokenKind::LeftBrace);
    let members = parse_class_members(parser, false);
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();
    let doc_comment = parser.take_doc_comment(start);

    Stmt {
        kind: StmtKind::Trait(parser.alloc(TraitDecl {
            name,
            members,
            attributes,
            doc_comment,
        })),
        span: Span::new(start, end),
    }
}
