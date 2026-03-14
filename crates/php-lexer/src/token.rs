#[repr(u8)]
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
pub enum TokenKind {
    // --- Literals ---
    // Float: scientific notation (with or without decimal)
    FloatLiteral,

    // Float: decimal with digits on both sides
    FloatLiteralSimple,

    // Float: decimal starting with dot (.0)
    FloatLiteralLeadingDot,

    HexIntLiteral,

    BinIntLiteral,

    OctIntLiteralNew,

    OctIntLiteral,

    IntLiteral,

    // String literals (with optional binary prefix b/B)
    SingleQuotedString,

    DoubleQuotedString,

    BacktickString,

    // --- Variables ---
    Variable,
    Dollar,

    // --- Identifiers (keywords resolved from these) ---
    Identifier,

    // --- Operators ---
    Plus,
    Minus,
    Star,
    Slash,
    Percent,
    StarStar,
    Dot,

    Equals,
    PlusEquals,
    MinusEquals,
    StarEquals,
    SlashEquals,
    PercentEquals,
    StarStarEquals,
    DotEquals,
    AmpersandEquals,
    PipeEquals,
    CaretEquals,
    ShiftLeftEquals,
    ShiftRightEquals,
    CoalesceEquals,

    EqualsEquals,
    BangEquals,
    EqualsEqualsEquals,
    BangEqualsEquals,
    LessThan,
    GreaterThan,
    LessThanEquals,
    GreaterThanEquals,
    Spaceship,

    AmpersandAmpersand,
    PipePipe,
    Bang,

    Ampersand,
    Pipe,
    Caret,
    Tilde,
    ShiftLeft,
    ShiftRight,

    PlusPlus,
    MinusMinus,

    Question,
    QuestionQuestion,
    Colon,

    FatArrow,

    PipeArrow,

    // --- Delimiters ---
    LeftParen,
    RightParen,
    LeftBracket,
    RightBracket,
    LeftBrace,
    RightBrace,
    Semicolon,
    Comma,

    DoubleColon,

    Arrow,

    NullsafeArrow,

    Backslash,

    At,

    HashBracket,

    Ellipsis,

    // --- Keywords (resolved from Identifier) ---
    If,
    Else,
    ElseIf,
    While,
    Do,
    For,
    Foreach,
    As,
    Function,
    Return,
    Echo,
    Print,
    True,
    False,
    Null,
    And,
    Or,
    Xor,
    Break,
    Continue,
    Switch,
    Case,
    Default,
    EndIf,
    EndWhile,
    EndFor,
    EndForeach,
    Throw,
    Try,
    Catch,
    Finally,
    Instanceof,
    Array,
    List,
    Goto,
    Declare,
    Unset,
    Global,
    EndDeclare,
    EndSwitch,
    Isset,
    Empty,
    Include,
    IncludeOnce,
    Require,
    RequireOnce,
    Eval,
    Exit,
    Die,
    Clone,
    // OOP keywords
    New,
    Class,
    Abstract,
    Final,
    Interface,
    Trait,
    Extends,
    Implements,
    Public,
    Protected,
    Private,
    Static,
    Const,
    Fn_,
    Match_,
    Namespace,
    Use,
    Readonly,
    Enum_,
    Yield_,
    From,
    Self_,
    Parent_,
    // Magic constants
    MagicClass,
    MagicDir,
    MagicFile,
    MagicFunction,
    MagicLine,
    MagicMethod,
    MagicNamespace,
    MagicTrait,
    MagicProperty,
    HaltCompiler,

    // --- PHP tags ---
    OpenTag,

    CloseTag,

    // Inline HTML (produced by Lexer wrapper)
    InlineHtml,

    // Heredoc/Nowdoc (produced by Lexer wrapper)
    Heredoc,
    Nowdoc,

    // Invalid numeric literal (e.g. 1_0_0_ with trailing underscore)
    InvalidNumericLiteral,

    // End of file
    Eof,
}

impl TokenKind {
    #[inline(always)]
    pub fn is_assignment_op(self) -> bool {
        // The assignment operators are contiguous in the enum definition:
        // Equals..=CoalesceEquals. With #[repr(u8)], a single range check suffices.
        (self as u8).wrapping_sub(TokenKind::Equals as u8)
            <= (TokenKind::CoalesceEquals as u8 - TokenKind::Equals as u8)
    }
}

