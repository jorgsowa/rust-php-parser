===config===
ignore=parser rejects valid code: `?>` as the case terminator
===source===
<?php
switch ($a) { case 1 ?>x<?php break; }
===ast >=8.5===
