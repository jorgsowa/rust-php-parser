#[cfg(feature = "serde")]
use serde::Serialize;

use crate::Span;

use super::{ArenaVec, Attribute, Block, Comment, Expr, Ident, Name, TypeHint};

/// A named function declaration: `function foo() {}`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct FunctionDecl<'arena, 'src> {
    /// Function name.
    pub name: Ident<'src>,
    /// Declared parameters.
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    /// `true` when the parameter list is missing its `(`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub missing_param_list: bool,
    /// Function body.
    pub body: &'arena Block<'arena, 'src>,
    /// Declared return type, if any.
    pub return_type: Option<TypeHint<'arena, 'src>>,
    /// `true` when by reference (`&`).
    pub by_ref: bool,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// The immediately preceding `/** */` doc-block, if any.
    ///
    /// When present, this comment is **removed** from
    /// `ParseResult::comments` — the
    /// two collections are disjoint. All other comment forms (line, hash,
    /// block) remain in `ParseResult::comments` regardless of position.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> FunctionDecl<'arena, 'src> {
    /// Builds a `FunctionDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        name: Ident<'src>,
        body: &'arena Block<'arena, 'src>,
    ) -> Self {
        Self {
            name,
            params: ArenaVec::new_in(arena),
            missing_param_list: false,
            body,
            return_type: None,
            by_ref: false,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// A function, method, closure or hook parameter.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct Param<'arena, 'src> {
    /// Parameter name without `$`.
    pub name: Ident<'src>,
    /// Declared parameter type.
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    /// Default value expression.
    pub default: Option<Expr<'arena, 'src>>,
    /// `true` when by reference (`&`).
    pub by_ref: bool,
    /// `true` for a variadic parameter (`...$x`).
    pub variadic: bool,
    /// Visibility, `static`, `final`, `abstract` and `readonly` modifiers.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Modifiers::is_empty"))]
    pub modifiers: Modifiers,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Property hooks on a promoted property (PHP 8.4+).
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "ArenaVec::is_empty"))]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    /// `true` for an empty hook list, `{}`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub empty_hook_list: bool,
    /// A doc-block attached directly to this parameter (PHP 8.6 recognizes
    /// this for reflection purposes), either immediately before it or
    /// trailing it up to the comma. Parsed at every version since a bare
    /// comment is legal PHP regardless of target version.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
    /// Source range of this node.
    pub span: Span,
}

impl<'arena, 'src> Param<'arena, 'src> {
    /// A parameter with `name` and `span` set and every other field empty
    /// (`None`, `false`, no attributes or hooks). The fields are public, so set
    /// the rest by assignment; `Param` is `#[non_exhaustive]` and cannot be
    /// built with a struct literal outside this crate.
    pub fn new(arena: &'arena bumpalo::Bump, name: Ident<'src>, span: Span) -> Self {
        Self {
            name,
            type_hint: None,
            default: None,
            by_ref: false,
            variadic: false,
            modifiers: Modifiers::new(),
            attributes: ArenaVec::new_in(arena),
            hooks: ArenaVec::new_in(arena),
            empty_hook_list: false,
            doc_comment: None,
            span,
        }
    }
}

/// The modifiers of a member or promoted parameter. Which flags are valid depends on the node
/// that carries them.
#[derive(Debug, Clone, Copy, Default, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct Modifiers {
    /// Declared visibility, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub visibility: Option<Visibility>,
    /// Asymmetric write visibility, e.g. `private(set)` (PHP 8.4+).
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub set_visibility: Option<Visibility>,
    /// `true` for `static`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub is_static: bool,
    /// `true` for `abstract`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub is_abstract: bool,
    /// `true` for `final`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub is_final: bool,
    /// `true` for `readonly`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub is_readonly: bool,
    /// `true` for a property declared with `var`, whose `visibility` is `Public`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub is_var: bool,
}

impl Modifiers {
    /// No modifiers. The fields are public, so set the ones that apply by assignment;
    /// `Modifiers` is `#[non_exhaustive]` and cannot be built with a struct literal outside
    /// this crate.
    pub const fn new() -> Self {
        Self {
            visibility: None,
            set_visibility: None,
            is_static: false,
            is_abstract: false,
            is_final: false,
            is_readonly: false,
            is_var: false,
        }
    }

