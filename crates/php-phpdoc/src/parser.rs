//! Top-level PHPDoc comment parser.
//!
//! Parses `/** ... */` doc-block comments into a structured [`PhpDoc`]
//! representation with summary, description, and typed tags. All spans are
//! comment-relative (0 = start of `/**`).

use php_ast::Span;

use crate::ast::{MethodParam, PhpDoc, PhpDocTag, PhpDocTagKind, PhpDocType, PhpDocTypeKind};
use crate::type_parser::parse_type_at;

// =============================================================================
// Public entry point
// =============================================================================

/// Parse a raw doc-comment string into a [`PhpDoc`].
///
/// The input may include `/**` and `*/` delimiters or be stripped already.
pub fn parse(text: &str) -> PhpDoc {
    let span = Span::new(0, text.len() as u32);
    let (inner, content_start) = strip_delimiters(text);
    let lines = clean_lines(inner, content_start);
    let (summary, description, tag_start) = extract_prose(&lines);
    let tags = if tag_start < lines.len() {
        parse_tags(&lines[tag_start..])
    } else {
        Vec::new()
    };
    PhpDoc {
        summary,
        description,
        tags,
        span,
    }
}

// =============================================================================
// Internal types
// =============================================================================

/// A cleaned line with its byte offset in the original comment string.
struct CleanLine {
    /// Line text with leading `* ` decoration stripped (owned).
    text: String,
    /// Byte offset of `text[0]` within the original comment string.
    base_offset: u32,
}

// =============================================================================
// Delimiter stripping
// =============================================================================

/// Strip `/**` prefix and `*/` suffix.
/// Returns `(inner, content_start)` where `content_start` is the byte offset
/// of `inner[0]` within `text`.
fn strip_delimiters(text: &str) -> (&str, u32) {
    let (s, start) = if let Some(rest) = text.strip_prefix("/**") {
        (rest, 3u32)
    } else if let Some(rest) = text.strip_prefix("/*") {
        (rest, 2u32)
    } else {
        (text, 0u32)
    };
    let s = s.strip_suffix("*/").unwrap_or(s);
    (s, start)
}

// =============================================================================
// Line cleaning
// =============================================================================

/// Clean doc-comment lines by stripping leading `* ` decoration, tracking
/// the byte offset of each cleaned line within the original comment.
fn clean_lines(inner: &str, content_start: u32) -> Vec<CleanLine> {
    let mut lines = Vec::new();
    let mut offset_in_inner: u32 = 0;

    for raw_line in inner.split('\n') {
        let line_abs_start = content_start + offset_in_inner;

        // Track the offset as we strip characters from the start of raw_line
        let mut stripped_bytes: u32 = 0;
        let bytes = raw_line.as_bytes();

        // Strip leading whitespace
        let ws_count = bytes
            .iter()
            .take_while(|&&b| b == b' ' || b == b'\t')
            .count();
        stripped_bytes += ws_count as u32;
        let after_ws = &raw_line[ws_count..];

        // Strip `* ` or bare `*`
        let (cleaned, extra_stripped) = if let Some(rest) = after_ws.strip_prefix("* ") {
            (rest, 2u32)
        } else if let Some(rest) = after_ws.strip_prefix('*') {
            (rest, 1u32)
        } else {
            (after_ws, 0u32)
        };
        stripped_bytes += extra_stripped;

        lines.push(CleanLine {
            text: cleaned.to_owned(),
            base_offset: line_abs_start + stripped_bytes,
        });

        // +1 for the '\n' that split consumed
        offset_in_inner += raw_line.len() as u32 + 1;
    }

    lines
}

// =============================================================================
// Prose extraction (summary + description)
// =============================================================================

