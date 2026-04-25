use php_ast::Span;
use php_lexer::{Lexer, Token, TokenKind};

fn collect_tokens(source: &str) -> Vec<Token> {
    let mut lexer = Lexer::new(source);
    let mut tokens = Vec::new();
    loop {
        let token = lexer.next_token();
        if token.kind == TokenKind::Eof {
            tokens.push(token);
            break;
        }
        tokens.push(token);
    }
    tokens
}

fn collect_kinds(source: &str) -> Vec<TokenKind> {
    collect_tokens(source).into_iter().map(|t| t.kind).collect()
}

/// Collect token kinds from PHP code (auto-prefixes with <?php)
fn php_kinds(code: &str) -> Vec<TokenKind> {
    let full = format!("<?php {}", code);
    collect_kinds(&full)
        .into_iter()
        .filter(|k| *k != TokenKind::OpenTag && *k != TokenKind::Eof)
        .collect()
}

/// Collect (kind, text) pairs from PHP code
fn php_tokens(code: &str) -> Vec<(TokenKind, String)> {
    let full = format!("<?php {}", code);
    let mut lexer = Lexer::new(&full);
    let mut result = Vec::new();
    loop {
        let token = lexer.next_token();
        if token.kind == TokenKind::Eof {
            break;
        }
        if token.kind == TokenKind::OpenTag {
            continue;
        }
        let text = lexer.token_text(&token).to_string();
        result.push((token.kind, text));
    }
    result
}

mod open_tag_and_html {
    use super::*;

