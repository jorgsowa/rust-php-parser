mod decls;
mod exprs;
mod helpers;
mod stmts;
mod types;

use php_ast::Comment;

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

pub(crate) struct Printer<'src> {
    output: String,
    indent_level: usize,
    indent_str: &'static str,
    nl: &'static str,
    pub(crate) depth: usize,
    comments: &'src [Comment<'src>],
    comment_cursor: usize,
    /// True when the printer is currently outside a PHP block (file started with HTML).
    /// Controls whether `?>` is emitted before InlineHtml nodes.
    in_html_mode: bool,
    /// True when at least one PHP statement has been emitted in the current PHP block.
    /// `?>` is only emitted when this is true — empty `<?php ?>` blocks are suppressed.
    has_php_content: bool,
}

impl<'src> Printer<'src> {
    pub fn new(config: &PrinterConfig) -> Self {
        Self::with_comments(config, "", &[])
    }

    pub fn with_comments(
        config: &PrinterConfig,
        _source: &'src str,
        comments: &'src [Comment<'src>],
    ) -> Self {
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
            comments,
            comment_cursor: 0,
            in_html_mode: false,
            has_php_content: false,
        }
    }

    pub fn into_output(self) -> String {
        self.output
    }

    pub(crate) fn w(&mut self, s: &str) {
        self.output.push_str(s);
    }

    /// Re-enter PHP mode if currently in HTML mode.
    /// Call this after `print_stmts` and before emitting any PHP-syntax token
    /// (closing brace, `endforeach`, etc.) that must appear inside a PHP block.
    /// Emits `<?php` on the same line as the preceding HTML content.
    pub(crate) fn ensure_php_mode(&mut self) {
        if self.in_html_mode {
            self.w("<?php");
            self.in_html_mode = false;
            self.has_php_content = true;
        }
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
    // Comment emission
    // =========================================================================

    pub(crate) fn flush_leading_comments(&mut self, before_offset: u32) {
        while self.comment_cursor < self.comments.len() {
            let c = &self.comments[self.comment_cursor];
            if c.span.start >= before_offset {
                break;
            }
            self.emit_comment_standalone(c, false);
            self.comment_cursor += 1;
        }
    }

    pub(crate) fn flush_trailing_comments(&mut self, _after_offset: u32, _before_offset: u32) {
        // Trailing comments are not emitted here.
        // They are always emitted as leading (standalone) comments before the next node.
        // This ensures round-trip stability: when we re-parse and re-print, comments
        // maintain consistent positioning rather than drifting between being inline vs leading.
    }

    pub(crate) fn flush_remaining_comments(&mut self) {
        while self.comment_cursor < self.comments.len() {
            let c = &self.comments[self.comment_cursor];
            self.emit_comment_standalone(c, false);
            self.comment_cursor += 1;
        }
    }

    fn emit_comment_standalone(&mut self, comment: &Comment, inline: bool) {
        use php_ast::CommentKind;
        match comment.kind {
            CommentKind::Doc => {
                if inline {
                    self.w(" ");
                } else {
                    self.write_indent();
                }
                for (i, line) in comment.text.lines().enumerate() {
                    if i > 0 {
                        self.newline();
                        self.write_indent();
                    }
                    let trimmed = if i == 0 { line.trim_end() } else { line.trim() };
                    self.w(trimmed);
                }
                self.newline();
                if !inline {
                    self.write_indent();
                }
            }
            CommentKind::Line | CommentKind::Hash => {
                let text = comment.text.trim_start().trim_end();
                if inline {
                    self.w(" ");
                    self.w(text);
                    self.newline();
                } else {
                    self.write_indent();
                    self.w(text);
                    self.newline();
                }
            }
            CommentKind::Block => {
                if inline {
                    self.w(" ");
                    self.w(comment.text);
                    self.newline();
                } else {
                    self.write_indent();
                    self.w(comment.text);
                    self.newline();
                }
            }
        }
    }

    pub(crate) fn has_comments_between(&self, from: u32, to: u32) -> bool {
        self.comments[self.comment_cursor..]
            .iter()
            .any(|c| c.span.start > from && c.span.start < to)
    }

    pub(crate) fn has_comments_before(&self, offset: u32) -> bool {
        self.comments[self.comment_cursor..]
            .iter()
            .any(|c| c.span.start < offset)
    }

    // =========================================================================
    // Top-level
    // =========================================================================

    pub fn print_program(&mut self, program: &php_ast::ast::Program) {
        let html_first = matches!(
            program.stmts.first().map(|s| (s.span.start, &s.kind)),
            Some((0, php_ast::ast::StmtKind::InlineHtml(_)))
        );
        if html_first {
            self.in_html_mode = true;
        } else if !program.stmts.is_empty() {
            self.w("<?php");
            self.newline();
            self.has_php_content = true;
        }
        self.print_stmts(&program.stmts, false);
        self.flush_remaining_comments();
    }

    pub(crate) fn print_stmts(&mut self, stmts: &[php_ast::ast::Stmt], indent: bool) {
        if indent {
            self.indent();
        }
        let mut prev_was_inline_html = false;
        for (i, stmt) in stmts.iter().enumerate() {
            let is_nop = matches!(stmt.kind, php_ast::ast::StmtKind::Nop);
            let is_inline_html = matches!(stmt.kind, php_ast::ast::StmtKind::InlineHtml(_));

            if is_nop && prev_was_inline_html {
                prev_was_inline_html = is_inline_html;
                continue;
            }

            // When transitioning out of HTML mode the <?php + newline + indent
            // is emitted by print_stmt_inner, so skip the normal separators here.
            if i > 0 && !self.in_html_mode {
                self.newline();
                if helpers::is_declaration(&stmt.kind) {
                    self.newline();
                }
            }
            self.flush_leading_comments(stmt.span.start);
            if !self.in_html_mode {
                self.write_indent();
            }
            self.print_stmt(stmt);
            let next_start = stmts.get(i + 1).map(|s| s.span.start).unwrap_or(u32::MAX);
            self.flush_trailing_comments(stmt.span.end.saturating_sub(1), next_start);

            prev_was_inline_html = is_inline_html;
        }
        if indent {
            self.dedent();
        }
    }
}
