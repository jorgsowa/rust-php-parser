===config===
php_error=Property hook list must not be empty
===source===
<?php class C { public int $a {} public function __construct(public int $b {}) {} }
===print===
<?php
class C
{
    public int $a {}

    public function __construct(public int $b {})
    {}
}
