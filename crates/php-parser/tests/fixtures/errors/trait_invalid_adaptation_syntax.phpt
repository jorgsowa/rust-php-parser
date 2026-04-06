===source===
<?php trait A { public function m() {} } class C { use A { m invalid; } }
===errors===
