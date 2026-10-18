===source===
<?php
list($a, , $b) = $c;
[, $a] = $b;
[$a, [$b, $c]] = $d;
list('a' => $x, 'b' => list($y)) = $d;
[&$a, $b] = $c;
foreach ($a as [$x, [$y, $z]]) {}
foreach ($a as ['k' => $x, 'l' => $y]) {}
foreach ($a as list($x, , $y)) {}
===print===
<?php
[$a, , $b] = $c;
[, $a] = $b;
[$a, [$b, $c]] = $d;
['a' => $x, 'b' => [$y]] = $d;
[&$a, $b] = $c;
foreach ($a as [$x, [$y, $z]]) {}
foreach ($a as ['k' => $x, 'l' => $y]) {}
foreach ($a as [$x, , $y]) {}
