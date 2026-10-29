use php_ast::*;
use php_lexer::TokenKind;

use crate::attributes::{AttrSite, AttrTarget, ClassKind};
use crate::diagnostics::{ForbiddenRule, ParseError};
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
        if super::class::is_reserved_class_name(text, parser.version) {
            parser.forbid(
                ForbiddenRule::ReservedEnumName,
                super::class::reserved_decl_name_message(text, "enum"),
                span,
            );
        } else if name_is_reserved_kw {
            parser.forbid(
                ForbiddenRule::KeywordAsDeclarationName,
                format!("cannot use '{}' as enum name", text),
                span,
            );
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

    // Backed enum: enum Foo: string — PHP parses any type but accepts only `int` or `string`.
    let mut scalar_type = None;
    let mut invalid_scalar_type = None;
    if parser.eat(TokenKind::Colon).is_some() {
        let ty = parser.parse_type_hint();
        let rejected = match backing_type_name(parser, ty) {
            Ok(ty) => {
                let is_int_or_string = matches!(ty, Name::Simple { value, .. }
                    if value.eq_ignore_ascii_case("int") || value.eq_ignore_ascii_case("string"));
                let rejected = (!is_int_or_string)
                    .then(|| (backing_type_display(parser, &ty, &name), ty.span()));
                scalar_type = Some(ty);
                rejected
            }
            Err(ty) => {
                let rejected = (parser.type_display(&ty), ty.span);
                invalid_scalar_type = Some(ty);
                Some(rejected)
            }
        };
        // `int|int` and `\int` resolve to `int` and are reported for the type itself.
        if let Some((given, span)) = rejected.filter(|(given, _)| {
            !given.eq_ignore_ascii_case("int") && !given.eq_ignore_ascii_case("string")
        }) {
            parser.forbid(
                ForbiddenRule::InvalidEnumBackingType,
                format!("Enum backing type must be int or string, {given} given"),
                span,
            );
        }
    }

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
    let open = parser.expect(TokenKind::LeftBrace);
    parser.check_class_nesting(name.span);
    let scope = parser.class_scope_for(name.as_str(), None, false);
    parser.check_attributes(&attributes, &AttrSite::class(ClassKind::Enum, &scope.name));
    let outer_scope = parser.class_scope.replace(scope);

    let mut members = parser.alloc_vec_with_capacity(4);
    let mut seen_methods = std::collections::HashSet::new();
    let mut case_values = Vec::new();
    let mut abstract_methods = Vec::new();
    let is_backed = scalar_type.is_some() || invalid_scalar_type.is_some();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) {
            parser.error_expected("class member");
            parser.advance();
            continue;
        }
        // A doc comment left over before an earlier member belongs to no later one.
        parser.mark_stmt_end(parser.previous_end());
        let member_start = parser.start_span();
        let member_attrs = parser.parse_attributes();

        // Trait use
        if parser.check(TokenKind::Use) {
            if !member_attrs.is_empty() {
                parser.error_expected("'function' or 'const'");
            }
            let decl = super::class::parse_trait_use_decl(parser, member_start);
            let span = parser.span_from(member_start);
            members.push(EnumMember {
                kind: EnumMemberKind::TraitUse(decl),
                span,
            });
            continue;
        }

        // PHP keeps the last doc comment before the declaration, so one after the attributes wins.
        let member_doc = parser.take_doc_comment(parser.current_span().start);

        // Enum case
        if parser.check(TokenKind::Case) {
            parser.advance();
            if parser.check(TokenKind::Class) {
                let span = parser.current_span();
                parser.forbid(
                    ForbiddenRule::EnumCaseNamedClass,
                    "A class constant must not be called 'class'; it is reserved for class name fetching",
                    span,
                );
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
                let value = parser.in_const_expr(expr::parse_expr);
                expr::check_const_expr(parser, &value, false);
                Some(value)
            } else {
                None
            };
            let enum_name = parser
                .class_scope
                .as_ref()
                .map_or_else(String::new, |scope| scope.name.clone());
            if is_backed && value.is_none() {
                parser.forbid(
                    ForbiddenRule::MissingEnumCaseValue,
                    format!("Case {case_name} of backed enum {enum_name} must have a value"),
                    case_name_span,
                );
            } else if !is_backed && value.is_some() {
                // If value.is_some(), then equals_token must be Some since value is only set when equals_token.is_some()
                let span = equals_token
                    .expect("value.is_some() guarantees equals_token.is_some()")
                    .span;
                parser.forbid(
                    ForbiddenRule::PureEnumCaseValue,
                    format!(
                        "Case {case_name} of non-backed enum {enum_name} must not have a value"
                    ),
                    span,
                );
            }
            // Only PHP 8.1 checks literal case values at compile time; later versions on first use.
            if let (Some(backing), Some(value), true) =
                (&scalar_type, &value, parser.version == PhpVersion::Php81)
            {
                check_case_value_81(
                    parser,
                    backing,
                    value,
                    &enum_name,
                    &case_name,
                    &mut case_values,
                );
            }
            parser.expect_member_end();
            let span = parser.span_from(member_start);
            parser.check_attributes(&member_attrs, &AttrSite::new(AttrTarget::ClassConst));
            members.push(EnumMember {
                kind: EnumMemberKind::Case({
                    let mut built = EnumCase::new(parser.arena, case_name);
                    built.value = value;
                    built.attributes = member_attrs;
                    built.doc_comment = member_doc;
                    built
                }),
                span,
            });
            continue;
        }

        let mods = super::class::parse_class_member_modifiers(parser, member_start);

        if parser.check(TokenKind::Const) {
            let mut consts = parser.alloc_vec();
            super::class::parse_class_const_member(
                parser,
                &mut consts,
                member_attrs,
                member_start,
                member_doc,
                &mods,
                false,
            );
            for member in consts {
                if let ClassMemberKind::ClassConst(decl) = member.kind {
                    members.push(EnumMember {
                        kind: EnumMemberKind::ClassConst(decl),
                        span: member.span,
                    });
                }
            }
            continue;
        }

        if parser.check(TokenKind::Function) {
            let abstract_start = mods.is_abstract.then(|| parser.span_from(member_start));
            let member = super::class::parse_method_member(
                parser,
                member_attrs,
                member_start,
                member_doc,
                &mods,
                false,
                false,
            );
            if let (Some(span), ClassMemberKind::Method(method)) = (abstract_start, &member.kind) {
                abstract_methods.push((method.name.to_string(), span));
            }
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

        let is_var = mods.is_var;
        let has_modifier = !is_var
            && (mods.visibility.is_some()
                || mods.set_visibility.is_some()
                || mods.is_static
                || mods.is_abstract
                || mods.is_final
                || mods.is_readonly);
        let starts_property = match parser.current_kind() {
            TokenKind::Variable
            | TokenKind::Question
            | TokenKind::LeftParen
            | TokenKind::Backslash => true,
            _ => {
                parser.could_be_type_hint()
                    && matches!(
                        parser.peek_kind(),
                        Some(
                            TokenKind::Variable
                                | TokenKind::Pipe
                                | TokenKind::Ampersand
                                | TokenKind::Backslash
                        )
                    )
            }
        };
        // Without a modifier or `var`, PHP fails to parse the property.
        if (has_modifier || is_var) && starts_property {
            let type_hint = if parser.check(TokenKind::Variable) {
                None
            } else {
                let type_hint = parser.parse_type_hint();
                parser.reject_static_type(&type_hint, "property");
                Some(type_hint)
            };
            if parser.check(TokenKind::Variable) {
                let message = format!(
                    "Enum {} cannot include properties",
                    parser.class_scope.as_ref().map_or("", |scope| &scope.name)
                );
                parser.forbid(ForbiddenRule::EnumProperty, message, parser.current_span());
                let mut properties = parser.alloc_vec();
                super::class::parse_property_member(
                    parser,
                    &mut properties,
                    member_attrs,
                    member_start,
                    member_doc,
                    &mods,
                    type_hint,
                    false,
                );
                for member in properties {
                    if let ClassMemberKind::Property(prop) = member.kind {
                        members.push(EnumMember {
                            kind: EnumMemberKind::Property(prop),
                            span: member.span,
                        });
                    }
                }
                continue;
            }
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
    report_abstract_methods(parser, &abstract_methods);
    parser.class_scope = outer_scope;

    parser.expect_body_close(open);
    let end = parser.previous_end();
    Stmt {
        kind: StmtKind::Enum(parser.alloc({
            let mut built = EnumDecl::new(
                parser.arena,
                name,
                EnumBody {
                    members,
                    span: parser.span_from(brace_start),
                },
            );
            built.scalar_type = scalar_type;
            built.invalid_scalar_type = invalid_scalar_type;
            built.implements = implements;
            built.attributes = attributes;
            built.doc_comment = doc_comment;
            built
        })),
        span: Span::new(start, end),
        doc_comment: None,
    }
}

/// A literal backed enum case value, compared as PHP 8.1 does at compile time.
#[derive(PartialEq)]
enum CaseValue {
    Int(i64),
    String(Vec<u8>),
}

fn literal_case_value(value: &Expr<'_, '_>) -> Option<CaseValue> {
    match &value.kind {
        ExprKind::Int(n) => Some(CaseValue::Int(*n)),
        ExprKind::String(s) => Some(CaseValue::String(s.as_bytes().to_vec())),
        ExprKind::Nowdoc { value, .. } => Some(CaseValue::String(value.as_bytes().to_vec())),
        ExprKind::UnaryPrefix(u) => match (u.op, literal_case_value(u.operand)?) {
            (UnaryPrefixOp::Plus, int @ CaseValue::Int(_)) => Some(int),
            (UnaryPrefixOp::Negate, CaseValue::Int(n)) => n.checked_neg().map(CaseValue::Int),
            _ => None,
        },
        _ => None,
    }
}

/// Report a literal case value of the wrong type, or one an earlier case already has.
fn check_case_value_81(
    parser: &mut Parser<'_, '_>,
    backing: &Name<'_, '_>,
    value: &Expr<'_, '_>,
    enum_name: &str,
    case_name: &Ident<'_>,
    case_values: &mut Vec<(String, CaseValue)>,
) {
    let Some(value_type) = super::class::literal_value_type(value) else {
        return;
    };
    let backing_type = match backing {
        Name::Simple { value, .. } if value.eq_ignore_ascii_case("int") => "int",
        Name::Simple { value, .. } if value.eq_ignore_ascii_case("string") => "string",
        _ => return,
    };
    if value_type != backing_type {
        parser.forbid(
            ForbiddenRule::EnumCaseValueType,
            format!("Enum case type {value_type} does not match enum backing type {backing_type}"),
            value.span,
        );
        return;
    }
    let Some(key) = literal_case_value(value) else {
        return;
    };
    if let Some((earlier, _)) = case_values.iter().find(|(_, v)| *v == key) {
        let message =
            format!("Duplicate value in enum {enum_name} for cases {earlier} and {case_name}");
        parser.forbid(ForbiddenRule::DuplicateEnumCaseValue, message, value.span);
        return;
    }
    case_values.push((case_name.to_string(), key));
}

/// The backing type as a name, or the type itself when it is not a single name.
fn backing_type_name<'arena, 'src>(
    parser: &Parser<'arena, 'src>,
    ty: TypeHint<'arena, 'src>,
) -> Result<Name<'arena, 'src>, TypeHint<'arena, 'src>> {
    match ty.kind {
        TypeHintKind::Named(name) => Ok(name),
        TypeHintKind::Keyword(_, span) => Ok(Name::Simple {
            value: &parser.source[span.start as usize..span.end as usize],
            span,
        }),
        kind => Err(TypeHint {
            kind,
            span: ty.span,
        }),
    }
}

/// How PHP names a rejected backing type: a builtin type in lowercase, a class name resolved.
fn backing_type_display(
    parser: &Parser<'_, '_>,
    ty: &Name<'_, '_>,
    enum_name: &Ident<'_>,
) -> String {
    if let Name::Simple { value, .. } = ty {
        let lower = value.to_ascii_lowercase();
        match lower.as_str() {
            "iterable" if parser.version >= PhpVersion::Php82 => return "Traversable|array".into(),
            "float" | "bool" | "void" | "never" | "mixed" | "object" | "iterable" | "callable"
            | "array" | "null" | "false" | "true" => return lower,
            "self" if parser.version >= PhpVersion::Php85 => {
                return match parser.namespace.as_deref() {
                    Some(namespace) => format!("{namespace}\\{enum_name}"),
                    None => enum_name.to_string(),
                };
            }
            "self" | "parent" | "static" => return value.to_string(),
            _ => {}
        }
    }
    parser.resolve_class_name(ty)
}

/// Report each abstract enum method where it is declared.
fn report_abstract_methods(parser: &mut Parser<'_, '_>, methods: &[(String, Span)]) {
    let enum_name = parser
        .class_scope
        .as_ref()
        .map_or_else(String::new, |scope| scope.name.clone());
    for (name, span) in methods {
        parser.forbid(
            ForbiddenRule::AbstractEnumMethod,
            format!("Enum method {enum_name}::{name}() must not be abstract"),
            *span,
        );
    }
}
