# Feature Completion Roadmap for Path B

## Overview

The parser has excellent syntax coverage (PHP 5.3–8.4). This roadmap prioritizes **architectural features** that unlock new use cases without breaking changes.

---

## Tier 1: High-Impact, Medium Effort (Do These First)

### 1.1 Comment Preservation & Attachment 🎯
**Problem:** Comments are discarded during lexing. Blocks tools that need them (formatters, documenters, linters).

**Solution:**
- Add comment token types to lexer (line, block, doc-block)
- Attach comments to nearest AST node (pre/post comment lists)
- Add `Vec<Comment>` fields to AST root

**Impact:** Unlocks pretty-printers, formatters, doc-block extractors
**Effort:** 2-3 days (lexer + AST changes + tests)
**Risk:** Low — additive change, no breaking changes
**Priority:** 1st (blocks other features like pretty-printer)

### 1.2 Visitor/Walker Trait API 🎯
**Problem:** No standard way to traverse AST. Users write repetitive recursion.

**Solution:**
- Define `AstVisitor` trait with methods for each node type
- Implement default visitor for traversal
- Add `walk()` method to AST node types
- Provide both immutable and mutable visitors

**Impact:** Enables linters, codemods, type checkers, refactoring tools
**Effort:** 1-2 days (trait definition + impl generation)
**Risk:** Low — pure addition, no breaking changes
**Priority:** 2nd (directly enables user tools)

### 1.3 PHP Version Gating 🎯
**Problem:** Parser accepts all PHP versions unconditionally. No way to enforce "PHP 7.4 compatible" parsing.

**Solution:**
- Add `PhpVersion` enum (5.3, 5.4, ..., 8.0, 8.1, ..., 8.4)
- Gate syntax acceptance (e.g., reject `match` in PHP 7.4 parsing)
- Add parsing error for version-incompatible syntax
- Document which features require which versions

**Impact:** Enables migration tools, version-specific linters, compatibility checkers
**Effort:** 2-3 days (config + parser checks + tests)
**Risk:** Medium — changes parser validation logic (add parser errors for valid PHP syntax in wrong version)
**Priority:** 3rd (nice-to-have, moderate risk)

---

## Tier 2: Medium-Impact, High Effort (Months of Work)

### 2.1 Pretty Printer (AST → Source) 💾
**Problem:** No way to output modified AST back to valid PHP.

**Solution:**
- Implement formatter that walks AST and emits source
- Respect original spacing heuristics where possible
- Support configurable formatting (PSR-12, custom)

**Impact:** Enables refactoring tools, code generation, formatters
**Effort:** 4-6 weeks (requires deep understanding of operator precedence, statement grouping)
**Risk:** Medium — precedence handling, edge cases with alternative syntax
**Priority:** 4th (valuable but large scope)

### 2.2 Incremental Parsing 💾
**Problem:** Every parse re-scans entire file. Not suitable for IDE-latency scenarios.

**Solution:**
- Cache parse tree + source hash
- On re-parse, detect changed regions
- Reuse unchanged subtrees

**Impact:** Enables fast IDE integrations, watch-mode tools
**Effort:** 2-3 weeks (cache invalidation, tree reuse, testing)
**Risk:** High — subtle correctness issues possible
**Priority:** 5th (nice-to-have, high complexity)

---

## Tier 3: Lower-Impact, Low Effort (Quick Wins)

### 3.1 Error Recovery Improvements 🔧
**Problem:** Some edge cases still panic or produce Error nodes instead of partial trees.

**Solution:**
- Profile parse failures in real-world code
- Add targeted recovery rules (e.g., missing semicolons, unmatched braces)
- Document known recovery limitations

**Impact:** More reliable parsing of malformed code
**Effort:** 3-5 days (analysis + recovery heuristics + tests)
**Risk:** Low — additive
**Priority:** 6th (incremental improvement)

### 3.2 Source Span Improvements 🔧
**Problem:** Some compound expressions have imprecise spans.

**Solution:**
- Audit span coverage (already ~95%)
- Add missing spans to: some operators, error nodes, recovered constructs
- Add span union utilities for composite nodes

**Impact:** Better IDE error messages, refactoring tools
**Effort:** 1-2 days (focused spans + tests)
**Risk:** Very Low — spans are non-breaking
**Priority:** 7th (quality-of-life)

### 3.3 Documentation Improvements 🔧
**Problem:** No examples of advanced features (custom visitors, serialization, error handling).

**Solution:**
- Add comprehensive examples (with comments explaining internals)
- Document AST node relationships
- Add cookbook for common tasks (find all functions, rewrite expressions, etc.)

**Impact:** Lower user friction, faster adoption
**Effort:** 2-3 days (examples + docs)
**Risk:** None
**Priority:** 8th (enabler for users)

---

## Recommended Sequence

1. **Month 1:** Implement 1.1 (Comments) + 1.2 (Visitor API)
   - Unlocks pretty-printer and user tools
   - High value, moderate effort

2. **Month 2:** Implement 1.3 (Version Gating)
   - Enables migration/compatibility tools
   - Medium value, manageable effort

3. **Backlog:** 2.1 (Pretty Printer), 2.2 (Incremental), 3.x (Quick wins)
   - Revisit based on user feedback

---

## Success Metrics

- **Adoption:** Number of external tools using visitor API, comments
- **Issues:** Track user requests to prioritize backlog
- **Performance:** Ensure new features don't regress parsing speed
- **Test Coverage:** Maintain >90% coverage for new code

---

## Notes

- Each Tier 1 feature is **independently valuable** — can be released separately
- Comment preservation is a **prerequisite** for pretty-printer (2.1)
- Version gating may generate **false positives** (valid syntax rejected in older versions) — needs careful testing
- Visitor API is **must-have** before releasing public tools built on the parser

