use php_ast::*;
use php_lexer::TokenKind;

use crate::diagnostics::{ForbiddenRule, ParseError};
use crate::instrument;
use crate::parser::Parser;
use crate::precedence::{
    self, ASSIGNMENT_BP, MEMBER_ACCESS_BP, NULL_COALESCE_LEFT_BP, SCOPE_RESOLUTION_BP, TERNARY_BP,
};
use crate::version::PhpVersion;
use php_ast::span::Span;

mod atom;
mod folded_value;
mod internal_constants;
pub(crate) mod interpolation;
mod special_calls;

// Re-exports so external callers' paths don't change
pub(crate) use atom::{
    callable_marker_arg, parse_arg_list_or_callable, parse_arrow_function, parse_closure,
    ArgListResult, CAST_KEYWORDS,
};

use atom::{parse_atom, parse_function_call};

/// Returns the "chain group" binding power for a non-associative token, if applicable.
///
/// PHP 8.0+ rejects chaining non-associative operators within the same precedence group:
/// - Equality group (bp 25): `==`, `!=`, `===`, `!==`, `<=>`
/// - Comparison group (bp 27): `<`, `>`, `<=`, `>=`
///
/// `instanceof` is intentionally excluded: PHP allows `$a instanceof Foo instanceof Bar`
/// at parse time and does not reject cross-group chains like `$a > $b == $c`.
fn nonassoc_chain_level_for_token(kind: TokenKind) -> Option<u8> {
    match kind {
        TokenKind::EqualsEquals
        | TokenKind::BangEquals
        | TokenKind::EqualsEqualsEquals
        | TokenKind::BangEqualsEquals
        | TokenKind::Spaceship => Some(25),
        TokenKind::LessThan
        | TokenKind::GreaterThan
        | TokenKind::LessThanEquals
        | TokenKind::GreaterThanEquals => Some(27),
        _ => None,
    }
}

/// Returns the "chain group" binding power for a binary op produced by a non-associative token.
///
/// Mirrors `nonassoc_chain_level_for_token` but operates on the already-parsed binary op.
/// `instanceof` returns `None` for the same reasons described above.
fn nonassoc_chain_level_for_op(op: BinaryOp) -> Option<u8> {
    match op {
        BinaryOp::Equal
        | BinaryOp::NotEqual
        | BinaryOp::Identical
        | BinaryOp::NotIdentical
        | BinaryOp::Spaceship => Some(25),
        BinaryOp::Less | BinaryOp::Greater | BinaryOp::LessOrEqual | BinaryOp::GreaterOrEqual => {
            Some(27)
        }
        _ => None,
    }
}

/// Returns true if `kind` is a valid PHP assignment target (lvalue).
///
/// Valid targets: variable, variable-variable, array access, property access,
/// static property access and array/list destructuring.
/// Invalid targets emit a `ParseError::Forbidden` diagnostic at the assignment site.
fn is_valid_assignment_target(kind: &ExprKind<'_, '_>) -> bool {
    matches!(
        kind,
        ExprKind::Variable(_)
            | ExprKind::VariableVariable(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::StaticPropertyAccessDynamic { .. }
            | ExprKind::Array(_)
            | ExprKind::Error
    )
}

/// PHP's message for a write to the result of a call, as in `f() = 1`.
fn call_result_write_message(kind: &ExprKind<'_, '_>) -> Option<&'static str> {
    match kind {
        ExprKind::FunctionCall(FunctionCallExpr { name, .. })
        | ExprKind::CallableCreate(CallableCreateExpr {
            kind: CallableCreateKind::Function(name),
        }) if !is_clone_keyword(name) => Some("Can't use function return value in write context"),
        ExprKind::MethodCall(_)
        | ExprKind::NullsafeMethodCall(_)
        | ExprKind::StaticMethodCall(_)
        | ExprKind::StaticMethodCallDynamic(_)
        | ExprKind::CallableCreate(CallableCreateExpr {
            kind:
                CallableCreateKind::Method { .. }
                | CallableCreateKind::NullsafeMethod { .. }
                | CallableCreateKind::StaticMethod { .. },
        }) => Some("Can't use method return value in write context"),
        _ => None,
    }
}

/// Report an operand of `++` or `--` that PHP cannot write to.
pub(crate) fn check_increment_operand(parser: &mut Parser<'_, '_>, operand: &Expr<'_, '_>) {
    let (rule, message) = if let Some(message) = call_result_write_message(&operand.kind) {
        (ForbiddenRule::CallResultWrite, message)
    } else if !matches!(
        operand.kind,
        ExprKind::Variable(_)
            | ExprKind::VariableVariable(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::StaticPropertyAccessDynamic { .. }
            | ExprKind::Error
    ) {
        (
            ForbiddenRule::IncDecNonVariable,
            "Cannot increment or decrement an expression that is not a variable",
        )
    } else if let Some(error) = write_message(parser, &operand.kind) {
        error
    } else if has_nullsafe_link(&operand.kind) {
        (
            ForbiddenRule::NullsafeWrite,
            "Can't use nullsafe operator in write context",
        )
    } else {
        return check_special_variable_write(parser, operand, WriteKind::Modify);
    };
    parser.forbid(rule, message, operand.span);
}

/// Report `target` where PHP writes to it (an `unset` argument, a `foreach`
/// target or a by-reference array element) unless it is writable;
/// `allow_list` permits a destructuring list.
pub(crate) fn check_write_target(
    parser: &mut Parser<'_, '_>,
    target: &Expr<'_, '_>,
    allow_list: bool,
) {
    let (rule, message) = if let Some(error) = write_message(parser, &target.kind) {
        error
    } else if let Some(message) = call_result_write_message(&target.kind) {
        (ForbiddenRule::CallResultWrite, message)
    } else if has_nullsafe_link(&target.kind) {
        (
            ForbiddenRule::NullsafeWrite,
            "Can't use nullsafe operator in write context",
        )
    } else if !is_valid_assignment_target(&target.kind)
        || !allow_list && matches!(target.kind, ExprKind::Array(_))
    {
        (
            ForbiddenRule::InvalidWriteContext,
            "Can't use this expression in write context",
        )
    } else {
        if let ExprKind::Array(elems) = &target.kind {
            check_destructure_elements(parser, elems);
        }
        return;
    };
    parser.forbid(rule, message, target.span);
}

/// Report each element of a destructuring list that PHP cannot assign to, in nested lists too.
fn check_destructure_elements(parser: &mut Parser<'_, '_>, elems: &[ArrayElement<'_, '_>]) {
    for el in elems.iter() {
        if el.is_spread() {
            parser.forbid(
                ForbiddenRule::SpreadInDestructuring,
                "Spread operator is not supported in assignments",
                el.span,
            );
            continue;
        }
        // PHP rejects `($a) = …` but accepts `[($a)] = …`.
        let mut value = el.value();
        while let ExprKind::Parenthesized(inner) = &value.kind {
            value = inner;
        }
        match &value.kind {
            ExprKind::Omit => {}
            ExprKind::Array(nested) => check_destructure_elements(parser, nested),
            kind => {
                if let Some(message) = call_result_write_message(kind) {
                    parser.forbid(ForbiddenRule::CallResultWrite, message, value.span);
                } else if builtin_call_base(parser, kind, false) {
                    parser.forbid(
                        ForbiddenRule::BuiltinResultWrite,
                        "Cannot use result of built-in function in write context",
                        value.span,
                    );
                } else if !is_valid_destructure_element(kind, parser.version) {
                    parser.forbid(
                        ForbiddenRule::UnwritableDestructuringElement,
                        "Assignments can only happen to writable values",
                        el.value().span,
                    );
                }
            }
        }
    }
}

/// How a write reaches its target; PHP rejects different writes to `$this` and `$GLOBALS`.
#[derive(Clone, Copy, PartialEq, Eq)]
pub(crate) enum WriteKind {
    /// `=`, `=&`, `??=`, destructuring and `foreach` targets.
    Assign,
    /// Compound assignment, `++` / `--` and by-reference array elements.
    Modify,
    /// The source of `=&`.
    Reference,
    Unset,
}

/// Report a write PHP forbids to `$this` or `$GLOBALS`.
pub(crate) fn check_special_variable_write(
    parser: &mut Parser<'_, '_>,
    target: &Expr<'_, '_>,
    kind: WriteKind,
) {
    let (rule, message) = match &target.kind {
        ExprKind::Array(elems) if kind == WriteKind::Assign => {
            for el in elems.iter() {
                let mut value = el.value();
                while let ExprKind::Parenthesized(inner) = &value.kind {
                    value = inner;
                }
                // A by-reference element was checked as an array literal.
                if !el.is_by_ref() || is_variable_named(value, "this") {
                    check_special_variable_write(parser, value, kind);
                }
            }
            return;
        }
        ExprKind::Variable(name) => match (name.as_str(), kind) {
            ("this", WriteKind::Assign) => (ForbiddenRule::ReassignThis, "Cannot re-assign $this"),
            ("this", WriteKind::Unset) => (ForbiddenRule::UnsetThis, "Cannot unset $this"),
            ("GLOBALS", _) if parser.version < PhpVersion::Php81 => return,
            ("GLOBALS", WriteKind::Reference) => (
                ForbiddenRule::InvalidGlobalsWrite,
                "Cannot acquire reference to $GLOBALS",
            ),
            ("GLOBALS", _) => (
                ForbiddenRule::InvalidGlobalsWrite,
                "$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax",
            ),
            _ => return,
        },
        _ => return,
    };
    parser.forbid(rule, message, target.span);
}

fn is_variable_named(expr: &Expr<'_, '_>, name: &str) -> bool {
    matches!(&expr.kind, ExprKind::Variable(n) if n.as_str() == name)
}

/// Names PHP registers as auto-globals.
pub(crate) fn is_superglobal(name: &str) -> bool {
    matches!(
        name,
        "GLOBALS"
            | "_GET"
            | "_POST"
            | "_COOKIE"
            | "_FILES"
            | "_SERVER"
            | "_ENV"
            | "_REQUEST"
            | "_SESSION"
    )
}

/// True for the unqualified `clone` that the parser only produces from the keyword.
fn is_clone_keyword(name: &Expr<'_, '_>) -> bool {
    matches!(&name.kind, ExprKind::Name(Name::Simple { value, .. }) if value.eq_ignore_ascii_case("clone"))
}

/// Report `->`, `?->`, `::`, `[` or a call applied to an expression PHP cannot
/// dereference, such as `match (...) {...}[0]`, `1->a` or `function () {}()`.
fn check_dereferencable(parser: &mut Parser<'_, '_>, lhs: &Expr<'_, '_>, op: TokenKind) {
    let dereferencable = match lhs.kind {
        ExprKind::Match(_)
        | ExprKind::Closure(_)
        | ExprKind::ArrowFunction(_)
        | ExprKind::Int(_)
        | ExprKind::Float(_)
        | ExprKind::Heredoc { .. }
        | ExprKind::Nowdoc { .. }
        | ExprKind::ShellExec(_)
        | ExprKind::Isset(_)
        | ExprKind::Empty(_)
        | ExprKind::Exit(_)
        | ExprKind::Eval(_) => false,
        ExprKind::Array(_) => !is_list_syntax(parser.source(), lhs.span),
        ExprKind::MagicConst(_) => !matches!(op, TokenKind::DoubleColon | TokenKind::LeftParen),
        // The 8.5 call forms of `clone`; the plain `clone($a)` is grouped before it gets here.
        ExprKind::CloneWith(..) | ExprKind::Clone(_) => false,
        ExprKind::CallableCreate(CallableCreateExpr {
            kind: CallableCreateKind::Function(name),
        })
        | ExprKind::FunctionCall(FunctionCallExpr { name, .. }) => !is_clone_keyword(name),
        _ => true,
    };
    if !dereferencable {
        parser.forbid(
            ForbiddenRule::InvalidDereference,
            "Cannot dereference this expression",
            lhs.span,
        );
    } else if parser.version < PhpVersion::Php80 {
        let object_access = matches!(op, TokenKind::Arrow | TokenKind::NullsafeArrow);
        let feature = match lhs.kind {
            ExprKind::Name(_) if object_access => "object access on a constant",
            ExprKind::ClassConstAccess(_) if object_access || op == TokenKind::DoubleColon => {
                "class constant dereferencing"
            }
            ExprKind::MagicConst(_) => "magic constant dereferencing",
            ExprKind::InterpolatedString(_) => "interpolated string dereferencing",
            _ => return,
        };
        parser.require_version(PhpVersion::Php80, feature, lhs.span);
    }
}

pub(crate) const CURLY_OFFSET_REMOVED: &str =
    "Array and string offset access syntax with curly braces is no longer supported";

/// PHP 8.0 to 8.3 check a `{}` offset only where it is not the base of a fetch or call.
fn allow_curly_base(parser: &mut Parser<'_, '_>, base: &Expr<'_, '_>) {
    if !(PhpVersion::Php80..PhpVersion::Php84).contains(&parser.version) {
        return;
    }
    let ExprKind::ArrayAccess(a) = &base.kind else {
        return;
    };
    let brace = Span::new(
        a.array.span.end,
        a.index.map_or(base.span.end, |index| index.span.start),
    );
    let Some(i) = parser
        .retractable_curly
        .iter()
        .rposition(|s| s.start >= brace.start && s.end <= brace.end)
    else {
        return;
    };
    let span = parser.retractable_curly.swap_remove(i);
    let errors = parser.errors_mut();
    if let Some(j) = errors.iter().rposition(|e| {
        matches!(e, ParseError::Forbidden { rule: ForbiddenRule::CurlyOffsetAccess, span: s, .. } if *s == span)
    }) {
        errors.remove(j);
    }
    parser.curly_bases.push(span);
}

/// PHP 8.0 to 8.3 check every `{}` offset an array literal fold reaches, base of a fetch or not.
/// Report unpacking a non-array in the array literal `elements` when PHP folds it.
pub(crate) fn check_constant_unpack(
    parser: &mut Parser<'_, '_>,
    elements: &[ArrayElement<'_, '_>],
) {
    let Some((span, given)) = folded_value::constant_unpack_error(parser, elements) else {
        return;
    };
    let message = if parser.version >= PhpVersion::Php84 {
        format!("Only arrays and Traversables can be unpacked, {given} given")
    } else {
        "Only arrays and Traversables can be unpacked".to_string()
    };
    parser.forbid(ForbiddenRule::UnpackNonArray, message, span);
}

pub(crate) fn check_folded_curly_offsets(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>) {
    if parser.curly_bases.is_empty() {
        return;
    }
    match &expr.kind {
        ExprKind::Array(elements) => {
            for element in elements.iter() {
                if let Some(key) = &element.key {
                    check_folded_curly_in(parser, key);
                }
                check_folded_curly_in(parser, element.value());
            }
        }
        _ => check_folded_curly_in(parser, expr),
    }
}

/// The walk of PHP's `zend_eval_const_expr`; a nested array literal was checked when parsed.
fn check_folded_curly_in(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>) {
    match &expr.kind {
        ExprKind::ArrayAccess(a) => {
            let brace = Span::new(
                a.array.span.end,
                a.index.map_or(expr.span.end, |index| index.span.start),
            );
            let retracted = parser
                .curly_bases
                .iter()
                .copied()
                .find(|s| s.start >= brace.start && s.end <= brace.end);
            if let Some(span) = retracted.filter(|s| !parser.folded_curly.contains(s)) {
                parser.folded_curly.push(span);
                parser.forbid(ForbiddenRule::CurlyOffsetAccess, CURLY_OFFSET_REMOVED, span);
            }
            check_folded_curly_in(parser, a.array);
            if let Some(index) = a.index {
                check_folded_curly_in(parser, index);
            }
        }
        ExprKind::Binary(b) => {
            check_folded_curly_in(parser, b.left);
            check_folded_curly_in(parser, b.right);
        }
        ExprKind::UnaryPrefix(u)
            if !matches!(
                u.op,
                UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
            ) =>
        {
            check_folded_curly_in(parser, u.operand);
        }
        ExprKind::NullCoalesce(c) => {
            check_folded_curly_in(parser, c.left);
            check_folded_curly_in(parser, c.right);
        }
        ExprKind::Ternary(t) => {
            check_folded_curly_in(parser, t.condition);
            if let Some(then_expr) = t.then_expr {
                check_folded_curly_in(parser, then_expr);
            }
            check_folded_curly_in(parser, t.else_expr);
        }
        ExprKind::Parenthesized(inner) => check_folded_curly_in(parser, inner),
        ExprKind::ClassConstAccess(a) => check_folded_curly_in(parser, a.class),
        ExprKind::ClassConstAccessDynamic { class, member } => {
            check_folded_curly_in(parser, class);
            check_folded_curly_in(parser, member);
        }
        ExprKind::New(n) => {
            check_folded_curly_in(parser, n.class);
            for value in n.args.iter().filter_map(|arg| arg.value()) {
                check_folded_curly_in(parser, value);
            }
        }
        ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p)
            if parser.version >= PhpVersion::Php82 =>
        {
            check_folded_curly_in(parser, p.object);
            check_folded_curly_in(parser, p.property);
        }
        _ => {}
    }
}

