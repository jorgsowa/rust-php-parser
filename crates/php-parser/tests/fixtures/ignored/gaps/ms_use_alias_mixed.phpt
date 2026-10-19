===config===
ignore=parser accepts code php -l rejects: special type name as a use alias
===source===
<?php
use A as mixed;
===php_error===
PHP Fatal error:  Cannot use A as mixed because 'mixed' is a special class name in Standard input code on line 2
===ast >=8.5===
