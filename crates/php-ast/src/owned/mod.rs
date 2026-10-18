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
//! Call `php_rs_parser::parse()` — it returns a `php_rs_parser::ParseResult`
//! whose `.program` field is an owned [`Program`]. To convert an
//! arena-allocated [`Program`](crate::ast::Program) directly, use
//! [`to_owned_program`].

pub mod fold;
pub mod visitor;

pub use fold::{
    fold_owned_arg, fold_owned_attribute, fold_owned_block, fold_owned_catch_clause,
    fold_owned_class_member, fold_owned_closure_use_var, fold_owned_enum_member, fold_owned_expr,
    fold_owned_match_arm, fold_owned_name, fold_owned_param, fold_owned_program,
    fold_owned_property_hook, fold_owned_stmt, fold_owned_trait_adaptation, fold_owned_trait_use,
    fold_owned_type_hint, FoldOwned,
};
pub use visitor::{
    walk_owned_arg, walk_owned_attribute, walk_owned_block, walk_owned_catch_clause,
    walk_owned_class_member, walk_owned_comments, walk_owned_enum_member, walk_owned_expr,
    walk_owned_match_arm, walk_owned_name, walk_owned_param, walk_owned_program,
    walk_owned_property_hook, walk_owned_stmt, walk_owned_trait_adaptation, walk_owned_trait_use,
    walk_owned_type_hint, OwnedScope, OwnedScopeVisitor, OwnedScopeWalker, OwnedVisitor,
};

use std::fmt;

#[cfg(feature = "serde")]
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

#[cfg(feature = "serde")]
fn is_false(b: &bool) -> bool {
    !*b
}

#[cfg(feature = "serde")]
fn slice_is_empty<T>(v: &[T]) -> bool {
    v.is_empty()
}

/// Owned equivalent of [`Ident`](crate::ast::Ident), with the same API and serialized form.
#[derive(Clone, PartialEq, Eq, Hash)]
pub struct Ident {
    name: Option<Box<str>>,
    /// Source range of the identifier token; includes the `$` of a variable name.
    pub span: Span,
}

impl Ident {
    /// Construct an identifier from a non-empty name.
    pub fn new(name: impl Into<Box<str>>, span: Span) -> Self {
        let name = name.into();
        debug_assert!(!name.is_empty(), "Ident::new() called with empty name");
        Self {
            name: Some(name),
            span,
        }
    }

    /// Placeholder for "no identifier was parsed" at `span`.
    pub const fn error(span: Span) -> Self {
        Self { name: None, span }
    }

    /// Returns `Some(s)` for a real identifier, `None` for the error state.
    pub fn as_str(&self) -> Option<&str> {
        self.name.as_deref()
    }

    /// Returns `true` if this identifier was synthesised during error recovery.
    pub fn is_error(&self) -> bool {
        self.name.is_none()
    }

    /// Returns the inner string, or `"<error>"` for the error state.
    pub fn or_error(&self) -> &str {
        self.name.as_deref().unwrap_or("<error>")
    }
}

impl fmt::Debug for Ident {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        match &self.name {
            Some(s) => write!(f, "Ident({:?}, {:?})", s, self.span),
            None => write!(f, "Ident::error({:?})", self.span),
        }
    }
}

impl fmt::Display for Ident {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        f.write_str(self.or_error())
    }
}

#[cfg(feature = "serde")]
impl Serialize for Ident {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        use serde::ser::SerializeStruct;
        let Some(name) = &self.name else {
            return s.serialize_none();
        };
        let mut st = s.serialize_struct("Ident", 2)?;
        st.serialize_field("name", name)?;
        st.serialize_field("span", &self.span)?;
        st.end()
    }
}

impl PartialEq<&str> for Ident {
    fn eq(&self, other: &&str) -> bool {
        self.as_str() == Some(*other)
    }
}

// ---------------------------------------------------------------------------
// Name
//
// `Name<'arena, 'src>` has three variants (Simple, Complex, Error) and a
// custom Serialize that always emits `{"parts":[...],"kind":"...","span":{…}}`.
// The owned version flattens them into a single struct and derives Serialize —
// the JSON output is identical.
// ---------------------------------------------------------------------------

/// A possibly qualified PHP name.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Name {
    /// Name segments split on `\`.
    pub parts: Box<[Box<str>]>,
    /// Qualification style.
    pub kind: NameKind,
    /// Source span.
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Comment
// ---------------------------------------------------------------------------

/// A source comment.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Comment {
    /// Comment syntax.
    pub kind: CommentKind,
    /// Raw comment text including delimiters.
    pub text: Box<str>,
    /// Source span.
    pub span: Span,
}

// ---------------------------------------------------------------------------
// TypeHint / TypeHintKind
//
// `TypeHintKind::Keyword` has a custom Serialize that emits the same JSON as
// `Named`. We replicate that here.
// ---------------------------------------------------------------------------

/// A type declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TypeHint {
    /// Type shape.
    pub kind: TypeHintKind,
    /// Source span.
    pub span: Span,
}

/// The shape of a type declaration.
#[derive(Debug, Clone)]
#[non_exhaustive]
pub enum TypeHintKind {
    /// A class or other user-defined type name.
    Named(Name),
    /// Serialises as `Named` — see [`TypeHintKind::Keyword`](crate::ast::TypeHintKind::Keyword).
    Keyword(BuiltinType, Span),
    /// `?T`.
    Nullable(Box<TypeHint>),
    /// `A|B`.
    Union(Box<[TypeHint]>),
    /// `A&B`.
    Intersection(Box<[TypeHint]>),
}

#[cfg(feature = "serde")]
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

/// A call argument.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Arg {
    /// Name of a named argument.
    pub name: Option<Name>,
    /// `None` is a PHP 8.6 partial-application placeholder (`?`, or `...` when `unpack` is set).
    pub value: Option<Expr>,
    /// Whether the argument is spread with `...`.
    pub unpack: bool,
    /// Whether the argument is prefixed with `&`.
    pub by_ref: bool,
    /// Source span.
    pub span: Span,
}

/// A `#[...]` attribute.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Attribute {
    /// Attribute class name.
    pub name: Name,
    /// Arguments passed to the attribute.
    pub args: Box<[Arg]>,
    /// Source span.
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Program
// ---------------------------------------------------------------------------

/// Root of a parsed file.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Program {
    /// Top-level statements.
    pub stmts: Box<[Stmt]>,
    /// Source span.
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Stmt / StmtKind
// ---------------------------------------------------------------------------

/// A statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Stmt {
    /// Statement kind.
    pub kind: StmtKind,
    /// Source span.
    pub span: Span,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

impl Stmt {
    /// The leading `/** */` doc-block for this statement, regardless of where
    /// it is stored.  See [`crate::ast::Stmt::leading_doc_comment`] for the
    /// full contract.
    pub fn leading_doc_comment(&self) -> Option<&Comment> {
        if let Some(doc) = &self.doc_comment {
            return Some(doc);
        }
        match &self.kind {
            StmtKind::Function(f) => f.doc_comment.as_ref(),
            StmtKind::Class(c) => c.doc_comment.as_ref(),
            StmtKind::Interface(i) => i.doc_comment.as_ref(),
            StmtKind::Trait(t) => t.doc_comment.as_ref(),
            StmtKind::Enum(e) => e.doc_comment.as_ref(),
            StmtKind::Const(items) => items.first().and_then(|i| i.doc_comment.as_ref()),
            _ => None,
        }
    }
}

/// Owned mirror of [`crate::ast::Block`] — a brace-delimited statement block.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[cfg_attr(feature = "serde", serde(transparent))]
pub struct Block {
    /// Statements in the block.
    pub stmts: Box<[Stmt]>,
    /// Source span.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// The kind of a statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum StmtKind {
    /// An expression statement.
    Expression(Box<Expr>),
    /// `echo` with one or more expressions.
    Echo(Box<[Expr]>),
    /// `return` with optional value.
    Return(Option<Box<Expr>>),
    /// A nested block.
    Block(Box<Block>),
    /// An `if` statement.
    If(Box<IfStmt>),
    /// A `while` loop.
    While(Box<WhileStmt>),
    /// A `for` loop.
    For(Box<ForStmt>),
    /// A `foreach` loop.
    Foreach(Box<ForeachStmt>),
    /// A `do ... while` loop.
    DoWhile(Box<DoWhileStmt>),
    /// A function declaration.
    Function(Box<FunctionDecl>),
    /// `break` with optional level.
    Break(Option<Box<Expr>>),
    /// `continue` with optional level.
    Continue(Option<Box<Expr>>),
    /// A `switch` statement.
    Switch(Box<SwitchStmt>),
    /// `goto` with target label.
    Goto(Ident),
    /// A `label:` definition.
    Label(Ident),
    /// A `declare(...)` statement.
    Declare(Box<DeclareStmt>),
    /// `unset(...)` targets.
    Unset(Box<[Expr]>),
    /// A `throw` statement.
    Throw(Box<Expr>),
    /// A `try`/`catch`/`finally` statement.
    TryCatch(Box<TryCatchStmt>),
    /// `global` variables.
    Global(Box<[Expr]>),
    /// A class declaration.
    Class(Box<ClassDecl>),
    /// An interface declaration.
    Interface(Box<InterfaceDecl>),
    /// A trait declaration.
    Trait(Box<TraitDecl>),
    /// An enum declaration.
    Enum(Box<EnumDecl>),
    /// A namespace declaration.
    Namespace(Box<NamespaceDecl>),
    /// A `use` import.
    Use(Box<UseDecl>),
    /// A top-level `const` statement.
    Const(Box<[ConstItem]>),
    /// A `static` variable statement.
    StaticVar(Box<[StaticVar]>),
    /// `__halt_compiler()` with the trailing raw data.
    HaltCompiler(Box<str>),
    /// An empty statement (`;`).
    Nop,
    /// Text outside PHP tags.
    InlineHtml(Box<str>),
    /// Placeholder for a statement that failed to parse.
    Error,
}

/// An `if` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct IfStmt {
    /// The `if` condition.
    pub condition: Expr,
    /// Statement run when the condition holds.
    pub then_branch: Box<Stmt>,
    /// `elseif` branches in source order.
    pub elseif_branches: Box<[ElseIfBranch]>,
    /// The `else` statement, if any.
    pub else_branch: Option<Box<Stmt>>,
    /// The `else` keyword. Not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub else_kw_span: Option<Span>,
    /// Whether the `if: ... endif;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// An `elseif` branch.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ElseIfBranch {
    /// The `elseif` condition.
    pub condition: Expr,
    /// Statement run when the condition holds.
    pub body: Stmt,
    /// Source span.
    pub span: Span,
}

