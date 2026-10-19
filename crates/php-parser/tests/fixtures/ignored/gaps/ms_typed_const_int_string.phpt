===config===
ignore=parser accepts code php -l rejects: literal of the wrong type for a typed class constant
===source===
<?php
class A { const int X = 'a'; }
===php_error===
PHP Fatal error:  Cannot use string as value for class constant A::X of type int in Standard input code on line 2
===ast >=8.5===
