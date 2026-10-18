===source===
<?php namespace App; var_dump(true, FALSE, Null, \true, \null); $a = true ? false : null;
===print===
<?php
namespace App;
var_dump(true, false, null, \true, \null);
$a = true ? false : null;
