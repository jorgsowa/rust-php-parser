===source===
<?php
try {
    try {
        dangerousOp();
    } catch (InnerException $e) {
        log($e);
        throw $e;
    }
} catch (OuterException $e) {
    handleOuter($e);
}
