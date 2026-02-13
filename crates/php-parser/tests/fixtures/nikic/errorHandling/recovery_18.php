<?php

use A\{B, };
use function A\{b, };
use A, ;
const A = 42, ;

class X implements Y, {
    use A, ;
    use A, {
        A::b insteadof C, ;
    }
    const A = 42, ;
    public $x, ;
}
interface I extends J, {}

unset($x, );
isset($x, );

declare(a=42, );

global $a, ;
static $a, ;
echo $a, ;

for ($a, ; $b, ; $c, );