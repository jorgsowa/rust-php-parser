# Documentation Index

## Quick Links

- **[README.md](../README.md)** — Project overview and quick start
- **[CLAUDE.md](../CLAUDE.md)** — Development guidelines

---

## Architecture & Design

### Core Documentation
- **[ROADMAP.md](architecture/ROADMAP.md)** — Project roadmap and vision
- **[FEATURE_ROADMAP.md](architecture/FEATURE_ROADMAP.md)** — Feature implementation plan (Path B)
- **[INSTRUMENTATION.md](architecture/INSTRUMENTATION.md)** — Profiling framework design and usage

---

## Performance & Optimization

### Analysis & Profiling
- **[PERFORMANCE_ANALYSIS.md](performance/PERFORMANCE_ANALYSIS.md)** — Comprehensive performance analysis and benchmarks
- **[SYMFONY_OPTIMIZATION_ANALYSIS.md](performance/SYMFONY_OPTIMIZATION_ANALYSIS.md)** — Symfony corpus optimization analysis
- **[CORPUS_ANALYSIS_MARCH2026.md](performance/CORPUS_ANALYSIS_MARCH2026.md)** — Real-world corpus metrics (14K files)
- **[PROFILING_RESULTS_2026_03_15.md](performance/PROFILING_RESULTS_2026_03_15.md)** — pprof flamegraph analysis

### Optimization Attempts
- **[OPTIMIZATION_INVESTIGATION_MARCH2026.md](performance/OPTIMIZATION_INVESTIGATION_MARCH2026.md)** — Investigation of optimization opportunities
- **[OPTIMIZATION_ATTEMPT_MARCH2026.md](performance/OPTIMIZATION_ATTEMPT_MARCH2026.md)** — Fast-path optimization attempt (failed, documented)

### Memory & Allocation
- **[MEMORY_OPTIMIZATION_MARCH2026.md](performance/MEMORY_OPTIMIZATION_MARCH2026.md)** — Arena allocation tuning (5x optimization)
- **[MEMORY_ALLOCATION_PATTERNS_MARCH2026.md](performance/MEMORY_ALLOCATION_PATTERNS_MARCH2026.md)** — Detailed allocation pattern analysis
- **[ALLOCATION_ANALYSIS_MARCH_2026.md](performance/ALLOCATION_ANALYSIS_MARCH_2026.md)** — Bumpalo allocation metrics

### Parsing Analysis
- **[STATEMENT_PARSING_ANALYSIS_MARCH2026.md](performance/STATEMENT_PARSING_ANALYSIS_MARCH2026.md)** — Statement parsing performance analysis

### Flamegraph Visualizations
- **[flamegraph.svg](performance/flamegraph.svg)** — pprof flamegraph (full corpus baseline)
- **[flamegraph_symfony.svg](performance/flamegraph_symfony.svg)** — pprof flamegraph (Symfony corpus, 5× bottleneck)

---

## Coverage & Testing

### Test Coverage
- **[COVERAGE_REPORT.md](analysis/COVERAGE_REPORT.md)** — Code coverage analysis (93-94% avg)
- **[STMT_COVERAGE_ANALYSIS.md](analysis/STMT_COVERAGE_ANALYSIS.md)** — Statement parser coverage gaps

---

## Release & Development

### Releases & Changelog
- **[CHANGELOG.md](development/CHANGELOG.md)** — Version history and notable changes

---

## Key Findings

### Optimization Plateau (March 2026)
The parser has reached diminishing returns on optimization. After comprehensive analysis:
- **Profiling:** pprof flamegraphs (SVG) show bumpalo allocation (4.3%) as #1 bottleneck
  - View: [flamegraph.svg](performance/flamegraph.svg) (full corpus)
  - View: [flamegraph_symfony.svg](performance/flamegraph_symfony.svg) (Symfony 5× bottleneck)
- **Tuning:** Reduced allocation to 3.5% via 5x pre-allocation
- **Symfony Focus:** 83.8% key-value arrays = 34.5% of parse_expr() overhead
- **Attempted Fast Path:** Failed (test regression); documented in OPTIMIZATION_ATTEMPT_MARCH2026.md
- **Conclusion:** Further improvements require architectural changes (proven ineffective)

