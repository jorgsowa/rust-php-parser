#!/usr/bin/env python3
"""Convert nikic/PHP-Parser .test files into individual .php fixtures + Rust test entries."""

import os
import re
import sys
from pathlib import Path

FIXTURES_DIR = Path(__file__).parent.parent / "crates" / "php-parser" / "tests" / "fixtures" / "nikic"
OUTPUT_RS = Path(__file__).parent.parent / "crates" / "php-parser" / "tests" / "nikic_tests.rs"


def classify_expects_errors(output_section: str) -> bool:
    """Check if the output section indicates parse errors."""
    for line in output_section.splitlines():
        trimmed = line.strip()
        if trimmed.startswith("array("):
            break
        if not trimmed:
            continue
        if (trimmed.startswith("Syntax error") or
            trimmed.startswith("Cannot use") or
            "Error" in trimmed or
            "error" in trimmed):
            return True
    return False


def sanitize_test_name(name: str) -> str:
    """Convert a file-path-based name to a valid Rust identifier."""
    # Replace path separators and special chars
    name = name.replace("/", "_").replace("\\", "_").replace("-", "_")
    name = name.replace(".", "_")
    # Remove any non-alphanumeric/underscore chars
    name = re.sub(r'[^a-zA-Z0-9_]', '', name)
    # Ensure it doesn't start with a digit
    if name and name[0].isdigit():
        name = "_" + name
    # Lowercase for Rust convention
    name = name.lower()
    return name


def parse_test_file(path: Path):
    """Parse a .test file and yield (title, code, expects_errors) tuples."""
    content = path.read_text(encoding='utf-8', errors='replace')
    sections = content.split("\n-----\n")

    if len(sections) < 3 or (len(sections) - 1) % 2 != 0:
        return

    i = 0
    while i + 2 < len(sections):
        title_section = sections[i]
        code = sections[i + 1]
        output = sections[i + 2]

        # Extract title from last line of the title section
        title_lines = title_section.strip().splitlines()
        title = title_lines[-1].strip() if title_lines else ""

        expects_errors = classify_expects_errors(output)

        yield (title, code, expects_errors)
        i += 2


def main():
    test_files = sorted(FIXTURES_DIR.rglob("*.test"))
    print(f"Found {len(test_files)} .test files")

    entries = []  # (rust_name, rel_php_path, expects_errors)
    skipped_template = 0
    total_cases = 0

    for test_file in test_files:
        rel = test_file.relative_to(FIXTURES_DIR)
        # e.g. "expr/math" from "expr/math.test"
        base = str(rel.with_suffix(""))

        cases = list(parse_test_file(test_file))
        if not cases:
            print(f"  SKIP (no valid cases): {rel}")
            continue

        for idx, (title, code, expects_errors) in enumerate(cases):
            total_cases += 1

            # Skip template syntax
            if "@@{" in code:
                skipped_template += 1
                continue

            # Determine .php filename
            if len(cases) == 1:
                php_rel = base + ".php"
            else:
                php_rel = f"{base}_{idx + 1}.php"

            php_path = FIXTURES_DIR / php_rel
            php_path.parent.mkdir(parents=True, exist_ok=True)
            php_path.write_text(code, encoding='utf-8')

            # Build Rust test name: nikic_ + sanitized path
            rust_name = "nikic_" + sanitize_test_name(base)
            if len(cases) > 1:
                rust_name += f"_{idx + 1}"

            entries.append((rust_name, php_rel.replace("\\", "/"), expects_errors))

    print(f"Total test cases: {total_cases}")
    print(f"Skipped (template): {skipped_template}")
    print(f"Generated: {len(entries)} .php files")

    # Check for duplicate rust names
    seen = {}
    for rust_name, php_rel, _ in entries:
        if rust_name in seen:
            print(f"  WARNING: duplicate name {rust_name} for {php_rel} and {seen[rust_name]}")
        seen[rust_name] = php_rel

    # Generate Rust file — single test function with runtime loop
    lines = []
    lines.append("use php_parser::parse;")
    lines.append("use std::path::Path;")
    lines.append("")
    lines.append("/// Each entry: (snapshot_name, fixture_file, expects_errors)")
    lines.append("const NIKIC_TESTS: &[(&str, &str, bool)] = &[")
    for rust_name, php_rel, expects_errors in entries:
        err_str = "true" if expects_errors else "false"
        lines.append(f'    ("{rust_name}", "{php_rel}", {err_str}),')
    lines.append("];")
    lines.append("")
    lines.append("#[test]")
    lines.append("fn nikic_suite() {")
    lines.append('    let base = Path::new(env!("CARGO_MANIFEST_DIR"))')
    lines.append('        .join("tests")')
    lines.append('        .join("fixtures")')
    lines.append('        .join("nikic");')
    lines.append("")
    lines.append("    let mut failures = Vec::new();")
    lines.append("")
    lines.append("    for &(name, file, expects_errors) in NIKIC_TESTS {")
    lines.append("        let source = std::fs::read_to_string(base.join(file))")
    lines.append('            .unwrap_or_else(|e| panic!("Failed to read {file}: {e}"));')
    lines.append("")
    lines.append("        let result = match std::panic::catch_unwind(|| parse(&source)) {")
    lines.append("            Ok(r) => r,")
    lines.append("            Err(_) => {")
    lines.append('                failures.push(format!("PANIC: {name} ({file})"));')
    lines.append("                continue;")
    lines.append("            }")
    lines.append("        };")
    lines.append("")
    lines.append("        if expects_errors {")
    lines.append("            if result.errors.is_empty() {")
    lines.append('                failures.push(format!("Expected errors but got none: {name} ({file})"));')
    lines.append("                continue;")
    lines.append("            }")
    lines.append("        } else if !result.errors.is_empty() {")
    lines.append('            failures.push(format!(')
    lines.append('                "Unexpected errors for {name} ({file}): {:?}",')
    lines.append("                result.errors")
    lines.append("            ));")
    lines.append("            continue;")
    lines.append("        }")
    lines.append("")
    lines.append("        insta::assert_yaml_snapshot!(name.to_string(), result.program);")
    lines.append("    }")
    lines.append("")
    lines.append('    if !failures.is_empty() {')
    lines.append('        panic!(')
    lines.append('            "\\n=== nikic test failures ({}/{}) ===\\n{}",')
    lines.append('            failures.len(),')
    lines.append('            NIKIC_TESTS.len(),')
    lines.append('            failures.join("\\n")')
    lines.append("        );")
    lines.append("    }")
    lines.append("}")
    lines.append("")

    OUTPUT_RS.write_text("\n".join(lines), encoding='utf-8')
    print(f"Wrote {OUTPUT_RS}")

    error_count = sum(1 for _, _, e in entries if e)
    ok_count = len(entries) - error_count
    print(f"  {ok_count} fixture tests, {error_count} error tests")


if __name__ == "__main__":
    main()
