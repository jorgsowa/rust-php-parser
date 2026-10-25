===config===
php_error=Cannot assign to array(), use [] instead
===source===
<?php
[$x, array($a)] = $b;
list(list($y), ARRAY($c)) = $b;
foreach ($x as [array($a)]) {}
===print===
<?php
[$x, array($a)] = $b;
list(list($y), array($c)) = $b;
foreach ($x as [array($a)]) {}
