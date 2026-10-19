===config===
ignore=parser accepts code php -l rejects: attribute on a trait use
===source===
<?php
class C { #[A] use T; }
===php_error===
PHP Parse error:  syntax error, unexpected token "use", expecting "function" in Standard input code on line 2
===ast >=8.5===
