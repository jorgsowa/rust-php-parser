use php_ast::ast::*;

use crate::precedence::*;

/// Configuration for the pretty printer.
pub struct PrinterConfig {
    pub indent: Indent,
    pub newline: &'static str,
}

/// Indentation style.
pub enum Indent {
    Spaces(usize),
    Tabs,
}

impl Default for PrinterConfig {
    fn default() -> Self {
        Self {
            indent: Indent::Spaces(4),
            newline: "\n",
        }
    }
}

const SPACES: [&str; 17] = [
    "",
    " ",
    "  ",
    "   ",
    "    ",
    "     ",
    "      ",
    "       ",
    "        ",
    "         ",
    "          ",
    "           ",
    "            ",
    "             ",
    "              ",
    "               ",
    "                ",
];

const MAX_DEPTH: usize = 256;

pub(crate) struct Printer {
    output: String,
    indent_level: usize,
    indent_str: &'static str,
    nl: &'static str,
    depth: usize,
}

impl Printer {
    pub fn new(config: &PrinterConfig) -> Self {
        let indent_str = match config.indent {
            Indent::Spaces(n) => SPACES[n.min(16)],
            Indent::Tabs => "\t",
        };
        Self {
            output: String::with_capacity(4096),
            indent_level: 0,
            indent_str,
            nl: config.newline,
            depth: 0,
        }
    }

    pub fn into_output(self) -> String {
        self.output
    }

    fn w(&mut self, s: &str) {
        self.output.push_str(s);
    }

    fn newline(&mut self) {
        self.output.push_str(self.nl);
    }

    fn write_indent(&mut self) {
        for _ in 0..self.indent_level {
            self.output.push_str(self.indent_str);
        }
    }

    fn indent(&mut self) {
        self.indent_level += 1;
    }

    fn dedent(&mut self) {
        self.indent_level = self.indent_level.saturating_sub(1);
    }

    // =========================================================================
    // Top-level
    // =========================================================================

    pub fn print_program(&mut self, program: &Program) {
        self.print_stmts(&program.stmts, false);
    }

    fn print_stmts(&mut self, stmts: &[Stmt], indent: bool) {
        if indent {
            self.indent();
        }
        for (i, stmt) in stmts.iter().enumerate() {
            if i > 0 {
                self.newline();
            }
            if i > 0 && is_declaration(&stmt.kind) {
                self.newline();
            }
            self.write_indent();
            self.print_stmt(stmt);
        }
        if indent {
            self.dedent();
        }
    }

    // =========================================================================
    // Statements
    // =========================================================================

    fn print_stmt(&mut self, stmt: &Stmt) {
        self.depth += 1;
        if self.depth > MAX_DEPTH {
            self.w("/* max depth */");
            self.depth -= 1;
            return;
        }
        self.print_stmt_inner(stmt);
        self.depth -= 1;
    }

