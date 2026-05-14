//! Arena-to-arena AST transformation via the [`Fold`] trait.
//!
//! # Overview
//!
//! [`Fold`] is the transformation counterpart of [`crate::visitor::Visitor`].
//! Where `Visitor` walks a tree read-only, `Fold` rebuilds it — reading from an
//! input node (in any arena `'_`) and writing into a caller-supplied output arena
//! `'new`.  This is the only sound design for arena-allocated ASTs: in-place
//! mutation (`VisitorMut`) would let you write a `&'new Expr` into a slot that
//! requires a `&'old Expr`, silently breaking the arena lifetime invariant.
//!
//! # Lifetimes
//!
//! * `'src` — the source-text lifetime, bound on the `Fold` trait.  `&'src str`
//!   slices that point directly into the original PHP source are passed through
//!   unchanged across the fold; they are never re-allocated.
//! * `'new` — the output arena lifetime; a generic on each method so one
//!   `impl Fold<'src>` can fold into different arenas over its lifetime.
//! * `'_` — the input arena lifetime, intentionally erased.  The fold never
//!   reads back through output-arena pointers, so the input and output arenas
//!   are fully independent.
//!
//! # Arena-allocated strings
//!
//! Several AST nodes store `&'arena str` values that were *not* borrowed from
//! the source buffer — for example string literals, [`StmtKind::Label`], and
//! [`ExprKind::Nowdoc`] values.  The identity fold re-allocates these via
//! `arena.alloc_str(s)` so the output nodes are self-contained within the
//! new arena.  Source-borrowed [`NameStr`] values (`NameStr::__src`) are
//! preserved as-is without copying.
//!
//! # Usage
//!
//! ```
//! use bumpalo::Bump;
//! use php_ast::fold::{Fold, fold_program};
//! use php_ast::ast::*;
//!
//! /// An identity fold — rebuilds the AST without changes.
//! struct Identity;
//! impl<'src> Fold<'src> for Identity {}
//!
//! // Fold `program` (in `src_arena`) into `out_arena`:
//! // let folded = Identity.fold_program(&out_arena, &program);
//! ```
//!
//! To transform specific nodes, override the corresponding method and call the
//! free `fold_*` function for the default recursion:
//!
//! ```
//! use bumpalo::Bump;
//! use php_ast::fold::{Fold, fold_expr};
//! use php_ast::ast::*;
//!
//! struct NegateInts;
//!
//! impl<'src> Fold<'src> for NegateInts {
//!     fn fold_expr<'new>(&mut self, arena: &'new Bump, expr: &Expr<'_, 'src>) -> Expr<'new, 'src> {
//!         if let ExprKind::Int(n) = expr.kind {
//!             return Expr { kind: ExprKind::Int(-n), span: expr.span };
//!         }
//!         fold_expr(self, arena, expr)
//!     }
//! }
//! ```

use bumpalo::Bump;

use crate::ast::*;

// =============================================================================
// Fold trait
// =============================================================================

/// Trait for arena-to-arena PHP AST transformation.
///
/// All methods have identity-fold default implementations that call the
/// corresponding free `fold_*` function.  Override only the node types you want
/// to change; the rest recurse automatically.
///
/// See the [module documentation](self) for design rationale and lifetime notes.
pub trait Fold<'src> {
    fn fold_program<'new>(
        &mut self,
        arena: &'new Bump,
        program: &Program<'_, 'src>,
    ) -> Program<'new, 'src> {
        fold_program(self, arena, program)
    }

    fn fold_stmt<'new>(&mut self, arena: &'new Bump, stmt: &Stmt<'_, 'src>) -> Stmt<'new, 'src> {
        fold_stmt(self, arena, stmt)
    }

    fn fold_expr<'new>(&mut self, arena: &'new Bump, expr: &Expr<'_, 'src>) -> Expr<'new, 'src> {
        fold_expr(self, arena, expr)
    }

    fn fold_param<'new>(
        &mut self,
        arena: &'new Bump,
        param: &Param<'_, 'src>,
    ) -> Param<'new, 'src> {
        fold_param(self, arena, param)
    }

    fn fold_arg<'new>(&mut self, arena: &'new Bump, arg: &Arg<'_, 'src>) -> Arg<'new, 'src> {
        fold_arg(self, arena, arg)
    }

    fn fold_class_member<'new>(
        &mut self,
        arena: &'new Bump,
        member: &ClassMember<'_, 'src>,
    ) -> ClassMember<'new, 'src> {
        fold_class_member(self, arena, member)
    }

    fn fold_enum_member<'new>(
        &mut self,
        arena: &'new Bump,
        member: &EnumMember<'_, 'src>,
    ) -> EnumMember<'new, 'src> {
        fold_enum_member(self, arena, member)
    }

    fn fold_property_hook<'new>(
        &mut self,
        arena: &'new Bump,
        hook: &PropertyHook<'_, 'src>,
    ) -> PropertyHook<'new, 'src> {
        fold_property_hook(self, arena, hook)
    }

    fn fold_type_hint<'new>(
        &mut self,
        arena: &'new Bump,
        type_hint: &TypeHint<'_, 'src>,
    ) -> TypeHint<'new, 'src> {
        fold_type_hint(self, arena, type_hint)
    }

    fn fold_attribute<'new>(
        &mut self,
        arena: &'new Bump,
        attribute: &Attribute<'_, 'src>,
    ) -> Attribute<'new, 'src> {
        fold_attribute(self, arena, attribute)
    }

    fn fold_catch_clause<'new>(
        &mut self,
        arena: &'new Bump,
        catch: &CatchClause<'_, 'src>,
    ) -> CatchClause<'new, 'src> {
        fold_catch_clause(self, arena, catch)
    }

    fn fold_match_arm<'new>(
        &mut self,
        arena: &'new Bump,
        arm: &MatchArm<'_, 'src>,
    ) -> MatchArm<'new, 'src> {
        fold_match_arm(self, arena, arm)
    }

    fn fold_closure_use_var(&mut self, var: &ClosureUseVar<'src>) -> ClosureUseVar<'src> {
        var.clone()
    }

    fn fold_trait_use<'new>(
        &mut self,
        arena: &'new Bump,
        trait_use: &TraitUseDecl<'_, 'src>,
    ) -> TraitUseDecl<'new, 'src> {
        fold_trait_use(self, arena, trait_use)
    }

    fn fold_trait_adaptation<'new>(
        &mut self,
        arena: &'new Bump,
        adaptation: &TraitAdaptation<'_, 'src>,
    ) -> TraitAdaptation<'new, 'src> {
        fold_trait_adaptation(self, arena, adaptation)
    }

    fn fold_name<'new>(&mut self, arena: &'new Bump, name: &Name<'_, 'src>) -> Name<'new, 'src> {
        fold_name(self, arena, name)
    }
}

