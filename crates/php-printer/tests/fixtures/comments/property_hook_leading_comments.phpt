===source===
<?php
class A {
    public int $x {
        /** doc */
        set(int $value) {}
        // before get
        get => 1;
    }
}
===print===
<?php
class A
{
    public int $x {
        /** doc */
        set(int $value) {}
        // before get
        get => 1;
    }
}
