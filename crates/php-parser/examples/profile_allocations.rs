use std::path::Path;
use walkdir::WalkDir;

#[derive(Clone, Debug)]
struct FileStats {
    path: String,
    file_bytes: usize,
    #[allow(dead_code)]
    arena_bytes: usize,
    multiplier: f64,
}

fn collect_corpus(dir: &Path) -> Result<Vec<(String, String)>, Box<dyn std::error::Error>> {
    let mut sources = Vec::new();

    for entry in WalkDir::new(dir).into_iter().filter_map(|e| e.ok()) {
        if entry.file_type().is_file()
            && entry.path().extension().and_then(|s| s.to_str()) == Some("php")
        {
            if let Ok(src) = std::fs::read_to_string(entry.path()) {
                let rel_path = entry
                    .path()
                    .strip_prefix(dir)
                    .unwrap_or(entry.path())
                    .to_string_lossy()
                    .to_string();
                sources.push((rel_path, src));
            }
        }
    }

    Ok(sources)
}

fn main() -> Result<(), Box<dyn std::error::Error>> {
    println!("Profiling allocations on PHP corpus...");
    let base = Path::new("crates/php-parser/benches/corpus");
    let wordpress_dir = base.join("wordpress");

    if !wordpress_dir.exists() {
        eprintln!("WordPress corpus not found at: {}", wordpress_dir.display());
        eprintln!("Make sure submodules are initialized: git submodule update --init --recursive");
        return Ok(());
    }

    let sources = collect_corpus(&wordpress_dir)?;

    let total_source_bytes: usize = sources.iter().map(|(_, src)| src.len()).sum();
    println!(
        "WordPress corpus: {} files, {:.1} MB total\n",
        sources.len(),
        total_source_bytes as f64 / 1_000_000.0
    );

    let mut stats: Vec<FileStats> = Vec::with_capacity(sources.len());
    let start = std::time::Instant::now();

    println!("Parsing and measuring arena usage...");
    for (idx, (path, src)) in sources.iter().enumerate() {
        // Create arena with 5x pre-allocation (current standard)
        let arena = bumpalo::Bump::with_capacity(src.len() * 5);

        // Parse the source
        let _ = php_rs_parser::parse(&arena, src);

        // Measure actual bytes used
        let used = arena.allocated_bytes();
        let multiplier = used as f64 / src.len() as f64;

        stats.push(FileStats {
            path: path.clone(),
            file_bytes: src.len(),
            arena_bytes: used,
            multiplier,
        });

        if (idx + 1) % 500 == 0 {
            println!("  Parsed {}/{} files", idx + 1, sources.len());
        }
    }

    let elapsed = start.elapsed();
    println!(
        "Parsing completed in {:.2}s ({:.2}ms per file)\n",
        elapsed.as_secs_f64(),
        elapsed.as_secs_f64() * 1000.0 / sources.len() as f64
    );

    // Sort by multiplier descending for reporting overflows
    stats.sort_by(|a, b| b.multiplier.partial_cmp(&a.multiplier).unwrap());

    // Report files that overflow 5x pre-allocation
    let overflows: Vec<_> = stats.iter().filter(|s| s.multiplier > 5.0).collect();
    let overflow_pct = if !stats.is_empty() {
        (overflows.len() as f64 / stats.len() as f64) * 100.0
    } else {
        0.0
    };

    println!(
        "Files that overflow 5x pre-allocation: {}/{} ({:.1}%)",
        overflows.len(),
        stats.len(),
        overflow_pct
    );

    for s in overflows.iter().take(10) {
        println!(
            "  {:.2}x  {:>8} bytes  {}",
            s.multiplier, s.file_bytes, s.path
        );
    }

    // Compute percentile statistics
    let multipliers: Vec<f64> = stats.iter().map(|s| s.multiplier).collect();
    let mut sorted = multipliers.clone();
    sorted.sort_by(|a, b| a.partial_cmp(b).unwrap());

    let mean = sorted.iter().sum::<f64>() / sorted.len() as f64;
    let p50 = sorted[sorted.len() / 2];
    let p95 = sorted[(sorted.len() * 95) / 100];
    let p99 = sorted[(sorted.len() * 99) / 100];
    let max = *sorted.last().unwrap();
    let min = *sorted.first().unwrap();

    println!("\nMultiplier statistics (arena_bytes / file_bytes):");
    println!(
        "  min: {:.2}x  p50: {:.2}x  p95: {:.2}x  p99: {:.2}x  max: {:.2}x",
        min, p50, p95, p99, max
    );
    println!("  mean: {:.2}x", mean);

    // Histogram: files per multiplier range
    println!("\nHistogram (files per multiplier range):");
    let ranges = vec![
        (0.0, 1.0, "0.0–1.0x"),
        (1.0, 2.0, "1.0–2.0x"),
        (2.0, 3.0, "2.0–3.0x"),
        (3.0, 4.0, "3.0–4.0x"),
        (4.0, 5.0, "4.0–5.0x"),
        (5.0, 6.0, "5.0–6.0x"),
        (6.0, 10.0, "6.0–10.0x"),
    ];

    for (min, max, label) in ranges {
        let count = multipliers
            .iter()
            .filter(|m| **m >= min && **m < max)
            .count();
        let bar_width = (count as f64 / stats.len() as f64 * 40.0).ceil() as usize;
        let bar = "█".repeat(bar_width);
        println!("  {:10} [{:4} files] {}", label, count, bar);
    }

    let overflow_10_plus = multipliers.iter().filter(|m| **m >= 10.0).count();
    if overflow_10_plus > 0 {
        println!("  10.0+    x [  {} files]", overflow_10_plus);
    }

    // Summary and recommendation
    println!("\n{}", "=".repeat(80));
    if max < 6.0 {
        println!("✓ Current 5x pre-allocation is sufficient for this corpus.");
        println!("  Recommendation: Focus on expression parsing optimization.");
    } else if overflow_pct > 5.0 {
        println!(
            "⚠ {:.1}% of files overflow 5x pre-allocation.",
            overflow_pct
        );
        println!("  Recommendation: Increase pre-allocation to 6x or 7x.");
    } else {
        println!(
            "✓ Only {:.1}% of files overflow 5x pre-allocation.",
            overflow_pct
        );
        println!("  Recommendation: 5x is acceptable; monitor specific hotspots.");
    }
    println!("{}", "=".repeat(80));

    Ok(())
}
