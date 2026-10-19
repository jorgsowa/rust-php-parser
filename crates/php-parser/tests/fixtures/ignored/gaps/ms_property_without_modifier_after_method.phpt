===config===
ignore=parser accepts code php -l rejects: property without modifier after a method
===source===
<?php
class A { function f() {} $x; }
===php_error===
PHP Parse error:  syntax error, unexpected variable "$x", expecting "function" in Standard input code on line 2
===ast >=8.5===
