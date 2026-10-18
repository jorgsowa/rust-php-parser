===source===
<?php
abstract class A {
    public abstract int $x { set; }
}
class B {
    public int $x { set(int $value) => $value; }
    public array $y { get => $this->y; set(array|string $v) { $this->y = (array) $v; } }
    public $z { #[A] get => 1; }
    public int $w { final set { } }
}
===print===
<?php
abstract class A
{
    abstract public int $x {
        set;
    }
}

class B
{
    public int $x {
        set(int $value) => $value;
    }

    public array $y {
        get => $this->y;
        set(array|string $v) {
            $this->y = (array)$v;
        }
    }

    public $z {
        #[A]
        get => 1;
    }

    public int $w {
        final set {}
    }
}
