mod decls;
mod exprs;
mod helpers;
mod imports;
mod stmts;
mod types;

use php_ast::Comment;

/// Configuration for the pretty printer.
#[derive(Debug, Clone, PartialEq, Eq)]
#[non_exhaustive]
pub struct PrinterConfig {
    /// Indentation style.
    pub indent: Indent,
    /// Line terminator.
    pub newline: Newline,
    /// Maximum blank lines preserved between statements. 0 normalizes all blank lines away.
    pub blank_lines_upper_bound: usize,
}

/// Indentation style.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[non_exhaustive]
pub enum Indent {
    /// Indent with this many spaces per level.
    Spaces(usize),
    /// Indent with one tab per level.
    Tabs,
}

/// Line terminator style.
#[derive(Debug, Clone, Copy, PartialEq, Eq, Default)]
#[non_exhaustive]
pub enum Newline {
    /// `\n`
    #[default]
    Lf,
    /// `\r\n`
    CrLf,
}

impl Newline {
    /// The line terminator text.
    pub fn as_str(self) -> &'static str {
        match self {
            Newline::Lf => "\n",
            Newline::CrLf => "\r\n",
        }
    }
}

impl Default for PrinterConfig {
    fn default() -> Self {
        Self {
            indent: Indent::Spaces(4),
            newline: Newline::Lf,
            blank_lines_upper_bound: 1,
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

/// Recursion guard for hand-built or folded trees. Chains (`$a . $b . …`,
/// `$x->a()->b()…`) are printed without recursing per link, so a tree from the
/// parser, whose nesting budget is 512 levels, stays far below this.
pub(crate) const MAX_DEPTH: usize = 2048;

pub(crate) struct Printer<'src> {
    output: String,
    indent_level: usize,
    indent_str: &'static str,
    nl: &'static str,
    blank_lines_upper_bound: usize,
    pub(crate) depth: usize,
    source: &'src str,
    comments: &'src [Comment<'src>],
    comment_cursor: usize,
    /// True when the printer is currently outside a PHP block (file started with HTML).
    /// Controls whether `?>` is emitted before InlineHtml nodes.
    in_html_mode: bool,
    /// True when at least one PHP statement has been emitted in the current PHP block.
    /// `?>` is only emitted when this is true — empty `<?php ?>` blocks are suppressed.
    has_php_content: bool,
    /// True while nothing follows the expression being printed before the end
    /// of its statement, argument or parentheses, so an arrow function, whose
    /// body runs as far right as it can, needs no parentheses there.
    pub(crate) at_tail: bool,
    /// Start of the node whose doc comment is printed next; comments between the two
    /// are printed right after the doc comment, in source order.
    pub(crate) doc_comment_node_start: Option<u32>,
    /// Set once a comment has broken the method chain being printed onto continuation lines.
    pub(crate) in_chain_continuation: bool,
}

impl<'src> Printer<'src> {
    pub fn with_comments(
        config: &PrinterConfig,
        source: &'src str,
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
            nl: config.newline.as_str(),
            blank_lines_upper_bound: config.blank_lines_upper_bound,
            depth: 0,
            source,
            comments,
            comment_cursor: 0,
            in_html_mode: false,
            has_php_content: false,
            at_tail: true,
            doc_comment_node_start: None,
            in_chain_continuation: false,
        }
    }

    pub fn into_output(self) -> String {
        self.output
    }

