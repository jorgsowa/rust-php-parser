//! PHPDoc comment parser.
//!
//! Parses `/** ... */` doc-block comments into a structured [`PhpDoc`]
//! representation with summary, description, and typed tags.
//!
//! # Usage
//!
//! ```
//! let text = "/** @param int $x The value */";
//! let doc = php_rs_parser::phpdoc::parse(text);
//! assert_eq!(doc.tags.len(), 1);
//! ```

use std::borrow::Cow;

/// A parsed PHPDoc block (`/** ... */`).
#[derive(Debug)]
pub struct PhpDoc<'src> {
    /// The summary line (first line of text before a blank line or tag).
    pub summary: Option<&'src str>,
    /// The long description (text after the summary, before the first tag).
    pub description: Option<&'src str>,
    /// Parsed tags in source order.
    pub tags: Vec<PhpDocTag<'src>>,
}

/// A single PHPDoc tag (e.g. `@param int $x The value`).
#[derive(Debug)]
pub enum PhpDocTag<'src> {
    /// `@param [type] $name [description]`
    Param {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@return [type] [description]`
    Return {
        type_str: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@var [type] [$name] [description]`
    Var {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@throws [type] [description]`
    Throws {
        type_str: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@deprecated [description]`
    Deprecated { description: Option<Cow<'src, str>> },
    /// `@template T [of bound]`
    Template {
        name: &'src str,
        bound: Option<&'src str>,
    },
    /// `@extends [type]`
    Extends { type_str: &'src str },
    /// `@implements [type]`
    Implements { type_str: &'src str },
    /// `@method [static] [return_type] name(params) [description]`
    Method { signature: &'src str },
    /// `@property [type] $name [description]`
    Property {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@property-read [type] $name [description]`
    PropertyRead {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@property-write [type] $name [description]`
    PropertyWrite {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
        description: Option<Cow<'src, str>>,
    },
    /// `@see [reference] [description]`
    See { reference: &'src str },
    /// `@link [url] [description]`
    Link { url: &'src str },
    /// `@since [version] [description]`
    Since { version: &'src str },
    /// `@author name [<email>]`
    Author { name: &'src str },
    /// `@internal`
    Internal,
    /// `@inheritdoc` / `{@inheritdoc}`
    InheritDoc,
    /// `@psalm-assert`, `@phpstan-assert` — assert that a parameter has a type after the call.
    Assert {
        type_str: Option<&'src str>,
        name: Option<&'src str>,
    },
    /// `@psalm-type`, `@phpstan-type` — local type alias (`@type Foo = int|string`).
    TypeAlias {
        name: Option<&'src str>,
        type_str: Option<&'src str>,
    },
    /// `@psalm-import-type`, `@phpstan-import-type` — import a type alias from another class.
    ImportType { body: &'src str },
    /// `@psalm-suppress`, `@phpstan-ignore-next-line`, `@phpstan-ignore` — suppress diagnostics.
    Suppress { rules: &'src str },
    /// `@psalm-pure`, `@psalm-immutable`, `@psalm-readonly` — purity/immutability markers.
    Pure,
    /// `@psalm-readonly`, `@readonly` — marks a property as read-only.
    Readonly,
    /// `@psalm-immutable` — marks a class as immutable.
    Immutable,
    /// `@mixin [class]` — indicates the class delegates calls to another.
    Mixin { class: &'src str },
    /// `@template-covariant T [of bound]`
    TemplateCovariant {
        name: &'src str,
        bound: Option<&'src str>,
    },
    /// `@template-contravariant T [of bound]`
    TemplateContravariant {
        name: &'src str,
        bound: Option<&'src str>,
    },
    /// Any tag not specifically recognized: `@tagname [body]`
    Generic {
        tag: &'src str,
        body: Option<Cow<'src, str>>,
    },
}

/// Parse a raw doc-comment string into a [`PhpDoc`].
///
/// The input should be the full comment text including `/**` and `*/` delimiters.
/// If the delimiters are missing, the text is parsed as-is.
pub fn parse<'src>(text: &'src str) -> PhpDoc<'src> {
    // Strip /** and */ delimiters
    let inner = strip_delimiters(text);

    // Clean lines: strip leading ` * ` prefixes
    let lines = clean_lines(inner);

    // Split into prose (summary + description) and tags
    let (summary, description, tag_start) = extract_prose(&lines);

    // Parse tags
    let tags = if tag_start < lines.len() {
        parse_tags(&lines[tag_start..])
    } else {
        Vec::new()
    };

    PhpDoc {
        summary,
        description,
        tags,
    }
}

/// Strip `/**` prefix and `*/` suffix, returning the inner content.
fn strip_delimiters(text: &str) -> &str {
    let s = text.strip_prefix("/**").unwrap_or(text);
    let s = s.strip_suffix("*/").unwrap_or(s);
    s
}

/// Represents a cleaned line with its source slice.
struct CleanLine<'src> {
    text: &'src str,
}

/// Clean doc-comment lines by stripping leading `*` decoration.
fn clean_lines(inner: &str) -> Vec<CleanLine<'_>> {
    inner
        .lines()
        .map(|line| {
            let trimmed = line.trim();
            // Strip leading `*` (with optional space after)
            let cleaned = if let Some(rest) = trimmed.strip_prefix("* ") {
                rest
            } else if let Some(rest) = trimmed.strip_prefix('*') {
                rest
            } else {
                trimmed
            };
            CleanLine { text: cleaned }
        })
        .collect()
}

/// Extract summary and description from the prose portion (before any tags).
/// Returns (summary, description, index of first tag line).
fn extract_prose<'src>(lines: &[CleanLine<'src>]) -> (Option<&'src str>, Option<&'src str>, usize) {
    // Find the first tag line
    let tag_start = lines
        .iter()
        .position(|l| l.text.starts_with('@'))
        .unwrap_or(lines.len());

    let prose_lines = &lines[..tag_start];

    // Skip leading empty lines
    let first_non_empty = prose_lines.iter().position(|l| !l.text.is_empty());
    let Some(start) = first_non_empty else {
        return (None, None, tag_start);
    };

    // Find the summary: text up to the first blank line or end of prose
    let blank_after_summary = prose_lines[start..]
        .iter()
        .position(|l| l.text.is_empty())
        .map(|i| i + start);

    let summary_text = prose_lines[start].text;
    let summary = if summary_text.is_empty() {
        None
    } else {
        Some(summary_text)
    };

    // Description: everything after the blank line following summary
    let description = if let Some(blank) = blank_after_summary {
        let desc_start = prose_lines[blank..]
            .iter()
            .position(|l| !l.text.is_empty())
            .map(|i| i + blank);
        if let Some(ds) = desc_start {
            // Find the last non-empty line
            let desc_end = prose_lines
                .iter()
                .rposition(|l| !l.text.is_empty())
                .map(|i| i + 1)
                .unwrap_or(ds);
            if ds < desc_end {
                // Return the first description line as the description
                // (for multi-line, return the first line — consumers typically
                // want summary + first paragraph)
                Some(prose_lines[ds].text)
            } else {
                None
            }
        } else {
            None
        }
    } else {
        None
    };

    (summary, description, tag_start)
}

/// Parse tag lines into PhpDocTag values.
/// Tag blocks can span multiple lines; continuation lines are accumulated into
/// the tag's description/body field.
fn parse_tags<'src>(lines: &[CleanLine<'src>]) -> Vec<PhpDocTag<'src>> {
    let mut tags = Vec::new();
    let mut i = 0;

    while i < lines.len() {
        let line = lines[i].text;
        if !line.starts_with('@') {
            i += 1;
            continue;
        }

        if let Some(mut tag) = parse_single_tag(line) {
            i += 1;
            // Accumulate continuation lines (non-empty lines that don't start a new tag)
            while i < lines.len() && !lines[i].text.starts_with('@') {
                let cont = lines[i].text.trim();
                if !cont.is_empty() {
                    append_to_description(&mut tag, cont);
                }
                i += 1;
            }
            tags.push(tag);
        } else {
            i += 1;
        }
    }

    tags
}

/// Append a continuation line to the description/body field of a tag.
fn append_to_description<'src>(tag: &mut PhpDocTag<'src>, cont: &str) {
    fn append(field: &mut Option<Cow<'_, str>>, cont: &str) {
        match field {
            None => *field = Some(Cow::Owned(cont.to_owned())),
            Some(Cow::Borrowed(s)) => {
                let mut owned = String::with_capacity(s.len() + 1 + cont.len());
                owned.push_str(s);
                owned.push(' ');
                owned.push_str(cont);
                *field = Some(Cow::Owned(owned));
            }
            Some(Cow::Owned(s)) => {
                s.push(' ');
                s.push_str(cont);
            }
        }
    }

    match tag {
        PhpDocTag::Param { description, .. } => append(description, cont),
        PhpDocTag::Return { description, .. } => append(description, cont),
        PhpDocTag::Var { description, .. } => append(description, cont),
        PhpDocTag::Throws { description, .. } => append(description, cont),
        PhpDocTag::Deprecated { description } => append(description, cont),
        PhpDocTag::Property { description, .. } => append(description, cont),
        PhpDocTag::PropertyRead { description, .. } => append(description, cont),
        PhpDocTag::PropertyWrite { description, .. } => append(description, cont),
        PhpDocTag::Generic { body, .. } => append(body, cont),
        // Tags with no prose description field: continuation is silently ignored
        _ => {}
    }
}

/// Parse a single tag line like `@param int $x The value`.
fn parse_single_tag<'src>(line: &'src str) -> Option<PhpDocTag<'src>> {
    let line = line.strip_prefix('@')?;

    // Split tag name from body
    let (tag_name, body) = match line.find(|c: char| c.is_whitespace()) {
        Some(pos) => {
            let body = line[pos..].trim();
            let body = if body.is_empty() { None } else { Some(body) };
            (&line[..pos], body)
        }
        None => (line, None),
    };

    let tag_lower_owned;
    let tag_lower: &str = if tag_name.bytes().all(|b| !b.is_ascii_uppercase()) {
        tag_name
    } else {
        tag_lower_owned = tag_name.to_ascii_lowercase();
        &tag_lower_owned
    };

    // Handle psalm-*/phpstan-* prefixed tags that map to standard tags
    let effective = tag_lower
        .strip_prefix("psalm-")
        .or_else(|| tag_lower.strip_prefix("phpstan-"));

    // Check for tool-specific tags first, then fall through to standard tags
    match tag_lower {
        // Psalm/PHPStan-specific tags (no standard equivalent)
        "psalm-assert"
        | "phpstan-assert"
        | "psalm-assert-if-true"
        | "phpstan-assert-if-true"
        | "psalm-assert-if-false"
        | "phpstan-assert-if-false" => Some(parse_assert_tag(body)),
        "psalm-type" | "phpstan-type" => Some(parse_type_alias_tag(body)),
        "psalm-import-type" | "phpstan-import-type" => Some(PhpDocTag::ImportType {
            body: body.unwrap_or(""),
        }),
        "psalm-suppress" => Some(PhpDocTag::Suppress {
            rules: body.unwrap_or(""),
        }),
        "phpstan-ignore-next-line" | "phpstan-ignore" => Some(PhpDocTag::Suppress {
            rules: body.unwrap_or(""),
        }),
        "psalm-pure" | "pure" => Some(PhpDocTag::Pure),
        "psalm-readonly" | "readonly" => Some(PhpDocTag::Readonly),
        "psalm-immutable" | "immutable" => Some(PhpDocTag::Immutable),
        "mixin" => Some(PhpDocTag::Mixin {
            class: body.unwrap_or(""),
        }),
        "template-covariant" => {
            let tag = parse_template_tag(body);
            match tag {
                PhpDocTag::Template { name, bound } => {
                    Some(PhpDocTag::TemplateCovariant { name, bound })
                }
                _ => Some(tag),
            }
        }
        "template-contravariant" => {
            let tag = parse_template_tag(body);
            match tag {
                PhpDocTag::Template { name, bound } => {
                    Some(PhpDocTag::TemplateContravariant { name, bound })
                }
                _ => Some(tag),
            }
        }
        // Standard tags (also matched via psalm-*/phpstan-* prefix)
        _ => match effective.unwrap_or(tag_lower) {
            "param" => Some(parse_param_tag(body)),
            "return" | "returns" => Some(parse_return_tag(body)),
            "var" => Some(parse_var_tag(body)),
            "throws" | "throw" => Some(parse_throws_tag(body)),
            "deprecated" => Some(PhpDocTag::Deprecated {
                description: body.map(Cow::Borrowed),
            }),
            "template" => Some(parse_template_tag(body)),
            "extends" => Some(PhpDocTag::Extends {
                type_str: body.unwrap_or(""),
            }),
            "implements" => Some(PhpDocTag::Implements {
                type_str: body.unwrap_or(""),
            }),
            "method" => Some(PhpDocTag::Method {
                signature: body.unwrap_or(""),
            }),
            "property" => Some(parse_property_tag(body, PropertyKind::ReadWrite)),
            "property-read" => Some(parse_property_tag(body, PropertyKind::Read)),
            "property-write" => Some(parse_property_tag(body, PropertyKind::Write)),
            "see" => Some(PhpDocTag::See {
                reference: body.unwrap_or(""),
            }),
            "link" => Some(PhpDocTag::Link {
                url: body.unwrap_or(""),
            }),
            "since" => Some(PhpDocTag::Since {
                version: body.unwrap_or(""),
            }),
            "author" => Some(PhpDocTag::Author {
                name: body.unwrap_or(""),
            }),
            "internal" => Some(PhpDocTag::Internal),
            "inheritdoc" => Some(PhpDocTag::InheritDoc),
            _ => Some(PhpDocTag::Generic {
                tag: tag_name,
                body: body.map(Cow::Borrowed),
            }),
        },
    }
}

// =============================================================================
// Tag-specific parsers
// =============================================================================

/// Parse `@param [type] $name [description]`
fn parse_param_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Param {
            type_str: None,
            name: None,
            description: None,
        };
    };

    // If body starts with `$`, there's no type
    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return PhpDocTag::Param {
            type_str: None,
            name: Some(name),
            description: desc.map(Cow::Borrowed),
        };
    }

    // Otherwise: type [$name] [description]
    let (type_str, rest) = split_type(body);
    let rest = rest.map(|r| r.trim_start());

    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            PhpDocTag::Param {
                type_str: Some(type_str),
                name: Some(name),
                description: desc.map(Cow::Borrowed),
            }
        }
        _ => PhpDocTag::Param {
            type_str: Some(type_str),
            name: None,
            description: rest.map(Cow::Borrowed),
        },
    }
}

