===source===
<?php
try {
    risky();
} catch (TypeError|ValueError|RuntimeException|LogicException $e) {
    handle($e);
}
