===config===
strip_parens=true
===source===
<?php
function g()
{
    yield (from);
    yield (from)[1];
    yield (from) => 1;
    yield (FROM) + 1;
    yield 1 => from;
}
===print===
<?php
function g()
{
    yield (from);
    yield (from[1]);
    yield (from) => 1;
    yield (FROM + 1);
    yield 1 => from;
}
