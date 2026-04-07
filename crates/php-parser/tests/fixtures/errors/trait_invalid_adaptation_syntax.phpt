===source===
<?php trait A { public function m() {} } class C { use A { m invalid; } }
===errors===
expected '::' or 'as', found identifier
expected identifier, found ';'
expected '::' or 'as', found ';'