### Feature Completeness
The parser supports **PHP 5.3–8.4** syntax with excellent coverage:
- ✅ All expression types (45 variants)
- ✅ All statement types (34 variants)
- ✅ Attributes, union types, match expressions, readonly, DNF types
- ⚠️ Missing: Comment preservation, visitor API, version gating (planned in FEATURE_ROADMAP.md)

---

## Navigation by Role

### For Users
1. Read [../README.md](../README.md) for quick start
2. Check [PERFORMANCE_ANALYSIS.md](performance/PERFORMANCE_ANALYSIS.md) for benchmarks
3. Use [INSTRUMENTATION.md](architecture/INSTRUMENTATION.md) for profiling

### For Contributors
1. Read [../CLAUDE.md](../CLAUDE.md) for development guidelines
2. Review [ROADMAP.md](architecture/ROADMAP.md) for project vision
3. Check [FEATURE_ROADMAP.md](architecture/FEATURE_ROADMAP.md) for next work
4. Refer to [COVERAGE_REPORT.md](analysis/COVERAGE_REPORT.md) for test gaps

### For Performance Researchers
1. Start with [PERFORMANCE_ANALYSIS.md](performance/PERFORMANCE_ANALYSIS.md)
2. Read [CORPUS_ANALYSIS_MARCH2026.md](performance/CORPUS_ANALYSIS_MARCH2026.md) for corpus metrics
3. Check [MEMORY_OPTIMIZATION_MARCH2026.md](performance/MEMORY_OPTIMIZATION_MARCH2026.md) for tuning details
4. Review [OPTIMIZATION_ATTEMPT_MARCH2026.md](performance/OPTIMIZATION_ATTEMPT_MARCH2026.md) for lessons learned

---

## File Organization

```
docs/
├── INDEX.md                                          # This file
├── architecture/
│   ├── ROADMAP.md                                   # Project roadmap
│   ├── FEATURE_ROADMAP.md                           # Feature implementation plan
│   └── INSTRUMENTATION.md                           # Profiling framework
├── performance/
│   ├── PERFORMANCE_ANALYSIS.md                      # Main performance doc
│   ├── SYMFONY_OPTIMIZATION_ANALYSIS.md             # Symfony-specific analysis
│   ├── CORPUS_ANALYSIS_MARCH2026.md                 # Real-world corpus metrics
│   ├── PROFILING_RESULTS_2026_03_15.md             # pprof flamegraph data
│   ├── OPTIMIZATION_INVESTIGATION_MARCH2026.md      # Opportunity investigation
│   ├── OPTIMIZATION_ATTEMPT_MARCH2026.md            # Failed fast-path attempt
│   ├── MEMORY_OPTIMIZATION_MARCH2026.md             # Allocation tuning
│   ├── MEMORY_ALLOCATION_PATTERNS_MARCH2026.md      # Allocation pattern analysis
│   ├── ALLOCATION_ANALYSIS_MARCH_2026.md            # Bumpalo metrics
│   └── STATEMENT_PARSING_ANALYSIS_MARCH2026.md      # Statement parsing perf
├── analysis/
│   ├── COVERAGE_REPORT.md                           # Code coverage (93-94%)
│   └── STMT_COVERAGE_ANALYSIS.md                    # Statement coverage gaps
└── development/
    └── CHANGELOG.md                                  # Version history
```

---

## Recent Updates (March 2026)

- ✅ Published all 3 crates to crates.io (v0.2.1)
- ✅ Fixed WordPress corpus (3 bugs → zero errors)
- ✅ Added 31 tests for malformed PHP error recovery
- ✅ Reached optimization plateau (documented findings)
- ✅ Created FEATURE_ROADMAP.md for Path B work

---

## Contact & Contributions

- **Repository:** https://github.com/jorgsowa/rust-php-parser
- **Crates:** [php-ast](https://crates.io/crates/php-ast), [php-lexer](https://crates.io/crates/php-lexer), [php-rs-parser](https://crates.io/crates/php-rs-parser)
- **Benchmarks:** https://github.com/jorgsowa/php-parser-benchmark

