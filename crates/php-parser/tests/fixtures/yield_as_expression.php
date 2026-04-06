<?php
function gen() {
    $received = yield 'value';
    $received = yield $key => $value;
}
