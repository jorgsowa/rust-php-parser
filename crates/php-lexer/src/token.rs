/// All token types produced by the PHP lexer.
///
/// The variants are grouped by category in source order; the `#[repr(u8)]`
/// guarantees a compact discriminant layout used by [`TokenKind::is_assignment_op`].
#[repr(u8)]
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
#[non_exhaustive]
pub enum TokenKind {
    // -------------------------------------------------------------------------
    // Literals
    // -------------------------------------------------------------------------
    /// Float in scientific notation: `1e10`, `1.5e-3`, `1E+10`.
    FloatLiteral,

    /// Float with digits on both sides of the decimal point: `1.5`, `0.0`.
    FloatLiteralSimple,

    /// Float starting with a leading dot: `.5`, `.001`.
    FloatLiteralLeadingDot,

    /// Hexadecimal integer literal: `0x1A`, `0xFF`.
    HexIntLiteral,

    /// Binary integer literal: `0b1010`, `0B0011`.
    BinIntLiteral,

    /// Octal integer literal in the new `0o` prefix form: `0o17` (PHP 8.1+).
    OctIntLiteralNew,

    /// Octal integer literal in the legacy leading-zero form: `017`.
    OctIntLiteral,

    /// Decimal integer literal: `0`, `42`, `1_000_000`.
    IntLiteral,

    /// Single-quoted string literal: `'hello'`. Optional `b`/`B` prefix allowed.
    SingleQuotedString,

    /// Double-quoted string literal: `"hello $name"`. Triggers interpolation processing.
    DoubleQuotedString,

    /// Backtick string (shell execution): `` `ls -la` ``.
    BacktickString,

    // -------------------------------------------------------------------------
    // Variables
    // -------------------------------------------------------------------------
    /// A `$`-prefixed variable name: `$foo`, `$myVar`.
    Variable,

    /// A bare `$` not followed by a valid identifier start (variable-variable prefix).
    Dollar,

    // -------------------------------------------------------------------------
    // Identifiers
    // -------------------------------------------------------------------------
    /// A bare identifier or keyword that has not yet been resolved.
    /// PHP keywords are case-insensitive and are resolved from this token.
    Identifier,

    // -------------------------------------------------------------------------
    // Arithmetic operators
    // -------------------------------------------------------------------------
    /// `+`
    Plus,
    /// `-`
    Minus,
    /// `*`
    Star,
    /// `/`
    Slash,
    /// `%`
    Percent,
    /// `**` — exponentiation.
    StarStar,
    /// `.` — string concatenation.
    Dot,

    // -------------------------------------------------------------------------
    // Assignment operators
    // -------------------------------------------------------------------------
    // NOTE: Equals..=CoalesceEquals must remain contiguous; is_assignment_op relies on this.
    /// `=`
    Equals,
    /// `+=`
    PlusEquals,
    /// `-=`
    MinusEquals,
    /// `*=`
    StarEquals,
    /// `/=`
    SlashEquals,
    /// `%=`
    PercentEquals,
    /// `**=`
    StarStarEquals,
    /// `.=`
    DotEquals,
    /// `&=`
    AmpersandEquals,
    /// `|=`
    PipeEquals,
    /// `^=`
    CaretEquals,
    /// `<<=`
    ShiftLeftEquals,
    /// `>>=`
    ShiftRightEquals,
    /// `??=`
    CoalesceEquals,

    // -------------------------------------------------------------------------
    // Comparison operators
    // -------------------------------------------------------------------------
    /// `==` — loose equality.
    EqualsEquals,
    /// `!=` or `<>` — loose inequality.
    BangEquals,
    /// `===` — strict equality.
    EqualsEqualsEquals,
    /// `!==` — strict inequality.
    BangEqualsEquals,
    /// `<`
    LessThan,
    /// `>`
    GreaterThan,
    /// `<=`
    LessThanEquals,
    /// `>=`
    GreaterThanEquals,
    /// `<=>` — spaceship / three-way comparison.
    Spaceship,

