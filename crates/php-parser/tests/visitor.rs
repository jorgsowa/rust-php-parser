//! Integration tests for the visitor API using the real parser.
//! These tests parse actual PHP source and walk the resulting AST to verify
//! the visitor reaches all expected nodes.

use php_ast::ast::*;
use php_ast::visitor::{self, walk_trait_use, Scope, ScopeVisitor, ScopeWalker, Visitor};
use std::ops::ControlFlow;

/// Collects all Name nodes seen during traversal as string representations.
#[derive(Default)]
struct NameCollector {
    names: Vec<String>,
}

impl<'arena, 'src> Visitor<'arena, 'src> for NameCollector {
    fn visit_name(&mut self, name: &Name<'arena, 'src>) -> ControlFlow<()> {
        self.names.push(name.to_string_repr().to_string());
        ControlFlow::Continue(())
    }
}

/// Parse PHP source and run a callback with the resulting program.
/// Keeps the arena alive for the duration of the callback.
fn with_parsed<F: for<'arena, 'src> FnOnce(&'src str, &Program<'arena, 'src>)>(src: &str, f: F) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, src);
    assert!(
        result.errors.is_empty(),
        "parse errors: {:?}",
        result.errors
    );
    f(src, &result.program);
}

/// Counts occurrences of each node type visited.
#[derive(Default)]
struct NodeCounter {
    stmts: usize,
    exprs: usize,
    params: usize,
    type_hints: usize,
    attributes: usize,
    class_members: usize,
    enum_members: usize,
    catch_clauses: usize,
    match_arms: usize,
    closure_use_vars: usize,
    args: usize,
}

impl<'arena, 'src> Visitor<'arena, 'src> for NodeCounter {
    fn visit_stmt(&mut self, stmt: &Stmt<'arena, 'src>) -> ControlFlow<()> {
        self.stmts += 1;
        visitor::walk_stmt(self, stmt)
    }
    fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
        self.exprs += 1;
        visitor::walk_expr(self, expr)
    }
    fn visit_param(&mut self, param: &Param<'arena, 'src>) -> ControlFlow<()> {
        self.params += 1;
        visitor::walk_param(self, param)
    }
    fn visit_type_hint(&mut self, th: &TypeHint<'arena, 'src>) -> ControlFlow<()> {
        self.type_hints += 1;
        visitor::walk_type_hint(self, th)
    }
    fn visit_attribute(&mut self, attr: &Attribute<'arena, 'src>) -> ControlFlow<()> {
        self.attributes += 1;
        visitor::walk_attribute(self, attr)
    }
    fn visit_class_member(&mut self, m: &ClassMember<'arena, 'src>) -> ControlFlow<()> {
        self.class_members += 1;
        visitor::walk_class_member(self, m)
    }
    fn visit_enum_member(&mut self, m: &EnumMember<'arena, 'src>) -> ControlFlow<()> {
        self.enum_members += 1;
        visitor::walk_enum_member(self, m)
    }
    fn visit_catch_clause(&mut self, c: &CatchClause<'arena, 'src>) -> ControlFlow<()> {
        self.catch_clauses += 1;
        visitor::walk_catch_clause(self, c)
    }
    fn visit_match_arm(&mut self, arm: &MatchArm<'arena, 'src>) -> ControlFlow<()> {
        self.match_arms += 1;
        visitor::walk_match_arm(self, arm)
    }
    fn visit_closure_use_var(&mut self, _var: &ClosureUseVar<'src>) -> ControlFlow<()> {
        self.closure_use_vars += 1;
        ControlFlow::Continue(())
    }
    fn visit_arg(&mut self, arg: &Arg<'arena, 'src>) -> ControlFlow<()> {
        self.args += 1;
        visitor::walk_arg(self, arg)
    }
}

#[test]
fn walks_function_params_and_return_type() {
    with_parsed(
        "<?php function add(int $a, int $b): int { return $a + $b; }",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.params, 2);
            assert_eq!(c.type_hints, 3); // int, int, int
        },
    );
}

#[test]
fn walks_class_members() {
    with_parsed(
        "<?php class Foo {
            public int $x = 1;
            public function bar(): void {}
            const Y = 2;
        }",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.class_members, 3); // property, method, const
            assert_eq!(c.type_hints, 2); // int, void
        },
    );
}

