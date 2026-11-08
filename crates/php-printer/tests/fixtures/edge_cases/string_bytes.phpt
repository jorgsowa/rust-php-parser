===source===
<?php
$a = "\xff";
$b = "a\x80b\xc3";
$c = "\u{D800}";
$d = "\xc3\xbf";
$e = "\xffx$y\x80";
$f = <<<EOT
\xfe$y
EOT;

===print===
<?php
$a = "\xff";
$b = "a\x80b\xc3";
$c = "\xed\xa0\x80";
$d = 'ÿ';
$e = "\xffx{$y}\x80";
$f = <<<EOT
\xfe$y
EOT;