// =============================================================================
// Public free functions — default recursion for each trait method
// =============================================================================

pub fn fold_program<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    program: &Program<'_, 'src>,
) -> Program<'new, 'src> {
    Program {
        stmts: fold_stmts(folder, arena, &program.stmts),
        span: program.span,
    }
}

pub fn fold_stmt<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    stmt: &Stmt<'_, 'src>,
) -> Stmt<'new, 'src> {
    let kind = match &stmt.kind {
        StmtKind::Expression(expr) => {
            StmtKind::Expression(arena.alloc(folder.fold_expr(arena, expr)))
        }
        StmtKind::Echo(exprs) => StmtKind::Echo(fold_exprs(folder, arena, exprs)),
        StmtKind::Return(expr) => {
            StmtKind::Return(expr.map(|e| &*arena.alloc(folder.fold_expr(arena, e))))
        }
        StmtKind::Block(stmts) => StmtKind::Block(fold_stmts(folder, arena, stmts)),
        StmtKind::If(if_stmt) => {
            let mut elseif_branches =
                ArenaVec::with_capacity_in(if_stmt.elseif_branches.len(), arena);
            for branch in if_stmt.elseif_branches.iter() {
                elseif_branches.push(ElseIfBranch {
                    condition: folder.fold_expr(arena, &branch.condition),
                    body: folder.fold_stmt(arena, &branch.body),
                    span: branch.span,
                });
            }
            let new_if = arena.alloc(IfStmt {
                condition: folder.fold_expr(arena, &if_stmt.condition),
                then_branch: arena.alloc(folder.fold_stmt(arena, if_stmt.then_branch)),
                elseif_branches,
                else_branch: if_stmt
                    .else_branch
                    .map(|b| &*arena.alloc(folder.fold_stmt(arena, b))),
                uses_alternative: if_stmt.uses_alternative,
            });
            StmtKind::If(new_if)
        }
        StmtKind::While(w) => {
            let new_w = arena.alloc(WhileStmt {
                condition: folder.fold_expr(arena, &w.condition),
                body: arena.alloc(folder.fold_stmt(arena, w.body)),
                uses_alternative: w.uses_alternative,
            });
            StmtKind::While(new_w)
        }
        StmtKind::For(f) => {
            let new_f = arena.alloc(ForStmt {
                init: fold_exprs(folder, arena, &f.init),
                condition: fold_exprs(folder, arena, &f.condition),
                update: fold_exprs(folder, arena, &f.update),
                body: arena.alloc(folder.fold_stmt(arena, f.body)),
                uses_alternative: f.uses_alternative,
            });
            StmtKind::For(new_f)
        }
        StmtKind::Foreach(fe) => {
            let new_fe = arena.alloc(ForeachStmt {
                expr: folder.fold_expr(arena, &fe.expr),
                key: fe.key.as_ref().map(|k| folder.fold_expr(arena, k)),
                value: folder.fold_expr(arena, &fe.value),
                body: arena.alloc(folder.fold_stmt(arena, fe.body)),
                uses_alternative: fe.uses_alternative,
            });
            StmtKind::Foreach(new_fe)
        }
        StmtKind::DoWhile(dw) => {
            let new_dw = arena.alloc(DoWhileStmt {
                body: arena.alloc(folder.fold_stmt(arena, dw.body)),
                condition: folder.fold_expr(arena, &dw.condition),
            });
            StmtKind::DoWhile(new_dw)
        }
        StmtKind::Function(func) => {
            StmtKind::Function(arena.alloc(fold_function_decl(folder, arena, func)))
        }
        StmtKind::Break(expr) => {
            StmtKind::Break(expr.map(|e| &*arena.alloc(folder.fold_expr(arena, e))))
        }
        StmtKind::Continue(expr) => {
            StmtKind::Continue(expr.map(|e| &*arena.alloc(folder.fold_expr(arena, e))))
        }
        StmtKind::Switch(sw) => {
            let mut cases = ArenaVec::with_capacity_in(sw.cases.len(), arena);
            for case in sw.cases.iter() {
                cases.push(SwitchCase {
                    value: case.value.as_ref().map(|v| folder.fold_expr(arena, v)),
                    body: fold_stmts(folder, arena, &case.body),
                    span: case.span,
                });
            }
            let new_sw = arena.alloc(SwitchStmt {
                expr: folder.fold_expr(arena, &sw.expr),
                cases,
                uses_alternative: sw.uses_alternative,
            });
            StmtKind::Switch(new_sw)
        }
        StmtKind::Goto(ident) => StmtKind::Goto(*ident),
        StmtKind::Label(s) => StmtKind::Label(arena.alloc_str(s)),
        StmtKind::Declare(decl) => {
            let mut directives = ArenaVec::with_capacity_in(decl.directives.len(), arena);
            for (name, expr) in decl.directives.iter() {
                directives.push((*name, folder.fold_expr(arena, expr)));
            }
            let new_decl = arena.alloc(DeclareStmt {
                directives,
                body: decl.body.map(|b| &*arena.alloc(folder.fold_stmt(arena, b))),
                uses_alternative: decl.uses_alternative,
            });
            StmtKind::Declare(new_decl)
        }
        StmtKind::Unset(exprs) => StmtKind::Unset(fold_exprs(folder, arena, exprs)),
        StmtKind::Throw(expr) => StmtKind::Throw(arena.alloc(folder.fold_expr(arena, expr))),
        StmtKind::TryCatch(tc) => {
            let mut catches = ArenaVec::with_capacity_in(tc.catches.len(), arena);
            for catch in tc.catches.iter() {
                catches.push(folder.fold_catch_clause(arena, catch));
            }
            let new_tc = arena.alloc(TryCatchStmt {
                body: fold_stmts(folder, arena, &tc.body),
                catches,
                finally: tc.finally.as_ref().map(|f| fold_stmts(folder, arena, f)),
            });
            StmtKind::TryCatch(new_tc)
        }
        StmtKind::Global(exprs) => StmtKind::Global(fold_exprs(folder, arena, exprs)),
        StmtKind::Class(class) => {
            StmtKind::Class(arena.alloc(fold_class_decl(folder, arena, class)))
        }
        StmtKind::Interface(iface) => {
            StmtKind::Interface(arena.alloc(fold_interface_decl(folder, arena, iface)))
        }
        StmtKind::Trait(t) => StmtKind::Trait(arena.alloc(fold_trait_decl(folder, arena, t))),
        StmtKind::Enum(e) => StmtKind::Enum(arena.alloc(fold_enum_decl(folder, arena, e))),
        StmtKind::Namespace(ns) => {
            let new_ns = arena.alloc(NamespaceDecl {
                name: ns.name.as_ref().map(|n| folder.fold_name(arena, n)),
                body: match &ns.body {
                    NamespaceBody::Braced(stmts) => {
                        NamespaceBody::Braced(fold_stmts(folder, arena, stmts))
                    }
                    NamespaceBody::Simple => NamespaceBody::Simple,
                },
            });
            StmtKind::Namespace(new_ns)
        }
        StmtKind::Use(use_decl) => {
            let mut uses = ArenaVec::with_capacity_in(use_decl.uses.len(), arena);
            for item in use_decl.uses.iter() {
                uses.push(UseItem {
                    name: folder.fold_name(arena, &item.name),
                    alias: item.alias,
                    kind: item.kind,
                    span: item.span,
                });
            }
            let new_use = arena.alloc(UseDecl {
                kind: use_decl.kind,
                uses,
            });
            StmtKind::Use(new_use)
        }
        StmtKind::Const(items) => {
            let mut new_items = ArenaVec::with_capacity_in(items.len(), arena);
            for item in items.iter() {
                new_items.push(ConstItem {
                    name: item.name,
                    value: folder.fold_expr(arena, &item.value),
                    attributes: fold_attrs(folder, arena, &item.attributes),
                    span: item.span,
                    doc_comment: item.doc_comment.as_ref().map(fold_comment),
                });
            }
            StmtKind::Const(new_items)
        }
        StmtKind::StaticVar(vars) => {
            let mut new_vars = ArenaVec::with_capacity_in(vars.len(), arena);
            for var in vars.iter() {
                new_vars.push(StaticVar {
                    name: var.name,
                    default: var.default.as_ref().map(|d| folder.fold_expr(arena, d)),
                    span: var.span,
                });
            }
            StmtKind::StaticVar(new_vars)
        }
        StmtKind::HaltCompiler(s) => StmtKind::HaltCompiler(s),
        StmtKind::Nop => StmtKind::Nop,
        StmtKind::InlineHtml(s) => StmtKind::InlineHtml(s),
        StmtKind::Error => StmtKind::Error,
    };
    Stmt {
        kind,
        span: stmt.span,
    }
}