/// A `while` loop.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct WhileStmt {
    /// The loop condition.
    pub condition: Expr,
    /// The loop body.
    pub body: Box<Stmt>,
    /// Whether the `while: ... endwhile;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// A `for` loop.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ForStmt {
    /// Initializer expressions.
    pub init: Box<[Expr]>,
    /// Condition expressions.
    pub condition: Box<[Expr]>,
    /// Update expressions.
    pub update: Box<[Expr]>,
    /// The loop body.
    pub body: Box<Stmt>,
    /// Whether the `for: ... endfor;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// A `foreach` loop.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ForeachStmt {
    /// The iterated expression.
    pub expr: Expr,
    /// The key target, if any.
    pub key: Option<Expr>,
    /// The value target.
    pub value: Expr,
    /// The loop body.
    pub body: Box<Stmt>,
    /// Whether the `foreach: ... endforeach;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// A `do ... while` loop.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct DoWhileStmt {
    /// The loop body.
    pub body: Box<Stmt>,
    /// The loop condition.
    pub condition: Expr,
}

/// The braced body of a `switch`.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct SwitchBody {
    /// The cases in source order.
    pub cases: Box<[SwitchCase]>,
    /// Source span.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// A `switch` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct SwitchStmt {
    /// The switched-on expression.
    pub expr: Expr,
    /// The braced case list.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: SwitchBody,
    /// Whether the `switch: ... endswitch;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// A `case` or `default` arm.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct SwitchCase {
    /// Case value; `None` for `default`.
    pub value: Option<Expr>,
    /// Statements of the case.
    pub body: Box<[Stmt]>,
    /// Source span.
    pub span: Span,
}

/// A `try` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TryCatchStmt {
    /// The `try` block.
    pub body: Box<Block>,
    /// The `catch` clauses.
    pub catches: Box<[CatchClause]>,
    /// The `finally` block, if any.
    pub finally: Option<Box<Block>>,
    /// The `finally` keyword. Not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub finally_kw_span: Option<Span>,
}

/// A `catch` clause.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct CatchClause {
    /// Caught exception types (multi-catch allowed).
    pub types: Box<[Name]>,
    /// Bound variable name without `$`, if any.
    pub var: Option<Ident>,
    /// The `catch` block.
    pub body: Box<Block>,
    /// Source span.
    pub span: Span,
}

/// A `namespace` declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct NamespaceDecl {
    /// Namespace name; `None` for the global namespace.
    pub name: Option<Name>,
    /// Braced or simple form.
    pub body: NamespaceBody,
}

/// Whether a namespace is braced or statement-terminated.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum NamespaceBody {
    /// `namespace X { ... }`.
    Braced(Box<Block>),
    /// `namespace X;`.
    Simple,
}

/// A `declare(...)` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct DeclareStmt {
    /// Directive name and value pairs.
    pub directives: Box<[(Box<str>, Expr)]>,
    /// Statement governed by the declare, if any.
    pub body: Option<Box<Stmt>>,
    /// Whether the `declare: ... enddeclare;` syntax is used.
    #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
    pub uses_alternative: bool,
}

/// A `use` import declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UseDecl {
    /// Import kind (class, function or const).
    pub kind: UseKind,
    /// The imported items.
    pub uses: Box<[UseItem]>,
}

/// One imported name in a `use` declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UseItem {
    /// The imported name.
    pub name: Name,
    /// Local alias from `as`.
    pub alias: Option<Ident>,
    /// Per-item kind in a mixed group use.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub kind: Option<UseKind>,
    /// Source span.
    pub span: Span,
}

/// One item of a top-level `const` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ConstItem {
    /// Constant name.
    pub name: Ident,
    /// Constant value.
    pub value: Expr,
    /// Attributes on the constant.
    pub attributes: Box<[Attribute]>,
    /// Source span.
    pub span: Span,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// One variable of a `static` statement.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticVar {
    /// Variable name without `$`.
    pub name: Ident,
    /// Initial value, if any.
    pub default: Option<Expr>,
    /// Source span.
    pub span: Span,
}

// ---------------------------------------------------------------------------
// Expr / ExprKind
// ---------------------------------------------------------------------------

/// An expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Expr {
    /// Expression kind.
    pub kind: ExprKind,
    /// Source span.
    pub span: Span,
}

/// The kind of an expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ExprKind {
    /// Integer literal.
    Int(i64),
    /// Float literal.
    Float(f64),
    /// String literal without interpolation.
    String(Box<str>),
    /// Double-quoted string with interpolation.
    InterpolatedString(Box<[StringPart]>),
    /// Heredoc string.
    Heredoc {
        /// Heredoc delimiter.
        label: Box<str>,
        /// Body segments.
        parts: Box<[StringPart]>,
    },
    /// Nowdoc string.
    Nowdoc {
        /// Nowdoc delimiter.
        label: Box<str>,
        /// Raw body text.
        value: Box<str>,
    },
    /// Backtick shell command.
    ShellExec(Box<[StringPart]>),
    /// `true` or `false`.
    Bool(bool),
    /// `null`.
    Null,
    /// Variable name without `$`.
    Variable(Box<str>),
    /// `$$x` or `${expr}`.
    VariableVariable(Box<Expr>),
    /// Member name after `->`, `?->` or `::`.
    Identifier(Box<str>),
    /// Reference to a function, class or constant.
    Name(Name),
    /// Assignment.
    Assign(AssignExpr),
    /// Binary operation.
    Binary(BinaryExpr),
    /// Prefix unary operation.
    UnaryPrefix(UnaryPrefixExpr),
    /// Postfix unary operation.
    UnaryPostfix(UnaryPostfixExpr),
    /// Ternary conditional.
    Ternary(TernaryExpr),
    /// `??` expression.
    NullCoalesce(NullCoalesceExpr),
    /// Function call.
    FunctionCall(FunctionCallExpr),
    /// Array literal.
    Array(Box<[ArrayElement]>),
    /// Array offset access.
    ArrayAccess(ArrayAccessExpr),
    /// `print` expression.
    Print(Box<Expr>),
    /// Parenthesized expression.
    Parenthesized(Box<Expr>),
    /// Type cast.
    Cast(CastKind, Box<Expr>),
    /// `@` error suppression.
    ErrorSuppress(Box<Expr>),
    /// `isset(...)`.
    Isset(Box<[Expr]>),
    /// `empty(...)`.
    Empty(Box<Expr>),
    /// `include`/`require` variant.
    Include(IncludeKind, Box<Expr>),
    /// `eval(...)`.
    Eval(Box<Expr>),
    /// `exit`/`die` with optional argument.
    Exit(Option<Box<Expr>>),
    /// Magic constant such as `__LINE__`.
    MagicConst(MagicConstKind),
    /// `clone` expression.
    Clone(Box<Expr>),
    /// `clone` with property overrides.
    CloneWith(Box<Expr>, Box<Expr>),
    /// `new` expression.
    New(NewExpr),
    /// `->` property access.
    PropertyAccess(PropertyAccessExpr),
    /// `?->` property access.
    NullsafePropertyAccess(PropertyAccessExpr),
    /// `->` method call.
    MethodCall(Box<MethodCallExpr>),
    /// `?->` method call.
    NullsafeMethodCall(Box<MethodCallExpr>),
    /// `Class::$prop` access.
    StaticPropertyAccess(StaticAccessExpr),
    /// `Class::method()` call.
    StaticMethodCall(Box<StaticMethodCallExpr>),
    /// `Class::$method()` call.
    StaticMethodCallDynamic(Box<StaticMethodCallDynamicExpr>),
    /// `Class::CONST` access.
    ClassConstAccess(StaticAccessExpr),
    /// `Class::{expr}` constant access.
    ClassConstAccessDynamic {
        /// Class expression.
        class: Box<Expr>,
        /// Constant name expression.
        member: Box<Expr>,
    },
    /// `Class::$$member` property access.
    StaticPropertyAccessDynamic {
        /// Class expression.
        class: Box<Expr>,
        /// Property name expression.
        member: Box<Expr>,
    },
    /// Anonymous function.
    Closure(Box<ClosureExpr>),
    /// Arrow function.
    ArrowFunction(Box<ArrowFunctionExpr>),
    /// `match` expression.
    Match(MatchExpr),
    /// `throw` used as an expression.
    Throw(Box<Expr>),
    /// `yield` expression.
    Yield(YieldExpr),
    /// `new class { ... }`.
    AnonymousClass(Box<ClassDecl>),
    /// First-class callable syntax.
    CallableCreate(CallableCreateExpr),
    /// Skipped slot in a list destructuring pattern.
    Omit,
    /// Placeholder for an expression that failed to parse.
    Error,
}

// ---------------------------------------------------------------------------
// Expression chains
//
// The parser builds left-associative operator chains and postfix chains
// (`$a . $b . …`, `$x->a()->b()…`, `$a[0][1]…`) in a loop rather than by
// recursion, so their length is limited only by the input. Converting or
// dropping such a chain one recursive call per link would overflow the stack,
// so these helpers expose the operand each link continues from and the
// conversions and `Drop` walk it iteratively. The `*_is_chain`,
// `*_chain_operand*` and `*_link_kind` functions must agree on the variants and
// on which field is the operand.
// ---------------------------------------------------------------------------

impl Drop for Expr {
    #[inline(always)]
    fn drop(&mut self) {
        // Only the bit test is inlined into the drop glue of every expression.
        if owned_is_chain(&self.kind) {
            unlink_chain(&mut self.kind);
        }
    }
}

/// Detach the chain below the link `kind` so that it is dropped iteratively.
#[inline(never)]
fn unlink_chain(kind: &mut ExprKind) {
    let Some(operand) = owned_chain_operand_mut(kind) else {
        return;
    };
    // A single link drops fine recursively, and most chains are that short.
    if !owned_is_chain(&operand.kind) {
        return;
    }
    // Detach each operand's kind before the node holding it is dropped, so
    // every drop below only sees a shallow `Error` in the chain position.
    let mut kind = std::mem::replace(&mut operand.kind, ExprKind::Error);
    while let Some(operand) = owned_chain_operand_mut(&mut kind) {
        let next = std::mem::replace(&mut operand.kind, ExprKind::Error);
        kind = next;
    }
}

/// A stack of chain links that only allocates for chains longer than its
/// inline capacity; almost every chain in real code fits.
struct LinkStack<T: Copy> {
    inline: [Option<T>; 8],
    len: usize,
    spilled: Vec<T>,
}

impl<T: Copy> LinkStack<T> {
    fn new() -> Self {
        Self {
            inline: [None; 8],
            len: 0,
            spilled: Vec::new(),
        }
    }

