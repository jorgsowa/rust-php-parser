===config===
ignore=parser accepts code php -l rejects: typed property without modifier
===source===
<?php
class A { ?int $val; }
===php_error===
PHP Parse error:  syntax error, unexpected token "?", expecting "function" in Standard input code on line 2
===ast >=8.5===
