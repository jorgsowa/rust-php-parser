<?php
// line comment
$x = 1; /* block comment */ $y = 2; /** doc comment */ # hash comment
$z = 3;

/** @param int $a */
function add($a, $b) {
    // return the sum
    return $a + $b; /* always positive */
}

/**/
/* empty-ish block */
