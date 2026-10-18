===source===
<?php
strlen(...);
$a->b(...);
A::b(...);
(new A)(...);
$f(...);
===print===
<?php
strlen(...);
$a->b(...);
A::b(...);
(new A())(...);
$f(...);