/// Parse `@return [type] [description]`
fn parse_return_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Return {
            type_str: None,
            description: None,
        };
    };

    let (type_str, desc) = split_type(body);
    PhpDocTag::Return {
        type_str: Some(type_str),
        description: desc.map(|d| Cow::Borrowed(d.trim_start())),
    }
}

/// Parse `@var [type] [$name] [description]`
fn parse_var_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Var {
            type_str: None,
            name: None,
            description: None,
        };
    };

    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return PhpDocTag::Var {
            type_str: None,
            name: Some(name),
            description: desc.map(Cow::Borrowed),
        };
    }

    let (type_str, rest) = split_type(body);
    let rest = rest.map(|r| r.trim_start());

    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            PhpDocTag::Var {
                type_str: Some(type_str),
                name: Some(name),
                description: desc.map(Cow::Borrowed),
            }
        }
        _ => PhpDocTag::Var {
            type_str: Some(type_str),
            name: None,
            description: rest.map(Cow::Borrowed),
        },
    }
}

/// Parse `@throws [type] [description]`
fn parse_throws_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Throws {
            type_str: None,
            description: None,
        };
    };

    let (type_str, desc) = split_type(body);
    PhpDocTag::Throws {
        type_str: Some(type_str),
        description: desc.map(|d| Cow::Borrowed(d.trim_start())),
    }
}

