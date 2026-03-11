# PHP Parser - Development Guidelines

## Testing

**NEVER run `cargo test` without a filter.** The full test suite compiles 8+ test binaries and uses excessive memory.

Always run tests for a specific test file:
```bash
cargo test --test integration               # integration tests
cargo test --test nikic_integration_tests   # all nikic tests
```

Or filter to a specific test:
```bash
cargo test --test integration test_class_basic
```

To accept new snapshots: `cargo insta accept`
