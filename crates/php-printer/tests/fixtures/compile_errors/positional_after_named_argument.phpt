===config===
php_error=Cannot use positional argument after named argument
===source===
<?php f(a: 1, 2);
===print===
<?php
f(a: 1, 2);
