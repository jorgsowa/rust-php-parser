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
    /// `self`, `parent` or `static` is written fully qualified, e.g. `\self`.
    QualifiedClassKeyword,
    /// A reserved name is extended, implemented or used as a trait.
    ReservedClassReference,
    /// A reserved type name names an enum.
    ReservedEnumName,
    /// An interface uses a trait.
    TraitInInterface,
    /// A class that is not abstract has an abstract method or hook.
    AbstractMemberInConcreteClass,
    /// A class declares a property twice.
    DuplicateProperty,
    /// A class declares a method twice.
    DuplicateMethod,
    /// A class declares a constant or enum case twice.
    DuplicateClassConstant,
    /// A class constant is named `class`.
    ClassConstantNamedClass,
    /// A typed class constant's value does not match its type.
    ClassConstantValueType,
    /// A private class constant is `final`.
    PrivateFinalConstant,
    /// An interface constant is not public.
    InvalidInterfaceConstantModifier,
    /// An interface method is not public, or is `final` or `abstract`.
    InvalidInterfaceMethodModifier,
    /// An interface property is `abstract`, `final`, protected or private.
    InvalidInterfacePropertyModifier,
    /// An interface method has a body.
    InterfaceMethodBody,
    /// A method that is not abstract has no body.
    MissingMethodBody,
    /// An abstract method has a body.
    AbstractMethodBody,
    /// An abstract method is private.
    PrivateAbstractMethod,
    /// An anonymous class method is abstract.
    AbstractAnonymousClassMethod,
    /// An enum method is abstract.
    AbstractEnumMethod,
    /// A magic method takes the wrong number of parameters.
    MagicMethodArgumentCount,
    /// A magic method takes a parameter by reference.
    MagicMethodByReference,
    /// A magic method is static when it must not be, or the reverse.
    MagicMethodStatic,
    /// A magic method declares a parameter type it may not have.
    MagicMethodParameterType,
    /// A static property is readonly.
    StaticReadonlyProperty,
    /// A readonly property has no type.
    UntypedReadonlyProperty,
    /// A readonly property has hooks.
    ReadonlyPropertyHooks,
    /// A property with set visibility has no type.
    UntypedAsymmetricProperty,
    /// A property's set visibility is wider than its visibility.
    SetVisibilityWiderThanVisibility,
    /// A private property is `final`.
    PrivateFinalProperty,
    /// An abstract property has no abstract hook.
    AbstractPropertyWithoutAbstractHook,
    /// An interface declares a property without hooks.
    InterfacePropertyWithoutHooks,
    /// A static property has hooks.
    StaticPropertyHooks,
    /// A virtual hooked property has a default value.
    VirtualPropertyDefault,
    /// A virtual property has set visibility.
    VirtualPropertyAsymmetricVisibility,
    /// A property hook list is empty.
    EmptyHookList,
    /// A property declares the same hook twice.
    DuplicateHook,
    /// A `get` hook has a parameter list.
    GetHookParameters,
    /// A `set` hook does not have exactly one parameter.
    SetHookParameterCount,
    /// A `set` hook parameter is by reference.
    SetHookParameterByReference,
    /// A `set` hook parameter is variadic.
    SetHookParameterVariadic,
    /// A `set` hook parameter's type does not accept the property's type.
    SetHookParameterType,
    /// A backed property with a `set` hook has a by-reference `get` hook.
    ByReferenceGetHookWithSet,
    /// A hook of a property that is not abstract has no body.
    MissingHookBody,
    /// An interface property hook has a body.
    AbstractHookBody,
    /// An abstract property hook is `final`.
    AbstractFinalHook,
    /// An abstract property hook is private.
    PrivateAbstractHook,
    /// A parameter outside a constructor is promoted.
    PromotedPropertyOutsideConstructor,
    /// A parameter of an abstract constructor is promoted.
    PromotedPropertyInAbstractConstructor,
    /// A promoted parameter is variadic.
    VariadicPromotedProperty,
    /// An enum's backing type is not `int` or `string`.
    InvalidEnumBackingType,
    /// An enum case is named `class`.
    EnumCaseNamedClass,
    /// A case of a backed enum has no value.
    MissingEnumCaseValue,
    /// A case of a pure enum has a value.
    PureEnumCaseValue,
    /// A trait alias is `static` or `abstract`.
    InvalidTraitAliasModifier,
    /// A `/*` comment is never closed.
    UnterminatedComment,
    /// A named class-like is declared inside a class member.
    NestedClassDeclaration,
    /// Braced and unbraced namespace declarations are mixed.
    MixedNamespaceStyles,
    /// Code other than `declare` precedes the first namespace declaration.
    NamespaceNotFirst,
    /// Code follows a braced namespace declaration.
    CodeOutsideNamespace,
    /// A namespace declaration is nested.
    NestedNamespace,
    /// A `use` import reuses a name already imported.
    UseNameConflict,
    /// A `use` import is aliased to a reserved class name.
    SpecialClassNameAlias,
    /// `strict_types` or `encoding` is not declared first.
    DeclareNotFirstStatement,
    /// A `declare` directive's value is not a literal.
    NonLiteralDeclareValue,
    /// `strict_types` uses block mode or a value other than 0 or 1.
    InvalidStrictTypes,
    /// Attributes apply to a `const` statement declaring several constants.
    AttributesOnMultipleConstants,
    /// An attribute argument list unpacks with `...`.
    AttributeArgumentUnpacking,
    /// An attribute argument list is a first-class callable `(...)`.
    AttributeArgumentClosure,
    /// A `void` function returns a value.
    VoidReturnValue,
    /// A `never` function returns.
    NeverReturn,
    /// A variadic parameter has a default value.
    VariadicParameterDefault,
    /// A parameter follows a variadic one.
    VariadicParameterNotLast,
    /// `$this` is declared as a parameter, closure `use`, global or static variable.
    ThisAsDeclaredVariable,
    /// A superglobal is declared as a parameter or closure `use` variable.
    SuperglobalAsDeclaredVariable,
    /// A static variable is declared twice in one function.
    DuplicateStaticVariable,
    /// `break` or `continue` names more loop levels than enclose it.
    BreakOutOfLoop,
    /// `break` or `continue` has an operand that is not a positive integer literal.
    InvalidBreakOperand,
    /// `break`, `continue` or `goto` jumps into or out of a `finally` block.
    JumpAcrossFinally,
    /// A `goto` label is defined twice.
    DuplicateLabel,
    /// `goto` names an undefined label.
    UndefinedGotoLabel,
    /// `goto` jumps into a loop or `switch`.
    GotoIntoLoop,
    /// A `switch` has more than one `default`.
    DuplicateSwitchDefault,
    /// A `match` has more than one `default` arm.
    DuplicateMatchDefault,
    /// A `foreach` key is taken by reference.
    ReferenceKey,
    /// `catch` names `self`, `parent` or `static`.
    ClassKeywordInCatch,
    /// `parent::$x::get()` or `::set()` is called outside the matching hook.
    InvalidParentHookCall,
    /// `static::class` is used in a constant expression.
    StaticClassInConstantExpression,
    /// `$a[]` is read or unset.
    AppendOutsideWrite,
    /// `$GLOBALS` is written to as a whole, appended to or referenced.
    InvalidGlobalsWrite,
    /// `mixed` or `null` is marked nullable.
    InvalidNullableType,
    /// `void`, `never` or `mixed` is part of a nullable or union type.
    StandaloneTypeInComposite,
    /// A builtin type is part of an intersection type.
    BuiltinTypeInIntersection,
    /// A type is redundant with another in the same declaration.
    RedundantType,
    /// A type appears twice in a union or intersection type.
    DuplicateType,
    /// A parameter is typed `void` or `never`.
    InvalidParameterType,
    /// A property or constant has a type it may not have, e.g. `callable`.
    InvalidMemberType,
    /// A builtin type is written with a namespace, e.g. `\int`.
    QualifiedBuiltinType,
    /// A qualified type name ends in a reserved name.
    ReservedTypeName,
    /// `isset()` is applied to the result of an expression.
    IssetOnExpression,
    /// A `new` expression is turned into a first-class callable `(...)`.
    ClosureForNew,
    /// `yield` is used outside a function.
    YieldOutsideFunction,
    /// `yield from` is used in a by-reference generator.
    YieldFromInByReferenceGenerator,
    /// A positional argument follows a named one.
    PositionalAfterNamedArgument,
    /// An `(unset)` cast is used.
    UnsetCast,
    /// The result of a builtin such as `clone` is written to.
    BuiltinResultWrite,
    /// A temporary value is written to, e.g. `(1)[0] = 2`.
    TemporaryExpressionWrite,
    /// A nullsafe chain is written to.
    NullsafeWrite,
    /// A nullsafe chain is taken by reference.
    ReferenceToNullsafe,
    /// A nullsafe call is turned into a first-class callable `(...)`.
    NullsafeClosureCreation,
    /// A destructuring element cannot be assigned to.
    UnwritableDestructuringElement,
    /// `$this` is unset.
    UnsetThis,
    /// A closure `use` variable has the name of a parameter.
    ClosureUseShadowsParameter,
    /// A closure `use` list names a variable twice.
    DuplicateClosureUseVariable,
    /// A numeric literal is used as a class name, e.g. `(1)::A`.
    LiteralClassName,
    /// `::class` is applied to `true`, `false`, `null` or an array literal.
    ClassFetchOnLiteral,
    /// `::class` is applied to a dynamic class name before PHP 8.0.
    DynamicClassFetch,
    /// A constant expression contains something PHP cannot evaluate at compile time.
    InvalidConstantExpression,
    /// A destructuring list is empty.
    EmptyList,
    /// A keyed destructuring list has an empty entry.
    EmptyKeyedArrayEntry,
    /// A destructuring list mixes keyed and unkeyed entries.
    MixedKeyedEntries,
    /// A destructuring pattern mixes `[]` and `list()`.
    MixedListSyntax,
    /// A destructuring list uses `...`.
    SpreadInDestructuring,
    /// Nested ternaries are not parenthesized, e.g. `a ? b : c ? d : e`.
    UnparenthesizedNestedTernary,
    /// An arrow function on the right of `|>` is not parenthesized.
    UnparenthesizedArrowInPipe,
    /// A `{$...}` interpolation is not a variable, property, index or call.
    InvalidCurlyInterpolation,
    /// A non-repeatable attribute is applied twice.
    RepeatedAttribute,
    /// `#[\NoDiscard]` is applied to a property hook or a method it cannot apply to.
    NoDiscardOnInvalidTarget,
    /// `#[\NoDiscard]` is applied to a function that returns no value.
    NoDiscardWithoutReturnValue,
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
            ForbiddenRule::QualifiedClassKeyword => "qualified-class-keyword",
            ForbiddenRule::ReservedClassReference => "reserved-class-reference",
            ForbiddenRule::ReservedEnumName => "reserved-enum-name",
            ForbiddenRule::TraitInInterface => "trait-in-interface",
            ForbiddenRule::AbstractMemberInConcreteClass => "abstract-member-in-concrete-class",
            ForbiddenRule::DuplicateProperty => "duplicate-property",
            ForbiddenRule::DuplicateMethod => "duplicate-method",
            ForbiddenRule::DuplicateClassConstant => "duplicate-class-constant",
            ForbiddenRule::ClassConstantNamedClass => "class-constant-named-class",
            ForbiddenRule::ClassConstantValueType => "class-constant-value-type",
            ForbiddenRule::PrivateFinalConstant => "private-final-constant",
            ForbiddenRule::InvalidInterfaceConstantModifier => {
                "invalid-interface-constant-modifier"
            }
            ForbiddenRule::InvalidInterfaceMethodModifier => "invalid-interface-method-modifier",
            ForbiddenRule::InvalidInterfacePropertyModifier => {
                "invalid-interface-property-modifier"
            }
            ForbiddenRule::InterfaceMethodBody => "interface-method-body",
            ForbiddenRule::MissingMethodBody => "missing-method-body",
            ForbiddenRule::AbstractMethodBody => "abstract-method-body",
            ForbiddenRule::PrivateAbstractMethod => "private-abstract-method",
            ForbiddenRule::AbstractAnonymousClassMethod => "abstract-anonymous-class-method",
            ForbiddenRule::AbstractEnumMethod => "abstract-enum-method",
            ForbiddenRule::MagicMethodArgumentCount => "magic-method-argument-count",
            ForbiddenRule::MagicMethodByReference => "magic-method-by-reference",
            ForbiddenRule::MagicMethodStatic => "magic-method-static",
            ForbiddenRule::MagicMethodParameterType => "magic-method-parameter-type",
            ForbiddenRule::StaticReadonlyProperty => "static-readonly-property",
            ForbiddenRule::UntypedReadonlyProperty => "untyped-readonly-property",
            ForbiddenRule::ReadonlyPropertyHooks => "readonly-property-hooks",
            ForbiddenRule::UntypedAsymmetricProperty => "untyped-asymmetric-property",
            ForbiddenRule::SetVisibilityWiderThanVisibility => {
                "set-visibility-wider-than-visibility"
            }
            ForbiddenRule::PrivateFinalProperty => "private-final-property",
            ForbiddenRule::AbstractPropertyWithoutAbstractHook => {
                "abstract-property-without-abstract-hook"
            }
            ForbiddenRule::InterfacePropertyWithoutHooks => "interface-property-without-hooks",
            ForbiddenRule::StaticPropertyHooks => "static-property-hooks",
            ForbiddenRule::VirtualPropertyDefault => "virtual-property-default",
            ForbiddenRule::VirtualPropertyAsymmetricVisibility => {
                "virtual-property-asymmetric-visibility"
            }
            ForbiddenRule::EmptyHookList => "empty-hook-list",
            ForbiddenRule::DuplicateHook => "duplicate-hook",
            ForbiddenRule::GetHookParameters => "get-hook-parameters",
            ForbiddenRule::SetHookParameterCount => "set-hook-parameter-count",
            ForbiddenRule::SetHookParameterByReference => "set-hook-parameter-by-reference",
            ForbiddenRule::SetHookParameterVariadic => "set-hook-parameter-variadic",
            ForbiddenRule::SetHookParameterType => "set-hook-parameter-type",
            ForbiddenRule::ByReferenceGetHookWithSet => "by-reference-get-hook-with-set",
            ForbiddenRule::MissingHookBody => "missing-hook-body",
            ForbiddenRule::AbstractHookBody => "abstract-hook-body",
            ForbiddenRule::AbstractFinalHook => "abstract-final-hook",
            ForbiddenRule::PrivateAbstractHook => "private-abstract-hook",
            ForbiddenRule::PromotedPropertyOutsideConstructor => {
                "promoted-property-outside-constructor"
            }
            ForbiddenRule::PromotedPropertyInAbstractConstructor => {
                "promoted-property-in-abstract-constructor"
            }
            ForbiddenRule::VariadicPromotedProperty => "variadic-promoted-property",
            ForbiddenRule::InvalidEnumBackingType => "invalid-enum-backing-type",
            ForbiddenRule::EnumCaseNamedClass => "enum-case-named-class",
            ForbiddenRule::MissingEnumCaseValue => "missing-enum-case-value",
            ForbiddenRule::PureEnumCaseValue => "pure-enum-case-value",
            ForbiddenRule::InvalidTraitAliasModifier => "invalid-trait-alias-modifier",
            ForbiddenRule::UnterminatedComment => "unterminated-comment",
            ForbiddenRule::NestedClassDeclaration => "nested-class-declaration",
            ForbiddenRule::MixedNamespaceStyles => "mixed-namespace-styles",
            ForbiddenRule::NamespaceNotFirst => "namespace-not-first",
            ForbiddenRule::CodeOutsideNamespace => "code-outside-namespace",
            ForbiddenRule::NestedNamespace => "nested-namespace",
            ForbiddenRule::UseNameConflict => "use-name-conflict",
            ForbiddenRule::SpecialClassNameAlias => "special-class-name-alias",
            ForbiddenRule::DeclareNotFirstStatement => "declare-not-first-statement",
            ForbiddenRule::NonLiteralDeclareValue => "non-literal-declare-value",
            ForbiddenRule::InvalidStrictTypes => "invalid-strict-types",
            ForbiddenRule::AttributesOnMultipleConstants => "attributes-on-multiple-constants",
            ForbiddenRule::AttributeArgumentUnpacking => "attribute-argument-unpacking",
            ForbiddenRule::AttributeArgumentClosure => "attribute-argument-closure",
            ForbiddenRule::VoidReturnValue => "void-return-value",
            ForbiddenRule::NeverReturn => "never-return",
            ForbiddenRule::VariadicParameterDefault => "variadic-parameter-default",
            ForbiddenRule::VariadicParameterNotLast => "variadic-parameter-not-last",
            ForbiddenRule::ThisAsDeclaredVariable => "this-as-declared-variable",
            ForbiddenRule::SuperglobalAsDeclaredVariable => "superglobal-as-declared-variable",
            ForbiddenRule::DuplicateStaticVariable => "duplicate-static-variable",
            ForbiddenRule::BreakOutOfLoop => "break-out-of-loop",
            ForbiddenRule::InvalidBreakOperand => "invalid-break-operand",
            ForbiddenRule::JumpAcrossFinally => "jump-across-finally",
            ForbiddenRule::DuplicateLabel => "duplicate-label",
            ForbiddenRule::UndefinedGotoLabel => "undefined-goto-label",
            ForbiddenRule::GotoIntoLoop => "goto-into-loop",
            ForbiddenRule::DuplicateSwitchDefault => "duplicate-switch-default",
            ForbiddenRule::DuplicateMatchDefault => "duplicate-match-default",
            ForbiddenRule::ReferenceKey => "reference-key",
            ForbiddenRule::ClassKeywordInCatch => "class-keyword-in-catch",
            ForbiddenRule::InvalidParentHookCall => "invalid-parent-hook-call",
            ForbiddenRule::StaticClassInConstantExpression => "static-class-in-constant-expression",
            ForbiddenRule::AppendOutsideWrite => "append-outside-write",
            ForbiddenRule::InvalidGlobalsWrite => "invalid-globals-write",
            ForbiddenRule::InvalidNullableType => "invalid-nullable-type",
            ForbiddenRule::StandaloneTypeInComposite => "standalone-type-in-composite",
            ForbiddenRule::BuiltinTypeInIntersection => "builtin-type-in-intersection",
            ForbiddenRule::RedundantType => "redundant-type",
            ForbiddenRule::DuplicateType => "duplicate-type",
            ForbiddenRule::InvalidParameterType => "invalid-parameter-type",
            ForbiddenRule::InvalidMemberType => "invalid-member-type",
            ForbiddenRule::QualifiedBuiltinType => "qualified-builtin-type",
            ForbiddenRule::ReservedTypeName => "reserved-type-name",
            ForbiddenRule::IssetOnExpression => "isset-on-expression",
            ForbiddenRule::ClosureForNew => "closure-for-new",
            ForbiddenRule::YieldOutsideFunction => "yield-outside-function",
            ForbiddenRule::YieldFromInByReferenceGenerator => {
                "yield-from-in-by-reference-generator"
            }
            ForbiddenRule::PositionalAfterNamedArgument => "positional-after-named-argument",
            ForbiddenRule::UnsetCast => "unset-cast",
            ForbiddenRule::BuiltinResultWrite => "builtin-result-write",
            ForbiddenRule::TemporaryExpressionWrite => "temporary-expression-write",
            ForbiddenRule::NullsafeWrite => "nullsafe-write",
            ForbiddenRule::ReferenceToNullsafe => "reference-to-nullsafe",
            ForbiddenRule::NullsafeClosureCreation => "nullsafe-closure-creation",
            ForbiddenRule::UnwritableDestructuringElement => "unwritable-destructuring-element",
            ForbiddenRule::UnsetThis => "unset-this",
            ForbiddenRule::ClosureUseShadowsParameter => "closure-use-shadows-parameter",
            ForbiddenRule::DuplicateClosureUseVariable => "duplicate-closure-use-variable",
            ForbiddenRule::LiteralClassName => "literal-class-name",
            ForbiddenRule::ClassFetchOnLiteral => "class-fetch-on-literal",
            ForbiddenRule::DynamicClassFetch => "dynamic-class-fetch",
            ForbiddenRule::InvalidConstantExpression => "invalid-constant-expression",
            ForbiddenRule::EmptyList => "empty-list",
            ForbiddenRule::EmptyKeyedArrayEntry => "empty-keyed-array-entry",
            ForbiddenRule::MixedKeyedEntries => "mixed-keyed-entries",
            ForbiddenRule::MixedListSyntax => "mixed-list-syntax",
            ForbiddenRule::SpreadInDestructuring => "spread-in-destructuring",
            ForbiddenRule::UnparenthesizedNestedTernary => "unparenthesized-nested-ternary",
            ForbiddenRule::UnparenthesizedArrowInPipe => "unparenthesized-arrow-in-pipe",
            ForbiddenRule::InvalidCurlyInterpolation => "invalid-curly-interpolation",
            ForbiddenRule::RepeatedAttribute => "repeated-attribute",
            ForbiddenRule::NoDiscardOnInvalidTarget => "no-discard-on-invalid-target",
            ForbiddenRule::NoDiscardWithoutReturnValue => "no-discard-without-return-value",
            ForbiddenRule::Other => "other",
        }
    }

    /// Whether PHP reports the rule while lexing or parsing, as opposed to while compiling.
    pub(crate) fn raised_by_php_parser(self) -> bool {
        matches!(
            self,
            ForbiddenRule::UnterminatedComment
                | ForbiddenRule::UnclosedInterpolation
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
    use crate::PhpVersion;

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
        ForbiddenRule::QualifiedClassKeyword,
        ForbiddenRule::ReservedClassReference,
        ForbiddenRule::ReservedEnumName,
        ForbiddenRule::TraitInInterface,
        ForbiddenRule::AbstractMemberInConcreteClass,
        ForbiddenRule::DuplicateProperty,
        ForbiddenRule::DuplicateMethod,
        ForbiddenRule::DuplicateClassConstant,
        ForbiddenRule::ClassConstantNamedClass,
        ForbiddenRule::ClassConstantValueType,
        ForbiddenRule::PrivateFinalConstant,
        ForbiddenRule::InvalidInterfaceConstantModifier,
        ForbiddenRule::InvalidInterfaceMethodModifier,
        ForbiddenRule::InvalidInterfacePropertyModifier,
        ForbiddenRule::InterfaceMethodBody,
        ForbiddenRule::MissingMethodBody,
        ForbiddenRule::AbstractMethodBody,
        ForbiddenRule::PrivateAbstractMethod,
        ForbiddenRule::AbstractAnonymousClassMethod,
        ForbiddenRule::AbstractEnumMethod,
        ForbiddenRule::MagicMethodArgumentCount,
        ForbiddenRule::MagicMethodByReference,
        ForbiddenRule::MagicMethodStatic,
        ForbiddenRule::MagicMethodParameterType,
        ForbiddenRule::StaticReadonlyProperty,
        ForbiddenRule::UntypedReadonlyProperty,
        ForbiddenRule::ReadonlyPropertyHooks,
        ForbiddenRule::UntypedAsymmetricProperty,
        ForbiddenRule::SetVisibilityWiderThanVisibility,
        ForbiddenRule::PrivateFinalProperty,
        ForbiddenRule::AbstractPropertyWithoutAbstractHook,
        ForbiddenRule::InterfacePropertyWithoutHooks,
        ForbiddenRule::StaticPropertyHooks,
        ForbiddenRule::VirtualPropertyDefault,
        ForbiddenRule::VirtualPropertyAsymmetricVisibility,
        ForbiddenRule::EmptyHookList,
        ForbiddenRule::DuplicateHook,
        ForbiddenRule::GetHookParameters,
        ForbiddenRule::SetHookParameterCount,
        ForbiddenRule::SetHookParameterByReference,
        ForbiddenRule::SetHookParameterVariadic,
        ForbiddenRule::SetHookParameterType,
        ForbiddenRule::ByReferenceGetHookWithSet,
        ForbiddenRule::MissingHookBody,
        ForbiddenRule::AbstractHookBody,
        ForbiddenRule::AbstractFinalHook,
        ForbiddenRule::PrivateAbstractHook,
        ForbiddenRule::PromotedPropertyOutsideConstructor,
        ForbiddenRule::PromotedPropertyInAbstractConstructor,
        ForbiddenRule::VariadicPromotedProperty,
        ForbiddenRule::InvalidEnumBackingType,
        ForbiddenRule::EnumCaseNamedClass,
        ForbiddenRule::MissingEnumCaseValue,
        ForbiddenRule::PureEnumCaseValue,
        ForbiddenRule::InvalidTraitAliasModifier,
        ForbiddenRule::UnterminatedComment,
        ForbiddenRule::NestedClassDeclaration,
        ForbiddenRule::MixedNamespaceStyles,
        ForbiddenRule::NamespaceNotFirst,
        ForbiddenRule::CodeOutsideNamespace,
        ForbiddenRule::NestedNamespace,
        ForbiddenRule::UseNameConflict,
        ForbiddenRule::SpecialClassNameAlias,
        ForbiddenRule::DeclareNotFirstStatement,
        ForbiddenRule::NonLiteralDeclareValue,
        ForbiddenRule::InvalidStrictTypes,
        ForbiddenRule::AttributesOnMultipleConstants,
        ForbiddenRule::AttributeArgumentUnpacking,
        ForbiddenRule::AttributeArgumentClosure,
        ForbiddenRule::VoidReturnValue,
        ForbiddenRule::NeverReturn,
        ForbiddenRule::VariadicParameterDefault,
        ForbiddenRule::VariadicParameterNotLast,
        ForbiddenRule::ThisAsDeclaredVariable,
        ForbiddenRule::SuperglobalAsDeclaredVariable,
        ForbiddenRule::DuplicateStaticVariable,
        ForbiddenRule::BreakOutOfLoop,
        ForbiddenRule::InvalidBreakOperand,
        ForbiddenRule::JumpAcrossFinally,
        ForbiddenRule::DuplicateLabel,
        ForbiddenRule::UndefinedGotoLabel,
        ForbiddenRule::GotoIntoLoop,
        ForbiddenRule::DuplicateSwitchDefault,
        ForbiddenRule::DuplicateMatchDefault,
        ForbiddenRule::ReferenceKey,
        ForbiddenRule::ClassKeywordInCatch,
        ForbiddenRule::InvalidParentHookCall,
        ForbiddenRule::StaticClassInConstantExpression,
        ForbiddenRule::AppendOutsideWrite,
        ForbiddenRule::InvalidGlobalsWrite,
        ForbiddenRule::InvalidNullableType,
        ForbiddenRule::StandaloneTypeInComposite,
        ForbiddenRule::BuiltinTypeInIntersection,
        ForbiddenRule::RedundantType,
        ForbiddenRule::DuplicateType,
        ForbiddenRule::InvalidParameterType,
        ForbiddenRule::InvalidMemberType,
        ForbiddenRule::QualifiedBuiltinType,
        ForbiddenRule::ReservedTypeName,
        ForbiddenRule::IssetOnExpression,
        ForbiddenRule::ClosureForNew,
        ForbiddenRule::YieldOutsideFunction,
        ForbiddenRule::YieldFromInByReferenceGenerator,
        ForbiddenRule::PositionalAfterNamedArgument,
        ForbiddenRule::UnsetCast,
        ForbiddenRule::BuiltinResultWrite,
        ForbiddenRule::TemporaryExpressionWrite,
        ForbiddenRule::NullsafeWrite,
        ForbiddenRule::ReferenceToNullsafe,
        ForbiddenRule::NullsafeClosureCreation,
        ForbiddenRule::UnwritableDestructuringElement,
        ForbiddenRule::UnsetThis,
        ForbiddenRule::ClosureUseShadowsParameter,
        ForbiddenRule::DuplicateClosureUseVariable,
        ForbiddenRule::LiteralClassName,
        ForbiddenRule::ClassFetchOnLiteral,
        ForbiddenRule::DynamicClassFetch,
        ForbiddenRule::InvalidConstantExpression,
        ForbiddenRule::EmptyList,
        ForbiddenRule::EmptyKeyedArrayEntry,
        ForbiddenRule::MixedKeyedEntries,
        ForbiddenRule::MixedListSyntax,
        ForbiddenRule::SpreadInDestructuring,
        ForbiddenRule::UnparenthesizedNestedTernary,
        ForbiddenRule::UnparenthesizedArrowInPipe,
        ForbiddenRule::InvalidCurlyInterpolation,
        ForbiddenRule::RepeatedAttribute,
        ForbiddenRule::NoDiscardOnInvalidTarget,
        ForbiddenRule::NoDiscardWithoutReturnValue,
    ];

    /// `(rule, version, source, reported span text)` for sites that report only at some versions.
    const VERSION_GATED: &[(ForbiddenRule, PhpVersion, &str, &str)] = &[
        (
            ForbiddenRule::NeverReturn,
            PhpVersion::Php81,
            "<?php $f = fn(): never => 1;",
            "1",
        ),
        (
            ForbiddenRule::DynamicClassFetch,
            PhpVersion::Php74,
            "<?php $a::class;",
            "$a",
        ),
        (
            ForbiddenRule::QualifiedBuiltinType,
            PhpVersion::Php86,
            "<?php function f(namespace\\static $x) {}",
            "namespace\\static",
        ),
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
            ForbiddenRule::MagicMethodReturnType => &[
                (
                    "<?php class A { function __isset($n): int { return 1; } }",
                    "int",
                ),
                ("<?php class A { function __construct(): void {} }", "void"),
            ],
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
            ForbiddenRule::QualifiedClassKeyword => &[("<?php try {} catch (\\self $e) {}", "\\self"), ("<?php function f() { return \\self::X; }", "\\self"), ("<?php function f(\\self $x) {}", "\\self"), ("<?php class A extends \\self {}", "\\self"),],
            ForbiddenRule::ReservedClassReference => &[("<?php class A extends self {}", "self"),],
            ForbiddenRule::ReservedEnumName => &[("<?php enum int {}", "int"),],
            ForbiddenRule::TraitInInterface => &[("<?php interface I { use T; }", "use T;"),],
            ForbiddenRule::AbstractMemberInConcreteClass => &[("<?php class A { abstract function f(); }", "abstract function f();"), ("<?php class A { abstract public $x { get; } }", "abstract public $x { get; }"),],
            ForbiddenRule::DuplicateProperty => &[("<?php class A { public $x; public $x; }", "public $x"), ("<?php class A { public $x; function __construct(public $x) {} }", "public $x"),],
            ForbiddenRule::DuplicateMethod => &[("<?php class A { function f() {} function F() {} }", "function F() {}"),],
            ForbiddenRule::DuplicateClassConstant => &[("<?php class A { const X = 1; const X = 2; }", "X"),],
            ForbiddenRule::ClassConstantNamedClass => &[("<?php class A { const class = 1; }", "class"),],
            ForbiddenRule::ClassConstantValueType => &[("<?php class A { const int X = \"a\"; }", "\"a\""),],
            ForbiddenRule::PrivateFinalConstant => &[("<?php class A { final private const X = 1; }", "final private const X = 1;"), ("<?php enum E { final private const X = 1; }", "const"),],
            ForbiddenRule::InvalidInterfaceConstantModifier => &[("<?php interface I { private const X = 1; }", "private const X = 1;"),],
            ForbiddenRule::InvalidInterfaceMethodModifier => &[("<?php interface I { private function f(); }", "private function f();"), ("<?php interface I { final function f(); }", "final function f();"), ("<?php interface I { abstract function f(); }", "abstract function f();"),],
            ForbiddenRule::InvalidInterfacePropertyModifier => &[("<?php interface I { final public $x { get; } }", "final public $x"),],
            ForbiddenRule::InterfaceMethodBody => &[("<?php interface I { function f() {} }", "function f() {}"),],
            ForbiddenRule::MissingMethodBody => &[("<?php class A { function f(); }", "function f();"),],
            ForbiddenRule::AbstractMethodBody => &[("<?php abstract class A { abstract function f() {} }", "abstract function f() {}"),],
            ForbiddenRule::PrivateAbstractMethod => &[("<?php abstract class A { abstract private function f(); }", "abstract private function f();"),],
            ForbiddenRule::AbstractAnonymousClassMethod => &[("<?php new class { abstract function f(); };", "abstract function f();"),],
            ForbiddenRule::AbstractEnumMethod => &[("<?php enum E { abstract function f(); }", "abstract"),],
            ForbiddenRule::MagicMethodArgumentCount => &[("<?php class A { function __get() {} }", "function __get() {}"),],
            ForbiddenRule::MagicMethodByReference => &[("<?php class A { function __get(&$n) {} }", "&$n"),],
            ForbiddenRule::MagicMethodStatic => &[("<?php class A { static function __get($n) {} }", "static function __get($n) {}"),],
            ForbiddenRule::MagicMethodParameterType => &[("<?php class A { function __get(int $n) {} }", "int"),],
            ForbiddenRule::StaticReadonlyProperty => &[("<?php class A { public static readonly int $x; }", "public static readonly"), ("<?php class A { public readonly static int $x; }", "public readonly static"),],
            ForbiddenRule::UntypedReadonlyProperty => &[("<?php class A { public readonly $x; }", "public readonly $x"), ("<?php class A { function __construct(public readonly $x) {} }", "public readonly"),],
            ForbiddenRule::ReadonlyPropertyHooks => &[("<?php class A { public readonly int $x { get => 1; } }", "get => 1;"), ("<?php class A { function __construct(public readonly int $x { get => 1; }) {} }", "get => 1;"),],
            ForbiddenRule::UntypedAsymmetricProperty => &[("<?php class A { public private(set) $x; }", "public private(set) $x"), ("<?php class A { function __construct(public private(set) $x) {} }", "public private(set) $x"),],
            ForbiddenRule::SetVisibilityWiderThanVisibility => &[("<?php class A { private public(set) int $x; }", "private public(set) int $x"), ("<?php class A { function __construct(private public(set) int $x) {} }", "private public(set)"),],
            ForbiddenRule::PrivateFinalProperty => &[("<?php class A { final private $x; }", "final private $x"),],
            ForbiddenRule::AbstractPropertyWithoutAbstractHook => &[("<?php abstract class A { abstract public $x; }", "abstract public $x"), ("<?php abstract class A { abstract public $x { get => 1; } }", "abstract public $x { get => 1; }"),],
            ForbiddenRule::InterfacePropertyWithoutHooks => &[("<?php interface I { public $x; }", "public $x"),],
            ForbiddenRule::StaticPropertyHooks => &[("<?php class A { public static $x { get => 1; } }", "public static $x { get => 1; }"),],
            ForbiddenRule::VirtualPropertyDefault => &[("<?php class A { public int $x = 1 { get => 2; } }", "public int $x = 1 { get => 2; }"),],
            ForbiddenRule::VirtualPropertyAsymmetricVisibility => &[("<?php class A { public private(set) int $x { get => 1; } }", "public private(set) int $x { get => 1; }"),],
            ForbiddenRule::EmptyHookList => &[("<?php class A { public $x {} }", "{"),],
            ForbiddenRule::DuplicateHook => &[("<?php class A { public $x { get => 1; get => 2; } }", "get => 2;"), ("<?php class A { public $x { set {} set {} } }", "set {}"),],
            ForbiddenRule::GetHookParameters => &[("<?php class A { public $x { get() => 1; } }", "("),],
            ForbiddenRule::SetHookParameterCount => &[("<?php class A { public $x { set($a, $b) {} } }", "("),],
            ForbiddenRule::SetHookParameterByReference => &[("<?php class A { public $x { set(&$v) {} } }", "&$v"),],
            ForbiddenRule::SetHookParameterVariadic => &[("<?php class A { public $x { set(...$v) {} } }", "...$v"),],
            ForbiddenRule::SetHookParameterType => &[("<?php class A { public int $x { set(string $v) {} } }", "string $v"),],
            ForbiddenRule::ByReferenceGetHookWithSet => &[("<?php class A { public $x { &get => $this->x; set { $this->x = $value; } } }", "&get => $this->x;"),],
            ForbiddenRule::MissingHookBody => &[("<?php class A { public $x { get; } }", "get;"),],
            ForbiddenRule::AbstractHookBody => &[("<?php interface I { public $x { get => 1; } }", "get => 1;"),],
            ForbiddenRule::AbstractFinalHook => &[("<?php abstract class A { abstract public $x { final get; } }", "final get;"),],
            ForbiddenRule::PrivateAbstractHook => &[("<?php abstract class A { abstract private $x { get; } }", "get;"),],
            ForbiddenRule::PromotedPropertyOutsideConstructor => &[("<?php function f(public $x) {}", "public"), ("<?php class A { function f(public $x) {} }", "public"),],
            ForbiddenRule::PromotedPropertyInAbstractConstructor => &[("<?php abstract class A { abstract function __construct(public $x); }", "public $x"),],
            ForbiddenRule::VariadicPromotedProperty => &[("<?php class A { function __construct(public ...$x) {} }", "public ...$x"),],
            ForbiddenRule::InvalidEnumBackingType => &[("<?php enum E: float {}", "float"),],
            ForbiddenRule::EnumCaseNamedClass => &[("<?php enum E { case class; }", "class"),],
            ForbiddenRule::MissingEnumCaseValue => &[("<?php enum E: int { case A; }", "A"),],
            ForbiddenRule::PureEnumCaseValue => &[("<?php enum E { case A = 1; }", "="),],
            ForbiddenRule::InvalidTraitAliasModifier => &[("<?php class A { use T { f as static g; } }", "static"),],
            ForbiddenRule::UnterminatedComment => &[("<?php /* x", "/* x"),],
            ForbiddenRule::NestedClassDeclaration => &[("<?php class A { function f() { class B {} } }", "B"),],
            ForbiddenRule::MixedNamespaceStyles => &[("<?php namespace A; namespace B {}", "namespace B {}"),],
            ForbiddenRule::NamespaceNotFirst => &[("<?php echo 1; namespace A;", "echo 1;"),],
            ForbiddenRule::CodeOutsideNamespace => &[("<?php namespace A {} echo 1;", "echo 1;"),],
            ForbiddenRule::NestedNamespace => &[("<?php namespace A { namespace B {} }", "namespace B {}"),],
            ForbiddenRule::UseNameConflict => &[("<?php use A\\B; use C\\B;", "C\\B"),],
            ForbiddenRule::SpecialClassNameAlias => &[("<?php use A as self;", "A as self"),],
            ForbiddenRule::DeclareNotFirstStatement => &[("<?php echo 1; declare(strict_types=1);", "strict_types=1"), ("<?php echo 1; declare(encoding='UTF-8');", "encoding='UTF-8'"),],
            ForbiddenRule::NonLiteralDeclareValue => &[("<?php declare(ticks=A);", "ticks=A"), ("<?php declare(encoding=A);", "encoding=A"),],
            ForbiddenRule::InvalidStrictTypes => &[("<?php declare(strict_types=2);", "strict_types=2"), ("<?php declare(strict_types=1) {}", "strict_types=1"),],
            ForbiddenRule::AttributesOnMultipleConstants => &[("<?php #[A] const X = 1, Y = 2;", "const X = 1, Y = 2;"),],
            ForbiddenRule::AttributeArgumentUnpacking => &[("<?php #[A(...$a)] function f() {}", "...$a"),],
            ForbiddenRule::AttributeArgumentClosure => &[("<?php #[A(...)] function f() {}", "(...)"),],
            ForbiddenRule::VoidReturnValue => &[("<?php function f(): void { return 1; }", "return 1;"), ("<?php $f = fn(): void => 1;", "1"),],
            ForbiddenRule::NeverReturn => &[("<?php function f(): never { return; }", "return;"),],
            ForbiddenRule::VariadicParameterDefault => &[("<?php function f(...$a = []) {}", "...$a = []"),],
            ForbiddenRule::VariadicParameterNotLast => &[("<?php function f(...$a, $b) {}", "$b"),],
            ForbiddenRule::ThisAsDeclaredVariable => &[("<?php $f = function () use ($this) {};", "$this"), ("<?php function f($this) {}", "$this"), ("<?php function f() { global $this; }", "$this"), ("<?php function f() { static $this; }", "$this"),],
            ForbiddenRule::SuperglobalAsDeclaredVariable => &[("<?php $f = function () use ($_GET) {};", "$_GET"), ("<?php function f($_GET) {}", "$_GET"),],
            ForbiddenRule::DuplicateStaticVariable => &[("<?php function f() { static $a; static $a; }", "$a"),],
            ForbiddenRule::BreakOutOfLoop => &[("<?php break;", "break"), ("<?php while (1) { break 2; }", "break"),],
            ForbiddenRule::InvalidBreakOperand => &[("<?php while (1) { break $a; }", "break"), ("<?php while (1) { break 0; }", "break"),],
            ForbiddenRule::JumpAcrossFinally => &[("<?php while (1) { try {} finally { break; } }", "break"), ("<?php try {} finally { goto a; } a:", "goto a;"),],
            ForbiddenRule::DuplicateLabel => &[("<?php a: a:", "a:"),],
            ForbiddenRule::UndefinedGotoLabel => &[("<?php goto a;", "goto a;"),],
            ForbiddenRule::GotoIntoLoop => &[("<?php goto a; while (1) { a: }", "goto a;"),],
            ForbiddenRule::DuplicateSwitchDefault => &[("<?php switch ($x) { default: default: }", "default"),],
            ForbiddenRule::DuplicateMatchDefault => &[("<?php match ($x) { default => 1, default => 2 };", "default"),],
            ForbiddenRule::ReferenceKey => &[("<?php foreach ($a as &$k => $v) {}", "&$k"),],
            ForbiddenRule::ClassKeywordInCatch => &[("<?php try {} catch (self $e) {}", "self"),],
            ForbiddenRule::InvalidParentHookCall => &[("<?php class A extends B { function f() { parent::$x::get(); } }", "parent::$x::get()"),],
            ForbiddenRule::StaticClassInConstantExpression => &[("<?php class A { const X = static::class; }", "static"),],
            ForbiddenRule::AppendOutsideWrite => &[("<?php $x = $a[];", "$a[]"), ("<?php unset($a[]);", "$a[]"),],
            ForbiddenRule::InvalidGlobalsWrite => &[("<?php $GLOBALS[] = 1;", "$GLOBALS[]"), ("<?php $GLOBALS = [];", "$GLOBALS"), ("<?php $x = &$GLOBALS;", "$GLOBALS"),],
            ForbiddenRule::InvalidNullableType => &[("<?php function f(?mixed $x) {}", "mixed"), ("<?php function f(?null $x) {}", "null"),],
            ForbiddenRule::StandaloneTypeInComposite => &[("<?php function f(): ?void {}", "void"), ("<?php function f(): void|int {}", "void"),],
            ForbiddenRule::BuiltinTypeInIntersection => &[("<?php function f(int&A $x) {}", "int"),],
            ForbiddenRule::RedundantType => &[("<?php function f(object|A $x) {}", "object|A"), ("<?php function f((A&B)|A $x) {}", "A"), ("<?php function f(true|false $x) {}", "true|false"),],
            ForbiddenRule::DuplicateType => &[("<?php function f(int|int $x) {}", "int"),],
            ForbiddenRule::InvalidParameterType => &[("<?php function f(void $x) {}", "void"),],
            ForbiddenRule::InvalidMemberType => &[("<?php class A { public callable $x; }", "callable"),],
            ForbiddenRule::QualifiedBuiltinType => &[("<?php function f(\\int $x) {}", "\\int"),],
            ForbiddenRule::ReservedTypeName => &[("<?php function f(A\\int $x) {}", "A\\int"),],
            ForbiddenRule::IssetOnExpression => &[("<?php isset(f());", "f()"),],
            ForbiddenRule::ClosureForNew => &[("<?php new A(...);", "(...)"), ("<?php new class(...) {};", "(...)"),],
            ForbiddenRule::YieldOutsideFunction => &[("<?php yield 1;", "yield"),],
            ForbiddenRule::YieldFromInByReferenceGenerator => &[("<?php function &f() { yield from g(); }", "yield from g()"),],
            ForbiddenRule::PositionalAfterNamedArgument => &[("<?php f(a: 1, 2);", "2"),],
            ForbiddenRule::UnsetCast => &[("<?php $x = (unset) 1;", "unset"),],
            ForbiddenRule::BuiltinResultWrite => &[("<?php (clone $a)->b = 1;", "(clone $a)->b"), ("<?php $x = &f(...);", "f(...)"),],
            ForbiddenRule::TemporaryExpressionWrite => &[("<?php (1)[0] = 2;", "(1)[0]"), ("<?php (1)[0]++;", "(1)[0]"), ("<?php unset((1)[0]);", "(1)[0]"), ("<?php $x = &(1)[0];", "(1)[0]"),],
            ForbiddenRule::NullsafeWrite => &[("<?php $a?->b = 1;", "$a?->b"), ("<?php $a?->b++;", "$a?->b"), ("<?php unset($a?->b);", "$a?->b"),],
            ForbiddenRule::ReferenceToNullsafe => &[("<?php $x = &$a?->b;", "$a?->b"), ("<?php [&$x] = $a?->b;", "$a?->b"), ("<?php function &f() { return $a?->b; }", "$a?->b"),],
            ForbiddenRule::NullsafeClosureCreation => &[("<?php $a?->b(...);", "$a?->b(...)"),],
            ForbiddenRule::UnwritableDestructuringElement => &[("<?php [f()] = $a;", "f()"), ("<?php foreach ($a as [f()]) {}", "[f()]"),],
            ForbiddenRule::UnsetThis => &[("<?php function f() { unset($this); }", "$this"),],
            ForbiddenRule::ClosureUseShadowsParameter => &[("<?php $f = function ($a) use ($a) {};", "$a"),],
            ForbiddenRule::DuplicateClosureUseVariable => &[("<?php $f = function () use ($a, $a) {};", "$a"),],
            ForbiddenRule::LiteralClassName => &[("<?php (1)::A;", "(1)"), ("<?php (1)::class;", "(1)"),],
            ForbiddenRule::ClassFetchOnLiteral => &[("<?php (null)::class;", "(null)"),],
            ForbiddenRule::InvalidConstantExpression => &[("<?php const X = $a;", "$a"),],
            ForbiddenRule::EmptyList => &[("<?php [] = $a;", "[]"),],
            ForbiddenRule::EmptyKeyedArrayEntry => &[("<?php ['a' => $y, , 'b' => $z] = $a;", ","),],
            ForbiddenRule::MixedKeyedEntries => &[("<?php ['a' => $x, $y] = $a;", "$y"),],
            ForbiddenRule::MixedListSyntax => &[("<?php [list($a)] = $b;", "list($a)"),],
            ForbiddenRule::SpreadInDestructuring => &[("<?php [...$a] = $b;", "...$a"),],
            ForbiddenRule::UnparenthesizedNestedTernary => &[("<?php $x = 1 ? 2 : 3 ? 4 : 5;", "?"),],
            ForbiddenRule::UnparenthesizedArrowInPipe => &[("<?php $x = 1 |> fn($a) => $a;", "fn($a) => $a"),],
            ForbiddenRule::InvalidCurlyInterpolation => &[("<?php echo \"{$a + 1}\";", "$a + 1"),],
            ForbiddenRule::RepeatedAttribute => &[("<?php #[Override, Override] function f() {}", "Override"),],
            ForbiddenRule::NoDiscardOnInvalidTarget => &[("<?php class A { public $x { #[NoDiscard] get => 1; } }", "NoDiscard"), ("<?php class A { #[NoDiscard] function __construct() {} }", "NoDiscard"),],
            ForbiddenRule::NoDiscardWithoutReturnValue => &[("<?php #[NoDiscard] function f(): void {}", "NoDiscard"),],
            ForbiddenRule::DynamicClassFetch | ForbiddenRule::Other => &[],
        }
    }

    #[test]
    fn each_rule_reports_its_span() {
        for &rule in RULES {
            let gated = VERSION_GATED.iter().any(|&(r, ..)| r == rule);
            assert!(gated || !samples(rule).is_empty(), "{rule:?} has no sample");
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
    fn version_gated_rules_report_their_span() {
        for &(rule, version, src, text) in VERSION_GATED {
            let options = crate::ParseOptions::default().version(version);
            let errors = crate::parse_with(src, &options).errors;
            let spans: Vec<&str> = errors
                .iter()
                .filter(|e| e.forbidden_rule() == Some(rule))
                .map(|e| &src[e.span().start as usize..e.span().end as usize])
                .collect();
            assert_eq!(spans, [text], "{rule:?} in {src:?}: {errors:?}");
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
