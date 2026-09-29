//! Namespace-aware name resolution for `use` imports.

use std::collections::HashMap;

use crate::ast::{NameKind, NamespaceDecl, Stmt, StmtKind, UseKind};
use crate::owned;

/// Which import table a name is looked up in.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
pub enum NameContext {
    /// Classes, interfaces, traits, enums.
    Class,
    Function,
    Const,
}

/// Result of resolving a name against the current namespace and imports.
#[derive(Debug, Clone, PartialEq, Eq)]
pub enum ResolvedName {
    /// Fully qualified name without a leading backslash.
    Fqn(String),
    /// Unqualified function/const in a namespace with no matching import:
    /// PHP tries `namespaced` first, then `global`.
    Fallback { namespaced: String, global: String },
    /// `self`, `static` or `parent` (lowercase); needs class context to resolve.
    Special(&'static str),
    /// Synthesised error-recovery name.
    Error,
}

/// Tracks the current namespace and `use` imports and resolves names against them.
///
/// Feed every statement to [`observe_stmt`](Self::observe_stmt) in source order
/// (e.g. from `ScopeVisitor::visit_stmt`), then call [`resolve_name`](Self::resolve_name).
/// Imports are cleared at each `namespace` statement; they are not popped at the end
/// of a braced namespace block.
///
/// Builtin type names (`int`, `string`, …) are not special-cased.
#[derive(Debug, Clone, Default)]
pub struct NameResolver {
    namespace: Option<String>,
    classes: HashMap<String, String>,
    functions: HashMap<String, String>,
    consts: HashMap<String, String>,
}

impl NameResolver {
    pub fn new() -> Self {
        Self::default()
    }

    /// Current namespace, or `None` for the global namespace.
    pub fn namespace(&self) -> Option<&str> {
        self.namespace.as_deref()
    }

    /// Enters `namespace` and clears all imports.
    pub fn enter_namespace(&mut self, namespace: Option<&str>) {
        self.namespace = namespace.filter(|n| !n.is_empty()).map(str::to_owned);
        self.classes.clear();
        self.functions.clear();
        self.consts.clear();
    }

    /// Registers an import. `fqn` may carry a leading backslash; `alias` defaults
    /// to the last segment of `fqn`.
    pub fn add_import(&mut self, kind: UseKind, fqn: &str, alias: Option<&str>) {
        let fqn = fqn.trim_start_matches('\\');
        let local = alias.unwrap_or_else(|| fqn.rsplit('\\').next().unwrap_or(fqn));
        if local.is_empty() {
            return;
        }
        match kind {
            UseKind::Normal => self
                .classes
                .insert(local.to_ascii_lowercase(), fqn.to_owned()),
            UseKind::Function => self
                .functions
                .insert(local.to_ascii_lowercase(), fqn.to_owned()),
            UseKind::Const => self.consts.insert(local.to_owned(), fqn.to_owned()),
        };
    }

    /// Updates state for `namespace` and `use` statements; ignores everything else.
    pub fn observe_stmt(&mut self, stmt: &Stmt<'_, '_>) {
        match &stmt.kind {
            StmtKind::Namespace(ns) => self.observe_namespace(ns),
            StmtKind::Use(decl) => {
                for item in decl.uses.iter() {
                    self.add_import(
                        item.kind.unwrap_or(decl.kind),
                        &item.name.join_parts(),
                        item.alias,
                    );
                }
            }
            _ => {}
        }
    }

    fn observe_namespace(&mut self, ns: &NamespaceDecl<'_, '_>) {
        let name = ns.name.as_ref().map(|n| n.join_parts());
        self.enter_namespace(name.as_deref());
    }

    /// Owned-AST counterpart of [`observe_stmt`](Self::observe_stmt).
    pub fn observe_owned_stmt(&mut self, stmt: &owned::Stmt) {
        match &stmt.kind {
            owned::StmtKind::Namespace(ns) => {
                let name = ns.name.as_ref().map(|n| n.parts.join("\\"));
                self.enter_namespace(name.as_deref());
            }
            owned::StmtKind::Use(decl) => {
                for item in decl.uses.iter() {
                    self.add_import(
                        item.kind.unwrap_or(decl.kind),
                        &item.name.parts.join("\\"),
                        item.alias.as_deref(),
                    );
                }
            }
            _ => {}
        }
    }

    /// Resolves a borrowed-AST name.
    pub fn resolve_name(&self, name: &crate::ast::Name<'_, '_>, ctx: NameContext) -> ResolvedName {
        self.resolve(ctx, name.kind(), name.parts_slice())
    }

    /// Resolves an owned-AST name.
    pub fn resolve_owned_name(&self, name: &owned::Name, ctx: NameContext) -> ResolvedName {
        self.resolve(ctx, name.kind, &name.parts)
    }