pub fn fold_expr<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    expr: &Expr<'_, 'src>,
) -> Expr<'new, 'src> {
    let kind = match &expr.kind {
        ExprKind::Int(n) => ExprKind::Int(*n),
        ExprKind::Float(f) => ExprKind::Float(*f),
        ExprKind::String(s) => ExprKind::String(arena.alloc_str(s)),
        ExprKind::InterpolatedString(parts) => {
            ExprKind::InterpolatedString(fold_string_parts(folder, arena, parts))
        }
        ExprKind::Heredoc { label, parts } => ExprKind::Heredoc {
            label,
            parts: fold_string_parts(folder, arena, parts),
        },
        ExprKind::Nowdoc { label, value } => ExprKind::Nowdoc {
            label,
            value: arena.alloc_str(value),
        },
        ExprKind::ShellExec(parts) => ExprKind::ShellExec(fold_string_parts(folder, arena, parts)),
        ExprKind::Bool(b) => ExprKind::Bool(*b),
        ExprKind::Null => ExprKind::Null,
        ExprKind::Variable(name) => ExprKind::Variable(fold_name_str(*name, arena)),
        ExprKind::VariableVariable(inner) => {
            ExprKind::VariableVariable(arena.alloc(folder.fold_expr(arena, inner)))
        }
        ExprKind::Identifier(name) => ExprKind::Identifier(fold_name_str(*name, arena)),
        ExprKind::Assign(assign) => ExprKind::Assign(AssignExpr {
            target: arena.alloc(folder.fold_expr(arena, assign.target)),
            op: assign.op,
            value: arena.alloc(folder.fold_expr(arena, assign.value)),
            by_ref: assign.by_ref,
        }),
        ExprKind::Binary(binary) => ExprKind::Binary(BinaryExpr {
            left: arena.alloc(folder.fold_expr(arena, binary.left)),
            op: binary.op,
            right: arena.alloc(folder.fold_expr(arena, binary.right)),
        }),
        ExprKind::UnaryPrefix(u) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: u.op,
            operand: arena.alloc(folder.fold_expr(arena, u.operand)),
        }),
        ExprKind::UnaryPostfix(u) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            operand: arena.alloc(folder.fold_expr(arena, u.operand)),
            op: u.op,
        }),
        ExprKind::Ternary(t) => ExprKind::Ternary(TernaryExpr {
            condition: arena.alloc(folder.fold_expr(arena, t.condition)),
            then_expr: t
                .then_expr
                .map(|e| &*arena.alloc(folder.fold_expr(arena, e))),
            else_expr: arena.alloc(folder.fold_expr(arena, t.else_expr)),
        }),
        ExprKind::NullCoalesce(nc) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: arena.alloc(folder.fold_expr(arena, nc.left)),
            right: arena.alloc(folder.fold_expr(arena, nc.right)),
        }),
        ExprKind::FunctionCall(call) => ExprKind::FunctionCall(FunctionCallExpr {
            name: arena.alloc(folder.fold_expr(arena, call.name)),
            args: fold_args(folder, arena, &call.args),
        }),
        ExprKind::Array(elements) => {
            let mut new_elements = ArenaVec::with_capacity_in(elements.len(), arena);
            for elem in elements.iter() {
                new_elements.push(ArrayElement {
                    key: elem.key.as_ref().map(|k| folder.fold_expr(arena, k)),
                    value: folder.fold_expr(arena, &elem.value),
                    unpack: elem.unpack,
                    by_ref: elem.by_ref,
                    span: elem.span,
                });
            }
            ExprKind::Array(new_elements)
        }
        ExprKind::ArrayAccess(access) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: arena.alloc(folder.fold_expr(arena, access.array)),
            index: access
                .index
                .map(|i| &*arena.alloc(folder.fold_expr(arena, i))),
        }),
        ExprKind::Print(e) => ExprKind::Print(arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::Parenthesized(e) => {
            ExprKind::Parenthesized(arena.alloc(folder.fold_expr(arena, e)))
        }
        ExprKind::Cast(kind, e) => ExprKind::Cast(*kind, arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::ErrorSuppress(e) => {
            ExprKind::ErrorSuppress(arena.alloc(folder.fold_expr(arena, e)))
        }
        ExprKind::Isset(exprs) => ExprKind::Isset(fold_exprs(folder, arena, exprs)),
        ExprKind::Empty(e) => ExprKind::Empty(arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::Include(kind, e) => {
            ExprKind::Include(*kind, arena.alloc(folder.fold_expr(arena, e)))
        }
        ExprKind::Eval(e) => ExprKind::Eval(arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::Exit(e) => ExprKind::Exit(e.map(|e| &*arena.alloc(folder.fold_expr(arena, e)))),
        ExprKind::MagicConst(k) => ExprKind::MagicConst(*k),
        ExprKind::Clone(e) => ExprKind::Clone(arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::CloneWith(obj, overrides) => ExprKind::CloneWith(
            arena.alloc(folder.fold_expr(arena, obj)),
            arena.alloc(folder.fold_expr(arena, overrides)),
        ),
        ExprKind::New(new_expr) => ExprKind::New(NewExpr {
            class: arena.alloc(folder.fold_expr(arena, new_expr.class)),
            args: fold_args(folder, arena, &new_expr.args),
        }),
        ExprKind::PropertyAccess(access) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: arena.alloc(folder.fold_expr(arena, access.object)),
            property: arena.alloc(folder.fold_expr(arena, access.property)),
        }),
        ExprKind::NullsafePropertyAccess(access) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: arena.alloc(folder.fold_expr(arena, access.object)),
                property: arena.alloc(folder.fold_expr(arena, access.property)),
            })
        }
        ExprKind::MethodCall(call) => ExprKind::MethodCall(arena.alloc(MethodCallExpr {
            object: arena.alloc(folder.fold_expr(arena, call.object)),
            method: arena.alloc(folder.fold_expr(arena, call.method)),
            args: fold_args(folder, arena, &call.args),
        })),
        ExprKind::NullsafeMethodCall(call) => {
            ExprKind::NullsafeMethodCall(arena.alloc(MethodCallExpr {
                object: arena.alloc(folder.fold_expr(arena, call.object)),
                method: arena.alloc(folder.fold_expr(arena, call.method)),
                args: fold_args(folder, arena, &call.args),
            }))
        }
        ExprKind::StaticPropertyAccess(access) => {
            ExprKind::StaticPropertyAccess(StaticAccessExpr {
                class: arena.alloc(folder.fold_expr(arena, access.class)),
                member: arena.alloc(folder.fold_expr(arena, access.member)),
            })
        }
        ExprKind::StaticMethodCall(call) => {
            ExprKind::StaticMethodCall(arena.alloc(StaticMethodCallExpr {
                class: arena.alloc(folder.fold_expr(arena, call.class)),
                method: arena.alloc(folder.fold_expr(arena, call.method)),
                args: fold_args(folder, arena, &call.args),
            }))
        }
        ExprKind::StaticDynMethodCall(call) => {
            ExprKind::StaticDynMethodCall(arena.alloc(StaticDynMethodCallExpr {
                class: arena.alloc(folder.fold_expr(arena, call.class)),
                method: arena.alloc(folder.fold_expr(arena, call.method)),
                args: fold_args(folder, arena, &call.args),
            }))
        }
        ExprKind::ClassConstAccess(access) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: arena.alloc(folder.fold_expr(arena, access.class)),
            member: arena.alloc(folder.fold_expr(arena, access.member)),
        }),
        ExprKind::ClassConstAccessDynamic { class, member } => ExprKind::ClassConstAccessDynamic {
            class: arena.alloc(folder.fold_expr(arena, class)),
            member: arena.alloc(folder.fold_expr(arena, member)),
        },
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: arena.alloc(folder.fold_expr(arena, class)),
                member: arena.alloc(folder.fold_expr(arena, member)),
            }
        }
        ExprKind::Closure(closure) => {
            let mut use_vars = ArenaVec::with_capacity_in(closure.use_vars.len(), arena);
            for var in closure.use_vars.iter() {
                use_vars.push(folder.fold_closure_use_var(var));
            }
            let new_closure = arena.alloc(ClosureExpr {
                is_static: closure.is_static,
                by_ref: closure.by_ref,
                params: fold_params(folder, arena, &closure.params),
                use_vars,
                return_type: closure
                    .return_type
                    .as_ref()
                    .map(|t| folder.fold_type_hint(arena, t)),
                body: fold_stmts(folder, arena, &closure.body),
                attributes: fold_attrs(folder, arena, &closure.attributes),
            });
            ExprKind::Closure(new_closure)
        }
        ExprKind::ArrowFunction(arrow) => {
            let new_arrow = arena.alloc(ArrowFunctionExpr {
                is_static: arrow.is_static,
                by_ref: arrow.by_ref,
                params: fold_params(folder, arena, &arrow.params),
                return_type: arrow
                    .return_type
                    .as_ref()
                    .map(|t| folder.fold_type_hint(arena, t)),
                body: arena.alloc(folder.fold_expr(arena, arrow.body)),
                attributes: fold_attrs(folder, arena, &arrow.attributes),
            });
            ExprKind::ArrowFunction(new_arrow)
        }
        ExprKind::Match(match_expr) => ExprKind::Match(MatchExpr {
            subject: arena.alloc(folder.fold_expr(arena, match_expr.subject)),
            arms: {
                let mut arms = ArenaVec::with_capacity_in(match_expr.arms.len(), arena);
                for arm in match_expr.arms.iter() {
                    arms.push(folder.fold_match_arm(arena, arm));
                }
                arms
            },
        }),
        ExprKind::ThrowExpr(e) => ExprKind::ThrowExpr(arena.alloc(folder.fold_expr(arena, e))),
        ExprKind::Yield(y) => ExprKind::Yield(YieldExpr {
            key: y.key.map(|k| &*arena.alloc(folder.fold_expr(arena, k))),
            value: y.value.map(|v| &*arena.alloc(folder.fold_expr(arena, v))),
            is_from: y.is_from,
        }),
        ExprKind::AnonymousClass(class) => {
            ExprKind::AnonymousClass(arena.alloc(fold_class_decl(folder, arena, class)))
        }
        ExprKind::CallableCreate(cc) => {
            let kind = match &cc.kind {
                CallableCreateKind::Function(name) => {
                    CallableCreateKind::Function(arena.alloc(folder.fold_expr(arena, name)))
                }
                CallableCreateKind::Method { object, method } => CallableCreateKind::Method {
                    object: arena.alloc(folder.fold_expr(arena, object)),
                    method: arena.alloc(folder.fold_expr(arena, method)),
                },
                CallableCreateKind::NullsafeMethod { object, method } => {
                    CallableCreateKind::NullsafeMethod {
                        object: arena.alloc(folder.fold_expr(arena, object)),
                        method: arena.alloc(folder.fold_expr(arena, method)),
                    }
                }
                CallableCreateKind::StaticMethod { class, method } => {
                    CallableCreateKind::StaticMethod {
                        class: arena.alloc(folder.fold_expr(arena, class)),
                        method: arena.alloc(folder.fold_expr(arena, method)),
                    }
                }
            };
            ExprKind::CallableCreate(CallableCreateExpr { kind })
        }
        ExprKind::Omit => ExprKind::Omit,
        ExprKind::Error => ExprKind::Error,
    };
    Expr {
        kind,
        span: expr.span,
    }
}

