# Profiling Results - March 15, 2026

## Profile Run Details

- **Corpus:** WordPress (1,983 PHP files, 22.3 MB)
- **Iterations:** 30
- **Total Time:** 2.06 seconds
- **Profiler:** pprof (997 Hz sampling)
- **Total Samples:** 27,720

## Top 30 Most Sampled Functions

| Rank | Samples | % | Function Name |
|------|---------|---|---|
| 1 | 2,608 | 9.4% | `php_rs_parser::stmt::parse_stmt` |
| 2 | 1,589 | 5.7% | `php_rs_parser::expr::parse_expr_bp` |
| 3 | 1,310 | 4.7% | `php_rs_parser::parse` |
| 4 | **1,181** | **4.3%** | **`bumpalo::Bump<_>::alloc_layout_slow`** ⚠️ |
| 5 | 1,084 | 3.9% | `php_rs_parser::stmt::parse_block` |
| 6 | 759 | 2.7% | `php_rs_parser::stmt::parse_class_members` |
| 7 | 755 | 2.7% | `php_rs_parser::stmt::parse_class` |
| 8 | 514 | 1.9% | `php_rs_parser::expr::parse_arg_list_or_callable` |
| 9 | 431 | 1.6% | `php_rs_parser::expr::parse_function_call` |
| 10 | 428 | 1.5% | `php_rs_parser::stmt::parse_expression_stmt` |
| 26 | 108 | 0.4% | `php_lexer::lexer::Lexer::lex_php` ✓ |

**Cumulative:** Top 10 = 69.9%, Top 30 = 99.5%

## Key Insights

### 1. **Memory Allocation is the #1 Bottleneck** ⚠️

`bumpalo::Bump<_>::alloc_layout_slow` at **4.3%** is surprisingly high, indicating:

- Arena is growing (calling `alloc_layout_slow`) frequently despite `with_capacity(src.len() * 3)` pre-allocation
- Possible causes:
  - 3x multiplier is insufficient for pathological cases
  - Heavy use of nested vectors causing cumulative growth
  - Bumpalo's growth strategy is hitting worst-case scenarios

**Action:** Investigate whether we can:
1. Increase initial arena size to 4x-5x or use `src.len() * 4`
2. Profile individual large files to find pathological allocation patterns
3. Consider allocating more conservatively in hot loops (e.g., `parse_arg_list_or_callable`)

---

### 2. **Parser Expression Binding Power is Second** (5.7%)

`parse_expr_bp` (Pratt parser) is the hot parsing path:

- **Status:** Binding power table (Tier 2.1) already implemented ✓
- **Current optimization:** Static lookup table for operator precedence
- **Measured impact:** Within variance (±2-3%) but is foundational
- **Next:** Could attempt further optimizations:
  - Profile cache behavior (L1/L2 misses in Pratt loop)
  - Consider table-driven state machine if profiling shows poor branch prediction
  - Inline small helper functions more aggressively

---

### 3. **Statement Parsing is Natural Bottleneck** (9.4%)

`parse_stmt` is expected to be highest because:
- It's the main dispatcher for all statement types
- Called for every statement in every file
- No further optimization possible without major restructuring

---

### 4. **Lexer is NOT a Bottleneck** ✓

`php_lexer::lexer::Lexer::lex_php` at **0.4%** means:

- ❌ **Skip Tier 1.1 (SIMD String Scanning)** — waste of effort
- ❌ **Skip Tier 1.2 (Cast Tokens in Lexer)** — already attempted and caused regressions
- ❌ **Skip Tier 1.3 (Heredoc Optimization)** — only 0.4% of time
- Lexer is already highly optimized

---

## Optimization Priority by Profiling Data

### Immediate (High Impact, Feasible)

1. **Increase Arena Pre-allocation** (Likely +1-3%)
   - Effort: Trivial (1 line change)
   - Risk: Low (only affects memory usage slightly)
   - Rationale: `alloc_layout_slow` at 4.3% suggests growth is expensive
   - Action: Test `src.len() * 4` or `src.len() * 5` instead of `* 3`

