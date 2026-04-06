<?php
$result = match (true) {
    $x > 0 => 'positive',
    $x < 0 => 'negative',
    default => 'zero',
};