/// A destructuring or `foreach` target is not folded, so its `{}` bases stay allowed.
pub(crate) fn unfold_curly_offsets(parser: &mut Parser<'_, '_>, target: &Expr<'_, '_>) {
    if parser.folded_curly.is_empty() || !matches!(target.kind, ExprKind::Array(_)) {
        return;
    }
    let range = target.span;
    let (unfolded, kept): (Vec<Span>, Vec<Span>) = parser
        .folded_curly
        .iter()
        .partition(|s| s.start >= range.start && s.end <= range.end);
    parser.folded_curly = kept;
    parser.errors_mut().retain(|e| {
        !matches!(e, ParseError::Forbidden {
            rule: ForbiddenRule::CurlyOffsetAccess,
            span,
            ..
        } if unfolded.contains(span))
    });
}

/// The class of a static property fetch or static call, whose `{}` offset PHP 8.0 to 8.3 allow.
fn allow_curly_static_base(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>) {
    let class = match &expr.kind {
        ExprKind::StaticPropertyAccess(a) => a.class,
        ExprKind::StaticPropertyAccessDynamic { class, .. } => *class,
        ExprKind::StaticMethodCall(c) => c.class,
        ExprKind::StaticMethodCallDynamic(c) => c.class,
        ExprKind::CallableCreate(CallableCreateExpr {
            kind: CallableCreateKind::StaticMethod { class, .. },
        }) => *class,
        _ => return,
    };
    allow_curly_base(parser, class);
}

/// PHP's `class_name_reference`: a name, a parenthesized expression or a `new_variable`.
fn is_class_name_reference(expr: &Expr<'_, '_>) -> bool {
    matches!(
        expr.kind,
        ExprKind::Name(_) | ExprKind::Parenthesized(_) | ExprKind::Error
    ) || is_new_variable(expr)
}

fn is_new_variable(expr: &Expr<'_, '_>) -> bool {
    match &expr.kind {
        ExprKind::Variable(_) | ExprKind::VariableVariable(_) => true,
        ExprKind::ArrayAccess(a) => is_new_variable(a.array),
        ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => {
            is_new_variable(p.object)
        }
        ExprKind::StaticPropertyAccess(StaticAccessExpr { class, .. })
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => {
            matches!(class.kind, ExprKind::Name(_)) || is_new_variable(class)
        }
        _ => false,
    }
}

/// Report a class reference PHP folds to a value that is not a string, such as `(1)::A`.
pub(crate) fn check_class_name_literal(parser: &mut Parser<'_, '_>, class: &Expr<'_, '_>) {
    if is_literal(class) && literal_is_string(class, parser.version) == Some(false) {
        parser.forbid(
            ForbiddenRule::LiteralClassName,
            "Illegal class name",
            class.span,
        );
    }
}

/// `(1)::class` is an illegal class name, while `([])::class` names the type it cannot use.
fn check_class_name_fetch_literal(parser: &mut Parser<'_, '_>, class: &Expr<'_, '_>) {
    let (rule, message) = match &unparenthesized(class).kind {
        ExprKind::Int(_) | ExprKind::Float(_) => {
            (ForbiddenRule::LiteralClassName, "Illegal class name")
        }
        ExprKind::Bool(true) => (
            ForbiddenRule::ClassFetchOnLiteral,
            "Cannot use \"::class\" on true",
        ),
        ExprKind::Bool(false) => (
            ForbiddenRule::ClassFetchOnLiteral,
            "Cannot use \"::class\" on false",
        ),
        ExprKind::Null => (
            ForbiddenRule::ClassFetchOnLiteral,
            "Cannot use \"::class\" on null",
        ),
        ExprKind::Array(_) if is_literal(class) => (
            ForbiddenRule::ClassFetchOnLiteral,
            "Cannot use \"::class\" on array",
        ),
        _ => return,
    };
    parser.forbid(rule, message, class.span);
}

/// PHP 7.4 resolves `::class` at compile time on a name, a bare `true`, `false` or `null`, or a literal.
fn is_compile_time_class(class: &Expr<'_, '_>) -> bool {
    if matches!(
        class.kind,
        ExprKind::Name(_) | ExprKind::Bool(_) | ExprKind::Null
    ) {
        return true;
    }
    matches!(
        unparenthesized(class).kind,
        ExprKind::String(_) | ExprKind::Int(_) | ExprKind::Float(_)
    )
}

/// Whether a literal expression folds to a string, when that is known without evaluating it.
fn literal_is_string(expr: &Expr<'_, '_>, version: PhpVersion) -> Option<bool> {
    folded_type(expr, version).map(|t| matches!(t, Folded::Str { .. }))
}

/// The type PHP folds a literal expression to.
#[derive(Clone, Copy)]
enum Folded {
    Int,
    /// A float, or a number of either type.
    Number,
    Bool,
    Null,
    Str {
        numeric: bool,
    },
    Array,
}

impl Folded {
    /// Whether arithmetic on this operand folds without a TypeError.
    fn is_arithmetic(self) -> bool {
        !matches!(self, Folded::Array | Folded::Str { numeric: false })
    }

    /// Whether integer operations on this operand fold without a deprecation for a lost fraction.
    fn is_integral(self, version: PhpVersion) -> bool {
        matches!(self, Folded::Int | Folded::Bool | Folded::Null)
            || (matches!(self, Folded::Number) && version < PhpVersion::Php81)
    }
}

/// The folded type of `expr`, or `None` when it is unknown or PHP leaves the expression to run
/// time because folding it would raise an error or a diagnostic.
fn folded_type(expr: &Expr<'_, '_>, version: PhpVersion) -> Option<Folded> {
    let non_negative_int =
        |e: &Expr<'_, '_>| matches!(unparenthesized(e).kind, ExprKind::Int(n) if n >= 0);
    let folded = match &expr.kind {
        ExprKind::String(s) => Folded::Str {
            numeric: is_numeric_string(s.as_bytes()),
        },
        ExprKind::Nowdoc { value, .. } => Folded::Str {
            numeric: is_numeric_string(value.as_bytes()),
        },
        ExprKind::Heredoc { .. } => Folded::Str { numeric: false },
        ExprKind::Int(_) => Folded::Int,
        ExprKind::Float(_) => Folded::Number,
        ExprKind::Bool(_) => Folded::Bool,
        ExprKind::Null => Folded::Null,
        ExprKind::Array(_) => Folded::Array,
        ExprKind::Parenthesized(inner) => return folded_type(inner, version),
        ExprKind::UnaryPrefix(u) => {
            let operand = folded_type(u.operand, version)?;
            match u.op {
                UnaryPrefixOp::BooleanNot => Folded::Bool,
                UnaryPrefixOp::Negate | UnaryPrefixOp::Plus if operand.is_arithmetic() => {
                    Folded::Number
                }
                UnaryPrefixOp::BitwiseNot => match operand {
                    Folded::Str { .. } => Folded::Str { numeric: false },
                    Folded::Int => Folded::Int,
                    Folded::Number if version < PhpVersion::Php81 => Folded::Int,
                    _ => return None,
                },
                _ => return None,
            }
        }
        ExprKind::Binary(b) => {
            let (left, right) = (
                folded_type(b.left, version)?,
                folded_type(b.right, version)?,
            );
            match b.op {
                BinaryOp::Concat
                    if !matches!(left, Folded::Array) && !matches!(right, Folded::Array) =>
                {
                    Folded::Str { numeric: false }
                }
                BinaryOp::Add if matches!((left, right), (Folded::Array, Folded::Array)) => {
                    Folded::Array
                }
                BinaryOp::Add | BinaryOp::Sub | BinaryOp::Mul
                    if left.is_arithmetic() && right.is_arithmetic() =>
                {
                    Folded::Number
                }
                // Since 8.4 `0 ** -1` is deprecated, so only a non-negative exponent always folds.
                BinaryOp::Pow
                    if left.is_arithmetic()
                        && right.is_arithmetic()
                        && (version < PhpVersion::Php84 || non_negative_int(b.right)) =>
                {
                    Folded::Number
                }
                BinaryOp::ShiftLeft | BinaryOp::ShiftRight
                    if left.is_integral(version) && non_negative_int(b.right) =>
                {
                    Folded::Int
                }
                BinaryOp::BitwiseAnd | BinaryOp::BitwiseOr | BinaryOp::BitwiseXor => {
                    match (left, right) {
                        (Folded::Str { .. }, Folded::Str { .. }) => Folded::Str { numeric: false },
                        _ if left.is_integral(version) && right.is_integral(version) => Folded::Int,
                        _ => return None,
                    }
                }
                BinaryOp::Equal
                | BinaryOp::NotEqual
                | BinaryOp::Identical
                | BinaryOp::NotIdentical
                | BinaryOp::Less
                | BinaryOp::Greater
                | BinaryOp::LessOrEqual
                | BinaryOp::GreaterOrEqual
                | BinaryOp::BooleanAnd
                | BinaryOp::BooleanOr
                | BinaryOp::LogicalAnd
                | BinaryOp::LogicalOr
                | BinaryOp::LogicalXor => Folded::Bool,
                BinaryOp::Spaceship => Folded::Int,
                _ => return None,
            }
        }
        _ => return None,
    };
    Some(folded)
}

