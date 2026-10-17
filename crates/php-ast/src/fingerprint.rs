//! Position-independent fingerprints of AST nodes.
//!
//! [`structural_fingerprint`] hashes a node's full structure — kinds, names,
//! literals, operators, doc comments — while ignoring every [`Span`]. Two
//! nodes that differ only in where they sit in the file (an edit above a
//! function shifts every offset inside it) get the same fingerprint.
//!
//! This is meant for incremental tools such as salsa-based analyzers: store
//! the fingerprint next to a declaration's subtree and compare fingerprints
//! instead of nodes, so a declaration whose code did not change compares equal
//! after unrelated edits and its downstream results can be reused. Results
//! derived from such a node must not carry its absolute positions; keep them
//! relative to the declaration and add its current start when reporting.
//!
//! It works on anything that implements [`serde::Serialize`], so both the
//! arena and the owned AST are supported.
//!
//! ```
//! use php_ast::fingerprint::structural_fingerprint;
//! use php_ast::owned::{Expr, ExprKind};
//! use php_ast::Span;
//!
//! let var = |name: &str, start: u32| Expr {
//!     kind: ExprKind::Variable(name.into()),
//!     span: Span::new(start, start + 1 + name.len() as u32),
//! };
//! // Same variable at two positions: equal fingerprints.
//! assert_eq!(structural_fingerprint(&var("x", 10)), structural_fingerprint(&var("x", 90)));
//! // A different variable: different fingerprints.
//! assert_ne!(structural_fingerprint(&var("x", 10)), structural_fingerprint(&var("y", 10)));
//! ```
//!
//! [`Span`]: crate::Span

use std::collections::hash_map::DefaultHasher;
use std::fmt;
use std::hash::Hasher;

use serde::ser::{self, Serialize};

/// A 64-bit hash of `node`'s structure that ignores every [`Span`](crate::Span).
///
/// Equal nodes always produce equal fingerprints; two different nodes collide
/// with probability around 2^-64, ample for comparing a node with its previous
/// version. The value is deterministic within one build but not guaranteed to
/// be stable across versions of this crate or of Rust, so use it for in-memory
/// comparison rather than persisting it.
pub fn structural_fingerprint<T: Serialize + ?Sized>(node: &T) -> u64 {
    let mut fingerprinter = Fingerprinter(DefaultHasher::new());
    // The serializer itself never fails; a custom `Serialize` impl could, in
    // which case the fingerprint covers everything up to that point.
    let _ = node.serialize(&mut fingerprinter);
    fingerprinter.0.finish()
}

/// Struct and field names are not hashed: a value's Rust type already fixes
/// which struct sits at each position, and enum variants are told apart by
/// their index.
struct Fingerprinter(DefaultHasher);

/// Tags written before each value so that different shapes cannot produce the
/// same byte stream.
#[repr(u8)]
enum Tag {
    Bool,
    Int,
    Float,
    Char,
    Str,
    Bytes,
    None,
    Some,
    Unit,
    UnitStruct,
    UnitVariant,
    NewtypeStruct,
    NewtypeVariant,
    Seq,
    Tuple,
    TupleStruct,
    TupleVariant,
    Map,
    Struct,
    StructVariant,
    Field,
    End,
}

impl Fingerprinter {
    fn tag(&mut self, tag: Tag) {
        self.0.write_u8(tag as u8);
    }

    fn u64(&mut self, value: u64) {
        self.0.write_u64(value);
    }

    fn bytes(&mut self, bytes: &[u8]) {
        self.u64(bytes.len() as u64);
        self.0.write(bytes);
    }
}

/// The serializer never fails on its own; this only satisfies the trait.
#[derive(Debug)]
struct FingerprintError(String);

impl fmt::Display for FingerprintError {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        f.write_str(&self.0)
    }
}

impl std::error::Error for FingerprintError {}

impl ser::Error for FingerprintError {
    fn custom<T: fmt::Display>(msg: T) -> Self {
        Self(msg.to_string())
    }
}

/// Struct serializer that skips the contents of a `Span`.
struct StructFingerprinter<'a> {
    fingerprinter: Option<&'a mut Fingerprinter>,
}

