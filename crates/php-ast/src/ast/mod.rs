mod bytes;
mod decls;
mod exprs;
mod misc;
mod names;
mod stmts;

#[cfg(feature = "serde")]
pub(crate) use bytes::serialize_bytes;
pub use bytes::ByteStr;
pub use decls::*;
pub use exprs::*;
pub use misc::*;
pub use names::*;
pub use stmts::*;

#[cfg(feature = "serde")]
pub(crate) fn is_false(b: &bool) -> bool {
    !*b
}

/// Arena-allocated Vec. Thin newtype over bumpalo::collections::Vec that implements Debug and, with the `serde` feature, Serialize.
pub struct ArenaVec<'arena, T>(bumpalo::collections::Vec<'arena, T>);

impl<'arena, T> ArenaVec<'arena, T> {
    /// Creates an empty vector in `arena`.
    #[inline]
    pub fn new_in(arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::new_in(arena))
    }
    /// Creates an empty vector with room for `cap` elements in `arena`.
    #[inline]
    pub fn with_capacity_in(cap: usize, arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::with_capacity_in(cap, arena))
    }
    /// Appends `val` to the end.
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

/// The owning iterator returned by [`ArenaVec::into_iter`].
pub struct IntoIter<'arena, T>(bumpalo::collections::vec::IntoIter<'arena, T>);

impl<'arena, T> Iterator for IntoIter<'arena, T> {
    type Item = T;
    #[inline]
    fn next(&mut self) -> Option<T> {
        self.0.next()
    }
    #[inline]
    fn size_hint(&self) -> (usize, Option<usize>) {
        self.0.size_hint()
    }
}

impl<'arena, T> DoubleEndedIterator for IntoIter<'arena, T> {
    #[inline]
    fn next_back(&mut self) -> Option<T> {
        self.0.next_back()
    }
}

impl<'arena, T> ExactSizeIterator for IntoIter<'arena, T> {}

impl<'arena, T> std::iter::FusedIterator for IntoIter<'arena, T> {}

impl<'arena, T> IntoIterator for ArenaVec<'arena, T> {
    type Item = T;
    type IntoIter = IntoIter<'arena, T>;
    #[inline]
    fn into_iter(self) -> IntoIter<'arena, T> {
        IntoIter(self.0.into_iter())
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

#[cfg(feature = "serde")]
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
