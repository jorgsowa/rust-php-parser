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
        get {
            yield parent::$prop::get() + 1;
            yield parent::$prop::get() + 2;
            yield parent::$prop::get() + 3;
        }
    }
}

$b = new B();
foreach ($b->prop as $value) {
    var_dump($value);
}

?>