/// Extract summary and description from the prose portion (before any tags).
/// Returns `(summary, description, index_of_first_tag_line)`.
fn extract_prose(lines: &[CleanLine]) -> (Option<String>, Option<String>, usize) {
    // Find the first tag line
    let tag_start = lines
        .iter()
        .position(|l| l.text.trim_start().starts_with('@'))
        .unwrap_or(lines.len());

    let prose_lines = &lines[..tag_start];

    // Skip leading empty lines
    let Some(start) = prose_lines.iter().position(|l| !l.text.trim().is_empty()) else {
        return (None, None, tag_start);
    };

    // Summary: text up to the first blank line in prose
    let blank_after_summary = prose_lines[start..]
        .iter()
        .position(|l| l.text.trim().is_empty())
        .map(|i| i + start);

    let summary = {
        let s = prose_lines[start].text.trim();
        if s.is_empty() {
            None
        } else {
            Some(s.to_owned())
        }
    };

    // Description: everything after the blank line following summary
    let description = if let Some(blank) = blank_after_summary {
        let desc_start = prose_lines[blank..]
            .iter()
            .position(|l| !l.text.trim().is_empty())
            .map(|i| i + blank);

        if let Some(ds) = desc_start {
            let desc_end = prose_lines
                .iter()
                .rposition(|l| !l.text.trim().is_empty())
                .map(|i| i + 1)
                .unwrap_or(ds);

            let text: String = prose_lines[ds..desc_end]
                .iter()
                .map(|l| l.text.trim())
                .collect::<Vec<_>>()
                .join("\n");

            if text.is_empty() {
                None
            } else {
                Some(text)
            }
        } else {
            None
        }
    } else {
        None
    };

    (summary, description, tag_start)
}

// =============================================================================
// Tag parsing
// =============================================================================

fn parse_tags(lines: &[CleanLine]) -> Vec<PhpDocTag> {
    let mut tags = Vec::new();
    let mut i = 0;

    while i < lines.len() {
        let line_text = lines[i].text.trim_start();
        if !line_text.starts_with('@') {
            i += 1;
            continue;
        }

        let tag_start_offset = lines[i].base_offset;

        // Accumulate this tag line plus continuation lines
        let mut tag_lines: Vec<&CleanLine> = vec![&lines[i]];
        i += 1;
        while i < lines.len() && !lines[i].text.trim_start().starts_with('@') {
            tag_lines.push(&lines[i]);
            i += 1;
        }

        let last = tag_lines.last().unwrap();
        let tag_end_offset = last.base_offset + last.text.len() as u32;
        let tag_span = Span::new(tag_start_offset, tag_end_offset);

        if let Some(kind) = parse_single_tag(&tag_lines) {
            tags.push(PhpDocTag {
                kind,
                span: tag_span,
            });
        }
    }

    tags
}

