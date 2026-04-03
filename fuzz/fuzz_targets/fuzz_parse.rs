#![no_main]

use libfuzzer_sys::fuzz_target;

fuzz_target!(|data: &[u8]| {
    if let Ok(src) = std::str::from_utf8(data) {
        let arena = bumpalo::Bump::new();
        let _ = php_rs_parser::parse(&arena, src);
    }
});
