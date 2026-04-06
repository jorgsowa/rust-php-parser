<?php
$f = fn($x) => fn($y) => fn($z) => $x + $y + $z;
$g = fn($a) => $a > 0 ? fn($b) => $b * 2 : fn($b) => $b * -1;
