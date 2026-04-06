===source===
<?php
$result = match ($type) {
    'a' => match ($subtype) {
        1 => 'a1',
        2 => 'a2',
        default => 'a_other',
    },
    'b' => 'b',
    default => 'other',
};
