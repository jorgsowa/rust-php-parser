===config===
php_error=Enum E cannot include properties
===source===
<?php enum E { case A; /** Name */ public string $name = "a"; var $b, $c; }
===print===
<?php
enum E
{
    case A;

    /** Name */
    public string $name = 'a';

    var $b;

    var $c;
}
