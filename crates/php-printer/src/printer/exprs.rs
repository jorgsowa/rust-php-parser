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
        let needs_parens = self.open_paren(expr, parent_prec);
        if is_chain(&expr.kind) {
            self.print_chain_operand(expr);
        }
        self.print_expr_inner(expr);
        if needs_parens {
            self.w(")");
        }
        self.depth -= 1;
    }

    /// Write `(` if `expr` binds looser than its context requires.
    #[inline]
    fn open_paren(&mut self, expr: &Expr, parent_prec: i8) -> bool {
        let my_prec = expr_precedence(&expr.kind);
        let needs_parens = my_prec < parent_prec && my_prec != PREC_PRIMARY;
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
                self.print_expr(binary.right, rhs_prec);
            }
            ExprKind::UnaryPrefix(unary) => {
                self.w(unary_prefix_op_str(unary.op));
                self.print_expr(unary.operand, PREC_UNARY);
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
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::Array(elements) => {
                self.w("[");
                self.print_array_elements(elements);
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
                    self.print_anonymous_class(class, &new_expr.args);
                } else {
                    self.print_expr(new_expr.class, PREC_PRIMARY);
                    self.w("(");
                    self.print_args(&new_expr.args);
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
                self.print_args(&call.args);
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
                self.print_args(&call.args);
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
                self.print_expr(call.method, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
                self.w(")");
            }
            ExprKind::StaticDynMethodCall(call) => {
                self.w("::");
                self.print_expr(call.method, PREC_PRIMARY);
                self.w("(");
                self.print_args(&call.args);
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
                self.print_class_body(&class.body);
            }
            ExprKind::CallableCreate(cc) => match &cc.kind {
                CallableCreateKind::Function(_) => self.w("(...)"),
                CallableCreateKind::Method { method, .. } => {
                    self.w("->");
                    self.print_expr(method, PREC_PRIMARY);
                    self.w("(...)");
                }
                CallableCreateKind::NullsafeMethod { method, .. } => {
                    self.w("?->");
                    self.print_expr(method, PREC_PRIMARY);
                    self.w("(...)");
                }
                CallableCreateKind::StaticMethod { method, .. } => {
                    self.w("::");
                    self.print_expr(method, PREC_PRIMARY);
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
                self.w(var.name);
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
                _ => self.unsupported("string part"),
            }
        }
    }

    fn print_backtick_parts(&mut self, parts: &[StringPart]) {
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => self.w(&escape_shell_exec(s)),
                StringPart::Expr(expr) => self.print_string_part_expr(expr),
                _ => self.unsupported("string part"),
            }
        }
    }

    fn print_heredoc_parts(&mut self, parts: &[StringPart]) {
        for part in parts.iter() {
            match part {
                StringPart::Literal(s) => self.w(&escape_heredoc(s)),
                StringPart::Expr(expr) => self.print_string_part_expr(expr),
                _ => self.unsupported("string part"),
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
            | ExprKind::StaticDynMethodCall(_)
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
        ExprKind::UnaryPostfix(unary) => unary.operand,
        ExprKind::FunctionCall(call) => call.name,
        ExprKind::ArrayAccess(access) => access.array,
        ExprKind::PropertyAccess(access) | ExprKind::NullsafePropertyAccess(access) => {
            access.object
        }
        ExprKind::MethodCall(call) | ExprKind::NullsafeMethodCall(call) => call.object,
        ExprKind::StaticPropertyAccess(access) | ExprKind::ClassConstAccess(access) => access.class,
        ExprKind::ClassConstAccessDynamic { class, .. }
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => class,
        ExprKind::StaticMethodCall(call) => call.class,
        ExprKind::StaticDynMethodCall(call) => call.class,
        ExprKind::CallableCreate(cc) => match &cc.kind {
            CallableCreateKind::Function(name) => name,
            CallableCreateKind::Method { object, .. }
            | CallableCreateKind::NullsafeMethod { object, .. } => object,
            CallableCreateKind::StaticMethod { class, .. } => class,
            _ => return None,
        },
        _ => return None,
    };
    Some((operand, PREC_PRIMARY))
}
