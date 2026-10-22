use php_ast::ast::*;
use php_ast::Span;

use crate::precedence::*;

use super::helpers::*;
use super::Printer;

trait Member {
    fn span(&self) -> Span;
    fn doc_comment_start(&self) -> Option<u32>;
    fn is_trait_use(&self) -> bool;
    fn print(&self, printer: &mut Printer);
}

impl Member for ClassMember<'_, '_> {
    fn span(&self) -> Span {
        self.span
    }

    fn doc_comment_start(&self) -> Option<u32> {
        class_member_doc_comment(self).map(|c| c.span.start)
    }

    fn is_trait_use(&self) -> bool {
        matches!(self.kind, ClassMemberKind::TraitUse(_))
    }

    fn print(&self, printer: &mut Printer) {
        printer.print_class_member(self);
    }
}

impl Member for EnumMember<'_, '_> {
    fn span(&self) -> Span {
        self.span
    }

    fn doc_comment_start(&self) -> Option<u32> {
        enum_member_doc_comment(self).map(|c| c.span.start)
    }

    fn is_trait_use(&self) -> bool {
        matches!(self.kind, EnumMemberKind::TraitUse(_))
    }

    fn print(&self, printer: &mut Printer) {
        printer.print_enum_member(self);
    }
}

/// Source indices with trait `use` first, each half in source order; `None` if already so.
fn trait_uses_first<M: Member>(members: &[M]) -> Option<Vec<usize>> {
    let first_other = members.iter().position(|m| !m.is_trait_use())?;
    if !members[first_other..].iter().any(Member::is_trait_use) {
        return None;
    }
    let mut order = Vec::with_capacity(members.len());
    order.extend((0..members.len()).filter(|&i| members[i].is_trait_use()));
    order.extend((0..members.len()).filter(|&i| !members[i].is_trait_use()));
    Some(order)
}

impl<'src> Printer<'src> {
    pub(crate) fn print_function(&mut self, func: &FunctionDecl) {
        self.print_doc_comment(func.doc_comment.as_ref());
        self.print_attributes(&func.attributes);
        self.w("function ");
        if func.by_ref {
            self.w("&");
        }
        self.w(func.name.or_error());
        self.w("(");
        self.print_params(&func.params);
        self.w(")");
        if let Some(ret) = &func.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        if !self.flush_gap_comments_before(func.body.span.start) {
            self.newline();
            self.write_indent();
        }
        self.print_block(func.body);
    }

    pub(crate) fn print_class(&mut self, class: &ClassDecl) {
        self.print_doc_comment(class.doc_comment.as_ref());
        self.print_attributes(&class.attributes);
        self.print_class_header(class);
        self.print_class_body(&class.body, false);
    }

