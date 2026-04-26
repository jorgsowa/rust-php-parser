===source===
<?php function f((Countable&ArrayAccess)|null $x): (Foo&Bar)|string {
    return "ok";
}
===print===
function f((Countable&ArrayAccess)|null $x): (Foo&Bar)|string
{
    return 'ok';
}
