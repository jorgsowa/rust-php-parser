===source===
<?php
$a = new ($b . 'C');
$a = new $b->c;
$a = new $b['c'];
$a = new $b::$c;
$a = new (trim($b))(1);
$a = new ($a->b());
$a = new (A::C);
$a = new static;
$a = (new A)->b();
$a = new A()->b();
$a = new A()::C;
$a = new A()['x'];
$a = (new A)::$b;
$a = new readonly class(1) implements I {};
$a = new class($x, ...$y) extends \B {};
===print===
<?php
$a = new ($b . 'C')();
$a = new $b->c();
$a = new $b['c']();
$a = new $b::$c();
$a = new (trim($b))(1);
$a = new ($a->b())();
$a = new (A::C)();
$a = new static();
$a = (new A())->b();
$a = new A()->b();
$a = new A()::C;
$a = new A()['x'];
$a = (new A())::$b;
$a = new readonly class(1) implements I
{};
$a = new class($x, ...$y) extends \B
{};
