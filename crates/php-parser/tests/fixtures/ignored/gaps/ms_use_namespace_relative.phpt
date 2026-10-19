===config===
ignore=parser accepts code php -l rejects: namespace-relative name in use
===source===
<?php
use namespace\A;
===php_error===
PHP Parse error:  syntax error, unexpected namespace-relative name "namespace\A" in Standard input code on line 2
===ast >=8.5===
