===config===
ignore=parser accepts code php -l rejects: trailing backslash in a catch type
===source===
<?php
try {} catch (A\ $e) {}
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting ")" in Standard input code on line 2
===ast >=8.5===
