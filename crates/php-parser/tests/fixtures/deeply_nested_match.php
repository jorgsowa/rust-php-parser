<?php
$r = match(1) {
    1 => match(2) {
        2 => match(3) {
            3 => 'deep',
            default => 'x'
        },
        default => 'y'
    },
    default => 'z'
};
