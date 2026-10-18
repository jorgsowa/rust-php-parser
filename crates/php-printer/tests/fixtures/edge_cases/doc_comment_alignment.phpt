===source===
<?php
/**
 * Summary
 *
 * @param int $x first
 *   continued
 */
function f($x) {}
class A {
    /**
     * Method doc
     */
    public function m() {
        /** @var int $y */
        $y = 1;
    }
}
===print===
<?php
/**
 * Summary
 *
 * @param int $x first
 *   continued
 */
function f($x)
{}

class A
{
    /**
     * Method doc
     */
    public function m()
    {
        /** @var int $y */
        $y = 1;
    }
}
