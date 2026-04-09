===source===
<?php match($x) { 1 => 'one', default => 'other' };
===print===
match ($x) {
    1 => 'one',
    default => 'other',
};
