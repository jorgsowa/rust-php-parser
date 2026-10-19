===source===
<?php
$a = new #[Attr] class {};
$b = new #[A, B(1)] #[C] readonly class($x) extends D {};
===print===
<?php
$a = new #[Attr] class {};
$b = new #[A] #[B(1)] #[C] readonly class($x) extends D {};
