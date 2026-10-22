//! Compile-time checks PHP applies to its built-in attributes.

use php_ast::{Attribute, BuiltinType, Span, TypeHint, TypeHintKind};

use crate::diagnostics::ForbiddenRule;
use crate::parser::Parser;
use crate::version::PhpVersion;

#[derive(Clone, Copy, PartialEq, Eq)]
pub(crate) enum AttrTarget {
    Class,
    Function,
    Method,
    Property,
    ClassConst,
    Parameter,
    Const,
}

impl AttrTarget {
    const ALL: [AttrTarget; 7] = [
        AttrTarget::Class,
        AttrTarget::Function,
        AttrTarget::Method,
        AttrTarget::Property,
        AttrTarget::ClassConst,
        AttrTarget::Parameter,
        AttrTarget::Const,
    ];

    fn bit(self) -> u8 {
        1 << (self as u8)
    }

    fn label(self) -> &'static str {
        match self {
            AttrTarget::Class => "class",
            AttrTarget::Function => "function",
            AttrTarget::Method => "method",
            AttrTarget::Property => "property",
            AttrTarget::ClassConst => "class constant",
            AttrTarget::Parameter => "parameter",
            AttrTarget::Const => "constant",
        }
    }
}

/// What the attributed class-like declaration is, for the validators of built-in attributes.
#[derive(Clone, Copy, PartialEq, Eq)]
pub(crate) enum ClassKind {
    Class {
        is_abstract: bool,
        is_readonly: bool,
    },
    Interface,
    Trait,
    Enum,
}

pub(crate) struct AttrSite<'a, 'arena, 'src> {
    target: AttrTarget,
    promoted: bool,
    class: Option<(ClassKind, &'a str)>,
    return_type: Option<&'a TypeHint<'arena, 'src>>,
    method_name: Option<&'a str>,
    is_hook: bool,
    member_of: &'a str,
}

impl<'a, 'arena, 'src> AttrSite<'a, 'arena, 'src> {
    pub(crate) fn new(target: AttrTarget) -> Self {
        Self {
            target,
            promoted: false,
            class: None,
            return_type: None,
            method_name: None,
            is_hook: false,
            member_of: "",
        }
    }

    pub(crate) fn class(kind: ClassKind, name: &'a str) -> Self {
        Self {
            class: Some((kind, name)),
            ..Self::new(AttrTarget::Class)
        }
    }

    pub(crate) fn promoted_param() -> Self {
        Self {
            promoted: true,
            ..Self::new(AttrTarget::Parameter)
        }
    }

    pub(crate) fn hook() -> Self {
        Self {
            is_hook: true,
            ..Self::new(AttrTarget::Method)
        }
    }

    pub(crate) fn with_return_type(
        mut self,
        return_type: Option<&'a TypeHint<'arena, 'src>>,
    ) -> Self {
        self.return_type = return_type;
        self
    }

    /// `class_name` is the enclosing class, as messages name it.
    pub(crate) fn with_method_name(mut self, class_name: &'a str, name: Option<&'a str>) -> Self {
        self.member_of = class_name;
        self.method_name = name;
        self
    }
}

struct InternalAttribute {
    lower_name: &'static str,
    targets: u8,
    since: PhpVersion,
}

impl InternalAttribute {
    fn targets_for(&self, version: PhpVersion) -> u8 {
        let mut targets = self.targets;
        if self.lower_name == "override" {
            if version >= PhpVersion::Php85 {
                targets |= AttrTarget::Property.bit();
            }
            if version >= PhpVersion::Php86 {
                targets |= AttrTarget::ClassConst.bit();
            }
        }
        targets
    }
}

const fn bits(targets: &[AttrTarget]) -> u8 {
    let mut mask = 0;
    let mut i = 0;
    while i < targets.len() {
        mask |= 1 << (targets[i] as u8);
        i += 1;
    }
    mask
}

const ALL_TARGETS: u8 = bits(&AttrTarget::ALL);

const INTERNAL_ATTRIBUTES: [InternalAttribute; 8] = [
    InternalAttribute {
        lower_name: "attribute",
        targets: bits(&[AttrTarget::Class]),
        since: PhpVersion::Php80,
    },
    InternalAttribute {
        lower_name: "returntypewillchange",
        targets: bits(&[AttrTarget::Method]),
        since: PhpVersion::Php81,
    },
    InternalAttribute {
        lower_name: "allowdynamicproperties",
        targets: bits(&[AttrTarget::Class]),
        since: PhpVersion::Php82,
    },
    InternalAttribute {
        lower_name: "sensitiveparameter",
        targets: bits(&[AttrTarget::Parameter]),
        since: PhpVersion::Php82,
    },
    // Properties from 8.5 and class constants from 8.6 are added by `targets_for`.
    InternalAttribute {
        lower_name: "override",
        targets: bits(&[AttrTarget::Method]),
        since: PhpVersion::Php83,
    },
    InternalAttribute {
        lower_name: "deprecated",
        targets: bits(&[
            AttrTarget::Class,
            AttrTarget::Function,
            AttrTarget::Method,
            AttrTarget::ClassConst,
            AttrTarget::Const,
        ]),
        since: PhpVersion::Php84,
    },
    InternalAttribute {
        lower_name: "nodiscard",
        targets: bits(&[AttrTarget::Function, AttrTarget::Method]),
        since: PhpVersion::Php85,
    },
    InternalAttribute {
        lower_name: "delayedtargetvalidation",
        targets: ALL_TARGETS,
        since: PhpVersion::Php85,
    },
];

