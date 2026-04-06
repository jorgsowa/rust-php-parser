<?php
function variadic(int ...$args): int {
    return 0;
}
function byref(&$ref): void {
    $ref = 1;
}
