===config===
ignore=parser accepts code php -l rejects: parenthesized single type in a DNF union
===source===
<?php
function f((A)|B $x) {}
===php_error===
PHP Parse error:  syntax error, unexpected token ")", expecting token "&" in Standard input code on line 2
===ast >=8.5===
