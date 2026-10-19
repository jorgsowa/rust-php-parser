===config===
ignore=parser accepts code php -l rejects: function imports differing only in case
===source===
<?php
use function A\f; use function B\F;
===php_error===
PHP Fatal error:  Cannot use function B\F as F because the name is already in use in Standard input code on line 2
===ast >=8.5===
