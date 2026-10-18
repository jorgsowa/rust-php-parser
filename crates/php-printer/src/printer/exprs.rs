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
        self.flush_inline_comments(expr.span.start);
        let needs_parens = self.open_paren(expr, parent_prec);
        let at_tail = self.at_tail;
        if needs_parens || parent_prec == PREC_LOWEST {
            self.at_tail = true;
        }
        if is_chain(&expr.kind) {
            let operand_at_tail = std::mem::replace(&mut self.at_tail, false);
            self.print_chain_operand(expr);
            self.at_tail = operand_at_tail;
        }
        self.print_expr_inner(expr);
        if needs_parens {
            self.w(")");
        }
        self.at_tail = at_tail;
        self.depth -= 1;
    }

    /// Write `(` if `expr` binds looser than its context requires.
    #[inline]
    fn open_paren(&mut self, expr: &Expr, parent_prec: i8) -> bool {
        let needs_parens = if parent_prec == PREC_DEREFERENCE {
            !is_dereferencable(&expr.kind)
        } else if parent_prec == PREC_CALLEE {
            !is_dereferencable(&expr.kind)
                || matches!(
                    expr.kind,
                    ExprKind::PropertyAccess(_)
                        | ExprKind::NullsafePropertyAccess(_)
                        | ExprKind::StaticPropertyAccess(_)
                        | ExprKind::StaticPropertyAccessDynamic { .. }
                )
        } else {
            let my_prec = expr_precedence(&expr.kind);
            my_prec < parent_prec && my_prec != PREC_PRIMARY
                || matches!(expr.kind, ExprKind::ArrowFunction(_))
                    && parent_prec > PREC_LOWEST
                    && !self.at_tail
        };
        if needs_parens {
            self.w("(");
        }
        needs_parens
    }

    /// Print the chain operand of `expr` (see `chain_operand`), which may itself
    /// be a chain of any length. Rather than recursing per link, open each
    /// link's parenthesis on the way down, print the innermost node, then emit
    /// each link's remainder on the way back up.
    fn print_chain_operand(&mut self, expr: &Expr) {
        let Some((mut node, mut prec)) = chain_operand(&expr.kind) else {
            return;
        };
        let needs_parens = self.open_paren(node, prec);
        let Some(next) = linked_operand(node) else {
            // A single link, by far the most common chain: no stack needed.
            self.print_expr_inner(node);
            if needs_parens {
                self.w(")");
            }
            return;
        };
        let mut chain = LinkStack::new();
        chain.push((node, needs_parens));
        (node, prec) = next;
        loop {
            let needs_parens = self.open_paren(node, prec);
            match linked_operand(node) {
                Some(next) => {
                    chain.push((node, needs_parens));
                    (node, prec) = next;
                }
                None => {
                    self.print_expr_inner(node);
                    if needs_parens {
                        self.w(")");
                    }
                    break;
                }
            }
        }
        while let Some((node, needs_parens)) = chain.pop() {
            self.print_expr_inner(node);
            if needs_parens {
                self.w(")");
            }
        }
    }

    /// Print `expr`, except for its chain operand, which `print_expr` has
    /// already printed.
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
                } else if *f != 0.0 && !(1e-4..1e15).contains(&f.abs()) {
                    // Positional notation would spell out hundreds of digits.
                    self.w(&format!("{f:e}"));
                } else {
                    let s = format!("{f}");
                    self.w(&s);
                    if !s.contains('.') {
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
            ExprKind::Name(name) => self.print_name(name),
            ExprKind::Assign(assign) => {
                let (_, _, rhs_prec) = assign_op_precedence(assign.op);
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
                let (_, _, rhs_prec) = binary_op_precedence(binary.op);
                self.w(" ");
                self.w(binary_op_str(binary.op));
                self.w(" ");
                if binary.op == BinaryOp::Pipe
                    && matches!(binary.right.kind, ExprKind::ArrowFunction(_))
                {
                    self.w("(");
                    self.print_expr(binary.right, PREC_LOWEST);
                    self.w(")");
                } else {
                    self.print_expr(binary.right, rhs_prec);
                }
            }
            ExprKind::UnaryPrefix(unary) => {
                let op = unary_prefix_op_str(unary.op);
                self.w(op);
                let operand_start = self.output.len();
                self.print_expr(unary.operand, expr_precedence(&expr.kind));
                // `- -$a` must not become `--$a`, nor `+ ++$a` become `+++$a`.
                if matches!(op, "-" | "+") && self.output[operand_start..].starts_with(op) {
                    self.output.insert(operand_start, ' ');
                }
            }
            ExprKind::UnaryPostfix(unary) => self.w(unary_postfix_op_str(unary.op)),
            ExprKind::Ternary(ternary) => {
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
                self.w(" ?? ");
                self.print_expr(nc.right, PREC_NULL_COALESCE);
            }
            ExprKind::FunctionCall(call) => {
                self.w("(");
                self.print_call_args(&call.args, call.name.span.end, expr.span.end);
                self.w(")");
            }
            ExprKind::Array(elements) => {
                self.w("[");
                self.print_array_elements(elements, expr.span);
                self.w("]");
            }
            ExprKind::ArrayAccess(access) => {
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
                self.print_expr(e, PREC_UNARY);
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
                    self.print_anonymous_class(class, &new_expr.args);
                } else if is_new_class(&new_expr.class.kind) {
                    self.print_expr(new_expr.class, PREC_PRIMARY);
                    self.w("(");
                    self.print_call_args(&new_expr.args, new_expr.class.span.end, expr.span.end);
                    self.w(")");
                } else {
                    self.w("(");
                    self.print_expr(new_expr.class, PREC_LOWEST);
                    self.w(")(");
                    self.print_call_args(&new_expr.args, new_expr.class.span.end, expr.span.end);
                    self.w(")");
                }
            }
            ExprKind::PropertyAccess(access) => {
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
                self.w("->");
                if self.needs_braces_for_property(&call.method.kind) {
                    self.w("{");
                    self.print_expr(call.method, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(call.method, PREC_PRIMARY);
                }
                self.w("(");
                self.print_call_args(&call.args, call.method.span.end, expr.span.end);
                self.w(")");
            }
            ExprKind::NullsafeMethodCall(call) => {
                self.w("?->");
                if self.needs_braces_for_property(&call.method.kind) {
                    self.w("{");
                    self.print_expr(call.method, PREC_LOWEST);
                    self.w("}");
                } else {
                    self.print_expr(call.method, PREC_PRIMARY);
                }
                self.w("(");
                self.print_call_args(&call.args, call.method.span.end, expr.span.end);
                self.w(")");
            }
            ExprKind::StaticPropertyAccess(access) => {
                self.w("::$");
                self.print_expr(access.member, PREC_PRIMARY);
            }
            ExprKind::ClassConstAccess(access) => {
                self.w("::");
                self.print_expr(access.member, PREC_PRIMARY);
            }
            ExprKind::ClassConstAccessDynamic { member, .. } => {
                self.w("::{");
                self.print_expr(member, PREC_LOWEST);
                self.w("}");
            }
            ExprKind::StaticPropertyAccessDynamic { member, .. } => {
                self.w("::");
                self.print_expr(member, PREC_PRIMARY);
            }
            ExprKind::StaticMethodCall(call) => {
                self.w("::");
                self.print_member_name(call.method);
                self.w("(");
                self.print_call_args(&call.args, call.method.span.end, expr.span.end);
                self.w(")");
            }
            ExprKind::StaticMethodCallDynamic(call) => {
                self.w("::");
                self.print_member_name(call.method);
                self.w("(");
                self.print_call_args(&call.args, call.method.span.end, expr.span.end);
                self.w(")");
            }
            ExprKind::Closure(closure) => self.print_closure(closure),
            ExprKind::ArrowFunction(af) => self.print_arrow_function(af),
            ExprKind::Match(m) => self.print_match(m),
            ExprKind::Throw(e) => {
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
                        self.print_expr(key, PREC_YIELD + 1);
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
                self.print_class_body(&class.body);
            }
            ExprKind::CallableCreate(cc) => match &cc.kind {
                CallableCreateKind::Function(_) => self.w("(...)"),
                CallableCreateKind::Method { method, .. } => {
                    self.w("->");
                    self.print_member_name(method);
                    self.w("(...)");
                }
                CallableCreateKind::NullsafeMethod { method, .. } => {
                    self.w("?->");
                    self.print_member_name(method);
                    self.w("(...)");
                }
                CallableCreateKind::StaticMethod { method, .. } => {
                    self.w("::");
                    self.print_member_name(method);
                    self.w("(...)");
                }
                _ => self.unsupported("callable"),
            },
            ExprKind::Omit => {}
            ExprKind::Error => self.w("/* error */"),
            _ => self.unsupported("expression"),
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
                self.w(var.name.or_error());
            }
            self.w(")");
        }
        if let Some(ret) = &closure.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        if !self.flush_gap_comments_before(closure.body.span.start) {
            self.w(" ");
        }
        self.print_block(closure.body);
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
        self.w(")");
        if !self.flush_gap_comments_before(m.brace_span.start) {
            self.w(" ");
        }
        self.w("{");
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

    /// A `yield` key would take the `=>` and the value as its own.
    fn print_array_key(&mut self, key: &Expr) {
        let prec = if matches!(key.kind, ExprKind::Yield(_)) {
            PREC_YIELD + 1
        } else {
            PREC_LOWEST
        };
        self.print_expr(key, prec);
        self.w(" => ");
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
            match &arg.value {
                Some(expr) => self.print_expr(expr, PREC_LOWEST),
                // PHP 8.6 placeholder: bare `?`, or `...` (already written above).
                None if !arg.unpack => self.w("?"),
                None => {}
            }
        }
    }

    /// Print call arguments, one per line when a comment between the callee ending at `from`
    /// and the end of the call at `until` needs a line of its own.
    fn print_call_args(&mut self, args: &[Arg], from: u32, until: u32) {
        let last_end = args.last().map_or(from, |a| a.span.end);
        if !self.comments_need_own_lines(from, until, last_end) {
            self.print_args(args);
            return;
        }
        self.newline();
        self.indent();
        for (i, arg) in args.iter().enumerate() {
            self.flush_leading_comments(arg.span.start);
            self.write_indent();
            self.print_args(std::slice::from_ref(arg));
            if i + 1 < args.len() {
                self.w(",");
            }
            self.newline();
        }
        self.flush_leading_comments(until);
        self.dedent();
        self.write_indent();
    }

    pub(crate) fn print_comma_separated_exprs(&mut self, exprs: &[Expr]) {
        for (i, expr) in exprs.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_expr(expr, PREC_LOWEST);
        }
    }

    /// Elements go one per line when a comment inside the brackets of `span` needs a line
    /// of its own, so each comment keeps its place among them.
    fn print_array_elements(&mut self, elements: &[ArrayElement], span: php_ast::Span) {
        let last_end = elements.last().map_or(span.start, |e| e.span.end);
        let multi_line = self.comments_need_own_lines(span.start, span.end, last_end);
        if multi_line {
            self.newline();
            self.indent();
            for elem in elements {
                self.flush_leading_comments(elem.span.start);
                self.write_indent();
                if elem.unpack {
                    self.w("...");
                }
                if let Some(key) = &elem.key {
                    self.print_array_key(key);
                }
                if elem.by_ref {
                    self.w("&");
                }
                self.print_expr(&elem.value, PREC_LOWEST);
                self.w(",");
                self.newline();
            }
            self.flush_leading_comments(span.end);
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
                    self.print_array_key(key);
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
        self.print_interpolated_parts(parts, escape_double_quoted);
    }

    fn print_backtick_parts(&mut self, parts: &[StringPart]) {
        self.print_interpolated_parts(parts, escape_shell_exec);
    }

    fn print_heredoc_parts(&mut self, parts: &[StringPart]) {
        self.print_interpolated_parts(parts, escape_heredoc);
    }

    fn print_interpolated_parts(&mut self, parts: &[StringPart], escape: fn(&str) -> String) {
        let mut after_brace = false;
        for (i, part) in parts.iter().enumerate() {
            match part {
                StringPart::Literal(s) => {
                    self.w(&escape(s));
                    // A bare `$name` after a literal `{` would open `{$...}` syntax.
                    after_brace = s.ends_with('{');
                }
                StringPart::Expr(expr) => {
                    match &expr.kind {
                        ExprKind::Variable(name)
                            if !after_brace && !extends_simple_variable(parts.get(i + 1)) =>
                        {
                            self.w("$");
                            self.w(name.as_str());
                        }
                        _ => {
                            self.w("{");
                            self.print_expr(expr, PREC_LOWEST);
                            self.w("}");
                        }
                    }
                    after_brace = false;
                }
                _ => self.unsupported("string part"),
            }
        }
    }

    /// Print a method name after `->`, `?->` or `::`, bracing an expression: `->{$a . 'b'}`.
    fn print_member_name(&mut self, name: &Expr) {
        if self.needs_braces_for_property(&name.kind) {
            self.w("{");
            self.print_expr(name, PREC_LOWEST);
            self.w("}");
        } else {
            self.print_expr(name, PREC_PRIMARY);
        }
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

/// Whether `kind` can be dereferenced (called, indexed, or have `->` or `::`
/// applied) without parentheses.
fn is_dereferencable(kind: &ExprKind) -> bool {
    match kind {
        ExprKind::New(new_expr) => matches!(new_expr.class.kind, ExprKind::Name(_)),
        _ => {
            matches!(
                kind,
                ExprKind::Variable(_)
                    | ExprKind::VariableVariable(_)
                    | ExprKind::Name(_)
                    | ExprKind::Parenthesized(_)
                    | ExprKind::Array(_)
                    | ExprKind::String(_)
                    | ExprKind::InterpolatedString(_)
                    | ExprKind::Heredoc { .. }
                    | ExprKind::Nowdoc { .. }
                    | ExprKind::MagicConst(_)
            ) || is_chain(kind)
                && !matches!(
                    kind,
                    ExprKind::Assign(_)
                        | ExprKind::Binary(_)
                        | ExprKind::UnaryPostfix(_)
                        | ExprKind::Ternary(_)
                        | ExprKind::NullCoalesce(_)
                )
        }
    }
}

/// Whether `kind` can follow `new` without parentheses: a variable, a name,
/// or property and index fetches on one.
fn is_new_class(kind: &ExprKind) -> bool {
    match kind {
        ExprKind::Variable(_)
        | ExprKind::VariableVariable(_)
        | ExprKind::Name(_)
        | ExprKind::Parenthesized(_) => true,
        ExprKind::ArrayAccess(access) => is_new_class(&access.array.kind),
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            is_new_class(&access.object.kind)
        }
        ExprKind::StaticPropertyAccess(access) => is_new_class(&access.class.kind),
        _ => false,
    }
}

/// Whether `next` would be read as part of a bare `$name` placed before it:
/// more name characters, an index or a property access.
fn extends_simple_variable(next: Option<&StringPart>) -> bool {
    let Some(StringPart::Literal(s)) = next else {
        return false;
    };
    s.starts_with(|c: char| c.is_ascii_alphanumeric() || c == '_' || c == '[' || !c.is_ascii())
        || s.starts_with("->")
        || s.starts_with("?->")
}

/// The chain operand of `node`, checking the cheap [`is_chain`] first.
#[inline]
fn linked_operand<'a, 'arena, 'src>(
    node: &'a Expr<'arena, 'src>,
) -> Option<(&'a Expr<'arena, 'src>, i8)> {
    if is_chain(&node.kind) {
        chain_operand(&node.kind)
    } else {
        None
    }
}

