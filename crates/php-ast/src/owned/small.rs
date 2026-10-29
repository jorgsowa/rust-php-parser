//! 16-byte strings that store up to 15 bytes inline and longer values on the heap.

use std::borrow::Borrow;
use std::cmp::Ordering;
use std::fmt;
use std::hash::{Hash, Hasher};
use std::ops::Deref;

const INLINE_CAP: usize = 15;

/// Inline length (0..=15) or `Heap`; the unused values give `Option<SmallStr>` a niche.
#[derive(Clone, Copy, PartialEq, Eq)]
#[repr(u8)]
enum Tag {
    L0 = 0,
    L1,
    L2,
    L3,
    L4,
    L5,
    L6,
    L7,
    L8,
    L9,
    L10,
    L11,
    L12,
    L13,
    L14,
    L15,
    Heap = 16,
}

impl Tag {
    const INLINE: [Tag; INLINE_CAP + 1] = [
        Tag::L0,
        Tag::L1,
        Tag::L2,
        Tag::L3,
        Tag::L4,
        Tag::L5,
        Tag::L6,
        Tag::L7,
        Tag::L8,
        Tag::L9,
        Tag::L10,
        Tag::L11,
        Tag::L12,
        Tag::L13,
        Tag::L14,
        Tag::L15,
    ];
}

#[derive(Clone, Copy)]
#[repr(C)]
union Head {
    ptr: *mut u8,
    bytes: [u8; 8],
}

/// Inline bytes occupy `head.bytes` then `tail`; on the heap, `tail` holds the length.
#[repr(C, align(8))]
pub(crate) struct SmallBytes {
    head: Head,
    tail: [u8; 7],
    tag: Tag,
}

// SAFETY: the heap buffer is uniquely owned, like `Box<[u8]>`.
unsafe impl Send for SmallBytes {}
unsafe impl Sync for SmallBytes {}

impl SmallBytes {
    #[inline]
    pub(crate) fn new(bytes: &[u8]) -> Self {
        if bytes.len() <= INLINE_CAP {
            Self::inline(bytes)
        } else {
            Self::heap(bytes.into())
        }
    }

    #[inline]
    pub(crate) fn from_box(bytes: Box<[u8]>) -> Self {
        if bytes.len() <= INLINE_CAP {
            Self::inline(&bytes)
        } else {
            Self::heap(bytes)
        }
    }

    #[inline]
    fn inline(bytes: &[u8]) -> Self {
        let mut buf = [0u8; 16];
        buf[..bytes.len()].copy_from_slice(bytes);
        let mut head = [0u8; 8];
        head.copy_from_slice(&buf[..8]);
        let mut tail = [0u8; 7];
        tail.copy_from_slice(&buf[8..15]);
        Self {
            head: Head { bytes: head },
            tail,
            tag: Tag::INLINE[bytes.len()],
        }
    }

    fn heap(bytes: Box<[u8]>) -> Self {
        let len = bytes.len() as u64;
        assert!(len < 1 << 56, "string too long");
        let ptr = Box::into_raw(bytes) as *mut u8;
        let mut tail = [0u8; 7];
        tail.copy_from_slice(&len.to_le_bytes()[..7]);
        Self {
            head: Head { ptr },
            tail,
            tag: Tag::Heap,
        }
    }

    #[inline]
    fn heap_len(&self) -> usize {
        let mut len = [0u8; 8];
        len[..7].copy_from_slice(&self.tail);
        u64::from_le_bytes(len) as usize
    }

    #[inline]
    pub(crate) fn as_bytes(&self) -> &[u8] {
        if self.tag == Tag::Heap {
            // SAFETY: `ptr` and the stored length come from a live `Box<[u8]>`.
            unsafe { std::slice::from_raw_parts(self.head.ptr, self.heap_len()) }
        } else {
            // SAFETY: `repr(C)` lays out `head` and `tail` contiguously, and the first `tag` bytes are initialized.
            unsafe {
                std::slice::from_raw_parts(self as *const Self as *const u8, self.tag as usize)
            }
        }
    }

