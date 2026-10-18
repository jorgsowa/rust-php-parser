===source===
<?php
foo($a, // first
    $b);
if ($a) {
    x();
}
// dangling end comment
===print===
<?php
foo($a, $b);
// first
if ($a) {
    x();
}
// dangling end comment

