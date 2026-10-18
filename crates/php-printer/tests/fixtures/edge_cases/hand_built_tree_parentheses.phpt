===config===
strip_parens=true
===source===
<?php
$r = ($a == $b) |> $f;
$r = ($a & $b) |> $f;
$r = $a |> (fn($x) => $x);
$r = ($a or $b) and $c;
$r = ($a = $b) and $c;
$r = $a ?? ($b and $c);
$r = print ($a and $b);
$r = ($a and $b) ? 1 : 2;
$r = (!$a) instanceof B;
$r = !($a instanceof B);
$r = -($a instanceof B);
$r = ((int) $a) ** 2;
$r = (int) ($a ** 2);
$r = - (- $a);
$r = ($a->b)();
$r = ($a::$b)();
$r = ($a ?? $b)();
$r = (function () {})();
$r = (fn() => 1)();
$r = (fn() => 1) + 2;
$r = (fn() => 1) ?? 2;
$f = (fn() => $a) and $b;
$r = ($f = fn() => 1) ?? 2;
$r = $c ? fn() => 1 : 2;
$r = [fn() => 1, 2];
$r = f(fn() => 1, 2);
$r = $c ?: fn() => 1;
$r = (static fn() => 1)->bindTo(null);
$r = (clone $a)->b;
$r = (new $a)->b;
$r = new A()->b;
$r = (1)->x;
$r = (match ($a) { default => [] })[0];
$r = new ($a->b());
$r = new (A::b());
$r = new ($a());
$r = new (A::C);
$r = new ($a . $b);
$r = new $a->b;
$r = new $a['b'];
$r = new A::$b;
function g() {
    $u = [(yield $a) => 1];
    yield (yield $k) => 1;
}
===print===
<?php
$r = ($a == $b) |> $f;
$r = ($a & $b) |> $f;
$r = $a |> (fn($x) => $x);
$r = ($a or $b) and $c;
$r = $a = $b and $c;
$r = $a ?? ($b and $c);
$r = (print ($a and $b));
$r = ($a and $b) ? 1 : 2;
$r = (!$a) instanceof B;
$r = !$a instanceof B;
$r = -($a instanceof B);
$r = ((int)$a) ** 2;
$r = (int)$a ** 2;
$r = - -$a;
$r = ($a->b)();
$r = ($a::$b)();
$r = ($a ?? $b)();
$r = (function() {})();
$r = (fn() => 1)();
$r = (fn() => 1) + 2;
$r = (fn() => 1) ?? 2;
$f = (fn() => $a) and $b;
$r = ($f = (fn() => 1)) ?? 2;
$r = $c ? fn() => 1 : 2;
$r = [fn() => 1, 2];
$r = f(fn() => 1, 2);
$r = $c ?: fn() => 1;
$r = (static fn() => 1)->bindTo(null);
$r = (clone $a)->b;
$r = (new $a())->b;
$r = new A()->b;
$r = (1)->x;
$r = (match ($a) {
    default => [],
})[0];
$r = new ($a->b())();
$r = new (A::b())();
$r = new ($a())();
$r = new (A::C)();
$r = new ($a . $b)();
$r = new $a->b();
$r = new $a['b']();
$r = new A::$b();

function g()
{
    $u = [(yield $a) => 1];
    yield (yield $k) => 1;
}
