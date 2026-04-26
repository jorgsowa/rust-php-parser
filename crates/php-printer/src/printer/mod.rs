mod decls;
mod exprs;
mod helpers;
mod stmts;
mod types;

/// Configuration for the pretty printer.
pub struct PrinterConfig {
    pub indent: Indent,
    pub newline: &'static str,
}

/// Indentation style.
pub enum Indent {
    Spaces(usize),
    Tabs,
}

impl Default for PrinterConfig {
    fn default() -> Self {
        Self {
            indent: Indent::Spaces(4),
            newline: "\n",
        }
    }
}

const SPACES: [&str; 17] = [
    "",
    " ",
    "  ",
    "   ",
    "    ",
    "     ",
    "      ",
    "       ",
    "        ",
    "         ",
    "          ",
    "           ",
    "            ",
    "             ",
    "              ",
    "               ",
    "                ",
];

pub(crate) const MAX_DEPTH: usize = 256;

pub(crate) struct Printer {
    output: String,
    indent_level: usize,
    indent_str: &'static str,
    nl: &'static str,
    pub(crate) depth: usize,
}

impl Printer {
    pub fn new(config: &PrinterConfig) -> Self {
        let indent_str = match config.indent {
            Indent::Spaces(n) => SPACES[n.min(16)],
            Indent::Tabs => "\t",
        };
        Self {
            output: String::with_capacity(4096),
            indent_level: 0,
            indent_str,
            nl: config.newline,
            depth: 0,
        }
    }

    pub fn into_output(self) -> String {
        self.output
    }

    pub(crate) fn w(&mut self, s: &str) {
        self.output.push_str(s);
    }

    pub(crate) fn newline(&mut self) {
        self.output.push_str(self.nl);
    }

    pub(crate) fn write_indent(&mut self) {
        for _ in 0..self.indent_level {
            self.output.push_str(self.indent_str);
        }
    }

    pub(crate) fn indent(&mut self) {
        self.indent_level += 1;
    }

    pub(crate) fn dedent(&mut self) {
        self.indent_level = self.indent_level.saturating_sub(1);
    }

    // =========================================================================
    // Top-level
    // =========================================================================

    pub fn print_program(&mut self, program: &php_ast::ast::Program) {
        self.print_stmts(&program.stmts, false);
    }

    pub(crate) fn print_stmts(&mut self, stmts: &[php_ast::ast::Stmt], indent: bool) {
        if indent {
            self.indent();
        }
        for (i, stmt) in stmts.iter().enumerate() {
            if i > 0 {
                self.newline();
            }
            if i > 0 && helpers::is_declaration(&stmt.kind) {
                self.newline();
            }
            self.write_indent();
            self.print_stmt(stmt);
        }
        if indent {
            self.dedent();
        }
    }
}
