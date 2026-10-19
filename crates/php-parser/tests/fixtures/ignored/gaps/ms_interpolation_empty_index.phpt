===config===
ignore=parser accepts code php -l rejects: `[]` read inside `{$...}`
===source===
<?php
$a = "{$b[]}";
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast >=8.5===
