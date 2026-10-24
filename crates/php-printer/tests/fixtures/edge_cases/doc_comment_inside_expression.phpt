===source===
<?php
function f() {
    foo(/** @x */ 1);
    bar();
}
foo(/** @param T $x */ fn($x) => $x, $other);
function g() {}
$y = /** @var Foo $z */ $z;
$f = /** doc */ function () {};
===print===
<?php
function f()
{
    foo(/** @x */ 1);
    bar();
}

foo(/** @param T $x */ fn($x) => $x, $other);

function g()
{}

$y = /** @var Foo $z */ $z;
$f = /** doc */ function() {};
