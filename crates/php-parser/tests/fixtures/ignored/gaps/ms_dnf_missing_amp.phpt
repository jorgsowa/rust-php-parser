===config===
ignore=parser accepts code php -l rejects: parenthesized single type in a DNF union
===source===
<?php
function f((A)|B $x) {}
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 2
===php_error 8.2-8.4===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token ")", expecting token "&" in Standard input code on line 2
===ast >=8.5===
