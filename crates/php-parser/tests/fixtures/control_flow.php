<?php
if ($x > 0) {
    echo 'positive';
} elseif ($x < 0) {
    echo 'negative';
} else {
    echo 'zero';
}

while ($i < 10) {
    $i = $i + 1;
}

for ($i = 0; $i < 10; $i++) {
    echo $i;
}

foreach ($items as $item) {
    echo $item;
}

foreach ($map as $key => $value) {
    echo $key;
    echo $value;
}
