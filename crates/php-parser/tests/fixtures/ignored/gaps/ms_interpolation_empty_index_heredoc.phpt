===config===
ignore=parser accepts code php -l rejects: `[]` read inside heredoc interpolation
===source===
<?php
$a = <<<X
{$b[]}
X;
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 3
===ast >=8.5===
