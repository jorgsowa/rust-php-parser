use std::collections::HashMap;
use std::ops::ControlFlow;
use std::path::Path;
use std::sync::Mutex;

use bumpalo::Bump;
use ignore::WalkBuilder;
use php_ast::ast::*;
use php_ast::visitor::{walk_class_member, walk_expr, walk_param, walk_stmt, Visitor};
use php_rs_parser::parse;
use rayon::prelude::*;
use serde::Serialize;

#[derive(Default)]
struct NodeCounter {
    counts: HashMap<&'static str, u64>,
}

impl NodeCounter {
    fn bump(&mut self, key: &'static str) {
        *self.counts.entry(key).or_insert(0) += 1;
    }

    fn total_nodes(&self) -> u64 {
        self.counts.values().sum()
    }

    fn merge(&mut self, other: NodeCounter) {
        for (k, v) in other.counts {
            *self.counts.entry(k).or_insert(0) += v;
        }
    }
}

impl<'a, 'src> Visitor<'a, 'src> for NodeCounter {
    fn visit_stmt(&mut self, stmt: &Stmt<'a, 'src>) -> ControlFlow<()> {
        let name = match &stmt.kind {
            StmtKind::Expression(_) => "Expression",
            StmtKind::Echo(_) => "Echo",
            StmtKind::Return(_) => "Return",
            StmtKind::Block(_) => "Block",
            StmtKind::If(_) => "If",
            StmtKind::While(_) => "While",
            StmtKind::For(_) => "For",
            StmtKind::Foreach(_) => "Foreach",
            StmtKind::DoWhile(_) => "DoWhile",
            StmtKind::Function(_) => "Function",
            StmtKind::Break(_) => "Break",
            StmtKind::Continue(_) => "Continue",
            StmtKind::Switch(_) => "Switch",
            StmtKind::Goto(_) => "Goto",
            StmtKind::Label(_) => "Label",
            StmtKind::Declare(_) => "Declare",
            StmtKind::Unset(_) => "Unset",
            StmtKind::Throw(_) => "Throw",
            StmtKind::TryCatch(_) => "TryCatch",
            StmtKind::Global(_) => "Global",
            StmtKind::Class(_) => "Class",
            StmtKind::Interface(_) => "Interface",
            StmtKind::Trait(_) => "Trait",
            StmtKind::Enum(_) => "Enum",
            StmtKind::Namespace(_) => "Namespace",
            StmtKind::Use(_) => "Use",
            StmtKind::Const(_) => "Const",
            StmtKind::InlineHtml(_) => "InlineHtml",
            StmtKind::StaticVar(_) => "StaticVar",
            StmtKind::HaltCompiler(_) => "HaltCompiler",
            StmtKind::Nop => "Nop",
            StmtKind::Error => "Error",
        };
        self.bump(name);
        walk_stmt(self, stmt)
    }

