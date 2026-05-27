===source===
<?php
$f = function() use ($x)
// comment before closure body
{
    echo $x;
};
===print===
<?php
$f = function() use ($x)
// comment before closure body
{
    echo $x;
};
