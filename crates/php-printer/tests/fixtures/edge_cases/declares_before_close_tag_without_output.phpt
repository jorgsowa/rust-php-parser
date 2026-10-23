===source===
<?php declare(strict_types=1) ?>
<?php declare(ticks=1) ?>
<?php declare(ticks=1) { echo 1; } ?>
<?php declare(ticks=1): echo 2; enddeclare ?>
<?php echo 3;
===print===
<?php
declare(strict_types=1);
declare(ticks=1);
declare(ticks=1) {
    echo 1;
}
declare(ticks=1):
    echo 2;
enddeclare;
echo 3;
