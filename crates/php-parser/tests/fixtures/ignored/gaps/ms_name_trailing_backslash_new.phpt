===config===
ignore=parser accepts code php -l rejects: trailing backslash in a new name
===source===
<?php
$a = new Bar\;
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast >=8.5===