/// Parse the `@tag ...` text from a group of cleaned lines into a `PhpDocTagKind`.
fn parse_single_tag(lines: &[&CleanLine]) -> Option<PhpDocTagKind> {
    let first = lines[0].text.trim_start();
    let first = first.strip_prefix('@')?;

    // Split tag name from body
    let (tag_name, body_on_first_line) = match first.find(|c: char| c.is_whitespace()) {
        Some(pos) => {
            let body = first[pos..].trim();
            (
                &first[..pos],
                if body.is_empty() { None } else { Some(body) },
            )
        }
        None => (first, None),
    };

    // Accumulate multi-line body: first line body + continuation lines joined with space
    let continuation: String = lines[1..]
        .iter()
        .map(|l| l.text.trim())
        .filter(|s| !s.is_empty())
        .collect::<Vec<_>>()
        .join(" ");

    let full_body: Option<String> = match (body_on_first_line, continuation.as_str()) {
        (None, "") => None,
        (Some(b), "") => Some(b.to_owned()),
        (None, c) => Some(c.to_owned()),
        (Some(b), c) => Some(format!("{b} {c}")),
    };

    // Base offset of the body text on the first line (for type span computation)
    let body_base_offset = lines[0].base_offset
        + 1 // '@'
        + tag_name.len() as u32
        + body_on_first_line
            .map(|_| {
                // bytes between end of tag_name and start of body
                let after_tag = &lines[0].text.trim_start()["@".len() + tag_name.len()..];
                let ws = after_tag.len() - after_tag.trim_start().len();
                ws as u32
            })
            .unwrap_or(0);

    let tag_lower_owned;
    let tag_lower: &str = if tag_name.bytes().all(|b| !b.is_ascii_uppercase()) {
        tag_name
    } else {
        tag_lower_owned = tag_name.to_ascii_lowercase();
        &tag_lower_owned
    };

    // Strip psalm-*/phpstan-* prefix to get an effective tag name
    let effective = tag_lower
        .strip_prefix("psalm-")
        .or_else(|| tag_lower.strip_prefix("phpstan-"));

    match tag_lower {
        // Tool-specific tags with no standard equivalent
        "psalm-assert"
        | "phpstan-assert"
        | "psalm-assert-if-true"
        | "phpstan-assert-if-true"
        | "psalm-assert-if-false"
        | "phpstan-assert-if-false" => {
            Some(parse_assert_tag(full_body.as_deref(), body_base_offset))
        }

        "psalm-type" | "phpstan-type" => {
            Some(parse_type_alias_tag(full_body.as_deref(), body_base_offset))
        }

        "psalm-import-type" | "phpstan-import-type" => Some(PhpDocTagKind::ImportType {
            body: full_body.unwrap_or_default(),
        }),

        "psalm-suppress" => Some(PhpDocTagKind::Suppress {
            rules: full_body.unwrap_or_default(),
        }),

        "phpstan-ignore-next-line" | "phpstan-ignore" => Some(PhpDocTagKind::Suppress {
            rules: full_body.unwrap_or_default(),
        }),

        "psalm-pure" | "pure" => Some(PhpDocTagKind::Pure),
        "psalm-readonly" | "readonly" => Some(PhpDocTagKind::Readonly),
        "psalm-immutable" | "immutable" => Some(PhpDocTagKind::Immutable),

        "mixin" => Some(PhpDocTagKind::Mixin {
            class: full_body.unwrap_or_default(),
        }),

        "template-covariant" => {
            let (name, bound) = parse_template_body(full_body.as_deref(), body_base_offset);
            Some(PhpDocTagKind::TemplateCovariant { name, bound })
        }

        "template-contravariant" => {
            let (name, bound) = parse_template_body(full_body.as_deref(), body_base_offset);
            Some(PhpDocTagKind::TemplateContravariant { name, bound })
        }

        _ => match effective.unwrap_or(tag_lower) {
            "param" => Some(parse_param_tag(full_body.as_deref(), body_base_offset)),
            "return" | "returns" => Some(parse_return_tag(full_body.as_deref(), body_base_offset)),
            "var" => Some(parse_var_tag(full_body.as_deref(), body_base_offset)),
            "throws" | "throw" => Some(parse_throws_tag(full_body.as_deref(), body_base_offset)),
            "deprecated" => Some(PhpDocTagKind::Deprecated {
                description: full_body,
            }),
            "template" => {
                let (name, bound) = parse_template_body(full_body.as_deref(), body_base_offset);
                Some(PhpDocTagKind::Template { name, bound })
            }
            "extends" => {
                let ty = parse_type_from_body(full_body.as_deref(), body_base_offset)
                    .unwrap_or_else(|| unknown_type(""));
                Some(PhpDocTagKind::Extends { ty })
            }
            "implements" => {
                let ty = parse_type_from_body(full_body.as_deref(), body_base_offset)
                    .unwrap_or_else(|| unknown_type(""));
                Some(PhpDocTagKind::Implements { ty })
            }
            "method" => Some(parse_method_tag(full_body.as_deref(), body_base_offset)),
            "property" => {
                let (ty, name, description) =
                    parse_type_name_desc(full_body.as_deref(), body_base_offset);
                Some(PhpDocTagKind::Property {
                    ty,
                    name,
                    description,
                })
            }
            "property-read" => {
                let (ty, name, description) =
                    parse_type_name_desc(full_body.as_deref(), body_base_offset);
                Some(PhpDocTagKind::PropertyRead {
                    ty,
                    name,
                    description,
                })
            }
            "property-write" => {
                let (ty, name, description) =
                    parse_type_name_desc(full_body.as_deref(), body_base_offset);
                Some(PhpDocTagKind::PropertyWrite {
                    ty,
                    name,
                    description,
                })
            }
            "see" => Some(PhpDocTagKind::See {
                reference: full_body.unwrap_or_default(),
            }),
            "link" => Some(PhpDocTagKind::Link {
                url: full_body.unwrap_or_default(),
            }),
            "since" => Some(PhpDocTagKind::Since {
                version: full_body.unwrap_or_default(),
            }),
            "author" => Some(PhpDocTagKind::Author {
                name: full_body.unwrap_or_default(),
            }),
            "internal" => Some(PhpDocTagKind::Internal),
            "inheritdoc" => Some(PhpDocTagKind::InheritDoc),

            _ => Some(PhpDocTagKind::Generic {
                tag: tag_name.to_owned(),
                body: full_body,
            }),
        },
    }
}

