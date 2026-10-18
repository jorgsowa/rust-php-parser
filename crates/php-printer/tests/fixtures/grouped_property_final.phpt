===source===
<?php class Foo { final public int $a = 1, $b = 2; final protected(set) string $c, $d; }
===print===
<?php
class Foo
{
    final public int $a = 1;

    final public int $b = 2;

    final protected(set) string $c;

    final protected(set) string $d;
}
