# Roadmap

This roadmap breaks down the planned features from most foundational to most ambitious. Later phases build on earlier ones, so the order matters.

---

## Phase 1 — Core Infrastructure

These are foundational changes that unlock multiple downstream features. They should come first because almost everything else depends on them.

### 1.1 Comment Preservation

Attach comments to AST nodes instead of discarding them during lexing.

**What it enables:** pretty printer, formatter, linter, LSP hover docs, doc-block extraction.

**Scope:**
- Add `Comment` type to `php-ast` with variants: `Line` (`//`), `Hash` (`#`), `Block` (`/* */`), `Doc` (`/** */`)
- Each comment carries a `Span` and its raw text
- Store comments on AST nodes (leading/trailing/inner) — similar to how `swc` or `oxc` handle it
- Lexer must yield comment tokens instead of skipping them; parser attaches them to the nearest node

**Difficulties:**
- **Placement ambiguity** — a comment between two statements could belong to either. Need a consistent heuristic (e.g. leading-comment attaches to the next node if on its own line, trailing-comment attaches to the previous node if on the same line).
- **Performance** — storing comments on every node increases memory. Consider a side-table (`HashMap<NodeId, Vec<Comment>>`) instead of inlining on each struct.
- **Backwards compatibility** — every AST struct gains a new field or every consumer must look up the side-table. Either way, serialization format changes and all 500+ snapshots will need updating.

**Blockers:** None — this can start immediately.

### 1.2 Visitor / Walker API

Trait-based AST traversal for analysis and transformation passes.

**What it enables:** semantic analysis, linters, codemods, pretty printer, symbol extraction for LSP.

**Scope:**
- `Visitor` trait with `visit_stmt`, `visit_expr`, `visit_type_hint`, etc., with default implementations that recurse
- `walk_*` free functions that drive the recursion
- Mutable variant (`VisitorMut` or `Fold`) for AST transformations
- Derive or hand-write traversal for every AST node

**Difficulties:**
- **AST size** — there are 30+ statement kinds, 50+ expression kinds, plus OOP members, params, type hints, match arms, etc. Every variant needs a walk arm. This is a large, mechanical but error-prone task.
- **Ownership** — a read-only `Visitor<'ast>` taking `&'ast Node` is straightforward. A mutable `Fold` that returns owned nodes requires moving values, which complicates the API. Consider providing both.
- **Traversal control** — callers need to be able to skip subtrees or stop early. A `ControlFlow`-style return type (or a boolean `should_continue`) is needed.

**Blockers:** None — can start in parallel with comment preservation.

### 1.3 PHP Version Selection

Configure target PHP version to control which syntax is accepted and which errors are emitted.

**What it enables:** accurate diagnostics per version, version-specific linting, migration tooling.

**Scope:**
- `PhpVersion` enum or struct (e.g. `PhpVersion::PHP80`, `PhpVersion::PHP84`)
- Pass version to `parse()` or via a builder/config struct
- Gate features on version: reject `match` before 8.0, reject `|>` before 8.4, reject `readonly` classes before 8.2, etc.
- Emit version-specific errors: `(unset)` cast error only >= 8.0, `(real)` cast warning >= 8.0, etc.

**Difficulties:**
- **Combinatorial surface** — PHP has dozens of version-gated features spanning lexer, parser, and semantics. Building a complete version matrix is research-heavy. The nikic/PHP-Parser source is a good reference.
- **Lexer interaction** — some tokens only exist in certain versions (e.g. `|>` is invalid before 8.4). Either the lexer needs the version, or the parser must reject valid tokens.
- **Testing** — each version gate needs tests for "accepted in version X" and "rejected in version Y". Test count could double.
- **Default behavior** — currently everything is accepted. Changing the default to a specific version could break existing users. Safest default: accept all (current behavior) unless a version is explicitly set.

**Blockers:** None technically, but best started after the visitor API exists so version-specific lint rules can use it.

---

## Phase 2 — Analysis & Output

These features build on Phase 1 infrastructure.

### 2.1 Semantic Analysis

Scope tracking, type checking, and symbol resolution as a separate pass over the AST.

**What it enables:** real compile-error detection, IDE features (go-to-definition, find-references), refactoring safety.

**Scope (incremental — each sub-feature is independently useful):**

1. **Symbol table** — collect all declarations (functions, classes, constants, variables) with their scopes and spans
2. **Scope tracking** — resolve variable visibility (`global`, `static`, closure `use`, function scope boundaries)
3. **Name resolution** — resolve `use` aliases, qualified names, `self`/`parent`/`static` to their declarations
4. **Type inference** — propagate types through assignments, returns, and expressions
5. **Compile-error detection** — duplicate declarations, `break` outside loop, abstract method in non-abstract class, interface method with body, etc.
6. **Type checking** — validate argument types, return types, property types against declarations

