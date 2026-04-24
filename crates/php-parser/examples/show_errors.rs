//! Show parse errors with source context.
//!
//! Run with: cargo run --release --example show_errors -- <file.php> [...]

use std::path::Path;

fn main() {
    let files: Vec<String> = std::env::args().skip(1).collect();
    for f in &files {
        dump(Path::new(f));
    }
}

fn dump(path: &Path) {
    let contents = match std::fs::read_to_string(path) {
        Ok(s) => s,
        Err(e) => {
            eprintln!("read error: {}", e);
            return;
        }
    };
    println!("=== {} ({} bytes) ===", path.display(), contents.len());
    let arena = bumpalo::Bump::new();
    let r = php_rs_parser::parse(&arena, &contents);
    for e in &r.errors {
        let span = e.span();
        let (line, col) = line_col(&contents, span.start as usize);
        let (eline, ecol) = line_col(&contents, span.end as usize);
        println!("  [{}:{}..{}:{}] {}", line, col, eline, ecol, e);
        // print the offending line
        if let Some(src_line) = contents.lines().nth(line.saturating_sub(1)) {
            println!("    > {}", src_line.trim_end());
            let mut caret = String::from("    > ");
            caret.extend(std::iter::repeat(' ').take(col.saturating_sub(1)));
            let len = (span.end - span.start).max(1) as usize;
            caret.extend(std::iter::repeat('^').take(len.min(80)));
            println!("{}", caret);
        }
    }
    println!();
}

fn line_col(src: &str, byte_off: usize) -> (usize, usize) {
    let mut line = 1;
    let mut col = 1;
    for (i, b) in src.bytes().enumerate() {
        if i >= byte_off {
            break;
        }
        if b == b'\n' {
            line += 1;
            col = 1;
        } else {
            col += 1;
        }
    }
    (line, col)
}
