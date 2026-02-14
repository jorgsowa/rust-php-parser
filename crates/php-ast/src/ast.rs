use serde::Serialize;

use crate::Span;

/// The root AST node representing a complete PHP file.
#[derive(Debug, Clone, Serialize)]
pub struct Program {
    pub stmts: Vec<Stmt>,
    pub span: Span,
}

// =============================================================================
// Names and Types
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Name {
    pub parts: Vec<String>,
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
pub struct TypeHint {
    pub kind: TypeHintKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum TypeHintKind {
    Named(Name),
    Nullable(Box<TypeHint>),
    Union(Vec<TypeHint>),
    Intersection(Vec<TypeHint>),
}

// =============================================================================
// Arguments
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Arg {
    pub name: Option<String>,
    pub value: Expr,
    pub unpack: bool,
    pub span: Span,
}

// =============================================================================
// Attributes
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Attribute {
    pub name: Name,
    pub args: Vec<Arg>,
    pub span: Span,
}

// =============================================================================
// Statements
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Stmt {
    pub kind: StmtKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
#[allow(clippy::large_enum_variant)]
pub enum StmtKind {
    /// Expression statement (e.g. `foo();`)
    Expression(Expr),

    /// Echo statement: `echo expr1, expr2;`
    Echo(Vec<Expr>),

    /// Return statement: `return expr;`
    Return(Option<Expr>),

    /// Block statement: `{ stmts }`
    Block(Vec<Stmt>),

    /// If statement
    If(IfStmt),

    /// While loop
    While(WhileStmt),

    /// For loop
    For(ForStmt),

    /// Foreach loop
    Foreach(ForeachStmt),

    /// Do-while loop
    DoWhile(DoWhileStmt),

    /// Function declaration
    Function(FunctionDecl),

    /// Break statement
    Break(Option<Expr>),

    /// Continue statement
    Continue(Option<Expr>),

    /// Switch statement
    Switch(SwitchStmt),

    /// Goto statement
    Goto(String),

    /// Label statement
    Label(String),

    /// Declare statement
    Declare(Vec<(String, Expr)>, Option<Box<Stmt>>),

    /// Unset statement
    Unset(Vec<Expr>),

    /// Throw statement (also can be expression in PHP 8)
    Throw(Expr),

    /// Try/catch/finally
    TryCatch(TryCatchStmt),

    /// Global declaration
    Global(Vec<Expr>),

    /// Class declaration
    Class(ClassDecl),

    /// Interface declaration
    Interface(InterfaceDecl),

    /// Trait declaration
    Trait(TraitDecl),

    /// Enum declaration
    Enum(EnumDecl),

    /// Namespace declaration
    Namespace(NamespaceDecl),

    /// Use declaration
    Use(UseDecl),

    /// Top-level constant: `const FOO = expr;`
    Const(Vec<ConstItem>),

    /// Static variable declaration: `static $x = 1;`
    StaticVar(Vec<StaticVar>),

    /// __halt_compiler(); with remaining data
    HaltCompiler(String),

    /// Nop (empty statement `;`)
    Nop,

    /// Inline HTML
    InlineHtml(String),

    /// Error placeholder — parser always produces a tree
    Error,
}

#[derive(Debug, Clone, Serialize)]
pub struct IfStmt {
    pub condition: Expr,
    pub then_branch: Box<Stmt>,
    pub elseif_branches: Vec<ElseIfBranch>,
    pub else_branch: Option<Box<Stmt>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ElseIfBranch {
    pub condition: Expr,
    pub body: Stmt,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct WhileStmt {
    pub condition: Expr,
    pub body: Box<Stmt>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForStmt {
    pub init: Vec<Expr>,
    pub condition: Vec<Expr>,
    pub update: Vec<Expr>,
    pub body: Box<Stmt>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ForeachStmt {
    pub expr: Expr,
    pub key: Option<Expr>,
    pub value: Expr,
    pub body: Box<Stmt>,
}

#[derive(Debug, Clone, Serialize)]
pub struct DoWhileStmt {
    pub body: Box<Stmt>,
    pub condition: Expr,
}

#[derive(Debug, Clone, Serialize)]
pub struct FunctionDecl {
    pub name: String,
    pub params: Vec<Param>,
    pub body: Vec<Stmt>,
    pub return_type: Option<TypeHint>,
    pub by_ref: bool,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct Param {
    pub name: String,
    pub type_hint: Option<TypeHint>,
    pub default: Option<Expr>,
    pub by_ref: bool,
    pub variadic: bool,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub attributes: Vec<Attribute>,
    #[serde(skip_serializing_if = "Vec::is_empty")]
    pub hooks: Vec<PropertyHook>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchStmt {
    pub expr: Expr,
    pub cases: Vec<SwitchCase>,
}

#[derive(Debug, Clone, Serialize)]
pub struct SwitchCase {
    pub value: Option<Expr>,
    pub body: Vec<Stmt>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct TryCatchStmt {
    pub body: Vec<Stmt>,
    pub catches: Vec<CatchClause>,
    pub finally: Option<Vec<Stmt>>,
}

#[derive(Debug, Clone, Serialize)]
pub struct CatchClause {
    pub types: Vec<Name>,
    pub var: Option<String>,
    pub body: Vec<Stmt>,
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
pub struct ClassDecl {
    pub name: Option<String>,
    pub modifiers: ClassModifiers,
    pub extends: Option<Name>,
    pub implements: Vec<Name>,
    pub members: Vec<ClassMember>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize, Default)]
pub struct ClassModifiers {
    pub is_abstract: bool,
    pub is_final: bool,
    pub is_readonly: bool,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassMember {
    pub kind: ClassMemberKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ClassMemberKind {
    Property(PropertyDecl),
    Method(MethodDecl),
    ClassConst(ClassConstDecl),
    TraitUse(TraitUseDecl),
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyDecl {
    pub name: String,
    pub visibility: Option<Visibility>,
    pub set_visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_readonly: bool,
    pub type_hint: Option<TypeHint>,
    pub default: Option<Expr>,
    pub attributes: Vec<Attribute>,
    #[serde(skip_serializing_if = "Vec::is_empty")]
    pub hooks: Vec<PropertyHook>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum PropertyHookKind {
    Get,
    Set,
}

#[derive(Debug, Clone, Serialize)]
pub enum PropertyHookBody {
    Block(Vec<Stmt>),
    Expression(Expr),
    Abstract,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyHook {
    pub kind: PropertyHookKind,
    pub body: PropertyHookBody,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Vec<Param>,
    pub attributes: Vec<Attribute>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodDecl {
    pub name: String,
    pub visibility: Option<Visibility>,
    pub is_static: bool,
    pub is_abstract: bool,
    pub is_final: bool,
    pub by_ref: bool,
    pub params: Vec<Param>,
    pub return_type: Option<TypeHint>,
    pub body: Option<Vec<Stmt>>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClassConstDecl {
    pub name: String,
    pub visibility: Option<Visibility>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub type_hint: Option<TypeHint>,
    pub value: Expr,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitUseDecl {
    pub traits: Vec<Name>,
    pub adaptations: Vec<TraitAdaptation>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitAdaptation {
    pub kind: TraitAdaptationKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum TraitAdaptationKind {
    /// `A::foo insteadof B, C;`
    Precedence {
        trait_name: Name,
        method: String,
        insteadof: Vec<Name>,
    },
    /// `foo as bar;` or `A::foo as protected bar;` or `foo as protected;`
    Alias {
        trait_name: Option<Name>,
        method: String,
        new_modifier: Option<Visibility>,
        new_name: Option<String>,
    },
}

#[derive(Debug, Clone, Serialize)]
pub struct InterfaceDecl {
    pub name: String,
    pub extends: Vec<Name>,
    pub members: Vec<ClassMember>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct TraitDecl {
    pub name: String,
    pub members: Vec<ClassMember>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumDecl {
    pub name: String,
    pub scalar_type: Option<Name>,
    pub implements: Vec<Name>,
    pub members: Vec<EnumMember>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumMember {
    pub kind: EnumMemberKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum EnumMemberKind {
    Case(EnumCase),
    Method(MethodDecl),
    ClassConst(ClassConstDecl),
    TraitUse(TraitUseDecl),
}

#[derive(Debug, Clone, Serialize)]
pub struct EnumCase {
    pub name: String,
    pub value: Option<Expr>,
    pub attributes: Vec<Attribute>,
}

// =============================================================================
// Namespace & Use
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct NamespaceDecl {
    pub name: Option<Name>,
    pub body: NamespaceBody,
}

#[derive(Debug, Clone, Serialize)]
pub enum NamespaceBody {
    Braced(Vec<Stmt>),
    Simple,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseDecl {
    pub kind: UseKind,
    pub uses: Vec<UseItem>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UseKind {
    Normal,
    Function,
    Const,
}

#[derive(Debug, Clone, Serialize)]
pub struct UseItem {
    pub name: Name,
    pub alias: Option<String>,
    #[serde(skip_serializing_if = "Option::is_none")]
    pub kind: Option<UseKind>,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ConstItem {
    pub name: String,
    pub value: Expr,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticVar {
    pub name: String,
    pub default: Option<Expr>,
    pub span: Span,
}

// =============================================================================
// Expressions
// =============================================================================

#[derive(Debug, Clone, Serialize)]
pub struct Expr {
    pub kind: ExprKind,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub enum ExprKind {
    /// Integer literal
    Int(i64),

    /// Float literal
    Float(f64),

    /// String literal
    String(String),

    /// Interpolated string: `"Hello $name, you are {$age} years old"`
    InterpolatedString(Vec<StringPart>),

    /// Heredoc: `<<<EOT ... EOT`
    Heredoc {
        label: String,
        parts: Vec<StringPart>,
    },

    /// Nowdoc: `<<<'EOT' ... EOT`
    Nowdoc { label: String, value: String },

    /// Shell execution: `` `command $var` ``
    ShellExec(Vec<StringPart>),

    /// Boolean literal
    Bool(bool),

    /// Null literal
    Null,

    /// Variable: `$name`
    Variable(String),

    /// Variable variable: `$$var`, `$$$var`, `${expr}`
    VariableVariable(Box<Expr>),

    /// Identifier (bare name, e.g. function name in a call)
    Identifier(String),

    /// Assignment: `$x = expr` or `$x += expr`
    Assign(AssignExpr),

    /// Binary operation: `expr op expr`
    Binary(BinaryExpr),

    /// Unary prefix: `-expr`, `!expr`, `~expr`, `++$x`, `--$x`
    UnaryPrefix(UnaryPrefixExpr),

    /// Unary postfix: `$x++`, `$x--`
    UnaryPostfix(UnaryPostfixExpr),

    /// Ternary: `cond ? then : else` or short `cond ?: else`
    Ternary(TernaryExpr),

    /// Null coalescing: `expr ?? fallback`
    NullCoalesce(NullCoalesceExpr),

    /// Function call: `name(args)`
    FunctionCall(FunctionCallExpr),

    /// Array literal: `[1, 2, 3]` or `['a' => 1]`
    Array(Vec<ArrayElement>),

    /// Array access: `$arr[index]`
    ArrayAccess(ArrayAccessExpr),

    /// Print expression: `print expr`
    Print(Box<Expr>),

    /// Parenthesized expression: `(expr)`
    Parenthesized(Box<Expr>),

    /// Cast expression: `(int)$x`, `(string)$x`, etc.
    Cast(CastKind, Box<Expr>),

    /// Error suppression: `@expr`
    ErrorSuppress(Box<Expr>),

    /// Isset: `isset($a, $b)`
    Isset(Vec<Expr>),

    /// Empty: `empty($a)`
    Empty(Box<Expr>),

    /// Include/require: `include 'file.php'`
    Include(IncludeKind, Box<Expr>),

    /// Eval: `eval('code')`
    Eval(Box<Expr>),

    /// Exit/die: `exit`, `exit(1)`, `die('msg')`
    Exit(Option<Box<Expr>>),

    /// Magic constant: `__LINE__`, `__FILE__`, etc.
    MagicConst(MagicConstKind),

    /// Clone: `clone $obj`
    Clone(Box<Expr>),

    /// New: `new Class(args)`
    New(NewExpr),

    /// Property access: `$obj->prop`
    PropertyAccess(PropertyAccessExpr),

    /// Nullsafe property access: `$obj?->prop`
    NullsafePropertyAccess(PropertyAccessExpr),

    /// Method call: `$obj->method(args)`
    MethodCall(MethodCallExpr),

    /// Nullsafe method call: `$obj?->method(args)`
    NullsafeMethodCall(MethodCallExpr),

    /// Static property access: `Class::$prop`
    StaticPropertyAccess(StaticAccessExpr),

    /// Static method call: `Class::method(args)`
    StaticMethodCall(StaticMethodCallExpr),

    /// Class constant access: `Class::CONST`
    ClassConstAccess(StaticAccessExpr),

    /// Dynamic class constant access: `Foo::{expr}`
    ClassConstAccessDynamic { class: Box<Expr>, member: Box<Expr> },

    /// Dynamic static property access: `A::$$b`, `A::${'b'}`
    StaticPropertyAccessDynamic { class: Box<Expr>, member: Box<Expr> },

    /// Closure: `function($x) use($y) { }`
    Closure(ClosureExpr),

    /// Arrow function: `fn($x) => expr`
    ArrowFunction(ArrowFunctionExpr),

    /// Match: `match(expr) { ... }`
    Match(MatchExpr),

    /// Throw as expression (PHP 8)
    ThrowExpr(Box<Expr>),

    /// Yield: `yield` / `yield $val` / `yield $key => $val`
    Yield(YieldExpr),

    /// Anonymous class: `new class(args) extends Foo implements Bar { ... }`
    AnonymousClass(ClassDecl),

    /// First-class callable: `strlen(...)`, `$obj->method(...)`, `Foo::bar(...)`
    CallableCreate(CallableCreateExpr),

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
pub struct AssignExpr {
    pub target: Box<Expr>,
    pub op: AssignOp,
    pub value: Box<Expr>,
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
pub struct BinaryExpr {
    pub left: Box<Expr>,
    pub op: BinaryOp,
    pub right: Box<Expr>,
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
pub struct UnaryPrefixExpr {
    pub op: UnaryPrefixOp,
    pub operand: Box<Expr>,
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
pub struct UnaryPostfixExpr {
    pub operand: Box<Expr>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPostfixOp {
    PostIncrement,
    PostDecrement,
}

#[derive(Debug, Clone, Serialize)]
pub struct TernaryExpr {
    pub condition: Box<Expr>,
    /// None for short ternary `$x ?: $y`
    pub then_expr: Option<Box<Expr>>,
    pub else_expr: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct NullCoalesceExpr {
    pub left: Box<Expr>,
    pub right: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct FunctionCallExpr {
    pub name: Box<Expr>,
    pub args: Vec<Arg>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayElement {
    pub key: Option<Expr>,
    pub value: Expr,
    pub unpack: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrayAccessExpr {
    pub array: Box<Expr>,
    pub index: Option<Box<Expr>>,
}

// --- OOP Expression sub-types ---

#[derive(Debug, Clone, Serialize)]
pub struct NewExpr {
    pub class: Box<Expr>,
    pub args: Vec<Arg>,
}

#[derive(Debug, Clone, Serialize)]
pub struct PropertyAccessExpr {
    pub object: Box<Expr>,
    pub property: Box<Expr>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MethodCallExpr {
    pub object: Box<Expr>,
    pub method: Box<Expr>,
    pub args: Vec<Arg>,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticAccessExpr {
    pub class: Box<Expr>,
    pub member: String,
}

#[derive(Debug, Clone, Serialize)]
pub struct StaticMethodCallExpr {
    pub class: Box<Expr>,
    pub method: String,
    pub args: Vec<Arg>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureExpr {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Vec<Param>,
    pub use_vars: Vec<ClosureUseVar>,
    pub return_type: Option<TypeHint>,
    pub body: Vec<Stmt>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct ClosureUseVar {
    pub name: String,
    pub by_ref: bool,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct ArrowFunctionExpr {
    pub is_static: bool,
    pub by_ref: bool,
    pub params: Vec<Param>,
    pub return_type: Option<TypeHint>,
    pub body: Box<Expr>,
    pub attributes: Vec<Attribute>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchExpr {
    pub subject: Box<Expr>,
    pub arms: Vec<MatchArm>,
}

#[derive(Debug, Clone, Serialize)]
pub struct MatchArm {
    /// None for `default`
    pub conditions: Option<Vec<Expr>>,
    pub body: Expr,
    pub span: Span,
}

#[derive(Debug, Clone, Serialize)]
pub struct YieldExpr {
    pub key: Option<Box<Expr>>,
    pub value: Option<Box<Expr>>,
}

// --- First-class callable ---

#[derive(Debug, Clone, Serialize)]
pub struct CallableCreateExpr {
    pub kind: CallableCreateKind,
}

#[derive(Debug, Clone, Serialize)]
pub enum CallableCreateKind {
    /// `foo(...)`, `$var(...)`, `\Ns\func(...)`
    Function(Box<Expr>),
    /// `$obj->method(...)`
    Method {
        object: Box<Expr>,
        method: Box<Expr>,
    },
    /// `$obj?->method(...)`
    NullsafeMethod {
        object: Box<Expr>,
        method: Box<Expr>,
    },
    /// `Foo::bar(...)`
    StaticMethod { class: Box<Expr>, method: String },
}

// --- String interpolation ---

#[derive(Debug, Clone, Serialize)]
pub enum StringPart {
    Literal(String),
    Expr(Expr),
}
