use std::cmp::Ordering;
use std::ops::Range;

use php_ast::ast::*;

use super::Printer;

/// Output order of a statement list whose runs of `use` imports are sorted.
pub(crate) struct SortedImports {
    /// Source index of the statement printed at each position.
    pub(crate) order: Vec<usize>,
    /// Position ranges of the runs that were reordered.
    pub(crate) groups: Vec<Range<usize>>,
}

fn kind_rank(kind: UseKind) -> u8 {
    match kind {
        UseKind::Normal => 0,
        UseKind::Function => 1,
        UseKind::Const => 2,
        _ => 3,
    }
}

fn item_kind(decl: &UseDecl, item: &UseItem) -> UseKind {
    item.kind.unwrap_or(decl.kind)
}

fn cmp_ignore_case(a: &str, b: &str) -> Ordering {
    a.bytes()
        .map(|c| c.to_ascii_lowercase())
        .cmp(b.bytes().map(|c| c.to_ascii_lowercase()))
}

/// Kind, then name segment by segment ignoring case, then exact name, then alias.
pub(crate) fn cmp_use_items(
    decl_a: &UseDecl,
    a: &UseItem,
    decl_b: &UseDecl,
    b: &UseItem,
) -> Ordering {
    kind_rank(item_kind(decl_a, a))
        .cmp(&kind_rank(item_kind(decl_b, b)))
        .then_with(|| {
            let (pa, pb) = (a.name.parts_slice(), b.name.parts_slice());
            pa.iter()
                .zip(pb)
                .map(|(x, y)| cmp_ignore_case(x, y))
                .find(|o| o.is_ne())
                .unwrap_or_else(|| pa.len().cmp(&pb.len()))
        })
        .then_with(|| a.name.parts_slice().cmp(b.name.parts_slice()))
        .then_with(|| {
            fn alias<'a>(item: &'a UseItem) -> Option<&'a str> {
                item.alias.map(|a| a.or_error())
            }
            alias(a).cmp(&alias(b))
        })
}

/// The items of `decl` sorted, or `None` if they already are.
pub(crate) fn sorted_use_items<'a, 'arena, 'src>(
    decl: &'a UseDecl<'arena, 'src>,
) -> Option<Vec<&'a UseItem<'arena, 'src>>> {
    let sorted = decl
        .uses
        .windows(2)
        .all(|w| cmp_use_items(decl, &w[0], decl, &w[1]).is_le());
    if sorted {
        return None;
    }
    let mut items: Vec<_> = decl.uses.iter().collect();
    items.sort_by(|a, b| cmp_use_items(decl, a, decl, b));
    Some(items)
}

fn as_use<'a, 'arena, 'src>(stmt: &'a Stmt<'arena, 'src>) -> Option<&'a UseDecl<'arena, 'src>> {
    match &stmt.kind {
        StmtKind::Use(decl) => Some(decl),
        _ => None,
    }
}

fn first_item<'a, 'arena, 'src>(
    decl: &'a UseDecl<'arena, 'src>,
) -> Option<&'a UseItem<'arena, 'src>> {
    decl.uses
        .iter()
        .min_by(|a, b| cmp_use_items(decl, a, decl, b))
}

fn cmp_use_stmts(a: &UseDecl, b: &UseDecl) -> Ordering {
    match (first_item(a), first_item(b)) {
        (Some(x), Some(y)) => cmp_use_items(a, x, b, y),
        (None, None) => Ordering::Equal,
        (None, Some(_)) => Ordering::Greater,
        (Some(_), None) => Ordering::Less,
    }
}

impl Printer<'_> {
    /// Sorts each run of consecutive `use` statements; a blank line in the source ends a run.
    pub(crate) fn sorted_imports(&self, stmts: &[Stmt]) -> Option<SortedImports> {
        let mut result: Option<SortedImports> = None;
        let mut start = 0;
        while start < stmts.len() {
            if as_use(&stmts[start]).is_none() {
                start += 1;
                continue;
            }
            let mut end = start + 1;
            while end < stmts.len()
                && as_use(&stmts[end]).is_some()
                && !self.blank_line_before(stmts[end].span.start, stmts[end - 1].span.end)
            {
                end += 1;
            }
            let run = &stmts[start..end];
            let sorted = run
                .windows(2)
                .all(|w| match (as_use(&w[0]), as_use(&w[1])) {
                    (Some(a), Some(b)) => cmp_use_stmts(a, b).is_le(),
                    _ => true,
                });
            if !sorted {
                let sorted_imports = result.get_or_insert_with(|| SortedImports {
                    order: (0..stmts.len()).collect(),
                    groups: Vec::new(),
                });
                sorted_imports.order[start..end].sort_by(|&a, &b| {
                    match (as_use(&stmts[a]), as_use(&stmts[b])) {
                        (Some(a), Some(b)) => cmp_use_stmts(a, b),
                        _ => Ordering::Equal,
                    }
                });
                sorted_imports.groups.push(start..end);
            }
            start = end;
        }
        result
    }

    /// True if the source has a blank line between `from` and `to`, ignoring what a comment hides.
    fn blank_line_before(&self, to: u32, from: u32) -> bool {
        let from = self.same_line_comments_end(from);
        let first_comment = self.comments.partition_point(|c| c.span.start < from);
        let scan_to = self
            .comments
            .get(first_comment)
            .map_or(to, |c| c.span.start.min(to));
        self.blank_lines_between(from, scan_to) > 0
    }
}