    pub(crate) fn into_box(self) -> Box<[u8]> {
        if self.tag == Tag::Heap {
            let this = std::mem::ManuallyDrop::new(self);
            // SAFETY: ownership of the buffer moves out; `this` is never dropped.
            unsafe {
                Box::from_raw(std::ptr::slice_from_raw_parts_mut(
                    this.head.ptr,
                    this.heap_len(),
                ))
            }
        } else {
            self.as_bytes().into()
        }
    }
}

impl Drop for SmallBytes {
    #[inline]
    fn drop(&mut self) {
        if self.tag == Tag::Heap {
            // SAFETY: the buffer was created by `Box::into_raw` and is dropped once.
            unsafe {
                drop(Box::from_raw(std::ptr::slice_from_raw_parts_mut(
                    self.head.ptr,
                    self.heap_len(),
                )))
            }
        }
    }
}

impl Clone for SmallBytes {
    #[inline]
    fn clone(&self) -> Self {
        if self.tag == Tag::Heap {
            Self::heap(self.as_bytes().into())
        } else {
            Self {
                head: self.head,
                tail: self.tail,
                tag: self.tag,
            }
        }
    }
}

/// An immutable string that stores up to 15 bytes inline and longer values on the heap.
///
/// It is the size of `Box<str>` and dereferences to `str`.
#[derive(Clone)]
pub struct SmallStr(SmallBytes);

impl SmallStr {
    /// The string slice.
    #[inline]
    pub fn as_str(&self) -> &str {
        // SAFETY: only ever built from `str` data.
        unsafe { std::str::from_utf8_unchecked(self.0.as_bytes()) }
    }

    /// Converts into a boxed `str`, reusing a heap buffer when there is one.
    pub fn into_boxed_str(self) -> Box<str> {
        // SAFETY: only ever built from `str` data.
        unsafe { std::str::from_boxed_utf8_unchecked(self.0.into_box()) }
    }
}

impl SmallStr {
    pub(crate) fn joined<S: AsRef<str>>(parts: &[S]) -> Self {
        let len =
            parts.iter().map(|p| p.as_ref().len()).sum::<usize>() + parts.len().saturating_sub(1);
        let mut inline = [0u8; INLINE_CAP];
        let mut heap = Vec::new();
        let buf: &mut [u8] = if len <= INLINE_CAP {
            &mut inline[..len]
        } else {
            heap.resize(len, 0);
            &mut heap
        };
        let mut at = 0;
        for (i, p) in parts.iter().enumerate() {
            if i > 0 {
                buf[at] = b'\\';
                at += 1;
            }
            let p = p.as_ref().as_bytes();
            buf[at..at + p.len()].copy_from_slice(p);
            at += p.len();
        }
        if len <= INLINE_CAP {
            Self(SmallBytes::inline(&inline[..len]))
        } else {
            Self(SmallBytes::heap(heap.into_boxed_slice()))
        }
    }
}

impl Default for SmallStr {
    fn default() -> Self {
        Self(SmallBytes::inline(&[]))
    }
}

impl Deref for SmallStr {
    type Target = str;
    #[inline]
    fn deref(&self) -> &str {
        self.as_str()
    }
}

impl AsRef<str> for SmallStr {
    fn as_ref(&self) -> &str {
        self.as_str()
    }
}

impl Borrow<str> for SmallStr {
    fn borrow(&self) -> &str {
        self.as_str()
    }
}

impl From<&str> for SmallStr {
    #[inline]
    fn from(s: &str) -> Self {
        Self(SmallBytes::new(s.as_bytes()))
    }
}

impl From<&String> for SmallStr {
    fn from(s: &String) -> Self {
        Self::from(s.as_str())
    }
}

