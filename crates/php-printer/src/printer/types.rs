use php_ast::ast::*;

use super::Printer;

impl Printer {
    pub(crate) fn print_name(&mut self, name: &Name) {
        match name {
            Name::Simple { value, .. } => self.w(value),
            Name::Complex { parts, kind, .. } => {
                match kind {
                    NameKind::FullyQualified => self.w("\\"),
                    NameKind::Relative => self.w("namespace\\"),
                    _ => {}
                }
                for (i, part) in parts.iter().enumerate() {
                    if i > 0 {
                        self.w("\\");
                    }
                    self.w(part);
                }
            }
            Name::Error { .. } => self.w("<error>"),
        }
    }

    pub(crate) fn print_type_hint(&mut self, hint: &TypeHint) {
        self.print_type_hint_inner(hint, TypeContext::Top);
    }

    fn print_type_hint_inner(&mut self, hint: &TypeHint, ctx: TypeContext) {
        match &hint.kind {
            TypeHintKind::Named(name) => self.print_name(name),
            TypeHintKind::Keyword(builtin, _) => self.w(builtin.as_str()),
            TypeHintKind::Nullable(inner) => {
                self.w("?");
                self.print_type_hint_inner(inner, TypeContext::Top);
            }
            TypeHintKind::Union(types) => {
                let parens = matches!(ctx, TypeContext::Intersection);
                if parens {
                    self.w("(");
                }
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("|");
                    }
                    self.print_type_hint_inner(ty, TypeContext::Union);
                }
                if parens {
                    self.w(")");
                }
            }
            TypeHintKind::Intersection(types) => {
                let parens = matches!(ctx, TypeContext::Union);
                if parens {
                    self.w("(");
                }
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("&");
                    }
                    self.print_type_hint_inner(ty, TypeContext::Intersection);
                }
                if parens {
                    self.w(")");
                }
            }
        }
    }
}

#[derive(Clone, Copy)]
enum TypeContext {
    Top,
    Union,
    Intersection,
}
