#!/usr/bin/env python3
"""Fail when the parser reports errors on a php-src test file that `php -l` accepts.

Usage: corpus-diff.py <corpus_diagnostics binary> <php-src dir>
Known mismatches are ignored fixtures in crates/php-parser/tests/fixtures/ignored/, named after the php-src path.
"""
import os
import re
import subprocess
import sys
import tempfile
from concurrent.futures import ThreadPoolExecutor

IGNORED = os.path.join(
    os.path.dirname(os.path.abspath(__file__)), "..", "crates/php-parser/tests/fixtures/ignored"
)
FILE_SECTION = re.compile(rb"--FILE--\r?\n(.*?)\r?\n--[A-Z_]+--", re.S)


def extract(php_src, out_dir):
    """Write each test's --FILE-- section to out_dir; return {extracted path: php-src relative path}."""
    mapping = {}
    for root, _, files in os.walk(php_src):
        for name in files:
            if not name.endswith(".phpt"):
                continue
            path = os.path.join(root, name)
            with open(path, "rb") as f:
                match = FILE_SECTION.search(f.read())
            if not match:
                continue
            target = os.path.join(out_dir, f"{len(mapping)}.php")
            with open(target, "wb") as f:
                f.write(match.group(1))
            mapping[target] = os.path.relpath(path, php_src)
    return mapping


def php_accepts(path):
    return subprocess.run(["php", "-l", path], capture_output=True).returncode == 0


def main():
    if len(sys.argv) != 3:
        sys.exit(__doc__)
    binary, php_src = sys.argv[1:]

    with tempfile.TemporaryDirectory() as tmp:
        mapping = extract(php_src, tmp)
        out = subprocess.run(
            [binary], input="\n".join(mapping), capture_output=True, text=True, check=True
        ).stdout
        flagged = dict(line.split("\t", 1) for line in out.splitlines())
        with ThreadPoolExecutor(os.cpu_count() or 4) as pool:
            verdicts = list(pool.map(php_accepts, flagged))

    tracked = (
        {name[: -len(".phpt")] for name in os.listdir(IGNORED)}
        if os.path.isdir(IGNORED)
        else set()
    )
    accepted = {
        mapping[path]: messages
        for (path, messages), ok in zip(flagged.items(), verdicts)
        if ok
    }
    new = {
        path: messages
        for path, messages in accepted.items()
        if path[: -len(".phpt")].replace("/", "__") not in tracked
    }
    print(
        f"{len(mapping)} files, {len(flagged)} with parser errors, "
        f"{len(accepted)} accepted by php -l, {len(new)} not yet tracked as ignored fixtures"
    )
    for path in sorted(new):
        print(f"NEW: {path}\n    {new[path][:300]}")
    if new:
        sys.exit(1)


main()
