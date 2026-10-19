#[cfg(feature = "serde")]
use serde::Serialize;

use crate::Span;

use super::{ArenaVec, Expr, Name, Stmt};

/// A comment found in the source file.
#[derive(Debug, Clone, Copy)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Comment<'src> {
    /// Comment syntax form.
    pub kind: CommentKind,
    /// Raw text of the comment including its delimiters (e.g. `// foo`, `/* bar */`, `/** baz */`).
    pub text: &'src str,
    /// Source range of the comment.
    pub span: Span,
}

/// Distinguishes the four syntactic forms of PHP comment.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Program<'arena, 'src> {
    /// Top-level statements.
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}

/// A call argument, including named, spread and by-reference forms.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Arg<'arena, 'src> {
    /// Argument name in a named argument (PHP 8.0+).
    pub name: Option<Name<'arena, 'src>>,
    /// What the argument passes.
    pub kind: ArgKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// The form of a call argument.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ArgKind<'arena, 'src> {
    /// A plain value: `f($x)`, or `f(name: $x)` when the argument has a name.
    Value(Expr<'arena, 'src>),
    /// A spread: `f(...$args)`.
    Spread(Expr<'arena, 'src>),
    /// Call-time pass-by-reference: `f(&$x)`, a fatal error since PHP 5.4.
    ByRef(Expr<'arena, 'src>),
    /// The PHP 8.6 partial-application placeholder `?`.
    Placeholder,
    /// The PHP 8.6 partial-application placeholder `...`.
    SpreadPlaceholder,
}

impl<'arena, 'src> Arg<'arena, 'src> {
    /// The argument expression; `None` for a placeholder.
    pub fn value(&self) -> Option<&Expr<'arena, 'src>> {
        match &self.kind {
            ArgKind::Value(e) | ArgKind::Spread(e) | ArgKind::ByRef(e) => Some(e),
            ArgKind::Placeholder | ArgKind::SpreadPlaceholder => None,
        }
    }

    /// Mutable access to the argument expression; `None` for a placeholder.
    pub fn value_mut(&mut self) -> Option<&mut Expr<'arena, 'src>> {
        match &mut self.kind {
            ArgKind::Value(e) | ArgKind::Spread(e) | ArgKind::ByRef(e) => Some(e),
            ArgKind::Placeholder | ArgKind::SpreadPlaceholder => None,
        }
    }

    /// Whether the argument is a `...` spread (not the `...` placeholder).
    pub fn is_spread(&self) -> bool {
        matches!(self.kind, ArgKind::Spread(_))
    }

    /// Whether the argument is a PHP 8.6 `?` or `...` placeholder.
    pub fn is_placeholder(&self) -> bool {
        matches!(self.kind, ArgKind::Placeholder | ArgKind::SpreadPlaceholder)
    }
}

/// A single attribute: `#[Name(args)]`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Attribute<'arena, 'src> {
    /// Attribute class name.
    pub name: Name<'arena, 'src>,
    /// Attribute arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
    /// Source range of this node.
    pub span: Span,
}
