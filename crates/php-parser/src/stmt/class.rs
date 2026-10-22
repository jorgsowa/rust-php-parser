use php_ast::fold::Fold;
use php_ast::*;
use php_lexer::TokenKind;

use crate::attributes::{AttrSite, AttrTarget, ClassKind};
use crate::diagnostics::ParseError;
use crate::expr;
use crate::instrument;
use crate::parser::{ClassScope, Parser};
use crate::version::PhpVersion;

// =============================================================================
// Class declaration
// =============================================================================

/// Check if a name is a reserved special class name (self, parent, static, readonly)
/// Rank of a visibility for the asymmetric-visibility comparison.
/// Higher rank = wider audience (public > protected > private). Set
/// visibility may not be wider than get visibility — i.e. set_rank must be
/// >= get_rank.
pub(super) fn visibility_rank(v: php_ast::Visibility) -> u8 {
    match v {
        php_ast::Visibility::Private => 0,
        php_ast::Visibility::Protected => 1,
        _ => 2,
    }
}

pub(crate) fn is_reserved_class_name(name: &str, version: PhpVersion) -> bool {
    let name = name.to_ascii_lowercase();
    // `readonly` is a keyword and `never` a type from PHP 8.1 on.
    (matches!(name.as_str(), "readonly" | "never") && version >= PhpVersion::Php81)
        || matches!(
            name.as_str(),
            // self / parent / static: meta-names that PHP rejects as
            // class identifiers in declarations and extends/implements lists.
            "self" | "parent" | "static"
            // PHP's reserved type names — invalid as class names anywhere
            // ("Cannot use 'string' as a class name as it is reserved").
            | "int" | "float" | "bool" | "string" | "true" | "false" | "null"
            | "void" | "iterable" | "object" | "mixed" | "array"
            // A keyword in PHP, lexed as a name here.
            | "callable"
        )
}

/// Report `self`, `parent` or `static` naming the class, interface or trait in `extends`,
/// `implements` or a trait `use`; `kind` is "class", "interface" or "trait".
pub(crate) fn validate_class_ref<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    name: &Name<'arena, 'src>,
    kind: &str,
) {
    let message = if let Some(text) = super::fully_qualified_class_keyword(name) {
        format!("'\\{text}' is an invalid class name")
    } else if let Name::Simple { value, .. } = name {
        // `readonly` and `array` are keyword tokens, a syntax error in PHP.
        if super::class_keyword(value).is_none()
            && !(value.eq_ignore_ascii_case("readonly") && parser.version >= PhpVersion::Php81)
            && !value.eq_ignore_ascii_case("array")
        {
            return;
        }
        format!("Cannot use \"{value}\" as {kind} name, as it is reserved")
    } else {
        return;
    };
    parser.error(ParseError::Forbidden {
        message: message.into(),
        span: name.span(),
    });
}

pub(super) fn parse_class<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    modifiers: ClassModifiers,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_class();

    let start = parser.start_span();
    parser.advance(); // consume 'class'

    let name_is_reserved_kw = parser.is_reserved_keyword_as_decl_name();
    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (Ident::new(text, span), span)
    } else {
        parser.error(ParseError::Expected {
            expected: "class name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        (parser.missing_ident(), parser.current_span())
    };

    if let Some(text) = name.as_str() {
        if is_reserved_class_name(text, parser.version) || name_is_reserved_kw {
            parser.error(ParseError::Forbidden {
                message: format!("Cannot use \"{}\" as a class name as it is reserved", text)
                    .into(),
                span: name_span,
            });
        }
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let n = parser.parse_name();
        validate_class_ref(parser, &n, "class");
        Some(n)
    } else {
        None
    };

    let implements = if parser.eat(TokenKind::Implements).is_some() {
        let names = parse_name_list(parser);
        for n in names.iter() {
            validate_class_ref(parser, n, "interface");
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
    let scope = parser.class_scope_for(name.as_str(), extends.as_ref(), false);
    let kind = ClassKind::Class {
        is_abstract: modifiers.is_abstract,
        is_readonly: modifiers.is_readonly,
    };
    parser.check_attributes(&attributes, &AttrSite::class(kind, &scope.name));
    let class_name = scope.name.clone();
    let members = parse_class_members(parser, false, false, scope);
    if !modifiers.is_abstract {
        check_abstract_methods(parser, &class_name, &members);
    }
    if modifiers.is_readonly {
        check_readonly_class_members(parser, &members);
    }
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();

    Stmt {
        kind: StmtKind::Class(parser.alloc({
            let mut built = ClassDecl::new(
                parser.arena,
                Some(name),
                ClassBody {
                    members,
                    span: Span::new(brace_start, end),
                },
            );
            built.modifiers = modifiers;
            built.extends = extends;
            built.implements = implements;
            built.attributes = attributes;
            built.doc_comment = doc_comment;
            built
        })),
        span: Span::new(start, end),
        doc_comment: None,
    }
}

pub fn parse_name_list<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> ArenaVec<'arena, Name<'arena, 'src>> {
    let mut names = parser.alloc_vec();
    names.push(parser.parse_name());
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::LeftBrace) || parser.check(TokenKind::Semicolon) {
            parser.trailing_comma_error("class name");
            break;
        }
        names.push(parser.parse_name());
    }
    names
}

/// Parse property hooks: `{ get { ... } set(Type $value) { ... } }` of the property
/// `property_name` with the declared `property_type`.
pub(super) fn parse_property_hooks<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    property_type: Option<&TypeHint<'arena, 'src>>,
    property_name: Option<&str>,
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
                    let span = parser.current_span();
                    parser.advance();
                    if is_final {
                        parser.error(ParseError::Forbidden {
                            message: "Multiple final modifiers are not allowed".into(),
                            span,
                        });
                    }
                    is_final = true;
                }
                TokenKind::Ampersand => {
                    parser.advance();
                    by_ref = true;
                    break;
                }
                TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Abstract
                | TokenKind::Static
                | TokenKind::Readonly => {
                    let start = parser.start_span();
                    let keyword = parser.current_text().to_ascii_lowercase();
                    parser.advance();
                    let is_visibility =
                        matches!(keyword.as_str(), "public" | "protected" | "private");
                    let modifier =
                        if is_visibility && parser.set_visibility_follows(parser.previous_end()) {
                            parser.advance(); // consume (
                            parser.advance(); // consume "set"
                            parser.expect(TokenKind::RightParen);
                            format!("{keyword}(set)")
                        } else {
                            keyword
                        };
                    parser.error(ParseError::Forbidden {
                        message: format!("Cannot use the {modifier} modifier on a property hook")
                            .into(),
                        span: Span::new(start, parser.previous_end()),
                    });
                }
                _ => break,
            }
        }

        // Expect "get" or "set" identifier (contextual keywords)
        let kind = if parser.check(TokenKind::Identifier) {
            match parser.current_text() {
                t if t.eq_ignore_ascii_case("get") => {
                    parser.advance();
                    PropertyHookKind::Get
                }
                t if t.eq_ignore_ascii_case("set") => {
                    parser.advance();
                    PropertyHookKind::Set
                }
                _ => {
                    // Invalid hook name - error recovery
                    let span = parser.current_span();
                    parser.error(ParseError::Expected {
                        expected: "'get' or 'set'".into(),
                        found: parser.current_kind().description().into(),
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
                found: parser.current_kind().description().into(),
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

            // Validate parameter counts against hook kind.
            // PHP rejects a parameter list on `get` regardless of contents —
            // `get()` is fatal — and requires exactly one parameter for `set`.
            match kind {
                PropertyHookKind::Get => {
                    parser.error(ParseError::Forbidden {
                        message: "get hook of property must not have a parameter list".into(),
                        span: paren_span,
                    });
                }
                PropertyHookKind::Set if p.len() != 1 => {
                    parser.error(ParseError::Forbidden {
                        message: "set hook must have exactly one parameter".into(),
                        span: paren_span,
                    });
                }
                _ => {}
            }

            p
        } else {
            parser.alloc_vec()
        };

        // Parse body: { stmts } | => expr; | ;
        let saved_loop_depth = parser.loop_depth;
        parser.loop_depth = 0;
        let saved_finally_loop_depth = parser.finally_loop_depth.take();
        let saved_has_goto_or_label = std::mem::take(&mut parser.has_goto_or_label);
        parser.function_depth += 1;
        let saved_by_ref = std::mem::replace(&mut parser.by_ref_function, by_ref);
        let saved_static_vars = std::mem::take(&mut parser.static_vars);
        let saved_has_yield = std::mem::take(&mut parser.has_yield);
        let body = if parser.check(TokenKind::LeftBrace) {
            let open_brace = parser.expect(TokenKind::LeftBrace);
            let brace_span = open_brace.map(|t| t.span).unwrap_or(parser.current_span());
            let mut stmts = parser.alloc_vec_with_capacity(8);
            while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
                let span_before = parser.current_span();
                super::push_stmt(parser, &mut stmts);
                if parser.current_span() == span_before {
                    parser.advance();
                }
            }
            if parser.has_goto_or_label {
                super::check_gotos(parser, &stmts);
            }
            parser.expect_closing(TokenKind::RightBrace, brace_span);
            let block_end = parser.previous_end();
            PropertyHookBody::Block(parser.alloc(Block {
                stmts,
                span: Span::new(brace_span.start, block_end),
            }))
        } else if parser.eat(TokenKind::FatArrow).is_some() {
            let e = expr::parse_expr(parser);
            expr::check_reference_return(parser, &e);
            parser.expect_member_end();
            PropertyHookBody::Expression(e)
        } else {
            parser.expect_member_end();
            PropertyHookBody::Abstract
        };
        parser.function_depth -= 1;
        parser.by_ref_function = saved_by_ref;
        parser.static_vars = saved_static_vars;
        let is_generator = std::mem::replace(&mut parser.has_yield, saved_has_yield);
        parser.has_goto_or_label = saved_has_goto_or_label;
        parser.finally_loop_depth = saved_finally_loop_depth;
        parser.loop_depth = saved_loop_depth;

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
            _ => {}
        }

        parser.check_attributes(&hook_attrs, &AttrSite::hook());
        let hook_span = Span::new(hook_start, parser.previous_end());
        check_hook_signature(
            parser,
            kind,
            &params,
            is_generator,
            hook_span,
            property_type,
            property_name,
        );
        let mut hook_modifiers = Modifiers::new();
        hook_modifiers.is_final = is_final;
        hooks.push({
            let mut built = PropertyHook::new(parser.arena, kind, body, hook_span);
            built.modifiers = hook_modifiers;
            built.by_ref = by_ref;
            built.params = params;
            built.attributes = hook_attrs;
            built
        });
    }

    parser.expect_closing(TokenKind::RightBrace, open_span);
    if hooks.is_empty() {
        parser.error(ParseError::Forbidden {
            message: "Property hook list must not be empty".into(),
            span: open_span,
        });
    }
    hooks
}

