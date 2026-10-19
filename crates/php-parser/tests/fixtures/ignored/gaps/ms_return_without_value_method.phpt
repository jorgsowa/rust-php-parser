===config===
ignore=parser accepts code php -l rejects: `return;` in a method with a return type
===source===
<?php
class A { function f(): int { return; } }
===php_error===
PHP Fatal error:  A method with return type must return a value in Standard input code on line 2
===ast >=8.5===
