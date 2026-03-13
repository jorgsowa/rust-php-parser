use std::borrow::Cow;

use serde::Serialize;

use crate::Span;

/// The root AST node representing a complete PHP file.
#[derive(Debug, Clone, Serialize)]
pub struct Program<'src> {
    pub stmts: Vec<Stmt<'src>>,
    pub span: Span,
}

// =============================================================================
// Names and Types
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Name<'src> {
    pub parts: Vec<Cow<'src, str>>,
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

#[derive(Debug, Clone, Serialize)]
pub struct TypeHint<'src> {
    pub kind: TypeHintKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum TypeHintKind<'src> {
    Named(Name<'src>),
    Nullable(Box<TypeHint<'src>>),
    Union(Vec<TypeHint<'src>>),
    Intersection(Vec<TypeHint<'src>>),
}

// =============================================================================
// Arguments
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Arg<'src> {
    pub name: Option<Cow<'src, str>>,
    pub value: Expr<'src>,
    pub unpack: bool,
    pub span: Span,
}

// =============================================================================
// Attributes
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Attribute<'src> {
    pub name: Name<'src>,
    pub args: Vec<Arg<'src>>,
    pub span: Span,
}

// =============================================================================
// Statements
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Stmt<'src> {
    pub kind: StmtKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum StmtKind<'src> {
    /// Expression statement (e.g. `foo();`)
    Expression(Box<Expr<'src>>),

    /// Echo statement: `echo expr1, expr2;`
    Echo(Vec<Expr<'src>>),

    /// Return statement: `return expr;`
    Return(Option<Box<Expr<'src>>>),

    /// Block statement: `{ stmts }`
    Block(Vec<Stmt<'src>>),

    /// If statement
    If(Box<IfStmt<'src>>),

    /// While loop
    While(Box<WhileStmt<'src>>),

    /// For loop
    For(Box<ForStmt<'src>>),

    /// Foreach loop
    Foreach(Box<ForeachStmt<'src>>),

    /// Do-while loop
    DoWhile(Box<DoWhileStmt<'src>>),

    /// Function declaration
    Function(Box<FunctionDecl<'src>>),

    /// Break statement
    Break(Option<Box<Expr<'src>>>),

    /// Continue statement
    Continue(Option<Box<Expr<'src>>>),

    /// Switch statement
    Switch(Box<SwitchStmt<'src>>),

    /// Goto statement
    Goto(&'src str),

    /// Label statement
    Label(&'src str),

    /// Declare statement
    Declare(Vec<(&'src str, Expr<'src>)>, Option<Box<Stmt<'src>>>),

    /// Unset statement
    Unset(Vec<Expr<'src>>),

    /// Throw statement (also can be expression in PHP 8)
    Throw(Box<Expr<'src>>),

    /// Try/catch/finally
    TryCatch(Box<TryCatchStmt<'src>>),

    /// Global declaration
    Global(Vec<Expr<'src>>),

    /// Class declaration
    Class(Box<ClassDecl<'src>>),

    /// Interface declaration
    Interface(Box<InterfaceDecl<'src>>),

    /// Trait declaration
    Trait(Box<TraitDecl<'src>>),

    /// Enum declaration
    Enum(Box<EnumDecl<'src>>),

    /// Namespace declaration
    Namespace(Box<NamespaceDecl<'src>>),

    /// Use declaration
    Use(UseDecl<'src>),

    /// Top-level constant: `const FOO = expr;`
    Const(Vec<ConstItem<'src>>),

    /// Static variable declaration: `static $x = 1;`
    StaticVar(Vec<StaticVar<'src>>),

    /// __halt_compiler(); with remaining data
    HaltCompiler(&'src str),

    /// Nop (empty statement `;`)
    Nop,

    /// Inline HTML
    InlineHtml(&'src str),

    /// Error placeholder — parser always produces a tree
    Error,
}

#[derive(Debug, Clone, Serialize)]
pub struct IfStmt<'src> {
    pub condition: Expr<'src>,
    pub then_branch: Box<Stmt<'src>>,
    pub elseif_branches: Vec<ElseIfBranch<'src>>,
    pub else_branch: Option<Box<Stmt<'src>>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ElseIfBranch<'src> {
    pub condition: Expr<'src>,
    pub body: Stmt<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct WhileStmt<'src> {
    pub condition: Expr<'src>,
    pub body: Box<Stmt<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForStmt<'src> {
    pub init: Vec<Expr<'src>>,
    pub condition: Vec<Expr<'src>>,
    pub update: Vec<Expr<'src>>,
    pub body: Box<Stmt<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForeachStmt<'src> {
    pub expr: Expr<'src>,
    pub key: Option<Expr<'src>>,
    pub value: Expr<'src>,
    pub body: Box<Stmt<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct DoWhileStmt<'src> {
    pub body: Box<Stmt<'src>>,
    pub condition: Expr<'src>,
}

#[derive(Debug, Clone, Serialize)]
pub struct FunctionDecl<'src> {
    pub name: &'src str,
    pub params: Vec<Param<'src>>,
    pub body: Vec<Stmt<'src>>,
    pub return_type: Option<TypeHint<'src>>,
    pub by_ref: bool,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct Param<'src> {
    pub name: &'src str,
    pub type_hint: Option<TypeHint<'src>>,
    pub default: Option<Expr<'src>>,
    pub by_ref: bool,
    pub variadic: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: Vec<Attribute<'src>>,
    #[serde(skip_serializing_if = "Vec::is_empty")]
    pub hooks: Vec<PropertyHook<'src>>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchStmt<'src> {
    pub expr: Expr<'src>,
    pub cases: Vec<SwitchCase<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchCase<'src> {
    pub value: Option<Expr<'src>>,
    pub body: Vec<Stmt<'src>>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct TryCatchStmt<'src> {
    pub body: Vec<Stmt<'src>>,
    pub catches: Vec<CatchClause<'src>>,
    pub finally: Option<Vec<Stmt<'src>>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct CatchClause<'src> {
    pub types: Vec<Name<'src>>,
    pub var: Option<&'src str>,
    pub body: Vec<Stmt<'src>>,
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

#[derive(Debug, Clone, Serialize)]
pub struct ClassDecl<'src> {
    pub name: Option<&'src str>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name<'src>>,
    pub implements: Vec<Name<'src>>,
    pub members: Vec<ClassMember<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize, Default)]
pub struct ClassModifiers {
    pub is_abstract: bool,
    pub is_final: bool,
    pub is_readonly: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassMember<'src> {
    pub kind: ClassMemberKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ClassMemberKind<'src> {
    Property(PropertyDecl<'src>),
    Method(MethodDecl<'src>),
    ClassConst(ClassConstDecl<'src>),
    TraitUse(TraitUseDecl<'src>),
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyDecl<'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint<'src>>,
    pub default: Option<Expr<'src>>,
    pub attributes: Vec<Attribute<'src>>,
    #[serde(skip_serializing_if = "Vec::is_empty")]
    pub hooks: Vec<PropertyHook<'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum PropertyHookKind {
    Get,
    Set,
}

#[derive(Debug, Clone, Serialize)]
pub enum PropertyHookBody<'src> {
    Block(Vec<Stmt<'src>>),
    Expression(Expr<'src>),
    Abstract,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyHook<'src> {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody<'src>,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Vec<Param<'src>>,
    pub attributes: Vec<Attribute<'src>>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodDecl<'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Vec<Param<'src>>,
    pub return_type: Option<TypeHint<'src>>,
    pub body: Option<Vec<Stmt<'src>>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassConstDecl<'src> {
    pub name: &'src str,
    pub visibility: Option<Visibility>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<TypeHint<'src>>,
    pub value: Expr<'src>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitUseDecl<'src> {
    pub traits: Vec<Name<'src>>,
    pub adaptations: Vec<TraitAdaptation<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitAdaptation<'src> {
    pub kind: TraitAdaptationKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum TraitAdaptationKind<'src> {
    /// `A::foo insteadof B, C;`
    Precedence {
        trait_name: Name<'src>,
        method: &'src str,
        insteadof: Vec<Name<'src>>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        trait_name: Option<Name<'src>>,
        method: Cow<'src, str>,
        new_modifier: Option<Visibility>,
        new_name: Option<&'src str>,
    },
}

#[derive(Debug, Clone, Serialize)]
pub struct InterfaceDecl<'src> {
    pub name: &'src str,
    pub extends: Vec<Name<'src>>,
    pub members: Vec<ClassMember<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitDecl<'src> {
    pub name: &'src str,
    pub members: Vec<ClassMember<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumDecl<'src> {
    pub name: &'src str,
    pub scalar_type: Option<Name<'src>>,
    pub implements: Vec<Name<'src>>,
    pub members: Vec<EnumMember<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumMember<'src> {
    pub kind: EnumMemberKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum EnumMemberKind<'src> {
    Case(EnumCase<'src>),
    Method(MethodDecl<'src>),
    ClassConst(ClassConstDecl<'src>),
    TraitUse(TraitUseDecl<'src>),
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumCase<'src> {
    pub name: &'src str,
    pub value: Option<Expr<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

// =============================================================================
// Namespace & Use
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct NamespaceDecl<'src> {
    pub name: Option<Name<'src>>,
    pub body: NamespaceBody<'src>,
}

#[derive(Debug, Clone, Serialize)]
pub enum NamespaceBody<'src> {
    Braced(Vec<Stmt<'src>>),
    Simple,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseDecl<'src> {
    pub kind: UseKind,
    pub uses: Vec<UseItem<'src>>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    Normal,
    Function,
    Const,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseItem<'src> {
    pub name: Name<'src>,
    pub alias: Option<&'src str>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ConstItem<'src> {
    pub name: &'src str,
    pub value: Expr<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticVar<'src> {
    pub name: &'src str,
    pub default: Option<Expr<'src>>,
    pub span: Span,
}

// =============================================================================
// Expressions
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Expr<'src> {
    pub kind: ExprKind<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ExprKind<'src> {
    /// Integer literal
    Int(i64),

    /// Float literal
    Float(f64),

    /// String literal
    String(Cow<'src, str>),

    /// Interpolated string: `"Hello $name, you are {$age} years old"`
    InterpolatedString(Vec<StringPart<'src>>),

    /// Heredoc: `<<<EOT ... EOT`
    Heredoc {
        label: String,
        parts: Vec<StringPart<'src>>,
    },

    /// Nowdoc: `<<<'EOT' ... EOT`
    Nowdoc { label: String, value: String },

    /// Shell execution: `` `command $var` ``
    ShellExec(Vec<StringPart<'src>>),

    /// Boolean literal
    Bool(bool),

    /// Null literal
    Null,

    /// Variable: `$name`
    Variable(Cow<'src, str>),

    /// Variable variable: `$$var`, `$$$var`, `${expr}`
    VariableVariable(Box<Expr<'src>>),

    /// Identifier (bare name, e.g. function name in a call)
    Identifier(Cow<'src, str>),

    /// Assignment: `$x = expr` or `$x += expr`
    Assign(AssignExpr<'src>),

    /// Binary operation: `expr op expr`
    Binary(BinaryExpr<'src>),

    /// Unary prefix: `-expr`, `!expr`, `~expr`, `++$x`, `--$x`
    UnaryPrefix(UnaryPrefixExpr<'src>),

    /// Unary postfix: `$x++`, `$x--`
    UnaryPostfix(UnaryPostfixExpr<'src>),

    /// Ternary: `cond ? then : else` or short `cond ?: else`
    Ternary(TernaryExpr<'src>),

    /// Null coalescing: `expr ?? fallback`
    NullCoalesce(NullCoalesceExpr<'src>),

    /// Function call: `name(args)`
    FunctionCall(FunctionCallExpr<'src>),

    /// Array literal: `[1, 2, 3]` or `['a' => 1]`
    Array(Vec<ArrayElement<'src>>),

    /// Array access: `$arr[index]`
    ArrayAccess(ArrayAccessExpr<'src>),

    /// Print expression: `print expr`
    Print(Box<Expr<'src>>),

    /// Parenthesized expression: `(expr)`
    Parenthesized(Box<Expr<'src>>),

    /// Cast expression: `(int)$x`, `(string)$x`, etc.
    Cast(CastKind, Box<Expr<'src>>),

    /// Error suppression: `@expr`
    ErrorSuppress(Box<Expr<'src>>),

    /// Isset: `isset($a, $b)`
    Isset(Vec<Expr<'src>>),

    /// Empty: `empty($a)`
    Empty(Box<Expr<'src>>),

    /// Include/require: `include 'file.php'`
    Include(IncludeKind, Box<Expr<'src>>),

    /// Eval: `eval('code')`
    Eval(Box<Expr<'src>>),

    /// Exit/die: `exit`, `exit(1)`, `die('msg')`
    Exit(Option<Box<Expr<'src>>>),

    /// Magic constant: `__LINE__`, `__FILE__`, etc.
    MagicConst(MagicConstKind),

    /// Clone: `clone $obj`
    Clone(Box<Expr<'src>>),

    /// New: `new Class(args)`
    New(NewExpr<'src>),

    /// Property access: `$obj->prop`
    PropertyAccess(PropertyAccessExpr<'src>),

    /// Nullsafe property access: `$obj?->prop`
    NullsafePropertyAccess(PropertyAccessExpr<'src>),

    /// Method call: `$obj->method(args)`
    MethodCall(MethodCallExpr<'src>),

    /// Nullsafe method call: `$obj?->method(args)`
    NullsafeMethodCall(MethodCallExpr<'src>),

    /// Static property access: `Class::$prop`
    StaticPropertyAccess(StaticAccessExpr<'src>),

    /// Static method call: `Class::method(args)`
    StaticMethodCall(StaticMethodCallExpr<'src>),

    /// Class constant access: `Class::CONST`
    ClassConstAccess(StaticAccessExpr<'src>),

    /// Dynamic class constant access: `Foo::{expr}`
    ClassConstAccessDynamic {
        class: Box<Expr<'src>>,
        member: Box<Expr<'src>>,
    },

    /// Dynamic static property access: `A::$$b`, `A::${'b'}`
    StaticPropertyAccessDynamic {
        class: Box<Expr<'src>>,
        member: Box<Expr<'src>>,
    },

    /// Closure: `function($x) use($y) { }`
    Closure(Box<ClosureExpr<'src>>),

    /// Arrow function: `fn($x) => expr`
    ArrowFunction(Box<ArrowFunctionExpr<'src>>),

    /// Match: `match(expr) { ... }`
    Match(MatchExpr<'src>),

    /// Throw as expression (PHP 8)
    ThrowExpr(Box<Expr<'src>>),

    /// Yield: `yield` / `yield $val` / `yield $key => $val`
    Yield(YieldExpr<'src>),

    /// Anonymous class: `new class(args) extends Foo implements Bar { ... }`
    AnonymousClass(Box<ClassDecl<'src>>),

    /// First-class callable: `strlen(...)`, `$obj->method(...)`, `Foo::bar(...)`
    CallableCreate(CallableCreateExpr<'src>),

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

#[derive(Debug, Clone, Serialize)]
pub struct AssignExpr<'src> {
    pub target: Box<Expr<'src>>,
    pub op: AssignOp,
    pub value: Box<Expr<'src>>,
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

#[derive(Debug, Clone, Serialize)]
pub struct BinaryExpr<'src> {
    pub left: Box<Expr<'src>>,
    pub op: BinaryOp,
    pub right: Box<Expr<'src>>,
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

#[derive(Debug, Clone, Serialize)]
pub struct UnaryPrefixExpr<'src> {
    pub op: UnaryPrefixOp,
    pub operand: Box<Expr<'src>>,
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

#[derive(Debug, Clone, Serialize)]
pub struct UnaryPostfixExpr<'src> {
    pub operand: Box<Expr<'src>>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPostfixOp {
    PostIncrement,
    PostDecrement,
}

#[derive(Debug, Clone, Serialize)]
pub struct TernaryExpr<'src> {
    pub condition: Box<Expr<'src>>,
    /// None for short ternary `$x ?: $y`
    pub then_expr: Option<Box<Expr<'src>>>,
    pub else_expr: Box<Expr<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct NullCoalesceExpr<'src> {
    pub left: Box<Expr<'src>>,
    pub right: Box<Expr<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct FunctionCallExpr<'src> {
    pub name: Box<Expr<'src>>,
    pub args: Vec<Arg<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayElement<'src> {
    pub key: Option<Expr<'src>>,
    pub value: Expr<'src>,
    pub unpack: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayAccessExpr<'src> {
    pub array: Box<Expr<'src>>,
    pub index: Option<Box<Expr<'src>>>,
}

// --- OOP Expression sub-types ---

#[derive(Debug, Clone, Serialize)]
pub struct NewExpr<'src> {
    pub class: Box<Expr<'src>>,
    pub args: Vec<Arg<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyAccessExpr<'src> {
    pub object: Box<Expr<'src>>,
    pub property: Box<Expr<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodCallExpr<'src> {
    pub object: Box<Expr<'src>>,
    pub method: Box<Expr<'src>>,
    pub args: Vec<Arg<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticAccessExpr<'src> {
    pub class: Box<Expr<'src>>,
    pub member: Cow<'src, str>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticMethodCallExpr<'src> {
    pub class: Box<Expr<'src>>,
    pub method: Cow<'src, str>,
    pub args: Vec<Arg<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureExpr<'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Vec<Param<'src>>,
    pub use_vars: Vec<ClosureUseVar<'src>>,
    pub return_type: Option<TypeHint<'src>>,
    pub body: Vec<Stmt<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureUseVar<'src> {
    pub name: &'src str,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrowFunctionExpr<'src> {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Vec<Param<'src>>,
    pub return_type: Option<TypeHint<'src>>,
    pub body: Box<Expr<'src>>,
    pub attributes: Vec<Attribute<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchExpr<'src> {
    pub subject: Box<Expr<'src>>,
    pub arms: Vec<MatchArm<'src>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchArm<'src> {
    /// None for `default`
    pub conditions: Option<Vec<Expr<'src>>>,
    pub body: Expr<'src>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct YieldExpr<'src> {
    pub key: Option<Box<Expr<'src>>>,
    pub value: Option<Box<Expr<'src>>>,
}

// --- First-class callable ---

#[derive(Debug, Clone, Serialize)]
pub struct CallableCreateExpr<'src> {
    pub kind: CallableCreateKind<'src>,
}

#[derive(Debug, Clone, Serialize)]
pub enum CallableCreateKind<'src> {
    /// `foo(...)`, `$var(...)`, `\Ns\func(...)`
    Function(Box<Expr<'src>>),
    /// `$obj->method(...)`
    Method {
        object: Box<Expr<'src>>,
        method: Box<Expr<'src>>,
    },
    /// `$obj?->method(...)`
    NullsafeMethod {
        object: Box<Expr<'src>>,
        method: Box<Expr<'src>>,
    },
    /// `Foo::bar(...)`
    StaticMethod {
        class: Box<Expr<'src>>,
        method: Cow<'src, str>,
    },
}

// --- String interpolation ---

#[derive(Debug, Clone, Serialize)]
pub enum StringPart<'src> {
    Literal(Cow<'src, str>),
    Expr(Expr<'src>),
}