pub fn fold_param<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    param: &Param<'_, 'src>,
) -> Param<'new, 'src> {
    Param {
        name: param.name,
        type_hint: param
            .type_hint
            .as_ref()
            .map(|t| folder.fold_type_hint(arena, t)),
        default: param.default.as_ref().map(|d| folder.fold_expr(arena, d)),
        by_ref: param.by_ref,
        variadic: param.variadic,
        is_readonly: param.is_readonly,
        is_final: param.is_final,
        visibility: param.visibility,
        set_visibility: param.set_visibility,
        attributes: fold_attrs(folder, arena, &param.attributes),
        hooks: fold_hooks(folder, arena, &param.hooks),
        span: param.span,
    }
}

pub fn fold_arg<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    arg: &Arg<'_, 'src>,
) -> Arg<'new, 'src> {
    Arg {
        name: arg.name.as_ref().map(|n| folder.fold_name(arena, n)),
        value: folder.fold_expr(arena, &arg.value),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

pub fn fold_class_member<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    member: &ClassMember<'_, 'src>,
) -> ClassMember<'new, 'src> {
    let kind = match &member.kind {
        ClassMemberKind::Property(prop) => {
            ClassMemberKind::Property(fold_property_decl(folder, arena, prop))
        }
        ClassMemberKind::Method(method) => {
            ClassMemberKind::Method(fold_method_decl(folder, arena, method))
        }
        ClassMemberKind::ClassConst(cc) => {
            ClassMemberKind::ClassConst(fold_class_const_decl(folder, arena, cc))
        }
        ClassMemberKind::TraitUse(tu) => {
            ClassMemberKind::TraitUse(folder.fold_trait_use(arena, tu))
        }
    };
    ClassMember {
        kind,
        span: member.span,
    }
}

pub fn fold_enum_member<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    member: &EnumMember<'_, 'src>,
) -> EnumMember<'new, 'src> {
    let kind = match &member.kind {
        EnumMemberKind::Case(case) => EnumMemberKind::Case(EnumCase {
            name: case.name,
            value: case.value.as_ref().map(|v| folder.fold_expr(arena, v)),
            attributes: fold_attrs(folder, arena, &case.attributes),
            doc_comment: case.doc_comment.as_ref().map(fold_comment),
        }),
        EnumMemberKind::Method(method) => {
            EnumMemberKind::Method(fold_method_decl(folder, arena, method))
        }
        EnumMemberKind::ClassConst(cc) => {
            EnumMemberKind::ClassConst(fold_class_const_decl(folder, arena, cc))
        }
        EnumMemberKind::TraitUse(tu) => EnumMemberKind::TraitUse(folder.fold_trait_use(arena, tu)),
    };
    EnumMember {
        kind,
        span: member.span,
    }
}

