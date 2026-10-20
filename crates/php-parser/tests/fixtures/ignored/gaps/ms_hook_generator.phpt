===config===
ignore=parser accepts code php -l rejects: generator property hook
===source===
<?php
class A { public int $x { get { yield 1; } } }
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Generator return type must be a supertype of Generator, int given in Standard input code on line 2
===ast >=8.5===
