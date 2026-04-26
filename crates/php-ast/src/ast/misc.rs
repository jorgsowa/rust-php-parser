use serde::Serialize;

use crate::Span;

use super::{ArenaVec, Expr, Name, Stmt};

/// A comment found in the source file.
#[derive(Debug, Serialize)]
pub struct Comment<'src> {
    pub kind: CommentKind,
    /// Raw text of the comment including its delimiters (e.g. `// foo`, `/* bar */`, `/** baz */`).
    pub text: &'src str,
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
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct Arg<'arena, 'src> {
    pub name: Option<Name<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub unpack: bool,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct Attribute<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
    pub span: Span,
}
