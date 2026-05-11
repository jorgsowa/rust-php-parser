===source===
<?php $f = function() use (&$x) {};
===print===
<?php
$f = function() use (&$x) {};
