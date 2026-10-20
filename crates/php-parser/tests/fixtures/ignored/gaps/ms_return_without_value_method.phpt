===config===
ignore=parser accepts code php -l rejects: `return;` in a method with a return type
===source===
<?php
class A { function f(): int { return; } }
===php_error <=8.3===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  A method with return type must return a value in Standard input code on line 2
===ast >=8.5===

