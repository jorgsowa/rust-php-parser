use php_ast::Span;
use php_lexer::TokenKind;
use std::borrow::Cow;
use thiserror::Error;

#[derive(Debug, Clone, Error)]
pub enum ParseError {
    #[error("expected {expected}, found {found}")]
    Expected {
        expected: Cow<'static, str>,
        found: TokenKind,
        span: Span,
    },

    #[error("unexpected token {found}")]
    Unexpected { found: TokenKind, span: Span },

    #[error("expected expression")]
    ExpectedExpression { span: Span },

    #[error("expected statement")]
    ExpectedStatement { span: Span },

    #[error("expected opening PHP tag")]
    ExpectedOpenTag { span: Span },

    #[error("unterminated string literal")]
    UnterminatedString { span: Span },

    #[error("expected {expected} after {after}")]
    ExpectedAfter {
        expected: Cow<'static, str>,
        after: Cow<'static, str>,
        span: Span,
    },

    #[error("unclosed {delimiter} opened at {opened_at:?}")]
    UnclosedDelimiter {
        delimiter: Cow<'static, str>,
        opened_at: Span,
        span: Span,
    },

    #[error("{message}")]
    Forbidden {
        message: Cow<'static, str>,
        span: Span,
    },

    #[error("'{feature}' requires PHP {required} or higher (targeting PHP {used})")]
    VersionTooLow {
        feature: Cow<'static, str>,
        required: Cow<'static, str>,
        used: Cow<'static, str>,
        span: Span,
    },
}

impl ParseError {
    pub fn span(&self) -> Span {
        match self {
            ParseError::Expected { span, .. }
            | ParseError::Unexpected { span, .. }
            | ParseError::ExpectedExpression { span }
            | ParseError::ExpectedStatement { span }
            | ParseError::ExpectedOpenTag { span }
            | ParseError::UnterminatedString { span }
            | ParseError::ExpectedAfter { span, .. }
            | ParseError::UnclosedDelimiter { span, .. }
            | ParseError::Forbidden { span, .. }
            | ParseError::VersionTooLow { span, .. } => *span,
        }
    }
}
