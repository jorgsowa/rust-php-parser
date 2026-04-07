use std::fmt;

/// The PHP language version the parser should target.
///
/// When a [`PhpVersion`] is supplied via [`crate::parse_versioned`], the parser
/// emits [`crate::diagnostics::ParseError::VersionTooLow`] for any syntax that
/// requires a higher version.  The AST is still produced (the parser recovers),
/// so callers can always inspect what was parsed.
///
/// Ordering is meaningful: `Php82 > Php81`, etc.
///
/// Defaults to [`PhpVersion::Php84`] (the latest supported version).
#[derive(Debug, Clone, Copy, Default, PartialEq, Eq, PartialOrd, Ord)]
pub enum PhpVersion {
    /// PHP 8.0 — match, named arguments, constructor promotion, union types, nullsafe `?->`, throw expression, `mixed`/`false`/`null` types.
    Php80,
    /// PHP 8.1 — enums, `readonly` properties/parameters, intersection types, first-class callables, `never` type.
    Php81,
    /// PHP 8.2 — `readonly class`, DNF types, `true` type.
    Php82,
    /// PHP 8.3 — typed class/enum constants.
    Php83,
    /// PHP 8.4 — `abstract readonly class`, property hooks, asymmetric visibility.
    Php84,
    /// PHP 8.5 — pipe operator (`|>`), `clone` with property overrides, `final` promoted properties,
    ///           asymmetric visibility on static properties.
    #[default]
    Php85,
}

impl fmt::Display for PhpVersion {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        match self {
            PhpVersion::Php80 => write!(f, "8.0"),
            PhpVersion::Php81 => write!(f, "8.1"),
            PhpVersion::Php82 => write!(f, "8.2"),
            PhpVersion::Php83 => write!(f, "8.3"),
            PhpVersion::Php84 => write!(f, "8.4"),
            PhpVersion::Php85 => write!(f, "8.5"),
        }
    }
}