// =============================================================================
// Type splitting
// =============================================================================

/// Find the end of a PHPDoc type expression in `body`, tracking nesting depth.
/// Returns `(type_str, rest_after_type)`.
fn split_type(body: &str) -> (&str, Option<&str>) {
    let bytes = body.as_bytes();
    let mut depth = 0i32;
    let mut i = 0;

    while i < bytes.len() {
        match bytes[i] {
            b'<' | b'(' | b'{' => depth += 1,
            b'>' | b')' | b'}' => {
                depth -= 1;
                if depth < 0 {
                    depth = 0;
                }
            }
            b' ' | b'\t' if depth == 0 => {
                // Space after `:` inside callable return type: `callable(): bool`
                if i > 0 && bytes[i - 1] == b':' {
                    i += 1;
                    continue;
                }
                let rest = body[i..].trim_start();
                let rest = if rest.is_empty() { None } else { Some(rest) };
                return (&body[..i], rest);
            }
            _ => {}
        }
        i += 1;
    }

    (body, None)
}

/// Parse a type from the start of `body`, returning `(PhpDocType, rest_str, type_end_in_body)`.
fn split_and_parse_type(body: &str, body_base: u32) -> (PhpDocType, Option<&str>, u32) {
    let (type_str, rest) = split_type(body);
    let ty = parse_type_at(type_str.trim(), body_base);
    let consumed = body.len() - rest.map_or(0, |r| r.len());
    (ty, rest, consumed as u32)
}

fn parse_type_from_body(body: Option<&str>, base: u32) -> Option<PhpDocType> {
    let body = body?.trim();
    if body.is_empty() {
        return None;
    }
    let (type_str, _) = split_type(body);
    Some(parse_type_at(type_str.trim(), base))
}

fn unknown_type(s: &str) -> PhpDocType {
    PhpDocType {
        kind: PhpDocTypeKind::Unknown(s.to_owned()),
        span: Span::new(0, 0),
    }
}

// =============================================================================
// Tag-specific parsers
// =============================================================================

fn parse_param_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::Param {
            ty: None,
            name: None,
            description: None,
        };
    };
    let body = body.trim_start();

    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return PhpDocTagKind::Param {
            ty: None,
            name: Some(name.to_owned()),
            description: desc.map(str::to_owned),
        };
    }

    let (ty, rest, _) = split_and_parse_type(body, base);
    let rest = rest.map(str::trim_start);

    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            PhpDocTagKind::Param {
                ty: Some(ty),
                name: Some(name.to_owned()),
                description: desc.map(str::to_owned),
            }
        }
        _ => PhpDocTagKind::Param {
            ty: Some(ty),
            name: None,
            description: rest.map(str::to_owned),
        },
    }
}

fn parse_return_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::Return {
            ty: None,
            description: None,
        };
    };
    let (ty, rest, _) = split_and_parse_type(body.trim_start(), base);
    PhpDocTagKind::Return {
        ty: Some(ty),
        description: rest.map(|r| r.trim_start().to_owned()),
    }
}

