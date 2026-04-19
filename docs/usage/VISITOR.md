# Visitor API

## `Visitor` vs `ScopeVisitor`

| Trait | Use when |
|-------|----------|
| `Visitor` | You only need the AST node itself |
| `ScopeVisitor` | You also need the enclosing namespace, class, or function name |

---

## Scope-aware traversal

`ScopeVisitor` and `ScopeWalker` provide zero-allocation lexical scope context — namespace, class name, and function/method name — at every node:

```rust
use php_ast::visitor::{ScopeVisitor, ScopeWalker, Scope};
use php_ast::ast::*;
use std::ops::ControlFlow;

struct MethodCollector { methods: Vec<String> }

impl<'arena, 'src> ScopeVisitor<'arena, 'src> for MethodCollector {
    fn visit_class_member(
        &mut self,
        member: &ClassMember<'arena, 'src>,
        scope: &Scope<'src>,
    ) -> ControlFlow<()> {
        if let ClassMemberKind::Method(m) = &member.kind {
            self.methods.push(format!(
                "{}::{}",
                scope.class_name.unwrap_or("<anon>"),
                m.name
            ));
        }
        ControlFlow::Continue(())
    }
}

let arena = bumpalo::Bump::new();
let result = php_rs_parser::parse(&arena, "<?php class Foo { public function bar() {} }");
let mut walker = ScopeWalker::new(MethodCollector { methods: vec![] });
let _ = walker.walk(&result.program);
// walker.into_inner().methods == ["Foo::bar"]
```

`Scope` fields:
- `namespace: Option<Cow<'src, str>>` — current namespace, `None` in the global namespace
- `class_name: Option<&'src str>` — enclosing class/interface/trait/enum name, `None` outside or in anonymous classes
- `function_name: Option<&'src str>` — enclosing named function/method name, `None` in closures/arrow functions

---

## PHPDoc parser

```rust
let tags = php_rs_parser::phpdoc::parse("/** @param int $id The user ID\n * @return User */");
```

Produces typed `PhpDocTag` variants for `@param`, `@return`, `@var`, `@throws`, `@template`, `@property`, `@method`, `@deprecated`, and Psalm/PHPStan annotations. Doc comments are attached to function, class, method, property, and constant AST nodes.
