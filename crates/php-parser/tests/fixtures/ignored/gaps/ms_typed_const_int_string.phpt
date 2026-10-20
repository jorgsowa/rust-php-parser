===config===
ignore=parser accepts code php -l rejects: literal of the wrong type for a typed class constant
===source===
<?php
class A { const int X = 'a'; }
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected identifier "X", expecting "=" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use string as value for class constant A::X of type int in Standard input code on line 2
===ast >=8.5===
