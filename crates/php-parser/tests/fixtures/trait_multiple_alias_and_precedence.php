<?php
trait A { public function foo() {} }
trait B { public function foo() {} public function bar() {} }
class C {
    use A, B {
        B::foo insteadof A;
        A::foo as private afoo;
        B::bar as public bbar;
    }
}
