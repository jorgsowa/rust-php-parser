use std::borrow::Cow;

use serde::Serialize;

use crate::Span;

/// Arena-allocated Vec. Thin newtype over bumpalo::collections::Vec that implements Serialize and Debug.
pub struct ArenaVec<'arena, T>(bumpalo::collections::Vec<'arena, T>);

impl<'arena, T> ArenaVec<'arena, T> {
    #[inline]
    pub fn new_in(arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::new_in(arena))
    }
    #[inline]
    pub fn with_capacity_in(cap: usize, arena: &'arena bumpalo::Bump) -> Self {
        Self(bumpalo::collections::Vec::with_capacity_in(cap, arena))
    }
    #[inline]
    pub fn push(&mut self, val: T) {
        self.0.push(val)
    }
    #[inline]
    pub fn is_empty(&self) -> bool {
        self.0.is_empty()
    }
    #[inline]
    pub fn len(&self) -> usize {
        self.0.len()
    }
    #[inline]
    pub fn last(&self) -> Option<&T> {
        self.0.last()
    }
}

impl<'arena, T> IntoIterator for ArenaVec<'arena, T> {
    type Item = T;
    type IntoIter = bumpalo::collections::vec::IntoIter<'arena, T>;
    #[inline]
    fn into_iter(self) -> Self::IntoIter {
        self.0.into_iter()
    }
}

impl<'arena, T> std::ops::Deref for ArenaVec<'arena, T> {
    type Target = [T];
    #[inline]
    fn deref(&self) -> &[T] {
        &self.0
    }
}

impl<'arena, T> std::ops::DerefMut for ArenaVec<'arena, T> {
    #[inline]
    fn deref_mut(&mut self) -> &mut [T] {
        &mut self.0
    }
}

impl<'arena, T: serde::Serialize> serde::Serialize for ArenaVec<'arena, T> {
    fn serialize<S: serde::Serializer>(&self, s: S) -> Result<S::Ok, S::Error> {
        self.0.as_slice().serialize(s)
    }
}

impl<'arena, T: std::fmt::Debug> std::fmt::Debug for ArenaVec<'arena, T> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        self.0.as_slice().fmt(f)
    }
}

