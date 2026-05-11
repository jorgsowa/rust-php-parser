===source===
<?php $obj = new readonly class("a") {
    public function __construct(public string $name) {}
};
===print===
<?php
$obj = new readonly class('a')
{
    public function __construct(public string $name)
    {}
};
