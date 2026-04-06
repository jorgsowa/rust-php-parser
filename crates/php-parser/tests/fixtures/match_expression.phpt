===source===
<?php
$result = match ($x) {
    'a', 'b' => 'first',
    'c' => 'second',
    default => 'other',
};
