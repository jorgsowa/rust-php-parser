<?php
class A {
    /** @var ?string */
    private $foo

    public function __construct(string $s) {
        $this->foo = $s;
    }
}
class B {
    const X = 1
}