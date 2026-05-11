use php_ast::ast::*;

use crate::precedence::*;

use super::helpers::*;
use super::{Printer, MAX_DEPTH};

impl<'src> Printer<'src> {
    pub(crate) fn print_expr(&mut self, expr: &Expr, parent_prec: i8) {
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
                if parts.is_empty() {
                    // Empty string — use single quotes for consistency
                    self.w("''");
                } else {
                    self.w("\"");
                    self.print_string_parts(parts);
                    self.w("\"");
                }
            }
            ExprKind::Heredoc { label, parts } => {
                self.w("<<<");
                self.w(label);
                self.newline();
                self.print_heredoc_parts(parts);
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
                self.print_backtick_parts(parts);
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
                if let ExprKind::AnonymousClass(class) = &new_expr.class.kind {
                    self.print_anonymous_class(class, &new_expr.args, new_expr.class.span.end);
                } else {
                    self.print_expr(new_expr.class, PREC_PRIMARY);
                    self.w("(");
                    self.print_args(&new_expr.args);
                    self.w(")");
                }
            }
            ExprKind::PropertyAccess(access) => {
                self.print_expr(access.object, PREC_PRIMARY);
                self.w("->");
                if self.needs_braces_for_property(&access.property.kind) {
                    self.w("{");
                    self.print_expr(access.property, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(access.property, PREC_PRIMARY);
                }
            }
            ExprKind::NullsafePropertyAccess(access) => {
                self.print_expr(access.object, PREC_PRIMARY);
                self.w("?->");
                if self.needs_braces_for_property(&access.property.kind) {
                    self.w("{");
                    self.print_expr(access.property, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(access.property, PREC_PRIMARY);
                }
            }
            ExprKind::MethodCall(call) => {
                self.print_expr(call.object, PREC_PRIMARY);
                self.w("->");
                if self.needs_braces_for_property(&call.method.kind) {
                    self.w("{");
                    self.print_expr(call.method, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(call.method, PREC_PRIMARY);
                }
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::NullsafeMethodCall(call) => {
                self.print_expr(call.object, PREC_PRIMARY);
                self.w("?->");
                if self.needs_braces_for_property(&call.method.kind) {
                    self.w("{");
                    self.print_expr(call.method, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(call.method, PREC_PRIMARY);
                }
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::StaticPropertyAccess(access) => {
                self.print_expr(access.class, PREC_PRIMARY);
                self.w("::$");
                self.print_expr(access.member, PREC_PRIMARY);
            }
            ExprKind::ClassConstAccess(access) => {
                self.print_expr(access.class, PREC_PRIMARY);
                self.w("::");
                self.print_expr(access.member, PREC_PRIMARY);
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
                self.print_expr(call.method, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::StaticDynMethodCall(call) => {
                self.print_expr(call.class, PREC_PRIMARY);
                self.w("::");
                self.print_expr(call.method, PREC_PRIMARY);
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
                self.print_class_body(&class.members, expr.span.end);
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
                    self.print_expr(method, PREC_PRIMARY);
                    self.w("(...)");
                }
            },
            ExprKind::Omit => {}
            ExprKind::Error => self.w("/* error */"),
        }
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
            self.ensure_php_mode();
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

    pub(crate) fn print_args(&mut self, args: &[Arg]) {
        for (i, arg) in args.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            if let Some(name) = &arg.name {
                self.print_name(name);
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

    pub(crate) fn print_comma_separated_exprs(&mut self, exprs: &[Expr]) {
        for (i, expr) in exprs.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_expr(expr, PREC_LOWEST);
        }
    }

    fn print_array_elements(&mut self, elements: &[ArrayElement]) {
        if elements.is_empty() {
            return;
        }
        let multi_line = elements.len() > 1
            && self.has_comments_between(
                elements[0].span.start,
                elements[elements.len() - 1].span.end,
            );
        if multi_line {
            self.newline();
            self.indent();
            for (i, elem) in elements.iter().enumerate() {
                self.flush_leading_comments(elem.span.start);
                self.write_indent();
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
                self.w(",");
                if i < elements.len() - 1 {
                    self.newline();
                }
            }
            self.newline();
            self.dedent();
            self.write_indent();
        } else {
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
                if i == elements.len() - 1 && matches!(elem.value.kind, ExprKind::Omit) {
                    self.w(",");
                }
            }
        }
    }

    fn print_string_parts(&mut self, parts: &[StringPart]) {
        let mut last_literal_ends_with_brace = false;
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => {
                    self.w(&escape_double_quoted(s));
                    last_literal_ends_with_brace = s.ends_with('{');
                }
                StringPart::Expr(expr) => {
                    if last_literal_ends_with_brace {
                        self.print_string_part_expr_with_braces(expr);
                    } else {
                        self.print_string_part_expr(expr);
                    }
                    last_literal_ends_with_brace = false;
                }
            }
        }
    }

    fn print_backtick_parts(&mut self, parts: &[StringPart]) {
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => self.w(&escape_shell_exec(s)),
                StringPart::Expr(expr) => self.print_string_part_expr(expr),
            }
        }
    }

    fn print_heredoc_parts(&mut self, parts: &[StringPart]) {
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => self.w(&escape_heredoc(s)),
                StringPart::Expr(expr) => self.print_string_part_expr(expr),
            }
        }
    }

    fn print_string_part_expr(&mut self, expr: &Expr) {
        match &expr.kind {
            ExprKind::Variable(name) => {
                self.w("$");
                self.w(name.as_str());
            }
            _ => {
                self.w("{");
                self.print_expr(expr, PREC_LOWEST);
                self.w("}");
            }
        }
    }

    fn print_string_part_expr_with_braces(&mut self, expr: &Expr) {
        self.w("{");
        match &expr.kind {
            ExprKind::Variable(name) => {
                self.w("$");
                self.w(name.as_str());
            }
            _ => {
                self.print_expr(expr, PREC_LOWEST);
            }
        }
        self.w("}");
    }

    fn needs_braces_for_property(&self, expr: &ExprKind) -> bool {
        !matches!(
            expr,
            ExprKind::Variable(_) | ExprKind::Identifier(_) | ExprKind::VariableVariable(_)
        )
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
