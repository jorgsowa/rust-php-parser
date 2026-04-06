===source===
<?php
$x = $a?->b?->c?->d;
$y = $a?->getB()?->getC(1, 2)?->value;
$z = $a?->items[0]?->name;
