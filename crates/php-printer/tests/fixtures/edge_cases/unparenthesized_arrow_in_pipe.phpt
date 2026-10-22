===source===
<?php $x = 1 |> fn($y) => $y |> f(...);
===print===
<?php
$x = 1 |> (fn($y) => $y |> f(...));
