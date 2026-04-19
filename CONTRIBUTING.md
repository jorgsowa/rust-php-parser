# Contributing

## Build & Test

```bash
cargo test                           # run all tests
cargo test -p php-rs-parser          # parser tests only
cargo test -p php-printer            # printer tests only
UPDATE_FIXTURES=1 cargo test         # regenerate expected AST/errors in .phpt fixtures
cargo bench                          # benchmarks
```

## For Contributors

1. Review [docs/architecture/ROADMAP.md](docs/architecture/ROADMAP.md) for project vision
2. Check [docs/architecture/FEATURE_ROADMAP.md](docs/architecture/FEATURE_ROADMAP.md) for planned work
3. Read [docs/development/ERRORS.md](docs/development/ERRORS.md) for error types and fixture conventions
4. Check [docs/analysis/COVERAGE_REPORT.md](docs/analysis/COVERAGE_REPORT.md) for test coverage gaps

## For Performance Researchers

1. Start with [docs/performance/PERFORMANCE_ANALYSIS.md](docs/performance/PERFORMANCE_ANALYSIS.md)
2. Read [docs/performance/CORPUS_ANALYSIS_MARCH2026.md](docs/performance/CORPUS_ANALYSIS_MARCH2026.md) for real-world corpus metrics
3. Check [docs/performance/MEMORY_OPTIMIZATION_MARCH2026.md](docs/performance/MEMORY_OPTIMIZATION_MARCH2026.md) for allocation tuning details
4. Review [docs/performance/OPTIMIZATION_ATTEMPT_MARCH2026.md](docs/performance/OPTIMIZATION_ATTEMPT_MARCH2026.md) for lessons learned
