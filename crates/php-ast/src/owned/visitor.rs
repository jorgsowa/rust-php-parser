//! Visitor infrastructure for owned (lifetime-free) PHP AST traversal.
//!
//! This module mirrors [`crate::visitor`] but operates on the owned AST types
//! in [`crate::owned`] rather than the arena-allocated types. Use it after
//! calling [`php_rs_parser::parse()`] — no arena or lifetime management needed.
//!
//! # Example
//!
//! ```
//! use php_ast::owned::visitor::{OwnedVisitor, walk_owned_expr};
//! use php_ast::owned::{Expr, ExprKind};
//! use std::ops::ControlFlow;
//!
//! struct VarCounter { count: usize }
//!
//! impl OwnedVisitor for VarCounter {
//!     fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
//!         if matches!(&expr.kind, ExprKind::Variable(_)) {
//!             self.count += 1;
//!         }
//!         walk_owned_expr(self, expr)
//!     }
//! }
//! ```

use std::ops::ControlFlow;

use super::*;

// =============================================================================
// OwnedVisitor trait
// =============================================================================

/// Visitor trait for immutable traversal of owned (lifetime-free) AST nodes.
///
/// All methods return `ControlFlow<()>`:
/// - `ControlFlow::Continue(())` — keep walking.
/// - `ControlFlow::Break(())` — stop the entire traversal immediately.
///
/// Default implementations recurse into child nodes, so implementors only need
/// to override the node types they care about.
///
/// To **skip** a subtree, override the method and return `Continue(())`
/// without calling the corresponding `walk_owned_*` function.
pub trait OwnedVisitor {
    fn visit_program(&mut self, program: &Program) -> ControlFlow<()> {
        walk_owned_program(self, program)
    }

    fn visit_stmt(&mut self, stmt: &Stmt) -> ControlFlow<()> {
        walk_owned_stmt(self, stmt)
    }

    fn visit_block(&mut self, block: &Block) -> ControlFlow<()> {
        walk_owned_block(self, block)
    }

    fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
        walk_owned_expr(self, expr)
    }

    fn visit_param(&mut self, param: &Param) -> ControlFlow<()> {
        walk_owned_param(self, param)
    }

    fn visit_arg(&mut self, arg: &Arg) -> ControlFlow<()> {
        walk_owned_arg(self, arg)
    }

    fn visit_class_member(&mut self, member: &ClassMember) -> ControlFlow<()> {
        walk_owned_class_member(self, member)
    }

    fn visit_enum_member(&mut self, member: &EnumMember) -> ControlFlow<()> {
        walk_owned_enum_member(self, member)
    }

    fn visit_property_hook(&mut self, hook: &PropertyHook) -> ControlFlow<()> {
        walk_owned_property_hook(self, hook)
    }

    fn visit_type_hint(&mut self, type_hint: &TypeHint) -> ControlFlow<()> {
        walk_owned_type_hint(self, type_hint)
    }

    fn visit_attribute(&mut self, attribute: &Attribute) -> ControlFlow<()> {
        walk_owned_attribute(self, attribute)
    }

    fn visit_catch_clause(&mut self, catch: &CatchClause) -> ControlFlow<()> {
        walk_owned_catch_clause(self, catch)
    }

    fn visit_match_arm(&mut self, arm: &MatchArm) -> ControlFlow<()> {
        walk_owned_match_arm(self, arm)
    }

    fn visit_closure_use_var(&mut self, _var: &ClosureUseVar) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_trait_use(&mut self, trait_use: &TraitUseDecl) -> ControlFlow<()> {
        walk_owned_trait_use(self, trait_use)
    }

    fn visit_trait_adaptation(&mut self, _adaptation: &TraitAdaptation) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_name(&mut self, _name: &Name) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_comment(&mut self, _comment: &Comment) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
}

// =============================================================================
// Walk functions
// =============================================================================

/// Calls [`OwnedVisitor::visit_name`] on `name`.
///
/// `Name` is a leaf node — there are no child nodes to recurse into.
/// This function exists for symmetry with [`walk_owned_expr`] and friends so
/// that an override of [`OwnedVisitor::visit_name`] can call the default
/// behaviour by name.
pub fn walk_owned_name<V: OwnedVisitor + ?Sized>(visitor: &mut V, name: &Name) -> ControlFlow<()> {
    visitor.visit_name(name)
}

/// Calls [`OwnedVisitor::visit_comment`] for each comment in `comments`.
pub fn walk_owned_comments<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    comments: &[Comment],
) -> ControlFlow<()> {
    for comment in comments {
        visitor.visit_comment(comment)?;
    }
    ControlFlow::Continue(())
}

/// Visits every top-level statement in `program`.
pub fn walk_owned_program<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    program: &Program,
) -> ControlFlow<()> {
    for stmt in program.stmts.iter() {
        visitor.visit_stmt(stmt)?;
    }
    ControlFlow::Continue(())
}