/// Parse `@template T [of Bound]`
fn parse_template_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Template {
            name: "",
            bound: None,
        };
    };

    let (name, rest) = split_first_word(body);
    let bound = rest.and_then(|r| {
        let r = r.trim_start();
        // `of Bound` or `as Bound`
        r.strip_prefix("of ")
            .or_else(|| r.strip_prefix("as "))
            .map(|b| b.trim())
            .or(Some(r))
    });

    PhpDocTag::Template {
        name,
        bound: bound.filter(|b| !b.is_empty()),
    }
}

/// Parse `@psalm-assert Type $name` / `@phpstan-assert Type $name`
fn parse_assert_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::Assert {
            type_str: None,
            name: None,
        };
    };

    if body.starts_with('$') {
        return PhpDocTag::Assert {
            type_str: None,
            name: Some(body.split_whitespace().next().unwrap_or(body)),
        };
    }

    let (type_str, rest) = split_type(body);
    let name = rest.and_then(|r| {
        let r = r.trim_start();
        if r.starts_with('$') {
            Some(r.split_whitespace().next().unwrap_or(r))
        } else {
            None
        }
    });

    PhpDocTag::Assert {
        type_str: Some(type_str),
        name,
    }
}

/// Parse `@psalm-type Name = Type` / `@phpstan-type Name = Type`
fn parse_type_alias_tag<'src>(body: Option<&'src str>) -> PhpDocTag<'src> {
    let Some(body) = body else {
        return PhpDocTag::TypeAlias {
            name: None,
            type_str: None,
        };
    };

    let (name, rest) = split_first_word(body);
    let type_str = rest.and_then(|r| {
        let r = r.trim_start();
        // Strip optional `=`
        let r = r.strip_prefix('=').unwrap_or(r).trim_start();
        if r.is_empty() {
            None
        } else {
            Some(r)
        }
    });

    PhpDocTag::TypeAlias {
        name: Some(name),
        type_str,
    }
}

