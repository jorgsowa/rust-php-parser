===config===
skip_php_validate=1
===source===
<?php enum E { case A; /** Name */ public string $name = "a"; var $b, $c; }
===print===
<?php
enum E
{
    case A;

    /** Name */
    public string $name = 'a';

    public $b;

    public $c;
}
