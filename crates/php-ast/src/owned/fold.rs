//! Owned AST transformation via the [`FoldOwned`] trait.
//!
//! [`FoldOwned`] is the transformation counterpart of [`super::visitor::OwnedVisitor`].
//! Where `OwnedVisitor` reads nodes in place, `FoldOwned` rebuilds them — reading
//! from an input node (borrowed) and returning a new owned value. Override only the
//! node types you want to change; all others are rebuilt identically by the default
//! implementations (equivalent to `Clone`).
//!
//! # Example
//!
//! ```
//! use php_ast::owned::fold::{FoldOwned, fold_owned_expr};
//! use php_ast::owned::{Expr, ExprKind};
//!
//! struct NegateInts;
//!
//! impl FoldOwned for NegateInts {
//!     fn fold_expr(&mut self, expr: &Expr) -> Expr {
//!         if let ExprKind::Int(n) = &expr.kind {
//!             return Expr { kind: ExprKind::Int(-n), span: expr.span };
//!         }
//!         fold_owned_expr(self, expr)
//!     }
//! }
//! ```

use super::*;

// =============================================================================
// FoldOwned trait
// =============================================================================

/// Trait for transforming owned PHP AST nodes.
///
/// All methods have identity-fold default implementations that call the
/// corresponding free `fold_owned_*` function. Override only the node types
/// you want to change; the rest recurse automatically.
pub trait FoldOwned {
    fn fold_program(&mut self, program: &Program) -> Program {
        fold_owned_program(self, program)
    }

    fn fold_stmt(&mut self, stmt: &Stmt) -> Stmt {
        fold_owned_stmt(self, stmt)
    }

    fn fold_expr(&mut self, expr: &Expr) -> Expr {
        fold_owned_expr(self, expr)
    }

    fn fold_param(&mut self, param: &Param) -> Param {
        fold_owned_param(self, param)
    }

    fn fold_arg(&mut self, arg: &Arg) -> Arg {
        fold_owned_arg(self, arg)
    }

    fn fold_class_member(&mut self, member: &ClassMember) -> ClassMember {
        fold_owned_class_member(self, member)
    }

    fn fold_enum_member(&mut self, member: &EnumMember) -> EnumMember {
        fold_owned_enum_member(self, member)
    }

    fn fold_property_hook(&mut self, hook: &PropertyHook) -> PropertyHook {
        fold_owned_property_hook(self, hook)
    }

    fn fold_type_hint(&mut self, type_hint: &TypeHint) -> TypeHint {
        fold_owned_type_hint(self, type_hint)
    }

    fn fold_attribute(&mut self, attribute: &Attribute) -> Attribute {
        fold_owned_attribute(self, attribute)
    }

    fn fold_catch_clause(&mut self, catch: &CatchClause) -> CatchClause {
        fold_owned_catch_clause(self, catch)
    }

    fn fold_match_arm(&mut self, arm: &MatchArm) -> MatchArm {
        fold_owned_match_arm(self, arm)
    }

    fn fold_closure_use_var(&mut self, var: &ClosureUseVar) -> ClosureUseVar {
        fold_owned_closure_use_var(self, var)
    }

    fn fold_name(&mut self, name: &Name) -> Name {
        fold_owned_name(self, name)
    }
}

// =============================================================================
// Free fold functions
// =============================================================================

pub fn fold_owned_program<F: FoldOwned + ?Sized>(folder: &mut F, program: &Program) -> Program {
    Program {
        stmts: program.stmts.iter().map(|s| folder.fold_stmt(s)).collect(),
        span: program.span,
    }
}

pub fn fold_owned_stmt<F: FoldOwned + ?Sized>(folder: &mut F, stmt: &Stmt) -> Stmt {
    Stmt {
        kind: fold_owned_stmt_kind(folder, &stmt.kind),
        span: stmt.span,
    }
}

fn fold_owned_stmts<F: FoldOwned + ?Sized>(folder: &mut F, stmts: &[Stmt]) -> Box<[Stmt]> {
    stmts.iter().map(|s| folder.fold_stmt(s)).collect()
}

fn fold_owned_exprs<F: FoldOwned + ?Sized>(folder: &mut F, exprs: &[Expr]) -> Box<[Expr]> {
    exprs.iter().map(|e| folder.fold_expr(e)).collect()
}

fn fold_owned_args<F: FoldOwned + ?Sized>(folder: &mut F, args: &[Arg]) -> Box<[Arg]> {
    args.iter().map(|a| folder.fold_arg(a)).collect()
}

fn fold_owned_attrs<F: FoldOwned + ?Sized>(
    folder: &mut F,
    attrs: &[Attribute],
) -> Box<[Attribute]> {
    attrs.iter().map(|a| folder.fold_attribute(a)).collect()
}

fn fold_owned_params<F: FoldOwned + ?Sized>(folder: &mut F, params: &[Param]) -> Box<[Param]> {
    params.iter().map(|p| folder.fold_param(p)).collect()
}

