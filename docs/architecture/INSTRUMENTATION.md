# Array & Expression Parsing Instrumentation

**Date:** March 16, 2026
**Purpose:** Detailed performance profiling of array parsing and expression parsing hot paths

## Overview

This document describes the instrumentation framework added to measure and profile array parsing behavior. The instrumentation is designed to answer specific questions about array parsing efficiency:

1. **What percentage of array elements have `=>`?** (key-value vs. simple values)
2. **How much overhead does the double `parse_expr()` call add?**
3. **How many simple vs. complex expressions are in typical arrays?**
4. **What's the parse_atom call frequency?**

## Building with Instrumentation

Compile with the `instrument` feature to enable profiling:

```bash
cargo build --release --features instrument
cargo run --release --example profile_array_parsing --features instrument
```

Without the feature, all instrumentation code compiles to zero overhead (inlined away).

## Instrumentation Points

The following functions are instrumented:

### Array Parsing

- **`record_parse_array()`** — Called once when parsing starts: `[...]` or `array(...)`
- **`record_parse_array_element()`** — Called for each array element
- **`record_parse_array_element_with_arrow()`** — Called when element has `=>`
- **`record_parse_array_element_count(n)`** — Records total elements in array
- **`record_parse_array_simple_value()`** — Incremented for simple values (no `=>`)

### Expression Parsing

- **`record_parse_expr()`** — Called at entry to `parse_expr()` (top-level)
- **`record_parse_expr_bp_recursive()`** — Called for recursive `parse_expr_bp()` calls (min_bp != 0)
- **`record_parse_expr_array_first()`** — Called before first `parse_expr()` in array element
- **`record_parse_expr_array_second()`** — Called before second `parse_expr()` (after `=>`)
- **`record_parse_atom()`** — Called when parsing atomic expressions

## Statistics Collected

The `InstrumentStats` struct tracks:

```rust
pub struct InstrumentStats {
    pub parse_expr_calls: u64,                    // Total parse_expr calls
    pub parse_expr_bp_recursive_calls: u64,       // Recursive calls (min_bp != 0)
    pub parse_array_element_calls: u64,           // Total elements
    pub parse_array_element_with_arrow: u64,      // Elements with =>
    pub parse_expr_array_first: u64,              // First expr per element
    pub parse_expr_array_second: u64,             // Second expr per element (=>)
    pub parse_array_count: u64,                   // Total arrays parsed
    pub parse_array_element_count: u64,           // Total elements across all arrays
    pub parse_atom_calls: u64,                    // parse_atom invocations
    pub parse_array_simple_values: u64,           // Elements without =>
}
```

## API

Located in `crates/php-parser/src/instrument.rs`:

### Recording Metrics
```rust
pub fn record_parse_expr()
pub fn record_parse_expr_bp_recursive()
pub fn record_parse_array()
pub fn record_parse_array_element()
pub fn record_parse_array_element_with_arrow()
pub fn record_parse_expr_array_first()
pub fn record_parse_expr_array_second()
pub fn record_parse_array_element_count(count: usize)
pub fn record_parse_atom()
pub fn record_parse_array_simple_value()
```

### Querying & Reporting
```rust
pub fn get_stats() -> InstrumentStats              // Get snapshot
pub fn report_stats()                              // Print formatted report
pub fn reset_stats()                               // Clear counters
```

## Example Output

```
╔════════════════════════════════════════════════════════════╗
║         Array & Expression Parsing Instrumentation         ║
╠════════════════════════════════════════════════════════════╣
║ Arrays Parsed:                                           1 ║
║ Array Elements Parsed:                                 100 ║
║ Array Elements with =>:                                100 ║
║ => Rate:                                              100.0% ║
╠════════════════════════════════════════════════════════════╣
║ Total parse_expr calls:                                201 ║
║ parse_expr calls (array, first):                       100 ║
║ parse_expr calls (array, second =>):                   100 ║
║ Double-parse overhead (%):                             49.8% ║
╠════════════════════════════════════════════════════════════╣
║ parse_atom calls:                                      202 ║
║ Simple array values (no operators):                      0 ║
║ Simple value rate:                                      0.0% ║
╚════════════════════════════════════════════════════════════╝
```

## Key Findings from Initial Profiling (March 16, 2026)

### Test Suite Summary

| Test Case | Arrays | Elements | => Rate | Double-Parse Overhead |
|-----------|--------|----------|---------|----------------------|
| Simple indexed (100 elements) | 1 | 100 | 0% | 0.0% |
| Mixed 50% key-value | 1 | 100 | 50% | 33.1% |
| Pure key-value (100 elements) | 1 | 100 | 100% | 49.8% |
| Complex expressions | 1 | 100 | 50% | 24.9% |
| Nested arrays | 8 | 22 | 18% | 14.8% |
| Symfony-style config (500 keys) | 501 | 1000 | 100% | 50.0% |

### Key Observations

1. **Double-parse overhead scales with `=>` rate**: 100% key-value arrays have ~50% overhead from the second `parse_expr()` call

2. **Simple value rate matters**: When 100% of values are simple (no operators), parse_atom is the dominant cost

3. **Complex expressions have lower relative overhead**: The second `parse_expr()` call in complex cases (24.9% overhead) is actually cheaper because the first expression parser already paid for recursion setup

4. **Nested arrays show lower overhead**: Only 18% of elements have `=>`, yielding 14.8% total overhead

5. **Symfony config is worst-case**: 100% key-value pattern shows the full 50% overhead from unavoidable double-parsing

## Optimization Opportunities (From Profiling)

Based on these metrics, consider:

1. **Fast-path for simple values** — If 81%+ of array values are atomic, could optimize common case
2. **Lookahead before first parse** — Could avoid parsing in some cases (though unlikely to provide benefit)
3. **Specialized `parse_post_arrow()` function** — Second expression after `=>` has different grammar restrictions
4. **Expression result caching** — If same pattern appears multiple times (unlikely in real code)

## Using in Custom Code

To instrument your own profiling:

```rust
// Enable feature in Cargo.toml:
// php-rs-parser = { ..., features = ["instrument"] }

use php_rs_parser::instrument;

fn main() {
    let arena = bumpalo::Bump::new();

    instrument::reset_stats();
    let result = php_rs_parser::parse(&arena, "<?php $x = [1, 2, 3];");
    instrument::report_stats();

    // Or inspect stats directly:
    let stats = instrument::get_stats();
    println!("Arrays: {}", stats.parse_array_count);
    println!("=> Rate: {:.1}%",
        (stats.parse_array_element_with_arrow as f64 /
         stats.parse_array_element_calls as f64) * 100.0);
}
```

## Zero-Cost Abstraction

When compiled **without** the `instrument` feature:
- All `record_*()` calls compile to nothing (inlined away)
- No branch overhead, no conditional checks
- Identical binary to non-instrumented version

```bash
# Verify zero overhead:
cargo build --release                           # baseline
cargo build --release --features instrument    # compare binary size
# (should be identical or minimal difference)
```

## Future Extensions

Possible additions to the instrumentation framework:

1. **Wall-clock timing per operation** — Measure actual CPU time for each instrumentation point
2. **Memory allocation tracking** — Count allocations per array element
3. **Token stream analysis** — Track which operators appear in values
4. **Distribution statistics** — Percentiles of array size, expression complexity
5. **Per-file profiling** — Which source files have most arrays, highest => rates

## References

- Implementation: `crates/php-parser/src/instrument.rs`
- Example: `crates/php-parser/examples/profile_array_parsing.rs`
- Integration points: `crates/php-parser/src/expr.rs` (parse_array_*, parse_expr_*, parse_atom)
