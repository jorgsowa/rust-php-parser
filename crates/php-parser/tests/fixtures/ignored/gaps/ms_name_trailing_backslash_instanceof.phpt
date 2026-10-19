===config===
ignore=parser accepts code php -l rejects: trailing backslash after instanceof
===source===
<?php
$a instanceof Bar\;
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast >=8.5===
