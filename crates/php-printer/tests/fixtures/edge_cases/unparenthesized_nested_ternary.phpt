===source===
<?php $x = $a ? $b : $c ? $d : $e;
===print===
<?php
$x = ($a ? $b : $c) ? $d : $e;
