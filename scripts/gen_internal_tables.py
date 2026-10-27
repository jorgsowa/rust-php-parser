#!/usr/bin/env python3
"""Regenerate the parser's tables of internal functions and constants from PHP binaries.

Usage: scripts/gen_internal_tables.py [VERSION=PHP_BINARY ...]

Every version in VERSIONS needs a binary; by default the Homebrew `php@VERSION` ones are used.
To support a new PHP version, add it to VERSIONS and rerun.
"""

import json
import re
import subprocess
import sys
import tempfile
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
EXPR_DIR = ROOT / "crates" / "php-parser" / "src" / "expr"

VERSIONS = ["7.4", "8.0", "8.1", "8.2", "8.3", "8.4", "8.5", "8.6"]

# The extensions every PHP build has.
CORE_EXTENSIONS = ["Core", "standard", "date", "pcre", "json", "SPL", "hash", "random"]

# Constants missing on some platforms or C libraries: nl_langinfo() items, locale categories,
# syslog, fnmatch, glob and socket options.
PLATFORM_CONSTANT = re.compile(
    r"^(ABDAY_\d|ABMON_\d+|DAY_\d|MON_\d+|ALT_DIGITS|AM_STR|PM_STR|CHAR_MAX|CODESET|CRNCYSTR"
    r"|D_FMT|D_T_FMT|T_FMT|T_FMT_AMPM|ERA|ERA_D_FMT|ERA_D_T_FMT|ERA_T_FMT|NOEXPR|NOSTR|YESEXPR"
    r"|YESSTR|RADIXCHAR|THOUSEP|LC_\w+|LOG_\w+|FNM_\w+|GLOB_\w+|STREAM_IPPROTO_\w+|STREAM_OOB"
    r"|STREAM_PEEK|STREAM_PF_\w+|STREAM_SOCK_\w+)$"
)

# Folded by the parser itself.
KEYWORD_CONSTANTS = {"TRUE", "FALSE", "NULL"}

# Common extensions that are not bundled with PHP but define global constants.
EXTRA_CONSTANT_WORDS = {"XDEBUG"}

CONST_TYPES = {"integer": "Int", "double": "Float", "string": "Str", "boolean": "Bool"}

PROBE = r"""<?php
$exts = json_decode($argv[2]);
$functions = [];
foreach ($exts as $e) {
    foreach (get_extension_funcs($e) ?: [] as $f) {
        $refs = '';
        foreach ((new ReflectionFunction($f))->getParameters() as $p) {
            $refs .= $p->isPassedByReference() ? ($p->isVariadic() ? 'R' : 'r') : 'v';
        }
        $functions[strtolower($f)] = rtrim($refs, 'v');
    }
}
$all = get_defined_constants(true);
$constants = [];
foreach ($exts as $e) {
    foreach ($all[$e] ?? [] as $n => $v) {
        $constants[$n] = gettype($v);
    }
}
$names = [];
foreach ($all as $e => $cs) {
    if ($e !== 'user') {
        $names = array_merge($names, array_keys($cs));
    }
}
file_put_contents($argv[1], "<?php\n" . implode('', array_map(function ($n) {
    return "echo \\$n;\n";
}, array_keys($constants))));
echo json_encode([
    'functions' => $functions,
    'constants' => $constants,
    'names' => $names,
    'opcache' => extension_loaded('Zend OPcache'),
]);
"""


def rust_version(version):
    return "PhpVersion::Php" + version.replace(".", "")


def probe(php, workdir, version):
    probe_file = workdir / "probe.php"
    probe_file.write_text(PROBE)
    echo_file = workdir / f"echo{version}.php"
    out = subprocess.run(
        [php, "-n", probe_file, echo_file, json.dumps(CORE_EXTENSIONS)],
        check=True, capture_output=True, text=True,
    ).stdout
    data = json.loads(out)
    # The opcodes before optimization show which constants the compiler substitutes.
    opcache = [] if data["opcache"] else ["-d", "zend_extension=opcache"]
    dump = subprocess.run(
        # OPcache skips a file written in the last seconds unless file_update_protection is off.
        [php, "-n", *opcache, "-d", "opcache.enable_cli=1", "-d", "opcache.file_update_protection=0",
         "-d", "opcache.optimization_level=0", "-d", "opcache.opt_debug_level=0x10000", echo_file],
        check=True, capture_output=True, text=True,
    )
    echoes = [line.split(" ECHO ", 1)[1] for line in (dump.stdout + dump.stderr).splitlines()
              if " ECHO " in line]
    names = list(data["constants"])
    if len(echoes) != len(names):
        sys.exit(f"PHP {version}: expected {len(names)} opcodes in the OPcache dump, got {len(echoes)}")
    data["substituted"] = {n for n, e in zip(names, echoes) if not re.match(r"T\d+", e)}
    return data


