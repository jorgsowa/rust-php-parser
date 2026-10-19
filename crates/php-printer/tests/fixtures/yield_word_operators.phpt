===source===
<?php
function g() {
    yield $a or $b;
    yield ($a or $b);
    yield from $a and $b;
    yield $k => $v xor $b;
}
===print===
<?php
function g()
{
    yield $a or $b;
    yield ($a or $b);
    yield from $a and $b;
    yield $k => $v xor $b;
}
