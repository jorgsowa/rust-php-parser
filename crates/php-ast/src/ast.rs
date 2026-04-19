use std::borrow::Cow;

use serde::Serialize;

use crate::Span;

fn is_false(b: &bool) -> bool {
    !*b
}

/// Arena-allocated Vec. Thin newtype over bumpalo::collections::Vec that implements Serialize and Debug.
pub struct ArenaVec<'arena, T>(bumpalo::collections::Vec<'arena, T>);

impl<'arena, T> ArenaVec<'arena, T> {
    #[inline]
    pub fn new_in(arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::new_in(arena))
    }
    #[inline]
    pub fn with_capacity_in(cap: usize, arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::with_capacity_in(cap, arena))
    }
    #[inline]
    pub fn push(&mut self, val: T) {
        self.0.push(val)
    }
    /// Kept as an explicit method so `"ArenaVec::is_empty"` works as a serde
    /// `skip_serializing_if` path (deref-inherited methods don't resolve via UFCS).
    #[inline]
    pub fn is_empty(&self) -> bool {
        self.0.is_empty()
    }
}

impl<'arena, T> IntoIterator for ArenaVec<'arena, T> {
    type Item = T;
    type IntoIter = bumpalo::collections::vec::IntoIter<'arena, T>;
    #[inline]
    fn into_iter(self) -> Self::IntoIter {
        self.0.into_iter()
    }
}

impl<'arena, T> std::ops::Deref for ArenaVec<'arena, T> {
    type Target = [T];
    #[inline]
    fn deref(&self) -> &[T] {
        &self.0
    }
}

impl<'arena, T> std::ops::DerefMut for ArenaVec<'arena, T> {
    #[inline]
    fn deref_mut(&mut self) -> &mut [T] {
        &mut self.0
    }
}

impl<'arena, T: serde::Serialize> serde::Serialize for ArenaVec<'arena, T> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        self.0.as_slice().serialize(s)
    }
}

impl<'arena, T: std::fmt::Debug> std::fmt::Debug for ArenaVec<'arena, T> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        self.0.as_slice().fmt(f)
    }
}

/// A comment found in the source file.
#[derive(Debug, Serialize)]
pub struct Comment<'src> {
    pub kind: CommentKind,
    /// Raw text of the comment including its delimiters (e.g. `// foo`, `/* bar */`, `/** baz */`).
    pub text: &'src str,
    pub span: Span,
}

/// Distinguishes the four syntactic forms of PHP comment.
#[derive(Debug, Serialize, Clone, Copy, PartialEq, Eq)]
pub enum CommentKind {
    /// `// …` — single-line slash comment
    Line,
    /// `# …` — single-line hash comment
    Hash,
    /// `/* … */` — block comment
    Block,
    /// `/** … */` — doc-block comment (first non-whitespace char after `/*` is `*`)
    Doc,
}

// =============================================================================
/// The root AST node representing a complete PHP file.
#[derive(Debug, Serialize)]
pub struct Program<'arena, 'src> {
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Names and Types
// =============================================================================

/// A PHP name (identifier, qualified name, fully-qualified name, or relative name).
///
/// The `Simple` variant is the fast path for the common case (~95%) of single
/// unqualified identifiers like `strlen`, `Foo`, `MyClass`. It avoids allocating
/// an `ArenaVec` entirely.
///
/// The `Complex` variant handles qualified (`Foo\Bar`), fully-qualified (`\Foo\Bar`),
/// and relative (`namespace\Foo`) names.
pub enum Name<'arena, 'src> {
    /// Single unqualified identifier — no `ArenaVec` allocation.
    /// `&'src str` instead of `Cow` since this is always a borrowed slice of the source.
    Simple { value: &'src str, span: Span },
    /// Multi-part or prefixed name (`Foo\Bar`, `\Foo`, `namespace\Foo`).
    Complex {
        parts: ArenaVec<'arena, &'src str>,
        kind: NameKind,
        span: Span,
    },
}

impl<'arena, 'src> Name<'arena, 'src> {
    #[inline]
    pub fn span(&self) -> Span {
        match self {
            Self::Simple { span, .. } | Self::Complex { span, .. } => *span,
        }
    }

    #[inline]
    pub fn kind(&self) -> NameKind {
        match self {
            Self::Simple { .. } => NameKind::Unqualified,
            Self::Complex { kind, .. } => *kind,
        }
    }