    /// Whether no modifier is set.
    pub fn is_empty(&self) -> bool {
        *self == Self::new()
    }
}

/// Member visibility modifier.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum Visibility {
    /// `public` — accessible from anywhere.
    Public,
    /// `protected` — accessible within the class and its subclasses.
    Protected,
    /// `private` — accessible only within the declaring class.
    Private,
}

/// The braced member list of a class-like declaration.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassBody<'arena, 'src> {
    /// Class members in source order.
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    /// Span covering `{` to `}` of the body.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// A class declaration, or the body of an anonymous class.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct ClassDecl<'arena, 'src> {
    /// Class name; `None` for anonymous classes.
    pub name: Option<Ident<'src>>,
    /// `abstract`, `final` and `readonly` modifiers.
    pub modifiers: ClassModifiers,
    /// Parent class.
    pub extends: Option<Name<'arena, 'src>>,
    /// Implemented interfaces.
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    /// Class body, flattened on serialization.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> ClassDecl<'arena, 'src> {
    /// Builds a `ClassDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        name: Option<Ident<'src>>,
        body: ClassBody<'arena, 'src>,
    ) -> Self {
        Self {
            name,
            modifiers: ClassModifiers::default(),
            extends: None,
            implements: ArenaVec::new_in(arena),
            body,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// Modifiers preceding `class`.
#[derive(Debug, Clone, Default)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct ClassModifiers {
    /// `true` for `abstract class`.
    pub is_abstract: bool,
    /// `true` for `final class`.
    pub is_final: bool,
    /// `true` for `readonly class`.
    pub is_readonly: bool,
}

/// A member of a class, interface or trait body.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassMember<'arena, 'src> {
    /// Kind of member.
    pub kind: ClassMemberKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// The kinds of class-like member.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ClassMemberKind<'arena, 'src> {
    /// Property declaration.
    Property(PropertyDecl<'arena, 'src>),
    /// Method declaration.
    Method(MethodDecl<'arena, 'src>),
    /// Class constant declaration.
    ClassConst(ClassConstDecl<'arena, 'src>),
    /// Trait `use` statement.
    TraitUse(TraitUseDecl<'arena, 'src>),
}

/// A property declaration: `public int $x = 0;`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct PropertyDecl<'arena, 'src> {
    /// Property name without `$`.
    pub name: Ident<'src>,
    /// Visibility, `static`, `final`, `abstract` and `readonly` modifiers.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Modifiers::is_empty"))]
    pub modifiers: Modifiers,
    /// Declared type, if any.
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    /// Default value expression.
    pub default: Option<Expr<'arena, 'src>>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Property hooks (PHP 8.4+).
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "ArenaVec::is_empty"))]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    /// `true` for an empty hook list, `{}`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub empty_hook_list: bool,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> PropertyDecl<'arena, 'src> {
    /// Builds a `PropertyDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, name: Ident<'src>) -> Self {
        Self {
            name,
            modifiers: Modifiers::new(),
            type_hint: None,
            default: None,
            attributes: ArenaVec::new_in(arena),
            hooks: ArenaVec::new_in(arena),
            empty_hook_list: false,
            doc_comment: None,
        }
    }
}

/// Which accessor a property hook implements.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum PropertyHookKind {
    /// `get` hook — called when the property is read.
    Get,
    /// `set` hook — called when the property is written; receives the incoming value as `$value`.
    Set,
}

/// The body form of a property hook.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum PropertyHookBody<'arena, 'src> {
    /// `{ stmts }` — a full statement block.
    Block(&'arena Block<'arena, 'src>),
    /// `=> expr` — short-form expression body.
    Expression(Expr<'arena, 'src>),
    /// No body — the hook is declared abstract (on an abstract class or interface).
    Abstract,
}

/// A property hook: `get { ... }` or `set => ...` (PHP 8.4+).
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct PropertyHook<'arena, 'src> {
    /// Whether this is a `get` or `set` hook.
    pub kind: PropertyHookKind,
    /// Hook body.
    pub body: PropertyHookBody<'arena, 'src>,
    /// Visibility, `static`, `final`, `abstract` and `readonly` modifiers.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Modifiers::is_empty"))]
    pub modifiers: Modifiers,
    /// `true` for `&get`.
    pub by_ref: bool,
    /// Explicit parameters, e.g. `set(string $v)`.
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    /// `true` for an empty `()` parameter list, which PHP rejects on both hooks.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub empty_param_list: bool,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// The `get` or `set` keyword. Printer layout detail, outside semver; not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    #[doc(hidden)]
    pub name_span: Span,
    /// Source range of this node.
    pub span: Span,
}

