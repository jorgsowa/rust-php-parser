===source===
<?php declare(ticks=1) ?>
a
<?php declare(ticks=1) { echo 1; } ?>
b
<?php declare(ticks=1): echo 2; enddeclare ?>
c
===print===
<?php
declare(ticks=1);
?>
a
<?php
declare(ticks=1) {
    echo 1;
}
?>
b
<?php
declare(ticks=1):
    echo 2;
enddeclare;
?>
c
