pub type Version = (u32, u32);

/// PHP versions the parser can target. A new entry widens every open-ended `>=` fixture range to it.
#[allow(dead_code)]
pub const SUPPORTED: [Version; 8] = [
    (7, 4),
    (8, 0),
    (8, 1),
    (8, 2),
    (8, 3),
    (8, 4),
    (8, 5),
    (8, 6),
];

/// Version the parser targets by default; the parse target of a fixture without version ranges.
#[allow(dead_code)]
pub const DEFAULT: Version = SUPPORTED[SUPPORTED.len() - 1];

const SECTION_NAMES: [&str; 3] = ["errors", "php_error", "ast"];

fn parse_version(val: &str) -> Option<Version> {
    let (major, minor) = val.trim().split_once('.')?;
    Some((major.parse().ok()?, minor.parse().ok()?))
}

/// Inclusive range of PHP versions: `8.3`, `<=8.2`, `>=8.4` or `8.1-8.3`.
#[allow(dead_code)]
#[derive(Clone, Copy, Debug, PartialEq, Eq)]
pub struct VersionSpec {
    pub lo: Option<Version>,
    pub hi: Option<Version>,
}

#[allow(dead_code)]
impl VersionSpec {
    pub fn parse(s: &str) -> Result<VersionSpec, String> {
        let s = s.trim();
        let version = |v: &str| {
            parse_version(v)
                .filter(|v| SUPPORTED.contains(v))
                .ok_or_else(|| format!("`{v}` is not a supported PHP version"))
        };
        let spec = if let Some(v) = s.strip_prefix("<=") {
            VersionSpec {
                lo: None,
                hi: Some(version(v)?),
            }
        } else if let Some(v) = s.strip_prefix(">=") {
            VersionSpec {
                lo: Some(version(v)?),
                hi: None,
            }
        } else if let Some((a, b)) = s.split_once('-') {
            VersionSpec {
                lo: Some(version(a)?),
                hi: Some(version(b)?),
            }
        } else {
            let v = version(s)?;
            VersionSpec {
                lo: Some(v),
                hi: Some(v),
            }
        };
        if spec.lo.zip(spec.hi).is_some_and(|(lo, hi)| lo > hi) {
            return Err(format!("empty version range `{s}`"));
        }
        Ok(spec)
    }

    pub fn contains(&self, v: Version) -> bool {
        self.lo.is_none_or(|lo| v >= lo) && self.hi.is_none_or(|hi| v <= hi)
    }

    /// Spec for a run of consecutive supported versions; open-ended where the run touches an edge.
    pub fn for_run(run: &[Version]) -> VersionSpec {
        VersionSpec {
            lo: (run[0] != SUPPORTED[0]).then_some(run[0]),
            hi: (run.last() != SUPPORTED.last()).then(|| *run.last().unwrap()),
        }
    }
}

impl std::fmt::Display for VersionSpec {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        let v = |(a, b): Version| format!("{a}.{b}");
        match (self.lo, self.hi) {
            (None, None) => write!(f, ">={}", v(SUPPORTED[0])),
            (None, Some(hi)) => write!(f, "<={}", v(hi)),
            (Some(lo), None) => write!(f, ">={}", v(lo)),
            (Some(lo), Some(hi)) if lo == hi => write!(f, "{}", v(lo)),
            (Some(lo), Some(hi)) => write!(f, "{}-{}", v(lo), v(hi)),
        }
    }
}

/// An `===errors===`, `===php_error===` or `===ast===` section, optionally limited to a version range.
#[allow(dead_code)]
#[derive(Clone, Debug)]
pub struct Section {
    pub name: String,
    pub spec: Option<VersionSpec>,
    pub body: String,
}

/// A parsed `.phpt` fixture.
///
/// A fixture with a version-qualified `===ast >=8.4===` section is checked against every
/// PHP version the `ast` sections name. A section such as `===php_error <=8.3===` applies
/// only to the versions it names and an unqualified section is the fallback. Without a
/// qualified `ast` section the fixture has a single default parse target.
#[allow(dead_code)]
#[derive(Debug)]
pub struct Fixture {
    header: String,
    source_block: String,
    sections: Vec<Section>,
}

