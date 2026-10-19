===source===
<?php
clone($a)?->b;
clone($a)["k"];
clone($a)();
clone($a) + 1;
===print===
<?php
clone ($a)?->b;
clone ($a)['k'];
clone ($a)();
clone $a + 1;
