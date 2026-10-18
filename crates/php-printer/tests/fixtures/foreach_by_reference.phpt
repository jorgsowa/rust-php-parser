===source===
<?php
foreach ($a as &$v) {}
foreach ($a as $k => &$v) {}
foreach ($a as &$v):
endforeach;
foreach ($a as [&$x, $y]) {}
===print===
<?php
foreach ($a as &$v) {}
foreach ($a as $k => &$v) {}
foreach ($a as &$v):

endforeach;
foreach ($a as [&$x, $y]) {}
