===source===
<?php class Foo { #[A] public static ?int $a = 1, $b, $c = 3; private readonly string $d, $e; public private(set) int $p, $q; var $x, $y; }
===print===
<?php
class Foo
{
    #[A]
    public static ?int $a = 1;

    #[A]
    public static ?int $b;

    #[A]
    public static ?int $c = 3;

    private readonly string $d;

    private readonly string $e;

    public private(set) int $p;

    public private(set) int $q;

    public $x;

    public $y;
}