pub fn fold_property_hook<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    hook: &PropertyHook<'_, 'src>,
) -> PropertyHook<'new, 'src> {
    let body = match &hook.body {
        PropertyHookBody::Block(stmts) => PropertyHookBody::Block(fold_stmts(folder, arena, stmts)),
        PropertyHookBody::Expression(expr) => {
            PropertyHookBody::Expression(folder.fold_expr(arena, expr))
        }
        PropertyHookBody::Abstract => PropertyHookBody::Abstract,
    };
    PropertyHook {
        kind: hook.kind,
        body,
        is_final: hook.is_final,
        by_ref: hook.by_ref,
        params: fold_params(folder, arena, &hook.params),
        attributes: fold_attrs(folder, arena, &hook.attributes),
        span: hook.span,
    }
}

pub fn fold_type_hint<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    type_hint: &TypeHint<'_, 'src>,
) -> TypeHint<'new, 'src> {
    let kind = match &type_hint.kind {
        TypeHintKind::Named(name) => TypeHintKind::Named(folder.fold_name(arena, name)),
        TypeHintKind::Keyword(builtin, span) => TypeHintKind::Keyword(*builtin, *span),
        TypeHintKind::Nullable(inner) => {
            TypeHintKind::Nullable(arena.alloc(folder.fold_type_hint(arena, inner)))
        }
        TypeHintKind::Union(types) => {
            let mut new_types = ArenaVec::with_capacity_in(types.len(), arena);
            for t in types.iter() {
                new_types.push(folder.fold_type_hint(arena, t));
            }
            TypeHintKind::Union(new_types)
        }
        TypeHintKind::Intersection(types) => {
            let mut new_types = ArenaVec::with_capacity_in(types.len(), arena);
            for t in types.iter() {
                new_types.push(folder.fold_type_hint(arena, t));
            }
            TypeHintKind::Intersection(new_types)
        }
    };
    TypeHint {
        kind,
        span: type_hint.span,
    }
}

