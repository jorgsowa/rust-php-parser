===config===
ignore=parser rejects valid code: `1...2` lexes as `1.` `.` `.2`
===source===
<?php
$a = 1...2;
===ast >=8.5===
