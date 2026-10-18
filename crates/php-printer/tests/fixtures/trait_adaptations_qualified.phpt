===source===
<?php class C { use \A\T1, B\T2 { \A\T1::foo insteadof B\T2; B\T2::foo as protected bar; baz as final; } }
===print===
<?php
class C
{
    use \A\T1, B\T2 {
        \A\T1::foo insteadof B\T2;
        B\T2::foo as protected bar;
        baz as final;
    }
}
