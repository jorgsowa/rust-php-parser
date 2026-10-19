===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

const X = 'x';

class P {
    public $prop;
}

class C extends P {
    public $prop = X {
        get => 'y';
    }
}

var_dump((new C)->prop);

?>
