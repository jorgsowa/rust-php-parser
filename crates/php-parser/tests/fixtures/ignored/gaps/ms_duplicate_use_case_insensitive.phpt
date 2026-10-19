===config===
ignore=parser accepts code php -l rejects: imports differing only in case
===source===
<?php
use A\B; use A\b;
===php_error===
PHP Fatal error:  Cannot use A\b as b because the name is already in use in Standard input code on line 2
===ast >=8.5===
