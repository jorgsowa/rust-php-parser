<?php
$data = [1, 2, 3, 4, 5];
$sum = 0;
foreach ($data as $item) {
    $sum = $sum + $item;
}
$map = ['a' => 1, 'b' => 2];
$val = $map['a'];
echo $sum;
echo $val;
