/// Parse a fixture file and return `(min_php, source)`.
///
/// `min_php` is read from an optional `===config===` section and controls both
/// the Rust parse target version and the minimum PHP version for `php -l` gating.
/// `source` is the PHP code between `===source===` and the next section marker.
///
/// An optional `===description===` section may appear before `===source===` and
/// contains free-form prose ignored by the runner — use it to document why a
/// fixture exists, what PHP grouping it pins, or known divergences.
///
/// All other section contents (`===errors===`, `===ast===`, `===php_error===`) are
/// left for each test binary to extract directly from the original content, since
/// different test binaries need different subsets.
///
/// Note: This function appears unused in some test binaries (e.g., visitor.rs)
/// because `common.rs` is compiled separately into each test binary. The
/// `#[allow(dead_code)]` suppression allows shared test utilities to coexist
/// even when not used by every test binary. This function is actually used by
/// `integration.rs` and `php_syntax.rs`.
#[allow(dead_code)]
pub fn parse_fixture(content: &str) -> (Option<(u32, u32)>, &str) {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };

    let mut min_php = None;

    // Anything before ===source=== is header (===config=== and/or ===description===).
    // Only ===config=== is interpreted; the rest is ignored.
    let source_marker = "===source===\n";
    let source_pos = content.find(source_marker).unwrap_or(content.len());
    let header = &content[..source_pos];

    if let Some(cfg_start) = header.find("===config===\n") {
        let after_cfg = &header[cfg_start + "===config===\n".len()..];
        // Config extends until the next ===section=== marker within the header
        // (e.g. ===description===) or to end of header.
        let cfg_end = after_cfg
            .find("\n===")
            .map(|p| p + 1)
            .unwrap_or(after_cfg.len());
        for line in after_cfg[..cfg_end].lines() {
            if let Some(val) = line.strip_prefix("min_php=") {
                min_php = parse_ver(val);
            }
        }
    }

    let rest = &content[source_pos..];
    let after_source = rest.strip_prefix(source_marker).unwrap_or(rest);

    // Source ends at the earliest of ===errors=== or ===ast=== (or EOF).
    // One trailing '\n' is stripped because it is the newline before the marker,
    // not part of the PHP source itself.
    let errors_pos = after_source.find("===errors===\n");
    let ast_pos = after_source.find("===ast===\n");
    let source_raw = match (errors_pos, ast_pos) {
        (Some(e), Some(a)) => &after_source[..e.min(a)],
        (Some(e), None) => &after_source[..e],
        (None, Some(a)) => &after_source[..a],
        (None, None) => after_source,
    };
    let source = if errors_pos.is_none() && ast_pos.is_none() {
        source_raw
    } else {
        source_raw.strip_suffix('\n').unwrap_or(source_raw)
    };

    (min_php, source)
}

/// Recursively collect all `.phpt` files under `dir`.
///
/// Note: This function appears unused in some test binaries (e.g., malformed_php.rs)
/// because `common.rs` is compiled separately into each test binary. The
/// `#[allow(dead_code)]` suppression allows shared test utilities to coexist
/// even when not used by every test binary. This function is actually used by
/// `integration.rs` and `php_syntax.rs`.
#[allow(dead_code)]
pub fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
    let mut paths = Vec::new();
    for entry in std::fs::read_dir(dir).unwrap().filter_map(|e| e.ok()) {
        let path = entry.path();
        if path.is_dir() {
            paths.extend(collect_phpt_files(&path));
        } else if path.extension().is_some_and(|ext| ext == "phpt") {
            paths.push(path);
        }
    }
    paths
}

