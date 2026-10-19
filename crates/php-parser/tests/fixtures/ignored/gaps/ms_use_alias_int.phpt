===config===
ignore=parser accepts code php -l rejects: special type name as a use alias
===source===
<?php
use A as int;
===php_error===
PHP Fatal error:  Cannot use A as int because 'int' is a special class name in Standard input code on line 2
===ast >=8.5===
