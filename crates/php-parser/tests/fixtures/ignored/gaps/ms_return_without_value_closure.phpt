===config===
ignore=parser accepts code php -l rejects: `return;` in a closure with a return type
===source===
<?php
$f = function(): int { return; };
===php_error===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===ast >=8.5===
