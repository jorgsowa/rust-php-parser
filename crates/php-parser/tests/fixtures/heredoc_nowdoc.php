<?php
// Basic heredoc
$text = <<<EOT
Hello World
EOT;

// Heredoc with interpolation
$name = "PHP";
$msg = <<<EOT
Hello $name!
EOT;

// Nowdoc (no interpolation)
$raw = <<<'EOT'
Hello $name!
EOT;

// Heredoc in expression context
echo <<<EOT
output
EOT;
