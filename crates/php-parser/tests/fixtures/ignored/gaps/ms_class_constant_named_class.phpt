===config===
ignore=parser accepts code php -l rejects: class constant named class
===source===
<?php
class A { const class = 1; }
===php_error===
PHP Fatal error:  A class constant must not be called 'class'; it is reserved for class name fetching in Standard input code on line 2
===ast >=8.5===
