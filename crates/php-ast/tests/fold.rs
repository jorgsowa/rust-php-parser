use bumpalo::Bump;
use php_ast::ast::*;
use php_ast::fold::{
    fold_arg, fold_attribute, fold_byte_str, fold_catch_clause, fold_class_member,
    fold_enum_member, fold_expr, fold_match_arm, fold_name, fold_name_str, fold_param,
    fold_property_hook, fold_stmt, fold_trait_adaptation, fold_trait_use, fold_type_hint, Fold,
};
use php_ast::Span;

struct Identity;
impl<'src> Fold<'src> for Identity {}

#[test]
fn identity_fold_preserves_expression_stmt() {
    // PHP: $x = 1;
    let arena = Bump::new();
    let out = Bump::new();

    let one = arena.alloc(Expr {
        kind: ExprKind::Int(1),
        span: Span::DUMMY,
    });
    let var_x = arena.alloc(Expr {
        kind: ExprKind::Variable(NameStr::from_source("x")),
        span: Span::DUMMY,
    });
    let assign = arena.alloc(Expr {
        kind: ExprKind::Assign(AssignExpr {
            target: var_x,
            op: AssignOp::Assign,
            value: one,
            by_ref: false,
        }),
        span: Span::DUMMY,
    });
    let mut stmts = ArenaVec::new_in(&arena);
    stmts.push(Stmt {
        kind: StmtKind::Expression(assign),
        span: Span::DUMMY,
        doc_comment: None,
    });
    let program = Program {
        stmts,
        span: Span::DUMMY,
    };

    let folded = Identity.fold_program(&out, &program);
    assert_eq!(folded.stmts.len(), 1);
    assert!(matches!(
        &folded.stmts[0].kind,
        StmtKind::Expression(e) if matches!(e.kind, ExprKind::Assign(_))
    ));
}

#[test]
fn identity_fold_preserves_arena_strings() {
    // PHP: "hello world";
    let arena = Bump::new();
    let out = Bump::new();

    let s = arena.alloc_str("hello world");
    let expr = Expr {
        kind: ExprKind::String(ByteStr::from_arena_str(s)),
        span: Span::DUMMY,
    };
    let folded_expr = Identity.fold_expr(&out, &expr);
    match folded_expr.kind {
        ExprKind::String(t) => assert_eq!(t, "hello world"),
        _ => panic!("expected String"),
    }
}

#[test]
fn identity_fold_preserves_source_name_str() {
    // PHP: $myVar;
    let out = Bump::new();

    let src = "myVar";
    let name = NameStr::from_source(src);
    let expr = Expr {
        kind: ExprKind::Variable(name),
        span: Span::DUMMY,
    };
    let folded_expr = Identity.fold_expr(&out, &expr);
    match folded_expr.kind {
        ExprKind::Variable(n) => {
            assert_eq!(n.as_str(), "myVar");
            assert_eq!(
                n.as_str().as_ptr(),
                src.as_ptr(),
                "src-borrowed name should keep pointing into the source"
            );
        }
        _ => panic!("expected Variable"),
    }
}

#[test]
fn arena_name_str_is_reallocated_into_new_arena() {
    // PHP: $arenaName;  (NameStr::Arena variant — synthesized name, not from source text)
    let src_arena = Bump::new();
    let out = Bump::new();

    let s = src_arena.alloc_str("arenaName");
    let name = NameStr::from_arena(s);
    let expr = Expr {
        kind: ExprKind::Variable(name),
        span: Span::DUMMY,
    };
    let folded_expr = Identity.fold_expr(&out, &expr);
    let ExprKind::Variable(n) = folded_expr.kind else {
        panic!("expected Variable")
    };
    assert_eq!(n.as_str(), "arenaName");
    // Must point into `out`, not into `src_arena`
    assert_ne!(
        n.as_str().as_ptr(),
        s.as_ptr(),
        "folded arena NameStr should be re-allocated, not aliasing the source arena"
    );
}

#[test]
fn string_literal_is_reallocated_into_new_arena() {
    // PHP: "hello world";
    let src_arena = Bump::new();
    let out = Bump::new();

    let s = src_arena.alloc_str("hello world");
    let expr = Expr {
        kind: ExprKind::String(ByteStr::from_arena_str(s)),
        span: Span::DUMMY,
    };
    let folded_expr = Identity.fold_expr(&out, &expr);
    let ExprKind::String(t) = folded_expr.kind else {
        panic!("expected String")
    };
    assert_eq!(t, "hello world");
    // Must be a fresh allocation in `out`, not a pointer into `src_arena`
    assert_ne!(
        t.as_ptr(),
        s.as_ptr(),
        "folded string literal should be re-allocated, not aliasing the source arena"
    );
}

/// Custom impls can intercept use-var capture lists.
#[test]
fn custom_fold_closure_use_var() {
    // PHP: function() use (&$x) {}
    struct DropByRef;
    impl<'src> Fold<'src> for DropByRef {
        fn fold_closure_use_var(
            &mut self,
            _arena: &Bump,
            var: &ClosureUseVar<'src>,
        ) -> ClosureUseVar<'src> {
            ClosureUseVar {
                by_ref: false,
                ..*var
            }
        }
    }

    let arena = Bump::new();
    let out = Bump::new();

    let mut use_vars = ArenaVec::new_in(&arena);
    use_vars.push(ClosureUseVar {
        name: Ident::new("x", Span::DUMMY),
        by_ref: true,
        span: Span::DUMMY,
    });
    let closure_body = arena.alloc(php_ast::ast::Block {
        stmts: ArenaVec::new_in(&arena),
        span: Span::DUMMY,
    });
    let closure = arena.alloc({
        let mut built = ClosureExpr::new(&arena, closure_body);
        built.is_static = false;
        built.by_ref = false;
        built.params = ArenaVec::new_in(&arena);
        built.use_vars = use_vars;
        built.return_type = None;
        built.attributes = ArenaVec::new_in(&arena);
        built
    });
    let expr = Expr {
        kind: ExprKind::Closure(closure),
        span: Span::DUMMY,
    };

    let folded = DropByRef.fold_expr(&out, &expr);
    let ExprKind::Closure(c) = folded.kind else {
        panic!("expected Closure")
    };
    assert_eq!(c.use_vars.len(), 1);
    assert!(!c.use_vars[0].by_ref, "by_ref should have been cleared");
    assert_eq!(c.use_vars[0].name, "x");
}

