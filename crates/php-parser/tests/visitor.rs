//! Integration tests for the visitor API using the real parser.
//! These tests parse actual PHP source and walk the resulting AST to verify
//! the visitor reaches all expected nodes.

use php_ast::ast::*;
use php_ast::visitor::{self, Visitor};
use std::ops::ControlFlow;

/// Parse PHP source and run a callback with the resulting program.
/// Keeps the arena alive for the duration of the callback.
fn with_parsed<F: for<'arena, 'src> FnOnce(&Program<'arena, 'src>)>(src: &str, f: F) {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, src);
    assert!(
        result.errors.is_empty(),
        "parse errors: {:?}",
        result.errors
    );
    f(&result.program);
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
            let mut c = NodeCounter::default();
            let _ = c.visit_program(program);
            // ?int(2) + string|int(3) + bool|null(3) = 8
            assert_eq!(c.type_hints, 8);
        },
    );
}

#[test]
fn walks_arrow_function() {
    with_parsed("<?php $f = fn(int $x): int => $x * 2;", |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
        |program| {
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
    with_parsed("<?php declare(strict_types=1);", |program| {
        let mut c = NodeCounter::default();
        let _ = c.visit_program(program);
        assert!(c.exprs >= 1); // the `1` in strict_types=1
    });
}
