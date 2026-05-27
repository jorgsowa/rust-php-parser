===source===
<?php
try {
    echo 1;
}
// comment before catch
catch (Exception $e) {
    echo 2;
}
===print===
<?php
try {
    echo 1;
}
// comment before catch
catch (Exception $e) {
    echo 2;
}