fn allowed_targets(mask: u8) -> String {
    AttrTarget::ALL
        .iter()
        .filter(|target| mask & target.bit() != 0)
        .map(|target| target.label())
        .collect::<Vec<_>>()
        .join(", ")
}

impl<'arena, 'src> Parser<'arena, 'src> {
    /// Report built-in attributes that target the wrong declaration or are repeated.
    pub(crate) fn check_attributes(
        &mut self,
        attributes: &[Attribute<'arena, 'src>],
        site: &AttrSite<'_, 'arena, 'src>,
    ) {
        if attributes.is_empty() {
            return;
        }
        let resolved: Vec<(String, Option<&'static InternalAttribute>)> = attributes
            .iter()
            .map(|attribute| {
                let name = self.resolve_class_name(&attribute.name);
                let lower = name.to_ascii_lowercase();
                let internal = INTERNAL_ATTRIBUTES
                    .iter()
                    .find(|a| a.lower_name == lower && self.version >= a.since);
                (name, internal)
            })
            .collect();
        let delayed_validation = resolved
            .iter()
            .any(|(_, a)| a.is_some_and(|a| a.lower_name == "delayedtargetvalidation"));
        let site_targets = if site.promoted {
            AttrTarget::Parameter.bit() | AttrTarget::Property.bit()
        } else {
            site.target.bit()
        };

        for (i, (attribute, (name, internal))) in attributes.iter().zip(&resolved).enumerate() {
            let Some(internal) = internal else { continue };
            let span = attribute.span;
            let targets = internal.targets_for(self.version);
            let target_matches = targets & site_targets != 0;
            if !target_matches && !delayed_validation {
                self.forbid(
                    ForbiddenRule::AttributeTargetMismatch,
                    format!(
                        "Attribute \"{name}\" cannot target {} (allowed targets: {})",
                        site.target.label(),
                        allowed_targets(targets)
                    ),
                    span,
                );
            }
            let repeated = resolved[..i]
                .iter()
                .any(|(_, other)| other.is_some_and(|o| o.lower_name == internal.lower_name));
            if repeated {
                self.attribute_error(format!("Attribute \"{name}\" must not be repeated"), span);
            }
            if target_matches {
                self.validate_internal_attribute(
                    internal.lower_name,
                    site,
                    span,
                    delayed_validation,
                );
            }
        }
    }

    fn validate_internal_attribute(
        &mut self,
        lower_name: &str,
        site: &AttrSite<'_, 'arena, 'src>,
        span: Span,
        delayed_validation: bool,
    ) {
        match lower_name {
            "attribute" | "allowdynamicproperties" | "deprecated" => {
                if delayed_validation {
                    return;
                }
                let Some((kind, name)) = site.class else {
                    return;
                };
                // PHP checks the targets of `#[Attribute]` from 8.5 on.
                if lower_name == "attribute" && self.version < PhpVersion::Php85 {
                    return;
                }
                let (attribute, rule) = match lower_name {
                    "attribute" => ("Attribute", ForbiddenRule::AttributeOnInvalidClass),
                    "allowdynamicproperties" => (
                        "AllowDynamicProperties",
                        ForbiddenRule::AllowDynamicPropertiesOnInvalidClass,
                    ),
                    _ => ("Deprecated", ForbiddenRule::DeprecatedOnInvalidTarget),
                };
                let described = match (lower_name, kind) {
                    (_, ClassKind::Interface) => "interface",
                    // PHP 8.2 and 8.3 allow dynamic properties on an enum.
                    ("allowdynamicproperties", ClassKind::Enum)
                        if self.version < PhpVersion::Php84 =>
                    {
                        return;
                    }
                    (_, ClassKind::Enum) => "enum",
                    ("attribute" | "allowdynamicproperties", ClassKind::Trait) => "trait",
                    (
                        "attribute",
                        ClassKind::Class {
                            is_abstract: true, ..
                        },
                    ) => "abstract class",
                    (
                        "allowdynamicproperties",
                        ClassKind::Class {
                            is_readonly: true, ..
                        },
                    ) => "readonly class",
                    ("deprecated", ClassKind::Class { .. }) => "class",
                    _ => return,
                };
                self.forbid(
                    rule,
                    format!("Cannot apply #[\\{attribute}] to {described} {name}"),
                    span,
                );
            }
            "nodiscard" => {
                if site.is_hook {
                    if !delayed_validation {
                        self.attribute_error(
                            "#[\\NoDiscard] is not supported for property hooks".into(),
                            span,
                        );
                    }
                    return;
                }
                if let Some(name) = site.method_name {
                    if name.eq_ignore_ascii_case("__construct") {
                        self.attribute_error(
                            format!("Method {}::{name} cannot be #[\\NoDiscard]", site.member_of),
                            span,
                        );
                        return;
                    }
                }
                let kind = match site.return_type.map(|t| &t.kind) {
                    Some(TypeHintKind::Keyword(BuiltinType::Void, _)) => "void",
                    Some(TypeHintKind::Keyword(BuiltinType::Never, _)) => "never returning",
                    _ => return,
                };
                let callable = if site.target == AttrTarget::Method {
                    "method"
                } else {
                    "function"
                };
                self.attribute_error(
                    format!(
                        "A {kind} {callable} does not return a value, but #[\\NoDiscard] requires a return value"
                    ),
                    span,
                );
            }
            _ => {}
        }
    }

    fn attribute_error(&mut self, message: String, span: Span) {
        self.forbid(ForbiddenRule::Other, message, span);
    }
}
