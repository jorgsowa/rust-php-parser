===source===
<?php
function gen($x) {
    $v = match(true) {
        $x > 0 => yield $x,
        default => yield 0,
    };
}