/// Report a by-reference `get` hook of a backed property that also has a `set` hook.
pub(super) fn check_backed_by_ref_get(
    parser: &mut Parser<'_, '_>,
    name: &str,
    hooks: &[PropertyHook<'_, '_>],
) {
    let by_ref_get = hooks
        .iter()
        .find(|h| h.kind == PropertyHookKind::Get && h.by_ref);
    let has_set = hooks.iter().any(|h| h.kind == PropertyHookKind::Set);
    let Some(get) = by_ref_get.filter(|_| has_set && !is_virtual_property(name, hooks)) else {
        return;
    };
    let class = parser.class_scope.as_ref().map_or("", |scope| &scope.name);
    let message = format!(
        "Get hook of backed property {class}::{name} with set hook may not return by reference"
    );
    parser.error(ParseError::Forbidden {
        message: message.into(),
        span: get.span,
    });
}

/// Whether no hook body accesses `$this->{name}`, which makes the property virtual (no backing store).
pub(super) fn is_virtual_property(name: &str, hooks: &[PropertyHook<'_, '_>]) -> bool {
    use php_ast::visitor::{walk_expr, walk_stmt, Visitor};
    use std::ops::ControlFlow;

    struct UsesProperty<'n> {
        name: &'n str,
    }
    // PHP folds constant names before looking for the property: `${"th" . "is"}->{("x")}`.
    fn folded_str(expr: &Expr<'_, '_>) -> Option<String> {
        match &expr.kind {
            ExprKind::String(s) => Some(s.to_string_lossy().into_owned()),
            ExprKind::Nowdoc { value, .. } => Some(value.to_string()),
            ExprKind::Heredoc { parts, .. } => {
                parts
                    .iter()
                    .try_fold(String::new(), |acc, part| match part {
                        StringPart::Literal(s) => Some(acc + &s.to_string_lossy()),
                        _ => None,
                    })
            }
            ExprKind::Parenthesized(inner) => folded_str(inner),
            ExprKind::Binary(b) if b.op == BinaryOp::Concat => {
                Some(folded_str(b.left)? + &folded_str(b.right)?)
            }
            _ => None,
        }
    }
    fn is_this(expr: &Expr<'_, '_>) -> bool {
        match &expr.kind {
            ExprKind::Variable(name) => name.as_str() == "this",
            ExprKind::Parenthesized(inner) => is_this(inner),
            ExprKind::VariableVariable(inner) => folded_str(inner).is_some_and(|s| s == "this"),
            _ => false,
        }
    }
    fn is_name(expr: &Expr<'_, '_>, name: &str) -> bool {
        match &expr.kind {
            ExprKind::Identifier(p) => p.as_str() == name,
            _ => folded_str(expr).is_some_and(|s| s == name),
        }
    }
    impl<'a, 's> Visitor<'a, 's> for UsesProperty<'_> {
        type Break = ();
        fn visit_stmt(&mut self, stmt: &Stmt<'a, 's>) -> ControlFlow<()> {
            match stmt.kind {
                StmtKind::Function(_)
                | StmtKind::Class(_)
                | StmtKind::Interface(_)
                | StmtKind::Trait(_)
                | StmtKind::Enum(_) => ControlFlow::Continue(()),
                _ => walk_stmt(self, stmt),
            }
        }

        fn visit_expr(&mut self, expr: &Expr<'a, 's>) -> ControlFlow<()> {
            match &expr.kind {
                // `$this` in a nested function or class is not the hooked object.
                ExprKind::Closure(_) | ExprKind::ArrowFunction(_) | ExprKind::AnonymousClass(_) => {
                    ControlFlow::Continue(())
                }
                ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access)
                    if is_this(access.object) && is_name(access.property, self.name) =>
                {
                    ControlFlow::Break(())
                }
                _ => walk_expr(self, expr),
            }
        }
    }

    let mut visitor = UsesProperty { name };
    !hooks.iter().any(|hook| match &hook.body {
        PropertyHookBody::Block(block) => block
            .stmts
            .iter()
            .any(|stmt| visitor.visit_stmt(stmt).is_break()),
        // `set => expr` assigns the result to the backing property.
        PropertyHookBody::Expression(_) if hook.kind == PropertyHookKind::Set => true,
        PropertyHookBody::Expression(expr) => visitor.visit_expr(expr).is_break(),
        _ => false,
    })
}

/// Report asymmetric visibility on a virtual property that lacks a `get` or `set` hook.
pub(super) fn check_virtual_set_visibility(
    parser: &mut Parser<'_, '_>,
    name: &str,
    hooks: &[PropertyHook<'_, '_>],
    span: Span,
) {
    let has = |kind| hooks.iter().any(|hook| hook.kind == kind);
    let access = if !has(PropertyHookKind::Get) {
        "Write-only"
    } else if !has(PropertyHookKind::Set) {
        "Read-only"
    } else {
        return;
    };
    let class = parser.class_member_prefix();
    parser.error(ParseError::Forbidden {
        message: format!(
            "{access} virtual property {class}${name} must not specify asymmetric visibility"
        )
        .into(),
        span,
    });
}

/// A member of a type, as compared between a set hook parameter and its property.
#[derive(Clone, Copy, PartialEq)]
enum HookTypeMember {
    /// A class type; only a single named class may be a `Closure`, which `callable` accepts.
    Class {
        named: bool,
    },
    Builtin(BuiltinType),
}

/// The members of a type for comparing a set hook parameter with its property: a union's
/// members, with `?T` as `T|null` and `iterable` as `Traversable|array`.
fn hook_type_members(ty: &TypeHint<'_, '_>) -> Vec<HookTypeMember> {
    let types = match &ty.kind {
        TypeHintKind::Nullable(inner) => {
            let mut members = hook_type_members(inner);
            members.push(HookTypeMember::Builtin(BuiltinType::Null));
            return members;
        }
        TypeHintKind::Union(types) => &types[..],
        _ => std::slice::from_ref(ty),
    };
    let mut members = Vec::new();
    for ty in types {
        match &ty.kind {
            TypeHintKind::Named(_) => members.push(HookTypeMember::Class { named: true }),
            TypeHintKind::Keyword(BuiltinType::Iterable, _) => {
                members.push(HookTypeMember::Class { named: false });
                members.push(HookTypeMember::Builtin(BuiltinType::Array));
            }
            TypeHintKind::Keyword(
                BuiltinType::Self_ | BuiltinType::Parent_ | BuiltinType::Static,
                _,
            )
            | TypeHintKind::Intersection(_) => members.push(HookTypeMember::Class { named: false }),
            TypeHintKind::Keyword(builtin, _) => members.push(HookTypeMember::Builtin(*builtin)),
            _ => members.extend(hook_type_members(ty)),
        }
    }
    members
}

