===config===
ignore=parser accepts code php -l rejects: heredoc label starting with a digit
===source===
<?php
$a = <<<1X
a
1X;
===php_error===
PHP Parse error:  syntax error, unexpected token "<<" in Standard input code on line 2
===ast >=8.5===