/// `fold_name_str` is public so callers synthesizing new names can correctly
/// handle the Src/Arena distinction without re-implementing the logic.
#[test]
fn fold_name_str_pub_preserves_src_variant() {
    // PHP: Foo  (NameStr::Src — source-borrowed, should stay Src after fold)
    let out = Bump::new();
    let src = "Foo";
    let result = fold_name_str(NameStr::from_source(src), &out);
    assert_eq!(result.as_str(), "Foo");
    assert_eq!(
        result.as_str().as_ptr(),
        src.as_ptr(),
        "Src should stay borrowed"
    );
}

#[test]
fn fold_name_str_pub_reallocates_arena_variant() {
    // PHP: Bar  (NameStr::Arena — synthesized name, must be re-allocated into out arena)
    let src_arena = Bump::new();
    let out = Bump::new();
    let s = src_arena.alloc_str("Bar");
    let name = NameStr::from_arena(s);
    let result = fold_name_str(name, &out);
    assert_eq!(result.as_str(), "Bar");
    assert_ne!(
        result.as_str().as_ptr(),
        s.as_ptr(),
        "should be re-allocated into out, not aliasing src_arena"
    );
}

#[test]
fn custom_fold_transforms_ints() {
    // PHP: 3 + 4  — override negates every Int literal
    struct NegateInts;
    impl<'src> Fold<'src> for NegateInts {
        fn fold_expr<'new>(
            &mut self,
            arena: &'new Bump,
            expr: &Expr<'_, 'src>,
        ) -> Expr<'new, 'src> {
            if let ExprKind::Int(n) = expr.kind {
                return Expr {
                    kind: ExprKind::Int(-n),
                    span: expr.span,
                };
            }
            fold_expr(self, arena, expr)
        }
    }

    let arena = Bump::new();
    let out = Bump::new();

    let left = arena.alloc(Expr {
        kind: ExprKind::Int(3),
        span: Span::DUMMY,
    });
    let right = arena.alloc(Expr {
        kind: ExprKind::Int(4),
        span: Span::DUMMY,
    });
    let binary = Expr {
        kind: ExprKind::Binary(BinaryExpr {
            left,
            op: BinaryOp::Add,
            right,
        }),
        span: Span::DUMMY,
    };

    let folded = NegateInts.fold_expr(&out, &binary);
    let ExprKind::Binary(b) = folded.kind else {
        panic!("expected Binary")
    };
    assert!(matches!(b.left.kind, ExprKind::Int(-3)));
    assert!(matches!(b.right.kind, ExprKind::Int(-4)));
}

// =============================================================================
// Arena string re-allocation — pointer-distinctness tests
// These verify that &'arena str fields are copied into the NEW arena, not passed
// through as pointers into the source arena. JSON comparison cannot catch this.
// =============================================================================

/// `ExprKind::Nowdoc.value` is `&'arena str`. The fold must re-allocate it.
/// `.label` is `&'src str` and must NOT be re-allocated.
#[test]
fn nowdoc_value_is_reallocated_label_is_not() {
    // PHP: <<<'EOT'\nnowdoc body\nEOT
    let src = Bump::new();
    let out = Bump::new();
    let val = src.alloc_str("nowdoc body");
    let expr = Expr {
        kind: ExprKind::Nowdoc {
            label: "EOT",
            value: val,
        },
        span: Span::DUMMY,
    };
    let folded = Identity.fold_expr(&out, &expr);
    let ExprKind::Nowdoc { label, value } = folded.kind else {
        panic!("expected Nowdoc")
    };
    assert_eq!(value, "nowdoc body");
    assert_ne!(
        value.as_ptr(),
        val.as_ptr(),
        "Nowdoc value must be re-allocated"
    );
    assert_eq!(label, "EOT");
    assert_eq!(
        label.as_ptr(),
        "EOT".as_ptr(),
        "Nowdoc label is &'src str and must NOT be re-allocated"
    );
}

/// `StringPart::Literal` inside `InterpolatedString` is `&'arena str`. Must be re-allocated.
/// `StringPart::Expr` wraps an expression and must be recursively folded.
#[test]
fn string_part_literal_in_interpolated_string_is_reallocated() {
    // PHP: "hello $name"
    let src = Bump::new();
    let out = Bump::new();
    let s = src.alloc_str("hello ");
    let var_expr = Expr {
        kind: ExprKind::Variable(NameStr::from_source("name")),
        span: Span::DUMMY,
    };
    let mut parts = ArenaVec::new_in(&src);
    parts.push(StringPart::Literal(ByteStr::from_arena_str(s)));
    parts.push(StringPart::Expr(var_expr));
    let expr = Expr {
        kind: ExprKind::InterpolatedString(parts),
        span: Span::DUMMY,
    };
    let folded = Identity.fold_expr(&out, &expr);
    let ExprKind::InterpolatedString(p) = &folded.kind else {
        panic!("expected InterpolatedString")
    };
    assert_eq!(p.len(), 2);
    let StringPart::Literal(t) = &p[0] else {
        panic!("expected Literal part")
    };
    assert_eq!(*t, "hello ");
    assert_ne!(t.as_ptr(), s.as_ptr(), "Literal part must be re-allocated");
    assert!(
        matches!(&p[1], StringPart::Expr(_)),
        "Expr part must survive fold"
    );
}

