===config===
ignore=parser accepts code php -l rejects: attribute before a non-class name after new
===source===
<?php
$a = new #[A] B;
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected identifier "B", expecting "class" or "#[" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected identifier "B", expecting "class" in Standard input code on line 2
===ast >=8.5===

