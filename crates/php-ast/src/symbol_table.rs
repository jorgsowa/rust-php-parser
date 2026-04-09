/// Extracts top-level symbol declarations from a parsed AST.
///
/// Walks the AST once and collects all function, class, interface, trait, enum,
/// and constant declarations along with their namespace context and `use` imports.
/// This provides the foundation for name resolution and "go to definition" in
/// LSP-like tools.
///
/// # Example
///
/// ```
/// use php_ast::symbol_table::SymbolTable;
/// use php_ast::ast::Program;
///
/// // After parsing:
/// // let result = php_rs_parser::parse(&arena, source);
/// // let symbols = SymbolTable::build(&result.program);
/// // let classes = symbols.classes();
/// ```
use std::borrow::Cow;
use std::ops::ControlFlow;

use crate::ast::*;
use crate::visitor::{walk_enum_member, walk_stmt, Visitor};
use crate::Span;

/// The kind of a declared symbol.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
pub enum SymbolKind {
    Function,
    Class,
    Interface,
    Trait,
    Enum,
    Constant,
    Method,
    Property,
    ClassConstant,
    EnumCase,
}

/// A single symbol declaration extracted from the AST.
#[derive(Debug, Clone)]
pub struct Symbol<'src> {
    /// The symbol's short name (e.g. `"MyClass"`, `"doStuff"`).
    pub name: Cow<'src, str>,
    /// Fully qualified name including namespace (e.g. `"App\\Models\\User"`).
    pub fqn: String,
    pub kind: SymbolKind,
    pub span: Span,
    /// Visibility, if applicable (methods, properties, class constants).
    pub visibility: Option<Visibility>,
    /// The containing symbol's FQN, if this is a member (method, property, etc.).
    pub parent: Option<String>,
}

/// A `use` import declaration.
#[derive(Debug, Clone)]
pub struct UseImport<'src> {
    /// The imported name (e.g. `"App\\Models\\User"`).
    pub name: Cow<'src, str>,
    /// The local alias, or `None` if unaliased.
    pub alias: Option<&'src str>,
    pub kind: UseKind,
    pub span: Span,
}

impl<'src> UseImport<'src> {
    /// The local name this import introduces (alias or last segment).
    pub fn local_name(&self) -> &str {
        if let Some(alias) = self.alias {
            return alias;
        }
        self.name.rsplit('\\').next().unwrap_or(self.name.as_ref())
    }
}

/// Collected symbols and imports from a PHP source file.
pub struct SymbolTable<'src> {
    symbols: Vec<Symbol<'src>>,
    imports: Vec<UseImport<'src>>,
}

impl<'src> SymbolTable<'src> {
    /// Walk the program AST and extract all declarations.
    pub fn build<'arena>(program: &Program<'arena, 'src>) -> Self {
        let mut collector = SymbolCollector {
            symbols: Vec::new(),
            imports: Vec::new(),
            namespace: String::new(),
        };
        let _ = collector.visit_program(program);
        Self {
            symbols: collector.symbols,
            imports: collector.imports,
        }
    }

    /// All collected symbols.
    pub fn symbols(&self) -> &[Symbol<'src>] {
        &self.symbols
    }

    /// All `use` imports.
    pub fn imports(&self) -> &[UseImport<'src>] {
        &self.imports
    }

    /// Iterate symbols of a specific kind.
    pub fn symbols_of_kind(&self, kind: SymbolKind) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols.iter().filter(move |s| s.kind == kind)
    }

    /// Find a symbol by its fully qualified name.
    pub fn find_by_fqn(&self, fqn: &str) -> Option<&Symbol<'src>> {
        self.symbols.iter().find(|s| s.fqn == fqn)
    }

    /// Find all symbols at a given byte offset (i.e. whose span contains the offset).
    pub fn symbols_at(&self, offset: u32) -> Vec<&Symbol<'src>> {
        self.symbols
            .iter()
            .filter(|s| s.span.start <= offset && offset < s.span.end)
            .collect()
    }

    /// Resolve a simple (unqualified) name using the imports and current namespace.
    /// Returns the FQN if found, `None` otherwise.
    pub fn resolve_name(&self, name: &str) -> Option<&str> {
        // Check use imports first
        for import in &self.imports {
            if import.local_name() == name {
                return Some(&import.name);
            }
        }
        // Check if it's a top-level symbol in the file
        for sym in &self.symbols {
            if sym.name == name && sym.parent.is_none() {
                return Some(&sym.fqn);
            }
        }
        None
    }

    /// Convenience: all functions.
    pub fn functions(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Function)
    }

    /// Convenience: all classes.
    pub fn classes(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Class)
    }

    /// Convenience: all interfaces.
    pub fn interfaces(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Interface)
    }

    /// Convenience: all traits.
    pub fn traits(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Trait)
    }

    /// Convenience: all enums.
    pub fn enums(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Enum)
    }

    /// Convenience: all constants.
    pub fn constants(&self) -> impl Iterator<Item = &Symbol<'src>> {
        self.symbols_of_kind(SymbolKind::Constant)
    }

    /// Get all members (methods, properties, class constants, enum cases) of a given parent FQN.
    pub fn members_of<'a>(&'a self, parent_fqn: &'a str) -> impl Iterator<Item = &'a Symbol<'src>> {
        self.symbols
            .iter()
            .filter(move |s| s.parent.as_deref() == Some(parent_fqn))
    }
}

