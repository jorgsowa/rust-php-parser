===source===
<?php
function g(true|null $a): false {}
function h(iterable $a, callable $b, object $c) {}
function i(\Foo\Bar $a, namespace\Baz $b): \Traversable {}
function j(int|false $a = false) {}
class A extends B {
    public function f(): static|self|parent|null { return $this; }
    public static ?self $instance = null;
    public function g(self $d): ?static { return null; }
    protected int|float $n = 0;
}
===print===
<?php
function g(true|null $a): false
{}

function h(iterable $a, callable $b, object $c)
{}

function i(\Foo\Bar $a, namespace\Baz $b): \Traversable
{}

function j(int|false $a = false)
{}

class A extends B
{
    public function f(): static|self|parent|null
    {
        return $this;
    }

    public static ?self $instance = null;

    public function g(self $d): ?static
    {
        return null;
    }

    protected int|float $n = 0;
}
