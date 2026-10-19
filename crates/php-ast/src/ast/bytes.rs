use std::borrow::Cow;

#[derive(Clone, Copy)]
enum ByteStrInner<'arena, 'src> {
    Src(&'src str),
    ArenaStr(&'arena str),
    ArenaBytes(&'arena [u8]),
}

/// The value of a PHP string literal: arbitrary bytes, which need not be valid UTF-8
/// (`"\xff"`, `"\u{D800}"`).
///
/// A literal without escapes borrows the source buffer; any other value lives in the bump arena.
/// [`to_str`](ByteStr::to_str) is `Some` when the bytes are valid UTF-8. With the `serde`
/// feature, valid UTF-8 serializes as a JSON string and any other value as `{"bytes": [..]}`.
#[derive(Clone, Copy)]
pub struct ByteStr<'arena, 'src>(ByteStrInner<'arena, 'src>);

impl<'arena, 'src> ByteStr<'arena, 'src> {
    /// Borrows `s` from the source buffer.
    #[inline]
    pub fn from_source(s: &'src str) -> Self {
        Self(ByteStrInner::Src(s))
    }

    /// Wraps a string already allocated in the bump arena.
    #[inline]
    pub fn from_arena_str(s: &'arena str) -> Self {
        Self(ByteStrInner::ArenaStr(s))
    }

    /// Copies `bytes` into `arena`.
    pub fn new_in(arena: &'arena bumpalo::Bump, bytes: &[u8]) -> Self {
        match std::str::from_utf8(bytes) {
            Ok(s) => Self(ByteStrInner::ArenaStr(arena.alloc_str(s))),
            Err(_) => Self(ByteStrInner::ArenaBytes(arena.alloc_slice_copy(bytes))),
        }
    }

    /// The bytes of the string.
    #[inline]
    pub fn as_bytes(&self) -> &[u8] {
        match self.0 {
            ByteStrInner::Src(s) | ByteStrInner::ArenaStr(s) => s.as_bytes(),
            ByteStrInner::ArenaBytes(b) => b,
        }
    }

    /// The value as `&str`, or `None` when it is not valid UTF-8.
    #[inline]
    pub fn to_str(&self) -> Option<&str> {
        match self.0 {
            ByteStrInner::Src(s) | ByteStrInner::ArenaStr(s) => Some(s),
            ByteStrInner::ArenaBytes(_) => None,
        }
    }

    /// The value as text, replacing invalid UTF-8 with `U+FFFD`.
    pub fn to_string_lossy(&self) -> Cow<'_, str> {
        match self.0 {
            ByteStrInner::Src(s) | ByteStrInner::ArenaStr(s) => Cow::Borrowed(s),
            ByteStrInner::ArenaBytes(b) => String::from_utf8_lossy(b),
        }
    }

    /// The source slice, when the value borrows the source buffer.
    #[inline]
    pub(crate) fn into_src_str(self) -> Option<&'src str> {
        match self.0 {
            ByteStrInner::Src(s) => Some(s),
            _ => None,
        }
    }
}

impl<'arena, 'src> std::ops::Deref for ByteStr<'arena, 'src> {
    type Target = [u8];
    #[inline]
    fn deref(&self) -> &[u8] {
        self.as_bytes()
    }
}

impl<'arena, 'src, 'a, 'b> PartialEq<ByteStr<'a, 'b>> for ByteStr<'arena, 'src> {
    fn eq(&self, other: &ByteStr<'a, 'b>) -> bool {
        self.as_bytes() == other.as_bytes()
    }
}

impl<'arena, 'src> Eq for ByteStr<'arena, 'src> {}

impl<'arena, 'src> PartialEq<str> for ByteStr<'arena, 'src> {
    fn eq(&self, other: &str) -> bool {
        self.as_bytes() == other.as_bytes()
    }
}

impl<'arena, 'src> PartialEq<&str> for ByteStr<'arena, 'src> {
    fn eq(&self, other: &&str) -> bool {
        self.as_bytes() == other.as_bytes()
    }
}

impl<'arena, 'src> PartialEq<[u8]> for ByteStr<'arena, 'src> {
    fn eq(&self, other: &[u8]) -> bool {
        self.as_bytes() == other
    }
}

impl<'arena, 'src> std::hash::Hash for ByteStr<'arena, 'src> {
    fn hash<H: std::hash::Hasher>(&self, state: &mut H) {
        self.as_bytes().hash(state)
    }
}

impl<'arena, 'src> std::fmt::Debug for ByteStr<'arena, 'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        match self.to_str() {
            Some(s) => std::fmt::Debug::fmt(s, f),
            None => write!(f, "b{:?}", self.as_bytes().escape_ascii().to_string()),
        }
    }
}

#[cfg(feature = "serde")]
impl<'arena, 'src> serde::Serialize for ByteStr<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, serializer: S) -> Result<S::Ok, S::Error> {
        serialize_bytes(self.as_bytes(), serializer)
    }
}

/// Valid UTF-8 as a string, anything else as `{"bytes": [..]}`.
#[cfg(feature = "serde")]
pub(crate) fn serialize_bytes<S: serde::Serializer>(
    bytes: &[u8],
    serializer: S,
) -> Result<S::Ok, S::Error> {
    use serde::ser::SerializeMap;
    match std::str::from_utf8(bytes) {
        Ok(s) => serializer.serialize_str(s),
        Err(_) => {
            let mut map = serializer.serialize_map(Some(1))?;
            map.serialize_entry("bytes", bytes)?;
            map.end()
        }
    }
}