    /// Returns the name as a borrowed slice of the source string.
    ///
    /// Unlike [`to_string_repr`], this never allocates: it uses the stored
    /// span to slice directly into `src`.  The slice includes any leading `\`
    /// for fully-qualified names, exactly as it appears in the source.
    ///
    /// Use this when you need a zero-copy `&'src str` and already have the
    /// source buffer available (e.g. inside [`crate::visitor::ScopeWalker`]).
    #[inline]
    pub fn src_repr(&self, src: &'src str) -> &'src str {
        match self {
            Self::Simple { value, .. } => value,
            Self::Complex { span, .. } => &src[span.start as usize..span.end as usize],
        }
    }

    /// Joins all parts with `\` and prepends `\` if fully qualified.
    /// Returns `Cow::Borrowed` for simple names (zero allocation).
    #[inline]
    pub fn to_string_repr(&self) -> Cow<'src, str> {
        match self {
            Self::Simple { value, .. } => Cow::Borrowed(value),
            Self::Complex { parts, kind, .. } => {
                let joined = parts.join("\\");
                if *kind == NameKind::FullyQualified {
                    Cow::Owned(format!("\\{}", joined))
                } else {
                    Cow::Owned(joined)
                }
            }
        }
    }

    /// Joins all parts with `\` without any leading backslash.
    /// Returns `Cow::Borrowed` for simple names (zero allocation).
    #[inline]
    pub fn join_parts(&self) -> Cow<'src, str> {
        match self {
            Self::Simple { value, .. } => Cow::Borrowed(value),
            Self::Complex { parts, .. } => Cow::Owned(parts.join("\\")),
        }
    }

    /// Returns the parts as a slice.
    /// For `Simple`, returns a single-element slice of the value.
    #[inline]
    pub fn parts_slice(&self) -> &[&'src str] {
        match self {
            Self::Simple { value, .. } => std::slice::from_ref(value),
            Self::Complex { parts, .. } => parts,
        }
    }
}

impl<'arena, 'src> std::fmt::Debug for Name<'arena, 'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        match self {
            Self::Simple { value, span } => f
                .debug_struct("Name")
                .field("parts", &std::slice::from_ref(value))
                .field("kind", &NameKind::Unqualified)
                .field("span", span)
                .finish(),
            Self::Complex { parts, kind, span } => f
                .debug_struct("Name")
                .field("parts", parts)
                .field("kind", kind)
                .field("span", span)
                .finish(),
        }
    }
}

impl<'arena, 'src> serde::Serialize for Name<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        use serde::ser::SerializeStruct;
        let mut st = s.serialize_struct("Name", 3)?;
        match self {
            Self::Simple { value, span } => {
                st.serialize_field("parts", std::slice::from_ref(value))?;
                st.serialize_field("kind", &NameKind::Unqualified)?;
                st.serialize_field("span", span)?;
            }
            Self::Complex { parts, kind, span } => {
                st.serialize_field("parts", parts)?;
                st.serialize_field("kind", kind)?;
                st.serialize_field("span", span)?;
            }
        }
        st.end()
    }
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum NameKind {
    /// A bare identifier with no namespace separator: `Foo`, `strlen`.
    Unqualified,
    /// A name with at least one internal `\` but no leading backslash: `Foo\Bar`.
    Qualified,
    /// A name with a leading `\`: `\Foo\Bar`.
    FullyQualified,
    /// A name starting with the `namespace` keyword: `namespace\Foo`.
    Relative,
}

/// PHP built-in type keyword — zero-cost alternative to `Name::Simple` for the
/// 20 reserved type names. One byte instead of a `Cow<str>` + `Span` in the AST.
#[repr(u8)]
#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum BuiltinType {
    /// `int` — integer scalar type.
    Int,
    /// `integer` — alias for `int`, accepted in type casts.
    Integer,
    /// `float` — floating-point scalar type.
    Float,
    /// `double` — alias for `float`, accepted in type casts.
    Double,
    /// `string` — string scalar type.
    String,
    /// `bool` — boolean scalar type.
    Bool,
    /// `boolean` — alias for `bool`, accepted in type casts.
    Boolean,
    /// `void` — return-only type indicating no value is returned.
    Void,
    /// `never` — return-only type for functions that never return normally (PHP 8.1+).
    Never,
    /// `mixed` — top type; accepts any value.
    Mixed,
    /// `object` — any object instance.
    Object,
    /// `iterable` — `array` or `Traversable` (deprecated in PHP 8.2; use `array|Traversable`).
    Iterable,
    /// `callable` — any callable value.
    Callable,
    /// `array` — any PHP array.
    Array,
    /// `self` — refers to the class in which the type hint appears.
    Self_,
    /// `parent` — refers to the parent class of the class in which the type hint appears.
    Parent_,
    /// `static` — late-static-bound type; the class on which the method was called.
    Static,
    /// `null` — the null type; only valid in union types.
    Null,
    /// `true` — the literal boolean `true` (PHP 8.2+).
    True,
    /// `false` — the literal boolean `false`.
    False,
}

