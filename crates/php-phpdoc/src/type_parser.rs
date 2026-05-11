//! Recursive descent parser for the PHPDoc type language.
//!
//! Grammar (simplified):
//! ```text
//! union_type          = intersection_type ('|' intersection_type)*
//! intersection_type   = atomic_type ('&' atomic_type)*
//! atomic_type         = '?' atomic_type
//!                     | '(' conditional_or_paren ')'
//!                     | postfix_type
//! postfix_type        = primary_type ('<' type_args '>')?
//! primary_type        = 'array' '{' shape_fields '}'
//!                     | name '(' callable_params ')' (':' union_type)?
//!                     | string_literal | 'true' | 'false' | 'null'
//!                     | qualified_name
//! conditional_or_paren = union_type ('is' union_type '?' union_type ':' union_type)?
//! ```

use php_ast::Span;

use crate::ast::{ArrayShapeField, CallableParam, PhpDocType, PhpDocTypeKind};

// =============================================================================
// Public entry points
// =============================================================================

/// Parse a standalone type string (e.g. directly from a `type_str` field).
/// Returns `PhpDocTypeKind::Unknown` for unrecognisable input rather than panicking.
pub fn parse_type(text: &str) -> PhpDocType {
    TypeParser::new(text, 0).parse_union()
}

/// Parse a type from within a comment at the given base offset.
/// Used by `parser.rs` to produce comment-relative spans.
pub(crate) fn parse_type_at(text: &str, base_offset: u32) -> PhpDocType {
    TypeParser::new(text, base_offset).parse_union()
}

// =============================================================================
// Parser state
// =============================================================================

struct TypeParser<'src> {
    src: &'src str,
    pos: usize,
    /// Byte offset of `src[0]` within the original comment string.
    base_offset: u32,
}

impl<'src> TypeParser<'src> {
    fn new(src: &'src str, base_offset: u32) -> Self {
        Self {
            src,
            pos: 0,
            base_offset,
        }
    }

    // -------------------------------------------------------------------------
    // Span helpers
    // -------------------------------------------------------------------------

    fn span(&self, start: usize, end: usize) -> Span {
        Span::new(
            self.base_offset + start as u32,
            self.base_offset + end as u32,
        )
    }

