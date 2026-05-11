===source===
<?php function f() { yield from $gen; }
===print===
<?php
function f()
{
    yield from $gen;
}
