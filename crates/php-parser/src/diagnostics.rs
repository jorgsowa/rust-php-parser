use php_ast::Span;
use php_lexer::TokenKind;
use std::borrow::Cow;
use thiserror::Error;

/// Diagnostic severity. Mirrors `php -l`'s split between fatal errors and
/// warnings (e.g. `final private method` is a PHP warning, not a fatal).
#[derive(Debug, Clone, Copy, PartialEq, Eq, Default)]
pub enum Severity {
    #[default]
    Error,
    Warning,
}

/// A parse error or diagnostic emitted during parsing.
///
/// The parser recovers from all errors and always produces a complete AST,
/// so errors are informational rather than fatal. Each variant carries a
/// [`Span`] identifying the source location.
#[derive(Debug, Clone, Error)]
pub enum ParseError {
    /// A specific token was expected but a different one was found.
    #[error("expected {expected}, found {found}")]
    Expected {
        expected: Cow<'static, str>,
        found: TokenKind,
        span: Span,
    },

    /// An expression was expected but not found (e.g. empty parentheses).
    #[error("expected expression")]
    ExpectedExpression { span: Span },

    /// A statement was expected but not found.
    #[error("expected statement")]
    ExpectedStatement { span: Span },

    /// PHP source must start with `<?php` or `<?`.
    #[error("expected opening PHP tag")]
    ExpectedOpenTag { span: Span },

    /// A string literal was opened but never closed.
    #[error("unterminated string literal")]
    UnterminatedString { span: Span },

    /// A required token was missing after another construct.
    #[error("expected {expected} after {after}")]
    ExpectedAfter {
        expected: Cow<'static, str>,
        after: Cow<'static, str>,
        span: Span,
    },

    /// A delimiter (parenthesis, bracket, brace) was opened but never closed.
    #[error("unclosed {delimiter} opened at {opened_at:?}")]
    UnclosedDelimiter {
        delimiter: Cow<'static, str>,
        opened_at: Span,
        span: Span,
    },

    /// A construct that is syntactically valid but semantically forbidden
    /// (e.g. `(unset)` cast, deprecated syntax). Equivalent to a PHP fatal.
    #[error("{message}")]
    Forbidden {
        message: Cow<'static, str>,
        span: Span,
    },

    /// A construct PHP only warns about (e.g. `final private` method). Treated
    /// as a non-fatal diagnostic; `severity()` returns [`Severity::Warning`].
    #[error("{message}")]
    ForbiddenWarning {
        message: Cow<'static, str>,
        span: Span,
    },

    /// Syntax that requires a newer PHP version than the targeted one.
    /// Emitted by [`crate::parse_versioned`] when the source uses features
    /// unavailable in the specified [`crate::PhpVersion`].
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
            | ParseError::ExpectedExpression { span }
            | ParseError::ExpectedStatement { span }
            | ParseError::ExpectedOpenTag { span }
            | ParseError::UnterminatedString { span }
            | ParseError::ExpectedAfter { span, .. }
            | ParseError::UnclosedDelimiter { span, .. }
            | ParseError::Forbidden { span, .. }
            | ParseError::ForbiddenWarning { span, .. }
            | ParseError::VersionTooLow { span, .. } => *span,
        }
    }

    /// Returns the diagnostic severity. Currently only [`ParseError::ForbiddenWarning`]
    /// is at warning level; every other variant is an error.
    pub fn severity(&self) -> Severity {
        match self {
            ParseError::ForbiddenWarning { .. } => Severity::Warning,
            _ => Severity::Error,
        }
    }
}
