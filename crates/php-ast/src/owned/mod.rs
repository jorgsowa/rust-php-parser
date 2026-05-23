//! Owned (lifetime-free) versions of all AST types.
//!
//! Arena-allocated types (`Program<'arena, 'src>`, etc.) cannot be stored in a
//! struct alongside the `bumpalo::Bump` arena that owns them — the borrow checker
//! rejects the self-referential pattern. These owned mirrors solve that: they use
//! `Box<str>` instead of `&str`, `Box<[T]>` instead of `ArenaVec<'arena, T>`, and
//! `Box<T>` instead of `&'arena T`. The result is `'static` — no lifetime
//! parameters, storeable in a `HashMap`, sendable across threads.
//!
//! Serialization is byte-for-byte identical to the arena types so existing JSON
//! snapshots remain valid.
//!
//! # Entry points
//!
//! Call [`php_rs_parser::parse()`] — it returns a [`php_rs_parser::ParseResult`]
//! whose `.program` field is an owned [`Program`]. To convert an
//! arena-allocated [`Program`](crate::ast::Program) directly, use
//! [`to_owned_program`].

pub mod fold;
pub mod visitor;

pub use fold::{
    fold_owned_arg, fold_owned_attribute, fold_owned_catch_clause, fold_owned_class_member,
    fold_owned_closure_use_var, fold_owned_enum_member, fold_owned_expr, fold_owned_match_arm,
    fold_owned_name, fold_owned_param, fold_owned_program, fold_owned_property_hook,
    fold_owned_stmt, fold_owned_type_hint, FoldOwned,
};
pub use visitor::{
    walk_owned_arg, walk_owned_attribute, walk_owned_catch_clause, walk_owned_class_member,
    walk_owned_comments, walk_owned_enum_member, walk_owned_expr, walk_owned_match_arm,
    walk_owned_name, walk_owned_param, walk_owned_program, walk_owned_property_hook,
    walk_owned_stmt, walk_owned_trait_use, walk_owned_type_hint, OwnedScope, OwnedScopeVisitor,
    OwnedScopeWalker, OwnedVisitor,
};

use serde::Serialize;

use crate::ast as arena_ast;
use crate::ast::{
    AssignOp, BinaryOp, BuiltinType, CastKind, ClassModifiers, CommentKind, IncludeKind,
    MagicConstKind, NameKind, PropertyHookKind, UnaryPostfixOp, UnaryPrefixOp, UseKind, Visibility,
};
use crate::Span;

// ---------------------------------------------------------------------------
// Serde helpers
// ---------------------------------------------------------------------------

fn is_false(b: &bool) -> bool {
    !*b
}

fn slice_is_empty<T>(v: &[T]) -> bool {
    v.is_empty()
}

// ---------------------------------------------------------------------------
// Ident
//
// `Ident<'src>` serialises as `null` for the error state (empty string) and as
// a JSON string for real names. `Option<Box<str>>` produces identical output:
// `None` → null, `Some(s)` → "s". We use a type alias to keep field types
// readable.
// ---------------------------------------------------------------------------

/// Owned equivalent of [`Ident`](crate::ast::Ident).
/// `None` represents the error state (no identifier was parsed).
pub type Ident = Option<Box<str>>;

// ---------------------------------------------------------------------------
// Name
//
// `Name<'arena, 'src>` has three variants (Simple, Complex, Error) and a
// custom Serialize that always emits `{"parts":[...],"kind":"...","span":{…}}`.
// The owned version flattens them into a single struct and derives Serialize —
// the JSON output is identical.
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Name {
    pub parts: Box<[Box<str>]>,
    pub kind: NameKind,
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Comment
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Comment {
    pub kind: CommentKind,
    pub text: Box<str>,
    pub span: Span,
}

// ---------------------------------------------------------------------------
// TypeHint / TypeHintKind
//
// `TypeHintKind::Keyword` has a custom Serialize that emits the same JSON as
// `Named`. We replicate that here.
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct TypeHint {
    pub kind: TypeHintKind,
    pub span: Span,
}

#[derive(Debug, Clone)]
pub enum TypeHintKind {
    Named(Name),
    /// Serialises as `Named` — see [`TypeHintKind::Keyword`](crate::ast::TypeHintKind::Keyword).
    Keyword(BuiltinType, Span),
    Nullable(Box<TypeHint>),
    Union(Box<[TypeHint]>),
    Intersection(Box<[TypeHint]>),
}

impl Serialize for TypeHintKind {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        match self {
            Self::Named(name) => s.serialize_newtype_variant("TypeHintKind", 0, "Named", name),
            Self::Nullable(inner) => {
                s.serialize_newtype_variant("TypeHintKind", 2, "Nullable", inner)
            }
            Self::Union(types) => s.serialize_newtype_variant("TypeHintKind", 3, "Union", types),
            Self::Intersection(types) => {
                s.serialize_newtype_variant("TypeHintKind", 4, "Intersection", types)
            }
            Self::Keyword(builtin, span) => {
                struct BuiltinNameRepr<'a>(&'a BuiltinType, &'a Span);
                impl Serialize for BuiltinNameRepr<'_> {
                    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
                        use serde::ser::SerializeStruct;
                        let mut st = s.serialize_struct("Name", 3)?;
                        st.serialize_field("parts", &[self.0.as_str()])?;
                        st.serialize_field("kind", &NameKind::Unqualified)?;
                        st.serialize_field("span", self.1)?;
                        st.end()
                    }
                }
                s.serialize_newtype_variant(
                    "TypeHintKind",
                    0,
                    "Named",
                    &BuiltinNameRepr(builtin, span),
                )
            }
        }
    }
}