/// Whether PHP can tell at compile time that `param` accepts every value of `property`. Class
/// types are assumed to be related, as PHP only checks them at inheritance.
fn hook_param_accepts(
    property: Option<&TypeHint<'_, '_>>,
    param: Option<&TypeHint<'_, '_>>,
    version: PhpVersion,
) -> bool {
    use HookTypeMember::{Builtin, Class};
    let (property, param) = match (property, param) {
        (None, None) => return true,
        (Some(property), Some(param)) => (property, param),
        _ => return false,
    };
    let accepted = hook_type_members(param);
    if accepted.contains(&Builtin(BuiltinType::Mixed)) {
        return true;
    }
    hook_type_members(property).iter().all(|p| {
        accepted.iter().any(|q| match (*p, *q) {
            (Class { .. }, Class { .. } | Builtin(BuiltinType::Object)) => true,
            (Class { named: true }, Builtin(BuiltinType::Callable)) => version >= PhpVersion::Php85,
            (Builtin(p), Builtin(q)) => {
                p == q
                    || q == BuiltinType::Bool && matches!(p, BuiltinType::True | BuiltinType::False)
            }
            _ => false,
        })
    })
}

/// Report a `set` hook parameter that is by-reference, variadic or of a type that does not
/// accept the property's values, and a generator hook.
fn check_hook_signature(
    parser: &mut Parser<'_, '_>,
    kind: PropertyHookKind,
    params: &[Param<'_, '_>],
    is_generator: bool,
    hook_span: Span,
    property_type: Option<&TypeHint<'_, '_>>,
    property_name: Option<&str>,
) {
    let class_name = parser.class_scope.as_ref().map_or("", |scope| &scope.name);
    let property = format!("{class_name}::${}", property_name.unwrap_or(""));
    let mut messages = Vec::new();
    if let (PropertyHookKind::Set, Some(param)) = (kind, params.first()) {
        let name = param.name.as_str().unwrap_or("");
        if param.by_ref {
            messages.push((
                format!("Parameter ${name} of set hook {property} must not be pass-by-reference"),
                param.span,
            ));
        }
        if param.variadic {
            messages.push((
                format!("Parameter ${name} of set hook {property} must not be variadic"),
                param.span,
            ));
        }
        if !hook_param_accepts(property_type, param.type_hint.as_ref(), parser.version) {
            messages.push((
                format!("Type of parameter ${name} of hook {property}::set must be compatible with property type"),
                param.span,
            ));
        }
    }
    for (message, span) in messages {
        parser.error(ParseError::Forbidden {
            message: message.into(),
            span,
        });
    }
    if is_generator {
        match (kind, property_type) {
            (PropertyHookKind::Get, Some(ty)) => super::check_generator_return_type(parser, ty),
            (PropertyHookKind::Set, _) => parser.error(ParseError::Forbidden {
                message: "Generator return type must be a supertype of Generator, void given"
                    .into(),
                span: hook_span,
            }),
            _ => {}
        }
    }
}

/// Report hook bodies that don't match whether the property is abstract; every hook of an
/// interface property is abstract.
pub(super) fn check_hook_bodies(
    parser: &mut Parser<'_, '_>,
    hooks: &[PropertyHook<'_, '_>],
    abstract_property: bool,
    in_interface: bool,
    is_private: bool,
) {
    for hook in hooks {
        let has_body = !matches!(hook.body, PropertyHookBody::Abstract);
        let message = if !has_body && !abstract_property {
            "Non-abstract property hook must have a body"
        } else if has_body && in_interface {
            "Abstract property hook cannot have body"
        } else if has_body {
            continue;
        } else if hook.modifiers.is_final {
            "Property hook cannot be both abstract and final"
        } else if is_private && !in_interface {
            "Property hook cannot be both abstract and private"
        } else {
            continue;
        };
        parser.error(ParseError::Forbidden {
            message: message.into(),
            span: hook.span,
        });
    }
}

/// Report abstract methods in a class that is not declared abstract.
fn check_abstract_methods(
    parser: &mut Parser<'_, '_>,
    class_name: &str,
    members: &[ClassMember<'_, '_>],
) {
    let abstract_methods: Vec<(&str, Span)> = members
        .iter()
        .filter_map(|m| match &m.kind {
            ClassMemberKind::Method(decl) if decl.modifiers.is_abstract => {
                Some((decl.name.as_str()?, m.span))
            }
            _ => None,
        })
        .collect();
    let Some(&(first, span)) = abstract_methods.first() else {
        check_abstract_hooks(parser, class_name, members);
        return;
    };
    let message = if parser.version >= PhpVersion::Php85 {
        format!("Class {class_name} declares abstract method {first}() and must therefore be declared abstract")
    } else {
        let count = abstract_methods.len();
        let names: Vec<String> = abstract_methods
            .iter()
            .take(3)
            .map(|(name, _)| format!("{class_name}::{name}"))
            .collect();
        format!(
            "Class {class_name} contains {count} abstract method{} and must therefore be declared abstract or implement the remaining methods ({}{})",
            if count == 1 { "" } else { "s" },
            names.join(", "),
            if count > 3 { ", ..." } else { "" }
        )
    };
    parser.error(ParseError::Forbidden {
        message: message.into(),
        span,
    });
}

/// Report abstract property hooks in a class that is not declared abstract.
pub(crate) fn check_abstract_hooks(
    parser: &mut Parser<'_, '_>,
    class_name: &str,
    members: &[ClassMember<'_, '_>],
) {
    let mut abstract_hooks: Vec<(&str, &str)> = Vec::new();
    let mut span = None;
    for member in members {
        let ClassMemberKind::Property(prop) = &member.kind else {
            continue;
        };
        if !prop.modifiers.is_abstract {
            continue;
        }
        for hook in prop.hooks.iter() {
            if matches!(hook.body, PropertyHookBody::Abstract) {
                span.get_or_insert(member.span);
                let kind = match hook.kind {
                    PropertyHookKind::Get => "get",
                    _ => "set",
                };
                abstract_hooks.push((prop.name.as_str().unwrap_or_default(), kind));
            }
        }
    }
    let Some(span) = span else { return };
    let count = abstract_hooks.len();
    let names: Vec<String> = abstract_hooks
        .iter()
        .take(3)
        .map(|(name, kind)| format!("{class_name}::${name}::{kind}"))
        .collect();
    parser.error(ParseError::Forbidden {
        message: format!(
            "Class {class_name} contains {count} abstract method{} and must therefore be declared abstract or implement the remaining method{} ({}{})",
            if count == 1 { "" } else { "s" },
            if count == 1 { "" } else { "s" },
            names.join(", "),
            if count > 3 { ", ..." } else { "" }
        )
        .into(),
        span,
    });
}

