===config===
ignore=parser accepts code php -l rejects: static is not a trait alias modifier
===source===
<?php
class A { use T { T::a as static; } }
===php_error===
PHP Fatal error:  Cannot use "static" as method modifier in trait alias in Standard input code on line 2
===ast >=8.5===
