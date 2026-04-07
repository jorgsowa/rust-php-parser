//! Lightweight instrumentation for profiling array parsing, expression parsing, and statement parsing.
//!
//! This module provides zero-cost abstractions for profiling when the `instrument` feature
//! is enabled. When disabled, all instrumentation macros and calls compile to nothing.

#[cfg(feature = "instrument")]
use std::sync::{Mutex, OnceLock};

/// Global instrumentation statistics
pub struct InstrumentStats {
    // Expression & Array Parsing
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

    // Statement Parsing
    /// Total statements parsed
    pub parse_stmt_calls: u64,
    /// Total function/method declarations
    pub parse_function_calls: u64,
    /// Total class/trait/interface declarations
    pub parse_class_calls: u64,
    /// Total foreach statements
    pub parse_foreach_calls: u64,
    /// Total for/while/do-while statements
    pub parse_loop_calls: u64,
    /// Total if/elseif/else statements
    pub parse_if_calls: u64,
    /// Total switch statements
    pub parse_switch_calls: u64,
    /// Total try/catch/finally statements
    pub parse_try_calls: u64,
    /// Total attribute groups parsed (PHP 8.0+)
    pub parse_attribute_calls: u64,

    // Memory Allocation Patterns
    /// Total ArenaVec allocations
    pub arena_vec_allocations: u64,
    /// Total bytes allocated in ArenaVec
    pub arena_vec_bytes: u64,
    /// Total times arena.alloc was called
    pub arena_alloc_calls: u64,
    /// Total ArenaVec reallocations (growth)
    pub arena_vec_reallocations: u64,
    /// Total bytes wasted in pre-allocated but unused capacity
    pub arena_vec_wasted_capacity: u64,
    /// Number of empty ArenaVec allocations (capacity but no elements)
    pub arena_vec_empty: u64,
}

#[cfg(feature = "instrument")]
fn stats() -> &'static Mutex<InstrumentStats> {
    static STATS: OnceLock<Mutex<InstrumentStats>> = OnceLock::new();
    STATS.get_or_init(|| {
        Mutex::new(InstrumentStats {
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
            parse_stmt_calls: 0,
            parse_function_calls: 0,
            parse_class_calls: 0,
            parse_foreach_calls: 0,
            parse_loop_calls: 0,
            parse_if_calls: 0,
            parse_switch_calls: 0,
            parse_try_calls: 0,
            parse_attribute_calls: 0,
            arena_vec_allocations: 0,
            arena_vec_bytes: 0,
            arena_alloc_calls: 0,
            arena_vec_reallocations: 0,
            arena_vec_wasted_capacity: 0,
            arena_vec_empty: 0,
        })
    })
}

/// Record a parse_expr call
#[inline]
pub fn record_parse_expr() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_expr_calls += 1;
        }
    }
}

/// Record a recursive parse_expr_bp call (min_bp != 0)
#[inline]
pub fn record_parse_expr_bp_recursive() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_expr_bp_recursive_calls += 1;
        }
    }
}

/// Record array parsing started
#[inline]
pub fn record_parse_array() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_array_count += 1;
        }
    }
}

/// Record array element parsing started
#[inline]
pub fn record_parse_array_element() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_array_element_calls += 1;
        }
    }
}

/// Record first parse_expr call in array element (key or value)
#[inline]
pub fn record_parse_expr_array_first() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_expr_array_first += 1;
        }
    }
}

/// Record second parse_expr call in array element (after =>)
#[inline]
pub fn record_parse_expr_array_second() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_expr_array_second += 1;
        }
    }
}

/// Record array element with => operator
#[inline]
pub fn record_parse_array_element_with_arrow() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_array_element_with_arrow += 1;
        }
    }
}

/// Record total array elements parsed
#[inline]
pub fn record_parse_array_element_count(_count: usize) {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_array_element_count += _count as u64;
        }
    }
}

/// Record parse_atom call
#[inline]
pub fn record_parse_atom() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_atom_calls += 1;
        }
    }
}

/// Record a simple/atomic value in an array (not followed by binary operators)
#[inline]
pub fn record_parse_array_simple_value() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_array_simple_values += 1;
        }
    }
}

// ==================== STATEMENT PARSING METRICS ====================

/// Record a statement parse call
#[inline]
pub fn record_parse_stmt() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_stmt_calls += 1;
        }
    }
}

