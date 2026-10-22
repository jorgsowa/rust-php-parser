===config===
php_error=Cannot mix keyed and unkeyed array entries in assignments
===source===
<?php [$a, 'k' => $b] = $c;
===print===
<?php
[$a, 'k' => $b] = $c;
