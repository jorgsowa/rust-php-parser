/// Maps comments to the AST nodes they logically belong to.
///
/// Uses a span-proximity heuristic: each comment is associated with the first
/// AST statement whose span starts **at or after** the comment's end. Comments
/// that follow the last statement are collected as "trailing" comments.
///
/// # Example
///
/// ```
/// use php_ast::comment_map::CommentMap;
/// use php_ast::ast::Comment;
/// use php_ast::Span;
///
/// // Given parse result with comments and a program:
/// // let result = php_rs_parser::parse(&arena, source);
/// // let map = CommentMap::build(&result.comments, &result.program.stmts);
/// // let leading = map.leading_comments(some_stmt_span);
/// ```
use crate::ast::{Comment, Stmt};
use crate::Span;
use std::collections::BTreeMap;

/// Associates comments with statement spans using a leading-comment heuristic.
///
/// A comment is "leading" for a statement if it appears before the statement
/// and no other statement is closer. Comments after the last statement are
/// "trailing".
pub struct CommentMap<'a, 'src> {
    /// Maps statement start offset → comments that lead that statement.
    leading: BTreeMap<u32, Vec<&'a Comment<'src>>>,
    /// Comments that appear after all statements.
    trailing: Vec<&'a Comment<'src>>,
}

impl<'a, 'src> CommentMap<'a, 'src> {
    /// Build a comment map from a list of comments and statements.
    ///
    /// Both `comments` and `stmts` must be in source order (which they are
    /// as produced by the parser).
    pub fn build<'arena>(comments: &'a [Comment<'src>], stmts: &[Stmt<'arena, 'src>]) -> Self {
        let mut leading: BTreeMap<u32, Vec<&'a Comment<'src>>> = BTreeMap::new();
        let mut trailing: Vec<&'a Comment<'src>> = Vec::new();

        // Collect statement start offsets in sorted order
        let stmt_starts: Vec<u32> = stmts.iter().map(|s| s.span.start).collect();

        for comment in comments {
            // Find the first statement that starts at or after this comment ends
            match stmt_starts.binary_search(&comment.span.end) {
                Ok(idx) => {
                    leading.entry(stmt_starts[idx]).or_default().push(comment);
                }
                Err(idx) => {
                    if idx < stmt_starts.len() {
                        leading.entry(stmt_starts[idx]).or_default().push(comment);
                    } else {
                        trailing.push(comment);
                    }
                }
            }
        }

        Self { leading, trailing }
    }

    /// Get comments that lead the statement at the given span.
    pub fn leading_comments(&self, stmt_span: Span) -> &[&'a Comment<'src>] {
        self.leading
            .get(&stmt_span.start)
            .map(|v| v.as_slice())
            .unwrap_or(&[])
    }

    /// Get comments that appear after all statements.
    pub fn trailing_comments(&self) -> &[&'a Comment<'src>] {
        &self.trailing
    }

    /// Iterate over all (stmt_start_offset, comments) pairs.
    pub fn iter_leading(&self) -> impl Iterator<Item = (u32, &[&'a Comment<'src>])> {
        self.leading.iter().map(|(k, v)| (*k, v.as_slice()))
    }

    /// Returns true if no comments were mapped.
    pub fn is_empty(&self) -> bool {
        self.leading.is_empty() && self.trailing.is_empty()
    }

    /// Total number of comments in the map.
    pub fn len(&self) -> usize {
        self.leading.values().map(|v| v.len()).sum::<usize>() + self.trailing.len()
    }
}

#[cfg(test)]
mod tests {
    use super::*;
    use crate::ast::*;

    fn make_comment(start: u32, end: u32, text: &str) -> Comment<'_> {
        Comment {
            kind: CommentKind::Line,
            text,
            span: Span::new(start, end),
        }
    }

    fn make_stmt(start: u32, end: u32) -> Stmt<'static, 'static> {
        Stmt {
            kind: StmtKind::Nop,
            span: Span::new(start, end),
        }
    }

    #[test]
    fn comments_attach_to_following_stmt() {
        let comments = vec![
            make_comment(0, 10, "// first"),
            make_comment(11, 22, "// second"),
        ];
        let stmts = vec![make_stmt(23, 30), make_stmt(31, 40)];

        let map = CommentMap::build(&comments, &stmts);

        // Both comments lead the first statement
        let leading = map.leading_comments(stmts[0].span);
        assert_eq!(leading.len(), 2);
        assert_eq!(leading[0].text, "// first");
        assert_eq!(leading[1].text, "// second");

        // Second statement has no leading comments
        assert_eq!(map.leading_comments(stmts[1].span).len(), 0);
        assert!(map.trailing_comments().is_empty());
    }

    #[test]
    fn trailing_comments() {
        let comments = vec![make_comment(50, 60, "// trailing")];
        let stmts = vec![make_stmt(10, 40)];

        let map = CommentMap::build(&comments, &stmts);
        assert_eq!(map.leading_comments(stmts[0].span).len(), 0);
        assert_eq!(map.trailing_comments().len(), 1);
        assert_eq!(map.trailing_comments()[0].text, "// trailing");
    }

    #[test]
    fn no_comments() {
        let comments: Vec<Comment> = vec![];
        let stmts = vec![make_stmt(0, 10)];

        let map = CommentMap::build(&comments, &stmts);
        assert!(map.is_empty());
        assert_eq!(map.len(), 0);
    }

    #[test]
    fn no_stmts() {
        let comments = vec![make_comment(0, 5, "// alone")];
        let stmts: Vec<Stmt> = vec![];

        let map = CommentMap::build(&comments, &stmts);
        assert_eq!(map.trailing_comments().len(), 1);
    }

    #[test]
    fn interleaved_comments() {
        // comment1  stmt1  comment2  stmt2
        let comments = vec![make_comment(0, 8, "// c1"), make_comment(20, 28, "// c2")];
        let stmts = vec![make_stmt(10, 18), make_stmt(30, 40)];

        let map = CommentMap::build(&comments, &stmts);
        assert_eq!(map.leading_comments(stmts[0].span).len(), 1);
        assert_eq!(map.leading_comments(stmts[0].span)[0].text, "// c1");
        assert_eq!(map.leading_comments(stmts[1].span).len(), 1);
        assert_eq!(map.leading_comments(stmts[1].span)[0].text, "// c2");
    }

    #[test]
    fn len_counts_all() {
        let comments = vec![
            make_comment(0, 5, "// a"),
            make_comment(6, 10, "// b"),
            make_comment(50, 55, "// c"),
        ];
        let stmts = vec![make_stmt(11, 40)];

        let map = CommentMap::build(&comments, &stmts);
        assert_eq!(map.len(), 3);
    }
}
