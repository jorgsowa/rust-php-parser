use std::borrow::Cow;

#[cfg(feature = "serde")]
use serde::Serialize;

use crate::Span;

use super::ArenaVec;

/// A bare identifier — the kind that names a function, class, parameter,
/// enum case, etc. Distinct from [`Name`], which represents possibly-qualified
/// names.
///
/// The "error" state — produced during error recovery when no identifier was
/// found in the source — is represented by an empty name, which cannot occur
/// for a real PHP identifier (the lexer rejects empty matches).
///
/// Use [`Ident::new`] / [`Ident::error`] to construct, [`Ident::as_str`] to
/// extract a real name, [`Ident::is_error`] to test for the error state.
/// Serialises as `{"name": .., "span": ..}` for real names and `null` for the
/// error state.
#[derive(Clone, Copy)]
pub struct Ident<'src> {
    name: &'src str,
    /// Source range of the identifier token; includes the `$` of a variable name.
    pub span: Span,
}

impl<'src> Ident<'src> {
    /// Construct an identifier from a non-empty name.
    /// Empty input is rejected in debug builds — use [`Ident::error`] instead.
    #[inline]
    pub fn new(name: &'src str, span: Span) -> Self {
        debug_assert!(!name.is_empty(), "Ident::new() called with empty name");
        Self { name, span }
    }

    /// Placeholder for "no identifier was parsed" at `span`.
    #[inline]
    pub const fn error(span: Span) -> Self {
        Self { name: "", span }
    }

    /// Returns `Some(s)` for a real identifier, `None` for the error state.
    #[inline]
    pub fn as_str(&self) -> Option<&'src str> {
        if self.name.is_empty() {
            None
        } else {
            Some(self.name)
        }
    }

    /// Returns `true` if this identifier was synthesised during error recovery.
    #[inline]
    pub fn is_error(&self) -> bool {
        self.name.is_empty()
    }

    /// Returns the inner string, or `"<error>"` for the error state.
    /// Useful when constructing diagnostic messages.
    #[inline]
    pub fn or_error(&self) -> &'src str {
        if self.name.is_empty() {
            "<error>"
        } else {
            self.name
        }
    }
}

impl<'src> std::fmt::Debug for Ident<'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        if self.name.is_empty() {
            write!(f, "Ident::error({:?})", self.span)
        } else {
            write!(f, "Ident({:?}, {:?})", self.name, self.span)
        }
    }
}

impl<'src> std::fmt::Display for Ident<'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        f.write_str(self.or_error())
    }
}

#[cfg(feature = "serde")]
impl<'src> serde::Serialize for Ident<'src> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        use serde::ser::SerializeStruct;
        if self.name.is_empty() {
            return s.serialize_none();
        }
        let mut st = s.serialize_struct("Ident", 2)?;
        st.serialize_field("name", self.name)?;
        st.serialize_field("span", &self.span)?;
        st.end()
    }
}

impl<'src> PartialEq<&str> for Ident<'src> {
    fn eq(&self, other: &&str) -> bool {
        !self.name.is_empty() && self.name == *other
    }
}

/// A PHP name (identifier, qualified name, fully-qualified name, or relative name).
///
/// The `Simple` variant is the fast path for the common case (~95%) of single
/// unqualified identifiers like `strlen`, `Foo`, `MyClass`. It avoids allocating
/// an `ArenaVec` entirely.
///
/// The `Complex` variant handles qualified (`Foo\Bar`), fully-qualified (`\Foo\Bar`),
/// and relative (`namespace\Foo`) names.
///
/// The `Error` variant is synthesised during error recovery when the parser
/// expected a name but found none. It carries only a span so consumers can
/// distinguish it from any user-written name.
#[non_exhaustive]
pub enum Name<'arena, 'src> {
    /// Single unqualified identifier — no `ArenaVec` allocation.
    /// `&'src str` instead of `Cow` since this is always a borrowed slice of the source.
    Simple {
        /// The identifier text.
        value: &'src str,
        /// Source range of the name.
        span: Span,
    },
    /// Multi-part or prefixed name (`Foo\Bar`, `\Foo`, `namespace\Foo`).
    Complex {
        /// Name segments split on `\`.
        parts: ArenaVec<'arena, &'src str>,
        /// Qualification form.
        kind: NameKind,
        /// Source range of the name.
        span: Span,
    },
    /// Synthesised during error recovery when no real name could be parsed.
    /// Distinguishable from any user-written name; visitors and tools can
    /// explicitly skip or flag these.
    Error {
        /// Source range where a name was expected.
        span: Span,
    },
}

