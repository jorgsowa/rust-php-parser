# Optimization Attempt: Fast-Path for Atomic Expressions (March 16, 2026)

## Summary

Attempted to implement a fast-path optimization in `parse_expr_bp()` to return immediately when an atomic value is not followed by any operator. The optimization failed due to parser correctness issues and was reverted.

## Attempt Details

### Objective
Reduce the 34.5% double-parse overhead in Symfony array parsing by optimizing expression parsing for simple values (literals, variables) not followed by operators.

### Implementation
1. Created `is_operator_token()` helper function that comprehensively matches all TokenKind variants that can start operators
2. Added early return in `parse_expr_bp()` immediately after `parse_atom()` if next token is not an operator
3. Expected benefit: 2-5% overall improvement on Symfony (targeting 16.2% simple array values)

### Code Changes
```rust
// Added helper function
fn is_operator_token(kind: TokenKind) -> bool {
    matches!(kind,
        // Postfix, assignment, binary, ternary, member access operators
        TokenKind::PlusPlus | TokenKind::Equals | ... // comprehensive list
    )
}

// Added early exit in parse_expr_bp
let kind = parser.current_kind();
if !is_operator_token(kind) {
    return lhs;  // Early return if no operator follows
}
```

### Result: ❌ FAILURE
- **Test regression:** `test_alternative_syntax_variants` failed
- **Error:** Parser unable to complete expression parsing in if/while/foreach alternative syntax
- **Reverted:** All changes rolled back cleanly

## Root Cause Analysis

### Why It Failed

The optimization was **too aggressive** because:

1. **parse_expr_bp is a fundamental primitive** — Used in ALL expression parsing contexts throughout the codebase, not just simple values
2. **Context-dependent behavior** — Some parsing contexts require the loop to execute even when certain tokens follow, depending on min_bp and precedence rules
3. **Alternative syntax incompatibility** — Structures like `if ($x):` depend on parse_expr_bp entering its loop for correct delimiter handling

### Example Failure

```php
<?php if ($x): echo 1; endif;
```

When parsing `$x`, after `parse_atom()` returns the variable, the next token is `:` (Colon).
- My optimization: "`:` is not an operator, return immediately"
- Result: Expression parsing incomplete, parser expects `;` at wrong position
- Actual need: Loop must continue to verify `:` context in alternative syntax flow

### Why Instrumentation Wasn't Enough

The corpus analysis showed 34.5% overhead but didn't reveal:
- The complex interdependencies between expression parsing and control flow parsing
- Contexts where the Pratt loop is necessary for correctness, not just completeness
- That changing a core parsing primitive affects many code paths

## Lessons Learned

### 1. Core Parsing Functions Are High-Risk Optimization Targets
Attempting to optimize fundamental primitives like `parse_expr_bp()` is **extremely risky**. Even small changes can cascade through the entire codebase and break subtle parsing logic.

**Implication:** Future optimizations should target:
- Isolated functions with clear scope
- Non-core parsing functions
- Specialized parsing paths (e.g., array-specific)

### 2. Instrumentation-Guided Optimization Has Limits
While instrumentation is excellent for:
- Identifying bottlenecks ✓
- Quantifying impact ✓
- Validating benchmarks ✓

It does NOT replace:
- Deep understanding of code flow
- Knowledge of all use cases
- Understanding of interdependencies

**Implication:** Before attempting optimizations, need to map out how the target function is used across the codebase.

### 3. Speculative Optimizations Fail
Approach: "The data shows 16.2% simple values, so fast-path for atoms should help"

Problem: Didn't account for cases where simple atoms still need operator checking due to precedence, context, or syntax rules.

**Implication:** Optimizations need proof-of-concept validation on the full test suite before assuming they're safe.

## Alternative Approaches (Not Yet Explored)

### Approach 1: Context-Specific Optimization
Instead of modifying `parse_expr_bp()`, create a specialized `parse_array_element_expr()` function:
- Only used in array element context
- Can have faster path for arrays without affecting general expression parsing
- Lower risk due to narrower scope

### Approach 2: Post-Arrow Specialized Parser
Create `parse_expr_post_arrow()` with restricted grammar:
- After `=>` in arrays, assignments aren't allowed
- Could skip assignment operator precedence checks
- Narrowly scoped, lower risk

### Approach 3: Binding Power Table Optimization
Instead of fast-path, optimize the binding power lookups:
- Profile L1 cache behavior
- Consider inlining hot operator checks
- Micro-optimization rather than architectural change

### Approach 4: Accept Architectural Limitation
The 34.5% overhead in Symfony is somewhat unavoidable due to:
- PHP grammar (ambiguous until `=>` appears)
- Key-value arrays requiring 2× parse_expr calls
- This is architectural, not algorithmic

**Option:** Focus optimization efforts on:
- Memory allocation patterns (arena pre-alloc already done)
- Cache efficiency in Pratt loop
- Other bottlenecks (not array parsing)

## What This Reveals About the Parser

### The Pratt Parser's Complexity
The Pratt expression parser is subtle:
- The loop doesn't just check "is there an operator?"
- It manages precedence, associativity, and context
- Early exits break assumptions downstream

### Array Parsing as Secondary Bottleneck
The 16.71% array parsing time is actually:
- 34.5% of parse_expr calls in Symfony
- But spread across many files, many arrays, many elements
- No single point where optimization provides huge gains

## Recommendations

### Short Term
1. **Document this failure** — Add to codebase history so future developers don't attempt similar changes
2. **Use instrumentation to explore other bottlenecks** — Parse_expr_bp is near-optimal; consider other functions
3. **Consider safer Tier 1 optimizations** — Post-arrow parser or arena allocation tweaks

### Long Term
1. **Profile-guided optimization only** — Changes to core functions require deep understanding first
2. **Test-first approach** — For any optimization attempt, have regression tests ready
3. **Narrow scope** — Optimize isolated functions, not primitives used everywhere

## Summary

The optimization attempt demonstrated that:
- ✅ Instrumentation correctly identified bottleneck (34.5% Symfony overhead)
- ✅ Benchmark would have validated performance
- ❌ But parser correctness is fragile; core function changes are risky
- ❌ Attempted optimization broke test suite (safe revert available)
- ✅ Clear failure mode quickly identified → easy revert

This is actually a **successful validation of caution**: the attempt failed safely (tests caught it), demonstrating why performance optimization of core parsing requires extreme care.

## Next Phase (If Continuing)

If further optimization is desired:
1. Focus on **context-specific** optimizations (array-only, post-arrow only)
2. Do **thorough impact analysis** before attempting changes
3. Consider that **34.5% overhead may be architectural** and accept it
4. Look for optimizations in other code paths (memory allocation, string operations, etc.)

## References

- Instrumentation framework: `crates/php-parser/src/instrument.rs`
- Corpus analysis: `CORPUS_ANALYSIS_MARCH2026.md`
- Original plan: Agent design doc (in conversation history)
- Failed implementation: Reverted cleanly, no commits created
