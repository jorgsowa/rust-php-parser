===source===
<?php Enum::FOO; Enum\foo(); enum(); readonly(); $f = strlen(...); $g = \Foo\bar(...); $h = Foo::bar(...);
===print===
<?php
Enum::FOO;
Enum\foo();
enum();
readonly();
$f = strlen(...);
$g = \Foo\bar(...);
$h = Foo::bar(...);
