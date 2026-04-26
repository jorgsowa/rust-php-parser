===source===
<?php try {
    risky();
} catch (RuntimeException) {
    log("oops");
} catch (LogicException|TypeError) {
    rethrow();
}
===print===
try {
    risky();
} catch (RuntimeException) {
    log('oops');
} catch (LogicException|TypeError) {
    rethrow();
}
