===config===
php_error=Unparenthesized `a ? b : c ? d : e` is not supported. Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)`
===source===
<?php $x = $a ? $b : $c ? $d : $e;
$y = $a ?: $b ? $c : $d ? $e : $f;
===print===
<?php
$x = $a ? $b : $c ? $d : $e;
$y = $a ?: $b ? $c : $d ? $e : $f;
