//! Re-parse edited documents with one reusable `ParserContext`, as an LSP server would.
//!
//! Run with: cargo run --example lsp_reparse

use php_rs_parser::ParserContext;

fn main() {
    let mut ctx = ParserContext::new();

    let versions = [
        "<?php echo 1;",
        "<?php echo 1; function f() {",
        "<?php echo 1; function f() {}",
    ];

    for (i, text) in versions.iter().enumerate() {
        let result = ctx.reparse_owned(text);
        println!(
            "edit {}: {} statement(s), {} error(s)",
            i + 1,
            result.program.stmts.len(),
            result.errors.len()
        );
        for err in &result.errors {
            println!("  {err}");
        }
    }
}
