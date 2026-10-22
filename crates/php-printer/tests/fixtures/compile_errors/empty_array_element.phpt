===config===
php_error=Cannot use empty array elements in arrays
===source===
<?php $a = [1, , 2];
===print===
<?php
$a = [1, , 2];
