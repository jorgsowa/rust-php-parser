===config===
php_error=Cannot specify default value for virtual hooked property C::$a
===source===
<?php class C { public int $a = 1 { get => 2; } }
===print===
<?php
class C
{
    public int $a = 1 {
        get => 2;
    }
}
