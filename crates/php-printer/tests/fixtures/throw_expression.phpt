===source===
<?php $x = $value ?? throw new Exception("missing");
===print===
$x = $value ?? (throw new Exception('missing'));
