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

    // Comments (yielded by the lexer; filtered out by the parser into a side-table)
    /// `// …` single-line slash comment
    LineComment,
    /// `# …` single-line hash comment
    HashComment,
    /// `/* … */` block comment
    BlockComment,
    /// `/** … */` doc-block comment
    DocComment,

    // End of file
    Eof,
}

impl TokenKind {
    /// Returns `true` for the four comment-token variants.
    #[inline]
    pub fn is_comment(self) -> bool {
        matches!(
            self,
            TokenKind::LineComment
                | TokenKind::HashComment
                | TokenKind::BlockComment
                | TokenKind::DocComment
        )
    }
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

/// Resolve a keyword from an identifier string. Returns the keyword TokenKind
/// if the string is a keyword, or None if it's a plain identifier.
pub fn resolve_keyword(text: &str) -> Option<TokenKind> {
    // PHP keywords are case-insensitive; use eq_ignore_ascii_case to avoid allocation.
    // Dispatch on length first to reduce comparisons.
    let t = text;
    match text.len() {
        2 => {
            if t.eq_ignore_ascii_case("if") {
                return Some(TokenKind::If);
            }
            if t.eq_ignore_ascii_case("do") {
                return Some(TokenKind::Do);
            }
            if t.eq_ignore_ascii_case("or") {
                return Some(TokenKind::Or);
            }
            if t.eq_ignore_ascii_case("as") {
                return Some(TokenKind::As);
            }
            if t.eq_ignore_ascii_case("fn") {
                return Some(TokenKind::Fn_);
            }
        }
        3 => {
            if t.eq_ignore_ascii_case("for") {
                return Some(TokenKind::For);
            }
            if t.eq_ignore_ascii_case("xor") {
                return Some(TokenKind::Xor);
            }
            if t.eq_ignore_ascii_case("and") {
                return Some(TokenKind::And);
            }
            if t.eq_ignore_ascii_case("new") {
                return Some(TokenKind::New);
            }
            if t.eq_ignore_ascii_case("use") {
                return Some(TokenKind::Use);
            }
            if t.eq_ignore_ascii_case("try") {
                return Some(TokenKind::Try);
            }
            if t.eq_ignore_ascii_case("die") {
                return Some(TokenKind::Die);
            }
        }
        4 => {
            if t.eq_ignore_ascii_case("else") {
                return Some(TokenKind::Else);
            }
            if t.eq_ignore_ascii_case("echo") {
                return Some(TokenKind::Echo);
            }
            if t.eq_ignore_ascii_case("true") {
                return Some(TokenKind::True);
            }
            if t.eq_ignore_ascii_case("null") {
                return Some(TokenKind::Null);
            }
            if t.eq_ignore_ascii_case("list") {
                return Some(TokenKind::List);
            }
            if t.eq_ignore_ascii_case("goto") {
                return Some(TokenKind::Goto);
            }
            if t.eq_ignore_ascii_case("case") {
                return Some(TokenKind::Case);
            }
            if t.eq_ignore_ascii_case("self") {
                return Some(TokenKind::Self_);
            }
            if t.eq_ignore_ascii_case("from") {
                return Some(TokenKind::From);
            }
            if t.eq_ignore_ascii_case("enum") {
                return Some(TokenKind::Enum_);
            }
            if t.eq_ignore_ascii_case("eval") {
                return Some(TokenKind::Eval);
            }
            if t.eq_ignore_ascii_case("exit") {
                return Some(TokenKind::Exit);
            }
        }
        5 => {
            if t.eq_ignore_ascii_case("while") {
                return Some(TokenKind::While);
            }
            if t.eq_ignore_ascii_case("false") {
                return Some(TokenKind::False);
            }
            if t.eq_ignore_ascii_case("array") {
                return Some(TokenKind::Array);
            }
            if t.eq_ignore_ascii_case("unset") {
                return Some(TokenKind::Unset);
            }
            if t.eq_ignore_ascii_case("isset") {
                return Some(TokenKind::Isset);
            }
            if t.eq_ignore_ascii_case("empty") {
                return Some(TokenKind::Empty);
            }
            if t.eq_ignore_ascii_case("print") {
                return Some(TokenKind::Print);
            }
            if t.eq_ignore_ascii_case("throw") {
                return Some(TokenKind::Throw);
            }
            if t.eq_ignore_ascii_case("catch") {
                return Some(TokenKind::Catch);
            }
            if t.eq_ignore_ascii_case("break") {
                return Some(TokenKind::Break);
            }
            if t.eq_ignore_ascii_case("yield") {
                return Some(TokenKind::Yield_);
            }
            if t.eq_ignore_ascii_case("class") {
                return Some(TokenKind::Class);
            }
            if t.eq_ignore_ascii_case("const") {
                return Some(TokenKind::Const);
            }
            if t.eq_ignore_ascii_case("final") {
                return Some(TokenKind::Final);
            }
            if t.eq_ignore_ascii_case("match") {
                return Some(TokenKind::Match_);
            }
            if t.eq_ignore_ascii_case("trait") {
                return Some(TokenKind::Trait);
            }
            if t.eq_ignore_ascii_case("clone") {
                return Some(TokenKind::Clone);
            }
            if t.eq_ignore_ascii_case("endif") {
                return Some(TokenKind::EndIf);
            }
        }
        6 => {
            if t.eq_ignore_ascii_case("elseif") {
                return Some(TokenKind::ElseIf);
            }
            if t.eq_ignore_ascii_case("return") {
                return Some(TokenKind::Return);
            }
            if t.eq_ignore_ascii_case("switch") {
                return Some(TokenKind::Switch);
            }
            if t.eq_ignore_ascii_case("global") {
                return Some(TokenKind::Global);
            }
            if t.eq_ignore_ascii_case("static") {
                return Some(TokenKind::Static);
            }
            if t.eq_ignore_ascii_case("public") {
                return Some(TokenKind::Public);
            }
            if t.eq_ignore_ascii_case("parent") {
                return Some(TokenKind::Parent_);
            }
            if t.eq_ignore_ascii_case("endfor") {
                return Some(TokenKind::EndFor);
            }
        }
        7 => {
            if t.eq_ignore_ascii_case("foreach") {
                return Some(TokenKind::Foreach);
            }
            if t.eq_ignore_ascii_case("default") {
                return Some(TokenKind::Default);
            }
            if t.eq_ignore_ascii_case("finally") {
                return Some(TokenKind::Finally);
            }
            if t.eq_ignore_ascii_case("include") {
                return Some(TokenKind::Include);
            }
            if t.eq_ignore_ascii_case("declare") {
                return Some(TokenKind::Declare);
            }
            if t.eq_ignore_ascii_case("extends") {
                return Some(TokenKind::Extends);
            }
            if t.eq_ignore_ascii_case("require") {
                return Some(TokenKind::Require);
            }
            if t.eq_ignore_ascii_case("private") {
                return Some(TokenKind::Private);
            }
            if t.eq_ignore_ascii_case("__dir__") {
                return Some(TokenKind::MagicDir);
            }
        }
        8 => {
            if t.eq_ignore_ascii_case("function") {
                return Some(TokenKind::Function);
            }
            if t.eq_ignore_ascii_case("abstract") {
                return Some(TokenKind::Abstract);
            }
            if t.eq_ignore_ascii_case("readonly") {
                return Some(TokenKind::Readonly);
            }
            if t.eq_ignore_ascii_case("continue") {
                return Some(TokenKind::Continue);
            }
            if t.eq_ignore_ascii_case("endwhile") {
                return Some(TokenKind::EndWhile);
            }
            if t.eq_ignore_ascii_case("__file__") {
                return Some(TokenKind::MagicFile);
            }
            if t.eq_ignore_ascii_case("__line__") {
                return Some(TokenKind::MagicLine);
            }
        }
        9 => {
            if t.eq_ignore_ascii_case("namespace") {
                return Some(TokenKind::Namespace);
            }
            if t.eq_ignore_ascii_case("interface") {
                return Some(TokenKind::Interface);
            }
            if t.eq_ignore_ascii_case("protected") {
                return Some(TokenKind::Protected);
            }
            if t.eq_ignore_ascii_case("endswitch") {
                return Some(TokenKind::EndSwitch);
            }
            if t.eq_ignore_ascii_case("__class__") {
                return Some(TokenKind::MagicClass);
            }
            if t.eq_ignore_ascii_case("__trait__") {
                return Some(TokenKind::MagicTrait);
            }
        }
        10 => {
            if t.eq_ignore_ascii_case("implements") {
                return Some(TokenKind::Implements);
            }
            if t.eq_ignore_ascii_case("instanceof") {
                return Some(TokenKind::Instanceof);
            }
            if t.eq_ignore_ascii_case("endforeach") {
                return Some(TokenKind::EndForeach);
            }
            if t.eq_ignore_ascii_case("enddeclare") {
                return Some(TokenKind::EndDeclare);
            }
            if t.eq_ignore_ascii_case("__method__") {
                return Some(TokenKind::MagicMethod);
            }
        }
        12 => {
            if t.eq_ignore_ascii_case("include_once") {
                return Some(TokenKind::IncludeOnce);
            }
            if t.eq_ignore_ascii_case("require_once") {
                return Some(TokenKind::RequireOnce);
            }
            if t.eq_ignore_ascii_case("__function__") {
                return Some(TokenKind::MagicFunction);
            }
            if t.eq_ignore_ascii_case("__property__") {
                return Some(TokenKind::MagicProperty);
            }
        }
        13 if t.eq_ignore_ascii_case("__namespace__") => {
            return Some(TokenKind::MagicNamespace);
        }
        15 if t.eq_ignore_ascii_case("__halt_compiler") => {
            return Some(TokenKind::HaltCompiler);
        }
        _ => {}
    }
    None
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
            TokenKind::LineComment => write!(f, "line comment"),
            TokenKind::HashComment => write!(f, "hash comment"),
            TokenKind::BlockComment => write!(f, "block comment"),
            TokenKind::DocComment => write!(f, "doc comment"),
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
