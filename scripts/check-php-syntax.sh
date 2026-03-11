#!/usr/bin/env bash
# Validates nikic fixture .php files (excluding errorHandling/ directories).
set -euo pipefail

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
