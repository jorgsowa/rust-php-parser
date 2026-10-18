===source===
<?php
function f() {
    $a = 1; /** @x */
    $b = 2; /** @y */

    // c
    g();
}
class C {
    public $p; /** @d */
    // e
    public function m() {}
}
===print===
<?php
function f()
{
    $a = 1;
    /** @x */
    $b = 2;
    /** @y */
    // c
    g();
}

class C
{
    public $p;

    /** @d */
    // e
    public function m()
    {}
}
