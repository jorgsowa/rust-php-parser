<?php
$filtered = array_filter($items, fn($x) => $x > 0);
$mapped = array_map(function($x) { return $x * 2; }, $items);
