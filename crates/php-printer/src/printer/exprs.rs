use php_ast::ast::*;
use php_ast::PhpVersion;

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
        let outer_continuation = std::mem::take(&mut self.in_chain_continuation);
        if is_chain(&expr.kind) {
            let operand_at_tail = std::mem::replace(&mut self.at_tail, false);
            self.print_chain_operand(expr);
            self.at_tail = operand_at_tail;
        }
        self.print_expr_inner(expr);
        if std::mem::replace(&mut self.in_chain_continuation, outer_continuation) {
            self.dedent();
        }
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
        } else if parent_prec == PREC_STATIC_CLASS {
            // A bare `true`, `false` or `null` before `::` is a class name; in parentheses, a value.
            !is_dereferencable(&expr.kind)
                && !matches!(expr.kind, ExprKind::Bool(_) | ExprKind::Null)
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
            let my_prec = expr_precedence(&expr.kind, self.php_version);
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

    /// Whether the source spells `outer` with an operand that `at_edge` says shares its start or
    /// end, so the operand has no parentheses; a hand-built tree without source has none to keep.
    fn written_unparenthesized(&self, outer: &Expr, at_edge: bool) -> bool {
        at_edge && outer.span.start < outer.span.end && outer.span.end as usize <= self.source.len()
    }

    /// Whether the source spells the array `expr` with `list(...)` rather than `[...]`.
    fn written_as_list(&self, expr: &Expr) -> bool {
        expr.span.end as usize <= self.source.len()
            && self
                .source
                .as_bytes()
                .get(expr.span.start as usize)
                .is_some_and(|b| b.eq_ignore_ascii_case(&b'l'))
    }

    /// Whether `expr` nests an array spelled differently, which PHP rejects: "Cannot mix [] and list()".
    fn mixes_list_spelling(&self, expr: &Expr) -> bool {
        let ExprKind::Array(elements) = &expr.kind else {
            return false;
        };
        let as_list = self.written_as_list(expr);
        elements.iter().any(|e| {
            matches!(e.value().kind, ExprKind::Array(_))
                && (self.written_as_list(e.value()) != as_list
                    || self.mixes_list_spelling(e.value()))
        })
    }

    /// The precedence `operand` of `parent` prints at. A ternary written without parentheses as
    /// the condition of another prints as written, so the error PHP 8.0 reports for it is kept.
    fn source_operand_prec(&self, parent: &Expr, operand: &Expr, prec: i8) -> i8 {
        let nested_ternary = matches!(parent.kind, ExprKind::Ternary(_))
            && matches!(operand.kind, ExprKind::Ternary(_));
        if nested_ternary
            && self.written_unparenthesized(parent, operand.span.start == parent.span.start)
        {
            PREC_TERNARY
        } else {
            prec
        }
    }

    /// Print the chain operand of `expr` (see `chain_operand`), which may itself
    /// be a chain of any length. Rather than recursing per link, open each
    /// link's parenthesis on the way down, print the innermost node, then emit
    /// each link's remainder on the way back up.
    fn print_chain_operand(&mut self, expr: &Expr) {
        let Some((mut node, mut prec)) = chain_operand(&expr.kind, self.php_version) else {
            return;
        };
        prec = self.source_operand_prec(expr, node, prec);
        let needs_parens = self.open_paren(node, prec);
        let Some(next) = linked_operand(node, self.php_version) else {
            // A single link, by far the most common chain: no stack needed.
            self.print_expr_inner(node);
            if needs_parens {
                self.w(")");
            }
            return;
        };
        let mut chain = LinkStack::new();
        chain.push((node, needs_parens));
        let mut parent = node;
        (node, prec) = next;
        loop {
            prec = self.source_operand_prec(parent, node, prec);
            let needs_parens = self.open_paren(node, prec);
            match linked_operand(node, self.php_version) {
                Some(next) => {
                    chain.push((node, needs_parens));
                    parent = node;
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

    /// Print a prefix operation whose operand may be a prefix operation of any
    /// depth. Each nested operand gets what `print_expr` would do for it, but
    /// in a loop: operators and parentheses on the way down, closing
    /// parentheses on the way back up.
    fn print_unary_prefix_chain(&mut self, expr: &Expr) {
        let mut links = LinkStack::new();
        let mut outer: Option<(&str, usize)> = None;
        let mut node = expr;
        while let ExprKind::UnaryPrefix(unary) = &node.kind {
            let op = unary_prefix_op_str(unary.op);
            self.w(op);
            if let Some((outer_op, operand_start)) = outer {
                self.separate_prefix_op(outer_op, operand_start);
            }
            let operand_start = self.output.len();
            let prec = expr_precedence(&node.kind, self.php_version);
            node = unary.operand;
            if matches!(node.kind, ExprKind::UnaryPrefix(_)) {
                self.flush_inline_comments(node.span.start);
                let needs_parens = self.open_paren(node, prec);
                links.push((needs_parens, self.at_tail));
                if needs_parens {
                    self.at_tail = true;
                }
                outer = Some((op, operand_start));
            } else {
                self.print_expr(node, prec);
                self.separate_prefix_op(op, operand_start);
            }
        }
        while let Some((needs_parens, at_tail)) = links.pop() {
            if needs_parens {
                self.w(")");
            }
            self.at_tail = at_tail;
        }
    }

    /// `- -$a` must not become `--$a`, nor `+ ++$a` become `+++$a`.
    fn separate_prefix_op(&mut self, op: &str, operand_start: usize) {
        if matches!(op, "-" | "+") && self.output[operand_start..].starts_with(op) {
            self.output.insert(operand_start, ' ');
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
                self.print_heredoc_parts(parts, label);
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
                let (_, _, rhs_prec) = binary_op_precedence(binary.op, self.php_version);
                self.w(" ");
                self.w(binary_op_str(binary.op));
                self.w(" ");
                if binary.op == BinaryOp::Pipe
                    && matches!(binary.right.kind, ExprKind::ArrowFunction(_))
                    && !self.written_unparenthesized(expr, binary.right.span.end == expr.span.end)
                {
                    self.w("(");
                    self.print_expr(binary.right, PREC_LOWEST);
                    self.w(")");
                } else {
                    self.print_expr(binary.right, rhs_prec);
                }
            }
            ExprKind::UnaryPrefix(_) => self.print_unary_prefix_chain(expr),
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
                let known_unmixed = std::mem::take(&mut self.array_known_unmixed);
                let keep_list =
                    self.keep_list_spelling || (!known_unmixed && self.mixes_list_spelling(expr));
                let outer_keep_list = std::mem::replace(&mut self.keep_list_spelling, keep_list);
                let as_list = keep_list && self.written_as_list(expr);
                self.w(if as_list { "list(" } else { "[" });
                self.print_array_elements(elements, expr.span, !keep_list);
                self.w(if as_list { ")" } else { "]" });
                self.keep_list_spelling = outer_keep_list;
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
                // `(int)` would lex as a cast; a line break keeps it a parenthesized constant.
                if matches!(&e.kind, ExprKind::Name(Name::Simple { value, .. }) if is_cast_keyword(value))
                {
                    self.w("\n");
                }
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
                self.break_chain_for_comments(access.object.span.end, access.property.span.start);
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
                self.break_chain_for_comments(access.object.span.end, access.property.span.start);
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
                self.break_chain_for_comments(call.object.span.end, call.method.span.start);
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
                self.break_chain_for_comments(call.object.span.end, call.method.span.start);
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
                        self.print_yield_operand(key, PREC_YIELD + 1);
                        self.w(" => ");
                    } else if y.value.is_some() {
                        self.w(" ");
                    }
                    if let Some(val) = &y.value {
                        if y.key.is_some() {
                            self.print_expr(val, PREC_YIELD);
                        } else {
                            self.print_yield_operand(val, PREC_YIELD);
                        }
                    }
                }
            }
            ExprKind::AnonymousClass(class) => {
                self.print_class_header(class);
                self.print_class_body(&class.body, true);
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
        self.print_param_list(&closure.params, closure.missing_param_list);
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
        self.print_param_list(&af.params, af.missing_param_list);
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

    /// Print the first operand of `yield`, parenthesized when it would start with `from`.
    fn print_yield_operand(&mut self, expr: &Expr, prec: i8) {
        if starts_with_from(expr, self.php_version) {
            self.w("(");
            self.print_expr(expr, PREC_LOWEST);
            self.w(")");
        } else {
            self.print_expr(expr, prec);
        }
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
            match &arg.kind {
                ArgKind::Value(expr) => self.print_expr(expr, PREC_LOWEST),
                ArgKind::Spread(expr) => {
                    self.w("...");
                    self.print_expr(expr, PREC_LOWEST);
                }
                ArgKind::ByRef(expr) => {
                    self.w("&");
                    self.print_expr(expr, PREC_LOWEST);
                }
                ArgKind::Placeholder => self.w("?"),
                ArgKind::SpreadPlaceholder => self.w("..."),
                _ => {}
            }
        }
    }

    /// Before a `->` link, print the line comments between the object ending at `object_end`
    /// and the member on their own lines, with the link starting a continuation line.
    fn break_chain_for_comments(&mut self, object_end: u32, member_start: u32) {
        if !self.line_comment_between(object_end, member_start) {
            return;
        }
        if !self.in_chain_continuation {
            self.in_chain_continuation = true;
            self.indent();
        }
        self.newline();
        self.flush_leading_comments(member_start);
        self.write_indent();
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
            self.flush_same_line_comments(arg.span.end, true);
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
    fn print_array_elements(
        &mut self,
        elements: &[ArrayElement],
        span: php_ast::Span,
        unmixed: bool,
    ) {
        let last_end = elements.last().map_or(span.start, |e| e.span.end);
        let multi_line = self.comments_need_own_lines(span.start, span.end, last_end);
        if multi_line {
            self.newline();
            self.indent();
            for elem in elements {
                self.flush_leading_comments(elem.span.start);
                self.write_indent();
                if elem.is_spread() {
                    self.w("...");
                }
                if let Some(key) = &elem.key {
                    self.print_array_key(key);
                }
                if elem.is_by_ref() {
                    self.w("&");
                }
                self.array_known_unmixed =
                    unmixed && matches!(elem.value().kind, ExprKind::Array(_));
                self.print_expr(elem.value(), PREC_LOWEST);
                self.w(",");
                self.flush_same_line_comments(elem.span.end, true);
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
                if elem.is_spread() {
                    self.w("...");
                }
                if let Some(key) = &elem.key {
                    self.print_array_key(key);
                }
                if elem.is_by_ref() {
                    self.w("&");
                }
                self.array_known_unmixed =
                    unmixed && matches!(elem.value().kind, ExprKind::Array(_));
                self.print_expr(elem.value(), PREC_LOWEST);
                if i == elements.len() - 1 && matches!(elem.value().kind, ExprKind::Omit) {
                    self.w(",");
                }
            }
        }
    }

    fn print_string_parts(&mut self, parts: &[StringPart]) {
        self.print_interpolated_parts(parts, escape_double_quoted, None);
    }

    fn print_backtick_parts(&mut self, parts: &[StringPart]) {
        self.print_interpolated_parts(parts, escape_shell_exec, None);
    }

    fn print_heredoc_parts(&mut self, parts: &[StringPart], label: &str) {
        self.print_interpolated_parts(parts, escape_heredoc, Some(label));
    }

    /// Print string parts; `heredoc_label` guards the lines of a heredoc body against it.
    fn print_interpolated_parts(
        &mut self,
        parts: &[StringPart],
        escape: fn(&str) -> String,
        heredoc_label: Option<&str>,
    ) {
        let mut after_brace = false;
        let mut at_line_start = true;
        for (i, part) in parts.iter().enumerate() {
            match part {
                StringPart::Literal(s) => {
                    let escaped = escape_bytes(s.as_bytes(), escape);
                    match heredoc_label {
                        Some(label) => {
                            self.w(&guard_heredoc_label(&escaped, label, at_line_start));
                        }
                        None => self.w(&escaped),
                    }
                    if !s.as_bytes().is_empty() {
                        at_line_start = s.as_bytes().ends_with(b"\n");
                    }
                    // A bare `$name` after a literal `{` would open `{$...}` syntax.
                    after_brace = s.as_bytes().ends_with(b"{");
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
                    at_line_start = false;
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

    fn print_string_literal(&mut self, s: &ByteStr) {
        match s.to_str() {
            Some(text) if !needs_double_quotes(s.as_bytes()) => {
                self.w("'");
                self.w(&escape_single_quoted(text));
                self.w("'");
            }
            _ => {
                self.w("\"");
                self.w(&escape_bytes(s.as_bytes(), escape_double_quoted));
                self.w("\"");
            }
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
    let bytes = s.as_bytes();
    bytes
        .first()
        .is_some_and(|b| b.is_ascii_alphanumeric() || *b == b'_' || *b == b'[' || !b.is_ascii())
        || bytes.starts_with(b"->")
        || bytes.starts_with(b"?->")
}

/// Whether `expr` is printed starting with the bare name `from`, which would read as `yield from`.
fn starts_with_from(expr: &Expr, version: PhpVersion) -> bool {
    let mut node = expr;
    loop {
        if let ExprKind::Name(Name::Simple { value, .. }) = &node.kind {
            return value.eq_ignore_ascii_case("from");
        }
        match chain_operand(&node.kind, version) {
            Some((operand, _)) => node = operand,
            None => return false,
        }
    }
}

/// The chain operand of `node`, checking the cheap [`is_chain`] first.
#[inline]
fn linked_operand<'a, 'arena, 'src>(
    node: &'a Expr<'arena, 'src>,
    version: PhpVersion,
) -> Option<(&'a Expr<'arena, 'src>, i8)> {
    if is_chain(&node.kind) {
        chain_operand(&node.kind, version)
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
    version: PhpVersion,
) -> Option<(&'a Expr<'arena, 'src>, i8)> {
    let operand = match kind {
        ExprKind::Assign(assign) => {
            return Some((assign.target, assign_op_precedence(assign.op).1))
        }
        ExprKind::Binary(binary) => {
            return Some((binary.left, binary_op_precedence(binary.op, version).1))
        }
        ExprKind::Ternary(ternary) => return Some((ternary.condition, PREC_TERNARY + 1)),
        ExprKind::NullCoalesce(nc) => return Some((nc.left, PREC_NULL_COALESCE + 1)),
        ExprKind::UnaryPostfix(unary) => return Some((unary.operand, PREC_PRIMARY)),
        ExprKind::FunctionCall(call) => return Some((call.name, PREC_CALLEE)),
        ExprKind::ArrayAccess(access) => access.array,
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            access.object
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => call.object,
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => {
            return Some((access.class, PREC_STATIC_CLASS))
        }
        ExprKind::ClassConstAccessDynamic { class, .. }
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => {
            return Some((class, PREC_STATIC_CLASS))
        }
        ExprKind::StaticMethodCall(call) => return Some((call.class, PREC_STATIC_CLASS)),
        ExprKind::StaticMethodCallDynamic(call) => return Some((call.class, PREC_STATIC_CLASS)),
        ExprKind::CallableCreate(cc) => match &cc.kind {
            CallableCreateKind::Function(name) => name,
            CallableCreateKind::Method { object, .. }
            | CallableCreateKind::NullsafeMethod { object, .. } => object,
            CallableCreateKind::StaticMethod { class, .. } => {
                return Some((class, PREC_STATIC_CLASS))
            }
            _ => return None,
        },
        _ => return None,
    };
    Some((operand, PREC_DEREFERENCE))
}

fn is_cast_keyword(name: &str) -> bool {
    [
        "int", "integer", "float", "double", "real", "string", "binary", "bool", "boolean",
        "object", "void",
    ]
    .iter()
    .any(|k| name.eq_ignore_ascii_case(k))
}