    /// Resolves a name given as its kind and `\`-separated segments.
    pub fn resolve<S: AsRef<str>>(
        &self,
        ctx: NameContext,
        kind: NameKind,
        parts: &[S],
    ) -> ResolvedName {
        let join = |parts: &[S]| {
            parts
                .iter()
                .map(AsRef::as_ref)
                .collect::<Vec<_>>()
                .join("\\")
        };
        if parts.is_empty() || kind == NameKind::Error {
            return ResolvedName::Error;
        }
        match kind {
            NameKind::FullyQualified => ResolvedName::Fqn(join(parts)),
            NameKind::Relative => ResolvedName::Fqn(self.prefix_namespace(&join(parts))),
            NameKind::Qualified => {
                let first = parts[0].as_ref().to_ascii_lowercase();
                match self.classes.get(&first) {
                    Some(target) => ResolvedName::Fqn(format!("{target}\\{}", join(&parts[1..]))),
                    None => ResolvedName::Fqn(self.prefix_namespace(&join(parts))),
                }
            }
            _ => self.resolve_unqualified(ctx, parts[0].as_ref()),
        }
    }

    fn resolve_unqualified(&self, ctx: NameContext, name: &str) -> ResolvedName {
        match ctx {
            NameContext::Class => {
                let lower = name.to_ascii_lowercase();
                match lower.as_str() {
                    "self" => return ResolvedName::Special("self"),
                    "static" => return ResolvedName::Special("static"),
                    "parent" => return ResolvedName::Special("parent"),
                    _ => {}
                }
                match self.classes.get(&lower) {
                    Some(target) => ResolvedName::Fqn(target.clone()),
                    None => ResolvedName::Fqn(self.prefix_namespace(name)),
                }
            }
            NameContext::Function | NameContext::Const => {
                let imported = if ctx == NameContext::Function {
                    self.functions.get(&name.to_ascii_lowercase())
                } else {
                    self.consts.get(name)
                };
                match (imported, &self.namespace) {
                    (Some(target), _) => ResolvedName::Fqn(target.clone()),
                    (None, Some(ns)) => ResolvedName::Fallback {
                        namespaced: format!("{ns}\\{name}"),
                        global: name.to_owned(),
                    },
                    (None, None) => ResolvedName::Fqn(name.to_owned()),
                }
            }
        }
    }

    fn prefix_namespace(&self, name: &str) -> String {
        match &self.namespace {
            Some(ns) => format!("{ns}\\{name}"),
            None => name.to_owned(),
        }
    }
}

#[cfg(test)]
mod tests {
    use super::*;

    fn fqn(s: &str) -> ResolvedName {
        ResolvedName::Fqn(s.into())
    }

    fn resolver() -> NameResolver {
        let mut r = NameResolver::new();
        r.enter_namespace(Some("App"));
        r.add_import(UseKind::Normal, "Lib\\Foo", None);
        r.add_import(UseKind::Normal, "\\Lib\\Bar", Some("Baz"));
        r.add_import(UseKind::Function, "Lib\\helper", None);
        r.add_import(UseKind::Const, "Lib\\LIMIT", None);
        r
    }

    #[test]
    fn class_names() {
        let r = resolver();
        let c = NameContext::Class;
        assert_eq!(
            r.resolve(c, NameKind::Unqualified, &["foo"]),
            fqn("Lib\\Foo")
        );
        assert_eq!(
            r.resolve(c, NameKind::Unqualified, &["Baz"]),
            fqn("Lib\\Bar")
        );
        assert_eq!(
            r.resolve(c, NameKind::Unqualified, &["Other"]),
            fqn("App\\Other")
        );
        assert_eq!(
            r.resolve(c, NameKind::Qualified, &["Foo", "X"]),
            fqn("Lib\\Foo\\X")
        );
        assert_eq!(
            r.resolve(c, NameKind::Qualified, &["Sub", "X"]),
            fqn("App\\Sub\\X")
        );
        assert_eq!(r.resolve(c, NameKind::FullyQualified, &["Foo"]), fqn("Foo"));
        assert_eq!(r.resolve(c, NameKind::Relative, &["Foo"]), fqn("App\\Foo"));
        assert_eq!(
            r.resolve(c, NameKind::Unqualified, &["Self"]),
            ResolvedName::Special("self")
        );
    }

    #[test]
    fn function_and_const_names() {
        let r = resolver();
        assert_eq!(
            r.resolve(NameContext::Function, NameKind::Unqualified, &["HELPER"]),
            fqn("Lib\\helper")
        );
        assert_eq!(
            r.resolve(NameContext::Function, NameKind::Unqualified, &["strlen"]),
            ResolvedName::Fallback {
                namespaced: "App\\strlen".into(),
                global: "strlen".into()
            }
        );
        assert_eq!(
            r.resolve(NameContext::Const, NameKind::Unqualified, &["LIMIT"]),
            fqn("Lib\\LIMIT")
        );
        // Const imports are case-sensitive.
        assert!(matches!(
            r.resolve(NameContext::Const, NameKind::Unqualified, &["limit"]),
            ResolvedName::Fallback { .. }
        ));
    }

    #[test]
    fn global_namespace_and_reset() {
        let mut r = resolver();
        r.enter_namespace(None);
        assert_eq!(
            r.resolve(NameContext::Function, NameKind::Unqualified, &["strlen"]),
            fqn("strlen")
        );
        assert_eq!(
            r.resolve(NameContext::Class, NameKind::Unqualified, &["Foo"]),
            fqn("Foo")
        );
    }

    #[test]
    fn error_name() {
        let r = NameResolver::new();
        assert_eq!(
            r.resolve::<&str>(NameContext::Class, NameKind::Error, &[]),
            ResolvedName::Error
        );
    }
}
