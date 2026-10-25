===source===
<?php
class A {
    public $a, /* a */ $b;
    const X = 1, /* x */ Y = 2;
    public $c, // c
        $d;
}
===print===
<?php
class A
{
    public $a;

    /* a */
    public $b;

    const X = 1;

    /* x */
    const Y = 2;

    public $c;

    // c
    public $d;
}