    fn visit_expr(&mut self, expr: &Expr<'a, 'src>) -> ControlFlow<()> {
        match &expr.kind {
            ExprKind::Int(_) => self.bump("Int"),
            ExprKind::Float(_) => self.bump("Float"),
            ExprKind::String(_) => self.bump("String"),
            ExprKind::InterpolatedString(_) => self.bump("InterpolatedString"),
            ExprKind::Heredoc { .. } => self.bump("Heredoc"),
            ExprKind::Nowdoc { .. } => self.bump("Nowdoc"),
            ExprKind::ShellExec(_) => self.bump("ShellExec"),
            ExprKind::Bool(_) => self.bump("Bool"),
            ExprKind::Null => self.bump("Null"),
            ExprKind::Variable(_) => self.bump("Variable"),
            ExprKind::VariableVariable(_) => self.bump("VariableVariable"),
            ExprKind::Identifier(_) => self.bump("Identifier"),
            ExprKind::Assign(_) => self.bump("Assign"),
            ExprKind::Binary(_) => self.bump("Binary"),
            ExprKind::UnaryPrefix(_) => self.bump("UnaryPrefix"),
            ExprKind::UnaryPostfix(_) => self.bump("UnaryPostfix"),
            ExprKind::Ternary(_) => self.bump("Ternary"),
            ExprKind::NullCoalesce(_) => self.bump("NullCoalesce"),
            ExprKind::FunctionCall(_) => self.bump("FunctionCall"),
            ExprKind::Array(_) => self.bump("Array"),
            ExprKind::ArrayAccess(_) => self.bump("ArrayAccess"),
            ExprKind::Print(_) => self.bump("Print"),
            ExprKind::Parenthesized(_) => self.bump("Parenthesized"),
            ExprKind::Cast(_, _) => self.bump("Cast"),
            ExprKind::ErrorSuppress(_) => self.bump("ErrorSuppress"),
            ExprKind::Isset(_) => self.bump("Isset"),
            ExprKind::Empty(_) => self.bump("Empty"),
            ExprKind::Include(_, _) => self.bump("Include"),
            ExprKind::Eval(_) => self.bump("Eval"),
            ExprKind::Exit(_) => self.bump("Exit"),
            ExprKind::MagicConst(_) => self.bump("MagicConst"),
            ExprKind::Clone(_) => self.bump("Clone"),
            ExprKind::CloneWith(_, _) => self.bump("CloneWith"),
            ExprKind::New(_) => self.bump("New"),
            ExprKind::PropertyAccess(_) => self.bump("PropertyAccess"),
            ExprKind::NullsafePropertyAccess(_) => self.bump("NullsafePropertyAccess"),
            ExprKind::MethodCall(_) => self.bump("MethodCall"),
            ExprKind::NullsafeMethodCall(_) => self.bump("NullsafeMethodCall"),
            ExprKind::StaticPropertyAccess(_) => self.bump("StaticPropertyAccess"),
            ExprKind::StaticMethodCall(_) => self.bump("StaticMethodCall"),
            ExprKind::StaticDynMethodCall(_) => self.bump("StaticDynMethodCall"),
            ExprKind::ClassConstAccess(_) => self.bump("ClassConstAccess"),
            ExprKind::ClassConstAccessDynamic { .. } => self.bump("ClassConstAccessDynamic"),
            ExprKind::StaticPropertyAccessDynamic { .. } => {
                self.bump("StaticPropertyAccessDynamic")
            }
            ExprKind::Closure(c) => {
                self.bump("Closure");
                // mutually exclusive: static > use > plain
                if c.is_static {
                    self.bump("Closure (static)");
                } else if !c.use_vars.is_empty() {
                    self.bump("Closure (use)");
                } else {
                    self.bump("Closure (plain)");
                }
            }
            ExprKind::ArrowFunction(f) => {
                self.bump("ArrowFunction");
                if f.is_static {
                    self.bump("ArrowFunction (static)");
                } else {
                    self.bump("ArrowFunction (plain)");
                }
            }
            ExprKind::Match(_) => self.bump("Match"),
            ExprKind::Yield(_) => self.bump("Yield"),
            ExprKind::ThrowExpr(_) => self.bump("ThrowExpr"),
            ExprKind::AnonymousClass(_) => self.bump("AnonymousClass"),
            ExprKind::CallableCreate(_) => self.bump("CallableCreate"),
            ExprKind::Omit => self.bump("Omit"),
            ExprKind::Error => self.bump("Error"),
        }
        walk_expr(self, expr)
    }

    fn visit_class_member(&mut self, member: &ClassMember<'a, 'src>) -> ControlFlow<()> {
        match &member.kind {
            ClassMemberKind::Property(prop) => {
                self.bump("Property");
                // mutually exclusive: hooked > readonly > static > typed > plain
                if !prop.hooks.is_empty() {
                    self.bump("Property (hooked)");
                } else if prop.is_readonly {
                    self.bump("Property (readonly)");
                } else if prop.is_static {
                    self.bump("Property (static)");
                } else if prop.type_hint.is_some() {
                    self.bump("Property (typed)");
                } else {
                    self.bump("Property (plain)");
                }
            }
            ClassMemberKind::Method(method) => {
                self.bump("Method");
                // mutually exclusive: abstract > final > static > typed > plain
                if method.is_abstract {
                    self.bump("Method (abstract)");
                } else if method.is_final {
                    self.bump("Method (final)");
                } else if method.is_static {
                    self.bump("Method (static)");
                } else if method.return_type.is_some() {
                    self.bump("Method (typed return)");
                } else {
                    self.bump("Method (plain)");
                }
            }
            ClassMemberKind::ClassConst(_) => {
                self.bump("ClassConst");
            }
            ClassMemberKind::TraitUse(_) => {
                self.bump("TraitUse");
            }
        }
        walk_class_member(self, member)
    }