/// An operand PHP 7.4 folds at compile time, as far as its operand type errors need.
#[derive(Clone, Copy)]
enum Operand74 {
    /// An array; `Some(true)` if it is known to be empty.
    Array(Option<bool>),
    Bool(bool),
    Null,
    /// A number or numeric string; `Some(true)` if it is known to convert to the integer 0.
    Number(Option<bool>),
}

impl Operand74 {
    fn is_array(self) -> bool {
        matches!(self, Operand74::Array(_))
    }

    /// Whether the operand converts to the integer 0, which PHP never folds a division by.
    fn is_zero(self) -> Option<bool> {
        match self {
            Operand74::Array(empty) | Operand74::Number(empty) => empty,
            Operand74::Bool(b) => Some(!b),
            Operand74::Null => Some(true),
        }
    }
}

/// The operand `expr` folds to on PHP 7.4, or `None` when that is unknown or PHP leaves it to run time.
fn operand_74(expr: &Expr<'_, '_>) -> Option<Operand74> {
    let float_is_zero = |f: f64| (f.is_finite() && f.abs() < 9.0e18).then_some(f.trunc() == 0.0);
    let expr = unparenthesized(expr);
    match &expr.kind {
        ExprKind::Bool(b) => return Some(Operand74::Bool(*b)),
        ExprKind::Null => return Some(Operand74::Null),
        ExprKind::UnaryPrefix(u) if u.op == UnaryPrefixOp::BooleanNot => {
            return const_truth(u.operand, PhpVersion::Php74).map(|truth| Operand74::Bool(!truth));
        }
        ExprKind::Array(elements) => {
            let simple = |e: &Expr<'_, '_>| {
                operand_74(e).is_some() || matches!(literal_scalar(e), Some(Scalar::String(_)))
            };
            let constant = elements.iter().all(|el| {
                !el.is_by_ref()
                    && !matches!(el.kind, ArrayElementKind::Spread(_))
                    && el.key.as_ref().is_none_or(simple)
                    && simple(el.value())
            });
            return constant.then_some(Operand74::Array(Some(elements.is_empty())));
        }
        ExprKind::Binary(b) if b.op == BinaryOp::Add => {
            if let (Some(Operand74::Array(l)), Some(Operand74::Array(r))) =
                (operand_74(b.left), operand_74(b.right))
            {
                let empty = match (l, r) {
                    (Some(false), _) | (_, Some(false)) => Some(false),
                    (Some(true), Some(true)) => Some(true),
                    _ => None,
                };
                return Some(Operand74::Array(empty));
            }
        }
        _ => {}
    }
    Some(Operand74::Number(match literal_scalar(expr)? {
        Scalar::Int(n) => Some(n == 0),
        Scalar::Float(f) => float_is_zero(f),
        // PHP 7.4 leaves arithmetic on a non-numeric string, or one with trailing whitespace, to run time.
        Scalar::String(s) => {
            let trailing_space = s.last().is_some_and(|b| b.is_ascii_whitespace());
            if trailing_space || !is_numeric_string(&s) {
                return None;
            }
            float_is_zero(std::str::from_utf8(&s).ok()?.trim().parse().ok()?)
        }
    }))
}

/// PHP 7.4 folds arithmetic on literals at compile time, failing on operand types it cannot take.
pub(crate) fn check_unsupported_operands(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>) {
    if parser.version >= PhpVersion::Php80 {
        return;
    }
    let unsupported = match &expr.kind {
        ExprKind::Binary(b) => {
            let (Some(left), Some(right)) = (operand_74(b.left), operand_74(b.right)) else {
                return;
            };
            match b.op {
                BinaryOp::Add => left.is_array() != right.is_array(),
                BinaryOp::Sub | BinaryOp::Mul => left.is_array() || right.is_array(),
                BinaryOp::Div => {
                    (left.is_array() || right.is_array()) && right.is_zero() == Some(false)
                }
                _ => false,
            }
        }
        ExprKind::UnaryPrefix(u) => match (u.op, operand_74(u.operand)) {
            (UnaryPrefixOp::Negate | UnaryPrefixOp::Plus, Some(operand)) => operand.is_array(),
            (UnaryPrefixOp::BitwiseNot, Some(operand)) => !matches!(operand, Operand74::Number(_)),
            _ => false,
        },
        _ => false,
    };
    if unsupported {
        parser.forbid(
            ForbiddenRule::UnsupportedOperandTypes,
            "Unsupported operand types",
            expr.span,
        );
    }
}

/// PHP's numeric string: optional surrounding whitespace around a decimal integer or float.
fn is_numeric_string(s: &[u8]) -> bool {
    let is_space = |b: &u8| matches!(b, b' ' | b'\t' | b'\n' | b'\r' | b'\x0B' | b'\x0C');
    let start = s.iter().position(|b| !is_space(b)).unwrap_or(s.len());
    let end = s
        .iter()
        .rposition(|b| !is_space(b))
        .map_or(start, |p| p + 1);
    let mut rest = s[start..end]
        .strip_prefix(b"-")
        .or_else(|| s[start..end].strip_prefix(b"+"))
        .unwrap_or(&s[start..end]);
    let digits = |rest: &mut &[u8]| {
        let n = rest.iter().take_while(|b| b.is_ascii_digit()).count();
        *rest = &rest[n..];
        n
    };
    let mut mantissa = digits(&mut rest);
    if let Some(after) = rest.strip_prefix(b".") {
        rest = after;
        mantissa += digits(&mut rest);
    }
    if mantissa == 0 {
        return false;
    }
    if let Some(after) = rest.strip_prefix(b"e").or_else(|| rest.strip_prefix(b"E")) {
        rest = after
            .strip_prefix(b"-")
            .or_else(|| after.strip_prefix(b"+"))
            .unwrap_or(after);
        if digits(&mut rest) == 0 {
            return false;
        }
    }
    rest.is_empty()
}

/// True if the fetch chain ending in `kind` passes through `?->`. Like PHP's
/// short-circuit chain, it runs through property, method, index and static
/// member links, but not through a class constant or a plain call.
fn has_nullsafe_link(kind: &ExprKind<'_, '_>) -> bool {
    nullsafe_link(kind, false)
}

/// PHP compiles `$this?->x` as `$this->x`, as `$this` is never null.
fn is_this(kind: &ExprKind<'_, '_>) -> bool {
    match kind {
        ExprKind::Variable(n) => n.as_str() == "this",
        ExprKind::Parenthesized(inner) => is_this(&inner.kind),
        _ => false,
    }
}

fn nullsafe_link(kind: &ExprKind<'_, '_>, this_is_exempt: bool) -> bool {
    let mut cur = kind;
    loop {
        cur = match cur {
            ExprKind::NullsafePropertyAccess(a) if this_is_exempt && is_this(&a.object.kind) => {
                return false;
            }
            ExprKind::NullsafeMethodCall(c) if this_is_exempt && is_this(&c.object.kind) => {
                return false;
            }
            ExprKind::NullsafePropertyAccess(_) | ExprKind::NullsafeMethodCall(_) => return true,
            ExprKind::PropertyAccess(a) => &a.object.kind,
            ExprKind::MethodCall(c) => &c.object.kind,
            ExprKind::ArrayAccess(a) => &a.array.kind,
            ExprKind::StaticPropertyAccess(a) => &a.class.kind,
            ExprKind::StaticPropertyAccessDynamic { class, .. } => &class.kind,
            ExprKind::StaticMethodCall(c) => &c.class.kind,
            ExprKind::StaticMethodCallDynamic(c) => &c.class.kind,
            ExprKind::Parenthesized(inner) => &inner.kind,
            _ => return false,
        };
    }
}

/// True if a destructuring-element value other than a nested list is a writable target.
fn is_valid_destructure_element(kind: &ExprKind<'_, '_>, version: PhpVersion) -> bool {
    is_valid_assignment_target(kind)
        && !has_nullsafe_link(kind)
        && temporary_write_message(kind, version).is_none()
}

/// Report a `return` or `yield` of a nullsafe fetch in a function that returns by reference.
pub(crate) fn check_reference_return(parser: &mut Parser<'_, '_>, value: &Expr<'_, '_>) {
    if !parser.by_ref_function {
        return;
    }
    let mut kind = &value.kind;
    while let ExprKind::Parenthesized(inner) = kind {
        kind = &inner.kind;
    }
    let is_fetch = matches!(
        kind,
        ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::StaticPropertyAccessDynamic { .. }
    );
    if is_fetch && has_nullsafe_link(kind) {
        parser.forbid(
            ForbiddenRule::ReferenceToNullsafe,
            "Cannot take reference of a nullsafe chain",
            value.span,
        );
    }
}

fn check_method_name(parser: &mut Parser<'_, '_>, method: &Expr<'_, '_>) {
    if folded_value::folds_to_non_string(parser, method) {
        parser.forbid(
            ForbiddenRule::MethodNameNotString,
            "Method name must be a string",
            method.span,
        );
    }
}

