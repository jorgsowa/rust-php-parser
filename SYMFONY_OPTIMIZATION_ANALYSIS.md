# Symfony-Specific Performance Optimization Analysis

**Date:** March 15, 2026
**Focus:** Identify and optimize Symfony corpus parsing bottlenecks

---

## Corpus Characteristics

| Metric | WordPress | Symfony | Ratio |
|--------|-----------|---------|-------|
| **Files** | 1,983 | 10,355 | 5.2× larger |
| **Size** | 22.3 MB | 86.2 MB | 3.9× larger |
| **Profile Samples** | 27,720 | 90,818 | 3.3× more |
| **Avg File Size** | 11.2 KB | 8.3 KB | Smaller files |

**Interpretation:** Symfony is a larger corpus with many small files (typical of a framework), while WordPress has fewer but larger template files.

---

## Hotspot Comparison: Symfony vs WordPress

### 🔴 Symfony-Heavy Hotspots (Optimization Opportunity)

| Function | WordPress | Symfony | Difference | Interpretation |
|----------|-----------|---------|-----------|---|
| **`parse_expr_bp`** (Pratt parser) | 5.73% | 7.08% | **+1.35%** ↑ | **Symfony has complex expressions** |
| **`parse_array_literal`** | <0.5% | 2.92% | **+2.92%** ↑ | **Heavy array/config usage** |

### 🟢 WordPress-Heavy Hotspots (Less Relevant)

| Function | WordPress | Symfony | Difference | Interpretation |
|----------|-----------|---------|-----------|---|
| **`parse_stmt`** | 9.41% | 5.71% | **-3.70%** ↓ | WordPress is statement-heavy (templates) |
| **`parse_block`** | 3.91% | 0.98% | **-2.93%** ↓ | WordPress has deep block nesting |
| **`parse_class_members`** | 2.74% | 2.98% | +0.24% | Similar in both |

### ⚙️ Allocation (Good News!)

| Function | WordPress | Symfony | Difference |
|----------|-----------|---------|-----------|
| **`alloc_layout_slow`** | 4.26% | 3.48% | **-0.79%** ✓ |

**Insight:** Symfony benefits MORE from 4x pre-allocation due to larger overall size but smaller individual files. Allocation is better optimized for Symfony already.

---

## Symfony Optimization Priorities

### Priority 1: Pratt Parser Expression Optimization (7.08% → 6.5%?)

**Problem:** `parse_expr_bp` is 1.35% higher in Symfony, indicating:
- More complex expression chains (method calls, array access)
- More operators in expressions
- Deeper operator nesting

**Current Optimizations:**
- ✅ Binding power lookup table (Tier 2.1) already implemented
- ✅ Branch prediction reduced via lookup table

**Potential Further Optimizations:**

#### Option A: Operator Dispatch Table (Additional)
Current: Lookup table for binding power
Could add: Separate table for operator implementation dispatch
```rust
// Current: match on operator kind inside hot loop
match op_kind {
    Plus => { ... },
    Minus => { ... },
    // 50+ arms
}

// Better: Table-driven dispatch
const OP_HANDLERS: [fn(&mut Parser) -> ...; 256] = [...];
OP_HANDLERS[op_kind as usize](&mut parser);
```
**Effort:** Medium | **Expected:** +0.5-1% | **Risk:** Medium (must handle all operator types)

#### Option B: Inline Small Expression Types
Expressions like simple variables, literals, don't need full parsing
```rust
// Fast-path for common cases
if check_simple_var() { return parse_simple_var(); }
if check_literal() { return parse_literal(); }
// Fall through to full expression parser
```
**Effort:** Low-Medium | **Expected:** +0.3-0.7% | **Risk:** Low

#### Option C: Cache Operator Binding Powers
If same operators appear in sequences, cache lookup results
**Effort:** High | **Expected:** +0.2-0.5% | **Risk:** High (complexity)

**Recommendation:** Try Option B (fast-path for simple expressions) first.

---

### Priority 2: Array Literal Parsing (2.92% → 2.5%?)

**Problem:** `parse_array_literal` is 2.92% in Symfony but <0.5% in WordPress
- Symfony uses arrays for configuration, type hints, annotations
- Example: `['key' => 'value', 'nested' => ['a' => 1]]`

