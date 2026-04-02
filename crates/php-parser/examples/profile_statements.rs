//! Profile statement parsing on real PHP corpus files (Laravel, Symfony, WordPress).
//!
//! Run with: cargo run --release --example profile_statements --features instrument
//!
//! This analyzes all PHP files in the benchmark corpus and reports detailed
//! statement parsing statistics across the real-world codebases.

use php_rs_parser::instrument;
use std::path::Path;
use walkdir::WalkDir;

fn main() {
    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║       Statement Parsing: Real Corpus Analysis (Detailed)        ║");
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    let corpus_base = "crates/php-parser/benches/corpus";

    // Analyze each corpus
    for corpus_name in &["laravel", "symfony", "wordpress"] {
        analyze_corpus(corpus_base, corpus_name);
    }

    println!("\n✅ Statement parsing analysis complete!");
}

fn analyze_corpus(base: &str, corpus_name: &str) {
    let corpus_path = format!("{}/{}", base, corpus_name);
    let path = Path::new(&corpus_path);

    if !path.exists() {
        eprintln!("⚠️  Corpus not found: {}", corpus_path);
        return;
    }

    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!(
        "║ {:<64} ║",
        format!("Corpus: {}", corpus_name.to_uppercase())
    );
    println!("╚══════════════════════════════════════════════════════════════════╝");

    instrument::reset_stats();

    let arena = bumpalo::Bump::new();
    let mut file_count = 0;
    let mut total_bytes = 0u64;

    // Parse all PHP files in corpus
    for entry in WalkDir::new(&corpus_path)
        .into_iter()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().is_some_and(|ext| ext == "php"))
    {
        let path = entry.path();
        match std::fs::read_to_string(path) {
            Ok(contents) => {
                total_bytes += contents.len() as u64;
                php_rs_parser::parse(&arena, &contents);
                file_count += 1;

                // Progress indicator
                if file_count % 100 == 0 {
                    eprint!(".");
                }
            }
            Err(_e) => {
                // Skip files we can't read (e.g., invalid UTF-8)
            }
        }
    }

    eprintln!(" ✓");

    let stats = instrument::get_stats();

    // Calculate derived metrics
    let avg_bytes_per_file = if file_count > 0 {
        total_bytes as f64 / file_count as f64
    } else {
        0.0
    };

    // Report
    println!("Files analyzed:                     {:>20}", file_count);
    println!(
        "Total bytes:                        {:>20.1} MB",
        total_bytes as f64 / 1_000_000.0
    );
    println!(
        "Avg bytes/file:                     {:>20.0} B\n",
        avg_bytes_per_file
    );

    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("STATEMENT PARSING METRICS:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!(
        "Total statements:                   {:>20}",
        stats.parse_stmt_calls
    );

    let stmt_breakdown = StmtBreakdown {
        functions: stats.parse_function_calls,
        classes: stats.parse_class_calls,
        if_stmts: stats.parse_if_calls,
        loops: stats.parse_loop_calls,
        foreach: stats.parse_foreach_calls,
        switch: stats.parse_switch_calls,
        try_catch: stats.parse_try_calls,
        attributes: stats.parse_attribute_calls,
    };

    println!(
        "  Functions/methods:                {:>20}",
        stmt_breakdown.functions
    );
    println!(
        "  Classes/traits/interfaces:       {:>20}",
        stmt_breakdown.classes
    );
    println!(
        "  If statements:                   {:>20}",
        stmt_breakdown.if_stmts
    );
    println!(
        "  Loops (for/while/do):            {:>20}",
        stmt_breakdown.loops
    );
    println!(
        "  Foreach:                         {:>20}",
        stmt_breakdown.foreach
    );
    println!(
        "  Switch:                          {:>20}",
        stmt_breakdown.switch
    );
    println!(
        "  Try/catch:                       {:>20}",
        stmt_breakdown.try_catch
    );
    println!(
        "  Attributes:                      {:>20}",
        stmt_breakdown.attributes
    );

    // Calculate percentages
    let total = stats.parse_stmt_calls as f64;
    if total > 0.0 {
        println!("\nStatement distribution (%):");
        println!(
            "  Functions/methods:                {:>19.1}%",
            (stmt_breakdown.functions as f64 / total) * 100.0
        );
        println!(
            "  Classes/traits/interfaces:       {:>19.1}%",
            (stmt_breakdown.classes as f64 / total) * 100.0
        );
        println!(
            "  If statements:                   {:>19.1}%",
            (stmt_breakdown.if_stmts as f64 / total) * 100.0
        );
        println!(
            "  Loops (for/while/do):            {:>19.1}%",
            (stmt_breakdown.loops as f64 / total) * 100.0
        );
        println!(
            "  Foreach:                         {:>19.1}%",
            (stmt_breakdown.foreach as f64 / total) * 100.0
        );
        println!(
            "  Switch:                          {:>19.1}%",
            (stmt_breakdown.switch as f64 / total) * 100.0
        );
        println!(
            "  Try/catch:                       {:>19.1}%",
            (stmt_breakdown.try_catch as f64 / total) * 100.0
        );
        println!(
            "  Attributes:                      {:>19.1}%",
            (stmt_breakdown.attributes as f64 / total) * 100.0
        );
    }

    println!("\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("ARRAY & EXPRESSION PARSING METRICS (reference):");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!(
        "Total parse_expr() calls:           {:>20}",
        stats.parse_expr_calls
    );
    println!(
        "Array parsing overhead:            {:>20}",
        stats.parse_expr_array_second
    );

    let total_expr = stats.parse_expr_calls as f64;
    if total_expr > 0.0 {
        let array_overhead_pct = (stats.parse_expr_array_second as f64 / total_expr) * 100.0;
        println!(
            "  Array overhead (%):              {:>19.1}%",
            array_overhead_pct
        );
    }

    println!("\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("EFFICIENCY ANALYSIS:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

    let stmts_per_kb = (stats.parse_stmt_calls as f64) / (total_bytes as f64 / 1000.0);
    println!("Statements per KB of source:        {:>20.2}", stmts_per_kb);

    let avg_stmt_size = if stats.parse_stmt_calls > 0 {
        (total_bytes as f64) / (stats.parse_stmt_calls as f64)
    } else {
        0.0
    };
    println!(
        "Avg statement size:                 {:>20.0} bytes",
        avg_stmt_size
    );

    // Identify which statement type dominates
    let dominant_type = stmt_breakdown.get_dominant();
    println!("Dominant statement type:            {:>20}", dominant_type);

    println!("\n");
}

struct StmtBreakdown {
    functions: u64,
    classes: u64,
    if_stmts: u64,
    loops: u64,
    foreach: u64,
    switch: u64,
    try_catch: u64,
    attributes: u64,
}

impl StmtBreakdown {
    fn get_dominant(&self) -> String {
        let max = *[
            self.functions,
            self.classes,
            self.if_stmts,
            self.loops,
            self.foreach,
            self.switch,
            self.try_catch,
        ]
        .iter()
        .max()
        .unwrap_or(&0);

        if max == 0 {
            return "none".to_string();
        }

        if self.functions == max {
            return "Functions".to_string();
        }
        if self.classes == max {
            return "Classes".to_string();
        }
        if self.if_stmts == max {
            return "If statements".to_string();
        }
        if self.loops == max {
            return "Loops".to_string();
        }
        if self.foreach == max {
            return "Foreach".to_string();
        }
        if self.switch == max {
            return "Switch".to_string();
        }
        if self.try_catch == max {
            return "Try/Catch".to_string();
        }

        "unknown".to_string()
    }
}
