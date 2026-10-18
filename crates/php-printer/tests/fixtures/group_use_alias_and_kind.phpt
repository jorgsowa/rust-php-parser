===source===
<?php use A\{B as C, function d as e, const F};
===print===
<?php
use A\B as C;
use function A\d as e;
use const A\F;
