//! Pretty printer for PHP AST — converts parsed AST back to PHP source code.
//!
//! # Example
//!
//! ```
//! let arena = bumpalo::Bump::new();
//! let result = php_rs_parser::parse_arena(&arena, "<?php echo 1 + 2;");
//! let output = php_printer::pretty_print(&result.program);
//! assert_eq!(output, "<?php\necho 1 + 2;");
//! ```
//!
//! Use [`PrettyPrinter`] to keep comments, change the [`PrinterConfig`], or end
//! the output with a newline:
//!
//! ```
//! let result = php_rs_parser::parse("<?php\n// greet\necho 'hi';");
//! let output = php_printer::PrettyPrinter::new()
//!     .comments(&result.source, &result.comments)
//!     .trailing_newline(true)
//!     .print(&result.program);
//! assert_eq!(output, "<?php\n// greet\necho 'hi';\n");
//! ```

#![warn(missing_docs)]

mod precedence;
mod printer;

pub use printer::{Indent, Newline, PrinterConfig};

use php_ast::owned;
use php_ast::{Comment, Program};

/// Pretty-print a PHP program with the default settings.
///
/// For programs that start with PHP code, the output begins with `<?php\n`.
/// For programs that start with inline HTML, the HTML is emitted as-is.
pub fn pretty_print(program: &impl Printable) -> String {
    PrettyPrinter::new().print(program)
}

/// A program the printer accepts: the arena [`Program`] or an [`owned::Program`].
pub trait Printable: sealed::Printable {}

/// A comment the printer accepts: the arena [`Comment`] or an [`owned::Comment`].
pub trait PrintableComment: sealed::PrintableComment {}

mod sealed {
    use php_ast::{CommentKind, Span};

    pub trait Printable {
        fn print(&self, printer: &super::PrettyPrinter<'_>) -> String;
    }

    pub trait PrintableComment {
        fn kind(&self) -> CommentKind;
        fn span(&self) -> Span;
    }
}

impl Printable for Program<'_, '_> {}
impl sealed::Printable for Program<'_, '_> {
    fn print(&self, printer: &PrettyPrinter<'_>) -> String {
        printer.print_arena(self)
    }
}

impl Printable for owned::Program {}
impl sealed::Printable for owned::Program {
    fn print(&self, printer: &PrettyPrinter<'_>) -> String {
        let arena = bumpalo::Bump::new();
        let program = owned::from_owned_program(&arena, self);
        printer.print_arena(&program)
    }
}

impl PrintableComment for Comment<'_> {}
impl sealed::PrintableComment for Comment<'_> {
    fn kind(&self) -> php_ast::CommentKind {
        self.kind
    }
    fn span(&self) -> php_ast::Span {
        self.span
    }
}

impl PrintableComment for owned::Comment {}
impl sealed::PrintableComment for owned::Comment {
    fn kind(&self) -> php_ast::CommentKind {
        self.kind
    }
    fn span(&self) -> php_ast::Span {
        self.span
    }
}

/// Configurable pretty printer for arena and owned programs.
#[derive(Debug, Clone, Default)]
pub struct PrettyPrinter<'src> {
    config: PrinterConfig,
    source: &'src str,
    comments: Vec<Comment<'src>>,
    trailing_newline: bool,
    syntax_errors: bool,
}

impl<'src> PrettyPrinter<'src> {
    /// A printer with the default [`PrinterConfig`], no comments and no trailing newline.
    pub fn new() -> Self {
        Self::default()
    }

    /// Sets the indentation, newline and blank-line settings.
    pub fn config(mut self, config: PrinterConfig) -> Self {
        self.config = config;
        self
    }

    /// Prints `comments` (the parse result's comment list) taken from `source`.
    pub fn comments<C: PrintableComment>(mut self, source: &'src str, comments: &[C]) -> Self {
        self.source = source;
        self.comments = comments
            .iter()
            .map(|c| {
                let span = c.span();
                Comment {
                    kind: c.kind(),
                    text: &source[span.start as usize..span.end as usize],
                    span,
                }
            })
            .collect();
        self
    }

    /// Whether to end the output with the configured newline.
    pub fn trailing_newline(mut self, trailing_newline: bool) -> Self {
        self.trailing_newline = trailing_newline;
        self
    }

    /// Whether the source has a syntax error, one PHP reports while parsing; the tree can't keep
    /// it, so the output then starts with a syntax error of its own and stays invalid.
    pub fn syntax_errors(mut self, syntax_errors: bool) -> Self {
        self.syntax_errors = syntax_errors;
        self
    }

    /// Prints `program`.
    pub fn print(&self, program: &impl Printable) -> String {
        sealed::Printable::print(program, self)
    }

    fn print_arena(&self, program: &Program<'_, '_>) -> String {
        let mut p = printer::Printer::with_comments(&self.config, self.source, &self.comments);
        p.print_program(program, self.syntax_errors);
        let mut out = p.into_output();
        if self.trailing_newline {
            out.push_str(self.config.newline.as_str());
        }
        out
    }
}
