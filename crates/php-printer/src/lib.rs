//! Pretty printer for PHP AST — converts parsed AST back to PHP source code.
//!
//! # Example
//!
//! ```
//! let arena = bumpalo::Bump::new();
//! let result = php_rs_parser::parse(&arena, "<?php echo 1 + 2;");
//! let output = php_printer::pretty_print(&result.program);
//! assert_eq!(output, "<?php\necho 1 + 2;");
//! ```

mod precedence;
mod printer;

pub use printer::{Indent, PrinterConfig};

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
