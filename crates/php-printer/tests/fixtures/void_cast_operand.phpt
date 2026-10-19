===source===
<?php
(void) f() + 1;
(void) $a or $b;
(void) $a ? f() : g();
===print===
<?php
(void)(f() + 1);
(void)($a or $b);
(void)($a ? f() : g());
