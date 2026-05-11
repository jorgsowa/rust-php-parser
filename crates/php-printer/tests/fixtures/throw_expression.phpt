===source===
<?php $x = $value ?? throw new Exception("missing");
===print===
<?php
$x = $value ?? (throw new Exception('missing'));
