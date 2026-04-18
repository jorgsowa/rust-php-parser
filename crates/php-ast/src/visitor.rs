use std::ops::ControlFlow;

use crate::ast::*;

/// Visitor trait for immutable AST traversal.
///
/// All methods return `ControlFlow<()>`:
/// - `ControlFlow::Continue(())` — keep walking.
/// - `ControlFlow::Break(())` — stop the entire traversal immediately.
///
/// Default implementations recursively walk child nodes, so implementors
/// only need to override the node types they care about.
///
/// To **skip** a subtree, override the method and return `Continue(())`
/// without calling the corresponding `walk_*` function.
///
/// # Example
///
/// ```
/// use php_ast::visitor::{Visitor, walk_expr};
/// use php_ast::ast::*;
/// use std::ops::ControlFlow;
///
/// struct VarCounter { count: usize }
///
/// impl<'arena, 'src> Visitor<'arena, 'src> for VarCounter {
///     fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
///         if matches!(&expr.kind, ExprKind::Variable(_)) {
///             self.count += 1;
///         }
///         walk_expr(self, expr)
///     }
/// }
/// ```
pub trait Visitor<'arena, 'src> {
    fn visit_program(&mut self, program: &Program<'arena, 'src>) -> ControlFlow<()> {
        walk_program(self, program)
    }

    fn visit_stmt(&mut self, stmt: &Stmt<'arena, 'src>) -> ControlFlow<()> {
        walk_stmt(self, stmt)
    }

    fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
        walk_expr(self, expr)
    }

    fn visit_param(&mut self, param: &Param<'arena, 'src>) -> ControlFlow<()> {
        walk_param(self, param)
    }

    fn visit_arg(&mut self, arg: &Arg<'arena, 'src>) -> ControlFlow<()> {
        walk_arg(self, arg)
    }

    fn visit_class_member(&mut self, member: &ClassMember<'arena, 'src>) -> ControlFlow<()> {
        walk_class_member(self, member)
    }

    fn visit_enum_member(&mut self, member: &EnumMember<'arena, 'src>) -> ControlFlow<()> {
        walk_enum_member(self, member)
    }

    fn visit_property_hook(&mut self, hook: &PropertyHook<'arena, 'src>) -> ControlFlow<()> {
        walk_property_hook(self, hook)
    }

    fn visit_type_hint(&mut self, type_hint: &TypeHint<'arena, 'src>) -> ControlFlow<()> {
        walk_type_hint(self, type_hint)
    }

    fn visit_attribute(&mut self, attribute: &Attribute<'arena, 'src>) -> ControlFlow<()> {
        walk_attribute(self, attribute)
    }

    fn visit_catch_clause(&mut self, catch: &CatchClause<'arena, 'src>) -> ControlFlow<()> {
        walk_catch_clause(self, catch)
    }

    fn visit_match_arm(&mut self, arm: &MatchArm<'arena, 'src>) -> ControlFlow<()> {
        walk_match_arm(self, arm)
    }

    fn visit_closure_use_var(&mut self, _var: &ClosureUseVar<'src>) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_trait_use(&mut self, trait_use: &TraitUseDecl<'arena, 'src>) -> ControlFlow<()> {
        walk_trait_use(self, trait_use)
    }

    fn visit_trait_adaptation(
        &mut self,
        _adaptation: &TraitAdaptation<'arena, 'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
}

// =============================================================================
// Walk functions
// =============================================================================

pub fn walk_program<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    program: &Program<'arena, 'src>,
) -> ControlFlow<()> {
    for stmt in program.stmts.iter() {
        visitor.visit_stmt(stmt)?;
    }
    ControlFlow::Continue(())
}

