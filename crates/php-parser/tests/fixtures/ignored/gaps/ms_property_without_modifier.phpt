===config===
ignore=parser accepts code php -l rejects: property without modifier or var
===source===
<?php
class A { $val; }
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected variable "$val", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected variable "$val", expecting "function" in Standard input code on line 2
===ast >=8.5===

