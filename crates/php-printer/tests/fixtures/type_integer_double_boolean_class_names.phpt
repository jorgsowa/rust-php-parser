===source===
<?php function f(integer $a, ?double $b, boolean|null $c, Integer&Countable $d): integer {} fn(boolean $x): double => $x;
===print===
<?php
function f(integer $a, ?double $b, boolean|null $c, Integer&Countable $d): integer
{}
fn(boolean $x): double => $x;