pub fn walk_stmt<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    stmt: &Stmt<'arena, 'src>,
) -> ControlFlow<()> {
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
        StmtKind::Block(stmts) => {
            for stmt in stmts.iter() {
                visitor.visit_stmt(stmt)?;
            }
        }
        StmtKind::If(if_stmt) => {
            visitor.visit_expr(&if_stmt.condition)?;
            visitor.visit_stmt(if_stmt.then_branch)?;
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
            visitor.visit_stmt(while_stmt.body)?;
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
            visitor.visit_stmt(for_stmt.body)?;
        }
        StmtKind::Foreach(foreach_stmt) => {
            visitor.visit_expr(&foreach_stmt.expr)?;
            if let Some(key) = &foreach_stmt.key {
                visitor.visit_expr(key)?;
            }
            visitor.visit_expr(&foreach_stmt.value)?;
            visitor.visit_stmt(foreach_stmt.body)?;
        }
        StmtKind::DoWhile(do_while) => {
            visitor.visit_stmt(do_while.body)?;
            visitor.visit_expr(&do_while.condition)?;
        }
        StmtKind::Function(func) => {
            walk_function_like(visitor, &func.attributes, &func.params, &func.return_type)?;
            for stmt in func.body.iter() {
                visitor.visit_stmt(stmt)?;
            }
        }
        StmtKind::Break(expr) | StmtKind::Continue(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Switch(switch_stmt) => {
            visitor.visit_expr(&switch_stmt.expr)?;
            for case in switch_stmt.cases.iter() {
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
            for stmt in tc.body.iter() {
                visitor.visit_stmt(stmt)?;
            }
            for catch in tc.catches.iter() {
                visitor.visit_catch_clause(catch)?;
            }
            if let Some(finally) = &tc.finally {
                for stmt in finally.iter() {
                    visitor.visit_stmt(stmt)?;
                }
            }
        }
        StmtKind::Declare(decl) => {
            for (_, expr) in decl.directives.iter() {
                visitor.visit_expr(expr)?;
            }
            if let Some(body) = decl.body {
                visitor.visit_stmt(body)?;
            }
        }
        StmtKind::Unset(exprs) | StmtKind::Global(exprs) => {
            for expr in exprs.iter() {
                visitor.visit_expr(expr)?;
            }
        }
        StmtKind::Class(class) => {
            walk_attributes(visitor, &class.attributes)?;
            for member in class.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Interface(iface) => {
            walk_attributes(visitor, &iface.attributes)?;
            for member in iface.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Trait(trait_decl) => {
            walk_attributes(visitor, &trait_decl.attributes)?;
            for member in trait_decl.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        StmtKind::Enum(enum_decl) => {
            walk_attributes(visitor, &enum_decl.attributes)?;
            for member in enum_decl.members.iter() {
                visitor.visit_enum_member(member)?;
            }
        }
        StmtKind::Namespace(ns) => {
            if let NamespaceBody::Braced(stmts) = &ns.body {
                for stmt in stmts.iter() {
                    visitor.visit_stmt(stmt)?;
                }
            }
        }
        StmtKind::Const(items) => {
            for item in items.iter() {
                walk_attributes(visitor, &item.attributes)?;
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
        StmtKind::Use(_)
        | StmtKind::Goto(_)
        | StmtKind::Label(_)
        | StmtKind::Nop
        | StmtKind::InlineHtml(_)
        | StmtKind::HaltCompiler(_)
        | StmtKind::Error => {}
    }
    ControlFlow::Continue(())
}

pub fn walk_expr<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    expr: &Expr<'arena, 'src>,
) -> ControlFlow<()> {
    match &expr.kind {
        ExprKind::Assign(assign) => {
            visitor.visit_expr(assign.target)?;
            visitor.visit_expr(assign.value)?;
        }
        ExprKind::Binary(binary) => {
            visitor.visit_expr(binary.left)?;
            visitor.visit_expr(binary.right)?;
        }
        ExprKind::UnaryPrefix(unary) => {
            visitor.visit_expr(unary.operand)?;
        }
        ExprKind::UnaryPostfix(unary) => {
            visitor.visit_expr(unary.operand)?;
        }
        ExprKind::Ternary(ternary) => {
            visitor.visit_expr(ternary.condition)?;
            if let Some(then_expr) = &ternary.then_expr {
                visitor.visit_expr(then_expr)?;
            }
            visitor.visit_expr(ternary.else_expr)?;
        }
        ExprKind::NullCoalesce(nc) => {
            visitor.visit_expr(nc.left)?;
            visitor.visit_expr(nc.right)?;
        }
        ExprKind::FunctionCall(call) => {
            visitor.visit_expr(call.name)?;
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
            visitor.visit_expr(access.array)?;
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
            visitor.visit_expr(new_expr.class)?;
            for arg in new_expr.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            visitor.visit_expr(access.object)?;
            visitor.visit_expr(access.property)?;
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => {
            visitor.visit_expr(call.object)?;
            visitor.visit_expr(call.method)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => {
            visitor.visit_expr(access.class)?;
            visitor.visit_expr(access.member)?;
        }
        ExprKind::ClassConstAccessDynamic { class, member }
        | ExprKind::StaticPropertyAccessDynamic { class, member } => {
            visitor.visit_expr(class)?;
            visitor.visit_expr(member)?;
        }
        ExprKind::StaticMethodCall(call) => {
            visitor.visit_expr(call.class)?;
            visitor.visit_expr(call.method)?;
            for arg in call.args.iter() {
                visitor.visit_arg(arg)?;
            }
        }
        ExprKind::Closure(closure) => {
            walk_function_like(
                visitor,
                &closure.attributes,
                &closure.params,
                &closure.return_type,
            )?;
            for use_var in closure.use_vars.iter() {
                visitor.visit_closure_use_var(use_var)?;
            }
            for stmt in closure.body.iter() {
                visitor.visit_stmt(stmt)?;
            }
        }
        ExprKind::ArrowFunction(arrow) => {
            walk_function_like(
                visitor,
                &arrow.attributes,
                &arrow.params,
                &arrow.return_type,
            )?;
            visitor.visit_expr(arrow.body)?;
        }
        ExprKind::Match(match_expr) => {
            visitor.visit_expr(match_expr.subject)?;
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
            walk_attributes(visitor, &class.attributes)?;
            for member in class.members.iter() {
                visitor.visit_class_member(member)?;
            }
        }
        ExprKind::InterpolatedString(parts)
        | ExprKind::Heredoc { parts, .. }
        | ExprKind::ShellExec(parts) => {
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

pub fn walk_param<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    param: &Param<'arena, 'src>,
) -> ControlFlow<()> {
    walk_attributes(visitor, &param.attributes)?;
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

pub fn walk_arg<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    arg: &Arg<'arena, 'src>,
) -> ControlFlow<()> {
    visitor.visit_expr(&arg.value)
}

pub fn walk_class_member<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    member: &ClassMember<'arena, 'src>,
) -> ControlFlow<()> {
    match &member.kind {
        ClassMemberKind::Property(prop) => {
            walk_property_decl(visitor, prop)?;
        }
        ClassMemberKind::Method(method) => {
            walk_method_decl(visitor, method)?;
        }
        ClassMemberKind::ClassConst(cc) => {
            walk_class_const_decl(visitor, cc)?;
        }
        ClassMemberKind::TraitUse(trait_use) => {
            visitor.visit_trait_use(trait_use)?;
        }
    }
    ControlFlow::Continue(())
}

pub fn walk_property_hook<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    hook: &PropertyHook<'arena, 'src>,
) -> ControlFlow<()> {
    walk_attributes(visitor, &hook.attributes)?;
    for param in hook.params.iter() {
        visitor.visit_param(param)?;
    }
    match &hook.body {
        PropertyHookBody::Block(stmts) => {
            for stmt in stmts.iter() {
                visitor.visit_stmt(stmt)?;
            }
        }
        PropertyHookBody::Expression(expr) => {
            visitor.visit_expr(expr)?;
        }
        PropertyHookBody::Abstract => {}
    }
    ControlFlow::Continue(())
}

pub fn walk_enum_member<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    member: &EnumMember<'arena, 'src>,
) -> ControlFlow<()> {
    match &member.kind {
        EnumMemberKind::Case(case) => {
            walk_attributes(visitor, &case.attributes)?;
            if let Some(value) = &case.value {
                visitor.visit_expr(value)?;
            }
        }
        EnumMemberKind::Method(method) => {
            walk_method_decl(visitor, method)?;
        }
        EnumMemberKind::ClassConst(cc) => {
            walk_class_const_decl(visitor, cc)?;
        }
        EnumMemberKind::TraitUse(trait_use) => {
            visitor.visit_trait_use(trait_use)?;
        }
    }
    ControlFlow::Continue(())
}

pub fn walk_type_hint<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    type_hint: &TypeHint<'arena, 'src>,
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
        TypeHintKind::Named(_) | TypeHintKind::Keyword(_, _) => {}
    }
    ControlFlow::Continue(())
}

pub fn walk_attribute<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    attribute: &Attribute<'arena, 'src>,
) -> ControlFlow<()> {
    for arg in attribute.args.iter() {
        visitor.visit_arg(arg)?;
    }
    ControlFlow::Continue(())
}

pub fn walk_catch_clause<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    catch: &CatchClause<'arena, 'src>,
) -> ControlFlow<()> {
    for stmt in catch.body.iter() {
        visitor.visit_stmt(stmt)?;
    }
    ControlFlow::Continue(())
}

pub fn walk_match_arm<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    arm: &MatchArm<'arena, 'src>,
) -> ControlFlow<()> {
    if let Some(conditions) = &arm.conditions {
        for cond in conditions.iter() {
            visitor.visit_expr(cond)?;
        }
    }
    visitor.visit_expr(&arm.body)
}

pub fn walk_trait_use<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    trait_use: &TraitUseDecl<'arena, 'src>,
) -> ControlFlow<()> {
    for adaptation in trait_use.adaptations.iter() {
        visitor.visit_trait_adaptation(adaptation)?;
    }
    ControlFlow::Continue(())
}

