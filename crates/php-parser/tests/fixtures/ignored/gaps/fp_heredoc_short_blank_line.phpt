===config===
ignore=parser rejects valid code: whitespace-only heredoc line shorter than the closing indent
===source===
<?php
$a = <<<X
  a
 
  X;
===ast >=8.5===