#[allow(dead_code)]
impl Fixture {
    /// Parse `content`, rejecting unknown sections, malformed markers and ambiguous sections.
    pub fn parse(content: &str) -> Result<Fixture, String> {
        let source_marker = "===source===\n";
        let source_pos = content.find(source_marker).ok_or("missing ===source===")?;
        let header = content[..source_pos].to_string();
        check_header(&header)?;
        let after_source = &content[source_pos + source_marker.len()..];

        let mut source_end = after_source.len();
        let mut sections: Vec<Section> = Vec::new();
        let mut offset = 0;
        for line in after_source.split_inclusive('\n') {
            let line_text = line.trim_end_matches('\n');
            if line_text.len() > 6 && line_text.starts_with("===") && line_text.ends_with("===") {
                let (name, spec) = parse_section_marker(line_text)?;
                if sections.is_empty() {
                    source_end = offset;
                }
                sections.push(Section {
                    name,
                    spec,
                    body: String::new(),
                });
            } else if let Some(section) = sections.last_mut() {
                section.body.push_str(line);
            }
            offset += line.len();
        }
        for section in &mut sections {
            section
                .body
                .truncate(section.body.trim_end_matches('\n').len());
        }

        let fixture = Fixture {
            header,
            source_block: after_source[..source_end].to_string(),
            sections,
        };
        fixture.check_sections()?;
        Ok(fixture)
    }

    fn check_sections(&self) -> Result<(), String> {
        let versions = self.versions();
        for name in SECTION_NAMES {
            let named: Vec<&Section> = self.sections.iter().filter(|s| s.name == name).collect();
            let unqualified = named.iter().filter(|s| s.spec.is_none()).count();
            if unqualified > 1 {
                return Err(format!("more than one ==={name}=== section"));
            }
            let qualified: Vec<VersionSpec> = named.iter().filter_map(|s| s.spec).collect();
            // `php_error` ranges name `php -l` versions, which are independent of the parse targets.
            let versions = if name == "php_error" {
                Some(SUPPORTED.to_vec())
            } else {
                versions.clone()
            };
            let Some(versions) = &versions else {
                if let Some(spec) = qualified.first() {
                    return Err(format!(
                        "==={name} {spec}=== needs a version-qualified ===ast=== section"
                    ));
                }
                continue;
            };
            if name == "ast" && unqualified > 0 {
                return Err("===ast=== is never used next to version-qualified ones".into());
            }
            for (i, a) in qualified.iter().enumerate() {
                if !versions.iter().any(|v| a.contains(*v)) {
                    return Err(format!(
                        "==={name} {a}=== covers none of the versions the ===ast=== sections name"
                    ));
                }
                let overlap =
                    |b: &&VersionSpec| SUPPORTED.iter().any(|v| a.contains(*v) && b.contains(*v));
                if let Some(b) = qualified[i + 1..].iter().find(overlap) {
                    return Err(format!("==={name} {a}=== overlaps ==={name} {b}==="));
                }
            }
        }
        Ok(())
    }

    /// The PHP source; the newline before the first section marker is not part of it.
    pub fn source(&self) -> &str {
        if self.sections.is_empty() {
            &self.source_block
        } else {
            self.source_block
                .strip_suffix('\n')
                .unwrap_or(&self.source_block)
        }
    }

    /// Versions a multi-version fixture covers; `None` for a single-target fixture.
    pub fn versions(&self) -> Option<Vec<Version>> {
        let specs: Vec<VersionSpec> = self
            .sections
            .iter()
            .filter(|s| s.name == "ast")
            .filter_map(|s| s.spec)
            .collect();
        (!specs.is_empty()).then(|| {
            SUPPORTED
                .iter()
                .copied()
                .filter(|v| specs.iter().any(|spec| spec.contains(*v)))
                .collect()
        })
    }

    /// Parse targets: one per covered version, or the single default target (`None`).
    pub fn targets(&self) -> Vec<Option<Version>> {
        match self.versions() {
            Some(versions) => versions.into_iter().map(Some).collect(),
            None => vec![None],
        }
    }

    fn section_index(&self, name: &str, version: Option<Version>) -> Option<usize> {
        let named = || {
            self.sections
                .iter()
                .enumerate()
                .filter(|(_, s)| s.name == name)
        };
        version
            .and_then(|v| named().find(|(_, s)| s.spec.is_some_and(|spec| spec.contains(v))))
            .or_else(|| named().find(|(_, s)| s.spec.is_none()))
            .map(|(i, _)| i)
    }

    /// The section `name` that applies to `version`.
    pub fn section(&self, name: &str, version: Option<Version>) -> Option<&Section> {
        self.section_index(name, version).map(|i| &self.sections[i])
    }

    pub fn replace_sections(&mut self, name: &str, new: Vec<Section>) {
        self.sections.retain(|s| s.name != name);
        self.sections.extend(new);
    }

