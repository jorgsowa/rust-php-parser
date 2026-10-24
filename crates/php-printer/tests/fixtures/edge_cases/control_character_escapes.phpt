===source===
<?php
$a = "a\0b\x01\x7f";
$b = "x\e\f\v\t\n";
$c = `\e\x02`;
$d = <<<EOT
q\x00\x1b\t\r
EOT;
$e = "\x1f$a";
===print===
<?php
$a = "a\x00b\x01\x7f";
$b = "x\e\f\v\t\n";
$c = `\x1b\x02`;
$d = <<<EOT
q\x00\x1b	\r
EOT;
$e = "\x1f$a";
