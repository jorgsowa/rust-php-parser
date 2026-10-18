===source===
<?php
$a = <<<EOT
EOT;
$a = <<<'EOT'
EOT;
$a = <<<EOT


EOT;
$a = <<<EOT
line with EOT inside
EOTX
EOT;
$a = <<<'EOT'
$notvar \n {$x}
EOT;
$a = <<<EOT
a\rb
EOT;
$a = <<<EOT
\x41\u{42}\103
EOT;
$a = <<<EOT
	tab
EOT;
===print===
<?php
$a = <<<EOT

EOT;
$a = <<<'EOT'

EOT;
$a = <<<EOT


EOT;
$a = <<<EOT
line with EOT inside
EOTX
EOT;
$a = <<<'EOT'
$notvar \n {$x}
EOT;
$a = <<<EOT
a\rb
EOT;
$a = <<<EOT
ABC
EOT;
$a = <<<EOT
	tab
EOT;
