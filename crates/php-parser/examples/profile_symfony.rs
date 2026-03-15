use std::path::Path;
use walkdir::WalkDir;

fn collect_corpus(dir: &Path) -> (u64, Vec<String>) {
    let mut sources = Vec::new();
    let mut total_bytes = 0u64;

    for entry in WalkDir::new(dir)
        .into_iter()
        .filter_map(|e| e.ok())
    {
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
    println!("Loading Symfony corpus for profiling...");
    let base = Path::new("crates/php-parser/benches/corpus");
    let (total_bytes, sources) = collect_corpus(&base.join("symfony"));

    println!(
        "Loaded {} files, {} bytes total\n",
        sources.len(),
        total_bytes
    );

    // Run profiling
    let guard = pprof::ProfilerGuardBuilder::default()
        .frequency(997)
        .build()
        .unwrap();

    println!("Starting Symfony parse profiling (30 iterations)...");
    let start = std::time::Instant::now();

    for iteration in 0..30 {
        for src in &sources {
            let arena = bumpalo::Bump::with_capacity(src.len() * 4);
            let _ = php_rs_parser::parse(&arena, src);
        }
        if (iteration + 1) % 5 == 0 {
            println!("  Iteration {} / 30", iteration + 1);
        }
    }

    let elapsed = start.elapsed();
    println!(
        "\nSymfony parse profiling completed in {:.2}s\n",
        elapsed.as_secs_f64()
    );

    println!("Generating flamegraph...");
    if let Ok(report) = guard.report().build() {
        match report.flamegraph(std::fs::File::create("flamegraph_symfony.svg").unwrap()) {
            Ok(_) => println!("✓ Flamegraph saved to flamegraph_symfony.svg"),
            Err(e) => eprintln!("Error writing flamegraph: {}", e),
        }
    }

    println!(
        "\nSymfony profiling complete. Open flamegraph_symfony.svg in a web browser."
    );
    println!("Compare with flamegraph.svg (WordPress) to identify Symfony-specific patterns.");
}
