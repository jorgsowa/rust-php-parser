===source===
<?php
$a = [<<<EOT
a
EOT, 2];
foo(<<<EOT
a
EOT);
$a = <<<EOT
$b
EOT . 'x';
$a = <<<EOT
{$a[<<<INNER
x
INNER]}
EOT;
===print===
<?php
$a = [<<<EOT
a
EOT, 2];
foo(<<<EOT
a
EOT);
$a = <<<EOT
$b
EOT . 'x';
$a = <<<EOT
{$a[<<<INNER
x
INNER]}
EOT;