impl<'a> ser::Serializer for &'a mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;
    type SerializeSeq = Self;
    type SerializeTuple = Self;
    type SerializeTupleStruct = Self;
    type SerializeTupleVariant = Self;
    type SerializeMap = Self;
    type SerializeStruct = StructFingerprinter<'a>;
    type SerializeStructVariant = Self;

    fn serialize_bool(self, v: bool) -> Result<(), FingerprintError> {
        self.tag(Tag::Bool);
        self.u64(u64::from(v));
        Ok(())
    }

    fn serialize_i8(self, v: i8) -> Result<(), FingerprintError> {
        self.serialize_i64(i64::from(v))
    }

    fn serialize_i16(self, v: i16) -> Result<(), FingerprintError> {
        self.serialize_i64(i64::from(v))
    }

    fn serialize_i32(self, v: i32) -> Result<(), FingerprintError> {
        self.serialize_i64(i64::from(v))
    }

    fn serialize_i64(self, v: i64) -> Result<(), FingerprintError> {
        self.tag(Tag::Int);
        self.u64(v as u64);
        Ok(())
    }

    fn serialize_u8(self, v: u8) -> Result<(), FingerprintError> {
        self.serialize_u64(u64::from(v))
    }

    fn serialize_u16(self, v: u16) -> Result<(), FingerprintError> {
        self.serialize_u64(u64::from(v))
    }

    fn serialize_u32(self, v: u32) -> Result<(), FingerprintError> {
        self.serialize_u64(u64::from(v))
    }

    fn serialize_u64(self, v: u64) -> Result<(), FingerprintError> {
        self.tag(Tag::Int);
        self.u64(v);
        Ok(())
    }

    fn serialize_f32(self, v: f32) -> Result<(), FingerprintError> {
        self.serialize_f64(f64::from(v))
    }

    fn serialize_f64(self, v: f64) -> Result<(), FingerprintError> {
        self.tag(Tag::Float);
        self.u64(v.to_bits());
        Ok(())
    }

    fn serialize_char(self, v: char) -> Result<(), FingerprintError> {
        self.tag(Tag::Char);
        self.u64(u64::from(v));
        Ok(())
    }

    fn serialize_str(self, v: &str) -> Result<(), FingerprintError> {
        self.tag(Tag::Str);
        self.bytes(v.as_bytes());
        Ok(())
    }

    fn serialize_bytes(self, v: &[u8]) -> Result<(), FingerprintError> {
        self.tag(Tag::Bytes);
        self.bytes(v);
        Ok(())
    }

    fn serialize_none(self) -> Result<(), FingerprintError> {
        self.tag(Tag::None);
        Ok(())
    }

    fn serialize_some<T: Serialize + ?Sized>(self, value: &T) -> Result<(), FingerprintError> {
        self.tag(Tag::Some);
        value.serialize(self)
    }

    fn serialize_unit(self) -> Result<(), FingerprintError> {
        self.tag(Tag::Unit);
        Ok(())
    }

    fn serialize_unit_struct(self, _name: &'static str) -> Result<(), FingerprintError> {
        self.tag(Tag::UnitStruct);
        Ok(())
    }

    fn serialize_unit_variant(
        self,
        _name: &'static str,
        index: u32,
        _variant: &'static str,
    ) -> Result<(), FingerprintError> {
        self.tag(Tag::UnitVariant);
        self.u64(u64::from(index));
        Ok(())
    }

    fn serialize_newtype_struct<T: Serialize + ?Sized>(
        self,
        _name: &'static str,
        value: &T,
    ) -> Result<(), FingerprintError> {
        self.tag(Tag::NewtypeStruct);
        value.serialize(self)
    }

    fn serialize_newtype_variant<T: Serialize + ?Sized>(
        self,
        _name: &'static str,
        index: u32,
        _variant: &'static str,
        value: &T,
    ) -> Result<(), FingerprintError> {
        self.tag(Tag::NewtypeVariant);
        self.u64(u64::from(index));
        value.serialize(self)
    }

    fn serialize_seq(self, _len: Option<usize>) -> Result<Self, FingerprintError> {
        self.tag(Tag::Seq);
        Ok(self)
    }

    fn serialize_tuple(self, _len: usize) -> Result<Self, FingerprintError> {
        self.tag(Tag::Tuple);
        Ok(self)
    }

    fn serialize_tuple_struct(
        self,
        _name: &'static str,
        _len: usize,
    ) -> Result<Self, FingerprintError> {
        self.tag(Tag::TupleStruct);
        Ok(self)
    }

    fn serialize_tuple_variant(
        self,
        _name: &'static str,
        index: u32,
        _variant: &'static str,
        _len: usize,
    ) -> Result<Self, FingerprintError> {
        self.tag(Tag::TupleVariant);
        self.u64(u64::from(index));
        Ok(self)
    }

    fn serialize_map(self, _len: Option<usize>) -> Result<Self, FingerprintError> {
        self.tag(Tag::Map);
        Ok(self)
    }

    fn serialize_struct(
        self,
        name: &'static str,
        _len: usize,
    ) -> Result<StructFingerprinter<'a>, FingerprintError> {
        if name == "Span" {
            return Ok(StructFingerprinter {
                fingerprinter: None,
            });
        }
        self.tag(Tag::Struct);
        Ok(StructFingerprinter {
            fingerprinter: Some(self),
        })
    }

    fn serialize_struct_variant(
        self,
        _name: &'static str,
        index: u32,
        _variant: &'static str,
        _len: usize,
    ) -> Result<Self, FingerprintError> {
        self.tag(Tag::StructVariant);
        self.u64(u64::from(index));
        Ok(self)
    }
}