impl From<String> for SmallStr {
    fn from(s: String) -> Self {
        Self::from(s.into_boxed_str())
    }
}

impl From<Box<str>> for SmallStr {
    fn from(s: Box<str>) -> Self {
        Self(SmallBytes::from_box(s.into_boxed_bytes()))
    }
}

impl From<std::borrow::Cow<'_, str>> for SmallStr {
    fn from(s: std::borrow::Cow<'_, str>) -> Self {
        match s {
            std::borrow::Cow::Borrowed(s) => Self::from(s),
            std::borrow::Cow::Owned(s) => Self::from(s),
        }
    }
}

impl From<SmallStr> for Box<str> {
    fn from(s: SmallStr) -> Self {
        s.into_boxed_str()
    }
}

impl From<SmallStr> for String {
    fn from(s: SmallStr) -> Self {
        s.into_boxed_str().into_string()
    }
}

impl PartialEq for SmallStr {
    #[inline]
    fn eq(&self, other: &Self) -> bool {
        self.as_str() == other.as_str()
    }
}

impl Eq for SmallStr {}

impl PartialEq<str> for SmallStr {
    fn eq(&self, other: &str) -> bool {
        self.as_str() == other
    }
}

impl PartialEq<&str> for SmallStr {
    fn eq(&self, other: &&str) -> bool {
        self.as_str() == *other
    }
}

impl PartialEq<String> for SmallStr {
    fn eq(&self, other: &String) -> bool {
        self.as_str() == other.as_str()
    }
}

impl PartialEq<SmallStr> for str {
    fn eq(&self, other: &SmallStr) -> bool {
        self == other.as_str()
    }
}

impl PartialEq<SmallStr> for &str {
    fn eq(&self, other: &SmallStr) -> bool {
        *self == other.as_str()
    }
}

impl PartialOrd for SmallStr {
    fn partial_cmp(&self, other: &Self) -> Option<Ordering> {
        Some(self.cmp(other))
    }
}

impl Ord for SmallStr {
    fn cmp(&self, other: &Self) -> Ordering {
        self.as_str().cmp(other.as_str())
    }
}

impl Hash for SmallStr {
    #[inline]
    fn hash<H: Hasher>(&self, state: &mut H) {
        self.as_str().hash(state)
    }
}

impl fmt::Debug for SmallStr {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        fmt::Debug::fmt(self.as_str(), f)
    }
}

impl fmt::Display for SmallStr {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        f.write_str(self.as_str())
    }
}

#[cfg(feature = "serde")]
impl serde::Serialize for SmallStr {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        s.serialize_str(self.as_str())
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn layout() {
        assert_eq!(std::mem::size_of::<SmallStr>(), 16);
        assert_eq!(std::mem::size_of::<Option<SmallStr>>(), 16);
    }

    #[test]
    fn round_trips_every_length() {
        let src: String = ('a'..='z').cycle().take(40).collect();
        for len in 0..=src.len() {
            let s = SmallStr::from(&src[..len]);
            assert_eq!(s.as_str(), &src[..len]);
            assert_eq!(s.clone(), s);
            assert_eq!(&*SmallStr::from(src[..len].to_string()), &src[..len]);
            assert_eq!(&*s.into_boxed_str(), &src[..len]);
        }
    }

    #[test]
    fn multibyte_at_inline_boundary() {
        for s in ["ąęśćżźółń", "ąęśćżźół", "ééééééé", "éééééééé", "日本語日本"]
        {
            assert_eq!(SmallStr::from(s).as_str(), s);
        }
    }

    #[test]
    fn hash_matches_str() {
        use std::collections::HashSet;
        let set: HashSet<SmallStr> = ["a", "a_much_longer_string_value"]
            .map(SmallStr::from)
            .into();
        assert!(set.contains("a"));
        assert!(set.contains("a_much_longer_string_value"));
    }
}