/// Match pre-lowercased bytes against known PHP keywords.
/// Dispatches on length first, then uses plain byte equality (`==`).
#[inline]
pub(crate) fn resolve_keyword_lower(lower: &[u8]) -> Option<TokenKind> {
    match lower.len() {
        2 => match lower {
            b"if" => Some(TokenKind::If),
            b"do" => Some(TokenKind::Do),
            b"or" => Some(TokenKind::Or),
            b"as" => Some(TokenKind::As),
            b"fn" => Some(TokenKind::Fn_),
            _ => None,
        },
        3 => match lower {
            b"for" => Some(TokenKind::For),
            b"xor" => Some(TokenKind::Xor),
            b"and" => Some(TokenKind::And),
            b"new" => Some(TokenKind::New),
            b"use" => Some(TokenKind::Use),
            b"try" => Some(TokenKind::Try),
            b"die" => Some(TokenKind::Die),
            _ => None,
        },
        4 => match lower {
            b"else" => Some(TokenKind::Else),
            b"echo" => Some(TokenKind::Echo),
            b"true" => Some(TokenKind::True),
            b"null" => Some(TokenKind::Null),
            b"list" => Some(TokenKind::List),
            b"goto" => Some(TokenKind::Goto),
            b"case" => Some(TokenKind::Case),
            b"self" => Some(TokenKind::Self_),
            b"from" => Some(TokenKind::From),
            b"enum" => Some(TokenKind::Enum_),
            b"eval" => Some(TokenKind::Eval),
            b"exit" => Some(TokenKind::Exit),
            _ => None,
        },
        5 => match lower {
            b"while" => Some(TokenKind::While),
            b"false" => Some(TokenKind::False),
            b"array" => Some(TokenKind::Array),
            b"unset" => Some(TokenKind::Unset),
            b"isset" => Some(TokenKind::Isset),
            b"empty" => Some(TokenKind::Empty),
            b"print" => Some(TokenKind::Print),
            b"throw" => Some(TokenKind::Throw),
            b"catch" => Some(TokenKind::Catch),
            b"break" => Some(TokenKind::Break),
            b"yield" => Some(TokenKind::Yield_),
            b"class" => Some(TokenKind::Class),
            b"const" => Some(TokenKind::Const),
            b"final" => Some(TokenKind::Final),
            b"match" => Some(TokenKind::Match_),
            b"trait" => Some(TokenKind::Trait),
            b"clone" => Some(TokenKind::Clone),
            b"endif" => Some(TokenKind::EndIf),
            _ => None,
        },
        6 => match lower {
            b"elseif" => Some(TokenKind::ElseIf),
            b"return" => Some(TokenKind::Return),
            b"switch" => Some(TokenKind::Switch),
            b"global" => Some(TokenKind::Global),
            b"static" => Some(TokenKind::Static),
            b"public" => Some(TokenKind::Public),
            b"parent" => Some(TokenKind::Parent_),
            b"endfor" => Some(TokenKind::EndFor),
            _ => None,
        },
        7 => match lower {
            b"foreach" => Some(TokenKind::Foreach),
            b"default" => Some(TokenKind::Default),
            b"finally" => Some(TokenKind::Finally),
            b"include" => Some(TokenKind::Include),
            b"declare" => Some(TokenKind::Declare),
            b"extends" => Some(TokenKind::Extends),
            b"require" => Some(TokenKind::Require),
            b"private" => Some(TokenKind::Private),
            b"__dir__" => Some(TokenKind::MagicDir),
            _ => None,
        },
        8 => match lower {
            b"function" => Some(TokenKind::Function),
            b"abstract" => Some(TokenKind::Abstract),
            b"readonly" => Some(TokenKind::Readonly),
            b"continue" => Some(TokenKind::Continue),
            b"endwhile" => Some(TokenKind::EndWhile),
            b"__file__" => Some(TokenKind::MagicFile),
            b"__line__" => Some(TokenKind::MagicLine),
            _ => None,
        },
        9 => match lower {
            b"namespace" => Some(TokenKind::Namespace),
            b"interface" => Some(TokenKind::Interface),
            b"protected" => Some(TokenKind::Protected),
            b"endswitch" => Some(TokenKind::EndSwitch),
            b"__class__" => Some(TokenKind::MagicClass),
            b"__trait__" => Some(TokenKind::MagicTrait),
            _ => None,
        },
        10 => match lower {
            b"implements" => Some(TokenKind::Implements),
            b"instanceof" => Some(TokenKind::Instanceof),
            b"endforeach" => Some(TokenKind::EndForeach),
            b"enddeclare" => Some(TokenKind::EndDeclare),
            b"__method__" => Some(TokenKind::MagicMethod),
            _ => None,
        },
        12 => match lower {
            b"include_once" => Some(TokenKind::IncludeOnce),
            b"require_once" => Some(TokenKind::RequireOnce),
            b"__function__" => Some(TokenKind::MagicFunction),
            b"__property__" => Some(TokenKind::MagicProperty),
            _ => None,
        },
        13 => match lower {
            b"__namespace__" => Some(TokenKind::MagicNamespace),
            _ => None,
        },
        15 => match lower {
            b"__halt_compiler" => Some(TokenKind::HaltCompiler),
            _ => None,
        },
        _ => None,
    }
}

