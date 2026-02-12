<?php
$a = 1 + 2 * 3;
$b = (1 + 2) * 3;
$c = 2 ** 3 ** 2;
$d = $a > 0 ? 'positive' : 'non-positive';
$e = $x ?? 'default';
$f = $a === $b;
$g = !$flag;
$h = -$x;
$i = $x++;
$j = ++$x;
$k = 'hello' . ' ' . 'world';
$l = $a + $b - $c * $d / $e;
$m = $a & $b | $c ^ $d;
$n = $a << 2;
$o = $a >> 1;
$p = $a <=> $b;
$q = $a ?: 'fallback';
