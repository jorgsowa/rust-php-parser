use php_ast::*;

use super::internal_constants::{self, ConstType};
use super::{is_class_keyword_name, is_numeric_string, unparenthesized};
use crate::parser::Parser;
use crate::version::PhpVersion;

/// A value PHP folds at compile time; `None` contents are folded but not computed here.
#[derive(Clone, Debug)]
enum Value {
    Int(Option<i64>),
    Float(Option<f64>),
    Str(Option<Vec<u8>>),
    Bool(Option<bool>),
    Null,
    /// An array, its number of elements and whether any of its keys is a string.
    Array {
        count: Option<usize>,
        string_keys: Option<bool>,
    },
}

impl Value {
    fn truth(&self) -> Option<bool> {
        match self {
            Value::Int(n) => n.map(|n| n != 0),
            Value::Float(f) => f.map(|f| f != 0.0),
            Value::Str(s) => s.as_ref().map(|s| !matches!(s.as_slice(), b"" | b"0")),
            Value::Bool(b) => *b,
            Value::Null => Some(false),
            Value::Array { count, .. } => count.map(|c| c > 0),
        }
    }

    /// The operand of arithmetic, which PHP folds on numbers, booleans, null and numeric strings;
    /// before PHP 8.0 trailing whitespace makes a string only leading-numeric.
    fn number(&self, version: PhpVersion) -> Option<Value> {
        match self {
            Value::Int(Some(_)) | Value::Float(Some(_)) => Some(self.clone()),
            Value::Bool(Some(b)) => Some(Value::Int(Some(*b as i64))),
            Value::Null => Some(Value::Int(Some(0))),
            Value::Str(Some(s))
                if is_numeric_string(s)
                    && (version >= PhpVersion::Php80
                        || !s
                            .last()
                            .is_some_and(|b| b.is_ascii_whitespace() || *b == b'\x0B')) =>
            {
                let text = std::str::from_utf8(s).ok()?.trim_matches(|c: char| {
                    matches!(c, ' ' | '\t' | '\n' | '\r' | '\x0B' | '\x0C')
                });
                let float = || text.parse::<f64>().ok().map(|f| Value::Float(Some(f)));
                if text.contains(['.', 'e', 'E']) {
                    return float();
                }
                text.parse::<i64>()
                    .ok()
                    .map(|n| Value::Int(Some(n)))
                    .or_else(float)
            }
            _ => None,
        }
    }

    /// The operand of `%`, bitwise and shift operators, when PHP converts it without a diagnostic.
    fn integer(&self, version: PhpVersion) -> Option<i64> {
        match self.number(version)? {
            Value::Int(n) => n,
            // From PHP 8.1 a float's lost fraction is deprecated, so it is left to run time.
            Value::Float(Some(f))
                if f.is_finite()
                    && f.abs() < 9.0e18
                    && (f.fract() == 0.0 || version < PhpVersion::Php81) =>
            {
                Some(f.trunc() as i64)
            }
            _ => None,
        }
    }

    fn string(&self) -> Option<Option<Vec<u8>>> {
        Some(match self {
            Value::Str(s) => s.clone(),
            Value::Int(n) => n.map(|n| n.to_string().into_bytes()),
            Value::Bool(b) => b.map(|b| if b { b"1".to_vec() } else { Vec::new() }),
            Value::Null => Some(Vec::new()),
            // PHP's float formatting is not reproduced.
            Value::Float(_) => None,
            // Converting an array to a string warns, so PHP leaves it to run time.
            Value::Array { .. } => return None,
        })
    }
}

/// The type PHP 8 names for `(expr)::class` on a value it folds; `None` for a literal or no fold.
pub(super) fn folded_class_fetch_value(
    parser: &Parser<'_, '_>,
    class: &Expr<'_, '_>,
) -> Option<&'static str> {
    // A constant expression is not compiled as code, so PHP folds no `::class` operand in it.
    if !matches!(class.kind, ExprKind::Parenthesized(_)) || parser.parsing_const_expr() {
        return None;
    }
    let expr = unparenthesized(class);
    let literal = matches!(
        expr.kind,
        ExprKind::Int(_)
            | ExprKind::Float(_)
            | ExprKind::String(_)
            | ExprKind::Nowdoc { .. }
            | ExprKind::Heredoc { .. }
            | ExprKind::Bool(_)
            | ExprKind::Null
            | ExprKind::Array(_)
    );
    // From PHP 8.2 the parser joins concatenated literals into one string literal.
    if literal || (parser.version >= PhpVersion::Php82 && is_literal_concat(expr)) {
        return None;
    }
    Some(match folded_value(parser, expr, 0, false)? {
        Value::Int(_) => "int",
        Value::Float(_) => "float",
        Value::Str(_) => "string",
        Value::Null => "null",
        Value::Array { .. } => "array",
        Value::Bool(_) if parser.version < PhpVersion::Php83 => "bool",
        Value::Bool(b) => {
            if b? {
                "true"
            } else {
                "false"
            }
        }
    })
}

