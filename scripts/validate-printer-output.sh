#!/bin/bash
set -e

FIXTURES_DIR="crates/php-printer/tests/fixtures"
TEMP_DIR=$(mktemp -d)
trap "rm -rf $TEMP_DIR" EXIT

failed=0

# Get installed PHP version
PHP_VERSION=$(php --version | head -1 | grep -oE '[0-9]+\.[0-9]+' | head -1)

for fixture in "$FIXTURES_DIR"/*.phpt; do
    # Check for skip marker in config
    if grep -q "^skip_php_validate=1" "$fixture" 2>/dev/null; then
        echo "⊘ $(basename "$fixture") (skipped per config)"
        continue
    fi

    # Extract min_php from config section if present
    min_php=$(sed -n '/^===config===/,/^===/p' "$fixture" | grep "^min_php=" | head -1 | cut -d= -f2)
    if [ -n "$min_php" ]; then
        # Compare versions: skip if installed version is older
        if [ "$(printf '%s\n' "$min_php" "$PHP_VERSION" | sort -V | head -n1)" = "$min_php" ] && [ "$min_php" != "$PHP_VERSION" ]; then
            echo "⊘ $(basename "$fixture") (requires PHP $min_php, have $PHP_VERSION)"
            continue
        fi
    fi

    # Extract the ===print=== section
    output=$(awk '/^===print===/{flag=1;next}/^===/{flag=0}flag' "$fixture")
    if [ -z "$output" ]; then
        echo "⚠ Warning: empty ===print=== section in $(basename "$fixture"), skipping"
        continue
    fi

    # Create temp file; the print section already includes <?php
    temp_file="$TEMP_DIR/$(basename "$fixture" .phpt).php"
    echo "$output" > "$temp_file"

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
