===config===
ignore=parser accepts code php -l rejects: break with a non-integer operand
===source===
<?php
while (1) { break $a; }
===php_error===
PHP Fatal error:  'break' operator with non-integer operand is no longer supported in Standard input code on line 2
===ast >=8.5===
