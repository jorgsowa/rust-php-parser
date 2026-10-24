===config===
php_error=Key element cannot be a reference
===source===
<?php foreach ($a as &$k => $v) {}
===print===
<?php
foreach ($a as &$k => $v) {}