/// True if PHP folds `expr` to a value other than a string, as in the method name of `$o->{1}()`.
pub(super) fn folds_to_non_string(parser: &Parser<'_, '_>, expr: &Expr<'_, '_>) -> bool {
    folded_value(parser, expr, 0, false).is_some_and(|value| !matches!(value, Value::Str(_)))
}

/// Why PHP cannot unpack a spread element of an array literal it folds.
pub(super) enum UnpackError {
    /// The value is not an array; the type PHP names for it.
    NonArray(&'static str),
    /// Before PHP 8.1, the array has a string key.
    StringKeys,
}

/// The spread element of the array literal `elements` that PHP cannot unpack when it folds the
/// array at compile time.
pub(super) fn constant_unpack_error(
    parser: &Parser<'_, '_>,
    elements: &[ArrayElement<'_, '_>],
) -> Option<(Span, UnpackError)> {
    if !elements.iter().any(|el| el.is_spread()) {
        return None;
    }
    match fold_array(parser, elements, 0) {
        ArrayFold::UnpackError(span, error) => Some((span, error)),
        _ => None,
    }
}

enum ArrayFold {
    NotFolded,
    Folded(Value),
    UnpackError(Span, UnpackError),
}

/// PHP folds an array literal only if every element is constant, then adds them in order.
fn fold_array(
    parser: &Parser<'_, '_>,
    elements: &[ArrayElement<'_, '_>],
    depth: usize,
) -> ArrayFold {
    if depth > MAX_DEPTH {
        return ArrayFold::NotFolded;
    }
    let mut values = Vec::with_capacity(elements.len());
    for el in elements {
        let (ArrayElementKind::Value(value) | ArrayElementKind::Spread(value)) = &el.kind else {
            return ArrayFold::NotFolded;
        };
        let key = match &el.key {
            Some(key) => match folded_value(parser, key, depth + 1, true) {
                Some(key) => Some(key),
                None => return ArrayFold::NotFolded,
            },
            None => None,
        };
        let Some(value) = folded_value(parser, value, depth + 1, true) else {
            return ArrayFold::NotFolded;
        };
        values.push((key, value));
    }
    let version = parser.version;
    let mut has_string_key = false;
    let mut string_keys_known = true;
    for (el, (key, value)) in elements.iter().zip(values) {
        if el.is_spread() {
            let given = match value {
                Value::Array { string_keys, .. } => {
                    if version < PhpVersion::Php81 && string_keys == Some(true) {
                        return ArrayFold::UnpackError(el.value().span, UnpackError::StringKeys);
                    }
                    string_keys_known &= string_keys.is_some();
                    has_string_key |= string_keys == Some(true);
                    continue;
                }
                Value::Int(_) => "int",
                Value::Float(_) => "float",
                Value::Str(_) => "string",
                Value::Null => "null",
                Value::Bool(Some(true)) => "true",
                Value::Bool(Some(false)) => "false",
                Value::Bool(None) => "bool",
            };
            return ArrayFold::UnpackError(el.value().span, UnpackError::NonArray(given));
        }
        match &key {
            Some(Value::Str(Some(bytes))) => has_string_key |= !is_integer_key(bytes),
            Some(Value::Str(None)) => string_keys_known = false,
            Some(Value::Null) => has_string_key = true,
            _ => {}
        }
        // Keys PHP leaves to run time, where they warn or fail, stop the fold.
        let left_to_run_time = match key {
            Some(Value::Array { .. }) => true,
            Some(Value::Null) => version >= PhpVersion::Php85,
            Some(Value::Float(f)) => {
                version >= PhpVersion::Php81
                    && !f.is_some_and(|f| f.fract() == 0.0 && f.abs() < 9.0e18)
            }
            _ => false,
        };
        if left_to_run_time {
            return ArrayFold::NotFolded;
        }
    }
    // Keys may overwrite each other and unpacked arrays add their own elements.
    let counted = elements
        .iter()
        .all(|el| el.key.is_none() && !el.is_spread());
    ArrayFold::Folded(Value::Array {
        count: counted.then_some(elements.len()),
        string_keys: (has_string_key || string_keys_known).then_some(has_string_key),
    })
}

/// Whether PHP stores the string key `bytes` as an integer key, as it does `"1"` but not `"01"`.
fn is_integer_key(bytes: &[u8]) -> bool {
    std::str::from_utf8(bytes)
        .ok()
        .and_then(|s| s.parse::<i64>().ok().map(|n| n.to_string() == s))
        .unwrap_or(false)
}

/// The truthiness of the value PHP folds `expr` to, when it is computed here.
pub(super) fn folded_value_truth(parser: &Parser<'_, '_>, expr: &Expr<'_, '_>) -> Option<bool> {
    folded_value(parser, expr, 0, false)?.truth()
}

/// The bytes of the string PHP folds `expr` to, when they are computed here.
pub(super) fn folded_string(parser: &Parser<'_, '_>, expr: &Expr<'_, '_>) -> Option<Vec<u8>> {
    match folded_value(parser, expr, 0, false)? {
        Value::Str(bytes) => bytes,
        _ => None,
    }
}

pub(super) fn is_literal_concat(expr: &Expr<'_, '_>) -> bool {
    let token = |e: &Expr<'_, '_>| {
        matches!(
            unparenthesized(e).kind,
            ExprKind::Int(_) | ExprKind::Float(_) | ExprKind::String(_) | ExprKind::Nowdoc { .. }
        )
    };
    let mut expr = expr;
    // Walk the left spine iteratively: chains are built in a loop and can be very long.
    while let ExprKind::Binary(b) = &expr.kind {
        if b.op != BinaryOp::Concat
            || !(token(b.right) || is_literal_concat(unparenthesized(b.right)))
        {
            return false;
        }
        if token(b.left) {
            return true;
        }
        expr = unparenthesized(b.left);
    }
    false
}

/// Operand nesting past which a value is left unknown, to bound recursion on long chains.
const MAX_DEPTH: usize = 64;

/// `conditionals` is set where PHP evaluates `expr` as a constant expression, as it does the
/// elements of an array literal, which also folds `?:` and `??`.
fn folded_value(
    parser: &Parser<'_, '_>,
    expr: &Expr<'_, '_>,
    depth: usize,
    conditionals: bool,
) -> Option<Value> {
    if depth > MAX_DEPTH {
        return None;
    }
    let version = parser.version;
    let expr = unparenthesized(expr);
    Some(match &expr.kind {
        ExprKind::Int(n) => Value::Int(Some(*n)),
        ExprKind::Float(f) => Value::Float(Some(*f)),
        ExprKind::String(s) => Value::Str(Some(s.as_bytes().to_vec())),
        ExprKind::Nowdoc { value, .. } => Value::Str(Some(value.as_bytes().to_vec())),
        ExprKind::Bool(b) => Value::Bool(Some(*b)),
        ExprKind::Null => Value::Null,
        ExprKind::Array(elements) => match fold_array(parser, elements, depth + 1) {
            ArrayFold::Folded(value) => value,
            _ => return None,
        },
        ExprKind::MagicConst(kind) => match kind {
            MagicConstKind::Line => Value::Int(None),
            // A trait's `__CLASS__` is the class that uses it.
            MagicConstKind::Class => match parser.class_scope.as_ref() {
                None => Value::Str(Some(Vec::new())),
                Some(scope) if scope.is_trait => return None,
                Some(scope) if scope.is_anonymous => Value::Str(None),
                Some(scope) => Value::Str(Some(scope.name.as_bytes().to_vec())),
            },
            MagicConstKind::Property => return None,
            _ => Value::Str(None),
        },
        ExprKind::Name(name) => constant_value(parser, name)?,
        ExprKind::ClassConstAccess(access) => {
            let resolved = matches!(&access.member.kind, ExprKind::Identifier(m) if m.eq_ignore_ascii_case("class"))
                && matches!(&access.class.kind, ExprKind::Name(name) if !is_class_keyword_name(name));
            if !resolved {
                return None;
            }
            Value::Str(None)
        }
        ExprKind::ErrorSuppress(inner) => folded_value(parser, inner, depth + 1, conditionals)?,
        ExprKind::UnaryPrefix(u) => {
            let operand = folded_value(parser, u.operand, depth + 1, conditionals)?;
            match u.op {
                UnaryPrefixOp::BooleanNot => {
                    // PHP 8.5 leaves `!` on a float to run time, where a NAN warns.
                    if version >= PhpVersion::Php85 && matches!(operand, Value::Float(_)) {
                        return None;
                    }
                    Value::Bool(operand.truth().map(|t| !t))
                }
                UnaryPrefixOp::Plus => operand.number(version)?,
                UnaryPrefixOp::Negate => match operand.number(version)? {
                    Value::Int(Some(n)) => match n.checked_neg() {
                        Some(n) => Value::Int(Some(n)),
                        None => Value::Float(Some(-(n as f64))),
                    },
                    Value::Float(Some(f)) => Value::Float(Some(-f)),
                    _ => return None,
                },
                UnaryPrefixOp::BitwiseNot => match operand {
                    Value::Str(s) => Value::Str(s.map(|s| s.iter().map(|b| !b).collect())),
                    Value::Int(_) | Value::Float(_) => Value::Int(Some(!operand.integer(version)?)),
                    _ => return None,
                },
                _ => return None,
            }
        }
        ExprKind::Binary(b) => binary_value(parser, b, depth + 1, conditionals)?,
        ExprKind::Ternary(t) if conditionals => {
            let condition = folded_value(parser, t.condition, depth + 1, true)?;
            match (condition.truth()?, t.then_expr) {
                (true, None) => condition,
                (true, Some(then_expr)) => folded_value(parser, then_expr, depth + 1, true)?,
                (false, _) => folded_value(parser, t.else_expr, depth + 1, true)?,
            }
        }
        ExprKind::NullCoalesce(n) if conditionals => {
            match folded_value(parser, n.left, depth + 1, true)? {
                Value::Null => folded_value(parser, n.right, depth + 1, true)?,
                left => left,
            }
        }
        _ => return None,
    })
}

fn constant_value(parser: &Parser<'_, '_>, name: &Name<'_, '_>) -> Option<Value> {
    let [word] = name.parts_slice() else {
        return None;
    };
    let global = match name.kind() {
        NameKind::FullyQualified => true,
        NameKind::Unqualified => parser.namespace.is_none(),
        _ => return None,
    };
    if word.eq_ignore_ascii_case("true") || word.eq_ignore_ascii_case("false") {
        return Some(Value::Bool(Some(word.eq_ignore_ascii_case("true"))));
    }
    if word.eq_ignore_ascii_case("null") {
        return Some(Value::Null);
    }
    if !global {
        return None;
    }
    // Values of a 64-bit build.
    match *word {
        "PHP_INT_MAX" => return Some(Value::Int(Some(i64::MAX))),
        "PHP_INT_MIN" => return Some(Value::Int(Some(i64::MIN))),
        "PHP_INT_SIZE" => return Some(Value::Int(Some(8))),
        _ => {}
    }
    let index = internal_constants::INTERNAL_CONSTANT_TYPES
        .binary_search_by(|(n, _)| n.cmp(word))
        .ok()?;
    Some(match internal_constants::INTERNAL_CONSTANT_TYPES[index].1 {
        ConstType::Int => Value::Int(None),
        ConstType::Float => Value::Float(None),
        ConstType::Str => Value::Str(None),
        ConstType::Bool => Value::Bool(None),
    })
}

fn binary_value(
    parser: &Parser<'_, '_>,
    b: &BinaryExpr<'_, '_>,
    depth: usize,
    conditionals: bool,
) -> Option<Value> {
    let version = parser.version;
    let left = folded_value(parser, b.left, depth, conditionals)?;
    // A left operand that decides `&&` or `||` leaves the right one out.
    if let Some(truth) = left.truth() {
        let decided = match b.op {
            BinaryOp::BooleanAnd | BinaryOp::LogicalAnd => !truth,
            BinaryOp::BooleanOr | BinaryOp::LogicalOr => truth,
            _ => false,
        };
        if decided {
            return Some(Value::Bool(Some(truth)));
        }
    }
    let right = folded_value(parser, b.right, depth, conditionals)?;
    Some(match b.op {
        BinaryOp::BooleanAnd | BinaryOp::LogicalAnd => {
            Value::Bool(left.truth().zip(right.truth()).map(|(l, r)| l && r))
        }
        BinaryOp::BooleanOr | BinaryOp::LogicalOr => {
            Value::Bool(left.truth().zip(right.truth()).map(|(l, r)| l || r))
        }
        BinaryOp::LogicalXor => Value::Bool(left.truth().zip(right.truth()).map(|(l, r)| l != r)),
        BinaryOp::Concat => match (left.string()?, right.string()?) {
            (Some(mut l), Some(r)) => {
                l.extend_from_slice(&r);
                Value::Str(Some(l))
            }
            _ => Value::Str(None),
        },
        BinaryOp::Identical | BinaryOp::NotIdentical => {
            let same = identical(&left, &right);
            Value::Bool(same.map(|s| s == (b.op == BinaryOp::Identical)))
        }
        BinaryOp::Equal
        | BinaryOp::NotEqual
        | BinaryOp::Less
        | BinaryOp::Greater
        | BinaryOp::LessOrEqual
        | BinaryOp::GreaterOrEqual => {
            let ord = compare(&left, &right);
            Value::Bool(ord.map(|o| match b.op {
                BinaryOp::Equal => o.is_eq(),
                BinaryOp::NotEqual => o.is_ne(),
                BinaryOp::Less => o.is_lt(),
                BinaryOp::Greater => o.is_gt(),
                BinaryOp::LessOrEqual => o.is_le(),
                _ => o.is_ge(),
            }))
        }
        BinaryOp::Spaceship => Value::Int(compare(&left, &right).map(|o| o as i64)),
        BinaryOp::Add if matches!((&left, &right), (Value::Array { .. }, Value::Array { .. })) => {
            match (left, right) {
                (Value::Array { count: Some(0), .. }, other)
                | (other, Value::Array { count: Some(0), .. }) => other,
                (Value::Array { string_keys: l, .. }, Value::Array { string_keys: r, .. }) => {
                    Value::Array {
                        count: None,
                        string_keys: match (l, r) {
                            (Some(true), _) | (_, Some(true)) => Some(true),
                            (Some(false), Some(false)) => Some(false),
                            _ => None,
                        },
                    }
                }
                _ => return None,
            }
        }
        BinaryOp::Add | BinaryOp::Sub | BinaryOp::Mul => {
            match (left.number(version)?, right.number(version)?) {
                (Value::Int(Some(l)), Value::Int(Some(r))) => {
                    let exact = match b.op {
                        BinaryOp::Add => l.checked_add(r),
                        BinaryOp::Sub => l.checked_sub(r),
                        _ => l.checked_mul(r),
                    };
                    match exact {
                        Some(n) => Value::Int(Some(n)),
                        None => Value::Float(None),
                    }
                }
                (l, r) => {
                    let (l, r) = (as_float(&l)?, as_float(&r)?);
                    Value::Float(Some(match b.op {
                        BinaryOp::Add => l + r,
                        BinaryOp::Sub => l - r,
                        _ => l * r,
                    }))
                }
            }
        }
        BinaryOp::Div => match (left.number(version)?, right.number(version)?) {
            (Value::Int(Some(l)), Value::Int(Some(r))) if r != 0 => {
                match (l.checked_rem(r), l.checked_div(r)) {
                    (Some(0), Some(q)) => Value::Int(Some(q)),
                    _ => Value::Float(Some(l as f64 / r as f64)),
                }
            }
            (l, r) => {
                let (l, r) = (as_float(&l)?, as_float(&r)?);
                if r == 0.0 {
                    return None;
                }
                Value::Float(Some(l / r))
            }
        },
        BinaryOp::Mod => {
            let (l, r) = (left.integer(version)?, right.integer(version)?);
            match r {
                0 => return None,
                -1 => Value::Int(Some(0)),
                _ => Value::Int(Some(l % r)),
            }
        }
        BinaryOp::Pow => {
            let (base, exponent) = (left.number(version)?, right.number(version)?);
            // From PHP 8.4 raising zero to a negative power is deprecated.
            if version >= PhpVersion::Php84 && as_float(&base)? == 0.0 && as_float(&exponent)? < 0.0
            {
                return None;
            }
            match (base, exponent) {
                (Value::Int(Some(l)), Value::Int(Some(r))) if r >= 0 => {
                    match u32::try_from(r).ok().and_then(|r| l.checked_pow(r)) {
                        Some(n) => Value::Int(Some(n)),
                        None => Value::Float(None),
                    }
                }
                _ => Value::Float(None),
            }
        }
        BinaryOp::BitwiseAnd | BinaryOp::BitwiseOr | BinaryOp::BitwiseXor => {
            if let (Value::Str(l), Value::Str(r)) = (&left, &right) {
                return Some(Value::Str(
                    l.as_ref()
                        .zip(r.as_ref())
                        .map(|(l, r)| bitwise_strings(b.op, l, r)),
                ));
            }
            let (l, r) = (left.integer(version)?, right.integer(version)?);
            Value::Int(Some(match b.op {
                BinaryOp::BitwiseAnd => l & r,
                BinaryOp::BitwiseOr => l | r,
                _ => l ^ r,
            }))
        }
        BinaryOp::ShiftLeft | BinaryOp::ShiftRight => {
            let (l, r) = (left.integer(version)?, right.integer(version)?);
            // A negative shift throws, so PHP leaves it to run time.
            if r < 0 {
                return None;
            }
            Value::Int(Some(match (b.op, r) {
                (BinaryOp::ShiftLeft, 64..) => 0,
                (BinaryOp::ShiftLeft, _) => l << r,
                (_, 64..) => l >> 63,
                _ => l >> r,
            }))
        }
        _ => return None,
    })
}

fn as_float(value: &Value) -> Option<f64> {
    match value {
        Value::Int(n) => n.map(|n| n as f64),
        Value::Float(f) => *f,
        _ => None,
    }
}

fn bitwise_strings(op: BinaryOp, l: &[u8], r: &[u8]) -> Vec<u8> {
    let (short, long) = if l.len() <= r.len() { (l, r) } else { (r, l) };
    let mut out: Vec<u8> = match op {
        BinaryOp::BitwiseOr => long.to_vec(),
        _ => short.to_vec(),
    };
    for (i, byte) in out.iter_mut().take(short.len()).enumerate() {
        *byte = match op {
            BinaryOp::BitwiseAnd => l[i] & r[i],
            BinaryOp::BitwiseOr => l[i] | r[i],
            _ => l[i] ^ r[i],
        };
    }
    out
}

fn identical(left: &Value, right: &Value) -> Option<bool> {
    Some(match (left, right) {
        (Value::Int(l), Value::Int(r)) => l.as_ref()? == r.as_ref()?,
        (Value::Float(l), Value::Float(r)) => l.as_ref()? == r.as_ref()?,
        (Value::Str(l), Value::Str(r)) => l.as_ref()? == r.as_ref()?,
        (Value::Bool(l), Value::Bool(r)) => l.as_ref()? == r.as_ref()?,
        (Value::Null, Value::Null) => true,
        (Value::Array { count: l, .. }, Value::Array { count: r, .. }) => match (l, r) {
            (Some(0), Some(0)) => true,
            (Some(l), Some(r)) if l != r => false,
            _ => return None,
        },
        _ => false,
    })
}

/// PHP 8's loose comparison, where it is computed here.
fn compare(left: &Value, right: &Value) -> Option<std::cmp::Ordering> {
    match (left, right) {
        (Value::Bool(_) | Value::Null, _) | (_, Value::Bool(_) | Value::Null)
            if !matches!(
                (left, right),
                (Value::Null, Value::Str(_)) | (Value::Str(_), Value::Null)
            ) =>
        {
            Some(left.truth()?.cmp(&right.truth()?))
        }
        // An array has more elements than another, or is greater than a number or string.
        (Value::Array { count: l, .. }, Value::Array { count: r, .. }) => match (l, r) {
            (Some(l), Some(r)) if l != r || *l == 0 => Some(l.cmp(r)),
            _ => None,
        },
        (Value::Array { .. }, _) => Some(std::cmp::Ordering::Greater),
        (_, Value::Array { .. }) => Some(std::cmp::Ordering::Less),
        (Value::Int(Some(l)), Value::Int(Some(r))) => Some(l.cmp(r)),
        (Value::Int(_) | Value::Float(_), Value::Int(_) | Value::Float(_)) => {
            let exact = |v: &Value| match v {
                Value::Int(Some(n)) => (n.unsigned_abs() <= 1 << 53).then_some(*n as f64),
                _ => as_float(v),
            };
            exact(left)?.partial_cmp(&exact(right)?)
        }
        (Value::Str(_) | Value::Null, Value::Str(_) | Value::Null) => {
            let (l, r) = (left.string()??, right.string()??);
            if is_numeric_string(&l) || is_numeric_string(&r) {
                return None;
            }
            Some(l.cmp(&r))
        }
        _ => None,
    }
}