    fn push(&mut self, link: T) {
        if self.len < self.inline.len() {
            self.inline[self.len] = Some(link);
            self.len += 1;
        } else {
            self.spilled.push(link);
        }
    }

    fn pop(&mut self) -> Option<T> {
        if let Some(link) = self.spilled.pop() {
            return Some(link);
        }
        self.len = self.len.checked_sub(1)?;
        self.inline[self.len]
    }
}

/// Whether `k` is a chain node. Cheaper than [`arena_chain_operand`] (a bit
/// test rather than a jump table), so leaves take the fast path.
#[inline]
fn arena_is_chain(k: &arena_ast::ExprKind<'_, '_>) -> bool {
    matches!(
        k,
        arena_ast::ExprKind::Assign(_)
            | arena_ast::ExprKind::Binary(_)
            | arena_ast::ExprKind::UnaryPostfix(_)
            | arena_ast::ExprKind::Ternary(_)
            | arena_ast::ExprKind::NullCoalesce(_)
            | arena_ast::ExprKind::FunctionCall(_)
            | arena_ast::ExprKind::ArrayAccess(_)
            | arena_ast::ExprKind::PropertyAccess(_)
            | arena_ast::ExprKind::NullsafePropertyAccess(_)
            | arena_ast::ExprKind::MethodCall(_)
            | arena_ast::ExprKind::NullsafeMethodCall(_)
            | arena_ast::ExprKind::StaticPropertyAccess(_)
            | arena_ast::ExprKind::ClassConstAccess(_)
            | arena_ast::ExprKind::StaticMethodCall(_)
            | arena_ast::ExprKind::StaticMethodCallDynamic(_)
            | arena_ast::ExprKind::ClassConstAccessDynamic { .. }
            | arena_ast::ExprKind::StaticPropertyAccessDynamic { .. }
            | arena_ast::ExprKind::CallableCreate(_)
    )
}

/// Whether `k` is a chain node; see [`arena_is_chain`].
#[inline]
fn owned_is_chain(k: &ExprKind) -> bool {
    matches!(
        k,
        ExprKind::Assign(_)
            | ExprKind::Binary(_)
            | ExprKind::UnaryPostfix(_)
            | ExprKind::Ternary(_)
            | ExprKind::NullCoalesce(_)
            | ExprKind::FunctionCall(_)
            | ExprKind::ArrayAccess(_)
            | ExprKind::PropertyAccess(_)
            | ExprKind::NullsafePropertyAccess(_)
            | ExprKind::MethodCall(_)
            | ExprKind::NullsafeMethodCall(_)
            | ExprKind::StaticPropertyAccess(_)
            | ExprKind::ClassConstAccess(_)
            | ExprKind::StaticMethodCall(_)
            | ExprKind::StaticMethodCallDynamic(_)
            | ExprKind::ClassConstAccessDynamic { .. }
            | ExprKind::StaticPropertyAccessDynamic { .. }
            | ExprKind::CallableCreate(_)
    )
}

#[inline]
fn arena_chain_operand<'a, 'arena, 'src>(
    k: &'a arena_ast::ExprKind<'arena, 'src>,
) -> Option<&'a arena_ast::Expr<'arena, 'src>> {
    use arena_ast::{CallableCreateKind as C, ExprKind as K};
    match k {
        K::Assign(a) => Some(a.target),
        K::Binary(b) => Some(b.left),
        K::UnaryPostfix(u) => Some(u.operand),
        K::Ternary(t) => Some(t.condition),
        K::NullCoalesce(n) => Some(n.left),
        K::FunctionCall(f) => Some(f.name),
        K::ArrayAccess(a) => Some(a.array),
        K::PropertyAccess(p) | K::NullsafePropertyAccess(p) => Some(p.object),
        K::MethodCall(m) | K::NullsafeMethodCall(m) => Some(m.object),
        K::StaticPropertyAccess(s) | K::ClassConstAccess(s) => Some(s.class),
        K::StaticMethodCall(s) => Some(s.class),
        K::StaticMethodCallDynamic(s) => Some(s.class),
        K::ClassConstAccessDynamic { class, .. } | K::StaticPropertyAccessDynamic { class, .. } => {
            Some(class)
        }
        K::CallableCreate(c) => Some(match &c.kind {
            C::Function(e) => e,
            C::Method { object, .. } | C::NullsafeMethod { object, .. } => object,
            C::StaticMethod { class, .. } => class,
        }),
        _ => None,
    }
}

#[inline]
fn owned_chain_operand(k: &ExprKind) -> Option<&Expr> {
    use CallableCreateKind as C;
    match k {
        ExprKind::Assign(a) => Some(&a.target),
        ExprKind::Binary(b) => Some(&b.left),
        ExprKind::UnaryPostfix(u) => Some(&u.operand),
        ExprKind::Ternary(t) => Some(&t.condition),
        ExprKind::NullCoalesce(n) => Some(&n.left),
        ExprKind::FunctionCall(f) => Some(&f.name),
        ExprKind::ArrayAccess(a) => Some(&a.array),
        ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => Some(&p.object),
        ExprKind::MethodCall(m) | ExprKind::NullsafeMethodCall(m) => Some(&m.object),
        ExprKind::StaticPropertyAccess(s) | ExprKind::ClassConstAccess(s) => Some(&s.class),
        ExprKind::StaticMethodCall(s) => Some(&s.class),
        ExprKind::StaticMethodCallDynamic(s) => Some(&s.class),
        ExprKind::ClassConstAccessDynamic { class, .. }
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => Some(class),
        ExprKind::CallableCreate(c) => Some(match &c.kind {
            C::Function(e) => e,
            C::Method { object, .. } | C::NullsafeMethod { object, .. } => object,
            C::StaticMethod { class, .. } => class,
        }),
        _ => None,
    }
}

#[inline]
fn owned_chain_operand_mut(k: &mut ExprKind) -> Option<&mut Expr> {
    use CallableCreateKind as C;
    match k {
        ExprKind::Assign(a) => Some(&mut a.target),
        ExprKind::Binary(b) => Some(&mut b.left),
        ExprKind::UnaryPostfix(u) => Some(&mut u.operand),
        ExprKind::Ternary(t) => Some(&mut t.condition),
        ExprKind::NullCoalesce(n) => Some(&mut n.left),
        ExprKind::FunctionCall(f) => Some(&mut f.name),
        ExprKind::ArrayAccess(a) => Some(&mut a.array),
        ExprKind::PropertyAccess(p) | ExprKind::NullsafePropertyAccess(p) => Some(&mut p.object),
        ExprKind::MethodCall(m) | ExprKind::NullsafeMethodCall(m) => Some(&mut m.object),
        ExprKind::StaticPropertyAccess(s) | ExprKind::ClassConstAccess(s) => Some(&mut s.class),
        ExprKind::StaticMethodCall(s) => Some(&mut s.class),
        ExprKind::StaticMethodCallDynamic(s) => Some(&mut s.class),
        ExprKind::ClassConstAccessDynamic { class, .. }
        | ExprKind::StaticPropertyAccessDynamic { class, .. } => Some(class),
        ExprKind::CallableCreate(c) => Some(match &mut c.kind {
            C::Function(e) => e,
            C::Method { object, .. } | C::NullsafeMethod { object, .. } => object,
            C::StaticMethod { class, .. } => class,
        }),
        _ => None,
    }
}

/// An assignment.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct AssignExpr {
    /// Assignment target.
    pub target: Box<Expr>,
    /// Assignment operator.
    pub op: AssignOp,
    /// Assigned value.
    pub value: Box<Expr>,
    /// Whether this is a reference assignment (`=&`).
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub by_ref: bool,
}

/// A binary operation.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct BinaryExpr {
    /// Left operand.
    pub left: Box<Expr>,
    /// Operator.
    pub op: BinaryOp,
    /// Right operand.
    pub right: Box<Expr>,
}

/// A prefix unary operation.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UnaryPrefixExpr {
    /// Operator.
    pub op: UnaryPrefixOp,
    /// Operand.
    pub operand: Box<Expr>,
}

/// A postfix unary operation.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UnaryPostfixExpr {
    /// Operand.
    pub operand: Box<Expr>,
    /// Operator.
    pub op: UnaryPostfixOp,
}

/// A ternary or short-ternary conditional.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TernaryExpr {
    /// Condition.
    pub condition: Box<Expr>,
    /// Value when true; `None` for `?:`.
    pub then_expr: Option<Box<Expr>>,
    /// Value when false.
    pub else_expr: Box<Expr>,
}

/// A `??` expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct NullCoalesceExpr {
    /// Value tested for null.
    pub left: Box<Expr>,
    /// Fallback value.
    pub right: Box<Expr>,
}

/// A function call.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct FunctionCallExpr {
    /// Callee expression.
    pub name: Box<Expr>,
    /// Call arguments.
    pub args: Box<[Arg]>,
}

/// An element of an array literal.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ArrayElement {
    /// Key expression, if any.
    pub key: Option<Expr>,
    /// Element value.
    pub value: Expr,
    /// Whether the element is spread with `...`.
    pub unpack: bool,
    /// Whether the value is taken by reference.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub by_ref: bool,
    /// Source span.
    pub span: Span,
}

/// An array offset access.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ArrayAccessExpr {
    /// Accessed expression.
    pub array: Box<Expr>,
    /// Offset; `None` for `$a[]`.
    pub index: Option<Box<Expr>>,
}

/// A `new` expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct NewExpr {
    /// Class name or expression.
    pub class: Box<Expr>,
    /// Constructor arguments.
    pub args: Box<[Arg]>,
}

/// A `->` or `?->` property access.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct PropertyAccessExpr {
    /// Object expression.
    pub object: Box<Expr>,
    /// Property name or expression.
    pub property: Box<Expr>,
}

/// A `->` or `?->` method call.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct MethodCallExpr {
    /// Object expression.
    pub object: Box<Expr>,
    /// Method name or expression.
    pub method: Box<Expr>,
    /// Call arguments.
    pub args: Box<[Arg]>,
}

/// A `::` static property or constant access.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticAccessExpr {
    /// Class expression.
    pub class: Box<Expr>,
    /// Member name or expression.
    pub member: Box<Expr>,
}

/// A `Class::method()` call.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticMethodCallExpr {
    /// Class expression.
    pub class: Box<Expr>,
    /// Method name.
    pub method: Box<Expr>,
    /// Call arguments.
    pub args: Box<[Arg]>,
}

