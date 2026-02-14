use logos::Logos;

fn lex_single_quoted_string(lex: &mut logos::Lexer<TokenKind>) -> bool {
    let remainder = lex.remainder();
    let mut chars = remainder.chars();
    loop {
        match chars.next() {
            Some('\\') => {
                chars.next(); // skip escaped char
            }
            Some('\'') => {
                let consumed = remainder.len() - chars.as_str().len();
                lex.bump(consumed);
                return true;
            }
            Some(_) => {}
            None => return false,
        }
    }
}

fn lex_double_quoted_string(lex: &mut logos::Lexer<TokenKind>) -> bool {
    let remainder = lex.remainder();
    let mut chars = remainder.chars();
    loop {
        match chars.next() {
            Some('\\') => {
                chars.next(); // skip escaped char
            }
            Some('"') => {
                let consumed = remainder.len() - chars.as_str().len();
                lex.bump(consumed);
                return true;
            }
            Some(_) => {}
            None => return false,
        }
    }
}

fn lex_backtick_string(lex: &mut logos::Lexer<TokenKind>) -> bool {
    let remainder = lex.remainder();
    let mut chars = remainder.chars();
    loop {
        match chars.next() {
            Some('\\') => {
                chars.next(); // skip escaped char
            }
            Some('`') => {
                let consumed = remainder.len() - chars.as_str().len();
                lex.bump(consumed);
                return true;
            }
            Some(_) => {}
            None => return false,
        }
    }
}