    // -------------------------------------------------------------------------
    // Logical / bitwise operators
    // -------------------------------------------------------------------------
    /// `&&` — short-circuit boolean AND.
    AmpersandAmpersand,
    /// `||` — short-circuit boolean OR.
    PipePipe,
    /// `!` — boolean NOT.
    Bang,

    /// `&` — bitwise AND (also reference marker in declarations).
    Ampersand,
    /// `|` — bitwise OR.
    Pipe,
    /// `^` — bitwise XOR.
    Caret,
    /// `~` — bitwise NOT.
    Tilde,
    /// `<<` — left bit-shift.
    ShiftLeft,
    /// `>>` — right bit-shift.
    ShiftRight,

    // -------------------------------------------------------------------------
    // Increment / decrement
    // -------------------------------------------------------------------------
    /// `++`
    PlusPlus,
    /// `--`
    MinusMinus,

    // -------------------------------------------------------------------------
    // Other operators
    // -------------------------------------------------------------------------
    /// `?` — ternary operator or nullable type-hint prefix.
    Question,
    /// `??` — null coalescing.
    QuestionQuestion,
    /// `:` — ternary separator, named argument separator, or return type separator.
    Colon,

    /// `=>` — key-value separator in arrays and `match` arms.
    FatArrow,

    /// `|>` — pipe operator (PHP 8.5+).
    PipeArrow,

    // -------------------------------------------------------------------------
    // Delimiters & punctuation
    // -------------------------------------------------------------------------
    /// `(`
    LeftParen,
    /// `)`
    RightParen,
    /// `[`
    LeftBracket,
    /// `]`
    RightBracket,
    /// `{`
    LeftBrace,
    /// `}`
    RightBrace,
    /// `;`
    Semicolon,
    /// `,`
    Comma,

    /// `::` — static access separator.
    DoubleColon,

    /// `->` — object property / method access.
    Arrow,

    /// `?->` — nullsafe property / method access.
    NullsafeArrow,

    /// `\` — namespace separator.
    Backslash,

    /// `@` — error-suppression operator.
    At,

    /// `#[` — attribute syntax opener.
    HashBracket,

    /// `...` — splat / variadic operator.
    Ellipsis,

    // -------------------------------------------------------------------------
    // Keywords (resolved from Identifier at lex time)
    // -------------------------------------------------------------------------
    /// `if`
    If,
    /// `else`
    Else,
    /// `elseif`
    ElseIf,
    /// `while`
    While,
    /// `do`
    Do,
    /// `for`
    For,
    /// `foreach`
    Foreach,
    /// `as`
    As,
    /// `function`
    Function,
    /// `return`
    Return,
    /// `echo`
    Echo,
    /// `print`
    Print,
    /// `true`
    True,
    /// `false`
    False,
    /// `null`
    Null,
    /// `and` — low-precedence boolean AND.
    And,
    /// `or` — low-precedence boolean OR.
    Or,
    /// `xor` — low-precedence boolean XOR.
    Xor,
    /// `break`
    Break,
    /// `continue`
    Continue,
    /// `switch`
    Switch,
    /// `case`
    Case,
    /// `default`
    Default,
    /// `endif` — alternative `if` syntax terminator.
    EndIf,
    /// `endwhile` — alternative `while` syntax terminator.
    EndWhile,
    /// `endfor` — alternative `for` syntax terminator.
    EndFor,
    /// `endforeach` — alternative `foreach` syntax terminator.
    EndForeach,
    /// `throw`
    Throw,
    /// `try`
    Try,
    /// `catch`
    Catch,
    /// `finally`
    Finally,
    /// `instanceof`
    Instanceof,
    /// `array` — as a keyword (e.g. `array(1, 2)` or `array` type hint).
    Array,
    /// `list` — destructuring construct: `list($a, $b) = ...`.
    List,
    /// `goto`
    Goto,
    /// `declare`
    Declare,
    /// `unset`
    Unset,
    /// `global`
    Global,
    /// `enddeclare` — alternative `declare` syntax terminator.
    EndDeclare,
    /// `endswitch` — alternative `switch` syntax terminator.
    EndSwitch,
    /// `isset`
    Isset,
    /// `empty`
    Empty,
    /// `include`
    Include,
    /// `include_once`
    IncludeOnce,
    /// `require`
    Require,
    /// `require_once`
    RequireOnce,
    /// `eval`
    Eval,
    /// `exit`
    Exit,
    /// `die` — alias for `exit`.
    Die,
    /// `clone`
    Clone,

