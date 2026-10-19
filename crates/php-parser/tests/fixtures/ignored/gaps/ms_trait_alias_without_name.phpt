===config===
ignore=parser accepts code php -l rejects: trait alias with no name or visibility
===source===
<?php
class A { use T { a as; } }
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 2
===ast >=8.5===
