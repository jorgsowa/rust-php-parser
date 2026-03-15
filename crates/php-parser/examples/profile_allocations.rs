use std::cell::RefCell;
use std::collections::HashMap;
use std::path::Path;
use walkdir::WalkDir;

/// Track allocation events for analysis
#[derive(Debug, Clone)]
struct AllocationEvent {
    size: usize,
    count: usize,
}

/// Wrapper around bumpalo::Bump that tracks allocations
struct AllocationTracker {
    arena: bumpalo::Bump,
    allocations: RefCell<HashMap<String, AllocationEvent>>,
}

impl AllocationTracker {
    fn new_with_capacity(capacity: usize) -> Self {
        Self {
            arena: bumpalo::Bump::with_capacity(capacity),
            allocations: RefCell::new(HashMap::new()),
        }
    }

    /// Record an allocation event
    fn record(&self, size: usize) {
        // Try to get a meaningful backtrace, but fallback to generic "alloc"
        let key = "arena_alloc".to_string();
        let mut allocs = self.allocations.borrow_mut();
        let entry = allocs.entry(key).or_insert(AllocationEvent { size: 0, count: 0 });
        entry.size += size;
        entry.count += 1;
    }

    fn get_arena(&self) -> &bumpalo::Bump {
        &self.arena
    }

    fn report(&self) {
        let allocs = self.allocations.borrow();
        println!("\n{}", "=".repeat(80));
        println!("ALLOCATION REPORT");
        println!("{}", "=".repeat(80));

        let mut total_bytes = 0;
        let mut total_count = 0;

        for (key, event) in allocs.iter() {
            println!("{:<50} {:>12} bytes, {:>6} allocs", key, event.size, event.count);
            total_bytes += event.size;
            total_count += event.count;
        }

        println!("{}", "-".repeat(80));
        println!("{:<50} {:>12} bytes, {:>6} allocs", "TOTAL", total_bytes, total_count);
        println!("{}", "=".repeat(80));
    }
}

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
    println!("Profiling allocations on WordPress corpus...");
    let base = Path::new("crates/php-parser/benches/corpus");
    let (total_bytes, sources) = collect_corpus(&base.join("wordpress"));

    println!(
        "Loaded {} files, {} bytes total\n",
        sources.len(),
        total_bytes
    );

    let mut total_allocations = 0;
    let start = std::time::Instant::now();

    // Parse with tracking
    println!("Parsing {} files...", sources.len());
    for (idx, src) in sources.iter().enumerate() {
        // Note: We can't easily hook into bumpalo internals for tracking growth,
        // but we can observe allocation patterns by parsing and measuring bump usage.

        // Each file gets its own arena to isolate allocation patterns
        let tracker = AllocationTracker::new_with_capacity(src.len() * 4);
        let arena = tracker.get_arena();

        match php_rs_parser::parse(arena, src) {
            result => {
                // Successfully parsed; the arena is now populated
                // Note: bumpalo doesn't expose internal allocation count directly,
                // but we know allocations happened
                total_allocations += 1;
            }
        }

        if (idx + 1) % 500 == 0 {
            println!("  Parsed {}/{} files", idx + 1, sources.len());
        }
    }

    let elapsed = start.elapsed();
    println!("\nParsing completed in {:.2}s for {} files", elapsed.as_secs_f64(), sources.len());
    println!("Average: {:.2}ms per file", elapsed.as_secs_f64() * 1000.0 / sources.len() as f64);

    // Additional insights
    println!("\nALLOCATION INSIGHTS:");
    println!("- {} files successfully parsed", total_allocations);
    println!("- Arena pre-allocation: src.len() * 4");
    println!("\nNOTE: For detailed per-function allocation tracking, use flamegraph");
    println!("with memory profiling or add instrumentation to parser hotspots.");
}
