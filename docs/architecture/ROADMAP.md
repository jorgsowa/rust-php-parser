# Roadmap

This roadmap covers feature development and tracks ongoing performance optimization work.

**Current status:** Phase 1 complete. Phase 2.2 (Pretty Printer) complete. Phase 2.1 (Semantic Analysis) in progress — symbol table, source map, and comment map done; scope tracking and name resolution remaining.

**Performance work** (completed optimizations, remaining opportunities, and detailed analysis) is documented in [`PERFORMANCE_ANALYSIS.md`](./PERFORMANCE_ANALYSIS.md).

---

## Phase 1 — Core Infrastructure

Foundational changes that unlock multiple downstream features. Almost everything in Phase 2 and 3 depends on these.

### 1.1 Comment Preservation ✅

Attach comments to AST nodes instead of discarding them during lexing.

**Status:** Complete. Comments are attached to AST nodes with leading/trailing placement. PHPDoc parser added for structured doc-comment extraction including Psalm/PHPStan annotation support. Doc comments are attached to declaration nodes (classes, functions, methods, properties, etc.).

**Blockers:** None.

### 1.2 Visitor / Walker API ✅

Trait-based AST traversal for analysis and transformation passes.

**Status:** Complete. `Visitor` trait with `ControlFlow<()>` return for early termination and subtree skipping. Visit methods for all node types: statements, expressions, params, args, class/enum members, property hooks, type hints, attributes, catch clauses, match arms, closure use vars. Corresponding `walk_*` free functions for each. Walks type hints (including union/intersection/nullable), attributes, and declare directives that were previously skipped.

**Remaining:** `VisitorMut`/`Fold` for AST transformations is tracked separately (see 2.3 below) — arena allocation (`&'arena`) makes in-place mutation of pointer-behind fields unsound. A `Fold` that rebuilds nodes into a new arena is the correct approach but requires a separate design.

**Blockers:** None.

### 1.3 PHP Version Selection ✅

Configure the target PHP version to control which syntax is accepted and which errors are emitted.

**Status:** Complete. `PhpVersion` enum implemented with version gating for all version-specific syntax. Fixtures use `===config===` sections for version-gated tests. Complete version gating coverage achieved.

---

## Phase 2 — Analysis & Output

Builds on Phase 1 infrastructure.

### 2.1 Parse-time Validation (in progress)

Structural error checks that can be performed during or immediately after parsing, using only syntactic context — no name resolution or type information required.

**Already implemented:**
- `abstract final` on classes and methods
- Duplicate modifiers (`static`, `abstract`, `final`, `readonly`)
- Multiple visibility modifiers on a single member
- `static readonly` property combination
- Positional argument after named argument
- `class` keyword as an enum case name

**Remaining:**
- **`break`/`continue` outside loop/switch** — emit a parse error when these appear at the top level or inside a function/class body with no enclosing loop or switch; requires tracking loop nesting depth in the parser
- **Backed enum case value enforcement** — a backed enum (`enum E: int`) must have `= value` on every case; a pure enum must not; detectable from the enum declaration header alone
- **`readonly` property without a type** — PHP requires a type hint on every `readonly` property; emittable as a parse error at the declaration site

**Blockers:** None.

### 2.2 Pretty Printer ✅

### 2.3 Fold / VisitorMut

AST transformation via a `Fold` trait that rebuilds nodes into a new arena.

**Enables:** code transformations (e.g., removing dead code, rewriting deprecated syntax, macro expansion), tooling that needs to produce a modified AST.

**Scope:**
- A `Fold` trait with a method per node type that returns an owned rebuilt node
- Each method has a default implementation that recurses and rebuilds unchanged
- Implementations override only the nodes they need to transform
- Output lands in a fresh arena; the input arena is read-only

**Why not `VisitorMut`:**
Arena allocation (`&'arena T`) means all pointers into the arena share the arena's lifetime. In-place mutation of pointer-behind fields would require unsafe aliasing. A `Fold` that reads from one arena and writes to another is sound.

**Blockers:** None.

AST-to-source output for code generation and refactoring tools.

**Status:** Complete. New `php-printer` crate with `pretty_print()`, `pretty_print_file()`, and `pretty_print_with_config()` API. Handles all StmtKind/ExprKind variants with correct operator precedence and automatic parenthesization. Configurable indentation (spaces/tabs). Prints doc comments, attributes, type hints (union/intersection/nullable), property hooks, match expressions, closures, arrow functions, enums, and all OOP constructs. 62 tests including round-trip verification.

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

**Blockers:** Full semantic analysis (2.1) for go-to-definition and completions. Symbol table, source map, and comment map are now available for diagnostics, document symbols, and basic hover.

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
1.1 Comment Preservation ✅ ────────────┐
                                        ├──→ 2.2 Pretty Printer ✅ ──→ 3.1 LSP ──→ 3.2 Incremental
1.2 Visitor / Walker API ✅ ──┬─────────┘        ↑
                              └──→ 2.3 Fold ─────┘
1.3 PHP Version Selection ✅

2.1 Parse-time Validation (in progress, independent)
  ├── break/continue outside loop
  ├── backed enum value enforcement
  └── readonly without type

3.3 WASM Target (independent, improves with 2.2 ✅)
```

**Phase 1 complete. Phase 2.2 complete. Phase 2.1 in progress.** LSP integration and WASM target are now unblocked.

**Note:** Performance optimization is tracked separately in `PERFORMANCE_ANALYSIS.md` and is ongoing independent of feature phases.

### Additional completed work (not originally on roadmap)

- **Test infrastructure overhaul** — migrated all tests to `.phpt` fixture files with `===source===`, `===config===`, and `===errors===` sections; eliminated all `.snap` files and removed `insta` dependency; auto-discovery of fixture files
- **Public API documentation** — rustdoc added to public API surface
- **Dependency cleanup** — replaced `lazy_static` with `std::sync::OnceLock`
- **LSP foundations** — `source_map` (byte offset ↔ line/col), `comment_map` (comment-to-node attachment), `symbol_table` (declaration extraction with FQN resolution) added to `php-ast`
- **`php-printer` crate** — full AST-to-PHP pretty printer published to crates.io
- **WordPress corpus** — 14,000+ real-world PHP files parse with zero errors; regression suite added
- **Performance analysis** — corpus analysis across Laravel, Symfony, WordPress; arena/allocation tuning documented

### Complexity Estimates

| Feature | Complexity | Estimate |
|---------|------------|----------|
| 1.1 Comment Preservation | ✅ Complete | Includes PHPDoc parser + Psalm/PHPStan annotations |
| 1.2 Visitor / Walker API | ✅ Complete | ControlFlow support, type hints, attributes, 13 visit methods |
| 1.3 PHP Version Selection | ✅ Complete | Full version gating for all version-specific syntax |
| 2.1 Parse-time Validation | Low–Medium | In progress — most modifier combos done; break/continue context, enum backing, readonly-without-type remaining |
| 2.3 Fold / VisitorMut | Medium | ~500–1000 lines; one method per node type, default recursion, arena-to-arena rebuild |
| 2.2 Pretty Printer | ✅ Complete | New `php-printer` crate, 62 tests, round-trip verified |
| 3.1 LSP Integration | High | ~2000–4000 lines + new crate |
| 3.2 Incremental Parsing | Very High | ~3000–5000+ lines (research-level) |
| 3.3 WASM Target | Low | ~200–400 lines of glue + build config |
