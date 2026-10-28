#!/bin/bash
set -e

FIXTURES_DIR="crates/php-printer/tests/fixtures"
TEMP_DIR=$(mktemp -d)
trap 'rm -rf "$TEMP_DIR"' EXIT

failed=0

# Get installed PHP version
PHP_VERSION=$(php --version | head -1 | grep -oE '[0-9]+\.[0-9]+' | head -1)

while IFS= read -r fixture; do
    name="${fixture#"$FIXTURES_DIR"/}"
    config=$(sed -n '/^===config===/,/^===source===/p' "$fixture")

    # Extract min_php from config section if present
    min_php=$(echo "$config" | grep "^min_php=" | head -1 | cut -d= -f2)
    if [ -n "$min_php" ]; then
        # Compare versions: skip if installed version is older than min_php
        if [ "$(printf '%s\n' "$min_php" "$PHP_VERSION" | sort -V | head -n1)" = "$PHP_VERSION" ] && [ "$min_php" != "$PHP_VERSION" ]; then
            echo "⊘ $name (requires PHP $min_php, have $PHP_VERSION)"
            continue
        fi
    fi
    php_error=$(echo "$config" | grep "^php_error=" | head -1 | cut -d= -f2-)

    # Perl keeps NUL bytes that awk and command substitution drop
    temp_file="$TEMP_DIR/$(basename "$fixture" .phpt).php"
    perl -0777 -ne 'print $1 if /^===print===\n(.*?)\n?(?=^===|\z)/ms' "$fixture" > "$temp_file"
    if [ ! -s "$temp_file" ]; then
        echo "⚠ Warning: empty ===print=== section in $name, skipping"
        continue
    fi

    if output=$(php -l "$temp_file" 2>&1); then
        if [ -n "$php_error" ]; then
            echo "✗ FAIL (PHP $PHP_VERSION): $name passes php -l, expected: $php_error"
            failed=$((failed + 1))
        else
            echo "✓ $name"
        fi
    elif [ -n "$php_error" ] && echo "$output" | grep -qF "PHP Fatal error:  $php_error in "; then
        echo "✓ $name (fails with the expected error)"
    elif [[ "$name" == syntax_errors/* ]] && echo "$output" | grep -qF "PHP Parse error:  "; then
        echo "✓ $name (fails with a parse error)"
    else
        echo "✗ FAIL (PHP $PHP_VERSION): $name"
        echo "$output"
        failed=$((failed + 1))
    fi
done < <(find "$FIXTURES_DIR" -name '*.phpt' | sort)

if [ $failed -gt 0 ]; then
    echo ""
    echo "❌ $failed fixture(s) failed PHP syntax validation"
    exit 1
else
    echo ""
    echo "✅ All printer fixtures pass PHP syntax validation"
fi