struct SymbolCollector<'src> {
    symbols: Vec<Symbol<'src>>,
    imports: Vec<UseImport<'src>>,
    namespace: String,
}

impl<'src> SymbolCollector<'src> {
    fn fqn(&self, name: &str) -> String {
        if self.namespace.is_empty() {
            name.to_string()
        } else {
            format!("{}\\{}", self.namespace, name)
        }
    }

    fn add_class_members<'arena>(
        &mut self,
        parent_fqn: &str,
        members: &[ClassMember<'arena, 'src>],
    ) {
        for member in members {
            match &member.kind {
                ClassMemberKind::Method(method) => {
                    self.symbols.push(Symbol {
                        name: Cow::Borrowed(method.name),
                        fqn: format!("{}::{}", parent_fqn, method.name),
                        kind: SymbolKind::Method,
                        span: member.span,
                        visibility: method.visibility,
                        parent: Some(parent_fqn.to_string()),
                    });
                }
                ClassMemberKind::Property(prop) => {
                    self.symbols.push(Symbol {
                        name: Cow::Borrowed(prop.name),
                        fqn: format!("{}::${}", parent_fqn, prop.name),
                        kind: SymbolKind::Property,
                        span: member.span,
                        visibility: prop.visibility,
                        parent: Some(parent_fqn.to_string()),
                    });
                }
                ClassMemberKind::ClassConst(cc) => {
                    self.symbols.push(Symbol {
                        name: Cow::Borrowed(cc.name),
                        fqn: format!("{}::{}", parent_fqn, cc.name),
                        kind: SymbolKind::ClassConstant,
                        span: member.span,
                        visibility: cc.visibility,
                        parent: Some(parent_fqn.to_string()),
                    });
                }
                ClassMemberKind::TraitUse(_) => {}
            }
        }
    }
}

