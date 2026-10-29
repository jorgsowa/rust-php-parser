//! Owned AST transformation via the [`OwnedFold`] trait.
//!
//! [`OwnedFold`] is the transformation counterpart of [`super::visitor::OwnedVisitor`].
//! Where `OwnedVisitor` reads nodes in place, `OwnedFold` rebuilds them: it takes a node by
//! value and returns the new node, so unchanged children and strings are moved, not cloned.
//! Override only the node types you want to change; all others are rebuilt by the default
//! implementations.
//!
//! # Example
//!
//! ```
//! use php_ast::owned::fold::{OwnedFold, fold_owned_expr};
//! use php_ast::owned::{Expr, ExprKind};
//!
//! struct NegateInts;
//!
//! impl OwnedFold for NegateInts {
//!     fn fold_expr(&mut self, expr: Expr) -> Expr {
//!         if let ExprKind::Int(n) = &expr.kind {
//!             return Expr { kind: ExprKind::Int(-n), span: expr.span };
//!         }
//!         fold_owned_expr(self, expr)
//!     }
//! }
//! ```

use super::*;

// =============================================================================
// OwnedFold trait
// =============================================================================

/// Trait for transforming owned PHP AST nodes.
///
/// Every method takes the node by value and returns its replacement. The defaults call the
/// corresponding free `fold_owned_*` function, which folds the children and rebuilds the node.
/// Override only the node types you want to change; the rest recurse automatically.
pub trait OwnedFold {
    /// Transforms a program node; recurses by default.
    fn fold_program(&mut self, program: Program) -> Program {
        fold_owned_program(self, program)
    }

    /// Transforms a statement node; recurses by default.
    fn fold_stmt(&mut self, stmt: Stmt) -> Stmt {
        fold_owned_stmt(self, stmt)
    }

    /// Transforms a statement list (program, block and `case` bodies); folds each statement by
    /// default. Override to delete, split or insert statements.
    fn fold_stmts(&mut self, stmts: Box<[Stmt]>) -> Box<[Stmt]> {
        fold_owned_stmts(self, stmts)
    }

    /// Transforms a block node; recurses by default.
    fn fold_block(&mut self, block: Block) -> Block {
        fold_owned_block(self, block)
    }

    /// Transforms an expression node; recurses by default.
    fn fold_expr(&mut self, expr: Expr) -> Expr {
        fold_owned_expr(self, expr)
    }

    /// Transforms a param node; recurses by default.
    fn fold_param(&mut self, param: Param) -> Param {
        fold_owned_param(self, param)
    }

    /// Transforms an arg node; recurses by default.
    fn fold_arg(&mut self, arg: Arg) -> Arg {
        fold_owned_arg(self, arg)
    }

    /// Transforms a class member node; recurses by default.
    fn fold_class_member(&mut self, member: ClassMember) -> ClassMember {
        fold_owned_class_member(self, member)
    }

    /// Transforms an enum member node; recurses by default.
    fn fold_enum_member(&mut self, member: EnumMember) -> EnumMember {
        fold_owned_enum_member(self, member)
    }

    /// Transforms a property hook node; recurses by default.
    fn fold_property_hook(&mut self, hook: PropertyHook) -> PropertyHook {
        fold_owned_property_hook(self, hook)
    }

    /// Transforms a type hint node; recurses by default.
    fn fold_type_hint(&mut self, type_hint: TypeHint) -> TypeHint {
        fold_owned_type_hint(self, type_hint)
    }

    /// Transforms an attribute node; recurses by default.
    fn fold_attribute(&mut self, attribute: Attribute) -> Attribute {
        fold_owned_attribute(self, attribute)
    }

    /// Transforms a catch clause node; recurses by default.
    fn fold_catch_clause(&mut self, catch: CatchClause) -> CatchClause {
        fold_owned_catch_clause(self, catch)
    }

    /// Transforms a match arm node; recurses by default.
    fn fold_match_arm(&mut self, arm: MatchArm) -> MatchArm {
        fold_owned_match_arm(self, arm)
    }

    /// Transforms a closure use var node; recurses by default.
    fn fold_closure_use_var(&mut self, var: ClosureUseVar) -> ClosureUseVar {
        fold_owned_closure_use_var(self, var)
    }

    /// Transforms a `use Trait;` declaration; recurses by default.
    fn fold_trait_use(&mut self, trait_use: TraitUseDecl) -> TraitUseDecl {
        fold_owned_trait_use(self, trait_use)
    }

    /// Transforms a trait `insteadof`/`as` adaptation; recurses by default.
    fn fold_trait_adaptation(&mut self, adaptation: TraitAdaptation) -> TraitAdaptation {
        fold_owned_trait_adaptation(self, adaptation)
    }

    /// Transforms a name node; recurses by default.
    fn fold_name(&mut self, name: Name) -> Name {
        fold_owned_name(self, name)
    }
}

// =============================================================================
// Collection and box helpers
// =============================================================================

fn map_slice<T, U>(items: Box<[T]>, f: impl FnMut(T) -> U) -> Box<[U]> {
    items.into_vec().into_iter().map(f).collect()
}

fn fold_boxed_expr<F: OwnedFold + ?Sized>(folder: &mut F, mut boxed: Box<Expr>) -> Box<Expr> {
    let span = boxed.span;
    let taken = std::mem::replace(
        &mut *boxed,
        Expr {
            kind: ExprKind::Error,
            span,
        },
    );
    *boxed = folder.fold_expr(taken);
    boxed
}

fn fold_opt_boxed_expr<F: OwnedFold + ?Sized>(
    folder: &mut F,
    boxed: Option<Box<Expr>>,
) -> Option<Box<Expr>> {
    boxed.map(|e| fold_boxed_expr(folder, e))
}

