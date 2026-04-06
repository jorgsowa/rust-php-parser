<?php
class MyClass {
    use A, B {
        A::foo insteadof B;
        B::foo as baz;
        foo as bar;
        foo as protected;
        A::hello as private hi;
        A::big insteadof B, C;
    }
}
