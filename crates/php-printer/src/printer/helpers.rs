use php_ast::ast::*;

pub(crate) fn is_declaration(kind: &StmtKind) -> bool {
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

pub(crate) fn needs_double_quotes(s: &str) -> bool {
    s.bytes().any(|b| {
        matches!(
            b,
            b'\n' | b'\r' | b'\t' | b'\x1b' | b'\x0c' | b'\x0b' | b'$'
        )
    })
}

pub(crate) fn escape_single_quoted(s: &str) -> String {
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

pub(crate) fn escape_double_quoted(s: &str) -> String {
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

pub(crate) fn binary_op_str(op: BinaryOp) -> &'static str {
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

pub(crate) fn assign_op_str(op: AssignOp) -> &'static str {
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

pub(crate) fn unary_prefix_op_str(op: UnaryPrefixOp) -> &'static str {
    match op {
        UnaryPrefixOp::Negate => "-",
        UnaryPrefixOp::Plus => "+",
        UnaryPrefixOp::BooleanNot => "!",
        UnaryPrefixOp::BitwiseNot => "~",
        UnaryPrefixOp::PreIncrement => "++",
        UnaryPrefixOp::PreDecrement => "--",
    }
}

pub(crate) fn unary_postfix_op_str(op: UnaryPostfixOp) -> &'static str {
    match op {
        UnaryPostfixOp::PostIncrement => "++",
        UnaryPostfixOp::PostDecrement => "--",
    }
}

pub(crate) fn cast_str(kind: CastKind) -> &'static str {
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

pub(crate) fn include_kind_str(kind: IncludeKind) -> &'static str {
    match kind {
        IncludeKind::Include => "include",
        IncludeKind::IncludeOnce => "include_once",
        IncludeKind::Require => "require",
        IncludeKind::RequireOnce => "require_once",
    }
}

pub(crate) fn magic_const_str(kind: MagicConstKind) -> &'static str {
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

pub(crate) fn visibility_str(vis: Visibility) -> &'static str {
    match vis {
        Visibility::Public => "public",
        Visibility::Protected => "protected",
        Visibility::Private => "private",
    }
}
