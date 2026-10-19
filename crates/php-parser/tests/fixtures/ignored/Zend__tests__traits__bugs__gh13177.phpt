===config===
ignore=non-fatal warning: final private method
min_php=8.5
===source===
<?php

trait Bar {
    final private function __construct() {}
}

final class Foo1 {
    use Bar;
}

final class Foo2 {
    use Bar {
        __construct as final;
    }
}

class Foo3 {
    use Bar {
        __construct as final;
    }
}

trait TraitNonConstructor {
    private final function test() {}
}

class Foo4 {
    use TraitNonConstructor { test as __construct; }
}

for ($i = 1; $i <= 4; $i++) {
    $rc = new ReflectionClass("Foo$i");
    echo $rc->getMethod("__construct"), "\n";
}

class Foo5 extends Foo3 {
    private function __construct() {}
}

?>
