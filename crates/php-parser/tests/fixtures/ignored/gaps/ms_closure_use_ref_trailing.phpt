===config===
ignore=parser accepts code php -l rejects: empty closure use list
===source===
<?php
$a = function() use () {};
===php_error===
PHP Parse error:  syntax error, unexpected token ")", expecting variable or "&" or token "&" in Standard input code on line 2
===ast >=8.5===