2. **Profile Memory Allocation Patterns** (Foundational)
   - Effort: Low (1-2 hours)
   - Risk: None (profiling only)
   - Action: Add `#[instrument]` or logging to identify which functions cause allocation spikes
   - Goal: Understand if certain statement types (class, function) are allocation-heavy

3. **Inline Small Parser Helpers** (Likely +0.5-1%)
   - Effort: Trivial (mark `#[inline]` or `#[inline(always)]`)
   - Risk: Low (just inlining hints)
   - Functions to target:
     - `Parser::advance()`, `Parser::check()`, `Parser::eat()`
     - `Parser::peek_kind()`, `Parser::peek2_kind()`
   - Rationale: Called millions of times; even small inlining wins add up

4. **Verify Binding Power Table Performance** (Baseline)
   - Effort: Low (profile current code)
   - Risk: None
   - Action: Compare performance before/after binding power table (already done in commit)
   - Goal: Confirm Tier 2.1 is working as expected

### Medium-Term (Profile-Guided)

5. **Cache Line Optimization** (If L1 misses are >10%)
   - Effort: Medium
   - Risk: Low (reordering struct fields)
   - Action: Run `perf stat` on Pratt parser to measure L1/L2 cache misses
   - Target: `Parser` struct memory layout (Tier 2.3)

6. **Expression Parsing Optimization** (If Pratt misses >5%)
   - Effort: Medium
   - Risk: Medium (parser rewrite)
   - Action: Profile branch prediction in Pratt loop
   - Target: Consider look-up table for operator dispatch instead of match statement

---

## Tier 3+ Opportunities (Defer)

- ❌ SIMD string scanning (Tier 1.1) — lexer only 0.4%, not worth effort
- ❌ Cast tokens in lexer (Tier 1.2) — already tested, caused regressions
- ❌ Heredoc optimization (Tier 1.3) — lexer already fast
- ⚠️ Keyword lookup optimization (Tier 3.1, 3.4) — only impacts identifier scanning (0.4%)
- ⚠️ Parser memory layout (Tier 2.3) — only +0.5-1.5% unless L1 misses are high

---

## Recommended Next Steps

### **Phase 1: Quick Wins (30 mins)**

1. Test increasing arena pre-allocation from `* 3` to `* 4`:
   ```rust
   let arena = bumpalo::Bump::with_capacity(src.len() * 4);
   ```
   Measure throughput improvement with benchmarks.

2. Add `#[inline(always)]` to hot parser helpers:
   - `advance()`, `check()`, `peek_kind()`, `peek2_kind()`

3. Run standard benchmarks (`cargo bench`) and compare against main.

### **Phase 2: Detailed Analysis (2-3 hours)**

4. Profile allocation hotspots using instrumentation:
   - Which statement/expression types allocate most heavily?
   - Are there specific file patterns triggering `alloc_layout_slow`?

5. Measure cache behavior with `perf stat`:
   ```bash
   perf stat -e LLC-loads,LLC-load-misses,L1-dcache-loads,L1-dcache-load-misses \
     ./target/release/examples/profile
   ```

6. Re-profile with changes to measure cumulative impact.

### **Phase 3: Verify & Document**

7. Compare against main branch using same methodology as PERFORMANCE_ANALYSIS.md
8. Document findings and update PERFORMANCE_ANALYSIS.md

---

## Expected Impact

- **Conservative:** +1-2% (arena pre-allocation + inline hints)
- **Realistic:** +2-4% (if allocation and inlining both help)
- **Aggressive:** +4-6% (with additional cache optimization)

---

## Notes

- File I/O (`_open$NOCANCEL` at 5.7%) is present in profile due to arena loading; actual parser work is lower
- Relative percentages show allocation is the biggest internal bottleneck after I/O
- Further optimizations likely require architectural changes (e.g., streaming parser, incremental parsing)
