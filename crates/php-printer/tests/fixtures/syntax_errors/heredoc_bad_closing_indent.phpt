===source===
<?php
$x = <<<EOT
  a
    EOT;
===print===
<?php
syntax error;
$x = <<<EOT
a
EOT;