/// Resolve a keyword from an identifier string. Returns the keyword TokenKind
/// if the string is a keyword, or None if it's a plain identifier.
///
/// PHP keywords are case-insensitive. Lowercases into a stack buffer (no heap
/// allocation) then delegates to `resolve_keyword_lower` for plain `==` matching.
///
/// In the hot path, callers should prefer passing already-lowercased bytes
/// directly to `resolve_keyword_lower` to avoid the extra lowercasing step.
#[inline]
pub fn resolve_keyword(text: &str) -> Option<TokenKind> {
    let len = text.len();
    if !(2..=15).contains(&len) {
        return None;
    }
    let mut lower = [0u8; 15];
    for (dst, src) in lower[..len].iter_mut().zip(text.bytes()) {
        *dst = src.to_ascii_lowercase();
    }
    resolve_keyword_lower(&lower[..len])
}

impl std::fmt::Display for TokenKind {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        match self {
            TokenKind::IntLiteral => write!(f, "integer"),
            TokenKind::HexIntLiteral => write!(f, "hex integer"),
            TokenKind::BinIntLiteral => write!(f, "binary integer"),
            TokenKind::OctIntLiteral | TokenKind::OctIntLiteralNew => write!(f, "octal integer"),
            TokenKind::FloatLiteral
            | TokenKind::FloatLiteralSimple
            | TokenKind::FloatLiteralLeadingDot => write!(f, "float"),
            TokenKind::SingleQuotedString | TokenKind::DoubleQuotedString => write!(f, "string"),
            TokenKind::BacktickString => write!(f, "backtick string"),
            TokenKind::Variable => write!(f, "variable"),
            TokenKind::Dollar => write!(f, "'$'"),
            TokenKind::Identifier => write!(f, "identifier"),
            TokenKind::Plus => write!(f, "'+'"),
            TokenKind::Minus => write!(f, "'-'"),
            TokenKind::Star => write!(f, "'*'"),
            TokenKind::Slash => write!(f, "'/'"),
            TokenKind::Percent => write!(f, "'%'"),
            TokenKind::StarStar => write!(f, "'**'"),
            TokenKind::Dot => write!(f, "'.'"),
            TokenKind::Equals => write!(f, "'='"),
            TokenKind::PlusEquals => write!(f, "'+='"),
            TokenKind::MinusEquals => write!(f, "'-='"),
            TokenKind::StarEquals => write!(f, "'*='"),
            TokenKind::SlashEquals => write!(f, "'/='"),
            TokenKind::PercentEquals => write!(f, "'%='"),
            TokenKind::StarStarEquals => write!(f, "'**='"),
            TokenKind::DotEquals => write!(f, "'.='"),
            TokenKind::AmpersandEquals => write!(f, "'&='"),
            TokenKind::PipeEquals => write!(f, "'|='"),
            TokenKind::CaretEquals => write!(f, "'^='"),
            TokenKind::ShiftLeftEquals => write!(f, "'<<='"),
            TokenKind::ShiftRightEquals => write!(f, "'>>='"),
            TokenKind::CoalesceEquals => write!(f, "'??='"),
            TokenKind::EqualsEquals => write!(f, "'=='"),
            TokenKind::BangEquals => write!(f, "'!='"),
            TokenKind::EqualsEqualsEquals => write!(f, "'==='"),
            TokenKind::BangEqualsEquals => write!(f, "'!=='"),
            TokenKind::LessThan => write!(f, "'<'"),
            TokenKind::GreaterThan => write!(f, "'>'"),
            TokenKind::LessThanEquals => write!(f, "'<='"),
            TokenKind::GreaterThanEquals => write!(f, "'>='"),
            TokenKind::Spaceship => write!(f, "'<=>'"),
            TokenKind::AmpersandAmpersand => write!(f, "'&&'"),
            TokenKind::PipePipe => write!(f, "'||'"),
            TokenKind::Bang => write!(f, "'!'"),
            TokenKind::Ampersand => write!(f, "'&'"),
            TokenKind::Pipe => write!(f, "'|'"),
            TokenKind::Caret => write!(f, "'^'"),
            TokenKind::Tilde => write!(f, "'~'"),
            TokenKind::ShiftLeft => write!(f, "'<<'"),
            TokenKind::ShiftRight => write!(f, "'>>'"),
            TokenKind::PlusPlus => write!(f, "'++'"),
            TokenKind::MinusMinus => write!(f, "'--'"),
            TokenKind::Question => write!(f, "'?'"),
            TokenKind::QuestionQuestion => write!(f, "'??'"),
            TokenKind::Colon => write!(f, "':'"),
            TokenKind::FatArrow => write!(f, "'=>'"),
            TokenKind::PipeArrow => write!(f, "'|>'"),
            TokenKind::LeftParen => write!(f, "'('"),
            TokenKind::RightParen => write!(f, "')'"),
            TokenKind::LeftBracket => write!(f, "'['"),
            TokenKind::RightBracket => write!(f, "']'"),
            TokenKind::LeftBrace => write!(f, "'{{'"),
            TokenKind::RightBrace => write!(f, "'}}'"),
            TokenKind::Semicolon => write!(f, "';'"),
            TokenKind::Comma => write!(f, "','"),
            TokenKind::DoubleColon => write!(f, "'::'"),
            TokenKind::Arrow => write!(f, "'->'"),
            TokenKind::NullsafeArrow => write!(f, "'?->'"),
            TokenKind::Backslash => write!(f, "'\\'"),
            TokenKind::At => write!(f, "'@'"),
            TokenKind::HashBracket => write!(f, "'#['"),
            TokenKind::Ellipsis => write!(f, "'...'"),
            TokenKind::If => write!(f, "'if'"),
            TokenKind::Else => write!(f, "'else'"),
            TokenKind::ElseIf => write!(f, "'elseif'"),
            TokenKind::While => write!(f, "'while'"),
            TokenKind::Do => write!(f, "'do'"),
            TokenKind::For => write!(f, "'for'"),
            TokenKind::Foreach => write!(f, "'foreach'"),
            TokenKind::As => write!(f, "'as'"),
            TokenKind::Function => write!(f, "'function'"),
            TokenKind::Return => write!(f, "'return'"),
            TokenKind::Echo => write!(f, "'echo'"),
            TokenKind::Print => write!(f, "'print'"),
            TokenKind::True => write!(f, "'true'"),
            TokenKind::False => write!(f, "'false'"),
            TokenKind::Null => write!(f, "'null'"),
            TokenKind::And => write!(f, "'and'"),
            TokenKind::Or => write!(f, "'or'"),
            TokenKind::Xor => write!(f, "'xor'"),
            TokenKind::Break => write!(f, "'break'"),
            TokenKind::Continue => write!(f, "'continue'"),
            TokenKind::Switch => write!(f, "'switch'"),
            TokenKind::Case => write!(f, "'case'"),
            TokenKind::Default => write!(f, "'default'"),
            TokenKind::EndIf => write!(f, "'endif'"),
            TokenKind::EndWhile => write!(f, "'endwhile'"),
            TokenKind::EndFor => write!(f, "'endfor'"),
            TokenKind::EndForeach => write!(f, "'endforeach'"),
            TokenKind::Throw => write!(f, "'throw'"),
            TokenKind::Try => write!(f, "'try'"),
            TokenKind::Catch => write!(f, "'catch'"),
            TokenKind::Finally => write!(f, "'finally'"),
            TokenKind::Instanceof => write!(f, "'instanceof'"),
            TokenKind::Array => write!(f, "'array'"),
            TokenKind::List => write!(f, "'list'"),
            TokenKind::Goto => write!(f, "'goto'"),
            TokenKind::Declare => write!(f, "'declare'"),
            TokenKind::Unset => write!(f, "'unset'"),
            TokenKind::Global => write!(f, "'global'"),
            TokenKind::EndDeclare => write!(f, "'enddeclare'"),
            TokenKind::EndSwitch => write!(f, "'endswitch'"),
            TokenKind::Isset => write!(f, "'isset'"),
            TokenKind::Empty => write!(f, "'empty'"),
            TokenKind::Include => write!(f, "'include'"),
            TokenKind::IncludeOnce => write!(f, "'include_once'"),
            TokenKind::Require => write!(f, "'require'"),
            TokenKind::RequireOnce => write!(f, "'require_once'"),
            TokenKind::Eval => write!(f, "'eval'"),
            TokenKind::Exit => write!(f, "'exit'"),
            TokenKind::Die => write!(f, "'die'"),
            TokenKind::Clone => write!(f, "'clone'"),
            TokenKind::New => write!(f, "'new'"),
            TokenKind::Class => write!(f, "'class'"),
            TokenKind::Abstract => write!(f, "'abstract'"),
            TokenKind::Final => write!(f, "'final'"),
            TokenKind::Interface => write!(f, "'interface'"),
            TokenKind::Trait => write!(f, "'trait'"),
            TokenKind::Extends => write!(f, "'extends'"),
            TokenKind::Implements => write!(f, "'implements'"),
            TokenKind::Public => write!(f, "'public'"),
            TokenKind::Protected => write!(f, "'protected'"),
            TokenKind::Private => write!(f, "'private'"),
            TokenKind::Static => write!(f, "'static'"),
            TokenKind::Const => write!(f, "'const'"),
            TokenKind::Fn_ => write!(f, "'fn'"),
            TokenKind::Match_ => write!(f, "'match'"),
            TokenKind::Namespace => write!(f, "'namespace'"),
            TokenKind::Use => write!(f, "'use'"),
            TokenKind::Readonly => write!(f, "'readonly'"),
            TokenKind::Enum_ => write!(f, "'enum'"),
            TokenKind::Yield_ => write!(f, "'yield'"),
            TokenKind::From => write!(f, "'from'"),
            TokenKind::Self_ => write!(f, "'self'"),
            TokenKind::Parent_ => write!(f, "'parent'"),
            TokenKind::MagicClass => write!(f, "'__CLASS__'"),
            TokenKind::MagicDir => write!(f, "'__DIR__'"),
            TokenKind::MagicFile => write!(f, "'__FILE__'"),
            TokenKind::MagicFunction => write!(f, "'__FUNCTION__'"),
            TokenKind::MagicLine => write!(f, "'__LINE__'"),
            TokenKind::MagicMethod => write!(f, "'__METHOD__'"),
            TokenKind::MagicNamespace => write!(f, "'__NAMESPACE__'"),
            TokenKind::MagicTrait => write!(f, "'__TRAIT__'"),
            TokenKind::MagicProperty => write!(f, "'__PROPERTY__'"),
            TokenKind::HaltCompiler => write!(f, "'__halt_compiler'"),
            TokenKind::OpenTag => write!(f, "'<?php'"),
            TokenKind::CloseTag => write!(f, "'?>'"),
            TokenKind::InlineHtml => write!(f, "inline HTML"),
            TokenKind::Heredoc => write!(f, "heredoc"),
            TokenKind::Nowdoc => write!(f, "nowdoc"),
            TokenKind::InvalidNumericLiteral => write!(f, "invalid numeric literal"),
            TokenKind::Eof => write!(f, "end of file"),
        }
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_resolve_keyword() {
        assert_eq!(resolve_keyword("if"), Some(TokenKind::If));
        assert_eq!(resolve_keyword("IF"), Some(TokenKind::If));
        assert_eq!(resolve_keyword("If"), Some(TokenKind::If));
        assert_eq!(resolve_keyword("function"), Some(TokenKind::Function));
        assert_eq!(resolve_keyword("myFunc"), None);
        assert_eq!(resolve_keyword("true"), Some(TokenKind::True));
        assert_eq!(resolve_keyword("TRUE"), Some(TokenKind::True));
        assert_eq!(resolve_keyword("null"), Some(TokenKind::Null));
    }

    #[test]
    fn test_is_assignment_op() {
        assert!(TokenKind::Equals.is_assignment_op());
        assert!(TokenKind::PlusEquals.is_assignment_op());
        assert!(TokenKind::DotEquals.is_assignment_op());
        assert!(!TokenKind::Plus.is_assignment_op());
        assert!(!TokenKind::EqualsEquals.is_assignment_op());
    }
}
