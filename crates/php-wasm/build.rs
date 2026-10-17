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

    // At its full nesting budget the parser needs about 1 MiB of stack, which is
    // all wasm32 gets by default. Wasm has no guard page, so an overflow would
    // silently corrupt linear memory rather than trap; leave ample headroom.
    if std::env::var("CARGO_CFG_TARGET_ARCH").as_deref() == Ok("wasm32") {
        println!("cargo:rustc-link-arg=-zstack-size=8388608");
    }
}
