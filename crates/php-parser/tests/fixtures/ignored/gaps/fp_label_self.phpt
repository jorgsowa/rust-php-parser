===config===
ignore=parser rejects valid code: `self` as a goto label
===source===
<?php
self: $x;
===ast >=8.5===
