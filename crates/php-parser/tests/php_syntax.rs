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

fn php_version_met(min: (u32, u32)) -> bool {
    const V81: bool = cfg!(php_min_81);
    const V82: bool = cfg!(php_min_82);
    const V83: bool = cfg!(php_min_83);
    const V84: bool = cfg!(php_min_84);
    const V85: bool = cfg!(php_min_85);
    const V86: bool = cfg!(php_min_86);
    match min {
        (major, minor) if (major, minor) <= (8, 0) => true,
        (8, 1) => V81,
        (8, 2) => V82,
        (8, 3) => V83,
        (8, 4) => V84,
        (8, 5) => V85,
        (8, 6) => V86,
        _ => false,
    }
}

fn php_version_exceeded(max: (u32, u32)) -> bool {
    const V81: bool = cfg!(php_min_81);
    const V82: bool = cfg!(php_min_82);
    const V83: bool = cfg!(php_min_83);
    const V84: bool = cfg!(php_min_84);
    const V85: bool = cfg!(php_min_85);
    const V86: bool = cfg!(php_min_86);
    match max {
        (major, _) if major < 8 => true,
        (8, 0) => V81,
        (8, 1) => V82,
        (8, 2) => V83,
        (8, 3) => V84,
        (8, 4) => V85,
        (8, 5) => V86,
        _ => false,
    }
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
        after.trim_end_matches('\n').to_string()
    })
}

fn update_fixture_php_error(path: &str, actual: &str) {
    let content =
        std::fs::read_to_string(path).unwrap_or_else(|e| panic!("failed to read {path}: {e}"));

    let new_content = if let Some(p) = content.find("===php_error===\n") {
        format!("{}===php_error===\n{}\n", &content[..p], actual)
    } else {
        format!(
            "{}\n===php_error===\n{}\n",
            content.trim_end_matches('\n'),
            actual
        )
    };

    std::fs::write(path, new_content).unwrap_or_else(|e| panic!("failed to write {path}: {e}"));
}

#[cfg_attr(not(php_available), ignore)]
#[test]
fn fixture_files_are_valid_php() {
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

        if let Some(min) = min_php {
            if !php_version_met(min) {
                return;
            }
        }
        if let Some(max) = max_php {
            if php_version_exceeded(max) {
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