    fn remaining(&self) -> &'src str {
        &self.src[self.pos..]
    }

    // -------------------------------------------------------------------------
    // Character-level helpers
    // -------------------------------------------------------------------------

    fn skip_ws(&mut self) {
        while self.pos < self.src.len() && self.src.as_bytes()[self.pos].is_ascii_whitespace() {
            self.pos += 1;
        }
    }

    fn peek(&self) -> Option<u8> {
        self.src.as_bytes().get(self.pos).copied()
    }

    fn eat(&mut self, ch: u8) -> bool {
        if self.src.as_bytes().get(self.pos) == Some(&ch) {
            self.pos += 1;
            true
        } else {
            false
        }
    }

    /// Consume a bare identifier / qualified name (letters, digits, `_`, `\`, `-`).
    /// Returns the raw slice and its start position in `src`.
    fn eat_name(&mut self) -> Option<(&'src str, usize)> {
        self.skip_ws();
        let start = self.pos;
        let bytes = self.src.as_bytes();

        // Allow leading backslash for FQCN
        if self.pos < bytes.len() && bytes[self.pos] == b'\\' {
            self.pos += 1;
        }

        let name_start = start;
        while self.pos < bytes.len() {
            let b = bytes[self.pos];
            if b.is_ascii_alphanumeric() || b == b'_' || b == b'\\' || b == b'-' || b == b'$' {
                self.pos += 1;
            } else {
                break;
            }
        }

        if self.pos == name_start
            || (self.pos == name_start + 1 && self.src.as_bytes()[name_start] == b'\\')
        {
            // Nothing consumed (or only a lone backslash) — restore
            self.pos = start;
            return None;
        }

        Some((&self.src[name_start..self.pos], start))
    }

    /// Consume a single-quoted string literal: `'...'`.
    fn eat_string_literal(&mut self) -> Option<(&'src str, usize)> {
        self.skip_ws();
        let start = self.pos;
        let bytes = self.src.as_bytes();
        if bytes.get(self.pos) != Some(&b'\'') {
            return None;
        }
        self.pos += 1; // consume opening '
        while self.pos < bytes.len() {
            if bytes[self.pos] == b'\\' && self.pos + 1 < bytes.len() {
                self.pos += 2; // skip escape
            } else if bytes[self.pos] == b'\'' {
                self.pos += 1; // consume closing '
                return Some((&self.src[start..self.pos], start));
            } else {
                self.pos += 1;
            }
        }
        // Unterminated — return what we have
        Some((&self.src[start..self.pos], start))
    }

    /// Consume a decimal integer literal.
    fn eat_int_literal(&mut self) -> Option<(&'src str, usize)> {
        self.skip_ws();
        let start = self.pos;
        let bytes = self.src.as_bytes();
        if self.pos < bytes.len() && bytes[self.pos] == b'-' {
            self.pos += 1;
        }
        let num_start = self.pos;
        while self.pos < bytes.len() && bytes[self.pos].is_ascii_digit() {
            self.pos += 1;
        }
        if self.pos == num_start {
            self.pos = start;
            return None;
        }
        Some((&self.src[start..self.pos], start))
    }

    // -------------------------------------------------------------------------
    // Grammar productions
    // -------------------------------------------------------------------------

    /// Top-level: `union_type = intersection_type ('|' intersection_type)*`
    pub(crate) fn parse_union(&mut self) -> PhpDocType {
        let start = {
            self.skip_ws();
            self.pos
        };
        let first = self.parse_intersection();
        self.skip_ws();

        if self.peek() != Some(b'|') {
            return first;
        }

        let mut parts = vec![first];
        while self.peek() == Some(b'|') {
            self.pos += 1; // consume '|'
            parts.push(self.parse_intersection());
            self.skip_ws();
        }

        let end = self.pos;
        PhpDocType {
            kind: PhpDocTypeKind::Union(parts),
            span: self.span(start, end),
        }
    }

    /// `intersection_type = atomic_type ('&' atomic_type)*`
    fn parse_intersection(&mut self) -> PhpDocType {
        let start = {
            self.skip_ws();
            self.pos
        };
        let first = self.parse_atomic();
        self.skip_ws();

        if self.peek() != Some(b'&') {
            return first;
        }

        let mut parts = vec![first];
        while self.peek() == Some(b'&') {
            self.pos += 1; // consume '&'
            parts.push(self.parse_atomic());
            self.skip_ws();
        }

        let end = self.pos;
        PhpDocType {
            kind: PhpDocTypeKind::Intersection(parts),
            span: self.span(start, end),
        }
    }

    /// `atomic_type = '?' atomic_type | '(' ... ')' | postfix_type`
    fn parse_atomic(&mut self) -> PhpDocType {
        self.skip_ws();
        let start = self.pos;

        if self.eat(b'?') {
            let inner = self.parse_atomic();
            let end = self.pos;
            return PhpDocType {
                kind: PhpDocTypeKind::Nullable(Box::new(inner)),
                span: self.span(start, end),
            };
        }

        if self.eat(b'(') {
            let ty = self.parse_conditional_or_paren();
            self.skip_ws();
            self.eat(b')');
            return ty;
        }

        self.parse_postfix()
    }

    /// Inside `(...)`: either a conditional type or a plain parenthesised type.
    /// `conditional_or_paren = union_type ('is' union_type '?' union_type ':' union_type)?`
    fn parse_conditional_or_paren(&mut self) -> PhpDocType {
        let start = {
            self.skip_ws();
            self.pos
        };
        let subject = self.parse_union();
        self.skip_ws();

        // Check for `is` keyword
        if self.remaining().starts_with("is") {
            let after_is = &self.remaining()[2..];
            // `is` must be followed by whitespace or `(` or `\` to be a keyword
            let is_keyword = after_is
                .chars()
                .next()
                .map(|c| c.is_whitespace() || c == '(' || c == '\\')
                .unwrap_or(true);

            if is_keyword {
                self.pos += 2; // consume `is`
                self.skip_ws();
                let target = self.parse_union();
                self.skip_ws();
                if self.eat(b'?') {
                    self.skip_ws();
                    let then_type = self.parse_union();
                    self.skip_ws();
                    self.eat(b':');
                    self.skip_ws();
                    let else_type = self.parse_union();
                    let end = self.pos;
                    return PhpDocType {
                        kind: PhpDocTypeKind::Conditional {
                            subject: Box::new(subject),
                            target: Box::new(target),
                            then_type: Box::new(then_type),
                            else_type: Box::new(else_type),
                        },
                        span: self.span(start, end),
                    };
                }
            }
        }

        subject
    }

    /// `postfix_type = primary_type ('<' type_args '>')?`
    fn parse_postfix(&mut self) -> PhpDocType {
        self.skip_ws();
        let start = self.pos;
        let base = self.parse_primary();
        self.skip_ws();

        if self.peek() != Some(b'<') {
            return base;
        }

        self.pos += 1; // consume '<'
        let args = self.parse_type_args();
        self.skip_ws();
        self.eat(b'>');
        let end = self.pos;

        PhpDocType {
            kind: PhpDocTypeKind::Generic {
                base: Box::new(base),
                args,
            },
            span: self.span(start, end),
        }
    }

    /// Parse comma-separated type args inside `<...>`.
    fn parse_type_args(&mut self) -> Vec<PhpDocType> {
        let mut args = Vec::new();
        loop {
            self.skip_ws();
            if matches!(self.peek(), Some(b'>') | None) {
                break;
            }
            args.push(self.parse_union());
            self.skip_ws();
            if !self.eat(b',') {
                break;
            }
        }
        args
    }

    /// Primary type: array shape, callable, literal, or qualified name.
    fn parse_primary(&mut self) -> PhpDocType {
        self.skip_ws();
        let start = self.pos;

        // String literal
        if let Some((text, lit_start)) = self.eat_string_literal() {
            return PhpDocType {
                kind: PhpDocTypeKind::Literal(text.to_owned()),
                span: self.span(lit_start, self.pos),
            };
        }

        // Integer literal (possibly negative)
        if let Some((text, lit_start)) = self.eat_int_literal() {
            // Only treat as literal if it looks numeric (not just '-' followed by a name)
            if text
                .trim_start_matches('-')
                .chars()
                .all(|c| c.is_ascii_digit())
            {
                return PhpDocType {
                    kind: PhpDocTypeKind::Literal(text.to_owned()),
                    span: self.span(lit_start, self.pos),
                };
            } else {
                // Restore
                self.pos = start;
            }
        }

        // Named type (or keyword, or class name)
        if let Some((name, name_start)) = self.eat_name() {
            let name_end = self.pos;
            self.skip_ws();

            // `true`, `false`, `null` as literals
            match name {
                "true" | "false" | "null" => {
                    return PhpDocType {
                        kind: PhpDocTypeKind::Literal(name.to_owned()),
                        span: self.span(name_start, name_end),
                    };
                }
                _ => {}
            }

            // `array{...}` — array shape
            if name == "array" && self.peek() == Some(b'{') {
                self.pos += 1; // consume '{'
                let (fields, extra) = self.parse_shape_fields();
                self.skip_ws();
                self.eat(b'}');
                let end = self.pos;
                return PhpDocType {
                    kind: PhpDocTypeKind::ArrayShape { fields, extra },
                    span: self.span(start, end),
                };
            }

            // Callable / Closure with `(` — parse callable params
            if self.peek() == Some(b'(') {
                self.pos += 1; // consume '('
                let params = self.parse_callable_params();
                self.skip_ws();
                self.eat(b')');
                self.skip_ws();

                // Optional `: return_type`
                let return_type = if self.peek() == Some(b':') {
                    self.pos += 1;
                    self.skip_ws();
                    Some(Box::new(self.parse_union()))
                } else {
                    None
                };

                let end = self.pos;
                return PhpDocType {
                    kind: PhpDocTypeKind::Callable {
                        params,
                        return_type,
                    },
                    span: self.span(start, end),
                };
            }

            // Plain named type
            return PhpDocType {
                kind: PhpDocTypeKind::Named(name.to_owned()),
                span: self.span(name_start, name_end),
            };
        }

        // Nothing matched — consume to the next structural boundary and return Unknown
        let unknown_start = self.pos;
        while self.pos < self.src.len() {
            let b = self.src.as_bytes()[self.pos];
            if matches!(b, b'|' | b'&' | b',' | b'>' | b')' | b'}' | b']') {
                break;
            }
            self.pos += 1;
        }
        let text = self.src[unknown_start..self.pos].trim().to_owned();
        PhpDocType {
            kind: PhpDocTypeKind::Unknown(text),
            span: self.span(unknown_start, self.pos),
        }
    }

    // -------------------------------------------------------------------------
    // Array shape fields
    // -------------------------------------------------------------------------

    /// Parse fields inside `array{...}`.
    fn parse_shape_fields(&mut self) -> (Vec<ArrayShapeField>, bool) {
        let mut fields = Vec::new();
        let mut extra = false;

        loop {
            self.skip_ws();
            match self.peek() {
                None | Some(b'}') => break,
                Some(b'.') => {
                    // `...` means open shape
                    if self.remaining().starts_with("...") {
                        self.pos += 3;
                        extra = true;
                        self.skip_ws();
                        self.eat(b',');
                    } else {
                        self.pos += 1;
                    }
                    continue;
                }
                _ => {}
            }

            let field_start = self.pos;

            // Try to parse a key (identifier or string literal), then `:`.
            // If there is no `:` after what looks like a key, treat it as a positional field.
            let key_result = self.try_parse_shape_key();

            let (key, optional) = key_result.unwrap_or_default();

            self.skip_ws();
            let value_type = self.parse_union();
            let field_end = self.pos;

            fields.push(ArrayShapeField {
                key,
                optional,
                value_type,
                span: self.span(field_start, field_end),
            });

            self.skip_ws();
            if !self.eat(b',') {
                break;
            }
        }

        (fields, extra)
    }

    /// Try to parse `key:` or `key?:` at the current position.
    /// Returns `Some((key, optional))` and advances past the `:` if found.
    /// Returns `None` and leaves position unchanged for positional fields.
    fn try_parse_shape_key(&mut self) -> Option<(Option<String>, bool)> {
        let saved = self.pos;

        // Key can be a string literal or an identifier
        let key_str = if let Some((lit, _)) = self.eat_string_literal() {
            Some(lit.to_owned())
        } else if let Some((name, _)) = self.eat_name() {
            Some(name.to_owned())
        } else if let Some((num, _)) = self.eat_int_literal() {
            Some(num.to_owned())
        } else {
            None
        };

        if let Some(key) = key_str {
            self.skip_ws();
            let optional = self.eat(b'?');
            self.skip_ws();
            if self.eat(b':') {
                self.skip_ws();
                return Some((Some(key), optional));
            }
        }

        // No key found — restore position for positional field
        self.pos = saved;
        None
    }

    // -------------------------------------------------------------------------
    // Callable params
    // -------------------------------------------------------------------------

    fn parse_callable_params(&mut self) -> Vec<CallableParam> {
        let mut params = Vec::new();

        loop {
            self.skip_ws();
            if matches!(self.peek(), Some(b')') | None) {
                break;
            }

            let param_start = self.pos;

            // by_ref indicator
            let by_ref = self.eat(b'&');
            self.skip_ws();

            let param_type = self.parse_union();
            self.skip_ws();

            // variadic indicator comes after the type: `int ...$args`
            let variadic = if self.remaining().starts_with("...") {
                self.pos += 3;
                self.skip_ws();
                true
            } else {
                false
            };

            // Optional `$name`
            let name = if self.peek() == Some(b'$') {
                self.eat_name().map(|(n, _)| n.to_owned())
            } else {
                None
            };

            let param_end = self.pos;
            params.push(CallableParam {
                param_type,
                name,
                by_ref,
                variadic,
                span: self.span(param_start, param_end),
            });

            self.skip_ws();
            if !self.eat(b',') {
                break;
            }
        }

        params
    }
}

