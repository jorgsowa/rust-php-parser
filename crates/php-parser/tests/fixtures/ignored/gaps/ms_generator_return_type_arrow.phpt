===config===
ignore=parser accepts code php -l rejects: generator arrow function with a non-Generator return type
===source===
<?php
$f = fn(): int => yield 1;
===php_error===
PHP Fatal error:  Generator return type must be a supertype of Generator, int given in Standard input code on line 2
===ast >=8.5===
