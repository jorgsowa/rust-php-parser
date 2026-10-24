===config===
php_error=Cannot redeclare property hook "SET"
===source===
<?php class A { public $a { set {} SET {} } }
===print===
<?php
class A
{
    public $a {
        set {}
        SET {}
    }
}