/// A static call with a dynamic method expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticMethodCallDynamicExpr {
    /// Class expression.
    pub class: Box<Expr>,
    /// Method name expression.
    pub method: Box<Expr>,
    /// Call arguments.
    pub args: Box<[Arg]>,
}

/// An anonymous function.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClosureExpr {
    /// Whether declared `static`.
    pub is_static: bool,
    /// Whether it returns by reference.
    pub by_ref: bool,
    /// Parameters.
    pub params: Box<[Param]>,
    /// Captured variables.
    pub use_vars: Box<[ClosureUseVar]>,
    /// Declared return type.
    pub return_type: Option<TypeHint>,
    /// Function body.
    pub body: Box<Block>,
    /// Attributes on the closure.
    pub attributes: Box<[Attribute]>,
}

/// A variable captured by a closure `use` clause.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClosureUseVar {
    /// Captured variable name without `$`.
    pub name: Ident,
    /// Whether captured by reference.
    pub by_ref: bool,
    /// Source span.
    pub span: Span,
}

/// An `fn` arrow function.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ArrowFunctionExpr {
    /// Whether declared `static`.
    pub is_static: bool,
    /// Whether it returns by reference.
    pub by_ref: bool,
    /// Parameters.
    pub params: Box<[Param]>,
    /// Declared return type.
    pub return_type: Option<TypeHint>,
    /// Result expression.
    pub body: Box<Expr>,
    /// Attributes on the arrow function.
    pub attributes: Box<[Attribute]>,
}

/// A `match` expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct MatchExpr {
    /// Matched expression.
    pub subject: Box<Expr>,
    /// Match arms.
    pub arms: Box<[MatchArm]>,
    /// The opening `{`. Not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub brace_span: Span,
}

/// An arm of a `match` expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct MatchArm {
    /// Conditions; `None` for `default`.
    pub conditions: Option<Box<[Expr]>>,
    /// Result expression.
    pub body: Expr,
    /// Source span.
    pub span: Span,
}

/// A `yield` or `yield from` expression.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct YieldExpr {
    /// Yielded key, if any.
    pub key: Option<Box<Expr>>,
    /// Yielded value, if any.
    pub value: Option<Box<Expr>>,
    /// Whether this is `yield from`.
    pub is_from: bool,
}

/// A first-class callable, e.g. `f(...)`.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct CallableCreateExpr {
    /// The callee.
    pub kind: CallableCreateKind,
}

/// The callee of a first-class callable.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum CallableCreateKind {
    /// `f(...)`.
    Function(Box<Expr>),
    /// `$obj->method(...)`.
    Method {
        /// Object expression.
        object: Box<Expr>,
        /// Method name or expression.
        method: Box<Expr>,
    },
    /// `$obj?->method(...)`.
    NullsafeMethod {
        /// Object expression.
        object: Box<Expr>,
        /// Method name or expression.
        method: Box<Expr>,
    },
    /// `Class::method(...)`.
    StaticMethod {
        /// Class expression.
        class: Box<Expr>,
        /// Method name or expression.
        method: Box<Expr>,
    },
}

/// A segment of an interpolated string.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum StringPart {
    /// Literal text.
    Literal(Box<str>),
    /// Interpolated expression.
    Expr(Expr),
}

// ---------------------------------------------------------------------------
// Owned declaration types
// ---------------------------------------------------------------------------

/// A function declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct FunctionDecl {
    /// Function name.
    pub name: Ident,
    /// Parameters.
    pub params: Box<[Param]>,
    /// Function body.
    pub body: Box<Block>,
    /// Declared return type.
    pub return_type: Option<TypeHint>,
    /// Whether it returns by reference.
    pub by_ref: bool,
    /// Attributes on the function.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A function or method parameter.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct Param {
    /// Parameter name without `$`.
    pub name: Ident,
    /// Declared type.
    pub type_hint: Option<TypeHint>,
    /// Default value.
    pub default: Option<Expr>,
    /// Whether passed by reference.
    pub by_ref: bool,
    /// Whether variadic (`...`).
    pub variadic: bool,
    /// Whether a `readonly` promoted property.
    pub is_readonly: bool,
    /// Whether a `final` promoted property.
    pub is_final: bool,
    /// Promotion visibility.
    pub visibility: Option<Visibility>,
    /// Asymmetric set visibility of a promoted property.
    pub set_visibility: Option<Visibility>,
    /// Attributes on the parameter.
    pub attributes: Box<[Attribute]>,
    /// Property hooks of a promoted property.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "slice_is_empty"))]
    pub hooks: Box<[PropertyHook]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
    /// Source span.
    pub span: Span,
}

impl Param {
    /// A parameter with `name` and `span` set and every other field empty.
    /// The fields are public, so set the rest by assignment; `Param` is
    /// `#[non_exhaustive]` and cannot be built with a struct literal outside
    /// this crate.
    pub fn new(name: Ident, span: Span) -> Self {
        Self {
            name,
            type_hint: None,
            default: None,
            by_ref: false,
            variadic: false,
            is_readonly: false,
            is_final: false,
            visibility: None,
            set_visibility: None,
            attributes: Box::new([]),
            hooks: Box::new([]),
            doc_comment: None,
            span,
        }
    }
}

/// The braced member list of a class-like declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassBody {
    /// Members in source order.
    pub members: Box<[ClassMember]>,
    /// Source span.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// A class declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassDecl {
    /// Class name; `None` for anonymous classes.
    pub name: Option<Ident>,
    /// Class modifiers.
    pub modifiers: ClassModifiers,
    /// Parent class.
    pub extends: Option<Name>,
    /// Implemented interfaces.
    pub implements: Box<[Name]>,
    /// Class body.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody,
    /// Attributes on the class.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A member of a class-like body.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassMember {
    /// Member kind.
    pub kind: ClassMemberKind,
    /// Source span.
    pub span: Span,
}

/// The kind of a class member.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ClassMemberKind {
    /// Property declaration.
    Property(PropertyDecl),
    /// Method declaration.
    Method(MethodDecl),
    /// Class constant declaration.
    ClassConst(ClassConstDecl),
    /// Trait use clause.
    TraitUse(TraitUseDecl),
}

/// A property declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct PropertyDecl {
    /// Property name without `$`.
    pub name: Ident,
    /// Read visibility.
    pub visibility: Option<Visibility>,
    /// Asymmetric set visibility.
    pub set_visibility: Option<Visibility>,
    /// Whether `static`.
    pub is_static: bool,
    /// Whether `readonly`.
    pub is_readonly: bool,
    /// Whether `final`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub is_final: bool,
    /// Whether `abstract`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub is_abstract: bool,
    /// Declared type.
    pub type_hint: Option<TypeHint>,
    /// Default value.
    pub default: Option<Expr>,
    /// Attributes on the property.
    pub attributes: Box<[Attribute]>,
    /// Property hooks.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "slice_is_empty"))]
    pub hooks: Box<[PropertyHook]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A property `get` or `set` hook.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct PropertyHook {
    /// `get` or `set`.
    pub kind: PropertyHookKind,
    /// Hook body.
    pub body: PropertyHookBody,
    /// Whether `final`.
    pub is_final: bool,
    /// Whether it returns by reference.
    pub by_ref: bool,
    /// Parameters of a `set` hook.
    pub params: Box<[Param]>,
    /// Attributes on the hook.
    pub attributes: Box<[Attribute]>,
    /// Source span.
    pub span: Span,
}

/// The body of a property hook.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum PropertyHookBody {
    /// Braced body.
    Block(Box<Block>),
    /// Arrow expression body (`=> expr`).
    Expression(Expr),
    /// No body (`;`).
    Abstract,
}

/// A method declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct MethodDecl {
    /// Method name.
    pub name: Ident,
    /// Visibility modifier.
    pub visibility: Option<Visibility>,
    /// Whether `static`.
    pub is_static: bool,
    /// Whether `abstract`.
    pub is_abstract: bool,
    /// Whether `final`.
    pub is_final: bool,
    /// Whether it returns by reference.
    pub by_ref: bool,
    /// Parameters.
    pub params: Box<[Param]>,
    /// Declared return type.
    pub return_type: Option<TypeHint>,
    /// Method body; `None` for abstract or interface methods.
    pub body: Option<Box<Block>>,
    /// Attributes on the method.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

impl MethodDecl {
    /// A method with `name` set and every other field empty. Set the rest by
    /// assignment; see [`Param::new`].
    pub fn new(name: Ident) -> Self {
        Self {
            name,
            visibility: None,
            is_static: false,
            is_abstract: false,
            is_final: false,
            by_ref: false,
            params: Box::new([]),
            return_type: None,
            body: None,
            attributes: Box::new([]),
            doc_comment: None,
        }
    }
}

/// A class constant declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClassConstDecl {
    /// Constant name.
    pub name: Ident,
    /// Visibility modifier.
    pub visibility: Option<Visibility>,
    /// Whether `final`.
    pub is_final: bool,
    /// Declared type.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub type_hint: Option<Box<TypeHint>>,
    /// Constant value.
    pub value: Expr,
    /// Attributes on the constant.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A `use Trait;` clause inside a class.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TraitUseDecl {
    /// Used traits.
    pub traits: Box<[Name]>,
    /// Rules in the `{ ... }` block.
    pub adaptations: Box<[TraitAdaptation]>,
    /// The opening `{` of the adaptations block. Not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub adaptations_brace_span: Option<Span>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A `insteadof` or `as` rule in a trait use.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TraitAdaptation {
    /// Rule kind.
    pub kind: TraitAdaptationKind,
    /// Source span.
    pub span: Span,
}

/// The kind of trait adaptation rule.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum TraitAdaptationKind {
    /// `A::m insteadof B;`.
    Precedence {
        /// Trait providing the method.
        trait_name: Name,
        /// Method name.
        method: Name,
        /// Traits whose method is excluded.
        insteadof: Box<[Name]>,
    },
    /// `m as [visibility] [alias];`.
    Alias {
        /// Explicit trait qualifier, if any.
        trait_name: Option<Name>,
        /// Method name.
        method: Name,
        /// New visibility, if any.
        new_modifier: Option<Visibility>,
        /// `true` for `m as final alias;` (PHP 8.3+).
        #[cfg_attr(feature = "serde", serde(default, skip_serializing_if = "is_false"))]
        is_final: bool,
        /// Alias name, if any.
        new_name: Option<Name>,
    },
}

