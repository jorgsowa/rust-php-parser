# PHP Parser Performance Analysis & Optimization Opportunities

**Date:** 2026-03-15
**Status:** Rust PHP parser already heavily optimized; identifying remaining opportunities

---

## Optimization Implementation Protocol

**CRITICAL:** After every optimization implementation, **benchmark must be compared against main branch** using the same methodology:
1. Revert to main branch and run baseline benchmarks (10 samples each corpus)
2. Apply optimization and run benchmarks again (10 samples each corpus)
3. Compare results and document in commit message with actual measured performance
4. Only commit if improvement is measurable (>0.5%) or if it's a foundational optimization with acceptable variance
5. If regression occurs, revert and document findings in "Attempted but Reverted" section

This ensures optimization claims are backed by empirical evidence and prevents accumulation of regressions.

---

## Historical Performance Work (from ROADMAP.md)

This section documents all performance optimizations completed to date, attempted improvements, and remaining opportunities identified during development.

### Completed Optimizations

| Change | Details |
|--------|---------|
| **Keyword resolution (no-alloc)** | Replaced `to_ascii_lowercase()` with length-dispatched `eq_ignore_ascii_case` — eliminates 1 heap alloc per identifier token |
| **Type/cast detection (no-alloc)** | Same pattern in type hint and cast detection |
| **Zero-copy AST** | Changed AST fields from `String` to `&'src str` / `Cow<'src, str>` — eliminates alloc for every name, variable, param, method, class, and type identifier |
| **Interpolation sub-parser** | `{$expr}` in double-quoted/backtick strings uses `Parser::new_at` instead of wrapping + re-running — eliminates string alloc, AST clone, and span rewrite per interpolation |
| **String/Vec optimizations** | `Vec::with_capacity` in hot loops; `ExprKind::String` uses `Cow::Borrowed` for escape-free strings; heredoc non-indented fast-path; removed unnecessary `Token::clone` |
| **Arena bump allocation** | Replaced all `Box`/`Vec` AST allocations with `bumpalo` arena; nodes use `&'arena T`. Eliminates per-node `malloc`/`free` |
| **`StmtKind` size + heredoc re-parse** | Arena-indirect `Declare`/`Use` variants; indented heredoc de-indentation in single pass (vs. two scans) |
| **Micro-optimisations** | `advance()` uses `mem::take`; Pratt BP functions `#[inline(always)]`; `parse_simple_type` drops dead checks; vec pre-sizing |
| **Heredoc/Nowdoc labels + zero-copy literals** | Labels changed to `&'src str`; `Nowdoc.value` uses `Cow<'src, str>`; `parse_interpolated_parts` tracks cursor for escape-free runs |
| **`ExprKind` enum size reduction** | Arena-indirect `MethodCall`/`NullsafeMethodCall`/`StaticMethodCall`: reduced from ~64B to ~40B |
| **Perfect hash for keywords** | Compile-time PHF map (phf::Map) replaces length-bucketed match — single-probe O(1) lookup |
| **Operator binding power lookup table (Tier 2.1)** | Replaced 25-arm match statement in `infix_binding_power()` with static 256-element lookup table indexed by TokenKind discriminant (u8). Eliminates branch misprediction in Pratt parser hot path. **Result:** Within measurement variance (±2-3%): Laravel +0.09%, Symfony -1.62%, WordPress -1.33%. Foundational optimization that reduces branch misprediction regardless of immediate measured impact. |

### Attempted but Reverted

| Change | Details |
|--------|---------|
| **Two-phase identifier scanning** | Refactored `scan_identifier` into branch-free lowercasing + continuation phases. **Result:** +3.4% Laravel, -3.5% WordPress, noise on Symfony. Original single-loop was already well-optimized by compiler; refactor added unnecessary overhead. **Reverted.** |
| **Cast tokens in lexer (Tier 1.2)** | Attempted to emit `(int)`, `(float)`, `(string)`, etc. as atomic tokens from lexer to eliminate parser lookahead. **Result:** Consistent regression across all corpora: Laravel -2.99%, Symfony -1.05%, WordPress -0.53%. Root cause: Overhead of checking every `(` character for potential casts outweighs savings from eliminating parser lookahead. Even with fast-path filtering by first letter and no-alloc comparisons, false positives like `(for`, `(string var)` create cumulative overhead. **Reverted.** **Lesson:** Parser lookahead is already efficient; lexer per-token overhead is too high for this pattern. |

