use std::collections::HashMap;
use std::ops::ControlFlow;
use std::path::Path;
use std::sync::Mutex;

use bumpalo::Bump;
use php_ast::ast::*;
use php_ast::visitor::{walk_expr, walk_stmt, Visitor};
use php_rs_parser::parse;
use rayon::prelude::*;
use serde::Serialize;
use walkdir::WalkDir;

#[derive(Default)]
struct NodeCounter {
    stmts: HashMap<&'static str, u64>,
    exprs: HashMap<&'static str, u64>,
}

impl NodeCounter {
    fn total_nodes(&self) -> u64 {
        self.stmts.values().sum::<u64>() + self.exprs.values().sum::<u64>()
    }

    fn merge(&mut self, other: NodeCounter) {
        for (k, v) in other.stmts {
            *self.stmts.entry(k).or_insert(0) += v;
        }
        for (k, v) in other.exprs {
            *self.exprs.entry(k).or_insert(0) += v;
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
        *self.stmts.entry(name).or_insert(0) += 1;
        walk_stmt(self, stmt)
    }

    fn visit_expr(&mut self, expr: &Expr<'a, 'src>) -> ControlFlow<()> {
        let name = match &expr.kind {
            ExprKind::Int(_) => "Int",
            ExprKind::Float(_) => "Float",
            ExprKind::String(_) => "String",
            ExprKind::InterpolatedString(_) => "InterpolatedString",
            ExprKind::Heredoc { .. } => "Heredoc",
            ExprKind::Nowdoc { .. } => "Nowdoc",
            ExprKind::ShellExec(_) => "ShellExec",
            ExprKind::Bool(_) => "Bool",
            ExprKind::Null => "Null",
            ExprKind::Variable(_) => "Variable",
            ExprKind::VariableVariable(_) => "VariableVariable",
            ExprKind::Identifier(_) => "Identifier",
            ExprKind::Assign(_) => "Assign",
            ExprKind::Binary(_) => "Binary",
            ExprKind::UnaryPrefix(_) => "UnaryPrefix",
            ExprKind::UnaryPostfix(_) => "UnaryPostfix",
            ExprKind::Ternary(_) => "Ternary",
            ExprKind::NullCoalesce(_) => "NullCoalesce",
            ExprKind::FunctionCall(_) => "FunctionCall",
            ExprKind::Array(_) => "Array",
            ExprKind::ArrayAccess(_) => "ArrayAccess",
            ExprKind::Print(_) => "Print",
            ExprKind::Parenthesized(_) => "Parenthesized",
            ExprKind::Cast(_, _) => "Cast",
            ExprKind::ErrorSuppress(_) => "ErrorSuppress",
            ExprKind::Isset(_) => "Isset",
            ExprKind::Empty(_) => "Empty",
            ExprKind::Include(_, _) => "Include",
            ExprKind::Eval(_) => "Eval",
            ExprKind::Exit(_) => "Exit",
            ExprKind::MagicConst(_) => "MagicConst",
            ExprKind::Clone(_) => "Clone",
            ExprKind::CloneWith(_, _) => "CloneWith",
            ExprKind::New(_) => "New",
            ExprKind::PropertyAccess(_) => "PropertyAccess",
            ExprKind::NullsafePropertyAccess(_) => "NullsafePropertyAccess",
            ExprKind::MethodCall(_) => "MethodCall",
            ExprKind::NullsafeMethodCall(_) => "NullsafeMethodCall",
            ExprKind::StaticPropertyAccess(_) => "StaticPropertyAccess",
            ExprKind::StaticMethodCall(_) => "StaticMethodCall",
            ExprKind::StaticDynMethodCall(_) => "StaticDynMethodCall",
            ExprKind::ClassConstAccess(_) => "ClassConstAccess",
            ExprKind::ClassConstAccessDynamic { .. } => "ClassConstAccessDynamic",
            ExprKind::StaticPropertyAccessDynamic { .. } => "StaticPropertyAccessDynamic",
            ExprKind::Closure(_) => "Closure",
            ExprKind::ArrowFunction(_) => "ArrowFunction",
            ExprKind::Match(_) => "Match",
            ExprKind::Yield(_) => "Yield",
            ExprKind::ThrowExpr(_) => "ThrowExpr",
            ExprKind::AnonymousClass(_) => "AnonymousClass",
            ExprKind::CallableCreate(_) => "CallableCreate",
            ExprKind::Omit => "Omit",
            ExprKind::Error => "Error",
        };
        *self.exprs.entry(name).or_insert(0) += 1;
        walk_expr(self, expr)
    }
}

fn collect_php_files(dirs: &[&Path]) -> Vec<std::path::PathBuf> {
    let mut files = Vec::new();
    for dir in dirs {
        if !dir.exists() {
            continue;
        }
        let iter = WalkDir::new(dir)
            .follow_links(false)
            .into_iter()
            .filter_map(|e| e.ok())
            .filter(|e| {
                e.file_type().is_file()
                    && e.path().extension().and_then(|s| s.to_str()) == Some("php")
            })
            .map(|e| e.path().to_path_buf());
        files.extend(iter);
    }
    files
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
}

fn process_project(
    name: &str,
    slug: &str,
    repo: &str,
    version: &str,
    base: &Path,
    src_dirs: &[&str],
) -> ProjectStats {
    let abs_dirs: Vec<std::path::PathBuf> = src_dirs.iter().map(|d| base.join(d)).collect();
    let dir_refs: Vec<&Path> = abs_dirs.iter().map(|p| p.as_path()).collect();
    let files = collect_php_files(&dir_refs);
    let file_count = files.len() as u64;
    eprintln!("[{slug}] found {} PHP files in {:?}", file_count, src_dirs);

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

    let merged = merged.into_inner().unwrap();
    let total_nodes = merged.total_nodes();

    let mut nodes: HashMap<&'static str, u64> = HashMap::new();
    nodes.extend(merged.stmts);
    nodes.extend(merged.exprs);

    eprintln!("[{slug}] done — {total_nodes} nodes");

    ProjectStats {
        name: name.to_string(),
        slug: slug.to_string(),
        repo: repo.to_string(),
        version: version.to_string(),
        scanned_dirs: src_dirs.iter().map(|s| s.to_string()).collect(),
        files: file_count,
        total_nodes,
        nodes,
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
}

fn projects() -> Vec<ProjectDef> {
    vec![
        ProjectDef {
            name: "Laravel Framework",
            slug: "laravel",
            repo: "https://github.com/laravel/framework",
            version: "v13.9.0",
            src_dirs: &["src/Illuminate"],
        },
        ProjectDef {
            name: "Symfony",
            slug: "symfony",
            repo: "https://github.com/symfony/symfony",
            version: "v8.1.0-BETA2",
            src_dirs: &["src/Symfony"],
        },
        ProjectDef {
            name: "WordPress",
            slug: "wordpress",
            repo: "https://github.com/WordPress/WordPress",
            version: "6.9.4",
            src_dirs: &["wp-includes", "wp-admin/includes"],
        },
        ProjectDef {
            name: "Drupal",
            slug: "drupal",
            repo: "https://github.com/drupal/drupal",
            version: "11.x",
            src_dirs: &["core/lib/Drupal"],
        },
        ProjectDef {
            name: "PHPUnit",
            slug: "phpunit",
            repo: "https://github.com/sebastianbergmann/phpunit",
            version: "v13.1.10",
            src_dirs: &["src"],
        },
        ProjectDef {
            name: "Composer",
            slug: "composer",
            repo: "https://github.com/composer/composer",
            version: "v2.9.8",
            src_dirs: &["src"],
        },
        ProjectDef {
            name: "CodeIgniter 4",
            slug: "codeigniter",
            repo: "https://github.com/codeigniter4/CodeIgniter4",
            version: "v4.7.2",
            src_dirs: &["system"],
        },
        ProjectDef {
            name: "Doctrine ORM",
            slug: "doctrine-orm",
            repo: "https://github.com/doctrine/orm",
            version: "v3.6.5",
            src_dirs: &["src"],
        },
        ProjectDef {
            name: "Yii2",
            slug: "yii2",
            repo: "https://github.com/yiisoft/yii2",
            version: "2.0.55",
            src_dirs: &["framework"],
        },
        ProjectDef {
            name: "CakePHP",
            slug: "cakephp",
            repo: "https://github.com/cakephp/cakephp",
            version: "v5.3.5",
            src_dirs: &["src"],
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

    let all = projects();
    let mut stats: Vec<ProjectStats> = Vec::new();

    for p in &all {
        let base = corpus.join(p.slug);
        if base.exists() {
            stats.push(process_project(
                p.name, p.slug, p.repo, p.version, &base, p.src_dirs,
            ));
        } else {
            eprintln!("[{}] corpus not found at {:?}, skipping", p.slug, base);
        }
    }

    println!("{}", serde_json::to_string_pretty(&stats).unwrap());
}