impl<'arena, 'src> Visitor<'arena, 'src> for SymbolCollector<'src> {
    fn visit_stmt(&mut self, stmt: &Stmt<'arena, 'src>) -> ControlFlow<()> {
        match &stmt.kind {
            StmtKind::Namespace(ns) => {
                let prev_ns = self.namespace.clone();
                if let Some(name) = &ns.name {
                    self.namespace = name.join_parts().into_owned();
                }
                if let NamespaceBody::Braced(stmts) = &ns.body {
                    for s in stmts.iter() {
                        self.visit_stmt(s)?;
                    }
                }
                self.namespace = prev_ns;
                return ControlFlow::Continue(());
            }
            StmtKind::Use(use_decl) => {
                for item in use_decl.uses.iter() {
                    self.imports.push(UseImport {
                        name: item.name.join_parts(),
                        alias: item.alias,
                        kind: item.kind.unwrap_or(use_decl.kind),
                        span: item.name.span(),
                    });
                }
                return ControlFlow::Continue(());
            }
            StmtKind::Function(func) => {
                self.symbols.push(Symbol {
                    name: Cow::Borrowed(func.name),
                    fqn: self.fqn(func.name),
                    kind: SymbolKind::Function,
                    span: stmt.span,
                    visibility: None,
                    parent: None,
                });
            }
            StmtKind::Class(class) => {
                if let Some(name) = class.name {
                    let fqn = self.fqn(name);
                    self.symbols.push(Symbol {
                        name: Cow::Borrowed(name),
                        fqn: fqn.clone(),
                        kind: SymbolKind::Class,
                        span: stmt.span,
                        visibility: None,
                        parent: None,
                    });
                    self.add_class_members(&fqn, &class.members);
                }
            }
            StmtKind::Interface(iface) => {
                let fqn = self.fqn(iface.name);
                self.symbols.push(Symbol {
                    name: Cow::Borrowed(iface.name),
                    fqn: fqn.clone(),
                    kind: SymbolKind::Interface,
                    span: stmt.span,
                    visibility: None,
                    parent: None,
                });
                self.add_class_members(&fqn, &iface.members);
            }
            StmtKind::Trait(trait_decl) => {
                let fqn = self.fqn(trait_decl.name);
                self.symbols.push(Symbol {
                    name: Cow::Borrowed(trait_decl.name),
                    fqn: fqn.clone(),
                    kind: SymbolKind::Trait,
                    span: stmt.span,
                    visibility: None,
                    parent: None,
                });
                self.add_class_members(&fqn, &trait_decl.members);
            }
            StmtKind::Enum(enum_decl) => {
                let fqn = self.fqn(enum_decl.name);
                self.symbols.push(Symbol {
                    name: Cow::Borrowed(enum_decl.name),
                    fqn: fqn.clone(),
                    kind: SymbolKind::Enum,
                    span: stmt.span,
                    visibility: None,
                    parent: None,
                });
                for member in enum_decl.members.iter() {
                    match &member.kind {
                        EnumMemberKind::Case(case) => {
                            self.symbols.push(Symbol {
                                name: Cow::Borrowed(case.name),
                                fqn: format!("{}::{}", fqn, case.name),
                                kind: SymbolKind::EnumCase,
                                span: member.span,
                                visibility: None,
                                parent: Some(fqn.clone()),
                            });
                        }
                        EnumMemberKind::Method(method) => {
                            self.symbols.push(Symbol {
                                name: Cow::Borrowed(method.name),
                                fqn: format!("{}::{}", fqn, method.name),
                                kind: SymbolKind::Method,
                                span: member.span,
                                visibility: method.visibility,
                                parent: Some(fqn.clone()),
                            });
                        }
                        EnumMemberKind::ClassConst(cc) => {
                            self.symbols.push(Symbol {
                                name: Cow::Borrowed(cc.name),
                                fqn: format!("{}::{}", fqn, cc.name),
                                kind: SymbolKind::ClassConstant,
                                span: member.span,
                                visibility: cc.visibility,
                                parent: Some(fqn.clone()),
                            });
                        }
                        EnumMemberKind::TraitUse(_) => {}
                    }
                    walk_enum_member(self, member)?;
                }
                return ControlFlow::Continue(());
            }
            StmtKind::Const(items) => {
                for item in items.iter() {
                    self.symbols.push(Symbol {
                        name: Cow::Borrowed(item.name),
                        fqn: self.fqn(item.name),
                        kind: SymbolKind::Constant,
                        span: item.span,
                        visibility: None,
                        parent: None,
                    });
                }
            }
            _ => {}
        }
        walk_stmt(self, stmt)
    }

    // Don't recurse into expressions — we only want declarations
    fn visit_expr(&mut self, _expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
        ControlFlow::Continue(())
    }
}

#[cfg(test)]
mod tests {
    use super::*;
    use crate::ast::ArenaVec;