/// True if `kind` is a variable, a fetch or a call: what PHP can take a reference of.
pub(crate) fn is_variable_or_call(kind: &ExprKind<'_, '_>) -> bool {
    matches!(
        kind,
        ExprKind::Variable(_)
            | ExprKind::VariableVariable(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::StaticPropertyAccessDynamic { .. }
            | ExprKind::FunctionCall(_)
            | ExprKind::MethodCall(_)
            | ExprKind::NullsafeMethodCall(_)
            | ExprKind::StaticMethodCall(_)
            | ExprKind::StaticMethodCallDynamic(_)
            | ExprKind::CallableCreate(_)
            | ExprKind::Error
    )
}

/// True if a destructuring list assigns any element by reference, as in `[&$a] = …`.
fn has_reference_element(kind: &ExprKind<'_, '_>) -> bool {
    let ExprKind::Array(elems) = kind else {
        return false;
    };
    elems
        .iter()
        .any(|el| el.is_by_ref() || has_reference_element(&el.value().kind))
}

const INVALID_CONST_EXPR: &str = "Constant expression contains invalid operations";

enum ConstExprError {
    Forbidden(&'static str, Span),
    Version(PhpVersion, &'static str, Span),
}

/// Report the first part of a constant expression PHP cannot evaluate at compile time.
pub(crate) fn check_const_expr(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>, allow_new: bool) {
    report_const_expr(parser, expr, allow_new, true);
}

/// [`check_const_expr`] for a parameter default, where PHP substitutes no constant while folding.
pub(crate) fn check_param_default(parser: &mut Parser<'_, '_>, expr: &Expr<'_, '_>) {
    report_const_expr(parser, expr, true, false);
}

fn report_const_expr(
    parser: &mut Parser<'_, '_>,
    expr: &Expr<'_, '_>,
    allow_new: bool,
    substitutes_constants: bool,
) {
    let checker = ConstExprChecker {
        parser,
        version: parser.version,
        allow_new,
        substitutes_constants,
    };
    match checker.check(expr) {
        Ok(()) => {}
        Err(ConstExprError::Forbidden(message, span)) => {
            parser.forbid(ForbiddenRule::InvalidConstantExpression, message, span)
        }
        Err(ConstExprError::Version(min, feature, span)) => {
            parser.require_version(min, feature, span)
        }
    }
}

struct ConstExprChecker<'p, 'arena, 'src> {
    parser: &'p Parser<'arena, 'src>,
    version: PhpVersion,
    allow_new: bool,
    substitutes_constants: bool,
}

impl ConstExprChecker<'_, '_, '_> {
    /// Whether PHP may fold `expr` at compile time, substituting the constants it knows.
    fn may_fold(&self, expr: &Expr<'_, '_>) -> bool {
        foldable(expr, Some(self))
    }

    /// Whether `name` may be an internal constant, which PHP substitutes while folding.
    fn may_be_internal_constant(&self, name: &Name<'_, '_>) -> bool {
        let parts = name.parts_slice();
        let global = match name.kind() {
            NameKind::FullyQualified => true,
            NameKind::Unqualified | NameKind::Qualified | NameKind::Relative => {
                self.parser.namespace.is_none()
            }
            _ => false,
        };
        match parts {
            [word]
                if ["true", "false", "null"]
                    .iter()
                    .any(|w| word.eq_ignore_ascii_case(w)) =>
            {
                true
            }
            [word] => {
                global && self.substitutes_constants && {
                    let leading = word.split('_').next().unwrap_or(word);
                    internal_constants::INTERNAL_CONSTANT_WORDS
                        .binary_search(&leading)
                        .is_ok()
                }
            }
            // PHP substitutes no namespaced constant.
            _ => false,
        }
    }

    /// Whether `class` names the class being declared, whose earlier constants PHP substitutes.
    fn is_declaring_class(&self, class: &Name<'_, '_>) -> bool {
        let Some(scope) = self.parser.class_scope.as_ref() else {
            return false;
        };
        // A trait's `self` is only known when the trait is used.
        if matches!(class, Name::Simple { value, .. } if value.eq_ignore_ascii_case("self")) {
            return scope.self_name.is_some();
        }
        !scope.is_anonymous
            && self
                .parser
                .resolve_class_name(class)
                .eq_ignore_ascii_case(&scope.name)
    }

    fn require(
        &self,
        min: PhpVersion,
        feature: &'static str,
        span: Span,
    ) -> Result<(), ConstExprError> {
        if self.version < min {
            return Err(ConstExprError::Version(min, feature, span));
        }
        Ok(())
    }

    fn check(&self, expr: &Expr<'_, '_>) -> Result<(), ConstExprError> {
        use ConstExprError::Forbidden;
        match &expr.kind {
            ExprKind::Int(_)
            | ExprKind::Float(_)
            | ExprKind::String(_)
            | ExprKind::Bool(_)
            | ExprKind::Null
            | ExprKind::Nowdoc { .. }
            | ExprKind::MagicConst(_)
            | ExprKind::Name(_)
            | ExprKind::Identifier(_)
            | ExprKind::Omit
            | ExprKind::Error => Ok(()),
            ExprKind::Heredoc { parts, .. } if is_literal_parts(parts) => Ok(()),
            ExprKind::Parenthesized(inner) => self.check(inner),
            ExprKind::UnaryPrefix(u)
                if !matches!(
                    u.op,
                    UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
                ) =>
            {
                self.check(u.operand)
            }
            ExprKind::Binary(b) if !matches!(b.op, BinaryOp::Instanceof | BinaryOp::Pipe) => {
                self.check(b.left)?;
                // PHP folds `false && $x` before checking, dropping the right operand.
                let folded_away = match (b.op, const_truth(b.left, self.version)) {
                    (BinaryOp::BooleanAnd | BinaryOp::LogicalAnd, Some(truth)) => !truth,
                    (BinaryOp::BooleanOr | BinaryOp::LogicalOr, Some(truth)) => truth,
                    (
                        BinaryOp::BooleanAnd
                        | BinaryOp::BooleanOr
                        | BinaryOp::LogicalAnd
                        | BinaryOp::LogicalOr,
                        None,
                    ) => self.may_fold(b.left),
                    _ => false,
                };
                if folded_away {
                    return Ok(());
                }
                self.check(b.right)
            }
            ExprKind::Ternary(t) => {
                self.check(t.condition)?;
                match const_truth(t.condition, self.version) {
                    Some(true) => t
                        .then_expr
                        .map_or(Ok(()), |then_expr| self.check(then_expr)),
                    Some(false) => self.check(t.else_expr),
                    None if self.may_fold(t.condition) => Ok(()),
                    None => {
                        if let Some(then_expr) = t.then_expr {
                            self.check(then_expr)?;
                        }
                        self.check(t.else_expr)
                    }
                }
            }
            ExprKind::NullCoalesce(n) => {
                self.check(n.left)?;
                let left_is_null = matches!(unparenthesized(n.left).kind, ExprKind::Null);
                if !left_is_null && self.may_fold(n.left) {
                    return Ok(());
                }
                self.check(n.right)
            }
            ExprKind::Array(elements) => {
                for el in elements.iter() {
                    if el.is_by_ref() {
                        return Err(Forbidden(INVALID_CONST_EXPR, el.span));
                    }
                    if let Some(key) = &el.key {
                        self.check(key)?;
                    }
                    self.check(el.value())?;
                }
                Ok(())
            }
            ExprKind::ArrayAccess(a) => {
                self.check(a.array)?;
                // `[]` reads are reported on their own.
                match a.index {
                    Some(index) => self.check(index),
                    None => Ok(()),
                }
            }
            ExprKind::Cast(kind, inner) => match kind {
                // Reported on their own wherever they appear.
                CastKind::Unset | CastKind::Void => Ok(()),
                _ => {
                    self.require(
                        PhpVersion::Php85,
                        "casts in constant expressions",
                        expr.span,
                    )?;
                    if *kind == CastKind::Object && !self.allow_new {
                        return Err(Forbidden(
                            "Object casts are not supported in this context",
                            expr.span,
                        ));
                    }
                    self.check(inner)
                }
            },
            ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => {
                self.require(
                    PhpVersion::Php82,
                    "property fetch in constant expressions",
                    expr.span,
                )?;
                self.check(p.object)?;
                self.check(p.property)
            }
            ExprKind::ClassConstAccess(access) => {
                let class = access.class;
                let is_class_name = matches!(&access.member.kind, ExprKind::Identifier(name) if name.eq_ignore_ascii_case("class"));
                if !is_class_name {
                    return self.class_const_class(class);
                }
                // `static::class` and, before PHP 8.0, any other expression are reported elsewhere.
                if matches!(class.kind, ExprKind::Name(_)) || self.version < PhpVersion::Php80 {
                    return Ok(());
                }
                match &unparenthesized(class).kind {
                    // The `::class` checks of every expression report a literal that is no string.
                    ExprKind::Int(_)
                    | ExprKind::Float(_)
                    | ExprKind::String(_)
                    | ExprKind::Bool(_)
                    | ExprKind::Null
                    | ExprKind::Nowdoc { .. }
                    | ExprKind::Array(_) => Ok(()),
                    ExprKind::Heredoc { parts, .. } if is_literal_parts(parts) => Ok(()),
                    // From PHP 8.2 a concatenation of literals is folded before the check.
                    ExprKind::Binary(b)
                        if b.op == BinaryOp::Concat
                            && self.version >= PhpVersion::Php82
                            && is_literal(class) =>
                    {
                        Ok(())
                    }
                    _ => Err(Forbidden(
                        "(expression)::class cannot be used in constant expressions",
                        expr.span,
                    )),
                }
            }
            ExprKind::ClassConstAccessDynamic { class, member } => {
                self.class_const_class(class)?;
                self.check(member)
            }
            ExprKind::New(new) => {
                if !self.allow_new {
                    return Err(Forbidden(
                        "New expressions are not supported in this context",
                        expr.span,
                    ));
                }
                self.require(PhpVersion::Php81, "new in initializers", expr.span)?;
                let class = new.class;
                match &class.kind {
                    ExprKind::Name(name) if is_static_name(name) => {
                        return Err(Forbidden(
                            "\"static\" is not allowed in compile-time constants",
                            class.span,
                        ))
                    }
                    ExprKind::Name(_) => {}
                    ExprKind::AnonymousClass(_) => {
                        return Err(Forbidden(
                            "Cannot use anonymous class in constant expression",
                            class.span,
                        ))
                    }
                    _ if self.may_fold(class) => {}
                    _ => {
                        return Err(Forbidden(
                            "Cannot use dynamic class name in constant expression",
                            class.span,
                        ))
                    }
                }
                for arg in new.args.iter() {
                    if arg.is_spread() {
                        return Err(Forbidden(
                            "Argument unpacking in constant expressions is not supported",
                            arg.span,
                        ));
                    }
                    if let Some(value) = arg.value() {
                        self.check(value)?;
                    }
                }
                Ok(())
            }
            // The body is not part of the expression; parameter defaults are checked on their own.
            ExprKind::Closure(closure) => {
                self.require(
                    PhpVersion::Php85,
                    "closures in constant expressions",
                    expr.span,
                )?;
                if !closure.is_static {
                    return Err(Forbidden(
                        "Closures in constant expressions must be static",
                        expr.span,
                    ));
                }
                if !closure.use_vars.is_empty() {
                    return Err(Forbidden(
                        "Cannot use(...) variables in constant expression",
                        expr.span,
                    ));
                }
                Ok(())
            }
            ExprKind::CallableCreate(cc) => {
                self.require(
                    PhpVersion::Php85,
                    "first-class callables in constant expressions",
                    expr.span,
                )?;
                match &cc.kind {
                    CallableCreateKind::Function(name) => self.callable_function(name),
                    CallableCreateKind::StaticMethod { class, method } => {
                        self.callable_static_method(class, method)
                    }
                    _ => Err(Forbidden(INVALID_CONST_EXPR, expr.span)),
                }
            }
            // PHP 8.6 partial function application.
            ExprKind::FunctionCall(call)
                if self.version >= PhpVersion::Php86
                    && call.args.iter().any(Arg::is_placeholder) =>
            {
                self.callable_function(call.name)?;
                self.partial_args(&call.args)
            }
            ExprKind::StaticMethodCall(call)
                if self.version >= PhpVersion::Php86
                    && call.args.iter().any(Arg::is_placeholder) =>
            {
                self.callable_static_method(call.class, call.method)?;
                self.partial_args(&call.args)
            }
            _ => Err(Forbidden(INVALID_CONST_EXPR, expr.span)),
        }
    }

    /// The function a constant expression makes a closure of.
    fn callable_function(&self, name: &Expr<'_, '_>) -> Result<(), ConstExprError> {
        // PHP takes a name or a literal, which the parser joins when concatenated; a name in
        // parentheses is a constant.
        if matches!(name.kind, ExprKind::Name(_)) {
            return Ok(());
        }
        let name = unparenthesized(name);
        match &name.kind {
            ExprKind::String(_) | ExprKind::Nowdoc { .. } => Ok(()),
            ExprKind::Heredoc { parts, .. } if is_literal_parts(parts) => Ok(()),
            _ if folded_value::is_literal_concat(name) => Ok(()),
            ExprKind::Int(_) | ExprKind::Float(_) => Err(ConstExprError::Forbidden(
                "Illegal function name",
                name.span,
            )),
            _ => Err(ConstExprError::Forbidden(
                "Cannot use dynamic function name in constant expression",
                name.span,
            )),
        }
    }

    /// The static method a constant expression makes a closure of.
    fn callable_static_method(
        &self,
        class: &Expr<'_, '_>,
        method: &Expr<'_, '_>,
    ) -> Result<(), ConstExprError> {
        match &class.kind {
            ExprKind::Name(name) if is_static_name(name) => {
                return Err(ConstExprError::Forbidden(
                    "\"static\" is not allowed in compile-time constants",
                    class.span,
                ))
            }
            ExprKind::Name(_) => {}
            _ if self.may_fold(class) => {}
            _ => {
                return Err(ConstExprError::Forbidden(
                    "Cannot use dynamic class name in constant expression",
                    class.span,
                ))
            }
        }
        if matches!(method.kind, ExprKind::Identifier(_)) || is_literal(method) {
            Ok(())
        } else {
            Err(ConstExprError::Forbidden(
                "Cannot use dynamic method name in constant expression",
                method.span,
            ))
        }
    }

    /// The arguments of a partial application in a constant expression.
    fn partial_args(&self, args: &[Arg<'_, '_>]) -> Result<(), ConstExprError> {
        for arg in args {
            match &arg.kind {
                ArgKind::Value(value) => self.check(value)?,
                ArgKind::Placeholder | ArgKind::SpreadPlaceholder => {}
                ArgKind::Spread(_) => {
                    return Err(ConstExprError::Forbidden(
                        "Argument unpacking in constant expressions is not supported",
                        arg.span,
                    ))
                }
                _ => return Err(ConstExprError::Forbidden(INVALID_CONST_EXPR, arg.span)),
            }
        }
        Ok(())
    }

    /// The class of `X::C` or `X::{expr}`.
    fn class_const_class(&self, class: &Expr<'_, '_>) -> Result<(), ConstExprError> {
        match &class.kind {
            ExprKind::Name(name) if is_static_name(name) => Err(ConstExprError::Forbidden(
                "\"static::\" is not allowed in compile-time constants",
                class.span,
            )),
            ExprKind::Name(_) => Ok(()),
            _ if self.may_fold(class) => Ok(()),
            _ => Err(ConstExprError::Forbidden(
                "Dynamic class names are not allowed in compile-time class constant references",
                class.span,
            )),
        }
    }
}

fn is_class_keyword_name(name: &Name<'_, '_>) -> bool {
    matches!(name, Name::Simple { value, .. }
        if ["self", "parent", "static"].iter().any(|k| value.eq_ignore_ascii_case(k)))
}

/// Whether PHP may fold `expr` outside a constant expression, which decides a short-circuit alone.
fn may_fold_at_runtime(parser: &Parser<'_, '_>, expr: &Expr<'_, '_>) -> bool {
    let checker = ConstExprChecker {
        parser,
        version: parser.version,
        allow_new: false,
        substitutes_constants: true,
    };
    if checker.may_fold(expr) {
        return !is_unresolved_class_keyword_fetch(parser, expr);
    }
    let operand = |e: &Expr<'_, '_>| may_fold_at_runtime(parser, e);
    match &unparenthesized(expr).kind {
        // PHP compiles `print` to the constant 1, and `@` keeps a constant operand.
        ExprKind::Print(_) => true,
        ExprKind::ErrorSuppress(inner) => operand(inner),
        ExprKind::UnaryPrefix(u) => match u.op {
            UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement => false,
            UnaryPrefixOp::BooleanNot
                if parser.version >= PhpVersion::Php85
                    && matches!(literal_scalar(u.operand), Some(Scalar::Float(_))) =>
            {
                false
            }
            _ => operand(u.operand),
        },
        // A literal is never an object.
        ExprKind::Binary(b) if b.op == BinaryOp::Instanceof => operand(b.left),
        ExprKind::Binary(b) if is_short_circuit(b.op) => {
            let decides = |truth: bool| match b.op {
                BinaryOp::BooleanAnd | BinaryOp::LogicalAnd => !truth,
                _ => truth,
            };
            match const_truth(b.left, parser.version) {
                Some(truth) => decides(truth) || operand(b.right),
                None => operand(b.left),
            }
        }
        ExprKind::Binary(b) if b.op != BinaryOp::Pipe => operand(b.left) && operand(b.right),
        _ => false,
    }
}

/// Whether `expr` is a possibly negated class keyword fetch PHP never resolves at compile time.
fn is_unresolved_class_keyword_fetch(parser: &Parser<'_, '_>, expr: &Expr<'_, '_>) -> bool {
    match &unparenthesized(expr).kind {
        ExprKind::UnaryPrefix(u) if u.op == UnaryPrefixOp::BooleanNot => {
            is_unresolved_class_keyword_fetch(parser, u.operand)
        }
        ExprKind::ClassConstAccess(access) => matches!(&access.class.kind,
            ExprKind::Name(name) if is_class_keyword_name(name)
                && (is_static_name(name) || parser.class_scope.is_none())),
        _ => false,
    }
}

fn is_static_name(name: &Name<'_, '_>) -> bool {
    matches!(name, Name::Simple { value, .. } if value.eq_ignore_ascii_case("static"))
}

fn is_literal_parts(parts: &[StringPart<'_, '_>]) -> bool {
    parts
        .iter()
        .all(|part| matches!(part, StringPart::Literal(_)))
}

/// Whether `expr` is built from literals only, which PHP always folds at compile time.
fn is_literal(expr: &Expr<'_, '_>) -> bool {
    foldable(expr, None)
}

fn unparenthesized<'e, 'arena, 'src>(mut expr: &'e Expr<'arena, 'src>) -> &'e Expr<'arena, 'src> {
    while let ExprKind::Parenthesized(inner) = &expr.kind {
        expr = inner;
    }
    expr
}