    pub(crate) fn print_anonymous_class(&mut self, class: &ClassDecl, args: &[Arg]) {
        self.print_attributes_inline(&class.attributes);
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
        if !args.is_empty() {
            self.w("(");
            self.print_args(args);
            self.w(")");
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
        self.print_class_body(&class.body, true);
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
            self.w(name.or_error());
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

    pub(crate) fn print_class_body(&mut self, body: &ClassBody, brace_on_same_line: bool) {
        self.print_body_open(body.span.start, brace_on_same_line);
        self.print_members(&body.members, body.span.end);
        self.w("}");
    }

    fn print_body_open(&mut self, body_start: u32, brace_on_same_line: bool) {
        if !self.flush_gap_comments_before(body_start) {
            if brace_on_same_line {
                self.w(" ");
            } else {
                self.newline();
                self.write_indent();
            }
        }
        self.w("{");
    }

    /// Prints members one per line, trait `use` first, then the newline before `}`.
    fn print_members<M: Member>(&mut self, members: &[M], body_end: u32) {
        if members.is_empty() {
            return;
        }
        self.newline();
        self.indent();
        let order = trait_uses_first(members);
        let comment_floor = self.comment_cursor;
        for k in 0..members.len() {
            let i = order.as_ref().map_or(k, |o| o[k]);
            let member = &members[i];
            let source_prev_end = i.checked_sub(1).map(|p| members[p].span().end);
            if order.is_some() {
                let region_start =
                    source_prev_end.map_or(0, |end| self.same_line_comments_end(end));
                self.seek_comments(comment_floor, region_start);
            }
            let doc_start = member.doc_comment_start();
            let lead_start = doc_start.unwrap_or(member.span().start);
            if k > 0 {
                // Always at least one blank line between members; preserve more from source.
                let scan_to = self
                    .first_pending_comment_before(lead_start)
                    .unwrap_or(lead_start);
                let blank = self
                    .blank_lines_between(source_prev_end.unwrap_or(scan_to), scan_to)
                    .max(1);
                for _ in 0..blank {
                    self.newline();
                }
            }
            self.flush_comments_before_node(member.span().start, doc_start);
            self.write_indent();
            member.print(self);
            self.flush_same_line_comments(member.span().end);
            self.newline();
        }
        if order.is_some() {
            let last_end = members[members.len() - 1].span().end;
            self.seek_comments(comment_floor, self.same_line_comments_end(last_end));
        }
        self.flush_leading_comments(body_end);
        self.dedent();
        self.write_indent();
    }

    fn print_class_member(&mut self, member: &ClassMember) {
        match &member.kind {
            ClassMemberKind::Property(prop) => self.print_property(prop),
            ClassMemberKind::Method(method) => self.print_method(method),
            ClassMemberKind::ClassConst(cc) => self.print_class_const(cc),
            ClassMemberKind::TraitUse(tu) => self.print_trait_use(tu),
            _ => self.unsupported("class member"),
        }
    }

    pub(crate) fn print_method(&mut self, method: &MethodDecl) {
        self.print_doc_comment(method.doc_comment.as_ref());
        self.print_attributes(&method.attributes);
        if method.modifiers.is_abstract {
            self.w("abstract ");
        }
        if method.modifiers.is_final {
            self.w("final ");
        }
        if let Some(vis) = &method.modifiers.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if method.modifiers.is_static {
            self.w("static ");
        }
        self.w("function ");
        if method.by_ref {
            self.w("&");
        }
        self.w(method.name.or_error());
        self.w("(");
        self.print_params(&method.params);
        self.w(")");
        if let Some(ret) = &method.return_type {
            self.w(": ");
            self.print_type_hint(ret);
        }
        if let Some(body) = method.body {
            if !self.flush_gap_comments_before(body.span.start) {
                self.newline();
                self.write_indent();
            }
            self.print_block(body);
        } else {
            self.w(";");
        }
    }

    fn print_property(&mut self, prop: &PropertyDecl) {
        self.print_doc_comment(prop.doc_comment.as_ref());
        self.print_attributes(&prop.attributes);
        if prop.modifiers.is_abstract {
            self.w("abstract ");
        }
        if prop.modifiers.is_final {
            self.w("final ");
        }
        if let Some(vis) = &prop.modifiers.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if let Some(set_vis) = &prop.modifiers.set_visibility {
            self.w(visibility_str(*set_vis));
            self.w("(set) ");
        }
        if prop.modifiers.is_static {
            self.w("static ");
        }
        if prop.modifiers.is_readonly {
            self.w("readonly ");
        }
        if let Some(th) = &prop.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w("$");
        self.w(prop.name.or_error());
        if let Some(default) = &prop.default {
            self.w(" = ");
            self.print_expr(default, PREC_LOWEST);
        }
        if !prop.hooks.is_empty() {
            self.w(" ");
            self.print_property_hooks(&prop.hooks);
        } else if prop.empty_hook_list {
            self.w(" {}");
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
            if hook.modifiers.is_final {
                self.w("final ");
            }
            if hook.by_ref {
                self.w("&");
            }
            match hook.kind {
                PropertyHookKind::Get => self.w("get"),
                PropertyHookKind::Set => self.w("set"),
                _ => self.unsupported("property hook"),
            }
            if !hook.params.is_empty() {
                self.w("(");
                self.print_params(&hook.params);
                self.w(")");
            }
            match &hook.body {
                PropertyHookBody::Block(body) => {
                    if !self.flush_gap_comments_before(body.span.start) {
                        self.w(" ");
                    }
                    self.print_block(body);
                }
                PropertyHookBody::Expression(e) => {
                    self.w(" => ");
                    self.print_expr(e, PREC_LOWEST);
                    self.w(";");
                }
                PropertyHookBody::Abstract => self.w(";"),
                _ => self.unsupported("property hook body"),
            }
            self.newline();
        }
        self.dedent();
        self.write_indent();
        self.w("}");
    }

    fn print_class_const(&mut self, cc: &ClassConstDecl) {
        self.print_doc_comment(cc.doc_comment.as_ref());
        self.print_attributes(&cc.attributes);
        if cc.modifiers.is_final {
            self.w("final ");
        }
        if let Some(vis) = &cc.modifiers.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        self.w("const ");
        if let Some(th) = &cc.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        self.w(cc.name.or_error());
        self.w(" = ");
        self.print_expr(&cc.value, PREC_LOWEST);
        self.w(";");
    }

    fn print_trait_use(&mut self, tu: &TraitUseDecl) {
        self.print_doc_comment(tu.doc_comment.as_ref());
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
            if let Some(brace) = tu.adaptations_brace_span {
                if !self.flush_gap_comments_before(brace.start) {
                    self.w(" ");
                }
            } else {
                self.w(" ");
            }
            self.w("{");
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
                        is_final,
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
                        if *is_final {
                            self.w(" final");
                        }
                        if let Some(name) = new_name {
                            self.w(" ");
                            self.print_name(name);
                        }
                    }
                    _ => self.unsupported("trait adaptation"),
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
        self.print_doc_comment(iface.doc_comment.as_ref());
        self.print_attributes(&iface.attributes);
        self.w("interface ");
        self.w(iface.name.or_error());
        if !iface.extends.is_empty() {
            self.w(" extends ");
            for (i, name) in iface.extends.iter().enumerate() {
                if i > 0 {
                    self.w(", ");
                }
                self.print_name(name);
            }
        }
        self.print_class_body(&iface.body, false);
    }

    pub(crate) fn print_trait(&mut self, trait_decl: &TraitDecl) {
        self.print_doc_comment(trait_decl.doc_comment.as_ref());
        self.print_attributes(&trait_decl.attributes);
        self.w("trait ");
        self.w(trait_decl.name.or_error());
        self.print_class_body(&trait_decl.body, false);
    }

    pub(crate) fn print_enum(&mut self, enum_decl: &EnumDecl) {
        self.print_doc_comment(enum_decl.doc_comment.as_ref());
        self.print_attributes(&enum_decl.attributes);
        self.w("enum ");
        self.w(enum_decl.name.or_error());
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
        self.print_body_open(enum_decl.body.span.start, false);
        self.print_members(&enum_decl.body.members, enum_decl.body.span.end);
        self.w("}");
    }

    fn print_enum_member(&mut self, member: &EnumMember) {
        match &member.kind {
            EnumMemberKind::Case(case) => {
                self.print_doc_comment(case.doc_comment.as_ref());
                self.print_attributes(&case.attributes);
                self.w("case ");
                self.w(case.name.or_error());
                if let Some(val) = &case.value {
                    self.w(" = ");
                    self.print_expr(val, PREC_LOWEST);
                }
                self.w(";");
            }
            EnumMemberKind::Method(method) => self.print_method(method),
            EnumMemberKind::ClassConst(cc) => self.print_class_const(cc),
            EnumMemberKind::TraitUse(tu) => self.print_trait_use(tu),
            EnumMemberKind::Property(prop) => self.print_property(prop),
            _ => self.unsupported("enum member"),
        }
    }

    pub(crate) fn print_params(&mut self, params: &[Param]) {
        // Hook bodies span lines, so give each parameter its own.
        if params.iter().any(|param| !param.hooks.is_empty()) {
            self.newline();
            self.indent();
            for param in params.iter() {
                self.write_indent();
                self.print_param(param);
                self.w(",");
                self.newline();
            }
            self.dedent();
            self.write_indent();
            return;
        }
        for (i, param) in params.iter().enumerate() {
            if i > 0 {
                self.w(", ");
            }
            self.print_param(param);
        }
    }

    fn print_param(&mut self, param: &Param) {
        if let Some(doc) = &param.doc_comment {
            self.w(doc.text);
            self.w(" ");
        }
        self.print_attributes_inline(&param.attributes);
        if let Some(vis) = &param.modifiers.visibility {
            self.w(visibility_str(*vis));
            self.w(" ");
        }
        if let Some(set_vis) = &param.modifiers.set_visibility {
            self.w(visibility_str(*set_vis));
            self.w("(set) ");
        }
        if param.modifiers.is_readonly {
            self.w("readonly ");
        }
        if param.modifiers.is_final {
            self.w("final ");
        }
        if let Some(th) = &param.type_hint {
            self.print_type_hint(th);
            self.w(" ");
        }
        if param.by_ref {
            self.w("&");
        }
        if param.variadic {
            self.w("...");
        }
        self.w("$");
        self.w(param.name.or_error());
        if let Some(default) = &param.default {
            self.w(" = ");
            self.print_expr(default, PREC_LOWEST);
        }
        if !param.hooks.is_empty() {
            self.w(" ");
            self.print_property_hooks(&param.hooks);
        } else if param.empty_hook_list {
            self.w(" {}");
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

    pub(crate) fn print_doc_comment(&mut self, doc: Option<&Comment>) {
        if let Some(comment) = doc {
            self.write_doc_comment(comment.text);
            self.newline();
            if let Some(node_start) = self.doc_comment_node_start.take() {
                self.flush_leading_comments(node_start);
            }
            self.write_indent();
        }
    }
}
