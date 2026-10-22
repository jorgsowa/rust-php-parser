use crate::PhpVersion;
use php_ast::Span;
use std::borrow::Cow;
use thiserror::Error;

/// A parse error or diagnostic emitted during parsing.
///
/// The parser recovers from all errors and always produces a complete AST,
/// so errors are informational rather than fatal. Each variant carries a
/// [`Span`] identifying the source location.
#[derive(Debug, Clone, Error)]
#[non_exhaustive]
pub enum ParseError {
    /// A specific token was expected but a different one was found.
    #[error("expected {expected}, found {found}")]
    #[non_exhaustive]
    Expected {
        /// Description of the expected token.
        expected: Cow<'static, str>,
        /// Description of the token actually found, e.g. `"';'"` or
        /// `"identifier"`. A description rather than the lexer's token kind,
        /// so that new tokens are not a breaking change for this type.
        found: Cow<'static, str>,
        /// Source range of the error.
        span: Span,
    },

    /// An expression was expected but not found (e.g. empty parentheses).
    #[error("expected expression")]
    #[non_exhaustive]
    ExpectedExpression {
        /// Source range of the error.
        span: Span,
    },

    /// A statement was expected but not found.
    #[error("expected statement")]
    #[non_exhaustive]
    ExpectedStatement {
        /// Source range of the error.
        span: Span,
    },

    /// PHP source must start with `<?php` or `<?`.
    #[error("expected opening PHP tag")]
    #[non_exhaustive]
    ExpectedOpenTag {
        /// Source range of the error.
        span: Span,
    },

    /// A string literal was opened but never closed.
    #[error("unterminated string literal")]
    #[non_exhaustive]
    UnterminatedString {
        /// Source range of the error.
        span: Span,
    },

    /// A required token was missing after another construct.
    #[error("expected {expected} after {after}")]
    #[non_exhaustive]
    ExpectedAfter {
        /// Description of the expected token.
        expected: Cow<'static, str>,
        /// Construct the token should follow.
        after: Cow<'static, str>,
        /// Source range of the error.
        span: Span,
    },

    /// A delimiter (parenthesis, bracket, brace) was opened but never closed.
    #[error("expected {delimiter} to close the delimiter opened at byte {}", opened_at.start)]
    #[non_exhaustive]
    UnclosedDelimiter {
        /// The expected closing delimiter, e.g. `"')'"`.
        delimiter: Cow<'static, str>,
        /// Where the delimiter was opened.
        opened_at: Span,
        /// Source range of the error.
        span: Span,
    },

    /// A construct that is syntactically valid but semantically forbidden
    /// (e.g. `(unset)` cast, deprecated syntax). Equivalent to a PHP fatal.
    #[error("{message}")]
    #[non_exhaustive]
    Forbidden {
        /// Rule violated.
        rule: ForbiddenRule,
        /// Error message.
        message: Cow<'static, str>,
        /// Source range of the error.
        span: Span,
    },

    /// Statements, expressions or string interpolations are nested deeper than
    /// the parser's recursion budget. The innermost construct is replaced by an
    /// error node so that parsing stays within a bounded stack.
    #[error("maximum nesting depth exceeded")]
    #[non_exhaustive]
    NestingTooDeep {
        /// Source range of the error.
        span: Span,
    },

    /// The source is larger than 4 GiB, so byte offsets no longer fit in a
    /// [`Span`]. Nothing is parsed and the program is empty.
    #[error("source is {len} bytes; the maximum is 4 GiB")]
    #[non_exhaustive]
    SourceTooLarge {
        /// Length of the rejected source in bytes.
        len: usize,
        /// Always empty (`0..0`).
        span: Span,
    },

    /// Syntax that requires a newer PHP version than the targeted one.
    /// Emitted by [`crate::parse_with`] when the source uses features
    /// unavailable in the specified [`crate::PhpVersion`].
    #[error("'{feature}' requires PHP {required} or higher")]
    #[non_exhaustive]
    VersionTooLow {
        /// Name of the feature used.
        feature: Cow<'static, str>,
        /// Minimum PHP version required.
        required: PhpVersion,
        /// PHP version targeted.
        used: PhpVersion,
        /// Source range of the error.
        span: Span,
    },
}

impl ParseError {
    /// Source range of the error.
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
            | ParseError::NestingTooDeep { span }
            | ParseError::SourceTooLarge { span, .. }
            | ParseError::VersionTooLow { span, .. } => *span,
        }
    }

    /// Rule violated, for [`ParseError::Forbidden`].
    pub fn forbidden_rule(&self) -> Option<ForbiddenRule> {
        match self {
            ParseError::Forbidden { rule, .. } => Some(*rule),
            _ => None,
        }
    }
}

/// The PHP compile-time rule a [`ParseError::Forbidden`] reports.
///
/// Rules are stable API; message wording is not.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
#[non_exhaustive]
pub enum ForbiddenRule {
    /// Not yet classified.
    Other,
}

impl ForbiddenRule {
    /// Stable kebab-case identifier, e.g. `"reassign-this"`.
    pub fn as_str(self) -> &'static str {
        match self {
            ForbiddenRule::Other => "other",
        }
    }
}
