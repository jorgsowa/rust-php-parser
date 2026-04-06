===source===
<?php
function foo((A&B)|C $x): (X&Y)|Z {
    return $x;
}
function bar((A&B)|(C&D) $y): (E&F)|null {
    return $y;
}
