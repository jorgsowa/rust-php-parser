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
    #[error("missing closing {delimiter}")]
    #[non_exhaustive]
    UnclosedDelimiter {
        /// The expected closing delimiter, e.g. `"')'"`.
        delimiter: Cow<'static, str>,
        /// Where the delimiter was opened.
        opened_at: Span,
        /// Source range of the error.
        span: Span,
    },

    /// A closing delimiter with no delimiter open, such as a `}` after the last block.
    #[error("unmatched {delimiter}")]
    #[non_exhaustive]
    UnmatchedDelimiter {
        /// The closing delimiter, e.g. `"'}'"`.
        delimiter: Cow<'static, str>,
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
            | ParseError::UnterminatedString { span }
            | ParseError::ExpectedAfter { span, .. }
            | ParseError::UnclosedDelimiter { span, .. }
            | ParseError::UnmatchedDelimiter { span, .. }
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

    /// When PHP reports the error: [`Phase::Compile`] only for a compile-time [`ForbiddenRule`].
    pub fn phase(&self) -> Phase {
        self.forbidden_rule()
            .map_or(Phase::Parse, ForbiddenRule::phase)
    }

    /// Stable kebab-case identifier: the variant's, or the rule's for [`ParseError::Forbidden`].
    pub fn code(&self) -> &'static str {
        match self {
            ParseError::Expected { .. } => "expected",
            ParseError::UnterminatedString { .. } => "unterminated-string",
            ParseError::ExpectedAfter { .. } => "expected-after",
            ParseError::UnclosedDelimiter { .. } => "unclosed-delimiter",
            ParseError::UnmatchedDelimiter { .. } => "unmatched-delimiter",
            ParseError::Forbidden { rule, .. } => rule.as_str(),
            ParseError::NestingTooDeep { .. } => "nesting-too-deep",
            ParseError::SourceTooLarge { .. } => "source-too-large",
            ParseError::VersionTooLow { .. } => "version-too-low",
        }
    }

    /// Whether the AST around the error is a recovery guess rather than what the source says.
    pub fn leaves_ast_incomplete(&self) -> bool {
        !matches!(
            self,
            ParseError::Forbidden { .. } | ParseError::VersionTooLow { .. }
        )
    }
}

/// When PHP reports an error, which `php -l` prints as a parse error or a fatal error.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
pub enum Phase {
    /// While lexing or parsing.
    Parse,
    /// While compiling.
    Compile,
}

/// The identifier given to `ForbiddenRule::from_str` names no rule.
#[derive(Debug, Clone, PartialEq, Eq, Error)]
#[error("unknown forbidden rule")]
pub struct UnknownForbiddenRule;

