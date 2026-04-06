===source===
<?php
function foo($x = new Foo(), $y = new Bar(1, 2)) {}

class MyClass {
    public $prop = new DefaultObj();
    const C = new Config();

    public function method($p = new Param()) {}
}

function baz() {
    static $cache = new Cache();
}

#[Attr(new Foo())]
function qux() {}

$f = function ($x = new Foo()) {};
$g = fn($x = new Foo()) => $x;
