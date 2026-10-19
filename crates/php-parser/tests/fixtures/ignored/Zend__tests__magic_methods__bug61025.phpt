===config===
ignore=non-fatal warning: non-public magic method
min_php=8.5
===source===
<?php

class Bar {
    private function __invoke() {
        return __CLASS__;
    }
}

$b = new Bar;
echo $b();

echo $b->__invoke();

?>
