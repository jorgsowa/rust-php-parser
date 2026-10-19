===config===
ignore=parser accepts code php -l rejects: callable is a reserved class name
===source===
<?php
class callable {}
===php_error===
PHP Parse error:  syntax error, unexpected token "callable", expecting identifier in Standard input code on line 2
===ast >=8.5===
