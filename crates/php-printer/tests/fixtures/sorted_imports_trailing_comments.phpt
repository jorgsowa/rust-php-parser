===source===
<?php
use Z\Z; // z trail
use M\M; /* m trail */
use A\A; # a trail
// lead of c
use C\C; // c trail
/* lead b */ use B\B; // b trail
use A\A2; /* multi
line */
use D\D;
===print===
<?php
use A\A; # a trail
use A\A2; /* multi
line */
/* lead b */
use B\B; // b trail
// lead of c
use C\C; // c trail
use D\D;
use M\M; /* m trail */
use Z\Z; // z trail
