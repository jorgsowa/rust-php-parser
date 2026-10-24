#[cfg(feature = "serde")]
use serde::Serialize;

use crate::Span;

#[cfg(feature = "serde")]
use super::is_false;
use super::{ArenaVec, Arg, Attribute, Block, ByteStr, ClassDecl, Ident, Name, Param, TypeHint};

#[derive(Clone, Copy, PartialEq, Eq, Hash)]
enum NameStrInner<'arena, 'src> {
    Src(&'src str),
    Arena(&'arena str),
}

/// A name string from either the source buffer or the bump arena. Use [`as_str`](NameStr::as_str)
/// or `Deref` to get the string value — the allocation origin is an internal parser detail.
///
/// Build one with [`NameStr::new_in`], [`NameStr::from_source`] or [`NameStr::from_arena`],
/// or move one into another arena with [`fold_name_str`](crate::fold::fold_name_str).
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
pub struct NameStr<'arena, 'src>(NameStrInner<'arena, 'src>);

impl<'arena, 'src> NameStr<'arena, 'src> {
    /// Copies `s` into `arena`.
    pub fn new_in(arena: &'arena bumpalo::Bump, s: &str) -> Self {
        Self(NameStrInner::Arena(arena.alloc_str(s)))
    }

    /// Borrows `s` from the source buffer.
    #[inline]
    pub fn from_source(s: &'src str) -> Self {
        Self(NameStrInner::Src(s))
    }

    /// Wraps a string already allocated in the bump arena.
    #[inline]
    pub fn from_arena(s: &'arena str) -> Self {
        Self(NameStrInner::Arena(s))
    }

    #[inline]
    pub(crate) fn into_src_str(self) -> Option<&'src str> {
        match self.0 {
            NameStrInner::Src(s) => Some(s),
            NameStrInner::Arena(_) => None,
        }
    }

    /// The string value, regardless of where it is stored.
    #[inline]
    pub fn as_str(&self) -> &str {
        match self.0 {
            NameStrInner::Src(s) | NameStrInner::Arena(s) => s,
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

#[cfg(feature = "serde")]
impl<'arena, 'src> serde::Serialize for NameStr<'arena, 'src> {
    fn serialize<S: serde::Serializer>(&self, serializer: S) -> Result<S::Ok, S::Error> {
        self.as_str().serialize(serializer)
    }
}

/// An expression node.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct Expr<'arena, 'src> {
    /// Expression kind.
    pub kind: ExprKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// The kinds of expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ExprKind<'arena, 'src> {
    /// Integer literal
    Int(i64),

    /// Float literal
    Float(f64),

    /// String literal, with escape sequences decoded to the bytes PHP stores. Borrowed from the
    /// source when the literal has none.
    String(ByteStr<'arena, 'src>),

    /// Interpolated string: `"Hello $name, you are {$age} years old"`
    InterpolatedString(ArenaVec<'arena, StringPart<'arena, 'src>>),

    /// Heredoc: `<<<EOT ... EOT`
    Heredoc {
        /// Heredoc/nowdoc label.
        label: &'src str,
        /// Literal and interpolated segments.
        parts: ArenaVec<'arena, StringPart<'arena, 'src>>,
    },

    /// Nowdoc: `<<<'EOT' ... EOT`
    Nowdoc {
        /// Heredoc/nowdoc label.
        label: &'src str,
        /// Nowdoc contents.
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

    /// Member name after `->`, `?->` or `::`: the `foo` in `$a->foo` or `A::foo()`
    Identifier(NameStr<'arena, 'src>),

    /// Reference to a function, class or constant: a call or `new` target, the class in
    /// `Foo::bar()` or `$x instanceof Foo`, or a constant such as `PHP_EOL`
    Name(Name<'arena, 'src>),

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
    StaticMethodCallDynamic(&'arena StaticMethodCallDynamicExpr<'arena, 'src>),

    /// Class constant access: `Class::CONST`
    ClassConstAccess(StaticAccessExpr<'arena, 'src>),

    /// Dynamic class constant access: `Foo::{expr}`
    ClassConstAccessDynamic {
        /// Class expression.
        class: &'arena Expr<'arena, 'src>,
        /// Member expression.
        member: &'arena Expr<'arena, 'src>,
    },

    /// Dynamic static property access: `A::$$b`, `A::${'b'}`
    StaticPropertyAccessDynamic {
        /// Class expression.
        class: &'arena Expr<'arena, 'src>,
        /// Member expression.
        member: &'arena Expr<'arena, 'src>,
    },

    /// Closure: `function($x) use($y) { }`
    Closure(&'arena ClosureExpr<'arena, 'src>),

    /// Arrow function: `fn($x) => expr`
    ArrowFunction(&'arena ArrowFunctionExpr<'arena, 'src>),

    /// Match: `match(expr) { ... }`
    Match(MatchExpr<'arena, 'src>),

    /// Throw as expression (PHP 8)
    Throw(&'arena Expr<'arena, 'src>),

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

/// The type of a cast expression.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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
    /// `(void)` cast (PHP 8.5+) — discards the value of an expression statement.
    Void,
}

/// The include/require keyword used.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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

/// The magic constants.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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

/// An assignment expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct AssignExpr<'arena, 'src> {
    /// Assignment target.
    pub target: &'arena Expr<'arena, 'src>,
    /// Assignment operator.
    pub op: AssignOp,
    /// Assigned value.
    pub value: &'arena Expr<'arena, 'src>,
    /// `true` for reference assignment `=&`.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub by_ref: bool,
}

/// Assignment operators.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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

/// A binary operation.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct BinaryExpr<'arena, 'src> {
    /// Left operand.
    pub left: &'arena Expr<'arena, 'src>,
    /// Binary operator.
    pub op: BinaryOp,
    /// Right operand.
    pub right: &'arena Expr<'arena, 'src>,
}

/// Binary operators.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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

/// A prefix unary operation.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UnaryPrefixExpr<'arena, 'src> {
    /// Prefix operator.
    pub op: UnaryPrefixOp,
    /// Operand expression.
    pub operand: &'arena Expr<'arena, 'src>,
}

/// Prefix unary operators.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
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

/// A postfix unary operation.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct UnaryPostfixExpr<'arena, 'src> {
    /// Operand expression.
    pub operand: &'arena Expr<'arena, 'src>,
    /// Postfix operator.
    pub op: UnaryPostfixOp,
}

/// Postfix unary operators.
#[derive(Debug, Clone, Copy, PartialEq, Eq)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum UnaryPostfixOp {
    /// `$x++` — post-increment; returns the current value then increments.
    PostIncrement,
    /// `$x--` — post-decrement; returns the current value then decrements.
    PostDecrement,
}

/// A ternary `?:` expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct TernaryExpr<'arena, 'src> {
    /// Condition tested.
    pub condition: &'arena Expr<'arena, 'src>,
    /// None for short ternary `$x ?: $y`
    pub then_expr: Option<&'arena Expr<'arena, 'src>>,
    /// Value when the condition is falsy.
    pub else_expr: &'arena Expr<'arena, 'src>,
}

/// A `??` expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct NullCoalesceExpr<'arena, 'src> {
    /// Value tested for null.
    pub left: &'arena Expr<'arena, 'src>,
    /// Fallback when the left side is null or unset.
    pub right: &'arena Expr<'arena, 'src>,
}

/// A function call: `name(args)`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct FunctionCallExpr<'arena, 'src> {
    /// Callee expression.
    pub name: &'arena Expr<'arena, 'src>,
    /// Call arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

/// An element of an array literal.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ArrayElement<'arena, 'src> {
    /// Key expression, if any.
    pub key: Option<Expr<'arena, 'src>>,
    /// The element's value and how it is taken.
    pub kind: ArrayElementKind<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// How an array element takes its value.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum ArrayElementKind<'arena, 'src> {
    /// A plain value: `$x`.
    Value(Expr<'arena, 'src>),
    /// A spread: `...$x`.
    Spread(Expr<'arena, 'src>),
    /// A reference: `&$x`.
    ByRef(Expr<'arena, 'src>),
}

impl<'arena, 'src> ArrayElement<'arena, 'src> {
    /// The element's value expression.
    pub fn value(&self) -> &Expr<'arena, 'src> {
        match &self.kind {
            ArrayElementKind::Value(e)
            | ArrayElementKind::Spread(e)
            | ArrayElementKind::ByRef(e) => e,
        }
    }

