===config===
ignore=parser accepts code php -l rejects: trait use inside an interface
===source===
<?php
interface I { use T; }
===php_error===
PHP Fatal error:  Cannot use traits inside of interfaces. T is used in I in Standard input code on line 2
===ast >=8.5===