// =============================================================================
// Tests
// =============================================================================

#[cfg(test)]
mod tests {
    use super::*;

    fn parse(s: &str) -> PhpDocType {
        parse_type(s)
    }

    fn kind(s: &str) -> PhpDocTypeKind {
        parse(s).kind
    }

    #[test]
    fn named_primitive() {
        assert!(matches!(kind("int"), PhpDocTypeKind::Named(n) if n == "int"));
        assert!(matches!(kind("string"), PhpDocTypeKind::Named(n) if n == "string"));
        assert!(matches!(kind("\\App\\User"), PhpDocTypeKind::Named(n) if n == "\\App\\User"));
        assert!(
            matches!(kind("non-empty-string"), PhpDocTypeKind::Named(n) if n == "non-empty-string")
        );
    }

    #[test]
    fn nullable() {
        let t = parse("?int");
        assert!(matches!(t.kind, PhpDocTypeKind::Nullable(_)));
    }

    #[test]
    fn union_two() {
        let t = parse("string|null");
        assert!(matches!(t.kind, PhpDocTypeKind::Union(ref v) if v.len() == 2));
    }

    #[test]
    fn union_three() {
        let t = parse("int|string|null");
        assert!(matches!(t.kind, PhpDocTypeKind::Union(ref v) if v.len() == 3));
    }