fn is_short_circuit(op: BinaryOp) -> bool {
    matches!(
        op,
        BinaryOp::BooleanAnd | BinaryOp::BooleanOr | BinaryOp::LogicalAnd | BinaryOp::LogicalOr
    )
}

/// [`folded_truth`], also folding the arithmetic and concatenation of literals.
fn const_truth(expr: &Expr<'_, '_>, version: PhpVersion) -> Option<bool> {
    folded_truth(expr, version).or_else(|| match literal_scalar(expr)? {
        Scalar::Int(n) => Some(n != 0),
        Scalar::Float(f) => Some(f != 0.0),
        Scalar::String(s) => Some(!matches!(s.as_slice(), b"" | b"0")),
    })
}

enum Scalar {
    Int(i64),
    Float(f64),
    String(Vec<u8>),
}

/// The value of a literal number, string, or `+`, `-`, `*` or `.` of them; `None` otherwise.
fn literal_scalar(expr: &Expr<'_, '_>) -> Option<Scalar> {
    let number = |s: Scalar| match s {
        Scalar::Int(n) => Some(n as f64),
        Scalar::Float(f) => Some(f),
        Scalar::String(_) => None,
    };
    let expr = unparenthesized(expr);
    Some(match &expr.kind {
        ExprKind::Int(n) => Scalar::Int(*n),
        ExprKind::Float(f) => Scalar::Float(*f),
        ExprKind::String(s) => Scalar::String(s.as_bytes().to_vec()),
        ExprKind::Nowdoc { value, .. } => Scalar::String(value.as_bytes().to_vec()),
        ExprKind::UnaryPrefix(u) => match (u.op, literal_scalar(u.operand)?) {
            (UnaryPrefixOp::Plus, n @ (Scalar::Int(_) | Scalar::Float(_))) => n,
            (UnaryPrefixOp::Negate, Scalar::Int(n)) => Scalar::Int(n.checked_neg()?),
            (UnaryPrefixOp::Negate, Scalar::Float(f)) => Scalar::Float(-f),
            _ => return None,
        },
        ExprKind::Binary(b) => {
            let (left, right) = (literal_scalar(b.left)?, literal_scalar(b.right)?);
            match (b.op, left, right) {
                (BinaryOp::Concat, Scalar::String(mut l), Scalar::String(r)) => {
                    l.extend_from_slice(&r);
                    Scalar::String(l)
                }
                (BinaryOp::Add, Scalar::Int(l), Scalar::Int(r)) => Scalar::Int(l.checked_add(r)?),
                (BinaryOp::Sub, Scalar::Int(l), Scalar::Int(r)) => Scalar::Int(l.checked_sub(r)?),
                (BinaryOp::Mul, Scalar::Int(l), Scalar::Int(r)) => Scalar::Int(l.checked_mul(r)?),
                (op @ (BinaryOp::Add | BinaryOp::Sub | BinaryOp::Mul), l, r) => {
                    let (l, r) = (number(l)?, number(r)?);
                    Scalar::Float(match op {
                        BinaryOp::Add => l + r,
                        BinaryOp::Sub => l - r,
                        _ => l * r,
                    })
                }
                _ => return None,
            }
        }
        _ => return None,
    })
}

/// The truthiness PHP gives `expr` when it folds `?:`, `&&` and `||` at compile time.
fn folded_truth(expr: &Expr<'_, '_>, version: PhpVersion) -> Option<bool> {
    let expr = unparenthesized(expr);
    match &expr.kind {
        ExprKind::Int(n) => Some(*n != 0),
        ExprKind::Float(f) => Some(*f != 0.0),
        ExprKind::String(s) => Some(!matches!(s.as_bytes(), b"" | b"0")),
        ExprKind::Nowdoc { value, .. } => Some(!matches!(*value, "" | "0")),
        ExprKind::Bool(b) => Some(*b),
        ExprKind::Null => Some(false),
        // PHP compiles `print` to the constant 1, and `exit` to true until it is a function in 8.4.
        ExprKind::Print(_) => Some(true),
        ExprKind::Exit(_) if version < PhpVersion::Php84 => Some(true),
        // PHP compiles `empty()` of a non-variable as `!`.
        ExprKind::Empty(operand) => folded_not(operand, version),
        // A literal is never an object.
        ExprKind::Binary(b)
            if b.op == BinaryOp::Instanceof && const_truth(b.left, version).is_some() =>
        {
            Some(false)
        }
        ExprKind::UnaryPrefix(u) if u.op == UnaryPrefixOp::BooleanNot => {
            folded_not(u.operand, version)
        }
        ExprKind::Array(elements) if is_literal(expr) => {
            let mut truth = false;
            for el in elements.iter() {
                match &el.kind {
                    ArrayElementKind::Spread(inner) => truth |= folded_truth(inner, version)?,
                    _ => return Some(true),
                }
            }
            Some(truth)
        }
        // `A::class` is resolved at compile time unless it names `self`, `parent` or `static`.
        ExprKind::ClassConstAccess(access) => {
            let resolved = matches!(&access.member.kind, ExprKind::Identifier(m) if m.eq_ignore_ascii_case("class"))
                && matches!(&access.class.kind, ExprKind::Name(name) if !is_class_keyword_name(name));
            resolved.then_some(true)
        }
        ExprKind::Binary(b) if is_short_circuit(b.op) => {
            // Walk the left spine iteratively: chains are built in a loop and can be very long.
            let mut spine = vec![b];
            while let ExprKind::Binary(inner) = &unparenthesized(spine[spine.len() - 1].left).kind {
                if !is_short_circuit(inner.op) {
                    break;
                }
                spine.push(inner);
            }
            let mut truth = const_truth(spine[spine.len() - 1].left, version)?;
            for link in spine.iter().rev() {
                let decided = match link.op {
                    BinaryOp::BooleanAnd | BinaryOp::LogicalAnd => !truth,
                    _ => truth,
                };
                if !decided {
                    truth = const_truth(link.right, version)?;
                }
            }
            Some(truth)
        }
        _ => None,
    }
}

/// The truthiness PHP folds `!operand` to.
fn folded_not(operand: &Expr<'_, '_>, version: PhpVersion) -> Option<bool> {
    // PHP 8.5 leaves `!` on a float to run time, where a NAN warns.
    if version >= PhpVersion::Php85 && matches!(literal_scalar(operand), Some(Scalar::Float(_))) {
        return None;
    }
    const_truth(operand, version).map(|truth| !truth)
}

/// Whether PHP folds `expr` from literals, or with `constants` also the names it may substitute.
fn foldable(expr: &Expr<'_, '_>, constants: Option<&ConstExprChecker<'_, '_, '_>>) -> bool {
    let operand = |e: &Expr<'_, '_>| foldable(e, constants);
    match &expr.kind {
        ExprKind::Int(_)
        | ExprKind::Float(_)
        | ExprKind::String(_)
        | ExprKind::Bool(_)
        | ExprKind::Null
        | ExprKind::Nowdoc { .. } => true,
        ExprKind::Heredoc { parts, .. } => is_literal_parts(parts),
        // A trait's `__CLASS__` is the class that uses it.
        ExprKind::MagicConst(MagicConstKind::Class) => constants.is_some_and(|c| {
            c.parser
                .class_scope
                .as_ref()
                .is_none_or(|scope| scope.self_name.is_some() || scope.is_anonymous)
        }),
        ExprKind::MagicConst(_) => constants.is_some(),
        ExprKind::Name(name) => constants.is_some_and(|c| c.may_be_internal_constant(name)),
        ExprKind::ClassConstAccess(access) => constants.is_some_and(|c| {
            let ExprKind::Name(class) = &access.class.kind else {
                return false;
            };
            match &access.member.kind {
                ExprKind::Identifier(m) if m.eq_ignore_ascii_case("class") => {
                    !is_static_name(class)
                }
                ExprKind::Identifier(_) => c.substitutes_constants && c.is_declaring_class(class),
                _ => false,
            }
        }),
        ExprKind::Parenthesized(inner) => operand(inner),
        ExprKind::UnaryPrefix(u)
            if u.op == UnaryPrefixOp::BooleanNot
                && constants.is_some_and(|c| c.version >= PhpVersion::Php85)
                && matches!(literal_scalar(u.operand), Some(Scalar::Float(_))) =>
        {
            false
        }
        ExprKind::UnaryPrefix(u) => {
            !matches!(
                u.op,
                UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement
            ) && operand(u.operand)
        }
        ExprKind::Binary(b) => {
            !matches!(b.op, BinaryOp::Instanceof | BinaryOp::Pipe)
                && operand(b.left)
                && operand(b.right)
        }
        ExprKind::Ternary(t) => {
            operand(t.condition) && t.then_expr.is_none_or(operand) && operand(t.else_expr)
        }
        ExprKind::NullCoalesce(n) => operand(n.left) && operand(n.right),
        ExprKind::Array(elements) => elements.iter().all(|el| {
            !el.is_by_ref() && el.key.as_ref().is_none_or(operand) && operand(el.value())
        }),
        ExprKind::ArrayAccess(a) => operand(a.array) && a.index.is_some_and(operand),
        _ => false,
    }
}

/// Report PHP's compile errors for the destructuring list `target` and its nested lists.
pub(crate) fn check_list_entries(parser: &mut Parser<'_, '_>, target: &Expr<'_, '_>) {
    let ExprKind::Array(elems) = &target.kind else {
        return;
    };
    if elems
        .iter()
        .all(|el| matches!(el.value().kind, ExprKind::Omit))
    {
        parser.forbid(
            ForbiddenRule::EmptyList,
            "Cannot use empty list",
            target.span,
        );
        return;
    }
    // PHP takes the list's style from its first non-empty entry and stops at the first mismatch.
    let is_keyed = elems
        .iter()
        .find(|el| !matches!(el.value().kind, ExprKind::Omit))
        .is_some_and(|el| el.key.is_some());
    for el in elems.iter() {
        if matches!(el.value().kind, ExprKind::Omit) {
            if is_keyed {
                parser.forbid(
                    ForbiddenRule::EmptyKeyedArrayEntry,
                    "Cannot use empty array entries in keyed array assignment",
                    el.span,
                );
                return;
            }
            continue;
        }
        if el.is_spread() {
            return;
        }
        if el.key.is_some() != is_keyed {
            parser.forbid(
                ForbiddenRule::MixedKeyedEntries,
                "Cannot mix keyed and unkeyed array entries in assignments",
                el.span,
            );
            return;
        }
        check_list_entries(parser, el.value());
    }
}

/// True if the array-literal at `span` was written with `list(...)` syntax
/// rather than the short `[...]` form. Determined by the first source byte
/// at the span start.
fn is_list_syntax(source: &str, span: Span) -> bool {
    source
        .as_bytes()
        .get(span.start as usize)
        .map(|b| b.eq_ignore_ascii_case(&b'l'))
        .unwrap_or(false)
}

/// Walk the destructure target (top-level `Array(_)`) and report a nested `array()`
/// or a mix of `list(...)` and `[...]` syntax, stopping at the first, as PHP does.
pub(crate) fn check_mixed_list_short_syntax<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    lhs: &Expr<'arena, 'src>,
) {
    let ExprKind::Array(_) = lhs.kind else {
        return;
    };
    let outer_is_list = is_list_syntax(parser.source(), lhs.span);
    fn walk<'arena, 'src>(
        parser: &mut Parser<'arena, 'src>,
        expr: &Expr<'arena, 'src>,
        outer_is_list: bool,
    ) -> bool {
        let ExprKind::Array(elems) = &expr.kind else {
            return true;
        };
        for el in elems.iter() {
            let value = el.value();
            if matches!(value.kind, ExprKind::Array(_)) {
                let first = parser.source().as_bytes().get(value.span.start as usize);
                if first.is_some_and(|b| b.eq_ignore_ascii_case(&b'a')) {
                    parser.forbid(
                        ForbiddenRule::LongArrayInDestructuring,
                        "Cannot assign to array(), use [] instead",
                        value.span,
                    );
                    return false;
                }
                if is_list_syntax(parser.source(), value.span) != outer_is_list {
                    parser.forbid(
                        ForbiddenRule::MixedListSyntax,
                        "Cannot mix [] and list()",
                        value.span,
                    );
                    return false;
                }
            }
            if !walk(parser, value, outer_is_list) {
                return false;
            }
        }
        true
    }
    walk(parser, lhs, outer_is_list);
}

