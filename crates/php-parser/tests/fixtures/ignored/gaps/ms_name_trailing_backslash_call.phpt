===config===
ignore=parser accepts code php -l rejects: trailing backslash in a call name
===source===
<?php
foo\();
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast >=8.5===
