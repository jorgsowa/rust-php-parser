===config===
ignore=parser accepts code php -l rejects: trailing backslash in a use name
===source===
<?php
use X\;
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "{" in Standard input code on line 2
===ast >=8.5===
