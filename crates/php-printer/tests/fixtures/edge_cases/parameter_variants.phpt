===source===
<?php
function f(int $a, string ...$rest) {}
function g(&...$refs) {}
function h(?int &$x) {}
function i($a = null, $b = PHP_INT_MAX, $c = -1.5, $d = M_PI * 2, $e = ['a' => [1]], $f = A::class) {}
$f = function () use ($a, &$b,) {};
const F = static function () { return 1; };
===print===
<?php
function f(int $a, string ...$rest)
{}

function g(&...$refs)
{}

function h(?int &$x)
{}

function i($a = null, $b = PHP_INT_MAX, $c = -1.5, $d = M_PI * 2, $e = ['a' => [1]], $f = A::class)
{}

$f = function() use ($a, &$b) {};
const F = static function() {
    return 1;
};
