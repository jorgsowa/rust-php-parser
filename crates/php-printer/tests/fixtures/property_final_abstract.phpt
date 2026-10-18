===source===
<?php abstract class Foo { final public int $a = 1; abstract public string $b { get; } final protected(set) string $c { set => $value; } }
===print===
<?php
abstract class Foo
{
    final public int $a = 1;

    abstract public string $b {
        get;
    }

    final protected(set) string $c {
        set => $value;
    }
}