    #[test]
    fn test_php_only() {
        let tokens = collect_kinds("<?php $x = 42;");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::Variable,
                TokenKind::Equals,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_inline_html_before_php() {
        let tokens = collect_kinds("<html><?php echo 1;");
        assert_eq!(
            tokens,
            vec![
                TokenKind::InlineHtml,
                TokenKind::OpenTag,
                TokenKind::Echo,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_inline_html_after_close_tag() {
        let tokens = collect_kinds("<?php echo 1; ?><html>");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::Echo,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::CloseTag,
                TokenKind::InlineHtml,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_empty_source() {
        let tokens = collect_kinds("");
        assert_eq!(tokens, vec![TokenKind::Eof]);
    }

    #[test]
    fn test_only_inline_html() {
        let tokens = collect_kinds("<html><body>Hello</body></html>");
        assert_eq!(tokens, vec![TokenKind::InlineHtml, TokenKind::Eof]);
    }

    #[test]
    fn test_open_tag_uppercase() {
        // PHP's Zend scanner accepts <?php case-insensitively
        for tag in &["<?PHP", "<?Php", "<?PhP", "<?pHP", "<?phP"] {
            let src = format!("{} $x = 1;", tag);
            let tokens = collect_kinds(&src);
            assert_eq!(
                tokens[0],
                TokenKind::OpenTag,
                "expected OpenTag for opening tag '{tag}'"
            );
        }
    }

    #[test]
    fn test_open_tag_uppercase_mid_file() {
        // <?PHP appearing after inline HTML must also be recognised
        let tokens = collect_kinds("<html><?PHP echo 1;");
        assert_eq!(
            tokens,
            vec![
                TokenKind::InlineHtml,
                TokenKind::OpenTag,
                TokenKind::Echo,
                TokenKind::IntLiteral,
                TokenKind::Semicolon,
                TokenKind::Eof,
            ]
        );
    }
}

mod keywords {
    use super::*;

    #[test]
    fn test_keyword_resolution() {
        let tokens = collect_kinds("<?php if else while for foreach function return");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::If,
                TokenKind::Else,
                TokenKind::While,
                TokenKind::For,
                TokenKind::Foreach,
                TokenKind::Function,
                TokenKind::Return,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_keyword_case_insensitive() {
        let tokens = collect_kinds("<?php IF ELSE TRUE FALSE NULL");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::If,
                TokenKind::Else,
                TokenKind::True,
                TokenKind::False,
                TokenKind::Null,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_logical_keywords() {
        let tokens = collect_kinds("<?php and or xor");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::And,
                TokenKind::Or,
                TokenKind::Xor,
                TokenKind::Eof,
            ]
        );
    }
}

mod lexer_api {
    use super::*;

    #[test]
    fn test_peek_doesnt_consume() {
        let mut lexer = Lexer::new("<?php 42");
        let peeked = *lexer.peek();
        assert_eq!(peeked.kind, TokenKind::OpenTag);
        let next = lexer.next_token();
        assert_eq!(next.kind, TokenKind::OpenTag);
        let next = lexer.next_token();
        assert_eq!(next.kind, TokenKind::IntLiteral);
    }

    #[test]
    fn test_token_text() {
        let source = "<?php $myVar = 'hello';";
        let mut lexer = Lexer::new(source);
        lexer.next_token(); // <?php
        let var_tok = lexer.next_token();
        assert_eq!(lexer.token_text(&var_tok), "$myVar");
        lexer.next_token(); // =
        let str_tok = lexer.next_token();
        assert_eq!(lexer.token_text(&str_tok), "'hello'");
    }

    #[test]
    fn test_spans_are_correct() {
        let source = "<?php $x";
        let tokens = collect_tokens(source);
        assert_eq!(tokens[0].span, Span::new(0, 5)); // <?php
        assert_eq!(tokens[1].span, Span::new(6, 8)); // $x
    }
}

mod operators {
    use super::*;

    #[test]
    fn test_basic_operators() {
        assert_eq!(
            php_kinds("+ - * / % ** ."),
            vec![
                TokenKind::Plus,
                TokenKind::Minus,
                TokenKind::Star,
                TokenKind::Slash,
                TokenKind::Percent,
                TokenKind::StarStar,
                TokenKind::Dot,
            ]
        );
    }

    #[test]
    fn test_operators() {
        let tokens = collect_kinds("<?php === !== <=> ?? ++ -- **");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::EqualsEqualsEquals,
                TokenKind::BangEqualsEquals,
                TokenKind::Spaceship,
                TokenKind::QuestionQuestion,
                TokenKind::PlusPlus,
                TokenKind::MinusMinus,
                TokenKind::StarStar,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_assignment_operators() {
        let tokens = collect_kinds("<?php += -= *= /= %= **= .= ??=");
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::PlusEquals,
                TokenKind::MinusEquals,
                TokenKind::StarEquals,
                TokenKind::SlashEquals,
                TokenKind::PercentEquals,
                TokenKind::StarStarEquals,
                TokenKind::DotEquals,
                TokenKind::CoalesceEquals,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_hash_bracket_not_comment() {
        let kinds = php_kinds("#[Attribute]");
        assert_eq!(
            kinds,
            vec![
                TokenKind::HashBracket,
                TokenKind::Identifier,
                TokenKind::RightBracket,
            ]
        );
    }

    #[test]
    fn test_nullsafe_arrow() {
        let kinds = php_kinds("$x?->y");
        assert_eq!(
            kinds,
            vec![
                TokenKind::Variable,
                TokenKind::NullsafeArrow,
                TokenKind::Identifier,
            ]
        );
    }

    #[test]
    fn test_pipe_arrow() {
        let kinds = php_kinds("$x |> foo(...)");
        assert_eq!(
            kinds,
            vec![
                TokenKind::Variable,
                TokenKind::PipeArrow,
                TokenKind::Identifier,
                TokenKind::LeftParen,
                TokenKind::Ellipsis,
                TokenKind::RightParen,
            ]
        );
    }
}

mod numeric_literals {
    use super::*;

    #[test]
    fn test_integers() {
        let toks = php_tokens("42 0xFF 0b1010 077");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "42".to_string()));
        assert_eq!(toks[1], (TokenKind::HexIntLiteral, "0xFF".to_string()));
        assert_eq!(toks[2], (TokenKind::BinIntLiteral, "0b1010".to_string()));
        assert_eq!(toks[3], (TokenKind::OctIntLiteral, "077".to_string()));
    }

    #[test]
    fn test_floats() {
        let toks = php_tokens("3.14 1e10 2.5e-3");
        assert_eq!(toks[0], (TokenKind::FloatLiteralSimple, "3.14".to_string()));
        assert_eq!(toks[1], (TokenKind::FloatLiteral, "1e10".to_string()));
        assert_eq!(toks[2], (TokenKind::FloatLiteral, "2.5e-3".to_string()));
    }

    #[test]
    fn test_float_leading_dot() {
        let toks = php_tokens(".5 .123e4");
        assert_eq!(
            toks[0],
            (TokenKind::FloatLiteralLeadingDot, ".5".to_string())
        );
        assert_eq!(
            toks[1],
            (TokenKind::FloatLiteralLeadingDot, ".123e4".to_string())
        );
    }

    #[test]
    fn test_trailing_dot_float() {
        // PHP: DNUM = LNUM "." — trailing-dot literals are floats, not ints
        let toks = php_tokens("0. 1. 42.");
        assert_eq!(toks[0], (TokenKind::FloatLiteralSimple, "0.".to_string()));
        assert_eq!(toks[1], (TokenKind::FloatLiteralSimple, "1.".to_string()));
        assert_eq!(toks[2], (TokenKind::FloatLiteralSimple, "42.".to_string()));
    }

    #[test]
    fn test_trailing_dot_not_confused_with_dotdot() {
        // "1.." must lex as IntLiteral("1") + Dot + Dot, not FloatLiteralSimple("1.") + Dot
        // because the second dot prevents the trailing-dot branch from firing
        let toks = php_tokens("1..");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "1".to_string()));
        assert_eq!(toks[1], (TokenKind::Dot, ".".to_string()));
        assert_eq!(toks[2], (TokenKind::Dot, ".".to_string()));
    }

    #[test]
    fn test_new_octal_syntax() {
        let toks = php_tokens("0o77 0O755");
        assert_eq!(toks[0], (TokenKind::OctIntLiteralNew, "0o77".to_string()));
        assert_eq!(toks[1], (TokenKind::OctIntLiteralNew, "0O755".to_string()));
    }

    #[test]
    fn test_legacy_octal_with_invalid_digits() {
        // PHP silently stops scanning at the first 8 or 9 in legacy octal;
        // the lexer must still classify these as OctIntLiteral, not IntLiteral
        let toks = php_tokens("0778 019 09");
        assert_eq!(toks[0], (TokenKind::OctIntLiteral, "0778".to_string()));
        assert_eq!(toks[1], (TokenKind::OctIntLiteral, "019".to_string()));
        assert_eq!(toks[2], (TokenKind::OctIntLiteral, "09".to_string()));
    }

    #[test]
    fn test_numeric_underscores() {
        let toks = php_tokens("1_000 0xFF_FF 0b1010_0101");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "1_000".to_string()));
        assert_eq!(toks[1], (TokenKind::HexIntLiteral, "0xFF_FF".to_string()));
        assert_eq!(
            toks[2],
            (TokenKind::BinIntLiteral, "0b1010_0101".to_string())
        );
    }
}

mod strings_and_variables {
    use super::*;

