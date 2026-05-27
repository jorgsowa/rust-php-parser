===source===
<?php
try {
    echo 1;
}
// comment before finally
finally {
    echo 2;
}
===print===
<?php
try {
    echo 1;
}
// comment before finally
finally {
    echo 2;
}
