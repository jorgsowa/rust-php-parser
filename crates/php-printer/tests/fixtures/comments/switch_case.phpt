===source===
<?php
switch ($x) {
    // comment before case
    case 1:
        echo 1;
        // comment in case
        break;
    // comment before default
    default:
        echo 2;
}
===print===
switch ($x) {
    // comment before case
    case 1:
        echo 1;
        // comment in case
        break;
    // comment before default
    default:
        echo 2;
}