    #[test]
    fn test_string_literals() {
        let tokens = collect_kinds(r#"<?php 'single' "double""#);
        assert_eq!(
            tokens,
            vec![
                TokenKind::OpenTag,
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
                TokenKind::Eof,
            ]
        );
    }

    #[test]
    fn test_strings() {
        let kinds = php_kinds(r#"'hello' "world" 'it\'s' "say \"hi\"""#);
        assert_eq!(
            kinds,
            vec![
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
                TokenKind::SingleQuotedString,
                TokenKind::DoubleQuotedString,
            ]
        );
    }

    #[test]
    fn test_binary_prefix_strings() {
        let kinds = php_kinds(r#"b'hello' B"world""#);
        assert_eq!(
            kinds,
            vec![TokenKind::SingleQuotedString, TokenKind::DoubleQuotedString,]
        );
    }

    #[test]
    fn test_variables() {
        let toks = php_tokens("$x $myVar $_foo");
        assert_eq!(toks[0], (TokenKind::Variable, "$x".to_string()));
        assert_eq!(toks[1], (TokenKind::Variable, "$myVar".to_string()));
        assert_eq!(toks[2], (TokenKind::Variable, "$_foo".to_string()));
    }

    #[test]
    fn test_comments_yielded() {
        // Comments are now yielded as tokens rather than silently discarded.
        let toks = php_tokens("42 // line comment\n43 /* block */ 44 # hash comment\n45");
        assert_eq!(toks[0], (TokenKind::IntLiteral, "42".to_string()));
        assert_eq!(
            toks[1],
            (TokenKind::LineComment, "// line comment".to_string())
        );
        assert_eq!(toks[2], (TokenKind::IntLiteral, "43".to_string()));
        assert_eq!(
            toks[3],
            (TokenKind::BlockComment, "/* block */".to_string())
        );
        assert_eq!(toks[4], (TokenKind::IntLiteral, "44".to_string()));
        assert_eq!(
            toks[5],
            (TokenKind::HashComment, "# hash comment".to_string())
        );
        assert_eq!(toks[6], (TokenKind::IntLiteral, "45".to_string()));
    }
}