// =============================================================================
// Internal helpers — shared walking logic to avoid duplication
// =============================================================================

/// Walks the common parts of any function-like construct:
/// attributes → params → optional return type.
fn walk_function_like<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    attributes: &[Attribute<'arena, 'src>],
    params: &[Param<'arena, 'src>],
    return_type: &Option<TypeHint<'arena, 'src>>,
) -> ControlFlow<()> {
    walk_attributes(visitor, attributes)?;
    for param in params.iter() {
        visitor.visit_param(param)?;
    }
    if let Some(ret) = return_type {
        visitor.visit_type_hint(ret)?;
    }
    ControlFlow::Continue(())
}

/// Walks a method declaration (shared by ClassMember and EnumMember).
fn walk_method_decl<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    method: &MethodDecl<'arena, 'src>,
) -> ControlFlow<()> {
    walk_function_like(
        visitor,
        &method.attributes,
        &method.params,
        &method.return_type,
    )?;
    if let Some(body) = &method.body {
        for stmt in body.iter() {
            visitor.visit_stmt(stmt)?;
        }
    }
    ControlFlow::Continue(())
}

/// Walks a class constant declaration (shared by ClassMember and EnumMember).
fn walk_class_const_decl<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    cc: &ClassConstDecl<'arena, 'src>,
) -> ControlFlow<()> {
    walk_attributes(visitor, &cc.attributes)?;
    if let Some(type_hint) = &cc.type_hint {
        visitor.visit_type_hint(type_hint)?;
    }
    visitor.visit_expr(&cc.value)
}

