===config===
ignore=parser accepts code php -l rejects: `&` without a variable in closure use
===source===
<?php
$a = function() use (&) {};
===php_error===
PHP Parse error:  syntax error, unexpected token ")", expecting variable in Standard input code on line 2
===ast >=8.5===