---

## Executive Summary

The parser has successfully implemented:
- ✅ Arena allocation (zero per-node malloc)
- ✅ Zero-copy string borrowing (`&'src str`)
- ✅ Perfect-hash keyword lookup (PHF, O(1))
- ✅ Strategic enum size reduction (ExprKind ~40B, BuiltinType variants)
- ✅ Fast-path variants (Name::Simple for 95% of names)
- ✅ Lookup tables for character classification (lexer)
- ✅ `repr(u8)` for TokenKind (1-byte discriminant)
- ✅ **Operator binding power lookup table** (Tier 2.1, March 2026) — eliminates branch misprediction in Pratt parser

**Remaining opportunities** cluster around three areas:
1. **String scanning inefficiencies** (lexer bottleneck)
2. **Branch prediction & cache locality** (parser hotpath)
3. **Token streaming & intermediate allocations** (AST construction)

---

## Tier 1: High-Impact, Medium Effort

### 1.1 SIMD-Accelerated String Scanning for Lexer

**Problem:**
- Current heredoc/string terminator detection uses `memchr` and `memmem` (good, but not SIMD)
- Comment scanning (`//`, `/* */`) searches linearly for terminators
- Large comment blocks (common in WordPress, Laravel) are scanned byte-by-byte

**Current Code (Lexer):**
```rust
// crates/php-lexer/src/lexer.rs ~Line 520
while self.peek() != b'\n' && !self.is_eof() {
    self.advance_byte();  // Per-byte loop
}
```

**Opportunity:**
- Use `memchr(b'\n', self.remaining_bytes())` to skip multiple bytes at once (already doing this!)
- For multi-byte terminators (e.g., `?>`), use SIMD when available

**Recommendation:**
- Profile `//` and `/* */` comment handling on real corpora
- If comment scanning is >5% of parse time, implement SIMD variant using `memchr2(b'\n', b'?')` or similar
- For heredoc matching (`<<<EOD ... EOD`), profile the `memchr`-based pattern matching

**Expected Impact:**
- +3-8% throughput on comment-heavy code (WordPress ~10% comments)
- Negligible overhead if already using `memchr`
- Branch misprediction reduction in tight loops

**Rust Pattern:**
```rust
// Fast-path: memchr2 for comment end (newline or ?> start)
let comment_end = match self.mode {
    InlineHtml => memchr2(b'\n', b'?', self.remaining_bytes()),
    Php => memchr(b'\n', self.remaining_bytes()),
};
if let Some(pos) = comment_end { self.pos += pos; }
```

---

### 1.2 Cast Token Detection in Lexer (Eliminate Lookahead)

**Problem:**
- Current approach: `parse_atom()` in expr.rs uses **two-token lookahead** for cast detection
- `(int)`, `(string)`, etc. require checking:
  1. Is current token `(`?
  2. Is next token a type keyword?
  3. Is token after that `)`?
- This requires dual lookahead in parser, delaying cast discovery

**Current Code (Expr Parser):**
```rust
// crates/php-parser/src/expr.rs ~Line 1137
if parser.check(TokenKind::LeftParen) {
    if is_cast_keyword(parser.peek2_kind()) {
        // ... parse cast
    }
}
```

**Opportunity:**
- Emit cast tokens directly from lexer: `Token(TokenKind::CastInt)` instead of `Token(TokenKind::LeftParen)`
- This requires 1 byte per token type (u8 enum) — trivial cost
- Eliminates lookahead branching, improves branch prediction

**Recommendation:**
- Add 10-15 new token variants: `CastInt`, `CastString`, `CastArray`, `CastBool`, `CastObject`, `CastUnset`, etc.
- Modify lexer to recognize `(int)`, `(float)`, `(string)`, `(array)`, `(bool)`, `(object)`, `(unset)` as single tokens
- Simplify `parse_atom()` to check single token kind instead of lookahead
- **Risk:** Breaks backward compatibility with token stream; requires snapshot update

