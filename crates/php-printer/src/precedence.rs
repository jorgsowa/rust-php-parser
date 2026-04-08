use php_ast::ast::{AssignOp, BinaryOp, ExprKind};

/// Precedence levels matching PHP's operator precedence table.
/// Higher number = tighter binding.
pub const PREC_LOWEST: i8 = 0;
pub const PREC_INCLUDE: i8 = 1;
pub const PREC_PRINT: i8 = 2;
pub const PREC_YIELD: i8 = 3;
pub const PREC_YIELD_FROM: i8 = 4;
pub const PREC_ASSIGN: i8 = 5;
pub const PREC_TERNARY: i8 = 6;
pub const PREC_NULL_COALESCE: i8 = 7;
pub const PREC_PIPE: i8 = 8;
pub const PREC_LOGICAL_OR_WORD: i8 = 9;
pub const PREC_LOGICAL_XOR_WORD: i8 = 10;
pub const PREC_LOGICAL_AND_WORD: i8 = 11;
pub const PREC_BOOLEAN_OR: i8 = 12;
pub const PREC_BOOLEAN_AND: i8 = 13;
pub const PREC_BITWISE_OR: i8 = 14;
pub const PREC_BITWISE_XOR: i8 = 15;
pub const PREC_BITWISE_AND: i8 = 16;
pub const PREC_EQUALITY: i8 = 17;
pub const PREC_COMPARISON: i8 = 18;
pub const PREC_CONCAT: i8 = 19;
pub const PREC_SHIFT: i8 = 20;
pub const PREC_ADD: i8 = 21;
pub const PREC_MUL: i8 = 22;
pub const PREC_INSTANCEOF: i8 = 23;
pub const PREC_UNARY: i8 = 24;
pub const PREC_POW: i8 = 25;
pub const PREC_CAST: i8 = 26;
pub const PREC_CLONE: i8 = 26;
pub const PREC_PRIMARY: i8 = 127;

/// Returns (precedence, lhs_precedence, rhs_precedence) for a binary operator.
/// Left-associative: lhs = prec, rhs = prec + 1
/// Right-associative: lhs = prec + 1, rhs = prec
/// Non-associative: lhs = prec + 1, rhs = prec + 1
pub fn binary_op_precedence(op: BinaryOp) -> (i8, i8, i8) {
    match op {
        BinaryOp::Pow => (PREC_POW, PREC_POW + 1, PREC_POW),
        BinaryOp::Mul | BinaryOp::Div | BinaryOp::Mod => (PREC_MUL, PREC_MUL, PREC_MUL + 1),
        BinaryOp::Add | BinaryOp::Sub => (PREC_ADD, PREC_ADD, PREC_ADD + 1),
        BinaryOp::Concat => (PREC_CONCAT, PREC_CONCAT, PREC_CONCAT + 1),
        BinaryOp::ShiftLeft | BinaryOp::ShiftRight => (PREC_SHIFT, PREC_SHIFT, PREC_SHIFT + 1),
        BinaryOp::Less | BinaryOp::Greater | BinaryOp::LessOrEqual | BinaryOp::GreaterOrEqual => {
            (PREC_COMPARISON, PREC_COMPARISON + 1, PREC_COMPARISON + 1)
        }
        BinaryOp::Equal
        | BinaryOp::NotEqual
        | BinaryOp::Identical
        | BinaryOp::NotIdentical
        | BinaryOp::Spaceship => (PREC_EQUALITY, PREC_EQUALITY + 1, PREC_EQUALITY + 1),
        BinaryOp::BitwiseAnd => (PREC_BITWISE_AND, PREC_BITWISE_AND, PREC_BITWISE_AND + 1),
        BinaryOp::BitwiseXor => (PREC_BITWISE_XOR, PREC_BITWISE_XOR, PREC_BITWISE_XOR + 1),
        BinaryOp::BitwiseOr => (PREC_BITWISE_OR, PREC_BITWISE_OR, PREC_BITWISE_OR + 1),
        BinaryOp::BooleanAnd => (PREC_BOOLEAN_AND, PREC_BOOLEAN_AND, PREC_BOOLEAN_AND + 1),
        BinaryOp::BooleanOr => (PREC_BOOLEAN_OR, PREC_BOOLEAN_OR, PREC_BOOLEAN_OR + 1),
        BinaryOp::LogicalAnd => (
            PREC_LOGICAL_AND_WORD,
            PREC_LOGICAL_AND_WORD,
            PREC_LOGICAL_AND_WORD + 1,
        ),
        BinaryOp::LogicalOr => (
            PREC_LOGICAL_OR_WORD,
            PREC_LOGICAL_OR_WORD,
            PREC_LOGICAL_OR_WORD + 1,
        ),
        BinaryOp::LogicalXor => (
            PREC_LOGICAL_XOR_WORD,
            PREC_LOGICAL_XOR_WORD,
            PREC_LOGICAL_XOR_WORD + 1,
        ),
        BinaryOp::Instanceof => (PREC_INSTANCEOF, PREC_INSTANCEOF + 1, PREC_INSTANCEOF + 1),
        BinaryOp::Pipe => (PREC_PIPE, PREC_PIPE, PREC_PIPE + 1),
    }
}

/// Returns (precedence, lhs_precedence, rhs_precedence) for an assignment operator.
/// All assignment operators are right-associative.
pub fn assign_op_precedence(_op: AssignOp) -> (i8, i8, i8) {
    (PREC_ASSIGN, PREC_ASSIGN + 1, PREC_ASSIGN)
}

/// Returns the precedence level of an expression for parenthesization decisions.
pub fn expr_precedence(kind: &ExprKind) -> i8 {
    match kind {
        ExprKind::Binary(b) => binary_op_precedence(b.op).0,
        ExprKind::Assign(a) => assign_op_precedence(a.op).0,
        ExprKind::Ternary(_) => PREC_TERNARY,
        ExprKind::NullCoalesce(_) => PREC_NULL_COALESCE,
        ExprKind::Yield(_) => PREC_YIELD,
        ExprKind::ThrowExpr(_) => PREC_ASSIGN,
        ExprKind::Print(_) => PREC_PRINT,
        ExprKind::Include(_, _) => PREC_INCLUDE,
        ExprKind::Cast(_, _) => PREC_CAST,
        ExprKind::Clone(_) | ExprKind::CloneWith(_, _) => PREC_CLONE,
        ExprKind::UnaryPrefix(_) | ExprKind::ErrorSuppress(_) => PREC_UNARY,
        ExprKind::ArrowFunction(_) | ExprKind::Closure(_) => PREC_PRIMARY,
        _ => PREC_PRIMARY,
    }
}
