===source===
<?php match($x) { 1 => 'one', default => 'other' };
===print===
<?php
match ($x) {
    1 => 'one',
    default => 'other',
};
