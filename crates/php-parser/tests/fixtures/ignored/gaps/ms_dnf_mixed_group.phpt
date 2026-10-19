===config===
ignore=parser accepts code php -l rejects: union inside a DNF group
===source===
<?php
function f((A&B|C) $x) {}
===php_error===
PHP Parse error:  syntax error, unexpected token "|", expecting token "&" or ")" in Standard input code on line 2
===ast >=8.5===
