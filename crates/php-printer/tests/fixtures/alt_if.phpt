===source===
<?php if ($x): echo 1; elseif ($y): echo 2; else: echo 3; endif;
===print===
<?php
if ($x):
    echo 1;
elseif ($y):
    echo 2;
else:
    echo 3;
endif;
