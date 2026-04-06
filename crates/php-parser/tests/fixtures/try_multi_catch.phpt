===source===
<?php
try {
    process();
} catch (TypeError|ValueError $e) {
    handleTypeError($e);
} catch (RuntimeException) {
    handleRuntime();
}
