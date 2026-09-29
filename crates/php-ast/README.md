# php-ast

AST node definitions for PHP 7.4–8.5, with arena (`Visitor`, `ScopeVisitor`, `Fold`) and owned (`OwnedVisitor`, `OwnedScopeVisitor`, `FoldOwned`) traversal traits and a `NameResolver`.

Use it together with [`php-rs-parser`](https://crates.io/crates/php-rs-parser), which produces these trees.

```rust
use php_ast::owned::{walk_owned_expr, Expr, ExprKind, OwnedVisitor};
use std::ops::ControlFlow;

struct VarCounter(usize);

impl OwnedVisitor for VarCounter {
    fn visit_expr(&mut self, expr: &Expr) -> ControlFlow<()> {
        if matches!(expr.kind, ExprKind::Variable(_)) {
            self.0 += 1;
        }
        walk_owned_expr(self, expr)
    }
}
```

Part of the [rust-php-parser](https://github.com/jorgsowa/rust-php-parser) workspace. API reference: [docs.rs/php-ast](https://docs.rs/php-ast).

## License

BSD 3-Clause
