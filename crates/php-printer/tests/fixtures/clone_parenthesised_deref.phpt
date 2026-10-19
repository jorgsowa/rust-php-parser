===source===
<?php
clone($a)->b = 1;
clone($a)->b();
clone($a)::X;
===print===
<?php
clone (($a)->b = 1);
clone ($a)->b();
clone ($a)::X;