/// An interface declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct InterfaceDecl {
    /// Interface name.
    pub name: Ident,
    /// Extended interfaces.
    pub extends: Box<[Name]>,
    /// Interface body.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody,
    /// Attributes on the interface.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A trait declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TraitDecl {
    /// Trait name.
    pub name: Ident,
    /// Trait body.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: ClassBody,
    /// Attributes on the trait.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// The braced member list of an enum.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumBody {
    /// Members in source order.
    pub members: Box<[EnumMember]>,
    /// Source span.
    #[cfg_attr(feature = "serde", serde(skip))]
    pub span: Span,
}

/// An enum declaration.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumDecl {
    /// Enum name.
    pub name: Ident,
    /// Backing type of a backed enum.
    pub scalar_type: Option<Name>,
    /// Implemented interfaces.
    pub implements: Box<[Name]>,
    /// Enum body.
    #[cfg_attr(feature = "serde", serde(flatten))]
    pub body: EnumBody,
    /// Attributes on the enum.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

/// A member of an enum body.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumMember {
    /// Member kind.
    pub kind: EnumMemberKind,
    /// Source span.
    pub span: Span,
}

/// The kind of an enum member.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum EnumMemberKind {
    /// Enum case.
    Case(EnumCase),
    /// Method declaration.
    Method(MethodDecl),
    /// Class constant declaration.
    ClassConst(ClassConstDecl),
    /// Trait use clause.
    TraitUse(TraitUseDecl),
}

/// An enum `case`.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct EnumCase {
    /// Case name.
    pub name: Ident,
    /// Backing value.
    pub value: Option<Expr>,
    /// Attributes on the case.
    pub attributes: Box<[Attribute]>,
    /// Preceding doc comment.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "Option::is_none"))]
    pub doc_comment: Option<Comment>,
}

// ===========================================================================
// Conversion functions
// ===========================================================================

fn owned_ident(ident: arena_ast::Ident<'_>) -> Ident {
    match ident.as_str() {
        Some(s) => Ident::new(s, ident.span),
        None => Ident::error(ident.span),
    }
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
        value: arg.value.as_ref().map(owned_expr),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

#[inline(never)]
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

#[inline(never)]
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

#[inline]
fn owned_expr(expr: &arena_ast::Expr<'_, '_>) -> Expr {
    if !arena_is_chain(&expr.kind) {
        return Expr {
            kind: owned_leaf_kind(&expr.kind),
            span: expr.span,
        };
    }
    owned_chain_expr(expr)
}

/// Convert a chain bottom-up from an explicit stack: its length is set by the
/// input, so recursing once per link could overflow the stack.
#[inline(never)]
fn owned_chain_expr(expr: &arena_ast::Expr<'_, '_>) -> Expr {
    let first = arena_chain_operand(&expr.kind).expect("chain link has an operand");
    if !arena_is_chain(&first.kind) {
        // A single link, by far the most common chain: no stack needed.
        let operand = Expr {
            kind: owned_leaf_kind(&first.kind),
            span: first.span,
        };
        return Expr {
            kind: owned_link_kind(&expr.kind, operand),
            span: expr.span,
        };
    }
    let mut chain = LinkStack::new();
    chain.push(expr);
    let mut leaf = first;
    while let Some(operand) = arena_chain_operand(&leaf.kind) {
        chain.push(leaf);
        leaf = operand;
    }
    let mut converted = Expr {
        kind: owned_leaf_kind(&leaf.kind),
        span: leaf.span,
    };
    while let Some(node) = chain.pop() {
        converted = Expr {
            kind: owned_link_kind(&node.kind, converted),
            span: node.span,
        };
    }
    converted
}

#[inline(never)]
fn owned_exprs(exprs: &[arena_ast::Expr<'_, '_>]) -> Box<[Expr]> {
    exprs
        .iter()
        .map(owned_expr)
        .collect::<Vec<_>>()
        .into_boxed_slice()
}

/// Convert an expression kind that is not a chain link (see [`arena_chain_operand`]).
fn owned_leaf_kind(k: &arena_ast::ExprKind<'_, '_>) -> ExprKind {
    match k {
        arena_ast::ExprKind::Int(v) => ExprKind::Int(*v),
        arena_ast::ExprKind::Float(v) => ExprKind::Float(*v),
        arena_ast::ExprKind::String(s) => ExprKind::String(Box::from(s.as_str())),
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
        arena_ast::ExprKind::Name(name) => ExprKind::Name(owned_name(name)),
        arena_ast::ExprKind::UnaryPrefix(u) => ExprKind::UnaryPrefix(UnaryPrefixExpr {
            op: u.op,
            operand: Box::new(owned_expr(u.operand)),
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
        arena_ast::ExprKind::Closure(c) => ExprKind::Closure(Box::new(ClosureExpr {
            is_static: c.is_static,
            by_ref: c.by_ref,
            params: owned_params(&c.params),
            use_vars: c
                .use_vars
                .iter()
                .map(|v| ClosureUseVar {
                    name: owned_ident(v.name),
                    by_ref: v.by_ref,
                    span: v.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            return_type: c.return_type.as_ref().map(owned_type_hint),
            body: Box::new(owned_block(c.body)),
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
            brace_span: m.brace_span,
        }),
        arena_ast::ExprKind::Throw(e) => ExprKind::Throw(Box::new(owned_expr(e))),
        arena_ast::ExprKind::Yield(y) => ExprKind::Yield(YieldExpr {
            key: y.key.map(|e| Box::new(owned_expr(e))),
            value: y.value.map(|e| Box::new(owned_expr(e))),
            is_from: y.is_from,
        }),
        arena_ast::ExprKind::AnonymousClass(cls) => {
            ExprKind::AnonymousClass(Box::new(owned_class_decl(cls)))
        }
        arena_ast::ExprKind::Omit => ExprKind::Omit,
        arena_ast::ExprKind::Error => ExprKind::Error,
        arena_ast::ExprKind::Assign(_)
        | arena_ast::ExprKind::Binary(_)
        | arena_ast::ExprKind::UnaryPostfix(_)
        | arena_ast::ExprKind::Ternary(_)
        | arena_ast::ExprKind::NullCoalesce(_)
        | arena_ast::ExprKind::FunctionCall(_)
        | arena_ast::ExprKind::ArrayAccess(_)
        | arena_ast::ExprKind::PropertyAccess(_)
        | arena_ast::ExprKind::NullsafePropertyAccess(_)
        | arena_ast::ExprKind::MethodCall(_)
        | arena_ast::ExprKind::NullsafeMethodCall(_)
        | arena_ast::ExprKind::StaticPropertyAccess(_)
        | arena_ast::ExprKind::ClassConstAccess(_)
        | arena_ast::ExprKind::StaticMethodCall(_)
        | arena_ast::ExprKind::StaticMethodCallDynamic(_)
        | arena_ast::ExprKind::ClassConstAccessDynamic { .. }
        | arena_ast::ExprKind::StaticPropertyAccessDynamic { .. }
        | arena_ast::ExprKind::CallableCreate(_) => {
            unreachable!("chain links are converted by the link function")
        }
    }
}

/// Convert a chain link, given its already-converted chain operand.
fn owned_link_kind(k: &arena_ast::ExprKind<'_, '_>, operand: Expr) -> ExprKind {
    match k {
        arena_ast::ExprKind::Assign(a) => ExprKind::Assign(AssignExpr {
            target: Box::new(operand),
            op: a.op,
            value: Box::new(owned_expr(a.value)),
            by_ref: a.by_ref,
        }),
        arena_ast::ExprKind::Binary(b) => ExprKind::Binary(BinaryExpr {
            left: Box::new(operand),
            op: b.op,
            right: Box::new(owned_expr(b.right)),
        }),
        arena_ast::ExprKind::UnaryPostfix(u) => ExprKind::UnaryPostfix(UnaryPostfixExpr {
            operand: Box::new(operand),
            op: u.op,
        }),
        arena_ast::ExprKind::Ternary(t) => ExprKind::Ternary(TernaryExpr {
            condition: Box::new(operand),
            then_expr: t.then_expr.map(|e| Box::new(owned_expr(e))),
            else_expr: Box::new(owned_expr(t.else_expr)),
        }),
        arena_ast::ExprKind::NullCoalesce(n) => ExprKind::NullCoalesce(NullCoalesceExpr {
            left: Box::new(operand),
            right: Box::new(owned_expr(n.right)),
        }),
        arena_ast::ExprKind::FunctionCall(f) => ExprKind::FunctionCall(FunctionCallExpr {
            name: Box::new(operand),
            args: owned_args(&f.args),
        }),
        arena_ast::ExprKind::ArrayAccess(a) => ExprKind::ArrayAccess(ArrayAccessExpr {
            array: Box::new(operand),
            index: a.index.map(|e| Box::new(owned_expr(e))),
        }),
        arena_ast::ExprKind::PropertyAccess(p) => ExprKind::PropertyAccess(PropertyAccessExpr {
            object: Box::new(operand),
            property: Box::new(owned_expr(p.property)),
        }),
        arena_ast::ExprKind::NullsafePropertyAccess(p) => {
            ExprKind::NullsafePropertyAccess(PropertyAccessExpr {
                object: Box::new(operand),
                property: Box::new(owned_expr(p.property)),
            })
        }
        arena_ast::ExprKind::MethodCall(m) => ExprKind::MethodCall(Box::new(MethodCallExpr {
            object: Box::new(operand),
            method: Box::new(owned_expr(m.method)),
            args: owned_args(&m.args),
        })),
        arena_ast::ExprKind::NullsafeMethodCall(m) => {
            ExprKind::NullsafeMethodCall(Box::new(MethodCallExpr {
                object: Box::new(operand),
                method: Box::new(owned_expr(m.method)),
                args: owned_args(&m.args),
            }))
        }
        arena_ast::ExprKind::StaticPropertyAccess(s) => {
            ExprKind::StaticPropertyAccess(StaticAccessExpr {
                class: Box::new(operand),
                member: Box::new(owned_expr(s.member)),
            })
        }
        arena_ast::ExprKind::StaticMethodCall(s) => {
            ExprKind::StaticMethodCall(Box::new(StaticMethodCallExpr {
                class: Box::new(operand),
                method: Box::new(owned_expr(s.method)),
                args: owned_args(&s.args),
            }))
        }
        arena_ast::ExprKind::StaticMethodCallDynamic(s) => {
            ExprKind::StaticMethodCallDynamic(Box::new(StaticMethodCallDynamicExpr {
                class: Box::new(operand),
                method: Box::new(owned_expr(s.method)),
                args: owned_args(&s.args),
            }))
        }
        arena_ast::ExprKind::ClassConstAccess(s) => ExprKind::ClassConstAccess(StaticAccessExpr {
            class: Box::new(operand),
            member: Box::new(owned_expr(s.member)),
        }),
        arena_ast::ExprKind::ClassConstAccessDynamic { member, .. } => {
            ExprKind::ClassConstAccessDynamic {
                class: Box::new(operand),
                member: Box::new(owned_expr(member)),
            }
        }
        arena_ast::ExprKind::StaticPropertyAccessDynamic { member, .. } => {
            ExprKind::StaticPropertyAccessDynamic {
                class: Box::new(operand),
                member: Box::new(owned_expr(member)),
            }
        }
        arena_ast::ExprKind::CallableCreate(c) => ExprKind::CallableCreate(CallableCreateExpr {
            kind: match &c.kind {
                arena_ast::CallableCreateKind::Function(_) => {
                    CallableCreateKind::Function(Box::new(operand))
                }
                arena_ast::CallableCreateKind::Method { method, .. } => {
                    CallableCreateKind::Method {
                        object: Box::new(operand),
                        method: Box::new(owned_expr(method)),
                    }
                }
                arena_ast::CallableCreateKind::NullsafeMethod { method, .. } => {
                    CallableCreateKind::NullsafeMethod {
                        object: Box::new(operand),
                        method: Box::new(owned_expr(method)),
                    }
                }
                arena_ast::CallableCreateKind::StaticMethod { method, .. } => {
                    CallableCreateKind::StaticMethod {
                        class: Box::new(operand),
                        method: Box::new(owned_expr(method)),
                    }
                }
            },
        }),
        _ => unreachable!("not a chain link"),
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
        doc_comment: p.doc_comment.as_ref().map(owned_comment),
        span: p.span,
    }
}

#[inline(never)]
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
            arena_ast::PropertyHookBody::Block(block) => {
                PropertyHookBody::Block(Box::new(owned_block(block)))
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

#[inline(never)]
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

fn owned_block(block: &arena_ast::Block<'_, '_>) -> Block {
    Block {
        stmts: owned_stmts(&block.stmts),
        span: block.span,
    }
}

fn owned_stmt(stmt: &arena_ast::Stmt<'_, '_>) -> Stmt {
    Stmt {
        kind: owned_stmt_kind(&stmt.kind),
        span: stmt.span,
        doc_comment: stmt.doc_comment.map(owned_comment),
    }
}

fn owned_stmt_kind(k: &arena_ast::StmtKind<'_, '_>) -> StmtKind {
    match k {
        arena_ast::StmtKind::Expression(e) => StmtKind::Expression(Box::new(owned_expr(e))),
        arena_ast::StmtKind::Echo(exprs) => StmtKind::Echo(owned_exprs(exprs)),
        arena_ast::StmtKind::Return(e) => StmtKind::Return(e.map(|e| Box::new(owned_expr(e)))),
        arena_ast::StmtKind::Block(block) => StmtKind::Block(Box::new(owned_block(block))),
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
            else_kw_span: s.else_kw_span,
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
            body: SwitchBody {
                cases: s
                    .body
                    .cases
                    .iter()
                    .map(|c| SwitchCase {
                        value: c.value.as_ref().map(owned_expr),
                        body: owned_stmts(&c.body),
                        span: c.span,
                    })
                    .collect::<Vec<_>>()
                    .into_boxed_slice(),
                span: s.body.span,
            },
            uses_alternative: s.uses_alternative,
        })),
        arena_ast::StmtKind::Goto(ident) => StmtKind::Goto(owned_ident(*ident)),
        arena_ast::StmtKind::Label(ident) => StmtKind::Label(owned_ident(*ident)),
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
            body: Box::new(owned_block(t.body)),
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
                    var: c.var.map(owned_ident),
                    body: Box::new(owned_block(c.body)),
                    span: c.span,
                })
                .collect::<Vec<_>>()
                .into_boxed_slice(),
            finally: t.finally.map(|f| Box::new(owned_block(f))),
            finally_kw_span: t.finally_kw_span,
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
                arena_ast::NamespaceBody::Braced(block) => {
                    NamespaceBody::Braced(Box::new(owned_block(block)))
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
                    alias: item.alias.map(owned_ident),
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
        body: Box::new(owned_block(f.body)),
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
                is_final: p.is_final,
                is_abstract: p.is_abstract,
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
                body: m.body.map(|b| Box::new(owned_block(b))),
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
                        is_final,
                        new_name,
                    } => TraitAdaptationKind::Alias {
                        trait_name: trait_name.as_ref().map(owned_name),
                        method: owned_name(method),
                        new_modifier: *new_modifier,
                        is_final: *is_final,
                        new_name: new_name.as_ref().map(owned_name),
                    },
                },
                span: a.span,
            })
            .collect::<Vec<_>>()
            .into_boxed_slice(),
        adaptations_brace_span: t.adaptations_brace_span,
        doc_comment: owned_opt_comment(&t.doc_comment),
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
        body: ClassBody {
            members: owned_class_members(&cls.body.members),
            span: cls.body.span,
        },
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
        body: ClassBody {
            members: owned_class_members(&iface.body.members),
            span: iface.body.span,
        },
        attributes: owned_attrs(&iface.attributes),
        doc_comment: owned_opt_comment(&iface.doc_comment),
    }
}