/// [`temporary_write_message`], also for a fetch from a call PHP compiles as a built-in, as in
/// `strlen($a)[0] = 1`.
fn write_message(
    parser: &Parser<'_, '_>,
    kind: &ExprKind<'_, '_>,
) -> Option<(ForbiddenRule, &'static str)> {
    temporary_write_message(kind, parser.version).or_else(|| {
        builtin_call_base(parser, kind, false).then_some((
            ForbiddenRule::BuiltinResultWrite,
            "Cannot use result of built-in function in write context",
        ))
    })
}

/// True if `kind` is a call PHP compiles as a built-in, or with `bare` false, a fetch from one.
fn builtin_call_base(parser: &Parser<'_, '_>, kind: &ExprKind<'_, '_>, bare: bool) -> bool {
    let mut cur = kind;
    let mut saw_access = bare;
    loop {
        match cur {
            ExprKind::ArrayAccess(a) => cur = &a.array.kind,
            ExprKind::PropertyAccess(p) => cur = &p.object.kind,
            ExprKind::Parenthesized(inner) => {
                cur = &inner.kind;
                continue;
            }
            ExprKind::FunctionCall(call) => {
                return saw_access && special_calls::is_special_builtin_call(parser, call)
            }
            _ => return false,
        }
        saw_access = true;
    }
}

/// True if `kind` is an index or property fetch chain whose base is not a variable or a
/// call, such as `[0, 1][0]`, `FOO->a` or `(new A)->b`. PHP rejects writes to these with
/// "Cannot use temporary expression in write context"; for `f(...)` bases, and `clone $a`
/// from 8.5, the message is "Cannot use result of built-in function in write context".
fn temporary_write_message(
    kind: &ExprKind<'_, '_>,
    version: PhpVersion,
) -> Option<(ForbiddenRule, &'static str)> {
    let mut cur = kind;
    let mut saw_access = false;
    let mut saw_property = false;
    loop {
        match cur {
            ExprKind::ArrayAccess(a) => {
                saw_access = true;
                cur = &a.array.kind;
            }
            ExprKind::PropertyAccess(p) => {
                saw_access = true;
                saw_property = true;
                cur = &p.object.kind;
            }
            // Reported as a nullsafe write instead.
            ExprKind::NullsafePropertyAccess(_) => return None,
            ExprKind::Parenthesized(inner) => cur = &inner.kind,
            _ => break,
        }
    }
    if !saw_access {
        return None;
    }
    // From 8.6 PHP fetches a constant's object to write one of its properties.
    let constant = match cur {
        ExprKind::Name(_) | ExprKind::Bool(_) | ExprKind::Null => true,
        ExprKind::ClassConstAccess(access) => !matches!(
            &access.member.kind,
            ExprKind::Identifier(m) if m.eq_ignore_ascii_case("class")
        ),
        ExprKind::ClassConstAccessDynamic { .. } => true,
        _ => false,
    };
    if constant && saw_property && version >= PhpVersion::Php86 {
        return None;
    }
    match cur {
        // Before 8.5 `clone` is an expression, not a function call.
        ExprKind::Clone(_) if version < PhpVersion::Php85 => Some((
            ForbiddenRule::TemporaryExpressionWrite,
            "Cannot use temporary expression in write context",
        )),
        ExprKind::Clone(_) | ExprKind::CallableCreate(_) => Some((
            ForbiddenRule::BuiltinResultWrite,
            "Cannot use result of built-in function in write context",
        )),
        ExprKind::Variable(_)
        | ExprKind::VariableVariable(_)
        | ExprKind::StaticPropertyAccess(_)
        | ExprKind::StaticPropertyAccessDynamic { .. }
        | ExprKind::FunctionCall(_)
        | ExprKind::MethodCall(_)
        | ExprKind::NullsafeMethodCall(_)
        | ExprKind::StaticMethodCall(_)
        | ExprKind::StaticMethodCallDynamic(_)
        | ExprKind::CloneWith(..)
        | ExprKind::Error => None,
        // From 8.6 PHP compiles a pipe as the call it makes.
        ExprKind::Binary(b) if b.op == BinaryOp::Pipe && version >= PhpVersion::Php86 => None,
        _ => Some((
            ForbiddenRule::TemporaryExpressionWrite,
            "Cannot use temporary expression in write context",
        )),
    }
}

/// Parse an assignment operator and its RHS, treating `lhs` as the assignment target.
///
/// PHP grammar quirk: assignment operators bind tighter than prefix unary operators,
/// the `??` right operand, `@`, and casts. For example:
/// - `-$x += 1`       parses as `-(($x += 1))`,   not `(-$x) += 1`
/// - `$a ?? $b = $c`  parses as `$a ?? ($b = $c)`, not `($a ?? $b) = $c`
/// - `@$a = 1`        parses as `@($a = 1)`,       not `(@$a) = 1`
///
/// **Deliberate deviation from standard Pratt semantics**: this function is called
/// *after* `parse_expr_bp` returns, meaning it consumes the assignment regardless of
/// whatever `min_bp` the surrounding context passed to `parse_expr_bp`. This is
/// intentional: PHP's grammar allows assignment to "escape" prefix unary / `??` / `@`
/// / ternary-else context. Callers must opt-in via an explicit
/// `if parser.current_kind().is_assignment_op()` guard rather than relying on `min_bp`
/// to block it.
fn parse_assign_continuation<'arena, 'src>(
    parser: &mut Parser<'arena, 'src>,
    lhs: Expr<'arena, 'src>,
) -> Expr<'arena, 'src> {
    debug_assert!(parser.current_kind().is_assignment_op());
    let span = parser.current_span();
    let is_plain_assign = parser.current_kind() == TokenKind::Equals;
    if is_plain_assign {
        unfold_curly_offsets(parser, &lhs);
    }
    // PHP rejects pre/post-increment/decrement as an assignment target at parse time.
    if matches!(
        lhs.kind,
        ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: UnaryPrefixOp::PreIncrement | UnaryPrefixOp::PreDecrement,
            ..
        }) | ExprKind::UnaryPostfix(UnaryPostfixExpr {
            op: UnaryPostfixOp::PostIncrement | UnaryPostfixOp::PostDecrement,
            ..
        })
    ) {
        parser.forbid(
            ForbiddenRule::IncDecAsAssignTarget,
            "Cannot use increment/decrement as an assignment target.",
            span,
        );
    } else if let Some((rule, message)) = write_message(parser, &lhs.kind) {
        parser.forbid(rule, message, lhs.span);
    } else if matches!(lhs.kind, ExprKind::Array(_)) && !is_plain_assign {
        parser.forbid(
            ForbiddenRule::CompoundAssignToDestructuring,
            "Cannot use a destructuring pattern with a compound assignment operator",
            span,
        );
    } else if let Some(message) = call_result_write_message(&lhs.kind) {
        parser.forbid(ForbiddenRule::CallResultWrite, message, lhs.span);
    } else if !is_valid_assignment_target(&lhs.kind) {
        parser.forbid(
            ForbiddenRule::InvalidAssignTarget,
            "Cannot use expression as assignment target.",
            span,
        );
    } else if has_nullsafe_link(&lhs.kind) {
        parser.forbid(
            ForbiddenRule::NullsafeWrite,
            "Can't use nullsafe operator in write context",
            lhs.span,
        );
    }
    if let ExprKind::Array(elems) = &lhs.kind {
        // This array is a destructuring target, so empty slots are legal here —
        // retract the eager "empty array element" errors emitted while parsing it.
        parser.retract_destructuring_errors_within(lhs.span);
        if is_plain_assign {
            check_list_entries(parser, &lhs);
            check_destructure_elements(parser, elems);
        }
    }
    check_mixed_list_short_syntax(parser, &lhs);
    let op_token = parser.advance();
    let write_kind = if matches!(op_token.kind, TokenKind::Equals | TokenKind::CoalesceEquals) {
        WriteKind::Assign
    } else {
        WriteKind::Modify
    };
    check_special_variable_write(parser, &lhs, write_kind);
    let by_ref_span = parser.current_span();
    let by_ref = op_token.kind == TokenKind::Equals && parser.eat(TokenKind::Ampersand).is_some();
    if by_ref && matches!(lhs.kind, ExprKind::Array(_)) {
        parser.forbid(
            ForbiddenRule::ReferenceAssignToDestructuring,
            "Cannot assign by reference to a destructuring pattern",
            by_ref_span,
        );
    }
    let op = match op_token.kind {
        TokenKind::Equals => AssignOp::Assign,
        TokenKind::PlusEquals => AssignOp::Plus,
        TokenKind::MinusEquals => AssignOp::Minus,
        TokenKind::StarEquals => AssignOp::Mul,
        TokenKind::SlashEquals => AssignOp::Div,
        TokenKind::PercentEquals => AssignOp::Mod,
        TokenKind::StarStarEquals => AssignOp::Pow,
        TokenKind::DotEquals => AssignOp::Concat,
        TokenKind::AmpersandEquals => AssignOp::BitwiseAnd,
        TokenKind::PipeEquals => AssignOp::BitwiseOr,
        TokenKind::CaretEquals => AssignOp::BitwiseXor,
        TokenKind::ShiftLeftEquals => AssignOp::ShiftLeft,
        TokenKind::ShiftRightEquals => AssignOp::ShiftRight,
        TokenKind::CoalesceEquals => AssignOp::Coalesce,
        _ => unreachable!(
            "is_assignment_op() guarantees one of the listed variants, got {:?}",
            op_token.kind
        ),
    };
    // `&` takes a single variable, so `$a = &$b + 1` is `($a = &$b) + 1`.
    let rhs = parse_expr_bp(
        parser,
        if by_ref {
            MEMBER_ACCESS_BP
        } else {
            ASSIGNMENT_BP
        },
    );
    if by_ref && matches!(rhs.kind, ExprKind::New(..)) {
        parser.forbid(
            ForbiddenRule::ReferenceAssignNew,
            "Cannot use by-reference assignment with 'new' expression",
            rhs.span,
        );
    } else if by_ref && has_nullsafe_link(&rhs.kind) {
        parser.forbid(
            ForbiddenRule::ReferenceToNullsafe,
            "Cannot take reference of a nullsafe chain",
            rhs.span,
        );
    } else if by_ref && matches!(rhs.kind, ExprKind::Parenthesized(_)) {
        parser.forbid(
            ForbiddenRule::ReferenceToParenthesized,
            "Cannot take reference of a parenthesized expression",
            rhs.span,
        );
    } else if by_ref && !is_variable_or_call(&rhs.kind) {
        parser.forbid(
            ForbiddenRule::ReferenceToNonReferenceable,
            "Cannot assign reference to non referenceable value",
            rhs.span,
        );
    } else if by_ref
        && (matches!(rhs.kind, ExprKind::CallableCreate(_))
            || builtin_call_base(parser, &rhs.kind, true))
    {
        parser.forbid(
            ForbiddenRule::BuiltinResultWrite,
            "Cannot use result of built-in function in write context",
            rhs.span,
        );
    } else if let Some((rule, message)) = by_ref.then(|| write_message(parser, &rhs.kind)).flatten()
    {
        parser.forbid(rule, message, rhs.span);
    } else if by_ref {
        check_special_variable_write(parser, &rhs, WriteKind::Reference);
    } else if op == AssignOp::Assign && has_reference_element(&lhs.kind) {
        let mut source = &rhs.kind;
        while let ExprKind::Parenthesized(inner) = source {
            source = &inner.kind;
        }
        // PHP checks a nullsafe source of a by-reference destructuring from 8.1.
        let error = if parser.version >= PhpVersion::Php81 && has_nullsafe_link(source) {
            Some((
                ForbiddenRule::ReferenceToNullsafe,
                "Cannot take reference of a nullsafe chain",
            ))
        } else if !is_variable_or_call(source) {
            Some((
                ForbiddenRule::ReferenceToNonReferenceable,
                "Cannot assign reference to non referenceable value",
            ))
        } else {
            None
        };
        if let Some((rule, message)) = error {
            parser.forbid(rule, message, rhs.span);
        }
    }
    let span = lhs.span.merge(rhs.span);
    Expr {
        kind: ExprKind::Assign(AssignExpr {
            target: parser.alloc(lhs),
            op,
            value: parser.alloc(rhs),
            by_ref,
        }),
        span,
    }
}

/// Parse an expression.
pub fn parse_expr<'arena, 'src>(parser: &'_ mut Parser<'arena, 'src>) -> Expr<'arena, 'src> {
    instrument::record_parse_expr();
    parse_expr_bp(parser, 0)
}

