===source===
<?php trait A {} class C { use A { m as x; }
===errors===
expected '}', found end of file
