use rayon::prelude::*;
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

fn parse_fixture(content: &str) -> (String, String) {
    let rest = content
        .strip_prefix("===input===\n")
        .expect("fixture must start with ===input===");
    let output_pos = rest
        .find("===output===\n")
        .expect("fixture must have ===output=== section");
    let input = rest[..output_pos].trim_end_matches('\n').to_owned();
    let output = rest[output_pos + "===output===\n".len()..]
        .trim_end_matches('\n')
        .to_owned();
    (input, output)
}

fn run_fixture(input: &str) -> String {
    let doc = phpdoc_parser::parse(input);
    serde_json::to_string_pretty(&doc).unwrap()
}

fn write_fixture(path: &std::path::Path, input: &str, actual: &str) {
    std::fs::write(
        path,
        format!("===input===\n{input}\n===output===\n{actual}\n"),
    )
    .unwrap();
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
        let (input, expected) = parse_fixture(&content);
        let actual = run_fixture(&input);

        if update {
            write_fixture(path, &input, &actual);
        } else if actual != expected {
            failures.lock().unwrap().push(format!(
                "output mismatch in {rel}\ninput:\n{input}\nexpected:\n{expected}\nactual:\n{actual}"
            ));
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(
        f.is_empty(),
        "phpdoc fixture failures:\n{}",
        f.join("\n\n---\n\n")
    );
}