fn parse_var_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::Var {
            ty: None,
            name: None,
            description: None,
        };
    };
    let body = body.trim_start();

    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return PhpDocTagKind::Var {
            ty: None,
            name: Some(name.to_owned()),
            description: desc.map(str::to_owned),
        };
    }

    let (ty, rest, _) = split_and_parse_type(body, base);
    let rest = rest.map(str::trim_start);

    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            PhpDocTagKind::Var {
                ty: Some(ty),
                name: Some(name.to_owned()),
                description: desc.map(str::to_owned),
            }
        }
        _ => PhpDocTagKind::Var {
            ty: Some(ty),
            name: None,
            description: rest.map(str::to_owned),
        },
    }
}

fn parse_throws_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::Throws {
            ty: None,
            description: None,
        };
    };
    let (ty, rest, _) = split_and_parse_type(body.trim_start(), base);
    PhpDocTagKind::Throws {
        ty: Some(ty),
        description: rest.map(|r| r.trim_start().to_owned()),
    }
}

fn parse_template_body(body: Option<&str>, base: u32) -> (String, Option<PhpDocType>) {
    let Some(body) = body else {
        return (String::new(), None);
    };
    let (name, rest) = split_first_word(body.trim_start());
    let bound = rest.and_then(|r| {
        let r = r.trim_start();
        // `of Bound` or `as Bound`
        let r = r
            .strip_prefix("of ")
            .or_else(|| r.strip_prefix("as "))
            .unwrap_or(r);
        let r = r.trim();
        if r.is_empty() {
            None
        } else {
            Some(r)
        }
    });
    let bound_ty = bound.map(|b| {
        // Approximate offset: skip name + whitespace + "of "
        let approx_base = base + name.len() as u32 + 4;
        parse_type_at(b, approx_base)
    });
    (name.to_owned(), bound_ty)
}

fn parse_assert_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::Assert {
            ty: None,
            name: None,
        };
    };
    let body = body.trim_start();

    if body.starts_with('$') {
        let name = body.split_whitespace().next().unwrap_or(body);
        return PhpDocTagKind::Assert {
            ty: None,
            name: Some(name.to_owned()),
        };
    }

    let (ty, rest, _) = split_and_parse_type(body, base);
    let name = rest.and_then(|r| {
        let r = r.trim_start();
        if r.starts_with('$') {
            Some(r.split_whitespace().next().unwrap_or(r).to_owned())
        } else {
            None
        }
    });
    PhpDocTagKind::Assert { ty: Some(ty), name }
}

fn parse_type_alias_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let Some(body) = body else {
        return PhpDocTagKind::TypeAlias {
            name: None,
            ty: None,
        };
    };
    let (name, rest) = split_first_word(body.trim_start());
    let ty_str = rest.and_then(|r| {
        let r = r.trim_start().strip_prefix('=').unwrap_or(r).trim_start();
        if r.is_empty() {
            None
        } else {
            Some(r)
        }
    });
    let ty = ty_str.map(|s| {
        let approx_base = base + name.len() as u32 + 3;
        parse_type_at(s, approx_base)
    });
    PhpDocTagKind::TypeAlias {
        name: Some(name.to_owned()),
        ty,
    }
}

fn parse_type_name_desc(
    body: Option<&str>,
    base: u32,
) -> (Option<PhpDocType>, Option<String>, Option<String>) {
    let Some(body) = body else {
        return (None, None, None);
    };
    let body = body.trim_start();

    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return (None, Some(name.to_owned()), desc.map(str::to_owned));
    }

    let (ty, rest, _) = split_and_parse_type(body, base);
    let rest = rest.map(str::trim_start);
    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            (Some(ty), Some(name.to_owned()), desc.map(str::to_owned))
        }
        _ => (Some(ty), None, rest.map(str::to_owned)),
    }
}

// =============================================================================
// @method tag parser
// =============================================================================

