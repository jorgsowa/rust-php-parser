===source===
<?php
$a = $b ?? throw new E('x');
$a = $b ?: throw $c ?? $d;
$f = fn() => $a and $b;
$f = (fn() => $a) and $b;
$f = fn() => fn() => 1;
$f = fn&(array &$x = []): ?int => $x[0] ?? null;
$f = static fn(int ...$a): static => new static;
$f = (fn() => 1)();
$f = function &() use (&$a, $b): void {};
===print===
<?php
$a = $b ?? (throw new E('x'));
$a = $b ?: (throw $c ?? $d);
$f = fn() => $a and $b;
$f = (fn() => $a) and $b;
$f = fn() => fn() => 1;
$f = fn&(array &$x = []): ?int => $x[0] ?? null;
$f = static fn(int ...$a): static => new static();
$f = (fn() => 1)();
$f = function &() use (&$a, $b): void {};
