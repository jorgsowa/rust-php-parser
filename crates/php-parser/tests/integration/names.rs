use php_ast::ast::*;
use php_ast::visitor::{walk_program, Visitor};
use php_rs_parser::{ParseOptions, PhpVersion};
use std::borrow::Cow;
use std::ops::ControlFlow;

/// Returns `join_parts_in` for every name in `src`, with whether it borrowed.
fn joined_names(src: &str, version: PhpVersion) -> Vec<(String, bool)> {
    struct Collector<'src> {
        src: &'src str,
        joined: Vec<(String, bool)>,
    }
    impl<'arena, 'src> Visitor<'arena, 'src> for Collector<'src> {
        type Break = ();
        fn visit_name(&mut self, name: &Name<'arena, 'src>) -> ControlFlow<()> {
            let joined = name.join_parts_in(self.src);
            assert_eq!(joined, name.join_parts());
            let borrowed = matches!(joined, Cow::Borrowed(_));
            self.joined.push((joined.into_owned(), borrowed));
            ControlFlow::Continue(())
        }
    }
    let arena = bumpalo::Bump::new();
    let result =
        php_rs_parser::parse_arena_with(&arena, src, &ParseOptions::default().version(version));
    assert!(result.errors.is_empty(), "{:?}", result.errors);
    let mut collector = Collector {
        src,
        joined: Vec::new(),
    };
    let _ = walk_program(&mut collector, &result.program);
    collector.joined
}

fn names(src: &str) -> Vec<(String, bool)> {
    joined_names(src, PhpVersion::default())
}

fn borrowed(name: &str) -> (String, bool) {
    (name.to_string(), true)
}

fn owned(name: &str) -> (String, bool) {
    (name.to_string(), false)
}

#[test]
fn join_parts_in_borrows_contiguous_names() {
    assert_eq!(
        names("<?php foo(); Foo\\bar(); \\Foo\\Bar\\baz(); \\strlen(); namespace\\Foo\\f(); NAMESPACE\\g();"),
        [
            borrowed("foo"),
            borrowed("Foo\\bar"),
            borrowed("Foo\\Bar\\baz"),
            borrowed("strlen"),
            borrowed("Foo\\f"),
            borrowed("g"),
        ]
    );
}

#[test]
fn join_parts_in_handles_whitespace_before_php_80() {
    assert_eq!(
        joined_names(
            "<?php Foo \\ bar(); \\ Foo\\Bar(); namespace \\ Foo\\f(); Foo\\/* c */Bar\\baz();",
            PhpVersion::Php74
        ),
        [
            owned("Foo\\bar"),
            borrowed("Foo\\Bar"),
            borrowed("Foo\\f"),
            owned("Foo\\Bar\\baz"),
        ]
    );
}

#[test]
fn join_parts_in_joins_group_use_names() {
    let joined = names("<?php use A\\{B, C\\D}; use \\E\\{F};");
    assert!(
        joined.contains(&owned("A\\B"))
            && joined.contains(&owned("A\\C\\D"))
            && joined.contains(&owned("E\\F")),
        "{joined:?}"
    );
}

#[test]
fn join_parts_borrows_single_part_names() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(&arena, "<?php \\strlen(); namespace\\foo();");
    let mut seen = 0;
    struct Check<'a>(&'a mut usize);
    impl<'arena, 'src> Visitor<'arena, 'src> for Check<'_> {
        type Break = ();
        fn visit_name(&mut self, name: &Name<'arena, 'src>) -> ControlFlow<()> {
            assert!(matches!(name.join_parts(), Cow::Borrowed(_)), "{name:?}");
            *self.0 += 1;
            ControlFlow::Continue(())
        }
    }
    let _ = walk_program(&mut Check(&mut seen), &result.program);
    assert_eq!(seen, 2);
}

#[test]
fn to_string_repr_prefixes_fully_qualified_names() {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_arena(
        &arena,
        "<?php \\strlen(); \\Foo\\Bar\\baz(); Foo\\bar(); foo();",
    );
    struct Reprs(Vec<String>);
    impl<'arena, 'src> Visitor<'arena, 'src> for Reprs {
        type Break = ();
        fn visit_name(&mut self, name: &Name<'arena, 'src>) -> ControlFlow<()> {
            self.0.push(name.to_string_repr().into_owned());
            ControlFlow::Continue(())
        }
    }
    let mut reprs = Reprs(Vec::new());
    let _ = walk_program(&mut reprs, &result.program);
    assert_eq!(reprs.0, ["\\strlen", "\\Foo\\Bar\\baz", "Foo\\bar", "foo"]);
}
