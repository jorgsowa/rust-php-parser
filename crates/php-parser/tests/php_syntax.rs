use std::io::Write;

#[path = "inline_cases.rs"]
mod inline_cases;

fn assert_php_syntax_labeled(label: &str, code: &str) {
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
    let out = child.wait_with_output().unwrap();
    if !out.status.success() {
        panic!(
            "php -l failed ({label}):\n{}",
            String::from_utf8_lossy(&out.stderr)
        );
    }
}

fn assert_php_syntax(code: &str) {
    assert_php_syntax_labeled("(unlabeled)", code);
}

/// Validates every entry in `inline_cases::CASES` through `php -l`.
/// Entries whose `min_php` / `max_php` bounds the installed PHP cannot satisfy are skipped.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn inline_cases_are_valid_php() {
    const MIN_81: bool = cfg!(php_min_81);
    const MIN_82: bool = cfg!(php_min_82);
    const MIN_83: bool = cfg!(php_min_83);
    const MIN_84: bool = cfg!(php_min_84);
    const MIN_85: bool = cfg!(php_min_85);

    for case in inline_cases::CASES {
        let min_ok = match case.min_php {
            inline_cases::MinPhp::Any => true,
            inline_cases::MinPhp::Php81 => MIN_81,
            inline_cases::MinPhp::Php82 => MIN_82,
            inline_cases::MinPhp::Php83 => MIN_83,
            inline_cases::MinPhp::Php84 => MIN_84,
            inline_cases::MinPhp::Php85 => MIN_85,
        };
        let max_ok = match case.max_php {
            inline_cases::MaxPhp::Any => true,
            inline_cases::MaxPhp::Php84 => !MIN_85,
            inline_cases::MaxPhp::Php83 => !MIN_84,
            inline_cases::MaxPhp::Php82 => !MIN_83,
        };
        if min_ok && max_ok {
            assert_php_syntax_labeled(case.label, case.source);
        }
    }
}

/// Validates every `.php` fixture file through `php -l`.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut entries: Vec<_> = std::fs::read_dir(&dir)
        .unwrap()
        .filter_map(|e| e.ok())
        .filter(|e| {
            let p = e.path();
            // error_recovery.php is intentionally invalid PHP
            p.extension().and_then(|x| x.to_str()) == Some("php")
                && p.file_name().and_then(|n| n.to_str()) != Some("error_recovery.php")
        })
        .collect();
    // Sort for deterministic output
    entries.sort_by_key(|e| e.path());
    for entry in entries {
        let path = entry.path();
        let label = path.file_name().unwrap().to_str().unwrap();
        let src = std::fs::read_to_string(&path).unwrap();
        assert_php_syntax_labeled(label, &src);
    }
}

/// Collects all `.php` files under `dir` recursively.
/// Returns `(relative_path, full_path)` pairs where `relative_path` uses forward slashes.
fn collect_php_files(
    base: &std::path::Path,
    dir: &std::path::Path,
    out: &mut Vec<(String, std::path::PathBuf)>,
) {
    let entries = match std::fs::read_dir(dir) {
        Ok(e) => e,
        Err(_) => return,
    };
    for entry in entries.filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            collect_php_files(base, &path, out);
        } else if path.extension().and_then(|x| x.to_str()) == Some("php") {
            let rel = path
                .strip_prefix(base)
                .unwrap()
                .to_str()
                .unwrap()
                .replace('\\', "/");
            out.push((rel, path));
        }
    }
}

