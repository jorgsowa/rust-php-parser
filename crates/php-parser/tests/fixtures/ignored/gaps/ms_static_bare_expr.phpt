===config===
ignore=parser accepts code php -l rejects: bare static as an expression
===source===
<?php
$a = static;
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "::" in Standard input code on line 2
===ast >=8.5===