/// Walks a property declaration.
fn walk_property_decl<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    prop: &PropertyDecl<'arena, 'src>,
) -> ControlFlow<()> {
    walk_attributes(visitor, &prop.attributes)?;
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

fn walk_attributes<'arena, 'src, V: Visitor<'arena, 'src> + ?Sized>(
    visitor: &mut V,
    attributes: &[Attribute<'arena, 'src>],
) -> ControlFlow<()> {
    for attr in attributes.iter() {
        visitor.visit_attribute(attr)?;
    }
    ControlFlow::Continue(())
}

// =============================================================================
// ScopeVisitor — scope-aware traversal
// =============================================================================

/// Lexical scope context passed to each [`ScopeVisitor`] method.
///
/// Represents the immediately enclosing namespace, class-like definition,
/// and named function or method at the point a node is visited.
/// All fields are `None` when the node is at the global top level.
///
/// **Namespace** is set when inside a braced or simple `namespace` declaration.
/// **`class_name`** is set inside `class`, `interface`, `trait`, and `enum`
/// declarations; it is `None` for anonymous classes.
/// **`function_name`** is set inside named functions and methods; it is `None`
/// inside closures and arrow functions.
#[derive(Debug, Clone, Copy, Default)]
pub struct Scope<'src> {
    /// Current namespace, or `None` for the global namespace.
    ///
    /// This is a borrowed slice of the original source string, so copying or
    /// cloning the scope is always allocation-free.
    pub namespace: Option<&'src str>,
    /// Name of the immediately enclosing class-like declaration, or `None`.
    pub class_name: Option<&'src str>,
    /// Name of the immediately enclosing named function or method, or `None`.
    pub function_name: Option<&'src str>,
}

