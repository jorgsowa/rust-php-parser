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
        }
    }

    pub(crate) fn print_type_hint(&mut self, hint: &TypeHint) {
        match &hint.kind {
            TypeHintKind::Named(name) => self.print_name(name),
            TypeHintKind::Keyword(builtin, _) => self.w(builtin.as_str()),
            TypeHintKind::Nullable(inner) => {
                self.w("?");
                self.print_type_hint(inner);
            }
            TypeHintKind::Union(types) => {
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("|");
                    }
                    self.print_type_hint(ty);
                }
            }
            TypeHintKind::Intersection(types) => {
                for (i, ty) in types.iter().enumerate() {
                    if i > 0 {
                        self.w("&");
                    }
                    self.print_type_hint(ty);
                }
            }
        }
    }
}