fn parse_method_tag(body: Option<&str>, base: u32) -> PhpDocTagKind {
    let body = body.unwrap_or("").trim_start();
    let mut cursor = body;
    let mut offset = base;

    // `static` keyword
    let is_static = if cursor.starts_with("static") {
        let after = cursor["static".len()..].trim_start();
        let next = cursor.as_bytes().get("static".len()).copied();
        if next.map(|b| b.is_ascii_whitespace()).unwrap_or(true) {
            offset += (cursor.len() - after.len()) as u32;
            cursor = after;
            true
        } else {
            false
        }
    } else {
        false
    };

    // Find the top-level `(` that starts the parameter list.
    // Everything before it is "[return_type] method_name".
    let paren_pos = find_top_level_paren(cursor);
    let before_paren = paren_pos.map(|p| cursor[..p].trim_end()).unwrap_or(cursor);
    let after_paren = paren_pos.map(|p| &cursor[p..]).unwrap_or("");

    // Split "method_name" from optional "return_type" using the last whitespace in before_paren.
    let (return_type, method_name) = match before_paren.rfind(|c: char| c.is_whitespace()) {
        Some(ws_pos) => {
            let ret_str = before_paren[..ws_pos].trim();
            let name_str = before_paren[ws_pos..].trim();
            let ret_ty = if ret_str.is_empty() {
                None
            } else {
                Some(parse_type_at(ret_str, offset))
            };
            (ret_ty, name_str.to_owned())
        }
        None => (None, before_paren.to_owned()),
    };

    // Parse `(params)` and optional description
    let (params, description) = if let Some(after_open) = after_paren.strip_prefix('(') {
        let close = find_matching_paren(after_open);
        let params_str = &after_open[..close];
        let after_close = after_open[close..].trim_start_matches(')').trim_start();
        let description = if after_close.is_empty() {
            None
        } else {
            Some(after_close.to_owned())
        };
        let params_base = offset + paren_pos.unwrap_or(0) as u32 + 1;
        (parse_method_params(params_str, params_base), description)
    } else {
        (Vec::new(), None)
    };

    PhpDocTagKind::Method {
        is_static,
        return_type,
        name: method_name,
        params,
        description,
    }
}

/// Find the index of the first `(` at nesting depth 0 (ignoring `<>` and `{}`).
fn find_top_level_paren(s: &str) -> Option<usize> {
    let bytes = s.as_bytes();
    let mut depth = 0i32;
    for (i, &b) in bytes.iter().enumerate() {
        match b {
            b'<' | b'{' => depth += 1,
            b'>' | b'}' => depth -= 1,
            b'(' if depth == 0 => return Some(i),
            _ => {}
        }
    }
    None
}

/// Find the index of the matching `)` for the opening `(` already consumed.
fn find_matching_paren(s: &str) -> usize {
    let bytes = s.as_bytes();
    let mut depth = 0i32;
    let mut i = 0;
    while i < bytes.len() {
        match bytes[i] {
            b'(' | b'<' | b'{' => depth += 1,
            b')' if depth == 0 => return i,
            b')' | b'>' | b'}' => depth -= 1,
            _ => {}
        }
        i += 1;
    }
    s.len()
}

fn parse_method_params(params_str: &str, base: u32) -> Vec<MethodParam> {
    let mut params = Vec::new();
    let mut offset: u32 = 0;

    for raw in params_str.split(',') {
        let trimmed = raw.trim();
        if trimmed.is_empty() {
            offset += raw.len() as u32 + 1;
            continue;
        }

        let param_start = base + offset;
        offset += raw.len() as u32 + 1;

        let mut s = trimmed;

        let by_ref = if s.starts_with('&') {
            s = s[1..].trim_start();
            true
        } else {
            false
        };

        let variadic = if s.starts_with("...") {
            s = s[3..].trim_start();
            true
        } else {
            false
        };

        // Try to parse type then $name, or just $name
        let (ty, name, default) = if s.starts_with('$') {
            let (name_str, rest) = split_first_word(s);
            let default = rest.and_then(|r| {
                let r = r.trim_start();
                r.strip_prefix('=').map(|d| d.trim().to_owned())
            });
            (None, name_str.to_owned(), default)
        } else {
            let (type_str, rest) = split_type(s);
            let ty = parse_type_at(type_str.trim(), param_start);
            let rest = rest.map(str::trim_start).unwrap_or("");

            if rest.starts_with('$') {
                let (name_str, rest2) = split_first_word(rest);
                let default = rest2.and_then(|r| {
                    let r = r.trim_start();
                    r.strip_prefix('=').map(|d| d.trim().to_owned())
                });
                (Some(ty), name_str.to_owned(), default)
            } else {
                (Some(ty), rest.to_owned(), None)
            }
        };

        let param_end = base + offset;
        params.push(MethodParam {
            ty,
            name,
            by_ref,
            variadic,
            default,
            span: Span::new(param_start, param_end),
        });
    }

    params
}

