===config===
php_error=Cannot use "static" as method modifier in trait alias
===source===
<?php class A { use T { a as static; } }
===print===
<?php
class A
{
    use T {
        a as static;
    }
}
