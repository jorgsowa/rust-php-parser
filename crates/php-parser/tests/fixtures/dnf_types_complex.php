<?php
function f((A&B)|C|null $x): (X&Y)|(P&Q)|null {
    return $x;
}
class Foo {
    public (A&B)|C $prop;
    public function bar((A&B)|(C&D) $a, E|null $b): (F&G)|null {}
}
