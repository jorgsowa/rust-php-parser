===config===
min_php=8.6
===source===
<?php $r = array_map(foo(1, ?), $items);
===print===
<?php
$r = array_map(foo(1, ?), $items);
