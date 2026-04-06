<?php
function &getValue(): string {
    return $GLOBALS['value'];
}
function &getReference(array &$arr): mixed {
    return $arr[0];
}
