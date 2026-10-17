//! Parse PHP, pretty-print it, and check the output re-parses to the same text.
//!
//! Run with: cargo run --example round_trip

use php_printer::{Indent, PrettyPrinter, PrinterConfig};

fn main() {
    let source = "<?php\n// greet\nfunction greet(string $n){return 'hi '.$n;}\n";

    let parsed = php_rs_parser::parse(source);
    let printed = PrettyPrinter::new()
        .comments(&parsed.source, &parsed.comments)
        .print(&parsed.program);
    println!("{printed}\n");

    let reparsed = php_rs_parser::parse(&printed);
    let again = PrettyPrinter::new()
        .comments(&reparsed.source, &reparsed.comments)
        .print(&reparsed.program);
    assert_eq!(printed, again, "printing is not idempotent");

    let mut config = PrinterConfig::default();
    config.indent = Indent::Spaces(2);
    println!(
        "{}",
        PrettyPrinter::new()
            .config(config)
            .comments(&parsed.source, &parsed.comments)
            .print(&parsed.program)
    );
}
