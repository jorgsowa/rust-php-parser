===config===
ignore=parser accepts code php -l rejects: abstract method in a non-abstract class
===source===
<?php
class A { abstract function h(); }
===php_error <=8.4===
PHP Fatal error:  Class A contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (A::h) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Class A declares abstract method h() and must therefore be declared abstract in Standard input code on line 2
===ast >=8.5===
