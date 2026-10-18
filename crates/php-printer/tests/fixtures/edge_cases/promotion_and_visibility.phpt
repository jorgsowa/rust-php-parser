===source===
<?php
class A {
    public function __construct(
        private(set) public readonly int $x,
        public readonly A $a = new A(),
        protected readonly ?Foo $foo = null,
        private array $bar = [],
    ) {}
    final protected const int|string X = 1;
    public const array Y = [1, 2];
}
===print===
<?php
class A
{
    public function __construct(public private(set) readonly int $x, public readonly A $a = new A(), protected readonly ?Foo $foo = null, private array $bar = [])
    {}

    final protected const int|string X = 1;

    public const array Y = [1, 2];
}