// ---------------------------------------------------------------------------
// Arg / Attribute
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Arg {
    pub name: Option<Name>,
    pub value: Expr,
    pub unpack: bool,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct Attribute {
    pub name: Name,
    pub args: Box<[Arg]>,
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Program
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Program {
    pub stmts: Box<[Stmt]>,
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Stmt / StmtKind
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Stmt {
    pub kind: StmtKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum StmtKind {
    Expression(Box<Expr>),
    Echo(Box<[Expr]>),
    Return(Option<Box<Expr>>),
    Block(Box<[Stmt]>),
    If(Box<IfStmt>),
    While(Box<WhileStmt>),
    For(Box<ForStmt>),
    Foreach(Box<ForeachStmt>),
    DoWhile(Box<DoWhileStmt>),
    Function(Box<FunctionDecl>),
    Break(Option<Box<Expr>>),
    Continue(Option<Box<Expr>>),
    Switch(Box<SwitchStmt>),
    Goto(Ident),
    Label(Box<str>),
    Declare(Box<DeclareStmt>),
    Unset(Box<[Expr]>),
    Throw(Box<Expr>),
    TryCatch(Box<TryCatchStmt>),
    Global(Box<[Expr]>),
    Class(Box<ClassDecl>),
    Interface(Box<InterfaceDecl>),
    Trait(Box<TraitDecl>),
    Enum(Box<EnumDecl>),
    Namespace(Box<NamespaceDecl>),
    Use(Box<UseDecl>),
    Const(Box<[ConstItem]>),
    StaticVar(Box<[StaticVar]>),
    HaltCompiler(Box<str>),
    Nop,
    InlineHtml(Box<str>),
    Error,
}

#[derive(Debug, Clone, Serialize)]
pub struct IfStmt {
    pub condition: Expr,
    pub then_branch: Box<Stmt>,
    pub elseif_branches: Box<[ElseIfBranch]>,
    pub else_branch: Option<Box<Stmt>>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct ElseIfBranch {
    pub condition: Expr,
    pub body: Stmt,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct WhileStmt {
    pub condition: Expr,
    pub body: Box<Stmt>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForStmt {
    pub init: Box<[Expr]>,
    pub condition: Box<[Expr]>,
    pub update: Box<[Expr]>,
    pub body: Box<Stmt>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForeachStmt {
    pub expr: Expr,
    pub key: Option<Expr>,
    pub value: Expr,
    pub body: Box<Stmt>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct DoWhileStmt {
    pub body: Box<Stmt>,
    pub condition: Expr,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchStmt {
    pub expr: Expr,
    pub cases: Box<[SwitchCase]>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchCase {
    pub value: Option<Expr>,
    pub body: Box<[Stmt]>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct TryCatchStmt {
    pub body: Box<[Stmt]>,
    pub catches: Box<[CatchClause]>,
    pub finally: Option<Box<[Stmt]>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct CatchClause {
    pub types: Box<[Name]>,
    pub var: Option<Box<str>>,
    pub body: Box<[Stmt]>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct NamespaceDecl {
    pub name: Option<Name>,
    pub body: NamespaceBody,
}

#[derive(Debug, Clone, Serialize)]
pub enum NamespaceBody {
    Braced(Box<[Stmt]>),
    Simple,
}

#[derive(Debug, Clone, Serialize)]
pub struct DeclareStmt {
    pub directives: Box<[(Box<str>, Expr)]>,
    pub body: Option<Box<Stmt>>,
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseDecl {
    pub kind: UseKind,
    pub uses: Box<[UseItem]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseItem {
    pub name: Name,
    pub alias: Option<Box<str>>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ConstItem {
    pub name: Ident,
    pub value: Expr,
    pub attributes: Box<[Attribute]>,
    pub span: Span,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticVar {
    pub name: Ident,
    pub default: Option<Expr>,
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Expr / ExprKind
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct Expr {
    pub kind: ExprKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ExprKind {
    Int(i64),
    Float(f64),
    String(Box<str>),
    InterpolatedString(Box<[StringPart]>),
    Heredoc {
        label: Box<str>,
        parts: Box<[StringPart]>,
    },
    Nowdoc {
        label: Box<str>,
        value: Box<str>,
    },
    ShellExec(Box<[StringPart]>),
    Bool(bool),
    Null,
    Variable(Box<str>),
    VariableVariable(Box<Expr>),
    Identifier(Box<str>),
    Assign(AssignExpr),
    Binary(BinaryExpr),
    UnaryPrefix(UnaryPrefixExpr),
    UnaryPostfix(UnaryPostfixExpr),
    Ternary(TernaryExpr),
    NullCoalesce(NullCoalesceExpr),
    FunctionCall(FunctionCallExpr),
    Array(Box<[ArrayElement]>),
    ArrayAccess(ArrayAccessExpr),
    Print(Box<Expr>),
    Parenthesized(Box<Expr>),
    Cast(CastKind, Box<Expr>),
    ErrorSuppress(Box<Expr>),
    Isset(Box<[Expr]>),
    Empty(Box<Expr>),
    Include(IncludeKind, Box<Expr>),
    Eval(Box<Expr>),
    Exit(Option<Box<Expr>>),
    MagicConst(MagicConstKind),
    Clone(Box<Expr>),
    CloneWith(Box<Expr>, Box<Expr>),
    New(NewExpr),
    PropertyAccess(PropertyAccessExpr),
    NullsafePropertyAccess(PropertyAccessExpr),
    MethodCall(Box<MethodCallExpr>),
    NullsafeMethodCall(Box<MethodCallExpr>),
    StaticPropertyAccess(StaticAccessExpr),
    StaticMethodCall(Box<StaticMethodCallExpr>),
    StaticDynMethodCall(Box<StaticDynMethodCallExpr>),
    ClassConstAccess(StaticAccessExpr),
    ClassConstAccessDynamic {
        class: Box<Expr>,
        member: Box<Expr>,
    },
    StaticPropertyAccessDynamic {
        class: Box<Expr>,
        member: Box<Expr>,
    },
    Closure(Box<ClosureExpr>),
    ArrowFunction(Box<ArrowFunctionExpr>),
    Match(MatchExpr),
    ThrowExpr(Box<Expr>),
    Yield(YieldExpr),
    AnonymousClass(Box<ClassDecl>),
    CallableCreate(CallableCreateExpr),
    Omit,
    Error,
}

#[derive(Debug, Clone, Serialize)]
pub struct AssignExpr {
    pub target: Box<Expr>,
    pub op: AssignOp,
    pub value: Box<Expr>,
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct BinaryExpr {
    pub left: Box<Expr>,
    pub op: BinaryOp,
    pub right: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct UnaryPrefixExpr {
    pub op: UnaryPrefixOp,
    pub operand: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct UnaryPostfixExpr {
    pub operand: Box<Expr>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Serialize)]
pub struct TernaryExpr {
    pub condition: Box<Expr>,
    pub then_expr: Option<Box<Expr>>,
    pub else_expr: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct NullCoalesceExpr {
    pub left: Box<Expr>,
    pub right: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct FunctionCallExpr {
    pub name: Box<Expr>,
    pub args: Box<[Arg]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayElement {
    pub key: Option<Expr>,
    pub value: Expr,
    pub unpack: bool,
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayAccessExpr {
    pub array: Box<Expr>,
    pub index: Option<Box<Expr>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct NewExpr {
    pub class: Box<Expr>,
    pub args: Box<[Arg]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyAccessExpr {
    pub object: Box<Expr>,
    pub property: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodCallExpr {
    pub object: Box<Expr>,
    pub method: Box<Expr>,
    pub args: Box<[Arg]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticAccessExpr {
    pub class: Box<Expr>,
    pub member: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticMethodCallExpr {
    pub class: Box<Expr>,
    pub method: Box<Expr>,
    pub args: Box<[Arg]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticDynMethodCallExpr {
    pub class: Box<Expr>,
    pub method: Box<Expr>,
    pub args: Box<[Arg]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureExpr {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Box<[Param]>,
    pub use_vars: Box<[ClosureUseVar]>,
    pub return_type: Option<TypeHint>,
    pub body: Box<[Stmt]>,
    pub attributes: Box<[Attribute]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureUseVar {
    pub name: Box<str>,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrowFunctionExpr {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Box<[Param]>,
    pub return_type: Option<TypeHint>,
    pub body: Box<Expr>,
    pub attributes: Box<[Attribute]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchExpr {
    pub subject: Box<Expr>,
    pub arms: Box<[MatchArm]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchArm {
    pub conditions: Option<Box<[Expr]>>,
    pub body: Expr,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct YieldExpr {
    pub key: Option<Box<Expr>>,
    pub value: Option<Box<Expr>>,
    pub is_from: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct CallableCreateExpr {
    pub kind: CallableCreateKind,
}

#[derive(Debug, Clone, Serialize)]
pub enum CallableCreateKind {
    Function(Box<Expr>),
    Method {
        object: Box<Expr>,
        method: Box<Expr>,
    },
    NullsafeMethod {
        object: Box<Expr>,
        method: Box<Expr>,
    },
    StaticMethod {
        class: Box<Expr>,
        method: Box<Expr>,
    },
}

#[derive(Debug, Clone, Serialize)]
pub enum StringPart {
    Literal(Box<str>),
    Expr(Expr),
}

// ---------------------------------------------------------------------------
// Owned declaration types
// ---------------------------------------------------------------------------

#[derive(Debug, Clone, Serialize)]
pub struct FunctionDecl {
    pub name: Ident,
    pub params: Box<[Param]>,
    pub body: Box<[Stmt]>,
    pub return_type: Option<TypeHint>,
    pub by_ref: bool,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct Param {
    pub name: Ident,
    pub type_hint: Option<TypeHint>,
    pub default: Option<Expr>,
    pub by_ref: bool,
    pub variadic: bool,
    pub is_readonly: bool,
    pub is_final: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "slice_is_empty")]
    pub hooks: Box<[PropertyHook]>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassDecl {
    pub name: Option<Ident>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name>,
    pub implements: Box<[Name]>,
    pub members: Box<[ClassMember]>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassMember {
    pub kind: ClassMemberKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ClassMemberKind {
    Property(PropertyDecl),
    Method(MethodDecl),
    ClassConst(ClassConstDecl),
    TraitUse(TraitUseDecl),
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyDecl {
    pub name: Ident,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint>,
    pub default: Option<Expr>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "slice_is_empty")]
    pub hooks: Box<[PropertyHook]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyHook {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Box<[Param]>,
    pub attributes: Box<[Attribute]>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum PropertyHookBody {
    Block(Box<[Stmt]>),
    Expression(Expr),
    Abstract,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodDecl {
    pub name: Ident,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Box<[Param]>,
    pub return_type: Option<TypeHint>,
    pub body: Option<Box<[Stmt]>>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassConstDecl {
    pub name: Ident,
    pub visibility: Option<Visibility>,
    pub is_final: bool,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<Box<TypeHint>>,
    pub value: Expr,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitUseDecl {
    pub traits: Box<[Name]>,
    pub adaptations: Box<[TraitAdaptation]>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitAdaptation {
    pub kind: TraitAdaptationKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum TraitAdaptationKind {
    Precedence {
        trait_name: Name,
        method: Name,
        insteadof: Box<[Name]>,
    },
    Alias {
        trait_name: Option<Name>,
        method: Name,
        new_modifier: Option<Visibility>,
        new_name: Option<Name>,
    },
}

#[derive(Debug, Clone, Serialize)]
pub struct InterfaceDecl {
    pub name: Ident,
    pub extends: Box<[Name]>,
    pub members: Box<[ClassMember]>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitDecl {
    pub name: Ident,
    pub members: Box<[ClassMember]>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumDecl {
    pub name: Ident,
    pub scalar_type: Option<Name>,
    pub implements: Box<[Name]>,
    pub members: Box<[EnumMember]>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumMember {
    pub kind: EnumMemberKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum EnumMemberKind {
    Case(EnumCase),
    Method(MethodDecl),
    ClassConst(ClassConstDecl),
    TraitUse(TraitUseDecl),
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumCase {
    pub name: Ident,
    pub value: Option<Expr>,
    pub attributes: Box<[Attribute]>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment>,
}

// ===========================================================================
// Conversion functions
// ===========================================================================

fn owned_ident(ident: arena_ast::Ident<'_>) -> Ident {
    ident.as_str().map(|s| s.into())
}

fn owned_name(name: &arena_ast::Name<'_, '_>) -> Name {
    match name {
        arena_ast::Name::Simple { value, span } => Name {
            parts: vec![Box::from(*value)].into_boxed_slice(),
            kind: NameKind::Unqualified,
            span: *span,
        },
        arena_ast::Name::Complex { parts, kind, span } => Name {
            parts: parts
                .iter()
                .map(|s| Box::from(*s))
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            kind: *kind,
            span: *span,
        },
        arena_ast::Name::Error { span } => Name {
            parts: Box::from([]),
            kind: NameKind::Error,
            span: *span,
        },
    }
}

fn owned_comment(c: &arena_ast::Comment<'_>) -> Comment {
    Comment {
        kind: c.kind,
        text: c.text.into(),
        span: c.span,
    }
}

fn owned_opt_comment(c: &Option<arena_ast::Comment<'_>>) -> Option<Comment> {
    c.as_ref().map(owned_comment)
}

fn owned_type_hint(th: &arena_ast::TypeHint<'_, '_>) -> TypeHint {
    TypeHint {
        kind: owned_type_hint_kind(&th.kind),
        span: th.span,
    }
}

fn owned_type_hint_kind(k: &arena_ast::TypeHintKind<'_, '_>) -> TypeHintKind {
    match k {
        arena_ast::TypeHintKind::Named(n) => TypeHintKind::Named(owned_name(n)),
        arena_ast::TypeHintKind::Keyword(b, span) => TypeHintKind::Keyword(*b, *span),
        arena_ast::TypeHintKind::Nullable(inner) => {
            TypeHintKind::Nullable(Box::new(owned_type_hint(inner)))
        }
        arena_ast::TypeHintKind::Union(types) => TypeHintKind::Union(
            types
                .iter()
                .map(owned_type_hint)
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        ),
        arena_ast::TypeHintKind::Intersection(types) => TypeHintKind::Intersection(
            types
                .iter()
                .map(owned_type_hint)
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        ),
    }
}

fn owned_arg(arg: &arena_ast::Arg<'_, '_>) -> Arg {
    Arg {
        name: arg.name.as_ref().map(owned_name),
        value: owned_expr(&arg.value),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

fn owned_args(args: &[arena_ast::Arg<'_, '_>]) -> Box<[Arg]> {
    args.iter()
        .map(owned_arg)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_attr(attr: &arena_ast::Attribute<'_, '_>) -> Attribute {
    Attribute {
        name: owned_name(&attr.name),
        args: owned_args(&attr.args),
        span: attr.span,
    }
}

fn owned_attrs(attrs: &[arena_ast::Attribute<'_, '_>]) -> Box<[Attribute]> {
    attrs
        .iter()
        .map(owned_attr)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_string_parts(parts: &[arena_ast::StringPart<'_, '_>]) -> Box<[StringPart]> {
    parts
        .iter()
        .map(|p| match p {
            arena_ast::StringPart::Literal(s) => StringPart::Literal(Box::from(*s)),
            arena_ast::StringPart::Expr(e) => StringPart::Expr(owned_expr(e)),
        })
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

/// Convert an arena-allocated [`Expr`](crate::ast::Expr) into an [`Expr`].
pub fn to_owned_expr(expr: &arena_ast::Expr<'_, '_>) -> Expr {
    owned_expr(expr)
}

/// Convert an arena-allocated [`Name`](crate::ast::Name) into a [`Name`].
pub fn to_owned_name(name: &arena_ast::Name<'_, '_>) -> Name {
    owned_name(name)
}

/// Convert an arena-allocated [`TypeHint`](crate::ast::TypeHint) into a [`TypeHint`].
pub fn to_owned_type_hint(hint: &arena_ast::TypeHint<'_, '_>) -> TypeHint {
    owned_type_hint(hint)
}

fn owned_expr(expr: &arena_ast::Expr<'_, '_>) -> Expr {
    Expr {
        kind: owned_expr_kind(&expr.kind),
        span: expr.span,
    }
}

fn owned_exprs(exprs: &[arena_ast::Expr<'_, '_>]) -> Box<[Expr]> {
    exprs
        .iter()
        .map(owned_expr)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_expr_kind(k: &arena_ast::ExprKind<'_, '_>) -> ExprKind {
    match k {
        arena_ast::ExprKind::Int(v) => ExprKind::Int(*v),
        arena_ast::ExprKind::Float(v) => ExprKind::Float(*v),
        arena_ast::ExprKind::String(s) => ExprKind::String(Box::from(*s)),
        arena_ast::ExprKind::InterpolatedString(parts) => {
            ExprKind::InterpolatedString(owned_string_parts(parts))
        }
        arena_ast::ExprKind::Heredoc { label, parts } => ExprKind::Heredoc {
            label: Box::from(*label),
            parts: owned_string_parts(parts),
        },
        arena_ast::ExprKind::Nowdoc { label, value } => ExprKind::Nowdoc {
            label: Box::from(*label),
            value: Box::from(*value),
        },
        arena_ast::ExprKind::ShellExec(parts) => ExprKind::ShellExec(owned_string_parts(parts)),
        arena_ast::ExprKind::Bool(v) => ExprKind::Bool(*v),
        arena_ast::ExprKind::Null => ExprKind::Null,
        arena_ast::ExprKind::Variable(s) => ExprKind::Variable(s.as_str().into()),
        arena_ast::ExprKind::VariableVariable(inner) => {
            ExprKind::VariableVariable(Box::new(owned_expr(inner)))
        }
        arena_ast::ExprKind::Identifier(s) => ExprKind::Identifier(s.as_str().into()),
        arena_ast::ExprKind::Assign(a) => ExprKind::Assign(AssignExpr {
            target: Box::new(owned_expr(a.target)),
            op: a.op,
            value: Box::new(owned_expr(a.value)),
            by_ref: a.by_ref,
        }),
        arena_ast::ExprKind::Binary(b) => ExprKind::Binary(BinaryExpr {
            left: Box::new(owned_expr(b.left)),
            op: b.op,
            right: Box::new(owned_expr(b.right)),
        }),
        arena_ast::ExprKind::UnaryPrefix(u) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: u.op,
            operand: Box::new(owned_expr(u.operand)),
        }),
        arena_ast::ExprKind::UnaryPostfix(u) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            operand: Box::new(owned_expr(u.operand)),
            op: u.op,
        }),
        arena_ast::ExprKind::Ternary(t) => ExprKind::Ternary(TernaryExpr {
            condition: Box::new(owned_expr(t.condition)),
            then_expr: t.then_expr.map(|e| Box::new(owned_expr(e))),
            else_expr: Box::new(owned_expr(t.else_expr)),
        }),
        arena_ast::ExprKind::NullCoalesce(n) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: Box::new(owned_expr(n.left)),
            right: Box::new(owned_expr(n.right)),
        }),
        arena_ast::ExprKind::FunctionCall(f) => ExprKind::FunctionCall(FunctionCallExpr {
            name: Box::new(owned_expr(f.name)),
            args: owned_args(&f.args),
        }),
        arena_ast::ExprKind::Array(elems) => ExprKind::Array(
            elems
                .iter()
                .map(|e| ArrayElement {
                    key: e.key.as_ref().map(owned_expr),
                    value: owned_expr(&e.value),
                    unpack: e.unpack,
                    by_ref: e.by_ref,
                    span: e.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        ),
        arena_ast::ExprKind::ArrayAccess(a) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: Box::new(owned_expr(a.array)),
            index: a.index.map(|e| Box::new(owned_expr(e))),
        }),
        arena_ast::ExprKind::Print(e) => ExprKind::Print(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Parenthesized(e) => ExprKind::Parenthesized(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Cast(kind, e) => ExprKind::Cast(*kind, Box::new(owned_expr(e))),
        arena_ast::ExprKind::ErrorSuppress(e) => ExprKind::ErrorSuppress(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Isset(exprs) => ExprKind::Isset(owned_exprs(exprs)),
        arena_ast::ExprKind::Empty(e) => ExprKind::Empty(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Include(kind, e) => ExprKind::Include(*kind, Box::new(owned_expr(e))),
        arena_ast::ExprKind::Eval(e) => ExprKind::Eval(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Exit(e) => ExprKind::Exit(e.map(|e| Box::new(owned_expr(e)))),
        arena_ast::ExprKind::MagicConst(m) => ExprKind::MagicConst(*m),
        arena_ast::ExprKind::Clone(e) => ExprKind::Clone(Box::new(owned_expr(e))),
        arena_ast::ExprKind::CloneWith(obj, props) => {
            ExprKind::CloneWith(Box::new(owned_expr(obj)), Box::new(owned_expr(props)))
        }
        arena_ast::ExprKind::New(n) => ExprKind::New(NewExpr {
            class: Box::new(owned_expr(n.class)),
            args: owned_args(&n.args),
        }),
        arena_ast::ExprKind::PropertyAccess(p) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: Box::new(owned_expr(p.object)),
            property: Box::new(owned_expr(p.property)),
        }),
        arena_ast::ExprKind::NullsafePropertyAccess(p) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: Box::new(owned_expr(p.object)),
                property: Box::new(owned_expr(p.property)),
            })
        }
        arena_ast::ExprKind::MethodCall(m) => ExprKind::MethodCall(Box::new(MethodCallExpr {
            object: Box::new(owned_expr(m.object)),
            method: Box::new(owned_expr(m.method)),
            args: owned_args(&m.args),
        })),
        arena_ast::ExprKind::NullsafeMethodCall(m) => {
            ExprKind::NullsafeMethodCall(Box::new(MethodCallExpr {
                object: Box::new(owned_expr(m.object)),
                method: Box::new(owned_expr(m.method)),
                args: owned_args(&m.args),
            }))
        }
        arena_ast::ExprKind::StaticPropertyAccess(s) => {
            ExprKind::StaticPropertyAccess(StaticAccessExpr {
                class: Box::new(owned_expr(s.class)),
                member: Box::new(owned_expr(s.member)),
            })
        }
        arena_ast::ExprKind::StaticMethodCall(s) => {
            ExprKind::StaticMethodCall(Box::new(StaticMethodCallExpr {
                class: Box::new(owned_expr(s.class)),
                method: Box::new(owned_expr(s.method)),
                args: owned_args(&s.args),
            }))
        }
        arena_ast::ExprKind::StaticDynMethodCall(s) => {
            ExprKind::StaticDynMethodCall(Box::new(StaticDynMethodCallExpr {
                class: Box::new(owned_expr(s.class)),
                method: Box::new(owned_expr(s.method)),
                args: owned_args(&s.args),
            }))
        }
        arena_ast::ExprKind::ClassConstAccess(s) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: Box::new(owned_expr(s.class)),
            member: Box::new(owned_expr(s.member)),
        }),
        arena_ast::ExprKind::ClassConstAccessDynamic { class, member } => {
            ExprKind::ClassConstAccessDynamic {
                class: Box::new(owned_expr(class)),
                member: Box::new(owned_expr(member)),
            }
        }
        arena_ast::ExprKind::StaticPropertyAccessDynamic { class, member } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: Box::new(owned_expr(class)),
                member: Box::new(owned_expr(member)),
            }
        }
        arena_ast::ExprKind::Closure(c) => ExprKind::Closure(Box::new(ClosureExpr {
            is_static: c.is_static,
            by_ref: c.by_ref,
            params: owned_params(&c.params),
            use_vars: c
                .use_vars
                .iter()
                .map(|v| ClosureUseVar {
                    name: v.name.into(),
                    by_ref: v.by_ref,
                    span: v.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            return_type: c.return_type.as_ref().map(owned_type_hint),
            body: owned_stmts(&c.body),
            attributes: owned_attrs(&c.attributes),
        })),
        arena_ast::ExprKind::ArrowFunction(f) => {
            ExprKind::ArrowFunction(Box::new(ArrowFunctionExpr {
                is_static: f.is_static,
                by_ref: f.by_ref,
                params: owned_params(&f.params),
                return_type: f.return_type.as_ref().map(owned_type_hint),
                body: Box::new(owned_expr(f.body)),
                attributes: owned_attrs(&f.attributes),
            }))
        }
        arena_ast::ExprKind::Match(m) => ExprKind::Match(MatchExpr {
            subject: Box::new(owned_expr(m.subject)),
            arms: m
                .arms
                .iter()
                .map(|arm| MatchArm {
                    conditions: arm.conditions.as_ref().map(|conds| owned_exprs(conds)),
                    body: owned_expr(&arm.body),
                    span: arm.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        }),
        arena_ast::ExprKind::ThrowExpr(e) => ExprKind::ThrowExpr(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Yield(y) => ExprKind::Yield(YieldExpr {
            key: y.key.map(|e| Box::new(owned_expr(e))),
            value: y.value.map(|e| Box::new(owned_expr(e))),
            is_from: y.is_from,
        }),
        arena_ast::ExprKind::AnonymousClass(cls) => {
            ExprKind::AnonymousClass(Box::new(owned_class_decl(cls)))
        }
        arena_ast::ExprKind::CallableCreate(c) => ExprKind::CallableCreate(CallableCreateExpr {
            kind: match &c.kind {
                arena_ast::CallableCreateKind::Function(e) => {
                    CallableCreateKind::Function(Box::new(owned_expr(e)))
                }
                arena_ast::CallableCreateKind::Method { object, method } => {
                    CallableCreateKind::Method {
                        object: Box::new(owned_expr(object)),
                        method: Box::new(owned_expr(method)),
                    }
                }
                arena_ast::CallableCreateKind::NullsafeMethod { object, method } => {
                    CallableCreateKind::NullsafeMethod {
                        object: Box::new(owned_expr(object)),
                        method: Box::new(owned_expr(method)),
                    }
                }
                arena_ast::CallableCreateKind::StaticMethod { class, method } => {
                    CallableCreateKind::StaticMethod {
                        class: Box::new(owned_expr(class)),
                        method: Box::new(owned_expr(method)),
                    }
                }
            },
        }),
        arena_ast::ExprKind::Omit => ExprKind::Omit,
        arena_ast::ExprKind::Error => ExprKind::Error,
    }
}

fn owned_param(p: &arena_ast::Param<'_, '_>) -> Param {
    Param {
        name: owned_ident(p.name),
        type_hint: p.type_hint.as_ref().map(owned_type_hint),
        default: p.default.as_ref().map(owned_expr),
        by_ref: p.by_ref,
        variadic: p.variadic,
        is_readonly: p.is_readonly,
        is_final: p.is_final,
        visibility: p.visibility,
        set_visibility: p.set_visibility,
        attributes: owned_attrs(&p.attributes),
        hooks: owned_hooks(&p.hooks),
        span: p.span,
    }
}

fn owned_params(params: &[arena_ast::Param<'_, '_>]) -> Box<[Param]> {
    params
        .iter()
        .map(owned_param)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_hook(h: &arena_ast::PropertyHook<'_, '_>) -> PropertyHook {
    PropertyHook {
        kind: h.kind,
        body: match &h.body {
            arena_ast::PropertyHookBody::Block(stmts) => {
                PropertyHookBody::Block(owned_stmts(stmts))
            }
            arena_ast::PropertyHookBody::Expression(e) => {
                PropertyHookBody::Expression(owned_expr(e))
            }
            arena_ast::PropertyHookBody::Abstract => PropertyHookBody::Abstract,
        },
        is_final: h.is_final,
        by_ref: h.by_ref,
        params: owned_params(&h.params),
        attributes: owned_attrs(&h.attributes),
        span: h.span,
    }
}

fn owned_hooks(hooks: &[arena_ast::PropertyHook<'_, '_>]) -> Box<[PropertyHook]> {
    hooks
        .iter()
        .map(owned_hook)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_stmts(stmts: &[arena_ast::Stmt<'_, '_>]) -> Box<[Stmt]> {
    stmts
        .iter()
        .map(owned_stmt)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

/// Convert an arena-allocated [`Stmt`](crate::ast::Stmt) into a [`Stmt`].
pub fn to_owned_stmt(stmt: &arena_ast::Stmt<'_, '_>) -> Stmt {
    owned_stmt(stmt)
}

fn owned_stmt(stmt: &arena_ast::Stmt<'_, '_>) -> Stmt {
    Stmt {
        kind: owned_stmt_kind(&stmt.kind),
        span: stmt.span,
    }
}

fn owned_stmt_kind(k: &arena_ast::StmtKind<'_, '_>) -> StmtKind {
    match k {
        arena_ast::StmtKind::Expression(e) => StmtKind::Expression(Box::new(owned_expr(e))),
        arena_ast::StmtKind::Echo(exprs) => StmtKind::Echo(owned_exprs(exprs)),
        arena_ast::StmtKind::Return(e) => StmtKind::Return(e.map(|e| Box::new(owned_expr(e)))),
        arena_ast::StmtKind::Block(stmts) => StmtKind::Block(owned_stmts(stmts)),
        arena_ast::StmtKind::If(s) => StmtKind::If(Box::new(IfStmt {
            condition: owned_expr(&s.condition),
            then_branch: Box::new(owned_stmt(s.then_branch)),
            elseif_branches: s
                .elseif_branches
                .iter()
                .map(|b| ElseIfBranch {
                    condition: owned_expr(&b.condition),
                    body: owned_stmt(&b.body),
                    span: b.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            else_branch: s.else_branch.map(|b| Box::new(owned_stmt(b))),
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::While(s) => StmtKind::While(Box::new(WhileStmt {
            condition: owned_expr(&s.condition),
            body: Box::new(owned_stmt(s.body)),
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::For(s) => StmtKind::For(Box::new(ForStmt {
            init: owned_exprs(&s.init),
            condition: owned_exprs(&s.condition),
            update: owned_exprs(&s.update),
            body: Box::new(owned_stmt(s.body)),
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::Foreach(s) => StmtKind::Foreach(Box::new(ForeachStmt {
            expr: owned_expr(&s.expr),
            key: s.key.as_ref().map(owned_expr),
            value: owned_expr(&s.value),
            body: Box::new(owned_stmt(s.body)),
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::DoWhile(s) => StmtKind::DoWhile(Box::new(DoWhileStmt {
            body: Box::new(owned_stmt(s.body)),
            condition: owned_expr(&s.condition),
        })),
        arena_ast::StmtKind::Function(f) => StmtKind::Function(Box::new(owned_function_decl(f))),
        arena_ast::StmtKind::Break(e) => StmtKind::Break(e.map(|e| Box::new(owned_expr(e)))),
        arena_ast::StmtKind::Continue(e) => StmtKind::Continue(e.map(|e| Box::new(owned_expr(e)))),
        arena_ast::StmtKind::Switch(s) => StmtKind::Switch(Box::new(SwitchStmt {
            expr: owned_expr(&s.expr),
            cases: s
                .cases
                .iter()
                .map(|c| SwitchCase {
                    value: c.value.as_ref().map(owned_expr),
                    body: owned_stmts(&c.body),
                    span: c.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::Goto(ident) => StmtKind::Goto(owned_ident(*ident)),
        arena_ast::StmtKind::Label(s) => StmtKind::Label(Box::from(*s)),
        arena_ast::StmtKind::Declare(d) => StmtKind::Declare(Box::new(DeclareStmt {
            directives: d
                .directives
                .iter()
                .map(|(k, v)| (Box::from(*k), owned_expr(v)))
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            body: d.body.map(|b| Box::new(owned_stmt(b))),
            uses_alternative: d.uses_alternative,
        })),
        arena_ast::StmtKind::Unset(exprs) => StmtKind::Unset(owned_exprs(exprs)),
        arena_ast::StmtKind::Throw(e) => StmtKind::Throw(Box::new(owned_expr(e))),
        arena_ast::StmtKind::TryCatch(t) => StmtKind::TryCatch(Box::new(TryCatchStmt {
            body: owned_stmts(&t.body),
            catches: t
                .catches
                .iter()
                .map(|c| CatchClause {
                    types: c
                        .types
                        .iter()
                        .map(owned_name)
                        .collect::<Vec<_>>()
                        .into_boxed_slice(),
                    var: c.var.map(Box::from),
                    body: owned_stmts(&c.body),
                    span: c.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            finally: t.finally.as_ref().map(|stmts| owned_stmts(stmts)),
        })),
        arena_ast::StmtKind::Global(exprs) => StmtKind::Global(owned_exprs(exprs)),
        arena_ast::StmtKind::Class(cls) => StmtKind::Class(Box::new(owned_class_decl(cls))),
        arena_ast::StmtKind::Interface(iface) => {
            StmtKind::Interface(Box::new(owned_interface_decl(iface)))
        }
        arena_ast::StmtKind::Trait(tr) => StmtKind::Trait(Box::new(owned_trait_decl(tr))),
        arena_ast::StmtKind::Enum(en) => StmtKind::Enum(Box::new(owned_enum_decl(en))),
        arena_ast::StmtKind::Namespace(ns) => StmtKind::Namespace(Box::new(NamespaceDecl {
            name: ns.name.as_ref().map(owned_name),
            body: match &ns.body {
                arena_ast::NamespaceBody::Braced(stmts) => {
                    NamespaceBody::Braced(owned_stmts(stmts))
                }
                arena_ast::NamespaceBody::Simple => NamespaceBody::Simple,
            },
        })),
        arena_ast::StmtKind::Use(u) => StmtKind::Use(Box::new(UseDecl {
            kind: u.kind,
            uses: u
                .uses
                .iter()
                .map(|item| UseItem {
                    name: owned_name(&item.name),
                    alias: item.alias.map(Box::from),
                    kind: item.kind,
                    span: item.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        })),
        arena_ast::StmtKind::Const(items) => StmtKind::Const(
            items
                .iter()
                .map(|item| ConstItem {
                    name: owned_ident(item.name),
                    value: owned_expr(&item.value),
                    attributes: owned_attrs(&item.attributes),
                    span: item.span,
                    doc_comment: owned_opt_comment(&item.doc_comment),
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        ),
        arena_ast::StmtKind::StaticVar(vars) => StmtKind::StaticVar(
            vars.iter()
                .map(|v| StaticVar {
                    name: owned_ident(v.name),
                    default: v.default.as_ref().map(owned_expr),
                    span: v.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
        ),
        arena_ast::StmtKind::HaltCompiler(s) => StmtKind::HaltCompiler(Box::from(*s)),
        arena_ast::StmtKind::Nop => StmtKind::Nop,
        arena_ast::StmtKind::InlineHtml(s) => StmtKind::InlineHtml(Box::from(*s)),
        arena_ast::StmtKind::Error => StmtKind::Error,
    }
}

fn owned_function_decl(f: &arena_ast::FunctionDecl<'_, '_>) -> FunctionDecl {
    FunctionDecl {
        name: owned_ident(f.name),
        params: owned_params(&f.params),
        body: owned_stmts(&f.body),
        return_type: f.return_type.as_ref().map(owned_type_hint),
        by_ref: f.by_ref,
        attributes: owned_attrs(&f.attributes),
        doc_comment: owned_opt_comment(&f.doc_comment),
    }
}

fn owned_class_member(m: &arena_ast::ClassMember<'_, '_>) -> ClassMember {
    ClassMember {
        kind: match &m.kind {
            arena_ast::ClassMemberKind::Property(p) => ClassMemberKind::Property(PropertyDecl {
                name: owned_ident(p.name),
                visibility: p.visibility,
                set_visibility: p.set_visibility,
                is_static: p.is_static,
                is_readonly: p.is_readonly,
                type_hint: p.type_hint.as_ref().map(owned_type_hint),
                default: p.default.as_ref().map(owned_expr),
                attributes: owned_attrs(&p.attributes),
                hooks: owned_hooks(&p.hooks),
                doc_comment: owned_opt_comment(&p.doc_comment),
            }),
            arena_ast::ClassMemberKind::Method(m) => ClassMemberKind::Method(MethodDecl {
                name: owned_ident(m.name),
                visibility: m.visibility,
                is_static: m.is_static,
                is_abstract: m.is_abstract,
                is_final: m.is_final,
                by_ref: m.by_ref,
                params: owned_params(&m.params),
                return_type: m.return_type.as_ref().map(owned_type_hint),
                body: m.body.as_ref().map(|stmts| owned_stmts(stmts)),
                attributes: owned_attrs(&m.attributes),
                doc_comment: owned_opt_comment(&m.doc_comment),
            }),
            arena_ast::ClassMemberKind::ClassConst(c) => {
                ClassMemberKind::ClassConst(owned_class_const(c))
            }
            arena_ast::ClassMemberKind::TraitUse(t) => {
                ClassMemberKind::TraitUse(owned_trait_use(t))
            }
        },
        span: m.span,
    }
}

fn owned_class_members(members: &[arena_ast::ClassMember<'_, '_>]) -> Box<[ClassMember]> {
    members
        .iter()
        .map(owned_class_member)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

fn owned_class_const(c: &arena_ast::ClassConstDecl<'_, '_>) -> ClassConstDecl {
    ClassConstDecl {
        name: owned_ident(c.name),
        visibility: c.visibility,
        is_final: c.is_final,
        type_hint: c.type_hint.map(|th| Box::new(owned_type_hint(th))),
        value: owned_expr(&c.value),
        attributes: owned_attrs(&c.attributes),
        doc_comment: owned_opt_comment(&c.doc_comment),
    }
}

fn owned_trait_use(t: &arena_ast::TraitUseDecl<'_, '_>) -> TraitUseDecl {
    TraitUseDecl {
        traits: t
            .traits
            .iter()
            .map(owned_name)
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        adaptations: t
            .adaptations
            .iter()
            .map(|a| TraitAdaptation {
                kind: match &a.kind {
                    arena_ast::TraitAdaptationKind::Precedence {
                        trait_name,
                        method,
                        insteadof,
                    } => TraitAdaptationKind::Precedence {
                        trait_name: owned_name(trait_name),
                        method: owned_name(method),
                        insteadof: insteadof
                            .iter()
                            .map(owned_name)
                            .collect::<Vec<_>>()
                            .into_boxed_slice(),
                    },
                    arena_ast::TraitAdaptationKind::Alias {
                        trait_name,
                        method,
                        new_modifier,
                        new_name,
                    } => TraitAdaptationKind::Alias {
                        trait_name: trait_name.as_ref().map(owned_name),
                        method: owned_name(method),
                        new_modifier: *new_modifier,
                        new_name: new_name.as_ref().map(owned_name),
                    },
                },
                span: a.span,
            })
            .collect::<Vec<_>>()
            .into_boxed_slice(),
    }
}

fn owned_class_decl(cls: &arena_ast::ClassDecl<'_, '_>) -> ClassDecl {
    ClassDecl {
        name: cls
            .name
            .map(|ident| Some(owned_ident(ident)))
            .unwrap_or(None),
        modifiers: cls.modifiers.clone(),
        extends: cls.extends.as_ref().map(owned_name),
        implements: cls
            .implements
            .iter()
            .map(owned_name)
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        members: owned_class_members(&cls.members),
        attributes: owned_attrs(&cls.attributes),
        doc_comment: owned_opt_comment(&cls.doc_comment),
    }
}

fn owned_interface_decl(iface: &arena_ast::InterfaceDecl<'_, '_>) -> InterfaceDecl {
    InterfaceDecl {
        name: owned_ident(iface.name),
        extends: iface
            .extends
            .iter()
            .map(owned_name)
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        members: owned_class_members(&iface.members),
        attributes: owned_attrs(&iface.attributes),
        doc_comment: owned_opt_comment(&iface.doc_comment),
    }
}

fn owned_trait_decl(tr: &arena_ast::TraitDecl<'_, '_>) -> TraitDecl {
    TraitDecl {
        name: owned_ident(tr.name),
        members: owned_class_members(&tr.members),
        attributes: owned_attrs(&tr.attributes),
        doc_comment: owned_opt_comment(&tr.doc_comment),
    }
}

fn owned_enum_decl(en: &arena_ast::EnumDecl<'_, '_>) -> EnumDecl {
    EnumDecl {
        name: owned_ident(en.name),
        scalar_type: en.scalar_type.as_ref().map(owned_name),
        implements: en
            .implements
            .iter()
            .map(owned_name)
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        members: en
            .members
            .iter()
            .map(|m| EnumMember {
                kind: match &m.kind {
                    arena_ast::EnumMemberKind::Case(c) => EnumMemberKind::Case(EnumCase {
                        name: owned_ident(c.name),
                        value: c.value.as_ref().map(owned_expr),
                        attributes: owned_attrs(&c.attributes),
                        doc_comment: owned_opt_comment(&c.doc_comment),
                    }),
                    arena_ast::EnumMemberKind::Method(m) => EnumMemberKind::Method(MethodDecl {
                        name: owned_ident(m.name),
                        visibility: m.visibility,
                        is_static: m.is_static,
                        is_abstract: m.is_abstract,
                        is_final: m.is_final,
                        by_ref: m.by_ref,
                        params: owned_params(&m.params),
                        return_type: m.return_type.as_ref().map(owned_type_hint),
                        body: m.body.as_ref().map(|stmts| owned_stmts(stmts)),
                        attributes: owned_attrs(&m.attributes),
                        doc_comment: owned_opt_comment(&m.doc_comment),
                    }),
                    arena_ast::EnumMemberKind::ClassConst(c) => {
                        EnumMemberKind::ClassConst(owned_class_const(c))
                    }
                    arena_ast::EnumMemberKind::TraitUse(t) => {
                        EnumMemberKind::TraitUse(owned_trait_use(t))
                    }
                },
                span: m.span,
            })
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        attributes: owned_attrs(&en.attributes),
        doc_comment: owned_opt_comment(&en.doc_comment),
    }
}

/// Convert an arena-allocated [`Program`](crate::ast::Program) into a [`Program`].
pub fn to_owned_program(program: &arena_ast::Program<'_, '_>) -> Program {
    Program {
        stmts: owned_stmts(&program.stmts),
        span: program.span,
    }
}

// ===========================================================================
// Reverse conversion: owned → arena
// ===========================================================================

/// Convert an owned [`Program`] into an arena-allocated
/// [`Program`](crate::ast::Program).
///
/// All strings are copied into `arena`. Both lifetime parameters of the
/// returned type are `'arena` because every string originates in the arena
/// rather than a source buffer.
///
/// Used internally by the pretty printer so callers can pass an owned program
/// without round-tripping through `parse_arena()`.
pub fn from_owned_program<'arena>(
    arena: &'arena bumpalo::Bump,
    program: &Program,
) -> arena_ast::Program<'arena, 'arena> {
    arena_ast::Program {
        stmts: av_stmts(arena, &program.stmts),
        span: program.span,
    }
}

// Helper: allocate a string in the arena.
#[inline]
fn av_str<'a>(arena: &'a bumpalo::Bump, s: &str) -> &'a str {
    arena.alloc_str(s)
}

fn av_ident<'a>(arena: &'a bumpalo::Bump, ident: &Ident) -> arena_ast::Ident<'a> {
    match ident {
        Some(s) => arena_ast::Ident::name(arena.alloc_str(s)),
        None => arena_ast::Ident::ERROR,
    }
}

fn av_name<'a>(arena: &'a bumpalo::Bump, name: &Name) -> arena_ast::Name<'a, 'a> {
    if name.kind == NameKind::Error {
        return arena_ast::Name::Error { span: name.span };
    }
    if name.parts.len() == 1 && name.kind == NameKind::Unqualified {
        return arena_ast::Name::Simple {
            value: arena.alloc_str(&name.parts[0]),
            span: name.span,
        };
    }
    let mut parts = arena_ast::ArenaVec::with_capacity_in(name.parts.len(), arena);
    for p in name.parts.iter() {
        parts.push(arena.alloc_str(p) as &str);
    }
    arena_ast::Name::Complex {
        parts,
        kind: name.kind,
        span: name.span,
    }
}

fn av_type_hint<'a>(arena: &'a bumpalo::Bump, th: &TypeHint) -> arena_ast::TypeHint<'a, 'a> {
    arena_ast::TypeHint {
        kind: av_type_hint_kind(arena, &th.kind),
        span: th.span,
    }
}

fn av_type_hint_kind<'a>(
    arena: &'a bumpalo::Bump,
    k: &TypeHintKind,
) -> arena_ast::TypeHintKind<'a, 'a> {
    match k {
        TypeHintKind::Named(n) => arena_ast::TypeHintKind::Named(av_name(arena, n)),
        TypeHintKind::Keyword(b, span) => arena_ast::TypeHintKind::Keyword(*b, *span),
        TypeHintKind::Nullable(inner) => {
            arena_ast::TypeHintKind::Nullable(arena.alloc(av_type_hint(arena, inner)))
        }
        TypeHintKind::Union(types) => {
            let mut v = arena_ast::ArenaVec::with_capacity_in(types.len(), arena);
            for t in types.iter() {
                v.push(av_type_hint(arena, t));
            }
            arena_ast::TypeHintKind::Union(v)
        }
        TypeHintKind::Intersection(types) => {
            let mut v = arena_ast::ArenaVec::with_capacity_in(types.len(), arena);
            for t in types.iter() {
                v.push(av_type_hint(arena, t));
            }
            arena_ast::TypeHintKind::Intersection(v)
        }
    }
}

fn av_arg<'a>(arena: &'a bumpalo::Bump, arg: &Arg) -> arena_ast::Arg<'a, 'a> {
    arena_ast::Arg {
        name: arg.name.as_ref().map(|n| av_name(arena, n)),
        value: av_expr(arena, &arg.value),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

fn av_args<'a>(
    arena: &'a bumpalo::Bump,
    args: &[Arg],
) -> arena_ast::ArenaVec<'a, arena_ast::Arg<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(args.len(), arena);
    for a in args.iter() {
        v.push(av_arg(arena, a));
    }
    v
}

fn av_attr<'a>(arena: &'a bumpalo::Bump, attr: &Attribute) -> arena_ast::Attribute<'a, 'a> {
    arena_ast::Attribute {
        name: av_name(arena, &attr.name),
        args: av_args(arena, &attr.args),
        span: attr.span,
    }
}

fn av_attrs<'a>(
    arena: &'a bumpalo::Bump,
    attrs: &[Attribute],
) -> arena_ast::ArenaVec<'a, arena_ast::Attribute<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(attrs.len(), arena);
    for a in attrs.iter() {
        v.push(av_attr(arena, a));
    }
    v
}

fn av_comment<'a>(arena: &'a bumpalo::Bump, c: &Comment) -> arena_ast::Comment<'a> {
    arena_ast::Comment {
        kind: c.kind,
        text: arena.alloc_str(&c.text),
        span: c.span,
    }
}

fn av_opt_comment<'a>(
    arena: &'a bumpalo::Bump,
    c: &Option<Comment>,
) -> Option<arena_ast::Comment<'a>> {
    c.as_ref().map(|c| av_comment(arena, c))
}

fn av_string_parts<'a>(
    arena: &'a bumpalo::Bump,
    parts: &[StringPart],
) -> arena_ast::ArenaVec<'a, arena_ast::StringPart<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(parts.len(), arena);
    for p in parts.iter() {
        v.push(match p {
            StringPart::Literal(s) => arena_ast::StringPart::Literal(arena.alloc_str(s)),
            StringPart::Expr(e) => arena_ast::StringPart::Expr(av_expr(arena, e)),
        });
    }
    v
}

fn av_expr<'a>(arena: &'a bumpalo::Bump, expr: &Expr) -> arena_ast::Expr<'a, 'a> {
    arena_ast::Expr {
        kind: av_expr_kind(arena, &expr.kind),
        span: expr.span,
    }
}

fn av_exprs<'a>(
    arena: &'a bumpalo::Bump,
    exprs: &[Expr],
) -> arena_ast::ArenaVec<'a, arena_ast::Expr<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(exprs.len(), arena);
    for e in exprs.iter() {
        v.push(av_expr(arena, e));
    }
    v
}

fn av_namestr<'a>(arena: &'a bumpalo::Bump, s: &str) -> arena_ast::NameStr<'a, 'a> {
    arena_ast::NameStr::__arena(arena.alloc_str(s))
}

fn av_expr_kind<'a>(arena: &'a bumpalo::Bump, k: &ExprKind) -> arena_ast::ExprKind<'a, 'a> {
    match k {
        ExprKind::Int(v) => arena_ast::ExprKind::Int(*v),
        ExprKind::Float(v) => arena_ast::ExprKind::Float(*v),
        ExprKind::String(s) => arena_ast::ExprKind::String(arena.alloc_str(s)),
        ExprKind::InterpolatedString(parts) => {
            arena_ast::ExprKind::InterpolatedString(av_string_parts(arena, parts))
        }
        ExprKind::Heredoc { label, parts } => arena_ast::ExprKind::Heredoc {
            label: arena.alloc_str(label),
            parts: av_string_parts(arena, parts),
        },
        ExprKind::Nowdoc { label, value } => arena_ast::ExprKind::Nowdoc {
            label: arena.alloc_str(label),
            value: arena.alloc_str(value),
        },
        ExprKind::ShellExec(parts) => arena_ast::ExprKind::ShellExec(av_string_parts(arena, parts)),
        ExprKind::Bool(v) => arena_ast::ExprKind::Bool(*v),
        ExprKind::Null => arena_ast::ExprKind::Null,
        ExprKind::Variable(s) => arena_ast::ExprKind::Variable(av_namestr(arena, s)),
        ExprKind::VariableVariable(inner) => {
            arena_ast::ExprKind::VariableVariable(arena.alloc(av_expr(arena, inner)))
        }
        ExprKind::Identifier(s) => arena_ast::ExprKind::Identifier(av_namestr(arena, s)),
        ExprKind::Assign(a) => arena_ast::ExprKind::Assign(arena_ast::AssignExpr {
            target: arena.alloc(av_expr(arena, &a.target)),
            op: a.op,
            value: arena.alloc(av_expr(arena, &a.value)),
            by_ref: a.by_ref,
        }),
        ExprKind::Binary(b) => arena_ast::ExprKind::Binary(arena_ast::BinaryExpr {
            left: arena.alloc(av_expr(arena, &b.left)),
            op: b.op,
            right: arena.alloc(av_expr(arena, &b.right)),
        }),
        ExprKind::UnaryPrefix(u) => arena_ast::ExprKind::UnaryPrefix(arena_ast::UnaryPrefixExpr {
            op: u.op,
            operand: arena.alloc(av_expr(arena, &u.operand)),
        }),
        ExprKind::UnaryPostfix(u) => {
            arena_ast::ExprKind::UnaryPostfix(arena_ast::UnaryPostfixExpr {
                operand: arena.alloc(av_expr(arena, &u.operand)),
                op: u.op,
            })
        }
        ExprKind::Ternary(t) => arena_ast::ExprKind::Ternary(arena_ast::TernaryExpr {
            condition: arena.alloc(av_expr(arena, &t.condition)),
            then_expr: t
                .then_expr
                .as_ref()
                .map(|e| &*arena.alloc(av_expr(arena, e))),
            else_expr: arena.alloc(av_expr(arena, &t.else_expr)),
        }),
        ExprKind::NullCoalesce(n) => {
            arena_ast::ExprKind::NullCoalesce(arena_ast::NullCoalesceExpr {
                left: arena.alloc(av_expr(arena, &n.left)),
                right: arena.alloc(av_expr(arena, &n.right)),
            })
        }
        ExprKind::FunctionCall(f) => {
            arena_ast::ExprKind::FunctionCall(arena_ast::FunctionCallExpr {
                name: arena.alloc(av_expr(arena, &f.name)),
                args: av_args(arena, &f.args),
            })
        }
        ExprKind::Array(elems) => {
            let mut v = arena_ast::ArenaVec::with_capacity_in(elems.len(), arena);
            for e in elems.iter() {
                v.push(arena_ast::ArrayElement {
                    key: e.key.as_ref().map(|k| av_expr(arena, k)),
                    value: av_expr(arena, &e.value),
                    unpack: e.unpack,
                    by_ref: e.by_ref,
                    span: e.span,
                });
            }
            arena_ast::ExprKind::Array(v)
        }
        ExprKind::ArrayAccess(a) => arena_ast::ExprKind::ArrayAccess(arena_ast::ArrayAccessExpr {
            array: arena.alloc(av_expr(arena, &a.array)),
            index: a.index.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
        }),
        ExprKind::Print(e) => arena_ast::ExprKind::Print(arena.alloc(av_expr(arena, e))),
        ExprKind::Parenthesized(e) => {
            arena_ast::ExprKind::Parenthesized(arena.alloc(av_expr(arena, e)))
        }
        ExprKind::Cast(kind, e) => arena_ast::ExprKind::Cast(*kind, arena.alloc(av_expr(arena, e))),
        ExprKind::ErrorSuppress(e) => {
            arena_ast::ExprKind::ErrorSuppress(arena.alloc(av_expr(arena, e)))
        }
        ExprKind::Isset(exprs) => arena_ast::ExprKind::Isset(av_exprs(arena, exprs)),
        ExprKind::Empty(e) => arena_ast::ExprKind::Empty(arena.alloc(av_expr(arena, e))),
        ExprKind::Include(kind, e) => {
            arena_ast::ExprKind::Include(*kind, arena.alloc(av_expr(arena, e)))
        }
        ExprKind::Eval(e) => arena_ast::ExprKind::Eval(arena.alloc(av_expr(arena, e))),
        ExprKind::Exit(e) => {
            arena_ast::ExprKind::Exit(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        ExprKind::MagicConst(m) => arena_ast::ExprKind::MagicConst(*m),
        ExprKind::Clone(e) => arena_ast::ExprKind::Clone(arena.alloc(av_expr(arena, e))),
        ExprKind::CloneWith(obj, props) => arena_ast::ExprKind::CloneWith(
            arena.alloc(av_expr(arena, obj)),
            arena.alloc(av_expr(arena, props)),
        ),
        ExprKind::New(n) => arena_ast::ExprKind::New(arena_ast::NewExpr {
            class: arena.alloc(av_expr(arena, &n.class)),
            args: av_args(arena, &n.args),
        }),
        ExprKind::PropertyAccess(p) => {
            arena_ast::ExprKind::PropertyAccess(arena_ast::PropertyAccessExpr {
                object: arena.alloc(av_expr(arena, &p.object)),
                property: arena.alloc(av_expr(arena, &p.property)),
            })
        }
        ExprKind::NullsafePropertyAccess(p) => {
            arena_ast::ExprKind::NullsafePropertyAccess(arena_ast::PropertyAccessExpr {
                object: arena.alloc(av_expr(arena, &p.object)),
                property: arena.alloc(av_expr(arena, &p.property)),
            })
        }
        ExprKind::MethodCall(m) => {
            arena_ast::ExprKind::MethodCall(arena.alloc(arena_ast::MethodCallExpr {
                object: arena.alloc(av_expr(arena, &m.object)),
                method: arena.alloc(av_expr(arena, &m.method)),
                args: av_args(arena, &m.args),
            }))
        }
        ExprKind::NullsafeMethodCall(m) => {
            arena_ast::ExprKind::NullsafeMethodCall(arena.alloc(arena_ast::MethodCallExpr {
                object: arena.alloc(av_expr(arena, &m.object)),
                method: arena.alloc(av_expr(arena, &m.method)),
                args: av_args(arena, &m.args),
            }))
        }
        ExprKind::StaticPropertyAccess(s) => {
            arena_ast::ExprKind::StaticPropertyAccess(arena_ast::StaticAccessExpr {
                class: arena.alloc(av_expr(arena, &s.class)),
                member: arena.alloc(av_expr(arena, &s.member)),
            })
        }
        ExprKind::StaticMethodCall(s) => {
            arena_ast::ExprKind::StaticMethodCall(arena.alloc(arena_ast::StaticMethodCallExpr {
                class: arena.alloc(av_expr(arena, &s.class)),
                method: arena.alloc(av_expr(arena, &s.method)),
                args: av_args(arena, &s.args),
            }))
        }
        ExprKind::StaticDynMethodCall(s) => arena_ast::ExprKind::StaticDynMethodCall(arena.alloc(
            arena_ast::StaticDynMethodCallExpr {
                class: arena.alloc(av_expr(arena, &s.class)),
                method: arena.alloc(av_expr(arena, &s.method)),
                args: av_args(arena, &s.args),
            },
        )),
        ExprKind::ClassConstAccess(s) => {
            arena_ast::ExprKind::ClassConstAccess(arena_ast::StaticAccessExpr {
                class: arena.alloc(av_expr(arena, &s.class)),
                member: arena.alloc(av_expr(arena, &s.member)),
            })
        }
        ExprKind::ClassConstAccessDynamic { class, member } => {
            arena_ast::ExprKind::ClassConstAccessDynamic {
                class: arena.alloc(av_expr(arena, class)),
                member: arena.alloc(av_expr(arena, member)),
            }
        }
        ExprKind::StaticPropertyAccessDynamic { class, member } => {
            arena_ast::ExprKind::StaticPropertyAccessDynamic {
                class: arena.alloc(av_expr(arena, class)),
                member: arena.alloc(av_expr(arena, member)),
            }
        }
        ExprKind::Closure(c) => arena_ast::ExprKind::Closure(arena.alloc(arena_ast::ClosureExpr {
            is_static: c.is_static,
            by_ref: c.by_ref,
            params: av_params(arena, &c.params),
            use_vars: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(c.use_vars.len(), arena);
                for uv in c.use_vars.iter() {
                    v.push(arena_ast::ClosureUseVar {
                        name: arena.alloc_str(&uv.name),
                        by_ref: uv.by_ref,
                        span: uv.span,
                    });
                }
                v
            },
            return_type: c.return_type.as_ref().map(|t| av_type_hint(arena, t)),
            body: av_stmts(arena, &c.body),
            attributes: av_attrs(arena, &c.attributes),
        })),
        ExprKind::ArrowFunction(f) => {
            arena_ast::ExprKind::ArrowFunction(arena.alloc(arena_ast::ArrowFunctionExpr {
                is_static: f.is_static,
                by_ref: f.by_ref,
                params: av_params(arena, &f.params),
                return_type: f.return_type.as_ref().map(|t| av_type_hint(arena, t)),
                body: arena.alloc(av_expr(arena, &f.body)),
                attributes: av_attrs(arena, &f.attributes),
            }))
        }
        ExprKind::Match(m) => arena_ast::ExprKind::Match(arena_ast::MatchExpr {
            subject: arena.alloc(av_expr(arena, &m.subject)),
            arms: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(m.arms.len(), arena);
                for arm in m.arms.iter() {
                    v.push(arena_ast::MatchArm {
                        conditions: arm.conditions.as_ref().map(|conds| av_exprs(arena, conds)),
                        body: av_expr(arena, &arm.body),
                        span: arm.span,
                    });
                }
                v
            },
        }),
        ExprKind::ThrowExpr(e) => arena_ast::ExprKind::ThrowExpr(arena.alloc(av_expr(arena, e))),
        ExprKind::Yield(y) => arena_ast::ExprKind::Yield(arena_ast::YieldExpr {
            key: y.key.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
            value: y.value.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
            is_from: y.is_from,
        }),
        ExprKind::AnonymousClass(cls) => {
            arena_ast::ExprKind::AnonymousClass(arena.alloc(av_class_decl(arena, cls)))
        }
        ExprKind::CallableCreate(c) => {
            arena_ast::ExprKind::CallableCreate(arena_ast::CallableCreateExpr {
                kind: match &c.kind {
                    CallableCreateKind::Function(e) => {
                        arena_ast::CallableCreateKind::Function(arena.alloc(av_expr(arena, e)))
                    }
                    CallableCreateKind::Method { object, method } => {
                        arena_ast::CallableCreateKind::Method {
                            object: arena.alloc(av_expr(arena, object)),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                    CallableCreateKind::NullsafeMethod { object, method } => {
                        arena_ast::CallableCreateKind::NullsafeMethod {
                            object: arena.alloc(av_expr(arena, object)),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                    CallableCreateKind::StaticMethod { class, method } => {
                        arena_ast::CallableCreateKind::StaticMethod {
                            class: arena.alloc(av_expr(arena, class)),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                },
            })
        }
        ExprKind::Omit => arena_ast::ExprKind::Omit,
        ExprKind::Error => arena_ast::ExprKind::Error,
    }
}

fn av_param<'a>(arena: &'a bumpalo::Bump, p: &Param) -> arena_ast::Param<'a, 'a> {
    arena_ast::Param {
        name: av_ident(arena, &p.name),
        type_hint: p.type_hint.as_ref().map(|t| av_type_hint(arena, t)),
        default: p.default.as_ref().map(|e| av_expr(arena, e)),
        by_ref: p.by_ref,
        variadic: p.variadic,
        is_readonly: p.is_readonly,
        is_final: p.is_final,
        visibility: p.visibility,
        set_visibility: p.set_visibility,
        attributes: av_attrs(arena, &p.attributes),
        hooks: av_hooks(arena, &p.hooks),
        span: p.span,
    }
}

fn av_params<'a>(
    arena: &'a bumpalo::Bump,
    params: &[Param],
) -> arena_ast::ArenaVec<'a, arena_ast::Param<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(params.len(), arena);
    for p in params.iter() {
        v.push(av_param(arena, p));
    }
    v
}

fn av_hook<'a>(arena: &'a bumpalo::Bump, h: &PropertyHook) -> arena_ast::PropertyHook<'a, 'a> {
    arena_ast::PropertyHook {
        kind: h.kind,
        body: match &h.body {
            PropertyHookBody::Block(stmts) => {
                arena_ast::PropertyHookBody::Block(av_stmts(arena, stmts))
            }
            PropertyHookBody::Expression(e) => {
                arena_ast::PropertyHookBody::Expression(av_expr(arena, e))
            }
            PropertyHookBody::Abstract => arena_ast::PropertyHookBody::Abstract,
        },
        is_final: h.is_final,
        by_ref: h.by_ref,
        params: av_params(arena, &h.params),
        attributes: av_attrs(arena, &h.attributes),
        span: h.span,
    }
}

fn av_hooks<'a>(
    arena: &'a bumpalo::Bump,
    hooks: &[PropertyHook],
) -> arena_ast::ArenaVec<'a, arena_ast::PropertyHook<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(hooks.len(), arena);
    for h in hooks.iter() {
        v.push(av_hook(arena, h));
    }
    v
}

fn av_stmt<'a>(arena: &'a bumpalo::Bump, stmt: &Stmt) -> arena_ast::Stmt<'a, 'a> {
    arena_ast::Stmt {
        kind: av_stmt_kind(arena, &stmt.kind),
        span: stmt.span,
    }
}

fn av_stmts<'a>(
    arena: &'a bumpalo::Bump,
    stmts: &[Stmt],
) -> arena_ast::ArenaVec<'a, arena_ast::Stmt<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(stmts.len(), arena);
    for s in stmts.iter() {
        v.push(av_stmt(arena, s));
    }
    v
}

fn av_stmt_kind<'a>(arena: &'a bumpalo::Bump, k: &StmtKind) -> arena_ast::StmtKind<'a, 'a> {
    match k {
        StmtKind::Expression(e) => arena_ast::StmtKind::Expression(arena.alloc(av_expr(arena, e))),
        StmtKind::Echo(exprs) => arena_ast::StmtKind::Echo(av_exprs(arena, exprs)),
        StmtKind::Return(e) => {
            arena_ast::StmtKind::Return(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Block(stmts) => arena_ast::StmtKind::Block(av_stmts(arena, stmts)),
        StmtKind::If(s) => arena_ast::StmtKind::If(
            arena.alloc(arena_ast::IfStmt {
                condition: av_expr(arena, &s.condition),
                then_branch: arena.alloc(av_stmt(arena, &s.then_branch)),
                elseif_branches: {
                    let mut v =
                        arena_ast::ArenaVec::with_capacity_in(s.elseif_branches.len(), arena);
                    for b in s.elseif_branches.iter() {
                        v.push(arena_ast::ElseIfBranch {
                            condition: av_expr(arena, &b.condition),
                            body: av_stmt(arena, &b.body),
                            span: b.span,
                        });
                    }
                    v
                },
                else_branch: s
                    .else_branch
                    .as_ref()
                    .map(|b| &*arena.alloc(av_stmt(arena, b))),
                uses_alternative: s.uses_alternative,
            }),
        ),
        StmtKind::While(s) => arena_ast::StmtKind::While(arena.alloc(arena_ast::WhileStmt {
            condition: av_expr(arena, &s.condition),
            body: arena.alloc(av_stmt(arena, &s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::For(s) => arena_ast::StmtKind::For(arena.alloc(arena_ast::ForStmt {
            init: av_exprs(arena, &s.init),
            condition: av_exprs(arena, &s.condition),
            update: av_exprs(arena, &s.update),
            body: arena.alloc(av_stmt(arena, &s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::Foreach(s) => arena_ast::StmtKind::Foreach(arena.alloc(arena_ast::ForeachStmt {
            expr: av_expr(arena, &s.expr),
            key: s.key.as_ref().map(|e| av_expr(arena, e)),
            value: av_expr(arena, &s.value),
            body: arena.alloc(av_stmt(arena, &s.body)),
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::DoWhile(s) => arena_ast::StmtKind::DoWhile(arena.alloc(arena_ast::DoWhileStmt {
            body: arena.alloc(av_stmt(arena, &s.body)),
            condition: av_expr(arena, &s.condition),
        })),
        StmtKind::Function(f) => {
            arena_ast::StmtKind::Function(arena.alloc(av_function_decl(arena, f)))
        }
        StmtKind::Break(e) => {
            arena_ast::StmtKind::Break(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Continue(e) => {
            arena_ast::StmtKind::Continue(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Switch(s) => arena_ast::StmtKind::Switch(arena.alloc(arena_ast::SwitchStmt {
            expr: av_expr(arena, &s.expr),
            cases: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(s.cases.len(), arena);
                for c in s.cases.iter() {
                    v.push(arena_ast::SwitchCase {
                        value: c.value.as_ref().map(|vl| av_expr(arena, vl)),
                        body: av_stmts(arena, &c.body),
                        span: c.span,
                    });
                }
                v
            },
            uses_alternative: s.uses_alternative,
        })),
        StmtKind::Goto(ident) => arena_ast::StmtKind::Goto(av_ident(arena, ident)),
        StmtKind::Label(s) => arena_ast::StmtKind::Label(av_str(arena, s)),
        StmtKind::Declare(d) => arena_ast::StmtKind::Declare(arena.alloc(arena_ast::DeclareStmt {
            directives: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(d.directives.len(), arena);
                for (k, val) in d.directives.iter() {
                    v.push((arena.alloc_str(k) as &str, av_expr(arena, val)));
                }
                v
            },
            body: d.body.as_ref().map(|b| &*arena.alloc(av_stmt(arena, b))),
            uses_alternative: d.uses_alternative,
        })),
        StmtKind::Unset(exprs) => arena_ast::StmtKind::Unset(av_exprs(arena, exprs)),
        StmtKind::Throw(e) => arena_ast::StmtKind::Throw(arena.alloc(av_expr(arena, e))),
        StmtKind::TryCatch(t) => {
            arena_ast::StmtKind::TryCatch(arena.alloc(arena_ast::TryCatchStmt {
                body: av_stmts(arena, &t.body),
                catches: {
                    let mut v = arena_ast::ArenaVec::with_capacity_in(t.catches.len(), arena);
                    for c in t.catches.iter() {
                        let mut types = arena_ast::ArenaVec::with_capacity_in(c.types.len(), arena);
                        for n in c.types.iter() {
                            types.push(av_name(arena, n));
                        }
                        v.push(arena_ast::CatchClause {
                            types,
                            var: c.var.as_deref().map(|s| av_str(arena, s)),
                            body: av_stmts(arena, &c.body),
                            span: c.span,
                        });
                    }
                    v
                },
                finally: t.finally.as_ref().map(|stmts| av_stmts(arena, stmts)),
            }))
        }
        StmtKind::Global(exprs) => arena_ast::StmtKind::Global(av_exprs(arena, exprs)),
        StmtKind::Class(cls) => arena_ast::StmtKind::Class(arena.alloc(av_class_decl(arena, cls))),
        StmtKind::Interface(iface) => {
            arena_ast::StmtKind::Interface(arena.alloc(av_interface_decl(arena, iface)))
        }
        StmtKind::Trait(tr) => arena_ast::StmtKind::Trait(arena.alloc(av_trait_decl(arena, tr))),
        StmtKind::Enum(en) => arena_ast::StmtKind::Enum(arena.alloc(av_enum_decl(arena, en))),
        StmtKind::Namespace(ns) => {
            arena_ast::StmtKind::Namespace(arena.alloc(arena_ast::NamespaceDecl {
                name: ns.name.as_ref().map(|n| av_name(arena, n)),
                body: match &ns.body {
                    NamespaceBody::Braced(stmts) => {
                        arena_ast::NamespaceBody::Braced(av_stmts(arena, stmts))
                    }
                    NamespaceBody::Simple => arena_ast::NamespaceBody::Simple,
                },
            }))
        }
        StmtKind::Use(u) => arena_ast::StmtKind::Use(arena.alloc(arena_ast::UseDecl {
            kind: u.kind,
            uses: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(u.uses.len(), arena);
                for item in u.uses.iter() {
                    v.push(arena_ast::UseItem {
                        name: av_name(arena, &item.name),
                        alias: item.alias.as_deref().map(|s| av_str(arena, s)),
                        kind: item.kind,
                        span: item.span,
                    });
                }
                v
            },
        })),
        StmtKind::Const(items) => {
            let mut v = arena_ast::ArenaVec::with_capacity_in(items.len(), arena);
            for item in items.iter() {
                v.push(arena_ast::ConstItem {
                    name: av_ident(arena, &item.name),
                    value: av_expr(arena, &item.value),
                    attributes: av_attrs(arena, &item.attributes),
                    span: item.span,
                    doc_comment: av_opt_comment(arena, &item.doc_comment),
                });
            }
            arena_ast::StmtKind::Const(v)
        }
        StmtKind::StaticVar(vars) => {
            let mut v = arena_ast::ArenaVec::with_capacity_in(vars.len(), arena);
            for var in vars.iter() {
                v.push(arena_ast::StaticVar {
                    name: av_ident(arena, &var.name),
                    default: var.default.as_ref().map(|e| av_expr(arena, e)),
                    span: var.span,
                });
            }
            arena_ast::StmtKind::StaticVar(v)
        }
        StmtKind::HaltCompiler(s) => arena_ast::StmtKind::HaltCompiler(av_str(arena, s)),
        StmtKind::Nop => arena_ast::StmtKind::Nop,
        StmtKind::InlineHtml(s) => arena_ast::StmtKind::InlineHtml(av_str(arena, s)),
        StmtKind::Error => arena_ast::StmtKind::Error,
    }
}

fn av_function_decl<'a>(
    arena: &'a bumpalo::Bump,
    f: &FunctionDecl,
) -> arena_ast::FunctionDecl<'a, 'a> {
    arena_ast::FunctionDecl {
        name: av_ident(arena, &f.name),
        params: av_params(arena, &f.params),
        body: av_stmts(arena, &f.body),
        return_type: f.return_type.as_ref().map(|t| av_type_hint(arena, t)),
        by_ref: f.by_ref,
        attributes: av_attrs(arena, &f.attributes),
        doc_comment: av_opt_comment(arena, &f.doc_comment),
    }
}

fn av_class_member<'a>(
    arena: &'a bumpalo::Bump,
    m: &ClassMember,
) -> arena_ast::ClassMember<'a, 'a> {
    arena_ast::ClassMember {
        kind: match &m.kind {
            ClassMemberKind::Property(p) => {
                arena_ast::ClassMemberKind::Property(arena_ast::PropertyDecl {
                    name: av_ident(arena, &p.name),
                    visibility: p.visibility,
                    set_visibility: p.set_visibility,
                    is_static: p.is_static,
                    is_readonly: p.is_readonly,
                    type_hint: p.type_hint.as_ref().map(|t| av_type_hint(arena, t)),
                    default: p.default.as_ref().map(|e| av_expr(arena, e)),
                    attributes: av_attrs(arena, &p.attributes),
                    hooks: av_hooks(arena, &p.hooks),
                    doc_comment: av_opt_comment(arena, &p.doc_comment),
                })
            }
            ClassMemberKind::Method(m) => {
                arena_ast::ClassMemberKind::Method(arena_ast::MethodDecl {
                    name: av_ident(arena, &m.name),
                    visibility: m.visibility,
                    is_static: m.is_static,
                    is_abstract: m.is_abstract,
                    is_final: m.is_final,
                    by_ref: m.by_ref,
                    params: av_params(arena, &m.params),
                    return_type: m.return_type.as_ref().map(|t| av_type_hint(arena, t)),
                    body: m.body.as_ref().map(|stmts| av_stmts(arena, stmts)),
                    attributes: av_attrs(arena, &m.attributes),
                    doc_comment: av_opt_comment(arena, &m.doc_comment),
                })
            }
            ClassMemberKind::ClassConst(c) => {
                arena_ast::ClassMemberKind::ClassConst(av_class_const(arena, c))
            }
            ClassMemberKind::TraitUse(t) => {
                arena_ast::ClassMemberKind::TraitUse(av_trait_use(arena, t))
            }
        },
        span: m.span,
    }
}

fn av_class_members<'a>(
    arena: &'a bumpalo::Bump,
    members: &[ClassMember],
) -> arena_ast::ArenaVec<'a, arena_ast::ClassMember<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(members.len(), arena);
    for m in members.iter() {
        v.push(av_class_member(arena, m));
    }
    v
}

fn av_class_const<'a>(
    arena: &'a bumpalo::Bump,
    c: &ClassConstDecl,
) -> arena_ast::ClassConstDecl<'a, 'a> {
    arena_ast::ClassConstDecl {
        name: av_ident(arena, &c.name),
        visibility: c.visibility,
        is_final: c.is_final,
        type_hint: c
            .type_hint
            .as_ref()
            .map(|th| arena.alloc(av_type_hint(arena, th)) as &_),
        value: av_expr(arena, &c.value),
        attributes: av_attrs(arena, &c.attributes),
        doc_comment: av_opt_comment(arena, &c.doc_comment),
    }
}

fn av_trait_use<'a>(arena: &'a bumpalo::Bump, t: &TraitUseDecl) -> arena_ast::TraitUseDecl<'a, 'a> {
    let mut traits = arena_ast::ArenaVec::with_capacity_in(t.traits.len(), arena);
    for n in t.traits.iter() {
        traits.push(av_name(arena, n));
    }
    let mut adaptations = arena_ast::ArenaVec::with_capacity_in(t.adaptations.len(), arena);
    for a in t.adaptations.iter() {
        adaptations.push(arena_ast::TraitAdaptation {
            kind: match &a.kind {
                TraitAdaptationKind::Precedence {
                    trait_name,
                    method,
                    insteadof,
                } => {
                    let mut instead = arena_ast::ArenaVec::with_capacity_in(insteadof.len(), arena);
                    for n in insteadof.iter() {
                        instead.push(av_name(arena, n));
                    }
                    arena_ast::TraitAdaptationKind::Precedence {
                        trait_name: av_name(arena, trait_name),
                        method: av_name(arena, method),
                        insteadof: instead,
                    }
                }
                TraitAdaptationKind::Alias {
                    trait_name,
                    method,
                    new_modifier,
                    new_name,
                } => arena_ast::TraitAdaptationKind::Alias {
                    trait_name: trait_name.as_ref().map(|n| av_name(arena, n)),
                    method: av_name(arena, method),
                    new_modifier: *new_modifier,
                    new_name: new_name.as_ref().map(|n| av_name(arena, n)),
                },
            },
            span: a.span,
        });
    }
    arena_ast::TraitUseDecl {
        traits,
        adaptations,
    }
}

fn av_class_decl<'a>(arena: &'a bumpalo::Bump, cls: &ClassDecl) -> arena_ast::ClassDecl<'a, 'a> {
    let mut implements = arena_ast::ArenaVec::with_capacity_in(cls.implements.len(), arena);
    for n in cls.implements.iter() {
        implements.push(av_name(arena, n));
    }
    arena_ast::ClassDecl {
        name: cls.name.as_ref().map(|ident| av_ident(arena, ident)),
        modifiers: cls.modifiers.clone(),
        extends: cls.extends.as_ref().map(|n| av_name(arena, n)),
        implements,
        members: av_class_members(arena, &cls.members),
        attributes: av_attrs(arena, &cls.attributes),
        doc_comment: av_opt_comment(arena, &cls.doc_comment),
    }
}

fn av_interface_decl<'a>(
    arena: &'a bumpalo::Bump,
    iface: &InterfaceDecl,
) -> arena_ast::InterfaceDecl<'a, 'a> {
    let mut extends = arena_ast::ArenaVec::with_capacity_in(iface.extends.len(), arena);
    for n in iface.extends.iter() {
        extends.push(av_name(arena, n));
    }
    arena_ast::InterfaceDecl {
        name: av_ident(arena, &iface.name),
        extends,
        members: av_class_members(arena, &iface.members),
        attributes: av_attrs(arena, &iface.attributes),
        doc_comment: av_opt_comment(arena, &iface.doc_comment),
    }
}

fn av_trait_decl<'a>(arena: &'a bumpalo::Bump, tr: &TraitDecl) -> arena_ast::TraitDecl<'a, 'a> {
    arena_ast::TraitDecl {
        name: av_ident(arena, &tr.name),
        members: av_class_members(arena, &tr.members),
        attributes: av_attrs(arena, &tr.attributes),
        doc_comment: av_opt_comment(arena, &tr.doc_comment),
    }
}

fn av_enum_decl<'a>(arena: &'a bumpalo::Bump, en: &EnumDecl) -> arena_ast::EnumDecl<'a, 'a> {
    let mut implements = arena_ast::ArenaVec::with_capacity_in(en.implements.len(), arena);
    for n in en.implements.iter() {
        implements.push(av_name(arena, n));
    }
    let mut members = arena_ast::ArenaVec::with_capacity_in(en.members.len(), arena);
    for m in en.members.iter() {
        members.push(arena_ast::EnumMember {
            kind: match &m.kind {
                EnumMemberKind::Case(c) => arena_ast::EnumMemberKind::Case(arena_ast::EnumCase {
                    name: av_ident(arena, &c.name),
                    value: c.value.as_ref().map(|e| av_expr(arena, e)),
                    attributes: av_attrs(arena, &c.attributes),
                    doc_comment: av_opt_comment(arena, &c.doc_comment),
                }),
                EnumMemberKind::Method(m) => {
                    arena_ast::EnumMemberKind::Method(arena_ast::MethodDecl {
                        name: av_ident(arena, &m.name),
                        visibility: m.visibility,
                        is_static: m.is_static,
                        is_abstract: m.is_abstract,
                        is_final: m.is_final,
                        by_ref: m.by_ref,
                        params: av_params(arena, &m.params),
                        return_type: m.return_type.as_ref().map(|t| av_type_hint(arena, t)),
                        body: m.body.as_ref().map(|stmts| av_stmts(arena, stmts)),
                        attributes: av_attrs(arena, &m.attributes),
                        doc_comment: av_opt_comment(arena, &m.doc_comment),
                    })
                }
                EnumMemberKind::ClassConst(c) => {
                    arena_ast::EnumMemberKind::ClassConst(av_class_const(arena, c))
                }
                EnumMemberKind::TraitUse(t) => {
                    arena_ast::EnumMemberKind::TraitUse(av_trait_use(arena, t))
                }
            },
            span: m.span,
        });
    }
    arena_ast::EnumDecl {
        name: av_ident(arena, &en.name),
        scalar_type: en.scalar_type.as_ref().map(|n| av_name(arena, n)),
        implements,
        members,
        attributes: av_attrs(arena, &en.attributes),
        doc_comment: av_opt_comment(arena, &en.doc_comment),
    }
}
