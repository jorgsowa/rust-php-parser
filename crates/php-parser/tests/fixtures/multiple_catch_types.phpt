===source===
<?php
try {
    foo();
} catch (TypeError | ValueError | RuntimeException $e) {
    handle($e);
} catch (LogicException $e) {
    other($e);
}