fn fold_boxed_stmt<F: OwnedFold + ?Sized>(folder: &mut F, mut boxed: Box<Stmt>) -> Box<Stmt> {
    let span = boxed.span;
    let taken = std::mem::replace(
        &mut *boxed,
        Stmt {
            kind: StmtKind::Error,
            span,
            doc_comment: None,
        },
    );
    *boxed = folder.fold_stmt(taken);
    boxed
}

fn fold_boxed_block<F: OwnedFold + ?Sized>(folder: &mut F, mut boxed: Box<Block>) -> Box<Block> {
    let span = boxed.span;
    let taken = std::mem::replace(
        &mut *boxed,
        Block {
            stmts: Box::new([]),
            span,
        },
    );
    *boxed = folder.fold_block(taken);
    boxed
}

fn fold_owned_exprs<F: OwnedFold + ?Sized>(folder: &mut F, exprs: Box<[Expr]>) -> Box<[Expr]> {
    map_slice(exprs, |e| folder.fold_expr(e))
}

fn fold_owned_args<F: OwnedFold + ?Sized>(folder: &mut F, args: Box<[Arg]>) -> Box<[Arg]> {
    map_slice(args, |a| folder.fold_arg(a))
}

fn fold_owned_attrs<F: OwnedFold + ?Sized>(
    folder: &mut F,
    attrs: Box<[Attribute]>,
) -> Box<[Attribute]> {
    map_slice(attrs, |a| folder.fold_attribute(a))
}

fn fold_owned_params<F: OwnedFold + ?Sized>(folder: &mut F, params: Box<[Param]>) -> Box<[Param]> {
    map_slice(params, |p| folder.fold_param(p))
}

fn fold_owned_hooks<F: OwnedFold + ?Sized>(
    folder: &mut F,
    hooks: Box<[PropertyHook]>,
) -> Box<[PropertyHook]> {
    map_slice(hooks, |h| folder.fold_property_hook(h))
}

fn fold_owned_members<F: OwnedFold + ?Sized>(
    folder: &mut F,
    members: Box<[ClassMember]>,
) -> Box<[ClassMember]> {
    map_slice(members, |m| folder.fold_class_member(m))
}

fn fold_owned_names<F: OwnedFold + ?Sized>(folder: &mut F, names: Box<[Name]>) -> Box<[Name]> {
    map_slice(names, |n| folder.fold_name(n))
}

fn fold_owned_string_parts<F: OwnedFold + ?Sized>(
    folder: &mut F,
    parts: Box<[StringPart]>,
) -> Box<[StringPart]> {
    map_slice(parts, |p| match p {
        StringPart::Literal(s) => StringPart::Literal(s),
        StringPart::Expr(e) => StringPart::Expr(folder.fold_expr(e)),
    })
}

fn fold_owned_type_hints<F: OwnedFold + ?Sized>(
    folder: &mut F,
    types: Box<[TypeHint]>,
) -> Box<[TypeHint]> {
    map_slice(types, |t| folder.fold_type_hint(t))
}

// =============================================================================
// Free fold functions
// =============================================================================

/// Folds a program, recursing into its children.
pub fn fold_owned_program<F: OwnedFold + ?Sized>(folder: &mut F, program: Program) -> Program {
    Program {
        stmts: folder.fold_stmts(program.stmts),
        span: program.span,
    }
}

/// Folds a statement, recursing into its children.
pub fn fold_owned_stmt<F: OwnedFold + ?Sized>(folder: &mut F, stmt: Stmt) -> Stmt {
    Stmt {
        kind: fold_owned_stmt_kind(folder, stmt.kind),
        span: stmt.span,
        doc_comment: stmt.doc_comment,
    }
}

/// Folds each statement of a list in order.
pub fn fold_owned_stmts<F: OwnedFold + ?Sized>(folder: &mut F, stmts: Box<[Stmt]>) -> Box<[Stmt]> {
    map_slice(stmts, |s| folder.fold_stmt(s))
}

/// Folds a block, recursing into its children.
pub fn fold_owned_block<F: OwnedFold + ?Sized>(folder: &mut F, block: Block) -> Block {
    Block {
        stmts: folder.fold_stmts(block.stmts),
        span: block.span,
    }
}