    /// Marks a node this printer version cannot print. The AST enums are
    /// `#[non_exhaustive]`; a marker keeps the output visibly wrong (and
    /// unparseable) instead of silently dropping the node.
    pub(crate) fn unsupported(&mut self, what: &str) {
        self.w("/* unsupported ");
        self.w(what);
        self.w(" */");
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

    /// Count blank lines in source between two byte offsets, capped at `blank_lines_upper_bound`.
    /// Returns 0 when no source is available (e.g. `pretty_print` without source).
    pub(crate) fn blank_lines_between(&self, from: u32, to: u32) -> usize {
        if self.source.is_empty() || from >= to {
            return 0;
        }
        let from = from as usize;
        let to = (to as usize).min(self.source.len());
        let newlines = self.source.as_bytes()[from..to]
            .iter()
            .filter(|&&b| b == b'\n')
            .count();
        newlines.saturating_sub(1).min(self.blank_lines_upper_bound)
    }

    /// Move the comment cursor to the first comment at or after `offset`, but never before `floor`.
    pub(crate) fn seek_comments(&mut self, floor: usize, offset: u32) {
        let at = self.comments.partition_point(|c| c.span.start < offset);
        self.comment_cursor = floor.max(at);
    }

    /// Return the start offset of the first not-yet-emitted comment whose span
    /// starts before `before_offset`, or `None` if there is no such comment.
    pub(crate) fn first_pending_comment_before(&self, before_offset: u32) -> Option<u32> {
        self.comments[self.comment_cursor..]
            .iter()
            .find(|c| c.span.start < before_offset)
            .map(|c| c.span.start)
    }

    // =========================================================================
    // Comment emission
    // =========================================================================

    /// Flush the comments before a node starting at `node_start`, stopping at its doc
    /// comment at `doc_start` if it has one; the rest follow the doc comment.
    pub(crate) fn flush_comments_before_node(&mut self, node_start: u32, doc_start: Option<u32>) {
        match doc_start {
            Some(doc_start) => {
                self.flush_leading_comments(doc_start);
                self.doc_comment_node_start = Some(node_start);
            }
            None => self.flush_leading_comments(node_start),
        }
    }

    pub(crate) fn flush_leading_comments(&mut self, before_offset: u32) {
        while self.comment_cursor < self.comments.len() {
            let c = &self.comments[self.comment_cursor];
            if c.span.start >= before_offset {
                break;
            }
            self.leave_html_for_comment();
            self.emit_comment_standalone(c, false);
            self.comment_cursor += 1;
        }
    }

    /// Print pending block and doc comments that precede `before_offset` in
    /// place, so one inside an expression is not moved in front of the next
    /// statement, where a doc comment would attach to it. Line comments need a
    /// newline and are left for the next statement.
    pub(crate) fn flush_inline_comments(&mut self, before_offset: u32) {
        use php_ast::CommentKind;
        while let Some(c) = self.comments.get(self.comment_cursor) {
            if c.span.start >= before_offset
                || !matches!(c.kind, CommentKind::Block | CommentKind::Doc)
            {
                break;
            }
            self.w(c.text);
            self.w(" ");
            self.comment_cursor += 1;
        }
    }

    /// Open a PHP block so a comment is not printed as HTML.
    fn leave_html_for_comment(&mut self) {
        if self.in_html_mode {
            self.w("<?php");
            self.newline();
            self.in_html_mode = false;
            self.has_php_content = true;
        }
    }

    /// End of the comments that follow `after` on the same source line, or `after` if none.
    pub(crate) fn same_line_comments_end(&self, mut after: u32) -> u32 {
        let first = self.comments.partition_point(|c| c.span.start < after);
        for c in &self.comments[first..] {
            let gap = self
                .source
                .as_bytes()
                .get(after as usize..c.span.start as usize);
            if !gap.is_some_and(|g| g.iter().all(|b| matches!(b, b' ' | b'\t' | b','))) {
                break;
            }
            if c.kind == php_ast::CommentKind::Doc {
                break;
            }
            after = c.span.end;
        }
        after
    }

    /// Print pending comments that follow `after` on the same source line, separated from it
    /// only by spaces and commas. A line comment leaves the caller to start a new line.
    pub(crate) fn flush_same_line_comments(&mut self, mut after: u32) {
        use php_ast::CommentKind;
        while let Some(c) = self.comments.get(self.comment_cursor) {
            let gap = self
                .source
                .as_bytes()
                .get(after as usize..c.span.start as usize);
            let same_line = gap.is_some_and(|g| g.iter().all(|b| matches!(b, b' ' | b'\t' | b',')));
            if !same_line || c.kind == CommentKind::Doc {
                break;
            }
            self.w(" ");
            match c.kind {
                CommentKind::Line | CommentKind::Hash => self.w(c.text.trim()),
                _ => self.w(c.text),
            }
            after = c.span.end;
            self.comment_cursor += 1;
        }
    }

    /// Flush any pending comments whose offset precedes `block_start`.
    /// Emits a newline first, then each comment at the current indent level,
    /// and leaves the cursor on a freshly-indented new line.
    /// Returns `true` if any comments were flushed so the caller can skip its
    /// normal ` ` spacer before `{`.
    pub(crate) fn flush_gap_comments_before(&mut self, block_start: u32) -> bool {
        if !self.has_comments_before(block_start) {
            return false;
        }
        self.newline();
        self.flush_leading_comments(block_start);
        self.write_indent();
        true
    }

    pub(crate) fn flush_remaining_comments(&mut self) {
        if self.comment_cursor < self.comments.len()
            && !self.in_html_mode
            && !self.output.is_empty()
            && !self.output.ends_with('\n')
        {
            self.newline();
        }
        while self.comment_cursor < self.comments.len() {
            let c = &self.comments[self.comment_cursor];
            self.leave_html_for_comment();
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
                self.write_doc_comment(comment.text);
                self.newline();
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
            _ => self.w(comment.text),
        }
    }

    /// Write a doc comment re-indented to the current level, keeping each
    /// continuation `*` one column right of the opening `/`.
    pub(crate) fn write_doc_comment(&mut self, text: &str) {
        for (i, line) in text.lines().enumerate() {
            if i > 0 {
                self.newline();
                self.write_indent();
            }
            let line = if i == 0 { line.trim_end() } else { line.trim() };
            if i > 0 && line.starts_with('*') {
                self.w(" ");
            }
            self.w(line);
        }
    }

    /// True if a pending comment between `from` and `to` cannot be printed inline before
    /// the next item: a line comment, or any comment after `last_item_end`.
    pub(crate) fn comments_need_own_lines(&self, from: u32, to: u32, last_item_end: u32) -> bool {
        use php_ast::CommentKind;
        self.comments[self.comment_cursor..].iter().any(|c| {
            c.span.start > from
                && c.span.start < to
                && (matches!(c.kind, CommentKind::Line | CommentKind::Hash)
                    || c.span.start >= last_item_end)
        })
    }

    /// True if the first pending comment is a line comment between `from` and `to`.
    pub(crate) fn line_comment_between(&self, from: u32, to: u32) -> bool {
        use php_ast::CommentKind;
        self.comments.get(self.comment_cursor).is_some_and(|c| {
            c.span.start >= from
                && c.span.start < to
                && matches!(c.kind, CommentKind::Line | CommentKind::Hash)
        })
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
        // Check if first statement is InlineHtml at position 0 (truly starts with HTML, no PHP before it).
        // If span.start > 0, there was PHP content before this statement.
        let html_at_start = matches!(
            program.stmts.first().map(|s| (s.span.start, &s.kind)),
            Some((0, php_ast::ast::StmtKind::InlineHtml(_)))
        );
        if html_at_start {
            self.in_html_mode = true;
        } else if !program.stmts.is_empty() || !self.comments.is_empty() {
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
        let imports = self.sorted_imports(stmts);
        let mut group = 0;
        let mut group_floor = 0;
        let mut prev_was_inline_html = false;
        for k in 0..stmts.len() {
            let i = imports.as_ref().map_or(k, |s| s.order[k]);
            let stmt = &stmts[i];
            let is_nop = matches!(stmt.kind, php_ast::ast::StmtKind::Nop);
            let is_inline_html = matches!(stmt.kind, php_ast::ast::StmtKind::InlineHtml(_));

            if is_nop && prev_was_inline_html {
                prev_was_inline_html = is_inline_html;
                continue;
            }

            let in_group = imports
                .as_ref()
                .and_then(|s| s.groups.get(group))
                .filter(|g| g.contains(&k));
            if let Some(g) = in_group {
                if k == g.start {
                    group_floor = self.comment_cursor;
                }
                let prev_end = i.checked_sub(1).map_or(0, |p| stmts[p].span.end);
                self.seek_comments(group_floor, self.same_line_comments_end(prev_end));
            }

            // `?>` acts as `;`, so keeping both adds an empty statement, which a later `declare(encoding=...)` rejects.
            let mut close_tag_ends_declare = false;
            if is_inline_html && k > 0 && self.output.ends_with(';') {
                let prev = imports.as_ref().map_or(k - 1, |s| s.order[k - 1]);
                if matches!(&stmts[prev].kind, php_ast::ast::StmtKind::Declare(d) if d.body.is_none())
                {
                    self.output.pop();
                    close_tag_ends_declare = !self.has_comments_before(stmt.span.start);
                }
            }

            if close_tag_ends_declare {
                self.w(" ");
            } else if k > 0 && !self.in_html_mode {
                // When transitioning out of HTML mode the <?php + newline + indent
                // is emitted by print_stmt_inner, so skip the normal separators here.
                let decl_min =
                    if helpers::is_declaration(&stmt.kind) && self.blank_lines_upper_bound > 0 {
                        1
                    } else {
                        0
                    };
                let blank = if in_group.is_some_and(|g| k > g.start) {
                    decl_min
                } else if !self.source.is_empty() {
                    let prev_end = self.same_line_comments_end(stmts[k - 1].span.end);
                    let source_stmt = &stmts[k];
                    // Stop at the first pending comment before this statement so that
                    // newlines inside the comment text aren't mistaken for blank lines.
                    let lead_start = helpers::stmt_doc_comment_start(source_stmt)
                        .unwrap_or(source_stmt.span.start);
                    let scan_to = self
                        .first_pending_comment_before(lead_start)
                        .unwrap_or(lead_start);
                    self.blank_lines_between(prev_end, scan_to).max(decl_min)
                } else {
                    decl_min
                };
                self.newline();
                for _ in 0..blank {
                    self.newline();
                }
            }
            self.flush_comments_before_node(stmt.span.start, helpers::stmt_doc_comment_start(stmt));
            if !self.in_html_mode {
                self.write_indent();
            }
            self.print_stmt(stmt);
            if !is_inline_html {
                self.flush_same_line_comments(stmt.span.end);
            }

            if let Some(g) = in_group {
                if k + 1 == g.end {
                    self.seek_comments(
                        group_floor,
                        self.same_line_comments_end(stmts[g.end - 1].span.end),
                    );
                    group += 1;
                }
            }
            prev_was_inline_html = is_inline_html;
        }
        if indent {
            self.dedent();
        }
    }
}
