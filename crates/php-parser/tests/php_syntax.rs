use rayon::prelude::*;
use std::io::Write;
use std::sync::Mutex;

fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
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

fn parse_fixture(content: &str) -> (Option<(u32, u32)>, &str) {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };

    let mut min_php = None;

    let source_marker = "===source===\n";
    let source_pos = content.find(source_marker).unwrap_or(content.len());
    let header = &content[..source_pos];

    if let Some(cfg_start) = header.find("===config===\n") {
        let after_cfg = &header[cfg_start + "===config===\n".len()..];
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

    let source = match ["===errors===\n", "===php_error===\n", "===ast===\n"]
        .iter()
        .filter_map(|m| after_source.find(m))
        .min()
    {
        Some(end) => {
            let raw = &after_source[..end];
            raw.strip_suffix('\n').unwrap_or(raw)
        }
        None => after_source,
    };

    (min_php, source)
}

/// Version of the `php` binary on `PATH`, or `None` when PHP is not installed.
fn php_version() -> Option<(u32, u32)> {
    let out = std::process::Command::new("php")
        .args(["-r", "echo PHP_MAJOR_VERSION.\".\".PHP_MINOR_VERSION;"])
        .output()
        .ok()?;
    let ver = String::from_utf8_lossy(&out.stdout);
    let (maj, min) = ver.trim().split_once('.')?;
    Some((maj.parse().ok()?, min.parse().ok()?))
}

fn strip_stack_trace(s: &str) -> String {
    let mut lines: Vec<&str> = s.lines().collect();
    while let Some(last) = lines.last() {
        if last.starts_with('#') || *last == "Stack trace:" {
            lines.pop();
        } else {
            break;
        }
    }
    lines.join("\n")
}

fn normalize_quotes(s: &str) -> String {
    s.replace('\'', "\"")
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

fn parse_max_php(content: &str) -> Option<(u32, u32)> {
    let parse_ver = |val: &str| -> Option<(u32, u32)> {
        val.split_once('.')
            .and_then(|(a, b)| Some((a.parse().ok()?, b.parse().ok()?)))
    };
    let rest = content.strip_prefix("===config===\n")?;
    let source_marker = rest.find("===source===\n").unwrap_or(rest.len());
    for line in rest[..source_marker].lines() {
        if let Some(val) = line.strip_prefix("max_php=") {
            return parse_ver(val);
        }
    }
    None
}

fn parse_php_error(content: &str) -> Option<String> {
    content.find("===php_error===\n").map(|p| {
        let after = &content[p + "===php_error===\n".len()..];
        let end = after.find("===ast===\n").unwrap_or(after.len());
        after[..end].trim_end_matches('\n').to_string()
    })
}

/// Errors `php -l` does not report: a fixture that lists errors must record a `php -l` failure.
fn non_fatal_errors(content: &str) -> Vec<String> {
    if content.contains("===php_error===\n") {
        return Vec::new();
    }
    let Some(p) = content.find("===errors===\n") else {
        return Vec::new();
    };
    let after = &content[p + "===errors===\n".len()..];
    let end = after.find("\n===").unwrap_or(after.len());
    after[..end]
        .lines()
        .filter(|l| !l.is_empty() && !l.contains(" requires PHP "))
        .map(str::to_string)
        .collect()
}

fn update_fixture_php_error(path: &str, actual: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));

    // The section sits between ===errors=== and ===ast===: replace it in place,
    // or insert it before ===ast=== (appending only when there is no AST yet).
    let section = format!("===php_error===\n{actual}\n");
    let new_content = if let Some(p) = content.find("===php_error===\n") {
        let after = &content[p..];
        let end = after.find("===ast===\n").unwrap_or(after.len());
        format!("{}{section}{}", &content[..p], &after[end..])
    } else if let Some(a) = content.find("===ast===\n") {
        format!("{}{section}{}", &content[..a], &content[a..])
    } else {
        format!("{}\n{section}", content.trim_end_matches('\n'))
    };

    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}

#[test]
fn fixture_files_are_valid_php() {
    let Some(php) = php_version() else {
        assert!(
            std::env::var_os("CI").is_none(),
            "`php` not found on PATH in CI"
        );
        eprintln!("skipping: `php` not found on PATH");
        return;
    };
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let update = std::env::var("UPDATE_FIXTURES").is_ok();

    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let failures = Mutex::new(Vec::new());

    paths.par_iter().for_each(|path| {
        let label = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let src = std::fs::read_to_string(path).unwrap();
        let (min_php, source) = parse_fixture(&src);
        let max_php = parse_max_php(&src);
        let php_error = parse_php_error(&src);

        let non_fatal = non_fatal_errors(&src);
        if !non_fatal.is_empty() {
            failures.lock().unwrap().push(format!(
                "{label}: parser reports errors `php -l` does not:\n  {}",
                non_fatal.join("\n  ")
            ));
        }

        if let Some(min) = min_php {
            if php < min {
                return;
            }
        }
        if let Some(max) = max_php {
            if php > max {
                return;
            }
        }

        let out = php_lint(source);

        if let Some(expected) = &php_error {
            if out.status.success() {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("{label}: expected php -l to fail but it passed"));
                return;
            }
            let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
            if update {
                update_fixture_php_error(path.to_str().unwrap(), &actual);
            } else if normalize_quotes(&actual) != normalize_quotes(&strip_stack_trace(expected)) {
                failures.lock().unwrap().push(format!(
                    "{label}:\n  expected: {expected}\n  actual:   {actual}"
                ));
            }
        } else {
            if !out.status.success() {
                let actual = strip_stack_trace(String::from_utf8_lossy(&out.stderr).trim());
                if update {
                    update_fixture_php_error(path.to_str().unwrap(), &actual);
                } else {
                    failures
                        .lock()
                        .unwrap()
                        .push(format!("{label}:\n  {actual}"));
                }
            }
        }
    });

    let f = failures.into_inner().unwrap();
    if !f.is_empty() {
        panic!(
            "php -l check failed for {} fixture(s):\n\n{}",
            f.len(),
            f.join("\n\n")
        );
    }
}
