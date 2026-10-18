===source===
<?php
if ($a) {
    x();
} // after brace
$b = 1; /* block */ // line
$c = [
    1, // one
    2 // two
];
f(
    $a // last
);
$d = 2; # hash
/** doc */
function g() {}
$e = 3; // before close ?>
html
===print===
<?php
if ($a) {
    x();
} // after brace
$b = 1; /* block */ // line
$c = [
    1, // one
    2, // two
];
f(
    $a // last
);
$d = 2; # hash

/** doc */
function g()
{}
$e = 3; // before close
?>
html
