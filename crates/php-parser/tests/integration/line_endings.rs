//! CRLF sources: blank lines inside an indented heredoc/nowdoc carry a
//! trailing `\r` and must still count as empty for the indentation check.

fn parse_errors(code: &str) -> Vec<String> {
    let result = php_rs_parser::parse(code);
    result.errors.iter().map(|e| e.to_string()).collect()
}

#[test]
fn crlf_indented_nowdoc_with_blank_lines_has_no_errors() {
    let code = "<?php\n$x = <<<'MD'\n    first\n\n    second\n    MD;\n".replace('\n', "\r\n");
    assert_eq!(parse_errors(&code), Vec::<String>::new());
}

#[test]
fn crlf_indented_heredoc_with_blank_lines_has_no_errors() {
    let code = "<?php\n$x = <<<MD\n    first\n\n    second\n    MD;\n".replace('\n', "\r\n");
    assert_eq!(parse_errors(&code), Vec::<String>::new());
}

#[test]
fn crlf_under_indented_body_line_still_errors() {
    let code = "<?php\n$x = <<<'MD'\n  short\n    MD;\n".replace('\n', "\r\n");
    let errors = parse_errors(&code);
    assert!(
        errors
            .iter()
            .any(|e| e.contains("Invalid body indentation level")),
        "expected indentation error, got: {errors:?}"
    );
}