/// Whether `kind` is a chain link; a bit test, cheaper than `chain_operand`.
#[inline]
fn is_chain(kind: &ExprKind) -> bool {
    matches!(
        kind,
        ExprKind::Assign(_)
            | ExprKind::Binary(_)
            | ExprKind::UnaryPostfix(_)
            | ExprKind::Ternary(_)
            | ExprKind::NullCoalesce(_)
            | ExprKind::FunctionCall(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::MethodCall(_)
            | ExprKind::NullsafeMethodCall(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::ClassConstAccess(_)
            | ExprKind::StaticMethodCall(_)
            | ExprKind::StaticMethodCallDynamic(_)
            | ExprKind::ClassConstAccessDynamic { .. }
            | ExprKind::StaticPropertyAccessDynamic { .. }
            | ExprKind::CallableCreate(_)
    )
}

/// A stack of chain links that only allocates for chains longer than its
/// inline capacity; almost every chain in real code fits.
struct LinkStack<T: Copy> {
    inline: [Option<T>; 8],
    len: usize,
    spilled: Vec<T>,
}

impl<T: Copy> LinkStack<T> {
    fn new() -> Self {
        Self {
            inline: [None; 8],
            len: 0,
            spilled: Vec::new(),
        }
    }

    fn push(&mut self, link: T) {
        if self.len < self.inline.len() {
            self.inline[self.len] = Some(link);
            self.len += 1;
        } else {
            self.spilled.push(link);
        }
    }

    fn pop(&mut self) -> Option<T> {
        if let Some(link) = self.spilled.pop() {
            return Some(link);
        }
        self.len = self.len.checked_sub(1)?;
        self.inline[self.len]
    }
}

/// The operand a chain node prints first, with the precedence it is printed
/// at. Must agree with `is_chain`. Mirrors the leading `print_expr` call each of these variants made before
/// chains were printed iteratively; `print_expr_inner` prints the rest.
fn chain_operand<'a, 'arena, 'src>(
    kind: &'a ExprKind<'arena, 'src>,
) -> Option<(&'a Expr<'arena, 'src>, i8)> {
    let operand = match kind {
        ExprKind::Assign(assign) => {
            return Some((assign.target, assign_op_precedence(assign.op).1))
        }
        ExprKind::Binary(binary) => return Some((binary.left, binary_op_precedence(binary.op).1)),
        ExprKind::Ternary(ternary) => return Some((ternary.condition, PREC_TERNARY + 1)),
        ExprKind::NullCoalesce(nc) => return Some((nc.left, PREC_NULL_COALESCE + 1)),
        ExprKind::UnaryPostfix(unary) => return Some((unary.operand, PREC_PRIMARY)),
        ExprKind::FunctionCall(call) => return Some((call.name, PREC_CALLEE)),
        ExprKind::ArrayAccess(access) => access.array,
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            access.object
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => call.object,
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => access.class,
        ExprKind::ClassConstAccessDynamic { class, .. }
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => class,
        ExprKind::StaticMethodCall(call) => call.class,
        ExprKind::StaticMethodCallDynamic(call) => call.class,
        ExprKind::CallableCreate(cc) => match &cc.kind {
            CallableCreateKind::Function(name) => name,
            CallableCreateKind::Method { object, .. }
            | CallableCreateKind::NullsafeMethod { object, .. } => object,
            CallableCreateKind::StaticMethod { class, .. } => class,
            _ => return None,
        },
        _ => return None,
    };
    Some((operand, PREC_DEREFERENCE))
}