fn fold_owned_hooks<F: FoldOwned + ?Sized>(
    folder: &mut F,
    hooks: &[PropertyHook],
) -> Box<[PropertyHook]> {
    hooks.iter().map(|h| folder.fold_property_hook(h)).collect()
}

fn fold_owned_members<F: FoldOwned + ?Sized>(
    folder: &mut F,
    members: &[ClassMember],
) -> Box<[ClassMember]> {
    members
        .iter()
        .map(|m| folder.fold_class_member(m))
        .collect()
}

fn fold_owned_string_parts<F: FoldOwned + ?Sized>(
    folder: &mut F,
    parts: &[StringPart],
) -> Box<[StringPart]> {
    parts
        .iter()
        .map(|p| match p {
            StringPart::Literal(s) => StringPart::Literal(s.clone()),
            StringPart::Expr(e) => StringPart::Expr(folder.fold_expr(e)),
        })
        .collect()
}

fn fold_owned_stmt_kind<F: FoldOwned + ?Sized>(folder: &mut F, k: &StmtKind) -> StmtKind {
    match k {
        StmtKind::Expression(e) => StmtKind::Expression(Box::new(folder.fold_expr(e))),
        StmtKind::Echo(exprs) => StmtKind::Echo(fold_owned_exprs(folder, exprs)),
        StmtKind::Return(e) => StmtKind::Return(e.as_ref().map(|e| Box::new(folder.fold_expr(e)))),
        StmtKind::Block(stmts) => StmtKind::Block(fold_owned_stmts(folder, stmts)),
        StmtKind::If(s) => StmtKind::If(Box::new(IfStmt {
            condition: folder.fold_expr(&s.condition),
            then_branch: Box::new(folder.fold_stmt(&s.then_branch)),
            elseif_branches: s
                .elseif_branches
                .iter()
                .map(|b| ElseIfBranch {
                    condition: folder.fold_expr(&b.condition),
                    body: folder.fold_stmt(&b.body),
                    span: b.span,
                })
                .collect(),
            else_branch: s
                .else_branch
                .as_ref()
                .map(|b| Box::new(folder.fold_stmt(b))),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::While(s) => StmtKind::While(Box::new(WhileStmt {
            condition: folder.fold_expr(&s.condition),
            body: Box::new(folder.fold_stmt(&s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::For(s) => StmtKind::For(Box::new(ForStmt {
            init: fold_owned_exprs(folder, &s.init),
            condition: fold_owned_exprs(folder, &s.condition),
            update: fold_owned_exprs(folder, &s.update),
            body: Box::new(folder.fold_stmt(&s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::Foreach(s) => StmtKind::Foreach(Box::new(ForeachStmt {
            expr: folder.fold_expr(&s.expr),
            key: s.key.as_ref().map(|e| folder.fold_expr(e)),
            value: folder.fold_expr(&s.value),
            body: Box::new(folder.fold_stmt(&s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::DoWhile(s) => StmtKind::DoWhile(Box::new(DoWhileStmt {
            body: Box::new(folder.fold_stmt(&s.body)),
            condition: folder.fold_expr(&s.condition),
        })),
        StmtKind::Function(f) => StmtKind::Function(Box::new(FunctionDecl {
            name: f.name.clone(),
            params: fold_owned_params(folder, &f.params),
            body: fold_owned_stmts(folder, &f.body),
            return_type: f.return_type.as_ref().map(|t| folder.fold_type_hint(t)),
            by_ref: f.by_ref,
            attributes: fold_owned_attrs(folder, &f.attributes),
            doc_comment: f.doc_comment.clone(),
        })),
        StmtKind::Break(e) => StmtKind::Break(e.as_ref().map(|e| Box::new(folder.fold_expr(e)))),
        StmtKind::Continue(e) => {
            StmtKind::Continue(e.as_ref().map(|e| Box::new(folder.fold_expr(e))))
        }
        StmtKind::Switch(s) => StmtKind::Switch(Box::new(SwitchStmt {
            expr: folder.fold_expr(&s.expr),
            cases: s
                .cases
                .iter()
                .map(|c| SwitchCase {
                    value: c.value.as_ref().map(|v| folder.fold_expr(v)),
                    body: fold_owned_stmts(folder, &c.body),
                    span: c.span,
                })
                .collect(),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::Goto(ident) => StmtKind::Goto(ident.clone()),
        StmtKind::Label(s) => StmtKind::Label(s.clone()),
        StmtKind::Declare(d) => StmtKind::Declare(Box::new(DeclareStmt {
            directives: d
                .directives
                .iter()
                .map(|(k, v)| (k.clone(), folder.fold_expr(v)))
                .collect(),
            body: d.body.as_ref().map(|b| Box::new(folder.fold_stmt(b))),
            uses_alternative: d.uses_alternative,
        })),
        StmtKind::Unset(exprs) => StmtKind::Unset(fold_owned_exprs(folder, exprs)),
        StmtKind::Throw(e) => StmtKind::Throw(Box::new(folder.fold_expr(e))),
        StmtKind::TryCatch(t) => StmtKind::TryCatch(Box::new(TryCatchStmt {
            body: fold_owned_stmts(folder, &t.body),
            catches: t
                .catches
                .iter()
                .map(|c| folder.fold_catch_clause(c))
                .collect(),
            finally: t
                .finally
                .as_ref()
                .map(|stmts| fold_owned_stmts(folder, stmts)),
        })),
        StmtKind::Global(exprs) => StmtKind::Global(fold_owned_exprs(folder, exprs)),
        StmtKind::Class(cls) => StmtKind::Class(Box::new(fold_owned_class_decl(folder, cls))),
        StmtKind::Interface(iface) => {
            StmtKind::Interface(Box::new(fold_owned_interface_decl(folder, iface)))
        }
        StmtKind::Trait(tr) => StmtKind::Trait(Box::new(fold_owned_trait_decl(folder, tr))),
        StmtKind::Enum(en) => StmtKind::Enum(Box::new(fold_owned_enum_decl(folder, en))),
        StmtKind::Namespace(ns) => StmtKind::Namespace(Box::new(NamespaceDecl {
            name: ns.name.as_ref().map(|n| folder.fold_name(n)),
            body: match &ns.body {
                NamespaceBody::Braced(stmts) => {
                    NamespaceBody::Braced(fold_owned_stmts(folder, stmts))
                }
                NamespaceBody::Simple => NamespaceBody::Simple,
            },
        })),
        StmtKind::Use(u) => StmtKind::Use(Box::new(UseDecl {
            kind: u.kind,
            uses: u
                .uses
                .iter()
                .map(|item| UseItem {
                    name: folder.fold_name(&item.name),
                    alias: item.alias.clone(),
                    kind: item.kind,
                    span: item.span,
                })
                .collect(),
        })),
        StmtKind::Const(items) => StmtKind::Const(
            items
                .iter()
                .map(|item| ConstItem {
                    name: item.name.clone(),
                    value: folder.fold_expr(&item.value),
                    attributes: fold_owned_attrs(folder, &item.attributes),
                    span: item.span,
                    doc_comment: item.doc_comment.clone(),
                })
                .collect(),
        ),
        StmtKind::StaticVar(vars) => StmtKind::StaticVar(
            vars.iter()
                .map(|v| StaticVar {
                    name: v.name.clone(),
                    default: v.default.as_ref().map(|e| folder.fold_expr(e)),
                    span: v.span,
                })
                .collect(),
        ),
        StmtKind::HaltCompiler(s) => StmtKind::HaltCompiler(s.clone()),
        StmtKind::Nop => StmtKind::Nop,
        StmtKind::InlineHtml(s) => StmtKind::InlineHtml(s.clone()),
        StmtKind::Error => StmtKind::Error,
    }
}

pub fn fold_owned_expr<F: FoldOwned + ?Sized>(folder: &mut F, expr: &Expr) -> Expr {
    Expr {
        kind: fold_owned_expr_kind(folder, &expr.kind),
        span: expr.span,
    }
}

fn fold_owned_expr_kind<F: FoldOwned + ?Sized>(folder: &mut F, k: &ExprKind) -> ExprKind {
    match k {
        ExprKind::Int(v) => ExprKind::Int(*v),
        ExprKind::Float(v) => ExprKind::Float(*v),
        ExprKind::String(s) => ExprKind::String(s.clone()),
        ExprKind::InterpolatedString(parts) => {
            ExprKind::InterpolatedString(fold_owned_string_parts(folder, parts))
        }
        ExprKind::Heredoc { label, parts } => ExprKind::Heredoc {
            label: label.clone(),
            parts: fold_owned_string_parts(folder, parts),
        },
        ExprKind::Nowdoc { label, value } => ExprKind::Nowdoc {
            label: label.clone(),
            value: value.clone(),
        },
        ExprKind::ShellExec(parts) => ExprKind::ShellExec(fold_owned_string_parts(folder, parts)),
        ExprKind::Bool(v) => ExprKind::Bool(*v),
        ExprKind::Null => ExprKind::Null,
        ExprKind::Variable(s) => ExprKind::Variable(s.clone()),
        ExprKind::VariableVariable(inner) => {
            ExprKind::VariableVariable(Box::new(folder.fold_expr(inner)))
        }
        ExprKind::Identifier(s) => ExprKind::Identifier(s.clone()),
        ExprKind::Assign(a) => ExprKind::Assign(AssignExpr {
            target: Box::new(folder.fold_expr(&a.target)),
            op: a.op,
            value: Box::new(folder.fold_expr(&a.value)),
            by_ref: a.by_ref,
        }),
        ExprKind::Binary(b) => ExprKind::Binary(BinaryExpr {
            left: Box::new(folder.fold_expr(&b.left)),
            op: b.op,
            right: Box::new(folder.fold_expr(&b.right)),
        }),
        ExprKind::UnaryPrefix(u) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: u.op,
            operand: Box::new(folder.fold_expr(&u.operand)),
        }),
        ExprKind::UnaryPostfix(u) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            operand: Box::new(folder.fold_expr(&u.operand)),
            op: u.op,
        }),
        ExprKind::Ternary(t) => ExprKind::Ternary(TernaryExpr {
            condition: Box::new(folder.fold_expr(&t.condition)),
            then_expr: t.then_expr.as_ref().map(|e| Box::new(folder.fold_expr(e))),
            else_expr: Box::new(folder.fold_expr(&t.else_expr)),
        }),
        ExprKind::NullCoalesce(n) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: Box::new(folder.fold_expr(&n.left)),
            right: Box::new(folder.fold_expr(&n.right)),
        }),
        ExprKind::FunctionCall(f) => ExprKind::FunctionCall(FunctionCallExpr {
            name: Box::new(folder.fold_expr(&f.name)),
            args: fold_owned_args(folder, &f.args),
        }),
        ExprKind::Array(elems) => ExprKind::Array(
            elems
                .iter()
                .map(|e| ArrayElement {
                    key: e.key.as_ref().map(|k| folder.fold_expr(k)),
                    value: folder.fold_expr(&e.value),
                    unpack: e.unpack,
                    by_ref: e.by_ref,
                    span: e.span,
                })
                .collect(),
        ),
        ExprKind::ArrayAccess(a) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: Box::new(folder.fold_expr(&a.array)),
            index: a.index.as_ref().map(|e| Box::new(folder.fold_expr(e))),
        }),
        ExprKind::Print(e) => ExprKind::Print(Box::new(folder.fold_expr(e))),
        ExprKind::Parenthesized(e) => ExprKind::Parenthesized(Box::new(folder.fold_expr(e))),
        ExprKind::Cast(kind, e) => ExprKind::Cast(*kind, Box::new(folder.fold_expr(e))),
        ExprKind::ErrorSuppress(e) => ExprKind::ErrorSuppress(Box::new(folder.fold_expr(e))),
        ExprKind::Isset(exprs) => ExprKind::Isset(fold_owned_exprs(folder, exprs)),
        ExprKind::Empty(e) => ExprKind::Empty(Box::new(folder.fold_expr(e))),
        ExprKind::Include(kind, e) => ExprKind::Include(*kind, Box::new(folder.fold_expr(e))),
        ExprKind::Eval(e) => ExprKind::Eval(Box::new(folder.fold_expr(e))),
        ExprKind::Exit(e) => ExprKind::Exit(e.as_ref().map(|e| Box::new(folder.fold_expr(e)))),
        ExprKind::MagicConst(m) => ExprKind::MagicConst(*m),
        ExprKind::Clone(e) => ExprKind::Clone(Box::new(folder.fold_expr(e))),
        ExprKind::CloneWith(obj, props) => ExprKind::CloneWith(
            Box::new(folder.fold_expr(obj)),
            Box::new(folder.fold_expr(props)),
        ),
        ExprKind::New(n) => ExprKind::New(NewExpr {
            class: Box::new(folder.fold_expr(&n.class)),
            args: fold_owned_args(folder, &n.args),
        }),
        ExprKind::PropertyAccess(p) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: Box::new(folder.fold_expr(&p.object)),
            property: Box::new(folder.fold_expr(&p.property)),
        }),
        ExprKind::NullsafePropertyAccess(p) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: Box::new(folder.fold_expr(&p.object)),
                property: Box::new(folder.fold_expr(&p.property)),
            })
        }
        ExprKind::MethodCall(m) => ExprKind::MethodCall(Box::new(MethodCallExpr {
            object: Box::new(folder.fold_expr(&m.object)),
            method: Box::new(folder.fold_expr(&m.method)),
            args: fold_owned_args(folder, &m.args),
        })),
        ExprKind::NullsafeMethodCall(m) => ExprKind::NullsafeMethodCall(Box::new(MethodCallExpr {
            object: Box::new(folder.fold_expr(&m.object)),
            method: Box::new(folder.fold_expr(&m.method)),
            args: fold_owned_args(folder, &m.args),
        })),
        ExprKind::StaticPropertyAccess(s) => ExprKind::StaticPropertyAccess(StaticAccessExpr {
            class: Box::new(folder.fold_expr(&s.class)),
            member: Box::new(folder.fold_expr(&s.member)),
        }),
        ExprKind::StaticMethodCall(s) => {
            ExprKind::StaticMethodCall(Box::new(StaticMethodCallExpr {
                class: Box::new(folder.fold_expr(&s.class)),
                method: Box::new(folder.fold_expr(&s.method)),
                args: fold_owned_args(folder, &s.args),
            }))
        }
        ExprKind::StaticDynMethodCall(s) => {
            ExprKind::StaticDynMethodCall(Box::new(StaticDynMethodCallExpr {
                class: Box::new(folder.fold_expr(&s.class)),
                method: Box::new(folder.fold_expr(&s.method)),
                args: fold_owned_args(folder, &s.args),
            }))
        }
        ExprKind::ClassConstAccess(s) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: Box::new(folder.fold_expr(&s.class)),
            member: Box::new(folder.fold_expr(&s.member)),
        }),
        ExprKind::ClassConstAccessDynamic { class, member } => ExprKind::ClassConstAccessDynamic {
            class: Box::new(folder.fold_expr(class)),
            member: Box::new(folder.fold_expr(member)),
        },
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: Box::new(folder.fold_expr(class)),
                member: Box::new(folder.fold_expr(member)),
            }
        }
        ExprKind::Closure(c) => ExprKind::Closure(Box::new(ClosureExpr {
            is_static: c.is_static,
            by_ref: c.by_ref,
            params: fold_owned_params(folder, &c.params),
            use_vars: c
                .use_vars
                .iter()
                .map(|v| folder.fold_closure_use_var(v))
                .collect(),
            return_type: c.return_type.as_ref().map(|t| folder.fold_type_hint(t)),
            body: fold_owned_stmts(folder, &c.body),
            attributes: fold_owned_attrs(folder, &c.attributes),
        })),
        ExprKind::ArrowFunction(f) => ExprKind::ArrowFunction(Box::new(ArrowFunctionExpr {
            is_static: f.is_static,
            by_ref: f.by_ref,
            params: fold_owned_params(folder, &f.params),
            return_type: f.return_type.as_ref().map(|t| folder.fold_type_hint(t)),
            body: Box::new(folder.fold_expr(&f.body)),
            attributes: fold_owned_attrs(folder, &f.attributes),
        })),
        ExprKind::Match(m) => ExprKind::Match(MatchExpr {
            subject: Box::new(folder.fold_expr(&m.subject)),
            arms: m
                .arms
                .iter()
                .map(|arm| folder.fold_match_arm(arm))
                .collect(),
        }),
        ExprKind::ThrowExpr(e) => ExprKind::ThrowExpr(Box::new(folder.fold_expr(e))),
        ExprKind::Yield(y) => ExprKind::Yield(YieldExpr {
            key: y.key.as_ref().map(|e| Box::new(folder.fold_expr(e))),
            value: y.value.as_ref().map(|e| Box::new(folder.fold_expr(e))),
            is_from: y.is_from,
        }),
        ExprKind::AnonymousClass(cls) => {
            ExprKind::AnonymousClass(Box::new(fold_owned_class_decl(folder, cls)))
        }
        ExprKind::CallableCreate(c) => ExprKind::CallableCreate(CallableCreateExpr {
            kind: match &c.kind {
                CallableCreateKind::Function(e) => {
                    CallableCreateKind::Function(Box::new(folder.fold_expr(e)))
                }
                CallableCreateKind::Method { object, method } => CallableCreateKind::Method {
                    object: Box::new(folder.fold_expr(object)),
                    method: Box::new(folder.fold_expr(method)),
                },
                CallableCreateKind::NullsafeMethod { object, method } => {
                    CallableCreateKind::NullsafeMethod {
                        object: Box::new(folder.fold_expr(object)),
                        method: Box::new(folder.fold_expr(method)),
                    }
                }
                CallableCreateKind::StaticMethod { class, method } => {
                    CallableCreateKind::StaticMethod {
                        class: Box::new(folder.fold_expr(class)),
                        method: Box::new(folder.fold_expr(method)),
                    }
                }
            },
        }),
        ExprKind::Omit => ExprKind::Omit,
        ExprKind::Error => ExprKind::Error,
    }
}

pub fn fold_owned_param<F: FoldOwned + ?Sized>(folder: &mut F, p: &Param) -> Param {
    Param {
        name: p.name.clone(),
        type_hint: p.type_hint.as_ref().map(|t| folder.fold_type_hint(t)),
        default: p.default.as_ref().map(|e| folder.fold_expr(e)),
        by_ref: p.by_ref,
        variadic: p.variadic,
        is_readonly: p.is_readonly,
        is_final: p.is_final,
        visibility: p.visibility,
        set_visibility: p.set_visibility,
        attributes: fold_owned_attrs(folder, &p.attributes),
        hooks: fold_owned_hooks(folder, &p.hooks),
        span: p.span,
    }
}

pub fn fold_owned_arg<F: FoldOwned + ?Sized>(folder: &mut F, arg: &Arg) -> Arg {
    Arg {
        name: arg.name.as_ref().map(|n| folder.fold_name(n)),
        value: folder.fold_expr(&arg.value),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

pub fn fold_owned_closure_use_var<F: FoldOwned + ?Sized>(
    _folder: &mut F,
    var: &ClosureUseVar,
) -> ClosureUseVar {
    var.clone()
}

pub fn fold_owned_name<F: FoldOwned + ?Sized>(_folder: &mut F, name: &Name) -> Name {
    name.clone()
}

pub fn fold_owned_class_member<F: FoldOwned + ?Sized>(
    folder: &mut F,
    member: &ClassMember,
) -> ClassMember {
    ClassMember {
        kind: match &member.kind {
            ClassMemberKind::Property(p) => ClassMemberKind::Property(PropertyDecl {
                name: p.name.clone(),
                visibility: p.visibility,
                set_visibility: p.set_visibility,
                is_static: p.is_static,
                is_readonly: p.is_readonly,
                type_hint: p.type_hint.as_ref().map(|t| folder.fold_type_hint(t)),
                default: p.default.as_ref().map(|e| folder.fold_expr(e)),
                attributes: fold_owned_attrs(folder, &p.attributes),
                hooks: fold_owned_hooks(folder, &p.hooks),
                doc_comment: p.doc_comment.clone(),
            }),
            ClassMemberKind::Method(m) => ClassMemberKind::Method(MethodDecl {
                name: m.name.clone(),
                visibility: m.visibility,
                is_static: m.is_static,
                is_abstract: m.is_abstract,
                is_final: m.is_final,
                by_ref: m.by_ref,
                params: fold_owned_params(folder, &m.params),
                return_type: m.return_type.as_ref().map(|t| folder.fold_type_hint(t)),
                body: m.body.as_ref().map(|stmts| fold_owned_stmts(folder, stmts)),
                attributes: fold_owned_attrs(folder, &m.attributes),
                doc_comment: m.doc_comment.clone(),
            }),
            ClassMemberKind::ClassConst(c) => {
                ClassMemberKind::ClassConst(fold_owned_class_const(folder, c))
            }
            ClassMemberKind::TraitUse(t) => {
                ClassMemberKind::TraitUse(fold_owned_trait_use(folder, t))
            }
        },
        span: member.span,
    }
}

pub fn fold_owned_enum_member<F: FoldOwned + ?Sized>(
    folder: &mut F,
    member: &EnumMember,
) -> EnumMember {
    EnumMember {
        kind: match &member.kind {
            EnumMemberKind::Case(c) => EnumMemberKind::Case(EnumCase {
                name: c.name.clone(),
                value: c.value.as_ref().map(|e| folder.fold_expr(e)),
                attributes: fold_owned_attrs(folder, &c.attributes),
                doc_comment: c.doc_comment.clone(),
            }),
            EnumMemberKind::Method(m) => EnumMemberKind::Method(MethodDecl {
                name: m.name.clone(),
                visibility: m.visibility,
                is_static: m.is_static,
                is_abstract: m.is_abstract,
                is_final: m.is_final,
                by_ref: m.by_ref,
                params: fold_owned_params(folder, &m.params),
                return_type: m.return_type.as_ref().map(|t| folder.fold_type_hint(t)),
                body: m.body.as_ref().map(|stmts| fold_owned_stmts(folder, stmts)),
                attributes: fold_owned_attrs(folder, &m.attributes),
                doc_comment: m.doc_comment.clone(),
            }),
            EnumMemberKind::ClassConst(c) => {
                EnumMemberKind::ClassConst(fold_owned_class_const(folder, c))
            }
            EnumMemberKind::TraitUse(t) => {
                EnumMemberKind::TraitUse(fold_owned_trait_use(folder, t))
            }
        },
        span: member.span,
    }
}

pub fn fold_owned_property_hook<F: FoldOwned + ?Sized>(
    folder: &mut F,
    hook: &PropertyHook,
) -> PropertyHook {
    PropertyHook {
        kind: hook.kind,
        body: match &hook.body {
            PropertyHookBody::Block(stmts) => {
                PropertyHookBody::Block(fold_owned_stmts(folder, stmts))
            }
            PropertyHookBody::Expression(e) => PropertyHookBody::Expression(folder.fold_expr(e)),
            PropertyHookBody::Abstract => PropertyHookBody::Abstract,
        },
        is_final: hook.is_final,
        by_ref: hook.by_ref,
        params: fold_owned_params(folder, &hook.params),
        attributes: fold_owned_attrs(folder, &hook.attributes),
        span: hook.span,
    }
}

pub fn fold_owned_type_hint<F: FoldOwned + ?Sized>(
    folder: &mut F,
    type_hint: &TypeHint,
) -> TypeHint {
    TypeHint {
        kind: match &type_hint.kind {
            TypeHintKind::Named(n) => TypeHintKind::Named(folder.fold_name(n)),
            TypeHintKind::Keyword(b, span) => TypeHintKind::Keyword(*b, *span),
            TypeHintKind::Nullable(inner) => {
                TypeHintKind::Nullable(Box::new(folder.fold_type_hint(inner)))
            }
            TypeHintKind::Union(types) => {
                TypeHintKind::Union(types.iter().map(|t| folder.fold_type_hint(t)).collect())
            }
            TypeHintKind::Intersection(types) => {
                TypeHintKind::Intersection(types.iter().map(|t| folder.fold_type_hint(t)).collect())
            }
        },
        span: type_hint.span,
    }
}

pub fn fold_owned_attribute<F: FoldOwned + ?Sized>(
    folder: &mut F,
    attribute: &Attribute,
) -> Attribute {
    Attribute {
        name: folder.fold_name(&attribute.name),
        args: fold_owned_args(folder, &attribute.args),
        span: attribute.span,
    }
}

pub fn fold_owned_catch_clause<F: FoldOwned + ?Sized>(
    folder: &mut F,
    catch: &CatchClause,
) -> CatchClause {
    CatchClause {
        types: catch.types.iter().map(|n| folder.fold_name(n)).collect(),
        var: catch.var.clone(),
        body: fold_owned_stmts(folder, &catch.body),
        span: catch.span,
    }
}

pub fn fold_owned_match_arm<F: FoldOwned + ?Sized>(folder: &mut F, arm: &MatchArm) -> MatchArm {
    MatchArm {
        conditions: arm
            .conditions
            .as_ref()
            .map(|conds| fold_owned_exprs(folder, conds)),
        body: folder.fold_expr(&arm.body),
        span: arm.span,
    }
}

fn fold_owned_class_const<F: FoldOwned + ?Sized>(
    folder: &mut F,
    c: &ClassConstDecl,
) -> ClassConstDecl {
    ClassConstDecl {
        name: c.name.clone(),
        visibility: c.visibility,
        is_final: c.is_final,
        type_hint: c
            .type_hint
            .as_ref()
            .map(|th| Box::new(folder.fold_type_hint(th))),
        value: folder.fold_expr(&c.value),
        attributes: fold_owned_attrs(folder, &c.attributes),
        doc_comment: c.doc_comment.clone(),
    }
}

fn fold_owned_trait_use<F: FoldOwned + ?Sized>(folder: &mut F, t: &TraitUseDecl) -> TraitUseDecl {
    TraitUseDecl {
        traits: t.traits.iter().map(|n| folder.fold_name(n)).collect(),
        adaptations: t
            .adaptations
            .iter()
            .map(|a| TraitAdaptation {
                kind: match &a.kind {
                    TraitAdaptationKind::Precedence {
                        trait_name,
                        method,
                        insteadof,
                    } => TraitAdaptationKind::Precedence {
                        trait_name: folder.fold_name(trait_name),
                        method: folder.fold_name(method),
                        insteadof: insteadof.iter().map(|n| folder.fold_name(n)).collect(),
                    },
                    TraitAdaptationKind::Alias {
                        trait_name,
                        method,
                        new_modifier,
                        new_name,
                    } => TraitAdaptationKind::Alias {
                        trait_name: trait_name.as_ref().map(|n| folder.fold_name(n)),
                        method: folder.fold_name(method),
                        new_modifier: *new_modifier,
                        new_name: new_name.as_ref().map(|n| folder.fold_name(n)),
                    },
                },
                span: a.span,
            })
            .collect(),
    }
}

fn fold_owned_class_decl<F: FoldOwned + ?Sized>(folder: &mut F, cls: &ClassDecl) -> ClassDecl {
    ClassDecl {
        name: cls.name.clone(),
        modifiers: cls.modifiers.clone(),
        extends: cls.extends.as_ref().map(|n| folder.fold_name(n)),
        implements: cls.implements.iter().map(|n| folder.fold_name(n)).collect(),
        members: fold_owned_members(folder, &cls.members),
        attributes: fold_owned_attrs(folder, &cls.attributes),
        doc_comment: cls.doc_comment.clone(),
    }
}

fn fold_owned_interface_decl<F: FoldOwned + ?Sized>(
    folder: &mut F,
    iface: &InterfaceDecl,
) -> InterfaceDecl {
    InterfaceDecl {
        name: iface.name.clone(),
        extends: iface.extends.iter().map(|n| folder.fold_name(n)).collect(),
        members: fold_owned_members(folder, &iface.members),
        attributes: fold_owned_attrs(folder, &iface.attributes),
        doc_comment: iface.doc_comment.clone(),
    }
}

fn fold_owned_trait_decl<F: FoldOwned + ?Sized>(folder: &mut F, tr: &TraitDecl) -> TraitDecl {
    TraitDecl {
        name: tr.name.clone(),
        members: fold_owned_members(folder, &tr.members),
        attributes: fold_owned_attrs(folder, &tr.attributes),
        doc_comment: tr.doc_comment.clone(),
    }
}

fn fold_owned_enum_decl<F: FoldOwned + ?Sized>(folder: &mut F, en: &EnumDecl) -> EnumDecl {
    EnumDecl {
        name: en.name.clone(),
        scalar_type: en.scalar_type.as_ref().map(|n| folder.fold_name(n)),
        implements: en.implements.iter().map(|n| folder.fold_name(n)).collect(),
        members: en
            .members
            .iter()
            .map(|m| folder.fold_enum_member(m))
            .collect(),
        attributes: fold_owned_attrs(folder, &en.attributes),
        doc_comment: en.doc_comment.clone(),
    }
}

// =============================================================================
// Tests
// =============================================================================

#[cfg(test)]
mod tests {
    use super::*;
    use crate::ast::AssignOp;
    use crate::Span;

    fn dummy_var(name: &str) -> Expr {
        Expr {
            kind: ExprKind::Variable(Box::from(name)),
            span: Span::DUMMY,
        }
    }

    fn dummy_int(n: i64) -> Expr {
        Expr {
            kind: ExprKind::Int(n),
            span: Span::DUMMY,
        }
    }

    fn assign(target: Expr, value: Expr) -> Expr {
        Expr {
            kind: ExprKind::Assign(AssignExpr {
                target: Box::new(target),
                op: AssignOp::Assign,
                value: Box::new(value),
                by_ref: false,
            }),
            span: Span::DUMMY,
        }
    }

    fn expr_stmt(e: Expr) -> Stmt {
        Stmt {
            kind: StmtKind::Expression(Box::new(e)),
            span: Span::DUMMY,
        }
    }

    fn program(stmts: impl IntoIterator<Item = Stmt>) -> Program {
        Program {
            stmts: stmts.into_iter().collect(),
            span: Span::DUMMY,
        }
    }

    /// Identity fold on `$x = $y;` must produce structurally equal output.
    #[test]
    fn identity_fold_roundtrip() {
        let p = program([expr_stmt(assign(dummy_var("x"), dummy_var("y")))]);
        struct Identity;
        impl FoldOwned for Identity {}
        let folded = Identity.fold_program(&p);
        assert_eq!(
            serde_json::to_string(&folded).unwrap(),
            serde_json::to_string(&p).unwrap(),
        );
    }

    /// NegateInts fold on `$x = 42;` must produce `$x = -42;`.
    #[test]
    fn negate_ints() {
        let p = program([expr_stmt(assign(dummy_var("x"), dummy_int(42)))]);
        struct NegateInts;
        impl FoldOwned for NegateInts {
            fn fold_expr(&mut self, expr: &Expr) -> Expr {
                if let ExprKind::Int(n) = &expr.kind {
                    return Expr {
                        kind: ExprKind::Int(-n),
                        span: expr.span,
                    };
                }
                fold_owned_expr(self, expr)
            }
        }
        let folded = NegateInts.fold_program(&p);
        let stmt = &folded.stmts[0];
        if let StmtKind::Expression(expr) = &stmt.kind {
            if let ExprKind::Assign(a) = &expr.kind {
                if let ExprKind::Int(n) = &a.value.kind {
                    assert_eq!(*n, -42);
                    return;
                }
            }
        }
        panic!("expected negated int assignment");
    }

    /// Fold that rewrites variable names: all occurrences of `$x` become `$renamed`.
    #[test]
    fn rename_variable() {
        // $x = $x;
        let p = program([expr_stmt(assign(dummy_var("x"), dummy_var("x")))]);
        struct Rename;
        impl FoldOwned for Rename {
            fn fold_expr(&mut self, expr: &Expr) -> Expr {
                if let ExprKind::Variable(name) = &expr.kind {
                    if name.as_ref() == "x" {
                        return Expr {
                            kind: ExprKind::Variable(Box::from("renamed")),
                            span: expr.span,
                        };
                    }
                }
                fold_owned_expr(self, expr)
            }
        }
        let folded = Rename.fold_program(&p);
        let stmt = &folded.stmts[0];
        if let StmtKind::Expression(expr) = &stmt.kind {
            if let ExprKind::Assign(a) = &expr.kind {
                assert!(matches!(&a.target.kind, ExprKind::Variable(n) if n.as_ref() == "renamed"));
                assert!(matches!(&a.value.kind, ExprKind::Variable(n) if n.as_ref() == "renamed"));
                return;
            }
        }
        panic!("expected renamed variable assignment");
    }

    /// Rename fold must reach into closure `use` capture lists.
    #[test]
    fn rename_variable_in_closure_use() {
        // function() use ($x) {}
        let closure = Expr {
            kind: ExprKind::Closure(Box::new(ClosureExpr {
                is_static: false,
                by_ref: false,
                params: Box::from([]),
                use_vars: Box::from([ClosureUseVar {
                    name: Box::from("x"),
                    by_ref: false,
                    span: Span::DUMMY,
                }]),
                return_type: None,
                body: Box::from([]),
                attributes: Box::from([]),
            })),
            span: Span::DUMMY,
        };
        let p = program([expr_stmt(closure)]);

        struct Rename;
        impl FoldOwned for Rename {
            fn fold_closure_use_var(&mut self, var: &ClosureUseVar) -> ClosureUseVar {
                ClosureUseVar {
                    name: if var.name.as_ref() == "x" {
                        Box::from("renamed")
                    } else {
                        var.name.clone()
                    },
                    by_ref: var.by_ref,
                    span: var.span,
                }
            }
        }

        let folded = Rename.fold_program(&p);
        if let StmtKind::Expression(expr) = &folded.stmts[0].kind {
            if let ExprKind::Closure(c) = &expr.kind {
                assert_eq!(c.use_vars[0].name.as_ref(), "renamed");
                return;
            }
        }
        panic!("expected closure with renamed use-var");
    }
}
