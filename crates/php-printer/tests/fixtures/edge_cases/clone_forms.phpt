===source===
<?php
$a = clone $b->c;
$a = (clone $b)->c;
$a = clone($b, ['x' => 1]);
===print===
<?php
$a = clone $b->c;
$a = (clone $b)->c;
$a = clone($b, ['x' => 1]);
