# Roadmap

This roadmap covers feature development and tracks ongoing performance optimization work.

**Performance work** (completed optimizations, remaining opportunities, and detailed analysis) is documented in [`PERFORMANCE_ANALYSIS.md`](./PERFORMANCE_ANALYSIS.md).

---

## Phase 1 — Core Infrastructure

Foundational changes that unlock multiple downstream features. Almost everything in Phase 2 and 3 depends on these.

### 1.1 Comment Preservation ✅

Attach comments to AST nodes instead of discarding them during lexing.

**Status:** Complete. Comments are attached to AST nodes with leading/trailing placement. PHPDoc parser added for structured doc-comment extraction including Psalm/PHPStan annotation support. Doc comments are attached to declaration nodes (classes, functions, methods, properties, etc.).

**Blockers:** None.

### 1.2 Visitor / Walker API

Trait-based AST traversal for analysis and transformation passes.

**Enables:** semantic analysis, linters, codemods, pretty printer, symbol extraction for LSP.

**Scope:**
- `Visitor` trait with `visit_stmt`, `visit_expr`, `visit_type_hint`, etc., with default implementations that recurse
- `walk_*` free functions that drive the recursion
- Mutable variant (`VisitorMut` or `Fold`) for AST transformations
- Derive or hand-write traversal for every AST node

**Difficulties:**
- **AST size** — 30+ statement kinds, 50+ expression kinds, plus OOP members, params, type hints, match arms, etc. Every variant needs a walk arm. Large, mechanical, error-prone.
- **Ownership** — a read-only `Visitor<'ast>` taking `&'ast Node` is straightforward. A mutable `Fold` that returns owned nodes requires moving values. Consider providing both.
- **Traversal control** — callers need to skip subtrees or stop early. A `ControlFlow`-style return type is needed.

**Blockers:** None — can start in parallel with 1.1.

### 1.3 PHP Version Selection ✅

Configure the target PHP version to control which syntax is accepted and which errors are emitted.

**Status:** Complete. `PhpVersion` enum implemented with version gating for all version-specific syntax. Fixtures use `===config===` sections for version-gated tests. Complete version gating coverage achieved.

---

## Phase 2 — Analysis & Output

Builds on Phase 1 infrastructure.

### 2.1 Semantic Analysis

Scope tracking, name resolution, and type checking as a separate pass over the AST.

**Enables:** real compile-error detection, IDE features (go-to-definition, find-references), refactoring safety.

**Scope (each sub-feature is independently useful):**

1. **Symbol table** — collect all declarations (functions, classes, constants, variables) with their scopes and spans
2. **Scope tracking** — resolve variable visibility (`global`, `static`, closure `use`, function scope boundaries)
3. **Name resolution** — resolve `use` aliases, qualified names, `self`/`parent`/`static` to their declarations
4. **Type inference** — propagate types through assignments, returns, and expressions
5. **Compile-error detection** — duplicate declarations, `break` outside loop, abstract method in non-abstract class, etc.
6. **Type checking** — validate argument types, return types, property types against declarations

**Difficulties:**
- **Scope is enormous** — full semantic analysis is effectively building a PHP compiler frontend. Prioritize symbol table + name resolution first.
- **PHP's dynamic nature** — `$$var`, `extract()`, `compact()`, `new $className` make static analysis fundamentally incomplete. The analyzer must be sound but incomplete.
- **Autoloading** — single-file analysis cannot resolve cross-file references without a project-level index. Major architectural decision: single-file vs. project-wide.
- **Standard library** — type information for 5000+ built-in functions requires a stubs database (phpstorm-stubs or php-src).
- **Trait resolution** — `insteadof` and `as` create complex method resolution orders.

**Blockers:** Visitor API (1.2). Comment preservation (1.1) is complete, including PHPDoc parsing for doc-block types.

### 2.2 Pretty Printer

AST-to-source output for code generation and refactoring tools.

**Enables:** code formatting, automated refactoring (rename, extract method), codegen.

**Scope:**
- `Printer` struct that walks the AST and emits PHP source
- Configurable formatting options (indentation style, brace placement, spacing rules)
- Round-trip fidelity: `parse(source) |> print` should produce semantically equivalent code
- Comment preservation: print attached comments in the right positions

**Difficulties:**
- **Whitespace and formatting** — PHP has many syntactic forms (alternative syntax, short tags, heredoc). Each needs formatting decisions.
- **Operator precedence** — the printer must add parentheses when removing them would change semantics. Requires knowing parent vs. child binding power.
- **Comment placement** — printing comments in the right location (before/after/inline) is one of the hardest problems in pretty printers.
- **Large surface area** — every AST node needs a print implementation.

**Blockers:** Visitor API (1.2). Comment preservation (1.1) is complete.

---

## Phase 3 — Integration & Tooling

End-user-facing features that depend on the analysis and output layers.

### 3.1 LSP Integration

Use the parser as a backend for a PHP Language Server.

