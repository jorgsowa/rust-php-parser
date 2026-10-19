===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

class A {
    public $prop = 42;
}

class B extends A {
    public $prop = 42 {
        set {}
    }
}

$b = new B;
array_walk($b, function (&$item) {
    var_dump($item);
});

?>
