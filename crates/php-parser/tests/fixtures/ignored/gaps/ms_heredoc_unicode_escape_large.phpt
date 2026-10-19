===config===
ignore=parser accepts code php -l rejects: codepoint too large in a heredoc
===source===
<?php
$a = <<<X
\u{110000}
X;
===php_error===
PHP Parse error:  Invalid UTF-8 codepoint escape sequence: Codepoint too large in Standard input code on line 3
===ast >=8.5===
