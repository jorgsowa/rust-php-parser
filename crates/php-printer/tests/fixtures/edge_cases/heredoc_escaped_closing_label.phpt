===source===
<?php
$a = <<<EOT
\x45OT
EOT;
$b = <<<EOT
  E\117T
EOT;
$c = <<<EOT
\x45OT\x31
\x45OT{$y}
\x45OT\$
\x45OT\x3b
EOT;
$d = <<<EOT
\x45OT
EOT;
$e = <<<"EOT"
x
\x45OT
EOT;
===print===
<?php
$a = <<<EOT
\x45OT
EOT;
$b = <<<EOT
  \x45OT
EOT;
$c = <<<EOT
EOT1
\x45OT$y
\x45OT\$
\x45OT;
EOT;
$d = <<<EOT
\x45OT
EOT;
$e = <<<EOT
x
\x45OT
EOT;
