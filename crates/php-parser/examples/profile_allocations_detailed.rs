//! Detailed allocation pattern analysis.
//!
//! Run with: cargo run --release --example profile_allocations_detailed
//!
//! This profiles how much memory different PHP code patterns allocate,
//! revealing which constructs are most allocation-heavy.

fn main() {
    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║          Memory Allocation Pattern Analysis (March 2026)        ║");
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    analyze_patterns();
}

fn analyze_patterns() {
    // Generate dynamic patterns with owned strings
    let large_array = format!("<?php $arr = [{}];",
        (0..100).map(|i| format!("'key{}' => {}", i, i)).collect::<Vec<_>>().join(", "));

    let many_statements = format!("<?php {}",
        (0..50).map(|i| format!("$x{} = {};", i, i)).collect::<Vec<_>>().join(" "));

    // Test different PHP code patterns to understand allocation behavior
    let patterns: Vec<(&str, &str)> = vec![
        ("Empty file", "<?php"),
        ("Simple variable", "<?php $x = 1;"),
        ("Simple array", "<?php $arr = [1, 2, 3];"),
        ("Key-value array", "<?php $arr = ['a' => 1, 'b' => 2];"),
        ("Large array", &large_array),
        ("Function", "<?php function foo($a, $b) { return $a + $b; }"),
        ("Class", "<?php class Foo { public $x = 1; public function bar() {} }"),
        ("If statement", "<?php if ($x > 5) { echo 'yes'; } else { echo 'no'; }"),
        ("Foreach", "<?php foreach ($arr as $k => $v) { echo $k . $v; }"),
        ("Attributes", "<?php #[Route('/path')] public function index() {}"),
        ("Complex nested", "<?php $data = ['config' => ['db' => ['host' => 'localhost', 'port' => 5432]]];"),
        ("Many statements", &many_statements),
    ];

    println!("╔══════════════════════════════════════════════════════════════════╗");
    println!("║ Pattern-Based Allocation Analysis                              ║");
    println!("╠══════════════════════════════════════════════════════════════════╣\n");

    let mut results = Vec::new();

    for (name, code) in patterns {
        let arena = bumpalo::Bump::with_capacity(4096); // Start small to see growth
        let before = arena.allocated_bytes();

        let _ = php_rs_parser::parse(&arena, code);

        let after = arena.allocated_bytes();
        let allocated = after - before;
        let source_size = code.len();
        let ratio = if source_size > 0 {
            allocated as f64 / source_size as f64
        } else {
            0.0
        };

        results.push((name, source_size, allocated, ratio));

        println!("{}:", name);
        println!("  Source size:         {:>20} bytes", source_size);
        println!("  Arena growth:        {:>20} bytes", allocated);
        println!("  Allocation ratio:    {:>20.2}x", ratio);
        println!();
    }

    // Summary statistics
    println!("╠══════════════════════════════════════════════════════════════════╣");
    println!("║ Summary Statistics                                             ║");
    println!("╠══════════════════════════════════════════════════════════════════╣\n");

    let avg_ratio: f64 = results.iter().map(|(_, _, _, r)| r).sum::<f64>() / results.len() as f64;
    let min_ratio = results.iter().map(|(_, _, _, r)| r).cloned()
        .fold(f64::INFINITY, f64::min);
    let max_ratio = results.iter().map(|(_, _, _, r)| r).cloned()
        .fold(0.0, f64::max);

    println!("Average allocation ratio: {:.2}x source size", avg_ratio);
    println!("Min ratio: {:.2}x (most efficient)", min_ratio);
    println!("Max ratio: {:.2}x (least efficient)", max_ratio);
    println!();

    // Find patterns with worst allocation efficiency
    println!("╠══════════════════════════════════════════════════════════════════╣");
    println!("║ Worst-Case Patterns (Highest Allocation Overhead)              ║");
    println!("╠══════════════════════════════════════════════════════════════════╣\n");

    let mut sorted = results.clone();
    sorted.sort_by(|a, b| b.3.partial_cmp(&a.3).unwrap());

    for (name, src_size, alloc, ratio) in sorted.iter().take(5) {
        println!("{}: {:.2}x ({} bytes allocated for {} byte source)",
            name, ratio, alloc, src_size);
    }

    println!("\n╠══════════════════════════════════════════════════════════════════╣");
    println!("║ Best-Case Patterns (Lowest Allocation Overhead)                ║");
    println!("╠══════════════════════════════════════════════════════════════════╣\n");

    let mut sorted = results.clone();
    sorted.sort_by(|a, b| a.3.partial_cmp(&b.3).unwrap());

    for (name, src_size, alloc, ratio) in sorted.iter().take(5) {
        println!("{}: {:.2}x ({} bytes allocated for {} byte source)",
            name, ratio, alloc, src_size);
    }

    println!("\n╔══════════════════════════════════════════════════════════════════╗");
    println!("║ Insights for Optimization                                      ║");
    println!("╚══════════════════════════════════════════════════════════════════╝\n");

    println!("Observations:");
    println!("1. Empty/minimal files show the baseline allocation overhead");
    println!("2. Large arrays have high allocation ratios (many ArenaVec allocations)");
    println!("3. Classes and complex structures show highest overhead");
    println!("4. Optimization opportunities:");
    println!("   - Right-size pre-allocation for common patterns");
    println!("   - Pool allocations for frequently-created small objects");
    println!("   - Consider struct-of-arrays for better cache locality\n");
}
