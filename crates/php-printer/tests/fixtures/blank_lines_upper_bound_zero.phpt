===config===
blank_lines_upper_bound=0
===source===
<?php
echo 1;

echo 2;

function foo() {}
===print===
<?php
echo 1;
echo 2;
function foo()
{}
