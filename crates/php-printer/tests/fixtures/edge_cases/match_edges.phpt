===source===
<?php
$a = match ($b) { 1, 2 => 'x', default => 'y', };
$a = match (true) {};
$a = match ($b) { $c ? 1 : 2 => match ($d) { default => 3 } };
===print===
<?php
$a = match ($b) {
    1, 2 => 'x',
    default => 'y',
};
$a = match (true) {
};
$a = match ($b) {
    $c ? 1 : 2 => match ($d) {
        default => 3,
    },
};
