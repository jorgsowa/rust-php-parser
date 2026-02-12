<?php
function add($a, $b) {
    return $a + $b;
}

function greet($name = 'World') {
    echo 'Hello, ' . $name;
}

$result = add(1, 2);
greet();
greet('PHP');
