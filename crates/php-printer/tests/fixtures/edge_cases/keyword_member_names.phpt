===source===
<?php
class A {
    public function list() {}
    public function class() {}
    public static function new() {}
    const FOREACH = 1;
}
$a->list();
A::list();
$a->class;
A::FOREACH;
A::new();
$a->fn;
$a?->match;
function enum() {}
enum();
===print===
<?php
class A
{
    public function list()
    {}

    public function class()
    {}

    public static function new()
    {}

    const FOREACH = 1;
}

$a->list();
A::list();
$a->class;
A::FOREACH;
A::new();
$a->fn;
$a?->match;

function enum()
{}

enum();
