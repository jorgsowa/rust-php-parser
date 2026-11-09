===source===
<?php
$r1 = $x == $a =& $b > f();
$r2 = $c ? 1 : $a =& $b > f();
$r3 = $n ?? $a =& $b > f();
$r4 = !$a =& $o instanceof C;
$r5 = -$a =& $b ** 2;
$r6 = (int) $a =& $b . 'x';
$r7 = @$a =& $b + 1;
$r8 = $a | $c =& $b ^ 1;
===print===
<?php
$r1 = $x == ($a =& $b) > f();
$r2 = $c ? 1 : ($a =& $b) > f();
$r3 = $n ?? ($a =& $b) > f();
$r4 = !($a =& $o) instanceof C;
$r5 = -($a =& $b) ** 2;
$r6 = (int)($a =& $b) . 'x';
$r7 = @($a =& $b) + 1;
$r8 = $a | ($c =& $b) ^ 1;
