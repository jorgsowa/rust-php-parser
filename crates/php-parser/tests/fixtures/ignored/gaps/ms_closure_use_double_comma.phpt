===config===
ignore=parser accepts code php -l rejects: double comma in closure use
===source===
<?php
$a = function() use ($a,,) {};
===php_error===
PHP Parse error:  syntax error, unexpected token ",", expecting ")" in Standard input code on line 2
===ast >=8.5===
