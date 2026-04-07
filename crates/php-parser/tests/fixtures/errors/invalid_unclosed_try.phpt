===source===
<?php
try {
    foo();

catch (Exception $e) {
    bar();
}
===errors===
expected expression
expected catch or finally clause, found end of file