impl<'arena, 'src> PropertyHook<'arena, 'src> {
    /// Builds a `PropertyHook` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        kind: PropertyHookKind,
        body: PropertyHookBody<'arena, 'src>,
        span: Span,
    ) -> Self {
        Self {
            kind,
            body,
            modifiers: Modifiers::new(),
            by_ref: false,
            params: ArenaVec::new_in(arena),
            empty_param_list: false,
            attributes: ArenaVec::new_in(arena),
            name_span: Span::DUMMY,
            span,
        }
    }
}

/// A method declaration inside a class-like body.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct MethodDecl<'arena, 'src> {
    /// Method name.
    pub name: Ident<'src>,
    /// Visibility, `static`, `final`, `abstract` and `readonly` modifiers.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Modifiers::is_empty"))]
    pub modifiers: Modifiers,
    /// `true` when by reference (`&`).
    pub by_ref: bool,
    /// Declared parameters.
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    /// `true` when the parameter list is missing its `(`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
    pub missing_param_list: bool,
    /// Declared return type, if any.
    pub return_type: Option<TypeHint<'arena, 'src>>,
    /// `None` for an abstract/interface method.
    pub body: Option<&'arena Block<'arena, 'src>>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> MethodDecl<'arena, 'src> {
    /// A method with `name` set and every other field empty (no modifiers,
    /// parameters, return type, body or attributes). Set the rest by
    /// assignment; see [`Param::new`].
    pub fn new(arena: &'arena bumpalo::Bump, name: Ident<'src>) -> Self {
        Self {
            name,
            modifiers: Modifiers::new(),
            by_ref: false,
            params: ArenaVec::new_in(arena),
            missing_param_list: false,
            return_type: None,
            body: None,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// A class constant: `const X = 1;`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct ClassConstDecl<'arena, 'src> {
    /// Constant name.
    pub name: Ident<'src>,
    /// Visibility, `static`, `final`, `abstract` and `readonly` modifiers.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Modifiers::is_empty"))]
    pub modifiers: Modifiers,
    /// Typed class constant type (PHP 8.3+).
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub type_hint: Option<&'arena TypeHint<'arena, 'src>>,
    /// Constant value expression.
    pub value: Expr<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> ClassConstDecl<'arena, 'src> {
    /// Builds a `ClassConstDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, name: Ident<'src>, value: Expr<'arena, 'src>) -> Self {
        Self {
            name,
            modifiers: Modifiers::new(),
            type_hint: None,
            value,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// A `use` of traits inside a class-like body.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct TraitUseDecl<'arena, 'src> {
    /// Traits being used.
    pub traits: ArenaVec<'arena, Name<'arena, 'src>>,
    /// `insteadof` and `as` rules from the adaptation block.
    pub adaptations: ArenaVec<'arena, TraitAdaptation<'arena, 'src>>,
    /// The `{` that opens the adaptations block; `None` when there are no
    /// adaptations. Printer layout detail, outside semver; not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    #[doc(hidden)]
    pub adaptations_brace_span: Option<Span>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> TraitUseDecl<'arena, 'src> {
    /// Builds a `TraitUseDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, traits: ArenaVec<'arena, Name<'arena, 'src>>) -> Self {
        Self {
            traits,
            adaptations: ArenaVec::new_in(arena),
            adaptations_brace_span: None,
            doc_comment: None,
        }
    }
}

/// A single rule in a trait `use` adaptation block.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TraitAdaptation<'arena, 'src> {
    /// Kind of adaptation rule.
    pub kind: TraitAdaptationKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// The kinds of trait adaptation rule.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum TraitAdaptationKind<'arena, 'src> {
    /// `A::foo insteadof B, C;`
    Precedence {
        /// Trait qualifying the method, if written.
        trait_name: Name<'arena, 'src>,
        /// Method being adapted.
        method: Name<'arena, 'src>,
        /// Traits whose method is excluded.
        insteadof: ArenaVec<'arena, Name<'arena, 'src>>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        /// Trait qualifying the method, if written.
        trait_name: Option<Name<'arena, 'src>>,
        /// Method being adapted.
        method: Name<'arena, 'src>,
        /// New visibility, if changed.
        new_modifier: Option<Visibility>,
        /// `true` for `foo as final bar;` (PHP 8.3+).
        #[cfg_attr(feature = "serde", serde(skip_serializing_if = "super::is_false"))]
        is_final: bool,
        /// A modifier PHP rejects on an alias: `static`, `abstract` or `readonly`.
        #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
        invalid_modifier: Option<Ident<'src>>,
        /// Alias name, if given.
        new_name: Option<Name<'arena, 'src>>,
    },
}

/// An interface declaration.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct InterfaceDecl<'arena, 'src> {
    /// Interface name.
    pub name: Ident<'src>,
    /// Extended interfaces.
    pub extends: ArenaVec<'arena, Name<'arena, 'src>>,
    /// Interface body, flattened on serialization.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> InterfaceDecl<'arena, 'src> {
    /// Builds a `InterfaceDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        name: Ident<'src>,
        body: ClassBody<'arena, 'src>,
    ) -> Self {
        Self {
            name,
            extends: ArenaVec::new_in(arena),
            body,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// A trait declaration.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct TraitDecl<'arena, 'src> {
    /// Trait name.
    pub name: Ident<'src>,
    /// Trait body, flattened on serialization.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> TraitDecl<'arena, 'src> {
    /// Builds a `TraitDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        name: Ident<'src>,
        body: ClassBody<'arena, 'src>,
    ) -> Self {
        Self {
            name,
            body,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// The braced member list of an enum.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumBody<'arena, 'src> {
    /// Enum members in source order.
    pub members: ArenaVec<'arena, EnumMember<'arena, 'src>>,
    /// Span covering `{` to `}` of the body.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// An enum declaration (PHP 8.1+).
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct EnumDecl<'arena, 'src> {
    /// Enum name.
    pub name: Ident<'src>,
    /// Backing type of a backed enum.
    pub scalar_type: Option<Name<'arena, 'src>>,
    /// A backing type that is not a single name, as in `enum E: ?int`; always an error.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub invalid_scalar_type: Option<TypeHint<'arena, 'src>>,
    /// Implemented interfaces.
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    /// Enum body, flattened on serialization.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: EnumBody<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> EnumDecl<'arena, 'src> {
    /// Builds a `EnumDecl` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        arena: &'arena bumpalo::Bump,
        name: Ident<'src>,
        body: EnumBody<'arena, 'src>,
    ) -> Self {
        Self {
            name,
            scalar_type: None,
            invalid_scalar_type: None,
            implements: ArenaVec::new_in(arena),
            body,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}

/// A member of an enum body.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumMember<'arena, 'src> {
    /// Kind of member.
    pub kind: EnumMemberKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// The kinds of enum member.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum EnumMemberKind<'arena, 'src> {
    /// An enum case: `case Foo;` or `case Foo = 'foo';` (backed enum).
    Case(EnumCase<'arena, 'src>),
    /// A method defined inside the enum body.
    Method(MethodDecl<'arena, 'src>),
    /// A constant defined inside the enum body: `const X = 1;`.
    ClassConst(ClassConstDecl<'arena, 'src>),
    /// A trait use inside the enum body: `use SomeTrait;`.
    TraitUse(TraitUseDecl<'arena, 'src>),
    /// A property, which PHP rejects in enums: `public $x;`.
    Property(PropertyDecl<'arena, 'src>),
}

/// A `case` inside an enum.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct EnumCase<'arena, 'src> {
    /// Case name.
    pub name: Ident<'src>,
    /// Backing value of a backed case.
    pub value: Option<Expr<'arena, 'src>>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Preceding `/** */` doc-block, if any.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment<'src>>,
}

impl<'arena, 'src> EnumCase<'arena, 'src> {
    /// Builds a `EnumCase` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, name: Ident<'src>) -> Self {
        Self {
            name,
            value: None,
            attributes: ArenaVec::new_in(arena),
            doc_comment: None,
        }
    }
}
