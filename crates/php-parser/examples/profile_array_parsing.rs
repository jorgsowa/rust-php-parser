//! Profile array parsing with detailed instrumentation.
//!
//! Run with: cargo run --release --example profile_array_parsing --features instrument

use php_rs_parser::instrument;

fn main() {
    println!("Array Parsing Instrumentation Profile");
    println!("=====================================\n");

    // Create a bump arena for allocation
    let arena = bumpalo::Bump::new();

    // Test case 1: Simple indexed array
    println!("Test 1: Simple indexed array [1, 2, 3, ..., 100]");
    instrument::reset_stats();
    let code1 = "<?php $a = [".to_string()
        + &(1..=100)
            .map(|i| i.to_string())
            .collect::<Vec<_>>()
            .join(", ")
        + "];";
    php_rs_parser::parse(&arena, &code1);
    instrument::report_stats();

    // Test case 2: Mixed key-value (50% with =>)
    println!("\nTest 2: Mixed key-value array (50% with =>)");
    instrument::reset_stats();
    let mut code2 = String::from("<?php $b = [");
    for i in 0..100 {
        if i > 0 {
            code2.push_str(", ");
        }
        if i % 2 == 0 {
            code2.push_str(&format!("'key{}' => {}", i, i));
        } else {
            code2.push_str(&i.to_string());
        }
    }
    code2.push_str("];");
    php_rs_parser::parse(&arena, &code2);
    instrument::report_stats();

    // Test case 3: 100% key-value array
    println!("\nTest 3: 100% key-value array");
    instrument::reset_stats();
    let mut code3 = String::from("<?php $c = [");
    for i in 0..100 {
        if i > 0 {
            code3.push_str(", ");
        }
        code3.push_str(&format!("'key{}' => {}", i, i));
    }
    code3.push_str("];");
    php_rs_parser::parse(&arena, &code3);
    instrument::report_stats();

    // Test case 4: Complex expressions in values
    println!("\nTest 4: Complex expressions as values");
    instrument::reset_stats();
    let mut code4 = String::from("<?php $d = [");
    for i in 0..50 {
        if i > 0 {
            code4.push_str(", ");
        }
        code4.push_str(&format!("$a + $b * 2, 'k' => func($x) + 5"));
    }
    code4.push_str("];");
    php_rs_parser::parse(&arena, &code4);
    instrument::report_stats();

    // Test case 5: Nested arrays
    println!("\nTest 5: Nested arrays");
    instrument::reset_stats();
    let code5 = "<?php $e = [[1, 2, 3], [4, 5, 6], [7, 8, 9], \
                           ['a' => 10, 'b' => 20], \
                           ['x' => [1, 2], 'y' => [3, 4]]];";
    php_rs_parser::parse(&arena, &code5);
    instrument::report_stats();

    // Test case 6: Large array (simulating real-world config)
    println!("\nTest 6: Large array (simulating Symfony config)");
    instrument::reset_stats();
    let mut code6 = String::from("<?php $config = [");
    for i in 0..500 {
        if i > 0 {
            code6.push_str(",\n");
        }
        code6.push_str(&format!("'key_{}' => ['nested' => {}]", i, i));
    }
    code6.push_str("];");
    php_rs_parser::parse(&arena, &code6);
    instrument::report_stats();

    println!("\n=== Summary ===");
    println!("✅ Instrumentation complete!");
    println!("Compile with --features instrument to enable detailed profiling");
}
