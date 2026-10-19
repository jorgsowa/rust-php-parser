===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

class A {
    public $prop = 41;
}

class B extends A {
    public $prop = 42 {
        get {
            return 43;
        }
    }
}

$b = new B();
var_dump($b);
var_dump($b->prop);
$b->prop = 44;
var_dump($b);
var_dump($b->prop);

?>
