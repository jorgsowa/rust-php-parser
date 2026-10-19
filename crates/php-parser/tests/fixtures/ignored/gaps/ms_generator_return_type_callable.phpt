===config===
ignore=parser accepts code php -l rejects: generator with a callable return type
===source===
<?php
function g(): callable { yield 1; }
===php_error===
PHP Fatal error:  Generator return type must be a supertype of Generator, callable given in Standard input code on line 2
===ast >=8.5===
