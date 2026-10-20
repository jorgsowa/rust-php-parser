===config===
ignore=parser accepts code php -l rejects: static is not a trait alias modifier
===source===
<?php
class A { use T { T::a as static; } }
===php_error <=8.2===
PHP Fatal error:  Cannot use 'static' as method modifier in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "static" as method modifier in trait alias in Standard input code on line 2
===ast >=8.5===

