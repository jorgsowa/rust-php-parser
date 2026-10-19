===config===
ignore=non-fatal warning: non-public magic method
min_php=8.5
===source===
<?php
class A {
    private function __call($strMethod, $arrArgs) {
        echo "In " . __METHOD__ . "($strMethod, array(" . implode(',',$arrArgs) . "))\n";
        var_dump($this);
    }
}

class B extends A {
    function test() {
        A::test1(1,'a');
        B::test2(1,'a');
        self::test3(1,'a');
        parent::test4(1,'a');
    }
}

$b = new B();
$b->test();
?>
