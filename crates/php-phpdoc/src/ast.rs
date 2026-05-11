use php_ast::Span;
use serde::Serialize;

// =============================================================================
// Type AST
// =============================================================================

/// A structured PHPDoc type expression with a comment-relative span.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocType {
    pub kind: PhpDocTypeKind,
    /// Byte offsets within the original doc-comment string (0 = start of `/**`).
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum PhpDocTypeKind {
    /// Named type: `int`, `string`, `Foo`, `\App\User`, `non-empty-string`.
    /// Also used for Psalm's `$param` subject in conditionals.
    Named(String),
    /// `A|B|C`
    Union(Vec<PhpDocType>),
    /// `A&B`
    Intersection(Vec<PhpDocType>),
    /// `?T`
    Nullable(Box<PhpDocType>),
    /// `array<K, V>`, `list<T>`, `Generator<TKey, TValue, TSend, TReturn>`
    Generic {
        base: Box<PhpDocType>,
        args: Vec<PhpDocType>,
    },
    /// `array{key: T, opt?: U, ...}`
    ArrayShape {
        fields: Vec<ArrayShapeField>,
        /// Whether the shape ends with `...` (allows extra keys)
        extra: bool,
    },
    /// `callable(int, string): bool` or `\Closure(T): U`
    Callable {
        params: Vec<CallableParam>,
        return_type: Option<Box<PhpDocType>>,
    },
    /// String/int/bool literal: `'foo'`, `42`, `true`, `false`, `null`
    Literal(String),
    /// `(T is U ? A : B)` — PHPStan/Psalm conditional type.
    /// Psalm's `($param is T ? A : B)` form stores `$param` as `Named("$param")` in `subject`.
    Conditional {
        subject: Box<PhpDocType>,
        target: Box<PhpDocType>,
        then_type: Box<PhpDocType>,
        else_type: Box<PhpDocType>,
    },
    /// Fallback for unrecognised type text. Never panics.
    Unknown(String),
}

/// A field in an array shape type: `key: T` or `key?: T`.
#[derive(Debug, Clone, Serialize)]
pub struct ArrayShapeField {
    /// `None` for positional (integer-keyed) fields.
    pub key: Option<String>,
    /// Whether the field is optional (`key?:`).
    pub optional: bool,
    pub value_type: PhpDocType,
    pub span: Span,
}

/// A parameter in a callable/Closure type.
#[derive(Debug, Clone, Serialize)]
pub struct CallableParam {
    pub param_type: PhpDocType,
    /// Optional name: `$x` in `callable(int $x): void`.
    pub name: Option<String>,
    pub by_ref: bool,
    pub variadic: bool,
    pub span: Span,
}

// =============================================================================
// Tag AST
// =============================================================================

/// A parsed `@tag` with its comment-relative span.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDocTag {
    pub kind: PhpDocTagKind,
    /// Byte span of the full tag (including multi-line continuation) within the comment.
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum PhpDocTagKind {
    /// `@param [type] $name [description]`
    Param {
        ty: Option<PhpDocType>,
        name: Option<String>,
        description: Option<String>,
    },
    /// `@return [type] [description]`
    Return {
        ty: Option<PhpDocType>,
        description: Option<String>,
    },
    /// `@var [type] [$name] [description]`
    Var {
        ty: Option<PhpDocType>,
        name: Option<String>,
        description: Option<String>,
    },
    /// `@throws [type] [description]`
    Throws {
        ty: Option<PhpDocType>,
        description: Option<String>,
    },
    /// `@deprecated [description]`
    Deprecated { description: Option<String> },
    /// `@template T [of Bound]`
    Template {
        name: String,
        bound: Option<PhpDocType>,
    },
    /// `@template-covariant T [of Bound]`
    TemplateCovariant {
        name: String,
        bound: Option<PhpDocType>,
    },
    /// `@template-contravariant T [of Bound]`
    TemplateContravariant {
        name: String,
        bound: Option<PhpDocType>,
    },
    /// `@extends Type`
    Extends { ty: PhpDocType },
    /// `@implements Type`
    Implements { ty: PhpDocType },
    /// `@method [static] [return_type] name([params]) [description]`
    Method {
        is_static: bool,
        return_type: Option<PhpDocType>,
        name: String,
        params: Vec<MethodParam>,
        description: Option<String>,
    },
    /// `@property [type] $name [description]`
    Property {
        ty: Option<PhpDocType>,
        name: Option<String>,
        description: Option<String>,
    },
    /// `@property-read [type] $name [description]`
    PropertyRead {
        ty: Option<PhpDocType>,
        name: Option<String>,
        description: Option<String>,
    },
    /// `@property-write [type] $name [description]`
    PropertyWrite {
        ty: Option<PhpDocType>,
        name: Option<String>,
        description: Option<String>,
    },
    /// `@see reference`
    See { reference: String },
    /// `@link url`
    Link { url: String },
    /// `@since version`
    Since { version: String },
    /// `@author name`
    Author { name: String },
    /// `@internal`
    Internal,
    /// `@inheritdoc` / `{@inheritdoc}`
    InheritDoc,
    /// `@psalm-assert`, `@phpstan-assert` — assert a parameter has a type after the call.
    Assert {
        ty: Option<PhpDocType>,
        name: Option<String>,
    },
    /// `@psalm-type`, `@phpstan-type` — local type alias.
    TypeAlias {
        name: Option<String>,
        ty: Option<PhpDocType>,
    },
    /// `@psalm-import-type`, `@phpstan-import-type` — import a type alias.
    ImportType { body: String },
    /// `@psalm-suppress`, `@phpstan-ignore-next-line`, `@phpstan-ignore`.
    Suppress { rules: String },
    /// `@psalm-pure`, `@pure`
    Pure,
    /// `@psalm-readonly`, `@readonly`
    Readonly,
    /// `@psalm-immutable`, `@immutable`
    Immutable,
    /// `@mixin Class`
    Mixin { class: String },
    /// Any unrecognised tag: `@tagname [body]`
    Generic { tag: String, body: Option<String> },
}

/// A parameter in a `@method` signature.
#[derive(Debug, Clone, Serialize)]
pub struct MethodParam {
    pub ty: Option<PhpDocType>,
    pub name: String,
    pub by_ref: bool,
    pub variadic: bool,
    /// Raw default expression text if present (e.g. `"null"`, `"[]"`).
    pub default: Option<String>,
    pub span: Span,
}

// =============================================================================
// Top-level document
// =============================================================================

/// A fully parsed PHPDoc comment block.
#[derive(Debug, Clone, Serialize)]
pub struct PhpDoc {
    /// First non-blank paragraph before the first tag.
    pub summary: Option<String>,
    /// Full multi-line text after the summary paragraph, before the first tag.
    /// Lines are joined with `\n`.
    pub description: Option<String>,
    pub tags: Vec<PhpDocTag>,
    /// Always `Span::new(0, text.len() as u32)`.
    pub span: Span,
}