/// Pratt expression parser. Parses expressions with binding power >= min_bp.
pub fn parse_expr_bp<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    min_bp: u8,
) -> Expr<'arena, 'src> {
    if min_bp != 0 {
        instrument::record_parse_expr_bp_recursive();
    }
    if !parser.enter_nesting() {
        return Expr {
            kind: ExprKind::Error,
            span: parser.missing_span(),
        };
    }
    let lhs = parse_atom(parser);
    parse_expr_rest(parser, lhs, min_bp)
}

/// Continue an expression whose first operand `lhs` is already parsed.
pub(crate) fn parse_expr_continue<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    lhs: Expr<'arena, 'src>,
    min_bp: u8,
) -> Expr<'arena, 'src> {
    if !parser.enter_nesting() {
        return Expr {
            kind: ExprKind::Error,
            span: parser.missing_span(),
        };
    }
    parse_expr_rest(parser, lhs, min_bp)
}

fn parse_expr_rest<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
    mut lhs: Expr<'arena, 'src>,
    min_bp: u8,
) -> Expr<'arena, 'src> {
    // The folded truth of the last `&&`/`||` built here, so a long chain is not re-walked per link.
    let mut chain_truth: Option<(Span, Option<bool>)> = None;
    loop {
        let kind = parser.current_kind();

        // Fast-path: Direct token kind dispatch for most-common operators.
        // Compiler converts this to jump table (O(1)) instead of sequential branches.
        // This groups direct token comparisons that were scattered across if-statements.
        let should_continue = match kind {
            // Postfix operators (++, --)
            TokenKind::PlusPlus | TokenKind::MinusMinus => {
                if let Some(left_bp) = precedence::postfix_binding_power(kind) {
                    if left_bp < min_bp {
                        break;
                    }
                    let op_token = parser.advance();
                    let op = match op_token.kind {
                        TokenKind::PlusPlus => UnaryPostfixOp::PostIncrement,
                        TokenKind::MinusMinus => UnaryPostfixOp::PostDecrement,
                        _ => unreachable!(
                            "outer arm already matched PlusPlus/MinusMinus, got {:?}",
                            op_token.kind
                        ),
                    };
                    check_increment_operand(parser, &lhs);
                    let span = lhs.span.merge(op_token.span);
                    lhs = Expr {
                        kind: ExprKind::UnaryPostfix(UnaryPostfixExpr {
                            operand: parser.alloc(lhs),
                            op,
                        }),
                        span,
                    };
                    true
                } else {
                    false
                }
            }

            // Ternary operator (non-associative in PHP 8.0+)
            TokenKind::Question => {
                if TERNARY_BP < min_bp {
                    break;
                }
                // PHP 8.0+: unparenthesized `a ? b : c ? d : e` is a fatal parse error,
                // but chains of short ternaries (`a ?: b ?: c`) remain valid because `?:`
                // is left-associative and unambiguous.
                //
                // So: fire the error when LHS is an already-parsed ternary UNLESS both the
                // LHS ternary and the incoming ternary are short (then_expr=None and next
                // token after `?` is `:`).
                if parser.version >= PhpVersion::Php80 {
                    if let ExprKind::Ternary(lhs_tern) = &lhs.kind {
                        let lhs_is_short = lhs_tern.then_expr.is_none();
                        let incoming_is_short = parser.peek_kind() == Some(TokenKind::Colon);
                        if !(lhs_is_short && incoming_is_short) {
                            let span = parser.current_span();
                            parser.forbid(
                                ForbiddenRule::UnparenthesizedNestedTernary,
                                "Unparenthesized `a ? b : c ? d : e` is not supported. \
                                 Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)`",
                                span,
                            );
                        }
                    }
                }
                parser.advance(); // consume ?

                // Short ternary: `$x ?: $y`
                let then_expr = if parser.check(TokenKind::Colon) {
                    None
                } else {
                    let e = parse_expr_bp(parser, 0);
                    Some(parser.alloc(e))
                };

                parser.expect(TokenKind::Colon);
                // Non-associative in PHP 8.0+; use TERNARY_BP + 1 to prevent
                // the else branch from consuming another ternary at the same level.
                // PHP grammar quirk: assignment can still appear in the else branch.
                // e.g., $a ? $b : $c = $d  →  $a ? $b : ($c = $d)
                let mut else_expr = parse_expr_bp(parser, TERNARY_BP + 1);
                if parser.current_kind().is_assignment_op() {
                    else_expr = parse_assign_continuation(parser, else_expr);
                }
                let span = lhs.span.merge(else_expr.span);
                lhs = Expr {
                    kind: ExprKind::Ternary(TernaryExpr {
                        condition: parser.alloc(lhs),
                        then_expr,
                        else_expr: parser.alloc(else_expr),
                    }),
                    span,
                };
                true
            }

            // Arrow operators (property/method access)
            TokenKind::Arrow | TokenKind::NullsafeArrow => {
                if MEMBER_ACCESS_BP < min_bp {
                    break;
                }
                check_dereferencable(parser, &lhs, kind);
                allow_curly_base(parser, &lhs);
                let is_nullsafe = kind == TokenKind::NullsafeArrow;
                if is_nullsafe {
                    let span = parser.current_span();
                    parser.require_version(PhpVersion::Php80, "nullsafe operator (?->)", span);
                }
                parser.advance(); // consume -> or ?->

                // Parse member name (identifier or keyword or variable for dynamic)
                let braced = parser.check(TokenKind::LeftBrace);
                let member = parse_member_name(parser);

                // Check if it's a method call
                if parser.check(TokenKind::LeftParen) {
                    if braced {
                        check_method_name(parser, &member);
                    }
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker(_) => {
                            let span = parser.span_from(lhs.span.start);
                            let nullsafe_lhs = nullsafe_link(&lhs.kind, true);
                            if (is_nullsafe && !is_this(&lhs.kind)) || nullsafe_lhs {
                                parser.forbid(
                                    ForbiddenRule::NullsafeClosureCreation,
                                    "Cannot combine nullsafe operator with Closure creation",
                                    span,
                                );
                            }
                            let callable_kind = if is_nullsafe {
                                CallableCreateKind::NullsafeMethod {
                                    object: parser.alloc(lhs),
                                    method: parser.alloc(member),
                                }
                            } else {
                                CallableCreateKind::Method {
                                    object: parser.alloc(lhs),
                                    method: parser.alloc(member),
                                }
                            };
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: callable_kind,
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = parser.span_from(lhs.span.start);
                            let call = parser.alloc(MethodCallExpr {
                                object: parser.alloc(lhs),
                                method: parser.alloc(member),
                                args,
                            });
                            let expr_kind = if is_nullsafe {
                                ExprKind::NullsafeMethodCall(call)
                            } else {
                                ExprKind::MethodCall(call)
                            };
                            lhs = Expr {
                                kind: expr_kind,
                                span,
                            };
                        }
                    }
                } else {
                    // Ends after the `}` of `->{'x'}`, which the member's own span leaves out.
                    let span = parser.span_from(lhs.span.start);
                    let expr_kind = if is_nullsafe {
                        ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                            object: parser.alloc(lhs),
                            property: parser.alloc(member),
                        })
                    } else {
                        ExprKind::PropertyAccess(PropertyAccessExpr {
                            object: parser.alloc(lhs),
                            property: parser.alloc(member),
                        })
                    };
                    lhs = Expr {
                        kind: expr_kind,
                        span,
                    };
                }
                true
            }

            // Null coalescing operator (produces NullCoalesce node, not Binary)
            TokenKind::QuestionQuestion => {
                if NULL_COALESCE_LEFT_BP < min_bp {
                    break;
                }
                parser.advance();
                // PHP grammar quirk: the right operand of ?? can contain assignment but not
                // unparenthesized ternary.  Use TERNARY_BP + 1 to block ternary, then
                // explicitly consume any following assignment operator.
                // e.g. `$a ?? $b = $c`  →  `$a ?? ($b = $c)`
                // e.g. `$a ?? $b ? $c : $d`  →  `($a ?? $b) ? $c : $d`
                let mut rhs = parse_expr_bp(parser, TERNARY_BP + 1);
                if parser.current_kind().is_assignment_op() {
                    rhs = parse_assign_continuation(parser, rhs);
                }
                let span = lhs.span.merge(rhs.span);
                lhs = Expr {
                    kind: ExprKind::NullCoalesce(NullCoalesceExpr {
                        left: parser.alloc(lhs),
                        right: parser.alloc(rhs),
                    }),
                    span,
                };
                true
            }

            // Assignment operators (right-associative)
            _ if kind.is_assignment_op() => {
                if ASSIGNMENT_BP < min_bp {
                    break;
                }
                lhs = parse_assign_continuation(parser, lhs);
                true
            }

            _ => false,
        };

        if should_continue {
            continue;
        }

        // Double colon: Class::$prop, Class::method(), Class::CONST
        // bp=90: must parse through the bp=45 gate used by promoted-property defaults
        // (which only intends to block `{}` curly-brace subscript access, bp=44).
        if kind == TokenKind::DoubleColon {
            if SCOPE_RESOLUTION_BP < min_bp {
                break;
            }
            check_dereferencable(parser, &lhs, kind);
            parser.advance(); // consume ::
            if matches!(lhs.kind, ExprKind::Parenthesized(_) | ExprKind::Array(_)) {
                if parser.check(TokenKind::Class) {
                    check_class_name_fetch_literal(parser, &lhs);
                } else {
                    check_class_name_literal(parser, &lhs);
                }
            }

            // Check what follows ::
            if parser.check(TokenKind::Variable) {
                let token = parser.advance();
                let var_name = parser.variable_name(token);
                let var_span = token.span;

                if parser.check(TokenKind::LeftParen) {
                    // Dynamic static method call: Class::$method()
                    let method = parser.alloc(Expr {
                        kind: ExprKind::Variable(NameStr::from_source(var_name)),
                        span: var_span,
                    });
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker(_) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method,
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCallDynamic(parser.alloc(
                                    StaticMethodCallDynamicExpr {
                                        class: parser.alloc(lhs),
                                        method,
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Static property: Class::$prop
                    let member = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::from_source(var_name)),
                        span: var_span,
                    });
                    let span = Span::new(lhs.span.start, var_span.end);
                    lhs = Expr {
                        kind: ExprKind::StaticPropertyAccess(StaticAccessExpr {
                            class: parser.alloc(lhs),
                            member,
                        }),
                        span,
                    };
                }
            } else if parser.check(TokenKind::Dollar) {
                // Dynamic static property: A::$$b, A::${'b'}
                let member = atom::parse_atom_nested(parser);
                let span = Span::new(lhs.span.start, member.span.end);
                lhs = Expr {
                    kind: ExprKind::StaticPropertyAccessDynamic {
                        class: parser.alloc(lhs),
                        member: parser.alloc(member),
                    },
                    span,
                };
            } else if parser.check(TokenKind::LeftBrace) {
                // Dynamic class constant/method: A::{'b'}(), Foo::{bar()}
                let brace_span = parser.current_span();
                parser.advance(); // consume {
                let member = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                if parser.check(TokenKind::LeftParen) {
                    // Dynamic static method call: A::{'b'}()
                    check_method_name(parser, &member);
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker(_) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method: parser.alloc(member),
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCallDynamic(parser.alloc(
                                    StaticMethodCallDynamicExpr {
                                        class: parser.alloc(lhs),
                                        method: parser.alloc(member),
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Dynamic class constant: Foo::{bar()}
                    parser.require_version(
                        PhpVersion::Php83,
                        "dynamic class constant fetch",
                        brace_span,
                    );
                    let span = parser.span_from(lhs.span.start);
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccessDynamic {
                            class: parser.alloc(lhs),
                            member: parser.alloc(member),
                        },
                        span,
                    };
                }
            } else if parser.check(TokenKind::Class) {
                // Special: Class::class (class name resolution)
                if parser.version < PhpVersion::Php80 && !is_compile_time_class(&lhs) {
                    parser.forbid(
                        ForbiddenRule::DynamicClassFetch,
                        "Cannot use ::class with dynamic class name",
                        lhs.span,
                    );
                } else if let Some(value) = folded_value::folded_class_fetch_value(parser, &lhs) {
                    let message = if parser.version >= PhpVersion::Php83 {
                        format!("Cannot use \"::class\" on {value}")
                    } else {
                        format!("Cannot use \"::class\" on value of type {value}")
                    };
                    parser.forbid(ForbiddenRule::ClassFetchOnFoldedValue, message, lhs.span);
                }
                let token = parser.advance();
                let span = Span::new(lhs.span.start, token.span.end);
                lhs = Expr {
                    kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                        class: parser.alloc(lhs),
                        member: parser.alloc(Expr {
                            kind: ExprKind::Identifier(NameStr::from_source("class")),
                            span: token.span,
                        }),
                    }),
                    span,
                };
            } else {
                // Static method call or class constant
                let (member_name, member_span) =
                    if let Some(result) = parser.eat_identifier_or_keyword() {
                        result
                    } else {
                        let err_span = parser.current_span();
                        parser.error(ParseError::Expected {
                            expected: "identifier".into(),
                            found: parser.current_kind().description().into(),
                            span: err_span,
                        });
                        lhs = Expr {
                            kind: ExprKind::Error,
                            span: parser.span_from(lhs.span.start),
                        };
                        continue;
                    };

                if parser.check(TokenKind::LeftParen) {
                    let method = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::from_source(member_name)),
                        span: member_span,
                    });
                    match parse_arg_list_or_callable(parser) {
                        ArgListResult::CallableMarker(_) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::CallableCreate(CallableCreateExpr {
                                    kind: CallableCreateKind::StaticMethod {
                                        class: parser.alloc(lhs),
                                        method,
                                    },
                                }),
                                span,
                            };
                        }
                        ArgListResult::Args(args) => {
                            let span = parser.span_from(lhs.span.start);
                            lhs = Expr {
                                kind: ExprKind::StaticMethodCall(parser.alloc(
                                    StaticMethodCallExpr {
                                        class: parser.alloc(lhs),
                                        method,
                                        args,
                                    },
                                )),
                                span,
                            };
                        }
                    }
                } else {
                    // Class constant
                    let member = parser.alloc(Expr {
                        kind: ExprKind::Identifier(NameStr::from_source(member_name)),
                        span: member_span,
                    });
                    let span = parser.span_from(lhs.span.start);
                    lhs = Expr {
                        kind: ExprKind::ClassConstAccess(StaticAccessExpr {
                            class: parser.alloc(lhs),
                            member,
                        }),
                        span,
                    };
                }
            }
            allow_curly_static_base(parser, &lhs);
            continue;
        }

        // Array access: $arr[index]
        if kind == TokenKind::LeftBracket {
            if MEMBER_ACCESS_BP < min_bp {
                break;
            }
            check_dereferencable(parser, &lhs, kind);
            allow_curly_base(parser, &lhs);
            parser.advance(); // consume [
            let index = if parser.check(TokenKind::RightBracket) {
                parser.empty_dim_count += 1;
                None
            } else {
                let e = parse_expr(parser);
                Some(parser.alloc(e))
            };
            parser.expect(TokenKind::RightBracket);
            let span = parser.span_from(lhs.span.start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: parser.alloc(lhs),
                    index,
                }),
                span,
            };
            continue;
        }

        // Curly brace array/string access: $a{'b'} — removed in PHP 8.0.
        if kind == TokenKind::LeftBrace {
            if MEMBER_ACCESS_BP < min_bp || parser.no_brace_subscript {
                break;
            }
            allow_curly_base(parser, &lhs);
            let brace_span = parser.current_span();
            parser.advance(); // consume {
            let index = if parser.check(TokenKind::RightBrace) {
                // From 8.4 PHP's error is at the `{`, reported below.
                if parser.version < PhpVersion::Php84 {
                    parser.error_expected("expression");
                }
                None
            } else {
                let e = parse_expr(parser);
                Some(parser.alloc(e))
            };
            parser.expect(TokenKind::RightBrace);
            // PHP 7.4 only deprecates the syntax, which it has for variables alone.
            if parser.version >= PhpVersion::Php80 {
                parser.forbid(
                    ForbiddenRule::CurlyOffsetAccess,
                    CURLY_OFFSET_REMOVED,
                    brace_span,
                );
                if parser.version < PhpVersion::Php84 {
                    parser.retractable_curly.push(brace_span);
                }
            } else if matches!(
                lhs.kind,
                ExprKind::Name(_)
                    | ExprKind::ClassConstAccess(_)
                    | ExprKind::MagicConst(_)
                    | ExprKind::InterpolatedString(_)
            ) {
                parser.error(ParseError::Expected {
                    expected: "';'".into(),
                    found: "'{'".into(),
                    span: brace_span,
                });
            }
            let span = parser.span_from(lhs.span.start);
            lhs = Expr {
                kind: ExprKind::ArrayAccess(ArrayAccessExpr {
                    array: parser.alloc(lhs),
                    index,
                }),
                span,
            };
            continue;
        }

        // Function call: name(args)
        if kind == TokenKind::LeftParen {
            if MEMBER_ACCESS_BP < min_bp {
                break;
            }
            check_dereferencable(parser, &lhs, kind);
            lhs = parse_function_call(parser, lhs);
            continue;
        }

        // Infix binary operators
        // Before PHP 8.0, `.` shares the precedence of `+` and `-`.
        let bp_kind = if kind == TokenKind::Dot && parser.version < PhpVersion::Php80 {
            TokenKind::Plus
        } else {
            kind
        };
        if let Some((left_bp, right_bp)) = precedence::infix_binding_power(bp_kind) {
            if left_bp < min_bp {
                break;
            }
            // Chaining non-associative operators within the same precedence group
            // is a syntax error (e.g. `1 < 2 < 3`, `$a === $b == $c`).
            // Cross-group chains (e.g. `$a > $b == $c`) and instanceof chains are
            // allowed by PHP and must not be flagged here.
            if let Some(current_level) = nonassoc_chain_level_for_token(kind) {
                if matches!(&lhs.kind, ExprKind::Binary(b) if nonassoc_chain_level_for_op(b.op) == Some(current_level))
                {
                    let span = parser.current_span();
                    parser.forbid(
                        ForbiddenRule::NonAssociativeChain,
                        "Chaining non-associative operators requires explicit parentheses.",
                        span,
                    );
                }
            }
            let op_token = parser.advance();
            if op_token.kind == TokenKind::PipeArrow {
                parser.require_version(PhpVersion::Php85, "pipe operator (|>)", op_token.span);
            }
            let op = token_to_binary_op(op_token.kind).unwrap_or_else(|| {
                unreachable!(
                    "infix_binding_power returned Some for {:?} but token_to_binary_op returned None",
                    op_token.kind
                )
            });
            // PHP grammar quirk: assignment escapes rightward through every binary operator.
            // e.g. `$a && $b = $c`   →  `$a && ($b = $c)`
            //      `$a + $b + $c = 5` → `$a + $b + ($c = 5)`
            // parse_expr_bp with right_bp > ASSIGNMENT_BP won't consume the assignment,
            // so we explicitly apply it here (same pattern as the `??` branch above).
            let lhs_truth = match chain_truth {
                _ if !is_short_circuit(op) => None,
                Some((span, truth)) if span == lhs.span => truth,
                _ => const_truth(&lhs, parser.version),
            };
            let short_circuits = match (op, lhs_truth) {
                (BinaryOp::BooleanAnd | BinaryOp::LogicalAnd, Some(truth)) => !truth,
                (BinaryOp::BooleanOr | BinaryOp::LogicalOr, Some(truth)) => truth,
                _ => false,
            };
            // A condition PHP may fold, whose value is not computed here, may skip the right side too.
            let may_skip = short_circuits
                || is_short_circuit(op) && lhs_truth.is_none() && may_fold_at_runtime(parser, &lhs);
            if op == BinaryOp::Instanceof && parser.check(TokenKind::LeftParen) {
                let span = parser.current_span();
                parser.require_version(PhpVersion::Php80, "instanceof with an expression", span);
            }
            // `instanceof static` names the class; `static` is no expression on its own.
            let instanceof_static = op == BinaryOp::Instanceof
                && parser.check(TokenKind::Static)
                && parser.peek_kind() != Some(TokenKind::DoubleColon);
            let mut rhs = if instanceof_static {
                let token = parser.advance();
                parser.note_class_keyword(TokenKind::Static);
                atom::simple_name_expr("static", token.span)
            } else {
                parse_expr_bp(parser, right_bp)
            };
            if parser.current_kind().is_assignment_op() {
                rhs = parse_assign_continuation(parser, rhs);
            }
            if may_skip {
                parser.uncompiled_spans.push(rhs.span);
            }
            if op == BinaryOp::Instanceof {
                if is_class_name_reference(&rhs) {
                    check_class_name_literal(parser, &rhs);
                } else {
                    parser.forbid(ForbiddenRule::InvalidInstanceofOperand, "right side of instanceof must be a class name, a variable or a parenthesized expression", rhs.span);
                }
            }
            // Check if pipe operator has unparenthesized arrow function on RHS
            if op == BinaryOp::Pipe && matches!(rhs.kind, ExprKind::ArrowFunction(_)) {
                parser.forbid(
                    ForbiddenRule::UnparenthesizedArrowInPipe,
                    "Arrow functions on the right hand side of |> must be parenthesized",
                    rhs.span,
                );
            }
            let span = lhs.span.merge(rhs.span);
            if is_short_circuit(op) {
                let truth = match lhs_truth {
                    Some(truth) if short_circuits => Some(truth),
                    Some(_) => const_truth(&rhs, parser.version),
                    None => None,
                };
                chain_truth = Some((span, truth));
            }
            lhs = Expr {
                kind: ExprKind::Binary(BinaryExpr {
                    left: parser.alloc(lhs),
                    op,
                    right: parser.alloc(rhs),
                }),
                span,
            };
            check_unsupported_operands(parser, &lhs);
            continue;
        }

        // Not an operator we handle — stop
        break;
    }

    parser.leave_nesting();
    lhs
}

