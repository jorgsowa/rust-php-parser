use php_ast::ast::*;
use php_ast::PhpVersion;

/// Inline HTML that outputs nothing.
pub(crate) fn is_silent_html(kind: &StmtKind) -> bool {
    matches!(kind, StmtKind::InlineHtml(""))
}

/// Whether `stmts` prints anything; empty statements and silent HTML do not.
pub(crate) fn has_output(stmts: &[Stmt]) -> bool {
    stmts
        .iter()
        .any(|stmt| !matches!(stmt.kind, StmtKind::Nop) && !is_silent_html(&stmt.kind))
}

/// `declare(encoding=...)`, and `declare(strict_types=...)` before PHP 8.5, reject an empty statement before them.
pub(crate) fn rejects_empty_stmt_before(stmt: &Stmt, version: PhpVersion) -> bool {
    let StmtKind::Declare(declare) = &stmt.kind else {
        return false;
    };
    declare.directives.iter().any(|(name, _)| {
        name.eq_ignore_ascii_case("encoding")
            || (name.eq_ignore_ascii_case("strict_types") && version < PhpVersion::Php85)
    })
}

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

/// Start of the doc comment printed before `stmt`, which may sit on its declaration.
pub(crate) fn stmt_doc_comment_start(stmt: &Stmt) -> Option<u32> {
    let doc = match &stmt.kind {
        StmtKind::Function(f) => f.doc_comment.as_ref(),
        StmtKind::Class(c) => c.doc_comment.as_ref(),
        StmtKind::Interface(i) => i.doc_comment.as_ref(),
        StmtKind::Trait(t) => t.doc_comment.as_ref(),
        StmtKind::Enum(e) => e.doc_comment.as_ref(),
        StmtKind::Const(items) => items.first().and_then(|c| c.doc_comment.as_ref()),
        _ => stmt.doc_comment,
    };
    doc.map(|c| c.span.start)
}

pub(crate) fn class_member_doc_comment<'a>(member: &'a ClassMember) -> Option<&'a Comment<'a>> {
    match &member.kind {
        ClassMemberKind::Property(p) => p.doc_comment.as_ref(),
        ClassMemberKind::Method(m) => m.doc_comment.as_ref(),
        ClassMemberKind::ClassConst(c) => c.doc_comment.as_ref(),
        ClassMemberKind::TraitUse(t) => t.doc_comment.as_ref(),
        _ => None,
    }
}

pub(crate) fn enum_member_doc_comment<'a>(member: &'a EnumMember) -> Option<&'a Comment<'a>> {
    match &member.kind {
        EnumMemberKind::Case(c) => c.doc_comment.as_ref(),
        EnumMemberKind::Method(m) => m.doc_comment.as_ref(),
        EnumMemberKind::ClassConst(c) => c.doc_comment.as_ref(),
        EnumMemberKind::TraitUse(t) => t.doc_comment.as_ref(),
        EnumMemberKind::Property(p) => p.doc_comment.as_ref(),
        _ => None,
    }
}

/// Whether a string literal must be written in double quotes: it holds a control character or
/// `$`, which need a double-quoted escape, or bytes that are not valid UTF-8 and are written as
/// `\xNN`.
pub(crate) fn needs_double_quotes(bytes: &[u8]) -> bool {
    bytes.iter().any(|&b| b == b'$' || is_control(b)) || std::str::from_utf8(bytes).is_err()
}

fn is_control(byte: u8) -> bool {
    byte < 0x20 || byte == 0x7f
}

/// Writes a control character with no named escape as `\xNN`.
fn push_control_escape(out: &mut String, ch: char) -> bool {
    if ch.is_ascii() && is_control(ch as u8) {
        out.push_str(&format!("\\x{:02x}", ch as u8));
        true
    } else {
        false
    }
}

