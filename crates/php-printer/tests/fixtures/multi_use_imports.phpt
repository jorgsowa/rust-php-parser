===source===
<?php use A\B, C\D as E, F\G\H;
use function math\add, math\sub as minus;
use const FLAG_A, ns\FLAG_B as B;
===print===
use A\B, C\D as E, F\G\H;
use function math\add, math\sub as minus;
use const FLAG_A, ns\FLAG_B as B;