pub fn fold_attribute<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    attribute: &Attribute<'_, 'src>,
) -> Attribute<'new, 'src> {
    Attribute {
        name: folder.fold_name(arena, &attribute.name),
        args: fold_args(folder, arena, &attribute.args),
        span: attribute.span,
    }
}

pub fn fold_catch_clause<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    catch: &CatchClause<'_, 'src>,
) -> CatchClause<'new, 'src> {
    let mut types = ArenaVec::with_capacity_in(catch.types.len(), arena);
    for ty in catch.types.iter() {
        types.push(folder.fold_name(arena, ty));
    }
    CatchClause {
        types,
        var: catch.var,
        body: fold_stmts(folder, arena, &catch.body),
        span: catch.span,
    }
}

pub fn fold_match_arm<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    arm: &MatchArm<'_, 'src>,
) -> MatchArm<'new, 'src> {
    let conditions = arm.conditions.as_ref().map(|conds| {
        let mut new_conds = ArenaVec::with_capacity_in(conds.len(), arena);
        for c in conds.iter() {
            new_conds.push(folder.fold_expr(arena, c));
        }
        new_conds
    });
    MatchArm {
        conditions,
        body: folder.fold_expr(arena, &arm.body),
        span: arm.span,
    }
}

pub fn fold_trait_use<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    trait_use: &TraitUseDecl<'_, 'src>,
) -> TraitUseDecl<'new, 'src> {
    let mut traits = ArenaVec::with_capacity_in(trait_use.traits.len(), arena);
    for t in trait_use.traits.iter() {
        traits.push(folder.fold_name(arena, t));
    }
    let mut adaptations = ArenaVec::with_capacity_in(trait_use.adaptations.len(), arena);
    for a in trait_use.adaptations.iter() {
        adaptations.push(folder.fold_trait_adaptation(arena, a));
    }
    TraitUseDecl {
        traits,
        adaptations,
    }
}

