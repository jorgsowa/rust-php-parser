//! Measure memory allocation on real corpus files.
//!
//! Run with: cargo run --release --example measure_real_allocation
//!
//! This measures actual memory usage on real PHP files to validate
//! the right-sizing optimization.

use std::path::Path;
use walkdir::WalkDir;

fn main() {
    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║        Real Corpus Memory Usage Measurement (March 2026)        ║");
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    let corpus_base = "crates/php-parser/benches/corpus";

    for corpus_name in &["laravel", "symfony", "wordpress"] {
        analyze_corpus(corpus_base, corpus_name);
    }

    println!("\n✅ Memory measurement complete!");
}

fn analyze_corpus(base: &str, corpus_name: &str) {
    let corpus_path = format!("{}/{}", base, corpus_name);
    let path = Path::new(&corpus_path);

    if !path.exists() {
        eprintln!("⚠️  Corpus not found: {}", corpus_path);
        return;
    }

    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║ {:<64} ║", format!("Corpus: {}", corpus_name.to_uppercase()));
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    let mut file_count = 0;
    let mut total_source_bytes = 0u64;
    let mut total_arena_bytes = 0u64;
    let mut allocation_ratios = Vec::new();

    // Measure memory for each file
    for entry in WalkDir::new(&corpus_path)
        .into_iter()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().map_or(false, |ext| ext == "php"))
    {
        let file_path = entry.path();
        if let Ok(contents) = std::fs::read_to_string(file_path) {
            let source_size = contents.len() as u64;

            // Allocate arena with 5x pre-allocation (our current setting)
            let arena = bumpalo::Bump::with_capacity((source_size as usize) * 5);
            let before = arena.allocated_bytes() as u64;

            // Parse the file
            let _ = php_rs_parser::parse(&arena, &contents);

            let after = arena.allocated_bytes() as u64;
            let arena_size = after;
            let ratio = arena_size as f64 / source_size as f64;

            total_source_bytes += source_size;
            total_arena_bytes += arena_size;
            allocation_ratios.push(ratio);
            file_count += 1;

            if file_count % 500 == 0 {
                eprint!(".");
            }
        }
    }
    eprintln!(" ✓");

    // Calculate statistics
    let avg_ratio = if !allocation_ratios.is_empty() {
        allocation_ratios.iter().sum::<f64>() / allocation_ratios.len() as f64
    } else {
        0.0
    };

    let min_ratio = allocation_ratios.iter().cloned()
        .fold(f64::INFINITY, f64::min);
    let max_ratio = allocation_ratios.iter().cloned()
        .fold(0.0, f64::max);

    println!("Files analyzed:                      {:>20}", file_count);
    println!("Total source size:                   {:>20.1} MB", total_source_bytes as f64 / 1_000_000.0);
    println!("Total arena usage:                   {:>20.1} MB", total_arena_bytes as f64 / 1_000_000.0);
    println!();

    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("Allocation Ratio Statistics:");
    println!("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    println!("Average ratio:                       {:>20.2}x", avg_ratio);
    println!("Min ratio:                           {:>20.2}x", min_ratio);
    println!("Max ratio:                           {:>20.2}x", max_ratio);

    // Distribution analysis
    let percentiles = [10, 25, 50, 75, 90, 95, 99];
    let mut sorted = allocation_ratios.clone();
    sorted.sort_by(|a, b| a.partial_cmp(b).unwrap());

    println!();
    println!("Percentile distribution:");
    for p in &percentiles {
        let idx = (sorted.len() * p / 100).min(sorted.len() - 1);
        println!("  {}th percentile:                      {:>18.2}x", p, sorted[idx]);
    }

    println!("\n");
}