impl BuiltinType {
    /// Returns the canonical lowercase spelling used in PHP and in serialized output.
    #[inline]
    pub fn as_str(self) -> &'static str {
        match self {
            Self::Int => "int",
            Self::Integer => "integer",
            Self::Float => "float",
            Self::Double => "double",
            Self::String => "string",
            Self::Bool => "bool",
            Self::Boolean => "boolean",
            Self::Void => "void",
            Self::Never => "never",
            Self::Mixed => "mixed",
            Self::Object => "object",
            Self::Iterable => "iterable",
            Self::Callable => "callable",
            Self::Array => "array",
            Self::Self_ => "self",
            Self::Parent_ => "parent",
            Self::Static => "static",
            Self::Null => "null",
            Self::True => "true",
            Self::False => "false",
        }
    }
}

#[derive(Debug, Serialize)]
pub struct TypeHint<'arena, 'src> {
    pub kind: TypeHintKind<'arena, 'src>,
    pub span: Span,
}

/// A PHP type hint.
///
/// `Keyword` is the fast path for the 20 built-in type names (`int`, `string`,
/// `bool`, `self`, `array`, etc.). It stores only a 1-byte discriminant and a
/// `Span`, avoiding the `Cow<str>` that `Named(Name::Simple)` would require.
///
/// Serialises identically to `Named` so all existing snapshots remain unchanged.
#[derive(Debug)]
pub enum TypeHintKind<'arena, 'src> {
    /// A user-defined or qualified class name: `Foo`, `\Ns\Bar`.
    Named(Name<'arena, 'src>),
    /// Built-in type keyword (`int`, `string`, `bool`, `self`, …) — serialises as `Named` for snapshot compatibility.
    Keyword(BuiltinType, Span),
    /// Nullable type: `?T` — equivalent to `T|null`.
    Nullable(&'arena TypeHint<'arena, 'src>),
    /// Union type: `A|B|C` (PHP 8.0+).
    Union(ArenaVec<'arena, TypeHint<'arena, 'src>>),
    /// Intersection type: `A&B` (PHP 8.1+).
    Intersection(ArenaVec<'arena, TypeHint<'arena, 'src>>),
}

impl<'arena, 'src> serde::Serialize for TypeHintKind<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        match self {
            // Standard variants — match what #[derive(Serialize)] would produce.
            Self::Named(name) => s.serialize_newtype_variant("TypeHintKind", 0, "Named", name),
            Self::Nullable(inner) => {
                s.serialize_newtype_variant("TypeHintKind", 2, "Nullable", inner)
            }
            Self::Union(types) => s.serialize_newtype_variant("TypeHintKind", 3, "Union", types),
            Self::Intersection(types) => {
                s.serialize_newtype_variant("TypeHintKind", 4, "Intersection", types)
            }
            // Keyword — serialise as if it were Named(Name::Simple { value: kw.as_str(), span }).
            // This preserves all existing snapshot output.
            Self::Keyword(builtin, span) => {
                struct BuiltinNameRepr<'a>(&'a BuiltinType, &'a Span);
                impl serde::Serialize for BuiltinNameRepr<'_> {
                    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
                        use serde::ser::SerializeStruct;
                        let mut st = s.serialize_struct("Name", 3)?;
                        st.serialize_field("parts", &[self.0.as_str()])?;
                        st.serialize_field("kind", &NameKind::Unqualified)?;
                        st.serialize_field("span", self.1)?;
                        st.end()
                    }
                }
                s.serialize_newtype_variant(
                    "TypeHintKind",
                    0,
                    "Named",
                    &BuiltinNameRepr(builtin, span),
                )
            }
        }
    }
}

// =============================================================================
// Arguments
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Arg<'arena, 'src> {
    pub name: Option<Name<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub unpack: bool,
    pub by_ref: bool,
    pub span: Span,
}

