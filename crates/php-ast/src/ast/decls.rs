use serde::Serialize;

use crate::Span;

use super::{ArenaVec, Attribute, Comment, Expr, Name, Stmt, TypeHint};

#[derive(Debug, Serialize)]
pub struct FunctionDecl<'arena, 'src> {
    pub name: &'src str,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub by_ref: bool,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct Param<'arena, 'src> {
    pub name: &'src str,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub by_ref: bool,
    pub variadic: bool,
    pub is_readonly: bool,
    pub is_final: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum Visibility {
    /// `public` — accessible from anywhere.
    Public,
    /// `protected` — accessible within the class and its subclasses.
    Protected,
    /// `private` — accessible only within the declaring class.
    Private,
}

#[derive(Debug, Serialize)]
pub struct ClassDecl<'arena, 'src> {
    pub name: Option<&'src str>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Clone, Serialize, Default)]
pub struct ClassModifiers {
    pub is_abstract: bool,
    pub is_final: bool,
    pub is_readonly: bool,
}

#[derive(Debug, Serialize)]
pub struct ClassMember<'arena, 'src> {
    pub kind: ClassMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum ClassMemberKind<'arena, 'src> {
    Property(PropertyDecl<'arena, 'src>),
    Method(MethodDecl<'arena, 'src>),
    ClassConst(ClassConstDecl<'arena, 'src>),
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct PropertyDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum PropertyHookKind {
    /// `get` hook — called when the property is read.
    Get,
    /// `set` hook — called when the property is written; receives the incoming value as `$value`.
    Set,
}

#[derive(Debug, Serialize)]
pub enum PropertyHookBody<'arena, 'src> {
    /// `{ stmts }` — a full statement block.
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),
    /// `=> expr` — short-form expression body.
    Expression(Expr<'arena, 'src>),
    /// No body — the hook is declared abstract (on an abstract class or interface).
    Abstract,
}

#[derive(Debug, Serialize)]
pub struct PropertyHook<'arena, 'src> {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody<'arena, 'src>,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct MethodDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct ClassConstDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub is_final: bool,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<&'arena TypeHint<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitUseDecl<'arena, 'src> {
    pub traits: ArenaVec<'arena, Name<'arena, 'src>>,
    pub adaptations: ArenaVec<'arena, TraitAdaptation<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitAdaptation<'arena, 'src> {
    pub kind: TraitAdaptationKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum TraitAdaptationKind<'arena, 'src> {
    /// `A::foo insteadof B, C;`
    Precedence {
        trait_name: Name<'arena, 'src>,
        method: Name<'arena, 'src>,
        insteadof: ArenaVec<'arena, Name<'arena, 'src>>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        trait_name: Option<Name<'arena, 'src>>,
        method: Name<'arena, 'src>,
        new_modifier: Option<Visibility>,
        new_name: Option<Name<'arena, 'src>>,
    },
}

#[derive(Debug, Serialize)]
pub struct InterfaceDecl<'arena, 'src> {
    pub name: &'src str,
    pub extends: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitDecl<'arena, 'src> {
    pub name: &'src str,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumDecl<'arena, 'src> {
    pub name: &'src str,
    pub scalar_type: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, EnumMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumMember<'arena, 'src> {
    pub kind: EnumMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum EnumMemberKind<'arena, 'src> {
    /// An enum case: `case Foo;` or `case Foo = 'foo';` (backed enum).
    Case(EnumCase<'arena, 'src>),
    /// A method defined inside the enum body.
    Method(MethodDecl<'arena, 'src>),
    /// A constant defined inside the enum body: `const X = 1;`.
    ClassConst(ClassConstDecl<'arena, 'src>),
    /// A trait use inside the enum body: `use SomeTrait;`.
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct EnumCase<'arena, 'src> {
    pub name: &'src str,
    pub value: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}
