===config===
php_error=get hook of property A::$a must not have a parameter list
===source===
<?php class A { public $a { get() => 1; } }
===print===
<?php
class A
{
    public $a {
        get() => 1;
    }
}
