===source===
<?php
$r = ($a == $b) |> $f;
$r = ($a & $b) |> $f;
$r = ($a || $b) |> $f;
$r = ($a or $b) and $c;
$r = $a ?? ($b and $c);
$r = print ($a and $b);
$r = ($a and $b) ? 1 : 2;
$r = (!$a) instanceof B;
$r = ((int) $a) ** 2;
$r = (clone $a) ** 2;
$r = (fn() => 1) + 2;
$r = (fn() => 1) . 'x';
$r = (fn() => $a) ? 1 : 2;
$r = (static fn() => 1)->bindTo(null);
$r = ($a->b)();
$r = ($a::$b)();
$r = (function () {})();
$r = $a ? ($b ? $c : $d) : $e;
$r = ($a ?: $b) ?: $c;
$r = $a ?: ($b ?: $c);
===print===
<?php
$r = ($a == $b) |> $f;
$r = ($a & $b) |> $f;
$r = ($a || $b) |> $f;
($r = ($a or $b)) and $c;
$r = $a ?? ($b and $c);
$r = (print ($a and $b));
$r = ($a and $b) ? 1 : 2;
$r = (!$a) instanceof B;
$r = ((int)$a) ** 2;
$r = (clone $a) ** 2;
$r = (fn() => 1) + 2;
$r = (fn() => 1) . 'x';
$r = (fn() => $a) ? 1 : 2;
$r = (static fn() => 1)->bindTo(null);
$r = ($a->b)();
$r = ($a::$b)();
$r = (function() {})();
$r = $a ? ($b ? $c : $d) : $e;
$r = ($a ?: $b) ?: $c;
$r = $a ?: ($b ?: $c);