macro_rules! forbidden_rules {
    ($($(#[$doc:meta])* $rule:ident = $id:literal, $phase:ident;)*) => {
        /// The PHP rule a [`ParseError::Forbidden`] reports.
        ///
        /// Rules and their identifiers are stable API; message wording is not.
        #[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
        #[non_exhaustive]
        pub enum ForbiddenRule {
            $($(#[$doc])* $rule,)*
        }

        impl ForbiddenRule {
            /// Every rule, in declaration order.
            pub const ALL: &'static [ForbiddenRule] = &[$(ForbiddenRule::$rule),*];

            /// Stable kebab-case identifier, e.g. `"reassign-this"`.
            pub fn as_str(self) -> &'static str {
                match self {
                    $(ForbiddenRule::$rule => $id,)*
                }
            }

            /// When PHP reports the rule.
            pub fn phase(self) -> Phase {
                match self {
                    $(ForbiddenRule::$rule => Phase::$phase,)*
                }
            }
        }
    };
}

forbidden_rules! {
    /// `self`, `static` or `parent` used outside a class.
    ClassKeywordOutsideClass = "class-keyword-outside-class", Compile;
    /// `parent` used in a class that has no parent.
    ParentWithoutParentClass = "parent-without-parent-class", Compile;
    /// `__toString()` declares a return type other than `string`.
    ToStringReturnType = "to-string-return-type", Compile;
    /// A magic method other than `__toString()` declares a return type it may not have.
    MagicMethodReturnType = "magic-method-return-type", Compile;
    /// An internal attribute is applied to a target it does not allow.
    AttributeTargetMismatch = "attribute-target-mismatch", Compile;
    /// `#[Attribute]` is applied to an interface, trait, enum or abstract class.
    AttributeOnInvalidClass = "attribute-on-invalid-class", Compile;
    /// `#[Deprecated]` is applied to a class-like declaration.
    DeprecatedOnInvalidTarget = "deprecated-on-invalid-target", Compile;
    /// `#[AllowDynamicProperties]` is applied to an interface, trait, enum or readonly class.
    AllowDynamicPropertiesOnInvalidClass = "allow-dynamic-properties-on-invalid-class", Compile;
    /// A bare `return;` in a function that declares a return type.
    MissingReturnValue = "missing-return-value", Compile;
    /// A generator declares a return type that `Generator` does not satisfy.
    GeneratorReturnType = "generator-return-type", Compile;
    /// A readonly property has a default value.
    ReadonlyPropertyDefault = "readonly-property-default", Compile;
    /// Two parameters share a name.
    DuplicateParameter = "duplicate-parameter", Compile;
    /// `$this` is assigned or used as a `catch` variable.
    ReassignThis = "reassign-this", Compile;
    /// A `[`, `{` or `${` in an interpolated string is never closed.
    UnclosedInterpolation = "unclosed-interpolation", Parse;
    /// An interpolated array index is empty.
    EmptyInterpolationIndex = "empty-interpolation-index", Parse;
    /// A `${}` interpolation names no variable.
    EmptyInterpolationVariableName = "empty-interpolation-variable-name", Parse;
    /// The index in a `${name[...]}` interpolation is not closed.
    UnclosedInterpolationIndex = "unclosed-interpolation-index", Parse;
    /// A class constant is interpolated with `{$...}`.
    ClassConstantInterpolation = "class-constant-interpolation", Parse;
    /// A simple interpolation `"$a[...]"` has an invalid offset.
    InvalidInterpolationOffset = "invalid-interpolation-offset", Parse;
    /// A numeric literal has invalid digits, e.g. `08`.
    InvalidNumericLiteral = "invalid-numeric-literal", Parse;
    /// A `\u{...}` escape is empty or out of range.
    InvalidCodepointEscape = "invalid-codepoint-escape", Parse;
    /// A heredoc's closing indentation mixes tabs and spaces.
    MixedHeredocIndentation = "mixed-heredoc-indentation", Parse;
    /// A heredoc line is indented less than its closing marker.
    HeredocBodyIndentation = "heredoc-body-indentation", Parse;
    /// A namespaced name contains whitespace.
    WhitespaceInNamespacedName = "whitespace-in-namespaced-name", Parse;
    /// A member has more than one visibility modifier.
    MultipleVisibilityModifiers = "multiple-visibility-modifiers", Parse;
    /// A property has more than one set-visibility modifier.
    MultipleSetVisibilityModifiers = "multiple-set-visibility-modifiers", Parse;
    /// A modifier is repeated.
    DuplicateModifier = "duplicate-modifier", Parse;
    /// A declaration is both `abstract` and `final`.
    AbstractFinalConflict = "abstract-final-conflict", Parse;
    /// A class constant has a modifier constants cannot have.
    InvalidConstantModifier = "invalid-constant-modifier", Parse;
    /// A modifier is used where it cannot apply, e.g. `static` on a parameter.
    ModifierNotAllowed = "modifier-not-allowed", Parse;
    /// A reserved keyword names a declaration.
    KeywordAsDeclarationName = "keyword-as-declaration-name", Parse;
    /// A function is named `assert`, which PHP compiles specially.
    CustomAssertFunction = "custom-assert-function", Compile;
    /// A reserved type name names a class.
    ReservedClassName = "reserved-class-name", Parse;
    /// A statement that must be at the outermost scope is nested.
    OutermostScopeOnly = "outermost-scope-only", Parse;
    /// An intersection type is used in a union without parentheses.
    UnparenthesizedIntersectionInUnion = "unparenthesized-intersection-in-union", Parse;
    /// A parenthesized intersection type is not part of a union.
    ParenthesizedIntersectionOutsideUnion = "parenthesized-intersection-outside-union", Parse;
    /// `static` is used as a type where it cannot be.
    StaticTypePosition = "static-type-position", Parse;
    /// An attribute group `#[]` is empty.
    EmptyAttributeList = "empty-attribute-list", Parse;
    /// An argument is passed as `&$x`.
    CallTimePassByReference = "call-time-pass-by-reference", Parse;
    /// An offset is read with curly braces, `$a{0}`.
    CurlyOffsetAccess = "curly-offset-access", Parse;
    /// A `(void)` cast is used as an expression.
    VoidCastInExpression = "void-cast-in-expression", Parse;
    /// A `(real)` cast is used.
    RealCast = "real-cast", Parse;
    /// Non-associative operators are chained, e.g. `1 < 2 < 3`.
    NonAssociativeChain = "non-associative-chain", Parse;
    /// An increment or decrement is assigned to.
    IncDecAsAssignTarget = "inc-dec-as-assign-target", Parse;
    /// An expression that cannot be assigned to is assigned to.
    InvalidAssignTarget = "invalid-assign-target", Parse;
    /// A destructuring pattern is used with a compound assignment.
    CompoundAssignToDestructuring = "compound-assign-to-destructuring", Parse;
    /// A destructuring pattern is assigned by reference.
    ReferenceAssignToDestructuring = "reference-assign-to-destructuring", Parse;
    /// `++` or `--` is applied to something other than a variable.
    IncDecNonVariable = "inc-dec-non-variable", Parse;
    /// An expression that cannot be dereferenced is dereferenced.
    InvalidDereference = "invalid-dereference", Parse;
    /// An expression that cannot be written to is written to.
    InvalidWriteContext = "invalid-write-context", Parse;
    /// `list()` is used outside an assignment or `foreach` target.
    ListOutsideDestructuring = "list-outside-destructuring", Parse;
    /// An array literal has an empty element outside destructuring.
    EmptyArrayElement = "empty-array-element", Compile;
    /// A `new` expression is assigned by reference.
    ReferenceAssignNew = "reference-assign-new", Parse;
    /// A comma-separated property declaration has hooks.
    HooksOnPropertyList = "hooks-on-property-list", Parse;
    /// The right side of `instanceof` is not a class name, variable or parenthesized expression.
    InvalidInstanceofOperand = "invalid-instanceof-operand", Parse;
    /// More than one `;` precedes a switch's first case.
    SwitchLeadingSemicolons = "switch-leading-semicolons", Parse;
    /// Partial function application is used in a `new` expression.
    PartialApplicationInNew = "partial-application-in-new", Parse;
    /// A call combines a `?` or `...` placeholder with argument unpacking.
    PartialApplicationWithUnpacking = "partial-application-with-unpacking", Compile;
    /// `new A()` is dereferenced without parentheses before PHP 8.4.
    UnparenthesizedNewDereference = "unparenthesized-new-dereference", Parse;
    /// `static` is used as a standalone expression.
    StaticStandaloneExpression = "static-standalone-expression", Parse;
    /// A parenthesized expression is assigned by reference.
    ReferenceToParenthesized = "reference-to-parenthesized", Parse;
    /// A value that has no reference is assigned by reference.
    ReferenceToNonReferenceable = "reference-to-non-referenceable", Parse;
    /// `self`, `parent` or `static` is written fully qualified, e.g. `\self`.
    QualifiedClassKeyword = "qualified-class-keyword", Compile;
    /// A reserved name is extended, implemented or used as a trait.
    ReservedClassReference = "reserved-class-reference", Compile;
    /// A reserved type name names an enum.
    ReservedEnumName = "reserved-enum-name", Compile;
    /// An interface uses a trait.
    TraitInInterface = "trait-in-interface", Compile;
    /// A class that is not abstract has an abstract method or hook.
    AbstractMemberInConcreteClass = "abstract-member-in-concrete-class", Compile;
    /// A class declares a property twice.
    DuplicateProperty = "duplicate-property", Compile;
    /// A class declares a method twice.
    DuplicateMethod = "duplicate-method", Compile;
    /// A class declares a constant or enum case twice.
    DuplicateClassConstant = "duplicate-class-constant", Compile;
    /// A class constant is named `class`.
    ClassConstantNamedClass = "class-constant-named-class", Compile;
    /// A typed class constant's value does not match its type.
    ClassConstantValueType = "class-constant-value-type", Compile;
    /// A parameter's or property's literal default value does not match its type.
    DefaultValueType = "default-value-type", Compile;
    /// A private class constant is `final`.
    PrivateFinalConstant = "private-final-constant", Compile;
    /// An interface constant is not public.
    InvalidInterfaceConstantModifier = "invalid-interface-constant-modifier", Compile;
    /// An interface method is not public, or is `final` or `abstract`.
    InvalidInterfaceMethodModifier = "invalid-interface-method-modifier", Compile;
    /// An interface property is `abstract`, `final`, protected or private.
    InvalidInterfacePropertyModifier = "invalid-interface-property-modifier", Compile;
    /// An interface method has a body.
    InterfaceMethodBody = "interface-method-body", Compile;
    /// A method that is not abstract has no body.
    MissingMethodBody = "missing-method-body", Compile;
    /// An abstract method has a body.
    AbstractMethodBody = "abstract-method-body", Compile;
    /// An abstract method is private.
    PrivateAbstractMethod = "private-abstract-method", Compile;
    /// An anonymous class method is abstract.
    AbstractAnonymousClassMethod = "abstract-anonymous-class-method", Compile;
    /// An enum method is abstract.
    AbstractEnumMethod = "abstract-enum-method", Compile;
    /// A magic method takes the wrong number of parameters.
    MagicMethodArgumentCount = "magic-method-argument-count", Compile;
    /// A magic method takes a parameter by reference.
    MagicMethodByReference = "magic-method-by-reference", Compile;
    /// A magic method is static when it must not be, or the reverse.
    MagicMethodStatic = "magic-method-static", Compile;
    /// A magic method declares a parameter type it may not have.
    MagicMethodParameterType = "magic-method-parameter-type", Compile;
    /// A static property is readonly.
    StaticReadonlyProperty = "static-readonly-property", Compile;
    /// A readonly property has no type.
    UntypedReadonlyProperty = "untyped-readonly-property", Compile;
    /// A readonly property has hooks.
    ReadonlyPropertyHooks = "readonly-property-hooks", Compile;
    /// A property with set visibility has no type.
    UntypedAsymmetricProperty = "untyped-asymmetric-property", Compile;
    /// A property's set visibility is wider than its visibility.
    SetVisibilityWiderThanVisibility = "set-visibility-wider-than-visibility", Compile;
    /// A private property is `final`.
    PrivateFinalProperty = "private-final-property", Compile;
    /// A property hook of a private property is `final`.
    PrivateFinalPropertyHook = "private-final-property-hook", Compile;
    /// An abstract property has no abstract hook.
    AbstractPropertyWithoutAbstractHook = "abstract-property-without-abstract-hook", Compile;
    /// An interface declares a property without hooks.
    InterfacePropertyWithoutHooks = "interface-property-without-hooks", Compile;
    /// A static property has hooks.
    StaticPropertyHooks = "static-property-hooks", Compile;
    /// A virtual hooked property has a default value.
    VirtualPropertyDefault = "virtual-property-default", Compile;
    /// A virtual property has set visibility.
    VirtualPropertyAsymmetricVisibility = "virtual-property-asymmetric-visibility", Compile;
    /// A property hook list is empty.
    EmptyHookList = "empty-hook-list", Compile;
    /// A property declares the same hook twice.
    DuplicateHook = "duplicate-hook", Compile;
    /// A `get` hook has a parameter list.
    GetHookParameters = "get-hook-parameters", Compile;
    /// A `set` hook does not have exactly one parameter.
    SetHookParameterCount = "set-hook-parameter-count", Compile;
    /// A `set` hook parameter is by reference.
    SetHookParameterByReference = "set-hook-parameter-by-reference", Compile;
    /// A `set` hook parameter is variadic.
    SetHookParameterVariadic = "set-hook-parameter-variadic", Compile;
    /// A `set` hook parameter has a default value.
    SetHookParameterDefault = "set-hook-parameter-default", Compile;
    /// A `set` hook parameter's type does not accept the property's type.
    SetHookParameterType = "set-hook-parameter-type", Compile;
    /// A backed property with a `set` hook has a by-reference `get` hook.
    ByReferenceGetHookWithSet = "by-reference-get-hook-with-set", Compile;
    /// A hook of a property that is not abstract has no body.
    MissingHookBody = "missing-hook-body", Compile;
    /// An interface property hook has a body.
    AbstractHookBody = "abstract-hook-body", Compile;
    /// An abstract property hook is `final`.
    AbstractFinalHook = "abstract-final-hook", Compile;
    /// An abstract property hook is private.
    PrivateAbstractHook = "private-abstract-hook", Compile;
    /// A parameter outside a constructor is promoted.
    PromotedPropertyOutsideConstructor = "promoted-property-outside-constructor", Compile;
    /// A parameter of an abstract constructor is promoted.
    PromotedPropertyInAbstractConstructor = "promoted-property-in-abstract-constructor", Compile;
    /// A promoted parameter is variadic.
    VariadicPromotedProperty = "variadic-promoted-property", Compile;
    /// An enum's backing type is not `int` or `string`.
    InvalidEnumBackingType = "invalid-enum-backing-type", Compile;
    /// An enum case is named `class`.
    EnumCaseNamedClass = "enum-case-named-class", Compile;
    /// A case of a backed enum has no value.
    MissingEnumCaseValue = "missing-enum-case-value", Compile;
    /// A case of a pure enum has a value.
    PureEnumCaseValue = "pure-enum-case-value", Compile;
    /// A backed enum case value does not match the backing type (PHP 8.1 only).
    EnumCaseValueType = "enum-case-value-type", Compile;
    /// Two cases of a backed enum have the same value (PHP 8.1 only).
    DuplicateEnumCaseValue = "duplicate-enum-case-value", Compile;
    /// An enum declares a property.
    EnumProperty = "enum-property", Compile;
    /// A trait alias is `static` or `abstract`.
    InvalidTraitAliasModifier = "invalid-trait-alias-modifier", Compile;
    /// A `/*` comment is never closed.
    UnterminatedComment = "unterminated-comment", Parse;
    /// A named class-like is declared inside a class member.
    NestedClassDeclaration = "nested-class-declaration", Compile;
    /// Braced and unbraced namespace declarations are mixed.
    MixedNamespaceStyles = "mixed-namespace-styles", Compile;
    /// Code other than `declare` precedes the first namespace declaration.
    NamespaceNotFirst = "namespace-not-first", Compile;
    /// Code follows a braced namespace declaration.
    CodeOutsideNamespace = "code-outside-namespace", Compile;
    /// A namespace declaration is nested.
    NestedNamespace = "nested-namespace", Compile;
    /// A `use` import reuses a name already imported.
    UseNameConflict = "use-name-conflict", Compile;
    /// A `use` import is aliased to a reserved class name.
    SpecialClassNameAlias = "special-class-name-alias", Compile;
    /// `strict_types` or `encoding` is not declared first.
    DeclareNotFirstStatement = "declare-not-first-statement", Compile;
    /// A `declare` directive's value is not a literal.
    NonLiteralDeclareValue = "non-literal-declare-value", Compile;
    /// `strict_types` uses block mode or a value other than 0 or 1.
    InvalidStrictTypes = "invalid-strict-types", Compile;
    /// Attributes apply to a `const` statement declaring several constants.
    AttributesOnMultipleConstants = "attributes-on-multiple-constants", Compile;
    /// An attribute argument list unpacks with `...`.
    AttributeArgumentUnpacking = "attribute-argument-unpacking", Compile;
    /// An attribute argument list is a first-class callable `(...)`.
    AttributeArgumentClosure = "attribute-argument-closure", Compile;
    /// A `void` function returns a value.
    VoidReturnValue = "void-return-value", Compile;
    /// A `never` function returns.
    NeverReturn = "never-return", Compile;
    /// A variadic parameter has a default value.
    VariadicParameterDefault = "variadic-parameter-default", Compile;
    /// A parameter follows a variadic one.
    VariadicParameterNotLast = "variadic-parameter-not-last", Compile;
    /// `$this` is declared as a parameter, closure `use`, global or static variable.
    ThisAsDeclaredVariable = "this-as-declared-variable", Compile;
    /// A superglobal is declared as a parameter or closure `use` variable.
    SuperglobalAsDeclaredVariable = "superglobal-as-declared-variable", Compile;
    /// A static variable is declared twice in one function.
    DuplicateStaticVariable = "duplicate-static-variable", Compile;
    /// `break` or `continue` names more loop levels than enclose it.
    BreakOutOfLoop = "break-out-of-loop", Compile;
    /// `break` or `continue` has an operand that is not a positive integer literal.
    InvalidBreakOperand = "invalid-break-operand", Compile;
    /// `break`, `continue` or `goto` jumps into or out of a `finally` block.
    JumpAcrossFinally = "jump-across-finally", Compile;
    /// A `goto` label is defined twice.
    DuplicateLabel = "duplicate-label", Compile;
    /// `goto` names an undefined label.
    UndefinedGotoLabel = "undefined-goto-label", Compile;
    /// `goto` jumps into a loop or `switch`.
    GotoIntoLoop = "goto-into-loop", Compile;
    /// A `switch` has more than one `default`.
    DuplicateSwitchDefault = "duplicate-switch-default", Compile;
    /// A `match` has more than one `default` arm.
    DuplicateMatchDefault = "duplicate-match-default", Compile;
    /// A `foreach` key is taken by reference.
    ReferenceKey = "reference-key", Compile;
    /// A `foreach` key is a destructuring list.
    ListAsForeachKey = "list-as-foreach-key", Compile;
    /// `catch` names `self`, `parent` or `static`.
    ClassKeywordInCatch = "class-keyword-in-catch", Compile;
    /// `parent::$x::get()` or `::set()` is called outside the matching hook.
    InvalidParentHookCall = "invalid-parent-hook-call", Compile;
    /// `static::class` is used in a constant expression.
    StaticClassInConstantExpression = "static-class-in-constant-expression", Compile;
    /// `$a[]` is read or unset.
    AppendOutsideWrite = "append-outside-write", Compile;
    /// `$GLOBALS` is written to as a whole, appended to or referenced.
    InvalidGlobalsWrite = "invalid-globals-write", Compile;
    /// `mixed` or `null` is marked nullable.
    InvalidNullableType = "invalid-nullable-type", Compile;
    /// `void`, `never` or `mixed` is part of a nullable or union type.
    StandaloneTypeInComposite = "standalone-type-in-composite", Compile;
    /// A builtin type is part of an intersection type.
    BuiltinTypeInIntersection = "builtin-type-in-intersection", Compile;
    /// A type is redundant with another in the same declaration.
    RedundantType = "redundant-type", Compile;
    /// A type appears twice in a union or intersection type.
    DuplicateType = "duplicate-type", Compile;
    /// A parameter is typed `void` or `never`.
    InvalidParameterType = "invalid-parameter-type", Compile;
    /// A property or constant has a type it may not have, e.g. `callable`.
    InvalidMemberType = "invalid-member-type", Compile;
    /// A builtin type is written with a namespace, e.g. `\int`.
    QualifiedBuiltinType = "qualified-builtin-type", Compile;
    /// A qualified type name ends in a reserved name.
    ReservedTypeName = "reserved-type-name", Compile;
    /// `isset()` is applied to the result of an expression.
    IssetOnExpression = "isset-on-expression", Compile;
    /// A `new` expression is turned into a first-class callable `(...)`.
    ClosureForNew = "closure-for-new", Compile;
    /// `yield` is used outside a function.
    YieldOutsideFunction = "yield-outside-function", Compile;
    /// `yield from` is used in a by-reference generator.
    YieldFromInByReferenceGenerator = "yield-from-in-by-reference-generator", Compile;
    /// A positional argument follows a named one.
    PositionalAfterNamedArgument = "positional-after-named-argument", Compile;
    /// A positional argument follows argument unpacking, as in `f(...$a, 1)`.
    PositionalAfterUnpacking = "positional-after-unpacking", Compile;
    /// A method name PHP folds to a value other than a string, as in `$o->{1}()`.
    MethodNameNotString = "method-name-not-string", Compile;
    /// An `(unset)` cast is used.
    UnsetCast = "unset-cast", Compile;
    /// The result of a builtin such as `clone` is written to.
    BuiltinResultWrite = "builtin-result-write", Compile;
    /// The result of a function or method call is written to, e.g. `f() = 1`.
    CallResultWrite = "call-result-write", Compile;
    /// A temporary value is written to, e.g. `(1)[0] = 2`.
    TemporaryExpressionWrite = "temporary-expression-write", Compile;
    /// A nullsafe chain is written to.
    NullsafeWrite = "nullsafe-write", Compile;
    /// A nullsafe chain is taken by reference.
    ReferenceToNullsafe = "reference-to-nullsafe", Compile;
    /// A nullsafe call is turned into a first-class callable `(...)`.
    NullsafeClosureCreation = "nullsafe-closure-creation", Compile;
    /// A destructuring element cannot be assigned to.
    UnwritableDestructuringElement = "unwritable-destructuring-element", Compile;
    /// `$this` is unset.
    UnsetThis = "unset-this", Compile;
    /// A closure `use` variable has the name of a parameter.
    ClosureUseShadowsParameter = "closure-use-shadows-parameter", Compile;
    /// A closure `use` list names a variable twice.
    DuplicateClosureUseVariable = "duplicate-closure-use-variable", Compile;
    /// A numeric literal is used as a class name, e.g. `(1)::A`.
    LiteralClassName = "literal-class-name", Compile;
    /// `::class` is applied to `true`, `false`, `null` or an array literal.
    ClassFetchOnLiteral = "class-fetch-on-literal", Compile;
    /// `::class` is applied to a value PHP folds at compile time, e.g. `(-1)::class`.
    ClassFetchOnFoldedValue = "class-fetch-on-folded-value", Compile;
    /// `::class` is applied to a dynamic class name before PHP 8.0.
    DynamicClassFetch = "dynamic-class-fetch", Compile;
    /// PHP 7.4 folds arithmetic on an array, or `~` on a bool, null or array, e.g. `[] - 1`.
    UnsupportedOperandTypes = "unsupported-operand-types", Compile;
    /// A constant expression contains something PHP cannot evaluate at compile time.
    InvalidConstantExpression = "invalid-constant-expression", Compile;
    /// A destructuring list is empty.
    EmptyList = "empty-list", Compile;
    /// A keyed destructuring list has an empty entry.
    EmptyKeyedArrayEntry = "empty-keyed-array-entry", Compile;
    /// A destructuring list mixes keyed and unkeyed entries.
    MixedKeyedEntries = "mixed-keyed-entries", Compile;
    /// A destructuring pattern mixes `[]` and `list()`.
    MixedListSyntax = "mixed-list-syntax", Compile;
    /// A nested destructuring target is written with `array()`, as in `[array($a)] = $b`.
    LongArrayInDestructuring = "long-array-in-destructuring", Compile;
    /// A destructuring list uses `...`.
    SpreadInDestructuring = "spread-in-destructuring", Compile;
    /// An array literal PHP folds unpacks a value that is not an array, as in `[...1]`.
    UnpackNonArray = "unpack-non-array", Compile;
    /// Before PHP 8.1, an array literal PHP folds unpacks an array with a string key.
    UnpackStringKeys = "unpack-string-keys", Compile;
    /// Nested ternaries are not parenthesized, e.g. `a ? b : c ? d : e`.
    UnparenthesizedNestedTernary = "unparenthesized-nested-ternary", Compile;
    /// An arrow function on the right of `|>` is not parenthesized.
    UnparenthesizedArrowInPipe = "unparenthesized-arrow-in-pipe", Compile;
    /// A `{$...}` interpolation is not a variable, property, index or call.
    InvalidCurlyInterpolation = "invalid-curly-interpolation", Compile;
    /// A non-repeatable attribute is applied twice.
    RepeatedAttribute = "repeated-attribute", Compile;
    /// `#[\NoDiscard]` is applied to a property hook or a method it cannot apply to.
    NoDiscardOnInvalidTarget = "no-discard-on-invalid-target", Compile;
    /// `#[\NoDiscard]` is applied to a function that returns no value.
    NoDiscardWithoutReturnValue = "no-discard-without-return-value", Compile;
    /// A control character appears in code.
    UnexpectedCharacter = "unexpected-character", Parse;
    /// A cast token such as `(int)` where no cast can start, as in `foo(int)`.
    UnexpectedCast = "unexpected-cast", Parse;
    /// Not yet classified.
    Other = "other", Compile;
}

impl std::fmt::Display for ForbiddenRule {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        f.write_str(self.as_str())
    }
}

impl std::str::FromStr for ForbiddenRule {
    type Err = UnknownForbiddenRule;

    fn from_str(s: &str) -> Result<Self, Self::Err> {
        ForbiddenRule::ALL
            .iter()
            .copied()
            .find(|rule| rule.as_str() == s)
            .ok_or(UnknownForbiddenRule)
    }
}

#[cfg(test)]
mod tests {
    use super::{ForbiddenRule, ParseError, Span};
    use crate::PhpVersion;

    /// `(rule, version, source, reported span text)` for sites that report only at some versions.
    const VERSION_GATED: &[(ForbiddenRule, PhpVersion, &str, &str)] = &[
        (
            ForbiddenRule::EnumCaseValueType,
            PhpVersion::Php81,
            "<?php enum E: int { case A = \"a\"; }",
            "\"a\"",
        ),
        (
            ForbiddenRule::DuplicateEnumCaseValue,
            PhpVersion::Php81,
            "<?php enum E: int { case A = 1; case B = 1; }",
            "1",
        ),
        (
            ForbiddenRule::PartialApplicationWithUnpacking,
            PhpVersion::Php86,
            "<?php f(...$a, ?);",
            "?",
        ),
        (
            ForbiddenRule::NeverReturn,
            PhpVersion::Php81,
            "<?php $f = fn(): never => 1;",
            "1",
        ),
        (
            ForbiddenRule::UnpackStringKeys,
            PhpVersion::Php80,
            "<?php $a = [...['a' => 1]];",
            "['a' => 1]",
        ),
        (
            ForbiddenRule::DynamicClassFetch,
            PhpVersion::Php74,
            "<?php $a::class;",
            "$a",
        ),
        (
            ForbiddenRule::UnsupportedOperandTypes,
            PhpVersion::Php74,
            "<?php $a = [] - 1;",
            "[] - 1",
        ),
        (
            ForbiddenRule::QualifiedBuiltinType,
            PhpVersion::Php85,
            "<?php class A { function m(): namespace\\static {} }",
            "namespace\\static",
        ),
        (
            ForbiddenRule::QualifiedBuiltinType,
            PhpVersion::Php85,
            "<?php function f(): \\static {}",
            "\\static",
        ),
        (
            ForbiddenRule::QualifiedClassKeyword,
            PhpVersion::Php84,
            "<?php function f(): \\static {}",
            "\\static",
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
            ForbiddenRule::CustomAssertFunction => &[("<?php namespace A; function Assert() {}", "Assert"),],
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
            ForbiddenRule::IncDecNonVariable => &[("<?php A++;", "A"),],
            ForbiddenRule::InvalidDereference => &[("<?php echo 1[0];", "1"),],
            ForbiddenRule::InvalidWriteContext => &[("<?php unset(A);", "A"),],
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
            ForbiddenRule::DefaultValueType => &[("<?php function f(int $x = \"a\") {}", "\"a\""), ("<?php class A { public int $x = null; }", "null"),],
            ForbiddenRule::PrivateFinalConstant => &[("<?php class A { final private const X = 1; }", "final private const X = 1;"), ("<?php enum E { final private const X = 1; }", "final private const X = 1;"),],
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
            ForbiddenRule::StaticReadonlyProperty => &[("<?php class A { public static readonly int $x; }", "public static readonly int $x"), ("<?php class A { public readonly static int $x; }", "public readonly static int $x"),],
            ForbiddenRule::UntypedReadonlyProperty => &[("<?php class A { public readonly $x; }", "public readonly $x"), ("<?php class A { function __construct(public readonly $x) {} }", "public readonly $x"),],
            ForbiddenRule::ReadonlyPropertyHooks => &[("<?php class A { public readonly int $x { get => 1; } }", "get => 1;"), ("<?php class A { function __construct(public readonly int $x { get => 1; }) {} }", "get => 1;"),],
            ForbiddenRule::UntypedAsymmetricProperty => &[("<?php class A { public private(set) $x; }", "public private(set) $x"), ("<?php class A { function __construct(public private(set) $x) {} }", "public private(set) $x"),],
            ForbiddenRule::SetVisibilityWiderThanVisibility => &[("<?php class A { private public(set) int $x; }", "private public(set) int $x"), ("<?php class A { function __construct(private public(set) int $x) {} }", "private public(set) int $x"),],
            ForbiddenRule::PrivateFinalProperty => &[("<?php class A { final private $x; }", "final private $x"),],
            ForbiddenRule::PrivateFinalPropertyHook => &[("<?php class A { private $x { final get => 1; } }", "final get => 1;"),],
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
            ForbiddenRule::SetHookParameterDefault => &[("<?php class A { public $x { set($v = 1) {} } }", "$v = 1"),],
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
            ForbiddenRule::EnumProperty => &[("<?php enum E { public int $a; }", "$a"), ("<?php enum E { var $a, $b; }", "$a"),],
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
            ForbiddenRule::ListAsForeachKey => &[("<?php foreach ($a as [$k] => $v) {}", "[$k]"),],
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
            ForbiddenRule::PositionalAfterUnpacking => &[("<?php f(...$a, 2);", "2"),],
            ForbiddenRule::MethodNameNotString => &[("<?php $o->{1}();", "1"), ("<?php A::{-1}();", "-1"),],
            ForbiddenRule::UnsetCast => &[("<?php $x = (unset) 1;", "unset"),],
            ForbiddenRule::BuiltinResultWrite => &[("<?php (clone $a)->b = 1;", "(clone $a)->b"), ("<?php $x = &f(...);", "f(...)"),],
            ForbiddenRule::CallResultWrite => &[("<?php f() = 1;", "f()"), ("<?php $a->f()++;", "$a->f()"), ("<?php unset(A::f());", "A::f()"), ("<?php [f(...)] = $a;", "f(...)"), ("<?php foreach ($a as $k => $b?->f()) {}", "$b?->f()"),],
            ForbiddenRule::TemporaryExpressionWrite => &[("<?php (1)[0] = 2;", "(1)[0]"), ("<?php (1)[0]++;", "(1)[0]"), ("<?php unset((1)[0]);", "(1)[0]"), ("<?php $x = &(1)[0];", "(1)[0]"),],
            ForbiddenRule::NullsafeWrite => &[("<?php $a?->b = 1;", "$a?->b"), ("<?php $a?->b++;", "$a?->b"), ("<?php unset($a?->b);", "$a?->b"),],
            ForbiddenRule::ReferenceToNullsafe => &[("<?php $x = &$a?->b;", "$a?->b"), ("<?php [&$x] = $a?->b;", "$a?->b"), ("<?php function &f() { return $a?->b; }", "$a?->b"),],
            ForbiddenRule::NullsafeClosureCreation => &[("<?php $a?->b(...);", "$a?->b(...)"),],
            ForbiddenRule::UnwritableDestructuringElement => &[("<?php [A] = $a;", "A"), ("<?php foreach ($a as [A]) {}", "A"),],
            ForbiddenRule::UnsetThis => &[("<?php function f() { unset($this); }", "$this"),],
            ForbiddenRule::ClosureUseShadowsParameter => &[("<?php $f = function ($a) use ($a) {};", "$a"),],
            ForbiddenRule::DuplicateClosureUseVariable => &[("<?php $f = function () use ($a, $a) {};", "$a"),],
            ForbiddenRule::LiteralClassName => &[("<?php (1)::A;", "(1)"), ("<?php (1)::class;", "(1)"),],
            ForbiddenRule::ClassFetchOnLiteral => &[("<?php (null)::class;", "(null)"),],
            ForbiddenRule::ClassFetchOnFoldedValue => &[("<?php echo (-1)::class;", "(-1)"),],
            ForbiddenRule::InvalidConstantExpression => &[("<?php const X = $a;", "$a"),],
            ForbiddenRule::EmptyList => &[("<?php [] = $a;", "[]"),],
            ForbiddenRule::EmptyKeyedArrayEntry => &[("<?php ['a' => $y, , 'b' => $z] = $a;", ","),],
            ForbiddenRule::MixedKeyedEntries => &[("<?php ['a' => $x, $y] = $a;", "$y"),],
            ForbiddenRule::MixedListSyntax => &[("<?php [list($a)] = $b;", "list($a)"),],
            ForbiddenRule::LongArrayInDestructuring => &[("<?php [array($a)] = $b;", "array($a)"),],
            ForbiddenRule::SpreadInDestructuring => &[("<?php [...$a] = $b;", "...$a"),],
            ForbiddenRule::UnpackNonArray => &[("<?php $a = [1, ...2];", "2"),],
            ForbiddenRule::UnparenthesizedNestedTernary => &[("<?php $x = 1 ? 2 : 3 ? 4 : 5;", "?"),],
            ForbiddenRule::UnparenthesizedArrowInPipe => &[("<?php $x = 1 |> fn($a) => $a;", "fn($a) => $a"),],
            ForbiddenRule::InvalidCurlyInterpolation => &[("<?php echo \"{$a + 1}\";", "$a + 1"),],
            ForbiddenRule::RepeatedAttribute => &[("<?php #[Override, Override] function f() {}", "Override"),],
            ForbiddenRule::NoDiscardOnInvalidTarget => &[("<?php class A { public $x { #[NoDiscard] get => 1; } }", "NoDiscard"), ("<?php class A { #[NoDiscard] function __construct() {} }", "NoDiscard"),],
            ForbiddenRule::NoDiscardWithoutReturnValue => &[("<?php #[NoDiscard] function f(): void {}", "NoDiscard"),],
            ForbiddenRule::UnexpectedCharacter => &[("<?php $a\x01\x02 = 1;", "\x01\x02"), ("<?php $a =\x0c1;", "\x0c"),],
            ForbiddenRule::UnexpectedCast => &[("<?php foo(int);", "(int)"), ("<?php if ( float ) {}", "( float )"),],
            ForbiddenRule::DynamicClassFetch
            | ForbiddenRule::UnpackStringKeys
            | ForbiddenRule::UnsupportedOperandTypes
            | ForbiddenRule::PartialApplicationWithUnpacking
            | ForbiddenRule::EnumCaseValueType
            | ForbiddenRule::DuplicateEnumCaseValue
            | ForbiddenRule::Other => &[],
        }
    }

    #[test]
    fn each_rule_reports_its_span() {
        for &rule in ForbiddenRule::ALL {
            if rule == ForbiddenRule::Other {
                continue;
            }
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
    fn relative_static_type_is_valid_in_a_class_before_8_5() {
        let options = crate::ParseOptions::default().version(PhpVersion::Php84);
        let src = "<?php class A { function m(): namespace\\static {} }";
        assert_eq!(crate::parse_with(src, &options).errors.len(), 0);
    }

    #[test]
    fn identifiers_are_unique_and_parse_back() {
        let mut ids: Vec<&str> = ForbiddenRule::ALL.iter().map(|r| r.as_str()).collect();
        ids.sort_unstable();
        ids.dedup();
        assert_eq!(ids.len(), ForbiddenRule::ALL.len());
        for &rule in ForbiddenRule::ALL {
            assert_eq!(rule.as_str().parse(), Ok(rule));
        }
        assert_eq!(
            "no-such-rule".parse::<ForbiddenRule>(),
            Err(super::UnknownForbiddenRule)
        );
    }

    #[test]
    fn codes_are_unique_and_only_syntax_errors_leave_the_ast_incomplete() {
        let span = Span::new(0, 0);
        let incomplete = [
            ParseError::Expected {
                expected: "';'".into(),
                found: "'}'".into(),
                span,
            },
            ParseError::UnterminatedString { span },
            ParseError::ExpectedAfter {
                expected: "';'".into(),
                after: "expression".into(),
                span,
            },
            ParseError::UnclosedDelimiter {
                delimiter: "')'".into(),
                opened_at: span,
                span,
            },
            ParseError::UnmatchedDelimiter {
                delimiter: "'}'".into(),
                span,
            },
            ParseError::NestingTooDeep { span },
            ParseError::SourceTooLarge { len: 0, span },
        ];
        let complete = [
            ParseError::Forbidden {
                rule: ForbiddenRule::ReassignThis,
                message: "Cannot re-assign $this".into(),
                span,
            },
            ParseError::VersionTooLow {
                feature: "match".into(),
                required: PhpVersion::Php80,
                used: PhpVersion::Php74,
                span,
            },
        ];
        assert!(incomplete.iter().all(ParseError::leaves_ast_incomplete));
        assert!(!complete.iter().any(ParseError::leaves_ast_incomplete));
        assert_eq!(complete[0].code(), "reassign-this");
        let mut codes: Vec<&str> = ForbiddenRule::ALL.iter().map(|r| r.as_str()).collect();
        codes.extend(
            incomplete
                .iter()
                .chain(&complete[1..])
                .map(ParseError::code),
        );
        let count = codes.len();
        codes.sort_unstable();
        codes.dedup();
        assert_eq!(codes.len(), count);
    }

    #[test]
    fn rule_adds_no_size() {
        assert_eq!(std::mem::size_of::<ParseError>(), 64);
    }
}
