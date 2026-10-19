===source===
<?php
function f(int\X $a, string\Y &$b, ?bool\X $d, array\Y|null $e, iterable\Z|callable\W $g, mixed\X&object\Y $h, self\X $i, static\Y $j, null\Z $k, INT\X $l, float\Z ...$m): void\X {}
class A { public int\X $p; public ?string\Y $q = null; }
try {} catch (int\X | float\Y $e) {}
$a = function (callable\X $x): never\Y {};
$b = fn(bool\X $x): int\Y => 1;
new int\X;
$a instanceof string\Y;
int\f();
float\C::D;
$v = bool\E;
===print===
<?php
function f(int\X $a, string\Y &$b, ?bool\X $d, array\Y|null $e, iterable\Z|callable\W $g, mixed\X&object\Y $h, self\X $i, static\Y $j, null\Z $k, INT\X $l, float\Z ...$m): void\X
{}

class A
{
    public int\X $p;

    public ?string\Y $q = null;
}
try {} catch (int\X|float\Y $e) {}
$a = function(callable\X $x): never\Y {};
$b = fn(bool\X $x): int\Y => 1;
new int\X();
$a instanceof string\Y;
int\f();
float\C::D;
$v = bool\E;