**Current Code Likely:**
```rust
fn parse_array_literal(&mut self) -> ... {
    let mut elements = self.alloc_vec_with_capacity(8);  // Default capacity

    loop {
        if self.check(Bracket::Close) { break; }
        elements.push(self.parse_array_element()?);
        if !self.check(Comma) { break; }
        self.advance();
    }

    // Many Symfony arrays are 10-100 elements
    // Default capacity=8 causes growth
}
```

**Optimizations:**

#### Option A: Increase Array Pre-allocation
```rust
// Instead of 8:
let mut elements = self.alloc_vec_with_capacity(16);  // Common case
// Or context-aware:
let capacity = if in_config_context { 50 } else { 16 };
let mut elements = self.alloc_vec_with_capacity(capacity);
```
**Effort:** Trivial | **Expected:** +0.2-0.4% | **Risk:** None (just initial sizing)

#### Option B: Estimate Array Size
Count opening `[` and estimate elements from context
**Effort:** Medium | **Expected:** +0.3-0.5% | **Risk:** Low

#### Option C: Dedicated Array Optimization
Special parsing for common patterns: `['k'=>'v', ...]`
**Effort:** High | **Expected:** +0.5-1% | **Risk:** Medium

**Recommendation:** Try Option A (increase pre-allocation to 16) first.

---

### Priority 3: Keep Current Allocation Strategy

Good news: Symfony's allocation is already better than WordPress!
- `alloc_layout_slow` is **lower** in Symfony (3.48% vs 4.26%)
- 4x pre-allocation is **more effective** on Symfony's larger overall size
- No change needed

---

## Recommended Tier 0.5+ for Symfony

### Immediate (5-10 mins)

1. **Increase array literal pre-allocation:**
   ```rust
   // In expr.rs, parse_array_literal()
   let mut elements = self.alloc_vec_with_capacity(16);  // was 8
   ```

2. **Benchmark Symfony-specific to confirm impact:**
   ```bash
   cargo bench --bench parse -- --filter symfony
   ```

### Short-term (1-2 hours)

3. **Implement fast-path for simple expressions:**
   - Check for single variable/literal before full expression parsing
   - Expected: +0.3-0.7% on Symfony

4. **Profile Symfony again after each change:**
   - Use `flamegraph_symfony.svg` baseline for comparison

### Medium-term (if gains plateau)

5. **Consider operator dispatch table** (if expr_bp remains >7%)
6. **Analyze specific Symfony files** for patterns (configurations, type hints)

---

## Key Insights for Symfony

1. **Expression parsing is critical** — 7.08% of time vs 5.73% WordPress
2. **Array literals matter** — 2.92% of time, heavily used in Symfony code
3. **Allocation works well** — Already optimized relative to WordPress
4. **Small files benefit from different strategy** — Symfony's 8.3 KB avg vs WordPress's 11.2 KB
5. **No deep blocks** — Symfony's structured code doesn't benefit from block optimization

---

## Measurement Plan

**Current Status (with 4x pre-allocation):**
```
WordPress:  264.59 MiB/s (55.999 ms for 14.8 MB)
Symfony:    347.32 MiB/s (236.71 ms for 82.2 MB)
```

**After array optimization (estimate -0.2 to -0.4% from 2.92% reduction):**
```
Symfony:    347.3 → ~348.5 MiB/s (expected change: minimal but measurable)
```

**After expression optimization (estimate -0.3 to -0.7% from 7.08% reduction):**
```
Symfony:    348.5 → ~349.8 MiB/s (if successful on fast-paths)
```

**Total expected from Symfony-specific work:** 0.5-1.1% improvement

---

## Files & References

- **WordPress baseline:** `flamegraph.svg` (27,720 samples)
- **Symfony analysis:** `flamegraph_symfony.svg` (90,818 samples)
- **Profiler:** `crates/php-parser/examples/profile_symfony.rs` (reusable)
- **Previous analysis:** `ALLOCATION_ANALYSIS_MARCH_2026.md`

---

## Decision Point

After array optimization, we can:
- ✅ **Accept improvements** (~0.5%) and move to feature work
- ➡️ **Continue micro-optimizations** (diminishing returns)
- 🔄 **Switch focus** to another aspect (LSP, semantic analysis, error recovery)
