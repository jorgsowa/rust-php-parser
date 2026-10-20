===config===
ignore=parser rejects valid code: intersection type before a by-ref param
===source===
<?php
function f(A&B &$x) {}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 2
===ast >=8.5===

