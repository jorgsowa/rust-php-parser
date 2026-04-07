===source===
<?php $x = match ($v) { 1 => 'one', default => 'first', default => 'second' };
===errors===
match expression may only contain one default arm
