use serde::Serialize;
use wasm_bindgen::prelude::*;

#[derive(Serialize)]
struct WasmError {
    message: String,
    start: u32,
    end: u32,
}

#[derive(Serialize)]
struct ParseOutput {
    ast: serde_json::Value,
    errors: Vec<WasmError>,
    formatted: String,
}

fn php_version_from_str(s: &str) -> Option<php_rs_parser::PhpVersion> {
    match s {
        "7.4" => Some(php_rs_parser::PhpVersion::Php74),
        "8.0" => Some(php_rs_parser::PhpVersion::Php80),
        "8.1" => Some(php_rs_parser::PhpVersion::Php81),
        "8.2" => Some(php_rs_parser::PhpVersion::Php82),
        "8.3" => Some(php_rs_parser::PhpVersion::Php83),
        "8.4" => Some(php_rs_parser::PhpVersion::Php84),
        "8.5" => Some(php_rs_parser::PhpVersion::Php85),
        _ => None,
    }
}

/// Parse PHP source and return `{ ast, errors, formatted }` as a JS object.
///
/// `version` is an optional PHP target version string like `"8.4"`. Defaults
/// to the latest supported version when omitted or unrecognised.
#[wasm_bindgen]
pub fn parse(source: &str, version: Option<String>) -> Result<JsValue, JsError> {
    let php_version = version
        .as_deref()
        .and_then(php_version_from_str)
        .unwrap_or(php_rs_parser::PhpVersion::Php85);

    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse_versioned(&arena, source, php_version);

    let errors: Vec<WasmError> = result
        .errors
        .iter()
        .map(|e| {
            let span = e.span();
            WasmError {
                message: e.to_string(),
                start: span.start,
                end: span.end,
            }
        })
        .collect();

    let ast = serde_json::to_value(&result.program).unwrap_or(serde_json::Value::Null);
    let formatted = php_printer::pretty_print(&result.program);

    let output = ParseOutput {
        ast,
        errors,
        formatted,
    };
    let serializer = serde_wasm_bindgen::Serializer::json_compatible();
    Ok(output.serialize(&serializer)?)
}

/// Pretty-print PHP source without returning the AST.
#[wasm_bindgen]
pub fn format(source: &str) -> String {
    let arena = bumpalo::Bump::new();
    let result = php_rs_parser::parse(&arena, source);
    php_printer::pretty_print(&result.program)
}

/// Crate version from Cargo.toml, e.g. `"0.9.4"`.
#[wasm_bindgen]
pub fn parser_version() -> String {
    env!("CARGO_PKG_VERSION").to_string()
}

/// Short git commit hash captured at WASM build time, e.g. `"a1b2c3d"`.
#[wasm_bindgen]
pub fn build_commit() -> String {
    option_env!("BUILD_COMMIT").unwrap_or("unknown").to_string()
}
