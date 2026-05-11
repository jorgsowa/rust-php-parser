===source===
<?php switch ($x): case 1: echo 'one'; break; default: echo 'other'; endswitch;
===print===
<?php
switch ($x):
    case 1:
        echo 'one';
        break;
    default:
        echo 'other';
endswitch;