    #[test]
    fn intersection() {
        let t = parse("Countable&ArrayAccess");
        assert!(matches!(t.kind, PhpDocTypeKind::Intersection(ref v) if v.len() == 2));
    }

    #[test]
    fn generic_simple() {
        let t = parse("array<string, int>");
        match t.kind {
            PhpDocTypeKind::Generic { base, args } => {
                assert!(matches!(base.kind, PhpDocTypeKind::Named(ref n) if n == "array"));
                assert_eq!(args.len(), 2);
            }
            _ => panic!("expected Generic"),
        }
    }

    #[test]
    fn generic_nested() {
        let t = parse("array<int, list<string>>");
        assert!(matches!(t.kind, PhpDocTypeKind::Generic { .. }));
    }

    #[test]
    fn array_shape_basic() {
        let t = parse("array{name: string, age: int}");
        match t.kind {
            PhpDocTypeKind::ArrayShape { fields, extra } => {
                assert_eq!(fields.len(), 2);
                assert!(!extra);
                assert_eq!(fields[0].key.as_deref(), Some("name"));
                assert!(!fields[0].optional);
                assert_eq!(fields[1].key.as_deref(), Some("age"));
            }
            _ => panic!("expected ArrayShape"),
        }
    }

    #[test]
    fn array_shape_optional_field() {
        let t = parse("array{name: string, logo?: string}");
        match t.kind {
            PhpDocTypeKind::ArrayShape { fields, .. } => {
                assert!(!fields[0].optional);
                assert!(fields[1].optional);
            }
            _ => panic!("expected ArrayShape"),
        }
    }

