<?php
// Simple variable interpolation
$greeting = "Hello $name";

// Variable with property access
$msg = "Name: $obj->name";

// Variable with array access (integer index)
$item = "Item: $arr[0]";

// Variable with array access (bare key)
$val = "Value: $arr[key]";

// Complex expression with curly braces
$full = "Full: {$user->getName()}";

// Mixed literal and variable
$mixed = "Start $x middle $y end";

// Escaped dollar (no interpolation)
$escaped = "Price: \$100";

// Curly brace with array key
$nested = "Key: {$arr['key']}";

// Variable at the start
$start = "$name is great";

// Variable at the end
$end = "Hello $name";

// No interpolation in double-quoted string
$plain = "just a plain string";

// Escape sequences
$escapes = "line1\nline2\ttab";