/// Parse a member name after -> or ?->. Accepts identifiers and semi-reserved keywords.
pub(crate) fn parse_member_name<'arena, 'src>(
    parser: &'_ mut Parser<'arena, 'src>,
) -> Expr<'arena, 'src> {
    // After `->` PHP's lexer reads any label as a name, `__halt_compiler` included.
    if parser.check(TokenKind::Identifier)
        || parser.is_semi_reserved_keyword()
        || parser.check(TokenKind::HaltCompiler)
    {
        let token = parser.advance();
        let text = &parser.source[token.span.start as usize..token.span.end as usize];
        return Expr {
            kind: ExprKind::Identifier(NameStr::from_source(text)),
            span: token.span,
        };
    }
    match parser.current_kind() {
        // Dynamic: $obj->$var
        TokenKind::Variable => {
            let token = parser.advance();
            let name = parser.variable_name(token);
            Expr {
                kind: ExprKind::Variable(NameStr::from_source(name)),
                span: token.span,
            }
        }
        // Dynamic: $obj->{expr}
        TokenKind::LeftBrace => {
            parser.advance();
            let inner = parse_expr(parser);
            parser.expect(TokenKind::RightBrace);
            inner
        }
        // Dynamic: $obj->${expr} — variable-variable as member name.
        // Also bare $obj->$$var chain.
        TokenKind::Dollar => {
            let start = parser.start_span();
            parser.advance(); // consume $
            let inner = if parser.eat(TokenKind::LeftBrace).is_some() {
                let e = parse_expr(parser);
                parser.expect(TokenKind::RightBrace);
                e
            } else {
                atom::parse_variable_variable_name(parser)
            };
            let span = parser.span_from(start);
            Expr {
                kind: ExprKind::VariableVariable(parser.alloc(inner)),
                span,
            }
        }
        _ => {
            parser.error(ParseError::Expected {
                expected: "member name".into(),
                found: parser.current_kind().description().into(),
                span: parser.current_span(),
            });
            Expr {
                kind: ExprKind::Error,
                span: parser.missing_span(),
            }
        }
    }
}

fn token_to_binary_op(kind: TokenKind) -> Option<BinaryOp> {
    match kind {
        TokenKind::Plus => Some(BinaryOp::Add),
        TokenKind::Minus => Some(BinaryOp::Sub),
        TokenKind::Star => Some(BinaryOp::Mul),
        TokenKind::Slash => Some(BinaryOp::Div),
        TokenKind::Percent => Some(BinaryOp::Mod),
        TokenKind::StarStar => Some(BinaryOp::Pow),
        TokenKind::Dot => Some(BinaryOp::Concat),
        TokenKind::EqualsEquals => Some(BinaryOp::Equal),
        TokenKind::BangEquals => Some(BinaryOp::NotEqual),
        TokenKind::EqualsEqualsEquals => Some(BinaryOp::Identical),
        TokenKind::BangEqualsEquals => Some(BinaryOp::NotIdentical),
        TokenKind::LessThan => Some(BinaryOp::Less),
        TokenKind::GreaterThan => Some(BinaryOp::Greater),
        TokenKind::LessThanEquals => Some(BinaryOp::LessOrEqual),
        TokenKind::GreaterThanEquals => Some(BinaryOp::GreaterOrEqual),
        TokenKind::Spaceship => Some(BinaryOp::Spaceship),
        TokenKind::AmpersandAmpersand => Some(BinaryOp::BooleanAnd),
        TokenKind::PipePipe => Some(BinaryOp::BooleanOr),
        TokenKind::Ampersand => Some(BinaryOp::BitwiseAnd),
        TokenKind::Pipe => Some(BinaryOp::BitwiseOr),
        TokenKind::Caret => Some(BinaryOp::BitwiseXor),
        TokenKind::ShiftLeft => Some(BinaryOp::ShiftLeft),
        TokenKind::ShiftRight => Some(BinaryOp::ShiftRight),
        TokenKind::And => Some(BinaryOp::LogicalAnd),
        TokenKind::Or => Some(BinaryOp::LogicalOr),
        TokenKind::Xor => Some(BinaryOp::LogicalXor),
        TokenKind::Instanceof => Some(BinaryOp::Instanceof),
        TokenKind::PipeArrow => Some(BinaryOp::Pipe),
        _ => None,
    }
}
