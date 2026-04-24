//! Stress test: parse every PHP file in a corpus directory and report
//! panics, parse errors, and slow/huge files.
//!
//! Run with: cargo run --release --example stress_test -- <corpus_dir> [<corpus_dir> ...]

use std::panic::{catch_unwind, AssertUnwindSafe};
use std::path::{Path, PathBuf};
use std::time::Instant;
use walkdir::WalkDir;

struct CorpusReport {
    name: String,
    files: usize,
    bytes: u64,
    panics: Vec<(PathBuf, String)>,
    errored_files: usize,
    total_errors: usize,
    sample_errors: Vec<(PathBuf, String)>,
    elapsed_ms: u128,
    slowest: Vec<(PathBuf, u128, usize)>, // path, ms, size
}

fn main() {
    let args: Vec<String> = std::env::args().skip(1).collect();
    if args.is_empty() {
        eprintln!("Usage: stress_test <corpus_dir> [<corpus_dir> ...]");
        std::process::exit(2);
    }

    let mut reports = Vec::new();
    for dir in &args {
        let path = Path::new(dir);
        if !path.exists() {
            eprintln!("⚠️  Not found: {}", dir);
            continue;
        }
        let name = path
            .file_name()
            .map(|s| s.to_string_lossy().to_string())
            .unwrap_or_else(|| dir.clone());
        println!("▶ Scanning corpus: {} ({})", name, dir);
        reports.push(run_corpus(&name, path));
    }

    println!("\n════════════════════════════════════════════════════════════════════");
    println!("SUMMARY");
    println!("════════════════════════════════════════════════════════════════════");
    for r in &reports {
        println!(
            "\n[{}]  files={}  bytes={:.1} MB  panics={}  error_files={}  total_errors={}  time={} ms",
            r.name,
            r.files,
            r.bytes as f64 / 1_000_000.0,
            r.panics.len(),
            r.errored_files,
            r.total_errors,
            r.elapsed_ms
        );
        if !r.panics.is_empty() {
            println!("  PANICS:");
            for (p, msg) in &r.panics {
                println!("    {}: {}", p.display(), msg);
            }
        }
        if !r.sample_errors.is_empty() {
            println!("  Sample parse errors (up to 10):");
            for (p, e) in r.sample_errors.iter().take(10) {
                println!("    {}: {}", p.display(), e);
            }
        }
        if !r.slowest.is_empty() {
            println!("  Slowest 5 files:");
            for (p, ms, size) in r.slowest.iter().take(5) {
                println!("    {} ms  ({} bytes)  {}", ms, size, p.display());
            }
        }
    }

    let total_panics: usize = reports.iter().map(|r| r.panics.len()).sum();
    if total_panics > 0 {
        std::process::exit(1);
    }
}

fn run_corpus(name: &str, corpus_path: &Path) -> CorpusReport {
    let start = Instant::now();
    let mut files = 0usize;
    let mut bytes = 0u64;
    let mut panics = Vec::new();
    let mut errored_files = 0usize;
    let mut total_errors = 0usize;
    let mut sample_errors: Vec<(PathBuf, String)> = Vec::new();
    let mut slowest: Vec<(PathBuf, u128, usize)> = Vec::new();

    for entry in WalkDir::new(corpus_path)
        .into_iter()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().is_some_and(|ext| ext == "php"))
    {
        let file_path = entry.path().to_path_buf();
        let contents = match std::fs::read_to_string(&file_path) {
            Ok(s) => s,
            Err(_) => continue,
        };
        files += 1;
        bytes += contents.len() as u64;

        let file_start = Instant::now();
        let result = catch_unwind(AssertUnwindSafe(|| {
            let arena = bumpalo::Bump::with_capacity(contents.len() * 5);
            let r = php_rs_parser::parse(&arena, &contents);
            let first = r.errors.first().map(|e| format!("{}", e));
            (r.errors.len(), first)
        }));
        let elapsed = file_start.elapsed().as_millis();

        match result {
            Ok((err_count, first_err)) => {
                if err_count > 0 {
                    errored_files += 1;
                    total_errors += err_count;
                    if sample_errors.len() < 20 {
                        if let Some(msg) = first_err {
                            sample_errors.push((file_path.clone(), msg));
                        }
                    }
                }
            }
            Err(payload) => {
                let msg = panic_message(&payload);
                panics.push((file_path.clone(), msg));
                eprintln!("❌ PANIC in {}", file_path.display());
            }
        }

        if slowest.len() < 10 {
            slowest.push((file_path.clone(), elapsed, contents.len()));
            slowest.sort_by(|a, b| b.1.cmp(&a.1));
        } else if elapsed > slowest.last().map(|s| s.1).unwrap_or(0) {
            slowest.pop();
            slowest.push((file_path.clone(), elapsed, contents.len()));
            slowest.sort_by(|a, b| b.1.cmp(&a.1));
        }

        if files % 1000 == 0 {
            eprint!(".");
        }
    }
    eprintln!(" ✓ ({} files)", files);

    CorpusReport {
        name: name.to_string(),
        files,
        bytes,
        panics,
        errored_files,
        total_errors,
        sample_errors,
        elapsed_ms: start.elapsed().as_millis(),
        slowest,
    }
}

fn panic_message(payload: &Box<dyn std::any::Any + Send>) -> String {
    if let Some(s) = payload.downcast_ref::<&'static str>() {
        (*s).to_string()
    } else if let Some(s) = payload.downcast_ref::<String>() {
        s.clone()
    } else {
        "<non-string panic>".to_string()
    }
}
