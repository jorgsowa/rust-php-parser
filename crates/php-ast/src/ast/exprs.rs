use serde::Serialize;

use crate::Span;

use super::{is_false, ArenaVec, Arg, Attribute, ClassDecl, Param, Stmt, TypeHint};

/// A name string that originates either from the source buffer (`&'src str`) or was
/// constructed in the arena (`&'arena str`).
///
/// Using this as the payload for both `ExprKind::Variable` and `ExprKind::Identifier`
/// gives them the same binding type, so or-patterns compile natively:
///
/// ```
/// # use php_ast::ast::{ExprKind, NameStr};
/// # fn example<'a, 'b>(kind: &ExprKind<'a, 'b>) {
/// if let ExprKind::Variable(name) | ExprKind::Identifier(name) = kind {
///     let _s: &str = name.as_str();
/// }
/// # }
/// ```
#[derive(Clone, Copy, PartialEq, Eq, Hash)]
pub enum NameStr<'arena, 'src> {
    /// Borrowed directly from the source buffer.
    Src(&'src str),
    /// Allocated in the bump arena (e.g. a joined qualified name).
    Arena(&'arena str),
}

impl<'arena, 'src> NameStr<'arena, 'src> {
    #[inline]
    pub fn as_str(&self) -> &str {
        match self {
            NameStr::Src(s) => s,
            NameStr::Arena(s) => s,
        }
    }
}

impl<'arena, 'src> std::ops::Deref for NameStr<'arena, 'src> {
    type Target = str;
    #[inline]
    fn deref(&self) -> &str {
        self.as_str()
    }
}

impl<'arena, 'src> std::fmt::Debug for NameStr<'arena, 'src> {
    fn fmt(&self, f: &mut std::fmt::Formatter<'_>) -> std::fmt::Result {
        self.as_str().fmt(f)
    }
}

impl<'arena, 'src> serde::Serialize for NameStr<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, serializer: S) -> Result<S::Ok, S::Error> {
        self.as_str().serialize(serializer)
    }
}

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
    String(&'arena str),

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
        value: &'arena str,
    },

    /// Shell execution: `` `command $var` ``
    ShellExec(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Boolean literal
    Bool(bool),

    /// Null literal
    Null,

    /// Variable: `$name`
    Variable(NameStr<'arena, 'src>),

    /// Variable variable: `$$var`, `$$$var`, `${expr}`
    VariableVariable(&'arena Expr<'arena, 'src>),

    /// Identifier (bare name, e.g. function name in a call)
    Identifier(NameStr<'arena, 'src>),

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

    /// Clone with property overrides: `clone($obj, ['prop' => $val])` — PHP 8.5+
    CloneWith(&'arena Expr<'arena, 'src>, &'arena Expr<'arena, 'src>),

    /// New: `new Class(args)`
    New(NewExpr<'arena, 'src>),

    /// Property access: `$obj->prop`
    PropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Nullsafe property access: `$obj?->prop`
    NullsafePropertyAccess(PropertyAccessExpr<'arena, 'src>),

    /// Method call: `$obj->method(args)`
    MethodCall(&'arena MethodCallExpr<'arena, 'src>),

    /// Nullsafe method call: `$obj?->method(args)`
    NullsafeMethodCall(&'arena MethodCallExpr<'arena, 'src>),

    /// Static property access: `Class::$prop`
    StaticPropertyAccess(StaticAccessExpr<'arena, 'src>),

    /// Static method call: `Class::method(args)`
    StaticMethodCall(&'arena StaticMethodCallExpr<'arena, 'src>),

    /// Dynamic static method call: `Class::$method(args)`
    StaticDynMethodCall(&'arena StaticDynMethodCallExpr<'arena, 'src>),

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

    /// Omitted element in destructuring: `[$a, , $c]` or `list($a, , $c)`
    Omit,

    /// Error placeholder
    Error,
}

impl<'arena, 'src> Expr<'arena, 'src> {
    /// Returns the name string for `Variable` and `Identifier` nodes, `None` for everything else.
    pub fn name_str(&self) -> Option<&str> {
        match &self.kind {
            ExprKind::Variable(s) | ExprKind::Identifier(s) => Some(s.as_str()),
            _ => None,
        }
    }
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum CastKind {
    /// `(int)` or `(integer)` cast.
    Int,
    /// `(float)`, `(double)`, or `(real)` cast.
    Float,
    /// `(string)` cast.
    String,
    /// `(bool)` or `(boolean)` cast.
    Bool,
    /// `(array)` cast.
    Array,
    /// `(object)` cast.
    Object,
    /// `(unset)` cast — deprecated; casts to `null`.
    Unset,
    /// `(void)` cast — non-standard; treated as discarding the value.
    Void,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum IncludeKind {
    /// `include 'file.php'` — emits a warning if the file is not found.
    Include,
    /// `include_once 'file.php'` — like `include`, but skipped if the file has already been included.
    IncludeOnce,
    /// `require 'file.php'` — fatal error if the file is not found.
    Require,
    /// `require_once 'file.php'` — like `require`, but skipped if the file has already been included.
    RequireOnce,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum MagicConstKind {
    /// `__CLASS__` — name of the current class, or empty string outside a class.
    Class,
    /// `__DIR__` — directory of the current file.
    Dir,
    /// `__FILE__` — absolute path of the current file.
    File,
    /// `__FUNCTION__` — name of the current function or closure.
    Function,
    /// `__LINE__` — current line number in the source file.
    Line,
    /// `__METHOD__` — name of the current method including its class: `ClassName::methodName`.
    Method,
    /// `__NAMESPACE__` — name of the current namespace, or empty string in the global namespace.
    Namespace,
    /// `__TRAIT__` — name of the current trait, or empty string outside a trait.
    Trait,
    /// `__PROPERTY__` — name of the current property inside a property hook (PHP 8.4+).
    Property,
}

// --- Expression sub-types ---

#[derive(Debug, Serialize)]
pub struct AssignExpr<'arena, 'src> {
    pub target: &'arena Expr<'arena, 'src>,
    pub op: AssignOp,
    pub value: &'arena Expr<'arena, 'src>,
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum AssignOp {
    /// `=`
    Assign,
    /// `+=`
    Plus,
    /// `-=`
    Minus,
    /// `*=`
    Mul,
    /// `/=`
    Div,
    /// `%=`
    Mod,
    /// `**=`
    Pow,
    /// `.=`
    Concat,
    /// `&=`
    BitwiseAnd,
    /// `|=`
    BitwiseOr,
    /// `^=`
    BitwiseXor,
    /// `<<=`
    ShiftLeft,
    /// `>>=`
    ShiftRight,
    /// `??=`
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
    /// `+`
    Add,
    /// `-`
    Sub,
    /// `*`
    Mul,
    /// `/`
    Div,
    /// `%`
    Mod,
    /// `**`
    Pow,
    /// `.` — string concatenation.
    Concat,
    /// `==` — loose equality (type-coercing).
    Equal,
    /// `!=` or `<>` — loose inequality.
    NotEqual,
    /// `===` — strict equality (type and value).
    Identical,
    /// `!==` — strict inequality.
    NotIdentical,
    /// `<`
    Less,
    /// `>`
    Greater,
    /// `<=`
    LessOrEqual,
    /// `>=`
    GreaterOrEqual,
    /// `<=>` — spaceship / three-way comparison; returns -1, 0, or 1.
    Spaceship,
    /// `&&` — short-circuit boolean AND (higher precedence than `and`).
    BooleanAnd,
    /// `||` — short-circuit boolean OR (higher precedence than `or`).
    BooleanOr,
    /// `&` — bitwise AND.
    BitwiseAnd,
    /// `|` — bitwise OR.
    BitwiseOr,
    /// `^` — bitwise XOR.
    BitwiseXor,
    /// `<<` — left bit-shift.
    ShiftLeft,
    /// `>>` — right bit-shift.
    ShiftRight,
    /// `and` — boolean AND (lower precedence than `&&`).
    LogicalAnd,
    /// `or` — boolean OR (lower precedence than `||`).
    LogicalOr,
    /// `xor` — boolean XOR.
    LogicalXor,
    /// `instanceof` — type-check operator; `$x instanceof Foo`.
    Instanceof,
    /// `|>` — pipe operator (PHP 8.5+); passes the left operand as the first argument of the right callable.
    Pipe,
}

#[derive(Debug, Serialize)]
pub struct UnaryPrefixExpr<'arena, 'src> {
    pub op: UnaryPrefixOp,
    pub operand: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPrefixOp {
    /// `-expr` — arithmetic negation.
    Negate,
    /// `+expr` — unary plus (no-op for numbers, promotes to numeric).
    Plus,
    /// `!expr` — boolean NOT.
    BooleanNot,
    /// `~expr` — bitwise NOT.
    BitwiseNot,
    /// `++$x` — pre-increment; increments then returns the new value.
    PreIncrement,
    /// `--$x` — pre-decrement; decrements then returns the new value.
    PreDecrement,
}

#[derive(Debug, Serialize)]
pub struct UnaryPostfixExpr<'arena, 'src> {
    pub operand: &'arena Expr<'arena, 'src>,
    pub op: UnaryPostfixOp,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq, Serialize)]
pub enum UnaryPostfixOp {
    /// `$x++` — post-increment; returns the current value then increments.
    PostIncrement,
    /// `$x--` — post-decrement; returns the current value then decrements.
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
    #[serde(skip_serializing_if = "is_false")]
    pub by_ref: bool,
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
    pub member: &'arena Expr<'arena, 'src>,
}

#[derive(Debug, Serialize)]
pub struct StaticMethodCallExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

#[derive(Debug, Serialize)]
pub struct StaticDynMethodCallExpr<'arena, 'src> {
    pub class: &'arena Expr<'arena, 'src>,
    pub method: &'arena Expr<'arena, 'src>,
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
    /// `true` for `yield from expr` (generator delegation), `false` for plain `yield`
    pub is_from: bool,
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
        method: &'arena Expr<'arena, 'src>,
    },
}

// --- String interpolation ---

#[derive(Debug, Serialize)]
pub enum StringPart<'arena, 'src> {
    /// A plain text segment of an interpolated string or heredoc.
    Literal(&'arena str),
    /// An embedded expression: `$var`, `{$expr}`, or `${var}`.
    Expr(Expr<'arena, 'src>),
}