fn owned_trait_decl(tr: &arena_ast::TraitDecl<'_, '_>) -> TraitDecl {
    TraitDecl {
        name: owned_ident(tr.name),
        body: ClassBody {
            members: owned_class_members(&tr.body.members),
            span: tr.body.span,
        },
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
        body: EnumBody {
            members: en
                .body
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
                        arena_ast::EnumMemberKind::Method(m) => {
                            EnumMemberKind::Method(MethodDecl {
                                name: owned_ident(m.name),
                                visibility: m.visibility,
                                is_static: m.is_static,
                                is_abstract: m.is_abstract,
                                is_final: m.is_final,
                                by_ref: m.by_ref,
                                params: owned_params(&m.params),
                                return_type: m.return_type.as_ref().map(owned_type_hint),
                                body: m.body.map(|b| Box::new(owned_block(b))),
                                attributes: owned_attrs(&m.attributes),
                                doc_comment: owned_opt_comment(&m.doc_comment),
                            })
                        }
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
            span: en.body.span,
        },
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
/// without round-tripping through `parse_arena()`. Not part of the stable API.
#[doc(hidden)]
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
    match ident.as_str() {
        Some(s) => arena_ast::Ident::new(arena.alloc_str(s), ident.span),
        None => arena_ast::Ident::error(ident.span),
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
        value: arg.value.as_ref().map(|v| av_expr(arena, v)),
        unpack: arg.unpack,
        by_ref: arg.by_ref,
        span: arg.span,
    }
}

#[inline(never)]
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

#[inline(never)]
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
    if !owned_is_chain(&expr.kind) {
        return arena_ast::Expr {
            kind: av_leaf_kind(arena, &expr.kind),
            span: expr.span,
        };
    }
    av_chain_expr(arena, expr)
}

/// Bottom-up over an explicit stack, as in `owned_chain_expr`.
#[inline(never)]
fn av_chain_expr<'a>(arena: &'a bumpalo::Bump, expr: &Expr) -> arena_ast::Expr<'a, 'a> {
    let first = owned_chain_operand(&expr.kind).expect("chain link has an operand");
    if !owned_is_chain(&first.kind) {
        let operand = arena_ast::Expr {
            kind: av_leaf_kind(arena, &first.kind),
            span: first.span,
        };
        return arena_ast::Expr {
            kind: av_link_kind(arena, &expr.kind, operand),
            span: expr.span,
        };
    }
    let mut chain = LinkStack::new();
    chain.push(expr);
    let mut leaf = first;
    while let Some(operand) = owned_chain_operand(&leaf.kind) {
        chain.push(leaf);
        leaf = operand;
    }
    let mut converted = arena_ast::Expr {
        kind: av_leaf_kind(arena, &leaf.kind),
        span: leaf.span,
    };
    while let Some(node) = chain.pop() {
        converted = arena_ast::Expr {
            kind: av_link_kind(arena, &node.kind, converted),
            span: node.span,
        };
    }
    converted
}

#[inline(never)]
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

