===config===
ignore=parser accepts code php -l rejects: attribute on a trait use
===source===
<?php
class C { #[A] use T; }
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token "use", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "use", expecting "function" in Standard input code on line 2
===ast >=8.5===

