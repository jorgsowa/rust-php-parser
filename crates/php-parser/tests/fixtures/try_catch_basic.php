<?php
try {
    $x = riskyOperation();
} catch (Exception $e) {
    echo $e;
} finally {
    cleanup();
}
