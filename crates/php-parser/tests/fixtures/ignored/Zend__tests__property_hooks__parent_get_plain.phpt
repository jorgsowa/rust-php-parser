===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

class P {
    public $prop = 42;
}

class C extends P {
    public $prop = 42 {
        get => parent::$prop::get();
    }
}

$c = new C();
var_dump($c->prop);

?>