    fn visit_param(&mut self, param: &Param<'a, 'src>) -> ControlFlow<()> {
        self.bump("Param");
        // mutually exclusive: promoted > readonly > variadic > typed > plain
        if param.visibility.is_some() {
            self.bump("Param (promoted)");
        } else if param.is_readonly {
            self.bump("Param (readonly)");
        } else if param.variadic {
            self.bump("Param (variadic)");
        } else if param.type_hint.is_some() {
            self.bump("Param (typed)");
        } else {
            self.bump("Param (plain)");
        }
        walk_param(self, param)
    }
}

fn is_test_path(path: &Path) -> bool {
    path.components().any(|c| {
        matches!(
            c.as_os_str().to_str(),
            Some(
                "Tests"
                    | "tests"
                    | "Fixtures"
                    | "fixtures"
                    | "spec"
                    | "Spec"
                    | "Resources"
                    | "resources"
            )
        )
    })
}

fn collect_php_files(dirs: &[&Path]) -> Vec<std::path::PathBuf> {
    let mut files = Vec::new();
    for dir in dirs {
        if !dir.exists() {
            continue;
        }
        let iter = WalkBuilder::new(dir)
            .follow_links(false)
            .build()
            .filter_map(|e| e.ok())
            .filter(|e| {
                e.file_type().is_some_and(|ft| ft.is_file())
                    && e.path().extension().and_then(|s| s.to_str()) == Some("php")
            })
            .map(|e| e.path().to_path_buf());
        files.extend(iter);
    }
    files
}

#[derive(Serialize)]
struct DirStats {
    files: u64,
    total_nodes: u64,
    nodes: HashMap<&'static str, u64>,
}

#[derive(Serialize)]
struct ProjectStats {
    name: String,
    slug: String,
    repo: String,
    version: String,
    scanned_dirs: Vec<String>,
    files: u64,
    total_nodes: u64,
    nodes: HashMap<&'static str, u64>,
    /// All directories found under scanned_dirs (relative to project base), sorted.
    /// Includes directories excluded from PHP collection (tests, fixtures, resources).
    all_dirs: Vec<String>,
    /// Per-directory stats keyed by directory path relative to project base.
    /// Each entry covers only files whose parent directory matches the key exactly.
    /// Clients aggregate ancestors by prefix-summing descendants.
    dir_stats: HashMap<String, DirStats>,
}

fn count_file_list(files: &[std::path::PathBuf]) -> NodeCounter {
    let merged = Mutex::new(NodeCounter::default());
    files.par_iter().for_each(|path| {
        let src = match std::fs::read_to_string(path) {
            Ok(s) => s,
            Err(_) => return,
        };
        let arena = Bump::new();
        let result = parse(&arena, &src);
        if result.errors.is_empty() {
            let mut counter = NodeCounter::default();
            let _ = counter.visit_program(&result.program);
            merged.lock().unwrap().merge(counter);
        }
    });
    merged.into_inner().unwrap()
}