/// Dispatches `stmt` to the appropriate child visitors based on its [`StmtKind`].
pub fn walk_owned_block<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    block: &Block,
) -> ControlFlow<()> {
    for stmt in block.stmts.iter() {
        visitor.visit_stmt(stmt)?;
    }
    ControlFlow::Continue(())
}

pub fn walk_owned_stmt<V: OwnedVisitor + ?Sized>(visitor: &mut V, stmt: &Stmt) -> ControlFlow<()> {
    match &stmt.kind {
        StmtKind::Expression(expr) => {
            visitor.visit_expr(expr)?;
        }
        StmtKind::Echo(exprs) => {
            for expr in exprs.iter() {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Return(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Block(block) => {
            visitor.visit_block(block)?;
        }
        StmtKind::If(if_stmt) => {
            visitor.visit_expr(&if_stmt.condition)?;
            visitor.visit_stmt(&if_stmt.then_branch)?;
            for elseif in if_stmt.elseif_branches.iter() {
                visitor.visit_expr(&elseif.condition)?;
                visitor.visit_stmt(&elseif.body)?;
            }
            if let Some(else_branch) = &if_stmt.else_branch {
                visitor.visit_stmt(else_branch)?;
            }
        }
        StmtKind::While(while_stmt) => {
            visitor.visit_expr(&while_stmt.condition)?;
            visitor.visit_stmt(&while_stmt.body)?;
        }
        StmtKind::For(for_stmt) => {
            for expr in for_stmt.init.iter() {
                visitor.visit_expr(expr)?;
            }
            for expr in for_stmt.condition.iter() {
                visitor.visit_expr(expr)?;
            }
            for expr in for_stmt.update.iter() {
                visitor.visit_expr(expr)?;
            }
            visitor.visit_stmt(&for_stmt.body)?;
        }
        StmtKind::Foreach(foreach_stmt) => {
            visitor.visit_expr(&foreach_stmt.expr)?;
            if let Some(key) = &foreach_stmt.key {
                visitor.visit_expr(key)?;
            }
            visitor.visit_expr(&foreach_stmt.value)?;
            visitor.visit_stmt(&foreach_stmt.body)?;
        }
        StmtKind::DoWhile(do_while) => {
            visitor.visit_stmt(&do_while.body)?;
            visitor.visit_expr(&do_while.condition)?;
        }
        StmtKind::Function(func) => {
            walk_owned_function_like(visitor, &func.attributes, &func.params, &func.return_type)?;
            visitor.visit_block(&func.body)?;
        }
        StmtKind::Break(expr) | StmtKind::Continue(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Switch(switch_stmt) => {
            visitor.visit_expr(&switch_stmt.expr)?;
            for case in switch_stmt.body.cases.iter() {
                if let Some(value) = &case.value {
                    visitor.visit_expr(value)?;
                }
                for stmt in case.body.iter() {
                    visitor.visit_stmt(stmt)?;
                }
            }
        }
        StmtKind::Throw(expr) => {
            visitor.visit_expr(expr)?;
        }
        StmtKind::TryCatch(tc) => {
            visitor.visit_block(&tc.body)?;
            for catch in tc.catches.iter() {
                visitor.visit_catch_clause(catch)?;
            }
            if let Some(finally) = &tc.finally {
                visitor.visit_block(finally)?;
            }
        }
        StmtKind::Declare(decl) => {
            for (_, expr) in decl.directives.iter() {
                visitor.visit_expr(expr)?;
            }
            if let Some(body) = &decl.body {
                visitor.visit_stmt(body)?;
            }
        }
        StmtKind::Unset(exprs) | StmtKind::Global(exprs) => {
            for expr in exprs.iter() {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Class(class) => {
            walk_owned_attributes(visitor, &class.attributes)?;
            if let Some(extends) = &class.extends {
                visitor.visit_name(extends)?;
            }
            for name in class.implements.iter() {
                visitor.visit_name(name)?;
            }
            for member in class.body.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Interface(iface) => {
            walk_owned_attributes(visitor, &iface.attributes)?;
            for name in iface.extends.iter() {
                visitor.visit_name(name)?;
            }
            for member in iface.body.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Trait(trait_decl) => {
            walk_owned_attributes(visitor, &trait_decl.attributes)?;
            for member in trait_decl.body.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Enum(enum_decl) => {
            walk_owned_attributes(visitor, &enum_decl.attributes)?;
            if let Some(scalar_type) = &enum_decl.scalar_type {
                visitor.visit_name(scalar_type)?;
            }
            for name in enum_decl.implements.iter() {
                visitor.visit_name(name)?;
            }
            for member in enum_decl.body.members.iter() {
                visitor.visit_enum_member(member)?;
            }
        }
        StmtKind::Namespace(ns) => {
            if let NamespaceBody::Braced(block) = &ns.body {
                visitor.visit_block(block)?;
            }
        }
        StmtKind::Const(items) => {
            for item in items.iter() {
                walk_owned_attributes(visitor, &item.attributes)?;
                visitor.visit_expr(&item.value)?;
            }
        }
        StmtKind::StaticVar(vars) => {
            for var in vars.iter() {
                if let Some(default) = &var.default {
                    visitor.visit_expr(default)?;
                }
            }
        }
        StmtKind::Use(decl) => {
            for item in decl.uses.iter() {
                visitor.visit_name(&item.name)?;
            }
        }
        StmtKind::Goto(_)
        | StmtKind::Label(_)
        | StmtKind::Nop
        | StmtKind::InlineHtml(_)
        | StmtKind::HaltCompiler(_)
        | StmtKind::Error => {}
    }
    ControlFlow::Continue(())
}

/// Dispatches `expr` to the appropriate child visitors based on its [`ExprKind`].
pub fn walk_owned_expr<V: OwnedVisitor + ?Sized>(visitor: &mut V, expr: &Expr) -> ControlFlow<()> {
    match &expr.kind {
        ExprKind::Assign(assign) => {
            visitor.visit_expr(&assign.target)?;
            visitor.visit_expr(&assign.value)?;
        }
        ExprKind::Binary(binary) => {
            visitor.visit_expr(&binary.left)?;
            visitor.visit_expr(&binary.right)?;
        }
        ExprKind::UnaryPrefix(unary) => {
            visitor.visit_expr(&unary.operand)?;
        }
        ExprKind::UnaryPostfix(unary) => {
            visitor.visit_expr(&unary.operand)?;
        }
        ExprKind::Ternary(ternary) => {
            visitor.visit_expr(&ternary.condition)?;
            if let Some(then_expr) = &ternary.then_expr {
                visitor.visit_expr(then_expr)?;
            }
            visitor.visit_expr(&ternary.else_expr)?;
        }
        ExprKind::NullCoalesce(nc) => {
            visitor.visit_expr(&nc.left)?;
            visitor.visit_expr(&nc.right)?;
        }
        ExprKind::FunctionCall(call) => {
            visitor.visit_expr(&call.name)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::Array(elements) => {
            for elem in elements.iter() {
                if let Some(key) = &elem.key {
                    visitor.visit_expr(key)?;
                }
                visitor.visit_expr(&elem.value)?;
            }
        }
        ExprKind::ArrayAccess(access) => {
            visitor.visit_expr(&access.array)?;
            if let Some(index) = &access.index {
                visitor.visit_expr(index)?;
            }
        }
        ExprKind::Print(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Parenthesized(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Cast(_, expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::ErrorSuppress(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Isset(exprs) => {
            for expr in exprs.iter() {
                visitor.visit_expr(expr)?;
            }
        }
        ExprKind::Empty(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Include(_, expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Eval(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Exit(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr)?;
            }
        }
        ExprKind::Clone(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::CloneWith(object, overrides) => {
            visitor.visit_expr(object)?;
            visitor.visit_expr(overrides)?;
        }
        ExprKind::New(new_expr) => {
            visitor.visit_expr(&new_expr.class)?;
            for arg in new_expr.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            visitor.visit_expr(&access.object)?;
            visitor.visit_expr(&access.property)?;
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => {
            visitor.visit_expr(&call.object)?;
            visitor.visit_expr(&call.method)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => {
            visitor.visit_expr(&access.class)?;
            visitor.visit_expr(&access.member)?;
        }
        ExprKind::ClassConstAccessDynamic { class, member }
        | ExprKind::StaticPropertyAccessDynamic { class, member } => {
            visitor.visit_expr(class)?;
            visitor.visit_expr(member)?;
        }
        ExprKind::StaticMethodCall(call) => {
            visitor.visit_expr(&call.class)?;
            visitor.visit_expr(&call.method)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::StaticDynMethodCall(call) => {
            visitor.visit_expr(&call.class)?;
            visitor.visit_expr(&call.method)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::Closure(closure) => {
            walk_owned_function_like(
                visitor,
                &closure.attributes,
                &closure.params,
                &closure.return_type,
            )?;
            for use_var in closure.use_vars.iter() {
                visitor.visit_closure_use_var(use_var)?;
            }
            visitor.visit_block(&closure.body)?;
        }
        ExprKind::ArrowFunction(arrow) => {
            walk_owned_function_like(
                visitor,
                &arrow.attributes,
                &arrow.params,
                &arrow.return_type,
            )?;
            visitor.visit_expr(&arrow.body)?;
        }
        ExprKind::Match(match_expr) => {
            visitor.visit_expr(&match_expr.subject)?;
            for arm in match_expr.arms.iter() {
                visitor.visit_match_arm(arm)?;
            }
        }
        ExprKind::ThrowExpr(expr) => {
            visitor.visit_expr(expr)?;
        }
        ExprKind::Yield(yield_expr) => {
            if let Some(key) = &yield_expr.key {
                visitor.visit_expr(key)?;
            }
            if let Some(value) = &yield_expr.value {
                visitor.visit_expr(value)?;
            }
        }
        ExprKind::AnonymousClass(class) => {
            walk_owned_attributes(visitor, &class.attributes)?;
            for member in class.body.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        ExprKind::InterpolatedString(parts) | ExprKind::ShellExec(parts) => {
            for part in parts.iter() {
                if let StringPart::Expr(e) = part {
                    visitor.visit_expr(e)?;
                }
            }
        }
        ExprKind::Heredoc { parts, .. } => {
            for part in parts.iter() {
                if let StringPart::Expr(e) = part {
                    visitor.visit_expr(e)?;
                }
            }
        }
        ExprKind::VariableVariable(inner) => {
            visitor.visit_expr(inner)?;
        }
        ExprKind::CallableCreate(cc) => match &cc.kind {
            CallableCreateKind::Function(name) => visitor.visit_expr(name)?,
            CallableCreateKind::Method { object, method }
            | CallableCreateKind::NullsafeMethod { object, method } => {
                visitor.visit_expr(object)?;
                visitor.visit_expr(method)?;
            }
            CallableCreateKind::StaticMethod { class, method } => {
                visitor.visit_expr(class)?;
                visitor.visit_expr(method)?;
            }
        },
        ExprKind::Int(_)
        | ExprKind::Float(_)
        | ExprKind::String(_)
        | ExprKind::Bool(_)
        | ExprKind::Null
        | ExprKind::Omit
        | ExprKind::Variable(_)
        | ExprKind::Identifier(_)
        | ExprKind::MagicConst(_)
        | ExprKind::Nowdoc { .. }
        | ExprKind::Error => {}
    }
    ControlFlow::Continue(())
}

/// Visits a function/method parameter's attributes, type hint, default, and hooks.
pub fn walk_owned_param<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    param: &Param,
) -> ControlFlow<()> {
    walk_owned_attributes(visitor, &param.attributes)?;
    if let Some(type_hint) = &param.type_hint {
        visitor.visit_type_hint(type_hint)?;
    }
    if let Some(default) = &param.default {
        visitor.visit_expr(default)?;
    }
    for hook in param.hooks.iter() {
        visitor.visit_property_hook(hook)?;
    }
    ControlFlow::Continue(())
}

/// Visits the value expression of a call argument.
pub fn walk_owned_arg<V: OwnedVisitor + ?Sized>(visitor: &mut V, arg: &Arg) -> ControlFlow<()> {
    visitor.visit_expr(&arg.value)
}

/// Dispatches a class member to its child visitors.
pub fn walk_owned_class_member<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    member: &ClassMember,
) -> ControlFlow<()> {
    match &member.kind {
        ClassMemberKind::Property(prop) => {
            walk_owned_property_decl(visitor, prop)?;
        }
        ClassMemberKind::Method(method) => {
            walk_owned_method_decl(visitor, method)?;
        }
        ClassMemberKind::ClassConst(cc) => {
            walk_owned_class_const_decl(visitor, cc)?;
        }
        ClassMemberKind::TraitUse(trait_use) => {
            visitor.visit_trait_use(trait_use)?;
        }
    }
    ControlFlow::Continue(())
}

/// Visits a property hook's attributes, parameters, and body.
pub fn walk_owned_property_hook<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    hook: &PropertyHook,
) -> ControlFlow<()> {
    walk_owned_attributes(visitor, &hook.attributes)?;
    for param in hook.params.iter() {
        visitor.visit_param(param)?;
    }
    match &hook.body {
        PropertyHookBody::Block(block) => {
            visitor.visit_block(block)?;
        }
        PropertyHookBody::Expression(expr) => {
            visitor.visit_expr(expr)?;
        }
        PropertyHookBody::Abstract => {}
    }
    ControlFlow::Continue(())
}

/// Dispatches an enum member to its child visitors.
pub fn walk_owned_enum_member<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    member: &EnumMember,
) -> ControlFlow<()> {
    match &member.kind {
        EnumMemberKind::Case(case) => {
            walk_owned_attributes(visitor, &case.attributes)?;
            if let Some(value) = &case.value {
                visitor.visit_expr(value)?;
            }
        }
        EnumMemberKind::Method(method) => {
            walk_owned_method_decl(visitor, method)?;
        }
        EnumMemberKind::ClassConst(cc) => {
            walk_owned_class_const_decl(visitor, cc)?;
        }
        EnumMemberKind::TraitUse(trait_use) => {
            visitor.visit_trait_use(trait_use)?;
        }
    }
    ControlFlow::Continue(())
}

/// Visits the inner types of a type hint.
pub fn walk_owned_type_hint<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    type_hint: &TypeHint,
) -> ControlFlow<()> {
    match &type_hint.kind {
        TypeHintKind::Nullable(inner) => {
            visitor.visit_type_hint(inner)?;
        }
        TypeHintKind::Union(types) | TypeHintKind::Intersection(types) => {
            for ty in types.iter() {
                visitor.visit_type_hint(ty)?;
            }
        }
        TypeHintKind::Named(name) => {
            visitor.visit_name(name)?;
        }
        TypeHintKind::Keyword(_, _) => {}
    }
    ControlFlow::Continue(())
}

/// Visits an attribute's name and argument expressions.
pub fn walk_owned_attribute<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    attribute: &Attribute,
) -> ControlFlow<()> {
    visitor.visit_name(&attribute.name)?;
    for arg in attribute.args.iter() {
        visitor.visit_arg(arg)?;
    }
    ControlFlow::Continue(())
}

/// Visits a catch clause's type names and body statements.
pub fn walk_owned_catch_clause<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    catch: &CatchClause,
) -> ControlFlow<()> {
    for ty in catch.types.iter() {
        visitor.visit_name(ty)?;
    }
    visitor.visit_block(&catch.body)?;
    ControlFlow::Continue(())
}

/// Visits a match arm's condition expressions and body expression.
pub fn walk_owned_match_arm<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    arm: &MatchArm,
) -> ControlFlow<()> {
    if let Some(conditions) = &arm.conditions {
        for cond in conditions.iter() {
            visitor.visit_expr(cond)?;
        }
    }
    visitor.visit_expr(&arm.body)
}

/// Visits a trait use declaration's names and adaptations.
pub fn walk_owned_trait_use<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    trait_use: &TraitUseDecl,
) -> ControlFlow<()> {
    for name in trait_use.traits.iter() {
        visitor.visit_name(name)?;
    }
    for adaptation in trait_use.adaptations.iter() {
        visitor.visit_trait_adaptation(adaptation)?;
    }
    ControlFlow::Continue(())
}

// =============================================================================
// Internal helpers
// =============================================================================

fn walk_owned_function_like<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    attributes: &[Attribute],
    params: &[Param],
    return_type: &Option<TypeHint>,
) -> ControlFlow<()> {
    walk_owned_attributes(visitor, attributes)?;
    for param in params.iter() {
        visitor.visit_param(param)?;
    }
    if let Some(ret) = return_type {
        visitor.visit_type_hint(ret)?;
    }
    ControlFlow::Continue(())
}

fn walk_owned_method_decl<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    method: &MethodDecl,
) -> ControlFlow<()> {
    walk_owned_function_like(
        visitor,
        &method.attributes,
        &method.params,
        &method.return_type,
    )?;
    if let Some(body) = &method.body {
        visitor.visit_block(body)?;
    }
    ControlFlow::Continue(())
}

fn walk_owned_class_const_decl<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    cc: &ClassConstDecl,
) -> ControlFlow<()> {
    walk_owned_attributes(visitor, &cc.attributes)?;
    if let Some(type_hint) = &cc.type_hint {
        visitor.visit_type_hint(type_hint)?;
    }
    visitor.visit_expr(&cc.value)
}

fn walk_owned_property_decl<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    prop: &PropertyDecl,
) -> ControlFlow<()> {
    walk_owned_attributes(visitor, &prop.attributes)?;
    if let Some(type_hint) = &prop.type_hint {
        visitor.visit_type_hint(type_hint)?;
    }
    if let Some(default) = &prop.default {
        visitor.visit_expr(default)?;
    }
    for hook in prop.hooks.iter() {
        visitor.visit_property_hook(hook)?;
    }
    ControlFlow::Continue(())
}

fn walk_owned_attributes<V: OwnedVisitor + ?Sized>(
    visitor: &mut V,
    attributes: &[Attribute],
) -> ControlFlow<()> {
    for attr in attributes.iter() {
        visitor.visit_attribute(attr)?;
    }
    ControlFlow::Continue(())
}

// =============================================================================
// OwnedScopeVisitor — scope-aware traversal
// =============================================================================

/// Lexical scope context for owned AST traversal.
///
/// Like [`crate::visitor::Scope`] but uses `Option<String>` instead of
/// `Option<&str>` so the owned visitor has no lifetime parameters.
#[derive(Debug, Clone, Default)]
pub struct OwnedScope {
    /// Current namespace, or `None` for the global namespace.
    pub namespace: Option<String>,
    /// Name of the immediately enclosing class-like declaration, or `None`.
    pub class_name: Option<String>,
    /// Name of the immediately enclosing named function or method, or `None`.
    pub function_name: Option<String>,
}

/// A scope-aware variant of [`OwnedVisitor`].
///
/// Every visit method receives an [`OwnedScope`] describing the lexical context
/// at that node. Drive traversal with [`OwnedScopeWalker`].
pub trait OwnedScopeVisitor {
    fn visit_program(&mut self, _program: &Program, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_stmt(&mut self, _stmt: &Stmt, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_expr(&mut self, _expr: &Expr, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_param(&mut self, _param: &Param, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_arg(&mut self, _arg: &Arg, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_class_member(
        &mut self,
        _member: &ClassMember,
        _scope: &OwnedScope,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_enum_member(&mut self, _member: &EnumMember, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_property_hook(
        &mut self,
        _hook: &PropertyHook,
        _scope: &OwnedScope,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_type_hint(&mut self, _type_hint: &TypeHint, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_attribute(&mut self, _attribute: &Attribute, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_catch_clause(&mut self, _catch: &CatchClause, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_match_arm(&mut self, _arm: &MatchArm, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_closure_use_var(
        &mut self,
        _var: &ClosureUseVar,
        _scope: &OwnedScope,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_trait_use(
        &mut self,
        _trait_use: &TraitUseDecl,
        _scope: &OwnedScope,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_trait_adaptation(
        &mut self,
        _adaptation: &TraitAdaptation,
        _scope: &OwnedScope,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_comment(&mut self, _comment: &Comment, _scope: &OwnedScope) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
}

/// Drives an [`OwnedScopeVisitor`] over an owned AST, maintaining [`OwnedScope`] automatically.
pub struct OwnedScopeWalker<V> {
    inner: V,
    scope: OwnedScope,
}

impl<V> OwnedScopeWalker<V> {
    /// Creates a new walker wrapping `inner`.
    pub fn new(inner: V) -> Self {
        Self {
            inner,
            scope: OwnedScope::default(),
        }
    }

    /// Consumes the walker and returns the inner visitor.
    pub fn into_inner(self) -> V {
        self.inner
    }

    /// Returns a reference to the inner visitor.
    pub fn inner(&self) -> &V {
        &self.inner
    }

    /// Returns a mutable reference to the inner visitor.
    pub fn inner_mut(&mut self) -> &mut V {
        &mut self.inner
    }
}

impl<V: OwnedScopeVisitor> OwnedScopeWalker<V> {
    /// Walks `program`, calling [`OwnedScopeVisitor`] methods with scope context.
    pub fn walk(&mut self, program: &Program) -> ControlFlow<()> {
        self.visit_program(program)
    }
}

fn owned_name_repr(name: &Name) -> Option<String> {
    if name.parts.is_empty() {
        return None;
    }
    Some(
        name.parts
            .iter()
            .map(|s| s.as_ref())
            .collect::<Vec<_>>()
            .join("\\"),
    )
}

impl<V: OwnedScopeVisitor> OwnedVisitor for OwnedScopeWalker<V> {
    fn visit_program(&mut self, program: &Program) -> ControlFlow<()> {
        self.inner.visit_program(program, &self.scope)?;
        walk_owned_program(self, program)
    }

    fn visit_stmt(&mut self, stmt: &Stmt) -> ControlFlow<()> {
        self.inner.visit_stmt(stmt, &self.scope)?;
        match &stmt.kind {
            StmtKind::Function(func) => {
                let fn_name = func.name.as_ref().map(|n| n.to_string());
                let prev_fn = std::mem::replace(&mut self.scope.function_name, fn_name);
                walk_owned_stmt(self, stmt)?;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Class(class) => {
                let class_name = class
                    .name
                    .as_ref()
                    .and_then(|ident| ident.as_ref())
                    .map(|s| s.to_string());
                let prev_class = std::mem::replace(&mut self.scope.class_name, class_name);
                let prev_fn = self.scope.function_name.take();
                walk_owned_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Interface(iface) => {
                let iface_name = iface.name.as_ref().map(|n| n.to_string());
                let prev_class = std::mem::replace(&mut self.scope.class_name, iface_name);
                let prev_fn = self.scope.function_name.take();
                walk_owned_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Trait(trait_decl) => {
                let trait_name = trait_decl.name.as_ref().map(|n| n.to_string());
                let prev_class = std::mem::replace(&mut self.scope.class_name, trait_name);
                let prev_fn = self.scope.function_name.take();
                walk_owned_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Enum(enum_decl) => {
                let enum_name = enum_decl.name.as_ref().map(|n| n.to_string());
                let prev_class = std::mem::replace(&mut self.scope.class_name, enum_name);
                let prev_fn = self.scope.function_name.take();
                walk_owned_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Namespace(ns) => {
                let ns_str = ns.name.as_ref().and_then(owned_name_repr);
                match &ns.body {
                    NamespaceBody::Braced(_) => {
                        let prev_ns = std::mem::replace(&mut self.scope.namespace, ns_str);
                        let prev_class = self.scope.class_name.take();
                        let prev_fn = self.scope.function_name.take();
                        walk_owned_stmt(self, stmt)?;
                        self.scope.namespace = prev_ns;
                        self.scope.class_name = prev_class;
                        self.scope.function_name = prev_fn;
                    }
                    NamespaceBody::Simple => {
                        self.scope.namespace = ns_str;
                        self.scope.class_name = None;
                        self.scope.function_name = None;
                    }
                }
            }
            _ => {
                walk_owned_stmt(self, stmt)?;
            }
        }
        ControlFlow::Continue(())
    }

    fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
        self.inner.visit_expr(expr, &self.scope)?;
        match &expr.kind {
            ExprKind::Closure(_) | ExprKind::ArrowFunction(_) => {
                let prev_fn = self.scope.function_name.take();
                walk_owned_expr(self, expr)?;
                self.scope.function_name = prev_fn;
            }
            ExprKind::AnonymousClass(_) => {
                let prev_class = self.scope.class_name.take();
                let prev_fn = self.scope.function_name.take();
                walk_owned_expr(self, expr)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            _ => {
                walk_owned_expr(self, expr)?;
            }
        }
        ControlFlow::Continue(())
    }

    fn visit_class_member(&mut self, member: &ClassMember) -> ControlFlow<()> {
        self.inner.visit_class_member(member, &self.scope)?;
        if let ClassMemberKind::Method(method) = &member.kind {
            let fn_name = method.name.as_ref().map(|n| n.to_string());
            let prev_fn = std::mem::replace(&mut self.scope.function_name, fn_name);
            walk_owned_class_member(self, member)?;
            self.scope.function_name = prev_fn;
        } else {
            walk_owned_class_member(self, member)?;
        }
        ControlFlow::Continue(())
    }

    fn visit_enum_member(&mut self, member: &EnumMember) -> ControlFlow<()> {
        self.inner.visit_enum_member(member, &self.scope)?;
        if let EnumMemberKind::Method(method) = &member.kind {
            let fn_name = method.name.as_ref().map(|n| n.to_string());
            let prev_fn = std::mem::replace(&mut self.scope.function_name, fn_name);
            walk_owned_enum_member(self, member)?;
            self.scope.function_name = prev_fn;
        } else {
            walk_owned_enum_member(self, member)?;
        }
        ControlFlow::Continue(())
    }

    fn visit_param(&mut self, param: &Param) -> ControlFlow<()> {
        self.inner.visit_param(param, &self.scope)?;
        walk_owned_param(self, param)
    }

    fn visit_arg(&mut self, arg: &Arg) -> ControlFlow<()> {
        self.inner.visit_arg(arg, &self.scope)?;
        walk_owned_arg(self, arg)
    }

    fn visit_property_hook(&mut self, hook: &PropertyHook) -> ControlFlow<()> {
        self.inner.visit_property_hook(hook, &self.scope)?;
        walk_owned_property_hook(self, hook)
    }

    fn visit_type_hint(&mut self, type_hint: &TypeHint) -> ControlFlow<()> {
        self.inner.visit_type_hint(type_hint, &self.scope)?;
        walk_owned_type_hint(self, type_hint)
    }

    fn visit_attribute(&mut self, attribute: &Attribute) -> ControlFlow<()> {
        self.inner.visit_attribute(attribute, &self.scope)?;
        walk_owned_attribute(self, attribute)
    }

    fn visit_catch_clause(&mut self, catch: &CatchClause) -> ControlFlow<()> {
        self.inner.visit_catch_clause(catch, &self.scope)?;
        walk_owned_catch_clause(self, catch)
    }

    fn visit_match_arm(&mut self, arm: &MatchArm) -> ControlFlow<()> {
        self.inner.visit_match_arm(arm, &self.scope)?;
        walk_owned_match_arm(self, arm)
    }

    fn visit_closure_use_var(&mut self, var: &ClosureUseVar) -> ControlFlow<()> {
        self.inner.visit_closure_use_var(var, &self.scope)
    }

    fn visit_trait_use(&mut self, trait_use: &TraitUseDecl) -> ControlFlow<()> {
        self.inner.visit_trait_use(trait_use, &self.scope)?;
        walk_owned_trait_use(self, trait_use)
    }

    fn visit_trait_adaptation(&mut self, adaptation: &TraitAdaptation) -> ControlFlow<()> {
        self.inner.visit_trait_adaptation(adaptation, &self.scope)
    }

    fn visit_comment(&mut self, comment: &Comment) -> ControlFlow<()> {
        self.inner.visit_comment(comment, &self.scope)
    }
}

// =============================================================================
// Tests
// =============================================================================

#[cfg(test)]
mod tests {
    use super::*;
    use crate::ast::{AssignOp, BinaryOp};
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

    fn binary(left: Expr, op: BinaryOp, right: Expr) -> Expr {
        Expr {
            kind: ExprKind::Binary(BinaryExpr {
                left: Box::new(left),
                op,
                right: Box::new(right),
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

    fn block_of(stmts: impl IntoIterator<Item = Stmt>) -> Box<Block> {
        Box::new(Block {
            stmts: stmts.into_iter().collect(),
            span: Span::DUMMY,
        })
    }

    fn program(stmts: impl IntoIterator<Item = Stmt>) -> Program {
        Program {
            stmts: stmts.into_iter().collect(),
            span: Span::DUMMY,
        }
    }

    struct VarCounter {
        count: usize,
    }

    impl OwnedVisitor for VarCounter {
        fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
            if matches!(&expr.kind, ExprKind::Variable(_)) {
                self.count += 1;
            }
            walk_owned_expr(self, expr)
        }
    }

    #[test]
    fn counts_variables() {
        // $x = $y + $z;
        let p = program([expr_stmt(Expr {
            kind: ExprKind::Assign(AssignExpr {
                target: Box::new(dummy_var("x")),
                op: AssignOp::Assign,
                value: Box::new(binary(dummy_var("y"), BinaryOp::Add, dummy_var("z"))),
                by_ref: false,
            }),
            span: Span::DUMMY,
        })]);
        let mut v = VarCounter { count: 0 };
        let _ = v.visit_program(&p);
        assert_eq!(v.count, 3);
    }

    #[test]
    fn early_termination() {
        // $a + $b;
        let p = program([expr_stmt(binary(
            dummy_var("a"),
            BinaryOp::Add,
            dummy_var("b"),
        ))]);

        struct FindFirst {
            found: Option<String>,
        }
        impl OwnedVisitor for FindFirst {
            fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
                if let ExprKind::Variable(name) = &expr.kind {
                    self.found = Some(name.to_string());
                    return ControlFlow::Break(());
                }
                walk_owned_expr(self, expr)
            }
        }

        let mut finder = FindFirst { found: None };
        let r = finder.visit_program(&p);
        assert!(r.is_break());
        assert_eq!(finder.found.as_deref(), Some("a"));
    }

    #[test]
    fn skip_subtree() {
        // 1 + 2; function foo() { 3 + 4; }
        let top = binary(dummy_int(1), BinaryOp::Add, dummy_int(2));
        let inner = binary(dummy_int(3), BinaryOp::Add, dummy_int(4));
        let func = Stmt {
            kind: StmtKind::Function(Box::new(FunctionDecl {
                name: Some(Box::from("foo")),
                params: Box::from([]),
                body: block_of([expr_stmt(inner)]),
                return_type: None,
                by_ref: false,
                attributes: Box::from([]),
                doc_comment: None,
            })),
            span: Span::DUMMY,
        };
        let p = program([expr_stmt(top), func]);

        struct SkipFunctions {
            expr_count: usize,
        }
        impl OwnedVisitor for SkipFunctions {
            fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
                self.expr_count += 1;
                walk_owned_expr(self, expr)
            }
            fn visit_stmt(&mut self, stmt: &Stmt) -> ControlFlow<()> {
                if matches!(&stmt.kind, StmtKind::Function(_)) {
                    return ControlFlow::Continue(());
                }
                walk_owned_stmt(self, stmt)
            }
        }

        let mut v = SkipFunctions { expr_count: 0 };
        let _ = v.visit_program(&p);
        // Only top-level: binary(1, 2) = 3 exprs
        assert_eq!(v.expr_count, 3);
    }

    #[test]
    fn scope_walker_tracks_class_and_method() {
        // class Foo { public function bar() { $x; } }
        let method = ClassMember {
            kind: ClassMemberKind::Method(MethodDecl {
                name: Some(Box::from("bar")),
                visibility: Some(crate::ast::Visibility::Public),
                is_static: false,
                is_abstract: false,
                is_final: false,
                by_ref: false,
                params: Box::from([]),
                return_type: None,
                body: Some(block_of([expr_stmt(dummy_var("x"))])),
                attributes: Box::from([]),
                doc_comment: None,
            }),
            span: Span::DUMMY,
        };
        let class_stmt = Stmt {
            kind: StmtKind::Class(Box::new(ClassDecl {
                name: Some(Some(Box::from("Foo"))),
                modifiers: crate::ast::ClassModifiers::default(),
                extends: None,
                implements: Box::from([]),
                body: ClassBody {
                    members: [method].into_iter().collect(),
                    span: Span::DUMMY,
                },
                attributes: Box::from([]),
                doc_comment: None,
            })),
            span: Span::DUMMY,
        };
        let p = program([class_stmt]);

        struct MethodCollector {
            methods: Vec<String>,
        }
        impl OwnedScopeVisitor for MethodCollector {
            fn visit_class_member(
                &mut self,
                member: &ClassMember,
                scope: &OwnedScope,
            ) -> ControlFlow<()> {
                if let ClassMemberKind::Method(m) = &member.kind {
                    self.methods.push(format!(
                        "{}::{}",
                        scope.class_name.as_deref().unwrap_or("<anon>"),
                        m.name.as_deref().unwrap_or("<error>"),
                    ));
                }
                ControlFlow::Continue(())
            }
        }

        let mut walker = OwnedScopeWalker::new(MethodCollector { methods: vec![] });
        let _ = walker.walk(&p);
        assert_eq!(walker.into_inner().methods, ["Foo::bar"]);
    }
}
