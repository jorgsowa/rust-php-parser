===source===
<?php try { foo(); } catch (A|B $e) { bar(); }
===print===
<?php
try {
    foo();
} catch (A|B $e) {
    bar();
}
