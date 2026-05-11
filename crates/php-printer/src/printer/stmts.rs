use php_ast::ast::*;

use crate::precedence::*;

use super::{Printer, MAX_DEPTH};

impl<'src> Printer<'src> {
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
                } else {
                    self.flush_leading_comments(stmt.span.end);
                }
                self.w("}");
            }
            StmtKind::If(if_stmt) => self.print_if(if_stmt),
            StmtKind::While(w) => {
                self.w("while (");
                self.print_expr(&w.condition, PREC_LOWEST);
                if w.uses_alternative {
                    self.w("):");
                    self.print_alt_section(w.body);
                    self.w("endwhile;");
                } else {
                    self.w(") ");
                    self.print_block_or_stmt(w.body);
                }
            }
            StmtKind::For(f) => {
                self.w("for (");
                self.print_comma_separated_exprs(&f.init);
                self.w("; ");
                self.print_comma_separated_exprs(&f.condition);
                self.w("; ");
                self.print_comma_separated_exprs(&f.update);
                if f.uses_alternative {
                    self.w("):");
                    self.print_alt_section(f.body);
                    self.w("endfor;");
                } else {
                    self.w(") ");
                    self.print_block_or_stmt(f.body);
                }
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
                if f.uses_alternative {
                    self.w("):");
                    self.print_alt_section(f.body);
                    self.w("endforeach;");
                } else {
                    self.w(") ");
                    self.print_block_or_stmt(f.body);
                }
            }
            StmtKind::DoWhile(dw) => {
                self.w("do ");
                self.print_block_or_stmt(dw.body);
                self.w(" while (");
                self.print_expr(&dw.condition, PREC_LOWEST);
                self.w(");");
            }
            StmtKind::Function(func) => self.print_function(func, stmt),
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
                if sw.uses_alternative {
                    self.w("):");
                } else {
                    self.w(") {");
                }
                self.newline();
                self.indent();
                for case in sw.cases.iter() {
                    self.flush_leading_comments(case.span.start);
                    self.write_indent();
                    if let Some(val) = &case.value {
                        self.w("case ");
                        self.print_expr(val, PREC_LOWEST);
                        self.w(":");
                    } else {
                        self.w("default:");
                    }
                    if !case.body.is_empty() {
                        self.newline();
                        self.indent();
                        self.print_stmts(&case.body, false);
                        self.dedent();
                    }
                    self.newline();
                }
                self.flush_leading_comments(stmt.span.end);
                self.dedent();
                self.write_indent();
                if sw.uses_alternative {
                    self.w("endswitch;");
                } else {
                    self.w("}");
                }
            }
            StmtKind::Goto(label) => {
                self.w("goto ");
                self.w(label.or_error());
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
                match (decl.body, decl.uses_alternative) {
                    (Some(body), true) => {
                        self.w(":");
                        self.print_alt_section(body);
                        self.w("enddeclare;");
                    }
                    (Some(body), false) => {
                        self.w(" ");
                        self.print_block_or_stmt(body);
                    }
                    (None, _) => {
                        self.w(";");
                    }
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
            StmtKind::TryCatch(tc) => self.print_try_catch(tc, stmt),
            StmtKind::Global(exprs) => {
                self.w("global ");
                self.print_comma_separated_exprs(exprs);
                self.w(";");
            }
            StmtKind::Class(class) => self.print_class(class, stmt),
            StmtKind::Interface(iface) => self.print_interface(iface, stmt),
            StmtKind::Trait(trait_decl) => self.print_trait(trait_decl, stmt),
            StmtKind::Enum(enum_decl) => self.print_enum(enum_decl, stmt),
            StmtKind::Namespace(ns) => self.print_namespace(ns, stmt),
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
                    self.w(item.name.or_error());
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
                    self.w(var.name.or_error());
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
                if !self.in_html_mode {
                    self.w("?>");
                }
                self.w(html);
                self.w("<?php");
                self.in_html_mode = false;
            }
            StmtKind::Error => {
                self.w("/* error */");
            }
        }
    }

    fn print_if(&mut self, if_stmt: &IfStmt) {
        if if_stmt.uses_alternative {
            self.w("if (");
            self.print_expr(&if_stmt.condition, PREC_LOWEST);
            self.w("):");
            self.print_alt_section(if_stmt.then_branch);
            for elseif in if_stmt.elseif_branches.iter() {
                self.w("elseif (");
                self.print_expr(&elseif.condition, PREC_LOWEST);
                self.w("):");
                self.print_alt_section(&elseif.body);
            }
            if let Some(else_branch) = &if_stmt.else_branch {
                self.w("else:");
                self.print_alt_section(else_branch);
            }
            self.w("endif;");
        } else {
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
    }

    /// Print a Block's statements indented, without braces — for alternative syntax bodies.
    /// Leaves output positioned at the start of the next line at the current indent level.
    fn print_alt_section(&mut self, body: &Stmt) {
        if let StmtKind::Block(stmts) = &body.kind {
            self.newline();
            self.indent();
            self.print_stmts(stmts, false);
            self.newline();
            self.dedent();
            self.write_indent();
        }
    }

    fn print_try_catch(&mut self, tc: &TryCatchStmt, stmt: &Stmt) {
        let try_end = tc
            .catches
            .first()
            .map(|c| c.span.start)
            .unwrap_or(stmt.span.end);
        self.w("try {");
        if !tc.body.is_empty() {
            self.newline();
            self.indent();
            self.print_stmts(&tc.body, false);
            self.newline();
            self.flush_leading_comments(try_end);
            self.dedent();
            self.write_indent();
        } else {
            self.flush_leading_comments(try_end);
        }
        self.w("}");
        for catch in tc.catches.iter() {
            self.w(" catch (");
            for (j, ty) in catch.types.iter().enumerate() {
                if j > 0 {
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
                self.indent();
                self.print_stmts(&catch.body, false);
                self.newline();
                self.flush_leading_comments(catch.span.end);
                self.dedent();
                self.write_indent();
            } else {
                self.flush_leading_comments(catch.span.end);
            }
            self.w("}");
        }
        if let Some(finally) = &tc.finally {
            self.w(" finally {");
            if !finally.is_empty() {
                self.newline();
                self.indent();
                self.print_stmts(finally, false);
                self.newline();
                self.flush_leading_comments(stmt.span.end);
                self.dedent();
                self.write_indent();
            } else {
                self.flush_leading_comments(stmt.span.end);
            }
            self.w("}");
        }
    }

    pub(crate) fn print_block_or_stmt(&mut self, stmt: &Stmt) {
        if let StmtKind::Block(stmts) = &stmt.kind {
            self.w("{");
            if !stmts.is_empty() {
                self.newline();
                self.indent();
                self.print_stmts(stmts, false);
                self.newline();
                self.flush_leading_comments(stmt.span.end);
                self.dedent();
                self.write_indent();
            } else {
                self.flush_leading_comments(stmt.span.end);
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
            self.flush_leading_comments(stmt.span.end);
            self.w("}");
        }
    }

    fn print_namespace(&mut self, ns: &NamespaceDecl, stmt: &Stmt) {
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
                    self.indent();
                    self.print_stmts(stmts, false);
                    self.newline();
                    self.flush_leading_comments(stmt.span.end);
                    self.dedent();
                    self.write_indent();
                } else {
                    self.flush_leading_comments(stmt.span.end);
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
