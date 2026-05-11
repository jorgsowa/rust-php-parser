===source===
<?php $x = <<<EOT
literal backslash: \\
escaped dollar: \$var
real var: $name
end-of-line value
EOT;
===print===
<?php
$x = <<<EOT
literal backslash: \\
escaped dollar: \$var
real var: $name
end-of-line value
EOT;
