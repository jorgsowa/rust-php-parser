===source===
<?php
try {
    echo 1;
    // comment in try
    echo 2;
} catch (Exception $e) {
    echo 3;
    // comment in catch
    echo 4;
}
===print===
<?php
try {
    echo 1;
    // comment in try
    echo 2;
} catch (Exception $e) {
    echo 3;
    // comment in catch
    echo 4;
}