/// Record a function/method declaration
#[inline]
pub fn record_parse_function() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_function_calls += 1;
        }
    }
}

/// Record a class/trait/interface declaration
#[inline]
pub fn record_parse_class() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_class_calls += 1;
        }
    }
}

/// Record a foreach statement
#[inline]
pub fn record_parse_foreach() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_foreach_calls += 1;
        }
    }
}

/// Record for/while/do-while statements
#[inline]
pub fn record_parse_loop() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_loop_calls += 1;
        }
    }
}

/// Record if/elseif/else statements
#[inline]
pub fn record_parse_if() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_if_calls += 1;
        }
    }
}

/// Record switch statements
#[inline]
pub fn record_parse_switch() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_switch_calls += 1;
        }
    }
}

/// Record try/catch/finally statements
#[inline]
pub fn record_parse_try() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_try_calls += 1;
        }
    }
}

/// Record attribute group parsing
#[inline]
pub fn record_parse_attribute() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.parse_attribute_calls += 1;
        }
    }
}

// ==================== MEMORY ALLOCATION METRICS ====================

/// Record an ArenaVec allocation with size info
#[inline]
pub fn record_arena_vec_allocation(_capacity: usize) {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.arena_vec_allocations += 1;
            stats.arena_vec_bytes += _capacity as u64;
        }
    }
}

/// Record an arena.alloc call
#[inline]
pub fn record_arena_alloc() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.arena_alloc_calls += 1;
        }
    }
}

/// Record wasted capacity in ArenaVec (allocated but not used)
#[inline]
pub fn record_arena_vec_waste(_wasted_bytes: usize) {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.arena_vec_wasted_capacity += _wasted_bytes as u64;
        }
    }
}

/// Record an empty ArenaVec that was allocated
#[inline]
pub fn record_arena_vec_empty() {
    #[cfg(feature = "instrument")]
    {
        if let Ok(mut stats) = stats().lock() {
            stats.arena_vec_empty += 1;
        }
    }
}