    #[test]
    fn array_shape_extra() {
        let t = parse("array{name: string, ...}");
        match t.kind {
            PhpDocTypeKind::ArrayShape { extra, .. } => assert!(extra),
            _ => panic!("expected ArrayShape"),
        }
    }

    #[test]
    fn callable_basic() {
        let t = parse("callable(int, string): bool");
        match t.kind {
            PhpDocTypeKind::Callable {
                params,
                return_type,
            } => {
                assert_eq!(params.len(), 2);
                assert!(return_type.is_some());
            }
            _ => panic!("expected Callable"),
        }
    }

    #[test]
    fn callable_no_return() {
        let t = parse("callable()");
        assert!(matches!(t.kind, PhpDocTypeKind::Callable { .. }));
    }

    #[test]
    fn closure_type() {
        let t = parse("Closure(int): void");
        assert!(matches!(t.kind, PhpDocTypeKind::Callable { .. }));
    }

    #[test]
    fn string_literal() {
        let t = parse("'left'");
        assert!(matches!(t.kind, PhpDocTypeKind::Literal(ref s) if s == "'left'"));
    }

    #[test]
    fn literal_union() {
        let t = parse("'left'|'right'");
        assert!(matches!(t.kind, PhpDocTypeKind::Union(_)));
    }

    #[test]
    fn true_false_null_literals() {
        assert!(matches!(kind("true"), PhpDocTypeKind::Literal(ref s) if s == "true"));
        assert!(matches!(kind("false"), PhpDocTypeKind::Literal(ref s) if s == "false"));
        assert!(matches!(kind("null"), PhpDocTypeKind::Literal(ref s) if s == "null"));
    }

    #[test]
    fn conditional_type() {
        let t = parse("(T is string ? non-empty-string : string)");
        assert!(matches!(t.kind, PhpDocTypeKind::Conditional { .. }));
    }

    #[test]
    fn psalm_dollar_conditional() {
        let t = parse("($value is array ? array<string> : string)");
        match t.kind {
            PhpDocTypeKind::Conditional { subject, .. } => {
                assert!(matches!(subject.kind, PhpDocTypeKind::Named(ref n) if n == "$value"));
            }
            _ => panic!("expected Conditional"),
        }
    }

    #[test]
    fn spans_are_populated() {
        let t = parse("int");
        assert_eq!(t.span.start, 0);
        assert_eq!(t.span.end, 3);
    }

    #[test]
    fn base_offset_applied() {
        let t = parse_type_at("int", 10);
        assert_eq!(t.span.start, 10);
        assert_eq!(t.span.end, 13);
    }

    #[test]
    fn callable_variadic_param() {
        let t = parse("callable(int ...$args): void");
        match t.kind {
            PhpDocTypeKind::Callable { params, .. } => {
                assert!(params[0].variadic);
                assert_eq!(params[0].name.as_deref(), Some("$args"));
            }
            _ => panic!("expected Callable"),
        }
    }

    #[test]
    fn array_shape_string_literal_key() {
        let t = parse("array{'key': string}");
        match t.kind {
            PhpDocTypeKind::ArrayShape { fields, .. } => {
                assert_eq!(fields[0].key.as_deref(), Some("'key'"));
            }
            _ => panic!("expected ArrayShape"),
        }
    }
}
