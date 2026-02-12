use crate::ast::*;

/// Visitor trait for AST traversal. All methods have default implementations
/// that recursively walk child nodes, so implementors only need to override
/// the node types they care about.
pub trait Visitor {
    fn visit_program(&mut self, program: &Program) {
        walk_program(self, program);
    }

    fn visit_stmt(&mut self, stmt: &Stmt) {
        walk_stmt(self, stmt);
    }

    fn visit_expr(&mut self, expr: &Expr) {
        walk_expr(self, expr);
    }

    fn visit_param(&mut self, param: &Param) {
        walk_param(self, param);
    }

    fn visit_arg(&mut self, arg: &Arg) {
        walk_arg(self, arg);
    }

    fn visit_class_member(&mut self, member: &ClassMember) {
        walk_class_member(self, member);
    }

    fn visit_enum_member(&mut self, member: &EnumMember) {
        walk_enum_member(self, member);
    }
}

pub fn walk_program<V: Visitor + ?Sized>(visitor: &mut V, program: &Program) {
    for stmt in &program.stmts {
        visitor.visit_stmt(stmt);
    }
}

pub fn walk_stmt<V: Visitor + ?Sized>(visitor: &mut V, stmt: &Stmt) {
    match &stmt.kind {
        StmtKind::Expression(expr) => {
            visitor.visit_expr(expr);
        }
        StmtKind::Echo(exprs) => {
            for expr in exprs {
                visitor.visit_expr(expr);
            }
        }
        StmtKind::Return(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr);
            }
        }
        StmtKind::Block(stmts) => {
            for stmt in stmts {
                visitor.visit_stmt(stmt);
            }
        }
        StmtKind::If(if_stmt) => {
            visitor.visit_expr(&if_stmt.condition);
            visitor.visit_stmt(&if_stmt.then_branch);
            for elseif in &if_stmt.elseif_branches {
                visitor.visit_expr(&elseif.condition);
                visitor.visit_stmt(&elseif.body);
            }
            if let Some(else_branch) = &if_stmt.else_branch {
                visitor.visit_stmt(else_branch);
            }
        }
        StmtKind::While(while_stmt) => {
            visitor.visit_expr(&while_stmt.condition);
            visitor.visit_stmt(&while_stmt.body);
        }
        StmtKind::For(for_stmt) => {
            for expr in &for_stmt.init {
                visitor.visit_expr(expr);
            }
            for expr in &for_stmt.condition {
                visitor.visit_expr(expr);
            }
            for expr in &for_stmt.update {
                visitor.visit_expr(expr);
            }
            visitor.visit_stmt(&for_stmt.body);
        }
        StmtKind::Foreach(foreach_stmt) => {
            visitor.visit_expr(&foreach_stmt.expr);
            if let Some(key) = &foreach_stmt.key {
                visitor.visit_expr(key);
            }
            visitor.visit_expr(&foreach_stmt.value);
            visitor.visit_stmt(&foreach_stmt.body);
        }
        StmtKind::DoWhile(do_while) => {
            visitor.visit_stmt(&do_while.body);
            visitor.visit_expr(&do_while.condition);
        }
        StmtKind::Function(func) => {
            for param in &func.params {
                visitor.visit_param(param);
            }
            for stmt in &func.body {
                visitor.visit_stmt(stmt);
            }
        }
        StmtKind::Break(expr) | StmtKind::Continue(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr);
            }
        }
        StmtKind::Switch(switch_stmt) => {
            visitor.visit_expr(&switch_stmt.expr);
            for case in &switch_stmt.cases {
                if let Some(value) = &case.value {
                    visitor.visit_expr(value);
                }
                for stmt in &case.body {
                    visitor.visit_stmt(stmt);
                }
            }
        }
        StmtKind::Throw(expr) => {
            visitor.visit_expr(expr);
        }
        StmtKind::TryCatch(tc) => {
            for stmt in &tc.body {
                visitor.visit_stmt(stmt);
            }
            for catch in &tc.catches {
                for stmt in &catch.body {
                    visitor.visit_stmt(stmt);
                }
            }
            if let Some(finally) = &tc.finally {
                for stmt in finally {
                    visitor.visit_stmt(stmt);
                }
            }
        }
        StmtKind::Declare(_, body) => {
            if let Some(body) = body {
                visitor.visit_stmt(body);
            }
        }
        StmtKind::Unset(exprs) | StmtKind::Global(exprs) => {
            for expr in exprs {
                visitor.visit_expr(expr);
            }
        }
        StmtKind::Class(class) => {
            for member in &class.members {
                visitor.visit_class_member(member);
            }
        }
        StmtKind::Interface(iface) => {
            for member in &iface.members {
                visitor.visit_class_member(member);
            }
        }
        StmtKind::Trait(trait_decl) => {
            for member in &trait_decl.members {
                visitor.visit_class_member(member);
            }
        }
        StmtKind::Enum(enum_decl) => {
            for member in &enum_decl.members {
                visitor.visit_enum_member(member);
            }
        }
        StmtKind::Namespace(ns) => {
            if let NamespaceBody::Braced(stmts) = &ns.body {
                for stmt in stmts {
                    visitor.visit_stmt(stmt);
                }
            }
        }
        StmtKind::Const(items) => {
            for item in items {
                visitor.visit_expr(&item.value);
            }
        }
        StmtKind::StaticVar(vars) => {
            for var in vars {
                if let Some(default) = &var.default {
                    visitor.visit_expr(default);
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
}

pub fn walk_expr<V: Visitor + ?Sized>(visitor: &mut V, expr: &Expr) {
    match &expr.kind {
        ExprKind::Assign(assign) => {
            visitor.visit_expr(&assign.target);
            visitor.visit_expr(&assign.value);
        }
        ExprKind::Binary(binary) => {
            visitor.visit_expr(&binary.left);
            visitor.visit_expr(&binary.right);
        }
        ExprKind::UnaryPrefix(unary) => {
            visitor.visit_expr(&unary.operand);
        }
        ExprKind::UnaryPostfix(unary) => {
            visitor.visit_expr(&unary.operand);
        }
        ExprKind::Ternary(ternary) => {
            visitor.visit_expr(&ternary.condition);
            if let Some(then_expr) = &ternary.then_expr {
                visitor.visit_expr(then_expr);
            }
            visitor.visit_expr(&ternary.else_expr);
        }
        ExprKind::NullCoalesce(nc) => {
            visitor.visit_expr(&nc.left);
            visitor.visit_expr(&nc.right);
        }
        ExprKind::FunctionCall(call) => {
            visitor.visit_expr(&call.name);
            for arg in &call.args {
                visitor.visit_arg(arg);
            }
        }
        ExprKind::Array(elements) => {
            for elem in elements {
                if let Some(key) = &elem.key {
                    visitor.visit_expr(key);
                }
                visitor.visit_expr(&elem.value);
            }
        }
        ExprKind::ArrayAccess(access) => {
            visitor.visit_expr(&access.array);
            if let Some(index) = &access.index {
                visitor.visit_expr(index);
            }
        }
        ExprKind::Print(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Parenthesized(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Cast(_, expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::ErrorSuppress(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Isset(exprs) => {
            for expr in exprs {
                visitor.visit_expr(expr);
            }
        }
        ExprKind::Empty(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Include(_, expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Eval(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Exit(expr) => {
            if let Some(expr) = expr {
                visitor.visit_expr(expr);
            }
        }
        ExprKind::Clone(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::New(new_expr) => {
            visitor.visit_expr(&new_expr.class);
            for arg in &new_expr.args {
                visitor.visit_arg(arg);
            }
        }
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            visitor.visit_expr(&access.object);
            visitor.visit_expr(&access.property);
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => {
            visitor.visit_expr(&call.object);
            visitor.visit_expr(&call.method);
            for arg in &call.args {
                visitor.visit_arg(arg);
            }
        }
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => {
            visitor.visit_expr(&access.class);
        }
        ExprKind::StaticMethodCall(call) => {
            visitor.visit_expr(&call.class);
            for arg in &call.args {
                visitor.visit_arg(arg);
            }
        }
        ExprKind::Closure(closure) => {
            for param in &closure.params {
                visitor.visit_param(param);
            }
            for stmt in &closure.body {
                visitor.visit_stmt(stmt);
            }
        }
        ExprKind::ArrowFunction(arrow) => {
            for param in &arrow.params {
                visitor.visit_param(param);
            }
            visitor.visit_expr(&arrow.body);
        }
        ExprKind::Match(match_expr) => {
            visitor.visit_expr(&match_expr.subject);
            for arm in &match_expr.arms {
                if let Some(conditions) = &arm.conditions {
                    for cond in conditions {
                        visitor.visit_expr(cond);
                    }
                }
                visitor.visit_expr(&arm.body);
            }
        }
        ExprKind::ThrowExpr(expr) => {
            visitor.visit_expr(expr);
        }
        ExprKind::Yield(yield_expr) => {
            if let Some(key) = &yield_expr.key {
                visitor.visit_expr(key);
            }
            if let Some(value) = &yield_expr.value {
                visitor.visit_expr(value);
            }
        }
        ExprKind::AnonymousClass(class) => {
            for member in &class.members {
                visitor.visit_class_member(member);
            }
        }
        ExprKind::InterpolatedString(parts) | ExprKind::Heredoc { parts, .. } | ExprKind::ShellExec(parts) => {
            for part in parts {
                if let StringPart::Expr(e) = part {
                    visitor.visit_expr(e);
                }
            }
        }
        ExprKind::VariableVariable(inner) => {
            visitor.visit_expr(inner);
        }
        ExprKind::CallableCreate(cc) => {
            match &cc.kind {
                CallableCreateKind::Function(name) => visitor.visit_expr(name),
                CallableCreateKind::Method { object, method }
                | CallableCreateKind::NullsafeMethod { object, method } => {
                    visitor.visit_expr(object);
                    visitor.visit_expr(method);
                }
                CallableCreateKind::StaticMethod { class, .. } => {
                    visitor.visit_expr(class);
                }
            }
        }
        ExprKind::Int(_)
        | ExprKind::Float(_)
        | ExprKind::String(_)
        | ExprKind::Bool(_)
        | ExprKind::Null
        | ExprKind::Variable(_)
        | ExprKind::Identifier(_)
        | ExprKind::MagicConst(_)
        | ExprKind::Nowdoc { .. }
        | ExprKind::Error => {}
    }
}

pub fn walk_param<V: Visitor + ?Sized>(visitor: &mut V, param: &Param) {
    if let Some(default) = &param.default {
        visitor.visit_expr(default);
    }
}

pub fn walk_arg<V: Visitor + ?Sized>(visitor: &mut V, arg: &Arg) {
    visitor.visit_expr(&arg.value);
}

pub fn walk_class_member<V: Visitor + ?Sized>(visitor: &mut V, member: &ClassMember) {
    match &member.kind {
        ClassMemberKind::Property(prop) => {
            if let Some(default) = &prop.default {
                visitor.visit_expr(default);
            }
        }
        ClassMemberKind::Method(method) => {
            for param in &method.params {
                visitor.visit_param(param);
            }
            if let Some(body) = &method.body {
                for stmt in body {
                    visitor.visit_stmt(stmt);
                }
            }
        }
        ClassMemberKind::ClassConst(cc) => {
            visitor.visit_expr(&cc.value);
        }
        ClassMemberKind::TraitUse(_) => {}
    }
}

pub fn walk_enum_member<V: Visitor + ?Sized>(visitor: &mut V, member: &EnumMember) {
    match &member.kind {
        EnumMemberKind::Case(case) => {
            if let Some(value) = &case.value {
                visitor.visit_expr(value);
            }
        }
        EnumMemberKind::Method(method) => {
            for param in &method.params {
                visitor.visit_param(param);
            }
            if let Some(body) = &method.body {
                for stmt in body {
                    visitor.visit_stmt(stmt);
                }
            }
        }
        EnumMemberKind::ClassConst(cc) => {
            visitor.visit_expr(&cc.value);
        }
        EnumMemberKind::TraitUse(_) => {}
    }
}

#[cfg(test)]
mod tests {
    use super::*;
    use crate::Span;

    /// A simple visitor that counts variables
    struct VarCounter {
        count: usize,
    }

    impl Visitor for VarCounter {
        fn visit_expr(&mut self, expr: &Expr) {
            if matches!(&expr.kind, ExprKind::Variable(_)) {
                self.count += 1;
            }
            walk_expr(self, expr);
        }
    }

    #[test]
    fn test_visitor_counts_variables() {
        let program = Program {
            stmts: vec![
                Stmt {
                    kind: StmtKind::Expression(Expr {
                        kind: ExprKind::Assign(AssignExpr {
                            target: Box::new(Expr {
                                kind: ExprKind::Variable("x".into()),
                                span: Span::DUMMY,
                            }),
                            op: AssignOp::Assign,
                            value: Box::new(Expr {
                                kind: ExprKind::Binary(BinaryExpr {
                                    left: Box::new(Expr {
                                        kind: ExprKind::Variable("y".into()),
                                        span: Span::DUMMY,
                                    }),
                                    op: BinaryOp::Add,
                                    right: Box::new(Expr {
                                        kind: ExprKind::Variable("z".into()),
                                        span: Span::DUMMY,
                                    }),
                                }),
                                span: Span::DUMMY,
                            }),
                        }),
                        span: Span::DUMMY,
                    }),
                    span: Span::DUMMY,
                },
            ],
            span: Span::DUMMY,
        };

        let mut counter = VarCounter { count: 0 };
        counter.visit_program(&program);
        assert_eq!(counter.count, 3);
    }
}
