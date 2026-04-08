===source===
<?php try { foo(); } catch (A|B $e) { bar(); }
===print===
try {
    foo();
} catch (A|B $e) {
    bar();
}