/// Get current statistics (snapshot)
pub fn get_stats() -> InstrumentStats {
    #[cfg(feature = "instrument")]
    {
        stats()
            .lock()
            .ok()
            .map(|stats| InstrumentStats {
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
                parse_stmt_calls: stats.parse_stmt_calls,
                parse_function_calls: stats.parse_function_calls,
                parse_class_calls: stats.parse_class_calls,
                parse_foreach_calls: stats.parse_foreach_calls,
                parse_loop_calls: stats.parse_loop_calls,
                parse_if_calls: stats.parse_if_calls,
                parse_switch_calls: stats.parse_switch_calls,
                parse_try_calls: stats.parse_try_calls,
                parse_attribute_calls: stats.parse_attribute_calls,
                arena_vec_allocations: stats.arena_vec_allocations,
                arena_vec_bytes: stats.arena_vec_bytes,
                arena_alloc_calls: stats.arena_alloc_calls,
                arena_vec_reallocations: stats.arena_vec_reallocations,
                arena_vec_wasted_capacity: stats.arena_vec_wasted_capacity,
                arena_vec_empty: stats.arena_vec_empty,
            })
            .unwrap_or(InstrumentStats {
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
                parse_stmt_calls: 0,
                parse_function_calls: 0,
                parse_class_calls: 0,
                parse_foreach_calls: 0,
                parse_loop_calls: 0,
                parse_if_calls: 0,
                parse_switch_calls: 0,
                parse_try_calls: 0,
                parse_attribute_calls: 0,
                arena_vec_allocations: 0,
                arena_vec_bytes: 0,
                arena_alloc_calls: 0,
                arena_vec_reallocations: 0,
                arena_vec_wasted_capacity: 0,
                arena_vec_empty: 0,
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
            parse_stmt_calls: 0,
            parse_function_calls: 0,
            parse_class_calls: 0,
            parse_foreach_calls: 0,
            parse_loop_calls: 0,
            parse_if_calls: 0,
            parse_switch_calls: 0,
            parse_try_calls: 0,
            parse_attribute_calls: 0,
            arena_vec_allocations: 0,
            arena_vec_bytes: 0,
            arena_alloc_calls: 0,
            arena_vec_reallocations: 0,
            arena_vec_wasted_capacity: 0,
            arena_vec_empty: 0,
        }
    }
}

/// Print a formatted report of statistics
pub fn report_stats() {
    #[cfg(feature = "instrument")]
    {
        let stats = get_stats();
        println!("\n╔════════════════════════════════════════════════════════════╗");
        println!("║      Parser Instrumentation Report (Full Analysis)        ║");
        println!("╠════════════════════════════════════════════════════════════╣");

        println!("║ STATEMENT PARSING:                                        ║");
        println!(
            "║ Total statements:                       {:18} ║",
            stats.parse_stmt_calls
        );
        println!(
            "║   - Functions:                          {:18} ║",
            stats.parse_function_calls
        );
        println!(
            "║   - Classes/Traits:                     {:18} ║",
            stats.parse_class_calls
        );
        println!(
            "║   - If statements:                      {:18} ║",
            stats.parse_if_calls
        );
        println!(
            "║   - Loops (for/while/do):               {:18} ║",
            stats.parse_loop_calls
        );
        println!(
            "║   - Foreach:                            {:18} ║",
            stats.parse_foreach_calls
        );
        println!(
            "║   - Switch:                             {:18} ║",
            stats.parse_switch_calls
        );
        println!(
            "║   - Try/Catch:                          {:18} ║",
            stats.parse_try_calls
        );
        println!(
            "║   - Attributes:                         {:18} ║",
            stats.parse_attribute_calls
        );

        println!("╠════════════════════════════════════════════════════════════╣");
        println!("║ ARRAY & EXPRESSION PARSING:                               ║");
        println!(
            "║ Arrays Parsed:                          {:18} ║",
            stats.parse_array_count
        );
        println!(
            "║ Array Elements:                         {:18} ║",
            stats.parse_array_element_count
        );
        println!(
            "║ Array Elements with =>:                 {:18} ║",
            stats.parse_array_element_with_arrow
        );

        let arrow_rate = if stats.parse_array_element_calls > 0 {
            (stats.parse_array_element_with_arrow as f64 / stats.parse_array_element_calls as f64)
                * 100.0
        } else {
            0.0
        };
        println!(
            "║ => Rate:                                    {:15.1}% ║",
            arrow_rate
        );

        println!("╠════════════════════════════════════════════════════════════╣");
        println!(
            "║ Total parse_expr calls:                 {:18} ║",
            stats.parse_expr_calls
        );
        println!(
            "║ parse_expr calls (array, first):        {:18} ║",
            stats.parse_expr_array_first
        );
        println!(
            "║ parse_expr calls (array, second =>):    {:18} ║",
            stats.parse_expr_array_second
        );

        let second_expr_overhead = stats.parse_expr_array_second;
        let second_expr_pct = if stats.parse_expr_calls > 0 {
            (second_expr_overhead as f64 / stats.parse_expr_calls as f64) * 100.0
        } else {
            0.0
        };
        println!(
            "║ Double-parse overhead (%):                  {:15.1}% ║",
            second_expr_pct
        );

        println!("╠════════════════════════════════════════════════════════════╣");
        println!(
            "║ parse_atom calls:                       {:18} ║",
            stats.parse_atom_calls
        );
        println!(
            "║ Simple array values (no operators):     {:18} ║",
            stats.parse_array_simple_values
        );

        let simple_pct = if stats.parse_array_element_count > 0 {
            (stats.parse_array_simple_values as f64 / stats.parse_array_element_count as f64)
                * 100.0
        } else {
            0.0
        };
        println!(
            "║ Simple value rate:                          {:15.1}% ║",
            simple_pct
        );

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
        if let Ok(mut stats) = stats().lock() {
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
            stats.parse_stmt_calls = 0;
            stats.parse_function_calls = 0;
            stats.parse_class_calls = 0;
            stats.parse_foreach_calls = 0;
            stats.parse_loop_calls = 0;
            stats.parse_if_calls = 0;
            stats.parse_switch_calls = 0;
            stats.parse_try_calls = 0;
            stats.parse_attribute_calls = 0;
            stats.arena_vec_allocations = 0;
            stats.arena_vec_bytes = 0;
            stats.arena_alloc_calls = 0;
            stats.arena_vec_reallocations = 0;
            stats.arena_vec_wasted_capacity = 0;
            stats.arena_vec_empty = 0;
        }
    }
}