// =============================================================================
// Utilities
// =============================================================================

fn split_first_word(s: &str) -> (&str, Option<&str>) {
    match s.find(|c: char| c.is_whitespace()) {
        Some(pos) => {
            let rest = s[pos..].trim_start();
            let rest = if rest.is_empty() { None } else { Some(rest) };
            (&s[..pos], rest)
        }
        None => (s, None),
    }
}

// =============================================================================
// Tests
// =============================================================================

#[cfg(test)]
mod tests {
    use super::*;
    use crate::ast::PhpDocTagKind;

    fn parse_doc(text: &str) -> PhpDoc {
        parse(text)
    }

    #[test]
    fn simple_param() {
        let doc = parse_doc("/** @param int $x The value */");
        assert_eq!(doc.tags.len(), 1);
        match &doc.tags[0].kind {
            PhpDocTagKind::Param {
                ty,
                name,
                description,
            } => {
                assert!(ty.is_some());
                assert_eq!(name.as_deref(), Some("$x"));
                assert_eq!(description.as_deref(), Some("The value"));
            }
            _ => panic!("expected Param"),
        }
    }

    #[test]
    fn summary_and_tags() {
        let doc = parse_doc(
            "/**
             * Short summary here.
             *
             * Longer description.
             *
             * @param string $name The name
             * @return bool
             */",
        );
        assert_eq!(doc.summary.as_deref(), Some("Short summary here."));
        assert_eq!(doc.description.as_deref(), Some("Longer description."));
        assert_eq!(doc.tags.len(), 2);
    }

    #[test]
    fn multiline_description_full() {
        let doc = parse_doc(
            "/**
             * Summary line.
             *
             * First paragraph.
             * Second line of first paragraph.
             *
             * @param int $x
             */",
        );
        let desc = doc.description.as_deref().unwrap_or("");
        assert!(desc.contains("First paragraph."), "got: {desc}");
        assert!(desc.contains("Second line"), "got: {desc}");
    }

