===config===
ignore=parser accepts code php -l rejects: by-ref array literal as foreach target
===source===
<?php
foreach ($a as &[$b]) {}
===php_error===
PHP Parse error:  syntax error, unexpected token ")", expecting "->" or "?->" or "[" in Standard input code on line 2
===ast >=8.5===