    /// Set or remove the body of section `name` for `version` alone, keeping the other versions'
    /// bodies and merging runs of identical ones.
    pub fn set_section_for(&mut self, name: &str, version: Version, body: Option<&str>) {
        let bodies: Vec<Option<String>> = SUPPORTED
            .iter()
            .map(|v| match *v == version {
                true => body.map(str::to_string),
                false => self.section(name, Some(*v)).map(|s| s.body.clone()),
            })
            .collect();
        let mut new = Vec::new();
        let mut start = 0;
        while start < SUPPORTED.len() {
            let mut end = start + 1;
            while end < SUPPORTED.len() && bodies[end] == bodies[start] {
                end += 1;
            }
            if let Some(body) = &bodies[start] {
                let whole = start == 0 && end == SUPPORTED.len();
                new.push(Section {
                    name: name.to_string(),
                    spec: (!whole).then(|| VersionSpec::for_run(&SUPPORTED[start..end])),
                    body: body.clone(),
                });
            }
            start = end;
        }
        self.replace_sections(name, new);
    }

    pub fn render(&self) -> String {
        let mut out = format!("{}===source===\n{}", self.header, self.source_block);
        let mut ordered: Vec<&Section> = self.sections.iter().collect();
        ordered.sort_by_key(|s| {
            let rank = SECTION_NAMES.iter().position(|n| *n == s.name).unwrap();
            (rank, s.spec.is_none(), s.spec.and_then(|spec| spec.lo))
        });
        if !ordered.is_empty() && !out.ends_with('\n') {
            out.push('\n');
        }
        for s in ordered {
            match s.spec {
                Some(spec) => out.push_str(&format!("==={} {spec}===\n", s.name)),
                None => out.push_str(&format!("==={}===\n", s.name)),
            }
            if !s.body.is_empty() {
                out.push_str(&s.body);
                out.push('\n');
            }
        }
        out
    }
}

fn parse_section_marker(line: &str) -> Result<(String, Option<VersionSpec>), String> {
    let inner = &line[3..line.len() - 3];
    let (name, spec) = match inner.split_once(' ') {
        Some((name, spec)) => (
            name,
            Some(VersionSpec::parse(spec).map_err(|e| format!("`{line}`: {e}"))?),
        ),
        None => (inner, None),
    };
    if !SECTION_NAMES.contains(&name) {
        return Err(format!("unknown section `{line}`"));
    }
    Ok((name.to_string(), spec))
}

/// The header holds at most one `===description===` section.
fn check_header(header: &str) -> Result<(), String> {
    let mut current = None;
    let mut seen = Vec::new();
    for line in header.lines() {
        if let Some(name) = line.strip_prefix("===").and_then(|l| l.strip_suffix("===")) {
            if name != "description" {
                return Err(format!("unknown section `{line}` before ===source==="));
            }
            if seen.contains(&name) {
                return Err(format!("more than one ==={name}=== section"));
            }
            seen.push(name);
            current = Some(name);
            continue;
        }
        if current.is_none() {
            return Err(format!("text before the first section: `{line}`"));
        }
    }
    Ok(())
}