pub fn fold_trait_adaptation<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    adaptation: &TraitAdaptation<'_, 'src>,
) -> TraitAdaptation<'new, 'src> {
    let kind = match &adaptation.kind {
        TraitAdaptationKind::Precedence {
            trait_name,
            method,
            insteadof,
        } => {
            let mut new_insteadof = ArenaVec::with_capacity_in(insteadof.len(), arena);
            for n in insteadof.iter() {
                new_insteadof.push(folder.fold_name(arena, n));
            }
            TraitAdaptationKind::Precedence {
                trait_name: folder.fold_name(arena, trait_name),
                method: folder.fold_name(arena, method),
                insteadof: new_insteadof,
            }
        }
        TraitAdaptationKind::Alias {
            trait_name,
            method,
            new_modifier,
            new_name,
        } => TraitAdaptationKind::Alias {
            trait_name: trait_name.as_ref().map(|n| folder.fold_name(arena, n)),
            method: folder.fold_name(arena, method),
            new_modifier: *new_modifier,
            new_name: new_name.as_ref().map(|n| folder.fold_name(arena, n)),
        },
    };
    TraitAdaptation {
        kind,
        span: adaptation.span,
    }
}

pub fn fold_name<'new, 'src, F: Fold<'src> + ?Sized>(
    _folder: &mut F,
    arena: &'new Bump,
    name: &Name<'_, 'src>,
) -> Name<'new, 'src> {
    match name {
        Name::Simple { value, span } => Name::Simple { value, span: *span },
        Name::Complex { parts, kind, span } => {
            let mut new_parts = ArenaVec::with_capacity_in(parts.len(), arena);
            for &part in parts.iter() {
                new_parts.push(part);
            }
            Name::Complex {
                parts: new_parts,
                kind: *kind,
                span: *span,
            }
        }
        Name::Error { span } => Name::Error { span: *span },
    }
}

// =============================================================================
// Private helpers — complex declaration types
// =============================================================================

