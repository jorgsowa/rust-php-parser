===source===
<?php
function g() {
    yield $a and $b;
    yield $a xor $b;
    yield $k => $v or $b;
    yield $x = 1 or $b;
    yield $a || $b;
    (yield $a) or $b;
}
===print===
<?php
function g()
{
    yield $a and $b;
    yield $a xor $b;
    yield $k => $v or $b;
    yield $x = 1 or $b;
    yield $a || $b;
    (yield $a) or $b;
}