fn fold_owned_stmt_kind<F: OwnedFold + ?Sized>(folder: &mut F, k: StmtKind) -> StmtKind {
    match k {
        StmtKind::Expression(e) => StmtKind::Expression(fold_boxed_expr(folder, e)),
        StmtKind::Echo(exprs) => StmtKind::Echo(fold_owned_exprs(folder, exprs)),
        StmtKind::Return(e) => StmtKind::Return(fold_opt_boxed_expr(folder, e)),
        StmtKind::Block(block) => StmtKind::Block(fold_boxed_block(folder, block)),
        StmtKind::If(s) => {
            let s = *s;
            StmtKind::If(Box::new(IfStmt {
                condition: folder.fold_expr(s.condition),
                then_branch: fold_boxed_stmt(folder, s.then_branch),
                elseif_branches: map_slice(s.elseif_branches, |b| ElseIfBranch {
                    condition: folder.fold_expr(b.condition),
                    body: folder.fold_stmt(b.body),
                    span: b.span,
                }),
                else_branch: s.else_branch.map(|b| fold_boxed_stmt(folder, b)),
                else_kw_span: s.else_kw_span,
                uses_alternative: s.uses_alternative,
            }))
        }
        StmtKind::While(s) => {
            let s = *s;
            StmtKind::While(Box::new(WhileStmt {
                condition: folder.fold_expr(s.condition),
                body: fold_boxed_stmt(folder, s.body),
                uses_alternative: s.uses_alternative,
            }))
        }
        StmtKind::For(s) => {
            let s = *s;
            StmtKind::For(Box::new(ForStmt {
                init: fold_owned_exprs(folder, s.init),
                condition: fold_owned_exprs(folder, s.condition),
                update: fold_owned_exprs(folder, s.update),
                body: fold_boxed_stmt(folder, s.body),
                uses_alternative: s.uses_alternative,
            }))
        }
        StmtKind::Foreach(s) => {
            let s = *s;
            StmtKind::Foreach(Box::new(ForeachStmt {
                expr: folder.fold_expr(s.expr),
                key: s.key.map(|k| folder.fold_expr(k)),
                key_by_ref: s.key_by_ref,
                value: folder.fold_expr(s.value),
                by_ref: s.by_ref,
                by_ref_span: s.by_ref_span,
                body: fold_boxed_stmt(folder, s.body),
                uses_alternative: s.uses_alternative,
            }))
        }
        StmtKind::DoWhile(s) => {
            let s = *s;
            StmtKind::DoWhile(Box::new(DoWhileStmt {
                body: fold_boxed_stmt(folder, s.body),
                condition: folder.fold_expr(s.condition),
            }))
        }
        StmtKind::Function(f) => {
            let f = *f;
            StmtKind::Function(Box::new(FunctionDecl {
                name: f.name,
                params: fold_owned_params(folder, f.params),
                missing_param_list: f.missing_param_list,
                body: fold_boxed_block(folder, f.body),
                return_type: f.return_type.map(|t| folder.fold_type_hint(t)),
                by_ref: f.by_ref,
                attributes: fold_owned_attrs(folder, f.attributes),
                doc_comment: f.doc_comment,
            }))
        }
        StmtKind::Break(e) => StmtKind::Break(fold_opt_boxed_expr(folder, e)),
        StmtKind::Continue(e) => StmtKind::Continue(fold_opt_boxed_expr(folder, e)),
        StmtKind::Switch(s) => {
            let s = *s;
            StmtKind::Switch(Box::new(SwitchStmt {
                expr: folder.fold_expr(s.expr),
                body: SwitchBody {
                    cases: map_slice(s.body.cases, |c| SwitchCase {
                        value: c.value.map(|v| folder.fold_expr(v)),
                        body: folder.fold_stmts(c.body),
                        span: c.span,
                    }),
                    span: s.body.span,
                },
                uses_alternative: s.uses_alternative,
            }))
        }
        StmtKind::Goto(ident) => StmtKind::Goto(ident),
        StmtKind::Label(ident) => StmtKind::Label(ident),
        StmtKind::Declare(d) => {
            let d = *d;
            StmtKind::Declare(Box::new(DeclareStmt {
                directives: map_slice(d.directives, |(k, v)| (k, folder.fold_expr(v))),
                body: d.body.map(|b| fold_boxed_stmt(folder, b)),
                uses_alternative: d.uses_alternative,
            }))
        }
        StmtKind::Unset(exprs) => StmtKind::Unset(fold_owned_exprs(folder, exprs)),
        StmtKind::Throw(e) => StmtKind::Throw(fold_boxed_expr(folder, e)),
        StmtKind::TryCatch(t) => {
            let t = *t;
            StmtKind::TryCatch(Box::new(TryCatchStmt {
                body: fold_boxed_block(folder, t.body),
                catches: map_slice(t.catches, |c| folder.fold_catch_clause(c)),
                finally: t.finally.map(|f| fold_boxed_block(folder, f)),
                finally_kw_span: t.finally_kw_span,
            }))
        }
        StmtKind::Global(exprs) => StmtKind::Global(fold_owned_exprs(folder, exprs)),
        StmtKind::Class(cls) => StmtKind::Class(Box::new(fold_owned_class_decl(folder, *cls))),
        StmtKind::Interface(iface) => {
            StmtKind::Interface(Box::new(fold_owned_interface_decl(folder, *iface)))
        }
        StmtKind::Trait(tr) => StmtKind::Trait(Box::new(fold_owned_trait_decl(folder, *tr))),
        StmtKind::Enum(en) => StmtKind::Enum(Box::new(fold_owned_enum_decl(folder, *en))),
        StmtKind::Namespace(ns) => {
            let ns = *ns;
            StmtKind::Namespace(Box::new(NamespaceDecl {
                name: ns.name.map(|n| folder.fold_name(n)),
                body: match ns.body {
                    NamespaceBody::Braced(block) => {
                        NamespaceBody::Braced(fold_boxed_block(folder, block))
                    }
                    NamespaceBody::Simple => NamespaceBody::Simple,
                },
            }))
        }
        StmtKind::Use(u) => {
            let u = *u;
            StmtKind::Use(Box::new(UseDecl {
                kind: u.kind,
                uses: map_slice(u.uses, |item| UseItem {
                    name: folder.fold_name(item.name),
                    alias: item.alias,
                    kind: item.kind,
                    span: item.span,
                }),
            }))
        }
        StmtKind::Const(items) => StmtKind::Const(map_slice(items, |item| ConstItem {
            name: item.name,
            value: folder.fold_expr(item.value),
            attributes: fold_owned_attrs(folder, item.attributes),
            span: item.span,
            doc_comment: item.doc_comment,
        })),
        StmtKind::StaticVar(vars) => StmtKind::StaticVar(map_slice(vars, |v| StaticVar {
            name: v.name,
            default: v.default.map(|e| folder.fold_expr(e)),
            span: v.span,
        })),
        StmtKind::HaltCompiler(s) => StmtKind::HaltCompiler(s),
        StmtKind::Nop => StmtKind::Nop,
        StmtKind::InlineHtml(s) => StmtKind::InlineHtml(s),
        StmtKind::Error => StmtKind::Error,
    }
}

