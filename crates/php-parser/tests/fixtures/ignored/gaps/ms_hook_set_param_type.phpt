===config===
ignore=parser accepts code php -l rejects: set hook parameter type incompatible with the property type
===source===
<?php
class A { public int $x { set(string $v) {} } }
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook A::$x::set must be compatible with property type in Standard input code on line 2
===ast >=8.5===

