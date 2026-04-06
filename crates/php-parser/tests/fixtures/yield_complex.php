===source===
<?php
function gen() {
    $a = yield;
    $b = yield 'value';
    $c = yield 'key' => 'value';
    yield from otherGen();
    $d = (yield 'x') + 1;
}