/// Folds an expression, recursing into its children.
pub fn fold_owned_expr<F: OwnedFold + ?Sized>(folder: &mut F, expr: Expr) -> Expr {
    let span = expr.span;
    Expr {
        kind: fold_owned_expr_kind(folder, expr.into_kind()),
        span,
    }
}

fn fold_owned_expr_kind<F: OwnedFold + ?Sized>(folder: &mut F, k: ExprKind) -> ExprKind {
    match k {
        ExprKind::Int(v) => ExprKind::Int(v),
        ExprKind::Float(v) => ExprKind::Float(v),
        ExprKind::String(s) => ExprKind::String(s),
        ExprKind::InterpolatedString(parts) => {
            ExprKind::InterpolatedString(fold_owned_string_parts(folder, parts))
        }
        ExprKind::Heredoc(mut h) => {
            h.parts = fold_owned_string_parts(folder, std::mem::take(&mut h.parts));
            ExprKind::Heredoc(h)
        }
        ExprKind::Nowdoc(n) => ExprKind::Nowdoc(n),
        ExprKind::ShellExec(parts) => ExprKind::ShellExec(fold_owned_string_parts(folder, parts)),
        ExprKind::Bool(v) => ExprKind::Bool(v),
        ExprKind::Null => ExprKind::Null,
        ExprKind::Variable(s) => ExprKind::Variable(s),
        ExprKind::VariableVariable(inner) => {
            ExprKind::VariableVariable(fold_boxed_expr(folder, inner))
        }
        ExprKind::Identifier(s) => ExprKind::Identifier(s),
        ExprKind::Name(name) => ExprKind::Name(Box::new(folder.fold_name(*name))),
        ExprKind::Assign(a) => ExprKind::Assign(Box::new(AssignExpr {
            target: folder.fold_expr(a.target),
            op: a.op,
            value: folder.fold_expr(a.value),
            by_ref: a.by_ref,
        })),
        ExprKind::Binary(b) => ExprKind::Binary(Box::new(BinaryExpr {
            left: folder.fold_expr(b.left),
            op: b.op,
            right: folder.fold_expr(b.right),
        })),
        ExprKind::UnaryPrefix(u) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: u.op,
            operand: fold_boxed_expr(folder, u.operand),
        }),
        ExprKind::UnaryPostfix(u) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            operand: fold_boxed_expr(folder, u.operand),
            op: u.op,
        }),
        ExprKind::Ternary(t) => ExprKind::Ternary(Box::new(TernaryExpr {
            condition: folder.fold_expr(t.condition),
            then_expr: t.then_expr.map(|e| folder.fold_expr(e)),
            else_expr: folder.fold_expr(t.else_expr),
        })),
        ExprKind::NullCoalesce(n) => ExprKind::NullCoalesce(Box::new(NullCoalesceExpr {
            left: folder.fold_expr(n.left),
            right: folder.fold_expr(n.right),
        })),
        ExprKind::FunctionCall(f) => ExprKind::FunctionCall(Box::new(FunctionCallExpr {
            name: folder.fold_expr(f.name),
            args: fold_owned_args(folder, f.args),
        })),
        ExprKind::Array(elems) => ExprKind::Array(map_slice(elems, |e| ArrayElement {
            key: e.key.map(|k| folder.fold_expr(k)),
            kind: match e.kind {
                ArrayElementKind::Value(v) => ArrayElementKind::Value(folder.fold_expr(v)),
                ArrayElementKind::Spread(v) => ArrayElementKind::Spread(folder.fold_expr(v)),
                ArrayElementKind::ByRef(v) => ArrayElementKind::ByRef(folder.fold_expr(v)),
            },
            span: e.span,
        })),
        ExprKind::ArrayAccess(a) => ExprKind::ArrayAccess(Box::new(ArrayAccessExpr {
            array: folder.fold_expr(a.array),
            index: a.index.map(|e| folder.fold_expr(e)),
        })),
        ExprKind::Print(e) => ExprKind::Print(fold_boxed_expr(folder, e)),
        ExprKind::Parenthesized(e) => ExprKind::Parenthesized(fold_boxed_expr(folder, e)),
        ExprKind::Cast(kind, e) => ExprKind::Cast(kind, fold_boxed_expr(folder, e)),
        ExprKind::ErrorSuppress(e) => ExprKind::ErrorSuppress(fold_boxed_expr(folder, e)),
        ExprKind::Isset(exprs) => ExprKind::Isset(fold_owned_exprs(folder, exprs)),
        ExprKind::Empty(e) => ExprKind::Empty(fold_boxed_expr(folder, e)),
        ExprKind::Include(kind, e) => ExprKind::Include(kind, fold_boxed_expr(folder, e)),
        ExprKind::Eval(e) => ExprKind::Eval(fold_boxed_expr(folder, e)),
        ExprKind::Exit(e) => ExprKind::Exit(fold_opt_boxed_expr(folder, e)),
        ExprKind::MagicConst(m) => ExprKind::MagicConst(m),
        ExprKind::Clone(e) => ExprKind::Clone(fold_boxed_expr(folder, e)),
        ExprKind::CloneWith(obj, props) => {
            ExprKind::CloneWith(fold_boxed_expr(folder, obj), fold_boxed_expr(folder, props))
        }
        ExprKind::New(n) => ExprKind::New(Box::new(NewExpr {
            class: folder.fold_expr(n.class),
            args: fold_owned_args(folder, n.args),
        })),
        ExprKind::PropertyAccess(p) => ExprKind::PropertyAccess(Box::new(PropertyAccessExpr {
            object: folder.fold_expr(p.object),
            property: folder.fold_expr(p.property),
        })),
        ExprKind::NullsafePropertyAccess(p) => {
            ExprKind::NullsafePropertyAccess(Box::new(PropertyAccessExpr {
                object: folder.fold_expr(p.object),
                property: folder.fold_expr(p.property),
            }))
        }
        ExprKind::MethodCall(m) => {
            let m = *m;
            ExprKind::MethodCall(Box::new(MethodCallExpr {
                object: folder.fold_expr(m.object),
                method: folder.fold_expr(m.method),
                args: fold_owned_args(folder, m.args),
            }))
        }
        ExprKind::NullsafeMethodCall(m) => {
            let m = *m;
            ExprKind::NullsafeMethodCall(Box::new(MethodCallExpr {
                object: folder.fold_expr(m.object),
                method: folder.fold_expr(m.method),
                args: fold_owned_args(folder, m.args),
            }))
        }
        ExprKind::StaticPropertyAccess(s) => {
            ExprKind::StaticPropertyAccess(Box::new(StaticAccessExpr {
                class: folder.fold_expr(s.class),
                member: folder.fold_expr(s.member),
            }))
        }
        ExprKind::StaticMethodCall(s) => {
            let s = *s;
            ExprKind::StaticMethodCall(Box::new(StaticMethodCallExpr {
                class: folder.fold_expr(s.class),
                method: folder.fold_expr(s.method),
                args: fold_owned_args(folder, s.args),
            }))
        }
        ExprKind::StaticMethodCallDynamic(s) => {
            let s = *s;
            ExprKind::StaticMethodCallDynamic(Box::new(StaticMethodCallDynamicExpr {
                class: folder.fold_expr(s.class),
                method: folder.fold_expr(s.method),
                args: fold_owned_args(folder, s.args),
            }))
        }
        ExprKind::ClassConstAccess(s) => ExprKind::ClassConstAccess(Box::new(StaticAccessExpr {
            class: folder.fold_expr(s.class),
            member: folder.fold_expr(s.member),
        })),
        ExprKind::ClassConstAccessDynamic { class, member } => ExprKind::ClassConstAccessDynamic {
            class: fold_boxed_expr(folder, class),
            member: fold_boxed_expr(folder, member),
        },
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: fold_boxed_expr(folder, class),
                member: fold_boxed_expr(folder, member),
            }
        }
        ExprKind::Closure(c) => {
            let c = *c;
            ExprKind::Closure(Box::new(ClosureExpr {
                is_static: c.is_static,
                by_ref: c.by_ref,
                params: fold_owned_params(folder, c.params),
                missing_param_list: c.missing_param_list,
                use_vars: map_slice(c.use_vars, |v| folder.fold_closure_use_var(v)),
                return_type: c.return_type.map(|t| folder.fold_type_hint(t)),
                body: fold_boxed_block(folder, c.body),
                attributes: fold_owned_attrs(folder, c.attributes),
            }))
        }
        ExprKind::ArrowFunction(f) => {
            let f = *f;
            ExprKind::ArrowFunction(Box::new(ArrowFunctionExpr {
                is_static: f.is_static,
                by_ref: f.by_ref,
                params: fold_owned_params(folder, f.params),
                missing_param_list: f.missing_param_list,
                return_type: f.return_type.map(|t| folder.fold_type_hint(t)),
                body: fold_boxed_expr(folder, f.body),
                attributes: fold_owned_attrs(folder, f.attributes),
            }))
        }
        ExprKind::Match(m) => ExprKind::Match(Box::new(MatchExpr {
            subject: folder.fold_expr(m.subject),
            arms: map_slice(m.arms, |arm| folder.fold_match_arm(arm)),
            brace_span: m.brace_span,
        })),
        ExprKind::Throw(e) => ExprKind::Throw(fold_boxed_expr(folder, e)),
        ExprKind::Yield(y) => ExprKind::Yield(Box::new(YieldExpr {
            key: y.key.map(|e| folder.fold_expr(e)),
            value: y.value.map(|e| folder.fold_expr(e)),
            is_from: y.is_from,
        })),
        ExprKind::AnonymousClass(cls) => {
            ExprKind::AnonymousClass(Box::new(fold_owned_class_decl(folder, *cls)))
        }
        ExprKind::CallableCreate(c) => ExprKind::CallableCreate(Box::new(CallableCreateExpr {
            kind: match c.kind {
                CallableCreateKind::Function(e) => {
                    CallableCreateKind::Function(fold_boxed_expr(folder, e))
                }
                CallableCreateKind::Method { object, method } => CallableCreateKind::Method {
                    object: fold_boxed_expr(folder, object),
                    method: fold_boxed_expr(folder, method),
                },
                CallableCreateKind::NullsafeMethod { object, method } => {
                    CallableCreateKind::NullsafeMethod {
                        object: fold_boxed_expr(folder, object),
                        method: fold_boxed_expr(folder, method),
                    }
                }
                CallableCreateKind::StaticMethod { class, method } => {
                    CallableCreateKind::StaticMethod {
                        class: fold_boxed_expr(folder, class),
                        method: fold_boxed_expr(folder, method),
                    }
                }
            },
        })),
        ExprKind::Omit => ExprKind::Omit,
        ExprKind::Error => ExprKind::Error,
    }
}

