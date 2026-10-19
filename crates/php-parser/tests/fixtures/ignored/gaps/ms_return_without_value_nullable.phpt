===config===
ignore=parser accepts code php -l rejects: `return;` in a function with a nullable return type
===source===
<?php
function f(): ?int { return; }
===php_error===
PHP Fatal error:  A function with return type must return a value (did you mean "return null;" instead of "return;"?) in Standard input code on line 2
===ast >=8.5===