/// Convert an expression kind that is not a chain link (see [`owned_chain_operand`]).
fn av_leaf_kind<'a>(arena: &'a bumpalo::Bump, k: &ExprKind) -> arena_ast::ExprKind<'a, 'a> {
    match k {
        ExprKind::Int(v) => arena_ast::ExprKind::Int(*v),
        ExprKind::Float(v) => arena_ast::ExprKind::Float(*v),
        ExprKind::String(s) => arena_ast::ExprKind::String(av_namestr(arena, s)),
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
        ExprKind::Name(name) => arena_ast::ExprKind::Name(av_name(arena, name)),
        ExprKind::UnaryPrefix(u) => arena_ast::ExprKind::UnaryPrefix(arena_ast::UnaryPrefixExpr {
            op: u.op,
            operand: arena.alloc(av_expr(arena, &u.operand)),
        }),
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
        ExprKind::Closure(c) => arena_ast::ExprKind::Closure(arena.alloc(arena_ast::ClosureExpr {
            is_static: c.is_static,
            by_ref: c.by_ref,
            params: av_params(arena, &c.params),
            use_vars: {
                let mut v = arena_ast::ArenaVec::with_capacity_in(c.use_vars.len(), arena);
                for uv in c.use_vars.iter() {
                    v.push(arena_ast::ClosureUseVar {
                        name: av_ident(arena, &uv.name),
                        by_ref: uv.by_ref,
                        span: uv.span,
                    });
                }
                v
            },
            return_type: c.return_type.as_ref().map(|t| av_type_hint(arena, t)),
            body: &*arena.alloc(av_block(arena, &c.body)),
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
            brace_span: m.brace_span,
        }),
        ExprKind::Throw(e) => arena_ast::ExprKind::Throw(arena.alloc(av_expr(arena, e))),
        ExprKind::Yield(y) => arena_ast::ExprKind::Yield(arena_ast::YieldExpr {
            key: y.key.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
            value: y.value.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
            is_from: y.is_from,
        }),
        ExprKind::AnonymousClass(cls) => {
            arena_ast::ExprKind::AnonymousClass(arena.alloc(av_class_decl(arena, cls)))
        }
        ExprKind::Omit => arena_ast::ExprKind::Omit,
        ExprKind::Error => arena_ast::ExprKind::Error,
        ExprKind::Assign(_)
        | ExprKind::Binary(_)
        | ExprKind::UnaryPostfix(_)
        | ExprKind::Ternary(_)
        | ExprKind::NullCoalesce(_)
        | ExprKind::FunctionCall(_)
        | ExprKind::ArrayAccess(_)
        | ExprKind::PropertyAccess(_)
        | ExprKind::NullsafePropertyAccess(_)
        | ExprKind::MethodCall(_)
        | ExprKind::NullsafeMethodCall(_)
        | ExprKind::StaticPropertyAccess(_)
        | ExprKind::ClassConstAccess(_)
        | ExprKind::StaticMethodCall(_)
        | ExprKind::StaticMethodCallDynamic(_)
        | ExprKind::ClassConstAccessDynamic { .. }
        | ExprKind::StaticPropertyAccessDynamic { .. }
        | ExprKind::CallableCreate(_) => {
            unreachable!("chain links are converted by the link function")
        }
    }
}

/// Convert a chain link, given its already-converted chain operand.
fn av_link_kind<'a>(
    arena: &'a bumpalo::Bump,
    k: &ExprKind,
    operand: arena_ast::Expr<'a, 'a>,
) -> arena_ast::ExprKind<'a, 'a> {
    match k {
        ExprKind::Assign(a) => arena_ast::ExprKind::Assign(arena_ast::AssignExpr {
            target: arena.alloc(operand),
            op: a.op,
            value: arena.alloc(av_expr(arena, &a.value)),
            by_ref: a.by_ref,
        }),
        ExprKind::Binary(b) => arena_ast::ExprKind::Binary(arena_ast::BinaryExpr {
            left: arena.alloc(operand),
            op: b.op,
            right: arena.alloc(av_expr(arena, &b.right)),
        }),
        ExprKind::UnaryPostfix(u) => {
            arena_ast::ExprKind::UnaryPostfix(arena_ast::UnaryPostfixExpr {
                operand: arena.alloc(operand),
                op: u.op,
            })
        }
        ExprKind::Ternary(t) => arena_ast::ExprKind::Ternary(arena_ast::TernaryExpr {
            condition: arena.alloc(operand),
            then_expr: t
                .then_expr
                .as_ref()
                .map(|e| &*arena.alloc(av_expr(arena, e))),
            else_expr: arena.alloc(av_expr(arena, &t.else_expr)),
        }),
        ExprKind::NullCoalesce(n) => {
            arena_ast::ExprKind::NullCoalesce(arena_ast::NullCoalesceExpr {
                left: arena.alloc(operand),
                right: arena.alloc(av_expr(arena, &n.right)),
            })
        }
        ExprKind::FunctionCall(f) => {
            arena_ast::ExprKind::FunctionCall(arena_ast::FunctionCallExpr {
                name: arena.alloc(operand),
                args: av_args(arena, &f.args),
            })
        }
        ExprKind::ArrayAccess(a) => arena_ast::ExprKind::ArrayAccess(arena_ast::ArrayAccessExpr {
            array: arena.alloc(operand),
            index: a.index.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))),
        }),
        ExprKind::PropertyAccess(p) => {
            arena_ast::ExprKind::PropertyAccess(arena_ast::PropertyAccessExpr {
                object: arena.alloc(operand),
                property: arena.alloc(av_expr(arena, &p.property)),
            })
        }
        ExprKind::NullsafePropertyAccess(p) => {
            arena_ast::ExprKind::NullsafePropertyAccess(arena_ast::PropertyAccessExpr {
                object: arena.alloc(operand),
                property: arena.alloc(av_expr(arena, &p.property)),
            })
        }
        ExprKind::MethodCall(m) => {
            arena_ast::ExprKind::MethodCall(arena.alloc(arena_ast::MethodCallExpr {
                object: arena.alloc(operand),
                method: arena.alloc(av_expr(arena, &m.method)),
                args: av_args(arena, &m.args),
            }))
        }
        ExprKind::NullsafeMethodCall(m) => {
            arena_ast::ExprKind::NullsafeMethodCall(arena.alloc(arena_ast::MethodCallExpr {
                object: arena.alloc(operand),
                method: arena.alloc(av_expr(arena, &m.method)),
                args: av_args(arena, &m.args),
            }))
        }
        ExprKind::StaticPropertyAccess(s) => {
            arena_ast::ExprKind::StaticPropertyAccess(arena_ast::StaticAccessExpr {
                class: arena.alloc(operand),
                member: arena.alloc(av_expr(arena, &s.member)),
            })
        }
        ExprKind::StaticMethodCall(s) => {
            arena_ast::ExprKind::StaticMethodCall(arena.alloc(arena_ast::StaticMethodCallExpr {
                class: arena.alloc(operand),
                method: arena.alloc(av_expr(arena, &s.method)),
                args: av_args(arena, &s.args),
            }))
        }
        ExprKind::StaticMethodCallDynamic(s) => arena_ast::ExprKind::StaticMethodCallDynamic(
            arena.alloc(arena_ast::StaticMethodCallDynamicExpr {
                class: arena.alloc(operand),
                method: arena.alloc(av_expr(arena, &s.method)),
                args: av_args(arena, &s.args),
            }),
        ),
        ExprKind::ClassConstAccess(s) => {
            arena_ast::ExprKind::ClassConstAccess(arena_ast::StaticAccessExpr {
                class: arena.alloc(operand),
                member: arena.alloc(av_expr(arena, &s.member)),
            })
        }
        ExprKind::ClassConstAccessDynamic { member, .. } => {
            arena_ast::ExprKind::ClassConstAccessDynamic {
                class: arena.alloc(operand),
                member: arena.alloc(av_expr(arena, member)),
            }
        }
        ExprKind::StaticPropertyAccessDynamic { member, .. } => {
            arena_ast::ExprKind::StaticPropertyAccessDynamic {
                class: arena.alloc(operand),
                member: arena.alloc(av_expr(arena, member)),
            }
        }
        ExprKind::CallableCreate(c) => {
            arena_ast::ExprKind::CallableCreate(arena_ast::CallableCreateExpr {
                kind: match &c.kind {
                    CallableCreateKind::Function(_) => {
                        arena_ast::CallableCreateKind::Function(arena.alloc(operand))
                    }
                    CallableCreateKind::Method { method, .. } => {
                        arena_ast::CallableCreateKind::Method {
                            object: arena.alloc(operand),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                    CallableCreateKind::NullsafeMethod { method, .. } => {
                        arena_ast::CallableCreateKind::NullsafeMethod {
                            object: arena.alloc(operand),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                    CallableCreateKind::StaticMethod { method, .. } => {
                        arena_ast::CallableCreateKind::StaticMethod {
                            class: arena.alloc(operand),
                            method: arena.alloc(av_expr(arena, method)),
                        }
                    }
                },
            })
        }
        _ => unreachable!("not a chain link"),
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
        doc_comment: av_opt_comment(arena, &p.doc_comment),
        span: p.span,
    }
}

#[inline(never)]
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
            PropertyHookBody::Block(block) => {
                arena_ast::PropertyHookBody::Block(arena.alloc(av_block(arena, block)))
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
        doc_comment: stmt.doc_comment.as_ref().map(|c| {
            &*arena.alloc(arena_ast::Comment {
                kind: c.kind,
                text: arena.alloc_str(&c.text),
                span: c.span,
            })
        }),
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

fn av_block<'a>(arena: &'a bumpalo::Bump, block: &Block) -> arena_ast::Block<'a, 'a> {
    arena_ast::Block {
        stmts: av_stmts(arena, &block.stmts),
        span: block.span,
    }
}

fn av_stmt_kind<'a>(arena: &'a bumpalo::Bump, k: &StmtKind) -> arena_ast::StmtKind<'a, 'a> {
    match k {
        StmtKind::Expression(e) => arena_ast::StmtKind::Expression(arena.alloc(av_expr(arena, e))),
        StmtKind::Echo(exprs) => arena_ast::StmtKind::Echo(av_exprs(arena, exprs)),
        StmtKind::Return(e) => {
            arena_ast::StmtKind::Return(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Block(block) => arena_ast::StmtKind::Block(arena.alloc(av_block(arena, block))),
        StmtKind::If(s) => arena_ast::StmtKind::If(arena.alloc(av_if_stmt(arena, s))),
        StmtKind::While(s) => arena_ast::StmtKind::While(arena.alloc(av_while_stmt(arena, s))),
        StmtKind::For(s) => arena_ast::StmtKind::For(arena.alloc(av_for_stmt(arena, s))),
        StmtKind::Foreach(s) => {
            arena_ast::StmtKind::Foreach(arena.alloc(av_foreach_stmt(arena, s)))
        }
        StmtKind::DoWhile(s) => {
            arena_ast::StmtKind::DoWhile(arena.alloc(av_do_while_stmt(arena, s)))
        }
        StmtKind::Function(f) => {
            arena_ast::StmtKind::Function(arena.alloc(av_function_decl(arena, f)))
        }
        StmtKind::Break(e) => {
            arena_ast::StmtKind::Break(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Continue(e) => {
            arena_ast::StmtKind::Continue(e.as_ref().map(|e| &*arena.alloc(av_expr(arena, e))))
        }
        StmtKind::Switch(s) => arena_ast::StmtKind::Switch(arena.alloc(av_switch_stmt(arena, s))),
        StmtKind::Goto(ident) => arena_ast::StmtKind::Goto(av_ident(arena, ident)),
        StmtKind::Label(ident) => arena_ast::StmtKind::Label(av_ident(arena, ident)),
        StmtKind::Declare(d) => {
            arena_ast::StmtKind::Declare(arena.alloc(av_declare_stmt(arena, d)))
        }
        StmtKind::Unset(exprs) => arena_ast::StmtKind::Unset(av_exprs(arena, exprs)),
        StmtKind::Throw(e) => arena_ast::StmtKind::Throw(arena.alloc(av_expr(arena, e))),
        StmtKind::TryCatch(t) => {
            arena_ast::StmtKind::TryCatch(arena.alloc(av_try_catch_stmt(arena, t)))
        }
        StmtKind::Global(exprs) => arena_ast::StmtKind::Global(av_exprs(arena, exprs)),
        StmtKind::Class(cls) => arena_ast::StmtKind::Class(arena.alloc(av_class_decl(arena, cls))),
        StmtKind::Interface(iface) => {
            arena_ast::StmtKind::Interface(arena.alloc(av_interface_decl(arena, iface)))
        }
        StmtKind::Trait(tr) => arena_ast::StmtKind::Trait(arena.alloc(av_trait_decl(arena, tr))),
        StmtKind::Enum(en) => arena_ast::StmtKind::Enum(arena.alloc(av_enum_decl(arena, en))),
        StmtKind::Namespace(ns) => {
            arena_ast::StmtKind::Namespace(arena.alloc(av_namespace_decl(arena, ns)))
        }
        StmtKind::Use(u) => arena_ast::StmtKind::Use(arena.alloc(av_use_decl(arena, u))),
        StmtKind::Const(items) => arena_ast::StmtKind::Const(av_const_items(arena, items)),
        StmtKind::StaticVar(vars) => arena_ast::StmtKind::StaticVar(av_static_vars(arena, vars)),
        StmtKind::HaltCompiler(s) => arena_ast::StmtKind::HaltCompiler(av_str(arena, s)),
        StmtKind::Nop => arena_ast::StmtKind::Nop,
        StmtKind::InlineHtml(s) => arena_ast::StmtKind::InlineHtml(av_str(arena, s)),
        StmtKind::Error => arena_ast::StmtKind::Error,
    }
}

// Kept out of line so `av_stmt_kind`, which nested statements recurse through,
// does not carry every variant's temporaries in its own stack frame.
#[inline(never)]
fn av_if_stmt<'a>(arena: &'a bumpalo::Bump, s: &IfStmt) -> arena_ast::IfStmt<'a, 'a> {
    arena_ast::IfStmt {
        condition: av_expr(arena, &s.condition),
        then_branch: arena.alloc(av_stmt(arena, &s.then_branch)),
        elseif_branches: {
            let mut v = arena_ast::ArenaVec::with_capacity_in(s.elseif_branches.len(), arena);
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
        else_kw_span: s.else_kw_span,
        uses_alternative: s.uses_alternative,
    }
}

#[inline(never)]
fn av_while_stmt<'a>(arena: &'a bumpalo::Bump, s: &WhileStmt) -> arena_ast::WhileStmt<'a, 'a> {
    arena_ast::WhileStmt {
        condition: av_expr(arena, &s.condition),
        body: arena.alloc(av_stmt(arena, &s.body)),
        uses_alternative: s.uses_alternative,
    }
}

#[inline(never)]
fn av_for_stmt<'a>(arena: &'a bumpalo::Bump, s: &ForStmt) -> arena_ast::ForStmt<'a, 'a> {
    arena_ast::ForStmt {
        init: av_exprs(arena, &s.init),
        condition: av_exprs(arena, &s.condition),
        update: av_exprs(arena, &s.update),
        body: arena.alloc(av_stmt(arena, &s.body)),
        uses_alternative: s.uses_alternative,
    }
}

#[inline(never)]
fn av_foreach_stmt<'a>(
    arena: &'a bumpalo::Bump,
    s: &ForeachStmt,
) -> arena_ast::ForeachStmt<'a, 'a> {
    arena_ast::ForeachStmt {
        expr: av_expr(arena, &s.expr),
        key: s.key.as_ref().map(|e| av_expr(arena, e)),
        value: av_expr(arena, &s.value),
        body: arena.alloc(av_stmt(arena, &s.body)),
        uses_alternative: s.uses_alternative,
    }
}

#[inline(never)]
fn av_do_while_stmt<'a>(
    arena: &'a bumpalo::Bump,
    s: &DoWhileStmt,
) -> arena_ast::DoWhileStmt<'a, 'a> {
    arena_ast::DoWhileStmt {
        body: arena.alloc(av_stmt(arena, &s.body)),
        condition: av_expr(arena, &s.condition),
    }
}

#[inline(never)]
fn av_switch_stmt<'a>(arena: &'a bumpalo::Bump, s: &SwitchStmt) -> arena_ast::SwitchStmt<'a, 'a> {
    arena_ast::SwitchStmt {
        expr: av_expr(arena, &s.expr),
        body: {
            let mut cases = arena_ast::ArenaVec::with_capacity_in(s.body.cases.len(), arena);
            for c in s.body.cases.iter() {
                cases.push(arena_ast::SwitchCase {
                    value: c.value.as_ref().map(|vl| av_expr(arena, vl)),
                    body: av_stmts(arena, &c.body),
                    span: c.span,
                });
            }
            arena_ast::SwitchBody {
                cases,
                span: s.body.span,
            }
        },
        uses_alternative: s.uses_alternative,
    }
}

