use php_ast::*;

use super::folded_value;
use crate::parser::Parser;
use crate::version::PhpVersion;

/// Functions PHP 8.6 calls without a frame, with the argument counts it does so for.
const FRAMELESS_86: &[(&str, &[usize])] = &[
    ("clamp", &[3]),
    ("class_exists", &[1, 2]),
    ("dechex", &[1]),
    ("dirname", &[1, 2]),
    ("implode", &[1, 2]),
    ("in_array", &[2, 3]),
    ("is_numeric", &[1]),
    ("ltrim", &[1, 2]),
    ("max", &[2]),
    ("min", &[2]),
    ("preg_match", &[2]),
    ("preg_replace", &[3]),
    ("property_exists", &[2]),
    ("rtrim", &[1, 2]),
    ("str_contains", &[2]),
    ("str_ends_with", &[2]),
    ("str_replace", &[3]),
    ("str_starts_with", &[2]),
    ("strpos", &[2, 3]),
    ("strstr", &[2, 3]),
    ("strtolower", &[1]),
    ("strtoupper", &[1]),
    ("strtr", &[2, 3]),
    ("substr", &[2, 3]),
    ("trim", &[1, 2]),
];

/// True if PHP compiles `call` to an instruction whose result it cannot write to, which it
/// does for some internal functions called by their global name.
pub(super) fn is_special_builtin_call(
    parser: &Parser<'_, '_>,
    call: &FunctionCallExpr<'_, '_>,
) -> bool {
    let ExprKind::Name(name) = &call.name.kind else {
        return false;
    };
    let [word] = name.parts_slice() else {
        return false;
    };
    let global = match name.kind() {
        NameKind::FullyQualified => true,
        NameKind::Unqualified => parser.namespace.is_none(),
        _ => false,
    };
    if !global
        || call
            .args
            .iter()
            .any(|arg| arg.name.is_some() || !matches!(arg.kind, ArgKind::Value(_)))
    {
        return false;
    }
    let version = parser.version;
    let args = call.args.len();
    let lower = word.to_ascii_lowercase();
    if version >= PhpVersion::Php86
        && FRAMELESS_86
            .iter()
            .any(|(name, counts)| *name == lower && counts.contains(&args))
    {
        return true;
    }
    match lower.as_str() {
        "strlen" | "is_null" | "is_bool" | "is_int" | "is_float" | "is_string" | "is_array"
        | "is_object" | "is_resource" | "boolval" | "intval" | "floatval" | "strval"
        | "gettype" | "get_class" | "count" | "sizeof" => args == 1,
        "is_scalar" => args == 1 && version >= PhpVersion::Php80,
        // PHP 8.6 compiles these aliases as ordinary calls.
        "doubleval" | "is_double" | "is_integer" | "is_long" => {
            args == 1 && version < PhpVersion::Php86
        }
        "array_key_exists" => args == 2,
        "func_num_args" | "func_get_args" => args == 0 && parser.function_depth > 0,
        "defined" => {
            args == 1
                && match call.args[0].value().map(|value| &value.kind) {
                    Some(ExprKind::String(s)) => {
                        !s.as_bytes().iter().any(|b| matches!(b, b'\\' | b':'))
                    }
                    Some(ExprKind::Int(_) | ExprKind::Float(_)) => true,
                    _ => false,
                }
        }
        "sprintf" => version >= PhpVersion::Php84 && compiled_format(parser, call),
        "printf" => version >= PhpVersion::Php86 && compiled_format(parser, call),
        _ => false,
    }
}

/// A format PHP formats at compile time: a constant string under 256 bytes whose only
/// conversions are `%s`, `%d` and `%%`, with one argument per conversion.
fn compiled_format(parser: &Parser<'_, '_>, call: &FunctionCallExpr<'_, '_>) -> bool {
    let Some(first) = call.args.first().and_then(Arg::value) else {
        return false;
    };
    let Some(format) = folded_value::folded_string(parser, first) else {
        return false;
    };
    if format.len() >= 256 {
        return false;
    }
    let mut placeholders = 0;
    let mut bytes = format.iter();
    while let Some(&b) = bytes.next() {
        if b != b'%' {
            continue;
        }
        match bytes.next() {
            Some(b's' | b'd') => placeholders += 1,
            Some(b'%') => {}
            _ => return false,
        }
    }
    placeholders == call.args.len() - 1
}
