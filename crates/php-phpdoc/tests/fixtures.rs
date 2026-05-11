use rayon::prelude::*;
use std::sync::Mutex;

/// A phpdoc fixture file. Two formats are supported:
///
/// Full-comment fixture (uses `parse()`):
/// ```text
/// ===input===
/// /** @param int $x */
/// ===output===
/// { ... json ... }
/// ```
///
/// Type-only fixture (uses `parse_type()`):
/// ```text
/// ===type===
/// array<string, int>
/// ===output===
/// { ... json ... }
/// ```
enum Fixture {
    Comment { input: String, output: String },
    Type { input: String, output: String },
}

fn parse_fixture(content: &str) -> Fixture {
    if let Some(rest) = content.strip_prefix("===type===\n") {
        let output_pos = rest
            .find("===output===\n")
            .expect("fixture must have ===output=== section");
        let input = rest[..output_pos].trim_end_matches('\n').to_owned();
        let output = rest[output_pos + "===output===\n".len()..]
            .trim_end_matches('\n')
            .to_owned();
        Fixture::Type { input, output }
    } else if let Some(rest) = content.strip_prefix("===input===\n") {
        let output_pos = rest
            .find("===output===\n")
            .expect("fixture must have ===output=== section");
        let input = rest[..output_pos].trim_end_matches('\n').to_owned();
        let output = rest[output_pos + "===output===\n".len()..]
            .trim_end_matches('\n')
            .to_owned();
        Fixture::Comment { input, output }
    } else {
        panic!("fixture must start with ===input=== or ===type===");
    }
}

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

fn run_fixture(fixture: &Fixture) -> String {
    match fixture {
        Fixture::Comment { input, .. } => {
            let doc = php_phpdoc::parse(input);
            serde_json::to_string_pretty(&doc).unwrap()
        }
        Fixture::Type { input, .. } => {
            let ty = php_phpdoc::parse_type(input);
            serde_json::to_string_pretty(&ty).unwrap()
        }
    }
}

fn fixture_input(fixture: &Fixture) -> &str {
    match fixture {
        Fixture::Comment { input, .. } | Fixture::Type { input, .. } => input,
    }
}

fn fixture_output(fixture: &Fixture) -> &str {
    match fixture {
        Fixture::Comment { output, .. } | Fixture::Type { output, .. } => output,
    }
}

fn write_fixture(path: &std::path::Path, fixture: &Fixture, actual: &str) {
    let content = match fixture {
        Fixture::Comment { input, .. } => {
            format!("===input===\n{input}\n===output===\n{actual}\n")
        }
        Fixture::Type { input, .. } => {
            format!("===type===\n{input}\n===output===\n{actual}\n")
        }
    };
    std::fs::write(path, content).unwrap();
}

#[test]
fn fixtures() {
    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let update = std::env::var("UPDATE_FIXTURES").is_ok();
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    if paths.is_empty() {
        return;
    }

    let failures = Mutex::new(Vec::new());

    paths.par_iter().for_each(|path| {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let fixture = parse_fixture(&content);
        let actual = run_fixture(&fixture);

        if update {
            write_fixture(path, &fixture, &actual);
        } else {
            let expected = fixture_output(&fixture);
            if actual != expected {
                failures.lock().unwrap().push(format!(
                    "output mismatch in {rel}\ninput:\n{}\nexpected:\n{expected}\nactual:\n{actual}",
                    fixture_input(&fixture)
                ));
            }
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(
        f.is_empty(),
        "phpdoc fixture failures:\n{}",
        f.join("\n\n---\n\n")
    );
}
