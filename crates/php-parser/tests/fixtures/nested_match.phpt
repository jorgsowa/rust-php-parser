===source===
<?php
$result = match ($type) {
    'a' => match ($subtype) {
        'x' => 1,
        'y' => 2,
        default => 0,
    },
    'b' => 10,
    default => -1,
};
