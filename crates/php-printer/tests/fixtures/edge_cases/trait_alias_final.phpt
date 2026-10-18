===source===
<?php
class A {
    use T {
        f as final g;
        T::h as final;
        i as protected final;
    }
}
===print===
<?php
class A
{
    use T {
        f as final g;
        T::h as final;
        i as protected final;
    }
}
