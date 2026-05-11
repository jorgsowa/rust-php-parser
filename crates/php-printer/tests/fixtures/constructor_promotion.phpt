===source===
<?php class Foo { public function __construct(public readonly int $x) {} }
===print===
<?php
class Foo
{
    public function __construct(public readonly int $x)
    {}
}
