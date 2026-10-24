===source===
<?php if ($a) { ?>
<?php }
function f() { ?>
<?php }
switch ($a) { case 1: ?>
<?php case 2: echo 1; ?>
<?php }
===print===
<?php
if ($a) {}

function f()
{}

switch ($a) {
    case 1:
    case 2:
        echo 1;
}
