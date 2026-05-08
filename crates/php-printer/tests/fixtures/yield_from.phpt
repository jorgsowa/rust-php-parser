===source===
<?php function f() { yield from $gen; }
===print===
function f()
{
    yield from $gen;
}
