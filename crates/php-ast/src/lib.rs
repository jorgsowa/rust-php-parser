//! AST type definitions and visitor infrastructure for the PHP parser.
//!
//! This crate provides:
//! - The complete set of AST node types ([`ast`] module) — statements, expressions, declarations,
//!   type hints, operators, and all other syntactic constructs for PHP 8.0–8.5.
//! - A [`Span`] type for tracking byte-offset ranges back to the source text.
//! - A [`visitor`] module with the [`visitor::Visitor`] and [`visitor::ScopeVisitor`] traits for
//!   depth-first AST traversal, plus free `walk_*` functions that drive the default recursion.
//!
//! # Quick start
//!
//! Parse a PHP file with `php-rs-parser` and then walk the AST with a custom visitor:
//!
//! ```
//! use php_ast::visitor::{Visitor, walk_expr};
//! use php_ast::ast::{Expr, ExprKind};
//! use std::ops::ControlFlow;
//!
//! struct FunctionCallCounter(usize);
//!
//! impl<'arena, 'src> Visitor<'arena, 'src> for FunctionCallCounter {
//!     fn visit_expr(&mut self, expr: &Expr<'arena, 'src>) -> ControlFlow<()> {
//!         if matches!(expr.kind, ExprKind::FunctionCall(_)) {
//!             self.0 += 1;
//!         }
//!         walk_expr(self, expr)
//!     }
//! }
//! ```

pub mod ast;
pub mod span;
pub mod visitor;

pub use ast::*;
pub use span::Span;
