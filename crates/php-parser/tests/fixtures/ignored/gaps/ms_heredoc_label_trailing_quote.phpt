===config===
ignore=parser accepts code php -l rejects: heredoc label with an unmatched closing quote
===source===
<?php
$a = <<<X"
a
X;
===php_error===
PHP Parse error:  syntax error, unexpected token "<<" in Standard input code on line 2
===ast >=8.5===
