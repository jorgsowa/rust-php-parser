===config===
ignore=parser accepts code php -l rejects: trailing backslash in an attribute name
===source===
<?php
#[\App\] function f() {}
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting "]" in Standard input code on line 2
===ast >=8.5===
