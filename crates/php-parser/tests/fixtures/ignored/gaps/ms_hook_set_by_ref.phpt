===config===
ignore=parser accepts code php -l rejects: by-ref set hook parameter
===source===
<?php
class A { public int $x { set(&$a) {} } }
===php_error===
PHP Fatal error:  Parameter $a of set hook A::$x must not be pass-by-reference in Standard input code on line 2
===ast >=8.5===
