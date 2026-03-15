use criterion::{criterion_group, criterion_main, BenchmarkId, Criterion, Throughput};
use std::path::Path;
use std::time::Duration;

#[global_allocator]
static GLOBAL: mimalloc::MiMalloc = mimalloc::MiMalloc;

/// Collect all `.php` sources under `dir` into memory.
/// Returns the total byte count and a vec of file contents.
/// Pre-loading eliminates file I/O and OS page-cache variance from the hot loop.
fn collect_corpus(dir: &Path) -> (u64, Vec<String>) {
    let mut sources: Vec<String> = Vec::new();
    let mut total_bytes: u64 = 0;

    for entry in walkdir::WalkDir::new(dir)
        .follow_links(false)
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

fn bench_corpus(c: &mut Criterion, name: &str, dir: &Path) {
    let (total_bytes, sources) = collect_corpus(dir);
    if sources.is_empty() {
        eprintln!("corpus '{name}' not found at {dir:?} — skipping");
        return;
    }

    let mut group = c.benchmark_group("corpus");
    group.throughput(Throughput::Bytes(total_bytes));
    group.sample_size(10);
    group.measurement_time(Duration::from_secs(15));

    group.bench_function(
        BenchmarkId::new(name, format!("{} files", sources.len())),
        |b| {
            b.iter(|| {
                for src in &sources {
                    let arena = bumpalo::Bump::with_capacity(src.len() * 5);
                    std::hint::black_box(php_rs_parser::parse(&arena, src));
                }
            });
        },
    );

    group.finish();
}

fn bench_corpora(c: &mut Criterion) {
    let base = Path::new(env!("CARGO_MANIFEST_DIR")).join("benches/corpus");

    bench_corpus(c, "laravel", &base.join("laravel"));
    bench_corpus(c, "symfony", &base.join("symfony"));
    bench_corpus(c, "wordpress", &base.join("wordpress"));
}

criterion_group!(benches, bench_corpora);
criterion_main!(benches);