/// Folds a param, recursing into its children.
pub fn fold_owned_param<F: OwnedFold + ?Sized>(folder: &mut F, p: Param) -> Param {
    Param {
        name: p.name,
        type_hint: p.type_hint.map(|t| folder.fold_type_hint(t)),
        default: p.default.map(|e| folder.fold_expr(e)),
        by_ref: p.by_ref,
        variadic: p.variadic,
        modifiers: p.modifiers,
        attributes: fold_owned_attrs(folder, p.attributes),
        hooks: fold_owned_hooks(folder, p.hooks),
        empty_hook_list: p.empty_hook_list,
        doc_comment: p.doc_comment,
        span: p.span,
    }
}

/// Folds an argument, recursing into its children.
pub fn fold_owned_arg<F: OwnedFold + ?Sized>(folder: &mut F, arg: Arg) -> Arg {
    Arg {
        name: arg.name.map(|n| Box::new(folder.fold_name(*n))),
        kind: match arg.kind {
            ArgKind::Value(e) => ArgKind::Value(folder.fold_expr(e)),
            ArgKind::Spread(e) => ArgKind::Spread(folder.fold_expr(e)),
            ArgKind::ByRef(e) => ArgKind::ByRef(folder.fold_expr(e)),
            ArgKind::Placeholder => ArgKind::Placeholder,
            ArgKind::SpreadPlaceholder => ArgKind::SpreadPlaceholder,
        },
        span: arg.span,
    }
}