**Enables:** IDE features in VS Code, Neovim, etc. — diagnostics, go-to-definition, hover, completions, rename.

**Scope (incremental):**

1. **Diagnostics** — report parse errors as LSP diagnostics (works today with minimal glue)
2. **Document symbols** — list classes, functions, methods, constants
3. **Go-to-definition** — resolve names to declaration locations
4. **Hover** — show type info and doc comments
5. **Completions** — suggest names in scope
6. **Rename** — rename symbols across usages
7. **Formatting** — format document/selection

**Difficulties:**
- **LSP protocol** — use `tower-lsp` or `lsp-server` to handle protocol details.
- **Incremental updates** — LSP sends edits, not full files. Full re-parse is likely fast enough for single files; measure before adding complexity.
- **Multi-file analysis** — go-to-definition for imported classes requires a project indexer watching the filesystem.
- **Concurrency** — LSP requests arrive concurrently; the server must handle cancellation and concurrent AST access.

**Blockers:** Semantic analysis (2.1) for anything beyond basic diagnostics. Pretty printer (2.2) for formatting. Comment preservation (1.1) is complete.

### 3.2 Incremental Parsing

Re-parse only changed regions on edit.

**Enables:** sub-millisecond re-parse for responsive IDE experience at scale.

**Scope:**
- Track which byte ranges map to which AST nodes
- On edit, determine the minimal set of nodes that need re-parsing
- Re-parse only affected regions and splice into the existing AST

**Difficulties:**
- **Research-level problem** — Tree-sitter solves this with a GLR parser and tree diffing. Doing it with a hand-written recursive descent parser is significantly harder.
- **Context sensitivity** — PHP parser state depends heavily on context (inside a string, inside a class, heredoc state). Resuming mid-file requires reconstructing the correct state.
- **Architectural change** — the current parser produces a fresh AST per call. Incremental parsing requires a persistent CST/red-green tree structure.
- **Alternative** — measure first. Full re-parse of a single file is already very fast. Only invest in true incremental parsing if profiling in an LSP context proves it necessary.

**Blockers:** LSP integration (3.1) — needed to prove full re-parse is too slow.

### 3.3 WASM Target

Compile to WebAssembly for browser-based PHP tooling.

**Enables:** PHP playground in the browser, online formatter/linter, documentation tools, education.

**Scope:**
- Compile to `wasm32-unknown-unknown` or `wasm32-wasi`
- Expose a JavaScript API via `wasm-bindgen`: `parse(source) -> JSON AST`
- Publish as an npm package
- Optionally expose pretty-printer and diagnostic APIs

**Difficulties:**
- **Dependency audit** — all dependencies must support WASM. `serde_json` works. Error reporting crates may need feature-gating.
- **Binary size** — use `wasm-opt`, LTO, strip debug info.
- **String encoding** — JavaScript strings are UTF-16; spans (byte offsets) need conversion utilities for JS consumers.
- **Testing** — CI step to build WASM and run tests in Node.js.

**Blockers:** None strictly — the parser can be compiled to WASM today. More useful after the pretty printer (2.2) exists.

---

## Summary

### Dependency Graph

```
1.1 Comment Preservation ✅ ───────────┐
                                       ├──→ 2.2 Pretty Printer ──→ 3.1 LSP ──→ 3.2 Incremental
1.2 Visitor / Walker API ──┬───────────┘                             ↑
                           └──→ 2.1 Semantic Analysis ───────────────┘
1.3 PHP Version Selection ✅

3.3 WASM Target (independent, improves with 2.2)
```

**Next up:** Visitor / Walker API (1.2) is the critical-path item — it unblocks both semantic analysis and the pretty printer.

**Note:** Performance optimization is tracked separately in `PERFORMANCE_ANALYSIS.md` and is ongoing independent of feature phases.

### Additional completed work (not originally on roadmap)

- **Test infrastructure overhaul** — migrated all tests to `.phpt` fixture files with `===source===`, `===config===`, and `===errors===` sections; eliminated all `.snap` files and removed `insta` dependency; auto-discovery of fixture files
- **Public API documentation** — rustdoc added to public API surface
- **Dependency cleanup** — replaced `lazy_static` with `std::sync::OnceLock`

### Complexity Estimates

| Feature | Complexity | Estimate |
|---------|------------|----------|
| 1.1 Comment Preservation | ✅ Complete | Includes PHPDoc parser + Psalm/PHPStan annotations |
| 1.2 Visitor / Walker API | Medium | ~800–1200 lines (mechanical but large) |
| 1.3 PHP Version Selection | ✅ Complete | Full version gating for all version-specific syntax |
| 2.1 Semantic Analysis | Very High | ~3000–5000+ lines (open-ended) |
| 2.2 Pretty Printer | High | ~2000–3000 lines |
| 3.1 LSP Integration | High | ~2000–4000 lines + new crate |
| 3.2 Incremental Parsing | Very High | ~3000–5000+ lines (research-level) |
| 3.3 WASM Target | Low | ~200–400 lines of glue + build config |
