//! Pretty printer for PHP AST — converts parsed AST back to PHP source code.
//!
//! # Example
//!
//! ```
//! let arena = bumpalo::Bump::new();
//! let result = php_rs_parser::parse(&arena, "<?php echo 1 + 2;");
//! let output = php_printer::pretty_print(&result.program);
//! assert_eq!(output, "echo 1 + 2;");
//! ```

mod precedence;
mod printer;

pub use printer::{Indent, PrinterConfig};

use php_ast::Program;

/// Pretty-print a program's statements (without `<?php` header).
pub fn pretty_print(program: &Program) -> String {
    pretty_print_with_config(program, &PrinterConfig::default())
}

/// Pretty-print a complete PHP file (prepends `<?php\n\n`).
pub fn pretty_print_file(program: &Program) -> String {
    let mut out = String::from("<?php\n\n");
    out.push_str(&pretty_print(program));
    out.push('\n');
    out
}

/// Pretty-print with custom configuration.
pub fn pretty_print_with_config(program: &Program, config: &PrinterConfig) -> String {
    let mut p = printer::Printer::new(config);
    p.print_program(program);
    p.into_output()
}
