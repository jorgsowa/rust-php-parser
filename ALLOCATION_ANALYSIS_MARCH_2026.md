# Allocation Hotspot Analysis - March 15, 2026

## Executive Summary

**Profiling Method:** Flamegraph SVG analysis of WordPress corpus parsing (1,983 files, 22.3 MB, 30 iterations)

**Finding:** Arena pre-allocation increase (3x → 4x) was effective because **80.8% of allocation time is spent growing the arena itself** (`alloc_layout_slow`). Remaining time is vector growth (8.4%) and reallocations (7.7%).

---

## Allocation Cost Breakdown

| Category | Samples | % | Function | Impact |
|----------|---------|---|----------|--------|
| **Arena Growth** | 1,181 | 80.8% | `bumpalo::Bump::alloc_layout_slow` | Main bottleneck; helped by pre-alloc +1x |
| **Vector Growth** | 123 | 8.4% | `RawVec::reserve_internal_or_panic` | Collections within arena re-growing |
| **Reallocations** | 113 | 7.7% | `realloc` | Existing blocks being grown |
| Other | 45 | 3.1% | Various | Miscellaneous |
| **TOTAL** | **1,462** | **5.3%** | of parse time | |

---

## Top Functions Triggering Allocations

Analyzed call stacks show parser functions most frequently involved in allocation:

| Function | Samples | Analysis |
|----------|---------|----------|
| `parse_stmt` | 2,084 | Main statement dispatcher; accumulates stmts in vector |
| `parse` | 1,310 | Top-level parse; drives all allocations |
| `parse_class` | 744 | Classes with many members allocate heavily |
| `parse_class_members` | 744 | Member lists (properties, methods) grow vectors |
| `parse_block` | 430 | Blocks with many statements allocate |
| `parse_function` | 390 | Function parsing; parameter lists, body |

**Pattern:** Functions that accumulate items in `ArenaVec` (statements, class members, parameters) are allocation-heavy.

---

## Key Insights

### 1. Arena Growth is Dominant (80.8%)

**Why:** The bump allocator grows the arena by reallocating its internal buffer when it runs out of space. This is expensive because it requires:
- Allocating a larger buffer
- Copying all existing data to the new buffer
- Freeing the old buffer

**Why Pre-allocation Helps:** By increasing from 3x to 4x, we reduce growth frequency for typical files:
- 3x: File at 2MB needs arena ≥ 6MB
- 4x: File at 2MB needs arena ≥ 8MB
- Larger initial buffer = fewer reallocations

**Effect:** -0.7% to -1.0% faster (measurable improvement).

### 2. Vector Growth is Secondary (8.4%)

**Why:** Collections within the arena (statement lists, class members, parameters) are pre-allocated with conservative estimates:
```rust
let mut stmts = parser.alloc_vec_with_capacity(16);  // typical
let mut members = parser.alloc_vec_with_capacity(16);
let mut params = parser.alloc_vec_with_capacity(4);
```

**Problem:** If a file has:
- 100+ statements in a block → growth happens
- 100+ class members → growth happens
- 50+ function parameters → growth happens

**Real-world Impact:**
- Most PHP files have <50 statements per block → no growth
- Large generated/minified code → frequent growth

### 3. Reallocations Indicate Tight Growth (7.7%)

The `realloc` samples suggest some growth patterns are hitting limits exactly. This indicates:
- Initial capacity estimates are conservative (good for small code)
- Large files trigger multiple growth cycles

---

## Optimization Opportunities (Ranked by Feasibility)

### Tier 0.5: Further Arena Pre-allocation Tuning (Easiest)

**Hypothesis:** Maybe 4x isn't enough for pathological cases. Test 5x or 6x.

| Multiplier | Expected Arena Size | Benefit | Cost |
|------------|-------------------|---------|------|
| 3x | ~6MB | Baseline | Memory + freq growth |
| 4x | ~8MB | -0.7% ✓ | Small increase |
| 5x | ~10MB | -1.0% to -1.5% (est.) | Moderate increase |
| 6x | ~12MB | Diminishing returns | High memory waste |