    /// Mutable access to the element's value expression.
    pub fn value_mut(&mut self) -> &mut Expr<'arena, 'src> {
        match &mut self.kind {
            ArrayElementKind::Value(e)
            | ArrayElementKind::Spread(e)
            | ArrayElementKind::ByRef(e) => e,
        }
    }

    /// Whether the element is a `...` spread.
    pub fn is_spread(&self) -> bool {
        matches!(self.kind, ArrayElementKind::Spread(_))
    }

    /// Whether the element is taken by reference (`&$x`).
    pub fn is_by_ref(&self) -> bool {
        matches!(self.kind, ArrayElementKind::ByRef(_))
    }
}

/// An array index access: `$a[i]`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ArrayAccessExpr<'arena, 'src> {
    /// Array being indexed.
    pub array: &'arena Expr<'arena, 'src>,
    /// Index; `None` for `$a[]`.
    pub index: Option<&'arena Expr<'arena, 'src>>,
}

// --- OOP Expression sub-types ---

/// An instantiation: `new Foo(args)`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct NewExpr<'arena, 'src> {
    /// Class expression being instantiated.
    pub class: &'arena Expr<'arena, 'src>,
    /// Call arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

/// A property access: `$obj->prop`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct PropertyAccessExpr<'arena, 'src> {
    /// Object expression.
    pub object: &'arena Expr<'arena, 'src>,
    /// Property name expression.
    pub property: &'arena Expr<'arena, 'src>,
}

