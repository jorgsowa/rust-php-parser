# PHP Parser - Development Guidelines

## Testing

**NEVER run `cargo test` without a filter.** The full test suite compiles 8+ test binaries and uses excessive memory.

Always run tests for a specific test file:
```bash
cargo test --test integration          # integration tests
cargo test --test nikic_stmt_tests     # nikic statement tests
cargo test --test nikic_expr_tests     # nikic expression tests
cargo test --test nikic_error_tests    # nikic error handling tests
cargo test --test nikic_scalar_tests   # nikic scalar tests
cargo test --test nikic_misc_tests     # nikic misc tests
```

Or filter to a specific test:
```bash
cargo test --test integration test_class_basic
```

To accept new snapshots: `cargo insta accept`