/// Escapes `bytes` with `escape`, writing every byte that is not part of a valid UTF-8 sequence as
/// `\xNN`.
pub(crate) fn escape_bytes(bytes: &[u8], escape: fn(&str) -> String) -> String {
    if let Ok(text) = std::str::from_utf8(bytes) {
        return escape(text);
    }
    let mut out = String::with_capacity(bytes.len());
    for chunk in bytes.utf8_chunks() {
        out.push_str(&escape(chunk.valid()));
        for byte in chunk.invalid() {
            out.push_str(&format!("\\x{byte:02x}"));
        }
    }
    out
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

/// Escape a literal segment of a heredoc body.
///
/// Heredocs preserve real newlines, and `"` needs no escape, but `\` and `$`
/// must still be escaped to prevent unintended escape sequences and variable
/// interpolation. Carriage returns must be escaped as `\r` to avoid parser
/// confusion with line endings.
pub(crate) fn escape_heredoc(s: &str) -> String {
    let mut out = String::with_capacity(s.len());
    for ch in s.chars() {
        match ch {
            '\\' => out.push_str("\\\\"),
            '$' => out.push_str("\\$"),
            '\r' => out.push_str("\\r"),
            '\n' | '\t' => out.push(ch),
            _ if push_control_escape(&mut out, ch) => {}
            _ => out.push(ch),
        }
    }
    out
}

/// Writes every line of a heredoc body that PHP would read as the closing `label` with its
/// first byte escaped, so an escaped label in the source, as in `\x45OT`, cannot end the heredoc.
/// `at_line_start` tells whether `text` starts a line; its last line is followed by an
/// interpolation or the closing label, which end a label the way any non-label byte does.
pub(crate) fn guard_heredoc_label(text: &str, label: &str, at_line_start: bool) -> String {
    let mut out = String::with_capacity(text.len());
    for (i, line) in text.split('\n').enumerate() {
        if i > 0 {
            out.push('\n');
        }
        let body = line.trim_start_matches([' ', '\t']);
        let ends_label = body.strip_prefix(label).is_some_and(|rest| {
            !rest
                .bytes()
                .next()
                .is_some_and(|b| b.is_ascii_alphanumeric() || b == b'_' || b >= 0x80)
        });
        if (i > 0 || at_line_start) && !label.is_empty() && ends_label {
            out.push_str(&line[..line.len() - body.len()]);
            let first = body.chars().next().map_or(0, char::len_utf8);
            for byte in &body.as_bytes()[..first] {
                out.push_str(&format!("\\x{byte:02x}"));
            }
            out.push_str(&body[first..]);
        } else {
            out.push_str(line);
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
            _ if push_control_escape(&mut out, ch) => {}
            _ => out.push(ch),
        }
    }
    out
}

/// Escape a literal segment of a backtick shell execution string.
///
/// Backticks decode the escapes of a double-quoted string, which writes control characters as
/// `\xNN`, but `"` needs no escape. To include a backtick in the literal, it must appear as `\``
/// where the backslash doesn't form a recognized escape, so both characters are treated
/// as literals by the parser.
pub(crate) fn escape_shell_exec(s: &str) -> String {
    let mut out = String::with_capacity(s.len());
    let mut chars = s.chars().peekable();

    while let Some(ch) = chars.next() {
        match ch {
            '\\' => {
                // Check if next char is backtick - if so, output as-is to create `\`` escape
                if chars.peek() == Some(&'`') {
                    out.push('\\');
                    out.push('`');
                    chars.next(); // consume the backtick
                } else {
                    // Otherwise escape the backslash normally
                    out.push_str("\\\\");
                }
            }
            '$' => {
                out.push_str("\\$");
            }
            '`' => {
                // Backtick on its own - must escape as `\``
                out.push('\\');
                out.push('`');
            }
            '\n' | '\t' => out.push(ch),
            _ if push_control_escape(&mut out, ch) => {}
            _ => {
                out.push(ch);
            }
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
        _ => "/* unsupported operator */",
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
        _ => "/* unsupported operator */",
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
        _ => "/* unsupported operator */",
    }
}

pub(crate) fn unary_postfix_op_str(op: UnaryPostfixOp) -> &'static str {
    match op {
        UnaryPostfixOp::PostIncrement => "++",
        UnaryPostfixOp::PostDecrement => "--",
        _ => "/* unsupported operator */",
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
        _ => "/* unsupported cast */ ",
    }
}

pub(crate) fn include_kind_str(kind: IncludeKind) -> &'static str {
    match kind {
        IncludeKind::Include => "include",
        IncludeKind::IncludeOnce => "include_once",
        IncludeKind::Require => "require",
        IncludeKind::RequireOnce => "require_once",
        _ => "/* unsupported include */",
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
        _ => "/* unsupported constant */",
    }
}

pub(crate) fn visibility_str(vis: Visibility) -> &'static str {
    match vis {
        Visibility::Public => "public",
        Visibility::Protected => "protected",
        Visibility::Private => "private",
        _ => "/* unsupported visibility */",
    }
}