pub fn parse_class_members<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    in_interface: bool,
    in_trait: bool,
    scope: ClassScope,
) -> ArenaVec<'arena, ClassMember<'arena, 'src>> {
    let outer_scope = parser.class_scope.replace(scope);
    // March 2026: reduce from 16 to 4 for class members
    // Most classes have 3-10 members; larger classes grow efficiently
    let mut members = parser.alloc_vec_with_capacity(4);
    // Track method names (case-insensitive) to detect redeclarations.
    // PHP rejects with "Cannot redeclare A::f()".
    let mut seen_methods: std::collections::HashSet<String> = std::collections::HashSet::new();
    // Track property names (case-sensitive) for "Cannot redeclare A::$prop".
    let mut seen_properties: std::collections::HashSet<String> = std::collections::HashSet::new();
    while !parser.check(TokenKind::RightBrace) && !parser.check(TokenKind::Eof) {
        if parser.check(TokenKind::Semicolon) {
            parser.error_expected("class member");
            parser.advance();
            continue;
        }

        let member_start = parser.start_span();
        let member_attrs = parser.parse_attributes();

        if parser.check(TokenKind::Use) {
            if !member_attrs.is_empty() {
                parser.error_expected("'function' or 'const'");
            }
            let member = parse_trait_use_member(parser, member_start);
            if let (true, ClassMemberKind::TraitUse(decl)) = (in_interface, &member.kind) {
                if let Some(first) = decl.traits.first() {
                    let message = format!(
                        "Cannot use traits inside of interfaces. {} is used in {}",
                        parser.resolve_class_name(first),
                        parser.class_scope.as_ref().map_or("", |scope| &scope.name)
                    );
                    parser.error(ParseError::Forbidden {
                        message: message.into(),
                        span: member.span,
                    });
                }
            }
            members.push(member);
            continue;
        }

        let mods = parse_class_member_modifiers(parser, member_start);

        // Detect unknown modifier: bare identifier before $variable with no modifiers set.
        if mods.visibility.is_none()
            && mods.set_visibility.is_none()
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
                found: parser.current_kind().description().into(),
                span,
            });
        }

        if parser.check(TokenKind::Const) {
            if in_trait {
                // Constants in traits were introduced in PHP 8.2.
                parser.require_version(
                    PhpVersion::Php82,
                    "constants in traits",
                    parser.current_span(),
                );
            }
            parse_class_const_member(
                parser,
                &mut members,
                member_attrs,
                member_start,
                &mods,
                in_interface,
            );
            continue;
        }

        if parser.check(TokenKind::Function) {
            let member = parse_method_member(
                parser,
                member_attrs,
                member_start,
                &mods,
                in_interface,
                in_trait,
            );
            if let ClassMemberKind::Method(decl) = &member.kind {
                report_redeclared_method(parser, &mut seen_methods, decl, member.span);
                let is_constructor = decl
                    .name
                    .as_str()
                    .is_some_and(|n| n.eq_ignore_ascii_case("__construct"));
                // Promoted properties in a bodiless constructor are already rejected.
                if is_constructor && decl.body.is_some() {
                    // Repeated parameters are reported as parameter redefinitions instead.
                    let mut params_seen = std::collections::HashSet::new();
                    for param in decl.params.iter().filter(|p| is_promoted_param(p)) {
                        let Some(name) = param.name.as_str() else {
                            continue;
                        };
                        if params_seen.insert(name) && !seen_properties.insert(name.to_string()) {
                            parser.error(ParseError::Forbidden {
                                message: format!(
                                    "Cannot redeclare {}${name}",
                                    parser.class_member_prefix()
                                )
                                .into(),
                                span: param.span,
                            });
                        }
                    }
                }
            }
            members.push(member);
            continue;
        }

        let unknown_modifier =
            parser.check(TokenKind::Identifier) && parser.peek_kind() == Some(TokenKind::Variable);
        let starts_property = match parser.current_kind() {
            TokenKind::Variable | TokenKind::Question | TokenKind::LeftParen => true,
            _ => {
                parser.could_be_type_hint()
                    && matches!(
                        parser.peek_kind(),
                        Some(TokenKind::Pipe | TokenKind::Ampersand | TokenKind::Backslash)
                    )
            }
        };
        if mods.is_empty() && !unknown_modifier && starts_property {
            // A property needs a modifier or `var`.
            parser.error_expected("'function' or 'const'");
        }

        let type_hint = if parser.could_be_type_hint() && !parser.check(TokenKind::Variable) {
            let type_hint = parser.parse_type_hint();
            parser.reject_static_type(&type_hint, "property");
            if parser.check(TokenKind::Variable) {
                let name = parser.current_text();
                parser.reject_member_type(&type_hint, "Property", name);
            }
            Some(type_hint)
        } else {
            None
        };

        if parser.check(TokenKind::Variable) {
            let before = members.len();
            parse_property_member(
                parser,
                &mut members,
                member_attrs,
                member_start,
                &mods,
                type_hint,
                in_interface,
            );
            // Comma-separated declarations may add multiple property members
            // (`public int $a, $b`); check each one.
            for m in members.iter().skip(before) {
                if let ClassMemberKind::Property(decl) = &m.kind {
                    if let Some(name) = decl.name.as_str() {
                        if !seen_properties.insert(name.to_string()) {
                            parser.error(ParseError::Forbidden {
                                message: format!(
                                    "Cannot redeclare {}${name}",
                                    parser.class_member_prefix()
                                )
                                .into(),
                                span: m.span,
                            });
                        }
                    }
                }
            }
            continue;
        }

        parser.error(ParseError::Expected {
            expected: "class member".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.synchronize_class_body();
    }
    let names = members.iter().filter_map(|m| match &m.kind {
        ClassMemberKind::ClassConst(c) => Some(&c.name),
        _ => None,
    });
    report_redefined_constants(parser, names);
    parser.class_scope = outer_scope;
    members
}

fn report_readonly_default(parser: &mut Parser<'_, '_>, span: Span) {
    // PHP 8.6 allows a default value on a readonly property.
    if parser.version >= PhpVersion::Php86 {
        return;
    }
    parser.error(ParseError::Forbidden {
        message: "Readonly property cannot have default value".into(),
        span,
    });
}

/// Report a property of a `readonly` class, declared or promoted, that breaks a readonly
/// property rule; every property of such a class is readonly.
pub fn check_readonly_class_members(parser: &mut Parser<'_, '_>, members: &[ClassMember<'_, '_>]) {
    for member in members {
        match &member.kind {
            // An explicitly readonly property was already checked where it was declared.
            ClassMemberKind::Property(p) if !p.modifiers.is_readonly => {
                if p.modifiers.is_static {
                    parser.error(ParseError::Forbidden {
                        message: "static properties cannot be readonly".into(),
                        span: member.span,
                    });
                }
                if p.type_hint.is_none() {
                    parser.error(ParseError::Forbidden {
                        message: "readonly property must have type".into(),
                        span: member.span,
                    });
                }
                if let Some(hook) = p.hooks.first() {
                    parser.error(ParseError::Forbidden {
                        message: "A readonly property cannot declare hooks".into(),
                        span: hook.span,
                    });
                }
                if let Some(default) = &p.default {
                    report_readonly_default(parser, default.span);
                }
            }
            ClassMemberKind::Method(m)
                if m.name
                    .as_str()
                    .is_some_and(|n| n.eq_ignore_ascii_case("__construct")) =>
            {
                for param in m.params.iter() {
                    if !is_promoted_param(param) || param.modifiers.is_readonly {
                        continue;
                    }
                    if param.type_hint.is_none() {
                        parser.error(ParseError::Forbidden {
                            message: "readonly property must have type".into(),
                            span: param.span,
                        });
                    }
                    if let Some(hook) = param.hooks.first() {
                        parser.error(ParseError::Forbidden {
                            message: "A readonly property cannot declare hooks".into(),
                            span: hook.span,
                        });
                    }
                }
            }
            _ => {}
        }
    }
}

/// Report a method named like an earlier one of the same class; method names are
/// case-insensitive.
pub(super) fn report_redeclared_method(
    parser: &mut Parser<'_, '_>,
    seen_methods: &mut std::collections::HashSet<String>,
    decl: &MethodDecl<'_, '_>,
    span: Span,
) {
    if let Some(name) = decl.name.as_str() {
        if !seen_methods.insert(name.to_ascii_lowercase()) {
            parser.error(ParseError::Forbidden {
                message: format!("Cannot redeclare {}{name}()", parser.class_member_prefix())
                    .into(),
                span,
            });
        }
    }
}

fn is_promoted_param(param: &Param<'_, '_>) -> bool {
    param.modifiers.visibility.is_some()
        || param.modifiers.set_visibility.is_some()
        || param.modifiers.is_readonly
        || param.modifiers.is_final
        || !param.hooks.is_empty()
}

/// Report a class constant or enum case named like an earlier one; constant names are
/// case-sensitive.
pub(super) fn report_redefined_constants<'a, 'src: 'a>(
    parser: &mut Parser<'_, 'src>,
    names: impl Iterator<Item = &'a Ident<'src>>,
) {
    let mut seen = std::collections::HashSet::new();
    for name in names {
        let Some(text) = name.as_str() else { continue };
        if !seen.insert(text) {
            let message = match &parser.class_scope {
                Some(scope) => format!("Cannot redefine class constant {}::{text}", scope.name),
                None => format!("Cannot redefine class constant {text}"),
            };
            parser.error(ParseError::Forbidden {
                message: message.into(),
                span: name.span,
            });
        }
    }
}

/// Parse a `use Trait1, Trait2 { ... }` trait-use declaration, shared by class/interface/trait
/// bodies (via [`parse_trait_use_member`]) and enum bodies (`enum_decl.rs`).
pub(super) fn parse_trait_use_decl<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_start: u32,
) -> TraitUseDecl<'arena, 'src> {
    parser.advance(); // consume `use`
    let mut traits = parser.alloc_vec_with_capacity(2);
    traits.push(parser.parse_name());
    while parser.eat(TokenKind::Comma).is_some() {
        if parser.check(TokenKind::Semicolon) || parser.check(TokenKind::LeftBrace) {
            parser.trailing_comma_error("trait name");
            break;
        }
        traits.push(parser.parse_name());
    }
    for name in traits.iter() {
        validate_class_ref(parser, name, "trait");
    }
    // Capture the docblock before parsing adaptations: entering/leaving the
    // adaptations block's own `{ }` scope advances `last_scope_close` past the
    // comment, which would otherwise make it unreachable afterward.
    let doc_comment = parser.take_doc_comment(member_start);
    let (adaptations, adaptations_brace_span) = if parser.check(TokenKind::LeftBrace) {
        let brace = parser.advance().span;
        let adaptations = super::trait_use::parse_trait_adaptations(parser);
        (adaptations, Some(brace))
    } else {
        parser.expect_member_end();
        (parser.alloc_vec(), None)
    };
    {
        let mut built = TraitUseDecl::new(parser.arena, traits);
        built.adaptations = adaptations;
        built.adaptations_brace_span = adaptations_brace_span;
        built.doc_comment = doc_comment;
        built
    }
}

