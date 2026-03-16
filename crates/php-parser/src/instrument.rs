//! Lightweight instrumentation for profiling array parsing and expression parsing.
//!
//! This module provides zero-cost abstractions for profiling when the `instrument` feature
//! is enabled. When disabled, all instrumentation macros and calls compile to nothing.

use std::sync::Mutex;

/// Global instrumentation statistics
pub struct InstrumentStats {
    /// Total calls to parse_expr
    pub parse_expr_calls: u64,
    /// Total calls to parse_expr_bp (with min_bp != 0)
    pub parse_expr_bp_recursive_calls: u64,
    /// Total calls to parse_array_element
    pub parse_array_element_calls: u64,
    /// Total calls to parse_array_element that had =>
    pub parse_array_element_with_arrow: u64,
    /// Total parse_expr calls in array elements (first expression)
    pub parse_expr_array_first: u64,
    /// Total parse_expr calls in array elements (second expression after =>)
    pub parse_expr_array_second: u64,
    /// Total arrays parsed
    pub parse_array_count: u64,
    /// Total array elements parsed
    pub parse_array_element_count: u64,
    /// Number of times parse_atom was called
    pub parse_atom_calls: u64,
    /// Number of simple/atomic values in arrays (not followed by operators)
    pub parse_array_simple_values: u64,
}

lazy_static::lazy_static! {
    static ref STATS: Mutex<InstrumentStats> = Mutex::new(InstrumentStats {
        parse_expr_calls: 0,
        parse_expr_bp_recursive_calls: 0,
        parse_array_element_calls: 0,
        parse_array_element_with_arrow: 0,
        parse_expr_array_first: 0,
        parse_expr_array_second: 0,
        parse_array_count: 0,
        parse_array_element_count: 0,
        parse_atom_calls: 0,
        parse_array_simple_values: 0,
    });
}

/// Record a parse_expr call
#[inline]
pub fn record_parse_expr() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_expr_calls += 1;
        }
    }
}

/// Record a recursive parse_expr_bp call (min_bp != 0)
#[inline]
pub fn record_parse_expr_bp_recursive() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_expr_bp_recursive_calls += 1;
        }
    }
}

/// Record array parsing started
#[inline]
pub fn record_parse_array() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_array_count += 1;
        }
    }
}

/// Record array element parsing started
#[inline]
pub fn record_parse_array_element() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_array_element_calls += 1;
        }
    }
}

/// Record first parse_expr call in array element (key or value)
#[inline]
pub fn record_parse_expr_array_first() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_expr_array_first += 1;
        }
    }
}

/// Record second parse_expr call in array element (after =>)
#[inline]
pub fn record_parse_expr_array_second() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_expr_array_second += 1;
        }
    }
}

/// Record array element with => operator
#[inline]
pub fn record_parse_array_element_with_arrow() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_array_element_with_arrow += 1;
        }
    }
}

/// Record total array elements parsed
#[inline]
pub fn record_parse_array_element_count(count: usize) {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_array_element_count += count as u64;
        }
    }
}

/// Record parse_atom call
#[inline]
pub fn record_parse_atom() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_atom_calls += 1;
        }
    }
}

/// Record a simple/atomic value in an array (not followed by binary operators)
#[inline]
pub fn record_parse_array_simple_value() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_array_simple_values += 1;
        }
    }
}