fn process_project(
    name: &str,
    slug: &str,
    repo: &str,
    version: &str,
    base: &Path,
    src_dirs: &[&str],
    test_dirs: &[&str],
) -> ProjectStats {
    let abs_dirs: Vec<std::path::PathBuf> = src_dirs
        .iter()
        .chain(test_dirs.iter())
        .map(|d| base.join(d))
        .filter(|d| d.exists())
        .collect();
    let dir_refs: Vec<&Path> = abs_dirs.iter().map(|p| p.as_path()).collect();
    let all_files = collect_php_files(&dir_refs);

    // Non-test files drive global stats; all files drive per-directory stats.
    let prod_files: Vec<_> = all_files
        .iter()
        .filter(|p| !is_test_path(p))
        .cloned()
        .collect();
    let file_count = prod_files.len() as u64;
    eprintln!(
        "[{slug}] found {} PHP files ({} incl. tests) in {:?}",
        file_count,
        all_files.len(),
        src_dirs
    );

    // Group ALL files (including test dirs) by parent directory.
    let mut groups: HashMap<String, Vec<std::path::PathBuf>> = HashMap::new();
    for file in &all_files {
        let parent = file.parent().unwrap_or(file);
        let rel = parent
            .strip_prefix(base)
            .unwrap_or(parent)
            .to_string_lossy()
            .replace('\\', "/");
        groups.entry(rel).or_default().push(file.clone());
    }

    // Global aggregate counts only non-test files.
    let merged = count_file_list(&prod_files);
    let total_nodes = merged.total_nodes();
    let nodes = merged.counts;

    // Count per directory (parallel across dirs, sequential within each dir group).
    let dir_stats: HashMap<String, DirStats> = groups
        .into_iter()
        .map(|(dir_key, dir_files)| {
            let counter = count_file_list(&dir_files);
            let total = counter.total_nodes();
            (
                dir_key,
                DirStats {
                    files: dir_files.len() as u64,
                    total_nodes: total,
                    nodes: counter.counts,
                },
            )
        })
        .collect();

    // Collect every directory under the scanned roots, including excluded ones.
    let all_dirs: Vec<String> = {
        let mut dirs = std::collections::BTreeSet::new();
        for dir in &abs_dirs {
            if !dir.exists() {
                continue;
            }
            for entry in WalkBuilder::new(dir)
                .follow_links(false)
                .build()
                .filter_map(|e| e.ok())
                .filter(|e| e.depth() > 0)
            {
                if entry.file_type().is_some_and(|ft| ft.is_dir()) {
                    let rel = entry
                        .path()
                        .strip_prefix(base)
                        .unwrap_or(entry.path())
                        .to_string_lossy()
                        .replace('\\', "/");
                    if !rel.is_empty() {
                        dirs.insert(rel);
                    }
                }
            }
        }
        dirs.into_iter().collect()
    };

    eprintln!(
        "[{slug}] done — {total_nodes} nodes, {} php dirs, {} total dirs",
        dir_stats.len(),
        all_dirs.len(),
    );

    ProjectStats {
        name: name.to_string(),
        slug: slug.to_string(),
        repo: repo.to_string(),
        version: version.to_string(),
        scanned_dirs: src_dirs.iter().map(|s| s.to_string()).collect(),
        files: file_count,
        total_nodes,
        nodes,
        all_dirs,
        dir_stats,
    }
}

fn find_errors(base: &Path, slug: &str, src_dirs: &[&str]) {
    let abs_dirs: Vec<std::path::PathBuf> = src_dirs.iter().map(|d| base.join(d)).collect();
    let dir_refs: Vec<&Path> = abs_dirs.iter().map(|p| p.as_path()).collect();
    let files = collect_php_files(&dir_refs);
    for path in &files {
        let src = match std::fs::read_to_string(path) {
            Ok(s) => s,
            Err(_) => continue,
        };
        let arena = Bump::new();
        let result = parse(&arena, &src);
        if !result.errors.is_empty() {
            println!("FILE: {}", path.display());
            for e in &result.errors {
                println!("  ERROR: {e}");
            }
        }
    }
    let _ = slug;
}

struct ProjectDef {
    name: &'static str,
    slug: &'static str,
    repo: &'static str,
    version: &'static str,
    src_dirs: &'static [&'static str],
    test_dirs: &'static [&'static str],
}