fn parse_trait_use_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_start: u32,
) -> ClassMember<'arena, 'src> {
    let decl = parse_trait_use_decl(parser, member_start);
    let span = Span::new(member_start, parser.previous_end());
    ClassMember {
        kind: ClassMemberKind::TraitUse(decl),
        span,
    }
}

fn parse_class_member_modifiers<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_start: u32,
) -> Modifiers {
    let mut visibility = None;
    let mut set_visibility = None;
    let mut asym_vis_span: Option<Span> = None;
    let mut is_static = false;
    let mut is_abstract = false;
    let mut is_final = false;
    let mut is_readonly = false;

    // Handle `var` keyword (PHP4 style, equivalent to public)
    if parser.check(TokenKind::Identifier) && parser.current_text().eq_ignore_ascii_case("var") {
        parser.advance();
        visibility = Some(Visibility::Public);
        // `var` takes no other modifier.
        if matches!(
            parser.current_kind(),
            TokenKind::Public
                | TokenKind::Protected
                | TokenKind::Private
                | TokenKind::Static
                | TokenKind::Abstract
                | TokenKind::Final
                | TokenKind::Readonly
        ) {
            parser.error_expected("variable");
        }
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
                    if parser.set_visibility_follows(parser.previous_end()) {
                        // Single-keyword asymmetric visibility: e.g. private(set)
                        // Get visibility is implicitly public (visibility stays None).
                        if set_visibility.is_some() {
                            parser.error(ParseError::Forbidden {
                                message: "cannot use multiple set-visibility modifiers".into(),
                                span: Span::new(member_start, parser.previous_end()),
                            });
                        }
                        asym_vis_span = Some(Span::new(member_start, parser.previous_end()));
                        parser.advance(); // consume (
                        parser.advance(); // consume "set"
                        parser.expect(TokenKind::RightParen);
                        set_visibility = Some(vis);
                    } else {
                        visibility = Some(vis);
                        // Look ahead for two-keyword form: e.g. public private(set)
                        if matches!(
                            parser.current_kind(),
                            TokenKind::Public | TokenKind::Protected | TokenKind::Private
                        ) && parser.set_visibility_follows(parser.current_span().end)
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
                            parser.advance(); // consume "set"
                            parser.expect(TokenKind::RightParen);
                            set_visibility = Some(set_vis);
                        }
                    }
                } else if parser.set_visibility_follows(parser.previous_end()) {
                    // Two-keyword form where get-visibility was set in a prior iteration:
                    // e.g. the second modifier in `public private(set)` when the first
                    // iteration didn't consume it via the two-keyword lookahead.
                    if set_visibility.is_some() {
                        parser.error(ParseError::Forbidden {
                            message: "cannot use multiple set-visibility modifiers".into(),
                            span: Span::new(member_start, parser.previous_end()),
                        });
                    }
                    // Save span for deferred version check after is_static is known.
                    asym_vis_span = Some(Span::new(member_start, parser.previous_end()));
                    parser.advance(); // consume (
                    parser.advance(); // consume "set"
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
    // `var` is a keyword in PHP, so it cannot follow other modifiers as a type name.
    if parser.previous_end() > member_start
        && parser.check(TokenKind::Identifier)
        && parser.current_text().eq_ignore_ascii_case("var")
    {
        parser.error_expected("variable");
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

    let mut modifiers = Modifiers::new();
    modifiers.visibility = visibility;
    modifiers.set_visibility = set_visibility;
    modifiers.is_static = is_static;
    modifiers.is_abstract = is_abstract;
    modifiers.is_final = is_final;
    modifiers.is_readonly = is_readonly;
    modifiers
}

fn const_modifiers(mods: &Modifiers) -> Modifiers {
    const_modifiers_of(mods.visibility, mods.is_final)
}

pub(super) fn const_modifiers_of(visibility: Option<Visibility>, is_final: bool) -> Modifiers {
    let mut modifiers = Modifiers::new();
    modifiers.visibility = visibility;
    modifiers.is_final = is_final;
    modifiers
}

/// PHP's type name for a literal constant value; `None` for anything it evaluates later.
fn literal_value_type(value: &Expr<'_, '_>) -> Option<&'static str> {
    match &value.kind {
        ExprKind::Int(_) => Some("int"),
        ExprKind::Float(_) => Some("float"),
        ExprKind::String(_) | ExprKind::Nowdoc { .. } => Some("string"),
        ExprKind::Bool(_) => Some("bool"),
        ExprKind::Null => Some("null"),
        ExprKind::UnaryPrefix(u) if matches!(u.op, UnaryPrefixOp::Negate | UnaryPrefixOp::Plus) => {
            literal_value_type(u.operand).filter(|t| matches!(*t, "int" | "float"))
        }
        _ => None,
    }
}

fn type_accepts_literal(ty: &TypeHint<'_, '_>, value: &Expr<'_, '_>, value_type: &str) -> bool {
    match &ty.kind {
        TypeHintKind::Nullable(inner) => {
            value_type == "null" || type_accepts_literal(inner, value, value_type)
        }
        TypeHintKind::Union(types) => types
            .iter()
            .any(|t| type_accepts_literal(t, value, value_type)),
        TypeHintKind::Keyword(builtin, _) => match builtin {
            BuiltinType::Mixed => true,
            BuiltinType::Int => value_type == "int",
            BuiltinType::Float => matches!(value_type, "int" | "float"),
            BuiltinType::String => value_type == "string",
            BuiltinType::Bool => value_type == "bool",
            BuiltinType::True => matches!(value.kind, ExprKind::Bool(true)),
            BuiltinType::False => matches!(value.kind, ExprKind::Bool(false)),
            BuiltinType::Null => value_type == "null",
            _ => false,
        },
        _ => false,
    }
}

/// Report a literal value that a typed class constant's type does not accept.
fn check_typed_const_value(
    parser: &mut Parser<'_, '_>,
    ty: &TypeHint<'_, '_>,
    name: &str,
    value: &Expr<'_, '_>,
) {
    let Some(value_type) = literal_value_type(value) else {
        return;
    };
    // These types are reported on their own; a class constant cannot have them.
    if matches!(
        ty.kind,
        TypeHintKind::Keyword(
            BuiltinType::Void | BuiltinType::Never | BuiltinType::Callable,
            _
        )
    ) {
        return;
    }
    if type_accepts_literal(ty, value, value_type) {
        return;
    }
    let class_name = parser.class_scope.as_ref().map_or("", |scope| &scope.name);
    let message = format!(
        "Cannot use {value_type} as value for class constant {class_name}::{name} of type {}",
        parser.type_display(ty)
    );
    parser.error(ParseError::Forbidden {
        message: message.into(),
        span: value.span,
    });
}

