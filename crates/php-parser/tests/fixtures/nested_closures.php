<?php
$outer = function($x) {
    $inner = function($y) use ($x) {
        return $x + $y;
    };
    return $inner;
};