/// Format all parse errors as a newline-separated string.
#[allow(dead_code)]
pub fn format_errors(result: &php_rs_parser::ArenaParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

/// Map a `(major, minor)` pair to a `PhpVersion`.
#[allow(dead_code)]
pub fn php_version(v: (u32, u32)) -> php_rs_parser::PhpVersion {
    use php_rs_parser::PhpVersion;
    match v {
        (7, 4) => PhpVersion::Php74,
        (8, 0) => PhpVersion::Php80,
        (8, 1) => PhpVersion::Php81,
        (8, 2) => PhpVersion::Php82,
        (8, 3) => PhpVersion::Php83,
        (8, 4) => PhpVersion::Php84,
        (8, 5) => PhpVersion::Php85,
        (8, 6) => PhpVersion::Php86,
        _ => panic!("unsupported PHP version: {}.{}", v.0, v.1),
    }
}

/// Extract the text of the `===errors===` section, or `None` if absent/empty.
#[allow(dead_code)]
pub fn extract_errors_section(content: &str) -> Option<String> {
    let after = &content[content.find("===errors===\n")? + "===errors===\n".len()..];
    let end = after.find("===ast===\n").unwrap_or(after.len());
    let text = after[..end].trim_end_matches('\n').to_string();
    if text.is_empty() {
        None
    } else {
        Some(text)
    }
}

/// Extract the text of the `===ast===` section, or `None` if absent.
#[allow(dead_code)]
pub fn extract_ast_section(content: &str) -> Option<String> {
    let after = &content[content.find("===ast===\n")? + "===ast===\n".len()..];
    let end = after.find("===php_error===\n").unwrap_or(after.len());
    Some(after[..end].trim_end_matches('\n').to_string())
}

/// If the fixture has a non-empty `===php_error===` section but no `===errors===`
/// section and the parser produced no errors, return an error message string.
#[allow(dead_code)]
pub fn php_error_closure_violation(content: &str, rel: &str) -> Option<String> {
    if content.contains("===errors===\n") {
        return None;
    }
    let marker = "===php_error===\n";
    let pos = content.find(marker)?;
    let body = content[pos + marker.len()..].trim();
    if body.is_empty() {
        return None;
    }
    Some(format!(
        "closure-check failure in {rel}: php -l rejects this input but the parser emitted no \
         diagnostics. Add a parser check or move the diagnostic into ===errors===."
    ))
}

/// Run the full `.phpt` fixture corpus through an arbitrary parse function.
///
/// `parse_fn(source, min_php)` returns `(error_strings, ast_json)`.
///
/// `update_fn`, when `Some`, is called instead of asserting AST equality —
/// pass it when `UPDATE_FIXTURES=1` is set to rewrite fixture files in-place.
#[allow(dead_code)]
pub fn run_fixture_corpus<P, U>(parse_fn: P, update_fn: Option<U>)
where
    P: Fn(&str, Option<(u32, u32)>) -> (Vec<String>, String) + Sync,
    U: Fn(&str, &str, &str) + Sync,
{
    use rayon::prelude::*;
    use std::sync::Mutex;

    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let failures = Mutex::new(Vec::<String>::new());

    paths.par_iter().for_each(|path| {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let (min_php, source) = parse_fixture(&content);

        let (errors, json) = parse_fn(source, min_php);

        let expect_errors = content.contains("===errors===\n");
        if expect_errors {
            if errors.is_empty() {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("expected parse errors in {rel} but got none"));
                return;
            }
        } else if !errors.is_empty() {
            failures
                .lock()
                .unwrap()
                .push(format!("unexpected parse errors in {rel}: {:?}", errors));
            return;
        }

        if errors.is_empty() {
            if let Some(msg) = php_error_closure_violation(&content, &rel) {
                failures.lock().unwrap().push(msg);
                return;
            }
        }

        if let Some(expected) = extract_errors_section(&content) {
            let actual = errors.join("\n");
            if actual != expected {
                failures.lock().unwrap().push(format!(
                    "error messages mismatch in {rel}\nexpected:\n{expected}\nactual:\n{actual}"
                ));
                return;
            }
        }

        if let Some(ref update) = update_fn {
            update(path.to_str().unwrap(), &errors.join("\n"), &json);
        } else {
            let expected = match extract_ast_section(&content) {
                Some(e) => e,
                None => {
                    failures
                        .lock()
                        .unwrap()
                        .push(format!("missing ===ast=== section in {rel}"));
                    return;
                }
            };
            if json != expected {
                failures.lock().unwrap().push(format!(
                    "AST mismatch in {rel}\nexpected:\n{expected}\nactual:\n{json}"
                ));
            }
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(f.is_empty(), "fixture test failure(s):\n{}", f.join("\n\n"));
}