/// Recursively collect all `.phpt` files under `dir`.
///
/// Note: This function appears unused in some test binaries (e.g., malformed_php.rs)
/// because `common.rs` is compiled separately into each test binary. The
/// `#[allow(dead_code)]` suppression allows shared test utilities to coexist
/// even when not used by every test binary. This function is actually used by
/// `integration.rs` and `php_syntax.rs`.
#[allow(dead_code)]
pub fn collect_phpt_files(dir: &std::path::Path) -> Vec<std::path::PathBuf> {
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

/// Format all parse errors as a newline-separated string.
#[allow(dead_code)]
pub fn format_errors(result: &php_rs_parser::ArenaParseResult) -> String {
    result
        .errors
        .iter()
        .map(|e| e.to_string())
        .collect::<Vec<_>>()
        .join("\n")
}

/// Map a `(major, minor)` pair to a `PhpVersion`.
#[allow(dead_code)]
pub fn php_version(v: (u32, u32)) -> php_rs_parser::PhpVersion {
    use php_rs_parser::PhpVersion;
    match v {
        (7, 4) => PhpVersion::Php74,
        (8, 0) => PhpVersion::Php80,
        (8, 1) => PhpVersion::Php81,
        (8, 2) => PhpVersion::Php82,
        (8, 3) => PhpVersion::Php83,
        (8, 4) => PhpVersion::Php84,
        (8, 5) => PhpVersion::Php85,
        (8, 6) => PhpVersion::Php86,
        _ => panic!("unsupported PHP version: {}.{}", v.0, v.1),
    }
}

/// Run the full `.phpt` fixture corpus through an arbitrary parse function.
///
/// `parse_fn(source, version)` returns `(error_strings, ast_json)` for one parse target.
///
/// With `update`, the `===errors===` and `===ast===` sections are rewritten in place
/// instead of compared. A multi-version fixture gets one qualified section per run of
/// versions with identical output.
#[allow(dead_code)]
pub fn run_fixture_corpus<P>(parse_fn: P, update: bool)
where
    P: Fn(&str, Option<Version>) -> (Vec<String>, String) + Sync,
{
    use rayon::prelude::*;
    use std::sync::Mutex;

    let dir = std::path::Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures");
    let mut paths = collect_phpt_files(&dir);
    paths.sort();

    let failures = Mutex::new(Vec::<String>::new());

    paths.par_iter().for_each(|path| {
        let rel = path
            .strip_prefix(&dir)
            .unwrap()
            .to_string_lossy()
            .to_string();
        let content = std::fs::read_to_string(path).unwrap();
        let mut fixture = match Fixture::parse(&content) {
            Ok(fixture) => fixture,
            Err(e) => {
                failures
                    .lock()
                    .unwrap()
                    .push(format!("malformed fixture {rel}: {e}"));
                return;
            }
        };
        let targets = fixture.targets();
        let results: Vec<(Vec<String>, String)> = targets
            .iter()
            .map(|v| parse_fn(fixture.source(), *v))
            .collect();

        if update {
            update_fixture(&mut fixture, &targets, &results);
            std::fs::write(path, fixture.render())
                .unwrap_or_else(|e| panic!("failed to write {}: {e}", path.display()));
            return;
        }

        let multi = fixture.versions().is_some();
        for (target, (errors, json)) in targets.iter().zip(&results) {
            let at = match (multi, target) {
                (true, Some((a, b))) => format!("{rel} (PHP {a}.{b})"),
                _ => rel.clone(),
            };
            let expected_errors = fixture.section("errors", *target);
            let fail = |msg: String| failures.lock().unwrap().push(msg);

            if expected_errors.is_some() && errors.is_empty() {
                fail(format!("expected parse errors in {at} but got none"));
                continue;
            }
            if expected_errors.is_none() && !errors.is_empty() {
                fail(format!("unexpected parse errors in {at}: {errors:?}"));
                continue;
            }
            if errors.is_empty() {
                let php_error = fixture.section("php_error", Some(target.unwrap_or(DEFAULT)));
                if php_error.is_some_and(|s| !s.body.trim().is_empty()) {
                    fail(format!(
                        "closure-check failure in {at}: php -l rejects this input but the parser \
                         emitted no diagnostics. Add a parser check or move the diagnostic into \
                         ===errors===."
                    ));
                    continue;
                }
            }
            if let Some(expected) = expected_errors {
                let actual = errors.join("\n");
                if actual != expected.body {
                    fail(format!(
                        "error messages mismatch in {at}\nexpected:\n{}\nactual:\n{actual}",
                        expected.body
                    ));
                    continue;
                }
            }
            match fixture.section("ast", *target) {
                None => fail(format!("missing ===ast=== section in {at}")),
                Some(expected) if expected.body != *json => fail(format!(
                    "AST mismatch in {at}\nexpected:\n{}\nactual:\n{json}",
                    expected.body
                )),
                Some(_) => {}
            }
        }
    });

    let f = failures.into_inner().unwrap();
    assert!(f.is_empty(), "fixture test failure(s):\n{}", f.join("\n\n"));
}

fn update_fixture(
    fixture: &mut Fixture,
    targets: &[Option<Version>],
    results: &[(Vec<String>, String)],
) {
    let multi = fixture.versions().is_some();
    let errors = targets
        .iter()
        .zip(results)
        .map(|(v, (e, _))| (*v, e.join("\n")))
        .collect();
    let asts = targets
        .iter()
        .zip(results)
        .map(|(v, (_, a))| (*v, a.clone()))
        .collect();
    fixture.replace_sections("errors", sections_for("errors", errors, multi, true));
    fixture.replace_sections("ast", sections_for("ast", asts, multi, false));
}

/// One section per run of consecutive versions with identical output.
fn sections_for(
    name: &str,
    outputs: Vec<(Option<Version>, String)>,
    multi: bool,
    skip_empty: bool,
) -> Vec<Section> {
    let section = |spec, body: String| Section {
        name: name.to_string(),
        spec,
        body,
    };
    if !multi {
        let body = outputs
            .into_iter()
            .next()
            .map(|(_, b)| b)
            .unwrap_or_default();
        return (!(skip_empty && body.is_empty()))
            .then(|| section(None, body))
            .into_iter()
            .collect();
    }
    let domain: Vec<Version> = outputs.iter().map(|(v, _)| v.unwrap()).collect();
    let mut sections = Vec::new();
    let mut start = 0;
    while start < outputs.len() {
        let mut end = start + 1;
        while end < outputs.len() && outputs[end].1 == outputs[start].1 {
            end += 1;
        }
        let body = outputs[start].1.clone();
        if !(skip_empty && body.is_empty()) {
            let spec = VersionSpec::for_run(&domain[start..end]);
            sections.push(section(Some(spec), body));
        }
        start = end;
    }
    sections
}