def functions_table(data):
    rows = {}
    for version in VERSIONS:
        for name, refs in data[version]["functions"].items():
            # A by-reference parameter before a variadic one is the same as the variadic alone.
            refs = re.sub(r"r+R$", "R", refs)
            row = rows.setdefault(name, [version, version, refs])
            if row[2] != refs:
                sys.exit(f"{name} takes different parameters by reference across versions")
            row[1] = version
    return sorted(rows.items())


def constants_tables(data):
    php8 = VERSIONS[VERSIONS.index("8.0"):]
    words = {n.split("_")[0] for v in VERSIONS for n in data[v]["names"] if "\\" not in n}
    words |= EXTRA_CONSTANT_WORDS
    names = {n for v in php8 for n in data[v]["constants"]}
    types, deprecated = [], []
    for name in sorted(names):
        if name in KEYWORD_CONSTANTS or PLATFORM_CONSTANT.match(name):
            continue
        defined = [v for v in php8 if name in data[v]["constants"]]
        kinds = {CONST_TYPES.get(data[v]["constants"][name]) for v in defined}
        if len(kinds) != 1 or None in kinds:
            continue
        kind = kinds.pop()
        substituted = [v for v in php8 if name in data[v]["substituted"]]
        if substituted == php8:
            types.append((name, kind))
        elif substituted and substituted == php8[: len(substituted)]:
            deprecated.append((name, kind, substituted[-1]))
    return sorted(words), types, deprecated


def write_functions(rows):
    entries = "".join(
        f'    ("{n}", {rust_version(a)}, {rust_version(b)}, "{r}"),\n' for n, (a, b, r) in rows
    )
    (EXPR_DIR / "internal_functions.rs").write_text(f"""\
// Generated by scripts/gen_internal_tables.py; do not edit.

use crate::version::PhpVersion;

/// Functions of the extensions every PHP build has, sorted: the first and last version that
/// defines each, and the parameters it takes by reference, as `v` (value) or `r` (reference)
/// up to the last reference, with `R` for a variadic one.
const INTERNAL_FUNCTIONS: &[(&str, PhpVersion, PhpVersion, &str)] = &[
{entries}];

/// The by-reference flag and variadic flag of each parameter of the internal function `lower`,
/// up to the last one taken by reference, if `version` defines it.
pub(crate) fn internal_function_params(
    lower: &str,
    version: PhpVersion,
) -> Option<Vec<(bool, bool)>> {{
    let index = INTERNAL_FUNCTIONS
        .binary_search_by(|(name, ..)| (*name).cmp(lower))
        .ok()?;
    let (_, since, until, refs) = INTERNAL_FUNCTIONS[index];
    if version < since || version > until {{
        return None;
    }}
    Some(refs.bytes().map(|c| (c != b'v', c == b'R')).collect())
}}
""")


def write_constants(words, types, deprecated):
    word_entries = "".join(f'    "{w}",\n' for w in words)
    type_entries = "".join(f'    ("{n}", ConstType::{t}),\n' for n, t in types)
    deprecated_entries = "".join(
        f'    ("{n}", ConstType::{t}, {rust_version(v)}),\n' for n, t, v in deprecated
    )
    (EXPR_DIR / "internal_constants.rs").write_text(f"""\
// Generated by scripts/gen_internal_tables.py; do not edit.

use crate::version::PhpVersion;

/// The word before the first `_` of each constant PHP and bundled extensions define, sorted.
pub(super) const INTERNAL_CONSTANT_WORDS: &[&str] = &[
{word_entries}];

#[derive(Clone, Copy)]
pub(super) enum ConstType {{
    Int,
    Float,
    Str,
    Bool,
}}

/// Constants of the extensions every build has that PHP 8 substitutes on every platform, with
/// the type of their value, sorted.
pub(super) const INTERNAL_CONSTANT_TYPES: &[(&str, ConstType)] = &[
{type_entries}];

/// Constants PHP 8 substitutes until they are deprecated: the type of their value and the last
/// version that substitutes each, sorted.
pub(super) const DEPRECATED_CONSTANT_TYPES: &[(&str, ConstType, PhpVersion)] = &[
{deprecated_entries}];
""")


def main():
    binaries = {v: f"/opt/homebrew/opt/php@{v}/bin/php" for v in VERSIONS}
    for arg in sys.argv[1:]:
        version, _, php = arg.partition("=")
        if version not in binaries or not php:
            sys.exit(__doc__)
        binaries[version] = php
    with tempfile.TemporaryDirectory() as tmp:
        data = {v: probe(binaries[v], Path(tmp), v) for v in VERSIONS}
    write_functions(functions_table(data))
    write_constants(*constants_tables(data))
    subprocess.run(
        ["rustfmt", "--edition", "2021",
         EXPR_DIR / "internal_functions.rs", EXPR_DIR / "internal_constants.rs"],
        check=True,
    )


if __name__ == "__main__":
    main()
