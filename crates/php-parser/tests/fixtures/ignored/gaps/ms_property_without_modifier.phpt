===config===
ignore=parser accepts code php -l rejects: property without modifier or var
===source===
<?php
class A { $val; }
===php_error===
PHP Parse error:  syntax error, unexpected variable "$val", expecting "function" in Standard input code on line 2
===ast >=8.5===
