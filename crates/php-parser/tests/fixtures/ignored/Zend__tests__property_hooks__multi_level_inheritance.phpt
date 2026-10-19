===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

class A {
    public $prop = 1;
}

class B extends A {
    public $prop = 2 { get => parent::$prop::get() * 2; }
}

class C extends B {
    public $prop = 3;
}

function test(A $a) {
    var_dump($a);
    var_dump((array)$a);
    var_dump(unserialize(serialize($a)));
    var_dump(get_object_vars($a));
    var_dump(json_decode(json_encode($a)));
}

test(new B);
test(new C);

?>
