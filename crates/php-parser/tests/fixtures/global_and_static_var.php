<?php
function counter() {
    static $count = 0;
    global $logger;
    $count++;
    return $count;
}
