use std::io::Write;

#[path = "common.rs"]
mod common;

fn php_version_met(min: (u32, u32)) -> bool {
    match min {
        (8, 1) => cfg!(php_min_81),
        (8, 2) => cfg!(php_min_82),
        (8, 3) => cfg!(php_min_83),
        (8, 4) => cfg!(php_min_84),
        (8, 5) => cfg!(php_min_85),
        _ => false,
    }
}

fn php_lint(code: &str) -> std::process::Output {
    let mut child = std::process::Command::new("php")
        .arg("-l")
        .stdin(std::process::Stdio::piped())
        .stderr(std::process::Stdio::piped())
        .stdout(std::process::Stdio::null())
        .spawn()
        .expect("failed to spawn php");
    child
        .stdin
        .take()
        .unwrap()
        .write_all(code.as_bytes())
        .unwrap();
    child.wait_with_output().unwrap()
}

fn assert_php_syntax_labeled(label: &str, code: &str) {
    let out = php_lint(code);
    if !out.status.success() {
        panic!(
            "php -l failed ({label}):\n{}",
            String::from_utf8_lossy(&out.stderr)
        );
    }
}

/// Recursively collect all `.phpt` files under `dir`.
fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
        } else if path.extension().map_or(false, |ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Validates every `.phpt` fixture file through `php -l` (recursive, including corpus/).
/// Skips error-expected fixtures, version-specific fixtures, and known divergences.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    // Fixtures where the Rust parser is intentionally more lenient than PHP.
    // PHP rejects these at parse time or compile time, but our parser accepts
    // the syntax and defers enforcement to semantic analysis.
    //
    // Categories:
    //   [parse-leniency] — syntax PHP rejects at parse time; we accept for AST completeness
    //   [semantic]        — syntactically valid but PHP rejects at compile time (Fatal error)
    //   [deprecated]      — removed syntax our parser still accepts for compatibility
    let php_rejects: &[&str] = &[
        // [deprecated] Calling with & at call-site was removed in PHP 5.4.
        "arg_by_ref.phpt",
        "arg_by_ref_preserved.phpt",
        "args.phpt", // corpus: &$arg at call-site
        // [parse-leniency] Reserved keywords as function names.
        "keyword_as_function_clone.phpt",
        "keyword_as_function_die.phpt",
        "keyword_as_function_exit.phpt",
        "keyword_as_function_fn.phpt",
        "keyword_as_function_match.phpt",
        "keyword_as_function_readonly.phpt",
        "clone_function.phpt",    // corpus: function clone()
        "exit_die_function.phpt", // corpus: function exit() / die()
        // [semantic] Destructuring edge cases.
        "null_in_destructuring.phpt",
        "destructuring_null_vs_omit.phpt",
        "exprInList.phpt", // corpus: non-writable targets in list()
        // [deprecated] Legacy octal digits (e.g. 0778) — parse error in PHP 8.
        "legacy_octal_invalid_digits.phpt",
        "invalidOctal_1.phpt", // corpus
        "invalidOctal_2.phpt", // corpus
        "float.phpt",          // corpus: contains invalid numeric literal
        // [parse-leniency] Spread after named args.
        "named_args_mixed_with_spread.phpt",
        // [parse-leniency] Mixing [] and list() destructuring.
        "nested_list_destructuring.phpt",
        // [semantic] `new` in initializer positions PHP restricts.
        "new_in_complex_initializers.phpt",
        "new_in_initializers.phpt",
        "newInInitializer.phpt", // corpus
        // [semantic] `self` in intersection return types.
        "return_type_self_intersection.phpt",
        // [parse-leniency] `static;` as statement.
        "static_semicolon_as_stmt.phpt",
        // [semantic] Duplicate default in switch.
        "switch_multiple_defaults.phpt",
        // [parse-leniency] Trailing commas in positions PHP forbids.
        "recovery_18.phpt",
        // [deprecated] Curly brace array/string access — removed in PHP 8.0.
        "alternative_array_syntax_1.phpt",
        "alternative_array_syntax_2.phpt",
        // [deprecated] Assign new by reference ($a =& new Foo) — removed in PHP 7.0.
        "assignNewByRef_1.phpt",
        "assignNewByRef_2.phpt",
        // [semantic] isset() on expression result.
        "exprInIsset.phpt",
        // [semantic] First-class callable with `new`.
        "firstClassCallables.phpt",
        // [semantic] Write context for temporary expressions.
        "misc.phpt", // corpus/expr/uvs/misc.phpt
        // [parse-leniency] (void) cast — not valid in PHP.
        "voidCast.phpt",
        // [semantic] break/continue outside loop.
        "controlFlow.phpt",
        // [semantic] Unicode escape with codepoint too large.
        "unicodeEscape_3.phpt",
        // [semantic] Namespace declaration constraints (nesting, mixing, ordering).
        "alias.phpt",
        "groupUse.phpt",
        "mix_1.phpt",
        "mix_2.phpt",
        "nested.phpt",
        "outsideStmtInvalid_1.phpt",
        "outsideStmtInvalid_2.phpt",
        "outsideStmtInvalid_3.phpt",
        // [semantic] Variadic parameter with default value.
        "variadicDefaultValue.phpt",
        // [semantic] Class member constraints enforced by PHP at compile time.
        "asymmetric_visibility_1.phpt", // must have type
        "asymmetric_visibility_2.phpt", // multiple access modifiers
        "enum_with_string.phpt",        // backed enum case without value
        "propertyTypes.phpt",           // static readonly
        "property_hooks_1.phpt",        // hook parameter type mismatch
        "property_hooks_2.phpt",        // empty hook list
        "property_hooks_3.phpt",        // get hook with parameter list
        "property_modifiers.phpt",      // property redeclaration
        "readonlyMethod.phpt",          // readonly on method
        "staticMethod_1.phpt",          // static __construct
        "staticMethod_2.phpt",          // static __destruct
        "staticMethod_3.phpt",          // static __clone
        "staticMethod_4.phpt",          // static __CONSTRUCT
        "staticMethod_5.phpt",          // static __Destruct
        "staticMethod_6.phpt",          // static __cLoNe
    ];

    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let mut failures: Vec<String> = Vec::new();

    for path in paths {
        let name = path.file_name().and_then(|n| n.to_str()).unwrap_or("");
        if name == "error_recovery.phpt" || php_rejects.contains(&name) {
            continue;
        }

        let label = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let src = std::fs::read_to_string(&path).unwrap();
        let (config, source) = common::parse_fixture(&src);

        if let Some(min_php) = config.min_php {
            if !php_version_met(min_php) {
                continue;
            }
        }
        // Skip version-specific fixtures — they test parser behavior at a particular
        // PHP version and may contain syntax that PHP itself rejects semantically.
        if config.parse_version.is_some() {
            continue;
        }
        if config.expect_errors {
            continue;
        }

        let out = php_lint(source);
        if !out.status.success() {
            failures.push(format!(
                "{label}:\n  {}",
                String::from_utf8_lossy(&out.stderr).trim()
            ));
        }
    }

    if !failures.is_empty() {
        panic!(
            "php -l failed for {} fixture(s):\n\n{}",
            failures.len(),
            failures.join("\n\n")
        );
    }
}
