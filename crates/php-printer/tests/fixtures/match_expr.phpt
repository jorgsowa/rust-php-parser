===source===
<?php match($x) { 1 => 'one', 2, 3 => 'few', default => 'many' };
===print===
match ($x) {
    1 => 'one',
    2, 3 => 'few',
    default => 'many',
};