/// A method call: `$obj->method(args)`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct MethodCallExpr<'arena, 'src> {
    /// Object expression.
    pub object: &'arena Expr<'arena, 'src>,
    /// Method name expression.
    pub method: &'arena Expr<'arena, 'src>,
    /// Call arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

/// A static member access: `Class::$prop` or `Class::CONST`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticAccessExpr<'arena, 'src> {
    /// Class expression or name.
    pub class: &'arena Expr<'arena, 'src>,
    /// Constant or property name expression.
    pub member: &'arena Expr<'arena, 'src>,
}

/// A static method call: `Class::method(args)`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticMethodCallExpr<'arena, 'src> {
    /// Class expression or name.
    pub class: &'arena Expr<'arena, 'src>,
    /// Method name expression.
    pub method: &'arena Expr<'arena, 'src>,
    /// Call arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

/// A static call with a dynamic method name: `Class::$method(args)`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct StaticMethodCallDynamicExpr<'arena, 'src> {
    /// Class expression or name.
    pub class: &'arena Expr<'arena, 'src>,
    /// Expression yielding the method name.
    pub method: &'arena Expr<'arena, 'src>,
    /// Call arguments.
    pub args: ArenaVec<'arena, Arg<'arena, 'src>>,
}

/// A closure: `function() use ($x) { ... }`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct ClosureExpr<'arena, 'src> {
    /// `true` for `static`.
    pub is_static: bool,
    /// `true` when by reference (`&`).
    pub by_ref: bool,
    /// Declared parameters.
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    /// `true` when the parameter list is missing its `(`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub missing_param_list: bool,
    /// Variables captured by `use (...)`.
    pub use_vars: ArenaVec<'arena, ClosureUseVar<'src>>,
    /// Declared return type, if any.
    pub return_type: Option<TypeHint<'arena, 'src>>,
    /// Closure body.
    pub body: &'arena Block<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

impl<'arena, 'src> ClosureExpr<'arena, 'src> {
    /// Builds a `ClosureExpr` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, body: &'arena Block<'arena, 'src>) -> Self {
        Self {
            is_static: false,
            by_ref: false,
            params: ArenaVec::new_in(arena),
            missing_param_list: false,
            use_vars: ArenaVec::new_in(arena),
            return_type: None,
            body,
            attributes: ArenaVec::new_in(arena),
        }
    }
}

/// A variable captured in a closure `use` list.
#[derive(Debug, Clone)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct ClosureUseVar<'src> {
    /// Captured variable name without `$`.
    pub name: Ident<'src>,
    /// `true` for `use (&$x)`.
    pub by_ref: bool,
    /// Source range of this node.
    pub span: Span,
}

