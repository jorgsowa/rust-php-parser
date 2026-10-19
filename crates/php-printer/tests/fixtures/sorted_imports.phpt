===source===
<?php
namespace B;

use Zed\Z; // zed
// about b
use b\B;
use function strlen, array_map;
use A\A as AA;
use A\A;
use const Q\C;

use Q\Q;
use C\C;

echo 1;
use Late\Y;
use Late\X;
===print===
<?php
namespace B;

use A\A;
use A\A as AA;
// about b
use b\B;
use Zed\Z; // zed
use function array_map, strlen;
use const Q\C;

use C\C;
use Q\Q;

echo 1;
use Late\X;
use Late\Y;