/// Validates every nikic fixture file that represents valid PHP through `php -l`.
///
/// The nikic corpus is a parser test suite: many files intentionally contain
/// PHP that is syntactically or semantically invalid (to test error recovery,
/// deprecated constructs, removed syntax, or semantic rules PHP enforces at
/// compile time). Those files are listed in `INVALID` below.
///
/// Files that use features introduced after PHP 8.2 (the minimum CI version)
/// are version-gated via the `PHP_83` / `PHP_84` lists.
#[cfg_attr(not(php_available), ignore)]
#[test]
fn nikic_fixture_files_are_valid_php() {
    // Files that fail `php -l`: either tagged `errors` in nikic_integration_tests.rs,
    // or contain semantically invalid PHP that PHP's linter rejects (redeclared
    // functions, break outside loop, removed syntax, etc.).
    const INVALID: &[&str] = &[
        // errorHandling — all are error/recovery tests
        "errorHandling/eofError_1.php",
        "errorHandling/eofError_2.php",
        "errorHandling/lexerErrors_1.php",
        "errorHandling/lexerErrors_5.php",
        "errorHandling/recovery_1.php",
        "errorHandling/recovery_2.php",
        "errorHandling/recovery_3.php",
        "errorHandling/recovery_4.php",
        "errorHandling/recovery_5.php",
        "errorHandling/recovery_6.php",
        "errorHandling/recovery_7.php",
        "errorHandling/recovery_8.php",
        "errorHandling/recovery_9.php",
        "errorHandling/recovery_10.php",
        "errorHandling/recovery_11.php",
        "errorHandling/recovery_12.php",
        "errorHandling/recovery_13.php",
        "errorHandling/recovery_14.php",
        "errorHandling/recovery_15.php",
        "errorHandling/recovery_16.php",
        "errorHandling/recovery_17.php",
        "errorHandling/recovery_18.php",
        "errorHandling/recovery_19.php",
        "errorHandling/recovery_20.php",
        "errorHandling/recovery_21.php",
        "errorHandling/recovery_22.php",
        "errorHandling/recovery_23.php",
        "errorHandling/recovery_24.php",
        "errorHandling/recovery_25.php",
        "errorHandling/recovery_26.php",
        // expr — removed syntax or semantically invalid constructs
        "expr/alternative_array_syntax_1.php", // $a{'b'} removed in PHP 8.0
        "expr/alternative_array_syntax_2.php", // $a{'b'} removed in PHP 8.0
        "expr/arrayEmptyElemens.php",
        "expr/assignNewByRef_1.php", // =& new removed in PHP 7.4
        "expr/assignNewByRef_2.php", // =& new removed in PHP 7.4
        "expr/cast.php",
        "expr/exprInIsset.php",           // isset() on expression result is invalid
        "expr/exprInList.php",            // list() as value context
        "expr/fetchAndCall/args.php",     // pass-by-ref in call removed in PHP 8.0
        "expr/firstClassCallables.php",   // new Foo(...) is not a valid callable
        "expr/newWithoutClass.php",
        "expr/ternaryAndCoalesce.php",    // unparenthesized nested ternary removed PHP 8.0
        "expr/uvs/globalNonSimpleVarError.php",
        "expr/uvs/misc.php",              // temporary expression in write context
        // scalar — invalid literals
        "scalar/float.php",              // invalid numeric literal
        "scalar/invalidOctal_1.php",
        "scalar/invalidOctal_2.php",
        "scalar/numberSeparators.php",
        "scalar/unicodeEscape_3.php",    // codepoint > 0x10FFFF
        // stmt/class — modifier errors, invalid names, semantic violations
        "stmt/class/asymmetric_visibility_1.php", // property with asym visibility must have type
        "stmt/class/asymmetric_visibility_2.php",
        "stmt/class/constModifierErrors_1.php",
        "stmt/class/constModifierErrors_2.php",
        "stmt/class/constModifierErrors_3.php",
        "stmt/class/constModifierErrors_4.php",
        "stmt/class/enum.php",
        "stmt/class/enum_with_string.php",        // backed enum case missing value
        "stmt/class/modifier_error_1.php",
        "stmt/class/modifier_error_2.php",
        "stmt/class/modifier_error_3.php",
        "stmt/class/modifier_error_4.php",
        "stmt/class/modifier_error_5.php",
        "stmt/class/modifier_error_6.php",
        "stmt/class/modifier_error_7.php",
        "stmt/class/modifier_error_8.php",
        "stmt/class/name_1.php",
        "stmt/class/name_2.php",
        "stmt/class/name_3.php",
        "stmt/class/name_4.php",
        "stmt/class/name_5.php",
        "stmt/class/name_6.php",
        "stmt/class/name_7.php",
        "stmt/class/name_8.php",
        "stmt/class/name_9.php",
        "stmt/class/name_10.php",
        "stmt/class/name_11.php",
        "stmt/class/name_12.php",
        "stmt/class/name_13.php",
        "stmt/class/name_14.php",
        "stmt/class/name_15.php",
        "stmt/class/php4Style.php",               // abstract method in non-abstract class
        "stmt/class/property_hooks_1.php",         // set param type incompatible with property type
        "stmt/class/property_hooks_2.php",
        "stmt/class/property_hooks_3.php",
        "stmt/class/property_hooks_4.php",
        "stmt/class/property_hooks_5.php",
        "stmt/class/property_hooks_6.php",
        "stmt/class/property_hooks_7.php",
        "stmt/class/property_modifiers.php",      // abstract property in non-abstract class
        "stmt/class/propertyTypes.php",            // static readonly property invalid
        "stmt/class/readonlyAsClassName_1.php",
        "stmt/class/readonlyAsClassName_2.php",
        "stmt/class/readonlyMethod.php",           // readonly on method invalid
        "stmt/class/shortEchoAsIdentifier.php",
        "stmt/class/staticMethod_1.php",           // static __construct invalid
        "stmt/class/staticMethod_2.php",
        "stmt/class/staticMethod_3.php",
        "stmt/class/staticMethod_4.php",
        "stmt/class/staticMethod_5.php",
        "stmt/class/staticMethod_6.php",
        // stmt
        "stmt/const.php",
        "stmt/controlFlow.php",                    // break/continue outside loop
        "stmt/haltCompilerInvalidSyntax.php",
        "stmt/haltCompilerOutermostScope.php",
        "stmt/newInInitializer.php",               // new in some contexts not always valid
        "stmt/tryWithoutCatch.php",
        "stmt/voidCast.php",                       // (void) cast removed in PHP 8.0
        // stmt/function — redeclared functions / removed features
        "stmt/function/byRef.php",
        "stmt/function/clone_function.php",
        "stmt/function/exit_die_function.php",
        "stmt/function/nullFalseTrueTypes_1.php",
        "stmt/function/nullFalseTrueTypes_2.php",
        "stmt/function/variadic.php",
        "stmt/function/variadicDefaultValue.php",
        // stmt/namespace — semantic import errors / invalid structure
        "stmt/namespace/alias.php",
        "stmt/namespace/groupUse.php",
        "stmt/namespace/groupUseErrors_1.php",
        "stmt/namespace/groupUseErrors_2.php",
        "stmt/namespace/groupUseErrors_3.php",
        "stmt/namespace/invalidName_1.php",
        "stmt/namespace/invalidName_2.php",
        "stmt/namespace/invalidName_3.php",
        "stmt/namespace/mix_1.php",               // cannot mix bracketed/unbracketed namespaces
        "stmt/namespace/mix_2.php",
        "stmt/namespace/nested.php",               // nested namespace declarations invalid
        "stmt/namespace/outsideStmtInvalid_1.php",
        "stmt/namespace/outsideStmtInvalid_2.php",
        "stmt/namespace/outsideStmtInvalid_3.php",
    ];

    // Files using PHP 8.3+ features — skip when installed PHP is older.
    const PHP_83: &[&str] = &[
        "expr/dynamicClassConst.php",
        "stmt/class/typedConstants.php",
    ];

    // Files using PHP 8.4+ features — skip when installed PHP is older.
    const PHP_84: &[&str] = &["expr/newDeref.php"];

    let invalid: std::collections::HashSet<&str> = INVALID.iter().copied().collect();

    let nikic_dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures/nikic");
    let mut files = Vec::new();
    collect_php_files(&nikic_dir, &nikic_dir, &mut files);
    files.sort_by(|a, b| a.0.cmp(&b.0));

    for (rel, path) in &files {
        if invalid.contains(rel.as_str()) {
            continue;
        }
        if PHP_83.contains(&rel.as_str()) && !cfg!(php_min_83) {
            continue;
        }
        if PHP_84.contains(&rel.as_str()) && !cfg!(php_min_84) {
            continue;
        }
        let src = std::fs::read_to_string(path).unwrap();
        assert_php_syntax_labeled(rel, &src);
    }
}

// PHP 8.3+
#[cfg_attr(not(php_min_83), ignore)]
#[test]
fn typed_class_constants() {
    assert_php_syntax("<?php class A { const int X = 1; private const string Y = 'a'; const Foo|Bar|null Z = null; }");
}

#[cfg_attr(not(php_min_83), ignore)]
#[test]
fn new_readonly_anonymous_class() {
    assert_php_syntax("<?php new readonly class {};");
}

// PHP 8.4+
#[cfg_attr(not(php_min_84), ignore)]
#[test]
fn property_hook_body() {
    assert_php_syntax("<?php class A { public string $x { get { ?> <?php } } }");
}

// PHP 8.5+
#[cfg_attr(not(php_min_85), ignore)]
#[test]
fn constructor_final_param() {
    assert_php_syntax("<?php class P { public function __construct(final $i) {} }");
}
