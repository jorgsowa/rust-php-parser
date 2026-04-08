===source===
<?php try { foo(); } catch (Exception $e) { bar(); } finally { baz(); }
===print===
try {
    foo();
} catch (Exception $e) {
    bar();
} finally {
    baz();
}
