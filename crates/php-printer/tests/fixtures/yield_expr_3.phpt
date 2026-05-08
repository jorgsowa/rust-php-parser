===source===
<?php function f() { yield $key => $val; }
===print===
function f()
{
    yield $key => $val;
}
