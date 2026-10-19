===source===
<?php
while (1) { break ?>x<?php }
while (1) { continue ?>x<?php }
switch ($a) { case 1: break ?>x<?php }
function f() { return ?>x<?php }
function g() { yield ?>x<?php }
function h() { return 1 ?>x<?php }
while (1) { while (1) { break 2 ?>x<?php } }
===print===
<?php
while (1) {
    break;
    ?>x<?php
}
while (1) {
    continue;
    ?>x<?php
}
switch ($a) {
    case 1:
        break;
        ?>x<?php
}

function f()
{
    return;
    ?>x<?php
}

function g()
{
    yield;
    ?>x<?php
}

function h()
{
    return 1;
    ?>x<?php
}
while (1) {
    while (1) {
        break 2;
        ?>x<?php
    }
}
