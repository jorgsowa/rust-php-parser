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
    /// `self`, `static` or `parent` used outside a class.
    ClassKeywordOutsideClass,
    /// `parent` used in a class that has no parent.
    ParentWithoutParentClass,
    /// `__toString()` declares a return type other than `string`.
    ToStringReturnType,
    /// A magic method other than `__toString()` declares a return type it may not have.
    MagicMethodReturnType,
    /// An internal attribute is applied to a target it does not allow.
    AttributeTargetMismatch,
    /// `#[Attribute]` is applied to an interface, trait, enum or abstract class.
    AttributeOnInvalidClass,
    /// `#[Deprecated]` is applied to a class-like declaration.
    DeprecatedOnInvalidTarget,
    /// `#[AllowDynamicProperties]` is applied to an interface, trait, enum or readonly class.
    AllowDynamicPropertiesOnInvalidClass,
    /// A bare `return;` in a function that declares a return type.
    MissingReturnValue,
    /// A generator declares a return type that `Generator` does not satisfy.
    GeneratorReturnType,
    /// A readonly property has a default value.
    ReadonlyPropertyDefault,
    /// Two parameters share a name.
    DuplicateParameter,
    /// `$this` is assigned or used as a `catch` variable.
    ReassignThis,
    /// Not yet classified.
    Other,
}

impl ForbiddenRule {
    /// Stable kebab-case identifier, e.g. `"reassign-this"`.
    pub fn as_str(self) -> &'static str {
        match self {
            ForbiddenRule::ClassKeywordOutsideClass => "class-keyword-outside-class",
            ForbiddenRule::ParentWithoutParentClass => "parent-without-parent-class",
            ForbiddenRule::ToStringReturnType => "to-string-return-type",
            ForbiddenRule::MagicMethodReturnType => "magic-method-return-type",
            ForbiddenRule::AttributeTargetMismatch => "attribute-target-mismatch",
            ForbiddenRule::AttributeOnInvalidClass => "attribute-on-invalid-class",
            ForbiddenRule::DeprecatedOnInvalidTarget => "deprecated-on-invalid-target",
            ForbiddenRule::AllowDynamicPropertiesOnInvalidClass => {
                "allow-dynamic-properties-on-invalid-class"
            }
            ForbiddenRule::MissingReturnValue => "missing-return-value",
            ForbiddenRule::GeneratorReturnType => "generator-return-type",
            ForbiddenRule::ReadonlyPropertyDefault => "readonly-property-default",
            ForbiddenRule::DuplicateParameter => "duplicate-parameter",
            ForbiddenRule::ReassignThis => "reassign-this",
            ForbiddenRule::Other => "other",
        }
    }
}

#[cfg(test)]
mod tests {
    use super::{ForbiddenRule, ParseError};

    const RULES: &[ForbiddenRule] = &[
        ForbiddenRule::ClassKeywordOutsideClass,
        ForbiddenRule::ParentWithoutParentClass,
        ForbiddenRule::ToStringReturnType,
        ForbiddenRule::MagicMethodReturnType,
        ForbiddenRule::AttributeTargetMismatch,
        ForbiddenRule::AttributeOnInvalidClass,
        ForbiddenRule::DeprecatedOnInvalidTarget,
        ForbiddenRule::AllowDynamicPropertiesOnInvalidClass,
        ForbiddenRule::MissingReturnValue,
        ForbiddenRule::GeneratorReturnType,
        ForbiddenRule::ReadonlyPropertyDefault,
        ForbiddenRule::DuplicateParameter,
        ForbiddenRule::ReassignThis,
    ];

    /// `(source, reported span text)` for each site that reports `rule`.
    fn samples(rule: ForbiddenRule) -> &'static [(&'static str, &'static str)] {
        match rule {
            ForbiddenRule::ClassKeywordOutsideClass => &[
                ("<?php function f() { self::g(); }", "self"),
                ("<?php function f() { return parent::$x::get(); }", "parent"),
            ],
            ForbiddenRule::ParentWithoutParentClass => {
                &[("<?php class A { function f() { parent::f(); } }", "parent")]
            }
            ForbiddenRule::ToStringReturnType => &[(
                "<?php class A { function __toString(): int { return 1; } }",
                "int",
            )],
            ForbiddenRule::MagicMethodReturnType => &[(
                "<?php class A { function __isset($n): int { return 1; } }",
                "int",
            )],
            ForbiddenRule::AttributeTargetMismatch => {
                &[("<?php #[Override] class A {}", "Override")]
            }
            ForbiddenRule::AttributeOnInvalidClass => {
                &[("<?php #[Attribute] trait T {}", "Attribute")]
            }
            ForbiddenRule::DeprecatedOnInvalidTarget => {
                &[("<?php #[Deprecated] class A {}", "Deprecated")]
            }
            ForbiddenRule::AllowDynamicPropertiesOnInvalidClass => &[(
                "<?php #[AllowDynamicProperties] interface I {}",
                "AllowDynamicProperties",
            )],
            ForbiddenRule::MissingReturnValue => {
                &[("<?php function f(): int { return; }", "return;")]
            }
            ForbiddenRule::GeneratorReturnType => &[
                ("<?php function f(): int { yield 1; }", "int"),
                (
                    "<?php class A { public int $x { set { yield 1; } } }",
                    "set { yield 1; }",
                ),
            ],
            ForbiddenRule::ReadonlyPropertyDefault => {
                &[("<?php class A { public readonly int $x = 1; }", "1")]
            }
            ForbiddenRule::DuplicateParameter => &[("<?php function f($a, $a) {}", "$a")],
            ForbiddenRule::ReassignThis => &[
                ("<?php function f() { $this = 1; }", "$this"),
                ("<?php try {} catch (E $this) {}", "$this"),
            ],
            ForbiddenRule::Other => &[],
        }
    }

    #[test]
    fn each_rule_reports_its_span() {
        for &rule in RULES {
            assert!(!samples(rule).is_empty(), "{rule:?} has no sample");
            for &(src, text) in samples(rule) {
                let errors = crate::parse(src).errors;
                let spans: Vec<&str> = errors
                    .iter()
                    .filter(|e| e.forbidden_rule() == Some(rule))
                    .map(|e| &src[e.span().start as usize..e.span().end as usize])
                    .collect();
                assert_eq!(spans, [text], "{rule:?} in {src:?}: {errors:?}");
            }
        }
    }

    #[test]
    fn identifiers_are_unique() {
        let mut ids: Vec<&str> = RULES.iter().map(|r| r.as_str()).collect();
        ids.push(ForbiddenRule::Other.as_str());
        ids.sort_unstable();
        ids.dedup();
        assert_eq!(ids.len(), RULES.len() + 1);
    }

    #[test]
    fn rule_adds_no_size() {
        assert_eq!(std::mem::size_of::<ParseError>(), 64);
    }
}
