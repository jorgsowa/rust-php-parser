===source===
<?php
$x = <<<EOT
a
EOT; // after heredoc
$y = [<<<EOT
a
EOT, // in array
2];
===print===
<?php
$x = <<<EOT
a
EOT; // after heredoc
$y = [
    <<<EOT
a
EOT, // in array
    2,
];