/// The root AST node representing a complete PHP file.
#[derive(Debug, Serialize)]
pub struct Program<'arena, 'src> {
    pub stmts: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Names and Types
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Name<'arena, 'src> {
    pub parts: ArenaVec<'arena, Cow<'src, str>>,
    pub kind: NameKind,
    pub span: Span,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum NameKind {
    Unqualified,
    Qualified,
    FullyQualified,
    Relative,
}

#[derive(Debug, Serialize)]
pub struct TypeHint<'arena, 'src> {
    pub kind: TypeHintKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum TypeHintKind<'arena, 'src> {
    Named(Name<'arena, 'src>),
    Nullable(&'arena TypeHint<'arena, 'src>),
    Union(ArenaVec<'arena, TypeHint<'arena, 'src>>),
    Intersection(ArenaVec<'arena, TypeHint<'arena, 'src>>),
}

// =============================================================================
// Arguments
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Arg<'arena, 'src> {
    pub name: Option<Cow<'src, str>>,
    pub value: Expr<'arena, 'src>,
    pub unpack: bool,
    pub span: Span,
}

// =============================================================================
// Attributes
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Attribute<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Statements
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Stmt<'arena, 'src> {
    pub kind: StmtKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum StmtKind<'arena, 'src> {
    /// Expression statement (e.g. `foo();`)
    Expression(&'arena Expr<'arena, 'src>),

    /// Echo statement: `echo expr1, expr2;`
    Echo(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Return statement: `return expr;`
    Return(Option<&'arena Expr<'arena, 'src>>),

    /// Block statement: `{ stmts }`
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),

    /// If statement
    If(&'arena IfStmt<'arena, 'src>),

    /// While loop
    While(&'arena WhileStmt<'arena, 'src>),

    /// For loop
    For(&'arena ForStmt<'arena, 'src>),

    /// Foreach loop
    Foreach(&'arena ForeachStmt<'arena, 'src>),

    /// Do-while loop
    DoWhile(&'arena DoWhileStmt<'arena, 'src>),

    /// Function declaration
    Function(&'arena FunctionDecl<'arena, 'src>),

    /// Break statement
    Break(Option<&'arena Expr<'arena, 'src>>),

    /// Continue statement
    Continue(Option<&'arena Expr<'arena, 'src>>),

    /// Switch statement
    Switch(&'arena SwitchStmt<'arena, 'src>),

    /// Goto statement
    Goto(&'src str),

    /// Label statement
    Label(&'src str),

    /// Declare statement
    Declare(&'arena DeclareStmt<'arena, 'src>),

    /// Unset statement
    Unset(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Throw statement (also can be expression in PHP 8)
    Throw(&'arena Expr<'arena, 'src>),

    /// Try/catch/finally
    TryCatch(&'arena TryCatchStmt<'arena, 'src>),

    /// Global declaration
    Global(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Class declaration
    Class(&'arena ClassDecl<'arena, 'src>),

    /// Interface declaration
    Interface(&'arena InterfaceDecl<'arena, 'src>),

    /// Trait declaration
    Trait(&'arena TraitDecl<'arena, 'src>),

    /// Enum declaration
    Enum(&'arena EnumDecl<'arena, 'src>),

    /// Namespace declaration
    Namespace(&'arena NamespaceDecl<'arena, 'src>),

    /// Use declaration
    Use(&'arena UseDecl<'arena, 'src>),

    /// Top-level constant: `const FOO = expr;`
    Const(ArenaVec<'arena, ConstItem<'arena, 'src>>),

    /// Static variable declaration: `static $x = 1;`
    StaticVar(ArenaVec<'arena, StaticVar<'arena, 'src>>),

    /// __halt_compiler(); with remaining data
    HaltCompiler(&'src str),

    /// Nop (empty statement `;`)
    Nop,

    /// Inline HTML
    InlineHtml(&'src str),

    /// Error placeholder — parser always produces a tree
    Error,
}

#[derive(Debug, Serialize)]
pub struct IfStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub then_branch: &'arena Stmt<'arena, 'src>,
    pub elseif_branches: ArenaVec<'arena, ElseIfBranch<'arena, 'src>>,
    pub else_branch: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ElseIfBranch<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: Stmt<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct WhileStmt<'arena, 'src> {
    pub condition: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForStmt<'arena, 'src> {
    pub init: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub condition: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub update: ArenaVec<'arena, Expr<'arena, 'src>>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct ForeachStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub key: Option<Expr<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub body: &'arena Stmt<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct DoWhileStmt<'arena, 'src> {
    pub body: &'arena Stmt<'arena, 'src>,
    pub condition: Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct FunctionDecl<'arena, 'src> {
    pub name: &'src str,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub by_ref: bool,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct Param<'arena, 'src> {
    pub name: &'src str,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub by_ref: bool,
    pub variadic: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct SwitchStmt<'arena, 'src> {
    pub expr: Expr<'arena, 'src>,
    pub cases: ArenaVec<'arena, SwitchCase<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct SwitchCase<'arena, 'src> {
    pub value: Option<Expr<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct TryCatchStmt<'arena, 'src> {
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub catches: ArenaVec<'arena, CatchClause<'arena, 'src>>,
    pub finally: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
}

#[derive(Debug, Serialize)]
pub struct CatchClause<'arena, 'src> {
    pub types: ArenaVec<'arena, Name<'arena, 'src>>,
    pub var: Option<&'src str>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// OOP Declarations
// =============================================================================

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum Visibility {
    Public,
    Protected,
    Private,
}

#[derive(Debug, Serialize)]
pub struct ClassDecl<'arena, 'src> {
    pub name: Option<&'src str>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Clone, Serialize, Default)]
pub struct ClassModifiers {
    pub is_abstract: bool,
    pub is_final: bool,
    pub is_readonly: bool,
}

#[derive(Debug, Serialize)]
pub struct ClassMember<'arena, 'src> {
    pub kind: ClassMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum ClassMemberKind<'arena, 'src> {
    Property(PropertyDecl<'arena, 'src>),
    Method(MethodDecl<'arena, 'src>),
    ClassConst(ClassConstDecl<'arena, 'src>),
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct PropertyDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint<'arena, 'src>>,
    pub default: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    #[serde(skip_serializing_if = "ArenaVec::is_empty")]
    pub hooks: ArenaVec<'arena, PropertyHook<'arena, 'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum PropertyHookKind {
    Get,
    Set,
}

#[derive(Debug, Serialize)]
pub enum PropertyHookBody<'arena, 'src> {
    Block(ArenaVec<'arena, Stmt<'arena, 'src>>),
    Expression(Expr<'arena, 'src>),
    Abstract,
}

#[derive(Debug, Serialize)]
pub struct PropertyHook<'arena, 'src> {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody<'arena, 'src>,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct MethodDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: Option<ArenaVec<'arena, Stmt<'arena, 'src>>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ClassConstDecl<'arena, 'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<&'arena TypeHint<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitUseDecl<'arena, 'src> {
    pub traits: ArenaVec<'arena, Name<'arena, 'src>>,
    pub adaptations: ArenaVec<'arena, TraitAdaptation<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitAdaptation<'arena, 'src> {
    pub kind: TraitAdaptationKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum TraitAdaptationKind<'arena, 'src> {
    /// `A::foo insteadof B, C;`
    Precedence {
        trait_name: Name<'arena, 'src>,
        method: &'src str,
        insteadof: ArenaVec<'arena, Name<'arena, 'src>>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        trait_name: Option<Name<'arena, 'src>>,
        method: Cow<'src, str>,
        new_modifier: Option<Visibility>,
        new_name: Option<&'src str>,
    },
}

#[derive(Debug, Serialize)]
pub struct InterfaceDecl<'arena, 'src> {
    pub name: &'src str,
    pub extends: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct TraitDecl<'arena, 'src> {
    pub name: &'src str,
    pub members: ArenaVec<'arena, ClassMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumDecl<'arena, 'src> {
    pub name: &'src str,
    pub scalar_type: Option<Name<'arena, 'src>>,
    pub implements: ArenaVec<'arena, Name<'arena, 'src>>,
    pub members: ArenaVec<'arena, EnumMember<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct EnumMember<'arena, 'src> {
    pub kind: EnumMemberKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum EnumMemberKind<'arena, 'src> {
    Case(EnumCase<'arena, 'src>),
    Method(MethodDecl<'arena, 'src>),
    ClassConst(ClassConstDecl<'arena, 'src>),
    TraitUse(TraitUseDecl<'arena, 'src>),
}

#[derive(Debug, Serialize)]
pub struct EnumCase<'arena, 'src> {
    pub name: &'src str,
    pub value: Option<Expr<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

// =============================================================================
// Namespace & Use
// =============================================================================

#[derive(Debug, Serialize)]
pub struct NamespaceDecl<'arena, 'src> {
    pub name: Option<Name<'arena, 'src>>,
    pub body: NamespaceBody<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub enum NamespaceBody<'arena, 'src> {
    Braced(ArenaVec<'arena, Stmt<'arena, 'src>>),
    Simple,
}

#[derive(Debug, Serialize)]
pub struct DeclareStmt<'arena, 'src> {
    pub directives: ArenaVec<'arena, (&'src str, Expr<'arena, 'src>)>,
    pub body: Option<&'arena Stmt<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct UseDecl<'arena, 'src> {
    pub kind: UseKind,
    pub uses: ArenaVec<'arena, UseItem<'arena, 'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    Normal,
    Function,
    Const,
}

#[derive(Debug, Serialize)]
pub struct UseItem<'arena, 'src> {
    pub name: Name<'arena, 'src>,
    pub alias: Option<&'src str>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ConstItem<'arena, 'src> {
    pub name: &'src str,
    pub value: Expr<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct StaticVar<'arena, 'src> {
    pub name: &'src str,
    pub default: Option<Expr<'arena, 'src>>,
    pub span: Span,
}

// =============================================================================
// Expressions
// =============================================================================

#[derive(Debug, Serialize)]
pub struct Expr<'arena, 'src> {
    pub kind: ExprKind<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub enum ExprKind<'arena, 'src> {
    /// Integer literal
    Int(i64),

    /// Float literal
    Float(f64),

    /// String literal
    String(Cow<'src, str>),

    /// Interpolated string: `"Hello $name, you are {$age} years old"`
    InterpolatedString(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Heredoc: `<<<EOT ... EOT`
    Heredoc {
        label: &'src str,
        parts: ArenaVec<'arena, StringPart<'arena, 'src>>,
    },

    /// Nowdoc: `<<<'EOT' ... EOT`
    Nowdoc {
        label: &'src str,
        value: Cow<'src, str>,
    },

    /// Shell execution: `` `command $var` ``
    ShellExec(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Boolean literal
    Bool(bool),

    /// Null literal
    Null,

    /// Variable: `$name`
    Variable(Cow<'src, str>),

    /// Variable variable: `$$var`, `$$$var`, `${expr}`
    VariableVariable(&'arena Expr<'arena, 'src>),

    /// Identifier (bare name, e.g. function name in a call)
    Identifier(Cow<'src, str>),

    /// Assignment: `$x = expr` or `$x += expr`
    Assign(AssignExpr<'arena, 'src>),

    /// Binary operation: `expr op expr`
    Binary(BinaryExpr<'arena, 'src>),

    /// Unary prefix: `-expr`, `!expr`, `~expr`, `++$x`, `--$x`
    UnaryPrefix(UnaryPrefixExpr<'arena, 'src>),

    /// Unary postfix: `$x++`, `$x--`
    UnaryPostfix(UnaryPostfixExpr<'arena, 'src>),

    /// Ternary: `cond ? then : else` or short `cond ?: else`
    Ternary(TernaryExpr<'arena, 'src>),

    /// Null coalescing: `expr ?? fallback`
    NullCoalesce(NullCoalesceExpr<'arena, 'src>),

    /// Function call: `name(args)`
    FunctionCall(FunctionCallExpr<'arena, 'src>),

    /// Array literal: `[1, 2, 3]` or `['a' => 1]`
    Array(ArenaVec<'arena, ArrayElement<'arena, 'src>>),

    /// Array access: `$arr[index]`
    ArrayAccess(ArrayAccessExpr<'arena, 'src>),

    /// Print expression: `print expr`
    Print(&'arena Expr<'arena, 'src>),

    /// Parenthesized expression: `(expr)`
    Parenthesized(&'arena Expr<'arena, 'src>),

    /// Cast expression: `(int)$x`, `(string)$x`, etc.
    Cast(CastKind, &'arena Expr<'arena, 'src>),

    /// Error suppression: `@expr`
    ErrorSuppress(&'arena Expr<'arena, 'src>),

    /// Isset: `isset($a, $b)`
    Isset(ArenaVec<'arena, Expr<'arena, 'src>>),

    /// Empty: `empty($a)`
    Empty(&'arena Expr<'arena, 'src>),

    /// Include/require: `include 'file.php'`
    Include(IncludeKind, &'arena Expr<'arena, 'src>),

    /// Eval: `eval('code')`
    Eval(&'arena Expr<'arena, 'src>),

    /// Exit/die: `exit`, `exit(1)`, `die('msg')`
    Exit(Option<&'arena Expr<'arena, 'src>>),

    /// Magic constant: `__LINE__`, `__FILE__`, etc.
    MagicConst(MagicConstKind),

    /// Clone: `clone $obj`
    Clone(&'arena Expr<'arena, 'src>),

    /// New: `new Class(args)`
    New(NewExpr<'arena, 'src>),

    /// Property access: `$obj->prop`
    PropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Nullsafe property access: `$obj?->prop`
    NullsafePropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Method call: `$obj->method(args)`
    MethodCall(MethodCallExpr<'arena, 'src>),

    /// Nullsafe method call: `$obj?->method(args)`
    NullsafeMethodCall(MethodCallExpr<'arena, 'src>),

    /// Static property access: `Class::$prop`
    StaticPropertyAccess(StaticAccessExpr<'arena, 'src>),

    /// Static method call: `Class::method(args)`
    StaticMethodCall(StaticMethodCallExpr<'arena, 'src>),

    /// Class constant access: `Class::CONST`
    ClassConstAccess(StaticAccessExpr<'arena, 'src>),

    /// Dynamic class constant access: `Foo::{expr}`
    ClassConstAccessDynamic {
        class: &'arena Expr<'arena, 'src>,
        member: &'arena Expr<'arena, 'src>,
    },

    /// Dynamic static property access: `A::$$b`, `A::${'b'}`
    StaticPropertyAccessDynamic {
        class: &'arena Expr<'arena, 'src>,
        member: &'arena Expr<'arena, 'src>,
    },

    /// Closure: `function($x) use($y) { }`
    Closure(&'arena ClosureExpr<'arena, 'src>),

    /// Arrow function: `fn($x) => expr`
    ArrowFunction(&'arena ArrowFunctionExpr<'arena, 'src>),

    /// Match: `match(expr) { ... }`
    Match(MatchExpr<'arena, 'src>),

    /// Throw as expression (PHP 8)
    ThrowExpr(&'arena Expr<'arena, 'src>),

    /// Yield: `yield` / `yield $val` / `yield $key => $val`
    Yield(YieldExpr<'arena, 'src>),

    /// Anonymous class: `new class(args) extends Foo implements Bar { ... }`
    AnonymousClass(&'arena ClassDecl<'arena, 'src>),

    /// First-class callable: `strlen(...)`, `$obj->method(...)`, `Foo::bar(...)`
    CallableCreate(CallableCreateExpr<'arena, 'src>),

    /// Error placeholder
    Error,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum CastKind {
    Int,
    Float,
    String,
    Bool,
    Array,
    Object,
    Unset,
    Void,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum IncludeKind {
    Include,
    IncludeOnce,
    Require,
    RequireOnce,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum MagicConstKind {
    Class,
    Dir,
    File,
    Function,
    Line,
    Method,
    Namespace,
    Trait,
    Property,
}

// --- Expression sub-types ---

#[derive(Debug, Serialize)]
pub struct AssignExpr<'arena, 'src> {
    pub target: &'arena Expr<'arena, 'src>,
    pub op: AssignOp,
    pub value: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum AssignOp {
    Assign,
    Plus,
    Minus,
    Mul,
    Div,
    Mod,
    Pow,
    Concat,
    BitwiseAnd,
    BitwiseOr,
    BitwiseXor,
    ShiftLeft,
    ShiftRight,
    Coalesce,
}

#[derive(Debug, Serialize)]
pub struct BinaryExpr<'arena, 'src> {
    pub left: &'arena Expr<'arena, 'src>,
    pub op: BinaryOp,
    pub right: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum BinaryOp {
    Add,
    Sub,
    Mul,
    Div,
    Mod,
    Pow,
    Concat,
    Equal,
    NotEqual,
    Identical,
    NotIdentical,
    Less,
    Greater,
    LessOrEqual,
    GreaterOrEqual,
    Spaceship,
    BooleanAnd,
    BooleanOr,
    BitwiseAnd,
    BitwiseOr,
    BitwiseXor,
    ShiftLeft,
    ShiftRight,
    LogicalAnd,
    LogicalOr,
    LogicalXor,
    Instanceof,
    Pipe,
}

#[derive(Debug, Serialize)]
pub struct UnaryPrefixExpr<'arena, 'src> {
    pub op: UnaryPrefixOp,
    pub operand: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPrefixOp {
    Negate,
    Plus,
    BooleanNot,
    BitwiseNot,
    PreIncrement,
    PreDecrement,
}

#[derive(Debug, Serialize)]
pub struct UnaryPostfixExpr<'arena, 'src> {
    pub operand: &'arena Expr<'arena, 'src>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPostfixOp {
    PostIncrement,
    PostDecrement,
}

#[derive(Debug, Serialize)]
pub struct TernaryExpr<'arena, 'src> {
    pub condition: &'arena Expr<'arena, 'src>,
    /// None for short ternary `$x ?: $y`
    pub then_expr: Option<&'arena Expr<'arena, 'src>>,
    pub else_expr: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct NullCoalesceExpr<'arena, 'src> {
    pub left: &'arena Expr<'arena, 'src>,
    pub right: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct FunctionCallExpr<'arena, 'src> {
    pub name: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ArrayElement<'arena, 'src> {
    pub key: Option<Expr<'arena, 'src>>,
    pub value: Expr<'arena, 'src>,
    pub unpack: bool,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ArrayAccessExpr<'arena, 'src> {
    pub array: &'arena Expr<'arena, 'src>,
    pub index: Option<&'arena Expr<'arena, 'src>>,
}

// --- OOP Expression sub-types ---

#[derive(Debug, Serialize)]
pub struct NewExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct PropertyAccessExpr<'arena, 'src> {
    pub object: &'arena Expr<'arena, 'src>,
    pub property: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct MethodCallExpr<'arena, 'src> {
    pub object: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct StaticAccessExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub member: Cow<'src, str>,
}

#[derive(Debug, Serialize)]
pub struct StaticMethodCallExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub method: Cow<'src, str>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct ClosureExpr<'arena, 'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub use_vars: ArenaVec<'arena, ClosureUseVar<'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: ArenaVec<'arena, Stmt<'arena, 'src>>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureUseVar<'src> {
    pub name: &'src str,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct ArrowFunctionExpr<'arena, 'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    pub return_type: Option<TypeHint<'arena, 'src>>,
    pub body: &'arena Expr<'arena, 'src>,
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct MatchExpr<'arena, 'src> {
    pub subject: &'arena Expr<'arena, 'src>,
    pub arms: ArenaVec<'arena, MatchArm<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct MatchArm<'arena, 'src> {
    /// None for `default`
    pub conditions: Option<ArenaVec<'arena, Expr<'arena, 'src>>>,
    pub body: Expr<'arena, 'src>,
    pub span: Span,
}

#[derive(Debug, Serialize)]
pub struct YieldExpr<'arena, 'src> {
    pub key: Option<&'arena Expr<'arena, 'src>>,
    pub value: Option<&'arena Expr<'arena, 'src>>,
}

// --- First-class callable ---

#[derive(Debug, Serialize)]
pub struct CallableCreateExpr<'arena, 'src> {
    pub kind: CallableCreateKind<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub enum CallableCreateKind<'arena, 'src> {
    /// `foo(...)`, `$var(...)`, `\Ns\func(...)`
    Function(&'arena Expr<'arena, 'src>),
    /// `$obj->method(...)`
    Method {
        object: &'arena Expr<'arena, 'src>,
        method: &'arena Expr<'arena, 'src>,
    },
    /// `$obj?->method(...)`
    NullsafeMethod {
        object: &'arena Expr<'arena, 'src>,
        method: &'arena Expr<'arena, 'src>,
    },
    /// `Foo::bar(...)`
    StaticMethod {
        class: &'arena Expr<'arena, 'src>,
        method: Cow<'src, str>,
    },
}

// --- String interpolation ---

#[derive(Debug, Serialize)]
pub enum StringPart<'arena, 'src> {
    Literal(Cow<'src, str>),
    Expr(Expr<'arena, 'src>),
}
