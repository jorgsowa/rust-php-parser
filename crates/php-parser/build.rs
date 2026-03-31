fn main() {
    println!("cargo::rustc-check-cfg=cfg(php_available)");
    println!("cargo::rustc-check-cfg=cfg(php_min_81)");
    println!("cargo::rustc-check-cfg=cfg(php_min_82)");
    println!("cargo::rustc-check-cfg=cfg(php_min_83)");
    println!("cargo::rustc-check-cfg=cfg(php_min_84)");
    println!("cargo::rustc-check-cfg=cfg(php_min_85)");

    let Ok(out) = std::process::Command::new("php")
        .args(["-r", "echo PHP_MAJOR_VERSION.\".\".PHP_MINOR_VERSION;"])
        .output()
    else {
        return;
    };
    let ver = String::from_utf8_lossy(&out.stdout);
    let ver = ver.trim();
    let Some((maj, min)) = ver.split_once('.') else {
        return;
    };
    let Ok(maj) = maj.parse::<u32>() else { return };
    let Ok(min) = min.parse::<u32>() else { return };
    println!("cargo:rustc-cfg=php_available");
    if (maj, min) >= (8, 1) {
        println!("cargo:rustc-cfg=php_min_81");
    }
    if (maj, min) >= (8, 2) {
        println!("cargo:rustc-cfg=php_min_82");
    }
    if (maj, min) >= (8, 3) {
        println!("cargo:rustc-cfg=php_min_83");
    }
    if (maj, min) >= (8, 4) {
        println!("cargo:rustc-cfg=php_min_84");
    }
    if (maj, min) >= (8, 5) {
        println!("cargo:rustc-cfg=php_min_85");
    }
}
