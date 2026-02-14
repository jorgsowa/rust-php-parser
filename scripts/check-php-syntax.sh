#!/usr/bin/env bash
# Validate that inline PHP code in integration tests is syntactically valid.
# Also validates nikic fixture .php files (excluding known-invalid fixtures).
# Skips tests that intentionally use invalid PHP.
set -euo pipefail

# Check inline PHP in integration.rs
python3 - <<'PYTHON'
import re, subprocess, sys

with open("crates/php-parser/tests/integration.rs") as f:
    content = f.read()

# Tests that intentionally use invalid PHP (assert_has_errors, errors.is_empty(), or error/invalid-named tests)
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

# Check nikic fixture .php files
# Excludes:
#   - errorHandling/ directories (error recovery tests)
#   - Files with Error/Invalid/Deprecated in the name (intentionally invalid PHP)
#   - Files listed in the known-invalid exclude list below
FIXTURE_DIR="crates/php-parser/tests/fixtures/nikic"
if [ ! -d "$FIXTURE_DIR" ]; then
    echo "Fixture directory $FIXTURE_DIR not found, skipping"
    exit 0
fi

# Fixtures that intentionally contain invalid PHP (semantic errors, cross-version
# syntax, deprecated features, etc.). These are test cases for the parser's ability
# to handle various PHP constructs, not necessarily valid PHP for any single version.
KNOWN_INVALID=(
    # Expressions testing removed/invalid syntax
    "expr/alternative_array_syntax_1.php"
    "expr/alternative_array_syntax_2.php"
    "expr/arrayEmptyElemens.php"
    "expr/assignNewByRef_1.php"
    "expr/assignNewByRef_2.php"
    "expr/cast.php"
    "expr/exprInIsset.php"
    "expr/exprInList.php"
    "expr/fetchAndCall/args.php"
    "expr/firstClassCallables.php"
    "expr/newWithoutClass.php"
    "expr/ternaryAndCoalesce.php"
    "expr/uvs/misc.php"
    # Scalars with intentionally invalid literals
    "scalar/float.php"
    "scalar/numberSeparators.php"
    "scalar/unicodeEscape_3.php"
    # Class-related semantic errors
    "stmt/class/asymmetric_visibility_1.php"
    "stmt/class/asymmetric_visibility_2.php"
    "stmt/class/enum_with_string.php"
    "stmt/class/enum.php"
    "stmt/class/name_1.php"
    "stmt/class/name_2.php"
    "stmt/class/name_3.php"
    "stmt/class/name_4.php"
    "stmt/class/name_5.php"
    "stmt/class/name_6.php"
    "stmt/class/name_7.php"
    "stmt/class/name_8.php"
    "stmt/class/name_9.php"
    "stmt/class/name_10.php"
    "stmt/class/name_11.php"
    "stmt/class/name_12.php"
    "stmt/class/name_13.php"
    "stmt/class/name_14.php"
    "stmt/class/name_15.php"
    "stmt/class/php4Style.php"
    "stmt/class/property_hooks_1.php"
    "stmt/class/property_hooks_2.php"
    "stmt/class/property_hooks_3.php"
    "stmt/class/property_hooks_4.php"
    "stmt/class/property_hooks_5.php"
    "stmt/class/property_hooks_6.php"
    "stmt/class/property_hooks_7.php"
    "stmt/class/property_modifiers.php"
    "stmt/class/propertyTypes.php"
    "stmt/class/readonlyAsClassName_1.php"
    "stmt/class/readonlyAsClassName_2.php"
    "stmt/class/readonlyMethod.php"
    "stmt/class/shortEchoAsIdentifier.php"
    "stmt/class/staticMethod_1.php"
    "stmt/class/staticMethod_2.php"
    "stmt/class/staticMethod_3.php"
    "stmt/class/staticMethod_4.php"
    "stmt/class/staticMethod_5.php"
    "stmt/class/staticMethod_6.php"
    # Statement semantic errors
    "stmt/const.php"
    "stmt/controlFlow.php"
    "stmt/haltCompilerOutermostScope.php"
    "stmt/newInInitializer.php"
    "stmt/tryWithoutCatch.php"
    "stmt/voidCast.php"
    # Function semantic errors
    "stmt/function/byRef.php"
    "stmt/function/clone_function.php"
    "stmt/function/exit_die_function.php"
    "stmt/function/nullFalseTrueTypes_1.php"
    "stmt/function/nullFalseTrueTypes_2.php"
    "stmt/function/variadic.php"
    "stmt/function/variadicDefaultValue.php"
    # Namespace semantic errors
    "stmt/namespace/alias.php"
    "stmt/namespace/groupUse.php"
    "stmt/namespace/mix_1.php"
    "stmt/namespace/mix_2.php"
    "stmt/namespace/nested.php"
)

# Join exclude list into a newline-separated string for matching
EXCLUDE_LIST=$(printf '%s\n' "${KNOWN_INVALID[@]}")

failed=0
checked=0
skipped=0

while IFS= read -r file; do
    rel_path="${file#"$FIXTURE_DIR"/}"
    bname=$(basename "$file" .php)

    # Skip files in the exclude list, or with error/invalid/deprecated in name
    if echo "$EXCLUDE_LIST" | grep -qxF "$rel_path"; then
        skipped=$((skipped + 1))
        continue
    fi
    if echo "$bname" | grep -iqE '(error|invalid|deprecated)'; then
        skipped=$((skipped + 1))
        continue
    fi

    checked=$((checked + 1))
    if ! output=$(php -l "$file" 2>&1); then
        err=$(echo "$output" | head -1)
        echo "FAIL: $file"
        echo "      $err"
        failed=$((failed + 1))
    fi
done < <(find "$FIXTURE_DIR" -name '*.php' -not -path '*/errorHandling/*' | sort)

echo "Checked $checked fixture files ($skipped skipped), $failed failed"
if [ "$failed" -gt 0 ]; then
    exit 1
fi
