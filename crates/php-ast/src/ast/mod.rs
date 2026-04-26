mod decls;
mod exprs;
mod misc;
mod names;
mod stmts;

pub use decls::*;
pub use exprs::*;
pub use misc::*;
pub use names::*;
pub use stmts::*;

pub(crate) fn is_false(b: &bool) -> bool {
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