    // OOP keywords
    /// `new`
    New,
    /// `class`
    Class,
    /// `abstract`
    Abstract,
    /// `final`
    Final,
    /// `interface`
    Interface,
    /// `trait`
    Trait,
    /// `extends`
    Extends,
    /// `implements`
    Implements,
    /// `public`
    Public,
    /// `protected`
    Protected,
    /// `private`
    Private,
    /// `static`
    Static,
    /// `const`
    Const,
    /// `fn` — arrow function keyword.
    Fn_,
    /// `match` — match expression keyword (PHP 8.0+).
    Match_,
    /// `namespace`
    Namespace,
    /// `use`
    Use,
    /// `readonly` (PHP 8.1+).
    Readonly,
    /// `enum` (PHP 8.1+).
    Enum_,
    /// `yield`
    Yield_,
    /// `self`
    Self_,
    /// `parent`
    Parent_,

    // -------------------------------------------------------------------------
    // Magic constants (resolved from Identifier at lex time)
    // -------------------------------------------------------------------------
    /// `__CLASS__`
    MagicClass,
    /// `__DIR__`
    MagicDir,
    /// `__FILE__`
    MagicFile,
    /// `__FUNCTION__`
    MagicFunction,
    /// `__LINE__`
    MagicLine,
    /// `__METHOD__`
    MagicMethod,
    /// `__NAMESPACE__`
    MagicNamespace,
    /// `__TRAIT__`
    MagicTrait,
    /// `__PROPERTY__` (PHP 8.4+)
    MagicProperty,
    /// `__halt_compiler` — stops the parser; remaining bytes are raw data.
    HaltCompiler,

    // -------------------------------------------------------------------------
    // PHP tags & template output
    // -------------------------------------------------------------------------
    /// `<?php` or `<?=` opening tag.
    OpenTag,

    /// `?>` closing tag; switches the lexer back to inline-HTML mode.
    CloseTag,

    /// Raw HTML text between PHP tags (produced by the `Lexer` wrapper, not the inner scanner).
    InlineHtml,

    // -------------------------------------------------------------------------
    // Heredoc / Nowdoc (produced by Lexer wrapper)
    // -------------------------------------------------------------------------
    /// `<<<LABEL … LABEL;` — heredoc string (supports interpolation).
    Heredoc,
    /// `<<<'LABEL' … LABEL;` — nowdoc string (no interpolation).
    Nowdoc,

    // -------------------------------------------------------------------------
    // Error tokens
    // -------------------------------------------------------------------------
    /// An invalid numeric literal, e.g. `1_000_` (trailing underscore).
    /// The lexer emits this token and records a [`LexerError`](crate::LexerError) for it.
    InvalidNumericLiteral,

    // -------------------------------------------------------------------------
    // Comments (filtered into a side-table by the parser)
    // -------------------------------------------------------------------------
    /// `// …` single-line slash comment.
    LineComment,
    /// `# …` single-line hash comment.
    HashComment,
    /// `/* … */` block comment.
    BlockComment,
    /// `/** … */` doc-block comment (first non-whitespace char after `/*` is `*`).
    DocComment,

