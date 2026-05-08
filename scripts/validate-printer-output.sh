#!/bin/bash
set -e

FIXTURES_DIR="crates/php-printer/tests/fixtures"
TEMP_DIR=$(mktemp -d)
trap "rm -rf $TEMP_DIR" EXIT

failed=0

for fixture in "$FIXTURES_DIR"/*.phpt; do
    # Extract the ===print=== section
    if ! output=$(sed -n '/^===print===/,/^$/p' "$fixture" | tail -n +2 | sed '$ d'); then
        echo "⚠ Warning: no ===print=== section in $(basename "$fixture"), skipping"
        continue
    fi

    # Create temp file with <?php prefix
    temp_file="$TEMP_DIR/$(basename "$fixture" .phpt).php"
    echo "<?php" > "$temp_file"
    echo "$output" >> "$temp_file"

    # Run php -l
    if ! php -l "$temp_file" > /dev/null 2>&1; then
        echo "✗ FAIL: $(basename "$fixture")"
        php -l "$temp_file" || true
        ((failed++))
    else
        echo "✓ $(basename "$fixture")"
    fi
done

if [ $failed -gt 0 ]; then
    echo ""
    echo "❌ $failed fixture(s) failed PHP syntax validation"
    exit 1
else
    echo ""
    echo "✅ All printer fixtures pass PHP syntax validation"
fi