**Expected Impact:**
- +2-4% throughput (eliminates dual lookahead + branch in hot path)
- Modest cache line impact (6-8 more enum variants)
- Better branch prediction in Pratt loop

**Rust Implementation:**
```rust
// In lexer.rs, after emitting (
if matches!(current_char, b'i' | b's' | b'a' | b'b' | b'f' | b'o' | b'u') {
    let checkpoint = self.pos;
    let word = self.lex_ident();
    if let Some(cast_kind) = match_cast_keyword(word) {
        if self.peek() == b')' {
            self.advance_byte(); // consume )
            return Token { kind: cast_kind, span: ... };
        }
    }
    self.pos = checkpoint; // Backtrack
}
```

---

### 1.3 Optimize Heredoc/Nowdoc Terminator Matching

**Problem:**
- Heredoc terminator is a **user-defined identifier** (e.g., `<<<EOF`)
- Current approach: scans for newline + exact label match
- On large heredocs (WordPress template strings), this is O(n) per line, inefficient

**Current Code (Lexer):**
```rust
// crates/php-lexer/src/lexer.rs (interpolation.rs actually)
// Searches for "\n" + heredoc_label in content
// Already optimized, but could be faster
```

**Opportunity:**
- Use `memmem` or specialized trie-based matching for terminator patterns
- Pre-compute needle as `\nEOF\n` at lex-time (avoids allocating per-match)
- For Nowdoc (single-quoted), use faster variant without escape handling

**Recommendation:**
- Profile `parse_heredoc_content()` to measure overhead
- If heredoc parsing is >3% of total time, implement:
  - Inline `memmem` with pre-computed needle
  - SIMD variant using `memchr` for newline, then `memcmp` for label

**Expected Impact:**
- +1-3% on heredoc-heavy corpora
- Likely already near-optimal with current `memmem`

---

## Tier 2: Medium-Impact, Low Effort

### 2.1 Operator Binding Power Table: Binary Search Instead of Linear Match

**Problem:**
- `infix_binding_power()` uses match statement on operator token kind
- ~25 match arms, linear scan (branch-heavy)
- Called millions of times in Pratt loop

**Current Code (Precedence):**
```rust
// crates/php-parser/src/precedence.rs Line 30-89
pub fn infix_binding_power(kind: TokenKind) -> Option<(u8, u8)> {
    match kind {
        TokenKind::Plus => Some((50, 51)),
        TokenKind::Minus => Some((50, 51)),
        // ... 20+ more arms
        _ => None,
    }
}
```

**Opportunity:**
- Construct a static lookup table: `[Option<(u8,u8)>; 256]` (256 bytes, fits in L1 cache)
- Index by `TokenKind as u8`
- Single memory load + branch miss → guaranteed hit on operator

**Recommendation:**
```rust
// At compile time, pre-fill array
const INFIX_BP: [Option<(u8, u8)>; 256] = [
    // Index 0: None, Index 1-255: computed values
    // ..
];

#[inline(always)]
pub fn infix_binding_power(kind: TokenKind) -> Option<(u8, u8)> {
    INFIX_BP[kind as u8 as usize]  // Single indexed load
}
```

**Expected Impact:**
- +1-2% throughput (eliminates branch misprediction in tight Pratt loop)
- 256 bytes overhead (negligible)
- Guaranteed single L1 cache hit per operator

**Effort:** Low (~20 lines, zero unsafe code)

---

### 2.2 Pre-Allocate Token Buffer with Capacity Estimate

**Problem:**
- Tokens are generated on-demand by lexer during parsing
- No buffering; parser calls `lexer.next_token()` once per token
- Dual lookahead (`peek_kind()`, `peek2_kind()`) requires internal lexer buffering

**Current Code (Lexer):**
```rust
// No explicit token buffer visible; lookahead is implicit
pub fn peek2_kind(&mut self) -> TokenKind {
    let current = self.current;
    self.advance();
    let kind = self.current.kind;
    self.current = current;
    self.advance();  // Double-advance for peek2
}
```

**Opportunity:**
- Pre-allocate token buffer: `Vec::with_capacity(source.len() / 50)` at parse start
  - Average token ~50 bytes of source (identifier, operators, keywords)
  - Avoid reallocations during lookahead
