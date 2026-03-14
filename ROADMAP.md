# Roadmap

This roadmap covers both performance work (completed and planned) and feature development. Feature phases are ordered from most foundational to most ambitious — later phases build on earlier ones.

---

## Performance

### Done

| Change | Branch | What |
|--------|--------|------|
| Keyword resolution | `perf/resolve-keyword-no-alloc` | Replace `to_ascii_lowercase()` in `resolve_keyword` with length-dispatched `eq_ignore_ascii_case` — eliminates 1 heap alloc per identifier token |
| Type/cast detection | `perf/type-cast-no-alloc` | Same pattern in type hint and cast detection |
| Zero-copy AST | `perf/zero-copy-ast` | AST fields changed from `String` to `&'src str` / `Cow<'src, str>` — eliminates alloc for every name, variable, param, method, class, and type identifier |
| Interpolation sub-parser | `perf/interpolation-sub-parser` | `{$expr}` in double-quoted/backtick strings uses `Parser::new_at` instead of wrapping in `<?php ;` and re-running the full parser — eliminates string alloc, AST clone, and span rewrite per interpolation |
| String/Vec optimizations | `perf/string-and-vec-optimizations` | `Vec::with_capacity` across all hot parse loops; `ExprKind::String` and `StringPart::Literal` use `Cow::Borrowed` for escape-free strings; heredoc sub-parser path for non-indented heredocs; remove unnecessary `Token::clone` in `peek_text` |
| Benchmarking suite | — | Criterion.rs harness with Laravel, Symfony, and WordPress corpora (15K PHP files) as git submodules; CI workflow runs a full bench on PRs (saves `pr` baseline) and on main (saves `main` baseline); critcmp regression table posted to PR summary; HTML report uploaded as artifact on main |
| Arena bump allocation | `perf/arena-bump-allocation` | Replace all `Box<T>` and `Vec<T>` AST allocations with `bumpalo` arena; collections use `ArenaVec`; nodes use `&'arena T`. Eliminates per-node `malloc`/`free` overhead and reduces peak heap usage to a single arena chunk. |
| `StmtKind` size + indented heredoc re-parse | `perf/stmt-kind-size-indented-heredoc-subparser` | Arena-indirect `Declare` and `Use` variants to shrink `StmtKind` enum, improving cache density. Eliminate the indented heredoc re-parse: de-indentation now happens in a single pass rather than scanning the body twice. |
| Micro-optimisations | — | `advance()` uses `std::mem::take` instead of `drain().collect()` to move lexer errors without allocating; Pratt BP functions take `TokenKind` by value (it's `Copy`) and are marked `#[inline(always)]`; `parse_simple_type` drops dead `null`/`true`/`false` identifier checks (lexer resolves these to dedicated tokens); interpolated-string part vec pre-sized to 8 instead of 4. |
| `Heredoc`/`Nowdoc` labels + Nowdoc value + zero-copy literals + arena pre-sizing | — | Heredoc/Nowdoc labels changed from `String` to `&'src str` (slice into source, zero allocation). `Nowdoc.value` changed to `Cow<'src, str>` — `Borrowed` for non-indented nowdocs, `Owned` for indented. `parse_interpolated_parts` rewritten to track a `literal_start` cursor: for escape-free runs (the common case) emits `Cow::Borrowed(&inner[start..end])` with no allocation; only materialises an owned `String` on the first escape encountered. Benchmark arena pre-sized to `src.len() * 3` to avoid chunk reallocations. |

### Remaining

| Change | What | Complexity |
|--------|------|------------|
| `ExprKind` enum size reduction | `ExprKind` is dominated by `StaticMethodCall(StaticMethodCallExpr)` (56 B — contains a `Cow` + `ArenaVec`) and `MethodCall` (40 B). This makes `ExprKind` ~64 B and `Expr { kind, span }` ~72 B. Every Pratt parser frame returns `Expr` by value, so this directly inflates stack usage and register pressure in the expression hot path. Arena-indirect `StaticMethodCall` and `MethodCall` to bring `ExprKind` closer to ~32 B. | Medium |
| `parse_simple_type` keyword-type allocation | Keyword types (`self`, `parent`, `static`, `array`, etc.) construct a full `Name { parts: alloc_vec_one(...) }` when they could be dedicated `TypeHintKind` variants, eliminating the inner `ArenaVec` allocation for every typed parameter and return type. | Low |
| `Name` single-part fast path | `parse_name()` always allocates a 1-element `ArenaVec` even for the overwhelmingly common unqualified single-part case (`strlen`, `Foo`, `$obj`). A flattened `Name::Simple { text: &'src str, span }` variant would bypass the Vec entirely for these cases. | Medium |
| `parse_heredoc_content` single pass | Currently scans heredoc content twice to find the label then the body start. Merge into one pass. | Low |

---

## Phase 1 — Core Infrastructure

Foundational changes that unlock multiple downstream features. Almost everything in Phase 2 and 3 depends on these.

### 1.1 Comment Preservation

Attach comments to AST nodes instead of discarding them during lexing.

**Enables:** pretty printer, formatter, linter, LSP hover docs, doc-block extraction.

**Scope:**
- Add `Comment` type to `php-ast` with variants: `Line` (`//`), `Hash` (`#`), `Block` (`/* */`), `Doc` (`/** */`)
- Each comment carries a `Span` and its raw text
- Store comments on AST nodes (leading/trailing/inner) — similar to how `swc` or `oxc` handle it
- Lexer must yield comment tokens instead of skipping them; parser attaches them to the nearest node

**Difficulties:**
- **Placement ambiguity** — a comment between two statements could belong to either. Need a consistent heuristic (e.g. leading-comment attaches to the next node if on its own line, trailing-comment attaches to the previous node if on the same line).
- **Performance** — storing comments on every node increases memory. Consider a side-table (`HashMap<NodeId, Vec<Comment>>`) instead of inlining on each struct.
- **Backwards compatibility** — every AST struct gains a new field or every consumer must look up the side-table. Either way, serialization format changes and all 500+ snapshots will need updating.

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

### 1.3 PHP Version Selection

Configure the target PHP version to control which syntax is accepted and which errors are emitted.

**Enables:** accurate diagnostics per version, version-specific linting, migration tooling.

**Scope:**
- `PhpVersion` enum (e.g. `PhpVersion::PHP82`, `PhpVersion::PHP84`)
- Pass version to `parse()` or via a builder/config struct
- Gate features on version: reject `match` before 8.0, `readonly` classes before 8.2, property hooks before 8.4, etc.
- Emit version-specific errors: `(unset)` cast removed in 8.0, `(real)` cast removed in 8.0, etc.

**Difficulties:**
- **Combinatorial surface** — PHP has dozens of version-gated features spanning lexer, parser, and semantics. The nikic/PHP-Parser source is the authoritative reference.
- **Lexer interaction** — some tokens only exist in certain versions. Either the lexer needs the version, or the parser must reject valid tokens.
- **Testing** — each version gate needs tests for "accepted in X" and "rejected in Y". Test count roughly doubles.
- **Default behavior** — safest default is accept-all (current behavior) unless a version is explicitly set.

**Blockers:** None technically, but best started after the visitor API so version-specific lint rules can use it.

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

**Blockers:** Visitor API (1.2). Symbol table also benefits from comment preservation (1.1) for doc-block types.

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

**Blockers:** Comment preservation (1.1) and Visitor API (1.2).

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

**Blockers:** Semantic analysis (2.1) for anything beyond basic diagnostics. Pretty printer (2.2) for formatting. Comment preservation (1.1) for hover docs.

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
Performance (independent, ongoing)

1.1 Comment Preservation ──────────────┐
                                       ├──→ 2.2 Pretty Printer ──→ 3.1 LSP ──→ 3.2 Incremental
1.2 Visitor / Walker API ──┬───────────┘                             ↑
                           └──→ 2.1 Semantic Analysis ───────────────┘
1.3 PHP Version Selection

3.3 WASM Target (independent, improves with 2.2)
```

### Complexity Estimates

| Feature | Complexity | Estimate |
|---------|------------|----------|
| 1.1 Comment Preservation | Medium | ~500–800 lines across lexer, AST, parser |
| 1.2 Visitor / Walker API | Medium | ~800–1200 lines (mechanical but large) |
| 1.3 PHP Version Selection | Medium | ~300–500 lines + significant test additions |
| 2.1 Semantic Analysis | Very High | ~3000–5000+ lines (open-ended) |
| 2.2 Pretty Printer | High | ~2000–3000 lines |
| 3.1 LSP Integration | High | ~2000–4000 lines + new crate |
| 3.2 Incremental Parsing | Very High | ~3000–5000+ lines (research-level) |
| 3.3 WASM Target | Low | ~200–400 lines of glue + build config |
