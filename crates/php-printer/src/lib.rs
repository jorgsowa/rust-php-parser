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

mod precedence;
mod printer;

pub use printer::{Indent, PrinterConfig};

use php_ast::owned;
use php_ast::{Comment, Program};

/// Pretty-print a PHP program.
///
/// For programs that start with PHP code, the output begins with `<?php\n`.
/// For programs that start with inline HTML, the HTML is emitted as-is.
pub fn pretty_print(program: &Program) -> String {
    pretty_print_with_config(program, &PrinterConfig::default())
}

/// Pretty-print a PHP program and append a trailing newline.
pub fn pretty_print_file(program: &Program) -> String {
    let mut out = pretty_print(program);
    out.push('\n');
    out
}

/// Pretty-print with custom configuration.
pub fn pretty_print_with_config(program: &Program, config: &PrinterConfig) -> String {
    let mut p = printer::Printer::new(config);
    p.print_program(program);
    p.into_output()
}

/// Pretty-print with all comments preserved.
pub fn pretty_print_with_comments<'src>(
    program: &Program<'_, 'src>,
    source: &'src str,
    comments: &'src [Comment<'src>],
) -> String {
    pretty_print_with_comments_and_config(program, source, comments, &PrinterConfig::default())
}

/// Pretty-print with all comments preserved and custom configuration.
pub fn pretty_print_with_comments_and_config<'src>(
    program: &Program<'_, 'src>,
    source: &'src str,
    comments: &'src [Comment<'src>],
    config: &PrinterConfig,
) -> String {
    let mut p = printer::Printer::with_comments(config, source, comments);
    p.print_program(program);
    p.into_output()
}

// =============================================================================
// Owned-program variants — no lifetime parameters, no arena needed
// =============================================================================

/// Pretty-print a fully-owned PHP program (the result of [`php_rs_parser::parse`]).
///
/// Internally converts the owned program to arena-allocated form using a
/// short-lived arena, then delegates to the standard pretty printer.
pub fn pretty_print_owned(program: &owned::Program) -> String {
    pretty_print_owned_with_config(program, &PrinterConfig::default())
}

/// Pretty-print a fully-owned program and append a trailing newline.
pub fn pretty_print_owned_file(program: &owned::Program) -> String {
    let mut out = pretty_print_owned(program);
    out.push('\n');
    out
}

/// Pretty-print a fully-owned program with custom configuration.
pub fn pretty_print_owned_with_config(program: &owned::Program, config: &PrinterConfig) -> String {
    let arena = bumpalo::Bump::new();
    let arena_program = owned::from_owned_program(&arena, program);
    let mut p = printer::Printer::new(config);
    p.print_program(&arena_program);
    p.into_output()
}

/// Pretty-print a fully-owned program with all comments preserved.
///
/// `source` is the original source string (from [`php_rs_parser::ParseResult::source`]).
/// `comments` is the comment list (from [`php_rs_parser::ParseResult::comments`]).
pub fn pretty_print_owned_with_comments(
    program: &owned::Program,
    source: &str,
    comments: &[owned::Comment],
) -> String {
    pretty_print_owned_with_comments_and_config(
        program,
        source,
        comments,
        &PrinterConfig::default(),
    )
}

/// Pretty-print a fully-owned program with all comments preserved and custom configuration.
pub fn pretty_print_owned_with_comments_and_config(
    program: &owned::Program,
    source: &str,
    comments: &[owned::Comment],
    config: &PrinterConfig,
) -> String {
    let arena = bumpalo::Bump::new();
    let arena_program = owned::from_owned_program(&arena, program);
    let arena_comments: Vec<Comment<'_>> = comments
        .iter()
        .map(|c| Comment {
            kind: c.kind,
            text: &source[c.span.start as usize..c.span.end as usize],
            span: c.span,
        })
        .collect();
    let mut p = printer::Printer::with_comments(config, source, &arena_comments);
    p.print_program(&arena_program);
    p.into_output()
}
