===source===
<?php class A extends B { function f() { new self; new static(); new parent; self::C; static::m(); parent::__construct(); self::$p; $x instanceof self; $x instanceof static; return static::class; } }
===print===
<?php
class A extends B
{
    function f()
    {
        new self();
        new static();
        new parent();
        self::C;
        static::m();
        parent::__construct();
        self::$p;
        $x instanceof self;
        $x instanceof static;
        return static::class;
    }
}
