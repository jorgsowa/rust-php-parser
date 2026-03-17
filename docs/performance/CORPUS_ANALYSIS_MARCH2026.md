# Array Parsing Analysis: Real Corpus Data (March 16, 2026)

## Executive Summary

Instrumentation analysis of 14,122 real PHP files reveals **Symfony is the optimization target**, with 34.5% of expression parsing dedicated to array key-value pairs. Laravel and WordPress show only 6.8-6.9% overhead, suggesting corpus-specific optimization opportunities.

---

## Corpus Results Summary

| Metric | Laravel | Symfony | WordPress |
|--------|---------|---------|-----------|
| **Files** | 2,784 | 10,355 | 1,983 |
| **Total bytes** | 15.5 MB | 86.2 MB | 22.3 MB |
| **Avg file size** | 5.6 KB | 8.3 KB | 11.2 KB |
| **Arrays parsed** | 35,908 | 116,594 | 23,410 |
| **Avg elements/array** | 1.7 | 9.6 | 3.6 |
| **=> rate** | 49.8% | **83.8%** | 44.9% |
| **Simple value rate** | 50.2% | 16.2% | 55.1% |
| **Double-parse overhead** | 6.9% | **34.5%** | 6.8% |

---

## Deep Dive: Symfony (The Worst Case)

### Array Characteristics
- **116,594 arrays** across 10,355 files
- **9.6 elements per array** (vs. 1.7 Laravel, 3.6 WordPress)
- **83.8% key-value rate** (vs. 49.8% Laravel, 44.9% WordPress)
- **16.2% simple value rate** (vs. 50.2% Laravel, 55.1% WordPress)

This indicates Symfony arrays are:
1. **Larger** — Configuration arrays, service definitions, options
2. **Heavily keyed** — Almost always `key => value` pattern
3. **Complex expressions** — Only 16.2% are simple values; 83.8% involve operations, function calls, etc.

### Expression Parsing Impact
- **2,717,072 total parse_expr() calls**
- **938,516 calls are for array values** (34.5% of total!)
- Each array with 100% key-value pattern requires 2× parse_expr per element
- **Potential improvement if second parse optimized: 34.5%**

### Why Symfony Arrays are Worst-Case

Typical Symfony patterns:
```php
// Configuration array: 100% key-value
$config = [
    'services' => [
        'logger' => ['class' => 'Logger', 'args' => [$container]],
        'cache' => ['class' => 'Cache', 'factory' => 'create_cache'],
    ],
];

// Service definition: complex expressions as values
$services = [
    'routing.loader' => [
        'class' => 'RoutingLoader',
        'calls' => [['setContainer', [$container]]], // Complex expression!
    ],
];
```

---

## Comparative Analysis

### Laravel (Balanced Profile)
- **49.8% => rate** — Mixed simple and complex arrays
- **50.2% simple values** — Many list-like arrays `[1, 2, 3]`
- **6.9% overhead** — Manageable; not a primary concern
- **1.7 elements per array** — Mostly small arrays
- **Optimization potential: LOW** — Only 6.9% to gain

**Example Laravel patterns:**
```php
$routes = [1, 2, 3, ...];              // Simple indexed array
$config = ['key1' => 'val1', 'key2' => 'val2'];  // Small configs
```

### Symfony (Heavy Key-Value)
- **83.8% => rate** — Heavily structured data
- **16.2% simple values** — Complex expressions dominate
- **34.5% overhead** — CRITICAL bottleneck
- **9.6 elements per array** — Larger configuration blocks
- **Optimization potential: HIGH** — 34.5% to gain

### WordPress (Balanced Profile)
- **44.9% => rate** — Mixed pattern
- **55.1% simple values** — Often literal arrays
- **6.8% overhead** — Manageable
- **3.6 elements per array** — Medium-sized arrays
- **Optimization potential: LOW** — Only 6.8% to gain

---

## Key Findings

### 1. Array Optimization Should Target Symfony Patterns
The 34.5% Symfony overhead is **5× higher** than Laravel/WordPress. Any optimization should be validated on Symfony to ensure it's worthwhile.

