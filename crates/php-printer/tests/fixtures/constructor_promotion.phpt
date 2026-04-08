===source===
<?php class Foo { public function __construct(public readonly int $x) {} }
===print===
class Foo
{
    public function __construct(public readonly int $x)
    {}
}