    // -------------------------------------------------------------------------
    // End of input
    // -------------------------------------------------------------------------
    /// Sentinel token emitted once all source bytes have been consumed.
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
    /// Whether this is `=` or a compound assignment operator.
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

impl TokenKind {
    /// A short human-readable description, as used in diagnostics
    /// (e.g. `"';'"`, `"identifier"`).
    pub fn description(self) -> &'static str {
        match self {
            TokenKind::IntLiteral => "integer",
            TokenKind::HexIntLiteral => "hex integer",
            TokenKind::BinIntLiteral => "binary integer",
            TokenKind::OctIntLiteral | TokenKind::OctIntLiteralNew => "octal integer",
            TokenKind::FloatLiteral
            | TokenKind::FloatLiteralSimple
            | TokenKind::FloatLiteralLeadingDot => "float",
            TokenKind::SingleQuotedString | TokenKind::DoubleQuotedString => "string",
            TokenKind::BacktickString => "backtick string",
            TokenKind::Variable => "variable",
            TokenKind::Dollar => "'$'",
            TokenKind::Identifier => "identifier",
            TokenKind::Plus => "'+'",
            TokenKind::Minus => "'-'",
            TokenKind::Star => "'*'",
            TokenKind::Slash => "'/'",
            TokenKind::Percent => "'%'",
            TokenKind::StarStar => "'**'",
            TokenKind::Dot => "'.'",
            TokenKind::Equals => "'='",
            TokenKind::PlusEquals => "'+='",
            TokenKind::MinusEquals => "'-='",
            TokenKind::StarEquals => "'*='",
            TokenKind::SlashEquals => "'/='",
            TokenKind::PercentEquals => "'%='",
            TokenKind::StarStarEquals => "'**='",
            TokenKind::DotEquals => "'.='",
            TokenKind::AmpersandEquals => "'&='",
            TokenKind::PipeEquals => "'|='",
            TokenKind::CaretEquals => "'^='",
            TokenKind::ShiftLeftEquals => "'<<='",
            TokenKind::ShiftRightEquals => "'>>='",
            TokenKind::CoalesceEquals => "'??='",
            TokenKind::EqualsEquals => "'=='",
            TokenKind::BangEquals => "'!='",
            TokenKind::EqualsEqualsEquals => "'==='",
            TokenKind::BangEqualsEquals => "'!=='",
            TokenKind::LessThan => "'<'",
            TokenKind::GreaterThan => "'>'",
            TokenKind::LessThanEquals => "'<='",
            TokenKind::GreaterThanEquals => "'>='",
            TokenKind::Spaceship => "'<=>'",
            TokenKind::AmpersandAmpersand => "'&&'",
            TokenKind::PipePipe => "'||'",
            TokenKind::Bang => "'!'",
            TokenKind::Ampersand => "'&'",
            TokenKind::Pipe => "'|'",
            TokenKind::Caret => "'^'",
            TokenKind::Tilde => "'~'",
            TokenKind::ShiftLeft => "'<<'",
            TokenKind::ShiftRight => "'>>'",
            TokenKind::PlusPlus => "'++'",
            TokenKind::MinusMinus => "'--'",
            TokenKind::Question => "'?'",
            TokenKind::QuestionQuestion => "'??'",
            TokenKind::Colon => "':'",
            TokenKind::FatArrow => "'=>'",
            TokenKind::PipeArrow => "'|>'",
            TokenKind::LeftParen => "'('",
            TokenKind::RightParen => "')'",
            TokenKind::LeftBracket => "'['",
            TokenKind::RightBracket => "']'",
            TokenKind::LeftBrace => "'{'",
            TokenKind::RightBrace => "'}'",
            TokenKind::Semicolon => "';'",
            TokenKind::Comma => "','",
            TokenKind::DoubleColon => "'::'",
            TokenKind::Arrow => "'->'",
            TokenKind::NullsafeArrow => "'?->'",
            TokenKind::Backslash => "'\\'",
            TokenKind::At => "'@'",
            TokenKind::HashBracket => "'#['",
            TokenKind::Ellipsis => "'...'",
            TokenKind::If => "'if'",
            TokenKind::Else => "'else'",
            TokenKind::ElseIf => "'elseif'",
            TokenKind::While => "'while'",
            TokenKind::Do => "'do'",
            TokenKind::For => "'for'",
            TokenKind::Foreach => "'foreach'",
            TokenKind::As => "'as'",
            TokenKind::Function => "'function'",
            TokenKind::Return => "'return'",
            TokenKind::Echo => "'echo'",
            TokenKind::Print => "'print'",
            TokenKind::True => "'true'",
            TokenKind::False => "'false'",
            TokenKind::Null => "'null'",
            TokenKind::And => "'and'",
            TokenKind::Or => "'or'",
            TokenKind::Xor => "'xor'",
            TokenKind::Break => "'break'",
            TokenKind::Continue => "'continue'",
            TokenKind::Switch => "'switch'",
            TokenKind::Case => "'case'",
            TokenKind::Default => "'default'",
            TokenKind::EndIf => "'endif'",
            TokenKind::EndWhile => "'endwhile'",
            TokenKind::EndFor => "'endfor'",
            TokenKind::EndForeach => "'endforeach'",
            TokenKind::Throw => "'throw'",
            TokenKind::Try => "'try'",
            TokenKind::Catch => "'catch'",
            TokenKind::Finally => "'finally'",
            TokenKind::Instanceof => "'instanceof'",
            TokenKind::Array => "'array'",
            TokenKind::List => "'list'",
            TokenKind::Goto => "'goto'",
            TokenKind::Declare => "'declare'",
            TokenKind::Unset => "'unset'",
            TokenKind::Global => "'global'",
            TokenKind::EndDeclare => "'enddeclare'",
            TokenKind::EndSwitch => "'endswitch'",
            TokenKind::Isset => "'isset'",
            TokenKind::Empty => "'empty'",
            TokenKind::Include => "'include'",
            TokenKind::IncludeOnce => "'include_once'",
            TokenKind::Require => "'require'",
            TokenKind::RequireOnce => "'require_once'",
            TokenKind::Eval => "'eval'",
            TokenKind::Exit => "'exit'",
            TokenKind::Die => "'die'",
            TokenKind::Clone => "'clone'",
            TokenKind::New => "'new'",
            TokenKind::Class => "'class'",
            TokenKind::Abstract => "'abstract'",
            TokenKind::Final => "'final'",
            TokenKind::Interface => "'interface'",
            TokenKind::Trait => "'trait'",
            TokenKind::Extends => "'extends'",
            TokenKind::Implements => "'implements'",
            TokenKind::Public => "'public'",
            TokenKind::Protected => "'protected'",
            TokenKind::Private => "'private'",
            TokenKind::Static => "'static'",
            TokenKind::Const => "'const'",
            TokenKind::Fn_ => "'fn'",
            TokenKind::Match_ => "'match'",
            TokenKind::Namespace => "'namespace'",
            TokenKind::Use => "'use'",
            TokenKind::Readonly => "'readonly'",
            TokenKind::Enum_ => "'enum'",
            TokenKind::Yield_ => "'yield'",
            TokenKind::Self_ => "'self'",
            TokenKind::Parent_ => "'parent'",
            TokenKind::MagicClass => "'__CLASS__'",
            TokenKind::MagicDir => "'__DIR__'",
            TokenKind::MagicFile => "'__FILE__'",
            TokenKind::MagicFunction => "'__FUNCTION__'",
            TokenKind::MagicLine => "'__LINE__'",
            TokenKind::MagicMethod => "'__METHOD__'",
            TokenKind::MagicNamespace => "'__NAMESPACE__'",
            TokenKind::MagicTrait => "'__TRAIT__'",
            TokenKind::MagicProperty => "'__PROPERTY__'",
            TokenKind::HaltCompiler => "'__halt_compiler'",
            TokenKind::OpenTag => "'<?php'",
            TokenKind::CloseTag => "'?>'",
            TokenKind::InlineHtml => "inline HTML",
            TokenKind::Heredoc => "heredoc",
            TokenKind::Nowdoc => "nowdoc",
            TokenKind::InvalidNumericLiteral => "invalid numeric literal",
            TokenKind::LineComment => "line comment",
            TokenKind::HashComment => "hash comment",
            TokenKind::BlockComment => "block comment",
            TokenKind::DocComment => "doc comment",
            TokenKind::Eof => "end of file",
        }
    }
}

impl std::fmt::Display for TokenKind {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        f.write_str(self.description())
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