fn parse_class_const_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    members: &mut ArenaVec<'arena, ClassMember<'arena, 'src>>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &Modifiers,
    in_interface: bool,
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
    if mods.is_final {
        let span = Span::new(member_start, parser.previous_end());
        parser.require_version(PhpVersion::Php81, "final class constants", span);
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
        let const_name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
            Ident::new(text, span)
        } else {
            let span = parser.current_span();
            parser.error(ParseError::Expected {
                expected: "constant name".into(),
                found: parser.current_kind().description().into(),
                span,
            });
            parser.missing_ident()
        };
        if const_name
            .as_str()
            .is_some_and(|name| name.eq_ignore_ascii_case("class"))
        {
            parser.error(ParseError::Forbidden {
                message: "A class constant must not be called 'class'; it is reserved for class name fetching".into(),
                span: const_name.span,
            });
        }
        if let (Some(ty), Some(name), true) =
            (&const_type, const_name.as_str(), const_items.is_empty())
        {
            parser.reject_member_type(ty, "Class constant", name);
        }
        parser.expect(TokenKind::Equals);
        let value = expr::parse_expr(parser);
        expr::check_const_expr(parser, &value, false);
        if let (Some(ty), Some(name)) = (&const_type, const_name.as_str()) {
            check_typed_const_value(parser, ty, name, &value);
        }
        const_items.push((const_name, value));
        if parser.eat(TokenKind::Comma).is_none() {
            break;
        }
        if parser.check(TokenKind::Semicolon) {
            parser.trailing_comma_error("constant name");
            break;
        }
    }
    parser.expect_member_end();
    let span = Span::new(member_start, parser.previous_end());
    if let (true, Some(Visibility::Private), Some((name, _))) =
        (mods.is_final, mods.visibility, const_items.first())
    {
        let class = parser.class_member_prefix();
        parser.error(ParseError::Forbidden {
            message: format!(
                "Private constant {class}{name} cannot be final as it is not visible to other classes"
            )
            .into(),
            span,
        });
    }
    if let (true, Some(Visibility::Protected | Visibility::Private), Some((name, _))) =
        (in_interface, mods.visibility, const_items.first())
    {
        let class = parser.class_member_prefix();
        parser.error(ParseError::Forbidden {
            message: format!("Access type for interface constant {class}{name} must be public")
                .into(),
            span,
        });
    }
    // Allocate the type hint into the arena so all items can share a reference
    let shared_type_hint: Option<&'arena _> = const_type.map(|th| parser.alloc(th));
    parser.check_attributes(&member_attrs, &AttrSite::new(AttrTarget::ClassConst));
    let mut const_iter = const_items.into_iter();
    if let Some((first_name, first_value)) = const_iter.next() {
        members.push(ClassMember {
            kind: ClassMemberKind::ClassConst({
                let mut built = ClassConstDecl::new(parser.arena, first_name, first_value);
                built.modifiers = const_modifiers(mods);
                built.type_hint = shared_type_hint;
                built.attributes = member_attrs;
                built.doc_comment = parser.take_doc_comment(member_start);
                built
            }),
            span,
        });
        for (rest_name, rest_value) in const_iter {
            let ClassMemberKind::ClassConst(first) = &members[members.len() - 1].kind else {
                unreachable!()
            };
            let attributes = copy_attributes(parser, &first.attributes);
            members.push(ClassMember {
                kind: ClassMemberKind::ClassConst({
                    let mut built = ClassConstDecl::new(parser.arena, rest_name, rest_value);
                    built.modifiers = const_modifiers(mods);
                    built.type_hint = shared_type_hint;
                    built.attributes = attributes;
                    built.doc_comment = None;
                    built
                }),
                span,
            });
        }
    }
}

pub(super) fn parse_method_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &Modifiers,
    in_interface: bool,
    in_trait: bool,
) -> ClassMember<'arena, 'src> {
    parser.advance(); // consume `function`
    let by_ref = parser.eat(TokenKind::Ampersand).is_some();
    let method_name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        Ident::new(text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "method name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.missing_ident()
    };

    parser.expect(TokenKind::LeftParen);
    let was_in_constructor = parser.in_constructor;
    let is_constructor = method_name
        .as_str()
        .is_some_and(|n| n.eq_ignore_ascii_case("__construct"));
    parser.in_constructor = is_constructor;
    let params = super::parse_param_list(parser);
    parser.in_constructor = was_in_constructor;
    if is_constructor && (mods.is_abstract || in_interface) {
        for param in params.iter().filter(|p| is_promoted_param(p)) {
            parser.error(ParseError::Forbidden {
                message: "Cannot declare promoted property in an abstract constructor".into(),
                span: param.span,
            });
        }
    }
    if is_constructor {
        for param in params.iter().filter(|p| p.variadic && is_promoted_param(p)) {
            parser.error(ParseError::Forbidden {
                message: "Cannot declare variadic promoted property".into(),
                span: param.span,
            });
        }
    }
    parser.expect(TokenKind::RightParen);

    let return_type = if parser.eat(TokenKind::Colon).is_some() {
        Some(parser.parse_type_hint())
    } else {
        None
    };

    let doc_comment = parser.take_doc_comment(member_start);

    let mut terminated_without_body = false;
    let mut is_generator = false;
    let body = if parser.check(TokenKind::LeftBrace) {
        let brace_start = parser.start_span();
        parser.expect(TokenKind::LeftBrace);
        let mut stmts = parser.alloc_vec_with_capacity(16);
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
            super::push_stmt(parser, &mut stmts);
            if parser.current_span() == span_before {
                parser.advance();
            }
        }
        parser.function_depth -= 1;
        parser.by_ref_function = saved_by_ref;
        parser.static_vars = saved_static_vars;
        is_generator = std::mem::replace(&mut parser.has_yield, saved_has_yield);
        if parser.has_goto_or_label {
            super::check_gotos(parser, &stmts);
        }
        parser.has_goto_or_label = saved_has_goto_or_label;
        parser.finally_loop_depth = saved_finally_loop_depth;
        parser.loop_depth = saved_loop_depth;
        parser.expect(TokenKind::RightBrace);
        let block_end = parser.previous_end();
        Some(parser.alloc(Block {
            stmts,
            span: Span::new(brace_start, block_end),
        }))
    } else {
        terminated_without_body = parser.expect_member_end().is_some();
        None
    };

    let member_span = Span::new(member_start, parser.previous_end());
    let method_label = format!("{}{}()", parser.class_member_prefix(), method_name);
    if in_interface {
        if matches!(
            mods.visibility,
            Some(Visibility::Protected | Visibility::Private)
        ) {
            parser.error(ParseError::Forbidden {
                message: format!("Access type for interface method {method_label} must be public")
                    .into(),
                span: member_span,
            });
        }
        // `abstract final` is already reported by the modifier parser.
        if mods.is_final && !mods.is_abstract {
            parser.error(ParseError::Forbidden {
                message: format!("Interface method {method_label} must not be final").into(),
                span: member_span,
            });
        }
        if mods.is_abstract {
            parser.error(ParseError::Forbidden {
                message: format!("Interface method {method_label} must not be abstract").into(),
                span: member_span,
            });
        } else if body.is_some() {
            parser.error(ParseError::Forbidden {
                message: format!("Interface function {method_label} cannot contain body").into(),
                span: member_span,
            });
        }
    } else if !mods.is_abstract && terminated_without_body {
        parser.error(ParseError::Forbidden {
            message: format!("Non-abstract method {method_label} must contain body").into(),
            span: member_span,
        });
    } else if mods.is_abstract {
        if parser.class_scope.as_ref().is_some_and(|s| s.is_anonymous) {
            parser.error(ParseError::Forbidden {
                message: format!("Anonymous class method {method_name}() must not be abstract")
                    .into(),
                span: member_span,
            });
        }
        // Traits may declare abstract private methods.
        if mods.visibility == Some(Visibility::Private) && !in_trait {
            parser.error(ParseError::Forbidden {
                message: format!("Abstract function {method_label} cannot be declared private")
                    .into(),
                span: member_span,
            });
        }
        if body.is_some() {
            parser.error(ParseError::Forbidden {
                message: format!("Abstract function {method_label} cannot contain body").into(),
                span: member_span,
            });
        }
    }
    if mods.is_readonly {
        parser.error(ParseError::Forbidden {
            message: "Cannot use the readonly modifier on a method".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }

    if let (Some(rt), Some(b)) = (&return_type, body) {
        super::check_returns_against_type(parser, b, rt, is_generator, true);
    }

    if let Some(signature) = method_name
        .as_str()
        .and_then(|name| magic_method_signature(&name.to_ascii_lowercase()))
    {
        check_magic_method(
            parser,
            &signature,
            &method_label,
            mods,
            &params,
            return_type.as_ref(),
            member_span,
        );
    }

    let class_name = parser
        .class_scope
        .as_ref()
        .map_or_else(String::new, |scope| scope.name.clone());
    parser.check_attributes(
        &member_attrs,
        &AttrSite::new(AttrTarget::Method)
            .with_return_type(return_type.as_ref())
            .with_method_name(&class_name, method_name.as_str()),
    );

    let span = Span::new(member_start, parser.previous_end());
    ClassMember {
        kind: ClassMemberKind::Method({
            let mut method = MethodDecl::new(parser.arena, method_name);
            method.modifiers.visibility = mods.visibility;
            method.modifiers.is_static = mods.is_static;
            method.modifiers.is_abstract = mods.is_abstract;
            method.modifiers.is_final = mods.is_final;
            method.by_ref = by_ref;
            method.params = params;
            method.return_type = return_type;
            method.body = body;
            method.attributes = member_attrs;
            method.doc_comment = doc_comment;
            method
        }),
        span,
    }
}

enum MagicReturn {
    Any,
    Forbidden,
    /// The builtin types a declared return type may contain; `Object` also admits class types.
    Within(&'static [BuiltinType], &'static str),
}

/// The signature PHP enforces on a magic method (`zend_check_magic_method_implementation`).
struct MagicSignature {
    arg_count: Option<usize>,
    is_static: bool,
    /// Builtin type each leading parameter's declared type must include.
    param_types: &'static [(BuiltinType, &'static str)],
    return_type: MagicReturn,
}