#[derive(Logos, Debug, Clone, Copy, PartialEq, Eq, Hash)]
#[logos(skip r"[ \t\r\n\f]+")]
#[logos(skip r"//[^\n]*")]
#[logos(skip r"#([^\[\n][^\n]*)?(\n)?")]
#[logos(skip r"/\*[^*]*\*+(?:[^/*][^*]*\*+)*/")]
pub enum TokenKind {
    // --- Literals ---
    // Float: scientific notation (with or without decimal)
    #[regex(
        r"[0-9](_?[0-9])*(\.[0-9](_?[0-9])*)?[eE][+-]?[0-9](_?[0-9])*",
        priority = 5
    )]
    FloatLiteral,

    // Float: decimal with digits on both sides
    #[regex(r"[0-9](_?[0-9])*\.[0-9](_?[0-9])*", priority = 4)]
    FloatLiteralSimple,

    // Float: decimal starting with dot (.0)
    #[regex(r"\.[0-9](_?[0-9])*([eE][+-]?[0-9](_?[0-9])*)?", priority = 4)]
    FloatLiteralLeadingDot,

    #[regex(r"0[xX][0-9a-fA-F](_?[0-9a-fA-F])*")]
    HexIntLiteral,

    #[regex(r"0[bB][01](_?[01])*")]
    BinIntLiteral,

    #[regex(r"0[oO][0-7](_?[0-7])*", priority = 4)]
    OctIntLiteralNew,

    #[regex(r"0[0-7]+", priority = 3)]
    OctIntLiteral,

    #[regex(r"[0-9](_?[0-9])*", priority = 1)]
    IntLiteral,

    // String literals (with optional binary prefix b/B)
    #[regex(r"[bB]?'", lex_single_quoted_string)]
    SingleQuotedString,

    #[regex(r#"[bB]?""#, lex_double_quoted_string)]
    DoubleQuotedString,

    #[token("`", lex_backtick_string)]
    BacktickString,

    // --- Variables ---
    #[regex(r"\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*")]
    Variable,
    #[token("$")]
    Dollar,

    // --- Identifiers (keywords resolved from these) ---
    #[regex(r"[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*")]
    Identifier,

    // --- Operators ---
    #[token("+")]
    Plus,
    #[token("-")]
    Minus,
    #[token("*")]
    Star,
    #[token("/")]
    Slash,
    #[token("%")]
    Percent,
    #[token("**")]
    StarStar,
    #[token(".")]
    Dot,

    #[token("=")]
    Equals,
    #[token("+=")]
    PlusEquals,
    #[token("-=")]
    MinusEquals,
    #[token("*=")]
    StarEquals,
    #[token("/=")]
    SlashEquals,
    #[token("%=")]
    PercentEquals,
    #[token("**=")]
    StarStarEquals,
    #[token(".=")]
    DotEquals,
    #[token("&=")]
    AmpersandEquals,
    #[token("|=")]
    PipeEquals,
    #[token("^=")]
    CaretEquals,
    #[token("<<=")]
    ShiftLeftEquals,
    #[token(">>=")]
    ShiftRightEquals,
    #[token("??=")]
    CoalesceEquals,

    #[token("==")]
    EqualsEquals,
    #[token("!=")]
    BangEquals,
    #[token("===")]
    EqualsEqualsEquals,
    #[token("!==")]
    BangEqualsEquals,
    #[token("<")]
    LessThan,
    #[token(">")]
    GreaterThan,
    #[token("<=")]
    LessThanEquals,
    #[token(">=")]
    GreaterThanEquals,
    #[token("<=>")]
    Spaceship,

    #[token("&&")]
    AmpersandAmpersand,
    #[token("||")]
    PipePipe,
    #[token("!")]
    Bang,

    #[token("&")]
    Ampersand,
    #[token("|")]
    Pipe,
    #[token("^")]
    Caret,
    #[token("~")]
    Tilde,
    #[token("<<")]
    ShiftLeft,
    #[token(">>")]
    ShiftRight,

    #[token("++")]
    PlusPlus,
    #[token("--")]
    MinusMinus,

    #[token("?")]
    Question,
    #[token("??")]
    QuestionQuestion,
    #[token(":")]
    Colon,

    #[token("=>")]
    FatArrow,

    #[token("|>")]
    PipeArrow,

    // --- Delimiters ---
    #[token("(")]
    LeftParen,
    #[token(")")]
    RightParen,
    #[token("[")]
    LeftBracket,
    #[token("]")]
    RightBracket,
    #[token("{")]
    LeftBrace,
    #[token("}")]
    RightBrace,
    #[token(";")]
    Semicolon,
    #[token(",")]
    Comma,

    #[token("::")]
    DoubleColon,

    #[token("->")]
    Arrow,

    #[token("?->")]
    NullsafeArrow,

    #[token("\\")]
    Backslash,

    #[token("@")]
    At,

    #[token("#[")]
    HashBracket,

    #[token("...")]
    Ellipsis,

    // --- Keywords (not matched by Logos directly, resolved from Identifier) ---
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
    #[token("<?php")]
    #[token("<?=")]
    OpenTag,

    #[token("?>")]
    CloseTag,

    // Inline HTML (not matched by Logos, produced by Lexer wrapper)
    InlineHtml,

    // Heredoc/Nowdoc (produced by Lexer wrapper, not by Logos)
    Heredoc,
    Nowdoc,

    // Invalid numeric literal (e.g. 1_0_0_ with trailing underscore)
    InvalidNumericLiteral,

    // End of file
    Eof,
}

impl TokenKind {
    pub fn is_assignment_op(&self) -> bool {
        matches!(
            self,
            TokenKind::Equals
                | TokenKind::PlusEquals
                | TokenKind::MinusEquals
                | TokenKind::StarEquals
                | TokenKind::SlashEquals
                | TokenKind::PercentEquals
                | TokenKind::StarStarEquals
                | TokenKind::DotEquals
                | TokenKind::AmpersandEquals
                | TokenKind::PipeEquals
                | TokenKind::CaretEquals
                | TokenKind::ShiftLeftEquals
                | TokenKind::ShiftRightEquals
                | TokenKind::CoalesceEquals
        )
    }
}