    // Helper to build a simple program with statements
    fn build_table<'arena, 'src>(
        _arena: &'arena bumpalo::Bump,
        stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    ) -> SymbolTable<'src> {
        let program = Program {
            stmts,
            span: Span::DUMMY,
        };
        SymbolTable::build(&program)
    }

    #[test]
    fn collects_function() {
        let arena = bumpalo::Bump::new();
        let func = arena.alloc(FunctionDecl {
            name: "doStuff",
            params: ArenaVec::new_in(&arena),
            body: ArenaVec::new_in(&arena),
            return_type: None,
            by_ref: false,
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        });
        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Function(func),
            span: Span::new(0, 30),
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.symbols().len(), 1);
        assert_eq!(table.symbols()[0].name, "doStuff");
        assert_eq!(table.symbols()[0].fqn, "doStuff");
        assert_eq!(table.symbols()[0].kind, SymbolKind::Function);
    }

    #[test]
    fn collects_namespaced_class_with_members() {
        let arena = bumpalo::Bump::new();

        // Method
        let method = MethodDecl {
            name: "getName",
            visibility: Some(Visibility::Public),
            is_static: false,
            is_abstract: false,
            is_final: false,
            by_ref: false,
            params: ArenaVec::new_in(&arena),
            return_type: None,
            body: Some(ArenaVec::new_in(&arena)),
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        };
        let mut members = ArenaVec::new_in(&arena);
        members.push(ClassMember {
            kind: ClassMemberKind::Method(method),
            span: Span::new(40, 60),
        });

        let class = arena.alloc(ClassDecl {
            name: Some("User"),
            modifiers: ClassModifiers::default(),
            extends: None,
            implements: ArenaVec::new_in(&arena),
            members,
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        });

        let ns = arena.alloc(NamespaceDecl {
            name: Some(Name::Simple {
                value: "App",
                span: Span::DUMMY,
            }),
            body: NamespaceBody::Braced({
                let mut inner = ArenaVec::new_in(&arena);
                inner.push(Stmt {
                    kind: StmtKind::Class(class),
                    span: Span::new(20, 80),
                });
                inner
            }),
        });

        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Namespace(ns),
            span: Span::new(0, 100),
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.symbols().len(), 2);
        assert_eq!(table.symbols()[0].fqn, "App\\User");
        assert_eq!(table.symbols()[0].kind, SymbolKind::Class);
        assert_eq!(table.symbols()[1].fqn, "App\\User::getName");
        assert_eq!(table.symbols()[1].kind, SymbolKind::Method);
        assert_eq!(table.symbols()[1].parent.as_deref(), Some("App\\User"));

        // members_of
        let members: Vec<_> = table.members_of("App\\User").collect();
        assert_eq!(members.len(), 1);
        assert_eq!(members[0].name, "getName");
    }

    #[test]
    fn collects_use_imports() {
        let arena = bumpalo::Bump::new();

        let mut uses = ArenaVec::new_in(&arena);
        uses.push(UseItem {
            name: Name::Simple {
                value: "Foo",
                span: Span::new(4, 7),
            },
            alias: Some("Bar"),
            kind: None,
            span: Span::new(4, 7),
        });

        let use_decl = arena.alloc(UseDecl {
            kind: UseKind::Normal,
            uses,
        });

        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Use(use_decl),
            span: Span::new(0, 15),
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.imports().len(), 1);
        assert_eq!(table.imports()[0].name, "Foo");
        assert_eq!(table.imports()[0].alias, Some("Bar"));
        assert_eq!(table.imports()[0].local_name(), "Bar");
    }

    #[test]
    fn resolve_name_from_imports() {
        let arena = bumpalo::Bump::new();

        let mut uses = ArenaVec::new_in(&arena);
        uses.push(UseItem {
            name: Name::Simple {
                value: "User",
                span: Span::DUMMY,
            },
            alias: None,
            kind: None,
            span: Span::DUMMY,
        });

        let use_decl = arena.alloc(UseDecl {
            kind: UseKind::Normal,
            uses,
        });

        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Use(use_decl),
            span: Span::DUMMY,
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.resolve_name("User"), Some("User"));
        assert_eq!(table.resolve_name("Unknown"), None);
    }

    #[test]
    fn symbols_at_offset() {
        let arena = bumpalo::Bump::new();
        let func = arena.alloc(FunctionDecl {
            name: "foo",
            params: ArenaVec::new_in(&arena),
            body: ArenaVec::new_in(&arena),
            return_type: None,
            by_ref: false,
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        });
        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Function(func),
            span: Span::new(10, 50),
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.symbols_at(25).len(), 1);
        assert_eq!(table.symbols_at(5).len(), 0);
        assert_eq!(table.symbols_at(50).len(), 0);
    }

    #[test]
    fn collects_enum_cases() {
        let arena = bumpalo::Bump::new();

        let mut members = ArenaVec::new_in(&arena);
        members.push(EnumMember {
            kind: EnumMemberKind::Case(EnumCase {
                name: "Hearts",
                value: None,
                attributes: ArenaVec::new_in(&arena),
                doc_comment: None,
            }),
            span: Span::new(30, 45),
        });

        let enum_decl = arena.alloc(EnumDecl {
            name: "Suit",
            scalar_type: None,
            implements: ArenaVec::new_in(&arena),
            members,
            attributes: ArenaVec::new_in(&arena),
            doc_comment: None,
        });

        let mut stmts = ArenaVec::new_in(&arena);
        stmts.push(Stmt {
            kind: StmtKind::Enum(enum_decl),
            span: Span::new(0, 60),
        });

        let table = build_table(&arena, stmts);
        assert_eq!(table.enums().count(), 1);
        let cases: Vec<_> = table.symbols_of_kind(SymbolKind::EnumCase).collect();
        assert_eq!(cases.len(), 1);
        assert_eq!(cases[0].fqn, "Suit::Hearts");
        assert_eq!(cases[0].parent.as_deref(), Some("Suit"));
    }
}
