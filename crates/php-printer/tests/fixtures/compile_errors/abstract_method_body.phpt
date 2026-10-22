===config===
php_error=Abstract function C::f() cannot contain body
===source===
<?php abstract class C { abstract public function f() { return 1; } }
===print===
<?php
abstract class C
{
    abstract public function f()
    {
        return 1;
    }
}