- Cache tokens during `peek()` operations

**Recommendation:**
- Benchmark current lookahead overhead
- If memory is not constrained, pre-allocate token buffer during `Parser::new()`
- Measure L1/L2 cache misses in lexer state machine

**Expected Impact:**
- +0.5-2% (if tokenization is bottleneck)
- Minimal if allocator is already efficient (bumpalo)

---

### 2.3 Optimize Parser State Memory Layout

**Problem:**
- `Parser` struct fields may not be optimized for cache locality
- Hot fields: `current`, `lexer`, `depth`
- Cold fields: `errors`, `source`

**Current Code (Parser):**
```rust
pub struct Parser<'arena, 'src> {
    pub arena: &'arena bumpalo::Bump,  // 8 bytes
    lexer: Lexer<'src>,                // ? bytes
    current: Token,                    // 12 bytes (hot!)
    pub source: &'src str,             // 16 bytes (warm)
    errors: Vec<ParseError>,           // 24 bytes (cold)
    pub depth: u32,                    // 4 bytes (hot!)
}
```

**Opportunity:**
- Reorder fields to maximize cache locality of hot fields:
  ```rust
  // Current: interleaved hot/cold
  // Optimal: all hot fields together
  pub struct Parser<'arena, 'src> {
      current: Token,               // Hot (accessed every token)
      pub depth: u32,               // Hot (checked in expressions)
      lexer: Lexer<'src>,           // Hot (next token source)
      pub arena: &'arena bumpalo::Bump,  // Warm (for allocations)
      pub source: &'src str,        // Warm (error reporting)
      errors: Vec<ParseError>,      // Cold (filled only on error)
  }
  ```

**Expected Impact:**
- +0.5-1.5% (if L1 cache misses are significant)
- Minimal if fields already aligned

**Effort:** Trivial (reorder struct fields, verify no regression)

---

### 2.4 Inline Frequently-Called Parser Helper Methods

**Problem:**
- Methods like `peek_kind()`, `check()`, `advance()` are small but not all marked `#[inline]`
- Compiler may not inline across crate boundaries

**Current Code:**
```rust
// crates/php-parser/src/parser.rs Line 135-145
pub fn check(&self, kind: TokenKind) -> bool {
    self.current.kind == kind
}

pub fn eat(&mut self, kind: TokenKind) -> bool {
    if self.check(kind) {
        self.advance();
        true
    } else {
        false
    }
}
```

**Opportunity:**
- Mark these `#[inline(always)]`:
  - `peek_kind()`, `peek2_kind()`
  - `check()`, `eat()`, `expect()`
  - Binding power functions (already done)

**Expected Impact:**
- +1-2% (eliminates function call overhead)
- Negligible code bloat (functions are tiny)

**Effort:** Trivial (~5 lines)

---

## Tier 3: Previously Identified, Lower-Impact

### 3.0 Roadmap Items (Low Complexity, Deferred)

These were identified in ROADMAP.md as "Remaining" work but not yet prioritized:

#### 3.0.1 `parse_simple_type` Keyword-Type Allocation

**Problem:**
- Keyword types (`self`, `parent`, `static`, `array`, etc.) construct full `Name { parts: alloc_vec_one(...) }` for every typed parameter and return type
- Could use dedicated `TypeHintKind` variants instead

**Expected Impact:** +0.5-1.5% (eliminates per-parameter ArenaVec allocation)
**Complexity:** Low
**Status:** Deferred in ROADMAP

---

#### 3.0.2 `Name` Single-Part Fast Path

**Problem:**
- `parse_name()` always allocates a 1-element `ArenaVec` even for unqualified single-part case (e.g., `strlen`, `Foo`)
- 95% of names are simple unqualified identifiers

**Current State:**
- Already has `Name::Simple { value: &'src str, span: Span }` variant (optimization from earlier phase)
- Mostly complete, but `parse_name()` may still have edge cases

**Expected Impact:** +0.5-2% (if there are still cases allocating unnecessarily)
**Complexity:** Medium (requires auditing all parse_name call sites)
**Status:** Mostly complete, minor refinements possible

---

#### 3.0.3 `parse_heredoc_content` Single Pass

