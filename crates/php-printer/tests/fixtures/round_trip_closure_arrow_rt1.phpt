===source===
<?php $f = function($x) use ($y) { return $x + $y; };
===print===
<?php
$f = function($x) use ($y) {
    return $x + $y;
};
