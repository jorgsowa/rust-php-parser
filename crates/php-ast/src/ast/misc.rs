use serde::Serialize;

use crate::Span;

use super::{ArenaVec, Expr, Name, Stmt};

/// A comment found in the source file.
#[derive(Debug, Clone, Copy, Serialize)]
pub struct Comment<'src> {
    /// Comment syntax form.
    pub kind: CommentKind,
    /// Raw text of the comment including its delimiters (e.g. `// foo`, `/* bar */`, `/** baz */`).
    pub text: &'src str,
    /// Source range of the comment.
    pub span: Span,
}

/// Distinguishes the four syntactic forms of PHP comment.
#[derive(Debug, Serialize, Clone, Copy, PartialEq, Eq)]
pub enum CommentKind {
    /// `// …` — single-line slash comment
    Line,
    /// `# …` — single-line hash comment
    Hash,
    /// `/* … */` — block comment
    Block,
    /// `/** … */` — doc-block comment (first non-whitespace char after `/*` is `*`)
    Doc,
}

/// The root AST node representing a complete PHP file.
#[derive(Debug, Serialize)]
pub struct Program<'arena, 'src> {
    /// Top-level statements.
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}

/// A call argument, including named, spread and by-reference forms.
#[derive(Debug, Serialize)]
pub struct Arg<'arena, 'src> {
    /// Argument name in a named argument (PHP 8.0+).
    pub name: Option<Name<'arena, 'src>>,
    /// `None` is a PHP 8.6 partial-application placeholder (`?`, or `...` when `unpack` is set).
    pub value: Option<Expr<'arena, 'src>>,
    /// `true` for spread (`...$args`).
    pub unpack: bool,
    /// `true` when `&` precedes the argument.
    pub by_ref: bool,
    /// Source range of this node.
    pub span: Span,
}

/// A single attribute: `#[Name(args)]`.
#[derive(Debug, Serialize)]
pub struct Attribute<'arena, 'src> {
    /// Attribute class name.
    pub name: Name<'arena, 'src>,
    /// Attribute arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}