### 2. Size Matters: Larger Arrays Exist in Symfony
Symfony arrays average **9.6 elements** vs. Laravel **1.7**. The cumulative overhead scales with array size:
- Small array (1-3 elements): minimal overhead even at high => rate
- Large array (10+ elements): significant cumulative cost

### 3. Expression Complexity Varies by Corpus
- **Symfony: 16.2% simple values** — Most values are function calls, arithmetic, etc.
- **Laravel/WordPress: 50%+ simple values** — Many literal arrays, strings, numbers

This suggests different optimization strategies:
- **Symfony**: Need fast path for complex expressions, not just atoms
- **Laravel/WordPress**: Fast path for atoms would help more

### 4. Double-Parse is Unavoidable (But Localized to Symfony)
The infrastructure overhead (parsing first expression, checking for `=>`) is baked into PHP grammar. However:
- For Laravel/WordPress, it's a **6.8% concern** (not worth architectural changes)
- For Symfony, it's a **34.5% concern** (worth investigating targeted optimizations)

---

## Optimization Opportunities Ranked by Potential

### Tier 1: Symfony-Specific (High Potential: ~34.5%)
**Target:** Reduce overhead in Symfony's 938,516 array value parse calls

1. **Fast-exit for simple atoms in Symfony arrays** (est. 2-5%)
   - Symfony has some simple literal values (16.2%)
   - Quick return from parse_expr_bp when only atom, no operators
   - Cost: Minimal code change, low risk

2. **Lookahead optimization for `=>` decision** (est. 0-3%)
   - Could we peek for `=>` before parsing first expression?
   - Problem: Would require two-phase parsing (expensive)
   - Verdict: Probably not worth it

3. **Specialized `parse_post_arrow_expr()`** (est. 2-8%)
   - After `=>`, restricted grammar (no assignment operators, etc.)
   - Could have fewer precedence checks
   - Cost: Moderate code change, medium risk, potentially 5-10% improvement

4. **Expression result memoization** (est. 0-2%)
   - Cache common expressions seen in arrays?
   - Problem: Unlikely to see exact duplicates
   - Verdict: Low potential

### Tier 2: General Optimizations (Medium Potential: ~2-5%)
These apply to all corpora but have lower absolute impact:

1. **Binding power table micro-optimizations** (est. 1-2%)
   - Profile cache behavior, inline hot branches
   - Low risk, but small gain

2. **Arena allocation tuning** (est. 0.5-1%)
   - Already optimized in March 2026 (5x pre-alloc)
   - Diminishing returns

### Tier 3: Not Recommended (Low Potential: <1%)
- Pre-lexed token array (attempted March 16: REGRESSED +52% Laravel, +123% WordPress)
- Two-phase parsing (high cost, low benefit)
- Branch predictor micro-tuning (unstable across platforms)

---

## Recommended Next Steps

1. **Implement Tier 1.1: Fast-exit for simple atoms**
   - Baseline: 232.8 ms (Symfony baseline)
   - Expected: 2-5% improvement = 221-227 ms
   - Risk: Low (isolated change to parse_expr_bp)

2. **If successful, attempt Tier 1.3: Specialized post-arrow parser**
   - Expected: Additional 2-8% improvement
   - Risk: Medium (requires new function, careful testing)

3. **Benchmark against all three corpora**
   - Must not regress Laravel/WordPress (which have low potential anyway)
   - Focus on Symfony improvements

4. **Document findings in PERFORMANCE_ANALYSIS.md**

---

## Data-Driven Optimization Principle

This analysis demonstrates the value of instrumentation:
- **Pre-optimization assumption:** "Branch elimination in token access will help"
  - Result: +52-125% regression (pre-lexed tokens attempt)
- **Post-instrumentation reality:** "Symfony has 83.8% => rate; that's the bottleneck"
  - Result: Specific 34.5% overhead to target, not architectural changes

**Lesson:** Profile first, optimize second. Avoid speculative architecture changes.

---

## References

- Instrumentation tool: `crates/php-parser/examples/profile_corpus.rs`
- Corpus location: `crates/php-parser/benches/corpus/{laravel,symfony,wordpress}`
- Feature flag: `--features instrument`
- Commit: cfaa5d79 (Add instrumentation framework)
