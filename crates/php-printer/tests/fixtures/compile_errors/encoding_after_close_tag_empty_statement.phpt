===config===
php_error=Encoding declaration pragma must be the very first statement in the script
===source===
<?php declare(ticks=1); ?>
<?php declare(encoding='UTF-8');
===print===
<?php
declare(ticks=1);
?>
<?php
declare(encoding='UTF-8');
