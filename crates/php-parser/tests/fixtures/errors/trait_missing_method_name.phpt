===source===
<?php trait A {} class C { use A { insteadof; } }
===errors===
expected '::' or 'as', found ';'