    fn print_stmt_inner(&mut self, stmt: &Stmt) {
        match &stmt.kind {
            StmtKind::Expression(expr) => {
                self.print_expr(expr, PREC_LOWEST);
                self.w(";");
            }
            StmtKind::Echo(exprs) => {
                self.w("echo ");
                self.print_comma_separated_exprs(exprs);
                self.w(";");
            }
            StmtKind::Return(expr) => {
                self.w("return");
                if let Some(e) = expr {
                    self.w(" ");
                    self.print_expr(e, PREC_LOWEST);
                }
                self.w(";");
            }
            StmtKind::Block(stmts) => {
                self.w("{");
                if !stmts.is_empty() {
                    self.newline();
                    self.print_stmts(stmts, true);
                    self.newline();
                    self.write_indent();
                }
                self.w("}");
            }
            StmtKind::If(if_stmt) => self.print_if(if_stmt),
            StmtKind::While(w) => {
                self.w("while (");
                self.print_expr(&w.condition, PREC_LOWEST);
                self.w(") ");
                self.print_block_or_stmt(w.body);
            }
            StmtKind::For(f) => {
                self.w("for (");
                self.print_comma_separated_exprs(&f.init);
                self.w("; ");
                self.print_comma_separated_exprs(&f.condition);
                self.w("; ");
                self.print_comma_separated_exprs(&f.update);
                self.w(") ");
                self.print_block_or_stmt(f.body);
            }
            StmtKind::Foreach(f) => {
                self.w("foreach (");
                self.print_expr(&f.expr, PREC_LOWEST);
                self.w(" as ");
                if let Some(key) = &f.key {
                    self.print_expr(key, PREC_LOWEST);
                    self.w(" => ");
                }
                self.print_expr(&f.value, PREC_LOWEST);
                self.w(") ");
                self.print_block_or_stmt(f.body);
            }
            StmtKind::DoWhile(dw) => {
                self.w("do ");
                self.print_block_or_stmt(dw.body);
                self.w(" while (");
                self.print_expr(&dw.condition, PREC_LOWEST);
                self.w(");");
            }
            StmtKind::Function(func) => self.print_function(func),
            StmtKind::Break(expr) => {
                self.w("break");
                if let Some(e) = expr {
                    self.w(" ");
                    self.print_expr(e, PREC_LOWEST);
                }
                self.w(";");
            }
            StmtKind::Continue(expr) => {
                self.w("continue");
                if let Some(e) = expr {
                    self.w(" ");
                    self.print_expr(e, PREC_LOWEST);
                }
                self.w(";");
            }
            StmtKind::Switch(sw) => {
                self.w("switch (");
                self.print_expr(&sw.expr, PREC_LOWEST);
                self.w(") {");
                self.newline();
                for case in sw.cases.iter() {
                    self.write_indent();
                    if let Some(val) = &case.value {
                        self.indent();
                        self.w("case ");
                        self.print_expr(val, PREC_LOWEST);
                        self.w(":");
                    } else {
                        self.indent();
                        self.w("default:");
                    }
                    if !case.body.is_empty() {
                        self.newline();
                        self.print_stmts(&case.body, false);
                    }
                    self.newline();
                    self.dedent();
                }
                self.write_indent();
                self.w("}");
            }
            StmtKind::Goto(label) => {
                self.w("goto ");
                self.w(label);
                self.w(";");
            }
            StmtKind::Label(label) => {
                self.w(label);
                self.w(":");
            }
            StmtKind::Declare(decl) => {
                self.w("declare(");
                for (i, (name, val)) in decl.directives.iter().enumerate() {
                    if i > 0 {
                        self.w(", ");
                    }
                    self.w(name);
                    self.w("=");
                    self.print_expr(val, PREC_LOWEST);
                }
                self.w(")");
                if let Some(body) = decl.body {
                    self.w(" ");
                    self.print_block_or_stmt(body);
                } else {
                    self.w(";");
                }
            }
            StmtKind::Unset(exprs) => {
                self.w("unset(");
                self.print_comma_separated_exprs(exprs);
                self.w(");");
            }
            StmtKind::Throw(expr) => {
                self.w("throw ");
                self.print_expr(expr, PREC_LOWEST);
                self.w(";");
            }
            StmtKind::TryCatch(tc) => self.print_try_catch(tc),
            StmtKind::Global(exprs) => {
                self.w("global ");
                self.print_comma_separated_exprs(exprs);
                self.w(";");
            }
            StmtKind::Class(class) => self.print_class(class),
            StmtKind::Interface(iface) => self.print_interface(iface),
            StmtKind::Trait(trait_decl) => self.print_trait(trait_decl),
            StmtKind::Enum(enum_decl) => self.print_enum(enum_decl),
            StmtKind::Namespace(ns) => self.print_namespace(ns),
            StmtKind::Use(use_decl) => self.print_use(use_decl),
            StmtKind::Const(items) => {
                self.w("const ");
                for (i, item) in items.iter().enumerate() {
                    if i > 0 {
                        self.w(", ");
                    }
                    self.print_attributes(&item.attributes);
                    self.w(item.name);
                    self.w(" = ");
                    self.print_expr(&item.value, PREC_LOWEST);
                }
                self.w(";");
            }
            StmtKind::StaticVar(vars) => {
                self.w("static ");
                for (i, var) in vars.iter().enumerate() {
                    if i > 0 {
                        self.w(", ");
                    }
                    self.w("$");
                    self.w(var.name);
                    if let Some(default) = &var.default {
                        self.w(" = ");
                        self.print_expr(default, PREC_LOWEST);
                    }
                }
                self.w(";");
            }
            StmtKind::HaltCompiler(data) => {
                self.w("__halt_compiler();");
                self.w(data);
            }
            StmtKind::Nop => {
                self.w(";");
            }
            StmtKind::InlineHtml(html) => {
                self.w("?>");
                self.w(html);
                self.w("<?php");
            }
            StmtKind::Error => {
                self.w("/* error */");
            }
        }
    }

    fn print_if(&mut self, if_stmt: &IfStmt) {
        self.w("if (");
        self.print_expr(&if_stmt.condition, PREC_LOWEST);
        self.w(") ");
        self.print_block_or_stmt(if_stmt.then_branch);
        for elseif in if_stmt.elseif_branches.iter() {
            self.w(" elseif (");
            self.print_expr(&elseif.condition, PREC_LOWEST);
            self.w(") ");
            self.print_block_or_stmt(&elseif.body);
        }
        if let Some(else_branch) = &if_stmt.else_branch {
            self.w(" else ");
            self.print_block_or_stmt(else_branch);
        }
    }

    fn print_try_catch(&mut self, tc: &TryCatchStmt) {
        self.w("try {");
        if !tc.body.is_empty() {
            self.newline();
            self.print_stmts(&tc.body, true);
            self.newline();
            self.write_indent();
        }
        self.w("}");
        for catch in tc.catches.iter() {
            self.w(" catch (");
            for (i, ty) in catch.types.iter().enumerate() {
                if i > 0 {
                    self.w("|");
                }
                self.print_name(ty);
            }
            if let Some(var) = catch.var {
                self.w(" $");
                self.w(var);
            }
            self.w(") {");
            if !catch.body.is_empty() {
                self.newline();
                self.print_stmts(&catch.body, true);
                self.newline();
                self.write_indent();
            }
            self.w("}");
        }
        if let Some(finally) = &tc.finally {
            self.w(" finally {");
            if !finally.is_empty() {
                self.newline();
                self.print_stmts(finally, true);
                self.newline();
                self.write_indent();
            }
            self.w("}");
        }
    }

    fn print_block_or_stmt(&mut self, stmt: &Stmt) {
        if let StmtKind::Block(stmts) = &stmt.kind {
            self.w("{");
            if !stmts.is_empty() {
                self.newline();
                self.print_stmts(stmts, true);
                self.newline();
                self.write_indent();
            }
            self.w("}");
        } else {
            self.w("{");
            self.newline();
            self.indent();
            self.write_indent();
            self.print_stmt(stmt);
            self.newline();
            self.dedent();
            self.write_indent();
            self.w("}");
        }
    }