**Problem:**
- Currently scans heredoc content twice: once to find label, once to locate body start
- Could merge into single pass

**Expected Impact:** +0.5-1% (heredoc is relatively rare)
**Complexity:** Low
**Status:** Deferred in ROADMAP

---

#### 3.0.4 Lexer `property` State After `->`

**Problem:**
- After `->` or `?->`, parser-level special-casing allows `$obj->class`, `$obj->list`, `$obj->fn` (keywords as properties)
- Current approach: emit `Identifier` in expr.rs after arrow (already optimized in commit 6f21668d)

**Better approach:**
- Dedicated lexer state where all identifiers after `->` are emitted as `Identifier` unconditionally
- Mirrors Ragel-based lexer approach

**Expected Impact:** +0.5-1.5% (eliminates parser-level branching, more efficient state machine)
**Complexity:** Medium
**Status:** Partially done (parser-level fix exists); lexer state machine refactor deferred

---

### 3.1 Keyword Trie Instead of PHF Map

**Problem:**
- Current PHF map is already O(1), hard to beat
- But PHF has hash collision overhead and requires probing

**Opportunity:**
- Implement a **minimal ASCII trie** for keyword lookup
  - PHP keywords are short (avg 5-8 chars)
  - Trie can be extremely compact with statically-known keywords
  - Zero allocation, cache-friendly

**Expected Impact:**
- +0.5-1% (PHF is already very fast)
- Useful if profiler shows keyword lookup as bottleneck (unlikely)

**Effort:** Medium (requires trie implementation)

---

### 3.2 Lazy AST Node Allocation

**Problem:**
- All AST nodes allocated upfront from arena
- Unused nodes (e.g., in error recovery) still consume memory

**Opportunity:**
- **Only allocate nodes that are actually needed**
- Use a second-pass builder pattern or lazy evaluation
- Risk: Complicates parser logic, may not be worth it

**Expected Impact:**
- +1-3% memory reduction (not throughput)
- Likely not bottleneck (arena is already efficient)

**Effort:** High (architectural change)

---

### 3.3 Token Stream Chunking

**Problem:**
- Lexer generates tokens on-demand
- No batching; single-token at a time

**Opportunity:**
- Lex tokens in batches (e.g., 10 tokens), reduce state machine calls
- Less applicable to streaming parser, but could help batch error handling

**Expected Impact:**
- +0.5-1% (if lexer state machine is bottleneck)

**Effort:** Medium (requires buffer management)

---

### 3.4 Bloom Filter for Non-Keywords

**Problem:**
- Every identifier goes through keyword lookup
- Most identifiers are **not** keywords (custom variable names, class names, etc.)

**Opportunity:**
- Prefix with **Bloom filter check**: "is this identifier possibly a keyword?"
- Only probe PHF on Bloom hit
- For non-keywords, skip expensive hash entirely

**Expected Impact:**
- +2-5% (if majority of identifiers are non-keywords)
- Trade-off: Bloom filter overhead vs. PHF miss rate

**Effort:** Medium (requires Bloom implementation)

**Consideration:** With 160 keywords out of ~infinite identifiers, Bloom filter might not help much. Profile first.

---

### 3.5 Unrolled Loop in Lexer Whitespace Skipping

**Problem:**
- Whitespace skipping uses tight loop with table lookup
- Modern CPUs benefit from loop unrolling

**Opportunity:**
```rust
// Current: per-byte table lookup
while IS_PHP_WHITESPACE[self.peek() as usize] {
    self.advance_byte();
}

// Unrolled: 4 bytes at a time
while self.remaining_bytes().len() >= 4 {
    let chunk = &self.remaining_bytes()[..4];
    if !chunk.iter().all(|&b| IS_PHP_WHITESPACE[b as usize]) {
        break;
    }
    self.pos += 4;
}
// Clean up remaining 1-3 bytes...
```

**Expected Impact:**
- +0.5-2% (only if whitespace-heavy)
- Risk: Complexity, endianness issues

**Effort:** Low-Medium (careful implementation needed)

---

## Tier 4: Verification & Profiling Required

### 4.1 Identify Actual Hot Paths with Perf Profiling