fn fold_function_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    func: &FunctionDecl<'_, 'src>,
) -> FunctionDecl<'new, 'src> {
    FunctionDecl {
        name: func.name,
        params: fold_params(folder, arena, &func.params),
        body: fold_stmts(folder, arena, &func.body),
        return_type: func
            .return_type
            .as_ref()
            .map(|t| folder.fold_type_hint(arena, t)),
        by_ref: func.by_ref,
        attributes: fold_attrs(folder, arena, &func.attributes),
        doc_comment: func.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_method_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    method: &MethodDecl<'_, 'src>,
) -> MethodDecl<'new, 'src> {
    MethodDecl {
        name: method.name,
        visibility: method.visibility,
        is_static: method.is_static,
        is_abstract: method.is_abstract,
        is_final: method.is_final,
        by_ref: method.by_ref,
        params: fold_params(folder, arena, &method.params),
        return_type: method
            .return_type
            .as_ref()
            .map(|t| folder.fold_type_hint(arena, t)),
        body: method.body.as_ref().map(|b| fold_stmts(folder, arena, b)),
        attributes: fold_attrs(folder, arena, &method.attributes),
        doc_comment: method.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_property_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    prop: &PropertyDecl<'_, 'src>,
) -> PropertyDecl<'new, 'src> {
    PropertyDecl {
        name: prop.name,
        visibility: prop.visibility,
        set_visibility: prop.set_visibility,
        is_static: prop.is_static,
        is_readonly: prop.is_readonly,
        type_hint: prop
            .type_hint
            .as_ref()
            .map(|t| folder.fold_type_hint(arena, t)),
        default: prop.default.as_ref().map(|d| folder.fold_expr(arena, d)),
        attributes: fold_attrs(folder, arena, &prop.attributes),
        hooks: fold_hooks(folder, arena, &prop.hooks),
        doc_comment: prop.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_class_const_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    cc: &ClassConstDecl<'_, 'src>,
) -> ClassConstDecl<'new, 'src> {
    ClassConstDecl {
        name: cc.name,
        visibility: cc.visibility,
        is_final: cc.is_final,
        type_hint: cc
            .type_hint
            .map(|t| &*arena.alloc(folder.fold_type_hint(arena, t))),
        value: folder.fold_expr(arena, &cc.value),
        attributes: fold_attrs(folder, arena, &cc.attributes),
        doc_comment: cc.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_class_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    class: &ClassDecl<'_, 'src>,
) -> ClassDecl<'new, 'src> {
    let mut members = ArenaVec::with_capacity_in(class.members.len(), arena);
    for member in class.members.iter() {
        members.push(folder.fold_class_member(arena, member));
    }
    ClassDecl {
        name: class.name,
        modifiers: class.modifiers.clone(),
        extends: class.extends.as_ref().map(|n| folder.fold_name(arena, n)),
        implements: {
            let mut v = ArenaVec::with_capacity_in(class.implements.len(), arena);
            for n in class.implements.iter() {
                v.push(folder.fold_name(arena, n));
            }
            v
        },
        members,
        attributes: fold_attrs(folder, arena, &class.attributes),
        doc_comment: class.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_interface_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    iface: &InterfaceDecl<'_, 'src>,
) -> InterfaceDecl<'new, 'src> {
    let mut extends = ArenaVec::with_capacity_in(iface.extends.len(), arena);
    for n in iface.extends.iter() {
        extends.push(folder.fold_name(arena, n));
    }
    let mut members = ArenaVec::with_capacity_in(iface.members.len(), arena);
    for member in iface.members.iter() {
        members.push(folder.fold_class_member(arena, member));
    }
    InterfaceDecl {
        name: iface.name,
        extends,
        members,
        attributes: fold_attrs(folder, arena, &iface.attributes),
        doc_comment: iface.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_trait_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    t: &TraitDecl<'_, 'src>,
) -> TraitDecl<'new, 'src> {
    let mut members = ArenaVec::with_capacity_in(t.members.len(), arena);
    for member in t.members.iter() {
        members.push(folder.fold_class_member(arena, member));
    }
    TraitDecl {
        name: t.name,
        members,
        attributes: fold_attrs(folder, arena, &t.attributes),
        doc_comment: t.doc_comment.as_ref().map(fold_comment),
    }
}

fn fold_enum_decl<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    e: &EnumDecl<'_, 'src>,
) -> EnumDecl<'new, 'src> {
    let mut members = ArenaVec::with_capacity_in(e.members.len(), arena);
    for member in e.members.iter() {
        members.push(folder.fold_enum_member(arena, member));
    }
    EnumDecl {
        name: e.name,
        scalar_type: e.scalar_type.as_ref().map(|n| folder.fold_name(arena, n)),
        implements: {
            let mut v = ArenaVec::with_capacity_in(e.implements.len(), arena);
            for n in e.implements.iter() {
                v.push(folder.fold_name(arena, n));
            }
            v
        },
        members,
        attributes: fold_attrs(folder, arena, &e.attributes),
        doc_comment: e.doc_comment.as_ref().map(fold_comment),
    }
}

// =============================================================================
// Private helpers — collection folding
// =============================================================================

fn fold_stmts<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    stmts: &[Stmt<'_, 'src>],
) -> ArenaVec<'new, Stmt<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(stmts.len(), arena);
    for stmt in stmts {
        vec.push(folder.fold_stmt(arena, stmt));
    }
    vec
}

fn fold_exprs<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    exprs: &[Expr<'_, 'src>],
) -> ArenaVec<'new, Expr<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(exprs.len(), arena);
    for expr in exprs {
        vec.push(folder.fold_expr(arena, expr));
    }
    vec
}

fn fold_args<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    args: &[Arg<'_, 'src>],
) -> ArenaVec<'new, Arg<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(args.len(), arena);
    for arg in args {
        vec.push(folder.fold_arg(arena, arg));
    }
    vec
}

fn fold_params<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    params: &[Param<'_, 'src>],
) -> ArenaVec<'new, Param<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(params.len(), arena);
    for param in params {
        vec.push(folder.fold_param(arena, param));
    }
    vec
}

fn fold_attrs<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    attrs: &[Attribute<'_, 'src>],
) -> ArenaVec<'new, Attribute<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(attrs.len(), arena);
    for attr in attrs {
        vec.push(folder.fold_attribute(arena, attr));
    }
    vec
}

fn fold_hooks<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    hooks: &[PropertyHook<'_, 'src>],
) -> ArenaVec<'new, PropertyHook<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(hooks.len(), arena);
    for hook in hooks {
        vec.push(folder.fold_property_hook(arena, hook));
    }
    vec
}

fn fold_string_parts<'new, 'src, F: Fold<'src> + ?Sized>(
    folder: &mut F,
    arena: &'new Bump,
    parts: &[StringPart<'_, 'src>],
) -> ArenaVec<'new, StringPart<'new, 'src>> {
    let mut vec = ArenaVec::with_capacity_in(parts.len(), arena);
    for part in parts {
        vec.push(match part {
            StringPart::Literal(s) => StringPart::Literal(arena.alloc_str(s)),
            StringPart::Expr(e) => StringPart::Expr(folder.fold_expr(arena, e)),
        });
    }
    vec
}

// =============================================================================
// Private helpers — leaf types
// =============================================================================

pub fn fold_name_str<'new, 'src>(
    name: NameStr<'_, 'src>,
    arena: &'new Bump,
) -> NameStr<'new, 'src> {
    if let Some(s) = name.__into_src_str() {
        NameStr::__src(s)
    } else {
        NameStr::__arena(arena.alloc_str(name.as_str()))
    }
}

fn fold_comment<'src>(comment: &Comment<'src>) -> Comment<'src> {
    Comment {
        kind: comment.kind,
        text: comment.text,
        span: comment.span,
    }
}
