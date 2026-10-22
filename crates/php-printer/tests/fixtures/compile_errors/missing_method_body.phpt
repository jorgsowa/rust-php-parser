===config===
php_error=Non-abstract method C::f() must contain body
===source===
<?php class C { public function f(); }
===print===
<?php
class C
{
    public function f();
}