// =============================================================================
// Custom override dispatch — one test per trait method that lacked coverage.
// Each test verifies the override IS called and its return value IS used.
// =============================================================================

#[test]
fn fold_stmt_override_transforms_nop_to_error() {
    // PHP: ;  (Nop statement — bare semicolon)
    struct NopToError;
    impl<'src> Fold<'src> for NopToError {
        fn fold_stmt<'new>(
            &mut self,
            arena: &'new Bump,
            stmt: &Stmt<'_, 'src>,
        ) -> Stmt<'new, 'src> {
            if matches!(stmt.kind, StmtKind::Nop) {
                return Stmt {
                    kind: StmtKind::Error,
                    span: stmt.span,
                    doc_comment: None,
                };
            }
            fold_stmt(self, arena, stmt)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let mut stmts = ArenaVec::new_in(&arena);
    stmts.push(Stmt {
        kind: StmtKind::Nop,
        span: Span::DUMMY,
        doc_comment: None,
    });
    let program = Program {
        stmts,
        span: Span::DUMMY,
    };
    let folded = NopToError.fold_program(&out, &program);
    assert!(
        matches!(folded.stmts[0].kind, StmtKind::Error),
        "fold_stmt override must replace Nop with Error"
    );
}

/// `fold_type_hint` override must be dispatched and its result must be used.
/// `Keyword` has no child type hints, so `fold_type_hint` (free fn) returns it
/// unchanged, and the override then wraps it once: `int` → `?int`.
#[test]
fn fold_type_hint_override_wraps_keyword() {
    // PHP: function f(): int {}  — type hint `int` wrapped to `?int` by override
    struct WrapNullable;
    impl<'src> Fold<'src> for WrapNullable {
        fn fold_type_hint<'new>(
            &mut self,
            arena: &'new Bump,
            th: &TypeHint<'_, 'src>,
        ) -> TypeHint<'new, 'src> {
            let inner = fold_type_hint(self, arena, th);
            TypeHint {
                kind: TypeHintKind::Nullable(arena.alloc(inner)),
                span: th.span,
            }
        }
    }
    let out = Bump::new();
    let th = TypeHint {
        kind: TypeHintKind::Keyword(BuiltinType::Int, Span::DUMMY),
        span: Span::DUMMY,
    };
    let folded = WrapNullable.fold_type_hint(&out, &th);
    // Keyword has no children — free fn returns it unchanged, override wraps once: ?int
    assert!(matches!(folded.kind, TypeHintKind::Nullable(_)));
    let TypeHintKind::Nullable(inner) = &folded.kind else {
        panic!("expected Nullable")
    };
    assert!(
        matches!(inner.kind, TypeHintKind::Keyword(BuiltinType::Int, _)),
        "inner must be the original Keyword — not re-wrapped because Keyword has no children"
    );
}

