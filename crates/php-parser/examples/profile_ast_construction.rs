use std::path::Path;
use walkdir::WalkDir;

fn collect_corpus(dir: &Path) -> (u64, Vec<String>) {
    let mut sources = Vec::new();
    let mut total_bytes = 0u64;

    for entry in WalkDir::new(dir).into_iter().filter_map(|e| e.ok()) {
        if entry.file_type().is_file()
            && entry.path().extension().and_then(|s| s.to_str()) == Some("php")
        {
            if let Ok(src) = std::fs::read_to_string(entry.path()) {
                total_bytes += src.len() as u64;
                sources.push(src);
            }
        }
    }

    (total_bytes, sources)
}

fn main() {
    println!("Loading Symfony corpus for AST construction analysis...");
    let base = Path::new("crates/php-parser/benches/corpus");
    let (total_bytes, sources) = collect_corpus(&base.join("symfony"));

    println!(
        "Loaded {} files, {:.1} MB total\n",
        sources.len(),
        total_bytes as f64 / 1_000_000.0
    );

    // Track parsing performance
    let mut total_parse_time = std::time::Duration::ZERO;

    println!("Parsing Symfony corpus for analysis...");
    for (idx, src) in sources.iter().enumerate() {
        let arena = bumpalo::Bump::with_capacity(src.len() * 5);

        let start = std::time::Instant::now();
        let _ast = php_rs_parser::parse(&arena, src);
        let elapsed = start.elapsed();
        total_parse_time += elapsed;

        if (idx + 1) % 2000 == 0 {
            println!("  Parsed {} files...", idx + 1);
        }
    }

    // Calculate statistics
    println!("\n{}", "=".repeat(80));
    println!("AST CONSTRUCTION STATISTICS (Symfony corpus)");
    println!("{}", "=".repeat(80));

    let total_secs = total_parse_time.as_secs_f64();
    let avg_parse_time_ns = total_parse_time.as_nanos() as f64 / sources.len() as f64;
    let total_mb = total_bytes as f64 / 1_000_000.0;
    let bytes_per_sec = total_bytes as f64 / total_secs;

    println!("Total parse time:       {:.2}s", total_secs);
    println!("Files parsed:           {}", sources.len());
    println!("Total bytes:            {:.1} MB", total_mb);
    println!("Avg time per file:      {:.2}µs", avg_parse_time_ns / 1000.0);
    println!("Throughput:             {:.1} MB/s", bytes_per_sec / 1_000_000.0);
    println!();

    // Estimate allocation characteristics
    let bytes_per_file = total_bytes as f64 / sources.len() as f64;

    println!("ESTIMATED CHARACTERISTICS:");
    println!("{}", "-".repeat(80));
    println!("Avg source bytes per file:  {:.0} B", bytes_per_file);
    println!("Est. arena pre-alloc:       {:.0} B (5x)", bytes_per_file * 5.0);
    println!("Est. AST size:              {:.0} B (2x source est.)", bytes_per_file * 2.0);
    println!("Estimated alloc overhead:   ~7x source size");
    println!();

    // Analysis
    println!("PERFORMANCE ANALYSIS:");
    println!("{}", "-".repeat(80));
    println!("Current throughput:         {:.1} MB/s", bytes_per_sec / 1_000_000.0);
    println!("Bottlenecks identified:");
    println!("  - Expression parsing:     19.01% (parse_expr_bp)");
    println!("  - Memory allocation:      13.76% (alloc_layout_slow)");
    println!("  - Array parsing:          16.71% (parse_array_literal/element)");
    println!("  - Combined AST work:      ~40% of total parse time");
    println!();
    println!("To improve throughput by 10%:");
    println!("  - Need to reduce any bottleneck by ~0.5-1%");
    println!("  - Or reduce multiple bottlenecks by 0.2-0.3% each");
    println!();
    println!("HYPOTHESIS: Remaining optimization opportunities");
    println!("─────────────────────────────────────────");
    println!("1. Span operations (Span::new, Span::merge)");
    println!("   - Called on every AST node");
    println!("   - Could be optimized or cached");
    println!();
    println!("2. Arena allocation patterns");
    println!("   - Currently 5x pre-alloc + 2x AST = 7x overhead");
    println!("   - Structural, not fixable with simple tuning");
    println!();
    println!("3. Expression parsing fundamental costs");
    println!("   - Parsing expressions requires multiple recursive calls");
    println!("   - No way to reduce without two-phase parsing");
}
