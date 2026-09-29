//! Parse PHP, pretty-print it, and check the output re-parses to the same text.
//!
//! Run with: cargo run --example round_trip

use php_printer::{pretty_print_owned_with_comments, pretty_print_owned_with_comments_and_config};
use php_printer::{Indent, PrinterConfig};

fn main() {
    let source = "<?php\n// greet\nfunction greet(string $n){return 'hi '.$n;}\n";

    let parsed = php_rs_parser::parse(source);
    let printed =
        pretty_print_owned_with_comments(&parsed.program, &parsed.source, &parsed.comments);
    println!("{printed}\n");

    let reparsed = php_rs_parser::parse(&printed);
    let again =
        pretty_print_owned_with_comments(&reparsed.program, &reparsed.source, &reparsed.comments);
    assert_eq!(printed, again, "printing is not idempotent");

    let config = PrinterConfig {
        indent: Indent::Spaces(2),
        ..Default::default()
    };
    println!(
        "{}",
        pretty_print_owned_with_comments_and_config(
            &parsed.program,
            &parsed.source,
            &parsed.comments,
            &config
        )
    );
}
