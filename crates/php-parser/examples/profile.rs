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
    println!("Loading WordPress corpus...");
    let base = Path::new("crates/php-parser/benches/corpus");
    let (total_bytes, sources) = collect_corpus(&base.join("wordpress"));

    println!(
        "Loaded {} files, {} bytes total",
        sources.len(),
        total_bytes
    );

    // Run profiling
    let guard = pprof::ProfilerGuardBuilder::default()
        .frequency(997)
        .build()
        .unwrap();

    println!("Starting parse loop (30 iterations)...");
    let start = std::time::Instant::now();

    for iteration in 0..30 {
        for src in &sources {
            let arena = bumpalo::Bump::with_capacity(src.len() * 3);
            let _ = php_rs_parser::parse(&arena, src);
        }
        if (iteration + 1) % 5 == 0 {
            println!("  Iteration {} / 30", iteration + 1);
        }
    }

    let elapsed = start.elapsed();
    println!("Parse loop completed in {:.2}s", elapsed.as_secs_f64());

    println!("\nGenerating profiling reports...");
    if let Ok(report) = guard.report().build() {
        // Flamegraph
        match report.flamegraph(std::fs::File::create("flamegraph.svg").unwrap()) {
            Ok(_) => println!("✓ Flamegraph saved to flamegraph.svg"),
            Err(e) => eprintln!("Error writing flamegraph: {}", e),
        }

        // Protobuf (Google's format, can be analyzed further)
        match report.pprof() {
            Ok(profile) => {
                use std::io::Write;
                if let Ok(mut f) = std::fs::File::create("profile.pb") {
                    let _ = f.write_all(&profile);
                    println!("✓ Profile protobuf saved to profile.pb");
                }
            }
            Err(e) => eprintln!("Error creating pprof: {}", e),
        }
    }

    println!("\nTo analyze the flamegraph, open flamegraph.svg in a web browser.")
    println!("Most expensive functions should be clearly visible in the visualization.");
}