    // =========================================================================
    // Expressions
    // =========================================================================

    fn print_expr(&mut self, expr: &Expr, parent_prec: i8) {
        self.depth += 1;
        if self.depth > MAX_DEPTH {
            self.w("/* max depth */");
            self.depth -= 1;
            return;
        }
        let my_prec = expr_precedence(&expr.kind);
        let needs_parens = my_prec < parent_prec && my_prec != PREC_PRIMARY;
        if needs_parens {
            self.w("(");
        }
        self.print_expr_inner(expr);
        if needs_parens {
            self.w(")");
        }
        self.depth -= 1;
    }

    fn print_expr_inner(&mut self, expr: &Expr) {
        match &expr.kind {
            ExprKind::Int(n) => self.w(&n.to_string()),
            ExprKind::Float(f) => {
                if f.is_nan() {
                    self.w("\\NAN");
                } else if f.is_infinite() {
                    if f.is_sign_negative() {
                        self.w("-\\INF");
                    } else {
                        self.w("\\INF");
                    }
                } else {
                    let s = format!("{f}");
                    self.w(&s);
                    if !s.contains('.') && !s.contains('e') && !s.contains('E') {
                        self.w(".0");
                    }
                }
            }
            ExprKind::String(s) => self.print_string_literal(s),
            ExprKind::InterpolatedString(parts) => {
                self.w("\"");
                self.print_string_parts(parts);
                self.w("\"");
            }
            ExprKind::Heredoc { label, parts } => {
                self.w("<<<");
                self.w(label);
                self.newline();
                self.print_string_parts(parts);
                self.newline();
                self.w(label);
            }
            ExprKind::Nowdoc { label, value } => {
                self.w("<<<'");
                self.w(label);
                self.w("'");
                self.newline();
                self.w(value);
                self.newline();
                self.w(label);
            }
            ExprKind::ShellExec(parts) => {
                self.w("`");
                self.print_string_parts(parts);
                self.w("`");
            }
            ExprKind::Bool(b) => self.w(if *b { "true" } else { "false" }),
            ExprKind::Null => self.w("null"),
            ExprKind::Variable(name) => {
                self.w("$");
                self.w(name.as_str());
            }
            ExprKind::VariableVariable(inner) => {
                self.w("$");
                if matches!(&inner.kind, ExprKind::Variable(_)) {
                    self.print_expr(inner, PREC_PRIMARY);
                } else {
                    self.w("{");
                    self.print_expr(inner, PREC_LOWEST);
                    self.w("}");
                }
            }
            ExprKind::Identifier(name) => self.w(name.as_str()),
            ExprKind::Assign(assign) => {
                let (_, lhs_prec, rhs_prec) = assign_op_precedence(assign.op);
                self.print_expr(assign.target, lhs_prec);
                self.w(" ");
                if assign.by_ref {
                    self.w("=& ");
                } else {
                    self.w(assign_op_str(assign.op));
                    self.w(" ");
                }
                self.print_expr(assign.value, rhs_prec);
            }
            ExprKind::Binary(binary) => {
                let (_, lhs_prec, rhs_prec) = binary_op_precedence(binary.op);
                self.print_expr(binary.left, lhs_prec);
                self.w(" ");
                self.w(binary_op_str(binary.op));
                self.w(" ");
                self.print_expr(binary.right, rhs_prec);
            }
            ExprKind::UnaryPrefix(unary) => {
                self.w(unary_prefix_op_str(unary.op));
                self.print_expr(unary.operand, PREC_UNARY);
            }
            ExprKind::UnaryPostfix(unary) => {
                self.print_expr(unary.operand, PREC_PRIMARY);
                self.w(unary_postfix_op_str(unary.op));
            }
            ExprKind::Ternary(ternary) => {
                self.print_expr(ternary.condition, PREC_TERNARY + 1);
                if let Some(then_expr) = &ternary.then_expr {
                    self.w(" ? ");
                    self.print_expr(then_expr, PREC_LOWEST);
                    self.w(" : ");
                } else {
                    self.w(" ?: ");
                }
                self.print_expr(ternary.else_expr, PREC_TERNARY + 1);
            }
            ExprKind::NullCoalesce(nc) => {
                self.print_expr(nc.left, PREC_NULL_COALESCE + 1);
                self.w(" ?? ");
                self.print_expr(nc.right, PREC_NULL_COALESCE);
            }
            ExprKind::FunctionCall(call) => {
                self.print_expr(call.name, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::Array(elements) => {
                self.w("[");
                self.print_array_elements(elements);
                self.w("]");
            }
            ExprKind::ArrayAccess(access) => {
                self.print_expr(access.array, PREC_PRIMARY);
                self.w("[");
                if let Some(index) = &access.index {
                    self.print_expr(index, PREC_LOWEST);
                }
                self.w("]");
            }
            ExprKind::Print(e) => {
                self.w("print ");
                self.print_expr(e, PREC_PRINT);
            }
            ExprKind::Parenthesized(e) => {
                self.w("(");
                self.print_expr(e, PREC_LOWEST);
                self.w(")");
            }
            ExprKind::Cast(kind, e) => {
                self.w(cast_str(*kind));
                self.print_expr(e, PREC_CAST);
            }
            ExprKind::ErrorSuppress(e) => {
                self.w("@");
                self.print_expr(e, PREC_UNARY);
            }
            ExprKind::Isset(exprs) => {
                self.w("isset(");
                self.print_comma_separated_exprs(exprs);
                self.w(")");
            }
            ExprKind::Empty(e) => {
                self.w("empty(");
                self.print_expr(e, PREC_LOWEST);
                self.w(")");
            }
            ExprKind::Include(kind, e) => {
                self.w(include_kind_str(*kind));
                self.w(" ");
                self.print_expr(e, PREC_INCLUDE);
            }
            ExprKind::Eval(e) => {
                self.w("eval(");
                self.print_expr(e, PREC_LOWEST);
                self.w(")");
            }
            ExprKind::Exit(e) => {
                self.w("exit");
                if let Some(e) = e {
                    self.w("(");
                    self.print_expr(e, PREC_LOWEST);
                    self.w(")");
                }
            }
            ExprKind::MagicConst(kind) => self.w(magic_const_str(*kind)),
            ExprKind::Clone(e) => {
                self.w("clone ");
                self.print_expr(e, PREC_CLONE);
            }
            ExprKind::CloneWith(obj, overrides) => {
                self.w("clone(");
                self.print_expr(obj, PREC_LOWEST);
                self.w(", ");
                self.print_expr(overrides, PREC_LOWEST);
                self.w(")");
            }
            ExprKind::New(new_expr) => {
                self.w("new ");
                self.print_expr(new_expr.class, PREC_PRIMARY);
                if !new_expr.args.is_empty() {
                    self.w("(");
                    self.print_args(&new_expr.args);
                    self.w(")");
                }
            }
            ExprKind::PropertyAccess(access) => {
                self.print_expr(access.object, PREC_PRIMARY);
                self.w("->");
                self.print_expr(access.property, PREC_PRIMARY);
            }
            ExprKind::NullsafePropertyAccess(access) => {
                self.print_expr(access.object, PREC_PRIMARY);
                self.w("?->");
                self.print_expr(access.property, PREC_PRIMARY);
            }
            ExprKind::MethodCall(call) => {
                self.print_expr(call.object, PREC_PRIMARY);
                self.w("->");
                self.print_expr(call.method, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::NullsafeMethodCall(call) => {
                self.print_expr(call.object, PREC_PRIMARY);
                self.w("?->");
                self.print_expr(call.method, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::StaticPropertyAccess(access) => {
                self.print_expr(access.class, PREC_PRIMARY);
                self.w("::$");
                self.w(&access.member);
            }
            ExprKind::ClassConstAccess(access) => {
                self.print_expr(access.class, PREC_PRIMARY);
                self.w("::");
                self.w(&access.member);
            }
            ExprKind::ClassConstAccessDynamic { class, member } => {
                self.print_expr(class, PREC_PRIMARY);
                self.w("::{");
                self.print_expr(member, PREC_LOWEST);
                self.w("}");
            }
            ExprKind::StaticPropertyAccessDynamic { class, member } => {
                self.print_expr(class, PREC_PRIMARY);
                self.w("::");
                self.print_expr(member, PREC_PRIMARY);
            }
            ExprKind::StaticMethodCall(call) => {
                self.print_expr(call.class, PREC_PRIMARY);
                self.w("::");
                self.w(&call.method);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::Closure(closure) => self.print_closure(closure),
            ExprKind::ArrowFunction(af) => self.print_arrow_function(af),
            ExprKind::Match(m) => self.print_match(m),
            ExprKind::ThrowExpr(e) => {
                self.w("throw ");
                self.print_expr(e, PREC_LOWEST);
            }
            ExprKind::Yield(y) => {
                if y.is_from {
                    self.w("yield from ");
                    if let Some(val) = &y.value {
                        self.print_expr(val, PREC_YIELD_FROM);
                    }
                } else {
                    self.w("yield");
                    if let Some(key) = &y.key {
                        self.w(" ");
                        self.print_expr(key, PREC_YIELD);
                        self.w(" => ");
                    } else if y.value.is_some() {
                        self.w(" ");
                    }
                    if let Some(val) = &y.value {
                        self.print_expr(val, PREC_YIELD);
                    }
                }
            }
            ExprKind::AnonymousClass(class) => {
                self.print_class_header(class);
                self.print_class_body(&class.members);
            }
            ExprKind::CallableCreate(cc) => match &cc.kind {
                CallableCreateKind::Function(name) => {
                    self.print_expr(name, PREC_PRIMARY);
                    self.w("(...)");
                }
                CallableCreateKind::Method { object, method } => {
                    self.print_expr(object, PREC_PRIMARY);
                    self.w("->");
                    self.print_expr(method, PREC_PRIMARY);
                    self.w("(...)");
                }
                CallableCreateKind::NullsafeMethod { object, method } => {
                    self.print_expr(object, PREC_PRIMARY);
                    self.w("?->");
                    self.print_expr(method, PREC_PRIMARY);
                    self.w("(...)");
                }
                CallableCreateKind::StaticMethod { class, method } => {
                    self.print_expr(class, PREC_PRIMARY);
                    self.w("::");
                    self.w(method);
                    self.w("(...)");
                }
            },
            ExprKind::Omit => {}
            ExprKind::Error => self.w("/* error */"),
        }
    }

    // =========================================================================
    // Declarations
    // =========================================================================

    fn print_function(&mut self, func: &FunctionDecl) {
        self.print_doc_comment(&func.doc_comment);
        self.print_attributes(&func.attributes);
        self.w("function ");
        if func.by_ref {
            self.w("&");
        }
        self.w(func.name);
        self.w("(");
        self.print_params(&func.params);
        self.w(")");
        if let Some(ret) = &func.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        self.newline();
        self.write_indent();
        self.w("{");
        if !func.body.is_empty() {
            self.newline();
            self.print_stmts(&func.body, true);
            self.newline();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_class(&mut self, class: &ClassDecl) {
        self.print_doc_comment(&class.doc_comment);
        self.print_attributes(&class.attributes);
        self.print_class_header(class);
        self.print_class_body(&class.members);
    }

    fn print_class_header(&mut self, class: &ClassDecl) {
        if class.modifiers.is_abstract {
            self.w("abstract ");
        }
        if class.modifiers.is_final {
            self.w("final ");
        }
        if class.modifiers.is_readonly {
            self.w("readonly ");
        }
        self.w("class");
        if let Some(name) = class.name {
            self.w(" ");
            self.w(name);
        }
        if let Some(extends) = &class.extends {
            self.w(" extends ");
            self.print_name(extends);
        }
        if !class.implements.is_empty() {
            self.w(" implements ");
            for (i, name) in class.implements.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
    }

    fn print_class_body(&mut self, members: &[ClassMember]) {
        self.newline();
        self.write_indent();
        self.w("{");
        if !members.is_empty() {
            self.newline();
            self.indent();
            for (i, member) in members.iter().enumerate() {
                if i > 0 {
                    self.newline();
                }
                self.write_indent();
                self.print_class_member(member);
                self.newline();
            }
            self.dedent();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_class_member(&mut self, member: &ClassMember) {
        match &member.kind {
            ClassMemberKind::Property(prop) => self.print_property(prop),
            ClassMemberKind::Method(method) => self.print_method(method),
            ClassMemberKind::ClassConst(cc) => self.print_class_const(cc),
            ClassMemberKind::TraitUse(tu) => self.print_trait_use(tu),
        }
    }

    fn print_method(&mut self, method: &MethodDecl) {
        self.print_doc_comment(&method.doc_comment);
        self.print_attributes(&method.attributes);
        if method.is_abstract {
            self.w("abstract ");
        }
        if method.is_final {
            self.w("final ");
        }
        if let Some(vis) = &method.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if method.is_static {
            self.w("static ");
        }
        self.w("function ");
        if method.by_ref {
            self.w("&");
        }
        self.w(method.name);
        self.w("(");
        self.print_params(&method.params);
        self.w(")");
        if let Some(ret) = &method.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        if let Some(body) = &method.body {
            self.newline();
            self.write_indent();
            self.w("{");
            if !body.is_empty() {
                self.newline();
                self.print_stmts(body, true);
                self.newline();
                self.write_indent();
            }
            self.w("}");
        } else {
            self.w(";");
        }
    }

    fn print_property(&mut self, prop: &PropertyDecl) {
        self.print_doc_comment(&prop.doc_comment);
        self.print_attributes(&prop.attributes);
        if let Some(vis) = &prop.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if let Some(set_vis) = &prop.set_visibility {
            self.w(visibility_str(*set_vis));
            self.w("(set) ");
        }
        if prop.is_static {
            self.w("static ");
        }
        if prop.is_readonly {
            self.w("readonly ");
        }
        if let Some(th) = &prop.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w("$");
        self.w(prop.name);
        if let Some(default) = &prop.default {
            self.w(" = ");
            self.print_expr(default, PREC_LOWEST);
        }
        if !prop.hooks.is_empty() {
            self.w(" ");
            self.print_property_hooks(&prop.hooks);
        } else {
            self.w(";");
        }
    }

    fn print_property_hooks(&mut self, hooks: &[PropertyHook]) {
        self.w("{");
        self.newline();
        self.indent();
        for hook in hooks.iter() {
            self.write_indent();
            self.print_attributes(&hook.attributes);
            if hook.is_final {
                self.w("final ");
            }
            if hook.by_ref {
                self.w("&");
            }
            match hook.kind {
                PropertyHookKind::Get => self.w("get"),
                PropertyHookKind::Set => self.w("set"),
            }
            if !hook.params.is_empty() {
                self.w("(");
                self.print_params(&hook.params);
                self.w(")");
            }
            match &hook.body {
                PropertyHookBody::Block(stmts) => {
                    self.w(" {");
                    if !stmts.is_empty() {
                        self.newline();
                        self.print_stmts(stmts, true);
                        self.newline();
                        self.write_indent();
                    }
                    self.w("}");
                }
                PropertyHookBody::Expression(e) => {
                    self.w(" => ");
                    self.print_expr(e, PREC_LOWEST);
                    self.w(";");
                }
                PropertyHookBody::Abstract => self.w(";"),
            }
            self.newline();
        }
        self.dedent();
        self.write_indent();
        self.w("}");
    }

    fn print_class_const(&mut self, cc: &ClassConstDecl) {
        self.print_doc_comment(&cc.doc_comment);
        self.print_attributes(&cc.attributes);
        if let Some(vis) = &cc.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        self.w("const ");
        if let Some(th) = &cc.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w(cc.name);
        self.w(" = ");
        self.print_expr(&cc.value, PREC_LOWEST);
        self.w(";");
    }

    fn print_trait_use(&mut self, tu: &TraitUseDecl) {
        self.w("use ");
        for (i, name) in tu.traits.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_name(name);
        }
        if tu.adaptations.is_empty() {
            self.w(";");
        } else {
            self.w(" {");
            self.newline();
            self.indent();
            for adapt in tu.adaptations.iter() {
                self.write_indent();
                match &adapt.kind {
                    TraitAdaptationKind::Precedence {
                        trait_name,
                        method,
                        insteadof,
                    } => {
                        self.print_name(trait_name);
                        self.w("::");
                        self.w(method);
                        self.w(" insteadof ");
                        for (i, name) in insteadof.iter().enumerate() {
                            if i > 0 {
                                self.w(", ");
                            }
                            self.print_name(name);
                        }
                    }
                    TraitAdaptationKind::Alias {
                        trait_name,
                        method,
                        new_modifier,
                        new_name,
                    } => {
                        if let Some(tn) = trait_name {
                            self.print_name(tn);
                            self.w("::");
                        }
                        self.w(method);
                        self.w(" as");
                        if let Some(vis) = new_modifier {
                            self.w(" ");
                            self.w(visibility_str(*vis));
                        }
                        if let Some(name) = new_name {
                            self.w(" ");
                            self.w(name);
                        }
                    }
                }
                self.w(";");
                self.newline();
            }
            self.dedent();
            self.write_indent();
            self.w("}");
        }
    }

    fn print_interface(&mut self, iface: &InterfaceDecl) {
        self.print_doc_comment(&iface.doc_comment);
        self.print_attributes(&iface.attributes);
        self.w("interface ");
        self.w(iface.name);
        if !iface.extends.is_empty() {
            self.w(" extends ");
            for (i, name) in iface.extends.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
        self.print_class_body(&iface.members);
    }

    fn print_trait(&mut self, trait_decl: &TraitDecl) {
        self.print_doc_comment(&trait_decl.doc_comment);
        self.print_attributes(&trait_decl.attributes);
        self.w("trait ");
        self.w(trait_decl.name);
        self.print_class_body(&trait_decl.members);
    }

    fn print_enum(&mut self, enum_decl: &EnumDecl) {
        self.print_doc_comment(&enum_decl.doc_comment);
        self.print_attributes(&enum_decl.attributes);
        self.w("enum ");
        self.w(enum_decl.name);
        if let Some(scalar) = &enum_decl.scalar_type {
            self.w(": ");
            self.print_name(scalar);
        }
        if !enum_decl.implements.is_empty() {
            self.w(" implements ");
            for (i, name) in enum_decl.implements.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
        self.newline();
        self.write_indent();
        self.w("{");
        if !enum_decl.members.is_empty() {
            self.newline();
            self.indent();
            for (i, member) in enum_decl.members.iter().enumerate() {
                if i > 0 {
                    self.newline();
                }
                self.write_indent();
                self.print_enum_member(member);
                self.newline();
            }
            self.dedent();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_enum_member(&mut self, member: &EnumMember) {
        match &member.kind {
            EnumMemberKind::Case(case) => {
                self.print_doc_comment(&case.doc_comment);
                self.print_attributes(&case.attributes);
                self.w("case ");
                self.w(case.name);
                if let Some(val) = &case.value {
                    self.w(" = ");
                    self.print_expr(val, PREC_LOWEST);
                }
                self.w(";");
            }
            EnumMemberKind::Method(method) => self.print_method(method),
            EnumMemberKind::ClassConst(cc) => self.print_class_const(cc),
            EnumMemberKind::TraitUse(tu) => self.print_trait_use(tu),
        }
    }

    fn print_namespace(&mut self, ns: &NamespaceDecl) {
        self.w("namespace");
        if let Some(name) = &ns.name {
            self.w(" ");
            self.print_name(name);
        }
        match &ns.body {
            NamespaceBody::Braced(stmts) => {
                self.w(" {");
                if !stmts.is_empty() {
                    self.newline();
                    self.print_stmts(stmts, true);
                    self.newline();
                    self.write_indent();
                }
                self.w("}");
            }
            NamespaceBody::Simple => self.w(";"),
        }
    }

    fn print_use(&mut self, use_decl: &UseDecl) {
        self.w("use ");
        match use_decl.kind {
            UseKind::Function => self.w("function "),
            UseKind::Const => self.w("const "),
            UseKind::Normal => {}
        }
        for (i, item) in use_decl.uses.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_name(&item.name);
            if let Some(alias) = item.alias {
                self.w(" as ");
                self.w(alias);
            }
        }
        self.w(";");
    }

    fn print_closure(&mut self, closure: &ClosureExpr) {
        self.print_attributes(&closure.attributes);
        if closure.is_static {
            self.w("static ");
        }
        self.w("function");
        if closure.by_ref {
            self.w(" &");
        }
        self.w("(");
        self.print_params(&closure.params);
        self.w(")");
        if !closure.use_vars.is_empty() {
            self.w(" use (");
            for (i, var) in closure.use_vars.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                if var.by_ref {
                    self.w("&");
                }
                self.w("$");
                self.w(var.name);
            }
            self.w(")");
        }
        if let Some(ret) = &closure.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        self.w(" {");
        if !closure.body.is_empty() {
            self.newline();
            self.print_stmts(&closure.body, true);
            self.newline();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_arrow_function(&mut self, af: &ArrowFunctionExpr) {
        self.print_attributes(&af.attributes);
        if af.is_static {
            self.w("static ");
        }
        self.w("fn");
        if af.by_ref {
            self.w("&");
        }
        self.w("(");
        self.print_params(&af.params);
        self.w(")");
        if let Some(ret) = &af.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        self.w(" => ");
        self.print_expr(af.body, PREC_LOWEST);
    }

    fn print_match(&mut self, m: &MatchExpr) {
        self.w("match (");
        self.print_expr(m.subject, PREC_LOWEST);
        self.w(") {");
        self.newline();
        self.indent();
        for arm in m.arms.iter() {
            self.write_indent();
            if let Some(conds) = &arm.conditions {
                for (i, cond) in conds.iter().enumerate() {
                    if i > 0 {
                        self.w(", ");
                    }
                    self.print_expr(cond, PREC_LOWEST);
                }
            } else {
                self.w("default");
            }
            self.w(" => ");
            self.print_expr(&arm.body, PREC_LOWEST);
            self.w(",");
            self.newline();
        }
        self.dedent();
        self.write_indent();
        self.w("}");
    }

    // =========================================================================
    // Helpers
    // =========================================================================

    fn print_name(&mut self, name: &Name) {
        match name {
            Name::Simple { value, .. } => self.w(value),
            Name::Complex { parts, kind, .. } => {
                match kind {
                    NameKind::FullyQualified => self.w("\\"),
                    NameKind::Relative => self.w("namespace\\"),
                    _ => {}
                }
                for (i, part) in parts.iter().enumerate() {
                    if i > 0 {
                        self.w("\\");
                    }
                    self.w(part);
                }
            }
        }
    }

    fn print_type_hint(&mut self, hint: &TypeHint) {
        match &hint.kind {
            TypeHintKind::Named(name) => self.print_name(name),
            TypeHintKind::Keyword(builtin, _) => self.w(builtin.as_str()),
            TypeHintKind::Nullable(inner) => {
                self.w("?");
                self.print_type_hint(inner);
            }
            TypeHintKind::Union(types) => {
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("|");
                    }
                    self.print_type_hint(ty);
                }
            }
            TypeHintKind::Intersection(types) => {
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("&");
                    }
                    self.print_type_hint(ty);
                }
            }
        }
    }

    fn print_params(&mut self, params: &[Param]) {
        for (i, param) in params.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_attributes_inline(&param.attributes);
            if let Some(vis) = &param.visibility {
                self.w(visibility_str(*vis));
                self.w(" ");
            }
            if let Some(set_vis) = &param.set_visibility {
                self.w(visibility_str(*set_vis));
                self.w("(set) ");
            }
            if param.is_readonly {
                self.w("readonly ");
            }
            if param.is_final {
                self.w("final ");
            }
            if let Some(th) = &param.type_hint {
                self.print_type_hint(th);
                self.w(" ");
            }
            if param.variadic {
                self.w("...");
            }
            if param.by_ref {
                self.w("&");
            }
            self.w("$");
            self.w(param.name);
            if let Some(default) = &param.default {
                self.w(" = ");
                self.print_expr(default, PREC_LOWEST);
            }
        }
    }

    fn print_args(&mut self, args: &[Arg]) {
        for (i, arg) in args.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            if let Some(name) = &arg.name {
                self.w(name);
                self.w(": ");
            }
            if arg.unpack {
                self.w("...");
            }
            if arg.by_ref {
                self.w("&");
            }
            self.print_expr(&arg.value, PREC_LOWEST);
        }
    }

    fn print_attributes(&mut self, attrs: &[Attribute]) {
        for attr in attrs.iter() {
            self.w("#[");
            self.print_name(&attr.name);
            if !attr.args.is_empty() {
                self.w("(");
                self.print_args(&attr.args);
                self.w(")");
            }
            self.w("]");
            self.newline();
            self.write_indent();
        }
    }

    fn print_attributes_inline(&mut self, attrs: &[Attribute]) {
        for attr in attrs.iter() {
            self.w("#[");
            self.print_name(&attr.name);
            if !attr.args.is_empty() {
                self.w("(");
                self.print_args(&attr.args);
                self.w(")");
            }
            self.w("] ");
        }
    }

    fn print_doc_comment(&mut self, doc: &Option<Comment>) {
        if let Some(comment) = doc {
            for (i, line) in comment.text.lines().enumerate() {
                if i > 0 {
                    self.newline();
                    self.write_indent();
                }
                self.w(line.trim_end());
            }
            self.newline();
            self.write_indent();
        }
    }

    fn print_comma_separated_exprs(&mut self, exprs: &[Expr]) {
        for (i, expr) in exprs.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_expr(expr, PREC_LOWEST);
        }
    }

    fn print_array_elements(&mut self, elements: &[ArrayElement]) {
        for (i, elem) in elements.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            if elem.unpack {
                self.w("...");
            }
            if let Some(key) = &elem.key {
                self.print_expr(key, PREC_LOWEST);
                self.w(" => ");
            }
            if elem.by_ref {
                self.w("&");
            }
            self.print_expr(&elem.value, PREC_LOWEST);
        }
    }

    fn print_string_parts(&mut self, parts: &[StringPart]) {
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => self.w(&escape_double_quoted(s)),
                StringPart::Expr(expr) => match &expr.kind {
                    ExprKind::Variable(name) => {
                        self.w("$");
                        self.w(name.as_str());
                    }
                    _ => {
                        self.w("{");
                        self.print_expr(expr, PREC_LOWEST);
                        self.w("}");
                    }
                },
            }
        }
    }

    fn print_string_literal(&mut self, s: &str) {
        if needs_double_quotes(s) {
            self.w("\"");
            self.w(&escape_double_quoted(s));
            self.w("\"");
        } else {
            self.w("'");
            self.w(&escape_single_quoted(s));
            self.w("'");
        }
    }
}

// =============================================================================
// Pure helper functions
// =============================================================================

fn is_declaration(kind: &StmtKind) -> bool {
    matches!(
        kind,
        StmtKind::Function(_)
            | StmtKind::Class(_)
            | StmtKind::Interface(_)
            | StmtKind::Trait(_)
            | StmtKind::Enum(_)
            | StmtKind::Namespace(_)
    )
}

fn needs_double_quotes(s: &str) -> bool {
    s.bytes().any(|b| {
        matches!(
            b,
            b'\n' | b'\r' | b'\t' | b'\x1b' | b'\x0c' | b'\x0b' | b'$'
        )
    })
}

fn escape_single_quoted(s: &str) -> String {
    let mut out = String::with_capacity(s.len());
    for ch in s.chars() {
        match ch {
            '\'' => out.push_str("\\'"),
            '\\' => out.push_str("\\\\"),
            _ => out.push(ch),
        }
    }
    out
}

fn escape_double_quoted(s: &str) -> String {
    let mut out = String::with_capacity(s.len());
    for ch in s.chars() {
        match ch {
            '"' => out.push_str("\\\""),
            '\\' => out.push_str("\\\\"),
            '$' => out.push_str("\\$"),
            '\n' => out.push_str("\\n"),
            '\r' => out.push_str("\\r"),
            '\t' => out.push_str("\\t"),
            '\x1b' => out.push_str("\\e"),
            '\x0c' => out.push_str("\\f"),
            '\x0b' => out.push_str("\\v"),
            _ => out.push(ch),
        }
    }
    out
}

fn binary_op_str(op: BinaryOp) -> &'static str {
    match op {
        BinaryOp::Add => "+",
        BinaryOp::Sub => "-",
        BinaryOp::Mul => "*",
        BinaryOp::Div => "/",
        BinaryOp::Mod => "%",
        BinaryOp::Pow => "**",
        BinaryOp::Concat => ".",
        BinaryOp::Equal => "==",
        BinaryOp::NotEqual => "!=",
        BinaryOp::Identical => "===",
        BinaryOp::NotIdentical => "!==",
        BinaryOp::Less => "<",
        BinaryOp::Greater => ">",
        BinaryOp::LessOrEqual => "<=",
        BinaryOp::GreaterOrEqual => ">=",
        BinaryOp::Spaceship => "<=>",
        BinaryOp::BooleanAnd => "&&",
        BinaryOp::BooleanOr => "||",
        BinaryOp::BitwiseAnd => "&",
        BinaryOp::BitwiseOr => "|",
        BinaryOp::BitwiseXor => "^",
        BinaryOp::ShiftLeft => "<<",
        BinaryOp::ShiftRight => ">>",
        BinaryOp::LogicalAnd => "and",
        BinaryOp::LogicalOr => "or",
        BinaryOp::LogicalXor => "xor",
        BinaryOp::Instanceof => "instanceof",
        BinaryOp::Pipe => "|>",
    }
}

fn assign_op_str(op: AssignOp) -> &'static str {
    match op {
        AssignOp::Assign => "=",
        AssignOp::Plus => "+=",
        AssignOp::Minus => "-=",
        AssignOp::Mul => "*=",
        AssignOp::Div => "/=",
        AssignOp::Mod => "%=",
        AssignOp::Pow => "**=",
        AssignOp::Concat => ".=",
        AssignOp::BitwiseAnd => "&=",
        AssignOp::BitwiseOr => "|=",
        AssignOp::BitwiseXor => "^=",
        AssignOp::ShiftLeft => "<<=",
        AssignOp::ShiftRight => ">>=",
        AssignOp::Coalesce => "??=",
    }
}

fn unary_prefix_op_str(op: UnaryPrefixOp) -> &'static str {
    match op {
        UnaryPrefixOp::Negate => "-",
        UnaryPrefixOp::Plus => "+",
        UnaryPrefixOp::BooleanNot => "!",
        UnaryPrefixOp::BitwiseNot => "~",
        UnaryPrefixOp::PreIncrement => "++",
        UnaryPrefixOp::PreDecrement => "--",
    }
}

fn unary_postfix_op_str(op: UnaryPostfixOp) -> &'static str {
    match op {
        UnaryPostfixOp::PostIncrement => "++",
        UnaryPostfixOp::PostDecrement => "--",
    }
}

fn cast_str(kind: CastKind) -> &'static str {
    match kind {
        CastKind::Int => "(int)",
        CastKind::Float => "(float)",
        CastKind::String => "(string)",
        CastKind::Bool => "(bool)",
        CastKind::Array => "(array)",
        CastKind::Object => "(object)",
        CastKind::Unset => "(unset)",
        CastKind::Void => "(void)",
    }
}

fn include_kind_str(kind: IncludeKind) -> &'static str {
    match kind {
        IncludeKind::Include => "include",
        IncludeKind::IncludeOnce => "include_once",
        IncludeKind::Require => "require",
        IncludeKind::RequireOnce => "require_once",
    }
}

fn magic_const_str(kind: MagicConstKind) -> &'static str {
    match kind {
        MagicConstKind::Class => "__CLASS__",
        MagicConstKind::Dir => "__DIR__",
        MagicConstKind::File => "__FILE__",
        MagicConstKind::Function => "__FUNCTION__",
        MagicConstKind::Line => "__LINE__",
        MagicConstKind::Method => "__METHOD__",
        MagicConstKind::Namespace => "__NAMESPACE__",
        MagicConstKind::Trait => "__TRAIT__",
        MagicConstKind::Property => "__PROPERTY__",
    }
}

fn visibility_str(vis: Visibility) -> &'static str {
    match vis {
        Visibility::Public => "public",
        Visibility::Protected => "protected",
        Visibility::Private => "private",
    }
}
