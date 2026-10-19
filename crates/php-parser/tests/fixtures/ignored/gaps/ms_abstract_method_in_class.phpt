===config===
ignore=parser accepts code php -l rejects: abstract method in a non-abstract class
===source===
<?php
class A { abstract function h(); }
===php_error===
PHP Fatal error:  Class A declares abstract method h() and must therefore be declared abstract in Standard input code on line 2
===ast >=8.5===
