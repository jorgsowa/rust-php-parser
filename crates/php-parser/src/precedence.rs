//! Operator binding powers for the Pratt parser.
//!
//! Each infix operator is assigned a `(left_bp, right_bp)` pair:
//! - **Left-associative**: `right_bp = left_bp + 1` — the parser reduces the current op
//!   before consuming the next one at the same level (e.g. `+` is `(35, 36)`).
//! - **Right-associative**: `right_bp = left_bp - 1` — the parser keeps consuming rightward
//!   before reducing (e.g. `**` is `(60, 59)`).
//! - **Non-associative**: assigned left-associative binding powers in the table but enforced
//!   externally via the "chain group" logic in `expr.rs` (see [`nonassoc_chain_level_for_token`]).
//!
//! Assignment (`=`, `+=`, …), ternary (`?:`), and null-coalesce (`??`) are **not** in the
//! infix table — they are handled by dedicated special cases in the parser using
//! [`ASSIGNMENT_BP`], [`TERNARY_BP`], and [`NULL_COALESCE_LEFT_BP`].
//!
//! Values mirror PHP's operator-precedence table:
//! <https://www.php.net/manual/en/language.operators.precedence.php>

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
///  6. `??`                            (right) — handled separately (left_bp=14, NOT in table)
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
/// 17. `! ~ ++ -- (cast)`              (prefix, right_bp 41) — handled in prefix_binding_power
/// 18. `instanceof`                    (nonassoc) ← above prefix, below **
/// 19. `**`                            (right)
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

    // Comparison (nonassoc)
    table[TokenKind::LessThan as u8 as usize] = Some((27, 28));
    table[TokenKind::GreaterThan as u8 as usize] = Some((27, 28));
    table[TokenKind::LessThanEquals as u8 as usize] = Some((27, 28));
    table[TokenKind::GreaterThanEquals as u8 as usize] = Some((27, 28));

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

    // instanceof (nonassoc) — above prefix unary (right_bp 41), below ** (left_bp 60)
    table[TokenKind::Instanceof as u8 as usize] = Some((45, 46));

    // Exponentiation (right-associative) — highest binary precedence
    table[TokenKind::StarStar as u8 as usize] = Some((60, 59));

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

/// Null coalesce left binding power — handled specially in the parser (not in the infix table).
/// Right-associative: the effective right_bp used during parsing is `TERNARY_BP + 1` (= 11),
/// which blocks unparenthesized ternary in the RHS while still allowing assignment via
/// `parse_assign_continuation`.
pub const NULL_COALESCE_LEFT_BP: u8 = 14;

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
    fn test_null_coalesce_not_in_table() {
        // `??` is handled by a dedicated special case in parse_expr_bp (not the generic
        // infix table). Its left_bp is hardcoded as 14 and its effective right_bp is
        // TERNARY_BP + 1 (= 11) to block unparenthesized ternary in the RHS while still
        // allowing assignment via parse_assign_continuation.
        assert!(
            infix_binding_power(TokenKind::QuestionQuestion).is_none(),
            "`??` must not appear in the infix table — it has a dedicated special-case handler"
        );
        // NULL_COALESCE_LEFT_BP must exceed the effective right_bp (TERNARY_BP + 1 = 11),
        // confirming right-associativity for chained `??`.
        const { assert!(NULL_COALESCE_LEFT_BP > TERNARY_BP + 1) }
        // NULL_COALESCE_LEFT_BP must also exceed TERNARY_BP so that `$a ?? $b ? $c : $d`
        // groups as `($a ?? $b) ? $c : $d` (ternary can consume the ?? result).
        const { assert!(NULL_COALESCE_LEFT_BP > TERNARY_BP) }
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

    #[test]
    fn test_instanceof_higher_than_additive() {
        // PHP: `$a + $b instanceof Foo` → `$a + ($b instanceof Foo)`
        let (_, add_right) = infix_binding_power(TokenKind::Plus).unwrap();
        let (inst_left, _) = infix_binding_power(TokenKind::Instanceof).unwrap();
        assert!(inst_left > add_right);
    }

    #[test]
    fn test_instanceof_higher_than_prefix_unary() {
        // PHP: `-$b instanceof Foo` → `-($b instanceof Foo)`
        // prefix_binding_power returns the right_bp; instanceof left_bp must exceed it
        let prefix_right_bp = prefix_binding_power(TokenKind::Minus).unwrap();
        let (inst_left, _) = infix_binding_power(TokenKind::Instanceof).unwrap();
        assert!(inst_left > prefix_right_bp);
    }

    #[test]
    fn test_pow_higher_than_instanceof() {
        // PHP: `$a ** $b instanceof Foo` → `($a ** $b) instanceof Foo`
        // ** right_bp must exceed instanceof left_bp so ** keeps its right operand
        let (_, pow_right) = infix_binding_power(TokenKind::StarStar).unwrap();
        let (inst_left, _) = infix_binding_power(TokenKind::Instanceof).unwrap();
        assert!(pow_right > inst_left);
    }

    #[test]
    fn test_instanceof_higher_than_comparison() {
        // instanceof should be higher than comparison operators
        let (_, cmp_right) = infix_binding_power(TokenKind::LessThan).unwrap();
        let (inst_left, _) = infix_binding_power(TokenKind::Instanceof).unwrap();
        assert!(inst_left > cmp_right);
    }
}