#[test]
fn walks_enum_members() {
    with_parsed(
        "<?php enum Color: string {
            case Red = 'red';
            case Blue = 'blue';
            public function label(): string { return $this->value; }
        }",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.enum_members, 3); // 2 cases + 1 method
            assert_eq!(c.type_hints, 1); // return type: string
        },
    );
}

#[test]
fn walks_match_arms() {
    with_parsed(
        "<?php match($x) {
            1 => 'one',
            2, 3 => 'few',
            default => 'many',
        };",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.match_arms, 3);
        },
    );
}

#[test]
fn walks_catch_clauses() {
    with_parsed(
        "<?php try {
            foo();
        } catch (RuntimeException $e) {
            bar();
        } catch (LogicException $e) {
            baz();
        } finally {
            cleanup();
        }",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.catch_clauses, 2);
        },
    );
}

#[test]
fn walks_closure_use_vars() {
    with_parsed(
        "<?php $f = function() use ($x, &$y) { return $x + $y; };",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.closure_use_vars, 2);
        },
    );
}

#[test]
fn walks_attributes() {
    with_parsed(
        "<?php
        #[Route('/api')]
        #[Auth('admin')]
        function handler(#[FromQuery] int $page): void {}",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.attributes, 3); // Route, Auth, FromQuery
        },
    );
}

#[test]
fn walks_union_and_nullable_types() {
    with_parsed(
        "<?php function foo(?int $a, string|int $b): bool|null {}",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            // ?int(2) + string|int(3) + bool|null(3) = 8
            assert_eq!(c.type_hints, 8);
        },
    );
}

#[test]
fn walks_arrow_function() {
    with_parsed("<?php $f = fn(int $x): int => $x * 2;", |_src, program| {
        let mut c = NodeCounter::default();
        let _ = c.visit_program(program);
        assert_eq!(c.params, 1);
        assert_eq!(c.type_hints, 2); // param + return
    });
}

#[test]
fn walks_named_args() {
    with_parsed(
        "<?php array_slice(array: $a, offset: 1, length: 2);",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.args, 3);
        },
    );
}

#[test]
fn early_break_stops_traversal() {
    with_parsed(
        "<?php
        $first = 1;
        $second = 2;
        $third = 3;",
        |_src, program| {
            struct StopAfterFirst {
                var_count: usize,
            }
            impl<'arena, 'src> Visitor<'arena, 'src> for StopAfterFirst {
                fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
                    if matches!(&expr.kind, ExprKind::Variable(_)) {
                        self.var_count += 1;
                        if self.var_count == 1 {
                            return ControlFlow::Break(());
                        }
                    }
                    visitor::walk_expr(self, expr)
                }
            }

            let mut v = StopAfterFirst { var_count: 0 };
            let result = v.visit_program(program);
            assert!(result.is_break());
            assert_eq!(v.var_count, 1);
        },
    );
}

#[test]
fn walks_nested_closures_and_control_flow() {
    with_parsed(
        "<?php
        $outer = 1;
        $f = function($x) use ($outer) {
            if ($x > 0) {
                for ($i = 0; $i < $x; $i++) {
                    echo $i;
                }
            }
            return fn($y) => $y + $outer;
        };",
        |_src, program| {
            struct VarCollector {
                names: Vec<String>,
            }
            impl<'arena, 'src> Visitor<'arena, 'src> for VarCollector {
                fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
                    if let ExprKind::Variable(name) = &expr.kind {
                        self.names.push(name.to_string());
                    }
                    visitor::walk_expr(self, expr)
                }
            }

            let mut v = VarCollector { names: vec![] };
            let _ = v.visit_program(program);
            assert!(v.names.contains(&"outer".to_string()));
            assert!(v.names.contains(&"x".to_string()));
            assert!(v.names.contains(&"i".to_string()));
            assert!(v.names.contains(&"y".to_string()));
            assert!(v.names.contains(&"f".to_string()));
            assert!(v.names.len() >= 10);
        },
    );
}

#[test]
fn walks_try_catch_switch_and_foreach() {
    with_parsed(
        "<?php
        foreach ($items as $key => $value) {
            switch ($value) {
                case 1: break;
                default: break;
            }
            try {
                process($key);
            } catch (Exception $e) {
                log($e);
            }
        }",
        |_src, program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            assert_eq!(c.catch_clauses, 1);
            assert!(c.stmts >= 5);
            assert!(c.exprs >= 5);
        },
    );
}