**Difficulties:**
- **Scope is enormous** — full semantic analysis is effectively building a PHP compiler frontend. Prioritize the most useful subset (symbol table + name resolution) first.
- **PHP's dynamic nature** — variable variables (`$$var`), `extract()`, `compact()`, dynamic class instantiation (`new $className`) make static analysis fundamentally incomplete. The analyzer must be sound but incomplete (report what it can prove, ignore what it cannot).
- **Autoloading** — PHP classes are typically loaded via autoloader. Single-file analysis cannot resolve cross-file references without a project-level index. This is a major architectural decision: single-file vs. project-wide.
- **Standard library** — type information for PHP built-in functions (5000+) requires a stubs database (e.g. from phpstorm-stubs or php-src).
- **Trait resolution** — PHP trait composition (especially with `insteadof` and `as`) creates complex method resolution orders.

**Blockers:** Visitor API (Phase 1.2) — semantic passes should be implemented as visitors. Symbol table benefits from comment preservation for doc-block types.

### 2.2 Pretty Printer

AST-to-source output for code generation and refactoring tools.

**What it enables:** code formatting, automated refactoring (rename, extract method), codegen.

**Scope:**
- `Printer` struct that walks the AST and emits PHP source
- Configurable formatting options (indentation style, brace placement, spacing rules)
- Round-trip fidelity: `parse(source) |> print` should produce equivalent code
- Comment preservation: print attached comments in the right positions

**Difficulties:**
- **Whitespace and formatting** — PHP has many syntactic forms (alternative syntax, short tags, heredoc). Deciding how to format each is a design exercise, not just implementation.
- **Operator precedence and parentheses** — the printer must add parentheses when removing them would change semantics. This requires knowing the binding power of parent vs. child expressions.
- **String representation** — choosing between single/double quotes, heredoc vs. string, escaping strategies.
- **Comment placement** — printing comments in the right location (before/after/inline) is one of the hardest problems in pretty printers.
- **Large surface area** — every AST node needs a print implementation. This mirrors the visitor effort but with formatting decisions on top.

**Blockers:** Comment preservation (Phase 1.1) — a printer without comments loses information. Visitor API (Phase 1.2) — the printer is best structured as a visitor.

---

## Phase 3 — Integration & Tooling

These are end-user-facing features that depend on the analysis and output layers.

### 3.1 LSP Integration

Use the parser as a backend for a PHP Language Server.

**What it enables:** IDE features in VS Code, Neovim, etc. — diagnostics, go-to-definition, hover, completions, rename.

**Scope (incremental):**

1. **Diagnostics** — report parse errors as LSP diagnostics (this works today with minimal glue)
2. **Document symbols** — list classes, functions, methods, constants (requires symbol table from 2.1)
3. **Go-to-definition** — resolve names to declaration locations (requires name resolution from 2.1)
4. **Hover** — show type info and doc comments (requires semantic analysis + comment preservation)
5. **Completions** — suggest names in scope (requires scope tracking from 2.1)
6. **Rename** — rename symbols across usages (requires find-references from 2.1)
7. **Formatting** — format document/selection (requires pretty printer from 2.2)

**Difficulties:**
- **LSP protocol** — the LSP specification is large. Use the `tower-lsp` or `lsp-server` crate to handle protocol details.
- **Incremental updates** — LSP sends edits, not full files. Without incremental parsing (Phase 3.2), the entire file must be re-parsed on every keystroke. This is likely fast enough for single files (the parser is fast) but may need throttling.
- **Multi-file analysis** — real IDE features need cross-file resolution (e.g. go-to-definition for imported classes). This requires a project indexer that watches the filesystem and maintains a symbol database.
- **Concurrency** — LSP requests arrive concurrently. The server must handle cancellation, re-parsing on edit, and concurrent read access to the AST/symbol table.
- **Testing** — LSP servers are hard to test. Consider an in-process test harness that sends LSP messages and checks responses.

**Blockers:** Semantic analysis (Phase 2.1) for anything beyond basic diagnostics. Pretty printer (Phase 2.2) for formatting. Comment preservation (Phase 1.1) for hover docs.

### 3.2 Incremental Parsing

Re-parse only changed regions for IDE integration.

**What it enables:** fast re-parse on edit (sub-millisecond for small changes), essential for responsive IDE experience at scale.

