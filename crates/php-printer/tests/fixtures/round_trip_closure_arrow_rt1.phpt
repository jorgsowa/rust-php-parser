===source===
<?php $f = function($x) use ($y) { return $x + $y; };
===print===
$f = function($x) use ($y) {
    return $x + $y;
};
