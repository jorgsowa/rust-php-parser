===config===
strip_parens=true
===source===
<?php
$r = (clone $a) ** 2;
$r = clone ($a ** 2);
===print===
<?php
$r = clone $a ** 2;
$r = clone ($a ** 2);
