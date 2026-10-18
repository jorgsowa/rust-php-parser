===source===
<?php
$a = `echo \``;
$a = `a\\b`;
$a = `$b[0]`;
$a = `a"b'c`;
$a = `{$a->b()}`;
===print===
<?php
$a = `echo \``;
$a = `a\\b`;
$a = `{$b[0]}`;
$a = `a"b'c`;
$a = `{$a->b()}`;