/// Resolve a keyword from an identifier string. Returns the keyword TokenKind
/// if the string is a keyword, or None if it's a plain identifier.
pub fn resolve_keyword(text: &str) -> Option<TokenKind> {
    // PHP keywords are case-insensitive
    match text.to_ascii_lowercase().as_str() {
        "if" => Some(TokenKind::If),
        "else" => Some(TokenKind::Else),
        "elseif" => Some(TokenKind::ElseIf),
        "while" => Some(TokenKind::While),
        "do" => Some(TokenKind::Do),
        "for" => Some(TokenKind::For),
        "foreach" => Some(TokenKind::Foreach),
        "as" => Some(TokenKind::As),
        "function" => Some(TokenKind::Function),
        "return" => Some(TokenKind::Return),
        "echo" => Some(TokenKind::Echo),
        "print" => Some(TokenKind::Print),
        "true" => Some(TokenKind::True),
        "false" => Some(TokenKind::False),
        "null" => Some(TokenKind::Null),
        "and" => Some(TokenKind::And),
        "or" => Some(TokenKind::Or),
        "xor" => Some(TokenKind::Xor),
        "break" => Some(TokenKind::Break),
        "continue" => Some(TokenKind::Continue),
        "switch" => Some(TokenKind::Switch),
        "case" => Some(TokenKind::Case),
        "default" => Some(TokenKind::Default),
        "endif" => Some(TokenKind::EndIf),
        "endwhile" => Some(TokenKind::EndWhile),
        "endfor" => Some(TokenKind::EndFor),
        "endforeach" => Some(TokenKind::EndForeach),
        "throw" => Some(TokenKind::Throw),
        "try" => Some(TokenKind::Try),
        "catch" => Some(TokenKind::Catch),
        "finally" => Some(TokenKind::Finally),
        "instanceof" => Some(TokenKind::Instanceof),
        "array" => Some(TokenKind::Array),
        "list" => Some(TokenKind::List),
        "goto" => Some(TokenKind::Goto),
        "declare" => Some(TokenKind::Declare),
        "unset" => Some(TokenKind::Unset),
        "global" => Some(TokenKind::Global),
        "enddeclare" => Some(TokenKind::EndDeclare),
        "endswitch" => Some(TokenKind::EndSwitch),
        "isset" => Some(TokenKind::Isset),
        "empty" => Some(TokenKind::Empty),
        "include" => Some(TokenKind::Include),
        "include_once" => Some(TokenKind::IncludeOnce),
        "require" => Some(TokenKind::Require),
        "require_once" => Some(TokenKind::RequireOnce),
        "eval" => Some(TokenKind::Eval),
        "exit" => Some(TokenKind::Exit),
        "die" => Some(TokenKind::Die),
        "clone" => Some(TokenKind::Clone),
        "new" => Some(TokenKind::New),
        "class" => Some(TokenKind::Class),
        "abstract" => Some(TokenKind::Abstract),
        "final" => Some(TokenKind::Final),
        "interface" => Some(TokenKind::Interface),
        "trait" => Some(TokenKind::Trait),
        "extends" => Some(TokenKind::Extends),
        "implements" => Some(TokenKind::Implements),
        "public" => Some(TokenKind::Public),
        "protected" => Some(TokenKind::Protected),
        "private" => Some(TokenKind::Private),
        "static" => Some(TokenKind::Static),
        "const" => Some(TokenKind::Const),
        "fn" => Some(TokenKind::Fn_),
        "match" => Some(TokenKind::Match_),
        "namespace" => Some(TokenKind::Namespace),
        "use" => Some(TokenKind::Use),
        "readonly" => Some(TokenKind::Readonly),
        "enum" => Some(TokenKind::Enum_),
        "yield" => Some(TokenKind::Yield_),
        "from" => Some(TokenKind::From),
        "self" => Some(TokenKind::Self_),
        "parent" => Some(TokenKind::Parent_),
        "__class__" => Some(TokenKind::MagicClass),
        "__dir__" => Some(TokenKind::MagicDir),
        "__file__" => Some(TokenKind::MagicFile),
        "__function__" => Some(TokenKind::MagicFunction),
        "__line__" => Some(TokenKind::MagicLine),
        "__method__" => Some(TokenKind::MagicMethod),
        "__namespace__" => Some(TokenKind::MagicNamespace),
        "__trait__" => Some(TokenKind::MagicTrait),
        "__property__" => Some(TokenKind::MagicProperty),
        "__halt_compiler" => Some(TokenKind::HaltCompiler),
        _ => None,
    }
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

    #[test]
    fn test_logos_basic_tokens() {
        let mut lex = TokenKind::lexer("+ - * / % ** .");
        assert_eq!(lex.next(), Some(Ok(TokenKind::Plus)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::Minus)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::Star)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::Slash)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::Percent)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::StarStar)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::Dot)));
        assert_eq!(lex.next(), None);
    }

    #[test]
    fn test_logos_integers() {
        let mut lex = TokenKind::lexer("42 0xFF 0b1010 077");
        assert_eq!(lex.next(), Some(Ok(TokenKind::IntLiteral)));
        assert_eq!(lex.slice(), "42");
        assert_eq!(lex.next(), Some(Ok(TokenKind::HexIntLiteral)));
        assert_eq!(lex.slice(), "0xFF");
        assert_eq!(lex.next(), Some(Ok(TokenKind::BinIntLiteral)));
        assert_eq!(lex.slice(), "0b1010");
        assert_eq!(lex.next(), Some(Ok(TokenKind::OctIntLiteral)));
        assert_eq!(lex.slice(), "077");
    }

    #[test]
    fn test_logos_floats() {
        let mut lex = TokenKind::lexer("3.14 1e10 2.5e-3");
        assert_eq!(lex.next(), Some(Ok(TokenKind::FloatLiteralSimple)));
        assert_eq!(lex.slice(), "3.14");
        assert_eq!(lex.next(), Some(Ok(TokenKind::FloatLiteral)));
        assert_eq!(lex.slice(), "1e10");
        assert_eq!(lex.next(), Some(Ok(TokenKind::FloatLiteral)));
        assert_eq!(lex.slice(), "2.5e-3");
    }

    #[test]
    fn test_logos_strings() {
        let mut lex = TokenKind::lexer(r#"'hello' "world" 'it\'s' "say \"hi\"""#);
        assert_eq!(lex.next(), Some(Ok(TokenKind::SingleQuotedString)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::DoubleQuotedString)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::SingleQuotedString)));
        assert_eq!(lex.next(), Some(Ok(TokenKind::DoubleQuotedString)));
    }

    #[test]
    fn test_logos_variable() {
        let mut lex = TokenKind::lexer("$x $myVar $_foo");
        assert_eq!(lex.next(), Some(Ok(TokenKind::Variable)));
        assert_eq!(lex.slice(), "$x");
        assert_eq!(lex.next(), Some(Ok(TokenKind::Variable)));
        assert_eq!(lex.slice(), "$myVar");
        assert_eq!(lex.next(), Some(Ok(TokenKind::Variable)));
        assert_eq!(lex.slice(), "$_foo");
    }

    #[test]
    fn test_logos_comments_skipped() {
        let mut lex = TokenKind::lexer("42 // line comment\n43 /* block */ 44 # hash comment\n45");
        assert_eq!(lex.next(), Some(Ok(TokenKind::IntLiteral)));
        assert_eq!(lex.slice(), "42");
        assert_eq!(lex.next(), Some(Ok(TokenKind::IntLiteral)));
        assert_eq!(lex.slice(), "43");
        assert_eq!(lex.next(), Some(Ok(TokenKind::IntLiteral)));
        assert_eq!(lex.slice(), "44");
        assert_eq!(lex.next(), Some(Ok(TokenKind::IntLiteral)));
        assert_eq!(lex.slice(), "45");
    }
}
