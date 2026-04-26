===source===
<?php $obj = new class("a", 1) extends Base implements I1, I2 {
    public function f() { return 1; }
};
===print===
$obj = new class('a', 1) extends Base implements I1, I2
{
    public function f()
    {
        return 1;
    }
};