#[inline(never)]
fn av_declare_stmt<'a>(
    arena: &'a bumpalo::Bump,
    d: &DeclareStmt,
) -> arena_ast::DeclareStmt<'a, 'a> {
    arena_ast::DeclareStmt {
        directives: {
            let mut v = arena_ast::ArenaVec::with_capacity_in(d.directives.len(), arena);
            for (k, val) in d.directives.iter() {
                v.push((arena.alloc_str(k) as &str, av_expr(arena, val)));
            }
            v
        },
        body: d.body.as_ref().map(|b| &*arena.alloc(av_stmt(arena, b))),
        uses_alternative: d.uses_alternative,
    }
}

#[inline(never)]
fn av_try_catch_stmt<'a>(
    arena: &'a bumpalo::Bump,
    t: &TryCatchStmt,
) -> arena_ast::TryCatchStmt<'a, 'a> {
    arena_ast::TryCatchStmt {
        body: arena.alloc(av_block(arena, &t.body)),
        catches: {
            let mut v = arena_ast::ArenaVec::with_capacity_in(t.catches.len(), arena);
            for c in t.catches.iter() {
                let mut types = arena_ast::ArenaVec::with_capacity_in(c.types.len(), arena);
                for n in c.types.iter() {
                    types.push(av_name(arena, n));
                }
                v.push(arena_ast::CatchClause {
                    types,
                    var: c.var.as_ref().map(|v| av_ident(arena, v)),
                    body: arena.alloc(av_block(arena, &c.body)),
                    span: c.span,
                });
            }
            v
        },
        finally: t
            .finally
            .as_deref()
            .map(|f| &*arena.alloc(av_block(arena, f))),
        finally_kw_span: t.finally_kw_span,
    }
}

#[inline(never)]
fn av_namespace_decl<'a>(
    arena: &'a bumpalo::Bump,
    ns: &NamespaceDecl,
) -> arena_ast::NamespaceDecl<'a, 'a> {
    arena_ast::NamespaceDecl {
        name: ns.name.as_ref().map(|n| av_name(arena, n)),
        body: match &ns.body {
            NamespaceBody::Braced(block) => {
                arena_ast::NamespaceBody::Braced(&*arena.alloc(av_block(arena, block)))
            }
            NamespaceBody::Simple => arena_ast::NamespaceBody::Simple,
        },
    }
}

#[inline(never)]
fn av_use_decl<'a>(arena: &'a bumpalo::Bump, u: &UseDecl) -> arena_ast::UseDecl<'a, 'a> {
    arena_ast::UseDecl {
        kind: u.kind,
        uses: {
            let mut v = arena_ast::ArenaVec::with_capacity_in(u.uses.len(), arena);
            for item in u.uses.iter() {
                v.push(arena_ast::UseItem {
                    name: av_name(arena, &item.name),
                    alias: item.alias.as_ref().map(|a| av_ident(arena, a)),
                    kind: item.kind,
                    span: item.span,
                });
            }
            v
        },
    }
}

#[inline(never)]
fn av_const_items<'a>(
    arena: &'a bumpalo::Bump,
    items: &[ConstItem],
) -> arena_ast::ArenaVec<'a, arena_ast::ConstItem<'a, 'a>> {
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
    v
}

#[inline(never)]
fn av_static_vars<'a>(
    arena: &'a bumpalo::Bump,
    vars: &[StaticVar],
) -> arena_ast::ArenaVec<'a, arena_ast::StaticVar<'a, 'a>> {
    let mut v = arena_ast::ArenaVec::with_capacity_in(vars.len(), arena);
    for var in vars.iter() {
        v.push(arena_ast::StaticVar {
            name: av_ident(arena, &var.name),
            default: var.default.as_ref().map(|e| av_expr(arena, e)),
            span: var.span,
        });
    }
    v
}

#[inline(never)]
fn av_function_decl<'a>(
    arena: &'a bumpalo::Bump,
    f: &FunctionDecl,
) -> arena_ast::FunctionDecl<'a, 'a> {
    arena_ast::FunctionDecl {
        name: av_ident(arena, &f.name),
        params: av_params(arena, &f.params),
        body: &*arena.alloc(av_block(arena, &f.body)),
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
                    is_final: p.is_final,
                    is_abstract: p.is_abstract,
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
                    body: m.body.as_deref().map(|b| &*arena.alloc(av_block(arena, b))),
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
                    is_final,
                    new_name,
                } => arena_ast::TraitAdaptationKind::Alias {
                    trait_name: trait_name.as_ref().map(|n| av_name(arena, n)),
                    method: av_name(arena, method),
                    new_modifier: *new_modifier,
                    is_final: *is_final,
                    new_name: new_name.as_ref().map(|n| av_name(arena, n)),
                },
            },
            span: a.span,
        });
    }
    arena_ast::TraitUseDecl {
        traits,
        adaptations,
        adaptations_brace_span: t.adaptations_brace_span,
        doc_comment: av_opt_comment(arena, &t.doc_comment),
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
        body: arena_ast::ClassBody {
            members: av_class_members(arena, &cls.body.members),
            span: cls.body.span,
        },
        attributes: av_attrs(arena, &cls.attributes),
        doc_comment: av_opt_comment(arena, &cls.doc_comment),
    }
}

#[inline(never)]
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
        body: arena_ast::ClassBody {
            members: av_class_members(arena, &iface.body.members),
            span: iface.body.span,
        },
        attributes: av_attrs(arena, &iface.attributes),
        doc_comment: av_opt_comment(arena, &iface.doc_comment),
    }
}

#[inline(never)]
fn av_trait_decl<'a>(arena: &'a bumpalo::Bump, tr: &TraitDecl) -> arena_ast::TraitDecl<'a, 'a> {
    arena_ast::TraitDecl {
        name: av_ident(arena, &tr.name),
        body: arena_ast::ClassBody {
            members: av_class_members(arena, &tr.body.members),
            span: tr.body.span,
        },
        attributes: av_attrs(arena, &tr.attributes),
        doc_comment: av_opt_comment(arena, &tr.doc_comment),
    }
}

#[inline(never)]
fn av_enum_decl<'a>(arena: &'a bumpalo::Bump, en: &EnumDecl) -> arena_ast::EnumDecl<'a, 'a> {
    let mut implements = arena_ast::ArenaVec::with_capacity_in(en.implements.len(), arena);
    for n in en.implements.iter() {
        implements.push(av_name(arena, n));
    }
    let mut members = arena_ast::ArenaVec::with_capacity_in(en.body.members.len(), arena);
    for m in en.body.members.iter() {
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
                        body: m.body.as_deref().map(|b| &*arena.alloc(av_block(arena, b))),
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
        body: arena_ast::EnumBody {
            members,
            span: en.body.span,
        },
        attributes: av_attrs(arena, &en.attributes),
        doc_comment: av_opt_comment(arena, &en.doc_comment),
    }
}
