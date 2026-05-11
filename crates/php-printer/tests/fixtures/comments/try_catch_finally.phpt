===source===
<?php
try {
    echo 1;
    // comment in try
} catch (Exception $e) {
    echo 2;
    // comment in catch
} finally {
    echo 3;
    // comment in finally
}
===print===
<?php
try {
    echo 1;
    // comment in try
} catch (Exception $e) {
    echo 2;
    // comment in catch
} finally {
    echo 3;
    // comment in finally
}
