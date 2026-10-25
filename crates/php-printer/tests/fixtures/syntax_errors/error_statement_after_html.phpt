===source===
<?php switch ($a): ?>
x<?php endswitch;
===print===
<?php
syntax error;
switch ($a):
endswitch;
?>
x<?php
/* error */
