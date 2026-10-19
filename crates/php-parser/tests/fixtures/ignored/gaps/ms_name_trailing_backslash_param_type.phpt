===config===
ignore=parser accepts code php -l rejects: trailing backslash in a parameter type
===source===
<?php
function f(A\ $x) {}
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting variable in Standard input code on line 2
===ast >=8.5===
