use php_ast::ast::*;

use crate::precedence::*;

use super::{Printer, MAX_DEPTH};

impl Printer {
    pub(crate) fn print_stmt(&mut self, stmt: &Stmt) {
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
                if let Some(first) = items.first() {
                    self.print_doc_comment(&first.doc_comment);
                    self.print_attributes(&first.attributes);
                }
                self.w("const ");
                for (i, item) in items.iter().enumerate() {
                    if i > 0 {
                        self.w(", ");
                    }
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

    pub(crate) fn print_block_or_stmt(&mut self, stmt: &Stmt) {
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
}