fn magic_method_signature(lower_name: &str) -> Option<MagicSignature> {
    const STRING: (BuiltinType, &str) = (BuiltinType::String, "string");
    const ARRAY: (BuiltinType, &str) = (BuiltinType::Array, "array");
    const VOID: MagicReturn = MagicReturn::Within(&[BuiltinType::Void], "void");
    const RETURN_ARRAY: MagicReturn = MagicReturn::Within(&[BuiltinType::Array], "array");
    let (arg_count, is_static, param_types, return_type): (_, _, &'static [_], _) = match lower_name
    {
        "__construct" => (None, false, &[], MagicReturn::Forbidden),
        "__destruct" => (Some(0), false, &[], MagicReturn::Forbidden),
        "__clone" => (Some(0), false, &[], VOID),
        "__get" => (Some(1), false, &[STRING], MagicReturn::Any),
        "__set" => (Some(2), false, &[STRING], VOID),
        "__unset" => (Some(1), false, &[STRING], VOID),
        "__isset" => (
            Some(1),
            false,
            &[STRING],
            MagicReturn::Within(
                &[BuiltinType::Bool, BuiltinType::True, BuiltinType::False],
                "bool",
            ),
        ),
        "__call" => (Some(2), false, &[STRING, ARRAY], MagicReturn::Any),
        "__callstatic" => (Some(2), true, &[STRING, ARRAY], MagicReturn::Any),
        "__tostring" => (
            Some(0),
            false,
            &[],
            MagicReturn::Within(&[BuiltinType::String], "string"),
        ),
        "__debuginfo" => (
            Some(0),
            false,
            &[],
            MagicReturn::Within(&[BuiltinType::Array, BuiltinType::Null], "?array"),
        ),
        "__serialize" | "__sleep" => (Some(0), false, &[], RETURN_ARRAY),
        "__unserialize" => (Some(1), false, &[ARRAY], VOID),
        "__set_state" => (
            Some(1),
            true,
            &[ARRAY],
            MagicReturn::Within(&[BuiltinType::Object], "object"),
        ),
        "__invoke" => (None, false, &[], MagicReturn::Any),
        "__wakeup" => (Some(0), false, &[], VOID),
        _ => return None,
    };
    Some(MagicSignature {
        arg_count,
        is_static,
        param_types,
        return_type,
    })
}

/// Builtin types a declared type admits, and whether it also names a class (or `static`).
fn type_members(ty: &TypeHint<'_, '_>, builtins: &mut Vec<BuiltinType>) -> bool {
    match &ty.kind {
        TypeHintKind::Keyword(
            BuiltinType::Self_ | BuiltinType::Parent_ | BuiltinType::Static,
            _,
        )
        | TypeHintKind::Named(_)
        | TypeHintKind::Intersection(_) => true,
        TypeHintKind::Keyword(BuiltinType::Iterable, _) => {
            builtins.push(BuiltinType::Array);
            true
        }
        TypeHintKind::Keyword(builtin, _) => {
            builtins.push(*builtin);
            false
        }
        TypeHintKind::Nullable(inner) => {
            builtins.push(BuiltinType::Null);
            type_members(inner, builtins)
        }
        TypeHintKind::Union(types) => types
            .iter()
            .fold(false, |has_class, t| type_members(t, builtins) | has_class),
        _ => false,
    }
}

fn check_magic_method(
    parser: &mut Parser<'_, '_>,
    signature: &MagicSignature,
    method_label: &str,
    mods: &Modifiers,
    params: &[Param<'_, '_>],
    return_type: Option<&TypeHint<'_, '_>>,
    member_span: Span,
) {
    // PHP leaves a variadic parameter out of the argument count.
    let fixed_params: Vec<&Param> = params.iter().filter(|p| !p.variadic).collect();
    if let Some(expected) = signature.arg_count {
        if fixed_params.len() != expected {
            let message = match expected {
                0 => format!("Method {method_label} cannot take arguments"),
                1 => format!("Method {method_label} must take exactly 1 argument"),
                n => format!("Method {method_label} must take exactly {n} arguments"),
            };
            parser.error(ParseError::Forbidden {
                message: message.into(),
                span: member_span,
            });
        } else if let Some(param) = fixed_params.iter().find(|p| p.by_ref) {
            parser.error(ParseError::Forbidden {
                message: format!("Method {method_label} cannot take arguments by reference").into(),
                span: param.span,
            });
        }
    }

    if mods.is_static != signature.is_static {
        let requirement = if signature.is_static {
            "must be static"
        } else {
            "cannot be static"
        };
        parser.error(ParseError::Forbidden {
            message: format!("Method {method_label} {requirement}").into(),
            span: member_span,
        });
    }

    for (i, ((required, required_name), param)) in
        signature.param_types.iter().zip(&fixed_params).enumerate()
    {
        let Some(ty) = &param.type_hint else {
            continue;
        };
        let mut builtins = Vec::new();
        type_members(ty, &mut builtins);
        if !builtins.contains(required) && !builtins.contains(&BuiltinType::Mixed) {
            parser.error(ParseError::Forbidden {
                message: format!(
                    "{method_label}: Parameter #{} (${}) must be of type {required_name} when declared",
                    i + 1,
                    param.name
                )
                .into(),
                span: ty.span,
            });
        }
    }

    let Some(rt) = return_type else {
        return;
    };
    match signature.return_type {
        MagicReturn::Any => {}
        MagicReturn::Forbidden => parser.error(ParseError::Forbidden {
            message: format!("Method {method_label} cannot declare a return type").into(),
            span: rt.span,
        }),
        MagicReturn::Within(allowed, allowed_name) => {
            let mut builtins = Vec::new();
            let has_class = type_members(rt, &mut builtins);
            let fits = builtins.contains(&BuiltinType::Never)
                || builtins.iter().all(|b| allowed.contains(b))
                    && (!has_class || allowed == [BuiltinType::Object]);
            if !fits {
                parser.error(ParseError::Forbidden {
                    message: format!(
                        "{method_label}: Return type must be {allowed_name} when declared"
                    )
                    .into(),
                    span: rt.span,
                });
            }
        }
    }
}

struct AstCopy;
impl<'src> Fold<'src> for AstCopy {}

pub(super) fn copy_attributes<'arena, 'src>(
    parser: &Parser<'arena, 'src>,
    attrs: &[Attribute<'arena, 'src>],
) -> ArenaVec<'arena, Attribute<'arena, 'src>> {
    let mut out = parser.alloc_vec();
    for attr in attrs {
        out.push(AstCopy.fold_attribute(parser.arena, attr));
    }
    out
}

