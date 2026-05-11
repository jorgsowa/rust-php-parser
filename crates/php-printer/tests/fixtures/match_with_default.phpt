===source===
<?php $r = match ($x) {
    1, 2 => "low",
    3 => "mid",
    default => "other",
};
===print===
<?php
$r = match ($x) {
    1, 2 => 'low',
    3 => 'mid',
    default => 'other',
};
