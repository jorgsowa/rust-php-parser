===config===
min_php=8.6
===source===
<?php $fn = $a->b(1, ?)->c(...);
===print===
<?php
$fn = $a->b(1, ?)->c(...);