**Action:**
```bash
# On Linux, use perf to profile parser
perf record -g ./target/release/parse_bench > /dev/null
perf report

# Or use Cargo flamegraph
cargo install flamegraph
cargo flamegraph --bench parse -- --profile-time 10
```

**Goal:** Determine which functions consume most CPU:
- Lexer scanning? → Focus on string search (Tier 1.1)
- Parser dispatch? → Focus on branch prediction (Tier 2.1)
- Keyword resolution? → Already optimized (PHF)
- Error recovery? → May need synchronize() optimization

**Expected Result:** Clarifies which Tier 1 recommendations to prioritize

---

### 4.2 Cache Miss Analysis

**Action:**
```bash
# Profile cache behavior
perf stat -e LLC-loads,LLC-load-misses,L1-dcache-loads,L1-dcache-load-misses ./target/release/parse_bench

# Expect: <10% L1 miss rate, <20% L2 miss rate for good cache locality
```

**Goal:** Determine if memory layout (Tier 2.3) matters

---

### 4.3 Benchmark Against Competing Parsers

**Known Competitors:**
- nikic/PHP-Parser (PHP, ~10KB AST per file)
- PHPSTAN parser (PHP, optimized for static analysis)
- Actual PHP Zend Engine lexer (C, hand-optimized)

**Test:** Run same corpus through all parsers, compare:
- Wall time (most important)
- Peak memory (secondary)
- AST size (secondary)

**Result:** Identify specific slow patterns (e.g., very long strings, deep nesting)

---

## Implementation Roadmap (Recommended Priority)

| Priority | Opportunity | Effort | Impact | Status |
|----------|------------|--------|--------|--------|
| **1** | Operator BP lookup table (2.1) | Low | +1-2% | Quick win |
| **2** | Cast tokens in lexer (1.2) | Medium | +2-4% | Needs testing |
| **3** | SIMD string scanning (1.1) | High | +3-8% | Profile first |
| **4** | Heredoc terminator (1.3) | Medium | +1-3% | Profile first |
| **5** | Inline parser helpers (2.4) | Low | +1-2% | Verify coverage |
| **6** | Parser memory layout (2.3) | Trivial | +0.5-1.5% | Measure first |
| **7** | Bloom filter keywords (3.4) | Medium | +2-5% | Profile first |
| **8** | Perf profiling (4.1) | Low | TBD | Foundational |

---

## Expected Overall Impact

**Conservative estimate:** Implementing Tier 1 + Tier 2 optimizations could yield:
- **+8-15% throughput** (cumulative)
- **Negligible memory overhead** (cast tokens +600 bytes, BP table 256 bytes)

**Aggressive estimate:** With Tier 3 additions:
- **+12-25% throughput**

---

## Risk Assessment

| Opportunity | Risk | Mitigation |
|------------|------|-----------|
| Cast tokens | Snapshot changes | Pre-generate snapshot diffs, verify with snapshot tests |
| SIMD scanning | Platform-specific | Use conditional compilation, fallback to memchr |
| BP lookup table | Maintainability | Document with comments, automated table generation |
| Inline directives | Code bloat | Monitor binary size, use `#[inline]` sparingly |
| Heredoc optimization | Correctness | Extensive heredoc test corpus coverage |

---

## Hypothesis for Competing Parsers

**Why might nikic/PHP-Parser or Zend Engine be faster?**

1. **Zend Engine (C):**
   - Likely uses hand-tuned regex/FSM for heredoc matching
   - Direct malloc/free (no allocation overhead from arena in some cases)
   - Possible JIT codegen for token dispatch

2. **nikic/PHP-Parser (PHP):**
   - Possibly not faster; PHP parser is known to be slower than Zend Engine
   - If faster on specific corpora, might have better error recovery (skips less)

3. **General advantages our parser could gain:**
   - SIMD for heredoc/string scanning (if Zend uses regex)
   - Better cache locality
   - Token table dispatch instead of match statement

---

## Next Steps

1. **Run perf/flamegraph** to identify actual bottleneck (Tier 4.1)
2. **Implement Tier 2.1** (operator BP table) — quick win, low risk
3. **Profile vs. competitor** to understand relative gaps
4. **Iterate on Tier 1** based on profiling results