/// Folds a closure use var, recursing into its children.
pub fn fold_owned_closure_use_var<F: OwnedFold + ?Sized>(
    _folder: &mut F,
    var: ClosureUseVar,
) -> ClosureUseVar {
    var
}

/// Folds a name, recursing into its children.
pub fn fold_owned_name<F: OwnedFold + ?Sized>(_folder: &mut F, name: Name) -> Name {
    name
}

/// Folds a method declaration's parts.
fn fold_owned_method<F: OwnedFold + ?Sized>(folder: &mut F, m: MethodDecl) -> MethodDecl {
    MethodDecl {
        name: m.name,
        modifiers: m.modifiers,
        by_ref: m.by_ref,
        params: fold_owned_params(folder, m.params),
        missing_param_list: m.missing_param_list,
        return_type: m.return_type.map(|t| folder.fold_type_hint(t)),
        body: m.body.map(|b| fold_boxed_block(folder, b)),
        attributes: fold_owned_attrs(folder, m.attributes),
        doc_comment: m.doc_comment,
    }
}

fn fold_owned_property<F: OwnedFold + ?Sized>(folder: &mut F, p: PropertyDecl) -> PropertyDecl {
    PropertyDecl {
        name: p.name,
        modifiers: p.modifiers,
        type_hint: p.type_hint.map(|t| folder.fold_type_hint(t)),
        default: p.default.map(|e| folder.fold_expr(e)),
        attributes: fold_owned_attrs(folder, p.attributes),
        hooks: fold_owned_hooks(folder, p.hooks),
        empty_hook_list: p.empty_hook_list,
        doc_comment: p.doc_comment,
    }
}

/// Folds a class member, recursing into its children.
pub fn fold_owned_class_member<F: OwnedFold + ?Sized>(
    folder: &mut F,
    member: ClassMember,
) -> ClassMember {
    ClassMember {
        kind: match member.kind {
            ClassMemberKind::Property(p) => {
                ClassMemberKind::Property(fold_owned_property(folder, p))
            }
            ClassMemberKind::Method(m) => ClassMemberKind::Method(fold_owned_method(folder, m)),
            ClassMemberKind::ClassConst(c) => {
                ClassMemberKind::ClassConst(fold_owned_class_const(folder, c))
            }
            ClassMemberKind::TraitUse(t) => ClassMemberKind::TraitUse(folder.fold_trait_use(t)),
        },
        span: member.span,
    }
}

/// Folds an enum member, recursing into its children.
pub fn fold_owned_enum_member<F: OwnedFold + ?Sized>(
    folder: &mut F,
    member: EnumMember,
) -> EnumMember {
    EnumMember {
        kind: match member.kind {
            EnumMemberKind::Case(c) => EnumMemberKind::Case(EnumCase {
                name: c.name,
                value: c.value.map(|e| folder.fold_expr(e)),
                attributes: fold_owned_attrs(folder, c.attributes),
                doc_comment: c.doc_comment,
            }),
            EnumMemberKind::Method(m) => EnumMemberKind::Method(fold_owned_method(folder, m)),
            EnumMemberKind::ClassConst(c) => {
                EnumMemberKind::ClassConst(fold_owned_class_const(folder, c))
            }
            EnumMemberKind::TraitUse(t) => EnumMemberKind::TraitUse(folder.fold_trait_use(t)),
            EnumMemberKind::Property(p) => EnumMemberKind::Property(fold_owned_property(folder, p)),
        },
        span: member.span,
    }
}

/// Folds a property hook, recursing into its children.
pub fn fold_owned_property_hook<F: OwnedFold + ?Sized>(
    folder: &mut F,
    hook: PropertyHook,
) -> PropertyHook {
    PropertyHook {
        kind: hook.kind,
        body: match hook.body {
            PropertyHookBody::Block(block) => {
                PropertyHookBody::Block(fold_boxed_block(folder, block))
            }
            PropertyHookBody::Expression(e) => PropertyHookBody::Expression(folder.fold_expr(e)),
            PropertyHookBody::Abstract => PropertyHookBody::Abstract,
        },
        modifiers: hook.modifiers,
        by_ref: hook.by_ref,
        params: fold_owned_params(folder, hook.params),
        empty_param_list: hook.empty_param_list,
        attributes: fold_owned_attrs(folder, hook.attributes),
        name_span: hook.name_span,
        span: hook.span,
    }
}

