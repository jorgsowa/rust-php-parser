//! Reads file paths from stdin and prints `path<TAB>errors` for each file the parser reports errors on.
use std::io::BufRead;

fn main() {
    for line in std::io::stdin().lock().lines() {
        let path = line.unwrap();
        let Ok(source) = std::fs::read_to_string(&path) else {
            continue;
        };
        let result = php_rs_parser::parse(&source);
        if !result.errors.is_empty() {
            let messages: Vec<String> = result
                .errors
                .iter()
                .map(|e| e.to_string().replace('\n', " "))
                .collect();
            println!("{path}\t{}", messages.join(" || "));
        }
    }
}
