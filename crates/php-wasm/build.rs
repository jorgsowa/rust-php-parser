fn main() {
    // Embed the short git commit hash at WASM compile time.
    // Works both locally and in CI (the repo is checked out in both cases).
    if let Ok(out) = std::process::Command::new("git")
        .args(["rev-parse", "--short", "HEAD"])
        .output()
    {
        let hash = String::from_utf8_lossy(&out.stdout).trim().to_string();
        if !hash.is_empty() {
            println!("cargo:rustc-env=BUILD_COMMIT={hash}");
        }
    }
    // Re-run whenever HEAD moves (commit, checkout, rebase …)
    println!("cargo:rerun-if-changed=.git/HEAD");
}