#[test]
fn walks_class_property_and_method_types() {
    with_parsed(
        "<?php class Repo {
            private string $name;
            protected ?int $count;
            public function find(int $id): ?self {}
        }",
        |_src, program| {
            struct TypeCollector {
                types: Vec<String>,
            }
            impl<'arena, 'src> Visitor<'arena, 'src> for TypeCollector {
                fn visit_type_hint(&mut self, th: &TypeHint<'arena, 'src>) -> ControlFlow<()> {
                    match &th.kind {
                        TypeHintKind::Keyword(builtin, _) => {
                            self.types.push(builtin.as_str().to_string());
                        }
                        TypeHintKind::Named(name) => {
                            self.types.push(name.to_string_repr().to_string());
                        }
                        _ => {}
                    }
                    visitor::walk_type_hint(self, th)
                }
            }

            let mut c = TypeCollector { types: vec![] };
            let _ = c.visit_program(program);
            assert!(c.types.contains(&"string".to_string()));
            assert!(c.types.contains(&"int".to_string()));
            assert!(c.types.contains(&"self".to_string()));
        },
    );
}

#[test]
fn walks_declare_directive_expressions() {
    with_parsed("<?php declare(strict_types=1);", |_src, program| {
        let mut c = NodeCounter::default();
        let _ = c.visit_program(program);
        assert!(c.exprs >= 1); // the `1` in strict_types=1
    });
}

// =============================================================================
// ScopeVisitor integration tests
// =============================================================================

/// Collects (class_name, method_name) pairs seen while visiting class members.
#[derive(Default)]
struct MethodScopeCollector {
    /// (class_name, method_name) for each Method member visited.
    entries: Vec<(Option<String>, String)>,
}

impl<'arena, 'src> ScopeVisitor<'arena, 'src> for MethodScopeCollector {
    fn visit_class_member(
        &mut self,
        member: &ClassMember<'arena, 'src>,
        scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        if let ClassMemberKind::Method(m) = &member.kind {
            self.entries
                .push((scope.class_name.map(str::to_string), m.name.to_string()));
        }
        ControlFlow::Continue(())
    }
}

