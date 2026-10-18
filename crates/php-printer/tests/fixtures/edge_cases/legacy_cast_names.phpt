===source===
<?php
$a = (integer) $b;
$c = (boolean) $d;
$e = (double) $f;
$i = (binary) $j;
(void) f();
===print===
<?php
$a = (int)$b;
$c = (bool)$d;
$e = (float)$f;
$i = (string)$j;
(void)f();
