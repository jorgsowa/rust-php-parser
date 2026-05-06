use serde::Serialize;

use crate::Span;

use super::{
    ArenaVec, Attribute, ClassDecl, Comment, EnumDecl, Expr, FunctionDecl, Ident, InterfaceDecl,
    Name, TraitDecl,
};

#[derive(Debug, Serialize)]
pub struct Stmt<'arena, 'src> {
    pub kind: StmtKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum StmtKind<'arena, 'src> {
    /// Expression statement (e.g. `foo();`)
    Expression(&'arena Expr<'arena, 'src>),

    /// Echo statement: `echo expr1, expr2;`
    Echo(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Return statement: `return expr;`
    Return(Option<&'arena Expr<'arena, 'src>>),

    /// Block statement: `{ stmts }`
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),

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

#[derive(Debug, Serialize)]
pub struct IfStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub then_branch: &'arena Stmt<'arena, 'src>,
    pub elseif_branches: ArenaVec<'arena, ElseIfBranch<'arena, 'src>>,
    pub else_branch: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ElseIfBranch<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: Stmt<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct WhileStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForStmt<'arena, 'src> {
    pub init: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub condition: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub update: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForeachStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub key: Option<Expr<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct DoWhileStmt<'arena, 'src> {
    pub body: &'arena Stmt<'arena, 'src>,
    pub condition: Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct SwitchStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub cases: ArenaVec<'arena, SwitchCase<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct SwitchCase<'arena, 'src> {
    pub value: Option<Expr<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct TryCatchStmt<'arena, 'src> {
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub catches: ArenaVec<'arena, CatchClause<'arena, 'src>>,
    pub finally: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
}

#[derive(Debug, Serialize)]
pub struct CatchClause<'arena, 'src> {
    pub types: ArenaVec<'arena, Name<'arena, 'src>>,
    pub var: Option<&'src str>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct NamespaceDecl<'arena, 'src> {
    pub name: Option<Name<'arena, 'src>>,
    pub body: NamespaceBody<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub enum NamespaceBody<'arena, 'src> {
    /// `namespace Foo { … }` — braced form; the statements are scoped to this namespace.
    Braced(ArenaVec<'arena, Stmt<'arena, 'src>>),
    /// `namespace Foo;` — simple form; all subsequent statements until the next `namespace` or EOF are in scope.
    Simple,
}

#[derive(Debug, Serialize)]
pub struct DeclareStmt<'arena, 'src> {
    pub directives: ArenaVec<'arena, (&'src str, Expr<'arena, 'src>)>,
    pub body: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct UseDecl<'arena, 'src> {
    pub kind: UseKind,
    pub uses: ArenaVec<'arena, UseItem<'arena, 'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    /// `use Foo\Bar` — imports a class, interface, trait, or enum.
    Normal,
    /// `use function Foo\bar` — imports a function.
    Function,
    /// `use const Foo\BAR` — imports a constant.
    Const,
}

#[derive(Debug, Serialize)]
pub struct UseItem<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub alias: Option<&'src str>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ConstItem<'arena, 'src> {
    pub name: Ident<'src>,
    pub value: Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    pub span: Span,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub doc_comment: Option<Comment<'src>>,
}

#[derive(Debug, Serialize)]
pub struct StaticVar<'arena, 'src> {
    pub name: Ident<'src>,
    pub default: Option<Expr<'arena, 'src>>,
    pub span: Span,
}