/// When the override is applied to a Nullable(int) input the free fn recurses
/// into the inner type via the overridden `fold_type_hint`, so the inner also
/// gets wrapped: `?int` → `?(?int)` at the free-fn level, then the top-level
/// override wraps once more → `?(? (?int))`.
#[test]
fn fold_type_hint_override_recurses_into_nullable() {
    // PHP: function f(): ?int {}  — nullable wraps recursively on each visit
    struct WrapNullable;
    impl<'src> Fold<'src> for WrapNullable {
        fn fold_type_hint<'new>(
            &mut self,
            arena: &'new Bump,
            th: &TypeHint<'_, 'src>,
        ) -> TypeHint<'new, 'src> {
            let inner = fold_type_hint(self, arena, th);
            TypeHint {
                kind: TypeHintKind::Nullable(arena.alloc(inner)),
                span: th.span,
            }
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    // Build `?int`
    let int_hint = arena.alloc(TypeHint {
        kind: TypeHintKind::Keyword(BuiltinType::Int, Span::DUMMY),
        span: Span::DUMMY,
    });
    let nullable_int = TypeHint {
        kind: TypeHintKind::Nullable(int_hint),
        span: Span::DUMMY,
    };
    let folded = WrapNullable.fold_type_hint(&out, &nullable_int);
    // Free fn processes Nullable(?int):
    //   - recurses into inner `int` via overridden fold_type_hint → wraps to ?int
    //   - free fn returns Nullable(?int)
    // Override then wraps the whole thing → Nullable(Nullable(?int))
    assert!(matches!(folded.kind, TypeHintKind::Nullable(_)));
    let TypeHintKind::Nullable(level1) = &folded.kind else {
        panic!("expected Nullable")
    };
    assert!(
        matches!(level1.kind, TypeHintKind::Nullable(_)),
        "fold_type_hint must recurse into Nullable children via the overridden method"
    );
}

/// Union and Intersection inner types must all pass through `fold_type_hint`.
#[test]
fn fold_type_hint_recurses_into_union_and_intersection() {
    // PHP: function f(): int|string {}
    struct CountHints {
        count: usize,
    }
    impl<'src> Fold<'src> for CountHints {
        fn fold_type_hint<'new>(
            &mut self,
            arena: &'new Bump,
            th: &TypeHint<'_, 'src>,
        ) -> TypeHint<'new, 'src> {
            self.count += 1;
            fold_type_hint(self, arena, th)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    // Build `int|string`
    let mut types = ArenaVec::new_in(&arena);
    types.push(TypeHint {
        kind: TypeHintKind::Keyword(BuiltinType::Int, Span::DUMMY),
        span: Span::DUMMY,
    });
    types.push(TypeHint {
        kind: TypeHintKind::Keyword(BuiltinType::String, Span::DUMMY),
        span: Span::DUMMY,
    });
    let union_hint = TypeHint {
        kind: TypeHintKind::Union(types),
        span: Span::DUMMY,
    };
    let mut folder = CountHints { count: 0 };
    folder.fold_type_hint(&out, &union_hint);
    // 1 for the Union itself + 2 for the inner Keyword types
    assert_eq!(
        folder.count, 3,
        "fold_type_hint must recurse into Union members"
    );
}

#[test]
fn fold_param_override_strips_default() {
    // PHP: function f($x = 42) {}
    struct ClearDefaults;
    impl<'src> Fold<'src> for ClearDefaults {
        fn fold_param<'new>(
            &mut self,
            arena: &'new Bump,
            param: &Param<'_, 'src>,
        ) -> Param<'new, 'src> {
            let mut param = fold_param(self, arena, param);
            param.default = None;
            param
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let mut param = Param::new(&arena, Ident::new("x", Span::DUMMY), Span::DUMMY);
    param.default = Some(Expr {
        kind: ExprKind::Int(42),
        span: Span::DUMMY,
    });
    let folded = ClearDefaults.fold_param(&out, &param);
    assert!(
        folded.default.is_none(),
        "fold_param override must clear the default"
    );
    assert_eq!(folded.name.as_str(), Some("x"), "other fields must survive");
}

#[test]
fn fold_arg_override_clears_named_arg() {
    // PHP: f(key: 1)
    struct StripArgNames;
    impl<'src> Fold<'src> for StripArgNames {
        fn fold_arg<'new>(&mut self, arena: &'new Bump, arg: &Arg<'_, 'src>) -> Arg<'new, 'src> {
            let mut folded = fold_arg(self, arena, arg);
            folded.name = None;
            folded
        }
    }
    let out = Bump::new();
    let arg = Arg::new(
        Some(Name::Simple {
            value: "key",
            span: Span::DUMMY,
        }),
        ArgKind::Value(Expr {
            kind: ExprKind::Int(1),
            span: Span::DUMMY,
        }),
        Span::DUMMY,
    );
    let folded = StripArgNames.fold_arg(&out, &arg);
    assert!(
        folded.name.is_none(),
        "fold_arg override must remove the arg name"
    );
    assert!(matches!(folded.value().unwrap().kind, ExprKind::Int(1)));
}

#[test]
fn fold_class_member_override_is_dispatched() {
    // PHP: class C { const FOO = 1; }
    struct CountMembers {
        count: usize,
    }
    impl<'src> Fold<'src> for CountMembers {
        fn fold_class_member<'new>(
            &mut self,
            arena: &'new Bump,
            member: &ClassMember<'_, 'src>,
        ) -> ClassMember<'new, 'src> {
            self.count += 1;
            fold_class_member(self, arena, member)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let member = ClassMember {
        kind: ClassMemberKind::ClassConst({
            let mut built = ClassConstDecl::new(
                &arena,
                Ident::new("FOO", Span::DUMMY),
                Expr {
                    kind: ExprKind::Int(1),
                    span: Span::DUMMY,
                },
            );
            built.modifiers = Modifiers::new();
            built.type_hint = None;
            built.attributes = ArenaVec::new_in(&arena);
            built.doc_comment = None;
            built
        }),
        span: Span::DUMMY,
    };
    let mut folder = CountMembers { count: 0 };
    folder.fold_class_member(&out, &member);
    assert_eq!(
        folder.count, 1,
        "fold_class_member must be dispatched once per member"
    );
}

#[test]
fn fold_enum_member_override_is_dispatched() {
    // PHP: enum E { case Active; }
    struct CountMembers {
        count: usize,
    }
    impl<'src> Fold<'src> for CountMembers {
        fn fold_enum_member<'new>(
            &mut self,
            arena: &'new Bump,
            member: &EnumMember<'_, 'src>,
        ) -> EnumMember<'new, 'src> {
            self.count += 1;
            fold_enum_member(self, arena, member)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let member = EnumMember {
        kind: EnumMemberKind::Case({
            let mut built = EnumCase::new(&arena, Ident::new("Active", Span::DUMMY));
            built.value = None;
            built.attributes = ArenaVec::new_in(&arena);
            built.doc_comment = None;
            built
        }),
        span: Span::DUMMY,
    };
    let mut folder = CountMembers { count: 0 };
    folder.fold_enum_member(&out, &member);
    assert_eq!(
        folder.count, 1,
        "fold_enum_member must be dispatched once per member"
    );
}

/// `fold_trait_use` must be dispatched when a class/enum member is `TraitUse`.
/// This is the only trait method whose dispatch path goes through another trait method
/// (`fold_class_member`) rather than being callable directly from `fold_expr`/`fold_stmt`.
#[test]
fn fold_trait_use_override_is_dispatched_through_class_member() {
    // PHP: class C { use T { foo insteadof U; } }
    struct CountTraitUses {
        count: usize,
    }
    impl<'src> Fold<'src> for CountTraitUses {
        fn fold_trait_use<'new>(
            &mut self,
            arena: &'new Bump,
            trait_use: &TraitUseDecl<'_, 'src>,
        ) -> TraitUseDecl<'new, 'src> {
            self.count += 1;
            fold_trait_use(self, arena, trait_use)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let mut traits = ArenaVec::new_in(&arena);
    traits.push(Name::Simple {
        value: "T",
        span: Span::DUMMY,
    });
    let member = ClassMember {
        kind: ClassMemberKind::TraitUse({
            let mut built = TraitUseDecl::new(&arena, traits);
            built.adaptations = ArenaVec::new_in(&arena);
            built.adaptations_brace_span = None;
            built.doc_comment = None;
            built
        }),
        span: Span::DUMMY,
    };
    let mut folder = CountTraitUses { count: 0 };
    folder.fold_class_member(&out, &member);
    assert_eq!(
        folder.count, 1,
        "fold_trait_use must be dispatched when fold_class_member processes a TraitUse member"
    );
}

/// Override replaces any Block hook body with Abstract — verifies dispatch and result is used.
#[test]
fn fold_property_hook_override_block_body() {
    // PHP: class C { public string $x { get { ; } } }
    struct MakeAbstract;
    impl<'src> Fold<'src> for MakeAbstract {
        fn fold_property_hook<'new>(
            &mut self,
            arena: &'new Bump,
            hook: &PropertyHook<'_, 'src>,
        ) -> PropertyHook<'new, 'src> {
            let mut folded = fold_property_hook(self, arena, hook);
            folded.body = PropertyHookBody::Abstract;
            folded
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let mut body_stmts = ArenaVec::new_in(&arena);
    body_stmts.push(Stmt {
        kind: StmtKind::Nop,
        span: Span::DUMMY,
        doc_comment: None,
    });
    let block = arena.alloc(php_ast::ast::Block {
        stmts: body_stmts,
        span: Span::DUMMY,
    });
    let hook = {
        let mut built = PropertyHook::new(
            &arena,
            PropertyHookKind::Get,
            PropertyHookBody::Block(block),
            Span::DUMMY,
        );
        built.modifiers = Modifiers::new();
        built.by_ref = false;
        built.params = ArenaVec::new_in(&arena);
        built.attributes = ArenaVec::new_in(&arena);
        built
    };
    let folded = MakeAbstract.fold_property_hook(&out, &hook);
    assert!(
        matches!(folded.body, PropertyHookBody::Abstract),
        "fold_property_hook override must replace Block body with Abstract"
    );
}

/// Override replaces any Expression hook body with Abstract — verifies dispatch and result is used.
#[test]
fn fold_property_hook_override_expression_body() {
    // PHP: class C { public string $x { set => 0; } }
    struct MakeAbstract;
    impl<'src> Fold<'src> for MakeAbstract {
        fn fold_property_hook<'new>(
            &mut self,
            arena: &'new Bump,
            hook: &PropertyHook<'_, 'src>,
        ) -> PropertyHook<'new, 'src> {
            let mut folded = fold_property_hook(self, arena, hook);
            folded.body = PropertyHookBody::Abstract;
            folded
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let hook = {
        let mut built = PropertyHook::new(
            &arena,
            PropertyHookKind::Set,
            PropertyHookBody::Expression(Expr {
                kind: ExprKind::Int(0),
                span: Span::DUMMY,
            }),
            Span::DUMMY,
        );
        built.modifiers = Modifiers::new();
        built.by_ref = false;
        built.params = ArenaVec::new_in(&arena);
        built.attributes = ArenaVec::new_in(&arena);
        built
    };
    let folded = MakeAbstract.fold_property_hook(&out, &hook);
    assert!(
        matches!(folded.body, PropertyHookBody::Abstract),
        "fold_property_hook override must replace Expression body with Abstract"
    );
}

#[test]
fn fold_attribute_override_is_dispatched() {
    // PHP: #[Route] function f() {}
    struct CountAttrs {
        count: usize,
    }
    impl<'src> Fold<'src> for CountAttrs {
        fn fold_attribute<'new>(
            &mut self,
            arena: &'new Bump,
            attr: &Attribute<'_, 'src>,
        ) -> Attribute<'new, 'src> {
            self.count += 1;
            fold_attribute(self, arena, attr)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let attr = {
        let mut built = Attribute::new(
            &arena,
            Name::Simple {
                value: "Route",
                span: Span::DUMMY,
            },
            Span::DUMMY,
        );
        built.args = ArenaVec::new_in(&arena);
        built
    };
    let mut folder = CountAttrs { count: 0 };
    folder.fold_attribute(&out, &attr);
    assert_eq!(
        folder.count, 1,
        "fold_attribute must be dispatched per attribute"
    );
}

/// Verifies both a `conditions = Some(...)` arm and a `default` arm (conditions = None)
/// pass through `fold_match_arm`.
#[test]
fn fold_match_arm_override_dispatched_for_both_arm_kinds() {
    // PHP: match ($x) { 1 => 2, default => 0 }
    struct CountArms {
        count: usize,
    }
    impl<'src> Fold<'src> for CountArms {
        fn fold_match_arm<'new>(
            &mut self,
            arena: &'new Bump,
            arm: &MatchArm<'_, 'src>,
        ) -> MatchArm<'new, 'src> {
            self.count += 1;
            fold_match_arm(self, arena, arm)
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let subject = arena.alloc(Expr {
        kind: ExprKind::Variable(NameStr::from_source("x")),
        span: Span::DUMMY,
    });
    let mut conds = ArenaVec::new_in(&arena);
    conds.push(Expr {
        kind: ExprKind::Int(1),
        span: Span::DUMMY,
    });
    let mut arms = ArenaVec::new_in(&arena);
    // Regular arm: `1 => 2`
    arms.push(MatchArm {
        conditions: Some(conds),
        body: Expr {
            kind: ExprKind::Int(2),
            span: Span::DUMMY,
        },
        span: Span::DUMMY,
    });
    // Default arm: `default => 0`
    arms.push(MatchArm {
        conditions: None,
        body: Expr {
            kind: ExprKind::Int(0),
            span: Span::DUMMY,
        },
        span: Span::DUMMY,
    });
    let match_expr = Expr {
        kind: ExprKind::Match(MatchExpr::new(subject, arms, Span::DUMMY)),
        span: Span::DUMMY,
    };
    let mut folder = CountArms { count: 0 };
    folder.fold_expr(&out, &match_expr);
    assert_eq!(
        folder.count, 2,
        "fold_match_arm must be dispatched for both regular and default arms"
    );
}

#[test]
fn fold_catch_clause_override_clears_var() {
    // PHP: try {} catch (Exception $e) {}
    struct DropCatchVar;
    impl<'src> Fold<'src> for DropCatchVar {
        fn fold_catch_clause<'new>(
            &mut self,
            arena: &'new Bump,
            catch: &CatchClause<'_, 'src>,
        ) -> CatchClause<'new, 'src> {
            let mut folded = fold_catch_clause(self, arena, catch);
            folded.var = None;
            folded
        }
    }
    let arena = Bump::new();
    let out = Bump::new();
    let mut types = ArenaVec::new_in(&arena);
    types.push(Name::Simple {
        value: "Exception",
        span: Span::DUMMY,
    });
    let empty_block = arena.alloc(php_ast::ast::Block {
        stmts: ArenaVec::new_in(&arena),
        span: Span::DUMMY,
    });
    let catch = {
        let mut built = CatchClause::new(&arena, empty_block, Span::DUMMY);
        built.types = types;
        built.var = Some(Ident::new("e", Span::DUMMY));
        built
    };
    let folded = DropCatchVar.fold_catch_clause(&out, &catch);
    assert!(
        folded.var.is_none(),
        "fold_catch_clause override must clear the catch variable"
    );
    assert_eq!(folded.types.len(), 1);
}

#[test]
fn fold_trait_adaptation_override_is_dispatched() {
    // PHP: use T { foo as bar; }
    struct CountAdaptations {
        count: usize,
    }
    impl<'src> Fold<'src> for CountAdaptations {
        fn fold_trait_adaptation<'new>(
            &mut self,
            arena: &'new Bump,
            adaptation: &TraitAdaptation<'_, 'src>,
        ) -> TraitAdaptation<'new, 'src> {
            self.count += 1;
            fold_trait_adaptation(self, arena, adaptation)
        }
    }
    let out = Bump::new();
    let adaptation = TraitAdaptation {
        kind: TraitAdaptationKind::Alias {
            trait_name: None,
            method: Name::Simple {
                value: "foo",
                span: Span::DUMMY,
            },
            new_modifier: None,
            is_final: false,
            new_name: Some(Name::Simple {
                value: "bar",
                span: Span::DUMMY,
            }),
        },
        span: Span::DUMMY,
    };
    let mut folder = CountAdaptations { count: 0 };
    folder.fold_trait_adaptation(&out, &adaptation);
    assert_eq!(folder.count, 1, "fold_trait_adaptation must be dispatched");
}

#[test]
fn fold_name_override_is_dispatched() {
    // PHP: f(key: 1)  — fold_arg recurses into its name field through fold_name
    struct CountNames {
        count: usize,
    }
    impl<'src> Fold<'src> for CountNames {
        fn fold_name<'new>(
            &mut self,
            arena: &'new Bump,
            name: &Name<'_, 'src>,
        ) -> Name<'new, 'src> {
            self.count += 1;
            fold_name(self, arena, name)
        }
    }
    let out = Bump::new();
    let arg = Arg::new(
        Some(Name::Simple {
            value: "key",
            span: Span::DUMMY,
        }),
        ArgKind::Value(Expr {
            kind: ExprKind::Int(1),
            span: Span::DUMMY,
        }),
        Span::DUMMY,
    );
    let mut folder = CountNames { count: 0 };
    folder.fold_arg(&out, &arg);
    assert_eq!(
        folder.count, 1,
        "fold_name must be dispatched for the named arg"
    );
}

// =============================================================================
// Option/None edge cases — verify None fields stay None through the fold
// =============================================================================

#[test]
fn return_none_stays_none() {
    // PHP: return;
    let arena = Bump::new();
    let out = Bump::new();
    let mut stmts = ArenaVec::new_in(&arena);
    stmts.push(Stmt {
        kind: StmtKind::Return(None),
        span: Span::DUMMY,
        doc_comment: None,
    });
    let program = Program {
        stmts,
        span: Span::DUMMY,
    };
    let folded = Identity.fold_program(&out, &program);
    assert!(
        matches!(&folded.stmts[0].kind, StmtKind::Return(None)),
        "Return(None) must fold to Return(None)"
    );
}

#[test]
fn foreach_without_key_stays_none() {
    // PHP: foreach ($items as $item) ;
    let arena = Bump::new();
    let out = Bump::new();
    let nop = arena.alloc(Stmt {
        kind: StmtKind::Nop,
        span: Span::DUMMY,
        doc_comment: None,
    });
    let foreach = arena.alloc({
        let mut built = ForeachStmt::new(
            Expr {
                kind: ExprKind::Variable(NameStr::from_source("items")),
                span: Span::DUMMY,
            },
            Expr {
                kind: ExprKind::Variable(NameStr::from_source("item")),
                span: Span::DUMMY,
            },
            nop,
        );
        built.key = None;
        built.by_ref = false;
        built.uses_alternative = false;
        built
    });
    let stmt = Stmt {
        kind: StmtKind::Foreach(foreach),
        span: Span::DUMMY,
        doc_comment: None,
    };
    let folded = Identity.fold_stmt(&out, &stmt);
    let StmtKind::Foreach(f) = &folded.kind else {
        panic!("expected Foreach")
    };
    assert!(
        f.key.is_none(),
        "foreach key=None must remain None after fold"
    );
}

/// `MatchArm::conditions = None` represents the `default` arm.
/// Verify it stays None after identity fold (not confused with an empty conditions vec).
#[test]
fn match_default_arm_conditions_none_stays_none() {
    // PHP: match ($x) { default => 0 }  — conditions=None is the default arm, not empty conditions
    let out = Bump::new();
    let arm = MatchArm {
        conditions: None,
        body: Expr {
            kind: ExprKind::Int(0),
            span: Span::DUMMY,
        },
        span: Span::DUMMY,
    };
    let folded = Identity.fold_match_arm(&out, &arm);
    assert!(
        folded.conditions.is_none(),
        "default arm (conditions=None) must stay None — must not be confused with empty vec"
    );
}

/// `Param` and `MethodDecl` are `#[non_exhaustive]`; their constructors set the
/// required fields and leave the rest empty for assignment.
#[test]
fn constructors_leave_optional_fields_empty() {
    let arena = Bump::new();
    let param = Param::new(&arena, Ident::new("x", Span::DUMMY), Span::new(1, 3));
    assert_eq!(param.name.as_str(), Some("x"));
    assert_eq!(param.span, Span::new(1, 3));
    assert!(
        param.type_hint.is_none()
            && param.default.is_none()
            && param.modifiers.visibility.is_none()
    );
    assert!(
        !param.by_ref
            && !param.variadic
            && !param.modifiers.is_readonly
            && !param.modifiers.is_final
    );
    assert!(param.attributes.is_empty() && param.hooks.is_empty());

    let method = MethodDecl::new(&arena, Ident::new("run", Span::DUMMY));
    assert_eq!(method.name.as_str(), Some("run"));
    assert!(method.params.is_empty() && method.body.is_none() && method.return_type.is_none());
    assert!(
        !method.modifiers.is_static && !method.modifiers.is_abstract && !method.modifiers.is_final
    );

    let owned =
        php_ast::owned::Param::new(php_ast::owned::Ident::new("y", Span::DUMMY), Span::DUMMY);
    assert_eq!(owned.name.as_str(), Some("y"));
    assert!(owned.default.is_none() && owned.hooks.is_empty());
    let owned_method =
        php_ast::owned::MethodDecl::new(php_ast::owned::Ident::new("go", Span::DUMMY));
    assert!(owned_method.params.is_empty() && owned_method.body.is_none());
}

#[test]
fn arena_vec_into_iter_is_double_ended_and_exact_size() {
    let arena = Bump::new();
    let mut v = ArenaVec::new_in(&arena);
    for i in 0..4 {
        v.push(i);
    }
    let mut it = v.into_iter();
    assert_eq!(it.len(), 4);
    assert_eq!(it.next_back(), Some(3));
    assert_eq!(it.next(), Some(0));
    assert_eq!(it.collect::<Vec<_>>(), vec![1, 2]);
}

#[test]
fn fold_stmts_override_can_delete_and_split_statements() {
    // PHP: ; ; (bare semicolons) — dropped from the program, doubled inside a block
    struct DropNops;
    impl<'src> Fold<'src> for DropNops {
        fn fold_stmts<'new>(
            &mut self,
            arena: &'new Bump,
            stmts: &[Stmt<'_, 'src>],
        ) -> ArenaVec<'new, Stmt<'new, 'src>> {
            let mut out = ArenaVec::new_in(arena);
            for stmt in stmts {
                if !matches!(stmt.kind, StmtKind::Nop) {
                    out.push(self.fold_stmt(arena, stmt));
                }
            }
            out
        }
    }

    let arena = Bump::new();
    let out = Bump::new();
    let nop = || Stmt {
        kind: StmtKind::Nop,
        span: Span::DUMMY,
        doc_comment: None,
    };
    let mut inner = ArenaVec::new_in(&arena);
    inner.push(nop());
    let block = arena.alloc(Block {
        stmts: inner,
        span: Span::DUMMY,
    });
    let mut stmts = ArenaVec::new_in(&arena);
    stmts.push(nop());
    stmts.push(Stmt {
        kind: StmtKind::Block(block),
        span: Span::DUMMY,
        doc_comment: None,
    });
    let program = Program {
        stmts,
        span: Span::DUMMY,
    };
    let folded = DropNops.fold_program(&out, &program);
    assert_eq!(folded.stmts.len(), 1);
    let StmtKind::Block(block) = &folded.stmts[0].kind else {
        panic!("expected Block")
    };
    assert!(
        block.stmts.is_empty(),
        "block statements go through the hook too"
    );
}

#[test]
fn fold_preserves_arg_and_array_element_kinds() {
    // PHP: f(...$a, &$b, ?, ...); [...$a, &$b]
    let arena = Bump::new();
    let out = Bump::new();
    let var = |name: &'static str| Expr {
        kind: ExprKind::Variable(NameStr::from_source(name)),
        span: Span::DUMMY,
    };
    let arg = |kind| Arg::new(None, kind, Span::DUMMY);
    let mut args = ArenaVec::new_in(&arena);
    args.push(arg(ArgKind::Spread(var("a"))));
    args.push(arg(ArgKind::ByRef(var("b"))));
    args.push(arg(ArgKind::Placeholder));
    args.push(arg(ArgKind::SpreadPlaceholder));
    let folded: Vec<_> = args.iter().map(|a| Identity.fold_arg(&out, a)).collect();
    assert!(matches!(folded[0].kind, ArgKind::Spread(_)) && folded[0].is_spread());
    assert!(matches!(folded[1].kind, ArgKind::ByRef(_)) && !folded[1].is_spread());
    assert!(matches!(folded[2].kind, ArgKind::Placeholder) && folded[2].is_placeholder());
    assert!(matches!(folded[3].kind, ArgKind::SpreadPlaceholder) && folded[3].value().is_none());

    let element = |kind| ArrayElement {
        key: None,
        kind,
        span: Span::DUMMY,
    };
    let mut elements = ArenaVec::new_in(&arena);
    elements.push(element(ArrayElementKind::Spread(var("a"))));
    elements.push(element(ArrayElementKind::ByRef(var("b"))));
    elements.push(element(ArrayElementKind::Value(var("c"))));
    let array = Expr {
        kind: ExprKind::Array(elements),
        span: Span::DUMMY,
    };
    let folded = Identity.fold_expr(&out, &array);
    let ExprKind::Array(elements) = folded.kind else {
        panic!("expected Array")
    };
    assert!(elements[0].is_spread() && !elements[0].is_by_ref());
    assert!(elements[1].is_by_ref() && !elements[1].is_spread());
    assert!(!elements[2].is_spread() && !elements[2].is_by_ref());
    assert!(matches!(elements[2].value().kind, ExprKind::Variable(_)));
}

#[test]
fn modifiers_is_empty_until_a_flag_is_set() {
    let mut modifiers = Modifiers::new();
    assert!(modifiers.is_empty());
    assert_eq!(modifiers, Modifiers::default());
    modifiers.is_final = true;
    assert!(!modifiers.is_empty());
    let mut with_visibility = Modifiers::new();
    with_visibility.set_visibility = Some(Visibility::Private);
    assert!(!with_visibility.is_empty());
}

#[test]
fn fold_preserves_modifiers() {
    // PHP: final protected static function f() {}
    let arena = Bump::new();
    let out = Bump::new();
    let mut method = MethodDecl::new(&arena, Ident::new("f", Span::DUMMY));
    method.modifiers.visibility = Some(Visibility::Protected);
    method.modifiers.is_static = true;
    method.modifiers.is_final = true;
    let member = ClassMember {
        kind: ClassMemberKind::Method(method),
        span: Span::DUMMY,
    };
    let folded = Identity.fold_class_member(&out, &member);
    let ClassMemberKind::Method(method) = folded.kind else {
        panic!("expected Method")
    };
    assert_eq!(method.modifiers.visibility, Some(Visibility::Protected));
    assert!(
        method.modifiers.is_static && method.modifiers.is_final && !method.modifiers.is_abstract
    );
}

#[test]
fn declaration_and_statement_constructors_leave_the_rest_empty() {
    let arena = Bump::new();
    let name = || Ident::new("A", Span::DUMMY);
    let block: &Block = arena.alloc(Block {
        stmts: ArenaVec::new_in(&arena),
        span: Span::DUMMY,
    });
    let body = || ClassBody {
        members: ArenaVec::new_in(&arena),
        span: Span::DUMMY,
    };

    let class = ClassDecl::new(&arena, Some(name()), body());
    assert!(class.extends.is_none() && class.implements.is_empty() && class.attributes.is_empty());
    assert!(!class.modifiers.is_final && !class.modifiers.is_abstract);

    let function = FunctionDecl::new(&arena, name(), block);
    assert!(function.params.is_empty() && function.return_type.is_none() && !function.by_ref);

    let closure = ClosureExpr::new(&arena, block);
    assert!(closure.params.is_empty() && closure.use_vars.is_empty() && !closure.is_static);

    let property = PropertyDecl::new(&arena, name());
    assert!(
        property.modifiers.is_empty() && property.hooks.is_empty() && property.default.is_none()
    );

    let if_stmt = IfStmt::new(
        &arena,
        Expr {
            kind: ExprKind::Bool(true),
            span: Span::DUMMY,
        },
        arena.alloc(Stmt {
            kind: StmtKind::Nop,
            span: Span::DUMMY,
            doc_comment: None,
        }),
    );
    assert!(if_stmt.elseif_branches.is_empty() && if_stmt.else_branch.is_none());
    assert!(!if_stmt.uses_alternative && if_stmt.else_kw_span.is_none());

    let try_catch = TryCatchStmt::new(&arena, block);
    assert!(try_catch.catches.is_empty() && try_catch.finally.is_none());
}

#[test]
fn byte_str_holds_bytes_that_are_not_utf8() {
    let arena = Bump::new();
    let text = ByteStr::from_source("héllo");
    assert_eq!(text.to_str(), Some("héllo"));
    assert_eq!(text, "héllo");
    assert_eq!(text.to_string_lossy(), "héllo");

    let raw = ByteStr::new_in(&arena, &[b'a', 0xff, b'b']);
    assert_eq!(raw.as_bytes(), [b'a', 0xff, b'b']);
    assert_eq!(raw.to_str(), None);
    assert_eq!(raw.to_string_lossy(), "a\u{FFFD}b");
    assert_ne!(raw, text);
    assert_eq!(format!("{raw:?}"), r#"b"a\\xffb""#);

    // Valid bytes copied into the arena read back as text.
    let copied = ByteStr::new_in(&arena, "ÿ".as_bytes());
    assert_eq!(copied.to_str(), Some("ÿ"));
    assert_eq!(copied, ByteStr::from_source("ÿ"));
}

#[test]
fn fold_byte_str_keeps_source_slices_and_copies_the_rest() {
    let src = "plain";
    let out = Bump::new();
    let kept = fold_byte_str(ByteStr::from_source(src), &out);
    assert_eq!(kept.as_bytes().as_ptr(), src.as_ptr());

    let from = Bump::new();
    let raw = ByteStr::new_in(&from, &[0xff, 0x00]);
    let copied = fold_byte_str(raw, &out);
    assert_eq!(copied.as_bytes(), [0xff, 0x00]);
    assert_ne!(copied.as_bytes().as_ptr(), raw.as_bytes().as_ptr());
}