/// Folds a type hint, recursing into its children.
pub fn fold_owned_type_hint<F: OwnedFold + ?Sized>(
    folder: &mut F,
    type_hint: TypeHint,
) -> TypeHint {
    TypeHint {
        kind: match type_hint.kind {
            TypeHintKind::Named(n) => TypeHintKind::Named(folder.fold_name(n)),
            TypeHintKind::Keyword(b, span) => TypeHintKind::Keyword(b, span),
            TypeHintKind::Nullable(inner) => {
                TypeHintKind::Nullable(Box::new(folder.fold_type_hint(*inner)))
            }
            TypeHintKind::Union(types) => TypeHintKind::Union(fold_owned_type_hints(folder, types)),
            TypeHintKind::Intersection(types) => {
                TypeHintKind::Intersection(fold_owned_type_hints(folder, types))
            }
        },
        span: type_hint.span,
    }
}

/// Folds an attribute, recursing into its children.
pub fn fold_owned_attribute<F: OwnedFold + ?Sized>(
    folder: &mut F,
    attribute: Attribute,
) -> Attribute {
    Attribute {
        name: folder.fold_name(attribute.name),
        args: fold_owned_args(folder, attribute.args),
        span: attribute.span,
    }
}

/// Folds a catch clause, recursing into its children.
pub fn fold_owned_catch_clause<F: OwnedFold + ?Sized>(
    folder: &mut F,
    catch: CatchClause,
) -> CatchClause {
    CatchClause {
        types: fold_owned_names(folder, catch.types),
        var: catch.var,
        body: fold_boxed_block(folder, catch.body),
        span: catch.span,
    }
}

/// Folds a match arm, recursing into its children.
pub fn fold_owned_match_arm<F: OwnedFold + ?Sized>(folder: &mut F, arm: MatchArm) -> MatchArm {
    MatchArm {
        conditions: arm.conditions.map(|conds| fold_owned_exprs(folder, conds)),
        body: folder.fold_expr(arm.body),
        span: arm.span,
    }
}

fn fold_owned_class_const<F: OwnedFold + ?Sized>(
    folder: &mut F,
    c: ClassConstDecl,
) -> ClassConstDecl {
    ClassConstDecl {
        name: c.name,
        modifiers: c.modifiers,
        type_hint: c.type_hint.map(|th| Box::new(folder.fold_type_hint(*th))),
        value: folder.fold_expr(c.value),
        attributes: fold_owned_attrs(folder, c.attributes),
        doc_comment: c.doc_comment,
    }
}

/// Folds a `use Trait;` declaration inside a class or enum body.
pub fn fold_owned_trait_use<F: OwnedFold + ?Sized>(
    folder: &mut F,
    t: TraitUseDecl,
) -> TraitUseDecl {
    TraitUseDecl {
        traits: fold_owned_names(folder, t.traits),
        adaptations: map_slice(t.adaptations, |a| folder.fold_trait_adaptation(a)),
        adaptations_brace_span: t.adaptations_brace_span,
        doc_comment: t.doc_comment,
    }
}

/// Folds a trait `insteadof`/`as` adaptation.
pub fn fold_owned_trait_adaptation<F: OwnedFold + ?Sized>(
    folder: &mut F,
    a: TraitAdaptation,
) -> TraitAdaptation {
    TraitAdaptation {
        kind: match a.kind {
            TraitAdaptationKind::Precedence {
                trait_name,
                method,
                insteadof,
            } => TraitAdaptationKind::Precedence {
                trait_name: folder.fold_name(trait_name),
                method: folder.fold_name(method),
                insteadof: fold_owned_names(folder, insteadof),
            },
            TraitAdaptationKind::Alias {
                trait_name,
                method,
                new_modifier,
                is_final,
                invalid_modifier,
                new_name,
            } => TraitAdaptationKind::Alias {
                trait_name: trait_name.map(|n| folder.fold_name(n)),
                method: folder.fold_name(method),
                new_modifier,
                is_final,
                invalid_modifier,
                new_name: new_name.map(|n| folder.fold_name(n)),
            },
        },
        span: a.span,
    }
}

fn fold_owned_class_decl<F: OwnedFold + ?Sized>(folder: &mut F, cls: ClassDecl) -> ClassDecl {
    ClassDecl {
        name: cls.name,
        modifiers: cls.modifiers,
        extends: cls.extends.map(|n| folder.fold_name(n)),
        implements: fold_owned_names(folder, cls.implements),
        body: ClassBody {
            members: fold_owned_members(folder, cls.body.members),
            span: cls.body.span,
        },
        attributes: fold_owned_attrs(folder, cls.attributes),
        doc_comment: cls.doc_comment,
    }
}

fn fold_owned_interface_decl<F: OwnedFold + ?Sized>(
    folder: &mut F,
    iface: InterfaceDecl,
) -> InterfaceDecl {
    InterfaceDecl {
        name: iface.name,
        extends: fold_owned_names(folder, iface.extends),
        body: ClassBody {
            members: fold_owned_members(folder, iface.body.members),
            span: iface.body.span,
        },
        attributes: fold_owned_attrs(folder, iface.attributes),
        doc_comment: iface.doc_comment,
    }
}

fn fold_owned_trait_decl<F: OwnedFold + ?Sized>(folder: &mut F, tr: TraitDecl) -> TraitDecl {
    TraitDecl {
        name: tr.name,
        body: ClassBody {
            members: fold_owned_members(folder, tr.body.members),
            span: tr.body.span,
        },
        attributes: fold_owned_attrs(folder, tr.attributes),
        doc_comment: tr.doc_comment,
    }
}

