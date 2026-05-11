===source===
<?php try { foo(); } catch (Exception $e) { bar(); } finally { baz(); }
===print===
<?php
try {
    foo();
} catch (Exception $e) {
    bar();
} finally {
    baz();
}
