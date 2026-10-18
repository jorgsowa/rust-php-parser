===source===
<?php
$r = ('abc')[0];
$r = "abc"[0];
$r = [1, 2][0];
$r = PHP_EOL[0];
$r = A::B[0];
$r = __FILE__[0];
$r = ('a' . 'b')::C;
$r = ('A')::c();
$r = ('f')();
$r = [$a, 'b']();
$r = (new A)();
$r = (new A)['x'];
$r = (clone $a)->b;
$r = ([$a, $b] = $c)[0];
$r = ($a = $b)->c;
===print===
<?php
$r = ('abc')[0];
$r = 'abc'[0];
$r = [1, 2][0];
$r = PHP_EOL[0];
$r = A::B[0];
$r = __FILE__[0];
$r = ('a' . 'b')::C;
$r = ('A')::c();
$r = ('f')();
$r = [$a, 'b']();
$r = (new A())();
$r = (new A())['x'];
$r = (clone $a)->b;
$r = ([$a, $b] = $c)[0];
$r = ($a = $b)->c;
