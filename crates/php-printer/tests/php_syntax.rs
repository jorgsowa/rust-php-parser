#[path = "../../php-parser/tests/integration/common.rs"]
mod parser_common;

use parser_common::{collect_phpt_files, installed_php, php_lint, php_version, Fixture, SUPPORTED};
use php_printer::{PrettyPrinter, PrinterConfig};
use php_rs_parser::diagnostics::Phase;
use rayon::prelude::*;
use std::path::{Path, PathBuf};
use std::sync::Mutex;

/// `error` without the line it points at, since printing moves code to other lines.
fn without_line(error: &str) -> String {
    let mut out = String::new();
    let mut rest = error;
    while let Some(at) = rest.find("Standard input code") {
        let (head, tail) = rest.split_at(at + "Standard input code".len());
        out.push_str(head);
        let tail = tail
            .strip_prefix(" on line ")
            .or_else(|| tail.strip_prefix(':'))
            .map_or(tail, |t| t.trim_start_matches(|c: char| c.is_ascii_digit()));
        rest = tail;
    }
    out.push_str(rest);
    out
}

/// The printed `source`, or `None` when it has a syntax error, which the tree cannot keep.
fn print(source: &str, version: php_rs_parser::PhpVersion) -> Option<String> {
    let arena = bumpalo::Bump::new();
    let options = php_rs_parser::ParseOptions::default().version(version);
    let result = php_rs_parser::parse_arena_with(&arena, source, &options);
    if result
        .errors
        .iter()
        .any(|e| e.forbidden_rule().map(|rule| rule.phase()) != Some(Phase::Compile))
    {
        return None;
    }
    let mut config = PrinterConfig::default();
    config.php_version = version;
    Some(
        PrettyPrinter::new()
            .config(config)
            .comments(source, &result.comments)
            .print(&result.program),
    )
}

fn fixture_sources(root: &Path) -> Vec<(PathBuf, Result<String, String>)> {
    let parser_dir = root.join("../php-parser/tests/fixtures");
    let printer_dir = root.join("tests/fixtures");
    let mut paths = collect_phpt_files(&parser_dir);
    paths.extend(collect_phpt_files(&printer_dir));
    paths.sort();
    paths
        .into_iter()
        .map(|path| {
            let content = std::fs::read_to_string(&path).unwrap();
            let source = if path.starts_with(&printer_dir) {
                content
                    .split_once("===source===\n")
                    .and_then(|(_, rest)| rest.split_once("\n===print===\n"))
                    .map(|(source, _)| source.to_string())
                    .ok_or_else(|| "missing ===source=== or ===print===".to_string())
            } else {
                Fixture::parse(&content).map(|f| f.source().to_string())
            };
            let label = path.strip_prefix(root).unwrap().to_path_buf();
            (label, source)
        })
        .collect()
}

/// Printing for the `php` on `PATH` keeps the `php -l` result of each fixture without a syntax error.
#[test]
fn printed_fixtures_keep_php_l_result() {
    let Some(php) = installed_php() else {
        assert!(
            std::env::var_os("CI").is_none(),
            "`php` not found on PATH in CI"
        );
        eprintln!("skipping: `php` not found on PATH");
        return;
    };
    assert!(
        SUPPORTED.contains(&php),
        "PHP {}.{} is not in SUPPORTED",
        php.0,
        php.1
    );
    let version = php_version(php);
    let root = Path::new(env!("CARGO_MANIFEST_DIR"));
    let failures = Mutex::new(Vec::new());

    fixture_sources(root)
        .par_iter()
        .for_each(|(label, source)| {
            let at = format!("{} (PHP {}.{})", label.display(), php.0, php.1);
            let source = match source {
                Ok(source) => source,
                Err(e) => {
                    failures
                        .lock()
                        .unwrap()
                        .push(format!("malformed fixture {at}: {e}"));
                    return;
                }
            };
            let Some(printed) = print(source, version) else {
                return;
            };
            let expected = php_lint(source).map(|e| without_line(&e));
            let actual = php_lint(&printed).map(|e| without_line(&e));
            if expected == actual {
                return;
            }
            let verdict = |e: &Option<String>| e.clone().unwrap_or_else(|| "passes".to_string());
            failures.lock().unwrap().push(format!(
                "{at}\n  source:  {}\n  printed: {}\n{printed}",
                verdict(&expected),
                verdict(&actual)
            ));
        });

    let mut f = failures.into_inner().unwrap();
    f.sort();
    assert!(
        f.is_empty(),
        "printing changed the php -l result of {} fixture(s):\n\n{}",
        f.len(),
        f.join("\n\n")
    );
}
