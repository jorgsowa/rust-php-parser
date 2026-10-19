===source===
<?php
function f(int\X $a, ?string\Y $b, array\Z|null $c): iterable\W {}
===print===
<?php
function f(int\X $a, ?string\Y $b, array\Z|null $c): iterable\W
{}
