===source===
<?php
include $a or $b;
$x = throw $e or 1;
(include $a) or $b;
===print===
<?php
include $a or $b;
$x = throw $e or 1;
(include $a) or $b;
