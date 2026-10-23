===source===
<?php switch ($a): ?>
<?php case 1: ?>one<?php break; ?>
<?php case 2: ?>two<?php endswitch; ?>
===print===
<?php
switch ($a):
    case 1:
        ?>one<?php
        break;
        ?>
<?php
    case 2:
        ?>two<?php
endswitch;
