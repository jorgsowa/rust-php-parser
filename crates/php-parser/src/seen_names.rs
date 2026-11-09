use std::collections::HashSet;
use std::hash::{Hash, Hasher};

/// Entries scanned linearly before switching to a hash set; most scopes declare fewer names.
const LINEAR_LIMIT: usize = 16;

/// A set of source names for duplicate checks, compared case-insensitively or exactly.
pub(crate) struct SeenNames<'src> {
    case_insensitive: bool,
    small: Vec<&'src str>,
    large: HashSet<Key<'src>>,
}

impl<'src> SeenNames<'src> {
    /// A set comparing names with ASCII case folded, as PHP does for classes, functions and methods.
    pub(crate) fn case_insensitive() -> Self {
        Self::new(true)
    }

    /// A set comparing names exactly, as PHP does for properties and constants.
    pub(crate) fn case_sensitive() -> Self {
        Self::new(false)
    }

    fn new(case_insensitive: bool) -> Self {
        Self {
            case_insensitive,
            small: Vec::new(),
            large: HashSet::new(),
        }
    }

    /// Adds `name`; returns `false` when an equal name was already present.
    pub(crate) fn insert(&mut self, name: &'src str) -> bool {
        let ci = self.case_insensitive;
        if self.large.is_empty() {
            let equal = |seen: &&str| {
                if ci {
                    seen.eq_ignore_ascii_case(name)
                } else {
                    *seen == name
                }
            };
            if self.small.iter().any(equal) {
                return false;
            }
            if self.small.len() < LINEAR_LIMIT {
                self.small.push(name);
                return true;
            }
            self.large
                .extend(self.small.drain(..).map(|name| Key { name, ci }));
        }
        self.large.insert(Key { name, ci })
    }

    pub(crate) fn clear(&mut self) {
        self.small.clear();
        self.large.clear();
    }
}

struct Key<'src> {
    name: &'src str,
    ci: bool,
}

/// A map key comparing source names with ASCII case folded.
#[derive(Clone, Copy)]
pub(crate) struct CaseInsensitive<'src>(pub(crate) &'src str);

impl PartialEq for CaseInsensitive<'_> {
    fn eq(&self, other: &Self) -> bool {
        self.0.eq_ignore_ascii_case(other.0)
    }
}

impl Eq for CaseInsensitive<'_> {}

impl Hash for CaseInsensitive<'_> {
    fn hash<H: Hasher>(&self, state: &mut H) {
        hash_lowercase(self.0, state);
    }
}

fn hash_lowercase<H: Hasher>(name: &str, state: &mut H) {
    let mut buf = [0u8; 32];
    for chunk in name.as_bytes().chunks(buf.len()) {
        let lower = &mut buf[..chunk.len()];
        lower.copy_from_slice(chunk);
        lower.make_ascii_lowercase();
        state.write(lower);
    }
    state.write_u8(0xff);
}

impl PartialEq for Key<'_> {
    fn eq(&self, other: &Self) -> bool {
        if self.ci {
            self.name.eq_ignore_ascii_case(other.name)
        } else {
            self.name == other.name
        }
    }
}

impl Eq for Key<'_> {}

impl Hash for Key<'_> {
    fn hash<H: Hasher>(&self, state: &mut H) {
        if self.ci {
            hash_lowercase(self.name, state);
        } else {
            self.name.hash(state);
        }
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn detects_duplicates_past_the_linear_limit() {
        let names: Vec<String> = (0..40).map(|i| format!("Name{i}")).collect();
        for ci in [true, false] {
            let mut seen = SeenNames::new(ci);
            for name in &names {
                assert!(seen.insert(name));
            }
            for name in &names {
                assert!(!seen.insert(name));
            }
            let upper: Vec<String> = names.iter().map(|n| n.to_ascii_uppercase()).collect();
            for name in &upper {
                assert_eq!(seen.insert(name), !ci, "{name} ci={ci}");
            }
            seen.clear();
            assert!(seen.insert("name0"));
        }
    }
}
