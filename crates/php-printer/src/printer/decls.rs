use php_ast::ast::*;

use crate::precedence::*;

use super::helpers::*;
use super::Printer;

impl Printer {
    pub(crate) fn print_function(&mut self, func: &FunctionDecl) {
        self.print_doc_comment(&func.doc_comment);
        self.print_attributes(&func.attributes);
        self.w("function ");
        if func.by_ref {
            self.w("&");
        }
        self.w(func.name);
        self.w("(");
        self.print_params(&func.params);
        self.w(")");
        if let Some(ret) = &func.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        self.newline();
        self.write_indent();
        self.w("{");
        if !func.body.is_empty() {
            self.newline();
            self.print_stmts(&func.body, true);
            self.newline();
            self.write_indent();
        }
        self.w("}");
    }

    pub(crate) fn print_class(&mut self, class: &ClassDecl) {
        self.print_doc_comment(&class.doc_comment);
        self.print_attributes(&class.attributes);
        self.print_class_header(class);
        self.print_class_body(&class.members);
    }

    pub(crate) fn print_class_header(&mut self, class: &ClassDecl) {
        if class.modifiers.is_abstract {
            self.w("abstract ");
        }
        if class.modifiers.is_final {
            self.w("final ");
        }
        if class.modifiers.is_readonly {
            self.w("readonly ");
        }
        self.w("class");
        if let Some(name) = class.name {
            self.w(" ");
            self.w(name);
        }
        if let Some(extends) = &class.extends {
            self.w(" extends ");
            self.print_name(extends);
        }
        if !class.implements.is_empty() {
            self.w(" implements ");
            for (i, name) in class.implements.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
    }

    pub(crate) fn print_class_body(&mut self, members: &[ClassMember]) {
        self.newline();
        self.write_indent();
        self.w("{");
        if !members.is_empty() {
            self.newline();
            self.indent();
            for (i, member) in members.iter().enumerate() {
                if i > 0 {
                    self.newline();
                }
                self.write_indent();
                self.print_class_member(member);
                self.newline();
            }
            self.dedent();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_class_member(&mut self, member: &ClassMember) {
        match &member.kind {
            ClassMemberKind::Property(prop) => self.print_property(prop),
            ClassMemberKind::Method(method) => self.print_method(method),
            ClassMemberKind::ClassConst(cc) => self.print_class_const(cc),
            ClassMemberKind::TraitUse(tu) => self.print_trait_use(tu),
        }
    }

    pub(crate) fn print_method(&mut self, method: &MethodDecl) {
        self.print_doc_comment(&method.doc_comment);
        self.print_attributes(&method.attributes);
        if method.is_abstract {
            self.w("abstract ");
        }
        if method.is_final {
            self.w("final ");
        }
        if let Some(vis) = &method.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if method.is_static {
            self.w("static ");
        }
        self.w("function ");
        if method.by_ref {
            self.w("&");
        }
        self.w(method.name);
        self.w("(");
        self.print_params(&method.params);
        self.w(")");
        if let Some(ret) = &method.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        if let Some(body) = &method.body {
            self.newline();
            self.write_indent();
            self.w("{");
            if !body.is_empty() {
                self.newline();
                self.print_stmts(body, true);
                self.newline();
                self.write_indent();
            }
            self.w("}");
        } else {
            self.w(";");
        }
    }

    fn print_property(&mut self, prop: &PropertyDecl) {
        self.print_doc_comment(&prop.doc_comment);
        self.print_attributes(&prop.attributes);
        if let Some(vis) = &prop.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if let Some(set_vis) = &prop.set_visibility {
            self.w(visibility_str(*set_vis));
            self.w("(set) ");
        }
        if prop.is_static {
            self.w("static ");
        }
        if prop.is_readonly {
            self.w("readonly ");
        }
        if let Some(th) = &prop.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w("$");
        self.w(prop.name);
        if let Some(default) = &prop.default {
            self.w(" = ");
            self.print_expr(default, PREC_LOWEST);
        }
        if !prop.hooks.is_empty() {
            self.w(" ");
            self.print_property_hooks(&prop.hooks);
        } else {
            self.w(";");
        }
    }

    fn print_property_hooks(&mut self, hooks: &[PropertyHook]) {
        self.w("{");
        self.newline();
        self.indent();
        for hook in hooks.iter() {
            self.write_indent();
            self.print_attributes(&hook.attributes);
            if hook.is_final {
                self.w("final ");
            }
            if hook.by_ref {
                self.w("&");
            }
            match hook.kind {
                PropertyHookKind::Get => self.w("get"),
                PropertyHookKind::Set => self.w("set"),
            }
            if !hook.params.is_empty() {
                self.w("(");
                self.print_params(&hook.params);
                self.w(")");
            }
            match &hook.body {
                PropertyHookBody::Block(stmts) => {
                    self.w(" {");
                    if !stmts.is_empty() {
                        self.newline();
                        self.print_stmts(stmts, true);
                        self.newline();
                        self.write_indent();
                    }
                    self.w("}");
                }
                PropertyHookBody::Expression(e) => {
                    self.w(" => ");
                    self.print_expr(e, PREC_LOWEST);
                    self.w(";");
                }
                PropertyHookBody::Abstract => self.w(";"),
            }
            self.newline();
        }
        self.dedent();
        self.write_indent();
        self.w("}");
    }

    fn print_class_const(&mut self, cc: &ClassConstDecl) {
        self.print_doc_comment(&cc.doc_comment);
        self.print_attributes(&cc.attributes);
        if let Some(vis) = &cc.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        self.w("const ");
        if let Some(th) = &cc.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w(cc.name);
        self.w(" = ");
        self.print_expr(&cc.value, PREC_LOWEST);
        self.w(";");
    }

    fn print_trait_use(&mut self, tu: &TraitUseDecl) {
        self.w("use ");
        for (i, name) in tu.traits.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_name(name);
        }
        if tu.adaptations.is_empty() {
            self.w(";");
        } else {
            self.w(" {");
            self.newline();
            self.indent();
            for adapt in tu.adaptations.iter() {
                self.write_indent();
                match &adapt.kind {
                    TraitAdaptationKind::Precedence {
                        trait_name,
                        method,
                        insteadof,
                    } => {
                        self.print_name(trait_name);
                        self.w("::");
                        self.print_name(method);
                        self.w(" insteadof ");
                        for (i, name) in insteadof.iter().enumerate() {
                            if i > 0 {
                                self.w(", ");
                            }
                            self.print_name(name);
                        }
                    }
                    TraitAdaptationKind::Alias {
                        trait_name,
                        method,
                        new_modifier,
                        new_name,
                    } => {
                        if let Some(tn) = trait_name {
                            self.print_name(tn);
                            self.w("::");
                        }
                        self.print_name(method);
                        self.w(" as");
                        if let Some(vis) = new_modifier {
                            self.w(" ");
                            self.w(visibility_str(*vis));
                        }
                        if let Some(name) = new_name {
                            self.w(" ");
                            self.print_name(name);
                        }
                    }
                }
                self.w(";");
                self.newline();
            }
            self.dedent();
            self.write_indent();
            self.w("}");
        }
    }

    pub(crate) fn print_interface(&mut self, iface: &InterfaceDecl) {
        self.print_doc_comment(&iface.doc_comment);
        self.print_attributes(&iface.attributes);
        self.w("interface ");
        self.w(iface.name);
        if !iface.extends.is_empty() {
            self.w(" extends ");
            for (i, name) in iface.extends.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
        self.print_class_body(&iface.members);
    }

    pub(crate) fn print_trait(&mut self, trait_decl: &TraitDecl) {
        self.print_doc_comment(&trait_decl.doc_comment);
        self.print_attributes(&trait_decl.attributes);
        self.w("trait ");
        self.w(trait_decl.name);
        self.print_class_body(&trait_decl.members);
    }

    pub(crate) fn print_enum(&mut self, enum_decl: &EnumDecl) {
        self.print_doc_comment(&enum_decl.doc_comment);
        self.print_attributes(&enum_decl.attributes);
        self.w("enum ");
        self.w(enum_decl.name);
        if let Some(scalar) = &enum_decl.scalar_type {
            self.w(": ");
            self.print_name(scalar);
        }
        if !enum_decl.implements.is_empty() {
            self.w(" implements ");
            for (i, name) in enum_decl.implements.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
        self.newline();
        self.write_indent();
        self.w("{");
        if !enum_decl.members.is_empty() {
            self.newline();
            self.indent();
            for (i, member) in enum_decl.members.iter().enumerate() {
                if i > 0 {
                    self.newline();
                }
                self.write_indent();
                self.print_enum_member(member);
                self.newline();
            }
            self.dedent();
            self.write_indent();
        }
        self.w("}");
    }

    fn print_enum_member(&mut self, member: &EnumMember) {
        match &member.kind {
            EnumMemberKind::Case(case) => {
                self.print_doc_comment(&case.doc_comment);
                self.print_attributes(&case.attributes);
                self.w("case ");
                self.w(case.name);
                if let Some(val) = &case.value {
                    self.w(" = ");
                    self.print_expr(val, PREC_LOWEST);
                }
                self.w(";");
            }
            EnumMemberKind::Method(method) => self.print_method(method),
            EnumMemberKind::ClassConst(cc) => self.print_class_const(cc),
            EnumMemberKind::TraitUse(tu) => self.print_trait_use(tu),
        }
    }

    pub(crate) fn print_params(&mut self, params: &[Param]) {
        for (i, param) in params.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_attributes_inline(&param.attributes);
            if let Some(vis) = &param.visibility {
                self.w(visibility_str(*vis));
                self.w(" ");
            }
            if let Some(set_vis) = &param.set_visibility {
                self.w(visibility_str(*set_vis));
                self.w("(set) ");
            }
            if param.is_readonly {
                self.w("readonly ");
            }
            if param.is_final {
                self.w("final ");
            }
            if let Some(th) = &param.type_hint {
                self.print_type_hint(th);
                self.w(" ");
            }
            if param.variadic {
                self.w("...");
            }
            if param.by_ref {
                self.w("&");
            }
            self.w("$");
            self.w(param.name);
            if let Some(default) = &param.default {
                self.w(" = ");
                self.print_expr(default, PREC_LOWEST);
            }
        }
    }

    pub(crate) fn print_attributes(&mut self, attrs: &[Attribute]) {
        for attr in attrs.iter() {
            self.w("#[");
            self.print_name(&attr.name);
            if !attr.args.is_empty() {
                self.w("(");
                self.print_args(&attr.args);
                self.w(")");
            }
            self.w("]");
            self.newline();
            self.write_indent();
        }
    }

    pub(crate) fn print_attributes_inline(&mut self, attrs: &[Attribute]) {
        for attr in attrs.iter() {
            self.w("#[");
            self.print_name(&attr.name);
            if !attr.args.is_empty() {
                self.w("(");
                self.print_args(&attr.args);
                self.w(")");
            }
            self.w("] ");
        }
    }

    pub(crate) fn print_doc_comment(&mut self, doc: &Option<Comment>) {
        if let Some(comment) = doc {
            for (i, line) in comment.text.lines().enumerate() {
                if i > 0 {
                    self.newline();
                    self.write_indent();
                }
                self.w(line.trim_end());
            }
            self.newline();
            self.write_indent();
        }
    }
}
