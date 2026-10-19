===source===
<?php
class A { const X = 1 ?><?php public $p, $q = 1 ?><?php use T ?><?php }
abstract class B { abstract function f() ?><?php }
interface I { const X = 1 ?><?php function f() ?><?php }
trait T { public $p ?><?php }
enum E { case A ?><?php }
enum F: int { case A = 1 ?><?php case B = 2 ?><?php }
class C { use T, U { T::a insteadof U ?><?php a as b ?><?php } }
$o = new class { public $p ?><?php };
class D { const X = 1 ?>
<?php }
===print===
<?php
class A
{
    use T;

    const X = 1;

    public $p;

    public $q = 1;
}

abstract class B
{
    abstract function f();
}

interface I
{
    const X = 1;

    function f();
}

trait T
{
    public $p;
}

enum E
{
    case A;
}

enum F: int
{
    case A = 1;

    case B = 2;
}

class C
{
    use T, U {
        T::a insteadof U;
        a as b;
    }
}
$o = new class {
    public $p;
};

class D
{
    const X = 1;
}