**Scope:**
- Track which byte ranges map to which AST nodes
- On edit, determine the minimal set of nodes that need re-parsing
- Re-parse only affected regions and splice into the existing AST
- Maintain a syntax tree structure that supports efficient updates (consider a rope or zipper)

**Difficulties:**
- **This is a research-level problem.** Tree-sitter solves it with a GLR parser and tree diffing. Doing it with a hand-written recursive descent parser is significantly harder.
- **Context sensitivity** — PHP's parser state depends on context (e.g. inside a string, inside a class, heredoc state). Resuming parsing mid-file requires reconstructing the correct state.
- **Error recovery interaction** — error recovery already makes parsing stateful. Incremental re-parse must handle error nodes correctly.
- **Architectural change** — the current parser produces a fresh AST on each call. Incremental parsing requires a persistent tree structure, which is a fundamentally different data structure (CST/red-green tree vs. AST).
- **Alternative approach** — rather than true incremental parsing, a simpler strategy is to re-parse the entire file but make it so fast it doesn't matter. The current parser is already very fast on single files. Measure before committing to full incremental parsing.

**Blockers:** This is the most complex feature. It should only be attempted after LSP integration (Phase 3.1) proves that full re-parse is too slow for the target use case.

### 3.3 WASM Target

Compile to WebAssembly for browser-based PHP tooling.

**What it enables:** PHP playground in the browser, online formatter/linter, documentation tools, education.

**Scope:**
- Compile the workspace to `wasm32-unknown-unknown` or `wasm32-wasi`
- Expose a JavaScript API via `wasm-bindgen`: `parse(source) -> JSON AST`
- Publish as an npm package
- Optionally expose pretty-printer and diagnostic APIs

**Difficulties:**
- **Dependency audit** — all dependencies must support WASM. `logos` (lexer generator) should work. `miette` (error reporting) uses platform-specific features and may need to be feature-gated or replaced for WASM. `serde_json` works.
- **Binary size** — WASM bundles should be small. Use `wasm-opt`, enable LTO, strip debug info. The current codebase is relatively lean, so this should be manageable.
- **Error reporting** — `miette`'s fancy terminal output won't work in a browser. Need a WASM-friendly error format (plain JSON errors).
- **String encoding** — JavaScript strings are UTF-16, Rust strings are UTF-8. Spans (byte offsets) will need conversion utilities for JS consumers.
- **Testing** — need a CI step that builds WASM and runs tests in a JS runtime (Node.js or browser).

**Blockers:** None strictly — the parser can be compiled to WASM today. But it becomes much more useful after the pretty printer (Phase 2.2) exists.

---

## Phase Summary

```
Phase 1 — Core Infrastructure (no dependencies)
  1.1 Comment Preservation
  1.2 Visitor / Walker API
  1.3 PHP Version Selection

Phase 2 — Analysis & Output (depends on Phase 1)
  2.1 Semantic Analysis          ← needs 1.2 (Visitor)
  2.2 Pretty Printer             ← needs 1.1 (Comments) + 1.2 (Visitor)

Phase 3 — Integration & Tooling (depends on Phase 2)
  3.1 LSP Integration            ← needs 2.1 (Semantic) + 2.2 (Printer)
  3.2 Incremental Parsing        ← needs 3.1 (to prove it's needed)
  3.3 WASM Target                ← standalone, but better after 2.2 (Printer)
```

### Dependency Graph

```
1.1 Comment Preservation ──────────────┐
                                       ├──→ 2.2 Pretty Printer ──→ 3.1 LSP ──→ 3.2 Incremental
1.2 Visitor / Walker API ──┬───────────┘                             ↑
                           └──→ 2.1 Semantic Analysis ───────────────┘
1.3 PHP Version Selection

3.3 WASM Target (independent, improves with 2.2)
```

### Estimated Complexity

| Feature | Complexity | New code estimate |
|---------|-----------|-------------------|
| 1.1 Comment Preservation | Medium | ~500-800 lines across lexer + AST + parser |
| 1.2 Visitor / Walker API | Medium | ~800-1200 lines (mechanical but large) |
| 1.3 PHP Version Selection | Medium | ~300-500 lines + significant test additions |
| 2.1 Semantic Analysis | Very High | ~3000-5000+ lines (open-ended) |
| 2.2 Pretty Printer | High | ~2000-3000 lines |
| 3.1 LSP Integration | High | ~2000-4000 lines + new crate |
| 3.2 Incremental Parsing | Very High | ~3000-5000+ lines (research-level) |
| 3.3 WASM Target | Low | ~200-400 lines of glue + build config |
