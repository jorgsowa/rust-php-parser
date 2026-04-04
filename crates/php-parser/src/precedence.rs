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
/// 14. `<< >>`                         (left)   ← below + - . per PHP 8
/// 15. `. + -`                         (left)   ← same level per PHP 8
/// 16. `* / %`                         (left)
/// 17. `**`                            (right)
///
///     Returns the infix binding power for a token, or None if it's not an infix operator.
///     Returns (left_bp, right_bp). For left-associative ops, right_bp = left_bp + 1.
///     For right-associative ops, left_bp = right_bp - 1 (i.e., right_bp = left_bp).
///
///     Optimized with a static lookup table indexed by TokenKind discriminant (u8)
///     for O(1) access in hot path, avoiding branch misprediction.
#[inline(always)]
pub fn infix_binding_power(kind: TokenKind) -> Option<(u8, u8)> {
    // Static lookup table indexed by TokenKind as u8.
    // All unused entries are None. This is a 256-byte table that fits in L1 cache.
    // Built once at compile-time; zero runtime cost except for a single indexed load.
    const BP_TABLE: [Option<(u8, u8)>; 256] = build_bp_table();
    BP_TABLE[kind as u8 as usize]
}

/// Builds the infix binding power lookup table at compile time.
/// This replaces the match statement with a direct table lookup.
const fn build_bp_table() -> [Option<(u8, u8)>; 256] {
    let mut table = [None; 256];

    // Manually initialize each token kind's binding power.
    // Using the numeric discriminant from repr(u8) enum definition.

    // Logical keyword operators (lowest precedence)
    table[TokenKind::Or as u8 as usize] = Some((1, 2));
    table[TokenKind::Xor as u8 as usize] = Some((3, 4));
    table[TokenKind::And as u8 as usize] = Some((5, 6));

    // Null coalescing (right-associative)
    table[TokenKind::QuestionQuestion as u8 as usize] = Some((14, 13));

    // Boolean or
    table[TokenKind::PipePipe as u8 as usize] = Some((15, 16));

    // Boolean and
    table[TokenKind::AmpersandAmpersand as u8 as usize] = Some((17, 18));

    // Bitwise or
    table[TokenKind::Pipe as u8 as usize] = Some((19, 20));

    // Bitwise xor
    table[TokenKind::Caret as u8 as usize] = Some((21, 22));

    // Bitwise and
    table[TokenKind::Ampersand as u8 as usize] = Some((23, 24));

    // Equality (nonassoc — we treat as left with same bp)
    table[TokenKind::EqualsEquals as u8 as usize] = Some((25, 26));
    table[TokenKind::BangEquals as u8 as usize] = Some((25, 26));
    table[TokenKind::EqualsEqualsEquals as u8 as usize] = Some((25, 26));
    table[TokenKind::BangEqualsEquals as u8 as usize] = Some((25, 26));
    table[TokenKind::Spaceship as u8 as usize] = Some((25, 26));

    // Comparison (nonassoc) + instanceof
    table[TokenKind::LessThan as u8 as usize] = Some((27, 28));
    table[TokenKind::GreaterThan as u8 as usize] = Some((27, 28));
    table[TokenKind::LessThanEquals as u8 as usize] = Some((27, 28));
    table[TokenKind::GreaterThanEquals as u8 as usize] = Some((27, 28));
    table[TokenKind::Instanceof as u8 as usize] = Some((27, 28));

    // Pipe operator (left-associative)
    table[TokenKind::PipeArrow as u8 as usize] = Some((29, 30));

    // Shift (below concat/additive per PHP 8 precedence table)
    table[TokenKind::ShiftLeft as u8 as usize] = Some((31, 32));
    table[TokenKind::ShiftRight as u8 as usize] = Some((31, 32));

    // String concatenation and additive (same level per PHP 8)
    table[TokenKind::Dot as u8 as usize] = Some((35, 36));
    table[TokenKind::Plus as u8 as usize] = Some((35, 36));
    table[TokenKind::Minus as u8 as usize] = Some((35, 36));

    // Multiplicative
    table[TokenKind::Star as u8 as usize] = Some((37, 38));
    table[TokenKind::Slash as u8 as usize] = Some((37, 38));
    table[TokenKind::Percent as u8 as usize] = Some((37, 38));

    // Exponentiation (right-associative)
    table[TokenKind::StarStar as u8 as usize] = Some((40, 39));

    table
}

/// Returns the prefix binding power for a token, or None if it's not a prefix operator.
/// Returns ((), right_bp).
#[inline(always)]
pub fn prefix_binding_power(kind: TokenKind) -> Option<u8> {
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
#[inline(always)]
pub fn postfix_binding_power(kind: TokenKind) -> Option<u8> {
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
        let (_, add_right) = infix_binding_power(TokenKind::Plus).unwrap();
        let (mul_left, _) = infix_binding_power(TokenKind::Star).unwrap();
        assert!(mul_left > add_right);
    }

    #[test]
    fn test_mul_lower_than_pow() {
        let (_, mul_right) = infix_binding_power(TokenKind::Star).unwrap();
        let (pow_left, _) = infix_binding_power(TokenKind::StarStar).unwrap();
        assert!(pow_left > mul_right);
    }

    #[test]
    fn test_pow_is_right_associative() {
        let (left, right) = infix_binding_power(TokenKind::StarStar).unwrap();
        assert!(left > right);
    }

    #[test]
    fn test_add_is_left_associative() {
        let (left, right) = infix_binding_power(TokenKind::Plus).unwrap();
        assert!(left < right);
    }

    #[test]
    fn test_boolean_and_lower_than_bitwise_or() {
        let (_, and_right) = infix_binding_power(TokenKind::AmpersandAmpersand).unwrap();
        let (bitor_left, _) = infix_binding_power(TokenKind::Pipe).unwrap();
        assert!(bitor_left > and_right);
    }

    #[test]
    fn test_null_coalesce_right_associative() {
        let (left, right) = infix_binding_power(TokenKind::QuestionQuestion).unwrap();
        assert!(left > right);
    }

    #[test]
    fn test_comparison_lower_than_concat() {
        let (_, cmp_right) = infix_binding_power(TokenKind::LessThan).unwrap();
        let (concat_left, _) = infix_binding_power(TokenKind::Dot).unwrap();
        assert!(concat_left > cmp_right);
    }

    #[test]
    fn test_concat_same_level_as_additive() {
        // PHP 8: `.` and `+`/`-` share the same precedence level
        let (dot_left, dot_right) = infix_binding_power(TokenKind::Dot).unwrap();
        let (plus_left, plus_right) = infix_binding_power(TokenKind::Plus).unwrap();
        let (minus_left, minus_right) = infix_binding_power(TokenKind::Minus).unwrap();
        assert_eq!((dot_left, dot_right), (plus_left, plus_right));
        assert_eq!((dot_left, dot_right), (minus_left, minus_right));
    }

    #[test]
    fn test_shift_lower_than_concat_and_additive() {
        // PHP 8: `<<`/`>>` bind less tightly than `.`, `+`, `-`
        let (_, shift_right) = infix_binding_power(TokenKind::ShiftLeft).unwrap();
        let (concat_left, _) = infix_binding_power(TokenKind::Dot).unwrap();
        let (plus_left, _) = infix_binding_power(TokenKind::Plus).unwrap();
        assert!(concat_left > shift_right);
        assert!(plus_left > shift_right);
    }
}
