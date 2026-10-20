===source===
<?php function f() { yield $key => $val; }
===print===
<?php
function f()
{
    yield $key => $val;
}
