//! Profile array parsing on real PHP corpus files (Laravel, Symfony, WordPress).
//!
//! Run with: cargo run --release --example profile_corpus --features instrument
//!
//! This analyzes all PHP files in the benchmark corpus and reports detailed
//! array parsing statistics across the real-world codebases.

use php_rs_parser::instrument;
use std::path::Path;
use walkdir::WalkDir;

fn main() {
    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║        Array & Expression Parsing: Real Corpus Analysis          ║");
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    let corpus_base = "crates/php-parser/benches/corpus";

    // Analyze each corpus
    for corpus_name in &["laravel", "symfony", "wordpress"] {
        analyze_corpus(corpus_base, corpus_name);
    }

    println!("\n✅ Corpus analysis complete!");
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
        .filter(|e| e.path().extension().map_or(false, |ext| ext == "php"))
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
            Err(e) => {
                eprintln!("Error reading file {}: {}", path.display(), e);
            }
        }
    }

    eprintln!(" ✓");

    let stats = instrument::get_stats();

    // Calculate derived metrics
    let avg_array_size = if stats.parse_array_count > 0 {
        stats.parse_array_element_count as f64 / stats.parse_array_count as f64
    } else {
        0.0
    };

    let arrow_rate = if stats.parse_array_element_calls > 0 {
        (stats.parse_array_element_with_arrow as f64 / stats.parse_array_element_calls as f64)
            * 100.0
    } else {
        0.0
    };

    let simple_rate = if stats.parse_array_element_count > 0 {
        (stats.parse_array_simple_values as f64 / stats.parse_array_element_count as f64) * 100.0
    } else {
        0.0
    };

    let double_parse_pct = if stats.parse_expr_calls > 0 {
        (stats.parse_expr_array_second as f64 / stats.parse_expr_calls as f64) * 100.0
    } else {
        0.0
    };

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
    println!("ARRAY PARSING METRICS:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!(
        "Total arrays parsed:                {:>20}",
        stats.parse_array_count
    );
    println!(
        "Total array elements:               {:>20}",
        stats.parse_array_element_count
    );
    println!(
        "Average elements per array:         {:>20.1}",
        avg_array_size
    );
    println!(
        "Array elements with '=>':           {:>20}",
        stats.parse_array_element_with_arrow
    );
    println!("  => rate:                         {:>20.1}%", arrow_rate);
    println!(
        "Simple values (no operators):       {:>20}",
        stats.parse_array_simple_values
    );
    println!("  Simple value rate:              {:>20.1}%", simple_rate);

    println!("\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("EXPRESSION PARSING METRICS:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!(
        "Total parse_expr() calls:           {:>20}",
        stats.parse_expr_calls
    );
    println!(
        "Array: first expression calls:      {:>20}",
        stats.parse_expr_array_first
    );
    println!(
        "Array: second expression calls:     {:>20}",
        stats.parse_expr_array_second
    );
    println!(
        "  Double-parse overhead:           {:>20.1}%",
        double_parse_pct
    );
    println!(
        "parse_expr_bp recursive calls:      {:>20}",
        stats.parse_expr_bp_recursive_calls
    );
    println!(
        "parse_atom calls:                   {:>20}",
        stats.parse_atom_calls
    );

    println!("\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("EFFICIENCY ANALYSIS:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

    let arrays_per_kb = (stats.parse_array_count as f64) / (total_bytes as f64 / 1000.0);
    println!(
        "Arrays per KB of source:            {:>20.2}",
        arrays_per_kb
    );

    let elements_per_kb = (stats.parse_array_element_count as f64) / (total_bytes as f64 / 1000.0);
    println!(
        "Array elements per KB of source:    {:>20.2}",
        elements_per_kb
    );

    // Optimization potential
    let potential_savings = stats.parse_expr_array_second as f64;
    let total_expr_calls = stats.parse_expr_calls as f64;
    let potential_pct = (potential_savings / total_expr_calls) * 100.0;

    println!(
        "Potential improvement (if 2nd parse optimized): {:>8.1}%",
        potential_pct
    );

    println!("\n");
}
