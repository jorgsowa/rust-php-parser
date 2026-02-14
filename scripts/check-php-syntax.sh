#!/usr/bin/env bash
# Validate that inline PHP code in integration tests is syntactically valid.
# Also validates nikic fixture .php files (excluding errorHandling/ directories).
# Skips tests that intentionally use invalid PHP (assert_has_errors or error-recovery tests).
set -euo pipefail

# Check inline PHP in integration.rs
python3 - <<'PYTHON'
import re, subprocess, sys

with open("crates/php-parser/tests/integration.rs") as f:
    content = f.read()

# Tests that intentionally use invalid PHP (assert_has_errors or error-recovery tests)
ERROR_TESTS = set()
lines = content.split('\n')
for i, line in enumerate(lines):
    if 'assert_has_errors' in line or 'errors.is_empty()' in line:
        for j in range(i, max(i - 10, -1), -1):
            m = re.search(r'fn (test_\w+)', lines[j])
            if m:
                ERROR_TESTS.add(m.group(1))
                break
    m = re.search(r'fn (test_\w*(?:error|invalid)\w*)\b', line, re.IGNORECASE)
    if m:
        ERROR_TESTS.add(m.group(1))

test_pattern = re.compile(r'fn (test_\w+)\(\)')
php_pattern = re.compile(r'parse_php\("((?:[^"\\]|\\.)*)"\)')

failed = 0
checked = 0
current_test = None

for i, line in enumerate(lines):
    m = test_pattern.search(line)
    if m:
        current_test = m.group(1)

    m = php_pattern.search(line)
    if m and current_test not in ERROR_TESTS:
        php = m.group(1).replace(r'\n', '\n').replace(r'\t', '\t').replace(r'\"', '"').replace('\\\\', '\\')
        checked += 1
        result = subprocess.run(['php', '-l'], input=php, capture_output=True, text=True)
        if result.returncode != 0:
            err = result.stderr.strip().split('\n')[0] if result.stderr else ''
            print(f"FAIL L{i+1} ({current_test}): {php[:80]}")
            print(f"      {err}")
            failed += 1

print(f"Checked {checked} inline snippets, {failed} failed")
sys.exit(1 if failed else 0)
PYTHON

echo ""

# Check nikic fixture .php files (informational — many fixtures intentionally test
# invalid PHP across versions, so failures here don't block CI)
# Excludes:
#   - errorHandling/ directories (error recovery tests)
#   - Files with Error/Invalid/Deprecated in the name (intentionally invalid PHP)
FIXTURE_DIR="crates/php-parser/tests/fixtures/nikic"
if [ ! -d "$FIXTURE_DIR" ]; then
    echo "Fixture directory $FIXTURE_DIR not found, skipping"
    exit 0
fi

fixture_failed=0
fixture_checked=0
skipped=0

while IFS= read -r file; do
    basename=$(basename "$file" .php)
    # Skip files whose names indicate intentionally invalid PHP
    if echo "$basename" | grep -iqE '(error|invalid|deprecated)'; then
        skipped=$((skipped + 1))
        continue
    fi
    fixture_checked=$((fixture_checked + 1))
    if ! output=$(php -l "$file" 2>&1); then
        err=$(echo "$output" | head -1)
        echo "WARN: $file"
        echo "      $err"
        fixture_failed=$((fixture_failed + 1))
    fi
done < <(find "$FIXTURE_DIR" -name '*.php' -not -path '*/errorHandling/*' | sort)

echo "Checked $fixture_checked fixture files ($skipped skipped), $fixture_failed had issues"
# Note: fixture failures are informational only — many nikic fixtures intentionally
# test invalid PHP (cross-version syntax, semantic errors, deprecated features)
