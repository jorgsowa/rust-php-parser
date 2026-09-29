use serde::Serialize;

use crate::Span;

use super::{
    ArenaVec, Attribute, ClassDecl, Comment, EnumDecl, Expr, FunctionDecl, Ident, InterfaceDecl,
    Name, TraitDecl,
};

fn is_false(b: &bool) -> bool {
    !b
}

/// A statement node.
#[derive(Debug, Serialize)]
pub struct Stmt<'arena, 'src> {
    /// Statement kind.
    pub kind: StmtKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
    /// The immediately preceding `/** */` doc-block, if any.
    ///
    /// Only `/** */` (doc-block) comments are attached here; `//`, `#`, and
    /// `/* */` comments remain in `ParseResult::comments`.  When present,
    /// this comment is **removed** from `ParseResult::comments` — the two
    /// collections are disjoint.  A doc-block that has no following statement
    /// before the enclosing `}` or EOF is not attached and stays in
    /// `ParseResult::comments`.
    ///
    /// For declaration statements (`function`, `class`, `interface`, …) the
    /// doc-block is attached to the *inner* declaration node (e.g.
    /// [`FunctionDecl::doc_comment`]) and this field will always be `None`.
    ///
    /// Stored as a pointer into the arena rather than inline so that the
    /// `None` case (the vast majority of statements) costs only 8 bytes
    /// instead of the 32 bytes an inline `Option<Comment>` would require.
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<&'arena Comment<'src>>,
}

