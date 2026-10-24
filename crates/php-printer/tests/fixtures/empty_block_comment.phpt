===source===
<?php
function f() { /* in */ }
if ($a) { // x
}
===print===
<?php
function f()
{
    /* in */
}

if ($a) {
    // x
}
