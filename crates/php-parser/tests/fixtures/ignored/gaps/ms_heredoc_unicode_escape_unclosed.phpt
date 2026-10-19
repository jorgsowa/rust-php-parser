===config===
ignore=parser accepts code php -l rejects: unterminated \u{ escape in a heredoc
===source===
<?php
$a = <<<X
\u{41
X;
===php_error===
PHP Parse error:  Invalid UTF-8 codepoint escape sequence in Standard input code on line 3
===ast >=8.5===
