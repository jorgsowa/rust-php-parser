===config===
ignore=parser accepts code php -l rejects: by-ref set hook parameter
===source===
<?php
class A { public int $x { set(&$a) {} } }
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Parameter $a of set hook A::$x must not be pass-by-reference in Standard input code on line 2
===ast >=8.5===

