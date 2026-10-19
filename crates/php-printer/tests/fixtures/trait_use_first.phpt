===source===
<?php
class A {
    // first
    public int $x = 1;
    /** doc c */
    const X = 1;
    /** doc t2 */
    use T2;
    use T1 { a as b; }
    public function m() {}
}
===print===
<?php
class A
{
    /** doc t2 */
    use T2;

    use T1 {
        a as b;
    }

    // first
    public int $x = 1;

    /** doc c */
    const X = 1;

    public function m()
    {}
}
