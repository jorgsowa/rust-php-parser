use std::borrow::Cow;

use serde::Serialize;

use crate::Span;

use super::ArenaVec;

/// A bare identifier — the kind that names a function, class, parameter,
/// enum case, etc. Distinct from [`Name`], which represents possibly-qualified
/// names.
///
/// Memory layout is identical to `&'src str` (16 bytes); `Option<Ident>` is
/// also 16 bytes via the standard pointer niche. The "error" state — produced
/// during error recovery when no identifier was found in the source — is
/// represented by an empty string slice, which cannot occur for a real PHP
/// identifier (the lexer rejects empty matches).
///
/// Use [`Ident::name`] / [`Ident::ERROR`] to construct, [`Ident::as_str`] to
/// extract a real name, [`Ident::is_error`] to test for the error state.
/// Serialises as a JSON string for real names and `null` for the error state.
#[repr(transparent)]
#[derive(Clone, Copy)]
pub struct Ident<'src>(&'src str);

impl<'src> Ident<'src> {
    /// Sentinel for "no identifier was parsed" — same memory layout as a real
    /// `Ident`, distinguished by the empty-string interior.
    pub const ERROR: Self = Self("");

    /// Construct an identifier from a non-empty source slice.
    /// Empty input is rejected in debug builds — use [`Ident::ERROR`] instead.
    #[inline]
    pub fn name(s: &'src str) -> Self {
        debug_assert!(!s.is_empty(), "Ident::name() called with empty string");
        Self(s)
    }

    /// Returns `Some(s)` for a real identifier, `None` for the error state.
    #[inline]
    pub fn as_str(&self) -> Option<&'src str> {
        if self.0.is_empty() {
            None
        } else {
            Some(self.0)
        }
    }

    /// Returns `true` if this identifier was synthesised during error recovery.
    #[inline]
    pub fn is_error(&self) -> bool {
        self.0.is_empty()
    }

    /// Returns the inner string, or `"<error>"` for the error state.
    /// Useful when constructing diagnostic messages.
    #[inline]
    pub fn or_error(&self) -> &'src str {
        if self.0.is_empty() {
            "<error>"
        } else {
            self.0
        }
    }
}

impl<'src> std::fmt::Debug for Ident<'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        if self.0.is_empty() {
            f.write_str("Ident::ERROR")
        } else {
            f.debug_tuple("Ident").field(&self.0).finish()
        }
    }
}

impl<'src> std::fmt::Display for Ident<'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        f.write_str(self.or_error())
    }
}

impl<'src> serde::Serialize for Ident<'src> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        if self.0.is_empty() {
            s.serialize_none()
        } else {
            s.serialize_str(self.0)
        }
    }
}

impl<'src> PartialEq<&str> for Ident<'src> {
    fn eq(&self, other: &&str) -> bool {
        !self.0.is_empty() && self.0 == *other
    }
}

#[cfg(test)]
mod ident_layout_tests {
    use super::Ident;

    /// `Ident` is `#[repr(transparent)]` over `&str`; this test guards the
    /// invariant so the size never accidentally regresses.
    #[test]
    fn ident_has_same_size_as_str_slice() {
        assert_eq!(std::mem::size_of::<Ident>(), std::mem::size_of::<&str>());
        assert_eq!(
            std::mem::size_of::<Option<Ident>>(),
            std::mem::size_of::<Option<&str>>()
        );
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
    /// Synthesised during error recovery when no real name could be parsed.
    /// Distinguishable from any user-written name; visitors and tools can
    /// explicitly skip or flag these.
    Error { span: Span },
}

impl<'arena, 'src> Name<'arena, 'src> {
    #[inline]
    pub fn span(&self) -> Span {
        match self {
            Self::Simple { span, .. } | Self::Complex { span, .. } | Self::Error { span } => *span,
        }
    }

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
    /// Synthesised during error recovery — no real name was present in the source.
    Error,
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