enum PropertyKind {
    ReadWrite,
    Read,
    Write,
}

/// Parse `@property[-read|-write] [type] $name [description]`
fn parse_property_tag<'src>(body: Option<&'src str>, kind: PropertyKind) -> PhpDocTag<'src> {
    let (type_str, name, description) = parse_type_name_desc(body);

    match kind {
        PropertyKind::ReadWrite => PhpDocTag::Property {
            type_str,
            name,
            description,
        },
        PropertyKind::Read => PhpDocTag::PropertyRead {
            type_str,
            name,
            description,
        },
        PropertyKind::Write => PhpDocTag::PropertyWrite {
            type_str,
            name,
            description,
        },
    }
}

/// Common parser for `[type] $name [description]` pattern.
fn parse_type_name_desc<'src>(
    body: Option<&'src str>,
) -> (Option<&'src str>, Option<&'src str>, Option<Cow<'src, str>>) {
    let Some(body) = body else {
        return (None, None, None);
    };

    if body.starts_with('$') {
        let (name, desc) = split_first_word(body);
        return (None, Some(name), desc.map(Cow::Borrowed));
    }

    let (type_str, rest) = split_type(body);
    let rest = rest.map(|r| r.trim_start());

    match rest {
        Some(r) if r.starts_with('$') => {
            let (name, desc) = split_first_word(r);
            (Some(type_str), Some(name), desc.map(Cow::Borrowed))
        }
        _ => (Some(type_str), None, rest.map(Cow::Borrowed)),
    }
}