/// An arrow function: `fn($x) => expr`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct ArrowFunctionExpr<'arena, 'src> {
    /// `true` for `static`.
    pub is_static: bool,
    /// `true` when by reference (`&`).
    pub by_ref: bool,
    /// Declared parameters.
    pub params: ArenaVec<'arena, Param<'arena, 'src>>,
    /// `true` when the parameter list is missing its `(`, which PHP rejects.
    #[cfg_attr(feature = "serde", serde(skip_serializing_if = "is_false"))]
    pub missing_param_list: bool,
    /// Declared return type, if any.
    pub return_type: Option<TypeHint<'arena, 'src>>,
    /// Single result expression.
    pub body: &'arena Expr<'arena, 'src>,
    /// `#[...]` attributes applied to this node.
    pub attributes: ArenaVec<'arena, Attribute<'arena, 'src>>,
}

impl<'arena, 'src> ArrowFunctionExpr<'arena, 'src> {
    /// Builds a `ArrowFunctionExpr` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(arena: &'arena bumpalo::Bump, body: &'arena Expr<'arena, 'src>) -> Self {
        Self {
            is_static: false,
            by_ref: false,
            params: ArenaVec::new_in(arena),
            missing_param_list: false,
            return_type: None,
            body,
            attributes: ArenaVec::new_in(arena),
        }
    }
}

/// A `match` expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub struct MatchExpr<'arena, 'src> {
    /// Expression being matched.
    pub subject: &'arena Expr<'arena, 'src>,
    /// Match arms in order.
    pub arms: ArenaVec<'arena, MatchArm<'arena, 'src>>,
    /// The `{` in `match (...) {`. Printer layout detail, outside semver; not serialized.
    #[cfg_attr(feature = "serde", serde(skip))]
    #[doc(hidden)]
    pub brace_span: Span,
}

impl<'arena, 'src> MatchExpr<'arena, 'src> {
    /// Builds a `MatchExpr` from its identifying fields with every other field empty. Set
    /// the rest by assignment, as with `Param::new`.
    pub fn new(
        subject: &'arena Expr<'arena, 'src>,
        arms: ArenaVec<'arena, MatchArm<'arena, 'src>>,
        brace_span: Span,
    ) -> Self {
        Self {
            subject,
            arms,
            brace_span,
        }
    }
}

/// One arm of a `match`.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct MatchArm<'arena, 'src> {
    /// None for `default`
    pub conditions: Option<ArenaVec<'arena, Expr<'arena, 'src>>>,
    /// Result expression.
    pub body: Expr<'arena, 'src>,
    /// Source range of this node.
    pub span: Span,
}

/// A `yield` or `yield from` expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct YieldExpr<'arena, 'src> {
    /// Yielded key.
    pub key: Option<&'arena Expr<'arena, 'src>>,
    /// Yielded value.
    pub value: Option<&'arena Expr<'arena, 'src>>,
    /// `true` for `yield from expr` (generator delegation), `false` for plain `yield`
    pub is_from: bool,
}

// --- First-class callable ---

/// A first-class callable expression.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
pub struct CallableCreateExpr<'arena, 'src> {
    /// Kind of callable being created.
    pub kind: CallableCreateKind<'arena, 'src>,
}

/// The callee forms of a first-class callable.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum CallableCreateKind<'arena, 'src> {
    /// `foo(...)`, `$var(...)`, `\Ns\func(...)`
    Function(&'arena Expr<'arena, 'src>),
    /// `$obj->method(...)`
    Method {
        /// Object expression.
        object: &'arena Expr<'arena, 'src>,
        /// Method name expression.
        method: &'arena Expr<'arena, 'src>,
    },
    /// `$obj?->method(...)`
    NullsafeMethod {
        /// Object expression.
        object: &'arena Expr<'arena, 'src>,
        /// Method name expression.
        method: &'arena Expr<'arena, 'src>,
    },
    /// `Foo::bar(...)`
    StaticMethod {
        /// Class expression.
        class: &'arena Expr<'arena, 'src>,
        /// Method name expression.
        method: &'arena Expr<'arena, 'src>,
    },
}

// --- String interpolation ---

/// A segment of an interpolated string.
#[derive(Debug)]
#[cfg_attr(feature = "serde", derive(Serialize))]
#[non_exhaustive]
pub enum StringPart<'arena, 'src> {
    /// A plain text segment of an interpolated string or heredoc, with escapes decoded.
    Literal(ByteStr<'arena, 'src>),
    /// An embedded expression: `$var`, `{$expr}`, or `${var}`.
    Expr(Expr<'arena, 'src>),
}
