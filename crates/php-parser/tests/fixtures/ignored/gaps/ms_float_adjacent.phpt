===config===
ignore=parser accepts code php -l rejects: `1..2` is two adjacent numbers
===source===
<?php
$a = 1..2;
===php_error===
PHP Parse error:  syntax error, unexpected floating-point number ".2" in Standard input code on line 2
===ast >=8.5===