/// Get current statistics (snapshot)
pub fn get_stats() -> InstrumentStats {
    #[cfg(feature = "instrument")]
    {
        STATS.lock().ok().map(|stats| InstrumentStats {
            parse_expr_calls: stats.parse_expr_calls,
            parse_expr_bp_recursive_calls: stats.parse_expr_bp_recursive_calls,
            parse_array_element_calls: stats.parse_array_element_calls,
            parse_array_element_with_arrow: stats.parse_array_element_with_arrow,
            parse_expr_array_first: stats.parse_expr_array_first,
            parse_expr_array_second: stats.parse_expr_array_second,
            parse_array_count: stats.parse_array_count,
            parse_array_element_count: stats.parse_array_element_count,
            parse_atom_calls: stats.parse_atom_calls,
            parse_array_simple_values: stats.parse_array_simple_values,
        }).unwrap_or(InstrumentStats {
            parse_expr_calls: 0,
            parse_expr_bp_recursive_calls: 0,
            parse_array_element_calls: 0,
            parse_array_element_with_arrow: 0,
            parse_expr_array_first: 0,
            parse_expr_array_second: 0,
            parse_array_count: 0,
            parse_array_element_count: 0,
            parse_atom_calls: 0,
            parse_array_simple_values: 0,
        })
    }
    #[cfg(not(feature = "instrument"))]
    {
        InstrumentStats {
            parse_expr_calls: 0,
            parse_expr_bp_recursive_calls: 0,
            parse_array_element_calls: 0,
            parse_array_element_with_arrow: 0,
            parse_expr_array_first: 0,
            parse_expr_array_second: 0,
            parse_array_count: 0,
            parse_array_element_count: 0,
            parse_atom_calls: 0,
            parse_array_simple_values: 0,
        }
    }
}

/// Print a formatted report of statistics
pub fn report_stats() {
    #[cfg(feature = "instrument")]
    {
        let stats = get_stats();
        println!("\n╔════════════════════════════════════════════════════════════╗");
        println!("║         Array & Expression Parsing Instrumentation         ║");
        println!("╠════════════════════════════════════════════════════════════╣");
        println!("║ Arrays Parsed:                          {:18} ║", stats.parse_array_count);
        println!("║ Array Elements Parsed:                  {:18} ║", stats.parse_array_element_count);
        println!("║ Array Elements with =>:                 {:18} ║", stats.parse_array_element_with_arrow);

        let arrow_rate = if stats.parse_array_element_calls > 0 {
            (stats.parse_array_element_with_arrow as f64 / stats.parse_array_element_calls as f64) * 100.0
        } else {
            0.0
        };
        println!("║ => Rate:                                    {:15.1}% ║", arrow_rate);

        println!("╠════════════════════════════════════════════════════════════╣");
        println!("║ Total parse_expr calls:                 {:18} ║", stats.parse_expr_calls);
        println!("║ parse_expr calls (array, first):        {:18} ║", stats.parse_expr_array_first);
        println!("║ parse_expr calls (array, second =>):    {:18} ║", stats.parse_expr_array_second);

        let second_expr_overhead = stats.parse_expr_array_second;
        let second_expr_pct = if stats.parse_expr_calls > 0 {
            (second_expr_overhead as f64 / stats.parse_expr_calls as f64) * 100.0
        } else {
            0.0
        };
        println!("║ Double-parse overhead (%):                  {:15.1}% ║", second_expr_pct);

        println!("╠════════════════════════════════════════════════════════════╣");
        println!("║ parse_atom calls:                       {:18} ║", stats.parse_atom_calls);
        println!("║ Simple array values (no operators):     {:18} ║", stats.parse_array_simple_values);

        let simple_pct = if stats.parse_array_element_count > 0 {
            (stats.parse_array_simple_values as f64 / stats.parse_array_element_count as f64) * 100.0
        } else {
            0.0
        };
        println!("║ Simple value rate:                          {:15.1}% ║", simple_pct);

        println!("╚════════════════════════════════════════════════════════════╝\n");
    }
    #[cfg(not(feature = "instrument"))]
    {
        eprintln!("⚠️  Instrumentation not enabled. Compile with `--features instrument`");
    }
}

/// Reset all statistics
pub fn reset_stats() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = STATS.lock() {
            stats.parse_expr_calls = 0;
            stats.parse_expr_bp_recursive_calls = 0;
            stats.parse_array_element_calls = 0;
            stats.parse_array_element_with_arrow = 0;
            stats.parse_expr_array_first = 0;
            stats.parse_expr_array_second = 0;
            stats.parse_array_count = 0;
            stats.parse_array_element_count = 0;
            stats.parse_atom_calls = 0;
            stats.parse_array_simple_values = 0;
        }
    }
}
