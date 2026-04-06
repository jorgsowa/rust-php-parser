===source===
<?php
function foo($a, $b,) {}
foo(1, 2,);
$f = function($x,) use ($y,) {};
$g = fn($x,) => $x;
[$a, $b,] = $arr;
match ($x) { 1 => 'a', 2 => 'b', };
use App\{A, B,};
