===source===
<?php
class A {
    /** p */
    public $p = 1, /** q */ $q;
    const A = 1, /** B */ B = 2;
}
enum E {
    const X = 1, /** Y */ Y = 2;
}
===print===
<?php
class A
{
    /** p */
    public $p = 1;

    /** q */
    public $q;

    const A = 1;

    /** B */
    const B = 2;
}

enum E
{
    const X = 1;

    /** Y */
    const Y = 2;
}