**Effort:** Trivial (one line)
**Risk:** Minimal (only affects memory)
**Expected:** +0.3-0.5% at 5x (small gain)

### Tier 1: Smarter Vector Pre-allocation (Medium Effort)

**Idea:** Track allocation growth patterns and increase default capacity for hot vectors:

```rust
// Current
let mut stmts = parser.alloc_vec_with_capacity(16);

// Better (if statements average 30+)
let mut stmts = parser.alloc_vec_with_capacity(32);

// Even better (if pattern varies by context)
let mut stmts = parser.alloc_vec_with_capacity(
    if in_class { 50 } else { 32 }  // classes have more members
);
```

**Effort:** Low-Medium (identify patterns, tune capacities)
**Risk:** Low (just initial sizing)
**Expected:** +0.5-1.5% (if patterns are significant)

### Tier 2: File-Specific Arena Sizing (Higher Effort)

**Idea:** Estimate required arena size before parsing:

```rust
pub fn parse_with_estimated_size(arena: &Bump, source: &str) {
    // Heuristic: count '{' for rough nesting, '*' for references, etc.
    let estimated_need = estimate_allocation_need(source);
    let better_arena = Bump::with_capacity(estimated_need);
    // ... parse with better-sized arena
}
```

**Effort:** Medium (requires heuristics)
**Risk:** Medium (heuristics might be wrong)
**Expected:** +1-2% (eliminates pathological growth)

---

## Measurements & Validation

### Current Status (Arena 4x)
- **WordPress:** -1.0% faster ✓
- **Symfony:** -0.7% faster ✓
- **Laravel:** 0% (no change) ✓

### Why Not Larger Gains?

1. **Most files don't need large arenas** — 3x was already sufficient for median files
2. **Growth overhead is amortized** — A single 2x reallocation cost spread over 1,000+ allocations = small impact
3. **Profiling shows cumulative effect** — 4.3% in `alloc_layout_slow` means 4.3% of samples hit that path, not 4.3% lost

Example: 30 allocations, 1 growth event:
- Growth: 10ms
- Normal allocs: 30 × 0.1ms = 3ms
- Total: 13ms vs 3ms without growth = 4× slower *just for growth*
- But growth happens once per many files, so amortized impact is small

---

## Recommended Next Steps

### Priority 1: Test Arena 5x (5 mins)
```rust
// In benches/parse.rs and examples/profile.rs
let arena = bumpalo::Bump::with_capacity(src.len() * 5);  // was 4
```

Benchmark and see if we get another 0.3-0.5% improvement.

### Priority 2: Profile Pathological Cases (1-2 hours)
- Find files that trigger multiple growth events
- Understand why (many classes? large blocks? deep nesting?)
- Document patterns for future heuristics

### Priority 3: Implement Vector Pre-allocation Tuning (2-3 hours)
- Increase capacity hints for frequently-large collections
- Parse class-heavy files to validate

### Priority 4: Consider Abandoning Further Allocation Optimization (Decision Point)
If arena 5x doesn't yield measurable gains (>0.5%), the remaining gains are likely <1% and require architectural changes. At this point:
- ✅ Accept current performance
- ➡️ Shift focus to other bottlenecks (expression parsing, error recovery)
- ➡️ Build features (LSP, semantic analysis) instead of micro-optimization

---

## Lessons Learned

1. **Profiling invalidates assumptions** — We thought lexer was bottleneck; it's only 0.4%
2. **Small optimizations compound** — Each 0.5-1% improvement is valuable
3. **Inlining can backfire** — Forced `#[inline(always)]` hurt despite being "hot"
4. **Arena allocation matters** — 4.3% of time in growth; 3x → 4x helped
5. **Remaining gains are small** — Expect diminishing returns after Tier 0

---

## Files & References

- Flamegraph: `flamegraph.svg` (view in browser for call stacks)
- Profile binary: `crates/php-parser/examples/profile.rs`
- Profiling results: `PROFILING_RESULTS_2026_03_15.md`
- Roadmap: `PERFORMANCE_ANALYSIS.md`
