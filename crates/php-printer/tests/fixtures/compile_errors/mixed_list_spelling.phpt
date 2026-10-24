===config===
php_error=Cannot mix [] and list()
===source===
<?php
list($a, [$b]) = $c;
[$a, list($b)] = $c;
===print===
<?php
list($a, [$b]) = $c;
[$a, list($b)] = $c;