    #[test]
    fn generic_type_in_param() {
        let doc = parse_doc("/** @param array<string, int> $map */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Param { ty, name, .. } => {
                assert!(ty.is_some());
                assert_eq!(name.as_deref(), Some("$map"));
            }
            _ => panic!("expected Param"),
        }
    }

    #[test]
    fn return_tag() {
        let doc = parse_doc("/** @return string|null */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Return { ty, .. } => assert!(ty.is_some()),
            _ => panic!("expected Return"),
        }
    }

    #[test]
    fn template_with_bound() {
        let doc = parse_doc("/** @template T of \\Countable */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Template { name, bound } => {
                assert_eq!(name, "T");
                assert!(bound.is_some());
            }
            _ => panic!("expected Template"),
        }
    }

    #[test]
    fn deprecated_tag() {
        let doc = parse_doc("/** @deprecated Use newMethod() instead */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Deprecated { description } => {
                assert_eq!(description.as_deref(), Some("Use newMethod() instead"));
            }
            _ => panic!("expected Deprecated"),
        }
    }

    #[test]
    fn psalm_suppress() {
        let doc = parse_doc("/** @psalm-suppress InvalidReturnType */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Suppress { rules } => assert_eq!(rules, "InvalidReturnType"),
            _ => panic!("expected Suppress"),
        }
    }

    #[test]
    fn phpstan_ignore() {
        let doc = parse_doc("/** @phpstan-ignore-next-line */");
        assert!(matches!(doc.tags[0].kind, PhpDocTagKind::Suppress { .. }));
    }

    #[test]
    fn psalm_pure() {
        let doc = parse_doc("/** @psalm-pure */");
        assert!(matches!(doc.tags[0].kind, PhpDocTagKind::Pure));
    }

    #[test]
    fn var_tag_with_name() {
        let doc = parse_doc("/** @var int $count */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Var { ty, name, .. } => {
                assert!(ty.is_some());
                assert_eq!(name.as_deref(), Some("$count"));
            }
            _ => panic!("expected Var"),
        }
    }

    #[test]
    fn throws_tag() {
        let doc = parse_doc("/** @throws \\RuntimeException When things go wrong */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Throws { ty, description } => {
                assert!(ty.is_some());
                assert_eq!(description.as_deref(), Some("When things go wrong"));
            }
            _ => panic!("expected Throws"),
        }
    }

    #[test]
    fn method_static_with_return() {
        let doc =
            parse_doc("/** @method static User create(string $name, int $age) Create a user */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Method {
                is_static,
                return_type,
                name,
                params,
                description,
            } => {
                assert!(is_static);
                assert!(return_type.is_some());
                assert_eq!(name, "create");
                assert_eq!(params.len(), 2);
                assert!(description.is_some());
            }
            _ => panic!("expected Method"),
        }
    }

    #[test]
    fn method_no_return_type() {
        let doc = parse_doc("/** @method foo() */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Method {
                is_static,
                return_type,
                name,
                ..
            } => {
                assert!(!is_static);
                assert!(return_type.is_none());
                assert_eq!(name, "foo");
            }
            _ => panic!("expected Method"),
        }
    }

    #[test]
    fn span_populated() {
        let doc = parse_doc("/** @param int $x */");
        assert!(doc.tags[0].span.start > 0);
    }

    #[test]
    fn multiline_param_description() {
        let doc = parse_doc(
            "/**
             * @param int $x First line
             *               second line
             */",
        );
        match &doc.tags[0].kind {
            PhpDocTagKind::Param { description, .. } => {
                let desc = description.as_deref().unwrap_or("");
                assert!(desc.contains("First line"), "got: {desc}");
            }
            _ => panic!("expected Param"),
        }
    }

    #[test]
    fn psalm_type_alias() {
        let doc = parse_doc("/** @psalm-type UserId = positive-int */");
        match &doc.tags[0].kind {
            PhpDocTagKind::TypeAlias { name, ty } => {
                assert_eq!(name.as_deref(), Some("UserId"));
                assert!(ty.is_some());
            }
            _ => panic!("expected TypeAlias"),
        }
    }

    #[test]
    fn generic_tag() {
        let doc = parse_doc("/** @custom-tag some body */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Generic { tag, body } => {
                assert_eq!(tag, "custom-tag");
                assert_eq!(body.as_deref(), Some("some body"));
            }
            _ => panic!("expected Generic"),
        }
    }

    #[test]
    fn property_tags() {
        let doc = parse_doc(
            "/**
             * @property string $name
             * @property-read int $id
             * @property-write bool $active
             */",
        );
        assert_eq!(doc.tags.len(), 3);
        assert!(matches!(&doc.tags[0].kind, PhpDocTagKind::Property { .. }));
        assert!(matches!(
            &doc.tags[1].kind,
            PhpDocTagKind::PropertyRead { .. }
        ));
        assert!(matches!(
            &doc.tags[2].kind,
            PhpDocTagKind::PropertyWrite { .. }
        ));
    }

    #[test]
    fn empty_doc_block() {
        let doc = parse_doc("/** */");
        assert!(doc.summary.is_none());
        assert!(doc.tags.is_empty());
    }

    #[test]
    fn summary_only() {
        let doc = parse_doc("/** Does something cool. */");
        assert_eq!(doc.summary.as_deref(), Some("Does something cool."));
        assert!(doc.tags.is_empty());
    }

    #[test]
    fn callable_type_in_param() {
        let doc = parse_doc("/** @param callable(int, string): bool $fn */");
        match &doc.tags[0].kind {
            PhpDocTagKind::Param { ty, name, .. } => {
                assert!(ty.is_some());
                assert!(name.is_some());
            }
            _ => panic!("expected Param"),
        }
    }
}