impl<'arena, 'src> Stmt<'arena, 'src> {
    /// The leading `/** */` doc-block for this statement, regardless of where
    /// it is stored.
    ///
    /// For non-declaration statements (`foreach`, `if`, assignments, …) the
    /// comment lives on [`Stmt::doc_comment`] and is returned directly.
    ///
    /// For declaration statements the comment is stored on the inner
    /// declaration node — this method checks each variant so callers do not
    /// need to match on [`StmtKind`]:
    ///
    /// | `StmtKind` variant | source field |
    /// |--------------------|--------------|
    /// | `Function`         | [`FunctionDecl::doc_comment`] |
    /// | `Class`            | [`ClassDecl::doc_comment`] |
    /// | `Interface`        | [`InterfaceDecl::doc_comment`] |
    /// | `Trait`            | [`TraitDecl::doc_comment`] |
    /// | `Enum`             | [`EnumDecl::doc_comment`] |
    /// | `Const`            | first [`ConstItem::doc_comment`] |
    ///
    /// Returns `None` when no doc-block precedes the statement.
    pub fn leading_doc_comment(&self) -> Option<&Comment<'src>> {
        if let Some(doc) = self.doc_comment {
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

/// A brace-delimited statement block. Used both as a standalone block
/// statement ([`StmtKind::Block`]) and as the body of constructs that are
/// *always* braced (functions, methods, closures, `try`/`catch`/`finally`,
/// braced namespaces, property-hook blocks) — those positions hold a
/// `&Block` so the "it's a block" invariant is enforced by the type.
#[derive(Debug, Serialize)]
#[serde(transparent)]
pub struct Block<'arena, 'src> {
    /// Statements in the block.
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    /// Span covering `{`..`}` (or the keyword-delimited region for the
    /// alternative-syntax blocks reachable only via [`StmtKind::Block`]).
    #[serde(skip)]
    pub span: Span,
}

/// The kinds of statement.
#[derive(Debug, Serialize)]
pub enum StmtKind<'arena, 'src> {
    /// Expression statement (e.g. `foo();`)
    Expression(&'arena Expr<'arena, 'src>),

    /// Echo statement: `echo expr1, expr2;`
    Echo(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Return statement: `return expr;`
    Return(Option<&'arena Expr<'arena, 'src>>),

    /// Block statement: `{ stmts }`
    Block(&'arena Block<'arena, 'src>),

    /// If statement
    If(&'arena IfStmt<'arena, 'src>),

    /// While loop
    While(&'arena WhileStmt<'arena, 'src>),

    /// For loop
    For(&'arena ForStmt<'arena, 'src>),

    /// Foreach loop
    Foreach(&'arena ForeachStmt<'arena, 'src>),

    /// Do-while loop
    DoWhile(&'arena DoWhileStmt<'arena, 'src>),

    /// Function declaration
    Function(&'arena FunctionDecl<'arena, 'src>),

    /// Break statement
    Break(Option<&'arena Expr<'arena, 'src>>),

    /// Continue statement
    Continue(Option<&'arena Expr<'arena, 'src>>),

    /// Switch statement
    Switch(&'arena SwitchStmt<'arena, 'src>),

    /// Goto statement
    Goto(Ident<'src>),

    /// Label statement
    Label(&'arena str),

    /// Declare statement
    Declare(&'arena DeclareStmt<'arena, 'src>),

    /// Unset statement
    Unset(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Throw statement (also can be expression in PHP 8)
    Throw(&'arena Expr<'arena, 'src>),

    /// Try/catch/finally
    TryCatch(&'arena TryCatchStmt<'arena, 'src>),

    /// Global declaration
    Global(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Class declaration
    Class(&'arena ClassDecl<'arena, 'src>),

    /// Interface declaration
    Interface(&'arena InterfaceDecl<'arena, 'src>),

    /// Trait declaration
    Trait(&'arena TraitDecl<'arena, 'src>),

    /// Enum declaration
    Enum(&'arena EnumDecl<'arena, 'src>),

    /// Namespace declaration
    Namespace(&'arena NamespaceDecl<'arena, 'src>),

    /// Use declaration
    Use(&'arena UseDecl<'arena, 'src>),

    /// Top-level constant: `const FOO = expr;`
    Const(ArenaVec<'arena, ConstItem<'arena, 'src>>),

    /// Static variable declaration: `static $x = 1;`
    StaticVar(ArenaVec<'arena, StaticVar<'arena, 'src>>),

    /// __halt_compiler(); with remaining data
    HaltCompiler(&'src str),

    /// Nop (empty statement `;`)
    Nop,

    /// Inline HTML
    InlineHtml(&'src str),

    /// Error placeholder — parser always produces a tree
    Error,
}

/// An `if` statement with optional `elseif`/`else` branches.
#[derive(Debug, Serialize)]
pub struct IfStmt<'arena, 'src> {
    /// `if` condition.
    pub condition: Expr<'arena, 'src>,
    /// Statement run when the condition holds.
    pub then_branch: &'arena Stmt<'arena, 'src>,
    /// `elseif` branches in order.
    pub elseif_branches: ArenaVec<'arena, ElseIfBranch<'arena, 'src>>,
    /// `else` statement, if any.
    pub else_branch: Option<&'arena Stmt<'arena, 'src>>,
    /// Start byte offset of the `else` keyword; `None` when there is no else branch.
    #[serde(skip)]
    pub else_kw_start: Option<u32>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// An `elseif` (or `else if`) branch.
#[derive(Debug, Serialize)]
pub struct ElseIfBranch<'arena, 'src> {
    /// Condition expression.
    pub condition: Expr<'arena, 'src>,
    /// Statement run when this branch matches.
    pub body: Stmt<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// A `while` loop.
#[derive(Debug, Serialize)]
pub struct WhileStmt<'arena, 'src> {
    /// Condition expression.
    pub condition: Expr<'arena, 'src>,
    /// Loop body.
    pub body: &'arena Stmt<'arena, 'src>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// A `for` loop.
#[derive(Debug, Serialize)]
pub struct ForStmt<'arena, 'src> {
    /// Initializer expressions.
    pub init: ArenaVec<'arena, Expr<'arena, 'src>>,
    /// Condition expressions.
    pub condition: ArenaVec<'arena, Expr<'arena, 'src>>,
    /// Update expressions.
    pub update: ArenaVec<'arena, Expr<'arena, 'src>>,
    /// Loop body.
    pub body: &'arena Stmt<'arena, 'src>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// A `foreach` loop.
#[derive(Debug, Serialize)]
pub struct ForeachStmt<'arena, 'src> {
    /// Expression being iterated.
    pub expr: Expr<'arena, 'src>,
    /// Key target in `$k => $v`.
    pub key: Option<Expr<'arena, 'src>>,
    /// Value target.
    pub value: Expr<'arena, 'src>,
    /// Loop body.
    pub body: &'arena Stmt<'arena, 'src>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// A `do ... while` loop.
#[derive(Debug, Serialize)]
pub struct DoWhileStmt<'arena, 'src> {
    /// Loop body.
    pub body: &'arena Stmt<'arena, 'src>,
    /// Condition checked after each iteration.
    pub condition: Expr<'arena, 'src>,
}

/// The case list of a `switch`.
#[derive(Debug, Serialize)]
pub struct SwitchBody<'arena, 'src> {
    /// Cases in source order.
    pub cases: ArenaVec<'arena, SwitchCase<'arena, 'src>>,
    /// Source range of this node.
    #[serde(skip)]
    pub span: Span,
}

/// A `switch` statement.
#[derive(Debug, Serialize)]
pub struct SwitchStmt<'arena, 'src> {
    /// Subject expression.
    pub expr: Expr<'arena, 'src>,
    /// Case list, flattened on serialization.
    #[serde(flatten)]
    pub body: SwitchBody<'arena, 'src>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// A `case` or `default` clause.
#[derive(Debug, Serialize)]
pub struct SwitchCase<'arena, 'src> {
    /// Case expression; `None` for `default`.
    pub value: Option<Expr<'arena, 'src>>,
    /// Statements under this case.
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}

/// A `try` statement with `catch` and `finally` clauses.
#[derive(Debug, Serialize)]
pub struct TryCatchStmt<'arena, 'src> {
    /// `try` block.
    pub body: &'arena Block<'arena, 'src>,
    /// `catch` clauses in order.
    pub catches: ArenaVec<'arena, CatchClause<'arena, 'src>>,
    /// `finally` block, if any.
    pub finally: Option<&'arena Block<'arena, 'src>>,
    /// Start byte offset of the `finally` keyword; `None` when there is no finally clause.
    #[serde(skip)]
    pub finally_kw_start: Option<u32>,
}

/// A `catch (Type $e) { ... }` clause.
#[derive(Debug, Serialize)]
pub struct CatchClause<'arena, 'src> {
    /// Caught exception types (`A|B`).
    pub types: ArenaVec<'arena, Name<'arena, 'src>>,
    /// Bound variable name; `None` if omitted (PHP 8.0+).
    pub var: Option<&'src str>,
    /// `catch` block.
    pub body: &'arena Block<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// A `namespace` declaration.
#[derive(Debug, Serialize)]
pub struct NamespaceDecl<'arena, 'src> {
    /// Namespace name; `None` for the global namespace.
    pub name: Option<Name<'arena, 'src>>,
    /// Braced or simple form.
    pub body: NamespaceBody<'arena, 'src>,
}

/// Whether a namespace is braced or simple.
#[derive(Debug, Serialize)]
pub enum NamespaceBody<'arena, 'src> {
    /// `namespace Foo { … }` — braced form; the statements are scoped to this namespace.
    Braced(&'arena Block<'arena, 'src>),
    /// `namespace Foo;` — simple form; all subsequent statements until the next `namespace` or EOF are in scope.
    Simple,
}

/// A `declare(...)` statement.
#[derive(Debug, Serialize)]
pub struct DeclareStmt<'arena, 'src> {
    /// `name = value` directives.
    pub directives: ArenaVec<'arena, (&'src str, Expr<'arena, 'src>)>,
    /// Statement scoped by the directive, if any.
    pub body: Option<&'arena Stmt<'arena, 'src>>,
    /// `true` when written in alternative syntax (`: ... endX;`).
    #[serde(default, skip_serializing_if = "is_false")]
    pub uses_alternative: bool,
}

/// A `use` import statement.
#[derive(Debug, Serialize)]
pub struct UseDecl<'arena, 'src> {
    /// Whether importing classes, functions or constants.
    pub kind: UseKind,
    /// Imported names.
    pub uses: ArenaVec<'arena, UseItem<'arena, 'src>>,
}

/// What a `use` import brings in.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    /// `use Foo\Bar` — imports a class, interface, trait, or enum.
    Normal,
    /// `use function Foo\bar` — imports a function.
    Function,
    /// `use const Foo\BAR` — imports a constant.
    Const,
}

/// One imported name in a `use` statement.
#[derive(Debug, Serialize)]
pub struct UseItem<'arena, 'src> {
    /// Imported name.
    pub name: Name<'arena, 'src>,
    /// Alias after `as`, if any.
    pub alias: Option<&'src str>,
    /// Per-item kind in a mixed group `use Foo\{function bar}`.
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    /// Source range of this node.
    pub span: Span,
}

/// One `NAME = value` item of a top-level `const` statement.
#[derive(Debug, Serialize)]
pub struct ConstItem<'arena, 'src> {
    /// Constant name.
    pub name: Ident<'src>,
    /// Constant value expression.
    pub value: Expr<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
    /// Preceding `/** */` doc-block, if any.
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

/// One variable of a `static $x = 1;` statement.
#[derive(Debug, Serialize)]
pub struct StaticVar<'arena, 'src> {
    /// Variable name without `$`.
    pub name: Ident<'src>,
    /// Initial value, if any.
    pub default: Option<Expr<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}
