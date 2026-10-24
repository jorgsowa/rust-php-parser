===config===
php_error=Arrow functions on the right hand side of |> must be parenthesized
===source===
<?php $x = 1 |> fn($y) => $y |> f(...);
===print===
<?php
$x = 1 |> fn($y) => $y |> f(...);
