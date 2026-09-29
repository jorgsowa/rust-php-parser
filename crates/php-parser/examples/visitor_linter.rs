//! Minimal linter: flags `eval` and debug-function calls using `OwnedVisitor`.
//!
//! Run with: cargo run --example visitor_linter -- <file.php>

use std::ops::ControlFlow;

use php_ast::owned::{walk_owned_expr, Expr, ExprKind, OwnedVisitor};

const DEBUG_FUNCTIONS: &[&str] = &["var_dump", "print_r", "dd"];

struct Linter {
    findings: Vec<(u32, &'static str)>,
}

impl OwnedVisitor for Linter {
    fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
        match &expr.kind {
            ExprKind::Eval(_) => self.findings.push((expr.span.start, "avoid eval()")),
            ExprKind::FunctionCall(call) => {
                if let ExprKind::Identifier(name) = &call.name.kind {
                    if DEBUG_FUNCTIONS.contains(&name.as_ref()) {
                        self.findings.push((expr.span.start, "leftover debug call"));
                    }
                }
            }
            _ => {}
        }
        walk_owned_expr(self, expr)
    }
}

fn main() {
    let path = std::env::args()
        .nth(1)
        .expect("usage: visitor_linter <file.php>");
    let source = std::fs::read_to_string(&path).expect("cannot read file");
    let result = php_rs_parser::parse(&source);

    let mut linter = Linter {
        findings: Vec::new(),
    };
    let _ = linter.visit_program(&result.program);

    for (offset, message) in &linter.findings {
        let (line, col) = result.source_map.offset_to_line_col(*offset).to_one_based();
        println!("{path}:{line}:{col}: {message}");
    }
}