fn fold_owned_enum_decl<F: OwnedFold + ?Sized>(folder: &mut F, en: EnumDecl) -> EnumDecl {
    EnumDecl {
        name: en.name,
        scalar_type: en.scalar_type.map(|n| folder.fold_name(n)),
        invalid_scalar_type: en.invalid_scalar_type.map(|t| folder.fold_type_hint(t)),
        implements: fold_owned_names(folder, en.implements),
        body: EnumBody {
            members: map_slice(en.body.members, |m| folder.fold_enum_member(m)),
            span: en.body.span,
        },
        attributes: fold_owned_attrs(folder, en.attributes),
        doc_comment: en.doc_comment,
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
            kind: ExprKind::Variable(SmallStr::from(name)),
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
            kind: ExprKind::Assign(Box::new(AssignExpr {
                target,
                op: AssignOp::Assign,
                value,
                by_ref: false,
            })),
            span: Span::DUMMY,
        }
    }

    fn expr_stmt(e: Expr) -> Stmt {
        Stmt {
            kind: StmtKind::Expression(Box::new(e)),
            span: Span::DUMMY,
            doc_comment: None,
        }
    }

    fn empty_block() -> Block {
        Block {
            stmts: Box::from([]),
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
        impl OwnedFold for Identity {}
        let before = serde_json::to_string(&p).unwrap();
        let folded = Identity.fold_program(p);
        assert_eq!(serde_json::to_string(&folded).unwrap(), before);
    }

    /// NegateInts fold on `$x = 42;` must produce `$x = -42;`.
    #[test]
    fn negate_ints() {
        let p = program([expr_stmt(assign(dummy_var("x"), dummy_int(42)))]);
        struct NegateInts;
        impl OwnedFold for NegateInts {
            fn fold_expr(&mut self, expr: Expr) -> Expr {
                if let ExprKind::Int(n) = &expr.kind {
                    return Expr {
                        kind: ExprKind::Int(-n),
                        span: expr.span,
                    };
                }
                fold_owned_expr(self, expr)
            }
        }
        let folded = NegateInts.fold_program(p);
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
        impl OwnedFold for Rename {
            fn fold_expr(&mut self, expr: Expr) -> Expr {
                if let ExprKind::Variable(name) = &expr.kind {
                    if name.as_ref() == "x" {
                        return Expr {
                            kind: ExprKind::Variable(SmallStr::from("renamed")),
                            span: expr.span,
                        };
                    }
                }
                fold_owned_expr(self, expr)
            }
        }
        let folded = Rename.fold_program(p);
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
                missing_param_list: false,
                use_vars: Box::from([ClosureUseVar {
                    name: Ident::new("x", Span::DUMMY),
                    by_ref: false,
                    span: Span::DUMMY,
                }]),
                return_type: None,
                body: Box::new(empty_block()),
                attributes: Box::from([]),
            })),
            span: Span::DUMMY,
        };
        let p = program([expr_stmt(closure)]);

        struct Rename;
        impl OwnedFold for Rename {
            fn fold_closure_use_var(&mut self, var: ClosureUseVar) -> ClosureUseVar {
                ClosureUseVar {
                    name: if var.name == "x" {
                        Ident::new("renamed", var.name.span)
                    } else {
                        var.name
                    },
                    by_ref: var.by_ref,
                    span: var.span,
                }
            }
        }

        let folded = Rename.fold_program(p);
        if let StmtKind::Expression(expr) = &folded.stmts[0].kind {
            if let ExprKind::Closure(c) = &expr.kind {
                assert_eq!(c.use_vars[0].name, "renamed");
                return;
            }
        }
        panic!("expected closure with renamed use-var");
    }

    /// `fold_stmts` sees the program, block and `case` statement lists, and may drop statements.
    #[test]
    fn fold_stmts_hook_can_delete_statements() {
        struct DropNops;
        impl OwnedFold for DropNops {
            fn fold_stmts(&mut self, stmts: Box<[Stmt]>) -> Box<[Stmt]> {
                let kept: Vec<Stmt> = stmts
                    .into_vec()
                    .into_iter()
                    .filter(|s| !matches!(s.kind, StmtKind::Nop))
                    .map(|s| self.fold_stmt(s))
                    .collect();
                kept.into_boxed_slice()
            }
        }
        let nop = || Stmt {
            kind: StmtKind::Nop,
            span: Span::DUMMY,
            doc_comment: None,
        };
        let nested = Stmt {
            kind: StmtKind::Block(Box::new(Block {
                stmts: Box::from([nop(), expr_stmt(dummy_int(1))]),
                span: Span::DUMMY,
            })),
            span: Span::DUMMY,
            doc_comment: None,
        };
        let switch = Stmt {
            kind: StmtKind::Switch(Box::new(SwitchStmt {
                expr: dummy_int(0),
                body: SwitchBody {
                    cases: Box::from([SwitchCase {
                        value: None,
                        body: Box::from([nop()]),
                        span: Span::DUMMY,
                    }]),
                    span: Span::DUMMY,
                },
                uses_alternative: false,
            })),
            span: Span::DUMMY,
            doc_comment: None,
        };
        let folded = DropNops.fold_program(program([nop(), nested, switch]));
        assert_eq!(folded.stmts.len(), 2);
        let StmtKind::Block(block) = &folded.stmts[0].kind else {
            panic!("expected Block")
        };
        assert_eq!(block.stmts.len(), 1);
        let StmtKind::Switch(switch) = &folded.stmts[1].kind else {
            panic!("expected Switch")
        };
        assert!(switch.body.cases[0].body.is_empty());
    }
}
