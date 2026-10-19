===config===
ignore=parser accepts code php -l rejects: generator with a void return type
===source===
<?php
function g(): void { yield 1; }
===php_error===
PHP Fatal error:  Generator return type must be a supertype of Generator, void given in Standard input code on line 2
===ast >=8.5===
