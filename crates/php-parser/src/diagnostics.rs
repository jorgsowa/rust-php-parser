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
    /// A `[`, `{` or `${` in an interpolated string is never closed.
    UnclosedInterpolation,
    /// An interpolated array index is empty.
    EmptyInterpolationIndex,
    /// A `${}` interpolation names no variable.
    EmptyInterpolationVariableName,
    /// The index in a `${name[...]}` interpolation is not closed.
    UnclosedInterpolationIndex,
    /// A class constant is interpolated with `{$...}`.
    ClassConstantInterpolation,
    /// A simple interpolation `"$a[...]"` has an invalid offset.
    InvalidInterpolationOffset,
    /// A numeric literal has invalid digits, e.g. `08`.
    InvalidNumericLiteral,
    /// A `\u{...}` escape is empty or out of range.
    InvalidCodepointEscape,
    /// A heredoc's closing indentation mixes tabs and spaces.
    MixedHeredocIndentation,
    /// A heredoc line is indented less than its closing marker.
    HeredocBodyIndentation,
    /// A namespaced name contains whitespace.
    WhitespaceInNamespacedName,
    /// A member has more than one visibility modifier.
    MultipleVisibilityModifiers,
    /// A property has more than one set-visibility modifier.
    MultipleSetVisibilityModifiers,
    /// A modifier is repeated.
    DuplicateModifier,
    /// A declaration is both `abstract` and `final`.
    AbstractFinalConflict,
    /// A class constant has a modifier constants cannot have.
    InvalidConstantModifier,
    /// A modifier is used where it cannot apply, e.g. `static` on a parameter.
    ModifierNotAllowed,
    /// A reserved keyword names a declaration.
    KeywordAsDeclarationName,
    /// A reserved type name names a class.
    ReservedClassName,
    /// A statement that must be at the outermost scope is nested.
    OutermostScopeOnly,
    /// An intersection type is used in a union without parentheses.
    UnparenthesizedIntersectionInUnion,
    /// A parenthesized intersection type is not part of a union.
    ParenthesizedIntersectionOutsideUnion,
    /// `static` is used as a type where it cannot be.
    StaticTypePosition,
    /// An attribute group `#[]` is empty.
    EmptyAttributeList,
    /// An argument is passed as `&$x`.
    CallTimePassByReference,
    /// An offset is read with curly braces, `$a{0}`.
    CurlyOffsetAccess,
    /// A `(void)` cast is used as an expression.
    VoidCastInExpression,
    /// A `(real)` cast is used.
    RealCast,
    /// Non-associative operators are chained, e.g. `1 < 2 < 3`.
    NonAssociativeChain,
    /// An increment or decrement is assigned to.
    IncDecAsAssignTarget,
    /// An expression that cannot be assigned to is assigned to.
    InvalidAssignTarget,
    /// A destructuring pattern is used with a compound assignment.
    CompoundAssignToDestructuring,
    /// A destructuring pattern is assigned by reference.
    ReferenceAssignToDestructuring,
    /// `++` or `--` is applied to something other than a variable.
    IncDecNonVariable,
    /// An expression that cannot be dereferenced is dereferenced.
    InvalidDereference,
    /// An expression that cannot be written to is written to.
    InvalidWriteContext,
    /// `list()` is used outside an assignment or `foreach` target.
    ListOutsideDestructuring,
    /// An array literal has an empty element outside destructuring.
    EmptyArrayElement,
    /// A `new` expression is assigned by reference.
    ReferenceAssignNew,
    /// A comma-separated property declaration has hooks.
    HooksOnPropertyList,
    /// The right side of `instanceof` is not a class name, variable or parenthesized expression.
    InvalidInstanceofOperand,
    /// More than one `;` precedes a switch's first case.
    SwitchLeadingSemicolons,
    /// Partial function application is used in a `new` expression.
    PartialApplicationInNew,
    /// `new A()` is dereferenced without parentheses before PHP 8.4.
    UnparenthesizedNewDereference,
    /// `static` is used as a standalone expression.
    StaticStandaloneExpression,
    /// A parenthesized expression is assigned by reference.
    ReferenceToParenthesized,
    /// A value that has no reference is assigned by reference.
    ReferenceToNonReferenceable,
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
            ForbiddenRule::UnclosedInterpolation => "unclosed-interpolation",
            ForbiddenRule::EmptyInterpolationIndex => "empty-interpolation-index",
            ForbiddenRule::EmptyInterpolationVariableName => "empty-interpolation-variable-name",
            ForbiddenRule::UnclosedInterpolationIndex => "unclosed-interpolation-index",
            ForbiddenRule::ClassConstantInterpolation => "class-constant-interpolation",
            ForbiddenRule::InvalidInterpolationOffset => "invalid-interpolation-offset",
            ForbiddenRule::InvalidNumericLiteral => "invalid-numeric-literal",
            ForbiddenRule::InvalidCodepointEscape => "invalid-codepoint-escape",
            ForbiddenRule::MixedHeredocIndentation => "mixed-heredoc-indentation",
            ForbiddenRule::HeredocBodyIndentation => "heredoc-body-indentation",
            ForbiddenRule::WhitespaceInNamespacedName => "whitespace-in-namespaced-name",
            ForbiddenRule::MultipleVisibilityModifiers => "multiple-visibility-modifiers",
            ForbiddenRule::MultipleSetVisibilityModifiers => "multiple-set-visibility-modifiers",
            ForbiddenRule::DuplicateModifier => "duplicate-modifier",
            ForbiddenRule::AbstractFinalConflict => "abstract-final-conflict",
            ForbiddenRule::InvalidConstantModifier => "invalid-constant-modifier",
            ForbiddenRule::ModifierNotAllowed => "modifier-not-allowed",
            ForbiddenRule::KeywordAsDeclarationName => "keyword-as-declaration-name",
            ForbiddenRule::ReservedClassName => "reserved-class-name",
            ForbiddenRule::OutermostScopeOnly => "outermost-scope-only",
            ForbiddenRule::UnparenthesizedIntersectionInUnion => {
                "unparenthesized-intersection-in-union"
            }
            ForbiddenRule::ParenthesizedIntersectionOutsideUnion => {
                "parenthesized-intersection-outside-union"
            }
            ForbiddenRule::StaticTypePosition => "static-type-position",
            ForbiddenRule::EmptyAttributeList => "empty-attribute-list",
            ForbiddenRule::CallTimePassByReference => "call-time-pass-by-reference",
            ForbiddenRule::CurlyOffsetAccess => "curly-offset-access",
            ForbiddenRule::VoidCastInExpression => "void-cast-in-expression",
            ForbiddenRule::RealCast => "real-cast",
            ForbiddenRule::NonAssociativeChain => "non-associative-chain",
            ForbiddenRule::IncDecAsAssignTarget => "inc-dec-as-assign-target",
            ForbiddenRule::InvalidAssignTarget => "invalid-assign-target",
            ForbiddenRule::CompoundAssignToDestructuring => "compound-assign-to-destructuring",
            ForbiddenRule::ReferenceAssignToDestructuring => "reference-assign-to-destructuring",
            ForbiddenRule::IncDecNonVariable => "inc-dec-non-variable",
            ForbiddenRule::InvalidDereference => "invalid-dereference",
            ForbiddenRule::InvalidWriteContext => "invalid-write-context",
            ForbiddenRule::ListOutsideDestructuring => "list-outside-destructuring",
            ForbiddenRule::EmptyArrayElement => "empty-array-element",
            ForbiddenRule::ReferenceAssignNew => "reference-assign-new",
            ForbiddenRule::HooksOnPropertyList => "hooks-on-property-list",
            ForbiddenRule::InvalidInstanceofOperand => "invalid-instanceof-operand",
            ForbiddenRule::SwitchLeadingSemicolons => "switch-leading-semicolons",
            ForbiddenRule::PartialApplicationInNew => "partial-application-in-new",
            ForbiddenRule::UnparenthesizedNewDereference => "unparenthesized-new-dereference",
            ForbiddenRule::StaticStandaloneExpression => "static-standalone-expression",
            ForbiddenRule::ReferenceToParenthesized => "reference-to-parenthesized",
            ForbiddenRule::ReferenceToNonReferenceable => "reference-to-non-referenceable",
            ForbiddenRule::Other => "other",
        }
    }

    /// Whether PHP reports the rule while lexing or parsing, as opposed to while compiling.
    pub(crate) fn raised_by_php_parser(self) -> bool {
        matches!(
            self,
            ForbiddenRule::UnclosedInterpolation
                | ForbiddenRule::EmptyInterpolationIndex
                | ForbiddenRule::EmptyInterpolationVariableName
                | ForbiddenRule::UnclosedInterpolationIndex
                | ForbiddenRule::ClassConstantInterpolation
                | ForbiddenRule::InvalidInterpolationOffset
                | ForbiddenRule::InvalidNumericLiteral
                | ForbiddenRule::InvalidCodepointEscape
                | ForbiddenRule::MixedHeredocIndentation
                | ForbiddenRule::HeredocBodyIndentation
                | ForbiddenRule::WhitespaceInNamespacedName
                | ForbiddenRule::MultipleVisibilityModifiers
                | ForbiddenRule::MultipleSetVisibilityModifiers
                | ForbiddenRule::DuplicateModifier
                | ForbiddenRule::AbstractFinalConflict
                | ForbiddenRule::InvalidConstantModifier
                | ForbiddenRule::ModifierNotAllowed
                | ForbiddenRule::KeywordAsDeclarationName
                | ForbiddenRule::ReservedClassName
                | ForbiddenRule::OutermostScopeOnly
                | ForbiddenRule::UnparenthesizedIntersectionInUnion
                | ForbiddenRule::ParenthesizedIntersectionOutsideUnion
                | ForbiddenRule::StaticTypePosition
                | ForbiddenRule::EmptyAttributeList
                | ForbiddenRule::CallTimePassByReference
                | ForbiddenRule::CurlyOffsetAccess
                | ForbiddenRule::VoidCastInExpression
                | ForbiddenRule::RealCast
                | ForbiddenRule::NonAssociativeChain
                | ForbiddenRule::IncDecAsAssignTarget
                | ForbiddenRule::InvalidAssignTarget
                | ForbiddenRule::CompoundAssignToDestructuring
                | ForbiddenRule::ReferenceAssignToDestructuring
                | ForbiddenRule::IncDecNonVariable
                | ForbiddenRule::InvalidDereference
                | ForbiddenRule::InvalidWriteContext
                | ForbiddenRule::ListOutsideDestructuring
                | ForbiddenRule::ReferenceAssignNew
                | ForbiddenRule::HooksOnPropertyList
                | ForbiddenRule::InvalidInstanceofOperand
                | ForbiddenRule::SwitchLeadingSemicolons
                | ForbiddenRule::PartialApplicationInNew
                | ForbiddenRule::UnparenthesizedNewDereference
                | ForbiddenRule::StaticStandaloneExpression
                | ForbiddenRule::ReferenceToParenthesized
                | ForbiddenRule::ReferenceToNonReferenceable
        )
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
        ForbiddenRule::UnclosedInterpolation,
        ForbiddenRule::EmptyInterpolationIndex,
        ForbiddenRule::EmptyInterpolationVariableName,
        ForbiddenRule::UnclosedInterpolationIndex,
        ForbiddenRule::ClassConstantInterpolation,
        ForbiddenRule::InvalidInterpolationOffset,
        ForbiddenRule::InvalidNumericLiteral,
        ForbiddenRule::InvalidCodepointEscape,
        ForbiddenRule::MixedHeredocIndentation,
        ForbiddenRule::HeredocBodyIndentation,
        ForbiddenRule::WhitespaceInNamespacedName,
        ForbiddenRule::MultipleVisibilityModifiers,
        ForbiddenRule::MultipleSetVisibilityModifiers,
        ForbiddenRule::DuplicateModifier,
        ForbiddenRule::AbstractFinalConflict,
        ForbiddenRule::InvalidConstantModifier,
        ForbiddenRule::ModifierNotAllowed,
        ForbiddenRule::KeywordAsDeclarationName,
        ForbiddenRule::ReservedClassName,
        ForbiddenRule::OutermostScopeOnly,
        ForbiddenRule::UnparenthesizedIntersectionInUnion,
        ForbiddenRule::ParenthesizedIntersectionOutsideUnion,
        ForbiddenRule::StaticTypePosition,
        ForbiddenRule::EmptyAttributeList,
        ForbiddenRule::CallTimePassByReference,
        ForbiddenRule::CurlyOffsetAccess,
        ForbiddenRule::VoidCastInExpression,
        ForbiddenRule::RealCast,
        ForbiddenRule::NonAssociativeChain,
        ForbiddenRule::IncDecAsAssignTarget,
        ForbiddenRule::InvalidAssignTarget,
        ForbiddenRule::CompoundAssignToDestructuring,
        ForbiddenRule::ReferenceAssignToDestructuring,
        ForbiddenRule::IncDecNonVariable,
        ForbiddenRule::InvalidDereference,
        ForbiddenRule::InvalidWriteContext,
        ForbiddenRule::ListOutsideDestructuring,
        ForbiddenRule::EmptyArrayElement,
        ForbiddenRule::ReferenceAssignNew,
        ForbiddenRule::HooksOnPropertyList,
        ForbiddenRule::InvalidInstanceofOperand,
        ForbiddenRule::SwitchLeadingSemicolons,
        ForbiddenRule::PartialApplicationInNew,
        ForbiddenRule::UnparenthesizedNewDereference,
        ForbiddenRule::StaticStandaloneExpression,
        ForbiddenRule::ReferenceToParenthesized,
        ForbiddenRule::ReferenceToNonReferenceable,
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
            ForbiddenRule::UnclosedInterpolation => &[("<?php echo \"{$a\";", "{$a\";"), ("<?php echo \"$a[0\";", "[0"), ("<?php echo \"${a\";", "${a\";"),],
            ForbiddenRule::EmptyInterpolationIndex => &[("<?php echo \"$a[]\";", "[]"), ("<?php echo \"${a[]}\";", "[]"),],
            ForbiddenRule::EmptyInterpolationVariableName => &[("<?php echo \"${}\";", "${}"),],
            ForbiddenRule::UnclosedInterpolationIndex => &[("<?php echo \"${a[0]x}\";", "${a[0]x}"),],
            ForbiddenRule::ClassConstantInterpolation => &[("<?php echo \"{$a::B}\";", "$a::B"),],
            ForbiddenRule::InvalidInterpolationOffset => &[("<?php echo \"$a[ 1]\";", " 1"),],
            ForbiddenRule::InvalidNumericLiteral => &[("<?php echo 08;", "08"), ("<?php echo 1_;", "1_"),],
            ForbiddenRule::InvalidCodepointEscape => &[("<?php echo \"\\u{}\";", "\\u{}"), ("<?php echo \"\\u{110000}\";", "\\u{110000}"),],
            ForbiddenRule::MixedHeredocIndentation => &[("<?php echo <<<A\n \tx\n \tA;\n", " \t"),],
            ForbiddenRule::HeredocBodyIndentation => &[("<?php echo <<<A\nx\n  A;\n", "x"),],
            ForbiddenRule::WhitespaceInNamespacedName => &[("<?php echo A \\ B;", "A \\ B"),],
            ForbiddenRule::MultipleVisibilityModifiers => &[("<?php class A { public private $x; }", "public private"), ("<?php function f() {} class B { function __construct(public private $x) {} }", "public"),],
            ForbiddenRule::MultipleSetVisibilityModifiers => &[("<?php class A { public private(set) protected(set) int $x; }", "public private(set) protected"), ("<?php class B { function __construct(public private(set) protected(set) int $x) {} }", "public private(set)"),],
            ForbiddenRule::DuplicateModifier => &[("<?php class A { static static $x; }", "static"), ("<?php class A { public $x { final final get => 1; } }", "final"), ("<?php class B { function __construct(readonly readonly int $x) {} }", "readonly"),],
            ForbiddenRule::AbstractFinalConflict => &[("<?php abstract final class A {}", "abstract final"), ("<?php abstract class A { abstract final function f(); }", "abstract final"),],
            ForbiddenRule::InvalidConstantModifier => &[("<?php class A { static const X = 1; }", "const"), ("<?php enum E { static const X = 1; }", "const"),],
            ForbiddenRule::ModifierNotAllowed => &[("<?php function f(static $x) {}", "static"), ("<?php class A { readonly function f() {} }", "readonly function f() {}"), ("<?php trait T { function f() {} } class A { use T { f as readonly g; } }", "readonly"),],
            ForbiddenRule::KeywordAsDeclarationName => &[("<?php function list() {}", "list"), ("<?php interface list {}", "list"), ("<?php #[A] enum list {}", "list"),],
            ForbiddenRule::ReservedClassName => &[("<?php class int {}", "int"),],
            ForbiddenRule::OutermostScopeOnly => &[("<?php function f() { __halt_compiler(); }", "__halt_compiler"),],
            ForbiddenRule::UnparenthesizedIntersectionInUnion => &[("<?php function f((A|B)&C $x) {}", "(A|B)"),],
            ForbiddenRule::ParenthesizedIntersectionOutsideUnion => &[("<?php function f((A&B) $x) {}", "(A&B)"),],
            ForbiddenRule::StaticTypePosition => &[("<?php class A { public ?static $p; }", "static"), ("<?php function f(?static $x) {}", "static"),],
            ForbiddenRule::EmptyAttributeList => &[("<?php #[] function f() {}", "#[]"),],
            ForbiddenRule::CallTimePassByReference => &[("<?php f(&$x);", "&"),],
            ForbiddenRule::CurlyOffsetAccess => &[("<?php echo $a{0};", "{"),],
            ForbiddenRule::VoidCastInExpression => &[("<?php $x = (void) f();", "(void) f()"),],
            ForbiddenRule::RealCast => &[("<?php $x = (real) 1;", "real"),],
            ForbiddenRule::NonAssociativeChain => &[("<?php $x = 1 < 2 < 3;", "<"),],
            ForbiddenRule::IncDecAsAssignTarget => &[("<?php $a++ = 1;", "="),],
            ForbiddenRule::InvalidAssignTarget => &[("<?php 1 = 2;", "="),],
            ForbiddenRule::CompoundAssignToDestructuring => &[("<?php [$a] += 1;", "+="),],
            ForbiddenRule::ReferenceAssignToDestructuring => &[("<?php [$a] = &$b;", "&"),],
            ForbiddenRule::IncDecNonVariable => &[("<?php f()++;", "f()"),],
            ForbiddenRule::InvalidDereference => &[("<?php echo 1[0];", "1"),],
            ForbiddenRule::InvalidWriteContext => &[("<?php unset(f());", "f()"),],
            ForbiddenRule::ListOutsideDestructuring => &[("<?php $x = list($a);", "list($a)"),],
            ForbiddenRule::EmptyArrayElement => &[("<?php $x = [1, , 2];", ","),],
            ForbiddenRule::ReferenceAssignNew => &[("<?php $x = &new A;", "new A"),],
            ForbiddenRule::HooksOnPropertyList => &[("<?php class A { public $x, $y { get => 1; } }", "{"),],
            ForbiddenRule::InvalidInstanceofOperand => &[("<?php $x instanceof 1;", "1"),],
            ForbiddenRule::SwitchLeadingSemicolons => &[("<?php switch ($x) {;; case 1: }", ";"),],
            ForbiddenRule::PartialApplicationInNew => &[("<?php new A(?);", "?"),],
            ForbiddenRule::UnparenthesizedNewDereference => &[("<?php new A::B;", "::"),],
            ForbiddenRule::StaticStandaloneExpression => &[("<?php static;", "static"),],
            ForbiddenRule::ReferenceToParenthesized => &[("<?php $x = &($y);", "($y)"),],
            ForbiddenRule::ReferenceToNonReferenceable => &[("<?php $x = &1;", "1"), ("<?php [&$a] = 1;", "1"),],
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