// =============================================================================
// Utilities
// =============================================================================

/// Split a string at the first whitespace, returning (word, rest).
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

/// Split a PHPDoc type from the rest of the text.
///
/// PHPDoc types can contain `<`, `>`, `(`, `)`, `{`, `}`, `|`, `&`, `[]`
/// so we track nesting depth to find where the type ends.
fn split_type(s: &str) -> (&str, Option<&str>) {
    let bytes = s.as_bytes();
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
                // Check if this space follows a colon (callable return type notation)
                // e.g. `callable(int): bool` — the space after `:` is within the type
                if i > 0 && bytes[i - 1] == b':' {
                    // Skip this space, continue to include the return type
                    i += 1;
                    continue;
                }
                let rest = s[i..].trim_start();
                let rest = if rest.is_empty() { None } else { Some(rest) };
                return (&s[..i], rest);
            }
            _ => {}
        }
        i += 1;
    }

    (s, None)
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn simple_param() {
        let doc = parse("/** @param int $x The value */");
        assert_eq!(doc.tags.len(), 1);
        match &doc.tags[0] {
            PhpDocTag::Param {
                type_str,
                name,
                description,
            } => {
                assert_eq!(*type_str, Some("int"));
                assert_eq!(*name, Some("$x"));
                assert_eq!(description.as_deref(), Some("The value"));
            }
            _ => panic!("expected Param tag"),
        }
    }

    #[test]
    fn summary_and_tags() {
        let doc = parse(
            "/**
             * Short summary here.
             *
             * Longer description.
             *
             * @param string $name The name
             * @return bool
             */",
        );
        assert_eq!(doc.summary, Some("Short summary here."));
        assert_eq!(doc.description, Some("Longer description."));
        assert_eq!(doc.tags.len(), 2);
    }

    #[test]
    fn generic_type() {
        let doc = parse("/** @param array<string, int> $map */");
        match &doc.tags[0] {
            PhpDocTag::Param { type_str, name, .. } => {
                assert_eq!(*type_str, Some("array<string, int>"));
                assert_eq!(*name, Some("$map"));
            }
            _ => panic!("expected Param tag"),
        }
    }

    #[test]
    fn union_type() {
        let doc = parse("/** @return string|null */");
        match &doc.tags[0] {
            PhpDocTag::Return { type_str, .. } => {
                assert_eq!(*type_str, Some("string|null"));
            }
            _ => panic!("expected Return tag"),
        }
    }

    #[test]
    fn template_tag() {
        let doc = parse("/** @template T of \\Countable */");
        match &doc.tags[0] {
            PhpDocTag::Template { name, bound } => {
                assert_eq!(*name, "T");
                assert_eq!(*bound, Some("\\Countable"));
            }
            _ => panic!("expected Template tag"),
        }
    }

    #[test]
    fn deprecated_tag() {
        let doc = parse("/** @deprecated Use newMethod() instead */");
        match &doc.tags[0] {
            PhpDocTag::Deprecated { description } => {
                assert_eq!(description.as_deref(), Some("Use newMethod() instead"));
            }
            _ => panic!("expected Deprecated tag"),
        }
    }

    #[test]
    fn inheritdoc() {
        let doc = parse("/** @inheritdoc */");
        assert!(matches!(doc.tags[0], PhpDocTag::InheritDoc));
    }

    #[test]
    fn unknown_tag() {
        let doc = parse("/** @custom-tag some body */");
        match &doc.tags[0] {
            PhpDocTag::Generic { tag, body } => {
                assert_eq!(*tag, "custom-tag");
                assert_eq!(body.as_deref(), Some("some body"));
            }
            _ => panic!("expected Generic tag"),
        }
    }

    #[test]
    fn multiple_params() {
        let doc = parse(
            "/**
             * @param int $a First
             * @param string $b Second
             * @param bool $c
             */",
        );
        assert_eq!(doc.tags.len(), 3);
        assert!(matches!(
            &doc.tags[0],
            PhpDocTag::Param {
                name: Some("$a"),
                ..
            }
        ));
        assert!(matches!(
            &doc.tags[1],
            PhpDocTag::Param {
                name: Some("$b"),
                ..
            }
        ));
        assert!(matches!(
            &doc.tags[2],
            PhpDocTag::Param {
                name: Some("$c"),
                ..
            }
        ));
    }

    #[test]
    fn var_tag() {
        let doc = parse("/** @var int $count */");
        match &doc.tags[0] {
            PhpDocTag::Var { type_str, name, .. } => {
                assert_eq!(*type_str, Some("int"));
                assert_eq!(*name, Some("$count"));
            }
            _ => panic!("expected Var tag"),
        }
    }

    #[test]
    fn throws_tag() {
        let doc = parse("/** @throws \\RuntimeException When things go wrong */");
        match &doc.tags[0] {
            PhpDocTag::Throws {
                type_str,
                description,
            } => {
                assert_eq!(*type_str, Some("\\RuntimeException"));
                assert_eq!(description.as_deref(), Some("When things go wrong"));
            }
            _ => panic!("expected Throws tag"),
        }
    }

    #[test]
    fn property_tags() {
        let doc = parse(
            "/**
             * @property string $name
             * @property-read int $id
             * @property-write bool $active
             */",
        );
        assert_eq!(doc.tags.len(), 3);
        assert!(matches!(
            &doc.tags[0],
            PhpDocTag::Property {
                name: Some("$name"),
                ..
            }
        ));
        assert!(matches!(
            &doc.tags[1],
            PhpDocTag::PropertyRead {
                name: Some("$id"),
                ..
            }
        ));
        assert!(matches!(
            &doc.tags[2],
            PhpDocTag::PropertyWrite {
                name: Some("$active"),
                ..
            }
        ));
    }

    #[test]
    fn empty_doc_block() {
        let doc = parse("/** */");
        assert_eq!(doc.summary, None);
        assert_eq!(doc.description, None);
        assert!(doc.tags.is_empty());
    }

    #[test]
    fn summary_only() {
        let doc = parse("/** Does something cool. */");
        assert_eq!(doc.summary, Some("Does something cool."));
        assert_eq!(doc.description, None);
        assert!(doc.tags.is_empty());
    }

    #[test]
    fn callable_type() {
        let doc = parse("/** @param callable(int, string): bool $fn */");
        match &doc.tags[0] {
            PhpDocTag::Param { type_str, name, .. } => {
                assert_eq!(*type_str, Some("callable(int, string): bool"));
                // The `: bool` is part of the callable type notation but our
                // simple split_type stops at the space after `)`. That's fine —
                // the colon syntax `callable(): T` has a space before the return
                // type only in some notations. Let's just verify we got the name.
                assert!(name.is_some());
            }
            _ => panic!("expected Param tag"),
        }
    }

    #[test]
    fn complex_generic_type() {
        let doc = parse("/** @return array<int, list<string>> */");
        match &doc.tags[0] {
            PhpDocTag::Return { type_str, .. } => {
                assert_eq!(*type_str, Some("array<int, list<string>>"));
            }
            _ => panic!("expected Return tag"),
        }
    }

    // =========================================================================
    // Psalm / PHPStan annotations
    // =========================================================================

    #[test]
    fn psalm_param() {
        let doc = parse("/** @psalm-param array<string, int> $map */");
        match &doc.tags[0] {
            PhpDocTag::Param { type_str, name, .. } => {
                assert_eq!(*type_str, Some("array<string, int>"));
                assert_eq!(*name, Some("$map"));
            }
            _ => panic!("expected Param tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn phpstan_return() {
        let doc = parse("/** @phpstan-return list<non-empty-string> */");
        match &doc.tags[0] {
            PhpDocTag::Return { type_str, .. } => {
                assert_eq!(*type_str, Some("list<non-empty-string>"));
            }
            _ => panic!("expected Return tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn psalm_assert() {
        let doc = parse("/** @psalm-assert int $x */");
        match &doc.tags[0] {
            PhpDocTag::Assert { type_str, name } => {
                assert_eq!(*type_str, Some("int"));
                assert_eq!(*name, Some("$x"));
            }
            _ => panic!("expected Assert tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn phpstan_assert() {
        let doc = parse("/** @phpstan-assert non-empty-string $value */");
        match &doc.tags[0] {
            PhpDocTag::Assert { type_str, name } => {
                assert_eq!(*type_str, Some("non-empty-string"));
                assert_eq!(*name, Some("$value"));
            }
            _ => panic!("expected Assert tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn psalm_type_alias() {
        let doc = parse("/** @psalm-type UserId = positive-int */");
        match &doc.tags[0] {
            PhpDocTag::TypeAlias { name, type_str } => {
                assert_eq!(*name, Some("UserId"));
                assert_eq!(*type_str, Some("positive-int"));
            }
            _ => panic!("expected TypeAlias tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn phpstan_type_alias() {
        let doc = parse("/** @phpstan-type Callback = callable(int): void */");
        match &doc.tags[0] {
            PhpDocTag::TypeAlias { name, type_str } => {
                assert_eq!(*name, Some("Callback"));
                assert_eq!(*type_str, Some("callable(int): void"));
            }
            _ => panic!("expected TypeAlias tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn psalm_suppress() {
        let doc = parse("/** @psalm-suppress InvalidReturnType */");
        match &doc.tags[0] {
            PhpDocTag::Suppress { rules } => {
                assert_eq!(*rules, "InvalidReturnType");
            }
            _ => panic!("expected Suppress tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn phpstan_ignore() {
        let doc = parse("/** @phpstan-ignore-next-line */");
        assert!(matches!(&doc.tags[0], PhpDocTag::Suppress { .. }));
    }

    #[test]
    fn psalm_pure() {
        let doc = parse("/** @psalm-pure */");
        assert!(matches!(&doc.tags[0], PhpDocTag::Pure));
    }

    #[test]
    fn psalm_immutable() {
        let doc = parse("/** @psalm-immutable */");
        assert!(matches!(&doc.tags[0], PhpDocTag::Immutable));
    }

    #[test]
    fn mixin_tag() {
        let doc = parse("/** @mixin \\App\\Helpers\\Foo */");
        match &doc.tags[0] {
            PhpDocTag::Mixin { class } => {
                assert_eq!(*class, "\\App\\Helpers\\Foo");
            }
            _ => panic!("expected Mixin tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn template_covariant() {
        let doc = parse("/** @template-covariant T of object */");
        match &doc.tags[0] {
            PhpDocTag::TemplateCovariant { name, bound } => {
                assert_eq!(*name, "T");
                assert_eq!(*bound, Some("object"));
            }
            _ => panic!("expected TemplateCovariant tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn template_contravariant() {
        let doc = parse("/** @template-contravariant T */");
        match &doc.tags[0] {
            PhpDocTag::TemplateContravariant { name, bound } => {
                assert_eq!(*name, "T");
                assert_eq!(*bound, None);
            }
            _ => panic!("expected TemplateContravariant tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn psalm_import_type() {
        let doc = parse("/** @psalm-import-type UserId from UserRepository */");
        match &doc.tags[0] {
            PhpDocTag::ImportType { body } => {
                assert_eq!(*body, "UserId from UserRepository");
            }
            _ => panic!("expected ImportType tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn phpstan_var() {
        let doc = parse("/** @phpstan-var positive-int $count */");
        match &doc.tags[0] {
            PhpDocTag::Var { type_str, name, .. } => {
                assert_eq!(*type_str, Some("positive-int"));
                assert_eq!(*name, Some("$count"));
            }
            _ => panic!("expected Var tag, got {:?}", doc.tags[0]),
        }
    }

    #[test]
    fn mixed_standard_and_psalm_tags() {
        let doc = parse(
            "/**
             * Create a user.
             *
             * @param string $name
             * @psalm-param non-empty-string $name
             * @return User
             * @psalm-assert-if-true User $result
             * @throws \\InvalidArgumentException
             */",
        );
        assert_eq!(doc.summary, Some("Create a user."));
        assert_eq!(doc.tags.len(), 5);
        assert!(matches!(&doc.tags[0], PhpDocTag::Param { .. }));
        assert!(matches!(&doc.tags[1], PhpDocTag::Param { .. }));
        assert!(matches!(&doc.tags[2], PhpDocTag::Return { .. }));
        assert!(matches!(&doc.tags[3], PhpDocTag::Assert { .. }));
        assert!(matches!(&doc.tags[4], PhpDocTag::Throws { .. }));
    }
}