fn projects() -> Vec<ProjectDef> {
    vec![
        ProjectDef {
            name: "Laravel Framework",
            slug: "laravel",
            repo: "https://github.com/laravel/framework",
            version: "v13.9.0",
            src_dirs: &["src/Illuminate"],
            test_dirs: &["tests"],
        },
        ProjectDef {
            name: "Symfony",
            slug: "symfony",
            repo: "https://github.com/symfony/symfony",
            version: "v8.1.0-BETA2",
            src_dirs: &["src/Symfony"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "WordPress",
            slug: "wordpress",
            repo: "https://github.com/WordPress/WordPress",
            version: "6.9.4",
            src_dirs: &["wp-includes", "wp-admin/includes"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "Drupal",
            slug: "drupal",
            repo: "https://github.com/drupal/drupal",
            version: "11.x",
            src_dirs: &["core/lib/Drupal"],
            test_dirs: &["core/tests"],
        },
        ProjectDef {
            name: "PHPUnit",
            slug: "phpunit",
            repo: "https://github.com/sebastianbergmann/phpunit",
            version: "v13.1.10",
            src_dirs: &["src"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "Composer",
            slug: "composer",
            repo: "https://github.com/composer/composer",
            version: "v2.9.8",
            src_dirs: &["src"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "CodeIgniter 4",
            slug: "codeigniter",
            repo: "https://github.com/codeigniter4/CodeIgniter4",
            version: "v4.7.2",
            src_dirs: &["system"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "Doctrine ORM",
            slug: "doctrine-orm",
            repo: "https://github.com/doctrine/orm",
            version: "v3.6.5",
            src_dirs: &["src"],
            test_dirs: &[],
        },
        ProjectDef {
            name: "Yii2",
            slug: "yii2",
            repo: "https://github.com/yiisoft/yii2",
            version: "2.0.55",
            src_dirs: &["framework"],
            test_dirs: &["tests"],
        },
        ProjectDef {
            name: "CakePHP",
            slug: "cakephp",
            repo: "https://github.com/cakephp/cakephp",
            version: "v5.3.5",
            src_dirs: &["src"],
            test_dirs: &["tests"],
        },
    ]
}

fn main() {
    let args: Vec<String> = std::env::args().collect();
    let corpus =
        Path::new(env!("CARGO_MANIFEST_DIR")).join("../../crates/php-parser/benches/corpus");

    if args.get(1).map(|s| s.as_str()) == Some("--find-errors") {
        let slug = args.get(2).map(|s| s.as_str()).unwrap_or("laravel");
        let all = projects();
        if let Some(p) = all.iter().find(|p| p.slug == slug) {
            find_errors(&corpus.join(slug), slug, p.src_dirs);
        } else {
            eprintln!("unknown slug: {slug}");
        }
        return;
    }

    let out_dir = Path::new(env!("CARGO_MANIFEST_DIR")).join("../../playground/src/data");

    let all = projects();
    let mut summaries: Vec<serde_json::Value> = Vec::new();

    for p in &all {
        let base = corpus.join(p.slug);
        if !base.exists() {
            eprintln!("[{}] corpus not found at {:?}, skipping", p.slug, base);
            continue;
        }
        let stats = process_project(
            p.name,
            p.slug,
            p.repo,
            p.version,
            &base,
            p.src_dirs,
            p.test_dirs,
        );

        // Write full per-project file (includes dir_stats).
        let per_project_path = out_dir.join(format!("project-stats-{}.json", p.slug));
        let json = serde_json::to_string_pretty(&stats).unwrap();
        std::fs::write(&per_project_path, &json).unwrap_or_else(|e| {
            eprintln!("failed to write {:?}: {e}", per_project_path);
        });
        eprintln!("[{}] wrote {:?}", p.slug, per_project_path);

        // Build summary entry (no dir_stats — kept lean for the index page).
        summaries.push(serde_json::json!({
            "name": stats.name,
            "slug": stats.slug,
            "repo": stats.repo,
            "version": stats.version,
            "scanned_dirs": stats.scanned_dirs,
            "files": stats.files,
            "total_nodes": stats.total_nodes,
            "nodes": stats.nodes,
        }));
    }

    // Write summary (project-stats.json) used by the index page and compare page.
    let summary_path = out_dir.join("project-stats.json");
    let summary_json = serde_json::to_string_pretty(&summaries).unwrap();
    std::fs::write(&summary_path, &summary_json).unwrap_or_else(|e| {
        eprintln!("failed to write {:?}: {e}", summary_path);
    });
    eprintln!("wrote {:?}", summary_path);
}
