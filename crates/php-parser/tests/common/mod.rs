pub fn parse_fixture(file: &str, expect_errors: bool) -> String {
    let base = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures/nikic");
    let source = std::fs::read_to_string(base.join(file))
        .unwrap_or_else(|e| panic!("Failed to read {file}: {e}"));
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, &source);
    if expect_errors {
        assert!(!result.errors.is_empty(), "Expected errors but got none");
    } else {
        assert!(
            result.errors.is_empty(),
            "Unexpected errors: {:?}",
            result.errors
        );
    }
    serde_json::to_string_pretty(&result.program).unwrap()
}

pub fn parse_code(source: &str, expect_errors: bool) -> String {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, source);
    if expect_errors {
        assert!(!result.errors.is_empty(), "Expected errors but got none");
    } else {
        assert!(
            result.errors.is_empty(),
            "Unexpected errors: {:?}",
            result.errors
        );
    }
    serde_json::to_string_pretty(&result.program).unwrap()
}

#[macro_export]
macro_rules! nikic_test {
    ($name:ident, $file:expr, errors) => {
        #[test]
        fn $name() {
            let json = common::parse_fixture($file, true);
            insta::assert_snapshot!(json);
        }
    };
    ($name:ident, $file:expr) => {
        #[test]
        fn $name() {
            let json = common::parse_fixture($file, false);
            insta::assert_snapshot!(json);
        }
    };
}