impl<'arena, 'src> Name<'arena, 'src> {
    /// Source range of the name.
    #[inline]
    pub fn span(&self) -> Span {
        match self {
            Self::Simple { span, .. } | Self::Complex { span, .. } | Self::Error { span } => *span,
        }
    }

    /// Qualification form of the name.
    #[inline]
    pub fn kind(&self) -> NameKind {
        match self {
            Self::Simple { .. } => NameKind::Unqualified,
            Self::Complex { kind, .. } => *kind,
            Self::Error { .. } => NameKind::Error,
        }
    }

    /// Returns the name as a borrowed slice of the source string.
    ///
    /// Unlike `to_string_repr`, this never allocates: it uses the stored
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
            Self::Error { .. } => "",
        }
    }

    /// Joins all parts with `\` and prepends `\` if fully qualified.
    /// Returns `Cow::Borrowed` for simple names (zero allocation).
    /// Returns an empty `Cow::Borrowed("")` for `Name::Error`.
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
            Self::Error { .. } => Cow::Borrowed(""),
        }
    }

    /// Joins all parts with `\` without any leading backslash.
    /// Returns `Cow::Borrowed` for simple names (zero allocation).
    /// Returns an empty `Cow::Borrowed("")` for `Name::Error`.
    #[inline]
    pub fn join_parts(&self) -> Cow<'src, str> {
        match self {
            Self::Simple { value, .. } => Cow::Borrowed(value),
            Self::Complex { parts, .. } => Cow::Owned(parts.join("\\")),
            Self::Error { .. } => Cow::Borrowed(""),
        }
    }

    /// Returns the parts as a slice.
    /// For `Simple`, returns a single-element slice of the value.
    #[inline]
    pub fn parts_slice(&self) -> &[&'src str] {
        match self {
            Self::Simple { value, .. } => std::slice::from_ref(value),
            Self::Complex { parts, .. } => parts,
            Self::Error { .. } => &[],
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
            Self::Error { span } => {
                let empty: [&str; 0] = [];
                f.debug_struct("Name")
                    .field("parts", &empty)
                    .field("kind", &NameKind::Error)
                    .field("span", span)
                    .finish()
            }
        }
    }
}

#[cfg(feature = "serde")]
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
            Self::Error { span } => {
                let empty: [&str; 0] = [];
                st.serialize_field("parts", &empty[..])?;
                st.serialize_field("kind", &NameKind::Error)?;
                st.serialize_field("span", span)?;
            }
        }
        st.end()
    }
}

/// How a name is qualified.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum NameKind {
    /// A bare identifier with no namespace separator: `Foo`, `strlen`.
    Unqualified,
    /// A name with at least one internal `\` but no leading backslash: `Foo\Bar`.
    Qualified,
    /// A name with a leading `\`: `\Foo\Bar`.
    FullyQualified,
    /// A name starting with the `namespace` keyword: `namespace\Foo`.
    Relative,
    /// Synthesised during error recovery — no real name was present in the source.
    Error,
}

/// PHP built-in type keyword — compact alternative to `Name::Simple` for the
/// 17 reserved type names.
#[repr(u8)]
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum BuiltinType {
    /// `int` — integer scalar type.
    Int,
    /// `float` — floating-point scalar type.
    Float,
    /// `string` — string scalar type.
    String,
    /// `bool` — boolean scalar type.
    Bool,
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
            Self::Float => "float",
            Self::String => "string",
            Self::Bool => "bool",
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

/// A type declaration with its source range.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TypeHint<'arena, 'src> {
    /// Type form.
    pub kind: TypeHintKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// A PHP type hint.
///
/// `Keyword` is the fast path for the 17 built-in type names (`int`, `string`,
/// `bool`, `self`, `array`, etc.). It stores only a 1-byte discriminant and a
/// `Span` instead of a `Name`.
///
/// Serialises identically to `Named` so all existing snapshots remain unchanged.
#[derive(Debug)]
#[non_exhaustive]
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

#[cfg(feature = "serde")]
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