impl ser::SerializeSeq for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_element<T: Serialize + ?Sized>(
        &mut self,
        value: &T,
    ) -> Result<(), FingerprintError> {
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}

impl ser::SerializeTuple for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_element<T: Serialize + ?Sized>(
        &mut self,
        value: &T,
    ) -> Result<(), FingerprintError> {
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}

impl ser::SerializeTupleStruct for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_field<T: Serialize + ?Sized>(
        &mut self,
        value: &T,
    ) -> Result<(), FingerprintError> {
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}

impl ser::SerializeTupleVariant for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_field<T: Serialize + ?Sized>(
        &mut self,
        value: &T,
    ) -> Result<(), FingerprintError> {
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}

impl ser::SerializeMap for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_key<T: Serialize + ?Sized>(&mut self, key: &T) -> Result<(), FingerprintError> {
        key.serialize(&mut **self)
    }

    fn serialize_value<T: Serialize + ?Sized>(
        &mut self,
        value: &T,
    ) -> Result<(), FingerprintError> {
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}

impl ser::SerializeStruct for StructFingerprinter<'_> {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_field<T: Serialize + ?Sized>(
        &mut self,
        _key: &'static str,
        value: &T,
    ) -> Result<(), FingerprintError> {
        let Some(fingerprinter) = self.fingerprinter.as_deref_mut() else {
            return Ok(());
        };
        fingerprinter.tag(Tag::Field);
        value.serialize(fingerprinter)
    }

    fn skip_field(&mut self, _key: &'static str) -> Result<(), FingerprintError> {
        // A skipped optional field must not look like a present one.
        if let Some(fingerprinter) = self.fingerprinter.as_deref_mut() {
            fingerprinter.tag(Tag::None);
        }
        Ok(())
    }

    fn end(self) -> Result<(), FingerprintError> {
        if let Some(fingerprinter) = self.fingerprinter {
            fingerprinter.tag(Tag::End);
        }
        Ok(())
    }
}

impl ser::SerializeStructVariant for &mut Fingerprinter {
    type Ok = ();
    type Error = FingerprintError;

    fn serialize_field<T: Serialize + ?Sized>(
        &mut self,
        _key: &'static str,
        value: &T,
    ) -> Result<(), FingerprintError> {
        self.tag(Tag::Field);
        value.serialize(&mut **self)
    }

    fn end(self) -> Result<(), FingerprintError> {
        self.tag(Tag::End);
        Ok(())
    }
}