/// A scope-aware variant of [`Visitor`].
///
/// Every visit method receives a [`Scope`] describing the lexical context at
/// that node — the current namespace, enclosing class-like declaration, and
/// enclosing named function or method.  All methods have no-op default
/// implementations, so implementors override only what they need.
///
/// Drive traversal with [`ScopeWalker`], which maintains the scope
/// automatically and calls these methods with the current context.
///
/// # Example
///
/// ```
/// use php_ast::visitor::{ScopeVisitor, ScopeWalker, Scope};
/// use php_ast::ast::*;
/// use std::ops::ControlFlow;
///
/// struct MethodCollector { methods: Vec<String> }
///
/// impl<'arena, 'src> ScopeVisitor<'arena, 'src> for MethodCollector {
///     fn visit_class_member(
///         &mut self,
///         member: &ClassMember<'arena, 'src>,
///         scope: &Scope<'src>,
///     ) -> ControlFlow<()> {
///         if let ClassMemberKind::Method(m) = &member.kind {
///             self.methods.push(format!(
///                 "{}::{}",
///                 scope.class_name.unwrap_or("<anon>"),
///                 m.name
///             ));
///         }
///         ControlFlow::Continue(())
///     }
/// }
/// ```
pub trait ScopeVisitor<'arena, 'src> {
    fn visit_program(
        &mut self,
        _program: &Program<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_stmt(&mut self, _stmt: &Stmt<'arena, 'src>, _scope: &Scope<'src>) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_expr(&mut self, _expr: &Expr<'arena, 'src>, _scope: &Scope<'src>) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_param(
        &mut self,
        _param: &Param<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_arg(&mut self, _arg: &Arg<'arena, 'src>, _scope: &Scope<'src>) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_class_member(
        &mut self,
        _member: &ClassMember<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_enum_member(
        &mut self,
        _member: &EnumMember<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_property_hook(
        &mut self,
        _hook: &PropertyHook<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_type_hint(
        &mut self,
        _type_hint: &TypeHint<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_attribute(
        &mut self,
        _attribute: &Attribute<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_catch_clause(
        &mut self,
        _catch: &CatchClause<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_match_arm(
        &mut self,
        _arm: &MatchArm<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
    fn visit_closure_use_var(
        &mut self,
        _var: &ClosureUseVar<'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_trait_use(
        &mut self,
        _trait_use: &TraitUseDecl<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }

    fn visit_trait_adaptation(
        &mut self,
        _adaptation: &TraitAdaptation<'arena, 'src>,
        _scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
}

/// Drives a [`ScopeVisitor`] over an AST, maintaining [`Scope`] automatically.
///
/// `ScopeWalker` wraps a [`ScopeVisitor`] and tracks the lexical scope as it
/// descends the tree, updating scope before visiting children and restoring it
/// on exit from scope-defining nodes (functions, classes, namespaces).
///
/// # Usage
///
/// ```no_run
/// # use php_ast::visitor::{ScopeWalker, ScopeVisitor, Scope};
/// # use php_ast::ast::*;
/// # use std::ops::ControlFlow;
/// # struct MyVisitor;
/// # impl<'a, 'b> ScopeVisitor<'a, 'b> for MyVisitor {}
/// # fn parse<'a, 'b>(_: &'a bumpalo::Bump, _: &'b str) -> Program<'a, 'b> { unimplemented!() }
/// let arena = bumpalo::Bump::new();
/// let src = "<?php class Foo { public function bar() {} }";
/// let program = parse(&arena, src);
/// let mut walker = ScopeWalker::new(src, MyVisitor);
/// walker.walk(&program);
/// let _my_visitor = walker.into_inner();
/// ```
pub struct ScopeWalker<'src, V> {
    inner: V,
    scope: Scope<'src>,
    src: &'src str,
}

impl<'src, V> ScopeWalker<'src, V> {
    /// Creates a new `ScopeWalker` wrapping `inner`.
    ///
    /// `src` must be the same source string that was passed to the parser that
    /// produced the [`Program`] you will walk.  It is used to derive
    /// zero-allocation [`Scope::namespace`] slices for qualified namespace
    /// names (e.g. `Foo\Bar`).
    pub fn new(src: &'src str, inner: V) -> Self {
        Self {
            inner,
            scope: Scope::default(),
            src,
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

impl<'arena, 'src, V: ScopeVisitor<'arena, 'src>> ScopeWalker<'src, V> {
    /// Walks `program`, calling [`ScopeVisitor`] methods with scope context.
    pub fn walk(&mut self, program: &Program<'arena, 'src>) -> ControlFlow<()> {
        self.visit_program(program)
    }
}

impl<'arena, 'src, V: ScopeVisitor<'arena, 'src>> Visitor<'arena, 'src> for ScopeWalker<'src, V> {
    fn visit_program(&mut self, program: &Program<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_program(program, &self.scope)?;
        walk_program(self, program)
    }

    fn visit_stmt(&mut self, stmt: &Stmt<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_stmt(stmt, &self.scope)?;
        match &stmt.kind {
            StmtKind::Function(func) => {
                let prev_fn = self.scope.function_name.replace(func.name);
                walk_stmt(self, stmt)?;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Class(class) => {
                let prev_class = self.scope.class_name;
                let prev_fn = self.scope.function_name.take();
                self.scope.class_name = class.name;
                walk_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Interface(iface) => {
                let prev_class = self.scope.class_name.replace(iface.name);
                let prev_fn = self.scope.function_name.take();
                walk_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Trait(trait_decl) => {
                let prev_class = self.scope.class_name.replace(trait_decl.name);
                let prev_fn = self.scope.function_name.take();
                walk_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Enum(enum_decl) => {
                let prev_class = self.scope.class_name.replace(enum_decl.name);
                let prev_fn = self.scope.function_name.take();
                walk_stmt(self, stmt)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            StmtKind::Namespace(ns) => {
                let ns_str = ns.name.as_ref().map(|n| n.src_repr(self.src));
                match &ns.body {
                    NamespaceBody::Braced(_) => {
                        let prev_ns = self.scope.namespace;
                        let prev_class = self.scope.class_name.take();
                        let prev_fn = self.scope.function_name.take();
                        self.scope.namespace = ns_str;
                        walk_stmt(self, stmt)?;
                        self.scope.namespace = prev_ns;
                        self.scope.class_name = prev_class;
                        self.scope.function_name = prev_fn;
                    }
                    NamespaceBody::Simple => {
                        // Simple namespace: update scope and leave it set for
                        // the remainder of the file (no push/pop).
                        self.scope.namespace = ns_str;
                        self.scope.class_name = None;
                        self.scope.function_name = None;
                    }
                }
            }
            _ => {
                walk_stmt(self, stmt)?;
            }
        }
        ControlFlow::Continue(())
    }

    fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_expr(expr, &self.scope)?;
        match &expr.kind {
            ExprKind::Closure(_) | ExprKind::ArrowFunction(_) => {
                let prev_fn = self.scope.function_name.take();
                walk_expr(self, expr)?;
                self.scope.function_name = prev_fn;
            }
            ExprKind::AnonymousClass(_) => {
                let prev_class = self.scope.class_name.take();
                let prev_fn = self.scope.function_name.take();
                walk_expr(self, expr)?;
                self.scope.class_name = prev_class;
                self.scope.function_name = prev_fn;
            }
            _ => {
                walk_expr(self, expr)?;
            }
        }
        ControlFlow::Continue(())
    }

    fn visit_class_member(&mut self, member: &ClassMember<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_class_member(member, &self.scope)?;
        if let ClassMemberKind::Method(method) = &member.kind {
            let prev_fn = self.scope.function_name.replace(method.name);
            walk_class_member(self, member)?;
            self.scope.function_name = prev_fn;
        } else {
            walk_class_member(self, member)?;
        }
        ControlFlow::Continue(())
    }

    fn visit_enum_member(&mut self, member: &EnumMember<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_enum_member(member, &self.scope)?;
        if let EnumMemberKind::Method(method) = &member.kind {
            let prev_fn = self.scope.function_name.replace(method.name);
            walk_enum_member(self, member)?;
            self.scope.function_name = prev_fn;
        } else {
            walk_enum_member(self, member)?;
        }
        ControlFlow::Continue(())
    }

    fn visit_param(&mut self, param: &Param<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_param(param, &self.scope)?;
        walk_param(self, param)
    }

    fn visit_arg(&mut self, arg: &Arg<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_arg(arg, &self.scope)?;
        walk_arg(self, arg)
    }

    fn visit_property_hook(&mut self, hook: &PropertyHook<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_property_hook(hook, &self.scope)?;
        walk_property_hook(self, hook)
    }

    fn visit_type_hint(&mut self, type_hint: &TypeHint<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_type_hint(type_hint, &self.scope)?;
        walk_type_hint(self, type_hint)
    }

    fn visit_attribute(&mut self, attribute: &Attribute<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_attribute(attribute, &self.scope)?;
        walk_attribute(self, attribute)
    }

    fn visit_catch_clause(&mut self, catch: &CatchClause<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_catch_clause(catch, &self.scope)?;
        walk_catch_clause(self, catch)
    }

    fn visit_match_arm(&mut self, arm: &MatchArm<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_match_arm(arm, &self.scope)?;
        walk_match_arm(self, arm)
    }

    fn visit_closure_use_var(&mut self, var: &ClosureUseVar<'src>) -> ControlFlow<()> {
        self.inner.visit_closure_use_var(var, &self.scope)
    }

    fn visit_trait_use(&mut self, trait_use: &TraitUseDecl<'arena, 'src>) -> ControlFlow<()> {
        self.inner.visit_trait_use(trait_use, &self.scope)?;
        walk_trait_use(self, trait_use)
    }

    fn visit_trait_adaptation(
        &mut self,
        adaptation: &TraitAdaptation<'arena, 'src>,
    ) -> ControlFlow<()> {
        self.inner.visit_trait_adaptation(adaptation, &self.scope)
    }
}

#[cfg(test)]
mod tests {
    use super::*;
    use crate::Span;
    // =========================================================================
    // Unit tests with hand-built ASTs
    // =========================================================================

    struct VarCounter {
        count: usize,
    }

    impl<'arena, 'src> Visitor<'arena, 'src> for VarCounter {
        fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
            if matches!(&expr.kind, ExprKind::Variable(_)) {
                self.count += 1;
            }
            walk_expr(self, expr)
        }
    }

    #[test]
    fn counts_variables() {
        let arena = bumpalo::Bump::new();
        let var_x = arena.alloc(Expr {
            kind: ExprKind::Variable(NameStr::Src("x")),
            span: Span::DUMMY,
        });
        let var_y = arena.alloc(Expr {
            kind: ExprKind::Variable(NameStr::Src("y")),
            span: Span::DUMMY,
        });
        let var_z = arena.alloc(Expr {
            kind: ExprKind::Variable(NameStr::Src("z")),
            span: Span::DUMMY,
        });
        let binary = arena.alloc(Expr {
            kind: ExprKind::Binary(BinaryExpr {
                left: var_y,
                op: BinaryOp::Add,
                right: var_z,
            }),
            span: Span::DUMMY,
        });
        let assign = arena.alloc(Expr {
            kind: ExprKind::Assign(AssignExpr {
                target: var_x,
                op: AssignOp::Assign,
                value: binary,
                by_ref: false,
            }),
            span: Span::DUMMY,
        });
        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Expression(assign),
            span: Span::DUMMY,
        });
        let program = Program {
            stmts,
            span: Span::DUMMY,
        };

        let mut v = VarCounter { count: 0 };
        let _ = v.visit_program(&program);
        assert_eq!(v.count, 3);
    }

    #[test]
    fn early_termination() {
        let arena = bumpalo::Bump::new();
        let var_a = arena.alloc(Expr {
            kind: ExprKind::Variable(NameStr::Src("a")),
            span: Span::DUMMY,
        });
        let var_b = arena.alloc(Expr {
            kind: ExprKind::Variable(NameStr::Src("b")),
            span: Span::DUMMY,
        });
        let binary = arena.alloc(Expr {
            kind: ExprKind::Binary(BinaryExpr {
                left: var_a,
                op: BinaryOp::Add,
                right: var_b,
            }),
            span: Span::DUMMY,
        });
        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Expression(binary),
            span: Span::DUMMY,
        });
        let program = Program {
            stmts,
            span: Span::DUMMY,
        };

        struct FindFirst {
            found: Option<String>,
        }
        impl<'arena, 'src> Visitor<'arena, 'src> for FindFirst {
            fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
                if let ExprKind::Variable(name) = &expr.kind {
                    self.found = Some(name.to_string());
                    return ControlFlow::Break(());
                }
                walk_expr(self, expr)
            }
        }

        let mut finder = FindFirst { found: None };
        let result = finder.visit_program(&program);
        assert!(result.is_break());
        assert_eq!(finder.found.as_deref(), Some("a"));
    }

    #[test]
    fn skip_subtree() {
        let arena = bumpalo::Bump::new();
        // 1 + 2; function foo() { 3 + 4; }
        let one = arena.alloc(Expr {
            kind: ExprKind::Int(1),
            span: Span::DUMMY,
        });
        let two = arena.alloc(Expr {
            kind: ExprKind::Int(2),
            span: Span::DUMMY,
        });
        let top = arena.alloc(Expr {
            kind: ExprKind::Binary(BinaryExpr {
                left: one,
                op: BinaryOp::Add,
                right: two,
            }),
            span: Span::DUMMY,
        });
        let three = arena.alloc(Expr {
            kind: ExprKind::Int(3),
            span: Span::DUMMY,
        });
        let four = arena.alloc(Expr {
            kind: ExprKind::Int(4),
            span: Span::DUMMY,
        });
        let inner = arena.alloc(Expr {
            kind: ExprKind::Binary(BinaryExpr {
                left: three,
                op: BinaryOp::Add,
                right: four,
            }),
            span: Span::DUMMY,
        });
        let mut func_body = ArenaVec::new_in(&arena);
        func_body.push(Stmt {
            kind: StmtKind::Expression(inner),
            span: Span::DUMMY,
        });
        let func = arena.alloc(FunctionDecl {
            name: "foo",
            params: ArenaVec::new_in(&arena),
            body: func_body,
            return_type: None,
            by_ref: false,
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        });
        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Expression(top),
            span: Span::DUMMY,
        });
        stmts.push(Stmt {
            kind: StmtKind::Function(func),
            span: Span::DUMMY,
        });
        let program = Program {
            stmts,
            span: Span::DUMMY,
        };

        struct SkipFunctions {
            expr_count: usize,
        }
        impl<'arena, 'src> Visitor<'arena, 'src> for SkipFunctions {
            fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
                self.expr_count += 1;
                walk_expr(self, expr)
            }
            fn visit_stmt(&mut self, stmt: &Stmt<'arena, 'src>) -> ControlFlow<()> {
                if matches!(&stmt.kind, StmtKind::Function(_)) {
                    return ControlFlow::Continue(());
                }
                walk_stmt(self, stmt)
            }
        }

        let mut v = SkipFunctions { expr_count: 0 };
        let _ = v.visit_program(&program);
        // Only top-level: binary(1, 2) = 3 exprs
        assert_eq!(v.expr_count, 3);
    }
}
