===source===
<?php
require $a and $b;
include_once $a xor $b;
$x = require_once $a or $b;
include $a || $b;
$x = $c ?: throw $e and 1;
throw $e xor 1;
$x = $a ?? throw $e || 1;
$x = $a or throw $e;
===print===
<?php
require $a and $b;
include_once $a xor $b;
$x = (require_once $a or $b);
include $a || $b;
$x = $c ?: (throw $e and 1);
throw $e xor 1;
$x = $a ?? (throw $e || 1);
$x = $a or throw $e;