fn parse_property_member<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    members: &mut ArenaVec<'arena, ClassMember<'arena, 'src>>,
    member_attrs: ArenaVec<'arena, Attribute<'arena, 'src>>,
    member_start: u32,
    mods: &Modifiers,
    type_hint: Option<TypeHint<'arena, 'src>>,
    in_interface: bool,
) {
    let var_token = parser.advance();
    let prop_name = parser.variable_ident(var_token);

    let default = if parser.eat(TokenKind::Equals).is_some() {
        // Suppress `{` subscript so a following hook block `{ get => ...; }`
        // is not consumed as part of the default expression.
        let e = parser.with_no_brace_subscript(expr::parse_expr);
        expr::check_const_expr(parser, &e, false);
        Some(e)
    } else {
        None
    };

    // Property hooks: { get { ... } set { ... } } — PHP 8.4+
    let had_hooks_block = parser.check(TokenKind::LeftBrace);
    if in_interface {
        let span = Span::new(member_start, parser.previous_end());
        let mut report = |message: &'static str| {
            parser.error(ParseError::Forbidden {
                message: message.into(),
                span,
            })
        };
        if mods.is_abstract {
            report("Property in interface cannot be explicitly abstract. All interface members are implicitly abstract");
        }
        if matches!(
            mods.visibility,
            Some(Visibility::Protected | Visibility::Private)
        ) {
            report("Property in interface cannot be protected or private");
        }
        if mods.is_final {
            report("Property in interface cannot be final");
        }
    } else if mods.is_abstract && !had_hooks_block {
        // abstract is only valid on properties with hooks (abstract property hooks, PHP 8.4+)
        parser.error(ParseError::Forbidden {
            message: "properties cannot be abstract".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    let hooks = if had_hooks_block {
        let span = parser.current_span();
        parser.require_version(PhpVersion::Php84, "property hooks", span);
        parse_property_hooks(parser, type_hint.as_ref(), prop_name.as_str())
    } else {
        parser.alloc_vec()
    };
    check_hook_bodies(
        parser,
        &hooks,
        mods.is_abstract || in_interface,
        in_interface,
        mods.visibility == Some(Visibility::Private),
    );
    if let (true, false, Some(name)) = (
        mods.is_abstract && !in_interface,
        hooks.is_empty()
            || hooks
                .iter()
                .any(|h| matches!(h.body, PropertyHookBody::Abstract)),
        prop_name.as_str(),
    ) {
        let class = parser.class_member_prefix();
        parser.error(ParseError::Forbidden {
            message: format!(
                "Abstract property {class}${name} must specify at least one abstract hook"
            )
            .into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if mods.set_visibility.is_some() && type_hint.is_none() {
        let class = parser.class_member_prefix();
        parser.error(ParseError::Forbidden {
            message: format!(
                "Property with asymmetric visibility {class}${prop_name} must have type"
            )
            .into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if let Some(name) = prop_name.as_str() {
        check_backed_by_ref_get(parser, name, &hooks);
    }
    if let Some(name) = prop_name
        .as_str()
        .filter(|name| !hooks.is_empty() && is_virtual_property(name, &hooks))
    {
        let span = Span::new(member_start, parser.previous_end());
        let has_parent = parser
            .class_scope
            .as_ref()
            .is_some_and(|scope| scope.parent_name.is_some());
        // With a parent, PHP defers the check to inheritance.
        if default.is_some() && !has_parent {
            let class = parser.class_member_prefix();
            parser.error(ParseError::Forbidden {
                message: format!(
                    "Cannot specify default value for virtual hooked property {class}${name}"
                )
                .into(),
                span,
            });
        }
        if mods.set_visibility.is_some() {
            check_virtual_set_visibility(parser, name, &hooks, span);
        }
    }
    // PHP rule: set visibility must be EQUAL OR NARROWER than get visibility.
    // `private public(set)` is invalid because public-set widens beyond private-get.
    if let (Some(get_vis), Some(set_vis)) = (mods.visibility, mods.set_visibility) {
        if visibility_rank(set_vis) > visibility_rank(get_vis) {
            parser.error(ParseError::Forbidden {
                message: "Visibility of property must not be weaker than set visibility".into(),
                span: Span::new(member_start, parser.previous_end()),
            });
        }
    }
    // Set-hook parameter type must be compatible with property type.
    // If the property has no type, the set-hook parameter must also have no type.
    if type_hint.is_none() {
        for hook in hooks.iter() {
            if hook.kind == PropertyHookKind::Set {
                if let Some(param) = hook.params.first() {
                    if param.type_hint.is_some() {
                        let class = parser.class_member_prefix();
                        parser.error(ParseError::Forbidden {
                            message: format!(
                                "Type of parameter ${} of hook {class}${}::set must be compatible with property type",
                                param.name, prop_name
                            )
                            .into(),
                            span: hook.span,
                        });
                    }
                }
            }
        }
    }
    if mods.is_static && !hooks.is_empty() {
        parser.error(ParseError::Forbidden {
            message: "Cannot declare hooks for static property".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if in_interface && hooks.is_empty() {
        parser.error(ParseError::Forbidden {
            message: "Interfaces may only include hooked properties".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if mods.is_final && mods.visibility == Some(Visibility::Private) {
        parser.error(ParseError::Forbidden {
            message: "Property cannot be both final and private".into(),
            span: Span::new(member_start, parser.previous_end()),
        });
    }
    if mods.is_final {
        // `final` properties became valid in PHP 8.4; older targets reject them.
        parser.require_version(
            PhpVersion::Php84,
            "final properties",
            Span::new(member_start, parser.previous_end()),
        );
    }
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
        if let Some(default) = &default {
            report_readonly_default(parser, default.span);
        }
    }
    parser.check_attributes(&member_attrs, &AttrSite::new(AttrTarget::Property));
    let span = Span::new(member_start, parser.previous_end());
    let first_index = members.len();
    members.push(ClassMember {
        kind: ClassMemberKind::Property({
            let mut built = PropertyDecl::new(parser.arena, prop_name);
            built.modifiers = *mods;
            built.type_hint = type_hint;
            built.default = default;
            built.attributes = member_attrs;
            built.hooks = hooks;
            built.doc_comment = parser.take_doc_comment(member_start);
            built
        }),
        span,
    });

    if had_hooks_block {
        // Property with hooks block — no comma separation or semicolon needed
    } else if parser.eat(TokenKind::Comma).is_some() {
        loop {
            if !parser.check(TokenKind::Variable) {
                parser.trailing_comma_error("variable");
                break;
            }
            let var_token = parser.advance();
            let pname = parser.variable_ident(var_token);

            let pdefault = if parser.eat(TokenKind::Equals).is_some() {
                let e = expr::parse_expr(parser);
                expr::check_const_expr(parser, &e, false);
                Some(e)
            } else {
                None
            };
            if let Some(default) = pdefault.as_ref().filter(|_| mods.is_readonly) {
                report_readonly_default(parser, default.span);
            }

            let phooks = if parser.check(TokenKind::LeftBrace) {
                parser.error(ParseError::Forbidden {
                    message: "cannot have hooks on comma-separated property".into(),
                    span: parser.current_span(),
                });
                parse_property_hooks(parser, None, pname.as_str())
            } else {
                parser.alloc_vec()
            };
            let pspan = Span::new(member_start, parser.previous_end());
            // Every item of `public int $a, $b;` gets its own copy of the shared type and attributes.
            let ClassMemberKind::Property(first) = &members[first_index].kind else {
                unreachable!()
            };
            let ptype_hint = first
                .type_hint
                .as_ref()
                .map(|t| AstCopy.fold_type_hint(parser.arena, t));
            let pattributes = copy_attributes(parser, &first.attributes);
            members.push(ClassMember {
                kind: ClassMemberKind::Property({
                    let mut built = PropertyDecl::new(parser.arena, pname);
                    built.modifiers = *mods;
                    built.type_hint = ptype_hint;
                    built.default = pdefault;
                    built.attributes = pattributes;
                    built.hooks = phooks;
                    built.doc_comment = None;
                    built
                }),
                span: pspan,
            });

            if parser.eat(TokenKind::Comma).is_none() {
                break;
            }
        }
        if !parser.check(TokenKind::RightBrace) {
            parser.expect_member_end();
        }
    } else {
        parser.expect_member_end();
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
    let name_is_reserved_kw = parser.is_reserved_keyword_as_decl_name();
    let (name, name_span) = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        (Ident::new(text, span), span)
    } else {
        parser.error(ParseError::Expected {
            expected: "interface name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        (parser.missing_ident(), parser.current_span())
    };

    if let Some(text) = name.as_str() {
        if is_reserved_class_name(text, parser.version) || name_is_reserved_kw {
            parser.error(ParseError::Forbidden {
                message: format!("cannot use '{}' as interface name", text).into(),
                span: name_span,
            });
        }
    }

    let extends = if parser.eat(TokenKind::Extends).is_some() {
        let names = parse_name_list(parser);
        for n in names.iter() {
            validate_class_ref(parser, n, "interface");
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
    parser.check_attributes(
        &attributes,
        &AttrSite::class(ClassKind::Interface, &scope.name),
    );
    let members = parse_class_members(parser, true, false, scope);
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();

    Stmt {
        kind: StmtKind::Interface(parser.alloc({
            let mut built = InterfaceDecl::new(
                parser.arena,
                name,
                ClassBody {
                    members,
                    span: Span::new(brace_start, end),
                },
            );
            built.extends = extends;
            built.attributes = attributes;
            built.doc_comment = doc_comment;
            built
        })),
        span: Span::new(start, end),
        doc_comment: None,
    }
}

pub(super) fn parse_trait<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
) -> Stmt<'arena, 'src> {
    instrument::record_parse_class();

    let start = parser.start_span();
    parser.advance();
    let name_is_reserved_kw = parser.is_reserved_keyword_as_decl_name();
    let name = if let Some((text, span)) = parser.eat_identifier_or_keyword() {
        if name_is_reserved_kw {
            parser.error(ParseError::Forbidden {
                message: format!("cannot use '{}' as trait name", text).into(),
                span,
            });
        }
        Ident::new(text, span)
    } else {
        parser.error(ParseError::Expected {
            expected: "trait name".into(),
            found: parser.current_kind().description().into(),
            span: parser.current_span(),
        });
        parser.missing_ident()
    };

    // Capture docblock before parsing body (members must not steal it)
    let doc_comment = parser.take_doc_comment(start);

    let brace_start = parser.start_span();
    parser.expect(TokenKind::LeftBrace);
    parser.check_class_nesting(name.span);
    let scope = parser.class_scope_for(name.as_str(), None, true);
    parser.check_attributes(&attributes, &AttrSite::class(ClassKind::Trait, &scope.name));
    let members = parse_class_members(parser, false, true, scope);
    parser.expect(TokenKind::RightBrace);
    let end = parser.previous_end();

    Stmt {
        kind: StmtKind::Trait(parser.alloc({
            let mut built = TraitDecl::new(
                parser.arena,
                name,
                ClassBody {
                    members,
                    span: Span::new(brace_start, end),
                },
            );
            built.attributes = attributes;
            built.doc_comment = doc_comment;
            built
        })),
        span: Span::new(start, end),
        doc_comment: None,
    }
}
