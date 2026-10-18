===source===
<?php
$a = print $b . 'x';
$a = $b and print 'x';
$a = (print $b) + 1;
$a = include $b . '.php';
$a = (include 'a.php') + 1;
function g() {
    $a = yield $b => $c;
    $d = (yield) + 1;
    f(yield $x);
    yield from g();
    $e = yield from $f ?? $g;
    $x = yield $a ?? $b;
    $y = (yield $a) ?? $b;
}
===print===
<?php
$a = (print $b . 'x');
($a = $b) and (print 'x');
$a = (print $b) + 1;
$a = (include $b . '.php');
$a = (include 'a.php') + 1;

function g()
{
    $a = (yield $b => $c);
    $d = (yield) + 1;
    f(yield $x);
    yield from g();
    $e = (yield from $f ?? $g);
    $x = (yield $a ?? $b);
    $y = (yield $a) ?? $b;
}
