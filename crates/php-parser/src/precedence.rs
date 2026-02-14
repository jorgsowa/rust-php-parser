use php_lexer::TokenKind;

/// Binding power for Pratt parsing. Returns (left_bp, right_bp).
/// A higher binding power means tighter binding.
///
/// PHP operator precedence (from lowest to highest):
///  1. `or`                            (left)
///  2. `xor`                           (left)
///  3. `and`                           (left)
///  4. `= += -= ...` (assignment)      (right) — handled separately
///  5. `?:` (ternary)                  (right) — handled separately
///  6. `??`                            (right)
///  7. `||`                            (left)
///  8. `&&`                            (left)
///  9. `|`                             (left)
/// 10. `^`                             (left)
/// 11. `&`                             (left)
/// 12. `== != === !== <=>`             (nonassoc)
/// 13. `< <= > >=`                     (nonassoc)
/// 14. `.`                             (left)
/// 15. `<< >>`                         (left)
/// 16. `+ -`                           (left)
/// 17. `* / %`                         (left)
/// 18. `**`                            (right)
///
///     Returns the infix binding power for a token, or None if it's not an infix operator.
///     Returns (left_bp, right_bp). For left-associative ops, right_bp = left_bp + 1.
///     For right-associative ops, left_bp = right_bp - 1 (i.e., right_bp = left_bp).
pub fn infix_binding_power(kind: &TokenKind) -> Option<(u8, u8)> {
    match kind {
        // Logical keyword operators (lowest precedence)
        TokenKind::Or => Some((1, 2)),
        TokenKind::Xor => Some((3, 4)),
        TokenKind::And => Some((5, 6)),

        // Null coalescing (right-associative)
        TokenKind::QuestionQuestion => Some((14, 13)),

        // Boolean or
        TokenKind::PipePipe => Some((15, 16)),

        // Boolean and
        TokenKind::AmpersandAmpersand => Some((17, 18)),

        // Bitwise or
        TokenKind::Pipe => Some((19, 20)),

        // Bitwise xor
        TokenKind::Caret => Some((21, 22)),

        // Bitwise and
        TokenKind::Ampersand => Some((23, 24)),

        // Equality (nonassoc — we treat as left with same bp)
        TokenKind::EqualsEquals
        | TokenKind::BangEquals
        | TokenKind::EqualsEqualsEquals
        | TokenKind::BangEqualsEquals
        | TokenKind::Spaceship => Some((25, 26)),

        // Comparison (nonassoc) + instanceof
        TokenKind::LessThan
        | TokenKind::GreaterThan
        | TokenKind::LessThanEquals
        | TokenKind::GreaterThanEquals
        | TokenKind::Instanceof => Some((27, 28)),

        // Pipe operator (left-associative)
        TokenKind::PipeArrow => Some((29, 30)),

        // String concatenation
        TokenKind::Dot => Some((31, 32)),

        // Shift
        TokenKind::ShiftLeft | TokenKind::ShiftRight => Some((33, 34)),

        // Additive
        TokenKind::Plus | TokenKind::Minus => Some((35, 36)),

        // Multiplicative
        TokenKind::Star | TokenKind::Slash | TokenKind::Percent => Some((37, 38)),

        // Exponentiation (right-associative)
        TokenKind::StarStar => Some((40, 39)),

        _ => None,
    }
}

/// Returns the prefix binding power for a token, or None if it's not a prefix operator.
/// Returns ((), right_bp).
pub fn prefix_binding_power(kind: &TokenKind) -> Option<u8> {
    match kind {
        TokenKind::Minus | TokenKind::Plus => Some(41),
        TokenKind::Bang => Some(41),
        TokenKind::Tilde => Some(41),
        TokenKind::PlusPlus | TokenKind::MinusMinus => Some(41),
        _ => None,
    }
}

/// Returns the postfix binding power for a token, or None if it's not a postfix operator.
/// Returns (left_bp, ()).
pub fn postfix_binding_power(kind: &TokenKind) -> Option<u8> {
    match kind {
        TokenKind::PlusPlus | TokenKind::MinusMinus => Some(43),
        _ => None,
    }
}

/// Assignment binding power — handled specially because it's right-associative
/// and the LHS must be a valid assignment target.
pub const ASSIGNMENT_BP: u8 = 8;

/// Ternary binding power — handled specially in the parser.
pub const TERNARY_BP: u8 = 10;

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_additive_lower_than_multiplicative() {
        let (_, add_right) = infix_binding_power(&TokenKind::Plus).unwrap();
        let (mul_left, _) = infix_binding_power(&TokenKind::Star).unwrap();
        assert!(mul_left > add_right);
    }

    #[test]
    fn test_mul_lower_than_pow() {
        let (_, mul_right) = infix_binding_power(&TokenKind::Star).unwrap();
        let (pow_left, _) = infix_binding_power(&TokenKind::StarStar).unwrap();
        assert!(pow_left > mul_right);
    }

    #[test]
    fn test_pow_is_right_associative() {
        let (left, right) = infix_binding_power(&TokenKind::StarStar).unwrap();
        assert!(left > right);
    }

    #[test]
    fn test_add_is_left_associative() {
        let (left, right) = infix_binding_power(&TokenKind::Plus).unwrap();
        assert!(left < right);
    }

    #[test]
    fn test_boolean_and_lower_than_bitwise_or() {
        let (_, and_right) = infix_binding_power(&TokenKind::AmpersandAmpersand).unwrap();
        let (bitor_left, _) = infix_binding_power(&TokenKind::Pipe).unwrap();
        assert!(bitor_left > and_right);
    }

    #[test]
    fn test_null_coalesce_right_associative() {
        let (left, right) = infix_binding_power(&TokenKind::QuestionQuestion).unwrap();
        assert!(left > right);
    }

    #[test]
    fn test_comparison_lower_than_concat() {
        let (_, cmp_right) = infix_binding_power(&TokenKind::LessThan).unwrap();
        let (concat_left, _) = infix_binding_power(&TokenKind::Dot).unwrap();
        assert!(concat_left > cmp_right);
    }
}