// =============================================================================
// Attributes
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Attribute<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Statements
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Stmt<'arena, 'src> {
    pub kind: StmtKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum StmtKind<'arena, 'src> {
    /// Expression statement (e.g. `foo();`)
    Expression(&'arena Expr<'arena, 'src>),

    /// Echo statement: `echo expr1, expr2;`
    Echo(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Return statement: `return expr;`
    Return(Option<&'arena Expr<'arena, 'src>>),

    /// Block statement: `{ stmts }`
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),

    /// If statement
    If(&'arena IfStmt<'arena, 'src>),

    /// While loop
    While(&'arena WhileStmt<'arena, 'src>),

    /// For loop
    For(&'arena ForStmt<'arena, 'src>),

    /// Foreach loop
    Foreach(&'arena ForeachStmt<'arena, 'src>),

    /// Do-while loop
    DoWhile(&'arena DoWhileStmt<'arena, 'src>),

    /// Function declaration
    Function(&'arena FunctionDecl<'arena, 'src>),

    /// Break statement
    Break(Option<&'arena Expr<'arena, 'src>>),

    /// Continue statement
    Continue(Option<&'arena Expr<'arena, 'src>>),

    /// Switch statement
    Switch(&'arena SwitchStmt<'arena, 'src>),

    /// Goto statement
    Goto(&'src str),

    /// Label statement
    Label(&'arena str),

    /// Declare statement
    Declare(&'arena DeclareStmt<'arena, 'src>),

    /// Unset statement
    Unset(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Throw statement (also can be expression in PHP 8)
    Throw(&'arena Expr<'arena, 'src>),

    /// Try/catch/finally
    TryCatch(&'arena TryCatchStmt<'arena, 'src>),

    /// Global declaration
    Global(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Class declaration
    Class(&'arena ClassDecl<'arena, 'src>),

    /// Interface declaration
    Interface(&'arena InterfaceDecl<'arena, 'src>),

    /// Trait declaration
    Trait(&'arena TraitDecl<'arena, 'src>),

    /// Enum declaration
    Enum(&'arena EnumDecl<'arena, 'src>),

    /// Namespace declaration
    Namespace(&'arena NamespaceDecl<'arena, 'src>),

    /// Use declaration
    Use(&'arena UseDecl<'arena, 'src>),

    /// Top-level constant: `const FOO = expr;`
    Const(ArenaVec<'arena, ConstItem<'arena, 'src>>),

    /// Static variable declaration: `static $x = 1;`
    StaticVar(ArenaVec<'arena, StaticVar<'arena, 'src>>),

    /// __halt_compiler(); with remaining data
    HaltCompiler(&'src str),

    /// Nop (empty statement `;`)
    Nop,

    /// Inline HTML
    InlineHtml(&'src str),

    /// Error placeholder — parser always produces a tree
    Error,
}

#[derive(Debug, Serialize)]
pub struct IfStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub then_branch: &'arena Stmt<'arena, 'src>,
    pub elseif_branches: ArenaVec<'arena, ElseIfBranch<'arena, 'src>>,
    pub else_branch: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ElseIfBranch<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: Stmt<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct WhileStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForStmt<'arena, 'src> {
    pub init: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub condition: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub update: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForeachStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub key: Option<Expr<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct DoWhileStmt<'arena, 'src> {
    pub body: &'arena Stmt<'arena, 'src>,
    pub condition: Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct FunctionDecl<'arena, 'src> {
    pub name: &'src str,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub by_ref: bool,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct Param<'arena, 'src> {
    pub name: &'src str,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub by_ref: bool,
    pub variadic: bool,
    pub is_readonly: bool,
    pub is_final: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct SwitchStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub cases: ArenaVec<'arena, SwitchCase<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct SwitchCase<'arena, 'src> {
    pub value: Option<Expr<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct TryCatchStmt<'arena, 'src> {
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub catches: ArenaVec<'arena, CatchClause<'arena, 'src>>,
    pub finally: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
}

#[derive(Debug, Serialize)]
pub struct CatchClause<'arena, 'src> {
    pub types: ArenaVec<'arena, Name<'arena, 'src>>,
    pub var: Option<&'src str>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// OOP Declarations
// =============================================================================

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum Visibility {
    /// `public` — accessible from anywhere.
    Public,
    /// `protected` — accessible within the class and its subclasses.
    Protected,
    /// `private` — accessible only within the declaring class.
    Private,
}

#[derive(Debug, Serialize)]
pub struct ClassDecl<'arena, 'src> {
    pub name: Option<&'src str>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Clone, Serialize, Default)]
pub struct ClassModifiers {
    pub is_abstract: bool,
    pub is_final: bool,
    pub is_readonly: bool,
}

#[derive(Debug, Serialize)]
pub struct ClassMember<'arena, 'src> {
    pub kind: ClassMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum ClassMemberKind<'arena, 'src> {
    Property(PropertyDecl<'arena, 'src>),
    Method(MethodDecl<'arena, 'src>),
    ClassConst(ClassConstDecl<'arena, 'src>),
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct PropertyDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum PropertyHookKind {
    /// `get` hook — called when the property is read.
    Get,
    /// `set` hook — called when the property is written; receives the incoming value as `$value`.
    Set,
}

#[derive(Debug, Serialize)]
pub enum PropertyHookBody<'arena, 'src> {
    /// `{ stmts }` — a full statement block.
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),
    /// `=> expr` — short-form expression body.
    Expression(Expr<'arena, 'src>),
    /// No body — the hook is declared abstract (on an abstract class or interface).
    Abstract,
}

#[derive(Debug, Serialize)]
pub struct PropertyHook<'arena, 'src> {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody<'arena, 'src>,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct MethodDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct ClassConstDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<&'arena TypeHint<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitUseDecl<'arena, 'src> {
    pub traits: ArenaVec<'arena, Name<'arena, 'src>>,
    pub adaptations: ArenaVec<'arena, TraitAdaptation<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitAdaptation<'arena, 'src> {
    pub kind: TraitAdaptationKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum TraitAdaptationKind<'arena, 'src> {
    /// `A::foo insteadof B, C;`
    Precedence {
        trait_name: Name<'arena, 'src>,
        method: Name<'arena, 'src>,
        insteadof: ArenaVec<'arena, Name<'arena, 'src>>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        trait_name: Option<Name<'arena, 'src>>,
        method: Name<'arena, 'src>,
        new_modifier: Option<Visibility>,
        new_name: Option<Name<'arena, 'src>>,
    },
}

#[derive(Debug, Serialize)]
pub struct InterfaceDecl<'arena, 'src> {
    pub name: &'src str,
    pub extends: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitDecl<'arena, 'src> {
    pub name: &'src str,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumDecl<'arena, 'src> {
    pub name: &'src str,
    pub scalar_type: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, EnumMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumMember<'arena, 'src> {
    pub kind: EnumMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum EnumMemberKind<'arena, 'src> {
    /// An enum case: `case Foo;` or `case Foo = 'foo';` (backed enum).
    Case(EnumCase<'arena, 'src>),
    /// A method defined inside the enum body.
    Method(MethodDecl<'arena, 'src>),
    /// A constant defined inside the enum body: `const X = 1;`.
    ClassConst(ClassConstDecl<'arena, 'src>),
    /// A trait use inside the enum body: `use SomeTrait;`.
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct EnumCase<'arena, 'src> {
    pub name: &'src str,
    pub value: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

// =============================================================================
// Namespace & Use
// =============================================================================

#[derive(Debug, Serialize)]
pub struct NamespaceDecl<'arena, 'src> {
    pub name: Option<Name<'arena, 'src>>,
    pub body: NamespaceBody<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub enum NamespaceBody<'arena, 'src> {
    /// `namespace Foo { … }` — braced form; the statements are scoped to this namespace.
    Braced(ArenaVec<'arena, Stmt<'arena, 'src>>),
    /// `namespace Foo;` — simple form; all subsequent statements until the next `namespace` or EOF are in scope.
    Simple,
}

#[derive(Debug, Serialize)]
pub struct DeclareStmt<'arena, 'src> {
    pub directives: ArenaVec<'arena, (&'src str, Expr<'arena, 'src>)>,
    pub body: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct UseDecl<'arena, 'src> {
    pub kind: UseKind,
    pub uses: ArenaVec<'arena, UseItem<'arena, 'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    /// `use Foo\Bar` — imports a class, interface, trait, or enum.
    Normal,
    /// `use function Foo\bar` — imports a function.
    Function,
    /// `use const Foo\BAR` — imports a constant.
    Const,
}

#[derive(Debug, Serialize)]
pub struct UseItem<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub alias: Option<&'src str>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ConstItem<'arena, 'src> {
    pub name: &'src str,
    pub value: Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct StaticVar<'arena, 'src> {
    pub name: &'src str,
    pub default: Option<Expr<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Expressions
// =============================================================================

/// A name string that originates either from the source buffer (`&'src str`) or was
/// constructed in the arena (`&'arena str`).
///
/// Using this as the payload for both `ExprKind::Variable` and `ExprKind::Identifier`
/// gives them the same binding type, so or-patterns compile natively:
///
/// ```
/// # use php_ast::ast::{ExprKind, NameStr};
/// # fn example<'a, 'b>(kind: &ExprKind<'a, 'b>) {
/// if let ExprKind::Variable(name) | ExprKind::Identifier(name) = kind {
///     let _s: &str = name.as_str();
/// }
/// # }
/// ```
#[derive(Clone, Copy, PartialEq, Eq, Hash)]
pub enum NameStr<'arena, 'src> {
    /// Borrowed directly from the source buffer.
    Src(&'src str),
    /// Allocated in the bump arena (e.g. a joined qualified name).
    Arena(&'arena str),
}

impl<'arena, 'src> NameStr<'arena, 'src> {
    #[inline]
    pub fn as_str(&self) -> &str {
        match self {
            NameStr::Src(s) => s,
            NameStr::Arena(s) => s,
        }
    }
}

impl<'arena, 'src> std::ops::Deref for NameStr<'arena, 'src> {
    type Target = str;
    #[inline]
    fn deref(&self) -> &str {
        self.as_str()
    }
}

impl<'arena, 'src> std::fmt::Debug for NameStr<'arena, 'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        self.as_str().fmt(f)
    }
}

impl<'arena, 'src> serde::Serialize for NameStr<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, serializer: S) -> Result<S::Ok, S::Error> {
        self.as_str().serialize(serializer)
    }
}

#[derive(Debug, Serialize)]
pub struct Expr<'arena, 'src> {
    pub kind: ExprKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum ExprKind<'arena, 'src> {
    /// Integer literal
    Int(i64),

    /// Float literal
    Float(f64),

    /// String literal
    String(&'arena str),

    /// Interpolated string: `"Hello $name, you are {$age} years old"`
    InterpolatedString(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Heredoc: `<<<EOT ... EOT`
    Heredoc {
        label: &'src str,
        parts: ArenaVec<'arena, StringPart<'arena, 'src>>,
    },

    /// Nowdoc: `<<<'EOT' ... EOT`
    Nowdoc {
        label: &'src str,
        value: &'arena str,
    },

    /// Shell execution: `` `command $var` ``
    ShellExec(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Boolean literal
    Bool(bool),

    /// Null literal
    Null,

    /// Variable: `$name`
    Variable(NameStr<'arena, 'src>),

    /// Variable variable: `$$var`, `$$$var`, `${expr}`
    VariableVariable(&'arena Expr<'arena, 'src>),

    /// Identifier (bare name, e.g. function name in a call)
    Identifier(NameStr<'arena, 'src>),

    /// Assignment: `$x = expr` or `$x += expr`
    Assign(AssignExpr<'arena, 'src>),

    /// Binary operation: `expr op expr`
    Binary(BinaryExpr<'arena, 'src>),

    /// Unary prefix: `-expr`, `!expr`, `~expr`, `++$x`, `--$x`
    UnaryPrefix(UnaryPrefixExpr<'arena, 'src>),

    /// Unary postfix: `$x++`, `$x--`
    UnaryPostfix(UnaryPostfixExpr<'arena, 'src>),

    /// Ternary: `cond ? then : else` or short `cond ?: else`
    Ternary(TernaryExpr<'arena, 'src>),

    /// Null coalescing: `expr ?? fallback`
    NullCoalesce(NullCoalesceExpr<'arena, 'src>),

    /// Function call: `name(args)`
    FunctionCall(FunctionCallExpr<'arena, 'src>),

    /// Array literal: `[1, 2, 3]` or `['a' => 1]`
    Array(ArenaVec<'arena, ArrayElement<'arena, 'src>>),

    /// Array access: `$arr[index]`
    ArrayAccess(ArrayAccessExpr<'arena, 'src>),

    /// Print expression: `print expr`
    Print(&'arena Expr<'arena, 'src>),

    /// Parenthesized expression: `(expr)`
    Parenthesized(&'arena Expr<'arena, 'src>),

    /// Cast expression: `(int)$x`, `(string)$x`, etc.
    Cast(CastKind, &'arena Expr<'arena, 'src>),

    /// Error suppression: `@expr`
    ErrorSuppress(&'arena Expr<'arena, 'src>),

    /// Isset: `isset($a, $b)`
    Isset(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Empty: `empty($a)`
    Empty(&'arena Expr<'arena, 'src>),

    /// Include/require: `include 'file.php'`
    Include(IncludeKind, &'arena Expr<'arena, 'src>),

    /// Eval: `eval('code')`
    Eval(&'arena Expr<'arena, 'src>),

    /// Exit/die: `exit`, `exit(1)`, `die('msg')`
    Exit(Option<&'arena Expr<'arena, 'src>>),

    /// Magic constant: `__LINE__`, `__FILE__`, etc.
    MagicConst(MagicConstKind),

    /// Clone: `clone $obj`
    Clone(&'arena Expr<'arena, 'src>),

    /// Clone with property overrides: `clone($obj, ['prop' => $val])` — PHP 8.5+
    CloneWith(&'arena Expr<'arena, 'src>, &'arena Expr<'arena, 'src>),

    /// New: `new Class(args)`
    New(NewExpr<'arena, 'src>),

    /// Property access: `$obj->prop`
    PropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Nullsafe property access: `$obj?->prop`
    NullsafePropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Method call: `$obj->method(args)`
    MethodCall(&'arena MethodCallExpr<'arena, 'src>),

    /// Nullsafe method call: `$obj?->method(args)`
    NullsafeMethodCall(&'arena MethodCallExpr<'arena, 'src>),

    /// Static property access: `Class::$prop`
    StaticPropertyAccess(StaticAccessExpr<'arena, 'src>),

    /// Static method call: `Class::method(args)`
    StaticMethodCall(&'arena StaticMethodCallExpr<'arena, 'src>),

    /// Dynamic static method call: `Class::$method(args)`
    StaticDynMethodCall(&'arena StaticDynMethodCallExpr<'arena, 'src>),

    /// Class constant access: `Class::CONST`
    ClassConstAccess(StaticAccessExpr<'arena, 'src>),

    /// Dynamic class constant access: `Foo::{expr}`
    ClassConstAccessDynamic {
        class: &'arena Expr<'arena, 'src>,
        member: &'arena Expr<'arena, 'src>,
    },

    /// Dynamic static property access: `A::$$b`, `A::${'b'}`
    StaticPropertyAccessDynamic {
        class: &'arena Expr<'arena, 'src>,
        member: &'arena Expr<'arena, 'src>,
    },

    /// Closure: `function($x) use($y) { }`
    Closure(&'arena ClosureExpr<'arena, 'src>),

    /// Arrow function: `fn($x) => expr`
    ArrowFunction(&'arena ArrowFunctionExpr<'arena, 'src>),

    /// Match: `match(expr) { ... }`
    Match(MatchExpr<'arena, 'src>),

    /// Throw as expression (PHP 8)
    ThrowExpr(&'arena Expr<'arena, 'src>),

    /// Yield: `yield` / `yield $val` / `yield $key => $val`
    Yield(YieldExpr<'arena, 'src>),

    /// Anonymous class: `new class(args) extends Foo implements Bar { ... }`
    AnonymousClass(&'arena ClassDecl<'arena, 'src>),

    /// First-class callable: `strlen(...)`, `$obj->method(...)`, `Foo::bar(...)`
    CallableCreate(CallableCreateExpr<'arena, 'src>),

    /// Omitted element in destructuring: `[$a, , $c]` or `list($a, , $c)`
    Omit,

    /// Error placeholder
    Error,
}

impl<'arena, 'src> Expr<'arena, 'src> {
    /// Returns the name string for `Variable` and `Identifier` nodes, `None` for everything else.
    pub fn name_str(&self) -> Option<&str> {
        match &self.kind {
            ExprKind::Variable(s) | ExprKind::Identifier(s) => Some(s.as_str()),
            _ => None,
        }
    }
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum CastKind {
    /// `(int)` or `(integer)` cast.
    Int,
    /// `(float)`, `(double)`, or `(real)` cast.
    Float,
    /// `(string)` cast.
    String,
    /// `(bool)` or `(boolean)` cast.
    Bool,
    /// `(array)` cast.
    Array,
    /// `(object)` cast.
    Object,
    /// `(unset)` cast — deprecated; casts to `null`.
    Unset,
    /// `(void)` cast — non-standard; treated as discarding the value.
    Void,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum IncludeKind {
    /// `include 'file.php'` — emits a warning if the file is not found.
    Include,
    /// `include_once 'file.php'` — like `include`, but skipped if the file has already been included.
    IncludeOnce,
    /// `require 'file.php'` — fatal error if the file is not found.
    Require,
    /// `require_once 'file.php'` — like `require`, but skipped if the file has already been included.
    RequireOnce,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum MagicConstKind {
    /// `__CLASS__` — name of the current class, or empty string outside a class.
    Class,
    /// `__DIR__` — directory of the current file.
    Dir,
    /// `__FILE__` — absolute path of the current file.
    File,
    /// `__FUNCTION__` — name of the current function or closure.
    Function,
    /// `__LINE__` — current line number in the source file.
    Line,
    /// `__METHOD__` — name of the current method including its class: `ClassName::methodName`.
    Method,
    /// `__NAMESPACE__` — name of the current namespace, or empty string in the global namespace.
    Namespace,
    /// `__TRAIT__` — name of the current trait, or empty string outside a trait.
    Trait,
    /// `__PROPERTY__` — name of the current property inside a property hook (PHP 8.4+).
    Property,
}

// --- Expression sub-types ---

#[derive(Debug, Serialize)]
pub struct AssignExpr<'arena, 'src> {
    pub target: &'arena Expr<'arena, 'src>,
    pub op: AssignOp,
    pub value: &'arena Expr<'arena, 'src>,
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum AssignOp {
    /// `=`
    Assign,
    /// `+=`
    Plus,
    /// `-=`
    Minus,
    /// `*=`
    Mul,
    /// `/=`
    Div,
    /// `%=`
    Mod,
    /// `**=`
    Pow,
    /// `.=`
    Concat,
    /// `&=`
    BitwiseAnd,
    /// `|=`
    BitwiseOr,
    /// `^=`
    BitwiseXor,
    /// `<<=`
    ShiftLeft,
    /// `>>=`
    ShiftRight,
    /// `??=`
    Coalesce,
}

#[derive(Debug, Serialize)]
pub struct BinaryExpr<'arena, 'src> {
    pub left: &'arena Expr<'arena, 'src>,
    pub op: BinaryOp,
    pub right: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum BinaryOp {
    /// `+`
    Add,
    /// `-`
    Sub,
    /// `*`
    Mul,
    /// `/`
    Div,
    /// `%`
    Mod,
    /// `**`
    Pow,
    /// `.` — string concatenation.
    Concat,
    /// `==` — loose equality (type-coercing).
    Equal,
    /// `!=` or `<>` — loose inequality.
    NotEqual,
    /// `===` — strict equality (type and value).
    Identical,
    /// `!==` — strict inequality.
    NotIdentical,
    /// `<`
    Less,
    /// `>`
    Greater,
    /// `<=`
    LessOrEqual,
    /// `>=`
    GreaterOrEqual,
    /// `<=>` — spaceship / three-way comparison; returns -1, 0, or 1.
    Spaceship,
    /// `&&` — short-circuit boolean AND (higher precedence than `and`).
    BooleanAnd,
    /// `||` — short-circuit boolean OR (higher precedence than `or`).
    BooleanOr,
    /// `&` — bitwise AND.
    BitwiseAnd,
    /// `|` — bitwise OR.
    BitwiseOr,
    /// `^` — bitwise XOR.
    BitwiseXor,
    /// `<<` — left bit-shift.
    ShiftLeft,
    /// `>>` — right bit-shift.
    ShiftRight,
    /// `and` — boolean AND (lower precedence than `&&`).
    LogicalAnd,
    /// `or` — boolean OR (lower precedence than `||`).
    LogicalOr,
    /// `xor` — boolean XOR.
    LogicalXor,
    /// `instanceof` — type-check operator; `$x instanceof Foo`.
    Instanceof,
    /// `|>` — pipe operator (PHP 8.5+); passes the left operand as the first argument of the right callable.
    Pipe,
}

#[derive(Debug, Serialize)]
pub struct UnaryPrefixExpr<'arena, 'src> {
    pub op: UnaryPrefixOp,
    pub operand: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPrefixOp {
    /// `-expr` — arithmetic negation.
    Negate,
    /// `+expr` — unary plus (no-op for numbers, promotes to numeric).
    Plus,
    /// `!expr` — boolean NOT.
    BooleanNot,
    /// `~expr` — bitwise NOT.
    BitwiseNot,
    /// `++$x` — pre-increment; increments then returns the new value.
    PreIncrement,
    /// `--$x` — pre-decrement; decrements then returns the new value.
    PreDecrement,
}

#[derive(Debug, Serialize)]
pub struct UnaryPostfixExpr<'arena, 'src> {
    pub operand: &'arena Expr<'arena, 'src>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPostfixOp {
    /// `$x++` — post-increment; returns the current value then increments.
    PostIncrement,
    /// `$x--` — post-decrement; returns the current value then decrements.
    PostDecrement,
}

#[derive(Debug, Serialize)]
pub struct TernaryExpr<'arena, 'src> {
    pub condition: &'arena Expr<'arena, 'src>,
    /// None for short ternary `$x ?: $y`
    pub then_expr: Option<&'arena Expr<'arena, 'src>>,
    pub else_expr: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct NullCoalesceExpr<'arena, 'src> {
    pub left: &'arena Expr<'arena, 'src>,
    pub right: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct FunctionCallExpr<'arena, 'src> {
    pub name: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ArrayElement<'arena, 'src> {
    pub key: Option<Expr<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub unpack: bool,
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ArrayAccessExpr<'arena, 'src> {
    pub array: &'arena Expr<'arena, 'src>,
    pub index: Option<&'arena Expr<'arena, 'src>>,
}

// --- OOP Expression sub-types ---

#[derive(Debug, Serialize)]
pub struct NewExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct PropertyAccessExpr<'arena, 'src> {
    pub object: &'arena Expr<'arena, 'src>,
    pub property: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct MethodCallExpr<'arena, 'src> {
    pub object: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct StaticAccessExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub member: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct StaticMethodCallExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct StaticDynMethodCallExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ClosureExpr<'arena, 'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub use_vars: ArenaVec<'arena, ClosureUseVar<'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureUseVar<'src> {
    pub name: &'src str,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ArrowFunctionExpr<'arena, 'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: &'arena Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct MatchExpr<'arena, 'src> {
    pub subject: &'arena Expr<'arena, 'src>,
    pub arms: ArenaVec<'arena, MatchArm<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct MatchArm<'arena, 'src> {
    /// None for `default`
    pub conditions: Option<ArenaVec<'arena, Expr<'arena, 'src>>>,
    pub body: Expr<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct YieldExpr<'arena, 'src> {
    pub key: Option<&'arena Expr<'arena, 'src>>,
    pub value: Option<&'arena Expr<'arena, 'src>>,
    /// `true` for `yield from expr` (generator delegation), `false` for plain `yield`
    pub is_from: bool,
}

// --- First-class callable ---

#[derive(Debug, Serialize)]
pub struct CallableCreateExpr<'arena, 'src> {
    pub kind: CallableCreateKind<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub enum CallableCreateKind<'arena, 'src> {
    /// `foo(...)`, `$var(...)`, `\Ns\func(...)`
    Function(&'arena Expr<'arena, 'src>),
    /// `$obj->method(...)`
    Method {
        object: &'arena Expr<'arena, 'src>,
        method: &'arena Expr<'arena, 'src>,
    },
    /// `$obj?->method(...)`
    NullsafeMethod {
        object: &'arena Expr<'arena, 'src>,
        method: &'arena Expr<'arena, 'src>,
    },
    /// `Foo::bar(...)`
    StaticMethod {
        class: &'arena Expr<'arena, 'src>,
        method: &'arena Expr<'arena, 'src>,
    },
}

// --- String interpolation ---

#[derive(Debug, Serialize)]
pub enum StringPart<'arena, 'src> {
    /// A plain text segment of an interpolated string or heredoc.
    Literal(&'arena str),
    /// An embedded expression: `$var`, `{$expr}`, or `${var}`.
    Expr(Expr<'arena, 'src>),
}