#[test]
fn scope_visitor_tracks_class_for_methods() {
    with_parsed(
        "<?php
        class Foo {
            public function bar(): void {}
            public function baz(): void {}
        }",
        |src, program| {
            let mut walker = ScopeWalker::new(src, MethodScopeCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(
                c.entries,
                vec![
                    (Some("Foo".into()), "bar".into()),
                    (Some("Foo".into()), "baz".into()),
                ]
            );
        },
    );
}

#[test]
fn scope_visitor_tracks_namespace() {
    with_parsed(
        "<?php
        namespace App\\Http;

        function handle(): void {}",
        |src, program| {
            #[derive(Default)]
            struct NsCollector {
                fn_namespaces: Vec<Option<String>>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for NsCollector {
                fn visit_stmt(
                    &mut self,
                    stmt: &Stmt<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    if matches!(&stmt.kind, StmtKind::Function(_)) {
                        self.fn_namespaces.push(scope.namespace.map(str::to_string));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, NsCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(c.fn_namespaces, vec![Some("App\\Http".into())]);
        },
    );
}

#[test]
fn scope_visitor_function_name_inside_body() {
    with_parsed(
        "<?php
        function outer(): void {
            $x = 1;
        }",
        |src, program| {
            #[derive(Default)]
            struct FnCollector {
                /// function_name seen for each Expression stmt visited.
                fn_names: Vec<Option<String>>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for FnCollector {
                fn visit_stmt(
                    &mut self,
                    stmt: &Stmt<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    if matches!(&stmt.kind, StmtKind::Expression(_)) {
                        self.fn_names.push(scope.function_name.map(str::to_string));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, FnCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(c.fn_names, vec![Some("outer".into())]);
        },
    );
}

#[test]
fn scope_visitor_closure_clears_function_name() {
    with_parsed(
        "<?php
        function outer(): void {
            $f = function() { $x = 1; };
        }",
        |src, program| {
            #[derive(Default)]
            struct FnNameCollector {
                /// function_name seen for $x = 1 expression stmt inside closure.
                names_inside_closure: Vec<Option<String>>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for FnNameCollector {
                fn visit_expr(
                    &mut self,
                    expr: &Expr<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    // Collect function_name whenever we see an Assign inside the closure.
                    if matches!(&expr.kind, ExprKind::Assign(_)) {
                        self.names_inside_closure
                            .push(scope.function_name.map(str::to_string));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, FnNameCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            // $f = ... at outer scope has function_name = "outer"
            // $x = ... inside closure has function_name = None
            assert!(c.names_inside_closure.contains(&Some("outer".into())));
            assert!(c.names_inside_closure.contains(&None));
        },
    );
}

#[test]
fn scope_visitor_method_tracks_class_and_function() {
    with_parsed(
        "<?php
        class MyClass {
            public function myMethod(): void {
                $x = 1;
            }
        }",
        |src, program| {
            #[derive(Default)]
            struct ScopeCapture {
                /// (class_name, function_name) for each expression stmt visited.
                captures: Vec<(Option<String>, Option<String>)>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for ScopeCapture {
                fn visit_stmt(
                    &mut self,
                    stmt: &Stmt<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    if matches!(&stmt.kind, StmtKind::Expression(_)) {
                        self.captures.push((
                            scope.class_name.map(str::to_string),
                            scope.function_name.map(str::to_string),
                        ));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, ScopeCapture::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(
                c.captures,
                vec![(Some("MyClass".into()), Some("myMethod".into()))]
            );
        },
    );
}

#[test]
fn scope_visitor_braced_namespace_scopes_correctly() {
    with_parsed(
        "<?php
        namespace Alpha {
            function foo() {}
        }
        namespace Beta {
            function bar() {}
        }",
        |src, program| {
            #[derive(Default)]
            struct NsFnCollector {
                entries: Vec<(Option<String>, String)>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for NsFnCollector {
                fn visit_stmt(
                    &mut self,
                    stmt: &Stmt<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    if let StmtKind::Function(f) = &stmt.kind {
                        self.entries
                            .push((scope.namespace.map(str::to_string), f.name.to_string()));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, NsFnCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(
                c.entries,
                vec![
                    (Some("Alpha".into()), "foo".into()),
                    (Some("Beta".into()), "bar".into()),
                ]
            );
        },
    );
}

#[test]
fn scope_visitor_enum_method_tracks_enum_and_function() {
    with_parsed(
        "<?php
        enum Status {
            case Active;
            public function label(): string { return 'active'; }
        }",
        |src, program| {
            #[derive(Default)]
            struct EnumScopeCollector {
                method_scopes: Vec<(Option<String>, Option<String>)>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for EnumScopeCollector {
                fn visit_enum_member(
                    &mut self,
                    member: &EnumMember<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    if let EnumMemberKind::Method(m) = &member.kind {
                        self.method_scopes.push((
                            scope.class_name.map(str::to_string),
                            Some(m.name.to_string()),
                        ));
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, EnumScopeCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(
                c.method_scopes,
                vec![(Some("Status".into()), Some("label".into()))]
            );
        },
    );
}

#[test]
fn walks_trait_use_adaptations() {
    with_parsed(
        "<?php class Foo {
            use A, B {
                A::foo insteadof B;
                B::foo as bar;
            }
        }",
        |_src, program| {
            struct AdaptationCounter {
                count: usize,
            }
            impl<'arena, 'src> Visitor<'arena, 'src> for AdaptationCounter {
                fn visit_trait_adaptation(
                    &mut self,
                    _adaptation: &TraitAdaptation<'arena, 'src>,
                ) -> ControlFlow<()> {
                    self.count += 1;
                    ControlFlow::Continue(())
                }
            }

            let mut v = AdaptationCounter { count: 0 };
            let _ = v.visit_program(program);
            assert_eq!(v.count, 2);
        },
    );
}

#[test]
fn walk_trait_use_can_be_called_directly() {
    with_parsed(
        "<?php class Foo {
            use A, B {
                A::foo insteadof B;
                B::bar as protected baz;
            }
        }",
        |_src, program| {
            struct AdaptationKindCollector {
                precedence: usize,
                alias: usize,
            }
            impl<'arena, 'src> Visitor<'arena, 'src> for AdaptationKindCollector {
                fn visit_class_member(
                    &mut self,
                    member: &ClassMember<'arena, 'src>,
                ) -> ControlFlow<()> {
                    if let ClassMemberKind::TraitUse(tu) = &member.kind {
                        walk_trait_use(self, tu)?;
                    }
                    ControlFlow::Continue(())
                }
                fn visit_trait_adaptation(
                    &mut self,
                    adaptation: &TraitAdaptation<'arena, 'src>,
                ) -> ControlFlow<()> {
                    match &adaptation.kind {
                        TraitAdaptationKind::Precedence { .. } => self.precedence += 1,
                        TraitAdaptationKind::Alias { .. } => self.alias += 1,
                    }
                    ControlFlow::Continue(())
                }
            }

            let mut v = AdaptationKindCollector {
                precedence: 0,
                alias: 0,
            };
            let _ = v.visit_program(program);
            assert_eq!(v.precedence, 1);
            assert_eq!(v.alias, 1);
        },
    );
}

#[test]
fn scope_visitor_visits_trait_adaptations() {
    with_parsed(
        "<?php class Foo {
            use A, B {
                A::foo insteadof B;
                B::foo as bar;
            }
        }",
        |src, program| {
            #[derive(Default)]
            struct AdaptationScopeCollector {
                adaptation_count: usize,
                class_names: Vec<Option<String>>,
            }
            impl<'arena, 'src> ScopeVisitor<'arena, 'src> for AdaptationScopeCollector {
                fn visit_trait_adaptation(
                    &mut self,
                    _adaptation: &TraitAdaptation<'arena, 'src>,
                    scope: &Scope<'src>,
                ) -> ControlFlow<()> {
                    self.adaptation_count += 1;
                    self.class_names.push(scope.class_name.map(str::to_string));
                    ControlFlow::Continue(())
                }
            }

            let mut walker = ScopeWalker::new(src, AdaptationScopeCollector::default());
            let _ = walker.walk(program);
            let c = walker.into_inner();
            assert_eq!(c.adaptation_count, 2);
            assert_eq!(c.class_names, vec![Some("Foo".into()), Some("Foo".into())]);
        },
    );
}

// =============================================================================
// visit_name tests
// =============================================================================

#[test]
fn visits_class_extends_and_implements() {
    with_parsed(
        "<?php class Foo extends Bar implements Baz, Qux {}",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            // Exact: extends first, then implements in order. No other names in this snippet.
            assert_eq!(v.names, vec!["Bar", "Baz", "Qux"]);
        },
    );
}

#[test]
fn visits_interface_extends() {
    with_parsed("<?php interface A extends B, C {}", |_src, program| {
        let mut v = NameCollector::default();
        let _ = v.visit_program(program);
        assert_eq!(v.names, vec!["B", "C"]);
    });
}

#[test]
fn visits_enum_scalar_type() {
    // Split from implements so each path is independently verified.
    with_parsed("<?php enum E: string {}", |_src, program| {
        let mut v = NameCollector::default();
        let _ = v.visit_program(program);
        // "string" must come from scalar_type — no other names in this snippet.
        assert_eq!(v.names, vec!["string"]);
    });
}

#[test]
fn visits_enum_implements() {
    with_parsed("<?php enum E implements Countable {}", |_src, program| {
        let mut v = NameCollector::default();
        let _ = v.visit_program(program);
        assert_eq!(v.names, vec!["Countable"]);
    });
}

#[test]
fn visits_catch_clause_types() {
    with_parsed(
        "<?php try { foo(); } catch (RuntimeException|LogicException $e) { bar(); }",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            assert_eq!(v.names, vec!["RuntimeException", "LogicException"]);
        },
    );
}

#[test]
fn visits_trait_use_names() {
    with_parsed(
        "<?php class Foo { use Loggable, Serializable; }",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            assert_eq!(v.names, vec!["Loggable", "Serializable"]);
        },
    );
}

#[test]
fn visits_attribute_names() {
    with_parsed(
        "<?php #[Route('/api')] #[Middleware\\Auth] function handler(): void {}",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            assert_eq!(v.names, vec!["Route", "Middleware\\Auth"]);
        },
    );
}

#[test]
fn visits_named_type_hints() {
    with_parsed(
        "<?php function foo(App\\Request $req): App\\Response {}",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            // param type hint first, then return type.
            assert_eq!(v.names, vec!["App\\Request", "App\\Response"]);
        },
    );
}

#[test]
fn visits_use_statement_names() {
    with_parsed(
        "<?php use App\\Http\\Request; use App\\Http\\Response as Resp;",
        |_src, program| {
            let mut v = NameCollector::default();
            let _ = v.visit_program(program);
            assert_eq!(v.names, vec!["App\\Http\\Request", "App\\Http\\Response"]);
        },
    );
}
